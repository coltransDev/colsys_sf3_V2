<?
class NuevoStatusForm extends BaseForm {
    const NUM_CC = 7;
    const NUM_EQUIPOS = 5;

    private $queryIdEtapa = null;
    private $queryUsuario = null;
    private $queryPiezas = null;
    private $queryPeso = null;
    private $queryVolumen = null;
    private $queryJornadas = null;
    private $queryConcepto = null;
    private $destinatarios = array();
    private $contactos = array();
    private $destinatariosFijos = array();
    private $widgetsClientes = array();
    private $idsucursal = null;

    public function configure() {

        sfValidatorBase::setCharset('ISO-8859-1');

        $widgets = array();
        $validator = array();

        $widgets['impoexpo'] = new sfWidgetFormInputHidden();
        $widgets['transporte'] = new sfWidgetFormInputHidden();

        $destinatarios = $this->getDestinatarios();
        $destinatariosFijos = $this->getDestinatariosFijos();
        for ($i = 0; $i < count($destinatarios); $i++) {
            $widgets["destinatarios_" . $i] = new sfWidgetFormInputCheckbox(array(), array("size" => 60, "style" => "margin-bottom:3px", "value" => trim($destinatarios[$i])));
        }
        
        $contactos = $this->getContactos();
        for ($i = 0; $i < count($contactos); $i++) {
            $widgets["contactos_" . $i] = new sfWidgetFormInputCheckbox(array(), array("size" => 60, "style" => "margin-bottom:3px", "value" => trim($contactos[$i]["ca_email"])));
        }

        for ($i = 0; $i < count($destinatariosFijos); $i++) {

            $widgets["destinatariosfijos_" . $i] = new sfWidgetFormInputCheckbox(array(), array("size" => 60, "style" => "margin-bottom:3px", "value" => trim($destinatariosFijos[$i]->getCaEmail())));
        }

        for ($i = 0; $i < self::NUM_CC; $i++) {
            $widgets["cc_" . $i] = new sfWidgetFormInputText(array(), array("size" => 60, "style" => "margin-bottom:3px"));
        }
        
        for ($i = 0; $i < self::NUM_CC; $i++) {
            $widgets["cci_" . $i] = new sfWidgetFormInputText(array(), array("size" => 60, "style" => "margin-bottom:3px"));
        }

        $widgets['idetapa'] = new sfWidgetFormDoctrineChoice(array(
                    'model' => 'TrackingEtapa',
                    'add_empty' => false,
                    'method' => "getCaEtapa",
                    'query' => $this->queryIdEtapa
                        )
                        ,
                        array("onChange" => "mostrar()")
        );

        $widgets['remitente'] = new sfWidgetFormChoice(array(
                    'choices' => array('traficos1@coltrans.com.co' => 'traficos1@coltrans.com.co', 'traficos2@coltrans.com.co' => 'traficos2@coltrans.com.co'),
                ));

        $widgets['asunto'] = new sfWidgetFormInputText(array(), array("size" => 120,"onChange" => "mostrar()"));
        $widgets['introduccion'] = new sfWidgetFormTextarea(array(), array("rows" => 3, "cols" => 140));
        $widgets['mensaje'] = new sfWidgetFormTextarea(array(), array("rows" => 5, "cols" => 140, "onChange" => "validarMensaje()"));
        $widgets['notas'] = new sfWidgetFormTextarea(array(), array("rows" => 3, "cols" => 140));


        $widgets['mensaje_dirty'] = new sfWidgetFormInputHidden();
        $widgets['mensaje_mask'] = new sfWidgetFormInputHidden();


        $widgets['piezas'] = new sfWidgetFormInputText(array(), array("size" => 8));
        $widgets['peso'] = new sfWidgetFormInputText(array(), array("size" => 8));
        $widgets['volumen'] = new sfWidgetFormInputText(array(), array("size" => 8));

        $widgets['fchsalida'] = new sfWidgetFormExtDate();
        $widgets['horasalida'] = new sfWidgetFormTime();
        $widgets['fchllegada'] = new sfWidgetFormExtDate();
        $widgets['jornada'] = new sfWidgetFormDoctrineChoice(array(
                    'model' => 'Parametro',
                    'add_empty' => false,
                    'method' => "getCaValor",
                    'key_method' => "getCaValor",
                    'query' => $this->queryJornadas
                ));
                
        $widgets['fchcontinuacion'] = new sfWidgetFormExtDate();


        $widgets['doctransporte'] = new sfWidgetFormInputText(array(), array("size" => 40, "maxlength" => 50));
        $widgets['docmaster'] = new sfWidgetFormInputText(array(), array("size" => 40, "maxlength" => 100));
        $widgets['idnave'] = new sfWidgetFormInputText(array(), array("size" => 40, "maxlength" => 50));

        $widgets['un_piezas'] = new sfWidgetFormDoctrineChoice(array(
                    'model' => 'Parametro',
                    'add_empty' => false,
                    'method' => "getCaValor",
                    'key_method' => "getCaValor",
                    'query' => $this->queryPiezas
                ));
        $widgets['un_peso'] = new sfWidgetFormDoctrineChoice(array(
                    'model' => 'Parametro',
                    'add_empty' => false,
                    'method' => "getCaValor",
                    'key_method' => "getCaValor",
                    'query' => $this->queryPeso
                ));
        $widgets['un_volumen'] = new sfWidgetFormDoctrineChoice(array(
                    'model' => 'Parametro',
                    'add_empty' => false,
                    'method' => "getCaValor",
                    'key_method' => "getCaValor",
                    'query' => $this->queryVolumen
                ));

        $widgets['fchrecibo'] = new sfWidgetFormExtDate();
        $widgets['horarecibo'] = new sfWidgetFormTime();

        //solo para validaci�n
        $widgets['fchhorarecibo'] = new sfWidgetFormInputHidden();

        for ($i = 0; $i < self::NUM_EQUIPOS; $i++) {
            $widgets["equipos_tipo_" . $i] = new sfWidgetFormDoctrineChoice(array(
                        'model' => 'Concepto',
                        'add_empty' => false,
                        'method' => "getCaConcepto",
                        'key_method' => "getCaIdconcepto",
                        'query' => $this->queryConcepto,
                        "add_empty" => true
                    ));
            $widgets["equipos_serial_" . $i] = new sfWidgetFormInputText(array(), array("size" => 14, "style" => "margin-bottom:3px"));
            $widgets["equipos_cant_" . $i] = new sfWidgetFormInputText(array(), array("size" => 5, "style" => "margin-bottom:3px"));
        }

        $widgets['datosbl'] = new sfWidgetFormTextarea(array(), array("rows" => 3, "cols" => 140));

        foreach ($this->widgetsClientes as $name => $val) {

            $type = $val["type"];
            if ($type == "date") {
                $widgets[$name] = new sfWidgetFormExtDate();
                $validator[$name] = new sfValidatorDate(array('required' => false));
            } else {
                $widgets[$name] = new sfWidgetFormInputText(array(), array("size" => 70));
                $validator[$name] = new sfValidatorString(array('required' => false));
            }
        }

        $widgets['observaciones_idg'] = new sfWidgetFormInputText(array(), array("size" => 120));

        //Seguimientos		
        $widgets["prog_seguimiento"] = new sfWidgetFormInputCheckbox(array(), array("onClick" => "crearSeguimiento()"));
        $widgets["fchseguimiento"] = new sfWidgetFormExtDate();
        $widgets['txtseguimiento'] = new sfWidgetFormTextarea(array(), array("rows" => 3, "cols" => 80));
        
        
        $widgets['txtincompleto'] = new sfWidgetFormTextarea(array(), array("rows" => 3, "style" => 'width:100%'));
        $widgets["rep_incompleto"] = new sfWidgetFormInputCheckbox(array(), array("onClick" => "reporteIncompleto()"));

        $widgets['emailusuario'] = new sfWidgetFormDoctrineChoice(array(
                    'model' => 'Usuario',
                    'method' => "getCaNombre",
                    'key_method' => "getCaLogin",
                    'query' => $this->queryUsuario,
                    'multiple' => 'true', 'expanded' => true
                        )
        );

        $widgets['inspeccion_fisica'] = new sfWidgetFormInputCheckbox();

        $widgets['fchactual'] = new sfWidgetFormInputText(array());

        $widgets['manifiesto'] = new sfWidgetFormInputText(array(), array("size" => 120));
        $widgets['valor_fob'] = new sfWidgetFormInputText(array(), array("size" => 60));

        $this->setWidgets($widgets);

        $validator["impoexpo"] = new sfValidatorString(array('required' => true),
                        array('invalid' => 'Impo/Expo Required'));


        $validator["transporte"] = new sfValidatorString(array('required' => true),
                        array('invalid' => 'Transporte Required'));

        for ($i = 0; $i < count($destinatarios); $i++) {
            $validator["destinatarios_" . $i] = new sfValidatorEmail(array('required' => false),
                            array('invalid' => 'La direcci�n es invalida'));
            $this->widgetSchema->setLabel("destinatarios_" . $i, $destinatarios[$i]);
        }
        
        for ($i = 0; $i < count($contactos); $i++) {
            $validator["contactos_" . $i] = new sfValidatorEmail(array('required' => false),
                            array('invalid' => 'La direcci�n es invalida'));
            $this->widgetSchema->setLabel("contactos_" . $i, $contactos[$i]);
        }

        for ($i = 0; $i < count($destinatariosFijos); $i++) {
            $validator["destinatariosfijos_" . $i] = new sfValidatorEmail(array('required' => false),
                            array('invalid' => 'La direcci�n es invalida'));
            if ($destinatariosFijos[$i]->getCaEmail()) {
                $this->widgetSchema->setLabel("destinatariosfijos_" . $i, $destinatariosFijos[$i]->getNombre() . " [" . $destinatariosFijos[$i]->getCaCargo() . "]");
            } else {
                $this->widgetSchema->setLabel("destinatariosfijos_" . $i, $destinatariosFijos[$i]->getNombre() . " <span class='rojo'>Destinatario sin e-mail</span>");
            }
        }

        for ($i = 0; $i < self::NUM_CC; $i++) {
            $validator["cc_" . $i] = new sfValidatorEmail(array('required' => false),
                            array('invalid' => 'La direcci�n es invalida'));
        }
        
        for ($i = 0; $i < self::NUM_CC; $i++) {
            $validator["cci_" . $i] = new sfValidatorEmail(array('required' => false),
                            array('invalid' => 'La direcci�n es invalida'));
        }


        $validator["remitente"] = new sfValidatorEmail(array('required' => false),
                        array('invalid' => 'La direcci�n es invalida'));

        $validator['idetapa'] = new sfValidatorString(array('required' => true),
                        array('required' => 'La etapa es obligatoria'));
        $validator['asunto'] = new sfValidatorString(array('required' => true),
                        array('required' => 'Por favor coloque el asunto'));

        $validator['introduccion'] = new sfValidatorString(array('required' => true),
                        array('required' => 'Por favor coloque la introducci�n o el saludo del mensaje'));

        $validator['mensaje'] = new sfValidatorString(array('required' => true),
                        array('required' => 'Por favor coloque el status'));
        $validator['mensaje_dirty'] = new sfValidatorString(array('required' => false));
        $validator['notas'] = new sfValidatorString(array('required' => false));

        $validator['piezas'] = new sfValidatorNumber(array('required' => false),
                        array('required' => 'Por favor coloque las piezas',
                            'invalid' => 'No valido'));
        $validator['peso'] = new sfValidatorNumber(array('required' => false),
                        array('required' => 'Por favor coloque el peso',
                            'invalid' => 'No valido'));
        $validator['volumen'] = new sfValidatorNumber(array('required' => false),
                        array('required' => 'Por favor coloque el volumen',
                            'invalid' => 'No valido'
                ));
        $validator['un_piezas'] = new sfValidatorString(array('required' => false));
        $validator['un_peso'] = new sfValidatorString(array('required' => false));
        $validator['un_volumen'] = new sfValidatorString(array('required' => false));
        $validator['doctransporte'] = new sfValidatorString(array('required' => false),
                        array('required' => 'Por favor coloque el HBL/HAWB'));
        $validator['idnave'] = new sfValidatorString(array('required' => false),
                        array('required' => 'Por favor coloque la motonave o el vuelo'));
        $validator['docmaster'] = new sfValidatorString(array('required' => false),
                        array('required' => 'Por favor coloque el BL'));
        $validator['fchsalida'] = new sfValidatorDate(array('required' => false),
                        array('required' => 'Por favor coloque la fecha de salida'));
        $validator['fchllegada'] = new sfValidatorDate(array('required' => false),
                        array('required' => 'Por favor coloque la fecha de llegada'));
        $validator['jornada'] = new sfValidatorString(array('required' => false),
                        array('required' => 'Por favor coloque la jornada en la que llega la carga'));

        $validator['fchcontinuacion'] = new sfValidatorDate(array('required' => false),
                        array('required' => 'Por favor coloque la fecha de continuaci�n'));

        $validator['fchrecibo'] = new sfValidatorDate(array('required' => true),
                        array('required' => 'Por favor coloque en la fecha en que usted recibi� este status'));
        $validator['horarecibo'] = new sfValidatorTime(array('required' => true),
                        array('required' => 'Por favor coloque en la hora que usted recibi� este status'));

        $validator['horasalida'] = new sfValidatorTime(array('required' => false));


        for ($i = 0; $i < self::NUM_EQUIPOS; $i++) {
            $validator["equipos_tipo_" . $i] = new sfValidatorString(array('required' => false));
            $validator["equipos_serial_" . $i] = new sfValidatorString(array('required' => false));
            $validator["equipos_cant_" . $i] = new sfValidatorNumber(array('required' => false, "min" => 0),
                            array('invalid' => 'No valido'));
        }

        $validator['mensaje_mask'] = new sfValidatorString(array('required' => false));

        $validator['inspeccion_fisica'] = new sfValidatorString(array('required' => false));

        $validator['datosbl'] = new sfValidatorString(array('required' => false),
                        array('required' => 'Por favor coloque los datos para reclamar el BL en destino'));

        $validator['prog_seguimiento'] = new sfValidatorString(array('required' => false));

        $validator['rep_incompleto'] = new sfValidatorString(array('required' => false));
        
        $validator['fchseguimiento'] = new sfValidatorDate(array('required' => false),
                        array('required' => 'Por favor coloque en una fecha valida'));
        $validator['txtseguimiento'] = new sfValidatorString(array('required' => false),
                        array('required' => 'Por favor coloque un texto para el seguimiento'));

        $validator['observaciones_idg'] = new sfValidatorString(array('required' => false));

        $validator['ca_inspeccion_fisica'] = new sfValidatorBoolean(array('required' => false));

        $validator['fchactual'] = new sfValidatorString(array('required' => false));
        $validator['fchhorarecibo'] = new sfValidatorString(array('required' => false));

        $validator["manifiesto"] = new sfValidatorString(array('required' => false),
                        array('invalid' => 'Required'));
        $validator["valor_fob"] = new sfValidatorString(array('required' => false),
                        array('invalid' => 'Required'));

        //echo isset($validator['fchdoctransporte'])."<br />";															
        $this->setValidators($validator);


        $this->validatorSchema->setPostValidator(
                new sfValidatorAnd(array(
                    new sfValidatorSchemaCompare('fchrecordar', '<=', 'fchseguimiento', array(), array("invalid" => "Esta fecha debe ser menor que la fecha de seguimiento")),
                    new sfValidatorSchemaCompare('fchhorarecibo', '<=', 'fchactual', array(), array("invalid" => "Esta fecha debe ser menor que la fecha actual"))
                        )
                )
        );
    }

