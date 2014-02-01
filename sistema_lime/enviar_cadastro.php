<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Cadastro</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
	<?php
		include "config.php"; //aqui inserimos as váriaveis da página de configuração

		$db			=	mysql_connect ($host, $login_db, $senha_db); //conectamos ao mysql
		$basedados	=	mysql_select_db($database); //selecionamos o database escolhido
		
		$nome = $_POST['nome'];
		$senha = $_POST['senha'];
		$senha2 = $_POST['senha2'];
		$login = $_POST['login'];
		$email = $_POST['email'];

		$pesquisar = mysql_query("SELECT * FROM '$tabela' WHERE login = '$login'", $db); //conferimos se o login escolhido já não foi cadastrado
		
		if($pesquisar == $login){
			$contagem = 1;
		}else{
			$contagem = 0;	
		}
		
		$errors = "";
		
		if ( $contagem == 1 ) {
		  $errors .= "Login escolhido já cadastrado.<br>"; //se o login já existir, ele adiciona o erro
		  }

		if ( $login == "" ) {
		  $errors .= "Você não digitou um login<br>"; //confere se o campo login não ficou vazio
		  }

		if ( $senha == "" ) {
		  $errors .= "Você não digitou uma senha<br>"; //confere se o campo senha não ficou vazio
		  }

		if ( $senha != $senha2 ) {
		  $errors .= "Você digitou 2 senhas diferentes.<br>"; //adiciona o erro caso o usuário digitou 2 senhas diferentes
		  }
		  
		if ( $errors == "" ) { //checa se houve ou não erros no cadastro

		  $cadastrar = mysql_query("INSERT INTO $tabela (nome, login, senha, email)
			VALUES ('$nome','$login','$senha','$email')", $db); //insere os campos na tabela

			if ( $cadastrar == 1 ) {
			  echo "<div align=center><font size=2 face=Verdana, Arial, Helvetica, sans-serif><br><br><br>Cadastro com sucesso.</font></div>"; //se cadastrou com sucesso o usuário aparece essa mensagem
			  } else {
				echo "<div align=center><font size=2 face=Verdana, Arial, Helvetica, sans-serif><br><br><br>Ocorreu um erro no servidor ao tentar se cadastrar.</font></div>"; //caso houver um erro quanto as configurações aparece essa mensagem
				}
		  } else {
			echo "<div align=center><font size=2 face=Verdana, Arial, Helvetica, sans-serif>Ocorreu os seguintes erros ao tentar se cadastrar:<br><br>$errors</font></div>"; //mostra os erros do usuário, caso houver
			}
	?>
</body>
</html>
