<?
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       LIBERACIONES.PHP                                            \\
// Creado:        2004-05-11                                                  \\
// Autor:         Carlos Gilberto L�pez M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-05-11                                                  \\
//                                                                            \\
// Descripci�n:   M�dulo de mantenimiento al caudro de Liberaciones Autom�tica\\
//                                                                            \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/
$programa = 15;

$titulo = 'Cuadro de Liberaciones Autom�ticas y Contratos de Comodato';
$campos = array("Nombre del Cliente", "Vendedor", "Ciudad", "Observaciones");  // Arreglo con las Opciones de Busqueda
$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos

session_cache_limiter('private_expire');
require_once("checklogin.php");                                                                 // Captura las variables de la sessi�n abierta
 

$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexi�n a la base de datos
if (!isset($criterio) and !isset($boton) and !isset($accion)) {                                                    // Switch que evalua cual bot�n de comando fue pulsado por el usuario
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "</HEAD>";
    echo "<BODY>";
require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<H3>$titulo</H3>";
    echo "<FORM METHOD=post NAME='menuform' ACTION='liberaciones.php' >";
    echo "<TABLE WIDTH=450 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
    echo "<TH COLSPAN=4 style='font-size: 12px; font-weight:bold;'><B>Ingrese un criterio para realizar las busqueda</TH>";
    echo "<TR>";
    echo "  <TH>&nbsp</TH>";
    echo "  <TD Class=listar><B>Buscar por:</B><BR><SELECT NAME='modalidad' SIZE=4>";
    for ($i=0; $i < count($campos); $i++) {
         echo " <OPTION VALUE='".$campos[$i]."'";
         if ($i==0) {
             echo " SELECTED"; }
         echo ">".$campos[$i];
        }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar><B>Que contenga la cadena:</B><BR><INPUT TYPE='text' NAME='criterio' size='60'><BR />";
	echo "  Comodato vencido <INPUT TYPE='checkbox' name='comodatovencido'  > </TD>";
    echo "  <TH><INPUT Class=submit TYPE='SUBMIT' NAME='buscar' VALUE='  Buscar  ' ONCLIK='menuform.submit();'></TH>";
    echo "</TR>";
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=captura COLSPAN=4></TD>";
    echo "</TR>";
    echo "</TABLE><BR>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cerrar' ONCLICK='javascript:document.location.href = \"/\"'></TH>";  // Cancela la operaci�n
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en L�nea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en l�nea
    require_once("footer.php");
echo "</BODY>";
    echo "</HTML>";
    }
