<?
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       CLIENTES.PHP                                                \\
// Creado:        2004-11-30                                                  \\
// Autor:         Carlos Gilberto López M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-04-30                                                  \\
//                                                                            \\
// Descripción:   Módulo de mantenimiento a la tabla de Clientes con sus      \\
//                respectivos contactos.                                      \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/

$programa = 10;


$titulo = 'Maestra de Clientes Colsys';
$saludos= array( "Señor" => "Señor", "Señora" => "Señora", "Doctor" => "Doctor", "Doctora" => "Doctora", "Ingeniero" => "Ingeniero", "Ingeniera" => "Ingeniera", "Arquitecto" => "Arquitecto", "Arquitecta" => "Arquitecta" );
$letras  = array(" ","A","B","C","D","E","F","G","H","I","J","K","L","M","N");
$parte_1 = array(" ","Avenida","Autopista","Calle","Carrera","Circular","Diagonal","Transversal","Via");
$parte_2 = array(" ","Bis");
$parte_3 = array(" ","Norte","Sur","Este","Oeste");
$localidades = array("Usaquén","Chapinero","Santafé","San Cristóbal","Usme","Tunjuelito","Bosa","Kennedy","Fontibón","Engativa","Suba","Barrios Unidos","Teusaquillo","Mártires","Antonio Nariño","Puente Aranda","Candelaria","Rafael Uribe","Ciudad Bolívar","Sumapaz","Cajicá","Chia","Cota","La Calera","Funza","Mosquera","Sibaté","Siberia","Soacha","Tocancipá","Otra");
$sexos = array("Femenino","Masculino");
$calificaciones = array("A","B","C","D","E");
$riesgos = array("","Mínimo","Medio","Alto");
$campos = array("Nombre del Cliente" => "ca_compania", "Representante Legal" => "ca_ncompleto", "N.i.t." => "ca_idcliente", "Calificación" => "ca_calificacion", "Coordinador Aduana" => "ca_coordinador", "Actividad Económica" => "ca_actividad", "Sector Económico" => "ca_sector", "Localidad" => "ca_localidad", "Ciudad" => "ca_ciudad", "Contrato Agenciamiento" => "ca_stdcotratoag");  // Arreglo con las opciones de busqueda
$bdatos = array("Maestra Clientes", "Mis Clientes", "Clientes Libres");  // Arreglo con los lugares donde buscar
$tipos = array("Llamada", "Visita", "Correo Electrónico", "Correspondencia", "Cerrar Caso");
$estados = array("Potencial","Activo","Vetado");
$sstatus = array("","Potencial","Vetado");
$empresas= array("Coltrans","Colmas");
$circular=array("Sin","Vencido","Vigente");
$presentacion=array("Detallado","Columnas");

include_once 'include/datalib.php';                                                // Incorpora la libreria de funciones, para accesar leer bases de datos
require("checklogin.php");                                                                 // Captura las variables de la sessión abierta

$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos


