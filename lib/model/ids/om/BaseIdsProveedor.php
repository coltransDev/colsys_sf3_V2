<?php

/**
 * Base class that represents a row from the 'ids.ca_idproveedor' table.
 *
 * 
 *
 * @package    lib.model.ids.om
 */
abstract class BaseIdsProveedor extends BaseObject  implements Persistent {


  const PEER = 'IdsProveedorPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        IdsProveedorPeer
	 */
	protected static $peer;

	/**
	 * The value for the ca_idproveedor field.
	 * @var        int
	 */
	protected $ca_idproveedor;

	/**
	 * The value for the ca_tipo field.
	 * @var        int
	 */
	protected $ca_tipo;

	/**
	 * The value for the ca_critico field.
	 * @var        boolean
	 */
	protected $ca_critico;

	/**
	 * The value for the ca_controladoporsig field.
	 * @var        boolean
	 */
	protected $ca_controladoporsig;

	/**
	 * The value for the ca_fchaprobado field.
	 * @var        string
	 */
	protected $ca_fchaprobado;

	/**
	 * The value for the ca_usuaprobado field.
	 * @var        string
	 */
	protected $ca_usuaprobado;

	/**
	 * @var        Ids
	 */
	protected $aIds;

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
	 * Initializes internal state of BaseIdsProveedor object.
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
	 * Get the [ca_idproveedor] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdproveedor()
	{
		return $this->ca_idproveedor;
	}

	/**
	 * Get the [ca_tipo] column value.
	 * 
	 * @return     int
	 */
	public function getCaTipo()
	{
		return $this->ca_tipo;
	}

	/**
	 * Get the [ca_critico] column value.
	 * 
	 * @return     boolean
	 */
	public function getCaCritico()
	{
		return $this->ca_critico;
	}

	/**
	 * Get the [ca_controladoporsig] column value.
	 * 
	 * @return     boolean
	 */
	public function getCaControladoporsig()
	{
		return $this->ca_controladoporsig;
	}

	/**
	 * Get the [optionally formatted] temporal [ca_fchaprobado] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaFchaprobado($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fchaprobado === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchaprobado);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchaprobado, true), $x);
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
	 * Get the [ca_usuaprobado] column value.
	 * 
	 * @return     string
	 */
	public function getCaUsuaprobado()
	{
		return $this->ca_usuaprobado;
	}

	/**
	 * Set the value of [ca_idproveedor] column.
	 * 
	 * @param      int $v new value
	 * @return     IdsProveedor The current object (for fluent API support)
	 */
	public function setCaIdproveedor($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idproveedor !== $v) {
			$this->ca_idproveedor = $v;
			$this->modifiedColumns[] = IdsProveedorPeer::CA_IDPROVEEDOR;
		}

		if ($this->aIds !== null && $this->aIds->getCaId() !== $v) {
			$this->aIds = null;
		}

