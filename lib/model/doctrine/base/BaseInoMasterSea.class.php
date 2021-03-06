<?php

/**
 * BaseInoMasterSea
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idmaster
 * @property date $ca_fchdesconsolidacion
 * @property date $ca_fchconfirmacion
 * @property time $ca_horaconfirmacion
 * @property timestamp $ca_fchconfirmado
 * @property string $ca_usuconfirmado
 * @property date $ca_fchvaciado
 * @property time $ca_horavaciado
 * @property timestamp $ca_fchmuisca
 * @property string $ca_usumuisca
 * @property date $ca_fchfinmuisca
 * @property boolean $ca_carpeta
 * @property string $ca_estado
 * @property timestamp $ca_fchenvio
 * @property string $ca_datos
 * @property string $ca_datosmuisca
 * @property timestamp $ca_fchrecibido
 * @property integer $ca_idmuelle
 * @property InoMaster $InoMaster
 * @property InoDianDepositos $InoDianDepositos
 * 
 * @method integer          getCaIdmaster()             Returns the current record's "ca_idmaster" value
 * @method date             getCaFchdesconsolidacion()  Returns the current record's "ca_fchdesconsolidacion" value
 * @method date             getCaFchconfirmacion()      Returns the current record's "ca_fchconfirmacion" value
 * @method time             getCaHoraconfirmacion()     Returns the current record's "ca_horaconfirmacion" value
 * @method timestamp        getCaFchconfirmado()        Returns the current record's "ca_fchconfirmado" value
 * @method string           getCaUsuconfirmado()        Returns the current record's "ca_usuconfirmado" value
 * @method date             getCaFchvaciado()           Returns the current record's "ca_fchvaciado" value
 * @method time             getCaHoravaciado()          Returns the current record's "ca_horavaciado" value
 * @method timestamp        getCaFchmuisca()            Returns the current record's "ca_fchmuisca" value
 * @method string           getCaUsumuisca()            Returns the current record's "ca_usumuisca" value
 * @method date             getCaFchfinmuisca()         Returns the current record's "ca_fchfinmuisca" value
 * @method boolean          getCaCarpeta()              Returns the current record's "ca_carpeta" value
 * @method string           getCaEstado()               Returns the current record's "ca_estado" value
 * @method timestamp        getCaFchenvio()             Returns the current record's "ca_fchenvio" value
 * @method string           getCaDatos()                Returns the current record's "ca_datos" value
 * @method string           getCaDatosmuisca()          Returns the current record's "ca_datosmuisca" value
 * @method timestamp        getCaFchrecibido()          Returns the current record's "ca_fchrecibido" value
 * @method integer          getCaIdmuelle()             Returns the current record's "ca_idmuelle" value
 * @method InoMaster        getInoMaster()              Returns the current record's "InoMaster" value
 * @method InoDianDepositos getInoDianDepositos()       Returns the current record's "InoDianDepositos" value
 * @method InoMasterSea     setCaIdmaster()             Sets the current record's "ca_idmaster" value
 * @method InoMasterSea     setCaFchdesconsolidacion()  Sets the current record's "ca_fchdesconsolidacion" value
 * @method InoMasterSea     setCaFchconfirmacion()      Sets the current record's "ca_fchconfirmacion" value
 * @method InoMasterSea     setCaHoraconfirmacion()     Sets the current record's "ca_horaconfirmacion" value
 * @method InoMasterSea     setCaFchconfirmado()        Sets the current record's "ca_fchconfirmado" value
 * @method InoMasterSea     setCaUsuconfirmado()        Sets the current record's "ca_usuconfirmado" value
 * @method InoMasterSea     setCaFchvaciado()           Sets the current record's "ca_fchvaciado" value
 * @method InoMasterSea     setCaHoravaciado()          Sets the current record's "ca_horavaciado" value
 * @method InoMasterSea     setCaFchmuisca()            Sets the current record's "ca_fchmuisca" value
 * @method InoMasterSea     setCaUsumuisca()            Sets the current record's "ca_usumuisca" value
 * @method InoMasterSea     setCaFchfinmuisca()         Sets the current record's "ca_fchfinmuisca" value
 * @method InoMasterSea     setCaCarpeta()              Sets the current record's "ca_carpeta" value
 * @method InoMasterSea     setCaEstado()               Sets the current record's "ca_estado" value
 * @method InoMasterSea     setCaFchenvio()             Sets the current record's "ca_fchenvio" value
 * @method InoMasterSea     setCaDatos()                Sets the current record's "ca_datos" value
 * @method InoMasterSea     setCaDatosmuisca()          Sets the current record's "ca_datosmuisca" value
 * @method InoMasterSea     setCaFchrecibido()          Sets the current record's "ca_fchrecibido" value
 * @method InoMasterSea     setCaIdmuelle()             Sets the current record's "ca_idmuelle" value
 * @method InoMasterSea     setInoMaster()              Sets the current record's "InoMaster" value
 * @method InoMasterSea     setInoDianDepositos()       Sets the current record's "InoDianDepositos" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseInoMasterSea extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ino.tb_master_sea');
        $this->hasColumn('ca_idmaster', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_fchdesconsolidacion', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_fchconfirmacion', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_horaconfirmacion', 'time', null, array(
             'type' => 'time',
             ));
        $this->hasColumn('ca_fchconfirmado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usuconfirmado', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchvaciado', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_horavaciado', 'time', null, array(
             'type' => 'time',
             ));
        $this->hasColumn('ca_fchmuisca', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usumuisca', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchfinmuisca', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_carpeta', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_estado', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchenvio', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_datos', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_datosmuisca', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchrecibido', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_idmuelle', 'integer', null, array(
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
        $this->hasOne('InoMaster', array(
             'local' => 'ca_idmaster',
             'foreign' => 'ca_idmaster'));

        $this->hasOne('InoDianDepositos', array(
             'local' => 'ca_idmuelle',
             'foreign' => 'ca_codigo'));
    }
}