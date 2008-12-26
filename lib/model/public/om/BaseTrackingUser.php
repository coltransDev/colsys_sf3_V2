<?php

/**
 * Base class that represents a row from the 'tb_tracking_users' table.
 *
 * 
 *
 * @package    lib.model.public.om
 */
abstract class BaseTrackingUser extends BaseObject  implements Persistent {


  const PEER = 'TrackingUserPeer';

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
	 * @var        string
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
	 * @var        array TrackingUserLog[] Collection to store aggregation of TrackingUserLog objects.
	 */
	protected $collTrackingUserLogs;

	/**
	 * @var        Criteria The criteria used to select the current contents of collTrackingUserLogs.
	 */
	private $lastTrackingUserLogCriteria = null;

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
	 * Initializes internal state of BaseTrackingUser object.
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
	 * Get the [optionally formatted] temporal [ca_password_expiry] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaPasswordExpiry($format = 'Y-m-d')
	{
		if ($this->ca_password_expiry === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_password_expiry);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_password_expiry, true), $x);
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
	 * @return     TrackingUser The current object (for fluent API support)
	 */
	public function setCaId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_id !== $v) {
			$this->ca_id = $v;
			$this->modifiedColumns[] = TrackingUserPeer::CA_ID;
		}

		return $this;
	} // setCaId()

	/**
	 * Set the value of [ca_email] column.
	 * 
	 * @param      string $v new value
	 * @return     TrackingUser The current object (for fluent API support)
	 */
	public function setCaEmail($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_email !== $v) {
			$this->ca_email = $v;
			$this->modifiedColumns[] = TrackingUserPeer::CA_EMAIL;
		}

		return $this;
	} // setCaEmail()

	/**
	 * Set the value of [ca_blocked] column.
	 * 
	 * @param      boolean $v new value
	 * @return     TrackingUser The current object (for fluent API support)
	 */
	public function setCaBlocked($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->ca_blocked !== $v) {
			$this->ca_blocked = $v;
			$this->modifiedColumns[] = TrackingUserPeer::CA_BLOCKED;
		}

		return $this;
	} // setCaBlocked()

	/**
	 * Set the value of [ca_activation_code] column.
	 * 
	 * @param      string $v new value
	 * @return     TrackingUser The current object (for fluent API support)
	 */
	public function setCaActivationCode($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_activation_code !== $v) {
			$this->ca_activation_code = $v;
			$this->modifiedColumns[] = TrackingUserPeer::CA_ACTIVATION_CODE;
		}

		return $this;
	} // setCaActivationCode()

	/**
	 * Set the value of [ca_passwd] column.
	 * 
	 * @param      string $v new value
	 * @return     TrackingUser The current object (for fluent API support)
	 */
	public function setCaPasswd($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_passwd !== $v) {
			$this->ca_passwd = $v;
			$this->modifiedColumns[] = TrackingUserPeer::CA_PASSWD;
		}

		return $this;
	} // setCaPasswd()

	/**
	 * Sets the value of [ca_password_expiry] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     TrackingUser The current object (for fluent API support)
	 */
	public function setCaPasswordExpiry($v)
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

		if ( $this->ca_password_expiry !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_password_expiry !== null && $tmpDt = new DateTime($this->ca_password_expiry)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_password_expiry = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = TrackingUserPeer::CA_PASSWORD_EXPIRY;
			}
		} // if either are not null

		return $this;
	} // setCaPasswordExpiry()

	/**
	 * Set the value of [ca_activated] column.
	 * 
	 * @param      boolean $v new value
	 * @return     TrackingUser The current object (for fluent API support)
	 */
	public function setCaActivated($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->ca_activated !== $v) {
			$this->ca_activated = $v;
			$this->modifiedColumns[] = TrackingUserPeer::CA_ACTIVATED;
		}

		return $this;
	} // setCaActivated()

	/**
	 * Set the value of [ca_idcontacto] column.
	 * 
	 * @param      int $v new value
	 * @return     TrackingUser The current object (for fluent API support)
	 */
	public function setCaIdcontacto($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idcontacto !== $v) {
			$this->ca_idcontacto = $v;
			$this->modifiedColumns[] = TrackingUserPeer::CA_IDCONTACTO;
		}

		if ($this->aContacto !== null && $this->aContacto->getCaIdcontacto() !== $v) {
			$this->aContacto = null;
		}

		return $this;
	} // setCaIdcontacto()

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

			$this->ca_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_email = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_blocked = ($row[$startcol + 2] !== null) ? (boolean) $row[$startcol + 2] : null;
			$this->ca_activation_code = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_passwd = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_password_expiry = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_activated = ($row[$startcol + 6] !== null) ? (boolean) $row[$startcol + 6] : null;
			$this->ca_idcontacto = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 8; // 8 = TrackingUserPeer::NUM_COLUMNS - TrackingUserPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating TrackingUser object", $e);
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

		if ($this->aContacto !== null && $this->ca_idcontacto !== $this->aContacto->getCaIdcontacto()) {
			$this->aContacto = null;
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
			$con = Propel::getConnection(TrackingUserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = TrackingUserPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aContacto = null;
			$this->collTrackingUserLogs = null;
			$this->lastTrackingUserLogCriteria = null;

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
			$con = Propel::getConnection(TrackingUserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			TrackingUserPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(TrackingUserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			TrackingUserPeer::addInstanceToPool($this);
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

			if ($this->aContacto !== null) {
				if ($this->aContacto->isModified() || $this->aContacto->isNew()) {
					$affectedRows += $this->aContacto->save($con);
				}
				$this->setContacto($this->aContacto);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = TrackingUserPeer::CA_ID;
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
				foreach ($this->collTrackingUserLogs as $referrerFK) {
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
					foreach ($this->collTrackingUserLogs as $referrerFK) {
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
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TrackingUserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
	 * @param      string $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                        BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. Defaults to BasePeer::TYPE_PHPNAME.
	 * @param      boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns.  Defaults to TRUE.
	 * @return     an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
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
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
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

			foreach ($this->getTrackingUserLogs() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addTrackingUserLog($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setCaId(NULL); // this is a auto-increment column, so set to default value

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
	 * @return     TrackingUser The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setContacto(Contacto $v = null)
	{
		if ($v === null) {
			$this->setCaIdcontacto(NULL);
		} else {
			$this->setCaIdcontacto($v->getCaIdcontacto());
		}

		$this->aContacto = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Contacto object, it will not be re-added.
		if ($v !== null) {
			$v->addTrackingUser($this);
		}

		return $this;
	}


	/**
	 * Get the associated Contacto object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Contacto The associated Contacto object.
	 * @throws     PropelException
	 */
	public function getContacto(PropelPDO $con = null)
	{
		if ($this->aContacto === null && ($this->ca_idcontacto !== null)) {
			$c = new Criteria(ContactoPeer::DATABASE_NAME);
			$c->add(ContactoPeer::CA_IDCONTACTO, $this->ca_idcontacto);
			$this->aContacto = ContactoPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aContacto->addTrackingUsers($this);
			 */
		}
		return $this->aContacto;
	}

	/**
	 * Clears out the collTrackingUserLogs collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addTrackingUserLogs()
	 */
	public function clearTrackingUserLogs()
	{
		$this->collTrackingUserLogs = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collTrackingUserLogs collection (array).
	 *
	 * By default this just sets the collTrackingUserLogs collection to an empty array (like clearcollTrackingUserLogs());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initTrackingUserLogs()
	{
		$this->collTrackingUserLogs = array();
	}

	/**
	 * Gets an array of TrackingUserLog objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this TrackingUser has previously been saved, it will retrieve
	 * related TrackingUserLogs from storage. If this TrackingUser is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array TrackingUserLog[]
	 * @throws     PropelException
	 */
	public function getTrackingUserLogs($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TrackingUserPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTrackingUserLogs === null) {
			if ($this->isNew()) {
			   $this->collTrackingUserLogs = array();
			} else {

				$criteria->add(TrackingUserLogPeer::CA_EMAIL, $this->ca_email);

				TrackingUserLogPeer::addSelectColumns($criteria);
				$this->collTrackingUserLogs = TrackingUserLogPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(TrackingUserLogPeer::CA_EMAIL, $this->ca_email);

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
	 * Returns the number of related TrackingUserLog objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related TrackingUserLog objects.
	 * @throws     PropelException
	 */
	public function countTrackingUserLogs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TrackingUserPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collTrackingUserLogs === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(TrackingUserLogPeer::CA_EMAIL, $this->ca_email);

				$count = TrackingUserLogPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(TrackingUserLogPeer::CA_EMAIL, $this->ca_email);

				if (!isset($this->lastTrackingUserLogCriteria) || !$this->lastTrackingUserLogCriteria->equals($criteria)) {
					$count = TrackingUserLogPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collTrackingUserLogs);
				}
			} else {
				$count = count($this->collTrackingUserLogs);
			}
		}
		$this->lastTrackingUserLogCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a TrackingUserLog object to this object
	 * through the TrackingUserLog foreign key attribute.
	 *
	 * @param      TrackingUserLog $l TrackingUserLog
	 * @return     void
	 * @throws     PropelException
	 */
	public function addTrackingUserLog(TrackingUserLog $l)
	{
		if ($this->collTrackingUserLogs === null) {
			$this->initTrackingUserLogs();
		}
		if (!in_array($l, $this->collTrackingUserLogs, true)) { // only add it if the **same** object is not already associated
			array_push($this->collTrackingUserLogs, $l);
			$l->setTrackingUser($this);
		}
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
			if ($this->collTrackingUserLogs) {
				foreach ((array) $this->collTrackingUserLogs as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collTrackingUserLogs = null;
			$this->aContacto = null;
	}

} // BaseTrackingUser
