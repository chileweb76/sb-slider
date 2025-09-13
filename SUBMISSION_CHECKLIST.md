# WordPress.org Submission Checklist for SB Slider

This checklist prepares the plugin for WordPress.org review and submission.

1. Sanity checks
   - [ ] Confirm `readme.txt` header fields match plugin header (`Text Domain`, `Stable tag`, `Requires at least`, `Tested up to`).
   - [ ] Ensure `Text Domain` in plugin header is `sb-slider` and `load_plugin_textdomain()` uses the same.

2. Security & Hardening
   - [ ] All PHP files include `if ( ! defined( 'ABSPATH' ) ) exit;` at the top.
   - [ ] Nonces and capability checks on save handlers (metaboxes/settings) are present.
   - [ ] Sanitize on input and escape on output for all user-supplied data.

3. i18n
   - [ ] `languages/sb-slider.pot` exists and contains all translatable strings.
   - [ ] Use `esc_html__()`, `esc_html_e()`, `esc_attr__()`, `esc_attr_e()`, `__()`, `_e()` appropriately.

4. Packaging
   - [ ] Remove development files from distribution (use `.distignore`).
   - [ ] Create a distribution ZIP using `wp dist-archive` or `rsync`+`zip` with `.distignore`.
   - [ ] Test the ZIP by installing on a clean WordPress instance.

5. Final tests
   - [ ] Activate plugin and verify admin settings page loads.
   - [ ] Create a slide (post type) and verify metabox fields save and sanitize correctly.
   - [ ] Place `[sb_slider]` shortcode on a page and verify front-end output and styles.

6. Submit
   - [ ] Verify `readme.txt` meets WordPress.org readme guidelines.
   - [ ] Submit the plugin ZIP to the WordPress.org plugin review form and respond to reviewer feedback promptly.
