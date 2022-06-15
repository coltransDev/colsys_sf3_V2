<?php

/**
 * BaseGincomexMultimodal
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idgincomex
 * @property string $ca_direccion_recogida
 * @property string $ca_codpostal_recogida
 * @property string $ca_pais_recogida
 * @property string $ca_ciudad_recogida
 * @property string $ca_contacto_recogida
 * @property string $ca_telefono_recogida
 * @property string $ca_email_recogida
 * @property date $ca_fecha_recogida
 * @property string $ca_direccion_entrega
 * @property string $ca_codpostal_entrega
 * @property string $ca_pais_entrega
 * @property string $ca_ciudad_entrega
 * @property string $ca_instrucciones_entrega
 * @property timestamp $ca_fchrecibido
 * @property GincomexDetalle $GincomexDetalle
 * 
 * @method integer            getCaIdgincomex()             Returns the current record's "ca_idgincomex" value
 * @method string             getCaDireccionRecogida()      Returns the current record's "ca_direccion_recogida" value
 * @method string             getCaCodpostalRecogida()      Returns the current record's "ca_codpostal_recogida" value
 * @method string             getCaPaisRecogida()           Returns the current record's "ca_pais_recogida" value
 * @method string             getCaCiudadRecogida()         Returns the current record's "ca_ciudad_recogida" value
 * @method string             getCaContactoRecogida()       Returns the current record's "ca_contacto_recogida" value
 * @method string             getCaTelefonoRecogida()       Returns the current record's "ca_telefono_recogida" value
 * @method string             getCaEmailRecogida()          Returns the current record's "ca_email_recogida" value
 * @method date               getCaFechaRecogida()          Returns the current record's "ca_fecha_recogida" value
 * @method string             getCaDireccionEntrega()       Returns the current record's "ca_direccion_entrega" value
 * @method string             getCaCodpostalEntrega()       Returns the current record's "ca_codpostal_entrega" value
 * @method string             getCaPaisEntrega()            Returns the current record's "ca_pais_entrega" value
 * @method string             getCaCiudadEntrega()          Returns the current record's "ca_ciudad_entrega" value
 * @method string             getCaInstruccionesEntrega()   Returns the current record's "ca_instrucciones_entrega" value
 * @method timestamp          getCaFchrecibido()            Returns the current record's "ca_fchrecibido" value
 * @method GincomexDetalle    getGincomexDetalle()          Returns the current record's "GincomexDetalle" value
 * @method GincomexMultimodal setCaIdgincomex()             Sets the current record's "ca_idgincomex" value
 * @method GincomexMultimodal setCaDireccionRecogida()      Sets the current record's "ca_direccion_recogida" value
 * @method GincomexMultimodal setCaCodpostalRecogida()      Sets the current record's "ca_codpostal_recogida" value
 * @method GincomexMultimodal setCaPaisRecogida()           Sets the current record's "ca_pais_recogida" value
 * @method GincomexMultimodal setCaCiudadRecogida()         Sets the current record's "ca_ciudad_recogida" value
 * @method GincomexMultimodal setCaContactoRecogida()       Sets the current record's "ca_contacto_recogida" value
 * @method GincomexMultimodal setCaTelefonoRecogida()       Sets the current record's "ca_telefono_recogida" value
 * @method GincomexMultimodal setCaEmailRecogida()          Sets the current record's "ca_email_recogida" value
 * @method GincomexMultimodal setCaFechaRecogida()          Sets the current record's "ca_fecha_recogida" value
 * @method GincomexMultimodal setCaDireccionEntrega()       Sets the current record's "ca_direccion_entrega" value
 * @method GincomexMultimodal setCaCodpostalEntrega()       Sets the current record's "ca_codpostal_entrega" value
 * @method GincomexMultimodal setCaPaisEntrega()            Sets the current record's "ca_pais_entrega" value
 * @method GincomexMultimodal setCaCiudadEntrega()          Sets the current record's "ca_ciudad_entrega" value
 * @method GincomexMultimodal setCaInstruccionesEntrega()   Sets the current record's "ca_instrucciones_entrega" value
 * @method GincomexMultimodal setCaFchrecibido()            Sets the current record's "ca_fchrecibido" value
 * @method GincomexMultimodal setGincomexDetalle()          Sets the current record's "GincomexDetalle" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseGincomexMultimodal extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_gincomex_multimodal');
        $this->hasColumn('ca_idgincomex', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('ca_direccion_recogida', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_codpostal_recogida', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_pais_recogida', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_ciudad_recogida', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_contacto_recogida', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_telefono_recogida', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_email_recogida', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fecha_recogida', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_direccion_entrega', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_codpostal_entrega', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_pais_entrega', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_ciudad_entrega', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_instrucciones_entrega', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchrecibido', 'timestamp', null, array(
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
        $this->hasOne('GincomexDetalle', array(
             'local' => 'ca_idgincomex',
             'foreign' => 'ca_idgincomex'));
    }
}