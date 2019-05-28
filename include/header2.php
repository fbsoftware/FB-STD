<?php
/*** FB_template versione 3.2.1
   Fausto Bresciani
   Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta all'uso
   anche improprio di FB_template.
=============================================================================== 
  Visualizza il navigatore principale nei due livelli previsti
=============================================================================== */
require_once("connectDB.php");
?>
<!-- container del menu  -->
<div class="container">

      <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class='sr-only'>Toggle navigation</span>
              <span class='icon-bar'></span>
              <span class='icon-bar'></span>
              <span class='icon-bar'></span>
            </button>
            <a class='navbar-brand' href='#'>FB open-template</a>
          </div>
          
          <div id='navbar' class='navbar-collapse collapse'>
            <ul class='nav navbar-nav'> 

 <?php  
 require_once("connectDB.php");
 $sql = "SELECT *
                FROM `".DB::$pref."nav`
                WHERE nmenu= '".TMP::$tcod."' and nstat <> 'A' and ndesc <= ' ' 
                ORDER BY nprog";
          foreach($PDO->query($sql) as $row)
       { 
          include 'fields_nav.php';
   //    print_r($row);//debug  
        if ($row['npag'] == 1) 
                {  
                echo "<li class='dropdown'>
                      <a href='localhost/fbot-boot/". $row['nsotvo']."' class='dropdown-toggle' data-toggle='dropdown'>".$row['nli']."<span class='caret'></span></a>"; 
               include('liv2.php');
               echo "</li>";
                }
        if ($row['npag'] == 0)   
                { 
                switch ($row['ntipo']) 
                {
                case 'lnk':
                      echo "<li><a href='".$row['nsotvo']."'>". $row['nli']."</a></li>";
                	     break;
                case 'ifr':
                      echo "<li><a header(location:'".$row['nsotvo']."')>". $row['nli']."</a></li>";                
                	break;       
                default:
                	
                	break;
                }
                }    

        }            
           echo "</ul>"; 
?>   
          </div>
                    </div>
                              </div>                             
 