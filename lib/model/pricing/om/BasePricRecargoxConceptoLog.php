<?php

/**
 * Base class that represents a row from the 'bs_pricrecargosxconcepto' table.
 *
 * 
 *
 * @package    lib.model.pricing.om
 */
abstract class BasePricRecargoxConceptoLog extends BaseObject  implements Persistent {


  const PEER = 'PricRecargoxConceptoLogPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        PricRecargoxConceptoLogPeer
	 */
	protected static $peer;

	/**
	 * The value for the ca_idtrayecto field.
	 * @var        int
	 */
	protected $ca_idtrayecto;

	/**
	 * The value for the ca_idconcepto field.
	 * @var        int
	 */
	protected $ca_idconcepto;

	/**
	 * The value for the ca_idrecargo field.
	 * @var        int
	 */
	protected $ca_idrecargo;

	/**
	 * The value for the ca_vlrrecargo field.
	 * @var        string
	 */
	protected $ca_vlrrecargo;

	/**
	 * The value for the ca_aplicacion field.
	 * @var        string
	 */
	protected $ca_aplicacion;

	/**
	 * The value for the ca_vlrminimo field.
	 * @var        string
	 */
	protected $ca_vlrminimo;

	/**
	 * The value for the ca_aplicacion_min field.
	 * @var        string
	 */
	protected $ca_aplicacion_min;

	/**
	 * The value for the ca_observaciones field.
	 * @var        string
	 */
	protected $ca_observaciones;

	/**
	 * The value for the ca_idmoneda field.
	 * @var        string
	 */
	protected $ca_idmoneda;

	/**
	 * The value for the ca_fchinicio field.
	 * @var        string
	 */
	protected $ca_fchinicio;

	/**
	 * The value for the ca_fchvencimiento field.
	 * @var        string
	 */
	protected $ca_fchvencimiento;

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
	 * The value for the ca_consecutivo field.
	 * @var        int
	 */
	protected $ca_consecutivo;

	/**
	 * @var        PricFlete
	 */
	protected $aPricFlete;

	/**
	 * @var        TipoRecargo
	 */
	protected $aTipoRecargo;

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
	 * Initializes internal state of BasePricRecargoxConceptoLog object.
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
	 * Get the [ca_idtrayecto] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdtrayecto()
	{
		return $this->ca_idtrayecto;
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
	 * Get the [ca_idrecargo] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdrecargo()
	{
		return $this->ca_idrecargo;
	}

	/**
	 * Get the [ca_vlrrecargo] column value.
	 * 
	 * @return     string
	 */
	public function getCaVlrrecargo()
	{
		return $this->ca_vlrrecargo;
	}

	/**
	 * Get the [ca_aplicacion] column value.
	 * 
	 * @return     string
	 */
	public function getCaAplicacion()
	{
		return $this->ca_aplicacion;
	}

	/**
	 * Get the [ca_vlrminimo] column value.
	 * 
	 * @return     string
	 */
	public function getCaVlrminimo()
	{
		return $this->ca_vlrminimo;
	}

	/**
	 * Get the [ca_aplicacion_min] column value.
	 * 
	 * @return     string
	 */
	public function getCaAplicacionMin()
	{
		return $this->ca_aplicacion_min;
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
	 * Get the [ca_idmoneda] column value.
	 * 
	 * @return     string
	 */
	public function getCaIdmoneda()
	{
		return $this->ca_idmoneda;
	}

	/**
	 * Get the [optionally formatted] temporal [ca_fchinicio] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaFchinicio($format = 'Y-m-d')
	{
		if ($this->ca_fchinicio === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchinicio);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchinicio, true), $x);
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
	 * Get the [optionally formatted] temporal [ca_fchvencimiento] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaFchvencimiento($format = 'Y-m-d')
	{
		if ($this->ca_fchvencimiento === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchvencimiento);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchvencimiento, true), $x);
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
	 * Get the [ca_consecutivo] column value.
	 * 
	 * @return     int
	 */
	public function getCaConsecutivo()
	{
		return $this->ca_consecutivo;
	}

	/**
	 * Set the value of [ca_idtrayecto] column.
	 * 
	 * @param      int $v new value
	 * @return     PricRecargoxConceptoLog The current object (for fluent API support)
	 */
	public function setCaIdtrayecto($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idtrayecto !== $v) {
			$this->ca_idtrayecto = $v;
			$this->modifiedColumns[] = PricRecargoxConceptoLogPeer::CA_IDTRAYECTO;
		}

		if ($this->aPricFlete !== null && $this->aPricFlete->getCaIdtrayecto() !== $v) {
			$this->aPricFlete = null;
		}

		return $this;
	} // setCaIdtrayecto()

	/**
	 * Set the value of [ca_idconcepto] column.
	 * 
	 * @param      int $v new value
	 * @return     PricRecargoxConceptoLog The current object (for fluent API support)
	 */
	public function setCaIdconcepto($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idconcepto !== $v) {
			$this->ca_idconcepto = $v;
			$this->modifiedColumns[] = PricRecargoxConceptoLogPeer::CA_IDCONCEPTO;
		}

		if ($this->aPricFlete !== null && $this->aPricFlete->getCaIdconcepto() !== $v) {
			$this->aPricFlete = null;
		}

		return $this;
	} // setCaIdconcepto()

