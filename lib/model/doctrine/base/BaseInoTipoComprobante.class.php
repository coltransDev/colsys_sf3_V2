<?php

/**
 * BaseInoTipoComprobante
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idtipo
 * @property string $ca_tipo
 * @property integer $ca_comprobante
 * @property string $ca_descripcion
 * @property string $ca_titulo
 * @property integer $ca_numeracion_inicial
 * @property string $ca_mensaje
 * @property string $ca_noautorizacion
 * @property date $ca_fchautorizacion
 * @property string $ca_prefijo_aut
 * @property integer $ca_inicial_aut
 * @property integer $ca_final_aut
 * @property boolean $ca_activo
 * @property integer $ca_idsucursal
 * @property integer $ca_idcta_cierre
 * @property integer $ca_idcta_iva
 * @property IdsSucursal $IdsSucursal
 * @property Doctrine_Collection $InoComprobante
 * 
 * @method integer             getCaIdtipo()              Returns the current record's "ca_idtipo" value
 * @method string              getCaTipo()                Returns the current record's "ca_tipo" value
 * @method integer             getCaComprobante()         Returns the current record's "ca_comprobante" value
 * @method string              getCaDescripcion()         Returns the current record's "ca_descripcion" value
 * @method string              getCaTitulo()              Returns the current record's "ca_titulo" value
 * @method integer             getCaNumeracionInicial()   Returns the current record's "ca_numeracion_inicial" value
 * @method string              getCaMensaje()             Returns the current record's "ca_mensaje" value
 * @method string              getCaNoautorizacion()      Returns the current record's "ca_noautorizacion" value
 * @method date                getCaFchautorizacion()     Returns the current record's "ca_fchautorizacion" value
 * @method string              getCaPrefijoAut()          Returns the current record's "ca_prefijo_aut" value
 * @method integer             getCaInicialAut()          Returns the current record's "ca_inicial_aut" value
 * @method integer             getCaFinalAut()            Returns the current record's "ca_final_aut" value
 * @method boolean             getCaActivo()              Returns the current record's "ca_activo" value
 * @method integer             getCaIdsucursal()          Returns the current record's "ca_idsucursal" value
 * @method integer             getCaIdctaCierre()         Returns the current record's "ca_idcta_cierre" value
 * @method integer             getCaIdctaIva()            Returns the current record's "ca_idcta_iva" value
 * @method IdsSucursal         getIdsSucursal()           Returns the current record's "IdsSucursal" value
 * @method Doctrine_Collection getInoComprobante()        Returns the current record's "InoComprobante" collection
 * @method InoTipoComprobante  setCaIdtipo()              Sets the current record's "ca_idtipo" value
 * @method InoTipoComprobante  setCaTipo()                Sets the current record's "ca_tipo" value
 * @method InoTipoComprobante  setCaComprobante()         Sets the current record's "ca_comprobante" value
 * @method InoTipoComprobante  setCaDescripcion()         Sets the current record's "ca_descripcion" value
 * @method InoTipoComprobante  setCaTitulo()              Sets the current record's "ca_titulo" value
 * @method InoTipoComprobante  setCaNumeracionInicial()   Sets the current record's "ca_numeracion_inicial" value
 * @method InoTipoComprobante  setCaMensaje()             Sets the current record's "ca_mensaje" value
 * @method InoTipoComprobante  setCaNoautorizacion()      Sets the current record's "ca_noautorizacion" value
 * @method InoTipoComprobante  setCaFchautorizacion()     Sets the current record's "ca_fchautorizacion" value
 * @method InoTipoComprobante  setCaPrefijoAut()          Sets the current record's "ca_prefijo_aut" value
 * @method InoTipoComprobante  setCaInicialAut()          Sets the current record's "ca_inicial_aut" value
 * @method InoTipoComprobante  setCaFinalAut()            Sets the current record's "ca_final_aut" value
 * @method InoTipoComprobante  setCaActivo()              Sets the current record's "ca_activo" value
 * @method InoTipoComprobante  setCaIdsucursal()          Sets the current record's "ca_idsucursal" value
 * @method InoTipoComprobante  setCaIdctaCierre()         Sets the current record's "ca_idcta_cierre" value
 * @method InoTipoComprobante  setCaIdctaIva()            Sets the current record's "ca_idcta_iva" value
 * @method InoTipoComprobante  setIdsSucursal()           Sets the current record's "IdsSucursal" value
 * @method InoTipoComprobante  setInoComprobante()        Sets the current record's "InoComprobante" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseInoTipoComprobante extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ino.tb_tipos_comprobante');
        $this->hasColumn('ca_idtipo', 'integer', null, array(
             'type' => 'integer',
             'autoincrement' => true,
             'primary' => true,
             ));
        $this->hasColumn('ca_tipo', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('ca_comprobante', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('ca_descripcion', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_titulo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_numeracion_inicial', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('ca_mensaje', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_noautorizacion', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchautorizacion', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_prefijo_aut', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_inicial_aut', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_final_aut', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_activo', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_idsucursal', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idcta_cierre', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idcta_iva', 'integer', null, array(
             'type' => 'integer',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('IdsSucursal', array(
             'local' => 'ca_idsucursal',
             'foreign' => 'ca_idsucursal'));

        $this->hasMany('InoComprobante', array(
             'local' => 'ca_idtipo',
             'foreign' => 'ca_idtipo'));
    }
}