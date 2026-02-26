<?php
$src = $widget['props']['src'] ?? '';
$alt = $widget['props']['alt'] ?? '';

if (!$src) return;

echo '<div class="widget widget-image">';
echo '<img src="' . htmlspecialchars($src) . '" alt="' . htmlspecialchars($alt) . '">';
echo '</div>';
