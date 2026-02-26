SELECT layout_json
FROM pages
WHERE tema = ?
  AND slug = ?
  AND status = 'published'
LIMIT 1;
