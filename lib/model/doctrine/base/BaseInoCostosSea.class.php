<?php

/**
 * BaseInoCostosSea
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idinocostos_sea
 * @property string $ca_referencia
 * @property integer $ca_idcosto
 * @property string $ca_factura
 * @property date $ca_fchfactura
 * @property integer $ca_idproveedor
 * @property string $ca_proveedor
 * @property string $ca_idmoneda
 * @property decimal $ca_tcambio
 * @property decimal $ca_tcambio_usd
 * @property decimal $ca_neto
 * @property decimal $ca_venta
 * @property string $ca_login
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property timestamp $ca_fchactualizado
 * @property string $ca_usuactualizado
 * @property Costo $Costo
 * @property InoMaestraSea $InoMaestraSea
 * @property Usuario $UsuCreado
 * @property Usuario $UsuActualizado
 * @property Doctrine_Collection $InoUtilidadSea
 * 
 * @method integer             getCaIdinocostosSea()   Returns the current record's "ca_idinocostos_sea" value
 * @method string              getCaReferencia()       Returns the current record's "ca_referencia" value
 * @method integer             getCaIdcosto()          Returns the current record's "ca_idcosto" value
 * @method string              getCaFactura()          Returns the current record's "ca_factura" value
 * @method date                getCaFchfactura()       Returns the current record's "ca_fchfactura" value
 * @method integer             getCaIdproveedor()      Returns the current record's "ca_idproveedor" value
 * @method string              getCaProveedor()        Returns the current record's "ca_proveedor" value
 * @method string              getCaIdmoneda()         Returns the current record's "ca_idmoneda" value
 * @method decimal             getCaTcambio()          Returns the current record's "ca_tcambio" value
 * @method decimal             getCaTcambioUsd()       Returns the current record's "ca_tcambio_usd" value
 * @method decimal             getCaNeto()             Returns the current record's "ca_neto" value
 * @method decimal             getCaVenta()            Returns the current record's "ca_venta" value
 * @method string              getCaLogin()            Returns the current record's "ca_login" value
 * @method timestamp           getCaFchcreado()        Returns the current record's "ca_fchcreado" value
 * @method string              getCaUsucreado()        Returns the current record's "ca_usucreado" value
 * @method timestamp           getCaFchactualizado()   Returns the current record's "ca_fchactualizado" value
 * @method string              getCaUsuactualizado()   Returns the current record's "ca_usuactualizado" value
 * @method Costo               getCosto()              Returns the current record's "Costo" value
 * @method InoMaestraSea       getInoMaestraSea()      Returns the current record's "InoMaestraSea" value
 * @method Usuario             getUsuCreado()          Returns the current record's "UsuCreado" value
 * @method Usuario             getUsuActualizado()     Returns the current record's "UsuActualizado" value
 * @method Doctrine_Collection getInoUtilidadSea()     Returns the current record's "InoUtilidadSea" collection
 * @method InoCostosSea        setCaIdinocostosSea()   Sets the current record's "ca_idinocostos_sea" value
 * @method InoCostosSea        setCaReferencia()       Sets the current record's "ca_referencia" value
 * @method InoCostosSea        setCaIdcosto()          Sets the current record's "ca_idcosto" value
 * @method InoCostosSea        setCaFactura()          Sets the current record's "ca_factura" value
 * @method InoCostosSea        setCaFchfactura()       Sets the current record's "ca_fchfactura" value
 * @method InoCostosSea        setCaIdproveedor()      Sets the current record's "ca_idproveedor" value
 * @method InoCostosSea        setCaProveedor()        Sets the current record's "ca_proveedor" value
 * @method InoCostosSea        setCaIdmoneda()         Sets the current record's "ca_idmoneda" value
 * @method InoCostosSea        setCaTcambio()          Sets the current record's "ca_tcambio" value
 * @method InoCostosSea        setCaTcambioUsd()       Sets the current record's "ca_tcambio_usd" value
 * @method InoCostosSea        setCaNeto()             Sets the current record's "ca_neto" value
 * @method InoCostosSea        setCaVenta()            Sets the current record's "ca_venta" value
 * @method InoCostosSea        setCaLogin()            Sets the current record's "ca_login" value
 * @method InoCostosSea        setCaFchcreado()        Sets the current record's "ca_fchcreado" value
 * @method InoCostosSea        setCaUsucreado()        Sets the current record's "ca_usucreado" value
 * @method InoCostosSea        setCaFchactualizado()   Sets the current record's "ca_fchactualizado" value
 * @method InoCostosSea        setCaUsuactualizado()   Sets the current record's "ca_usuactualizado" value
 * @method InoCostosSea        setCosto()              Sets the current record's "Costo" value
 * @method InoCostosSea        setInoMaestraSea()      Sets the current record's "InoMaestraSea" value
 * @method InoCostosSea        setUsuCreado()          Sets the current record's "UsuCreado" value
 * @method InoCostosSea        setUsuActualizado()     Sets the current record's "UsuActualizado" value
 * @method InoCostosSea        setInoUtilidadSea()     Sets the current record's "InoUtilidadSea" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseInoCostosSea extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_inocostos_sea');
        $this->hasColumn('ca_idinocostos_sea', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_referencia', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_idcosto', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_factura', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchfactura', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_idproveedor', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_proveedor', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_idmoneda', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_tcambio', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_tcambio_usd', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_neto', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_venta', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_login', 'string', null, array(
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
        $this->hasOne('Costo', array(
             'local' => 'ca_idcosto',
             'foreign' => 'ca_idcosto'));

        $this->hasOne('InoMaestraSea', array(
             'local' => 'ca_referencia',
             'foreign' => 'ca_referencia'));

        $this->hasOne('Usuario as UsuCreado', array(
             'local' => 'ca_usucreado',
             'foreign' => 'ca_login'));

        $this->hasOne('Usuario as UsuActualizado', array(
             'local' => 'ca_usuactualizado',
             'foreign' => 'ca_login'));

        $this->hasMany('InoUtilidadSea', array(
             'local' => 'ca_idinocostos_sea',
             'foreign' => 'ca_idinocosto'));
    }
}