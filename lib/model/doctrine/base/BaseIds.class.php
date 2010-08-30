<?php

/**
 * BaseIds
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_id
 * @property integer $ca_dv
 * @property string $ca_idalterno
 * @property integer $ca_tipoidentificacion
 * @property integer $ca_idgrupo
 * @property string $ca_nombre
 * @property string $ca_website
 * @property string $ca_actividad
 * @property string $ca_sectoreco
 * @property string $ca_usucreado
 * @property timestamp $ca_fchcreado
 * @property string $ca_usuactualizado
 * @property timestamp $ca_fchactualizado
 * @property Doctrine_Collection $IdsSucursal
 * @property IdsAgente $IdsAgente
 * @property IdsProveedor $IdsProveedor
 * @property IdsEmpresa $IdsEmpresa
 * @property Doctrine_Collection $IdsDocumento
 * @property Doctrine_Collection $IdsEvento
 * @property Doctrine_Collection $IdsEvaluacion
 * @property Doctrine_Collection $InoComprobante
 * 
 * @method integer             getCaId()                  Returns the current record's "ca_id" value
 * @method integer             getCaDv()                  Returns the current record's "ca_dv" value
 * @method string              getCaIdalterno()           Returns the current record's "ca_idalterno" value
 * @method integer             getCaTipoidentificacion()  Returns the current record's "ca_tipoidentificacion" value
 * @method integer             getCaIdgrupo()             Returns the current record's "ca_idgrupo" value
 * @method string              getCaNombre()              Returns the current record's "ca_nombre" value
 * @method string              getCaWebsite()             Returns the current record's "ca_website" value
 * @method string              getCaActividad()           Returns the current record's "ca_actividad" value
 * @method string              getCaSectoreco()           Returns the current record's "ca_sectoreco" value
 * @method string              getCaUsucreado()           Returns the current record's "ca_usucreado" value
 * @method timestamp           getCaFchcreado()           Returns the current record's "ca_fchcreado" value
 * @method string              getCaUsuactualizado()      Returns the current record's "ca_usuactualizado" value
 * @method timestamp           getCaFchactualizado()      Returns the current record's "ca_fchactualizado" value
 * @method Doctrine_Collection getIdsSucursal()           Returns the current record's "IdsSucursal" collection
 * @method IdsAgente           getIdsAgente()             Returns the current record's "IdsAgente" value
 * @method IdsProveedor        getIdsProveedor()          Returns the current record's "IdsProveedor" value
 * @method IdsEmpresa          getIdsEmpresa()            Returns the current record's "IdsEmpresa" value
 * @method Doctrine_Collection getIdsDocumento()          Returns the current record's "IdsDocumento" collection
 * @method Doctrine_Collection getIdsEvento()             Returns the current record's "IdsEvento" collection
 * @method Doctrine_Collection getIdsEvaluacion()         Returns the current record's "IdsEvaluacion" collection
 * @method Doctrine_Collection getInoComprobante()        Returns the current record's "InoComprobante" collection
 * @method Ids                 setCaId()                  Sets the current record's "ca_id" value
 * @method Ids                 setCaDv()                  Sets the current record's "ca_dv" value
 * @method Ids                 setCaIdalterno()           Sets the current record's "ca_idalterno" value
 * @method Ids                 setCaTipoidentificacion()  Sets the current record's "ca_tipoidentificacion" value
 * @method Ids                 setCaIdgrupo()             Sets the current record's "ca_idgrupo" value
 * @method Ids                 setCaNombre()              Sets the current record's "ca_nombre" value
 * @method Ids                 setCaWebsite()             Sets the current record's "ca_website" value
 * @method Ids                 setCaActividad()           Sets the current record's "ca_actividad" value
 * @method Ids                 setCaSectoreco()           Sets the current record's "ca_sectoreco" value
 * @method Ids                 setCaUsucreado()           Sets the current record's "ca_usucreado" value
 * @method Ids                 setCaFchcreado()           Sets the current record's "ca_fchcreado" value
 * @method Ids                 setCaUsuactualizado()      Sets the current record's "ca_usuactualizado" value
 * @method Ids                 setCaFchactualizado()      Sets the current record's "ca_fchactualizado" value
 * @method Ids                 setIdsSucursal()           Sets the current record's "IdsSucursal" collection
 * @method Ids                 setIdsAgente()             Sets the current record's "IdsAgente" value
 * @method Ids                 setIdsProveedor()          Sets the current record's "IdsProveedor" value
 * @method Ids                 setIdsEmpresa()            Sets the current record's "IdsEmpresa" value
 * @method Ids                 setIdsDocumento()          Sets the current record's "IdsDocumento" collection
 * @method Ids                 setIdsEvento()             Sets the current record's "IdsEvento" collection
 * @method Ids                 setIdsEvaluacion()         Sets the current record's "IdsEvaluacion" collection
 * @method Ids                 setInoComprobante()        Sets the current record's "InoComprobante" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseIds extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ids.tb_ids');
        $this->hasColumn('ca_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_dv', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idalterno', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));
        $this->hasColumn('ca_tipoidentificacion', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idgrupo', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_nombre', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('ca_website', 'string', 60, array(
             'type' => 'string',
             'length' => '60',
             ));
        $this->hasColumn('ca_actividad', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_sectoreco', 'string', 30, array(
             'type' => 'string',
             'length' => '30',
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
        $this->hasMany('IdsSucursal', array(
             'local' => 'ca_id',
             'foreign' => 'ca_id'));

        $this->hasOne('IdsAgente', array(
             'local' => 'ca_id',
             'foreign' => 'ca_idagente'));

        $this->hasOne('IdsProveedor', array(
             'local' => 'ca_id',
             'foreign' => 'ca_idproveedor'));

        $this->hasOne('IdsEmpresa', array(
             'local' => 'ca_id',
             'foreign' => 'ca_idempresa'));

        $this->hasMany('IdsDocumento', array(
             'local' => 'ca_id',
             'foreign' => 'ca_id'));

        $this->hasMany('IdsEvento', array(
             'local' => 'ca_id',
             'foreign' => 'ca_id'));

        $this->hasMany('IdsEvaluacion', array(
             'local' => 'ca_id',
             'foreign' => 'ca_id'));

        $this->hasMany('InoComprobante', array(
             'local' => 'ca_id',
             'foreign' => 'ca_id'));
    }
}