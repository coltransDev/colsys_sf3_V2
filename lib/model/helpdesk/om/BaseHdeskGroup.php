<?php

/**
 * Base class that represents a row from the 'helpdesk.tb_groups' table.
 *
 * 
 *
 * @package    lib.model.helpdesk.om
 */
abstract class BaseHdeskGroup extends BaseObject  implements Persistent {


  const PEER = 'HdeskGroupPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        HdeskGroupPeer
	 */
	protected static $peer;

	/**
	 * The value for the ca_idgroup field.
	 * @var        int
	 */
	protected $ca_idgroup;

	/**
	 * The value for the ca_iddepartament field.
	 * @var        int
	 */
	protected $ca_iddepartament;

	/**
	 * The value for the ca_name field.
	 * @var        string
	 */
	protected $ca_name;

	/**
	 * @var        Departamento
	 */
	protected $aDepartamento;

	/**
	 * @var        array HdeskTicket[] Collection to store aggregation of HdeskTicket objects.
	 */
	protected $collHdeskTickets;

	/**
	 * @var        Criteria The criteria used to select the current contents of collHdeskTickets.
	 */
	private $lastHdeskTicketCriteria = null;

	/**
	 * @var        array HdeskProject[] Collection to store aggregation of HdeskProject objects.
	 */
	protected $collHdeskProjects;

	/**
	 * @var        Criteria The criteria used to select the current contents of collHdeskProjects.
	 */
	private $lastHdeskProjectCriteria = null;

	/**
	 * @var        array HdeskUserGroup[] Collection to store aggregation of HdeskUserGroup objects.
	 */
	protected $collHdeskUserGroups;

	/**
	 * @var        Criteria The criteria used to select the current contents of collHdeskUserGroups.
	 */
	private $lastHdeskUserGroupCriteria = null;

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
	 * Initializes internal state of BaseHdeskGroup object.
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
	 * Get the [ca_idgroup] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdgroup()
	{
		return $this->ca_idgroup;
	}

	/**
	 * Get the [ca_iddepartament] column value.
	 * 
	 * @return     int
	 */
	public function getCaIddepartament()
	{
		return $this->ca_iddepartament;
	}

	/**
	 * Get the [ca_name] column value.
	 * 
	 * @return     string
	 */
	public function getCaName()
	{
		return $this->ca_name;
	}

	/**
	 * Set the value of [ca_idgroup] column.
	 * 
	 * @param      int $v new value
	 * @return     HdeskGroup The current object (for fluent API support)
	 */
	public function setCaIdgroup($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idgroup !== $v) {
			$this->ca_idgroup = $v;
			$this->modifiedColumns[] = HdeskGroupPeer::CA_IDGROUP;
		}

