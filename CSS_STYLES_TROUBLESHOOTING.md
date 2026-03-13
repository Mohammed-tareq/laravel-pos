# CSS & Vite Styles Not Loading - Troubleshooting Guide

## Problem Summary
Your Laravel + Flux + Livewire + Vite project builds successfully (`npm run build`), but CSS styles are not appearing on the frontend after deployment or in production environments like Infinity Free.

## Root Causes & Solutions

### ✅ Solution 1: Ensure @vite Directive with Build Path (IMPLEMENTED)

**File:** `resources/views/partials/head.blade.php`

The `@vite()` directive MUST be present in your main layout with the build directory specified:

```blade
@vite(['resources/css/app.css', 'resources/js/app.js'], 'build')
```

This tells Laravel to look in the `public/build` directory for the compiled assets.

**Status:** ✅ DONE - Updated in `partials/head.blade.php`

---

### ✅ Solution 2: Correct Vite Configuration (IMPLEMENTED)

**File:** `vite.config.js`

Your config should explicitly define the build output directory:

```javascript
export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            buildDirectory: 'build',  // ← Explicitly specify
        }),
        tailwindcss(),
    ],
    build: {
        manifest: true,
        outDir: 'public/build',
        emptyOutDir: true,
        minify: 'terser',
    },
});
```

**Status:** ✅ DONE - Updated `vite.config.js`

---

### ✅ Solution 3: Install Terser (IMPLEMENTED)

For production minification, you need `terser`:

```bash
npm install terser --save-dev
```

**Status:** ✅ DONE - Installed via npm

---

### Solution 4: Set Correct Environment Variables for Infinity Free

**File:** `.env.production` or `.env` on Infinity Free

Create/update `.env.production` template with:

```env
APP_NAME=Laravel POS
APP_ENV=production
APP_DEBUG=false
# IMPORTANT: Use your actual Infinity Free domain
APP_URL=https://your-domain.infinityfree.net

DB_CONNECTION=mysql
DB_HOST=sql.infinityfree.com
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

**Critical Point:** The `APP_URL` must match your actual domain on Infinity Free. This affects how asset URLs are generated.

---

### Solution 5: Verify Assets Are Generated

After running `npm run build`, verify the files exist:

```bash
# Check public/build directory
ls -la public/build/assets/

# Should show files like:
# app-ChJ7wiWi.css (your CSS file)
# app-l0sNRNKZ.js (your JS file)
```

---

## Deployment Steps for Infinity Free

### Step 1: Build Locally
```bash
npm run build
```

### Step 2: Commit Build Files
```bash
git add public/build/
git commit -m "Update production assets"
```

### Step 3: Update .env on Infinity Free

On Infinity Free's file manager or FTP:
- Set `APP_ENV=production`
- Set `APP_DEBUG=false`
- Set `APP_URL=https://your-domain.infinityfree.net`
- Set database credentials

### Step 4: Clear Caches on Infinity Free

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

### Step 5: Verify in Browser

1. Right-click → Inspect → Network tab
2. Reload the page
3. Look for `app-*.css` file
4. Check Response Headers for proper Content-Type

---

## Verification Checklist

- [ ] `@vite(['resources/css/app.css', 'resources/js/app.js'], 'build')` is in your head partial
- [ ] `public/build/manifest.json` exists
- [ ] `public/build/assets/app-*.css` file exists
- [ ] `npm run build` completes successfully
- [ ] `APP_ENV=production` on production server
- [ ] `APP_DEBUG=false` on production server
- [ ] `APP_URL` matches your actual domain
- [ ] `.gitignore` does NOT ignore `public/build/`

---

## If Styles Still Don't Load

### Check 1: Browser Developer Tools
Open DevTools (F12) → Network tab:
- Look for the CSS file request
- Check the HTTP status code (should be 200)
- Check Response headers for correct `Content-Type: text/css`

### Check 2: Asset URL in Page Source
Right-click page → View Page Source, look for:
```html
<link rel="stylesheet" href="/build/assets/app-ChJ7wiWi.css">
```

Should NOT be:
- `http://localhost:8000/build/assets/...` (hardcoded localhost)
- Missing entirely

### Check 3: File Permissions
On Infinity Free, ensure:
```bash
chmod 644 public/build/assets/*
chmod 755 public/build/assets/
chmod 755 public/build/
```

### Check 4: Clear Browser Cache
- Hard refresh: `Ctrl+Shift+Delete` (Windows) or `Cmd+Shift+Delete` (Mac)
- Or use Incognito mode

### Check 5: Check Server Logs
On Infinity Free, check error logs for missing files or permission issues.

---

## Common Issues on Infinity Free

| Issue | Solution |
|-------|----------|
| Styles work locally but not on Infinity Free | APP_URL mismatch - update to your domain |
| 404 errors for CSS files | Files not deployed - ensure `public/build` is in git |
| Styles flicker on page load | FOUC - add `[x-cloak] { display: none !important; }` to head |
| Very large CSS file | This is normal with Tailwind + Flux - expected |

---

## Quick Debugging Script

Create `public/debug-assets.php` (delete after debugging):

```php
<?php
echo "APP_URL: " . env('APP_URL') . "<br>";
echo "Build Directory: " . realpath('public/build') . "<br>";
echo "Manifest exists: " . (file_exists('public/build/manifest.json') ? 'Yes' : 'No') . "<br>";
echo "CSS file exists: " . (file_exists('public/build/assets/app-ChJ7wiWi.css') ? 'Yes' : 'No') . "<br>";
echo "Asset URL: " . asset('build/assets/app-ChJ7wiWi.css') . "<br>";
?>
```

Visit `https://your-domain.infinityfree.net/debug-assets.php` to verify.

---

## Additional Resources

- [Laravel Vite Documentation](https://laravel.com/docs/vite)
- [Tailwind CSS + Vite](https://tailwindcss.com/docs/installation/using-vite)
- [Flux UI Installation](https://fluxui.dev/docs/installation)
- [Infinity Free PHP Deployment Guide](https://infinityfree.com/docs/)

---

**Last Updated:** March 13, 2026

