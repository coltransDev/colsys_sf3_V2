<?php

/**
 * BaseCotContinuacion1
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idcontinuacion
 * @property integer $ca_idcotizacion
 * @property string $ca_tipo
 * @property string $ca_modalidad
 * @property string $ca_origen
 * @property string $ca_destino
 * @property integer $ca_idconcepto
 * @property integer $ca_idequipo
 * @property string $ca_idmoneda
 * @property string $ca_frecuencia
 * @property string $ca_tiempotransito
 * @property string $ca_observaciones
 * @property decimal $ca_valor_tar
 * @property decimal $ca_valor_min
 * @property string $ca_usucreado
 * @property timestamp $ca_fchcreado
 * @property string $ca_usuactualizado
 * @property timestamp $ca_fchactualizado
 * @property Cotizacion $Cotizacion
 * @property Ciudad $Origen
 * @property Ciudad $Destino
 * @property Concepto $Equipo
 * @property Concepto $Concepto
 * 
 * @method integer          getCaIdcontinuacion()  Returns the current record's "ca_idcontinuacion" value
 * @method integer          getCaIdcotizacion()    Returns the current record's "ca_idcotizacion" value
 * @method string           getCaTipo()            Returns the current record's "ca_tipo" value
 * @method string           getCaModalidad()       Returns the current record's "ca_modalidad" value
 * @method string           getCaOrigen()          Returns the current record's "ca_origen" value
 * @method string           getCaDestino()         Returns the current record's "ca_destino" value
 * @method integer          getCaIdconcepto()      Returns the current record's "ca_idconcepto" value
 * @method integer          getCaIdequipo()        Returns the current record's "ca_idequipo" value
 * @method string           getCaIdmoneda()        Returns the current record's "ca_idmoneda" value
 * @method string           getCaFrecuencia()      Returns the current record's "ca_frecuencia" value
 * @method string           getCaTiempotransito()  Returns the current record's "ca_tiempotransito" value
 * @method string           getCaObservaciones()   Returns the current record's "ca_observaciones" value
 * @method decimal          getCaValorTar()        Returns the current record's "ca_valor_tar" value
 * @method decimal          getCaValorMin()        Returns the current record's "ca_valor_min" value
 * @method string           getCaUsucreado()       Returns the current record's "ca_usucreado" value
 * @method timestamp        getCaFchcreado()       Returns the current record's "ca_fchcreado" value
 * @method string           getCaUsuactualizado()  Returns the current record's "ca_usuactualizado" value
 * @method timestamp        getCaFchactualizado()  Returns the current record's "ca_fchactualizado" value
 * @method Cotizacion       getCotizacion()        Returns the current record's "Cotizacion" value
 * @method Ciudad           getOrigen()            Returns the current record's "Origen" value
 * @method Ciudad           getDestino()           Returns the current record's "Destino" value
 * @method Concepto         getEquipo()            Returns the current record's "Equipo" value
 * @method Concepto         getConcepto()          Returns the current record's "Concepto" value
 * @method CotContinuacion1 setCaIdcontinuacion()  Sets the current record's "ca_idcontinuacion" value
 * @method CotContinuacion1 setCaIdcotizacion()    Sets the current record's "ca_idcotizacion" value
 * @method CotContinuacion1 setCaTipo()            Sets the current record's "ca_tipo" value
 * @method CotContinuacion1 setCaModalidad()       Sets the current record's "ca_modalidad" value
 * @method CotContinuacion1 setCaOrigen()          Sets the current record's "ca_origen" value
 * @method CotContinuacion1 setCaDestino()         Sets the current record's "ca_destino" value
 * @method CotContinuacion1 setCaIdconcepto()      Sets the current record's "ca_idconcepto" value
 * @method CotContinuacion1 setCaIdequipo()        Sets the current record's "ca_idequipo" value
 * @method CotContinuacion1 setCaIdmoneda()        Sets the current record's "ca_idmoneda" value
 * @method CotContinuacion1 setCaFrecuencia()      Sets the current record's "ca_frecuencia" value
 * @method CotContinuacion1 setCaTiempotransito()  Sets the current record's "ca_tiempotransito" value
 * @method CotContinuacion1 setCaObservaciones()   Sets the current record's "ca_observaciones" value
 * @method CotContinuacion1 setCaValorTar()        Sets the current record's "ca_valor_tar" value
 * @method CotContinuacion1 setCaValorMin()        Sets the current record's "ca_valor_min" value
 * @method CotContinuacion1 setCaUsucreado()       Sets the current record's "ca_usucreado" value
 * @method CotContinuacion1 setCaFchcreado()       Sets the current record's "ca_fchcreado" value
 * @method CotContinuacion1 setCaUsuactualizado()  Sets the current record's "ca_usuactualizado" value
 * @method CotContinuacion1 setCaFchactualizado()  Sets the current record's "ca_fchactualizado" value
 * @method CotContinuacion1 setCotizacion()        Sets the current record's "Cotizacion" value
 * @method CotContinuacion1 setOrigen()            Sets the current record's "Origen" value
 * @method CotContinuacion1 setDestino()           Sets the current record's "Destino" value
 * @method CotContinuacion1 setEquipo()            Sets the current record's "Equipo" value
 * @method CotContinuacion1 setConcepto()          Sets the current record's "Concepto" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseCotContinuacion1 extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_cotcontinuacion');
        $this->hasColumn('ca_idcontinuacion', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_idcotizacion', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_tipo', 'string', null, array(
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
        $this->hasColumn('ca_idconcepto', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idequipo', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idmoneda', 'string', null, array(
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
        $this->hasColumn('ca_valor_tar', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_valor_min', 'decimal', null, array(
             'type' => 'decimal',
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
        $this->hasOne('Cotizacion', array(
             'local' => 'ca_idcotizacion',
             'foreign' => 'ca_idcotizacion'));

        $this->hasOne('Ciudad as Origen', array(
             'local' => 'ca_origen',
             'foreign' => 'ca_idciudad'));

        $this->hasOne('Ciudad as Destino', array(
             'local' => 'ca_destino',
             'foreign' => 'ca_idciudad'));

        $this->hasOne('Concepto as Equipo', array(
             'local' => 'ca_idequipo',
             'foreign' => 'ca_idconcepto'));

        $this->hasOne('Concepto', array(
             'local' => 'ca_idconcepto',
             'foreign' => 'ca_idconcepto'));
    }
}