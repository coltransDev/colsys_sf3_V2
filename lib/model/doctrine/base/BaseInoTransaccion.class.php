<?php

/**
 * BaseInoTransaccion
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idtransaccion
 * @property integer $ca_idcomprobante
 * @property integer $ca_idcuenta
 * @property integer $ca_idconcepto
 * @property integer $ca_idccosto
 * @property integer $ca_idmaster
 * @property integer $ca_id
 * @property boolean $ca_db
 * @property decimal $ca_valor
 * @property string $ca_idmoneda
 * @property timestamp $ca_observaciones
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property InoHouse $InoHouse
 * @property InoCentroCosto $InoCentroCosto
 * @property Usuario $UsuCreado
 * @property InoComprobante $InoComprobante
 * @property InoCuenta $InoCuenta
 * @property InoConcepto $InoConcepto
 * @property InoMaster $InoMaster
 * 
 * @method integer        getCaIdtransaccion()  Returns the current record's "ca_idtransaccion" value
 * @method integer        getCaIdcomprobante()  Returns the current record's "ca_idcomprobante" value
 * @method integer        getCaIdcuenta()       Returns the current record's "ca_idcuenta" value
 * @method integer        getCaIdconcepto()     Returns the current record's "ca_idconcepto" value
 * @method integer        getCaIdccosto()       Returns the current record's "ca_idccosto" value
 * @method integer        getCaIdmaster()       Returns the current record's "ca_idmaster" value
 * @method integer        getCaId()             Returns the current record's "ca_id" value
 * @method boolean        getCaDb()             Returns the current record's "ca_db" value
 * @method decimal        getCaValor()          Returns the current record's "ca_valor" value
 * @method string         getCaIdmoneda()       Returns the current record's "ca_idmoneda" value
 * @method timestamp      getCaObservaciones()  Returns the current record's "ca_observaciones" value
 * @method timestamp      getCaFchcreado()      Returns the current record's "ca_fchcreado" value
 * @method string         getCaUsucreado()      Returns the current record's "ca_usucreado" value
 * @method InoHouse       getInoHouse()         Returns the current record's "InoHouse" value
 * @method InoCentroCosto getInoCentroCosto()   Returns the current record's "InoCentroCosto" value
 * @method Usuario        getUsuCreado()        Returns the current record's "UsuCreado" value
 * @method InoComprobante getInoComprobante()   Returns the current record's "InoComprobante" value
 * @method InoCuenta      getInoCuenta()        Returns the current record's "InoCuenta" value
 * @method InoConcepto    getInoConcepto()      Returns the current record's "InoConcepto" value
 * @method InoMaster      getInoMaster()        Returns the current record's "InoMaster" value
 * @method InoTransaccion setCaIdtransaccion()  Sets the current record's "ca_idtransaccion" value
 * @method InoTransaccion setCaIdcomprobante()  Sets the current record's "ca_idcomprobante" value
 * @method InoTransaccion setCaIdcuenta()       Sets the current record's "ca_idcuenta" value
 * @method InoTransaccion setCaIdconcepto()     Sets the current record's "ca_idconcepto" value
 * @method InoTransaccion setCaIdccosto()       Sets the current record's "ca_idccosto" value
 * @method InoTransaccion setCaIdmaster()       Sets the current record's "ca_idmaster" value
 * @method InoTransaccion setCaId()             Sets the current record's "ca_id" value
 * @method InoTransaccion setCaDb()             Sets the current record's "ca_db" value
 * @method InoTransaccion setCaValor()          Sets the current record's "ca_valor" value
 * @method InoTransaccion setCaIdmoneda()       Sets the current record's "ca_idmoneda" value
 * @method InoTransaccion setCaObservaciones()  Sets the current record's "ca_observaciones" value
 * @method InoTransaccion setCaFchcreado()      Sets the current record's "ca_fchcreado" value
 * @method InoTransaccion setCaUsucreado()      Sets the current record's "ca_usucreado" value
 * @method InoTransaccion setInoHouse()         Sets the current record's "InoHouse" value
 * @method InoTransaccion setInoCentroCosto()   Sets the current record's "InoCentroCosto" value
 * @method InoTransaccion setUsuCreado()        Sets the current record's "UsuCreado" value
 * @method InoTransaccion setInoComprobante()   Sets the current record's "InoComprobante" value
 * @method InoTransaccion setInoCuenta()        Sets the current record's "InoCuenta" value
 * @method InoTransaccion setInoConcepto()      Sets the current record's "InoConcepto" value
 * @method InoTransaccion setInoMaster()        Sets the current record's "InoMaster" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseInoTransaccion extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ino.tb_transacciones');
        $this->hasColumn('ca_idtransaccion', 'integer', null, array(
             'type' => 'integer',
             'autoincrement' => true,
             'primary' => true,
             ));
        $this->hasColumn('ca_idcomprobante', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idcuenta', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idconcepto', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idccosto', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idmaster', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_db', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_valor', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_idmoneda', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_observaciones', 'timestamp', null, array(
             'type' => 'timestamp',
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
        $this->hasOne('InoHouse', array(
             'local' => 'ca_idhouse',
             'foreign' => 'ca_idhouse'));

        $this->hasOne('InoCentroCosto', array(
             'local' => 'ca_idccosto',
             'foreign' => 'ca_idccosto'));

        $this->hasOne('Usuario as UsuCreado', array(
             'local' => 'ca_usucreado',
             'foreign' => 'ca_login'));

        $this->hasOne('InoComprobante', array(
             'local' => 'ca_idcomprobante',
             'foreign' => 'ca_idcomprobante'));

        $this->hasOne('InoCuenta', array(
             'local' => 'ca_idcuenta',
             'foreign' => 'ca_idcuenta'));

        $this->hasOne('InoConcepto', array(
             'local' => 'ca_idconcepto',
             'foreign' => 'ca_idconcepto'));

        $this->hasOne('InoMaster', array(
             'local' => 'ca_idmaster',
             'foreign' => 'ca_idmaster'));
    }
}