		return $this;
	} // setCaIdproveedor()

	/**
	 * Set the value of [ca_tipo] column.
	 * 
	 * @param      int $v new value
	 * @return     IdsProveedor The current object (for fluent API support)
	 */
	public function setCaTipo($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_tipo !== $v) {
			$this->ca_tipo = $v;
			$this->modifiedColumns[] = IdsProveedorPeer::CA_TIPO;
		}

		return $this;
	} // setCaTipo()

	/**
	 * Set the value of [ca_critico] column.
	 * 
	 * @param      boolean $v new value
	 * @return     IdsProveedor The current object (for fluent API support)
	 */
	public function setCaCritico($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->ca_critico !== $v) {
			$this->ca_critico = $v;
			$this->modifiedColumns[] = IdsProveedorPeer::CA_CRITICO;
		}

		return $this;
	} // setCaCritico()

	/**
	 * Set the value of [ca_controladoporsig] column.
	 * 
	 * @param      boolean $v new value
	 * @return     IdsProveedor The current object (for fluent API support)
	 */
	public function setCaControladoporsig($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->ca_controladoporsig !== $v) {
			$this->ca_controladoporsig = $v;
			$this->modifiedColumns[] = IdsProveedorPeer::CA_CONTROLADOPORSIG;
		}

		return $this;
	} // setCaControladoporsig()

	/**
	 * Sets the value of [ca_fchaprobado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     IdsProveedor The current object (for fluent API support)
	 */
	public function setCaFchaprobado($v)
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

		if ( $this->ca_fchaprobado !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fchaprobado !== null && $tmpDt = new DateTime($this->ca_fchaprobado)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchaprobado = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = IdsProveedorPeer::CA_FCHAPROBADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchaprobado()

	/**
	 * Set the value of [ca_usuaprobado] column.
	 * 
	 * @param      string $v new value
	 * @return     IdsProveedor The current object (for fluent API support)
	 */
	public function setCaUsuaprobado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usuaprobado !== $v) {
			$this->ca_usuaprobado = $v;
			$this->modifiedColumns[] = IdsProveedorPeer::CA_USUAPROBADO;
		}

		return $this;
	} // setCaUsuaprobado()

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

			$this->ca_idproveedor = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_tipo = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_critico = ($row[$startcol + 2] !== null) ? (boolean) $row[$startcol + 2] : null;
			$this->ca_controladoporsig = ($row[$startcol + 3] !== null) ? (boolean) $row[$startcol + 3] : null;
			$this->ca_fchaprobado = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_usuaprobado = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 6; // 6 = IdsProveedorPeer::NUM_COLUMNS - IdsProveedorPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating IdsProveedor object", $e);
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

		if ($this->aIds !== null && $this->ca_idproveedor !== $this->aIds->getCaId()) {
			$this->aIds = null;
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
			$con = Propel::getConnection(IdsProveedorPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = IdsProveedorPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aIds = null;
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
			$con = Propel::getConnection(IdsProveedorPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			IdsProveedorPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(IdsProveedorPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			IdsProveedorPeer::addInstanceToPool($this);
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

			if ($this->aIds !== null) {
				if ($this->aIds->isModified() || $this->aIds->isNew()) {
					$affectedRows += $this->aIds->save($con);
				}
				$this->setIds($this->aIds);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = IdsProveedorPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += IdsProveedorPeer::doUpdate($this, $con);
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

			if ($this->aIds !== null) {
				if (!$this->aIds->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aIds->getValidationFailures());
				}
			}


			if (($retval = IdsProveedorPeer::doValidate($this, $columns)) !== true) {
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
		$pos = IdsProveedorPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdproveedor();
				break;
			case 1:
				return $this->getCaTipo();
				break;
			case 2:
				return $this->getCaCritico();
				break;
			case 3:
				return $this->getCaControladoporsig();
				break;
			case 4:
				return $this->getCaFchaprobado();
				break;
			case 5:
				return $this->getCaUsuaprobado();
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
		$keys = IdsProveedorPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdproveedor(),
			$keys[1] => $this->getCaTipo(),
			$keys[2] => $this->getCaCritico(),
			$keys[3] => $this->getCaControladoporsig(),
			$keys[4] => $this->getCaFchaprobado(),
			$keys[5] => $this->getCaUsuaprobado(),
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
		$pos = IdsProveedorPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdproveedor($value);
				break;
			case 1:
				$this->setCaTipo($value);
				break;
			case 2:
				$this->setCaCritico($value);
				break;
			case 3:
				$this->setCaControladoporsig($value);
				break;
			case 4:
				$this->setCaFchaprobado($value);
				break;
			case 5:
				$this->setCaUsuaprobado($value);
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
		$keys = IdsProveedorPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdproveedor($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaTipo($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaCritico($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaControladoporsig($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaFchaprobado($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaUsuaprobado($arr[$keys[5]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(IdsProveedorPeer::DATABASE_NAME);

		if ($this->isColumnModified(IdsProveedorPeer::CA_IDPROVEEDOR)) $criteria->add(IdsProveedorPeer::CA_IDPROVEEDOR, $this->ca_idproveedor);
		if ($this->isColumnModified(IdsProveedorPeer::CA_TIPO)) $criteria->add(IdsProveedorPeer::CA_TIPO, $this->ca_tipo);
		if ($this->isColumnModified(IdsProveedorPeer::CA_CRITICO)) $criteria->add(IdsProveedorPeer::CA_CRITICO, $this->ca_critico);
		if ($this->isColumnModified(IdsProveedorPeer::CA_CONTROLADOPORSIG)) $criteria->add(IdsProveedorPeer::CA_CONTROLADOPORSIG, $this->ca_controladoporsig);
		if ($this->isColumnModified(IdsProveedorPeer::CA_FCHAPROBADO)) $criteria->add(IdsProveedorPeer::CA_FCHAPROBADO, $this->ca_fchaprobado);
		if ($this->isColumnModified(IdsProveedorPeer::CA_USUAPROBADO)) $criteria->add(IdsProveedorPeer::CA_USUAPROBADO, $this->ca_usuaprobado);

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
		$criteria = new Criteria(IdsProveedorPeer::DATABASE_NAME);

		$criteria->add(IdsProveedorPeer::CA_IDPROVEEDOR, $this->ca_idproveedor);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdproveedor();
	}

	/**
	 * Generic method to set the primary key (ca_idproveedor column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdproveedor($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of IdsProveedor (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdproveedor($this->ca_idproveedor);

		$copyObj->setCaTipo($this->ca_tipo);

		$copyObj->setCaCritico($this->ca_critico);

		$copyObj->setCaControladoporsig($this->ca_controladoporsig);

		$copyObj->setCaFchaprobado($this->ca_fchaprobado);

		$copyObj->setCaUsuaprobado($this->ca_usuaprobado);


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
	 * @return     IdsProveedor Clone of current object.
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
	 * @return     IdsProveedorPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new IdsProveedorPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Ids object.
	 *
	 * @param      Ids $v
	 * @return     IdsProveedor The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setIds(Ids $v = null)
	{
		if ($v === null) {
			$this->setCaIdproveedor(NULL);
		} else {
			$this->setCaIdproveedor($v->getCaId());
		}

		$this->aIds = $v;

		// Add binding for other direction of this 1:1 relationship.
		if ($v !== null) {
			$v->setIdsProveedor($this);
		}

		return $this;
	}


	/**
	 * Get the associated Ids object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Ids The associated Ids object.
	 * @throws     PropelException
	 */
	public function getIds(PropelPDO $con = null)
	{
		if ($this->aIds === null && ($this->ca_idproveedor !== null)) {
			$c = new Criteria(IdsPeer::DATABASE_NAME);
			$c->add(IdsPeer::CA_ID, $this->ca_idproveedor);
			$this->aIds = IdsPeer::doSelectOne($c, $con);
			// Because this foreign key represents a one-to-one relationship, we will create a bi-directional association.
			$this->aIds->setIdsProveedor($this);
		}
		return $this->aIds;
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

			$this->aIds = null;
	}

} // BaseIdsProveedor
