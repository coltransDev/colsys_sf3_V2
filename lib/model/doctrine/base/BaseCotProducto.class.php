<?php

/**
 * BaseCotProducto
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idproducto
 * @property integer $ca_idcotizacion
 * @property string $ca_transporte
 * @property string $ca_modalidad
 * @property string $ca_origen
 * @property string $ca_destino
 * @property string $ca_escala
 * @property string $ca_impoexpo
 * @property string $ca_imprimir
 * @property string $ca_producto
 * @property string $ca_incoterms
 * @property string $ca_frecuencia
 * @property string $ca_tiempotransito
 * @property string $ca_observaciones
 * @property string $ca_idlinea
 * @property boolean $ca_postularlinea
 * @property string $ca_etapa
 * @property integer $ca_idtarea
 * @property string $ca_usucreado
 * @property timestamp $ca_fchcreado
 * @property string $ca_usuactualizado
 * @property timestamp $ca_fchactualizado
 * @property Cotizacion $Cotizacion
 * @property Doctrine_Collection $CotOpcion
 * @property IdsProveedor $IdsProveedor
 * @property NotTarea $NotTarea
 * @property Ciudad $Origen
 * @property Ciudad $Destino
 * @property Doctrine_Collection $CotSeguimiento
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6365 2009-09-15 18:22:38Z jwage $
 */
abstract class BaseCotProducto extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_cotproductos');
        $this->hasColumn('ca_idproducto', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_idcotizacion', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_transporte', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_modalidad', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_origen', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_destino', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_escala', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_impoexpo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_imprimir', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_producto', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_incoterms', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_frecuencia', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_tiempotransito', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_observaciones', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_idlinea', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_postularlinea', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_etapa', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_idtarea', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_usucreado', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));
        $this->hasColumn('ca_fchcreado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usuactualizado', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));
        $this->hasColumn('ca_fchactualizado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));


        $this->setAttribute(Doctrine::ATTR_EXPORT, Doctrine::EXPORT_TABLES);
    }

    public function setUp()
    {
        parent::setUp();
    $this->hasOne('Cotizacion', array(
             'local' => 'ca_idcotizacion',
             'foreign' => 'ca_idcotizacion'));

        $this->hasMany('CotOpcion', array(
             'local' => 'ca_idproducto',
             'foreign' => 'ca_idproducto'));

        $this->hasOne('IdsProveedor', array(
             'local' => 'ca_idlinea',
             'foreign' => 'ca_idproveedor'));

        $this->hasOne('NotTarea', array(
             'local' => 'ca_idtarea',
             'foreign' => 'ca_idtarea'));

        $this->hasOne('Ciudad as Origen', array(
             'local' => 'ca_origen',
             'foreign' => 'ca_idciudad'));

        $this->hasOne('Ciudad as Destino', array(
             'local' => 'ca_destino',
             'foreign' => 'ca_idciudad'));

        $this->hasMany('CotSeguimiento', array(
             'local' => 'ca_idproducto',
             'foreign' => 'ca_idproducto'));
    }
}