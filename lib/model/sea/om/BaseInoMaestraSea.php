<?php

/**
 * Base class that represents a row from the 'tb_inomaestra_sea' table.
 *
 * 
 *
 * @package    lib.model.sea.om
 */
abstract class BaseInoMaestraSea extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        InoMaestraSeaPeer
	 */
	protected static $peer;


	/**
	 * The value for the ca_fchreferencia field.
	 * @var        int
	 */
	protected $ca_fchreferencia;


	/**
	 * The value for the ca_referencia field.
	 * @var        string
	 */
	protected $ca_referencia;


	/**
	 * The value for the ca_impoexpo field.
	 * @var        string
	 */
	protected $ca_impoexpo;


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
	 * The value for the ca_fchembarque field.
	 * @var        int
	 */
	protected $ca_fchembarque;


	/**
	 * The value for the ca_fcharribo field.
	 * @var        int
	 */
	protected $ca_fcharribo;


	/**
	 * The value for the ca_modalidad field.
	 * @var        string
	 */
	protected $ca_modalidad;


	/**
	 * The value for the ca_idlinea field.
	 * @var        int
	 */
	protected $ca_idlinea;


	/**
	 * The value for the ca_motonave field.
	 * @var        string
	 */
	protected $ca_motonave;


	/**
	 * The value for the ca_ciclo field.
	 * @var        string
	 */
	protected $ca_ciclo;


	/**
	 * The value for the ca_mbls field.
	 * @var        string
	 */
	protected $ca_mbls;


	/**
	 * The value for the ca_observaciones field.
	 * @var        string
	 */
	protected $ca_observaciones;


	/**
	 * The value for the ca_fchconfirmacion field.
	 * @var        int
	 */
	protected $ca_fchconfirmacion;


	/**
	 * The value for the ca_horaconfirmacion field.
	 * @var        int
	 */
	protected $ca_horaconfirmacion;


	/**
	 * The value for the ca_registroadu field.
	 * @var        string
	 */
	protected $ca_registroadu;


	/**
	 * The value for the ca_registrocap field.
	 * @var        string
	 */
	protected $ca_registrocap;


	/**
	 * The value for the ca_bandera field.
	 * @var        string
	 */
	protected $ca_bandera;


	/**
	 * The value for the ca_fchliberacion field.
	 * @var        int
	 */
	protected $ca_fchliberacion;


	/**
	 * The value for the ca_nroliberacion field.
	 * @var        string
	 */
	protected $ca_nroliberacion;


	/**
	 * The value for the ca_anulado field.
	 * @var        string
	 */
	protected $ca_anulado;


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
	 * The value for the ca_fchliquidado field.
	 * @var        int
	 */
	protected $ca_fchliquidado;


	/**
	 * The value for the ca_usuliquidado field.
	 * @var        string
	 */
	protected $ca_usuliquidado;


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
	 * The value for the ca_mensaje field.
	 * @var        string
	 */
	protected $ca_mensaje;


	/**
	 * The value for the ca_fchdesconsolidacion field.
	 * @var        string
	 */
	protected $ca_fchdesconsolidacion;


	/**
	 * The value for the ca_mnllegada field.
	 * @var        string
	 */
	protected $ca_mnllegada;


	/**
	 * The value for the ca_fchregistroadu field.
	 * @var        string
	 */
	protected $ca_fchregistroadu;


	/**
	 * The value for the ca_fchconfirmado field.
	 * @var        int
	 */
	protected $ca_fchconfirmado;


	/**
	 * The value for the ca_usuconfirmado field.
	 * @var        string
	 */
	protected $ca_usuconfirmado;


	/**
	 * The value for the ca_asunto_otm field.
	 * @var        string
	 */
	protected $ca_asunto_otm;


	/**
	 * The value for the ca_mensaje_otm field.
	 * @var        string
	 */
	protected $ca_mensaje_otm;


	/**
	 * The value for the ca_fchllegada_otm field.
	 * @var        string
	 */
	protected $ca_fchllegada_otm;


	/**
	 * The value for the ca_ciudad_otm field.
	 * @var        string
	 */
	protected $ca_ciudad_otm;


	/**
	 * The value for the ca_fchconfirma_otm field.
	 * @var        int
	 */
	protected $ca_fchconfirma_otm;


	/**
	 * The value for the ca_usuconfirma_otm field.
	 * @var        string
	 */
	protected $ca_usuconfirma_otm;


	/**
	 * The value for the ca_provisional field.
	 * @var        boolean
	 */
	protected $ca_provisional;


	/**
	 * The value for the ca_sitiodevolucion field.
	 * @var        string
	 */
	protected $ca_sitiodevolucion;

	/**
	 * @var        Transportador
	 */
	protected $aTransportador;

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
	 * Collection to store aggregation of collInoIngresosSeas.
	 * @var        array
	 */
	protected $collInoIngresosSeas;

	/**
	 * The criteria used to select the current contents of collInoIngresosSeas.
	 * @var        Criteria
	 */
	protected $lastInoIngresosSeaCriteria = null;

	/**
	 * Collection to store aggregation of collInoAvisosSeas.
	 * @var        array
	 */
	protected $collInoAvisosSeas;

	/**
	 * The criteria used to select the current contents of collInoAvisosSeas.
	 * @var        Criteria
	 */
	protected $lastInoAvisosSeaCriteria = null;

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
	 * Get the [optionally formatted] [ca_fchreferencia] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchreferencia($format = 'Y-m-d')
	{

		if ($this->ca_fchreferencia === null || $this->ca_fchreferencia === '') {
			return null;
		} elseif (!is_int($this->ca_fchreferencia)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_fchreferencia);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_fchreferencia] as date/time value: " . var_export($this->ca_fchreferencia, true));
			}
		} else {
			$ts = $this->ca_fchreferencia;
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
	 * Get the [ca_referencia] column value.
	 * 
	 * @return     string
	 */
	public function getCaReferencia()
	{

		return $this->ca_referencia;
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
	 * Get the [optionally formatted] [ca_fchembarque] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchembarque($format = 'Y-m-d')
	{

		if ($this->ca_fchembarque === null || $this->ca_fchembarque === '') {
			return null;
		} elseif (!is_int($this->ca_fchembarque)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_fchembarque);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_fchembarque] as date/time value: " . var_export($this->ca_fchembarque, true));
			}
		} else {
			$ts = $this->ca_fchembarque;
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
	 * Get the [optionally formatted] [ca_fcharribo] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFcharribo($format = 'Y-m-d')
	{

		if ($this->ca_fcharribo === null || $this->ca_fcharribo === '') {
			return null;
		} elseif (!is_int($this->ca_fcharribo)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_fcharribo);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_fcharribo] as date/time value: " . var_export($this->ca_fcharribo, true));
			}
		} else {
			$ts = $this->ca_fcharribo;
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
	 * Get the [ca_modalidad] column value.
	 * 
	 * @return     string
	 */
	public function getCaModalidad()
	{

		return $this->ca_modalidad;
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
	 * Get the [ca_motonave] column value.
	 * 
	 * @return     string
	 */
	public function getCaMotonave()
	{

		return $this->ca_motonave;
	}

	/**
	 * Get the [ca_ciclo] column value.
	 * 
	 * @return     string
	 */
	public function getCaCiclo()
	{

		return $this->ca_ciclo;
	}

	/**
	 * Get the [ca_mbls] column value.
	 * 
	 * @return     string
	 */
	public function getCaMbls()
	{

		return $this->ca_mbls;
	}

	/**
	 * Get the [ca_observaciones] column value.
	 * 
	 * @return     string
	 */
	public function getCaObservaciones()
	{

		return $this->ca_observaciones;
	}

	/**
	 * Get the [optionally formatted] [ca_fchconfirmacion] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchconfirmacion($format = 'Y-m-d')
	{

		if ($this->ca_fchconfirmacion === null || $this->ca_fchconfirmacion === '') {
			return null;
		} elseif (!is_int($this->ca_fchconfirmacion)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_fchconfirmacion);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_fchconfirmacion] as date/time value: " . var_export($this->ca_fchconfirmacion, true));
			}
		} else {
			$ts = $this->ca_fchconfirmacion;
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
	 * Get the [optionally formatted] [ca_horaconfirmacion] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaHoraconfirmacion($format = 'H:i:s')
	{

		if ($this->ca_horaconfirmacion === null || $this->ca_horaconfirmacion === '') {
			return null;
		} elseif (!is_int($this->ca_horaconfirmacion)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_horaconfirmacion);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_horaconfirmacion] as date/time value: " . var_export($this->ca_horaconfirmacion, true));
			}
		} else {
			$ts = $this->ca_horaconfirmacion;
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
	 * Get the [ca_registroadu] column value.
	 * 
	 * @return     string
	 */
	public function getCaRegistroadu()
	{

		return $this->ca_registroadu;
	}

	/**
	 * Get the [ca_registrocap] column value.
	 * 
	 * @return     string
	 */
	public function getCaRegistrocap()
	{

		return $this->ca_registrocap;
	}

	/**
	 * Get the [ca_bandera] column value.
	 * 
	 * @return     string
	 */
	public function getCaBandera()
	{

		return $this->ca_bandera;
	}

	/**
	 * Get the [optionally formatted] [ca_fchliberacion] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchliberacion($format = 'Y-m-d')
	{

		if ($this->ca_fchliberacion === null || $this->ca_fchliberacion === '') {
			return null;
		} elseif (!is_int($this->ca_fchliberacion)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_fchliberacion);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_fchliberacion] as date/time value: " . var_export($this->ca_fchliberacion, true));
			}
		} else {
			$ts = $this->ca_fchliberacion;
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
	 * Get the [ca_nroliberacion] column value.
	 * 
	 * @return     string
	 */
	public function getCaNroliberacion()
	{

		return $this->ca_nroliberacion;
	}

	/**
	 * Get the [ca_anulado] column value.
	 * 
	 * @return     string
	 */
	public function getCaAnulado()
	{

		return $this->ca_anulado;
	}

	/**
	 * Get the [optionally formatted] [ca_fchcreado] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchcreado($format = 'Y-m-d')
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
	public function getCaFchactualizado($format = 'Y-m-d')
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
	 * Get the [optionally formatted] [ca_fchliquidado] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchliquidado($format = 'Y-m-d')
	{

		if ($this->ca_fchliquidado === null || $this->ca_fchliquidado === '') {
			return null;
		} elseif (!is_int($this->ca_fchliquidado)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_fchliquidado);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_fchliquidado] as date/time value: " . var_export($this->ca_fchliquidado, true));
			}
		} else {
			$ts = $this->ca_fchliquidado;
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
	 * Get the [ca_usuliquidado] column value.
	 * 
	 * @return     string
	 */
	public function getCaUsuliquidado()
	{

		return $this->ca_usuliquidado;
	}

	/**
	 * Get the [optionally formatted] [ca_fchcerrado] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchcerrado($format = 'Y-m-d')
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
	 * Get the [ca_mensaje] column value.
	 * 
	 * @return     string
	 */
	public function getCaMensaje()
	{

		return $this->ca_mensaje;
	}

	/**
	 * Get the [ca_fchdesconsolidacion] column value.
	 * 
	 * @return     string
	 */
	public function getCaFchdesconsolidacion()
	{

		return $this->ca_fchdesconsolidacion;
	}

	/**
	 * Get the [ca_mnllegada] column value.
	 * 
	 * @return     string
	 */
	public function getCaMnllegada()
	{

		return $this->ca_mnllegada;
	}

	/**
	 * Get the [ca_fchregistroadu] column value.
	 * 
	 * @return     string
	 */
	public function getCaFchregistroadu()
	{

		return $this->ca_fchregistroadu;
	}

	/**
	 * Get the [optionally formatted] [ca_fchconfirmado] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchconfirmado($format = 'Y-m-d H:i:s')
	{

		if ($this->ca_fchconfirmado === null || $this->ca_fchconfirmado === '') {
			return null;
		} elseif (!is_int($this->ca_fchconfirmado)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_fchconfirmado);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_fchconfirmado] as date/time value: " . var_export($this->ca_fchconfirmado, true));
			}
		} else {
			$ts = $this->ca_fchconfirmado;
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
	 * Get the [ca_usuconfirmado] column value.
	 * 
	 * @return     string
	 */
	public function getCaUsuconfirmado()
	{

		return $this->ca_usuconfirmado;
	}

	/**
	 * Get the [ca_asunto_otm] column value.
	 * 
	 * @return     string
	 */
	public function getCaAsuntoOtm()
	{

		return $this->ca_asunto_otm;
	}

	/**
	 * Get the [ca_mensaje_otm] column value.
	 * 
	 * @return     string
	 */
	public function getCaMensajeOtm()
	{

		return $this->ca_mensaje_otm;
	}

	/**
	 * Get the [ca_fchllegada_otm] column value.
	 * 
	 * @return     string
	 */
	public function getCaFchllegadaOtm()
	{

		return $this->ca_fchllegada_otm;
	}

	/**
	 * Get the [ca_ciudad_otm] column value.
	 * 
	 * @return     string
	 */
	public function getCaCiudadOtm()
	{

		return $this->ca_ciudad_otm;
	}

	/**
	 * Get the [optionally formatted] [ca_fchconfirma_otm] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchconfirmaOtm($format = 'Y-m-d H:i:s')
	{

		if ($this->ca_fchconfirma_otm === null || $this->ca_fchconfirma_otm === '') {
			return null;
		} elseif (!is_int($this->ca_fchconfirma_otm)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_fchconfirma_otm);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_fchconfirma_otm] as date/time value: " . var_export($this->ca_fchconfirma_otm, true));
			}
		} else {
			$ts = $this->ca_fchconfirma_otm;
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
	 * Get the [ca_usuconfirma_otm] column value.
	 * 
	 * @return     string
	 */
	public function getCaUsuconfirmaOtm()
	{

		return $this->ca_usuconfirma_otm;
	}

	/**
	 * Get the [ca_provisional] column value.
	 * 
	 * @return     boolean
	 */
	public function getCaProvisional()
	{

		return $this->ca_provisional;
	}

	/**
	 * Get the [ca_sitiodevolucion] column value.
	 * 
	 * @return     string
	 */
	public function getCaSitiodevolucion()
	{

		return $this->ca_sitiodevolucion;
	}

	/**
	 * Set the value of [ca_fchreferencia] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaFchreferencia($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_fchreferencia] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_fchreferencia !== $ts) {
			$this->ca_fchreferencia = $ts;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_FCHREFERENCIA;
		}

	} // setCaFchreferencia()

	/**
	 * Set the value of [ca_referencia] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaReferencia($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_referencia !== $v) {
			$this->ca_referencia = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_REFERENCIA;
		}

	} // setCaReferencia()

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
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_IMPOEXPO;
		}

	} // setCaImpoexpo()

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
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_ORIGEN;
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
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_DESTINO;
		}

	} // setCaDestino()

	/**
	 * Set the value of [ca_fchembarque] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaFchembarque($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_fchembarque] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_fchembarque !== $ts) {
			$this->ca_fchembarque = $ts;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_FCHEMBARQUE;
		}

	} // setCaFchembarque()

	/**
	 * Set the value of [ca_fcharribo] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaFcharribo($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_fcharribo] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_fcharribo !== $ts) {
			$this->ca_fcharribo = $ts;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_FCHARRIBO;
		}

	} // setCaFcharribo()

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
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_MODALIDAD;
		}

	} // setCaModalidad()

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
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_IDLINEA;
		}

		if ($this->aTransportador !== null && $this->aTransportador->getCaIdlinea() !== $v) {
			$this->aTransportador = null;
		}

	} // setCaIdlinea()

	/**
	 * Set the value of [ca_motonave] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaMotonave($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_motonave !== $v) {
			$this->ca_motonave = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_MOTONAVE;
		}

	} // setCaMotonave()

	/**
	 * Set the value of [ca_ciclo] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaCiclo($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_ciclo !== $v) {
			$this->ca_ciclo = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_CICLO;
		}

	} // setCaCiclo()

	/**
	 * Set the value of [ca_mbls] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaMbls($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_mbls !== $v) {
			$this->ca_mbls = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_MBLS;
		}

	} // setCaMbls()

	/**
	 * Set the value of [ca_observaciones] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaObservaciones($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_observaciones !== $v) {
			$this->ca_observaciones = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_OBSERVACIONES;
		}

	} // setCaObservaciones()

	/**
	 * Set the value of [ca_fchconfirmacion] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaFchconfirmacion($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_fchconfirmacion] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_fchconfirmacion !== $ts) {
			$this->ca_fchconfirmacion = $ts;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_FCHCONFIRMACION;
		}

	} // setCaFchconfirmacion()

	/**
	 * Set the value of [ca_horaconfirmacion] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaHoraconfirmacion($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_horaconfirmacion] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_horaconfirmacion !== $ts) {
			$this->ca_horaconfirmacion = $ts;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_HORACONFIRMACION;
		}

	} // setCaHoraconfirmacion()

	/**
	 * Set the value of [ca_registroadu] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaRegistroadu($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_registroadu !== $v) {
			$this->ca_registroadu = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_REGISTROADU;
		}

	} // setCaRegistroadu()

	/**
	 * Set the value of [ca_registrocap] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaRegistrocap($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_registrocap !== $v) {
			$this->ca_registrocap = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_REGISTROCAP;
		}

	} // setCaRegistrocap()

	/**
	 * Set the value of [ca_bandera] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaBandera($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_bandera !== $v) {
			$this->ca_bandera = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_BANDERA;
		}

	} // setCaBandera()

	/**
	 * Set the value of [ca_fchliberacion] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaFchliberacion($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_fchliberacion] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_fchliberacion !== $ts) {
			$this->ca_fchliberacion = $ts;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_FCHLIBERACION;
		}

	} // setCaFchliberacion()

	/**
	 * Set the value of [ca_nroliberacion] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaNroliberacion($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_nroliberacion !== $v) {
			$this->ca_nroliberacion = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_NROLIBERACION;
		}

	} // setCaNroliberacion()

	/**
	 * Set the value of [ca_anulado] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaAnulado($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_anulado !== $v) {
			$this->ca_anulado = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_ANULADO;
		}

	} // setCaAnulado()

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
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_USUCREADO;
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
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_FCHACTUALIZADO;
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
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_USUACTUALIZADO;
		}

	} // setCaUsuactualizado()

	/**
	 * Set the value of [ca_fchliquidado] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaFchliquidado($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_fchliquidado] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_fchliquidado !== $ts) {
			$this->ca_fchliquidado = $ts;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_FCHLIQUIDADO;
		}

	} // setCaFchliquidado()

	/**
	 * Set the value of [ca_usuliquidado] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaUsuliquidado($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_usuliquidado !== $v) {
			$this->ca_usuliquidado = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_USULIQUIDADO;
		}

	} // setCaUsuliquidado()

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
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_FCHCERRADO;
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
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_USUCERRADO;
		}

	} // setCaUsucerrado()

	/**
	 * Set the value of [ca_mensaje] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaMensaje($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_mensaje !== $v) {
			$this->ca_mensaje = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_MENSAJE;
		}

	} // setCaMensaje()

	/**
	 * Set the value of [ca_fchdesconsolidacion] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaFchdesconsolidacion($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_fchdesconsolidacion !== $v) {
			$this->ca_fchdesconsolidacion = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_FCHDESCONSOLIDACION;
		}

	} // setCaFchdesconsolidacion()

	/**
	 * Set the value of [ca_mnllegada] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaMnllegada($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_mnllegada !== $v) {
			$this->ca_mnllegada = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_MNLLEGADA;
		}

	} // setCaMnllegada()

	/**
	 * Set the value of [ca_fchregistroadu] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaFchregistroadu($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_fchregistroadu !== $v) {
			$this->ca_fchregistroadu = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_FCHREGISTROADU;
		}

	} // setCaFchregistroadu()

	/**
	 * Set the value of [ca_fchconfirmado] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaFchconfirmado($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_fchconfirmado] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_fchconfirmado !== $ts) {
			$this->ca_fchconfirmado = $ts;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_FCHCONFIRMADO;
		}

	} // setCaFchconfirmado()

	/**
	 * Set the value of [ca_usuconfirmado] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaUsuconfirmado($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_usuconfirmado !== $v) {
			$this->ca_usuconfirmado = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_USUCONFIRMADO;
		}

	} // setCaUsuconfirmado()

	/**
	 * Set the value of [ca_asunto_otm] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaAsuntoOtm($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_asunto_otm !== $v) {
			$this->ca_asunto_otm = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_ASUNTO_OTM;
		}

	} // setCaAsuntoOtm()

	/**
	 * Set the value of [ca_mensaje_otm] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaMensajeOtm($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_mensaje_otm !== $v) {
			$this->ca_mensaje_otm = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_MENSAJE_OTM;
		}

	} // setCaMensajeOtm()

	/**
	 * Set the value of [ca_fchllegada_otm] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaFchllegadaOtm($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_fchllegada_otm !== $v) {
			$this->ca_fchllegada_otm = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_FCHLLEGADA_OTM;
		}

	} // setCaFchllegadaOtm()

	/**
	 * Set the value of [ca_ciudad_otm] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaCiudadOtm($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_ciudad_otm !== $v) {
			$this->ca_ciudad_otm = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_CIUDAD_OTM;
		}

	} // setCaCiudadOtm()

	/**
	 * Set the value of [ca_fchconfirma_otm] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaFchconfirmaOtm($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_fchconfirma_otm] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_fchconfirma_otm !== $ts) {
			$this->ca_fchconfirma_otm = $ts;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_FCHCONFIRMA_OTM;
		}

	} // setCaFchconfirmaOtm()

	/**
	 * Set the value of [ca_usuconfirma_otm] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaUsuconfirmaOtm($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_usuconfirma_otm !== $v) {
			$this->ca_usuconfirma_otm = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_USUCONFIRMA_OTM;
		}

	} // setCaUsuconfirmaOtm()

	/**
	 * Set the value of [ca_provisional] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setCaProvisional($v)
	{

		if ($this->ca_provisional !== $v) {
			$this->ca_provisional = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_PROVISIONAL;
		}

	} // setCaProvisional()

	/**
	 * Set the value of [ca_sitiodevolucion] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaSitiodevolucion($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_sitiodevolucion !== $v) {
			$this->ca_sitiodevolucion = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_SITIODEVOLUCION;
		}

	} // setCaSitiodevolucion()

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

			$this->ca_fchreferencia = $rs->getDate($startcol + 0, null);

			$this->ca_referencia = $rs->getString($startcol + 1);

			$this->ca_impoexpo = $rs->getString($startcol + 2);

			$this->ca_origen = $rs->getString($startcol + 3);

			$this->ca_destino = $rs->getString($startcol + 4);

			$this->ca_fchembarque = $rs->getDate($startcol + 5, null);

			$this->ca_fcharribo = $rs->getDate($startcol + 6, null);

			$this->ca_modalidad = $rs->getString($startcol + 7);

			$this->ca_idlinea = $rs->getInt($startcol + 8);

			$this->ca_motonave = $rs->getString($startcol + 9);

			$this->ca_ciclo = $rs->getString($startcol + 10);

			$this->ca_mbls = $rs->getString($startcol + 11);

			$this->ca_observaciones = $rs->getString($startcol + 12);

			$this->ca_fchconfirmacion = $rs->getDate($startcol + 13, null);

			$this->ca_horaconfirmacion = $rs->getTime($startcol + 14, null);

			$this->ca_registroadu = $rs->getString($startcol + 15);

			$this->ca_registrocap = $rs->getString($startcol + 16);

			$this->ca_bandera = $rs->getString($startcol + 17);

			$this->ca_fchliberacion = $rs->getDate($startcol + 18, null);

			$this->ca_nroliberacion = $rs->getString($startcol + 19);

			$this->ca_anulado = $rs->getString($startcol + 20);

			$this->ca_fchcreado = $rs->getDate($startcol + 21, null);

			$this->ca_usucreado = $rs->getString($startcol + 22);

			$this->ca_fchactualizado = $rs->getDate($startcol + 23, null);

			$this->ca_usuactualizado = $rs->getString($startcol + 24);

			$this->ca_fchliquidado = $rs->getDate($startcol + 25, null);

			$this->ca_usuliquidado = $rs->getString($startcol + 26);

			$this->ca_fchcerrado = $rs->getDate($startcol + 27, null);

			$this->ca_usucerrado = $rs->getString($startcol + 28);

			$this->ca_mensaje = $rs->getString($startcol + 29);

			$this->ca_fchdesconsolidacion = $rs->getString($startcol + 30);

			$this->ca_mnllegada = $rs->getString($startcol + 31);

			$this->ca_fchregistroadu = $rs->getString($startcol + 32);

			$this->ca_fchconfirmado = $rs->getTimestamp($startcol + 33, null);

			$this->ca_usuconfirmado = $rs->getString($startcol + 34);

			$this->ca_asunto_otm = $rs->getString($startcol + 35);

			$this->ca_mensaje_otm = $rs->getString($startcol + 36);

			$this->ca_fchllegada_otm = $rs->getString($startcol + 37);

			$this->ca_ciudad_otm = $rs->getString($startcol + 38);

			$this->ca_fchconfirma_otm = $rs->getTimestamp($startcol + 39, null);

			$this->ca_usuconfirma_otm = $rs->getString($startcol + 40);

			$this->ca_provisional = $rs->getBoolean($startcol + 41);

			$this->ca_sitiodevolucion = $rs->getString($startcol + 42);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 43; // 43 = InoMaestraSeaPeer::NUM_COLUMNS - InoMaestraSeaPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating InoMaestraSea object", $e);
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
			$con = Propel::getConnection(InoMaestraSeaPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			InoMaestraSeaPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(InoMaestraSeaPeer::DATABASE_NAME);
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

			if ($this->aTransportador !== null) {
				if ($this->aTransportador->isModified()) {
					$affectedRows += $this->aTransportador->save($con);
				}
				$this->setTransportador($this->aTransportador);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = InoMaestraSeaPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += InoMaestraSeaPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collInoClientesSeas !== null) {
				foreach($this->collInoClientesSeas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collInoIngresosSeas !== null) {
				foreach($this->collInoIngresosSeas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collInoAvisosSeas !== null) {
				foreach($this->collInoAvisosSeas as $referrerFK) {
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

			if ($this->aTransportador !== null) {
				if (!$this->aTransportador->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTransportador->getValidationFailures());
				}
			}


			if (($retval = InoMaestraSeaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collInoClientesSeas !== null) {
					foreach($this->collInoClientesSeas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collInoIngresosSeas !== null) {
					foreach($this->collInoIngresosSeas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collInoAvisosSeas !== null) {
					foreach($this->collInoAvisosSeas as $referrerFK) {
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
		$pos = InoMaestraSeaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaFchreferencia();
				break;
			case 1:
				return $this->getCaReferencia();
				break;
			case 2:
				return $this->getCaImpoexpo();
				break;
			case 3:
				return $this->getCaOrigen();
				break;
			case 4:
				return $this->getCaDestino();
				break;
			case 5:
				return $this->getCaFchembarque();
				break;
			case 6:
				return $this->getCaFcharribo();
				break;
			case 7:
				return $this->getCaModalidad();
				break;
			case 8:
				return $this->getCaIdlinea();
				break;
			case 9:
				return $this->getCaMotonave();
				break;
			case 10:
				return $this->getCaCiclo();
				break;
			case 11:
				return $this->getCaMbls();
				break;
			case 12:
				return $this->getCaObservaciones();
				break;
			case 13:
				return $this->getCaFchconfirmacion();
				break;
			case 14:
				return $this->getCaHoraconfirmacion();
				break;
			case 15:
				return $this->getCaRegistroadu();
				break;
			case 16:
				return $this->getCaRegistrocap();
				break;
			case 17:
				return $this->getCaBandera();
				break;
			case 18:
				return $this->getCaFchliberacion();
				break;
			case 19:
				return $this->getCaNroliberacion();
				break;
			case 20:
				return $this->getCaAnulado();
				break;
			case 21:
				return $this->getCaFchcreado();
				break;
			case 22:
				return $this->getCaUsucreado();
				break;
			case 23:
				return $this->getCaFchactualizado();
				break;
			case 24:
				return $this->getCaUsuactualizado();
				break;
			case 25:
				return $this->getCaFchliquidado();
				break;
			case 26:
				return $this->getCaUsuliquidado();
				break;
			case 27:
				return $this->getCaFchcerrado();
				break;
			case 28:
				return $this->getCaUsucerrado();
				break;
			case 29:
				return $this->getCaMensaje();
				break;
			case 30:
				return $this->getCaFchdesconsolidacion();
				break;
			case 31:
				return $this->getCaMnllegada();
				break;
			case 32:
				return $this->getCaFchregistroadu();
				break;
			case 33:
				return $this->getCaFchconfirmado();
				break;
			case 34:
				return $this->getCaUsuconfirmado();
				break;
			case 35:
				return $this->getCaAsuntoOtm();
				break;
			case 36:
				return $this->getCaMensajeOtm();
				break;
			case 37:
				return $this->getCaFchllegadaOtm();
				break;
			case 38:
				return $this->getCaCiudadOtm();
				break;
			case 39:
				return $this->getCaFchconfirmaOtm();
				break;
			case 40:
				return $this->getCaUsuconfirmaOtm();
				break;
			case 41:
				return $this->getCaProvisional();
				break;
			case 42:
				return $this->getCaSitiodevolucion();
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
		$keys = InoMaestraSeaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaFchreferencia(),
			$keys[1] => $this->getCaReferencia(),
			$keys[2] => $this->getCaImpoexpo(),
			$keys[3] => $this->getCaOrigen(),
			$keys[4] => $this->getCaDestino(),
			$keys[5] => $this->getCaFchembarque(),
			$keys[6] => $this->getCaFcharribo(),
			$keys[7] => $this->getCaModalidad(),
			$keys[8] => $this->getCaIdlinea(),
			$keys[9] => $this->getCaMotonave(),
			$keys[10] => $this->getCaCiclo(),
			$keys[11] => $this->getCaMbls(),
			$keys[12] => $this->getCaObservaciones(),
			$keys[13] => $this->getCaFchconfirmacion(),
			$keys[14] => $this->getCaHoraconfirmacion(),
			$keys[15] => $this->getCaRegistroadu(),
			$keys[16] => $this->getCaRegistrocap(),
			$keys[17] => $this->getCaBandera(),
			$keys[18] => $this->getCaFchliberacion(),
			$keys[19] => $this->getCaNroliberacion(),
			$keys[20] => $this->getCaAnulado(),
			$keys[21] => $this->getCaFchcreado(),
			$keys[22] => $this->getCaUsucreado(),
			$keys[23] => $this->getCaFchactualizado(),
			$keys[24] => $this->getCaUsuactualizado(),
			$keys[25] => $this->getCaFchliquidado(),
			$keys[26] => $this->getCaUsuliquidado(),
			$keys[27] => $this->getCaFchcerrado(),
			$keys[28] => $this->getCaUsucerrado(),
			$keys[29] => $this->getCaMensaje(),
			$keys[30] => $this->getCaFchdesconsolidacion(),
			$keys[31] => $this->getCaMnllegada(),
			$keys[32] => $this->getCaFchregistroadu(),
			$keys[33] => $this->getCaFchconfirmado(),
			$keys[34] => $this->getCaUsuconfirmado(),
			$keys[35] => $this->getCaAsuntoOtm(),
			$keys[36] => $this->getCaMensajeOtm(),
			$keys[37] => $this->getCaFchllegadaOtm(),
			$keys[38] => $this->getCaCiudadOtm(),
			$keys[39] => $this->getCaFchconfirmaOtm(),
			$keys[40] => $this->getCaUsuconfirmaOtm(),
			$keys[41] => $this->getCaProvisional(),
			$keys[42] => $this->getCaSitiodevolucion(),
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
		$pos = InoMaestraSeaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaFchreferencia($value);
				break;
			case 1:
				$this->setCaReferencia($value);
				break;
			case 2:
				$this->setCaImpoexpo($value);
				break;
			case 3:
				$this->setCaOrigen($value);
				break;
			case 4:
				$this->setCaDestino($value);
				break;
			case 5:
				$this->setCaFchembarque($value);
				break;
			case 6:
				$this->setCaFcharribo($value);
				break;
			case 7:
				$this->setCaModalidad($value);
				break;
			case 8:
				$this->setCaIdlinea($value);
				break;
			case 9:
				$this->setCaMotonave($value);
				break;
			case 10:
				$this->setCaCiclo($value);
				break;
			case 11:
				$this->setCaMbls($value);
				break;
			case 12:
				$this->setCaObservaciones($value);
				break;
			case 13:
				$this->setCaFchconfirmacion($value);
				break;
			case 14:
				$this->setCaHoraconfirmacion($value);
				break;
			case 15:
				$this->setCaRegistroadu($value);
				break;
			case 16:
				$this->setCaRegistrocap($value);
				break;
			case 17:
				$this->setCaBandera($value);
				break;
			case 18:
				$this->setCaFchliberacion($value);
				break;
			case 19:
				$this->setCaNroliberacion($value);
				break;
			case 20:
				$this->setCaAnulado($value);
				break;
			case 21:
				$this->setCaFchcreado($value);
				break;
			case 22:
				$this->setCaUsucreado($value);
				break;
			case 23:
				$this->setCaFchactualizado($value);
				break;
			case 24:
				$this->setCaUsuactualizado($value);
				break;
			case 25:
				$this->setCaFchliquidado($value);
				break;
			case 26:
				$this->setCaUsuliquidado($value);
				break;
			case 27:
				$this->setCaFchcerrado($value);
				break;
			case 28:
				$this->setCaUsucerrado($value);
				break;
			case 29:
				$this->setCaMensaje($value);
				break;
			case 30:
				$this->setCaFchdesconsolidacion($value);
				break;
			case 31:
				$this->setCaMnllegada($value);
				break;
			case 32:
				$this->setCaFchregistroadu($value);
				break;
			case 33:
				$this->setCaFchconfirmado($value);
				break;
			case 34:
				$this->setCaUsuconfirmado($value);
				break;
			case 35:
				$this->setCaAsuntoOtm($value);
				break;
			case 36:
				$this->setCaMensajeOtm($value);
				break;
			case 37:
				$this->setCaFchllegadaOtm($value);
				break;
			case 38:
				$this->setCaCiudadOtm($value);
				break;
			case 39:
				$this->setCaFchconfirmaOtm($value);
				break;
			case 40:
				$this->setCaUsuconfirmaOtm($value);
				break;
			case 41:
				$this->setCaProvisional($value);
				break;
			case 42:
				$this->setCaSitiodevolucion($value);
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
		$keys = InoMaestraSeaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaFchreferencia($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaReferencia($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaImpoexpo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaOrigen($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaDestino($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaFchembarque($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaFcharribo($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaModalidad($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaIdlinea($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaMotonave($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaCiclo($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaMbls($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaObservaciones($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaFchconfirmacion($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaHoraconfirmacion($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaRegistroadu($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCaRegistrocap($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setCaBandera($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setCaFchliberacion($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setCaNroliberacion($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setCaAnulado($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setCaFchcreado($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setCaUsucreado($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setCaFchactualizado($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setCaUsuactualizado($arr[$keys[24]]);
		if (array_key_exists($keys[25], $arr)) $this->setCaFchliquidado($arr[$keys[25]]);
		if (array_key_exists($keys[26], $arr)) $this->setCaUsuliquidado($arr[$keys[26]]);
		if (array_key_exists($keys[27], $arr)) $this->setCaFchcerrado($arr[$keys[27]]);
		if (array_key_exists($keys[28], $arr)) $this->setCaUsucerrado($arr[$keys[28]]);
		if (array_key_exists($keys[29], $arr)) $this->setCaMensaje($arr[$keys[29]]);
		if (array_key_exists($keys[30], $arr)) $this->setCaFchdesconsolidacion($arr[$keys[30]]);
		if (array_key_exists($keys[31], $arr)) $this->setCaMnllegada($arr[$keys[31]]);
		if (array_key_exists($keys[32], $arr)) $this->setCaFchregistroadu($arr[$keys[32]]);
		if (array_key_exists($keys[33], $arr)) $this->setCaFchconfirmado($arr[$keys[33]]);
		if (array_key_exists($keys[34], $arr)) $this->setCaUsuconfirmado($arr[$keys[34]]);
		if (array_key_exists($keys[35], $arr)) $this->setCaAsuntoOtm($arr[$keys[35]]);
		if (array_key_exists($keys[36], $arr)) $this->setCaMensajeOtm($arr[$keys[36]]);
		if (array_key_exists($keys[37], $arr)) $this->setCaFchllegadaOtm($arr[$keys[37]]);
		if (array_key_exists($keys[38], $arr)) $this->setCaCiudadOtm($arr[$keys[38]]);
		if (array_key_exists($keys[39], $arr)) $this->setCaFchconfirmaOtm($arr[$keys[39]]);
		if (array_key_exists($keys[40], $arr)) $this->setCaUsuconfirmaOtm($arr[$keys[40]]);
		if (array_key_exists($keys[41], $arr)) $this->setCaProvisional($arr[$keys[41]]);
		if (array_key_exists($keys[42], $arr)) $this->setCaSitiodevolucion($arr[$keys[42]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(InoMaestraSeaPeer::DATABASE_NAME);

		if ($this->isColumnModified(InoMaestraSeaPeer::CA_FCHREFERENCIA)) $criteria->add(InoMaestraSeaPeer::CA_FCHREFERENCIA, $this->ca_fchreferencia);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_REFERENCIA)) $criteria->add(InoMaestraSeaPeer::CA_REFERENCIA, $this->ca_referencia);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_IMPOEXPO)) $criteria->add(InoMaestraSeaPeer::CA_IMPOEXPO, $this->ca_impoexpo);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_ORIGEN)) $criteria->add(InoMaestraSeaPeer::CA_ORIGEN, $this->ca_origen);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_DESTINO)) $criteria->add(InoMaestraSeaPeer::CA_DESTINO, $this->ca_destino);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_FCHEMBARQUE)) $criteria->add(InoMaestraSeaPeer::CA_FCHEMBARQUE, $this->ca_fchembarque);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_FCHARRIBO)) $criteria->add(InoMaestraSeaPeer::CA_FCHARRIBO, $this->ca_fcharribo);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_MODALIDAD)) $criteria->add(InoMaestraSeaPeer::CA_MODALIDAD, $this->ca_modalidad);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_IDLINEA)) $criteria->add(InoMaestraSeaPeer::CA_IDLINEA, $this->ca_idlinea);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_MOTONAVE)) $criteria->add(InoMaestraSeaPeer::CA_MOTONAVE, $this->ca_motonave);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_CICLO)) $criteria->add(InoMaestraSeaPeer::CA_CICLO, $this->ca_ciclo);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_MBLS)) $criteria->add(InoMaestraSeaPeer::CA_MBLS, $this->ca_mbls);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_OBSERVACIONES)) $criteria->add(InoMaestraSeaPeer::CA_OBSERVACIONES, $this->ca_observaciones);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_FCHCONFIRMACION)) $criteria->add(InoMaestraSeaPeer::CA_FCHCONFIRMACION, $this->ca_fchconfirmacion);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_HORACONFIRMACION)) $criteria->add(InoMaestraSeaPeer::CA_HORACONFIRMACION, $this->ca_horaconfirmacion);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_REGISTROADU)) $criteria->add(InoMaestraSeaPeer::CA_REGISTROADU, $this->ca_registroadu);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_REGISTROCAP)) $criteria->add(InoMaestraSeaPeer::CA_REGISTROCAP, $this->ca_registrocap);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_BANDERA)) $criteria->add(InoMaestraSeaPeer::CA_BANDERA, $this->ca_bandera);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_FCHLIBERACION)) $criteria->add(InoMaestraSeaPeer::CA_FCHLIBERACION, $this->ca_fchliberacion);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_NROLIBERACION)) $criteria->add(InoMaestraSeaPeer::CA_NROLIBERACION, $this->ca_nroliberacion);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_ANULADO)) $criteria->add(InoMaestraSeaPeer::CA_ANULADO, $this->ca_anulado);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_FCHCREADO)) $criteria->add(InoMaestraSeaPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_USUCREADO)) $criteria->add(InoMaestraSeaPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_FCHACTUALIZADO)) $criteria->add(InoMaestraSeaPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_USUACTUALIZADO)) $criteria->add(InoMaestraSeaPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_FCHLIQUIDADO)) $criteria->add(InoMaestraSeaPeer::CA_FCHLIQUIDADO, $this->ca_fchliquidado);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_USULIQUIDADO)) $criteria->add(InoMaestraSeaPeer::CA_USULIQUIDADO, $this->ca_usuliquidado);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_FCHCERRADO)) $criteria->add(InoMaestraSeaPeer::CA_FCHCERRADO, $this->ca_fchcerrado);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_USUCERRADO)) $criteria->add(InoMaestraSeaPeer::CA_USUCERRADO, $this->ca_usucerrado);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_MENSAJE)) $criteria->add(InoMaestraSeaPeer::CA_MENSAJE, $this->ca_mensaje);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_FCHDESCONSOLIDACION)) $criteria->add(InoMaestraSeaPeer::CA_FCHDESCONSOLIDACION, $this->ca_fchdesconsolidacion);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_MNLLEGADA)) $criteria->add(InoMaestraSeaPeer::CA_MNLLEGADA, $this->ca_mnllegada);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_FCHREGISTROADU)) $criteria->add(InoMaestraSeaPeer::CA_FCHREGISTROADU, $this->ca_fchregistroadu);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_FCHCONFIRMADO)) $criteria->add(InoMaestraSeaPeer::CA_FCHCONFIRMADO, $this->ca_fchconfirmado);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_USUCONFIRMADO)) $criteria->add(InoMaestraSeaPeer::CA_USUCONFIRMADO, $this->ca_usuconfirmado);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_ASUNTO_OTM)) $criteria->add(InoMaestraSeaPeer::CA_ASUNTO_OTM, $this->ca_asunto_otm);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_MENSAJE_OTM)) $criteria->add(InoMaestraSeaPeer::CA_MENSAJE_OTM, $this->ca_mensaje_otm);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_FCHLLEGADA_OTM)) $criteria->add(InoMaestraSeaPeer::CA_FCHLLEGADA_OTM, $this->ca_fchllegada_otm);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_CIUDAD_OTM)) $criteria->add(InoMaestraSeaPeer::CA_CIUDAD_OTM, $this->ca_ciudad_otm);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_FCHCONFIRMA_OTM)) $criteria->add(InoMaestraSeaPeer::CA_FCHCONFIRMA_OTM, $this->ca_fchconfirma_otm);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_USUCONFIRMA_OTM)) $criteria->add(InoMaestraSeaPeer::CA_USUCONFIRMA_OTM, $this->ca_usuconfirma_otm);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_PROVISIONAL)) $criteria->add(InoMaestraSeaPeer::CA_PROVISIONAL, $this->ca_provisional);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_SITIODEVOLUCION)) $criteria->add(InoMaestraSeaPeer::CA_SITIODEVOLUCION, $this->ca_sitiodevolucion);

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
		$criteria = new Criteria(InoMaestraSeaPeer::DATABASE_NAME);

		$criteria->add(InoMaestraSeaPeer::CA_REFERENCIA, $this->ca_referencia);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     string
	 */
	public function getPrimaryKey()
	{
		return $this->getCaReferencia();
	}

	/**
	 * Generic method to set the primary key (ca_referencia column).
	 *
	 * @param      string $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaReferencia($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of InoMaestraSea (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaFchreferencia($this->ca_fchreferencia);

		$copyObj->setCaImpoexpo($this->ca_impoexpo);

		$copyObj->setCaOrigen($this->ca_origen);

		$copyObj->setCaDestino($this->ca_destino);

		$copyObj->setCaFchembarque($this->ca_fchembarque);

		$copyObj->setCaFcharribo($this->ca_fcharribo);

		$copyObj->setCaModalidad($this->ca_modalidad);

		$copyObj->setCaIdlinea($this->ca_idlinea);

		$copyObj->setCaMotonave($this->ca_motonave);

		$copyObj->setCaCiclo($this->ca_ciclo);

		$copyObj->setCaMbls($this->ca_mbls);

		$copyObj->setCaObservaciones($this->ca_observaciones);

		$copyObj->setCaFchconfirmacion($this->ca_fchconfirmacion);

		$copyObj->setCaHoraconfirmacion($this->ca_horaconfirmacion);

		$copyObj->setCaRegistroadu($this->ca_registroadu);

		$copyObj->setCaRegistrocap($this->ca_registrocap);

		$copyObj->setCaBandera($this->ca_bandera);

		$copyObj->setCaFchliberacion($this->ca_fchliberacion);

		$copyObj->setCaNroliberacion($this->ca_nroliberacion);

		$copyObj->setCaAnulado($this->ca_anulado);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);

		$copyObj->setCaFchliquidado($this->ca_fchliquidado);

		$copyObj->setCaUsuliquidado($this->ca_usuliquidado);

		$copyObj->setCaFchcerrado($this->ca_fchcerrado);

		$copyObj->setCaUsucerrado($this->ca_usucerrado);

		$copyObj->setCaMensaje($this->ca_mensaje);

		$copyObj->setCaFchdesconsolidacion($this->ca_fchdesconsolidacion);

		$copyObj->setCaMnllegada($this->ca_mnllegada);

		$copyObj->setCaFchregistroadu($this->ca_fchregistroadu);

		$copyObj->setCaFchconfirmado($this->ca_fchconfirmado);

		$copyObj->setCaUsuconfirmado($this->ca_usuconfirmado);

		$copyObj->setCaAsuntoOtm($this->ca_asunto_otm);

		$copyObj->setCaMensajeOtm($this->ca_mensaje_otm);

		$copyObj->setCaFchllegadaOtm($this->ca_fchllegada_otm);

		$copyObj->setCaCiudadOtm($this->ca_ciudad_otm);

		$copyObj->setCaFchconfirmaOtm($this->ca_fchconfirma_otm);

		$copyObj->setCaUsuconfirmaOtm($this->ca_usuconfirma_otm);

		$copyObj->setCaProvisional($this->ca_provisional);

		$copyObj->setCaSitiodevolucion($this->ca_sitiodevolucion);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getInoClientesSeas() as $relObj) {
				$copyObj->addInoClientesSea($relObj->copy($deepCopy));
			}

			foreach($this->getInoIngresosSeas() as $relObj) {
				$copyObj->addInoIngresosSea($relObj->copy($deepCopy));
			}

			foreach($this->getInoAvisosSeas() as $relObj) {
				$copyObj->addInoAvisosSea($relObj->copy($deepCopy));
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setCaReferencia(NULL); // this is a pkey column, so set to default value

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
	 * @return     InoMaestraSea Clone of current object.
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
	 * @return     InoMaestraSeaPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new InoMaestraSeaPeer();
		}
		return self::$peer;
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
	 * Otherwise if this InoMaestraSea has previously
	 * been saved, it will retrieve related InoClientesSeas from storage.
	 * If this InoMaestraSea is new, it will return
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

				$criteria->add(InoClientesSeaPeer::CA_REFERENCIA, $this->getCaReferencia());

				InoClientesSeaPeer::addSelectColumns($criteria);
				$this->collInoClientesSeas = InoClientesSeaPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(InoClientesSeaPeer::CA_REFERENCIA, $this->getCaReferencia());

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

		$criteria->add(InoClientesSeaPeer::CA_REFERENCIA, $this->getCaReferencia());

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
		$l->setInoMaestraSea($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this InoMaestraSea is new, it will return
	 * an empty collection; or if this InoMaestraSea has previously
	 * been saved, it will retrieve related InoClientesSeas from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in InoMaestraSea.
	 */
	public function getInoClientesSeasJoinReporte($criteria = null, $con = null)
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

				$criteria->add(InoClientesSeaPeer::CA_REFERENCIA, $this->getCaReferencia());

				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinReporte($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(InoClientesSeaPeer::CA_REFERENCIA, $this->getCaReferencia());

			if (!isset($this->lastInoClientesSeaCriteria) || !$this->lastInoClientesSeaCriteria->equals($criteria)) {
				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinReporte($criteria, $con);
			}
		}
		$this->lastInoClientesSeaCriteria = $criteria;

		return $this->collInoClientesSeas;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this InoMaestraSea is new, it will return
	 * an empty collection; or if this InoMaestraSea has previously
	 * been saved, it will retrieve related InoClientesSeas from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in InoMaestraSea.
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

				$criteria->add(InoClientesSeaPeer::CA_REFERENCIA, $this->getCaReferencia());

				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinTercero($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(InoClientesSeaPeer::CA_REFERENCIA, $this->getCaReferencia());

			if (!isset($this->lastInoClientesSeaCriteria) || !$this->lastInoClientesSeaCriteria->equals($criteria)) {
				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinTercero($criteria, $con);
			}
		}
		$this->lastInoClientesSeaCriteria = $criteria;

		return $this->collInoClientesSeas;
	}

	/**
	 * Temporary storage of collInoIngresosSeas to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initInoIngresosSeas()
	{
		if ($this->collInoIngresosSeas === null) {
			$this->collInoIngresosSeas = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this InoMaestraSea has previously
	 * been saved, it will retrieve related InoIngresosSeas from storage.
	 * If this InoMaestraSea is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getInoIngresosSeas($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoIngresosSeas === null) {
			if ($this->isNew()) {
			   $this->collInoIngresosSeas = array();
			} else {

				$criteria->add(InoIngresosSeaPeer::CA_REFERENCIA, $this->getCaReferencia());

				InoIngresosSeaPeer::addSelectColumns($criteria);
				$this->collInoIngresosSeas = InoIngresosSeaPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(InoIngresosSeaPeer::CA_REFERENCIA, $this->getCaReferencia());

				InoIngresosSeaPeer::addSelectColumns($criteria);
				if (!isset($this->lastInoIngresosSeaCriteria) || !$this->lastInoIngresosSeaCriteria->equals($criteria)) {
					$this->collInoIngresosSeas = InoIngresosSeaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInoIngresosSeaCriteria = $criteria;
		return $this->collInoIngresosSeas;
	}

	/**
	 * Returns the number of related InoIngresosSeas.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countInoIngresosSeas($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(InoIngresosSeaPeer::CA_REFERENCIA, $this->getCaReferencia());

		return InoIngresosSeaPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a InoIngresosSea object to this object
	 * through the InoIngresosSea foreign key attribute
	 *
	 * @param      InoIngresosSea $l InoIngresosSea
	 * @return     void
	 * @throws     PropelException
	 */
	public function addInoIngresosSea(InoIngresosSea $l)
	{
		$this->collInoIngresosSeas[] = $l;
		$l->setInoMaestraSea($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this InoMaestraSea is new, it will return
	 * an empty collection; or if this InoMaestraSea has previously
	 * been saved, it will retrieve related InoIngresosSeas from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in InoMaestraSea.
	 */
	public function getInoIngresosSeasJoinCliente($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoIngresosSeas === null) {
			if ($this->isNew()) {
				$this->collInoIngresosSeas = array();
			} else {

				$criteria->add(InoIngresosSeaPeer::CA_REFERENCIA, $this->getCaReferencia());

				$this->collInoIngresosSeas = InoIngresosSeaPeer::doSelectJoinCliente($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(InoIngresosSeaPeer::CA_REFERENCIA, $this->getCaReferencia());

			if (!isset($this->lastInoIngresosSeaCriteria) || !$this->lastInoIngresosSeaCriteria->equals($criteria)) {
				$this->collInoIngresosSeas = InoIngresosSeaPeer::doSelectJoinCliente($criteria, $con);
			}
		}
		$this->lastInoIngresosSeaCriteria = $criteria;

		return $this->collInoIngresosSeas;
	}

	/**
	 * Temporary storage of collInoAvisosSeas to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initInoAvisosSeas()
	{
		if ($this->collInoAvisosSeas === null) {
			$this->collInoAvisosSeas = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this InoMaestraSea has previously
	 * been saved, it will retrieve related InoAvisosSeas from storage.
	 * If this InoMaestraSea is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getInoAvisosSeas($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoAvisosSeas === null) {
			if ($this->isNew()) {
			   $this->collInoAvisosSeas = array();
			} else {

				$criteria->add(InoAvisosSeaPeer::CA_REFERENCIA, $this->getCaReferencia());

				InoAvisosSeaPeer::addSelectColumns($criteria);
				$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(InoAvisosSeaPeer::CA_REFERENCIA, $this->getCaReferencia());

				InoAvisosSeaPeer::addSelectColumns($criteria);
				if (!isset($this->lastInoAvisosSeaCriteria) || !$this->lastInoAvisosSeaCriteria->equals($criteria)) {
					$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInoAvisosSeaCriteria = $criteria;
		return $this->collInoAvisosSeas;
	}

	/**
	 * Returns the number of related InoAvisosSeas.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countInoAvisosSeas($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(InoAvisosSeaPeer::CA_REFERENCIA, $this->getCaReferencia());

		return InoAvisosSeaPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a InoAvisosSea object to this object
	 * through the InoAvisosSea foreign key attribute
	 *
	 * @param      InoAvisosSea $l InoAvisosSea
	 * @return     void
	 * @throws     PropelException
	 */
	public function addInoAvisosSea(InoAvisosSea $l)
	{
		$this->collInoAvisosSeas[] = $l;
		$l->setInoMaestraSea($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this InoMaestraSea is new, it will return
	 * an empty collection; or if this InoMaestraSea has previously
	 * been saved, it will retrieve related InoAvisosSeas from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in InoMaestraSea.
	 */
	public function getInoAvisosSeasJoinCliente($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoAvisosSeas === null) {
			if ($this->isNew()) {
				$this->collInoAvisosSeas = array();
			} else {

				$criteria->add(InoAvisosSeaPeer::CA_REFERENCIA, $this->getCaReferencia());

				$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelectJoinCliente($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(InoAvisosSeaPeer::CA_REFERENCIA, $this->getCaReferencia());

			if (!isset($this->lastInoAvisosSeaCriteria) || !$this->lastInoAvisosSeaCriteria->equals($criteria)) {
				$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelectJoinCliente($criteria, $con);
			}
		}
		$this->lastInoAvisosSeaCriteria = $criteria;

		return $this->collInoAvisosSeas;
	}

} // BaseInoMaestraSea
