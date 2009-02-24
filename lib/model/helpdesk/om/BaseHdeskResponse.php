<?php

/**
 * Base class that represents a row from the 'helpdesk.tb_responses' table.
 *
 * 
 *
 * @package    lib.model.helpdesk.om
 */
abstract class BaseHdeskResponse extends BaseObject  implements Persistent {


  const PEER = 'HdeskResponsePeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        HdeskResponsePeer
	 */
	protected static $peer;

	/**
	 * The value for the ca_idresponse field.
	 * @var        int
	 */
	protected $ca_idresponse;

	/**
	 * The value for the ca_idticket field.
	 * @var        int
	 */
	protected $ca_idticket;

	/**
	 * The value for the ca_responsetoresponse field.
	 * @var        int
	 */
	protected $ca_responsetoresponse;

	/**
	 * The value for the ca_login field.
	 * @var        string
	 */
	protected $ca_login;

	/**
	 * The value for the ca_createdat field.
	 * @var        string
	 */
	protected $ca_createdat;

	/**
	 * The value for the ca_text field.
	 * @var        string
	 */
	protected $ca_text;

	/**
	 * @var        HdeskTicket
	 */
	protected $aHdeskTicket;

	/**
	 * @var        Usuario
	 */
	protected $aUsuario;

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
	 * Initializes internal state of BaseHdeskResponse object.
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
	 * Get the [ca_idresponse] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdresponse()
	{
		return $this->ca_idresponse;
	}

