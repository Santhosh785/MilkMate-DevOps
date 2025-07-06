#!/bin/bash

# Debug check
echo "🔍 Checking mysqli extension..."
php -m | grep mysqli || echo "❌ mysqli NOT found!"

# Start Apache
echo "🚀 Starting Apache..."
apachectl -D FOREGROUND