if (!isset($criterio) and !isset($boton) and !isset($accion)){
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function elegir(opcion, id){";
    echo "    document.location.href = 'clientes.php?boton='+opcion+'\&id='+id;";
    echo "}";
    echo "</script>";
    echo "</HEAD>";
    echo "<BODY>";
require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<H3>$titulo</H3>";
    echo "<FORM METHOD=post NAME='menuform' ACTION='clientes.php' >";
    echo "<TABLE WIDTH=450 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
    echo "<TH COLSPAN=4 style='font-size: 12px; font-weight:bold;'><B>Ingrese un criterio para realizar las busqueda</TH>";
    echo "<TH><IMG src='./graficos/new.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(\"Adicionar\", 0);'></TH>";  // Botón para la creación de un Registro Nuevo
    echo "<TR>";
    echo "  <TH ROWSPAN=5>&nbsp</TH>";
    echo "  <TD Class=listar ROWSPAN=3><B>Buscar por:</B><BR><SELECT NAME='modalidad' SIZE=8>";
	$che_mem = "SELECTED";
    while (list ($clave, $val) = each ($campos)) {
         echo " <OPTION VALUE='$clave' $che_mem>$clave";
		 $che_mem = "";
        }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar COLSPAN=2><B>Que contenga la cadena:</B><BR><INPUT TYPE='text' NAME='criterio' size='60'></TD>";
    echo "  <TH ROWSPAN=3><INPUT Class=submit TYPE='SUBMIT' NAME='buscar' VALUE='  Buscar  ' ONCLIK='menuform.submit();'></TH>";
    echo "</TR>";

    echo "<TR>";
    $us =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
    if (!$us->Open("select ca_login, ca_nombre from vi_usuarios where ca_cargo = 'Gerente Sucursal' or ca_cargo like '%Ventas%' or ca_departamento like '%Ventas%' or ca_departamento like '%Comercial%'")) {
        echo "<script>alert(\"".addslashes($us->mErrMsg)."\");</script>";
        echo "<script>document.location.href = 'repcomisiones.php';</script>";
        exit;
       }
    $us->MoveFirst();
    echo "  <TD Class=listar><B>Buscar en:</B><BR><SELECT NAME='buscaren'>";
	$che_mem = "SELECTED";
    for ($i=0; $i < count($bdatos); $i++) {
         echo " <OPTION VALUE='".$bdatos[$i]."' $che_mem>".$bdatos[$i];
		 $che_mem = "";
        }
    echo "  </SELECT>";
    echo "  </TD>";

    echo "  <TD Class=listar ROWSPAN=2><B>Reporte:</B>";
	$che_mem = "CHECKED";
    for ($i=0; $i < count($presentacion); $i++) {
         echo "<BR /><INPUT TYPE='RADIO' NAME='salida[]' VALUE='".$presentacion[$i]."' $che_mem>".$presentacion[$i]."&nbsp&nbsp";
		 $che_mem = "";
        }
    echo "  </TD>";
    echo "</TR>";

    echo "<TR>";
    echo "  <TD Class=mostrar><B>Vendedor:</B><BR><SELECT NAME='login'>";                 // Llena el cuadro de lista con los valores de la tabla Vendedores
    echo "  <OPTION VALUE=%>Vendedores (Todos)</OPTION>";
    while (!$us->Eof()) {
           echo"<OPTION VALUE=".$us->Value('ca_login').">".$us->Value('ca_nombre')."</OPTION>";
           $us->MoveNext();
          }
    echo "  </SELECT></TD>";
    echo "</TR>";

    echo "<TR>";
    echo "  <TD Class=listar COLSPAN=4><TABLE WIDTH=100% BORDER=0 CELLSPACING=0>";
    echo "	<TR>";
	echo "  	<TD Class=listar><B>Empresa:</B>";
	$che_mem = "CHECKED";
    for ($i=0; $i < count($empresas); $i++) {
         echo "<BR /><INPUT TYPE='RADIO' NAME='empresa' VALUE='".$empresas[$i]."' $che_mem>".$empresas[$i];
		 $che_mem = "";
        }
	echo "		</TD>";
	
	echo "  	<TD Class=listar><B>Estado:</B>";
    for ($i=0; $i < count($estados); $i++) {
         echo "<BR /><INPUT TYPE='CHECKBOX' NAME='estados_sel[]' VALUE='".$estados[$i]."'>".$estados[$i];
        }
	echo "		</TD>";

	echo "  	<TD Class=listar><B>Nivel de Riesgo:</B>";
    for ($i=1; $i < count($riesgos); $i++) {
         echo "<BR /><INPUT TYPE='CHECKBOX' NAME='riesgo[]' VALUE='".$riesgos[$i]."' $che_mem>".$riesgos[$i];
        }
	echo "		</TD>";

	echo "  	<TD Class=listar><B>Circular 170:</B>";
    for ($i=0; $i < count($circular); $i++) {
         echo "<BR /><INPUT TYPE='CHECKBOX' NAME='circular_std[]' VALUE='".$circular[$i]."' $che_mem>".$circular[$i];
        }
	echo "		</TD>";

	echo "  	<TD Class=listar><B>Carta Garantia:</B>";
    for ($i=0; $i < count($circular); $i++) {
         echo "<BR /><INPUT TYPE='CHECKBOX' NAME='cartagtia_std[]' VALUE='".$circular[$i]."' $che_mem>".$circular[$i];
        }
	echo "		</TD>";

	echo "  	<TD Class=listar>";
	echo "          <B>Lista Clinton:</B>";
	echo "          <BR /><INPUT TYPE='CHECKBOX' NAME='listaclinton' VALUE='Sí'>Sí";
	echo "          <BR /><B>Ley Insolvencia:</B>";
	echo "          <BR /><INPUT TYPE='CHECKBOX' NAME='leyinsolvencia' VALUE='Sí'>Sí";
	echo "		</TD>";
    echo "	</TR>";
	echo "  </TABLE></TD>";
    echo "</TR>";
    
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=captura COLSPAN=6></TD>";
    echo "</TR>";
    echo "</TABLE><BR>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cerrar' ONCLICK='javascript:document.location.href = \"/\"'></TH>";  // Cancela la operación
    echo "</TABLE>";

/*
//	RUTINA PARA LISTAR LOS CLIENTES CON SUS CONTACTOS (EMAIL) Y LOS TRAFICOS DESDE DONDE EMBARCAN
	set_time_limit(360);
	if (!$rs->Open("select DISTINCT ic.ca_idcliente, ic.ca_compania, im.ca_traorigen from vi_inoclientes_sea ic, vi_inomaestra_sea im where ic.ca_referencia = im.ca_referencia and substr(ic.ca_referencia,15,1) = 7 and ca_sucursal = 'Bogotá D.C.' order by ic.ca_idcliente, im.ca_traorigen")) {                  // Selecciona todos lo registros de la tabla Trasportistas
		echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
		echo "<script>document.location.href = 'entrada.php';</script>";
		exit; }
    if (!$us->Open("select ca_idcliente, ca_email from tb_concliente where upper(ca_cargo) NOT LIKE '%EXTRA%' order by ca_idcliente, ca_email")) {
        echo "<script>alert(\"".addslashes($us->mErrMsg)."\");</script>";
        echo "<script>document.location.href = 'repcomisiones.php';</script>";
        exit;
       }

	$idc_mem = 0;
	echo "<TABLE WIDTH=700 BORDER=0 CELLSPACING=1>";
	while (!$rs->Eof() and !$rs->IsEmpty()) {
		if ($rs->Value('ca_idcliente')!= $idc_mem){
			$tra_mem = '';
			echo "<TR>";
			echo "  <TD Class=listar>".$rs->Value('ca_idcliente')."</TD>";
			echo "  <TD Class=listar>".$rs->Value('ca_compania')."</TD>";
			echo "  <TD Class=listar>";
			$idc_mem = $rs->Value('ca_idcliente');
		}
		$tra_mem.= $rs->Value('ca_traorigen').',';
		$rs->MoveNext();
		if ($rs->Value('ca_idcliente')!= $idc_mem or $rs->Eof()) {
			echo substr($tra_mem,0,strlen($tra_mem)-1)."</TD>";
			$add_mem = '';
		    $us->MoveFirst();
			while (!$us->Eof() and !$us->IsEmpty()) {
				if ($idc_mem != $us->Value('ca_idcliente')){
					$us->MoveNext();
					continue;
				}else if ($us->Value('ca_idcliente') > $idc_mem){
					break;
				}else{
					$add_mem.= $us->Value('ca_email').",";
				}
				$us->MoveNext();
			}
			echo "<TD Class=listar>".substr($add_mem,0,strlen($add_mem)-1)."</TD>";
			echo "</TR>";
		}
	}
    echo "</TABLE>";
*/
    echo "</FORM>";
    echo "</CENTER>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
    echo "</BODY>";
    echo "</HTML>";
    }
elseif (!isset($boton) and !isset($accion) and isset($criterio)){	
    set_time_limit(360);
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo
    if (isset($criterio) and !isset($condicion)) {
		if ($modalidad == "N.i.t."){
			$condicion = "where $campos[$modalidad] = '".$criterio."'";
		}else {
			$condicion = "where lower($campos[$modalidad]) like lower('%".$criterio."%')";
		}
	}
    if ($buscaren == 'Mis Clientes') {
        $condicion.= " and ca_vendedor = '".$usuario."'"; }
    else if ($buscaren == 'Clientes Libres') {
        $condicion.= " and ca_vendedor is null"; }
	if (isset($login) and $login != '%'){
		$condicion.= " and ca_vendedor like '$login'";
		}
	if (isset($estados_sel)){
		$est_mem = '';
		while (list($key, $val) = each($estados_sel)) {
			$est_mem.= "'".$val."', ";
			}
		$est_mem = substr($est_mem,0,strlen($est_mem)-2);
		$condicion.= " and ca_".$empresa."_std in ($est_mem)";
		}
	if (isset($riesgo)){
		$sub_cad = " and ca_nvlriesgo in (";
		foreach($riesgo as $nivel){
			$sub_cad.= "'".$nivel."',";
		}
		$sub_cad = substr($sub_cad,0,strlen($sub_cad)-1).")";
		$condicion.= $sub_cad;
	}
	if (isset($circular_std)){
		$sub_cad = " and ca_stdcircular in (";
		foreach($circular_std as $estado){
			$sub_cad.= "'".$estado."',";
		}
		$sub_cad = substr($sub_cad,0,strlen($sub_cad)-1).")";
		$condicion.= $sub_cad;
	}
	if (isset($cartagtia_std)){
		$sub_cad = " and ca_stdcarta_gtia in (";
		foreach($cartagtia_std as $estado){
			$sub_cad.= "'".$estado."',";
		}
		$sub_cad = substr($sub_cad,0,strlen($sub_cad)-1).")";
		$condicion.= $sub_cad;
	}
		
	if (isset($listaclinton)){
		$condicion.= " and ca_listaclinton = '$listaclinton'";
	}
	if (isset($leyinsolvencia)){
		$condicion.= " and ca_leyinsolvencia = '$leyinsolvencia'";
	}
	if (!$rs->Open("select * from vi_clientes $condicion")) {                  // Selecciona todos lo registros de la tabla Trasportistas
		echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
		echo "<script>document.location.href = 'clientes.php';</script>";
		exit; }
	$registros = (!$rs->IsEmpty())?"ca_idcliente = ".$rs->Value('ca_idcliente'):"false";
	$cn =& DlRecordset::NewRecordset($conn);
	$tm =& DlRecordset::NewRecordset($conn);
	
	if (!$tm->Open("select * from vi_evecliente where $registros")) {          // Selecciona todos lo registros de la tabla Eventos de Clientes
		echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
		echo "<script>document.location.href = 'clientes.php';</script>";
		exit; }

	echo "<HTML>";
	echo "<HEAD>";
	echo "<TITLE>Tabla de Clientes Coltrans S.A.</TITLE>";
	if ($salida[0] == "Columnas"){		
		$columnas = array("N.i.t."=>"ca_idcliente","DV"=>"ca_digito","Cliente"=>"ca_compania","Dirección"=>array("ca_direccion","ca_oficina","ca_torre","ca_bloque","ca_interior","ca_localidad","ca_complemento"),"Teléfonos"=>"ca_telefonos","Fax"=>"ca_fax","Ciudad"=>"ca_ciudad","Vendedor"=>"ca_vendedor","Sucursal"=>"ca_sucursal","Circular 170"=>array("ca_fchcircular","ca_stdcircular"),"Nivel/Riesgo"=>"ca_nvlriesgo","Coord.Colmas"=>"ca_nombre_coor","Lista Clinton"=>"ca_listaclinton","Ley/Insolvencia"=>"ca_leyinsolvencia","Estado/Coltrans"=>array("ca_coltrans_std","ca_coltrans_fch"),"Estado/Colmas"=>array("ca_colmas_std","ca_colmas_fch"),"Días/Crédito"=>"ca_diascredito","Cupo/Crédito"=>"ca_cupo","Observaciones"=>"ca_observaciones");
		echo "</HEAD>";
		echo "<BODY>";
require_once("menu.php");
		echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
		echo "<CENTER>";
		echo "<FORM METHOD=post NAME='cabecera' ACTION='clientes.php'>";            // Hace una llamado nuevamente a este script pero con
		echo "<TABLE BORDER=0 CELLSPACING=1 WIDTH='2000'>";                                    // un boton de comando definido para hacer mantemientos
		echo "<TR>";
		echo "  <TH Class=titulo COLSPAN=".count($columnas).">$titulo</TH>";
		echo "</TR>";
		echo "<TR>";
		foreach(array_keys($columnas) as $col_tit) {
			echo "<TH Class=titulo>$col_tit</TH>";
		}
		echo "</TR>";

		while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
			$vetado = ($rs->Value('ca_coltrans_std')=='Vetado' or $rs->Value('ca_colmas_std')=='Vetado' )?'background-color:#FFb2b2;':'';
			echo "<TR>";
			foreach($columnas as $campos ){
					if (is_array($campos)){
						echo "<TD Class=mostrar style='font-size: 9px; center; $vetado'>";
						foreach($campos as $campo){
							echo str_replace("|","",$rs->Value($campo))." ";
						}
						echo "</TD>";
					}else{
						echo "<TD Class=mostrar style='font-size: 9px; center; $vetado'>".$rs->Value($campos)."</TD>";
					}
			}
			echo "</TR>";
			$rs->MoveNext();
		}
		echo "<TR HEIGHT=5>";
		echo "  <TD Class=titulo COLSPAN=".count($columnas)."></TD>";
		echo "</TR>";
			

	}else{
		echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
		echo "function elegir(opcion, id){";
		echo "    document.location.href = 'clientes.php?boton='+opcion+'\&id='+id;";
		echo "}";
		echo "function liberar(id) {";
		echo "    document.cabecera.accion.value = \"Liberar\";";
		echo "    document.cabecera.id.value = id;";
		echo "    if (confirm(\"¿Esta seguro que desea realizar la acción?\"))";
		echo "        document.cabecera.submit();";
		echo "}";
		echo "function uno(src,color_entrada) {";
		echo "    src.style.background=color_entrada;src.style.cursor='hand'";
		echo "}";
		echo "function dos(src,color_default) {";
		echo "    src.style.background=color_default;src.style.cursor='default';";
		echo "}";
		echo "</script>";
		echo "</HEAD>";
		echo "<BODY>";
require_once("menu.php");
		echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
		echo "<CENTER>";
		echo "<FORM METHOD=post NAME='cabecera' ACTION='clientes.php'>";            // Hace una llamado nuevamente a este script pero con
		echo "<TABLE WIDTH=600 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
		echo "<INPUT TYPE='HIDDEN' NAME='accion'>";                                // Hereda el Id del registro que se esta modificando
		echo "<INPUT TYPE='HIDDEN' NAME='id'>";                                    // Hereda el Id del registro que se esta modificando
		echo "<TR>";
		echo "  <TH Class=titulo COLSPAN=6>$titulo</TH>";
		echo "</TR>";
		echo "<TH>ID</TH>";
		echo "<TH COLSPAN=4>Nombre de Cliente</TH>";
		echo "<TH><IMG src='./graficos/new.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(\"Adicionar\", 0);'></TH>";  // Botón para la creación de un Registro Nuevo
		while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
		   $vista_1 = ($nivel >= 3)?'visible':'hidden'; // Habilita la opción para dar liberación automática
		   $vista_3 = ($nivel >= 2)?'visible':'hidden'; // Habilita la opción para definir porcentaje de comisión
		   $vista_2 = ($nivel >= 1)?'visible':'hidden'; // Habilita la opción para firma de comodato
		   $visible = ($rs->Value('ca_vendedor')== $usuario or $rs->Value('ca_vendedor')=='' or $nivel > 1)?'visible':'hidden';
		   $vetado = ($rs->Value('ca_coltrans_std')=='Vetado' or $rs->Value('ca_colmas_std')=='Vetado' )?'background-color:#FFb2b2;':'';
		   $alerta = ($rs->Value('ca_coltrans_std')=='Vetado' or $rs->Value('ca_colmas_std')=='Vetado' )?'<IMG src=\'./graficos/izquierda.gif\' border=0>':'';
		   if (!$cn->Open("select * from vi_concliente where ca_idcliente = ".$rs->Value('ca_idcliente')." and ca_idcontacto != 0")) {          // Selecciona todos lo registros de la tabla Contacos de Clientes
				echo "<script>alert(\"".addslashes($cn->mErrMsg)."\");</script>";      // Muestra el mensaje de error
				echo "<script>document.location.href = 'clientes.php';</script>";
				exit; }
		   echo "<TR>";
		   echo "<TD Class=titulo style='vertical-align: top;'>".number_format($rs->Value('ca_idcliente'))."-".$rs->Value('ca_digito')."</TD>";
		   echo "<TD Class=titulo COLSPAN=4 style='font-size: 12px; font-weight:bold; text-align:left;'>".$rs->Value('ca_compania')."</TD>";
		   echo "  <TD Class=titulo style='vertical-align: top; text-align: center;'>";                                            // Botones para hacer Mantenimiento a la Tabla
		   echo "    <IMG style='visibility: $visible;' src='./graficos/edit.gif' alt='Editar el Registro' border=0 onclick='elegir(\"Modificar\", ".$rs->Value('ca_idcliente').");'>";
		   echo "    <IMG style='visibility: $visible;' src='./graficos/del.gif'  alt='Eliminar el Registro' border=0 onclick='elegir(\"Eliminar\", ".$rs->Value('ca_idcliente').");'>";
		   echo "  </TD>";
		   echo "</TR>";

		   echo "<TR>";
		   echo "<TD Class=invertir COLSPAN=6>";
		   echo "  <TABLE WIDTH=100% CELLSPACING=1>";
		   echo "  <TR>";
		   echo "    <TD Class=invertir style='font-weight:bold; font-size: 9px; text-align:'>Contactos</TD>";
		   echo "    <TD Class=invertir style='font-weight:bold; font-size: 9px; text-align:'>Cargo</TD>";
		   echo "    <TD Class=invertir style='font-weight:bold; font-size: 9px; text-align:'>Teléfonos</TD>";
		   echo "    <TD Class=invertir style='font-weight:bold; font-size: 9px; text-align:'>Correo Elec.</TD>";
		   echo "  </TR>";
		   if (!$cn->IsEmpty()) {
			   $cn->MoveFirst();
			   while (!$cn->Eof() and !$cn->IsEmpty()) {
					echo "<TR>";
					echo "  <TD Class=mostrar style='font-size: 9px; center; $vetado'>".$cn->Value('ca_ncompleto_cn')."</TD>";
					echo "  <TD Class=mostrar style='font-size: 9px; center; $vetado'>".$cn->Value('ca_cargo')."</TD>";
					echo "  <TD Class=mostrar style='font-size: 9px; center; $vetado'>".$cn->Value('ca_telefonos')."</TD>";
					echo "  <TD Class=mostrar style='font-size: 9px; center; $vetado'>".$cn->Value('ca_email')."</TD>";
					echo "</TR>";
					$cn->MoveNext();
			   }
		   }else {
			   echo "<TR>";
			   echo "  <TD Class=mostrar style='font-weight:bold; font-size: 9px;' COLSPAN=4>El Cliente no tiene Contactos registrados</TD>";
			   echo "</TR>";
		   }
		   echo "  <TR>";
		   echo "    <TD Class=mostrar style='font-size: 9px; center; $vetado'>".$rs->Value('ca_ncompleto')."</TD>";
		   echo "    <TD Class=mostrar style='font-size: 9px; center; $vetado'>Representante Legal</TD>";
		   echo "    <TD Class=mostrar style='font-size: 9px; center; $vetado'>".$rs->Value('ca_telefonos')."</TD>";
		   echo "    <TD Class=mostrar style='font-size: 9px; center; $vetado'>".$rs->Value('ca_email')."</TD>";
		   echo "  </TR>";
		   echo "  </TABLE>";
		   echo "</TD>";
		   echo "</TR>";

		   $complemento = (($rs->Value('ca_oficina')!='')?" Oficina : ".$rs->Value('ca_oficina'):"").(($rs->Value('ca_torre')!='')?" Torre : ".$rs->Value('ca_torre'):"").(($rs->Value('ca_interior')!='')?" Interior : ".$rs->Value('ca_interior'):"").(($rs->Value('ca_complemento')!='')?" - ".$rs->Value('ca_complemento'):"");
		   echo "<TR>";
		   echo "  <TD Class=listar ROWSPAN=8 style='text-align: center; center; $vetado'>";
		   echo "    <TABLE>";
		   echo "      <TR><TD Class=mostrar style='text-align: center;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='elegir(\"ListaClinton\", ".$rs->Value('ca_idcliente').");' style='color=blue;'><BR><IMG src='graficos/vista.gif'><BR>Consulta en<br>Lista Clinton</TD></TR>";
		   echo "      <TR><TD style='visibility: $vista_3; text-align: center; color=blue;' Class=mostrar onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='elegir(\"Comisión\", ".$rs->Value('ca_idcliente').");'><BR><IMG src='graficos/Info.gif'><BR>Porcentaje de Comisión</TD></TR>";
		   echo "      <TR><TD style='visibility: $vista_2; text-align: center; color=blue;' Class=mostrar onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='elegir(\"Contrato\", ".$rs->Value('ca_idcliente').");'><BR><IMG src='graficos/contrato.gif'><BR>Contrato de<br>Comodato</TD></TR>";
		   echo "      <TR><TD style='visibility: $vista_1; text-align: center; color=blue;' Class=mostrar onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='elegir(\"Liberacion\", ".$rs->Value('ca_idcliente').");'><BR><IMG src='graficos/si.gif'><BR>Liberación<br>Automática</TD></TR>";
		   echo "    </TABLE>";
		   echo "  </TD>";
		   echo "  <TD Class=mostrar style='$vetado'>Dirección :</TD>";
		   echo "  <TD Class=listar style='$vetado' COLSPAN=3>".str_replace ("|"," ",$rs->Value('ca_direccion')).$complemento."</TD>";
		   echo "  <TD Class=listar style='$vetado' ROWSPAN=8 style='text-align: center;'>";
		   echo "    <TABLE>";
		   echo "      <TR><TD Class=mostrar style='text-align: center;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='javascript:document.location.href = \"concliente.php?id=".$rs->Value('ca_idcliente')."\"' style='color=blue;'><BR><IMG src='graficos/contacto.gif'><BR>Contactos</TD></TR>";
		   echo "      <TR><TD Class=mostrar style='text-align: center;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='javascript:document.location.href = \"enccliente.php?id=".$rs->Value('ca_idcliente')."\"' style='color=blue;'><BR><IMG src='graficos/encuesta.gif'><BR>Visitas<BR>".$rs->Value('ca_fchvisita')."</TD></TR>";
		   echo "      <TR><TD style='visibility: $visible;' Class=mostrar style='text-align: center;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='javascript:liberar(".$rs->Value('ca_idcliente').");' style='color=blue;'><BR><IMG src='graficos/no.gif'><BR>Liberar Cliente</TD></TR>";
		   echo "      <TR><TD Class=mostrar style='text-align: center;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='javascript:document.location.href = \"/clientes/clavesTracking?id=".$rs->Value('ca_idcliente')."\"' style='color=blue;'><BR><IMG src='graficos/tracking.gif'><BR>Tracking</TD></TR>";
		   echo "    </TABLE>";
		   echo "  </TD>";
		   echo "</TR>";
		   echo "<TR>";
		   echo "  <TD Class=mostrar style='$vetado'>Teléfonos :</TD>";
		   echo "  <TD Class=mostrar style='$vetado'>".$rs->Value('ca_telefonos')."</TD>";
		   echo "  <TD Class=mostrar style='$vetado'>Fax :</TD>";
		   echo "  <TD Class=mostrar style='$vetado'>".$rs->Value('ca_fax')."</TD>";
		   echo "</TR>";
		   echo "<TR>";
		   echo "  <TD Class=mostrar style='$vetado'>Localidad :</TD>";
		   echo "  <TD Class=mostrar style='$vetado'>".$rs->Value('ca_localidad')."</TD>";
		   echo "  <TD Class=mostrar style='$vetado'>Ciudad :</TD>";
		   echo "  <TD Class=mostrar style='$vetado'>".$rs->Value('ca_ciudad')."</TD>";
		   echo "</TR>";
		   echo "<TR>";
		   echo "  <TD Class=mostrar style='$vetado'>Web Site :</TD>";
		   echo "  <TD Class=mostrar style='$vetado'><a href='http://".$rs->Value('ca_website')."'target='_blank'>".$rs->Value('ca_website')."</a></TD>";
		   echo "  <TD Class=mostrar style='$vetado'>Email :</TD>";
		   echo "  <TD Class=mostrar style='$vetado'>".$rs->Value('ca_email')."</TD>";
		   echo "</TR>";
		   echo "<TR>";
		   echo "  <TD Class=mostrar style='$vetado'>Status :</TD>";
		   echo "  <TD Class=mostrar style='$vetado'>".$rs->Value('ca_status')."</TD>";
		   echo "  <TD Class=mostrar style='$vetado'>Calificación :</TD>";
		   echo "  <TD Class=mostrar style='$vetado'>".$rs->Value('ca_calificacion')."</TD>";
		   echo "</TR>";
		   echo "<TR>";
		   echo "  <TD Class=listar style='$vetado' rowspan=2>Sector :</TD>";
		   echo "  <TD Class=listar style='$vetado' rowspan=2>".$rs->Value('ca_sectoreco')."</TD>";
		   echo "  <TD Class=listar style='$vetado'>Vendedor :</TD>";
		   echo "  <TD Class=listar style='$vetado'>".$rs->Value('ca_vendedor')."<BR>".$rs->Value('ca_sucursal')."</TD>";
		   echo "</TR>";
		   echo "<TR>";
		   echo "  <TD Class=mostrar style='$vetado'>Coord. Colmas:</TD>";
		   echo "  <TD Class=mostrar style='$vetado'>".$rs->Value('ca_coordinador')."</TD>";
		   echo "</TR>";

		   echo "<TR>";
		   echo "  <TD Class=invertir COLSPAN=4><TABLE WIDTH=100% CELLSPACING=1 BORDER=1>";
		   echo "  <TR>";
		   echo "    <TD Class=listar style='$vetado'>Circular 170:<BR /><CENTER>".$rs->Value('ca_fchcircular')."</CENTER></TD>";
		   echo "    <TD Class=listar style='$vetado'>Estado Circular:<BR /><CENTER>".$rs->Value('ca_stdcircular')."</CENTER></TD>";
		   echo "    <TD Class=listar style='$vetado'>Nivel Riesgo:<BR /><CENTER>".$rs->Value('ca_nvlriesgo')."</CENTER></TD>";
		   echo "    <TD Class=listar style='$vetado'>Lista Clinton:<BR /><CENTER>".$rs->Value('ca_listaclinton')."</CENTER></TD>";
		   echo "  </TR>";
		   echo "  <TR>";
		   echo "    <TD Class=listar style='$vetado'>Contrato Agenc.:<BR /><CENTER>".$rs->Value('ca_fchcotratoag')."</CENTER></TD>";
		   echo "    <TD Class=listar style='$vetado'>Estado Contrato:<BR /><CENTER>".$rs->Value('ca_stdcotratoag')."</CENTER></TD>";
		   echo "    <TD Class=listar style='$vetado'>Ley Insolvencia Eco.:<BR /><CENTER>".$rs->Value('ca_leyinsolvencia')."</CENTER></TD>";
		   echo "    <TD Class=listar style='$vetado'>Comentario:<BR /><CENTER>".$rs->Value('ca_comentario')."</CENTER></TD>";
		   echo "  </TR>";
		   echo "  </TABLE></TD>";
		   echo "</TR>";

		   echo "<TR>";
		   echo "  <TD Class=listar style='$vetado' COLSPAN=6><TABLE WIDTH=100% CELLSPACING=1 BORDER=1>";
		   echo "  <TR>";
		   echo "  	 <TD Class=listar COLSPAN=2 style='font-family: Arial, Helvetica, sans-serif; font-size: 9px; $vetado'><B>Actividad Económica:</B><BR>".$rs->Value('ca_actividad')."&nbsp</TD>";
		   echo "    <TD Class=listar COLSPAN=2 style='font-family: Arial, Helvetica, sans-serif; font-size: 9px; $vetado'><B>Preferencias :</B><BR>".$rs->Value('ca_preferencias')."&nbsp</TD>";
		   echo "  </TR>";
		   echo "  </TABLE></TD>";
		   echo "</TR>";

		   echo "<TR>";
		   echo "  <TD Class=mostrar style='$vetado' COLSPAN=5><b>Libreta de Direcciones del Cliente:</b> <IMG SRC='./graficos/nuevo.gif' border=0 ALT='Opción de mantenimiento a libreta de direcciones por cliente!'></TD>";
		   echo "  <TD Class=invertir style='vertical-align: top; text-align: center;'>";                                            // Botones para hacer Mantenimiento a la Tabla
		   echo "    <IMG style='visibility: $visible;' src='./graficos/edit.gif' alt='Editar el Registro' border=0 onclick='elegir(\"Libreta\", ".$rs->Value('ca_idcliente').");'>";
		   echo "  </TD>";
		   echo "</TR>";
		   echo "<TR>";
		   echo "  <TD Class=mostrar COLSPAN=6><TABLE WIDTH=100% CELLSPACING=1 BORDER=1>";
		   echo "  <TR>";
		   echo "    <TD Class=invertir COLSPAN=4>";
		   echo "      <TABLE WIDTH=100% CELLSPACING=1 CELLPADDING=0 BORDER=0>";
		   $z=0;
		   $emails = explode(",", $rs->Value('ca_confirmar'));
		   for ($i=0; $i<4; $i++){
		   		echo "  <TR>";
				for ($j=0; $j<3; $j++) {
					$cadena = (strlen($emails[$z])==0)?"&nbsp":$emails[$z];
					echo "<TD Class=mostrar style='$vetado'>$cadena</TD>";
					$z++; }
				echo "  </TR>";
			}
		   echo "      </TABLE>";
		   echo "    </TD>";
		   echo "  </TR>";
		   echo "  </TABLE></TD>";
		   echo "</TR>";

		   echo "<TR>";
		   echo "  <TD Class=listar COLSPAN=6><TABLE WIDTH=100% CELLSPACING=1 BORDER=1>";
		   echo "  <TR>";
		   echo "    <TD Class=titulo style='font-family: Arial, Helvetica, sans-serif; font-size: 9px;'>Creado</TD>";
		   echo "    <TD Class=titulo style='font-family: Arial, Helvetica, sans-serif; font-size: 9px;'>Actualizado</TD>";
		   echo "    <TD Class=titulo style='font-family: Arial, Helvetica, sans-serif; font-size: 9px;'>Coltrans</TD>";
		   echo "    <TD Class=titulo style='font-family: Arial, Helvetica, sans-serif; font-size: 9px;'>Colmas</TD>";
		   echo "  </TR>";
		   echo "  <TR>";
		   echo "    <TD Class=invertir style='font-family: Arial, Helvetica, sans-serif; font-size: 9px; text-align: center'>".$rs->Value('ca_usucreado')."</TD>";
		   echo "    <TD Class=invertir style='font-family: Arial, Helvetica, sans-serif; font-size: 9px; text-align: center'>".$rs->Value('ca_usuactualizado')."</TD>";
		   echo "    <TD Class=invertir style='font-family: Arial, Helvetica, sans-serif; font-size: 9px; text-align: center'>".$rs->Value('ca_coltrans_std')."$alerta</TD>";
		   echo "    <TD Class=invertir style='font-family: Arial, Helvetica, sans-serif; font-size: 9px; text-align: center'>".$rs->Value('ca_colmas_std')."$alerta</TD>";
		   echo "  </TR>";
		   echo "  <TR>";
		   echo "    <TD Class=invertir style='font-family: Arial, Helvetica, sans-serif; font-size: 9px; text-align: center'>".$rs->Value('ca_fchcreado')."</TD>";
		   echo "    <TD Class=invertir style='font-family: Arial, Helvetica, sans-serif; font-size: 9px; text-align: center'>".$rs->Value('ca_fchactualizado')."&nbsp</TD>";
		   echo "    <TD Class=invertir style='font-family: Arial, Helvetica, sans-serif; font-size: 9px; text-align: center'>".$rs->Value('ca_coltrans_fch')."</TD>";
		   echo "    <TD Class=invertir style='font-family: Arial, Helvetica, sans-serif; font-size: 9px; text-align: center'>".$rs->Value('ca_colmas_fch')."</TD>";
		   echo "  </TR>";
		   echo "  </TABLE></TD>";
		   echo "</TR>";
		   if ($rs->Value('ca_diascredito') != 0 or $rs->Value('ca_cupo') != 0){
			   echo "<TR>";
			   echo "  <TD Class=destacar><B>Liberación Automática:</B></TD>";
			   echo "  <TD Class=destacar COLSPAN=4><TABLE WIDTH=100% CELLSPACING=1 BORDER=1>";
			   echo "  <TR>";
			   echo "    <TD Class=destacar><B>Días/Crédito : </B>".$rs->Value('ca_diascredito')."</TD>";
			   echo "    <TD Class=destacar><B>Cupo Asignado : </B>".number_format($rs->Value('ca_cupo'))."</TD>";
			   echo "  </TR>";
			   echo "  <TR>";
			   echo "    <TD Class=destacar COLSPAN=2><B>Observaciones : </B>".$rs->Value('ca_observaciones')."</TD>";
			   echo "  </TR>";
			   echo "  </TABLE></TD>";
			   echo "  <TD Class=destacar></TD>";
			   echo "</TR>";
			   }
		   if ($rs->Value('ca_fchfirmado') != '' or $rs->Value('ca_fchvencimiento') != ''){
			   list($anno, $mes, $dia) = sscanf($rs->Value('ca_fchvencimiento'),"%d-%d-%d");
			   $col_mem = (date("Y-m-d",mktime(0,0,0,$mes,$dia,$anno)) >= date("Y-m-d"))?'#00A040':'#FF6666';
			   echo "<TR>";
			   echo "  <TD Class=listar style='background-color: $col_mem;'><B>Contrato de Comodato</B></TD>";
			   echo "  <TD Class=listar COLSPAN=4 style='background-color: $col_mem;'><TABLE WIDTH=100% CELLSPACING=1 BORDER=1>";
			   echo "  <TR>";
			   echo "    <TD Class=listar style='background-color: $col_mem;'><B>Fch.de Firmado: </B>".$rs->Value('ca_fchfirmado')."</TD>";
			   echo "    <TD Class=listar style='background-color: $col_mem;'><B>Fch.de Vencimiento: </B>".$rs->Value('ca_fchvencimiento')."</TD>";
			   echo "  </TR>";
			   echo "  </TABLE></TD>";
			   echo "  <TD Class=listar style='background-color: $col_mem;'></TD>";
			   echo "</TR>";
			   }
		   $rs->MoveNext();
		   }
		echo "<TR HEIGHT=4>";
		echo "  <TD Class=titulo COLSPAN=6></TD>";
		echo "</TR>";
		echo "</TABLE><BR>";
		
		if($rs->GetRowCount() == 1) {
			echo "<TABLE WIDTH=600 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
			if (!$rs->IsEmpty()) {
				echo "<TR>";
				echo "  <TH Class=titulo COLSPAN=6>Maestra de Seguimientos a Clientes</TH>";
				echo "</TR>";
				echo "<TH>Fecha</TH>";
				echo "<TH>Tipo</TH>";
				echo "<TH>Asunto</TH>";
				echo "<TH>Detalle</TH>";
				echo "<TH>Compromisos</TH>";
				echo "<TH><IMG src='./graficos/new.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(\"Evento\", ".$rs->Value('ca_idcliente').");'></TH>";  // Botón para la creación de un Registro Nuevo
				}       
			$eve_ant = 0;
			while (!$tm->Eof()) {
				if ($eve_ant != $tm->Value('ca_idevento_ant')) {
					echo "<TR>";
					echo "  <TD Class=mostrar COLSPAN=6><B>".$tm->Value('ca_asunto_ant')."</B></TD>";
					echo "</TR>";
					$eve_ant = $tm->Value('ca_idevento_ant');
					}
				echo "<TR>";
				echo "  <TD WIDTH=60 Class=listar style='letter-spacing:-1px;'>".$tm->Value('ca_fchevento')."</TD>";
				echo "  <TD WIDTH=60 Class=listar style='letter-spacing:-1px;'>".$tm->Value('ca_tipo')."</TD>";
				echo "  <TD WIDTH=100 Class=listar style='letter-spacing:-1px;'>".$tm->Value('ca_asunto')."</TD>";
				echo "  <TD WIDTH=170 Class=listar style='letter-spacing:-1px;'>".$tm->Value('ca_detalle')."<BR>Generó :".$tm->Value('ca_usuario')."</TD>";
				echo "  <TD WIDTH=200 Class=listar style='letter-spacing:-1px;'>".$tm->Value('ca_compromisos')."<BR>Pazo :".$tm->Value('ca_fchcompromiso')."</TD>";
				echo "  <TD WIDTH=10 Class=listar style='letter-spacing:-1px;'>&nbsp</TD>";
				echo "</TR>";
				$tm->MoveNext();
				}
			echo "</TABLE><BR>";
			}
	}
		
	echo "<TABLE CELLSPACING=10>";
	echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Nueva Consulta' ONCLICK='javascript:document.location.href = \"clientes.php\"'></TH>";  // Realizar una nueva consulta
	echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Terminar' ONCLICK='javascript:document.location.href = \"/\"'></TH>";  // Cancela la operación
	echo "</TABLE>";
	echo "</FORM>";
	echo "</CENTER>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
	require_once("footer.php");
    echo "</BODY>";
	echo "</HTML>";
    }
