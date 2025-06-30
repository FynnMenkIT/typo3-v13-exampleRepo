# TYPO3 Headless Projekt

Dieses Projekt basiert auf TYPO3 und ist für die Nutzung als Headless-CMS vorbereitet. Die Ausgabe erfolgt als JSON-API, das Frontend wird mit modernen Frameworks wie Vue.js realisiert.

## Quickstart

### Backend (TYPO3, DDEV)

1. DDEV starten und Abhängigkeiten installieren:
   ```bash
ddev start
ddev composer install
   ```
2. TYPO3 Setup ausführen:
   ```bash
ddev typo3 setup
   ```
3. Headless-Extension installieren (bereits enthalten):
   ```bash
ddev composer require friendsoftypo3/headless
   ```
4. Extension im TYPO3-Backend aktivieren.
5. Die Headless-Ausgabe ist unter `/?type=1533906440` erreichbar.

### Frontend (Vue.js + Vite)

Das Frontend befindet sich im Ordner `frontend/` und basiert auf Vue 3 + Vite. Starte die Entwicklung mit:

```bash
cd frontend
npm install
npm run dev
```

Die App lädt Daten direkt aus TYPO3 Headless (`/?type=1533906440`).

## Headless-Konfiguration

- Die Datei `packages/site-distribution/Configuration/Sets/Main/headless.typoscript` stellt die JSON-Ausgabe bereit.
- In `setup.typoscript` ist die Headless-Konfiguration bereits eingebunden.

## Hinweise

- Alle GitLab- und Import-Hinweise wurden entfernt.
- Das Projekt ist für moderne Headless- und API-Workflows vorbereitet.

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

# Best Practices für MASK-Inhaltselemente

- Eigene Templates für Inhaltselemente liegen in `EXT:mask_elements/Resources/Private/Templates/ContentElements/`.
- Eigene Partials/Layouts für Wiederverwendung und Struktur in `Partials/` und `Layouts/`.
- TypoScript bindet die Template-RootPaths ein (siehe `mask_elements.typoscript`).
- Die generierten MASK-Templates im `Mask/Frontend`-Ordner werden nicht angepasst.
- Die `mask.json` ist die zentrale Definition für Felder, TCA und SQL.
- Fluid-Templates nutzen semantisches HTML und Barrierefreiheit (z. B. ARIA-Attribute, sinnvolle Überschriften).
- Migration zu Content Blocks ist durch sprechende Feldnamen und klare Struktur einfach möglich.

Beispiel für ein Teaser-Element siehe `mask.json` und `Templates/ContentElements/Teaser.html`.
