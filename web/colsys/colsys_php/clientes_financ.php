<?
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       CLIENTES_FINANC.PHP                                                \\
// Creado:        2008-11-24                                                  \\
// Autor:         Carlos Gilberto López M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2008-11-24                                                 \\
//                                                                            \\
// Descripción:   Mantenimiento de Clientes desde Dpto Financiero      \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/
$programa = 31;

$titulo = 'Maestra de Clientes Colsys';
$riesgos = array("","Mínimo","Medio","Alto");
$campos = array("Nombre del Cliente" => "ca_compania", "Representante Legal" => "ca_ncompleto", "N.i.t." => "ca_idalterno", "Calificación" => "ca_calificacion", "Coordinador Aduana" => "ca_coordinador", "Actividad Económica" => "ca_actividad", "Sector Económico" => "ca_sector", "Localidad" => "ca_localidad", "Ciudad" => "ca_ciudad", "Circular 170" => "ca_stdcircular", "Contrato Agenciamiento" => "ca_stdcotratoag", "Nivel Riesgo" => "ca_nvlriesgo", "Lista OFAC" => "ca_listaclinton", "SuperSociedades" => "ca_leyinsolvencia");  // Arreglo con las opciones de busqueda
$bdatos = array("Mestra Clientes", "Mis Clientes", "Clientes Libres");  // Arreglo con los lugares donde buscar
$estados = array("Potencial","Activo","Vetado");
$empresas= array("Coltrans","Colmas");
$circular=array("Sin","Vencido","Vigente");
$tiposnits=array("","Agente","Proveedor","Excepción Temporal","Excepción Permanente");
$operaciones=array("I" => "Nuevo Registro", "U" => "Actualización", "D" => "Borrado");

include_once 'include/datalib.php';                                                // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                     // Captura las variables de la sessión abierta


$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!isset($criterio) and !isset($boton) and !isset($accion)){
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function elegir(opcion, id){";
    echo "    document.location.href = 'clientes_financ.php?boton='+opcion+'\&id='+id;";
    echo "}";
    echo "</script>";
    ?>
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <?php
    echo "</HEAD>";
    echo "<BODY>";
require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<H3>$titulo</H3>";
    echo "<FORM METHOD=post NAME='menuform' ACTION='clientes_financ.php' >";
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
    echo "  <TH ROWSPAN=4><INPUT Class=submit TYPE='SUBMIT' NAME='buscar' VALUE='  Buscar  ' ONCLIK='menuform.submit();'></TH>";
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
    echo "  <TD Class=listar><B>Tipo de Nit:</B><BR><SELECT NAME='tiponit'>";
    $che_mem = "SELECTED";
    for ($i=0; $i < count($tiposnits); $i++) {
         echo " <OPTION VALUE='".$tiposnits[$i]."' $che_mem>".$tiposnits[$i];
		 $che_mem = "";
        }
    echo "  </SELECT>";
    echo "  </TD>";
    echo "</TR>";

    echo "<TR>";
    echo "  <TD Class=mostrar COLSPAN=2><B>Vendedor:</B><BR><SELECT NAME='login'>";                 // Llena el cuadro de lista con los valores de la tabla Vendedores
    echo "  <OPTION VALUE=%>Vendedores (Todos)</OPTION>";
    while (!$us->Eof()) {
           echo"<OPTION VALUE=".$us->Value('ca_login').">".$us->Value('ca_nombre')."</OPTION>";
           $us->MoveNext();
          }
    echo "  </SELECT></TD>";
    echo "</TR>";

    echo "<TR>";
    echo "  <TD Class=listar COLSPAN=3><TABLE WIDTH=100% BORDER=0 CELLSPACING=0>";
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
		 $che_mem = "";
        }
	echo "		</TD>";

	echo "  	<TD Class=listar><B>Circular 170:</B>";
    for ($i=0; $i < count($circular); $i++) {
         echo "<BR /><INPUT TYPE='CHECKBOX' NAME='circular_std[]' VALUE='".$circular[$i]."' $che_mem>".$circular[$i];
		 $che_mem = "";
        }
	echo "		</TD>";

	echo "  	<TD Class=listar>";
	echo "          <B>Lista OFAC:</B>";
	echo "          <BR /><INPUT TYPE='CHECKBOX' NAME='listaclinton' VALUE='Sí'>Sí";
	echo "          <BR /><B>SuperSociedades:</B>";
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
    echo "</FORM>";
    echo "</CENTER>";
    require_once("footer.php");
echo "</BODY>";
    echo "</HTML>";
    }
