<?php

/**
 * Base class that represents a row from the 'tb_colnovedades' table.
 *
 * 
 *
 * @package    lib.model.public.om
 */
abstract class BaseColNovedad extends BaseObject  implements Persistent {


  const PEER = 'ColNovedadPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        ColNovedadPeer
	 */
	protected static $peer;

	/**
	 * The value for the ca_idnovedad field.
	 * @var        int
	 */
	protected $ca_idnovedad;

	/**
	 * The value for the ca_fchpublicacion field.
	 * @var        string
	 */
	protected $ca_fchpublicacion;

	/**
	 * The value for the ca_asunto field.
	 * @var        string
	 */
	protected $ca_asunto;

	/**
	 * The value for the ca_detalle field.
	 * @var        string
	 */
	protected $ca_detalle;

	/**
	 * The value for the ca_fcharchivar field.
	 * @var        string
	 */
	protected $ca_fcharchivar;

	/**
	 * The value for the ca_extension field.
	 * @var        string
	 */
	protected $ca_extension;

	/**
	 * The value for the ca_header_file field.
	 * @var        string
	 */
	protected $ca_header_file;

	/**
	 * The value for the ca_content field.
	 * @var        resource
	 */
	protected $ca_content;

	/**
	 * The value for the ca_fchpublicado field.
	 * @var        string
	 */
	protected $ca_fchpublicado;

	/**
	 * The value for the ca_usupublicado field.
	 * @var        string
	 */
	protected $ca_usupublicado;

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
	 * Initializes internal state of BaseColNovedad object.
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
	 * Get the [ca_idnovedad] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdnovedad()
	{
		return $this->ca_idnovedad;
	}

	/**
	 * Get the [optionally formatted] temporal [ca_fchpublicacion] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaFchpublicacion($format = 'Y-m-d')
	{
		if ($this->ca_fchpublicacion === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchpublicacion);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchpublicacion, true), $x);
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
	 * Get the [ca_asunto] column value.
	 * 
	 * @return     string
	 */
	public function getCaAsunto()
	{
		return $this->ca_asunto;
	}

	/**
	 * Get the [ca_detalle] column value.
	 * 
	 * @return     string
	 */
	public function getCaDetalle()
	{
		return $this->ca_detalle;
	}

	/**
	 * Get the [optionally formatted] temporal [ca_fcharchivar] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaFcharchivar($format = 'Y-m-d')
	{
		if ($this->ca_fcharchivar === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fcharchivar);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fcharchivar, true), $x);
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
	 * Get the [ca_extension] column value.
	 * 
	 * @return     string
	 */
	public function getCaExtension()
	{
		return $this->ca_extension;
	}

	/**
	 * Get the [ca_header_file] column value.
	 * 
	 * @return     string
	 */
	public function getCaHeaderFile()
	{
		return $this->ca_header_file;
	}

	/**
	 * Get the [ca_content] column value.
	 * 
	 * @return     resource
	 */
	public function getCaContent()
	{
		return $this->ca_content;
	}

	/**
	 * Get the [optionally formatted] temporal [ca_fchpublicado] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaFchpublicado($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fchpublicado === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchpublicado);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchpublicado, true), $x);
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
	 * Get the [ca_usupublicado] column value.
	 * 
	 * @return     string
	 */
	public function getCaUsupublicado()
	{
		return $this->ca_usupublicado;
	}

	/**
	 * Set the value of [ca_idnovedad] column.
	 * 
	 * @param      int $v new value
	 * @return     ColNovedad The current object (for fluent API support)
	 */
	public function setCaIdnovedad($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idnovedad !== $v) {
			$this->ca_idnovedad = $v;
			$this->modifiedColumns[] = ColNovedadPeer::CA_IDNOVEDAD;
		}

