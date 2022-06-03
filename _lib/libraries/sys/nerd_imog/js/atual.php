<?php
	
	//echo "<meta HTTP-EQUIV='refresh' CONTENT='1'>";

$connection = new mysqli("162.214.93.1", "carlosad_admin", "Cz@38020", "carlosad_oficial");
$sql = $connection->query("SELECT mode FROM controle_estoque_sync WHERE id_tag = 1 ");


if($sql){ // If $sql is True
    while($exibe = $sql->fetch_assoc()){
        foreach($exibe as $key => $value){
			if( $value == 1){
				 echo "MODO: CADASTRO";
			}
			if($value == 2){
				 echo "MODO: CONSULTA";
				
				}if($value == 0){
				echo "MODO: ";
				}
        }
    }
}
  $connection->close();