<?php

class FalaDeclaracionImpTable extends Doctrine_Table
{
        /*
	* Genera la consulta que permitirá exportar los datos en archivo plano para Falabella
	* con la Declaración de Importación
	*/
	public static function declaracionImportacion($referencia){

            $query = "select fdi.ca_referencia, fdi.ca_numinternacion, ";
            $query.= "  fdd.ca_numdeclaracion, fdd.ca_arancel, fdd.ca_iva, fdd.ca_compensa, fdd.ca_antidump, fdd.ca_salvaguarda, fdd.ca_sancion, fdd.ca_rescate, fdd.ca_valor_fob, fdd.ca_gastos_despacho, fdd.ca_flete, fdd.ca_seguro, fdd.ca_gastos_embarque, fdd.ca_valor_aduana, fdd.ca_ajuste_valor, fdd.ca_valor_aduana, ";
            $query.= "  fsp.ca_iddoc, fsp.ca_embarque, fdd.ca_emision_fch, fdd.ca_vencimiento_fch, fdd.ca_aceptacion_nro, fdd.ca_aceptacion_fch, fdd.ca_pago_fch, fdd.ca_moneda, fdd.ca_valor_trm, fsp.ca_subpartida, fsp.ca_prorrateo_fob, fcn.ca_registros from tb_faladeclaracion_imp fdi "; // fvf.ca_subtotal_fob,
            $query.= "  inner join (select * from tb_faladeclaracion_dts where ca_referencia = '$referencia') fdd on fdd.ca_referencia = fdi.ca_referencia ";

            $query.= "  inner join (select fh.ca_referencia, fh.ca_iddoc, fi.ca_embarque, fd.ca_subpartida, sum(fd.ca_valor_fob) as ca_prorrateo_fob from ";
            $query.= "      tb_falaheader_adu fh ";
            $query.= "      inner join tb_falainstructions_adu fi on fi.ca_iddoc = fh.ca_iddoc ";
            $query.= "      inner join tb_faladetails_adu fd on fd.ca_iddoc = fh.ca_iddoc where fh.ca_referencia = '$referencia' ";

            $query.= "      group by fh.ca_referencia, fh.ca_iddoc, fi.ca_embarque, fd.ca_subpartida ";
            $query.= "      order by fh.ca_referencia, fd.ca_subpartida, fh.ca_iddoc) fsp on fsp.ca_referencia = fdd.ca_referencia and fsp.ca_subpartida = fdd.ca_subpartida ";

            $query.= "  inner join (select ca_referencia, ca_numdeclaracion, count(ca_iddoc) as ca_registros from ";
            $query.= "      (select distinct fha.ca_referencia, fdd.ca_numdeclaracion, fda.ca_subpartida, fda.ca_iddoc ";
            $query.= "          from tb_falaheader_adu fha ";
            $query.= "          inner join tb_faladetails_adu fda on fha.ca_iddoc = fda.ca_iddoc ";
            $query.= "          inner join tb_faladeclaracion_dts fdd on fha.ca_referencia = fdd.ca_referencia and fda.ca_subpartida = fdd.ca_subpartida ";
            $query.= "          where fha.ca_referencia = '$referencia' ";
            $query.= "          order by fha.ca_referencia, fdd.ca_numdeclaracion, fda.ca_subpartida) cnt group by ca_referencia, ca_numdeclaracion) fcn on fcn.ca_referencia = fdd.ca_referencia and fcn.ca_numdeclaracion = fdd.ca_numdeclaracion ";

            $query.= "where fdi.ca_referencia = '$referencia' order by fdd.ca_numdeclaracion, fsp.ca_subpartida ";

            // echo "<br />".$query."<br />";
            $q = Doctrine_Manager::getInstance()->connection();
            $stmt = $q->execute($query);
            return $stmt;
	}

