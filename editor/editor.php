<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<title>Mini Elementor - Step 1</title>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="editor.css">
</head>

    <body>

<?php
$tema  = $_GET['tema'] ?? null;
$page  = $_GET['page'] ?? null;

$layoutData = null;

if ($tema && $page) {
  $file = __DIR__ . "/siti/$tema/$page.json";
  if (file_exists($file)) {
    $layoutData = json_decode(file_get_contents($file), true);
  }
}
?>

<div id="editor">

<div id="tabs">
  <ul>
    <li><a href="#palette">Elementi</a></li>
    <li><a href="#widget-details">Dettagli</a></li>
    <li><a href="#global">Global</a></li>
    </ul>
    <div id='palette'>
        <div id="accordion" class="accordion">
        
        <!-- widgets ----------------------------------------------- -->
        <h3 class="" aria-expanded="true" aria-selected="true">Widget</h3>
            <div>
                <ul class="widget-list">

                <?php  foreach (glob('widgets/*.php') as $file): ?>
                <?php   $name = basename($file, '.php');  ?>
            
                    <div  class="palette-widget" data-widget="<?= $name ?>" data-type="<?= $name ?>" data-kind="widget">
                        <?= ucfirst($name) ?>
                    </div>
                <?php endforeach;  ?>
                </ul>
            </div>

                <!-- plugins ----------------------------------------------- -->
        <h3 class="">Plugin</h3>        
            <div>
                <ul class="widget-list">
                
                <?php foreach (glob('plugins/*.php') as $file): ?>
                <?php $name = basename($file, '.php'); ?>
                
                <div class="palette-widget" data-widget="<?= $name ?>" data-type="<?= $name ?>" data-kind="plugin">
                    <?= ucfirst($name) ?>
                </div>
                <?php endforeach; ?>
                </ul>
            </div>  
    </div> <!-- palette -->    

</div> <!-- accordion -->


  <!-- DETTAGLI -->
    <div id="widget-details">

        <div class="panel-header"></div>
        <div class="panel-body accordion"></div>
        <div class="panel-footer"></div>
    </div><!-- elementi/dettagli -->
     

        <!-- impostazioni globali---------------------------- -->
    <div id="global">
                <!-- 🎨 COLORI -->
                <section class="style-section">
                    <label> 🎨 COLORI</label>
                    <br><br>

                    <div class="style-control" style="display: flex;">
                        <label>Primary</label>
                        <input type="color" value="#3366ff" data-global-color="primary">
                        </div>
                    <div class="style-control" style="display: flex;">
                        <label>Secondary</label>
                        <input type="color" value="#ff6633" data-global-color="secondary">              
                        </div>
                    <div class="style-control" style="display: flex;">
                        <label>Accent</label>
                        <input type="color" value="#ffa500" data-global-color="accent">
                    </div>
                    <div class="style-control" style="display: flex;">
                        <label>Testo</label>
                        <input type="color" value="#222222" data-global-color="text">
                    </div>
                    <div class="style-control" style="display: flex;">
                        <label>Sfondo</label>
                        <input type="color" value="#ffffff" data-global-color="bg">
                </section>

                <!-- 🔤 TIPOGRAFIA -->
                <section class="style-section">
                     <label>🔤 TIPOGRAFIA</label>
                    <br><br>
                    <div class="style-group" style="display: flex;">
                    <label>Font titoli</label>
                    <select data-site-font="heading-family">
                        <option value="Inter">Inter</option>
                        <option value="Montserrat">Montserrat</option>
                        <option value="Poppins">Poppins</option>
                        <option value="Roboto">Roboto</option>
                    </select>
                    </div>
                    <div class="style-group" style="display: flex;">
                    <label>Stile titoli</label>
                    <select data-site-font="heading-weight">
                        <option value="400">Regular</option>
                        <option value="600">Semi-bold</option>
                        <option value="700">Bold</option>
                    </select>
                    </div>

                    <div class="style-group" style="display: flex;">
                    <label>Font body</label>
                    <select data-site-font="body-family">
                        <option value="Inter">Inter</option>
                        <option value="Montserrat">Montserrat</option>
                        <option value="Poppins">Poppins</option>
                        <option value="Roboto">Roboto</option>
                    </select>
                    </div>

                    <div class="style-group" style="display: flex;">
                    <label>Stile body</label>
                    <select data-site-font="body-weight">
                        <option value="400">Regular</option>
                        <option value="500">Medium</option>
                    </select>
                    </div>
                </section>
        <!--SALVATAGGIO CONFIGURAZIONE  -->
                <button id="saveSiteConfig" class="button2">💾 Salva Impostazioni</button>
                <span id="siteConfigStatus"></span>
            
    </div> <!-- global -->
</div> <!-- tabs -->

    <!-- CANVAS -->
    <div class="canvas-panel">
                <div style="display: flex; gap: 250px; align-items: center; margin-bottom: 20px;">
                    <div>
                        <button id="save-layout" class="button2">Pubblica</button>
                    </div>
                    <div>     
                        <h2 style="text-align:center">Layout del tema <span style="color: black"><?=$tema?></span> pagina <span style="color: black"><?=$page?></span></h2>  
                    </div>
                </div> 


        <div>
            <div id="canvas" class="canvas">    
            </div>
            <button id="add-section" class="add-section-btn">➕ Sezione</button>
        </div>
       
    </div>  
   
</div> <!--#editor-->


<script>
window.EDITOR_CONFIG = {
  tema: "<?= htmlspecialchars($tema) ?>",
  page: <?= $page ? '"' . htmlspecialchars($page) . '"' : 'null' ?>
};

window.INITIAL_LAYOUT = <?= json_encode($layoutData) ?>;
</script>

 <script>
  $( function() {
    $( "#accordion" ).accordion({
        header: "h3",
        heightStyle: 'content',   
        collapsible: true,
        active: 0,  
        icons: { header: 'ui-icon-triangle-1-e', activeHeader: 'ui-icon-triangle-1-s' }
            });
            
    $( ".accordion" ).accordion({
        header: "h3",
        heightStyle: 'content',  
        collapsible: true,
        active: 0,  
        icons: { header: 'ui-icon-triangle-1-e', activeHeader: 'ui-icon-triangle-1-s' }
            });
     $( function() {
    $( "#tabs" ).tabs();
  } );        
  } );
 </script>

<script src="editor.js"></script>
<script src="editor-widgets.js"></script>
<script src="editor-dragdrop.js"></script>
<script src="editor-inspector.js"></script>
<script src="editor-state.js"></script>
<script src="editor-render.js"></script>
<script src="editor-core.js"></script>


</body>
</html>