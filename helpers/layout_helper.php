<?php

// Page Functions
function page_header0($title,$breadcrumb){
   $html="";
   $html.="<section class='content-header'>";
   $html.="<div class='container-fluid'>";
   $html.="<div class='row mb-2'>";
   $html.="<div class='col-sm-6'>";
   $html.="<h1>$title</h1>";
   $html.="</div>";
   $html.="<div class='col-sm-6'>";
   $html.="<ol class='breadcrumb float-sm-right'>";
   foreach($breadcrumb as $link){
     $html.="<li class='breadcrumb-item'><a href='{$link['url']}'>{$link['name']}</a></li>";            
   }
$html.="</ol>";
$html.="</div>";
$html.="</div>";
$html.="</div>";
$html.="</section>";
return $html;
}
// Nav Functions
function nav_link($url,$text,$css="far fa-circle"){
      
    $html="<a href='$url' class='nav-link'>";
    $html.="<i class='$css nav-icon'></i>";
    $html.="<p>$text</p>";               
    $html.="</a>";

    return $html;
   }

   function nav_link_dropdown($url,$text,$css="far fa-circle",$options=array()){
      
      $html="<a href='$url' class='nav-link'>";
      $html.="<i class='$css nav-icon'></i>";
      $html.="<p>$text</p>";   
      
      if(count($options)){
         $html.="<i class='fas fa-angle-left right'></i>";  
      } 
      $html.="</a>";
      
      if(count($options)){
         $html.=nav_dropdown($options);
      }
      
       return $html;
  
     }
   
   function nav_dropdown($options){    

        $html="<ul class='nav nav-treeview'>";
        foreach($options as $option){
             $html.="<li class='nav-item'>";
             $html.=nav_link($option["url"],$option["value"],$option["css"]);
             $html.="</li>";
        }
        $html.="</ul>";      

        return $html;
   }
   
   function main_sidebar_dropdown($menu){
	 $html="<li class=\"nav-item\">";
	 $html.="<a href=\"javascript:void(0)\" class=\"nav-link\">";
	 $html.="<i class=\"{$menu["icon"]}\"></i>";
	 $html.="<p>{$menu["name"]}<i class=\"right fas fa-angle-left\"></i></p>";
	 $html.="</a>";
	 $html.="<ul class=\"nav nav-treeview\">";
	 foreach($menu["links"] as $link){
		$html.="<li class=\"nav-item\">";
      $html.="<a href=\"{$link["route"]}\" class=\"nav-link\"> <i class=\"{$link["icon"]}\"></i><p>{$link["text"]}</p></a>";
		$html.="</li>";
	 }
	$html.="</ul>";
   $html.="</li>";
	return $html;
   }
   
   function page_header($config){
    $html="";
    $html.="<header class=\"py-3 mb-4 border-bottom\">";
    $html.="<div class=\"container d-flex flex-wrap justify-content-center\">";
    $html.="<a href=\"/\" class=\"d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-dark text-decoration-none\">";
    $html.="<svg class=\"bi me-2\" width=\"40\" height=\"32\"><use xlink:href=\"#bootstrap\"></use></svg>";
    $html.="<span class=\"fs-4\">{$config["title"]}</span>";
    $html.="</a>";
    $html.="<form class=\"col-12 col-lg-auto mb-3 mb-lg-0\">";
    $html.="<input type=\"search\" name=\"txtSearch\" class=\"form-control\" placeholder=\"Search...\" aria-label=\"Search\">";
    $html.="</form>";
    $html.="</div>";
    $html.="</header>";

   return $html;
  }
?>