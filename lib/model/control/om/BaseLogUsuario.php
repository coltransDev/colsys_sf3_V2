<?php

/**
 * Base class that represents a row from the 'control.tb_log' table.
 *
 * 
 *
 * @package    lib.model.control.om
 */
abstract class BaseLogUsuario extends BaseObject  implements Persistent {


  const PEER = 'LogUsuarioPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        LogUsuarioPeer
	 */
	protected static $peer;

	/**
	 * The value for the ca_idlog field.
	 * @var        int
	 */
	protected $ca_idlog;

	/**
	 * The value for the ca_login field.
	 * @var        string
	 */
	protected $ca_login;

	/**
	 * The value for the ca_event field.
	 * @var        string
	 */
	protected $ca_event;

	/**
	 * The value for the ca_module field.
	 * @var        string
	 */
	protected $ca_module;

	/**
	 * The value for the ca_action field.
	 * @var        string
	 */
	protected $ca_action;

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
	 * Initializes internal state of BaseLogUsuario object.
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
	 * Get the [ca_idlog] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdlog()
	{
		return $this->ca_idlog;
	}

	/**
	 * Get the [ca_login] column value.
	 * 
	 * @return     string
	 */
	public function getCaLogin()
	{
		return $this->ca_login;
	}

	/**
	 * Get the [ca_event] column value.
	 * 
	 * @return     string
	 */
	public function getCaEvent()
	{
		return $this->ca_event;
	}

	/**
	 * Get the [ca_module] column value.
	 * 
	 * @return     string
	 */
	public function getCaModule()
	{
		return $this->ca_module;
	}

	/**
	 * Get the [ca_action] column value.
	 * 
	 * @return     string
	 */
	public function getCaAction()
	{
		return $this->ca_action;
	}

	/**
	 * Set the value of [ca_idlog] column.
	 * 
	 * @param      int $v new value
	 * @return     LogUsuario The current object (for fluent API support)
	 */
	public function setCaIdlog($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idlog !== $v) {
			$this->ca_idlog = $v;
			$this->modifiedColumns[] = LogUsuarioPeer::CA_IDLOG;
		}

		return $this;
	} // setCaIdlog()

	/**
	 * Set the value of [ca_login] column.
	 * 
	 * @param      string $v new value
	 * @return     LogUsuario The current object (for fluent API support)
	 */
	public function setCaLogin($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_login !== $v) {
			$this->ca_login = $v;
			$this->modifiedColumns[] = LogUsuarioPeer::CA_LOGIN;
		}

		return $this;
	} // setCaLogin()

	/**
	 * Set the value of [ca_event] column.
	 * 
	 * @param      string $v new value
	 * @return     LogUsuario The current object (for fluent API support)
	 */
	public function setCaEvent($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_event !== $v) {
			$this->ca_event = $v;
			$this->modifiedColumns[] = LogUsuarioPeer::CA_EVENT;
		}

		return $this;
	} // setCaEvent()

	/**
	 * Set the value of [ca_module] column.
	 * 
	 * @param      string $v new value
	 * @return     LogUsuario The current object (for fluent API support)
	 */
	public function setCaModule($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_module !== $v) {
			$this->ca_module = $v;
			$this->modifiedColumns[] = LogUsuarioPeer::CA_MODULE;
		}

		return $this;
	} // setCaModule()

	/**
	 * Set the value of [ca_action] column.
	 * 
	 * @param      string $v new value
	 * @return     LogUsuario The current object (for fluent API support)
	 */
	public function setCaAction($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_action !== $v) {
			$this->ca_action = $v;
			$this->modifiedColumns[] = LogUsuarioPeer::CA_ACTION;
		}

		return $this;
	} // setCaAction()

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

			$this->ca_idlog = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_login = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_event = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_module = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_action = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 5; // 5 = LogUsuarioPeer::NUM_COLUMNS - LogUsuarioPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating LogUsuario object", $e);
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
			$con = Propel::getConnection(LogUsuarioPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = LogUsuarioPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
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
			$con = Propel::getConnection(LogUsuarioPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			LogUsuarioPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(LogUsuarioPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			LogUsuarioPeer::addInstanceToPool($this);
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


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = LogUsuarioPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += LogUsuarioPeer::doUpdate($this, $con);
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


			if (($retval = LogUsuarioPeer::doValidate($this, $columns)) !== true) {
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
		$pos = LogUsuarioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdlog();
				break;
			case 1:
				return $this->getCaLogin();
				break;
			case 2:
				return $this->getCaEvent();
				break;
			case 3:
				return $this->getCaModule();
				break;
			case 4:
				return $this->getCaAction();
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
		$keys = LogUsuarioPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdlog(),
			$keys[1] => $this->getCaLogin(),
			$keys[2] => $this->getCaEvent(),
			$keys[3] => $this->getCaModule(),
			$keys[4] => $this->getCaAction(),
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
		$pos = LogUsuarioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdlog($value);
				break;
			case 1:
				$this->setCaLogin($value);
				break;
			case 2:
				$this->setCaEvent($value);
				break;
			case 3:
				$this->setCaModule($value);
				break;
			case 4:
				$this->setCaAction($value);
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
		$keys = LogUsuarioPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdlog($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaLogin($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaEvent($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaModule($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaAction($arr[$keys[4]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(LogUsuarioPeer::DATABASE_NAME);

		if ($this->isColumnModified(LogUsuarioPeer::CA_IDLOG)) $criteria->add(LogUsuarioPeer::CA_IDLOG, $this->ca_idlog);
		if ($this->isColumnModified(LogUsuarioPeer::CA_LOGIN)) $criteria->add(LogUsuarioPeer::CA_LOGIN, $this->ca_login);
		if ($this->isColumnModified(LogUsuarioPeer::CA_EVENT)) $criteria->add(LogUsuarioPeer::CA_EVENT, $this->ca_event);
		if ($this->isColumnModified(LogUsuarioPeer::CA_MODULE)) $criteria->add(LogUsuarioPeer::CA_MODULE, $this->ca_module);
		if ($this->isColumnModified(LogUsuarioPeer::CA_ACTION)) $criteria->add(LogUsuarioPeer::CA_ACTION, $this->ca_action);

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
		$criteria = new Criteria(LogUsuarioPeer::DATABASE_NAME);

		$criteria->add(LogUsuarioPeer::CA_IDLOG, $this->ca_idlog);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdlog();
	}

	/**
	 * Generic method to set the primary key (ca_idlog column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdlog($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of LogUsuario (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdlog($this->ca_idlog);

		$copyObj->setCaLogin($this->ca_login);

		$copyObj->setCaEvent($this->ca_event);

		$copyObj->setCaModule($this->ca_module);

		$copyObj->setCaAction($this->ca_action);


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
	 * @return     LogUsuario Clone of current object.
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
	 * @return     LogUsuarioPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new LogUsuarioPeer();
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

} // BaseLogUsuario
