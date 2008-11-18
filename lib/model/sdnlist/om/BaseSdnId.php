<?php

/**
 * Base class that represents a row from the 'tb_sdnid' table.
 *
 * 
 *
 * @package    lib.model.sdnlist.om
 */
abstract class BaseSdnId extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        SdnIdPeer
	 */
	protected static $peer;


	/**
	 * The value for the ca_uid field.
	 * @var        double
	 */
	protected $ca_uid;


	/**
	 * The value for the ca_uid_id field.
	 * @var        double
	 */
	protected $ca_uid_id;


	/**
	 * The value for the ca_idtype field.
	 * @var        string
	 */
	protected $ca_idtype;


	/**
	 * The value for the ca_idnumber field.
	 * @var        string
	 */
	protected $ca_idnumber;


	/**
	 * The value for the ca_idcountry field.
	 * @var        string
	 */
	protected $ca_idcountry;


	/**
	 * The value for the ca_issuedate field.
	 * @var        string
	 */
	protected $ca_issuedate;


	/**
	 * The value for the ca_expirationdate field.
	 * @var        string
	 */
	protected $ca_expirationdate;

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
	 * Get the [ca_uid_id] column value.
	 * 
	 * @return     double
	 */
	public function getCaUidId()
	{

		return $this->ca_uid_id;
	}

	/**
	 * Get the [ca_idtype] column value.
	 * 
	 * @return     string
	 */
	public function getCaIdtype()
	{

		return $this->ca_idtype;
	}

	/**
	 * Get the [ca_idnumber] column value.
	 * 
	 * @return     string
	 */
	public function getCaIdnumber()
	{

		return $this->ca_idnumber;
	}

	/**
	 * Get the [ca_idcountry] column value.
	 * 
	 * @return     string
	 */
	public function getCaIdcountry()
	{

		return $this->ca_idcountry;
	}

	/**
	 * Get the [ca_issuedate] column value.
	 * 
	 * @return     string
	 */
	public function getCaIssuedate()
	{

		return $this->ca_issuedate;
	}

	/**
	 * Get the [ca_expirationdate] column value.
	 * 
	 * @return     string
	 */
	public function getCaExpirationdate()
	{

		return $this->ca_expirationdate;
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
			$this->modifiedColumns[] = SdnIdPeer::CA_UID;
		}

		if ($this->aSdn !== null && $this->aSdn->getCaUid() !== $v) {
			$this->aSdn = null;
		}

	} // setCaUid()

	/**
	 * Set the value of [ca_uid_id] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaUidId($v)
	{

		if ($this->ca_uid_id !== $v) {
			$this->ca_uid_id = $v;
			$this->modifiedColumns[] = SdnIdPeer::CA_UID_ID;
		}

	} // setCaUidId()

	/**
	 * Set the value of [ca_idtype] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaIdtype($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_idtype !== $v) {
			$this->ca_idtype = $v;
			$this->modifiedColumns[] = SdnIdPeer::CA_IDTYPE;
		}

	} // setCaIdtype()

	/**
	 * Set the value of [ca_idnumber] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaIdnumber($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_idnumber !== $v) {
			$this->ca_idnumber = $v;
			$this->modifiedColumns[] = SdnIdPeer::CA_IDNUMBER;
		}

	} // setCaIdnumber()

	/**
	 * Set the value of [ca_idcountry] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaIdcountry($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_idcountry !== $v) {
			$this->ca_idcountry = $v;
			$this->modifiedColumns[] = SdnIdPeer::CA_IDCOUNTRY;
		}

	} // setCaIdcountry()

	/**
	 * Set the value of [ca_issuedate] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaIssuedate($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_issuedate !== $v) {
			$this->ca_issuedate = $v;
			$this->modifiedColumns[] = SdnIdPeer::CA_ISSUEDATE;
		}

	} // setCaIssuedate()

	/**
	 * Set the value of [ca_expirationdate] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaExpirationdate($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_expirationdate !== $v) {
			$this->ca_expirationdate = $v;
			$this->modifiedColumns[] = SdnIdPeer::CA_EXPIRATIONDATE;
		}

	} // setCaExpirationdate()

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

			$this->ca_uid_id = $rs->getFloat($startcol + 1);

			$this->ca_idtype = $rs->getString($startcol + 2);

			$this->ca_idnumber = $rs->getString($startcol + 3);

			$this->ca_idcountry = $rs->getString($startcol + 4);

			$this->ca_issuedate = $rs->getString($startcol + 5);

			$this->ca_expirationdate = $rs->getString($startcol + 6);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 7; // 7 = SdnIdPeer::NUM_COLUMNS - SdnIdPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating SdnId object", $e);
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
			$con = Propel::getConnection(SdnIdPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SdnIdPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(SdnIdPeer::DATABASE_NAME);
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
					$pk = SdnIdPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += SdnIdPeer::doUpdate($this, $con);
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


			if (($retval = SdnIdPeer::doValidate($this, $columns)) !== true) {
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
		$pos = SdnIdPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaUidId();
				break;
			case 2:
				return $this->getCaIdtype();
				break;
			case 3:
				return $this->getCaIdnumber();
				break;
			case 4:
				return $this->getCaIdcountry();
				break;
			case 5:
				return $this->getCaIssuedate();
				break;
			case 6:
				return $this->getCaExpirationdate();
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
		$keys = SdnIdPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaUid(),
			$keys[1] => $this->getCaUidId(),
			$keys[2] => $this->getCaIdtype(),
			$keys[3] => $this->getCaIdnumber(),
			$keys[4] => $this->getCaIdcountry(),
			$keys[5] => $this->getCaIssuedate(),
			$keys[6] => $this->getCaExpirationdate(),
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
		$pos = SdnIdPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaUidId($value);
				break;
			case 2:
				$this->setCaIdtype($value);
				break;
			case 3:
				$this->setCaIdnumber($value);
				break;
			case 4:
				$this->setCaIdcountry($value);
				break;
			case 5:
				$this->setCaIssuedate($value);
				break;
			case 6:
				$this->setCaExpirationdate($value);
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
		$keys = SdnIdPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaUid($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaUidId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaIdtype($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaIdnumber($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaIdcountry($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaIssuedate($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaExpirationdate($arr[$keys[6]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(SdnIdPeer::DATABASE_NAME);

		if ($this->isColumnModified(SdnIdPeer::CA_UID)) $criteria->add(SdnIdPeer::CA_UID, $this->ca_uid);
		if ($this->isColumnModified(SdnIdPeer::CA_UID_ID)) $criteria->add(SdnIdPeer::CA_UID_ID, $this->ca_uid_id);
		if ($this->isColumnModified(SdnIdPeer::CA_IDTYPE)) $criteria->add(SdnIdPeer::CA_IDTYPE, $this->ca_idtype);
		if ($this->isColumnModified(SdnIdPeer::CA_IDNUMBER)) $criteria->add(SdnIdPeer::CA_IDNUMBER, $this->ca_idnumber);
		if ($this->isColumnModified(SdnIdPeer::CA_IDCOUNTRY)) $criteria->add(SdnIdPeer::CA_IDCOUNTRY, $this->ca_idcountry);
		if ($this->isColumnModified(SdnIdPeer::CA_ISSUEDATE)) $criteria->add(SdnIdPeer::CA_ISSUEDATE, $this->ca_issuedate);
		if ($this->isColumnModified(SdnIdPeer::CA_EXPIRATIONDATE)) $criteria->add(SdnIdPeer::CA_EXPIRATIONDATE, $this->ca_expirationdate);

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
		$criteria = new Criteria(SdnIdPeer::DATABASE_NAME);

		$criteria->add(SdnIdPeer::CA_UID, $this->ca_uid);
		$criteria->add(SdnIdPeer::CA_UID_ID, $this->ca_uid_id);

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

		$pks[1] = $this->getCaUidId();

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

		$this->setCaUidId($keys[1]);

	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of SdnId (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdtype($this->ca_idtype);

		$copyObj->setCaIdnumber($this->ca_idnumber);

		$copyObj->setCaIdcountry($this->ca_idcountry);

		$copyObj->setCaIssuedate($this->ca_issuedate);

		$copyObj->setCaExpirationdate($this->ca_expirationdate);


		$copyObj->setNew(true);

		$copyObj->setCaUid(NULL); // this is a pkey column, so set to default value

		$copyObj->setCaUidId(NULL); // this is a pkey column, so set to default value

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
	 * @return     SdnId Clone of current object.
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
	 * @return     SdnIdPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new SdnIdPeer();
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

} // BaseSdnId
