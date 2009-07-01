<?php
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       cotizaciones_new.php                                        \\
// Creado:        2004-04-21                                                  \\
// Autor:         Carlos Gilberto López M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-04-21                                                  \\
//                                                                            \\
// Descripción:   Módulo para la creación de cotizaciones.                    \\
//                                                                            \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/

$programa = 13;

$titulo = 'Sistema de Cotizaciones';
$imporexpor = array("Importación","Exportación");                              // Arreglo con los tipos de Trayecto
$transportes= array("Aéreo","Marítimo","Terrestre");                          // Arreglo con los tipos de Transportes
$modalidades= array("CONSOLIDADO","DIRECTO","LCL","FCL","COLOADING");          // Arreglo con los tipos de Modalidades de Carga
$tincoterms = array("EXW - EX Works","FCA - Free Carrier","FAS - Free Alongside Ship","FOB - Free On Board","CIF - Cost, Insuarance & Freight", "CIP - Carriage and Insurence Paid", "CPT - Carriage Paid To", "CFR - Cost and Freight", "DDP - Delivered Duty Paid", "DDU - Delivered Duty Unpaid", "DAF - Delivered at Frontier"); // Arreglo con los términos Iconterms
$campos = array("Mis Cotizaciones"=>"c.ca_usuario", "Nombre del Cliente"=>"c.ca_compania", "Nombre del Contacto"=>"c.ca_ncompleto_cn", "Asunto"=>"c.ca_asunto", "Por Vendedor"=>"c.ca_vendedor", "Nro.de Cotización"=>"c.ca_idcotizacion");  // Arreglo con los criterios de busqueda

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta
 

$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!isset($boton) and !isset($accion)){
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
	echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
	echo "function elegir(opcion, id){";
	echo "    document.location.href = 'cotizaciones_new.php?boton='+opcion+'\&id='+id;";
	echo "}";
	echo "</script>";
    echo "</HEAD>";
    echo "<BODY style='margin-top: 0px; margin-bottom: 0px; margin-left: 0px; margin-right: 0px; text-align: right; font-size: 11px; font-weight:bold;'>";
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<H3>$titulo</H3>";
    echo "<FORM METHOD=post NAME='findCotizacion' ACTION='cotizaciones_new.php'>";
    echo "<TABLE WIDTH=450 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
    echo "<TH COLSPAN=3 style='font-size: 12px; font-weight:bold;'><B>Ingrese un criterio para realizar las busqueda</TH>";
	echo "<TH>&nbsp;</TH>";  // Botón para la creación de un Registro Nuevo
    echo "<TR>";
    echo "  <TH ROWSPAN=2>&nbsp</TH>";
    echo "  <TD Class=listar ROWSPAN=2><B>Buscar por:</B><BR><SELECT NAME='modalidad' SIZE=6>";
    while (list ($clave, $val) = each ($campos)) {
         echo " <OPTION VALUE='$clave'";
         if ($clave == 'Mis Cotizaciones') {
             echo " SELECTED";
             }
         echo ">$clave";
        }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar><B>Que contenga la cadena:</B><BR><INPUT TYPE='text' NAME='criterio' size='60'></TD>";
    echo "  <TH ROWSPAN=2><INPUT Class=submit TYPE='SUBMIT' NAME='boton' VALUE='  Buscar  '></TH>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=listar>";
    echo "  </TD>";
    echo "</TR>";
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=captura COLSPAN=4></TD>";
    echo "</TR>";
    echo "</TABLE>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cerrar' ONCLICK='javascript:document.location.href = \"/\"'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
    //   echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
echo "</BODY>";
    echo "</HTML>";
    }
