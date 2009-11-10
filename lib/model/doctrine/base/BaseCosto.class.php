<?php

/**
 * BaseCosto
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idcosto
 * @property string $ca_costo
 * @property string $ca_transporte
 * @property string $ca_impoexpo
 * @property string $ca_modalidad
 * @property string $ca_comisionable
 * @property Doctrine_Collection $RepCosto
 * 
 * @method integer             getCaIdcosto()       Returns the current record's "ca_idcosto" value
 * @method string              getCaCosto()         Returns the current record's "ca_costo" value
 * @method string              getCaTransporte()    Returns the current record's "ca_transporte" value
 * @method string              getCaImpoexpo()      Returns the current record's "ca_impoexpo" value
 * @method string              getCaModalidad()     Returns the current record's "ca_modalidad" value
 * @method string              getCaComisionable()  Returns the current record's "ca_comisionable" value
 * @method Doctrine_Collection getRepCosto()        Returns the current record's "RepCosto" collection
 * @method Costo               setCaIdcosto()       Sets the current record's "ca_idcosto" value
 * @method Costo               setCaCosto()         Sets the current record's "ca_costo" value
 * @method Costo               setCaTransporte()    Sets the current record's "ca_transporte" value
 * @method Costo               setCaImpoexpo()      Sets the current record's "ca_impoexpo" value
 * @method Costo               setCaModalidad()     Sets the current record's "ca_modalidad" value
 * @method Costo               setCaComisionable()  Sets the current record's "ca_comisionable" value
 * @method Costo               setRepCosto()        Sets the current record's "RepCosto" collection
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6508 2009-10-14 06:28:49Z jwage $
 */
abstract class BaseCosto extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_costos');
        $this->hasColumn('ca_idcosto', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_costo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_transporte', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_impoexpo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_modalidad', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_comisionable', 'string', null, array(
             'type' => 'string',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('RepCosto', array(
             'local' => 'ca_idcosto',
             'foreign' => 'ca_idcosto'));
    }
}