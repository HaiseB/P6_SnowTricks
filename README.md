# P6_SnowTricks
Projet 6 of the "parcours développeur d'application PHP/Symfony" by Openclassrooms.

This project consist of a collaborative site for snowboard fan.

[![Maintainability](https://api.codeclimate.com/v1/badges/0562845500cb95ae0528/maintainability)](https://codeclimate.com/github/HaiseB/P6_SnowTricks/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/0562845500cb95ae0528/test_coverage)](https://codeclimate.com/github/HaiseB/P6_SnowTricks/test_coverage)

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
- Get sources files / Clone the repository [Here](https://github.com/HaiseB/P5_blogPhp)
> Make sure the `public` repository, is at the root of your server, you can also create a virtual host that redirect the visitors to the `public` directory.

_Go with a console to the repository and do thoses commands_
- ``composer install``
- ``composer update``
- ``npm install``

## Settings

- Create a empty database on mysql

- Change all default values in .env

_Go back to the console and do_

- ``php bin/console doctrine:migrations:migrate``

- (Optional to get fake data)
- ``php bin/console doctrine:fixtures:load``

## How to use

- To launch symfony (choose one, according to your preferences)

- ``php -S 127.0.0.1:8000 -t public``
- ``symfony serve -d``

(In development mode)
- ``npm run watch``

## Build with
- [Symfony 5](https://symfony.com/) - PHP framework

### Author
* **Benjamin Haise** _alias_ [@HaiseB](https://github.com/HaiseB)
