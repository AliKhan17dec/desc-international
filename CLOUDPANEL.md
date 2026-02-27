# ☁️ Deploying to CloudPanel.io

This guide will help you deploy this Laravel project to **CloudPanel**.

## 1. Create a Site in CloudPanel
1. Log in to your CloudPanel.
2. Go to **Sites** -> **Add Site**.
3. Select **Create a PHP Site**.
4. Set the **Site Domain** (e.g., `trading.yourdomain.com`).
5. Set the **Vhost Template** to `Laravel` (This is important for Nginx configuration).
6. Set the **Root Directory** to `/htdocs/public` (or keep `/htdocs` if you use the root `index.php` fix). **Recommended: Use `/htdocs/public`**.

## 2. Upload Files
You can upload files via **SFTP** or use `git clone` inside the `/htdocs` directory.

## 3. Configure .env
1. Duplicate `.env.example` to `.env`.
2. Update the following values:
   - `APP_ENV=production`
   - `APP_DEBUG=false`
   - `APP_URL=https://yourdomain.com`
   - `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` (Create these in CloudPanel under **Databases**).

## 4. Run Deployment Script
SSH into your server and run:
```bash
cd /path/to/your/site/htdocs
chmod +x deploy.sh
./deploy.sh
```

## 5. Nginx Configuration (Vhost)
If you didn't select the Laravel template during site creation, ensure your Vhost looks like this:

```nginx
server {
    listen 80;
    listen [::]:80;
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    ...
    root /home/cloudpanel/htdocs/yourdomain.com/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_pass unix:/run/php/php8.2-fpm.sock; # Check your PHP version
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        fastcgi_index index.php;
    }
}
```

## 6. Permissions
Ensure the storage and cache folders are writable:
```bash
chown -R clp:clp .
chmod -R 775 storage bootstrap/cache
```

## 7. Troubleshooting Blank Screen issues
If you see a blank black screen after deployment, follow these steps:

### A. Check Browser Console
Right-click on the page -> **Inspect** -> **Console**.
- If you see `net::ERR_CONNECTION_REFUSED` for `localhost:5173`, your app is in "Dev Mode". 
- **Fix**: Set `APP_ENV=production` and `APP_DEBUG=false` in your `.env`. Then delete the file `public/hot` if it exists.

### B. Assets not built
- If you see `404 Not Found` for files inside `build/assets/...`.
- **Fix**: Run `npm install && npm run build` on the server. If your server is low on RAM, build it locally and upload the `public/build` folder.

### C. APP_URL Mismatch
- If your site is `https://trading.com` but assets load via `http`.
- **Fix**: Ensure `APP_URL=https://trading.com` in `.env`.

### D. Nginx Root Directory
- CloudPanel sites should have the **Root Directory** set to `/home/cloudpanel/htdocs/yourdomain.com/public`.
- If it's pointed to `/htdocs` (the folder above public), the assets will not resolve correctly.

### E. Permissions
Run this to ensure the webserver can read/write the necessary files:
```bash
find . -type f -exec chmod 644 {} \;
find . -type d -exec chmod 755 {} \;
chmod -R 775 storage bootstrap/cache
```

## 8. Build Assets Locally (Optional)
If your server has low RAM, run `npm run build` on your local machine and upload the `public/build/` folder to the server instead of running it there.