    public function bind(array $taintedValues = null, array $taintedFiles = null) {
        /* $request = sfContext::getInstance()->getRequest();
          if ($request->hasParameter(self::$CSRFFieldName)){
          $taintedValues[self::$CSRFFieldName] = $request->getParameter(self::$CSRFFieldName);
          } */
        if ($taintedValues["mensaje_mask"]) {
            $this->validatorSchema['mensaje']->setOption('required', false);
        }

        if ($taintedValues["idetapa"] == "IAETA" || $taintedValues["idetapa"] == "IMETA" || $taintedValues["idetapa"] == "EEETD") {
            $this->validatorSchema['piezas']->setOption('required', true);
            $this->validatorSchema['peso']->setOption('required', true);
            $this->validatorSchema['volumen']->setOption('required', true);
            $this->validatorSchema['fchsalida']->setOption('required', true);
            $this->validatorSchema['fchllegada']->setOption('required', true);
            $this->validatorSchema['fchllegada']->setOption('required', true);
            $this->validatorSchema['doctransporte']->setOption('required', true);
            $this->validatorSchema['idnave']->setOption('required', true);
        }

        if ($taintedValues["idetapa"] != "IAETA") {
            $this->validatorSchema['fchrecibo']->setOption('required', true);
            $this->validatorSchema['horarecibo']->setOption('required', true);
        }

        if ($taintedValues["prog_seguimiento"]) {
            $this->validatorSchema['fchseguimiento']->setOption('required', true);
            $this->validatorSchema['txtseguimiento']->setOption('required', true);
        }
        
        if ($taintedValues["rep_incompleto"]) {
            //$this->validatorSchema['contactos_0']->setOption('required', true);            
        }

        $horaRecibo = $taintedValues["horarecibo"];

        if (!$horaRecibo['minute']) {
            $horaRecibo['minute'] = '00';
        }

        $horaRecibo['hour'] = str_pad($horaRecibo['hour'], 2, "0", STR_PAD_LEFT);
        $horaRecibo['minute'] = str_pad($horaRecibo['minute'], 2, "0", STR_PAD_LEFT);
        $horaRecibo = implode(":", $horaRecibo) . ":00";
        $fch = $taintedValues["fchrecibo"] . " " . $horaRecibo;
        //echo $fch;

        $fest = TimeUtils::getFestivos();
        $dif = TimeUtils::calcDiff($fest, strtotime($fch), time());

        if ($taintedValues["impoexpo"] == Constantes::IMPO && ($taintedValues["transporte"] == Constantes::MARITIMO || $taintedValues["transporte"] == Constantes::AEREO || $taintedValues["transporte"] == Constantes::TERRESTRE)) {
            $maxTime = 0;
            if ($taintedValues["transporte"] == Constantes::MARITIMO || $taintedValues["transporte"] == Constantes::TERRESTRE) {
                $idgMax = IdgTable::getUnIndicador(RepStatus::IDG_MARITIMO, $taintedValues["fchrecibo"], $this->idsucursal);
                $maxTime = $idgMax?$idgMax->getCaLim1()*3600:0;
            }
            if ($taintedValues["transporte"] == Constantes::AEREO) {
                $idgMax = IdgTable::getUnIndicador(RepStatus::IDG_AEREO, $taintedValues["fchrecibo"], $this->idsucursal);
                $maxTime = $idgMax?$idgMax->getCaLim1()*3600:0;
            }

            if (!$taintedValues["observaciones_idg"] && $dif > $maxTime) {
                $this->validatorSchema['observaciones_idg']->setOption('required', true);
            }
        }
        $taintedValues["fchhorarecibo"] = $fch;
        $taintedValues["fchactual"] = date("Y-m-d H:i:s");
        $destinatariosFijos = $this->getDestinatariosFijos();

        parent::bind($taintedValues, $taintedFiles);
    }

