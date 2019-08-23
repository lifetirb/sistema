<?php
/**
 * @author Ocean <ocean@ocean.com>
 * @copyright Ocean 2019
 * @package parima
 * 
 * 
 * Created using IMA Builder v2
 */


/** site **/
$config["app-name"]			= "Parima" ; //Write the name of your website
$config["app-desc"]			= "Catalogo Parima" ; //Write a brief description of your website
$config["utf8"]				= true; 
$config["debug"]			= false; 
$config["protect"]			= false; 
$config["url"]			= "https://www.lifeti.com.br/sistema/restiapi.php"; 
$config["timezone"]			= "America/Sao_Paulo" ; // check this site: http://php.net/manual/en/timezones.php

/** mysql **/
$config["db_host"]				= "localhost" ; //host
$config["db_user"]				= "lifetico_bruno" ; //Username SQL
$config["db_pwd"]				= "info47b12*" ; //Password SQL
$config["db_name"]			= "lifetico_entrega" ; //Database


/** DON'T EDIT THE CODE BELLOW **/
session_start();
ini_set("internal_encoding", "utf-8");
date_default_timezone_set($config["timezone"]);
if($config["debug"]==true){
	error_reporting(E_ALL);
}else{
	error_reporting(0);
}

if($config["protect"]==true){
	if(isset($_SERVER["HTTP_USER_AGENT"])){
		if(!preg_match("/parima/i",$_SERVER["HTTP_USER_AGENT"])){
			die("Not allowed");
		}
	}else{
		die("Not allowed");
	}
}

/** CONNECT TO MYSQL **/
$mysql = new mysqli($config["db_host"], $config["db_user"], $config["db_pwd"], $config["db_name"]);
if (mysqli_connect_errno()){
	die(mysqli_connect_error());
}

