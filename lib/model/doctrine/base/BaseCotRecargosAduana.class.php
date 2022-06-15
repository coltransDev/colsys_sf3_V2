<?php

/**
 * BaseCotRecargosAduana
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_consecutivo
 * @property integer $ca_idpadre
 * @property integer $ca_idtrayecto
 * @property string $ca_recargo
 * @property string $ca_contenedor
 * @property numeric $ca_valor
 * @property string $ca_aplicacion
 * @property string $ca_detalles
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property timestamp $ca_fchactualizado
 * @property string $ca_usuactualizado
 * @property Doctrine_Collection $CotTrayectoAduana
 * 
 * @method integer             getCaConsecutivo()     Returns the current record's "ca_consecutivo" value
 * @method integer             getCaIdpadre()         Returns the current record's "ca_idpadre" value
 * @method integer             getCaIdtrayecto()      Returns the current record's "ca_idtrayecto" value
 * @method string              getCaRecargo()         Returns the current record's "ca_recargo" value
 * @method string              getCaContenedor()      Returns the current record's "ca_contenedor" value
 * @method numeric             getCaValor()           Returns the current record's "ca_valor" value
 * @method string              getCaAplicacion()      Returns the current record's "ca_aplicacion" value
 * @method string              getCaDetalles()        Returns the current record's "ca_detalles" value
 * @method timestamp           getCaFchcreado()       Returns the current record's "ca_fchcreado" value
 * @method string              getCaUsucreado()       Returns the current record's "ca_usucreado" value
 * @method timestamp           getCaFchactualizado()  Returns the current record's "ca_fchactualizado" value
 * @method string              getCaUsuactualizado()  Returns the current record's "ca_usuactualizado" value
 * @method Doctrine_Collection getCotTrayectoAduana() Returns the current record's "CotTrayectoAduana" collection
 * @method CotRecargosAduana   setCaConsecutivo()     Sets the current record's "ca_consecutivo" value
 * @method CotRecargosAduana   setCaIdpadre()         Sets the current record's "ca_idpadre" value
 * @method CotRecargosAduana   setCaIdtrayecto()      Sets the current record's "ca_idtrayecto" value
 * @method CotRecargosAduana   setCaRecargo()         Sets the current record's "ca_recargo" value
 * @method CotRecargosAduana   setCaContenedor()      Sets the current record's "ca_contenedor" value
 * @method CotRecargosAduana   setCaValor()           Sets the current record's "ca_valor" value
 * @method CotRecargosAduana   setCaAplicacion()      Sets the current record's "ca_aplicacion" value
 * @method CotRecargosAduana   setCaDetalles()        Sets the current record's "ca_detalles" value
 * @method CotRecargosAduana   setCaFchcreado()       Sets the current record's "ca_fchcreado" value
 * @method CotRecargosAduana   setCaUsucreado()       Sets the current record's "ca_usucreado" value
 * @method CotRecargosAduana   setCaFchactualizado()  Sets the current record's "ca_fchactualizado" value
 * @method CotRecargosAduana   setCaUsuactualizado()  Sets the current record's "ca_usuactualizado" value
 * @method CotRecargosAduana   setCotTrayectoAduana() Sets the current record's "CotTrayectoAduana" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseCotRecargosAduana extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('cot.tb_conceptoaduana');
        $this->hasColumn('ca_consecutivo', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_idpadre', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('ca_idtrayecto', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('ca_recargo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_contenedor', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_valor', 'numeric', null, array(
             'type' => 'numeric',
             ));
        $this->hasColumn('ca_aplicacion', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_detalles', 'string', null, array(
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


        $this->setAttribute(Doctrine_Core::ATTR_EXPORT, Doctrine_Core::EXPORT_TABLES);

        $this->option('symfony', array(
             'form' => true,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('CotTrayectoAduana', array(
             'local' => 'ca_idcotizacion',
             'foreign' => 'ca_idcotizacion'));
    }
}