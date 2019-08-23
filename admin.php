<?php
/**
 * @author Ocean <ocean@ocean.com>
 * @copyright Ocean 2019
 * @package parima
 * 
 * 
 * Created using IMA BuildeRz v2
 */


/** site **/
$config["app-name"]			= "Parima" ; //Write the name of your website
$config["app-desc"]			= "Catalogo Parima" ; //Write a brief description of your website
$config["utf8"]				= true; 
$config["background"]		= ""; 
$config["logo"]		= ""; 
$config["timezone"]		= "America/Sao_Paulo" ; // check this site: http://php.net/manual/en/timezones.php
$config["color"]			= "blue"; 
$config["debug"]			= true; 

/** mysql **/
$config["db_host"]				= "localhost" ; //host
$config["db_user"]				= "lifetico_bruno" ; //Username SQL
$config["db_pwd"]				= "info47b12*" ; //Password SQL
$config["db_name"]			= "lifetico_entrega" ; //Database

/** onesignal **/
$config["onesignal_app_id"]				= "" ; //Your OneSignal AppId, available in OneSignal https://documentation.onesignal.com/docs/generate-a-google-server-api-key
$config["onesignal_api_key"]			= "" ; //Your OneSignal ApiKey, required for push notification sender


/** DON'T EDIT THE CODE BELLOW **/
session_start();
ini_set("internal_encoding", "utf-8");
date_default_timezone_set($config["timezone"]);
if(!isset($_SESSION["IS_LOGIN"])){
	$_SESSION["IS_LOGIN"] = false;
}
$app_name = $config["app-name"];
$app_desc = $config["app-desc"];
$page_title = "Welcome";
$content = $body_class = "";

if(!isset($_GET["page"])){
	$_GET["page"] = "home";
}
if($_GET["page"]==""){
	$_GET["page"] = "home";
}
if(!isset($_GET["action"])){
	$_GET["action"] = "list";
}
if($config["debug"]==true){
	error_reporting(E_ALL);
}else{
	error_reporting(0);
}

/** connect to mysql **/
$mysql = new mysqli($config["db_host"], $config["db_user"], $config["db_pwd"], $config["db_name"]);
if (mysqli_connect_errno()){
	die(mysqli_connect_error());
}

if($config["utf8"]==true){
	$mysql->set_charset("utf8");
}

