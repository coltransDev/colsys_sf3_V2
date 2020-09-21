<?
class NuevoStatusForm extends BaseForm {
    const NUM_CC = 7;
    const NUM_EQUIPOS = 3;    
    const NUM_EQUIPOS_EXPO = 3;

    private $queryIdEtapa = null;
    private $queryUsuario = null;
    private $queryPiezas = null;
    private $queryPeso = null;
    private $queryVolumen = null;
    private $queryMuelles = null;
    private $queryEmisionHbl = null;
    private $queryExclusiones = null;
    private $queryJornadas = null;
    private $queryConcepto = null;
    private $destinatarios = array();
    private $contactos = array();
    private $operativos = array();
    private $destinatariosFijos = array();
    private $widgetsClientes = array();
    private $widgetsProveedores = array();
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
        
        $operativos = $this->getOperativos();
        for ($i = 0; $i < count($operativos); $i++) {
            $widgets["operativos_" . $i] = new sfWidgetFormInputCheckbox(array(), array("size" => 60, "style" => "margin-bottom:3px", "value" => trim($operativos[$i]["ca_login"])));
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

        for ($i = 0; $i < self::NUM_CC; $i++) {
            $widgets["cco_" . $i] = new sfWidgetFormInputText(array(), array("size" => 60, "style" => "margin-bottom:3px"));
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
                    'choices' => array('sercliente-mar1@coltrans.com.co' => 'sercliente-mar1@coltrans.com.co', 
				'sercliente-mar2@coltrans.com.co' => 'sercliente-mar2@coltrans.com.co',
				'sercliente-mar3@coltrans.com.co' => 'sercliente-mar3@coltrans.com.co',
				'sercliente-mar4@coltrans.com.co' => 'sercliente-mar4@coltrans.com.co',
				'sercliente-mar5@coltrans.com.co' => 'sercliente-mar5@coltrans.com.co'
		),
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
        $widgets['bodega_air'] = new sfWidgetFormInputText(array(), array("size" => 40, "maxlength" => 50));
        
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
        
        $widgets['idmuelle'] = new sfWidgetFormDoctrineChoice(array(
                    'model' => 'InoDianDepositos',
                    'add_empty' => true,
                    'method' => "getCaNombre",
                    'key_method' => "getCaCodigo",
                    'query' => $this->queryMuelles
                ));

        $widgets['idemisionhbl'] = new sfWidgetFormDoctrineChoice(array(
                    'model' => 'Parametro',
                    'add_empty' => true,
                    'method' => "getCaValor2",
                    'key_method' => "getCaValor",
                    'query' => $this->queryEmisionHbl
                ));

        $widgets['fch_cargadisponible'] = new sfWidgetFormExtDate();
        $widgets['fchrecibo'] = new sfWidgetFormExtDate();
        $widgets['horarecibo'] = new sfWidgetFormTime();
        $widgets['fchcargue'] = new sfWidgetFormExtDate();
        $widgets['fchcierreotm'] = new sfWidgetFormExtDate();
        $widgets['fchsalidaotm'] = new sfWidgetFormExtDate();

        //solo para validación
        $widgets['fchhorarecibo'] = new sfWidgetFormInputHidden();

        $arreglo = array();
        for( $i=0;$i<50;$i++){
            $arreglo[] = $i;
        }
        $widgets["num_equipos"] = new sfWidgetFormChoice(array( 'choices' => $arreglo ));

        $vehiculos = ParametroTable::retrieveByCaso( "CU020" );
        
        $choices = array();
        foreach( $vehiculos as $v ){
            $choices[$v->getCaIdentificacion()] = $v->getCaValor();
        }
        
        for ($i = 0; $i < 50; $i++) {
            $widgets["equipos_tipo_" . $i] = new sfWidgetFormDoctrineChoice(array(
                        'model' => 'Concepto',
                        'add_empty' => false,
                        'method' => "getCaConcepto",
                        'key_method' => "getCaIdconcepto",
                        'query' => $this->queryConcepto,
                        "add_empty" => true
                    ));

            $widgets["equipos_idvehiculo_" . $i] = new sfWidgetFormChoice(array( 'choices' => $choices ));
            $widgets["equipos_placa_" . $i] = new sfWidgetFormInputText(array(), array("size" => 10, "style" => "margin-bottom:3px"));
            
            
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

        foreach ($this->widgetsProveedores as $name => $val) {
            
            $widgets["id_".$name] = new sfWidgetFormExtDate();
            $validator["id_".$name] = new sfValidatorDate(array('required' => false));                                                
        }

        $widgets['observaciones_idg'] = new sfWidgetFormInputText(array(), array("size" => 120));
        $widgets['exclusiones_idg'] = new sfWidgetFormChoice(array('choices' => $this->queryExclusiones));

        //Seguimientos		
        $widgets["prog_seguimiento"] = new sfWidgetFormInputCheckbox(array(), array("onClick" => "crearSeguimiento()"));
        $widgets["fchseguimiento"] = new sfWidgetFormExtDate();
        $widgets['txtseguimiento'] = new sfWidgetFormTextarea(array(), array("rows" => 3, "cols" => 80));
        
        $widgets['txtincompleto'] = new sfWidgetFormTextarea(array(), array("rows" => 3, "style" => 'width:100%'));
        $widgets["rep_incompleto"] = new sfWidgetFormInputCheckbox(array(), array("onClick" => "reporteIncompleto()"));

        $widgets["rep_operativo"] = new sfWidgetFormInputCheckbox(array(), array("onClick" => "reporteOperativo()"));

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

        $widgets['manifiesto'] = new sfWidgetFormInputText(array(), array("size" => 70));
        $widgets['idgfactura'] = new sfWidgetFormInputHidden();
        $widgets['idgcollect'] = new sfWidgetFormInputHidden();
        $widgets["fchmanifiesto"] = new sfWidgetFormExtDate();
        $widgets['valor_fob'] = new sfWidgetFormInputText(array(), array("size" => 60));

        $this->setWidgets($widgets);

        $validator["impoexpo"] = new sfValidatorString(array('required' => true),
                        array('invalid' => 'Impo/Expo Required'));

        $validator["transporte"] = new sfValidatorString(array('required' => true),
                        array('invalid' => 'Transporte Required'));

        for ($i = 0; $i < count($destinatarios); $i++) {
            $validator["destinatarios_" . $i] = new sfValidatorEmail(array('required' => false),
                            array('invalid' => 'La dirección es invalida'));
            $this->widgetSchema->setLabel("destinatarios_" . $i, $destinatarios[$i]);
        }
        
        for ($i = 0; $i < count($contactos); $i++) {
            $validator["contactos_" . $i] = new sfValidatorEmail(array('required' => false),
                            array('invalid' => 'La dirección es invalida'));
            $this->widgetSchema->setLabel("contactos_" . $i, $contactos[$i]);
        }
        
        for ($i = 0; $i < count($operativos); $i++) {
            $validator["operativos_" . $i] = new sfValidatorEmail(array('required' => false),
                            array('invalid' => 'La dirección es invalida'));
            $this->widgetSchema->setLabel("operativos_" . $i, $operativos[$i]);
        }
        

        for ($i = 0; $i < count($destinatariosFijos); $i++) {
            $validator["destinatariosfijos_" . $i] = new sfValidatorEmail(array('required' => false),
                            array('invalid' => 'La dirección es invalida'));
            if ($destinatariosFijos[$i]->getCaEmail()) {
                $this->widgetSchema->setLabel("destinatariosfijos_" . $i, $destinatariosFijos[$i]->getNombre() . " [" . $destinatariosFijos[$i]->getCaCargo() . "]");
            } else {
                $this->widgetSchema->setLabel("destinatariosfijos_" . $i, $destinatariosFijos[$i]->getNombre() . " <span class='rojo'>Destinatario sin e-mail</span>");
            }
        }

        for ($i = 0; $i < self::NUM_CC; $i++) {
            $validator["cc_" . $i] = new sfValidatorEmail(array('required' => false),
                            array('invalid' => 'La dirección es invalida'));
        }
        
        for ($i = 0; $i < self::NUM_CC; $i++) {
            $validator["cci_" . $i] = new sfValidatorEmail(array('required' => false),
                            array('invalid' => 'La dirección es invalida'));
        }

        $validator["remitente"] = new sfValidatorEmail(array('required' => false),
                        array('invalid' => 'La dirección es invalida'));

        $validator['idetapa'] = new sfValidatorString(array('required' => true),
                        array('required' => 'La etapa es obligatoria'));
        $validator['asunto'] = new sfValidatorString(array('required' => true),
                        array('required' => 'Por favor coloque el asunto'));

        $validator['introduccion'] = new sfValidatorString(array('required' => true),
                        array('required' => 'Por favor coloque la introducción o el saludo del mensaje'));

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
        $validator['idmuelle'] = new sfValidatorString(array('required' => false),
                        array('required' => 'Por favor coloque el muelle'));
        $validator['idemisionhbl'] = new sfValidatorString(array('required' => false),
                        array('required' => 'Por favor coloque dónde se emitirá el HBL'));
        $validator['bodega_air'] = new sfValidatorString(array('required' => false),
                        array('required' => 'Por favor coloque la bodega del aeropuerto'));
        $validator['docmaster'] = new sfValidatorString(array('required' => false),
                        array('required' => 'Por favor coloque el BL'));
        $validator['fchsalida'] = new sfValidatorDate(array('required' => false),
                        array('required' => 'Por favor coloque la fecha de salida'));
        $validator['fchllegada'] = new sfValidatorDate(array('required' => false),
                        array('required' => 'Por favor coloque la fecha de llegada'));
        $validator['jornada'] = new sfValidatorString(array('required' => false),
                        array('required' => 'Por favor coloque la jornada en la que llega la carga'));

        $validator['fchcontinuacion'] = new sfValidatorDate(array('required' => false),
                        array('required' => 'Por favor coloque la fecha de continuación'));
        $validator['fch_cargadisponible'] = new sfValidatorDate(array('required' => false),
                        array('required' => 'Por favor coloque en la fecha en que la carga estará o estuvo disponible'));
        $validator['fchrecibo'] = new sfValidatorDate(array('required' => true),
                        array('required' => 'Por favor coloque en la fecha en que usted recibió este status'));
        $validator['horarecibo'] = new sfValidatorTime(array('required' => true),
                        array('required' => 'Por favor coloque en la hora que usted recibió este status'));

        $validator['fchcargue'] = new sfValidatorDate(array('required' => false),array('required' => 'Por favor coloque la fecha de cargue'));
        $validator['fchcierreotm'] = new sfValidatorDate(array('required' => false),array('required' => 'Por favor coloque la fecha de cierre'));
        $validator['fchsalidaotm'] = new sfValidatorDate(array('required' => false),array('required' => 'Por favor coloque la fecha de salida'));        

        $validator['horasalida'] = new sfValidatorTime(array('required' => false));

        $validator['num_equipos'] = new sfValidatorTime(array('required' => false));
        for ($i = 0; $i < 50; $i++) {
            $validator["equipos_tipo_" . $i] = new sfValidatorString(array('required' => false));
            $validator["equipos_idvehiculo_" . $i] = new sfValidatorString(array('required' => false));
            $validator["equipos_placa_" . $i] = new sfValidatorString(array('required' => false));
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
        
        $validator['rep_operativo'] = new sfValidatorString(array('required' => false));
        
        $validator['fchseguimiento'] = new sfValidatorDate(array('required' => false),
                        array('required' => 'Por favor coloque en una fecha valida'));
        $validator['txtseguimiento'] = new sfValidatorString(array('required' => false),
                        array('required' => 'Por favor coloque un texto para el seguimiento'));

        $validator['observaciones_idg'] = new sfValidatorString(array('required' => false));
        $validator['exclusiones_idg'] = new sfValidatorString(array('required' => false));

        $validator['ca_inspeccion_fisica'] = new sfValidatorBoolean(array('required' => false));

        $validator['fchactual'] = new sfValidatorString(array('required' => false));
        $validator['fchhorarecibo'] = new sfValidatorString(array('required' => false));

        $validator["manifiesto"] = new sfValidatorString(array('required' => false),
                        array('invalid' => 'Required'));
        $validator["fchmanifiesto"] = new sfValidatorString(array('required' => false),
                        array('invalid' => 'Required'));
        $validator["valor_fob"] = new sfValidatorString(array('required' => false),
                        array('invalid' => 'Required'));
        $validator['idgfactura'] = new sfValidatorString(array('required' => false));        
        $validator['idgcollect'] = new sfValidatorString(array('required' => false));        

        //echo isset($validator['fchdoctransporte'])."<br />";															
        $this->setValidators($validator);

        $this->validatorSchema->setPostValidator(
                new sfValidatorAnd(array(
                    new sfValidatorSchemaCompare('fchrecordar', '<=', 'fchseguimiento', array(), array("invalid" => "Esta fecha debe ser menor que la fecha de seguimiento")),
                    new sfValidatorSchemaCompare('fchhorarecibo', '<=', 'fchactual', array(), array("invalid" => "Esta fecha debe ser menor que la fecha actual"))
                        )
                )
        );
      //die("va aca ".time());
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
        
        $idgxEtapa = TrackingEtapaTable::getIdgXEtapa($taintedValues["idetapa"]);
        if(!$idgxEtapa){        
            $this->validatorSchema['fchrecibo']->setOption('required', false);
            $this->validatorSchema['horarecibo']->setOption('required', false);
        }
       
        if ($taintedValues["prog_seguimiento"]) {
            $this->validatorSchema['fchseguimiento']->setOption('required', true);
            $this->validatorSchema['txtseguimiento']->setOption('required', true);
        }
        
        if ($taintedValues["rep_incompleto"]) {
            //$this->validatorSchema['contactos_0']->setOption('required', true);            
        }
        /*IDG ENVIO FACTURAS*/

        $idg = $taintedValues["idgfactura"];
        
        if($idg){
            if ($idg["cumplio"] == "No" && (!$taintedValues["exclusiones_idg"] && !$taintedValues["observaciones_idg"] )  ) {                                
                if($idg["cumplio"] == "No" && $taintedValues["observaciones_idg"])
                    $taintedValues["observaciones_idg"] = null;
                $this->validatorSchema['observaciones_idg'] = new sfValidatorString(array('required' => true), array('required' => $idg["mensaje"]));                
                $this->validatorSchema['exclusiones_idg'] = new sfValidatorString(array('required' => false), array('required' => "Selecciona una exclusión si aplica"));
            }
            /*No debe permitir enviar el status*/
            if($idg["cumplio"] == "Out"){
                $taintedValues["observaciones_idg"] = null;
                $this->validatorSchema['observaciones_idg'] = new sfValidatorString(array('required' => true), array('required' => $idg["mensaje"]));
            }
        }
        
        /*IDG EXPO - COLLECT*/
        if($taintedValues["idetapa"] == "EEETD"){
            $idgcollect = $taintedValues["idgcollect"];

            if($idgcollect){
                if ($idgcollect["cumplio"] == "No" && (!$idgcollect["exclusiones_idg"] && !$idgcollect["observaciones_idg"] )  ) {                                
                    if($idgcollect["cumplio"] == "No" && $taintedValues["observaciones_idg"])
                        $taintedValues["observaciones_idg"] = null;
                    $this->validatorSchema['observaciones_idg'] = new sfValidatorString(array('required' => true), array('required' => $idgcollect["mensaje"]));                
                    $this->validatorSchema['exclusiones_idg'] = new sfValidatorString(array('required' => false), array('required' => "Selecciona una exclusión si aplica"));
                }
            }
        }
        
        /*IDG TRADICIONAL*/
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
            if($idgxEtapa){//Ticket 27959            
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
    
    public function setQueryMuelles($c) {
        $this->queryMuelles = $c;
    }
    
    public function setEmisionHbl($c) {
        $this->queryEmisionHbl = $c;
    }
    
    public function setQueryExclusiones($c) {
        $this->queryExclusiones = $c;
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
    
    public function setOperativos($c) {
        $this->operativos = $c;
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

    public function getWidgetsProveedores() {
        return $this->widgetsProveedores;
    }

    public function getDestinatarios() {
        return $this->destinatarios;
    }
    
    public function getContactos() {
        return $this->contactos;
    }
    
    public function getOperativos() {
        return $this->operativos;
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
    
    public function setWidgetsProveedores($proveedores) {

        foreach ($proveedores as $proveedor) {
            $tercero = Doctrine::getTable("Tercero")->find($proveedor->getCaIdproveedor());
            if($tercero)
                $this->widgetsProveedores[$proveedor->getCaIdrepproveedor()] = array("type" => "date", "label"=>$tercero->getCaNombre(), "valor"=>$proveedor->getCaCargaDisponible());
        }
    }
}
?>
