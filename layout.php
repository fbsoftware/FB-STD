<?php
$count = 0; 
        $sql = "SELECT *
                FROM `".DB::$pref."lay`
                WHERE ltmp= '".TMP::$tmenu."' 
                    and lstat <> 'A' 
                ORDER BY lprog ";
// transazione    
$con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
$PDO = new PDO($con,DB::$user,DB::$pw);
$PDO->beginTransaction(); 
foreach($PDO->query($sql) as $row)
          { 
          $lcod     =   $row['lcod'];     
            switch ($row['ltipo']) 
            {
           case 'header':
				if (file_exists("include/header.php")) 
				{
				include'include/header.php';
				}
            	break;

            case 'slide':
				if (file_exists('include/slider.php')) 
				{			
				include'include/slider.php';
				}
            	break;

            case 'promo':
				if (file_exists('include/promo.php')) 
				{			
				include'include/promo.php';
				}
            	break;
               
            case 'portfolio':
				if (file_exists('include/portfolio.php')) 
				{			
				include'include/portfolio.php';
				}
            	break;
               
            case 'artimg':
				if (file_exists('include/artimg.php')) 
				{				
				include'include/artimg.php';
				}
            	break;
               
            case 'article':
				if (file_exists('include/article.php')) 
				{	
				include'include/article.php';
				}
            	break;

            case 'artsingle':
				if (file_exists('include/artsingle.php')) 
				{	
				include'include/article.php';
				}
            	break;
               
               
            case 'artslide':
				if (file_exists('include/artslide.php')) 
				{	
				include'include/artslide.php';
				}
            	break;
               
            case 'arttab':
				if (file_exists('include/arttab.php')) 
				{	
				include'include/arttab.php';
				}
            	break;
               
            case 'artacc':
				if (file_exists('include/arttab.php')) 
				{	
				include'include/artacc.php';
				}
            	break;
               
               
            case 'glyph':
				if (file_exists('include/glifi.php')) 
				{	
				include'include/glifi.php';
				}
            	break;
               
            case 'footer':
				if (file_exists('include/footer.php')) 
				{				
				include'include/footer.php';
				}				
            	break;
               
            case 'contatti':
				if (file_exists('include/contatti.php')) 
				{				
				include'include/contatti.php';
				}				
            	break;
                  
            default:
            	
            	break;
            }
          } 
 ?>