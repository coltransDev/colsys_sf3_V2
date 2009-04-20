<?php

/**
 * Base class that represents a row from the 'tb_inocontratos_sea' table.
 *
 * 
 *
 * @package    lib.model.sea.om
 */
abstract class BaseInoContratosSea extends BaseObject  implements Persistent {


  const PEER = 'InoContratosSeaPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        InoContratosSeaPeer
	 */
	protected static $peer;

	/**
	 * The value for the ca_referencia field.
	 * @var        string
	 */
	protected $ca_referencia;

	/**
	 * The value for the ca_idequipo field.
	 * @var        int
	 */
	protected $ca_idequipo;

	/**
	 * The value for the ca_idcontrato field.
	 * @var        string
	 */
	protected $ca_idcontrato;

	/**
	 * The value for the ca_fchcontrato field.
	 * @var        string
	 */
	protected $ca_fchcontrato;

	/**
	 * The value for the ca_inspeccion_nta field.
	 * @var        string
	 */
	protected $ca_inspeccion_nta;

	/**
	 * The value for the ca_inspeccion_fch field.
	 * @var        string
	 */
	protected $ca_inspeccion_fch;

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
	 * @var        InoEquiposSea
	 */
	protected $aInoEquiposSea;

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
	 * Initializes internal state of BaseInoContratosSea object.
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
	 * Get the [ca_referencia] column value.
	 * 
	 * @return     string
	 */
	public function getCaReferencia()
	{
		return $this->ca_referencia;
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
	 * Get the [ca_idcontrato] column value.
	 * 
	 * @return     string
	 */
	public function getCaIdcontrato()
	{
		return $this->ca_idcontrato;
	}

	/**
	 * Get the [optionally formatted] temporal [ca_fchcontrato] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaFchcontrato($format = 'Y-m-d')
	{
		if ($this->ca_fchcontrato === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchcontrato);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchcontrato, true), $x);
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
	 * Get the [ca_inspeccion_nta] column value.
	 * 
	 * @return     string
	 */
	public function getCaInspeccionNta()
	{
		return $this->ca_inspeccion_nta;
	}

	/**
	 * Get the [optionally formatted] temporal [ca_inspeccion_fch] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaInspeccionFch($format = 'Y-m-d')
	{
		if ($this->ca_inspeccion_fch === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_inspeccion_fch);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_inspeccion_fch, true), $x);
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
	 * Set the value of [ca_referencia] column.
	 * 
	 * @param      string $v new value
	 * @return     InoContratosSea The current object (for fluent API support)
	 */
	public function setCaReferencia($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_referencia !== $v) {
			$this->ca_referencia = $v;
			$this->modifiedColumns[] = InoContratosSeaPeer::CA_REFERENCIA;
		}

		if ($this->aInoEquiposSea !== null && $this->aInoEquiposSea->getCaReferencia() !== $v) {
			$this->aInoEquiposSea = null;
		}

		return $this;
	} // setCaReferencia()

	/**
	 * Set the value of [ca_idequipo] column.
	 * 
	 * @param      int $v new value
	 * @return     InoContratosSea The current object (for fluent API support)
	 */
	public function setCaIdequipo($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idequipo !== $v) {
			$this->ca_idequipo = $v;
			$this->modifiedColumns[] = InoContratosSeaPeer::CA_IDEQUIPO;
		}

		if ($this->aInoEquiposSea !== null && $this->aInoEquiposSea->getCaIdequipo() !== $v) {
			$this->aInoEquiposSea = null;
		}