switch($_GET["page"]){
	// TODO: PAGE - HOME
	case "home":
		if($_SESSION["IS_LOGIN"]==false){
			header("Location: ?page=login");
		}
		$page_title = "Dashboard";
		$body_class = "hold-transition skin-".$config["color"]." sidebar-mini";
		$current_user = $_SESSION["CURRENT_USER"];
		$content = null;
		$content .= '<div class="wrapper">';
		$content .= '<header class="main-header">';
		$content .= '<a href="?" class="logo">';
		$content .= '<span class="logo-mini"><b>PN</b>L</span>';
		$content .= '<span class="logo-lg"><b>'.$app_name.'</b> Panel</span>';
		$content .= '</a>';
		$content .= '<nav class="navbar navbar-static-top">';
		$content .= '<a href="?" class="sidebar-toggle" data-toggle="push-menu" role="button">';
		$content .= '<span class="sr-only">Toggle navigation</span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '</a>';
		$content .= '<div class="navbar-custom-menu">';
		$content .= '<ul class="nav navbar-nav">';
		$content .= '<li class="dropdown user user-menu">';
		$content .= '<a href="?" class="dropdown-toggle" data-toggle="dropdown">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="user-image" alt="User Image">';
		$content .= '<span class="hidden-xs">' . htmlentities(stripslashes($current_user['user_name'])).'</span>';
		$content .= '</a>';
		$content .= '<ul class="dropdown-menu">';
		$content .= '<li class="user-header">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="User Image">';
		$content .= '<p>';
		$content .= '' . htmlentities(stripslashes($current_user['user_name'])).'';
		$content .= '<small>' . htmlentities(stripslashes($current_user['user_level'])).'</small>';
		$content .= '</p>';
		$content .= '</li>';
		$content .= '<li class="user-footer">';
		$content .= '<div class="pull-left">';
		$content .= '<a href="?page=profile" class="btn btn-default btn-flat">Profile</a>';
		$content .= '</div>';
		$content .= '<div class="pull-right">';
		$content .= '<a href="?page=logout" class="btn btn-default btn-flat">Sign out</a>';
		$content .= '</div>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '</div>';
		$content .= '</nav>';
		$content .= '</header>';
		$content .= '<aside class="main-sidebar">';
		$content .= '<section class="sidebar">';
		$content .= '<div class="user-panel">';
		$content .= '<div class="pull-left image">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="'.htmlentities(stripslashes($current_user['user_name'])).'">';
		$content .= '</div>';
		$content .= '<div class="pull-left info">';
		$content .= '<p>'.htmlentities(stripslashes($current_user['user_name'])).'</p>';
		$content .= '<a href="?"><i class="fa fa-circle text-success"></i> '.htmlentities(stripslashes($current_user['user_level'])).'</a>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<ul class="sidebar-menu" data-widget="tree">';
		$content .= '<li class="header">DATA MANAGER</li>';
		$content .= '<li class="treeview active">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-table"></i> <span>categorias</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=categoria&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=categoria&amp;action=list"><i class="fa fa-list-ul"></i> All categorias</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-automobile"></i> <span>entregas</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=entrega&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=entrega&amp;action=list"><i class="fa fa-list-ul"></i> All entregas</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-ioxhost"></i> <span>marcas</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=marca&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=marca&amp;action=list"><i class="fa fa-list-ul"></i> All marcas</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-desktop"></i> <span>produtos</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=produto&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=produto&amp;action=list"><i class="fa fa-list-ul"></i> All produtos</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="header">TOOLS</li>';
		$content .= '<li><a href="?page=onesignal-sender"><i class="fa fa-user"></i> <span>OneSignal Sender</span></a></li>';
		$content .= '<li class="header">USERS</li>';
		$content .= '<li><a href="?page=profile"><i class="fa fa-user"></i> <span>Your Profile</span></a></li>';
		$content .= '</ul>';
		$content .= '</section>';
		$content .= '</aside>';
		$content .= '<div class="content-wrapper">';
		/** breadcrumb **/
		$content .= '<section class="content-header">';
		$content .= '<h1>Dashboard</h1>';
		$content .= '<ol class="breadcrumb">';
		$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
		$content .= '<li class="active">Dashboard</li>';
		$content .= '</ol>';
		$content .= '</section>';
		/** content **/
		$content .= '<section class="content">';
		$content .= '<div class="box">';
		$content .= '<div class="box-header with-border">';
		$content .= '<h3 class="box-title">Welcome</h3>';
		$content .= '<div class="box-tools pull-right">';
		$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
		$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<div class="box-body">';
		$content .= '<div class="well">';
		$content .= '<h2>Welcome to</h2><h1>'.$app_name.'!</h1>';
		$content .= '<p class="lead">'.$app_desc.'</p>';
		$content .= '</div>';
		$content .= '<div class="row">';
		
		/** count categoria data **/
		$sql_query = "SELECT COUNT(*) AS `total` FROM `categoria` LIMIT 0,1" ;
		$result = $mysql->query($sql_query);
		$count = $result->fetch_array();
		$content .= '<div class="col-lg-3 col-xs-6">';
		$content .= '<div class="small-box bg-blue">';
		$content .= '<div class="inner">';
		$content .= '<h3>'.$count["total"].'<sup style="font-size: 20px">items</sup></h3>';
		$content .= '<p>categorias</p>';
		$content .= '</div>';
		$content .= '<div class="icon">';
		$content .= '<i class="fa fa-table"></i>';
		$content .= '</div>';
		$content .= '<a href="?page=categoria&amp;action=list" class="small-box-footer">';
		$content .= 'More <i class="fa fa-arrow-circle-right"></i>';
		$content .= '</a>';
		$content .= '</div>';
		$content .= '</div>';
		
		/** count entrega data **/
		$sql_query = "SELECT COUNT(*) AS `total` FROM `entrega` LIMIT 0,1" ;
		$result = $mysql->query($sql_query);
		$count = $result->fetch_array();
		$content .= '<div class="col-lg-3 col-xs-6">';
		$content .= '<div class="small-box bg-yellow">';
		$content .= '<div class="inner">';
		$content .= '<h3>'.$count["total"].'<sup style="font-size: 20px">items</sup></h3>';
		$content .= '<p>entregas</p>';
		$content .= '</div>';
		$content .= '<div class="icon">';
		$content .= '<i class="fa fa-automobile"></i>';
		$content .= '</div>';
		$content .= '<a href="?page=entrega&amp;action=list" class="small-box-footer">';
		$content .= 'More <i class="fa fa-arrow-circle-right"></i>';
		$content .= '</a>';
		$content .= '</div>';
		$content .= '</div>';
		
		/** count marca data **/
		$sql_query = "SELECT COUNT(*) AS `total` FROM `marca` LIMIT 0,1" ;
		$result = $mysql->query($sql_query);
		$count = $result->fetch_array();
		$content .= '<div class="col-lg-3 col-xs-6">';
		$content .= '<div class="small-box bg-green">';
		$content .= '<div class="inner">';
		$content .= '<h3>'.$count["total"].'<sup style="font-size: 20px">items</sup></h3>';
		$content .= '<p>marcas</p>';
		$content .= '</div>';
		$content .= '<div class="icon">';
		$content .= '<i class="fa fa-ioxhost"></i>';
		$content .= '</div>';
		$content .= '<a href="?page=marca&amp;action=list" class="small-box-footer">';
		$content .= 'More <i class="fa fa-arrow-circle-right"></i>';
		$content .= '</a>';
		$content .= '</div>';
		$content .= '</div>';
		
		/** count produto data **/
		$sql_query = "SELECT COUNT(*) AS `total` FROM `produto` LIMIT 0,1" ;
		$result = $mysql->query($sql_query);
		$count = $result->fetch_array();
		$content .= '<div class="col-lg-3 col-xs-6">';
		$content .= '<div class="small-box bg-purple">';
		$content .= '<div class="inner">';
		$content .= '<h3>'.$count["total"].'<sup style="font-size: 20px">items</sup></h3>';
		$content .= '<p>produtos</p>';
		$content .= '</div>';
		$content .= '<div class="icon">';
		$content .= '<i class="fa fa-desktop"></i>';
		$content .= '</div>';
		$content .= '<a href="?page=produto&amp;action=list" class="small-box-footer">';
		$content .= 'More <i class="fa fa-arrow-circle-right"></i>';
		$content .= '</a>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '</section>';
		$content .= '</div>';
		$content .= '<footer class="main-footer">';
		$content .= '<div class="pull-right hidden-xs">';
		$content .= '<b>Version</b> 01.01.01';
		$content .= '</div>';
		$content .= '<strong>Copyright &copy; '.date("Y").' <a href="http://www.ocean.com">Ocean</a>.</strong> All rights reserved.';
		$content .= '</footer>';
		$content .= '</div>';
		break;
	// TODO: PAGE - LOGIN
	case "login":
		$page_title = "Login";
		$body_class = "hold-transition login-page";
		$notification = '<p class="login-box-msg text-success">Sign in to start your session</p>';
		if(isset($_POST["submit"])){
			if(filter_var($_POST["user"]["email"], FILTER_VALIDATE_EMAIL)) {
				$user_email = addslashes($_POST["user"]["email"]);
				$user_password = sha1("imabuilder" . $_POST["user"]["password"]);
				$sql_query = "SELECT * FROM `users` WHERE `user_email` = '{$user_email}' AND `user_password` = '{$user_password}'" ;
				$result = $mysql->query($sql_query);
				$current_user = $result->fetch_array();
				if(isset($current_user["user_email"])){
					$_SESSION["IS_LOGIN"] = true;
					$_SESSION["CURRENT_USER"]["user_id"] = $current_user["user_id"];
					$_SESSION["CURRENT_USER"]["user_name"] = $current_user["user_name"];
					$_SESSION["CURRENT_USER"]["user_email"] = $current_user["user_email"];
					$_SESSION["CURRENT_USER"]["user_level"] = $current_user["user_level"];
					header("Location: ?page=home");
				}else{
					$notification =  '<p class="login-box-msg text-danger">Incorrect email or password, please try again</p>';
				}
			}else{
				$notification =  '<p class="login-box-msg text-danger">Incorrect email or password, please try again!</p>';
			}
		}
		$content = null;
		$content .= '<div class="login-box">';
		$content .= '<div class="login-logo">';
		$content .= '<img src="'.$config["logo"].'?1566584351" />';
		$content .= '<br/><a href="?"><b>'. $app_name .'</b> Panel</a>';
		$content .= '</div>';
		$content .= '<div class="login-box-body">';
		$content .= $notification;
		$content .= '<form action="" method="post" autocomplete="off">';
		$content .= '<div class="form-group has-feedback">';
		$content .= '<input type="email" name="user[email]" class="form-control" placeholder="Email" autocomplete="off">';
		$content .= '<span class="glyphicon glyphicon-envelope form-control-feedback"></span>';
		$content .= '</div>';
		$content .= '<div class="form-group has-feedback">';
		$content .= '<input type="password" name="user[password]" class="form-control" placeholder="Password" autocomplete="off">';
		$content .= '<span class="glyphicon glyphicon-lock form-control-feedback"></span>';
		$content .= '</div>';
		$content .= '<div class="row">';
		$content .= '<div class="col-xs-8">';
		$content .= '</div>';
		$content .= '<div class="col-xs-4">';
		$content .= '<button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '</form>';
		$content .= '</div>';
		$content .= '</div>';
		break;
	// TODO: PAGE - LOGOUT
	case "logout":
		session_destroy();
		header("Location: ?page=login");
		break;
	// TODO: PAGE - CATEGORIA
	case "categoria":
		$notification = null;
		if(isset($_GET["notice"])){
			switch($_GET["notice"]){
				case "success-delete":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully deleted the item of the <strong>categorias data</strong>';
					$notification .= '</div>';
					break;
				case "success-edit":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully update the item of the <strong>categorias data</strong>';
					$notification .= '</div>';
					break;
				case "success-add":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully add new item to the <strong>categorias data</strong>';
					$notification .= '</div>';
					break;
				case "wrong-id":
					$notification .= '<div id="notification" class="alert alert-danger">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You did not find ID of this item in <strong>categorias</strong>';
					$notification .= '</div>';
					break;
			}
		}
		if($_SESSION["IS_LOGIN"]==false){
			header("Location: ?page=login");
		}
		$page_title = "categorias";
		$body_class = "hold-transition skin-".$config["color"]." sidebar-mini";
		$current_user = $_SESSION["CURRENT_USER"];
		$content = null;
		$content .= '<div class="wrapper">';
		$content .= '<header class="main-header">';
		$content .= '<a href="?" class="logo">';
		$content .= '<span class="logo-mini"><b>PN</b>L</span>';
		$content .= '<span class="logo-lg"><b>'.$app_name.'</b> Panel</span>';
		$content .= '</a>';
		$content .= '<nav class="navbar navbar-static-top">';
		$content .= '<a href="?" class="sidebar-toggle" data-toggle="push-menu" role="button">';
		$content .= '<span class="sr-only">Toggle navigation</span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '</a>';
		$content .= '<div class="navbar-custom-menu">';
		$content .= '<ul class="nav navbar-nav">';
		$content .= '<li class="dropdown user user-menu">';
		$content .= '<a href="?" class="dropdown-toggle" data-toggle="dropdown">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="user-image" alt="User Image">';
		$content .= '<span class="hidden-xs">' . htmlentities(stripslashes($current_user['user_name'])).'</span>';
		$content .= '</a>';
		$content .= '<ul class="dropdown-menu">';
		$content .= '<li class="user-header">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="User Image">';
		$content .= '<p>';
		$content .= '' . htmlentities(stripslashes($current_user['user_name'])).'';
		$content .= '<small>' . htmlentities(stripslashes($current_user['user_level'])).'</small>';
		$content .= '</p>';
		$content .= '</li>';
		$content .= '<li class="user-footer">';
		$content .= '<div class="pull-left">';
		$content .= '<a href="?page=profile" class="btn btn-default btn-flat">Profile</a>';
		$content .= '</div>';
		$content .= '<div class="pull-right">';
		$content .= '<a href="?page=logout" class="btn btn-default btn-flat">Sign out</a>';
		$content .= '</div>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '<li>';
		$content .= '</ul>';
		$content .= '</div>';
		$content .= '</nav>';
		$content .= '</header>';
		$content .= '<aside class="main-sidebar">';
		$content .= '<section class="sidebar">';
		$content .= '<div class="user-panel">';
		$content .= '<div class="pull-left image">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="'.htmlentities(stripslashes($current_user['user_name'])).'">';
		$content .= '</div>';
		$content .= '<div class="pull-left info">';
		$content .= '<p>'.htmlentities(stripslashes($current_user['user_name'])).'</p>';
		$content .= '<a href="?"><i class="fa fa-circle text-success"></i> '.htmlentities(stripslashes($current_user['user_level'])).'</a>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<ul class="sidebar-menu" data-widget="tree">';
		$content .= '<li class="header">DATA MANAGER</li>';
		$content .= '<li class="treeview active">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-table"></i> <span>categorias</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=categoria&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=categoria&amp;action=list"><i class="fa fa-list-ul"></i> All categorias</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-automobile"></i> <span>entregas</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=entrega&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=entrega&amp;action=list"><i class="fa fa-list-ul"></i> All entregas</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-ioxhost"></i> <span>marcas</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=marca&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=marca&amp;action=list"><i class="fa fa-list-ul"></i> All marcas</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-desktop"></i> <span>produtos</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=produto&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=produto&amp;action=list"><i class="fa fa-list-ul"></i> All produtos</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="header">TOOLS</li>';
		$content .= '<li><a href="?page=onesignal-sender"><i class="fa fa-user"></i> <span>OneSignal Sender</span></a></li>';
		$content .= '<li class="header">USERS</li>';
		$content .= '<li><a href="?page=profile"><i class="fa fa-user"></i> <span>Your Profile</span></a></li>';
		$content .= '</ul>';
		$content .= '</section>';
		$content .= '</aside>';
		$content .= '<div class="content-wrapper">';
		switch($_GET["action"]){
			case "list":
				// TODO: PAGE - CATEGORIA - LIST
				/** breadcrumb **/
				$content .= '<section class="content-header">';
				$content .= '<h1>categorias <small></small></h1>';
				$content .= '<ol class="breadcrumb">';
				$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
				$content .= '<li><a href="?page=produto&amp;action=list">categorias</a></li>';
				$content .= '<li class="active">List</li>';
				$content .= '</ol>';
				$content .= '</section>';
				/** content **/
				$content .= '<section class="content">';
				$content .= $notification;
				$content .= '<div class="box box-danger">';
				$content .= '<div class="box-header with-border">';
				$content .= '<h3 class="box-title">All categorias</h3>';
				$content .= '<div class="box-tools pull-right">';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-body">';
				$content .= '<div class="table-responsive">';
				$content .= '<table class="datatable table table-striped table-hover">';
				$content .= '<thead>';
				$content .= '<tr>';
				$content .= '<th>id</th>';
				$content .= '<th>Imagem</th>';
				$content .= '<th>Nome Categoria</th>';
				$content .= '<th style="width:100px;">#</th>';
				$content .= '</tr>';
				$content .= '</thead>';
				$content .= '<tbody>';
				/** fetch data from mysql **/
				$sql_query = "SELECT * FROM `categoria`" ;
				if($result = $mysql->query($sql_query)){
					while ($data = $result->fetch_array()){
						$content .= '<tr>';
						
						/** id_categoria **/
						$content .= '<td>' . (int)$data["id_categoria"] . '</td>';
						
						/** imagem_categoria **/
						if($data["imagem_categoria"] ==""){
							$data["imagem_categoria"] ="http://placehold.it/800x640";
						}
						$content .= '<td><img width="160" height="120" src="' . htmlentities(stripslashes(strip_tags($data["imagem_categoria"]))) . '" class="img-thumbnail" alt="..."/></td>';
						
						/** nome_categoria **/
						$content .= '<td>' . htmlentities(stripslashes(substr(strip_tags($data["nome_categoria"]),0,64))) . '</td>';
						$content .= '<td>';
						$content .= '<a href="?page=categoria&amp;action=edit&amp;id='.$data["id_categoria"].'" class="btn btn-success btn-flat btn-sm"><i class="fa fa-edit"></i></a>';
						$content .= '<a class="btn btn-danger btn-flat btn-sm" href="#" onClick="doModal(\'Delete categoria\',\'<div class=\\\'row\\\'><div class=\\\'col-md-3 text-center text-primary\\\'><i class=\\\'fa fa-5x fa-table\\\'></i></div><div class=\\\'col-md-9\\\'>You are about to permanently delete these items from your site. <br/>This action cannot be undo, `Cancel` to stop, `OK` to delete.</div></div>\',\'Ok\',\'danger\',\'window.location=\\\'?page=categoria&amp;action=delete&amp;id='.$data["id_categoria"].'\\\'\');"><i class="fa fa-trash"></i></a>';
						$content .= '</td>';
						$content .= '</tr>';
					}
				}
				$content .= '</tbody>';
				$content .= '</table>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</section>';
				break;
			case "edit":
				// TODO: PAGE - CATEGORIA - EDIT
				if(isset($_GET["id"])){
					$entry_id= (int)$_GET["id"];
					/** fetch current data **/
					$sql_query = "SELECT * FROM `categoria` WHERE `id_categoria`=$entry_id LIMIT 0,1" ;
					$result = $mysql->query($sql_query);
					$rowdata = $result->fetch_array();
					if(isset($rowdata["id_categoria"])){
						/** default value **/
						$postdata["imagem-categoria"] = "" ;
						$postdata["nome-categoria"] = "" ;
						/** response postdata **/
						if(isset($_POST["submit"])){
							if(isset($_POST["postdata"]["imagem-categoria"])){
								$postdata["imagem-categoria"] = addslashes($_POST["postdata"]["imagem-categoria"]);
							}
							if(isset($_POST["postdata"]["nome-categoria"])){
								$postdata["nome-categoria"] = addslashes($_POST["postdata"]["nome-categoria"]);
							}
							$sql_query = "UPDATE `categoria` SET `imagem_categoria` = '{$postdata["imagem-categoria"]}' ,`nome_categoria` = '{$postdata["nome-categoria"]}'  WHERE `id_categoria`=$entry_id" ;
							$stmt = $mysql->prepare($sql_query);
							$stmt->execute();
							$stmt->close();
							header("Location: ?page=categoria&action=edit&id=".$entry_id."&notice=success-edit");
						}
						/** init variable field **/
						$postdata["imagem-categoria"] = '';
						if(isset($rowdata["imagem_categoria"])){
							$postdata["imagem-categoria"] = stripslashes($rowdata["imagem_categoria"]);
						}
						$postdata["nome-categoria"] = '';
						if(isset($rowdata["nome_categoria"])){
							$postdata["nome-categoria"] = stripslashes($rowdata["nome_categoria"]);
						}
						/** breadcrumb **/
						$content .= '<section class="content-header">';
						$content .= '<h1>categorias <small></small></h1>';
						$content .= '<ol class="breadcrumb">';
						$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
						$content .= '<li><a href="?">categorias</a></li>';
						$content .= '<li class="active">Edit</li>';
						$content .= '</ol>';
						$content .= '</section>';
						/** content **/
						$content .= '<section class="content">';
						$content .= $notification;
						$content .= '<form action="" method="post">';
						$content .= '<div class="box box-primary">';
						$content .= '<div class="box-header with-border">';
						$content .= '<h3 class="box-title">Edit categoria</h3>';
						$content .= '<div class="box-tools pull-right">';
						$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
						$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<div class="box-body">';
						$content .= '<div class="row">';
						/** field id_categoria:id **/
						/** field imagem_categoria:image **/
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Imagem</label>';
						$content .= '<div class="input-group">';
						$content .= '<input maxlength="128" name="postdata[imagem-categoria]" id="postdata-imagem-categoria" type="text" class="form-control" placeholder="" value="'.htmlentities(stripslashes($postdata['imagem-categoria'])).'" />';
						$content .= '<span class="input-group-btn">';
						$content .= '<button type="button" data-type="file-picker" class="btn btn-default btn-flat" data-target="#postdata-imagem-categoria">';
						$content .= '<i class="fa fa-folder-open"></i></button>';
						$content .= '<a class="btn btn-default btn-flat" target="_blank" href="'.htmlentities(stripslashes($postdata['imagem-categoria'])).'" ><i class="fa fa-eye"></i></a>';
						$content .= '</span>';
						$content .= '</div>';
						$content .= '<p class="help-block"></p>';
						$content .= '</div>';
						$content .= '</div>';
						/** field nome_categoria:varchar **/
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Nome Categoria</label>';
						$content .= '<input maxlength="128" name="postdata[nome-categoria]" id="postdata-nome-categoria" type="text" class="form-control" placeholder="" value="'.htmlentities(stripslashes($postdata['nome-categoria'])).'" />';
						$content .= '<p class="help-block"></p>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<div class="box-footer">';
						$content .= '<button type="submit" class="btn btn-flat btn-primary" name="submit"><i class="fa fa-floppy-o"></i> Update</button>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</form>';
						$content .= '</section>';
					}else{
						header("Location: ?page=categoria&notice=wrong-id");
					}
				}else{
					header("Location: ?page=categoria&notice=wrong-id");
				}
				break;
			case "add":
				// TODO: PAGE - CATEGORIA - ADD
				/** default value **/
				$postdata["imagem-categoria"] = "" ;
				$postdata["nome-categoria"] = "" ;
				/** response postdata **/
				if(isset($_POST["submit"])){
					if(isset($_POST["postdata"]["imagem-categoria"])){
						$postdata["imagem-categoria"] = addslashes($_POST["postdata"]["imagem-categoria"]);
					}
					if(isset($_POST["postdata"]["nome-categoria"])){
						$postdata["nome-categoria"] = addslashes($_POST["postdata"]["nome-categoria"]);
					}
					$sql_query = "INSERT INTO `categoria` (`imagem_categoria`,`nome_categoria`) VALUES ('{$postdata['imagem-categoria']}','{$postdata['nome-categoria']}')" ;
					$stmt = $mysql->prepare($sql_query);
					$stmt->execute();
					$stmt->close();
					header("Location: ?page=categoria&notice=success-add");
				}
				/** breadcrumb **/
				$content .= '<section class="content-header">';
				$content .= '<h1>categorias <small></small></h1>';
				$content .= '<ol class="breadcrumb">';
				$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
				$content .= '<li><a href="?">categorias</a></li>';
				$content .= '<li class="active">Add</li>';
				$content .= '</ol>';
				$content .= '</section>';
				/** content **/
				$content .= '<section class="content">';
				$content .= $notification;
				$content .= '<form action="" method="post">';
				$content .= '<div class="box box-success">';
				$content .= '<div class="box-header with-border">';
				$content .= '<h3 class="box-title">Add new categoria</h3>';
				$content .= '<div class="box-tools pull-right">';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-body">';
				$content .= '<div class="row">';
				/** field id_categoria:id **/
				/** field imagem_categoria:image **/
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Imagem</label>';
				$content .= '<div class="input-group">';
				$content .= '<input maxlength="128" name="postdata[imagem-categoria]" id="postdata-imagem-categoria" type="text" class="form-control" placeholder="" value="'.htmlentities(stripslashes($postdata['imagem-categoria'])).'" />';
				$content .= '<span class="input-group-btn">';
				$content .= '<button type="button" data-type="file-picker" class="btn btn-default btn-flat" data-target="#postdata-imagem-categoria">';
				$content .= '<i class="fa fa-folder-open"></i>';
				$content .= '</button>';
				$content .= '</span>';
				$content .= '</div>';
				$content .= '<p class="help-block"></p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field nome_categoria:varchar **/
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Nome Categoria</label>';
				$content .= '<input maxlength="128" name="postdata[nome-categoria]" id="postdata-nome-categoria" type="text" class="form-control" placeholder="" value="'.htmlentities(stripslashes($postdata['nome-categoria'])).'" />';
				$content .= '<p class="help-block"></p>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-footer">';
				$content .= '<button type="submit" class="btn btn-flat btn-success" name="submit"><i class="fa fa-plus"></i> Add new categoria</button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</form>';
				$content .= '</section>';
				break;
			case "delete":
				// TODO: PAGE - CATEGORIA - DELETE
				if(isset($_GET["id"])){
					$entry_id= (int)$_GET["id"];
					/** fetch current data **/
					$sql_query = "SELECT * FROM `categoria` WHERE `id_categoria`=$entry_id LIMIT 0,1" ;
					$result = $mysql->query($sql_query);
					$rowdata = $result->fetch_array();
					if(isset($rowdata["id_categoria"])){
						$sql_query = "DELETE FROM `categoria` WHERE `id_categoria`=$entry_id";
						$stmt = $mysql->prepare($sql_query);
						$stmt->execute();
						$stmt->close();
						header("Location: ?page=categoria&notice=success-delete");
					}else{
						header("Location: ?page=categoria&notice=wrong-id");
					}
				}
				break;
			}
			$content .= '</div>';
			$content .= '<footer class="main-footer">';
			$content .= '<div class="pull-right hidden-xs">';
			$content .= '<b>Version</b> 01.01.01';
			$content .= '</div>';
			$content .= '<strong>Copyright &copy; '.date("Y").' <a href="http://www.ocean.com">Ocean</a>.</strong> All rights reserved.';
			$content .= '</footer>';
			$content .= '</div>';
			break;
	// TODO: PAGE - ENTREGA
	case "entrega":
		$notification = null;
		if(isset($_GET["notice"])){
			switch($_GET["notice"]){
				case "success-delete":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully deleted the item of the <strong>entregas data</strong>';
					$notification .= '</div>';
					break;
				case "success-edit":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully update the item of the <strong>entregas data</strong>';
					$notification .= '</div>';
					break;
				case "success-add":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully add new item to the <strong>entregas data</strong>';
					$notification .= '</div>';
					break;
				case "wrong-id":
					$notification .= '<div id="notification" class="alert alert-danger">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You did not find ID of this item in <strong>entregas</strong>';
					$notification .= '</div>';
					break;
			}
		}
		if($_SESSION["IS_LOGIN"]==false){
			header("Location: ?page=login");
		}
		$page_title = "entregas";
		$body_class = "hold-transition skin-".$config["color"]." sidebar-mini";
		$current_user = $_SESSION["CURRENT_USER"];
		$content = null;
		$content .= '<div class="wrapper">';
		$content .= '<header class="main-header">';
		$content .= '<a href="?" class="logo">';
		$content .= '<span class="logo-mini"><b>PN</b>L</span>';
		$content .= '<span class="logo-lg"><b>'.$app_name.'</b> Panel</span>';
		$content .= '</a>';
		$content .= '<nav class="navbar navbar-static-top">';
		$content .= '<a href="?" class="sidebar-toggle" data-toggle="push-menu" role="button">';
		$content .= '<span class="sr-only">Toggle navigation</span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '</a>';
		$content .= '<div class="navbar-custom-menu">';
		$content .= '<ul class="nav navbar-nav">';
		$content .= '<li class="dropdown user user-menu">';
		$content .= '<a href="?" class="dropdown-toggle" data-toggle="dropdown">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="user-image" alt="User Image">';
		$content .= '<span class="hidden-xs">' . htmlentities(stripslashes($current_user['user_name'])).'</span>';
		$content .= '</a>';
		$content .= '<ul class="dropdown-menu">';
		$content .= '<li class="user-header">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="User Image">';
		$content .= '<p>';
		$content .= '' . htmlentities(stripslashes($current_user['user_name'])).'';
		$content .= '<small>' . htmlentities(stripslashes($current_user['user_level'])).'</small>';
		$content .= '</p>';
		$content .= '</li>';
		$content .= '<li class="user-footer">';
		$content .= '<div class="pull-left">';
		$content .= '<a href="?page=profile" class="btn btn-default btn-flat">Profile</a>';
		$content .= '</div>';
		$content .= '<div class="pull-right">';
		$content .= '<a href="?page=logout" class="btn btn-default btn-flat">Sign out</a>';
		$content .= '</div>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '<li>';
		$content .= '</ul>';
		$content .= '</div>';
		$content .= '</nav>';
		$content .= '</header>';
		$content .= '<aside class="main-sidebar">';
		$content .= '<section class="sidebar">';
		$content .= '<div class="user-panel">';
		$content .= '<div class="pull-left image">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="'.htmlentities(stripslashes($current_user['user_name'])).'">';
		$content .= '</div>';
		$content .= '<div class="pull-left info">';
		$content .= '<p>'.htmlentities(stripslashes($current_user['user_name'])).'</p>';
		$content .= '<a href="?"><i class="fa fa-circle text-success"></i> '.htmlentities(stripslashes($current_user['user_level'])).'</a>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<ul class="sidebar-menu" data-widget="tree">';
		$content .= '<li class="header">DATA MANAGER</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-table"></i> <span>categorias</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=categoria&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=categoria&amp;action=list"><i class="fa fa-list-ul"></i> All categorias</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview active">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-automobile"></i> <span>entregas</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=entrega&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=entrega&amp;action=list"><i class="fa fa-list-ul"></i> All entregas</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-ioxhost"></i> <span>marcas</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=marca&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=marca&amp;action=list"><i class="fa fa-list-ul"></i> All marcas</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-desktop"></i> <span>produtos</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=produto&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=produto&amp;action=list"><i class="fa fa-list-ul"></i> All produtos</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="header">TOOLS</li>';
		$content .= '<li><a href="?page=onesignal-sender"><i class="fa fa-user"></i> <span>OneSignal Sender</span></a></li>';
		$content .= '<li class="header">USERS</li>';
		$content .= '<li><a href="?page=profile"><i class="fa fa-user"></i> <span>Your Profile</span></a></li>';
		$content .= '</ul>';
		$content .= '</section>';
		$content .= '</aside>';
		$content .= '<div class="content-wrapper">';
		switch($_GET["action"]){
			case "list":
				// TODO: PAGE - ENTREGA - LIST
				/** breadcrumb **/
				$content .= '<section class="content-header">';
				$content .= '<h1>entregas <small></small></h1>';
				$content .= '<ol class="breadcrumb">';
				$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
				$content .= '<li><a href="?page=produto&amp;action=list">entregas</a></li>';
				$content .= '<li class="active">List</li>';
				$content .= '</ol>';
				$content .= '</section>';
				/** content **/
				$content .= '<section class="content">';
				$content .= $notification;
				$content .= '<div class="box box-danger">';
				$content .= '<div class="box-header with-border">';
				$content .= '<h3 class="box-title">All entregas</h3>';
				$content .= '<div class="box-tools pull-right">';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-body">';
				$content .= '<div class="table-responsive">';
				$content .= '<table class="datatable table table-striped table-hover">';
				$content .= '<thead>';
				$content .= '<tr>';
				$content .= '<th>id</th>';
				$content .= '<th>Tempo de Entrega</th>';
				$content .= '<th style="width:100px;">#</th>';
				$content .= '</tr>';
				$content .= '</thead>';
				$content .= '<tbody>';
				/** fetch data from mysql **/
				$sql_query = "SELECT * FROM `entrega`" ;
				if($result = $mysql->query($sql_query)){
					while ($data = $result->fetch_array()){
						$content .= '<tr>';
						
						/** id_entrega **/
						$content .= '<td>' . (int)$data["id_entrega"] . '</td>';
						
						/** tempo_entrega **/
						$content .= '<td>' . htmlentities(stripslashes(substr(strip_tags($data["tempo_entrega"]),0,64))) . '</td>';
						$content .= '<td>';
						$content .= '<a href="?page=entrega&amp;action=edit&amp;id='.$data["id_entrega"].'" class="btn btn-success btn-flat btn-sm"><i class="fa fa-edit"></i></a>';
						$content .= '<a class="btn btn-danger btn-flat btn-sm" href="#" onClick="doModal(\'Delete entrega\',\'<div class=\\\'row\\\'><div class=\\\'col-md-3 text-center text-primary\\\'><i class=\\\'fa fa-5x fa-automobile\\\'></i></div><div class=\\\'col-md-9\\\'>You are about to permanently delete these items from your site. <br/>This action cannot be undo, `Cancel` to stop, `OK` to delete.</div></div>\',\'Ok\',\'danger\',\'window.location=\\\'?page=entrega&amp;action=delete&amp;id='.$data["id_entrega"].'\\\'\');"><i class="fa fa-trash"></i></a>';
						$content .= '</td>';
						$content .= '</tr>';
					}
				}
				$content .= '</tbody>';
				$content .= '</table>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</section>';
				break;
			case "edit":
				// TODO: PAGE - ENTREGA - EDIT
				if(isset($_GET["id"])){
					$entry_id= (int)$_GET["id"];
					/** fetch current data **/
					$sql_query = "SELECT * FROM `entrega` WHERE `id_entrega`=$entry_id LIMIT 0,1" ;
					$result = $mysql->query($sql_query);
					$rowdata = $result->fetch_array();
					if(isset($rowdata["id_entrega"])){
						/** default value **/
						$postdata["tempo-entrega"] = "" ;
						/** response postdata **/
						if(isset($_POST["submit"])){
							if(isset($_POST["postdata"]["tempo-entrega"])){
								$postdata["tempo-entrega"] = addslashes($_POST["postdata"]["tempo-entrega"]);
							}
							$sql_query = "UPDATE `entrega` SET `tempo_entrega` = '{$postdata["tempo-entrega"]}'  WHERE `id_entrega`=$entry_id" ;
							$stmt = $mysql->prepare($sql_query);
							$stmt->execute();
							$stmt->close();
							header("Location: ?page=entrega&action=edit&id=".$entry_id."&notice=success-edit");
						}
						/** init variable field **/
						$postdata["tempo-entrega"] = '';
						if(isset($rowdata["tempo_entrega"])){
							$postdata["tempo-entrega"] = stripslashes($rowdata["tempo_entrega"]);
						}
						/** breadcrumb **/
						$content .= '<section class="content-header">';
						$content .= '<h1>entregas <small></small></h1>';
						$content .= '<ol class="breadcrumb">';
						$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
						$content .= '<li><a href="?">entregas</a></li>';
						$content .= '<li class="active">Edit</li>';
						$content .= '</ol>';
						$content .= '</section>';
						/** content **/
						$content .= '<section class="content">';
						$content .= $notification;
						$content .= '<form action="" method="post">';
						$content .= '<div class="box box-primary">';
						$content .= '<div class="box-header with-border">';
						$content .= '<h3 class="box-title">Edit entrega</h3>';
						$content .= '<div class="box-tools pull-right">';
						$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
						$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<div class="box-body">';
						$content .= '<div class="row">';
						/** field id_entrega:id **/
						/** field tempo_entrega:varchar **/
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Tempo de Entrega</label>';
						$content .= '<input maxlength="128" name="postdata[tempo-entrega]" id="postdata-tempo-entrega" type="text" class="form-control" placeholder="" value="'.htmlentities(stripslashes($postdata['tempo-entrega'])).'" />';
						$content .= '<p class="help-block"></p>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<div class="box-footer">';
						$content .= '<button type="submit" class="btn btn-flat btn-primary" name="submit"><i class="fa fa-floppy-o"></i> Update</button>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</form>';
						$content .= '</section>';
					}else{
						header("Location: ?page=entrega&notice=wrong-id");
					}
				}else{
					header("Location: ?page=entrega&notice=wrong-id");
				}
				break;
			case "add":
				// TODO: PAGE - ENTREGA - ADD
				/** default value **/
				$postdata["tempo-entrega"] = "" ;
				/** response postdata **/
				if(isset($_POST["submit"])){
					if(isset($_POST["postdata"]["tempo-entrega"])){
						$postdata["tempo-entrega"] = addslashes($_POST["postdata"]["tempo-entrega"]);
					}
					$sql_query = "INSERT INTO `entrega` (`tempo_entrega`) VALUES ('{$postdata['tempo-entrega']}')" ;
					$stmt = $mysql->prepare($sql_query);
					$stmt->execute();
					$stmt->close();
					header("Location: ?page=entrega&notice=success-add");
				}
				/** breadcrumb **/
				$content .= '<section class="content-header">';
				$content .= '<h1>entregas <small></small></h1>';
				$content .= '<ol class="breadcrumb">';
				$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
				$content .= '<li><a href="?">entregas</a></li>';
				$content .= '<li class="active">Add</li>';
				$content .= '</ol>';
				$content .= '</section>';
				/** content **/
				$content .= '<section class="content">';
				$content .= $notification;
				$content .= '<form action="" method="post">';
				$content .= '<div class="box box-success">';
				$content .= '<div class="box-header with-border">';
				$content .= '<h3 class="box-title">Add new entrega</h3>';
				$content .= '<div class="box-tools pull-right">';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-body">';
				$content .= '<div class="row">';
				/** field id_entrega:id **/
				/** field tempo_entrega:varchar **/
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Tempo de Entrega</label>';
				$content .= '<input maxlength="128" name="postdata[tempo-entrega]" id="postdata-tempo-entrega" type="text" class="form-control" placeholder="" value="'.htmlentities(stripslashes($postdata['tempo-entrega'])).'" />';
				$content .= '<p class="help-block"></p>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-footer">';
				$content .= '<button type="submit" class="btn btn-flat btn-success" name="submit"><i class="fa fa-plus"></i> Add new entrega</button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</form>';
				$content .= '</section>';
				break;
			case "delete":
				// TODO: PAGE - ENTREGA - DELETE
				if(isset($_GET["id"])){
					$entry_id= (int)$_GET["id"];
					/** fetch current data **/
					$sql_query = "SELECT * FROM `entrega` WHERE `id_entrega`=$entry_id LIMIT 0,1" ;
					$result = $mysql->query($sql_query);
					$rowdata = $result->fetch_array();
					if(isset($rowdata["id_entrega"])){
						$sql_query = "DELETE FROM `entrega` WHERE `id_entrega`=$entry_id";
						$stmt = $mysql->prepare($sql_query);
						$stmt->execute();
						$stmt->close();
						header("Location: ?page=entrega&notice=success-delete");
					}else{
						header("Location: ?page=entrega&notice=wrong-id");
					}
				}
				break;
			}
			$content .= '</div>';
			$content .= '<footer class="main-footer">';
			$content .= '<div class="pull-right hidden-xs">';
			$content .= '<b>Version</b> 01.01.01';
			$content .= '</div>';
			$content .= '<strong>Copyright &copy; '.date("Y").' <a href="http://www.ocean.com">Ocean</a>.</strong> All rights reserved.';
			$content .= '</footer>';
			$content .= '</div>';
			break;
	// TODO: PAGE - MARCA
	case "marca":
		$notification = null;
		if(isset($_GET["notice"])){
			switch($_GET["notice"]){
				case "success-delete":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully deleted the item of the <strong>marcas data</strong>';
					$notification .= '</div>';
					break;
				case "success-edit":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully update the item of the <strong>marcas data</strong>';
					$notification .= '</div>';
					break;
				case "success-add":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully add new item to the <strong>marcas data</strong>';
					$notification .= '</div>';
					break;
				case "wrong-id":
					$notification .= '<div id="notification" class="alert alert-danger">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You did not find ID of this item in <strong>marcas</strong>';
					$notification .= '</div>';
					break;
			}
		}
		if($_SESSION["IS_LOGIN"]==false){
			header("Location: ?page=login");
		}
		$page_title = "marcas";
		$body_class = "hold-transition skin-".$config["color"]." sidebar-mini";
		$current_user = $_SESSION["CURRENT_USER"];
		$content = null;
		$content .= '<div class="wrapper">';
		$content .= '<header class="main-header">';
		$content .= '<a href="?" class="logo">';
		$content .= '<span class="logo-mini"><b>PN</b>L</span>';
		$content .= '<span class="logo-lg"><b>'.$app_name.'</b> Panel</span>';
		$content .= '</a>';
		$content .= '<nav class="navbar navbar-static-top">';
		$content .= '<a href="?" class="sidebar-toggle" data-toggle="push-menu" role="button">';
		$content .= '<span class="sr-only">Toggle navigation</span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '</a>';
		$content .= '<div class="navbar-custom-menu">';
		$content .= '<ul class="nav navbar-nav">';
		$content .= '<li class="dropdown user user-menu">';
		$content .= '<a href="?" class="dropdown-toggle" data-toggle="dropdown">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="user-image" alt="User Image">';
		$content .= '<span class="hidden-xs">' . htmlentities(stripslashes($current_user['user_name'])).'</span>';
		$content .= '</a>';
		$content .= '<ul class="dropdown-menu">';
		$content .= '<li class="user-header">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="User Image">';
		$content .= '<p>';
		$content .= '' . htmlentities(stripslashes($current_user['user_name'])).'';
		$content .= '<small>' . htmlentities(stripslashes($current_user['user_level'])).'</small>';
		$content .= '</p>';
		$content .= '</li>';
		$content .= '<li class="user-footer">';
		$content .= '<div class="pull-left">';
		$content .= '<a href="?page=profile" class="btn btn-default btn-flat">Profile</a>';
		$content .= '</div>';
		$content .= '<div class="pull-right">';
		$content .= '<a href="?page=logout" class="btn btn-default btn-flat">Sign out</a>';
		$content .= '</div>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '<li>';
		$content .= '</ul>';
		$content .= '</div>';
		$content .= '</nav>';
		$content .= '</header>';
		$content .= '<aside class="main-sidebar">';
		$content .= '<section class="sidebar">';
		$content .= '<div class="user-panel">';
		$content .= '<div class="pull-left image">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="'.htmlentities(stripslashes($current_user['user_name'])).'">';
		$content .= '</div>';
		$content .= '<div class="pull-left info">';
		$content .= '<p>'.htmlentities(stripslashes($current_user['user_name'])).'</p>';
		$content .= '<a href="?"><i class="fa fa-circle text-success"></i> '.htmlentities(stripslashes($current_user['user_level'])).'</a>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<ul class="sidebar-menu" data-widget="tree">';
		$content .= '<li class="header">DATA MANAGER</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-table"></i> <span>categorias</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=categoria&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=categoria&amp;action=list"><i class="fa fa-list-ul"></i> All categorias</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-automobile"></i> <span>entregas</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=entrega&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=entrega&amp;action=list"><i class="fa fa-list-ul"></i> All entregas</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview active">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-ioxhost"></i> <span>marcas</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=marca&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=marca&amp;action=list"><i class="fa fa-list-ul"></i> All marcas</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-desktop"></i> <span>produtos</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=produto&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=produto&amp;action=list"><i class="fa fa-list-ul"></i> All produtos</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="header">TOOLS</li>';
		$content .= '<li><a href="?page=onesignal-sender"><i class="fa fa-user"></i> <span>OneSignal Sender</span></a></li>';
		$content .= '<li class="header">USERS</li>';
		$content .= '<li><a href="?page=profile"><i class="fa fa-user"></i> <span>Your Profile</span></a></li>';
		$content .= '</ul>';
		$content .= '</section>';
		$content .= '</aside>';
		$content .= '<div class="content-wrapper">';
		switch($_GET["action"]){
			case "list":
				// TODO: PAGE - MARCA - LIST
				/** breadcrumb **/
				$content .= '<section class="content-header">';
				$content .= '<h1>marcas <small>Marca produto</small></h1>';
				$content .= '<ol class="breadcrumb">';
				$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
				$content .= '<li><a href="?page=produto&amp;action=list">marcas</a></li>';
				$content .= '<li class="active">List</li>';
				$content .= '</ol>';
				$content .= '</section>';
				/** content **/
				$content .= '<section class="content">';
				$content .= $notification;
				$content .= '<div class="box box-danger">';
				$content .= '<div class="box-header with-border">';
				$content .= '<h3 class="box-title">All marcas</h3>';
				$content .= '<div class="box-tools pull-right">';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-body">';
				$content .= '<div class="table-responsive">';
				$content .= '<table class="datatable table table-striped table-hover">';
				$content .= '<thead>';
				$content .= '<tr>';
				$content .= '<th>id</th>';
				$content .= '<th>Imagem</th>';
				$content .= '<th>Nome Marca</th>';
				$content .= '<th style="width:100px;">#</th>';
				$content .= '</tr>';
				$content .= '</thead>';
				$content .= '<tbody>';
				/** fetch data from mysql **/
				$sql_query = "SELECT * FROM `marca`" ;
				if($result = $mysql->query($sql_query)){
					while ($data = $result->fetch_array()){
						$content .= '<tr>';
						
						/** id_marca **/
						$content .= '<td>' . (int)$data["id_marca"] . '</td>';
						
						/** imagem_marca **/
						if($data["imagem_marca"] ==""){
							$data["imagem_marca"] ="http://placehold.it/800x640";
						}
						$content .= '<td><img width="160" height="120" src="' . htmlentities(stripslashes(strip_tags($data["imagem_marca"]))) . '" class="img-thumbnail" alt="..."/></td>';
						
						/** nome_marca **/
						$content .= '<td>' . htmlentities(stripslashes(substr(strip_tags($data["nome_marca"]),0,64))) . '</td>';
						$content .= '<td>';
						$content .= '<a href="?page=marca&amp;action=edit&amp;id='.$data["id_marca"].'" class="btn btn-success btn-flat btn-sm"><i class="fa fa-edit"></i></a>';
						$content .= '<a class="btn btn-danger btn-flat btn-sm" href="#" onClick="doModal(\'Delete marca\',\'<div class=\\\'row\\\'><div class=\\\'col-md-3 text-center text-primary\\\'><i class=\\\'fa fa-5x fa-ioxhost\\\'></i></div><div class=\\\'col-md-9\\\'>You are about to permanently delete these items from your site. <br/>This action cannot be undo, `Cancel` to stop, `OK` to delete.</div></div>\',\'Ok\',\'danger\',\'window.location=\\\'?page=marca&amp;action=delete&amp;id='.$data["id_marca"].'\\\'\');"><i class="fa fa-trash"></i></a>';
						$content .= '</td>';
						$content .= '</tr>';
					}
				}
				$content .= '</tbody>';
				$content .= '</table>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</section>';
				break;
			case "edit":
				// TODO: PAGE - MARCA - EDIT
				if(isset($_GET["id"])){
					$entry_id= (int)$_GET["id"];
					/** fetch current data **/
					$sql_query = "SELECT * FROM `marca` WHERE `id_marca`=$entry_id LIMIT 0,1" ;
					$result = $mysql->query($sql_query);
					$rowdata = $result->fetch_array();
					if(isset($rowdata["id_marca"])){
						/** default value **/
						$postdata["imagem-marca"] = "" ;
						$postdata["nome-marca"] = "" ;
						/** response postdata **/
						if(isset($_POST["submit"])){
							if(isset($_POST["postdata"]["imagem-marca"])){
								$postdata["imagem-marca"] = addslashes($_POST["postdata"]["imagem-marca"]);
							}
							if(isset($_POST["postdata"]["nome-marca"])){
								$postdata["nome-marca"] = addslashes($_POST["postdata"]["nome-marca"]);
							}
							$sql_query = "UPDATE `marca` SET `imagem_marca` = '{$postdata["imagem-marca"]}' ,`nome_marca` = '{$postdata["nome-marca"]}'  WHERE `id_marca`=$entry_id" ;
							$stmt = $mysql->prepare($sql_query);
							$stmt->execute();
							$stmt->close();
							header("Location: ?page=marca&action=edit&id=".$entry_id."&notice=success-edit");
						}
						/** init variable field **/
						$postdata["imagem-marca"] = '';
						if(isset($rowdata["imagem_marca"])){
							$postdata["imagem-marca"] = stripslashes($rowdata["imagem_marca"]);
						}
						$postdata["nome-marca"] = '';
						if(isset($rowdata["nome_marca"])){
							$postdata["nome-marca"] = stripslashes($rowdata["nome_marca"]);
						}
						/** breadcrumb **/
						$content .= '<section class="content-header">';
						$content .= '<h1>marcas <small>Marca produto</small></h1>';
						$content .= '<ol class="breadcrumb">';
						$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
						$content .= '<li><a href="?">marcas</a></li>';
						$content .= '<li class="active">Edit</li>';
						$content .= '</ol>';
						$content .= '</section>';
						/** content **/
						$content .= '<section class="content">';
						$content .= $notification;
						$content .= '<form action="" method="post">';
						$content .= '<div class="box box-primary">';
						$content .= '<div class="box-header with-border">';
						$content .= '<h3 class="box-title">Edit marca</h3>';
						$content .= '<div class="box-tools pull-right">';
						$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
						$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<div class="box-body">';
						$content .= '<div class="row">';
						/** field id_marca:id **/
						/** field imagem_marca:image **/
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Imagem</label>';
						$content .= '<div class="input-group">';
						$content .= '<input maxlength="128" name="postdata[imagem-marca]" id="postdata-imagem-marca" type="text" class="form-control" placeholder="" value="'.htmlentities(stripslashes($postdata['imagem-marca'])).'" />';
						$content .= '<span class="input-group-btn">';
						$content .= '<button type="button" data-type="file-picker" class="btn btn-default btn-flat" data-target="#postdata-imagem-marca">';
						$content .= '<i class="fa fa-folder-open"></i></button>';
						$content .= '<a class="btn btn-default btn-flat" target="_blank" href="'.htmlentities(stripslashes($postdata['imagem-marca'])).'" ><i class="fa fa-eye"></i></a>';
						$content .= '</span>';
						$content .= '</div>';
						$content .= '<p class="help-block"></p>';
						$content .= '</div>';
						$content .= '</div>';
						/** field nome_marca:varchar **/
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Nome Marca</label>';
						$content .= '<input maxlength="128" name="postdata[nome-marca]" id="postdata-nome-marca" type="text" class="form-control" placeholder="" value="'.htmlentities(stripslashes($postdata['nome-marca'])).'" />';
						$content .= '<p class="help-block"></p>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<div class="box-footer">';
						$content .= '<button type="submit" class="btn btn-flat btn-primary" name="submit"><i class="fa fa-floppy-o"></i> Update</button>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</form>';
						$content .= '</section>';
					}else{
						header("Location: ?page=marca&notice=wrong-id");
					}
				}else{
					header("Location: ?page=marca&notice=wrong-id");
				}
				break;
			case "add":
				// TODO: PAGE - MARCA - ADD
				/** default value **/
				$postdata["imagem-marca"] = "" ;
				$postdata["nome-marca"] = "" ;
				/** response postdata **/
				if(isset($_POST["submit"])){
					if(isset($_POST["postdata"]["imagem-marca"])){
						$postdata["imagem-marca"] = addslashes($_POST["postdata"]["imagem-marca"]);
					}
					if(isset($_POST["postdata"]["nome-marca"])){
						$postdata["nome-marca"] = addslashes($_POST["postdata"]["nome-marca"]);
					}
					$sql_query = "INSERT INTO `marca` (`imagem_marca`,`nome_marca`) VALUES ('{$postdata['imagem-marca']}','{$postdata['nome-marca']}')" ;
					$stmt = $mysql->prepare($sql_query);
					$stmt->execute();
					$stmt->close();
					header("Location: ?page=marca&notice=success-add");
				}
				/** breadcrumb **/
				$content .= '<section class="content-header">';
				$content .= '<h1>marcas <small>Marca produto</small></h1>';
				$content .= '<ol class="breadcrumb">';
				$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
				$content .= '<li><a href="?">marcas</a></li>';
				$content .= '<li class="active">Add</li>';
				$content .= '</ol>';
				$content .= '</section>';
				/** content **/
				$content .= '<section class="content">';
				$content .= $notification;
				$content .= '<form action="" method="post">';
				$content .= '<div class="box box-success">';
				$content .= '<div class="box-header with-border">';
				$content .= '<h3 class="box-title">Add new marca</h3>';
				$content .= '<div class="box-tools pull-right">';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-body">';
				$content .= '<div class="row">';
				/** field id_marca:id **/
				/** field imagem_marca:image **/
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Imagem</label>';
				$content .= '<div class="input-group">';
				$content .= '<input maxlength="128" name="postdata[imagem-marca]" id="postdata-imagem-marca" type="text" class="form-control" placeholder="" value="'.htmlentities(stripslashes($postdata['imagem-marca'])).'" />';
				$content .= '<span class="input-group-btn">';
				$content .= '<button type="button" data-type="file-picker" class="btn btn-default btn-flat" data-target="#postdata-imagem-marca">';
				$content .= '<i class="fa fa-folder-open"></i>';
				$content .= '</button>';
				$content .= '</span>';
				$content .= '</div>';
				$content .= '<p class="help-block"></p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field nome_marca:varchar **/
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Nome Marca</label>';
				$content .= '<input maxlength="128" name="postdata[nome-marca]" id="postdata-nome-marca" type="text" class="form-control" placeholder="" value="'.htmlentities(stripslashes($postdata['nome-marca'])).'" />';
				$content .= '<p class="help-block"></p>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-footer">';
				$content .= '<button type="submit" class="btn btn-flat btn-success" name="submit"><i class="fa fa-plus"></i> Add new marca</button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</form>';
				$content .= '</section>';
				break;
			case "delete":
				// TODO: PAGE - MARCA - DELETE
				if(isset($_GET["id"])){
					$entry_id= (int)$_GET["id"];
					/** fetch current data **/
					$sql_query = "SELECT * FROM `marca` WHERE `id_marca`=$entry_id LIMIT 0,1" ;
					$result = $mysql->query($sql_query);
					$rowdata = $result->fetch_array();
					if(isset($rowdata["id_marca"])){
						$sql_query = "DELETE FROM `marca` WHERE `id_marca`=$entry_id";
						$stmt = $mysql->prepare($sql_query);
						$stmt->execute();
						$stmt->close();
						header("Location: ?page=marca&notice=success-delete");
					}else{
						header("Location: ?page=marca&notice=wrong-id");
					}
				}
				break;
			}
			$content .= '</div>';
			$content .= '<footer class="main-footer">';
			$content .= '<div class="pull-right hidden-xs">';
			$content .= '<b>Version</b> 01.01.01';
			$content .= '</div>';
			$content .= '<strong>Copyright &copy; '.date("Y").' <a href="http://www.ocean.com">Ocean</a>.</strong> All rights reserved.';
			$content .= '</footer>';
			$content .= '</div>';
			break;
	// TODO: PAGE - PRODUTO
	case "produto":
		$notification = null;
		if(isset($_GET["notice"])){
			switch($_GET["notice"]){
				case "success-delete":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully deleted the item of the <strong>produtos data</strong>';
					$notification .= '</div>';
					break;
				case "success-edit":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully update the item of the <strong>produtos data</strong>';
					$notification .= '</div>';
					break;
				case "success-add":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully add new item to the <strong>produtos data</strong>';
					$notification .= '</div>';
					break;
				case "wrong-id":
					$notification .= '<div id="notification" class="alert alert-danger">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You did not find ID of this item in <strong>produtos</strong>';
					$notification .= '</div>';
					break;
			}
		}
		if($_SESSION["IS_LOGIN"]==false){
			header("Location: ?page=login");
		}
		$page_title = "produtos";
		$body_class = "hold-transition skin-".$config["color"]." sidebar-mini";
		$current_user = $_SESSION["CURRENT_USER"];
		$content = null;
		$content .= '<div class="wrapper">';
		$content .= '<header class="main-header">';
		$content .= '<a href="?" class="logo">';
		$content .= '<span class="logo-mini"><b>PN</b>L</span>';
		$content .= '<span class="logo-lg"><b>'.$app_name.'</b> Panel</span>';
		$content .= '</a>';
		$content .= '<nav class="navbar navbar-static-top">';
		$content .= '<a href="?" class="sidebar-toggle" data-toggle="push-menu" role="button">';
		$content .= '<span class="sr-only">Toggle navigation</span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '</a>';
		$content .= '<div class="navbar-custom-menu">';
		$content .= '<ul class="nav navbar-nav">';
		$content .= '<li class="dropdown user user-menu">';
		$content .= '<a href="?" class="dropdown-toggle" data-toggle="dropdown">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="user-image" alt="User Image">';
		$content .= '<span class="hidden-xs">' . htmlentities(stripslashes($current_user['user_name'])).'</span>';
		$content .= '</a>';
		$content .= '<ul class="dropdown-menu">';
		$content .= '<li class="user-header">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="User Image">';
		$content .= '<p>';
		$content .= '' . htmlentities(stripslashes($current_user['user_name'])).'';
		$content .= '<small>' . htmlentities(stripslashes($current_user['user_level'])).'</small>';
		$content .= '</p>';
		$content .= '</li>';
		$content .= '<li class="user-footer">';
		$content .= '<div class="pull-left">';
		$content .= '<a href="?page=profile" class="btn btn-default btn-flat">Profile</a>';
		$content .= '</div>';
		$content .= '<div class="pull-right">';
		$content .= '<a href="?page=logout" class="btn btn-default btn-flat">Sign out</a>';
		$content .= '</div>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '<li>';
		$content .= '</ul>';
		$content .= '</div>';
		$content .= '</nav>';
		$content .= '</header>';
		$content .= '<aside class="main-sidebar">';
		$content .= '<section class="sidebar">';
		$content .= '<div class="user-panel">';
		$content .= '<div class="pull-left image">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="'.htmlentities(stripslashes($current_user['user_name'])).'">';
		$content .= '</div>';
		$content .= '<div class="pull-left info">';
		$content .= '<p>'.htmlentities(stripslashes($current_user['user_name'])).'</p>';
		$content .= '<a href="?"><i class="fa fa-circle text-success"></i> '.htmlentities(stripslashes($current_user['user_level'])).'</a>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<ul class="sidebar-menu" data-widget="tree">';
		$content .= '<li class="header">DATA MANAGER</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-table"></i> <span>categorias</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=categoria&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=categoria&amp;action=list"><i class="fa fa-list-ul"></i> All categorias</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-automobile"></i> <span>entregas</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=entrega&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=entrega&amp;action=list"><i class="fa fa-list-ul"></i> All entregas</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-ioxhost"></i> <span>marcas</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=marca&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=marca&amp;action=list"><i class="fa fa-list-ul"></i> All marcas</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview active">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-desktop"></i> <span>produtos</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=produto&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=produto&amp;action=list"><i class="fa fa-list-ul"></i> All produtos</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="header">TOOLS</li>';
		$content .= '<li><a href="?page=onesignal-sender"><i class="fa fa-user"></i> <span>OneSignal Sender</span></a></li>';
		$content .= '<li class="header">USERS</li>';
		$content .= '<li><a href="?page=profile"><i class="fa fa-user"></i> <span>Your Profile</span></a></li>';
		$content .= '</ul>';
		$content .= '</section>';
		$content .= '</aside>';
		$content .= '<div class="content-wrapper">';
		switch($_GET["action"]){
			case "list":
				// TODO: PAGE - PRODUTO - LIST
				/** breadcrumb **/
				$content .= '<section class="content-header">';
				$content .= '<h1>produtos <small></small></h1>';
				$content .= '<ol class="breadcrumb">';
				$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
				$content .= '<li><a href="?page=produto&amp;action=list">produtos</a></li>';
				$content .= '<li class="active">List</li>';
				$content .= '</ol>';
				$content .= '</section>';
				/** content **/
				$content .= '<section class="content">';
				$content .= $notification;
				$content .= '<div class="box box-danger">';
				$content .= '<div class="box-header with-border">';
				$content .= '<h3 class="box-title">All produtos</h3>';
				$content .= '<div class="box-tools pull-right">';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-body">';
				$content .= '<div class="table-responsive">';
				$content .= '<table class="datatable table table-striped table-hover">';
				$content .= '<thead>';
				$content .= '<tr>';
				$content .= '<th>Id</th>';
				$content .= '<th>Categoria Prodsuto</th>';
				$content .= '<th>Imagem Produto</th>';
				$content .= '<th>Produto</th>';
				$content .= '<th>Descrição</th>';
				$content .= '<th>Valor</th>';
				$content .= '<th>Tempoi de Entrega</th>';
				$content .= '<th style="width:100px;">#</th>';
				$content .= '</tr>';
				$content .= '</thead>';
				$content .= '<tbody>';
				/** fetch data from mysql **/
				$sql_query = "SELECT * FROM `produto`" ;
				if($result = $mysql->query($sql_query)){
					while ($data = $result->fetch_array()){
						$content .= '<tr>';
						
						/** id_produto **/
						$content .= '<td>' . (int)$data["id_produto"] . '</td>';
						
						/** categoria_produto **/
						$categoria_text = htmlentities(stripslashes($data["categoria_produto"]));
						$sql_categoria_query = "SELECT * FROM `categoria` WHERE `id_categoria`='{$categoria_text}'" ;
						$categoria_result = $mysql->query($sql_categoria_query);
						if($categoria_result){
							$categoria_result_data = $categoria_result->fetch_array();
							if(isset($categoria_result_data["nome_categoria"])){
								$content .= '<td><span class="label label-success">' . htmlentities(stripslashes($categoria_result_data["nome_categoria"])) . '</span></td>';
							}else{
							$content .= '<td><span class="label label-danger">deleted</span></td>';
							}
						}else{
							$content .= '<td><span class="label label-danger">Not existing table</span></td>';
						}
						
						/** marca_produto **/
						
						/** imagem_produto **/
						if($data["imagem_produto"] ==""){
							$data["imagem_produto"] ="http://placehold.it/800x640";
						}
						$content .= '<td><img width="160" height="120" src="' . htmlentities(stripslashes(strip_tags($data["imagem_produto"]))) . '" class="img-thumbnail" alt="..."/></td>';
						
						/** produto_produto **/
						$content .= '<td>' . htmlentities(stripslashes(substr(strip_tags($data["produto_produto"]),0,64))) . '</td>';
						
						/** descricao_produto **/
						$content .= '<td>' . htmlentities(stripslashes(substr(strip_tags($data["descricao_produto"]),0,64))) . '</td>';
						
						/** valor_produto **/
						$content .= '<td>' . htmlentities(stripslashes(substr(strip_tags($data["valor_produto"]),0,64))) . '</td>';
						
						/** tempoi_de_entrega **/
						$entrega_text = htmlentities(stripslashes($data["tempoi_de_entrega"]));
						$sql_entrega_query = "SELECT * FROM `entrega` WHERE `id_entrega`='{$entrega_text}'" ;
						$entrega_result = $mysql->query($sql_entrega_query);
						if($entrega_result){
							$entrega_result_data = $entrega_result->fetch_array();
							if(isset($entrega_result_data["tempo_entrega"])){
								$content .= '<td><span class="label label-success">' . htmlentities(stripslashes($entrega_result_data["tempo_entrega"])) . '</span></td>';
							}else{
							$content .= '<td><span class="label label-danger">deleted</span></td>';
							}
						}else{
							$content .= '<td><span class="label label-danger">Not existing table</span></td>';
						}
						$content .= '<td>';
						$content .= '<a href="?page=produto&amp;action=edit&amp;id='.$data["id_produto"].'" class="btn btn-success btn-flat btn-sm"><i class="fa fa-edit"></i></a>';
						$content .= '<a class="btn btn-danger btn-flat btn-sm" href="#" onClick="doModal(\'Delete produto\',\'<div class=\\\'row\\\'><div class=\\\'col-md-3 text-center text-primary\\\'><i class=\\\'fa fa-5x fa-desktop\\\'></i></div><div class=\\\'col-md-9\\\'>You are about to permanently delete these items from your site. <br/>This action cannot be undo, `Cancel` to stop, `OK` to delete.</div></div>\',\'Ok\',\'danger\',\'window.location=\\\'?page=produto&amp;action=delete&amp;id='.$data["id_produto"].'\\\'\');"><i class="fa fa-trash"></i></a>';
						$content .= '</td>';
						$content .= '</tr>';
					}
				}
				$content .= '</tbody>';
				$content .= '</table>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</section>';
				break;
			case "edit":
				// TODO: PAGE - PRODUTO - EDIT
				if(isset($_GET["id"])){
					$entry_id= (int)$_GET["id"];
					/** fetch current data **/
					$sql_query = "SELECT * FROM `produto` WHERE `id_produto`=$entry_id LIMIT 0,1" ;
					$result = $mysql->query($sql_query);
					$rowdata = $result->fetch_array();
					if(isset($rowdata["id_produto"])){
						/** default value **/
						$postdata["categoria-produto"] = "" ;
						$postdata["marca-produto"] = "" ;
						$postdata["imagem-produto"] = "" ;
						$postdata["produto-produto"] = "" ;
						$postdata["descricao-produto"] = "" ;
						$postdata["valor-produto"] = "" ;
						$postdata["tempoi-de-entrega"] = "" ;
						/** response postdata **/
						if(isset($_POST["submit"])){
							if(isset($_POST["postdata"]["categoria-produto"])){
								$postdata["categoria-produto"] = addslashes($_POST["postdata"]["categoria-produto"]);
							}
							if(isset($_POST["postdata"]["marca-produto"])){
								$postdata["marca-produto"] = addslashes($_POST["postdata"]["marca-produto"]);
							}
							if(isset($_POST["postdata"]["imagem-produto"])){
								$postdata["imagem-produto"] = addslashes($_POST["postdata"]["imagem-produto"]);
							}
							if(isset($_POST["postdata"]["produto-produto"])){
								$postdata["produto-produto"] = addslashes($_POST["postdata"]["produto-produto"]);
							}
							if(isset($_POST["postdata"]["descricao-produto"])){
								$postdata["descricao-produto"] = addslashes($_POST["postdata"]["descricao-produto"]);
							}
							if(isset($_POST["postdata"]["valor-produto"])){
								$postdata["valor-produto"] = addslashes($_POST["postdata"]["valor-produto"]);
							}
							if(isset($_POST["postdata"]["tempoi-de-entrega"])){
								$postdata["tempoi-de-entrega"] = addslashes($_POST["postdata"]["tempoi-de-entrega"]);
							}
							$sql_query = "UPDATE `produto` SET `categoria_produto` = '{$postdata["categoria-produto"]}' ,`marca_produto` = '{$postdata["marca-produto"]}' ,`imagem_produto` = '{$postdata["imagem-produto"]}' ,`produto_produto` = '{$postdata["produto-produto"]}' ,`descricao_produto` = '{$postdata["descricao-produto"]}' ,`valor_produto` = '{$postdata["valor-produto"]}' ,`tempoi_de_entrega` = '{$postdata["tempoi-de-entrega"]}'  WHERE `id_produto`=$entry_id" ;
							$stmt = $mysql->prepare($sql_query);
							$stmt->execute();
							$stmt->close();
							header("Location: ?page=produto&action=edit&id=".$entry_id."&notice=success-edit");
						}
						/** init variable field **/
						$postdata["categoria-produto"] = '';
						if(isset($rowdata["categoria_produto"])){
							$postdata["categoria-produto"] = stripslashes($rowdata["categoria_produto"]);
						}
						$postdata["marca-produto"] = '';
						if(isset($rowdata["marca_produto"])){
							$postdata["marca-produto"] = stripslashes($rowdata["marca_produto"]);
						}
						$postdata["imagem-produto"] = '';
						if(isset($rowdata["imagem_produto"])){
							$postdata["imagem-produto"] = stripslashes($rowdata["imagem_produto"]);
						}
						$postdata["produto-produto"] = '';
						if(isset($rowdata["produto_produto"])){
							$postdata["produto-produto"] = stripslashes($rowdata["produto_produto"]);
						}
						$postdata["descricao-produto"] = '';
						if(isset($rowdata["descricao_produto"])){
							$postdata["descricao-produto"] = stripslashes($rowdata["descricao_produto"]);
						}
						$postdata["valor-produto"] = '';
						if(isset($rowdata["valor_produto"])){
							$postdata["valor-produto"] = stripslashes($rowdata["valor_produto"]);
						}
						$postdata["tempoi-de-entrega"] = '';
						if(isset($rowdata["tempoi_de_entrega"])){
							$postdata["tempoi-de-entrega"] = stripslashes($rowdata["tempoi_de_entrega"]);
						}
						/** breadcrumb **/
						$content .= '<section class="content-header">';
						$content .= '<h1>produtos <small></small></h1>';
						$content .= '<ol class="breadcrumb">';
						$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
						$content .= '<li><a href="?">produtos</a></li>';
						$content .= '<li class="active">Edit</li>';
						$content .= '</ol>';
						$content .= '</section>';
						/** content **/
						$content .= '<section class="content">';
						$content .= $notification;
						$content .= '<form action="" method="post">';
						$content .= '<div class="box box-primary">';
						$content .= '<div class="box-header with-border">';
						$content .= '<h3 class="box-title">Edit produto</h3>';
						$content .= '<div class="box-tools pull-right">';
						$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
						$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<div class="box-body">';
						$content .= '<div class="row">';
						/** field id_produto:id **/
						/** field categoria_produto:select-table **/
				$options["categoria_produto"] = array();
				$sql_option_query = "SELECT * FROM `categoria`" ;
				$option_result = $mysql->query($sql_option_query);
				if($option_result){
					while ($option_data = $option_result->fetch_array()){
						$options["categoria_produto"][] = array("val"=> $option_data["id_categoria"],"label"=>$option_data["nome_categoria"]);
					}
				}else{
					$options["categoria_produto"][] = array("val"=> "","label"=>"Not existing table");
				}
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Categoria Prodsuto</label>';
				$content .= '<select class="form-control" name="postdata[categoria-produto]" id="postdata-categoria-produto">';
				foreach($options["categoria_produto"] as $option) {
					$selected ="";
					if($option["val"] == $postdata['categoria-produto'] ){
						$selected ="selected";
					}
					$content .= '<option value="'.htmlentities($option["val"]).'" '.$selected.'>'.htmlentities($option["label"]).'</option>';
				}
				$content .= '</select>';
				$content .= '<p class="help-block"></p>';
				$content .= '</div>';
				$content .= '</div>';
						/** field marca_produto:select-table **/
				$options["marca_produto"] = array();
				$sql_option_query = "SELECT * FROM `marca`" ;
				$option_result = $mysql->query($sql_option_query);
				if($option_result){
					while ($option_data = $option_result->fetch_array()){
						$options["marca_produto"][] = array("val"=> $option_data["id_marca"],"label"=>$option_data["nome_marca"]);
					}
				}else{
					$options["marca_produto"][] = array("val"=> "","label"=>"Not existing table");
				}
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Marca Produto</label>';
				$content .= '<select class="form-control" name="postdata[marca-produto]" id="postdata-marca-produto">';
				foreach($options["marca_produto"] as $option) {
					$selected ="";
					if($option["val"] == $postdata['marca-produto'] ){
						$selected ="selected";
					}
					$content .= '<option value="'.htmlentities($option["val"]).'" '.$selected.'>'.htmlentities($option["label"]).'</option>';
				}
				$content .= '</select>';
				$content .= '<p class="help-block"></p>';
				$content .= '</div>';
				$content .= '</div>';
						/** field imagem_produto:image **/
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Imagem Produto</label>';
						$content .= '<div class="input-group">';
						$content .= '<input maxlength="128" name="postdata[imagem-produto]" id="postdata-imagem-produto" type="text" class="form-control" placeholder="" value="'.htmlentities(stripslashes($postdata['imagem-produto'])).'" />';
						$content .= '<span class="input-group-btn">';
						$content .= '<button type="button" data-type="file-picker" class="btn btn-default btn-flat" data-target="#postdata-imagem-produto">';
						$content .= '<i class="fa fa-folder-open"></i></button>';
						$content .= '<a class="btn btn-default btn-flat" target="_blank" href="'.htmlentities(stripslashes($postdata['imagem-produto'])).'" ><i class="fa fa-eye"></i></a>';
						$content .= '</span>';
						$content .= '</div>';
						$content .= '<p class="help-block"></p>';
						$content .= '</div>';
						$content .= '</div>';
						/** field produto_produto:varchar **/
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Produto</label>';
						$content .= '<input maxlength="128" name="postdata[produto-produto]" id="postdata-produto-produto" type="text" class="form-control" placeholder="" value="'.htmlentities(stripslashes($postdata['produto-produto'])).'" />';
						$content .= '<p class="help-block"></p>';
						$content .= '</div>';
						$content .= '</div>';
						/** field descricao_produto:text **/
						$content .= '<div class="col-md-12">';
						$content .= '<div class="form-group">';
						$content .= '<label>Descrição</label>';
						$content .= '<textarea name="postdata[descricao-produto]" id="postdata-descricao-produto" class="form-control" >'.htmlentities(stripslashes($postdata['descricao-produto'])).'</textarea>';
						$content .= '<p class="help-block"></p>';
						$content .= '</div>';
						$content .= '</div>';
						/** field valor_produto:varchar **/
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Valor</label>';
						$content .= '<input maxlength="128" name="postdata[valor-produto]" id="postdata-valor-produto" type="text" class="form-control" placeholder="" value="'.htmlentities(stripslashes($postdata['valor-produto'])).'" />';
						$content .= '<p class="help-block"></p>';
						$content .= '</div>';
						$content .= '</div>';
						/** field tempoi_de_entrega:select-table **/
				$options["tempoi_de_entrega"] = array();
				$sql_option_query = "SELECT * FROM `entrega`" ;
				$option_result = $mysql->query($sql_option_query);
				if($option_result){
					while ($option_data = $option_result->fetch_array()){
						$options["tempoi_de_entrega"][] = array("val"=> $option_data["id_entrega"],"label"=>$option_data["tempo_entrega"]);
					}
				}else{
					$options["tempoi_de_entrega"][] = array("val"=> "","label"=>"Not existing table");
				}
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Tempoi de Entrega</label>';
				$content .= '<select class="form-control" name="postdata[tempoi-de-entrega]" id="postdata-tempoi-de-entrega">';
				foreach($options["tempoi_de_entrega"] as $option) {
					$selected ="";
					if($option["val"] == $postdata['tempoi-de-entrega'] ){
						$selected ="selected";
					}
					$content .= '<option value="'.htmlentities($option["val"]).'" '.$selected.'>'.htmlentities($option["label"]).'</option>';
				}
				$content .= '</select>';
				$content .= '<p class="help-block"></p>';
				$content .= '</div>';
				$content .= '</div>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<div class="box-footer">';
						$content .= '<button type="submit" class="btn btn-flat btn-primary" name="submit"><i class="fa fa-floppy-o"></i> Update</button>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</form>';
						$content .= '</section>';
					}else{
						header("Location: ?page=produto&notice=wrong-id");
					}
				}else{
					header("Location: ?page=produto&notice=wrong-id");
				}
				break;
			case "add":
				// TODO: PAGE - PRODUTO - ADD
				/** default value **/
				$postdata["categoria-produto"] = "" ;
				$postdata["marca-produto"] = "" ;
				$postdata["imagem-produto"] = "" ;
				$postdata["produto-produto"] = "" ;
				$postdata["descricao-produto"] = "" ;
				$postdata["valor-produto"] = "" ;
				$postdata["tempoi-de-entrega"] = "" ;
				/** response postdata **/
				if(isset($_POST["submit"])){
					if(isset($_POST["postdata"]["categoria-produto"])){
						$postdata["categoria-produto"] = addslashes($_POST["postdata"]["categoria-produto"]);
					}
					if(isset($_POST["postdata"]["marca-produto"])){
						$postdata["marca-produto"] = addslashes($_POST["postdata"]["marca-produto"]);
					}
					if(isset($_POST["postdata"]["imagem-produto"])){
						$postdata["imagem-produto"] = addslashes($_POST["postdata"]["imagem-produto"]);
					}
					if(isset($_POST["postdata"]["produto-produto"])){
						$postdata["produto-produto"] = addslashes($_POST["postdata"]["produto-produto"]);
					}
					if(isset($_POST["postdata"]["descricao-produto"])){
						$postdata["descricao-produto"] = addslashes($_POST["postdata"]["descricao-produto"]);
					}
					if(isset($_POST["postdata"]["valor-produto"])){
						$postdata["valor-produto"] = addslashes($_POST["postdata"]["valor-produto"]);
					}
					if(isset($_POST["postdata"]["tempoi-de-entrega"])){
						$postdata["tempoi-de-entrega"] = addslashes($_POST["postdata"]["tempoi-de-entrega"]);
					}
					$sql_query = "INSERT INTO `produto` (`categoria_produto`,`marca_produto`,`imagem_produto`,`produto_produto`,`descricao_produto`,`valor_produto`,`tempoi_de_entrega`) VALUES ('{$postdata['categoria-produto']}','{$postdata['marca-produto']}','{$postdata['imagem-produto']}','{$postdata['produto-produto']}','{$postdata['descricao-produto']}','{$postdata['valor-produto']}','{$postdata['tempoi-de-entrega']}')" ;
					$stmt = $mysql->prepare($sql_query);
					$stmt->execute();
					$stmt->close();
					header("Location: ?page=produto&notice=success-add");
				}
				/** breadcrumb **/
				$content .= '<section class="content-header">';
				$content .= '<h1>produtos <small></small></h1>';
				$content .= '<ol class="breadcrumb">';
				$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
				$content .= '<li><a href="?">produtos</a></li>';
				$content .= '<li class="active">Add</li>';
				$content .= '</ol>';
				$content .= '</section>';
				/** content **/
				$content .= '<section class="content">';
				$content .= $notification;
				$content .= '<form action="" method="post">';
				$content .= '<div class="box box-success">';
				$content .= '<div class="box-header with-border">';
				$content .= '<h3 class="box-title">Add new produto</h3>';
				$content .= '<div class="box-tools pull-right">';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-body">';
				$content .= '<div class="row">';
				/** field id_produto:id **/
				/** field categoria_produto:select-table **/
				$options["categoria_produto"] = array();
				$sql_option_query = "SELECT * FROM `categoria`" ;
				$option_result = $mysql->query($sql_option_query);
				if($option_result){
					while ($option_data = $option_result->fetch_array()){
						$options["categoria_produto"][] = array("val"=> $option_data["id_categoria"],"label"=>$option_data["nome_categoria"]);
					}
				}else{
					$options["categoria_produto"][] = array("val"=> "","label"=>"Not existing table");
				}
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Categoria Prodsuto</label>';
				$content .= '<select class="form-control" name="postdata[categoria-produto]" id="postdata-categoria-produto">';
				foreach($options["categoria_produto"] as $option) {
					$selected ="";
					if($option["val"] == $postdata['categoria-produto'] ){
						$selected ="selected";
					}
					$content .= '<option value="'.htmlentities($option["val"]).'" '.$selected.'>'.htmlentities($option["label"]).'</option>';
				}
				$content .= '</select>';
				$content .= '<p class="help-block"></p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field marca_produto:select-table **/
				$options["marca_produto"] = array();
				$sql_option_query = "SELECT * FROM `marca`" ;
				$option_result = $mysql->query($sql_option_query);
				if($option_result){
					while ($option_data = $option_result->fetch_array()){
						$options["marca_produto"][] = array("val"=> $option_data["id_marca"],"label"=>$option_data["nome_marca"]);
					}
				}else{
					$options["marca_produto"][] = array("val"=> "","label"=>"Not existing table");
				}
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Marca Produto</label>';
				$content .= '<select class="form-control" name="postdata[marca-produto]" id="postdata-marca-produto">';
				foreach($options["marca_produto"] as $option) {
					$selected ="";
					if($option["val"] == $postdata['marca-produto'] ){
						$selected ="selected";
					}
					$content .= '<option value="'.htmlentities($option["val"]).'" '.$selected.'>'.htmlentities($option["label"]).'</option>';
				}
				$content .= '</select>';
				$content .= '<p class="help-block"></p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field imagem_produto:image **/
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Imagem Produto</label>';
				$content .= '<div class="input-group">';
				$content .= '<input maxlength="128" name="postdata[imagem-produto]" id="postdata-imagem-produto" type="text" class="form-control" placeholder="" value="'.htmlentities(stripslashes($postdata['imagem-produto'])).'" />';
				$content .= '<span class="input-group-btn">';
				$content .= '<button type="button" data-type="file-picker" class="btn btn-default btn-flat" data-target="#postdata-imagem-produto">';
				$content .= '<i class="fa fa-folder-open"></i>';
				$content .= '</button>';
				$content .= '</span>';
				$content .= '</div>';
				$content .= '<p class="help-block"></p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field produto_produto:varchar **/
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Produto</label>';
				$content .= '<input maxlength="128" name="postdata[produto-produto]" id="postdata-produto-produto" type="text" class="form-control" placeholder="" value="'.htmlentities(stripslashes($postdata['produto-produto'])).'" />';
				$content .= '<p class="help-block"></p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field descricao_produto:text **/
				$content .= '<div class="col-md-12">';
				$content .= '<div class="form-group">';
				$content .= '<label>Descrição</label>';
				$content .= '<textarea name="postdata[descricao-produto]" id="postdata-descricao-produto" class="form-control" >'.htmlentities(stripslashes($postdata['descricao-produto'])).'</textarea>';
				$content .= '<p class="help-block"></p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field valor_produto:varchar **/
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Valor</label>';
				$content .= '<input maxlength="128" name="postdata[valor-produto]" id="postdata-valor-produto" type="text" class="form-control" placeholder="" value="'.htmlentities(stripslashes($postdata['valor-produto'])).'" />';
				$content .= '<p class="help-block"></p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field tempoi_de_entrega:select-table **/
				$options["tempoi_de_entrega"] = array();
				$sql_option_query = "SELECT * FROM `entrega`" ;
				$option_result = $mysql->query($sql_option_query);
				if($option_result){
					while ($option_data = $option_result->fetch_array()){
						$options["tempoi_de_entrega"][] = array("val"=> $option_data["id_entrega"],"label"=>$option_data["tempo_entrega"]);
					}
				}else{
					$options["tempoi_de_entrega"][] = array("val"=> "","label"=>"Not existing table");
				}
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Tempoi de Entrega</label>';
				$content .= '<select class="form-control" name="postdata[tempoi-de-entrega]" id="postdata-tempoi-de-entrega">';
				foreach($options["tempoi_de_entrega"] as $option) {
					$selected ="";
					if($option["val"] == $postdata['tempoi-de-entrega'] ){
						$selected ="selected";
					}
					$content .= '<option value="'.htmlentities($option["val"]).'" '.$selected.'>'.htmlentities($option["label"]).'</option>';
				}
				$content .= '</select>';
				$content .= '<p class="help-block"></p>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-footer">';
				$content .= '<button type="submit" class="btn btn-flat btn-success" name="submit"><i class="fa fa-plus"></i> Add new produto</button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</form>';
				$content .= '</section>';
				break;
			case "delete":
				// TODO: PAGE - PRODUTO - DELETE
				if(isset($_GET["id"])){
					$entry_id= (int)$_GET["id"];
					/** fetch current data **/
					$sql_query = "SELECT * FROM `produto` WHERE `id_produto`=$entry_id LIMIT 0,1" ;
					$result = $mysql->query($sql_query);
					$rowdata = $result->fetch_array();
					if(isset($rowdata["id_produto"])){
						$sql_query = "DELETE FROM `produto` WHERE `id_produto`=$entry_id";
						$stmt = $mysql->prepare($sql_query);
						$stmt->execute();
						$stmt->close();
						header("Location: ?page=produto&notice=success-delete");
					}else{
						header("Location: ?page=produto&notice=wrong-id");
					}
				}
				break;
			}
			$content .= '</div>';
			$content .= '<footer class="main-footer">';
			$content .= '<div class="pull-right hidden-xs">';
			$content .= '<b>Version</b> 01.01.01';
			$content .= '</div>';
			$content .= '<strong>Copyright &copy; '.date("Y").' <a href="http://www.ocean.com">Ocean</a>.</strong> All rights reserved.';
			$content .= '</footer>';
			$content .= '</div>';
			break;
	// TODO: PAGE - PROFILE
	case "profile":
		if($_SESSION["IS_LOGIN"]==false){
			header("Location: ?page=login");
		}
		$page_title = "Profile";
		$body_class = "hold-transition skin-".$config["color"]." sidebar-mini";
		$notification = null;
		if(isset($_GET["notice"])){
			switch($_GET["notice"]){
				case "success-profile-update":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully update your profile.';
					$notification .= '</div>';
					break;
				case "error-password-too-short":
					$notification .= '<div id="notification" class="alert alert-danger">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'The new password you wrote is too short, at least 6 characters or more';
					$notification .= '</div>';
					break;
				case "error-password-not-same":
					$notification .= '<div id="notification" class="alert alert-danger">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'The new password and new password again are not the same, please try again!';
					$notification .= '</div>';
					break;
				case "error-old-password":
					$notification .= '<div id="notification" class="alert alert-danger">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'Your old password is wrong, please try again!';
					$notification .= '</div>';
					break;
				case "success-password-update":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'Your password has been changed, please logout!';
					$notification .= '</div>';
					break;
			}
		}
		$sql_query = "SELECT * FROM `users` WHERE `user_id` = '{$_SESSION["CURRENT_USER"]["user_id"]}' AND `user_email` = '{$_SESSION["CURRENT_USER"]["user_email"]}'" ;
		$result = $mysql->query($sql_query);
		$current_user = $result->fetch_array();
		if(!isset($current_user["user_email"])){
			header("Location: ?page=login");
		}
		
		/** resp update profile **/
		if(isset($_POST["user-data"])){
			$user_name = addslashes($_POST["postdata"]["user-name"]) ;
			$user_website = addslashes($_POST["postdata"]["user-website"]) ;
			$sql_query = "UPDATE `users` SET `user_name` = '{$user_name}', `user_website` = '{$user_website}' WHERE `user_id` ={$current_user["user_id"]};";
			$stmt = $mysql->prepare($sql_query);
			$stmt->execute();
			$stmt->close();
			$_SESSION["CURRENT_USER"]["user_name"] = $user_name;
			header("Location: ?page=profile&notice=success-profile-update");
		}
		
		/** resp update password **/
		if(isset($_POST["user-password"])){
			if(strlen($_POST["postdata"]["user-new-password"]) >= 6){
				if($_POST["postdata"]["user-new-password"] == $_POST["postdata"]["user-new-password-again"]){
					$old_password_hash = sha1("imabuilder".$_POST["postdata"]["user-old-password"]);
					if($old_password_hash == $current_user["user_password"]){
						$user_password = sha1("imabuilder".$_POST["postdata"]["user-new-password"]);
						$sql_query = "UPDATE `users` SET `user_password` = '{$user_password}' WHERE `user_id` ={$current_user["user_id"]};";
						$stmt = $mysql->prepare($sql_query);
						$stmt->execute();
						$stmt->close();
						header("Location: ?page=profile&notice=success-password-update");
					}else{
						header("Location: ?page=profile&notice=error-old-password");
					}
				}else{
					header("Location: ?page=profile&notice=error-password-not-same");
				}
			}else{
				header("Location: ?page=profile&notice=error-password-too-short");
			}
		}
		
		$content = null;
		$content .= '<div class="wrapper">';
		$content .= '<header class="main-header">';
		$content .= '<a href="?" class="logo">';
		$content .= '<span class="logo-mini"><b>PN</b>L</span>';
		$content .= '<span class="logo-lg"><b>'.$app_name.'</b> Panel</span>';
		$content .= '</a>';
		$content .= '<nav class="navbar navbar-static-top">';
		$content .= '<a href="?" class="sidebar-toggle" data-toggle="push-menu" role="button">';
		$content .= '<span class="sr-only">Toggle navigation</span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '</a>';
		$content .= '<div class="navbar-custom-menu">';
		$content .= '<ul class="nav navbar-nav">';
		$content .= '<li class="dropdown user user-menu">';
		$content .= '<a href="?" class="dropdown-toggle" data-toggle="dropdown">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="user-image" alt="User Image">';
		$content .= '<span class="hidden-xs">' . htmlentities(stripslashes($current_user['user_name'])).'</span>';
		$content .= '</a>';
		$content .= '<ul class="dropdown-menu">';
		$content .= '<li class="user-header">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="User Image">';
		$content .= '<p>';
		$content .= '' . htmlentities(stripslashes($current_user['user_name'])).'';
		$content .= '<small>' . htmlentities(stripslashes($current_user['user_level'])).'</small>';
		$content .= '</p>';
		$content .= '</li>';
		$content .= '<li class="user-footer">';
		$content .= '<div class="pull-left">';
		$content .= '<a href="?page=profile" class="btn btn-default btn-flat">Profile</a>';
		$content .= '</div>';
		$content .= '<div class="pull-right">';
		$content .= '<a href="?page=logout" class="btn btn-default btn-flat">Sign out</a>';
		$content .= '</div>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '</div>';
		$content .= '</nav>';
		$content .= '</header>';
		$content .= '<aside class="main-sidebar">';
		$content .= '<section class="sidebar">';
		$content .= '<div class="user-panel">';
		$content .= '<div class="pull-left image">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="'.htmlentities(stripslashes($current_user['user_name'])).'">';
		$content .= '</div>';
		$content .= '<div class="pull-left info">';
		$content .= '<p>'.htmlentities(stripslashes($current_user['user_name'])).'</p>';
		$content .= '<a href="?"><i class="fa fa-circle text-success"></i> '.htmlentities(stripslashes($current_user['user_level'])).'</a>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<ul class="sidebar-menu" data-widget="tree">';
		$content .= '<li class="header">DATA MANAGER</li>';
		$content .= '<li class="treeview">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-table"></i> <span>categorias</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=categoria&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=categoria&amp;action=list"><i class="fa fa-list-ul"></i> All categorias</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-automobile"></i> <span>entregas</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=entrega&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=entrega&amp;action=list"><i class="fa fa-list-ul"></i> All entregas</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-ioxhost"></i> <span>marcas</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=marca&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=marca&amp;action=list"><i class="fa fa-list-ul"></i> All marcas</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-desktop"></i> <span>produtos</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=produto&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=produto&amp;action=list"><i class="fa fa-list-ul"></i> All produtos</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="header">TOOLS</li>';
		$content .= '<li><a href="?page=onesignal-sender"><i class="fa fa-user"></i> <span>OneSignal Sender</span></a></li>';
		$content .= '<li class="header">USERS</li>';
		$content .= '<li class="active"><a href="?page=profile"><i class="fa fa-user"></i> <span>Your Profile</span></a></li>';
		$content .= '</ul>';
		$content .= '</section>';
		$content .= '</aside>';
		$content .= '<div class="content-wrapper">';
		/** breadcrumb **/
		$content .= '<section class="content-header">';
		$content .= '<h1>Profile <small>Your personal data</small></h1>';
		$content .= '<ol class="breadcrumb">';
		$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
		$content .= '<li class="active">Profile</li>';
		$content .= '</ol>';
		$content .= '</section>';
		/** content **/
		$content .= '<section class="content">';
		$content .= $notification;
		$content .= '<div class="row">';
		$content .= '<div class="col-md-3">';
		$content .= '<div class="box box-primary">';
		$content .= '<div class="box-body box-profile">';
		$content .= '<img class="profile-user-img img-responsive img-circle" src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'?s=128" alt="User profile picture">';
		$content .= '<h3 class="profile-username text-center">' . htmlentities(stripslashes($current_user['user_name'])).'</h3>';
		$content .= '<p class="text-muted text-center">' . htmlentities(stripslashes($current_user['user_level'])).'</p>';
		$content .= '<ul class="list-group list-group-unbordered">';
		
		/** count categoria data **/
		$sql_query = "SELECT COUNT(*) AS `total` FROM `categoria` LIMIT 0,1" ;
		$result = $mysql->query($sql_query);
		$count = $result->fetch_array();
		$content .= '<li class="list-group-item">';
		$content .= '<b>categorias</b> <a class="pull-right">'.$count["total"].'</a>';
		$content .= '</li>';
		
		/** count entrega data **/
		$sql_query = "SELECT COUNT(*) AS `total` FROM `entrega` LIMIT 0,1" ;
		$result = $mysql->query($sql_query);
		$count = $result->fetch_array();
		$content .= '<li class="list-group-item">';
		$content .= '<b>entregas</b> <a class="pull-right">'.$count["total"].'</a>';
		$content .= '</li>';
		
		/** count marca data **/
		$sql_query = "SELECT COUNT(*) AS `total` FROM `marca` LIMIT 0,1" ;
		$result = $mysql->query($sql_query);
		$count = $result->fetch_array();
		$content .= '<li class="list-group-item">';
		$content .= '<b>marcas</b> <a class="pull-right">'.$count["total"].'</a>';
		$content .= '</li>';
		
		/** count produto data **/
		$sql_query = "SELECT COUNT(*) AS `total` FROM `produto` LIMIT 0,1" ;
		$result = $mysql->query($sql_query);
		$count = $result->fetch_array();
		$content .= '<li class="list-group-item">';
		$content .= '<b>produtos</b> <a class="pull-right">'.$count["total"].'</a>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '<a href="https://en.gravatar.com/" target="_blank" class="btn btn-flat btn-primary btn-block"><b>Change Gravatar</b></a>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<div class="col-md-5">';
		$content .= '<form action="" method="post">';
		$content .= '<div class="box box-success">';
		$content .= '<div class="box-header with-border">';
		$content .= '<h3 class="box-title">About Yourself</h3>';
		$content .= '<div class="box-tools pull-right">';
		$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
		$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<div class="box-body">';
		$content .= '<div class="form-group">';
		$content .= '<label>Full Name</label>';
		$content .= '<input name="postdata[user-name]" id="postdata-user-name" type="text" class="form-control" placeholder="Regel Jambak" value="'.htmlentities(stripslashes($current_user['user_name'])).'" />';
		$content .= '<p class="help-block">What is your full name?</p>';
		$content .= '</div>';
		$content .= '<div class="form-group">';
		$content .= '<label>Email Address</label>';
		$content .= '<input name="postdata[user-email]" id="postdata-user-email" type="text" class="form-control" placeholder="regel@ihsana.com" value="'.htmlentities(stripslashes($current_user['user_email'])).'" readonly/>';
		$content .= '<p class="help-block">What is the email address used to log in?</p>';
		$content .= '</div>';
		$content .= '<div class="form-group">';
		$content .= '<label>Website</label>';
		$content .= '<input name="postdata[user-website]" id="postdata-user-website" type="text" class="form-control" placeholder="http://ihsana.com" value="'.htmlentities(stripslashes($current_user['user_website'])).'" />';
		$content .= '<p class="help-block">What is the your website?</p>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<div class="box-footer">';
		$content .= '<button type="submit" class="btn btn-flat btn-success" name="user-data"><i class="fa fa-floppy-o"></i> Update Profile</button>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '</form>';
		$content .= '</div>';
		$content .= '<div class="col-md-4">';
		$content .= '<form action="" method="post">';
		$content .= '<div class="box box-danger">';
		$content .= '<div class="box-header with-border">';
		$content .= '<h3 class="box-title">Account Management</h3>';
		$content .= '<div class="box-tools pull-right">';
		$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
		$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<div class="box-body">';
		$content .= '<div class="form-group">';
		$content .= '<label>Old Password</label>';
		$content .= '<input name="postdata[user-old-password]" id="postdata-user-old-password" type="password" class="form-control" autocomplete="off"/>';
		$content .= '<p class="help-block">What is old password have you used?</p>';
		$content .= '</div>';
		$content .= '<div class="form-group">';
		$content .= '<label>New Password</label>';
		$content .= '<input name="postdata[user-new-password]" id="postdata-user-new-password" type="password" class="form-control" autocomplete="off"/>';
		$content .= '<p class="help-block">What is your new password?</p>';
		$content .= '</div>';
		$content .= '<div class="form-group">';
		$content .= '<label>New Password Again</label>';
		$content .= '<input name="postdata[user-new-password-again]" id="postdata-user-new-password-again" type="password" class="form-control" autocomplete="off"/>';
		$content .= '<p class="help-block">Type again new password</p>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<div class="box-footer">';
		$content .= '<button type="submit" class="btn btn-flat btn-danger" name="user-password"><i class="fa fa-floppy-o"></i> Update</button>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '</form>';
		$content .= '</div>';
		$content .= '</section>';
		$content .= '</div>';
		$content .= '<footer class="main-footer">';
		$content .= '<div class="pull-right hidden-xs">';
		$content .= '<b>Version</b> 01.01.01';
		$content .= '</div>';
		$content .= '<strong>Copyright &copy; '.date("Y").' <a href="http://www.ocean.com">Ocean</a>.</strong> All rights reserved.';
		$content .= '</footer>';
		$content .= '</div>';
		break;
	// TODO: PAGE - FILE-BROWSER
	case "file-browser":
		if($_SESSION["IS_LOGIN"]==false){
			header("Location: ?page=login");
		}
		if(!file_exists("./filebrowser/php/autoload.php")){
			die("elfinder not installed, please download <a target=\"blank\" href=\"https://studio-42.github.io/elFinder/\">elfinder</a> and extracted into `filebrowser` directory");
		}
		$site_url="";
		if(isset($_SERVER["HTTP_REFERER"])){
			$parse_url = parse_url($_SERVER["HTTP_REFERER"]);
			$site_url = $parse_url["scheme"] . "://" . $parse_url["host"] . "/" . dirname($parse_url["path"]) . "/";
		}
		$content .= '<!DOCTYPE HTML>';
		$content .= '<html>';
		$content .= '<head>';
		$content .= '<meta charset="utf-8" />';
		$content .= '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />';
		$content .= '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2" />';
		$content .= '<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css" />';
		$content .= '<link rel="stylesheet" href="./filebrowser/css/elfinder.min.css"/>';
		$content .= '<link rel="stylesheet" href="./filebrowser/css/theme.css"/>';
		$content .= '<title>elFinder</title>';
		$content .= '<style type="text/css">';
		$content .= 'body {padding: 0 !important;margin: 0 !important;}';
		$content .= '#elfinder{z-index:999999999;height: 100%; width: 100%;}';
		$content .= 'div{border-radius: 0 !important;}';
		$content .= '</style>';
		$content .= '</head>';
		$content .= '<body>';
		$content .= '<div id="elfinder"></div>';
		$content .= '<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>';
		$content .= '<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>';
		$content .= '<script src="./filebrowser/js/elfinder.min.js"></script>';
		$content .= '<script type="text/javascript">';
		if(isset($_GET["CKEditor"])){
			$content .= 'function getUrlParam(n){var a=new RegExp("(?:[?&]|&)"+n+"=([^&]+)","i"),e=window.location.search.match(a);return e&&1<e.length?e[1]:null}';
			$content .= 'var userfiles="";$(document).ready(function(){$("#elfinder").elfinder({cssAutoLoad:!1,baseUrl:"./",url:"?page=file-connector",width:"100%",height:"100%",resizable:!1,getFileCallback:function(n,e){var i=n.path;i=i.replace(/\\\\/gi,"/");var t="'.$site_url.'"+i.replace(/src\//gi,"");window.opener.CKEDITOR.tools.callFunction(getUrlParam("CKEditorFuncNum"),t),window.close()}},function(i,n){i.bind("init",function(){"ja"===i.lang&&i.loadScript(["//cdn.rawgit.com/polygonplanet/encoding.js/1.0.26/encoding.min.js"],function(){window.Encoding&&Encoding.convert&&i.registRawStringDecoder(function(n){return Encoding.convert(n,{to:"UNICODE",type:"string"})})},{loadType:"tag"})});var t=document.title;i.bind("open",function(){var n="",e=i.cwd();e&&(n=i.path(e.hash)||null),document.title=n?n+":"+t:t}).bind("destroy",function(){document.title=t})})});';
		}else{
			$content .= 'var userfiles="";$(document).ready(function(){$("#elfinder").elfinder({cssAutoLoad:!1,baseUrl:"./",url:"?page=file-connector",width:"100%",height:"100%",resizable:!1,getFileCallback:function(n,e){var i=n.path;i=i.replace(/\\\\/gi,"/");var t="'.$site_url.'"+i.replace(/src\//gi,"");window.opener.fileBrowser.callBack(t),window.close()}},function(i,n){i.bind("init",function(){"ja"===i.lang&&i.loadScript(["//cdn.rawgit.com/polygonplanet/encoding.js/1.0.26/encoding.min.js"],function(){window.Encoding&&Encoding.convert&&i.registRawStringDecoder(function(n){return Encoding.convert(n,{to:"UNICODE",type:"string"})})},{loadType:"tag"})});var t=document.title;i.bind("open",function(){var n="",e=i.cwd();e&&(n=i.path(e.hash)||null),document.title=n?n+":"+t:t}).bind("destroy",function(){document.title=t})})});';
		}
		$content .= '</script>';
		$content .= '</body>';
		$content .= '</html>';
		die($content);
		break;
	// TODO: PAGE - FILE-CONNECTOR
	case "file-connector":
		if($_SESSION["IS_LOGIN"]==false){
			header("Location: ?page=login");
		}
		if(file_exists("./filebrowser/php/autoload.php")){
			require "./filebrowser/php/autoload.php";
			elFinder::$netDrivers["ftp"] = "FTP";
			function access($attr, $path, $data, $volume, $isDir, $relpath){
				$basename = basename($path);
				return $basename[0] === "."
				&& strlen($relpath) !== 1
					? !($attr == "read" || $attr == "write")
					: null;
			}
			$opts = array( // "debug" => true,
				"roots" => array( // Items volume
					array(
					"driver" => "LocalFileSystem", // driver for accessing file system (REQUIRED)
					"path" => "./userfiles/", // path to files (REQUIRED)
					"URL" => dirname($_SERVER["PHP_SELF"]) . "/userfiles/", // URL to files (REQUIRED)
					"trashHash" => "t1_Lw", // elFinder"s hash of trash folder
					"winHashFix" => DIRECTORY_SEPARATOR !== "/", // to make hash same to Linux one on windows too
					"uploadDeny" => array("all"), // All Mimetypes not allowed to upload
					"uploadAllow" => array(
						"image/x-ms-bmp",
						"image/gif",
						"image/jpeg",
						"image/png",
						"image/x-icon",
						"text/plain"), // Mimetype `image` and `text/plain` allowed to upload
					"uploadOrder" => array("deny", "allow"), // allowed Mimetype `image` and `text/plain` only
					"accessControl" => "access" // disable and hide dot starting files (OPTIONAL)
				), // Trash volume
				array(
					"id" => "1",
					"driver" => "Trash",
					"path" => "./userfiles/.trash/",
					"tmbURL" => dirname($_SERVER["PHP_SELF"]) . "/userfiles/.trash/.tmb/",
					"winHashFix" => DIRECTORY_SEPARATOR !== "/", // to make hash same to Linux one on windows too
					"uploadDeny" => array("all"), // Recomend the same settings as the original volume that uses the trash
					"uploadAllow" => array(
						"image/x-ms-bmp",
						"image/gif",
						"image/jpeg",
						"image/png",
						"image/x-icon",
						"text/plain"), // Same as above
					"uploadOrder" => array("deny", "allow"), // Same as above
					"accessControl" => "access", // Same as above
				)));
			$connector = new elFinderConnector(new elFinder($opts));
			$connector->run();
		}else{
			die("elfinder not installed");
		}
		die($content);
		break;
	// TODO: PAGE - ONESIGNAL-SENDER
	case "onesignal-sender":
		if($_SESSION["IS_LOGIN"]==false){
			header("Location: ?page=login");
		}
		$page_title = "Profile";
		$body_class = "hold-transition skin-".$config["color"]." sidebar-mini";
		$current_user = $_SESSION["CURRENT_USER"];
		$notification = null;
		if(isset($_POST["send-push"])){
			$push_content = array("en" => $_POST["push-message"]);
		
			$fields = array(
				"app_id" => $config["onesignal_app_id"],
				"included_segments" => array("All"),
				"data" => array("page" => ""),
				"contents" => $push_content
			);
		
			$fields = json_encode($fields);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json; charset=utf-8", "Authorization: Basic " . $config["onesignal_app_id"]));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			$response = json_decode(curl_exec($ch), true);
			curl_close($ch);
		
			if (isset($response["errors"][0])){
				$notification .= '<div id="notification" class="alert alert-danger">';
				$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
				$notification .=  $response["errors"][0];
				$notification .= '</div>';
			} else{
				$notification .= '<div id="notification" class="alert alert-success">';
				$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
				$notification .= 'ID #' . $response["id"] . ' with ' . $response["recipients"] . ' recipients';
				$notification .= '</div>';
			}
		
		}
		$content = null;
		$content .= '<div class="wrapper">';
		$content .= '<header class="main-header">';
		$content .= '<a href="?" class="logo">';
		$content .= '<span class="logo-mini"><b>PN</b>L</span>';
		$content .= '<span class="logo-lg"><b>'.$app_name.'</b> Panel</span>';
		$content .= '</a>';
		$content .= '<nav class="navbar navbar-static-top">';
		$content .= '<a href="?" class="sidebar-toggle" data-toggle="push-menu" role="button">';
		$content .= '<span class="sr-only">Toggle navigation</span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '</a>';
		$content .= '<div class="navbar-custom-menu">';
		$content .= '<ul class="nav navbar-nav">';
		$content .= '<li class="dropdown user user-menu">';
		$content .= '<a href="?" class="dropdown-toggle" data-toggle="dropdown">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="user-image" alt="User Image">';
		$content .= '<span class="hidden-xs">' . htmlentities(stripslashes($current_user['user_name'])).'</span>';
		$content .= '</a>';
		$content .= '<ul class="dropdown-menu">';
		$content .= '<li class="user-header">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="User Image">';
		$content .= '<p>';
		$content .= '' . htmlentities(stripslashes($current_user['user_name'])).'';
		$content .= '<small>' . htmlentities(stripslashes($current_user['user_level'])).'</small>';
		$content .= '</p>';
		$content .= '</li>';
		$content .= '<li class="user-footer">';
		$content .= '<div class="pull-left">';
		$content .= '<a href="?page=profile" class="btn btn-default btn-flat">Profile</a>';
		$content .= '</div>';
		$content .= '<div class="pull-right">';
		$content .= '<a href="?page=logout" class="btn btn-default btn-flat">Sign out</a>';
		$content .= '</div>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '</div>';
		$content .= '</nav>';
		$content .= '</header>';
		$content .= '<aside class="main-sidebar">';
		$content .= '<section class="sidebar">';
		$content .= '<div class="user-panel">';
		$content .= '<div class="pull-left image">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="'.htmlentities(stripslashes($current_user['user_name'])).'">';
		$content .= '</div>';
		$content .= '<div class="pull-left info">';
		$content .= '<p>'.htmlentities(stripslashes($current_user['user_name'])).'</p>';
		$content .= '<a href="?"><i class="fa fa-circle text-success"></i> '.htmlentities(stripslashes($current_user['user_level'])).'</a>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<ul class="sidebar-menu" data-widget="tree">';
		$content .= '<li class="header">DATA MANAGER</li>';
		$content .= '<li class="treeview">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-table"></i> <span>categorias</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=categoria&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=categoria&amp;action=list"><i class="fa fa-list-ul"></i> All categorias</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-automobile"></i> <span>entregas</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=entrega&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=entrega&amp;action=list"><i class="fa fa-list-ul"></i> All entregas</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-ioxhost"></i> <span>marcas</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=marca&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=marca&amp;action=list"><i class="fa fa-list-ul"></i> All marcas</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-desktop"></i> <span>produtos</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=produto&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=produto&amp;action=list"><i class="fa fa-list-ul"></i> All produtos</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="header">TOOLS</li>';
		$content .= '<li class="active"><a href="?page=onesignal-sender"><i class="fa fa-user"></i> <span>OneSignal Sender</span></a></li>';
		$content .= '<li class="header">USERS</li>';
		$content .= '<li><a href="?page=profile"><i class="fa fa-user"></i> <span>Your Profile</span></a></li>';
		$content .= '</ul>';
		$content .= '</section>';
		$content .= '</aside>';
		$content .= '<div class="content-wrapper">';
		/** breadcrumb **/
		$content .= '<section class="content-header">';
		$content .= '<h1>OneSignal Sender <small>Send push notifications for your app</small></h1>';
		$content .= '<ol class="breadcrumb">';
		$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
		$content .= '<li class="active">OneSignal Sender</li>';
		$content .= '</ol>';
		$content .= '</section>';
		/** content **/
		$content .= '<section class="content">';
		$content .= '<form action="" method="post">';
		$content .= '<div class="box box-danger">';
		$content .= '<div class="box-header with-border">';
		$content .= '<h3 class="box-title">Push Notification</h3>';
		$content .= '<div class="box-tools pull-right">';
		$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
		$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<div class="box-body">';
		$content .= '<div class="form-group">';
		$content .= '<label class="">Message</label>';
		$content .= '<textarea class="form-control" name="push-message"></textarea>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<div class="box-footer">';
		$content .= '<button type="submit" class="btn btn-flat btn-danger" name="send-push"><i class="fa fa-plane"></i> Send notification!</button>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '</form>';
		$content .= '</section>';
		$content .= '</div><!-- ./content-wrapper -->';
		$content .= '</div><!-- ./wrapper -->';
		break;
}

