<?

class ArticuloForm extends BaseForm {

    public function configure() {

        sfValidatorBase::setCharset('ISO-8859-1');
        
        $this->user = sfContext::getInstance()->getUser();
        
        $usuario = Doctrine::getTable("Usuario")->find($this->user->getUserId());
        $grupoEmp = $usuario->getGrupoEmpresarial();
        $sucursales = Doctrine_Query::create()
                             ->from("Sucursal s")
                             ->leftJoin("s.Empresa e")
                             ->whereIn("s.ca_idempresa", $grupoEmp)
                             ->orderBy("s.ca_nombre")
                             ->execute();
        $suc = array();
        
        $suc[null] = "Todas las sucursales";
        
        foreach($sucursales as $sucursal){
            if(!in_array($sucursal->getCaNombre(), $suc) && $sucursal->getCaIdsucursal()!='999')
                $suc[$sucursal->getCaIdsucursal()] = $sucursal->getCaNombre();
        }

        $this->setWidgets(array(
            'idarticulo' => new sfWidgetFormInputHidden(),
            'titulo' => new sfWidgetFormInputText(array(), array("maxlength" => "255", "size" => "60")),
            'descripcion' => new sfWidgetFormTextarea(array(), array("rows" => 20, "cols" => 80)),
            'idsucursal' => new sfWidgetFormChoice(array(
                    'choices' => $suc)
                ),
            'formapago' => new sfWidgetFormTextarea(array(), array("rows" => 3, "cols" => 80)),
            'fchinicio' => new sfWidgetFormExtDate(),
            'fchvencimiento' => new sfWidgetFormExtDate(),
            'horainicio' => new sfWidgetFormTime(),
            'horavencimiento' => new sfWidgetFormTime(),
            'valor' => new sfWidgetFormInputText(array(), array("maxlength" => "15", "size" => "20")),
            'tope' => new sfWidgetFormInputText(array(), array("maxlength" => "15", "size" => "20")),
            'directa' => new sfWidgetFormChoice(array(
                'choices' => array('1' => 'Compra Directa', '0' => 'Subasta Normal')
                    ), array("onchange" => "verificarDirecta()")
            ),
            'incremento' => new sfWidgetFormInputText(array(), array("maxlength" => "15", "size" => "20"))
        ));

        $this->setValidators(array(
            'idarticulo' => new sfValidatorDoctrineChoice(array('model' => 'SubArticulo', 'column' => 'ca_idarticulo', 'required' => false)),
            'titulo' => new sfValidatorString(array('required' => true, "max_length" => "255")),
            'descripcion' => new sfValidatorString(array('required' => true)),
            'idsucursal' => new sfValidatorString(array('required' => false)),
            'formapago' => new sfValidatorString(array('required' => true)),
            'valor' => new sfValidatorNumber(array('required' => true, 'min' => 1)),
            'directa' => new sfValidatorBoolean(array('required' => true)),
            'incremento' => new sfValidatorNumber(array('required' => false, 'min' => 1)),
            'tope' => new sfValidatorNumber(array('required' => false, 'min' => 1)),
            //'direccion'   => new sfValidatorString(array('required' => true)),
            'fchinicio' => new sfValidatorDate(array('required' => true), array('required' => 'Por favor coloque la fecha de inicio')),
            'horainicio' => new sfValidatorTime(array('required' => true), array('required' => 'Por favor coloque la hora de inicio')),
            'fchvencimiento' => new sfValidatorDate(array('required' => true), array('required' => 'Por favor coloque la fecha de vencimiento')),
            'horavencimiento' => new sfValidatorTime(array('required' => true), array('required' => 'Por favor coloque la hora de vencimiento')),
        ));
    }

    public function bind(array $taintedValues = null, array $taintedFiles = null) {



        if (!$taintedValues["directa"]) {
            $this->validatorSchema['incremento']->setOption('required', true);
            $this->validatorSchema['tope']->setOption('required', true);
            $this->validatorSchema->setPostValidator(
                    new sfValidatorSchemaCompare('valor', sfValidatorSchemaCompare::LESS_THAN_EQUAL, 'tope', array(), array('invalid' => 'El tope ("%right_field%") debe ser mayor que el valor ("%left_field%")')
                    )
            );
        }

        parent::bind($taintedValues, $taintedFiles);
    }

}

?>