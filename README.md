[![version](https://img.shields.io/badge/Version-1.0.0-brightgreen.svg)](https://github.com/Horyzone/sim/releases/tag/1.0.0)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.1.3-8892BF.svg)](https://php.net/)
[![Minimum Node Version](https://img.shields.io/badge/node-%3E%3D%206.11.5-brightgreen.svg)](https://nodejs.org/en/)
[![Build Status](https://travis-ci.org/Horyzone/sim.svg?branch=master)](https://travis-ci.org/Horyzone/sim)
[![GitHub license](https://img.shields.io/badge/License-MIT-blue.svg)](https://github.com/Horyzone/sim/blob/master/LICENSE)

![](https://miroir.horyzone.fr/upload/logo-sim-transparent-200px.png)

PHP framework SIM (Simple Intuitive and Modular) based on a custom skeleton `slim` with configuration setting by yaml format and more.

For all contributions on github, please read the document [CONTRIBUTING.md](https://github.com/Horyzone/sim/blob/master/.github/CONTRIBUTING.md).


## Used libraries

- [slim/twig-view](https://github.com/slimphp/Twig-View) for the views.
- [doctrine/doctrine2](https://github.com/doctrine/doctrine2) for the database.
- [doctrine/data-fixtures](https://github.com/doctrine/data-fixtures) for the data fixture.
- [respect/validation](https://github.com/Respect/Validation) to validate the data.
- [slim/csrf](https://github.com/slimphp/Slim-Csrf) for form security.
- [digitalnature/php-ref](https://github.com/digitalnature/php-ref) for an improved var_dump function.
- [vlucas/phpdotenv](https://github.com/vlucas/phpdotenv) for the configuration of the environment.
- [symfony/console](https://github.com/symfony/console) for console commands.
- [seldaek/monolog](https://github.com/Seldaek/monolog) to manage logs.
- [runcmf/runtracy](https://github.com/runcmf/runtracy) for a profiler.
- [adbario/slim-secure-session-middleware](https://github.com/adbario/slim-secure-session-middleware) helpers for session management.
- [symfony/translation](https://github.com/symfony/translation) for the multilingual system.
- [webpack/webpack](https://github.com/webpack/webpack) for compilation and minification of files scss/sass/css/js.
- [llvdl/slim-router-js](https://github.com/llvdl/slim-router-js) url generator slim in javascript code.


## Installation

```bash
$ composer create-project Horyzone/sim <projet_name>
$ cd <projet_name>
$ composer install
$ npm install
```
Check that the `.env` file has been created, this is the configuration file of your environment or you define the connection to the database, the environment` dev` or `prod` and the activation of the twig cache.

If the file has not been created, do it manually by duplicating the `.env.example` file.

Do not forget to check that your environment configuration of your database matches well.


## Permissions

Allow the `app/cache` and `app/logs` folders to write to the web server side.


## Documentation

Check the [User Documentation](https://docs.horyzone.fr/sim/)
