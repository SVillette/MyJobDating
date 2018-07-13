My Job Dating
=============
[![Build Status](https://travis-ci.com/Samadu61/MyJobDating.svg?branch=master)](https://travis-ci.com/Samadu61/MyJobDating)

MyJobDating is an IMIE A3 project with Symfony 3.4, Travis integration and Taiga.io for project management.

Installation:
-------------
- First you have to install git and clone the project :

    `git clone https://github.com/Samadu61/MyJobDating.git`

- Install [composer][1]

- Install project dependencies :

    `$ composer install`
    
- Create the database :
    
    `$ php bin/console doctrine:database:create --env=PREFERRED_ENV`

- Create the database schema :

    `$ php bin/console doctrine:schema:create --env=PREFERRED_ENV`
    
- Launch the symfony server :

    `$ php bin/console server:run`
    
- Install [yarn][2]

- Install frontend dependencies :
    
    `$ yarn install`
    
- Run the frontend builder :

    `$ yarn PREFERED_ENV`

**Note**: `PREFERRED_ENV` constant might be either `dev` or `prod`



[1]:  https://getcomposer.org
[2]:  https://yarnpkg.com/lang/fr/