		return $this;
	} // setCaIdequipo()

	/**
	 * Set the value of [ca_idcontrato] column.
	 * 
	 * @param      string $v new value
	 * @return     InoContratosSea The current object (for fluent API support)
	 */
	public function setCaIdcontrato($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idcontrato !== $v) {
			$this->ca_idcontrato = $v;
			$this->modifiedColumns[] = InoContratosSeaPeer::CA_IDCONTRATO;
		}

		return $this;
	} // setCaIdcontrato()

	/**
	 * Sets the value of [ca_fchcontrato] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     InoContratosSea The current object (for fluent API support)
	 */
	public function setCaFchcontrato($v)
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

		if ( $this->ca_fchcontrato !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fchcontrato !== null && $tmpDt = new DateTime($this->ca_fchcontrato)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchcontrato = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = InoContratosSeaPeer::CA_FCHCONTRATO;
			}
		} // if either are not null

		return $this;
	} // setCaFchcontrato()

	/**
	 * Set the value of [ca_inspeccion_nta] column.
	 * 
	 * @param      string $v new value
	 * @return     InoContratosSea The current object (for fluent API support)
	 */
	public function setCaInspeccionNta($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_inspeccion_nta !== $v) {
			$this->ca_inspeccion_nta = $v;
			$this->modifiedColumns[] = InoContratosSeaPeer::CA_INSPECCION_NTA;
		}

		return $this;
	} // setCaInspeccionNta()

	/**
	 * Sets the value of [ca_inspeccion_fch] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     InoContratosSea The current object (for fluent API support)
	 */
	public function setCaInspeccionFch($v)
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

		if ( $this->ca_inspeccion_fch !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_inspeccion_fch !== null && $tmpDt = new DateTime($this->ca_inspeccion_fch)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_inspeccion_fch = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = InoContratosSeaPeer::CA_INSPECCION_FCH;
			}
		} // if either are not null

		return $this;
	} // setCaInspeccionFch()

	/**
	 * Set the value of [ca_observaciones] column.
	 * 
	 * @param      string $v new value
	 * @return     InoContratosSea The current object (for fluent API support)
	 */
	public function setCaObservaciones($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_observaciones !== $v) {
			$this->ca_observaciones = $v;
			$this->modifiedColumns[] = InoContratosSeaPeer::CA_OBSERVACIONES;
		}

		return $this;
	} // setCaObservaciones()

	/**
	 * Sets the value of [ca_fchcreado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     InoContratosSea The current object (for fluent API support)
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
				$this->modifiedColumns[] = InoContratosSeaPeer::CA_FCHCREADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchcreado()

	/**
	 * Set the value of [ca_usucreado] column.
	 * 
	 * @param      string $v new value
	 * @return     InoContratosSea The current object (for fluent API support)
	 */
	public function setCaUsucreado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usucreado !== $v) {
			$this->ca_usucreado = $v;
			$this->modifiedColumns[] = InoContratosSeaPeer::CA_USUCREADO;
		}

		return $this;
	} // setCaUsucreado()

	/**
	 * Sets the value of [ca_fchactualizado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     InoContratosSea The current object (for fluent API support)
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
				$this->modifiedColumns[] = InoContratosSeaPeer::CA_FCHACTUALIZADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchactualizado()

	/**
	 * Set the value of [ca_usuactualizado] column.
	 * 
	 * @param      string $v new value
	 * @return     InoContratosSea The current object (for fluent API support)
	 */
	public function setCaUsuactualizado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usuactualizado !== $v) {
			$this->ca_usuactualizado = $v;
			$this->modifiedColumns[] = InoContratosSeaPeer::CA_USUACTUALIZADO;
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

			$this->ca_referencia = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ca_idequipo = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_idcontrato = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_fchcontrato = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_inspeccion_nta = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_inspeccion_fch = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_observaciones = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_fchcreado = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_usucreado = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_fchactualizado = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_usuactualizado = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 11; // 11 = InoContratosSeaPeer::NUM_COLUMNS - InoContratosSeaPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating InoContratosSea object", $e);
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

		if ($this->aInoEquiposSea !== null && $this->ca_referencia !== $this->aInoEquiposSea->getCaReferencia()) {
			$this->aInoEquiposSea = null;
		}
		if ($this->aInoEquiposSea !== null && $this->ca_idequipo !== $this->aInoEquiposSea->getCaIdequipo()) {
			$this->aInoEquiposSea = null;
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
			$con = Propel::getConnection(InoContratosSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = InoContratosSeaPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aInoEquiposSea = null;
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
			$con = Propel::getConnection(InoContratosSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			InoContratosSeaPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(InoContratosSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			InoContratosSeaPeer::addInstanceToPool($this);
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

			if ($this->aInoEquiposSea !== null) {
				if ($this->aInoEquiposSea->isModified() || $this->aInoEquiposSea->isNew()) {
					$affectedRows += $this->aInoEquiposSea->save($con);
				}
				$this->setInoEquiposSea($this->aInoEquiposSea);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = InoContratosSeaPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += InoContratosSeaPeer::doUpdate($this, $con);
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

			if ($this->aInoEquiposSea !== null) {
				if (!$this->aInoEquiposSea->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aInoEquiposSea->getValidationFailures());
				}
			}


			if (($retval = InoContratosSeaPeer::doValidate($this, $columns)) !== true) {
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
		$pos = InoContratosSeaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaReferencia();
				break;
			case 1:
				return $this->getCaIdequipo();
				break;
			case 2:
				return $this->getCaIdcontrato();
				break;
			case 3:
				return $this->getCaFchcontrato();
				break;
			case 4:
				return $this->getCaInspeccionNta();
				break;
			case 5:
				return $this->getCaInspeccionFch();
				break;
			case 6:
				return $this->getCaObservaciones();
				break;
			case 7:
				return $this->getCaFchcreado();
				break;
			case 8:
				return $this->getCaUsucreado();
				break;
			case 9:
				return $this->getCaFchactualizado();
				break;
			case 10:
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
		$keys = InoContratosSeaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaReferencia(),
			$keys[1] => $this->getCaIdequipo(),
			$keys[2] => $this->getCaIdcontrato(),
			$keys[3] => $this->getCaFchcontrato(),
			$keys[4] => $this->getCaInspeccionNta(),
			$keys[5] => $this->getCaInspeccionFch(),
			$keys[6] => $this->getCaObservaciones(),
			$keys[7] => $this->getCaFchcreado(),
			$keys[8] => $this->getCaUsucreado(),
			$keys[9] => $this->getCaFchactualizado(),
			$keys[10] => $this->getCaUsuactualizado(),
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
		$pos = InoContratosSeaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaReferencia($value);
				break;
			case 1:
				$this->setCaIdequipo($value);
				break;
			case 2:
				$this->setCaIdcontrato($value);
				break;
			case 3:
				$this->setCaFchcontrato($value);
				break;
			case 4:
				$this->setCaInspeccionNta($value);
				break;
			case 5:
				$this->setCaInspeccionFch($value);
				break;
			case 6:
				$this->setCaObservaciones($value);
				break;
			case 7:
				$this->setCaFchcreado($value);
				break;
			case 8:
				$this->setCaUsucreado($value);
				break;
			case 9:
				$this->setCaFchactualizado($value);
				break;
			case 10:
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
		$keys = InoContratosSeaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaReferencia($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdequipo($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaIdcontrato($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaFchcontrato($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaInspeccionNta($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaInspeccionFch($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaObservaciones($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaFchcreado($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaUsucreado($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaFchactualizado($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaUsuactualizado($arr[$keys[10]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(InoContratosSeaPeer::DATABASE_NAME);

		if ($this->isColumnModified(InoContratosSeaPeer::CA_REFERENCIA)) $criteria->add(InoContratosSeaPeer::CA_REFERENCIA, $this->ca_referencia);
		if ($this->isColumnModified(InoContratosSeaPeer::CA_IDEQUIPO)) $criteria->add(InoContratosSeaPeer::CA_IDEQUIPO, $this->ca_idequipo);
		if ($this->isColumnModified(InoContratosSeaPeer::CA_IDCONTRATO)) $criteria->add(InoContratosSeaPeer::CA_IDCONTRATO, $this->ca_idcontrato);
		if ($this->isColumnModified(InoContratosSeaPeer::CA_FCHCONTRATO)) $criteria->add(InoContratosSeaPeer::CA_FCHCONTRATO, $this->ca_fchcontrato);
		if ($this->isColumnModified(InoContratosSeaPeer::CA_INSPECCION_NTA)) $criteria->add(InoContratosSeaPeer::CA_INSPECCION_NTA, $this->ca_inspeccion_nta);
		if ($this->isColumnModified(InoContratosSeaPeer::CA_INSPECCION_FCH)) $criteria->add(InoContratosSeaPeer::CA_INSPECCION_FCH, $this->ca_inspeccion_fch);
		if ($this->isColumnModified(InoContratosSeaPeer::CA_OBSERVACIONES)) $criteria->add(InoContratosSeaPeer::CA_OBSERVACIONES, $this->ca_observaciones);
		if ($this->isColumnModified(InoContratosSeaPeer::CA_FCHCREADO)) $criteria->add(InoContratosSeaPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(InoContratosSeaPeer::CA_USUCREADO)) $criteria->add(InoContratosSeaPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(InoContratosSeaPeer::CA_FCHACTUALIZADO)) $criteria->add(InoContratosSeaPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(InoContratosSeaPeer::CA_USUACTUALIZADO)) $criteria->add(InoContratosSeaPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);

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
		$criteria = new Criteria(InoContratosSeaPeer::DATABASE_NAME);

		$criteria->add(InoContratosSeaPeer::CA_REFERENCIA, $this->ca_referencia);
		$criteria->add(InoContratosSeaPeer::CA_IDEQUIPO, $this->ca_idequipo);

		return $criteria;
	}

	/**
	 * Returns the composite primary key for this object.
	 * The array elements will be in same order as specified in XML.
	 * @return     array
	 */
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getCaReferencia();

		$pks[1] = $this->getCaIdequipo();

		return $pks;
	}

	/**
	 * Set the [composite] primary key.
	 *
	 * @param      array $keys The elements of the composite key (order must match the order in XML file).
	 * @return     void
	 */
	public function setPrimaryKey($keys)
	{

		$this->setCaReferencia($keys[0]);

		$this->setCaIdequipo($keys[1]);

	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of InoContratosSea (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaReferencia($this->ca_referencia);

		$copyObj->setCaIdequipo($this->ca_idequipo);

		$copyObj->setCaIdcontrato($this->ca_idcontrato);

		$copyObj->setCaFchcontrato($this->ca_fchcontrato);

		$copyObj->setCaInspeccionNta($this->ca_inspeccion_nta);

		$copyObj->setCaInspeccionFch($this->ca_inspeccion_fch);

		$copyObj->setCaObservaciones($this->ca_observaciones);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);


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
	 * @return     InoContratosSea Clone of current object.
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
	 * @return     InoContratosSeaPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new InoContratosSeaPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a InoEquiposSea object.
	 *
	 * @param      InoEquiposSea $v
	 * @return     InoContratosSea The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setInoEquiposSea(InoEquiposSea $v = null)
	{
		if ($v === null) {
			$this->setCaReferencia(NULL);
		} else {
			$this->setCaReferencia($v->getCaReferencia());
		}

		if ($v === null) {
			$this->setCaIdequipo(NULL);
		} else {
			$this->setCaIdequipo($v->getCaIdequipo());
		}

		$this->aInoEquiposSea = $v;

		// Add binding for other direction of this 1:1 relationship.
		if ($v !== null) {
			$v->setInoContratosSea($this);
		}

		return $this;
	}


	/**
	 * Get the associated InoEquiposSea object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     InoEquiposSea The associated InoEquiposSea object.
	 * @throws     PropelException
	 */
	public function getInoEquiposSea(PropelPDO $con = null)
	{
		if ($this->aInoEquiposSea === null && (($this->ca_referencia !== "" && $this->ca_referencia !== null) && $this->ca_idequipo !== null)) {
			$c = new Criteria(InoEquiposSeaPeer::DATABASE_NAME);
			$c->add(InoEquiposSeaPeer::CA_REFERENCIA, $this->ca_referencia);
			$c->add(InoEquiposSeaPeer::CA_IDEQUIPO, $this->ca_idequipo);
			$this->aInoEquiposSea = InoEquiposSeaPeer::doSelectOne($c, $con);
			// Because this foreign key represents a one-to-one relationship, we will create a bi-directional association.
			$this->aInoEquiposSea->setInoContratosSea($this);
		}
		return $this->aInoEquiposSea;
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

			$this->aInoEquiposSea = null;
	}

} // BaseInoContratosSea
