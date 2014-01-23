<html>
<head>
<link href="../menu_assets/styles2.css" rel="stylesheet" type="text/css">
   <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
</head>

<body>

   <div id="cssmenu">
                <ul>
<?php


for ($i = 0; $i < 15; $i++) {
   
   $quesito = "Q".$i;

echo "<li><a href=imprimeQuesito.php?quesito=$i>$quesito</a></li>";}

?>
</ul>

        </div>

</body>

</html>
