# Multilingue

Vous pouvez faire du multilingue avec twig, vous avez peut-être remarquer les dossiers `en` et `fr` dans `config/translations/`.

Il s'agit des dossiers de traduction, dans la vue d'exemple `Views/pages/home.twig` on utilise la function twig `trans()`, dans l'exemple :
```twig
{{ trans('messages.title') }}
```
La fonction recherche la phrase `title` dans `messages`, elle fait référence aux fichiers `messages.php` dans les dossiers `config/translations/en/` et `config/translations/fr/`:
```php
<?php
// config/translations/fr/messages.php
return [
    'title' => 'Bonjour le monde !'
];
```
```php
<?php
// config/translations/en/messages.php
return [
    'title' => 'Hello world!'
];
```

Twig prendra la phrase qui correspond à la langue utilisée.<br>
Pour modifier la langue par défaut, rendez-vous dans le container `config/container.php` et recherchez ces lignes:
```php
<?php
// Translator
$container['translator'] = function ($container) {
    $loader = new Illuminate\Translation\FileLoader(new Illuminate\Filesystem\Filesystem(), dirname(__DIR__) . '/config/translations');

    // Langue par défaut via la session
    $session = $container['session'];
    if (!$session->has('lang')) {
        $session->set('lang', 'en');
    }

    $translator = new Illuminate\Translation\Translator($loader, $session->get('lang'));
    return $translator;
};
```
Dans les lignes de code au centre, la langue est défini par une variable de session `lang`, vous pouvez très bien remplacer cette méthode par une autre si vous le souhaitez.

Dans notre cas, remplacez `en` par `fr`, assurez-vous d'avoir les dossiers/fichiers de vos langues dans `config/translations/`.

Avec la méthode variable de session pour définir la langue utilisée, vous pouvez la modifier via vos `controllers/middlewares` en remplaçant la valeur `en` par `fr` par exemple.


| Introduction | Chapitre précédent |
| :---------------------: | :--------------: |
| [Introduction](https://github.com/SimonDevelop/slim-doctrine/blob/master/docs/introduction.md) | [Debugger Bar](https://github.com/SimonDevelop/slim-doctrine/blob/master/docs/chapter07.md) |
