<?php 
echo "test per separatore";
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
.hr-with-icon {
    display: flex;
    align-items: center;
    width: 100%;
    gap: var(--gap);
    margin: 0;
}

.hr-with-icon::before,
.hr-with-icon::after {
    content: "";
    flex: 1 1 auto;
    height: var(--thickness);
    background: var(--line-color);
}

.hr-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: var(--icon-bg);
    padding: 6px;
    border-radius: 999px;
    line-height: 1;
}

.hr-icon i {
    font-size: var(--icon-size);
    color: var(--icon-color);
}

</style>
</head>
<body>
<?php
function hr_icon(
    $icon = 'fab fa-google',   // icona Font Awesome
    $thickness = '4px',        // spessore linea
    $lineColor = '#d0d0d0',    // colore linea
    $iconColor = '#DB4437',    // colore icona
    $iconSize = '22px',        // dimensione icona
    $gap = '12px',             // spazio tra linea e icona
    $iconBg = '#ffffff'        // sfondo del "cerchio" dell'icona
){
    return "
    <div class='hr-with-icon' style=\"
        --thickness: $thickness;
        --line-color: $lineColor;
        --icon-size: $iconSize;
        --gap: $gap;
        --icon-bg: $iconBg;
        --icon-color: $iconColor;
    \">
        <span class='hr-icon'>
            <i class='$icon'></i>
        </span>
    </div>
    ";
}
?>


 <?php 
echo hr_icon('fas fa-star', '3px', '#000', '#f1c40f', '24px');
?>   
</body>
</html>
