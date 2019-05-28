#!/bin/bash
VERSION=0.1.0
SUBJECT=rebuild-app
USAGE="Usage: dev-rebuild-app.sh [Flag: (-f for full wipe, -c for css/js only)]"

# if no options are specified
if [ $# == 0 ] ; then
    echo $USAGE
    exit 1;
fi

checkDir()
{
    if [ -d "./cbv-pos" ]; then
        cd "./cbv-pos"
    else
        echo "Unable to locate cbv-pos folder"
        exit 1;
    fi
}

removeApp()
{
    echo "deleting app folders"
    rm -rf ./vendor ./tmp ./node_modules ./public/dist ./public/bower_components
}

removeCSS()
{
    echo "deleting compiled css/js folder"
    rm -rf ./public/dist

}

# check folder exists
checkDir

# delete depending on option
if [ "$1" = "-f"]; then
  removeApp
elif [ "$1" = "-c" ]; then
  removeCSS
else
    echo "An invalid option was specified.."
    echo $USAGE
    exit 1;
fi

# copy fresh compose and run
echo "copying fresh compose file and running docker-compose"
cp ./deploy/docker/development/docker-compose.yml .
docker-compose up -d