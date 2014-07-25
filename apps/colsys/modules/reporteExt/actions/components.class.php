<?php

/**
 * reporteExt components.
 *
 * @package    colsys
 * @subpackage pricing
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class reporteExtComponents extends sfComponents
{	
	/*
	* Muestra la presentación del reporte marítimo al exterior
	* @author: Andres Botero 
	*/	
    public function executeReporteMaritimoExtNew(){

        $reporte = $this->reporte;

        $idtrafico = $this->getUser()->getIdtrafico();
        

		$this->tarifas = Doctrine::getTable("RepTarifa")
                                   ->createQuery("t")
                                   ->innerJoin("t.Concepto c")
                                   ->addWhere("t.ca_idreporte = ? ", $reporte->getCaIdreporte())
                                   ->addWhere("c.ca_modalidad != ? ", "OTM-DTA")
                                   ->execute();


        $this->gastos = Doctrine::getTable("RepGasto")
                                   ->createQuery("g")
                                   ->innerJoin("g.TipoRecargo t") 
                                   ->addWhere("g.ca_idreporte = ? ", $reporte->getCaIdreporte())                                   
                                   ->execute();


        if( $reporte->getCaIdmaster()){
            $consignatario = Doctrine::getTable("Tercero")->find( $reporte->getCaIdmaster() );
            $consignatario_m1 = $consignatario->getCaNombre()."<br />".$consignatario->getCaContacto()."<br />Dirección: ".$consignatario->getCaDireccion()."<br />Teléfonos:".$consignatario->getCaTelefonos()." Fax:".$consignatario->getCaFax()."<br />Email: ".$consignatario->getCaEmail();
        }else {

            if($reporte->getCaImpoexpo()!=constantes::TRIANGULACION){
                $idempresa=sfConfig::get('app_branding_idempresa');                
                $consignatario = Doctrine::getTable("Cliente")->find( $idempresa );
                
                if( $consignatario->getIds()->getCaTipoidentificacion()!=3 ){
                    $id = $consignatario->getIds()->getIdsTipoIdentificacion()->getCaNombre()." ".number_format($consignatario->getCaIdalterno(),0).($consignatario->getCaDigito()?"-".$consignatario->getCaDigito():"");
                    
                }else{
                    $id = "";
                }
                $consignatario_m1 = $consignatario->getCaCompania().$id."<br />Dirección: ".$consignatario->getDireccion()."<br />Teléfonos:".$consignatario->getCaTelefonos()." Fax:".$consignatario->getCaFax()."<br />".$consignatario->getCiudad()->getCaCiudad()." ".$consignatario->getCiudad()->getTrafico()->getCaNombre();

                if($reporte->getCaIdconsignarmaster() && $reporte->getCaIdconsignarmaster()>4)
                {
                     $consignatario1 = Doctrine::getTable("Tercero")->find($reporte->getCaIdconsignarmaster());
                    if(!$consignatario1){
                        $consignatario1=new Tercero();
                    }                    
                    $consignatario_m = $consignatario1->getCaNombre()." Nit. ".$consignatario1->getCaIdentificacion()."<br />Dirección: ".$consignatario1->getCaDireccion()."<br />Teléfonos:".$consignatario1->getCaTelefonos()." Fax:".$consignatario1->getCaFax()."<br />".$consignatario1->getCiudad()->getCaCiudad()." ".$consignatario1->getCiudad()->getTrafico()->getCaNombre();
                }
                else{
                    $consignatario_m=$consignatario_m1;
                }
            }else{
                
                if($reporte->getCaIdconsignarmaster() && $reporte->getCaIdconsignarmaster()>4)
                {
                     $consignatario1 = Doctrine::getTable("Tercero")->find($reporte->getCaIdconsignarmaster());
                    if(!$consignatario1){
                        $consignatario1=new Tercero();
                    }
                    echo $consignatario1->getCaIdentificacion();
                    $consignatario_m = $consignatario1->getCaNombre()." Nit. ".$consignatario1->getCaIdentificacion()."<br />Dirección: ".$consignatario1->getCaDireccion()."<br />Teléfonos:".$consignatario1->getCaTelefonos()." Fax:".$consignatario1->getCaFax()."<br />".$consignatario1->getCiudad()->getCaCiudad()." ".$consignatario1->getCiudad()->getTrafico()->getCaNombre();
                }
                else{
                    $consignatario_m="";
                }
            }
        }
        //echo $reporte->getCaIdconsignatario();
        if( $reporte->getCaIdconsignatario()){

            $consignatario = Doctrine::getTable("Tercero")->find( $reporte->getCaIdconsignatario() );
            $consignatario_final = $consignatario->getCaNombre()." Nit. ".$consignatario->getCaIdentificacion();
            if($reporte->getCaContinuacion()!="OTM")
            {
                if( $reporte->getCaMciaPeligrosa() || $reporte->getCaImpoexpo()==constantes::TRIANGULACION ){
                    $consignatario_final .= "<br />Contacto: ".$consignatario->getCaContacto();
                }
                
                if(strlen ( $consignatario->getCaDireccion() )>5 )
                {
                    $city="";
                    if($consignatario->getCiudad()!="999-9999")
                        $city=$consignatario->getCiudad()->getCaCiudad()." ".$consignatario->getCiudad()->getTrafico()->getCaNombre();
 
                    $consignatario_final .= "<br />Dirección: ".$consignatario->getCaDireccion()." ".$city;
                }
                if( $reporte->getCaMciaPeligrosa() || $reporte->getCaImpoexpo()==constantes::TRIANGULACION  ){
                    $consignatario_final .= "<br />Teléfonos:".$consignatario->getCaTelefonos()." Fax:".$consignatario->getCaFax()."<br />Email: ".$consignatario->getCaEmail();
                }
            }
            
            
        }else{
            $contacto = $reporte->getContacto();
            $cliente = $reporte->getContacto()->getCliente();

            $consignatario_final = $cliente->getCaCompania().($idtrafico!="PE-051"?" Nit. ".$cliente->getCaIdalterno()."-".$cliente->getCaDigito():"");
            
            if($reporte->getCaContinuacion()!="OTM")
            {
                if( $reporte->getCaMciaPeligrosa() ){
                    $consignatario_final .= "<br />Contacto: ".$contacto->getCaNombres()." ".$contacto->getCaPapellido()." ".$contacto->getCaSapellido();
                }
                $consignatario_final .="<br />Dirección: ".$cliente->getDireccion()." ".$cliente->getCiudad()->getCaCiudad()." ".$cliente->getCiudad()->getTrafico()->getCaNombre();
                if( $reporte->getCaMciaPeligrosa() ){
                    $consignatario_final .="<br />Teléfonos:".$contacto->getCaTelefonos()." Fax:".$contacto->getCaFax()."<br /> Email:".$contacto->getCaEmail();
                }
            }
        }
        
        $bodega1 = $reporte->getBodegaConsignar();
        $bodega2 = Doctrine::getTable("Bodega")->find( $reporte->getCaIdbodega() );
        
        if( $reporte->getCaIdconsignar()==1 ){
            $hijo = $consignatario_final;
        }else{



            $hijo = $bodega1->getCaNombre()." ".$bodega1->getCaDireccion();
        }
        
        if( $bodega2 && ($bodega2->getCaTipo()!= "Coordinador Logistico" && $bodega2->getCaTipo()!="Coordinador Logístico" && $bodega2->getCaTipo()!="Cliente/Consignatario" && $bodega2->getCaTipo()!="-")  )
        {
            if($bodega2->getCaTipo()==$bodega2->getCaNombre() || $bodega2->getCaTipo()=="Entrega Urgente")
                $hijo .=" / ".$bodega2->getCaTipo();
            else if($reporte->getCaContinuacion()!="N/A")
                $hijo .=" / ".(($bodega2->getCaNombre()!='N/A')?$bodega2->getCaNombre()." ".$bodega2->getCaDireccion():"")." ".$bodega2->getCaTipo().(($reporte->getCaContinuacion()!="N/A")? " / ".$reporte->getDestinoCont()->getCaCiudad()." - ".$reporte->getDestinoCont()->getTrafico()->getCaNombre():"");
            else
                $hijo .=" / ".$bodega2->getCaTipo()." ".(($bodega2->getCaNombre()!='N/A')?$bodega2->getCaNombre()." ".$bodega2->getCaDireccion():"");
        }
        
        /*
         * Notify
         */
        if( $idtrafico=="PE-05125" ){
            $idempresa=sfConfig::get('app_branding_idempresa');
            $cliente = Doctrine::getTable("Cliente")->find( $idempresa );

            $notify_h = $cliente->getCaCompania()."<br />".$cliente->getDireccion()." ".$cliente->getCiudad()->getCaCiudad()." ".$cliente->getCiudad()->getTrafico()->getCaNombre()."<br />TLF:".$contacto->getCaTelefonos();

        }else{
            if( !$reporte->getCaNotify() ){
                $contacto = $reporte->getContacto();
                $cliente = $reporte->getContacto()->getCliente();

                $notify_h = $cliente->getCaCompania()." Nit. ".number_format($cliente->getCaIdalterno(),0)."-".$cliente->getCaDigito()."<br />Contacto: ".$contacto->getCaNombres()." ".$contacto->getCaPapellido()." ".$contacto->getCaSapellido()."<br />Dirección: ".$cliente->getDireccion()." ".$cliente->getCiudad()->getCaCiudad()."<br />Teléfonos:".$contacto->getCaTelefonos()." Fax:".$contacto->getCaFax()."<br /> Email:".$contacto->getCaEmail()."<br />".$cliente->getCiudad()->getTrafico()->getcaNombre();
            }else{

                if( $reporte->getCaNotify()==1 ) {
                    $notify = Doctrine::getTable("Tercero")->find( $reporte->getCaIdconsignatario() );
                }elseif(  $reporte->getCaNotify()==2 ){
                    $notify = Doctrine::getTable("Tercero")->find( $reporte->getCaIdnotify() );
                }elseif(  $reporte->getCaNotify()==3 ){
                    $notify = Doctrine::getTable("Tercero")->find( $reporte->getCaIdmaster() );
                }

                if( $notify ){
                    $notify_h = $notify->getCaNombre()." Nit. ".$notify->getCaIdentificacion()."<br />Contacto: ".$notify->getCaContacto()."<br />Dirección: ".$notify->getCaDireccion()."<br />Teléfonos:".$notify->getCaTelefonos()." Fax:".$notify->getCaFax()."<br />Email: ".$notify->getCaEmail();
                }else{
                    $notify_h = "";
                }
            }
        }
        
        if ( $reporte->getCaMastersame() == 'Sí' ){
            $master = $hijo;
        }else{
            if(!$reporte->getCaIdconsignarmaster() || $reporte->getCaIdconsignarmaster()>4 )
            {
                if($reporte->getCaImpoexpo()==constantes::IMPO)
                    $master = $consignatario_m1;
                else
                    $master = $consignatario_m;
            }
            else
                $master = $consignatario_m;
        }
        
        if($reporte->getCaContinuacion()=="OTM"){
            $hijo .= " / Carga en OTM";
        }

        $this->reporte = $reporte;
        $this->master = $master;
        $this->hijo = $hijo;
        $this->notify_h = $notify_h;
        $this->consignatario_m = $consignatario_m;
	}
	
	
	/*
	* Muestra la presentación del reporte aéreo al exterior
	* @author: Andres Botero 
	*/	
    public function executeReporteAereoExtNew(){

        $reporte = $this->reporte;

        $idtrafico = $this->getUser()->getIdtrafico();

		$this->tarifas = Doctrine::getTable("RepTarifa")
                                   ->createQuery("t")
                                   ->where("t.ca_idreporte = ? ", $reporte->getCaIdreporte())
                                   ->execute();
        if($reporte->getCaImpoexpo()==Constantes::EXPO)
        {         
            $this->gastos = Doctrine::getTable("RepGasto")
                                   ->createQuery("g")
                                   ->innerJoin("g.TipoRecargo t") 
                                   ->addWhere("g.ca_idreporte = ? ", $reporte->getCaIdreporte())                                   
                                   ->execute();
        }
//echo $reporte->getCaImpoexpo();
        if( $reporte->getCaIdmaster()){
            $consignatario = Doctrine::getTable("Tercero")->find( $reporte->getCaIdmaster() );
            $master = $consignatario->getCaNombre()."<br />".$consignatario->getCaContacto()."<br />".$consignatario->getCaDireccion()."<br />Teléfonos:".$consignatario->getCaTelefonos()." Fax:".$consignatario->getCaFax()."<br />Email: ".$consignatario->getCaEmail();
        }else {
            if($reporte->getCaImpoexpo()!=constantes::TRIANGULACION)
            {
                $idempresa=sfConfig::get('app_branding_idempresa2')?sfConfig::get('app_branding_idempresa2'):sfConfig::get('app_branding_idempresa');
                $consignatario = Doctrine::getTable("Cliente")->find( $idempresa );
                $master = $consignatario->getCaCompania().($idtrafico=="CO-057"?" Nit. ".number_format($consignatario->getCaIdalterno(),0)."-".$consignatario->getCaDigito():"")."<br />";
                
            }
            else
            {
                //echo "ss".$reporte->getCaIdconsignarmaster();
                
                if($reporte->getCaIdconsignarmaster() && $reporte->getCaIdconsignarmaster()>3)
                {
                    $consignatario1 = Doctrine::getTable("Tercero")->find($reporte->getCaIdconsignarmaster());
                    if(!$consignatario1)
                        $consignatario1=new Tercero();
                    $master = $consignatario1->getCaNombre()." Nit. ".number_format($consignatario1->getCaIdentificacion(),0)."<br />Dirección: ".$consignatario1->getCaDireccion()."<br />Teléfonos:".$consignatario1->getCaTelefonos()." Fax:".$consignatario1->getCaFax()."<br />".$consignatario1->getCiudad()->getCaCiudad()." ".$consignatario1->getCiudad()->getTrafico()->getCaNombre();
                }
                else
                    $master="";
            }
            
            if($master!="")
            {
                
                $sucursal = Doctrine::getTable("IdsSucursal")
                                      ->createQuery("s")
                                      ->where("s.ca_idciudad = ?", $reporte->getCaDestino() )
                                      ->addWhere("s.ca_id = ?", $idempresa )        
                                      ->fetchOne();
                
                if( !$sucursal ){
                    
                   $sucursal = Doctrine::getTable("IdsSucursal")
                                      ->createQuery("s")
                                      ->where("s.ca_principal = ?", true )
                                      ->where("s.ca_id = ?", $idempresa )
                                      ->fetchOne();
                }
                
                if( $sucursal ){
                    $master.=$sucursal->getCaDireccion()."<br />Teléfonos:".$sucursal->getCaTelefonos();
                    if( $sucursal->getCaFax() ){
                        $master.= " Fax:".$sucursal->getCaFax();
                    }
                    $master.="<br />";
                }
                $master.=$reporte->getDestino()->getCaCiudad()." - ".$reporte->getDestino()->getTrafico()->getCaNombre();
            }
        }
        
        if( $reporte->getCaIdconsignatario() ){
            $consignatario = Doctrine::getTable("Tercero")->find( $reporte->getCaIdconsignatario() );
            if($reporte->getCaImpoexpo()==constantes::TRIANGULACION)
            {
                $consignatario_final = $consignatario->getCaNombre()." Nit. ".($consignatario->getCaIdentificacion())."<br />Dirección: ".$consignatario->getCaDireccion()."<br />Teléfonos:".$consignatario->getCaTelefonos()." Fax:".$consignatario->getCaFax()."<br />".$consignatario->getCiudad()->getCaCiudad()." ".$consignatario->getCiudad()->getTrafico()->getCaNombre();
            }
            else
            {
                $consignatario_final = $consignatario->getCaNombre()." Nit. ".$consignatario->getCaIdentificacion()."<br />".$consignatario->getCaDireccion();
            }
        }else{
            $contacto = $reporte->getContacto();
            $cliente = $reporte->getContacto()->getCliente();

            $consignatario_final = $cliente->getCaCompania()." Nit. ".number_format($cliente->getCaIdalterno(),0)."-".$cliente->getCaDigito()."<br />".$cliente->getDireccion();
        }
        
        $bodega1 = $reporte->getBodegaConsignar();
        $bodega2 = Doctrine::getTable("Bodega")->find( $reporte->getCaIdbodega() );

        
        if( $reporte->getCaIdconsignar()==1 ){
            $hijo = $consignatario_final;
        }else{
            $hijo = $bodegaConsignar->getCaNombre()." ".$bodegaConsignar->getCaDireccion();
        }
        
        if($reporte->getProperty("entrega_lugar_arribo")=="true" || $reporte->getProperty("entrega_lugar_arribo")=="1")
        {
            $hijo.=" / Entrega en Lugar de Arribo ";
        }
        
        if($bodega2 && $reporte->getCaImpoexpo()!=Constantes::TRIANGULACION && $bodega2->getCaIdbodega()!="1")
        {

            if($bodega2->getCaTipo()==$bodega2->getCaNombre())
                $hijo.=" / ".$bodega2->getCaNombre()." ".$bodega2->getCaDireccion();
            else
            {
                $hijo.=" / ".$bodega2->getCaTipo()." ".(($bodega2->getCaNombre()!='N/A')?$bodega2->getCaNombre()." ".$bodega2->getCaDireccion():"");
                if( $reporte->getCaContinuacion()== 'N/A' ){
                    $hijo.="<br />".$reporte->getDestino()->getCaCiudad();
                }
                $hijo.="<br />".$reporte->getDestino()->getTrafico()->getCaNombre();
            }
        }
        //.(($rs->Value('ca_continuacion') == 'N/A')?"<br />".$rs->Value('ca_ciudestino'):"")."<br />".$tm->Value('ca_pais');


        if( !$reporte->getCaNotify() ){
            $contacto = $reporte->getContacto();
            $cliente = $reporte->getContacto()->getCliente();

            $consignatario_h = $cliente->getCaCompania()."<br /><br />".$cliente->getDireccion()."<br />".$cliente->getCiudad()->getTrafico()->getCaNombre();
        }else{
            if( $reporte->getCaNotify()==1 ) {
                $notify = Doctrine::getTable("Tercero")->find( $reporte->getCaIdconsignatario() );

            }elseif(  $reporte->getCaNotify()==2 ){
                $notify = Doctrine::getTable("Tercero")->find( $reporte->getCaIdnotify() );
            }

            if($notify){
                $consignatario_h = $notify->getCaNombre()."<br />".$notify->getCaDireccion();
            }else{
                $consignatario_h = "";
            }


        }
        
        
        if( $idtrafico=="PE-051" ){
            
            $idempresa=sfConfig::get('app_branding_idempresa');
            $cliente = Doctrine::getTable("Cliente")->find( $idempresa );
            

            $notify_m = $cliente->getCaCompania()."<br />".$cliente->getDireccion()."<br />TLF ".$cliente->getCaTelefonos()."<br />".$cliente->getCiudad()->getCaCiudad()." ".$cliente->getCiudad()->getTrafico()->getCaNombre();
        }
        

        if ( $reporte->getCaMastersame() == 'Sí' ){
            $master = $hijo;
        }

        $this->reporte = $reporte;

        $this->master = $master;
        $this->hijo = $hijo;
        @$this->notify_m = $notify_m;
        @$this->notify_h = $notify_h;
        $this->consignatario_h = $consignatario_h;
        $this->idtrafico = $idtrafico;
	}
}
?>
