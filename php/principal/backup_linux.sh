#!/bin/bash

chown -R www-data:www-data /var/www/deck
mysqldump --opt -h localhost -u root -pmysql deck_db | gzip > deck_db_2016-10-07-01-54-10.gz
#whoami
#ls -l backup_linux.sh
