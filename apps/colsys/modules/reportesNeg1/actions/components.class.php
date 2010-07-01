<?php

/**
 * clientes components.
 *
 * @package    colsys
 * @subpackage reportes
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class reportesNegComponents extends sfComponents
{


    public function executeMainPanel()
	{


	}

    public function load_category()
    {
        $this->modo=$this->getRequestParameter("modo");
        if($this->modo=="Aéreo")
            $this->idcategory="22";
        else if($this->modo=="Marítimo")
            $this->idcategory="23";
    }
    
	/*
	* Muestra los conceptos del reporte y un formulario para agregar un nuevo registro, tambien 
	* permite editar un campo haciendo doble click en el.
	* @author: Andres Botero
	*/
	public function executePanelConceptosFletes()
	{
		
		$this->conceptos = Doctrine::getTable("Concepto")
                                     ->createQuery("c")
                                     ->select("ca_idconcepto, ca_concepto")
                                     ->where("c.ca_transporte = ?", $this->reporte->getCaTransporte() )
                                     ->addWhere("c.ca_modalidad = ?", $this->reporte->getCaModalidad() )
                                     ->addOrderBy("c.ca_liminferior")
                                     ->addOrderBy("c.ca_concepto")
                                     ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                                     ->execute();
         
        foreach( $this->conceptos as $key=>$val){
            $this->conceptos[$key]['ca_concepto'] = utf8_encode($this->conceptos[$key]['ca_concepto']);
             
        }

        array_push( $this->conceptos , array("ca_idconcepto"=>"9999", "ca_concepto"=>"Recargo general del trayecto"));

        $impoexpo = $this->reporte->getCaImpoexpo();
        if( $impoexpo==Constantes::TRIANGULACION ){
            $impoexpo=Constantes::IMPO;
        }

        $this->recargos = Doctrine::getTable("TipoRecargo")
                                     ->createQuery("c")
                                     ->select("ca_idrecargo as ca_idconcepto, ca_recargo as ca_concepto")
                                     ->addWhere("c.ca_tipo like ? ", "%".Constantes::RECARGO_EN_ORIGEN."%" )
                                     /*->addWhere("c.ca_impoexpo LIKE ? ", $impoexpo )
                                     ->addWhere("c.ca_transporte LIKE ? ", $this->reporte->getCaTransporte() )*/
                                     ->addOrderBy("c.ca_recargo")
                                     ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                                     ->execute();

         foreach( $this->recargos as $key=>$val){
             $this->recargos[$key]['ca_concepto'] = utf8_encode($this->recargos[$key]['ca_concepto']);

         }
	}


    /*
	* Muestra los conceptos del reporte y un formulario para agregar un nuevo registro, tambien
	* permite editar un campo haciendo doble click en el.
	* @author: Andres Botero
	*/
	public function executePanelRecargos()
	{

        $impoexpo = $this->reporte->getCaImpoexpo();
        if( $impoexpo==Constantes::TRIANGULACION ){
            $impoexpo=Constantes::IMPO;
        }
        $this->recargos = Doctrine::getTable("TipoRecargo")
                                     ->createQuery("c")
                                     ->select("ca_idrecargo as ca_idconcepto, ca_recargo as ca_concepto")
                                     ->addWhere("c.ca_tipo like ? ", "%".Constantes::RECARGO_LOCAL."%" )
                                     /*->addWhere("c.ca_impoexpo LIKE ? ", $impoexpo )
                                     ->addWhere("c.ca_transporte LIKE ? ", $this->reporte->getCaTransporte() )*/
                                     ->addOrderBy("c.ca_recargo")
                                     ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                                     ->execute();

         foreach( $this->recargos as $key=>$val){
             $this->recargos[$key]['ca_concepto'] = utf8_encode($this->recargos[$key]['ca_concepto']);

         }
	}


    /*
	* Muestra los conceptos del reporte y un formulario para agregar un nuevo registro, tambien
	* permite editar un campo haciendo doble click en el.
	* @author: Andres Botero
	*/
	public function executePanelRecargosAduana()
	{
        $this->recargos = Doctrine::getTable("Costo")
                                     ->createQuery("c")
                                     ->select("ca_idcosto as ca_idconcepto, ca_costo as ca_concepto")
                                     //->addWhere("c.ca_tipo = ? ", Constantes::RECARGO_LOCAL )
                                     ->addWhere("c.ca_impoexpo = ? ", "Aduanas")
                                     ->addWhere("c.ca_transporte LIKE ? ", $this->reporte->getCaTransporte() )
                                     ->addOrderBy("c.ca_costo")
                                     ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                                     ->execute();

         foreach( $this->recargos as $key=>$val){
             $this->recargos[$key]['ca_concepto'] = utf8_encode($this->recargos[$key]['ca_concepto']);

         }
	}

    /*
	* Vista previa de un tercero
	* @author: Andres Botero
	*/
	public function executePreviewTercero()
	{
        $this->tercero = Doctrine::getTable("Tercero")->find($this->idtercero);
    }


    /*
	* Panel principal que contiene los demas paneles
	* @author: Mauricio Quinche
	*/
	public function executeFormReportePanel()
	{
//        echo "categoria:".$this->getRequestParameter("idcategory")."<br>";        
        $this->load_category();
        
        $this->issues = Doctrine::getTable("KBTooltip")
                            ->createQuery("t")
                            ->select("t.ca_idcategory, t.ca_title, t.ca_info, t.ca_field_id")
                            ->where("t.ca_idcategory = ?", $this->idcategory)
                            ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                            ->execute();
    }
    /*
	* Edita la informacion basica del trayecto
	* @author: Andres Botero
	*/
	public function executeFormClientePanel()
	{
        $this->incotermsVals = Doctrine::getTable("Parametro")
                                     ->createQuery("p")
                                     ->where("ca_casouso = ?", "CU021")
                                     ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                                     ->execute();
    }

    public function executeFormAduanasPanel()
	{
        $this->usuarios = Doctrine::getTable("Usuario")
                                   ->createQuery("u")
                                   ->innerJoin("u.UsuarioPerfil up")
                                   ->where("u.ca_activo=? AND up.ca_perfil=? ", array('TRUE','analista-de-aduana'))
                                   ->addOrderBy("u.ca_idsucursal")
                                   ->addOrderBy("u.ca_nombre")
                                   ->execute();
    }

    public function executeFormSegurosPanel()
	{

        $this->monedas = Doctrine::getTable("Moneda")
                   ->createQuery("m")
                   ->orderBy("m.ca_idmoneda")
                   ->execute();
    }
    /*
	* Edita la informacion basica del trayecto
	* @author: Andres Botero
	*/
	public function executeFormTrayectoPanel()
	{
        $this->load_category();
        if($this->modo=="Aéreo")
            $this->nomLinea="Aerolinea";
        else if($this->modo=="Marítimo")
            $this->nomLinea="Naviera";
        else
            $this->nomLinea="Linea";
    }

    /*
	* Edita la informacion basica del cliente
	* @author: Andres Botero
	*/
	public function executeFormPreferenciasPanel()
	{

    }

    /*
	* Edita la informacion aduana
	* @author: Andres Botero
	*/
	public function executeFormAduana()
	{
        $this->repaduana = Doctrine::getTable("RepAduana")->find( $this->reporte->getCaIdreporte());
        if( !$this->repaduana ){
            $this->repaduana = new RepAduana();
        }





        //print_r( $this->repaduana );
        //exit();

    }

    /*
	* Edita la informacion seguro
	* @author: Andres Botero
	*/
	public function executeFormSeguros()
	{
        $this->usuarios = UsuarioTable::getUsuariosSeguros();

        $this->repseguro = Doctrine::getTable("RepSeguro")->find( $this->reporte->getCaIdreporte());
        if( !$this->repseguro ){
            $this->repseguro = new RepSeguro();
        }
    }

    /*
	* Instrucciones para el corte de la guia
	* @author: Andres Botero
	*/
	public function executeFormCorteGuiasPanel()
	{

		
    }


    /*
	* Continuacion de viaje (OTM, DTA, CABOTAJE)
	* @author: Andres Botero
	*/
	public function executeFormContinuacion()
	{
        
    }

    /*
	* Formulario de exportaciones
	* @author: Andres Botero
	*/
	public function executeFormExportaciones()
	{
        $this->repexpo = Doctrine::getTable("RepExpo")->find( $this->reporte->getCaIdreporte());
        if( !$this->repexpo ){
            $this->repexpo = new RepExpo();
        }

    }
    
    public function executeInfoReporte()
	{
        
    }


    public function executeConsultaTrayecto(){
        
    }

    public function executeConsultaExportaciones(){

        $this->repexpo = Doctrine::getTable("RepExpo")->find( $this->reporte->getCaIdreporte());
        if( !$this->repexpo ){
            $this->repexpo = new RepExpo();
        }
        
        //$this->tiposexpo = ParametroTable::retrieveByCaso( "CU011" );
    }


    /*
	* Consulta la informacion aduana
	* @author: Andres Botero
	*/
	public function executeConsultaAduana()
	{
        $this->repaduana = Doctrine::getTable("RepAduana")->find( $this->reporte->getCaIdreporte());
        if( !$this->repaduana ){
            $this->repaduana = new RepAduana();
        }


    }

    /*
	* Consulta la informacion seguro
	* @author: Andres Botero
	*/
	public function executeConsultaSeguros()
	{
        $this->repseguro = Doctrine::getTable("RepSeguro")->find( $this->reporte->getCaIdreporte());
        if( !$this->repseguro ){
            $this->repseguro = new RepSeguro();
        }
    }


    /*
	* Instrucciones para el corte de la guia
	* @author: Andres Botero
	*/
	public function executeConsultaCorteGuias()
	{


    }

    /*
     *
     */
    public function executeCotizacionWindow()
	{
        if( $this->reporte->getCaIdproducto() ){
            $this->producto = Doctrine::getTable("CotProducto")->find( $this->reporte->getCaIdproducto() );
            $this->cotizacion = $this->producto->getCotizacion();             
        }else{
            $this->producto = null;
            $this->cotizacion = null;
           
        }
	}

    /*
     *
     */
    public function executeCotizacionRecargosWindow()
	{
        $this->aplicaciones = ParametroTable::retrieveByCaso("CU082");        
        if( $this->reporte->getCaIdproducto() ){
            $this->producto = Doctrine::getTable("CotProducto")->find( $this->reporte->getCaIdproducto() );
            $this->cotizacion = $this->producto->getCotizacion();
        }else{
            $this->producto = null;
            $this->cotizacion = null;

        }
	 }

   public function executeCotizacionRecargosAduanasWindow()
   {
//      echo "numero de cotizacion:".($this->reporte->getCaIdcotizacion());
//      exit;
        if( $this->reporte->getCaIdcotizacion() )
        {
            $this->cotizacion = Doctrine::getTable("Cotizacion")
                                  ->createQuery("c")
                                  ->where("c.ca_consecutivo = ? ", "4682-2010" )
                                  ->fetchOne();
        }else{
          $this->cotizacion = null;
        }
      $this->aplicaciones = ParametroTable::retrieveByCaso("CU082");
/*      if( $this->reporte->getCaIdproducto() ){
          $this->producto = Doctrine::getTable("CotProducto")->find( $this->reporte->getCaIdproducto() );
          $this->cotizacion = $this->producto->getCotizacion();
       }else{
          $this->producto = null;
          $this->cotizacion = null;
      }
*/
   }

   public function executeGridPanelInstruccionesWindow()
   {
        if($this->modo=="Aéreo")
            $this->instrucciones = ParametroTable::retrieveByCaso( "CU039" );
        else
            $this->instrucciones = ParametroTable::retrieveByCaso( "CU024" );
   }

}
?>