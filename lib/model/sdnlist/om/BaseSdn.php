<?php

/**
 * Base class that represents a row from the 'tb_sdn' table.
 *
 * 
 *
 * @package    lib.model.sdnlist.om
 */
abstract class BaseSdn extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        SdnPeer
	 */
	protected static $peer;


	/**
	 * The value for the ca_uid field.
	 * @var        double
	 */
	protected $ca_uid;


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
	 * The value for the ca_title field.
	 * @var        string
	 */
	protected $ca_title;


	/**
	 * The value for the ca_sdntype field.
	 * @var        string
	 */
	protected $ca_sdntype;


	/**
	 * The value for the ca_remarks field.
	 * @var        string
	 */
	protected $ca_remarks;

	/**
	 * Collection to store aggregation of collSdnIds.
	 * @var        array
	 */
	protected $collSdnIds;

	/**
	 * The criteria used to select the current contents of collSdnIds.
	 * @var        Criteria
	 */
	protected $lastSdnIdCriteria = null;

	/**
	 * Collection to store aggregation of collSdnAkas.
	 * @var        array
	 */
	protected $collSdnAkas;

	/**
	 * The criteria used to select the current contents of collSdnAkas.
	 * @var        Criteria
	 */
	protected $lastSdnAkaCriteria = null;

	/**
	 * Collection to store aggregation of collSdnAddresss.
	 * @var        array
	 */
	protected $collSdnAddresss;

	/**
	 * The criteria used to select the current contents of collSdnAddresss.
	 * @var        Criteria
	 */
	protected $lastSdnAddressCriteria = null;

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
	 * Get the [ca_uid] column value.
	 * 
	 * @return     double
	 */
	public function getCaUid()
	{

		return $this->ca_uid;
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
	 * Get the [ca_title] column value.
	 * 
	 * @return     string
	 */
	public function getCaTitle()
	{

		return $this->ca_title;
	}

	/**
	 * Get the [ca_sdntype] column value.
	 * 
	 * @return     string
	 */
	public function getCaSdntype()
	{

		return $this->ca_sdntype;
	}

	/**
	 * Get the [ca_remarks] column value.
	 * 
	 * @return     string
	 */
	public function getCaRemarks()
	{

		return $this->ca_remarks;
	}

	/**
	 * Set the value of [ca_uid] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaUid($v)
	{

		if ($this->ca_uid !== $v) {
			$this->ca_uid = $v;
			$this->modifiedColumns[] = SdnPeer::CA_UID;
		}

	} // setCaUid()

	/**
	 * Set the value of [ca_firstname] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaFirstname($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_firstname !== $v) {
			$this->ca_firstname = $v;
			$this->modifiedColumns[] = SdnPeer::CA_FIRSTNAME;
		}

	} // setCaFirstname()

	/**
	 * Set the value of [ca_lastname] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaLastname($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_lastname !== $v) {
			$this->ca_lastname = $v;
			$this->modifiedColumns[] = SdnPeer::CA_LASTNAME;
		}

	} // setCaLastname()

	/**
	 * Set the value of [ca_title] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaTitle($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_title !== $v) {
			$this->ca_title = $v;
			$this->modifiedColumns[] = SdnPeer::CA_TITLE;
		}

	} // setCaTitle()

	/**
	 * Set the value of [ca_sdntype] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaSdntype($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_sdntype !== $v) {
			$this->ca_sdntype = $v;
			$this->modifiedColumns[] = SdnPeer::CA_SDNTYPE;
		}

	} // setCaSdntype()

	/**
	 * Set the value of [ca_remarks] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaRemarks($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_remarks !== $v) {
			$this->ca_remarks = $v;
			$this->modifiedColumns[] = SdnPeer::CA_REMARKS;
		}

	} // setCaRemarks()

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

			$this->ca_uid = $rs->getFloat($startcol + 0);

			$this->ca_firstname = $rs->getString($startcol + 1);

			$this->ca_lastname = $rs->getString($startcol + 2);

			$this->ca_title = $rs->getString($startcol + 3);

			$this->ca_sdntype = $rs->getString($startcol + 4);

			$this->ca_remarks = $rs->getString($startcol + 5);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 6; // 6 = SdnPeer::NUM_COLUMNS - SdnPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Sdn object", $e);
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
			$con = Propel::getConnection(SdnPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SdnPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(SdnPeer::DATABASE_NAME);
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
					$pk = SdnPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += SdnPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collSdnIds !== null) {
				foreach($this->collSdnIds as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSdnAkas !== null) {
				foreach($this->collSdnAkas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSdnAddresss !== null) {
				foreach($this->collSdnAddresss as $referrerFK) {
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


			if (($retval = SdnPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collSdnIds !== null) {
					foreach($this->collSdnIds as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSdnAkas !== null) {
					foreach($this->collSdnAkas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSdnAddresss !== null) {
					foreach($this->collSdnAddresss as $referrerFK) {
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
		$pos = SdnPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaUid();
				break;
			case 1:
				return $this->getCaFirstname();
				break;
			case 2:
				return $this->getCaLastname();
				break;
			case 3:
				return $this->getCaTitle();
				break;
			case 4:
				return $this->getCaSdntype();
				break;
			case 5:
				return $this->getCaRemarks();
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
		$keys = SdnPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaUid(),
			$keys[1] => $this->getCaFirstname(),
			$keys[2] => $this->getCaLastname(),
			$keys[3] => $this->getCaTitle(),
			$keys[4] => $this->getCaSdntype(),
			$keys[5] => $this->getCaRemarks(),
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
		$pos = SdnPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaFirstname($value);
				break;
			case 2:
				$this->setCaLastname($value);
				break;
			case 3:
				$this->setCaTitle($value);
				break;
			case 4:
				$this->setCaSdntype($value);
				break;
			case 5:
				$this->setCaRemarks($value);
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
		$keys = SdnPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaUid($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaFirstname($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaLastname($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaTitle($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaSdntype($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaRemarks($arr[$keys[5]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(SdnPeer::DATABASE_NAME);

		if ($this->isColumnModified(SdnPeer::CA_UID)) $criteria->add(SdnPeer::CA_UID, $this->ca_uid);
		if ($this->isColumnModified(SdnPeer::CA_FIRSTNAME)) $criteria->add(SdnPeer::CA_FIRSTNAME, $this->ca_firstname);
		if ($this->isColumnModified(SdnPeer::CA_LASTNAME)) $criteria->add(SdnPeer::CA_LASTNAME, $this->ca_lastname);
		if ($this->isColumnModified(SdnPeer::CA_TITLE)) $criteria->add(SdnPeer::CA_TITLE, $this->ca_title);
		if ($this->isColumnModified(SdnPeer::CA_SDNTYPE)) $criteria->add(SdnPeer::CA_SDNTYPE, $this->ca_sdntype);
		if ($this->isColumnModified(SdnPeer::CA_REMARKS)) $criteria->add(SdnPeer::CA_REMARKS, $this->ca_remarks);

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
		$criteria = new Criteria(SdnPeer::DATABASE_NAME);

		$criteria->add(SdnPeer::CA_UID, $this->ca_uid);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     double
	 */
	public function getPrimaryKey()
	{
		return $this->getCaUid();
	}

	/**
	 * Generic method to set the primary key (ca_uid column).
	 *
	 * @param      double $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaUid($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Sdn (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaFirstname($this->ca_firstname);

		$copyObj->setCaLastname($this->ca_lastname);

		$copyObj->setCaTitle($this->ca_title);

		$copyObj->setCaSdntype($this->ca_sdntype);

		$copyObj->setCaRemarks($this->ca_remarks);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getSdnIds() as $relObj) {
				$copyObj->addSdnId($relObj->copy($deepCopy));
			}

			foreach($this->getSdnAkas() as $relObj) {
				$copyObj->addSdnAka($relObj->copy($deepCopy));
			}

			foreach($this->getSdnAddresss() as $relObj) {
				$copyObj->addSdnAddress($relObj->copy($deepCopy));
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setCaUid(NULL); // this is a pkey column, so set to default value

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
	 * @return     Sdn Clone of current object.
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
	 * @return     SdnPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new SdnPeer();
		}
		return self::$peer;
	}

	/**
	 * Temporary storage of collSdnIds to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSdnIds()
	{
		if ($this->collSdnIds === null) {
			$this->collSdnIds = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Sdn has previously
	 * been saved, it will retrieve related SdnIds from storage.
	 * If this Sdn is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSdnIds($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSdnIds === null) {
			if ($this->isNew()) {
			   $this->collSdnIds = array();
			} else {

				$criteria->add(SdnIdPeer::CA_UID, $this->getCaUid());

				SdnIdPeer::addSelectColumns($criteria);
				$this->collSdnIds = SdnIdPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SdnIdPeer::CA_UID, $this->getCaUid());

				SdnIdPeer::addSelectColumns($criteria);
				if (!isset($this->lastSdnIdCriteria) || !$this->lastSdnIdCriteria->equals($criteria)) {
					$this->collSdnIds = SdnIdPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSdnIdCriteria = $criteria;
		return $this->collSdnIds;
	}

	/**
	 * Returns the number of related SdnIds.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSdnIds($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SdnIdPeer::CA_UID, $this->getCaUid());

		return SdnIdPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a SdnId object to this object
	 * through the SdnId foreign key attribute
	 *
	 * @param      SdnId $l SdnId
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSdnId(SdnId $l)
	{
		$this->collSdnIds[] = $l;
		$l->setSdn($this);
	}

	/**
	 * Temporary storage of collSdnAkas to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSdnAkas()
	{
		if ($this->collSdnAkas === null) {
			$this->collSdnAkas = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Sdn has previously
	 * been saved, it will retrieve related SdnAkas from storage.
	 * If this Sdn is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSdnAkas($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSdnAkas === null) {
			if ($this->isNew()) {
			   $this->collSdnAkas = array();
			} else {

				$criteria->add(SdnAkaPeer::CA_UID, $this->getCaUid());

				SdnAkaPeer::addSelectColumns($criteria);
				$this->collSdnAkas = SdnAkaPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SdnAkaPeer::CA_UID, $this->getCaUid());

				SdnAkaPeer::addSelectColumns($criteria);
				if (!isset($this->lastSdnAkaCriteria) || !$this->lastSdnAkaCriteria->equals($criteria)) {
					$this->collSdnAkas = SdnAkaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSdnAkaCriteria = $criteria;
		return $this->collSdnAkas;
	}

	/**
	 * Returns the number of related SdnAkas.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSdnAkas($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SdnAkaPeer::CA_UID, $this->getCaUid());

		return SdnAkaPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a SdnAka object to this object
	 * through the SdnAka foreign key attribute
	 *
	 * @param      SdnAka $l SdnAka
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSdnAka(SdnAka $l)
	{
		$this->collSdnAkas[] = $l;
		$l->setSdn($this);
	}

	/**
	 * Temporary storage of collSdnAddresss to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSdnAddresss()
	{
		if ($this->collSdnAddresss === null) {
			$this->collSdnAddresss = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Sdn has previously
	 * been saved, it will retrieve related SdnAddresss from storage.
	 * If this Sdn is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSdnAddresss($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSdnAddresss === null) {
			if ($this->isNew()) {
			   $this->collSdnAddresss = array();
			} else {

				$criteria->add(SdnAddressPeer::CA_UID, $this->getCaUid());

				SdnAddressPeer::addSelectColumns($criteria);
				$this->collSdnAddresss = SdnAddressPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SdnAddressPeer::CA_UID, $this->getCaUid());

				SdnAddressPeer::addSelectColumns($criteria);
				if (!isset($this->lastSdnAddressCriteria) || !$this->lastSdnAddressCriteria->equals($criteria)) {
					$this->collSdnAddresss = SdnAddressPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSdnAddressCriteria = $criteria;
		return $this->collSdnAddresss;
	}

	/**
	 * Returns the number of related SdnAddresss.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSdnAddresss($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SdnAddressPeer::CA_UID, $this->getCaUid());

		return SdnAddressPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a SdnAddress object to this object
	 * through the SdnAddress foreign key attribute
	 *
	 * @param      SdnAddress $l SdnAddress
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSdnAddress(SdnAddress $l)
	{
		$this->collSdnAddresss[] = $l;
		$l->setSdn($this);
	}

} // BaseSdn
