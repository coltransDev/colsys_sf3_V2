<?
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       clientes.php                                                \\
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

include_once 'include/datalib.php';                                                // Incorpora la libreria de funciones, para accesar leer bases de datos
require("checklogin.php");  


$titulo = 'Maestra de Clientes Colsys';
$saludos= array( "Señor" => "Señor", "Señora" => "Señora", "Doctor" => "Doctor", "Doctora" => "Doctora", "Ingeniero" => "Ingeniero", "Ingeniera" => "Ingeniera", "Arquitecto" => "Arquitecto", "Arquitecta" => "Arquitecta" );
$letras  = array(" ","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P", "Q", "R", "S");
$parte_1 = array(" ","Avenida","Autopista","Calle","Carrera","Circular","Diagonal","Transversal","Kilómetro","Via");
$parte_2 = array(" ","Bis","Sur");
$parte_3 = array(" ","Norte","Sur","Este","Oeste");
$numero = array("No.","");
$sexos = array("Femenino","Masculino");
$mandatos = array("Poder General","TC Buen");
$calificaciones = array("A","B","C","D","E");
$riesgos = array("Sin","Mínimo","Medio","Alto");

$col = ( $regional=="PE-051" ?"RUC":"N.i.t.");
$campos = array("Nombre del Cliente" => "ca_compania", "Representante Legal" => "ca_ncompleto", $col => "ca_idcliente", "Calificación" => "ca_calificacion", "Coordinador Aduana" => "ca_coordinador", "Actividad Económica" => "ca_actividad", "Sector Económico" => "ca_sector", "Localidad" => "ca_localidad", "Ciudad" => "ca_ciudad", "Contrato Agenciamiento" => "ca_stdcotratoag");  // Arreglo con las opciones de busqueda
$bdatos = array("Maestra Clientes", "Mis Clientes", "Clientes Libres");  // Arreglo con los lugares donde buscar
$tipos = array("Llamada", "Visita", "Correo Electrónico", "Correspondencia", "Cerrar Caso");
$estados = array("Potencial","Activo","Vetado");
$libestados = array("Vigente","Congelada");
$sstatus = array("","Vetado");
if ($regional == 'CO-057'){
    $empresas= array("Coltrans","Colmas");
}else{
    $empresas= array("Coltrans");
}
$circular=array("Sin","Vencido","Vigente");
$presentacion=array("Detallado","Columnas");
$entidades=array("Vigente","Fusionada","Disuelta","Liquidada");
$tiposnits=array("","Agente","Proveedor","Excepción Temporal","Excepción Permanente");
$operaciones=array("I" => "Nuevo Registro", "U" => "Actualización", "D" => "Borrado");

                                                               // Captura las variables de la sessión abierta

if ($regional == 'CO-057'){
    $localidades = array(
        "Bogotá"=>array("Usaquén","Chapinero","Santafé","San Cristóbal","Usme","Tunjuelito","Bosa","Kennedy","Fontibón","Engativa","Suba","Barrios Unidos","Teusaquillo","Mártires","Antonio Nariño","Puente Aranda","Candelaria","Rafael Uribe","Ciudad Bolívar"),
        "C/marca"=>array("Sumapaz","Cajicá","Chia","Cota","La Calera","Funza","Mosquera","Sibaté","Siberia","Soacha","Tocancipá"),
        "B/quilla"=>array("Zona Centro","Zona Norte","Zona Suroriente","Zona Franca BAQ","Circunvalar","Vía 40","Calle 30"),
        "Otras"=>array("Otra")
        );
}else{
    $localidades = array();
}
$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos


