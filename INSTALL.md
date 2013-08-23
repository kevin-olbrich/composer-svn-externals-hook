# INSTALLATION

#### With composer

1. Add this project in your composer.json:

    ```json
    "scripts": {
        "post-install-cmd": ["php vendor/kevin-olbrich/composer-svn-externals-hook/bin/add-externals.php || exit 0"],
        "post-update-cmd": ["php vendor/kevin-olbrich/composer-svn-externals-hook/bin/add-externals.php || exit 0"],
        "post-package-install": ["php vendor/kevin-olbrich/composer-svn-externals-hook/bin/add-externals.php || exit 0"],
        "post-package-update": ["php vendor/kevin-olbrich/composer-svn-externals-hook/bin/add-externals.php || exit 0"],
        "post-package-uninstall": ["php vendor/kevin-olbrich/composer-svn-externals-hook/bin/add-externals.php || exit 0"],
        "pre-autoload-dump": ["php vendor/kevin-olbrich/composer-svn-externals-hook/bin/add-externals.php || exit 0"],
		"post-autoload-dump": ["php vendor/kevin-olbrich/composer-svn-externals-hook/bin/add-externals.php || exit 0"]
    },
    
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

#### Adding a new svn external

1. Just add a new svn:external to vendor/externals.

2. "svn update" to receive the files.

3. Add an "[external.json](external.json.dist)" file to your external library root directory as described above.

2. Trigger the integration:

    ```bash
    $ php composer.phar update
    ```
