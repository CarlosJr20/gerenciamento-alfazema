<?php
	$connection = new mysqli("162.214.93.1", "carlosad_admin", "Cz@38020", "carlosad_oficial");
$sql = $connection->query("SELECT mode FROM controle_estoque_sync WHERE id_tag = 0 ");

if($sql){ // If $sql is True
    while($exibe = $sql->fetch_assoc()){
        foreach($exibe as $key => $value){
			    
        }
    }
}
 echo $value['mode'];

  $connection->close();
  ?>