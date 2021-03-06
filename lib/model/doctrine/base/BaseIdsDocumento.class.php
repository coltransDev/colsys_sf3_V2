<?php

/**
 * BaseIdsDocumento
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_iddocumento
 * @property integer $ca_id
 * @property integer $ca_idtipo
 * @property string $ca_ubicacion
 * @property string $ca_observaciones
 * @property date $ca_fchinicio
 * @property date $ca_fchvencimiento
 * @property string $ca_usucreado
 * @property timestamp $ca_fchcreado
 * @property string $ca_usuactualizado
 * @property timestamp $ca_fchactualizado
 * @property Ids $Ids
 * @property IdsTipoDocumento $IdsTipoDocumento
 * 
 * @method integer          getCaIddocumento()     Returns the current record's "ca_iddocumento" value
 * @method integer          getCaId()              Returns the current record's "ca_id" value
 * @method integer          getCaIdtipo()          Returns the current record's "ca_idtipo" value
 * @method string           getCaUbicacion()       Returns the current record's "ca_ubicacion" value
 * @method string           getCaObservaciones()   Returns the current record's "ca_observaciones" value
 * @method date             getCaFchinicio()       Returns the current record's "ca_fchinicio" value
 * @method date             getCaFchvencimiento()  Returns the current record's "ca_fchvencimiento" value
 * @method string           getCaUsucreado()       Returns the current record's "ca_usucreado" value
 * @method timestamp        getCaFchcreado()       Returns the current record's "ca_fchcreado" value
 * @method string           getCaUsuactualizado()  Returns the current record's "ca_usuactualizado" value
 * @method timestamp        getCaFchactualizado()  Returns the current record's "ca_fchactualizado" value
 * @method Ids              getIds()               Returns the current record's "Ids" value
 * @method IdsTipoDocumento getIdsTipoDocumento()  Returns the current record's "IdsTipoDocumento" value
 * @method IdsDocumento     setCaIddocumento()     Sets the current record's "ca_iddocumento" value
 * @method IdsDocumento     setCaId()              Sets the current record's "ca_id" value
 * @method IdsDocumento     setCaIdtipo()          Sets the current record's "ca_idtipo" value
 * @method IdsDocumento     setCaUbicacion()       Sets the current record's "ca_ubicacion" value
 * @method IdsDocumento     setCaObservaciones()   Sets the current record's "ca_observaciones" value
 * @method IdsDocumento     setCaFchinicio()       Sets the current record's "ca_fchinicio" value
 * @method IdsDocumento     setCaFchvencimiento()  Sets the current record's "ca_fchvencimiento" value
 * @method IdsDocumento     setCaUsucreado()       Sets the current record's "ca_usucreado" value
 * @method IdsDocumento     setCaFchcreado()       Sets the current record's "ca_fchcreado" value
 * @method IdsDocumento     setCaUsuactualizado()  Sets the current record's "ca_usuactualizado" value
 * @method IdsDocumento     setCaFchactualizado()  Sets the current record's "ca_fchactualizado" value
 * @method IdsDocumento     setIds()               Sets the current record's "Ids" value
 * @method IdsDocumento     setIdsTipoDocumento()  Sets the current record's "IdsTipoDocumento" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseIdsDocumento extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ids.tb_documentos');
        $this->hasColumn('ca_iddocumento', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idtipo', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_ubicacion', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('ca_observaciones', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('ca_fchinicio', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_fchvencimiento', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_usucreado', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));
        $this->hasColumn('ca_fchcreado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usuactualizado', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));
        $this->hasColumn('ca_fchactualizado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Ids', array(
             'local' => 'ca_id',
             'foreign' => 'ca_id'));

        $this->hasOne('IdsTipoDocumento', array(
             'local' => 'ca_idtipo',
             'foreign' => 'ca_idtipo'));
    }
}