	/**
	 * Get the [ca_idticket] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdticket()
	{
		return $this->ca_idticket;
	}

	/**
	 * Get the [ca_responsetoresponse] column value.
	 * 
	 * @return     int
	 */
	public function getCaResponsetoresponse()
	{
		return $this->ca_responsetoresponse;
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
	 * Get the [optionally formatted] temporal [ca_createdat] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaCreatedat($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_createdat === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_createdat);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_createdat, true), $x);
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [ca_text] column value.
	 * 
	 * @return     string
	 */
	public function getCaText()
	{
		return $this->ca_text;
	}

	/**
	 * Set the value of [ca_idresponse] column.
	 * 
	 * @param      int $v new value
	 * @return     HdeskResponse The current object (for fluent API support)
	 */
	public function setCaIdresponse($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idresponse !== $v) {
			$this->ca_idresponse = $v;
			$this->modifiedColumns[] = HdeskResponsePeer::CA_IDRESPONSE;
		}

		return $this;
	} // setCaIdresponse()

	/**
	 * Set the value of [ca_idticket] column.
	 * 
	 * @param      int $v new value
	 * @return     HdeskResponse The current object (for fluent API support)
	 */
	public function setCaIdticket($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idticket !== $v) {
			$this->ca_idticket = $v;
			$this->modifiedColumns[] = HdeskResponsePeer::CA_IDTICKET;
		}

		if ($this->aHdeskTicket !== null && $this->aHdeskTicket->getCaIdticket() !== $v) {
			$this->aHdeskTicket = null;
		}

		return $this;
	} // setCaIdticket()

	/**
	 * Set the value of [ca_responsetoresponse] column.
	 * 
	 * @param      int $v new value
	 * @return     HdeskResponse The current object (for fluent API support)
	 */
	public function setCaResponsetoresponse($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_responsetoresponse !== $v) {
			$this->ca_responsetoresponse = $v;
			$this->modifiedColumns[] = HdeskResponsePeer::CA_RESPONSETORESPONSE;
		}

		return $this;
	} // setCaResponsetoresponse()

	/**
	 * Set the value of [ca_login] column.
	 * 
	 * @param      string $v new value
	 * @return     HdeskResponse The current object (for fluent API support)
	 */
	public function setCaLogin($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_login !== $v) {
			$this->ca_login = $v;
			$this->modifiedColumns[] = HdeskResponsePeer::CA_LOGIN;
		}

		if ($this->aUsuario !== null && $this->aUsuario->getCaLogin() !== $v) {
			$this->aUsuario = null;
		}

		return $this;
	} // setCaLogin()

	/**
	 * Sets the value of [ca_createdat] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     HdeskResponse The current object (for fluent API support)
	 */
	public function setCaCreatedat($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->ca_createdat !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_createdat !== null && $tmpDt = new DateTime($this->ca_createdat)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_createdat = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = HdeskResponsePeer::CA_CREATEDAT;
			}
		} // if either are not null

		return $this;
	} // setCaCreatedat()

	/**
	 * Set the value of [ca_text] column.
	 * 
	 * @param      string $v new value
	 * @return     HdeskResponse The current object (for fluent API support)
	 */
	public function setCaText($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_text !== $v) {
			$this->ca_text = $v;
			$this->modifiedColumns[] = HdeskResponsePeer::CA_TEXT;
		}

		return $this;
	} // setCaText()

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

			$this->ca_idresponse = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_idticket = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_responsetoresponse = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->ca_login = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_createdat = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_text = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 6; // 6 = HdeskResponsePeer::NUM_COLUMNS - HdeskResponsePeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating HdeskResponse object", $e);
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

		if ($this->aHdeskTicket !== null && $this->ca_idticket !== $this->aHdeskTicket->getCaIdticket()) {
			$this->aHdeskTicket = null;
		}
		if ($this->aUsuario !== null && $this->ca_login !== $this->aUsuario->getCaLogin()) {
			$this->aUsuario = null;
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
			$con = Propel::getConnection(HdeskResponsePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = HdeskResponsePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aHdeskTicket = null;
			$this->aUsuario = null;
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
			$con = Propel::getConnection(HdeskResponsePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			HdeskResponsePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(HdeskResponsePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			HdeskResponsePeer::addInstanceToPool($this);
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

			if ($this->aHdeskTicket !== null) {
				if ($this->aHdeskTicket->isModified() || $this->aHdeskTicket->isNew()) {
					$affectedRows += $this->aHdeskTicket->save($con);
				}
				$this->setHdeskTicket($this->aHdeskTicket);
			}

			if ($this->aUsuario !== null) {
				if ($this->aUsuario->isModified() || $this->aUsuario->isNew()) {
					$affectedRows += $this->aUsuario->save($con);
				}
				$this->setUsuario($this->aUsuario);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = HdeskResponsePeer::CA_IDRESPONSE;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = HdeskResponsePeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setCaIdresponse($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += HdeskResponsePeer::doUpdate($this, $con);
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

			if ($this->aHdeskTicket !== null) {
				if (!$this->aHdeskTicket->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aHdeskTicket->getValidationFailures());
				}
			}

			if ($this->aUsuario !== null) {
				if (!$this->aUsuario->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsuario->getValidationFailures());
				}
			}


			if (($retval = HdeskResponsePeer::doValidate($this, $columns)) !== true) {
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
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = HdeskResponsePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdresponse();
				break;
			case 1:
				return $this->getCaIdticket();
				break;
			case 2:
				return $this->getCaResponsetoresponse();
				break;
			case 3:
				return $this->getCaLogin();
				break;
			case 4:
				return $this->getCaCreatedat();
				break;
			case 5:
				return $this->getCaText();
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
		$keys = HdeskResponsePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdresponse(),
			$keys[1] => $this->getCaIdticket(),
			$keys[2] => $this->getCaResponsetoresponse(),
			$keys[3] => $this->getCaLogin(),
			$keys[4] => $this->getCaCreatedat(),
			$keys[5] => $this->getCaText(),
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
		$pos = HdeskResponsePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdresponse($value);
				break;
			case 1:
				$this->setCaIdticket($value);
				break;
			case 2:
				$this->setCaResponsetoresponse($value);
				break;
			case 3:
				$this->setCaLogin($value);
				break;
			case 4:
				$this->setCaCreatedat($value);
				break;
			case 5:
				$this->setCaText($value);
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
		$keys = HdeskResponsePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdresponse($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdticket($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaResponsetoresponse($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaLogin($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaCreatedat($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaText($arr[$keys[5]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(HdeskResponsePeer::DATABASE_NAME);

		if ($this->isColumnModified(HdeskResponsePeer::CA_IDRESPONSE)) $criteria->add(HdeskResponsePeer::CA_IDRESPONSE, $this->ca_idresponse);
		if ($this->isColumnModified(HdeskResponsePeer::CA_IDTICKET)) $criteria->add(HdeskResponsePeer::CA_IDTICKET, $this->ca_idticket);
		if ($this->isColumnModified(HdeskResponsePeer::CA_RESPONSETORESPONSE)) $criteria->add(HdeskResponsePeer::CA_RESPONSETORESPONSE, $this->ca_responsetoresponse);
		if ($this->isColumnModified(HdeskResponsePeer::CA_LOGIN)) $criteria->add(HdeskResponsePeer::CA_LOGIN, $this->ca_login);
		if ($this->isColumnModified(HdeskResponsePeer::CA_CREATEDAT)) $criteria->add(HdeskResponsePeer::CA_CREATEDAT, $this->ca_createdat);
		if ($this->isColumnModified(HdeskResponsePeer::CA_TEXT)) $criteria->add(HdeskResponsePeer::CA_TEXT, $this->ca_text);

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
		$criteria = new Criteria(HdeskResponsePeer::DATABASE_NAME);

		$criteria->add(HdeskResponsePeer::CA_IDRESPONSE, $this->ca_idresponse);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdresponse();
	}

	/**
	 * Generic method to set the primary key (ca_idresponse column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdresponse($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of HdeskResponse (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdticket($this->ca_idticket);

		$copyObj->setCaResponsetoresponse($this->ca_responsetoresponse);

		$copyObj->setCaLogin($this->ca_login);

		$copyObj->setCaCreatedat($this->ca_createdat);

		$copyObj->setCaText($this->ca_text);


		$copyObj->setNew(true);

		$copyObj->setCaIdresponse(NULL); // this is a auto-increment column, so set to default value

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
	 * @return     HdeskResponse Clone of current object.
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
	 * @return     HdeskResponsePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new HdeskResponsePeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a HdeskTicket object.
	 *
	 * @param      HdeskTicket $v
	 * @return     HdeskResponse The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setHdeskTicket(HdeskTicket $v = null)
	{
		if ($v === null) {
			$this->setCaIdticket(NULL);
		} else {
			$this->setCaIdticket($v->getCaIdticket());
		}

		$this->aHdeskTicket = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the HdeskTicket object, it will not be re-added.
		if ($v !== null) {
			$v->addHdeskResponse($this);
		}

		return $this;
	}


	/**
	 * Get the associated HdeskTicket object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     HdeskTicket The associated HdeskTicket object.
	 * @throws     PropelException
	 */
	public function getHdeskTicket(PropelPDO $con = null)
	{
		if ($this->aHdeskTicket === null && ($this->ca_idticket !== null)) {
			$c = new Criteria(HdeskTicketPeer::DATABASE_NAME);
			$c->add(HdeskTicketPeer::CA_IDTICKET, $this->ca_idticket);
			$this->aHdeskTicket = HdeskTicketPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aHdeskTicket->addHdeskResponses($this);
			 */
		}
		return $this->aHdeskTicket;
	}

	/**
	 * Declares an association between this object and a Usuario object.
	 *
	 * @param      Usuario $v
	 * @return     HdeskResponse The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setUsuario(Usuario $v = null)
	{
		if ($v === null) {
			$this->setCaLogin(NULL);
		} else {
			$this->setCaLogin($v->getCaLogin());
		}

		$this->aUsuario = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Usuario object, it will not be re-added.
		if ($v !== null) {
			$v->addHdeskResponse($this);
		}

		return $this;
	}


	/**
	 * Get the associated Usuario object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Usuario The associated Usuario object.
	 * @throws     PropelException
	 */
	public function getUsuario(PropelPDO $con = null)
	{
		if ($this->aUsuario === null && (($this->ca_login !== "" && $this->ca_login !== null))) {
			$c = new Criteria(UsuarioPeer::DATABASE_NAME);
			$c->add(UsuarioPeer::CA_LOGIN, $this->ca_login);
			$this->aUsuario = UsuarioPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aUsuario->addHdeskResponses($this);
			 */
		}
		return $this->aUsuario;
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
		} // if ($deep)

			$this->aHdeskTicket = null;
			$this->aUsuario = null;
	}

} // BaseHdeskResponse
