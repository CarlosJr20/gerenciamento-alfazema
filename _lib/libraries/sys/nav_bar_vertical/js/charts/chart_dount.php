 <?php
	 //$username = "carlosad_admin" ;
	// $password = "Cz@38020";
  $connection = new mysqli("162.214.93.1", "carlosad_admin", "Cz@38020", "carlosad_oficial");
$sql = $connection->query("SELECT nome_da_empresa, COUNT(selecao_cliente) as quant FROM selecao_projeto_mp JOIN cliente_mp ON selecao_projeto_mp.selecao_cliente = cliente_mp.id_client GROUP BY nome_da_empresa HAVING COUNT(selecao_cliente) > 0 ORDER BY COUNT(selecao_cliente) DESC");
//$sql = ("SELECT nome_da_empresa, COUNT(selecao_cliente) FROM selecao_projeto_mp JOIN cliente_mp ON selecao_projeto_mp.selecao_cliente = cliente_mp.id_client GROUP BY nome_da_empresa HAVING COUNT(selecao_cliente) > 0 ORDER BY COUNT(selecao_cliente) DESC");

if($sql){ // If $sql is True
	
	//$statement = $connection->prepare($sql);
	//$statement->execute();
	
    	while($results = $sql->fetch_assoc()){
			
			$result[] = $results;
			
       // foreach($exibe as $key => $value){
			    
       // }		
		
		
    }
}

/* $statement = $connection->prepare($sql);

$statement->execute();


while($results = $statement->fetch(PDO::FETCH_ASSOC)) {

    $result[] = $results;
}*/
 //echo $result;
 echo json_encode ($result);
//echo $sql;

  $connection->close();





