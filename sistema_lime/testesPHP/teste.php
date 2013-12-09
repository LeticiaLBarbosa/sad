<html>
<head>
<title>Ler um arquivo de texto</title>
</head>
<body>

<?php

$filename = "teste.txt"; 
$Content = " ihu  Add this to the file\r\n";  
echo "open"; 
$handle = fopen($filename, "w");
echo " write";
fwrite($handle, $Content);
echo " close";
fclose($handle);

$handle = fopen($filename, "r");
echo fgets($handle);
echo "end";

/*
// Abre o arquivo de texto
$f = fopen("teste.txt", "w+");

// Escreve no arquivo de texto
fwrite($f, "PHPisfun!"); 

// Fecha o arquivo de texto
fclose($f);
echo "oi";
*/
?>


</body>
</html>
