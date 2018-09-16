


![N|Solid](https://cbv.josh.tf/wp-content/uploads/2018/03/banner.png)

# Computerbank Point of Sale
This repository contains the files and docker instructions for a local deploment of the Computerbank POS based on [opensourcepos](https://www.opensourcepos.org/). The installation contains a docker-compose file for one command deployment on any OS.

### Requirements

  - [Docker](https://www.docker.com/get-started)
  - [Docker Compose](https://docs.docker.com/compose/install/)
  - [Git](https://git-scm.com/downloads)

### Supported OS

  - ![enter image description here](https://i.imgur.com/gq76Rxa.png) - Linux (All Distributions supported by Docker) 
  - ![enter image description here](https://i.imgur.com/NWpdcBy.png) - MacOS (All Versions supported by Docker)
  - ![enter image description here](https://i.imgur.com/P5Aciyp.png) - Windows 10 Pro (Hyper-V required)


### Installation

CBVPOS requires [Docker](https://www.docker.com/) with [Compose](https://docs.docker.com/compose/install/) along with [Git](https://git-scm.com/downloads) configured and installed.

In a terminal of your choice, clone the GitHub repository :
```sh
$ git clone https://github.com/josh-tf/cbvpos.git
```
 &nbsp;
Next we will create the docker containers for all three applications (Apache, MariaDB, PHPMyAdmin) via the docker compose file.

```sh
$ cd ./cbvpos
$ docker-compose build
$ docker-compose up -d
```

### Automatic Build process
 The build process will take a few minutes and involves the following **automatic** steps:
 1. Download *Apache, MariaDB* and *PMA* images from *joshtf/cbvposdev* DockerHub repo
 2. Downloads latest php and node modules using grunt, compose and bower images
 3. Create a local network called '*cbvposdev_default*'
 4. Create Apache container named '*cbvposdev-php*' and map the git folder to */app*
 5. Create MariaDB container named '*cbvposdev-db*' and import database from *./database/cbvpos_import.sql*
 6. Create PHPMyAdmin container named '*cbvposdev-pma*' and map to the db container

 After a few minutes have passed, you can access the installation.
  
### Access the installation
 
http://localhost - cbvpos installation<br>
http://localhost:8080 - PHPMyAdmin (Database management)<br>
**Username**: admin<br>
**Password**: pointofsale <br>

### Contributing

 - Request access to contribute to this repository (or the development branch)
 - Pull down the latest copy of the branch `git pull https://github.com/josh-tf/cbvpos.git`
 - Make your changes locally and test on your Docker installation
 - Push changes back to the repository - *handle any conflicts from other users commits*
 - Join the Slack group for discussions, to-do and other colab tools

![enter image description here](https://i.imgur.com/2KXM4Ab.png)
 
### Todos

 - Sort out the build end for the web based testing