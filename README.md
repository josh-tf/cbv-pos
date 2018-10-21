# Computerbank Point of Sale

![Computerbank](https://cbv.josh.tf/wp-content/uploads/2018/03/banner.png)

[![Maintenance](https://img.shields.io/badge/Maintained%3F-yes-green.svg)](https://github.com/josh-tf/cbvpos/graphs/commit-activity)
[![Website shields.io](https://img.shields.io/website-up-down-green-red/http/shields.io.svg)](http://cbvpos.josh.tf)
[![GitHub pull-requests](https://img.shields.io/github/issues-pr/josh-tf/cbvpos.svg)](https://github.com/josh-tf/cbvpos/pulls/)
[![GitHub issues](https://img.shields.io/github/issues/josh-tf/cbvpos.svg)](https://GitHub.com/josh-tf/cbvpos/issues/)
[![MIT license](https://img.shields.io/badge/License-MIT-blue.svg)](https://lbesson.mit-license.org/)
[![GitHub commits](https://img.shields.io/github/commit-activity/y/josh-tf/cbvpos.svg)](https://github.com/josh-tf/cbvpos/commit/)
[![Docker Pulls](https://img.shields.io/docker/pulls/joshtf/cbvposdev-php.svg)](https://hub.docker.com/r/joshtf/cbvposdev-php/)

The Computerbank Point of Sale system is a fork of the [opensourcepos](https://github.com/opensourcepos/opensourcepos) software.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

This project requires the following tools to be installed and configured on your system. If you are missing these requirements you can follow the links below for instructions.

| Project Requirements |
| ------ |
| [Docker](https://www.docker.com/get-started) |
| [Docker Compose](https://docs.docker.com/compose/install/) |
| [Git](https://git-scm.com/downloads) |

### Supported OS

Our development environment runs within [Docker](https://www.docker.com/get-started) based containers, any operating system that supports Docker will also support our deployment.

| OS | Comments|
|---|-----------------------------------------------|
| ![Linux](https://i.imgur.com/gq76Rxa.png) | Linux (All Distributions supported by Docker) |
| ![MacOS](https://i.imgur.com/NWpdcBy.png) | MacOS (All Versions supported by Docker)      |
| ![Windows](https://i.imgur.com/P5Aciyp.png) | Windows 10 Pro (Hyper-V required)             |

### Installing

CBVPOS requires [Docker](https://www.docker.com/) with [Compose](https://docs.docker.com/compose/install/) along with [Git](https://git-scm.com/downloads) configured and installed.

In a terminal of your choice, clone the GitHub repository

```sh
git clone https://github.com/josh-tf/cbvpos.git
```

 &nbsp;
Next we will run the automated build process - note that as docker binds to Unix ports, sudo will be required on *nix variants unless you are added to the `docker` usergroup. Please refer to [this article](https://docs.docker.com/install/linux/linux-postinstall/) for more details.

```sh
cd ./cbvpos
docker-compose up -d
```

### Automatic Build process

The automatic build process will take a *few minutes* to complete and depends on available system resources - you can *optionally* omit the `-d` flag below to view the build output.

The automatic build involves a number of steps including the creation of docker network and volumes, sourcing and deploying container images from [Docker Hub](https://hub.docker.com/r/joshtf/) and building the required dependencies (php, node) files.

**Optional**: Enable ssl support via this guide on the wiki: [Enabling HTTPS/SSL on your install](https://github.com/josh-tf/cbvpos/wiki/Using-HTTPS-SSL-on-your-install)

## Access the installation

After the build process is complete, you will be able to access the installation. Provided you have not modified the docker-compose configuration, the site url will be:

| Details | Description |
|---|-----------------------------------------------|
| [localhost](http://localhost) | cbvpos Installation) |
| [localhost:8080](http://localhost:8080) | PHPMyAdmin (Database Management) |
| admin | Default username |
|  pointofsale | Default Password |

## The Wiki

We have a Wiki available with some basic information and guides, for more information you can check it out [here](https://github.com/josh-tf/cbvpos/wiki).

## Contributing

- Request access to contribute to this repository (or the development branch)
- Pull down the latest copy of the branch `git pull https://github.com/josh-tf/cbvpos.git`
- Make your changes locally and test on your Docker installation
- Push changes back to the repository - *handle any conflicts from other users commits*
- Join the Slack group for discussions, to-do and other collaboration tools

## Authors

- Originally created by the [opensourcepos](https://github.com/opensourcepos/opensourcepos/) team
- Currently developed with ❤️ by [josh-tf](https://github.com/josh-tf) - [h00pl4](https://github.com/h00pl4) - [rjobeirne](https://github.com/rjobeirne)

![Slack logo](https://i.imgur.com/2KXM4Ab.png)

## License

MIT