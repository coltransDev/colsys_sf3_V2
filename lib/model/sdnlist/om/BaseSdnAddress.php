<?php

/**
 * Base class that represents a row from the 'tb_sdnaddress' table.
 *
 * 
 *
 * @package    lib.model.sdnlist.om
 */
abstract class BaseSdnAddress extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        SdnAddressPeer
	 */
	protected static $peer;


	/**
	 * The value for the ca_uid field.
	 * @var        double
	 */
	protected $ca_uid;


	/**
	 * The value for the ca_uid_address field.
	 * @var        double
	 */
	protected $ca_uid_address;


	/**
	 * The value for the ca_address1 field.
	 * @var        string
	 */
	protected $ca_address1;


	/**
	 * The value for the ca_address2 field.
	 * @var        string
	 */
	protected $ca_address2;


	/**
	 * The value for the ca_address3 field.
	 * @var        string
	 */
	protected $ca_address3;


	/**
	 * The value for the ca_city field.
	 * @var        string
	 */
	protected $ca_city;


	/**
	 * The value for the ca_state field.
	 * @var        string
	 */
	protected $ca_state;


	/**
	 * The value for the ca_postal field.
	 * @var        string
	 */
	protected $ca_postal;


	/**
	 * The value for the ca_country field.
	 * @var        string
	 */
	protected $ca_country;

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
	 * Get the [ca_uid_address] column value.
	 * 
	 * @return     double
	 */
	public function getCaUidAddress()
	{

		return $this->ca_uid_address;
	}

	/**
	 * Get the [ca_address1] column value.
	 * 
	 * @return     string
	 */
	public function getCaAddress1()
	{

		return $this->ca_address1;
	}

	/**
	 * Get the [ca_address2] column value.
	 * 
	 * @return     string
	 */
	public function getCaAddress2()
	{

		return $this->ca_address2;
	}

	/**
	 * Get the [ca_address3] column value.
	 * 
	 * @return     string
	 */
	public function getCaAddress3()
	{

		return $this->ca_address3;
	}

	/**
	 * Get the [ca_city] column value.
	 * 
	 * @return     string
	 */
	public function getCaCity()
	{

		return $this->ca_city;
	}

	/**
	 * Get the [ca_state] column value.
	 * 
	 * @return     string
	 */
	public function getCaState()
	{

		return $this->ca_state;
	}

	/**
	 * Get the [ca_postal] column value.
	 * 
	 * @return     string
	 */
	public function getCaPostal()
	{

		return $this->ca_postal;
	}

	/**
	 * Get the [ca_country] column value.
	 * 
	 * @return     string
	 */
	public function getCaCountry()
	{

		return $this->ca_country;
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
			$this->modifiedColumns[] = SdnAddressPeer::CA_UID;
		}

		if ($this->aSdn !== null && $this->aSdn->getCaUid() !== $v) {
			$this->aSdn = null;
		}

	} // setCaUid()

	/**
	 * Set the value of [ca_uid_address] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaUidAddress($v)
	{

		if ($this->ca_uid_address !== $v) {
			$this->ca_uid_address = $v;
			$this->modifiedColumns[] = SdnAddressPeer::CA_UID_ADDRESS;
		}

	} // setCaUidAddress()

	/**
	 * Set the value of [ca_address1] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaAddress1($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_address1 !== $v) {
			$this->ca_address1 = $v;
			$this->modifiedColumns[] = SdnAddressPeer::CA_ADDRESS1;
		}

	} // setCaAddress1()

	/**
	 * Set the value of [ca_address2] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaAddress2($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_address2 !== $v) {
			$this->ca_address2 = $v;
			$this->modifiedColumns[] = SdnAddressPeer::CA_ADDRESS2;
		}

	} // setCaAddress2()

	/**
	 * Set the value of [ca_address3] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaAddress3($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_address3 !== $v) {
			$this->ca_address3 = $v;
			$this->modifiedColumns[] = SdnAddressPeer::CA_ADDRESS3;
		}

	} // setCaAddress3()

	/**
	 * Set the value of [ca_city] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaCity($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_city !== $v) {
			$this->ca_city = $v;
			$this->modifiedColumns[] = SdnAddressPeer::CA_CITY;
		}

	} // setCaCity()

	/**
	 * Set the value of [ca_state] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaState($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_state !== $v) {
			$this->ca_state = $v;
			$this->modifiedColumns[] = SdnAddressPeer::CA_STATE;
		}

	} // setCaState()

	/**
	 * Set the value of [ca_postal] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaPostal($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_postal !== $v) {
			$this->ca_postal = $v;
			$this->modifiedColumns[] = SdnAddressPeer::CA_POSTAL;
		}

	} // setCaPostal()

	/**
	 * Set the value of [ca_country] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaCountry($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_country !== $v) {
			$this->ca_country = $v;
			$this->modifiedColumns[] = SdnAddressPeer::CA_COUNTRY;
		}

	} // setCaCountry()

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

			$this->ca_uid_address = $rs->getFloat($startcol + 1);

			$this->ca_address1 = $rs->getString($startcol + 2);

			$this->ca_address2 = $rs->getString($startcol + 3);

			$this->ca_address3 = $rs->getString($startcol + 4);

			$this->ca_city = $rs->getString($startcol + 5);

			$this->ca_state = $rs->getString($startcol + 6);

			$this->ca_postal = $rs->getString($startcol + 7);

			$this->ca_country = $rs->getString($startcol + 8);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 9; // 9 = SdnAddressPeer::NUM_COLUMNS - SdnAddressPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating SdnAddress object", $e);
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
			$con = Propel::getConnection(SdnAddressPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SdnAddressPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(SdnAddressPeer::DATABASE_NAME);
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
					$pk = SdnAddressPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += SdnAddressPeer::doUpdate($this, $con);
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


			if (($retval = SdnAddressPeer::doValidate($this, $columns)) !== true) {
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
		$pos = SdnAddressPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaUidAddress();
				break;
			case 2:
				return $this->getCaAddress1();
				break;
			case 3:
				return $this->getCaAddress2();
				break;
			case 4:
				return $this->getCaAddress3();
				break;
			case 5:
				return $this->getCaCity();
				break;
			case 6:
				return $this->getCaState();
				break;
			case 7:
				return $this->getCaPostal();
				break;
			case 8:
				return $this->getCaCountry();
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
		$keys = SdnAddressPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaUid(),
			$keys[1] => $this->getCaUidAddress(),
			$keys[2] => $this->getCaAddress1(),
			$keys[3] => $this->getCaAddress2(),
			$keys[4] => $this->getCaAddress3(),
			$keys[5] => $this->getCaCity(),
			$keys[6] => $this->getCaState(),
			$keys[7] => $this->getCaPostal(),
			$keys[8] => $this->getCaCountry(),
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
		$pos = SdnAddressPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaUidAddress($value);
				break;
			case 2:
				$this->setCaAddress1($value);
				break;
			case 3:
				$this->setCaAddress2($value);
				break;
			case 4:
				$this->setCaAddress3($value);
				break;
			case 5:
				$this->setCaCity($value);
				break;
			case 6:
				$this->setCaState($value);
				break;
			case 7:
				$this->setCaPostal($value);
				break;
			case 8:
				$this->setCaCountry($value);
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
		$keys = SdnAddressPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaUid($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaUidAddress($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaAddress1($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaAddress2($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaAddress3($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaCity($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaState($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaPostal($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaCountry($arr[$keys[8]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(SdnAddressPeer::DATABASE_NAME);

		if ($this->isColumnModified(SdnAddressPeer::CA_UID)) $criteria->add(SdnAddressPeer::CA_UID, $this->ca_uid);
		if ($this->isColumnModified(SdnAddressPeer::CA_UID_ADDRESS)) $criteria->add(SdnAddressPeer::CA_UID_ADDRESS, $this->ca_uid_address);
		if ($this->isColumnModified(SdnAddressPeer::CA_ADDRESS1)) $criteria->add(SdnAddressPeer::CA_ADDRESS1, $this->ca_address1);
		if ($this->isColumnModified(SdnAddressPeer::CA_ADDRESS2)) $criteria->add(SdnAddressPeer::CA_ADDRESS2, $this->ca_address2);
		if ($this->isColumnModified(SdnAddressPeer::CA_ADDRESS3)) $criteria->add(SdnAddressPeer::CA_ADDRESS3, $this->ca_address3);
		if ($this->isColumnModified(SdnAddressPeer::CA_CITY)) $criteria->add(SdnAddressPeer::CA_CITY, $this->ca_city);
		if ($this->isColumnModified(SdnAddressPeer::CA_STATE)) $criteria->add(SdnAddressPeer::CA_STATE, $this->ca_state);
		if ($this->isColumnModified(SdnAddressPeer::CA_POSTAL)) $criteria->add(SdnAddressPeer::CA_POSTAL, $this->ca_postal);
		if ($this->isColumnModified(SdnAddressPeer::CA_COUNTRY)) $criteria->add(SdnAddressPeer::CA_COUNTRY, $this->ca_country);

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
		$criteria = new Criteria(SdnAddressPeer::DATABASE_NAME);

		$criteria->add(SdnAddressPeer::CA_UID, $this->ca_uid);
		$criteria->add(SdnAddressPeer::CA_UID_ADDRESS, $this->ca_uid_address);

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

		$pks[1] = $this->getCaUidAddress();

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

		$this->setCaUidAddress($keys[1]);

	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of SdnAddress (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaAddress1($this->ca_address1);

		$copyObj->setCaAddress2($this->ca_address2);

		$copyObj->setCaAddress3($this->ca_address3);

		$copyObj->setCaCity($this->ca_city);

		$copyObj->setCaState($this->ca_state);

		$copyObj->setCaPostal($this->ca_postal);

		$copyObj->setCaCountry($this->ca_country);


		$copyObj->setNew(true);

		$copyObj->setCaUid(NULL); // this is a pkey column, so set to default value

		$copyObj->setCaUidAddress(NULL); // this is a pkey column, so set to default value

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
	 * @return     SdnAddress Clone of current object.
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
	 * @return     SdnAddressPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new SdnAddressPeer();
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

} // BaseSdnAddress
