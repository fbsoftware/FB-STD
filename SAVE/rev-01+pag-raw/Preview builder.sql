SELECT layout_json
FROM pages
WHERE tema = ?
  AND slug = ?
LIMIT 1;
