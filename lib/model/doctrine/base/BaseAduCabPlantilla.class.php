<?php

/**
 * BaseAduCabPlantilla
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_id_cab_plantilla
 * @property integer $ca_idcliente
 * @property Cliente $Cliente
 * @property AduDetPlantilla $AduDetPlantilla
 * 
 * @method integer         getCaIdCabPlantilla()    Returns the current record's "ca_id_cab_plantilla" value
 * @method integer         getCaIdcliente()         Returns the current record's "ca_idcliente" value
 * @method Cliente         getCliente()             Returns the current record's "Cliente" value
 * @method AduDetPlantilla getAduDetPlantilla()     Returns the current record's "AduDetPlantilla" value
 * @method AduCabPlantilla setCaIdCabPlantilla()    Sets the current record's "ca_id_cab_plantilla" value
 * @method AduCabPlantilla setCaIdcliente()         Sets the current record's "ca_idcliente" value
 * @method AduCabPlantilla setCliente()             Sets the current record's "Cliente" value
 * @method AduCabPlantilla setAduDetPlantilla()     Sets the current record's "AduDetPlantilla" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseAduCabPlantilla extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('aduana.tb_cab_plantilla');
        $this->hasColumn('ca_id_cab_plantilla', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_idcliente', 'integer', null, array(
             'type' => 'integer',
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

        $this->hasOne('AduDetPlantilla', array(
             'local' => 'ca_id_cab_plantilla',
             'foreign' => 'ca_id_cab_plantilla'));
    }
}