<?php
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		Gestionale
   * versione 1.0    
   * copyright	Copyright (C) 2019 - 2020 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
=============================================================================== 
  Visualizza il navigatore principale nei due livelli previsti
=============================================================================== */
?>
<section id="header">
<div class="container-fluid">
<div class="row">
      <!-- Static navbar -->
      <nav class="navbar navbar-default">
      
        
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class='sr-only'>Toggle navigation</span>
              <span class='icon-bar'></span>
              <span class='icon-bar'></span>
              <span class='icon-bar'></span>
            </button>
            <div> 
              <img src="<?php echo TMP::$tfolder; ?>images/logo/logo.png" alt="logo" title="Logo" height="80"style="margin-right:50px;">           
             </div>   
          </div>
          
            <ul class='nav navbar-nav'> 

 <?php 
 // lettura voci menu 
        $sql = "SELECT *
                FROM `".DB::$pref."nav`
                WHERE nmenu= '".TMP::$tmenu."' and nstat <> 'A' and ndesc <= ' ' 
                ORDER BY nprog";
          foreach($PDO->query($sql) as $row)
       { 
          require 'admin/fields_nav.php';
// echo "<br />npag=".$npag.";nli=".$nli.";Tipo=".$ntipo;//debug
        if ($row['npag'] == '1') 
                {  
                echo "<li class='dropdown'> 
                      <a href='".DB::$host.DB::$sep.DB::$site.DB::$sep.$row['nsotvo']."' class='dropdown-toggle' data-toggle='dropdown'>".$row['nli']."<span class='caret'></span></a>";
			$voce = $row['nli'];
               require_once("/liv3.php");
               echo "</li>";
                }
//        if ($row['npag'] == '0') 
		else  
                { 
                switch ($row['ntipo']) 
                {
                case 'lnk':
                case 'art':
                case 'htm':
                    	echo "<li><a href='".$row['nsotvo']."'>".$row['nli']."</a></li>";
                	     break;
                case 'ifr':
                      	echo "<li><a header(location:'".$row['nsotvo']."')>".$row['nli']."</a></li>";                
                		break;       
                default:
                	
                	break;
                }
                }    

        }            
           echo "</ul>"; 
?>
</div>  <!--- row -->  
</div>  <!--- container -->
</nav>
</section>