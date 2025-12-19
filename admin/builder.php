<?php session_start();      ob_start();
/**
    Fausto Bresciani   fbsoftware@libero.it  www.faustobresciani.it
    package		FB open template
    versione 3.1
    copyright	Copyright (C) 2025 - 2026 FB. All rights reserved.
    license		GNU/GPL
    Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
    all'uso anche improprio di FB open template.
    ------------------------------------------------
    gestione tabella 'lay'
    15/12/2025	nuova struttura builder con drag & drop
============================================================================= */
 ?>
 <style>
#widgets-panel {
    width: 30%;
    float: left;
    padding: 10px;
    background: #f0f0f0;
}

#canvas {
    width: 30%;
    float: right;
    padding: 10px;
    background: #fafafa;
}

#right {
    width: 40%;
    float: right;
    padding: 10px;
    background: #fafafa;
}

#sortable {
    list-style: none;
    padding: 0;
}

.canvas-item {
    background: white;
    border: 1px solid #ccc;
    padding: 8px;
    margin-bottom: 5px;
    cursor: grab;
}

.add-widget {
    background: #ddd;
    padding: 8px;
    margin-bottom: 10px;
    cursor: pointer;
}

.del {
    float: right;
    color: red;
    cursor: pointer;
}
.builder-container {
    width: 100%;
    overflow: hidden;
    display: flex;
    gap: 12px;
    padding: 10px; 
    flex-direction: row;
}
.del {
    cursor: pointer;
    user-select: none;
}

.del,
.del * {
    pointer-events: auto;
}

.canvas-item {
    user-select: none;
}

</style>
<script src="script.js"></script>
<?php
//require_once('errorOn.php');
require_once('init_admin.php');
//require_once("post_".$_SESSION['tab'].".php");

// toolbar
$param  = array('chiudi');
$btx   = new bottoni_str_par('Mini Builder','lay','gest_lay.php',$param);
    $btx->btn();

$azione  =$_POST['submit'];      
//print_r($_POST);//debug

// test scelta effettuata sul pgm chiamante
             $scelta = new testSiScelta($lid,$azione);
               $scelta->alert_s();

// Connessione al database
$conn = new PDO("mysql:host=localhost;dbname=my_database;charset=utf8", "root", "");

