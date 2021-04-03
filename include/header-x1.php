<?php
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		Gestionale
   * versione 1.0    
   * copyright	Copyright (C) 2019 - 2020 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
==================================================================================     
  Visualizza il navigatore principale nei due livelli previsti
=============================================================================== */
?>

		<!-- Github button for demo page -->
		<script async defer src="https://buttons.github.io/buttons.js"></script>

	
<script type="text/javascript">
/*!
 * GRT Responsive Menu - jQuery Plugin
 * Version: 1.0
 * Author: GRT107
 *
 * Copyright (c) 2018 GRT107
 * Released under the MIT license
*/

// Create a function for mobile version
(function( $ ){
	$.fn.grtmobile = function () {
		if ($(window).width() < 768) {
			$('.grt-mobile-button').on('click', function(){
				$(this).toggleClass("grt-mobile-button-open");
				$("ul.grt-menu").toggleClass("open-grt-menu ");
				$("html, body").toggleClass("body-overflow");
			});
			$('li.grt-dropdown').on('click', function(e){
				$(this).toggleClass("active-dropdown");
			});
		}
	}
})( jQuery );

// Initialize and check for mobile
$.fn.grtmobile();

// On resize window check for mobile
var resizeTimer;

$(window).on('resize', function(e) {
  clearTimeout(resizeTimer);
  resizeTimer = setTimeout(function() {
     $.fn.grtmobile();
  }, 250);
})

// Add shadow on scroll after 60px
$(window).scroll(function(e){
   if ($(this).scrollTop() > 60){
       $('header').addClass('scrolled');
   } else {
       $('header').removeClass('scrolled');
   }
});

// Prevent a href clicks on dropdown category
$('li.grt-dropdown > a').on('click', function(e){
	e.preventDefault();
});


</script>


<style type="text/css">
/* Extra Classes */
.no-margin {
	margin: 0;
}

.no-padding {
	padding: 0;
}

/* Menu */
header {
	position:fixed;
	top:0;
	left:0;
	right:0;
	width:100%;
	background:#FFF;
	height:60px;
	z-index:9999;
}

header.scrolled {
	box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 20px 0px;
}

header nav {
	clear:both;
	display: block;
	line-height: 60px;
	height:60px;
	position:relative;
}

.menu-container {
	padding-left:30px;
	padding-right:30px;
}

.grt-menu-row {
	display: flex;
	flex-direction: row;
	justify-content: space-between;
}

a.grt-logo {
	display:inline-block;
}

a.grt-logo img {
	max-height: 60px;
    width: auto;
}

.grt-mobile-button {
	display:none;
}

.grt-mobile-button:focus {
	border:0;
	outline:0;
}

.body-overflow {
	overflow:hidden;
}

ul.grt-menu {
	display: block;
	float:right;
	margin:0 -10px 0 0;
	padding:0;
	list-style-type: none;
}

ul.grt-menu:after {
	content:"";
	clear:both;
	display:block;
}

ul.grt-menu li {
	display: inline-block;
	margin:0;
	padding:0;
	-webkit-transition: all ease 0.8s;
	-moz-transition: all ease 0.8s;
	transition: all ease 0.8s;
}

ul.grt-menu li a {
	padding: 5px 12px;
	font-size:21px;
	display: inline-block;
	color:#303030;
	line-height: 1.1em;
	box-shadow: inset 0 0 0 0 #FFF;
	-webkit-transition: all ease 0.8s;
	-moz-transition: all ease 0.8s;
	transition: all ease 0.8s;
	position:relative;
	text-decoration: none;
	text-transform: lowercase;
}


ul.grt-menu li.active a:after  {
    position: absolute;
    bottom: 1px;
    content: "";
    left: 12px;
    right: 12px;
    border-bottom: 2px solid #ee2b34;
}

@keyframes fadeIn {
    from { opacity: 0; }
      to { opacity: 1; }
}

ul.grt-menu li.grt-dropdown:hover {
	cursor:pointer;
}

ul.grt-menu li.grt-dropdown:hover a {
	box-shadow: none;
}