elseif (!isset($boton) and !isset($accion) and isset($criterio)){
    $modulo = "00100000";                                                      // Identificaci�n del m�dulo para la ayuda en l�nea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al m�dulo
    $condicion= "";                                                            // where (ca_diascredito <> 0 or ca_cupo <> 0)
    if (isset($criterio)) {
        $columnas = array("Nombre del Cliente"=>"ca_compania", "Vendedor"=>"ca_vendedor", "Ciudad"=>"ca_ciudad", "Observaciones"=>"ca_observaciones");
        $condicion.= "where lower($columnas[$modalidad]) like lower('%".addslashes($criterio)."%')";
       }
    if (!$rs->Open("select cl.ca_idcliente, cl.ca_compania, cl.ca_vendedor, us.ca_sucursal, lc.ca_cupo, lc.ca_diascredito, lc.ca_usucreado, lc.ca_fchcreado, lc.ca_usuactualizado, lc.ca_fchactualizado, lc.ca_observaciones from tb_libcliente lc INNER JOIN tb_clientes cl ON lc.ca_idcliente = cl.ca_idcliente LEFT OUTER JOIN vi_usuarios us ON cl.ca_vendedor = us.ca_login $condicion order by ca_sucursal, ca_compania")) {  // Selecciona todos lo registros de la tabla tb_libcliente
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";                   // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // C�digo en JavaScript para validar las opciones de mantenimiento
    echo "function elegir(opcion, id){";
    echo "    document.location.href = 'liberaciones.php?boton='+opcion+'\&id='+id;";
    echo "}";
    echo "</script>";
    echo "</HEAD>";
    echo "<BODY>";
require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<FORM METHOD=post NAME='cabecera' ACTION='liberaciones.php'>";       // Hace una llamado nuevamente a este script pero con
    echo "<INPUT TYPE='HIDDEN' NAME='criterio' VALUE=".$criterio.">";          // Hereda el Id del registro que se esta modificando
    echo "<INPUT TYPE='HIDDEN' NAME='modalidad' VALUE=".$modalidad.">";        
    echo "<TABLE CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=9>SISTEMA COLTRANS S.A.<BR>$titulo</TH>";
    echo "</TR>";
    echo "<TH>ID</TH>";
    echo "<TH>Cliente</TH>";
    echo "<TH>Vendedor</TH>";
    echo "<TH>D�as<BR>de Cr�dito</TH>";
    echo "<TH>Cupo Asignado</TH>";
    echo "<TH>Usu.Creaci�n</TH>";
    echo "<TH>Fch.Creaci�n</TH>";
    echo "<TH>Usu.Actualizado</TH>";
    echo "<TH>Fch.Actualizado</TH>";
    $nom_suc = "";
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucci�n Select
       if ($rs->Value('ca_sucursal') != $nom_suc) {
           echo "<TR>";
           echo "<TD Class=invertir COLSPAN=9 style='font-size: 13px; font-weight:bold;'>".$rs->Value('ca_sucursal')."</TD>";
           echo "</TR>";
           $nom_suc = $rs->Value('ca_sucursal');
       }
       $beneficios = ($rs->Value('ca_diascredito')==0)?'background-color:#FFb2b2;':'';
       echo "<TR>";
       echo "  <TD Class=listar style='$beneficios'>".$rs->Value('ca_idcliente')."</TD>";
       echo "  <TD Class=listar style='$beneficios' WIDTH=260>".$rs->Value('ca_compania').((strlen($rs->Value('ca_observaciones')) != 0)?"<br />".$rs->Value('ca_observaciones'):"")."</TD>";
       echo "  <TD Class=listar style='text-align:center;$beneficios'>".$rs->Value('ca_vendedor')."</TD>";
       echo "  <TD Class=listar style='text-align:center;$beneficios'>".$rs->Value('ca_diascredito')."</TD>";
       echo "  <TD Class=listar style='text-align:right;$beneficios'>".number_format($rs->Value('ca_cupo'),0)."</TD>";
       echo "  <TD Class=listar style='text-align:center;$beneficios'>".$rs->Value('ca_usucreado')."</TD>";
       echo "  <TD Class=listar style='text-align:center;$beneficios'>".$rs->Value('ca_fchcreado')."</TD>";
       echo "  <TD Class=listar style='text-align:center;$beneficios'>".$rs->Value('ca_usuactualizado')."</TD>";
       echo "  <TD Class=listar style='text-align:center;$beneficios'>".$rs->Value('ca_fchactualizado')."</TD>";
       echo "</TR>";
       $rs->MoveNext();
       }
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=invertir COLSPAN=9></TD>";
    echo "</TR>";
    echo "</TABLE><BR><BR>";

    list($anno, $mes, $dia, $tiempo, $minuto, $segundo) = sscanf(date("Y-m-d"),"%d-%d-%d %d:%d:%d");
	
	if( $comodatovencido ){
		$condicion= "where ca_fchvencimiento < now()";
	}else{
		$condicion= "where ca_fchvencimiento >= now()";
	} 
	
	
    if (isset($criterio)) {
        $columnas = array("Nombre del Cliente"=>"ca_compania", "Vendedor"=>"ca_vendedor", "Ciudad"=>"ca_ciudad", "Observaciones"=>"ca_observaciones");
        $condicion.= " and lower($columnas[$modalidad]) like lower('%".addslashes($criterio)."%')";
       }
	 
    if (!$rs->Open("select ca_idcliente, ca_compania, ca_ciudad, ca_vendedor, ca_fchfirmado, ca_fchvencimiento from vi_clientes $condicion order by ca_ciudad, ca_compania")) {  // Selecciona todos lo registros de la tabla Grupos
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";                   // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
    echo "<TABLE WIDTH=700 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=7>RELACI�N DE CONTRATOS DE COMODATO ".($comodatovencido?"VENCIDOS":"VIGENTES")." A: ".$meses[$mes-1].' '.$dia.' de '.$anno."</TH>";
    echo "</TR>";
    echo "<TH>ID</TH>";
    echo "<TH>Cliente</TH>";
    echo "<TH>Vendedor</TH>";
    echo "<TH>Fch.Firma</TH>";
    echo "<TH>Fch.Vencimiento</TH>";
    $nom_ciu = "";
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucci�n Select
       if ($rs->Value('ca_ciudad') != $nom_ciu) {
           echo "<TR>";
           echo "<TD WIDTH=120 Class=invertir COLSPAN=8 style='font-size: 13px; font-weight:bold;'>".$rs->Value('ca_ciudad')."</TD>";
           echo "</TR>";
           $nom_ciu = $rs->Value('ca_ciudad');
       }
       echo "<TR>";
       echo "  <TD Class=listar>".$rs->Value('ca_idcliente')."</TD>";
       echo "  <TD Class=listar WIDTH=260>".$rs->Value('ca_compania')."</TD>";
       echo "  <TD Class=listar style='text-align:center;'>".$rs->Value('ca_vendedor')."</TD>";
       echo "  <TD Class=listar style='text-align:center;'>".$rs->Value('ca_fchfirmado')."</TD>";
       echo "  <TD Class=listar style='text-align:center;'>".$rs->Value('ca_fchvencimiento')."</TD>";
       echo "</TR>";
       $rs->MoveNext();
       }
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=invertir COLSPAN=8></TD>";
    echo "</TR>";
    echo "</TABLE><BR>";


    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Generar PDF' ONCLICK='javascript:document.location.href = \"liberaciones.php?boton=PDF\"'></TH>";  // Cancela la operaci�n
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cerrar' ONCLICK='javascript:document.location.href = \"liberaciones.php\"'></TH>";  // Cancela la operaci�n
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en L�nea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en l�nea
    require_once("footer.php");
echo "</BODY>";
    echo "</HTML>";
    }
