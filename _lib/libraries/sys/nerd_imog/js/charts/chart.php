 <?php
  $connection = new mysqli("162.214.93.1", "carlosad_admin", "Cz@38020", "carlosad_oficial");
$sql = $connection->query("select hora,count(descricao) from controle_estoque_produto");


if($sql){ // If $sql is True
    while($exibe = $sql->fetch_assoc()){
        foreach($exibe as $key => $value){
			    
        }
    }
}
 echo $value;
//echo $sql;

  $connection->close();