ul.grt-menu li.grt-dropdown ul.grt-dropdown-list {
	display:none;
	position:absolute;
	background:#ee2b34;
	margin: 0;
	padding: 0;
	min-width:150px;
	animation: fadeIn 0.8s;
	z-index: 999;
}

ul.grt-menu li.grt-dropdown ul.grt-dropdown-list li a {
	display:block;
	font-size:18px;
	color: #FFF;
	-webkit-transition: all ease 0.8s;
	-moz-transition: all ease 0.8s;
	transition: all ease 0.8s;
	padding: 9px 12px;
}

ul.grt-menu li.grt-dropdown ul.grt-dropdown-list li:last-child a {
	padding-bottom:15px;
}

ul.grt-menu li.grt-dropdown.active-dropdown {
	background: #ee2b34;
}

ul.grt-menu li.grt-dropdown.active-dropdown ul.grt-dropdown-list {
	display:block !important;
}

ul.grt-menu li.grt-dropdown.active-dropdown a {
	color:#FFF;
}


/* Desktop only style */
@media (min-width:768px) {

	ul.grt-menu li.grt-dropdown:hover > a + ul.grt-dropdown-list {
		display:block;
		top: calc(100% - 17px);
	}

	ul.grt-menu li.grt-dropdown ul.grt-dropdown-list li {
		display:block;
	}

	ul.grt-menu li.grt-dropdown:hover > a {
		color:#FFF;
		box-shadow: inset 150px 0 0 0 #ee2b34;
	}

	ul.grt-menu li a:hover {
		color:#FFF;
		box-shadow: inset 150px 0 0 0 #ee2b34;
	}
}

/* Tablet only style */
@media (min-width:768px) and (max-width:991px) {
	ul.grt-menu li a {
		font-size:18px;
	}
}

/* Mobile only style */
@media (max-width:767px) {

	.menu-container {
		padding-left: 15px;
		padding-right: 15px;
	}

	.grt-mobile-button {
		display:inline-block;
		position:absolute;
		right:0;
		top:10px;
		background:#FFF;
		color:#3d3d3d;
		margin:0;
		padding:0;
		cursor:pointer;
		border: 0;
		width:35px;
	}

	.grt-mobile-button .line1, .grt-mobile-button .line2, .grt-mobile-button .line3 {
		width: 35px;
		height: 4px;
		background-color: #333;
		margin: 6px 0;
		transition: 0.4s;
		display:block;
	}

	ul.grt-menu {
		display:none;
		margin:0;
  		height: 0;
	}  

	ul.open-grt-menu {
		position: fixed;
		background: #FFF;
		width: 100%;
		left: 0;
		right: 0;
		top: 0;
		height:100%;
		float: none;
		display: flex;
		justify-content: center;
		flex-direction: column;
		text-align: center;
	}

	.grt-mobile-button-open {
		position: fixed;
		z-index:99999;
		right:25px;
		top:25px;
	}

	.grt-mobile-button-open .line1 {
		-webkit-transform: rotate(-45deg) translate(-8px, 5px);
		transform: rotate(-45deg) translate(-8px, 5px);
	}

	.grt-mobile-button-open .line2 {opacity: 0;}
	
	.grt-mobile-button-open .line3 {
		-webkit-transform: rotate(45deg) translate(-8px, -7px);
		transform: rotate(45deg) translate(-8px, -7px);
	}

	ul.grt-menu li {
		display: block;
		line-height: 3.5em;
	}

	ul.grt-menu li a {
		padding: 6px 10px;
		font-size:30px;
	}

	ul.grt-menu li.grt-dropdown ul.grt-dropdown-list {
		width:100%;
		position: relative;
		display:none;
	}

	ul.grt-menu li.grt-dropdown ul.grt-dropdown-list li a {
		display: block;
		font-size: 17px;
	}
}

</style>
<section id="header">

		<header>
			<div class="menu-container">
				<div class="grt-menu-row">
					<div class="grt-menu-logo">
						<a href="#"  class="grt-logo"><img src="images/icofbot.png"></a>
					</div>
					<div class="grt-menu-right">
						<nav>
							<button class="grt-mobile-button"><span class="line1"></span><span class="line2"></span><span class="line3"></span></button>
							<ul class="grt-menu">
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
?>		
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</header>
<!-- ==================================================== -->

  </section>

