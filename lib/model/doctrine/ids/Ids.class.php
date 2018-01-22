<?php

/**
 * Ids
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 5845 2009-06-09 07:36:57Z jwage $
 */
class Ids extends BaseIds {

    const FOLDER = "ids";

    private $idsProveedor = null;

    public function __toString() {
        return $this->getcaNombre();
    }

    /*
     *
     */

    public function getSucursalPrincipal() {
        return Doctrine::getTable("IdsSucursal")
                        ->createQuery("s")
                        ->where("s.ca_principal = ?", true)
                        ->addWhere("s.ca_id = ? ", $this->getCaId())
                        ->fetchOne();
    }

    /*
     *
     */

    public function getDocumento($idtipo) {

        return Doctrine::getTable("IdsDocumento")
                        ->createQuery("d")
                        ->select("d.*")
                        ->where("d.ca_idtipo = ?", $idtipo)
                        ->addWhere("d.ca_id = ?", $this->getCaId())
                        ->addOrderBy("d.ca_iddocumento DESC")
                        ->fetchOne();
    }

    public function getCalificaciones() {


        $result = array();
        $rows = Doctrine::getTable("IdsEvaluacion")
                ->createQuery("ev")
                ->innerJoin("ev.IdsEvaluacionxCriterio e")
                ->select("ev.ca_ano, ev.ca_periodo, SUM(e.ca_valor*e.ca_ponderacion )/SUM(e.ca_ponderacion ) as calificacion")
                ->addWhere("ev.ca_id = ?", $this->getCaId())
                ->addWhere("(ev.ca_tipo like 'desempeno%' or ev.ca_tipo like 'reevalua%')")
                // ->orWhere(" ?", )
                ->addGroupBy("ev.ca_ano, ev.ca_periodo")
                ->addOrderBy("ev.ca_ano, ev.ca_periodo")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();
        foreach ($rows as $row) {
            if ($row["ev_ca_periodo"]) {
                $per = $row["ev_ca_periodo"];
            } else {
                $per = 0;
            }
            $result[$row["ev_ca_ano"]][$per] = round($row["e_calificacion"], 1);
        }
        return $result;
    }

    public function getIdsProveedor() {
        if (!$this->idsProveedor) {
            $this->idsProveedor = Doctrine::getTable("IdsProveedor")->find($this->getCaId());
        }

        return $this->idsProveedor;
    }

    public function getConsultaListas($tipoConsulta) {
        $server = sfConfig::get("app_sinteParams_server");
        $username = sfConfig::get("app_sinteParams_username");
        $password = sfConfig::get("app_sinteParams_password");
        $percent = sfConfig::get("app_sinteParams_percent");

        ProjectConfiguration::registerZend();

        $client = new Zend_Http_Client();

        $uri = $server."/WS_COLTRANS/webresources/listas/consultar";
        $client->setUri($uri);

        $client->setAuth($username, $password, Zend_Http_Client::AUTH_BASIC);

        $client->setParameterGet('tipo_consulta', $tipoConsulta);
        if ($tipoConsulta == "DOCUMENTO") {
            $parametro = $this->getCaIdalterno();
            $client->setParameterGet('parametro', $parametro);
        } else {
            $parametro = $this->getCaNombre();
            $client->setParameterGet('parametro', $parametro);
            $client->setParameterGet('pcoincidencia', $percent);
        }
        $result = $client->request(Zend_Http_Client::GET);
        $json_response = json_decode($result->getBody());

        if ($json_response) {
            list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($json_response->fecha, "%d-%d-%dT%d:%d:%dZ");
            $id_response  = $json_response->id;
            $res_response = ($json_response->respuesta) ? $json_response->respuesta : null;
            $fch_response = date("Y-m-d H:i:s", mktime($hor-5, $min, $seg, $mes, $dia, $ano));
        } else {
            $id_response  = ($result->getMessage()) ? $result->getMessage() : null;
            $res_response = -1; // Indicador de Error
            $fch_response = date("Y-m-d h:i:s");
        }
        
        $consulta = new IdsRestrictivas();
        $consulta->setCaId($this->getCaId());
        $consulta->setCaTipoConsulta($tipoConsulta);
        $consulta->setCaParametro($parametro);
        $consulta->setCaIdrespuesta($id_response);
        $consulta->setCaRespuesta($res_response);
        $consulta->setCaFchconsultado($fch_response);
        $consulta->save();
        $consulta->enviarRespuesta();

        if ($this->getIdsCliente()) {   /* Consulta en Listas del Representante Legal del Cliente */
            if ($tipoConsulta == "DOCUMENTO") {
                $consulta->getConsultaListas($tipoConsulta, $this->getIdsCliente()->getCaNumidentificacionRl());
            } else {
                $nombre_rl = trim($this->getIdsCliente()->getCaNombres()." ".$this->getIdsCliente()->getCaPapellido()." ".$this->getIdsCliente()->getCaSapellido());
                $consulta->getConsultaListas($tipoConsulta, $nombre_rl);
            }
        }
        return $consulta;
    }

    public function getUltimaConsulta() {
        $fecha = null;
        $idsRestrictivas = Doctrine::getTable("IdsRestrictivas")
                ->createQuery("r")
                ->addWhere("r.ca_id = ?", $this->getCaId())
                ->orderBy("r.ca_fchconsultado DESC")
                ->limit(1)
                ->fetchOne();
        if ($idsRestrictivas) {
            $fecha = substr($idsRestrictivas->getCaFchconsultado(), 0, 19);
        }
        return $fecha;
    }

}
