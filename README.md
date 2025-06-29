# TYPO3 Distribution - GitLab Project Template

Get going quickly with TYPO3 CMS and GitLab.

## Quickstart

Use the following ddev command to set up the template:

```bash
ddev typo3-init
```

**NOTE**

> For the quickstart, you have **[ddev](https://ddev.readthedocs.io/en/stable/)** to
be installed on your host system. For further details, head over to the **official [documentation](https://ochorocho.gitlab.io/typo3-distribution-docs/)**.

## All commands - manual setup

Configure ddev, install packages and start the ddev instance:
```bash
ddev start
ddev composer install
ddev typo3 setup
```

Prepare and build frontend:
```bash
ddev npm install
ddev npm run build:production
```

Initialize data (page tree and link assets):
```bash
ddev typo3 extension:setup
ddev composer dumpautoload
```

Display all your project related information:
```bash
ddev describe
```

## Mail GUI

Start the built-in [Mailpit](https://github.com/axllent/mailpit) to access emails sent by TYPO3:
```bash
ddev launch -m
```

## Database GUI

To access the database via a web GUI, you can install e.g. [phpmyadmin](https://www.phpmyadmin.net/)
`ddev get ddev/ddev-phpmyadmin` or [adminer](https://www.adminer.org/de/) `ddev get ddev/ddev-adminer`.

## Use the [DDEV Vite Add-on](https://github.com/s2b/ddev-vite-sidecar)

**NOTE**

> The addon is already available after `ddev typo3-init` has completed.

Install:
```bash
ddev get s2b/ddev-vite-sidecar
ddev restart
```

Run the Vite dev server:
```bash
ddev vite
```

## Files and folders

The folder `packages` contains all your local extension/packages.
Require these packages simply by using `composer req vendor/package:@dev`

`assets` contains all scss, javascript, images and fonts which will be processed
by [Vite.js](https://vitejs.dev/) and stored in `packages/site-distribution/Resources/Public/`.

## Npm Scripts / Vite.js

The frontend toolchain uses NPM and Vite.js with a few loaders to ...
  * Compile scss to css (`assets/Scss`)
  * Bundle javascript (`assets/JavaScript`)
  * Copy images (`assets/Image`) and fonts (`assets/Fonts`) to the Public folder of EXT:site-distribution

Watch for changes in js/scss files:
```bash
ddev npm run watch
```

Build JS, CSS for development use (not compressed/optimized):
```bash
ddev npm run build:development
```

Build JS, CSS for production use:
```bash
ddev npm run build:production
```

## QA / Analysis

Run PHPStan:
```bash
ddev exec ./vendor/bin/phpstan analyse -c .phpstan.neon --no-progress
```

PHP CS Fixer:
```bash
ddev exec ./vendor/bin/php-cs-fixer fix --dry-run --diff
```

## Deployer

`deploy.yaml` contains an example configuration for deployer
(PHP deployment tool). It's recommended to run [deployer](https://deployer.org/)
in GitLab CI.

Run deployer locally (only for testing):
```bash
./vendor/bin/dep deploy -vvv staging
```

## Scheduler CronJob

To run a CronJob in ddev the plugin "ddev-cron" is required.
The add-on is installed during `ddev typo3-init`.
To install it manually run `ddev get ddev/ddev-cron`.
In case xdebug is enabled the scheduler CronJob is not executed.

Run the scheduler manually:
```bash
ddev typo3-scheduler # -f or --force to run it while xdebug is enabled
```

## External documentation

  * TYPO3 - https://docs.typo3.org/
  * DDEV - https://ddev.readthedocs.io/en/stable/
    * Vite Add-on - https://github.com/s2b/ddev-vite-sidecar
  * Vite.js - https://vitejs.dev/
  * Deployer - https://deployer.org/docs/7.x/basics

## License

GPL-2.0 or later
