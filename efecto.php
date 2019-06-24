<html>
<html>
<head>
	<title>Práctica de PHP</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="estilos/empresa.css">
</head>
<body>
<?php
	//BLOQUE DE CÓDIGO PHP
	//$_POST  CONTENEDOR DE TODOS LOS DATOS AL HACER SUBMIT
	//$_POST['txtnumero'] 
	//VALIDACIÓN GENERAL DE ACCESO A LA PÁGINA PHP (1ERA VEZ)
	if (empty($_POST)) {
		//ES LA PRIMERA VEZ DE CARGA DE PAGINA PHP
		$limite = null;
	}
	else{
		//ES LA SEGUNDA VEZ QUE SE CARGA LA PÁGINA
		$limite = $_POST['txtlimite'];
		//echo "limite:".$limite."<br>";
	}
?>
	<form id="form1" method="POST">
		<table border="1">
			<tr>
				<td>
					<font face="tahoma" size="5" align="center"><b>Práctica de PHP</b></font>
				</td>
				<td align="center">
					&nbsp&nbsp<button id="cv"><b><a id="linkbotoncv" href="inicio.html" target="_self">INICIO</a></b></button>
				</td>
			</tr>
			<tr>
				<td>
					<font face="tahoma" size="2" align="center"><b>Replicar el sisguiente efecto</b></font>
				</td>
				<td>
					
				</td>
			</tr>
			<tr>
				<td>
					<font face="tahoma" size="2" align="center"><b>Captura el límite</b></font>
				</td>
				<td>
					<input type="text" value="<?php echo $limite;?>" name="txtlimite" id="txtlimite">
				</td>
			</tr>
			<tr>
				<td colspan="2">
					
							<b>
							<?php
							//VALIDAR LOS VALORES RECIBIDOS
							if($limite > 0){
								$i=0;
								$tamano = 0;
								$color1='blue';
								$color2='red';
								$color3='green';
								$c=1;
								for ($i=1; $i<=$limite; $i++) { 
									$tamano=$tamano+1; 
										if ($c==1) {
											echo "<font color='$color1' face='tahoma' size='$tamano'>";
											echo "Este mensaje esta repetido ".$limite." veces"."<br>";
											echo "</font>";
										}else if ($c==2) {
											echo "<font color='$color2' face='tahoma' size='$tamano'>";
											echo "Este mensaje esta repetido ".$limite." veces"."<br>";
											echo "</font>";
										}else{
											echo "<font color='$color3' face='tahoma' size='$tamano'>";
											echo "<u>"."Este mensaje esta repetido ".$limite." veces </u>"."<br>";
											echo "</font>";
										}
										$c=$c+1;
										if ($c==4) {
											$c=1;
										}
								}
						}else{
								if ($limite != null)
									echo "Los valores capturados no permiten crear la tabla";
							}
							?>
							</b>

				</td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input type="SUBMIT" value="Generar efecto" id="btngenerar">
				</td>
			</tr>
		</table>
	</form>
</body>
</html>