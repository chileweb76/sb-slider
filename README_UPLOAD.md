SB Slider — Upload & Packaging Notes

This file documents the commands and steps used to produce an upload-ready ZIP for the WordPress.org plugin repository.

Create the distribution ZIP (requires `rsync` and `zip`):

```bash
# from the repository root
rm -rf /tmp/sb-slider-dist || true
mkdir -p /tmp/sb-slider-dist
rsync -a --exclude-from='.distignore' . /tmp/sb-slider-dist/
cd /tmp
zip -r /path/to/your/repo/sb-slider-dist.zip sb-slider-dist
rm -rf /tmp/sb-slider-dist
```

Alternative (if you have WP-CLI with dist commands):

```bash
# from the repository root
wp dist-archive --format=zip --exclude-from=.distignore .
```

Smoke test locally (recommended):

1. Install WordPress locally (e.g., using LocalWP, Docker, or WP-CLI + built-in PHP server).
2. Upload and activate `sb-slider-dist.zip` via the admin Plugins page.
3. Verify:
   - Settings page loads and saves without errors.
   - New slides (post type `sb_slider`) can be added and the metabox fields save correctly.
   - Shortcode `[sb_slider]` renders without PHP notices and styles/scripts load.

Commit policy: the generated ZIP is not committed by default to avoid binary artifacts in the repository. Commit only if you want the packaged ZIP stored in the repo.
