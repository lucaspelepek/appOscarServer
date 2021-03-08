<?php

	$name = $_SERVER['PHP_AUTH_USER'];
	$password = $_SERVER['PHP_AUTH_PW'];

	require_once 'connect.php';

	$sql = "SELECT * FROM usuario_table WHERE nome='$name' ";
	
	$response = mysqli_query($conn, $sql);

	if ( mysqli_num_rows($response) === 1 ) {

		$row = mysqli_fetch_assoc($response);

		if ( password_verify($password, $row['senha']) ) {

			$token = rand( 0, 100);

			$result['nome'] = $row['nome'];
			$result['filme'] = $row['filme'];
			$result['diretor'] = $row['diretor'];
    		$result['token'] =  $token;

			echo json_encode($result);

			$sqlToken = "UPDATE usuario_table SET token = '$token' WHERE nome='$name' ";
			mysqli_query($conn, $sqlToken);

		} else {

			$result['nome'] = 'ERROR'; 

			echo json_encode($result);

		}
		
	} else {

		//$response '404';

			$result['nome'] = 'ERROR'; 

			echo json_encode($result);

		}

?>