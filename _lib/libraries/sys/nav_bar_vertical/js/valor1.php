/*$connection = new mysqli("162.214.93.1", "carlosad_admin", "Cz@38020", "carlosad_oficial");

$sql = $connection->query("select count(id) from controle_estoque_produto where fix = 0");



if($sql){
	 while($exibe = $sql->fetch_assoc()){
		foreach($exibe as $key => $value){
			if( $value == 0){
    	$sql_del = "UPDATE controle_estoque_range_produto SET min = 1 WHERE id = 0";
			
			if ($connection->query($sql_del) === TRUE) {
            echo "New record created successfully";
        } 
        else {
            echo "Error: " . $sql_del . "<br>" . $connection->error;
        }

 
			
			
			
			}
}
}
	 }

 $connection->close();