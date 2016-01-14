<?php

class AlertasExpoTask extends sfDoctrineBaseTask {

    protected function configure() {
        $this->namespace = 'colsys';
        $this->name = 'alertas-expo';
        $this->briefDescription = 'Alertas expo';
        $this->detailedDescription = <<<EOF
The [alertasExpo|INFO] task does things.
Call it with:

  [php symfony alertasExpo|INFO]
EOF;
        // add arguments here, like the following:
        //$this->addArgument('application', sfCommandArgument::REQUIRED, 'The application name');
        // add options here, like the following:
        //$this->addOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev');
    }

    protected function execute($arguments = array(), $options = array()) {
        $this->configuration = ProjectConfiguration::getApplicationConfiguration('colsys', 'cli', true);

        // Borra las dos líneas siguientes si no utilizas una base de datos
        $databaseManager = new sfDatabaseManager($this->configuration);
        $databaseManager->loadConfiguration();

        $hoy = date("Y-m-d");
        $alertas = Doctrine::getTable("ExpoAlerta")
                        ->createQuery("a")
                        ->addWhere("a.ca_fchrecordatorio <= ? and a.ca_fchvencimiento >= ?", array($hoy, $hoy))
                        ->execute();

        foreach ($alertas as $alerta) {
            $user = $alerta->getUsuario();
            $email = new Email();
            $email->setCaUsuenvio($user->getCaLogin());
            $email->setCaTipo("Alerta Expo");
            //$email->setCaIdcaso("");
            $email->setCaFrom("colsys@coltrans.com.co");
            $email->setCaFromname("Sistema de Alertas");

            if ($alerta->getCaFchvencimiento() == $hoy) {
                $txt = "Vencimiento";
                $mensaje = "La alerta asignada a " . $user->getCaNombre() . " vence hoy.\n\nInformación de la tarea : " . $alerta->getCaCuerpoalerta() . "\n\nFecha de Vencimiento : \n\n" . Utils::fechaMes($alerta->getCaFchvencimiento()) . "\n\n";
            } else {
                $txt = "Recordatorio";
                $mensaje = "Información de la tarea : " . $alerta->getCaCuerpoalerta() . "\n\nFecha de Vencimiento : \n\n" . Utils::fechaMes($alerta->getCaFchvencimiento()) . "\n\n";
            }
            $ref = $alerta->getInoMaestraExpo();
            $mensaje.="\nReferencia: ".$ref->getCaReferencia()."\n";
            $mensaje.="Cliente: ".$ref->getCliente()->getCaCompania()."\n";
            $mensaje.="Via: ".$ref->getCaVia()."\n";
            $mensaje.="Tipo Mercancia: ".$ref->getCaProducto()."\n";
            $mensaje.="Valor: ".$ref->getCaValorcarga()."\n\n\n";
            //$mensaje.="<br />Piezas: ".$ref->getCaValorcarga()."<br />";
            
            $email->setCaSubject($txt . " : ALERTA DE LA REFERENCIA " . $alerta->getCaReferencia());


            $email->setCaReplyto($user->getCaEmail());

            $email->addTo($user->getCaEmail());

            
            if( $alerta->getCaNotificar() ){
                $user2 = Doctrine::getTable("Usuario")->find( $alerta->getCaNotificar() );
                if( $user2 ){
                    $email->addTo($user2->getCaEmail());
                }
                
                if( $alerta->getCaNotificarJefe() ){
                    $user3 = $user2->getManager();
                    if( $user3 ){
                        $email->addTo($user3->getCaEmail());
                    }
                }
            }
            
            $email->setCaBody($mensaje . $user->getFirma());
            $email->setCaBodyhtml(Utils::replace($mensaje) . $user->getFirmaHtml());

            $email->save();
            //$email->send();
        }
    }

}