		return $this;
	} // setCaIdgroup()

	/**
	 * Set the value of [ca_iddepartament] column.
	 * 
	 * @param      int $v new value
	 * @return     HdeskGroup The current object (for fluent API support)
	 */
	public function setCaIddepartament($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_iddepartament !== $v) {
			$this->ca_iddepartament = $v;
			$this->modifiedColumns[] = HdeskGroupPeer::CA_IDDEPARTAMENT;
		}

		if ($this->aDepartamento !== null && $this->aDepartamento->getCaIddepartamento() !== $v) {
			$this->aDepartamento = null;
		}

		return $this;
	} // setCaIddepartament()

	/**
	 * Set the value of [ca_name] column.
	 * 
	 * @param      string $v new value
	 * @return     HdeskGroup The current object (for fluent API support)
	 */
	public function setCaName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_name !== $v) {
			$this->ca_name = $v;
			$this->modifiedColumns[] = HdeskGroupPeer::CA_NAME;
		}

		return $this;
	} // setCaName()

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

			$this->ca_idgroup = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_iddepartament = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_name = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 3; // 3 = HdeskGroupPeer::NUM_COLUMNS - HdeskGroupPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating HdeskGroup object", $e);
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

		if ($this->aDepartamento !== null && $this->ca_iddepartament !== $this->aDepartamento->getCaIddepartamento()) {
			$this->aDepartamento = null;
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
			$con = Propel::getConnection(HdeskGroupPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = HdeskGroupPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aDepartamento = null;
			$this->collHdeskTickets = null;
			$this->lastHdeskTicketCriteria = null;

			$this->collHdeskProjects = null;
			$this->lastHdeskProjectCriteria = null;

			$this->collHdeskUserGroups = null;
			$this->lastHdeskUserGroupCriteria = null;

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
			$con = Propel::getConnection(HdeskGroupPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			HdeskGroupPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(HdeskGroupPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			HdeskGroupPeer::addInstanceToPool($this);
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

			if ($this->aDepartamento !== null) {
				if ($this->aDepartamento->isModified() || $this->aDepartamento->isNew()) {
					$affectedRows += $this->aDepartamento->save($con);
				}
				$this->setDepartamento($this->aDepartamento);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = HdeskGroupPeer::CA_IDGROUP;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = HdeskGroupPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setCaIdgroup($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += HdeskGroupPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collHdeskTickets !== null) {
				foreach ($this->collHdeskTickets as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collHdeskProjects !== null) {
				foreach ($this->collHdeskProjects as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collHdeskUserGroups !== null) {
				foreach ($this->collHdeskUserGroups as $referrerFK) {
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

			if ($this->aDepartamento !== null) {
				if (!$this->aDepartamento->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aDepartamento->getValidationFailures());
				}
			}


			if (($retval = HdeskGroupPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collHdeskTickets !== null) {
					foreach ($this->collHdeskTickets as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collHdeskProjects !== null) {
					foreach ($this->collHdeskProjects as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collHdeskUserGroups !== null) {
					foreach ($this->collHdeskUserGroups as $referrerFK) {
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
		$pos = HdeskGroupPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdgroup();
				break;
			case 1:
				return $this->getCaIddepartament();
				break;
			case 2:
				return $this->getCaName();
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
		$keys = HdeskGroupPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdgroup(),
			$keys[1] => $this->getCaIddepartament(),
			$keys[2] => $this->getCaName(),
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
		$pos = HdeskGroupPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdgroup($value);
				break;
			case 1:
				$this->setCaIddepartament($value);
				break;
			case 2:
				$this->setCaName($value);
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
		$keys = HdeskGroupPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdgroup($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIddepartament($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaName($arr[$keys[2]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(HdeskGroupPeer::DATABASE_NAME);

		if ($this->isColumnModified(HdeskGroupPeer::CA_IDGROUP)) $criteria->add(HdeskGroupPeer::CA_IDGROUP, $this->ca_idgroup);
		if ($this->isColumnModified(HdeskGroupPeer::CA_IDDEPARTAMENT)) $criteria->add(HdeskGroupPeer::CA_IDDEPARTAMENT, $this->ca_iddepartament);
		if ($this->isColumnModified(HdeskGroupPeer::CA_NAME)) $criteria->add(HdeskGroupPeer::CA_NAME, $this->ca_name);

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
		$criteria = new Criteria(HdeskGroupPeer::DATABASE_NAME);

		$criteria->add(HdeskGroupPeer::CA_IDGROUP, $this->ca_idgroup);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdgroup();
	}

	/**
	 * Generic method to set the primary key (ca_idgroup column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdgroup($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of HdeskGroup (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIddepartament($this->ca_iddepartament);

		$copyObj->setCaName($this->ca_name);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getHdeskTickets() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addHdeskTicket($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getHdeskProjects() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addHdeskProject($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getHdeskUserGroups() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addHdeskUserGroup($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setCaIdgroup(NULL); // this is a auto-increment column, so set to default value

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
	 * @return     HdeskGroup Clone of current object.
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
	 * @return     HdeskGroupPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new HdeskGroupPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Departamento object.
	 *
	 * @param      Departamento $v
	 * @return     HdeskGroup The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setDepartamento(Departamento $v = null)
	{
		if ($v === null) {
			$this->setCaIddepartament(NULL);
		} else {
			$this->setCaIddepartament($v->getCaIddepartamento());
		}

		$this->aDepartamento = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Departamento object, it will not be re-added.
		if ($v !== null) {
			$v->addHdeskGroup($this);
		}

		return $this;
	}


	/**
	 * Get the associated Departamento object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Departamento The associated Departamento object.
	 * @throws     PropelException
	 */
	public function getDepartamento(PropelPDO $con = null)
	{
		if ($this->aDepartamento === null && ($this->ca_iddepartament !== null)) {
			$c = new Criteria(DepartamentoPeer::DATABASE_NAME);
			$c->add(DepartamentoPeer::CA_IDDEPARTAMENTO, $this->ca_iddepartament);
			$this->aDepartamento = DepartamentoPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aDepartamento->addHdeskGroups($this);
			 */
		}
		return $this->aDepartamento;
	}

	/**
	 * Clears out the collHdeskTickets collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addHdeskTickets()
	 */
	public function clearHdeskTickets()
	{
		$this->collHdeskTickets = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collHdeskTickets collection (array).
	 *
	 * By default this just sets the collHdeskTickets collection to an empty array (like clearcollHdeskTickets());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initHdeskTickets()
	{
		$this->collHdeskTickets = array();
	}

	/**
	 * Gets an array of HdeskTicket objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this HdeskGroup has previously been saved, it will retrieve
	 * related HdeskTickets from storage. If this HdeskGroup is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array HdeskTicket[]
	 * @throws     PropelException
	 */
	public function getHdeskTickets($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(HdeskGroupPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskTickets === null) {
			if ($this->isNew()) {
			   $this->collHdeskTickets = array();
			} else {

				$criteria->add(HdeskTicketPeer::CA_IDGROUP, $this->ca_idgroup);

				HdeskTicketPeer::addSelectColumns($criteria);
				$this->collHdeskTickets = HdeskTicketPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(HdeskTicketPeer::CA_IDGROUP, $this->ca_idgroup);

				HdeskTicketPeer::addSelectColumns($criteria);
				if (!isset($this->lastHdeskTicketCriteria) || !$this->lastHdeskTicketCriteria->equals($criteria)) {
					$this->collHdeskTickets = HdeskTicketPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastHdeskTicketCriteria = $criteria;
		return $this->collHdeskTickets;
	}

	/**
	 * Returns the number of related HdeskTicket objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related HdeskTicket objects.
	 * @throws     PropelException
	 */
	public function countHdeskTickets(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(HdeskGroupPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collHdeskTickets === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(HdeskTicketPeer::CA_IDGROUP, $this->ca_idgroup);

				$count = HdeskTicketPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(HdeskTicketPeer::CA_IDGROUP, $this->ca_idgroup);

				if (!isset($this->lastHdeskTicketCriteria) || !$this->lastHdeskTicketCriteria->equals($criteria)) {
					$count = HdeskTicketPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collHdeskTickets);
				}
			} else {
				$count = count($this->collHdeskTickets);
			}
		}
		$this->lastHdeskTicketCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a HdeskTicket object to this object
	 * through the HdeskTicket foreign key attribute.
	 *
	 * @param      HdeskTicket $l HdeskTicket
	 * @return     void
	 * @throws     PropelException
	 */
	public function addHdeskTicket(HdeskTicket $l)
	{
		if ($this->collHdeskTickets === null) {
			$this->initHdeskTickets();
		}
		if (!in_array($l, $this->collHdeskTickets, true)) { // only add it if the **same** object is not already associated
			array_push($this->collHdeskTickets, $l);
			$l->setHdeskGroup($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this HdeskGroup is new, it will return
	 * an empty collection; or if this HdeskGroup has previously
	 * been saved, it will retrieve related HdeskTickets from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in HdeskGroup.
	 */
	public function getHdeskTicketsJoinUsuario($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(HdeskGroupPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskTickets === null) {
			if ($this->isNew()) {
				$this->collHdeskTickets = array();
			} else {

				$criteria->add(HdeskTicketPeer::CA_IDGROUP, $this->ca_idgroup);

				$this->collHdeskTickets = HdeskTicketPeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(HdeskTicketPeer::CA_IDGROUP, $this->ca_idgroup);

			if (!isset($this->lastHdeskTicketCriteria) || !$this->lastHdeskTicketCriteria->equals($criteria)) {
				$this->collHdeskTickets = HdeskTicketPeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		}
		$this->lastHdeskTicketCriteria = $criteria;

		return $this->collHdeskTickets;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this HdeskGroup is new, it will return
	 * an empty collection; or if this HdeskGroup has previously
	 * been saved, it will retrieve related HdeskTickets from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in HdeskGroup.
	 */
	public function getHdeskTicketsJoinHdeskProject($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(HdeskGroupPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskTickets === null) {
			if ($this->isNew()) {
				$this->collHdeskTickets = array();
			} else {

				$criteria->add(HdeskTicketPeer::CA_IDGROUP, $this->ca_idgroup);

				$this->collHdeskTickets = HdeskTicketPeer::doSelectJoinHdeskProject($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(HdeskTicketPeer::CA_IDGROUP, $this->ca_idgroup);

			if (!isset($this->lastHdeskTicketCriteria) || !$this->lastHdeskTicketCriteria->equals($criteria)) {
				$this->collHdeskTickets = HdeskTicketPeer::doSelectJoinHdeskProject($criteria, $con, $join_behavior);
			}
		}
		$this->lastHdeskTicketCriteria = $criteria;

		return $this->collHdeskTickets;
	}

	/**
	 * Clears out the collHdeskProjects collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addHdeskProjects()
	 */
	public function clearHdeskProjects()
	{
		$this->collHdeskProjects = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collHdeskProjects collection (array).
	 *
	 * By default this just sets the collHdeskProjects collection to an empty array (like clearcollHdeskProjects());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initHdeskProjects()
	{
		$this->collHdeskProjects = array();
	}

	/**
	 * Gets an array of HdeskProject objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this HdeskGroup has previously been saved, it will retrieve
	 * related HdeskProjects from storage. If this HdeskGroup is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array HdeskProject[]
	 * @throws     PropelException
	 */
	public function getHdeskProjects($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(HdeskGroupPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskProjects === null) {
			if ($this->isNew()) {
			   $this->collHdeskProjects = array();
			} else {

				$criteria->add(HdeskProjectPeer::CA_IDGROUP, $this->ca_idgroup);

				HdeskProjectPeer::addSelectColumns($criteria);
				$this->collHdeskProjects = HdeskProjectPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(HdeskProjectPeer::CA_IDGROUP, $this->ca_idgroup);

				HdeskProjectPeer::addSelectColumns($criteria);
				if (!isset($this->lastHdeskProjectCriteria) || !$this->lastHdeskProjectCriteria->equals($criteria)) {
					$this->collHdeskProjects = HdeskProjectPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastHdeskProjectCriteria = $criteria;
		return $this->collHdeskProjects;
	}

	/**
	 * Returns the number of related HdeskProject objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related HdeskProject objects.
	 * @throws     PropelException
	 */
	public function countHdeskProjects(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(HdeskGroupPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collHdeskProjects === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(HdeskProjectPeer::CA_IDGROUP, $this->ca_idgroup);

				$count = HdeskProjectPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(HdeskProjectPeer::CA_IDGROUP, $this->ca_idgroup);

				if (!isset($this->lastHdeskProjectCriteria) || !$this->lastHdeskProjectCriteria->equals($criteria)) {
					$count = HdeskProjectPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collHdeskProjects);
				}
			} else {
				$count = count($this->collHdeskProjects);
			}
		}
		$this->lastHdeskProjectCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a HdeskProject object to this object
	 * through the HdeskProject foreign key attribute.
	 *
	 * @param      HdeskProject $l HdeskProject
	 * @return     void
	 * @throws     PropelException
	 */
	public function addHdeskProject(HdeskProject $l)
	{
		if ($this->collHdeskProjects === null) {
			$this->initHdeskProjects();
		}
		if (!in_array($l, $this->collHdeskProjects, true)) { // only add it if the **same** object is not already associated
			array_push($this->collHdeskProjects, $l);
			$l->setHdeskGroup($this);
		}
	}

	/**
	 * Clears out the collHdeskUserGroups collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addHdeskUserGroups()
	 */
	public function clearHdeskUserGroups()
	{
		$this->collHdeskUserGroups = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collHdeskUserGroups collection (array).
	 *
	 * By default this just sets the collHdeskUserGroups collection to an empty array (like clearcollHdeskUserGroups());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initHdeskUserGroups()
	{
		$this->collHdeskUserGroups = array();
	}

	/**
	 * Gets an array of HdeskUserGroup objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this HdeskGroup has previously been saved, it will retrieve
	 * related HdeskUserGroups from storage. If this HdeskGroup is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array HdeskUserGroup[]
	 * @throws     PropelException
	 */
	public function getHdeskUserGroups($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(HdeskGroupPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskUserGroups === null) {
			if ($this->isNew()) {
			   $this->collHdeskUserGroups = array();
			} else {

				$criteria->add(HdeskUserGroupPeer::CA_IDGROUP, $this->ca_idgroup);

				HdeskUserGroupPeer::addSelectColumns($criteria);
				$this->collHdeskUserGroups = HdeskUserGroupPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(HdeskUserGroupPeer::CA_IDGROUP, $this->ca_idgroup);

				HdeskUserGroupPeer::addSelectColumns($criteria);
				if (!isset($this->lastHdeskUserGroupCriteria) || !$this->lastHdeskUserGroupCriteria->equals($criteria)) {
					$this->collHdeskUserGroups = HdeskUserGroupPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastHdeskUserGroupCriteria = $criteria;
		return $this->collHdeskUserGroups;
	}

	/**
	 * Returns the number of related HdeskUserGroup objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related HdeskUserGroup objects.
	 * @throws     PropelException
	 */
	public function countHdeskUserGroups(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(HdeskGroupPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collHdeskUserGroups === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(HdeskUserGroupPeer::CA_IDGROUP, $this->ca_idgroup);

				$count = HdeskUserGroupPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(HdeskUserGroupPeer::CA_IDGROUP, $this->ca_idgroup);

				if (!isset($this->lastHdeskUserGroupCriteria) || !$this->lastHdeskUserGroupCriteria->equals($criteria)) {
					$count = HdeskUserGroupPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collHdeskUserGroups);
				}
			} else {
				$count = count($this->collHdeskUserGroups);
			}
		}
		$this->lastHdeskUserGroupCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a HdeskUserGroup object to this object
	 * through the HdeskUserGroup foreign key attribute.
	 *
	 * @param      HdeskUserGroup $l HdeskUserGroup
	 * @return     void
	 * @throws     PropelException
	 */
	public function addHdeskUserGroup(HdeskUserGroup $l)
	{
		if ($this->collHdeskUserGroups === null) {
			$this->initHdeskUserGroups();
		}
		if (!in_array($l, $this->collHdeskUserGroups, true)) { // only add it if the **same** object is not already associated
			array_push($this->collHdeskUserGroups, $l);
			$l->setHdeskGroup($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this HdeskGroup is new, it will return
	 * an empty collection; or if this HdeskGroup has previously
	 * been saved, it will retrieve related HdeskUserGroups from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in HdeskGroup.
	 */
	public function getHdeskUserGroupsJoinUsuario($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(HdeskGroupPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskUserGroups === null) {
			if ($this->isNew()) {
				$this->collHdeskUserGroups = array();
			} else {

				$criteria->add(HdeskUserGroupPeer::CA_IDGROUP, $this->ca_idgroup);

				$this->collHdeskUserGroups = HdeskUserGroupPeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(HdeskUserGroupPeer::CA_IDGROUP, $this->ca_idgroup);

			if (!isset($this->lastHdeskUserGroupCriteria) || !$this->lastHdeskUserGroupCriteria->equals($criteria)) {
				$this->collHdeskUserGroups = HdeskUserGroupPeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		}
		$this->lastHdeskUserGroupCriteria = $criteria;

		return $this->collHdeskUserGroups;
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
			if ($this->collHdeskTickets) {
				foreach ((array) $this->collHdeskTickets as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collHdeskProjects) {
				foreach ((array) $this->collHdeskProjects as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collHdeskUserGroups) {
				foreach ((array) $this->collHdeskUserGroups as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collHdeskTickets = null;
		$this->collHdeskProjects = null;
		$this->collHdeskUserGroups = null;
			$this->aDepartamento = null;
	}

} // BaseHdeskGroup
