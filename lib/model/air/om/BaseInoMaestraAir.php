<?php

/**
 * Base class that represents a row from the 'tb_inomaestra_air' table.
 *
 * 
 *
 * @package    lib.model.air.om
 */
abstract class BaseInoMaestraAir extends BaseObject  implements Persistent {


  const PEER = 'InoMaestraAirPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        InoMaestraAirPeer
	 */
	protected static $peer;

	/**
	 * The value for the ca_fchreferencia field.
	 * @var        string
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
	 * @var        string
	 */
	protected $ca_peso;

	/**
	 * The value for the ca_pesovolumen field.
	 * @var        string
	 */
	protected $ca_pesovolumen;

	/**
	 * The value for the ca_observaciones field.
	 * @var        string
	 */
	protected $ca_observaciones;

	/**
	 * The value for the ca_fchcreado field.
	 * @var        string
	 */
	protected $ca_fchcreado;

	/**
	 * The value for the ca_usucreado field.
	 * @var        string
	 */
	protected $ca_usucreado;

	/**
	 * The value for the ca_fchpreaviso field.
	 * @var        string
	 */
	protected $ca_fchpreaviso;

	/**
	 * The value for the ca_fchllegada field.
	 * @var        string
	 */
	protected $ca_fchllegada;

	/**
	 * The value for the ca_fchactualizado field.
	 * @var        string
	 */
	protected $ca_fchactualizado;

	/**
	 * The value for the ca_usuactualizado field.
	 * @var        string
	 */
	protected $ca_usuactualizado;

	/**
	 * The value for the ca_fchliquidado field.
	 * @var        string
	 */
	protected $ca_fchliquidado;

	/**
	 * The value for the ca_usuliquidado field.
	 * @var        string
	 */
	protected $ca_usuliquidado;

	/**
	 * The value for the ca_fchcerrado field.
	 * @var        string
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
	 * @var        array InoClientesAir[] Collection to store aggregation of InoClientesAir objects.
	 */
	protected $collInoClientesAirs;

	/**
	 * @var        Criteria The criteria used to select the current contents of collInoClientesAirs.
	 */
	private $lastInoClientesAirCriteria = null;

	/**
	 * @var        array InoIngresosAir[] Collection to store aggregation of InoIngresosAir objects.
	 */
	protected $collInoIngresosAirs;

