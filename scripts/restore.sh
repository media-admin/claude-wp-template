#!/bin/bash

##############################################################################
# WordPress Restore Script
# 
# Stellt Backup wieder her
##############################################################################

set -e

if [ -z "$1" ]; then
    echo "Usage: ./scripts/restore.sh <backup-file>"
    exit 1
fi

BACKUP_FILE="$1"
RESTORE_DIR="$(pwd)"
TEMP_DIR="/tmp/wp_restore_$$"

# Colors
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m'

echo -e "${GREEN}🔄 Starting WordPress Restore...${NC}"
echo ""

# Check if backup exists
if [ ! -f "$BACKUP_FILE" ]; then
    echo -e "${RED}Error: Backup file not found!${NC}"
    exit 1
fi

# Warning
echo -e "${RED}⚠️  WARNING: This will overwrite existing data!${NC}"
read -p "Continue? (yes/no): " -r
if [[ ! $REPLY =~ ^[Yy][Ee][Ss]$ ]]; then
    echo "Restore cancelled."
    exit 0
fi

# Create temp directory
mkdir -p "$TEMP_DIR"

# Extract backup
echo -e "${YELLOW}→ Extracting backup...${NC}"
tar -xzf "$BACKUP_FILE" -C "$TEMP_DIR"

# Restore database
echo -e "${YELLOW}→ Restoring database...${NC}"
SQL_FILE=$(find "$TEMP_DIR" -name "*_db_*.sql" | head -1)
if [ -n "$SQL_FILE" ]; then
    cd cms
    wp db import "$SQL_FILE"
    echo -e "${GREEN}✓ Database restored${NC}"
    cd ..
fi

# Restore files
echo -e "${YELLOW}→ Restoring files...${NC}"

# Uploads
UPLOADS_FILE=$(find "$TEMP_DIR" -name "*_uploads_*.tar.gz" | head -1)
if [ -n "$UPLOADS_FILE" ]; then
    tar -xzf "$UPLOADS_FILE" -C cms/wp-content
    echo -e "${GREEN}✓ Uploads restored${NC}"
fi

# Themes
THEMES_FILE=$(find "$TEMP_DIR" -name "*_themes_*.tar.gz" | head -1)
if [ -n "$THEMES_FILE" ]; then
    tar -xzf "$THEMES_FILE" -C cms/wp-content
    echo -e "${GREEN}✓ Themes restored${NC}"
fi

# Cleanup
rm -rf "$TEMP_DIR"

# Clear cache
echo -e "${YELLOW}→ Clearing cache...${NC}"
cd cms
wp cache flush
wp transient delete --all
cd ..

echo ""
echo -e "${GREEN}✓ Restore completed successfully!${NC}"