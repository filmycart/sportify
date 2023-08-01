<?php 
	require_once('./private/init.php'); 
	require_once('./conf/conf.php');

	$s_config = new Site_Config();
	$s_config = $s_config->one();

	$homepage_cat = new Category();
	$homepage_cat = $homepage_cat->all();

	$parent_cms_menu = new Cms();
	$parent_cms_menu = $parent_cms_menu->where(["parent_id" => 0])->andWhere(["status" => 1])->all();

	$child_cms_menu = new Cms();
	$child_cms_menu = $child_cms_menu->where(["status" => 1])->all();

	$child_cms_disp_menu = array();
	if(!empty($child_cms_menu)) {
        foreach($child_cms_menu as $child_cms_menu_val) {
        	if(!empty($child_cms_menu_val->parent_id)) {
        		$child_cms_disp_menu[$child_cms_menu_val->parent_id][] = $child_cms_menu_val;
        	}
        }
    }

	/*print"<pre>";
	print_r($child_cms_disp_menu);
	exit;*/
	
	$homepage_prod = new Product();
	$homepage_prod = $homepage_prod->where(["sub_category_id" => 2])->all();

	// print"<pre>";
	// print_r($parent_cms_menu);
	// exit;

	$pg_name = "";
	if(!empty($_GET['pg-name'])) {
		$pg_name = $_GET['pg-name'];
	}
	elseif(!empty($_GET['pgName'])) {
		$pg_name = $_GET['pgName'];
	}

	$menu_active_home = "";
	$menu_active_contact = "";
	$menu_active_products = "";
	if(empty($pg_name)) {	
		$menu_active_home = "class=\"active\" ";
	}
	elseif($pg_name == "home") {
		$menu_active_home = "class=\"active\" ";
	}
	elseif($pg_name == "contact") {
		$menu_active_contact = "class=\"active\" ";
	}
	elseif($pg_name == "products") {
		$menu_active_products = "class=\"active\" ";
	}	
		
	if(!empty($pg_name)) {
		switch($pg_name) {
			case "home":
				include("frontend/views/template/mathuranjelly/home.php");
				exit;
			case "contact":
				include("frontend/views/template/mathuranjelly/contact.php");	
				exit;
			default:
				include("frontend/views/template/mathuranjelly/home.php");
				exit;
		}
	}	
	else {
		include("frontend/views/template/mathuranjelly/home.php");
	}    
?>