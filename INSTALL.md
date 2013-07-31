# INSTALLATION

#### With composer

1. Add this project in your composer.json:

    ```json
    "require": {
        "kevin-olbrich/composer-svn-externals-hook": "1.0.*@dev"
    }
    ```
    
2. Create the folder vendor/externals and add an svn-external.

3. Add an "[external.json](external.json.dist)" file to your external library root directory including the root-namespace of your lib. You can commit this file to your svn to use the external mechanism in a team.

4. Now tell composer to download composer-svn-externals-hook by running the command:

    ```bash
    $ php composer.phar update
    ```

#### Post installation

1. Enabling it in your root `composer.json` file.

    ```json
    "scripts": {
        "post-install-cmd": ["php vendor/kevin-olbrich/composer-svn-externals-hook/bin/add-externals.php"],
        "post-update-cmd": ["php vendor/kevin-olbrich/composer-svn-externals-hook/bin/add-externals.php"],
        "post-package-install": ["php vendor/kevin-olbrich/composer-svn-externals-hook/bin/add-externals.php"],
        "post-package-update": ["php vendor/kevin-olbrich/composer-svn-externals-hook/bin/add-externals.php"],
        "post-package-uninstall": ["php vendor/kevin-olbrich/composer-svn-externals-hook/bin/add-externals.php"],
        "pre-autoload-dump": ["php vendor/kevin-olbrich/composer-svn-externals-hook/bin/add-externals.php"],
        "post-autoload-dump": ["php vendor/kevin-olbrich/composer-svn-externals-hook/bin/add-externals.php"]
    },
    ```
