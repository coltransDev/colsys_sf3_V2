<?php

/**
 * BaseRepAsignacion
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idreporte
 * @property integer $ca_idtarea
 * @property Reporte $Reporte
 * @property NotTarea $NotTarea
 * 
 * @method integer       getCaIdreporte()  Returns the current record's "ca_idreporte" value
 * @method integer       getCaIdtarea()    Returns the current record's "ca_idtarea" value
 * @method Reporte       getReporte()      Returns the current record's "Reporte" value
 * @method NotTarea      getNotTarea()     Returns the current record's "NotTarea" value
 * @method RepAsignacion setCaIdreporte()  Sets the current record's "ca_idreporte" value
 * @method RepAsignacion setCaIdtarea()    Sets the current record's "ca_idtarea" value
 * @method RepAsignacion setReporte()      Sets the current record's "Reporte" value
 * @method RepAsignacion setNotTarea()     Sets the current record's "NotTarea" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseRepAsignacion extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_repasignaciones');
        $this->hasColumn('ca_idreporte', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_idtarea', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));


        $this->setAttribute(Doctrine_Core::ATTR_EXPORT, Doctrine_Core::EXPORT_TABLES);

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Reporte', array(
             'local' => 'ca_idreporte',
             'foreign' => 'ca_idreporte'));

        $this->hasOne('NotTarea', array(
             'local' => 'ca_idtarea',
             'foreign' => 'ca_idtarea'));
    }
}