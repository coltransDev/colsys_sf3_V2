<?php

/**
 * Base class that represents a row from the 'control.tb_log' table.
 *
 * 
 *
 * @package    lib.model.control.om
 */
abstract class BaseLogUsuario extends BaseObject  implements Persistent {


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
	 * @return     void
	 */
	public function setCaIdlog($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idlog !== $v) {
			$this->ca_idlog = $v;
			$this->modifiedColumns[] = LogUsuarioPeer::CA_IDLOG;
		}

	} // setCaIdlog()

	/**
	 * Set the value of [ca_login] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaLogin($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_login !== $v) {
			$this->ca_login = $v;
			$this->modifiedColumns[] = LogUsuarioPeer::CA_LOGIN;
		}

	} // setCaLogin()

	/**
	 * Set the value of [ca_event] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaEvent($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_event !== $v) {
			$this->ca_event = $v;
			$this->modifiedColumns[] = LogUsuarioPeer::CA_EVENT;
		}

	} // setCaEvent()

	/**
	 * Set the value of [ca_module] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaModule($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_module !== $v) {
			$this->ca_module = $v;
			$this->modifiedColumns[] = LogUsuarioPeer::CA_MODULE;
		}

	} // setCaModule()

	/**
	 * Set the value of [ca_action] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaAction($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_action !== $v) {
			$this->ca_action = $v;
			$this->modifiedColumns[] = LogUsuarioPeer::CA_ACTION;
		}

	} // setCaAction()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (1-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      ResultSet $rs The ResultSet class with cursor advanced to desired record pos.
	 * @param      int $startcol 1-based offset column which indicates which restultset column to start with.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->ca_idlog = $rs->getInt($startcol + 0);

			$this->ca_login = $rs->getString($startcol + 1);

			$this->ca_event = $rs->getString($startcol + 2);

			$this->ca_module = $rs->getString($startcol + 3);

			$this->ca_action = $rs->getString($startcol + 4);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 5; // 5 = LogUsuarioPeer::NUM_COLUMNS - LogUsuarioPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating LogUsuario object", $e);
		}
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      Connection $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(LogUsuarioPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			LogUsuarioPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Stores the object in the database.  If the object is new,
	 * it inserts it; otherwise an update is performed.  This method
	 * wraps the doSave() worker method in a transaction.
	 *
	 * @param      Connection $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(LogUsuarioPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Stores the object in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      Connection $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave($con)
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
	 *                     one of the class type constants TYPE_PHPNAME,
	 *                     TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = LogUsuarioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
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
	 * @param      string $keyType One of the class type constants TYPE_PHPNAME,
	 *                        TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
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
	 *                     one of the class type constants TYPE_PHPNAME,
	 *                     TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
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
	 * of the class type constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME,
	 * TYPE_NUM. The default key type is the column's phpname (e.g. 'authorId')
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

		$copyObj->setCaLogin($this->ca_login);

		$copyObj->setCaEvent($this->ca_event);

		$copyObj->setCaModule($this->ca_module);

		$copyObj->setCaAction($this->ca_action);


		$copyObj->setNew(true);

		$copyObj->setCaIdlog(NULL); // this is a pkey column, so set to default value

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

} // BaseLogUsuario
