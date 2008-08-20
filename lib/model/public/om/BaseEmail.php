<?php

/**
 * Base class that represents a row from the 'tb_emails' table.
 *
 * 
 *
 * @package    lib.model.public.om
 */
abstract class BaseEmail extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        EmailPeer
	 */
	protected static $peer;


	/**
	 * The value for the ca_idemail field.
	 * @var        int
	 */
	protected $ca_idemail;


	/**
	 * The value for the ca_fchenvio field.
	 * @var        int
	 */
	protected $ca_fchenvio;


	/**
	 * The value for the ca_usuenvio field.
	 * @var        string
	 */
	protected $ca_usuenvio;


	/**
	 * The value for the ca_tipo field.
	 * @var        string
	 */
	protected $ca_tipo;


	/**
	 * The value for the ca_idcaso field.
	 * @var        string
	 */
	protected $ca_idcaso;


	/**
	 * The value for the ca_from field.
	 * @var        string
	 */
	protected $ca_from;


	/**
	 * The value for the ca_fromname field.
	 * @var        string
	 */
	protected $ca_fromname;


	/**
	 * The value for the ca_cc field.
	 * @var        string
	 */
	protected $ca_cc;


	/**
	 * The value for the ca_replyto field.
	 * @var        string
	 */
	protected $ca_replyto;


	/**
	 * The value for the ca_address field.
	 * @var        string
	 */
	protected $ca_address;


	/**
	 * The value for the ca_attachment field.
	 * @var        string
	 */
	protected $ca_attachment;


	/**
	 * The value for the ca_subject field.
	 * @var        string
	 */
	protected $ca_subject;


	/**
	 * The value for the ca_body field.
	 * @var        string
	 */
	protected $ca_body;


	/**
	 * The value for the ca_readreceipt field.
	 * @var        boolean
	 */
	protected $ca_readreceipt;

	/**
	 * Collection to store aggregation of collRepAvisos.
	 * @var        array
	 */
	protected $collRepAvisos;

	/**
	 * The criteria used to select the current contents of collRepAvisos.
	 * @var        Criteria
	 */
	protected $lastRepAvisoCriteria = null;

	/**
	 * Collection to store aggregation of collRepStatuss.
	 * @var        array
	 */
	protected $collRepStatuss;

	/**
	 * The criteria used to select the current contents of collRepStatuss.
	 * @var        Criteria
	 */
	protected $lastRepStatusCriteria = null;

	/**
	 * Collection to store aggregation of collEmailAttachments.
	 * @var        array
	 */
	protected $collEmailAttachments;

	/**
	 * The criteria used to select the current contents of collEmailAttachments.
	 * @var        Criteria
	 */
	protected $lastEmailAttachmentCriteria = null;

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
	 * Get the [ca_idemail] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdemail()
	{

		return $this->ca_idemail;
	}

	/**
	 * Get the [optionally formatted] [ca_fchenvio] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchenvio($format = 'Y-m-d H:i:s')
	{

		if ($this->ca_fchenvio === null || $this->ca_fchenvio === '') {
			return null;
		} elseif (!is_int($this->ca_fchenvio)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_fchenvio);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_fchenvio] as date/time value: " . var_export($this->ca_fchenvio, true));
			}
		} else {
			$ts = $this->ca_fchenvio;
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
	 * Get the [ca_usuenvio] column value.
	 * 
	 * @return     string
	 */
	public function getCaUsuenvio()
	{

		return $this->ca_usuenvio;
	}

	/**
	 * Get the [ca_tipo] column value.
	 * 
	 * @return     string
	 */
	public function getCaTipo()
	{

		return $this->ca_tipo;
	}

	/**
	 * Get the [ca_idcaso] column value.
	 * 
	 * @return     string
	 */
	public function getCaIdcaso()
	{

		return $this->ca_idcaso;
	}

	/**
	 * Get the [ca_from] column value.
	 * 
	 * @return     string
	 */
	public function getCaFrom()
	{

		return $this->ca_from;
	}

	/**
	 * Get the [ca_fromname] column value.
	 * 
	 * @return     string
	 */
	public function getCaFromname()
	{

		return $this->ca_fromname;
	}

	/**
	 * Get the [ca_cc] column value.
	 * 
	 * @return     string
	 */
	public function getCaCc()
	{

		return $this->ca_cc;
	}

	/**
	 * Get the [ca_replyto] column value.
	 * 
	 * @return     string
	 */
	public function getCaReplyto()
	{

		return $this->ca_replyto;
	}

	/**
	 * Get the [ca_address] column value.
	 * 
	 * @return     string
	 */
	public function getCaAddress()
	{

		return $this->ca_address;
	}

	/**
	 * Get the [ca_attachment] column value.
	 * 
	 * @return     string
	 */
	public function getCaAttachment()
	{

		return $this->ca_attachment;
	}

	/**
	 * Get the [ca_subject] column value.
	 * 
	 * @return     string
	 */
	public function getCaSubject()
	{

		return $this->ca_subject;
	}

	/**
	 * Get the [ca_body] column value.
	 * 
	 * @return     string
	 */
	public function getCaBody()
	{

		return $this->ca_body;
	}

	/**
	 * Get the [ca_readreceipt] column value.
	 * 
	 * @return     boolean
	 */
	public function getCaReadreceipt()
	{

		return $this->ca_readreceipt;
	}

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
			$this->modifiedColumns[] = EmailPeer::CA_IDEMAIL;
		}

	} // setCaIdemail()

	/**
	 * Set the value of [ca_fchenvio] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaFchenvio($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_fchenvio] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_fchenvio !== $ts) {
			$this->ca_fchenvio = $ts;
			$this->modifiedColumns[] = EmailPeer::CA_FCHENVIO;
		}

	} // setCaFchenvio()

	/**
	 * Set the value of [ca_usuenvio] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaUsuenvio($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_usuenvio !== $v) {
			$this->ca_usuenvio = $v;
			$this->modifiedColumns[] = EmailPeer::CA_USUENVIO;
		}

	} // setCaUsuenvio()

	/**
	 * Set the value of [ca_tipo] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaTipo($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_tipo !== $v) {
			$this->ca_tipo = $v;
			$this->modifiedColumns[] = EmailPeer::CA_TIPO;
		}

	} // setCaTipo()

	/**
	 * Set the value of [ca_idcaso] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaIdcaso($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_idcaso !== $v) {
			$this->ca_idcaso = $v;
			$this->modifiedColumns[] = EmailPeer::CA_IDCASO;
		}

	} // setCaIdcaso()

	/**
	 * Set the value of [ca_from] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaFrom($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_from !== $v) {
			$this->ca_from = $v;
			$this->modifiedColumns[] = EmailPeer::CA_FROM;
		}

	} // setCaFrom()

	/**
	 * Set the value of [ca_fromname] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaFromname($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_fromname !== $v) {
			$this->ca_fromname = $v;
			$this->modifiedColumns[] = EmailPeer::CA_FROMNAME;
		}

	} // setCaFromname()

	/**
	 * Set the value of [ca_cc] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaCc($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_cc !== $v) {
			$this->ca_cc = $v;
			$this->modifiedColumns[] = EmailPeer::CA_CC;
		}

	} // setCaCc()

	/**
	 * Set the value of [ca_replyto] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaReplyto($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_replyto !== $v) {
			$this->ca_replyto = $v;
			$this->modifiedColumns[] = EmailPeer::CA_REPLYTO;
		}

	} // setCaReplyto()

	/**
	 * Set the value of [ca_address] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaAddress($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_address !== $v) {
			$this->ca_address = $v;
			$this->modifiedColumns[] = EmailPeer::CA_ADDRESS;
		}

	} // setCaAddress()

	/**
	 * Set the value of [ca_attachment] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaAttachment($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_attachment !== $v) {
			$this->ca_attachment = $v;
			$this->modifiedColumns[] = EmailPeer::CA_ATTACHMENT;
		}

	} // setCaAttachment()

	/**
	 * Set the value of [ca_subject] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaSubject($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_subject !== $v) {
			$this->ca_subject = $v;
			$this->modifiedColumns[] = EmailPeer::CA_SUBJECT;
		}

	} // setCaSubject()

	/**
	 * Set the value of [ca_body] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaBody($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_body !== $v) {
			$this->ca_body = $v;
			$this->modifiedColumns[] = EmailPeer::CA_BODY;
		}

	} // setCaBody()

	/**
	 * Set the value of [ca_readreceipt] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setCaReadreceipt($v)
	{

		if ($this->ca_readreceipt !== $v) {
			$this->ca_readreceipt = $v;
			$this->modifiedColumns[] = EmailPeer::CA_READRECEIPT;
		}

	} // setCaReadreceipt()

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

			$this->ca_idemail = $rs->getInt($startcol + 0);

			$this->ca_fchenvio = $rs->getTimestamp($startcol + 1, null);

			$this->ca_usuenvio = $rs->getString($startcol + 2);

			$this->ca_tipo = $rs->getString($startcol + 3);

			$this->ca_idcaso = $rs->getString($startcol + 4);

			$this->ca_from = $rs->getString($startcol + 5);

			$this->ca_fromname = $rs->getString($startcol + 6);

			$this->ca_cc = $rs->getString($startcol + 7);

			$this->ca_replyto = $rs->getString($startcol + 8);

			$this->ca_address = $rs->getString($startcol + 9);

			$this->ca_attachment = $rs->getString($startcol + 10);

			$this->ca_subject = $rs->getString($startcol + 11);

			$this->ca_body = $rs->getString($startcol + 12);

			$this->ca_readreceipt = $rs->getBoolean($startcol + 13);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 14; // 14 = EmailPeer::NUM_COLUMNS - EmailPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Email object", $e);
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
			$con = Propel::getConnection(EmailPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			EmailPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(EmailPeer::DATABASE_NAME);
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
					$pk = EmailPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setCaIdemail($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += EmailPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collRepAvisos !== null) {
				foreach($this->collRepAvisos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRepStatuss !== null) {
				foreach($this->collRepStatuss as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collEmailAttachments !== null) {
				foreach($this->collEmailAttachments as $referrerFK) {
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


			if (($retval = EmailPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collRepAvisos !== null) {
					foreach($this->collRepAvisos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRepStatuss !== null) {
					foreach($this->collRepStatuss as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEmailAttachments !== null) {
					foreach($this->collEmailAttachments as $referrerFK) {
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
		$pos = EmailPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdemail();
				break;
			case 1:
				return $this->getCaFchenvio();
				break;
			case 2:
				return $this->getCaUsuenvio();
				break;
			case 3:
				return $this->getCaTipo();
				break;
			case 4:
				return $this->getCaIdcaso();
				break;
			case 5:
				return $this->getCaFrom();
				break;
			case 6:
				return $this->getCaFromname();
				break;
			case 7:
				return $this->getCaCc();
				break;
			case 8:
				return $this->getCaReplyto();
				break;
			case 9:
				return $this->getCaAddress();
				break;
			case 10:
				return $this->getCaAttachment();
				break;
			case 11:
				return $this->getCaSubject();
				break;
			case 12:
				return $this->getCaBody();
				break;
			case 13:
				return $this->getCaReadreceipt();
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
		$keys = EmailPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdemail(),
			$keys[1] => $this->getCaFchenvio(),
			$keys[2] => $this->getCaUsuenvio(),
			$keys[3] => $this->getCaTipo(),
			$keys[4] => $this->getCaIdcaso(),
			$keys[5] => $this->getCaFrom(),
			$keys[6] => $this->getCaFromname(),
			$keys[7] => $this->getCaCc(),
			$keys[8] => $this->getCaReplyto(),
			$keys[9] => $this->getCaAddress(),
			$keys[10] => $this->getCaAttachment(),
			$keys[11] => $this->getCaSubject(),
			$keys[12] => $this->getCaBody(),
			$keys[13] => $this->getCaReadreceipt(),
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
		$pos = EmailPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdemail($value);
				break;
			case 1:
				$this->setCaFchenvio($value);
				break;
			case 2:
				$this->setCaUsuenvio($value);
				break;
			case 3:
				$this->setCaTipo($value);
				break;
			case 4:
				$this->setCaIdcaso($value);
				break;
			case 5:
				$this->setCaFrom($value);
				break;
			case 6:
				$this->setCaFromname($value);
				break;
			case 7:
				$this->setCaCc($value);
				break;
			case 8:
				$this->setCaReplyto($value);
				break;
			case 9:
				$this->setCaAddress($value);
				break;
			case 10:
				$this->setCaAttachment($value);
				break;
			case 11:
				$this->setCaSubject($value);
				break;
			case 12:
				$this->setCaBody($value);
				break;
			case 13:
				$this->setCaReadreceipt($value);
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
		$keys = EmailPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdemail($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaFchenvio($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaUsuenvio($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaTipo($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaIdcaso($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaFrom($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaFromname($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaCc($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaReplyto($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaAddress($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaAttachment($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaSubject($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaBody($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaReadreceipt($arr[$keys[13]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(EmailPeer::DATABASE_NAME);

		if ($this->isColumnModified(EmailPeer::CA_IDEMAIL)) $criteria->add(EmailPeer::CA_IDEMAIL, $this->ca_idemail);
		if ($this->isColumnModified(EmailPeer::CA_FCHENVIO)) $criteria->add(EmailPeer::CA_FCHENVIO, $this->ca_fchenvio);
		if ($this->isColumnModified(EmailPeer::CA_USUENVIO)) $criteria->add(EmailPeer::CA_USUENVIO, $this->ca_usuenvio);
		if ($this->isColumnModified(EmailPeer::CA_TIPO)) $criteria->add(EmailPeer::CA_TIPO, $this->ca_tipo);
		if ($this->isColumnModified(EmailPeer::CA_IDCASO)) $criteria->add(EmailPeer::CA_IDCASO, $this->ca_idcaso);
		if ($this->isColumnModified(EmailPeer::CA_FROM)) $criteria->add(EmailPeer::CA_FROM, $this->ca_from);
		if ($this->isColumnModified(EmailPeer::CA_FROMNAME)) $criteria->add(EmailPeer::CA_FROMNAME, $this->ca_fromname);
		if ($this->isColumnModified(EmailPeer::CA_CC)) $criteria->add(EmailPeer::CA_CC, $this->ca_cc);
		if ($this->isColumnModified(EmailPeer::CA_REPLYTO)) $criteria->add(EmailPeer::CA_REPLYTO, $this->ca_replyto);
		if ($this->isColumnModified(EmailPeer::CA_ADDRESS)) $criteria->add(EmailPeer::CA_ADDRESS, $this->ca_address);
		if ($this->isColumnModified(EmailPeer::CA_ATTACHMENT)) $criteria->add(EmailPeer::CA_ATTACHMENT, $this->ca_attachment);
		if ($this->isColumnModified(EmailPeer::CA_SUBJECT)) $criteria->add(EmailPeer::CA_SUBJECT, $this->ca_subject);
		if ($this->isColumnModified(EmailPeer::CA_BODY)) $criteria->add(EmailPeer::CA_BODY, $this->ca_body);
		if ($this->isColumnModified(EmailPeer::CA_READRECEIPT)) $criteria->add(EmailPeer::CA_READRECEIPT, $this->ca_readreceipt);

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
		$criteria = new Criteria(EmailPeer::DATABASE_NAME);

		$criteria->add(EmailPeer::CA_IDEMAIL, $this->ca_idemail);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdemail();
	}

	/**
	 * Generic method to set the primary key (ca_idemail column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdemail($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Email (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaFchenvio($this->ca_fchenvio);

		$copyObj->setCaUsuenvio($this->ca_usuenvio);

		$copyObj->setCaTipo($this->ca_tipo);

		$copyObj->setCaIdcaso($this->ca_idcaso);

		$copyObj->setCaFrom($this->ca_from);

		$copyObj->setCaFromname($this->ca_fromname);

		$copyObj->setCaCc($this->ca_cc);

		$copyObj->setCaReplyto($this->ca_replyto);

		$copyObj->setCaAddress($this->ca_address);

		$copyObj->setCaAttachment($this->ca_attachment);

		$copyObj->setCaSubject($this->ca_subject);

		$copyObj->setCaBody($this->ca_body);

		$copyObj->setCaReadreceipt($this->ca_readreceipt);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getRepAvisos() as $relObj) {
				$copyObj->addRepAviso($relObj->copy($deepCopy));
			}

			foreach($this->getRepStatuss() as $relObj) {
				$copyObj->addRepStatus($relObj->copy($deepCopy));
			}

			foreach($this->getEmailAttachments() as $relObj) {
				$copyObj->addEmailAttachment($relObj->copy($deepCopy));
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setCaIdemail(NULL); // this is a pkey column, so set to default value

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
	 * @return     Email Clone of current object.
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
	 * @return     EmailPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new EmailPeer();
		}
		return self::$peer;
	}

	/**
	 * Temporary storage of collRepAvisos to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initRepAvisos()
	{
		if ($this->collRepAvisos === null) {
			$this->collRepAvisos = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Email has previously
	 * been saved, it will retrieve related RepAvisos from storage.
	 * If this Email is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getRepAvisos($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepAvisos === null) {
			if ($this->isNew()) {
			   $this->collRepAvisos = array();
			} else {

				$criteria->add(RepAvisoPeer::CA_IDEMAIL, $this->getCaIdemail());

				RepAvisoPeer::addSelectColumns($criteria);
				$this->collRepAvisos = RepAvisoPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RepAvisoPeer::CA_IDEMAIL, $this->getCaIdemail());

				RepAvisoPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepAvisoCriteria) || !$this->lastRepAvisoCriteria->equals($criteria)) {
					$this->collRepAvisos = RepAvisoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepAvisoCriteria = $criteria;
		return $this->collRepAvisos;
	}

	/**
	 * Returns the number of related RepAvisos.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countRepAvisos($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RepAvisoPeer::CA_IDEMAIL, $this->getCaIdemail());

		return RepAvisoPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a RepAviso object to this object
	 * through the RepAviso foreign key attribute
	 *
	 * @param      RepAviso $l RepAviso
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRepAviso(RepAviso $l)
	{
		$this->collRepAvisos[] = $l;
		$l->setEmail($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Email is new, it will return
	 * an empty collection; or if this Email has previously
	 * been saved, it will retrieve related RepAvisos from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Email.
	 */
	public function getRepAvisosJoinReporte($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepAvisos === null) {
			if ($this->isNew()) {
				$this->collRepAvisos = array();
			} else {

				$criteria->add(RepAvisoPeer::CA_IDEMAIL, $this->getCaIdemail());

				$this->collRepAvisos = RepAvisoPeer::doSelectJoinReporte($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RepAvisoPeer::CA_IDEMAIL, $this->getCaIdemail());

			if (!isset($this->lastRepAvisoCriteria) || !$this->lastRepAvisoCriteria->equals($criteria)) {
				$this->collRepAvisos = RepAvisoPeer::doSelectJoinReporte($criteria, $con);
			}
		}
		$this->lastRepAvisoCriteria = $criteria;

		return $this->collRepAvisos;
	}

	/**
	 * Temporary storage of collRepStatuss to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initRepStatuss()
	{
		if ($this->collRepStatuss === null) {
			$this->collRepStatuss = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Email has previously
	 * been saved, it will retrieve related RepStatuss from storage.
	 * If this Email is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getRepStatuss($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepStatuss === null) {
			if ($this->isNew()) {
			   $this->collRepStatuss = array();
			} else {

				$criteria->add(RepStatusPeer::CA_IDEMAIL, $this->getCaIdemail());

				RepStatusPeer::addSelectColumns($criteria);
				$this->collRepStatuss = RepStatusPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RepStatusPeer::CA_IDEMAIL, $this->getCaIdemail());

				RepStatusPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepStatusCriteria) || !$this->lastRepStatusCriteria->equals($criteria)) {
					$this->collRepStatuss = RepStatusPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepStatusCriteria = $criteria;
		return $this->collRepStatuss;
	}

	/**
	 * Returns the number of related RepStatuss.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countRepStatuss($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RepStatusPeer::CA_IDEMAIL, $this->getCaIdemail());

		return RepStatusPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a RepStatus object to this object
	 * through the RepStatus foreign key attribute
	 *
	 * @param      RepStatus $l RepStatus
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRepStatus(RepStatus $l)
	{
		$this->collRepStatuss[] = $l;
		$l->setEmail($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Email is new, it will return
	 * an empty collection; or if this Email has previously
	 * been saved, it will retrieve related RepStatuss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Email.
	 */
	public function getRepStatussJoinReporte($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepStatuss === null) {
			if ($this->isNew()) {
				$this->collRepStatuss = array();
			} else {

				$criteria->add(RepStatusPeer::CA_IDEMAIL, $this->getCaIdemail());

				$this->collRepStatuss = RepStatusPeer::doSelectJoinReporte($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RepStatusPeer::CA_IDEMAIL, $this->getCaIdemail());

			if (!isset($this->lastRepStatusCriteria) || !$this->lastRepStatusCriteria->equals($criteria)) {
				$this->collRepStatuss = RepStatusPeer::doSelectJoinReporte($criteria, $con);
			}
		}
		$this->lastRepStatusCriteria = $criteria;

		return $this->collRepStatuss;
	}

	/**
	 * Temporary storage of collEmailAttachments to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initEmailAttachments()
	{
		if ($this->collEmailAttachments === null) {
			$this->collEmailAttachments = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Email has previously
	 * been saved, it will retrieve related EmailAttachments from storage.
	 * If this Email is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getEmailAttachments($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEmailAttachments === null) {
			if ($this->isNew()) {
			   $this->collEmailAttachments = array();
			} else {

				$criteria->add(EmailAttachmentPeer::CA_IDEMAIL, $this->getCaIdemail());

				EmailAttachmentPeer::addSelectColumns($criteria);
				$this->collEmailAttachments = EmailAttachmentPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(EmailAttachmentPeer::CA_IDEMAIL, $this->getCaIdemail());

				EmailAttachmentPeer::addSelectColumns($criteria);
				if (!isset($this->lastEmailAttachmentCriteria) || !$this->lastEmailAttachmentCriteria->equals($criteria)) {
					$this->collEmailAttachments = EmailAttachmentPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEmailAttachmentCriteria = $criteria;
		return $this->collEmailAttachments;
	}

	/**
	 * Returns the number of related EmailAttachments.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countEmailAttachments($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EmailAttachmentPeer::CA_IDEMAIL, $this->getCaIdemail());

		return EmailAttachmentPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a EmailAttachment object to this object
	 * through the EmailAttachment foreign key attribute
	 *
	 * @param      EmailAttachment $l EmailAttachment
	 * @return     void
	 * @throws     PropelException
	 */
	public function addEmailAttachment(EmailAttachment $l)
	{
		$this->collEmailAttachments[] = $l;
		$l->setEmail($this);
	}

} // BaseEmail
