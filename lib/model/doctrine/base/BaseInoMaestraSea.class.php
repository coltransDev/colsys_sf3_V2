<?php

/**
 * BaseInoMaestraSea
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $ca_referencia
 * @property integer $ca_idlinea
 * @property date $ca_fchreferencia
 * @property string $ca_impoexpo
 * @property string $ca_origen
 * @property string $ca_destino
 * @property date $ca_fchembarque
 * @property date $ca_fcharribo
 * @property string $ca_modalidad
 * @property string $ca_motonave
 * @property string $ca_ciclo
 * @property string $ca_mbls
 * @property string $ca_observaciones
 * @property date $ca_fchconfirmacion
 * @property time $ca_horaconfirmacion
 * @property string $ca_registroadu
 * @property string $ca_registrocap
 * @property string $ca_bandera
 * @property date $ca_fchliberacion
 * @property string $ca_nroliberacion
 * @property string $ca_anulado
 * @property string $ca_mensaje
 * @property date $ca_fchdesconsolidacion
 * @property string $ca_mnllegada
 * @property date $ca_fchregistroadu
 * @property string $ca_asunto_otm
 * @property string $ca_mensaje_otm
 * @property date $ca_fchllegada_otm
 * @property string $ca_ciudad_otm
 * @property boolean $ca_provisional
 * @property string $ca_sitiodevolucion
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property timestamp $ca_fchactualizado
 * @property string $ca_usuactualizado
 * @property timestamp $ca_fchliquidado
 * @property string $ca_usuliquidado
 * @property timestamp $ca_fchcerrado
 * @property string $ca_usucerrado
 * @property timestamp $ca_fchconfirmado
 * @property string $ca_usuconfirmado
 * @property timestamp $ca_fchconfirma_otm
 * @property string $ca_usuconfirma_otm
 * @property Doctrine_Collection $InoClientesSea
 * @property Doctrine_Collection $InoEquiposSea
 * @property IdsProveedor $IdsProveedor
 * @property Reporte $Reporte
 * @property Ciudad $Origen
 * @property Ciudad $Destino
 * @property Doctrine_Collection $InoContratosSea
 * 
 * @method string              getCaReferencia()           Returns the current record's "ca_referencia" value
 * @method integer             getCaIdlinea()              Returns the current record's "ca_idlinea" value
 * @method date                getCaFchreferencia()        Returns the current record's "ca_fchreferencia" value
 * @method string              getCaImpoexpo()             Returns the current record's "ca_impoexpo" value
 * @method string              getCaOrigen()               Returns the current record's "ca_origen" value
 * @method string              getCaDestino()              Returns the current record's "ca_destino" value
 * @method date                getCaFchembarque()          Returns the current record's "ca_fchembarque" value
 * @method date                getCaFcharribo()            Returns the current record's "ca_fcharribo" value
 * @method string              getCaModalidad()            Returns the current record's "ca_modalidad" value
 * @method string              getCaMotonave()             Returns the current record's "ca_motonave" value
 * @method string              getCaCiclo()                Returns the current record's "ca_ciclo" value
 * @method string              getCaMbls()                 Returns the current record's "ca_mbls" value
 * @method string              getCaObservaciones()        Returns the current record's "ca_observaciones" value
 * @method date                getCaFchconfirmacion()      Returns the current record's "ca_fchconfirmacion" value
 * @method time                getCaHoraconfirmacion()     Returns the current record's "ca_horaconfirmacion" value
 * @method string              getCaRegistroadu()          Returns the current record's "ca_registroadu" value
 * @method string              getCaRegistrocap()          Returns the current record's "ca_registrocap" value
 * @method string              getCaBandera()              Returns the current record's "ca_bandera" value
 * @method date                getCaFchliberacion()        Returns the current record's "ca_fchliberacion" value
 * @method string              getCaNroliberacion()        Returns the current record's "ca_nroliberacion" value
 * @method string              getCaAnulado()              Returns the current record's "ca_anulado" value
 * @method string              getCaMensaje()              Returns the current record's "ca_mensaje" value
 * @method date                getCaFchdesconsolidacion()  Returns the current record's "ca_fchdesconsolidacion" value
 * @method string              getCaMnllegada()            Returns the current record's "ca_mnllegada" value
 * @method date                getCaFchregistroadu()       Returns the current record's "ca_fchregistroadu" value
 * @method string              getCaAsuntoOtm()            Returns the current record's "ca_asunto_otm" value
 * @method string              getCaMensajeOtm()           Returns the current record's "ca_mensaje_otm" value
 * @method date                getCaFchllegadaOtm()        Returns the current record's "ca_fchllegada_otm" value
 * @method string              getCaCiudadOtm()            Returns the current record's "ca_ciudad_otm" value
 * @method boolean             getCaProvisional()          Returns the current record's "ca_provisional" value
 * @method string              getCaSitiodevolucion()      Returns the current record's "ca_sitiodevolucion" value
 * @method timestamp           getCaFchcreado()            Returns the current record's "ca_fchcreado" value
 * @method string              getCaUsucreado()            Returns the current record's "ca_usucreado" value
 * @method timestamp           getCaFchactualizado()       Returns the current record's "ca_fchactualizado" value
 * @method string              getCaUsuactualizado()       Returns the current record's "ca_usuactualizado" value
 * @method timestamp           getCaFchliquidado()         Returns the current record's "ca_fchliquidado" value
 * @method string              getCaUsuliquidado()         Returns the current record's "ca_usuliquidado" value
 * @method timestamp           getCaFchcerrado()           Returns the current record's "ca_fchcerrado" value
 * @method string              getCaUsucerrado()           Returns the current record's "ca_usucerrado" value
 * @method timestamp           getCaFchconfirmado()        Returns the current record's "ca_fchconfirmado" value
 * @method string              getCaUsuconfirmado()        Returns the current record's "ca_usuconfirmado" value
 * @method timestamp           getCaFchconfirmaOtm()       Returns the current record's "ca_fchconfirma_otm" value
 * @method string              getCaUsuconfirmaOtm()       Returns the current record's "ca_usuconfirma_otm" value
 * @method Doctrine_Collection getInoClientesSea()         Returns the current record's "InoClientesSea" collection
 * @method Doctrine_Collection getInoEquiposSea()          Returns the current record's "InoEquiposSea" collection
 * @method IdsProveedor        getIdsProveedor()           Returns the current record's "IdsProveedor" value
 * @method Reporte             getReporte()                Returns the current record's "Reporte" value
 * @method Ciudad              getOrigen()                 Returns the current record's "Origen" value
 * @method Ciudad              getDestino()                Returns the current record's "Destino" value
 * @method Doctrine_Collection getInoContratosSea()        Returns the current record's "InoContratosSea" collection
 * @method InoMaestraSea       setCaReferencia()           Sets the current record's "ca_referencia" value
 * @method InoMaestraSea       setCaIdlinea()              Sets the current record's "ca_idlinea" value
 * @method InoMaestraSea       setCaFchreferencia()        Sets the current record's "ca_fchreferencia" value
 * @method InoMaestraSea       setCaImpoexpo()             Sets the current record's "ca_impoexpo" value
 * @method InoMaestraSea       setCaOrigen()               Sets the current record's "ca_origen" value
 * @method InoMaestraSea       setCaDestino()              Sets the current record's "ca_destino" value
 * @method InoMaestraSea       setCaFchembarque()          Sets the current record's "ca_fchembarque" value
 * @method InoMaestraSea       setCaFcharribo()            Sets the current record's "ca_fcharribo" value
 * @method InoMaestraSea       setCaModalidad()            Sets the current record's "ca_modalidad" value
 * @method InoMaestraSea       setCaMotonave()             Sets the current record's "ca_motonave" value
 * @method InoMaestraSea       setCaCiclo()                Sets the current record's "ca_ciclo" value
 * @method InoMaestraSea       setCaMbls()                 Sets the current record's "ca_mbls" value
 * @method InoMaestraSea       setCaObservaciones()        Sets the current record's "ca_observaciones" value
 * @method InoMaestraSea       setCaFchconfirmacion()      Sets the current record's "ca_fchconfirmacion" value
 * @method InoMaestraSea       setCaHoraconfirmacion()     Sets the current record's "ca_horaconfirmacion" value
 * @method InoMaestraSea       setCaRegistroadu()          Sets the current record's "ca_registroadu" value
 * @method InoMaestraSea       setCaRegistrocap()          Sets the current record's "ca_registrocap" value
 * @method InoMaestraSea       setCaBandera()              Sets the current record's "ca_bandera" value
 * @method InoMaestraSea       setCaFchliberacion()        Sets the current record's "ca_fchliberacion" value
 * @method InoMaestraSea       setCaNroliberacion()        Sets the current record's "ca_nroliberacion" value
 * @method InoMaestraSea       setCaAnulado()              Sets the current record's "ca_anulado" value
 * @method InoMaestraSea       setCaMensaje()              Sets the current record's "ca_mensaje" value
 * @method InoMaestraSea       setCaFchdesconsolidacion()  Sets the current record's "ca_fchdesconsolidacion" value
 * @method InoMaestraSea       setCaMnllegada()            Sets the current record's "ca_mnllegada" value
 * @method InoMaestraSea       setCaFchregistroadu()       Sets the current record's "ca_fchregistroadu" value
 * @method InoMaestraSea       setCaAsuntoOtm()            Sets the current record's "ca_asunto_otm" value
 * @method InoMaestraSea       setCaMensajeOtm()           Sets the current record's "ca_mensaje_otm" value
 * @method InoMaestraSea       setCaFchllegadaOtm()        Sets the current record's "ca_fchllegada_otm" value
 * @method InoMaestraSea       setCaCiudadOtm()            Sets the current record's "ca_ciudad_otm" value
 * @method InoMaestraSea       setCaProvisional()          Sets the current record's "ca_provisional" value
 * @method InoMaestraSea       setCaSitiodevolucion()      Sets the current record's "ca_sitiodevolucion" value
 * @method InoMaestraSea       setCaFchcreado()            Sets the current record's "ca_fchcreado" value
 * @method InoMaestraSea       setCaUsucreado()            Sets the current record's "ca_usucreado" value
 * @method InoMaestraSea       setCaFchactualizado()       Sets the current record's "ca_fchactualizado" value
 * @method InoMaestraSea       setCaUsuactualizado()       Sets the current record's "ca_usuactualizado" value
 * @method InoMaestraSea       setCaFchliquidado()         Sets the current record's "ca_fchliquidado" value
 * @method InoMaestraSea       setCaUsuliquidado()         Sets the current record's "ca_usuliquidado" value
 * @method InoMaestraSea       setCaFchcerrado()           Sets the current record's "ca_fchcerrado" value
 * @method InoMaestraSea       setCaUsucerrado()           Sets the current record's "ca_usucerrado" value
 * @method InoMaestraSea       setCaFchconfirmado()        Sets the current record's "ca_fchconfirmado" value
 * @method InoMaestraSea       setCaUsuconfirmado()        Sets the current record's "ca_usuconfirmado" value
 * @method InoMaestraSea       setCaFchconfirmaOtm()       Sets the current record's "ca_fchconfirma_otm" value
 * @method InoMaestraSea       setCaUsuconfirmaOtm()       Sets the current record's "ca_usuconfirma_otm" value
 * @method InoMaestraSea       setInoClientesSea()         Sets the current record's "InoClientesSea" collection
 * @method InoMaestraSea       setInoEquiposSea()          Sets the current record's "InoEquiposSea" collection
 * @method InoMaestraSea       setIdsProveedor()           Sets the current record's "IdsProveedor" value
 * @method InoMaestraSea       setReporte()                Sets the current record's "Reporte" value
 * @method InoMaestraSea       setOrigen()                 Sets the current record's "Origen" value
 * @method InoMaestraSea       setDestino()                Sets the current record's "Destino" value
 * @method InoMaestraSea       setInoContratosSea()        Sets the current record's "InoContratosSea" collection
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6508 2009-10-14 06:28:49Z jwage $
 */
