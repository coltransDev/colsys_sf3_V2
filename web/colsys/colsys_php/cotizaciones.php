<?php
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       COTIZACIONES.PHP                                            \\
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
    echo "</HEAD>";
    echo "<BODY style='margin-top: 0px; margin-bottom: 0px; margin-left: 0px; margin-right: 0px; text-align: right; font-size: 11px; font-weight:bold;'>";
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<H3>$titulo</H3>";
    echo "<FORM METHOD=post NAME='findCotizacion' ACTION='cotizaciones.php'>";
    echo "<TABLE WIDTH=450 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
    echo "<TH COLSPAN=4 style='font-size: 12px; font-weight:bold;'><B>Ingrese un criterio para realizar las busqueda</TH>";
    echo "<TR>";
    echo "  <TH ROWSPAN=2>&nbsp</TH>";
    echo "  <TD Class=listar ROWSPAN=2><B>Buscar por:</B><BR><SELECT NAME='modalidad' SIZE=4>";
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

			 if (!$rs->Open("select c.ca_idcotizacion, c.ca_fchcotizacion, c.ca_compania, c.ca_ncompleto_cn, c.ca_asunto, c.ca_usuario, c.ca_vendedor, p.ca_producto, p.ca_impoexpo, p.ca_transporte, p.ca_modalidad, c1.ca_ciudad as ca_ciuorigen, c2.ca_ciudad as ca_ciudestino from vi_cotizaciones c LEFT OUTER JOIN tb_cotproductos p on (c.ca_idcotizacion = p.ca_idcotizacion) LEFT OUTER JOIN tb_ciudades c1 on (p.ca_origen = c1.ca_idciudad) LEFT OUTER JOIN tb_ciudades c2 on (p.ca_destino = c2.ca_idciudad) where $condicion")) {          // Selecciona todos lo registros de la tabla Grupos
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";                   // Muestra el mensaje de error
                 echo "<script>document.location.href = 'entrada.php';</script>";
                 exit; }
             echo "<HTML>";
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
             echo "function elegir(opcion, id){";
             echo "    document.location.href = 'cotizaciones.php?boton='+opcion+'\&id='+id;";
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
             echo "<TH><CENTER><IMG src='./graficos/new.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(\"Adicionar\", 0);'></CENTER></TH>";  // Botón para la creación de un Registro Nuevo
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
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Cancelar' ONCLICK='javascript:location.href = \"cotizaciones.php\"'></TH>";  // Cancela la operación
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
             if (!$rs->Open("select * from vi_cotizaciones where ca_idcotizacion = ".$id)) {    // Mueve el apuntador al registro que se desea consultar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones.php';</script>";
                 exit;
                }
             $pr =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
             if (!$pr->Open("select * from vi_cotproductos where ca_idcotizacion = ".$id)) {    // Mueve el apuntador al registro que se desea consultar
                 echo "<script>alert(\"".addslashes($pr->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones.php';</script>";
                 exit;
                }
             $op =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
             if (!$op->Open("select * from vi_cotopciones where ca_idcotizacion = ".$id)) {    // Mueve el apuntador al registro que se desea consultar
                 echo "<script>alert(\"".addslashes($op->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones.php';</script>";
                 exit;
                }
             $visible = ($rs->Value('ca_usuario')== $usuario or $nivel >= 1)?'visible':'hidden';
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
             echo "function elegir(opcion, id, pr){";
             echo "    document.location.href = 'cotizaciones.php?boton='+opcion+'\&id='+id+'\&pr='+pr;";
             echo "}";
             echo "</script>";
             echo "</HEAD>";

             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='consultar' ACTION='cotizaciones.php'>"; // Crea una forma con datos vacios
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";                 // Hereda el Id del registro que se esta modificando
             echo "<TABLE CELLSPACING=1 WIDTH=530>";
             echo "<TH Class=titulo COLSPAN=2>Datos de la Cotización</TH>";
             echo "<TH Class=titulo></TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Fecha&nbspCotización:</TD>";
             echo "  <TD Class=listar><TABLE WIDTH=70% CELLSPACING=0 BORDER=0>";
             echo "  <TR>";
             echo "    <TD Class=listar><B>".$rs->Value('ca_fchcotizacion')."</B></TD>";
             echo "    <TD Class=listar>No. de Cotización :</TD>";
             echo "    <TD Class=listar><B>".$rs->Value('ca_idcotizacion')."</B></TD>";
             echo "  </TR>";
             echo "  </TABLE></TD>";
             echo "  <TD Class=listar ROWSPAN=5><IMG style='visibility: $visible;' src='./graficos/edit.gif' alt='Editar el Registro' border=0 onclick='elegir(\"Modificar\", ".$rs->Value('ca_idcotizacion').");'></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <INPUT ID=id_cli TYPE='HIDDEN' NAME='idcontacto' VALUE=".$rs->Value('ca_idcontacto').">";
             echo "  <TD Class=titulo style='text-align:left; vertical-align:top;'>Cliente:<BR></TD>";
             echo "  <TD Class=invertir><TABLE CELLSPACING=1 WIDTH=425>";
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
             echo "  </TABLE><TD>";
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

             echo "<TR>";
             echo "  <TD Class=invertir COLSPAN=3>";
             echo "    <TABLE CELLSPACING=1 WIDTH=560>";
             echo "      <TR><TH Class=titulo COLSPAN=7>Relación de Productos a Transportar</TH><TR>";
             echo "      <TH Class=titulo>&nbsp</TH>";
             echo "      <TH Class=titulo>Impo/Expo</TH>";
             echo "      <TH Class=titulo>Transporte</TH>";
             echo "      <TH Class=titulo>Origen</TH>";
             echo "      <TH Class=titulo>Destino</TH>";
             echo "      <TH Class=titulo>Contactos</TH>";
             echo "      <TH WIDTH=44><IMG style='visibility: $visible;' src='./graficos/new.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(\"AdicionarPr\", $id, 0);'></TH>";  // Botón para la creación de un Registro Nuevo
             $num_pro = 0;
             while (!$pr->Eof() and !$pr->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
                if ($pr->Value('ca_idproducto') != $num_pro) {
                    echo "   <TR>";
                    echo "    <TD Class=listar COLSPAN=6><B>Producto :</B><BR>".$pr->Value('ca_producto')."</TD>";
                    echo "    <TD WIDTH=44 Class=listar>";                                             // Botones para hacer Mantenimiento a la Tabla
                    echo "      <IMG style='visibility: $visible;' src='./graficos/edit.gif' alt='Editar el Registro' border=0 onclick='elegir(\"ModificarPr\", $id, ".$pr->Value('ca_idproducto').");'>";
                    echo "      <IMG style='visibility: $visible;' src='./graficos/del.gif'  alt='Eliminar el Registro' border=0 onclick='elegir(\"EliminarPr\", $id, ".$pr->Value('ca_idproducto').");'>";
                    echo "    </TD>";
                    echo "   </TR>";
                    $num_pro = $pr->Value('ca_idproducto');
                    }
                echo "   <TR>";
                echo "    <TD Class=listar ROWSPAN=2></TD>";
                echo "    <TD Class=listar><B>".$pr->Value('ca_impoexpo')."</B><BR>".$pr->Value('ca_modalidad')."</TD>";
                echo "    <TD Class=listar><B>".$pr->Value('ca_transporte')."</B><BR>".$pr->Value('ca_incoterms')."</TD>";
                echo "    <TD Class=listar style='text-align:center;'><B>".$pr->Value('ca_ciuorigen')."</B><BR>".$pr->Value('ca_traorigen')."</TD>";
                echo "    <TD Class=listar style='text-align:center;'><B>".$pr->Value('ca_ciudestino')."</B><BR>".$pr->Value('ca_tradestino')."</TD>";
                echo "    <TD Class=listar>".str_replace ("|","<BR>",$pr->Value('ca_nombresag'))."</TD>";
                echo "    <TD Class=listar style='text-align:center;'><IMG style='visibility: $visible;' src='./graficos/contacto.gif'  alt='ContactosPr' border=0 onclick='elegir(\"ContactosPr\", $id, ".$pr->Value('ca_idproducto').", 0);'></TD>";
                echo "   </TR>";

                echo "<TR>";
                echo "  <TD Class=invertir style='background-color:FFFFFF;' COLSPAN=6>";
                echo "    <TABLE CELLSPACING=1 WIDTH=544>";
                echo "      <TD Class=invertir style='text-align:center; font-weight:bold;'>Concepto</TD>";
                echo "      <TD Class=invertir style='text-align:center; font-weight:bold;'>Tarifas</TD>";
                echo "      <TD Class=invertir COLSPAN=2 style='text-align:center; font-weight:bold;'>Detalles</TD>";
                echo "      <TD Class=invertir style='text-align:center; font-weight:bold;' WIDTH=44><IMG style='visibility: $visible;' src='./graficos/new.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(\"AdicionarOp\", $id, ".$pr->Value('ca_idproducto').", 0);'></TD>";  // Botón para la creación de un Registro Nuevo
                $opc_mem = true;
                $opc_num = $op->GetRowCount();
                $con_mem = ''; $ofe_mem = ''; $rec_mem = ''; $det_mem = '';
                $op->MoveFirst();
                $imp_mem = true;
                while (!$op->Eof() and !$op->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
                    if ($pr->Value('ca_idproducto') != $op->Value('ca_idproducto')) {
                        $op->MoveNext();
                        continue;
                    }else {
                        $con_mem.= $op->Value('ca_concepto')."<BR>";
                        $ofe_mem.= $op->Value('ca_idmoneda')." ".$op->Value('ca_oferta')."<BR>";
                        $rec_mem.= (strlen($op->Value('ca_recargos'))!=0)?nl2br($op->Value('ca_recargos')):"";
                        $det_mem.= $op->Value('ca_observaciones')."<BR>";
                    }
                    $op->MoveNext();
                    if ($pr->Value('ca_idproducto') != $op->Value('ca_idproducto') or strlen($op->Value('ca_recargos')) != 0 or $op->Eof()) {
                        echo "   <TR>";
                        echo "    <TD Class=listar>".$con_mem."</TD>";
                        echo "    <TD Class=listar>".$ofe_mem."</TD>";
                        echo "    <TD Class=listar>".$rec_mem."</TD>";
                        echo "    <TD Class=listar>".$det_mem."</TD>";
                        if ($imp_mem) {
                            echo "    <TD WIDTH=44 Class=listar ROWSPAN=$opc_num>";                                            // Botones para hacer Mantenimiento a la Tabla
                            echo "      <IMG style='visibility: $visible;' src='./graficos/edit.gif' alt='Editar el Registro' border=0 onclick='elegir(\"AdicionarOp\", $id, ".$pr->Value('ca_idproducto').");'>";
                            echo "      <IMG style='visibility: $visible;' src='./graficos/del.gif'  alt='Eliminar el Registro' border=0 onclick='elegir(\"EliminarOp\", $id, ".$pr->Value('ca_idproducto').");'>";
                            echo "    </TD>";
                            $imp_mem = false;
                        }
                        $con_mem = ''; $ofe_mem = ''; $rec_mem = ''; $det_mem = '';
                        echo "   </TR>";
                        }
                    }
                echo "     <TR>";
                echo "      <TD Class=listar COLSPAN=3>";
                echo strlen($pr->Value('ca_locrecargos'))<>0?"<B>Recargos Locales:<BR></B>".nl2br($pr->Value('ca_locrecargos')):'';
                echo "      </TD>";
                echo "      <TD Class=listar COLSPAN=2>";
                echo strlen($pr->Value('ca_frecuencia'))<>0?"<B>Frecuencia:<BR></B>".nl2br($pr->Value('ca_frecuencia'))."<BR>":'';
                echo strlen($pr->Value('ca_tiempotransito'))<>0?"<B>T.Transito:<BR></B>".nl2br($pr->Value('ca_tiempotransito'))."<BR>":'';
                echo "      </TD>";
                echo "     </TR>";
                echo "    </TABLE>";
                echo "  </TD>";
                echo "</TR>";
                if ($pr->Value('ca_observaciones') != '') {
                    echo "   <TR>";
                    echo "    <TD Class=listar></TD>";
                    echo "    <TD Class=listar COLSPAN=6>".nl2br($pr->Value('ca_observaciones'))."</TD>";
                    echo "   </TR>";
                    }
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=titulo COLSPAN=7></TD>";
                echo "</TR>";
                $pr->MoveNext();
                }
             echo "    </TABLE>";
             echo "  </TD>";
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
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Copiar en Nueva Cotización'></TH>";         // Ordena almacenar los datos ingresados
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"cotizaciones.php\"'></TH>";  // Cancela la operación
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
             echo "  <TD Class=invertir><iframe ID=consulta_tar src ='cotizacion.php?id=$id' width='100%' height='100%'></iframe></TD>";
             echo "</TR>";
             echo "</TABLE>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"cotizaciones.php?boton=Consultar&id=$id\"'></TH>";  // Cancela la operación
             echo "</TABLE>";
             echo "</CENTER>";
             break;
             }
        case 'Adicionar': {                                                    // Opcion para Adicionar Registros a la tabla
             $modulo = "00100100";                                             // Identificación del módulo para la ayuda en línea
             $us =& DlRecordset::NewRecordset($conn);
             if (!$us->Open("select ca_login, ca_nombre from control.tb_usuarios where ca_login != 'Administrador' and (ca_cargo = 'Gerente Sucursal' or ca_cargo like '%Ventas%' or ca_departamento like '%Ventas%' or ca_departamento like '%Comercial%') order by ca_login")) {
                 echo "<script>alert(\"".addslashes($us->mErrMsg)."\");</script>";
                 echo "<script>document.location.href = 'reportenegocio.php';</script>";
                 exit;
                }
             $cambiar = ($nivel >= 1)?'':'DISABLED';
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
             echo "  if (!chkDate(document.adicionar.fchcotizacion))";
             echo "      document.adicionar.fchcotizacion.focus();";
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
             echo "<FORM ID=main_form METHOD=post NAME='adicionar' ACTION='cotizaciones.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
             echo "<TABLE CELLSPACING=1>";
             echo "<TH Class=titulo COLSPAN=2>Nuevos Datos para la Cotización</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Fecha Cotización:</TD>";
             echo "  <TD Class=listar><INPUT TYPE='TEXT' NAME='fchcotizacion' SIZE=12 VALUE='".date("Y-m-d")."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
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
             echo "  </TABLE><TD>";
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
             echo "  <TD Class=mostrar><TEXTAREA NAME='entrada' WRAP=virtual ROWS=5 COLS=80>Nos  complace  saludarlos,  nos permitimos presentar oferta para el transporte internacional de mercancía no peligrosa ni sobredimensionada así :</TEXTAREA></TD>";
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
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Guardar'></TH>";         // Ordena almacenar los datos ingresados
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"cotizaciones.php\"'></TH>";  // Cancela la operación
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
                 echo "<script>document.location.href = 'cotizaciones.php';</script>";
                 exit;
                }
             $us =& DlRecordset::NewRecordset($conn);
             if (!$us->Open("select ca_login, ca_nombre from control.tb_usuarios where ca_login != 'Administrador' and (ca_cargo = 'Gerente Sucursal' or ca_cargo like '%Ventas%' or ca_departamento like '%Ventas%' or ca_departamento like '%Comercial%') order by ca_login")) {
                 echo "<script>alert(\"".addslashes($us->mErrMsg)."\");</script>";
                 echo "<script>document.location.href = 'reportenegocio.php';</script>";
                 exit;
                }
             $cambiar = ($nivel >= 1)?'':'DISABLED';
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
             echo "  if (!chkDate(document.modificar.fchcotizacion))";
             echo "      document.modificar.fchcotizacion.focus();";
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
             echo "<FORM METHOD=post NAME='modificar' ACTION='cotizaciones.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta modificando
             echo "<TABLE CELLSPACING=1>";
             echo "<TH Class=titulo COLSPAN=2>Nuevos Datos para la Cotización</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Fecha Cotización:</TD>";
             echo "  <TD Class=listar><INPUT TYPE='TEXT' NAME='fchcotizacion' SIZE=12 VALUE='".$rs->Value('ca_fchcotizacion')."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
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
             echo "  </TABLE><TD>";
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
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"cotizaciones.php?boton=Consultar&\id=$id\"'></TH>";  // Cancela la operación
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
             require_once("footer.php");
echo "</BODY>";
             break;
             }
        case 'AdicionarPr': {                                                    // Opcion para Adicionar Registros a la tabla
             $modulo = "00100100";                                             // Identificación del módulo para la ayuda en línea
             $tm =& DlRecordset::NewRecordset($conn);
             if (!$tm->Open("select ca_idtrafico, ca_nombre from vi_traficos order by ca_nombre")) {       // Selecciona todos lo registros de la tabla Traficos
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones.php';</script>";
                 exit; }
             $tm->MoveFirst();
             while (!$tm->Eof()) {
                    echo "<INPUT TYPE='HIDDEN' NAME='idtraficos' VALUE=".$tm->Value('ca_idtrafico').">";
                    echo "<INPUT TYPE='HIDDEN' NAME='nomtraficos' VALUE='".$tm->Value('ca_nombre')."'>";
                    $tm->MoveNext();
                   }
             if (!$tm->Open("select ca_idciudad, ca_ciudad, ca_idtrafico from vi_puertos order by ca_ciudad")) { // Selecciona todos lo registros de la tabla Ciudades
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones.php';</script>";
                 exit; }
             $tm->MoveFirst();
             while (!$tm->Eof()) {
                    echo "<INPUT TYPE='HIDDEN' NAME='idciudades' VALUE=".$tm->Value('ca_idciudad').">";
                    echo "<INPUT TYPE='HIDDEN' NAME='nomciudades' VALUE='".$tm->Value('ca_ciudad')."'>";
                    echo "<INPUT TYPE='HIDDEN' NAME='ciutraficos' VALUE='".$tm->Value('ca_idtrafico')."'>";
                    $tm->MoveNext();
                   }
             if (!$tm->Open("select distinct ca_producto from tb_cotproductos where ca_idcotizacion = $id order by ca_producto")) { // Selecciona todos lo registros de la tabla Ciudades
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones.php';</script>";
                 exit; }
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function llenar_traficos(){";
             echo "  document.adicionar.idtraorigen.length=0;";
             echo "  document.adicionar.idtraorigen.options[document.adicionar.idtraorigen.length] = new Option();";
             echo "  document.adicionar.idtraorigen.length=0;";
             echo "  document.adicionar.idtradestino.length=0;";
             echo "  document.adicionar.idtradestino.options[document.adicionar.idtradestino.length] = new Option();";
             echo "  document.adicionar.idtradestino.length=0;";
             echo "  if (document.adicionar.impoexpo.value == 'Importación'){";
             echo "      for (cont=0; cont<idtraficos.length; cont++) {";
             echo "           if (idtraficos[cont].value != 'CO-057')";
             echo "               document.adicionar.idtraorigen[document.adicionar.idtraorigen.length] = new Option(nomtraficos[cont].value,idtraficos[cont].value,false,false);";
             echo "           else";
             echo "               document.adicionar.idtradestino[document.adicionar.idtradestino.length] = new Option(nomtraficos[cont].value,idtraficos[cont].value,false,false);";
             echo "           }";
             echo "       }";
             echo "  else {";
             echo "      for (cont=0; cont<idtraficos.length; cont++) {";
             echo "           if (idtraficos[cont].value == 'CO-057')";
             echo "               document.adicionar.idtraorigen[document.adicionar.idtraorigen.length] = new Option(nomtraficos[cont].value,idtraficos[cont].value,false,false);";
             echo "           else";
             echo "               document.adicionar.idtradestino[document.adicionar.idtradestino.length] = new Option(nomtraficos[cont].value,idtraficos[cont].value,false,false);";
             echo "           }";
             echo "       }";
             echo "  llenar_origenes();";
             echo "  llenar_destinos();";
             echo "}";
             echo "function llenar_origenes(){";
             echo "  document.adicionar.idciuorigen.length=0;";
             echo "  document.adicionar.idciuorigen.options[document.adicionar.idciuorigen.length] = new Option();";
             echo "  document.adicionar.idciuorigen.length=0;";
             echo "  if (isNaN(idciudades.length)){";
             echo "      if (document.adicionar.idtraorigen.value == ciutraficos.value){";
             echo "          document.adicionar.idciuorigen[document.adicionar.idciuorigen.length] = new Option(nomciudades.value,idciudades.value,false,false);";
             echo "          }";
             echo "     }";
             echo "  else {";
             echo "     for (cont=0; cont<idciudades.length; cont++) {";
             echo "          if (document.adicionar.idtraorigen.value == ciutraficos[cont].value){";
             echo "              document.adicionar.idciuorigen[document.adicionar.idciuorigen.length] = new Option(nomciudades[cont].value,idciudades[cont].value,false,false);";
             echo "           }";
             echo "       }";
             echo "     }";
             echo "}";
             echo "function llenar_destinos(){";
             echo "  document.adicionar.idciudestino.length=0;";
             echo "  document.adicionar.idciudestino.options[document.adicionar.idciudestino.length] = new Option();";
             echo "  document.adicionar.idciudestino.length=0;";
             echo "  if (isNaN(idciudades.length)){";
             echo "      if (document.adicionar.idtradestino.value == ciutraficos.value){";
             echo "          document.adicionar.idciudestino[document.adicionar.idciudestino.length] = new Option(nomciudades.value,idciudades.value,false,false);";
             echo "          }";
             echo "     }";
             echo "  else {";
             echo "     for (cont=0; cont<idciudades.length; cont++) {";
             echo "          if (document.adicionar.idtradestino.value == ciutraficos[cont].value){";
             echo "              document.adicionar.idciudestino[document.adicionar.idciudestino.length] = new Option(nomciudades[cont].value,idciudades[cont].value,false,false);";
             echo "           }";
             echo "       }";
             echo "     }";
             echo "}";
             echo "function validar(){";
             echo "  if (document.adicionar.producto_a.value == '' && document.adicionar.producto_b.value == '')";
             echo "      alert('Debe ingresar el detalle del producto a transportar');";
             echo "  else if (document.adicionar.idciuorigen.value == '')";
             echo "      alert('Seleccione la Ciudad de Origen');";
             echo "  else if (document.adicionar.idciudestino.value == '')";
             echo "      alert('Seleccione la Ciudad de Destino');";
             echo "  else if (document.adicionar.idcliente.value == '')";
             echo "      alert('Ingrese el Número de Nit del Cliente');";
             echo "  else";
             echo "      return (true);";
             echo "  return (false);";
             echo "}";
             echo "</script>";
             echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
             for ($i=0; $i < count($productos); $i++) {
                  echo "<br>".$productos[$i];
                 }
             echo "</HEAD>";
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='adicionar' ACTION='cotizaciones.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta modificando
             echo "<TABLE CELLSPACING=1>";
             echo "<TH Class=titulo COLSPAN=5>Datos sobre el Producto a Transportar</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Producto:</TD>";
             echo "  <TD Class=mostrar COLSPAN=2><B>Producto Adicional :</B><BR><INPUT TYPE='TEXT' NAME='producto_a' SIZE=50 MAXLENGTH=255></TD>";
             echo "  <TD Class=mostrar COLSPAN=2><B>Productos Cotizados :</B><BR><CENTER><SELECT NAME='producto_b'>";
             $tm->MoveFirst();
             echo " <OPTION VALUE=''>";
             while (!$tm->Eof()) {
                    echo " <OPTION VALUE='".$tm->Value('ca_producto')."'>".$tm->Value('ca_producto');
                    $tm->MoveNext();
                   }
             echo "  </SELECT></CENTER></TD>";
             echo "</TR>";

             echo "<TR>";
             echo "  <TD Class=captura ROWSPAN=3>Trayecto:</TD>";
             echo "  <TD Class=mostrar><B>Impo/Exportación :</B><BR><CENTER><SELECT NAME='impoexpo' ONCHANGE='llenar_traficos();'>";
             for ($i=0; $i < count($imporexpor); $i++) {
                  echo " <OPTION VALUE=".$imporexpor[$i].">".$imporexpor[$i];
                 }
             echo "  </SELECT></CENTER></TD>";
             echo "  <TD Class=mostrar><B>Incoterms:</B><BR><SELECT NAME='incoterms'>";
             for ($i=0; $i < count($tincoterms); $i++) {
                  echo " <OPTION VALUE='".$tincoterms[$i]."'>".substr($tincoterms[$i],0,18);
                 }
             echo "  </SELECT></TD>";
             echo "  <TD Class=mostrar><B>Transporte :</B><BR><CENTER><SELECT NAME='transporte'>";
             for ($i=0; $i < count($transportes); $i++) {
                  echo " <OPTION VALUE=".$transportes[$i].">".$transportes[$i];
                 }
             echo "  </SELECT></CENTER></TD>";
             echo "  <TD Class=mostrar><B>Modalidad :</B><BR><CENTER><SELECT NAME='modalidad'>";
             for ($i=0; $i < count($modalidades); $i++) {
                  echo " <OPTION VALUE=".$modalidades[$i].">".$modalidades[$i];
                  }
             echo "  </SELECT></CENTER></TD>";
             echo "</TR>";

             echo "<TR>";
             echo "  <TH Class=titulo COLSPAN=2>Ciudad de Origen</TH>";
             echo "  <TH Class=titulo COLSPAN=2>Ciudad de Destino</TH>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=listar style='vertical-align:top; text-align:center;' WIDTH=100><SELECT NAME='idtraorigen' ONCHANGE='llenar_origenes();'>";  // Llena el cuadro de lista con los valores de la tabla Traficos
             echo "  </SELECT></TD>";
             echo "  <TD Class=listar style='vertical-align:top; text-align:center;' WIDTH=100><SELECT NAME='idciuorigen' SIZE=6>";          // Llena el cuadro de lista con los valores de la tabla Origenes
             echo "  </SELECT></TD>";
             echo "  <TD Class=listar style='vertical-align:top; text-align:center;' WIDTH=100><SELECT NAME='idtradestino' ONCHANGE='llenar_destinos();'>"; // Llena el cuadro de lista con los valores de la tabla Traficos
             echo "  </SELECT></TD>";
             echo "  <TD Class=listar style='vertical-align:top; text-align:center;' WIDTH=100><SELECT NAME='idciudestino' SIZE=6>";         // Llena el cuadro de lista con los valores de la tabla Destinos
             echo "  </SELECT></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura></TD>";
             echo "  <TD Class=mostrar COLSPAN=4><B>Observaciones:<B><BR><TEXTAREA NAME='observaciones' WRAP=virtual ROWS=5 COLS=102></TEXTAREA></TD>";
             echo "</TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Guardar Producto'></TH>";         // Ordena almacenar los datos ingresados
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"cotizaciones.php?boton=Consultar&\id=$id\"'></TH>";  // Cancela la operación
             echo "<script>llenar_traficos();</script>";
//             echo "<script>adicionar.producto.focus()</script>";
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
             require_once("footer.php");
echo "</BODY>";
             break;
             }
        case 'ModificarPr': {
             $modulo = "00100200";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
             if (!$rs->Open("select * from vi_cotproductos where ca_idcotizacion = $id and ca_idproducto = $pr")) {    // Mueve el apuntador al registro que se desea modificar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones.php';</script>";
                 exit;
                }
             $tm =& DlRecordset::NewRecordset($conn);
             if (!$tm->Open("select ca_idtrafico, ca_nombre from vi_traficos order by ca_nombre")) {       // Selecciona todos lo registros de la tabla Traficos
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones.php';</script>";
                 exit; }
             $tm->MoveFirst();
             while ( !$tm->Eof()) {
                     echo "<INPUT TYPE='HIDDEN' NAME='idtraficos' VALUE=".$tm->Value('ca_idtrafico').">";
                     echo "<INPUT TYPE='HIDDEN' NAME='nomtraficos' VALUE='".$tm->Value('ca_nombre')."'>";
                     $tm->MoveNext();
                   }
             if (!$tm->Open("select ca_idciudad, ca_ciudad, ca_idtrafico from vi_puertos order by ca_ciudad")) { // Selecciona todos lo registros de la tabla Ciudades
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones.php';</script>";
                 exit; }
             $tm->MoveFirst();
             while ( !$tm->Eof()) {
                     echo "<INPUT TYPE='HIDDEN' NAME='idciudades' VALUE=".$tm->Value('ca_idciudad').">";
                     echo "<INPUT TYPE='HIDDEN' NAME='nomciudades' VALUE='".$tm->Value('ca_ciudad')."'>";
                     echo "<INPUT TYPE='HIDDEN' NAME='ciutraficos' VALUE='".$tm->Value('ca_idtrafico')."'>";
                     $tm->MoveNext();
                   }
             if (!$tm->Open("select ca_producto from tb_cotproductos where ca_idcotizacion = $id order by ca_producto")) { // Selecciona todos lo registros de la tabla Ciudades
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones.php';</script>";
                 exit; }
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function llenar_traficos(){";
             echo "  document.modificar.idtraorigen.length=0;";
             echo "  document.modificar.idtraorigen.options[document.modificar.idtraorigen.length] = new Option();";
             echo "  document.modificar.idtraorigen.length=0;";
             echo "  document.modificar.idtradestino.length=0;";
             echo "  document.modificar.idtradestino.options[document.modificar.idtradestino.length] = new Option();";
             echo "  document.modificar.idtradestino.length=0;";
             echo "  if (document.modificar.impoexpo.value == 'Importación'){";
             echo "      for (cont=0; cont<idtraficos.length; cont++) {";
             echo "           if (idtraficos[cont].value != 'CO-057'){";
             echo "               seleccion = (nomtraficos[cont].value == '".$rs->Value('ca_traorigen')."') ? true : false;";
             echo "               document.modificar.idtraorigen[document.modificar.idtraorigen.length] = new Option(nomtraficos[cont].value,idtraficos[cont].value,seleccion,seleccion);";
             echo "               document.modificar.idtraorigen.focus();";
             echo "              }";
             echo "           else{";
             echo "               seleccion = (nomtraficos[cont].value == '".$rs->Value('ca_tradestino')."') ? true : false;";
             echo "               document.modificar.idtradestino[document.modificar.idtradestino.length] = new Option(nomtraficos[cont].value,idtraficos[cont].value,seleccion,seleccion);";
             echo "               document.modificar.idtradestino.focus();";
             echo "              }";
             echo "           }";
             echo "       }";
             echo "  else {";
             echo "      for (cont=0; cont<idtraficos.length; cont++) {";
             echo "           if (idtraficos[cont].value == 'CO-057'){";
             echo "               seleccion = (nomtraficos[cont].value == '".$rs->Value('ca_traorigen')."') ? true : false;";
             echo "               document.modificar.idtraorigen[document.modificar.idtraorigen.length] = new Option(nomtraficos[cont].value,idtraficos[cont].value,seleccion,seleccion);";
             echo "               document.modificar.idtraorigen.focus();";
             echo "              }";
             echo "           else{";
             echo "               seleccion = (nomtraficos[cont].value == '".$rs->Value('ca_tradestino')."') ? true : false;";
             echo "               document.modificar.idtradestino[document.modificar.idtradestino.length] = new Option(nomtraficos[cont].value,idtraficos[cont].value,seleccion,seleccion);";
             echo "               document.modificar.idtradestino.focus();";
             echo "              }";
             echo "           }";
             echo "       }";
             echo "  llenar_origenes();";
             echo "  llenar_destinos();";
             echo "}";
             echo "function llenar_origenes(){";
             echo "  document.modificar.idciuorigen.length=0;";
             echo "  document.modificar.idciuorigen.options[document.modificar.idciuorigen.length] = new Option();";
             echo "  document.modificar.idciuorigen.length=0;";
             echo "  if (isNaN(idciudades.length)){";
             echo "      if (document.modificar.idtraorigen.value == ciutraficos.value){";
             echo "          document.modificar.idciuorigen[document.modificar.idciuorigen.length] = new Option(nomciudades.value,idciudades.value,true,true);";
             echo "          }";
             echo "     }";
             echo "  else {";
             echo "     for (cont=0; cont<idciudades.length; cont++) {";
             echo "          if (document.modificar.idtraorigen.value == ciutraficos[cont].value){";
             echo "              seleccion = (idciudades[cont].value == '".$rs->Value('ca_idorigen')."') ? true : false;";
             echo "              document.modificar.idciuorigen[document.modificar.idciuorigen.length] = new Option(nomciudades[cont].value,idciudades[cont].value,seleccion,seleccion);";
             echo "              document.modificar.idciuorigen.focus();";
             echo "           }";
             echo "       }";
             echo "     }";
             echo "}";
             echo "function llenar_destinos(){";
             echo "  document.modificar.idciudestino.length=0;";
             echo "  document.modificar.idciudestino.options[document.modificar.idciudestino.length] = new Option();";
             echo "  document.modificar.idciudestino.length=0;";
             echo "  if (isNaN(idciudades.length)){";
             echo "      if (document.modificar.idtradestino.value == ciutraficos.value){";
             echo "          document.modificar.idciudestino[document.modificar.idciudestino.length] = new Option(nomciudades.value,idciudades.value,true,true);";
             echo "          }";
             echo "     }";
             echo "  else {";
             echo "     for (cont=0; cont<idciudades.length; cont++) {";
             echo "          if (document.modificar.idtradestino.value == ciutraficos[cont].value){";
             echo "              seleccion = (idciudades[cont].value == '".$rs->Value('ca_iddestino')."') ? true : false;";
             echo "              document.modificar.idciudestino[document.modificar.idciudestino.length] = new Option(nomciudades[cont].value,idciudades[cont].value,seleccion,seleccion);";
             echo "              document.modificar.idciudestino.focus();";
             echo "           }";
             echo "       }";
             echo "     }";
             echo "}";
             echo "function validar(){";
             echo "  if (document.modificar.producto_a.value == '' && document.modificar.producto_b.value == '')";
             echo "      alert('Debe ingresar el detalle del producto a transportar');";
             echo "  else if (document.modificar.idciuorigen.value == '')";
             echo "      alert('Seleccione la Ciudad de Origen');";
             echo "  else if (document.modificar.idciudestino.value == '')";
             echo "      alert('Seleccione la Ciudad de Destino');";
             echo "  else if (document.modificar.idcliente.value == '')";
             echo "      alert('Ingrese el Número de Nit del Cliente');";
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
             echo "<FORM METHOD=post NAME='modificar' ACTION='cotizaciones.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta modificando
             echo "<INPUT TYPE='HIDDEN' NAME='pr' VALUE=".$pr.">";              // Hereda el Id del registro que se esta modificando
             echo "<TABLE CELLSPACING=1>";
             echo "<TH Class=titulo COLSPAN=5>Datos sobre el Producto a Transportar</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Producto:</TD>";
             echo "  <TD Class=mostrar COLSPAN=2><B>Producto Adicional :</B><BR><INPUT TYPE='TEXT' NAME='producto_a' SIZE=50 MAXLENGTH=255></TD>";
             echo "  <TD Class=mostrar COLSPAN=2><B>Productos Cotizados :</B><BR><CENTER><SELECT NAME='producto_b'>";
             $tm->MoveFirst();
             echo " <OPTION VALUE=''>";
             while (!$tm->Eof()) {
                    echo " <OPTION VALUE='".$tm->Value('ca_producto')."'";
                    if ($tm->Value('ca_producto')==$rs->Value('ca_producto')) {
                        echo" SELECTED"; }
                    echo ">".$tm->Value('ca_producto');
                    $tm->MoveNext();
                   }
             echo "  </SELECT></CENTER></TD>";
             echo "</TR>";

             echo "<TR>";
             echo "  <TD Class=captura ROWSPAN=3>Trayecto:</TD>";
             echo "  <TD Class=mostrar><B>Impor/Exportación :</B><BR><CENTER><SELECT NAME='impoexpo' ONCHANGE='llenar_traficos();'>";
             for ($i=0; $i < count($imporexpor); $i++) {
                  echo " <OPTION VALUE=".$imporexpor[$i];
                  if ($rs->Value('ca_impoexpo')==$imporexpor[$i]) {
                      echo " SELECTED"; }
                  echo ">".$imporexpor[$i];
                 }
             echo "  </SELECT></CENTER></TD>";
             echo "  <TD Class=mostrar><B>Incoterms:</B><BR><SELECT NAME='incoterms'>";
             for ($i=0; $i < count($tincoterms); $i++) {
                  echo " <OPTION VALUE='".$tincoterms[$i]."'";
                  if ($rs->Value('ca_incoterms')==$tincoterms[$i]) {
                      echo " SELECTED"; }
                  echo ">".substr($tincoterms[$i],0,18);
                 }
             echo "  </SELECT></TD>";
             echo "  <TD Class=mostrar><B>Transporte :</B><BR><CENTER><SELECT NAME='transporte'>";
             for ($i=0; $i < count($transportes); $i++) {
                  echo " <OPTION VALUE=".$transportes[$i];
                  if ($rs->Value('ca_transporte')==$transportes[$i]) {
                      echo " SELECTED"; }
                  echo ">".$transportes[$i];
                 }
             echo "  </SELECT></CENTER></TD>";
             echo "  <TD Class=mostrar><B>Modalidad :</B><BR><CENTER><SELECT NAME='modalidad'>";
             for ($i=0; $i < count($modalidades); $i++) {
                  echo " <OPTION VALUE=".$modalidades[$i];
                  if ($rs->Value('ca_modalidad')==$modalidades[$i]) {
                      echo " SELECTED"; }
                  echo ">".$modalidades[$i];
                  }
             echo "  </SELECT></CENTER></TD>";
             echo "</TR>";

             echo "<TR>";
             echo "  <TH Class=titulo COLSPAN=2>Ciudad de Origen</TH>";
             echo "  <TH Class=titulo COLSPAN=2>Ciudad de Destino</TH>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=listar style='vertical-align:top; text-align:center;' WIDTH=100><SELECT NAME='idtraorigen' ONCHANGE='llenar_origenes();'>";  // Llena el cuadro de lista con los valores de la tabla Traficos
             echo "  </SELECT></TD>";
             echo "  <TD Class=listar style='vertical-align:top; text-align:center;' WIDTH=100><SELECT NAME='idciuorigen' SIZE=6>";          // Llena el cuadro de lista con los valores de la tabla Origenes
             echo "  </SELECT></TD>";
             echo "  <TD Class=listar style='vertical-align:top; text-align:center;' WIDTH=100><SELECT NAME='idtradestino' ONCHANGE='llenar_destinos();'>"; // Llena el cuadro de lista con los valores de la tabla Traficos
             echo "  </SELECT></TD>";
             echo "  <TD Class=listar style='vertical-align:top; text-align:center;' WIDTH=100><SELECT NAME='idciudestino' SIZE=6>";         // Llena el cuadro de lista con los valores de la tabla Destinos
             echo "  </SELECT></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura></TD>";
             echo "  <TD Class=mostrar COLSPAN=4><B>Observaciones:<B><BR><TEXTAREA NAME='observaciones' WRAP=virtual ROWS=5 COLS=102>".$rs->Value('ca_observaciones')."</TEXTAREA></TD>";
             echo "</TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Actualizar Producto'></TH>";         // Ordena almacenar los datos ingresados
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"cotizaciones.php?boton=Consultar&\id=$id\"'></TH>";  // Cancela la operación
             echo "<script>llenar_traficos();</script>";
             echo "<script>modificar.producto_b.focus()</script>";
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
             require_once("footer.php");
echo "</BODY>";
             break;
             }
        case 'EliminarPr': {
             $modulo = "00100300";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
             if (!$rs->Open("select * from vi_cotproductos where ca_idcotizacion = $id and ca_idproducto = $pr")) {    // Mueve el apuntador al registro que se desea modificar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones.php';</script>";
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
             echo "<FORM METHOD=post NAME='eliminar' ACTION='cotizaciones.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta modificando
             echo "<INPUT TYPE='HIDDEN' NAME='pr' VALUE=".$pr.">";              // Hereda el Id del registro que se esta modificando
             echo "<TABLE CELLSPACING=1>";
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
             echo "  <TD Class=captura>Observaciones:</TD>";
             echo "  <TD Class=mostrar COLSPAN=4>".$rs->Value('ca_observaciones')."<BR>&nbsp</TD>";
             echo "</TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Eliminar Producto'></TH>";         // Ordena almacenar los datos ingresados
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"cotizaciones.php?boton=Consultar&\id=$id\"'></TH>";  // Cancela la operación
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
                 echo "<script>document.location.href = 'cotizaciones.php';</script>";
                 exit;
                }
             $ag =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
             if (!$ag->Open("select * from vi_agentesxcont where ca_idtrafico_ag in ('".$rs->Value('ca_idtraorigen')."', '".$rs->Value('ca_idtradestino')."') and ca_idtrafico_ag != 'CO-057'")) {    // Mueve el apuntador al registro que se desea modificar
                 echo "<script>alert(\"".addslashes($ag->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones.php';</script>";
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
             echo "<FORM METHOD=post NAME='eliminar' ACTION='cotizaciones.php'>";// Crea una forma con datos vacios
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
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"cotizaciones.php?boton=Consultar&\id=$id\"'></TH>";  // Cancela la operación
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
             require_once("footer.php");
echo "</BODY>";
             break;
             }
        case 'AdicionarOp': {                                                    // Opcion para Adicionar Registros a la tabla
             $modulo = "00100100";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
             if (!$rs->Open("select * from vi_cotproductos where ca_idcotizacion = $id and ca_idproducto = $pr")) {    // Mueve el apuntador al registro que se desea modificar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones.php';</script>";
                 exit;
                }
             $cn =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
             $op =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
             $rl =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
             $mn =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
             if (!$cn->Open("select ca_idconcepto, ca_concepto from vi_conceptos where ca_transporte = '".$rs->Value('ca_transporte')."' and ca_modalidad = '".$rs->Value('ca_modalidad')."' and ca_idconcepto < 9999 order by ca_liminferior")) {    // Mueve el apuntador al registro que se desea modificar
                 echo "<script>alert(\"".addslashes($cn->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones.php';</script>";
                 exit;
                }
             if ( $rs->Value('ca_impoexpo') == "Importación") {
                 if (!$rl->Open("select * from vi_recargosxtraf where (ca_idtrafico = '".$rs->Value('ca_idtraorigen')."' or ca_idtrafico = '99-999') and (ca_idciudad = '".$rs->Value('ca_idorigen')."' or ca_idciudad = '999-9999') and ca_modalidad = '".$rs->Value('ca_modalidad')."' and ca_transporte = '".$rs->Value('ca_transporte')."' and ca_impoexpo = '".$rs->Value('ca_impoexpo')."' and ca_tipo = 'Recargo Local'")) {                              // Selecciona todos lo registros de la tabla Recargos por trafico
                     echo "<script>alert(\"".addslashes($rl->mErrMsg)."\");</script>";                   // Muestra el mensaje de error
                     echo "<script>document.location.href = 'entrada.php';</script>";
                     exit; }
                  }
             else {
                 if (!$rl->Open("select * from vi_recargosxtraf where (ca_idtrafico = '".$rs->Value('ca_idtradestino')."' or ca_idtrafico = '99-999') and (ca_idciudad = '".$rs->Value('ca_iddestino')."' or ca_idciudad = '999-9999') and ca_modalidad = '".$rs->Value('ca_modalidad')."' and ca_transporte = '".$rs->Value('ca_transporte')."' and ca_impoexpo = '".$rs->Value('ca_impoexpo')."' and ca_tipo = 'Recargo Local'")) {                              // Selecciona todos lo registros de la tabla Recargos por trafico
                     echo "<script>alert(\"".addslashes($rl->mErrMsg)."\");</script>";                   // Muestra el mensaje de error
                     echo "<script>document.location.href = 'entrada.php';</script>";
                     exit; }
                  }
             if (!$mn->Open("select ca_idmoneda, ca_nombre from tb_monedas order by ca_nombre")) {       // Selecciona todos lo registros de la tabla Monedas
                 echo "<script>alert(\"".addslashes($mn->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'reportenegocio.php';</script>";
                 exit; }
             $rl->MoveFirst();
             $rec_loc = '';
             if ($rl->mRowCount != 0) {
                while (!$rl->Eof() and !$rl->IsEmpty()) {
                    $rec_mem = $rl->Value('ca_recargo');
                    if ($rl->Value('ca_vlrfijo') != 0) {
                        $vlr_rec = $rl->Value('ca_idmoneda')." ".sprintf ("%01.2f", $rl->Value('ca_vlrfijo'));
                        $bas_rec = '';
                    }else if ($rl->Value('ca_porcentaje') != 0) {
                        $vlr_rec = $rl->Value('ca_idmoneda')." ".sprintf ("%01.2f", $rl->Value('ca_porcentaje'));
                        $bas_rec = $rl->Value('ca_baseporcentaje');
                    }else if ($rl->Value('ca_vlrunitario') != 0) {
                        $vlr_rec = $rl->Value('ca_idmoneda')." ".sprintf ("%01.2f", $rl->Value('ca_vlrunitario'));
                        $bas_rec = $rl->Value('ca_baseunitario');
                    }
                    $rec_loc.= '» '.$vlr_rec.' -> '.$rec_mem.chr(13);
                    $rl->MoveNext();
                }
             }

             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
             echo "  if (document.adicionar.locrecargos.value == '')";
             echo "      alert('El campo Descripción no es válido');";
             echo "  else";
             echo "      return (true);";
             echo "  return (false);";
             echo "}";
             echo "function refresh(to){";
             echo "  id = document.adicionar.id.value;";
             echo "  pr = document.adicionar.pr.value;";
             echo "  nu = to.getAttribute('ID').substring(to.getAttribute('ID').indexOf('_')+1);";
             echo "  document.adicionar.op.value = nu;";
             echo "  ventana = document.getElementById('consulta_tar');";
             echo "  ventana.src='ventanas.php?opcion=Tarifas&cn='+to.value+'&id='+id+'&pr='+pr+'&nu='+nu;";
             echo "  document.getElementById('oferta_' + nu).focus();";
             echo "}";
             echo "function habilitar(to){";
             echo "  nu = to.getAttribute('ID').substring(to.getAttribute('ID').indexOf('_')+1);";
             echo "  elemento = document.getElementById('recargos_' + nu);";
             echo "  if (to.checked){";
             echo "     elemento.value = '';";
             echo "  }else{";
             echo "     elemento.value = '';";
             echo "  }";
             echo "}";
             echo "</script>";
             echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
             echo "</HEAD>";
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<FORM METHOD=post NAME='adicionar' ACTION='cotizaciones.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta modificando
             echo "<INPUT TYPE='HIDDEN' NAME='pr' VALUE=".$pr.">";              // Hereda el Id del registro que se esta modificando
             echo "<INPUT TYPE='HIDDEN' NAME='op' VALUE=0>";                    // Hereda el Id del registro que se esta modificando
             echo "<TABLE CELLSPACING=1 WIDTH=560>";
             echo "<TR>";
             echo "  <TH Class=titulo COLSPAN=5>SISTEMA DE COTIZACIONES<br>Datos sobre la Opción a Cotizar</TH>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TH Class=titulo WIDTH=150>Conceptos:</TH>";
             echo "  <TH Class=titulo WIDTH=100 COLSPAN=2>Oferta:</TH>";
             echo "  <TH Class=titulo WIDTH=300>Recargos en Origen:</TH>";
             echo "  <TH Class=titulo WIDTH=10>Imp</TH>";
             echo "</TR>";
             if (!$op->Open("select * from tb_cotopciones where ca_idcotizacion = $id and ca_idproducto = $pr")) {    // Mueve el apuntador al registro que se desea modificar
                 echo "<script>alert(\"".addslashes($op->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones.php';</script>";
                 exit;
                }
             $i = 0; $y = 4;
             while (!$op->Eof() and !$op->IsEmpty()) {
                 echo "<INPUT TYPE='HIDDEN' NAME='opciones[idopcion][]' VALUE=".$op->Value('ca_idopcion').">";              // Hereda el Id del registro que se esta modificando
                 echo "<TR>";
                 echo "  <TD Class=listar><SELECT ID=idconcepto_$i NAME='opciones[idconcepto][]' ONCHANGE='refresh(this);'>";
                 $cn->MoveFirst();
                 echo " <OPTION VALUE=''></OPTION>";
                 while ( !$cn->Eof()) {
                    echo " <OPTION VALUE=".$cn->Value('ca_idconcepto');
                    if ($cn->Value('ca_idconcepto')==$op->Value('ca_idconcepto')) {
                        echo" SELECTED"; }
                    echo ">".$cn->Value('ca_concepto')."</OPTION>";
                    $cn->MoveNext();
                 }
                 echo "  </TD>";
                 echo "  <TD Class=listar><SELECT ID=idmoneda_$i NAME='opciones[idmoneda][]'>";  // Llena el cuadro de lista con los valores de la tabla Monedas
                 $mn->MoveFirst();
                 while (!$mn->Eof()) {
                        echo "<OPTION VALUE=".$mn->Value('ca_idmoneda');
                        if ($mn->Value('ca_idmoneda')==$op->Value('ca_idmoneda') or ($op->Value('ca_idmoneda')=='' and $mn->Value('ca_idmoneda')=='USD')) {
                            echo" SELECTED"; }
                        echo ">".$mn->Value('ca_idmoneda')."</OPTION>";
                        $mn->MoveNext();
                 }
                 echo "    </SELECT></TD>";
                 echo "  <TD Class=listar><INPUT ID=oferta_$i TYPE='TEXT' NAME='opciones[oferta][]' VALUE='".$op->Value('ca_oferta')."' SIZE=15 MAXLENGTH=255></TD>";
                 echo "  <TD Class=listar ROWSPAN=2><TEXTAREA ID=recargos_$i NAME='opciones[recargos][]' ROWS='4' COLS='50'>".$op->Value('ca_recargos')."</TEXTAREA></TD>";
                 echo "  <TD Class=listar ROWSPAN=2><INPUT ID=habilita_$i TYPE=CHECKBOX ONCLICK='habilitar(this)'".(strlen($op->Value('ca_recargos'))>0?' CHECKED':'')."></TD>";
                 echo "</TR>";
                 echo "<TR>";
                 echo "  <TD Class=listar COLSPAN=3>Observación : <INPUT ID=detalles_$i TYPE='TEXT' NAME='opciones[detalles][]' VALUE='".$op->Value('ca_observaciones')."' SIZE=45 MAXLENGTH=255></TD>";
                 echo "</TR>";
                 echo "<TR HEIGHT=5>";
                 echo "  <TD Class=invertir COLSPAN=5></TD>";
                 echo "</TR>";
                 echo "<INPUT ID=tarifa_$i TYPE='HIDDEN' NAME='opciones[tarifa][]' VALUE='".$op->Value('ca_tarifa')."'>";
                 $op->MoveNext();
                 $i++; $y = 2;
             }
             for ($j=$i; $j < $i+$y; $j++) {
                 echo "<INPUT TYPE='HIDDEN' NAME='opciones[idopcion][]' VALUE=0>";              // Hereda el Id del registro que se esta modificando
                 echo "<TR>";
                 echo "  <TD Class=listar><SELECT ID=idconcepto_$j NAME='opciones[idconcepto][]' ONCHANGE='refresh(this);'>";
                 $cn->MoveFirst();
                 echo " <OPTION VALUE=''></OPTION>";
                 while ( !$cn->Eof()) {
                    echo " <OPTION VALUE=".$cn->Value('ca_idconcepto').">".$cn->Value('ca_concepto')."</OPTION>";
                    $cn->MoveNext();
                 }
                 echo "  </TD>";
                 echo "  <TD Class=listar><SELECT ID=idmoneda_$j NAME='opciones[idmoneda][]'>";  // Llena el cuadro de lista con los valores de la tabla Monedas
                 $mn->MoveFirst();
                 while (!$mn->Eof()) {
                        echo "<OPTION VALUE=".$mn->Value('ca_idmoneda');
                        if ($mn->Value('ca_idmoneda')=='USD') {
                            echo" SELECTED"; }
                        echo ">".$mn->Value('ca_idmoneda')."</OPTION>";
                        $mn->MoveNext();
                 }
                 echo "    </SELECT></TD>";
                 echo "  <TD Class=listar><INPUT ID=oferta_$j TYPE='TEXT' NAME='opciones[oferta][]' SIZE=15 MAXLENGTH=255></TD>";
                 echo "  <TD Class=listar ROWSPAN=2><TEXTAREA ID=recargos_$j NAME='opciones[recargos][]' ROWS='4' COLS='50'></TEXTAREA></TD>";
                 echo "  <TD Class=listar ROWSPAN=2><INPUT ID=habilita_$j TYPE=CHECKBOX ONCLICK='habilitar(this)'></TD>";
                 echo "</TR>";
                 echo "<TR>";
                 echo "  <TD Class=listar COLSPAN=3>Observación : <INPUT ID=detalles_$j TYPE='TEXT' NAME='opciones[detalles][]' SIZE=45 MAXLENGTH=255></TD>";
                 echo "</TR>";
                 echo "<TR HEIGHT=5>";
                 echo "  <TD Class=invertir COLSPAN=5></TD>";
                 echo "</TR>";
                 echo "<INPUT ID=tarifa_$j TYPE='HIDDEN' NAME='opciones[tarifa][]' VALUE=0>";
             }
             $rec_loc = (strlen($rs->Value('ca_locrecargos'))!=0?$rs->Value('ca_locrecargos'):$rec_loc);
             echo "<TR>";
             echo "  <TD Class=listar COLSPAN=2>Frecuencia : <INPUT ID=frecuencia TYPE='TEXT' NAME='frecuencia' VALUE='".$rs->Value('ca_frecuencia')."' SIZE=29 MAXLENGTH=255></TD>";
             echo "  <TD Class=listar style='text-align:left; font-weight:bold;' COLSPAN=3 ROWSPAN=2>Recargos Locales<BR><TEXTAREA ID=locrecargos NAME='locrecargos' ROWS='5' COLS='75'>$rec_loc</TEXTAREA></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=listar COLSPAN=2>T. Tránsito : <INPUT ID=tiempotransito TYPE='TEXT' NAME='tiempotransito' VALUE='".$rs->Value('ca_tiempotransito')."' SIZE=29 MAXLENGTH=255></TD>";
             echo "</TR>";
             echo "<TR HEIGHT=5>";
             echo "  <TD Class=titulo COLSPAN=5></TD>";
             echo "</TR>";
             echo "<TR HEIGHT=90>";
             echo "  <TD Class=invertir COLSPAN=5><iframe ID=consulta_tar src ='blanco.html' width='100%' height='100%'></iframe></TD>";
             echo "</TR>";
             echo "<TR HEIGHT=5>";
             echo "  <TD Class=titulo COLSPAN=5></TD>";
             echo "</TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Guardar Opciones'></TH>";         // Ordena almacenar los datos ingresados
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"cotizaciones.php?boton=Consultar&\id=$id\"'></TH>";  // Cancela la operación
             echo "<script>document.getElementById('oferta_0').focus()</script>";
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
             break;
             }
        case 'EliminarOp': {                                                    // Opcion para Modificar Registros a la tabla
             $modulo = "00100100";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
             if (!$rs->Open("select * from vi_cotopciones where ca_idcotizacion = $id and ca_idproducto = $pr")) {    // Mueve el apuntador al registro que se desea modificar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones.php';</script>";
                 exit;
                }

             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "</HEAD>";
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<FORM METHOD=post NAME='eliminar' ACTION='cotizaciones.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta modificando
             echo "<INPUT TYPE='HIDDEN' NAME='pr' VALUE=".$pr.">";              // Hereda el Id del registro que se esta modificando
             echo "<TABLE CELLSPACING=1 WIDTH=560>";
             echo "<TR>";
             echo "  <TH Class=titulo COLSPAN=3>SISTEMA DE COTIZACIONES<br>Datos sobre la Opción a Eliminar</TH>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TH Class=titulo WIDTH=150>Conceptos:</TH>";
             echo "  <TH Class=titulo WIDTH=100>Oferta:</TH>";
             echo "  <TH Class=titulo WIDTH=300>Recargos en Origen:</TH>";
             echo "</TR>";
             while (!$rs->Eof() and !$rs->IsEmpty()) {
                 echo "<TR>";
                 echo "  <TD Class=listar>".$rs->Value('ca_concepto')."</TD>";
                 echo "  <TD Class=listar>".$rs->Value('ca_idmoneda')." ".$rs->Value('ca_oferta')."</TD>";
                 echo "  <TD Class=listar ROWSPAN=2>".$rs->Value('ca_recargos')."</TEXTAREA></TD>";
                 echo "</TR>";
                 echo "<TR>";
                 echo "  <TD Class=listar COLSPAN=2>Observación : ".$rs->Value('ca_observaciones')."</TD>";
                 echo "</TR>";
                 echo "<TR HEIGHT=5>";
                 echo "  <TD Class=invertir COLSPAN=3></TD>";
                 echo "</TR>";
                 $rs->MoveNext();
             }
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Eliminar Opción'></TH>";         // Ordena almacenar los datos ingresados
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"cotizaciones.php?boton=Consultar&\id=$id\"'></TH>";  // Cancela la operación
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
             break;
             }
      }
   }
elseif (isset($accion)) {                                                      // Rutina que registra los cambios en la tabla de la base de datos
    switch(trim($accion)) {                                                    // Switch que evalua cual botòn de comando fue pulsado por el usuario
        case 'Guardar': {                                                      // El Botón Guardar fue pulsado
             if (!$rs->Open("insert into tb_cotizaciones (ca_fchcotizacion, ca_idcontacto, ca_asunto, ca_saludo, ca_entrada, ca_despedida, ca_anexos, ca_usuario, ca_fchcreado, ca_usucreado) values('$fchcotizacion',$idcontacto,'$asunto','$saludo','$entrada','$despedida','$anexos','$vendedor',to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'),'$usuario')")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones.php';</script>";
                 exit;
                }
             if (!$rs->Open("select last_value from tb_cotizaciones_id;")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones.php';</script>";
                 exit;
                }
             $id = $rs->Value('last_value');
             break;
             }
        case 'Copiar en Nueva Cotización': {                                                      // El Botón Guardar fue pulsado
             if (!$rs->Open("insert into tb_cotizaciones (ca_fchcotizacion, ca_idcontacto, ca_asunto, ca_saludo, ca_entrada, ca_despedida, ca_anexos, ca_usuario, ca_fchcreado, ca_usucreado) select '".date("Y-m-d")."', ca_idcontacto, ca_asunto, ca_saludo, ca_entrada, ca_despedida, ca_anexos, ca_usuario, to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$usuario' from tb_cotizaciones where ca_idcotizacion = '$id'")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones.php';</script>";
                 exit;
                }
             if (!$rs->Open("select last_value from tb_cotizaciones_id;")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones.php';</script>";
                 exit;
                }
             $id_new = $rs->Value('last_value');
             if (!$rs->Open("insert into tb_cotproductos (ca_idcotizacion, ca_idproducto, ca_producto, ca_impoexpo, ca_transporte, ca_modalidad, ca_incoterms, ca_origen, ca_destino, ca_observaciones, ca_imprimir, ca_fchcreado, ca_usucreado) select $id_new, ca_idproducto, ca_producto, ca_impoexpo, ca_transporte, ca_modalidad, ca_incoterms, ca_origen, ca_destino, ca_observaciones, 'Por Item', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$usuario' from tb_cotproductos where ca_idcotizacion = '$id'")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones.php';</script>";
                 exit;
                }
             if (!$rs->Open("insert into tb_cotopciones (ca_idcotizacion, ca_idproducto, ca_idconcepto, ca_idmoneda, ca_tarifa, ca_oferta, ca_recargos, ca_observaciones, ca_fchcreado, ca_usucreado) select $id_new, ca_idproducto, ca_idconcepto, ca_idmoneda, ca_tarifa, ca_oferta, ca_recargos, ca_observaciones, to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$usuario' from tb_cotopciones where ca_idcotizacion = '$id'")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones.php';</script>";
                 exit;
                }
             $id = $id_new;
             break;
             }
        case 'Actualizar': {                                                   // El Botón Actualizar fue pulsado
             if (!$rs->Open("update tb_cotizaciones set ca_fchcotizacion = '$fchcotizacion', ca_idcontacto = $idcontacto, ca_asunto = '$asunto', ca_saludo = '$saludo', ca_entrada = '$entrada', ca_despedida = '$despedida', ca_anexos = '$anexos', ca_usuario = '$vendedor', ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), ca_usuactualizado = '$usuario' where ca_idcotizacion = $id")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones.php';</script>";
                 exit;
                }
             break;
             }
        case 'Guardar Producto': {                                                      // El Botón Guardar fue pulsado
             $producto = (isset($producto_a) and $producto_a != '')?$producto_a:$producto_b;
             if (!$rs->Open("insert into tb_cotproductos (ca_idcotizacion, ca_producto, ca_impoexpo, ca_transporte, ca_modalidad, ca_incoterms, ca_origen, ca_destino, ca_observaciones, ca_imprimir, ca_fchcreado, ca_usucreado) values($id, '$producto', '$impoexpo', '$transporte', '$modalidad', '$incoterms', '$idciuorigen', '$idciudestino', '".AddSlashes($observaciones)."', 'Por Item', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'),'$usuario')")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones.php';</script>";
                 exit;
                }
             break;
             }
        case 'Actualizar Producto': {                                                   // El Botón Actualizar fue pulsado
             $producto = (isset($producto_a) and $producto_a != '')?$producto_a:$producto_b;
             if (!$rs->Open("update tb_cotproductos set ca_producto = '$producto', ca_impoexpo = '$impoexpo', ca_transporte = '$transporte', ca_modalidad = '$modalidad', ca_incoterms = '$incoterms', ca_origen = '$idciuorigen', ca_destino = '$idciudestino', ca_observaciones = '".AddSlashes($observaciones)."', ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), ca_usuactualizado = '$usuario' where ca_idcotizacion = $id and ca_idproducto = $pr")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones.php';</script>";
                 exit;
                }
             break;
             }
        case 'Eliminar Producto': {                                                   // El Botón Actualizar fue pulsado
             if (!$rs->Open("delete from tb_cotopciones where ca_idcotizacion = $id and ca_idproducto = $pr")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones.php';</script>";
                 exit;
                }
             if (!$rs->Open("delete from tb_cotproductos where ca_idcotizacion = $id and ca_idproducto = $pr")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones.php';</script>";
                 exit;
                }
             break;
             }
        case 'Registrar Contactos': {                                                   // El Botón Actualizar fue pulsado
            $datosag = isset($datosag)?implode("|",$datosag):"";
             if (!$rs->Open("update tb_cotproductos set ca_datosag = '$datosag' where ca_idcotizacion = $id and ca_idproducto = $pr")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones.php';</script>";
                 exit;
                }
             break;
             }
        case 'Guardar Opciones': {                                                      // El Botón Guardar fue pulsado
             if (!$rs->Open("update tb_cotproductos set ca_frecuencia = '$frecuencia', ca_tiempotransito = '$tiempotransito', ca_locrecargos = '".addslashes($locrecargos)."' where ca_idcotizacion = $id and ca_idproducto = $pr")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones.php';</script>";
                 exit;
                }
             for ($i=0; $i < count($opciones['idopcion']); $i++) {
                 if ($opciones['idopcion'][$i] == 0 and $opciones['idconcepto'][$i] != ''){
                    if (!$rs->Open("insert into tb_cotopciones (ca_idcotizacion, ca_idproducto, ca_idconcepto, ca_idmoneda, ca_tarifa, ca_oferta, ca_recargos, ca_observaciones, ca_fchcreado, ca_usucreado) values($id, $pr, '".$opciones['idconcepto'][$i]."', '".$opciones['idmoneda'][$i]."', '".$opciones['tarifa'][$i]."', '".$opciones['oferta'][$i]."', '".addslashes($opciones['recargos'][$i])."', '".$opciones['detalles'][$i]."', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'),'$usuario')")) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'cotizaciones.php';</script>";
                        exit;
                       }
                 }else if ($opciones['idopcion'][$i] != 0 and $opciones['idconcepto'][$i] == ''){
                    if (!$rs->Open("delete from tb_cotopciones where ca_idopcion = ".$opciones['idopcion'][$i])) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'cotizaciones.php';</script>";
                        exit;
                       }
                 }else if ($opciones['idopcion'][$i] != 0 and $opciones['idconcepto'][$i] != ''){
                    if (!$rs->Open("update tb_cotopciones set ca_idconcepto = '".$opciones['idconcepto'][$i]."', ca_idmoneda = '".$opciones['idmoneda'][$i]."', ca_tarifa = '".$opciones['tarifa'][$i]."', ca_oferta = '".$opciones['oferta'][$i]."', ca_recargos = '".addslashes($opciones['recargos'][$i])."', ca_observaciones = '".$opciones['detalles'][$i]."', ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), ca_usuactualizado = '$usuario' where ca_idopcion = ".$opciones['idopcion'][$i])) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'cotizaciones.php';</script>";
                        exit;
                       }
                 }
                }
             break;
             }
        case 'Eliminar Opción': {                                                      // El Botón Guardar fue pulsado
             if (!$rs->Open("delete from tb_cotopciones where ca_idcotizacion = $id and ca_idproducto = $pr")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'cotizaciones.php';</script>";
                 exit;
                }
             break;
             }
        }
    echo "<script>document.location.href = 'cotizaciones.php?boton=Consultar&\id=$id';</script>";  // Retorna a la pantalla principal de la opción
   }
?>