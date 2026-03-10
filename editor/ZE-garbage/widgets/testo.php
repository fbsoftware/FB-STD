<?php
$content = $widget['props']['content'] ?? '';
$align   = $widget['props']['align'] ?? 'left';

echo "<div class='widget widget-text' style='text-align:$align'>";
echo nl2br(htmlspecialchars($content));
echo "</div>";

