<?php
	$connection = new mysqli("162.214.93.1", "carlosad_admin", "Cz@38020", "carlosad_oficial");
$sql = $connection->query("SELECT data, nome_do_projeto FROM selecao_projeto_mp ORDER BY data DESC LIMIT 1");


if($sql){ // If $sql is True
    while($exibe = $sql->fetch_assoc()){
        foreach($exibe as $key => $value){
			    
        }
    }
}
 echo $value;
//echo $sql;

  $connection->close();
  