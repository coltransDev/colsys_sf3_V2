<?php

/**
 * BaseIntTransaccionesOut
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idtransaccion
 * @property integer $ca_idtipo
 * @property string $ca_indice1
 * @property string $ca_indice2
 * @property string $ca_indice3
 * @property string $ca_datos
 * @property string $ca_estado
 * @property date $ca_fchenvio
 * @property string $ca_respuesta
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property timestamp $ca_fchactualizado
 * @property string $ca_usuactualizado
 * @property IntTipos $IntTipos
 * 
 * @method integer             getCaIdtransaccion()   Returns the current record's "ca_idtransaccion" value
 * @method integer             getCaIdtipo()          Returns the current record's "ca_idtipo" value
 * @method string              getCaIndice1()         Returns the current record's "ca_indice1" value
 * @method string              getCaIndice2()         Returns the current record's "ca_indice2" value
 * @method string              getCaIndice3()         Returns the current record's "ca_indice3" value
 * @method string              getCaDatos()           Returns the current record's "ca_datos" value
 * @method string              getCaEstado()          Returns the current record's "ca_estado" value
 * @method date                getCaFchenvio()        Returns the current record's "ca_fchenvio" value
 * @method string              getCaRespuesta()       Returns the current record's "ca_respuesta" value
 * @method timestamp           getCaFchcreado()       Returns the current record's "ca_fchcreado" value
 * @method string              getCaUsucreado()       Returns the current record's "ca_usucreado" value
 * @method timestamp           getCaFchactualizado()  Returns the current record's "ca_fchactualizado" value
 * @method string              getCaUsuactualizado()  Returns the current record's "ca_usuactualizado" value
 * @method IntTipos            getIntTipos()          Returns the current record's "IntTipos" value
 * @method IntTransaccionesOut setCaIdtransaccion()   Sets the current record's "ca_idtransaccion" value
 * @method IntTransaccionesOut setCaIdtipo()          Sets the current record's "ca_idtipo" value
 * @method IntTransaccionesOut setCaIndice1()         Sets the current record's "ca_indice1" value
 * @method IntTransaccionesOut setCaIndice2()         Sets the current record's "ca_indice2" value
 * @method IntTransaccionesOut setCaIndice3()         Sets the current record's "ca_indice3" value
 * @method IntTransaccionesOut setCaDatos()           Sets the current record's "ca_datos" value
 * @method IntTransaccionesOut setCaEstado()          Sets the current record's "ca_estado" value
 * @method IntTransaccionesOut setCaFchenvio()        Sets the current record's "ca_fchenvio" value
 * @method IntTransaccionesOut setCaRespuesta()       Sets the current record's "ca_respuesta" value
 * @method IntTransaccionesOut setCaFchcreado()       Sets the current record's "ca_fchcreado" value
 * @method IntTransaccionesOut setCaUsucreado()       Sets the current record's "ca_usucreado" value
 * @method IntTransaccionesOut setCaFchactualizado()  Sets the current record's "ca_fchactualizado" value
 * @method IntTransaccionesOut setCaUsuactualizado()  Sets the current record's "ca_usuactualizado" value
 * @method IntTransaccionesOut setIntTipos()          Sets the current record's "IntTipos" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseIntTransaccionesOut extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('integracion.tb_transaccionesout');
        $this->hasColumn('ca_idtransaccion', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_idtipo', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_indice1', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));
        $this->hasColumn('ca_indice2', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));
        $this->hasColumn('ca_indice3', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));
        $this->hasColumn('ca_datos', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_estado', 'string', 10, array(
             'type' => 'string',
             'length' => '10',
             ));
        $this->hasColumn('ca_fchenvio', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_respuesta', 'string', null, array(
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
        $this->hasOne('IntTipos', array(
             'local' => 'ca_idtipo',
             'foreign' => 'ca_idtipo'));
    }
}