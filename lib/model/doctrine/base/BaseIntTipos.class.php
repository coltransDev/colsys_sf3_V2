<?php

/**
 * BaseIntTipos
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idtipo
 * @property string $ca_nombre
 * @property string $ca_indice1
 * @property string $ca_indice2
 * @property string $ca_indice3
 * @property string $ca_modulo
 * @property integer $ca_tiempo
 * @property string $ca_metodo
 * @property Doctrine_Collection $IntTransaccionesOut
 * 
 * @method integer             getCaIdtipo()            Returns the current record's "ca_idtipo" value
 * @method string              getCaNombre()            Returns the current record's "ca_nombre" value
 * @method string              getCaIndice1()           Returns the current record's "ca_indice1" value
 * @method string              getCaIndice2()           Returns the current record's "ca_indice2" value
 * @method string              getCaIndice3()           Returns the current record's "ca_indice3" value
 * @method string              getCaModulo()            Returns the current record's "ca_modulo" value
 * @method integer             getCaTiempo()            Returns the current record's "ca_tiempo" value
 * @method string              getCaMetodo()            Returns the current record's "ca_metodo" value
 * @method Doctrine_Collection getIntTransaccionesOut() Returns the current record's "IntTransaccionesOut" collection
 * @method IntTipos            setCaIdtipo()            Sets the current record's "ca_idtipo" value
 * @method IntTipos            setCaNombre()            Sets the current record's "ca_nombre" value
 * @method IntTipos            setCaIndice1()           Sets the current record's "ca_indice1" value
 * @method IntTipos            setCaIndice2()           Sets the current record's "ca_indice2" value
 * @method IntTipos            setCaIndice3()           Sets the current record's "ca_indice3" value
 * @method IntTipos            setCaModulo()            Sets the current record's "ca_modulo" value
 * @method IntTipos            setCaTiempo()            Sets the current record's "ca_tiempo" value
 * @method IntTipos            setCaMetodo()            Sets the current record's "ca_metodo" value
 * @method IntTipos            setIntTransaccionesOut() Sets the current record's "IntTransaccionesOut" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseIntTipos extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('integracion.tb_tipos');
        $this->hasColumn('ca_idtipo', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_nombre', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_indice1', 'string', 30, array(
             'type' => 'string',
             'length' => '30',
             ));
        $this->hasColumn('ca_indice2', 'string', 30, array(
             'type' => 'string',
             'length' => '30',
             ));
        $this->hasColumn('ca_indice3', 'string', 30, array(
             'type' => 'string',
             'length' => '30',
             ));
        $this->hasColumn('ca_modulo', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));
        $this->hasColumn('ca_tiempo', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_metodo', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('IntTransaccionesOut', array(
             'local' => 'ca_idtipo',
             'foreign' => 'ca_idtipo'));
    }
}