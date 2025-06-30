# typo3-v13-exampleRepo

Modern TYPO3 v13+ demo distribution with Content Blocks, MASK, and automated demo content import. Clean, accessible, and best-practice setup for agencies and freelancers.

[![License: GPL-2.0-or-later](https://img.shields.io/badge/License-GPL%202.0%20or%20later-blue.svg)](LICENSE)
[![TYPO3 v13](https://img.shields.io/badge/TYPO3-v13-orange.svg)](https://typo3.org/)

> **Note:** This repository is prepared for sharing on GitHub. The deployment pipeline is currently **disabled** (see `deploy.yaml.disabled`).

---

Author: [Fynn Menk](https://github.com/FynnMenkIT)
Repository: https://github.com/FynnMenkIT/typo3-v13-exampleRepo

---

## Quickstart

**Recommended:** Use the following command to set up the project with all demo content, page tree, and assets:

```bash
ddev typo3-init
```

> **Note:** [ddev](https://ddev.readthedocs.io/en/stable/) must be installed on your host system. For details, see the [official documentation](https://ochorocho.gitlab.io/typo3-distribution-docs/).

---

## Features
- TYPO3 v13, Composer-based, clean project structure
- Parallel use of MASK and Content Blocks (no field/key overlap)
- Modern Content Blocks (teaser, cta, statsbox, accordion) with independent fields
- Vue.js frontend scaffolded and integrated
- All RTE fields correctly configured and rendered
- Automated demo content import (page tree, all demo elements on page id 6)
- Best practices for accessibility, code quality, and maintainability

---

## Manual Setup (Alternative)

1. **Start and install:**
   ```bash
   ddev start
   ddev composer install
   ddev typo3 setup
   ```
2. **Prepare and build frontend:**
   ```bash
   ddev npm install
   ddev npm run build:production
   ```
3. **Initialize data (page tree, demo content, assets):**
   ```bash
   ddev typo3 extension:setup
   ddev composer dumpautoload
   ```
4. **Show project info:**
   ```bash
   ddev describe
   ```

---

## Frontend Development

- All assets (SCSS, JS, images, fonts) are in `assets/` and processed by [Vite.js](https://vitejs.dev/).
- Output is stored in `packages/site-distribution/Resources/Public/`.

**NPM Scripts:**
- Watch for changes: `ddev npm run watch`
- Build for development: `ddev npm run build:development`
- Build for production: `ddev npm run build:production`

**Vite Add-on:**
- Already installed after `ddev typo3-init`.
- Run dev server: `ddev vite`

---

## Demo Content & Data Import

- The setup script (`ddev typo3-init`) automatically imports the demo page tree and all demo content elements (MASK & Content Blocks) for a ready-to-use backend and frontend demo.
- Demo content is inserted via data.xml and is visible after setup.
- If you need to re-import, rerun the setup script.

---

## MASK & Content Blocks: Parallel Operation & Migration

- **MASK** remains for legacy/custom elements. Templates: `packages/mask_elements/Resources/Private/Templates/ContentElements/`.
- **Content Blocks** are defined in `packages/site-distribution/ContentBlocks/ContentElements/` with YAML and Fluid templates.
- Both systems run in parallel, with strictly separated field names and database columns (no overlap, no data conflicts).
- All Content Blocks use their own field names and tables (see YAML configs and SQL structure).
- RTE fields are always `type: Textarea` + `enableRichtext: true` and rendered with `{data.field -> f:format.html()}`.
- For migration, see the [official Content Blocks migration documentation](https://docs.typo3.org/p/friendsoftypo3/content-blocks/main/en-us/Migration/Mask.html).

---

## Best Practices & Troubleshooting

- **Accessibility:** All templates use semantic HTML and ARIA where needed.
- **Frontend:** Modern toolchain (Vite, SCSS, JS, Vue.js), see `package.json` for dependencies.
- **Backend:** Clean TCA, TypoScript, and YAML configs. No field overlap between MASK and Content Blocks.
- **RTE fields:** Always check for correct configuration and rendering.
- **Demo content:** If demo elements are missing, check the setup script and SQL import.
- **Extension setup:** Use `ddev typo3 extension:setup` and `ddev composer dumpautoload` after changes.

---

## Quality Assurance

- Run PHPStan:
  ```bash
  ddev exec ./vendor/bin/phpstan analyse -c .phpstan.neon --no-progress
  ```
- Run PHP CS Fixer:
  ```bash
  ddev exec ./vendor/bin/php-cs-fixer fix --dry-run --diff
  ```

---

## Deployment

- Example config: `deploy.yaml` (for [Deployer](https://deployer.org/))
- Run locally for testing:
  ```bash
  ./vendor/bin/dep deploy -vvv staging
  ```

---

## Scheduler CronJob

- The [ddev-cron](https://github.com/ddev/ddev-cron) add-on is installed during `ddev typo3-init`.
- To install manually: `ddev get ddev/ddev-cron`
- If xdebug is enabled, the scheduler CronJob is not executed.
- Run the scheduler manually:
  ```bash
  ddev typo3-scheduler # -f or --force to run it while xdebug is enabled
  ```

---

## Mail & Database GUIs

- **Mailpit:** Start with `ddev launch -m` to access emails sent by TYPO3.
- **Database GUIs:**
  - [phpMyAdmin](https://www.phpmyadmin.net/): `ddev get ddev/ddev-phpmyadmin`
  - [Adminer](https://www.adminer.org/): `ddev get ddev/ddev-adminer`

---

## External Documentation

- [TYPO3 Documentation](https://docs.typo3.org/)
- [DDEV Documentation](https://ddev.readthedocs.io/en/stable/)
- [Vite Add-on](https://github.com/s2b/ddev-vite-sidecar)
- [Vite.js](https://vitejs.dev/)
- [Deployer](https://deployer.org/docs/7.x/basics)
- [Content Blocks Migration](https://docs.typo3.org/p/friendsoftypo3/content-blocks/main/en-us/Migration/Mask.html)

---

## License

GPL-2.0 or later
