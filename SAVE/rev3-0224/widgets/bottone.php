<?php 

echo "<button><a class='widget widget-button' href='<?= htmlspecialchars($props['url] ?? '#') ?>'><?= htmlspecialchars($props['text'] ?? 'LINK') ?></a></button>";
