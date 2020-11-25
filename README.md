# P6_SnowTricks
Projet 6 of the "parcours développeur d'application PHP/Symfony" by Openclassrooms.

This project consist of a collaborative site for snowboard fan.

[![Maintainability](https://api.codeclimate.com/v1/badges/0562845500cb95ae0528/maintainability)](https://codeclimate.com/github/HaiseB/P6_SnowTricks/maintainability)

## Table of Contents
1. [Pre required](#Pre-required)
2. [Installation](#Installation)
3. [Settings](#Settings)
4. [How to use](#How-to-use)
5. [Build with](#Build-with)
6. [Author](#Author)

## Pre required
You will need to install those on your server
- *PHP* (>= 7.2.10)
- *Apache* (>= 2.4.35)
- *MySQL* (>= 5.7.23)
- *Composer* (>= 1.10.1)
- *Node* (>= 12.18.4)
- *Npm* (>= 6.14.6)

## Installation

> Make sure the `public` repository, is at the root of your server, you can also create a virtual host that redirect the visitors to the `public` directory.

_Run thoses commands_

- ``git clone https://github.com/HaiseB/P6_SnowTricks.git``
- ``composer install``
- ``npm install``

## Settings

- Change all default values in .env

- Create a empty database on mysql
- ``php bin/console doctrine:database:create``

(Optional to get fake data)
- ``php bin/console doctrine:migrations:migrate``
- ``php bin/console doctrine:fixtures:load``

(Optional to get release ready data)
- ``php releaseBackup/backup.php``
> If this one didn't worked you will have to manually restore the backup (the location : `releaseBackup/snowtricks.sql`)

(Else run this, /!\ but the database will be empty)
- ``php bin/console doctrine:migrations:migrate``

## How to use

- To launch symfony (choose one, according to your preferences)

- ``php -S 127.0.0.1:8000 -t public``
- ``symfony serve -d``

- To compile assets
- ``npm run watch``

```
If you choose to get the release ready data
You can sign in with
- username : Demo
- password : demodemo 
```

## Build with
- [Symfony 5](https://symfony.com/) - PHP framework

### Author
* **Benjamin Haise** _alias_ [@HaiseB](https://github.com/HaiseB)
