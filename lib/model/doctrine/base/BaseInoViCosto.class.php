<?php

/**
 * BaseInoViCosto
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idmaster
 * @property string $ca_referencia
 * @property float $ca_valor
 * @property float $ca_venta
 * @property InoMaster $InoMaster
 * 
 * @method integer    getCaIdmaster()    Returns the current record's "ca_idmaster" value
 * @method string     getCaReferencia()  Returns the current record's "ca_referencia" value
 * @method float      getCaValor()       Returns the current record's "ca_valor" value
 * @method float      getCaVenta()       Returns the current record's "ca_venta" value
 * @method InoMaster  getInoMaster()     Returns the current record's "InoMaster" value
 * @method InoViCosto setCaIdmaster()    Sets the current record's "ca_idmaster" value
 * @method InoViCosto setCaReferencia()  Sets the current record's "ca_referencia" value
 * @method InoViCosto setCaValor()       Sets the current record's "ca_valor" value
 * @method InoViCosto setCaVenta()       Sets the current record's "ca_venta" value
 * @method InoViCosto setInoMaster()     Sets the current record's "InoMaster" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseInoViCosto extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ino.vi_costos');
        $this->hasColumn('ca_idmaster', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_referencia', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_valor', 'float', null, array(
             'type' => 'float',
             ));
        $this->hasColumn('ca_venta', 'float', null, array(
             'type' => 'float',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('InoMaster', array(
             'local' => 'ca_idmaster',
             'foreign' => 'ca_idmaster'));
    }
}