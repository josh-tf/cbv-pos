#!/bin/bash
## Script to keep only last 30 days worth of database backups
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
echo "Started backup pruning at ${script_start}"

# List files to be removed
echo "Files older than 30 days will be pruned:"
find /db* -mtime +30

#Files older than 30 days are deleted here
find /db* -mtime +30 -exec rm {} \;

## Post end message to the log
script_finish=$(date +'%m/%d/%Y %r')
echo "Finished backup pruning at ${script_finish}"
echo "-------------------------------------------"