<?php

/**
 * BaseInoUtilidadAir
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $ca_referencia
 * @property integer $ca_idcliente
 * @property string $ca_hawb
 * @property integer $ca_idcosto
 * @property string $ca_factura
 * @property decimal $ca_valor
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property InoMaestraAir $InoMaestraAir
 * 
 * @method string         getCaReferencia()  Returns the current record's "ca_referencia" value
 * @method integer        getCaIdcliente()   Returns the current record's "ca_idcliente" value
 * @method string         getCaHawb()        Returns the current record's "ca_hawb" value
 * @method integer        getCaIdcosto()     Returns the current record's "ca_idcosto" value
 * @method string         getCaFactura()     Returns the current record's "ca_factura" value
 * @method decimal        getCaValor()       Returns the current record's "ca_valor" value
 * @method timestamp      getCaFchcreado()   Returns the current record's "ca_fchcreado" value
 * @method string         getCaUsucreado()   Returns the current record's "ca_usucreado" value
 * @method InoMaestraAir  getInoMaestraAir() Returns the current record's "InoMaestraAir" value
 * @method InoUtilidadAir setCaReferencia()  Sets the current record's "ca_referencia" value
 * @method InoUtilidadAir setCaIdcliente()   Sets the current record's "ca_idcliente" value
 * @method InoUtilidadAir setCaHawb()        Sets the current record's "ca_hawb" value
 * @method InoUtilidadAir setCaIdcosto()     Sets the current record's "ca_idcosto" value
 * @method InoUtilidadAir setCaFactura()     Sets the current record's "ca_factura" value
 * @method InoUtilidadAir setCaValor()       Sets the current record's "ca_valor" value
 * @method InoUtilidadAir setCaFchcreado()   Sets the current record's "ca_fchcreado" value
 * @method InoUtilidadAir setCaUsucreado()   Sets the current record's "ca_usucreado" value
 * @method InoUtilidadAir setInoMaestraAir() Sets the current record's "InoMaestraAir" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseInoUtilidadAir extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_inoutilidad_air');
        $this->hasColumn('ca_referencia', 'string', null, array(
             'type' => 'string',
             'primary' => true,
             ));
        $this->hasColumn('ca_idcliente', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_hawb', 'string', null, array(
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
        $this->hasColumn('ca_valor', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_fchcreado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usucreado', 'string', null, array(
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
        $this->hasOne('InoMaestraAir', array(
             'local' => 'ca_referencia',
             'foreign' => 'ca_referencia'));
    }
}