	/**
	 * Set the value of [ca_idrecargo] column.
	 * 
	 * @param      int $v new value
	 * @return     PricRecargoxConceptoLog The current object (for fluent API support)
	 */
	public function setCaIdrecargo($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idrecargo !== $v) {
			$this->ca_idrecargo = $v;
			$this->modifiedColumns[] = PricRecargoxConceptoLogPeer::CA_IDRECARGO;
		}

		if ($this->aTipoRecargo !== null && $this->aTipoRecargo->getCaIdrecargo() !== $v) {
			$this->aTipoRecargo = null;
		}

		return $this;
	} // setCaIdrecargo()

	/**
	 * Set the value of [ca_vlrrecargo] column.
	 * 
	 * @param      string $v new value
	 * @return     PricRecargoxConceptoLog The current object (for fluent API support)
	 */
	public function setCaVlrrecargo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_vlrrecargo !== $v) {
			$this->ca_vlrrecargo = $v;
			$this->modifiedColumns[] = PricRecargoxConceptoLogPeer::CA_VLRRECARGO;
		}

		return $this;
	} // setCaVlrrecargo()

	/**
	 * Set the value of [ca_aplicacion] column.
	 * 
	 * @param      string $v new value
	 * @return     PricRecargoxConceptoLog The current object (for fluent API support)
	 */
	public function setCaAplicacion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_aplicacion !== $v) {
			$this->ca_aplicacion = $v;
			$this->modifiedColumns[] = PricRecargoxConceptoLogPeer::CA_APLICACION;
		}

		return $this;
	} // setCaAplicacion()

	/**
	 * Set the value of [ca_vlrminimo] column.
	 * 
	 * @param      string $v new value
	 * @return     PricRecargoxConceptoLog The current object (for fluent API support)
	 */
	public function setCaVlrminimo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_vlrminimo !== $v) {
			$this->ca_vlrminimo = $v;
			$this->modifiedColumns[] = PricRecargoxConceptoLogPeer::CA_VLRMINIMO;
		}

		return $this;
	} // setCaVlrminimo()

	/**
	 * Set the value of [ca_aplicacion_min] column.
	 * 
	 * @param      string $v new value
	 * @return     PricRecargoxConceptoLog The current object (for fluent API support)
	 */
	public function setCaAplicacionMin($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_aplicacion_min !== $v) {
			$this->ca_aplicacion_min = $v;
			$this->modifiedColumns[] = PricRecargoxConceptoLogPeer::CA_APLICACION_MIN;
		}

		return $this;
	} // setCaAplicacionMin()

	/**
	 * Set the value of [ca_observaciones] column.
	 * 
	 * @param      string $v new value
	 * @return     PricRecargoxConceptoLog The current object (for fluent API support)
	 */
	public function setCaObservaciones($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_observaciones !== $v) {
			$this->ca_observaciones = $v;
			$this->modifiedColumns[] = PricRecargoxConceptoLogPeer::CA_OBSERVACIONES;
		}

		return $this;
	} // setCaObservaciones()

	/**
	 * Set the value of [ca_idmoneda] column.
	 * 
	 * @param      string $v new value
	 * @return     PricRecargoxConceptoLog The current object (for fluent API support)
	 */
	public function setCaIdmoneda($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idmoneda !== $v) {
			$this->ca_idmoneda = $v;
			$this->modifiedColumns[] = PricRecargoxConceptoLogPeer::CA_IDMONEDA;
		}

		return $this;
	} // setCaIdmoneda()

	/**
	 * Sets the value of [ca_fchinicio] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     PricRecargoxConceptoLog The current object (for fluent API support)
	 */
	public function setCaFchinicio($v)
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

		if ( $this->ca_fchinicio !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fchinicio !== null && $tmpDt = new DateTime($this->ca_fchinicio)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchinicio = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = PricRecargoxConceptoLogPeer::CA_FCHINICIO;
			}
		} // if either are not null

		return $this;
	} // setCaFchinicio()

	/**
	 * Sets the value of [ca_fchvencimiento] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     PricRecargoxConceptoLog The current object (for fluent API support)
	 */
	public function setCaFchvencimiento($v)
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

		if ( $this->ca_fchvencimiento !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fchvencimiento !== null && $tmpDt = new DateTime($this->ca_fchvencimiento)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchvencimiento = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = PricRecargoxConceptoLogPeer::CA_FCHVENCIMIENTO;
			}
		} // if either are not null

		return $this;
	} // setCaFchvencimiento()

	/**
	 * Sets the value of [ca_fchcreado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     PricRecargoxConceptoLog The current object (for fluent API support)
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
				$this->modifiedColumns[] = PricRecargoxConceptoLogPeer::CA_FCHCREADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchcreado()

	/**
	 * Set the value of [ca_usucreado] column.
	 * 
	 * @param      string $v new value
	 * @return     PricRecargoxConceptoLog The current object (for fluent API support)
	 */
	public function setCaUsucreado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usucreado !== $v) {
			$this->ca_usucreado = $v;
			$this->modifiedColumns[] = PricRecargoxConceptoLogPeer::CA_USUCREADO;
		}

		return $this;
	} // setCaUsucreado()

	/**
	 * Set the value of [ca_consecutivo] column.
	 * 
	 * @param      int $v new value
	 * @return     PricRecargoxConceptoLog The current object (for fluent API support)
	 */
	public function setCaConsecutivo($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_consecutivo !== $v) {
			$this->ca_consecutivo = $v;
			$this->modifiedColumns[] = PricRecargoxConceptoLogPeer::CA_CONSECUTIVO;
		}

		return $this;
	} // setCaConsecutivo()

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

			$this->ca_idtrayecto = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_idconcepto = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_idrecargo = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->ca_vlrrecargo = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_aplicacion = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_vlrminimo = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_aplicacion_min = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_observaciones = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_idmoneda = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_fchinicio = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_fchvencimiento = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_fchcreado = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_usucreado = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_consecutivo = ($row[$startcol + 13] !== null) ? (int) $row[$startcol + 13] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 14; // 14 = PricRecargoxConceptoLogPeer::NUM_COLUMNS - PricRecargoxConceptoLogPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating PricRecargoxConceptoLog object", $e);
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

		if ($this->aPricFlete !== null && $this->ca_idtrayecto !== $this->aPricFlete->getCaIdtrayecto()) {
			$this->aPricFlete = null;
		}
		if ($this->aPricFlete !== null && $this->ca_idconcepto !== $this->aPricFlete->getCaIdconcepto()) {
			$this->aPricFlete = null;
		}
		if ($this->aTipoRecargo !== null && $this->ca_idrecargo !== $this->aTipoRecargo->getCaIdrecargo()) {
			$this->aTipoRecargo = null;
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
			$con = Propel::getConnection(PricRecargoxConceptoLogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = PricRecargoxConceptoLogPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aPricFlete = null;
			$this->aTipoRecargo = null;
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
			$con = Propel::getConnection(PricRecargoxConceptoLogPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			PricRecargoxConceptoLogPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(PricRecargoxConceptoLogPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			PricRecargoxConceptoLogPeer::addInstanceToPool($this);
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

			if ($this->aPricFlete !== null) {
				if ($this->aPricFlete->isModified() || $this->aPricFlete->isNew()) {
					$affectedRows += $this->aPricFlete->save($con);
				}
				$this->setPricFlete($this->aPricFlete);
			}

			if ($this->aTipoRecargo !== null) {
				if ($this->aTipoRecargo->isModified() || $this->aTipoRecargo->isNew()) {
					$affectedRows += $this->aTipoRecargo->save($con);
				}
				$this->setTipoRecargo($this->aTipoRecargo);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = PricRecargoxConceptoLogPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += PricRecargoxConceptoLogPeer::doUpdate($this, $con);
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

			if ($this->aPricFlete !== null) {
				if (!$this->aPricFlete->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPricFlete->getValidationFailures());
				}
			}

			if ($this->aTipoRecargo !== null) {
				if (!$this->aTipoRecargo->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTipoRecargo->getValidationFailures());
				}
			}


			if (($retval = PricRecargoxConceptoLogPeer::doValidate($this, $columns)) !== true) {
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
		$pos = PricRecargoxConceptoLogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdtrayecto();
				break;
			case 1:
				return $this->getCaIdconcepto();
				break;
			case 2:
				return $this->getCaIdrecargo();
				break;
			case 3:
				return $this->getCaVlrrecargo();
				break;
			case 4:
				return $this->getCaAplicacion();
				break;
			case 5:
				return $this->getCaVlrminimo();
				break;
			case 6:
				return $this->getCaAplicacionMin();
				break;
			case 7:
				return $this->getCaObservaciones();
				break;
			case 8:
				return $this->getCaIdmoneda();
				break;
			case 9:
				return $this->getCaFchinicio();
				break;
			case 10:
				return $this->getCaFchvencimiento();
				break;
			case 11:
				return $this->getCaFchcreado();
				break;
			case 12:
				return $this->getCaUsucreado();
				break;
			case 13:
				return $this->getCaConsecutivo();
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
		$keys = PricRecargoxConceptoLogPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdtrayecto(),
			$keys[1] => $this->getCaIdconcepto(),
			$keys[2] => $this->getCaIdrecargo(),
			$keys[3] => $this->getCaVlrrecargo(),
			$keys[4] => $this->getCaAplicacion(),
			$keys[5] => $this->getCaVlrminimo(),
			$keys[6] => $this->getCaAplicacionMin(),
			$keys[7] => $this->getCaObservaciones(),
			$keys[8] => $this->getCaIdmoneda(),
			$keys[9] => $this->getCaFchinicio(),
			$keys[10] => $this->getCaFchvencimiento(),
			$keys[11] => $this->getCaFchcreado(),
			$keys[12] => $this->getCaUsucreado(),
			$keys[13] => $this->getCaConsecutivo(),
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
		$pos = PricRecargoxConceptoLogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdtrayecto($value);
				break;
			case 1:
				$this->setCaIdconcepto($value);
				break;
			case 2:
				$this->setCaIdrecargo($value);
				break;
			case 3:
				$this->setCaVlrrecargo($value);
				break;
			case 4:
				$this->setCaAplicacion($value);
				break;
			case 5:
				$this->setCaVlrminimo($value);
				break;
			case 6:
				$this->setCaAplicacionMin($value);
				break;
			case 7:
				$this->setCaObservaciones($value);
				break;
			case 8:
				$this->setCaIdmoneda($value);
				break;
			case 9:
				$this->setCaFchinicio($value);
				break;
			case 10:
				$this->setCaFchvencimiento($value);
				break;
			case 11:
				$this->setCaFchcreado($value);
				break;
			case 12:
				$this->setCaUsucreado($value);
				break;
			case 13:
				$this->setCaConsecutivo($value);
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
		$keys = PricRecargoxConceptoLogPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdtrayecto($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdconcepto($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaIdrecargo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaVlrrecargo($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaAplicacion($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaVlrminimo($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaAplicacionMin($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaObservaciones($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaIdmoneda($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaFchinicio($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaFchvencimiento($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaFchcreado($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaUsucreado($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaConsecutivo($arr[$keys[13]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(PricRecargoxConceptoLogPeer::DATABASE_NAME);

		if ($this->isColumnModified(PricRecargoxConceptoLogPeer::CA_IDTRAYECTO)) $criteria->add(PricRecargoxConceptoLogPeer::CA_IDTRAYECTO, $this->ca_idtrayecto);
		if ($this->isColumnModified(PricRecargoxConceptoLogPeer::CA_IDCONCEPTO)) $criteria->add(PricRecargoxConceptoLogPeer::CA_IDCONCEPTO, $this->ca_idconcepto);
		if ($this->isColumnModified(PricRecargoxConceptoLogPeer::CA_IDRECARGO)) $criteria->add(PricRecargoxConceptoLogPeer::CA_IDRECARGO, $this->ca_idrecargo);
		if ($this->isColumnModified(PricRecargoxConceptoLogPeer::CA_VLRRECARGO)) $criteria->add(PricRecargoxConceptoLogPeer::CA_VLRRECARGO, $this->ca_vlrrecargo);
		if ($this->isColumnModified(PricRecargoxConceptoLogPeer::CA_APLICACION)) $criteria->add(PricRecargoxConceptoLogPeer::CA_APLICACION, $this->ca_aplicacion);
		if ($this->isColumnModified(PricRecargoxConceptoLogPeer::CA_VLRMINIMO)) $criteria->add(PricRecargoxConceptoLogPeer::CA_VLRMINIMO, $this->ca_vlrminimo);
		if ($this->isColumnModified(PricRecargoxConceptoLogPeer::CA_APLICACION_MIN)) $criteria->add(PricRecargoxConceptoLogPeer::CA_APLICACION_MIN, $this->ca_aplicacion_min);
		if ($this->isColumnModified(PricRecargoxConceptoLogPeer::CA_OBSERVACIONES)) $criteria->add(PricRecargoxConceptoLogPeer::CA_OBSERVACIONES, $this->ca_observaciones);
		if ($this->isColumnModified(PricRecargoxConceptoLogPeer::CA_IDMONEDA)) $criteria->add(PricRecargoxConceptoLogPeer::CA_IDMONEDA, $this->ca_idmoneda);
		if ($this->isColumnModified(PricRecargoxConceptoLogPeer::CA_FCHINICIO)) $criteria->add(PricRecargoxConceptoLogPeer::CA_FCHINICIO, $this->ca_fchinicio);
		if ($this->isColumnModified(PricRecargoxConceptoLogPeer::CA_FCHVENCIMIENTO)) $criteria->add(PricRecargoxConceptoLogPeer::CA_FCHVENCIMIENTO, $this->ca_fchvencimiento);
		if ($this->isColumnModified(PricRecargoxConceptoLogPeer::CA_FCHCREADO)) $criteria->add(PricRecargoxConceptoLogPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(PricRecargoxConceptoLogPeer::CA_USUCREADO)) $criteria->add(PricRecargoxConceptoLogPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(PricRecargoxConceptoLogPeer::CA_CONSECUTIVO)) $criteria->add(PricRecargoxConceptoLogPeer::CA_CONSECUTIVO, $this->ca_consecutivo);

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
		$criteria = new Criteria(PricRecargoxConceptoLogPeer::DATABASE_NAME);

		$criteria->add(PricRecargoxConceptoLogPeer::CA_CONSECUTIVO, $this->ca_consecutivo);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCaConsecutivo();
	}

	/**
	 * Generic method to set the primary key (ca_consecutivo column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaConsecutivo($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of PricRecargoxConceptoLog (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdtrayecto($this->ca_idtrayecto);

		$copyObj->setCaIdconcepto($this->ca_idconcepto);

		$copyObj->setCaIdrecargo($this->ca_idrecargo);

		$copyObj->setCaVlrrecargo($this->ca_vlrrecargo);

		$copyObj->setCaAplicacion($this->ca_aplicacion);

		$copyObj->setCaVlrminimo($this->ca_vlrminimo);

		$copyObj->setCaAplicacionMin($this->ca_aplicacion_min);

		$copyObj->setCaObservaciones($this->ca_observaciones);

		$copyObj->setCaIdmoneda($this->ca_idmoneda);

		$copyObj->setCaFchinicio($this->ca_fchinicio);

		$copyObj->setCaFchvencimiento($this->ca_fchvencimiento);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaConsecutivo($this->ca_consecutivo);


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
	 * @return     PricRecargoxConceptoLog Clone of current object.
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
	 * @return     PricRecargoxConceptoLogPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new PricRecargoxConceptoLogPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a PricFlete object.
	 *
	 * @param      PricFlete $v
	 * @return     PricRecargoxConceptoLog The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setPricFlete(PricFlete $v = null)
	{
		if ($v === null) {
			$this->setCaIdtrayecto(NULL);
		} else {
			$this->setCaIdtrayecto($v->getCaIdtrayecto());
		}

		if ($v === null) {
			$this->setCaIdconcepto(NULL);
		} else {
			$this->setCaIdconcepto($v->getCaIdconcepto());
		}

		$this->aPricFlete = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the PricFlete object, it will not be re-added.
		if ($v !== null) {
			$v->addPricRecargoxConceptoLog($this);
		}

		return $this;
	}


	/**
	 * Get the associated PricFlete object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     PricFlete The associated PricFlete object.
	 * @throws     PropelException
	 */
	public function getPricFlete(PropelPDO $con = null)
	{
		if ($this->aPricFlete === null && ($this->ca_idtrayecto !== null && $this->ca_idconcepto !== null)) {
			$c = new Criteria(PricFletePeer::DATABASE_NAME);
			$c->add(PricFletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);
			$c->add(PricFletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);
			$this->aPricFlete = PricFletePeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aPricFlete->addPricRecargoxConceptoLogs($this);
			 */
		}
		return $this->aPricFlete;
	}

	/**
	 * Declares an association between this object and a TipoRecargo object.
	 *
	 * @param      TipoRecargo $v
	 * @return     PricRecargoxConceptoLog The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setTipoRecargo(TipoRecargo $v = null)
	{
		if ($v === null) {
			$this->setCaIdrecargo(NULL);
		} else {
			$this->setCaIdrecargo($v->getCaIdrecargo());
		}

		$this->aTipoRecargo = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the TipoRecargo object, it will not be re-added.
		if ($v !== null) {
			$v->addPricRecargoxConceptoLog($this);
		}

		return $this;
	}


	/**
	 * Get the associated TipoRecargo object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     TipoRecargo The associated TipoRecargo object.
	 * @throws     PropelException
	 */
	public function getTipoRecargo(PropelPDO $con = null)
	{
		if ($this->aTipoRecargo === null && ($this->ca_idrecargo !== null)) {
			$c = new Criteria(TipoRecargoPeer::DATABASE_NAME);
			$c->add(TipoRecargoPeer::CA_IDRECARGO, $this->ca_idrecargo);
			$this->aTipoRecargo = TipoRecargoPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aTipoRecargo->addPricRecargoxConceptoLogs($this);
			 */
		}
		return $this->aTipoRecargo;
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

			$this->aPricFlete = null;
			$this->aTipoRecargo = null;
	}

} // BasePricRecargoxConceptoLog
