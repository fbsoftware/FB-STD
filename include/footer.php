<?php
echo	"<div id='footer' class='fb-bgcolor-".TMP::$tcolor."'>"; 
echo	"<div class='row'>";
// lettura footer elements
        $sql = "SELECT *
                FROM `".DB::$pref."foo`
                WHERE fcod = '$lcod'
                    and ftmp= '".TMP::$tmenu."' 
                    and fstat <> 'A' 
                ORDER BY fprog ";
          foreach($PDO->query($sql) as $row)
          { 
		if ($row['ftipo'] == 'img') 
		{
		echo	"<div class='".$row['fcol']."'>";
          echo	"<center><br />";
          echo	"<img src='".$row['felemento']."' class='img-square' alt='".$row['felemento']."' height='100'>";
          echo	"<br><h4 class='footertext'>".$row['ftit']."</h4>";
          echo	"<h6 class='footertext'>".$row['ftext']."</h6>";
          echo	"</center>";
          echo	"</div>";
  		}          
		if ($row['ftipo'] == 'cnt') 
		{
		echo	"<div class='".$row['fcol']."'>"; 
          echo	"<center><br />";
		echo	"<br><h4 class='footertext'>".$row['ftit']."</h4>";
		echo	"</center>";
// lettura contatti

        $sql = "SELECT *
                FROM `".DB::$pref."ctt`
                WHERE '".$row['fcod']."' = '$lcod'
                	and ecod = '".$row['felemento']."'
                    and etmp= '".TMP::$tmenu."' 
                    and estat <> 'A' 
                ORDER BY eprog ";		
          foreach($PDO->query($sql) as $row)
          {		
		echo	"<br /><span class='footertext'>".$row['email']."</span>";
		echo	"<br /><span class='footertext'>".$row['epec']."</span>";
		echo	"<br /><span class='footertext'>".$row['esito']."</span>";
		echo	"<br /><span class='footertext'>".$row['esede']."</span>";
		
          echo	"</div>"; 
  		}          
		}    // foreach  1
		}    // foreach  2
          echo	"</div>";			            
?>
