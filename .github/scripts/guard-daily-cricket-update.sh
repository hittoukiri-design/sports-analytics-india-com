#!/usr/bin/env bash
set -euo pipefail

echo "Checking BOBI automation safety boundaries..."

changed_files="$(
  {
    git diff --name-only
    git diff --cached --name-only
    git ls-files --others --exclude-standard
  } | sort -u
)"

blocked=0
if [ -n "$changed_files" ]; then
  while IFS= read -r path; do
    [ -z "$path" ] && continue
    case "$path" in
      data/cricket.json|index.php|page-template.php|blog/index.php|sitemap.xml|assets/img/articles/*|*-vs-*/index.php)
        ;;
      *)
        echo "::error file=$path::BOBI automation may not change this path."
        blocked=1
        ;;
    esac
  done <<EOF
$changed_files
EOF
fi

required_home_markers=(
  "require_once __DIR__ . '/includes/config.php'"
  "GameHub India Guide 2026: Register, Login, Bonus, Games & Withdrawal"
  "require __DIR__ . '/includes/header.php'"
  "require __DIR__ . '/includes/footer.php'"
)
for marker in "${required_home_markers[@]}"; do
  if ! grep -Fq "$marker" index.php; then
    echo "::error file=index.php::Missing protected homepage marker: $marker"
    blocked=1
  fi
done

if ! grep -Fq 'id="bobi-visit-stats"' includes/footer.php ||
   ! grep -Fq '?bobi_admin=1' includes/footer.php ||
   ! grep -Fq 'data-visit-endpoint="/api/visit-signal.php"' includes/header.php; then
  echo "::error::BOBI admin counter or visitor endpoint marker is missing."
  blocked=1
fi

for php_file in index.php page-template.php includes/config.php includes/header.php includes/footer.php; do
  php -l "$php_file"
done

php -r 'json_decode(file_get_contents("data/cricket.json"), true, 512, JSON_THROW_ON_ERROR); echo "cricket json ok\n";'
xmllint --noout sitemap.xml

home_render="$(mktemp)"
article_render="$(mktemp)"
trap 'rm -f "$home_render" "$article_render"' EXIT
php -d display_errors=1 -r '$_SERVER["REQUEST_URI"]="/"; include "index.php";' > "$home_render"
php -d display_errors=1 -r '$_SERVER["REQUEST_URI"]="/cricket-betting-india/"; include "page-template.php";' > "$article_render"

if ! grep -Fq '<h1>GameHub India Guide 2026: Register, Login, Bonus, Games & Withdrawal</h1>' "$home_render"; then
  echo "::error file=index.php::Homepage smoke render lost the protected H1."
  blocked=1
fi
if grep -Eqi 'fatal error|warning:|parse error' "$home_render" "$article_render"; then
  echo "::error::PHP smoke render emitted an error or warning."
  blocked=1
fi

if [ "$blocked" -ne 0 ]; then
  echo "BOBI safety guard failed. No commit will be pushed."
  exit 1
fi

echo "BOBI safety guard passed."
