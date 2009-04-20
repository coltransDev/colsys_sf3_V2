<?php

/**
 * Base class that represents a row from the 'tb_transportistas' table.
 *
 * 
 *
 * @package    lib.model.public.om
 */
abstract class BaseTransportista extends BaseObject  implements Persistent {


  const PEER = 'TransportistaPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        TransportistaPeer
	 */
	protected static $peer;

	/**
	 * The value for the ca_idtransportista field.
	 * @var        int
	 */
	protected $ca_idtransportista;

	/**
	 * The value for the ca_digito field.
	 * @var        string
	 */
	protected $ca_digito;

	/**
	 * The value for the ca_nombre field.
	 * @var        string
	 */
	protected $ca_nombre;

	/**
	 * The value for the ca_direccion field.
	 * @var        string
	 */
	protected $ca_direccion;

	/**
	 * The value for the ca_telefonos field.
	 * @var        string
	 */
	protected $ca_telefonos;

	/**
	 * The value for the ca_fax field.
	 * @var        string
	 */
	protected $ca_fax;

	/**
	 * The value for the ca_idciudad field.
	 * @var        string
	 */
	protected $ca_idciudad;

	/**
	 * The value for the ca_website field.
	 * @var        string
	 */
	protected $ca_website;

	/**
	 * The value for the ca_email field.
	 * @var        string
	 */
	protected $ca_email;

	/**
	 * @var        array Transportador[] Collection to store aggregation of Transportador objects.
	 */
	protected $collTransportadors;

	/**
	 * @var        Criteria The criteria used to select the current contents of collTransportadors.
	 */
	private $lastTransportadorCriteria = null;

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
	 * Initializes internal state of BaseTransportista object.
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
	 * Get the [ca_idtransportista] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdtransportista()
	{
		return $this->ca_idtransportista;
	}

	/**
	 * Get the [ca_digito] column value.
	 * 
	 * @return     string
	 */
	public function getCaDigito()
	{
		return $this->ca_digito;
	}

	/**
	 * Get the [ca_nombre] column value.
	 * 
	 * @return     string
	 */
	public function getCaNombre()
	{
		return $this->ca_nombre;
	}

	/**
	 * Get the [ca_direccion] column value.
	 * 
	 * @return     string
	 */
	public function getCaDireccion()
	{
		return $this->ca_direccion;
	}

	/**
	 * Get the [ca_telefonos] column value.
	 * 
	 * @return     string
	 */
	public function getCaTelefonos()
	{
		return $this->ca_telefonos;
	}

	/**
	 * Get the [ca_fax] column value.
	 * 
	 * @return     string
	 */
	public function getCaFax()
	{
		return $this->ca_fax;
	}

	/**
	 * Get the [ca_idciudad] column value.
	 * 
	 * @return     string
	 */
	public function getCaIdciudad()
	{
		return $this->ca_idciudad;
	}

	/**
	 * Get the [ca_website] column value.
	 * 
	 * @return     string
	 */
	public function getCaWebsite()
	{
		return $this->ca_website;
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
	 * Set the value of [ca_idtransportista] column.
	 * 
	 * @param      int $v new value
	 * @return     Transportista The current object (for fluent API support)
	 */
	public function setCaIdtransportista($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idtransportista !== $v) {
			$this->ca_idtransportista = $v;
			$this->modifiedColumns[] = TransportistaPeer::CA_IDTRANSPORTISTA;
		}

		return $this;
	} // setCaIdtransportista()

	/**
	 * Set the value of [ca_digito] column.
	 * 
	 * @param      string $v new value
	 * @return     Transportista The current object (for fluent API support)
	 */
	public function setCaDigito($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_digito !== $v) {
			$this->ca_digito = $v;
			$this->modifiedColumns[] = TransportistaPeer::CA_DIGITO;
		}

