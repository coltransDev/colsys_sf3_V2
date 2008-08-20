<?php

/**
 * Base class that represents a row from the 'tb_inomaestra_air' table.
 *
 * 
 *
 * @package    lib.model.air.om
 */
abstract class BaseInoMaestraAir extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        InoMaestraAirPeer
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
	 * The value for the ca_mawb field.
	 * @var        string
	 */
	protected $ca_mawb;


	/**
	 * The value for the ca_piezas field.
	 * @var        int
	 */
	protected $ca_piezas;


	/**
	 * The value for the ca_peso field.
	 * @var        double
	 */
	protected $ca_peso;


	/**
	 * The value for the ca_pesovolumen field.
	 * @var        double
	 */
	protected $ca_pesovolumen;


	/**
	 * The value for the ca_observaciones field.
	 * @var        string
	 */
	protected $ca_observaciones;


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
	 * @var        Transportador
	 */
	protected $aTransportador;

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
	 * Collection to store aggregation of collInoIngresosAirs.
	 * @var        array
	 */
	protected $collInoIngresosAirs;

	/**
	 * The criteria used to select the current contents of collInoIngresosAirs.
	 * @var        Criteria
	 */
	protected $lastInoIngresosAirCriteria = null;

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
	 * Get the [ca_mawb] column value.
	 * 
	 * @return     string
	 */
	public function getCaMawb()
	{

		return $this->ca_mawb;
	}

	/**
	 * Get the [ca_piezas] column value.
	 * 
	 * @return     int
	 */
	public function getCaPiezas()
	{

		return $this->ca_piezas;
	}

	/**
	 * Get the [ca_peso] column value.
	 * 
	 * @return     double
	 */
	public function getCaPeso()
	{

		return $this->ca_peso;
	}

	/**
	 * Get the [ca_pesovolumen] column value.
	 * 
	 * @return     double
	 */
	public function getCaPesovolumen()
	{

		return $this->ca_pesovolumen;
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
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_FCHREFERENCIA;
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
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_REFERENCIA;
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
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_IMPOEXPO;
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
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_ORIGEN;
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
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_DESTINO;
		}

	} // setCaDestino()

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
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_MODALIDAD;
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
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_IDLINEA;
		}

		if ($this->aTransportador !== null && $this->aTransportador->getCaIdlinea() !== $v) {
			$this->aTransportador = null;
		}

	} // setCaIdlinea()

	/**
	 * Set the value of [ca_mawb] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaMawb($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_mawb !== $v) {
			$this->ca_mawb = $v;
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_MAWB;
		}

	} // setCaMawb()

	/**
	 * Set the value of [ca_piezas] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaPiezas($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_piezas !== $v) {
			$this->ca_piezas = $v;
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_PIEZAS;
		}

	} // setCaPiezas()

	/**
	 * Set the value of [ca_peso] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaPeso($v)
	{

		if ($this->ca_peso !== $v) {
			$this->ca_peso = $v;
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_PESO;
		}

	} // setCaPeso()

	/**
	 * Set the value of [ca_pesovolumen] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaPesovolumen($v)
	{

		if ($this->ca_pesovolumen !== $v) {
			$this->ca_pesovolumen = $v;
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_PESOVOLUMEN;
		}

	} // setCaPesovolumen()

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
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_OBSERVACIONES;
		}

	} // setCaObservaciones()

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
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_USUCREADO;
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
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_FCHACTUALIZADO;
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
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_USUACTUALIZADO;
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
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_FCHLIQUIDADO;
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
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_USULIQUIDADO;
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
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_FCHCERRADO;
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
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_USUCERRADO;
		}

	} // setCaUsucerrado()

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

			$this->ca_modalidad = $rs->getString($startcol + 5);

			$this->ca_idlinea = $rs->getInt($startcol + 6);

			$this->ca_mawb = $rs->getString($startcol + 7);

			$this->ca_piezas = $rs->getInt($startcol + 8);

			$this->ca_peso = $rs->getFloat($startcol + 9);

			$this->ca_pesovolumen = $rs->getFloat($startcol + 10);

			$this->ca_observaciones = $rs->getString($startcol + 11);

			$this->ca_fchcreado = $rs->getDate($startcol + 12, null);

			$this->ca_usucreado = $rs->getString($startcol + 13);

			$this->ca_fchactualizado = $rs->getDate($startcol + 14, null);

			$this->ca_usuactualizado = $rs->getString($startcol + 15);

			$this->ca_fchliquidado = $rs->getDate($startcol + 16, null);

			$this->ca_usuliquidado = $rs->getString($startcol + 17);

			$this->ca_fchcerrado = $rs->getDate($startcol + 18, null);

			$this->ca_usucerrado = $rs->getString($startcol + 19);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 20; // 20 = InoMaestraAirPeer::NUM_COLUMNS - InoMaestraAirPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating InoMaestraAir object", $e);
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
			$con = Propel::getConnection(InoMaestraAirPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			InoMaestraAirPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(InoMaestraAirPeer::DATABASE_NAME);
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
					$pk = InoMaestraAirPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += InoMaestraAirPeer::doUpdate($this, $con);
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

			if ($this->collInoIngresosAirs !== null) {
				foreach($this->collInoIngresosAirs as $referrerFK) {
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


			if (($retval = InoMaestraAirPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collInoClientesAirs !== null) {
					foreach($this->collInoClientesAirs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collInoIngresosAirs !== null) {
					foreach($this->collInoIngresosAirs as $referrerFK) {
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
		$pos = InoMaestraAirPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaModalidad();
				break;
			case 6:
				return $this->getCaIdlinea();
				break;
			case 7:
				return $this->getCaMawb();
				break;
			case 8:
				return $this->getCaPiezas();
				break;
			case 9:
				return $this->getCaPeso();
				break;
			case 10:
				return $this->getCaPesovolumen();
				break;
			case 11:
				return $this->getCaObservaciones();
				break;
			case 12:
				return $this->getCaFchcreado();
				break;
			case 13:
				return $this->getCaUsucreado();
				break;
			case 14:
				return $this->getCaFchactualizado();
				break;
			case 15:
				return $this->getCaUsuactualizado();
				break;
			case 16:
				return $this->getCaFchliquidado();
				break;
			case 17:
				return $this->getCaUsuliquidado();
				break;
			case 18:
				return $this->getCaFchcerrado();
				break;
			case 19:
				return $this->getCaUsucerrado();
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
		$keys = InoMaestraAirPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaFchreferencia(),
			$keys[1] => $this->getCaReferencia(),
			$keys[2] => $this->getCaImpoexpo(),
			$keys[3] => $this->getCaOrigen(),
			$keys[4] => $this->getCaDestino(),
			$keys[5] => $this->getCaModalidad(),
			$keys[6] => $this->getCaIdlinea(),
			$keys[7] => $this->getCaMawb(),
			$keys[8] => $this->getCaPiezas(),
			$keys[9] => $this->getCaPeso(),
			$keys[10] => $this->getCaPesovolumen(),
			$keys[11] => $this->getCaObservaciones(),
			$keys[12] => $this->getCaFchcreado(),
			$keys[13] => $this->getCaUsucreado(),
			$keys[14] => $this->getCaFchactualizado(),
			$keys[15] => $this->getCaUsuactualizado(),
			$keys[16] => $this->getCaFchliquidado(),
			$keys[17] => $this->getCaUsuliquidado(),
			$keys[18] => $this->getCaFchcerrado(),
			$keys[19] => $this->getCaUsucerrado(),
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
		$pos = InoMaestraAirPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaModalidad($value);
				break;
			case 6:
				$this->setCaIdlinea($value);
				break;
			case 7:
				$this->setCaMawb($value);
				break;
			case 8:
				$this->setCaPiezas($value);
				break;
			case 9:
				$this->setCaPeso($value);
				break;
			case 10:
				$this->setCaPesovolumen($value);
				break;
			case 11:
				$this->setCaObservaciones($value);
				break;
			case 12:
				$this->setCaFchcreado($value);
				break;
			case 13:
				$this->setCaUsucreado($value);
				break;
			case 14:
				$this->setCaFchactualizado($value);
				break;
			case 15:
				$this->setCaUsuactualizado($value);
				break;
			case 16:
				$this->setCaFchliquidado($value);
				break;
			case 17:
				$this->setCaUsuliquidado($value);
				break;
			case 18:
				$this->setCaFchcerrado($value);
				break;
			case 19:
				$this->setCaUsucerrado($value);
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
		$keys = InoMaestraAirPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaFchreferencia($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaReferencia($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaImpoexpo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaOrigen($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaDestino($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaModalidad($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaIdlinea($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaMawb($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaPiezas($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaPeso($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaPesovolumen($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaObservaciones($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaFchcreado($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaUsucreado($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaFchactualizado($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaUsuactualizado($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCaFchliquidado($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setCaUsuliquidado($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setCaFchcerrado($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setCaUsucerrado($arr[$keys[19]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(InoMaestraAirPeer::DATABASE_NAME);

		if ($this->isColumnModified(InoMaestraAirPeer::CA_FCHREFERENCIA)) $criteria->add(InoMaestraAirPeer::CA_FCHREFERENCIA, $this->ca_fchreferencia);
		if ($this->isColumnModified(InoMaestraAirPeer::CA_REFERENCIA)) $criteria->add(InoMaestraAirPeer::CA_REFERENCIA, $this->ca_referencia);
		if ($this->isColumnModified(InoMaestraAirPeer::CA_IMPOEXPO)) $criteria->add(InoMaestraAirPeer::CA_IMPOEXPO, $this->ca_impoexpo);
		if ($this->isColumnModified(InoMaestraAirPeer::CA_ORIGEN)) $criteria->add(InoMaestraAirPeer::CA_ORIGEN, $this->ca_origen);
		if ($this->isColumnModified(InoMaestraAirPeer::CA_DESTINO)) $criteria->add(InoMaestraAirPeer::CA_DESTINO, $this->ca_destino);
		if ($this->isColumnModified(InoMaestraAirPeer::CA_MODALIDAD)) $criteria->add(InoMaestraAirPeer::CA_MODALIDAD, $this->ca_modalidad);
		if ($this->isColumnModified(InoMaestraAirPeer::CA_IDLINEA)) $criteria->add(InoMaestraAirPeer::CA_IDLINEA, $this->ca_idlinea);
		if ($this->isColumnModified(InoMaestraAirPeer::CA_MAWB)) $criteria->add(InoMaestraAirPeer::CA_MAWB, $this->ca_mawb);
		if ($this->isColumnModified(InoMaestraAirPeer::CA_PIEZAS)) $criteria->add(InoMaestraAirPeer::CA_PIEZAS, $this->ca_piezas);
		if ($this->isColumnModified(InoMaestraAirPeer::CA_PESO)) $criteria->add(InoMaestraAirPeer::CA_PESO, $this->ca_peso);
		if ($this->isColumnModified(InoMaestraAirPeer::CA_PESOVOLUMEN)) $criteria->add(InoMaestraAirPeer::CA_PESOVOLUMEN, $this->ca_pesovolumen);
		if ($this->isColumnModified(InoMaestraAirPeer::CA_OBSERVACIONES)) $criteria->add(InoMaestraAirPeer::CA_OBSERVACIONES, $this->ca_observaciones);
		if ($this->isColumnModified(InoMaestraAirPeer::CA_FCHCREADO)) $criteria->add(InoMaestraAirPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(InoMaestraAirPeer::CA_USUCREADO)) $criteria->add(InoMaestraAirPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(InoMaestraAirPeer::CA_FCHACTUALIZADO)) $criteria->add(InoMaestraAirPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(InoMaestraAirPeer::CA_USUACTUALIZADO)) $criteria->add(InoMaestraAirPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);
		if ($this->isColumnModified(InoMaestraAirPeer::CA_FCHLIQUIDADO)) $criteria->add(InoMaestraAirPeer::CA_FCHLIQUIDADO, $this->ca_fchliquidado);
		if ($this->isColumnModified(InoMaestraAirPeer::CA_USULIQUIDADO)) $criteria->add(InoMaestraAirPeer::CA_USULIQUIDADO, $this->ca_usuliquidado);
		if ($this->isColumnModified(InoMaestraAirPeer::CA_FCHCERRADO)) $criteria->add(InoMaestraAirPeer::CA_FCHCERRADO, $this->ca_fchcerrado);
		if ($this->isColumnModified(InoMaestraAirPeer::CA_USUCERRADO)) $criteria->add(InoMaestraAirPeer::CA_USUCERRADO, $this->ca_usucerrado);

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
		$criteria = new Criteria(InoMaestraAirPeer::DATABASE_NAME);

		$criteria->add(InoMaestraAirPeer::CA_REFERENCIA, $this->ca_referencia);

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
	 * @param      object $copyObj An object of InoMaestraAir (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaFchreferencia($this->ca_fchreferencia);

		$copyObj->setCaImpoexpo($this->ca_impoexpo);

		$copyObj->setCaOrigen($this->ca_origen);

		$copyObj->setCaDestino($this->ca_destino);

		$copyObj->setCaModalidad($this->ca_modalidad);

		$copyObj->setCaIdlinea($this->ca_idlinea);

		$copyObj->setCaMawb($this->ca_mawb);

		$copyObj->setCaPiezas($this->ca_piezas);

		$copyObj->setCaPeso($this->ca_peso);

		$copyObj->setCaPesovolumen($this->ca_pesovolumen);

		$copyObj->setCaObservaciones($this->ca_observaciones);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);

		$copyObj->setCaFchliquidado($this->ca_fchliquidado);

		$copyObj->setCaUsuliquidado($this->ca_usuliquidado);

		$copyObj->setCaFchcerrado($this->ca_fchcerrado);

		$copyObj->setCaUsucerrado($this->ca_usucerrado);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getInoClientesAirs() as $relObj) {
				$copyObj->addInoClientesAir($relObj->copy($deepCopy));
			}

			foreach($this->getInoIngresosAirs() as $relObj) {
				$copyObj->addInoIngresosAir($relObj->copy($deepCopy));
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
	 * @return     InoMaestraAir Clone of current object.
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
	 * @return     InoMaestraAirPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new InoMaestraAirPeer();
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
	 * Otherwise if this InoMaestraAir has previously
	 * been saved, it will retrieve related InoClientesAirs from storage.
	 * If this InoMaestraAir is new, it will return
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

				$criteria->add(InoClientesAirPeer::CA_REFERENCIA, $this->getCaReferencia());

				InoClientesAirPeer::addSelectColumns($criteria);
				$this->collInoClientesAirs = InoClientesAirPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(InoClientesAirPeer::CA_REFERENCIA, $this->getCaReferencia());

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

		$criteria->add(InoClientesAirPeer::CA_REFERENCIA, $this->getCaReferencia());

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
		$l->setInoMaestraAir($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this InoMaestraAir is new, it will return
	 * an empty collection; or if this InoMaestraAir has previously
	 * been saved, it will retrieve related InoClientesAirs from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in InoMaestraAir.
	 */
	public function getInoClientesAirsJoinReporte($criteria = null, $con = null)
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

				$criteria->add(InoClientesAirPeer::CA_REFERENCIA, $this->getCaReferencia());

				$this->collInoClientesAirs = InoClientesAirPeer::doSelectJoinReporte($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(InoClientesAirPeer::CA_REFERENCIA, $this->getCaReferencia());

			if (!isset($this->lastInoClientesAirCriteria) || !$this->lastInoClientesAirCriteria->equals($criteria)) {
				$this->collInoClientesAirs = InoClientesAirPeer::doSelectJoinReporte($criteria, $con);
			}
		}
		$this->lastInoClientesAirCriteria = $criteria;

		return $this->collInoClientesAirs;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this InoMaestraAir is new, it will return
	 * an empty collection; or if this InoMaestraAir has previously
	 * been saved, it will retrieve related InoClientesAirs from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in InoMaestraAir.
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

				$criteria->add(InoClientesAirPeer::CA_REFERENCIA, $this->getCaReferencia());

				$this->collInoClientesAirs = InoClientesAirPeer::doSelectJoinTercero($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(InoClientesAirPeer::CA_REFERENCIA, $this->getCaReferencia());

			if (!isset($this->lastInoClientesAirCriteria) || !$this->lastInoClientesAirCriteria->equals($criteria)) {
				$this->collInoClientesAirs = InoClientesAirPeer::doSelectJoinTercero($criteria, $con);
			}
		}
		$this->lastInoClientesAirCriteria = $criteria;

		return $this->collInoClientesAirs;
	}

	/**
	 * Temporary storage of collInoIngresosAirs to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initInoIngresosAirs()
	{
		if ($this->collInoIngresosAirs === null) {
			$this->collInoIngresosAirs = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this InoMaestraAir has previously
	 * been saved, it will retrieve related InoIngresosAirs from storage.
	 * If this InoMaestraAir is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getInoIngresosAirs($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoIngresosAirs === null) {
			if ($this->isNew()) {
			   $this->collInoIngresosAirs = array();
			} else {

				$criteria->add(InoIngresosAirPeer::CA_REFERENCIA, $this->getCaReferencia());

				InoIngresosAirPeer::addSelectColumns($criteria);
				$this->collInoIngresosAirs = InoIngresosAirPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(InoIngresosAirPeer::CA_REFERENCIA, $this->getCaReferencia());

				InoIngresosAirPeer::addSelectColumns($criteria);
				if (!isset($this->lastInoIngresosAirCriteria) || !$this->lastInoIngresosAirCriteria->equals($criteria)) {
					$this->collInoIngresosAirs = InoIngresosAirPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInoIngresosAirCriteria = $criteria;
		return $this->collInoIngresosAirs;
	}

	/**
	 * Returns the number of related InoIngresosAirs.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countInoIngresosAirs($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(InoIngresosAirPeer::CA_REFERENCIA, $this->getCaReferencia());

		return InoIngresosAirPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a InoIngresosAir object to this object
	 * through the InoIngresosAir foreign key attribute
	 *
	 * @param      InoIngresosAir $l InoIngresosAir
	 * @return     void
	 * @throws     PropelException
	 */
	public function addInoIngresosAir(InoIngresosAir $l)
	{
		$this->collInoIngresosAirs[] = $l;
		$l->setInoMaestraAir($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this InoMaestraAir is new, it will return
	 * an empty collection; or if this InoMaestraAir has previously
	 * been saved, it will retrieve related InoIngresosAirs from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in InoMaestraAir.
	 */
	public function getInoIngresosAirsJoinCliente($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoIngresosAirs === null) {
			if ($this->isNew()) {
				$this->collInoIngresosAirs = array();
			} else {

				$criteria->add(InoIngresosAirPeer::CA_REFERENCIA, $this->getCaReferencia());

				$this->collInoIngresosAirs = InoIngresosAirPeer::doSelectJoinCliente($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(InoIngresosAirPeer::CA_REFERENCIA, $this->getCaReferencia());

			if (!isset($this->lastInoIngresosAirCriteria) || !$this->lastInoIngresosAirCriteria->equals($criteria)) {
				$this->collInoIngresosAirs = InoIngresosAirPeer::doSelectJoinCliente($criteria, $con);
			}
		}
		$this->lastInoIngresosAirCriteria = $criteria;

		return $this->collInoIngresosAirs;
	}

} // BaseInoMaestraAir
