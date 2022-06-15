<?php

/**
 * BaseClarDetail
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_iddetail
 * @property integer $ca_idclariant
 * @property integer $ca_posicion
 * @property string $ca_material
 * @property string $ca_descripcion
 * @property decimal $ca_cantidad
 * @property decimal $ca_despacho
 * @property string $ca_unidad
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property timestamp $ca_fchactualizado
 * @property string $ca_usuactualizado
 * @property Clariant $Clariant
 * @property Doctrine_Collection $ClarNotify
 * 
 * @method integer             getCaIddetail()        Returns the current record's "ca_iddetail" value
 * @method integer             getCaIdclariant()      Returns the current record's "ca_idclariant" value
 * @method integer             getCaPosicion()        Returns the current record's "ca_posicion" value
 * @method string              getCaMaterial()        Returns the current record's "ca_material" value
 * @method string              getCaDescripcion()     Returns the current record's "ca_descripcion" value
 * @method decimal             getCaCantidad()        Returns the current record's "ca_cantidad" value
 * @method decimal             getCaDespacho()        Returns the current record's "ca_despacho" value
 * @method string              getCaUnidad()          Returns the current record's "ca_unidad" value
 * @method timestamp           getCaFchcreado()       Returns the current record's "ca_fchcreado" value
 * @method string              getCaUsucreado()       Returns the current record's "ca_usucreado" value
 * @method timestamp           getCaFchactualizado()  Returns the current record's "ca_fchactualizado" value
 * @method string              getCaUsuactualizado()  Returns the current record's "ca_usuactualizado" value
 * @method Clariant            getClariant()          Returns the current record's "Clariant" value
 * @method Doctrine_Collection getClarNotify()        Returns the current record's "ClarNotify" collection
 * @method ClarDetail          setCaIddetail()        Sets the current record's "ca_iddetail" value
 * @method ClarDetail          setCaIdclariant()      Sets the current record's "ca_idclariant" value
 * @method ClarDetail          setCaPosicion()        Sets the current record's "ca_posicion" value
 * @method ClarDetail          setCaMaterial()        Sets the current record's "ca_material" value
 * @method ClarDetail          setCaDescripcion()     Sets the current record's "ca_descripcion" value
 * @method ClarDetail          setCaCantidad()        Sets the current record's "ca_cantidad" value
 * @method ClarDetail          setCaDespacho()        Sets the current record's "ca_despacho" value
 * @method ClarDetail          setCaUnidad()          Sets the current record's "ca_unidad" value
 * @method ClarDetail          setCaFchcreado()       Sets the current record's "ca_fchcreado" value
 * @method ClarDetail          setCaUsucreado()       Sets the current record's "ca_usucreado" value
 * @method ClarDetail          setCaFchactualizado()  Sets the current record's "ca_fchactualizado" value
 * @method ClarDetail          setCaUsuactualizado()  Sets the current record's "ca_usuactualizado" value
 * @method ClarDetail          setClariant()          Sets the current record's "Clariant" value
 * @method ClarDetail          setClarNotify()        Sets the current record's "ClarNotify" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseClarDetail extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_clardetails');
        $this->hasColumn('ca_iddetail', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_idclariant', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_posicion', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_material', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_descripcion', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_cantidad', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_despacho', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_unidad', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchcreado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usucreado', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchactualizado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usuactualizado', 'string', null, array(
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
        $this->hasOne('Clariant', array(
             'local' => 'ca_idclariant',
             'foreign' => 'ca_idclariant'));

        $this->hasMany('ClarNotify', array(
             'local' => 'ca_iddetail',
             'foreign' => 'ca_iddetail'));
    }
}