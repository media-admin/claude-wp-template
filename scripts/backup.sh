#!/bin/bash

##############################################################################
# WordPress Backup Script
# 
# Erstellt komplettes Backup von Datenbank und Dateien
##############################################################################

set -e

# Config
BACKUP_DIR="$HOME/backups/wordpress"
DATE=$(date +%Y%m%d_%H%M%S)
PROJECT_NAME="claude-wp-template"
SITE_DIR="$(pwd)/cms"

# Colors
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m'

echo -e "${GREEN}🔄 Starting WordPress Backup...${NC}"
echo ""

# Create backup directory
mkdir -p "$BACKUP_DIR"

# 1. Database Backup
echo -e "${YELLOW}→ Backing up database...${NC}"
cd cms
wp db export "$BACKUP_DIR/${PROJECT_NAME}_db_${DATE}.sql" --add-drop-table
echo -e "${GREEN}✓ Database backup created${NC}"

# 2. Files Backup
echo -e "${YELLOW}→ Backing up files...${NC}"

# Uploads
if [ -d "wp-content/uploads" ]; then
    tar -czf "$BACKUP_DIR/${PROJECT_NAME}_uploads_${DATE}.tar.gz" \
        -C wp-content uploads \
        --exclude='*.tmp' \
        --exclude='*.log'
    echo -e "${GREEN}✓ Uploads backup created${NC}"
fi

# Themes
tar -czf "$BACKUP_DIR/${PROJECT_NAME}_themes_${DATE}.tar.gz" \
    -C wp-content themes \
    --exclude='node_modules' \
    --exclude='*.map'
echo -e "${GREEN}✓ Themes backup created${NC}"

# Plugins
if [ -d "wp-content/plugins" ]; then
    tar -czf "$BACKUP_DIR/${PROJECT_NAME}_plugins_${DATE}.tar.gz" \
        -C wp-content plugins \
        --exclude='node_modules'
    echo -e "${GREEN}✓ Plugins backup created${NC}"
fi

# MU-Plugins
if [ -d "wp-content/mu-plugins" ]; then
    tar -czf "$BACKUP_DIR/${PROJECT_NAME}_mu-plugins_${DATE}.tar.gz" \
        -C wp-content mu-plugins
    echo -e "${GREEN}✓ MU-Plugins backup created${NC}"
fi

cd ..

# 3. Compress everything into one archive
echo -e "${YELLOW}→ Creating final backup archive...${NC}"
tar -czf "$BACKUP_DIR/${PROJECT_NAME}_complete_${DATE}.tar.gz" \
    -C "$BACKUP_DIR" \
    "${PROJECT_NAME}_db_${DATE}.sql" \
    "${PROJECT_NAME}_uploads_${DATE}.tar.gz" \
    "${PROJECT_NAME}_themes_${DATE}.tar.gz" \
    "${PROJECT_NAME}_plugins_${DATE}.tar.gz" 2>/dev/null || true \
    "${PROJECT_NAME}_mu-plugins_${DATE}.tar.gz" 2>/dev/null || true

# 4. Cleanup individual files
rm -f "$BACKUP_DIR/${PROJECT_NAME}_db_${DATE}.sql"
rm -f "$BACKUP_DIR/${PROJECT_NAME}_uploads_${DATE}.tar.gz"
rm -f "$BACKUP_DIR/${PROJECT_NAME}_themes_${DATE}.tar.gz"
rm -f "$BACKUP_DIR/${PROJECT_NAME}_plugins_${DATE}.tar.gz" 2>/dev/null || true
rm -f "$BACKUP_DIR/${PROJECT_NAME}_mu-plugins_${DATE}.tar.gz" 2>/dev/null || true

# 5. Delete old backups (keep last 10)
echo -e "${YELLOW}→ Cleaning up old backups...${NC}"
cd "$BACKUP_DIR"
ls -t ${PROJECT_NAME}_complete_*.tar.gz | tail -n +11 | xargs -r rm --

# 6. Summary
BACKUP_FILE="${PROJECT_NAME}_complete_${DATE}.tar.gz"
BACKUP_SIZE=$(du -h "$BACKUP_DIR/$BACKUP_FILE" | cut -f1)

echo ""
echo -e "${GREEN}━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━${NC}"
echo -e "${GREEN}✓ Backup completed successfully!${NC}"
echo -e "${GREEN}━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━${NC}"
echo ""
echo "Backup file: $BACKUP_FILE"
echo "Location: $BACKUP_DIR"
echo "Size: $BACKUP_SIZE"
echo ""
echo "To restore, run: ./scripts/restore.sh $BACKUP_FILE"