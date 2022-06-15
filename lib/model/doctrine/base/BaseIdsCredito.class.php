<?php

/**
 * BaseIdsCredito
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idcredito
 * @property integer $ca_id
 * @property integer $ca_cupo
 * @property integer $ca_dias
 * @property string $ca_tipo
 * @property integer $ca_idempresa
 * @property boolean $ca_terceros
 * @property date $ca_fchgracia
 * @property string $ca_observaciones
 * @property string $ca_usucreado
 * @property timestamp $ca_fchcreado
 * @property string $ca_usuactualizado
 * @property timestamp $ca_fchactualizado
 * @property Ids $Ids
 * @property Empresa $Empresa
 * @property Usuario $Usuario
 * 
 * @method integer    getCaIdcredito()       Returns the current record's "ca_idcredito" value
 * @method integer    getCaId()              Returns the current record's "ca_id" value
 * @method integer    getCaCupo()            Returns the current record's "ca_cupo" value
 * @method integer    getCaDias()            Returns the current record's "ca_dias" value
 * @method string     getCaTipo()            Returns the current record's "ca_tipo" value
 * @method integer    getCaIdempresa()       Returns the current record's "ca_idempresa" value
 * @method boolean    getCaTerceros()        Returns the current record's "ca_terceros" value
 * @method date       getCaFchgracia()       Returns the current record's "ca_fchgracia" value
 * @method string     getCaObservaciones()   Returns the current record's "ca_observaciones" value
 * @method string     getCaUsucreado()       Returns the current record's "ca_usucreado" value
 * @method timestamp  getCaFchcreado()       Returns the current record's "ca_fchcreado" value
 * @method string     getCaUsuactualizado()  Returns the current record's "ca_usuactualizado" value
 * @method timestamp  getCaFchactualizado()  Returns the current record's "ca_fchactualizado" value
 * @method Ids        getIds()               Returns the current record's "Ids" value
 * @method Empresa    getEmpresa()           Returns the current record's "Empresa" value
 * @method Usuario    getUsuario()           Returns the current record's "Usuario" value
 * @method IdsCredito setCaIdcredito()       Sets the current record's "ca_idcredito" value
 * @method IdsCredito setCaId()              Sets the current record's "ca_id" value
 * @method IdsCredito setCaCupo()            Sets the current record's "ca_cupo" value
 * @method IdsCredito setCaDias()            Sets the current record's "ca_dias" value
 * @method IdsCredito setCaTipo()            Sets the current record's "ca_tipo" value
 * @method IdsCredito setCaIdempresa()       Sets the current record's "ca_idempresa" value
 * @method IdsCredito setCaTerceros()        Sets the current record's "ca_terceros" value
 * @method IdsCredito setCaFchgracia()       Sets the current record's "ca_fchgracia" value
 * @method IdsCredito setCaObservaciones()   Sets the current record's "ca_observaciones" value
 * @method IdsCredito setCaUsucreado()       Sets the current record's "ca_usucreado" value
 * @method IdsCredito setCaFchcreado()       Sets the current record's "ca_fchcreado" value
 * @method IdsCredito setCaUsuactualizado()  Sets the current record's "ca_usuactualizado" value
 * @method IdsCredito setCaFchactualizado()  Sets the current record's "ca_fchactualizado" value
 * @method IdsCredito setIds()               Sets the current record's "Ids" value
 * @method IdsCredito setEmpresa()           Sets the current record's "Empresa" value
 * @method IdsCredito setUsuario()           Sets the current record's "Usuario" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseIdsCredito extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ids.tb_creditos');
        $this->hasColumn('ca_idcredito', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_cupo', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_dias', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_tipo', 'string', 1, array(
             'type' => 'string',
             'length' => '1',
             ));
        $this->hasColumn('ca_idempresa', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_terceros', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_fchgracia', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_observaciones', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_usucreado', 'string', null, array(
             'type' => 'string',
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

        $this->hasOne('Empresa', array(
             'local' => 'ca_idempresa',
             'foreign' => 'ca_idempresa'));

        $this->hasOne('Usuario', array(
             'local' => 'ca_usuario',
             'foreign' => 'ca_login'));
    }
}