<?php

/**
 * Base class that represents a row from the 'tb_fileheader' table.
 *
 * 
 *
 * @package    lib.model.dataimport.om
 */
abstract class BaseFileHeader extends BaseObject  implements Persistent {


  const PEER = 'FileHeaderPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        FileHeaderPeer
	 */
	protected static $peer;

	/**
	 * The value for the ca_idfileheader field.
	 * @var        int
	 */
	protected $ca_idfileheader;

	/**
	 * The value for the ca_descripcion field.
	 * @var        string
	 */
	protected $ca_descripcion;

	/**
	 * The value for the ca_tipoarchivo field.
	 * @var        string
	 */
	protected $ca_tipoarchivo;

	/**
	 * The value for the ca_separador field.
	 * @var        string
	 */
	protected $ca_separador;

	/**
	 * The value for the ca_separadordec field.
	 * @var        string
	 */
	protected $ca_separadordec;

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
	 * @var        array FileImported[] Collection to store aggregation of FileImported objects.
	 */
	protected $collFileImporteds;

	/**
	 * @var        Criteria The criteria used to select the current contents of collFileImporteds.
	 */
	private $lastFileImportedCriteria = null;

	/**
	 * @var        array FileColumn[] Collection to store aggregation of FileColumn objects.
	 */
	protected $collFileColumns;

	/**
	 * @var        Criteria The criteria used to select the current contents of collFileColumns.
	 */
	private $lastFileColumnCriteria = null;

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
	 * Initializes internal state of BaseFileHeader object.
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
	 * Get the [ca_idfileheader] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdfileheader()
	{
		return $this->ca_idfileheader;
	}

	/**
	 * Get the [ca_descripcion] column value.
	 * 
	 * @return     string
	 */
	public function getCaDescripcion()
	{
		return $this->ca_descripcion;
	}

	/**
	 * Get the [ca_tipoarchivo] column value.
	 * 
	 * @return     string
	 */
	public function getCaTipoarchivo()
	{
		return $this->ca_tipoarchivo;
	}

	/**
	 * Get the [ca_separador] column value.
	 * 
	 * @return     string
	 */
	public function getCaSeparador()
	{
		return $this->ca_separador;
	}

	/**
	 * Get the [ca_separadordec] column value.
	 * 
	 * @return     string
	 */
	public function getCaSeparadordec()
	{
		return $this->ca_separadordec;
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
	 * Set the value of [ca_idfileheader] column.
	 * 
	 * @param      int $v new value
	 * @return     FileHeader The current object (for fluent API support)
	 */
	public function setCaIdfileheader($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idfileheader !== $v) {
			$this->ca_idfileheader = $v;
			$this->modifiedColumns[] = FileHeaderPeer::CA_IDFILEHEADER;
		}

		return $this;
	} // setCaIdfileheader()

