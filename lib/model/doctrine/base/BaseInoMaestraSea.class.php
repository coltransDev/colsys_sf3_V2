<?php

/**
 * BaseInoMaestraSea
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $ca_referencia
 * @property date $ca_fchreferencia
 * @property string $ca_impoexpo
 * @property string $ca_origen
 * @property string $ca_destino
 * @property date $ca_fchembarque
 * @property date $ca_fcharribo
 * @property string $ca_modalidad
 * @property integer $ca_idlinea
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
 * @property boolean $ca_provisional
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
 * @property date $ca_fchvaciado
 * @property time $ca_horavaciado
 * @property timestamp $ca_fchmuisca
 * @property string $ca_usumuisca
 * @property date $ca_fchmbls
 * @property boolean $ca_carpeta
 * @property integer $ca_muelle
 * @property date $ca_fchfinmuisca
 * @property string $ca_estado
 * @property timestamp $ca_fchenvio
 * @property timestamp $ca_fchrecibido
 * @property integer $ca_tipo
 * @property integer $ca_emisionbl
 * @property string $ca_propiedades
 * @property Doctrine_Collection $InoClientesSea
 * @property Doctrine_Collection $InoEquiposSea
 * @property Doctrine_Collection $InoUtilidadprmsSea
 * @property IdsProveedor $IdsProveedor
 * @property Ciudad $Origen
 * @property Ciudad $Destino
 * @property Usuario $UsuCreado
 * @property InoDianDepositos $InoDianDepositos
 * @property Doctrine_Collection $InoContratosSea
 * @property Doctrine_Collection $InoCostosSea
 * 
 * @method string              getCaReferencia()           Returns the current record's "ca_referencia" value
 * @method date                getCaFchreferencia()        Returns the current record's "ca_fchreferencia" value
 * @method string              getCaImpoexpo()             Returns the current record's "ca_impoexpo" value
 * @method string              getCaOrigen()               Returns the current record's "ca_origen" value
 * @method string              getCaDestino()              Returns the current record's "ca_destino" value
 * @method date                getCaFchembarque()          Returns the current record's "ca_fchembarque" value
 * @method date                getCaFcharribo()            Returns the current record's "ca_fcharribo" value
 * @method string              getCaModalidad()            Returns the current record's "ca_modalidad" value
 * @method integer             getCaIdlinea()              Returns the current record's "ca_idlinea" value
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
 * @method boolean             getCaProvisional()          Returns the current record's "ca_provisional" value
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
 * @method date                getCaFchvaciado()           Returns the current record's "ca_fchvaciado" value
 * @method time                getCaHoravaciado()          Returns the current record's "ca_horavaciado" value
 * @method timestamp           getCaFchmuisca()            Returns the current record's "ca_fchmuisca" value
 * @method string              getCaUsumuisca()            Returns the current record's "ca_usumuisca" value
 * @method date                getCaFchmbls()              Returns the current record's "ca_fchmbls" value
 * @method boolean             getCaCarpeta()              Returns the current record's "ca_carpeta" value
 * @method integer             getCaMuelle()               Returns the current record's "ca_muelle" value
 * @method date                getCaFchfinmuisca()         Returns the current record's "ca_fchfinmuisca" value
 * @method string              getCaEstado()               Returns the current record's "ca_estado" value
 * @method timestamp           getCaFchenvio()             Returns the current record's "ca_fchenvio" value
 * @method timestamp           getCaFchrecibido()          Returns the current record's "ca_fchrecibido" value
 * @method integer             getCaTipo()                 Returns the current record's "ca_tipo" value
 * @method integer             getCaEmisionbl()            Returns the current record's "ca_emisionbl" value
 * @method string              getCaPropiedades()          Returns the current record's "ca_propiedades" value
 * @method Doctrine_Collection getInoClientesSea()         Returns the current record's "InoClientesSea" collection
 * @method Doctrine_Collection getInoEquiposSea()          Returns the current record's "InoEquiposSea" collection
 * @method Doctrine_Collection getInoUtilidadprmsSea()     Returns the current record's "InoUtilidadprmsSea" collection
 * @method IdsProveedor        getIdsProveedor()           Returns the current record's "IdsProveedor" value
 * @method Ciudad              getOrigen()                 Returns the current record's "Origen" value
 * @method Ciudad              getDestino()                Returns the current record's "Destino" value
 * @method Usuario             getUsuCreado()              Returns the current record's "UsuCreado" value
 * @method InoDianDepositos    getInoDianDepositos()       Returns the current record's "InoDianDepositos" value
 * @method Doctrine_Collection getInoContratosSea()        Returns the current record's "InoContratosSea" collection
 * @method Doctrine_Collection getInoCostosSea()           Returns the current record's "InoCostosSea" collection
 * @method InoMaestraSea       setCaReferencia()           Sets the current record's "ca_referencia" value
 * @method InoMaestraSea       setCaFchreferencia()        Sets the current record's "ca_fchreferencia" value
 * @method InoMaestraSea       setCaImpoexpo()             Sets the current record's "ca_impoexpo" value
 * @method InoMaestraSea       setCaOrigen()               Sets the current record's "ca_origen" value
 * @method InoMaestraSea       setCaDestino()              Sets the current record's "ca_destino" value
 * @method InoMaestraSea       setCaFchembarque()          Sets the current record's "ca_fchembarque" value
 * @method InoMaestraSea       setCaFcharribo()            Sets the current record's "ca_fcharribo" value
 * @method InoMaestraSea       setCaModalidad()            Sets the current record's "ca_modalidad" value
 * @method InoMaestraSea       setCaIdlinea()              Sets the current record's "ca_idlinea" value
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
 * @method InoMaestraSea       setCaProvisional()          Sets the current record's "ca_provisional" value
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
 * @method InoMaestraSea       setCaFchvaciado()           Sets the current record's "ca_fchvaciado" value
 * @method InoMaestraSea       setCaHoravaciado()          Sets the current record's "ca_horavaciado" value
 * @method InoMaestraSea       setCaFchmuisca()            Sets the current record's "ca_fchmuisca" value
 * @method InoMaestraSea       setCaUsumuisca()            Sets the current record's "ca_usumuisca" value
 * @method InoMaestraSea       setCaFchmbls()              Sets the current record's "ca_fchmbls" value
 * @method InoMaestraSea       setCaCarpeta()              Sets the current record's "ca_carpeta" value
 * @method InoMaestraSea       setCaMuelle()               Sets the current record's "ca_muelle" value
 * @method InoMaestraSea       setCaFchfinmuisca()         Sets the current record's "ca_fchfinmuisca" value
 * @method InoMaestraSea       setCaEstado()               Sets the current record's "ca_estado" value
 * @method InoMaestraSea       setCaFchenvio()             Sets the current record's "ca_fchenvio" value
 * @method InoMaestraSea       setCaFchrecibido()          Sets the current record's "ca_fchrecibido" value
 * @method InoMaestraSea       setCaTipo()                 Sets the current record's "ca_tipo" value
 * @method InoMaestraSea       setCaEmisionbl()            Sets the current record's "ca_emisionbl" value
 * @method InoMaestraSea       setCaPropiedades()          Sets the current record's "ca_propiedades" value
 * @method InoMaestraSea       setInoClientesSea()         Sets the current record's "InoClientesSea" collection
 * @method InoMaestraSea       setInoEquiposSea()          Sets the current record's "InoEquiposSea" collection
 * @method InoMaestraSea       setInoUtilidadprmsSea()     Sets the current record's "InoUtilidadprmsSea" collection
 * @method InoMaestraSea       setIdsProveedor()           Sets the current record's "IdsProveedor" value
 * @method InoMaestraSea       setOrigen()                 Sets the current record's "Origen" value
 * @method InoMaestraSea       setDestino()                Sets the current record's "Destino" value
 * @method InoMaestraSea       setUsuCreado()              Sets the current record's "UsuCreado" value
 * @method InoMaestraSea       setInoDianDepositos()       Sets the current record's "InoDianDepositos" value
 * @method InoMaestraSea       setInoContratosSea()        Sets the current record's "InoContratosSea" collection
 * @method InoMaestraSea       setInoCostosSea()           Sets the current record's "InoCostosSea" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseInoMaestraSea extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_inomaestra_sea');
        $this->hasColumn('ca_referencia', 'string', null, array(
             'type' => 'string',
             'primary' => true,
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
        $this->hasColumn('ca_idlinea', 'integer', null, array(
             'type' => 'integer',
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
        $this->hasColumn('ca_provisional', 'boolean', null, array(
             'type' => 'boolean',
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
        $this->hasColumn('ca_fchvaciado', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_horavaciado', 'time', null, array(
             'type' => 'time',
             ));
        $this->hasColumn('ca_fchmuisca', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usumuisca', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchmbls', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_carpeta', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_muelle', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_fchfinmuisca', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_estado', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchenvio', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_fchrecibido', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_tipo', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_emisionbl', 'integer', null, array(
             'type' => 'integer',
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
        $this->hasMany('InoClientesSea', array(
             'local' => 'ca_referencia',
             'foreign' => 'ca_referencia'));

        $this->hasMany('InoEquiposSea', array(
             'local' => 'ca_referencia',
             'foreign' => 'ca_referencia'));

        $this->hasMany('InoUtilidadprmsSea', array(
             'local' => 'ca_referencia',
             'foreign' => 'ca_referencia'));

        $this->hasOne('IdsProveedor', array(
             'local' => 'ca_idlinea',
             'foreign' => 'ca_idproveedor'));

        $this->hasOne('Ciudad as Origen', array(
             'local' => 'ca_origen',
             'foreign' => 'ca_idciudad'));

        $this->hasOne('Ciudad as Destino', array(
             'local' => 'ca_destino',
             'foreign' => 'ca_idciudad'));

        $this->hasOne('Usuario as UsuCreado', array(
             'local' => 'ca_usucreado',
             'foreign' => 'ca_login'));

        $this->hasOne('InoDianDepositos', array(
             'local' => 'ca_muelle',
             'foreign' => 'ca_codigo'));

        $this->hasMany('InoContratosSea', array(
             'local' => 'ca_referencia',
             'foreign' => 'ca_referencia'));

        $this->hasMany('InoCostosSea', array(
             'local' => 'ca_referencia',
             'foreign' => 'ca_referencia'));
    }
}