if (!isset($criterio) and !isset($boton) and !isset($accion)){
    
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function elegir(opcion, id){";
    echo "  if(opcion=='Modificar'){";
    echo "    document.location.href = '/crm/formCliente/idcliente/'+id";
    echo "  }else if(opcion=='Adicionar'){";
    echo "    document.location.href = '/crm/formCliente'";
    echo "  }else{";
    echo "    document.location.href = 'clientes.php?boton='+opcion+'\&id='+id;";
    echo "  }";
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
    echo "<FORM METHOD=post NAME='menuform' ACTION='clientes.php' >";
    echo "<TABLE WIDTH=450 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
    echo "<TH COLSPAN=4 style='font-size: 12px; font-weight:bold;'><B>Ingrese un criterio para realizar las busqueda</TH>";
    echo "<TH><IMG src='./graficos/new.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(\"Adicionar\", 0);'></TH>";  // Botón para la creación de un Registro Nuevo
    echo "<TR>";
    echo "  <TH ROWSPAN=5>&nbsp;</TH>";
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
    if (!$us->Open("select u.ca_login, ca_nombre from vi_usuarios u inner join control.tb_usuarios_perfil up on u.ca_login =up.ca_login where up.ca_perfil = 'comercial' and ca_activo = true")) {
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

    echo "  <TD Class=listar><B>Reporte:</B><BR />";
	$che_mem = "CHECKED";
    for ($i=0; $i < count($presentacion); $i++) {
         echo "<INPUT TYPE='RADIO' NAME='salida[]' VALUE='".$presentacion[$i]."' $che_mem>".$presentacion[$i]."&nbsp;&nbsp;";
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
    echo "  <TD Class=listar><B>Tipo:</B><BR><SELECT NAME='tiponit'>";
    $che_mem = "SELECTED";
    for ($i=0; $i < count($tiposnits); $i++) {
         echo " <OPTION VALUE='".$tiposnits[$i]."' $che_mem>".$tiposnits[$i];
		 $che_mem = "";
        }
    echo "  </SELECT>";
    echo "  </TD>";
    echo "</TR>";

    echo "<TR>";
    echo "  <TD Class=listar COLSPAN=4><TABLE WIDTH=100% BORDER=0 CELLSPACING=0>";
    echo "	<TR>";
	echo "  	<TD Class=listar><B>Empresa:</B>";
    if ($regional == 'CO-057'){
        $che_mem = "CHECKED";
        for ($i=0; $i < count($empresas); $i++) {
             echo "<BR /><INPUT TYPE='RADIO' NAME='empresa' VALUE='".$empresas[$i]."' $che_mem>".$empresas[$i];
             $che_mem = "";
        }
    }else{
         echo "<BR /><INPUT TYPE='RADIO' NAME='empresa' VALUE='Coltrans' CHECKED> TPLogistics";
    }
	echo "		</TD>";
	
	echo "  	<TD Class=listar><B>Estado:</B>";
    for ($i=0; $i < count($estados); $i++) {
         echo "<BR /><INPUT TYPE='CHECKBOX' NAME='estados_sel[]' VALUE='".$estados[$i]."'>".$estados[$i];
        }
	echo "		</TD>";

	echo "  	<TD Class=listar><B>Nivel de Riesgo:</B>";
    for ($i=0; $i < count($riesgos); $i++) {
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
    /*header ("Pragma: no-cache");
    header ("Content-type: application/x-msexcel");
    header ("Content-Disposition: attachment; filename=prueba.xls" );*/
    set_time_limit(360);
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo
    $criterio = trim( $criterio );
    if (isset($criterio) and !isset($condicion)) {        
		if($modalidad == "RUC" or $modalidad == "N.i.t." ){
           $criterio = str_replace(",","",$criterio) ;
           $criterio = str_replace(".","",$criterio) ;
           $pos = strpos($criterio,"-");
           if( $pos!==false ){
               $criterio = substr($criterio, 0, $pos );
           }
           $condicion = "where ca_idalterno LIKE '".$criterio."%'";        
        }else if( $modalidad == "idcliente"){           
           $condicion = "where ca_idcliente = ".$criterio."";   
        }else{
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
		foreach($riesgo as $nivelr){
                    if($nivelr == "Sin"){
                        $sub_cad.= "'',";
                    }else{
                        $sub_cad.= "'".$nivelr."',";
                    }
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
        if ($tiponit != ""){
            $condicion.= " and ca_tipo like '%$tiponit%'";
        }
	if (!$rs->Open("select * from vi_clientes $condicion")) {                  // Selecciona todos lo registros de la tabla Trasportistas
		echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
		//echo "<script>document.location.href = 'clientes.php';</script>";
		exit; }
	$registros = (!$rs->IsEmpty())?"ca_idcliente = ".$rs->Value('ca_idcliente'):"false";
	$cn =& DlRecordset::NewRecordset($conn);
	$tm =& DlRecordset::NewRecordset($conn);

	echo "<HTML>";
	echo "<HEAD>";
	echo "<TITLE>Tabla de Clientes ".COLTRANS."</TITLE>";
	if ($salida[0] == "Columnas"){
        if( $regional=="PE-051" ){
            $columnas = array("RUC"=>"ca_idalterno","Cliente"=>"ca_compania","Dirección"=>array("ca_direccion","ca_oficina","ca_torre","ca_bloque","ca_interior","ca_localidad","ca_complemento"),"Teléfonos"=>"ca_telefonos","Fax"=>"ca_fax","Ciudad"=>"ca_ciudad","Vendedor"=>"ca_vendedor","Sucursal"=>"ca_sucursal","Circular 170"=>array("ca_fchcircular","ca_stdcircular"),"Carta Grtia."=>array("ca_fchvencimiento","ca_stdcarta_gtia"),"Encuesta/Visita"=>"ca_fchvisita","Nivel/Riesgo"=>"ca_nvlriesgo","Coord.Colmas"=>"ca_nombre_coor","Lista Clinton"=>"ca_listaclinton","Ley/Insolvencia"=>"ca_leyinsolvencia","Estado/TPLogistics"=>array("ca_coltrans_std","ca_coltrans_fch"),"Días/Crédito"=>"ca_diascredito","Cupo/Crédito"=>"ca_cupo","Observaciones"=>"ca_observaciones");
        }else{
            $columnas = array("Id"=>"ca_idcliente","N.i.t."=>"ca_idalterno","DV"=>"ca_digito","Cliente"=>"ca_compania","Dirección"=>array("ca_direccion","ca_oficina","ca_torre","ca_bloque","ca_interior","ca_localidad","ca_complemento"),"Teléfonos"=>"ca_telefonos","Fax"=>"ca_fax","Ciudad"=>"ca_ciudad","Vendedor"=>"ca_vendedor","Sucursal"=>"ca_sucursal","Circular 170"=>array("ca_fchcircular","ca_stdcircular"),"Carta Grtia."=>array("ca_fchvencimiento","ca_stdcarta_gtia"),"Encuesta/Visita"=>"ca_fchvisita","Nivel/Riesgo"=>"ca_nvlriesgo","Coord.Colmas"=>"ca_nombre_coor","Lista Clinton"=>"ca_listaclinton","Ley/Insolvencia"=>"ca_leyinsolvencia","Estado/Coltrans"=>array("ca_coltrans_std","ca_coltrans_fch"),"Estado/Colmas"=>array("ca_colmas_std","ca_colmas_fch"),"Días/Crédito"=>"ca_diascredito","Cupo/Crédito"=>"ca_cupo","Observaciones"=>"ca_observaciones");
            
        }
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
               if($col_tit=="Id"){
                  continue;
               }
			echo "<TH Class=titulo>$col_tit</TH>";
		}
		echo "</TR>";

		while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
                    $bkground = ($rs->Value('ca_coltrans_std')=='Vetado' or $rs->Value('ca_colmas_std')=='Vetado' )?'background-color:#FFb2b2;':'';
                    echo "<TR>";
                    foreach($columnas as $campos ){
                        $img="";
                        if($campos=="ca_idcliente"){
                           continue;
                        }
                        if($campos=="ca_vendedor"){
                           $img="<a href='clientes.php?boton=Evento&id=".$rs->Value("ca_idcliente")."' target='_blank'>Hacer&nbsp;Seguimiento</a>";
                        }
                        if($campos=="ca_compania")
                        {
                            if($rs->Value('ca_propiedades')!="")
                            {
                                if(strpos($rs->Value('ca_propiedades'), "cuentaglobal=true") !== false)
                                {
                                    $img='<img src="/images/CG30.png" title="Cliente de Cuentas Globales" width="20" height="20" />';
                                }
                                if(strpos($rs->Value('ca_propiedades'), "consolidar_comunicaciones=true") !== false)
                                {
                                    $img.='<img src="/images/consolidate.png" title="Cliente de Cuadro" width="20" height="20" />';
                                }
                            }
                        }
                        if (is_array($campos)){
                            echo "<TD Class=mostrar style='font-size: 9px; center; $bkground'>";
                            foreach($campos as $campo){
                                    echo str_replace("|","",$rs->Value($campo))." $img";
                            }
                            echo "</TD>";
                        }else{
                            echo "<TD Class=mostrar style='font-size: 9px; center; $bkground'>".$rs->Value($campos)." $img</TD>";
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
        echo "  if(opcion=='Modificar'){";
        echo "    document.location.href = '/crm/formCliente/idcliente/'+id";
        echo "  }else if(opcion=='Adicionar'){";
        echo "    document.location.href = '/crm/formCliente'";
        echo "  }else{";
        echo "    document.location.href = 'clientes.php?boton='+opcion+'\&id='+id;";
        echo "  }";
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
		   $vista_3 = ($nivel >= 3)?'visible':'hidden'; // Habilita la opción para definir porcentaje de comisión
		   $vista_2 = ($nivel >= 1)?'visible':'hidden'; // Habilita la opción para firma de comodato
		   $visible = ($rs->Value('ca_vendedor')==$usuario or $rs->Value('ca_vendedor')=='' or $nivel>1)?'visible':'hidden';
                   $bkground = ($rs->Value('ca_entidad')!='Vigente')?'background-color:#9999CC;':'';
                   $bkground = ($rs->Value('ca_status')=='Restrictivo')?'background-color:#088A29;':$bkground;
		   $bkground = ($rs->Value('ca_coltrans_std')=='Vetado' or $rs->Value('ca_colmas_std')=='Vetado' )?'background-color:#FFb2b2;':$bkground;
		   $alerta = ($rs->Value('ca_coltrans_std')=='Vetado' or $rs->Value('ca_colmas_std')=='Vetado' )?'<IMG src=\'./graficos/izquierda.gif\' border=0>':'';
		   if (!$cn->Open("select * from vi_concliente where ca_idcliente = ".$rs->Value('ca_idcliente')." and ca_idcontacto != 0 and ca_cargo<>'Extrabajador'")) {          // Selecciona todos lo registros de la tabla Contacos de Clientes
				echo "<script>alert(\"".addslashes($cn->mErrMsg)."\");</script>";      // Muestra el mensaje de error
				//echo "<script>document.location.href = 'clientes.php';</script>";
				exit; }
		   echo "<TR>";
		   echo "<TD Class=titulo style='vertical-align: top;'>".number_format($rs->Value('ca_idalterno')?$rs->Value('ca_idalterno'):$rs->Value('ca_idcliente')).($rs->Value('ca_tipoidentificacion')==1&&$rs->Value('ca_digito')!==0?"-".$rs->Value('ca_digito'):"")."</TD>";
            $img="";
            if($rs->Value('ca_propiedades')!="")
            {
                if(strpos($rs->Value('ca_propiedades'), "cuentaglobal=true") !== false)
                {
                    $img='<img src="/images/CG30.png" title="Cliente de Cuentas Globales" width="20" height="20" />';
                }
                if(strpos($rs->Value('ca_propiedades'), "consolidar_comunicaciones=true") !== false)
                {
                    $img.='<img src="/images/consolidate.png" title="Cliente de Cuadro" width="20" height="20" />';
                }
            }
		   echo "<TD Class=titulo COLSPAN=4 style='font-size: 12px; font-weight:bold; text-align:left;'>".$rs->Value('ca_compania')." $img</TD>";
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
                            echo "  <TD Class=mostrar style='font-size: 9px; center; $bkground'>".$cn->Value('ca_ncompleto_cn')."</TD>";
                            echo "  <TD Class=mostrar style='font-size: 9px; center; $bkground'>".$cn->Value('ca_cargo')."</TD>";
                            echo "  <TD Class=mostrar style='font-size: 9px; center; $bkground'>".$cn->Value('ca_telefonos')."</TD>";
                            echo "  <TD Class=mostrar style='font-size: 9px; center; $bkground'>".$cn->Value('ca_email')."</TD>";
                            echo "</TR>";
                            $cn->MoveNext();
                       }
                   }else {
                       echo "<TR>";
                       echo "  <TD Class=mostrar style='font-weight:bold; font-size: 9px;' COLSPAN=4>El Cliente no tiene Contactos registrados</TD>";
                       echo "</TR>";
		   }
		   echo "  <TR>";
		   echo "    <TD Class=mostrar style='font-size: 9px; center; $bkground'>".$rs->Value('ca_ncompleto')."</TD>";
		   echo "    <TD Class=mostrar style='font-size: 9px; center; $bkground'>Representante Legal</TD>";
		   echo "    <TD Class=mostrar style='font-size: 9px; center; $bkground'>".$rs->Value('ca_telefonos')."</TD>";
		   echo "    <TD Class=mostrar style='font-size: 9px; center; $bkground'>".$rs->Value('ca_email')."</TD>";
		   echo "  </TR>";
		   echo "  </TABLE>";
		   echo "</TD>";
		   echo "</TR>";

		   $complemento = (($rs->Value('ca_oficina')!='')?" Oficina : ".$rs->Value('ca_oficina'):"").(($rs->Value('ca_torre')!='')?" Torre : ".$rs->Value('ca_torre'):"").(($rs->Value('ca_interior')!='')?" Interior : ".$rs->Value('ca_interior'):"").(($rs->Value('ca_complemento')!='')?" - ".$rs->Value('ca_complemento'):"").(($rs->Value('ca_zipcode')!='')?" Cod.Postal : ".$rs->Value('ca_zipcode'):"");
		   echo "<TR>";
		   echo "  <TD Class=listar ROWSPAN=10 style='text-align: center; center; $bkground'>";
		   echo "    <TABLE>";
		   echo "      <TR><TD style='visibility: $vista_3; text-align: center; color=blue;' Class=mostrar onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='elegir(\"Comisión\", ".$rs->Value('ca_idcliente').");'><BR><IMG src='graficos/Info.gif'><BR>Porcentaje de Comisión</TD></TR>";
		   echo "      <TR><TD style='visibility: $vista_2; text-align: center; color=blue;' Class=mostrar onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='elegir(\"Contrato\", ".$rs->Value('ca_idcliente').");'><BR><IMG src='graficos/contrato.gif'><BR>Contrato de<br>Comodato</TD></TR>";
		   echo "      <TR><TD style='visibility: $vista_2; text-align: center; color=blue;' Class=mostrar onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='elegir(\"Mandato\", ".$rs->Value('ca_idcliente').");'><BR><IMG src='graficos/post.gif'><BR>Control<br>Mandatos</TD></TR>";
		   echo "      <TR><TD style='visibility: $vista_1; text-align: center; color=blue;' Class=mostrar onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='elegir(\"Liberacion\", ".$rs->Value('ca_idcliente').");'><BR><IMG src='graficos/si.gif'><BR>Liberación<br>Automática</TD></TR>";
		   echo "      <TR><TD style='visibility: $vista_2; text-align: center; color=blue;' Class=mostrar onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='elegir(\"Libestados\", ".$rs->Value('ca_idcliente').");'><BR><IMG src='graficos/lock_close.gif'><BR>Estado de<br>Liberación</TD></TR>";
		   echo "    </TABLE>";
		   echo "  </TD>";
		   echo "  <TD Class=mostrar style='$bkground'>Dirección :</TD>";
		   echo "  <TD Class=listar style='$bkground' COLSPAN=3>".str_replace ("|"," ",$rs->Value('ca_direccion')).$complemento."</TD>";
		   echo "  <TD Class=listar style='$bkground' ROWSPAN=10 style='text-align: center;'>";
		   echo "    <TABLE>";
		   echo "      <TR><TD Class=mostrar style='text-align: center; color=blue;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='javascript:document.location.href = \"concliente.php?id=".$rs->Value('ca_idcliente')."\"'><BR><IMG src='graficos/contacto.gif'><BR>Contactos</TD></TR>";
		   echo "      <TR><TD Class=mostrar style='text-align: center; color=blue;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='javascript:document.location.href = \"enccliente.php?id=".$rs->Value('ca_idcliente')."\"'><BR><IMG src='graficos/encuesta.gif'><BR>Visitas<BR>".$rs->Value('ca_fchvisita')."</TD></TR>";
		   echo "      <TR><TD Class=mostrar style='visibility: $visible; text-align: center; color=blue;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='javascript:liberar(".$rs->Value('ca_idcliente').");'><BR><IMG src='graficos/no.gif'><BR>Liberar Cliente</TD></TR>";
		   echo "      <TR><TD Class=mostrar style='text-align: center;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='elegir(\"ListaClinton\", ".$rs->Value('ca_idcliente').");' style='color=blue;'><BR><IMG src='graficos/vista.gif'><BR>Lista Clinton</TD></TR>";
		   echo "      <TR><TD Class=mostrar style='text-align: center; color=blue;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='javascript:document.location.href = \"/clientes/clavesTracking?id=".$rs->Value('ca_idcliente')."\"'><BR><IMG src='graficos/tracking.gif'><BR>Tracking</TD></TR>";
                    if($nivel>=1)
                        echo "      <TR><TD Class=mostrar style='text-align: center; color=blue;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='javascript:document.location.href = \"/ids/verIds/modo/clientes?id=".$rs->Value('ca_idcliente')."\"'><BR><IMG src='graficos/encuesta.gif'><BR>Sucursales</TD></TR>";
                   echo "      <TR><TD Class=mostrar style='text-align: center; color=blue;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='javascript:document.location.href = \"/gestDocumental/formUploadExt4/ref1/".$rs->Value('ca_idcliente')."/ref2/".date("Y")."/idsserie/9 \"'><BR><IMG src='graficos/fileopen.png'><BR>Docs</TD></TR>";
		   echo "    </TABLE>";
		   echo "  </TD>";
		   echo "</TR>";
		   echo "<TR>";
		   echo "  <TD Class=mostrar style='$bkground'>Teléfonos :</TD>";
		   echo "  <TD Class=mostrar style='$bkground'>".$rs->Value('ca_telefonos')."</TD>";
		   echo "  <TD Class=mostrar style='$bkground'>Fax :</TD>";
		   echo "  <TD Class=mostrar style='$bkground'>".$rs->Value('ca_fax')."</TD>";
		   echo "</TR>";
		   echo "<TR>";
		   echo "  <TD Class=mostrar style='$bkground'>".($regional!="PE-051"?"Localidad":"Distrito")." :</TD>";
		   echo "  <TD Class=mostrar style='$bkground'>".$rs->Value('ca_localidad')."</TD>";
		   echo "  <TD Class=mostrar style='$bkground'>Ciudad :</TD>";
		   echo "  <TD Class=mostrar style='$bkground'>".$rs->Value('ca_ciudad')."</TD>";
		   echo "</TR>";
		   echo "<TR>";
		   echo "  <TD Class=mostrar style='$bkground'>Web Site :</TD>";
		   echo "  <TD Class=mostrar style='$bkground'><a href='http://".$rs->Value('ca_website')."'target='_blank'>".$rs->Value('ca_website')."</a></TD>";
		   echo "  <TD Class=mostrar style='$bkground'>Email :</TD>";
		   echo "  <TD Class=mostrar style='$bkground'>".$rs->Value('ca_email')."</TD>";
		   echo "</TR>";
		   echo "<TR>";
		   echo "  <TD Class=mostrar style='$bkground'>Status :</TD>";
		   echo "  <TD Class=mostrar style='$bkground'>".$rs->Value('ca_status').(($rs->Value('ca_status')=="Restrictivo")?" <IMG SRC='./graficos/nuevo.gif' border=0 ALT='Cliente con algunas restricciones!'>":"")."</TD>";
		   echo "  <TD Class=mostrar style='$bkground'>Calificación :</TD>";
		   echo "  <TD Class=mostrar style='$bkground'>".$rs->Value('ca_calificacion')."</TD>";
		   echo "</TR>";
		   echo "<TR>";
		   echo "  <TD Class=listar style='$bkground' rowspan=4>Sector :</TD>";
		   echo "  <TD Class=listar style='$bkground' rowspan=4>".$rs->Value('ca_sectoreco')."</TD>";
		   echo "  <TD Class=listar style='$bkground'>Vendedor :</TD>";
		   echo "  <TD Class=listar style='$bkground'>".$rs->Value('ca_vendedor')."<BR>".$rs->Value('ca_sucursal')."</TD>";
		   echo "</TR>";
		   echo "<TR>";
		   echo "  <TD Class=mostrar style='$bkground'>Coord. Colmas:</TD>";
		   echo "  <TD Class=mostrar style='$bkground'>".$rs->Value('ca_coordinador')."</TD>";
		   echo "</TR>";
		   echo "<TR>";
		   echo "  <TD Class=mostrar style='$bkground'>Tipo NIT:</TD>";
		   echo "  <TD Class=mostrar style='$bkground'>".str_replace("|","<br>",$rs->Value('ca_tipo'))."</TD>";
		   echo "</TR>";
		   echo "<TR>";
		   echo "  <TD Class=mostrar style='$bkground'>Entidad:</TD>";
		   echo "  <TD Class=mostrar style='$bkground'>".$rs->Value('ca_entidad')."</TD>";
		   echo "</TR>";

		   echo "<TR>";
		   echo "  <TD Class=invertir COLSPAN=4><TABLE WIDTH=100% CELLSPACING=1 BORDER=1>";
		   echo "  <TR>";
		   echo "    <TD Class=listar style='$bkground'>Circular 170:<BR /><CENTER>".$rs->Value('ca_fchcircular')."</CENTER></TD>";
		   echo "    <TD Class=listar style='$bkground'>Estado Circular:<BR /><CENTER>".$rs->Value('ca_stdcircular')."</CENTER></TD>";
		   echo "    <TD Class=listar style='$bkground'>Nivel Riesgo:<BR /><CENTER>".$rs->Value('ca_nvlriesgo')."</CENTER></TD>";
		   echo "    <TD Class=listar style='$bkground'>Lista Clinton:<BR /><CENTER>".$rs->Value('ca_listaclinton')."</CENTER></TD>";
               echo "    <TD Class=listar style='$bkground'>Acuerdo Conf.:<BR /><CENTER>".$rs->Value('ca_fchacuerdoconf')."</CENTER></TD>";
		   echo "  </TR>";
		   echo "  <TR>";
		   echo "    <TD Class=listar style='$bkground'>Contrato Agenc.:<BR /><CENTER>".$rs->Value('ca_fchcotratoag')."</CENTER></TD>";
		   echo "    <TD Class=listar style='$bkground'>Estado Contrato:<BR /><CENTER>".$rs->Value('ca_stdcotratoag')."</CENTER></TD>";
		   echo "    <TD Class=listar style='$bkground'>Ley Insolvencia Eco.:<BR /><CENTER>".$rs->Value('ca_leyinsolvencia')."</CENTER></TD>";
		   echo "    <TD Class=listar style='$bkground' COLSPAN='2'>Comentario:<BR /><CENTER>".$rs->Value('ca_comentario')."</CENTER></TD>";
		   echo "  </TR>";
		   echo "  </TABLE></TD>";
		   echo "</TR>";

		   echo "<TR>";
		   echo "  <TD Class=listar style='$bkground' COLSPAN=6><TABLE WIDTH=100% CELLSPACING=1 BORDER=1>";
		   echo "  <TR>";
		   echo "  	 <TD Class=listar COLSPAN=2 style='font-family: Arial, Helvetica, sans-serif; font-size: 9px; $bkground'><B>Actividad Económica:</B><BR>".$rs->Value('ca_actividad')."&nbsp;</TD>";
		   echo "    <TD Class=listar COLSPAN=2 style='font-family: Arial, Helvetica, sans-serif; font-size: 9px; $bkground'><B>Preferencias :</B><BR>".$rs->Value('ca_preferencias')."&nbsp;</TD>";
		   echo "  </TR>";
		   echo "  </TABLE></TD>";
		   echo "</TR>";

		   echo "<TR>";
		   echo "  <TD Class=mostrar style='$bkground' COLSPAN=5><b>Libreta de Direcciones del Cliente:</b> <!--<IMG SRC='./graficos/nuevo.gif' border=0 ALT='Opción de mantenimiento a libreta de direcciones por cliente!'> --></TD>";
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
		   for ($i=0; $i<7; $i++){
                        echo "  <TR>";
                        for ($j=0; $j<3; $j++) {
                            $cadena = (strlen($emails[$z])==0)?"&nbsp;":$emails[$z];
                            echo "<TD Class=mostrar style='$bkground'>$cadena</TD>";
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
		   echo "    <TD Class=titulo style='font-family: Arial, Helvetica, sans-serif; font-size: 9px;'>Financiero</TD>";
		   echo "    <TD Class=titulo style='font-family: Arial, Helvetica, sans-serif; font-size: 9px;'>Coltrans</TD>";
		   echo "    <TD Class=titulo style='font-family: Arial, Helvetica, sans-serif; font-size: 9px;'>Colmas</TD>";
		   echo "  </TR>";
		   echo "  <TR>";
		   echo "    <TD Class=invertir style='font-family: Arial, Helvetica, sans-serif; font-size: 9px; text-align: center'>".$rs->Value('ca_usucreado')."</TD>";
		   echo "    <TD Class=invertir style='font-family: Arial, Helvetica, sans-serif; font-size: 9px; text-align: center'>".$rs->Value('ca_usuactualizado')."</TD>";
                   echo "    <TD Class=invertir style='font-family: Arial, Helvetica, sans-serif; font-size: 9px; text-align: center'>".$rs->Value('ca_usufinanciero')."</TD>";
		   echo "    <TD Class=invertir style='font-family: Arial, Helvetica, sans-serif; font-size: 9px; text-align: center'>".$rs->Value('ca_coltrans_std')."$alerta</TD>";
		   echo "    <TD Class=invertir style='font-family: Arial, Helvetica, sans-serif; font-size: 9px; text-align: center'>".$rs->Value('ca_colmas_std')."$alerta</TD>";
		   echo "  </TR>";
		   echo "  <TR>";
		   echo "    <TD Class=invertir style='font-family: Arial, Helvetica, sans-serif; font-size: 9px; text-align: center'>".$rs->Value('ca_fchcreado')."</TD>";
		   echo "    <TD Class=invertir style='font-family: Arial, Helvetica, sans-serif; font-size: 9px; text-align: center'>".$rs->Value('ca_fchactualizado')."&nbsp;</TD>";
                   echo "    <TD Class=invertir style='font-family: Arial, Helvetica, sans-serif; font-size: 9px; text-align: center'>".$rs->Value('ca_fchfinanciero')."&nbsp;</TD>";
		   echo "    <TD Class=invertir style='font-family: Arial, Helvetica, sans-serif; font-size: 9px; text-align: center'>".$rs->Value('ca_coltrans_fch')."</TD>";
		   echo "    <TD Class=invertir style='font-family: Arial, Helvetica, sans-serif; font-size: 9px; text-align: center'>".$rs->Value('ca_colmas_fch')."</TD>";
		   echo "  </TR>";
		   echo "  </TABLE></TD>";
		   echo "</TR>";

             if (strlen(trim($rs->Value('ca_diascredito')))!=0){
                 $beneficios = ($rs->Value('ca_diascredito')==0 or $rs->Value('ca_libestado')=="Suspendida")?'background-color:#FF0000;':'background-color:#FFFFC0;';
                 $beneficios = ($rs->Value('ca_libestado')=="Congelada")?'background-color:#9999CC;':$beneficios;
                 echo "<TR>";
                 echo "  <TD Class=listar style='$beneficios'><B>Liberación Automática:</B></TD>";
                 echo "  <TD Class=listar style='$beneficios' COLSPAN=4><TABLE WIDTH=100% CELLSPACING=1 BORDER=1>";
                 echo "  <TR>";
                 echo "    <TD Class=listar style='$beneficios'><B>Días/Crédito : </B><BR />".$rs->Value('ca_diascredito')."</TD>";
                 echo "    <TD Class=listar style='$beneficios'><B>Cupo Asignado : </B><BR />".number_format($rs->Value('ca_cupo'))."</TD>";
                 echo "    <TD Class=listar style='$beneficios'><B>Creado : </B>".$rs->Value('ca_usucreado_lb')."<BR />".$rs->Value('ca_fchcreado_lb')."</TD>";
                 echo "    <TD Class=listar style='$beneficios'><B>Actualizado : </B>".$rs->Value('ca_usuactualizado_lb')."<BR />".$rs->Value('ca_fchactualizado_lb')."</TD>";
                 echo "  </TR>";
                 echo "  <TR>";
                 echo "    <TD Class=listar style='$beneficios' COLSPAN=4><B>Observaciones : </B>".$rs->Value('ca_observaciones')." ".$rs->Value('ca_libestobservaciones')."</TD>";
                 echo "  </TR>";
                 echo "  </TABLE></TD>";
                 echo "  <TD Class=listar style='$beneficios'>".(($rs->Value('ca_fchestado') != '')?"<B>Estado Lib.Automática:</B><BR/>".$rs->Value('ca_libestado')." - ".$rs->Value('ca_usucreado_le')."<BR/>".$rs->Value('ca_fchcreado_le'):"")."</TD>";
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
             
             $q = "SELECT cm.ca_idcliente, cm.ca_ciudad, cm.ca_tipo, cm.ca_fchradicado, cm.ca_fchvencimiento FROM ";
             $q.= " ( SELECT max(tb_mancliente.oid) AS ca_oid FROM tb_mancliente WHERE tb_mancliente.ca_idcliente = ".$rs->Value('ca_idcliente')." and tb_mancliente.ca_fchanulado IS NULL ";
             $q.= " GROUP BY tb_mancliente.ca_idcliente, tb_mancliente.ca_idciudad, tb_mancliente.ca_tipo ) cf ";
             $q.= " JOIN ( SELECT tb_mancliente.oid, tb_mancliente.ca_idcliente, tb_mancliente.ca_tipo, tb_mancliente.ca_fchradicado, tb_mancliente.ca_fchvencimiento, tb_ciudades.ca_ciudad ";
             $q.= " FROM tb_mancliente INNER JOIN tb_ciudades on tb_mancliente.ca_idciudad = tb_ciudades.ca_idciudad ";
             $q.= " ) cm ON cf.ca_oid = cm.oid";
		   if (!$tm->Open("$q")) {          // Selecciona todos lo registros de la tabla Mandatos por Cliente
                  echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                  exit; }

             $tit_mem = false;
             if (!$tm->IsEmpty()) {
                  list($anno, $mes, $dia) = sscanf($tm->Value('ca_fchvencimiento'),"%d-%d-%d");
                  $col_mem = (date("Y-m-d",mktime(0,0,0,$mes,$dia,$anno)) >= date("Y-m-d"))?'#00A040':'#FF6666';
                  echo "<TR>";
                  echo "  <TD Class=listar style='background-color: $col_mem;'><B>Control de Mandatos</B></TD>";
                  echo "  <TD Class=listar COLSPAN=4 style='background-color: $col_mem;'><TABLE WIDTH=100% CELLSPACING=1 BORDER=1>";
                  echo "  <TR>";
                  echo "   <TH style='background-color: $col_mem;'>Tipo</TH>";
                  echo "   <TH style='background-color: $col_mem;'>Fch.de Radicado</TH>";
                  echo "   <TH style='background-color: $col_mem;'>Venc.de Mandato</TH>";
                  echo "   <TH style='background-color: $col_mem;'>Tipo</TH>";
                  echo "  </TR>";
                  $tit_mem = true;
             }
             $tm->MoveFirst();
             while (!$tm->Eof() and !$tm->IsEmpty()) {
                  list($anno, $mes, $dia) = sscanf($tm->Value('ca_fchvencimiento'),"%d-%d-%d");
                  $col_mem = (date("Y-m-d",mktime(0,0,0,$mes,$dia,$anno)) >= date("Y-m-d"))?'#00A040':'#FF6666';
                  echo "  <TR>";
                  echo "    <TD Class=listar style='background-color: $col_mem;'>".$tm->Value('ca_ciudad')."</TD>";
                  echo "    <TD Class=listar style='background-color: $col_mem;'>".$tm->Value('ca_fchradicado')."</TD>";
                  echo "    <TD Class=listar style='background-color: $col_mem;'>".$tm->Value('ca_fchvencimiento')."</TD>";
                  echo "    <TD Class=listar style='background-color: $col_mem;'>".$tm->Value('ca_tipo')."</TD>";
                  echo "  </TR>";
                  $tm->MoveNext();
                
             }
             if ($tit_mem){
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
                    if (!$tm->Open("select * from audit.tb_clientes_audit where $registros order by ca_stamp DESC")) {          // Selecciona todos lo registros de la tabla Eventos de Clientes
                        echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                        //echo "<script>document.location.href = 'clientes.php';</script>";
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

                    if (!$tm->Open("select * from vi_evecliente where $registros")) {          // Selecciona todos lo registros de la tabla Eventos de Clientes
                        echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                        //echo "<script>document.location.href = 'clientes.php';</script>";
                        exit;
                    }
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
                        echo "  <TD WIDTH=200 Class=listar style='letter-spacing:-1px;'>".$tm->Value('ca_compromisos')."<BR>Plazo :".$tm->Value('ca_fchcompromiso')."</TD>";
                        echo "  <TD WIDTH=10 Class=listar style='letter-spacing:-1px;'>&nbsp;</TD>";
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
             if (!$tm->Open("select c.ca_compania, e.ca_idevento, e.ca_asunto from tb_evecliente e inner join vi_clientes c on e.ca_idcliente = c.ca_idcliente where e.ca_idcliente = $id and e.ca_idantecedente=0 order by e.ca_idevento desc")) {       // Selecciona todos lo registros de la tabla Eventos Clientes
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";          // Muestra el mensaje de error
                 //echo "<script>document.location.href = 'clientes.php';</script>";
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
             echo "<FORM METHOD=post NAME='adicionar' ACTION='clientes.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta modificando
             echo "<TABLE CELLSPACING=1>";
             echo "<TH Class=titulo COLSPAN=2><b>".$tm->value("ca_compania")."</b><br/>Datos del Evento</TH>";
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
             echo "  <OPTION VALUE=0>Ninguno - Seguimiento Nuevo</OPTION>";
             $tm->MoveFirst();
             while ( !$tm->Eof()) {
                echo " <OPTION VALUE=".$tm->Value('ca_idevento').">".$tm->Value('ca_asunto')."</OPTION>";
                $tm->MoveNext();
                }
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
        
        
        case 'Libreta': {
             $modulo = "00100300";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
             if (!$rs->Open("select * from vi_clientes_reduc where ca_idcliente = ".$id)) {    // Mueve el apuntador al registro que se desea eliminar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 //echo "<script>document.location.href = 'clientes.php';</script>";
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

             $complemento = (($rs->Value('ca_oficina')!='')?" Oficina : ".$rs->Value('ca_oficina'):"").(($rs->Value('ca_torre')!='')?" Torre : ".$rs->Value('ca_torre'):"").(($rs->Value('ca_interior')!='')?" Interior : ".$rs->Value('ca_interior'):"").(($rs->Value('ca_complemento')!='')?" - ".$rs->Value('ca_complemento'):"").(($rs->Value('ca_zipcode')!='')?" Cod.Postal : ".$rs->Value('ca_zipcode'):"");
             echo "<TR>";
            $img="";
            if($rs->Value('ca_propiedades')!="")
            {
                if(strpos($rs->Value('ca_propiedades'), "cuentaglobal=true") !== false)
                {
                    $img='<img src="/images/CG30.png" title="Cliente de Cuentas Globales" width="20" height="20" />';
                }
                if(strpos($rs->Value('ca_propiedades'), "consolidar_comunicaciones=true") !== false)
                {
                    $img.='<img src="/images/consolidate.png" title="Cliente de Cuadro" width="20" height="20" />';
                }
                
            }
             echo "  <TD WIDTH=500 Class=mostrar COLSPAN=3 style='font-size: 11px; text-align:left;'><B>".( $regional=="PE-051" ?"RUC":"N.i.t.").": </B>".number_format($rs->Value('ca_idcliente'))."-".$rs->Value('ca_digito')."<BR><B>".$rs->Value('ca_compania')."$img <BR>Dirección: </B>".str_replace ("|"," ",$rs->Value('ca_direccion')).$complemento. "&nbsp;&nbsp;<B>Localidad: </B>" . $rs->Value('ca_localidad')."<BR><B>Teléfonos: </B>".$rs->Value('ca_telefonos')."&nbsp;&nbsp;&nbsp;&nbsp;<B>Fax: </B>".$rs->Value('ca_fax')."</TD>";
             echo "</TR>";

             echo "<TR>";
             $z=0;
             $emails = explode(",", $rs->Value('ca_confirmar'));
             for ($i=0; $i<7; $i++){
             	echo "  <TR>";
             	for ($j=0; $j<3; $j++) {
             		$cadena = (strlen($emails[$z])==0)?"&nbsp;":$emails[$z];
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
			 $query.= "		from (select * from vi_clientes_reduc where ca_idcliente = $id) cl ";
			 $query.= "		LEFT OUTER JOIN tb_sdn sdnm ";
			 $query.= "		ON ( fun_similarpercent(cl.ca_compania, textcat(case when sdnm.ca_firstname IS NULL then '' else sdnm.ca_firstname end, case when sdnm.ca_lastname IS NULL then '' else sdnm.ca_lastname end)) >90 ) ";
			 $query.= "		LEFT OUTER JOIN tb_sdnid sdid ";
			 $query.= "		ON ( fun_similarpercent(cl.ca_idcliente::text, sdid.ca_idnumber) >90 ) ";
			 $query.= "		LEFT OUTER JOIN tb_sdnaka sdal ";
			 $query.= "		ON ( fun_similarpercent(cl.ca_compania, textcat(case when sdal.ca_firstname IS NULL then '' else sdal.ca_firstname end, case when sdal.ca_lastname IS NULL then '' else sdal.ca_lastname end)) >90 ) ";
			 $query.= "		LEFT OUTER JOIN tb_sdnaka sdak ";
			 $query.= "		ON ( fun_similarpercent(cl.ca_nombres||' '||cl.ca_papellido||' '||cl.ca_sapellido, textcat(case when sdak.ca_firstname IS NULL then '' else sdak.ca_firstname end, case when sdak.ca_lastname IS NULL then '' else sdak.ca_lastname end)) >90 ) ";
			 $query.= "		LEFT OUTER JOIN tb_ciudades ciu ";
			 $query.= "		ON (cl.ca_idciudad = ciu.ca_idciudad) ";
			 $query.= "		where sdnm.ca_uid IS NOT NULL or sdid.ca_uid IS NOT NULL or sdak.ca_uid IS NOT NULL ";
			 $query.= "     order by cl.ca_vendedor, cl.ca_compania";
			 // echo $query;
             if (!$rs->Open($query)) {    // Mueve el apuntador al registro que se desea Consultar en Lista Clinton
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 //echo "<script>document.location.href = 'clientes.php';</script>";
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
             echo "La siguiente es una relación de <b>SIMILITUDES</b>, halladas entre el cliente consultado y la lista Clinton publicada el ".$dia.' de '.$meses[$mes-1].' de '.$anno.".<br />Tener en cuenta que se compara Número de Nit, Razón Social y Nombre del Representante Legal.<br /><br />";
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
                 //echo "<script>document.location.href = 'clientes.php';</script>";
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
             echo "<TH Class=titulo COLSPAN=4>Información del Cliente</TH>";
             echo "<TR>";
             echo "  <TD Class=mostrar style='vertical-align: top;' ROWSPAN=5>".number_format($rs->Value('ca_idcliente'))."-".$rs->Value('ca_digito')."</TD>";
             
             $img="";
            if($rs->Value('ca_propiedades')!="")
            {
                if(strpos($rs->Value('ca_propiedades'), "cuentaglobal=true") !== false)
                {
                    $img='<img src="/images/CG30.png" title="Cliente de Cuentas Globales" width="20" height="20" />';
                }
                if(strpos($rs->Value('ca_propiedades'), "consolidar_comunicaciones=true") !== false)
                {
                    $img.='<img src="/images/consolidate.png" title="Cliente de Cuadro" width="20" height="20" />';
                }
            }
             echo "  <TD Class=mostrar COLSPAN=3 style='font-size: 12px; font-weight:bold; text-align:left;'>".$rs->Value('ca_compania')." $img </TD>";
             echo "</TR>";
             echo "<TR>";
             $complemento = (($rs->Value('ca_oficina')!='')?" Oficina : ".$rs->Value('ca_oficina'):"").(($rs->Value('ca_torre')!='')?" Torre : ".$rs->Value('ca_torre'):"").(($rs->Value('ca_interior')!='')?" Interior : ".$rs->Value('ca_interior'):"").(($rs->Value('ca_complemento')!='')?" - ".$rs->Value('ca_complemento'):"").(($rs->Value('ca_zipcode')!='')?" Cod.Postal : ".$rs->Value('ca_zipcode'):"");
             echo "  <TD Class=mostrar COLSPAN=3>&nbsp;&nbsp;<B>Dirección : </B>".str_replace ("|"," ",$rs->Value('ca_direccion')).$complemento."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=3>&nbsp;&nbsp;<B>Teléfonos : </B>".$rs->Value('ca_telefonos')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=3>&nbsp;&nbsp;<B>Fax : </B>".$rs->Value('ca_fax')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=3>&nbsp;&nbsp;<B>Ciudad : </B>".$rs->Value('ca_ciudad')."</TD>";
             echo "</TR>";
             echo "<TH Class=titulo COLSPAN=4>Datos para la Liberación Automática</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>No. de Días:&nbsp;&nbsp;&nbsp;</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='diascredito' SIZE=5 VALUE='".$rs->Value('ca_diascredito')."' MAXLENGTH=5></TD>";
             echo "  <TD Class=captura>Periodo de Gracia:&nbsp;&nbsp;&nbsp;</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='fchgracia' SIZE=12 VALUE='" . (($rs->Value('ca_fchgracia')!="")?$rs->Value('ca_fchgracia'):date("Y-m-d")) . "' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Cupo Asignado:&nbsp;&nbsp;&nbsp;</TD>";
             echo "  <TD Class=mostrar COLSPAN=3><INPUT TYPE='TEXT' NAME='cupo' SIZE=15 VALUE='".$rs->Value('ca_cupo')."' MAXLENGTH=12></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura style='vertical-align: top;'>Observaciones:&nbsp;&nbsp;&nbsp;</TD>";
             echo "  <TD Class=mostrar COLSPAN=3><TEXTAREA NAME='observaciones' WRAP=virtual ROWS=5 COLS=58>".$rs->Value('ca_observaciones')."</TEXTAREA></TD>";
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
                 //echo "<script>document.location.href = 'clientes.php';</script>";
                 exit;
                }
             $tm =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
             if (!$tm->Open("select oid as ca_oid, * from tb_comcliente where ca_idcliente = ".$id." and ca_usuanulado is null order by ca_fchfirmado DESC")) {    // Mueve el apuntador al registro que se desea eliminar
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 //echo "<script>document.location.href = 'clientes.php';</script>";
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
             $img="";
            if($rs->Value('ca_propiedades')!="")
            {
                if(strpos($rs->Value('ca_propiedades'), "cuentaglobal=true") !== false)
                {
                    $img='<img src="/images/CG30.png" title="Cliente de Cuentas Globales" width="20" height="20" />';
                }
                if(strpos($rs->Value('ca_propiedades'), "consolidar_comunicaciones=true") !== false)
                {
                    $img.='<img src="/images/consolidate.png" title="Cliente de Cuadro" width="20" height="20" />';
                }
            }
             echo "  <TD Class=mostrar COLSPAN=3 style='font-size: 12px; font-weight:bold; text-align:left;'>".$rs->Value('ca_compania')." $img </TD>";
             echo "</TR>";
             echo "<TR>";
             $complemento = (($rs->Value('ca_oficina')!='')?" Oficina : ".$rs->Value('ca_oficina'):"").(($rs->Value('ca_torre')!='')?" Torre : ".$rs->Value('ca_torre'):"").(($rs->Value('ca_interior')!='')?" Interior : ".$rs->Value('ca_interior'):"").(($rs->Value('ca_complemento')!='')?" - ".$rs->Value('ca_complemento'):"").(($rs->Value('ca_zipcode')!='')?" Cod.Postal : ".$rs->Value('ca_zipcode'):"");
             echo "  <TD Class=mostrar COLSPAN=3>&nbsp;&nbsp;<B>Dirección : </B>".str_replace ("|"," ",$rs->Value('ca_direccion')).$complemento."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=3>&nbsp;&nbsp;<B>Teléfonos : </B>".$rs->Value('ca_telefonos')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=3>&nbsp;&nbsp;<B>Fax : </B>".$rs->Value('ca_fax')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=3>&nbsp;&nbsp;<B>Ciudad : </B>".$rs->Value('ca_ciudad')."</TD>";
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
        case 'Mandato': {
             $modulo = "00100300";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
             if (!$rs->Open("select * from vi_clientes where ca_idcliente = ".$id)) {    // Mueve el apuntador al registro que se desea eliminar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 //echo "<script>document.location.href = 'clientes.php';</script>";
                 exit;
                }
             $cd =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
             if (!$cd->Open("select ca_idciudad, ca_ciudad from vi_ciudades where ca_idtrafico = 'CO-057' and ca_puerto in ('Aéreo','Marítimo','Ambos') order by ca_ciudad")) {    // Mueve el apuntador al registro que se desea eliminar
                 echo "<script>alert(\"".addslashes($cd->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 //echo "<script>document.location.href = 'clientes.php';</script>";
                 exit;
                }
             $tm =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
             if (!$tm->Open("select m.oid as ca_oid, m.*, c.ca_ciudad from tb_mancliente m INNER JOIN tb_ciudades c ON m.ca_idciudad = c.ca_idciudad where ca_idcliente = ".$id." and ca_usuanulado is null order by ca_fchradicado DESC")) {    // Mueve el apuntador al registro que se desea eliminar
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 //echo "<script>document.location.href = 'clientes.php';</script>";
                 exit;
                }
             echo "<HEAD>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
             echo "  if (document.contrato.fchradicado.value >= document.contrato.fchvencimiento.value){";
             echo "      document.contrato.fchradicado.focus();";
             echo "      alert('Error en la Definición de la Vigencia');}";
             echo "  else";
             echo "      return (true);";
             echo "  return (false);";
             echo "}";
             echo "function anular_vigencia(element){";
             echo "  if (confirm(\"¿Esta seguro que desea Anular la Vigencia?\")) {";
             echo "  	document.location.href = 'clientes.php?accion=anular_man\&id=$id\&oid='+element.name;";
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
             echo "<FORM METHOD=post NAME='mandato' ACTION='clientes.php' ONSUBMIT='return validar();'>";  // Llena la forma con los datos actuales del registro
             echo "<TABLE CELLSPACING=1 WIDTH=510>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta eliminando
             echo "<TH Class=titulo COLSPAN=6>Información del Cliente</TH>";
             echo "<TR>";
             echo "  <TD Class=mostrar style='vertical-align: top;' ROWSPAN=5>".number_format($rs->Value('ca_idcliente'))."-".$rs->Value('ca_digito')."</TD>";
             $img="";
            if($rs->Value('ca_propiedades')!="")
            {
                if(strpos($rs->Value('ca_propiedades'), "cuentaglobal=true") !== false)
                {
                    $img='<img src="/images/CG30.png" title="Cliente de Cuentas Globales" width="20" height="20" />';
                }
                if(strpos($rs->Value('ca_propiedades'), "consolidar_comunicaciones=true") !== false)
                {
                    $img.='<img src="/images/consolidate.png" title="Cliente de Cuadro" width="20" height="20" />';
                }
            }
             echo "  <TD Class=mostrar COLSPAN=5 style='font-size: 12px; font-weight:bold; text-align:left;'>".$rs->Value('ca_compania')." $img </TD>";
             echo "</TR>";
             echo "<TR>";
             $complemento = (($rs->Value('ca_oficina')!='')?" Oficina : ".$rs->Value('ca_oficina'):"").(($rs->Value('ca_torre')!='')?" Torre : ".$rs->Value('ca_torre'):"").(($rs->Value('ca_interior')!='')?" Interior : ".$rs->Value('ca_interior'):"").(($rs->Value('ca_complemento')!='')?" - ".$rs->Value('ca_complemento'):"").(($rs->Value('ca_zipcode')!='')?" Cod.Postal : ".$rs->Value('ca_zipcode'):"");
             echo "  <TD Class=mostrar COLSPAN=5>&nbsp;&nbsp;<B>Dirección : </B>".str_replace ("|"," ",$rs->Value('ca_direccion')).$complemento."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=5>&nbsp;&nbsp;<B>Teléfonos : </B>".$rs->Value('ca_telefonos')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=5>&nbsp;&nbsp;<B>Fax : </B>".$rs->Value('ca_fax')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=5>&nbsp;&nbsp;<B>Ciudad : </B>".$rs->Value('ca_ciudad')."</TD>";
             echo "</TR>";
             echo "<TH Class=titulo COLSPAN=6>Histórico Control de Mandatos</TH>";
             echo "<TR>";
             echo "  <TD Class=invertir>Fecha Radicación</TD>";
             echo "  <TD Class=invertir>Fecha Vencimiento</TD>";
             echo "  <TD Class=invertir>Puerto</TD>";
             echo "  <TD Class=invertir>Tipo</TD>";
             echo "  <TD Class=invertir COLSPAN=2>Registro</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='fchradicado' SIZE=12 VALUE='".date("Y-m-d")."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='fchvencimiento' SIZE=12 VALUE='".date("Y-m-d")."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
             echo "  <TD Class=mostrar><SELECT NAME='idciudad'>";
             $che_mem = "SELECTED";
             while ( !$cd->Eof()) {
                echo " <OPTION VALUE='".$cd->Value('ca_idciudad')."' $che_mem>".$cd->Value('ca_ciudad');
                $cd->MoveNext();
                $che_mem = "";
             }
             echo "  </SELECT></TD>";
             echo "  <TD Class=mostrar><SELECT NAME='tipo'>";
             $che_mem = "SELECTED";
             foreach ($mandatos as $mandato) {
                echo " <OPTION VALUE='".$mandato."' $che_mem>".$mandato;
                $che_mem = "";
             }
             echo "  </SELECT></TD>";
             echo "  <TD Class=mostrar COLSPAN=2></TD>";
             echo "</TR>";
             while (!$tm->Eof() and !$tm->IsEmpty()) {
                 echo "<TR>";
                 echo "  <TD Class=mostrar>".$tm->Value('ca_fchradicado')."</TD>";
                 echo "  <TD Class=mostrar>".$tm->Value('ca_fchvencimiento')."</TD>";
                 echo "  <TD Class=mostrar>".$tm->Value('ca_ciudad')."</TD>";
                 echo "  <TD Class=mostrar>".$tm->Value('ca_tipo')."</TD>";
                 echo "  <TD Class=mostrar>".$tm->Value('ca_fchcreado')."<BR>".$tm->Value('ca_usucreado')."</TD>";
                 echo "  <TD Class=mostrar><IMG NAME='".$tm->Value('ca_oid')."' src='graficos/no.gif' alt='Anular la Vigencia de la Carta' ONCLICK='anular_vigencia(this);'></TD>";
                 echo "</TR>";
                 $tm->MoveNext();
             }
             echo "</TABLE><BR>";
             $cadena = "?modalidad=N.i.t.\&criterio=$id";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Nuevo Mandato'></TH>";     // Ordena eliminar el registro de forma permanente
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"clientes.php$cadena\"'></TH>";  // Cancela la operación
             echo "<script>contrato.fchradicado.focus()</script>";
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
                 //echo "<script>document.location.href = 'clientes.php';</script>";
                 exit;
                }
             $tm =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
             if (!$tm->Open("select * from tb_porcentajescomisiones where ca_idcliente = ".$id." order by ca_inicio DESC")) {    // Mueve el apuntador al registro que se desea eliminar
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 //echo "<script>document.location.href = 'clientes.php';</script>";
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
             echo "<TABLE CELLSPACING=1 WIDTH=500>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta eliminando
             echo "<TH Class=titulo COLSPAN=6>Información del Cliente</TH>";
             echo "<TR>";
             echo "  <TD Class=mostrar style='vertical-align: top;' ROWSPAN=5>".number_format($rs->Value('ca_idcliente'))."-".$rs->Value('ca_digito')."</TD>";
             $img="";
            if($rs->Value('ca_propiedades')!="")
            {
                if(strpos($rs->Value('ca_propiedades'), "cuentaglobal=true") !== false)
                {
                    $img='<img src="/images/CG30.png" title="Cliente de Cuentas Globales" width="20" height="20" />';
                }
                if(strpos($rs->Value('ca_propiedades'), "consolidar_comunicaciones=true") !== false)
                {
                    $img.='<img src="/images/consolidate.png" title="Cliente de Cuadro" width="20" height="20" />';
                }
            }
             echo "  <TD Class=mostrar COLSPAN=5 style='font-size: 12px; font-weight:bold; text-align:left;'>".$rs->Value('ca_compania')." $img</TD>";
             echo "</TR>";
             echo "<TR>";
             $complemento = (($rs->Value('ca_oficina')!='')?" Oficina : ".$rs->Value('ca_oficina'):"").(($rs->Value('ca_torre')!='')?" Torre : ".$rs->Value('ca_torre'):"").(($rs->Value('ca_interior')!='')?" Interior : ".$rs->Value('ca_interior'):"").(($rs->Value('ca_complemento')!='')?" - ".$rs->Value('ca_complemento'):"").(($rs->Value('ca_zipcode')!='')?" Cod.Postal : ".$rs->Value('ca_zipcode'):"");
             echo "  <TD Class=mostrar COLSPAN=5>&nbsp;&nbsp;<B>Dirección : </B>".str_replace ("|"," ",$rs->Value('ca_direccion')).$complemento."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=5>&nbsp;&nbsp;<B>Teléfonos : </B>".$rs->Value('ca_telefonos')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=5>&nbsp;&nbsp;<B>Fax : </B>".$rs->Value('ca_fax')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=5>&nbsp;&nbsp;<B>Ciudad : </B>".$rs->Value('ca_ciudad')."</TD>";
             echo "</TR>";
             echo "<TH Class=titulo COLSPAN=6>Histórico de Porcentajes de Comisión</TH>";
             echo "<TR>";
             echo "  <TD Class=invertir>Inicio</TD>";
             echo "  <TD Class=invertir>Fin</TD>";
			 echo "  <TD Class=invertir>Porcentaje</TD>";
             echo "  <TD Class=invertir>Empresa</TD>";
             echo "  <TD Class=invertir>Creación</TD>";
             echo "  <TD Class=invertir>Ult.Modificación</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='inicio' SIZE=12 VALUE='".date("Y-m-d")."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='fin' SIZE=12 VALUE='".date("Y-m-d")."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='porcentaje' SIZE=3 MAXLENGTH=2>%</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='empresa'>";
             while (list ($clave, $val) = each ($empresas)) {
             	echo " <OPTION VALUE='".$val."'>".$val;
             }
             echo "  </SELECT></TD>";
             echo "  <TD Class=mostrar COLSPAN='2'></TD>";
             echo "</TR>";
             while (!$tm->Eof() and !$tm->IsEmpty()) {
                 echo "<TR>";
                 echo "  <TD Class=listar>".$tm->Value('ca_inicio')."</TD>";
                 echo "  <TD Class=listar>".$tm->Value('ca_fin')."</TD>";
				 echo "  <TD Class=listar>".$tm->Value('ca_porcentaje')."</TD>";
				 echo "  <TD Class=listar>".$tm->Value('ca_empresa')."</TD>";
                 echo "  <TD Class=listar>".$tm->Value('ca_fchcreado')."<BR>".$tm->Value('ca_usucreado')."</TD>";
                 echo "  <TD Class=listar>".$tm->Value('ca_fchactualizado')."<BR>".$tm->Value('ca_usuactualizado')."</TD>";
                 echo "</TR>";
                 $tm->MoveNext();
             }
             echo "</TABLE><BR>";
             $cadena = "?modalidad=N.i.t.\&criterio=$id";
             echo "<CENTER><B>Nota: El Sistema revisa automáticamente las fechas y verifica que no se traslapen las fechas,<br />haciendo los ajustes correspondientes. Comisiones por el 10% no se registran por ser el valor por defecto.</B></CENTER>";
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
        case 'Libestados': {
             $modulo = "00100300";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
             if (!$rs->Open("select * from vi_clientes where ca_idcliente = ".$id)) {    // Mueve el apuntador al registro que se desea eliminar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 //echo "<script>document.location.href = 'clientes.php';</script>";
                 exit;
                }
             $tm =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
             if (!$tm->Open("select * from tb_libestados where ca_idcliente = ".$id." order by ca_idlibestado DESC")) {    // Mueve el apuntador al registro que se desea eliminar
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 //echo "<script>document.location.href = 'clientes.php';</script>";
                 exit;
                }
             if ($nivel >= 2){
                 array_push($libestados, "Suspendida");                         // Habilita la posibilidad de dar Suspencion definitiva de Lib.Automaticas a usuarios de alto perfil
             }
             echo "<HEAD>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
             echo "  return (true);";
             echo "}";
             echo "</script>";
             echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
             echo "</HEAD>";
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='libestados' ACTION='clientes.php' ONSUBMIT='return validar();'>";  // Llena la forma con los datos actuales del registro
             echo "<TABLE CELLSPACING=1 WIDTH=500>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta eliminando
             echo "<TH Class=titulo COLSPAN=5>Información del Cliente</TH>";
             echo "<TR>";
             echo "  <TD Class=mostrar style='vertical-align: top;' ROWSPAN=5>".number_format($rs->Value('ca_idcliente'))."-".$rs->Value('ca_digito')."</TD>";
             $img="";
            if($rs->Value('ca_propiedades')!="")
            {
                if(strpos($rs->Value('ca_propiedades'), "cuentaglobal=true") !== false)
                {
                    $img='<img src="/images/CG30.png" title="Cliente de Cuentas Globales" width="20" height="20" />';
                }
                if(strpos($rs->Value('ca_propiedades'), "consolidar_comunicaciones=true") !== false)
                {
                    $img.='<img src="/images/consolidate.png" title="Cliente de Cuadro" width="20" height="20" />';
                }
            }

             echo "  <TD Class=mostrar COLSPAN=4 style='font-size: 12px; font-weight:bold; text-align:left;'>".$rs->Value('ca_compania')." $img</TD>";
             echo "</TR>";
             echo "<TR>";
             $complemento = (($rs->Value('ca_oficina')!='')?" Oficina : ".$rs->Value('ca_oficina'):"").(($rs->Value('ca_torre')!='')?" Torre : ".$rs->Value('ca_torre'):"").(($rs->Value('ca_interior')!='')?" Interior : ".$rs->Value('ca_interior'):"").(($rs->Value('ca_complemento')!='')?" - ".$rs->Value('ca_complemento'):"").(($rs->Value('ca_zipcode')!='')?" Cod.Postal : ".$rs->Value('ca_zipcode'):"");
             echo "  <TD Class=mostrar COLSPAN=4>&nbsp;&nbsp;<B>Dirección : </B>".str_replace ("|"," ",$rs->Value('ca_direccion')).$complemento."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=4>&nbsp;&nbsp;<B>Teléfonos : </B>".$rs->Value('ca_telefonos')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=4>&nbsp;&nbsp;<B>Fax : </B>".$rs->Value('ca_fax')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=4>&nbsp;&nbsp;<B>Ciudad : </B>".$rs->Value('ca_ciudad')."</TD>";
             echo "</TR>";
             echo "<TH Class=titulo COLSPAN=4>Histórico de Estados de Liberación por Cliente</TH>";
             echo "<TR>";
             echo "  <TD Class=invertir>Fecha</TD>";
             echo "  <TD Class=invertir>Estado</TD>";
             echo "  <TD Class=invertir>Observación</TD>";
             echo "  <TD Class=invertir>Registro</TD>";
             echo "</TR>";
             if($rs->Value('ca_fchcreado_lb')!=""){
                 echo "<TR>";
                 echo "  <TD Class=mostrar style='vertical-align: top;'><INPUT TYPE='TEXT' NAME='fchestado' SIZE=12 VALUE='".date("Y-m-d")."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
                 echo "  <TD Class=mostrar style='vertical-align: top;'><SELECT NAME='libestado'>";
                 while (list ($clave, $val) = each ($libestados)) {
                    echo " <OPTION VALUE='".$val."'>".$val;
                 }
                 echo "  </SELECT></TD>";
                 echo "  <TD Class=mostrar><TEXTAREA NAME='observaciones' WRAP=virtual ROWS=4 COLS=58></TEXTAREA></TD>";
                 echo "  <TD Class=mostrar></TD>";
                 echo "</TR>";
             }
             while (!$tm->Eof() and !$tm->IsEmpty()) {
                 echo "<TR>";
                 echo "  <TD Class=listar>".$tm->Value('ca_fchestado')."</TD>";
                 echo "  <TD Class=listar>".$tm->Value('ca_libestado')."</TD>";
                 echo "  <TD Class=listar>".$tm->Value('ca_observaciones')."</TD>";
                 echo "  <TD Class=listar>".$tm->Value('ca_fchcreado')."<BR>".$tm->Value('ca_usucreado')."</TD>";
                 echo "</TR>";
                 $tm->MoveNext();
             }
             echo "</TABLE><BR>";
             $cadena = "?modalidad=N.i.t.\&criterio=$id";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Registrar Estado'></TH>";     // Ordena eliminar el registro de forma permanente
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
                 //echo "<script>document.location.href = 'clientes.php';</script>";
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
             $img="";
            if($rs->Value('ca_propiedades')!="")
            {
                if(strpos($rs->Value('ca_propiedades'), "cuentaglobal=true") !== false)
                {
                    $img='<img src="/images/CG30.png" title="Cliente de Cuentas Globales" width="20" height="20" />';
                }
                if(strpos($rs->Value('ca_propiedades'), "consolidar_comunicaciones=true") !== false)
                {
                    $img.='<img src="/images/consolidate.png" title="Cliente de Cuadro" width="20" height="20" />';
                }
            }
             echo "  <TD Class=mostrar>".$rs->Value('ca_compania')." $img</TD>";
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
             $complemento = (($rs->Value('ca_oficina')!='')?" Oficina : ".$rs->Value('ca_oficina'):"").(($rs->Value('ca_torre')!='')?" Torre : ".$rs->Value('ca_torre'):"").(($rs->Value('ca_interior')!='')?" Interior : ".$rs->Value('ca_interior'):"").(($rs->Value('ca_complemento')!='')?" - ".$rs->Value('ca_complemento'):"").(($rs->Value('ca_zipcode')!='')?" Cod.Postal : ".$rs->Value('ca_zipcode'):"");
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
             echo "  <TD Class=mostrar>Entidad :".$rs->Value('ca_entidad')."</TD>";
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
             if (!$rs->Open("insert into tb_comcliente (ca_idcliente, ca_fchfirmado, ca_fchvencimiento, ca_fchcreado, ca_usucreado) values($id, '$fchfirmado', '$fchvencimiento', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), '$usuario')")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 //echo "<script>document.location.href = 'clientes.php';</script>";
                 exit;
                }
             break;
             }
        case 'Nuevo Mandato': {                                               // El Botón Guardar fue pulsado
             if (!$rs->Open("insert into tb_mancliente (ca_idcliente, ca_fchradicado, ca_fchvencimiento, ca_idciudad, ca_tipo, ca_fchcreado, ca_usucreado) values($id, '$fchradicado', '$fchvencimiento', '$idciudad', '$tipo', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), '$usuario')")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 //echo "<script>document.location.href = 'clientes.php';</script>";
                 exit;
                }
             break;
             }
        case 'Registrar Porcentaje': {                                               // El Botón Guardar fue pulsado
             list($ano, $mes, $dia) = sscanf($inicio, "%d-%d-%d");
             $inicio = date("Y-m-d", mktime(0, 0, 0, $mes, 1, $ano));
             list($ano, $mes, $dia) = sscanf($fin, "%d-%d-%d");
             $fin = date("Y-m-d", mktime(0, 0, 0, $mes+1, 0, $ano));
             
             if (!$rs->Open("select * from tb_porcentajescomisiones where ca_idcliente = $id and ca_empresa = '$empresa' and (ca_inicio between '$inicio' and '$fin' or ca_fin between '$inicio' and '$fin')")) {    // Busca un registro que traslape las fechas
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 //echo "<script>document.location.href = 'clientes.php';</script>";
                 exit;
                }
                
             $comandos = array();
             if ($rs->Value('ca_idcliente') != ""){
                 $ca_inicio = $rs->Value('ca_inicio');
                 $ca_fin = $rs->Value('ca_fin');
                 $ca_empresa = $rs->Value('ca_empresa');
                 $ca_porcentaje = $rs->Value('ca_porcentaje');
                 
                 if ($inicio < $ca_inicio and $porcentaje <> $ca_porcentaje){
                     $comandos[] = ($porcentaje!=10)?"insert into tb_porcentajescomisiones (ca_idcliente, ca_inicio, ca_fin, ca_porcentaje, ca_empresa, ca_fchcreado, ca_usucreado) values($id, '$inicio', '$fin', $porcentaje, '$empresa', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), '$usuario')":null;
                     $comandos[] = "update tb_porcentajescomisiones set ca_inicio = '$fin', ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), ca_usuactualizado = '$usuario' where ca_idcliente = '$id' and ca_empresa = '$empresa' and ca_inicio = '$ca_inicio' and ca_fin = '$ca_fin'";
                 }else if ($inicio < $ca_fin and $porcentaje <> $ca_porcentaje){
                     $comandos[] = ($porcentaje!=10)?"insert into tb_porcentajescomisiones (ca_idcliente, ca_inicio, ca_fin, ca_porcentaje, ca_empresa, ca_fchcreado, ca_usucreado) values($id, '$inicio', '$fin', $porcentaje, '$empresa', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), '$usuario')":null;
                     $comandos[] = "update tb_porcentajescomisiones set ca_fin = '$inicio', ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), ca_usuactualizado = '$usuario' where ca_idcliente = '$id' and ca_empresa = '$empresa' and ca_inicio = '$ca_inicio' and ca_fin = '$ca_fin'";
                 }else if ($inicio > $ca_inicio and $final < $ca_final and $porcentaje <> $ca_porcentaje){
                     $comandos[] = ($porcentaje!=10)?"insert into tb_porcentajescomisiones (ca_idcliente, ca_inicio, ca_fin, ca_porcentaje, ca_empresa, ca_fchcreado, ca_usucreado) values($id, '$inicio', '$fin', $porcentaje, '$empresa', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), '$usuario')":null;
                     $comandos[] = "update tb_porcentajescomisiones set ca_fin = '$inicio', ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), ca_usuactualizado = '$usuario' where ca_idcliente = '$id' and ca_empresa = '$empresa' and ca_inicio = '$ca_inicio' and ca_fin = '$ca_fin'";
                     $comandos[] = "insert into tb_porcentajescomisiones (ca_idcliente, ca_inicio, ca_fin, ca_porcentaje, ca_empresa, ca_fchcreado, ca_usucreado) values($id, '$fin', '$ca_fin', $ca_porcentaje, '$ca_empresa', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), '$usuario')";
                 }
             }else {
                 $comandos[] = ($porcentaje!=10)?"insert into tb_porcentajescomisiones (ca_idcliente, ca_inicio, ca_fin, ca_porcentaje, ca_empresa, ca_fchcreado, ca_usucreado) values($id, '$inicio', '$fin', $porcentaje, '$empresa', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), '$usuario')":null;
             }
             
             foreach ($comandos as $comando) {
                if (!$comando){
                    continue;
                }
                if (!$rs->Open("$comando")) {
                    echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";  // Muestra el mensaje de error
                    //echo "<script>document.location.href = 'clientes.php';</script>";
                    exit;
                }
             }
             /*
             if (!$rs->Open("insert into tb_porcentajescomisiones (ca_idcliente, ca_inicio, ca_fin, ca_porcentaje, ca_empresa, ca_fchcreado, ca_usucreado) values($id, '$inicio', '$fin', $porcentaje, '$empresa', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), '$usuario')")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 //echo "<script>document.location.href = 'clientes.php';</script>";
                 exit;
                } */
             break;
             }
        case 'Registrar Estado': {                                               // El Botón Guardar fue pulsado
             list($ano, $mes, $dia) = sscanf($inicio, "%d-%d-%d");
             $inicio = date("Y-m-d", mktime(0, 0, 0, $mes, 1, $ano));
             if (!$rs->Open("insert into tb_libestados (ca_idcliente, ca_fchestado, ca_libestado, ca_observaciones, ca_fchcreado, ca_usucreado) values($id, '$fchestado', '$libestado', '$observaciones', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), '$usuario')")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 //echo "<script>document.location.href = 'clientes.php';</script>";
                 exit;
                }
             break;
             }
        case 'Actualizar Libreta': {                                               // El Botón Guardar fue pulsado
			 include_once 'include/functions.php';
			 $contactos = (isset($contactos))?implode(",",array_filter($contactos, "vacios")):"";           // Retira las posiciones en blanco del arreglo
             if (!$rs->Open("update tb_clientes set ca_confirmar = '$contactos', ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), ca_usuactualizado = '$usuario' where ca_idcliente = $id")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 //echo "<script>document.location.href = 'clientes.php';</script>";
                 exit;
                }
             break;
             }
        case 'Aprobar Lib.Automática': {                                        // El Botón Guardar fue pulsado
             if (!$rs->Open("select ca_idcliente from tb_libcliente where ca_idcliente = $id")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 //echo "<script>document.location.href = 'clientes.php';</script>";
                 exit;
                }
             if ($rs->GetRowCount() == 0){
                 if (!$rs->Open("insert into tb_libcliente (ca_idcliente, ca_diascredito, ca_cupo, ca_fchgracia, ca_observaciones, ca_fchcreado, ca_usucreado) values($id, $diascredito, $cupo, '$fchgracia', '".addslashes($observaciones)."', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), '$usuario')")) {
                     echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                     //echo "<script>document.location.href = 'clientes.php';</script>";
                     exit;
                    }
             }else{
                 if (!$rs->Open("update tb_libcliente set ca_diascredito = $diascredito, ca_cupo = $cupo, ca_fchgracia = '$fchgracia', ca_observaciones = '".addslashes($observaciones)."', ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), ca_usuactualizado = '$usuario' where ca_idcliente = $id")) {
                     echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                     //echo "<script>document.location.href = 'clientes.php';</script>";
                     exit;
                    }
             }
             break;
             }
        case 'Eliminar Aprobación': {                                           // El Botón Guardar fue pulsado
             if (!$rs->Open("delete from tb_libcliente where ca_idcliente = $id")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 //echo "<script>document.location.href = 'clientes.php';</script>";
                 exit;
                }
             break;
             }
        case 'Registrar': {                                                      // El Botón Guardar fue pulsado
             $fchEvento = date('Y-m-d H:i:s');
             list($ano, $mes, $dia) = sscanf($fchcompromiso, "%d-%d-%d");
             $fchVencimiento = date('Y-m-d H:i:s', mktime(23, 59, 59, $mes, $dia, $ano));
             
             if (!$rs->Open("insert into tb_evecliente (ca_idcliente, ca_fchevento, ca_tipo, ca_asunto, ca_detalle, ca_compromisos, ca_fchcompromiso, ca_idantecedente, ca_usuario) values($id, '$fchEvento', '$tipo', '".addslashes($asunto)."', '".addslashes($detalle)."', '".addslashes($compromisos)."', '$fchcompromiso', '$idantecedente', '$usuario')")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 //echo "<script>document.location.href = 'clientes.php';</script>";
                 exit;
                }
             
             $tm =& DlRecordset::NewRecordset($conn);
             if ($idantecedente != 0){
                if (!$tm->Open("select ca_asunto, ca_fchevento from tb_evecliente where ca_idevento = $idantecedente")) {
                    echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    //echo "<script>document.location.href = 'clientes.php';</script>";
                    exit;
                    }
                if (!$rs->Open("update notificaciones.tb_tareas set ca_fchterminada = '$fchEvento', ca_usuterminada = '$usuario' where ca_titulo = '".$tm->Value("ca_asunto")." - ".$tm->Value("ca_fchevento")."' and ca_fchcreado = '".$tm->Value("ca_fchevento")."'")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    //echo "<script>document.location.href = 'clientes.php';</script>";
                    exit;
                    }
             }elseif ($fchcompromiso > date('Y-m-d')){
                if (!$tm->Open("select nextval('notificaciones.tb_tareas_id') as ca_idtarea")) {
                    echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    //echo "<script>document.location.href = 'clientes.php';</script>";
                    exit;
                    }
                $idtarea = $tm->Value('ca_idtarea');

                if (!$tm->Open("select ca_idlistatarea, ca_descripcion from notificaciones.tb_listatareas where ca_idlistatarea = 9")) {
                    echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    //echo "<script>document.location.href = 'clientes.php';</script>";
                    exit;
                    }

                if (!$rs->Open("insert into notificaciones.tb_tareas (ca_idtarea, ca_idlistatarea, ca_url, ca_titulo, ca_texto, ca_fchvisible, ca_fchvencimiento, ca_fchcreado, ca_usucreado) values ($idtarea, ".$tm->Value('ca_idlistatarea').", '/colsys_php/clientes.php?modalidad=idcliente&criterio=$id', '$asunto - $fchEvento', '".$tm->Value('ca_descripcion')."', '$fchcompromiso', '$fchVencimiento', '$fchEvento', '$usuario')")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    //echo "<script>document.location.href = 'clientes.php';</script>";
                    exit;
                    }

                if (!$rs->Open("insert into notificaciones.tb_tareas_asignaciones (ca_idtarea, ca_login) values ($idtarea, '$usuario')")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    //echo "<script>document.location.href = 'clientes.php';</script>";
                    exit;
                    }
                 }
             break;
             }
        
        case 'Liberar': {                                                   // El Botón Actualizar fue pulsado
             if (!$rs->Open("update tb_clientes set ca_vendedor = null, ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), ca_usuactualizado = '$usuario' where ca_idcliente = $id")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 //echo "<script>document.location.href = 'clientes.php';</script>";
                 exit;
                }
             break;
             }
        case 'Eliminar': {                                                     // El Botón Eliminar fue pulsado
             if (!$rs->Open("delete from tb_clientes where ca_idcliente = $id")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 //echo "<script>document.location.href = 'clientes.php';</script>";
                 exit;
                }
             break;
             }
        case 'anular_vig': {                                                     // Anula una Vigencia de Carta de Garantía de un Cliente
             if (!$rs->Open("update tb_comcliente set ca_usuanulado = '$usuario', ca_fchanulado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss') where oid = $oid")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 //echo "<script>document.location.href = 'clientes.php';</script>";
                 exit;
                }
             break;
             }
        case 'anular_man': {                                                     // Anula una Vigencia de Carta de Garantía de un Cliente
             if (!$rs->Open("update tb_mancliente set ca_usuanulado = '$usuario', ca_fchanulado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss') where oid = $oid")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 //echo "<script>document.location.href = 'clientes.php';</script>";
                 exit;
                }
             break;
             }
        }
   $cadena = "";
   if(isset($id) and $accion == 'anular_vig') {
      $cadena = "?boton=Contrato\&id=$id";
   } else if(isset($id) and $accion == 'Registrar Porcentaje'){
      $cadena = "?boton=Comisión\&id=$id";
   } else if(isset($id) and $accion != 'Eliminar'){
      $cadena = "?modalidad=N.i.t.\&criterio=$id";
   }
   echo "<script>document.location.href = 'clientes.php$cadena';</script>";  // Retorna a la pantalla principal de la opción
 }
?>
