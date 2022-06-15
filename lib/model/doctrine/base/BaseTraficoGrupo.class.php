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
 * @method integer             getCaIdgrupo()      Returns the current record's "ca_idgrupo" value
 * @method string              getCaDescripcion()  Returns the current record's "ca_descripcion" value
 * @method Doctrine_Collection getTrafico()        Returns the current record's "Trafico" collection
 * @method TraficoGrupo        setCaIdgrupo()      Sets the current record's "ca_idgrupo" value
 * @method TraficoGrupo        setCaDescripcion()  Sets the current record's "ca_descripcion" value
 * @method TraficoGrupo        setTrafico()        Sets the current record's "Trafico" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
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

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Trafico', array(
             'local' => 'ca_idgrupo',
             'foreign' => 'ca_idgrupo'));
    }
}