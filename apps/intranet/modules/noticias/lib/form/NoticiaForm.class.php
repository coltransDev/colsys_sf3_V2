<?
class NoticiaForm extends BaseForm{
	
	private $folder = "Noticias";
    
	public function configure(){
		
		sfValidatorBase::setCharset('ISO-8859-1');
        
        
        $directory = sfConfig::get('app_digitalFile_root').DIRECTORY_SEPARATOR.$this->folder.DIRECTORY_SEPARATOR."Iconos";         
        $archivos = sfFinder::type('file')->maxDepth(0)->in($directory);
		$choices = array();
        
        foreach ($archivos as $archivo) {
            $ext = strtolower(substr($archivo, -3, 3));
            if ($ext != "jpg" && $ext != "png" && $ext != "gif") {
                continue;
            }                        

            $url = sfContext::getInstance()->getController()->genUrl("gestDocumental/verArchivo?folder=" . base64_encode($this->folder.DIRECTORY_SEPARATOR."Iconos") . "&idarchivo=" . base64_encode(basename($archivo)), false);
            $choices[$url]=basename($archivo);
        }                
        
		$this->setWidgets(array(
		  'idnoticia'    => new sfWidgetFormInputHidden(),		 
		  'title'      => new sfWidgetFormInputText(array(), array("maxlength"=>"255" ,"size"=>"60")),
          'fchpublicacion' => new sfWidgetFormExtDate(),  
          'fcharchivar' => new sfWidgetFormExtDate(),  
          'info' => new sfWidgetFormTextarea(array(), array("rows"=>20, "cols"=>75 ) ),  
          'icon' => new sfWidgetFormChoice(array(
                                                'choices' => $choices)
                                            )
		));
	
		$this->setValidators(array(
		  'idnoticia'    => new sfValidatorDoctrineChoice(array('model' => 'Noticia', 'column' => 'ca_idnoticia', 'required' => false)),		  
		  'title'      => new sfValidatorString(array('required' => true, "max_length"=>"255")),
		  'info'      => new sfValidatorString(array('required' => true)),
          'icon'      => new sfValidatorString(array('required' => true)), 
          
          'fchpublicacion'   => new sfValidatorDate(array('required' => true ), 
                                    array('required' => 'Por favor coloque la fecha de inicio') ),          					 
          'fcharchivar'   => new sfValidatorDate(array('required' => true ), 
                                    array('required' => 'Por favor coloque la fecha de vencimiento') ),
          
         
		  
		));	
        
        $this->validatorSchema->setPostValidator(
          new sfValidatorSchemaCompare('fchpublicacion', sfValidatorSchemaCompare::LESS_THAN_EQUAL, 'fcharchivar',
            array(),
            array('invalid' => 'La fecha de inicio ("%left_field%") debe ser menor que la final ("%right_field%")  ')
          )
        );
																												
				
				
	}	
	
	
	public function bind(array $taintedValues = null, array $taintedFiles = null){		
        
        
        
		parent::bind($taintedValues,  $taintedFiles);
	}


   
	
	
}
?>