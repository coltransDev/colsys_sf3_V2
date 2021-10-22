<?php

/**
 * 
 *
 * @version $Id$
 * @copyright 2003 
 **/

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 //



for ($i=0; $i < count($conceptos); $i++) {
	echo "---- ".$conceptos[$i]." -----<BR>";
	$arreglo = "A".$conceptos[$i];
	$pr =& DlRecordset::NewRecordset($conn);
	if (!$pr->Open("select * from vi_fletes where ca_oid = ".$conceptos[$i])) {
	    echo "<script>alert(\"".addslashes($pr->mErrMsg)."\");</script>";
	    echo "<script>document.location.href = 'cotizaciones.php';</script>";
	    exit;
	   }
	$co =& DlRecordset::NewRecordset($conn);
	if (!$co->Open("select * from vi_trayectos where ca_idtrayecto = ".$pr->Value('ca_idtrayecto'))) {
	    echo "<script>alert(\"".addslashes($co->mErrMsg)."\");</script>";
	    echo "<script>document.location.href = 'cotizaciones.php';</script>";
	    exit;
	   }
	echo $pr->Value('ca_concepto')."<BR>";
	echo $co->Value('ca_frecuencia')."<BR>";
	echo $co->Value('ca_tiempotransito')."<BR>";
    echo "<BR>";
	
	echo "Cantidad : ". ${$arreglo}[6]."<BR>";
	echo "Flete ...: ". sprintf("%01.2f",${$arreglo}[5])." ".$pr->Value('ca_idmoneda')."<BR>";
	echo "Mínimo ..: ". sprintf("%01.2f",${$arreglo}[4])." ".$pr->Value('ca_idmoneda')."<BR>";
    echo "<BR>";
	
	$rc =& DlRecordset::NewRecordset($conn);                                                                              //".$rs->Value('ca_incoterms')."
	if (!$rc->Open("select * from vi_recargos where ca_idtrayecto = ".$pr->Value('ca_idtrayecto')." and ca_incoterms like '%FOB - Free On Board%' and (ca_idconcepto = ".$pr->Value('ca_idconcepto'). " or ca_idconcepto = 9999)")) {
	    echo "<script>alert(\"".addslashes($rc->mErrMsg)."\");</script>";
	    echo "<script>document.location.href = 'cotizaciones.php';</script>";
	    exit;
	   }
	$rc->MoveFirst();

	$con_mem = 8;
	while (!$rc->Eof()) {
	    echo $rc->Value('ca_recargo')."<BR>";
		echo $rc->Value('ca_tipo')."<BR>";
		echo "Recargo Mínimo : ". ${$arreglo}[$con_mem]."<BR>";
		if ($rc->Value('ca_vlrfijo') != 0 and $rc->Value('ca_porcentaje') == 0 and $rc->Value('ca_vlrunitario') == 0) {
			echo "Aplicación : ". ${$arreglo}[$con_mem + 1]."<BR>";
			echo "Cantidad   : ". ${$arreglo}[$con_mem + 2]."<BR>";
		   }
		else if ($rc->Value('ca_porcentaje') != 0 and $rc->Value('ca_baseporcentaje') == 'Sobre Flete') {
			echo "Aplicación : ". ${$arreglo}[$con_mem + 1]."<BR>";
			echo "Cantidad   : ". ${$arreglo}[$con_mem + 2]."%<BR>";
		   }
		else if ($rc->Value('ca_porcentaje') != 0 and $rc->Value('ca_baseporcentaje') == 'Sobre Vlr Factura') {
			echo "Aplicación : ". ${$arreglo}[$con_mem + 1]."<BR>";
			echo "Cantidad   : ". ${$arreglo}[$con_mem + 2]."%<BR>";
		   }
		else if ($rc->Value('ca_vlrunitario') != 0 and $rc->Value('ca_baseunitario') == 'Unidades Peso/Volumen') {
			echo "Aplicación : ". ${$arreglo}[$con_mem + 1]."<BR>";
			echo "Cantidad   : ". ${$arreglo}[$con_mem + 2]."<BR>";
		   }
		else if ($rc->Value('ca_vlrunitario') != 0 and $rc->Value('ca_baseunitario') == 'Número de Piezas') {
			echo "Aplicación : ". ${$arreglo}[$con_mem + 1]."<BR>";
			echo "Cantidad   : ". ${$arreglo}[$con_mem + 2]."<BR>";
		   }
		else if ($rc->Value('ca_vlrunitario') != 0 and $rc->Value('ca_baseunitario') == 'Cantidad de BLs/AWBs') {
			echo "Aplicación : ". ${$arreglo}[$con_mem + 1]."<BR>";
			echo "Cantidad   : ". ${$arreglo}[$con_mem + 2]."<BR>";
		   }
		$con_mem+= 4;
		$rc->MoveNext();
		}
	$con_mem+= 2;

	if ($co->Value('ca_idtrayecto') == "Importación") {
		if (!$rc->Open("select * from vi_recargosxtraf where (ca_idtrafico = '".$co->Value('ca_idtraorigen')."' or ca_idtrafico = '99-999') and (ca_idciudad = '".$co->Value('ca_origen')."' or ca_idciudad = '999-9999') and ca_transporte = '".$co->Value('ca_transporte')."' and ca_impoexpo = '".$co->Value('ca_impoexpo')."' and ca_modalidad = '".$co->Value('ca_modalidad')."'")) {                              // Selecciona todos lo registros de la tabla Recargos por trafico
			echo "<script>alert(\"".addslashes($rc->mErrMsg)."\");</script>";                   // Muestra el mensaje de error
			echo "<script>document.location.href = 'entrada.php';</script>";
			exit; }
		}
	else {
		if (!$rc->Open("select * from vi_recargosxtraf where (ca_idtrafico = '".$co->Value('ca_idtradestino')."' or ca_idtrafico = '99-999') and (ca_idciudad = '".$co->Value('ca_destino')."' or ca_idciudad = '999-9999') and ca_transporte = '".$co->Value('ca_transporte')."' and ca_impoexpo = '".$co->Value('ca_impoexpo')."' and ca_modalidad = '".$co->Value('ca_modalidad')."'")) {                              // Selecciona todos lo registros de la tabla Recargos por trafico
			echo "<script>alert(\"".addslashes($rc->mErrMsg)."\");</script>";                   // Muestra el mensaje de error
			echo "<script>document.location.href = 'entrada.php';</script>";
			exit; }
		}
	$rc->MoveFirst();
	while (!$rc->Eof()) {
	    echo $rc->Value('ca_recargo')."<BR>";
		echo $rc->Value('ca_tipo')."<BR>";
		echo "Recargo Mínimo : ". ${$arreglo}[$con_mem]." ".$rc->Value('ca_idmoneda')."<BR>";
		if ($rc->Value('ca_vlrfijo') != 0 and $rc->Value('ca_porcentaje') == 0 and $rc->Value('ca_vlrunitario') == 0) {
			echo "Aplicación : ". ${$arreglo}[$con_mem + 1]."<BR>";
			echo "Cantidad   : ". ${$arreglo}[$con_mem + 2]."<BR>";
		   }
		else if ($rc->Value('ca_porcentaje') != 0 and $rc->Value('ca_baseporcentaje') == 'Sobre Flete') {
			echo "Aplicación : ". ${$arreglo}[$con_mem + 1]."<BR>";
			echo "Cantidad   : ". ${$arreglo}[$con_mem + 2]."%<BR>";
		   }
		else if ($rc->Value('ca_porcentaje') != 0 and $rc->Value('ca_baseporcentaje') == 'Sobre Vlr Factura') {
			echo "Aplicación : ". ${$arreglo}[$con_mem + 1]."<BR>";
			echo "Cantidad   : ". ${$arreglo}[$con_mem + 2]."%<BR>";
		   }
		else if ($rc->Value('ca_vlrunitario') != 0 and $rc->Value('ca_baseunitario') == 'Unidades Peso/Volumen') {
			echo "Aplicación : ". ${$arreglo}[$con_mem + 1]."<BR>";
			echo "Cantidad   : ". ${$arreglo}[$con_mem + 2]."<BR>";
		   }
		else if ($rc->Value('ca_vlrunitario') != 0 and $rc->Value('ca_baseunitario') == 'Número de Piezas') {
			echo "Aplicación : ". ${$arreglo}[$con_mem + 1]."<BR>";
			echo "Cantidad   : ". ${$arreglo}[$con_mem + 2]."<BR>";
		   }
		else if ($rc->Value('ca_vlrunitario') != 0 and $rc->Value('ca_baseunitario') == 'Cantidad de BLs/AWBs') {
			echo "Aplicación : ". ${$arreglo}[$con_mem + 1]."<BR>";
			echo "Cantidad   : ". ${$arreglo}[$con_mem + 2]."<BR>";
		   }
		$con_mem+= 4;
		$rc->MoveNext();
		echo "<BR>";
		}
}
?>