elseif (isset($boton)) {                                                       // Switch que evalua cual botòn de comando fue pulsado por el usuario
    switch(trim($boton)) {
        case 'Buscar':{
             $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                                      // Control de Acceso al módulo
             $criterio = ($modalidad == "Mis Cotizaciones")?$usuario:$criterio;
             if (isset($criterio) and strlen($criterio)>0) {
                 $condicion= "lower($campos[$modalidad]) like lower('%".$criterio."%')"; }

			 if (!$rs->Open("select c.ca_idcotizacion, c.ca_fchcotizacion, c.ca_compania, c.ca_ncompleto_cn, c.ca_asunto, c.ca_usuario, c.ca_vendedor, p.ca_producto, p.ca_impoexpo, p.ca_transporte, p.ca_modalidad, c1.ca_ciudad as ca_ciuorigen, c2.ca_ciudad as ca_ciudestino, ca_consecutivo from vi_cotizaciones c LEFT OUTER JOIN tb_cotproductos p on (c.ca_idcotizacion = p.ca_idcotizacion) LEFT OUTER JOIN tb_ciudades c1 on (p.ca_origen = c1.ca_idciudad) LEFT OUTER JOIN tb_ciudades c2 on (p.ca_destino = c2.ca_idciudad) where $condicion")) {          // Selecciona todos lo registros de la tabla Grupos
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";                   // Muestra el mensaje de error
                 echo "<script>document.location.href = 'entrada.php';</script>";
                 exit; }
             echo "<HTML>";
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
             echo "function elegir(opcion, id){";
             echo "    document.location.href = 'cotizaciones_new.php?boton='+opcion+'\&id='+id;";
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
             echo "<FORM METHOD=post NAME='cabecera' ACTION='cotizar.php'>";            // Hace una llamado nuevamente a este script pero con
             echo "<TABLE WIDTH=650 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
             echo "<TR>";
             echo "  <TH Class=titulo COLSPAN=5>SISTEMA DE COTIZACIONES<BR>$titulo</TH>";
             echo "</TR>";
             echo "<TH>No.</TH>";
             echo "<TH>Cotización</TH>";
             echo "<TH>&nbsp;</TH>";  // Botón para la creación de un Registro Nuevo
			 $cot_mem = 0;
			 $pie_mem = false;
             while (!$rs->Eof() and !$rs->IsEmpty()) {                           // Lee la totalidad de los registros obtenidos en la instrucción Select
			 	if ($rs->Value('ca_idcotizacion') != $cot_mem){
					echo "<TR style='background:F0F0F0' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='elegir(\"Consultar\", ".$rs->Value('ca_idcotizacion').");'>";
					echo "  <TD style='text-align:left; vertical-align:top;'>".$rs->Value('ca_idcotizacion')."</TD>";
					echo "  <TD><TABLE WIDTH=100% CELLSPACING=1>";
					echo "  <TR>";
					echo "    <TD class=listar WIDTH=70>".$rs->Value('ca_fchcotizacion')."</TD>";
					echo "    <TD class=listar WIDTH=200 COLSPAN=2>".$rs->Value('ca_compania')."</TD>";
					echo "    <TD class=listar WIDTH=200 COLSPAN=2>".$rs->Value('ca_ncompleto_cn')."</TD>";
					echo "  </TR>";
					$pie_mem = true;
					}
				echo "  <TR>";
                echo "    <TD class=listar>".$rs->Value('ca_impoexpo')."</TD>";
                echo "    <TD class=listar>".$rs->Value('ca_transporte')."</TD>";
                echo "    <TD class=listar>".$rs->Value('ca_ciuorigen')."</TD>";
                echo "    <TD class=listar>".$rs->Value('ca_ciudestino')."</TD>";
                echo "    <TD class=listar>".$rs->Value('ca_modalidad')."</TD>";
				echo "  </TR>";
				echo "  <TR>";
                echo "    <TD class=listar COLSPAN=2>".$rs->Value('ca_asunto')."</TD>";
                echo "    <TD class=listar COLSPAN=3>".$rs->Value('ca_producto')."</TD>";
				echo "  </TR>";
                $rs->MoveNext();
			 	if ($rs->Value('ca_idcotizacion') != $cot_mem and $pie_mem){
					echo "  </TABLE></TD>";
					echo "  <TD></TD>";
					echo "</TR>";
					echo "<TR HEIGHT=5>";
					echo "  <TD Class=invertir COLSPAN=5></TD>";
					echo "</TR>";
					}
                }
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Cancelar' ONCLICK='javascript:location.href = \"cotizaciones_new.php\"'></TH>";  // Cancela la operación
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
             require_once("footer.php");
echo "</BODY>";
             echo "</HTML>";
             break;
             }
        case 'Consultar': {                                                    // Opcion para Consultar Registros a la tabla
             $modulo = "00100100";                                             // Identificación del módulo para la ayuda en línea
			 echo "<script >document.location='cotizaciones_new.php?boton=Imprimir&id=".$id."&pr=0'</script>";
			 
             if (!$rs->Open("select * from vi_cotizaciones where ca_idcotizacion = ".$id)) {    // Mueve el apuntador al registro que se desea consultar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
                 exit;
                }
             $pr =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
             if (!$pr->Open("select * from vi_cotproductos where ca_idcotizacion = ".$id)) {    // Mueve el apuntador al registro que se desea consultar
                 echo "<script>alert(\"".addslashes($pr->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
                 exit;
                }
			 $op =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
			 if (!$op->Open("select * from vi_cotopciones where ca_idcotizacion = ".$id)) {       // Selecciona todos lo registros de la tabla Conceptos
                 echo "<script>alert(\"".addslashes($op->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
                 exit; }
             $rc =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
             if (!$rc->Open("select * from vi_cotrecargos where ca_generado = 'Recargo en Origen' and ca_idcotizacion = ".$id)) {    // Mueve el apuntador al registro que se desea consultar
                 echo "<script>alert(\"".addslashes($rc->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
                 exit;
                }
             $visible = ($rs->Value('ca_usuario')== $usuario or $nivel >= 1)?'visible':'hidden';
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
             echo "function elegir(opcion, id, pr){";
             echo "    document.location.href = 'cotizaciones_new.php?boton='+opcion+'\&id='+id+'\&pr='+pr;";
             echo "}";
             echo "</script>";
             echo "</HEAD>";

             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='consultar' ACTION='cotizaciones_new.php'>"; // Crea una forma con datos vacios
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";                 // Hereda el Id del registro que se esta modificando
             echo "<TABLE CELLSPACING=1 WIDTH=530>";
			 datos_basicos($rs, 1);
             echo "<TR>";
             echo "  <TD Class=invertir COLSPAN=3>";
             echo "    <TABLE CELLSPACING=1 WIDTH=650>";
             echo "      <TR><TH Class=titulo COLSPAN=7>Relación de Productos a Transportar</TH><TR>";
             echo "      <TH Class=titulo>Impo/Expo</TH>";
             echo "      <TH Class=titulo>Transporte</TH>";
             echo "      <TH Class=titulo>Origen</TH>";
             echo "      <TH Class=titulo>Destino</TH>";
			 echo "      <TH Class=titulo>Contactos</TH>";
             echo "      <TH Class=titulo WIDTH=18><IMG style='visibility: $visible;' src='./graficos/master.gif' alt='Ver Definición de Productos' border=0 onclick='elegir(\"Productos\", $id, 0);'></TH>";
             $num_pro = 0;
             while (!$pr->Eof() and !$pr->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
                if ($pr->Value('ca_idproducto') != $num_pro) {
                    echo "   <TR>";
                    echo "    <TD Class=destacar COLSPAN=5><B>Producto :</B><BR>".$pr->Value('ca_producto')." «Imprimir por ".$pr->Value('ca_imprimir')."»</TD>";
                    echo "    <TD Class=destacar style='text-align:center; vertical-align:top;'><IMG style='visibility: $visible;' src='./graficos/master.gif' alt='Ver Definición de Productos' border=0 onclick='elegir(\"Productos\", $id, 0);'></TD>";  // Botón para la creación de un Registro Nuevo
                    echo "   </TR>";
                    $num_pro = $pr->Value('ca_idproducto');
                    }
                echo "   <TR>";
                echo "    <TD Class=listar><B>".$pr->Value('ca_impoexpo')."</B><BR>".$pr->Value('ca_modalidad')."</TD>";
                echo "    <TD Class=listar><B>".$pr->Value('ca_transporte')."</B><BR>".$pr->Value('ca_incoterms')."</TD>";
                echo "    <TD Class=listar style='text-align:center;'><B>".$pr->Value('ca_ciuorigen')."</B><BR>".$pr->Value('ca_traorigen')."</TD>";
                echo "    <TD Class=listar style='text-align:center;'><B>".$pr->Value('ca_ciudestino')."</B><BR>".$pr->Value('ca_tradestino')."</TD>";
                echo "    <TD Class=listar>".str_replace ("|","<BR>",$pr->Value('ca_nombresag'))."</TD>";
                echo "    <TD Class=listar style='text-align:center;'><IMG style='visibility: $visible;' src='./graficos/contacto.gif'  alt='ContactosPr' border=0 onclick='elegir(\"ContactosPr\", $id, ".$pr->Value('ca_idproducto').", 0);'></TD>";
                echo "   </TR>";

                echo "<TR>";
                echo "  <TD Class=invertir style='background-color:FFFFFF;' COLSPAN=5><TABLE WIDTH=100% CELLSPACING=0>";
				echo "  <TR>";
				echo "    <TD Class=mostrar COLSPAN=6 style='text-align:center; font-weight:bold;'>OPCIONES A COTIZAR</TD>";
				echo "    <TD Class=invertir COLSPAN=2><B>Frecuencia:</B> ".$pr->Value('ca_frecuencia')."</TD>";
				echo "    <TD Class=invertir COLSPAN=2><B>T.Transito:</B> ".$pr->Value('ca_tiempotransito')."</TD>";
				echo "  </TR>";
				
				echo "<TR>";
				echo "  <TH COLSPAN=5>Fletes</TH>";
				echo "  <TH COLSPAN=5>Recargos en Origen</TH>";
				echo "</TR>";
				$op->MoveFirst();
				$impr_tit = true;
				while (!$op->Eof() and !$op->IsEmpty()) {
					if ($pr->Value('ca_idproducto') != $op->Value('ca_idproducto')){
						$op->MoveNext();
						continue; 
						}
					$aflete = explode('|',$op->Value('ca_oferta'));
					echo "<TR>";
					echo "  <TD Class=invertir COLSPAN=6><TABLE WIDTH=350 CELLSPACING=1>";
					if ($impr_tit) {
						echo "<TR>";
						echo "  <TH WIDTH=100>Concepto</TH>";
						echo "  <TH WIDTH=50>Flete</TH>";
						echo "  <TH WIDTH=50>Mín.</TH>";
						echo "  <TH WIDTH=25>Mnd</TH>";
						echo "  <TH WIDTH=80>Detalles</TH>";
						echo "</TR>"; 
					}
					echo "    <TR>";
					echo "      <TD Class=mostrar WIDTH=100 style='vertical-align=top; text-align: left'>".$op->Value('ca_concepto').((strlen($aflete[2])!=0?" <IMG src='graficos/admira.gif' alt='".$aflete[2]."'>":""))."</TD>";
					echo "      <TD Class=mostrar WIDTH=50 style='vertical-align=top; text-align: left'>".$aflete[0]."</TD>";
					echo "      <TD Class=mostrar WIDTH=50 style='vertical-align=top; text-align: left'>".$aflete[1]."</TD>";
					echo "      <TD Class=mostrar WIDTH=25 style='vertical-align=top; text-align: left'>".$op->Value('ca_idmoneda')."</TD>";
					echo "      <TD Class=mostrar WIDTH=80 style='vertical-align=top; text-align: left'>".$op->Value('ca_observaciones')."</TD>";
					echo "    </TR>";
					echo "  </TABLE></TD>";
					echo "  <TD Class=invertir COLSPAN=4><TABLE WIDTH=320 CELLSPACING=0>";
					if ($impr_tit) {
						echo "<TR>";
						echo "  <TH WIDTH=110>Recargo</TH>";
						echo "  <TH WIDTH=50>Valor</TH>";
						echo "  <TH WIDTH=25>Mín.</TH>";
						echo "  <TH WIDTH=80>Detalles</TH>";
						echo "</TR>";
						$impr_tit = false;
					}
					$rc->MoveFirst();
					while (!$rc->Eof() and !$rc->IsEmpty()) {
						if ($op->Value('ca_idproducto') != $rc->Value('ca_idproducto') or $op->Value('ca_idopcion') != $rc->Value('ca_idopcion')){
							$rc->MoveNext();
							continue; 
							}
						echo "    <TR>";
						echo "      <TD Class=mostrar WIDTH=110 style='vertical-align=top; text-align: left'>".$rc->Value('ca_recargo')."</TD>";
						echo "      <TD Class=mostrar WIDTH=5 style='vertical-align=top; text-align: left'>".$rc->Value('ca_tipo')."</TD>";
						echo "      <TD Class=mostrar WIDTH=50 style='vertical-align=top; text-align: left'>".$rc->Value('ca_valor_tar')." ".$rc->Value('ca_aplica_tar')."</TD>";
						echo "      <TD Class=mostrar WIDTH=50 style='vertical-align=top; text-align: left'>".$rc->Value('ca_valor_min')." ".$rc->Value('ca_aplica_min')."</TD>";
						echo "      <TD Class=mostrar WIDTH=25 style='vertical-align=top; text-align: left'>".$rc->Value('ca_idmoneda')."</TD>";
						echo "      <TD Class=mostrar WIDTH=80 style='vertical-align=top; text-align: left'>".$rc->Value('ca_observaciones')."</TD>";
						echo "    </TR>";
						$rc->MoveNext();
						}
					echo "  </TABLE></TD>";
					echo "</TR>";
					$op->MoveNext();
				}
				
				echo "<TR HEIGHT=5>";
				echo "  <TD Class=titulo COLSPAN=10></TD>";
				echo "</TR>";
				
				echo "<TR>";
				echo "  <TD Class=valores COLSPAN=4 style='font-weight:bold;'>".strtoupper($rc->Value('ca_generado'))." - GENERAL</TD>";
				echo "  <TD Class=invertir COLSPAN=6><TABLE WIDTH=100% CELLSPACING=1>";
				$rc->MoveFirst();
				while (!$rc->Eof() and !$rc->IsEmpty()) {
					if ($rc->Value('ca_idproducto') != $num_pro or $rc->Value('ca_idopcion') != 999 or $rc->Value('ca_idconcepto') != 9999 or $rc->Value('ca_generado') != 'Recargo en Origen'){
						$rc->MoveNext();
						continue; 
						}
					echo "    <TR>";
					echo "      <TD Class=mostrar WIDTH=110 style='vertical-align=top; text-align: left'>".$rc->Value('ca_recargo')."</TD>";
					echo "      <TD Class=mostrar WIDTH=5 style='vertical-align=top; text-align: left'>".$rc->Value('ca_tipo')."</TD>";
					echo "      <TD Class=mostrar WIDTH=50 style='vertical-align=top; text-align: left'>".$rc->Value('ca_valor_tar')." ".$rc->Value('ca_aplica_tar')."</TD>";
					echo "      <TD Class=mostrar WIDTH=50 style='vertical-align=top; text-align: left'>".$rc->Value('ca_valor_min')." ".$rc->Value('ca_aplica_min')."</TD>";
					echo "      <TD Class=mostrar WIDTH=25 style='vertical-align=top; text-align: left'>".$rc->Value('ca_idmoneda')."</TD>";
					echo "      <TD Class=mostrar WIDTH=80 style='vertical-align=top; text-align: left'>".$rc->Value('ca_observaciones')."</TD>";
					echo "    </TR>";
					$rc->MoveNext();
				}
				echo "  </TABLE></TD>";
				echo "</TR>";
				echo "  </TABLE></TD>";
                echo "  <TD Class=listar style='text-align:center; vertical-align:top;'><IMG style='visibility: $visible;' src='./graficos/details.gif' alt='Ver Opciones a Cotizar' border=0 onclick='elegir(\"Opciones\", $id, ".$pr->Value('ca_idproducto').");'></TD>";  // Botón para la creación de un Registro Nuevo
                echo "</TR>";
                if ($pr->Value('ca_observaciones') != '') {
                    echo "   <TR>";
                    echo "    <TD Class=invertir><B>Observaciones Generales:</B></TD>";
                    echo "    <TD Class=invertir COLSPAN=6>".nl2br($pr->Value('ca_observaciones'))."</TD>";
                    echo "   </TR>";
                    }
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=divisor COLSPAN=7></TD>";
                echo "</TR>";
                $pr->MoveNext();
                }
            echo "    </TABLE>";
            echo "  </TD>";
            echo "</TR>";

			$tm =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
			if (!$tm->Open("select * from vi_cotrecargos where ca_idcotizacion = $id and ca_generado = 'Recargo Local'")) {       // Selecciona todos lo registros de la tabla Continuaciones
				echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
				echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
				exit; }
			$tm->MoveFirst();
            echo "<TR>";
            echo "  <TD Class=captura style='vertical-align:top;'>Rec. Locales:</TD>";
            echo "  <TD Class=invertir><TABLE WIDTH=100% CELLSPACING=1>";
			$tra_mem = '';
			$mod_mem = '';
			while (!$tm->Eof() and !$tm->IsEmpty()) {
				if ($tm->Value('ca_transporte') != $tra_mem or $tm->Value('ca_modalidad') != $mod_mem){
					echo "<TR>";
					echo "  <TD Class=invertir style='vertical-align=top; text-align: left' COLSPAN=8><B>".strtoupper($tm->Value('ca_transporte'))." - ".$tm->Value('ca_modalidad')."</B></TD>";
					echo "</TR>";
					$tra_mem = $tm->Value('ca_transporte');
					$mod_mem = $tm->Value('ca_modalidad');
				}
				echo "<TR>";
				echo "  <TD Class=mostrar style='vertical-align=top; text-align: left'><B>Recargo:</B><BR>".$tm->Value('ca_recargo')."</TD>";
				echo "  <TD Class=mostrar style='vertical-align=top; text-align: left'><B>Tipo:</B><BR>".$tm->Value('ca_tipo')."</TD>";
				echo "  <TD Class=mostrar style='vertical-align=top; text-align: left'><B>Mnd:</B><BR>".$tm->Value('ca_idmoneda')."</TD>";
				echo "  <TD Class=mostrar style='vertical-align=top; text-align: left'><B>Valor:</B><BR>".$tm->Value('ca_valor_tar')."</TD>";
				echo "  <TD Class=mostrar style='vertical-align=top; text-align: left'><B>Aplica:</B><BR>".$tm->Value('ca_aplica_tar')."</TD>";
				echo "  <TD Class=mostrar style='vertical-align=top; text-align: left'><B>Mínimo:</B><BR>".$tm->Value('ca_valor_min')."</TD>";
				echo "  <TD Class=mostrar style='vertical-align=top; text-align: left'><B>Por:</B><BR>".$tm->Value('ca_aplica_min')."</TD>";
				echo "  <TD Class=mostrar style='vertical-align=top; text-align: left'><B>Observaciones:</B><BR>".$tm->Value('ca_observaciones')."</TD>";
				echo "</TR>";
				$tm->MoveNext();
			}
			echo "  </TABLE></TD>";
            echo "  <TD Class=listar><CENTER><IMG src='./graficos/details.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(\"RecargosLoc\", $id);'></CENTER></TD>";
            echo "</TR>";

			if (!$tm->Open("select * from vi_cotcontinuacion where ca_idcotizacion = $id")) {       // Selecciona todos lo registros de la tabla Continuaciones
				echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
				echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
				exit; }
			$tm->MoveFirst();
            echo "<TR>";
            echo "  <TD Class=captura style='vertical-align:top;'>OTM/DTA:</TD>";
            echo "  <TD Class=invertir><TABLE WIDTH=100% CELLSPACING=1>";
			while (!$tm->Eof() and !$tm->IsEmpty()) {
				$aflete = explode('|',$tm->Value('ca_tarifa'));
				echo "<TR>";
				echo "  <TD Class=mostrar style='vertical-align=top; text-align: left' COLSPAN=2><B>Tránsito:</B><BR>".$tm->Value('ca_ciuorigen')." » ".$tm->Value('ca_ciudestino')." (".$tm->Value('ca_tipo').")</TD>";
				echo "  <TD Class=mostrar style='vertical-align=top; text-align: left'><B>Concepto:</B><BR>".$tm->Value('ca_concepto')."</TD>";
				echo "  <TD Class=mostrar style='vertical-align=top; text-align: left'><B>Equipo:</B><BR>".$tm->Value('ca_equipo')."</TD>";
				echo "  <TD Class=mostrar style='vertical-align=top; text-align: left'><B>Flete:</B><BR>".$aflete[0]."</TD>";
				echo "  <TD Class=mostrar style='vertical-align=top; text-align: left'><B>Mínimo:</B><BR>".$aflete[1]."</TD>";
				echo "  <TD Class=mostrar style='vertical-align=top; text-align: left'><B>Mnd:</B><BR>".$tm->Value('ca_idmoneda')."</TD>";
				echo "</TR>";
				echo "<TR>";
				echo "  <TD Class=mostrar style='vertical-align=top; text-align: left'><B>Modalidad:</B><BR>".$tm->Value('ca_modalidad')."</TD>";
				echo "  <TD Class=mostrar style='vertical-align=top; text-align: left'><B>Frecuencia:</B><BR>".$tm->Value('ca_frecuencia')."</TD>";
				echo "  <TD Class=mostrar style='vertical-align=top; text-align: left'><B>T.Tránsito:</B><BR>".$tm->Value('ca_tiempotransito')."</TD>";
				echo "  <TD Class=mostrar style='vertical-align=top; text-align: left' COLSPAN=4><B>Observaciones:</B><BR>".$tm->Value('ca_observaciones')."</TD>";
				echo "</TR>";
				$tm->MoveNext();
				if (!$tm->Eof()){
					echo "<TR HEIGHT=5>";
					echo "  <TD Class=divisor COLSPAN=7></TD>";
					echo "</TR>";
				}
			}
			echo "   </TABLE></TD>";
            echo "  <TD Class=listar><CENTER><IMG src='./graficos/details.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(\"Continuacion\", $id);'></CENTER></TD>";
            echo "</TR>";
            echo "<TR>";
            echo "  <TD Class=captura style='vertical-align:top;'>Seguro:</TD>";
            echo "  <TD Class=invertir><TABLE WIDTH=100% CELLSPACING=1>";
			$tm =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
			if (!$tm->Open("select * from tb_cotseguro where ca_idcotizacion = $id")) {       // Selecciona todos lo registros de la tabla Continuaciones
				echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
				echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
				exit; }
			$tm->MoveFirst();
			while (!$tm->Eof() and !$tm->IsEmpty()) {
				$aprima = explode('|',$tm->Value('ca_prima'));
				echo "<TR>";
				echo "  <TD Class=mostrar style='vertical-align=top; text-align: left'><B>Tipo:</B><BR>".$aprima[0]."</TD>";
				echo "  <TD Class=mostrar style='vertical-align=top; text-align: left'><B>Prima:</B><BR>".$aprima[1]."</TD>";
				echo "  <TD Class=mostrar style='vertical-align=top; text-align: left'><B>Mínimo:</B><BR>".$aprima[2]."</TD>";
				echo "  <TD Class=mostrar style='vertical-align=top; text-align: left'><B>Obtención:</B><BR>".$tm->Value('ca_obtencion')."</TD>";
				echo "  <TD Class=mostrar style='vertical-align=top; text-align: left'><B>Mnd:</B><BR>".$tm->Value('ca_idmoneda')."</TD>";
				echo "  <TD Class=mostrar style='vertical-align=top; text-align: left' WIDTH=280><B>Observaciones:</B><BR>".$tm->Value('ca_observaciones')."</TD>";
				echo "</TR>";
				$tm->MoveNext();
				if (!$tm->Eof()){
					echo "<TR HEIGHT=5>";
					echo "  <TD Class=divisor COLSPAN=7></TD>";
					echo "</TR>";
				}
			 }
			 echo "   </TABLE></TD>";
             echo "  <TD Class=listar><CENTER><IMG src='./graficos/details.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(\"Seguro\", $id);'></CENTER></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura style='vertical-align:top;'>Despedida:</TD>";
             echo "  <TD Class=mostrar>".nl2br($rs->Value('ca_despedida'))."<BR>&nbsp</TD>";
             echo "  <TD Class=mostrar ROWSPAN=2></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Anexos:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_anexos')."<BR>&nbsp</TD>";
             echo "</TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='BUTTON' NAME='boton' VALUE='Generar Cotización'  ONCLICK='elegir(\"Imprimir\", $id, 0);'></TH>";         // Generar Documento en PDF
           //  echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Copiar en Nueva Cotización'></TH>";         // Ordena almacenar los datos ingresados
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"cotizaciones_new.php\"'></TH>";  // Cancela la operación
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
             require_once("footer.php");
echo "</BODY>";
             break;
             }
        case 'Imprimir': {                                                    // Opcion para Consultar un solo registro
             $modulo = "00100100";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "</HEAD>";
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<TABLE CELLSPACING=1 WIDTH='830' HEIGHT='650'>";
             echo "<TR>";
             echo "  <TD Class=invertir><iframe ID=consulta_tar src ='cotizacion_new.php?id=$id' width='100%' height='100%'></iframe></TD>";
             echo "</TR>";
             echo "</TABLE>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"cotizaciones_new.php?boton=Consultar&id=$id\"'></TH>";  // Cancela la operación
             echo "</TABLE>";
             echo "</CENTER>";
             break;
             }
        case 'Adicionar': {                                                    // Opcion para Adicionar Registros a la tabla
             $modulo = "00100100";                                             // Identificación del módulo para la ayuda en línea
             $us =& DlRecordset::NewRecordset($conn);
             $cambiar = ($nivel >= 1)?'':'DISABLED';
             if (!$us->Open("select ca_login, ca_nombre from control.tb_usuarios where ca_login != 'Administrador' and (ca_cargo = 'Gerente Sucursal' or ca_cargo like '%Ventas%' or ca_departamento like '%Ventas%' or ca_departamento like '%Comercial%') order by ca_login")) {
                 echo "<script>alert(\"".addslashes($us->mErrMsg)."\");</script>";
                 echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
                 exit;
                }
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
             echo "  if (!chkDate(document.adicionar.fchcotizacion))";
             echo "      document.adicionar.fchcotizacion.focus();";
             echo "  else if (!chkDate(document.adicionar.fchsolicitud)){";
             echo "      alert('Ingrese la Fecha en que fue solicitada la Cotización por parte del Cliente');";
             echo "      document.adicionar.fchsolicitud.focus()};";
             echo "  else if (document.adicionar.horasolicitud.value == ''){";
             echo "      alert('Ingrese la Hora en que fue solicitada la Cotización por parte del Cliente');";
             echo "      document.adicionar.horasolicitud.focus();}";
             echo "  else if (document.adicionar.idcontacto.value == '')";
             echo "      alert('Debe seleccionar Cliente y Contacto para enviar Cotización');";
             echo "  else if (document.adicionar.asunto.value == '')";
             echo "      alert('Debe redactar texto para el Asunto');";
             echo "  else if (document.adicionar.saludo.value == '')";
             echo "      alert('Debe redactar texto para el Saludo');";
             echo "  else if (document.adicionar.entrada.value == '')";
             echo "      alert('Debe redactar texto para la Entrada');";
             echo "  else if (document.adicionar.despedida.value == '')";
             echo "      alert('Debe redactar texto para la Despedida');";
             echo "  else{";
             echo "      document.getElementById('login').disabled = false;";
             echo "      return (true);";
             echo "      }";
             echo "  return (false);";
             echo "}";
             echo "function uno(src,color_entrada) {";
             echo "    src.style.background=color_entrada;src.style.cursor='hand'";
             echo "}";
             echo "function dos(src,color_default) {";
             echo "    src.style.background=color_default;src.style.cursor='default';";
             echo "}";
             echo "function contactos(ventana, sufijo){";
             echo "  document.body.scroll='no';";
             echo "  frame = document.getElementById(ventana + '_frame');";
             echo "  frame.style.height = document.body.clientHeight-16;";
             echo "  ventana = document.getElementById(ventana);";
             echo "  ventana.style.visibility = 'visible';";
             echo "  ancho = frame.getAttribute('STYLE').width.substring( 0, frame.getAttribute('STYLE').width.indexOf('px') );";
             echo "  alto  = frame.getAttribute('STYLE').height.substring( 0, frame.getAttribute('STYLE').height.indexOf('px') );";
             echo "  ventana.style.left = eval((document.body.clientWidth/2)-(ancho/2));";
             echo "  frame.src='findcontacto.php?suf='+sufijo;";
             echo "}";
             echo "</script>";
             echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
             echo "</HEAD>";

             echo "<BODY ID=Cuerpo onscroll='dalt=document.body.scrollTop+3; find_contacto.style.top=dalt'>";
             echo "<DIV ID='find_contacto' STYLE='visibility:hidden; position:absolute; border-width:3; border-color:#666666; border-style:solid;'>";
             echo "<IFRAME ID='find_contacto_frame' SRC='blanco.html' MARGINWIDTH=0 MARGINHEIGHT=0 FRAMEBORDER='NO' SCROLLING='YES' STYLE='width:645; height:200'>";
             echo "</IFRAME>";
             echo "</DIV>";

             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM ID=main_form METHOD=post NAME='adicionar' ACTION='cotizaciones_new.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
             echo "<TABLE CELLSPACING=1>";
             echo "<TH Class=titulo COLSPAN=2>Nuevos Datos para la Cotización</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Datos de Control:</TD>";
             echo "  <TD Class=invertir><TABLE CELLSPACING=1 WIDTH=100%>";
             echo "  <TD Class=listar>Fecha de Solicitud :<br /><CENTER><INPUT TYPE='TEXT' NAME='fchsolicitud' SIZE=12 VALUE='' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></CENTER></TD>";
			 echo "  <TD Class=listar>Hora de Solicitud Formato 24h:<BR><CENTER>hh:mm:ss <INPUT TYPE='TEXT' NAME='horasolicitud' VALUE='' ONBLUR='CheckTime(this)' SIZE=9 MAXLENGTH=8> 00-23hrs</CENTER></TD>";
             echo "  <TD Class=listar>Fecha de Cotización :<br /><CENTER><INPUT TYPE='TEXT' NAME='fchcotizacion' SIZE=12 VALUE='".date("Y-m-d")."' READONLY></CENTER></TD>";
             echo "  </TABLE></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <INPUT ID=id_cli TYPE='HIDDEN' NAME='idcontacto'>";
             echo "  <TD Class=titulo style='text-align:left; vertical-align:top;'>Cliente:<BR></TD>";
             echo "  <TD Class=invertir><TABLE CELLSPACING=1 WIDTH=425>";
             echo "  <TR>";
             echo "    <TD Class=mostrar>Nombre:<BR><INPUT ID=nombre_cli READONLY TYPE='TEXT' NAME='cliente[]' SIZE=50 MAXLENGTH=60></TD>";
             echo "    <TD Class=mostrar style='text-align:right;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='contactos(\"find_contacto\",\"_cli\");'><a><IMG src='graficos/lupa.gif' alt='Buscar' hspace='0' vspace='0'> Buscar</a></TD>";
             echo "  </TR>";
             echo "  <TR>";
             echo "    <TD Class=mostrar>Contacto:<BR><INPUT ID=contacto_cli READONLY TYPE='TEXT' NAME='cliente[]' SIZE=50 MAXLENGTH=60></TD>";
             echo "    <TD Class=mostrar>Teléfono:<BR><INPUT ID=telefonos_cli READONLY TYPE='TEXT' NAME='cliente[]' SIZE=23 MAXLENGTH=30></TD>";
             echo "  </TR>";
             echo "  <TR>";
             echo "    <TD Class=mostrar>Dirección:<BR><INPUT ID=direccion_cli READONLY TYPE='TEXT' NAME='cliente[]' SIZE=40 MAXLENGTH=80></TD>";
             echo "    <TD Class=mostrar>Fax:<BR><INPUT ID=fax_cli READONLY TYPE='TEXT' NAME='cliente[]' SIZE=23 MAXLENGTH=30></TD>";
             echo "  </TR>";
             echo "  <TR>";
             echo "    <TD Class=mostrar COLSPAN=2>Correo Electrónico:<BR><INPUT ID=email_cli READONLY TYPE='TEXT' NAME='cliente[]' SIZE=30 MAXLENGTH=40></TD>";
             echo "  </TR>";
             echo "  </TABLE></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Asunto:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='asunto' VALUE=\"COTIZACION\" SIZE=60 MAXLENGTH=255></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Saludo:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='saludo' VALUE=\"Respetados Señores:\" SIZE=82 MAXLENGTH=255></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura style='vertical-align:top;'>Entrada:</TD>";
             echo "  <TD Class=mostrar><TEXTAREA NAME='entrada' WRAP=virtual ROWS=5 COLS=80>Nos  complace  saludarlos,  nos permitimos presentar oferta para el transporte internacional de mercancía no peligrosa ni extradimensionada así :</TEXTAREA></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura style='vertical-align:top;'>Despedida:</TD>";
             echo "  <TD Class=mostrar><TEXTAREA NAME='despedida' WRAP=virtual ROWS=5 COLS=80>Esperamos que esta cotización sea de su conveniencia y quedamos a su entera disposición para atender cualquier inquietud adicional.</TEXTAREA></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Anexos:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='anexos' VALUE=\"Notas importantes para sus importaciones y/o exportaciones.\" SIZE=82 MAXLENGTH=255></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Rep. Comercial:</TD>";
             echo "  <TD Class=mostrar><TABLE WIDTH=100% CELLSPACING=1 BORDER=1>";
             echo "  <TR>";
             echo "    <TD Class=mostrar><SELECT ID=login NAME='vendedor' $cambiar>";
             while (!$us->Eof()) {
                echo"<OPTION VALUE='".$us->Value('ca_login')."'".(($us->Value('ca_login')==$usuario)?" SELECTED":"$cambiar").">".$us->Value('ca_nombre')."</OPTION>";
                $us->MoveNext();
                }
             echo "    </SELECT></TD>";
             echo "    <TD Class=invertir>Elabora: </TD>";
             echo "    <TD Class=invertir><B>$usuario</B></TD>";
             echo "  </TR>";
             echo "  </TABLE></TD>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
            // echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Guardar'></TH>";         // Ordena almacenar los datos ingresados
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"cotizaciones_new.php\"'></TH>";  // Cancela la operación
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
             require_once("footer.php");
echo "</BODY>";
             break;
             }
        case 'Modificar': {                                                    // Opcion para modificar Registros a la tabla
             $modulo = "00100100";                                             // Identificación del módulo para la ayuda en línea
             if (!$rs->Open("select * from vi_cotizaciones where ca_idcotizacion = ".$id)) {    // Mueve el apuntador al registro que se desea modificar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
                 exit;
                }
             $us =& DlRecordset::NewRecordset($conn);
             if (!$us->Open("select ca_login, ca_nombre from control.tb_usuarios where ca_login != 'Administrador' and (ca_cargo = 'Gerente Sucursal' or ca_cargo like '%Ventas%' or ca_departamento like '%Ventas%' or ca_departamento like '%Comercial%') order by ca_login")) {
                 echo "<script>alert(\"".addslashes($us->mErrMsg)."\");</script>";
                 echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
                 exit;
                }
             $cambiar = ($nivel >= 1)?'':'DISABLED';
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
             echo "  if (!chkDate(document.modificar.fchcotizacion))";
             echo "      document.modificar.fchcotizacion.focus();";
             echo "  else if (!chkDate(document.modificar.fchsolicitud)){";
             echo "      alert('Ingrese la Fecha en que fue solicitada la Cotización por parte del Cliente');";
             echo "      document.modificar.fchsolicitud.focus()};";
             echo "  else if (document.modificar.horasolicitud.value == ''){";
             echo "      alert('Ingrese la Hora en que fue solicitada la Cotización por parte del Cliente');";
             echo "      document.modificar.horasolicitud.focus();}";
             echo "  else if (document.modificar.idcontacto.value == '')";
             echo "      alert('Debe seleccionar Cliente y Contacto para enviar Cotización');";
             echo "  else if (document.modificar.asunto.value == '')";
             echo "      alert('Debe redactar texto para el Asunto');";
             echo "  else if (document.modificar.saludo.value == '')";
             echo "      alert('Debe redactar texto para el Saludo');";
             echo "  else if (document.modificar.entrada.value == '')";
             echo "      alert('Debe redactar texto para la Entrada');";
             echo "  else if (document.modificar.despedida.value == '')";
             echo "      alert('Debe redactar texto para la Despedida');";
             echo "  else{";
             echo "      document.getElementById('login').disabled = false;";
             echo "      return (true);";
             echo "      }";
             echo "  return (false);";
             echo "}";
             echo "function uno(src,color_entrada) {";
             echo "    src.style.background=color_entrada;src.style.cursor='hand'";
             echo "}";
             echo "function dos(src,color_default) {";
             echo "    src.style.background=color_default;src.style.cursor='default';";
             echo "}";
             echo "function contactos(ventana, sufijo){";
             echo "  document.body.scroll='no';";
             echo "  frame = document.getElementById(ventana + '_frame');";
             echo "  frame.style.height = document.body.clientHeight-16;";
             echo "  ventana = document.getElementById(ventana);";
             echo "  ventana.style.visibility = 'visible';";
             echo "  ancho = frame.getAttribute('STYLE').width.substring( 0, frame.getAttribute('STYLE').width.indexOf('px') );";
             echo "  alto  = frame.getAttribute('STYLE').height.substring( 0, frame.getAttribute('STYLE').height.indexOf('px') );";
             echo "  ventana.style.left = eval((document.body.clientWidth/2)-(ancho/2));";
             echo "  frame.src='findcontacto.php?suf='+sufijo;";
             echo "}";
             echo "</script>";
             echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
             echo "</HEAD>";

             echo "<BODY ID=Cuerpo onscroll='dalt=document.body.scrollTop+3; find_contacto.style.top=dalt'>";
             echo "<DIV ID='find_contacto' STYLE='visibility:hidden; position:absolute; border-width:3; border-color:#666666; border-style:solid;'>";
             echo "<IFRAME ID='find_contacto_frame' SRC='findcontacto.php' MARGINWIDTH=0 MARGINHEIGHT=0 FRAMEBORDER='NO' SCROLLING='YES' STYLE='width:645; height:200'>";
             echo "</IFRAME>";
             echo "</DIV>";

             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='modificar' ACTION='cotizaciones_new.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta modificando
             echo "<TABLE CELLSPACING=1>";
             echo "<TH Class=titulo COLSPAN=2>Nuevos Datos para la Cotización</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Datos de Control:</TD>";
             echo "  <TD Class=invertir><TABLE CELLSPACING=1 WIDTH=100%>";
             echo "  <TD Class=listar>Fecha de Cotización :<br /><CENTER><INPUT TYPE='TEXT' NAME='fchcotizacion' SIZE=12 VALUE='".$rs->Value('ca_fchcotizacion')."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></CENTER></TD>";
             echo "  <TD Class=listar>Fecha de Solicitud :<br /><CENTER><INPUT TYPE='TEXT' NAME='fchsolicitud' SIZE=12 VALUE='".$rs->Value('ca_fchsolicitud')."'  ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></CENTER></TD>";
			 echo "  <TD Class=listar>Hora de Solicitud Formato 24h:<BR><CENTER>hh:mm:ss <INPUT TYPE='TEXT' NAME='horasolicitud' VALUE='".$rs->Value('ca_horasolicitud')."' ONBLUR='CheckTime(this)' SIZE=9 MAXLENGTH=8> 00-23hrs</CENTER></TD>";
             echo "  </TABLE></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <INPUT ID=id_cli TYPE='HIDDEN' NAME='idcontacto' VALUE=".$rs->Value('ca_idcontacto').">";
             echo "  <TD Class=titulo style='text-align:left; vertical-align:top;'>Cliente:<BR></TD>";
             echo "  <TD Class=invertir><TABLE CELLSPACING=1 WIDTH=425>";
             echo "  <TR>";
             echo "    <TD Class=mostrar>Nombre:<BR><INPUT ID=nombre_cli READONLY TYPE='TEXT' NAME='cliente[]' VALUE='".$rs->Value('ca_compania')."' SIZE=50 MAXLENGTH=60></TD>";
             echo "    <TD Class=mostrar style='text-align:right;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='contactos(\"find_contacto\",\"_cli\");'><a><IMG src='graficos/lupa.gif' alt='Buscar' hspace='0' vspace='0'> Buscar</a></TD>";
             echo "  </TR>";
             echo "  <TR>";
             echo "    <TD Class=mostrar>Contacto:<BR><INPUT ID=contacto_cli READONLY TYPE='TEXT' NAME='cliente[]' VALUE='".$rs->Value('ca_ncompleto_cn')."' SIZE=50 MAXLENGTH=60></TD>";
             echo "    <TD Class=mostrar>Teléfono:<BR><INPUT ID=telefonos_cli READONLY TYPE='TEXT' NAME='cliente[]' VALUE='".$rs->Value('ca_telefonos')."' SIZE=23 MAXLENGTH=30></TD>";
             echo "  </TR>";
             $direccion = str_replace ("|"," ",$rs->Value('ca_direccion_cl')).(($rs->Value('ca_oficina')!='')?" Oficina : ".$rs->Value('ca_oficina'):"" . ($rs->Value('ca_torre')!='')?" Torre : ".$rs->Value('ca_torre'):"" . ($rs->Value('ca_interior')!='')?" Interior : ".$rs->Value('ca_interior'):"" . ($rs->Value('ca_complemento')!='')?" - ".$rs->Value('ca_complemento'):"");
             echo "  <TR>";
             echo "    <TD Class=mostrar>Dirección:<BR><INPUT ID=direccion_cli READONLY TYPE='TEXT' NAME='cliente[]' VALUE='".$direccion."' SIZE=40 MAXLENGTH=80></TD>";
             echo "    <TD Class=mostrar>Fax:<BR><INPUT ID=fax_cli READONLY TYPE='TEXT' NAME='cliente[]' VALUE='".$rs->Value('ca_fax')."' SIZE=23 MAXLENGTH=30></TD>";
             echo "  </TR>";
             echo "  <TR>";
             echo "    <TD Class=mostrar COLSPAN=2>Correo Electrónico:<BR><INPUT ID=email_cli READONLY TYPE='TEXT' NAME='cliente[]' VALUE='".$rs->Value('ca_email')."' SIZE=30 MAXLENGTH=40></TD>";
             echo "  </TR>";
             echo "  </TABLE></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Asunto:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='asunto' VALUE='".$rs->Value('ca_asunto')."' SIZE=60 MAXLENGTH=255></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Saludo:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='saludo' VALUE='".$rs->Value('ca_saludo')."' SIZE=82 MAXLENGTH=255></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura style='vertical-align:top;'>Entrada:</TD>";
             echo "  <TD Class=mostrar><TEXTAREA NAME='entrada' WRAP=virtual ROWS=5 COLS=80>".$rs->Value('ca_entrada')."</TEXTAREA></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura style='vertical-align:top;'>Despedida:</TD>";
             echo "  <TD Class=mostrar><TEXTAREA NAME='despedida' WRAP=virtual ROWS=5 COLS=80>".$rs->Value('ca_despedida')."</TEXTAREA></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Anexos:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='anexos' VALUE='".$rs->Value('ca_anexos')."' SIZE=82 MAXLENGTH=255></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Rep. Comercial:</TD>";
             echo "  <TD Class=mostrar><TABLE WIDTH=100% CELLSPACING=1 BORDER=1>";
             echo "  <TR>";
             echo "    <TD Class=mostrar><SELECT ID=login NAME='vendedor' $cambiar>";
             while (!$us->Eof()) {
                    echo "<OPTION VALUE=".$us->Value('ca_login');
                    if ($rs->Value('ca_usuario')==$us->Value('ca_login')) {
                        echo " SELECTED";
                    }else{
                        echo " $cambiar";
                    }
                    echo ">".$us->Value('ca_nombre')."</OPTION>";
                    $us->MoveNext();
                }
             echo "    </SELECT></TD>";
             echo "    <TD Class=invertir>Modifica: </TD>";
             echo "    <TD Class=invertir><B>$usuario</B></TD>";
             echo "  </TR>";
             echo "  </TABLE></TD>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Actualizar'></TH>";         // Ordena almacenar los datos ingresados
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"cotizaciones_new.php?boton=Consultar&\id=$id\"'></TH>";  // Cancela la operación
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
             require_once("footer.php");
echo "</BODY>";
             break;
             }
        case 'Productos': {                                                    // Opcion para Adicionar Registros a la tabla
             if (!$rs->Open("select * from vi_cotizaciones where ca_idcotizacion = ".$id)) {    // Mueve el apuntador al registro que se desea consultar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
                 exit;
                }
             echo "<HTML>";
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
             echo "  return (true);";
             echo "}";
             echo "function uno(src,color_entrada) {";
             echo "    src.style.background=color_entrada;src.style.cursor='hand'";
             echo "}";
             echo "function dos(src,color_default) {";
             echo "    src.style.background=color_default;src.style.cursor='default';";
             echo "}";
             echo "function capturas(objeto, i, id){";
             echo "  ventana = document.getElementById('captura');";
             echo "  ventana.style.visibility = \"visible\";";
             echo "  ventana.style.left = eval((document.body.clientWidth/2)-(600/2));";
             echo "  ventana = document.getElementById('frame_captura');";
             echo "  ventana.src='ventanas.php?opcion='+objeto+'\&i='+i+'\&id='+id;";
             echo "}";
             echo "</script>";
             echo "</HEAD>";
             echo "<BODY  onscroll='dalt=document.body.scrollTop+3; captura.style.top=dalt;'>";
             echo "<DIV ID='captura' STYLE='visibility:hidden; position:absolute; border-width:1; border-color:#445599; border-style:solid;'>";  // left:150; top:25; width:600; height:200
             echo "<IFRAME ID=frame_captura SRC='blanco.html' MARGINWIDTH=0 MARGINHEIGHT=0 FRAMEBORDER='NO' SCROLLING='YES' STYLE='width:600; height:315'>";
             echo "</IFRAME>";
             echo "</DIV>";
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='productos' ACTION='cotizaciones_new.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
			 echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=$id>";
             echo "<TABLE CELLSPACING=1 WIDTH=530>";
			 datos_basicos($rs, 0);
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=5><CENTER><TABLE WIDTH=600 CELLSPACING=1>";
             echo "  <TR>";
             echo "    <TD Class=invertir COLSPAN=8 style='text-align:center; font-weight:bold;'>PRODUCTOS A TRANSPORTAR</TD>";
             echo "  </TR>";

			 echo "<TH>Impo/Expo</TH>";
			 echo "<TH>Incoterms</TH>";
			 echo "<TH>Transporte</TH>";
			 echo "<TH>Modalidad</TH>";
			 echo "<TH>Origen</TH>";
			 echo "<TH>Destino</TH>";
			 echo "<TH>Imprimir</TH>";
			 $tm =& DlRecordset::NewRecordset($conn);
			 if (!$tm->Open("select * from vi_cotproductos where ca_idcotizacion = $id")) {       // Selecciona todos lo registros de la tabla Conceptos
				 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
				 echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
				 exit; }
			 while (!$tm->Eof() and !$tm->IsEmpty()) {
				$i = ($tm->GetCurrentRow()-1);
				echo "<TR>";
				echo "  <INPUT ID=fidpr_$i TYPE='HIDDEN' NAME='productos[$i][fidpr]' VALUE=".$tm->Value('ca_idproducto').">";
				echo "  <INPUT ID=ftorg_$i TYPE='HIDDEN' NAME='productos[$i][ftorg]' VALUE=".$tm->Value('ca_idtraorigen').">";
				echo "  <INPUT ID=ftdst_$i TYPE='HIDDEN' NAME='productos[$i][ftdst]' VALUE=".$tm->Value('ca_idtradestino').">";
				echo "  <INPUT ID=fiorg_$i TYPE='HIDDEN' NAME='productos[$i][fiorg]' VALUE=".$tm->Value('ca_idorigen').">";
				echo "  <INPUT ID=fidst_$i TYPE='HIDDEN' NAME='productos[$i][fidst]' VALUE=".$tm->Value('ca_iddestino').">";
				echo "  <INPUT ID=fdlte_$i TYPE='HIDDEN' NAME='productos[$i][fdlte]' VALUE=0>";
				echo "  <TD style='vertical-align=top; text-align: left' COLSPAN=3>Producto: <INPUT ID=fprod_$i Class=field style='text-align:left; font-weight:bold;' TYPE='TEXT' READONLY NAME='productos[$i][fprod]' VALUE=\"".$tm->Value('ca_producto')."\">&nbsp</TD>";
				echo "  <TD style='vertical-align=top; text-align: left' COLSPAN=4>Detalles: <INPUT ID=fobsv_$i TYPE='HIDDEN' NAME='productos[$i][fobsv]' VALUE='".$tm->Value('ca_observaciones')."'></TD>";
				echo "</TR>";
				echo "<TR style='background:\"F0F0F0\"' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\"  onclick='javascript:capturas(\"Producto\",$i, $id);'>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=fimex_$i Class=field TYPE='TEXT' READONLY NAME='productos[$i][fimex]' VALUE='".$tm->Value('ca_impoexpo')."'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=finct_$i Class=field TYPE='TEXT' READONLY NAME='productos[$i][finct]' VALUE='".$tm->Value('ca_incoterms')."'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=ftrns_$i Class=field TYPE='TEXT' READONLY NAME='productos[$i][ftrns]' VALUE='".$tm->Value('ca_transporte')."'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=fmodl_$i Class=field TYPE='TEXT' READONLY NAME='productos[$i][fmodl]' VALUE='".$tm->Value('ca_modalidad')."'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=fcorg_$i Class=field TYPE='TEXT' READONLY NAME='productos[$i][fcorg]' VALUE='".$tm->Value('ca_ciuorigen')."'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=fcdst_$i Class=field TYPE='TEXT' READONLY NAME='productos[$i][fcdst]' VALUE='".$tm->Value('ca_ciudestino')."'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=fimpr_$i Class=field TYPE='TEXT' READONLY NAME='productos[$i][fimpr]' VALUE='".$tm->Value('ca_imprimir')."'></TD>";
				echo "</TR>";
				echo "<TR HEIGHT=5>";
				echo "  <TD Class=invertir COLSPAN=7></TD>";
				echo "</TR>";
				$tm->MoveNext();
				}
			 for ( $i=$tm->GetRowCount(); $i<($tm->GetRowCount()+6); $i++ ){
				echo "<TR>";
				echo "  <INPUT ID=fidpr_$i TYPE='HIDDEN' NAME='productos[$i][fidpr]'>";
				echo "  <INPUT ID=ftorg_$i TYPE='HIDDEN' NAME='productos[$i][ftorg]'>";
				echo "  <INPUT ID=ftdst_$i TYPE='HIDDEN' NAME='productos[$i][ftdst]'>";
				echo "  <INPUT ID=fiorg_$i TYPE='HIDDEN' NAME='productos[$i][fiorg]'>";
				echo "  <INPUT ID=fidst_$i TYPE='HIDDEN' NAME='productos[$i][fidst]'>";
				echo "  <INPUT ID=fdlte_$i TYPE='HIDDEN' NAME='productos[$i][fdlte]' VALUE=-1>";
				echo "  <TD style='vertical-align=top; text-align: left' COLSPAN=3>Producto: <INPUT ID=fprod_$i Class=field style='text-align:left; font-weight:bold;' TYPE='TEXT' READONLY NAME='productos[$i][fprod]'>&nbsp</TD>";
				echo "  <TD style='vertical-align=top; text-align: left' COLSPAN=3>Detalles: <INPUT ID=fobsv_$i Class=field TYPE='TEXT' READONLY NAME='productos[$i][fobsv]'></TD>";
				echo "</TR>";
				echo "<TR style='background:\"F0F0F0\"' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\"  onclick='javascript:capturas(\"Producto\",$i, $id);'>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=fimex_$i Class=field TYPE='TEXT' READONLY NAME='productos[$i][fimex]' VALUE='+ Productos'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=finct_$i Class=field TYPE='TEXT' READONLY NAME='productos[$i][finct]'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=ftrns_$i Class=field TYPE='TEXT' READONLY NAME='productos[$i][ftrns]'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=fmodl_$i Class=field TYPE='TEXT' READONLY NAME='productos[$i][fmodl]'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=fcorg_$i Class=field TYPE='TEXT' READONLY NAME='productos[$i][fcorg]'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=fcdst_$i Class=field TYPE='TEXT' READONLY NAME='productos[$i][fcdst]'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=fimpr_$i Class=field TYPE='TEXT' READONLY NAME='productos[$i][fimpr]'></TD>";
				echo "</TR>";
				echo "<TR HEIGHT=5>";
				echo "  <TD Class=invertir COLSPAN=7></TD>";
				echo "</TR>";
				}

             echo "  </TABLE></CENTER></TD>";
             echo "</TR>";

             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Guardar Productos'></TH>";         // Ordena almacenar los datos ingresados
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"cotizaciones_new.php?boton=Consultar&id=$id\"'></TH>";  // Cancela la operación
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
             require_once("footer.php");
echo "</BODY>";
             break;
             }
        case 'ContactosPr': {
             $modulo = "00100300";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
             if (!$rs->Open("select * from vi_cotproductos where ca_idcotizacion = $id and ca_idproducto = $pr")) {    // Mueve el apuntador al registro que se desea modificar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
                 exit;
                }
             $ag =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
             if (!$ag->Open("select * from vi_agentesxcont where ca_idtrafico_ag in ('".$rs->Value('ca_idtraorigen')."', '".$rs->Value('ca_idtradestino')."') and ca_idtrafico_ag != 'CO-057'")) {    // Mueve el apuntador al registro que se desea modificar
                 echo "<script>alert(\"".addslashes($ag->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
                 exit;
                }
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "</HEAD>";
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='eliminar' ACTION='cotizaciones_new.php'>";// Crea una forma con datos vacios
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta modificando
             echo "<INPUT TYPE='HIDDEN' NAME='pr' VALUE=".$pr.">";              // Hereda el Id del registro que se esta modificando
             echo "<TABLE CELLSPACING=1 WIDTH=550>";
             echo "<TH Class=titulo COLSPAN=5>Datos sobre el Producto a Transportar</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Producto:</TD>";
             echo "  <TD Class=mostrar COLSPAN=4>".$rs->Value('ca_producto')."<BR>&nbsp</TD>";
             echo "</TR>";

             echo "<TR>";
             echo "  <TD Class=captura ROWSPAN=3>Tráfico:</TD>";
             echo "  <TD Class=mostrar><B>Impor/Exportación :</B><BR><CENTER>".$rs->Value('ca_impoexpo')."</CENTER></TD>";
             echo "  <TD Class=mostrar COLSPAN=2><B>Incoterms:</B><BR><CENTER>".$rs->Value('ca_incoterms')."</CENTER></TD>";
             echo "  <TD Class=mostrar><B>Transporte :</B><BR><CENTER>".$rs->Value('ca_transporte')."</CENTER></TD>";
             echo "</TR>";

             echo "<TR>";
             echo "  <TH Class=titulo COLSPAN=2>Ciudad de Origen</TH>";
             echo "  <TH Class=titulo COLSPAN=2>Ciudad de Destino</TH>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=listar style='vertical-align:top; text-align:center;' WIDTH=100>".$rs->Value('ca_traorigen')."<BR>&nbsp</TD>";
             echo "  <TD Class=listar style='vertical-align:top; text-align:center;' WIDTH=100>".$rs->Value('ca_ciuorigen')."<BR>&nbsp</TD>";
             echo "  <TD Class=listar style='vertical-align:top; text-align:center;' WIDTH=100>".$rs->Value('ca_tradestino')."<BR>&nbsp</TD>";
             echo "  <TD Class=listar style='vertical-align:top; text-align:center;' WIDTH=100>".$rs->Value('ca_ciudestino')."<BR>&nbsp</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Agentes&nbspColtrans:</TD>";
             echo "  <TD Class=invertir COLSPAN=4>";
             echo "    <TABLE CELLSPACING=1 WIDTH=455>";

             $age_tmp = 0;
             while (!$ag->Eof() and !$ag->IsEmpty()) {
                 if ($age_tmp != $ag->Value('ca_idagente')) {
                     echo "<TR>";
                     echo "  <TD Class=captura style='font-weight:bold; vertical-align:top; font-size: 11px;'>".number_format($ag->Value('ca_idagente'))."</TD>";
                     echo "  <TD Class=captura style='font-weight:bold; vertical-align:top; font-size: 11px;' COLSPAN=4>".$ag->Value('ca_nombre_ag')."</TD>";
                     echo "</TR>";
                     echo "<TR>";
                     echo "  <TD Class=mostrar style='vertical-align:top;'>Dirección :</TD>";
                     echo "  <TD Class=mostrar COLSPAN=3>".$ag->Value('ca_direccion_ag')."</TD>";
                     echo "  <TD Class=mostrar ROWSPAN=6>&nbsp</TD>";
                     echo "</TR>";
                     echo "<TR>";
                     echo "  <TD Class=mostrar>Ciudad :</TD>";
                     echo "  <TD Class=mostrar><font color='#996600'>".$ag->Value('ca_idciudad_ag')."</font>&nbsp".$ag->Value('ca_ciudad')."</TD>";
                     echo "  <TD Class=mostrar>Pais :</TD>";
                     echo "  <TD Class=mostrar><font color='#996600'>".$ag->Value('ca_idtrafico_ag')."</font>&nbsp".$ag->Value('ca_nomtrafico_ag')."</TD>";
                     echo "</TR>";
                     echo "<TR>";
                     echo "  <TD Class=mostrar>Teléfonos :</TD>";
                     echo "  <TD Class=mostrar>".$ag->Value('ca_telefonos_ag')."</TD>";
                     echo "  <TD Class=mostrar>Fax :</TD>";
                     echo "  <TD Class=mostrar>".$ag->Value('ca_fax_ag')."</TD>";
                     echo "</TR>";
                     echo "<TR>";
                     echo "  <TD Class=mostrar>Web Site :</TD>";
                     echo "  <TD Class=mostrar COLSPAN=3><a href='http://".$ag->Value('ca_website')."'target='_blank'>".$ag->Value('ca_website')."</a></TD>";
                     echo "</TR>";
                     echo "<TR>";
                     echo "  <TD Class=mostrar>Email :</TD>";
                     echo "  <TD Class=mostrar COLSPAN=3>".$ag->Value('ca_email_ag')."</TD>";
                     echo "</TR>";
                     echo "<TR>";
                     echo "  <TD Class=mostrar>Zip Code :</TD>";
                     echo "  <TD Class=mostrar COLSPAN=3>".$ag->Value('ca_zipcode')."</TD>";
                     echo "</TR>";
                     $age_tmp = $ag->Value('ca_idagente');
                    }

                 if ($ag->Value('ca_idcontacto') != '') {
                     if ($rs->Value('ca_datosag') != '') {
                         $chequear = (in_array($ag->Value('ca_idcontacto'),explode("|",$rs->Value('ca_datosag'))))?"CHECKED":" ";
                     }else {
                         if (in_array($rs->Value('ca_impoexpo'),explode("|",$ag->Value('ca_impoexpo'))) and in_array($rs->Value('ca_transporte'),explode("|",$ag->Value('ca_transporte'))) and strstr($rs->Value('ca_ciuorigen').",".$rs->Value('ca_ciudestino'),$ag->Value('ca_ciudad_co'))) {
                             $chequear = "CHECKED"; }
                         else {
                             $chequear = " ";
                         }
                     }
                     echo "<TR>";
                     echo "  <TD Class=invertir style='font-weight:bold; vertical-align:top; font-size: 11px;' COLSPAN=3>".$ag->Value('ca_nombre_co')."</TD>";
                     echo "  <TD Class=invertir>".$ag->Value('ca_idcontacto')."</TD>";
                     echo "  <TD Class=mostrar><INPUT TYPE=CHECKBOX NAME='datosag[]' VALUE='".$ag->Value('ca_idcontacto')."' ".$chequear."></TD>";
                     echo "</TR>";
                     echo "<TR>";
                     echo "  <TD Class=mostrar>Dirección :</TD>";
                     echo "  <TD Class=mostrar COLSPAN=3>".$ag->Value('ca_direccion_co')."</TD>";
                     echo "  <TD Class=mostrar ROWSPAN=6>&nbsp</TD>";
                     echo "</TR>";
                     echo "<TR>";
                     echo "  <TD Class=mostrar>Teléfonos :</TD>";
                     echo "  <TD Class=mostrar>".$ag->Value('ca_telefonos_co')."</TD>";
                     echo "  <TD Class=mostrar>Fax :</TD>";
                     echo "  <TD Class=mostrar>".$ag->Value('ca_fax_co')."</TD>";
                     echo "</TR>";
                     echo "<TR>";
                     echo "  <TD Class=mostrar>País :</TD>";
                     echo "  <TD Class=mostrar>".$ag->Value('ca_nomtrafico')."</TD>";
                     echo "  <TD Class=mostrar>Ciudad :</TD>";
                     echo "  <TD Class=mostrar>".$ag->Value('ca_ciudad_co')."</TD>";
                     echo "</TR>";
                     echo "<TR>";
                     echo "  <TD Class=mostrar>Email :</TD>";
                     echo "  <TD Class=mostrar COLSPAN=3>".$ag->Value('ca_email_co')."</TD>";
                     echo "</TR>";
                     echo "<TR>";
                     echo "  <TD Class=listar>Atiende :</TD>";
                     echo "  <TD Class=listar>".str_replace ("|","<BR>",$ag->Value('ca_impoexpo'))."</TD>";
                     echo "  <TD Class=listar>Transporte :</TD>";
                     echo "  <TD Class=listar>".str_replace ("|","<BR>",$ag->Value('ca_transporte'))."</TD>";
                     echo "</TR>";
                     echo "<TR>";
                     echo "  <TD Class=mostrar>Cargo :</TD>";
                     echo "  <TD Class=mostrar>".$rs->Value('ca_cargo')."</TD>";
                     echo "  <TD Class=mostrar>Detalles :</TD>";
                     echo "  <TD Class=mostrar>".$rs->Value('ca_detalle')."</TD>";
                     echo "</TR>";
                    }
                 $ag->MoveNext();
                }
             echo "    </TABLE>";
             echo "  </TD>";
             echo "</TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Registrar Contactos'></TH>";         // Ordena almacenar los datos ingresados
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"cotizaciones_new.php?boton=Consultar&\id=$id\"'></TH>";  // Cancela la operación
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
             require_once("footer.php");
echo "</BODY>";
             break;
             }
        case 'Opciones': {                                                    // Opcion para Adicionar Registros a la tabla
             $modulo = "00100100";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo

             echo "<HTML>";
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
             echo "function uno(src,color_entrada) {";
             echo "    src.style.background=color_entrada;src.style.cursor='hand'";
             echo "}";
             echo "function dos(src,color_default) {";
             echo "    src.style.background=color_default;src.style.cursor='default';";
             echo "}";
             echo "function capturas(objeto, i, j, id, pr, tp){";
			 echo "  if (objeto == 'Recargos' && isNaN(document.getElementById('fidcn_'+i))) {";
             echo "  	elemento = document.getElementById('fidcn_'+i);";
			 echo "     if (elemento.value == '') {";
             echo "  		alert('Debe Seleccionar un Concepto de carga, antes de registrar los recargos');";
             echo "  		return;";
             echo "  	}";
             echo "  }";
             echo "  ventana = document.getElementById('captura');";
             echo "  ventana.style.visibility = \"visible\";";
             echo "  ventana.style.left = eval((document.body.clientWidth/2)-(600/2));";
             echo "  ventana = document.getElementById('frame_captura');";
             echo "  ventana.src='ventanas.php?opcion='+objeto+'\&i='+i+'\&j='+j+'\&id='+id+'\&pr='+pr+'\&tp='+tp;";
             echo "}";
             echo "function validar() {";
             echo "    return true;";
             echo "}";
             echo "</script>";
             echo "</HEAD>";
             echo "<BODY  onscroll='dalt=document.body.scrollTop+3; captura.style.top=dalt;'>";
             echo "<DIV ID='captura' STYLE='visibility:hidden; position:absolute; border-width:1; border-color:#445599; border-style:solid;'>";  // left:150; top:25; width:600; height:200
             echo "<IFRAME ID=frame_captura SRC='blanco.html' MARGINWIDTH=0 MARGINHEIGHT=0 FRAMEBORDER='NO' SCROLLING='YES' STYLE='width:650; height:400'>";
             echo "</IFRAME>";
             echo "</DIV>";
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='productos' ACTION='cotizaciones_new.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
			 echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=$id>";
			 echo "<INPUT TYPE='HIDDEN' NAME='pr' VALUE=$pr>";
             echo "<TABLE CELLSPACING=1 WIDTH=530>";
             echo "<TR>";
             echo "  <TD Class=invertir COLSPAN=7 style='text-align:center; font-weight:bold;'>PRODUCTOS A TRANSPORTAR</TD>";
             echo "</TR>";

			 echo "<TH>Impo/Expo</TH>";
			 echo "<TH>Incoterms</TH>";
			 echo "<TH>Transporte</TH>";
			 echo "<TH>Modalidad</TH>";
			 echo "<TH>Origen</TH>";
			 echo "<TH>Destino</TH>";
			 $tm =& DlRecordset::NewRecordset($conn);
			 $rc =& DlRecordset::NewRecordset($conn);
			 if (!$tm->Open("select * from vi_cotproductos where ca_idcotizacion = $id and ca_idproducto = $pr")) {       // Selecciona todos lo registros de la tabla Conceptos
				 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
				 echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
				 exit; }
			 while (!$tm->Eof() and !$tm->IsEmpty()) {
				$i = ($tm->GetCurrentRow()-1);
				echo "<TR>";
				echo "  <TD Class=mostrar COLSPAN=3>Producto: ".$tm->Value('ca_producto')."</TD>";
				echo "  <TD Class=mostrar COLSPAN=3>Detalles: ".$tm->Value('ca_observaciones')."</TD>";
				echo "</TR>";
				echo "<TR>";
				echo "  <TD Class=invertir>".$tm->Value('ca_impoexpo')."</TD>";
				echo "  <TD Class=invertir>".$tm->Value('ca_incoterms')."</TD>";
				echo "  <TD Class=invertir>".$tm->Value('ca_transporte')."</TD>";
				echo "  <TD Class=invertir>".$tm->Value('ca_modalidad')."</TD>";
				echo "  <TD Class=invertir>".$tm->Value('ca_ciuorigen')."</TD>";
				echo "  <TD Class=invertir>".$tm->Value('ca_ciudestino')."</TD>";
				echo "</TR>";
				echo "<TR HEIGHT=5>";
				echo "  <TD Class=invertir COLSPAN=6></TD>";
				echo "</TR>";
				$tm->MoveNext();
				}

             echo "<TR>";
             echo "  <TD Class=invertir COLSPAN=9><CENTER><TABLE WIDTH=650 CELLSPACING=0>";
             echo "  <TR>";
             echo "    <TD Class=mostrar COLSPAN=6 style='text-align:center; font-weight:bold;'>OPCIONES A COTIZAR - «Tarifario <IMG src='./graficos/details.gif' alt='Importar Tarifas desde Módulo Tarifario' border=0 onclick='capturas(\"Tarifario\",0, 0, $id, $pr, \"\")'>»</TD>";
             echo "    <TD Class=invertir COLSPAN=2><B>Frecuencia:</B> <INPUT TYPE='TEXT' NAME='frecuencia' VALUE='".$tm->Value('ca_frecuencia')."' SIZE=20 MAXLENGTH=20></TD>";
             echo "    <TD Class=invertir COLSPAN=2><B>T.Transito:</B> <INPUT TYPE='TEXT' NAME='tiempotransito' VALUE='".$tm->Value('ca_tiempotransito')."' SIZE=25 MAXLENGTH=25></TD>";
             echo "  </TR>";

             echo "<TR>";
			 echo "  <TH COLSPAN=5>Fletes</TH>";
			 echo "  <TH COLSPAN=5>Recargos en Origen</TH>";
             echo "</TR>";
			 if (!$tm->Open("select * from vi_cotopciones where ca_idcotizacion = $id and ca_idproducto = $pr")) {       // Selecciona todos lo registros de la tabla Opciones a Cotizar
				 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
				 echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
				 exit; }
			 $tm->MoveFirst();

			 if (!$rc->Open("select * from vi_cotrecargos where ca_idcotizacion = $id and ca_idproducto = $pr and ca_generado = 'Recargo en Origen'")) {       // Selecciona todos lo registros de la tabla Recargos
				 echo "<script>alert(\"".addslashes($rc->mErrMsg)."\");</script>";      // Muestra el mensaje de error
				 echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
				 exit; }

			 $impr_tit = true;
			 while (!$tm->Eof() and !$tm->IsEmpty()) {
				$i = ($tm->GetCurrentRow()-1);
				echo "<INPUT ID='fidpr_$i' TYPE='HIDDEN' NAME='opciones[$i][fidpr]' VALUE=".$tm->Value('ca_idproducto').">";
				echo "<INPUT ID='fidop_$i' TYPE='HIDDEN' NAME='opciones[$i][fidop]' VALUE=".$tm->Value('ca_idopcion').">";
				echo "<INPUT ID='fidcn_$i' TYPE='HIDDEN' NAME='opciones[$i][fidcn]' VALUE=".$tm->Value('ca_idconcepto').">";
				$aflete = explode('|',$tm->Value('ca_oferta'));
				echo "<TR>";
				echo "  <TD Class=invertir WIDTH=350 COLSPAN=5><TABLE WIDTH=350 CELLSPACING=1>";
				if ($impr_tit) {
					echo "<TR>";
					echo "  <TH WIDTH=100>Concepto</TH>";
					echo "  <TH WIDTH=50>Flete</TH>";
					echo "  <TH WIDTH=50>Mín.</TH>";
					echo "  <TH WIDTH=25>Mnd</TH>";
					echo "  <TH WIDTH=50>Aplic.</TH>";
					echo "  <TH WIDTH=80>Detalles</TH>";
					echo "</TR>"; 
				}
				echo "    <TR style='background:\"F0F0F0\"' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='javascript:capturas(\"Opciones\",$i, 0, $id, $pr, \"\");'>";
				echo "      <TD WIDTH=100 style='vertical-align=top; text-align: left'><INPUT ID='fcnpt_$i' Class=field TYPE='TEXT' READONLY NAME='opciones[$i][fcnpt]' VALUE=\"".$tm->Value('ca_concepto')."\"></TD>";
				echo "      <TD WIDTH=50  style='vertical-align=top; text-align: left'><INPUT ID='fflte_$i' Class=field TYPE='TEXT' READONLY NAME='opciones[$i][fflte]' VALUE='".$aflete[0]."'></TD>";
				echo "      <TD WIDTH=50  style='vertical-align=top; text-align: left'><INPUT ID='ffmin_$i' Class=field TYPE='TEXT' READONLY NAME='opciones[$i][ffmin]' VALUE='".$aflete[1]."'></TD>";
				echo "      <TD WIDTH=25  style='vertical-align=top; text-align: left'><INPUT ID='fmnda_$i' Class=field TYPE='TEXT' READONLY NAME='opciones[$i][fmnda]' VALUE='".$tm->Value('ca_idmoneda')."'></TD>";
				echo "      <TD WIDTH=50  style='vertical-align=top; text-align: left'><INPUT ID='ffapl_$i' Class=field TYPE='TEXT' READONLY NAME='opciones[$i][ffapl]' VALUE='".$aflete[2]."'></TD>";
				echo "      <TD WIDTH=80 style='vertical-align=top; text-align: left'><INPUT ID='fdets_$i' Class=field TYPE='TEXT' READONLY NAME='opciones[$i][fdets]' VALUE=\"".$tm->Value('ca_observaciones')."\"></TD>";
				echo "    </TR>";
				echo "  </TABLE></TD>";
				echo "  <TD Class=invertir COLSPAN=5><TABLE WIDTH=320 CELLSPACING=1>";
				if ($impr_tit) {
					echo "<TR>";
					echo "  <TH WIDTH=110>Recargo</TH>";
					echo "  <TH WIDTH=5>Tipo</TH>";
					echo "  <TH WIDTH=50>Valor</TH>";
					echo "  <TH WIDTH=50>Mínimo</TH>";
					echo "  <TH WIDTH=25>Mnd</TH>";
					echo "  <TH WIDTH=80>Detalles</TH>";
					echo "</TR>";
					$impr_tit = false;
				}
				$rc->MoveFirst();
				$have = false;
				$j = 0;
				while (!$rc->Eof() and !$rc->IsEmpty()) {
					if ($rc->Value('ca_idconcepto') == 9999 or $rc->Value('ca_idopcion') != $tm->Value('ca_idopcion')){
						$rc->MoveNext();
						continue;
					}
					echo "    <INPUT ID='foidr[$i]_$j' TYPE='HIDDEN' NAME='recargos[$i][$j][foidr]' VALUE=".$rc->Value('ca_oid').">";
					echo "    <INPUT ID='fidrc[$i]_$j' TYPE='HIDDEN' NAME='recargos[$i][$j][fidrc]' VALUE=".$rc->Value('ca_idrecargo').">";
					echo "    <INPUT ID='fdltr[$i]_$j' TYPE='HIDDEN' NAME='recargos[$i][$j][fdltr]'>";
					echo "    <TR ID='rec[$i]_$j' style='background:\"F0F0F0\"' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='javascript:capturas(\"Recargos\",$i, $j, $id, $pr, \"Recargo en Origen\");'>";
					echo "      <TD WIDTH=110 style='vertical-align=top; text-align: left'><INPUT ID='frcgo[$i]_$j' Class=field TYPE='TEXT' READONLY NAME='recargos[$i][$j][frcgo]' VALUE='".$rc->Value('ca_recargo')."'></TD>";
					echo "      <TD WIDTH=5   style='vertical-align=top; text-align: left'><INPUT ID='ftipo[$i]_$j' Class=field TYPE='TEXT' READONLY NAME='recargos[$i][$j][ftipo]' VALUE='".$rc->Value('ca_tipo')."'></TD>";
					echo "      <TD WIDTH=50  style='vertical-align=top; text-align: left'><INPUT ID='frvlr[$i]_$j' Class=field TYPE='TEXT' READONLY NAME='recargos[$i][$j][frvlr]' VALUE='".$rc->Value('ca_valor_tar')."'> <INPUT ID='frapA[$i]_$j' Class=field TYPE='TEXT' READONLY NAME='recargos[$i][$j][frapA]' VALUE='".$rc->Value('ca_aplica_tar')."'></TD>";
					echo "      <TD WIDTH=50  style='vertical-align=top; text-align: left'><INPUT ID='frmin[$i]_$j' Class=field TYPE='TEXT' READONLY NAME='recargos[$i][$j][frmin]' VALUE='".$rc->Value('ca_valor_min')."'> <INPUT ID='frapB[$i]_$j' Class=field TYPE='TEXT' READONLY NAME='recargos[$i][$j][frapB]' VALUE='".$rc->Value('ca_aplica_min')."'></TD>";
					echo "      <TD WIDTH=25  style='vertical-align=top; text-align: left'><INPUT ID='frmnd[$i]_$j' Class=field TYPE='TEXT' READONLY NAME='recargos[$i][$j][frmnd]' VALUE='".$rc->Value('ca_idmoneda')."'></TD>";
					echo "      <TD WIDTH=80  style='vertical-align=top; text-align: left'><INPUT ID='frdts[$i]_$j' Class=field TYPE='TEXT' READONLY NAME='recargos[$i][$j][frdts]' VALUE=\"".$rc->Value('ca_observaciones')."\"></TD>";
					echo "    </TR>";
					$rc->MoveNext();
					$have = true;
					$j++;
					}
				$k = $j;
				$displ = ($have)?'none':'block';
				for ( $j=$j; $j<$k+5; $j++ ){
					echo "    <INPUT ID='foidr[$i]_$j' TYPE='HIDDEN' NAME='recargos[$i][$j][foidr]'>";
					echo "    <INPUT ID='fidrc[$i]_$j' TYPE='HIDDEN' NAME='recargos[$i][$j][fidrc]'>";
					echo "    <INPUT ID='fdltr[$i]_$j' TYPE='HIDDEN' NAME='recargos[$i][$j][fdltr]'>";
					echo "    <TR ID='rec[$i]_$j' style='display: $displ' style='background:\"F0F0F0\"' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='javascript:capturas(\"Recargos\",$i, $j, $id, $pr, \"Recargo en Origen\");'>";
					echo "      <TD WIDTH=110 style='vertical-align=top; text-align: left'><INPUT ID='frcgo[$i]_$j' Class=field TYPE='TEXT' READONLY NAME='recargos[$i][$j][frcgo]'></TD>";
					echo "      <TD WIDTH=5   style='vertical-align=top; text-align: left'><INPUT ID='ftipo[$i]_$j' Class=field TYPE='TEXT' READONLY NAME='recargos[$i][$j][ftipo]'></TD>";
					echo "      <TD WIDTH=50  style='vertical-align=top; text-align: left'><INPUT ID='frvlr[$i]_$j' Class=field TYPE='TEXT' READONLY NAME='recargos[$i][$j][frvlr]'> <INPUT ID='frapA[$i]_$j' Class=field TYPE='TEXT' READONLY NAME='recargos[$i][$j][frapA]'></TD>";
					echo "      <TD WIDTH=50  style='vertical-align=top; text-align: left'><INPUT ID='frmin[$i]_$j' Class=field TYPE='TEXT' READONLY NAME='recargos[$i][$j][frmin]'> <INPUT ID='frapB[$i]_$j' Class=field TYPE='TEXT' READONLY NAME='recargos[$i][$j][frapB]'></TD>";
					echo "      <TD WIDTH=25  style='vertical-align=top; text-align: left'><INPUT ID='frmnd[$i]_$j' Class=field TYPE='TEXT' READONLY NAME='recargos[$i][$j][frmnd]'></TD>";
					echo "      <TD WIDTH=80  style='vertical-align=top; text-align: left'><INPUT ID='frdts[$i]_$j' Class=field TYPE='TEXT' READONLY NAME='recargos[$i][$j][frdts]'></TD>";
					echo "    </TR>";
					$displ = 'none';
					}
				echo "  </TABLE></TD>";
				echo "</TR>";
				echo "<TR HEIGHT=5>";
				echo "  <TD Class=resaltar COLSPAN=10></TD>";
				echo "</TR>";
				$tm->MoveNext();
				}
			 for ( $i=$tm->GetRowCount(); $i<($tm->GetRowCount()+5); $i++ ){
				echo "<INPUT ID='fidpr_$i' TYPE='HIDDEN' NAME='opciones[$i][fidpr]' VALUE=$pr>";
				echo "<INPUT ID='fidop_$i' TYPE='HIDDEN' NAME='opciones[$i][fidop]' VALUE=0>";
				echo "<INPUT ID='fidcn_$i' TYPE='HIDDEN' NAME='opciones[$i][fidcn]'>";
				echo "<TR>";
				echo "  <TD Class=invertir COLSPAN=5><TABLE WIDTH=350 CELLSPACING=1>";
				echo "    <TR style='background:\"F0F0F0\"' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='javascript:capturas(\"Opciones\",$i, 0, $id, $pr, \"\");'>";
				echo "      <TD WIDTH=100 style='vertical-align=top; text-align: left'><INPUT ID='fcnpt_$i' Class=field TYPE='TEXT' READONLY NAME='opciones[$i][fcnpt]'></TD>";
				echo "      <TD WIDTH=50  style='vertical-align=top; text-align: left'><INPUT ID='fflte_$i' Class=field TYPE='TEXT' READONLY NAME='opciones[$i][fflte]'></TD>";
				echo "      <TD WIDTH=50  style='vertical-align=top; text-align: left'><INPUT ID='ffmin_$i' Class=field TYPE='TEXT' READONLY NAME='opciones[$i][ffmin]'></TD>";
				echo "      <TD WIDTH=25  style='vertical-align=top; text-align: left'><INPUT ID='fmnda_$i' Class=field TYPE='TEXT' READONLY NAME='opciones[$i][fmnda]'></TD>";
				echo "      <TD WIDTH=50  style='vertical-align=top; text-align: left'><INPUT ID='ffapl_$i' Class=field TYPE='TEXT' READONLY NAME='opciones[$i][ffapl]'></TD>";
				echo "      <TD WIDTH=80  style='vertical-align=top; text-align: left'><INPUT ID='fdets_$i' Class=field TYPE='TEXT' READONLY NAME='opciones[$i][fdets]'></TD>";
				echo "    </TR>";
				echo "  </TABLE></TD>";
				echo "  <TD Class=invertir COLSPAN=5><TABLE WIDTH=320 CELLSPACING=1>";
				$displ = 'block';
				for ( $j=0; $j<5; $j++ ){
					echo "    <INPUT ID='foidr[$i]_$j' TYPE='HIDDEN' NAME='recargos[$i][$j][foidr]'>";
					echo "    <INPUT ID='fidrc[$i]_$j' TYPE='HIDDEN' NAME='recargos[$i][$j][fidrc]'>";
					echo "    <INPUT ID='fdltr[$i]_$j' TYPE='HIDDEN' NAME='recargos[$i][$j][fdltr]'>";
					echo "    <TR ID='rec[$i]_$j' style='display: $displ' style='background:\"F0F0F0\"' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='javascript:capturas(\"Recargos\",$i, $j, $id, $pr, \"Recargo en Origen\");'>";
					echo "      <TD WIDTH=110 style='vertical-align=top; text-align: left'><INPUT ID='frcgo[$i]_$j' Class=field TYPE='TEXT' READONLY NAME='recargos[$i][$j][frcgo]'></TD>";
					echo "      <TD WIDTH=5   style='vertical-align=top; text-align: left'><INPUT ID='ftipo[$i]_$j' Class=field TYPE='TEXT' READONLY NAME='recargos[$i][$j][ftipo]'></TD>";
					echo "      <TD WIDTH=50  style='vertical-align=top; text-align: left'><INPUT ID='frvlr[$i]_$j' Class=field TYPE='TEXT' READONLY NAME='recargos[$i][$j][frvlr]'> <INPUT ID='frapA[$i]_$j' Class=field TYPE='TEXT' READONLY NAME='recargos[$i][$j][frapA]'></TD>";
					echo "      <TD WIDTH=50  style='vertical-align=top; text-align: left'><INPUT ID='frmin[$i]_$j' Class=field TYPE='TEXT' READONLY NAME='recargos[$i][$j][frmin]'> <INPUT ID='frapB[$i]_$j' Class=field TYPE='TEXT' READONLY NAME='recargos[$i][$j][frapB]'></TD>";
					echo "      <TD WIDTH=25  style='vertical-align=top; text-align: left'><INPUT ID='frmnd[$i]_$j' Class=field TYPE='TEXT' READONLY NAME='recargos[$i][$j][frmnd]'></TD>";
					echo "      <TD WIDTH=80  style='vertical-align=top; text-align: left'><INPUT ID='frdts[$i]_$j' Class=field TYPE='TEXT' READONLY NAME='recargos[$i][$j][frdts]'></TD>";
					echo "    </TR>";
					$displ = 'none';
					}
				echo "  </TABLE></TD>";
				echo "</TR>";
				echo "<TR HEIGHT=5>";
				echo "  <TD Class=resaltar COLSPAN=10></TD>";
				echo "</TR>";
				}

			 echo "<TR HEIGHT=5>";
			 echo "  <TD Class=titulo COLSPAN=10></TD>";
			 echo "</TR>";
			 echo "<TR>";
			 echo "  <TD Class=valores COLSPAN=5 style='font-weight:bold;'>RECARGOS EN ORIGEN - GENERAL</TD>";
			 echo "  <TD Class=invertir COLSPAN=5><TABLE WIDTH=320 CELLSPACING=1>";
			 $rc->MoveFirst();
			 $have = false;
			 $j = 0;				
			 while (!$rc->Eof() and !$rc->IsEmpty()) {
				if ($rc->Value('ca_idopcion') != 999 or $rc->Value('ca_idconcepto') != 9999){
					$rc->MoveNext();
					continue;
				}
				echo "    <INPUT ID='foidr[$i]_$j' TYPE='HIDDEN' NAME='recargos[$i][$j][foidr]' VALUE=".$rc->Value('ca_oid').">";
				echo "    <INPUT ID='fidrc[$i]_$j' TYPE='HIDDEN' NAME='recargos[$i][$j][fidrc]' VALUE=".$rc->Value('ca_idrecargo').">";
				echo "    <INPUT ID='fdltr[$i]_$j' TYPE='HIDDEN' NAME='recargos[$i][$j][fdltr]'>";
				echo "    <TR ID='rec[$i]_$j' style='background:\"F0F0F0\"' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='javascript:capturas(\"Recargos\",$i, $j, $id, $pr, \"Recargo en Origen\");'>";
				echo "      <TD WIDTH=110 style='vertical-align=top; text-align: left'><INPUT ID='frcgo[$i]_$j' Class=field TYPE='TEXT' READONLY NAME='recargos[$i][$j][frcgo]' VALUE='".$rc->Value('ca_recargo')."'></TD>";
				echo "      <TD WIDTH=5   style='vertical-align=top; text-align: left'><INPUT ID='ftipo[$i]_$j' Class=field TYPE='TEXT' READONLY NAME='recargos[$i][$j][ftipo]' VALUE='".$rc->Value('ca_tipo')."'></TD>";
				echo "      <TD WIDTH=50  style='vertical-align=top; text-align: left'><INPUT ID='frvlr[$i]_$j' Class=field TYPE='TEXT' READONLY NAME='recargos[$i][$j][frvlr]' VALUE='".$rc->Value('ca_valor_tar')."'> <INPUT ID='frapA[$i]_$j' Class=field TYPE='TEXT' READONLY NAME='recargos[$i][$j][frapA]' VALUE='".$rc->Value('ca_aplica_tar')."'></TD>";
				echo "      <TD WIDTH=50  style='vertical-align=top; text-align: left'><INPUT ID='frmin[$i]_$j' Class=field TYPE='TEXT' READONLY NAME='recargos[$i][$j][frmin]' VALUE='".$rc->Value('ca_valor_min')."'> <INPUT ID='frapB[$i]_$j' Class=field TYPE='TEXT' READONLY NAME='recargos[$i][$j][frapB]' VALUE='".$rc->Value('ca_aplica_min')."'></TD>";
				echo "      <TD WIDTH=25  style='vertical-align=top; text-align: left'><INPUT ID='frmnd[$i]_$j' Class=field TYPE='TEXT' READONLY NAME='recargos[$i][$j][frmnd]' VALUE='".$rc->Value('ca_idmoneda')."'></TD>";
				echo "      <TD WIDTH=80  style='vertical-align=top; text-align: left'><INPUT ID='frdts[$i]_$j' Class=field TYPE='TEXT' READONLY NAME='recargos[$i][$j][frdts]' VALUE=\"".$rc->Value('ca_observaciones')."\"></TD>";
				echo "    </TR>";
				$rc->MoveNext();
				$have = true;
				$j++;
				}
			 $k = $j;			  
			 $displ = ($have)?'none':'block';
			 for ( $j=$j; $j<$k+4; $j++ ){
				echo "    <INPUT ID='foidr[$i]_$j' TYPE='HIDDEN' NAME='recargos[$i][$j][foidr]'>";
				echo "    <INPUT ID='fidrc[$i]_$j' TYPE='HIDDEN' NAME='recargos[$i][$j][fidrc]'>";
				echo "    <INPUT ID='fdltr[$i]_$j' TYPE='HIDDEN' NAME='recargos[$i][$j][fdltr]'>";
				echo "    <TR ID='rec[$i]_$j' style='display: $displ' style='background:\"F0F0F0\"' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='javascript:capturas(\"Recargos\",$i, $j, $id, $pr, \"Recargo en Origen\");'>";
				echo "      <TD WIDTH=110 style='vertical-align=top; text-align: left'><INPUT ID='frcgo[$i]_$j' Class=field TYPE='TEXT' READONLY NAME='recargos[$i][$j][frcgo]'></TD>";
				echo "      <TD WIDTH=5   style='vertical-align=top; text-align: left'><INPUT ID='ftipo[$i]_$j' Class=field TYPE='TEXT' READONLY NAME='recargos[$i][$j][ftipo]'></TD>";
				echo "      <TD WIDTH=50  style='vertical-align=top; text-align: left'><INPUT ID='frvlr[$i]_$j' Class=field TYPE='TEXT' READONLY NAME='recargos[$i][$j][frvlr]'> <INPUT ID='frapA[$i]_$j' Class=field TYPE='TEXT' READONLY NAME='recargos[$i][$j][frapA]'></TD>";
				echo "      <TD WIDTH=50  style='vertical-align=top; text-align: left'><INPUT ID='frmin[$i]_$j' Class=field TYPE='TEXT' READONLY NAME='recargos[$i][$j][frmin]'> <INPUT ID='frapB[$i]_$j' Class=field TYPE='TEXT' READONLY NAME='recargos[$i][$j][frapB]'></TD>";
				echo "      <TD WIDTH=25  style='vertical-align=top; text-align: left'><INPUT ID='frmnd[$i]_$j' Class=field TYPE='TEXT' READONLY NAME='recargos[$i][$j][frmnd]'></TD>";
				echo "      <TD WIDTH=80  style='vertical-align=top; text-align: left'><INPUT ID='frdts[$i]_$j' Class=field TYPE='TEXT' READONLY NAME='recargos[$i][$j][frdts]'></TD>";
				echo "    </TR>";
				$displ = 'none';
				}
			 echo "  </TABLE></TD>";
			 echo "</TR>";

             echo "  </TABLE></CENTER></TD>";
             echo "</TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Guardar Opciones'></TH>";         // Ordena almacenar los datos ingresados
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"cotizaciones_new.php?boton=Consultar&id=$id\"'></TH>";  // Cancela la operación
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
             require_once("footer.php");
echo "</BODY>";
             break;
             }
        case 'RecargosLoc': {                                                    // Opcion para Adicionar Registros a la tabla
             if (!$rs->Open("select * from vi_cotizaciones where ca_idcotizacion = ".$id)) {    // Mueve el apuntador al registro que se desea consultar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
                 exit;
                }
             echo "<HTML>";
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
             echo "function uno(src,color_entrada) {";
             echo "    src.style.background=color_entrada;src.style.cursor='hand'";
             echo "}";
             echo "function dos(src,color_default) {";
             echo "    src.style.background=color_default;src.style.cursor='default';";
             echo "}";
             echo "function capturas(objeto, i, id){";
             echo "  ventana = document.getElementById('captura');";
             echo "  ventana.style.visibility = \"visible\";";
             echo "  ventana.style.left = eval((document.body.clientWidth/2)-(600/2));";
             echo "  ventana = document.getElementById('frame_captura');";
             echo "  ventana.src='ventanas.php?opcion='+objeto+'\&i='+i+'\&id='+id;";
             echo "}";
             echo "function validar() {";
             echo "    return true;";
             echo "}";
             echo "</script>";
             echo "</HEAD>";
             echo "<BODY  onscroll='dalt=document.body.scrollTop+3; captura.style.top=dalt;'>";
             echo "<DIV ID='captura' STYLE='visibility:hidden; position:absolute; border-width:1; border-color:#445599; border-style:solid;'>";  // left:150; top:25; width:600; height:200
             echo "<IFRAME ID=frame_captura SRC='blanco.html' MARGINWIDTH=0 MARGINHEIGHT=0 FRAMEBORDER='NO' SCROLLING='YES' STYLE='width:600; height:315'>";
             echo "</IFRAME>";
             echo "</DIV>";
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='productos' ACTION='cotizaciones_new.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
			 echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=$id>";
             echo "<TABLE CELLSPACING=1 WIDTH=530>";
			 datos_basicos($rs, 0);
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=2><CENTER><TABLE WIDTH=600 CELLSPACING=1>";
             echo "  <TR>";
             echo "    <TD Class=invertir COLSPAN=7 style='text-align:center; font-weight:bold;'>RELACION DE RECARGOS LOCALES</TD>";
             echo "  </TR>";
			 echo "  <TH>Modalidad</TH>";
			 echo "  <TH>Recargo</TH>";
			 echo "  <TH>Tipo</TH>";
			 echo "  <TH>Mnd</TH>";
			 echo "  <TH>Valor</TH>";
			 echo "  <TH>Mínimo</TH>";
			 echo "  <TH WIDTH=280>Detalles</TH>";
			 $tm =& DlRecordset::NewRecordset($conn);
			 if (!$tm->Open("select * from vi_cotrecargos where ca_idcotizacion = $id and ca_generado = 'Recargo Local'")) {       // Selecciona todos lo registros de la tabla Conceptos
				 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
				 echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
				 exit; }
			 $i = 0;
			 while (!$tm->Eof() and !$tm->IsEmpty()) {
				echo "<TR style='background:\"F0F0F0\"' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\"  onclick='javascript:capturas(\"RecargosLoc\",$i, $id);'>";
				echo "  <INPUT ID=foids_$i TYPE='HIDDEN' NAME='recargos[$i][foids]' VALUE=".$tm->Value('ca_oid').">";
				echo "  <INPUT ID=fidrc_$i TYPE='HIDDEN' NAME='recargos[$i][fidrc]' VALUE=".$tm->Value('ca_idrecargo').">";
				echo "  <INPUT ID=ftrns_$i TYPE='HIDDEN' NAME='recargos[$i][ftrns]' VALUE=".$tm->Value('ca_transporte').">";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=frmdl_$i Class=field TYPE='TEXT' READONLY NAME='recargos[$i][frmdl]' VALUE='".$tm->Value('ca_modalidad')."'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=frcgo_$i Class=field TYPE='TEXT' READONLY NAME='recargos[$i][frcgo]' VALUE='".$tm->Value('ca_recargo')."'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=ftipo_$i Class=field TYPE='TEXT' READONLY NAME='recargos[$i][ftipo]' VALUE='".$tm->Value('ca_tipo')."'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=frmnd_$i Class=field TYPE='TEXT' READONLY NAME='recargos[$i][frmnd]' VALUE='".$tm->Value('ca_idmoneda')."'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=frvlr_$i Class=field TYPE='TEXT' READONLY NAME='recargos[$i][frvlr]' VALUE='".$tm->Value('ca_valor_tar')."'> <INPUT ID=frapA_$i Class=field TYPE='TEXT' READONLY NAME='recargos[$i][frapA]' VALUE='".$tm->Value('ca_aplica_tar')."'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=frmin_$i Class=field TYPE='TEXT' READONLY NAME='recargos[$i][frmin]' VALUE='".$tm->Value('ca_valor_min')."'> <INPUT ID=frapB_$i Class=field TYPE='TEXT' READONLY NAME='recargos[$i][frapB]' VALUE='".$tm->Value('ca_aplica_min')."'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=frdts_$i Class=field TYPE='TEXT' READONLY NAME='recargos[$i][frdts]' VALUE='".$tm->Value('ca_observaciones')."'></TD>";
				echo "</TR>";
				echo "<TR HEIGHT=5>";
				echo "  <TD Class=invertir COLSPAN=7></TD>";
				echo "</TR>";
				$tm->MoveNext();
				$i++;
				}
			 for ( $i=$tm->GetRowCount(); $i<($tm->GetRowCount()+5); $i++ ){
				echo "<TR style='background:\"F0F0F0\"' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\"  onclick='javascript:capturas(\"RecargosLoc\",$i, $id);'>";
				echo "  <INPUT ID=foids_$i TYPE='HIDDEN' NAME='recargos[$i][foids]'>";
				echo "  <INPUT ID=fidrc_$i TYPE='HIDDEN' NAME='recargos[$i][fidrc]'>";
				echo "  <INPUT ID=ftrns_$i TYPE='HIDDEN' NAME='recargos[$i][ftrns]'>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=frmdl_$i Class=field TYPE='TEXT' READONLY NAME='recargos[$i][frmdl]'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=frcgo_$i Class=field TYPE='TEXT' READONLY NAME='recargos[$i][frcgo]'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=ftipo_$i Class=field TYPE='TEXT' READONLY NAME='recargos[$i][ftipo]'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=frmnd_$i Class=field TYPE='TEXT' READONLY NAME='recargos[$i][frmnd]'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=frvlr_$i Class=field TYPE='TEXT' READONLY NAME='recargos[$i][frvlr]'> <INPUT ID=frapA_$i Class=field TYPE='TEXT' READONLY NAME='recargos[$i][frapA]'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=frmin_$i Class=field TYPE='TEXT' READONLY NAME='recargos[$i][frmin]'> <INPUT ID=frapB_$i Class=field TYPE='TEXT' READONLY NAME='recargos[$i][frapB]'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=frdts_$i Class=field TYPE='TEXT' READONLY NAME='recargos[$i][frdts]'></TD>";
				echo "</TR>";
				echo "<TR HEIGHT=5>";
				echo "  <TD Class=invertir COLSPAN=7></TD>";
				echo "</TR>";
				}
             echo "  </TABLE></CENTER></TD>";
             echo "</TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Guardar Recargos Locales'></TH>";         // Ordena almacenar los datos ingresados
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"cotizaciones_new.php?boton=Consultar&id=$id\"'></TH>";  // Cancela la operación
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
             require_once("footer.php");
echo "</BODY>";
             break;
             }
        case 'Continuacion': {                                                    // Opcion para Adicionar Registros a la tabla
             if (!$rs->Open("select * from vi_cotizaciones where ca_idcotizacion = ".$id)) {    // Mueve el apuntador al registro que se desea consultar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
                 exit;
                }
             echo "<HTML>";
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
             echo "function uno(src,color_entrada) {";
             echo "    src.style.background=color_entrada;src.style.cursor='hand'";
             echo "}";
             echo "function dos(src,color_default) {";
             echo "    src.style.background=color_default;src.style.cursor='default';";
             echo "}";
             echo "function capturas(objeto, i, id){";
             echo "  ventana = document.getElementById('captura');";
             echo "  ventana.style.visibility = \"visible\";";
             echo "  ventana.style.left = eval((document.body.clientWidth/2)-(600/2));";
             echo "  ventana = document.getElementById('frame_captura');";
             echo "  ventana.src='ventanas.php?opcion='+objeto+'\&i='+i+'\&id='+id;";
             echo "}";
             echo "function validar() {";
             echo "    return true;";
             echo "}";
             echo "</script>";
             echo "</HEAD>";
             echo "<BODY  onscroll='dalt=document.body.scrollTop+3; captura.style.top=dalt;'>";
             echo "<DIV ID='captura' STYLE='visibility:hidden; position:absolute; border-width:1; border-color:#445599; border-style:solid;'>";  // left:150; top:25; width:600; height:200
             echo "<IFRAME ID=frame_captura SRC='blanco.html' MARGINWIDTH=0 MARGINHEIGHT=0 FRAMEBORDER='NO' SCROLLING='YES' STYLE='width:600; height:315'>";
             echo "</IFRAME>";
             echo "</DIV>";
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='productos' ACTION='cotizaciones_new.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
			 echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=$id>";
             echo "<TABLE CELLSPACING=1 WIDTH=530>";
			 datos_basicos($rs, 0);
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=2><CENTER><TABLE WIDTH=600 CELLSPACING=1>";
             echo "  <TR>";
             echo "    <TD Class=invertir COLSPAN=9 style='text-align:center; font-weight:bold;'>SERVICIOS DE OTM</TD>";
             echo "  </TR>";

			 echo "<TH>Tipo</TH>";
			 echo "<TH>Modal.</TH>";
			 echo "<TH>Origen</TH>";
			 echo "<TH>Destino</TH>";
			 echo "<TH>Concepto</TH>";
			 echo "<TH>Equipo</TH>";
			 echo "<TH>Flete</TH>";
			 echo "<TH>Mínimo</TH>";
			 echo "<TH>Mnd</TH>";
			 $tm =& DlRecordset::NewRecordset($conn);
			 if (!$tm->Open("select * from vi_cotcontinuacion where ca_idcotizacion = $id")) {       // Selecciona todos lo registros de la tabla Conceptos
				 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
				 echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
				 exit; }
			 $i = 0;
			 while (!$tm->Eof() and !$tm->IsEmpty()) {
				echo "<TR style='background:\"F0F0F0\"' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\"  onclick='javascript:capturas(\"Continuacion\",$i, $id);'>";
				echo "  <INPUT ID=foids_$i TYPE='HIDDEN' NAME='continuacion[$i][foids]' VALUE=".$tm->Value('ca_oid').">";
				echo "  <INPUT ID=fidcn_$i TYPE='HIDDEN' NAME='continuacion[$i][fidcn]' VALUE=".$tm->Value('ca_idconcepto').">";
				echo "  <INPUT ID=fideq_$i TYPE='HIDDEN' NAME='continuacion[$i][fideq]' VALUE=".$tm->Value('ca_idequipo').">";
				echo "  <INPUT ID=fiorg_$i TYPE='HIDDEN' NAME='continuacion[$i][fiorg]' VALUE=".$tm->Value('ca_idorigen').">";
				echo "  <INPUT ID=fidst_$i TYPE='HIDDEN' NAME='continuacion[$i][fidst]' VALUE=".$tm->Value('ca_iddestino').">";
				$atarifa = explode('|',$tm->Value('ca_tarifa'));
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=ftipo_$i Class=field TYPE='TEXT' READONLY NAME='continuacion[$i][ftipo]' VALUE='".$tm->Value('ca_tipo')."'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=fmodl_$i Class=field TYPE='TEXT' READONLY NAME='continuacion[$i][fmodl]' VALUE='".$tm->Value('ca_modalidad')."'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=fcorg_$i Class=field TYPE='TEXT' READONLY NAME='continuacion[$i][fcorg]' VALUE='".$tm->Value('ca_ciuorigen')."'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=fcdst_$i Class=field TYPE='TEXT' READONLY NAME='continuacion[$i][fcdst]' VALUE='".$tm->Value('ca_ciudestino')."'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=fcnpt_$i Class=field TYPE='TEXT' READONLY NAME='continuacion[$i][fcnpt]' VALUE='".$tm->Value('ca_concepto')."'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=feqpo_$i Class=field TYPE='TEXT' READONLY NAME='continuacion[$i][feqpo]' VALUE='".$tm->Value('ca_equipo')."'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=ftrfa_$i Class=field TYPE='TEXT' READONLY NAME='continuacion[$i][ftrfa]' VALUE='".$atarifa[0]."'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=ffmin_$i Class=field TYPE='TEXT' READONLY NAME='continuacion[$i][ffmin]' VALUE='".$atarifa[1]."'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=fmnda_$i Class=field TYPE='TEXT' READONLY NAME='continuacion[$i][fmnda]' VALUE='".$tm->Value('ca_idmoneda')."'></TD>";
				echo "</TR>";
				echo "<TR>";
				echo "  <TD style='vertical-align=top; text-align: left' COLSPAN=3>Frecuencia: <INPUT ID=ffrca_$i Class=field TYPE='TEXT' READONLY NAME='continuacion[$i][ffrca]' VALUE='".$tm->Value('ca_frecuencia')."'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left' COLSPAN=2>T.Tránsito: <INPUT ID=fttrs_$i Class=field TYPE='TEXT' READONLY NAME='continuacion[$i][fttrs]' VALUE='".$tm->Value('ca_tiempotransito')."'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left' COLSPAN=4>Detalles: <INPUT ID=fobsv_$i Class=field TYPE='TEXT' READONLY NAME='continuacion[$i][fobsv]' VALUE='".$tm->Value('ca_observaciones')."'></TD>";
				echo "</TR>";
				echo "<TR HEIGHT=5>";
				echo "  <TD Class=invertir COLSPAN=9></TD>";
				echo "</TR>";
				$tm->MoveNext();
				$i++;
				}
			 for ( $i=$tm->GetRowCount(); $i<($tm->GetRowCount()+5); $i++ ){
				echo "<TR style='background:\"F0F0F0\"' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\"  onclick='javascript:capturas(\"Continuacion\",$i, $id);'>";
				echo "  <INPUT ID=foids_$i TYPE='HIDDEN' NAME='continuacion[$i][foids]'>";
				echo "  <INPUT ID=fidcn_$i TYPE='HIDDEN' NAME='continuacion[$i][fidcn]'>";
				echo "  <INPUT ID=fideq_$i TYPE='HIDDEN' NAME='continuacion[$i][fideq]'>";
				echo "  <INPUT ID=fiorg_$i TYPE='HIDDEN' NAME='continuacion[$i][fiorg]'>";
				echo "  <INPUT ID=fidst_$i TYPE='HIDDEN' NAME='continuacion[$i][fidst]'>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=ftipo_$i Class=field TYPE='TEXT' READONLY NAME='continuacion[$i][ftipo]'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=fmodl_$i Class=field TYPE='TEXT' READONLY NAME='continuacion[$i][fmodl]'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=fcorg_$i Class=field TYPE='TEXT' READONLY NAME='continuacion[$i][fcorg]'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=fcdst_$i Class=field TYPE='TEXT' READONLY NAME='continuacion[$i][fcdst]'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=fcnpt_$i Class=field TYPE='TEXT' READONLY NAME='continuacion[$i][fcnpt]'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=feqpo_$i Class=field TYPE='TEXT' READONLY NAME='continuacion[$i][feqpo]'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=ftrfa_$i Class=field TYPE='TEXT' READONLY NAME='continuacion[$i][ftrfa]'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=ffmin_$i Class=field TYPE='TEXT' READONLY NAME='continuacion[$i][ffmin]'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=fmnda_$i Class=field TYPE='TEXT' READONLY NAME='continuacion[$i][fmnda]'></TD>";
				echo "</TR>";
				echo "<TR>";
				echo "  <TD style='vertical-align=top; text-align: left' COLSPAN=2>Frecuencia: <INPUT ID=ffrca_$i Class=field TYPE='TEXT' READONLY NAME='continuacion[$i][ffrca]'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left' COLSPAN=2>T.Tránsito: <INPUT ID=fttrs_$i Class=field TYPE='TEXT' READONLY NAME='continuacion[$i][fttrs]'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left' COLSPAN=4>Detalles: <INPUT ID=fobsv_$i Class=field TYPE='TEXT' READONLY NAME='continuacion[$i][fobsv]'></TD>";
				echo "</TR>";
				echo "<TR HEIGHT=5>";
				echo "  <TD Class=invertir COLSPAN=9></TD>";
				echo "</TR>";
				}

             echo "  </TABLE></CENTER></TD>";
             echo "</TR>";

             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Guardar Continuación'></TH>";         // Ordena almacenar los datos ingresados
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"cotizaciones_new.php?boton=Consultar&id=$id\"'></TH>";  // Cancela la operación
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
             require_once("footer.php");
echo "</BODY>";
             break;
             }
        case 'Seguro': {                                                    // Opcion para Adicionar Registros a la tabla
             if (!$rs->Open("select * from vi_cotizaciones where ca_idcotizacion = ".$id)) {    // Mueve el apuntador al registro que se desea consultar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
                 exit;
                }
             echo "<HTML>";
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
             echo "function uno(src,color_entrada) {";
             echo "    src.style.background=color_entrada;src.style.cursor='hand'";
             echo "}";
             echo "function dos(src,color_default) {";
             echo "    src.style.background=color_default;src.style.cursor='default';";
             echo "}";
             echo "function capturas(objeto, i, id){";
             echo "  ventana = document.getElementById('captura');";
             echo "  ventana.style.visibility = \"visible\";";
             echo "  ventana.style.left = eval((document.body.clientWidth/2)-(600/2));";
             echo "  ventana = document.getElementById('frame_captura');";
             echo "  ventana.src='ventanas.php?opcion='+objeto+'\&i='+i+'\&id='+id;";
             echo "}";
             echo "function validar() {";
             echo "    return true;";
             echo "}";
             echo "</script>";
             echo "</HEAD>";
             echo "<BODY  onscroll='dalt=document.body.scrollTop+3; captura.style.top=dalt;'>";
             echo "<DIV ID='captura' STYLE='visibility:hidden; position:absolute; border-width:1; border-color:#445599; border-style:solid;'>";  // left:150; top:25; width:600; height:200
             echo "<IFRAME ID=frame_captura SRC='blanco.html' MARGINWIDTH=0 MARGINHEIGHT=0 FRAMEBORDER='NO' SCROLLING='YES' STYLE='width:600; height:315'>";
             echo "</IFRAME>";
             echo "</DIV>";
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='productos' ACTION='cotizaciones_new.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
			 echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=$id>";
             echo "<TABLE CELLSPACING=1 WIDTH=530>";
			 datos_basicos($rs, 0);
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=2><CENTER><TABLE WIDTH=600 CELLSPACING=1>";
             echo "  <TR>";
             echo "    <TD Class=invertir COLSPAN=6 style='text-align:center; font-weight:bold;'>SERVICIOS DE SEGURO</TD>";
             echo "  </TR>";

			 echo "<TH>Tipo</TH>";
			 echo "<TH>Prima</TH>";
			 echo "<TH>Mínimo</TH>";
			 echo "<TH>Obtención</TH>";
			 echo "<TH>Mnd</TH>";
			 echo "<TH WIDTH=280>Detalles</TH>";
			 $tm =& DlRecordset::NewRecordset($conn);
			 if (!$tm->Open("select oid as ca_oid,* from tb_cotseguro where ca_idcotizacion = $id")) {       // Selecciona todos lo registros de la tabla Conceptos
				 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
				 echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
				 exit; }
			 $i = 0;
			 while (!$tm->Eof() and !$tm->IsEmpty()) {
				echo "<TR style='background:\"F0F0F0\"' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\"  onclick='javascript:capturas(\"Seguro\",$i, $id);'>";
				echo "  <INPUT ID=foids_$i TYPE='HIDDEN' NAME='seguros[$i][foids]' VALUE=".$tm->Value('ca_oid').">";
				$aprima = explode('|',$tm->Value('ca_prima'));
				$aobtencion = explode('|',$tm->Value('ca_obtencion'));
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=ftipo_$i Class=field TYPE='TEXT' READONLY NAME='seguros[$i][ftipo]' VALUE='".$aprima[0]."'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=fprma_$i Class=field TYPE='TEXT' READONLY NAME='seguros[$i][fprma]' VALUE='".$aprima[1]."'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=fsmin_$i Class=field TYPE='TEXT' READONLY NAME='seguros[$i][fsmin]' VALUE='".$aprima[2]."'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=fobtc_$i Class=field TYPE='TEXT' READONLY NAME='seguros[$i][fobtc]' VALUE='".$aobtencion[0]."'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=fmnda_$i Class=field TYPE='TEXT' READONLY NAME='seguros[$i][fmnda]' VALUE='".$tm->Value('ca_idmoneda')."'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=fobsv_$i Class=field TYPE='TEXT' READONLY NAME='seguros[$i][fobsv]' VALUE='".$tm->Value('ca_observaciones')."'></TD>";
				echo "</TR>";
				echo "<TR HEIGHT=5>";
				echo "  <TD Class=invertir COLSPAN=6></TD>";
				echo "</TR>";
				$tm->MoveNext();
				$i++;
				}
			 for ( $i=$tm->GetRowCount(); $i<($tm->GetRowCount()+5); $i++ ){
				echo "<TR style='background:\"F0F0F0\"' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\"  onclick='javascript:capturas(\"Seguro\",$i, $id);'>";
				echo "  <INPUT ID=foids_$i TYPE='HIDDEN' NAME='seguros[$i][foids]'>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=ftipo_$i Class=field TYPE='TEXT' READONLY NAME='seguros[$i][ftipo]'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=fprma_$i Class=field TYPE='TEXT' READONLY NAME='seguros[$i][fprma]'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=fsmin_$i Class=field TYPE='TEXT' READONLY NAME='seguros[$i][fsmin]'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=fobtc_$i Class=field TYPE='TEXT' READONLY NAME='seguros[$i][fobtc]'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=fmnda_$i Class=field TYPE='TEXT' READONLY NAME='seguros[$i][fmnda]'></TD>";
				echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=fobsv_$i Class=field TYPE='TEXT' READONLY NAME='seguros[$i][fobsv]'></TD>";
				echo "</TR>";
				echo "<TR HEIGHT=5>";
				echo "  <TD Class=invertir COLSPAN=6></TD>";
				echo "</TR>";
				}

             echo "  </TABLE></CENTER></TD>";
             echo "</TR>";

             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Guardar Seguros'></TH>";         // Ordena almacenar los datos ingresados
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"cotizaciones_new.php?boton=Consultar&id=$id\"'></TH>";  // Cancela la operación
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
             require_once("footer.php");
echo "</BODY>";
             break;
             }
      }
   }
elseif (isset($accion)) {                                                      // Rutina que registra los cambios en la tabla de la base de datos
    switch(trim($accion)) {                                                    // Switch que evalua cual botòn de comando fue pulsado por el usuario
        case 'Guardar': {                                                      // El Botón Guardar fue pulsado
			 if (!$rs->Open("select nextval('tb_cotizaciones_id')")) {
				 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
				 echo "<script>document.location.href = 'comisiones.php';</script>";
				 exit;
			 }
             $id = $rs->Value('nextval');
             if (!$rs->Open("insert into tb_cotizaciones (ca_idcotizacion, ca_fchcotizacion, ca_idcontacto, ca_asunto, ca_saludo, ca_entrada, ca_despedida, ca_anexos, ca_fchsolicitud, ca_horasolicitud, ca_usuario, ca_fchcreado, ca_usucreado) values('$id','$fchcotizacion',$idcontacto,'$asunto','$saludo','$entrada','$despedida','$anexos','$fchsolicitud','$horasolicitud','$vendedor',to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'),'$usuario')")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
                 exit;
                }
             break;
             }
        case 'Copiar en Nueva Cotización': {                                                      // El Botón Guardar fue pulsado
			 if (!$rs->Open("select nextval('tb_cotizaciones_id')")) {
				 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
				 echo "<script>document.location.href = 'comisiones.php';</script>";
				 exit;
			 }
             $id_new = $rs->Value('nextval');
             if (!$rs->Open("insert into tb_cotizaciones (ca_idcotizacion, ca_fchcotizacion, ca_idcontacto, ca_asunto, ca_saludo, ca_entrada, ca_despedida, ca_anexos, ca_usuario, ca_fchcreado, ca_usucreado) select $id_new, '".date("Y-m-d")."', ca_idcontacto, ca_asunto, ca_saludo, ca_entrada, ca_despedida, ca_anexos, ca_usuario, to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$usuario' from tb_cotizaciones where ca_idcotizacion = '$id'")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
                 exit;
                }
             if (!$rs->Open("insert into tb_cotproductos (ca_idcotizacion, ca_idproducto, ca_producto, ca_impoexpo, ca_transporte, ca_modalidad, ca_incoterms, ca_origen, ca_destino, ca_observaciones, ca_imprimir, ca_fchcreado, ca_usucreado) select $id_new, ca_idproducto, ca_producto, ca_impoexpo, ca_transporte, ca_modalidad, ca_incoterms, ca_origen, ca_destino, ca_observaciones, ca_imprimir, to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$usuario' from tb_cotproductos where ca_idcotizacion = '$id'")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
                 exit;
                }
             if (!$rs->Open("insert into tb_cotopciones (ca_idcotizacion, ca_idproducto, ca_idopcion, ca_idconcepto, ca_idmoneda, ca_tarifa, ca_oferta, ca_recargos, ca_observaciones, ca_fchcreado, ca_usucreado) select $id_new, ca_idproducto, ca_idopcion, ca_idconcepto, ca_idmoneda, ca_tarifa, ca_oferta, ca_recargos, ca_observaciones, to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$usuario' from tb_cotopciones where ca_idcotizacion = '$id'")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
                 exit;
                }
             if (!$rs->Open("insert into tb_cotrecargos (ca_idcotizacion, ca_idproducto, ca_idopcion, ca_idconcepto, ca_idrecargo, ca_tipo, ca_valor_tar, ca_aplica_tar, ca_valor_min, ca_aplica_min, ca_idmoneda, ca_modalidad, ca_observaciones, ca_fchcreado, ca_usucreado) select $id_new, ca_idproducto, ca_idopcion, ca_idconcepto, ca_idrecargo, ca_tipo, ca_valor_tar, ca_aplica_tar, ca_valor_min, ca_aplica_min, ca_idmoneda, ca_modalidad, ca_observaciones, to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$usuario' from tb_cotrecargos where ca_idcotizacion = '$id'")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
                 exit;
                }
             if (!$rs->Open("insert into tb_cotcontinuacion (ca_idcotizacion, ca_tipo, ca_modalidad, ca_origen, ca_destino, ca_idconcepto, ca_idequipo, ca_idmoneda, ca_tarifa, ca_frecuencia, ca_tiempotransito, ca_observaciones, ca_fchcreado, ca_usucreado) select $id_new, ca_tipo, ca_modalidad, ca_origen, ca_destino, ca_idconcepto, ca_idequipo, ca_idmoneda, ca_tarifa, ca_frecuencia, ca_tiempotransito, ca_observaciones, to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$usuario' from tb_cotcontinuacion where ca_idcotizacion = '$id'")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
                 exit;
                }
             if (!$rs->Open("insert into tb_cotseguro (ca_idcotizacion, ca_idmoneda, ca_prima, ca_obtencion, ca_observaciones, ca_fchcreado, ca_usucreado) select $id_new, ca_idmoneda, ca_prima, ca_obtencion, ca_observaciones, to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$usuario' from tb_cotseguro where ca_idcotizacion = '$id'")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
                 exit;
                }
             $id = $id_new;
             break;
             }
        case 'Actualizar': {                                                   // El Botón Actualizar fue pulsado
             if (!$rs->Open("update tb_cotizaciones set ca_fchcotizacion = '$fchcotizacion', ca_idcontacto = $idcontacto, ca_asunto = '$asunto', ca_saludo = '$saludo', ca_entrada = '$entrada', ca_despedida = '$despedida', ca_anexos = '$anexos', ca_fchsolicitud = '$fchsolicitud', ca_horasolicitud = '$horasolicitud', ca_usuario = '$vendedor', ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), ca_usuactualizado = '$usuario' where ca_idcotizacion = $id")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
                 exit;
                }
             break;
             }
        case 'Guardar Productos': {                                                      // El Botón Guardar fue pulsado
             while (list ($clave, $val) = each ($productos)) {
                if ($val[fidpr] == 0 and $val[fdlte] == -1 and strlen($val[fprod]) != 0) {
					if (!$rs->Open("insert into tb_cotproductos (ca_idcotizacion, ca_producto, ca_impoexpo, ca_transporte, ca_modalidad, ca_incoterms, ca_origen, ca_destino, ca_observaciones, ca_imprimir, ca_fchcreado, ca_usucreado) values($id, '".AddSlashes($val[fprod])."', '$val[fimex]', '$val[ftrns]', '$val[fmodl]', '$val[finct]', '$val[fiorg]', '$val[fidst]', '".AddSlashes($val[fobsv])."', '$val[fimpr]', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$usuario')")) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
                        exit; }
                }else if ($val[fidpr] != 0 and $val[fdlte] == 0) {
                    if (!$rs->Open("update tb_cotproductos set ca_producto = '".AddSlashes($val[fprod])."', ca_impoexpo = '$val[fimex]', ca_transporte = '$val[ftrns]', ca_modalidad = '$val[fmodl]', ca_incoterms = '$val[finct]', ca_origen = '$val[fiorg]', ca_destino = '$val[fidst]', ca_observaciones = '".AddSlashes($val[fobsv])."', ca_imprimir = '$val[fimpr]', ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), ca_usuactualizado = '$usuario' where ca_idcotizacion = $id and ca_idproducto = ".$val[fidpr])) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
                        exit; }
                }else if ($val[fidpr] == $val[fdlte]) {
                    if (!$rs->Open("delete from tb_cotrecargos where ca_idcotizacion = $id and ca_idproducto = ".$val[fidpr])) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
                        exit; }
                    if (!$rs->Open("delete from tb_cotopciones where ca_idcotizacion = $id and ca_idproducto = ".$val[fidpr])) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
                        exit; }
                    if (!$rs->Open("delete from tb_cotproductos where ca_idcotizacion = $id and ca_idproducto = ".$val[fidpr])) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
                        exit; }
					}
             	}
             break;
             }
        case 'Guardar Continuación': {                                                      // El Botón Guardar fue pulsado
             while (list ($clave, $val) = each ($continuacion)) {
			 	$tarifa = $val[ftrfa]."|".$val[ffmin];
                if ($val[foids] != 0 and strlen($tarifa)>1) {
                    if (!$rs->Open("update tb_cotcontinuacion set ca_tipo = '$val[ftipo]', ca_modalidad = '$val[fmodl]', ca_origen = '$val[fiorg]', ca_destino = '$val[fidst]', ca_idconcepto = '$val[fidcn]', ca_idequipo = '$val[fideq]', ca_idmoneda = '$val[fmnda]', ca_tarifa = '$tarifa', ca_frecuencia = '$val[ffrca]', ca_tiempotransito = '$val[fttrs]', ca_observaciones = '".AddSlashes($val[fobsv])."', ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), ca_usuactualizado = '$usuario' where oid = ".$val[foids])) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
                        exit;
                       }
                }else if ($val[foids] != 0 and strlen($tarifa)==1) {
                    if (!$rs->Open("delete from tb_cotcontinuacion where oid = ".$val[foids])) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
                        exit;
                       }
				}else {
					if (strlen($val[ftrfa]) == 0){
						continue;
					}else if (!$rs->Open("insert into tb_cotcontinuacion (ca_idcotizacion, ca_tipo, ca_modalidad, ca_origen, ca_destino, ca_idconcepto, ca_idequipo, ca_idmoneda, ca_tarifa, ca_frecuencia, ca_tiempotransito, ca_observaciones, ca_fchcreado, ca_usucreado) values ($id,  '$val[ftipo]', '$val[fmodl]', '$val[fiorg]', '$val[fidst]', '$val[fidcn]', '$val[fideq]', '$val[fmnda]', '$tarifa', '$val[ffrca]', '$val[fttrs]', '".AddSlashes($val[fobsv])."' , to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$usuario')")) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
                        exit;
                       }
                    }
             	}
             break;
             }
        case 'Guardar Seguros': {                                                      // El Botón Guardar fue pulsado
             while (list ($clave, $val) = each ($seguros)) {
			 	$prima = $val[ftipo]."|".$val[fprma]."|".$val[fsmin];
                if ($val[foids] != 0) {
                    if (!$rs->Open("update tb_cotseguro set ca_idmoneda = '$val[fmnda]', ca_prima = '$prima', ca_obtencion = '$val[fobtc]', ca_observaciones = '".AddSlashes($val[fobsv])."', ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), ca_usuactualizado = '$usuario' where oid = ".$val[foids])) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
                        exit;
                       }
				}else {
					if (strlen($val[fprma]) == 0){
						continue;
					}else if (!$rs->Open("insert into tb_cotseguro (ca_idcotizacion, ca_idmoneda, ca_prima, ca_obtencion, ca_observaciones, ca_fchcreado, ca_usucreado) values ($id, '$val[fmnda]', '$prima', '$val[fobtc]', '".AddSlashes($val[fobsv])."', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$usuario')")) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
                        exit;
                       }
                    }
             	}
             break;
             }
        case 'Guardar Recargos Locales': {                                                      // El Botón Guardar fue pulsado
             while (list ($clave, $val) = each ($recargos)) {
				if ($val[foids] == '' and $val[fidrc] != '') {
					if (!$rs->Open("insert into tb_cotrecargos (ca_idcotizacion, ca_idproducto, ca_idopcion, ca_idconcepto, ca_idrecargo, ca_tipo, ca_valor_tar, ca_aplica_tar, ca_valor_min, ca_aplica_min, ca_idmoneda, ca_modalidad, ca_observaciones, ca_fchcreado, ca_usucreado) values ($id, 99, 999, 9999, '$val[fidrc]', '$val[ftipo]', '$val[frvlr]', '$val[frapA]', '$val[frmin]', '$val[frapB]', '$val[frmnd]', '$val[frmdl]', '".AddSlashes($val[frdts])."', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$usuario')")) {
						echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
						echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
						exit;
                       }
				}else if ($val[foids] != 0 and $val[fidrc] != '') {
                    if (!$rs->Open("update tb_cotrecargos set ca_idrecargo = '$val[fidrc]', ca_tipo = '$val[ftipo]', ca_valor_tar = '$val[frvlr]', ca_aplica_tar = '$val[frapA]', ca_valor_min = '$val[frmin]', ca_aplica_min = '$val[frapB]', ca_idmoneda = '$val[frmnd]', ca_modalidad = '$val[frmdl]', ca_observaciones = '".AddSlashes($val[frdts])."', ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), ca_usuactualizado = '$usuario' where oid = ".$val[foids])) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
                        exit;
                       }
				}else if ($val[foids] != 0 and $val[fidrc] == '') {
                    if (!$rs->Open("delete from tb_cotrecargos where oid = ".$val[foids])) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
                        exit;
                       }
             		}
				}
             break;
             }
        case 'Registrar Contactos': {                                                   // El Botón Actualizar fue pulsado
            $datosag = isset($datosag)?implode("|",$datosag):"";
             if (!$rs->Open("update tb_cotproductos set ca_datosag = '$datosag' where ca_idcotizacion = $id and ca_idproducto = $pr")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
                 exit;
                }
             break;
             }
        case 'Guardar Opciones': {                                                      // El Botón Guardar fue pulsado
             if (!$rs->Open("update tb_cotproductos set ca_frecuencia = '$frecuencia', ca_tiempotransito = '$tiempotransito' where ca_idcotizacion = $id and ca_idproducto = $pr")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
                 exit;
                }
			 for ($i=0; $i<count($opciones); $i++ ){
				$opciones_reg = $opciones[$i];
				$recargos_reg = $recargos[$i];
				if ($opciones_reg['fidop'] == 0 and $opciones_reg['fidcn'] != ''){
					if (!$rs->Open("insert into tb_cotopciones (ca_idcotizacion, ca_idproducto, ca_idconcepto, ca_idmoneda, ca_tarifa, ca_oferta, ca_recargos, ca_observaciones, ca_fchcreado, ca_usucreado) values($id, $pr, '".$opciones_reg['fidcn']."', '".$opciones_reg['fmnda']."', '', '".$opciones_reg['fflte'].'|'.$opciones_reg['ffmin'].'|'.$opciones_reg['ffapl']."', '".addslashes($recargos_mem)."', '".$opciones_reg['fdets']."', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'),'$usuario')")) {
						echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
						echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
						exit; }
					if (!$rs->Open("select last_value from tb_cotopciones_id")) {
						echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
						echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
						exit; }
					$opc = $rs->Value('last_value');
					while (list ($clave_1, $val_1) = each ($recargos_reg)) {
						if ($val_1[frvlr] == 0){
							continue;
						}else if (!$rs->Open("insert into tb_cotrecargos (ca_idcotizacion, ca_idproducto, ca_idopcion, ca_idconcepto, ca_idrecargo, ca_tipo, ca_valor_tar, ca_aplica_tar, ca_valor_min, ca_aplica_min, ca_idmoneda, ca_modalidad, ca_observaciones, ca_fchcreado, ca_usucreado) values ($id, $pr, $opc, '".$opciones_reg['fidcn']."', '$val_1[fidrc]', '$val_1[ftipo]', '$val_1[frvlr]', '$val_1[frapA]', '$val_1[frmin]', '$val_1[frapB]', '$val_1[frmnd]', '$val_1[frmdl]', '".AddSlashes($val_1[frdts])."', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$usuario')")) {
							echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
							echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
							exit;
						   }
						}
				}else if ($opciones_reg['fidop'] != 0 and $opciones_reg['fidcn'] == ''){
					$opc = $opciones_reg['fidop'];
					if (!$rs->Open("delete from tb_cotrecargos where ca_idopcion = ".$opciones_reg['fidop'])) {
						echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
						echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
						exit; }
					if (!$rs->Open("delete from tb_cotopciones where ca_idopcion = ".$opciones_reg['fidop'])) {
						echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
						echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
						exit; }
				}else if ($opciones_reg['fidop'] != 0 and $opciones_reg['fidcn'] != ''){
					$opc = $opciones_reg['fidop'];
					while (list ($clave_1, $val_1) = each ($recargos_reg)) {
						if ($val_1[fdltr] == '' and $val_1[frvlr] == 0){
							continue;
						}else if($val_1[foidr] == ''){
							if (!$rs->Open("insert into tb_cotrecargos (ca_idcotizacion, ca_idproducto, ca_idopcion, ca_idconcepto, ca_idrecargo, ca_tipo, ca_valor_tar, ca_aplica_tar, ca_valor_min, ca_aplica_min, ca_idmoneda, ca_modalidad, ca_observaciones, ca_fchcreado, ca_usucreado) values ($id, $pr, '".$opciones_reg['fidop']."', '".$opciones_reg['fidcn']."', '$val_1[fidrc]', '$val_1[ftipo]', '$val_1[frvlr]', '$val_1[frapA]', '$val_1[frmin]', '$val_1[frapB]', '$val_1[frmnd]', '$val[frmdl]', '".AddSlashes($val_1[frdts])."', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$usuario')")) {
								echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
								echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
								exit;
							   }
						}else if($val_1[foidr] == $val_1[fdltr]){
							if (!$rs->Open("delete from tb_cotrecargos where oid = ".$val_1[fdltr])) {
								echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
								echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
								exit;
							   }
						}else 
							if (!$rs->Open("update tb_cotrecargos set ca_idrecargo = '$val_1[fidrc]', ca_tipo = '$val_1[ftipo]', ca_valor_tar = '$val_1[frvlr]', ca_aplica_tar = '$val_1[frapA]', ca_valor_min = '$val_1[frmin]', ca_aplica_min = '$val_1[frapB]', ca_idmoneda = '$val_1[frmnd]', ca_observaciones = '".AddSlashes($val_1[frdts])."', ca_usuactualizado = '$usuario', ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss') where oid = ".$val_1[foidr])) {
								echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
								echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
								exit;
							   }
						}
					if (!$rs->Open("update tb_cotopciones set ca_idconcepto = '".$opciones_reg['fidcn']."', ca_idmoneda = '".$opciones_reg['fmnda']."', ca_tarifa = '', ca_oferta = '".$opciones_reg['fflte']."|".$opciones_reg['ffmin'].'|'.$opciones_reg['ffapl']."', ca_recargos = '".addslashes($recargos_mem)."', ca_observaciones = '".$opciones_reg['fdets']."', ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), ca_usuactualizado = '$usuario' where ca_idopcion = ".$opciones_reg['fidop'])) {
						echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
						echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
						exit; }
					}
				}
			 for ($i=$i; $i<count($recargos); $i++ ){
				$recargos_reg = $recargos[$i];
				while (list ($clave_1, $val_1) = each ($recargos_reg)) {
					if ($val_1[fdltr] == '' and $val_1[frvlr] == 0){
						continue;
					}else if($val_1[foidr] == ''){
						if (!$rs->Open("insert into tb_cotrecargos (ca_idcotizacion, ca_idproducto, ca_idopcion, ca_idconcepto, ca_idrecargo, ca_tipo, ca_valor_tar, ca_aplica_tar, ca_valor_min, ca_aplica_min, ca_idmoneda, ca_modalidad, ca_observaciones, ca_fchcreado, ca_usucreado) values ($id, $pr, '999', '9999', '$val_1[fidrc]', '$val_1[ftipo]', '$val_1[frvlr]', '$val_1[frapA]', '$val_1[frmin]', '$val_1[frapB]', '$val_1[frmnd]', '$val[frmdl]', '".AddSlashes($val_1[frdts])."', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$usuario')")) {
							echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
							echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
							exit;
						   }
					}else if($val_1[foidr] == $val_1[fdltr]){
						if (!$rs->Open("delete from tb_cotrecargos where oid = ".$val_1[fdltr])) {
							echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
							echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
							exit;
						   }
					}else 
						if (!$rs->Open("update tb_cotrecargos set ca_idrecargo = '$val_1[fidrc]', ca_tipo = '$val_1[ftipo]', ca_valor_tar = '$val_1[frvlr]', ca_aplica_tar = '$val_1[frapA]', ca_valor_min = '$val_1[frmin]', ca_aplica_min = '$val_1[frapB]', ca_idmoneda = '$val_1[frmnd]', ca_observaciones = '".AddSlashes($val_1[frdts])."', ca_usuactualizado = '$usuario', ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss') where oid = ".$val_1[foidr])) {
							echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
							echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
							exit;
						   }
					}
				}
             break;
             }
        case 'Eliminar Opción': {                                                      // El Botón Guardar fue pulsado
             if (!$rs->Open("delete from tb_cotopciones where ca_idcotizacion = $id and ca_idproducto = $pr")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones_new.php';</script>";
                 exit;
                }
             break;
             }
        }
    echo "<script>document.location.href = 'cotizaciones_new.php?boton=Consultar&\id=$id';</script>";  // Retorna a la pantalla principal de la opción
   }


