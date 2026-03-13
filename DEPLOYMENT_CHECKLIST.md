# ✅ Deployment Checklist

## Pre-Deployment (Local)

- [ ] **Build assets locally**
  ```bash
  npm run build
  ```

- [ ] **Verify build files exist**
  ```bash
  ls -la public/build/assets/
  ```
  Should show:
  - [ ] `app-ChJ7wiWi.css` (large file ~700KB)
  - [ ] `app-l0sNRNKZ.js` (tiny file 1 byte)
  - [ ] `public/build/manifest.json`

- [ ] **Verify `.gitignore` is updated**
  ```bash
  cat .gitignore | grep "public/build"
  ```
  Should show: `# /public/build - Build files should be committed...`

- [ ] **Check git status**
  ```bash
  git status
  ```
  `public/build/` files should appear as untracked or changes

- [ ] **Commit changes**
  ```bash
  git add .
  git commit -m "Fix: Enable public/build tracking and optimize Vite config"
  ```

- [ ] **Push to remote**
  ```bash
  git push origin main
  ```

---

## Infinity Free Configuration

- [ ] **SSH/FTP into Infinity Free**
  - Username: [Your username]
  - Host: [Your Infinity Free host]

- [ ] **Update `.env` file**
  ```bash
  nano .env
  ```
  
  Update these lines:
  - [ ] `APP_ENV=production`
  - [ ] `APP_DEBUG=false`
  - [ ] `APP_URL=https://your-domain.infinityfree.net`
  - [ ] `DB_HOST=sql.infinityfree.com`
  - [ ] `DB_DATABASE=your_database_name`
  - [ ] `DB_USERNAME=your_database_user`
  - [ ] `DB_PASSWORD=your_database_password`

- [ ] **Save and exit** (Ctrl+X, then Y, then Enter)

---

## Deploy Code

- [ ] **Navigate to project directory**
  ```bash
  cd public_html
  ```

- [ ] **Pull latest code from Git**
  ```bash
  git pull origin main
  ```

- [ ] **Verify files were pulled**
  ```bash
  ls -la public/build/assets/
  ```
  Should show CSS and JS files

- [ ] **Set proper file permissions**
  ```bash
  chmod 755 public/build/
  chmod 644 public/build/assets/*
  chmod 644 public/build/manifest.json
  ```

---

## Clear Caches

- [ ] **Clear all caches**
  ```bash
  php artisan optimize:clear
  ```

- [ ] **Cache configuration**
  ```bash
  php artisan config:cache
  ```

- [ ] **Cache routes**
  ```bash
  php artisan route:cache
  ```

- [ ] **Cache views**
  ```bash
  php artisan view:cache
  ```

---

## Run Migrations (if needed)

- [ ] **Check if migrations are needed**
  ```bash
  php artisan migrate:status
  ```

- [ ] **Run migrations if needed**
  ```bash
  php artisan migrate --force
  ```

---

## Post-Deployment Verification

- [ ] **Visit your domain in browser**
  ```
  https://your-domain.infinityfree.net
  ```

- [ ] **Open Developer Tools (F12)**
  - [ ] Press F12
  - [ ] Go to **Network** tab

- [ ] **Reload page (Ctrl+R or Cmd+R)**
  - [ ] Watch Network tab as page loads
  - [ ] Look for `app-*.css` request
  - [ ] Should show **Status: 200** ✅

- [ ] **Check styles are applied**
  - [ ] Tailwind colors visible
  - [ ] Flux components styled
  - [ ] Dark mode works
  - [ ] Layout looks correct

- [ ] **Check console for errors**
  - [ ] Go to **Console** tab
  - [ ] Should be clean (no red errors)
  - [ ] Warnings are okay

- [ ] **Test functionality**
  - [ ] Login works
  - [ ] Navigation works
  - [ ] Forms work
  - [ ] No JavaScript errors

---

## Troubleshooting

If something goes wrong:

- [ ] **CSS not loading?**
  - [ ] Hard refresh: `Ctrl+Shift+Delete` + `Ctrl+R`
  - [ ] Check Network tab for 404 errors
  - [ ] Verify `public/build/assets/` files exist on server

- [ ] **404 errors on CSS file?**
  - [ ] SSH and verify files: `ls -la public_html/public/build/assets/`
  - [ ] Check permissions: `chmod 644 public_html/public/build/assets/*`

- [ ] **Wrong paths in HTML?**
  - [ ] Check `.env` APP_URL value
  - [ ] Clear caches: `php artisan optimize:clear`

- [ ] **Cache issues?**
  - [ ] Run: `php artisan optimize:clear`
  - [ ] Run: `php artisan config:cache`
  - [ ] Reload in Incognito/Private window

- [ ] **Still stuck?**
  - [ ] Check error logs: `tail -f storage/logs/laravel-*.log`
  - [ ] Debug asset URL: Visit `public/debug-assets.php` (if created)
  - [ ] Review troubleshooting guides in project root

---

## Rollback (if needed)

If deployment fails:

```bash
# Go back to previous version
git revert HEAD
git push

# Or reset to previous commit
git reset --hard HEAD~1
git push -f
```

---

## Important Reminders

- ✅ **Always rebuild after CSS changes**: `npm run build`
- ✅ **Always commit `public/build/`**: It's no longer ignored
- ✅ **Always set correct `APP_URL`**: Must match your domain
- ✅ **Always clear caches**: After deploying code changes
- ✅ **Never delete `.gitignore` changes**: Keep `public/build` tracked

---

## Success Indicators ✅

After deployment, you should see:

- [ ] Tailwind CSS styles applied (colors, spacing, fonts)
- [ ] Flux UI components styled (buttons, forms, modals)
- [ ] Dark mode toggle works
- [ ] No 404 errors in browser console
- [ ] No CSS-related errors in console
- [ ] Page layout looks correct
- [ ] All functionality works

---

## Next Time You Make Changes

```bash
# 1. Make your code changes
# ...edit files...

# 2. If you changed CSS or JS
npm run build

# 3. Commit everything
git add .
git commit -m "Update features and rebuild assets"
git push

# 4. On Infinity Free (optional automation)
cd public_html
git pull
php artisan optimize:clear
```

---

**Date Completed:** _______________

**Deployed By:** _______________

**Domain:** _______________

**Status:** ✅ Ready for Production

