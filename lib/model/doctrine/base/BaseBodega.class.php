<?php

/**
 * BaseBodega
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idbodega
 * @property string $ca_nombre
 * @property string $ca_tipo
 * @property string $ca_transporte
 * @property Doctrine_Collection $Reporte
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 5845 2009-06-09 07:36:57Z jwage $
 */
abstract class BaseBodega extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_bodegas');
        $this->hasColumn('ca_idbodega', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_nombre', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_tipo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_transporte', 'string', null, array(
             'type' => 'string',
             ));
    }

    public function setUp()
    {
        $this->hasMany('Reporte', array(
             'local' => 'ca_idbodega',
             'foreign' => 'ca_idbodega'));
    }
}