<?php

/**
 * IdsContacto
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 5845 2009-06-09 07:36:57Z jwage $
 */
class IdsContacto extends BaseIdsContacto {

    public function getNombre() {
        return ucwords(strtolower($this->getCaNombres() . " " . $this->getCaPapellido() . " " . $this->getCaSapellido()));
    }

    public function getCargo() {
        return ucwords(strtolower($this->getCaCargo()));
    }

    public function getDepartamento() {
        return ucwords(strtolower($this->getCaDepartamento()));
    }

    public function getCodigoarea() {
        $codigo = $this->getCaCodigoarea();
        if ($codigo) {
            return intval($codigo);
        } else {
            return $this->getIdsSucursal()->getCiudad()->getCodigoarea();
        }
    }

    public function getConsultaListas($tipoConsulta) {
        return (new IdsRestrictivas());
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
        $identificacion = $this->getCaIdentificacion();
        $nombre_completo = trim($this->getCaNombres())." ".trim($this->getCaPapellido()).(($this->getCaSapellido())?" ".$this->getCaSapellido():"");
        if ($tipoConsulta == "DOCUMENTO") {
            $parametro = $this->getCaIdentificacion();
            $client->setParameterGet('parametro', $parametro);
        } else {
            $parametro = $nombre_completo;
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
            $id_response  = null;
            $tipoConsulta = ($result->getMessage()) ? $result->getMessage() : null;
            $res_response = -1; // Indicador de Error
            $fch_response = date("Y-m-d H:i:s");
        }

        $consulta = new IdsRestrictivas();
        $consulta->setCaId($this->getIdsSucursal()->getIds()->getCaId());
        $consulta->setCaTipoConsulta($tipoConsulta);
        $consulta->setCaParametro($parametro);
        $consulta->setCaIdrespuesta($id_response);
        $consulta->setCaRespuesta($res_response);
        $consulta->setCaFchconsultado($fch_response);
        $consulta->save();
        $consulta->enviarRespuesta($identificacion, $nombre_completo);
        return $consulta;
    }

}
