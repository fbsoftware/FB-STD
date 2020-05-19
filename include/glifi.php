<section id="glyph">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  
<?php
		$head	= new section_head(TMP::$tgliftitle,TMP::$tgliftit,TMP::$tgliftext,TMP::$tcolor);
			$head->head();

// lettura glifi per il template
        $sql = "SELECT *
                FROM `".DB::$pref."gly`
                WHERE gtmp= '".TMP::$tmenu."' 
                    and gstat <> 'A'
					and gcod = '$lcod'
                ORDER BY gprog ";
				
		$stmt = $PDO->prepare($sql);
		$stmt->execute();		
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		json_encode($rows);
		$colonne = $stmt->rowCount();
		  
		echo "<div class='grid".$colonne." fb-col".$colonne."'>";

		foreach($rows as $row)
			{		  
          require'admin/fields_gly.php';			   
			   
		   echo	"<div>";
		   if ($glink > '') 
				{
				echo	"<a href='".$glink."' target='_new'>";
				echo	"<i class='".$gfa." ".$gdim." ".$gcolor." fa-border 				fa-glyph-center'></i></a>";
				}
			else 
				{
				echo	"<i class='".$gfa." ".$gdim." ".$gcolor." fa-border fa-glyph-center'></i></a>";
   				} 
			//echo	"</div>"; 
			
          	echo	"<h4 class='service-heading'>$gtitle</h4>";
               echo	"<p class='text-muted'>$gtext</p>";
               echo	"</div>";
 		}              
                  
          echo	"</div>";   // grid
echo	"</section>";     