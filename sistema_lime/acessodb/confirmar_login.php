<?php
	// Confere se a senha e o login passados pelo formulario de login sao os mesmos do bando de dados
	
	session_start();
	
	include "config.php"; //inclui o arquivo de configura��es

	$db			=	mysql_connect ($host, $login_db, $senha_db); //conecta ao mysql
	$basedados	=	mysql_select_db($database); //conecta a base de dados
	
	$login = $_POST['login'];
	$senha = $_POST['senha'];
	
	$confirmacao = mysql_query("SELECT * FROM $tabela WHERE login = '$login' AND senha = '$senha'", $db) or die(mysql_error()); //verifica se o login e a senha conferem
	$contagem = mysql_num_rows($confirmacao); //traz o resultado da pesquisa acima

	if ( $contagem == 1 ) {
		$_SESSION['login'] = $login;
		$_SESSION['senha'] = $senha;
		
	  //setcookie('login', $login); //grava o cookie com o login
	  //setcookie('senha', $senha);
	  //setcookie ("senha", $senha); //grava o cookie com a senha
	  
		echo "Usuario logado." , $login; //se a senha digitada est� correta, mostra a mensagem
		if ( $login == "admin"){
			header("Location: ../admin/sessao2.php");
			exit(2);
		}
		else{
			header("Location: sessao.php");
			exit(2);   
		}
	} else {
		echo "Login ou senha invalidos. <a href=javascript:history.go(-1)>Clique aqui para voltar.</a>"; //se a senha esta incorreta mostra essa mensagem
	}
?>
