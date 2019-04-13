#!/bin/bash
## Script to backup wordpress files once per week
##
## @author     Josh Bowden <https://github.com/josh-tf>
## @license    MIT License
## @copyright  2019 Josh Bowden
## @link       https://github.com/josh-tf/cbvpos

# Change to backup path
cd /db

# Everything below will go to the file 'log.out'
exec 3>&1 4>&2
trap 'exec 2>&4 1>&3' 0 1 2 3
exec 1>.log.out 2>&1

# Post start message to the log
script_start=$(date +'%m/%d/%Y %r')
echo "Started website backup script at ${script_start}"

# Backup wordpress directory to file in this dir
tar -zcvf "cbv-web-$(date '+%Y-%m-%d').tar.gz" /app/web

## Post end message to the log
script_finish=$(date +'%m/%d/%Y %r')
echo "Finished website backup script at ${script_finish}"
echo "-------------------------------------------"