elseif (isset($boton)) {                                                       // Switch que evalua cual botòn de comando fue pulsado por el usuario
    switch(trim($boton)) {
        case 'Evento': {                                                    // Opcion para Adicionar Registros a la tabla
             $modulo = "00100100";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
             $tm =& DlRecordset::NewRecordset($conn);
             if (!$tm->Open("select ca_idevento, ca_asunto from tb_evecliente where ca_idcliente = $id and ca_idantecedente=0 order by ca_idevento desc")) {       // Selecciona todos lo registros de la tabla Eventos Clientes
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";          // Muestra el mensaje de error
                 echo "<script>document.location.href = 'clientes.php';</script>";
                 exit; }
             echo "<HEAD>";
             echo "<TITLE>Tabla de Eventos por Cliente</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
             echo "  if (document.adicionar.asunto.value == '')";
             echo "      alert('El campo Asunto no es válido');";
             echo "  else if (document.adicionar.detalle.value == '')";
             echo "      alert('El campo Detalle no es válido');";
             echo "  else if (document.adicionar.compromisos.value == '')";
             echo "      alert('El campo Compromisos no es válido');";
             echo "  else if (!chkDate(document.adicionar.fchcompromiso))";
             echo "      document.adicionar.fchcompromiso.focus();";
             echo "  else";
             echo "      return (true);";
             echo "  return (false);";
             echo "}";
             echo "</script>";
             echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
             echo "</HEAD>";
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='adicionar' ACTION='clientes.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta modificando
             echo "<TABLE CELLSPACING=1>";
             echo "<TH Class=titulo COLSPAN=2>Datos del Evento</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Tipo de Evento :</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='tipo'>";
             for ($i=0; $i < count($tipos); $i++) {
                  echo " <OPTION VALUE='".$tipos[$i]."'>".$tipos[$i];
                  }
             echo "  </SELECT></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Asunto:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='asunto' SIZE=40 MAXLENGTH=50></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Detalle:</TD>";
             echo "  <TD Class=mostrar><TEXTAREA NAME='detalle' WRAP=virtual ROWS=5 COLS=50></TEXTAREA></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Compromisos:</TD>";
             echo "  <TD Class=mostrar><TEXTAREA NAME='compromisos' WRAP=virtual ROWS=5 COLS=50></TEXTAREA></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Cumplir Antes de:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='fchcompromiso' SIZE=12 VALUE='".date("Y-m-d")."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
             echo "</TR>";
             echo "  <TD Class=captura>Evento Antecesor:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='idantecedente'>";             // Llena el cuadro de lista con los valores de la tabla Transportistas
             $tm->MoveFirst();
             while ( !$tm->Eof()) {
                echo " <OPTION VALUE=".$tm->Value('ca_idevento').">".$tm->Value('ca_asunto')."</OPTION>";
                $tm->MoveNext();
                }
             echo "  <OPTION VALUE=0>Evento Raiz</OPTION>";
             echo "</TABLE><BR>";
             $cadena = "?modalidad=N.i.t.\&criterio=$id";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Registrar'></TH>";         // Ordena almacenar los datos ingresados
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"clientes.php$cadena\"'></TH>";  // Cancela la operación
			 echo "<script>adicionar.id.focus()</script>";
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
             require_once("footer.php");
             echo "</BODY>";
             break;
             }
        case 'Adicionar': {                                                    // Opcion para Adicionar Registros a la tabla
             $modulo = "00100100";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
             $tm =& DlRecordset::NewRecordset($conn);
             if (!$tm->Open("select ca_idciudad, ca_ciudad, ca_nombre from vi_ciudades where ca_idtrafico='CO-057'")) {       // Selecciona todos lo registros de la tabla Ciudades
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";          // Muestra el mensaje de error
                 echo "<script>document.location.href = 'clientes.php';</script>";
                 exit; }
             if (isset($nit)) {
                 $po =& DlRecordset::NewRecordset($conn);
                 if (!$po->Open("select * from vi_potenciales where ca_idcliente=$nit")) {  // Selecciona todos lo registros de la tabla Clientes Potenciales
                     echo "<script>alert(\"".addslashes($po->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                     echo "<script>document.location.href = 'clientes.php';</script>";
                     exit; }
             }
             $us =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
             if (!$us->Open("select ca_login, ca_nombre from control.tb_usuarios where upper(ca_departamento) like '%ADUANAS%' order by ca_login")) {
                 echo "<script>alert(\"".addslashes($us->mErrMsg)."\");</ script>";
                 echo "<script>document.location.href = 'inosea.php';</ script>";
                 exit;
                }
             $us->MoveFirst();
             echo "<HEAD>";
             echo "<TITLE>Tabla de Contactos por Cliente</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
             echo "  if (document.adicionar.id.value == 0)";
             echo "      alert('El campo Identificación no es válido');";
             echo "  else if (document.adicionar.digito.value == '' && d_verificacion())";
             echo "      alert('El campo Digito de Verificación no es válido');";
             echo "  else if (document.adicionar.compania.value == '')";
             echo "      alert('El campo Compañia no es válido');";
             echo "  else if (document.adicionar.nombres.value == '')";
             echo "      alert('El campo Nombres no es válido');";
             echo "  else if (document.adicionar.papellido.value == '')";
             echo "      alert('El campo Primer Apellido no es válido');";
             echo "  else if (document.adicionar.dircompleta.value == '')";
             echo "      alert('El campo Dirección no es válido');";
             echo "  else if (document.adicionar.telefonos.value == '')";
             echo "      alert('El campo Teléfonos no es válido');";
             echo "  else if (document.adicionar.fax.value == '')";
             echo "      alert('El campo Fax no es válido');";
             echo "  else if (document.adicionar.sectoreco.value == '')";
             echo "      alert('El campo Sector Económico no es válido');";
             echo "  else {";
             echo "      respuesta = eval(verificar());";
             echo "      return (respuesta); }";
             echo "  return (false);";
             echo "}";
             echo "function verificar() {";
             echo "  if( document.adicionar.digito.value != d_verificacion(document.adicionar.id.value) ){";
             echo "      alert('¡El dígito de verificación no corresponde al Nit!');";
             echo "      adicionar.id.focus();";
             echo "      return false; }";
             echo "  else if(eval(document.adicionar.existe.value)){";
             echo "      alert('Este número de Nit ya se encuentra registrado en la Maestra de Clientes');";
             echo "      adicionar.id.focus();";
             echo "      return false; }";
             echo "  else";
             echo "      return true;";
             echo "}";
             echo "function d_verificacion(nit) {";
             echo "  ceros = '000000000000000';";
             echo "  li_peso= new Array();";
             echo "  li_peso[0] = 71;";
             echo "  li_peso[1] = 67;";
             echo "  li_peso[2] = 59;";
             echo "  li_peso[3] = 53;";
             echo "  li_peso[4] = 47;";
             echo "  li_peso[5] = 43;";
             echo "  li_peso[6] = 41;";
             echo "  li_peso[7] = 37;";
             echo "  li_peso[8] = 29;";
             echo "  li_peso[9] = 23;";
             echo "  li_peso[10] = 19;";
             echo "  li_peso[11] = 17;";
             echo "  li_peso[12] = 13;";
             echo "  li_peso[13] = 7;";
             echo "  li_peso[14] = 3;";
             echo "  ls_str_nit = (ceros + nit).substring((ceros + nit).length - 15, (ceros + nit).length);";
             echo "  li_suma = 0;";
             echo "  for( i = 0; i < 15; i++ ){";
             echo "       li_suma += ls_str_nit.substring(i,i+1) * li_peso[i];";
             echo "     }";
             echo "  digito_chequeo = li_suma%11;";
             echo "  if ( digito_chequeo >= 2 )";
             echo "       digito_chequeo = 11 - digito_chequeo;";
             echo "  return digito_chequeo;";
             echo "}";
             echo "function completar(from) {";
             echo "  document.adicionar.dircompleta.value = '';";
             echo "  for( i = 0; i < from.length; i++ ){";
             echo "       if( i == 8 )";
             echo "           document.adicionar.dircompleta.value+= '- ' +from[i].value + ' ';";
             echo "       else if( from[i].value != '')";
             echo "           document.adicionar.dircompleta.value+= from[i].value + ' ';";
             echo "       if( i == 9 && document.adicionar.oficina.value != '')";
             echo "           document.adicionar.dircompleta.value+= 'Oficina: ' + document.adicionar.oficina.value + ' ';";
             echo "       if( i == 9 && document.adicionar.torre.value != '')";
             echo "           document.adicionar.dircompleta.value+= 'Torre: ' + document.adicionar.torre.value + ' ';";
             echo "       if( i == 9 && document.adicionar.bloque.value != '')";
             echo "           document.adicionar.dircompleta.value+= 'Bloque: ' + document.adicionar.bloque.value + ' ';";
             echo "       if( i == 9 && document.adicionar.interior.value != '')";
             echo "           document.adicionar.dircompleta.value+= 'Interior: ' + document.adicionar.interior.value + ' ';";
             echo "       if( i == 9 && document.adicionar.complemento.value != '')";
             echo "           document.adicionar.dircompleta.value+= '- ' + document.adicionar.complemento.value + ' ';";
             echo "     }";
             echo "}";
             echo "function validacion(ventana, to){";
             echo "  frame = document.getElementById(ventana + '_frame');";
             echo "  ventana = document.getElementById(ventana);";
             echo "  frame.src='validcliente.php?id='+to.value;";
             echo "}";
             echo "</script>";
			 echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
             echo "</HEAD>";
             echo "<BODY>";
require_once("menu.php");
             echo "<DIV ID='validcliente' STYLE='visibility:hidden; position:absolute; border-width:1; border-color:#445599; border-style:solid;'>";  // left:150; top:25; width:600; height:200
             echo "  <IFRAME ID='validcliente_frame' SRC='validcliente.php' MARGINWIDTH=0 MARGINHEIGHT=0 FRAMEBORDER='NO' SCROLLING='YES' STYLE='width:600; height:150'>";
             echo "  </IFRAME>";
             echo "</DIV>";
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='adicionar' ACTION='clientes.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
             echo "<INPUT TYPE='HIDDEN' NAME='existe' VALUE=false>";           // Bandera para el control de la existencia del cliente
             echo "<TABLE CELLSPACING=1>";
             echo "<TH Class=titulo COLSPAN=3>Datos para el nuevo Cliente</TH>";
             if (isset($nit)){
                 echo "<TR>";
                 echo "  <TD Class=captura style='vertical-align:top;'>Base de Datos:<BR><B>Quintero Hermanos Ltda.</B></TD>";
                 echo "  <TD Class=invertir COLSPAN=2>";
                 echo "    <B>N.i.t. : </B>".$po->Value('ca_idcliente')."<BR>";
                 echo "    <B>Cliente : </B>".$po->Value('ca_compania')."<BR>";
                 echo "    <B>Representante : </B>".$po->Value('ca_ncompleto')."<BR>";
                 echo "    <B>Dirección : </B>".$po->Value('ca_direccion')."<BR>";
                 echo "    <B>Teléfonos : </B>".$po->Value('ca_telefonos')."<BR>";
                 echo "    <B>Fax : </B>".$po->Value('ca_fax')."<BR>";
                 echo "    <B>Ciudad : </B>".$po->Value('ca_ciudad')."<BR>";
                 echo "    <B>email : </B>".$po->Value('ca_email')."<BR>";
                 echo "  </TD>";
                 echo "</TR>";
                 echo "<TR>";
                 echo "  <TD Class=captura>N.i.t.:</TD>";
                 echo "  <TD Class=mostrar COLSPAN=2><INPUT TYPE='TEXT' NAME='id' VALUE='".$po->Value('ca_idcliente')."' SIZE=13 MAXLENGTH=11 ONBLUR='validacion(\"validcliente\",this);'>-<INPUT TYPE='TEXT' NAME='digito' SIZE=2 MAXLENGTH=1 ONBLUR='verificar();'></TD>";
                 echo "  <script>document.adicionar.digito.value = d_verificacion(document.adicionar.id.value);</script>";
                 echo "</TR>";
                 echo "<TR>";
                 echo "  <TD Class=captura>Compañia:</TD>";
                 echo "  <TD Class=mostrar COLSPAN=2><INPUT TYPE='TEXT' NAME='compania' VALUE='".$po->Value('ca_compania')."' SIZE=60 MAXLENGTH=60 style='text-transform: uppercase'></TD>";
                 echo "</TR>"; } 
             else {
                 echo "<TR>";
                 echo "  <TD Class=captura>N.i.t.:</TD>";
                 echo "  <TD Class=mostrar COLSPAN=2><INPUT TYPE='TEXT' NAME='id' SIZE=13 MAXLENGTH=11 ONBLUR='validacion(\"validcliente\",this);'>-<INPUT TYPE='TEXT' NAME='digito' SIZE=2 MAXLENGTH=1 ONBLUR='verificar();'></TD>";
                 echo "</TR>";
                 echo "<TR>";
                 echo "  <TD Class=captura>Compañia:</TD>";
                 echo "  <TD Class=mostrar COLSPAN=2><INPUT TYPE='TEXT' NAME='compania' SIZE=60 MAXLENGTH=60 style='text-transform: uppercase'></TD>";
                 echo "</TR>"; }
             echo "<TR>";
             echo "  <TD Class=captura style='vertical-align: top;' ROWSPAN=4>Representante Legal :</TD>";
             echo "  <TD Class=mostrar>Saludo:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='saludo'>";
             while (list ($clave, $val) = each ($saludos)) {
                echo " <OPTION VALUE=$clave>$val</OPTION>";
             }
             echo "  </SELECT></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Nombres:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='nombres' SIZE=30 MAXLENGTH=30></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Primer Apellido:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='papellido' SIZE=15 MAXLENGTH=15></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Segundo Apellido:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='sapellido' SIZE=15 MAXLENGTH=15></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura style='vertical-align: top;'>Fecha de Cumpleaños:</TD>";
             echo "  <TD Class=mostrar COLSPAN=2><INPUT TYPE='TEXT' NAME='cumpleanos' SIZE=20 MAXLENGTH=30>&nbsp&nbsp&nbsp&nbsp&nbspSexo :&nbsp&nbsp<SELECT NAME='sexo'>";
             for ($i=0; $i < count($sexos); $i++) {
                  echo " <OPTION VALUE='".$sexos[$i]."'>".$sexos[$i];
                  }
             echo "  </SELECT></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Dirección:</TD>";
             echo "  <TD Class=mostrar COLSPAN=2><INPUT TYPE='TEXT' NAME='dircompleta' SIZE=66 MAXLENGTH=66 READONLY></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura style='vertical-align: top;' ROWSPAN=6><SELECT NAME='direccion[]' ONCHANGE='completar(adicionar.elements[\"direccion[]\"]);'>";
             for ($i=0; $i < count($parte_1); $i++) {
                  echo " <OPTION VALUE='".$parte_1[$i]."'>".$parte_1[$i];
                  }
             echo "  </SELECT>";
             echo "  <INPUT TYPE='TEXT' NAME='direccion[]' SIZE=3 MAXLENGTH=15 ONCHANGE='completar(adicionar.elements[\"direccion[]\"]);'>";
             echo "  <TD Class=mostrar COLSPAN=2><SELECT NAME='direccion[]' ONCHANGE='completar(adicionar.elements[\"direccion[]\"]);'>";
             for ($i=0; $i < count($letras); $i++) {
                  echo " <OPTION VALUE='".$letras[$i]."'>".$letras[$i];
                  }
             echo "  </SELECT>";
             echo "  <SELECT NAME='direccion[]' ONCHANGE='completar(adicionar.elements[\"direccion[]\"]);'>";
             for ($i=0; $i < count($parte_2); $i++) {
                  echo " <OPTION VALUE='".$parte_2[$i]."'>".$parte_2[$i];
                  }
             echo "  </SELECT>";
             echo "  <INPUT TYPE='TEXT' NAME='direccion[]' VALUE=No. READONLY SIZE=2 ONCHANGE='completar(adicionar.elements[\"direccion[]\"]);'>";
             echo "  <INPUT TYPE='TEXT' NAME='direccion[]' SIZE=2 MAXLENGTH=3 ONCHANGE='completar(adicionar.elements[\"direccion[]\"]);'>";
             echo "  <SELECT NAME='direccion[]' ONCHANGE='completar(adicionar.elements[\"direccion[]\"]);'>";
             for ($i=0; $i < count($letras); $i++) {
                  echo " <OPTION VALUE='".$letras[$i]."'>".$letras[$i];
                  }
             echo "  </SELECT>";
             echo "  <SELECT NAME='direccion[]' ONCHANGE='completar(adicionar.elements[\"direccion[]\"]);'>";
             for ($i=0; $i < count($parte_2); $i++) {
                  echo " <OPTION VALUE='".$parte_2[$i]."'>".$parte_2[$i];
                  }
             echo "  </SELECT>";
             echo "  -";
             echo "  <INPUT TYPE='TEXT' NAME='direccion[]' SIZE=2 MAXLENGTH=3 ONCHANGE='completar(adicionar.elements[\"direccion[]\"]);'>";
             echo "  <SELECT NAME='direccion[]' ONCHANGE='completar(adicionar.elements[\"direccion[]\"]);'>";
             for ($i=0; $i < count($parte_3); $i++) {
                  echo " <OPTION VALUE='".$parte_3[$i]."'>".$parte_3[$i];
                  }
             echo "  </SELECT>";
             echo "  </TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Oficina:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='oficina' SIZE=15 MAXLENGTH=16 ONCHANGE='completar(adicionar.elements[\"direccion[]\"]);'></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Torre:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='torre' SIZE=15 MAXLENGTH=16 ONCHANGE='completar(adicionar.elements[\"direccion[]\"]);'></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Bloque:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='bloque' SIZE=15 MAXLENGTH=16 ONCHANGE='completar(adicionar.elements[\"direccion[]\"]);'></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Interior:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='interior' SIZE=15 MAXLENGTH=16 ONCHANGE='completar(adicionar.elements[\"direccion[]\"]);'></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Complemento:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='complemento' SIZE=47 MAXLENGTH=50 ONCHANGE='completar(adicionar.elements[\"direccion[]\"]);'></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Localidad:</TD>";
             echo "  <TD Class=mostrar COLSPAN=4><SELECT NAME='localidad'>";
             for ($i=0; $i < count($localidades); $i++) {
                  echo " <OPTION VALUE='".$localidades[$i]."'>".$localidades[$i];
                  }
             echo "  </SELECT>";
             echo "  </TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Teléfonos:</TD>";
             echo "  <TD Class=mostrar COLSPAN=2><INPUT TYPE='TEXT' NAME='telefonos' SIZE=30 MAXLENGTH=30></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Fax:</TD>";
             echo "  <TD Class=mostrar COLSPAN=2><INPUT TYPE='TEXT' NAME='fax' SIZE=30 MAXLENGTH=30></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Ciudad:</TD>";
             echo "  <TD Class=mostrar COLSPAN=2><SELECT NAME='idciudad'>";             // Llena el cuadro de lista con los valores de la tabla Ciudades
             while ( !$tm->Eof()) {
                     echo " <OPTION VALUE=".$tm->Value('ca_idciudad').">".$tm->Value('ca_ciudad')." «".$tm->Value('ca_nombre')."»</OPTION>";
                     $tm->MoveNext();
                   }
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Página Web:</TD>";
             echo "  <TD Class=mostrar COLSPAN=2><INPUT TYPE='TEXT' NAME='website' SIZE=60 MAXLENGTH=60 style='text-transform: lowercase'></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Correo Electrónico:</TD>";
             echo "  <TD Class=mostrar COLSPAN=2><INPUT TYPE='TEXT' NAME='email' SIZE=40 MAXLENGTH=40 style='text-transform: lowercase'></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura style='vertical-align: top;'>Actividad Económica:</TD>";
             echo "  <TD Class=mostrar COLSPAN=2><TEXTAREA NAME='actividad' WRAP=virtual ROWS=5 COLS=58></TEXTAREA></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Sector Económico:</TD>";
             echo "  <TD Class=mostrar COLSPAN=2><INPUT TYPE='TEXT' NAME='sectoreco' SIZE=30 MAXLENGTH=30></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Circular 170:</TD>";
			 echo "  <TD Class=invertir COLSPAN=2><TABLE CELLSPACING=1 WIDTH=100%><TR>";
             echo "  <TD Class=mostrar>Diligenciado: (aaaa/mm/dd)<BR /><CENTER><INPUT TYPE='TEXT' NAME='fchcircular' SIZE=12 VALUE='' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></CENTER></TD>";
             echo "  <TD Class=mostrar>Nivel de Riesgo:<BR /><CENTER><SELECT NAME='nvlriesgo'>";
             for ($i=0; $i < count($riesgos); $i++) {
                  echo " <OPTION VALUE='".$riesgos[$i]."'>".$riesgos[$i];
                  }
             echo "  </SELECT></CENTER></TD>";
			 echo "  </TABLE><TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Ley Insolvencia Eco.:</TD>";
			 echo "  <TD Class=invertir COLSPAN=2><TABLE CELLSPACING=1 WIDTH=100%><TR>";
             echo "  <TD Class=mostrar>Reportado en Ley Insolvencia Eco.:<BR /><CENTER><SELECT NAME='leyinsolvencia'>";
             echo "  	<OPTION VALUE='No'>No";
             echo "  	<OPTION VALUE='Sí'>Sí";
             echo "  </SELECT></CENTER></TD>";
			 echo "  <TD Class=mostrar>Comentario:<BR /><CENTER><INPUT TYPE='TEXT' NAME='comentario' SIZE=40 MAXLENGTH=255></CENTER></TD>";
			 echo "  </TABLE><TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Contrato/Agenciamiento:</TD>";
			 echo "  <TD Class=invertir COLSPAN=2><TABLE CELLSPACING=1 WIDTH=100%><TR>";
             echo "  <TD Class=mostrar>Último Radicado: (aaaa/mm/dd)<BR /><CENTER><INPUT TYPE='TEXT' NAME='fchcotratoag' SIZE=12 VALUE='' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></CENTER></TD>";
             echo "  <TD Class=mostrar>Reportado en Lista Clinton:<BR /><CENTER><SELECT NAME='listaclinton'>";
             echo "  	<OPTION VALUE='No'>No";
             echo "  	<OPTION VALUE='Sí'>Sí";
             echo "  </SELECT></CENTER></TD>";
			 echo "  </TABLE><TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Status:</TD>";
			 echo "  <TD Class=invertir COLSPAN=2><TABLE CELLSPACING=1 WIDTH=100%><TR>";
             echo "  <TD Class=mostrar><SELECT NAME='status'>";
             for ($i=0; $i < count($sstatus); $i++) {
                  echo " <OPTION VALUE='".$sstatus[$i]."'>".$sstatus[$i];
                  }
             echo "  </SELECT></TD>";
             echo "  <TD Class=mostrar>Calificación : <SELECT NAME='calificacion'>";
             for ($i=0; $i < count($calificaciones); $i++) {
                  echo " <OPTION VALUE='".$calificaciones[$i]."'>".$calificaciones[$i];
                  }
             echo "  </SELECT></TD>";
			 echo "  </TABLE><TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura style='vertical-align: top;'>Coordinador Colmas:</TD>";
             echo "  <TD Class=mostrar COLSPAN=2><SELECT NAME='coordinador'>";  // Llena el cuadro de lista con los valores de la tabla Vendedores
			 echo "<OPTION VALUE=''>Ninguno Asignado</OPTION>";
             $us->MoveFirst();
             while (!$us->Eof()) {
                    echo "<OPTION VALUE='".$us->Value('ca_login')."'>".$us->Value('ca_nombre')."</OPTION>";
                    $us->MoveNext();
                   }
             echo "  </SELECT></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura style='vertical-align: top;'>Preferencias:</TD>";
             echo "  <TD Class=mostrar COLSPAN=2><TEXTAREA NAME='preferencias' WRAP=virtual ROWS=5 COLS=65></TEXTAREA></TD>";
             echo "</TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Guardar'></TH>";         // Ordena almacenar los datos ingresados
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"clientes.php\"'></TH>";  // Cancela la operación
             echo "<script>adicionar.id.focus()</script>";
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
             require_once("footer.php");
             echo "</BODY>";
             break;
             }
        case 'Modificar': {
             $modulo = "00100200";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
             $tm =& DlRecordset::NewRecordset($conn);
             if (!$tm->Open("select ca_idciudad, ca_ciudad, ca_nombre from vi_ciudades where ca_idtrafico='CO-057'")) {       // Selecciona todos lo registros de la tabla Ciudades
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'clientes.php';</script>";
                 exit; }
             if (!$rs->Open("select * from vi_clientes where ca_idcliente = ".$id)) {    // Mueve el apuntador al registro que se desea modificar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'clientes.php';</script>";
                 exit;
                }
             $us =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
             if (!$us->Open("select ca_login, ca_nombre from control.tb_usuarios where upper(ca_departamento) like '%ADUANAS%' order by ca_login")) {
                 echo "<script>alert(\"".addslashes($us->mErrMsg)."\");</ script>";
                 echo "<script>document.location.href = 'inosea.php';</ script>";
                 exit;
                }
             $us->MoveFirst();
             echo "<HEAD>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
             echo "  if (document.modificar.compania.value == '')";
             echo "      alert('El campo Compañia no es válido');";
             echo "  else if (document.modificar.nombres.value == '')";
             echo "      alert('El campo Nombres no es válido');";
             echo "  else if (document.modificar.papellido.value == '')";
             echo "      alert('El campo Primer Apellido no es válido');";
             echo "  else if (document.modificar.dircompleta.value == '')";
             echo "      alert('El campo Dirección no es válido');";
             echo "  else if (document.modificar.telefonos.value == '')";
             echo "      alert('El campo Teléfonos no es válido');";
             echo "  else if (document.modificar.fax.value == '')";
             echo "      alert('El campo Fax no es válido');";
             echo "  else if (document.modificar.sectoreco.value == '')";
             echo "      alert('El campo Sector Económico no es válido');";
             echo "  else";
             echo "      return (true);";
             echo "  return (false);";
             echo "}";
             echo "function completar(from) {";
             echo "  document.modificar.dircompleta.value = '';";
             echo "  for( i = 0; i < from.length; i++ ){";
             echo "       if( i == 8 )";
             echo "           document.modificar.dircompleta.value+= '- ' +from[i].value + ' ';";
             echo "       else if( from[i].value != '')";
             echo "           document.modificar.dircompleta.value+= from[i].value + ' ';";
             echo "       if( i == 9 && document.modificar.oficina.value != '')";
             echo "           document.modificar.dircompleta.value+= 'Oficina: ' + document.modificar.oficina.value + ' ';";
             echo "       if( i == 9 && document.modificar.torre.value != '')";
             echo "           document.modificar.dircompleta.value+= 'Torre: ' + document.modificar.torre.value + ' ';";
             echo "       if( i == 9 && document.modificar.bloque.value != '')";
             echo "           document.modificar.dircompleta.value+= 'Bloque: ' + document.modificar.bloque.value + ' ';";
             echo "       if( i == 9 && document.modificar.interior.value != '')";
             echo "           document.modificar.dircompleta.value+= 'Interior: ' + document.modificar.interior.value + ' ';";
             echo "       if( i == 9 && document.modificar.complemento.value != '')";
             echo "           document.modificar.dircompleta.value+= '- ' + document.modificar.complemento.value + ' ';";
             echo "     }";
             echo "}";
             echo "</script>";
			 echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
             echo "</HEAD>";
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='modificar' ACTION='clientes.php' ONSUBMIT='return validar();'>"; // Llena la forma con los datos actuales del registro
             echo "<TABLE CELLSPACING=1>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta modificando
             echo "<INPUT TYPE='HIDDEN' NAME='vendedor' VALUE='".$rs->Value('ca_vendedor')."'>";
             echo "<TH Class=titulo COLSPAN=3>Nuevos Datos para el Cliente</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>N.i.t.:</TD>";
             echo "  <TD Class=mostrar COLSPAN=2>".$rs->Value('ca_idcliente')." - ".$rs->Value('ca_digito')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Compañia:</TD>";
             echo "  <TD Class=mostrar COLSPAN=2><INPUT TYPE='TEXT' NAME='compania' VALUE='".$rs->Value('ca_compania')."' SIZE=60 MAXLENGTH=60 style='text-transform: uppercase'></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura style='vertical-align: top;' ROWSPAN=4>Representante Legal :</TD>";
             echo "  <TD Class=mostrar>Saludo:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='saludo'>";
             while (list ($clave, $val) = each ($saludos)) {
                echo " <OPTION VALUE=$clave";
                if ($clave==$rs->Value('ca_saludo')) {
                    echo" SELECTED"; }
                echo ">$val</OPTION>";
             }
             echo "  </SELECT></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Nombres:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='nombres' VALUE='".$rs->Value('ca_nombres')."' SIZE=30 MAXLENGTH=30></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Primer Apellido:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='papellido' VALUE='".$rs->Value('ca_papellido')."' SIZE=15 MAXLENGTH=15></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Segundo Apellido:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='sapellido' VALUE='".$rs->Value('ca_sapellido')."' SIZE=15 MAXLENGTH=15></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura style='vertical-align: top;'>Fecha de Cumpleaños:</TD>";
             echo "  <TD Class=mostrar COLSPAN=2><INPUT TYPE='TEXT' NAME='cumpleanos'  VALUE='".$rs->Value('ca_cumpleanos')."'SIZE=20 MAXLENGTH=30>&nbsp&nbsp&nbsp&nbsp&nbspSexo :&nbsp&nbsp<SELECT NAME='sexo'>";
             for ($i=0; $i < count($sexos); $i++) {
                  echo " <OPTION VALUE='".$sexos[$i]."'";
                  if ($sexos[$i]==$rs->Value('ca_sexo')) {
                      echo" SELECTED"; }
                  echo " >".$sexos[$i];
                  }
             echo "  </SELECT></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Dirección:</TD>";
             echo "  <TD Class=mostrar COLSPAN=2><INPUT TYPE='TEXT' NAME='dircompleta' SIZE=66 MAXLENGTH=66 READONLY></TD>";
             echo "</TR>";
             $dir_anterior = explode("|",$rs->Value('ca_direccion'));
             echo "<TR>";
             echo "  <TD Class=captura style='vertical-align: top;' ROWSPAN=6><SELECT NAME='direccion[]' ONCHANGE='completar(modificar.elements[\"direccion[]\"]);'>";
             for ($i=0; $i < count($parte_1); $i++) {
                  echo " <OPTION VALUE='".$parte_1[$i]."'";
                  if ($parte_1[$i]==$dir_anterior[0]) {
                      echo" SELECTED"; }
                  echo " >".$parte_1[$i];
                  }
             echo "  </SELECT>";
             echo "  <INPUT TYPE='TEXT' NAME='direccion[]' VALUE='".$dir_anterior[1]."' SIZE=3 MAXLENGTH=15 ONCHANGE='completar(modificar.elements[\"direccion[]\"]);'>";
             echo "  <TD Class=mostrar COLSPAN=2><SELECT NAME='direccion[]' ONCHANGE='completar(modificar.elements[\"direccion[]\"]);'>";
             for ($i=0; $i < count($letras); $i++) {
                  echo " <OPTION VALUE='".$letras[$i]."'";
                  if ($letras[$i]==$dir_anterior[2]) {
                      echo" SELECTED"; }
                  echo " >".$letras[$i];
                  }
             echo "  </SELECT>";
             echo "  <SELECT NAME='direccion[]' ONCHANGE='completar(modificar.elements[\"direccion[]\"]);'>";
             for ($i=0; $i < count($parte_2); $i++) {
                  echo " <OPTION VALUE='".$parte_2[$i]."'";
                  if ($parte_2[$i]==$dir_anterior[3]) {
                      echo" SELECTED"; }
                  echo " >".$parte_2[$i];
                  }
             echo "  </SELECT>";
             echo "  <INPUT TYPE='TEXT' NAME='direccion[]' VALUE=No. READONLY SIZE=2 ONCHANGE='completar(modificar.elements[\"direccion[]\"]);'>";
             echo "  <INPUT TYPE='TEXT' NAME='direccion[]' VALUE='".$dir_anterior[5]."' SIZE=2 MAXLENGTH=3 ONCHANGE='completar(modificar.elements[\"direccion[]\"]);'>";
             echo "  <SELECT NAME='direccion[]' ONCHANGE='completar(modificar.elements[\"direccion[]\"]);'>";
             for ($i=0; $i < count($letras); $i++) {
                  echo " <OPTION VALUE='".$letras[$i]."'";
                  if ($letras[$i]==$dir_anterior[6]) {
                      echo" SELECTED"; }
                  echo " >".$letras[$i];
                  }
             echo "  </SELECT>";
             echo "  <SELECT NAME='direccion[]' VALUE='".$dir_anterior[7]."' ONCHANGE='completar(modificar.elements[\"direccion[]\"]);'>";
             for ($i=0; $i < count($parte_2); $i++) {
                  echo " <OPTION VALUE='".$parte_2[$i]."'";
                  if ($parte_2[$i]==$dir_anterior[7]) {
                      echo" SELECTED"; }
                  echo " >".$parte_2[$i];
                  }
             echo "  </SELECT>";
             echo "  -";
             echo "  <INPUT TYPE='TEXT' NAME='direccion[]' VALUE='".$dir_anterior[8]."' SIZE=2 MAXLENGTH=3 ONCHANGE='completar(modificar.elements[\"direccion[]\"]);'>";
             echo "  <SELECT NAME='direccion[]' ONCHANGE='completar(modificar.elements[\"direccion[]\"]);'>";
             for ($i=0; $i < count($parte_3); $i++) {
                  echo " <OPTION VALUE='".$parte_3[$i]."'";
                  if ($parte_3[$i]==$dir_anterior[9]) {
                      echo" SELECTED"; }
                  echo " >".$parte_3[$i];
                  }
             echo "  </SELECT>";
             echo "  </TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Oficina:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='oficina' VALUE='".$rs->Value('ca_oficina')."' SIZE=15 MAXLENGTH=16 ONCHANGE='completar(modificar.elements[\"direccion[]\"]);'></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Torre:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='torre' VALUE='".$rs->Value('ca_torre')."' SIZE=15 MAXLENGTH=16 ONCHANGE='completar(modificar.elements[\"direccion[]\"]);'></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Bloque:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='bloque' VALUE='".$rs->Value('ca_bloque')."' SIZE=15 MAXLENGTH=16 ONCHANGE='completar(modificar.elements[\"direccion[]\"]);'></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Interior:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='interior' VALUE='".$rs->Value('ca_interior')."' SIZE=15 MAXLENGTH=16 ONCHANGE='completar(modificar.elements[\"direccion[]\"]);'></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar>Complemento:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='complemento' VALUE='".$rs->Value('ca_complemento')."' SIZE=47 MAXLENGTH=50 ONCHANGE='completar(modificar.elements[\"direccion[]\"]);'></TD>";
             echo "</TR>";
             echo"<script>completar(modificar.elements[\"direccion[]\"])</script>";
             echo "<TR>";
             echo "  <TD Class=captura>Localidad:</TD>";
             echo "  <TD Class=mostrar COLSPAN=4><SELECT NAME='localidad'>";
             for ($i=0; $i < count($localidades); $i++) {
                  echo " <OPTION VALUE='".$localidades[$i]."'";
                  if ($localidades[$i]==$rs->Value('ca_localidad')) {
                      echo" SELECTED"; }
                  echo " >".$localidades[$i];
                  }
             echo "  </SELECT>";
             echo "  </TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Teléfonos:</TD>";
             echo "  <TD Class=mostrar COLSPAN=2><INPUT TYPE='TEXT' NAME='telefonos' VALUE='".$rs->Value('ca_telefonos')."' SIZE=30 MAXLENGTH=30></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Fax:</TD>";
             echo "  <TD Class=mostrar COLSPAN=2><INPUT TYPE='TEXT' NAME='fax' VALUE='".$rs->Value('ca_fax')."' SIZE=30 MAXLENGTH=30></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Ciudad:</TD>";
             echo "  <TD Class=mostrar COLSPAN=2><SELECT NAME='idciudad'>";             // Llena el cuadro de lista con los valores de la tabla Ciudades
             while ( !$tm->Eof()) {
                     echo " <OPTION VALUE=".$tm->Value('ca_idciudad');
                     if ($tm->Value('ca_idciudad')==$rs->Value('ca_idciudad')) {
                         echo " SELECTED"; }
                     echo ">".$tm->Value('ca_ciudad')." «".$tm->Value('ca_nombre')."»</OPTION>";
                     $tm->MoveNext();
                   }
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Página Web:</TD>";
             echo "  <TD Class=mostrar COLSPAN=2><INPUT TYPE='TEXT' NAME='website' VALUE='".$rs->Value('ca_website')."' SIZE=60 MAXLENGTH=60 style='text-transform: lowercase'></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Correo Electrónico:</TD>";
             echo "  <TD Class=mostrar COLSPAN=2><INPUT TYPE='TEXT' NAME='email' VALUE='".$rs->Value('ca_email')."' SIZE=40 MAXLENGTH=40 style='text-transform: lowercase'></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura style='vertical-align: top;'>Actividad Económica:</TD>";
             echo "  <TD Class=mostrar COLSPAN=2><TEXTAREA NAME='actividad' WRAP=virtual ROWS=5 COLS=58>".$rs->Value('ca_actividad')."</TEXTAREA></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Sector Económico:</TD>";
             echo "  <TD Class=mostrar COLSPAN=2><INPUT TYPE='TEXT' NAME='sectoreco' VALUE='".$rs->Value('ca_sectoreco')."' SIZE=30 MAXLENGTH=30></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Circular 170:</TD>";
			 echo "  <TD Class=invertir COLSPAN=2><TABLE CELLSPACING=1 WIDTH=100%><TR>";
             echo "  <TD Class=mostrar>Diligenciado: (aaaa/mm/dd)<BR /><CENTER><INPUT TYPE='TEXT' NAME='fchcircular' SIZE=12 VALUE='".$rs->Value('ca_fchcircular')."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></CENTER></TD>";
             echo "  <TD Class=mostrar>Nivel de Riesgo:<BR /><CENTER><SELECT NAME='nvlriesgo'>";
             for ($i=0; $i < count($riesgos); $i++) {
                  echo " <OPTION VALUE='".$riesgos[$i]."'";
                  if ($riesgos[$i]==$rs->Value('ca_nvlriesgo')) {
                      echo" SELECTED"; }
				  echo ">".$riesgos[$i];
                  }
             echo "  </SELECT></CENTER></TD>";
			 echo "  </TABLE><TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Ley Insolvencia Eco.:</TD>";
			 echo "  <TD Class=invertir COLSPAN=2><TABLE CELLSPACING=1 WIDTH=100%><TR>";
             echo "  <TD Class=mostrar>Reportado en Ley Insolvencia Eco.:<BR /><CENTER><SELECT NAME='leyinsolvencia'>";
             echo "  	<OPTION VALUE='No' ".(($rs->Value('ca_leyinsolvencia')=='No')?'SELECTED':'').">No";
             echo "  	<OPTION VALUE='Sí' ".(($rs->Value('ca_leyinsolvencia')=='Sí')?'SELECTED':'').">Sí";
             echo "  </SELECT></CENTER></TD>";
			 echo "  <TD Class=mostrar>Comentario:<BR /><CENTER><INPUT TYPE='TEXT' NAME='comentario' SIZE=40 VALUE='".$rs->Value('ca_comentario')."' MAXLENGTH=255></CENTER></TD>";
			 echo "  </TABLE><TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Contrato/Agenciamiento:</TD>";
			 echo "  <TD Class=invertir COLSPAN=2><TABLE CELLSPACING=1 WIDTH=100%><TR>";
             echo "  <TD Class=mostrar>Último Radicado: (aaaa/mm/dd)<BR /><CENTER><INPUT TYPE='TEXT' NAME='fchcotratoag' SIZE=12 VALUE='".$rs->Value('ca_fchcotratoag')."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></CENTER></TD>";
             echo "  <TD Class=mostrar>Reportado en Lista Clinton:<BR /><CENTER><SELECT NAME='listaclinton'>";
             echo "  	<OPTION VALUE='No' ".(($rs->Value('ca_listaclinton')=='No')?'SELECTED':'').">No";
             echo "  	<OPTION VALUE='Sí' ".(($rs->Value('ca_listaclinton')=='Sí')?'SELECTED':'').">Sí";
             echo "  </SELECT></CENTER></TD>";
			 echo "  </TABLE><TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Status:</TD>";
			 echo "  <TD Class=invertir COLSPAN=2><TABLE CELLSPACING=1 WIDTH=100%><TR>";
             echo "  <TD Class=mostrar><SELECT NAME='status'>";
             for ($i=0; $i < count($sstatus); $i++) {
                  echo " <OPTION VALUE='".$sstatus[$i]."'";
                  if ($sstatus[$i]==$rs->Value('ca_status')) {
                      echo" SELECTED"; }
                  echo " >".$sstatus[$i];
                  }
             echo "  </SELECT></TD>";
             echo "  <TD Class=mostrar>Calificación : <SELECT NAME='calificacion'>";
             for ($i=0; $i < count($calificaciones); $i++) {
                  echo " <OPTION VALUE='".$calificaciones[$i]."'";
                  if ($calificaciones[$i]==$rs->Value('ca_calificacion')) {
                      echo" SELECTED"; }
                  echo " >".$calificaciones[$i];
                  }
             echo "  </SELECT></TD>";
			 echo "  </TABLE><TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura style='vertical-align: top;'>Coordinador Colmas:</TD>";
             echo "  <TD Class=mostrar COLSPAN=2><SELECT NAME='coordinador'>";  // Llena el cuadro de lista con los valores de la tabla Vendedores
			 echo "<OPTION VALUE=''>Ninguno Asignado</OPTION>";
             $us->MoveFirst();
             while (!$us->Eof()) {
                    echo "<OPTION VALUE='".$us->Value('ca_login')."'";
                    if ($us->Value('ca_login')==$rs->Value('ca_coordinador')) {
                        echo" SELECTED"; }
					echo ">".$us->Value('ca_nombre')."</OPTION>";
                    $us->MoveNext();
                   }
             echo "  </SELECT></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Preferencias:</TD>";
             echo "  <TD Class=mostrar COLSPAN=2><TEXTAREA NAME='preferencias' WRAP=virtual ROWS=5 COLS=65>".$rs->Value('ca_preferencias')."</TEXTAREA></TD>";
             echo "</TR>";
             echo"</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo"<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Actualizar'></TH>";  // Ordena que se actualice el registro
             echo"<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"clientes.php?modalidad=N.i.t.\&criterio=$id\"'></TH>";  // Cancela la operación
             echo"<script>modificar.compania.focus()</script>";
             echo"</TABLE>";
             echo"</FORM>";
             echo"</CENTER>";
//           echo"<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
             require_once("footer.php");
             echo "</BODY>";
             break;
             }
        case 'Libreta': {
             $modulo = "00100300";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
             if (!$rs->Open("select * from tb_clientes where ca_idcliente = ".$id)) {    // Mueve el apuntador al registro que se desea eliminar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'clientes.php';</script>";
                 exit;
                }
             echo "<HEAD>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
             echo "  if (isNaN(parseInt(document.liberacion.diascredito.value)))";
             echo "      alert('El campo No. de Dias debe ser un número mayor o igual a 0');";
             echo "  else if (isNaN(parseInt(document.liberacion.cupo.value)))";
             echo "      alert('El campo Cupo debe ser un número mayor o igual a 0');";
             echo "  else";
             echo "      return (true);";
             echo "  return (false);";
             echo "}";
             echo "</script>";
             echo "</HEAD>";
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='libreta' ACTION='clientes.php' ONSUBMIT='return validar();'>";  // Llena la forma con los datos actuales del registro
             echo "<TABLE CELLSPACING=1 WIDTH=400>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta eliminando
             echo "<TH Class=titulo COLSPAN=3>Libreta de Direcciones del Cliente</TH>";

             $complemento = (($rs->Value('ca_oficina')!='')?" Oficina : ".$rs->Value('ca_oficina'):"").(($rs->Value('ca_torre')!='')?" Torre : ".$rs->Value('ca_torre'):"").(($rs->Value('ca_interior')!='')?" Interior : ".$rs->Value('ca_interior'):"").(($rs->Value('ca_complemento')!='')?" - ".$rs->Value('ca_complemento'):"");
             echo "<TR>";
             echo "  <TD WIDTH=500 Class=mostrar COLSPAN=3 style='font-size: 11px; text-align:left;'><B>N.i.t.: </B>".number_format($rs->Value('ca_idcliente'))."-".$rs->Value('ca_digito')."<BR><B>".$rs->Value('ca_compania')."<BR>Dirección: </B>".str_replace ("|"," ",$rs->Value('ca_direccion')).$complemento. "&nbsp&nbsp<B>Localidad: </B>" . $rs->Value('ca_localidad')."<BR><B>Teléfonos: </B>".$rs->Value('ca_telefonos')."&nbsp&nbsp&nbsp&nbsp<B>Fax: </B>".$rs->Value('ca_fax')."</TD>";
             echo "</TR>";

             echo "<TR>";
             $z=0;
             $emails = explode(",", $rs->Value('ca_confirmar'));
             for ($i=0; $i<4; $i++){
             	echo "  <TR>";
             	for ($j=0; $j<3; $j++) {
             		$cadena = (strlen($emails[$z])==0)?"&nbsp":$emails[$z];
					echo "<TD Class=invertir WIDTH=130><INPUT TYPE='TEXT' NAME='contactos[]' VALUE='".$emails[$z]."' SIZE=40 MAXLENGTH=50></TD>";
             		$z++; }
             	echo "  </TR>";
             }
             echo "</TR>";
             echo "</TABLE>";

			 $cadena = "?modalidad=N.i.t.\&criterio=$id";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Actualizar Libreta'></TH>";     // Envia el formulario para su registro en la base de datos
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"clientes.php$cadena\"'></TH>";  // Cancela la operación
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";   // Link que proporciona la Ayuda en línea
             require_once("footer.php");
             echo "</BODY>";
             break;
             }
        case 'ListaClinton': {
			 set_time_limit(0);
             $modulo = "00100300";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo

			 $query = "select 	cl.ca_idcliente, cl.ca_compania, cl.ca_nombres, cl.ca_papellido, cl.ca_sapellido, cl.ca_vendedor, ciu.ca_ciudad, sdnm.*, sdid.*, sdal.*, sdak.* ";
			 $query.= "		from (select * from tb_clientes where ca_idcliente = $id) cl ";
			 $query.= "		LEFT OUTER JOIN tb_sdn sdnm ";
			 $query.= "		ON ( fun_similarpercent(cl.ca_compania, textcat(case when nullvalue(sdnm.ca_firstname) then '' else sdnm.ca_firstname end, case when nullvalue(sdnm.ca_lastname) then '' else sdnm.ca_lastname end)) >90 ) ";
			 $query.= "		LEFT OUTER JOIN tb_sdnid sdid ";
			 $query.= "		ON ( fun_similarpercent(cl.ca_idcliente::text, sdid.ca_idnumber) >90 ) ";
			 $query.= "		LEFT OUTER JOIN tb_sdnaka sdal ";
			 $query.= "		ON ( fun_similarpercent(cl.ca_compania, textcat(case when nullvalue(sdal.ca_firstname) then '' else sdal.ca_firstname end, case when nullvalue(sdal.ca_lastname) then '' else sdal.ca_lastname end)) >90 ) ";
			 $query.= "		LEFT OUTER JOIN tb_sdnaka sdak ";
			 $query.= "		ON ( fun_similarpercent(cl.ca_nombres||' '||cl.ca_papellido||' '||cl.ca_sapellido, textcat(case when nullvalue(sdak.ca_firstname) then '' else sdak.ca_firstname end, case when nullvalue(sdak.ca_lastname) then '' else sdak.ca_lastname end)) >90 ) ";
			 $query.= "		LEFT OUTER JOIN tb_ciudades ciu ";
			 $query.= "		ON (cl.ca_idciudad = ciu.ca_idciudad) ";
			 $query.= "		where NOT nullvalue(sdnm.ca_uid) or NOT nullvalue(sdid.ca_uid) or NOT nullvalue(sdak.ca_uid) ";
			 $query.= "     order by cl.ca_vendedor, cl.ca_compania";
			 // echo $query;
             if (!$rs->Open($query)) {    // Mueve el apuntador al registro que se desea Consultar en Lista Clinton
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'clientes.php';</script>";
                 exit;
                }
		    $tm =& DlRecordset::NewRecordset($conn);
			if (!$tm->Open("select * from tb_parametros where ca_casouso = 'CU065' and ca_identificacion = 1")) {       // Selecciona todos lo registros de la tabla Traficos
				echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
				echo "<script>document.location.href = 'repcomisiones.php';</script>";
				exit; }
			$tm->MoveFirst();
			$meses = array("enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");
			list($mes, $dia, $anno) = sscanf($tm->Value('ca_valor2'),"%d/%d/%d");

             echo "<HEAD>";
             echo "</HEAD>";
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
			 $tit_mem = array("ca_idcliente","ca_compania","ca_nombres","ca_papellido","ca_sapellido","ca_vendedor", "sdnm_uid","sdnm_firstname","sdnm_lastname","sdnm_title","sdnm_sdntype","sdnm_remarks","sdid_uid_id","sdid_idtype","sdid_idnumber","sdid_idcountry","sdid_issuedate","sdid_expirationdate","sdal_uid_aka","sdal_type","sdal_category","sdal_firstname","sdal_lastname","sdak_uid_aka","sdak_type","sdak_category","sdak_firstname","sdak_lastname");

             echo "<FORM METHOD=post NAME='ListaClinton' ACTION='clientes.php'>";  // Llena la forma con los datos actuales del registro
			 echo "La siguiente es una relación de <b>SIMILITUDES</b>, hayadas entre el cliente consultado y la lista Clinton publicada el ".$dia.' de '.$meses[$mes-1].' de '.$anno.".<br />Tener en cuenta que se compara Número de Nit, Razón Social y Nombre del Representante Legal.<br /><br />";
             echo "<TABLE CELLSPACING=1 WIDTH=400>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta eliminando
             echo "<TH Class=titulo COLSPAN=".count($tit_mem).">Consulta del Cliente en Lista Clinton</TH>";
			 echo "<TR>";
			 for( $i=0; $i<count($tit_mem); $i++ ) {
				  echo "<TH>".$tit_mem[$i]."</TH>";
			 }
			 echo "</TR>";

			 while (!$rs->Eof() and !$rs->IsEmpty()) {
			 	 $record = $rs->FetchArray();
				 echo "<TR>";
				 for( $i=0; $i<count($tit_mem); $i++ ) {
					  echo "<TD Class=listar>".$record[$i]."</TD>";
				 }
				 echo "</TR>";
			 }
			 if ($rs->IsEmpty()){
				 echo "<TR>";
				 echo "  <TD Class=listar COLSPAN=".count($tit_mem).">No hay similitudes encontradas</TD>";
				 echo "</TR>";
			 }
             echo "<TR HEIGHT=4>";
             echo "  <TD Class=titulo COLSPAN=".count($tit_mem)."></TD>";
             echo "</TR>";

             echo "</TABLE>";
			 $cadena = "?modalidad=N.i.t.\&criterio=$id";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"clientes.php$cadena\"'></TH>";  // Cancela la operación
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";   // Link que proporciona la Ayuda en línea
             require_once("footer.php");
             echo "</BODY>";
             break;
             }
        case 'Liberacion': {
             $modulo = "00100300";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
             if (!$rs->Open("select * from vi_clientes where ca_idcliente = ".$id)) {    // Mueve el apuntador al registro que se desea eliminar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'clientes.php';</script>";
                 exit;
                }
             echo "<HEAD>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
             echo "  if (isNaN(parseInt(document.liberacion.diascredito.value)))";
             echo "      alert('El campo No. de Dias debe ser un número mayor o igual a 0');";
             echo "  else if (isNaN(parseInt(document.liberacion.cupo.value)))";
             echo "      alert('El campo Cupo debe ser un número mayor o igual a 0');";
             echo "  else";
             echo "      return (true);";
             echo "  return (false);";
             echo "}";
             echo "</script>";
             echo "</HEAD>";
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='liberacion' ACTION='clientes.php' ONSUBMIT='return validar();'>";  // Llena la forma con los datos actuales del registro
             echo "<TABLE CELLSPACING=1 WIDTH=400>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta eliminando
             echo "<TH Class=titulo COLSPAN=3>Información del Cliente</TH>";
             echo "<TR>";
             echo "  <TD Class=mostrar style='vertical-align: top;' ROWSPAN=5>".number_format($rs->Value('ca_idcliente'))."-".$rs->Value('ca_digito')."</TD>";
             echo "  <TD Class=mostrar COLSPAN=2 style='font-size: 12px; font-weight:bold; text-align:left;'>".$rs->Value('ca_compania')."</TD>";
             echo "</TR>";
             echo "<TR>";
             $complemento = (($rs->Value('ca_oficina')!='')?" Oficina : ".$rs->Value('ca_oficina'):"").(($rs->Value('ca_torre')!='')?" Torre : ".$rs->Value('ca_torre'):"").(($rs->Value('ca_interior')!='')?" Interior : ".$rs->Value('ca_interior'):"").(($rs->Value('ca_complemento')!='')?" - ".$rs->Value('ca_complemento'):"");
             echo "  <TD Class=mostrar COLSPAN=2>&nbsp&nbsp<B>Dirección : </B>".str_replace ("|"," ",$rs->Value('ca_direccion')).$complemento."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=2>&nbsp&nbsp<B>Teléfonos : </B>".$rs->Value('ca_telefonos')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=2>&nbsp&nbsp<B>Fax : </B>".$rs->Value('ca_fax')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=2>&nbsp&nbsp<B>Ciudad : </B>".$rs->Value('ca_ciudad')."</TD>";
             echo "</TR>";
             echo "<TH Class=titulo COLSPAN=3>Datos para la Liberación Automática</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>No. de Días:&nbsp&nbsp&nbsp</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='diascredito' SIZE=5 VALUE='".$rs->Value('ca_diascredito')."' MAXLENGTH=5></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Cupo Asignado:&nbsp&nbsp&nbsp</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='cupo' SIZE=15 VALUE='".$rs->Value('ca_cupo')."' MAXLENGTH=12></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura style='vertical-align: top;'>Observaciones:&nbsp&nbsp&nbsp</TD>";
             echo "  <TD Class=mostrar COLSPAN=2><TEXTAREA NAME='observaciones' WRAP=virtual ROWS=5 COLS=58>".$rs->Value('ca_observaciones')."</TEXTAREA></TD>";
             echo "</TR>";
             echo "</TABLE><BR>";
             $cadena = "?modalidad=N.i.t.\&criterio=$id";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Aprobar Lib.Automática'></TH>";     // Ordena eliminar el registro de forma permanente
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Eliminar Aprobación'></TH>";     // Ordena eliminar el registro de forma permanente
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"clientes.php$cadena\"'></TH>";  // Cancela la operación
             echo "<script>liberacion.diascredito.focus()</script>";
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";   // Link que proporciona la Ayuda en línea
             require_once("footer.php");
             echo "</BODY>";
             break;
             }
        case 'Contrato': {
             $modulo = "00100300";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
             if (!$rs->Open("select * from vi_clientes where ca_idcliente = ".$id)) {    // Mueve el apuntador al registro que se desea eliminar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'clientes.php';</script>";
                 exit;
                }
             $tm =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
             if (!$tm->Open("select oid as ca_oid, * from tb_comcliente where ca_idcliente = ".$id." and ca_usuanulado is null order by ca_fchfirmado DESC")) {    // Mueve el apuntador al registro que se desea eliminar
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'clientes.php';</script>";
                 exit;
                }
             echo "<HEAD>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
             echo "  if (document.contrato.fchfirmado.value >= document.contrato.fchvencimiento.value){";
             echo "      document.contrato.fchfirmado.focus();";
             echo "      alert('Error en la Definición de la Vigencia');}";
             echo "  else";
             echo "      return (true);";
             echo "  return (false);";
             echo "}";
             echo "function anular_vigencia(element){";
			 echo "  if (confirm(\"¿Esta seguro que desea Anular la Vigencia?\")) {";
             echo "  	document.location.href = 'clientes.php?accion=anular_vig\&id=$id\&oid='+element.name;";
             echo "  }";
             echo "}";
             echo "</script>";
             echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
             echo "</HEAD>";
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='contrato' ACTION='clientes.php' ONSUBMIT='return validar();'>";  // Llena la forma con los datos actuales del registro
             echo "<TABLE CELLSPACING=1 WIDTH=400>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta eliminando
             echo "<TH Class=titulo COLSPAN=4>Información del Cliente</TH>";
             echo "<TR>";
             echo "  <TD Class=mostrar style='vertical-align: top;' ROWSPAN=5>".number_format($rs->Value('ca_idcliente'))."-".$rs->Value('ca_digito')."</TD>";
             echo "  <TD Class=mostrar COLSPAN=3 style='font-size: 12px; font-weight:bold; text-align:left;'>".$rs->Value('ca_compania')."</TD>";
             echo "</TR>";
             echo "<TR>";
             $complemento = (($rs->Value('ca_oficina')!='')?" Oficina : ".$rs->Value('ca_oficina'):"").(($rs->Value('ca_torre')!='')?" Torre : ".$rs->Value('ca_torre'):"").(($rs->Value('ca_interior')!='')?" Interior : ".$rs->Value('ca_interior'):"").(($rs->Value('ca_complemento')!='')?" - ".$rs->Value('ca_complemento'):"");
             echo "  <TD Class=mostrar COLSPAN=3>&nbsp&nbsp<B>Dirección : </B>".str_replace ("|"," ",$rs->Value('ca_direccion')).$complemento."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=3>&nbsp&nbsp<B>Teléfonos : </B>".$rs->Value('ca_telefonos')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=3>&nbsp&nbsp<B>Fax : </B>".$rs->Value('ca_fax')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=3>&nbsp&nbsp<B>Ciudad : </B>".$rs->Value('ca_ciudad')."</TD>";
             echo "</TR>";
             echo "<TH Class=titulo COLSPAN=4>Histórico de Vigencias Firmadas</TH>";
             echo "<TR>";
             echo "  <TD Class=invertir>Fecha Firma</TD>";
             echo "  <TD Class=invertir>Fecha Vencimiento</TD>";
             echo "  <TD Class=invertir COLSPAN=2>Registro</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='fchfirmado' SIZE=12 VALUE='".date("Y-m-d")."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='fchvencimiento' SIZE=12 VALUE='".date("Y-m-d")."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
             echo "  <TD Class=mostrar COLSPAN=2></TD>";
             echo "</TR>";
             while (!$tm->Eof() and !$tm->IsEmpty()) {
                 echo "<TR>";
                 echo "  <TD Class=mostrar>".$tm->Value('ca_fchfirmado')."</TD>";
                 echo "  <TD Class=mostrar>".$tm->Value('ca_fchvencimiento')."</TD>";
                 echo "  <TD Class=mostrar>".$tm->Value('ca_fchcreado')."<BR>".$tm->Value('ca_usucreado')."</TD>";
                 echo "  <TD Class=mostrar><IMG NAME='".$tm->Value('ca_oid')."' src='graficos/no.gif' alt='Anular la Vigencia de la Carta' ONCLICK='anular_vigencia(this);'></TD>";
                 echo "</TR>";
                 $tm->MoveNext();
             }
             echo "</TABLE><BR>";
             $cadena = "?modalidad=N.i.t.\&criterio=$id";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Nueva Vigencia'></TH>";     // Ordena eliminar el registro de forma permanente
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"clientes.php$cadena\"'></TH>";  // Cancela la operación
             echo "<script>contrato.fchfirmado.focus()</script>";
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";   // Link que proporciona la Ayuda en línea
             require_once("footer.php");
             echo "</BODY>";
             break;
             }
        case 'Comisión': {
             $modulo = "00100300";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
             if (!$rs->Open("select * from vi_clientes where ca_idcliente = ".$id)) {    // Mueve el apuntador al registro que se desea eliminar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'clientes.php';</script>";
                 exit;
                }
             $tm =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
             if (!$tm->Open("select * from tb_porcentajescomisiones where ca_idcliente = ".$id." order by ca_inicio, ca_fin DESC")) {    // Mueve el apuntador al registro que se desea eliminar
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'clientes.php';</script>";
                 exit;
                }
             echo "<HEAD>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
             echo "  if (document.comision.inicio.value >= document.comision.fin.value){";
             echo "      document.comision.inicio.focus();";
             echo "      alert('Error en la Definición de la Vigencia');}";
             echo "  else if (isNaN(parseInt(document.comision.porcentaje.value)))";
             echo "      alert('El campo Porcentaje debe ser un número mayor o igual a 0');";
             echo "  else";
             echo "      return (true);";
             echo "  return (false);";
             echo "}";
             echo "</script>";
             echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
             echo "</HEAD>";
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='comision' ACTION='clientes.php' ONSUBMIT='return validar();'>";  // Llena la forma con los datos actuales del registro
             echo "<TABLE CELLSPACING=1 WIDTH=400>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta eliminando
             echo "<TH Class=titulo COLSPAN=4>Información del Cliente</TH>";
             echo "<TR>";
             echo "  <TD Class=mostrar style='vertical-align: top;' ROWSPAN=5>".number_format($rs->Value('ca_idcliente'))."-".$rs->Value('ca_digito')."</TD>";
             echo "  <TD Class=mostrar COLSPAN=3 style='font-size: 12px; font-weight:bold; text-align:left;'>".$rs->Value('ca_compania')."</TD>";
             echo "</TR>";
             echo "<TR>";
             $complemento = (($rs->Value('ca_oficina')!='')?" Oficina : ".$rs->Value('ca_oficina'):"").(($rs->Value('ca_torre')!='')?" Torre : ".$rs->Value('ca_torre'):"").(($rs->Value('ca_interior')!='')?" Interior : ".$rs->Value('ca_interior'):"").(($rs->Value('ca_complemento')!='')?" - ".$rs->Value('ca_complemento'):"");
             echo "  <TD Class=mostrar COLSPAN=3>&nbsp&nbsp<B>Dirección : </B>".str_replace ("|"," ",$rs->Value('ca_direccion')).$complemento."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=3>&nbsp&nbsp<B>Teléfonos : </B>".$rs->Value('ca_telefonos')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=3>&nbsp&nbsp<B>Fax : </B>".$rs->Value('ca_fax')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=3>&nbsp&nbsp<B>Ciudad : </B>".$rs->Value('ca_ciudad')."</TD>";
             echo "</TR>";
             echo "<TH Class=titulo COLSPAN=4>Histórico de Porcentajes de Comisión</TH>";
             echo "<TR>";
             echo "  <TD Class=invertir>Inicio</TD>";
             echo "  <TD Class=invertir>Fin</TD>";
			 echo "  <TD Class=invertir>Porcentaje</TD>";
             echo "  <TD Class=invertir>Registro</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='inicio' SIZE=12 VALUE='".date("Y-m-d")."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='fin' SIZE=12 VALUE='".date("Y-m-d")."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='porcentaje' SIZE=3 MAXLENGTH=2>%</TD>";
             echo "  <TD Class=mostrar></TD>";
             echo "</TR>";
             while (!$tm->Eof() and !$tm->IsEmpty()) {
                 echo "<TR>";
                 echo "  <TD Class=mostrar>".$tm->Value('ca_inicio')."</TD>";
                 echo "  <TD Class=mostrar>".$tm->Value('ca_fin')."</TD>";
				 echo "  <TD Class=mostrar>".$tm->Value('ca_porcentaje')."</TD>";
                 echo "  <TD Class=mostrar>".$tm->Value('ca_fchcreado')."<BR>".$tm->Value('ca_usucreado')."</TD>";
                 echo "</TR>";
                 $tm->MoveNext();
             }
             echo "</TABLE><BR>";
             $cadena = "?modalidad=N.i.t.\&criterio=$id";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Registrar Porcentaje'></TH>";     // Ordena eliminar el registro de forma permanente
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"clientes.php$cadena\"'></TH>";  // Cancela la operación
             echo "<script>comision.inicio.focus()</script>";
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";   // Link que proporciona la Ayuda en línea
             require_once("footer.php");
             echo "</BODY>";
             break;
             }
        case 'Eliminar': {
             $modulo = "00100300";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
             if (!$rs->Open("select * from vi_clientes where ca_idcliente = ".$id)) {    // Mueve el apuntador al registro que se desea eliminar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'clientes.php';</script>";
                 exit;
                }
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='eliminar' ACTION='clientes.php'>";  // Llena la forma con los datos actuales del registro
             echo "<TABLE CELLSPACING=1 WIDTH=400>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta eliminando
             echo "<TH Class=titulo COLSPAN=2>Datos del Cliente a Eliminar</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Identificación:</TD>";
             echo "  <TD Class=mostrar WIDTH=270>".$rs->Value('ca_idcliente')." - ".$rs->Value('ca_digito')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Compañia:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_compania')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Saludo:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_saludo')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Representante:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_ncompleto')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Dirección:</TD>";
             $complemento = (($rs->Value('ca_oficina')!='')?" Oficina : ".$rs->Value('ca_oficina'):"").(($rs->Value('ca_torre')!='')?" Torre : ".$rs->Value('ca_torre'):"").(($rs->Value('ca_interior')!='')?" Interior : ".$rs->Value('ca_interior'):"").(($rs->Value('ca_complemento')!='')?" - ".$rs->Value('ca_complemento'):"");
             echo "  <TD Class=mostrar>".str_replace ("|"," ",$rs->Value('ca_direccion')).$complemento."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Teléfonos:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_telefonos')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Fax:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_fax')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Ciudad:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_ciudad')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Página Web:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_website')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Correo Electrónico:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_email')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Actividad Económica:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_actividad')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Sector Económico:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_sectoreco')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Circular 170:</TD>";
			 echo "  <TD Class=invertir COLSPAN=2><TABLE CELLSPACING=1 WIDTH=100%><TR>";
             echo "  <TD Class=mostrar>Diligenciado: (aaaa/mm/dd)<BR /><CENTER>".$rs->Value('ca_fchcircular')."</CENTER></TD>";
             echo "  <TD Class=mostrar>Nivel de Riesgo:<BR /><CENTER>".$rs->Value('ca_nvlriesgo')."</CENTER></TD>";
			 echo "  </TABLE><TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Ley Insolvencia Eco.:</TD>";
			 echo "  <TD Class=invertir COLSPAN=2><TABLE CELLSPACING=1 WIDTH=100%><TR>";
             echo "  <TD Class=mostrar>Reportado en Ley Insolvencia Eco.:<BR /><CENTER>".$rs->Value('ca_leyinsolvencia')."</CENTER></TD>";
			 echo "  <TD Class=mostrar>Comentario:<BR /><CENTER>".$rs->Value('ca_comentario')."</CENTER></TD>";
			 echo "  </TABLE><TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Contrato/Agenciamiento:</TD>";
			 echo "  <TD Class=invertir COLSPAN=2><TABLE CELLSPACING=1 WIDTH=100%><TR>";
             echo "  <TD Class=mostrar>Último Radicado: (aaaa/mm/dd)<BR /><CENTER>".$rs->Value('ca_fchcotratoag')."</CENTER></TD>";
             echo "  <TD Class=mostrar>Reportado en Lista Clinton:<BR /><CENTER>".$rs->Value('ca_listaclinton')."</CENTER></TD>";
			 echo "  </TABLE><TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Status:</TD>";
			 echo "  <TD Class=invertir COLSPAN=2><TABLE CELLSPACING=1 WIDTH=100%><TR>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_status')."</TD>";
             echo "  <TD Class=mostrar>Calificación :".$rs->Value('ca_calificacion')."</TD>";
			 echo "  </TABLE><TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Coord. Colmas:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_coordinador')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Preferencias:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_preferencias')."</TD>";
             echo "</TR>";
             echo "</TABLE><BR>";
             $cadena = "?modalidad=N.i.t.\&criterio=$id";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Eliminar'></TH>";     // Ordena eliminar el registro de forma permanente
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"clientes.php$cadena\"'></TH>";  // Cancela la operación
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";   // Link que proporciona la Ayuda en línea
             require_once("footer.php");
             echo "</BODY>";
             break;
             }
      }
   }
