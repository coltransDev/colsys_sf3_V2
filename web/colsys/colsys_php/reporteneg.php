<?
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       REPORTENEG.PHP                                              \\
// Creado:        2005-01-01                                                  \\
// Autor:         Carlos Gilberto López M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2005-01-14                                                  \\
//                                                                            \\
// Descripción:   Módulo para la generación de archivos en formato PDF con la \\
//                cotización para el cliente.                                 \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/

//$programa = 18;
include_once 'include/datalib.php';                                        // Incorpora la libreria de funciones, para accesar leer bases de datos
include_once 'include/functions.php';                                          // Funciones de Usuarios para PHP
require('include/fpdf.php');                                               // Incorpora la librería de funciones, para generara Archivos en formato PDF
require('include/cpdfblnk.php');                                           // Incorpora la plantilla con formato de Coltrans

$meses = array("enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");

session_cache_limiter('private_expire');
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta
 

$modulo = "00100000";                                                          // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo

$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos

$patron = '/(\d+)-(20\d\d)/';
//if (preg_match($patron, $id)) {
if (strpos($id, '-') === false){
    $condition = "ca_idreporte = $id";
    $sql="select count(ca_tiporep) as ca_contador from tb_reportes where $condition and ca_tiporep > 0";
    //echo $sql;
    //exit;
    if ($rs->Open($sql)) { // Verfica si se trata de un reporte de negocios con el nuevo módulo
        if($rs->Value('ca_contador')!=0){
           echo "<script>document.location.href = '/reportesNeg/verReporte/id/$id';</script>";
           exit;
        }
    }
}else{
    $cadena_co = "select r1.ca_idreporte from tb_reportes r1, ";
    $cadena_co.= "(select ca_consecutivo, max(ca_version) as ca_version from tb_reportes where ca_consecutivo = '$id' and ca_usuanulado is null and ca_tiporep != 4 group by ca_consecutivo) r2 ";
    $cadena_co.= "where r1.ca_consecutivo = r2.ca_consecutivo and r1.ca_version = r2.ca_version ";
    $condition = "ca_idreporte = ($cadena_co)";
}

