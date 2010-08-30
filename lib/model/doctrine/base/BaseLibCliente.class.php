<?php

/**
 * BaseLibCliente
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idcliente
 * @property integer $ca_diascredito
 * @property integer $ca_cupo
 * @property string $ca_observaciones
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property timestamp $ca_fchactualizado
 * @property string $ca_usuactualizado
 * @property Cliente $Cliente
 * 
 * @method integer    getCaIdcliente()       Returns the current record's "ca_idcliente" value
 * @method integer    getCaDiascredito()     Returns the current record's "ca_diascredito" value
 * @method integer    getCaCupo()            Returns the current record's "ca_cupo" value
 * @method string     getCaObservaciones()   Returns the current record's "ca_observaciones" value
 * @method timestamp  getCaFchcreado()       Returns the current record's "ca_fchcreado" value
 * @method string     getCaUsucreado()       Returns the current record's "ca_usucreado" value
 * @method timestamp  getCaFchactualizado()  Returns the current record's "ca_fchactualizado" value
 * @method string     getCaUsuactualizado()  Returns the current record's "ca_usuactualizado" value
 * @method Cliente    getCliente()           Returns the current record's "Cliente" value
 * @method LibCliente setCaIdcliente()       Sets the current record's "ca_idcliente" value
 * @method LibCliente setCaDiascredito()     Sets the current record's "ca_diascredito" value
 * @method LibCliente setCaCupo()            Sets the current record's "ca_cupo" value
 * @method LibCliente setCaObservaciones()   Sets the current record's "ca_observaciones" value
 * @method LibCliente setCaFchcreado()       Sets the current record's "ca_fchcreado" value
 * @method LibCliente setCaUsucreado()       Sets the current record's "ca_usucreado" value
 * @method LibCliente setCaFchactualizado()  Sets the current record's "ca_fchactualizado" value
 * @method LibCliente setCaUsuactualizado()  Sets the current record's "ca_usuactualizado" value
 * @method LibCliente setCliente()           Sets the current record's "Cliente" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseLibCliente extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_libcliente');
        $this->hasColumn('ca_idcliente', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_diascredito', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_cupo', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_observaciones', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchcreado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usucreado', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchactualizado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usuactualizado', 'string', null, array(
             'type' => 'string',
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Cliente', array(
             'local' => 'ca_idcliente',
             'foreign' => 'ca_idcliente'));
    }
}
