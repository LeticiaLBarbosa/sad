<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="menu_assets/styles2.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>
<body>

<h3 style="color: #190eb5; text-align: center;">
	SISTEMA DE AVALIA&Ccedil;&Atilde;O DOCENTE</h3>


<!-- Menu inicial -->
<div id='cssmenu'>
	
<ul>
   	<li>
			<a href="index.html"><span>Início</span></a></li>
		<li>
			<a href= "cadastrar.php"><span>Cadastrar</span></a></li>
		<li>
			<a href= "/home/about.html"><span>Sobre</span></a></li>
		<li>
			<a href= "/home/contato.html"><span>Contato</span></a></li>


</ul>
</div>
<div style="clear:both; margin: 0 0 30px 0;">&nbsp;</div>

<form name="cadastrar.php" method="post" action="/home/enviar_cadastro.php">
  <table width="400" border="0" cellspacing="0" cellpadding="0">
    <tr> 
      <td width="150"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Nome:</font></td>
      <td width="250"><input name="nome" type="text" id="nome" maxlength="75"></td>
    </tr>
    <tr> 
      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Login:</font></td>
      <td><input name="login" type="text" id="login" maxlength="30"></td>
    </tr>
    <tr> 
      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Senha:</font></td>
      <td><input name="senha" type="password" id="senha" maxlength="30"></td>
    </tr>
    <tr> 
      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Repetir 
        Senha:</font></td>
      <td><input name="senha2" type="password" id="senha2" maxlength="30"></td>
    </tr>
    <tr> 
      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Email:</font></td>
      <td><input name="email" type="text" id="email" maxlength="50"></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="2"><div align="center"> 
          <input name="enviar" type="submit" id="enviar" value="Enviar Cadastro">
          <input name="limpar" type="reset" id="limpar" value="Limpar Dados">
        </div></td>
    </tr>
  </table>
</form>
</body>
</html>
