<?php

/**
 * Base class that represents a row from the 'tb_sdnaka' table.
 *
 * 
 *
 * @package    lib.model.sdnlist.om
 */
abstract class BaseSdnAka extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        SdnAkaPeer
	 */
	protected static $peer;


	/**
	 * The value for the ca_uid field.
	 * @var        double
	 */
	protected $ca_uid;


	/**
	 * The value for the ca_uid_aka field.
	 * @var        double
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
	 * Get the [ca_uid] column value.
	 * 
	 * @return     double
	 */
	public function getCaUid()
	{

		return $this->ca_uid;
	}

	/**
	 * Get the [ca_uid_aka] column value.
	 * 
	 * @return     double
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
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaUid($v)
	{

		if ($this->ca_uid !== $v) {
			$this->ca_uid = $v;
			$this->modifiedColumns[] = SdnAkaPeer::CA_UID;
		}

		if ($this->aSdn !== null && $this->aSdn->getCaUid() !== $v) {
			$this->aSdn = null;
		}

	} // setCaUid()

	/**
	 * Set the value of [ca_uid_aka] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaUidAka($v)
	{

		if ($this->ca_uid_aka !== $v) {
			$this->ca_uid_aka = $v;
			$this->modifiedColumns[] = SdnAkaPeer::CA_UID_AKA;
		}

	} // setCaUidAka()

	/**
	 * Set the value of [ca_type] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaType($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_type !== $v) {
			$this->ca_type = $v;
			$this->modifiedColumns[] = SdnAkaPeer::CA_TYPE;
		}

	} // setCaType()

	/**
	 * Set the value of [ca_category] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaCategory($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_category !== $v) {
			$this->ca_category = $v;
			$this->modifiedColumns[] = SdnAkaPeer::CA_CATEGORY;
		}

	} // setCaCategory()

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
			$this->modifiedColumns[] = SdnAkaPeer::CA_FIRSTNAME;
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
			$this->modifiedColumns[] = SdnAkaPeer::CA_LASTNAME;
		}

	} // setCaLastname()

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

			$this->ca_uid_aka = $rs->getFloat($startcol + 1);

			$this->ca_type = $rs->getString($startcol + 2);

			$this->ca_category = $rs->getString($startcol + 3);

			$this->ca_firstname = $rs->getString($startcol + 4);

			$this->ca_lastname = $rs->getString($startcol + 5);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 6; // 6 = SdnAkaPeer::NUM_COLUMNS - SdnAkaPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating SdnAka object", $e);
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
			$con = Propel::getConnection(SdnAkaPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SdnAkaPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(SdnAkaPeer::DATABASE_NAME);
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

			if ($this->aSdn !== null) {
				if ($this->aSdn->isModified()) {
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
	 *                     one of the class type constants TYPE_PHPNAME,
	 *                     TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SdnAkaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
	 * @param      string $keyType One of the class type constants TYPE_PHPNAME,
	 *                        TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
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
	 *                     one of the class type constants TYPE_PHPNAME,
	 *                     TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
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
	 * of the class type constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME,
	 * TYPE_NUM. The default key type is the column's phpname (e.g. 'authorId')
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

		$copyObj->setCaType($this->ca_type);

		$copyObj->setCaCategory($this->ca_category);

		$copyObj->setCaFirstname($this->ca_firstname);

		$copyObj->setCaLastname($this->ca_lastname);


		$copyObj->setNew(true);

		$copyObj->setCaUid(NULL); // this is a pkey column, so set to default value

		$copyObj->setCaUidAka(NULL); // this is a pkey column, so set to default value

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
	 * @return     void
	 * @throws     PropelException
	 */
	public function setSdn($v)
	{


		if ($v === null) {
			$this->setCaUid(NULL);
		} else {
			$this->setCaUid($v->getCaUid());
		}


		$this->aSdn = $v;
	}


	/**
	 * Get the associated Sdn object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Sdn The associated Sdn object.
	 * @throws     PropelException
	 */
	public function getSdn($con = null)
	{
		if ($this->aSdn === null && ($this->ca_uid > 0)) {
			// include the related Peer class
			$this->aSdn = SdnPeer::retrieveByPK($this->ca_uid, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = SdnPeer::retrieveByPK($this->ca_uid, $con);
			   $obj->addSdns($this);
			 */
		}
		return $this->aSdn;
	}

} // BaseSdnAka
