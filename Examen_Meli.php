<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Respuesta Meli</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
</head>
    <body>
    <header>
		<div class="container">
			<h3>MELI </h3>
        </div>
				
    </header>
    <div class="container">
	
	<div  class="row">
				
		<form action="Examen_Meli.php"  method="post">       

    <div class="col-xs-12">
    <br>
  </div>

 
  </div> 
     <div class="col-xs-2">
    <input type="text" class="form-control is-invalid" id="seller_id" name="seller_id" placeholder="seller_id"  required>

  </div>
     <div class="col-xs-2">
    <input type="text" class="form-control is-invalid" id="site_id" name="site_id" placeholder="site_id"  required>
  </div>
  <div class="col-xs-2">
  <button class="btn btn-primary" type="submit">Consultar</button>
  </div>
</form>
        </div>
        </div>
  </body> 

</html>
<?php
 #Script para generar un archivo de LOG
 #Recibe argumentos desde input 
 #El primer argumento corresponte al site_ID, 
 #y siguientes es el seller_ID. 
 #
 # @version 1.0
 # @author Argañaraz Leandro <leandromatiasarganaraz@gmail.com>
 if( isset($_POST['site_id']) ) {
  $site_ID=$_POST['site_id'];
  }
  if( isset($_POST['seller_id']) ) {
    $seller_ID=$_POST['seller_id'];
  }
  if(isset($site_ID)&&isset($seller_ID)){
    $data = json_decode( file_get_contents("https://api.mercadolibre.com/sites/$site_ID/search?seller_id=$seller_ID"), true );
    $datafilter = $data['results'];
      foreach($datafilter as $dat){
        $a = $dat['category_id'];
        $dataname = json_decode( file_get_contents("https://api.mercadolibre.com/categories/$a"), true );
        $ar=fopen("output.log","a") or die("problemas en la creacion del archivo");
        echo  "id=" . $dat['id'] . ",". "title=" . $dat['title'] . "," . "category_id=" . $dat['category_id'] .",". "name=" .  $dataname['name'] . "</br>";
        fputs($ar, "id=" . $dat['id'].",". "title=" . $dat['title'].",". "category_id=" . $dat['category_id'] .",".  "name=" . $dataname['name']);
        fputs($ar,"\n");
    }
  }
  
?>
