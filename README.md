
![N|Solid](https://cbv.josh.tf/wp-content/uploads/2018/03/banner.png)

# Computerbank Point of Sale (WIP)
This repository contains the files and docker instructions for a local deploment of the Computerbank POS based on [opensourcepos](https://www.opensourcepos.org/). The installation involves cloning the repo locally and then creating a docker container mapped to the local folder.

### Requirements

  - Docker
  - Git


### Installation

CBVPOS requires [Docker](https://www.docker.com/) configured and installed.

In a terminal of your choice create a docker network for our containers:
```sh
$ docker network create -d bridge cbvposdev-network
```
 &nbsp;
Next we will create the docker containers for all three applications (Apache, MariaDB, PHPMyAdmin).

**Note**: You must change the *{localdir}* in the first command, to the location you have cloned the GitHub repository to. Examples include:

 - **Windows**: C:\Users\PC\Development\cbvpos
 - **Linux/MacOS**: /home/user/dev/cbvpos

```sh
$ docker run --network="cbvposdev-network" --name cbvposdev-php -v {localdir}:/app -d -p 80:80 joshtf/cbvposdev-php apache2-foreground
$ docker run --network="cbvposdev-network" --name cbvposdev-db -d -p 3306:3306 joshtf/cbvposdev-db
$ docker run --network="cbvposdev-network" --name cbvposdev-pma -d -p 8080:80 joshtf/cbvposdev-pma
```
 &nbsp;
Next, import the 'cbvpos' database file:

 1. Login to PHPMyAdmin via http://localhost:8080
**Username**: admin **Password**: pointofsale 
 3. Click on 'cbvpos' on the lefthand side
 4. Click on 'Import' at the top of the page
 5. Click 'Choose File' and navigate to *(gitdir)/database/cbvpos_import.sql*

 &nbsp;
****Access the installation:****

- http://localhost - cbvpos installation
- http://localhost:8080 - PHPMyAdmin (Database management)

**Username**: admin
**Password**: pointofsale 

### Contributing

 - Changes can be made locally in your github folder, you will see these changes live on your local installation. 
 - Once changes are tested you can commit them and push to the repository.
 - Developers will pull down the changes and will see your new changes instantly.
 
### Todos

 - Sort out the build end for the web based testing