elseif (isset($boton)) {                                                       // Switch que evalua cual bot�n de comando fue pulsado por el usuario
    switch(trim($boton)) {
        case 'PDF': {                                                    // Opcion para Adicionar Registros a la tabla
             $modulo = "00100100";                                             // Identificaci�n del m�dulo para la ayuda en l�nea
//           include_once 'include/seguridad.php';                             // Control de Acceso al m�dulo
             require('include/fpdf.php');                                                   // Incorpora la librer�a de funciones, para generara Archivos en formato PDF
             require('include/cpdf.php');                                                   // Incorpora la plantilla con formato de Coltrans
             if (!$rs->Open("select cl.ca_idcliente, cl.ca_compania, cl.ca_vendedor, us.ca_sucursal, lc.ca_cupo, lc.ca_diascredito, lc.ca_usucreado, lc.ca_fchcreado, lc.ca_usuactualizado, lc.ca_fchactualizado, lc.ca_observaciones from tb_libcliente lc INNER JOIN tb_clientes cl ON lc.ca_idcliente = cl.ca_idcliente LEFT OUTER JOIN vi_usuarios us ON cl.ca_vendedor = us.ca_login order by ca_sucursal, ca_compania")) {  // Selecciona todos lo registros de la tabla tb_libcliente
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";                   // Muestra el mensaje de error
                 echo "<script>document.location.href = 'entrada.php';</script>";
                 exit; }
             $pdf=new PDF();
//           $pdf->Open();
             $pdf->AliasNbPages();
             $pdf->SetTopMargin(12);
             $pdf->SetLeftMargin(18);
             $pdf->SetRightMargin(12);
             $pdf->SetAutoPageBreak(true, 26);
             $pdf->AddPage();
             $pdf->SetHeight(4);
             $pdf->SetFont('Arial','B',8);
//           $pdf->Ln(5);
             list($anno, $mes, $dia, $tiempo, $minuto, $segundo) = sscanf(date("Y-m-d"),"%d-%d-%d %d:%d:%d");
             $pdf->SetWidths(array(75,25,20,25,25));
             $pdf->SetAligns(array("C","C","C","C","C"));
             $pdf->Row(array('Cliente','Vendedor','D�as de Cr�dito','Cupo Asignado','Actualizaci�n'));

             $nom_suc = "";
             while (!$rs->Eof()) {
                    if ($rs->Value('ca_sucursal') != $nom_suc) {
                        $pdf->SetWidths(array(170));
                        $pdf->SetAligns(array("L"));
                        $pdf->SetFont('Arial','B',10);
                        $pdf->Row(array($rs->Value('ca_sucursal')));
                        $nom_suc = $rs->Value('ca_sucursal');
                        $pdf->SetWidths(array(75,25,20,25,25));
                        $pdf->SetAligns(array("L","C","C","R","C"));
                        $pdf->SetFont('Arial','',6);
                        }
                    $cli_mem = $rs->Value('ca_compania');
                    if (strlen($rs->Value('ca_observaciones')) != 0) {
                        $cli_mem = $cli_mem.'|'.$rs->Value('ca_observaciones');
                    }
                    $fch_mem = $rs->Value('ca_fchactualizado')==''?$rs->Value('ca_usucreado').'|'.$rs->Value('ca_fchcreado'):$rs->Value('ca_usuactualizado').'|'.$rs->Value('ca_fchactualizado');
                    $pdf->Row(array(str_replace("|", "\n", $cli_mem), $rs->Value('ca_vendedor'), $rs->Value('ca_diascredito'), number_format($rs->Value('ca_cupo'),0,".",","), str_replace("|", "\n", $fch_mem)));
                    $rs->MoveNext();
                }

             $condicion= "where ca_fchvencimiento >= now()";
             if (isset($criterio)) {
                 $columnas = array("Nombre del Cliente"=>"ca_compania", "Vendedor"=>"ca_vendedor", "Ciudad"=>"ca_ciudad", "Observaciones"=>"ca_observaciones");
                 $condicion.= " and lower($columnas[$modalidad]) like lower('%".addslashes($criterio)."%')";
                }
             if (!$rs->Open("select ca_idcliente, ca_compania, ca_ciudad, ca_vendedor, ca_fchfirmado, ca_fchvencimiento from vi_clientes $condicion order by ca_ciudad, ca_compania")) {  // Selecciona todos lo registros de la tabla Grupos
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";                   // Muestra el mensaje de error
                 echo "<script>document.location.href = 'entrada.php';</script>";
                 exit; }

             $pdf->Ln(8);
             $pdf->SetFont('Arial','B',9);
             $pdf->SetWidths(array(170)); // 169
             $pdf->SetAligns(array("C"));
             $pdf->Row(array('RELACI�N DE CONTRATOS DE COMODATO VIGENTES A: '.$meses[$mes-1].' '.$dia.' de '.$anno));
             $nom_ciu = "";
             while (!$rs->Eof()) {
                    if ($rs->Value('ca_ciudad') != $nom_ciu) {
                        $pdf->SetWidths(array(170));
                        $pdf->SetAligns(array("L"));
                        $pdf->SetFont('Arial','B',10);
                        $pdf->Row(array($rs->Value('ca_ciudad')));
                        $nom_ciu = $rs->Value('ca_ciudad');
                        $pdf->SetWidths(array(75,25,35,35));
                        $pdf->SetAligns(array("L","C","C","C"));
                        $pdf->SetFont('Arial','',6);
                        }
                    $cli_mem = $rs->Value('ca_compania');
                    $pdf->Row(array($cli_mem, $rs->Value('ca_vendedor'), $rs->Value('ca_fchfirmado'), $rs->Value('ca_fchvencimiento')));
                    $rs->MoveNext();
                }

             $pdf->Ln(4);
             $pdf->Cell(0, 4, 'Reporte a: '.$meses[$mes-1].' '.$dia.' de '.$anno,0,1);
             $pdf->Ln(8);
             $pdf->Output();
             break;
             }
      }
   }
?>