elseif (!isset($boton) and !isset($accion) and isset($criterio)){
    set_time_limit(360);
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
    if (isset($criterio) and !isset($condicion)) {
		if ($modalidad != "N.i.t." ){
		    $condicion = "where lower($campos[$modalidad]) like lower('%".$criterio."%')";
		}else{
		    $condicion = "where $campos[$modalidad] = '".$criterio."'";
		}
	}
    if ($buscaren == 'Mis Clientes') {
        $condicion.= " and ca_vendedor = '".$usuario."'"; }
    else if ($buscaren == 'Clientes Libres') {
        $condicion.= " and ca_vendedor = ''"; }
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
        if ($tiponit != ""){
            $condicion.= " and ca_tipo like '%$tiponit%'";
        }
	if (!$rs->Open("select * from vi_clientes $condicion")) {                  // Selecciona todos lo registros de la tabla Trasportistas
		echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
		echo "<script>document.location.href = 'entrada.php';</script>";
		exit; }
	$registros = (!$rs->IsEmpty())?"ca_idcliente = ".$rs->Value('ca_idcliente'):"false";
	$cn =& DlRecordset::NewRecordset($conn);
	$tm =& DlRecordset::NewRecordset($conn);

	echo "<HTML>";
	echo "<HEAD>";
	echo "<TITLE>Tabla de Clientes ".COLTRANS."</TITLE>";
	echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
	echo "function elegir(opcion, id){";
	echo "    document.location.href = 'clientes_financ.php?boton='+opcion+'\&id='+id;";
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
	echo $cajaprueba;
	echo "<FORM METHOD=post NAME='cabecera' ACTION='clientes_financ.php'>";            // Hace una llamado nuevamente a este script pero con
	echo "<TABLE WIDTH=600 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
	echo "<INPUT TYPE='HIDDEN' NAME='accion'>";                                // Hereda el Id del registro que se esta modificando
	echo "<INPUT TYPE='HIDDEN' NAME='id'>";                                    // Hereda el Id del registro que se esta modificando
	echo "<TR>";
	echo "  <TH Class=titulo COLSPAN=6>$titulo</TH>";
	echo "</TR>";
	echo "<TH>ID</TH>";
	echo "<TH COLSPAN=5>Nombre de Cliente</TH>";
	while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
	   $vetado = ($rs->Value('ca_coltrans_std')=='Vetado' or $rs->Value('ca_colmas_std')=='Vetado' )?'background-color:#FFb2b2;':'';
	   if (!$cn->Open("select * from vi_concliente where ca_idcliente = ".$rs->Value('ca_idcliente')." and ca_idcontacto != 0")) {          // Selecciona todos lo registros de la tabla Contacos de Clientes
                echo "<script>alert(\"".addslashes($cn->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                echo "<script>document.location.href = 'clientes_financ.php';</script>";
                exit; }
	   echo "<TR>";
           echo "<TD Class=titulo style='vertical-align: top;'>".number_format($rs->Value('ca_idalterno')?$rs->Value('ca_idalterno'):$rs->Value('ca_idcliente')).($rs->Value('ca_digito')?"-".$rs->Value('ca_digito'):"")."</TD>";
	   echo "<TD Class=titulo COLSPAN=5 style='font-size: 12px; font-weight:bold; text-align:left;'>".$rs->Value('ca_compania')."</TD>";
	   echo "</TR>";

	   echo "<TR>";
	   echo "<TD Class=invertir COLSPAN=6>";
	   echo "  <TABLE WIDTH=100% CELLSPACING=1>";
	   echo "  <TR>";
	   echo "    <TD Class=invertir style='font-weight:bold; font-size: 9px; text-align: center; $vetado'>Contactos</TD>";
	   echo "    <TD Class=invertir style='font-weight:bold; font-size: 9px; text-align: center; $vetado'>Cargo</TD>";
	   echo "    <TD Class=invertir style='font-weight:bold; font-size: 9px; text-align: center; $vetado'>Teléfonos</TD>";
	   echo "    <TD Class=invertir style='font-weight:bold; font-size: 9px; text-align: center; $vetado'>Correo Elec.</TD>";
	   echo "  </TR>";
	   if (!$cn->IsEmpty()) {
               $cn->MoveFirst();
               while (!$cn->Eof() and !$cn->IsEmpty()) {
                    echo "<TR>";
                    echo "  <TD Class=mostrar style='font-size: 9px; $vetado'>".$cn->Value('ca_ncompleto_cn')."</TD>";
                    echo "  <TD Class=mostrar style='font-size: 9px; $vetado'>".$cn->Value('ca_cargo')."</TD>";
                    echo "  <TD Class=mostrar style='font-size: 9px; $vetado'>".$cn->Value('ca_telefonos')."</TD>";
                    echo "  <TD Class=mostrar style='font-size: 9px; $vetado'>".$cn->Value('ca_email')."</TD>";
                    echo "</TR>";
                    $cn->MoveNext();
               }
	   }else {
               echo "<TR>";
               echo "  <TD Class=mostrar style='font-weight:bold; font-size: 9px; $vetado' COLSPAN=4>El Cliente no tiene Contactos registrados</TD>";
               echo "</TR>";
	   }
	   echo "  <TR>";
	   echo "    <TD Class=mostrar style='font-size: 9px; $vetado'>".$rs->Value('ca_ncompleto')."</TD>";
	   echo "    <TD Class=mostrar style='font-size: 9px; $vetado'>Representante Legal</TD>";
	   echo "    <TD Class=mostrar style='font-size: 9px; $vetado'>".$rs->Value('ca_telefonos')."</TD>";
	   echo "    <TD Class=mostrar style='font-size: 9px; $vetado'>".$rs->Value('ca_email')."</TD>";
	   echo "  </TR>";
	   echo "  </TABLE>";
	   echo "</TD>";
	   echo "</TR>";

	   $complemento = (($rs->Value('ca_oficina')!='')?" Oficina : ".$rs->Value('ca_oficina'):"").(($rs->Value('ca_torre')!='')?" Torre : ".$rs->Value('ca_torre'):"").(($rs->Value('ca_interior')!='')?" Interior : ".$rs->Value('ca_interior'):"").(($rs->Value('ca_complemento')!='')?" - ".$rs->Value('ca_complemento'):"");
	   echo "<TR>";
	   echo "  <TD Class=listar ROWSPAN=9 style='text-align: center; $vetado'></TD>";
	   echo "  <TD Class=mostrar style='$vetado'>Dirección :</TD>";
	   echo "  <TD Class=listar style='$vetado' COLSPAN=3>".str_replace ("|"," ",$rs->Value('ca_direccion')).$complemento."</TD>";
	   echo "  <TD Class=listar style='$vetado' ROWSPAN=9 style='text-align: center;'>";
	   echo "    <TABLE>";
	   echo "      <TR><TD Class=mostrar style='text-align: center;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='elegir(\"Control Financiero\", ".$rs->Value('ca_idcliente').");' style='color=blue;'><BR><IMG src='graficos/vista.gif'><BR>Control Financiero</TD></TR>";
           echo "      <TR><TD Class=mostrar style='text-align: center;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='javascript:document.location.href = \"/clientes/controlFinancieroExt4/idcliente/" . $rs->Value('ca_idcliente') . "\"'><BR><IMG src='graficos/encuesta.gif'><BR>Nuevo Control<br />Financiero</TD></TR>";
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
	   echo "  <TD Class=listar style='$vetado' rowspan=3>Sector :</TD>";
	   echo "  <TD Class=listar style='$vetado' rowspan=3>".$rs->Value('ca_sectoreco')."</TD>";
	   echo "  <TD Class=listar style='$vetado'>Vendedor :</TD>";
	   echo "  <TD Class=listar style='$vetado'>".$rs->Value('ca_vendedor')."<BR>".$rs->Value('ca_sucursal')."</TD>";
	   echo "</TR>";
	   echo "<TR>";
	   echo "  <TD Class=mostrar style='$vetado'>Coord. Colmas:</TD>";
	   echo "  <TD Class=mostrar style='$vetado'>".$rs->Value('ca_coordinador')."</TD>";
	   echo "</TR>";
	   echo "<TR>";
	   echo "  <TD Class=mostrar style='$vetado'>Tipo NIT:</TD>";
	   echo "  <TD Class=mostrar style='$vetado'>".str_replace("|","<br>",$rs->Value('ca_tipo'))."</TD>";
	   echo "</TR>";

	   echo "<TR>";
	   echo "  <TD Class=invertir COLSPAN=4><TABLE WIDTH=100% CELLSPACING=1 BORDER=1>";
	   echo "  <TR>";
	   echo "    <TD Class=listar style='$vetado'>Circular 170:<BR /><CENTER>".$rs->Value('ca_fchcircular')."</CENTER></TD>";
	   echo "    <TD Class=listar style='$vetado'>Estado Circular:<BR /><CENTER>".$rs->Value('ca_stdcircular')."</CENTER></TD>";
	   echo "    <TD Class=listar style='$vetado'>Nivel Riesgo:<BR /><CENTER>".$rs->Value('ca_nvlriesgo')."</CENTER></TD>";
	   echo "    <TD Class=listar style='$vetado'>Lista OFAC:<BR /><CENTER>".$rs->Value('ca_listaclinton')."</CENTER></TD>";
	   echo "  </TR>";
	   echo "  <TR>";
	   echo "    <TD Class=listar style='$vetado'>Contrato Agenc.:<BR /><CENTER>".$rs->Value('ca_fchcotratoag')."</CENTER></TD>";
	   echo "    <TD Class=listar style='$vetado'>Estado Contrato:<BR /><CENTER>".$rs->Value('ca_stdcotratoag')."</CENTER></TD>";
	   echo "    <TD Class=listar style='$vetado'>SuperSociedades:<BR /><CENTER>".$rs->Value('ca_leyinsolvencia')."</CENTER></TD>";
	   echo "    <TD Class=listar style='$vetado'>Comentario:<BR /><CENTER>".$rs->Value('ca_comentario')."</CENTER></TD>";
	   echo "  </TR>";
            echo " <TR>";
            echo "   <TD Class=listar style='$vetado'>Certificaci&oacute;n ISO:<BR /><CENTER>" . $rs->Value('ca_iso') . " " . $rs->Value('ca_iso_detalles') . "</CENTER></TD>";
            echo "   <TD Class=listar style='$vetado'>Certificaci&oacute;n BASC:<BR /><CENTER>" . $rs->Value('ca_basc') . "</CENTER></TD>";
            echo "   <TD Class=listar style='$vetado'>Otra Certificaci&oacute;n:<BR /><CENTER>" . $rs->Value('ca_otro_cert') . "</CENTER></TD>";
            echo "   <TD Class=listar style='$vetado' COLSPAN='2'>Detalles:<BR /><CENTER>" . $rs->Value('ca_otro_detalles') . "</CENTER></TD>";
            echo " </TR>";
	   echo "  </TABLE></TD>";
	   echo "</TR>";

	   echo "<TR>";
	   echo "  <TD Class=listar COLSPAN=6><TABLE WIDTH=100% CELLSPACING=1 BORDER=1>";
	   echo "  <TR>";
	   echo "  	 <TD Class=listar COLSPAN=2 style='font-family: Arial, Helvetica, sans-serif; font-size: 9px; $vetado'><B>Actividad Económica:</B><BR>".$rs->Value('ca_actividad')."&nbsp</TD>";
	   echo "    <TD Class=listar COLSPAN=2 style='font-family: Arial, Helvetica, sans-serif; font-size: 9px; $vetado'><B>Preferencias :</B><BR>".$rs->Value('ca_preferencias')."&nbsp</TD>";
	   echo "  </TR>";
	   echo "  </TABLE></TD>";
	   echo "</TR>";

	   echo "<TR>";
	   echo "  <TD Class=listar COLSPAN=6><TABLE WIDTH=100% CELLSPACING=1 BORDER=1>";
	   echo "  <TR>";
	   echo "    <TD Class=titulo style='font-family: Arial, Helvetica, sans-serif; font-size: 9px;'>Creado</TD>";
	   echo "    <TD Class=titulo style='font-family: Arial, Helvetica, sans-serif; font-size: 9px;'>Actualizado</TD>";
	   echo "    <TD Class=titulo style='font-family: Arial, Helvetica, sans-serif; font-size: 9px;'>Financiero</TD>";
	   echo "    <TD Class=titulo style='font-family: Arial, Helvetica, sans-serif; font-size: 9px;'>Coltrans</TD>";
	   echo "    <TD Class=titulo style='font-family: Arial, Helvetica, sans-serif; font-size: 9px;'>Colmas</TD>";
	   echo "  </TR>";
	   echo "  <TR>";
	   echo "    <TD Class=invertir style='font-family: Arial, Helvetica, sans-serif; font-size: 9px; text-align: center'>".$rs->Value('ca_usucreado')."</TD>";
	   echo "    <TD Class=invertir style='font-family: Arial, Helvetica, sans-serif; font-size: 9px; text-align: center'>".$rs->Value('ca_usuactualizado')."</TD>";
           echo "    <TD Class=invertir style='font-family: Arial, Helvetica, sans-serif; font-size: 9px; text-align: center'>".$rs->Value('ca_usufinanciero')."</TD>";
	   echo "    <TD Class=invertir style='font-family: Arial, Helvetica, sans-serif; font-size: 9px; text-align: center'>".$rs->Value('ca_coltrans_std')."</TD>";
	   echo "    <TD Class=invertir style='font-family: Arial, Helvetica, sans-serif; font-size: 9px; text-align: center'>".$rs->Value('ca_colmas_std')."</TD>";
	   echo "  </TR>";
	   echo "  <TR>";
	   echo "    <TD Class=invertir style='font-family: Arial, Helvetica, sans-serif; font-size: 9px; text-align: center'>".$rs->Value('ca_fchcreado')."</TD>";
	   echo "    <TD Class=invertir style='font-family: Arial, Helvetica, sans-serif; font-size: 9px; text-align: center'>".$rs->Value('ca_fchactualizado')."&nbsp</TD>";
           echo "    <TD Class=invertir style='font-family: Arial, Helvetica, sans-serif; font-size: 9px; text-align: center'>".$rs->Value('ca_fchfinanciero')."&nbsp;</TD>";
	   echo "    <TD Class=invertir style='font-family: Arial, Helvetica, sans-serif; font-size: 9px; text-align: center'>".$rs->Value('ca_coltrans_fch')."</TD>";
	   echo "    <TD Class=invertir style='font-family: Arial, Helvetica, sans-serif; font-size: 9px; text-align: center'>".$rs->Value('ca_colmas_fch')."</TD>";
	   echo "  </TR>";
	   echo "  </TABLE></TD>";
	   echo "</TR>";
	   $rs->MoveNext();
	   }
	echo "<TR HEIGHT=4>";
	echo "  <TD Class=titulo COLSPAN=6></TD>";
	echo "</TR>";
	echo "</TABLE><BR>";

        if($rs->GetRowCount() == 1) {
            if (!$tm->Open("select * from audit.tb_clientes_audit where $registros order by ca_stamp DESC")) {          // Selecciona todos lo registros de la tabla Eventos de Clientes
                echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                echo "<script>document.location.href = 'clientes.php';</script>";
                exit;
            }
            echo "<TABLE WIDTH=600 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
            if (!$rs->IsEmpty()) {
                echo "<TR>";
                echo "  <TH Class=titulo COLSPAN=7>Histórico de Cambios en Clientes</TH>";
                echo "</TR>";
                echo "<TH>Operación</TH>";
                echo "<TH>Fecha</TH>";
                echo "<TH>Usuario</TH>";
                echo "<TH>Tabla</TH>";
                echo "<TH>Campo</TH>";
                echo "<TH>Dato Anterior</TH>";
                echo "<TH>Nuevo Dato</TH>";
            }
            while (!$tm->Eof()) {
                echo "<TR>";
                echo "  <TD WIDTH=60 Class=listar>".$operaciones[$tm->Value('ca_operation')]."</TD>";
                echo "  <TD WIDTH=60 Class=listar>".$tm->Value('ca_stamp')."</TD>";
                echo "  <TD WIDTH=30 Class=listar>".$tm->Value('ca_userid')."</TD>";
                echo "  <TD WIDTH=60 Class=listar>".$tm->Value('ca_table_name')."</TD>";
                echo "  <TD WIDTH=60 Class=listar>".$tm->Value('ca_field_name')."</TD>";
                echo "  <TD WIDTH=100 Class=listar>".$tm->Value('ca_value_old')."</TD>";
                echo "  <TD WIDTH=100 Class=listar>".$tm->Value('ca_value_new')."</TD>";
                echo "</TR>";
                $tm->MoveNext();
            }
            echo "</TABLE><BR>";
        }

	echo "<TABLE CELLSPACING=10>";
	echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Nueva Consulta' ONCLICK='javascript:document.location.href = \"clientes_financ.php\"'></TH>";  // Realizar una nueva consulta
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
        case 'Control Financiero': {
             $modulo = "00100200";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
             if (!$rs->Open("select * from vi_clientes where ca_idcliente = ".$id)) {    // Mueve el apuntador al registro que se desea modificar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'clientes_financ.php';</script>";
                 exit;
                }
             $tipos = explode("|", $rs->Value('ca_tipo'));
			 
             echo "<HEAD>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
             echo "      return (true);";
             echo "}";
             echo "</script>";
             echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
             echo "</HEAD>";
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='modificar' ACTION='clientes_financ.php' ONSUBMIT='return validar();'>"; // Llena la forma con los datos actuales del registro
             echo "<TABLE CELLSPACING=1>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta modificando
             echo "<TH Class=titulo COLSPAN=2>Nuevos Datos para el Cliente</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>N.i.t.:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_idcliente')." - ".$rs->Value('ca_digito')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Compañia:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_compania')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Circular 170:</TD>";
             echo "  <TD Class=invertir><TABLE CELLSPACING=1 WIDTH=100%><TR>";
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
             echo "  <TD Class=captura>SuperSociedades:</TD>";
             echo "  <TD Class=invertir><TABLE CELLSPACING=1 WIDTH=100%><TR>";
             echo "  <TD Class=mostrar WIDTH=100>Reportado:<BR /><CENTER><SELECT NAME='leyinsolvencia'>";
             echo "  	<OPTION VALUE='No' ".(($rs->Value('ca_leyinsolvencia')=='No')?'SELECTED':'').">No";
             echo "  	<OPTION VALUE='Sí' ".(($rs->Value('ca_leyinsolvencia')=='Sí')?'SELECTED':'').">Sí";
             echo "  </SELECT></CENTER></TD>";
             echo "  <TD Class=mostrar>Comentario:<BR /><CENTER><INPUT TYPE='TEXT' NAME='comentario' SIZE=60 VALUE='".$rs->Value('ca_comentario')."' MAXLENGTH=255></CENTER></TD>";
             echo "  </TABLE><TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Lista OFAC:</TD>";
             echo "  <TD Class=invertir><TABLE CELLSPACING=1 WIDTH=425><TR>";
             echo "  <TD Class=mostrar style='vertical-align: top;'>Reportado:<BR /><CENTER><SELECT NAME='listaclinton'>";
             echo "  	<OPTION VALUE='No' ".(($rs->Value('ca_listaclinton')=='No')?'SELECTED':'').">No";
             echo "  	<OPTION VALUE='Sí' ".(($rs->Value('ca_listaclinton')=='Sí')?'SELECTED':'').">Sí";
             echo "  </SELECT></CENTER></TD>";
             echo "  <TD Class=captura>Tipo de NIT.:</TD>";
             echo "  <TD Class=invertir style='vertical-align: bottom;'>";
             echo "  	<INPUT TYPE='CHECKBOX' NAME='tipo_nit[]' ".((in_array("Agente",$tipos))?'CHECKED':'')." VALUE='Agente'> Agente<br/>";
             echo "  	<INPUT TYPE='CHECKBOX' NAME='tipo_nit[]' ".((in_array("Proveedor",$tipos))?'CHECKED':'')." VALUE='Proveedor'> Proveedor<br/>";
             echo "  	<INPUT TYPE='CHECKBOX' NAME='tipo_nit[]' ".((in_array("Excepción Temporal",$tipos))?'CHECKED':'')." VALUE='Excepción Temporal'> Excepción Temporal<br/>";
             echo "  	<INPUT TYPE='CHECKBOX' NAME='tipo_nit[]' ".((in_array("Excepción Permanente",$tipos))?'CHECKED':'')." VALUE='Excepción Permanente'> Excepción Permanente";
             echo "  </TD>";
             echo "  </TR></TABLE></TD>";
             echo "</TR>";
             echo"</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo"<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Actualizar'></TH>";  // Ordena que se actualice el registro
             echo"<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"clientes_financ.php?modalidad=N.i.t.\&criterio=$id\"'></TH>";  // Cancela la operación
             echo"<script>modificar.fchcircular.focus()</script>";
             echo"</TABLE>";
             echo"</FORM>";
             echo"</CENTER>";
//           echo"<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
             require_once("footer.php");
echo "</BODY>";
             break;
             }
      }
   }
elseif (isset($accion)) {                                                      // Rutina que registra los cambios en la tabla de la base de datos
    switch(trim($accion)) {                                                    // Switch que evalua cual botòn de comando fue pulsado por el usuario
        case 'Actualizar': {                                                   // El Botón Actualizar fue pulsado
             $fchcircular = (strlen($fchcircular)!=0)?"'".$fchcircular."'":'date(null)';

             $tipo_nit = implode("|",$tipo_nit);
             $tipo_nit = ((strlen(trim($tipo_nit))==0)?'NULL':"'$tipo_nit'");
             
             if (!$rs->Open("update tb_clientes set ca_fchcircular = $fchcircular, ca_nvlriesgo = '$nvlriesgo', ca_listaclinton = '$listaclinton', ca_leyinsolvencia = '$leyinsolvencia', ca_comentario = '$comentario', ca_tipo = $tipo_nit, ca_fchfinanciero = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), ca_usufinanciero = '$usuario' where ca_idcliente = $id")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'clientes_financ.php';</script>";
                 exit;
                }
             break;
             }
        }
    echo "<script>document.location.href = 'clientes_financ.php?modalidad=N.i.t.\&criterio=$id';</script>";  // Retorna a la pantalla principal de la opción
 }
?>