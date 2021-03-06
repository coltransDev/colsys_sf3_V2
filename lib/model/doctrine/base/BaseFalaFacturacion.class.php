<?php

/**
 * BaseFalaFacturacion
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $ca_numdocumento
 * @property date $ca_emision_fch
 * @property date $ca_vencimiento_fch
 * @property string $ca_moneda
 * @property decimal $ca_tipo_cambio
 * @property decimal $ca_afecto_vlr
 * @property decimal $ca_iva_vlr
 * @property decimal $ca_exento_vlr
 * @property string $ca_usuprocesado
 * @property timestamp $ca_fchprocesado
 * @property string $ca_usuarchivado
 * @property timestamp $ca_fcharchivado
 * @property string $ca_usuanulado
 * @property timestamp $ca_fchanulado
 * @property string $ca_usucreado
 * @property timestamp $ca_fchcreado
 * @property string $ca_usuactualizado
 * @property timestamp $ca_fchactualizado
 * 
 * @method string          getCaNumdocumento()     Returns the current record's "ca_numdocumento" value
 * @method date            getCaEmisionFch()       Returns the current record's "ca_emision_fch" value
 * @method date            getCaVencimientoFch()   Returns the current record's "ca_vencimiento_fch" value
 * @method string          getCaMoneda()           Returns the current record's "ca_moneda" value
 * @method decimal         getCaTipoCambio()       Returns the current record's "ca_tipo_cambio" value
 * @method decimal         getCaAfectoVlr()        Returns the current record's "ca_afecto_vlr" value
 * @method decimal         getCaIvaVlr()           Returns the current record's "ca_iva_vlr" value
 * @method decimal         getCaExentoVlr()        Returns the current record's "ca_exento_vlr" value
 * @method string          getCaUsuprocesado()     Returns the current record's "ca_usuprocesado" value
 * @method timestamp       getCaFchprocesado()     Returns the current record's "ca_fchprocesado" value
 * @method string          getCaUsuarchivado()     Returns the current record's "ca_usuarchivado" value
 * @method timestamp       getCaFcharchivado()     Returns the current record's "ca_fcharchivado" value
 * @method string          getCaUsuanulado()       Returns the current record's "ca_usuanulado" value
 * @method timestamp       getCaFchanulado()       Returns the current record's "ca_fchanulado" value
 * @method string          getCaUsucreado()        Returns the current record's "ca_usucreado" value
 * @method timestamp       getCaFchcreado()        Returns the current record's "ca_fchcreado" value
 * @method string          getCaUsuactualizado()   Returns the current record's "ca_usuactualizado" value
 * @method timestamp       getCaFchactualizado()   Returns the current record's "ca_fchactualizado" value
 * @method FalaFacturacion setCaNumdocumento()     Sets the current record's "ca_numdocumento" value
 * @method FalaFacturacion setCaEmisionFch()       Sets the current record's "ca_emision_fch" value
 * @method FalaFacturacion setCaVencimientoFch()   Sets the current record's "ca_vencimiento_fch" value
 * @method FalaFacturacion setCaMoneda()           Sets the current record's "ca_moneda" value
 * @method FalaFacturacion setCaTipoCambio()       Sets the current record's "ca_tipo_cambio" value
 * @method FalaFacturacion setCaAfectoVlr()        Sets the current record's "ca_afecto_vlr" value
 * @method FalaFacturacion setCaIvaVlr()           Sets the current record's "ca_iva_vlr" value
 * @method FalaFacturacion setCaExentoVlr()        Sets the current record's "ca_exento_vlr" value
 * @method FalaFacturacion setCaUsuprocesado()     Sets the current record's "ca_usuprocesado" value
 * @method FalaFacturacion setCaFchprocesado()     Sets the current record's "ca_fchprocesado" value
 * @method FalaFacturacion setCaUsuarchivado()     Sets the current record's "ca_usuarchivado" value
 * @method FalaFacturacion setCaFcharchivado()     Sets the current record's "ca_fcharchivado" value
 * @method FalaFacturacion setCaUsuanulado()       Sets the current record's "ca_usuanulado" value
 * @method FalaFacturacion setCaFchanulado()       Sets the current record's "ca_fchanulado" value
 * @method FalaFacturacion setCaUsucreado()        Sets the current record's "ca_usucreado" value
 * @method FalaFacturacion setCaFchcreado()        Sets the current record's "ca_fchcreado" value
 * @method FalaFacturacion setCaUsuactualizado()   Sets the current record's "ca_usuactualizado" value
 * @method FalaFacturacion setCaFchactualizado()   Sets the current record's "ca_fchactualizado" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseFalaFacturacion extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_falafacturacion');
        $this->hasColumn('ca_numdocumento', 'string', null, array(
             'type' => 'string',
             'primary' => true,
             ));
        $this->hasColumn('ca_emision_fch', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_vencimiento_fch', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_moneda', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_tipo_cambio', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_afecto_vlr', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_iva_vlr', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_exento_vlr', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_usuprocesado', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));
        $this->hasColumn('ca_fchprocesado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usuarchivado', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));
        $this->hasColumn('ca_fcharchivado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usuanulado', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));
        $this->hasColumn('ca_fchanulado', 'timestamp', null, array(
             'type' => 'timestamp',
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

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}