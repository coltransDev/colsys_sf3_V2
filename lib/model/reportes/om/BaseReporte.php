<?php

/**
 * Base class that represents a row from the 'tb_reportes' table.
 *
 * 
 *
 * @package    lib.model.reportes.om
 */
abstract class BaseReporte extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        ReportePeer
	 */
	protected static $peer;


	/**
	 * The value for the ca_idreporte field.
	 * @var        int
	 */
	protected $ca_idreporte;


	/**
	 * The value for the ca_fchreporte field.
	 * @var        int
	 */
	protected $ca_fchreporte;


	/**
	 * The value for the ca_consecutivo field.
	 * @var        string
	 */
	protected $ca_consecutivo;


	/**
	 * The value for the ca_version field.
	 * @var        int
	 */
	protected $ca_version;


	/**
	 * The value for the ca_idcotizacion field.
	 * @var        int
	 */
	protected $ca_idcotizacion;


	/**
	 * The value for the ca_origen field.
	 * @var        string
	 */
	protected $ca_origen;


	/**
	 * The value for the ca_destino field.
	 * @var        string
	 */
	protected $ca_destino;


	/**
	 * The value for the ca_impoexpo field.
	 * @var        string
	 */
	protected $ca_impoexpo;


	/**
	 * The value for the ca_fchdespacho field.
	 * @var        int
	 */
	protected $ca_fchdespacho;


	/**
	 * The value for the ca_idagente field.
	 * @var        int
	 */
	protected $ca_idagente;


	/**
	 * The value for the ca_incoterms field.
	 * @var        string
	 */
	protected $ca_incoterms;


	/**
	 * The value for the ca_mercancia_desc field.
	 * @var        string
	 */
	protected $ca_mercancia_desc;


	/**
	 * The value for the ca_idproveedor field.
	 * @var        string
	 */
	protected $ca_idproveedor;


	/**
	 * The value for the ca_orden_prov field.
	 * @var        string
	 */
	protected $ca_orden_prov;


	/**
	 * The value for the ca_idconcliente field.
	 * @var        int
	 */
	protected $ca_idconcliente;


	/**
	 * The value for the ca_orden_clie field.
	 * @var        string
	 */
	protected $ca_orden_clie;


	/**
	 * The value for the ca_confirmar_clie field.
	 * @var        string
	 */
	protected $ca_confirmar_clie;


	/**
	 * The value for the ca_idrepresentante field.
	 * @var        int
	 */
	protected $ca_idrepresentante;


	/**
	 * The value for the ca_informar_repr field.
	 * @var        string
	 */
	protected $ca_informar_repr;


	/**
	 * The value for the ca_idconsignatario field.
	 * @var        int
	 */
	protected $ca_idconsignatario;


	/**
	 * The value for the ca_informar_cons field.
	 * @var        string
	 */
	protected $ca_informar_cons;


	/**
	 * The value for the ca_idnotify field.
	 * @var        int
	 */
	protected $ca_idnotify;


	/**
	 * The value for the ca_informar_noti field.
	 * @var        string
	 */
	protected $ca_informar_noti;


	/**
	 * The value for the ca_notify field.
	 * @var        int
	 */
	protected $ca_notify;


	/**
	 * The value for the ca_transporte field.
	 * @var        string
	 */
	protected $ca_transporte;


	/**
	 * The value for the ca_modalidad field.
	 * @var        string
	 */
	protected $ca_modalidad;


	/**
	 * The value for the ca_seguro field.
	 * @var        string
	 */
	protected $ca_seguro;


	/**
	 * The value for the ca_liberacion field.
	 * @var        string
	 */
	protected $ca_liberacion;


	/**
	 * The value for the ca_tiempocredito field.
	 * @var        string
	 */
	protected $ca_tiempocredito;


	/**
	 * The value for the ca_preferencias_clie field.
	 * @var        string
	 */
	protected $ca_preferencias_clie;


	/**
	 * The value for the ca_instrucciones field.
	 * @var        string
	 */
	protected $ca_instrucciones;


	/**
	 * The value for the ca_idlinea field.
	 * @var        int
	 */
	protected $ca_idlinea;


	/**
	 * The value for the ca_idconsignar field.
	 * @var        int
	 */
	protected $ca_idconsignar;


	/**
	 * The value for the ca_idconsignarmaster field.
	 * @var        int
	 */
	protected $ca_idconsignarmaster;


	/**
	 * The value for the ca_idbodega field.
	 * @var        int
	 */
	protected $ca_idbodega;


	/**
	 * The value for the ca_mastersame field.
	 * @var        string
	 */
	protected $ca_mastersame;


	/**
	 * The value for the ca_continuacion field.
	 * @var        string
	 */
	protected $ca_continuacion;


	/**
	 * The value for the ca_continuacion_dest field.
	 * @var        string
	 */
	protected $ca_continuacion_dest;


	/**
	 * The value for the ca_continuacion_conf field.
	 * @var        string
	 */
	protected $ca_continuacion_conf;


	/**
	 * The value for the ca_etapa_actual field.
	 * @var        string
	 */
	protected $ca_etapa_actual;


	/**
	 * The value for the ca_login field.
	 * @var        string
	 */
	protected $ca_login;


	/**
	 * The value for the ca_fchcreado field.
	 * @var        int
	 */
	protected $ca_fchcreado;


	/**
	 * The value for the ca_usucreado field.
	 * @var        string
	 */
	protected $ca_usucreado;


	/**
	 * The value for the ca_fchactualizado field.
	 * @var        int
	 */
	protected $ca_fchactualizado;


	/**
	 * The value for the ca_usuactualizado field.
	 * @var        string
	 */
	protected $ca_usuactualizado;


	/**
	 * The value for the ca_fchanulado field.
	 * @var        int
	 */
	protected $ca_fchanulado;


	/**
	 * The value for the ca_usuanulado field.
	 * @var        string
	 */
	protected $ca_usuanulado;


	/**
	 * The value for the ca_fchcerrado field.
	 * @var        int
	 */
	protected $ca_fchcerrado;


	/**
	 * The value for the ca_usucerrado field.
	 * @var        string
	 */
	protected $ca_usucerrado;


	/**
	 * The value for the ca_colmas field.
	 * @var        string
	 */
	protected $ca_colmas;


	/**
	 * The value for the ca_propiedades field.
	 * @var        string
	 */
	protected $ca_propiedades;

	/**
	 * @var        Usuario
	 */
	protected $aUsuario;

	/**
	 * @var        Transportador
	 */
	protected $aTransportador;

	/**
	 * @var        Tercero
	 */
	protected $aTercero;

	/**
	 * @var        Agente
	 */
	protected $aAgente;

	/**
	 * Collection to store aggregation of collInoClientesAirs.
	 * @var        array
	 */
	protected $collInoClientesAirs;

	/**
	 * The criteria used to select the current contents of collInoClientesAirs.
	 * @var        Criteria
	 */
	protected $lastInoClientesAirCriteria = null;

	/**
	 * Collection to store aggregation of collRepAvisos.
	 * @var        array
	 */
	protected $collRepAvisos;

	/**
	 * The criteria used to select the current contents of collRepAvisos.
	 * @var        Criteria
	 */
	protected $lastRepAvisoCriteria = null;

	/**
	 * Collection to store aggregation of collRepStatuss.
	 * @var        array
	 */
	protected $collRepStatuss;

	/**
	 * The criteria used to select the current contents of collRepStatuss.
	 * @var        Criteria
	 */
	protected $lastRepStatusCriteria = null;

	/**
	 * Collection to store aggregation of collRepEquipos.
	 * @var        array
	 */
	protected $collRepEquipos;

	/**
	 * The criteria used to select the current contents of collRepEquipos.
	 * @var        Criteria
	 */
	protected $lastRepEquipoCriteria = null;

	/**
	 * Collection to store aggregation of collRepGastos.
	 * @var        array
	 */
	protected $collRepGastos;

	/**
	 * The criteria used to select the current contents of collRepGastos.
	 * @var        Criteria
	 */
	protected $lastRepGastoCriteria = null;

	/**
	 * Collection to store aggregation of collRepSeguros.
	 * @var        array
	 */
	protected $collRepSeguros;

	/**
	 * The criteria used to select the current contents of collRepSeguros.
	 * @var        Criteria
	 */
	protected $lastRepSeguroCriteria = null;

	/**
	 * Collection to store aggregation of collRepCostos.
	 * @var        array
	 */
	protected $collRepCostos;

	/**
	 * The criteria used to select the current contents of collRepCostos.
	 * @var        Criteria
	 */
	protected $lastRepCostoCriteria = null;

	/**
	 * Collection to store aggregation of collRepTarifas.
	 * @var        array
	 */
	protected $collRepTarifas;

	/**
	 * The criteria used to select the current contents of collRepTarifas.
	 * @var        Criteria
	 */
	protected $lastRepTarifaCriteria = null;

	/**
	 * Collection to store aggregation of collRepAduanas.
	 * @var        array
	 */
	protected $collRepAduanas;

	/**
	 * The criteria used to select the current contents of collRepAduanas.
	 * @var        Criteria
	 */
	protected $lastRepAduanaCriteria = null;

	/**
	 * Collection to store aggregation of collRepExpos.
	 * @var        array
	 */
	protected $collRepExpos;

	/**
	 * The criteria used to select the current contents of collRepExpos.
	 * @var        Criteria
	 */
	protected $lastRepExpoCriteria = null;

	/**
	 * Collection to store aggregation of collInoClientesSeas.
	 * @var        array
	 */
	protected $collInoClientesSeas;

	/**
	 * The criteria used to select the current contents of collInoClientesSeas.
	 * @var        Criteria
	 */
	protected $lastInoClientesSeaCriteria = null;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	/**
	 * Get the [ca_idreporte] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdreporte()
	{

		return $this->ca_idreporte;
	}

	/**
	 * Get the [optionally formatted] [ca_fchreporte] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchreporte($format = 'Y-m-d')
	{

		if ($this->ca_fchreporte === null || $this->ca_fchreporte === '') {
			return null;
		} elseif (!is_int($this->ca_fchreporte)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_fchreporte);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_fchreporte] as date/time value: " . var_export($this->ca_fchreporte, true));
			}
		} else {
			$ts = $this->ca_fchreporte;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	/**
	 * Get the [ca_consecutivo] column value.
	 * 
	 * @return     string
	 */
	public function getCaConsecutivo()
	{

		return $this->ca_consecutivo;
	}

	/**
	 * Get the [ca_version] column value.
	 * 
	 * @return     int
	 */
	public function getCaVersion()
	{

		return $this->ca_version;
	}

	/**
	 * Get the [ca_idcotizacion] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdcotizacion()
	{

		return $this->ca_idcotizacion;
	}

	/**
	 * Get the [ca_origen] column value.
	 * 
	 * @return     string
	 */
	public function getCaOrigen()
	{

		return $this->ca_origen;
	}

	/**
	 * Get the [ca_destino] column value.
	 * 
	 * @return     string
	 */
	public function getCaDestino()
	{

		return $this->ca_destino;
	}

	/**
	 * Get the [ca_impoexpo] column value.
	 * 
	 * @return     string
	 */
	public function getCaImpoexpo()
	{

		return $this->ca_impoexpo;
	}

	/**
	 * Get the [optionally formatted] [ca_fchdespacho] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchdespacho($format = 'Y-m-d')
	{

		if ($this->ca_fchdespacho === null || $this->ca_fchdespacho === '') {
			return null;
		} elseif (!is_int($this->ca_fchdespacho)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_fchdespacho);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_fchdespacho] as date/time value: " . var_export($this->ca_fchdespacho, true));
			}
		} else {
			$ts = $this->ca_fchdespacho;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	/**
	 * Get the [ca_idagente] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdagente()
	{

		return $this->ca_idagente;
	}

	/**
	 * Get the [ca_incoterms] column value.
	 * 
	 * @return     string
	 */
	public function getCaIncoterms()
	{

		return $this->ca_incoterms;
	}

	/**
	 * Get the [ca_mercancia_desc] column value.
	 * 
	 * @return     string
	 */
	public function getCaMercanciaDesc()
	{

		return $this->ca_mercancia_desc;
	}

	/**
	 * Get the [ca_idproveedor] column value.
	 * 
	 * @return     string
	 */
	public function getCaIdproveedor()
	{

		return $this->ca_idproveedor;
	}

	/**
	 * Get the [ca_orden_prov] column value.
	 * 
	 * @return     string
	 */
	public function getCaOrdenProv()
	{

		return $this->ca_orden_prov;
	}

	/**
	 * Get the [ca_idconcliente] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdconcliente()
	{

		return $this->ca_idconcliente;
	}

	/**
	 * Get the [ca_orden_clie] column value.
	 * 
	 * @return     string
	 */
	public function getCaOrdenClie()
	{

		return $this->ca_orden_clie;
	}

	/**
	 * Get the [ca_confirmar_clie] column value.
	 * 
	 * @return     string
	 */
	public function getCaConfirmarClie()
	{

		return $this->ca_confirmar_clie;
	}

	/**
	 * Get the [ca_idrepresentante] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdrepresentante()
	{

		return $this->ca_idrepresentante;
	}

	/**
	 * Get the [ca_informar_repr] column value.
	 * 
	 * @return     string
	 */
	public function getCaInformarRepr()
	{

		return $this->ca_informar_repr;
	}

	/**
	 * Get the [ca_idconsignatario] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdconsignatario()
	{

		return $this->ca_idconsignatario;
	}

	/**
	 * Get the [ca_informar_cons] column value.
	 * 
	 * @return     string
	 */
	public function getCaInformarCons()
	{

		return $this->ca_informar_cons;
	}

	/**
	 * Get the [ca_idnotify] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdnotify()
	{

		return $this->ca_idnotify;
	}

	/**
	 * Get the [ca_informar_noti] column value.
	 * 
	 * @return     string
	 */
	public function getCaInformarNoti()
	{

		return $this->ca_informar_noti;
	}

	/**
	 * Get the [ca_notify] column value.
	 * 
	 * @return     int
	 */
	public function getCaNotify()
	{

		return $this->ca_notify;
	}

	/**
	 * Get the [ca_transporte] column value.
	 * 
	 * @return     string
	 */
	public function getCaTransporte()
	{

		return $this->ca_transporte;
	}

	/**
	 * Get the [ca_modalidad] column value.
	 * 
	 * @return     string
	 */
	public function getCaModalidad()
	{

		return $this->ca_modalidad;
	}

	/**
	 * Get the [ca_seguro] column value.
	 * 
	 * @return     string
	 */
	public function getCaSeguro()
	{

		return $this->ca_seguro;
	}

	/**
	 * Get the [ca_liberacion] column value.
	 * 
	 * @return     string
	 */
	public function getCaLiberacion()
	{

		return $this->ca_liberacion;
	}

	/**
	 * Get the [ca_tiempocredito] column value.
	 * 
	 * @return     string
	 */
	public function getCaTiempocredito()
	{

		return $this->ca_tiempocredito;
	}

	/**
	 * Get the [ca_preferencias_clie] column value.
	 * 
	 * @return     string
	 */
	public function getCaPreferenciasClie()
	{

		return $this->ca_preferencias_clie;
	}

	/**
	 * Get the [ca_instrucciones] column value.
	 * 
	 * @return     string
	 */
	public function getCaInstrucciones()
	{

		return $this->ca_instrucciones;
	}

	/**
	 * Get the [ca_idlinea] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdlinea()
	{

		return $this->ca_idlinea;
	}

	/**
	 * Get the [ca_idconsignar] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdconsignar()
	{

		return $this->ca_idconsignar;
	}

	/**
	 * Get the [ca_idconsignarmaster] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdconsignarmaster()
	{

		return $this->ca_idconsignarmaster;
	}

	/**
	 * Get the [ca_idbodega] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdbodega()
	{

		return $this->ca_idbodega;
	}

	/**
	 * Get the [ca_mastersame] column value.
	 * 
	 * @return     string
	 */
	public function getCaMastersame()
	{

		return $this->ca_mastersame;
	}

	/**
	 * Get the [ca_continuacion] column value.
	 * 
	 * @return     string
	 */
	public function getCaContinuacion()
	{

		return $this->ca_continuacion;
	}

	/**
	 * Get the [ca_continuacion_dest] column value.
	 * 
	 * @return     string
	 */
	public function getCaContinuacionDest()
	{

		return $this->ca_continuacion_dest;
	}

	/**
	 * Get the [ca_continuacion_conf] column value.
	 * 
	 * @return     string
	 */
	public function getCaContinuacionConf()
	{

		return $this->ca_continuacion_conf;
	}

	/**
	 * Get the [ca_etapa_actual] column value.
	 * 
	 * @return     string
	 */
	public function getCaEtapaActual()
	{

		return $this->ca_etapa_actual;
	}

	/**
	 * Get the [ca_login] column value.
	 * 
	 * @return     string
	 */
	public function getCaLogin()
	{

		return $this->ca_login;
	}

	/**
	 * Get the [optionally formatted] [ca_fchcreado] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchcreado($format = 'Y-m-d H:i:s')
	{

		if ($this->ca_fchcreado === null || $this->ca_fchcreado === '') {
			return null;
		} elseif (!is_int($this->ca_fchcreado)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_fchcreado);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_fchcreado] as date/time value: " . var_export($this->ca_fchcreado, true));
			}
		} else {
			$ts = $this->ca_fchcreado;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	/**
	 * Get the [ca_usucreado] column value.
	 * 
	 * @return     string
	 */
	public function getCaUsucreado()
	{

		return $this->ca_usucreado;
	}

	/**
	 * Get the [optionally formatted] [ca_fchactualizado] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchactualizado($format = 'Y-m-d H:i:s')
	{

		if ($this->ca_fchactualizado === null || $this->ca_fchactualizado === '') {
			return null;
		} elseif (!is_int($this->ca_fchactualizado)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_fchactualizado);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_fchactualizado] as date/time value: " . var_export($this->ca_fchactualizado, true));
			}
		} else {
			$ts = $this->ca_fchactualizado;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	/**
	 * Get the [ca_usuactualizado] column value.
	 * 
	 * @return     string
	 */
	public function getCaUsuactualizado()
	{

		return $this->ca_usuactualizado;
	}

	/**
	 * Get the [optionally formatted] [ca_fchanulado] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchanulado($format = 'Y-m-d H:i:s')
	{

		if ($this->ca_fchanulado === null || $this->ca_fchanulado === '') {
			return null;
		} elseif (!is_int($this->ca_fchanulado)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_fchanulado);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_fchanulado] as date/time value: " . var_export($this->ca_fchanulado, true));
			}
		} else {
			$ts = $this->ca_fchanulado;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	/**
	 * Get the [ca_usuanulado] column value.
	 * 
	 * @return     string
	 */
	public function getCaUsuanulado()
	{

		return $this->ca_usuanulado;
	}

	/**
	 * Get the [optionally formatted] [ca_fchcerrado] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchcerrado($format = 'Y-m-d H:i:s')
	{

		if ($this->ca_fchcerrado === null || $this->ca_fchcerrado === '') {
			return null;
		} elseif (!is_int($this->ca_fchcerrado)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_fchcerrado);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_fchcerrado] as date/time value: " . var_export($this->ca_fchcerrado, true));
			}
		} else {
			$ts = $this->ca_fchcerrado;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	/**
	 * Get the [ca_usucerrado] column value.
	 * 
	 * @return     string
	 */
	public function getCaUsucerrado()
	{

		return $this->ca_usucerrado;
	}

	/**
	 * Get the [ca_colmas] column value.
	 * 
	 * @return     string
	 */
	public function getCaColmas()
	{

		return $this->ca_colmas;
	}

	/**
	 * Get the [ca_propiedades] column value.
	 * 
	 * @return     string
	 */
	public function getCaPropiedades()
	{

		return $this->ca_propiedades;
	}

	/**
	 * Set the value of [ca_idreporte] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdreporte($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idreporte !== $v) {
			$this->ca_idreporte = $v;
			$this->modifiedColumns[] = ReportePeer::CA_IDREPORTE;
		}

	} // setCaIdreporte()

	/**
	 * Set the value of [ca_fchreporte] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaFchreporte($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_fchreporte] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_fchreporte !== $ts) {
			$this->ca_fchreporte = $ts;
			$this->modifiedColumns[] = ReportePeer::CA_FCHREPORTE;
		}

	} // setCaFchreporte()

	/**
	 * Set the value of [ca_consecutivo] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaConsecutivo($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_consecutivo !== $v) {
			$this->ca_consecutivo = $v;
			$this->modifiedColumns[] = ReportePeer::CA_CONSECUTIVO;
		}

	} // setCaConsecutivo()

	/**
	 * Set the value of [ca_version] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaVersion($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_version !== $v) {
			$this->ca_version = $v;
			$this->modifiedColumns[] = ReportePeer::CA_VERSION;
		}

	} // setCaVersion()

	/**
	 * Set the value of [ca_idcotizacion] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdcotizacion($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idcotizacion !== $v) {
			$this->ca_idcotizacion = $v;
			$this->modifiedColumns[] = ReportePeer::CA_IDCOTIZACION;
		}

	} // setCaIdcotizacion()

	/**
	 * Set the value of [ca_origen] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaOrigen($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_origen !== $v) {
			$this->ca_origen = $v;
			$this->modifiedColumns[] = ReportePeer::CA_ORIGEN;
		}

	} // setCaOrigen()

	/**
	 * Set the value of [ca_destino] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaDestino($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_destino !== $v) {
			$this->ca_destino = $v;
			$this->modifiedColumns[] = ReportePeer::CA_DESTINO;
		}

	} // setCaDestino()

	/**
	 * Set the value of [ca_impoexpo] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaImpoexpo($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_impoexpo !== $v) {
			$this->ca_impoexpo = $v;
			$this->modifiedColumns[] = ReportePeer::CA_IMPOEXPO;
		}

	} // setCaImpoexpo()

	/**
	 * Set the value of [ca_fchdespacho] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaFchdespacho($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_fchdespacho] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_fchdespacho !== $ts) {
			$this->ca_fchdespacho = $ts;
			$this->modifiedColumns[] = ReportePeer::CA_FCHDESPACHO;
		}

	} // setCaFchdespacho()

	/**
	 * Set the value of [ca_idagente] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdagente($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idagente !== $v) {
			$this->ca_idagente = $v;
			$this->modifiedColumns[] = ReportePeer::CA_IDAGENTE;
		}

		if ($this->aAgente !== null && $this->aAgente->getCaIdagente() !== $v) {
			$this->aAgente = null;
		}

	} // setCaIdagente()

	/**
	 * Set the value of [ca_incoterms] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaIncoterms($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_incoterms !== $v) {
			$this->ca_incoterms = $v;
			$this->modifiedColumns[] = ReportePeer::CA_INCOTERMS;
		}

	} // setCaIncoterms()

	/**
	 * Set the value of [ca_mercancia_desc] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaMercanciaDesc($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_mercancia_desc !== $v) {
			$this->ca_mercancia_desc = $v;
			$this->modifiedColumns[] = ReportePeer::CA_MERCANCIA_DESC;
		}

	} // setCaMercanciaDesc()

	/**
	 * Set the value of [ca_idproveedor] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaIdproveedor($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_idproveedor !== $v) {
			$this->ca_idproveedor = $v;
			$this->modifiedColumns[] = ReportePeer::CA_IDPROVEEDOR;
		}

		if ($this->aTercero !== null && $this->aTercero->getCaIdtercero() !== $v) {
			$this->aTercero = null;
		}

	} // setCaIdproveedor()

	/**
	 * Set the value of [ca_orden_prov] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaOrdenProv($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_orden_prov !== $v) {
			$this->ca_orden_prov = $v;
			$this->modifiedColumns[] = ReportePeer::CA_ORDEN_PROV;
		}

	} // setCaOrdenProv()

	/**
	 * Set the value of [ca_idconcliente] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdconcliente($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idconcliente !== $v) {
			$this->ca_idconcliente = $v;
			$this->modifiedColumns[] = ReportePeer::CA_IDCONCLIENTE;
		}

	} // setCaIdconcliente()

	/**
	 * Set the value of [ca_orden_clie] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaOrdenClie($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_orden_clie !== $v) {
			$this->ca_orden_clie = $v;
			$this->modifiedColumns[] = ReportePeer::CA_ORDEN_CLIE;
		}

	} // setCaOrdenClie()

	/**
	 * Set the value of [ca_confirmar_clie] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaConfirmarClie($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_confirmar_clie !== $v) {
			$this->ca_confirmar_clie = $v;
			$this->modifiedColumns[] = ReportePeer::CA_CONFIRMAR_CLIE;
		}

	} // setCaConfirmarClie()

	/**
	 * Set the value of [ca_idrepresentante] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdrepresentante($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idrepresentante !== $v) {
			$this->ca_idrepresentante = $v;
			$this->modifiedColumns[] = ReportePeer::CA_IDREPRESENTANTE;
		}

	} // setCaIdrepresentante()

	/**
	 * Set the value of [ca_informar_repr] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaInformarRepr($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_informar_repr !== $v) {
			$this->ca_informar_repr = $v;
			$this->modifiedColumns[] = ReportePeer::CA_INFORMAR_REPR;
		}

	} // setCaInformarRepr()

	/**
	 * Set the value of [ca_idconsignatario] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdconsignatario($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idconsignatario !== $v) {
			$this->ca_idconsignatario = $v;
			$this->modifiedColumns[] = ReportePeer::CA_IDCONSIGNATARIO;
		}

	} // setCaIdconsignatario()

	/**
	 * Set the value of [ca_informar_cons] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaInformarCons($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_informar_cons !== $v) {
			$this->ca_informar_cons = $v;
			$this->modifiedColumns[] = ReportePeer::CA_INFORMAR_CONS;
		}

	} // setCaInformarCons()

	/**
	 * Set the value of [ca_idnotify] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdnotify($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idnotify !== $v) {
			$this->ca_idnotify = $v;
			$this->modifiedColumns[] = ReportePeer::CA_IDNOTIFY;
		}

	} // setCaIdnotify()

	/**
	 * Set the value of [ca_informar_noti] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaInformarNoti($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_informar_noti !== $v) {
			$this->ca_informar_noti = $v;
			$this->modifiedColumns[] = ReportePeer::CA_INFORMAR_NOTI;
		}

	} // setCaInformarNoti()

	/**
	 * Set the value of [ca_notify] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaNotify($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_notify !== $v) {
			$this->ca_notify = $v;
			$this->modifiedColumns[] = ReportePeer::CA_NOTIFY;
		}

	} // setCaNotify()

	/**
	 * Set the value of [ca_transporte] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaTransporte($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_transporte !== $v) {
			$this->ca_transporte = $v;
			$this->modifiedColumns[] = ReportePeer::CA_TRANSPORTE;
		}

	} // setCaTransporte()

	/**
	 * Set the value of [ca_modalidad] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaModalidad($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_modalidad !== $v) {
			$this->ca_modalidad = $v;
			$this->modifiedColumns[] = ReportePeer::CA_MODALIDAD;
		}

	} // setCaModalidad()

	/**
	 * Set the value of [ca_seguro] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaSeguro($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_seguro !== $v) {
			$this->ca_seguro = $v;
			$this->modifiedColumns[] = ReportePeer::CA_SEGURO;
		}

	} // setCaSeguro()

	/**
	 * Set the value of [ca_liberacion] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaLiberacion($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_liberacion !== $v) {
			$this->ca_liberacion = $v;
			$this->modifiedColumns[] = ReportePeer::CA_LIBERACION;
		}

	} // setCaLiberacion()

	/**
	 * Set the value of [ca_tiempocredito] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaTiempocredito($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_tiempocredito !== $v) {
			$this->ca_tiempocredito = $v;
			$this->modifiedColumns[] = ReportePeer::CA_TIEMPOCREDITO;
		}

	} // setCaTiempocredito()

	/**
	 * Set the value of [ca_preferencias_clie] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaPreferenciasClie($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_preferencias_clie !== $v) {
			$this->ca_preferencias_clie = $v;
			$this->modifiedColumns[] = ReportePeer::CA_PREFERENCIAS_CLIE;
		}

	} // setCaPreferenciasClie()

	/**
	 * Set the value of [ca_instrucciones] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaInstrucciones($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_instrucciones !== $v) {
			$this->ca_instrucciones = $v;
			$this->modifiedColumns[] = ReportePeer::CA_INSTRUCCIONES;
		}

	} // setCaInstrucciones()

	/**
	 * Set the value of [ca_idlinea] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdlinea($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idlinea !== $v) {
			$this->ca_idlinea = $v;
			$this->modifiedColumns[] = ReportePeer::CA_IDLINEA;
		}

		if ($this->aTransportador !== null && $this->aTransportador->getCaIdlinea() !== $v) {
			$this->aTransportador = null;
		}

	} // setCaIdlinea()

	/**
	 * Set the value of [ca_idconsignar] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdconsignar($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idconsignar !== $v) {
			$this->ca_idconsignar = $v;
			$this->modifiedColumns[] = ReportePeer::CA_IDCONSIGNAR;
		}

	} // setCaIdconsignar()

	/**
	 * Set the value of [ca_idconsignarmaster] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdconsignarmaster($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idconsignarmaster !== $v) {
			$this->ca_idconsignarmaster = $v;
			$this->modifiedColumns[] = ReportePeer::CA_IDCONSIGNARMASTER;
		}

	} // setCaIdconsignarmaster()

	/**
	 * Set the value of [ca_idbodega] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdbodega($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idbodega !== $v) {
			$this->ca_idbodega = $v;
			$this->modifiedColumns[] = ReportePeer::CA_IDBODEGA;
		}

	} // setCaIdbodega()

	/**
	 * Set the value of [ca_mastersame] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaMastersame($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_mastersame !== $v) {
			$this->ca_mastersame = $v;
			$this->modifiedColumns[] = ReportePeer::CA_MASTERSAME;
		}

	} // setCaMastersame()

	/**
	 * Set the value of [ca_continuacion] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaContinuacion($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_continuacion !== $v) {
			$this->ca_continuacion = $v;
			$this->modifiedColumns[] = ReportePeer::CA_CONTINUACION;
		}

	} // setCaContinuacion()

	/**
	 * Set the value of [ca_continuacion_dest] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaContinuacionDest($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_continuacion_dest !== $v) {
			$this->ca_continuacion_dest = $v;
			$this->modifiedColumns[] = ReportePeer::CA_CONTINUACION_DEST;
		}

	} // setCaContinuacionDest()

	/**
	 * Set the value of [ca_continuacion_conf] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaContinuacionConf($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_continuacion_conf !== $v) {
			$this->ca_continuacion_conf = $v;
			$this->modifiedColumns[] = ReportePeer::CA_CONTINUACION_CONF;
		}

	} // setCaContinuacionConf()

	/**
	 * Set the value of [ca_etapa_actual] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaEtapaActual($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_etapa_actual !== $v) {
			$this->ca_etapa_actual = $v;
			$this->modifiedColumns[] = ReportePeer::CA_ETAPA_ACTUAL;
		}

	} // setCaEtapaActual()

	/**
	 * Set the value of [ca_login] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaLogin($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_login !== $v) {
			$this->ca_login = $v;
			$this->modifiedColumns[] = ReportePeer::CA_LOGIN;
		}

		if ($this->aUsuario !== null && $this->aUsuario->getCaLogin() !== $v) {
			$this->aUsuario = null;
		}

	} // setCaLogin()

	/**
	 * Set the value of [ca_fchcreado] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaFchcreado($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_fchcreado] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_fchcreado !== $ts) {
			$this->ca_fchcreado = $ts;
			$this->modifiedColumns[] = ReportePeer::CA_FCHCREADO;
		}

	} // setCaFchcreado()

	/**
	 * Set the value of [ca_usucreado] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaUsucreado($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_usucreado !== $v) {
			$this->ca_usucreado = $v;
			$this->modifiedColumns[] = ReportePeer::CA_USUCREADO;
		}

	} // setCaUsucreado()

	/**
	 * Set the value of [ca_fchactualizado] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaFchactualizado($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_fchactualizado] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_fchactualizado !== $ts) {
			$this->ca_fchactualizado = $ts;
			$this->modifiedColumns[] = ReportePeer::CA_FCHACTUALIZADO;
		}

	} // setCaFchactualizado()

	/**
	 * Set the value of [ca_usuactualizado] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaUsuactualizado($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_usuactualizado !== $v) {
			$this->ca_usuactualizado = $v;
			$this->modifiedColumns[] = ReportePeer::CA_USUACTUALIZADO;
		}

	} // setCaUsuactualizado()

	/**
	 * Set the value of [ca_fchanulado] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaFchanulado($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_fchanulado] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_fchanulado !== $ts) {
			$this->ca_fchanulado = $ts;
			$this->modifiedColumns[] = ReportePeer::CA_FCHANULADO;
		}

	} // setCaFchanulado()

	/**
	 * Set the value of [ca_usuanulado] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaUsuanulado($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_usuanulado !== $v) {
			$this->ca_usuanulado = $v;
			$this->modifiedColumns[] = ReportePeer::CA_USUANULADO;
		}

	} // setCaUsuanulado()

	/**
	 * Set the value of [ca_fchcerrado] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaFchcerrado($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_fchcerrado] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_fchcerrado !== $ts) {
			$this->ca_fchcerrado = $ts;
			$this->modifiedColumns[] = ReportePeer::CA_FCHCERRADO;
		}

	} // setCaFchcerrado()

	/**
	 * Set the value of [ca_usucerrado] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaUsucerrado($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_usucerrado !== $v) {
			$this->ca_usucerrado = $v;
			$this->modifiedColumns[] = ReportePeer::CA_USUCERRADO;
		}

	} // setCaUsucerrado()

	/**
	 * Set the value of [ca_colmas] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaColmas($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_colmas !== $v) {
			$this->ca_colmas = $v;
			$this->modifiedColumns[] = ReportePeer::CA_COLMAS;
		}

	} // setCaColmas()

	/**
	 * Set the value of [ca_propiedades] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaPropiedades($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_propiedades !== $v) {
			$this->ca_propiedades = $v;
			$this->modifiedColumns[] = ReportePeer::CA_PROPIEDADES;
		}

	} // setCaPropiedades()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (1-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      ResultSet $rs The ResultSet class with cursor advanced to desired record pos.
	 * @param      int $startcol 1-based offset column which indicates which restultset column to start with.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->ca_idreporte = $rs->getInt($startcol + 0);

			$this->ca_fchreporte = $rs->getDate($startcol + 1, null);

			$this->ca_consecutivo = $rs->getString($startcol + 2);

			$this->ca_version = $rs->getInt($startcol + 3);

			$this->ca_idcotizacion = $rs->getInt($startcol + 4);

			$this->ca_origen = $rs->getString($startcol + 5);

			$this->ca_destino = $rs->getString($startcol + 6);

			$this->ca_impoexpo = $rs->getString($startcol + 7);

			$this->ca_fchdespacho = $rs->getDate($startcol + 8, null);

			$this->ca_idagente = $rs->getInt($startcol + 9);

			$this->ca_incoterms = $rs->getString($startcol + 10);

			$this->ca_mercancia_desc = $rs->getString($startcol + 11);

			$this->ca_idproveedor = $rs->getString($startcol + 12);

			$this->ca_orden_prov = $rs->getString($startcol + 13);

			$this->ca_idconcliente = $rs->getInt($startcol + 14);

			$this->ca_orden_clie = $rs->getString($startcol + 15);

			$this->ca_confirmar_clie = $rs->getString($startcol + 16);

			$this->ca_idrepresentante = $rs->getInt($startcol + 17);

			$this->ca_informar_repr = $rs->getString($startcol + 18);

			$this->ca_idconsignatario = $rs->getInt($startcol + 19);

			$this->ca_informar_cons = $rs->getString($startcol + 20);

			$this->ca_idnotify = $rs->getInt($startcol + 21);

			$this->ca_informar_noti = $rs->getString($startcol + 22);

			$this->ca_notify = $rs->getInt($startcol + 23);

			$this->ca_transporte = $rs->getString($startcol + 24);

			$this->ca_modalidad = $rs->getString($startcol + 25);

			$this->ca_seguro = $rs->getString($startcol + 26);

			$this->ca_liberacion = $rs->getString($startcol + 27);

			$this->ca_tiempocredito = $rs->getString($startcol + 28);

			$this->ca_preferencias_clie = $rs->getString($startcol + 29);

			$this->ca_instrucciones = $rs->getString($startcol + 30);

			$this->ca_idlinea = $rs->getInt($startcol + 31);

			$this->ca_idconsignar = $rs->getInt($startcol + 32);

			$this->ca_idconsignarmaster = $rs->getInt($startcol + 33);

			$this->ca_idbodega = $rs->getInt($startcol + 34);

			$this->ca_mastersame = $rs->getString($startcol + 35);

			$this->ca_continuacion = $rs->getString($startcol + 36);

			$this->ca_continuacion_dest = $rs->getString($startcol + 37);

			$this->ca_continuacion_conf = $rs->getString($startcol + 38);

			$this->ca_etapa_actual = $rs->getString($startcol + 39);

			$this->ca_login = $rs->getString($startcol + 40);

			$this->ca_fchcreado = $rs->getTimestamp($startcol + 41, null);

			$this->ca_usucreado = $rs->getString($startcol + 42);

			$this->ca_fchactualizado = $rs->getTimestamp($startcol + 43, null);

			$this->ca_usuactualizado = $rs->getString($startcol + 44);

			$this->ca_fchanulado = $rs->getTimestamp($startcol + 45, null);

			$this->ca_usuanulado = $rs->getString($startcol + 46);

			$this->ca_fchcerrado = $rs->getTimestamp($startcol + 47, null);

			$this->ca_usucerrado = $rs->getString($startcol + 48);

			$this->ca_colmas = $rs->getString($startcol + 49);

			$this->ca_propiedades = $rs->getString($startcol + 50);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 51; // 51 = ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Reporte object", $e);
		}
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      Connection $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ReportePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Stores the object in the database.  If the object is new,
	 * it inserts it; otherwise an update is performed.  This method
	 * wraps the doSave() worker method in a transaction.
	 *
	 * @param      Connection $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Stores the object in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      Connection $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave($con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aUsuario !== null) {
				if ($this->aUsuario->isModified()) {
					$affectedRows += $this->aUsuario->save($con);
				}
				$this->setUsuario($this->aUsuario);
			}

			if ($this->aTransportador !== null) {
				if ($this->aTransportador->isModified()) {
					$affectedRows += $this->aTransportador->save($con);
				}
				$this->setTransportador($this->aTransportador);
			}

			if ($this->aTercero !== null) {
				if ($this->aTercero->isModified()) {
					$affectedRows += $this->aTercero->save($con);
				}
				$this->setTercero($this->aTercero);
			}

			if ($this->aAgente !== null) {
				if ($this->aAgente->isModified()) {
					$affectedRows += $this->aAgente->save($con);
				}
				$this->setAgente($this->aAgente);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ReportePeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setCaIdreporte($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += ReportePeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collInoClientesAirs !== null) {
				foreach($this->collInoClientesAirs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRepAvisos !== null) {
				foreach($this->collRepAvisos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRepStatuss !== null) {
				foreach($this->collRepStatuss as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRepEquipos !== null) {
				foreach($this->collRepEquipos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRepGastos !== null) {
				foreach($this->collRepGastos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRepSeguros !== null) {
				foreach($this->collRepSeguros as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRepCostos !== null) {
				foreach($this->collRepCostos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRepTarifas !== null) {
				foreach($this->collRepTarifas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRepAduanas !== null) {
				foreach($this->collRepAduanas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRepExpos !== null) {
				foreach($this->collRepExpos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collInoClientesSeas !== null) {
				foreach($this->collInoClientesSeas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} // doSave()

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aUsuario !== null) {
				if (!$this->aUsuario->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsuario->getValidationFailures());
				}
			}

			if ($this->aTransportador !== null) {
				if (!$this->aTransportador->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTransportador->getValidationFailures());
				}
			}

			if ($this->aTercero !== null) {
				if (!$this->aTercero->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTercero->getValidationFailures());
				}
			}

			if ($this->aAgente !== null) {
				if (!$this->aAgente->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAgente->getValidationFailures());
				}
			}


			if (($retval = ReportePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collInoClientesAirs !== null) {
					foreach($this->collInoClientesAirs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRepAvisos !== null) {
					foreach($this->collRepAvisos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRepStatuss !== null) {
					foreach($this->collRepStatuss as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRepEquipos !== null) {
					foreach($this->collRepEquipos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRepGastos !== null) {
					foreach($this->collRepGastos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRepSeguros !== null) {
					foreach($this->collRepSeguros as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRepCostos !== null) {
					foreach($this->collRepCostos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRepTarifas !== null) {
					foreach($this->collRepTarifas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRepAduanas !== null) {
					foreach($this->collRepAduanas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRepExpos !== null) {
					foreach($this->collRepExpos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collInoClientesSeas !== null) {
					foreach($this->collInoClientesSeas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants TYPE_PHPNAME,
	 *                     TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ReportePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdreporte();
				break;
			case 1:
				return $this->getCaFchreporte();
				break;
			case 2:
				return $this->getCaConsecutivo();
				break;
			case 3:
				return $this->getCaVersion();
				break;
			case 4:
				return $this->getCaIdcotizacion();
				break;
			case 5:
				return $this->getCaOrigen();
				break;
			case 6:
				return $this->getCaDestino();
				break;
			case 7:
				return $this->getCaImpoexpo();
				break;
			case 8:
				return $this->getCaFchdespacho();
				break;
			case 9:
				return $this->getCaIdagente();
				break;
			case 10:
				return $this->getCaIncoterms();
				break;
			case 11:
				return $this->getCaMercanciaDesc();
				break;
			case 12:
				return $this->getCaIdproveedor();
				break;
			case 13:
				return $this->getCaOrdenProv();
				break;
			case 14:
				return $this->getCaIdconcliente();
				break;
			case 15:
				return $this->getCaOrdenClie();
				break;
			case 16:
				return $this->getCaConfirmarClie();
				break;
			case 17:
				return $this->getCaIdrepresentante();
				break;
			case 18:
				return $this->getCaInformarRepr();
				break;
			case 19:
				return $this->getCaIdconsignatario();
				break;
			case 20:
				return $this->getCaInformarCons();
				break;
			case 21:
				return $this->getCaIdnotify();
				break;
			case 22:
				return $this->getCaInformarNoti();
				break;
			case 23:
				return $this->getCaNotify();
				break;
			case 24:
				return $this->getCaTransporte();
				break;
			case 25:
				return $this->getCaModalidad();
				break;
			case 26:
				return $this->getCaSeguro();
				break;
			case 27:
				return $this->getCaLiberacion();
				break;
			case 28:
				return $this->getCaTiempocredito();
				break;
			case 29:
				return $this->getCaPreferenciasClie();
				break;
			case 30:
				return $this->getCaInstrucciones();
				break;
			case 31:
				return $this->getCaIdlinea();
				break;
			case 32:
				return $this->getCaIdconsignar();
				break;
			case 33:
				return $this->getCaIdconsignarmaster();
				break;
			case 34:
				return $this->getCaIdbodega();
				break;
			case 35:
				return $this->getCaMastersame();
				break;
			case 36:
				return $this->getCaContinuacion();
				break;
			case 37:
				return $this->getCaContinuacionDest();
				break;
			case 38:
				return $this->getCaContinuacionConf();
				break;
			case 39:
				return $this->getCaEtapaActual();
				break;
			case 40:
				return $this->getCaLogin();
				break;
			case 41:
				return $this->getCaFchcreado();
				break;
			case 42:
				return $this->getCaUsucreado();
				break;
			case 43:
				return $this->getCaFchactualizado();
				break;
			case 44:
				return $this->getCaUsuactualizado();
				break;
			case 45:
				return $this->getCaFchanulado();
				break;
			case 46:
				return $this->getCaUsuanulado();
				break;
			case 47:
				return $this->getCaFchcerrado();
				break;
			case 48:
				return $this->getCaUsucerrado();
				break;
			case 49:
				return $this->getCaColmas();
				break;
			case 50:
				return $this->getCaPropiedades();
				break;
			default:
				return null;
				break;
		} // switch()
	}

	/**
	 * Exports the object as an array.
	 *
	 * You can specify the key type of the array by passing one of the class
	 * type constants.
	 *
	 * @param      string $keyType One of the class type constants TYPE_PHPNAME,
	 *                        TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ReportePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdreporte(),
			$keys[1] => $this->getCaFchreporte(),
			$keys[2] => $this->getCaConsecutivo(),
			$keys[3] => $this->getCaVersion(),
			$keys[4] => $this->getCaIdcotizacion(),
			$keys[5] => $this->getCaOrigen(),
			$keys[6] => $this->getCaDestino(),
			$keys[7] => $this->getCaImpoexpo(),
			$keys[8] => $this->getCaFchdespacho(),
			$keys[9] => $this->getCaIdagente(),
			$keys[10] => $this->getCaIncoterms(),
			$keys[11] => $this->getCaMercanciaDesc(),
			$keys[12] => $this->getCaIdproveedor(),
			$keys[13] => $this->getCaOrdenProv(),
			$keys[14] => $this->getCaIdconcliente(),
			$keys[15] => $this->getCaOrdenClie(),
			$keys[16] => $this->getCaConfirmarClie(),
			$keys[17] => $this->getCaIdrepresentante(),
			$keys[18] => $this->getCaInformarRepr(),
			$keys[19] => $this->getCaIdconsignatario(),
			$keys[20] => $this->getCaInformarCons(),
			$keys[21] => $this->getCaIdnotify(),
			$keys[22] => $this->getCaInformarNoti(),
			$keys[23] => $this->getCaNotify(),
			$keys[24] => $this->getCaTransporte(),
			$keys[25] => $this->getCaModalidad(),
			$keys[26] => $this->getCaSeguro(),
			$keys[27] => $this->getCaLiberacion(),
			$keys[28] => $this->getCaTiempocredito(),
			$keys[29] => $this->getCaPreferenciasClie(),
			$keys[30] => $this->getCaInstrucciones(),
			$keys[31] => $this->getCaIdlinea(),
			$keys[32] => $this->getCaIdconsignar(),
			$keys[33] => $this->getCaIdconsignarmaster(),
			$keys[34] => $this->getCaIdbodega(),
			$keys[35] => $this->getCaMastersame(),
			$keys[36] => $this->getCaContinuacion(),
			$keys[37] => $this->getCaContinuacionDest(),
			$keys[38] => $this->getCaContinuacionConf(),
			$keys[39] => $this->getCaEtapaActual(),
			$keys[40] => $this->getCaLogin(),
			$keys[41] => $this->getCaFchcreado(),
			$keys[42] => $this->getCaUsucreado(),
			$keys[43] => $this->getCaFchactualizado(),
			$keys[44] => $this->getCaUsuactualizado(),
			$keys[45] => $this->getCaFchanulado(),
			$keys[46] => $this->getCaUsuanulado(),
			$keys[47] => $this->getCaFchcerrado(),
			$keys[48] => $this->getCaUsucerrado(),
			$keys[49] => $this->getCaColmas(),
			$keys[50] => $this->getCaPropiedades(),
		);
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants TYPE_PHPNAME,
	 *                     TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ReportePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdreporte($value);
				break;
			case 1:
				$this->setCaFchreporte($value);
				break;
			case 2:
				$this->setCaConsecutivo($value);
				break;
			case 3:
				$this->setCaVersion($value);
				break;
			case 4:
				$this->setCaIdcotizacion($value);
				break;
			case 5:
				$this->setCaOrigen($value);
				break;
			case 6:
				$this->setCaDestino($value);
				break;
			case 7:
				$this->setCaImpoexpo($value);
				break;
			case 8:
				$this->setCaFchdespacho($value);
				break;
			case 9:
				$this->setCaIdagente($value);
				break;
			case 10:
				$this->setCaIncoterms($value);
				break;
			case 11:
				$this->setCaMercanciaDesc($value);
				break;
			case 12:
				$this->setCaIdproveedor($value);
				break;
			case 13:
				$this->setCaOrdenProv($value);
				break;
			case 14:
				$this->setCaIdconcliente($value);
				break;
			case 15:
				$this->setCaOrdenClie($value);
				break;
			case 16:
				$this->setCaConfirmarClie($value);
				break;
			case 17:
				$this->setCaIdrepresentante($value);
				break;
			case 18:
				$this->setCaInformarRepr($value);
				break;
			case 19:
				$this->setCaIdconsignatario($value);
				break;
			case 20:
				$this->setCaInformarCons($value);
				break;
			case 21:
				$this->setCaIdnotify($value);
				break;
			case 22:
				$this->setCaInformarNoti($value);
				break;
			case 23:
				$this->setCaNotify($value);
				break;
			case 24:
				$this->setCaTransporte($value);
				break;
			case 25:
				$this->setCaModalidad($value);
				break;
			case 26:
				$this->setCaSeguro($value);
				break;
			case 27:
				$this->setCaLiberacion($value);
				break;
			case 28:
				$this->setCaTiempocredito($value);
				break;
			case 29:
				$this->setCaPreferenciasClie($value);
				break;
			case 30:
				$this->setCaInstrucciones($value);
				break;
			case 31:
				$this->setCaIdlinea($value);
				break;
			case 32:
				$this->setCaIdconsignar($value);
				break;
			case 33:
				$this->setCaIdconsignarmaster($value);
				break;
			case 34:
				$this->setCaIdbodega($value);
				break;
			case 35:
				$this->setCaMastersame($value);
				break;
			case 36:
				$this->setCaContinuacion($value);
				break;
			case 37:
				$this->setCaContinuacionDest($value);
				break;
			case 38:
				$this->setCaContinuacionConf($value);
				break;
			case 39:
				$this->setCaEtapaActual($value);
				break;
			case 40:
				$this->setCaLogin($value);
				break;
			case 41:
				$this->setCaFchcreado($value);
				break;
			case 42:
				$this->setCaUsucreado($value);
				break;
			case 43:
				$this->setCaFchactualizado($value);
				break;
			case 44:
				$this->setCaUsuactualizado($value);
				break;
			case 45:
				$this->setCaFchanulado($value);
				break;
			case 46:
				$this->setCaUsuanulado($value);
				break;
			case 47:
				$this->setCaFchcerrado($value);
				break;
			case 48:
				$this->setCaUsucerrado($value);
				break;
			case 49:
				$this->setCaColmas($value);
				break;
			case 50:
				$this->setCaPropiedades($value);
				break;
		} // switch()
	}

	/**
	 * Populates the object using an array.
	 *
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the column
	 * names, checking to see whether a matching key exists in populated
	 * array. If so the setByName() method is called for that column.
	 *
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME,
	 * TYPE_NUM. The default key type is the column's phpname (e.g. 'authorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ReportePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdreporte($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaFchreporte($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaConsecutivo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaVersion($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaIdcotizacion($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaOrigen($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaDestino($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaImpoexpo($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaFchdespacho($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaIdagente($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaIncoterms($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaMercanciaDesc($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaIdproveedor($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaOrdenProv($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaIdconcliente($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaOrdenClie($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCaConfirmarClie($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setCaIdrepresentante($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setCaInformarRepr($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setCaIdconsignatario($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setCaInformarCons($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setCaIdnotify($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setCaInformarNoti($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setCaNotify($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setCaTransporte($arr[$keys[24]]);
		if (array_key_exists($keys[25], $arr)) $this->setCaModalidad($arr[$keys[25]]);
		if (array_key_exists($keys[26], $arr)) $this->setCaSeguro($arr[$keys[26]]);
		if (array_key_exists($keys[27], $arr)) $this->setCaLiberacion($arr[$keys[27]]);
		if (array_key_exists($keys[28], $arr)) $this->setCaTiempocredito($arr[$keys[28]]);
		if (array_key_exists($keys[29], $arr)) $this->setCaPreferenciasClie($arr[$keys[29]]);
		if (array_key_exists($keys[30], $arr)) $this->setCaInstrucciones($arr[$keys[30]]);
		if (array_key_exists($keys[31], $arr)) $this->setCaIdlinea($arr[$keys[31]]);
		if (array_key_exists($keys[32], $arr)) $this->setCaIdconsignar($arr[$keys[32]]);
		if (array_key_exists($keys[33], $arr)) $this->setCaIdconsignarmaster($arr[$keys[33]]);
		if (array_key_exists($keys[34], $arr)) $this->setCaIdbodega($arr[$keys[34]]);
		if (array_key_exists($keys[35], $arr)) $this->setCaMastersame($arr[$keys[35]]);
		if (array_key_exists($keys[36], $arr)) $this->setCaContinuacion($arr[$keys[36]]);
		if (array_key_exists($keys[37], $arr)) $this->setCaContinuacionDest($arr[$keys[37]]);
		if (array_key_exists($keys[38], $arr)) $this->setCaContinuacionConf($arr[$keys[38]]);
		if (array_key_exists($keys[39], $arr)) $this->setCaEtapaActual($arr[$keys[39]]);
		if (array_key_exists($keys[40], $arr)) $this->setCaLogin($arr[$keys[40]]);
		if (array_key_exists($keys[41], $arr)) $this->setCaFchcreado($arr[$keys[41]]);
		if (array_key_exists($keys[42], $arr)) $this->setCaUsucreado($arr[$keys[42]]);
		if (array_key_exists($keys[43], $arr)) $this->setCaFchactualizado($arr[$keys[43]]);
		if (array_key_exists($keys[44], $arr)) $this->setCaUsuactualizado($arr[$keys[44]]);
		if (array_key_exists($keys[45], $arr)) $this->setCaFchanulado($arr[$keys[45]]);
		if (array_key_exists($keys[46], $arr)) $this->setCaUsuanulado($arr[$keys[46]]);
		if (array_key_exists($keys[47], $arr)) $this->setCaFchcerrado($arr[$keys[47]]);
		if (array_key_exists($keys[48], $arr)) $this->setCaUsucerrado($arr[$keys[48]]);
		if (array_key_exists($keys[49], $arr)) $this->setCaColmas($arr[$keys[49]]);
		if (array_key_exists($keys[50], $arr)) $this->setCaPropiedades($arr[$keys[50]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(ReportePeer::DATABASE_NAME);

		if ($this->isColumnModified(ReportePeer::CA_IDREPORTE)) $criteria->add(ReportePeer::CA_IDREPORTE, $this->ca_idreporte);
		if ($this->isColumnModified(ReportePeer::CA_FCHREPORTE)) $criteria->add(ReportePeer::CA_FCHREPORTE, $this->ca_fchreporte);
		if ($this->isColumnModified(ReportePeer::CA_CONSECUTIVO)) $criteria->add(ReportePeer::CA_CONSECUTIVO, $this->ca_consecutivo);
		if ($this->isColumnModified(ReportePeer::CA_VERSION)) $criteria->add(ReportePeer::CA_VERSION, $this->ca_version);
		if ($this->isColumnModified(ReportePeer::CA_IDCOTIZACION)) $criteria->add(ReportePeer::CA_IDCOTIZACION, $this->ca_idcotizacion);
		if ($this->isColumnModified(ReportePeer::CA_ORIGEN)) $criteria->add(ReportePeer::CA_ORIGEN, $this->ca_origen);
		if ($this->isColumnModified(ReportePeer::CA_DESTINO)) $criteria->add(ReportePeer::CA_DESTINO, $this->ca_destino);
		if ($this->isColumnModified(ReportePeer::CA_IMPOEXPO)) $criteria->add(ReportePeer::CA_IMPOEXPO, $this->ca_impoexpo);
		if ($this->isColumnModified(ReportePeer::CA_FCHDESPACHO)) $criteria->add(ReportePeer::CA_FCHDESPACHO, $this->ca_fchdespacho);
		if ($this->isColumnModified(ReportePeer::CA_IDAGENTE)) $criteria->add(ReportePeer::CA_IDAGENTE, $this->ca_idagente);
		if ($this->isColumnModified(ReportePeer::CA_INCOTERMS)) $criteria->add(ReportePeer::CA_INCOTERMS, $this->ca_incoterms);
		if ($this->isColumnModified(ReportePeer::CA_MERCANCIA_DESC)) $criteria->add(ReportePeer::CA_MERCANCIA_DESC, $this->ca_mercancia_desc);
		if ($this->isColumnModified(ReportePeer::CA_IDPROVEEDOR)) $criteria->add(ReportePeer::CA_IDPROVEEDOR, $this->ca_idproveedor);
		if ($this->isColumnModified(ReportePeer::CA_ORDEN_PROV)) $criteria->add(ReportePeer::CA_ORDEN_PROV, $this->ca_orden_prov);
		if ($this->isColumnModified(ReportePeer::CA_IDCONCLIENTE)) $criteria->add(ReportePeer::CA_IDCONCLIENTE, $this->ca_idconcliente);
		if ($this->isColumnModified(ReportePeer::CA_ORDEN_CLIE)) $criteria->add(ReportePeer::CA_ORDEN_CLIE, $this->ca_orden_clie);
		if ($this->isColumnModified(ReportePeer::CA_CONFIRMAR_CLIE)) $criteria->add(ReportePeer::CA_CONFIRMAR_CLIE, $this->ca_confirmar_clie);
		if ($this->isColumnModified(ReportePeer::CA_IDREPRESENTANTE)) $criteria->add(ReportePeer::CA_IDREPRESENTANTE, $this->ca_idrepresentante);
		if ($this->isColumnModified(ReportePeer::CA_INFORMAR_REPR)) $criteria->add(ReportePeer::CA_INFORMAR_REPR, $this->ca_informar_repr);
		if ($this->isColumnModified(ReportePeer::CA_IDCONSIGNATARIO)) $criteria->add(ReportePeer::CA_IDCONSIGNATARIO, $this->ca_idconsignatario);
		if ($this->isColumnModified(ReportePeer::CA_INFORMAR_CONS)) $criteria->add(ReportePeer::CA_INFORMAR_CONS, $this->ca_informar_cons);
		if ($this->isColumnModified(ReportePeer::CA_IDNOTIFY)) $criteria->add(ReportePeer::CA_IDNOTIFY, $this->ca_idnotify);
		if ($this->isColumnModified(ReportePeer::CA_INFORMAR_NOTI)) $criteria->add(ReportePeer::CA_INFORMAR_NOTI, $this->ca_informar_noti);
		if ($this->isColumnModified(ReportePeer::CA_NOTIFY)) $criteria->add(ReportePeer::CA_NOTIFY, $this->ca_notify);
		if ($this->isColumnModified(ReportePeer::CA_TRANSPORTE)) $criteria->add(ReportePeer::CA_TRANSPORTE, $this->ca_transporte);
		if ($this->isColumnModified(ReportePeer::CA_MODALIDAD)) $criteria->add(ReportePeer::CA_MODALIDAD, $this->ca_modalidad);
		if ($this->isColumnModified(ReportePeer::CA_SEGURO)) $criteria->add(ReportePeer::CA_SEGURO, $this->ca_seguro);
		if ($this->isColumnModified(ReportePeer::CA_LIBERACION)) $criteria->add(ReportePeer::CA_LIBERACION, $this->ca_liberacion);
		if ($this->isColumnModified(ReportePeer::CA_TIEMPOCREDITO)) $criteria->add(ReportePeer::CA_TIEMPOCREDITO, $this->ca_tiempocredito);
		if ($this->isColumnModified(ReportePeer::CA_PREFERENCIAS_CLIE)) $criteria->add(ReportePeer::CA_PREFERENCIAS_CLIE, $this->ca_preferencias_clie);
		if ($this->isColumnModified(ReportePeer::CA_INSTRUCCIONES)) $criteria->add(ReportePeer::CA_INSTRUCCIONES, $this->ca_instrucciones);
		if ($this->isColumnModified(ReportePeer::CA_IDLINEA)) $criteria->add(ReportePeer::CA_IDLINEA, $this->ca_idlinea);
		if ($this->isColumnModified(ReportePeer::CA_IDCONSIGNAR)) $criteria->add(ReportePeer::CA_IDCONSIGNAR, $this->ca_idconsignar);
		if ($this->isColumnModified(ReportePeer::CA_IDCONSIGNARMASTER)) $criteria->add(ReportePeer::CA_IDCONSIGNARMASTER, $this->ca_idconsignarmaster);
		if ($this->isColumnModified(ReportePeer::CA_IDBODEGA)) $criteria->add(ReportePeer::CA_IDBODEGA, $this->ca_idbodega);
		if ($this->isColumnModified(ReportePeer::CA_MASTERSAME)) $criteria->add(ReportePeer::CA_MASTERSAME, $this->ca_mastersame);
		if ($this->isColumnModified(ReportePeer::CA_CONTINUACION)) $criteria->add(ReportePeer::CA_CONTINUACION, $this->ca_continuacion);
		if ($this->isColumnModified(ReportePeer::CA_CONTINUACION_DEST)) $criteria->add(ReportePeer::CA_CONTINUACION_DEST, $this->ca_continuacion_dest);
		if ($this->isColumnModified(ReportePeer::CA_CONTINUACION_CONF)) $criteria->add(ReportePeer::CA_CONTINUACION_CONF, $this->ca_continuacion_conf);
		if ($this->isColumnModified(ReportePeer::CA_ETAPA_ACTUAL)) $criteria->add(ReportePeer::CA_ETAPA_ACTUAL, $this->ca_etapa_actual);
		if ($this->isColumnModified(ReportePeer::CA_LOGIN)) $criteria->add(ReportePeer::CA_LOGIN, $this->ca_login);
		if ($this->isColumnModified(ReportePeer::CA_FCHCREADO)) $criteria->add(ReportePeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(ReportePeer::CA_USUCREADO)) $criteria->add(ReportePeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(ReportePeer::CA_FCHACTUALIZADO)) $criteria->add(ReportePeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(ReportePeer::CA_USUACTUALIZADO)) $criteria->add(ReportePeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);
		if ($this->isColumnModified(ReportePeer::CA_FCHANULADO)) $criteria->add(ReportePeer::CA_FCHANULADO, $this->ca_fchanulado);
		if ($this->isColumnModified(ReportePeer::CA_USUANULADO)) $criteria->add(ReportePeer::CA_USUANULADO, $this->ca_usuanulado);
		if ($this->isColumnModified(ReportePeer::CA_FCHCERRADO)) $criteria->add(ReportePeer::CA_FCHCERRADO, $this->ca_fchcerrado);
		if ($this->isColumnModified(ReportePeer::CA_USUCERRADO)) $criteria->add(ReportePeer::CA_USUCERRADO, $this->ca_usucerrado);
		if ($this->isColumnModified(ReportePeer::CA_COLMAS)) $criteria->add(ReportePeer::CA_COLMAS, $this->ca_colmas);
		if ($this->isColumnModified(ReportePeer::CA_PROPIEDADES)) $criteria->add(ReportePeer::CA_PROPIEDADES, $this->ca_propiedades);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ReportePeer::DATABASE_NAME);

		$criteria->add(ReportePeer::CA_IDREPORTE, $this->ca_idreporte);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdreporte();
	}

	/**
	 * Generic method to set the primary key (ca_idreporte column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdreporte($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Reporte (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaFchreporte($this->ca_fchreporte);

		$copyObj->setCaConsecutivo($this->ca_consecutivo);

		$copyObj->setCaVersion($this->ca_version);

		$copyObj->setCaIdcotizacion($this->ca_idcotizacion);

		$copyObj->setCaOrigen($this->ca_origen);

		$copyObj->setCaDestino($this->ca_destino);

		$copyObj->setCaImpoexpo($this->ca_impoexpo);

		$copyObj->setCaFchdespacho($this->ca_fchdespacho);

		$copyObj->setCaIdagente($this->ca_idagente);

		$copyObj->setCaIncoterms($this->ca_incoterms);

		$copyObj->setCaMercanciaDesc($this->ca_mercancia_desc);

		$copyObj->setCaIdproveedor($this->ca_idproveedor);

		$copyObj->setCaOrdenProv($this->ca_orden_prov);

		$copyObj->setCaIdconcliente($this->ca_idconcliente);

		$copyObj->setCaOrdenClie($this->ca_orden_clie);

		$copyObj->setCaConfirmarClie($this->ca_confirmar_clie);

		$copyObj->setCaIdrepresentante($this->ca_idrepresentante);

		$copyObj->setCaInformarRepr($this->ca_informar_repr);

		$copyObj->setCaIdconsignatario($this->ca_idconsignatario);

		$copyObj->setCaInformarCons($this->ca_informar_cons);

		$copyObj->setCaIdnotify($this->ca_idnotify);

		$copyObj->setCaInformarNoti($this->ca_informar_noti);

		$copyObj->setCaNotify($this->ca_notify);

		$copyObj->setCaTransporte($this->ca_transporte);

		$copyObj->setCaModalidad($this->ca_modalidad);

		$copyObj->setCaSeguro($this->ca_seguro);

		$copyObj->setCaLiberacion($this->ca_liberacion);

		$copyObj->setCaTiempocredito($this->ca_tiempocredito);

		$copyObj->setCaPreferenciasClie($this->ca_preferencias_clie);

		$copyObj->setCaInstrucciones($this->ca_instrucciones);

		$copyObj->setCaIdlinea($this->ca_idlinea);

		$copyObj->setCaIdconsignar($this->ca_idconsignar);

		$copyObj->setCaIdconsignarmaster($this->ca_idconsignarmaster);

		$copyObj->setCaIdbodega($this->ca_idbodega);

		$copyObj->setCaMastersame($this->ca_mastersame);

		$copyObj->setCaContinuacion($this->ca_continuacion);

		$copyObj->setCaContinuacionDest($this->ca_continuacion_dest);

		$copyObj->setCaContinuacionConf($this->ca_continuacion_conf);

		$copyObj->setCaEtapaActual($this->ca_etapa_actual);

		$copyObj->setCaLogin($this->ca_login);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);

		$copyObj->setCaFchanulado($this->ca_fchanulado);

		$copyObj->setCaUsuanulado($this->ca_usuanulado);

		$copyObj->setCaFchcerrado($this->ca_fchcerrado);

		$copyObj->setCaUsucerrado($this->ca_usucerrado);

		$copyObj->setCaColmas($this->ca_colmas);

		$copyObj->setCaPropiedades($this->ca_propiedades);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getInoClientesAirs() as $relObj) {
				$copyObj->addInoClientesAir($relObj->copy($deepCopy));
			}

			foreach($this->getRepAvisos() as $relObj) {
				$copyObj->addRepAviso($relObj->copy($deepCopy));
			}

			foreach($this->getRepStatuss() as $relObj) {
				$copyObj->addRepStatus($relObj->copy($deepCopy));
			}

			foreach($this->getRepEquipos() as $relObj) {
				$copyObj->addRepEquipo($relObj->copy($deepCopy));
			}

			foreach($this->getRepGastos() as $relObj) {
				$copyObj->addRepGasto($relObj->copy($deepCopy));
			}

			foreach($this->getRepSeguros() as $relObj) {
				$copyObj->addRepSeguro($relObj->copy($deepCopy));
			}

			foreach($this->getRepCostos() as $relObj) {
				$copyObj->addRepCosto($relObj->copy($deepCopy));
			}

			foreach($this->getRepTarifas() as $relObj) {
				$copyObj->addRepTarifa($relObj->copy($deepCopy));
			}

			foreach($this->getRepAduanas() as $relObj) {
				$copyObj->addRepAduana($relObj->copy($deepCopy));
			}

			foreach($this->getRepExpos() as $relObj) {
				$copyObj->addRepExpo($relObj->copy($deepCopy));
			}

			foreach($this->getInoClientesSeas() as $relObj) {
				$copyObj->addInoClientesSea($relObj->copy($deepCopy));
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setCaIdreporte(NULL); // this is a pkey column, so set to default value

	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     Reporte Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     ReportePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ReportePeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Usuario object.
	 *
	 * @param      Usuario $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setUsuario($v)
	{


		if ($v === null) {
			$this->setCaLogin(NULL);
		} else {
			$this->setCaLogin($v->getCaLogin());
		}


		$this->aUsuario = $v;
	}


	/**
	 * Get the associated Usuario object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Usuario The associated Usuario object.
	 * @throws     PropelException
	 */
	public function getUsuario($con = null)
	{
		if ($this->aUsuario === null && (($this->ca_login !== "" && $this->ca_login !== null))) {
			// include the related Peer class
			$this->aUsuario = UsuarioPeer::retrieveByPK($this->ca_login, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = UsuarioPeer::retrieveByPK($this->ca_login, $con);
			   $obj->addUsuarios($this);
			 */
		}
		return $this->aUsuario;
	}

	/**
	 * Declares an association between this object and a Transportador object.
	 *
	 * @param      Transportador $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setTransportador($v)
	{


		if ($v === null) {
			$this->setCaIdlinea(NULL);
		} else {
			$this->setCaIdlinea($v->getCaIdlinea());
		}


		$this->aTransportador = $v;
	}


	/**
	 * Get the associated Transportador object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Transportador The associated Transportador object.
	 * @throws     PropelException
	 */
	public function getTransportador($con = null)
	{
		if ($this->aTransportador === null && ($this->ca_idlinea !== null)) {
			// include the related Peer class
			$this->aTransportador = TransportadorPeer::retrieveByPK($this->ca_idlinea, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = TransportadorPeer::retrieveByPK($this->ca_idlinea, $con);
			   $obj->addTransportadors($this);
			 */
		}
		return $this->aTransportador;
	}

	/**
	 * Declares an association between this object and a Tercero object.
	 *
	 * @param      Tercero $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setTercero($v)
	{


		if ($v === null) {
			$this->setCaIdproveedor(NULL);
		} else {
			$this->setCaIdproveedor($v->getCaIdtercero());
		}


		$this->aTercero = $v;
	}


	/**
	 * Get the associated Tercero object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Tercero The associated Tercero object.
	 * @throws     PropelException
	 */
	public function getTercero($con = null)
	{
		if ($this->aTercero === null && (($this->ca_idproveedor !== "" && $this->ca_idproveedor !== null))) {
			// include the related Peer class
			$this->aTercero = TerceroPeer::retrieveByPK($this->ca_idproveedor, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = TerceroPeer::retrieveByPK($this->ca_idproveedor, $con);
			   $obj->addTerceros($this);
			 */
		}
		return $this->aTercero;
	}

	/**
	 * Declares an association between this object and a Agente object.
	 *
	 * @param      Agente $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setAgente($v)
	{


		if ($v === null) {
			$this->setCaIdagente(NULL);
		} else {
			$this->setCaIdagente($v->getCaIdagente());
		}


		$this->aAgente = $v;
	}


	/**
	 * Get the associated Agente object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Agente The associated Agente object.
	 * @throws     PropelException
	 */
	public function getAgente($con = null)
	{
		if ($this->aAgente === null && ($this->ca_idagente !== null)) {
			// include the related Peer class
			$this->aAgente = AgentePeer::retrieveByPK($this->ca_idagente, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = AgentePeer::retrieveByPK($this->ca_idagente, $con);
			   $obj->addAgentes($this);
			 */
		}
		return $this->aAgente;
	}

	/**
	 * Temporary storage of collInoClientesAirs to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initInoClientesAirs()
	{
		if ($this->collInoClientesAirs === null) {
			$this->collInoClientesAirs = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Reporte has previously
	 * been saved, it will retrieve related InoClientesAirs from storage.
	 * If this Reporte is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getInoClientesAirs($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesAirs === null) {
			if ($this->isNew()) {
			   $this->collInoClientesAirs = array();
			} else {

				$criteria->add(InoClientesAirPeer::CA_IDREPORTE, $this->getCaIdreporte());

				InoClientesAirPeer::addSelectColumns($criteria);
				$this->collInoClientesAirs = InoClientesAirPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(InoClientesAirPeer::CA_IDREPORTE, $this->getCaIdreporte());

				InoClientesAirPeer::addSelectColumns($criteria);
				if (!isset($this->lastInoClientesAirCriteria) || !$this->lastInoClientesAirCriteria->equals($criteria)) {
					$this->collInoClientesAirs = InoClientesAirPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInoClientesAirCriteria = $criteria;
		return $this->collInoClientesAirs;
	}

	/**
	 * Returns the number of related InoClientesAirs.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countInoClientesAirs($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(InoClientesAirPeer::CA_IDREPORTE, $this->getCaIdreporte());

		return InoClientesAirPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a InoClientesAir object to this object
	 * through the InoClientesAir foreign key attribute
	 *
	 * @param      InoClientesAir $l InoClientesAir
	 * @return     void
	 * @throws     PropelException
	 */
	public function addInoClientesAir(InoClientesAir $l)
	{
		$this->collInoClientesAirs[] = $l;
		$l->setReporte($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Reporte is new, it will return
	 * an empty collection; or if this Reporte has previously
	 * been saved, it will retrieve related InoClientesAirs from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Reporte.
	 */
	public function getInoClientesAirsJoinTercero($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesAirs === null) {
			if ($this->isNew()) {
				$this->collInoClientesAirs = array();
			} else {

				$criteria->add(InoClientesAirPeer::CA_IDREPORTE, $this->getCaIdreporte());

				$this->collInoClientesAirs = InoClientesAirPeer::doSelectJoinTercero($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(InoClientesAirPeer::CA_IDREPORTE, $this->getCaIdreporte());

			if (!isset($this->lastInoClientesAirCriteria) || !$this->lastInoClientesAirCriteria->equals($criteria)) {
				$this->collInoClientesAirs = InoClientesAirPeer::doSelectJoinTercero($criteria, $con);
			}
		}
		$this->lastInoClientesAirCriteria = $criteria;

		return $this->collInoClientesAirs;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Reporte is new, it will return
	 * an empty collection; or if this Reporte has previously
	 * been saved, it will retrieve related InoClientesAirs from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Reporte.
	 */
	public function getInoClientesAirsJoinInoMaestraAir($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesAirs === null) {
			if ($this->isNew()) {
				$this->collInoClientesAirs = array();
			} else {

				$criteria->add(InoClientesAirPeer::CA_IDREPORTE, $this->getCaIdreporte());

				$this->collInoClientesAirs = InoClientesAirPeer::doSelectJoinInoMaestraAir($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(InoClientesAirPeer::CA_IDREPORTE, $this->getCaIdreporte());

			if (!isset($this->lastInoClientesAirCriteria) || !$this->lastInoClientesAirCriteria->equals($criteria)) {
				$this->collInoClientesAirs = InoClientesAirPeer::doSelectJoinInoMaestraAir($criteria, $con);
			}
		}
		$this->lastInoClientesAirCriteria = $criteria;

		return $this->collInoClientesAirs;
	}

	/**
	 * Temporary storage of collRepAvisos to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initRepAvisos()
	{
		if ($this->collRepAvisos === null) {
			$this->collRepAvisos = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Reporte has previously
	 * been saved, it will retrieve related RepAvisos from storage.
	 * If this Reporte is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getRepAvisos($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepAvisos === null) {
			if ($this->isNew()) {
			   $this->collRepAvisos = array();
			} else {

				$criteria->add(RepAvisoPeer::CA_IDREPORTE, $this->getCaIdreporte());

				RepAvisoPeer::addSelectColumns($criteria);
				$this->collRepAvisos = RepAvisoPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RepAvisoPeer::CA_IDREPORTE, $this->getCaIdreporte());

				RepAvisoPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepAvisoCriteria) || !$this->lastRepAvisoCriteria->equals($criteria)) {
					$this->collRepAvisos = RepAvisoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepAvisoCriteria = $criteria;
		return $this->collRepAvisos;
	}

	/**
	 * Returns the number of related RepAvisos.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countRepAvisos($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RepAvisoPeer::CA_IDREPORTE, $this->getCaIdreporte());

		return RepAvisoPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a RepAviso object to this object
	 * through the RepAviso foreign key attribute
	 *
	 * @param      RepAviso $l RepAviso
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRepAviso(RepAviso $l)
	{
		$this->collRepAvisos[] = $l;
		$l->setReporte($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Reporte is new, it will return
	 * an empty collection; or if this Reporte has previously
	 * been saved, it will retrieve related RepAvisos from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Reporte.
	 */
	public function getRepAvisosJoinEmail($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepAvisos === null) {
			if ($this->isNew()) {
				$this->collRepAvisos = array();
			} else {

				$criteria->add(RepAvisoPeer::CA_IDREPORTE, $this->getCaIdreporte());

				$this->collRepAvisos = RepAvisoPeer::doSelectJoinEmail($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RepAvisoPeer::CA_IDREPORTE, $this->getCaIdreporte());

			if (!isset($this->lastRepAvisoCriteria) || !$this->lastRepAvisoCriteria->equals($criteria)) {
				$this->collRepAvisos = RepAvisoPeer::doSelectJoinEmail($criteria, $con);
			}
		}
		$this->lastRepAvisoCriteria = $criteria;

		return $this->collRepAvisos;
	}

	/**
	 * Temporary storage of collRepStatuss to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initRepStatuss()
	{
		if ($this->collRepStatuss === null) {
			$this->collRepStatuss = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Reporte has previously
	 * been saved, it will retrieve related RepStatuss from storage.
	 * If this Reporte is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getRepStatuss($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepStatuss === null) {
			if ($this->isNew()) {
			   $this->collRepStatuss = array();
			} else {

				$criteria->add(RepStatusPeer::CA_IDREPORTE, $this->getCaIdreporte());

				RepStatusPeer::addSelectColumns($criteria);
				$this->collRepStatuss = RepStatusPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RepStatusPeer::CA_IDREPORTE, $this->getCaIdreporte());

				RepStatusPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepStatusCriteria) || !$this->lastRepStatusCriteria->equals($criteria)) {
					$this->collRepStatuss = RepStatusPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepStatusCriteria = $criteria;
		return $this->collRepStatuss;
	}

	/**
	 * Returns the number of related RepStatuss.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countRepStatuss($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RepStatusPeer::CA_IDREPORTE, $this->getCaIdreporte());

		return RepStatusPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a RepStatus object to this object
	 * through the RepStatus foreign key attribute
	 *
	 * @param      RepStatus $l RepStatus
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRepStatus(RepStatus $l)
	{
		$this->collRepStatuss[] = $l;
		$l->setReporte($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Reporte is new, it will return
	 * an empty collection; or if this Reporte has previously
	 * been saved, it will retrieve related RepStatuss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Reporte.
	 */
	public function getRepStatussJoinEmail($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepStatuss === null) {
			if ($this->isNew()) {
				$this->collRepStatuss = array();
			} else {

				$criteria->add(RepStatusPeer::CA_IDREPORTE, $this->getCaIdreporte());

				$this->collRepStatuss = RepStatusPeer::doSelectJoinEmail($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RepStatusPeer::CA_IDREPORTE, $this->getCaIdreporte());

			if (!isset($this->lastRepStatusCriteria) || !$this->lastRepStatusCriteria->equals($criteria)) {
				$this->collRepStatuss = RepStatusPeer::doSelectJoinEmail($criteria, $con);
			}
		}
		$this->lastRepStatusCriteria = $criteria;

		return $this->collRepStatuss;
	}

	/**
	 * Temporary storage of collRepEquipos to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initRepEquipos()
	{
		if ($this->collRepEquipos === null) {
			$this->collRepEquipos = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Reporte has previously
	 * been saved, it will retrieve related RepEquipos from storage.
	 * If this Reporte is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getRepEquipos($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepEquipos === null) {
			if ($this->isNew()) {
			   $this->collRepEquipos = array();
			} else {

				$criteria->add(RepEquipoPeer::CA_IDREPORTE, $this->getCaIdreporte());

				RepEquipoPeer::addSelectColumns($criteria);
				$this->collRepEquipos = RepEquipoPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RepEquipoPeer::CA_IDREPORTE, $this->getCaIdreporte());

				RepEquipoPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepEquipoCriteria) || !$this->lastRepEquipoCriteria->equals($criteria)) {
					$this->collRepEquipos = RepEquipoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepEquipoCriteria = $criteria;
		return $this->collRepEquipos;
	}

	/**
	 * Returns the number of related RepEquipos.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countRepEquipos($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RepEquipoPeer::CA_IDREPORTE, $this->getCaIdreporte());

		return RepEquipoPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a RepEquipo object to this object
	 * through the RepEquipo foreign key attribute
	 *
	 * @param      RepEquipo $l RepEquipo
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRepEquipo(RepEquipo $l)
	{
		$this->collRepEquipos[] = $l;
		$l->setReporte($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Reporte is new, it will return
	 * an empty collection; or if this Reporte has previously
	 * been saved, it will retrieve related RepEquipos from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Reporte.
	 */
	public function getRepEquiposJoinConcepto($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepEquipos === null) {
			if ($this->isNew()) {
				$this->collRepEquipos = array();
			} else {

				$criteria->add(RepEquipoPeer::CA_IDREPORTE, $this->getCaIdreporte());

				$this->collRepEquipos = RepEquipoPeer::doSelectJoinConcepto($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RepEquipoPeer::CA_IDREPORTE, $this->getCaIdreporte());

			if (!isset($this->lastRepEquipoCriteria) || !$this->lastRepEquipoCriteria->equals($criteria)) {
				$this->collRepEquipos = RepEquipoPeer::doSelectJoinConcepto($criteria, $con);
			}
		}
		$this->lastRepEquipoCriteria = $criteria;

		return $this->collRepEquipos;
	}

	/**
	 * Temporary storage of collRepGastos to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initRepGastos()
	{
		if ($this->collRepGastos === null) {
			$this->collRepGastos = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Reporte has previously
	 * been saved, it will retrieve related RepGastos from storage.
	 * If this Reporte is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getRepGastos($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepGastos === null) {
			if ($this->isNew()) {
			   $this->collRepGastos = array();
			} else {

				$criteria->add(RepGastoPeer::CA_IDREPORTE, $this->getCaIdreporte());

				RepGastoPeer::addSelectColumns($criteria);
				$this->collRepGastos = RepGastoPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RepGastoPeer::CA_IDREPORTE, $this->getCaIdreporte());

				RepGastoPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepGastoCriteria) || !$this->lastRepGastoCriteria->equals($criteria)) {
					$this->collRepGastos = RepGastoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepGastoCriteria = $criteria;
		return $this->collRepGastos;
	}

	/**
	 * Returns the number of related RepGastos.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countRepGastos($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RepGastoPeer::CA_IDREPORTE, $this->getCaIdreporte());

		return RepGastoPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a RepGasto object to this object
	 * through the RepGasto foreign key attribute
	 *
	 * @param      RepGasto $l RepGasto
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRepGasto(RepGasto $l)
	{
		$this->collRepGastos[] = $l;
		$l->setReporte($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Reporte is new, it will return
	 * an empty collection; or if this Reporte has previously
	 * been saved, it will retrieve related RepGastos from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Reporte.
	 */
	public function getRepGastosJoinConcepto($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepGastos === null) {
			if ($this->isNew()) {
				$this->collRepGastos = array();
			} else {

				$criteria->add(RepGastoPeer::CA_IDREPORTE, $this->getCaIdreporte());

				$this->collRepGastos = RepGastoPeer::doSelectJoinConcepto($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RepGastoPeer::CA_IDREPORTE, $this->getCaIdreporte());

			if (!isset($this->lastRepGastoCriteria) || !$this->lastRepGastoCriteria->equals($criteria)) {
				$this->collRepGastos = RepGastoPeer::doSelectJoinConcepto($criteria, $con);
			}
		}
		$this->lastRepGastoCriteria = $criteria;

		return $this->collRepGastos;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Reporte is new, it will return
	 * an empty collection; or if this Reporte has previously
	 * been saved, it will retrieve related RepGastos from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Reporte.
	 */
	public function getRepGastosJoinTipoRecargo($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepGastos === null) {
			if ($this->isNew()) {
				$this->collRepGastos = array();
			} else {

				$criteria->add(RepGastoPeer::CA_IDREPORTE, $this->getCaIdreporte());

				$this->collRepGastos = RepGastoPeer::doSelectJoinTipoRecargo($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RepGastoPeer::CA_IDREPORTE, $this->getCaIdreporte());

			if (!isset($this->lastRepGastoCriteria) || !$this->lastRepGastoCriteria->equals($criteria)) {
				$this->collRepGastos = RepGastoPeer::doSelectJoinTipoRecargo($criteria, $con);
			}
		}
		$this->lastRepGastoCriteria = $criteria;

		return $this->collRepGastos;
	}

	/**
	 * Temporary storage of collRepSeguros to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initRepSeguros()
	{
		if ($this->collRepSeguros === null) {
			$this->collRepSeguros = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Reporte has previously
	 * been saved, it will retrieve related RepSeguros from storage.
	 * If this Reporte is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getRepSeguros($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepSeguros === null) {
			if ($this->isNew()) {
			   $this->collRepSeguros = array();
			} else {

				$criteria->add(RepSeguroPeer::CA_IDREPORTE, $this->getCaIdreporte());

				RepSeguroPeer::addSelectColumns($criteria);
				$this->collRepSeguros = RepSeguroPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RepSeguroPeer::CA_IDREPORTE, $this->getCaIdreporte());

				RepSeguroPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepSeguroCriteria) || !$this->lastRepSeguroCriteria->equals($criteria)) {
					$this->collRepSeguros = RepSeguroPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepSeguroCriteria = $criteria;
		return $this->collRepSeguros;
	}

	/**
	 * Returns the number of related RepSeguros.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countRepSeguros($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RepSeguroPeer::CA_IDREPORTE, $this->getCaIdreporte());

		return RepSeguroPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a RepSeguro object to this object
	 * through the RepSeguro foreign key attribute
	 *
	 * @param      RepSeguro $l RepSeguro
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRepSeguro(RepSeguro $l)
	{
		$this->collRepSeguros[] = $l;
		$l->setReporte($this);
	}

	/**
	 * Temporary storage of collRepCostos to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initRepCostos()
	{
		if ($this->collRepCostos === null) {
			$this->collRepCostos = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Reporte has previously
	 * been saved, it will retrieve related RepCostos from storage.
	 * If this Reporte is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getRepCostos($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepCostos === null) {
			if ($this->isNew()) {
			   $this->collRepCostos = array();
			} else {

				$criteria->add(RepCostoPeer::CA_IDREPORTE, $this->getCaIdreporte());

				RepCostoPeer::addSelectColumns($criteria);
				$this->collRepCostos = RepCostoPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RepCostoPeer::CA_IDREPORTE, $this->getCaIdreporte());

				RepCostoPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepCostoCriteria) || !$this->lastRepCostoCriteria->equals($criteria)) {
					$this->collRepCostos = RepCostoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepCostoCriteria = $criteria;
		return $this->collRepCostos;
	}

	/**
	 * Returns the number of related RepCostos.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countRepCostos($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RepCostoPeer::CA_IDREPORTE, $this->getCaIdreporte());

		return RepCostoPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a RepCosto object to this object
	 * through the RepCosto foreign key attribute
	 *
	 * @param      RepCosto $l RepCosto
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRepCosto(RepCosto $l)
	{
		$this->collRepCostos[] = $l;
		$l->setReporte($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Reporte is new, it will return
	 * an empty collection; or if this Reporte has previously
	 * been saved, it will retrieve related RepCostos from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Reporte.
	 */
	public function getRepCostosJoinCosto($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepCostos === null) {
			if ($this->isNew()) {
				$this->collRepCostos = array();
			} else {

				$criteria->add(RepCostoPeer::CA_IDREPORTE, $this->getCaIdreporte());

				$this->collRepCostos = RepCostoPeer::doSelectJoinCosto($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RepCostoPeer::CA_IDREPORTE, $this->getCaIdreporte());

			if (!isset($this->lastRepCostoCriteria) || !$this->lastRepCostoCriteria->equals($criteria)) {
				$this->collRepCostos = RepCostoPeer::doSelectJoinCosto($criteria, $con);
			}
		}
		$this->lastRepCostoCriteria = $criteria;

		return $this->collRepCostos;
	}

	/**
	 * Temporary storage of collRepTarifas to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initRepTarifas()
	{
		if ($this->collRepTarifas === null) {
			$this->collRepTarifas = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Reporte has previously
	 * been saved, it will retrieve related RepTarifas from storage.
	 * If this Reporte is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getRepTarifas($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepTarifas === null) {
			if ($this->isNew()) {
			   $this->collRepTarifas = array();
			} else {

				$criteria->add(RepTarifaPeer::CA_IDREPORTE, $this->getCaIdreporte());

				RepTarifaPeer::addSelectColumns($criteria);
				$this->collRepTarifas = RepTarifaPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RepTarifaPeer::CA_IDREPORTE, $this->getCaIdreporte());

				RepTarifaPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepTarifaCriteria) || !$this->lastRepTarifaCriteria->equals($criteria)) {
					$this->collRepTarifas = RepTarifaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepTarifaCriteria = $criteria;
		return $this->collRepTarifas;
	}

	/**
	 * Returns the number of related RepTarifas.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countRepTarifas($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RepTarifaPeer::CA_IDREPORTE, $this->getCaIdreporte());

		return RepTarifaPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a RepTarifa object to this object
	 * through the RepTarifa foreign key attribute
	 *
	 * @param      RepTarifa $l RepTarifa
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRepTarifa(RepTarifa $l)
	{
		$this->collRepTarifas[] = $l;
		$l->setReporte($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Reporte is new, it will return
	 * an empty collection; or if this Reporte has previously
	 * been saved, it will retrieve related RepTarifas from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Reporte.
	 */
	public function getRepTarifasJoinConcepto($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepTarifas === null) {
			if ($this->isNew()) {
				$this->collRepTarifas = array();
			} else {

				$criteria->add(RepTarifaPeer::CA_IDREPORTE, $this->getCaIdreporte());

				$this->collRepTarifas = RepTarifaPeer::doSelectJoinConcepto($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RepTarifaPeer::CA_IDREPORTE, $this->getCaIdreporte());

			if (!isset($this->lastRepTarifaCriteria) || !$this->lastRepTarifaCriteria->equals($criteria)) {
				$this->collRepTarifas = RepTarifaPeer::doSelectJoinConcepto($criteria, $con);
			}
		}
		$this->lastRepTarifaCriteria = $criteria;

		return $this->collRepTarifas;
	}

	/**
	 * Temporary storage of collRepAduanas to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initRepAduanas()
	{
		if ($this->collRepAduanas === null) {
			$this->collRepAduanas = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Reporte has previously
	 * been saved, it will retrieve related RepAduanas from storage.
	 * If this Reporte is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getRepAduanas($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepAduanas === null) {
			if ($this->isNew()) {
			   $this->collRepAduanas = array();
			} else {

				$criteria->add(RepAduanaPeer::CA_IDREPORTE, $this->getCaIdreporte());

				RepAduanaPeer::addSelectColumns($criteria);
				$this->collRepAduanas = RepAduanaPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RepAduanaPeer::CA_IDREPORTE, $this->getCaIdreporte());

				RepAduanaPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepAduanaCriteria) || !$this->lastRepAduanaCriteria->equals($criteria)) {
					$this->collRepAduanas = RepAduanaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepAduanaCriteria = $criteria;
		return $this->collRepAduanas;
	}

	/**
	 * Returns the number of related RepAduanas.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countRepAduanas($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RepAduanaPeer::CA_IDREPORTE, $this->getCaIdreporte());

		return RepAduanaPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a RepAduana object to this object
	 * through the RepAduana foreign key attribute
	 *
	 * @param      RepAduana $l RepAduana
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRepAduana(RepAduana $l)
	{
		$this->collRepAduanas[] = $l;
		$l->setReporte($this);
	}

	/**
	 * Temporary storage of collRepExpos to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initRepExpos()
	{
		if ($this->collRepExpos === null) {
			$this->collRepExpos = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Reporte has previously
	 * been saved, it will retrieve related RepExpos from storage.
	 * If this Reporte is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getRepExpos($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepExpos === null) {
			if ($this->isNew()) {
			   $this->collRepExpos = array();
			} else {

				$criteria->add(RepExpoPeer::CA_IDREPORTE, $this->getCaIdreporte());

				RepExpoPeer::addSelectColumns($criteria);
				$this->collRepExpos = RepExpoPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RepExpoPeer::CA_IDREPORTE, $this->getCaIdreporte());

				RepExpoPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepExpoCriteria) || !$this->lastRepExpoCriteria->equals($criteria)) {
					$this->collRepExpos = RepExpoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepExpoCriteria = $criteria;
		return $this->collRepExpos;
	}

	/**
	 * Returns the number of related RepExpos.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countRepExpos($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RepExpoPeer::CA_IDREPORTE, $this->getCaIdreporte());

		return RepExpoPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a RepExpo object to this object
	 * through the RepExpo foreign key attribute
	 *
	 * @param      RepExpo $l RepExpo
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRepExpo(RepExpo $l)
	{
		$this->collRepExpos[] = $l;
		$l->setReporte($this);
	}

	/**
	 * Temporary storage of collInoClientesSeas to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initInoClientesSeas()
	{
		if ($this->collInoClientesSeas === null) {
			$this->collInoClientesSeas = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Reporte has previously
	 * been saved, it will retrieve related InoClientesSeas from storage.
	 * If this Reporte is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getInoClientesSeas($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesSeas === null) {
			if ($this->isNew()) {
			   $this->collInoClientesSeas = array();
			} else {

				$criteria->add(InoClientesSeaPeer::CA_IDREPORTE, $this->getCaIdreporte());

				InoClientesSeaPeer::addSelectColumns($criteria);
				$this->collInoClientesSeas = InoClientesSeaPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(InoClientesSeaPeer::CA_IDREPORTE, $this->getCaIdreporte());

				InoClientesSeaPeer::addSelectColumns($criteria);
				if (!isset($this->lastInoClientesSeaCriteria) || !$this->lastInoClientesSeaCriteria->equals($criteria)) {
					$this->collInoClientesSeas = InoClientesSeaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInoClientesSeaCriteria = $criteria;
		return $this->collInoClientesSeas;
	}

	/**
	 * Returns the number of related InoClientesSeas.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countInoClientesSeas($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(InoClientesSeaPeer::CA_IDREPORTE, $this->getCaIdreporte());

		return InoClientesSeaPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a InoClientesSea object to this object
	 * through the InoClientesSea foreign key attribute
	 *
	 * @param      InoClientesSea $l InoClientesSea
	 * @return     void
	 * @throws     PropelException
	 */
	public function addInoClientesSea(InoClientesSea $l)
	{
		$this->collInoClientesSeas[] = $l;
		$l->setReporte($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Reporte is new, it will return
	 * an empty collection; or if this Reporte has previously
	 * been saved, it will retrieve related InoClientesSeas from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Reporte.
	 */
	public function getInoClientesSeasJoinTercero($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesSeas === null) {
			if ($this->isNew()) {
				$this->collInoClientesSeas = array();
			} else {

				$criteria->add(InoClientesSeaPeer::CA_IDREPORTE, $this->getCaIdreporte());

				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinTercero($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(InoClientesSeaPeer::CA_IDREPORTE, $this->getCaIdreporte());

			if (!isset($this->lastInoClientesSeaCriteria) || !$this->lastInoClientesSeaCriteria->equals($criteria)) {
				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinTercero($criteria, $con);
			}
		}
		$this->lastInoClientesSeaCriteria = $criteria;

		return $this->collInoClientesSeas;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Reporte is new, it will return
	 * an empty collection; or if this Reporte has previously
	 * been saved, it will retrieve related InoClientesSeas from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Reporte.
	 */
	public function getInoClientesSeasJoinInoMaestraSea($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesSeas === null) {
			if ($this->isNew()) {
				$this->collInoClientesSeas = array();
			} else {

				$criteria->add(InoClientesSeaPeer::CA_IDREPORTE, $this->getCaIdreporte());

				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinInoMaestraSea($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(InoClientesSeaPeer::CA_IDREPORTE, $this->getCaIdreporte());

			if (!isset($this->lastInoClientesSeaCriteria) || !$this->lastInoClientesSeaCriteria->equals($criteria)) {
				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinInoMaestraSea($criteria, $con);
			}
		}
		$this->lastInoClientesSeaCriteria = $criteria;

		return $this->collInoClientesSeas;
	}

} // BaseReporte
