<?php

/**
 * BaseRutinaNivel
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_rutina
 * @property integer $ca_nivel
 * @property string $ca_valor
 * @property Rutina $Rutina
 * 
 * @method integer     getCaRutina()  Returns the current record's "ca_rutina" value
 * @method integer     getCaNivel()   Returns the current record's "ca_nivel" value
 * @method string      getCaValor()   Returns the current record's "ca_valor" value
 * @method Rutina      getRutina()    Returns the current record's "Rutina" value
 * @method RutinaNivel setCaRutina()  Sets the current record's "ca_rutina" value
 * @method RutinaNivel setCaNivel()   Sets the current record's "ca_nivel" value
 * @method RutinaNivel setCaValor()   Sets the current record's "ca_valor" value
 * @method RutinaNivel setRutina()    Sets the current record's "Rutina" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseRutinaNivel extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('control.tb_rutinas_niveles');
        $this->hasColumn('ca_rutina', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_nivel', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_valor', 'string', null, array(
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
        $this->hasOne('Rutina', array(
             'local' => 'ca_rutina',
             'foreign' => 'ca_rutina'));
    }
}