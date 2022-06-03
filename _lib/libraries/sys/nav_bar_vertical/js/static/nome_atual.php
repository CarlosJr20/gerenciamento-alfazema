<?php
	$connection = new mysqli("162.214.93.1", "carlosad_admin", "Cz@38020", "carlosad_oficial");
// $sql = $connection->query("set @bloco= (SELECT IF (Bloco=5,"C","A") as Bloco FROM alfazema_veiculo LIMIT 1)");
 $sql = $connection->query("SELECT Nome FROM paciente_helder ORDER BY id_paciente DESC LIMIT 1");
 // $sql = $connection->query("SELECT @bloco");
// set @bloco= (SELECT IF(Bloco=5,"C","A") as Bloco FROM alfazema_veiculo LIMIT 1);

// $sql = $connection->query("SELECT IF(Bloco=5, "C","A") as Bloco FROM `alfazema_veiculo` ORDER BY data DESC LIMIT 1");

if($sql){ // If $sql is True
    while($exibe = $sql->fetch_assoc()){
        foreach($exibe as $key => $value){
			    
        }
    }
}
 echo $value;
//echo $sql;

  $connection->close();
  