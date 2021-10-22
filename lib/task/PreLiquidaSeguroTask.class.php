<?php

class PreLiquidaSeguroTask extends sfDoctrineBaseTask {

    protected function configure() {
        $this->namespace = 'colsys';
        $this->name = 'pre-liquida-seguro';
        $this->briefDescription = 'Pre Liquidador de Seguros';
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
        sfContext::createInstance($this->configuration)->dispatch();

        // Borra las dos líneas siguientes si no utilizas una base de datos
        $databaseManager = new sfDatabaseManager($this->configuration);
        $databaseManager->loadConfiguration();

//        $conn = Doctrine_Manager::getInstance()->connection();
//        $conn->beginTransaction();

        $contador = array();
        $campo = "pre-liquidado";
        $sql = "select ca_idseguro from ino.tb_seguros where ca_usuactualizado is null and ca_usuanulado is null and ca_vlrasegurado = 0 and ca_neto_vlr = 0 and ca_venta_vlr = 0 and ca_datos->>'pre-liquidado'::text is null "
                . "order by ca_idseguro asc";
        $con = Doctrine_Manager::getInstance()->connection();
        $stmt = $con->execute($sql);
        $idseguros = $stmt->fetchAll(PDO::FETCH_COLUMN);
        if (count($idseguros)) {
//        try {
            $seguros = Doctrine::getTable("InoSeguro")
                    ->createQuery("s")
                    ->whereIn('s.ca_idseguro', $idseguros)
                    ->execute();
            foreach ($seguros as $seguro) {
                $datos = json_decode(utf8_encode($seguro->getCaDatos()));
                $datos->$campo = true;
                
                $seguro->valoresPorDefecto();
                if ($seguro->getCaVlrasegurado() != 0) {
                    $contador[] = $seguro->getCaIdseguro();
                    $seguro->setCaDatos(json_encode($datos));
                    $seguro->stopBlaming();
                    $seguro->save();
                }
                if ( count($contador) >= 10 ) {
                    print_r($contador);
                    break;
                }
            }
//            $conn->commit();
//            $this->responseArray = array("success" => true);
//        } catch (Exception $e) {
//            $conn->rollback();
//            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
//        }
        }
    }

}