abstract class BaseInoMaestraSea extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_inomaestra_sea');
        $this->hasColumn('ca_referencia', 'string', null, array(
             'type' => 'string',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_idlinea', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_fchreferencia', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_impoexpo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_origen', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_destino', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchembarque', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_fcharribo', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_modalidad', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_motonave', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_ciclo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_mbls', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_observaciones', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchconfirmacion', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_horaconfirmacion', 'time', null, array(
             'type' => 'time',
             ));
        $this->hasColumn('ca_registroadu', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_registrocap', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_bandera', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchliberacion', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_nroliberacion', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_anulado', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_mensaje', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchdesconsolidacion', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_mnllegada', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchregistroadu', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_asunto_otm', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_mensaje_otm', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchllegada_otm', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_ciudad_otm', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_provisional', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_sitiodevolucion', 'string', null, array(
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
        $this->hasColumn('ca_fchconfirmado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usuconfirmado', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchconfirma_otm', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usuconfirma_otm', 'string', null, array(
             'type' => 'string',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('InoClientesSea', array(
             'local' => 'ca_referencia',
             'foreign' => 'ca_referencia'));

        $this->hasMany('InoEquiposSea', array(
             'local' => 'ca_referencia',
             'foreign' => 'ca_referencia'));

        $this->hasOne('IdsProveedor', array(
             'local' => 'ca_idlinea',
             'foreign' => 'ca_idproveedor'));

        $this->hasOne('Reporte', array(
             'local' => 'ca_idreporte',
             'foreign' => 'ca_idreporte'));

        $this->hasOne('Ciudad as Origen', array(
             'local' => 'ca_origen',
             'foreign' => 'ca_idciudad'));

        $this->hasOne('Ciudad as Destino', array(
             'local' => 'ca_destino',
             'foreign' => 'ca_idciudad'));

        $this->hasMany('InoContratosSea', array(
             'local' => 'ca_referencia',
             'foreign' => 'ca_referencia'));
    }
}