		return $this;
	} // setCaIdnovedad()

	/**
	 * Sets the value of [ca_fchpublicacion] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     ColNovedad The current object (for fluent API support)
	 */
	public function setCaFchpublicacion($v)
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

		if ( $this->ca_fchpublicacion !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fchpublicacion !== null && $tmpDt = new DateTime($this->ca_fchpublicacion)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchpublicacion = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = ColNovedadPeer::CA_FCHPUBLICACION;
			}
		} // if either are not null

		return $this;
	} // setCaFchpublicacion()

	/**
	 * Set the value of [ca_asunto] column.
	 * 
	 * @param      string $v new value
	 * @return     ColNovedad The current object (for fluent API support)
	 */
	public function setCaAsunto($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_asunto !== $v) {
			$this->ca_asunto = $v;
			$this->modifiedColumns[] = ColNovedadPeer::CA_ASUNTO;
		}

		return $this;
	} // setCaAsunto()

	/**
	 * Set the value of [ca_detalle] column.
	 * 
	 * @param      string $v new value
	 * @return     ColNovedad The current object (for fluent API support)
	 */
	public function setCaDetalle($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_detalle !== $v) {
			$this->ca_detalle = $v;
			$this->modifiedColumns[] = ColNovedadPeer::CA_DETALLE;
		}

		return $this;
	} // setCaDetalle()

	/**
	 * Sets the value of [ca_fcharchivar] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     ColNovedad The current object (for fluent API support)
	 */
	public function setCaFcharchivar($v)
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

		if ( $this->ca_fcharchivar !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fcharchivar !== null && $tmpDt = new DateTime($this->ca_fcharchivar)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fcharchivar = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = ColNovedadPeer::CA_FCHARCHIVAR;
			}
		} // if either are not null

		return $this;
	} // setCaFcharchivar()

	/**
	 * Set the value of [ca_extension] column.
	 * 
	 * @param      string $v new value
	 * @return     ColNovedad The current object (for fluent API support)
	 */
	public function setCaExtension($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_extension !== $v) {
			$this->ca_extension = $v;
			$this->modifiedColumns[] = ColNovedadPeer::CA_EXTENSION;
		}

		return $this;
	} // setCaExtension()

	/**
	 * Set the value of [ca_header_file] column.
	 * 
	 * @param      string $v new value
	 * @return     ColNovedad The current object (for fluent API support)
	 */
	public function setCaHeaderFile($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_header_file !== $v) {
			$this->ca_header_file = $v;
			$this->modifiedColumns[] = ColNovedadPeer::CA_HEADER_FILE;
		}

		return $this;
	} // setCaHeaderFile()

	/**
	 * Set the value of [ca_content] column.
	 * 
	 * @param      resource $v new value
	 * @return     ColNovedad The current object (for fluent API support)
	 */
	public function setCaContent($v)
	{
		// Because BLOB columns are streams in PDO we have to assume that they are
		// always modified when a new value is passed in.  For example, the contents
		// of the stream itself may have changed externally.
		if (!is_resource($v)) {
			$this->ca_content = fopen('php://memory', 'r+');
			fwrite($this->ca_content, $v);
			rewind($this->ca_content);
		} else { // it's already a stream
			$this->ca_content = $v;
		}
		$this->modifiedColumns[] = ColNovedadPeer::CA_CONTENT;

		return $this;
	} // setCaContent()

	/**
	 * Sets the value of [ca_fchpublicado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     ColNovedad The current object (for fluent API support)
	 */
	public function setCaFchpublicado($v)
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

		if ( $this->ca_fchpublicado !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fchpublicado !== null && $tmpDt = new DateTime($this->ca_fchpublicado)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchpublicado = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = ColNovedadPeer::CA_FCHPUBLICADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchpublicado()

	/**
	 * Set the value of [ca_usupublicado] column.
	 * 
	 * @param      string $v new value
	 * @return     ColNovedad The current object (for fluent API support)
	 */
	public function setCaUsupublicado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usupublicado !== $v) {
			$this->ca_usupublicado = $v;
			$this->modifiedColumns[] = ColNovedadPeer::CA_USUPUBLICADO;
		}

		return $this;
	} // setCaUsupublicado()

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

			$this->ca_idnovedad = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_fchpublicacion = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_asunto = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_detalle = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_fcharchivar = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_extension = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_header_file = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_content = $row[$startcol + 7];
			$this->ca_fchpublicado = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_usupublicado = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 10; // 10 = ColNovedadPeer::NUM_COLUMNS - ColNovedadPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating ColNovedad object", $e);
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
			$con = Propel::getConnection(ColNovedadPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = ColNovedadPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

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
			$con = Propel::getConnection(ColNovedadPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			ColNovedadPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(ColNovedadPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			ColNovedadPeer::addInstanceToPool($this);
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

			if ($this->isNew() ) {
				$this->modifiedColumns[] = ColNovedadPeer::CA_IDNOVEDAD;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ColNovedadPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setCaIdnovedad($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += ColNovedadPeer::doUpdate($this, $con);
				}

				// Rewind the ca_content LOB column, since PDO does not rewind after inserting value.
				if ($this->ca_content !== null && is_resource($this->ca_content)) {
					rewind($this->ca_content);
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


			if (($retval = ColNovedadPeer::doValidate($this, $columns)) !== true) {
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
		$pos = ColNovedadPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdnovedad();
				break;
			case 1:
				return $this->getCaFchpublicacion();
				break;
			case 2:
				return $this->getCaAsunto();
				break;
			case 3:
				return $this->getCaDetalle();
				break;
			case 4:
				return $this->getCaFcharchivar();
				break;
			case 5:
				return $this->getCaExtension();
				break;
			case 6:
				return $this->getCaHeaderFile();
				break;
			case 7:
				return $this->getCaContent();
				break;
			case 8:
				return $this->getCaFchpublicado();
				break;
			case 9:
				return $this->getCaUsupublicado();
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
		$keys = ColNovedadPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdnovedad(),
			$keys[1] => $this->getCaFchpublicacion(),
			$keys[2] => $this->getCaAsunto(),
			$keys[3] => $this->getCaDetalle(),
			$keys[4] => $this->getCaFcharchivar(),
			$keys[5] => $this->getCaExtension(),
			$keys[6] => $this->getCaHeaderFile(),
			$keys[7] => $this->getCaContent(),
			$keys[8] => $this->getCaFchpublicado(),
			$keys[9] => $this->getCaUsupublicado(),
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
		$pos = ColNovedadPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdnovedad($value);
				break;
			case 1:
				$this->setCaFchpublicacion($value);
				break;
			case 2:
				$this->setCaAsunto($value);
				break;
			case 3:
				$this->setCaDetalle($value);
				break;
			case 4:
				$this->setCaFcharchivar($value);
				break;
			case 5:
				$this->setCaExtension($value);
				break;
			case 6:
				$this->setCaHeaderFile($value);
				break;
			case 7:
				$this->setCaContent($value);
				break;
			case 8:
				$this->setCaFchpublicado($value);
				break;
			case 9:
				$this->setCaUsupublicado($value);
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
		$keys = ColNovedadPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdnovedad($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaFchpublicacion($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaAsunto($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaDetalle($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaFcharchivar($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaExtension($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaHeaderFile($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaContent($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaFchpublicado($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaUsupublicado($arr[$keys[9]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(ColNovedadPeer::DATABASE_NAME);

		if ($this->isColumnModified(ColNovedadPeer::CA_IDNOVEDAD)) $criteria->add(ColNovedadPeer::CA_IDNOVEDAD, $this->ca_idnovedad);
		if ($this->isColumnModified(ColNovedadPeer::CA_FCHPUBLICACION)) $criteria->add(ColNovedadPeer::CA_FCHPUBLICACION, $this->ca_fchpublicacion);
		if ($this->isColumnModified(ColNovedadPeer::CA_ASUNTO)) $criteria->add(ColNovedadPeer::CA_ASUNTO, $this->ca_asunto);
		if ($this->isColumnModified(ColNovedadPeer::CA_DETALLE)) $criteria->add(ColNovedadPeer::CA_DETALLE, $this->ca_detalle);
		if ($this->isColumnModified(ColNovedadPeer::CA_FCHARCHIVAR)) $criteria->add(ColNovedadPeer::CA_FCHARCHIVAR, $this->ca_fcharchivar);
		if ($this->isColumnModified(ColNovedadPeer::CA_EXTENSION)) $criteria->add(ColNovedadPeer::CA_EXTENSION, $this->ca_extension);
		if ($this->isColumnModified(ColNovedadPeer::CA_HEADER_FILE)) $criteria->add(ColNovedadPeer::CA_HEADER_FILE, $this->ca_header_file);
		if ($this->isColumnModified(ColNovedadPeer::CA_CONTENT)) $criteria->add(ColNovedadPeer::CA_CONTENT, $this->ca_content);
		if ($this->isColumnModified(ColNovedadPeer::CA_FCHPUBLICADO)) $criteria->add(ColNovedadPeer::CA_FCHPUBLICADO, $this->ca_fchpublicado);
		if ($this->isColumnModified(ColNovedadPeer::CA_USUPUBLICADO)) $criteria->add(ColNovedadPeer::CA_USUPUBLICADO, $this->ca_usupublicado);

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
		$criteria = new Criteria(ColNovedadPeer::DATABASE_NAME);

		$criteria->add(ColNovedadPeer::CA_IDNOVEDAD, $this->ca_idnovedad);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdnovedad();
	}

	/**
	 * Generic method to set the primary key (ca_idnovedad column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdnovedad($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of ColNovedad (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaFchpublicacion($this->ca_fchpublicacion);

		$copyObj->setCaAsunto($this->ca_asunto);

		$copyObj->setCaDetalle($this->ca_detalle);

		$copyObj->setCaFcharchivar($this->ca_fcharchivar);

		$copyObj->setCaExtension($this->ca_extension);

		$copyObj->setCaHeaderFile($this->ca_header_file);

		$copyObj->setCaContent($this->ca_content);

		$copyObj->setCaFchpublicado($this->ca_fchpublicado);

		$copyObj->setCaUsupublicado($this->ca_usupublicado);


		$copyObj->setNew(true);

		$copyObj->setCaIdnovedad(NULL); // this is a auto-increment column, so set to default value

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
	 * @return     ColNovedad Clone of current object.
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
	 * @return     ColNovedadPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ColNovedadPeer();
		}
		return self::$peer;
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

	}

} // BaseColNovedad
