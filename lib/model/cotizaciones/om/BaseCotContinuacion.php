<?php

/**
 * Base class that represents a row from the 'tb_cotcontinuacion' table.
 *
 * 
 *
 * @package    lib.model.cotizaciones.om
 */
abstract class BaseCotContinuacion extends BaseObject  implements Persistent {


  const PEER = 'CotContinuacionPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        CotContinuacionPeer
	 */
	protected static $peer;

	/**
	 * The value for the ca_idcontinuacion field.
	 * @var        int
	 */
	protected $ca_idcontinuacion;

	/**
	 * The value for the ca_idcotizacion field.
	 * @var        int
	 */
	protected $ca_idcotizacion;

	/**
	 * The value for the ca_tipo field.
	 * @var        string
	 */
	protected $ca_tipo;

	/**
	 * The value for the ca_modalidad field.
	 * @var        string
	 */
	protected $ca_modalidad;

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
	 * The value for the ca_idconcepto field.
	 * @var        int
	 */
	protected $ca_idconcepto;

	/**
	 * The value for the ca_idmoneda field.
	 * @var        string
	 */
	protected $ca_idmoneda;

	/**
	 * The value for the ca_idequipo field.
	 * @var        int
	 */
	protected $ca_idequipo;

	/**
	 * The value for the ca_tarifa field.
	 * @var        string
	 */
	protected $ca_tarifa;

	/**
	 * The value for the ca_valor_tar field.
	 * @var        string
	 */
	protected $ca_valor_tar;

	/**
	 * The value for the ca_valor_min field.
	 * @var        string
	 */
	protected $ca_valor_min;

	/**
	 * The value for the ca_frecuencia field.
	 * @var        string
	 */
	protected $ca_frecuencia;

	/**
	 * The value for the ca_tiempotransito field.
	 * @var        string
	 */
	protected $ca_tiempotransito;

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
	 * @var        Cotizacion
	 */
	protected $aCotizacion;

	/**
	 * @var        Concepto
	 */
	protected $aConcepto;

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
	 * Initializes internal state of BaseCotContinuacion object.
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
	 * Get the [ca_idcontinuacion] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdcontinuacion()
	{
		return $this->ca_idcontinuacion;
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
	 * Get the [ca_tipo] column value.
	 * 
	 * @return     string
	 */
	public function getCaTipo()
	{
		return $this->ca_tipo;
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
	 * Get the [ca_idconcepto] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdconcepto()
	{
		return $this->ca_idconcepto;
	}

	/**
	 * Get the [ca_idmoneda] column value.
	 * 
	 * @return     string
	 */
	public function getCaIdmoneda()
	{
		return $this->ca_idmoneda;
	}

	/**
	 * Get the [ca_idequipo] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdequipo()
	{
		return $this->ca_idequipo;
	}

	/**
	 * Get the [ca_tarifa] column value.
	 * 
	 * @return     string
	 */
	public function getCaTarifa()
	{
		return $this->ca_tarifa;
	}

	/**
	 * Get the [ca_valor_tar] column value.
	 * 
	 * @return     string
	 */
	public function getCaValorTar()
	{
		return $this->ca_valor_tar;
	}

	/**
	 * Get the [ca_valor_min] column value.
	 * 
	 * @return     string
	 */
	public function getCaValorMin()
	{
		return $this->ca_valor_min;
	}

	/**
	 * Get the [ca_frecuencia] column value.
	 * 
	 * @return     string
	 */
	public function getCaFrecuencia()
	{
		return $this->ca_frecuencia;
	}

	/**
	 * Get the [ca_tiempotransito] column value.
	 * 
	 * @return     string
	 */
	public function getCaTiempotransito()
	{
		return $this->ca_tiempotransito;
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
	public function getCaFchcreado($format = 'Y-m-d H:i:s')
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
	 * Get the [optionally formatted] temporal [ca_fchactualizado] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaFchactualizado($format = 'Y-m-d H:i:s')
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
	 * Set the value of [ca_idcontinuacion] column.
	 * 
	 * @param      int $v new value
	 * @return     CotContinuacion The current object (for fluent API support)
	 */
	public function setCaIdcontinuacion($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idcontinuacion !== $v) {
			$this->ca_idcontinuacion = $v;
			$this->modifiedColumns[] = CotContinuacionPeer::CA_IDCONTINUACION;
		}

		return $this;
	} // setCaIdcontinuacion()

	/**
	 * Set the value of [ca_idcotizacion] column.
	 * 
	 * @param      int $v new value
	 * @return     CotContinuacion The current object (for fluent API support)
	 */
	public function setCaIdcotizacion($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idcotizacion !== $v) {
			$this->ca_idcotizacion = $v;
			$this->modifiedColumns[] = CotContinuacionPeer::CA_IDCOTIZACION;
		}

		if ($this->aCotizacion !== null && $this->aCotizacion->getCaIdcotizacion() !== $v) {
			$this->aCotizacion = null;
		}

		return $this;
	} // setCaIdcotizacion()

	/**
	 * Set the value of [ca_tipo] column.
	 * 
	 * @param      string $v new value
	 * @return     CotContinuacion The current object (for fluent API support)
	 */
	public function setCaTipo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_tipo !== $v) {
			$this->ca_tipo = $v;
			$this->modifiedColumns[] = CotContinuacionPeer::CA_TIPO;
		}

