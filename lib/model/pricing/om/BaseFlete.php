<?php

/**
 * Base class that represents a row from the 'tb_fletes' table.
 *
 * 
 *
 * @package    lib.model.pricing.om
 */
abstract class BaseFlete extends BaseObject  implements Persistent {


  const PEER = 'FletePeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        FletePeer
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
	 * The value for the ca_vlrneto field.
	 * @var        string
	 */
	protected $ca_vlrneto;

	/**
	 * The value for the ca_vlrminimo field.
	 * @var        string
	 */
	protected $ca_vlrminimo;

	/**
	 * The value for the ca_fleteminimo field.
	 * @var        string
	 */
	protected $ca_fleteminimo;

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
	 * The value for the ca_idmoneda field.
	 * @var        string
	 */
	protected $ca_idmoneda;

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
	 * The value for the ca_sugerida field.
	 * @var        string
	 */
	protected $ca_sugerida;

	/**
	 * The value for the ca_mantenimiento field.
	 * @var        string
	 */
	protected $ca_mantenimiento;

	/**
	 * @var        Trayecto
	 */
	protected $aTrayecto;

	/**
	 * @var        Concepto
	 */
	protected $aConcepto;

	/**
	 * @var        array RecargoFlete[] Collection to store aggregation of RecargoFlete objects.
	 */
	protected $collRecargoFletes;

	/**
	 * @var        Criteria The criteria used to select the current contents of collRecargoFletes.
	 */
	private $lastRecargoFleteCriteria = null;

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
	 * Initializes internal state of BaseFlete object.
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
	 * Get the [ca_vlrneto] column value.
	 * 
	 * @return     string
	 */
	public function getCaVlrneto()
	{
		return $this->ca_vlrneto;
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
	 * Get the [ca_fleteminimo] column value.
	 * 
	 * @return     string
	 */
	public function getCaFleteminimo()
	{
		return $this->ca_fleteminimo;
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
	 * Get the [ca_idmoneda] column value.
	 * 
	 * @return     string
	 */
	public function getCaIdmoneda()
	{
		return $this->ca_idmoneda;
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
	 * Get the [ca_sugerida] column value.
	 * 
	 * @return     string
	 */
	public function getCaSugerida()
	{
		return $this->ca_sugerida;
	}

	/**
	 * Get the [ca_mantenimiento] column value.
	 * 
	 * @return     string
	 */
	public function getCaMantenimiento()
	{
		return $this->ca_mantenimiento;
	}

	/**
	 * Set the value of [ca_idtrayecto] column.
	 * 
	 * @param      int $v new value
	 * @return     Flete The current object (for fluent API support)
	 */
	public function setCaIdtrayecto($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idtrayecto !== $v) {
			$this->ca_idtrayecto = $v;
			$this->modifiedColumns[] = FletePeer::CA_IDTRAYECTO;
		}

		if ($this->aTrayecto !== null && $this->aTrayecto->getCaIdtrayecto() !== $v) {
			$this->aTrayecto = null;
		}

		return $this;
	} // setCaIdtrayecto()

	/**
	 * Set the value of [ca_idconcepto] column.
	 * 
	 * @param      int $v new value
	 * @return     Flete The current object (for fluent API support)
	 */
	public function setCaIdconcepto($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idconcepto !== $v) {
			$this->ca_idconcepto = $v;
			$this->modifiedColumns[] = FletePeer::CA_IDCONCEPTO;
		}

		if ($this->aConcepto !== null && $this->aConcepto->getCaIdconcepto() !== $v) {
			$this->aConcepto = null;
		}

		return $this;
	} // setCaIdconcepto()

	/**
	 * Set the value of [ca_vlrneto] column.
	 * 
	 * @param      string $v new value
	 * @return     Flete The current object (for fluent API support)
	 */
	public function setCaVlrneto($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_vlrneto !== $v) {
			$this->ca_vlrneto = $v;
			$this->modifiedColumns[] = FletePeer::CA_VLRNETO;
		}

		return $this;
	} // setCaVlrneto()