		return $this;
	} // setCaDigito()

	/**
	 * Set the value of [ca_nombre] column.
	 * 
	 * @param      string $v new value
	 * @return     Transportista The current object (for fluent API support)
	 */
	public function setCaNombre($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_nombre !== $v) {
			$this->ca_nombre = $v;
			$this->modifiedColumns[] = TransportistaPeer::CA_NOMBRE;
		}

		return $this;
	} // setCaNombre()

	/**
	 * Set the value of [ca_direccion] column.
	 * 
	 * @param      string $v new value
	 * @return     Transportista The current object (for fluent API support)
	 */
	public function setCaDireccion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_direccion !== $v) {
			$this->ca_direccion = $v;
			$this->modifiedColumns[] = TransportistaPeer::CA_DIRECCION;
		}

		return $this;
	} // setCaDireccion()

	/**
	 * Set the value of [ca_telefonos] column.
	 * 
	 * @param      string $v new value
	 * @return     Transportista The current object (for fluent API support)
	 */
	public function setCaTelefonos($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_telefonos !== $v) {
			$this->ca_telefonos = $v;
			$this->modifiedColumns[] = TransportistaPeer::CA_TELEFONOS;
		}

		return $this;
	} // setCaTelefonos()

	/**
	 * Set the value of [ca_fax] column.
	 * 
	 * @param      string $v new value
	 * @return     Transportista The current object (for fluent API support)
	 */
	public function setCaFax($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_fax !== $v) {
			$this->ca_fax = $v;
			$this->modifiedColumns[] = TransportistaPeer::CA_FAX;
		}

		return $this;
	} // setCaFax()

	/**
	 * Set the value of [ca_idciudad] column.
	 * 
	 * @param      string $v new value
	 * @return     Transportista The current object (for fluent API support)
	 */
	public function setCaIdciudad($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idciudad !== $v) {
			$this->ca_idciudad = $v;
			$this->modifiedColumns[] = TransportistaPeer::CA_IDCIUDAD;
		}

		return $this;
	} // setCaIdciudad()

	/**
	 * Set the value of [ca_website] column.
	 * 
	 * @param      string $v new value
	 * @return     Transportista The current object (for fluent API support)
	 */
	public function setCaWebsite($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_website !== $v) {
			$this->ca_website = $v;
			$this->modifiedColumns[] = TransportistaPeer::CA_WEBSITE;
		}

		return $this;
	} // setCaWebsite()

	/**
	 * Set the value of [ca_email] column.
	 * 
	 * @param      string $v new value
	 * @return     Transportista The current object (for fluent API support)
	 */
	public function setCaEmail($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_email !== $v) {
			$this->ca_email = $v;
			$this->modifiedColumns[] = TransportistaPeer::CA_EMAIL;
		}

		return $this;
	} // setCaEmail()

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

			$this->ca_idtransportista = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_digito = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_nombre = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_direccion = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_telefonos = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_fax = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_idciudad = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_website = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_email = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 9; // 9 = TransportistaPeer::NUM_COLUMNS - TransportistaPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Transportista object", $e);
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
			$con = Propel::getConnection(TransportistaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = TransportistaPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->collTransportadors = null;
			$this->lastTransportadorCriteria = null;

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
			$con = Propel::getConnection(TransportistaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			TransportistaPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(TransportistaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			TransportistaPeer::addInstanceToPool($this);
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

			if ($this->isNew() ) {
				$this->modifiedColumns[] = TransportistaPeer::CA_IDTRANSPORTISTA;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TransportistaPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setCaIdtransportista($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += TransportistaPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collTransportadors !== null) {
				foreach ($this->collTransportadors as $referrerFK) {
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


			if (($retval = TransportistaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collTransportadors !== null) {
					foreach ($this->collTransportadors as $referrerFK) {
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
		$pos = TransportistaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdtransportista();
				break;
			case 1:
				return $this->getCaDigito();
				break;
			case 2:
				return $this->getCaNombre();
				break;
			case 3:
				return $this->getCaDireccion();
				break;
			case 4:
				return $this->getCaTelefonos();
				break;
			case 5:
				return $this->getCaFax();
				break;
			case 6:
				return $this->getCaIdciudad();
				break;
			case 7:
				return $this->getCaWebsite();
				break;
			case 8:
				return $this->getCaEmail();
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
		$keys = TransportistaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdtransportista(),
			$keys[1] => $this->getCaDigito(),
			$keys[2] => $this->getCaNombre(),
			$keys[3] => $this->getCaDireccion(),
			$keys[4] => $this->getCaTelefonos(),
			$keys[5] => $this->getCaFax(),
			$keys[6] => $this->getCaIdciudad(),
			$keys[7] => $this->getCaWebsite(),
			$keys[8] => $this->getCaEmail(),
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
		$pos = TransportistaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdtransportista($value);
				break;
			case 1:
				$this->setCaDigito($value);
				break;
			case 2:
				$this->setCaNombre($value);
				break;
			case 3:
				$this->setCaDireccion($value);
				break;
			case 4:
				$this->setCaTelefonos($value);
				break;
			case 5:
				$this->setCaFax($value);
				break;
			case 6:
				$this->setCaIdciudad($value);
				break;
			case 7:
				$this->setCaWebsite($value);
				break;
			case 8:
				$this->setCaEmail($value);
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
		$keys = TransportistaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdtransportista($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaDigito($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaNombre($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaDireccion($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaTelefonos($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaFax($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaIdciudad($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaWebsite($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaEmail($arr[$keys[8]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(TransportistaPeer::DATABASE_NAME);

		if ($this->isColumnModified(TransportistaPeer::CA_IDTRANSPORTISTA)) $criteria->add(TransportistaPeer::CA_IDTRANSPORTISTA, $this->ca_idtransportista);
		if ($this->isColumnModified(TransportistaPeer::CA_DIGITO)) $criteria->add(TransportistaPeer::CA_DIGITO, $this->ca_digito);
		if ($this->isColumnModified(TransportistaPeer::CA_NOMBRE)) $criteria->add(TransportistaPeer::CA_NOMBRE, $this->ca_nombre);
		if ($this->isColumnModified(TransportistaPeer::CA_DIRECCION)) $criteria->add(TransportistaPeer::CA_DIRECCION, $this->ca_direccion);
		if ($this->isColumnModified(TransportistaPeer::CA_TELEFONOS)) $criteria->add(TransportistaPeer::CA_TELEFONOS, $this->ca_telefonos);
		if ($this->isColumnModified(TransportistaPeer::CA_FAX)) $criteria->add(TransportistaPeer::CA_FAX, $this->ca_fax);
		if ($this->isColumnModified(TransportistaPeer::CA_IDCIUDAD)) $criteria->add(TransportistaPeer::CA_IDCIUDAD, $this->ca_idciudad);
		if ($this->isColumnModified(TransportistaPeer::CA_WEBSITE)) $criteria->add(TransportistaPeer::CA_WEBSITE, $this->ca_website);
		if ($this->isColumnModified(TransportistaPeer::CA_EMAIL)) $criteria->add(TransportistaPeer::CA_EMAIL, $this->ca_email);

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
		$criteria = new Criteria(TransportistaPeer::DATABASE_NAME);

		$criteria->add(TransportistaPeer::CA_IDTRANSPORTISTA, $this->ca_idtransportista);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdtransportista();
	}

	/**
	 * Generic method to set the primary key (ca_idtransportista column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdtransportista($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Transportista (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaDigito($this->ca_digito);

		$copyObj->setCaNombre($this->ca_nombre);

		$copyObj->setCaDireccion($this->ca_direccion);

		$copyObj->setCaTelefonos($this->ca_telefonos);

		$copyObj->setCaFax($this->ca_fax);

		$copyObj->setCaIdciudad($this->ca_idciudad);

		$copyObj->setCaWebsite($this->ca_website);

		$copyObj->setCaEmail($this->ca_email);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getTransportadors() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addTransportador($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setCaIdtransportista(NULL); // this is a auto-increment column, so set to default value

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
	 * @return     Transportista Clone of current object.
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
	 * @return     TransportistaPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new TransportistaPeer();
		}
		return self::$peer;
	}

	/**
	 * Clears out the collTransportadors collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addTransportadors()
	 */
	public function clearTransportadors()
	{
		$this->collTransportadors = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collTransportadors collection (array).
	 *
	 * By default this just sets the collTransportadors collection to an empty array (like clearcollTransportadors());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initTransportadors()
	{
		$this->collTransportadors = array();
	}

	/**
	 * Gets an array of Transportador objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Transportista has previously been saved, it will retrieve
	 * related Transportadors from storage. If this Transportista is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array Transportador[]
	 * @throws     PropelException
	 */
	public function getTransportadors($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportistaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTransportadors === null) {
			if ($this->isNew()) {
			   $this->collTransportadors = array();
			} else {

				$criteria->add(TransportadorPeer::CA_IDTRANSPORTISTA, $this->ca_idtransportista);

				TransportadorPeer::addSelectColumns($criteria);
				$this->collTransportadors = TransportadorPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(TransportadorPeer::CA_IDTRANSPORTISTA, $this->ca_idtransportista);

				TransportadorPeer::addSelectColumns($criteria);
				if (!isset($this->lastTransportadorCriteria) || !$this->lastTransportadorCriteria->equals($criteria)) {
					$this->collTransportadors = TransportadorPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastTransportadorCriteria = $criteria;
		return $this->collTransportadors;
	}

	/**
	 * Returns the number of related Transportador objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Transportador objects.
	 * @throws     PropelException
	 */
	public function countTransportadors(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportistaPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collTransportadors === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(TransportadorPeer::CA_IDTRANSPORTISTA, $this->ca_idtransportista);

				$count = TransportadorPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(TransportadorPeer::CA_IDTRANSPORTISTA, $this->ca_idtransportista);

				if (!isset($this->lastTransportadorCriteria) || !$this->lastTransportadorCriteria->equals($criteria)) {
					$count = TransportadorPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collTransportadors);
				}
			} else {
				$count = count($this->collTransportadors);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a Transportador object to this object
	 * through the Transportador foreign key attribute.
	 *
	 * @param      Transportador $l Transportador
	 * @return     void
	 * @throws     PropelException
	 */
	public function addTransportador(Transportador $l)
	{
		if ($this->collTransportadors === null) {
			$this->initTransportadors();
		}
		if (!in_array($l, $this->collTransportadors, true)) { // only add it if the **same** object is not already associated
			array_push($this->collTransportadors, $l);
			$l->setTransportista($this);
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
			if ($this->collTransportadors) {
				foreach ((array) $this->collTransportadors as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collTransportadors = null;
	}

} // BaseTransportista