		return $this;
	} // setCaTipo()

	/**
	 * Set the value of [ca_modalidad] column.
	 * 
	 * @param      string $v new value
	 * @return     CotContinuacion The current object (for fluent API support)
	 */
	public function setCaModalidad($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_modalidad !== $v) {
			$this->ca_modalidad = $v;
			$this->modifiedColumns[] = CotContinuacionPeer::CA_MODALIDAD;
		}

		return $this;
	} // setCaModalidad()

	/**
	 * Set the value of [ca_origen] column.
	 * 
	 * @param      string $v new value
	 * @return     CotContinuacion The current object (for fluent API support)
	 */
	public function setCaOrigen($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_origen !== $v) {
			$this->ca_origen = $v;
			$this->modifiedColumns[] = CotContinuacionPeer::CA_ORIGEN;
		}

		return $this;
	} // setCaOrigen()

	/**
	 * Set the value of [ca_destino] column.
	 * 
	 * @param      string $v new value
	 * @return     CotContinuacion The current object (for fluent API support)
	 */
	public function setCaDestino($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_destino !== $v) {
			$this->ca_destino = $v;
			$this->modifiedColumns[] = CotContinuacionPeer::CA_DESTINO;
		}

		return $this;
	} // setCaDestino()

	/**
	 * Set the value of [ca_idconcepto] column.
	 * 
	 * @param      int $v new value
	 * @return     CotContinuacion The current object (for fluent API support)
	 */
	public function setCaIdconcepto($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idconcepto !== $v) {
			$this->ca_idconcepto = $v;
			$this->modifiedColumns[] = CotContinuacionPeer::CA_IDCONCEPTO;
		}

		if ($this->aConcepto !== null && $this->aConcepto->getCaIdconcepto() !== $v) {
			$this->aConcepto = null;
		}

		return $this;
	} // setCaIdconcepto()

	/**
	 * Set the value of [ca_idmoneda] column.
	 * 
	 * @param      string $v new value
	 * @return     CotContinuacion The current object (for fluent API support)
	 */
	public function setCaIdmoneda($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idmoneda !== $v) {
			$this->ca_idmoneda = $v;
			$this->modifiedColumns[] = CotContinuacionPeer::CA_IDMONEDA;
		}

		return $this;
	} // setCaIdmoneda()

	/**
	 * Set the value of [ca_idequipo] column.
	 * 
	 * @param      int $v new value
	 * @return     CotContinuacion The current object (for fluent API support)
	 */
	public function setCaIdequipo($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idequipo !== $v) {
			$this->ca_idequipo = $v;
			$this->modifiedColumns[] = CotContinuacionPeer::CA_IDEQUIPO;
		}

		return $this;
	} // setCaIdequipo()

	/**
	 * Set the value of [ca_tarifa] column.
	 * 
	 * @param      string $v new value
	 * @return     CotContinuacion The current object (for fluent API support)
	 */
	public function setCaTarifa($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_tarifa !== $v) {
			$this->ca_tarifa = $v;
			$this->modifiedColumns[] = CotContinuacionPeer::CA_TARIFA;
		}

		return $this;
	} // setCaTarifa()

	/**
	 * Set the value of [ca_valor_tar] column.
	 * 
	 * @param      string $v new value
	 * @return     CotContinuacion The current object (for fluent API support)
	 */
	public function setCaValorTar($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_valor_tar !== $v) {
			$this->ca_valor_tar = $v;
			$this->modifiedColumns[] = CotContinuacionPeer::CA_VALOR_TAR;
		}

		return $this;
	} // setCaValorTar()

	/**
	 * Set the value of [ca_valor_min] column.
	 * 
	 * @param      string $v new value
	 * @return     CotContinuacion The current object (for fluent API support)
	 */
	public function setCaValorMin($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_valor_min !== $v) {
			$this->ca_valor_min = $v;
			$this->modifiedColumns[] = CotContinuacionPeer::CA_VALOR_MIN;
		}

		return $this;
	} // setCaValorMin()

	/**
	 * Set the value of [ca_frecuencia] column.
	 * 
	 * @param      string $v new value
	 * @return     CotContinuacion The current object (for fluent API support)
	 */
	public function setCaFrecuencia($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_frecuencia !== $v) {
			$this->ca_frecuencia = $v;
			$this->modifiedColumns[] = CotContinuacionPeer::CA_FRECUENCIA;
		}

		return $this;
	} // setCaFrecuencia()

	/**
	 * Set the value of [ca_tiempotransito] column.
	 * 
	 * @param      string $v new value
	 * @return     CotContinuacion The current object (for fluent API support)
	 */
	public function setCaTiempotransito($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_tiempotransito !== $v) {
			$this->ca_tiempotransito = $v;
			$this->modifiedColumns[] = CotContinuacionPeer::CA_TIEMPOTRANSITO;
		}

		return $this;
	} // setCaTiempotransito()

	/**
	 * Set the value of [ca_observaciones] column.
	 * 
	 * @param      string $v new value
	 * @return     CotContinuacion The current object (for fluent API support)
	 */
	public function setCaObservaciones($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_observaciones !== $v) {
			$this->ca_observaciones = $v;
			$this->modifiedColumns[] = CotContinuacionPeer::CA_OBSERVACIONES;
		}

		return $this;
	} // setCaObservaciones()

	/**
	 * Sets the value of [ca_fchcreado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     CotContinuacion The current object (for fluent API support)
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

			$currNorm = ($this->ca_fchcreado !== null && $tmpDt = new DateTime($this->ca_fchcreado)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchcreado = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = CotContinuacionPeer::CA_FCHCREADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchcreado()

	/**
	 * Set the value of [ca_usucreado] column.
	 * 
	 * @param      string $v new value
	 * @return     CotContinuacion The current object (for fluent API support)
	 */
	public function setCaUsucreado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usucreado !== $v) {
			$this->ca_usucreado = $v;
			$this->modifiedColumns[] = CotContinuacionPeer::CA_USUCREADO;
		}

		return $this;
	} // setCaUsucreado()

	/**
	 * Sets the value of [ca_fchactualizado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     CotContinuacion The current object (for fluent API support)
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

			$currNorm = ($this->ca_fchactualizado !== null && $tmpDt = new DateTime($this->ca_fchactualizado)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchactualizado = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = CotContinuacionPeer::CA_FCHACTUALIZADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchactualizado()

	/**
	 * Set the value of [ca_usuactualizado] column.
	 * 
	 * @param      string $v new value
	 * @return     CotContinuacion The current object (for fluent API support)
	 */
	public function setCaUsuactualizado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usuactualizado !== $v) {
			$this->ca_usuactualizado = $v;
			$this->modifiedColumns[] = CotContinuacionPeer::CA_USUACTUALIZADO;
		}

		return $this;
	} // setCaUsuactualizado()

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

			$this->ca_idcontinuacion = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_idcotizacion = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_tipo = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_modalidad = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_origen = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_destino = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_idconcepto = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
			$this->ca_idmoneda = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_idequipo = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
			$this->ca_tarifa = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_valor_tar = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_valor_min = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_frecuencia = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_tiempotransito = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->ca_observaciones = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->ca_fchcreado = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->ca_usucreado = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
			$this->ca_fchactualizado = ($row[$startcol + 17] !== null) ? (string) $row[$startcol + 17] : null;
			$this->ca_usuactualizado = ($row[$startcol + 18] !== null) ? (string) $row[$startcol + 18] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 19; // 19 = CotContinuacionPeer::NUM_COLUMNS - CotContinuacionPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating CotContinuacion object", $e);
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

		if ($this->aCotizacion !== null && $this->ca_idcotizacion !== $this->aCotizacion->getCaIdcotizacion()) {
			$this->aCotizacion = null;
		}
		if ($this->aConcepto !== null && $this->ca_idconcepto !== $this->aConcepto->getCaIdconcepto()) {
			$this->aConcepto = null;
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
			$con = Propel::getConnection(CotContinuacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = CotContinuacionPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aCotizacion = null;
			$this->aConcepto = null;
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
			$con = Propel::getConnection(CotContinuacionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			CotContinuacionPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(CotContinuacionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			CotContinuacionPeer::addInstanceToPool($this);
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

			if ($this->aCotizacion !== null) {
				if ($this->aCotizacion->isModified() || $this->aCotizacion->isNew()) {
					$affectedRows += $this->aCotizacion->save($con);
				}
				$this->setCotizacion($this->aCotizacion);
			}

			if ($this->aConcepto !== null) {
				if ($this->aConcepto->isModified() || $this->aConcepto->isNew()) {
					$affectedRows += $this->aConcepto->save($con);
				}
				$this->setConcepto($this->aConcepto);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = CotContinuacionPeer::CA_IDCONTINUACION;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = CotContinuacionPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setCaIdcontinuacion($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += CotContinuacionPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
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

			if ($this->aCotizacion !== null) {
				if (!$this->aCotizacion->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCotizacion->getValidationFailures());
				}
			}

			if ($this->aConcepto !== null) {
				if (!$this->aConcepto->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aConcepto->getValidationFailures());
				}
			}


			if (($retval = CotContinuacionPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
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
		$pos = CotContinuacionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdcontinuacion();
				break;
			case 1:
				return $this->getCaIdcotizacion();
				break;
			case 2:
				return $this->getCaTipo();
				break;
			case 3:
				return $this->getCaModalidad();
				break;
			case 4:
				return $this->getCaOrigen();
				break;
			case 5:
				return $this->getCaDestino();
				break;
			case 6:
				return $this->getCaIdconcepto();
				break;
			case 7:
				return $this->getCaIdmoneda();
				break;
			case 8:
				return $this->getCaIdequipo();
				break;
			case 9:
				return $this->getCaTarifa();
				break;
			case 10:
				return $this->getCaValorTar();
				break;
			case 11:
				return $this->getCaValorMin();
				break;
			case 12:
				return $this->getCaFrecuencia();
				break;
			case 13:
				return $this->getCaTiempotransito();
				break;
			case 14:
				return $this->getCaObservaciones();
				break;
			case 15:
				return $this->getCaFchcreado();
				break;
			case 16:
				return $this->getCaUsucreado();
				break;
			case 17:
				return $this->getCaFchactualizado();
				break;
			case 18:
				return $this->getCaUsuactualizado();
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
		$keys = CotContinuacionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdcontinuacion(),
			$keys[1] => $this->getCaIdcotizacion(),
			$keys[2] => $this->getCaTipo(),
			$keys[3] => $this->getCaModalidad(),
			$keys[4] => $this->getCaOrigen(),
			$keys[5] => $this->getCaDestino(),
			$keys[6] => $this->getCaIdconcepto(),
			$keys[7] => $this->getCaIdmoneda(),
			$keys[8] => $this->getCaIdequipo(),
			$keys[9] => $this->getCaTarifa(),
			$keys[10] => $this->getCaValorTar(),
			$keys[11] => $this->getCaValorMin(),
			$keys[12] => $this->getCaFrecuencia(),
			$keys[13] => $this->getCaTiempotransito(),
			$keys[14] => $this->getCaObservaciones(),
			$keys[15] => $this->getCaFchcreado(),
			$keys[16] => $this->getCaUsucreado(),
			$keys[17] => $this->getCaFchactualizado(),
			$keys[18] => $this->getCaUsuactualizado(),
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
		$pos = CotContinuacionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdcontinuacion($value);
				break;
			case 1:
				$this->setCaIdcotizacion($value);
				break;
			case 2:
				$this->setCaTipo($value);
				break;
			case 3:
				$this->setCaModalidad($value);
				break;
			case 4:
				$this->setCaOrigen($value);
				break;
			case 5:
				$this->setCaDestino($value);
				break;
			case 6:
				$this->setCaIdconcepto($value);
				break;
			case 7:
				$this->setCaIdmoneda($value);
				break;
			case 8:
				$this->setCaIdequipo($value);
				break;
			case 9:
				$this->setCaTarifa($value);
				break;
			case 10:
				$this->setCaValorTar($value);
				break;
			case 11:
				$this->setCaValorMin($value);
				break;
			case 12:
				$this->setCaFrecuencia($value);
				break;
			case 13:
				$this->setCaTiempotransito($value);
				break;
			case 14:
				$this->setCaObservaciones($value);
				break;
			case 15:
				$this->setCaFchcreado($value);
				break;
			case 16:
				$this->setCaUsucreado($value);
				break;
			case 17:
				$this->setCaFchactualizado($value);
				break;
			case 18:
				$this->setCaUsuactualizado($value);
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
		$keys = CotContinuacionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdcontinuacion($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdcotizacion($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaTipo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaModalidad($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaOrigen($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaDestino($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaIdconcepto($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaIdmoneda($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaIdequipo($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaTarifa($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaValorTar($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaValorMin($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaFrecuencia($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaTiempotransito($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaObservaciones($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaFchcreado($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCaUsucreado($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setCaFchactualizado($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setCaUsuactualizado($arr[$keys[18]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(CotContinuacionPeer::DATABASE_NAME);

		if ($this->isColumnModified(CotContinuacionPeer::CA_IDCONTINUACION)) $criteria->add(CotContinuacionPeer::CA_IDCONTINUACION, $this->ca_idcontinuacion);
		if ($this->isColumnModified(CotContinuacionPeer::CA_IDCOTIZACION)) $criteria->add(CotContinuacionPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);
		if ($this->isColumnModified(CotContinuacionPeer::CA_TIPO)) $criteria->add(CotContinuacionPeer::CA_TIPO, $this->ca_tipo);
		if ($this->isColumnModified(CotContinuacionPeer::CA_MODALIDAD)) $criteria->add(CotContinuacionPeer::CA_MODALIDAD, $this->ca_modalidad);
		if ($this->isColumnModified(CotContinuacionPeer::CA_ORIGEN)) $criteria->add(CotContinuacionPeer::CA_ORIGEN, $this->ca_origen);
		if ($this->isColumnModified(CotContinuacionPeer::CA_DESTINO)) $criteria->add(CotContinuacionPeer::CA_DESTINO, $this->ca_destino);
		if ($this->isColumnModified(CotContinuacionPeer::CA_IDCONCEPTO)) $criteria->add(CotContinuacionPeer::CA_IDCONCEPTO, $this->ca_idconcepto);
		if ($this->isColumnModified(CotContinuacionPeer::CA_IDMONEDA)) $criteria->add(CotContinuacionPeer::CA_IDMONEDA, $this->ca_idmoneda);
		if ($this->isColumnModified(CotContinuacionPeer::CA_IDEQUIPO)) $criteria->add(CotContinuacionPeer::CA_IDEQUIPO, $this->ca_idequipo);
		if ($this->isColumnModified(CotContinuacionPeer::CA_TARIFA)) $criteria->add(CotContinuacionPeer::CA_TARIFA, $this->ca_tarifa);
		if ($this->isColumnModified(CotContinuacionPeer::CA_VALOR_TAR)) $criteria->add(CotContinuacionPeer::CA_VALOR_TAR, $this->ca_valor_tar);
		if ($this->isColumnModified(CotContinuacionPeer::CA_VALOR_MIN)) $criteria->add(CotContinuacionPeer::CA_VALOR_MIN, $this->ca_valor_min);
		if ($this->isColumnModified(CotContinuacionPeer::CA_FRECUENCIA)) $criteria->add(CotContinuacionPeer::CA_FRECUENCIA, $this->ca_frecuencia);
		if ($this->isColumnModified(CotContinuacionPeer::CA_TIEMPOTRANSITO)) $criteria->add(CotContinuacionPeer::CA_TIEMPOTRANSITO, $this->ca_tiempotransito);
		if ($this->isColumnModified(CotContinuacionPeer::CA_OBSERVACIONES)) $criteria->add(CotContinuacionPeer::CA_OBSERVACIONES, $this->ca_observaciones);
		if ($this->isColumnModified(CotContinuacionPeer::CA_FCHCREADO)) $criteria->add(CotContinuacionPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(CotContinuacionPeer::CA_USUCREADO)) $criteria->add(CotContinuacionPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(CotContinuacionPeer::CA_FCHACTUALIZADO)) $criteria->add(CotContinuacionPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(CotContinuacionPeer::CA_USUACTUALIZADO)) $criteria->add(CotContinuacionPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);

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
		$criteria = new Criteria(CotContinuacionPeer::DATABASE_NAME);

		$criteria->add(CotContinuacionPeer::CA_IDCONTINUACION, $this->ca_idcontinuacion);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdcontinuacion();
	}

	/**
	 * Generic method to set the primary key (ca_idcontinuacion column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdcontinuacion($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of CotContinuacion (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdcotizacion($this->ca_idcotizacion);

		$copyObj->setCaTipo($this->ca_tipo);

		$copyObj->setCaModalidad($this->ca_modalidad);

		$copyObj->setCaOrigen($this->ca_origen);

		$copyObj->setCaDestino($this->ca_destino);

		$copyObj->setCaIdconcepto($this->ca_idconcepto);

		$copyObj->setCaIdmoneda($this->ca_idmoneda);

		$copyObj->setCaIdequipo($this->ca_idequipo);

		$copyObj->setCaTarifa($this->ca_tarifa);

		$copyObj->setCaValorTar($this->ca_valor_tar);

		$copyObj->setCaValorMin($this->ca_valor_min);

		$copyObj->setCaFrecuencia($this->ca_frecuencia);

		$copyObj->setCaTiempotransito($this->ca_tiempotransito);

		$copyObj->setCaObservaciones($this->ca_observaciones);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);


		$copyObj->setNew(true);

		$copyObj->setCaIdcontinuacion(NULL); // this is a auto-increment column, so set to default value

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
	 * @return     CotContinuacion Clone of current object.
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
	 * @return     CotContinuacionPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new CotContinuacionPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Cotizacion object.
	 *
	 * @param      Cotizacion $v
	 * @return     CotContinuacion The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setCotizacion(Cotizacion $v = null)
	{
		if ($v === null) {
			$this->setCaIdcotizacion(NULL);
		} else {
			$this->setCaIdcotizacion($v->getCaIdcotizacion());
		}

		$this->aCotizacion = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Cotizacion object, it will not be re-added.
		if ($v !== null) {
			$v->addCotContinuacion($this);
		}

		return $this;
	}


	/**
	 * Get the associated Cotizacion object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Cotizacion The associated Cotizacion object.
	 * @throws     PropelException
	 */
	public function getCotizacion(PropelPDO $con = null)
	{
		if ($this->aCotizacion === null && ($this->ca_idcotizacion !== null)) {
			$c = new Criteria(CotizacionPeer::DATABASE_NAME);
			$c->add(CotizacionPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);
			$this->aCotizacion = CotizacionPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aCotizacion->addCotContinuacions($this);
			 */
		}
		return $this->aCotizacion;
	}

	/**
	 * Declares an association between this object and a Concepto object.
	 *
	 * @param      Concepto $v
	 * @return     CotContinuacion The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setConcepto(Concepto $v = null)
	{
		if ($v === null) {
			$this->setCaIdconcepto(NULL);
		} else {
			$this->setCaIdconcepto($v->getCaIdconcepto());
		}

		$this->aConcepto = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Concepto object, it will not be re-added.
		if ($v !== null) {
			$v->addCotContinuacion($this);
		}

		return $this;
	}


	/**
	 * Get the associated Concepto object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Concepto The associated Concepto object.
	 * @throws     PropelException
	 */
	public function getConcepto(PropelPDO $con = null)
	{
		if ($this->aConcepto === null && ($this->ca_idconcepto !== null)) {
			$c = new Criteria(ConceptoPeer::DATABASE_NAME);
			$c->add(ConceptoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);
			$this->aConcepto = ConceptoPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aConcepto->addCotContinuacions($this);
			 */
		}
		return $this->aConcepto;
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
		} // if ($deep)

			$this->aCotizacion = null;
			$this->aConcepto = null;
	}

} // BaseCotContinuacion
