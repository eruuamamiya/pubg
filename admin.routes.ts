import { Router } from "express";
import type { Request, Response, NextFunction } from "express";
import fs from "fs";
import path from "path";
import crypto from "crypto";
import { fileURLToPath } from "url";

const router = Router();

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const projectRoot = path.resolve(__dirname, "../../");

const configDir = path.join(projectRoot, "dist", "configs");
const sourceConfigDir = path.join(projectRoot, "src", "configs");
const htmlPath = path.join(projectRoot, "web-html", "index.html");

const sources = [
  "otakudesu",
  "kuramanime",
  "oploverz",
  "samehadaku",
] as const;

type SourceName = (typeof sources)[number];

const USERNAME = "admin";
const PASSWORD = "@@Azis87";

const SESSION_COOKIE = "wajik_admin_session";

const sessions = new Set<string>();

function isSourceName(source: string | undefined): source is SourceName {
  return (
    source !== undefined &&
    sources.includes(source as SourceName)
  );
}

function getConfigPath(source: SourceName): string {
  return path.join(
    configDir,
    `${source}.config.js`
  );
}

function getSourceConfigPath(source: SourceName): string {
  return path.join(
    sourceConfigDir,
    `${source}.config.ts`
  );
}

function getBaseUrlFromFile(filePath: string): string {
  if (!fs.existsSync(filePath)) {
    throw new Error(
      `Config tidak ditemukan: ${filePath}`
    );
  }

  const content = fs.readFileSync(
    filePath,
    "utf8"
  );

  const match = content.match(
    /baseUrl\s*:\s*["'`](.*?)["'`]/
  );

  if (!match) {
    throw new Error(
      "baseUrl tidak ditemukan di config"
    );
  }

  const baseUrl = match[1];

  if (baseUrl === undefined) {
    throw new Error(
      "Nilai baseUrl tidak ditemukan di config"
    );
  }

  return baseUrl;
}

function replaceBaseUrl(
  filePath: string,
  baseUrl: string
): void {
  if (!fs.existsSync(filePath)) {
    throw new Error(
      `Config tidak ditemukan: ${filePath}`
    );
  }

  const content = fs.readFileSync(
    filePath,
    "utf8"
  );

  const updated = content.replace(
    /baseUrl\s*:\s*["'`](.*?)["'`]/,
    `baseUrl: "${baseUrl}"`
  );

  if (updated === content) {
    throw new Error(
      "Format baseUrl tidak ditemukan"
    );
  }

  fs.writeFileSync(
    filePath,
    updated,
    "utf8"
  );
}

function getSessionFromRequest(
  req: Request
): string | null {
  const cookieHeader = req.headers.cookie;

  if (!cookieHeader) {
    return null;
  }

  const cookies = cookieHeader.split(";");

  for (const cookie of cookies) {
    const parts = cookie.trim().split("=");

    const name = parts.shift();

    if (name === SESSION_COOKIE) {
      const value = parts.join("=");

      return value || null;
    }
  }

  return null;
}

function requireAuth(
  req: Request,
  res: Response,
  next: NextFunction
): void {
  const session = getSessionFromRequest(req);

  if (!session || !sessions.has(session)) {
    res.status(401).json({
      success: false,
      message: "Unauthorized",
    });

    return;
  }

  next();
}

/*
 * GET /admin
 *
 * Menampilkan halaman admin.
 */
router.get(
  "/",
  (_req: Request, res: Response) => {
    if (!fs.existsSync(htmlPath)) {
      res.status(404).send(
        "web-html/index.html tidak ditemukan"
      );

      return;
    }

    res.sendFile(htmlPath);
  }
);

/*
 * POST /admin/login
 */
router.post(
  "/login",
  (req: Request, res: Response) => {
    const { username, password } = req.body ?? {};

    if (
      username !== USERNAME ||
      password !== PASSWORD
    ) {
      res.status(401).json({
        success: false,
        message: "Username atau password salah",
      });

      return;
    }

    const session = crypto
      .randomBytes(32)
      .toString("hex");

    sessions.add(session);

    res.setHeader(
      "Set-Cookie",
      `${SESSION_COOKIE}=${session}; Path=/; HttpOnly; SameSite=Lax`
    );

    res.json({
      success: true,
      message: "Login berhasil",
    });
  }
);

/*
 * POST /admin/logout
 */
router.post(
  "/logout",
  requireAuth,
  (req: Request, res: Response) => {
    const session = getSessionFromRequest(req);

    if (session) {
      sessions.delete(session);
    }

    res.setHeader(
      "Set-Cookie",
      `${SESSION_COOKIE}=; Path=/; HttpOnly; SameSite=Lax; Max-Age=0`
    );

    res.json({
      success: true,
      message: "Logout berhasil",
    });
  }
);

/*
 * GET /admin/check
 */
router.get(
  "/check",
  (req: Request, res: Response) => {
    const session = getSessionFromRequest(req);

    res.json({
      authenticated:
        !!session && sessions.has(session),
    });
  }
);

/*
 * GET /admin/sources
 */
router.get(
  "/sources",
  requireAuth,
  (_req: Request, res: Response) => {
    try {
      const result = sources.map((source) => {
        const configPath =
          getConfigPath(source);

        return {
          name: source,
          baseUrl:
            getBaseUrlFromFile(configPath),
        };
      });

      res.json({
        success: true,
        sources: result,
      });
    } catch (error) {
      const message =
        error instanceof Error
          ? error.message
          : "Gagal membaca config";

      res.status(500).json({
        success: false,
        message,
      });
    }
  }
);

/*
 * PUT /admin/sources/:source
 */
router.put(
  "/sources/:source",
  requireAuth,
  (req: Request, res: Response) => {
    const source =
      req.params.source;

    if (!isSourceName(source)) {
      res.status(400).json({
        success: false,
        message: "Source tidak valid",
      });

      return;
    }

    const sourceName: SourceName =
      source;

    const { baseUrl } =
      req.body ?? {};

    if (
      typeof baseUrl !== "string" ||
      !baseUrl.trim()
    ) {
      res.status(400).json({
        success: false,
        message: "baseUrl wajib diisi",
      });

      return;
    }

    const cleanBaseUrl =
      baseUrl
        .trim()
        .replace(/\/+$/, "");

    try {
      const distConfigPath =
        getConfigPath(sourceName);

      const srcConfigPath =
        getSourceConfigPath(sourceName);

      /*
       * Update config hasil build
       */
      replaceBaseUrl(
        distConfigPath,
        cleanBaseUrl
      );

      /*
       * Update config source TypeScript
       */
      if (
        fs.existsSync(srcConfigPath)
      ) {
        replaceBaseUrl(
          srcConfigPath,
          cleanBaseUrl
        );
      }

      res.json({
        success: true,
        message:
          `Base URL ${sourceName} berhasil diperbarui`,
        source: sourceName,
        baseUrl: cleanBaseUrl,
      });
    } catch (error) {
      const message =
        error instanceof Error
          ? error.message
          : "Gagal memperbarui config";

      res.status(500).json({
        success: false,
        message,
      });
    }
  }
);

/*
 * POST /admin/test-source
 */
router.post(
  "/test-source",
  requireAuth,
  async (
    req: Request,
    res: Response
  ) => {
    const { baseUrl } =
      req.body ?? {};

    if (
      typeof baseUrl !== "string" ||
      !baseUrl.trim()
    ) {
      res.status(400).json({
        success: false,
        message: "baseUrl wajib diisi",
      });

      return;
    }

    const cleanBaseUrl =
      baseUrl.trim();

    try {
      const response =
        await fetch(cleanBaseUrl, {
          method: "GET",
          headers: {
            "User-Agent":
              "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 Chrome/120 Safari/537.36",
          },
          redirect: "follow",
        });

      res.json({
        success: response.ok,
        status: response.status,
        statusText:
          response.statusText,
        finalUrl: response.url,
      });
    } catch (error) {
      const message =
        error instanceof Error
          ? error.message
          : "Gagal mengakses source";

      res.status(500).json({
        success: false,
        message,
      });
    }
  }
);

/*
 * POST /admin/restart
 *
 * PM2 akan menjalankan kembali
 * aplikasi setelah process exit.
 */
router.post(
  "/restart",
  requireAuth,
  (_req: Request, res: Response) => {
    res.json({
      success: true,
      message:
        "API sedang direstart...",
    });

    setTimeout(() => {
      process.exit(0);
    }, 500);
  }
);

export default router;
