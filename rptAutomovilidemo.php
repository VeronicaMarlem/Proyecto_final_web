<?php

	 $estado = "";
	 
      // Se tienen todos los parametros para conectarse ...
      //if( !$conn = mysqli_connect("localhost", "root" , 'Guitar54', "VERIFICENTRO", "3306") ){		  
      if( !$conn = mysqli_connect("localhost", "id5362664_veronica" , "veronica123", "id5362664_verificentro", "3306") ){	  
         $estado = "Error al conectarse al servidor MySql, revisar parámetros";
      }
      else{
         $estado = "Conexion realizada al servidor";
      }

    if (empty($_GET)) {
		//ES LA PRIMERA VEZ QUE CARGA LA PAGINA PHP
		$clave = null;
		$placa = null;
		$modelo = null;
		$marca = null;
		$noserie = null;
		$seriemotor = null;
		$comb = null;
		$url= null;
		$cliente = null;
		$op = null;
	}
	else{
		//EXTRACCUIN DE LAS VARIABLES ENVIADAS DEL CLIENTE (JAVASCRIPT) AL SERVIDOR (PHP)
		$clave = $_GET["clave"];
		$placa = $_GET["placa"];
		$modelo = $_GET["modelo"];
		$marca = $_GET["marca"];
		$noserie = $_GET["noserie"];
		$seriemotor = $_GET["seriemotor"];
		$comb = $_GET["combustible"];
		$url=$_GET["url"];
		$cliente = $_GET["cliente"];
		$op = $_GET["op"];


		/*echo "clave= ".$clave."<br>";
		echo "placa= ".$placa."<br>";
		echo "modelo= ".$modelo."<br>";
		echo "marca= ".$marca."<br>";
		echo "noserie= ".$noserie."<br>";
		echo "seriemotor= ".$seriemotor."<br>";
		echo "combustible= ".$comb."<br>";
		echo "url imagen= ".$url."<br>";
		echo "cliente= ".$cliente."<br>";
		*/

		if($op == 1){
			mysqli_query($conn, "INSERT INTO AUTOMOVIL VALUES(null, '".$placa."', '".$modelo."', '".$marca."', '".$noserie."', '".$seriemotor."', '".$comb."','".$cliente."', '".$url."');");
			echo "<script language='javascript'>alert('Registro exitoso de auto');</script>";
			echo "<script language='javascript'>document.location.href='rptAutomovilidemo.php';</script>";
		}
		else if($op == 2){
			
			$recordSet = mysqli_query($conn,"select * from AUTOMOVIL where AUT_CVE_AUTOMOVIL='".$clave."';");
			while($registro = mysqli_fetch_row($recordSet)){
			$y=0;
				foreach ($registro as $columna) {
					//echo "registro = ".$columna."<br>";
					if($y==0){
						$clave = $columna; 
						$y++;
						//echo "CLAVE = ".$clave."<br>";
					} else if($y==1){
						$placa = $columna; 
						$y++;
						//echo "PLACA = ".$Placa."<br>";
					} else if ($y==2) {
						$modelo = $columna; 
						$y++;
					} else if ($y==3) {
						$marca = $columna; 
						$y++;
					} else if ($y==4) {
						$noserie = $columna; 
						$y++;
					} else if ($y==5) {
						$seriemotor = $columna; 
						$y++;
					} else if ($y==6) {
						$comb = $columna; 
						$y++;
					} else if ($y==7) {
						$cliente = $columna; 
						$y++;
					} else if ($y==8) {
						$url = $columna; 
						$y++;
					}
				}
			}
			
			
			mysqli_free_result($recordSet);
			echo "<script language='javascript'>alert('Edita el registro que elegiste, al terminar da clic en Actualizar');</script>";
		}
		else if($op == 3){
			mysqli_query($conn, "DELETE FROM AUTOMOVIL WHERE AUT_CVE_AUTOMOVIL = '".$clave."';");
			echo "<script language='javascript'>alert('Registro eliminado exitosamente');</script>";
			echo "<script language='javascript'>document.location.href='rptAutomovilidemo.php';</script>";
		}
		else if($op == 4){
			mysqli_query($conn, "UPDATE AUTOMOVIL SET AUT_PLACA='".$placa."', AUT_MODELO='".$modelo."', AUT_MARCA='".$marca."', AUT_NUMERO_SERIE='".$noserie."', AUT_SERIE_MOTOR='".$seriemotor."', AUT_TIPO_COMBUSTIBLE='".$comb."', CLI_CVE_CLIENTE='".$cliente."', AUT_IMAGEN='".$url."' WHERE AUT_CVE_AUTOMOVIL='".$clave."';");
				echo "<script language='javascript'>alert('Registro actualizado exitosamente');</script>";
				echo "<script language='javascript'>document.location.href='rptAutomovilidemo.php';</script>";
		}

	}
      // --> Ejecutar una consulta
      $recordSet = mysqli_query($conn, "select AUT_CVE_AUTOMOVIL, AUT_PLACA, AUT_MODELO, AUT_MARCA, AUT_NUMERO_SERIE,
              							AUT_SERIE_MOTOR, AUT_TIPO_COMBUSTIBLE, CONCAT(CLIENTE.CLI_CVE_CLIENTE, '-',CLI_NOMBRE, '-',CLI_APELLIDO_PATERNO,'(', CLI_CORREO_ELECTRONICO, ')') CVE_CLIENTE, AUT_IMAGEN FROM AUTOMOVIL,CLIENTE WHERE CLIENTE.CLI_CVE_CLIENTE = AUTOMOVIL.CLI_CVE_CLIENTE
              							ORDER BY AUT_CVE_AUTOMOVIL");

      //mysqli_query($conn, "INSERT INTO AUTO VALUES(null, '".$placa."', '".$modelo."', '".$marca."', '".$noserie."', '".$seriemotor."', '".$comb."','".$url."', '".$clinete."');");

?>

<html>
<head >
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" type="text/css" href="estilos/empresa.css">
</head>
<body>

<form id="frmConexion" method="GET" >

<center>
  <font face="arial" size="3" color="midnightblue"><b>Reporte de Automoviles Verificados </b></font>
  <br><br>
  <font face="arial" size="2" color="midnightblue">Estado de la conexion: <?php echo $estado; ?></font>
  <br><br>
  	<div id="round">
  		<br>
  	<TABLE border=0 width="40%">
  		<TR>
  			<TD align='right' width=25%>
  				<font>Clave:</font>
  			</TD>
  			<TD width=30%>
  				<input type="text" id="txtclave" maxlength="11" value="<?php if($op==2){echo $clave;} ?>">
  			</TD>
  		</TR>
  		<TR>
  			<TD align='right'>
  				<font>Placa:</font>
  			</TD>
  			<TD>
  				<input type="text" id="txtplaca" maxlength="7" value="<?php if($op==2){echo $placa;} ?>">
  			</TD>
  			<TD align='right' width=7%>
  				<font>Cliente:</font>
  			</TD>
  			<TD>
  				<input type="text" id="txtcliente" maxlength="11" value="<?php if($op==2){echo $cliente;} ?>">
  			</TD>
  			<td align="center">
					&nbsp&nbsp<b><a id="linkbotoncv" href="inicio.html" target="_self">INICIO</a></b>
			</td>
  		</TR>
  		<TR>
  			<TD align='right'>
  				<font>Modelo:</font>
  			</TD>
  			<TD>
  				<input type="text" id="txtmodelo"  maxlength="20" value="<?php if($op==2){echo $modelo;} ?>">
  			</TD>
  			<TD align='right'>
  				<font>Marca:</font>
  			</TD>
  			<TD>
  				<select name="selmarca" id="selmarca">
  					<option <?php if($op==2 && $marca=='NISSAN'){echo 'selected';} ?> >NISSAN</option>
  					<option <?php if($op==2 && $marca=='HYUNDAY'){echo 'selected';} ?> >HYUNDAY</option>
  					<option <?php if($op==2 && $marca=='BMW'){echo 'selected';} ?> >BMW</option>
  					<option <?php if($op==2 && $marca=='CHEVROLET'){echo 'selected';} ?> >CHEVROLET</option>
  					<option <?php if($op==2 && $marca=='FORD'){echo 'selected';} ?> >FORD</option>
  					<option <?php if($op==2 && $marca=='TOYOTA'){echo 'selected';} ?> >TOYOTA</option>
  					<option <?php if($op==2 && $marca=='HONDA'){echo 'selected';} ?> >HONDA</option>
  					<option <?php if($op==2 && $marca=='AUDI'){echo 'selected';} ?> >AUDI</option>
  				</select>
  			</TD>
  		</TR>
  		<TR>
  			<TD align='right'>
  				<font>No. Serie:</font>
  			</TD>
  			<TD>
  				<input type="text" id="txtnserie" maxlength="8" value="<?php if($op==2){echo $noserie;} ?>">
  			</TD>
  		</TR>
  		<TR>
  			<TD align='right'>
  				<font>Serie motor:</font>
  			</TD>
  			<TD>
  				<input type="text" id="txtsmotor" maxlength="7" value="<?php if($op==2){echo $seriemotor;} ?>">
  			</TD>
  		</TR>
  		<TR>
  			<TD align='right'>
  				<font>Combustible:</font>
  			</TD>
  			<TD>
  				<font size="2">
  				<input type="radio" id="rbtcomb1" name="rbtcomb1" value="1" <?php if($op==2 && $comb=='1'){echo 'Checked';} ?> >1-Magna
  				<input type="radio" id="rbtcomb1" name="rbtcomb1" value="2" <?php if($op==2 && $comb=='2'){echo 'Checked';} ?> >2-Premium
  				</font>
  			</TD>
  		</TR>
  		<TR>
  			<TD align='right'>
  				<font>URL Imagen:</font>
  			</TD>
  			<TD>
  				<input type="text" id="txturl" maxlength="100" value="<?php if($op==2){echo $url;} ?>">
  			</TD>
  		</TR>
  	</TABLE>
  	</div>
  	<br>
  	<center>
  		<img src="imagenes/ok.gif" width="30" height="30" title="Registrar" onclick="javascript: insAuto();">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	    <img src="imagenes/icon_edit.GIF" width="30" height="30" title="Modificar" onclick="javascript: updAuto();">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	    <img src="imagenes/icon_delete.gif" width="30" height="30" title="Eliminar" onclick="javascript: delAuto();">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	    <img src="imagenes/icon_logalum.GIF" width="30" height="30" title="Actualizar" onclick="javascript: actAuto();">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

  	</center>
  	<br>
	<table width="80%" border="0">
	  <tr>
		  <td bgcolor="blue" align="middle"><font face="arial" size="4" color="white"><b>Clave Automovil</b></font></td>
		  <td bgcolor="blue" align="middle"><font face="arial" size="4" color="white"><b>Placa</b></font></td>
		  <td bgcolor="blue" align="middle"><font face="arial" size="4" color="white"><b>Modelo</b></font></td>
		  <td bgcolor="blue" align="middle"><font face="arial" size="4" color="white"><b>Marca</b></font></td>  
		  <td bgcolor="blue" align="middle"><font face="arial" size="4" color="white"><b>Numero Serie</b></font></td>
		  <td bgcolor="blue" align="middle"><font face="arial" size="4" color="white"><b>Serie Motor</b></font></td>  
		  <td bgcolor="blue" align="middle"><font face="arial" size="4" color="white"><b>Combustible</b></font></td>  
		  <td bgcolor="blue" align="middle"><font face="arial" size="4" color="white"><b>Clave Cliente</b></font></td> 
		  <td bgcolor="blue" align="middle"><font face="arial" size="4" color="white"><b>Imagen</b></font></td>  
	  </tr>

<?php
	$i = 0;
	$j = 0;
	$x = 0;
	while($registro = mysqli_fetch_row($recordSet)){
		if($i%2==0){
			echo "<tr bgcolor='lightblue' color='darkblue'>";
		}
		else{
			echo "<tr bgcolor='navyblue'>";
		}
		foreach ($registro as $columna) {
			if($j==1 || $j==7){
				echo "<td><font color='blue'><b>$columna</b></font></td>";
				if($j==7){
					$j=-2;
				}
				$emer = $columna;
			}
			else if($x==8){
				echo "<td><A href='$columna' target='_blank' title='$emer'> <img src='$columna' width=100 height=100></A></td>";
				$x=-1;
			}
			else{
				echo "<td><font color='blue'>$columna</font></td>";
			}
			
			$x++;
			$j++;
		}
		echo "</tr>";
		$i++;
	}
	echo "<tr><td align=right colspan=9><br><b><font size=3 color=blue face=arial> Total Inventario: $i  </font></b></td></tr>"; 
	//CERRAR CONEXIONES Y CURSORES DE DATOS
	mysqli_free_result($recordSet);
	mysqli_close($conn);
?>

</table>
</center>
</form>
</body>
</html>

<script language="javascript">
	function nada(){

	}


	function insAuto(){
		clave = document.getElementById("txtclave");
		placa = document.getElementById("txtplaca");
		modelo = document.getElementById("txtmodelo")
		marca = document.getElementById("selmarca");
		noserie =document.getElementById("txtnserie");
		seriemotor = document.getElementById("txtsmotor");
		var comb = document.getElementsByName("rbtcomb1");
		url = document.getElementById("txturl");
		cliente = document.getElementById("txtcliente");
		
		/*AGREGAR EL QUERY DE DECICION
		op=1 insertar
		op=2 modificar
		op=3 delete 
		op=4 actualizar
		*/
		if(comb[0].checked){
			combu='1';
			
		}
		else{
			combu='2';
		}

		document.location.href="rptAutomovilidemo.php?op=1&clave="+clave.value+"&placa="+placa.value+"&modelo="+modelo.value+"&marca="+marca.value+"&noserie="+noserie.value+"&seriemotor="+seriemotor.value+"&combustible="+combu+"&url="+url.value+"&cliente="+cliente.value;
	}

	function updAuto(){

		clave = document.getElementById("txtclave");
		if(clave.value == ""){
			alert("Teclea una clave para modificar");
		}
		else{
			document.location.href="rptAutomovilidemo.php?op=2&clave="+clave.value+"&placa=null&modelo=null&marca=null&noserie=null&seriemotor=null&combustible=null&url=null&cliente=null";
		}
	}

	function actAuto(){
		clave = document.getElementById("txtclave");
		placa = document.getElementById("txtplaca");
		modelo = document.getElementById("txtmodelo")
		marca = document.getElementById("selmarca");
		noserie =document.getElementById("txtnserie");
		seriemotor = document.getElementById("txtsmotor");
		var comb = document.getElementsByName("rbtcomb1");
		url = document.getElementById("txturl");
		cliente = document.getElementById("txtcliente");
		if(comb[0].checked){
			combu='1';
			
		}
		else{
			combu='2';
		}
		if(clave.value == "" || placa.value=="" || modelo.value=="" || noserie.value=="" || seriemotor.value=="" || url.value=="" || cliente.value==""){
			alert("No debes de tener ningun campo vacio \n       modifica y despues actualiza");
		}else {
			document.location.href="rptAutomovilidemo.php?op=4&clave="+clave.value+"&placa="+placa.value+"&modelo="+modelo.value+"&marca="+marca.value+"&noserie="+noserie.value+"&seriemotor="+seriemotor.value+"&combustible="+combu+"&url="+url.value+"&cliente="+cliente.value;
		}
	}

	function delAuto(){

		clave = document.getElementById("txtclave");
		if(clave.value == ""){
			alert("Teclea una clave para modificar");
		}
		else{
			document.location.href="rptAutomovilidemo.php?op=3&clave="+clave.value+"&placa=null&modelo=null&marca=null&noserie=null&seriemotor=null&combustible=null&url=null&cliente=null";
		}
	}
</script>