	/**
	 * Set the value of [ca_vlrminimo] column.
	 * 
	 * @param      string $v new value
	 * @return     Flete The current object (for fluent API support)
	 */
	public function setCaVlrminimo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_vlrminimo !== $v) {
			$this->ca_vlrminimo = $v;
			$this->modifiedColumns[] = FletePeer::CA_VLRMINIMO;
		}

		return $this;
	} // setCaVlrminimo()

	/**
	 * Set the value of [ca_fleteminimo] column.
	 * 
	 * @param      string $v new value
	 * @return     Flete The current object (for fluent API support)
	 */
	public function setCaFleteminimo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_fleteminimo !== $v) {
			$this->ca_fleteminimo = $v;
			$this->modifiedColumns[] = FletePeer::CA_FLETEMINIMO;
		}

		return $this;
	} // setCaFleteminimo()

	/**
	 * Sets the value of [ca_fchinicio] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     Flete The current object (for fluent API support)
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
				$this->modifiedColumns[] = FletePeer::CA_FCHINICIO;
			}
		} // if either are not null

		return $this;
	} // setCaFchinicio()

	/**
	 * Sets the value of [ca_fchvencimiento] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     Flete The current object (for fluent API support)
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
				$this->modifiedColumns[] = FletePeer::CA_FCHVENCIMIENTO;
			}
		} // if either are not null

		return $this;
	} // setCaFchvencimiento()

	/**
	 * Set the value of [ca_idmoneda] column.
	 * 
	 * @param      string $v new value
	 * @return     Flete The current object (for fluent API support)
	 */
	public function setCaIdmoneda($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idmoneda !== $v) {
			$this->ca_idmoneda = $v;
			$this->modifiedColumns[] = FletePeer::CA_IDMONEDA;
		}

		return $this;
	} // setCaIdmoneda()

	/**
	 * Set the value of [ca_observaciones] column.
	 * 
	 * @param      string $v new value
	 * @return     Flete The current object (for fluent API support)
	 */
	public function setCaObservaciones($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_observaciones !== $v) {
			$this->ca_observaciones = $v;
			$this->modifiedColumns[] = FletePeer::CA_OBSERVACIONES;
		}

		return $this;
	} // setCaObservaciones()

	/**
	 * Sets the value of [ca_fchcreado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     Flete The current object (for fluent API support)
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
				$this->modifiedColumns[] = FletePeer::CA_FCHCREADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchcreado()

	/**
	 * Set the value of [ca_sugerida] column.
	 * 
	 * @param      string $v new value
	 * @return     Flete The current object (for fluent API support)
	 */
	public function setCaSugerida($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_sugerida !== $v) {
			$this->ca_sugerida = $v;
			$this->modifiedColumns[] = FletePeer::CA_SUGERIDA;
		}

		return $this;
	} // setCaSugerida()

	/**
	 * Set the value of [ca_mantenimiento] column.
	 * 
	 * @param      string $v new value
	 * @return     Flete The current object (for fluent API support)
	 */
	public function setCaMantenimiento($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_mantenimiento !== $v) {
			$this->ca_mantenimiento = $v;
			$this->modifiedColumns[] = FletePeer::CA_MANTENIMIENTO;
		}

		return $this;
	} // setCaMantenimiento()

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
			$this->ca_vlrneto = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_vlrminimo = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_fleteminimo = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_fchinicio = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_fchvencimiento = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_idmoneda = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_observaciones = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_fchcreado = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_sugerida = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_mantenimiento = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 12; // 12 = FletePeer::NUM_COLUMNS - FletePeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Flete object", $e);
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

		if ($this->aTrayecto !== null && $this->ca_idtrayecto !== $this->aTrayecto->getCaIdtrayecto()) {
			$this->aTrayecto = null;
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
			$con = Propel::getConnection(FletePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = FletePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aTrayecto = null;
			$this->aConcepto = null;
			$this->collRecargoFletes = null;
			$this->lastRecargoFleteCriteria = null;

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
			$con = Propel::getConnection(FletePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			FletePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(FletePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			FletePeer::addInstanceToPool($this);
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

			if ($this->aTrayecto !== null) {
				if ($this->aTrayecto->isModified() || $this->aTrayecto->isNew()) {
					$affectedRows += $this->aTrayecto->save($con);
				}
				$this->setTrayecto($this->aTrayecto);
			}

			if ($this->aConcepto !== null) {
				if ($this->aConcepto->isModified() || $this->aConcepto->isNew()) {
					$affectedRows += $this->aConcepto->save($con);
				}
				$this->setConcepto($this->aConcepto);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = FletePeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += FletePeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collRecargoFletes !== null) {
				foreach ($this->collRecargoFletes as $referrerFK) {
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

			if ($this->aTrayecto !== null) {
				if (!$this->aTrayecto->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTrayecto->getValidationFailures());
				}
			}

			if ($this->aConcepto !== null) {
				if (!$this->aConcepto->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aConcepto->getValidationFailures());
				}
			}


			if (($retval = FletePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collRecargoFletes !== null) {
					foreach ($this->collRecargoFletes as $referrerFK) {
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
		$pos = FletePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaVlrneto();
				break;
			case 3:
				return $this->getCaVlrminimo();
				break;
			case 4:
				return $this->getCaFleteminimo();
				break;
			case 5:
				return $this->getCaFchinicio();
				break;
			case 6:
				return $this->getCaFchvencimiento();
				break;
			case 7:
				return $this->getCaIdmoneda();
				break;
			case 8:
				return $this->getCaObservaciones();
				break;
			case 9:
				return $this->getCaFchcreado();
				break;
			case 10:
				return $this->getCaSugerida();
				break;
			case 11:
				return $this->getCaMantenimiento();
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
		$keys = FletePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdtrayecto(),
			$keys[1] => $this->getCaIdconcepto(),
			$keys[2] => $this->getCaVlrneto(),
			$keys[3] => $this->getCaVlrminimo(),
			$keys[4] => $this->getCaFleteminimo(),
			$keys[5] => $this->getCaFchinicio(),
			$keys[6] => $this->getCaFchvencimiento(),
			$keys[7] => $this->getCaIdmoneda(),
			$keys[8] => $this->getCaObservaciones(),
			$keys[9] => $this->getCaFchcreado(),
			$keys[10] => $this->getCaSugerida(),
			$keys[11] => $this->getCaMantenimiento(),
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
		$pos = FletePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaVlrneto($value);
				break;
			case 3:
				$this->setCaVlrminimo($value);
				break;
			case 4:
				$this->setCaFleteminimo($value);
				break;
			case 5:
				$this->setCaFchinicio($value);
				break;
			case 6:
				$this->setCaFchvencimiento($value);
				break;
			case 7:
				$this->setCaIdmoneda($value);
				break;
			case 8:
				$this->setCaObservaciones($value);
				break;
			case 9:
				$this->setCaFchcreado($value);
				break;
			case 10:
				$this->setCaSugerida($value);
				break;
			case 11:
				$this->setCaMantenimiento($value);
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
		$keys = FletePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdtrayecto($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdconcepto($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaVlrneto($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaVlrminimo($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaFleteminimo($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaFchinicio($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaFchvencimiento($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaIdmoneda($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaObservaciones($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaFchcreado($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaSugerida($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaMantenimiento($arr[$keys[11]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(FletePeer::DATABASE_NAME);

		if ($this->isColumnModified(FletePeer::CA_IDTRAYECTO)) $criteria->add(FletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);
		if ($this->isColumnModified(FletePeer::CA_IDCONCEPTO)) $criteria->add(FletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);
		if ($this->isColumnModified(FletePeer::CA_VLRNETO)) $criteria->add(FletePeer::CA_VLRNETO, $this->ca_vlrneto);
		if ($this->isColumnModified(FletePeer::CA_VLRMINIMO)) $criteria->add(FletePeer::CA_VLRMINIMO, $this->ca_vlrminimo);
		if ($this->isColumnModified(FletePeer::CA_FLETEMINIMO)) $criteria->add(FletePeer::CA_FLETEMINIMO, $this->ca_fleteminimo);
		if ($this->isColumnModified(FletePeer::CA_FCHINICIO)) $criteria->add(FletePeer::CA_FCHINICIO, $this->ca_fchinicio);
		if ($this->isColumnModified(FletePeer::CA_FCHVENCIMIENTO)) $criteria->add(FletePeer::CA_FCHVENCIMIENTO, $this->ca_fchvencimiento);
		if ($this->isColumnModified(FletePeer::CA_IDMONEDA)) $criteria->add(FletePeer::CA_IDMONEDA, $this->ca_idmoneda);
		if ($this->isColumnModified(FletePeer::CA_OBSERVACIONES)) $criteria->add(FletePeer::CA_OBSERVACIONES, $this->ca_observaciones);
		if ($this->isColumnModified(FletePeer::CA_FCHCREADO)) $criteria->add(FletePeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(FletePeer::CA_SUGERIDA)) $criteria->add(FletePeer::CA_SUGERIDA, $this->ca_sugerida);
		if ($this->isColumnModified(FletePeer::CA_MANTENIMIENTO)) $criteria->add(FletePeer::CA_MANTENIMIENTO, $this->ca_mantenimiento);

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
		$criteria = new Criteria(FletePeer::DATABASE_NAME);

		$criteria->add(FletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);
		$criteria->add(FletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);

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

		$pks[0] = $this->getCaIdtrayecto();

		$pks[1] = $this->getCaIdconcepto();

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

		$this->setCaIdtrayecto($keys[0]);

		$this->setCaIdconcepto($keys[1]);

	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Flete (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdtrayecto($this->ca_idtrayecto);

		$copyObj->setCaIdconcepto($this->ca_idconcepto);

		$copyObj->setCaVlrneto($this->ca_vlrneto);

		$copyObj->setCaVlrminimo($this->ca_vlrminimo);

		$copyObj->setCaFleteminimo($this->ca_fleteminimo);

		$copyObj->setCaFchinicio($this->ca_fchinicio);

		$copyObj->setCaFchvencimiento($this->ca_fchvencimiento);

		$copyObj->setCaIdmoneda($this->ca_idmoneda);

		$copyObj->setCaObservaciones($this->ca_observaciones);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaSugerida($this->ca_sugerida);

		$copyObj->setCaMantenimiento($this->ca_mantenimiento);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getRecargoFletes() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addRecargoFlete($relObj->copy($deepCopy));
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
	 * @return     Flete Clone of current object.
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
	 * @return     FletePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new FletePeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Trayecto object.
	 *
	 * @param      Trayecto $v
	 * @return     Flete The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setTrayecto(Trayecto $v = null)
	{
		if ($v === null) {
			$this->setCaIdtrayecto(NULL);
		} else {
			$this->setCaIdtrayecto($v->getCaIdtrayecto());
		}

		$this->aTrayecto = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Trayecto object, it will not be re-added.
		if ($v !== null) {
			$v->addFlete($this);
		}

		return $this;
	}


	/**
	 * Get the associated Trayecto object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Trayecto The associated Trayecto object.
	 * @throws     PropelException
	 */
	public function getTrayecto(PropelPDO $con = null)
	{
		if ($this->aTrayecto === null && ($this->ca_idtrayecto !== null)) {
			$c = new Criteria(TrayectoPeer::DATABASE_NAME);
			$c->add(TrayectoPeer::CA_IDTRAYECTO, $this->ca_idtrayecto);
			$this->aTrayecto = TrayectoPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aTrayecto->addFletes($this);
			 */
		}
		return $this->aTrayecto;
	}

	/**
	 * Declares an association between this object and a Concepto object.
	 *
	 * @param      Concepto $v
	 * @return     Flete The current object (for fluent API support)
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
			$v->addFlete($this);
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
			   $this->aConcepto->addFletes($this);
			 */
		}
		return $this->aConcepto;
	}

	/**
	 * Clears out the collRecargoFletes collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addRecargoFletes()
	 */
	public function clearRecargoFletes()
	{
		$this->collRecargoFletes = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collRecargoFletes collection (array).
	 *
	 * By default this just sets the collRecargoFletes collection to an empty array (like clearcollRecargoFletes());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initRecargoFletes()
	{
		$this->collRecargoFletes = array();
	}

	/**
	 * Gets an array of RecargoFlete objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Flete has previously been saved, it will retrieve
	 * related RecargoFletes from storage. If this Flete is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array RecargoFlete[]
	 * @throws     PropelException
	 */
	public function getRecargoFletes($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(FletePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRecargoFletes === null) {
			if ($this->isNew()) {
			   $this->collRecargoFletes = array();
			} else {

				$criteria->add(RecargoFletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

				$criteria->add(RecargoFletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				RecargoFletePeer::addSelectColumns($criteria);
				$this->collRecargoFletes = RecargoFletePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RecargoFletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);


				$criteria->add(RecargoFletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				RecargoFletePeer::addSelectColumns($criteria);
				if (!isset($this->lastRecargoFleteCriteria) || !$this->lastRecargoFleteCriteria->equals($criteria)) {
					$this->collRecargoFletes = RecargoFletePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRecargoFleteCriteria = $criteria;
		return $this->collRecargoFletes;
	}

	/**
	 * Returns the number of related RecargoFlete objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related RecargoFlete objects.
	 * @throws     PropelException
	 */
	public function countRecargoFletes(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(FletePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collRecargoFletes === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(RecargoFletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

				$criteria->add(RecargoFletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$count = RecargoFletePeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(RecargoFletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);


				$criteria->add(RecargoFletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				if (!isset($this->lastRecargoFleteCriteria) || !$this->lastRecargoFleteCriteria->equals($criteria)) {
					$count = RecargoFletePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collRecargoFletes);
				}
			} else {
				$count = count($this->collRecargoFletes);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a RecargoFlete object to this object
	 * through the RecargoFlete foreign key attribute.
	 *
	 * @param      RecargoFlete $l RecargoFlete
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRecargoFlete(RecargoFlete $l)
	{
		if ($this->collRecargoFletes === null) {
			$this->initRecargoFletes();
		}
		if (!in_array($l, $this->collRecargoFletes, true)) { // only add it if the **same** object is not already associated
			array_push($this->collRecargoFletes, $l);
			$l->setFlete($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Flete is new, it will return
	 * an empty collection; or if this Flete has previously
	 * been saved, it will retrieve related RecargoFletes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Flete.
	 */
	public function getRecargoFletesJoinTipoRecargo($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(FletePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRecargoFletes === null) {
			if ($this->isNew()) {
				$this->collRecargoFletes = array();
			} else {

				$criteria->add(RecargoFletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

				$criteria->add(RecargoFletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$this->collRecargoFletes = RecargoFletePeer::doSelectJoinTipoRecargo($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RecargoFletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

			$criteria->add(RecargoFletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);

			if (!isset($this->lastRecargoFleteCriteria) || !$this->lastRecargoFleteCriteria->equals($criteria)) {
				$this->collRecargoFletes = RecargoFletePeer::doSelectJoinTipoRecargo($criteria, $con, $join_behavior);
			}
		}
		$this->lastRecargoFleteCriteria = $criteria;

		return $this->collRecargoFletes;
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
			if ($this->collRecargoFletes) {
				foreach ((array) $this->collRecargoFletes as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collRecargoFletes = null;
			$this->aTrayecto = null;
			$this->aConcepto = null;
	}

} // BaseFlete
