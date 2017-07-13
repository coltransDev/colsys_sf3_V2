<?php

/**
 * ids components.
 *
 * @package    colsys
 * @subpackage ids
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class idsComponents extends sfComponents {

    /**
     * Muestra los contactos
     *  
     */
    public function executeContactos() {
        $this->sucursales = Doctrine::getTable("IdsSucursal")
                ->createQuery("c")
                ->innerJoin("c.Ciudad ci")
                ->where("c.ca_id = ?", $this->ids->getCaId())
                ->addWhere("c.ca_fcheliminado IS NULL")
                ->addOrderBy("c.ca_principal DESC")
                ->addOrderBy("ci.ca_ciudad ASC")
                ->execute();

        $this->user = $this->getUser();
    }

    /**
     * Muestra los documentos
     *
     */
    public function executeDocumentos() {

        $documentos = Doctrine::getTable("IdsDocumento")
                ->createQuery("d")
                ->innerJoin("d.IdsTipoDocumento td")
                ->where("d.ca_id = ?", $this->ids->getCaId())
                ->addOrderBy("td.ca_tipo ASC")
                ->addOrderBy("d.ca_fchcreado ASC")
                ->execute();


        $this->documentos = array();
        foreach ($documentos as $documento) {
            if (!isset($this->documentos[$documento->getCaIdtipo()])) {
                $this->documentos[$documento->getCaIdtipo()] = array();
            }
            $this->documentos[$documento->getCaIdtipo()] = $documento;
        }



        $this->user = $this->getUser();

        if ($this->ids->getIdsProveedor()) {
            $tipo = $this->ids->getIdsProveedor()->getIdsTipo();
            $this->documentosPorTipo = $tipo->getIdsDocumentoPorTipo();
        } else {
            $this->documentosPorTipo = null;
        }
    }

    /**
     * Muestra las evaluaciones
     *
     */
    public function executeEvaluaciones() {
        $this->evaluaciones = Doctrine::getTable("IdsEvaluacion")
                ->createQuery("e")
                ->where("e.ca_id=?", $this->ids->getCaId())
                ->addOrderBy("e.ca_fchevaluacion")
                ->execute();
    }

    /**
     * Muestra los eventos
     *
     */
    public function executeEventos() {
        $this->eventos = Doctrine::getTable("IdsEvento")
                ->createQuery("e")
                ->where("e.ca_id=?", $this->ids->getCaId())
                ->addOrderBy("e.ca_fchcreado ASC")
                ->execute();
    }

    /**
     * Muestra los eventos
     *
     */
    public function executeGrupos() {
        $this->grupos = Doctrine::getTable("Ids")
                ->createQuery("id")
                ->where("id.ca_idgrupo=?", $this->ids->getCaId())
                ->addWhere("id.ca_id!=?", $this->ids->getCaId())
                ->addOrderBy("id.ca_nombre ASC")
                ->execute();

        if ($this->ids->getCaId() != $this->ids->getCaIdgrupo()) {
            $this->cabezaGrupo = Doctrine::getTable("Ids")->find($this->ids->getCaIdgrupo());
        }
    }

    /**
     * Muestra los bancos
     *
     */
    public function executeBancos() {
        $this->bancos = Doctrine::getTable("IdsBanco")
                ->createQuery("b")
                ->where("b.ca_id=?", $this->ids->getCaId())
                ->addOrderBy("b.ca_codigo_entidad ASC")
                ->execute();
    }

}
