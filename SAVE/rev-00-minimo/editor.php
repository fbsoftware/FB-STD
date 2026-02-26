<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<title>Mini Elementor - Step 1</title>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<link rel="stylesheet"
      href="https://code.jquery.com/ui/1.13.2/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="style.css">
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
    <div id='palette'>
            
        <div id="accordion">
        
        <!-- widgets ----------------------------------------------- -->
        <h3 class="pink" aria-expanded="true" aria-selected="true">Widget</h3>
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
        <h3 class="pink">Plugin</h3>        
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



        
                <!-- impostazioni globali---------------------------- -->
        <h3 class="pink" aria-expanded="true" aria-selected="true">Impostazioni globali</h3>
            <div>

                <!-- 🎨 COLORI -->
                
                <section class="style-section">
                    <label style="font-weight:bold, color:red; font-family:Montserrat ";>🎨 COLORI<label>
                    <br>
                    <div class="style-control">
                        <label>Primary</label>
                        <input type="color" data-theme-color="primary">
                    </div>
                    <div class="style-control">
                        <label>Secondary</label>
                        <input type="color" data-theme-color="secondary">
                    </div>
                    <div class="style-control">
                        <label>Accent</label>
                        <input type="color" data-theme-color="accent">
                    </div>
                    <div class="style-control">
                        <label>Testo</label>
                        <input type="color" data-theme-color="text">
                    </div>
                </section>

                <!-- 🔤 TIPOGRAFIA -->
                <section class="style-section">
                     <label style="font-weight:bold, color:red; font-family:Montserrat ";>🔤 TIPOGRAFIA<label>
                    <br>
                    <div class="style-group">
                    <label>Font titoli</label>
                    <select data-theme-font="heading-fontFamily">
                        <option value="Inter">Inter</option>
                        <option value="Montserrat">Montserrat</option>
                        <option value="Poppins">Poppins</option>
                        <option value="Roboto">Roboto</option>
                    </select>
                    <label>Stile titoli</label>
                    <select data-theme-font="heading-weight">
                        <option value="400">Regular</option>
                        <option value="600">Semi-bold</option>
                        <option value="700">Bold</option>
                    </select>
                    </div>

                    <div class="style-group">
                    <label>Font body</label>

                    <select data-theme-font="body-family">
                        <option value="Inter">Inter</option>
                        <option value="Montserrat">Montserrat</option>
                        <option value="Poppins">Poppins</option>
                        <option value="Roboto">Roboto</option>
                    </select>

                    <label>Stile body</label>
                    <select data-theme-font="body-weight">
                        <option value="400">Regular</option>
                        <option value="500">Medium</option>
                    </select>
                    </div>
                </section>

            </div>    
        </div> <!-- accordion -->
    </div> <!-- palette -->

    <!-- CANVAS -->
    <div class="canvas-panel">
                <div>     
                <h3 class="pink">Layout del tema <?=$tema?> pagina <?=$page?></h3>  
                </div> 
        <div>
            <div id="canvas" class="canvas">
            </div>
            <button id="add-section" class="add-section-btn">➕ Sezione</button>
        </div>
       
    </div>  

  <!-- DETTAGLI -->
    <div id="widget-details">
        <div>
        <button id="save-layout">Pubblica</button>
        </div>
        <div class="panel-header">
         
        </div>
        
        <div class="panel-body">
            <div class="panel-placeholder">
            Seleziona un elemento
            </div>
        </div>

        <div class="panel-footer"> </div>
    </div>
    
</div> <!--#editor-->

<!--===========================================================================================-->
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
        heightStyle: 'content',   // 'auto' | 'fill' | 'content'
        collapsible: true,
        active: 0,  
        icons: { header: 'ui-icon-triangle-1-e', activeHeader: 'ui-icon-triangle-1-s' }
            });
  } );
  </script>
<script src="core/state.js"></script>
<script src="panels/style-panel.js"></script>
<script src="app.js"></script>

</body>
</html>