elseif (isset($accion)) {                                                      // Rutina que registra los cambios en la tabla de la base de datos
    switch(trim($accion)) {                                                    // Switch que evalua cual botòn de comando fue pulsado por el usuario
        case 'Nueva Vigencia': {                                               // El Botón Guardar fue pulsado
             if (!$rs->Open("insert into tb_comcliente (ca_idcliente, ca_fchfirmado, ca_fchvencimiento, ca_fchcreado, ca_usucreado) values($id, '$fchfirmado', '$fchvencimiento', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$usuario')")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'clientes.php';</script>";
                 exit;
                }
             break;
             }
        case 'Registrar Porcentaje': {                                               // El Botón Guardar fue pulsado
			 list($ano, $mes, $dia) = sscanf($inicio, "%d-%d-%d");
			 $inicio = date("Y-m-d", mktime(0, 0, 0, $mes, 1, $ano));
			 list($ano, $mes, $dia) = sscanf($fin, "%d-%d-%d");
			 $fin = date("Y-m-d", mktime(0, 0, 0, $mes+1, 0, $ano));
             if (!$rs->Open("insert into tb_porcentajescomisiones (ca_idcliente, ca_inicio, ca_fin, ca_porcentaje, ca_fchcreado, ca_usucreado) values($id, '$inicio', '$fin', $porcentaje, to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$usuario')")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'clientes.php';</script>";
                 exit;
                }
             break;
             }
        case 'Actualizar Libreta': {                                               // El Botón Guardar fue pulsado
			 include_once 'include/functions.php';
			 $contactos = (isset($contactos))?implode(",",array_filter($contactos, "vacios")):"";           // Retira las posiciones en blanco del arreglo
             if (!$rs->Open("update tb_clientes set ca_confirmar = '$contactos', ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), ca_usuactualizado = '$usuario' where ca_idcliente = $id")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'clientes.php';</script>";
                 exit;
                }
             break;
             }
        case 'Aprobar Lib.Automática': {                                        // El Botón Guardar fue pulsado
             if (!$rs->Open("select ca_idcliente from tb_libcliente where ca_idcliente = $id")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'clientes.php';</script>";
                 exit;
                }
             if ($rs->GetRowCount() == 0){
                 if (!$rs->Open("insert into tb_libcliente (ca_idcliente, ca_diascredito, ca_cupo, ca_observaciones, ca_fchcreado, ca_usucreado) values($id, $diascredito, $cupo, '".addslashes($observaciones)."', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$usuario')")) {
                     echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                     echo "<script>document.location.href = 'clientes.php';</script>";
                     exit;
                    }
             }else{
                 if (!$rs->Open("update tb_libcliente set ca_diascredito = $diascredito, ca_cupo = $cupo, ca_observaciones = '".addslashes($observaciones)."', ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), ca_usuactualizado = '$usuario' where ca_idcliente = $id")) {
                     echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                     echo "<script>document.location.href = 'clientes.php';</script>";
                     exit;
                    }
             }
             break;
             }
        case 'Eliminar Aprobación': {                                           // El Botón Guardar fue pulsado
             if (!$rs->Open("delete from tb_libcliente where ca_idcliente = $id")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'clientes.php';</script>";
                 exit;
                }
             break;
             }
        case 'Registrar': {                                                      // El Botón Guardar fue pulsado
             if (!$rs->Open("insert into tb_evecliente (ca_idcliente, ca_fchevento, ca_tipo, ca_asunto, ca_detalle, ca_compromisos, ca_fchcompromiso, ca_idantecedente, ca_usuario) values($id, to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$tipo', '".addslashes($asunto)."', '".addslashes($detalle)."', '".addslashes($compromisos)."', '$fchcompromiso', '$idantecedente', '$usuario')")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'clientes.php';</script>";
                 exit;
                }
             break;
             }
        case 'Guardar': {                                                      // El Botón Guardar fue pulsado
             $compania = addslashes($compania);
             $papellido = addslashes($papellido);
             $sapellido = addslashes($sapellido);
             $nombres = addslashes($nombres);
             $direccion = isset($direccion)?implode("|",$direccion):"";
             $vendedor = ($nivel > 2)?"":$usuario;
			 $fchcircular = (strlen($fchcircular)!=0)?"'".$fchcircular."'":'date(null)';
			 $fchcotratoag = (strlen($fchcotratoag)!=0)?"'".$fchcotratoag."'":'date(null)';
			 $status = ($listaclinton=='Sí')?"Vetado":$status;
             if (!$rs->Open("insert into tb_clientes (ca_idcliente, ca_digito, ca_compania, ca_papellido, ca_sapellido, ca_nombres, ca_saludo, ca_sexo, ca_cumpleanos, ca_direccion, ca_oficina, ca_torre, ca_bloque, ca_interior, ca_localidad, ca_complemento, ca_telefonos, ca_fax, ca_idciudad, ca_website, ca_email, ca_actividad, ca_sectoreco, ca_vendedor, ca_fchcircular, ca_nvlriesgo, ca_fchcotratoag, ca_listaclinton, ca_leyinsolvencia, ca_comentario, ca_status, ca_calificacion, ca_coordinador, ca_preferencias, ca_idgrupo, ca_fchcreado, ca_usucreado) values($id, $digito, upper('".addslashes($compania)."'), '$papellido', '$sapellido', '$nombres', '$saludo', '$sexo', '$cumpleanos', '$direccion', '$oficina', '$torre', '$bloque', '$interior', '$localidad', '$complemento', '$telefonos', '$fax', '$idciudad', lower('$website'), lower('$email'), '$actividad', '$sectoreco', '$vendedor', $fchcircular, '$nvlriesgo', $fchcotratoag, '$listaclinton', '$leyinsolvencia', '$comentario', '$status', '$calificacion', '$coordinador', '$preferencias', $id, to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$usuario')")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'clientes.php';</script>";
                 exit;
                }
             break;
             }
        case 'Actualizar': {                                                   // El Botón Actualizar fue pulsado
             $compania = addslashes($compania);
             $papellido = addslashes($papellido);
             $sapellido = addslashes($sapellido);
             $nombres = addslashes($nombres);
             $direccion = isset($direccion)?implode("|",$direccion):"";
             $vendedor = ($nivel > 2)?$vendedor:$usuario;
			 $fchcircular = (strlen($fchcircular)!=0)?"'".$fchcircular."'":'date(null)';
			 $fchcotratoag= (strlen($fchcotratoag)!=0)?"'".$fchcotratoag."'":'date(null)';
			 $status = ($listaclinton=='Sí')?"Vetado":$status;
             if (!$rs->Open("update tb_clientes set ca_compania = upper('".addslashes($compania)."'), ca_papellido = '$papellido', ca_sapellido = '$sapellido', ca_nombres = '$nombres', ca_saludo = '$saludo', ca_sexo = '$sexo', ca_cumpleanos = '$cumpleanos', ca_direccion = '$direccion', ca_oficina = '$oficina', ca_torre = '$torre', ca_bloque = '$bloque', ca_interior = '$interior', ca_localidad = '$localidad', ca_complemento = '$complemento', ca_telefonos = '$telefonos', ca_fax = '$fax', ca_idciudad  ='$idciudad', ca_website = lower('$website'), ca_email = lower('$email'), ca_actividad = '$actividad', ca_sectoreco = '$sectoreco', ca_vendedor = '$vendedor', ca_fchcircular = $fchcircular, ca_nvlriesgo = '$nvlriesgo', ca_fchcotratoag = $fchcotratoag, ca_listaclinton = '$listaclinton', ca_leyinsolvencia = '$leyinsolvencia', ca_comentario = '$comentario', ca_status = '$status', ca_calificacion = '$calificacion', ca_preferencias = '$preferencias', ca_coordinador = '$coordinador', ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), ca_usuactualizado = '$usuario' where ca_idcliente = $id")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'clientes.php';</script>";
                 exit;
                }
             break;
             }
        case 'Liberar': {                                                   // El Botón Actualizar fue pulsado
             if (!$rs->Open("update tb_clientes set ca_vendedor = null, ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), ca_usuactualizado = '$usuario' where ca_idcliente = $id")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'clientes.php';</script>";
                 exit;
                }
             break;
             }
        case 'Eliminar': {                                                     // El Botón Eliminar fue pulsado
             if (!$rs->Open("delete from tb_clientes where ca_idcliente = $id")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'clientes.php';</script>";
                 exit;
                }
             break;
             }
        case 'anular_vig': {                                                     // Anula una Vigencia de Carta de Garantía de un Cliente
             if (!$rs->Open("update tb_comcliente set ca_usuanulado = '$usuario', ca_fchanulado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss') where oid = $oid")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'clientes.php';</script>";
                 exit;
                }
             break;
             }
        }
   $cadena = "";
   if(isset($id) and $accion == 'anular_vig') {
      $cadena = "?boton=Contrato\&id=$id";
   } else if(isset($id) and $accion != 'Eliminar'){
      $cadena = "?modalidad=N.i.t.\&criterio=$id";
   }
   echo "<script>document.location.href = 'clientes.php$cadena';</script>";  // Retorna a la pantalla principal de la opción
 }
?>