// Leggi layout in ordine di posizione
$stmt = $conn->prepare("SELECT * 
                        FROM `".DB::$pref."lay`  
                        WHERE lstat IS NULL OR TRIM(lstat) = ''
                        AND ltmp = ?                                     
                        ORDER BY lprog ASC");                 
        $stmt->execute([$_POST['tema']]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Leggi tutti i widget presenti nella cartella /widgets
$widgetFiles = glob(__DIR__ . "/widgets/*.php");
?>

<div class="builder-container">
<div id="widgets-panel">
    <h2>Widget disponibili</h2>

    <?php foreach ($widgetFiles as $file): 
        $name = basename($file);
        $label = ucwords(str_replace(['.php','_'],['',' '], $name));
    ?>
        <div class="add-widget" data-widget="<?= $name ?>">
            + <?= $label ?>
        </div>
    <?php endforeach; ?>
</div>

<!-- Widgets del tema -->
<div id="canvas">
    <h2>Layout attuale del tema <?= $_POST['tema'] ?></h2>

    <ul id="sortable">
        <?php foreach($rows as $r): ?>
            <li class="canvas-item" draggable="true" data-lid="<?= $r['lid'] ?>">
                <?= htmlspecialchars($r['ltipo']) ?>
                <span class="del">✖</span>
            </li>
        <?php endforeach; ?>
    </ul>
</div>


<!-- Dettagli widget -->
<div id="right">
        <h2>Dettagli widget</h2>

  <form id="details-form" method="post">
    <fieldset id='tab1'>   
        <input type="hidden" name="lid" id="lid">
        <?php  
        $f1 = new input(array($ltipo,'ltipo',20,'Tipo','Tipo modulo per comporre la pagina','r'));
          $f1->field();        
        $ts = new DB_tip_i('stato','lstat',$lstat,'Stato record','Attivo/sospeso');
          $ts->select();   
        $f4 = new input(array($ldesc,'ldesc',30,'Descrizione','Descrizione modulo','i'));
          $f4->field();
        $t2 = new getTmp($ltmp,'ltmp','Tema','Scelta del tema');
          $t2->getTemplate();
        $f1 = new input(array($lpage,'lpage',30,'Pagina','Pagina del sito','i'));
          $f1->field();

// scelta del file in base al codice tipo di modulo =============================================
switch ($ltipo) 
{
case 'artslide':
               $arg = new DB_sel_l('asl','dprog',$lcod,'dcod','lcod','dstat','dcod','Codice','Articolo in slide');
          		$arg->select_label();
			break;
case 'artacc':
               $arg = new DB_sel_l('asl','dprog',$lcod,'dcod','lcod','dstat','dcod','Codice','Articolo in accordion');
          		$arg->select_label();
			break;
case 'arttab':
               $arg = new DB_sel_l('asl','dprog',$lcod,'dcod','lcod','dstat','dcod','Codice','Articolo in tab');
          		$arg->select_label();
			break;
case 'artsingle':
               $arg = new DB_sel_l('asl','dprog',$lcod,'dcod','lcod','dstat','dcod','Codice','Articolo semplice');
          		$arg->select_label();
			break;
case 'article':
               $arg = new DB_sel_l('art','aprog',$lcod,'atit','lcod','astat','atit','Codice','Articolo semplice');
          		$arg->select_label();
			break;
case 'artimg':
               $arg = new DB_sel_l('aim','icod',$lcod,'icod','lcod','istat','ides','Codice','Articolo con immagine');
          		$arg->select_label();
			break;
case 'artcol':
               $arg = new DB_sel_l('arc','hprog',$lcod,'hcod','lcod','hstat','hcod','Codice','Articolo in colonne');
          		$arg->select_label();
			break;
case 'glyph':
               $arg = new DB_sel_l('gly','gprog',$lcod,'gcod','lcod','gstat','gcod','Codice','Modulo con glifi');
          		$arg->select_label();
			break;
case 'promo':
               $arg = new DB_sel_l('prm','oprog',$lcod,'ocod','lcod','ostat','ocod','Codice','Modulo con glifi');
          		$arg->select_label();
			break;
case 'portfolio':
               $arg = new DB_sel_l('por','pprog',$lcod,'pcod','lcod','pstat','pcod','Codice','Modulo portfolio');
          		$arg->select_label();
			break;
case 'slide':
               $arg = new DB_sel_l('sld','slprog',$lcod,'slcod','lcod','slstat','slcod','Codice','Modulo slide di immagini');
          		$arg->select_label();
			break;
case 'header':
     		$f1 = new input(array($lcod,'lcod',30,'Codice','Header con navigatore','i'));
          		$f1->field();
			break;
case 'footer':
               $arg = new DB_sel_l('foo','fprog',$lcod,'fcod','lcod','fstat','fcod','Codice','Modulo footer');
          		$arg->select_label();
			break;
case 'contatti':
               $arg = new DB_sel_l('ctt','eprog',$lcod,'ecod','lcod','estat','ecod','Codice','Modulo contatti');
          		$arg->select_label();
               break;
case 'pag':
               $arg = new DB_sel_l('pag','jprog',$lcod,'jcod','lcod','jstat','jcod','Codice','Nome pagina');
          		$arg->select_label();
               break;
case 'space':
               $arg = new DB_sel_l('spz','qprog',$lcod,'qcod','lcod','qstat','qcod','Codice','Spaziatura');
          		$arg->select_label();
               break;
default:
	          echo	"Tipo modulo errato=".$ltipo;
			break;
}
?> 
        <label>Codice widget</label>
        <br /><input type="text" name="lcod" id="lcod"><br />
<button class="fb-button fb-p025 fb-rad7 fb-m05" type="submit" name="submit" value=salva id="save-details"
action="update-details.php" onkeypress='return event.keyCode != 13;'>
        <img src="https://fbsoftware.github.io/FB-CODE/images/bottoni/salva.png" height="25" />Salva</button>
</fieldset>
    </form>

    <h2>Anteprima</h2>
 <div id="preview-box" style="border:1px solid #ccc;padding:10px;min-height:80px;">
       <?php  
        include_once("../widget/".$lcod.".php");
       ?>
    </div>   
</div>
</div>
