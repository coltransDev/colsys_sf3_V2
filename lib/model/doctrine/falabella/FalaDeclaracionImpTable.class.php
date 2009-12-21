<?php

class FalaDeclaracionImpTable extends Doctrine_Table
{
        /*
	* Genera la consulta que permitirá exportar los datos en archivo plano para Falabella
	* con la Declaración de Importación
	*/
	public static function declaracionImportacion($referencia){

            $query = "select fdi.ca_referencia, fdi.ca_numdeclaracion, fdi.ca_numinternacion, fdi.ca_emision_fch, fdi.ca_vencimiento_fch, fdi.ca_aceptacion_fch, fdi.ca_pago_fch, fdi.ca_moneda, fdi.ca_valor_trm, ";
            $query.= "  fdd.ca_arancel, fdd.ca_iva, fdd.ca_compensa, fdd.ca_antidump, fdd.ca_salvaguarda, fdd.ca_sancion, fdd.ca_rescate, fdd.ca_gastos_despacho, fdd.ca_flete, fdd.ca_seguro, fdd.ca_valor_aduana, fdd.ca_ajuste_valor, fdd.ca_valor_aduana, ";
            $query.= "  fvf.ca_subtotal_fob, fsp.ca_iddoc, fsp.ca_subpartida, fsp.ca_valor_fob from tb_faladeclaracion_imp fdi ";
            $query.= "  inner join (select * from tb_faladeclaracion_dts where ca_referencia = '$referencia') fdd on fdd.ca_referencia = fdi.ca_referencia ";

            $query.= "  inner join (select fh.ca_referencia, ca_subpartida, sum(ca_valor_fob) as ca_subtotal_fob from ";
            $query.= "      tb_faladetails_adu fd ";
            $query.= "      inner join tb_falaheader_adu fh on fd.ca_iddoc = fh.ca_iddoc where fh.ca_referencia = '$referencia' ";
            $query.= "      group by fh.ca_referencia, fd.ca_subpartida) fvf on fvf.ca_referencia = fdi.ca_referencia and fvf.ca_subpartida = fdd.ca_subpartida ";

            $query.= "  inner join (select fh.ca_referencia, fh.ca_iddoc, fd.ca_subpartida, sum(fd.ca_valor_fob) as ca_valor_fob from ";
            $query.= "      tb_falaheader_adu fh ";
            $query.= "      inner join tb_faladetails_adu fd on fd.ca_iddoc = fh.ca_iddoc where fh.ca_referencia = '$referencia' ";
            $query.= "      group by fh.ca_referencia, fh.ca_iddoc, fd.ca_subpartida ";
            $query.= "      order by fh.ca_referencia, fd.ca_subpartida, fh.ca_iddoc) fsp on fsp.ca_referencia = fdd.ca_referencia and fsp.ca_subpartida = fdd.ca_subpartida ";

            $query.= "where fdi.ca_referencia = '$referencia' order by fsp.ca_iddoc, fsp.ca_subpartida ";

            // echo "<br />".$query."<br />";
            $q = Doctrine_Manager::getInstance()->connection();
            $stmt = $q->execute($query);
            return $stmt;
	}

}
