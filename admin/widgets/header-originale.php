<?php
/*** Fausto Bresciani   fbsoftware@libero.it  www.faustobresciani.it
   * package		Gestionale
   * versione 1.0    
   * copyright	Copyright (C) 2019 - 2020 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
==================================================================================     
  Visualizza il navigatore principale 
=============================================================================== */
?>
<section id="header">
<!-- ==================================================== -->
  <section id="nav">
    <div class="wrapper">
      <nav class="site-nav">
              <img src="<?php echo TMP::$tfolder; ?>images/logo/logo.png" alt="logo" title="Logo" height="80">           
        <div class="menu-toggle">
          <div class="hamburger"></div>
        </div>
        <ul class="open desktop">
 <?php 
 // lettura voci menu 
        $sql = "SELECT *
                FROM `".DB::$pref."nav`
                WHERE nmenu= '".TMP::$tmenu."' and nstat <> 'A' and ndesc <= ' ' 
                ORDER BY nprog";
          foreach($PDO->query($sql) as $row)
       { 
          require 'admin/fields_nav.php';
         if ($row['npag'] == '1') 
                {  
                echo "<li> 
                      <a href='".DB::$host.DB::$sep.DB::$site.DB::$sep.$row['nsotvo']."'>".$row['nli']."</a>";
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
      </nav>
    </div>
  </section>

<!-- ==================================================== -->
<script type="text/javascript">
$.noConflict();
jQuery(document).ready(function($) {
  $('.menu-toggle').on('click', function() {
    $('ul').slideToggle();
    $(this).toggleClass('open');
  });
});
</script>
</section>