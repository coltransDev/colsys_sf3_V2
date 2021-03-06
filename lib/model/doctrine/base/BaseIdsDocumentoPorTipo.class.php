<?php

/**
 * BaseIdsDocumentoPorTipo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_iddocumentosxtipo
 * @property integer $ca_idtipo
 * @property string $ca_tipo
 * @property boolean $ca_controladoxsig
 * @property string $ca_impoexpo
 * @property string $ca_transporte
 * @property boolean $ca_solo_si_aplica
 * @property IdsTipoDocumento $IdsTipoDocumento
 * @property IdsTipo $IdsTipo
 * 
 * @method integer             getCaIddocumentosxtipo()  Returns the current record's "ca_iddocumentosxtipo" value
 * @method integer             getCaIdtipo()             Returns the current record's "ca_idtipo" value
 * @method string              getCaTipo()               Returns the current record's "ca_tipo" value
 * @method boolean             getCaControladoxsig()     Returns the current record's "ca_controladoxsig" value
 * @method string              getCaImpoexpo()           Returns the current record's "ca_impoexpo" value
 * @method string              getCaTransporte()         Returns the current record's "ca_transporte" value
 * @method boolean             getCaSoloSiAplica()       Returns the current record's "ca_solo_si_aplica" value
 * @method IdsTipoDocumento    getIdsTipoDocumento()     Returns the current record's "IdsTipoDocumento" value
 * @method IdsTipo             getIdsTipo()              Returns the current record's "IdsTipo" value
 * @method IdsDocumentoPorTipo setCaIddocumentosxtipo()  Sets the current record's "ca_iddocumentosxtipo" value
 * @method IdsDocumentoPorTipo setCaIdtipo()             Sets the current record's "ca_idtipo" value
 * @method IdsDocumentoPorTipo setCaTipo()               Sets the current record's "ca_tipo" value
 * @method IdsDocumentoPorTipo setCaControladoxsig()     Sets the current record's "ca_controladoxsig" value
 * @method IdsDocumentoPorTipo setCaImpoexpo()           Sets the current record's "ca_impoexpo" value
 * @method IdsDocumentoPorTipo setCaTransporte()         Sets the current record's "ca_transporte" value
 * @method IdsDocumentoPorTipo setCaSoloSiAplica()       Sets the current record's "ca_solo_si_aplica" value
 * @method IdsDocumentoPorTipo setIdsTipoDocumento()     Sets the current record's "IdsTipoDocumento" value
 * @method IdsDocumentoPorTipo setIdsTipo()              Sets the current record's "IdsTipo" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseIdsDocumentoPorTipo extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ids.tb_documentosxtipo');
        $this->hasColumn('ca_iddocumentosxtipo', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_idtipo', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_tipo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_controladoxsig', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_impoexpo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_transporte', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_solo_si_aplica', 'boolean', null, array(
             'type' => 'boolean',
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('IdsTipoDocumento', array(
             'local' => 'ca_idtipo',
             'foreign' => 'ca_idtipo'));

        $this->hasOne('IdsTipo', array(
             'local' => 'ca_tipo',
             'foreign' => 'ca_tipo'));
    }
}