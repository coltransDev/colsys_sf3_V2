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
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6365 2009-09-15 18:22:38Z jwage $
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


        $this->setAttribute(Doctrine::ATTR_EXPORT, Doctrine::EXPORT_TABLES);
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