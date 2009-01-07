<?php

/**
 * Base class that represents a row from the 'tb_sdnaka' table.
 *
 * 
 *
 * @package    lib.model.sdnlist.om
 */
abstract class BaseSdnAka extends BaseObject  implements Persistent {


  const PEER = 'SdnAkaPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        SdnAkaPeer
	 */
	protected static $peer;

	/**
	 * The value for the ca_uid field.
	 * @var        string
	 */
	protected $ca_uid;

	/**
	 * The value for the ca_uid_aka field.
	 * @var        string
	 */
	protected $ca_uid_aka;

	/**
	 * The value for the ca_type field.
	 * @var        string
	 */
	protected $ca_type;

	/**
	 * The value for the ca_category field.
	 * @var        string
	 */
	protected $ca_category;

	/**
	 * The value for the ca_firstname field.
	 * @var        string
	 */
	protected $ca_firstname;

	/**
	 * The value for the ca_lastname field.
	 * @var        string
	 */
	protected $ca_lastname;

	/**
	 * @var        Sdn
	 */
	protected $aSdn;

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
	 * Initializes internal state of BaseSdnAka object.
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
	 * Get the [ca_uid] column value.
	 * 
	 * @return     string
	 */
	public function getCaUid()
	{
		return $this->ca_uid;
	}

	/**
	 * Get the [ca_uid_aka] column value.
	 * 
	 * @return     string
	 */
	public function getCaUidAka()
	{
		return $this->ca_uid_aka;
	}

	/**
	 * Get the [ca_type] column value.
	 * 
	 * @return     string
	 */
	public function getCaType()
	{
		return $this->ca_type;
	}

	/**
	 * Get the [ca_category] column value.
	 * 
	 * @return     string
	 */
	public function getCaCategory()
	{
		return $this->ca_category;
	}

	/**
	 * Get the [ca_firstname] column value.
	 * 
	 * @return     string
	 */
	public function getCaFirstname()
	{
		return $this->ca_firstname;
	}

	/**
	 * Get the [ca_lastname] column value.
	 * 
	 * @return     string
	 */
	public function getCaLastname()
	{
		return $this->ca_lastname;
	}

	/**
	 * Set the value of [ca_uid] column.
	 * 
	 * @param      string $v new value
	 * @return     SdnAka The current object (for fluent API support)
	 */
	public function setCaUid($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_uid !== $v) {
			$this->ca_uid = $v;
			$this->modifiedColumns[] = SdnAkaPeer::CA_UID;
		}

		if ($this->aSdn !== null && $this->aSdn->getCaUid() !== $v) {
			$this->aSdn = null;
		}

