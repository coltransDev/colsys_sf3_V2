<?php

/**
 * BaseTraficoGrupo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idgrupo
 * @property string $ca_descripcion
 * @property Doctrine_Collection $Trafico
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 5845 2009-06-09 07:36:57Z jwage $
 */
abstract class BaseTraficoGrupo extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_grupos');
        $this->hasColumn('ca_idgrupo', 'integer', 2, array(
             'type' => 'integer',
             'unsigned' => false,
             'primary' => true,
             'length' => '2',
             ));
        $this->hasColumn('ca_descripcion', 'string', 40, array(
             'type' => 'string',
             'fixed' => 0,
             'notnull' => true,
             'primary' => false,
             'length' => '40',
             ));
    }

    public function setUp()
    {
        $this->hasMany('Trafico', array(
             'local' => 'ca_idgrupo',
             'foreign' => 'ca_idgrupo'));
    }
}