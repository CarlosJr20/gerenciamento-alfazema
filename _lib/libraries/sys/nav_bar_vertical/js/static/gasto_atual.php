<?php
	$connection = new mysqli("162.214.93.1", "carlosad_admin", "Cz@38020", "carlosad_oficial");


$sql = $connection->query("set @alimentacao = (SELECT alimentacao FROM despesas_mp ORDER BY data,hora DESC LIMIT 1)");
$sql = $connection->query("set @transporte = (SELECT transporte FROM despesas_mp ORDER BY data,hora DESC LIMIT 1)");
$sql = $connection->query("set @outros = (SELECT outros FROM despesas_mp ORDER BY data,hora DESC LIMIT 1)");
$sql = $connection->query("set @soma = (select sum(@alimentacao + @transporte + @outros))");
$sql = $connection->query("set @format = (Select format(@soma,2,'de_DE'))");
$sql = $connection->query("Select Concat('R$ ',Replace(Replace(Replace(@format, ',', '|'), ',', '.'), '|', ','))");


if($sql){ // If $sql is True
    while($exibe = $sql->fetch_assoc()){
        foreach($exibe as $key => $value){
			    
        }
    }
}
 echo $value;
//echo $sql;

  $connection->close();
  