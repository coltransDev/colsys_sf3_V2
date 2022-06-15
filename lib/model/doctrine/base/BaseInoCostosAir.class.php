<?php

/**
 * BaseInoCostosAir
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $ca_referencia
 * @property integer $ca_idcosto
 * @property string $ca_factura
 * @property date $ca_fchfactura
 * @property string $ca_proveedor
 * @property string $ca_idmoneda
 * @property decimal $ca_trm
 * @property decimal $ca_trm_usd
 * @property decimal $ca_neto
 * @property decimal $ca_venta
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property timestamp $ca_fchactualizado
 * @property string $ca_usuactualizado
 * @property integer $ca_idproveedor
 * @property Costo $Costo
 * @property InoMaestraAir $InoMaestraAir
 * @property Tercero $Proveedor
 * @property Usuario $UsuCreado
 * @property Usuario $UsuActualizado
 * 
 * @method string        getCaReferencia()      Returns the current record's "ca_referencia" value
 * @method integer       getCaIdcosto()         Returns the current record's "ca_idcosto" value
 * @method string        getCaFactura()         Returns the current record's "ca_factura" value
 * @method date          getCaFchfactura()      Returns the current record's "ca_fchfactura" value
 * @method string        getCaProveedor()       Returns the current record's "ca_proveedor" value
 * @method string        getCaIdmoneda()        Returns the current record's "ca_idmoneda" value
 * @method decimal       getCaTrm()             Returns the current record's "ca_trm" value
 * @method decimal       getCaTrmUsd()          Returns the current record's "ca_trm_usd" value
 * @method decimal       getCaNeto()            Returns the current record's "ca_neto" value
 * @method decimal       getCaVenta()           Returns the current record's "ca_venta" value
 * @method timestamp     getCaFchcreado()       Returns the current record's "ca_fchcreado" value
 * @method string        getCaUsucreado()       Returns the current record's "ca_usucreado" value
 * @method timestamp     getCaFchactualizado()  Returns the current record's "ca_fchactualizado" value
 * @method string        getCaUsuactualizado()  Returns the current record's "ca_usuactualizado" value
 * @method integer       getCaIdproveedor()     Returns the current record's "ca_idproveedor" value
 * @method Costo         getCosto()             Returns the current record's "Costo" value
 * @method InoMaestraAir getInoMaestraAir()     Returns the current record's "InoMaestraAir" value
 * @method Tercero       getProveedor()         Returns the current record's "Proveedor" value
 * @method Usuario       getUsuCreado()         Returns the current record's "UsuCreado" value
 * @method Usuario       getUsuActualizado()    Returns the current record's "UsuActualizado" value
 * @method InoCostosAir  setCaReferencia()      Sets the current record's "ca_referencia" value
 * @method InoCostosAir  setCaIdcosto()         Sets the current record's "ca_idcosto" value
 * @method InoCostosAir  setCaFactura()         Sets the current record's "ca_factura" value
 * @method InoCostosAir  setCaFchfactura()      Sets the current record's "ca_fchfactura" value
 * @method InoCostosAir  setCaProveedor()       Sets the current record's "ca_proveedor" value
 * @method InoCostosAir  setCaIdmoneda()        Sets the current record's "ca_idmoneda" value
 * @method InoCostosAir  setCaTrm()             Sets the current record's "ca_trm" value
 * @method InoCostosAir  setCaTrmUsd()          Sets the current record's "ca_trm_usd" value
 * @method InoCostosAir  setCaNeto()            Sets the current record's "ca_neto" value
 * @method InoCostosAir  setCaVenta()           Sets the current record's "ca_venta" value
 * @method InoCostosAir  setCaFchcreado()       Sets the current record's "ca_fchcreado" value
 * @method InoCostosAir  setCaUsucreado()       Sets the current record's "ca_usucreado" value
 * @method InoCostosAir  setCaFchactualizado()  Sets the current record's "ca_fchactualizado" value
 * @method InoCostosAir  setCaUsuactualizado()  Sets the current record's "ca_usuactualizado" value
 * @method InoCostosAir  setCaIdproveedor()     Sets the current record's "ca_idproveedor" value
 * @method InoCostosAir  setCosto()             Sets the current record's "Costo" value
 * @method InoCostosAir  setInoMaestraAir()     Sets the current record's "InoMaestraAir" value
 * @method InoCostosAir  setProveedor()         Sets the current record's "Proveedor" value
 * @method InoCostosAir  setUsuCreado()         Sets the current record's "UsuCreado" value
 * @method InoCostosAir  setUsuActualizado()    Sets the current record's "UsuActualizado" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseInoCostosAir extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_inocostos_air');
        $this->hasColumn('ca_referencia', 'string', null, array(
             'type' => 'string',
             'primary' => true,
             ));
        $this->hasColumn('ca_idcosto', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_factura', 'string', null, array(
             'type' => 'string',
             'primary' => true,
             ));
        $this->hasColumn('ca_fchfactura', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_proveedor', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_idmoneda', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_trm', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_trm_usd', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_neto', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_venta', 'decimal', null, array(
             'type' => 'decimal',
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
        $this->hasColumn('ca_idproveedor', 'integer', null, array(
             'type' => 'integer',
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

        $this->hasOne('InoMaestraAir', array(
             'local' => 'ca_referencia',
             'foreign' => 'ca_referencia'));

        $this->hasOne('Tercero as Proveedor', array(
             'local' => 'ca_idproveedor',
             'foreign' => 'ca_idtercero'));

        $this->hasOne('Usuario as UsuCreado', array(
             'local' => 'ca_usucreado',
             'foreign' => 'ca_login'));

        $this->hasOne('Usuario as UsuActualizado', array(
             'local' => 'ca_usuactualizado',
             'foreign' => 'ca_login'));
    }
}