UPDATE pages
SET layout_json = :json,
    status = 'draft'
WHERE tema = :tema
  AND slug = :slug;
