<?php

/**
 * BasePricPatioLinea
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idpatio
 * @property integer $ca_idlinea
 * @property string $ca_transporte
 * @property string $ca_modalidad
 * @property string $ca_impoexpo
 * @property string $ca_observaciones
 * @property PricPatio $PricPatio
 * @property IdsProveedor $IdsProveedor
 * 
 * @method integer        getCaIdpatio()        Returns the current record's "ca_idpatio" value
 * @method integer        getCaIdlinea()        Returns the current record's "ca_idlinea" value
 * @method string         getCaTransporte()     Returns the current record's "ca_transporte" value
 * @method string         getCaModalidad()      Returns the current record's "ca_modalidad" value
 * @method string         getCaImpoexpo()       Returns the current record's "ca_impoexpo" value
 * @method string         getCaObservaciones()  Returns the current record's "ca_observaciones" value
 * @method PricPatio      getPricPatio()        Returns the current record's "PricPatio" value
 * @method IdsProveedor   getIdsProveedor()     Returns the current record's "IdsProveedor" value
 * @method PricPatioLinea setCaIdpatio()        Sets the current record's "ca_idpatio" value
 * @method PricPatioLinea setCaIdlinea()        Sets the current record's "ca_idlinea" value
 * @method PricPatioLinea setCaTransporte()     Sets the current record's "ca_transporte" value
 * @method PricPatioLinea setCaModalidad()      Sets the current record's "ca_modalidad" value
 * @method PricPatioLinea setCaImpoexpo()       Sets the current record's "ca_impoexpo" value
 * @method PricPatioLinea setCaObservaciones()  Sets the current record's "ca_observaciones" value
 * @method PricPatioLinea setPricPatio()        Sets the current record's "PricPatio" value
 * @method PricPatioLinea setIdsProveedor()     Sets the current record's "IdsProveedor" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BasePricPatioLinea extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('pric.tb_patioslinea');
        $this->hasColumn('ca_idpatio', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_idlinea', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_transporte', 'string', null, array(
             'type' => 'string',
             'primary' => true,
             ));
        $this->hasColumn('ca_modalidad', 'string', null, array(
             'type' => 'string',
             'primary' => true,
             ));
        $this->hasColumn('ca_impoexpo', 'string', null, array(
             'type' => 'string',
             'primary' => true,
             ));
        $this->hasColumn('ca_observaciones', 'string', null, array(
             'type' => 'string',
             ));


        $this->setAttribute(Doctrine_Core::ATTR_EXPORT, Doctrine_Core::EXPORT_TABLES);

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('PricPatio', array(
             'local' => 'ca_idpatio',
             'foreign' => 'ca_idpatio'));

        $this->hasOne('IdsProveedor', array(
             'local' => 'ca_idlinea',
             'foreign' => 'ca_idproveedor'));
    }
}