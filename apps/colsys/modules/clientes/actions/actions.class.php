<?php

/**
 * clientes actions.
 *
 * @package    colsys
 * @subpackage clientes
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class clientesActions extends sfActions
{
	/*
	* Muestra el formulario donde estan los contactos
	*
	*/

	public function executeClavesTracking(){
		$this->cliente = Doctrine::getTable("Cliente")->find( $this->getRequestParameter("id"));
		$this->forward404Unless( $this->cliente );
	}

	/*
	* Envia un email generando un nuevo codigo de activacion
	* y desactiva la cuenta para que el usuario la active de nuevo
	*/
	public function executeActivarClave(){

		$contacto = Doctrine::getTable("Contacto")->find( $this->getRequestParameter("contacto") );
		$this->forward404Unless( $contacto );
		$user = $contacto->getTrackingUser();

		//Genera un codigo de activacion
		$email = $contacto->getCaEmail();

		if(!$user){
			$user = new TrackingUser();
			$user->setCaEmail( $email );
			$code = $user->generateActivationCode();
		}else{
			$code = $user->getCaActivationCode();
		}

		$user->setCaActivated( false );

		$user->setCaIdcontacto( $contacto->getCaIdcontacto() );

		$user->save();



		$link = "/tracking/login/activate/code/".$code ;
		$config = sfConfig::get('sf_app_module_dir').DIRECTORY_SEPARATOR."clientes".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."email.yml";
		$yml = sfYaml::load($config);


		$contentPlain = sprintf($yml['email'], "https://www.coltrans.com.co".$link, "http://www.coltrans.com.co" );
		$contentHTML = sprintf(Utils::replace($yml['email']), "<a href='https://www.coltrans.com.co".$link."'>https://www.coltrans.com.co".$link."</a>", "<a href='http://www.coltrans.com.co'>http://www.coltrans.com.co</a>" );;


		$from = "serclientebog@coltrans.com.co";
		$fromName = "Coltrans S.A. - Servicio al cliente";
		//$to = array($contacto->getCaNombres()." ".$contacto->getCaPapellido()=>$contacto->getCaEmail() );

		//$to = array($contacto->getCaNombres()." ".$contacto->getCaPapellido()=>$contacto->getCaEmail() );
		$to = array($contacto->getCaNombres()." ".$contacto->getCaPapellido()=>$contacto->getCaEmail(), $this->getUser()->getNombre()=>$this->getUser()->getEmail());
		//StaticEmail::sendEmail( "Activación Clave Coltrans.com.co", array("plain"=>$contentPlain,"html"=>$contentHTML), $from, $fromName, $to );

		$email = new Email();
		$email->setCaUsuenvio( "Administrador" );
		$email->setCaTipo( "Activación Tracking" );
		$email->setCaFrom( $from );
		$email->setCaReplyto( $from );
		$email->setCaFromname( $fromName );
		$email->addTo( $contacto->getCaEmail() );
		$email->addCc( $this->getUser()->getEmail() );
		$email->setCaSubject( "Activación Clave Coltrans.com.co" );
		$email->setCaBodyhtml( $contentHTML );
		$email->setCaBody( $contentPlain );
		$email->save();
		$email->send();
	}


	/*
	* Entrada Reporte de Estados Clientes
	*/
	public function executeListaEstados() {

        $this->sucursales = Doctrine::getTable("Sucursal")
                          ->createQuery("s")
                          ->select("s.ca_nombre")
                          ->addOrderBy("s.ca_nombre")
                          ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                          ->execute();


	}

	/*
	* Entrada Reporte de Circular 170 Clientes
	*/
	public function executeListaCircular() {
		 $this->sucursales = Doctrine::getTable("Sucursal")
                          ->createQuery("s")
                          ->select("s.ca_nombre")
                          ->addOrderBy("s.ca_nombre")
                          ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                          ->execute();
	}


	/*
	* Lista los Clientes con Estado Activo y que tinene más de 1 año sin reportar negocios
	*/
        public function executeVencimientoEstado() {
            set_time_limit(0);

            $empresa = 'Coltrans';
            $stmt = StdClienteTable::vencimientoEstado($empresa, 'Activo', null);
            $fchestado = date('Y-m-d H:i:s');

            while($row = $stmt->fetch()) {
                $stdcliente = new StdCliente();

                $stdcliente->setCaIdcliente($row["ca_idcliente"]);
                $stdcliente->setCaEmpresa($empresa);
                $stdcliente->setCaEstado('Potencial');
                $stdcliente->setCaFchestado($fchestado);

                $stdcliente->save();
            }

            $empresa = 'Colmas';
            $stmt = StdClienteTable::vencimientoEstado($empresa, 'Activo', null);

            while($row = $stmt->fetch()) {
                $stdcliente = new StdCliente();

                $stdcliente->setCaIdcliente($row["ca_idcliente"]);
                $stdcliente->setCaEmpresa($empresa);
                $stdcliente->setCaEstado('Potencial');
                $stdcliente->setCaFchestado($fchestado);

                $stdcliente->save();
            }

            $idClientesSinBeneficio = array();
            $stmt = LibClienteTable::liberacionEstado(null);

            while($row = $stmt->fetch() ) {
                $idClientesSinBeneficio[] = $row["ca_idcliente"];
            }

            if ( count($idClientesSinBeneficio) > 0 ){
                Doctrine_Query::create()
                          ->update()
                          ->from("LibCliente l")
                          ->set("l.ca_observaciones", "'Pierde Beneficios por Cambio de Estado. [Cupo: '||ca_cupo||' Días: '||ca_diascredito||']\n'||l.ca_observaciones" )
                          ->set("ca_cupo", 0)
                          ->set("ca_diascredito", 0)
                          ->set("ca_usuactualizado", "'Administrador'")
                          ->set("ca_fchactualizado", "'$fchestado'")
                          ->whereIn("ca_idcliente", $idClientesSinBeneficio )
                          ->addWhere("ca_diascredito != 0 OR ca_cupo != 0")
                          ->execute();
            }

            $layout =  $this->getRequestParameter("layout");
            if( $layout ) {
                $this->setLayout($layout);
            }

        }

        public function executeReporteEstados() {
            set_time_limit(0);
            $inicio =  $this->getRequestParameter("fchStart");
            $final =  $this->getRequestParameter("fchEnd");
            $empresa =  $this->getRequestParameter("empresa");
            $estado =  $this->getRequestParameter("estado");
            $sucursal =  $this->getRequestParameter("sucursal");

            $this->clientesEstados = array();

            list($year, $month, $day) = sscanf($inicio, "%d-%d-%d");
            $inicio = date('Y-m-d h:i:s',mktime( 0, 0, 0,$month,$day ,$year));
            list($year, $month, $day) = sscanf($final, "%d-%d-%d");
            $final  = date('Y-m-d h:i:s',mktime(23,59,59,$month,$day ,$year));

            $ultimo = date('Y-m-d h:i:s',mktime(23,59,59,$month,$day-1,$year));

            $stmt = ClienteTable::estadoClientes($inicio, $final, $empresa, null, $estado, $sucursal);
            $ante = ClienteTable::estadoClientes(null, $ultimo, $empresa, null, "Potencial", $sucursal);

            while($row = $stmt->fetch()) {
                $anterior = array();
                $negocios = array();
                $actual = $row;

                list($year, $month, $day, $hour, $mins, $secn) = sscanf($row["ca_fchestado"], "%d-%d-%d %d:%d:%d");

                $sb = ClienteTable::estadoClientes(null, date('Y-m-d H:i:s',mktime($hour, $mins, $secn-1,$month,$day,$year)), $empresa, $row["ca_idcliente"], null, null);
                while($row1 = $sb->fetch()) {
                    $anterior = array('ca_fchestado_ant'=>$row1["ca_fchestado"],
                        'ca_estado_ant'=>$row1["ca_estado"]
                    );
                }

                $sb = ClienteTable::negociosClientes($inicio, $final, $empresa, $row["ca_idcliente"]);
                while($row2 = $sb->fetch()) {
                    $negocios = $row2;
                }
                if (count($anterior)==0) {
                    $anterior = array('ca_fchestado_ant'=>null, 'ca_estado_ant'=>null);
                }
                $this->clientesEstados[] = array_merge($actual, $anterior, $negocios);

            }
            $i = 0;
            while($row = $ante->fetch()) {      // Calcula el número de Clientes Potenciales al inicio del periodo
                $i++;
            }
            $this->empresa = $empresa;
            $this->poblacion = $i;
            $this->inicio = $inicio;
            $this->final = $final;

            $layout =  $this->getRequestParameter("layout");
            if( $layout ) {
                $this->setLayout($layout);
            }
        }

        public function executeReporteCircular( $request ) {
            set_time_limit(0);
            $inicio =  $this->getRequestParameter("fchStart");
            $final =  $this->getRequestParameter("fchEnd");
            $sucursal =  $this->getRequestParameter("sucursal");
            $vendedor =  $this->getRequestParameter("vendedor");

            $this->inicio = $inicio;
            $this->final = $final;
            $this->clientesCircular = array();
            $this->clientesVenCircular = array();
            $this->clientesSinCircular = array();
            $this->clientesSinVisita = array();
            $this->clientesSinBeneficio = array();
            list($year, $month, $day) = sscanf($final, "%d-%d-%d");

            // Lista los Clientes a los cuales se les vence la Circular 0170 en el siguiente mes
            $stmt = ClienteTable::circularClientes( $inicio, $final, $sucursal, $vendedor );
            while($row = $stmt->fetch() ) {
                $this->clientesCircular[] = $row;
            }

            // Lista los Clientes que hasta antes de iniciar el periodo solicitado, tienen vencida la Circular 0170
            $final = $inicio;
            $inicio = date('Y-m-d',mktime(0,0,0,$month,0,$year-5));
            $stmt = ClienteTable::circularClientes( $inicio, $final, $sucursal, $vendedor );
            while($row = $stmt->fetch() ) {
                $this->clientesVenCircular[] = $row;
            }

            // Lista los Clientes no tienen Circular 0170, sin importar la fecha
            $stmt = ClienteTable::clientesSinCircular( $final, $sucursal, $vendedor );
            while($row = $stmt->fetch() ) {
                $this->clientesSinCircular[] = $row;
            }

            // Lista los Clientes no tienen Encuesta de Visita
            $stmt = ClienteTable::clientesSinVisita( $final, $sucursal, $vendedor );
            while($row = $stmt->fetch() ) {
                $this->clientesSinVisita[] = $row;
            }

            // Si es el proceso Automático que se ejecuta los 20 de cada mes, verifica los Clientes que tienen más de 60 días
            // con la Circular 0170 vencida y retira beneficios de Cupo y Tiempo de C?edito.

            if( sfContext::getInstance()->getConfiguration()->getEnvironment()=="cli" ){
                $idClientesSinBeneficio = array();
                $inicio = date('Y-m-d',mktime(0,0,0,$month-1,0,$year-5));
                $final = date('Y-m-d',mktime(0,0,0,$month-1,0,$year));
                $fchmotivo = date('Y-m-d H:i:s');

                $stmt = ClienteTable::pierdenBeneficios( $final, $sucursal, $vendedor );
                while($row = $stmt->fetch() ) {
                    $this->clientesSinBeneficio[] = $row;
                    $idClientesSinBeneficio[] = $row["ca_idcliente"];
                }

                if ( count($idClientesSinBeneficio) > 0 ){
                    Doctrine_Query::create()
                              ->update()
                              ->from("LibCliente l")
                              ->set("l.ca_observaciones", "'Pierde Beneficios por Vencimiento de Circular 0170. [Cupo: '||ca_cupo||' Días: '||ca_diascredito||']\n'||l.ca_observaciones" )
                              ->set("ca_cupo", 0)
                              ->set("ca_diascredito", 0)
                              ->set("ca_usuactualizado", "'Administrador'")
                              ->set("ca_fchactualizado", "'".date("Y-m-d H:i:s")."'")
                              ->whereIn("ca_idcliente", $idClientesSinBeneficio )
                              ->addWhere("ca_diascredito != 0 OR ca_cupo != 0")
                              ->execute();
                }

            }

            $layout = $this->getRequestParameter("layout");
            if( $layout ) {
                $this->setLayout($layout);
            }

        }

        public function executeReporteEstadosEmail() {
            $parametro = Doctrine::getTable("Parametro")->find(array("CU066",1,"defaultEmails"));
            if ($parametro) {
                if (stripos($parametro->getCaValor2(), ',') !== false) {
                    $defaultEmail = explode(",", $parametro->getCaValor2());
                }else {
                    $defaultEmail = array($parametro->getCaValor2());
                }
            }
            $parametro = Doctrine::getTable("Parametro")->find(array("CU066",2,"ccEmails"));
            if ($parametro) {
                if (stripos($parametro->getCaValor2(), ',') !== false) {
                    $ccEmails = explode(",", $parametro->getCaValor2());
                }else {
                    $ccEmails = array($parametro->getCaValor2());
                }
            }
            $email = new Email();
            $email->setCaUsuenvio( "Administrador" );
            $email->setCaTipo( "EstadosClientes" );
            $email->setCaIdcaso( "1" );
            $email->setCaFrom( "admin@coltrans.com.co" );
            $email->setCaFromname( "Administrador Sistema Colsys" );
            $email->setCaReplyto( "admin@coltrans.com.co" );

            while (list ($clave, $val) = each ($defaultEmail)) {
                $email->addTo( $val );
            }

            while (list ($clave, $val) = each ($ccEmails)) {
                $email->addCc( $val );
            }

            $inicio =  $this->getRequestParameter("fchStart");
            $final =  $this->getRequestParameter("fchEnd");
            $empresa =  $this->getRequestParameter("empresa");

            $this->getRequest()->setParameter("fchStart", $inicio);
            $this->getRequest()->setParameter("fchEnd", $final);
            $this->getRequest()->setParameter("empresa", $empresa);
            $this->getRequest()->setParameter("layout", "email");

            $email->setCaSubject( "Cliente con cambio de Estado, periodo:$inicio a $final en $empresa" );
            $email->setCaBodyhtml(  sfContext::getInstance()->getController()->getPresentationFor( 'clientes', 'reporteEstados') );

            $email->save();
            $email->send();

        }

        public function executeReporteCircularEmail() {
            $parametro = Doctrine::getTable("Parametro")->find(array("CU067",1,"defaultEmails"));
            if ($parametro) {
                if (stripos($parametro->getCaValor2(), ',') !== false) {
                    $defaultEmail = explode(",", $parametro->getCaValor2());
                }else {
                    $defaultEmail = array($parametro->getCaValor2());
                }
            }
            $parametro = Doctrine::getTable("Parametro")->find(array("CU067",2,"ccEmails"));
            if ($parametro) {
                if (stripos($parametro->getCaValor2(), ',') !== false) {
                    $ccEmails = explode(",", $parametro->getCaValor2());
                }else {
                    $ccEmails = array($parametro->getCaValor2());
                }
            }

            $comerciales = UsuarioTable::getComerciales();
            foreach( $comerciales as $comercial ) {

                $email = new Email();
                $email->setCaUsuenvio( "Administrador" );
                $email->setCaTipo( "CircularClientes" );
                $email->setCaIdcaso( "1" );
                $email->setCaFrom( "admin@coltrans.com.co" );
                $email->setCaFromname( "Administrador Sistema Colsys" );
                $email->setCaReplyto( "admin@coltrans.com.co" );

                $email->addTo( $comercial->getCaEmail() );
                reset($defaultEmail);
                while (list ($clave, $val) = each ($defaultEmail)) {
                    $email->addCc( $val );
                }
                reset($ccEmails);
                while (list ($clave, $val) = each ($ccEmails)) {
                    $email->addCc( $val );
                }

                $inicio =  $this->getRequestParameter("fchStart");
                $final =  $this->getRequestParameter("fchEnd");
                $sucursal = $comercial->getCaSucursal();
                $vendedor = $comercial->getCaLogin();

                $this->getRequest()->setParameter("fchStart", $inicio);
                $this->getRequest()->setParameter("fchEnd", $final);
                $this->getRequest()->setParameter("sucursal", $sucursal);
                $this->getRequest()->setParameter("vendedor", $vendedor);

                $this->getRequest()->setParameter("layout", "email");

                $email->setCaSubject( "Clientes Activos con Vencimiento de Circular 170 a : $inicio - $vendedor" );
                $email->setCaBodyhtml(  sfContext::getInstance()->getController()->getPresentationFor( 'clientes', 'reporteCircular') );

                $email->save();
                $email->send();

            }

        }

	public function executeReporteListaClinton(){
            $this->setLayout("email");
            try {               //  Controla cualquier error el la ejecución de la rutina
                set_time_limit(0);
                echo "\n\nInicio el proceso : ".date("h:i:s A")."\n\n";

                $file =  sfConfig::get('sf_root_dir').DIRECTORY_SEPARATOR."tmp".DIRECTORY_SEPARATOR."clinton.xml";
                sfConfig::set("sf_web_debug", false);

                $url = "http://www.treas.gov/offices/enforcement/ofac/sdn/sdn.xml";
                unlink($file);

                $handleLocal = fopen($file, 'x');
                //Descarga el archivo
                $handle = fopen($url, 'r');
                while (!feof($handle)) {
                    $data = fgets($handle, 512);
                    if (fwrite($handleLocal, $data) === FALSE) {
                        echo "No se puede escribir al archivo ($nombre_archivo)";
                        exit;
                    }
                }
                fclose($handle);
                echo "Temina Lectura de Archivo Plano desde la Pagina Web www.treas.gov : ".date("h:i:s A")."\n\n";

                echo "Inicia Seleccion de Registro para Colombia y Carga de tablas : ".date("h:i:s A")."\n\n";
                /*Extrae los datos y los coloca*/

                $doc = new DOMDocument();
                $doc->load( $file );
                foreach( $doc->childNodes as $sdnEntryTag ) {
                    if ( $sdnEntryTag->nodeName != '#text' ) {
                        foreach( $sdnEntryTag->childNodes as $item ) {
                            $colombia = false;								// Bandera para determinar si el elemento tiene que ver con Colombia
                            $nuevo = false;
                            if ( $item->nodeName == 'publshInformation' ) {
                                foreach( $item->childNodes as $element ) {
                                    if ( $element->nodeName == 'Publish_Date' ) {		// Captura la Fecha de Publicación del Archivo
                                        $ultimo = Doctrine::getTable("Parametro")->find(array("CU065",1,"publishInformation"));
                                        if ($ultimo->getCaValor2() == $element->nodeValue) { // Compara con el Caso de Uso
                                            die('Finaliza sin Actualizaciones');
                                        }else {
                                            SdnTable::eliminarRegistros();				// Crea objeto Sdn solo para invocar método que limpia las tablas
                                            $nueva_fecha = $element->nodeValue;
                                        }
                                    }
                                }
                            }
                            if ( $item->nodeName == 'sdnEntry' ) {
                                $nuevo = true;
                                $sdnEntry = array();							// Inicializa el arreglo
                                $sdnIdList = array();
                                $sdnAkaList = array();
                                $sdnAddressList = array();
                                foreach( $item->childNodes as $element ) {
                                    if ( $element->nodeName == 'uid' ) {					// Toma el uid del registro a evaluar
                                        $sdnEntry['uid'] = $element->nodeValue;
                                    }else if ( $element->nodeName == 'firstName' ) {		// Evalua por el Apellidos de la Persona o Nombre de Empresa
                                        $sdnEntry[$element->nodeName] = $element->nodeValue;
                                    }else if ( $element->nodeName == 'lastName' ) {		// Evalua por el Apellidos de la Persona o Nombre de Empresa
                                        $sdnEntry[$element->nodeName] = $element->nodeValue;
                                    }else if ( $element->nodeName == 'title' ) {
                                        $sdnEntry[$element->nodeName] = $element->nodeValue;
                                    }else if ( $element->nodeName == 'sdnType' ) {
                                        $sdnEntry[$element->nodeName] = $element->nodeValue;
                                    }else if ( $element->nodeName == 'remarks' ) {
                                        $sdnEntry[$element->nodeName] = $element->nodeValue;

                                    }else if ( $element->nodeName == 'idList' ) {       // Evalua el elemento por su lista de Identificaciones
                                        foreach( $element->childNodes as $subelement ) {
                                            if ( $subelement->hasChildNodes() ) {
                                                foreach( $subelement->childNodes as $sub2element ) {
                                                    if ( $sub2element->nodeName == 'uid' ) {
                                                        $uid = $sub2element->nodeValue;
                                                    }else if ( $sub2element->nodeName == 'idType' ) {
                                                        $sdnIdList[$uid][$sub2element->nodeName] = $sub2element->nodeValue;
                                                    }else if ( $sub2element->nodeName == 'idNumber' ) {
                                                        $sdnIdList[$uid][$sub2element->nodeName] = $sub2element->nodeValue;
                                                    }else if ( $sub2element->nodeName == 'idCountry' ) {
                                                        $sdnIdList[$uid][$sub2element->nodeName] = $sub2element->nodeValue;
                                                        $colombia = ($sub2element->nodeValue == 'Colombia')?true:$colombia;
                                                    }else if ( $sub2element->nodeName == 'issueDate' ) {
                                                        $sdnIdList[$uid][$sub2element->nodeName] = $sub2element->nodeValue;
                                                    }else if ( $sub2element->nodeName == 'expirationDate' ) {
                                                        $sdnIdList[$uid][$sub2element->nodeName] = $sub2element->nodeValue;
                                                    }
                                                }
                                            }
                                        }
                                    }else if ( $element->nodeName == 'akaList' ) {       // Evalua el elemento por su lista de Homónimos
                                        foreach( $element->childNodes as $subelement ) {
                                            if ( $subelement->hasChildNodes() ) {
                                                foreach( $subelement->childNodes as $sub2element ) {
                                                    if ( $sub2element->nodeName == 'uid' ) {
                                                        $uid = $sub2element->nodeValue;
                                                    }else if ( $sub2element->nodeName == 'type' ) {
                                                        $sdnAkaList[$uid][$sub2element->nodeName] = $sub2element->nodeValue;
                                                    }else if ( $sub2element->nodeName == 'category' ) {
                                                        $sdnAkaList[$uid][$sub2element->nodeName] = $sub2element->nodeValue;
                                                    }else if ( $sub2element->nodeName == 'lastName' ) {
                                                            $sdnAkaList[$uid][$sub2element->nodeName] = $sub2element->nodeValue;
                                                    }else if ( $sub2element->nodeName == 'firstName' ) {
                                                            $sdnAkaList[$uid][$sub2element->nodeName] = $sub2element->nodeValue;
                                                    }
                                                }
                                            }
                                        }
                                    }else if ( $element->nodeName == 'addressList' ) {  // Evalua el elemento por su lista de Direcciones
                                        foreach( $element->childNodes as $subelement ) {
                                            if ( $subelement->hasChildNodes() ) {
                                                foreach( $subelement->childNodes as $sub2element ) {
                                                    if ( $sub2element->nodeName == 'uid' ) {
                                                        $uid = $sub2element->nodeValue;
                                                    }else if ( $sub2element->nodeName == 'address1' ) {
                                                        $sdnAddressList[$uid][$sub2element->nodeName] = $sub2element->nodeValue;
                                                    }else if ( $sub2element->nodeName == 'address2' ) {
                                                        $sdnAddressList[$uid][$sub2element->nodeName] = $sub2element->nodeValue;
                                                    }else if ( $sub2element->nodeName == 'address3' ) {
                                                        $sdnAddressList[$uid][$sub2element->nodeName] = $sub2element->nodeValue;
                                                    }else if ( $sub2element->nodeName == 'city' ) {
                                                        $sdnAddressList[$uid][$sub2element->nodeName] = $sub2element->nodeValue;
                                                    }else if ( $sub2element->nodeName == 'stateOrProvince' ) {
                                                        $sdnAddressList[$uid]['state'] = $sub2element->nodeValue;
                                                    }else if ( $sub2element->nodeName == 'postalCode' ) {
                                                            $sdnAddressList[$uid]['postal'] = $sub2element->nodeValue;
                                                    }else if ( $sub2element->nodeName == 'country' ) {
                                                            $sdnAddressList[$uid][$sub2element->nodeName] = $sub2element->nodeValue;
                                                            $colombia = ($sub2element->nodeValue == 'Colombia')?true:$colombia;
                                                    }
                                                }
                                            }
                                        }
                                    }else if ( $element->nodeName == 'nationalityList' ) {  // Evalua el elemento por su lista de Direcciones
                                        foreach( $element->childNodes as $subelement ) {
                                            if ( $subelement->hasChildNodes() ) {
                                                foreach( $subelement->childNodes as $sub2element ) {
                                                    if ( $sub2element->nodeName == 'country' ) {
                                                        $colombia = ($sub2element->nodeValue == 'Colombia')?true:$colombia;
                                                    }
                                                }
                                            }
                                        }
                                    }else if ( $element->nodeName == 'citizenshipList' ) {  // Evalua el elemento por su lista de Direcciones
                                        foreach( $element->childNodes as $subelement ) {
                                            if ( $subelement->hasChildNodes() ) {
                                                foreach( $subelement->childNodes as $sub2element ) {
                                                    if ( $sub2element->nodeName == 'country' ) {
                                                        $colombia = ($sub2element->nodeValue == 'Colombia')?true:$colombia;
                                                    }
                                                }
                                            }
                                        }
                                    }else if ( $element->nodeName == 'dateOfBirthList' ) {  // No hace Nada
                                        foreach( $element->childNodes as $subelement ) {
                                            if ( $subelement->hasChildNodes() ) {
                                                foreach( $subelement->childNodes as $sub2element ) {
                                                }
                                            }
                                        }
                                    }else if ( $element->nodeName == 'placeOfBirthList' ) {  // Evalua el elemento por su lista de Direcciones
                                        foreach( $element->childNodes as $subelement ) {
                                            if ( $subelement->hasChildNodes() ) {
                                                foreach( $subelement->childNodes as $sub2element ) {
                                                    if ( $sub2element->nodeName == 'placeOfBirth' ) {
                                                        $colombia = (strpos($sub2element->nodeValue, 'Colombia') !== false)?true:$colombia;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                            if ($nuevo and $colombia) {
                                $id = $sdnEntry['uid'];
                                $sdnEntryObj = new Sdn();
                                while (list ($clave, $val) = each ($sdnEntry)) {
                                    $campo = "setCa".ucfirst(strtolower($clave));

                                    $sdnEntryObj->$campo($val);
                                }
                                $sdnEntryObj->save();

                                if (count($sdnIdList) != 0) {
                                    while (list ($sub_id, $arreglo) = each ($sdnIdList)) {
                                        $sdnIdListObj = new SdnId();
                                        $sdnIdListObj->setCaUid($id);
                                        $sdnIdListObj->setCaUidId($sub_id);
                                        while (list ($clave, $val) = each ($arreglo)) {
                                            $campo = "setCa".ucfirst(strtolower($clave));
                                            $sdnIdListObj->$campo($val);
                                        }
                                        $sdnIdListObj->save();
                                    }
                                }
                                if (count($sdnAkaList) != 0) {
                                    while (list ($sub_id, $arreglo) = each ($sdnAkaList)) {
                                        $sdnAkaListObj = new SdnAka();
                                        $sdnAkaListObj->setCaUid($id);
                                        $sdnAkaListObj->setCaUidAka($sub_id);
                                        while (list ($clave, $val) = each ($arreglo)) {
                                            $campo = "setCa".ucfirst(strtolower($clave));
                                            $sdnAkaListObj->$campo($val);
                                        }
                                        $sdnAkaListObj->save();
                                    }
                                }
                                if (count($sdnAddressList) != 0) {
                                    while (list ($sub_id, $arreglo) = each ($sdnAddressList)) {
                                        $sdnAddressListObj = new SdnAddress();
                                        $sdnAddressListObj->setCaUid($id);
                                        $sdnAddressListObj->setCaUidAddress($sub_id);
                                        while (list ($clave, $val) = each ($arreglo)) {
                                            $campo = "setCa".ucfirst(strtolower($clave));
                                            $sdnAddressListObj->$campo($val);
                                        }
                                        $sdnAddressListObj->save();
                                    }
                                }
                                $nuevo = false;
                            }

                        }
                    }
                    else {
                        print_r($sdnEntryTag);
                    }
                }


                echo "Termina Carga de tablas : ".date("h:i:s A")."\n\n";

                echo "Inicia comparativo con Maestra de Clientes: ".date("h:i:s A")."\n\n";
                $stmt = SdnTable::evaluaClientes();
                $ven_mem = null;
                $msn_mem = '';
                $tit_mem = array("ca_idcliente","ca_compania","ca_nombres","ca_papellido","ca_sapellido","ca_vendedor", "sdnm_uid","sdnm_firstname","sdnm_lastname","sdnm_title","sdnm_sdntype","sdnm_remarks","sdid_uid_id","sdid_idtype","sdid_idnumber","sdid_idcountry","sdid_issuedate","sdid_expirationdate","sdal_uid_aka","sdal_type","sdal_category","sdal_firstname","sdal_lastname","sdak_uid_aka","sdak_type","sdak_category","sdak_firstname","sdak_lastname");

                $parametro = Doctrine::getTable("Parametro")->find(array("CU065",2,"defaultEmails"));
                if (stripos($parametro->getCaValor2(), ',') !== false) {
                    $defaultEmail = explode(",", $parametro->getCaValor2());
                }else {
                    $defaultEmail = array($parametro->getCaValor2());
                }
                $parametro = Doctrine::getTable("Parametro")->find(array("CU065",3,"ccEmails"));
                if (stripos($parametro->getCaValor2(), ',') !== false) {
                    $ccEmails = explode(",", $parametro->getCaValor2());
                }else {
                    $ccEmails = array($parametro->getCaValor2());
                }

                $x = 0;
                while($row = $stmt->fetch()) {
                    if ($row["ca_vendedor"] !== $ven_mem) {
                        if ($msn_mem != '') {
                            $msn_mem.= "</table>";
                            $msn_mem.= "<br / >Fin del Reporte.";
                            reset($ccEmails);
                            while (list ($clave, $val) = each ($ccEmails)) {
                                $email->addCc( $val );
                            }
                            $email->setCaSubject( "Verificación Clientes en Lista Clinton - $ven_mem" );
                            $email->setCaBodyhtml( $msn_mem );
                            $email->save(); //guarda el cuerpo del mensaje
                            $email->send(); //envia el mensaje de correo
                        }
                        if ($row["ca_vendedor"] != '') {
                            $user = Doctrine::getTable("Usuario")->find($row["ca_vendedor"]);
                        }else {
                            $user = new Usuario();
                        }

                        //Crea el correo electronico
                        $email = new Email();
                        $email->setCaUsuenvio( "Administrador" );
                        $email->setCaTipo( "SDNList Compair" );
                        $email->setCaIdcaso( "1" );
                        $email->setCaFrom( "admin@coltrans.com.co" );
                        $email->setCaFromname( "Administrador Sistema Colsys" );
                        $email->setCaReplyto( "admin@coltrans.com.co" );

                        if ( !$user->getCaEmail() ) {
                            while (list ($clave, $val) = each ($defaultEmail)) {
                                $email->addTo( $val );
                            }
                        }else{
                            $email->addTo( $user->getCaEmail() );
                        }
                        $ven_mem = $row["ca_vendedor"];
                        $msn_mem = "El sistema ha encontrado algunas similitudes en su listado de Clientes, comparado con la Lista Clinton del día $nueva_fecha. Favor hacer la respectivas verificaciones y tomar acción en caso de que un cliente haya sido reportado.";
                        $msn_mem.= "<br />";
                        $msn_mem.= "<table width='90%' cellspacing='1' border='1'>";
                        $msn_mem.= "	<tr>";
                        for($i=0; $i<count($tit_mem); $i++) {
                            $msn_mem.= "	<th>".$tit_mem[$i]."</th>";
                        }
                        $msn_mem.= "	</tr>";
                    }
                    $msn_mem.= "	<tr>";
                    for($i=0; $i<count($tit_mem); $i++) {
                        $msn_mem.= "	<td>".$row[$tit_mem[$i]]."</td>";
                    }
                    $msn_mem.= "	</tr>";
                }
                $msn_mem.= "</table>";
                $msn_mem.= "<br / >Fin del Reporte.";

                reset($ccEmails);
                while (list ($clave, $val) = each ($ccEmails)) {
                    $email->addCc( $val );
                }
                $email->setCaSubject( "Verificación Clientes en Lista Clinton - ".$ven_mem );
                $email->setCaBodyhtml( $msn_mem );
                $email->save(); //guarda el cuerpo del mensaje
                $email->send(); //envia el mensaje de correo

                if (isset($ultimo)) {
                    $ultimo->setCaValor2($nueva_fecha);
                    $ultimo->save();
                }
                echo "Finaliza comparativo con Maestra de Clientes: ".date("h:i:s A")."\n\n";
                echo "\n \n Fin del Proceso de Importación \n\n";

            } catch (Exception $e) {

                echo $e->getMessage()."\n\n".$e->getTraceAsString();
                $usuarios = Doctrine::getTable("Usuario")
                          ->createQuery("u")
                          ->innerJoin("u.UsuarioPerfil p")
                          ->where("p.ca_perfil = ? ", "sistemas")
                          ->execute();
                /*$parametro = Doctrine::getTable("Parametro")->find(array("CU065",3,"ccEmails"));
                if (stripos($parametro->getCaValor2(), ',') !== false) {
                    $ccEmails = explode(",", $parametro->getCaValor2());
                }else {
                    $ccEmails = array($parametro->getCaValor2());
                }*/

                //Crea el correo electronico
                $email = new Email();
                $email->setCaUsuenvio( "Administrador" );
                $email->setCaTipo( "SDNList Compair" );
                $email->setCaIdcaso( "1" );
                $email->setCaFrom( "admin@coltrans.com.co" );
                $email->setCaFromname( "Administrador Sistema Colsys" );
                $email->setCaReplyto( "admin@coltrans.com.co" );

                foreach($usuarios as $usuario ){
                    $email->addTo( $usuario->getCaEmail() );
                }
                /*reset($ccEmails);
                while (list ($clave, $val) = each ($ccEmails)) {
                    $email->addTo( $val );
                }*/

                $email->setCaSubject( "¡Error en la Verificación con Lista Clinton!" );
                $email->setCaBodyhtml( "Caught exception: ". $e->getMessage()."\n\n".$e->getTraceAsString()."\n\n Se ha presentado un error en el proceso que lee la información de Lista Clinton y la compara con la Maestra de Clientes Activos de COLSYS. Agradecemos confirmar que el Departamento de Sistemas esté enterado de esta falla. Gracias!" );
                $email->save(); //guarda el cuerpo del mensaje
                $email->send(); //envia el mensaje de correo

            }
        }
}
?>
