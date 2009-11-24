<?php

/**
 * BaseRepStatus
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idstatus
 * @property integer $ca_idreporte
 * @property integer $ca_idemail
 * @property date $ca_fchstatus
 * @property string $ca_status
 * @property string $ca_comentarios
 * @property timestamp $ca_fchrecibo
 * @property timestamp $ca_fchenvio
 * @property string $ca_usuenvio
 * @property string $ca_introduccion
 * @property date $ca_fchsalida
 * @property date $ca_fchllegada
 * @property date $ca_fchcontinuacion
 * @property string $ca_piezas
 * @property string $ca_peso
 * @property string $ca_volumen
 * @property string $ca_doctransporte
 * @property string $ca_idnave
 * @property string $ca_docmaster
 * @property string $ca_equipos
 * @property string $ca_horasalida
 * @property string $ca_horallegada
 * @property string $ca_idetapa
 * @property string $ca_propiedades
 * @property Reporte $Reporte
 * @property Email $Email
 * @property TrackingEtapa $TrackingEtapa
 * 
 * @method integer       getCaIdstatus()         Returns the current record's "ca_idstatus" value
 * @method integer       getCaIdreporte()        Returns the current record's "ca_idreporte" value
 * @method integer       getCaIdemail()          Returns the current record's "ca_idemail" value
 * @method date          getCaFchstatus()        Returns the current record's "ca_fchstatus" value
 * @method string        getCaStatus()           Returns the current record's "ca_status" value
 * @method string        getCaComentarios()      Returns the current record's "ca_comentarios" value
 * @method timestamp     getCaFchrecibo()        Returns the current record's "ca_fchrecibo" value
 * @method timestamp     getCaFchenvio()         Returns the current record's "ca_fchenvio" value
 * @method string        getCaUsuenvio()         Returns the current record's "ca_usuenvio" value
 * @method string        getCaIntroduccion()     Returns the current record's "ca_introduccion" value
 * @method date          getCaFchsalida()        Returns the current record's "ca_fchsalida" value
 * @method date          getCaFchllegada()       Returns the current record's "ca_fchllegada" value
 * @method date          getCaFchcontinuacion()  Returns the current record's "ca_fchcontinuacion" value
 * @method string        getCaPiezas()           Returns the current record's "ca_piezas" value
 * @method string        getCaPeso()             Returns the current record's "ca_peso" value
 * @method string        getCaVolumen()          Returns the current record's "ca_volumen" value
 * @method string        getCaDoctransporte()    Returns the current record's "ca_doctransporte" value
 * @method string        getCaIdnave()           Returns the current record's "ca_idnave" value
 * @method string        getCaDocmaster()        Returns the current record's "ca_docmaster" value
 * @method string        getCaEquipos()          Returns the current record's "ca_equipos" value
 * @method string        getCaHorasalida()       Returns the current record's "ca_horasalida" value
 * @method string        getCaHorallegada()      Returns the current record's "ca_horallegada" value
 * @method string        getCaIdetapa()          Returns the current record's "ca_idetapa" value
 * @method string        getCaPropiedades()      Returns the current record's "ca_propiedades" value
 * @method Reporte       getReporte()            Returns the current record's "Reporte" value
 * @method Email         getEmail()              Returns the current record's "Email" value
 * @method TrackingEtapa getTrackingEtapa()      Returns the current record's "TrackingEtapa" value
 * @method RepStatus     setCaIdstatus()         Sets the current record's "ca_idstatus" value
 * @method RepStatus     setCaIdreporte()        Sets the current record's "ca_idreporte" value
 * @method RepStatus     setCaIdemail()          Sets the current record's "ca_idemail" value
 * @method RepStatus     setCaFchstatus()        Sets the current record's "ca_fchstatus" value
 * @method RepStatus     setCaStatus()           Sets the current record's "ca_status" value
 * @method RepStatus     setCaComentarios()      Sets the current record's "ca_comentarios" value
 * @method RepStatus     setCaFchrecibo()        Sets the current record's "ca_fchrecibo" value
 * @method RepStatus     setCaFchenvio()         Sets the current record's "ca_fchenvio" value
 * @method RepStatus     setCaUsuenvio()         Sets the current record's "ca_usuenvio" value
 * @method RepStatus     setCaIntroduccion()     Sets the current record's "ca_introduccion" value
 * @method RepStatus     setCaFchsalida()        Sets the current record's "ca_fchsalida" value
 * @method RepStatus     setCaFchllegada()       Sets the current record's "ca_fchllegada" value
 * @method RepStatus     setCaFchcontinuacion()  Sets the current record's "ca_fchcontinuacion" value
 * @method RepStatus     setCaPiezas()           Sets the current record's "ca_piezas" value
 * @method RepStatus     setCaPeso()             Sets the current record's "ca_peso" value
 * @method RepStatus     setCaVolumen()          Sets the current record's "ca_volumen" value
 * @method RepStatus     setCaDoctransporte()    Sets the current record's "ca_doctransporte" value
 * @method RepStatus     setCaIdnave()           Sets the current record's "ca_idnave" value
 * @method RepStatus     setCaDocmaster()        Sets the current record's "ca_docmaster" value
 * @method RepStatus     setCaEquipos()          Sets the current record's "ca_equipos" value
 * @method RepStatus     setCaHorasalida()       Sets the current record's "ca_horasalida" value
 * @method RepStatus     setCaHorallegada()      Sets the current record's "ca_horallegada" value
 * @method RepStatus     setCaIdetapa()          Sets the current record's "ca_idetapa" value
 * @method RepStatus     setCaPropiedades()      Sets the current record's "ca_propiedades" value
 * @method RepStatus     setReporte()            Sets the current record's "Reporte" value
 * @method RepStatus     setEmail()              Sets the current record's "Email" value
 * @method RepStatus     setTrackingEtapa()      Sets the current record's "TrackingEtapa" value
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6716 2009-11-12 19:26:28Z jwage $
 */
abstract class BaseRepStatus extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_repstatus');
        $this->hasColumn('ca_idstatus', 'integer', null, array(
             'type' => 'integer',
             'autoincrement' => true,
             'primary' => true,
             ));
        $this->hasColumn('ca_idreporte', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idemail', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_fchstatus', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_status', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_comentarios', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchrecibo', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_fchenvio', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usuenvio', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_introduccion', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchsalida', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_fchllegada', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_fchcontinuacion', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_piezas', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_peso', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_volumen', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_doctransporte', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_idnave', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_docmaster', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_equipos', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_horasalida', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_horallegada', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_idetapa', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_propiedades', 'string', null, array(
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
        $this->hasOne('Reporte', array(
             'local' => 'ca_idreporte',
             'foreign' => 'ca_idreporte'));

        $this->hasOne('Email', array(
             'local' => 'ca_idemail',
             'foreign' => 'ca_idemail'));

        $this->hasOne('TrackingEtapa', array(
             'local' => 'ca_idetapa',
             'foreign' => 'ca_idetapa'));
    }
}