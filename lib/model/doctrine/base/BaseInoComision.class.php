<?php

/**
 * BaseInoComision
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idcomision
 * @property integer $ca_idhouse
 * @property integer $ca_idutilidad
 * @property decimal $ca_valor
 * @property decimal $ca_comision
 * @property string $ca_vendedor
 * @property integer $ca_consecutivo
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property timestamp $ca_fchactualizado
 * @property string $ca_usuactualizado
 * @property timestamp $ca_fchliquidado
 * @property string $ca_usuliquidado
 * @property timestamp $ca_fchanulado
 * @property string $ca_usuanulado
 * @property timestamp $ca_fchimpreso
 * @property string $ca_usuimpreso
 * @property InoHouse $InoHouse
 * @property InoUtilidad $InoUtilidad
 * @property Usuario $Vendedor
 * @property Usuario $UsuCreado
 * @property Usuario $UsuActualizado
 * @property Usuario $UsuAnulado
 * @property Usuario $UsuImpreso
 * 
 * @method integer     getCaIdcomision()      Returns the current record's "ca_idcomision" value
 * @method integer     getCaIdhouse()         Returns the current record's "ca_idhouse" value
 * @method integer     getCaIdutilidad()      Returns the current record's "ca_idutilidad" value
 * @method decimal     getCaValor()           Returns the current record's "ca_valor" value
 * @method decimal     getCaComision()        Returns the current record's "ca_comision" value
 * @method string      getCaVendedor()        Returns the current record's "ca_vendedor" value
 * @method integer     getCaConsecutivo()     Returns the current record's "ca_consecutivo" value
 * @method timestamp   getCaFchcreado()       Returns the current record's "ca_fchcreado" value
 * @method string      getCaUsucreado()       Returns the current record's "ca_usucreado" value
 * @method timestamp   getCaFchactualizado()  Returns the current record's "ca_fchactualizado" value
 * @method string      getCaUsuactualizado()  Returns the current record's "ca_usuactualizado" value
 * @method timestamp   getCaFchliquidado()    Returns the current record's "ca_fchliquidado" value
 * @method string      getCaUsuliquidado()    Returns the current record's "ca_usuliquidado" value
 * @method timestamp   getCaFchanulado()      Returns the current record's "ca_fchanulado" value
 * @method string      getCaUsuanulado()      Returns the current record's "ca_usuanulado" value
 * @method timestamp   getCaFchimpreso()      Returns the current record's "ca_fchimpreso" value
 * @method string      getCaUsuimpreso()      Returns the current record's "ca_usuimpreso" value
 * @method InoHouse    getInoHouse()          Returns the current record's "InoHouse" value
 * @method InoUtilidad getInoUtilidad()       Returns the current record's "InoUtilidad" value
 * @method Usuario     getVendedor()          Returns the current record's "Vendedor" value
 * @method Usuario     getUsuCreado()         Returns the current record's "UsuCreado" value
 * @method Usuario     getUsuActualizado()    Returns the current record's "UsuActualizado" value
 * @method Usuario     getUsuAnulado()        Returns the current record's "UsuAnulado" value
 * @method Usuario     getUsuImpreso()        Returns the current record's "UsuImpreso" value
 * @method InoComision setCaIdcomision()      Sets the current record's "ca_idcomision" value
 * @method InoComision setCaIdhouse()         Sets the current record's "ca_idhouse" value
 * @method InoComision setCaIdutilidad()      Sets the current record's "ca_idutilidad" value
 * @method InoComision setCaValor()           Sets the current record's "ca_valor" value
 * @method InoComision setCaComision()        Sets the current record's "ca_comision" value
 * @method InoComision setCaVendedor()        Sets the current record's "ca_vendedor" value
 * @method InoComision setCaConsecutivo()     Sets the current record's "ca_consecutivo" value
 * @method InoComision setCaFchcreado()       Sets the current record's "ca_fchcreado" value
 * @method InoComision setCaUsucreado()       Sets the current record's "ca_usucreado" value
 * @method InoComision setCaFchactualizado()  Sets the current record's "ca_fchactualizado" value
 * @method InoComision setCaUsuactualizado()  Sets the current record's "ca_usuactualizado" value
 * @method InoComision setCaFchliquidado()    Sets the current record's "ca_fchliquidado" value
 * @method InoComision setCaUsuliquidado()    Sets the current record's "ca_usuliquidado" value
 * @method InoComision setCaFchanulado()      Sets the current record's "ca_fchanulado" value
 * @method InoComision setCaUsuanulado()      Sets the current record's "ca_usuanulado" value
 * @method InoComision setCaFchimpreso()      Sets the current record's "ca_fchimpreso" value
 * @method InoComision setCaUsuimpreso()      Sets the current record's "ca_usuimpreso" value
 * @method InoComision setInoHouse()          Sets the current record's "InoHouse" value
 * @method InoComision setInoUtilidad()       Sets the current record's "InoUtilidad" value
 * @method InoComision setVendedor()          Sets the current record's "Vendedor" value
 * @method InoComision setUsuCreado()         Sets the current record's "UsuCreado" value
 * @method InoComision setUsuActualizado()    Sets the current record's "UsuActualizado" value
 * @method InoComision setUsuAnulado()        Sets the current record's "UsuAnulado" value
 * @method InoComision setUsuImpreso()        Sets the current record's "UsuImpreso" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseInoComision extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ino.tb_comisiones');
        $this->hasColumn('ca_idcomision', 'integer', null, array(
             'type' => 'integer',
             'autoincrement' => true,
             'primary' => true,
             ));
        $this->hasColumn('ca_idhouse', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idutilidad', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_valor', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_comision', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_vendedor', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_consecutivo', 'integer', null, array(
             'type' => 'integer',
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
        $this->hasColumn('ca_usuliquidado', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchanulado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usuanulado', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchimpreso', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usuimpreso', 'string', null, array(
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

        $this->hasOne('InoUtilidad', array(
             'local' => 'ca_idutilidad',
             'foreign' => 'ca_idutilidad'));

        $this->hasOne('Usuario as Vendedor', array(
             'local' => 'ca_vendedor',
             'foreign' => 'ca_login'));

        $this->hasOne('Usuario as UsuCreado', array(
             'local' => 'ca_usucreado',
             'foreign' => 'ca_login'));

        $this->hasOne('Usuario as UsuActualizado', array(
             'local' => 'ca_usuactualizado',
             'foreign' => 'ca_login'));

        $this->hasOne('Usuario as UsuAnulado', array(
             'local' => 'ca_usuanulado',
             'foreign' => 'ca_login'));

        $this->hasOne('Usuario as UsuImpreso', array(
             'local' => 'ca_usuimpreso',
             'foreign' => 'ca_login'));
    }
}