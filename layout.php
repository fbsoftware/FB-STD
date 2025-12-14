<?php

        $sql = "SELECT *
                FROM `".DB::$pref."lay`
                WHERE ltmp= '".TMP::$tmenu."' 
                AND lstat IS NULL OR TRIM(lstat) = '' 
                ORDER BY lprog ";
/* transazione    
$con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
$PDO = new PDO($con,DB::$user,DB::$pw);
$PDO->beginTransaction(); 
foreach($PDO->query($sql) as $row)   */

// nuova versione
$rows = DB_SEL::select($sql);
foreach ($rows as $row) 
          {  
			//require'/../admin/post_lay.php';
			//echo  "tema-tipo-codice=".$row['ltmp']."-".$row['ltipo']."-".$row['lcod'];//debug
			$lcod = $row['lcod'];

            switch ($row['ltipo']) 
            {
           case 'header':
				if (file_exists("widget/header.php")) 
				{
				require'widget/header.php';
				}
            	break;

            case 'slide':
				if (file_exists('admin/widget/slider.php')) 
				{			
				require'admin/widget/slider.php';
				}
            	break;

            case 'promo':
				if (file_exists('admin/widget/promo.php')) 
				{			
				require'admin/widget/promo.php';
				}
            	break;
               
            case 'portfolio':
				if (file_exists('admin/widget/portfolio.php')) 
				{			
				require'admin/widget/portfolio.php';
				}
            	break;
               
            case 'artimg':
				if (file_exists('admin/widget/artimg.php')) 
				{				
				require'admin/widget/artimg.php';
				}
            	break;
               
            case 'article':
				if (file_exists('admin/widget/article.php')) 
				{
				require'admin/widget/article.php';
				}
            	break;

            case 'artsingle':
				if (file_exists('admin/widget/artsingle.php')) 
				{	
				require'admin/widget/article.php';
				}
            	break;
               
               
/*            case 'artslide':
				if (file_exists('admin/widget/artslide.php')) 
				{	
				require'admin/widget/artslide.php';
				}
            	break;*/
               
            case 'arttab':
				if (file_exists('admin/widget/arttab.php')) 
				{	
				require'admin/widget/arttab.php';
				}
            	break;
               
            case 'artacc':
				if (file_exists('admin/widget/arttab.php')) 
				{	
				require'admin/widget/artacc.php';
				}
            	break;
               
            case 'artcol':
				if (file_exists('admin/widget/arttab.php')) 
				{	
				require'admin/widget/artcol.php';
				}
            	break;
               
            case 'glyph':
				if (file_exists('admin/widget/glifi.php')) 
				{	
				require'admin/widget/glifi.php';
				}
            	break;
               
            case 'footer':
				if (file_exists('admin/widget/footer.php')) 
				{				
				require'admin/widget/footer.php';
				}				
            	break;
               
            case 'contatti':
				if (file_exists('admin/widget/contatti.php')) 
				{				
				require'admin/widget/contatti.php';
				}				
            	break;
               
			case 'izoom':
					if (file_exists('admin/widget/imgzoom.php')) 
					{				
					require'admin/widget/imgzoom.php';
					}				
					break;
					               
			case 'space':
				if (file_exists('admin/widget/space.php')) 
				{				
				require'admin/widget/space.php';
				}				
				break;     
					               
			case 'pag':
				if (file_exists('admin/widget/page.php')) 
				{				
				require'admin/widget/page.php';
				}				
				break;               
            default:
            	
            	break;
            }
          } 
 ?>