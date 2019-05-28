<section id="glyph">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  
<?php
		$head	= new section_head(TMP::$tgliftitle,TMP::$tgliftit,TMP::$tgliftext,TMP::$tcolor);
			$head->head();

          echo	"<div class='row'>";
// lettura glifi per il template
        $sql = "SELECT *
                FROM `".DB::$pref."gly`
                WHERE gtmp= '".TMP::$tmenu."' 
                    and gstat <> 'A' 
                ORDER BY gprog ";
          // transazione    
          $con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
          $PDO = new PDO($con,DB::$user,DB::$pw);
          $PDO->beginTransaction(); 
          foreach($PDO->query($sql) as $row)
          {     //print_r($row);//debug
          include'fields_gly.php';  
               echo	"<div class='".$gcol." text-center'>";
               echo	"<div>";
               if ($glink > '') 
				{
               	echo	"<a href='".$glink."' target='_new'>";
               	echo	"<i class='".$gfa." ".$gdim." ".$gcolor." fa-border'></i></a>";

               	}
			else {
   	               echo	"<i class='".$gfa." ".$gdim." ".$gcolor." fa-border'></i></a>";

   				} 
			echo	"</div>"; 
			
          	echo	"<h4 class='service-heading'>$gtitle</h4>";
               echo	"<p class='text-muted'>$gtext</p>";
               echo	"</div>";
 		}              
                  
          echo	"</div>";   //-- row --
echo	"</section>";     