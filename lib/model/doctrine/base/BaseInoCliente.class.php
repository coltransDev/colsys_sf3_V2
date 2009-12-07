<?php

/**
 * BaseInoCliente
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idinocliente
 * @property integer $ca_idmaestra
 * @property integer $ca_idcliente
 * @property string $ca_doctransporte
 * @property date $ca_fchdoctransporte
 * @property integer $ca_idreporte
 * @property integer $ca_idproveedor
 * @property string $ca_proveedor
 * @property decimal $ca_numpiezas
 * @property decimal $ca_peso
 * @property decimal $ca_volumen
 * @property string $ca_numorden
 * @property string $ca_vendedor
 * @property integer $ca_idsubtrayecto
 * @property integer $ca_idbodega
 * @property string $ca_observaciones
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property timestamp $ca_fchactualizado
 * @property string $ca_usuactualizado
 * @property Ids $Ids
 * @property InoMaestra $InoMaestra
 * @property Doctrine_Collection $InoComprobante
 * @property Tercero $Proveedor
 * @property Usuario $Vendedor
 * @property Usuario $UsuCreado
 * @property Usuario $UsuActualizado
 * @property Doctrine_Collection $InoTransaccion
 * 
 * @method integer             getCaIdinocliente()      Returns the current record's "ca_idinocliente" value
 * @method integer             getCaIdmaestra()         Returns the current record's "ca_idmaestra" value
 * @method integer             getCaIdcliente()         Returns the current record's "ca_idcliente" value
 * @method string              getCaDoctransporte()     Returns the current record's "ca_doctransporte" value
 * @method date                getCaFchdoctransporte()  Returns the current record's "ca_fchdoctransporte" value
 * @method integer             getCaIdreporte()         Returns the current record's "ca_idreporte" value
 * @method integer             getCaIdproveedor()       Returns the current record's "ca_idproveedor" value
 * @method string              getCaProveedor()         Returns the current record's "ca_proveedor" value
 * @method decimal             getCaNumpiezas()         Returns the current record's "ca_numpiezas" value
 * @method decimal             getCaPeso()              Returns the current record's "ca_peso" value
 * @method decimal             getCaVolumen()           Returns the current record's "ca_volumen" value
 * @method string              getCaNumorden()          Returns the current record's "ca_numorden" value
 * @method string              getCaVendedor()          Returns the current record's "ca_vendedor" value
 * @method integer             getCaIdsubtrayecto()     Returns the current record's "ca_idsubtrayecto" value
 * @method integer             getCaIdbodega()          Returns the current record's "ca_idbodega" value
 * @method string              getCaObservaciones()     Returns the current record's "ca_observaciones" value
 * @method timestamp           getCaFchcreado()         Returns the current record's "ca_fchcreado" value
 * @method string              getCaUsucreado()         Returns the current record's "ca_usucreado" value
 * @method timestamp           getCaFchactualizado()    Returns the current record's "ca_fchactualizado" value
 * @method string              getCaUsuactualizado()    Returns the current record's "ca_usuactualizado" value
 * @method Ids                 getIds()                 Returns the current record's "Ids" value
 * @method InoMaestra          getInoMaestra()          Returns the current record's "InoMaestra" value
 * @method Doctrine_Collection getInoComprobante()      Returns the current record's "InoComprobante" collection
 * @method Tercero             getProveedor()           Returns the current record's "Proveedor" value
 * @method Usuario             getVendedor()            Returns the current record's "Vendedor" value
 * @method Usuario             getUsuCreado()           Returns the current record's "UsuCreado" value
 * @method Usuario             getUsuActualizado()      Returns the current record's "UsuActualizado" value
 * @method Doctrine_Collection getInoTransaccion()      Returns the current record's "InoTransaccion" collection
 * @method InoCliente          setCaIdinocliente()      Sets the current record's "ca_idinocliente" value
 * @method InoCliente          setCaIdmaestra()         Sets the current record's "ca_idmaestra" value
 * @method InoCliente          setCaIdcliente()         Sets the current record's "ca_idcliente" value
 * @method InoCliente          setCaDoctransporte()     Sets the current record's "ca_doctransporte" value
 * @method InoCliente          setCaFchdoctransporte()  Sets the current record's "ca_fchdoctransporte" value
 * @method InoCliente          setCaIdreporte()         Sets the current record's "ca_idreporte" value
 * @method InoCliente          setCaIdproveedor()       Sets the current record's "ca_idproveedor" value
 * @method InoCliente          setCaProveedor()         Sets the current record's "ca_proveedor" value
 * @method InoCliente          setCaNumpiezas()         Sets the current record's "ca_numpiezas" value
 * @method InoCliente          setCaPeso()              Sets the current record's "ca_peso" value
 * @method InoCliente          setCaVolumen()           Sets the current record's "ca_volumen" value
 * @method InoCliente          setCaNumorden()          Sets the current record's "ca_numorden" value
 * @method InoCliente          setCaVendedor()          Sets the current record's "ca_vendedor" value
 * @method InoCliente          setCaIdsubtrayecto()     Sets the current record's "ca_idsubtrayecto" value
 * @method InoCliente          setCaIdbodega()          Sets the current record's "ca_idbodega" value
 * @method InoCliente          setCaObservaciones()     Sets the current record's "ca_observaciones" value
 * @method InoCliente          setCaFchcreado()         Sets the current record's "ca_fchcreado" value
 * @method InoCliente          setCaUsucreado()         Sets the current record's "ca_usucreado" value
 * @method InoCliente          setCaFchactualizado()    Sets the current record's "ca_fchactualizado" value
 * @method InoCliente          setCaUsuactualizado()    Sets the current record's "ca_usuactualizado" value
 * @method InoCliente          setIds()                 Sets the current record's "Ids" value
 * @method InoCliente          setInoMaestra()          Sets the current record's "InoMaestra" value
 * @method InoCliente          setInoComprobante()      Sets the current record's "InoComprobante" collection
 * @method InoCliente          setProveedor()           Sets the current record's "Proveedor" value
 * @method InoCliente          setVendedor()            Sets the current record's "Vendedor" value
 * @method InoCliente          setUsuCreado()           Sets the current record's "UsuCreado" value
 * @method InoCliente          setUsuActualizado()      Sets the current record's "UsuActualizado" value
 * @method InoCliente          setInoTransaccion()      Sets the current record's "InoTransaccion" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseInoCliente extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ino.tb_clientes');
        $this->hasColumn('ca_idinocliente', 'integer', null, array(
             'type' => 'integer',
             'autoincrement' => true,
             'primary' => true,
             ));
        $this->hasColumn('ca_idmaestra', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('ca_idcliente', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('ca_doctransporte', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('ca_fchdoctransporte', 'date', null, array(
             'type' => 'date',
             'notnull' => true,
             ));
        $this->hasColumn('ca_idreporte', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('ca_idproveedor', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('ca_proveedor', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_numpiezas', 'decimal', null, array(
             'type' => 'decimal',
             'notnull' => true,
             ));
        $this->hasColumn('ca_peso', 'decimal', null, array(
             'type' => 'decimal',
             'notnull' => true,
             ));
        $this->hasColumn('ca_volumen', 'decimal', null, array(
             'type' => 'decimal',
             'notnull' => true,
             ));
        $this->hasColumn('ca_numorden', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('ca_vendedor', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('ca_idsubtrayecto', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idbodega', 'integer', null, array(
             'type' => 'integer',
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
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Ids', array(
             'local' => 'ca_idcliente',
             'foreign' => 'ca_id'));

        $this->hasOne('InoMaestra', array(
             'local' => 'ca_idmaestra',
             'foreign' => 'ca_idmaestra'));

        $this->hasMany('InoComprobante', array(
             'local' => 'ca_idinocliente',
             'foreign' => 'ca_idinocliente'));

        $this->hasOne('Tercero as Proveedor', array(
             'local' => 'ca_idproveedor',
             'foreign' => 'ca_idtercero'));

        $this->hasOne('Usuario as Vendedor', array(
             'local' => 'ca_vendedor',
             'foreign' => 'ca_login'));

        $this->hasOne('Usuario as UsuCreado', array(
             'local' => 'ca_usucreado',
             'foreign' => 'ca_login'));

        $this->hasOne('Usuario as UsuActualizado', array(
             'local' => 'ca_usuactualizado',
             'foreign' => 'ca_login'));

        $this->hasMany('InoTransaccion', array(
             'local' => 'ca_idinocliente',
             'foreign' => 'ca_idinocliente'));
    }
}