function datos_basicos(&$rs, $vi){
	
	echo "<TH Class=titulo COLSPAN=".($vi+2).">Datos de la Cotización</TH>";
	echo "<TR>";
	echo "  <TD Class=captura>Datos de Control:</TD>";
	echo "  <TD Class=invertir><TABLE CELLSPACING=1 WIDTH=100%>";
	echo "  <TD Class=listar>Fecha de Cotización :<br /><CENTER>".$rs->Value('ca_fchcotizacion')."</CENTER></TD>";
	echo "  <TD Class=listar>Fecha de Solicitud :<br /><CENTER>".$rs->Value('ca_fchsolicitud')."</CENTER></TD>";
	echo "  <TD Class=listar>Hora de Solicitud :<br /><CENTER>".$rs->Value('ca_horasolicitud')."</CENTER></TD>";
	echo "  <TD Class=listar>No. de Cotización :<br /><CENTER>".$rs->Value('ca_consecutivo')."</CENTER></TD>";
	echo "  </TABLE></TD>";
	if ($vi == 1){
	    echo "  <TD Class=listar ROWSPAN=5><IMG style='visibility: $visible;' src='./graficos/edit.gif' alt='Editar el Registro' border=0 onclick='elegir(\"Modificar\", ".$rs->Value('ca_idcotizacion').");'></TD>";
	}
	echo "</TR>";
	echo "<TR>";
	echo "  <INPUT ID=id_cli TYPE='HIDDEN' NAME='idcontacto' VALUE=".$rs->Value('ca_idcontacto').">";
	echo "  <TD Class=titulo style='text-align:left; vertical-align:top;'>Cliente:<BR></TD>";
	echo "  <TD Class=invertir><TABLE WIDTH=100% CELLSPACING=1 WIDTH=425>";
	echo "  <TR>";
	echo "    <TD Class=mostrar><B>Nombre:</B><BR>".$rs->Value('ca_compania')."</TD>";
	echo "    <TD Class=mostrar></TD>";
	echo "  </TR>";
	echo "  <TR>";
	echo "    <TD Class=mostrar><B>Contacto:</B><BR>".$rs->Value('ca_ncompleto_cn')."</TD>";
	echo "    <TD Class=mostrar><B>Teléfono:</B><BR>".$rs->Value('ca_telefonos')."</TD>";
	echo "  </TR>";
	$direccion = str_replace ("|"," ",$rs->Value('ca_direccion_cl')).(($rs->Value('ca_oficina')!='')?" Oficina : ".$rs->Value('ca_oficina'):"" . ($rs->Value('ca_torre')!='')?" Torre : ".$rs->Value('ca_torre'):"" . ($rs->Value('ca_interior')!='')?" Interior : ".$rs->Value('ca_interior'):"" . ($rs->Value('ca_complemento')!='')?" - ".$rs->Value('ca_complemento'):"");
	echo "  <TR>";
	echo "    <TD Class=mostrar><B>Dirección:</B><BR>".$direccion."</TD>";
	echo "    <TD Class=mostrar><B>Fax:</B><BR>".$rs->Value('ca_fax')."</TD>";
	echo "  </TR>";
	echo "  <TR>";
	echo "    <TD Class=mostrar COLSPAN=2><B>Correo Electrónico:</B><BR>".$rs->Value('ca_email')."</TD>";
	echo "  </TR>";
	echo "  </TABLE></TD>";
	echo "</TR>";
	echo "<TR>";
	echo "  <TD Class=captura>Asunto:</TD>";
	echo "  <TD Class=mostrar>".$rs->Value('ca_asunto')."<BR>&nbsp</TD>";
	echo "</TR>";
	echo "<TR>";
	echo "  <TD Class=captura>Saludo:</TD>";
	echo "  <TD Class=mostrar>".nl2br($rs->Value('ca_saludo'))."<BR>&nbsp</TD>";
	echo "</TR>";
	echo "<TR>";
	echo "  <TD Class=captura style='vertical-align:top;'>Entrada:</TD>";
	echo "  <TD Class=mostrar>".nl2br($rs->Value('ca_entrada'))."<BR>&nbsp</TD>";
	echo "</TR>";
}
?>