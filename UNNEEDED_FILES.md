Recommended files/folders to remove before submitting to WordPress.org:

- vendor/                -> Development dependencies and test libraries (phpunit, nikic/php-parser). Not needed for production.
- tests/                 -> Unit tests and test configuration.
- phpunit.xml*           -> PHPUnit config files; keep locally, remove from distribution.
- node_modules/          -> JS development dependencies (if present).
- .git/                  -> Git history not needed in zip.
- *.phar, *.dist, *.md   -> Large packaging or developer files not required for runtime.

Note: I did not find a `vendor/` directory in this workspace, but the WordPress review mentioned vendor files. If you have a copy in another branch or subfolder (e.g., `sb-slider/vendor/...`) remove it before packaging.

Also included a `.distignore` file to help exclude many of these when using `wp dist-archive`.