	/**
	 * Set the value of [ca_descripcion] column.
	 * 
	 * @param      string $v new value
	 * @return     FileHeader The current object (for fluent API support)
	 */
	public function setCaDescripcion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_descripcion !== $v) {
			$this->ca_descripcion = $v;
			$this->modifiedColumns[] = FileHeaderPeer::CA_DESCRIPCION;
		}

		return $this;
	} // setCaDescripcion()

	/**
	 * Set the value of [ca_tipoarchivo] column.
	 * 
	 * @param      string $v new value
	 * @return     FileHeader The current object (for fluent API support)
	 */
	public function setCaTipoarchivo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_tipoarchivo !== $v) {
			$this->ca_tipoarchivo = $v;
			$this->modifiedColumns[] = FileHeaderPeer::CA_TIPOARCHIVO;
		}

		return $this;
	} // setCaTipoarchivo()

	/**
	 * Set the value of [ca_separador] column.
	 * 
	 * @param      string $v new value
	 * @return     FileHeader The current object (for fluent API support)
	 */
	public function setCaSeparador($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_separador !== $v) {
			$this->ca_separador = $v;
			$this->modifiedColumns[] = FileHeaderPeer::CA_SEPARADOR;
		}

		return $this;
	} // setCaSeparador()

	/**
	 * Set the value of [ca_separadordec] column.
	 * 
	 * @param      string $v new value
	 * @return     FileHeader The current object (for fluent API support)
	 */
	public function setCaSeparadordec($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_separadordec !== $v) {
			$this->ca_separadordec = $v;
			$this->modifiedColumns[] = FileHeaderPeer::CA_SEPARADORDEC;
		}

		return $this;
	} // setCaSeparadordec()

	/**
	 * Sets the value of [ca_fchcreado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     FileHeader The current object (for fluent API support)
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
				$this->modifiedColumns[] = FileHeaderPeer::CA_FCHCREADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchcreado()

	/**
	 * Set the value of [ca_usucreado] column.
	 * 
	 * @param      string $v new value
	 * @return     FileHeader The current object (for fluent API support)
	 */
	public function setCaUsucreado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usucreado !== $v) {
			$this->ca_usucreado = $v;
			$this->modifiedColumns[] = FileHeaderPeer::CA_USUCREADO;
		}

		return $this;
	} // setCaUsucreado()

	/**
	 * Sets the value of [ca_fchactualizado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     FileHeader The current object (for fluent API support)
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
				$this->modifiedColumns[] = FileHeaderPeer::CA_FCHACTUALIZADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchactualizado()

	/**
	 * Set the value of [ca_usuactualizado] column.
	 * 
	 * @param      string $v new value
	 * @return     FileHeader The current object (for fluent API support)
	 */
	public function setCaUsuactualizado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usuactualizado !== $v) {
			$this->ca_usuactualizado = $v;
			$this->modifiedColumns[] = FileHeaderPeer::CA_USUACTUALIZADO;
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

			$this->ca_idfileheader = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_descripcion = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_tipoarchivo = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_separador = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_separadordec = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_fchcreado = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_usucreado = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_fchactualizado = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_usuactualizado = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 9; // 9 = FileHeaderPeer::NUM_COLUMNS - FileHeaderPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating FileHeader object", $e);
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
			$con = Propel::getConnection(FileHeaderPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = FileHeaderPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->collFileImporteds = null;
			$this->lastFileImportedCriteria = null;

			$this->collFileColumns = null;
			$this->lastFileColumnCriteria = null;

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
			$con = Propel::getConnection(FileHeaderPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			FileHeaderPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(FileHeaderPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			FileHeaderPeer::addInstanceToPool($this);
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
				$this->modifiedColumns[] = FileHeaderPeer::CA_IDFILEHEADER;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = FileHeaderPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setCaIdfileheader($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += FileHeaderPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collFileImporteds !== null) {
				foreach ($this->collFileImporteds as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collFileColumns !== null) {
				foreach ($this->collFileColumns as $referrerFK) {
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


			if (($retval = FileHeaderPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collFileImporteds !== null) {
					foreach ($this->collFileImporteds as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collFileColumns !== null) {
					foreach ($this->collFileColumns as $referrerFK) {
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
		$pos = FileHeaderPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdfileheader();
				break;
			case 1:
				return $this->getCaDescripcion();
				break;
			case 2:
				return $this->getCaTipoarchivo();
				break;
			case 3:
				return $this->getCaSeparador();
				break;
			case 4:
				return $this->getCaSeparadordec();
				break;
			case 5:
				return $this->getCaFchcreado();
				break;
			case 6:
				return $this->getCaUsucreado();
				break;
			case 7:
				return $this->getCaFchactualizado();
				break;
			case 8:
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
		$keys = FileHeaderPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdfileheader(),
			$keys[1] => $this->getCaDescripcion(),
			$keys[2] => $this->getCaTipoarchivo(),
			$keys[3] => $this->getCaSeparador(),
			$keys[4] => $this->getCaSeparadordec(),
			$keys[5] => $this->getCaFchcreado(),
			$keys[6] => $this->getCaUsucreado(),
			$keys[7] => $this->getCaFchactualizado(),
			$keys[8] => $this->getCaUsuactualizado(),
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
		$pos = FileHeaderPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdfileheader($value);
				break;
			case 1:
				$this->setCaDescripcion($value);
				break;
			case 2:
				$this->setCaTipoarchivo($value);
				break;
			case 3:
				$this->setCaSeparador($value);
				break;
			case 4:
				$this->setCaSeparadordec($value);
				break;
			case 5:
				$this->setCaFchcreado($value);
				break;
			case 6:
				$this->setCaUsucreado($value);
				break;
			case 7:
				$this->setCaFchactualizado($value);
				break;
			case 8:
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
		$keys = FileHeaderPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdfileheader($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaDescripcion($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaTipoarchivo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaSeparador($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaSeparadordec($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaFchcreado($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaUsucreado($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaFchactualizado($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaUsuactualizado($arr[$keys[8]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(FileHeaderPeer::DATABASE_NAME);

		if ($this->isColumnModified(FileHeaderPeer::CA_IDFILEHEADER)) $criteria->add(FileHeaderPeer::CA_IDFILEHEADER, $this->ca_idfileheader);
		if ($this->isColumnModified(FileHeaderPeer::CA_DESCRIPCION)) $criteria->add(FileHeaderPeer::CA_DESCRIPCION, $this->ca_descripcion);
		if ($this->isColumnModified(FileHeaderPeer::CA_TIPOARCHIVO)) $criteria->add(FileHeaderPeer::CA_TIPOARCHIVO, $this->ca_tipoarchivo);
		if ($this->isColumnModified(FileHeaderPeer::CA_SEPARADOR)) $criteria->add(FileHeaderPeer::CA_SEPARADOR, $this->ca_separador);
		if ($this->isColumnModified(FileHeaderPeer::CA_SEPARADORDEC)) $criteria->add(FileHeaderPeer::CA_SEPARADORDEC, $this->ca_separadordec);
		if ($this->isColumnModified(FileHeaderPeer::CA_FCHCREADO)) $criteria->add(FileHeaderPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(FileHeaderPeer::CA_USUCREADO)) $criteria->add(FileHeaderPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(FileHeaderPeer::CA_FCHACTUALIZADO)) $criteria->add(FileHeaderPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(FileHeaderPeer::CA_USUACTUALIZADO)) $criteria->add(FileHeaderPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);

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
		$criteria = new Criteria(FileHeaderPeer::DATABASE_NAME);

		$criteria->add(FileHeaderPeer::CA_IDFILEHEADER, $this->ca_idfileheader);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdfileheader();
	}

	/**
	 * Generic method to set the primary key (ca_idfileheader column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdfileheader($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of FileHeader (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaDescripcion($this->ca_descripcion);

		$copyObj->setCaTipoarchivo($this->ca_tipoarchivo);

		$copyObj->setCaSeparador($this->ca_separador);

		$copyObj->setCaSeparadordec($this->ca_separadordec);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getFileImporteds() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addFileImported($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getFileColumns() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addFileColumn($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setCaIdfileheader(NULL); // this is a auto-increment column, so set to default value

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
	 * @return     FileHeader Clone of current object.
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
	 * @return     FileHeaderPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new FileHeaderPeer();
		}
		return self::$peer;
	}

	/**
	 * Clears out the collFileImporteds collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addFileImporteds()
	 */
	public function clearFileImporteds()
	{
		$this->collFileImporteds = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collFileImporteds collection (array).
	 *
	 * By default this just sets the collFileImporteds collection to an empty array (like clearcollFileImporteds());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initFileImporteds()
	{
		$this->collFileImporteds = array();
	}

	/**
	 * Gets an array of FileImported objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this FileHeader has previously been saved, it will retrieve
	 * related FileImporteds from storage. If this FileHeader is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array FileImported[]
	 * @throws     PropelException
	 */
	public function getFileImporteds($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(FileHeaderPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFileImporteds === null) {
			if ($this->isNew()) {
			   $this->collFileImporteds = array();
			} else {

				$criteria->add(FileImportedPeer::CA_IDFILEHEADER, $this->ca_idfileheader);

				FileImportedPeer::addSelectColumns($criteria);
				$this->collFileImporteds = FileImportedPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(FileImportedPeer::CA_IDFILEHEADER, $this->ca_idfileheader);

				FileImportedPeer::addSelectColumns($criteria);
				if (!isset($this->lastFileImportedCriteria) || !$this->lastFileImportedCriteria->equals($criteria)) {
					$this->collFileImporteds = FileImportedPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFileImportedCriteria = $criteria;
		return $this->collFileImporteds;
	}

	/**
	 * Returns the number of related FileImported objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related FileImported objects.
	 * @throws     PropelException
	 */
	public function countFileImporteds(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(FileHeaderPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collFileImporteds === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(FileImportedPeer::CA_IDFILEHEADER, $this->ca_idfileheader);

				$count = FileImportedPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(FileImportedPeer::CA_IDFILEHEADER, $this->ca_idfileheader);

				if (!isset($this->lastFileImportedCriteria) || !$this->lastFileImportedCriteria->equals($criteria)) {
					$count = FileImportedPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collFileImporteds);
				}
			} else {
				$count = count($this->collFileImporteds);
			}
		}
		$this->lastFileImportedCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a FileImported object to this object
	 * through the FileImported foreign key attribute.
	 *
	 * @param      FileImported $l FileImported
	 * @return     void
	 * @throws     PropelException
	 */
	public function addFileImported(FileImported $l)
	{
		if ($this->collFileImporteds === null) {
			$this->initFileImporteds();
		}
		if (!in_array($l, $this->collFileImporteds, true)) { // only add it if the **same** object is not already associated
			array_push($this->collFileImporteds, $l);
			$l->setFileHeader($this);
		}
	}

	/**
	 * Clears out the collFileColumns collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addFileColumns()
	 */
	public function clearFileColumns()
	{
		$this->collFileColumns = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collFileColumns collection (array).
	 *
	 * By default this just sets the collFileColumns collection to an empty array (like clearcollFileColumns());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initFileColumns()
	{
		$this->collFileColumns = array();
	}

	/**
	 * Gets an array of FileColumn objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this FileHeader has previously been saved, it will retrieve
	 * related FileColumns from storage. If this FileHeader is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array FileColumn[]
	 * @throws     PropelException
	 */
	public function getFileColumns($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(FileHeaderPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFileColumns === null) {
			if ($this->isNew()) {
			   $this->collFileColumns = array();
			} else {

				$criteria->add(FileColumnPeer::CA_IDFILEHEADER, $this->ca_idfileheader);

				FileColumnPeer::addSelectColumns($criteria);
				$this->collFileColumns = FileColumnPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(FileColumnPeer::CA_IDFILEHEADER, $this->ca_idfileheader);

				FileColumnPeer::addSelectColumns($criteria);
				if (!isset($this->lastFileColumnCriteria) || !$this->lastFileColumnCriteria->equals($criteria)) {
					$this->collFileColumns = FileColumnPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFileColumnCriteria = $criteria;
		return $this->collFileColumns;
	}

	/**
	 * Returns the number of related FileColumn objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related FileColumn objects.
	 * @throws     PropelException
	 */
	public function countFileColumns(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(FileHeaderPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collFileColumns === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(FileColumnPeer::CA_IDFILEHEADER, $this->ca_idfileheader);

				$count = FileColumnPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(FileColumnPeer::CA_IDFILEHEADER, $this->ca_idfileheader);

				if (!isset($this->lastFileColumnCriteria) || !$this->lastFileColumnCriteria->equals($criteria)) {
					$count = FileColumnPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collFileColumns);
				}
			} else {
				$count = count($this->collFileColumns);
			}
		}
		$this->lastFileColumnCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a FileColumn object to this object
	 * through the FileColumn foreign key attribute.
	 *
	 * @param      FileColumn $l FileColumn
	 * @return     void
	 * @throws     PropelException
	 */
	public function addFileColumn(FileColumn $l)
	{
		if ($this->collFileColumns === null) {
			$this->initFileColumns();
		}
		if (!in_array($l, $this->collFileColumns, true)) { // only add it if the **same** object is not already associated
			array_push($this->collFileColumns, $l);
			$l->setFileHeader($this);
		}
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
			if ($this->collFileImporteds) {
				foreach ((array) $this->collFileImporteds as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collFileColumns) {
				foreach ((array) $this->collFileColumns as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collFileImporteds = null;
		$this->collFileColumns = null;
	}

} // BaseFileHeader