	/**
	 * @var        Criteria The criteria used to select the current contents of collInoIngresosAirs.
	 */
	private $lastInoIngresosAirCriteria = null;

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
	 * Initializes internal state of BaseInoMaestraAir object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
	}

	/**
	 * Get the [optionally formatted] temporal [ca_fchreferencia] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaFchreferencia($format = 'Y-m-d')
	{
		if ($this->ca_fchreferencia === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchreferencia);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchreferencia, true), $x);
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
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
	 * @return     string
	 */
	public function getCaPeso()
	{
		return $this->ca_peso;
	}

	/**
	 * Get the [ca_pesovolumen] column value.
	 * 
	 * @return     string
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
	 * Get the [optionally formatted] temporal [ca_fchcreado] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaFchcreado($format = 'Y-m-d')
	{
		if ($this->ca_fchcreado === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchcreado);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchcreado, true), $x);
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
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
	 * Get the [optionally formatted] temporal [ca_fchpreaviso] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaFchpreaviso($format = 'Y-m-d')
	{
		if ($this->ca_fchpreaviso === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchpreaviso);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchpreaviso, true), $x);
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [optionally formatted] temporal [ca_fchllegada] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaFchllegada($format = 'Y-m-d')
	{
		if ($this->ca_fchllegada === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchllegada);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchllegada, true), $x);
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [optionally formatted] temporal [ca_fchactualizado] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaFchactualizado($format = 'Y-m-d')
	{
		if ($this->ca_fchactualizado === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchactualizado);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchactualizado, true), $x);
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
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
	 * Get the [optionally formatted] temporal [ca_fchliquidado] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaFchliquidado($format = 'Y-m-d')
	{
		if ($this->ca_fchliquidado === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchliquidado);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchliquidado, true), $x);
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
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
	 * Get the [optionally formatted] temporal [ca_fchcerrado] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaFchcerrado($format = 'Y-m-d')
	{
		if ($this->ca_fchcerrado === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchcerrado);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchcerrado, true), $x);
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
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
	 * Sets the value of [ca_fchreferencia] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     InoMaestraAir The current object (for fluent API support)
	 */
	public function setCaFchreferencia($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->ca_fchreferencia !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fchreferencia !== null && $tmpDt = new DateTime($this->ca_fchreferencia)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchreferencia = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = InoMaestraAirPeer::CA_FCHREFERENCIA;
			}
		} // if either are not null

		return $this;
	} // setCaFchreferencia()

	/**
	 * Set the value of [ca_referencia] column.
	 * 
	 * @param      string $v new value
	 * @return     InoMaestraAir The current object (for fluent API support)
	 */
	public function setCaReferencia($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_referencia !== $v) {
			$this->ca_referencia = $v;
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_REFERENCIA;
		}

		return $this;
	} // setCaReferencia()

	/**
	 * Set the value of [ca_impoexpo] column.
	 * 
	 * @param      string $v new value
	 * @return     InoMaestraAir The current object (for fluent API support)
	 */
	public function setCaImpoexpo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_impoexpo !== $v) {
			$this->ca_impoexpo = $v;
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_IMPOEXPO;
		}

		return $this;
	} // setCaImpoexpo()

	/**
	 * Set the value of [ca_origen] column.
	 * 
	 * @param      string $v new value
	 * @return     InoMaestraAir The current object (for fluent API support)
	 */
	public function setCaOrigen($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_origen !== $v) {
			$this->ca_origen = $v;
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_ORIGEN;
		}

		return $this;
	} // setCaOrigen()

	/**
	 * Set the value of [ca_destino] column.
	 * 
	 * @param      string $v new value
	 * @return     InoMaestraAir The current object (for fluent API support)
	 */
	public function setCaDestino($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_destino !== $v) {
			$this->ca_destino = $v;
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_DESTINO;
		}

		return $this;
	} // setCaDestino()

	/**
	 * Set the value of [ca_modalidad] column.
	 * 
	 * @param      string $v new value
	 * @return     InoMaestraAir The current object (for fluent API support)
	 */
	public function setCaModalidad($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_modalidad !== $v) {
			$this->ca_modalidad = $v;
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_MODALIDAD;
		}

		return $this;
	} // setCaModalidad()

	/**
	 * Set the value of [ca_idlinea] column.
	 * 
	 * @param      int $v new value
	 * @return     InoMaestraAir The current object (for fluent API support)
	 */
	public function setCaIdlinea($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idlinea !== $v) {
			$this->ca_idlinea = $v;
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_IDLINEA;
		}

		if ($this->aTransportador !== null && $this->aTransportador->getCaIdlinea() !== $v) {
			$this->aTransportador = null;
		}

		return $this;
	} // setCaIdlinea()

	/**
	 * Set the value of [ca_mawb] column.
	 * 
	 * @param      string $v new value
	 * @return     InoMaestraAir The current object (for fluent API support)
	 */
	public function setCaMawb($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_mawb !== $v) {
			$this->ca_mawb = $v;
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_MAWB;
		}

		return $this;
	} // setCaMawb()

	/**
	 * Set the value of [ca_piezas] column.
	 * 
	 * @param      int $v new value
	 * @return     InoMaestraAir The current object (for fluent API support)
	 */
	public function setCaPiezas($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_piezas !== $v) {
			$this->ca_piezas = $v;
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_PIEZAS;
		}

		return $this;
	} // setCaPiezas()

	/**
	 * Set the value of [ca_peso] column.
	 * 
	 * @param      string $v new value
	 * @return     InoMaestraAir The current object (for fluent API support)
	 */
	public function setCaPeso($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_peso !== $v) {
			$this->ca_peso = $v;
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_PESO;
		}

		return $this;
	} // setCaPeso()

	/**
	 * Set the value of [ca_pesovolumen] column.
	 * 
	 * @param      string $v new value
	 * @return     InoMaestraAir The current object (for fluent API support)
	 */
	public function setCaPesovolumen($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_pesovolumen !== $v) {
			$this->ca_pesovolumen = $v;
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_PESOVOLUMEN;
		}

		return $this;
	} // setCaPesovolumen()

	/**
	 * Set the value of [ca_observaciones] column.
	 * 
	 * @param      string $v new value
	 * @return     InoMaestraAir The current object (for fluent API support)
	 */
	public function setCaObservaciones($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_observaciones !== $v) {
			$this->ca_observaciones = $v;
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_OBSERVACIONES;
		}

		return $this;
	} // setCaObservaciones()

	/**
	 * Sets the value of [ca_fchcreado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     InoMaestraAir The current object (for fluent API support)
	 */
	public function setCaFchcreado($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->ca_fchcreado !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fchcreado !== null && $tmpDt = new DateTime($this->ca_fchcreado)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchcreado = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = InoMaestraAirPeer::CA_FCHCREADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchcreado()

	/**
	 * Set the value of [ca_usucreado] column.
	 * 
	 * @param      string $v new value
	 * @return     InoMaestraAir The current object (for fluent API support)
	 */
	public function setCaUsucreado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usucreado !== $v) {
			$this->ca_usucreado = $v;
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_USUCREADO;
		}

		return $this;
	} // setCaUsucreado()

	/**
	 * Sets the value of [ca_fchpreaviso] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     InoMaestraAir The current object (for fluent API support)
	 */
	public function setCaFchpreaviso($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->ca_fchpreaviso !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fchpreaviso !== null && $tmpDt = new DateTime($this->ca_fchpreaviso)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchpreaviso = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = InoMaestraAirPeer::CA_FCHPREAVISO;
			}
		} // if either are not null

		return $this;
	} // setCaFchpreaviso()

	/**
	 * Sets the value of [ca_fchllegada] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     InoMaestraAir The current object (for fluent API support)
	 */
	public function setCaFchllegada($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->ca_fchllegada !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fchllegada !== null && $tmpDt = new DateTime($this->ca_fchllegada)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchllegada = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = InoMaestraAirPeer::CA_FCHLLEGADA;
			}
		} // if either are not null

		return $this;
	} // setCaFchllegada()

	/**
	 * Sets the value of [ca_fchactualizado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     InoMaestraAir The current object (for fluent API support)
	 */
	public function setCaFchactualizado($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->ca_fchactualizado !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fchactualizado !== null && $tmpDt = new DateTime($this->ca_fchactualizado)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchactualizado = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = InoMaestraAirPeer::CA_FCHACTUALIZADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchactualizado()

	/**
	 * Set the value of [ca_usuactualizado] column.
	 * 
	 * @param      string $v new value
	 * @return     InoMaestraAir The current object (for fluent API support)
	 */
	public function setCaUsuactualizado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usuactualizado !== $v) {
			$this->ca_usuactualizado = $v;
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_USUACTUALIZADO;
		}

		return $this;
	} // setCaUsuactualizado()

	/**
	 * Sets the value of [ca_fchliquidado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     InoMaestraAir The current object (for fluent API support)
	 */
	public function setCaFchliquidado($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->ca_fchliquidado !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fchliquidado !== null && $tmpDt = new DateTime($this->ca_fchliquidado)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchliquidado = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = InoMaestraAirPeer::CA_FCHLIQUIDADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchliquidado()

	/**
	 * Set the value of [ca_usuliquidado] column.
	 * 
	 * @param      string $v new value
	 * @return     InoMaestraAir The current object (for fluent API support)
	 */
	public function setCaUsuliquidado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usuliquidado !== $v) {
			$this->ca_usuliquidado = $v;
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_USULIQUIDADO;
		}

		return $this;
	} // setCaUsuliquidado()

	/**
	 * Sets the value of [ca_fchcerrado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     InoMaestraAir The current object (for fluent API support)
	 */
	public function setCaFchcerrado($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->ca_fchcerrado !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fchcerrado !== null && $tmpDt = new DateTime($this->ca_fchcerrado)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchcerrado = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = InoMaestraAirPeer::CA_FCHCERRADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchcerrado()

	/**
	 * Set the value of [ca_usucerrado] column.
	 * 
	 * @param      string $v new value
	 * @return     InoMaestraAir The current object (for fluent API support)
	 */
	public function setCaUsucerrado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usucerrado !== $v) {
			$this->ca_usucerrado = $v;
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_USUCERRADO;
		}

		return $this;
	} // setCaUsucerrado()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
			// First, ensure that we don't have any columns that have been modified which aren't default columns.
			if (array_diff($this->modifiedColumns, array())) {
				return false;
			}

		// otherwise, everything was equal, so return TRUE
		return true;
	} // hasOnlyDefaultValues()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (0-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->ca_fchreferencia = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ca_referencia = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_impoexpo = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_origen = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_destino = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_modalidad = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_idlinea = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
			$this->ca_mawb = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_piezas = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
			$this->ca_peso = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_pesovolumen = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_observaciones = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_fchcreado = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_usucreado = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->ca_fchpreaviso = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->ca_fchllegada = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->ca_fchactualizado = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
			$this->ca_usuactualizado = ($row[$startcol + 17] !== null) ? (string) $row[$startcol + 17] : null;
			$this->ca_fchliquidado = ($row[$startcol + 18] !== null) ? (string) $row[$startcol + 18] : null;
			$this->ca_usuliquidado = ($row[$startcol + 19] !== null) ? (string) $row[$startcol + 19] : null;
			$this->ca_fchcerrado = ($row[$startcol + 20] !== null) ? (string) $row[$startcol + 20] : null;
			$this->ca_usucerrado = ($row[$startcol + 21] !== null) ? (string) $row[$startcol + 21] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 22; // 22 = InoMaestraAirPeer::NUM_COLUMNS - InoMaestraAirPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating InoMaestraAir object", $e);
		}
	}

	/**
	 * Checks and repairs the internal consistency of the object.
	 *
	 * This method is executed after an already-instantiated object is re-hydrated
	 * from the database.  It exists to check any foreign keys to make sure that
	 * the objects related to the current object are correct based on foreign key.
	 *
	 * You can override this method in the stub class, but you should always invoke
	 * the base method from the overridden method (i.e. parent::ensureConsistency()),
	 * in case your model changes.
	 *
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

		if ($this->aTransportador !== null && $this->ca_idlinea !== $this->aTransportador->getCaIdlinea()) {
			$this->aTransportador = null;
		}
	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
	 */
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(InoMaestraAirPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = InoMaestraAirPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aTransportador = null;
			$this->collInoClientesAirs = null;
			$this->lastInoClientesAirCriteria = null;

			$this->collInoIngresosAirs = null;
			$this->lastInoIngresosAirCriteria = null;

		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(InoMaestraAirPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			InoMaestraAirPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Persists this object to the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All modified related objects will also be persisted in the doSave()
	 * method.  This method wraps all precipitate database operations in a
	 * single transaction.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(InoMaestraAirPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			InoMaestraAirPeer::addInstanceToPool($this);
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs the work of inserting or updating the row in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aTransportador !== null) {
				if ($this->aTransportador->isModified() || $this->aTransportador->isNew()) {
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
				foreach ($this->collInoClientesAirs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collInoIngresosAirs !== null) {
				foreach ($this->collInoIngresosAirs as $referrerFK) {
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
					foreach ($this->collInoClientesAirs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collInoIngresosAirs !== null) {
					foreach ($this->collInoIngresosAirs as $referrerFK) {
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
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = InoMaestraAirPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
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
				return $this->getCaFchpreaviso();
				break;
			case 15:
				return $this->getCaFchllegada();
				break;
			case 16:
				return $this->getCaFchactualizado();
				break;
			case 17:
				return $this->getCaUsuactualizado();
				break;
			case 18:
				return $this->getCaFchliquidado();
				break;
			case 19:
				return $this->getCaUsuliquidado();
				break;
			case 20:
				return $this->getCaFchcerrado();
				break;
			case 21:
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
	 * @param      string $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                        BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. Defaults to BasePeer::TYPE_PHPNAME.
	 * @param      boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns.  Defaults to TRUE.
	 * @return     an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
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
			$keys[14] => $this->getCaFchpreaviso(),
			$keys[15] => $this->getCaFchllegada(),
			$keys[16] => $this->getCaFchactualizado(),
			$keys[17] => $this->getCaUsuactualizado(),
			$keys[18] => $this->getCaFchliquidado(),
			$keys[19] => $this->getCaUsuliquidado(),
			$keys[20] => $this->getCaFchcerrado(),
			$keys[21] => $this->getCaUsucerrado(),
		);
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
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
				$this->setCaFchpreaviso($value);
				break;
			case 15:
				$this->setCaFchllegada($value);
				break;
			case 16:
				$this->setCaFchactualizado($value);
				break;
			case 17:
				$this->setCaUsuactualizado($value);
				break;
			case 18:
				$this->setCaFchliquidado($value);
				break;
			case 19:
				$this->setCaUsuliquidado($value);
				break;
			case 20:
				$this->setCaFchcerrado($value);
				break;
			case 21:
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
	 * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 * The default key type is the column's phpname (e.g. 'AuthorId')
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
		if (array_key_exists($keys[14], $arr)) $this->setCaFchpreaviso($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaFchllegada($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCaFchactualizado($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setCaUsuactualizado($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setCaFchliquidado($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setCaUsuliquidado($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setCaFchcerrado($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setCaUsucerrado($arr[$keys[21]]);
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
		if ($this->isColumnModified(InoMaestraAirPeer::CA_FCHPREAVISO)) $criteria->add(InoMaestraAirPeer::CA_FCHPREAVISO, $this->ca_fchpreaviso);
		if ($this->isColumnModified(InoMaestraAirPeer::CA_FCHLLEGADA)) $criteria->add(InoMaestraAirPeer::CA_FCHLLEGADA, $this->ca_fchllegada);
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

		$copyObj->setCaReferencia($this->ca_referencia);

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

		$copyObj->setCaFchpreaviso($this->ca_fchpreaviso);

		$copyObj->setCaFchllegada($this->ca_fchllegada);

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

			foreach ($this->getInoClientesAirs() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addInoClientesAir($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getInoIngresosAirs() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addInoIngresosAir($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

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
	 * @return     InoMaestraAir The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setTransportador(Transportador $v = null)
	{
		if ($v === null) {
			$this->setCaIdlinea(NULL);
		} else {
			$this->setCaIdlinea($v->getCaIdlinea());
		}

		$this->aTransportador = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Transportador object, it will not be re-added.
		if ($v !== null) {
			$v->addInoMaestraAir($this);
		}

		return $this;
	}


	/**
	 * Get the associated Transportador object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Transportador The associated Transportador object.
	 * @throws     PropelException
	 */
	public function getTransportador(PropelPDO $con = null)
	{
		if ($this->aTransportador === null && ($this->ca_idlinea !== null)) {
			$c = new Criteria(TransportadorPeer::DATABASE_NAME);
			$c->add(TransportadorPeer::CA_IDLINEA, $this->ca_idlinea);
			$this->aTransportador = TransportadorPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aTransportador->addInoMaestraAirs($this);
			 */
		}
		return $this->aTransportador;
	}

	/**
	 * Clears out the collInoClientesAirs collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addInoClientesAirs()
	 */
	public function clearInoClientesAirs()
	{
		$this->collInoClientesAirs = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collInoClientesAirs collection (array).
	 *
	 * By default this just sets the collInoClientesAirs collection to an empty array (like clearcollInoClientesAirs());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initInoClientesAirs()
	{
		$this->collInoClientesAirs = array();
	}

	/**
	 * Gets an array of InoClientesAir objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this InoMaestraAir has previously been saved, it will retrieve
	 * related InoClientesAirs from storage. If this InoMaestraAir is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array InoClientesAir[]
	 * @throws     PropelException
	 */
	public function getInoClientesAirs($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(InoMaestraAirPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesAirs === null) {
			if ($this->isNew()) {
			   $this->collInoClientesAirs = array();
			} else {

				$criteria->add(InoClientesAirPeer::CA_REFERENCIA, $this->ca_referencia);

				InoClientesAirPeer::addSelectColumns($criteria);
				$this->collInoClientesAirs = InoClientesAirPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(InoClientesAirPeer::CA_REFERENCIA, $this->ca_referencia);

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
	 * Returns the number of related InoClientesAir objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related InoClientesAir objects.
	 * @throws     PropelException
	 */
	public function countInoClientesAirs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(InoMaestraAirPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collInoClientesAirs === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(InoClientesAirPeer::CA_REFERENCIA, $this->ca_referencia);

				$count = InoClientesAirPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(InoClientesAirPeer::CA_REFERENCIA, $this->ca_referencia);

				if (!isset($this->lastInoClientesAirCriteria) || !$this->lastInoClientesAirCriteria->equals($criteria)) {
					$count = InoClientesAirPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collInoClientesAirs);
				}
			} else {
				$count = count($this->collInoClientesAirs);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a InoClientesAir object to this object
	 * through the InoClientesAir foreign key attribute.
	 *
	 * @param      InoClientesAir $l InoClientesAir
	 * @return     void
	 * @throws     PropelException
	 */
	public function addInoClientesAir(InoClientesAir $l)
	{
		if ($this->collInoClientesAirs === null) {
			$this->initInoClientesAirs();
		}
		if (!in_array($l, $this->collInoClientesAirs, true)) { // only add it if the **same** object is not already associated
			array_push($this->collInoClientesAirs, $l);
			$l->setInoMaestraAir($this);
		}
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
	public function getInoClientesAirsJoinReporte($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(InoMaestraAirPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesAirs === null) {
			if ($this->isNew()) {
				$this->collInoClientesAirs = array();
			} else {

				$criteria->add(InoClientesAirPeer::CA_REFERENCIA, $this->ca_referencia);

				$this->collInoClientesAirs = InoClientesAirPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(InoClientesAirPeer::CA_REFERENCIA, $this->ca_referencia);

			if (!isset($this->lastInoClientesAirCriteria) || !$this->lastInoClientesAirCriteria->equals($criteria)) {
				$this->collInoClientesAirs = InoClientesAirPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
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
	public function getInoClientesAirsJoinTercero($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(InoMaestraAirPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesAirs === null) {
			if ($this->isNew()) {
				$this->collInoClientesAirs = array();
			} else {

				$criteria->add(InoClientesAirPeer::CA_REFERENCIA, $this->ca_referencia);

				$this->collInoClientesAirs = InoClientesAirPeer::doSelectJoinTercero($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(InoClientesAirPeer::CA_REFERENCIA, $this->ca_referencia);

			if (!isset($this->lastInoClientesAirCriteria) || !$this->lastInoClientesAirCriteria->equals($criteria)) {
				$this->collInoClientesAirs = InoClientesAirPeer::doSelectJoinTercero($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoClientesAirCriteria = $criteria;

		return $this->collInoClientesAirs;
	}

	/**
	 * Clears out the collInoIngresosAirs collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addInoIngresosAirs()
	 */
	public function clearInoIngresosAirs()
	{
		$this->collInoIngresosAirs = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collInoIngresosAirs collection (array).
	 *
	 * By default this just sets the collInoIngresosAirs collection to an empty array (like clearcollInoIngresosAirs());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initInoIngresosAirs()
	{
		$this->collInoIngresosAirs = array();
	}

	/**
	 * Gets an array of InoIngresosAir objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this InoMaestraAir has previously been saved, it will retrieve
	 * related InoIngresosAirs from storage. If this InoMaestraAir is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array InoIngresosAir[]
	 * @throws     PropelException
	 */
	public function getInoIngresosAirs($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(InoMaestraAirPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoIngresosAirs === null) {
			if ($this->isNew()) {
			   $this->collInoIngresosAirs = array();
			} else {

				$criteria->add(InoIngresosAirPeer::CA_REFERENCIA, $this->ca_referencia);

				InoIngresosAirPeer::addSelectColumns($criteria);
				$this->collInoIngresosAirs = InoIngresosAirPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(InoIngresosAirPeer::CA_REFERENCIA, $this->ca_referencia);

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
	 * Returns the number of related InoIngresosAir objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related InoIngresosAir objects.
	 * @throws     PropelException
	 */
	public function countInoIngresosAirs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(InoMaestraAirPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collInoIngresosAirs === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(InoIngresosAirPeer::CA_REFERENCIA, $this->ca_referencia);

				$count = InoIngresosAirPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(InoIngresosAirPeer::CA_REFERENCIA, $this->ca_referencia);

				if (!isset($this->lastInoIngresosAirCriteria) || !$this->lastInoIngresosAirCriteria->equals($criteria)) {
					$count = InoIngresosAirPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collInoIngresosAirs);
				}
			} else {
				$count = count($this->collInoIngresosAirs);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a InoIngresosAir object to this object
	 * through the InoIngresosAir foreign key attribute.
	 *
	 * @param      InoIngresosAir $l InoIngresosAir
	 * @return     void
	 * @throws     PropelException
	 */
	public function addInoIngresosAir(InoIngresosAir $l)
	{
		if ($this->collInoIngresosAirs === null) {
			$this->initInoIngresosAirs();
		}
		if (!in_array($l, $this->collInoIngresosAirs, true)) { // only add it if the **same** object is not already associated
			array_push($this->collInoIngresosAirs, $l);
			$l->setInoMaestraAir($this);
		}
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
	public function getInoIngresosAirsJoinCliente($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(InoMaestraAirPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoIngresosAirs === null) {
			if ($this->isNew()) {
				$this->collInoIngresosAirs = array();
			} else {

				$criteria->add(InoIngresosAirPeer::CA_REFERENCIA, $this->ca_referencia);

				$this->collInoIngresosAirs = InoIngresosAirPeer::doSelectJoinCliente($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(InoIngresosAirPeer::CA_REFERENCIA, $this->ca_referencia);

			if (!isset($this->lastInoIngresosAirCriteria) || !$this->lastInoIngresosAirCriteria->equals($criteria)) {
				$this->collInoIngresosAirs = InoIngresosAirPeer::doSelectJoinCliente($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoIngresosAirCriteria = $criteria;

		return $this->collInoIngresosAirs;
	}

	/**
	 * Resets all collections of referencing foreign keys.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect objects
	 * with circular references.  This is currently necessary when using Propel in certain
	 * daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all associated objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collInoClientesAirs) {
				foreach ((array) $this->collInoClientesAirs as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collInoIngresosAirs) {
				foreach ((array) $this->collInoIngresosAirs as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collInoClientesAirs = null;
		$this->collInoIngresosAirs = null;
			$this->aTransportador = null;
	}

} // BaseInoMaestraAir
