<section id="glyph">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  
<?php
// pannello

		echo "<div class='f-flex fd-column fb-bgcolor-".TMP::$tcolor."'>"; 
		echo "<div class='f-dim1'>";
		if (TMP::$tgliftit > " ")  { echo "<h1>".TMP::$tgliftit."</h1>"; } 
		if (TMP::$tgliftext > " ") { echo "<p>".TMP::$tgliftext."</p>"; }
		echo "</div>";
		echo "</div>";	
		
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
		  
		echo "<div class='f-flex fd-row jc-center  ai-start'>";

		foreach($rows as $row)
			{		  
          require'admin/fields_gly.php';			   
			   
		   echo "<div class='f-dim1'>";
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
			
          	echo	"<h3 class='center'>$gtitle</h4>";
               echo	"<p class='text-muted'>$gtext</p>";
               echo	"</div>";
 		}              
                  
          echo	"</div>";   // grid
echo	"</section>";     