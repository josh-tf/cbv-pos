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
exec 1>>.log.out 2>&1

echo "-------------------------------------------"

# Check the day of the week, backup only runs on Sunday
we=$(LC_TIME=C date +%A)

if [ "$we" = "Sunday" ]; then

    # Post start message to the log
    script_start=$(date +'%m/%d/%Y %r')
    echo "[Web Backup] Started website backup script at ${script_start}"

    # Backup wordpress directory to file in this dir
    tar -zcf "cbv-web-$(date '+%Y-%m-%d').tar.gz" /app/web

    ## Post end message to the log
    script_finish=$(date +'%m/%d/%Y %r')
    echo "[Web Backup] Finished website backup script at ${script_finish}"

else

    echo "[Web Backup] Its not Sunday, going to sleep.."
    exit 0

fi
