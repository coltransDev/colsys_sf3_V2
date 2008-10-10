<?php

/**
 * Base class that represents a row from the 'tb_tracking_users' table.
 *
 * 
 *
 * @package    lib.model.public.om
 */
abstract class BaseTrackingUser extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        TrackingUserPeer
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
	 * The value for the ca_blocked field.
	 * @var        boolean
	 */
	protected $ca_blocked;


	/**
	 * The value for the ca_activation_code field.
	 * @var        string
	 */
	protected $ca_activation_code;


	/**
	 * The value for the ca_passwd field.
	 * @var        string
	 */
	protected $ca_passwd;


	/**
	 * The value for the ca_password_expiry field.
	 * @var        int
	 */
	protected $ca_password_expiry;


	/**
	 * The value for the ca_activated field.
	 * @var        boolean
	 */
	protected $ca_activated;


	/**
	 * The value for the ca_idcontacto field.
	 * @var        int
	 */
	protected $ca_idcontacto;

	/**
	 * @var        Contacto
	 */
	protected $aContacto;

	/**
	 * Collection to store aggregation of collTrackingUserLogs.
	 * @var        array
	 */
	protected $collTrackingUserLogs;

	/**
	 * The criteria used to select the current contents of collTrackingUserLogs.
	 * @var        Criteria
	 */
	protected $lastTrackingUserLogCriteria = null;

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
	 * Get the [ca_blocked] column value.
	 * 
	 * @return     boolean
	 */
	public function getCaBlocked()
	{

		return $this->ca_blocked;
	}

	/**
	 * Get the [ca_activation_code] column value.
	 * 
	 * @return     string
	 */
	public function getCaActivationCode()
	{

		return $this->ca_activation_code;
	}

	/**
	 * Get the [ca_passwd] column value.
	 * 
	 * @return     string
	 */
	public function getCaPasswd()
	{

		return $this->ca_passwd;
	}

	/**
	 * Get the [optionally formatted] [ca_password_expiry] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaPasswordExpiry($format = 'Y-m-d')
	{

		if ($this->ca_password_expiry === null || $this->ca_password_expiry === '') {
			return null;
		} elseif (!is_int($this->ca_password_expiry)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_password_expiry);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_password_expiry] as date/time value: " . var_export($this->ca_password_expiry, true));
			}
		} else {
			$ts = $this->ca_password_expiry;
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
	 * Get the [ca_activated] column value.
	 * 
	 * @return     boolean
	 */
	public function getCaActivated()
	{

		return $this->ca_activated;
	}

	/**
	 * Get the [ca_idcontacto] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdcontacto()
	{

		return $this->ca_idcontacto;
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
			$this->modifiedColumns[] = TrackingUserPeer::CA_ID;
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
			$this->modifiedColumns[] = TrackingUserPeer::CA_EMAIL;
		}

	} // setCaEmail()

	/**
	 * Set the value of [ca_blocked] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setCaBlocked($v)
	{

		if ($this->ca_blocked !== $v) {
			$this->ca_blocked = $v;
			$this->modifiedColumns[] = TrackingUserPeer::CA_BLOCKED;
		}

	} // setCaBlocked()

	/**
	 * Set the value of [ca_activation_code] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaActivationCode($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_activation_code !== $v) {
			$this->ca_activation_code = $v;
			$this->modifiedColumns[] = TrackingUserPeer::CA_ACTIVATION_CODE;
		}

	} // setCaActivationCode()

	/**
	 * Set the value of [ca_passwd] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaPasswd($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_passwd !== $v) {
			$this->ca_passwd = $v;
			$this->modifiedColumns[] = TrackingUserPeer::CA_PASSWD;
		}

	} // setCaPasswd()

	/**
	 * Set the value of [ca_password_expiry] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaPasswordExpiry($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_password_expiry] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_password_expiry !== $ts) {
			$this->ca_password_expiry = $ts;
			$this->modifiedColumns[] = TrackingUserPeer::CA_PASSWORD_EXPIRY;
		}

	} // setCaPasswordExpiry()

	/**
	 * Set the value of [ca_activated] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setCaActivated($v)
	{

		if ($this->ca_activated !== $v) {
			$this->ca_activated = $v;
			$this->modifiedColumns[] = TrackingUserPeer::CA_ACTIVATED;
		}

	} // setCaActivated()

	/**
	 * Set the value of [ca_idcontacto] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdcontacto($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idcontacto !== $v) {
			$this->ca_idcontacto = $v;
			$this->modifiedColumns[] = TrackingUserPeer::CA_IDCONTACTO;
		}

		if ($this->aContacto !== null && $this->aContacto->getCaIdcontacto() !== $v) {
			$this->aContacto = null;
		}

	} // setCaIdcontacto()

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

			$this->ca_blocked = $rs->getBoolean($startcol + 2);

			$this->ca_activation_code = $rs->getString($startcol + 3);

			$this->ca_passwd = $rs->getString($startcol + 4);

			$this->ca_password_expiry = $rs->getDate($startcol + 5, null);

			$this->ca_activated = $rs->getBoolean($startcol + 6);

			$this->ca_idcontacto = $rs->getInt($startcol + 7);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 8; // 8 = TrackingUserPeer::NUM_COLUMNS - TrackingUserPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating TrackingUser object", $e);
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
			$con = Propel::getConnection(TrackingUserPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			TrackingUserPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(TrackingUserPeer::DATABASE_NAME);
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

			if ($this->aContacto !== null) {
				if ($this->aContacto->isModified()) {
					$affectedRows += $this->aContacto->save($con);
				}
				$this->setContacto($this->aContacto);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TrackingUserPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setCaId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += TrackingUserPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collTrackingUserLogs !== null) {
				foreach($this->collTrackingUserLogs as $referrerFK) {
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

			if ($this->aContacto !== null) {
				if (!$this->aContacto->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aContacto->getValidationFailures());
				}
			}


			if (($retval = TrackingUserPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collTrackingUserLogs !== null) {
					foreach($this->collTrackingUserLogs as $referrerFK) {
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
	 *                     one of the class type constants TYPE_PHPNAME,
	 *                     TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TrackingUserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaBlocked();
				break;
			case 3:
				return $this->getCaActivationCode();
				break;
			case 4:
				return $this->getCaPasswd();
				break;
			case 5:
				return $this->getCaPasswordExpiry();
				break;
			case 6:
				return $this->getCaActivated();
				break;
			case 7:
				return $this->getCaIdcontacto();
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
		$keys = TrackingUserPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaId(),
			$keys[1] => $this->getCaEmail(),
			$keys[2] => $this->getCaBlocked(),
			$keys[3] => $this->getCaActivationCode(),
			$keys[4] => $this->getCaPasswd(),
			$keys[5] => $this->getCaPasswordExpiry(),
			$keys[6] => $this->getCaActivated(),
			$keys[7] => $this->getCaIdcontacto(),
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
		$pos = TrackingUserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaBlocked($value);
				break;
			case 3:
				$this->setCaActivationCode($value);
				break;
			case 4:
				$this->setCaPasswd($value);
				break;
			case 5:
				$this->setCaPasswordExpiry($value);
				break;
			case 6:
				$this->setCaActivated($value);
				break;
			case 7:
				$this->setCaIdcontacto($value);
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
		$keys = TrackingUserPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaEmail($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaBlocked($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaActivationCode($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaPasswd($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaPasswordExpiry($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaActivated($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaIdcontacto($arr[$keys[7]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(TrackingUserPeer::DATABASE_NAME);

		if ($this->isColumnModified(TrackingUserPeer::CA_ID)) $criteria->add(TrackingUserPeer::CA_ID, $this->ca_id);
		if ($this->isColumnModified(TrackingUserPeer::CA_EMAIL)) $criteria->add(TrackingUserPeer::CA_EMAIL, $this->ca_email);
		if ($this->isColumnModified(TrackingUserPeer::CA_BLOCKED)) $criteria->add(TrackingUserPeer::CA_BLOCKED, $this->ca_blocked);
		if ($this->isColumnModified(TrackingUserPeer::CA_ACTIVATION_CODE)) $criteria->add(TrackingUserPeer::CA_ACTIVATION_CODE, $this->ca_activation_code);
		if ($this->isColumnModified(TrackingUserPeer::CA_PASSWD)) $criteria->add(TrackingUserPeer::CA_PASSWD, $this->ca_passwd);
		if ($this->isColumnModified(TrackingUserPeer::CA_PASSWORD_EXPIRY)) $criteria->add(TrackingUserPeer::CA_PASSWORD_EXPIRY, $this->ca_password_expiry);
		if ($this->isColumnModified(TrackingUserPeer::CA_ACTIVATED)) $criteria->add(TrackingUserPeer::CA_ACTIVATED, $this->ca_activated);
		if ($this->isColumnModified(TrackingUserPeer::CA_IDCONTACTO)) $criteria->add(TrackingUserPeer::CA_IDCONTACTO, $this->ca_idcontacto);

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
		$criteria = new Criteria(TrackingUserPeer::DATABASE_NAME);

		$criteria->add(TrackingUserPeer::CA_ID, $this->ca_id);

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
	 * @param      object $copyObj An object of TrackingUser (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaEmail($this->ca_email);

		$copyObj->setCaBlocked($this->ca_blocked);

		$copyObj->setCaActivationCode($this->ca_activation_code);

		$copyObj->setCaPasswd($this->ca_passwd);

		$copyObj->setCaPasswordExpiry($this->ca_password_expiry);

		$copyObj->setCaActivated($this->ca_activated);

		$copyObj->setCaIdcontacto($this->ca_idcontacto);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getTrackingUserLogs() as $relObj) {
				$copyObj->addTrackingUserLog($relObj->copy($deepCopy));
			}

		} // if ($deepCopy)


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
	 * @return     TrackingUser Clone of current object.
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
	 * @return     TrackingUserPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new TrackingUserPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Contacto object.
	 *
	 * @param      Contacto $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setContacto($v)
	{


		if ($v === null) {
			$this->setCaIdcontacto(NULL);
		} else {
			$this->setCaIdcontacto($v->getCaIdcontacto());
		}


		$this->aContacto = $v;
	}


	/**
	 * Get the associated Contacto object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Contacto The associated Contacto object.
	 * @throws     PropelException
	 */
	public function getContacto($con = null)
	{
		if ($this->aContacto === null && ($this->ca_idcontacto !== null)) {
			// include the related Peer class
			$this->aContacto = ContactoPeer::retrieveByPK($this->ca_idcontacto, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = ContactoPeer::retrieveByPK($this->ca_idcontacto, $con);
			   $obj->addContactos($this);
			 */
		}
		return $this->aContacto;
	}

	/**
	 * Temporary storage of collTrackingUserLogs to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initTrackingUserLogs()
	{
		if ($this->collTrackingUserLogs === null) {
			$this->collTrackingUserLogs = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TrackingUser has previously
	 * been saved, it will retrieve related TrackingUserLogs from storage.
	 * If this TrackingUser is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getTrackingUserLogs($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTrackingUserLogs === null) {
			if ($this->isNew()) {
			   $this->collTrackingUserLogs = array();
			} else {

				$criteria->add(TrackingUserLogPeer::CA_EMAIL, $this->getCaEmail());

				TrackingUserLogPeer::addSelectColumns($criteria);
				$this->collTrackingUserLogs = TrackingUserLogPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(TrackingUserLogPeer::CA_EMAIL, $this->getCaEmail());

				TrackingUserLogPeer::addSelectColumns($criteria);
				if (!isset($this->lastTrackingUserLogCriteria) || !$this->lastTrackingUserLogCriteria->equals($criteria)) {
					$this->collTrackingUserLogs = TrackingUserLogPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastTrackingUserLogCriteria = $criteria;
		return $this->collTrackingUserLogs;
	}

	/**
	 * Returns the number of related TrackingUserLogs.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countTrackingUserLogs($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(TrackingUserLogPeer::CA_EMAIL, $this->getCaEmail());

		return TrackingUserLogPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a TrackingUserLog object to this object
	 * through the TrackingUserLog foreign key attribute
	 *
	 * @param      TrackingUserLog $l TrackingUserLog
	 * @return     void
	 * @throws     PropelException
	 */
	public function addTrackingUserLog(TrackingUserLog $l)
	{
		$this->collTrackingUserLogs[] = $l;
		$l->setTrackingUser($this);
	}

} // BaseTrackingUser
