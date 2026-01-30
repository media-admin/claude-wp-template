# Deployment Guide

## Voraussetzungen

- SSH-Zugang zum Server
- `.env.production` konfiguriert
- SSH-Keys eingerichtet

## Standard Deployment
```bash
# Production Build
npm run build

# Deployment
./scripts/deploy.sh production
```

## Manuelles Deployment
```bash
# 1. Build
npm run build

# 2. Theme hochladen
rsync -avz wp-content/themes/custom-theme/ \
  user@server:/var/www/html/wp-content/themes/custom-theme/

# 3. Cache leeren
ssh user@server "cd /var/www/html && wp cache flush"
```

## Rollback
```bash
# Zu vorherigem Commit
git checkout HEAD~1
npm run build
./scripts/deploy.sh production
```

## Datenbank-Migration
```bash
# Export lokal
wp db export backup.sql

# Upload
scp backup.sql user@server:/tmp/

# Import auf Server
ssh user@server "cd /var/www/html && wp db import /tmp/backup.sql"

# Search-Replace
ssh user@server "cd /var/www/html && wp search-replace 'old-url.com' 'new-url.com'"
```