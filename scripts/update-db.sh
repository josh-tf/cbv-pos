#!/bin/bash

# joshtf/cbvpos
# This script is to update the db on the dev server, it is called manually
start=$SECONDS

echo "Downloading latest db import from github"
rm -f cbvpos_import.sql

wget -q https://raw.githubusercontent.com/josh-tf/cbvpos/master/database/cbvpos_import.sql

echo "Deleting old data and creating new db"
mysqladmin -h $2 -u$3 -p$4 DROP $1 -f;
mysqladmin -h $2 -u$3 -p$4 CREATE $1;

echo "Importing latest db import in to cbvpos db"
mysql -h $2 -u$3 -p$4 cbvpos < cbvpos_import.sql

timer=$(( SECONDS - start ))
echo "Done.. ($timer seconds)"
