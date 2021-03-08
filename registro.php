<?php

if ($_SERVER['REQUEST_METHOD'] =='POST'){

	$name = $_POST['nome'];
    $filme = $_POST['filme'];
    $diretor = $_POST['diretor'];
	$tokenDigitado = $_POST['tokenDigitado'];


    require_once 'connect.php';

	$sql = "SELECT * FROM usuario_table WHERE nome='$name' ";

    $response = mysqli_query($conn, $sql);

    if ( mysqli_num_rows($response) === 1 ) {

		$row = mysqli_fetch_assoc($response);

		if ( $tokenDigitado == $row['token']) {

			$result['nome']  = 'Votos_cadastrados';
			echo json_encode($result);

			$sqlToken = "UPDATE usuario_table SET filme = '$filme', diretor = '$diretor' WHERE nome='$name' ";
			mysqli_query($conn, $sqlToken);

		} else {

			$result['nome'] = 'Token invalido'; 
			echo json_encode($result);

		}
		
	} else {

			$result['nome'] = 'ERRO'; 

			echo json_encode($result);

		}

}

?>