    public function setQueryIdEtapa($c) {
        $this->queryIdEtapa = $c;
    }

    public function setQueryUsuario($c) {
        $this->queryUsuario = $c;
    }

    public function setQueryPiezas($c) {
        $this->queryPiezas = $c;
    }

    public function setQueryPeso($c) {
        $this->queryPeso = $c;
    }

    public function setQueryVolumen($c) {
        $this->queryVolumen = $c;
    }
    
    public function setQueryJornadas($c) {
        $this->queryJornadas = $c;
    }

    public function setDestinatarios($c) {
        $this->destinatarios = $c;
    }
    
    public function setContactos($c) {
        $this->contactos = $c;
    }
    
    public function setIdsucursal($c) {
        $this->idsucursal = $c;
    }

    public function setDestinatariosFijos($c) {
        $this->destinatariosFijos = $c;
    }

    public function setQueryConceptos($c) {
        $this->queryConcepto = $c;
    }

    public function getWidgetsClientes() {
        return $this->widgetsClientes;
    }

    public function getDestinatarios() {
        return $this->destinatarios;
    }
    
    public function getContactos() {
        return $this->contactos;
    }
    
    public function getIdsucursal() {
        return $this->idsucursal;
    }

    public function getDestinatariosFijos() {
        return $this->destinatariosFijos;
    }

    public function setWidgetsClientes($parametros) {

        foreach ($parametros as $parametro) {

            $valor = explode(":", $parametro->getCaValor());
            $name = $valor[0];
            $type = $valor[1];

            $this->widgetsClientes[$name] = array("type" => $type, "label" => $parametro->getCaValor2());
        }
    }
}
?>