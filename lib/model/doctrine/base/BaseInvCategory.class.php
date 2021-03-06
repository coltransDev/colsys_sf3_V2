<?php

/**
 * BaseInvCategory
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idcategory
 * @property integer $ca_parent
 * @property string $ca_name
 * @property integer $ca_order
 * @property boolean $ca_main
 * @property string $ca_parameter
 * @property Doctrine_Collection $SubCategory
 * @property InvCategory $Parent
 * @property Doctrine_Collection $InvActivo
 * @property Doctrine_Collection $InvProducto
 * @property Doctrine_Collection $InvPrefijo
 * 
 * @method integer             getCaIdcategory()  Returns the current record's "ca_idcategory" value
 * @method integer             getCaParent()      Returns the current record's "ca_parent" value
 * @method string              getCaName()        Returns the current record's "ca_name" value
 * @method integer             getCaOrder()       Returns the current record's "ca_order" value
 * @method boolean             getCaMain()        Returns the current record's "ca_main" value
 * @method string              getCaParameter()   Returns the current record's "ca_parameter" value
 * @method Doctrine_Collection getSubCategory()   Returns the current record's "SubCategory" collection
 * @method InvCategory         getParent()        Returns the current record's "Parent" value
 * @method Doctrine_Collection getInvActivo()     Returns the current record's "InvActivo" collection
 * @method Doctrine_Collection getInvProducto()   Returns the current record's "InvProducto" collection
 * @method Doctrine_Collection getInvPrefijo()    Returns the current record's "InvPrefijo" collection
 * @method InvCategory         setCaIdcategory()  Sets the current record's "ca_idcategory" value
 * @method InvCategory         setCaParent()      Sets the current record's "ca_parent" value
 * @method InvCategory         setCaName()        Sets the current record's "ca_name" value
 * @method InvCategory         setCaOrder()       Sets the current record's "ca_order" value
 * @method InvCategory         setCaMain()        Sets the current record's "ca_main" value
 * @method InvCategory         setCaParameter()   Sets the current record's "ca_parameter" value
 * @method InvCategory         setSubCategory()   Sets the current record's "SubCategory" collection
 * @method InvCategory         setParent()        Sets the current record's "Parent" value
 * @method InvCategory         setInvActivo()     Sets the current record's "InvActivo" collection
 * @method InvCategory         setInvProducto()   Sets the current record's "InvProducto" collection
 * @method InvCategory         setInvPrefijo()    Sets the current record's "InvPrefijo" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseInvCategory extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('inv.tb_categories');
        $this->hasColumn('ca_idcategory', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_parent', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_name', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_order', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_main', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_parameter', 'string', null, array(
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
        $this->hasMany('InvCategory as SubCategory', array(
             'local' => 'ca_idcategory',
             'foreign' => 'ca_parent',
             'orderBy' => 'ca_order ASC'));

        $this->hasOne('InvCategory as Parent', array(
             'local' => 'ca_parent',
             'foreign' => 'ca_idcategory'));

        $this->hasMany('InvActivo', array(
             'local' => 'ca_idcategory',
             'foreign' => 'ca_idcategory'));

        $this->hasMany('InvProducto', array(
             'local' => 'ca_idcategory',
             'foreign' => 'ca_idcategoria'));

        $this->hasMany('InvPrefijo', array(
             'local' => 'ca_idcategory',
             'foreign' => 'ca_idcategory'));
    }
}