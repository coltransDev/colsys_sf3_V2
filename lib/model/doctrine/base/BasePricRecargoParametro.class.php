<?php

/**
 * BasePricRecargoParametro
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idlinea
 * @property string $ca_transporte
 * @property string $ca_modalidad
 * @property string $ca_impoexpo
 * @property string $ca_concepto
 * @property string $ca_valor
 * @property string $ca_observaciones
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property IdsProveedor $IdsProveedor
 * 
 * @method integer              getCaIdlinea()        Returns the current record's "ca_idlinea" value
 * @method string               getCaTransporte()     Returns the current record's "ca_transporte" value
 * @method string               getCaModalidad()      Returns the current record's "ca_modalidad" value
 * @method string               getCaImpoexpo()       Returns the current record's "ca_impoexpo" value
 * @method string               getCaConcepto()       Returns the current record's "ca_concepto" value
 * @method string               getCaValor()          Returns the current record's "ca_valor" value
 * @method string               getCaObservaciones()  Returns the current record's "ca_observaciones" value
 * @method timestamp            getCaFchcreado()      Returns the current record's "ca_fchcreado" value
 * @method string               getCaUsucreado()      Returns the current record's "ca_usucreado" value
 * @method IdsProveedor         getIdsProveedor()     Returns the current record's "IdsProveedor" value
 * @method PricRecargoParametro setCaIdlinea()        Sets the current record's "ca_idlinea" value
 * @method PricRecargoParametro setCaTransporte()     Sets the current record's "ca_transporte" value
 * @method PricRecargoParametro setCaModalidad()      Sets the current record's "ca_modalidad" value
 * @method PricRecargoParametro setCaImpoexpo()       Sets the current record's "ca_impoexpo" value
 * @method PricRecargoParametro setCaConcepto()       Sets the current record's "ca_concepto" value
 * @method PricRecargoParametro setCaValor()          Sets the current record's "ca_valor" value
 * @method PricRecargoParametro setCaObservaciones()  Sets the current record's "ca_observaciones" value
 * @method PricRecargoParametro setCaFchcreado()      Sets the current record's "ca_fchcreado" value
 * @method PricRecargoParametro setCaUsucreado()      Sets the current record's "ca_usucreado" value
 * @method PricRecargoParametro setIdsProveedor()     Sets the current record's "IdsProveedor" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BasePricRecargoParametro extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('pric.tb_recargosparametros');
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
        $this->hasColumn('ca_concepto', 'string', null, array(
             'type' => 'string',
             'primary' => true,
             ));
        $this->hasColumn('ca_valor', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_observaciones', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchcreado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usucreado', 'string', null, array(
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
        $this->hasOne('IdsProveedor', array(
             'local' => 'ca_idlinea',
             'foreign' => 'ca_idproveedor'));
    }
}