		return $this;
	} // setCaUid()

	/**
	 * Set the value of [ca_uid_aka] column.
	 * 
	 * @param      string $v new value
	 * @return     SdnAka The current object (for fluent API support)
	 */
	public function setCaUidAka($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_uid_aka !== $v) {
			$this->ca_uid_aka = $v;
			$this->modifiedColumns[] = SdnAkaPeer::CA_UID_AKA;
		}

		return $this;
	} // setCaUidAka()

	/**
	 * Set the value of [ca_type] column.
	 * 
	 * @param      string $v new value
	 * @return     SdnAka The current object (for fluent API support)
	 */
	public function setCaType($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_type !== $v) {
			$this->ca_type = $v;
			$this->modifiedColumns[] = SdnAkaPeer::CA_TYPE;
		}

		return $this;
	} // setCaType()

	/**
	 * Set the value of [ca_category] column.
	 * 
	 * @param      string $v new value
	 * @return     SdnAka The current object (for fluent API support)
	 */
	public function setCaCategory($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_category !== $v) {
			$this->ca_category = $v;
			$this->modifiedColumns[] = SdnAkaPeer::CA_CATEGORY;
		}

		return $this;
	} // setCaCategory()

	/**
	 * Set the value of [ca_firstname] column.
	 * 
	 * @param      string $v new value
	 * @return     SdnAka The current object (for fluent API support)
	 */
	public function setCaFirstname($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_firstname !== $v) {
			$this->ca_firstname = $v;
			$this->modifiedColumns[] = SdnAkaPeer::CA_FIRSTNAME;
		}

		return $this;
	} // setCaFirstname()

	/**
	 * Set the value of [ca_lastname] column.
	 * 
	 * @param      string $v new value
	 * @return     SdnAka The current object (for fluent API support)
	 */
	public function setCaLastname($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_lastname !== $v) {
			$this->ca_lastname = $v;
			$this->modifiedColumns[] = SdnAkaPeer::CA_LASTNAME;
		}

		return $this;
	} // setCaLastname()

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

			$this->ca_uid = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ca_uid_aka = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_type = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_category = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_firstname = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_lastname = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 6; // 6 = SdnAkaPeer::NUM_COLUMNS - SdnAkaPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating SdnAka object", $e);
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

		if ($this->aSdn !== null && $this->ca_uid !== $this->aSdn->getCaUid()) {
			$this->aSdn = null;
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
			$con = Propel::getConnection(SdnAkaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = SdnAkaPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aSdn = null;
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
			$con = Propel::getConnection(SdnAkaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			SdnAkaPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(SdnAkaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			SdnAkaPeer::addInstanceToPool($this);
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

			if ($this->aSdn !== null) {
				if ($this->aSdn->isModified() || $this->aSdn->isNew()) {
					$affectedRows += $this->aSdn->save($con);
				}
				$this->setSdn($this->aSdn);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = SdnAkaPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += SdnAkaPeer::doUpdate($this, $con);
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

			if ($this->aSdn !== null) {
				if (!$this->aSdn->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSdn->getValidationFailures());
				}
			}


			if (($retval = SdnAkaPeer::doValidate($this, $columns)) !== true) {
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
		$pos = SdnAkaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaUid();
				break;
			case 1:
				return $this->getCaUidAka();
				break;
			case 2:
				return $this->getCaType();
				break;
			case 3:
				return $this->getCaCategory();
				break;
			case 4:
				return $this->getCaFirstname();
				break;
			case 5:
				return $this->getCaLastname();
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
		$keys = SdnAkaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaUid(),
			$keys[1] => $this->getCaUidAka(),
			$keys[2] => $this->getCaType(),
			$keys[3] => $this->getCaCategory(),
			$keys[4] => $this->getCaFirstname(),
			$keys[5] => $this->getCaLastname(),
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
		$pos = SdnAkaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaUid($value);
				break;
			case 1:
				$this->setCaUidAka($value);
				break;
			case 2:
				$this->setCaType($value);
				break;
			case 3:
				$this->setCaCategory($value);
				break;
			case 4:
				$this->setCaFirstname($value);
				break;
			case 5:
				$this->setCaLastname($value);
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
		$keys = SdnAkaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaUid($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaUidAka($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaType($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaCategory($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaFirstname($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaLastname($arr[$keys[5]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(SdnAkaPeer::DATABASE_NAME);

		if ($this->isColumnModified(SdnAkaPeer::CA_UID)) $criteria->add(SdnAkaPeer::CA_UID, $this->ca_uid);
		if ($this->isColumnModified(SdnAkaPeer::CA_UID_AKA)) $criteria->add(SdnAkaPeer::CA_UID_AKA, $this->ca_uid_aka);
		if ($this->isColumnModified(SdnAkaPeer::CA_TYPE)) $criteria->add(SdnAkaPeer::CA_TYPE, $this->ca_type);
		if ($this->isColumnModified(SdnAkaPeer::CA_CATEGORY)) $criteria->add(SdnAkaPeer::CA_CATEGORY, $this->ca_category);
		if ($this->isColumnModified(SdnAkaPeer::CA_FIRSTNAME)) $criteria->add(SdnAkaPeer::CA_FIRSTNAME, $this->ca_firstname);
		if ($this->isColumnModified(SdnAkaPeer::CA_LASTNAME)) $criteria->add(SdnAkaPeer::CA_LASTNAME, $this->ca_lastname);

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
		$criteria = new Criteria(SdnAkaPeer::DATABASE_NAME);

		$criteria->add(SdnAkaPeer::CA_UID, $this->ca_uid);
		$criteria->add(SdnAkaPeer::CA_UID_AKA, $this->ca_uid_aka);

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

		$pks[0] = $this->getCaUid();

		$pks[1] = $this->getCaUidAka();

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

		$this->setCaUid($keys[0]);

		$this->setCaUidAka($keys[1]);

	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of SdnAka (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaUid($this->ca_uid);

		$copyObj->setCaUidAka($this->ca_uid_aka);

		$copyObj->setCaType($this->ca_type);

		$copyObj->setCaCategory($this->ca_category);

		$copyObj->setCaFirstname($this->ca_firstname);

		$copyObj->setCaLastname($this->ca_lastname);


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
	 * @return     SdnAka Clone of current object.
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
	 * @return     SdnAkaPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new SdnAkaPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Sdn object.
	 *
	 * @param      Sdn $v
	 * @return     SdnAka The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setSdn(Sdn $v = null)
	{
		if ($v === null) {
			$this->setCaUid(NULL);
		} else {
			$this->setCaUid($v->getCaUid());
		}

		$this->aSdn = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Sdn object, it will not be re-added.
		if ($v !== null) {
			$v->addSdnAka($this);
		}

		return $this;
	}


	/**
	 * Get the associated Sdn object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Sdn The associated Sdn object.
	 * @throws     PropelException
	 */
	public function getSdn(PropelPDO $con = null)
	{
		if ($this->aSdn === null && (($this->ca_uid !== "" && $this->ca_uid !== null))) {
			$c = new Criteria(SdnPeer::DATABASE_NAME);
			$c->add(SdnPeer::CA_UID, $this->ca_uid);
			$this->aSdn = SdnPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aSdn->addSdnAkas($this);
			 */
		}
		return $this->aSdn;
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

			$this->aSdn = null;
	}

} // BaseSdnAka
