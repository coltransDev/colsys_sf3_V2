<?php

/**
 * BasePricRecargoxLinea
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $ca_idtrafico
 * @property integer $ca_idlinea
 * @property integer $ca_idrecargo
 * @property integer $ca_idconcepto
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
 * @property Concepto $Concepto
 * @property TipoRecargo $TipoRecargo
 * @property Trafico $Trafico
 * @property IdsProveedor $IdsProveedor
 * 
 * @method string            getCaIdtrafico()       Returns the current record's "ca_idtrafico" value
 * @method integer           getCaIdlinea()         Returns the current record's "ca_idlinea" value
 * @method integer           getCaIdrecargo()       Returns the current record's "ca_idrecargo" value
 * @method integer           getCaIdconcepto()      Returns the current record's "ca_idconcepto" value
 * @method string            getCaModalidad()       Returns the current record's "ca_modalidad" value
 * @method string            getCaImpoexpo()        Returns the current record's "ca_impoexpo" value
 * @method decimal           getCaVlrrecargo()      Returns the current record's "ca_vlrrecargo" value
 * @method string            getCaAplicacion()      Returns the current record's "ca_aplicacion" value
 * @method decimal           getCaVlrminimo()       Returns the current record's "ca_vlrminimo" value
 * @method string            getCaAplicacionMin()   Returns the current record's "ca_aplicacion_min" value
 * @method string            getCaObservaciones()   Returns the current record's "ca_observaciones" value
 * @method date              getCaFchinicio()       Returns the current record's "ca_fchinicio" value
 * @method date              getCaFchvencimiento()  Returns the current record's "ca_fchvencimiento" value
 * @method string            getCaIdmoneda()        Returns the current record's "ca_idmoneda" value
 * @method integer           getCaConsecutivo()     Returns the current record's "ca_consecutivo" value
 * @method timestamp         getCaFchcreado()       Returns the current record's "ca_fchcreado" value
 * @method string            getCaUsucreado()       Returns the current record's "ca_usucreado" value
 * @method timestamp         getCaFcheliminado()    Returns the current record's "ca_fcheliminado" value
 * @method Concepto          getConcepto()          Returns the current record's "Concepto" value
 * @method TipoRecargo       getTipoRecargo()       Returns the current record's "TipoRecargo" value
 * @method Trafico           getTrafico()           Returns the current record's "Trafico" value
 * @method IdsProveedor      getIdsProveedor()      Returns the current record's "IdsProveedor" value
 * @method PricRecargoxLinea setCaIdtrafico()       Sets the current record's "ca_idtrafico" value
 * @method PricRecargoxLinea setCaIdlinea()         Sets the current record's "ca_idlinea" value
 * @method PricRecargoxLinea setCaIdrecargo()       Sets the current record's "ca_idrecargo" value
 * @method PricRecargoxLinea setCaIdconcepto()      Sets the current record's "ca_idconcepto" value
 * @method PricRecargoxLinea setCaModalidad()       Sets the current record's "ca_modalidad" value
 * @method PricRecargoxLinea setCaImpoexpo()        Sets the current record's "ca_impoexpo" value
 * @method PricRecargoxLinea setCaVlrrecargo()      Sets the current record's "ca_vlrrecargo" value
 * @method PricRecargoxLinea setCaAplicacion()      Sets the current record's "ca_aplicacion" value
 * @method PricRecargoxLinea setCaVlrminimo()       Sets the current record's "ca_vlrminimo" value
 * @method PricRecargoxLinea setCaAplicacionMin()   Sets the current record's "ca_aplicacion_min" value
 * @method PricRecargoxLinea setCaObservaciones()   Sets the current record's "ca_observaciones" value
 * @method PricRecargoxLinea setCaFchinicio()       Sets the current record's "ca_fchinicio" value
 * @method PricRecargoxLinea setCaFchvencimiento()  Sets the current record's "ca_fchvencimiento" value
 * @method PricRecargoxLinea setCaIdmoneda()        Sets the current record's "ca_idmoneda" value
 * @method PricRecargoxLinea setCaConsecutivo()     Sets the current record's "ca_consecutivo" value
 * @method PricRecargoxLinea setCaFchcreado()       Sets the current record's "ca_fchcreado" value
 * @method PricRecargoxLinea setCaUsucreado()       Sets the current record's "ca_usucreado" value
 * @method PricRecargoxLinea setCaFcheliminado()    Sets the current record's "ca_fcheliminado" value
 * @method PricRecargoxLinea setConcepto()          Sets the current record's "Concepto" value
 * @method PricRecargoxLinea setTipoRecargo()       Sets the current record's "TipoRecargo" value
 * @method PricRecargoxLinea setTrafico()           Sets the current record's "Trafico" value
 * @method PricRecargoxLinea setIdsProveedor()      Sets the current record's "IdsProveedor" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BasePricRecargoxLinea extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('pric.tb_recargosxlinea');
        $this->hasColumn('ca_idtrafico', 'string', null, array(
             'type' => 'string',
             'primary' => true,
             ));
        $this->hasColumn('ca_idlinea', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_idrecargo', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_idconcepto', 'integer', null, array(
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
        $this->hasOne('Concepto', array(
             'local' => 'ca_idconcepto',
             'foreign' => 'ca_idconcepto'));

        $this->hasOne('TipoRecargo', array(
             'local' => 'ca_idrecargo',
             'foreign' => 'ca_idrecargo'));

        $this->hasOne('Trafico', array(
             'local' => 'ca_idtrafico',
             'foreign' => 'ca_idtrafico'));

        $this->hasOne('IdsProveedor', array(
             'local' => 'ca_idlinea',
             'foreign' => 'ca_idproveedor'));
    }
}