        /*
	* Genera la consulta que permitirá exportar los datos en archivo plano para Falabella
	* con los datos de facturación
	*/
	public static function facturacionNacionalizacion($referencia){

            $query = "select fh.ca_iddoc, fh.ca_referencia, fi.ca_embarque, ff.ca_numdocumento, ff.ca_emision_fch, ff.ca_vencimiento_fch, ff.ca_moneda, ff.ca_tipo_cambio, ff.ca_afecto_vlr, ff.ca_iva_vlr, ff.ca_exento_vlr, fdd.ca_valor_fob, fsp.* from tb_falaheader_adu fh ";
            $query.= "  inner join tb_falainstructions_adu fi on fi.ca_iddoc = fh.ca_iddoc ";
            $query.= "  inner join (select * from tb_falafacturacion_adu where ca_referencia = '$referencia') ff on ff.ca_referencia = fh.ca_referencia ";
            $query.= "  inner join (select ca_referencia, sum(ca_valor_fob) as ca_valor_fob from tb_faladeclaracion_dts where ca_referencia = '$referencia' group by ca_referencia) fdd on fdd.ca_referencia = fh.ca_referencia ";

            $query.= "  inner join (select fh.ca_referencia, fh.ca_iddoc, sum(fd.ca_valor_fob) as ca_prorrateo_fob from ";
            $query.= "      tb_falaheader_adu fh ";
            $query.= "      inner join tb_faladetails_adu fd on fd.ca_iddoc = fh.ca_iddoc where fh.ca_referencia = '$referencia' ";
            $query.= "      group by fh.ca_referencia, fh.ca_iddoc ";
            $query.= "      order by fh.ca_referencia, fh.ca_iddoc) fsp on fsp.ca_referencia = fh.ca_referencia and fsp.ca_iddoc = fh.ca_iddoc ";

            $query.= "where fh.ca_referencia = '$referencia' order by fh.ca_referencia, ff.ca_numdocumento ";

            // echo "<br />".$query."<br />";
            $q = Doctrine_Manager::getInstance()->connection();
            $stmt = $q->execute($query);
            return $stmt;
	}


        /*
	* Genera la consulta que permitirá exportar los datos en archivo plano para Falabella
	* con los datos de nota debito agente
	*/
	public static function notaAgenteNacionalizacion($referencia){

            $query = "select fh.ca_iddoc, fh.ca_referencia, fi.ca_embarque, fnc.ca_numdocumento, fnc.ca_emision_fch, fnc.ca_vlrdocumento, fnc.ca_tipo_cambio, fnd.ca_idconcepto, fnd.ca_nit_ter, fnd.ca_tipo, fnd.ca_factura_ter, fnd.ca_factura_fch, fnd.ca_factura_vlr, fnd.ca_factura_iva, fdd.ca_valor_fob, fsp.* from tb_falaheader_adu fh ";
            $query.= "  inner join tb_falainstructions_adu fi on fi.ca_iddoc = fh.ca_iddoc ";
            $query.= "  inner join (select * from tb_falanota_cab where ca_referencia = '$referencia' order by ca_numdocumento) fnc on fnc.ca_referencia = fh.ca_referencia ";
            $query.= "  inner join (select * from tb_falanota_det where ca_referencia = '$referencia' order by ca_numdocumento) fnd on fnd.ca_referencia = fnc.ca_referencia and fnd.ca_numdocumento = fnc.ca_numdocumento";
            $query.= "  inner join (select ca_referencia, sum(ca_valor_fob) as ca_valor_fob from tb_faladeclaracion_dts where ca_referencia = '$referencia' group by ca_referencia) fdd on fdd.ca_referencia = fh.ca_referencia ";

            $query.= "  inner join (select fh.ca_referencia, fh.ca_iddoc, sum(fd.ca_valor_fob) as ca_prorrateo_fob from ";
            $query.= "      tb_falaheader_adu fh ";
            $query.= "      inner join tb_faladetails_adu fd on fd.ca_iddoc = fh.ca_iddoc where fh.ca_referencia = '$referencia' ";
            $query.= "      group by fh.ca_referencia, fh.ca_iddoc ";
            $query.= "      order by fh.ca_referencia, fh.ca_iddoc) fsp on fsp.ca_referencia = fh.ca_referencia and fsp.ca_iddoc = fh.ca_iddoc ";

            $query.= "where fh.ca_referencia = '$referencia' order by fh.ca_referencia, fnc.ca_numdocumento, fnd.ca_idconcepto";

            // echo "<br />".$query."<br />";
            $q = Doctrine_Manager::getInstance()->connection();
            $stmt = $q->execute($query);
            return $stmt;
	}

}
