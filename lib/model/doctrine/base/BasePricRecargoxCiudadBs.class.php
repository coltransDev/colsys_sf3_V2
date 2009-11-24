<?php

/**
 * BasePricRecargoxCiudadBs
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $ca_idtrafico
 * @property string $ca_idciudad
 * @property integer $ca_idrecargo
 * @property string $ca_modalidad
 * @property string $ca_impoexpo
 * @property decimal $ca_vlrrecargo
 * @property string $ca_aplicacion
 * @property decimal $ca_vlrminimo
 * @property string $ca_aplicacion_min
 * @property string $ca_observaciones
 * @property date $ca_fchinicio
 * @property date $ca_fchvencimiento
 * @property string $ca_idmoneda
 * @property integer $ca_consecutivo
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property timestamp $ca_fcheliminado
 * @property TipoRecargo $TipoRecargo
 * @property Trafico $Trafico
 * @property Ciudad $Ciudad
 * 
 * @method string               getCaIdtrafico()       Returns the current record's "ca_idtrafico" value
 * @method string               getCaIdciudad()        Returns the current record's "ca_idciudad" value
 * @method integer              getCaIdrecargo()       Returns the current record's "ca_idrecargo" value
 * @method string               getCaModalidad()       Returns the current record's "ca_modalidad" value
 * @method string               getCaImpoexpo()        Returns the current record's "ca_impoexpo" value
 * @method decimal              getCaVlrrecargo()      Returns the current record's "ca_vlrrecargo" value
 * @method string               getCaAplicacion()      Returns the current record's "ca_aplicacion" value
 * @method decimal              getCaVlrminimo()       Returns the current record's "ca_vlrminimo" value
 * @method string               getCaAplicacionMin()   Returns the current record's "ca_aplicacion_min" value
 * @method string               getCaObservaciones()   Returns the current record's "ca_observaciones" value
 * @method date                 getCaFchinicio()       Returns the current record's "ca_fchinicio" value
 * @method date                 getCaFchvencimiento()  Returns the current record's "ca_fchvencimiento" value
 * @method string               getCaIdmoneda()        Returns the current record's "ca_idmoneda" value
 * @method integer              getCaConsecutivo()     Returns the current record's "ca_consecutivo" value
 * @method timestamp            getCaFchcreado()       Returns the current record's "ca_fchcreado" value
 * @method string               getCaUsucreado()       Returns the current record's "ca_usucreado" value
 * @method timestamp            getCaFcheliminado()    Returns the current record's "ca_fcheliminado" value
 * @method TipoRecargo          getTipoRecargo()       Returns the current record's "TipoRecargo" value
 * @method Trafico              getTrafico()           Returns the current record's "Trafico" value
 * @method Ciudad               getCiudad()            Returns the current record's "Ciudad" value
 * @method PricRecargoxCiudadBs setCaIdtrafico()       Sets the current record's "ca_idtrafico" value
 * @method PricRecargoxCiudadBs setCaIdciudad()        Sets the current record's "ca_idciudad" value
 * @method PricRecargoxCiudadBs setCaIdrecargo()       Sets the current record's "ca_idrecargo" value
 * @method PricRecargoxCiudadBs setCaModalidad()       Sets the current record's "ca_modalidad" value
 * @method PricRecargoxCiudadBs setCaImpoexpo()        Sets the current record's "ca_impoexpo" value
 * @method PricRecargoxCiudadBs setCaVlrrecargo()      Sets the current record's "ca_vlrrecargo" value
 * @method PricRecargoxCiudadBs setCaAplicacion()      Sets the current record's "ca_aplicacion" value
 * @method PricRecargoxCiudadBs setCaVlrminimo()       Sets the current record's "ca_vlrminimo" value
 * @method PricRecargoxCiudadBs setCaAplicacionMin()   Sets the current record's "ca_aplicacion_min" value
 * @method PricRecargoxCiudadBs setCaObservaciones()   Sets the current record's "ca_observaciones" value
 * @method PricRecargoxCiudadBs setCaFchinicio()       Sets the current record's "ca_fchinicio" value
 * @method PricRecargoxCiudadBs setCaFchvencimiento()  Sets the current record's "ca_fchvencimiento" value
 * @method PricRecargoxCiudadBs setCaIdmoneda()        Sets the current record's "ca_idmoneda" value
 * @method PricRecargoxCiudadBs setCaConsecutivo()     Sets the current record's "ca_consecutivo" value
 * @method PricRecargoxCiudadBs setCaFchcreado()       Sets the current record's "ca_fchcreado" value
 * @method PricRecargoxCiudadBs setCaUsucreado()       Sets the current record's "ca_usucreado" value
 * @method PricRecargoxCiudadBs setCaFcheliminado()    Sets the current record's "ca_fcheliminado" value
 * @method PricRecargoxCiudadBs setTipoRecargo()       Sets the current record's "TipoRecargo" value
 * @method PricRecargoxCiudadBs setTrafico()           Sets the current record's "Trafico" value
 * @method PricRecargoxCiudadBs setCiudad()            Sets the current record's "Ciudad" value
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6716 2009-11-12 19:26:28Z jwage $
 */
abstract class BasePricRecargoxCiudadBs extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('bs_pricrecargosxciudad');
        $this->hasColumn('ca_idtrafico', 'string', null, array(
             'type' => 'string',
             'primary' => true,
             ));
        $this->hasColumn('ca_idciudad', 'string', null, array(
             'type' => 'string',
             'primary' => true,
             ));
        $this->hasColumn('ca_idrecargo', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_modalidad', 'string', null, array(
             'type' => 'string',
             'primary' => true,
             ));
        $this->hasColumn('ca_impoexpo', 'string', null, array(
             'type' => 'string',
             'primary' => true,
             ));
        $this->hasColumn('ca_vlrrecargo', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_aplicacion', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_vlrminimo', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_aplicacion_min', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_observaciones', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchinicio', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_fchvencimiento', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_idmoneda', 'string', null, array(
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
        $this->hasColumn('ca_fcheliminado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));


        $this->setAttribute(Doctrine_Core::ATTR_EXPORT, Doctrine_Core::EXPORT_TABLES);

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('TipoRecargo', array(
             'local' => 'ca_idrecargo',
             'foreign' => 'ca_idrecargo'));

        $this->hasOne('Trafico', array(
             'local' => 'ca_idtrafico',
             'foreign' => 'ca_idtrafico'));

        $this->hasOne('Ciudad', array(
             'local' => 'ca_idciudad',
             'foreign' => 'ca_idciudad'));
    }
}