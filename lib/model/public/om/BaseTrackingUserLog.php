<?php

/**
 * Base class that represents a row from the 'tb_tracking_users_log' table.
 *
 * 
 *
 * @package    lib.model.public.om
 */
abstract class BaseTrackingUserLog extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        TrackingUserLogPeer
	 */
	protected static $peer;


	/**
	 * The value for the ca_id field.
	 * @var        int
	 */
	protected $ca_id;


	/**
	 * The value for the ca_email field.
	 * @var        string
	 */
	protected $ca_email;


	/**
	 * The value for the ca_fchevento field.
	 * @var        int
	 */
	protected $ca_fchevento;


	/**
	 * The value for the ca_url field.
	 * @var        string
	 */
	protected $ca_url;


	/**
	 * The value for the ca_evento field.
	 * @var        string
	 */
	protected $ca_evento;


	/**
	 * The value for the ca_ipaddress field.
	 * @var        string
	 */
	protected $ca_ipaddress;

	/**
	 * @var        TrackingUser
	 */
	protected $aTrackingUser;

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
	 * Get the [ca_id] column value.
	 * 
	 * @return     int
	 */
	public function getCaId()
	{

		return $this->ca_id;
	}

	/**
	 * Get the [ca_email] column value.
	 * 
	 * @return     string
	 */
	public function getCaEmail()
	{

		return $this->ca_email;
	}

	/**
	 * Get the [optionally formatted] [ca_fchevento] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchevento($format = 'Y-m-d H:i:s')
	{

		if ($this->ca_fchevento === null || $this->ca_fchevento === '') {
			return null;
		} elseif (!is_int($this->ca_fchevento)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_fchevento);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_fchevento] as date/time value: " . var_export($this->ca_fchevento, true));
			}
		} else {
			$ts = $this->ca_fchevento;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	/**
	 * Get the [ca_url] column value.
	 * 
	 * @return     string
	 */
	public function getCaUrl()
	{

		return $this->ca_url;
	}

	/**
	 * Get the [ca_evento] column value.
	 * 
	 * @return     string
	 */
	public function getCaEvento()
	{

		return $this->ca_evento;
	}

	/**
	 * Get the [ca_ipaddress] column value.
	 * 
	 * @return     string
	 */
	public function getCaIpaddress()
	{

		return $this->ca_ipaddress;
	}

	/**
	 * Set the value of [ca_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_id !== $v) {
			$this->ca_id = $v;
			$this->modifiedColumns[] = TrackingUserLogPeer::CA_ID;
		}

	} // setCaId()

	/**
	 * Set the value of [ca_email] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaEmail($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_email !== $v) {
			$this->ca_email = $v;
			$this->modifiedColumns[] = TrackingUserLogPeer::CA_EMAIL;
		}

		if ($this->aTrackingUser !== null && $this->aTrackingUser->getCaEmail() !== $v) {
			$this->aTrackingUser = null;
		}

	} // setCaEmail()

	/**
	 * Set the value of [ca_fchevento] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaFchevento($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_fchevento] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_fchevento !== $ts) {
			$this->ca_fchevento = $ts;
			$this->modifiedColumns[] = TrackingUserLogPeer::CA_FCHEVENTO;
		}

	} // setCaFchevento()

	/**
	 * Set the value of [ca_url] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaUrl($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_url !== $v) {
			$this->ca_url = $v;
			$this->modifiedColumns[] = TrackingUserLogPeer::CA_URL;
		}

	} // setCaUrl()

	/**
	 * Set the value of [ca_evento] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaEvento($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_evento !== $v) {
			$this->ca_evento = $v;
			$this->modifiedColumns[] = TrackingUserLogPeer::CA_EVENTO;
		}

	} // setCaEvento()

	/**
	 * Set the value of [ca_ipaddress] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaIpaddress($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_ipaddress !== $v) {
			$this->ca_ipaddress = $v;
			$this->modifiedColumns[] = TrackingUserLogPeer::CA_IPADDRESS;
		}

	} // setCaIpaddress()

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

			$this->ca_id = $rs->getInt($startcol + 0);

			$this->ca_email = $rs->getString($startcol + 1);

			$this->ca_fchevento = $rs->getTimestamp($startcol + 2, null);

			$this->ca_url = $rs->getString($startcol + 3);

			$this->ca_evento = $rs->getString($startcol + 4);

			$this->ca_ipaddress = $rs->getString($startcol + 5);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 6; // 6 = TrackingUserLogPeer::NUM_COLUMNS - TrackingUserLogPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating TrackingUserLog object", $e);
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
			$con = Propel::getConnection(TrackingUserLogPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			TrackingUserLogPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(TrackingUserLogPeer::DATABASE_NAME);
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


			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aTrackingUser !== null) {
				if ($this->aTrackingUser->isModified()) {
					$affectedRows += $this->aTrackingUser->save($con);
				}
				$this->setTrackingUser($this->aTrackingUser);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TrackingUserLogPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setCaId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += TrackingUserLogPeer::doUpdate($this, $con);
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

			if ($this->aTrackingUser !== null) {
				if (!$this->aTrackingUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTrackingUser->getValidationFailures());
				}
			}


			if (($retval = TrackingUserLogPeer::doValidate($this, $columns)) !== true) {
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
		$pos = TrackingUserLogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaId();
				break;
			case 1:
				return $this->getCaEmail();
				break;
			case 2:
				return $this->getCaFchevento();
				break;
			case 3:
				return $this->getCaUrl();
				break;
			case 4:
				return $this->getCaEvento();
				break;
			case 5:
				return $this->getCaIpaddress();
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
		$keys = TrackingUserLogPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaId(),
			$keys[1] => $this->getCaEmail(),
			$keys[2] => $this->getCaFchevento(),
			$keys[3] => $this->getCaUrl(),
			$keys[4] => $this->getCaEvento(),
			$keys[5] => $this->getCaIpaddress(),
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
		$pos = TrackingUserLogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaId($value);
				break;
			case 1:
				$this->setCaEmail($value);
				break;
			case 2:
				$this->setCaFchevento($value);
				break;
			case 3:
				$this->setCaUrl($value);
				break;
			case 4:
				$this->setCaEvento($value);
				break;
			case 5:
				$this->setCaIpaddress($value);
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
		$keys = TrackingUserLogPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaEmail($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaFchevento($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaUrl($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaEvento($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaIpaddress($arr[$keys[5]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(TrackingUserLogPeer::DATABASE_NAME);

		if ($this->isColumnModified(TrackingUserLogPeer::CA_ID)) $criteria->add(TrackingUserLogPeer::CA_ID, $this->ca_id);
		if ($this->isColumnModified(TrackingUserLogPeer::CA_EMAIL)) $criteria->add(TrackingUserLogPeer::CA_EMAIL, $this->ca_email);
		if ($this->isColumnModified(TrackingUserLogPeer::CA_FCHEVENTO)) $criteria->add(TrackingUserLogPeer::CA_FCHEVENTO, $this->ca_fchevento);
		if ($this->isColumnModified(TrackingUserLogPeer::CA_URL)) $criteria->add(TrackingUserLogPeer::CA_URL, $this->ca_url);
		if ($this->isColumnModified(TrackingUserLogPeer::CA_EVENTO)) $criteria->add(TrackingUserLogPeer::CA_EVENTO, $this->ca_evento);
		if ($this->isColumnModified(TrackingUserLogPeer::CA_IPADDRESS)) $criteria->add(TrackingUserLogPeer::CA_IPADDRESS, $this->ca_ipaddress);

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
		$criteria = new Criteria(TrackingUserLogPeer::DATABASE_NAME);

		$criteria->add(TrackingUserLogPeer::CA_ID, $this->ca_id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCaId();
	}

	/**
	 * Generic method to set the primary key (ca_id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaId($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of TrackingUserLog (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaEmail($this->ca_email);

		$copyObj->setCaFchevento($this->ca_fchevento);

		$copyObj->setCaUrl($this->ca_url);

		$copyObj->setCaEvento($this->ca_evento);

		$copyObj->setCaIpaddress($this->ca_ipaddress);


		$copyObj->setNew(true);

		$copyObj->setCaId(NULL); // this is a pkey column, so set to default value

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
	 * @return     TrackingUserLog Clone of current object.
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
	 * @return     TrackingUserLogPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new TrackingUserLogPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a TrackingUser object.
	 *
	 * @param      TrackingUser $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setTrackingUser($v)
	{


		if ($v === null) {
			$this->setCaEmail(NULL);
		} else {
			$this->setCaEmail($v->getCaEmail());
		}


		$this->aTrackingUser = $v;
	}


	/**
	 * Get the associated TrackingUser object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     TrackingUser The associated TrackingUser object.
	 * @throws     PropelException
	 */
	public function getTrackingUser($con = null)
	{
		if ($this->aTrackingUser === null && (($this->ca_email !== "" && $this->ca_email !== null))) {
			// include the related Peer class
			$this->aTrackingUser = TrackingUserPeer::retrieveByPK($this->ca_email, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = TrackingUserPeer::retrieveByPK($this->ca_email, $con);
			   $obj->addTrackingUsers($this);
			 */
		}
		return $this->aTrackingUser;
	}

} // BaseTrackingUserLog