if($config["utf8"]==true){
	$mysql->set_charset("utf8");
}
if(!isset($_GET["api"])){
	$_GET["api"]= "route";
}
$root_url = $config["url"];
$rest_api=array("data"=>array("status"=>404,"title"=>"Not found"),"title"=>"Error","message"=>"Routes not found");
switch($_GET["api"]){
	case "route":
		// TODO: JSON - ROUTES
		$rest_api=array();
		$rest_api["name"] = "Parima" ;
		$rest_api["description"] = "Catalogo Parima" ;
		$rest_api["generator"] = "IMA-BuildeRz vrev19.08.19" ;

		$rest_api["namespaces"][0] = "categoria/";
		$rest_api["namespaces"][1] = "entrega/";
		$rest_api["namespaces"][2] = "marca/";
		$rest_api["namespaces"][3] = "produto/";

		$rest_api["routes"]["/categoria/"]["namespace"] = "categoria/";
		$rest_api["routes"]["/categoria/"]["methods"][0] = "GET";
		$rest_api["routes"]["/categoria/"]["endpoints"][0]["methods"][0] = "GET";
		$rest_api["routes"]["/categoria/"]["endpoints"][0]["args"]["nome-categoria"]["required"] = false;
		$rest_api["routes"]["/categoria/"]["endpoints"][0]["args"]["nome-categoria"]["default"] = "";
		$rest_api["routes"]["/categoria/"]["endpoints"][0]["args"]["nome-categoria"]["type"] = "string";
		$rest_api["routes"]["/categoria/"]["endpoints"][0]["args"]["nome-categoria"]["description"] = "Limit result set to items with more specific by `nome_categoria`.";

		$rest_api["routes"]["/categoria/"]["endpoints"][0]["args"]["orderby"]["required"] = false;
		$rest_api["routes"]["/categoria/"]["endpoints"][0]["args"]["orderby"]["default"] = "id_categoria";
		$rest_api["routes"]["/categoria/"]["endpoints"][0]["args"]["orderby"]["type"] = "string";
		$rest_api["routes"]["/categoria/"]["endpoints"][0]["args"]["orderby"]["enum"][0] = "id-categoria";
		$rest_api["routes"]["/categoria/"]["endpoints"][0]["args"]["orderby"]["enum"][1] = "imagem-categoria";
		$rest_api["routes"]["/categoria/"]["endpoints"][0]["args"]["orderby"]["enum"][2] = "nome-categoria";
		$rest_api["routes"]["/categoria/"]["endpoints"][0]["args"]["orderby"]["description"] = "Sort collection by object attribute";
		$rest_api["routes"]["/categoria/"]["endpoints"][0]["args"]["sort"]["required"] = false;
		$rest_api["routes"]["/categoria/"]["endpoints"][0]["args"]["sort"]["default"] = "asc";
		$rest_api["routes"]["/categoria/"]["endpoints"][0]["args"]["sort"]["type"] = "string";
		$rest_api["routes"]["/categoria/"]["endpoints"][0]["args"]["sort"]["enum"][0] = "asc";
		$rest_api["routes"]["/categoria/"]["endpoints"][0]["args"]["sort"]["enum"][1] = "desc";
		$rest_api["routes"]["/categoria/"]["endpoints"][0]["args"]["sort"]["description"] = "Order sort attribute ascending or descending";
		$rest_api["routes"]["/categoria/"]["endpoints"][0]["_links"][0] = $root_url . "?api=categoria";

		$rest_api["routes"]["/categoria/(?P<id-categoria>[\d]+)"]["namespace"] = "categoria/";
		$rest_api["routes"]["/categoria/(?P<id-categoria>[\d]+)"]["method"][0] = "GET";
		$rest_api["routes"]["/categoria/(?P<id-categoria>[\d]+)"]["endpoints"]["args"]["id-categoria"]["required"] = "true";
		$rest_api["routes"]["/categoria/(?P<id-categoria>[\d]+)"]["endpoints"]["args"]["id-categoria"]["type"] = "integer";
		$rest_api["routes"]["/categoria/(?P<id-categoria>[\d]+)"]["endpoints"]["args"]["id-categoria"]["description"] = "Unique identifier for the object";
		$rest_api["routes"]["/categoria/(?P<id-categoria>[\d]+)"]["endpoints"]["_links"][0] = $root_url . "?api=categoria&id-categoria=<id-categoria>";

		$rest_api["routes"]["/entrega/"]["namespace"] = "entrega/";
		$rest_api["routes"]["/entrega/"]["methods"][0] = "GET";
		$rest_api["routes"]["/entrega/"]["endpoints"][0]["methods"][0] = "GET";
		$rest_api["routes"]["/entrega/"]["endpoints"][0]["args"]["tempo-entrega"]["required"] = false;
		$rest_api["routes"]["/entrega/"]["endpoints"][0]["args"]["tempo-entrega"]["default"] = "";
		$rest_api["routes"]["/entrega/"]["endpoints"][0]["args"]["tempo-entrega"]["type"] = "string";
		$rest_api["routes"]["/entrega/"]["endpoints"][0]["args"]["tempo-entrega"]["description"] = "Limit result set to items with more specific by `tempo_entrega`.";

		$rest_api["routes"]["/entrega/"]["endpoints"][0]["args"]["orderby"]["required"] = false;
		$rest_api["routes"]["/entrega/"]["endpoints"][0]["args"]["orderby"]["default"] = "id_entrega";
		$rest_api["routes"]["/entrega/"]["endpoints"][0]["args"]["orderby"]["type"] = "string";
		$rest_api["routes"]["/entrega/"]["endpoints"][0]["args"]["orderby"]["enum"][0] = "id-entrega";
		$rest_api["routes"]["/entrega/"]["endpoints"][0]["args"]["orderby"]["enum"][1] = "tempo-entrega";
		$rest_api["routes"]["/entrega/"]["endpoints"][0]["args"]["orderby"]["description"] = "Sort collection by object attribute";
		$rest_api["routes"]["/entrega/"]["endpoints"][0]["args"]["sort"]["required"] = false;
		$rest_api["routes"]["/entrega/"]["endpoints"][0]["args"]["sort"]["default"] = "asc";
		$rest_api["routes"]["/entrega/"]["endpoints"][0]["args"]["sort"]["type"] = "string";
		$rest_api["routes"]["/entrega/"]["endpoints"][0]["args"]["sort"]["enum"][0] = "asc";
		$rest_api["routes"]["/entrega/"]["endpoints"][0]["args"]["sort"]["enum"][1] = "desc";
		$rest_api["routes"]["/entrega/"]["endpoints"][0]["args"]["sort"]["description"] = "Order sort attribute ascending or descending";
		$rest_api["routes"]["/entrega/"]["endpoints"][0]["_links"][0] = $root_url . "?api=entrega";

		$rest_api["routes"]["/entrega/(?P<id-entrega>[\d]+)"]["namespace"] = "entrega/";
		$rest_api["routes"]["/entrega/(?P<id-entrega>[\d]+)"]["method"][0] = "GET";
		$rest_api["routes"]["/entrega/(?P<id-entrega>[\d]+)"]["endpoints"]["args"]["id-entrega"]["required"] = "true";
		$rest_api["routes"]["/entrega/(?P<id-entrega>[\d]+)"]["endpoints"]["args"]["id-entrega"]["type"] = "integer";
		$rest_api["routes"]["/entrega/(?P<id-entrega>[\d]+)"]["endpoints"]["args"]["id-entrega"]["description"] = "Unique identifier for the object";
		$rest_api["routes"]["/entrega/(?P<id-entrega>[\d]+)"]["endpoints"]["_links"][0] = $root_url . "?api=entrega&id-entrega=<id-entrega>";

		$rest_api["routes"]["/marca/"]["namespace"] = "marca/";
		$rest_api["routes"]["/marca/"]["methods"][0] = "GET";
		$rest_api["routes"]["/marca/"]["endpoints"][0]["methods"][0] = "GET";
		$rest_api["routes"]["/marca/"]["endpoints"][0]["args"]["nome-marca"]["required"] = false;
		$rest_api["routes"]["/marca/"]["endpoints"][0]["args"]["nome-marca"]["default"] = "";
		$rest_api["routes"]["/marca/"]["endpoints"][0]["args"]["nome-marca"]["type"] = "string";
		$rest_api["routes"]["/marca/"]["endpoints"][0]["args"]["nome-marca"]["description"] = "Limit result set to items with more specific by `nome_marca`.";

		$rest_api["routes"]["/marca/"]["endpoints"][0]["args"]["orderby"]["required"] = false;
		$rest_api["routes"]["/marca/"]["endpoints"][0]["args"]["orderby"]["default"] = "id_marca";
		$rest_api["routes"]["/marca/"]["endpoints"][0]["args"]["orderby"]["type"] = "string";
		$rest_api["routes"]["/marca/"]["endpoints"][0]["args"]["orderby"]["enum"][0] = "id-marca";
		$rest_api["routes"]["/marca/"]["endpoints"][0]["args"]["orderby"]["enum"][1] = "imagem-marca";
		$rest_api["routes"]["/marca/"]["endpoints"][0]["args"]["orderby"]["enum"][2] = "nome-marca";
		$rest_api["routes"]["/marca/"]["endpoints"][0]["args"]["orderby"]["description"] = "Sort collection by object attribute";
		$rest_api["routes"]["/marca/"]["endpoints"][0]["args"]["sort"]["required"] = false;
		$rest_api["routes"]["/marca/"]["endpoints"][0]["args"]["sort"]["default"] = "asc";
		$rest_api["routes"]["/marca/"]["endpoints"][0]["args"]["sort"]["type"] = "string";
		$rest_api["routes"]["/marca/"]["endpoints"][0]["args"]["sort"]["enum"][0] = "asc";
		$rest_api["routes"]["/marca/"]["endpoints"][0]["args"]["sort"]["enum"][1] = "desc";
		$rest_api["routes"]["/marca/"]["endpoints"][0]["args"]["sort"]["description"] = "Order sort attribute ascending or descending";
		$rest_api["routes"]["/marca/"]["endpoints"][0]["_links"][0] = $root_url . "?api=marca";

		$rest_api["routes"]["/marca/(?P<id-marca>[\d]+)"]["namespace"] = "marca/";
		$rest_api["routes"]["/marca/(?P<id-marca>[\d]+)"]["method"][0] = "GET";
		$rest_api["routes"]["/marca/(?P<id-marca>[\d]+)"]["endpoints"]["args"]["id-marca"]["required"] = "true";
		$rest_api["routes"]["/marca/(?P<id-marca>[\d]+)"]["endpoints"]["args"]["id-marca"]["type"] = "integer";
		$rest_api["routes"]["/marca/(?P<id-marca>[\d]+)"]["endpoints"]["args"]["id-marca"]["description"] = "Unique identifier for the object";
		$rest_api["routes"]["/marca/(?P<id-marca>[\d]+)"]["endpoints"]["_links"][0] = $root_url . "?api=marca&id-marca=<id-marca>";

		$rest_api["routes"]["/produto/"]["namespace"] = "produto/";
		$rest_api["routes"]["/produto/"]["methods"][0] = "GET";
		$rest_api["routes"]["/produto/"]["endpoints"][0]["methods"][0] = "GET";
		$rest_api["routes"]["/produto/"]["endpoints"][0]["args"]["categoria-produto"]["required"] = false;
		$rest_api["routes"]["/produto/"]["endpoints"][0]["args"]["categoria-produto"]["default"] = "";
		$rest_api["routes"]["/produto/"]["endpoints"][0]["args"]["categoria-produto"]["type"] = "string";
		$rest_api["routes"]["/produto/"]["endpoints"][0]["args"]["categoria-produto"]["description"] = "Limit result set to items with more specific by `categoria_produto`.";
		$rest_api["routes"]["/produto/"]["endpoints"][0]["args"]["marca-produto"]["required"] = false;
		$rest_api["routes"]["/produto/"]["endpoints"][0]["args"]["marca-produto"]["default"] = "";
		$rest_api["routes"]["/produto/"]["endpoints"][0]["args"]["marca-produto"]["type"] = "string";
		$rest_api["routes"]["/produto/"]["endpoints"][0]["args"]["marca-produto"]["description"] = "Limit result set to items with more specific by `marca_produto`.";
		$rest_api["routes"]["/produto/"]["endpoints"][0]["args"]["produto-produto"]["required"] = false;
		$rest_api["routes"]["/produto/"]["endpoints"][0]["args"]["produto-produto"]["default"] = "";
		$rest_api["routes"]["/produto/"]["endpoints"][0]["args"]["produto-produto"]["type"] = "string";
		$rest_api["routes"]["/produto/"]["endpoints"][0]["args"]["produto-produto"]["description"] = "Limit result set to items with more specific by `produto_produto`.";
		$rest_api["routes"]["/produto/"]["endpoints"][0]["args"]["descricao-produto"]["required"] = false;
		$rest_api["routes"]["/produto/"]["endpoints"][0]["args"]["descricao-produto"]["default"] = "";
		$rest_api["routes"]["/produto/"]["endpoints"][0]["args"]["descricao-produto"]["type"] = "string";
		$rest_api["routes"]["/produto/"]["endpoints"][0]["args"]["descricao-produto"]["description"] = "Limit result set to items with more specific by `descricao_produto`.";
		$rest_api["routes"]["/produto/"]["endpoints"][0]["args"]["valor-produto"]["required"] = false;
		$rest_api["routes"]["/produto/"]["endpoints"][0]["args"]["valor-produto"]["default"] = "";
		$rest_api["routes"]["/produto/"]["endpoints"][0]["args"]["valor-produto"]["type"] = "string";
		$rest_api["routes"]["/produto/"]["endpoints"][0]["args"]["valor-produto"]["description"] = "Limit result set to items with more specific by `valor_produto`.";
		$rest_api["routes"]["/produto/"]["endpoints"][0]["args"]["tempoi-de-entrega"]["required"] = false;
		$rest_api["routes"]["/produto/"]["endpoints"][0]["args"]["tempoi-de-entrega"]["default"] = "";
		$rest_api["routes"]["/produto/"]["endpoints"][0]["args"]["tempoi-de-entrega"]["type"] = "string";
		$rest_api["routes"]["/produto/"]["endpoints"][0]["args"]["tempoi-de-entrega"]["description"] = "Limit result set to items with more specific by `tempoi_de_entrega`.";

		$rest_api["routes"]["/produto/"]["endpoints"][0]["args"]["orderby"]["required"] = false;
		$rest_api["routes"]["/produto/"]["endpoints"][0]["args"]["orderby"]["default"] = "id_produto";
		$rest_api["routes"]["/produto/"]["endpoints"][0]["args"]["orderby"]["type"] = "string";
		$rest_api["routes"]["/produto/"]["endpoints"][0]["args"]["orderby"]["enum"][0] = "id-produto";
		$rest_api["routes"]["/produto/"]["endpoints"][0]["args"]["orderby"]["enum"][1] = "categoria-produto";
		$rest_api["routes"]["/produto/"]["endpoints"][0]["args"]["orderby"]["enum"][2] = "marca-produto";
		$rest_api["routes"]["/produto/"]["endpoints"][0]["args"]["orderby"]["enum"][3] = "imagem-produto";
		$rest_api["routes"]["/produto/"]["endpoints"][0]["args"]["orderby"]["enum"][4] = "produto-produto";
		$rest_api["routes"]["/produto/"]["endpoints"][0]["args"]["orderby"]["enum"][5] = "descricao-produto";
		$rest_api["routes"]["/produto/"]["endpoints"][0]["args"]["orderby"]["enum"][6] = "valor-produto";
		$rest_api["routes"]["/produto/"]["endpoints"][0]["args"]["orderby"]["enum"][7] = "tempoi-de-entrega";
		$rest_api["routes"]["/produto/"]["endpoints"][0]["args"]["orderby"]["description"] = "Sort collection by object attribute";
		$rest_api["routes"]["/produto/"]["endpoints"][0]["args"]["sort"]["required"] = false;
		$rest_api["routes"]["/produto/"]["endpoints"][0]["args"]["sort"]["default"] = "asc";
		$rest_api["routes"]["/produto/"]["endpoints"][0]["args"]["sort"]["type"] = "string";
		$rest_api["routes"]["/produto/"]["endpoints"][0]["args"]["sort"]["enum"][0] = "asc";
		$rest_api["routes"]["/produto/"]["endpoints"][0]["args"]["sort"]["enum"][1] = "desc";
		$rest_api["routes"]["/produto/"]["endpoints"][0]["args"]["sort"]["description"] = "Order sort attribute ascending or descending";
		$rest_api["routes"]["/produto/"]["endpoints"][0]["_links"][0] = $root_url . "?api=produto";

		$rest_api["routes"]["/produto/(?P<id-produto>[\d]+)"]["namespace"] = "produto/";
		$rest_api["routes"]["/produto/(?P<id-produto>[\d]+)"]["method"][0] = "GET";
		$rest_api["routes"]["/produto/(?P<id-produto>[\d]+)"]["endpoints"]["args"]["id-produto"]["required"] = "true";
		$rest_api["routes"]["/produto/(?P<id-produto>[\d]+)"]["endpoints"]["args"]["id-produto"]["type"] = "integer";
		$rest_api["routes"]["/produto/(?P<id-produto>[\d]+)"]["endpoints"]["args"]["id-produto"]["description"] = "Unique identifier for the object";
		$rest_api["routes"]["/produto/(?P<id-produto>[\d]+)"]["endpoints"]["_links"][0] = $root_url . "?api=produto&id-produto=<id-produto>";		break;
	case "categoria":
		$rest_api = array();
		// TODO: JSON - CATEGORIA
		/** statement `where` **/

		if(isset($_GET["id-categoria"])){
			if($_GET["id-categoria"] != "-1"){
				if($_GET["id-categoria"]=="random"){
					$_GET["orderby"] = "random";
				}else{
					$id = (int)$_GET["id-categoria"] ; 
					$statement[] = "`id_categoria` =$id"; 
				}
			}
		}

		if(isset($_GET["imagem-categoria"])){
			if($_GET["imagem-categoria"] != "-1"){
				$value = $mysql->escape_string($_GET["imagem-categoria"]); 
				$statement[] = "`imagem_categoria` LIKE '%$value%'"; 
			}
		}

		if(isset($_GET["nome-categoria"])){
			if($_GET["nome-categoria"] != "-1"){
				$value = $mysql->escape_string($_GET["nome-categoria"]); 
				$statement[] = "`nome_categoria` LIKE '%$value%'"; 
			}
		}

		$where ="" ;
		if(isset($statement)){
			$where ="WHERE " . implode(" AND ",$statement);
		}
		/** order by **/
		$order_by = "`id_categoria`";
		if(isset($_GET["orderby"])){
			switch($_GET["orderby"]){
			case "id-categoria":
				$order_by = "`id_categoria`";
				break;
			case "imagem-categoria":
				$order_by = "`imagem_categoria`";
				break;
			case "nome-categoria":
				$order_by = "`nome_categoria`";
				break;
			case "random":
				$order_by = "RAND()";
				break;
			}
		}

		/** sort **/
		$sort = "ASC";
		if(isset($_GET["sort"])){
			if($_GET["sort"]=="asc"){
				$sort = "ASC";
			}else{
				$sort = "DESC";
			}
		}

		$sql_query = "SELECT * FROM `categoria` ".$where." ORDER BY ".$order_by." ".$sort.";"; 
		$z=0;
		if($result = $mysql->query($sql_query)){
			while ($data = $result->fetch_array()){
				if(isset($data["id_categoria"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["id_categoria"] = (int) $data["id_categoria"];
				}
				if(isset($data["imagem_categoria"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["imagem_categoria"] = $data["imagem_categoria"];
				}
				if(isset($data["nome_categoria"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["nome_categoria"] = $data["nome_categoria"];
				}
				$rest_api[$z]["_links"]["self"][0] = $root_url . "?api=categoria&id-categoria=". $data["id_categoria"];
				$z++;
			}
			$result->close();
		}
		if(isset($_GET["id-categoria"])){
			if(isset($data_rest_api[0])){
				$rest_api = array();
				$rest_api["id_categoria"] = $data_rest_api[0]["id_categoria"];
				$rest_api["imagem_categoria"] = $data_rest_api[0]["imagem_categoria"];
				$rest_api["nome_categoria"] = $data_rest_api[0]["nome_categoria"];
			}else{
				$rest_api=array("data"=>array("status"=>404,"title"=>"Not found"),"title"=>"Error","message"=>"Invalid ID");
			}
		}
		break;
	case "entrega":
		$rest_api = array();
		// TODO: JSON - ENTREGA
		/** statement `where` **/

		if(isset($_GET["id-entrega"])){
			if($_GET["id-entrega"] != "-1"){
				if($_GET["id-entrega"]=="random"){
					$_GET["orderby"] = "random";
				}else{
					$id = (int)$_GET["id-entrega"] ; 
					$statement[] = "`id_entrega` =$id"; 
				}
			}
		}

		if(isset($_GET["tempo-entrega"])){
			if($_GET["tempo-entrega"] != "-1"){
				$value = $mysql->escape_string($_GET["tempo-entrega"]); 
				$statement[] = "`tempo_entrega` LIKE '%$value%'"; 
			}
		}

		$where ="" ;
		if(isset($statement)){
			$where ="WHERE " . implode(" AND ",$statement);
		}
		/** order by **/
		$order_by = "`id_entrega`";
		if(isset($_GET["orderby"])){
			switch($_GET["orderby"]){
			case "id-entrega":
				$order_by = "`id_entrega`";
				break;
			case "tempo-entrega":
				$order_by = "`tempo_entrega`";
				break;
			case "random":
				$order_by = "RAND()";
				break;
			}
		}

		/** sort **/
		$sort = "ASC";
		if(isset($_GET["sort"])){
			if($_GET["sort"]=="asc"){
				$sort = "ASC";
			}else{
				$sort = "DESC";
			}
		}

		$sql_query = "SELECT * FROM `entrega` ".$where." ORDER BY ".$order_by." ".$sort.";"; 
		$z=0;
		if($result = $mysql->query($sql_query)){
			while ($data = $result->fetch_array()){
				if(isset($data["id_entrega"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["id_entrega"] = (int) $data["id_entrega"];
				}
				if(isset($data["tempo_entrega"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["tempo_entrega"] = $data["tempo_entrega"];
				}
				$rest_api[$z]["_links"]["self"][0] = $root_url . "?api=entrega&id-entrega=". $data["id_entrega"];
				$z++;
			}
			$result->close();
		}
		if(isset($_GET["id-entrega"])){
			if(isset($data_rest_api[0])){
				$rest_api = array();
				$rest_api["id_entrega"] = $data_rest_api[0]["id_entrega"];
				$rest_api["tempo_entrega"] = $data_rest_api[0]["tempo_entrega"];
			}else{
				$rest_api=array("data"=>array("status"=>404,"title"=>"Not found"),"title"=>"Error","message"=>"Invalid ID");
			}
		}
		break;
	case "marca":
		$rest_api = array();
		// TODO: JSON - MARCA
		/** statement `where` **/

		if(isset($_GET["id-marca"])){
			if($_GET["id-marca"] != "-1"){
				if($_GET["id-marca"]=="random"){
					$_GET["orderby"] = "random";
				}else{
					$id = (int)$_GET["id-marca"] ; 
					$statement[] = "`id_marca` =$id"; 
				}
			}
		}

		if(isset($_GET["imagem-marca"])){
			if($_GET["imagem-marca"] != "-1"){
				$value = $mysql->escape_string($_GET["imagem-marca"]); 
				$statement[] = "`imagem_marca` LIKE '%$value%'"; 
			}
		}

		if(isset($_GET["nome-marca"])){
			if($_GET["nome-marca"] != "-1"){
				$value = $mysql->escape_string($_GET["nome-marca"]); 
				$statement[] = "`nome_marca` LIKE '%$value%'"; 
			}
		}

		$where ="" ;
		if(isset($statement)){
			$where ="WHERE " . implode(" AND ",$statement);
		}
		/** order by **/
		$order_by = "`id_marca`";
		if(isset($_GET["orderby"])){
			switch($_GET["orderby"]){
			case "id-marca":
				$order_by = "`id_marca`";
				break;
			case "imagem-marca":
				$order_by = "`imagem_marca`";
				break;
			case "nome-marca":
				$order_by = "`nome_marca`";
				break;
			case "random":
				$order_by = "RAND()";
				break;
			}
		}

		/** sort **/
		$sort = "ASC";
		if(isset($_GET["sort"])){
			if($_GET["sort"]=="asc"){
				$sort = "ASC";
			}else{
				$sort = "DESC";
			}
		}

		$sql_query = "SELECT * FROM `marca` ".$where." ORDER BY ".$order_by." ".$sort.";"; 
		$z=0;
		if($result = $mysql->query($sql_query)){
			while ($data = $result->fetch_array()){
				if(isset($data["id_marca"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["id_marca"] = (int) $data["id_marca"];
				}
				if(isset($data["imagem_marca"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["imagem_marca"] = $data["imagem_marca"];
				}
				if(isset($data["nome_marca"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["nome_marca"] = $data["nome_marca"];
				}
				$rest_api[$z]["_links"]["self"][0] = $root_url . "?api=marca&id-marca=". $data["id_marca"];
				$z++;
			}
			$result->close();
		}
		if(isset($_GET["id-marca"])){
			if(isset($data_rest_api[0])){
				$rest_api = array();
				$rest_api["id_marca"] = $data_rest_api[0]["id_marca"];
				$rest_api["imagem_marca"] = $data_rest_api[0]["imagem_marca"];
				$rest_api["nome_marca"] = $data_rest_api[0]["nome_marca"];
			}else{
				$rest_api=array("data"=>array("status"=>404,"title"=>"Not found"),"title"=>"Error","message"=>"Invalid ID");
			}
		}
		break;
	case "produto":
		$rest_api = array();
		// TODO: JSON - PRODUTO
		/** statement `where` **/

		if(isset($_GET["id-produto"])){
			if($_GET["id-produto"] != "-1"){
				if($_GET["id-produto"]=="random"){
					$_GET["orderby"] = "random";
				}else{
					$id = (int)$_GET["id-produto"] ; 
					$statement[] = "`id_produto` =$id"; 
				}
			}
		}

		if(isset($_GET["categoria-produto"])){
			if($_GET["categoria-produto"] != "-1"){
				$value = $mysql->escape_string($_GET["categoria-produto"]); 
				$statement[] = "`categoria_produto` LIKE '$value'"; 
			}
		}

		if(isset($_GET["marca-produto"])){
			if($_GET["marca-produto"] != "-1"){
				$value = $mysql->escape_string($_GET["marca-produto"]); 
				$statement[] = "`marca_produto` LIKE '$value'"; 
			}
		}

		if(isset($_GET["imagem-produto"])){
			if($_GET["imagem-produto"] != "-1"){
				$value = $mysql->escape_string($_GET["imagem-produto"]); 
				$statement[] = "`imagem_produto` LIKE '%$value%'"; 
			}
		}

		if(isset($_GET["produto-produto"])){
			if($_GET["produto-produto"] != "-1"){
				$value = $mysql->escape_string($_GET["produto-produto"]); 
				$statement[] = "`produto_produto` LIKE '%$value%'"; 
			}
		}

		if(isset($_GET["descricao-produto"])){
			if($_GET["descricao-produto"] != "-1"){
				$value = $mysql->escape_string($_GET["descricao-produto"]); 
				$statement[] = "`descricao_produto` LIKE '%$value%'"; 
			}
		}

		if(isset($_GET["valor-produto"])){
			if($_GET["valor-produto"] != "-1"){
				$value = $mysql->escape_string($_GET["valor-produto"]); 
				$statement[] = "`valor_produto` LIKE '%$value%'"; 
			}
		}

		if(isset($_GET["tempoi-de-entrega"])){
			if($_GET["tempoi-de-entrega"] != "-1"){
				$value = $mysql->escape_string($_GET["tempoi-de-entrega"]); 
				$statement[] = "`tempoi_de_entrega` LIKE '$value'"; 
			}
		}

		$where ="" ;
		if(isset($statement)){
			$where ="WHERE " . implode(" AND ",$statement);
		}
		/** order by **/
		$order_by = "`id_produto`";
		if(isset($_GET["orderby"])){
			switch($_GET["orderby"]){
			case "id-produto":
				$order_by = "`id_produto`";
				break;
			case "categoria-produto":
				$order_by = "`categoria_produto`";
				break;
			case "marca-produto":
				$order_by = "`marca_produto`";
				break;
			case "imagem-produto":
				$order_by = "`imagem_produto`";
				break;
			case "produto-produto":
				$order_by = "`produto_produto`";
				break;
			case "descricao-produto":
				$order_by = "`descricao_produto`";
				break;
			case "valor-produto":
				$order_by = "`valor_produto`";
				break;
			case "tempoi-de-entrega":
				$order_by = "`tempoi_de_entrega`";
				break;
			case "random":
				$order_by = "RAND()";
				break;
			}
		}

		/** sort **/
		$sort = "ASC";
		if(isset($_GET["sort"])){
			if($_GET["sort"]=="asc"){
				$sort = "ASC";
			}else{
				$sort = "DESC";
			}
		}

		$sql_query = "SELECT * FROM `produto` ".$where." ORDER BY ".$order_by." ".$sort.";"; 
		$z=0;
		if($result = $mysql->query($sql_query)){
			while ($data = $result->fetch_array()){
				if(isset($data["id_produto"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["id_produto"] = (int) $data["id_produto"];
				}
				if(isset($data["categoria_produto"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["categoria_produto"]["id"] = $data["categoria_produto"];
					$categoria_id = htmlentities(stripslashes($data["categoria_produto"]));
					$sql_categoria_query = "SELECT * FROM `categoria` WHERE `id_categoria`='{$categoria_id}'" ;
					$categoria_result = $mysql->query($sql_categoria_query);
					if($categoria_result){
						$categoria_result_data = $categoria_result->fetch_array();
						if(isset($categoria_result_data["nome_categoria"])){
							$rest_api[$z]["categoria_produto"]["rendered"] = stripslashes($categoria_result_data["nome_categoria"]);
						}else{
							$rest_api[$z]["categoria_produto"]["rendered"] = "";
						}
					}else{
						$rest_api[$z]["categoria_produto"]["rendered"] = "";
					}
				}
				if(isset($data["marca_produto"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["marca_produto"]["id"] = $data["marca_produto"];
					$marca_id = htmlentities(stripslashes($data["marca_produto"]));
					$sql_marca_query = "SELECT * FROM `marca` WHERE `id_marca`='{$marca_id}'" ;
					$marca_result = $mysql->query($sql_marca_query);
					if($marca_result){
						$marca_result_data = $marca_result->fetch_array();
						if(isset($marca_result_data["nome_marca"])){
							$rest_api[$z]["marca_produto"]["rendered"] = stripslashes($marca_result_data["nome_marca"]);
						}else{
							$rest_api[$z]["marca_produto"]["rendered"] = "";
						}
					}else{
						$rest_api[$z]["marca_produto"]["rendered"] = "";
					}
				}
				if(isset($data["imagem_produto"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["imagem_produto"] = $data["imagem_produto"];
				}
				if(isset($data["produto_produto"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["produto_produto"] = $data["produto_produto"];
				}
				if(isset($data["descricao_produto"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["descricao_produto"] = $data["descricao_produto"];
				}
				if(isset($data["valor_produto"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["valor_produto"] = $data["valor_produto"];
				}
				if(isset($data["tempoi_de_entrega"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["tempoi_de_entrega"]["id"] = $data["tempoi_de_entrega"];
					$entrega_id = htmlentities(stripslashes($data["tempoi_de_entrega"]));
					$sql_entrega_query = "SELECT * FROM `entrega` WHERE `id_entrega`='{$entrega_id}'" ;
					$entrega_result = $mysql->query($sql_entrega_query);
					if($entrega_result){
						$entrega_result_data = $entrega_result->fetch_array();
						if(isset($entrega_result_data["tempo_entrega"])){
							$rest_api[$z]["tempoi_de_entrega"]["rendered"] = stripslashes($entrega_result_data["tempo_entrega"]);
						}else{
							$rest_api[$z]["tempoi_de_entrega"]["rendered"] = "";
						}
					}else{
						$rest_api[$z]["tempoi_de_entrega"]["rendered"] = "";
					}
				}
				$rest_api[$z]["_links"]["self"][0] = $root_url . "?api=produto&id-produto=". $data["id_produto"];
				$z++;
			}
			$result->close();
		}
		if(isset($_GET["id-produto"])){
			if(isset($data_rest_api[0])){
				$rest_api = array();
				$rest_api["id_produto"] = $data_rest_api[0]["id_produto"];
				$rest_api["categoria_produto"] = $data_rest_api[0]["categoria_produto"];
				$rest_api["marca_produto"] = $data_rest_api[0]["marca_produto"];
				$rest_api["imagem_produto"] = $data_rest_api[0]["imagem_produto"];
				$rest_api["produto_produto"] = $data_rest_api[0]["produto_produto"];
				$rest_api["descricao_produto"] = $data_rest_api[0]["descricao_produto"];
				$rest_api["valor_produto"] = $data_rest_api[0]["valor_produto"];
				$rest_api["tempoi_de_entrega"] = $data_rest_api[0]["tempoi_de_entrega"];
			}else{
				$rest_api=array("data"=>array("status"=>404,"title"=>"Not found"),"title"=>"Error","message"=>"Invalid ID");
			}
		}
		break;
}

// TODO: JSON - CROSSDOMAIN
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET,PUT,POST,DELETE,PATCH,OPTIONS');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization,X-Authorization');

if (!isset($_GET["callback"])){
	// TODO: JSON - OUTPUT
	header('Content-type: application/json');
	if(defined("JSON_UNESCAPED_UNICODE")){
		echo json_encode($rest_api,JSON_UNESCAPED_UNICODE);
	}else{
		echo json_encode($rest_api);
	}
}else{
	// TODO: JSONP - OUTPUT
	if(defined("JSON_UNESCAPED_UNICODE")){
		echo strip_tags($_GET["callback"]) ."(". json_encode($rest_api,JSON_UNESCAPED_UNICODE). ");" ;
	}else{
		echo strip_tags($_GET["callback"]) ."(". json_encode($rest_api) . ");" ;
	}
}

