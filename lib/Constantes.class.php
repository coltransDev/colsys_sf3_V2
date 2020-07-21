<?php

/*
* Constantes predefinidas en el programa
sobre valor a asegurar
*/

class Constantes{
	
    const COLTRANS = "Coltrans";
    const COLMAS = "Colmas";
    const COLOTM = "COL OTM";
    const TPLOGISTICS = "TPLogistics";
    const COLDEPOSITOS = "Coldep�sitos";
    const COLDEPOSITOS_BN = "Coldep�sitos Bodega Nacional";
    const COLTRANS_RAZONSOCIAL = "Coltrans S.A.";
    const COLMAS_RAZONSOCIAL = "Colmas Agente de Aduana Ltda.";
    const COLOTM_RAZONSOCIAL = "Colotm";
    const COLDEPOSITOS_RAZONSOCIAL = "Coldep�sitos S.A.S";
    const COLDEPOSITOS_BN_RAZONSOCIAL = "Coldep�sitos Bodega Nacional S.A.S";
	
    const IMPO = "Importaci�n";
    const EXPO = "Exportaci�n";
    const TRIANGULACION = "Triangulaci�n";
    const OTMDTA = "OTM-DTA";
    const OTMDTA1 = "OTM/DTA";
    const OTMAIR = "OTM A�reo";
    const NACIONALIZACION = "Nacionalizaci�n";
    const INTERNO = "INTERNO";
	
    const AEREO = "A�reo";
    const MARITIMO = "Mar�timo";
    const TERRESTRE = "Terrestre";
    const ADUANA = "Aduana";
    const ADUANAS = "Aduanas";
    const DEPOSITO = "Dep�sito";
    const DEPOSITOS = "Dep�sitos";

    const FCL = "FCL";
    const LCL = "LCL";
    const COLOADING = "COLOADING";
    const ADUANAFCL = "ADUANA-FCL";
    const ADUANALCL = "ADUANA-LCL";
    const COURIER = "COURIER";
    const CONSOLIDADO = "Consolidado";
    const CONTINUACION = "CONTINUACION";

    const FLETE = "Flete";
    const RECARGO_LOCAL = "Recargo Local";
    const RECARGO_EN_ORIGEN = "Recargo en Origen";
    const RECARGO_OTM_DTA = "Recargo OTM-DTA";
    const COSTO = "Costo";

    const BOGOTA = "Bogot� D.C.";
    const MEDELLIN = "Medell�n";

    const CARGA_AEREA = "Carga A�rea";
    const MARITIMA_LCL = "Carga Mar�tima LCL";
    const MARITIMA_FCL = "Carga Mar�tima FCL";

    const IDCOLMAS = 1;
    const IDCOLTRANS = 2;
    const IDCOLTRANSUSA = 3;
    const IDCONSOLCARGO = 4;
    const IDFONEMCOL = 5;
    const IDHBINGENIERIA = 6;
    const IDTPLOGISTICS = 7;
    const IDCOLOTM = 8;
    const IDTOMS = 9;
    const IDDATECSA = 10;
    const IDCOLDEPLOG = 11;
    const IDCOLDEPBN = 12;
    
    private static $grupocoltrans = [self::IDCOLMAS, self::IDCOLTRANS, self::IDCOLTRANSUSA, self::IDFONEMCOL, self::IDHBINGENIERIA, self::IDCOLOTM, self::IDCOLDEPLOG, self::IDCOLDEPBN];
    
    public static function getGrupoColtrans() {
        return self::$grupocoltrans;
    }
    
    private static $tipocotizacion = ["velocidad"=>"La m�s r�pida que se obtenga", "calidad"=>"Tarifa analizada por Pricing (despu�s de recibir por lo menos dos opciones de naviera y/o coloader)"];
    
    public static function getTipoCotPricing($tipo) {
        return self::$tipocotizacion[$tipo];
    }
}
?>