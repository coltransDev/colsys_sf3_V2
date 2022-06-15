<?php

/**
 * BaseExpoAwbtransporte
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_iddoctransporte
 * @property string $ca_referencia
 * @property string $ca_iddestino_uno
 * @property integer $ca_idcarrier_uno
 * @property string $ca_iddestino_dos
 * @property integer $ca_idcarrier_dos
 * @property string $ca_iddestino_trs
 * @property integer $ca_idcarrier_trs
 * @property string $ca_consecutivo
 * @property date $ca_fchdoctransporte
 * @property string $ca_charges_code
 * @property string $ca_airport_departure
 * @property string $ca_airport_destination
 * @property string $ca_accounting_info
 * @property string $ca_handing_info
 * @property float $ca_number_packages
 * @property string $ca_kind_packages
 * @property float $ca_gross_weight
 * @property string $ca_gross_unit
 * @property float $ca_weight_charge
 * @property string $ca_weight_details
 * @property float $ca_rate_charge
 * @property float $ca_due_agent
 * @property float $ca_due_carrier
 * @property string $ca_delivery_goods
 * @property string $ca_other_charges
 * @property string $ca_shipper_certifies
 * @property string $ca_childrens
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property timestamp $ca_fchactualizado
 * @property string $ca_usuactualizado
 * @property timestamp $ca_fchliquidado
 * @property string $ca_usuliquidado
 * @property timestamp $ca_fchanulado
 * @property string $ca_usuanulado
 * @property InoMaestraExpo $InoMaestraExpo
 * @property ExpoCarrier $ExpoCarrierUno
 * @property ExpoCarrier $ExpoCarrierDos
 * @property ExpoCarrier $ExpoCarrierTrs
 * @property Usuario $Usucreado
 * @property Usuario $Usuliquidado
 * @property Usuario $Usuactualizado
 * 
 * @method integer           getCaIddoctransporte()      Returns the current record's "ca_iddoctransporte" value
 * @method string            getCaReferencia()           Returns the current record's "ca_referencia" value
 * @method string            getCaIddestinoUno()         Returns the current record's "ca_iddestino_uno" value
 * @method integer           getCaIdcarrierUno()         Returns the current record's "ca_idcarrier_uno" value
 * @method string            getCaIddestinoDos()         Returns the current record's "ca_iddestino_dos" value
 * @method integer           getCaIdcarrierDos()         Returns the current record's "ca_idcarrier_dos" value
 * @method string            getCaIddestinoTrs()         Returns the current record's "ca_iddestino_trs" value
 * @method integer           getCaIdcarrierTrs()         Returns the current record's "ca_idcarrier_trs" value
 * @method string            getCaConsecutivo()          Returns the current record's "ca_consecutivo" value
 * @method date              getCaFchdoctransporte()     Returns the current record's "ca_fchdoctransporte" value
 * @method string            getCaChargesCode()          Returns the current record's "ca_charges_code" value
 * @method string            getCaAirportDeparture()     Returns the current record's "ca_airport_departure" value
 * @method string            getCaAirportDestination()   Returns the current record's "ca_airport_destination" value
 * @method string            getCaAccountingInfo()       Returns the current record's "ca_accounting_info" value
 * @method string            getCaHandingInfo()          Returns the current record's "ca_handing_info" value
 * @method float             getCaNumberPackages()       Returns the current record's "ca_number_packages" value
 * @method string            getCaKindPackages()         Returns the current record's "ca_kind_packages" value
 * @method float             getCaGrossWeight()          Returns the current record's "ca_gross_weight" value
 * @method string            getCaGrossUnit()            Returns the current record's "ca_gross_unit" value
 * @method float             getCaWeightCharge()         Returns the current record's "ca_weight_charge" value
 * @method string            getCaWeightDetails()        Returns the current record's "ca_weight_details" value
 * @method float             getCaRateCharge()           Returns the current record's "ca_rate_charge" value
 * @method float             getCaDueAgent()             Returns the current record's "ca_due_agent" value
 * @method float             getCaDueCarrier()           Returns the current record's "ca_due_carrier" value
 * @method string            getCaDeliveryGoods()        Returns the current record's "ca_delivery_goods" value
 * @method string            getCaOtherCharges()         Returns the current record's "ca_other_charges" value
 * @method string            getCaShipperCertifies()     Returns the current record's "ca_shipper_certifies" value
 * @method string            getCaChildrens()            Returns the current record's "ca_childrens" value
 * @method timestamp         getCaFchcreado()            Returns the current record's "ca_fchcreado" value
 * @method string            getCaUsucreado()            Returns the current record's "ca_usucreado" value
 * @method timestamp         getCaFchactualizado()       Returns the current record's "ca_fchactualizado" value
 * @method string            getCaUsuactualizado()       Returns the current record's "ca_usuactualizado" value
 * @method timestamp         getCaFchliquidado()         Returns the current record's "ca_fchliquidado" value
 * @method string            getCaUsuliquidado()         Returns the current record's "ca_usuliquidado" value
 * @method timestamp         getCaFchanulado()           Returns the current record's "ca_fchanulado" value
 * @method string            getCaUsuanulado()           Returns the current record's "ca_usuanulado" value
 * @method InoMaestraExpo    getInoMaestraExpo()         Returns the current record's "InoMaestraExpo" value
 * @method ExpoCarrier       getExpoCarrierUno()         Returns the current record's "ExpoCarrierUno" value
 * @method ExpoCarrier       getExpoCarrierDos()         Returns the current record's "ExpoCarrierDos" value
 * @method ExpoCarrier       getExpoCarrierTrs()         Returns the current record's "ExpoCarrierTrs" value
 * @method Usuario           getUsucreado()              Returns the current record's "Usucreado" value
 * @method Usuario           getUsuliquidado()           Returns the current record's "Usuliquidado" value
 * @method Usuario           getUsuactualizado()         Returns the current record's "Usuactualizado" value
 * @method ExpoAwbtransporte setCaIddoctransporte()      Sets the current record's "ca_iddoctransporte" value
 * @method ExpoAwbtransporte setCaReferencia()           Sets the current record's "ca_referencia" value
 * @method ExpoAwbtransporte setCaIddestinoUno()         Sets the current record's "ca_iddestino_uno" value
 * @method ExpoAwbtransporte setCaIdcarrierUno()         Sets the current record's "ca_idcarrier_uno" value
 * @method ExpoAwbtransporte setCaIddestinoDos()         Sets the current record's "ca_iddestino_dos" value
 * @method ExpoAwbtransporte setCaIdcarrierDos()         Sets the current record's "ca_idcarrier_dos" value
 * @method ExpoAwbtransporte setCaIddestinoTrs()         Sets the current record's "ca_iddestino_trs" value
 * @method ExpoAwbtransporte setCaIdcarrierTrs()         Sets the current record's "ca_idcarrier_trs" value
 * @method ExpoAwbtransporte setCaConsecutivo()          Sets the current record's "ca_consecutivo" value
 * @method ExpoAwbtransporte setCaFchdoctransporte()     Sets the current record's "ca_fchdoctransporte" value
 * @method ExpoAwbtransporte setCaChargesCode()          Sets the current record's "ca_charges_code" value
 * @method ExpoAwbtransporte setCaAirportDeparture()     Sets the current record's "ca_airport_departure" value
 * @method ExpoAwbtransporte setCaAirportDestination()   Sets the current record's "ca_airport_destination" value
 * @method ExpoAwbtransporte setCaAccountingInfo()       Sets the current record's "ca_accounting_info" value
 * @method ExpoAwbtransporte setCaHandingInfo()          Sets the current record's "ca_handing_info" value
 * @method ExpoAwbtransporte setCaNumberPackages()       Sets the current record's "ca_number_packages" value
 * @method ExpoAwbtransporte setCaKindPackages()         Sets the current record's "ca_kind_packages" value
 * @method ExpoAwbtransporte setCaGrossWeight()          Sets the current record's "ca_gross_weight" value
 * @method ExpoAwbtransporte setCaGrossUnit()            Sets the current record's "ca_gross_unit" value
 * @method ExpoAwbtransporte setCaWeightCharge()         Sets the current record's "ca_weight_charge" value
 * @method ExpoAwbtransporte setCaWeightDetails()        Sets the current record's "ca_weight_details" value
 * @method ExpoAwbtransporte setCaRateCharge()           Sets the current record's "ca_rate_charge" value
 * @method ExpoAwbtransporte setCaDueAgent()             Sets the current record's "ca_due_agent" value
 * @method ExpoAwbtransporte setCaDueCarrier()           Sets the current record's "ca_due_carrier" value
 * @method ExpoAwbtransporte setCaDeliveryGoods()        Sets the current record's "ca_delivery_goods" value
 * @method ExpoAwbtransporte setCaOtherCharges()         Sets the current record's "ca_other_charges" value
 * @method ExpoAwbtransporte setCaShipperCertifies()     Sets the current record's "ca_shipper_certifies" value
 * @method ExpoAwbtransporte setCaChildrens()            Sets the current record's "ca_childrens" value
 * @method ExpoAwbtransporte setCaFchcreado()            Sets the current record's "ca_fchcreado" value
 * @method ExpoAwbtransporte setCaUsucreado()            Sets the current record's "ca_usucreado" value
 * @method ExpoAwbtransporte setCaFchactualizado()       Sets the current record's "ca_fchactualizado" value
 * @method ExpoAwbtransporte setCaUsuactualizado()       Sets the current record's "ca_usuactualizado" value
 * @method ExpoAwbtransporte setCaFchliquidado()         Sets the current record's "ca_fchliquidado" value
 * @method ExpoAwbtransporte setCaUsuliquidado()         Sets the current record's "ca_usuliquidado" value
 * @method ExpoAwbtransporte setCaFchanulado()           Sets the current record's "ca_fchanulado" value
 * @method ExpoAwbtransporte setCaUsuanulado()           Sets the current record's "ca_usuanulado" value
 * @method ExpoAwbtransporte setInoMaestraExpo()         Sets the current record's "InoMaestraExpo" value
 * @method ExpoAwbtransporte setExpoCarrierUno()         Sets the current record's "ExpoCarrierUno" value
 * @method ExpoAwbtransporte setExpoCarrierDos()         Sets the current record's "ExpoCarrierDos" value
 * @method ExpoAwbtransporte setExpoCarrierTrs()         Sets the current record's "ExpoCarrierTrs" value
 * @method ExpoAwbtransporte setUsucreado()              Sets the current record's "Usucreado" value
 * @method ExpoAwbtransporte setUsuliquidado()           Sets the current record's "Usuliquidado" value
 * @method ExpoAwbtransporte setUsuactualizado()         Sets the current record's "Usuactualizado" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseExpoAwbtransporte extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_expo_awbtransporte');
        $this->hasColumn('ca_iddoctransporte', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_referencia', 'string', 17, array(
             'type' => 'string',
             'length' => '17',
             ));
        $this->hasColumn('ca_iddestino_uno', 'string', 3, array(
             'type' => 'string',
             'length' => '3',
             ));
        $this->hasColumn('ca_idcarrier_uno', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_iddestino_dos', 'string', 3, array(
             'type' => 'string',
             'length' => '3',
             ));
        $this->hasColumn('ca_idcarrier_dos', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_iddestino_trs', 'string', 3, array(
             'type' => 'string',
             'length' => '3',
             ));
        $this->hasColumn('ca_idcarrier_trs', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_consecutivo', 'string', 15, array(
             'type' => 'string',
             'length' => '15',
             ));
        $this->hasColumn('ca_fchdoctransporte', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_charges_code', 'string', 2, array(
             'type' => 'string',
             'length' => '2',
             ));
        $this->hasColumn('ca_airport_departure', 'string', 64, array(
             'type' => 'string',
             'length' => '64',
             ));
        $this->hasColumn('ca_airport_destination', 'string', 64, array(
             'type' => 'string',
             'length' => '64',
             ));
        $this->hasColumn('ca_accounting_info', 'string', 512, array(
             'type' => 'string',
             'length' => '512',
             ));
        $this->hasColumn('ca_handing_info', 'string', 512, array(
             'type' => 'string',
             'length' => '512',
             ));
        $this->hasColumn('ca_number_packages', 'float', null, array(
             'type' => 'float',
             ));
        $this->hasColumn('ca_kind_packages', 'string', 128, array(
             'type' => 'string',
             'length' => '128',
             ));
        $this->hasColumn('ca_gross_weight', 'float', null, array(
             'type' => 'float',
             ));
        $this->hasColumn('ca_gross_unit', 'string', 4, array(
             'type' => 'string',
             'length' => '4',
             ));
        $this->hasColumn('ca_weight_charge', 'float', null, array(
             'type' => 'float',
             ));
        $this->hasColumn('ca_weight_details', 'string', 10, array(
             'type' => 'string',
             'length' => '10',
             ));
        $this->hasColumn('ca_rate_charge', 'float', null, array(
             'type' => 'float',
             ));
        $this->hasColumn('ca_due_agent', 'float', null, array(
             'type' => 'float',
             ));
        $this->hasColumn('ca_due_carrier', 'float', null, array(
             'type' => 'float',
             ));
        $this->hasColumn('ca_delivery_goods', 'string', 512, array(
             'type' => 'string',
             'length' => '512',
             ));
        $this->hasColumn('ca_other_charges', 'string', 512, array(
             'type' => 'string',
             'length' => '512',
             ));
        $this->hasColumn('ca_shipper_certifies', 'string', 512, array(
             'type' => 'string',
             'length' => '512',
             ));
        $this->hasColumn('ca_childrens', 'string', null, array(
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
        $this->hasColumn('ca_fchliquidado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usuliquidado', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));
        $this->hasColumn('ca_fchanulado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usuanulado', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('InoMaestraExpo', array(
             'local' => 'ca_referencia',
             'foreign' => 'ca_referencia'));

        $this->hasOne('ExpoCarrier as ExpoCarrierUno', array(
             'local' => 'ca_idcarrier_uno',
             'foreign' => 'ca_idcarrier'));

        $this->hasOne('ExpoCarrier as ExpoCarrierDos', array(
             'local' => 'ca_idcarrier_dos',
             'foreign' => 'ca_idcarrier'));

        $this->hasOne('ExpoCarrier as ExpoCarrierTrs', array(
             'local' => 'ca_idcarrier_trs',
             'foreign' => 'ca_idcarrier'));

        $this->hasOne('Usuario as Usucreado', array(
             'local' => 'ca_usucreado',
             'foreign' => 'ca_login'));

        $this->hasOne('Usuario as Usuliquidado', array(
             'local' => 'ca_usuliquidado',
             'foreign' => 'ca_login'));

        $this->hasOne('Usuario as Usuactualizado', array(
             'local' => 'ca_usuactualizado',
             'foreign' => 'ca_login'));
    }
}