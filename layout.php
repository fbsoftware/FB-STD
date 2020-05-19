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
				require'include/header.php';
				}
            	break;

            case 'slide':
				if (file_exists('include/slider.php')) 
				{			
				require'include/slider.php';
				}
            	break;

            case 'promo':
				if (file_exists('include/promo.php')) 
				{			
				require'include/promo.php';
				}
            	break;
               
            case 'portfolio':
				if (file_exists('include/portfolio.php')) 
				{			
				require'include/portfolio.php';
				}
            	break;
               
            case 'artimg':
				if (file_exists('include/artimg.php')) 
				{				
				require'include/artimg.php';
				}
            	break;
               
            case 'article':
				if (file_exists('include/article.php')) 
				{	
				require'include/article.php';
				}
            	break;

            case 'artsingle':
				if (file_exists('include/artsingle.php')) 
				{	
				require'include/article.php';
				}
            	break;
               
               
/*            case 'artslide':
				if (file_exists('include/artslide.php')) 
				{	
				require'include/artslide.php';
				}
            	break;*/
               
            case 'arttab':
				if (file_exists('include/arttab.php')) 
				{	
				require'include/arttab.php';
				}
            	break;
               
            case 'artacc':
				if (file_exists('include/arttab.php')) 
				{	
				require'include/artacc.php';
				}
            	break;
               
            case 'artcol':
				if (file_exists('include/arttab.php')) 
				{	
				require'include/artcol.php';
				}
            	break;
               
            case 'glyph':
				if (file_exists('include/glifi.php')) 
				{	
				require'include/glifi.php';
				}
            	break;
               
            case 'footer':
				if (file_exists('include/footer.php')) 
				{				
				require'include/footer.php';
				}				
            	break;
               
            case 'contatti':
				if (file_exists('include/contatti.php')) 
				{				
				require'include/contatti.php';
				}				
            	break;
                  
            default:
            	
            	break;
            }
          } 
 ?>