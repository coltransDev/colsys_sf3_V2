<?
class CostosINOForm extends BaseForm{
	
    private $referencia = null;
    private $inoHouses = array();
    
	public function configure(){
		
		sfValidatorBase::setCharset('ISO-8859-1');
				
		$widgets = array();		
		$validator = array();	
		$transporte = $this->referencia?$this->referencia->getCaTransporte():"";
        $impoexpo = $this->referencia?$this->referencia->getCaImpoexpo():"";
         if($impoexpo!=Constantes::INTERNO)
        {
            $queryCosto = Doctrine::getTable("InoConcepto")
                        ->createQuery("c")
                        ->innerJoin("c.InoConceptoModalidad cm")
                        ->innerJoin("cm.Modalidad m") 
                        ->addWhere("c.ca_costo = ? ", true)
                        ->addWhere("m.ca_impoexpo = ? ", $impoexpo)
                        ->addWhere("m.ca_transporte = ? ", $transporte)
                        ->addOrderBy("c.ca_concepto");
            
            if( $this->referencia ){
                if($this->referencia->getCaModalidad()=="DIRECTO" && $this->referencia->getCaTransporte()==Constantes::TERRESTRE)
                {   
                    $queryCosto->addWhere("m.ca_modalidad = ? ", "FCL");
                }
                else
                    $queryCosto->addWhere("m.ca_modalidad = ? ", $this->referencia->getCaModalidad());
            }
        }
        else
        {
            $queryCosto = Doctrine::getTable("InoConcepto")
                        ->createQuery("c")
                        ->innerJoin("c.InoConceptoModalidad cm")
                        ->innerJoin("cm.Modalidad m") 
                        //->addWhere("c.ca_costo = ? ", true)
                        ->addWhere("m.ca_impoexpo = ? ", $impoexpo)
                        ->addWhere("m.ca_transporte = ? ", $transporte)
                        ->addOrderBy("c.ca_concepto");
        }
       
       
        $widgets["referencia"] = new sfWidgetFormInputHidden();
        
		$widgets['idcosto'] = new sfWidgetFormDoctrineChoice(array(
															  'model' => 'InoConcepto',
															  'add_empty' => false,
															  'method' => "getCaConcepto",
															  'query' => $queryCosto
															) );
        
        
        
        
		$widgets['idmoneda'] = new sfWidgetFormDoctrineChoice(array(
															  'model' => 'Moneda',
															  'add_empty' => false,
															  'method' => "getCaNombre",
                                                              'order_by' => array("ca_nombre","ASC")
                                                              
															  
															), array( "onchange"=>"calc_neto()" ) );
        
        $widgets["idinocosto"] = new sfWidgetFormInputHidden();
        $widgets["factura_ant"] = new sfWidgetFormInputHidden();
        $widgets["factura"] = new sfWidgetFormInputText(array(), array("size"=>15, "maxlength"=>15 ));
		$widgets["fchfactura"] = new sfWidgetFormExtDate();
        $widgets['tcambio'] = new sfWidgetFormInputText(array(), array("size"=>9, "maxlength"=>9 , "onchange"=>"calc_neto()" ));
        $widgets['tcambio_usd'] = new sfWidgetFormInputText(array(), array("size"=>9, "maxlength"=>9 , "onchange"=>"calc_neto()" ));
        $widgets['neto'] = new sfWidgetFormInputText(array(), array("size"=>15, "maxlength"=>15, "onchange"=>"calc_neto()" ));
        $widgets['venta'] = new sfWidgetFormInputText(array(), array("size"=>15, "maxlength"=>15, "onfocus"=>"calc_utilidad()",  "onchange"=>"calc_utilidad()" ));
        $widgets['idproveedor'] = new sfWidgetFormInputHidden(array(), array("size"=>71, "maxlength"=>50 ));
        $widgets['proveedor'] = new sfWidgetFormIds(array("idproveedor"=>"idproveedor"), array("Autocomplete"=>"off"));
        
		
        foreach( $this->inoHouses as $ic ){
            $widgets["util_".$ic->getCaIdhouse()] = new sfWidgetFormInputText(array(), array("size"=>15, "maxlength"=>15, "onchange"=>"calcular()" ));
            $validator["util_".$ic->getCaIdhouse()] = new sfValidatorNumber(array('required' => true ), 
														array('required' => 'Requerido',
																'invalid' => 'No valido'));
        }
        
        
		$this->setWidgets( $widgets );
		
        $validator['idmaster'] = new sfValidatorString(array('required' => true ), 
														array('required' => 'Requerido',
																'invalid' => 'No valido'));	
        
        $validator['idcosto'] = new sfValidatorNumber(array('required' => true, "min"=>0 ), 
														array('required' => 'Requerido',
																'invalid' => 'No valido'));	
        
        $validator['idmoneda'] = new sfValidatorString(array('required' => true ), 
														array('required' => 'Requerido',
																'invalid' => 'No valido'));	
        
        $validator['idinocosto'] = new sfValidatorNumber(array('required' => false));	
        
        $validator['factura_ant'] = new sfValidatorString(array('required' => false));	
        
        $validator['factura'] = new sfValidatorString(array('required' => true), 
														array('required' => 'Requerido',
																'invalid' => 'No valido'));	
										
		$validator['tcambio'] = new sfValidatorNumber(array('required' => true, "min"=>1, "max"=>99999 ), 
														array('required' => 'Requerido',
																'invalid' => 'No valido'));	
        $validator['tcambio_usd'] = new sfValidatorNumber(array('required' => true, "min"=>0, "max"=>99999 ), 
														array('required' => 'Requerido',
																'invalid' => 'No valido'));
        
        $validator['neto'] = new sfValidatorNumber(array('required' => true  ), 
														array('required' => 'Requerido',
																'invalid' => 'No valido'));
        
        $validator['venta'] = new sfValidatorNumber(array('required' => true  ), 
														array('required' => 'Requerido',
																'invalid' => 'No valido'));
		
		$validator['fchfactura'] = new sfValidatorDate(array('required' => true ), 
														array('required' => 'Por favor coloque en una fecha valida'));	
        
        $validator['idproveedor'] = new sfValidatorNumber(array('required' => true), 
														array('required' => 'Requerido',
																'invalid' => 'No valido'));	
		
		
		$validator['proveedor'] = new sfValidatorString(array('required' => true), 
														array('required' => 'Requerido',
																'invalid' => 'No valido'));																											
		
																
		$this->setValidators( $validator );
        
        
        $this->validatorSchema->setPostValidator(new sfValidatorAnd( array(
                new UnicoCostoValidator(),
                new InoUtilidadesValidator()
            ))
        );		
	}	
	
	
	public function bind(array $taintedValues = null, array $taintedFiles = null){              
		parent::bind($taintedValues,  $taintedFiles);
	}
    
    
    public function setReferencia( $v ){
        $this->referencia = $v;
    }
    
    public function setInoHouses( $v ){
        $this->inoHouses = $v;
    }
    
	
}
?>