if (true){
     $tm =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos

     if (!$rs->Open("select * from vi_reportes2 where $condition")) {                       // Selecciona todos lo registros de la tabla Ino-Marítimo
         echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
         echo "<script>document.location.href = 'entrada.php';</script>";
         exit; }
     echo "<script>document.location.href = '/reportesNeg/verReporte/id/".$rs->Value('ca_idreporte')."';</script>";
     $fch_mem = ($rs->Value('ca_fchactualizado')!='')?$rs->Value('ca_fchactualizado'):$rs->Value('ca_fchcreado');
     $usu_mem = ($rs->Value('ca_fchactualizado')!='')?$rs->Value('ca_usuactualizado'):$rs->Value('ca_usucreado');
     list($anno, $mes, $dia, $hor, $min, $seg) = sscanf($fch_mem,"%d-%d-%d %d:%d:%d");

    $pdf=new PDF($orientation='P',$unit='mm',$format='letter');
    $pdf->Open();
    $pdf->AliasNbPages();
    $pdf->SetTopMargin(0);
    $pdf->SetLeftMargin(5);
    $pdf->SetRightMargin(5);
    $pdf->SetAutoPageBreak(true, 0);
    $pdf->SetHeight(4);
    $pdf->AddPage();
    $pdf->SetFont('Arial','',8);
//    list($anno, $mes, $dia, $tiempo, $minuto, $segundo) = sscanf(date("Y-m-d"),"%d-%d-%d %d:%d:%d");

    $pdf->SetWidths(array(200));
    $pdf->SetAligns(array("C"));
    $pdf->SetStyles(array("B"));
    $pdf->Row(array('REPORTE DE NEGOCIOS'));

    $pdf->SetWidths(array(25,25,25,25,25,25,25,25));
    $pdf->SetAligns(array("L","C","L","C","L","C","L","C"));
    $pdf->SetStyles(array("","B","","B","","B","","B"));
    $pdf->SetFills(array(1,0,1,0,1,0,1,0));
    $pdf->Row(array('Reporte No.: ',$rs->Value('ca_consecutivo'),'Versión No.: ',$rs->Value('ca_version')."/".$rs->Value('ca_versiones'),'Fecha Reporte: ',$rs->Value('ca_fchreporte'),'Cotización: ',$rs->Value('ca_idcotizacion')));

    $pdf->SetWidths(array(200));
    $pdf->SetAligns(array("C"));
    $pdf->SetFills(array(0));
    $pdf->Row(array('Información General'));

    $pdf->SetWidths(array(30,85,85));
    $pdf->SetAligns(array("C","C","C"));
    $pdf->SetStyles(array("","B","B"));
    $pdf->SetFills(array(1,1,1));
    $pdf->Row(array('1. Importación','2. Origen','3. Destino'));
    $pdf->SetFills(array(0,0,0));
    $pdf->Row(array($rs->Value('ca_impoexpo'),$rs->Value('ca_ciuorigen').' - '.$rs->Value('ca_traorigen'),$rs->Value('ca_ciudestino').' - '.$rs->Value('ca_tradestino')));

    $pdf->SetWidths(array(26,17,25,73,59));
    $pdf->SetAligns(array("L","L","L","L","L","L"));
    $pdf->SetFills(array(0,0,0,0,0,0));
    $pdf->SetStyles(array("B","","B","","B",""));
    $pdf->Row(array('4. Fch.Despacho:',$rs->Value('ca_fchdespacho'),'5. Agente:',$rs->Value('ca_agente')));

    $pdf->SetWidths(array(200));
    $pdf->SetStyles(array(""));
    $pdf->Row(array('Descripción de la Mercancia:'."\n".$rs->Value('ca_mercancia_desc').' «'.(($rs->value("ca_mcia_peligrosa")=='t')?"SÍ":"NO")." es Mercancía Peligrosa»"));

    $pdf->Ln(3);
	
    if (!$tm->Open("select * from vi_terceros where ca_idtercero in (".str_replace("|",",",$rs->Value('ca_idproveedor')).")")) { // Hace un Select a la vista e uncluye un registro vacio
        echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";     // Muestra el mensaje de error
        /*echo "<script>document.location.href = 'grupos.php';</script>";*/
        exit;
    }
    $tm->MoveFirst();

    $ordenes = array_combine(explode("|",$rs->Value('ca_idproveedor')), explode("|",$rs->Value('ca_orden_prov')));
	$terminos= array_combine(explode("|",$rs->Value('ca_idproveedor')), explode("|",$rs->Value('ca_incoterms')));
    while (!$tm->Eof()) {
        $orden = $ordenes[$tm->Value('ca_idtercero')];
		$termino = substr($terminos[$tm->Value('ca_idtercero')],0,3);
        $pdf->SetWidths(array(25,25,85,25,40));
        $pdf->SetFills(array(1,0,0,0,0,0,0));
        $pdf->SetStyles(array("B","B","","B",""));
        $pdf->Row(array('Proveedor:','7. Nombre:',$tm->Value('ca_nombre'),'7.1 Orden:',$orden));
        $pdf->SetWidths(array(5,20,70,25,80));
        $pdf->Row(array('','7.2 Contacto:',$tm->Value('ca_contacto'),'7.3 Dirección:',$tm->Value('ca_direccion')));
        $pdf->SetWidths(array(5,20,40,15,30,18,40,22,10));
        $pdf->SetStyles(array("B","B","","B","","B","","B",""));
        $pdf->Row(array('','7.4 Teléfono:',$tm->Value('ca_telefonos'),'7.5 Fax:',$tm->Value('ca_fax'),'7.6 E-mail:',$tm->Value('ca_email'),'7.7 Incoterms:',$termino));
        $pdf->Ln(1);
        $tm->MoveNext();
    }

    $pdf->Ln(3);

    $pdf->SetWidths(array(25,25,85,25,40));
    $pdf->SetFills(array(1,0,0,0,0));
    $pdf->SetStyles(array("B","B","","B",""));
    $pdf->Row(array('Cliente:','8. Nombre:',$rs->Value('ca_nombre_cli')." Nit: ".$rs->Value('ca_idcliente')."-".$rs->Value('ca_digito'),'8.1 Orden:',$rs->Value('ca_orden_clie')));
    $pdf->SetWidths(array(5,20,70,25,80));
    $pdf->Row(array('','8.2 Contacto:',$rs->Value('ca_contacto_cli'),'8.3 Dirección:',str_replace ("|"," ",$rs->Value('ca_direccion_cli'))));
    $pdf->SetWidths(array(5,20,40,15,30,18,72));
    $pdf->SetFills(array(1,0,0,0,0,0,0));
    $pdf->SetStyles(array("B","B","","B","","B",""));
    $pdf->Row(array('','8.4 Teléfono:',$rs->Value('ca_telefonos_cli'),'8.5 Fax:',$rs->Value('ca_fax_cli'),'8.6 E-mail:',$rs->Value('ca_email_cli')));

    if($rs->Value('ca_idconsignatario') != 0){
        $pdf->Ln(3);
        $pdf->SetWidths(array(25,25,85,40,25));
        $pdf->SetFills(array(1,0,0,0,0));
        $pdf->SetStyles(array("B","B","","B",""));
        $pdf->Row(array('Consignatario:','9.1 Nombre:',$rs->Value('ca_nombre_con')." Nit: ".$rs->Value('ca_identificacion_con'),'9.1.1 Enviar Información:',$rs->Value('ca_informar_cons')));
        $pdf->SetWidths(array(5,22,68,25,80));
        $pdf->Row(array('','9.1.2 Cont.:',$rs->Value('ca_contacto_con'),'9.1.3 Dirección:',str_replace ("|"," ",$rs->Value('ca_direccion_con'))));
        $pdf->SetWidths(array(5,22,38,15,30,20,70));
        $pdf->SetFills(array(1,0,0,0,0,0,0));
        $pdf->SetStyles(array("B","B","","B","","B",""));
        $pdf->Row(array('','9.1.4 Tel.:',$rs->Value('ca_telefonos_con'),'9.1.5 Fax:',$rs->Value('ca_fax_con'),'9.1.6 E-mail:',$rs->Value('ca_email_con')));
    }

    if($rs->Value('ca_idnotify') != 0){
        $pdf->Ln(3);
        $pdf->SetWidths(array(25,25,85,40,25));
        $pdf->SetFills(array(1,0,0,0,0));
        $pdf->SetStyles(array("B","B","","B",""));
        $pdf->Row(array('Notify:','9.2 Nombre:',$rs->Value('ca_nombre_not'),'9.2.1 Enviar Información:',$rs->Value('ca_informar_noti')));
        $pdf->SetWidths(array(5,25,65,25,80));
        $pdf->Row(array('','9.2.2 Contacto:',$rs->Value('ca_contacto_not'),'9.2.3 Dirección:',str_replace ("|"," ",$rs->Value('ca_direccion_not'))));
        $pdf->SetWidths(array(5,25,35,15,30,20,70));
        $pdf->SetFills(array(1,0,0,0,0,0,0));
        $pdf->SetStyles(array("B","B","","B","","B",""));
        $pdf->Row(array('','9.2.4 Teléfono:',$rs->Value('ca_telefonos_not'),'9.2.5 Fax:',$rs->Value('ca_fax_not'),'9.2.6 E-mail:',$rs->Value('ca_email_not')));
    }

    if($rs->Value('ca_idmaster') != 0){
        $pdf->Ln(3);
        $pdf->SetWidths(array(25,25,85,40,25));
        $pdf->SetFills(array(1,0,0,0,0));
        $pdf->SetStyles(array("B","B","","B",""));
        $pdf->Row(array('Consigna.Master:','9.3 Nombre:',$rs->Value('ca_nombre_mas'),'9.2.1 Enviar Información:',$rs->Value('ca_informar_mast')));
        $pdf->SetWidths(array(5,25,65,25,80));
        $pdf->Row(array('','9.3.2 Contacto:',$rs->Value('ca_contacto_mas'),'9.3.3 Dirección:',str_replace ("|"," ",$rs->Value('ca_direccion_mas'))));
        $pdf->SetWidths(array(5,25,35,15,30,20,70));
        $pdf->SetFills(array(1,0,0,0,0,0,0));
        $pdf->SetStyles(array("B","B","","B","","B",""));
        $pdf->Row(array('','9.3.4 Teléfono:',$rs->Value('ca_telefonos_mas'),'9.3.5 Fax:',$rs->Value('ca_fax_mas'),'9.3.6 E-mail:',$rs->Value('ca_email_mas')));
    }

    if($rs->Value('ca_idrepresentante') != 0){
        $pdf->Ln(3);
        $pdf->SetWidths(array(25,25,85,40,25));
        $pdf->SetFills(array(1,0,0,0,0));
        $pdf->SetStyles(array("B","B","","B",""));
        $pdf->Row(array('Representante:','10. Nombre:',$rs->Value('ca_nombre_rep'),'10.1 Enviar Información:',$rs->Value('ca_informar_repr')));
        $pdf->SetWidths(array(5,25,65,25,80));
        $pdf->Row(array('','10.2 Contacto:',$rs->Value('ca_contacto_rep'),'10.3 Dirección:',str_replace ("|"," ",$rs->Value('ca_direccion_rep'))));
        $pdf->SetWidths(array(5,25,35,15,30,18,72));
        $pdf->SetFills(array(1,0,0,0,0,0,0));
        $pdf->SetStyles(array("B","B","","B","","B",""));
        $pdf->Row(array('','10.4 Teléfono:',$rs->Value('ca_telefonos_rep'),'10.5 Fax:',$rs->Value('ca_fax_rep'),'10.6 E-mail:',$rs->Value('ca_email_rep')));
    }

    $pdf->Ln(3);

    $pdf->SetWidths(array(200));
    $pdf->SetFills(array(1));
    $pdf->Row(array(''));

    $pdf->SetWidths(array(200));
    $pdf->SetStyles(array(""));
    $pdf->SetFills(array(0));
    $pdf->Row(array('11.1 Preferencias del Cliente:'."\n".$rs->Value('ca_preferencias_clie')));

    $pdf->SetWidths(array(200));
    $pdf->SetStyles(array(""));
    $pdf->Row(array('11.2 Instrucciones Especiales para el Agente:'."\n".$rs->Value('ca_instrucciones')));

    $pdf->SetWidths(array(45,50,50,55));
    $pdf->SetStyles(array("B","","","",""));
    $emails = explode(",", $rs->Value('ca_confirmar_clie'));
    $z=0;
    $cadena = "11.3 Copiar comunicaciones a:";
    for ($i=0; $i<ceil(count($emails)/3); $i++){
        for ($j=0; $j<3; $j++){
            $cadena.= (strlen($emails[$z])==0)?",":",".$emails[$z];
            $z++;
            }
        $pdf->Row(explode(",",$cadena));
        $cadena = "";
     }
    $pdf->Ln(3);

    $pdf->SetWidths(array(25,25,22,23,35,70));
    $pdf->SetFills(array(0,0,0,0,0,0));
    $pdf->SetStyles(array("B","","B","","B","","B",""));
    $pdf->Row(array('12. Transporte:',$rs->Value('ca_transporte'),'13. Modalidad:',$rs->Value('ca_modalidad'),'14. Línea Transporte:',$rs->Value('ca_nombre')));

    $tiempo_cred = ($rs->Value('ca_liberacion')=='Sí')?" Tiempo de Crédito: ".$rs->Value('ca_tiempocredito'):"";
    $pdf->SetWidths(array(40,10,35,10,35,70));
    $pdf->Row(array('15. Colmas Ltda:',$rs->Value('ca_colmas'),'16. Seguro:',$rs->Value('ca_seguro'),'17. Lib. Automática:',$rs->Value('ca_liberacion').$tiempo_cred));

    if ($rs->Value('ca_continuacion')!= "N/A") {
        $pdf->Ln(3);
        $pdf->SetWidths(array(200));
        $pdf->SetFills(array(1));
        $pdf->SetAligns(array("C"));
        $pdf->SetStyles(array("B"));
        $pdf->Row(array('CONTINUACIÓN DE VIAJE'));
        $pdf->SetWidths(array(35,10,28,20,42,65));
        $pdf->SetAligns(array("L","L","L","L","L","L"));
        $pdf->SetStyles(array("B","","B","","B",""));
        $pdf->SetFills(array(0,0,0,0,0,0));
		 $tm =& DlRecordset::NewRecordset($conn);
		 if (!$tm->Open("select ca_email, ca_login from vi_usuarios where ca_login='".$rs->Value('ca_continuacion_conf')."'")) { // Hace un Select a la vista e uncluye un registro vacio
		 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";     // Muestra el mensaje de error
		 echo "<script>document.location.href = 'reportenegocio.php';</script>";
		 exit;
	 }
	 $tm->MoveFirst();
		
        $pdf->Row(array('18.1 Continuación/Viaje:',$rs->Value('ca_continuacion'),'18.2 Destino final:',$rs->Value('ca_final_dest'),'18.3 Notificar C/Viaje al email:',$tm->Value('ca_email')));
    }

    $pdf->SetWidths(array(45,115,30,10));
	$consig = (($rs->Value('ca_idconsignatario')!=0)?$rs->Value('ca_nombre_con'):$rs->Value('ca_nombre_cli'));
    $cadena = (($rs->Value('ca_consignar')=='Nombre del Cliente')?$consig:$rs->Value('ca_consignar')).(($rs->Value('ca_idbodega')!= 111)?" / ".$rs->Value('ca_tipobodega')." ".$rs->Value('ca_bodega'):"");
    $pdf->Row(array('19.1 Consignar HAWB/HBL a :',$cadena,'Igualar Master/Hijo:',$rs->Value('ca_mastersame')));

    if ($rs->Value('ca_seguro')== "Sí") {
        $pdf->Ln(3);
        $sg =& DlRecordset::NewRecordset($conn);
         if (!$sg->Open("select * from tb_repseguro left join control.tb_usuarios on ca_seguro_conf=ca_login where ca_idreporte = ".$rs->Value('ca_idreporte'))) {       // Selecciona todos lo registros de la tabla tb_repseguro
            echo "<script>alert(\"".addslashes($sg->mErrMsg)."\");</script>";      // Muestra el mensaje de error
            echo "<script>document.location.href = 'reportenegocio.php';</script>";
            exit; }
        $pdf->SetWidths(array(200));
        $pdf->SetFills(array(1));
        $pdf->SetAligns(array("C"));
        $pdf->SetStyles(array("B"));
        $pdf->Row(array('INFORMACIÓN PARA LA ASEGURADORA'));

        $pdf->SetWidths(array(35,35,35,95));
        $pdf->SetFills(array(1,1,1,1));
        $pdf->SetAligns(array("C","C","C","C"));
        $pdf->SetStyles(array("B","B","B","B"));
        $pdf->Row(array('20.1 Vlr.Asegurado:','20.2 Obtención Póliza:','20.3 Prima Venta:','20.4 Notificar Seguro:'));
        $pdf->SetStyles(array("","","",""));
        $pdf->SetFills(array(0,0,0,0));
        $pdf->SetAligns(array("C","C","C","L"));
        $pdf->Row(array(formatNumber($sg->Value('ca_vlrasegurado'),3)." ".$sg->Value('ca_idmoneda_vlr'),formatNumber($sg->Value('ca_obtencionpoliza'),3)." ".$sg->Value('ca_idmoneda_pol'),$sg->Value('ca_primaventa')."%\nMin.".$sg->Value('ca_minimaventa')." ".$sg->Value('ca_idmoneda_vta'),$sg->Value('ca_email')));
    }

	if ($rs->Value('ca_colmas')== "Sí") {
        $pdf->Ln(3);
		$sg =& DlRecordset::NewRecordset($conn);
		if (!$sg->Open("select * from tb_repaduana ra LEFT OUTER JOIN tb_repaduanadet rad on (ra.ca_idreporte = rad.ca_idreporte and ra.ca_idrepaduana = rad.ca_idrepaduana) where ra.ca_idreporte = ".$rs->Value('ca_idreporte'))) {       // Selecciona todos lo registros de la tabla tb_repaduana
			echo "<script>alert(\"".addslashes($sg->mErrMsg)."\");</script>";      // Muestra el mensaje de error
			echo "<script>document.location.href = 'reportenegocio.php';</script>";
			exit; }
        $pdf->SetWidths(array(200));
        $pdf->SetFills(array(1));
        $pdf->SetAligns(array("C"));
        $pdf->SetStyles(array("B"));
        $pdf->Row(array('NACIONALIZACION CON COLMAS SIA LTDA.'));

        $pdf->SetWidths(array(100,100));
        $pdf->SetFills(array(1,0));
        $pdf->SetAligns(array("C","L"));
        $pdf->SetStyles(array("B",""));
        $pdf->Row(array('Transporte de Carga Nacionalizada','21.3 Instrucciones Especiales para Colmas:'));
        $pdf->SetWidths(array(32,26,42,100));
        $pdf->SetFills(array(0,0,0,0));
        $pdf->SetAligns(array("L","L","L","L"));
        $pdf->SetStyles(array("","","",""));
        $pdf->Row(array("21.1 Con Coltrans:  ".$rs->Value('ca_transnacarga'),"21.2 Tipo:\n".$rs->Value('ca_transnatipo'),"21.4 Coordinador:\n".$rs->Value('ca_namecoordinador'),$rs->Value('ca_instrucciones_ad')));
    }

    $pdf->Ln(3);
    $pdf->SetWidths(array(200));
    $pdf->SetFills(array(1));
    $pdf->SetAligns(array("C"));
    $pdf->SetStyles(array("B"));
    $pdf->Row(array('EMBARQUE '.strtoupper($rs->Value('ca_transporte'))));

    $rm =& DlRecordset::NewRecordset($conn);
    if ($rs->Value('ca_transporte') == 'Aéreo') {
        if (!$rm->Open("select * from vi_reptarifas where ca_idreporte = ".$rs->Value('ca_idreporte'))) {       // Selecciona todos lo registros de la tabla tb_reptarifas
            echo "<script>alert(\"".addslashes($rm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
            echo "<script>document.location.href = 'reportenegocio.php';</script>";
            exit; }
        $pdf->SetWidths(array(5,40,50,50,50,5));
        $pdf->SetFills(array(0,1,1,1,1,0));
        $pdf->SetStyles(array("B","B","B","B","B"));
        $pdf->SetAligns(array("C","C","C","C","C"));
        $pdf->Row(array('','Concepto:','Reportar / Min.','Cobrar / Min','Observaciones',''));

        $pdf->SetWidths(array(5,40,25,25,25,25,50,5));
        $pdf->SetFills(array(0,0,0,0,0,0,0,0));
        $pdf->SetStyles(array("","","","","","","",""));
        $pdf->SetAligns(array("L","L","R","R","R","R","L","L"));

        while (!$rm->Eof()) {
            $pdf->Row(array('',$rm->Value('ca_concepto'),formatNumber($rm->Value('ca_reportar_tar'),3)." ".$rm->Value('ca_reportar_idm'),formatNumber($rm->Value('ca_reportar_min'),3)." ".$rm->Value('ca_reportar_idm'),formatNumber($rm->Value('ca_cobrar_tar'),3)." ".$rm->Value('ca_cobrar_idm'),formatNumber($rm->Value('ca_cobrar_min'),3)." ".$rm->Value('ca_cobrar_idm'),$rm->Value('ca_observaciones'),''));
            $rm->MoveNext();
            }
    }else if ($rs->Value('ca_transporte') == 'Marítimo') {
        if (!$rm->Open("select * from vi_reptarifas where ca_idreporte = ".$rs->Value('ca_idreporte'))) {       // Selecciona todos lo registros de la tabla tb_reptarifas
            echo "<script>alert(\"".addslashes($rm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
            echo "<script>document.location.href = 'reportenegocio.php';</script>";
            exit; }
        $pdf->SetWidths(array(40,10,40,40,40,30));
        $pdf->SetFills(array(1,1,1,1,1,1));
        $pdf->SetStyles(array("B","B","B","B","B","B"));
        $pdf->SetAligns(array("C","C","C","C","C","C"));
        $pdf->Row(array('Concepto:','Cant.','Neta / Min.','Reportar / Min.','Cobrar / Min','Observaciones'));

        $pdf->SetWidths(array(40,10,20,20,20,20,20,20,30));
        $pdf->SetFills(array(1,0,0,0,0,0,0,0,0,0));
        $pdf->SetStyles(array("B","","","","","","","","",""));
        $pdf->SetAligns(array("L","C","R","R","R","R","R","R","L"));

        while (!$rm->Eof()) {
            $pdf->Row(array($rm->Value('ca_concepto'),formatNumber($rm->Value('ca_cantidad')),formatNumber($rm->Value('ca_neta_tar'),3)." ".$rm->Value('ca_neta_idm'),formatNumber($rm->Value('ca_neta_min'),3)." ".$rm->Value('ca_neta_idm'),formatNumber($rm->Value('ca_reportar_tar'),3)." ".$rm->Value('ca_reportar_idm'),formatNumber($rm->Value('ca_reportar_min'),3)." ".$rm->Value('ca_reportar_idm'),formatNumber($rm->Value('ca_cobrar_tar'),3)." ".$rm->Value('ca_cobrar_idm'),formatNumber($rm->Value('ca_cobrar_min'),3)." ".$rm->Value('ca_cobrar_idm'),$rm->Value('ca_observaciones')));
            $rm->MoveNext();
            }
    }

    $pdf->Ln(3);
    $pdf->SetWidths(array(200));
    $pdf->SetFills(array(1));
    $pdf->SetAligns(array("C"));
    $pdf->SetStyles(array("B"));
    $pdf->Row(array('RELACIÓN DE RECARGOS'));

    $sub_mem = 'Recargo en Origen';
    $rg =& DlRecordset::NewRecordset($conn);
    if (!$rg->Open("select * from vi_repgastos where ca_tiporecargo like '%$sub_mem%' and ca_idreporte = ".$rs->Value('ca_idreporte'))) {       // Selecciona todos lo registros de la tabla tb_repgastos
        echo "<script>alert(\"".addslashes($rg->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'reportenegocio.php';</script>";
        exit; }

    $pdf->SetWidths(array(45,35,40,40,40));
    $pdf->SetFills(array(1,1,1,1,1));
    $pdf->SetStyles(array("B","B","B","B","B"));
    $pdf->SetAligns(array("C","C","C","C","C"));
    $pdf->Row(array($sub_mem,'Aplicación','Neta / Min.','Reportar / Min.','Cobrar / Min'));

    $pdf->SetWidths(array(45,35,20,20,20,20,20,20));
    $pdf->SetFills(array(1,0,0,0,0,0,0,0,0));
    $pdf->SetStyles(array("B","","","","","","","",""));
    $pdf->SetAligns(array("L","L","R","R","R","R","R","R"));

    while (!$rg->Eof()) {
        $des_rec = $rg->Value('ca_recargo').(($rg->Value('ca_idconcepto')!='9999')?" -> ".$rg->Value('ca_concepto'):"");
        if ($rg->Value('ca_tipo')=="$")
            $pdf->Row(array($des_rec,$rg->Value('ca_aplicacion'),formatNumber($rg->Value('ca_neta_tar'),3)." ".$rg->Value('ca_idmoneda'),formatNumber($rg->Value('ca_neta_min'),3)." ".$rg->Value('ca_idmoneda'),formatNumber($rg->Value('ca_reportar_tar'),3)." ".$rg->Value('ca_idmoneda'),formatNumber($rg->Value('ca_reportar_min'),3)." ".$rg->Value('ca_idmoneda'),formatNumber($rg->Value('ca_cobrar_tar'),3)." ".$rg->Value('ca_idmoneda'),formatNumber($rg->Value('ca_cobrar_min'),3)." ".$rg->Value('ca_idmoneda')));
        else
            $pdf->Row(array($des_rec,$rg->Value('ca_aplicacion'),formatNumber($rg->Value('ca_neta_tar'),3)." ".$rg->Value('ca_tipo'),formatNumber($rg->Value('ca_neta_min'),3)." ".$rg->Value('ca_idmoneda'),formatNumber($rg->Value('ca_reportar_tar'),3)." ".$rg->Value('ca_tipo'),formatNumber($rg->Value('ca_reportar_min'),3)." ".$rg->Value('ca_idmoneda'),formatNumber($rg->Value('ca_cobrar_tar'),3)." ".$rg->Value('ca_tipo'),formatNumber($rg->Value('ca_cobrar_min'),3)." ".$rg->Value('ca_idmoneda')));
        if ($rg->Value('ca_detalles')!=''){
            $pdf->SetWidths(array(200));
            $pdf->SetStyles(array(""));
            $pdf->SetFills(array(0));
            $pdf->Row(array("* Observaciones: ".$rg->Value('ca_detalles')));
            $pdf->SetWidths(array(45,35,20,20,20,20,20,20));
            $pdf->SetFills(array(1,0,0,0,0,0,0,0,0));
            $pdf->SetStyles(array("B","","","","","","","",""));
            $pdf->SetAligns(array("L","L","R","R","R","R","R","R"));
        }
        $rg->MoveNext();
        }

    $sub_mem = 'Recargo Local';
    $pdf->Ln(3);
    if (!$rg->Open("select * from vi_repgastos where ca_tiporecargo like '%$sub_mem%' and ca_idreporte = ".$rs->Value('ca_idreporte'))) {       // Selecciona todos lo registros de la tabla tb_repgastos
        echo "<script>alert(\"".addslashes($rg->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'reportenegocio.php';</script>";
        exit; }

    $pdf->SetWidths(array(100,40,60));
    $pdf->SetFills(array(1,1,1));
    $pdf->SetStyles(array("B","B","B"));
    $pdf->SetAligns(array("C","C","C"));
    $pdf->Row(array($sub_mem,'Observaciones','Cobrar / Min'));

    $pdf->SetWidths(array(100,40,30,30));
    $pdf->SetFills(array(1,0,0,0,));
    $pdf->SetStyles(array("B","","",""));
    $pdf->SetAligns(array("L","L","R","R"));

    $rg->MoveFirst();
    while (!$rg->Eof()) {
        $des_rec = $rg->Value('ca_recargo').(($rg->Value('ca_idconcepto')!='9999')?" -> ".$rg->Value('ca_concepto'):"");
        if ($rg->Value('ca_tipo')=="$")
            $pdf->Row(array($des_rec,$rg->Value('ca_aplicacion'),formatNumber($rg->Value('ca_cobrar_tar'),3)." ".$rg->Value('ca_idmoneda'),formatNumber($rg->Value('ca_cobrar_min'),3)." ".$rg->Value('ca_idmoneda')));
        else
            $pdf->Row(array($des_rec,$rg->Value('ca_aplicacion'),$rg->Value('ca_tipo')." ".formatNumber($rg->Value('ca_cobrar_tar'),2),formatNumber($rg->Value('ca_cobrar_min'),3)." ".$rg->Value('ca_idmoneda')));
        if ($rg->Value('ca_detalles')!=''){
            $pdf->SetWidths(array(200));
            $pdf->SetStyles(array(""));
            $pdf->SetFills(array(0));
            $pdf->Row(array("* Observaciones: ".$rg->Value('ca_detalles')));
            $pdf->SetWidths(array(100,40,30,30));
            $pdf->SetFills(array(1,0,0,0,));
            $pdf->SetStyles(array("B","","",""));
            $pdf->SetAligns(array("L","L","R","R"));
        }
        $rg->MoveNext();
        }

	if ($rs->Value('ca_colmas')== "Sí") {
        $pdf->Ln(3);
		$sg =& DlRecordset::NewRecordset($conn);
		if (!$sg->Open("select r.*, c.ca_costo from tb_repaduanadet r, tb_costos c where r.ca_idcosto = c.ca_idcosto and ca_idreporte = $id and ca_idrepaduana = ".((strlen($rs->Value('ca_idrepaduana'))!=0)?$rs->Value('ca_idrepaduana'):0))) {       // Selecciona todos lo registros de la tabla tb_repaduanadet
			echo "<script>alert(\"".addslashes($sg->mErrMsg)."\");</script>";      // Muestra el mensaje de error
			echo "<script>document.location.href = 'reportenegocio.php';</script>";
			exit; }
        $pdf->SetWidths(array(200));
        $pdf->SetFills(array(1));
        $pdf->SetAligns(array("C"));
        $pdf->SetStyles(array("B"));
        $pdf->Row(array('CONCEPTOS DE COBRO EN AGENCIAMIENTO COLMAS SIA LTDA.'));

        $pdf->SetWidths(array(49,8,21,21,21,10,70));
        $pdf->SetFills(array_fill(0, 7, "1"));
        $pdf->SetAligns(array_fill(0, 7, "C"));
        $pdf->SetStyles(array_fill(0, 7, "B"));
        $pdf->Row(array('Concepto','Tipo','Neto','Valor','Mínimo','Mnd','Detalles'));

        $pdf->SetFills(array_fill(0, 7, "0"));
        $pdf->SetAligns(array("L","C","R","R","R","C","L"));
        $pdf->SetStyles(array_fill(0, 7, ""));

		$sg->MoveFirst();
		while (!$sg->Eof() and !$sg->IsEmpty()) {
	        $pdf->Row(array($sg->Value('ca_costo'),$sg->Value('ca_tipo'),formatNumber($sg->Value('ca_netcosto'),3),formatNumber($sg->Value('ca_vlrcosto'),3),formatNumber($sg->Value('ca_mincosto'),3),$sg->Value('ca_idmoneda'),$sg->Value('ca_detalles')));
			$sg->MoveNext();
		}

	}
    $pdf->Ln(3);
    $line = $pdf->GetAttrib('y');
    for ($i=$line; $i<274; $i+=5){
      $pdf->Cell(0, 5, str_repeat(" . ", 84), 0, 1);
    }
    $pdf->SetY(275);
    $pdf->SetWidths(array(15,24,15,24,15,32,25,50));
    $pdf->SetFills(array(1,0,1,0,1,0,1,0));
    $pdf->SetStyles(array("B","B","B","B","B","B","B","B"));
    $pdf->SetAligns(array("L","L","L","L","L","C","L","C"));
    $pdf->Row(array('Ciudad :',$rs->Value('ca_sucursal'),'Elaboró :',$usu_mem,'Fecha:',date("Y-m-d",mktime($hor,$min,$seg,$mes,$dia,$anno))." ".date("h:i a",mktime($hor,$min,$seg,$mes,$dia,$anno)),'Rep. Comercial:',$rs->Value('ca_vendedor')));
    $pdf->Output();
}
?>