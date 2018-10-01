[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.1.3-8892BF.svg)](https://php.net/)
[![Minimum Node Version](https://img.shields.io/badge/node-%3E%3D%206.11.5-brightgreen.svg)](https://nodejs.org/en/)
[![Build Status](https://travis-ci.org/Horyzone/sim.svg?branch=master)](https://travis-ci.org/Horyzone/sim)
[![GitHub license](https://img.shields.io/badge/License-MIT-blue.svg)](https://github.com/Horyzone/sim/blob/master/LICENSE)
# sim

PHP framework based on a custom skeleton `slim` with configuration setting by yaml format and other

For all contributions on github, please read the document [CONTRIBUTING.md](https://github.com/Horyzone/sim/blob/master/.github/CONTRIBUTING.md).


## Les avantages que propose le skeleton

- Répartition des routes/controlleurs/vues/middlewares.
- Fichier de configuration d'environnement base de données.
- Moteur de template twig.
- Organisation du container pour faciliter l'ajout de nouvelles librairies.
- Fichier `config/error_pages.php` pour personnaliser les pages d'erreurs (404, 405, 500).
- Mise en place de middlewares pour le csrf, token, message flash et sauvegarde des inputs.
- Commandes via la console pour créer rapidement des contrôleurs/middlewares/entitées/fixtures ou pour vider le cache de twig.
- Doctrine 2 comme ORM avec les DataFixtures.
- Un helper pour la gestion des sessions.
- Système multilingue avec twig.
- Webpack pour faciliter le développement front-end.


## Librairies utilisées

- [slim/twig-view](https://github.com/slimphp/Twig-View) pour la vue.
- [doctrine/doctrine2](https://github.com/doctrine/doctrine2) pour la base de données.
- [doctrine/data-fixtures](https://github.com/doctrine/data-fixtures) pour les données fictives en base de données.
- [respect/validation](https://github.com/Respect/Validation) pour valider les données.
- [slim/csrf](https://github.com/slimphp/Slim-Csrf) pour la sécurité des sessions.
- [digitalnature/php-ref](https://github.com/digitalnature/php-ref) pour une fonction var_dump amélioré.
- [vlucas/phpdotenv](https://github.com/vlucas/phpdotenv) pour la configuration de l'environnement.
- [symfony/console](https://github.com/symfony/console) pour des commandes console.
- [php-school/cli-menu](https://github.com/php-school/cli-menu) pour simplifier l'exécution des commandes.
- [seldaek/monolog](https://github.com/Seldaek/monolog) pour gérer des logs.
- [runcmf/runtracy](https://github.com/runcmf/runtracy) le profiler.
- [adbario/slim-secure-session-middleware](https://github.com/adbario/slim-secure-session-middleware) helper pour la gestion des sessions.
- [illuminate/translation](https://github.com/illuminate/translation) pour le système multilingue.
- [webpack/webpack](https://github.com/webpack/webpack) pour la fusion et minification des fichiers css/js.


## Installation

Via composer

```bash
$ composer create-project Horyzone/sim <projet_name>
$ cd <projet_name>
$ composer install
```
Vérifiez que le fichier `.env` a bien été créé, il s'agit du fichier de configuration de votre environnement ou vous définissez la connexion à la base de données, l'environnement `local` ou `prod` et l'activation du cache de twig.

Si jamais le fichier n'a pas été créé, faite le manuellement en dupliquant le fichier `.env.example`.

N'oubliez pas de vérifier que votre configuration d'environnement de votre base de données corresponde bien.


## Permissions

Autoriser les dossiers `app/cache` et `app/logs` à l'écriture coté serveur web.


# User Documentation

Pour bien utiliser ce skeleton, il est important de bien connaitre le fonctionnement de `Slim 3` et des divers librairies utilisées.

Vous avez à votre disposition, plus haut, les liens vers ces derniers pour en savoir plus.

Toute fois, voici un petit [guide d'utilisation](https://github.com/Horyzone/sim/blob/master/docs/introduction.md).
