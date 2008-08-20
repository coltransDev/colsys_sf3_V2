<?php

/**
 * Base class that represents a row from the 'tb_attachments' table.
 *
 * 
 *
 * @package    lib.model.public.om
 */
abstract class BaseEmailAttachment extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        EmailAttachmentPeer
	 */
	protected static $peer;


	/**
	 * The value for the ca_idattachment field.
	 * @var        int
	 */
	protected $ca_idattachment;


	/**
	 * The value for the ca_idemail field.
	 * @var        int
	 */
	protected $ca_idemail;


	/**
	 * The value for the ca_extension field.
	 * @var        string
	 */
	protected $ca_extension;


	/**
	 * The value for the ca_header_file field.
	 * @var        string
	 */
	protected $ca_header_file;


	/**
	 * The value for the ca_filesize field.
	 * @var        string
	 */
	protected $ca_filesize;


	/**
	 * The value for the ca_content field.
	 * @var        string
	 */
	protected $ca_content;

	/**
	 * @var        Email
	 */
	protected $aEmail;

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
	 * Get the [ca_idattachment] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdattachment()
	{

		return $this->ca_idattachment;
	}

	/**
	 * Get the [ca_idemail] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdemail()
	{

		return $this->ca_idemail;
	}

	/**
	 * Get the [ca_extension] column value.
	 * 
	 * @return     string
	 */
	public function getCaExtension()
	{

		return $this->ca_extension;
	}

	/**
	 * Get the [ca_header_file] column value.
	 * 
	 * @return     string
	 */
	public function getCaHeaderFile()
	{

		return $this->ca_header_file;
	}

	/**
	 * Get the [ca_filesize] column value.
	 * 
	 * @return     string
	 */
	public function getCaFilesize()
	{

		return $this->ca_filesize;
	}

	/**
	 * Get the [ca_content] column value.
	 * 
	 * @return     string
	 */
	public function getCaContent()
	{

		return $this->ca_content;
	}

	/**
	 * Set the value of [ca_idattachment] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdattachment($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idattachment !== $v) {
			$this->ca_idattachment = $v;
			$this->modifiedColumns[] = EmailAttachmentPeer::CA_IDATTACHMENT;
		}

	} // setCaIdattachment()

	/**
	 * Set the value of [ca_idemail] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdemail($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idemail !== $v) {
			$this->ca_idemail = $v;
			$this->modifiedColumns[] = EmailAttachmentPeer::CA_IDEMAIL;
		}

		if ($this->aEmail !== null && $this->aEmail->getCaIdemail() !== $v) {
			$this->aEmail = null;
		}

	} // setCaIdemail()

	/**
	 * Set the value of [ca_extension] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaExtension($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_extension !== $v) {
			$this->ca_extension = $v;
			$this->modifiedColumns[] = EmailAttachmentPeer::CA_EXTENSION;
		}

	} // setCaExtension()

	/**
	 * Set the value of [ca_header_file] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaHeaderFile($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_header_file !== $v) {
			$this->ca_header_file = $v;
			$this->modifiedColumns[] = EmailAttachmentPeer::CA_HEADER_FILE;
		}

	} // setCaHeaderFile()

	/**
	 * Set the value of [ca_filesize] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaFilesize($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_filesize !== $v) {
			$this->ca_filesize = $v;
			$this->modifiedColumns[] = EmailAttachmentPeer::CA_FILESIZE;
		}

	} // setCaFilesize()

	/**
	 * Set the value of [ca_content] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaContent($v)
	{

		// if the passed in parameter is the *same* object that
		// is stored internally then we use the Lob->isModified()
		// method to know whether contents changed.
		if ($v instanceof Lob && $v === $this->ca_content) {
			$changed = $v->isModified();
		} else {
			$changed = ($this->ca_content !== $v);
		}
		if ($changed) {
			if ( !($v instanceof Lob) ) {
				$obj = new Blob();
				$obj->setContents($v);
			} else {
				$obj = $v;
			}
			$this->ca_content = $obj;
			$this->modifiedColumns[] = EmailAttachmentPeer::CA_CONTENT;
		}

	} // setCaContent()

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

			$this->ca_idattachment = $rs->getInt($startcol + 0);

			$this->ca_idemail = $rs->getInt($startcol + 1);

			$this->ca_extension = $rs->getString($startcol + 2);

			$this->ca_header_file = $rs->getString($startcol + 3);

			$this->ca_filesize = $rs->getString($startcol + 4);

			$this->ca_content = $rs->getBlob($startcol + 5);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 6; // 6 = EmailAttachmentPeer::NUM_COLUMNS - EmailAttachmentPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating EmailAttachment object", $e);
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
			$con = Propel::getConnection(EmailAttachmentPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			EmailAttachmentPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(EmailAttachmentPeer::DATABASE_NAME);
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

			if ($this->aEmail !== null) {
				if ($this->aEmail->isModified()) {
					$affectedRows += $this->aEmail->save($con);
				}
				$this->setEmail($this->aEmail);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = EmailAttachmentPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setCaIdattachment($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += EmailAttachmentPeer::doUpdate($this, $con);
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

			if ($this->aEmail !== null) {
				if (!$this->aEmail->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aEmail->getValidationFailures());
				}
			}


			if (($retval = EmailAttachmentPeer::doValidate($this, $columns)) !== true) {
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
		$pos = EmailAttachmentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdattachment();
				break;
			case 1:
				return $this->getCaIdemail();
				break;
			case 2:
				return $this->getCaExtension();
				break;
			case 3:
				return $this->getCaHeaderFile();
				break;
			case 4:
				return $this->getCaFilesize();
				break;
			case 5:
				return $this->getCaContent();
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
		$keys = EmailAttachmentPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdattachment(),
			$keys[1] => $this->getCaIdemail(),
			$keys[2] => $this->getCaExtension(),
			$keys[3] => $this->getCaHeaderFile(),
			$keys[4] => $this->getCaFilesize(),
			$keys[5] => $this->getCaContent(),
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
		$pos = EmailAttachmentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdattachment($value);
				break;
			case 1:
				$this->setCaIdemail($value);
				break;
			case 2:
				$this->setCaExtension($value);
				break;
			case 3:
				$this->setCaHeaderFile($value);
				break;
			case 4:
				$this->setCaFilesize($value);
				break;
			case 5:
				$this->setCaContent($value);
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
		$keys = EmailAttachmentPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdattachment($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdemail($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaExtension($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaHeaderFile($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaFilesize($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaContent($arr[$keys[5]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(EmailAttachmentPeer::DATABASE_NAME);

		if ($this->isColumnModified(EmailAttachmentPeer::CA_IDATTACHMENT)) $criteria->add(EmailAttachmentPeer::CA_IDATTACHMENT, $this->ca_idattachment);
		if ($this->isColumnModified(EmailAttachmentPeer::CA_IDEMAIL)) $criteria->add(EmailAttachmentPeer::CA_IDEMAIL, $this->ca_idemail);
		if ($this->isColumnModified(EmailAttachmentPeer::CA_EXTENSION)) $criteria->add(EmailAttachmentPeer::CA_EXTENSION, $this->ca_extension);
		if ($this->isColumnModified(EmailAttachmentPeer::CA_HEADER_FILE)) $criteria->add(EmailAttachmentPeer::CA_HEADER_FILE, $this->ca_header_file);
		if ($this->isColumnModified(EmailAttachmentPeer::CA_FILESIZE)) $criteria->add(EmailAttachmentPeer::CA_FILESIZE, $this->ca_filesize);
		if ($this->isColumnModified(EmailAttachmentPeer::CA_CONTENT)) $criteria->add(EmailAttachmentPeer::CA_CONTENT, $this->ca_content);

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
		$criteria = new Criteria(EmailAttachmentPeer::DATABASE_NAME);

		$criteria->add(EmailAttachmentPeer::CA_IDATTACHMENT, $this->ca_idattachment);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdattachment();
	}

	/**
	 * Generic method to set the primary key (ca_idattachment column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdattachment($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of EmailAttachment (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdemail($this->ca_idemail);

		$copyObj->setCaExtension($this->ca_extension);

		$copyObj->setCaHeaderFile($this->ca_header_file);

		$copyObj->setCaFilesize($this->ca_filesize);

		$copyObj->setCaContent($this->ca_content);


		$copyObj->setNew(true);

		$copyObj->setCaIdattachment(NULL); // this is a pkey column, so set to default value

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
	 * @return     EmailAttachment Clone of current object.
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
	 * @return     EmailAttachmentPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new EmailAttachmentPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Email object.
	 *
	 * @param      Email $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setEmail($v)
	{


		if ($v === null) {
			$this->setCaIdemail(NULL);
		} else {
			$this->setCaIdemail($v->getCaIdemail());
		}


		$this->aEmail = $v;
	}


	/**
	 * Get the associated Email object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Email The associated Email object.
	 * @throws     PropelException
	 */
	public function getEmail($con = null)
	{
		if ($this->aEmail === null && ($this->ca_idemail !== null)) {
			// include the related Peer class
			$this->aEmail = EmailPeer::retrieveByPK($this->ca_idemail, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = EmailPeer::retrieveByPK($this->ca_idemail, $con);
			   $obj->addEmails($this);
			 */
		}
		return $this->aEmail;
	}

} // BaseEmailAttachment