$html_tags = null;
$html_tags .= '<!DOCTYPE html>';
$html_tags .= '<html>';
$html_tags .= '<head>';
$html_tags .= '<meta charset="utf-8">';
$html_tags .= '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
$html_tags .= '<meta name="generator" content="IMA-BuildeRz vrev19.08.19" />';
$html_tags .= '<title>'. htmlentities($app_name .' | '. $page_title) .'</title>';
$html_tags .= '<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">';
$html_tags .= '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3/dist/css/bootstrap.min.css">';
$html_tags .= '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4/css/font-awesome.min.css">';
$html_tags .= '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@2/dist/css/AdminLTE.min.css">';
$html_tags .= '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@2/dist/css/skins/_all-skins.min.css">';
$html_tags .= '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/datatables.net-bs@1/css/dataTables.bootstrap.min.css">';
$html_tags .= '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/eonasdan-bootstrap-datetimepicker@4/build/css/bootstrap-datetimepicker.min.css">';
$html_tags .= '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/icheck@1/skins/all.css">';
$html_tags .= '<!--[if lt IE 9]>';
$html_tags .= '<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>';
$html_tags .= '<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>';
$html_tags .= '<![endif]-->';
$html_tags .= '<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Anton|Staatliches|Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">';
$html_tags .= '<style type="text/css">';
$html_tags .= 'body{background: url(\''.$config["background"].'\') no-repeat center center fixed !important; -webkit-background-size: cover !important;-moz-background-size: cover !important;-o-background-size: cover !important; background-size: cover !important; }';
$html_tags .= '.well h1 {font-weight:600;font-family:Anton;font-size:48px;}';
$html_tags .= '.content-header h1 {font-size:32px;font-family:Anton;}';
$html_tags .= '.login-logo img {width: 100px;height: 100px;}';
$html_tags .= '.login-logo a, .register-logo a {color: #fff;text-shadow: 1px 1px 1px #333;-webkit-text-shadow: 1px 1px 1px #333;-moz-text-shadow: 1px 1px 1px #333;-o-text-shadow: 1px 1px 1px #333;}';
$html_tags .= '</style>';
$html_tags .= '</head>';
$html_tags .= '<body class="'.$body_class.'">';
$html_tags .= $content ;
$html_tags .= '<script src="https://cdn.jsdelivr.net/npm/jquery@3/dist/jquery.min.js"></script>';
$html_tags .= '<script src="https://cdn.jsdelivr.net/npm/bootstrap@3/dist/js/bootstrap.min.js"></script>';
$html_tags .= '<script src="https://cdn.jsdelivr.net/npm/datatables.net@1/js/jquery.dataTables.min.js"></script>';
$html_tags .= '<script src="https://cdn.jsdelivr.net/npm/datatables.net-bs@1/js/dataTables.bootstrap.min.js"></script>';
$html_tags .= '<script src="https://cdn.jsdelivr.net/npm/ckeditor@4/ckeditor.js"></script>';
$html_tags .= '<script src="https://cdn.jsdelivr.net/npm/ckeditor@4/adapters/jquery.js"></script>';
$html_tags .= '<script src="https://cdn.jsdelivr.net/npm/moment@2/moment.min.js"></script>';
$html_tags .= '<script src="https://cdn.jsdelivr.net/npm/eonasdan-bootstrap-datetimepicker@4/build/js/bootstrap-datetimepicker.min.js"></script>';
$html_tags .= '<script src="https://cdn.jsdelivr.net/npm/icheck@1/icheck.min.js"></script>';
$html_tags .= '<script src="https://cdn.jsdelivr.net/npm/admin-lte@2/dist/js/adminlte.min.js"></script>';
$html_tags .= '<script>';
$html_tags .= '$(document).ready(function(){';
$html_tags .= '$(".sidebar-menu").tree();';
$html_tags .= '$(".datatable").length && $(".datatable").dataTable();';
$html_tags .= '$("textarea[data-type=\'html5\']").length && $("textarea[data-type=\'html5\']").ckeditor({filebrowserBrowseUrl:"?page=file-browser"});';
$html_tags .= '$("input[data-type=\'date\']").length && $("input[data-type=\'date\']").datetimepicker({format:\'YYYY-MM-DD\'});';
$html_tags .= '$("input[data-type=\'datetime\']").length && $("input[data-type=\'datetime\']").datetimepicker({format:"YYYY-MM-DD HH:mm:ss"});';
$html_tags .= '$("input[data-type=\'time\']").length && $("input[data-type=\'time\']").datetimepicker({format:"HH:mm:ss"});';
$html_tags .= '$("input[type=\'radio\'].flat-red").length && $("input[type=\'radio\'].flat-red").iCheck({checkboxClass:"icheckbox_flat-red",radioClass:"iradio_flat-red"});';
$html_tags .= 'var fileBrowserTarget="undefined";window.fileBrowser={callBack:function(a){$(fileBrowserTarget).val(a)},open:function(a){var b=window.open("?page=file-browser","File Browser","scrollbars=no, width=1028, height=480, top="+((window.innerHeight?window.innerHeight:document.documentElement.clientHeight?document.documentElement.clientHeight:screen.height)/2-240+(void 0!=window.screenTop?window.screenTop:window.screenY))+", left="+((window.innerWidth?window.innerWidth:document.documentElement.clientWidth?document.documentElement.clientWidth:screen.width)/2-514+(void 0!=window.screenLeft?window.screenLeft:window.screenX)));fileBrowserTarget=a;window.focus&&b.focus()}};if($(\'*[data-type="file-picker"]\').length)$(\'*[data-type="file-picker"]\').on("click",function(){var a=$(this).attr("data-target");fileBrowser.open(a);return!1});';
$html_tags .= '});';
$html_tags .= 'function doModal(a,l,d,m,t){html=\'<div id="dynamicModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirm-modal" aria-hidden="true">\',html+=\'<div class="modal-dialog">\',html+=\'<div class="modal-content">\',html+=\'<div class="modal-header">\',html+=\'<a class="close" data-dismiss="modal">&times;</a>\',html+="<h4 class=\"modal-title\">"+a+"</h4>",html+="</div>",html+=\'<div class="modal-body">\',html+=l,html+="</div>",html+=\'<div class="modal-footer">\',""!=d&&(html+=\'<span class="btn btn-flat btn-\'+m+\'" onClick="\'+t+\'">\'+d+"</span>"),html+=\'<span class="btn btn-default btn-flat pull-left" data-dismiss="modal">Cancel</span>\',html+="</div>",html+="</div>",html+="</div>",html+="</div>",$("body").append(html),$("#dynamicModal").modal(),$("#dynamicModal").modal("show"),$("#dynamicModal").on("hidden.bs.modal",function(a){$(this).remove()})}';
$html_tags .= 'setTimeout(function(){$("#notification").fadeOut()},5e3);';
$html_tags .= '</script>';
$html_tags .= '</body>';
$html_tags .= '</html>';
echo $html_tags;
