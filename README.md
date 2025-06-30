# TYPO3 Headless Project

This project is based on TYPO3 and prepared for use as a headless CMS. Content is delivered as a JSON API, and the frontend is built with modern frameworks like Vue.js.

## Quickstart

### Backend (TYPO3, DDEV)

1. Start DDEV and install dependencies:
   ```bash
   ddev start
   ddev composer install
   ```
2. Run TYPO3 setup:
   ```bash
   ddev typo3 setup
   ```
3. Install the headless extension (already included):
   ```bash
   ddev composer require friendsoftypo3/headless
   ```
4. Activate the extension in the TYPO3 backend.
5. The headless API is available at `/?type=1533906440`.

### Frontend (Vue.js + Vite)

The frontend is located in the `frontend/` folder and uses Vue 3 + Vite. Start development with:

```bash
cd frontend
npm install
npm run dev
```

The app loads data directly from TYPO3 Headless (`/?type=1533906440`).

## Headless Configuration

- The file `packages/site-distribution/Configuration/Sets/Main/headless.typoscript` provides the JSON output.
- The headless configuration is included in `setup.typoscript`.

## Project Structure

- All local extensions/packages are in the `packages` folder. Require them via `composer req vendor/package:@dev`.
- `assets` contains all SCSS, JavaScript, images, and fonts, processed by [Vite.js](https://vitejs.dev/) and output to `packages/site-distribution/Resources/Public/`.

## NPM Scripts / Vite.js

- Compile SCSS to CSS (`assets/Scss`)
- Bundle JavaScript (`assets/JavaScript`)
- Copy images (`assets/Image`) and fonts (`assets/Fonts`) to the public folder of EXT:site-distribution

Watch for changes in JS/SCSS files:
```bash
ddev npm run watch
```

Build JS/CSS for development (not minified):
```bash
ddev npm run build:development
```

Build JS/CSS for production:
```bash
ddev npm run build:production
```

## Quality Assurance

Run PHPStan:
```bash
ddev exec ./vendor/bin/phpstan analyse -c .phpstan.neon --no-progress
```

Run PHP CS Fixer:
```bash
ddev exec ./vendor/bin/php-cs-fixer fix --dry-run --diff
```

## Deployment

`deploy.yaml` contains an example configuration for [Deployer](https://deployer.org/).
Run deployer locally (for testing):
```bash
./vendor/bin/dep deploy -vvv staging
```

## Scheduler CronJob

To run a CronJob in ddev, the plugin "ddev-cron" is required. Install it with:
```bash
ddev get ddev/ddev-cron
```
If xdebug is enabled, the scheduler CronJob is not executed.

Run the scheduler manually:
```bash
ddev typo3-scheduler # -f or --force to run it while xdebug is enabled
```

## External Documentation

- [TYPO3 Documentation](https://docs.typo3.org/)
- [DDEV Documentation](https://ddev.readthedocs.io/en/stable/)
  - [Vite Add-on](https://github.com/s2b/ddev-vite-sidecar)
- [Vite.js](https://vitejs.dev/)
- [Deployer](https://deployer.org/docs/7.x/basics)

## License

GPL-2.0 or later

# Best Practices for MASK Content Elements

- Custom templates for content elements are in `EXT:mask_elements/Resources/Private/Templates/ContentElements/`.
- Custom partials/layouts for reuse and structure are in `Partials/` and `Layouts/`.
- TypoScript includes the template root paths (see `mask_elements.typoscript`).
- Generated MASK templates in the `Mask/Frontend` folder are not modified.
- `mask.json` is the central definition for fields, TCA, and SQL.
- Fluid templates use semantic HTML and accessibility (e.g., ARIA attributes, meaningful headings).
- Migration to Content Blocks is easy due to clear field names and structure.

See `mask.json` and `Templates/ContentElements/Teaser.html` for a Teaser element example.
