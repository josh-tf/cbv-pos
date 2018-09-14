#!/bin/bash

# joshtf/cbvpos
# This script is to update the db on the dev server, it is called manually

start=$SECONDS

echo "Downloading latest db import from github"
rm cbvpos_import.sql

wget -q https://raw.githubusercontent.com/josh-tf/cbvpos/master/database/cbvpos_import.sql

echo "Deleting old data and creating new db"
mysqladmin -u$MYSQL_USER -p$MYSQL_PASSWORD DROP cbvpos -f;
mysqladmin -u$MYSQL_USER -p$MYSQL_PASSWORD CREATE cbvpos;

echo "Importing latest db import in to cbvpos db"
mysql -u$MYSQL_USER -p$MYSQL_PASSWORD cbvpos < cbvpos_import.sql

timer=$(( SECONDS - start ))
echo "Done.. ($timer seconds)"
