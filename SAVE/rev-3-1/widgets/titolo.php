<?php
$content = $widget['props']['content'] ?? '';

echo '<h1 class="widget widget-title">';
echo htmlspecialchars($props['content']) ?? '';
echo '</h1>';