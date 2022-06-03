<?php

$servername = "162.214.93.1";                   //CONTROLE DE ESTOQUE PRODUTO.php

$dbname = "carlosad_oficial";

$username = "carlosad_admin";

$password = "Cz@38020";

//$delay = 0;
$register = $_POST['mode'];
  // Cria a conexão
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Verifica a conexão
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error); 
        } 

$cadastro = "UPDATE controle_estoque_sync SET mode = $register ";

  if ($conn->query($cadastro) === TRUE) {
            echo "New record created successfully";

        } 
        else {
            echo "Error: " . $cadastro . "<br>" . $conn->error;
        }
//header("Refresh: $delay;"); 
  $conn->close();

function test_input($data) {
    
   $data = trim($data);
    $data = stripslashes($data);
 $data = htmlspecialchars($data);
   
    return $data;

}
