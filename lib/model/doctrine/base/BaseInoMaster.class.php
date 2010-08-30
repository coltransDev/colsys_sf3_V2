<?php

/**
 * BaseInoMaster
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idmaster
 * @property date $ca_fchreferencia
 * @property string $ca_referencia
 * @property string $ca_impoexpo
 * @property string $ca_transporte
 * @property string $ca_modalidad
 * @property string $ca_origen
 * @property string $ca_destino
 * @property integer $ca_idlinea
 * @property integer $ca_idagente
 * @property string $ca_master
 * @property date $ca_fchmaster
 * @property decimal $ca_piezas
 * @property decimal $ca_peso
 * @property decimal $ca_volumen
 * @property string $ca_observaciones
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property timestamp $ca_fchactualizado
 * @property string $ca_usuactualizado
 * @property timestamp $ca_fchliquidado
 * @property string $ca_usuliquidado
 * @property timestamp $ca_fchcerrado
 * @property string $ca_usucerrado
 * @property timestamp $ca_fchanulado
 * @property string $ca_usuanulado
 * @property Doctrine_Collection $InoHouse
 * @property Ciudad $Origen
 * @property Ciudad $Destino
 * @property IdsProveedor $IdsProveedor
 * @property Usuario $UsuCreado
 * @property Usuario $UsuActualizado
 * @property Usuario $UsuLiquidado
 * @property Usuario $UsuCerrado
 * @property Usuario $UsuAnulado
 * @property Doctrine_Collection $InoTransaccion
 * 
 * @method integer             getCaIdmaster()        Returns the current record's "ca_idmaster" value
 * @method date                getCaFchreferencia()   Returns the current record's "ca_fchreferencia" value
 * @method string              getCaReferencia()      Returns the current record's "ca_referencia" value
 * @method string              getCaImpoexpo()        Returns the current record's "ca_impoexpo" value
 * @method string              getCaTransporte()      Returns the current record's "ca_transporte" value
 * @method string              getCaModalidad()       Returns the current record's "ca_modalidad" value
 * @method string              getCaOrigen()          Returns the current record's "ca_origen" value
 * @method string              getCaDestino()         Returns the current record's "ca_destino" value
 * @method integer             getCaIdlinea()         Returns the current record's "ca_idlinea" value
 * @method integer             getCaIdagente()        Returns the current record's "ca_idagente" value
 * @method string              getCaMaster()          Returns the current record's "ca_master" value
 * @method date                getCaFchmaster()       Returns the current record's "ca_fchmaster" value
 * @method decimal             getCaPiezas()          Returns the current record's "ca_piezas" value
 * @method decimal             getCaPeso()            Returns the current record's "ca_peso" value
 * @method decimal             getCaVolumen()         Returns the current record's "ca_volumen" value
 * @method string              getCaObservaciones()   Returns the current record's "ca_observaciones" value
 * @method timestamp           getCaFchcreado()       Returns the current record's "ca_fchcreado" value
 * @method string              getCaUsucreado()       Returns the current record's "ca_usucreado" value
 * @method timestamp           getCaFchactualizado()  Returns the current record's "ca_fchactualizado" value
 * @method string              getCaUsuactualizado()  Returns the current record's "ca_usuactualizado" value
 * @method timestamp           getCaFchliquidado()    Returns the current record's "ca_fchliquidado" value
 * @method string              getCaUsuliquidado()    Returns the current record's "ca_usuliquidado" value
 * @method timestamp           getCaFchcerrado()      Returns the current record's "ca_fchcerrado" value
 * @method string              getCaUsucerrado()      Returns the current record's "ca_usucerrado" value
 * @method timestamp           getCaFchanulado()      Returns the current record's "ca_fchanulado" value
 * @method string              getCaUsuanulado()      Returns the current record's "ca_usuanulado" value
 * @method Doctrine_Collection getInoHouse()          Returns the current record's "InoHouse" collection
 * @method Ciudad              getOrigen()            Returns the current record's "Origen" value
 * @method Ciudad              getDestino()           Returns the current record's "Destino" value
 * @method IdsProveedor        getIdsProveedor()      Returns the current record's "IdsProveedor" value
 * @method Usuario             getUsuCreado()         Returns the current record's "UsuCreado" value
 * @method Usuario             getUsuActualizado()    Returns the current record's "UsuActualizado" value
 * @method Usuario             getUsuLiquidado()      Returns the current record's "UsuLiquidado" value
 * @method Usuario             getUsuCerrado()        Returns the current record's "UsuCerrado" value
 * @method Usuario             getUsuAnulado()        Returns the current record's "UsuAnulado" value
 * @method Doctrine_Collection getInoTransaccion()    Returns the current record's "InoTransaccion" collection
 * @method InoMaster           setCaIdmaster()        Sets the current record's "ca_idmaster" value
 * @method InoMaster           setCaFchreferencia()   Sets the current record's "ca_fchreferencia" value
 * @method InoMaster           setCaReferencia()      Sets the current record's "ca_referencia" value
 * @method InoMaster           setCaImpoexpo()        Sets the current record's "ca_impoexpo" value
 * @method InoMaster           setCaTransporte()      Sets the current record's "ca_transporte" value
 * @method InoMaster           setCaModalidad()       Sets the current record's "ca_modalidad" value
 * @method InoMaster           setCaOrigen()          Sets the current record's "ca_origen" value
 * @method InoMaster           setCaDestino()         Sets the current record's "ca_destino" value
 * @method InoMaster           setCaIdlinea()         Sets the current record's "ca_idlinea" value
 * @method InoMaster           setCaIdagente()        Sets the current record's "ca_idagente" value
 * @method InoMaster           setCaMaster()          Sets the current record's "ca_master" value
 * @method InoMaster           setCaFchmaster()       Sets the current record's "ca_fchmaster" value
 * @method InoMaster           setCaPiezas()          Sets the current record's "ca_piezas" value
 * @method InoMaster           setCaPeso()            Sets the current record's "ca_peso" value
 * @method InoMaster           setCaVolumen()         Sets the current record's "ca_volumen" value
 * @method InoMaster           setCaObservaciones()   Sets the current record's "ca_observaciones" value
 * @method InoMaster           setCaFchcreado()       Sets the current record's "ca_fchcreado" value
 * @method InoMaster           setCaUsucreado()       Sets the current record's "ca_usucreado" value
 * @method InoMaster           setCaFchactualizado()  Sets the current record's "ca_fchactualizado" value
 * @method InoMaster           setCaUsuactualizado()  Sets the current record's "ca_usuactualizado" value
 * @method InoMaster           setCaFchliquidado()    Sets the current record's "ca_fchliquidado" value
 * @method InoMaster           setCaUsuliquidado()    Sets the current record's "ca_usuliquidado" value
 * @method InoMaster           setCaFchcerrado()      Sets the current record's "ca_fchcerrado" value
 * @method InoMaster           setCaUsucerrado()      Sets the current record's "ca_usucerrado" value
 * @method InoMaster           setCaFchanulado()      Sets the current record's "ca_fchanulado" value
 * @method InoMaster           setCaUsuanulado()      Sets the current record's "ca_usuanulado" value
 * @method InoMaster           setInoHouse()          Sets the current record's "InoHouse" collection
 * @method InoMaster           setOrigen()            Sets the current record's "Origen" value
 * @method InoMaster           setDestino()           Sets the current record's "Destino" value
 * @method InoMaster           setIdsProveedor()      Sets the current record's "IdsProveedor" value
 * @method InoMaster           setUsuCreado()         Sets the current record's "UsuCreado" value
 * @method InoMaster           setUsuActualizado()    Sets the current record's "UsuActualizado" value
 * @method InoMaster           setUsuLiquidado()      Sets the current record's "UsuLiquidado" value
 * @method InoMaster           setUsuCerrado()        Sets the current record's "UsuCerrado" value
 * @method InoMaster           setUsuAnulado()        Sets the current record's "UsuAnulado" value
 * @method InoMaster           setInoTransaccion()    Sets the current record's "InoTransaccion" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseInoMaster extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ino.tb_master');
        $this->hasColumn('ca_idmaster', 'integer', null, array(
             'type' => 'integer',
             'autoincrement' => true,
             'primary' => true,
             ));
        $this->hasColumn('ca_fchreferencia', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_referencia', 'string', 15, array(
             'type' => 'string',
             'length' => '15',
             ));
        $this->hasColumn('ca_impoexpo', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('ca_transporte', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('ca_modalidad', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('ca_origen', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('ca_destino', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('ca_idlinea', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('ca_idagente', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_master', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('ca_fchmaster', 'date', null, array(
             'type' => 'date',
             'notnull' => true,
             ));
        $this->hasColumn('ca_piezas', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_peso', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_volumen', 'decimal', null, array(
             'type' => 'decimal',
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
        $this->hasColumn('ca_fchcerrado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usucerrado', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchanulado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usuanulado', 'string', null, array(
             'type' => 'string',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('InoHouse', array(
             'local' => 'ca_idmaster',
             'foreign' => 'ca_idmaster'));

        $this->hasOne('Ciudad as Origen', array(
             'local' => 'ca_origen',
             'foreign' => 'ca_idciudad'));

        $this->hasOne('Ciudad as Destino', array(
             'local' => 'ca_destino',
             'foreign' => 'ca_idciudad'));

        $this->hasOne('IdsProveedor', array(
             'local' => 'ca_idlinea',
             'foreign' => 'ca_idproveedor'));

        $this->hasOne('Usuario as UsuCreado', array(
             'local' => 'ca_usucreado',
             'foreign' => 'ca_login'));

        $this->hasOne('Usuario as UsuActualizado', array(
             'local' => 'ca_usuactualizado',
             'foreign' => 'ca_login'));

        $this->hasOne('Usuario as UsuLiquidado', array(
             'local' => 'ca_usuliquidado',
             'foreign' => 'ca_login'));

        $this->hasOne('Usuario as UsuCerrado', array(
             'local' => 'ca_usucerrado',
             'foreign' => 'ca_login'));

        $this->hasOne('Usuario as UsuAnulado', array(
             'local' => 'ca_usuanulado',
             'foreign' => 'ca_login'));

        $this->hasMany('InoTransaccion', array(
             'local' => 'ca_idmaster',
             'foreign' => 'ca_idmaster'));
    }
}