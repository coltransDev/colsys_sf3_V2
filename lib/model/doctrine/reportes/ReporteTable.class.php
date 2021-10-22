<?php

/**
 */
class ReporteTable extends Doctrine_Table {
    /*
     * Retorna el siguiente consecutivo para los reportes
     * @author: Andres Botero
     */

    public static function siguienteConsecutivo($yy, $tmp_impoexpo, $tmp_transporte) {

        if ($yy) {
            $empresa = sfConfig::get('app_branding_name');
            $sql = "SELECT fun_reportecon('" . $yy . "') as next";
            /* if($empresa!='TPLogistics')
              {
              $sql =  "SELECT fun_reportecon('".$yy."') as next";
              }
              else
              {
              $sql =  "SELECT fun_reportecontp('".$yy."','".$tmp_impoexpo."','".$tmp_transporte."') as next";
              } */
            $q = Doctrine_Manager::getInstance()->connection();
            $stmt = $q->execute($sql);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['next'];
        }
    }

    /*
     * Retorna los reportes con estado distinto a carga entregada de acuerdo aun modo (impo, expo)
     * @author: Andres Botero
     */

    public static function getReportesActivos($idCliente, $impoexpo, $transporte = null, $query = false, $order = "", $historial = false) {
        $q = Doctrine_Query::create()
                ->from("Reporte r")
                ->select("r.*, o.*, d.*, t.*")
                ->innerJoin("r.Contacto c")
                ->innerJoin("c.Cliente cl")
                ->innerJoin("r.Origen o")
                ->innerJoin("r.Destino d")
                ->innerJoin("o.Trafico to")
                ->leftJoin("r.TrackingEtapa t")
                ->where("cl.ca_idgrupo = ? OR cl.ca_idcliente = ? ", array($idCliente, $idCliente))
                ->addWhere("r.ca_usuanulado IS NULL ");

        if ($impoexpo == Constantes::IMPO) {
            $q->addWhere("r.ca_impoexpo = ? OR r.ca_impoexpo = ? OR r.ca_impoexpo = ?", array(Constantes::IMPO, Constantes::TRIANGULACION, Constantes::OTMDTA));
        } else if ($impoexpo == Constantes::EXPO) {
            //(date_part( 'DAYS', now() - t.ca_fchcerrado )<75 or t.ca_fchcerrado is null)
            $q->addWhere("r.ca_impoexpo = ? AND (date_part( 'DAYS', now() - r.ca_fchcerrado )<75 or r.ca_fchcerrado is null) ", $impoexpo);
        } else {
            $q->addWhere("r.ca_impoexpo = ? ", $impoexpo);
        }

        if ($transporte) {

            if ($transporte == Constantes::MARITIMO || $transporte == "maritimo") {
                $tmp = "maritimo";
                $q->addWhere("r.ca_tiporep IN (1,2,3)");
                if ($impoexpo != Constantes::EXPO)
                    $q->addWhere(" r.ca_transporte = ? or r.ca_transporte = ? ", array(Constantes::MARITIMO, Constantes::TERRESTRE));
                else
                    $q->addWhere(" r.ca_transporte = ? ", array(Constantes::MARITIMO));
            }
            else if ($transporte == Constantes::AEREO || $transporte == "aereo")
                $q->addWhere("r.ca_transporte = ? ", Constantes::AEREO);
            else if ($transporte == Constantes::TERRESTRE || $transporte == "terrestre")
                $q->addWhere("r.ca_transporte = ? ", Constantes::TERRESTRE);
        }

        $cliente = Doctrine::getTable("Cliente")->find($idCliente);
        if (!$cliente) {
            $cliente = new Cliente();
        }

        $cierre_status_mes_completo = $cliente->getProperty("cierre_status_mes_completo");

        if ($cierre_status_mes_completo) {
            $fecha = date("Y-m-") . "01";
        } else {
            $dias_cierre_status = $cliente->getProperty("dias_cierre_status");
            if ($dias_cierre_status) {
                $numDays = $dias_cierre_status;
            } else {
                $numDays = 5;
            }

            $today = date("N");

            if ($today == 1) {
                $add = ($numDays * -1) - 2;
            } elseif ($today == 2) {
                $add = ($numDays * -1) - 1;
            } else {
                $add = ($numDays * -1);
            }
            $fecha = Utils::addDays(date("Y-m-d"), $add);
        }

        if ($historial) {
            $fecha = date("Y-m-d", time() - (86400 * 365)*2);
        }
        $q->addWhere("r.ca_fchultstatus>=? OR (r.ca_idetapa!= ? AND r.ca_idetapa!= ?) OR r.ca_idetapa IS NULL", array($fecha, "99999", "00000"));

        $orderByETS = false;
        //TODO parametrizar

        $defaultOrder = false;
        switch ($order) {
            case "orden":
                $q->addOrderBy("r.ca_orden_clie");
                break;
            case "xtrafico":
                $q->addOrderBy("to.ca_nombre");
                $q->addOrderBy("r.ca_modalidad");
                //$q->addOrderBy("r.ca_idproveedor");
                $q->addOrderBy("r.ca_orden_clie");
                $q->addOrderBy("r.ca_consecutivo");
                $q->addOrderBy("r.ca_version desc");
                break;
            default:
                /* $q->leftJoin("r.Proveedor p ON r.ca_idproveedor=p.ca_idtercero");
                  $q->addOrderBy("p.ca_nombre"); */
                //$q->addOrderBy("r.ca_idproveedor");
                $q->addOrderBy("r.ca_orden_clie");

                $q->addOrderBy("r.ca_consecutivo");
                $q->addOrderBy("r.ca_version desc");
                $defaultOrder = true;
                break;
        }


        if ($query) {
            return $q;
        } else {
            //echo $idCliente."-".$impoexpo."-".$transporte."-".$fecha."<br>";
            //echo $q->getSqlQuery();
            $reps = $q->execute();


            $k = count($reps);
            $results = array();
            for ($i = 0; $i < $k; $i++) {
                if ($reps[$i]->esUltimaVersion($tmp)) {
                    $results[] = $reps[$i];
                }
            }

            $orden_status_x_ets = $cliente->getProperty("orden_status_x_ets");

            if ($defaultOrder && !$orden_status_x_ets) {
                $k = count($results);
                for ($i = 1; $i < $k; $i++) {
                    for ($j = 0; $j < $k - 1; $j++) {
                        $prov1 = $results[$j]->getProveedoresStr();
                        $prov2 = $results[$j + 1]->getProveedoresStr();
                        if ($prov1 > $prov2) {
                            $tmp = $results[$j];
                            $results[$j] = $results[$j + 1];
                            $results[$j + 1] = $tmp;
                        }
                    }
                }
            }

            if ($orden_status_x_ets) { //Se ordena por orden y luego por ETS                
                $k = count($results);
                for ($i = 1; $i < $k; $i++) {
                    for ($j = 0; $j < $k - 1; $j++) {
                        $prov1 = $results[$j]->getETS();
                        $prov2 = $results[$j + 1]->getETS();
                        if ($prov1 < $prov2) {
                            $tmp = $results[$j];
                            $results[$j] = $results[$j + 1];
                            $results[$j + 1] = $tmp;
                        }
                    }
                }

                for ($i = 1; $i < $k; $i++) {
                    for ($j = 0; $j < $k - 1; $j++) {
                        $prov1 = $results[$j]->getCaOrdenClie();
                        $prov2 = $results[$j + 1]->getCaOrdenClie();
                        if ($prov1 > $prov2) {
                            $tmp = $results[$j];
                            $results[$j] = $results[$j + 1];
                            $results[$j + 1] = $tmp;
                        }
                    }
                }
                //Yo y mi bocota
            }

            //echo count($results);
            return $results;
        }
    }

    public static function retrieveByConsecutivo($consecutivo, $where = '') {

        //$tiporep

        $q = Doctrine::getTable("Reporte")
                ->createQuery("r")
                ->where("1=1 AND r.ca_consecutivo = ? $where", $consecutivo)
                ->addWhere("r.ca_fchanulado IS NULL")
                ->addOrderBy("r.ca_version DESC")
                ->limit(1);
        if (count($tiporep) > 0)
            $q->whereIn("ca_tiporep", $tiporep);
        $reporte = $q->fetchOne();

        return $reporte;
    }

}
