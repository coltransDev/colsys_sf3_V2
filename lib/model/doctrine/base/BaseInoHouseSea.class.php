<?php

/**
 * BaseInoHouseSea
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idhouse
 * @property date $ca_fchliberacion
 * @property timestamp $ca_fchliberado
 * @property timestamp $ca_fchlibero
 * @property string $ca_continuacion
 * @property string $ca_continuacion_dest
 * @property boolean $ca_imprimirorigen
 * @property string $ca_datos
 * @property string $ca_datosmuisca
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property timestamp $ca_fchactualizado
 * @property string $ca_usuactualizado
 * @property InoHouse $InoHouse
 * @property Usuario $UsuCreado
 * @property Usuario $UsuActualizado
 * 
 * @method integer     getCaIdhouse()            Returns the current record's "ca_idhouse" value
 * @method date        getCaFchliberacion()      Returns the current record's "ca_fchliberacion" value
 * @method timestamp   getCaFchliberado()        Returns the current record's "ca_fchliberado" value
 * @method timestamp   getCaFchlibero()          Returns the current record's "ca_fchlibero" value
 * @method string      getCaContinuacion()       Returns the current record's "ca_continuacion" value
 * @method string      getCaContinuacionDest()   Returns the current record's "ca_continuacion_dest" value
 * @method boolean     getCaImprimirorigen()     Returns the current record's "ca_imprimirorigen" value
 * @method string      getCaDatos()              Returns the current record's "ca_datos" value
 * @method string      getCaDatosmuisca()        Returns the current record's "ca_datosmuisca" value
 * @method timestamp   getCaFchcreado()          Returns the current record's "ca_fchcreado" value
 * @method string      getCaUsucreado()          Returns the current record's "ca_usucreado" value
 * @method timestamp   getCaFchactualizado()     Returns the current record's "ca_fchactualizado" value
 * @method string      getCaUsuactualizado()     Returns the current record's "ca_usuactualizado" value
 * @method InoHouse    getInoHouse()             Returns the current record's "InoHouse" value
 * @method Usuario     getUsuCreado()            Returns the current record's "UsuCreado" value
 * @method Usuario     getUsuActualizado()       Returns the current record's "UsuActualizado" value
 * @method InoHouseSea setCaIdhouse()            Sets the current record's "ca_idhouse" value
 * @method InoHouseSea setCaFchliberacion()      Sets the current record's "ca_fchliberacion" value
 * @method InoHouseSea setCaFchliberado()        Sets the current record's "ca_fchliberado" value
 * @method InoHouseSea setCaFchlibero()          Sets the current record's "ca_fchlibero" value
 * @method InoHouseSea setCaContinuacion()       Sets the current record's "ca_continuacion" value
 * @method InoHouseSea setCaContinuacionDest()   Sets the current record's "ca_continuacion_dest" value
 * @method InoHouseSea setCaImprimirorigen()     Sets the current record's "ca_imprimirorigen" value
 * @method InoHouseSea setCaDatos()              Sets the current record's "ca_datos" value
 * @method InoHouseSea setCaDatosmuisca()        Sets the current record's "ca_datosmuisca" value
 * @method InoHouseSea setCaFchcreado()          Sets the current record's "ca_fchcreado" value
 * @method InoHouseSea setCaUsucreado()          Sets the current record's "ca_usucreado" value
 * @method InoHouseSea setCaFchactualizado()     Sets the current record's "ca_fchactualizado" value
 * @method InoHouseSea setCaUsuactualizado()     Sets the current record's "ca_usuactualizado" value
 * @method InoHouseSea setInoHouse()             Sets the current record's "InoHouse" value
 * @method InoHouseSea setUsuCreado()            Sets the current record's "UsuCreado" value
 * @method InoHouseSea setUsuActualizado()       Sets the current record's "UsuActualizado" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseInoHouseSea extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ino.tb_house_sea');
        $this->hasColumn('ca_idhouse', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_fchliberacion', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_fchliberado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_fchlibero', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_continuacion', 'string', 10, array(
             'type' => 'string',
             'length' => '10',
             ));
        $this->hasColumn('ca_continuacion_dest', 'string', 8, array(
             'type' => 'string',
             'length' => '8',
             ));
        $this->hasColumn('ca_imprimirorigen', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_datos', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_datosmuisca', 'string', null, array(
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
        $this->hasOne('InoHouse', array(
             'local' => 'ca_idhouse',
             'foreign' => 'ca_idhouse'));

        $this->hasOne('Usuario as UsuCreado', array(
             'local' => 'ca_usucreado',
             'foreign' => 'ca_login'));

        $this->hasOne('Usuario as UsuActualizado', array(
             'local' => 'ca_usuactualizado',
             'foreign' => 'ca_login'));
    }
}