Packaging checklist for WordPress.org submission

1) Remove development artifacts
   - Delete any `vendor/` folder (composer dev deps), `tests/`, `node_modules/`, and `phpunit.xml*` files.
   - Remove `.git/` if packaging manually (wp dist-archive will ignore it if using `.distignore`).

2) Ensure all PHP files are safe
   - Each PHP file should start with `if ( ! defined( 'ABSPATH' ) ) exit;`.
   - No files should write into the plugin directory (use uploads or DB instead).

3) i18n and readme
   - Confirm `Text Domain` in plugin header is `scrapbook-slider` and matches `load_plugin_textdomain()` and `readme.txt`.
   - Include a proper `readme.txt` following the WordPress.org readme standard.

4) Assets and build
   - Keep only production assets (minified JS/CSS) in the plugin root.
   - If you build assets, do not commit source `src/` or build scripts unless needed; add to `.distignore`.

5) Use `.distignore` and `wp dist-archive`
   - `.distignore` already added. Use the following to create a clean ZIP (requires WP-CLI):

```bash
# from the repository root
wp dist-archive --format=zip --exclude-from=.distignore .
```

This produces a zip that excludes files listed in `.distignore`.

6) Final smoke test
   - Install the zip on a clean WP install, activate, test settings, metabox saves, shortcodes, and front-end CSS.

7) Submit
   - Follow WordPress.org plugin submission guidelines.
