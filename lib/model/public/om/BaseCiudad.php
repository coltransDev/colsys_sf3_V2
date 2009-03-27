<?php

/**
 * Base class that represents a row from the 'tb_ciudades' table.
 *
 * 
 *
 * @package    lib.model.public.om
 */
abstract class BaseCiudad extends BaseObject  implements Persistent {


  const PEER = 'CiudadPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        CiudadPeer
	 */
	protected static $peer;

	/**
	 * The value for the ca_idciudad field.
	 * @var        string
	 */
	protected $ca_idciudad;

	/**
	 * The value for the ca_ciudad field.
	 * @var        string
	 */
	protected $ca_ciudad;

	/**
	 * The value for the ca_idtrafico field.
	 * @var        string
	 */
	protected $ca_idtrafico;

	/**
	 * The value for the ca_puerto field.
	 * @var        string
	 */
	protected $ca_puerto;

	/**
	 * @var        Trafico
	 */
	protected $aTrafico;

	/**
	 * @var        array PricRecargosxCiudad[] Collection to store aggregation of PricRecargosxCiudad objects.
	 */
	protected $collPricRecargosxCiudads;

	/**
	 * @var        Criteria The criteria used to select the current contents of collPricRecargosxCiudads.
	 */
	private $lastPricRecargosxCiudadCriteria = null;

	/**
	 * @var        array PricRecargosxCiudadLog[] Collection to store aggregation of PricRecargosxCiudadLog objects.
	 */
	protected $collPricRecargosxCiudadLogs;

	/**
	 * @var        Criteria The criteria used to select the current contents of collPricRecargosxCiudadLogs.
	 */
	private $lastPricRecargosxCiudadLogCriteria = null;

	/**
	 * @var        array PricPatio[] Collection to store aggregation of PricPatio objects.
	 */
	protected $collPricPatios;

	/**
	 * @var        Criteria The criteria used to select the current contents of collPricPatios.
	 */
	private $lastPricPatioCriteria = null;

	/**
	 * @var        array Cliente[] Collection to store aggregation of Cliente objects.
	 */
	protected $collClientes;

	/**
	 * @var        Criteria The criteria used to select the current contents of collClientes.
	 */
	private $lastClienteCriteria = null;

	/**
	 * @var        array Agente[] Collection to store aggregation of Agente objects.
	 */
	protected $collAgentes;

	/**
	 * @var        Criteria The criteria used to select the current contents of collAgentes.
	 */
	private $lastAgenteCriteria = null;

	/**
	 * @var        array ContactoAgente[] Collection to store aggregation of ContactoAgente objects.
	 */
	protected $collContactoAgentes;

	/**
	 * @var        Criteria The criteria used to select the current contents of collContactoAgentes.
	 */
	private $lastContactoAgenteCriteria = null;

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
	 * Initializes internal state of BaseCiudad object.
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
	 * Get the [ca_idciudad] column value.
	 * 
	 * @return     string
	 */
	public function getCaIdciudad()
	{
		return $this->ca_idciudad;
	}

	/**
	 * Get the [ca_ciudad] column value.
	 * 
	 * @return     string
	 */
	public function getCaCiudad()
	{
		return $this->ca_ciudad;
	}

	/**
	 * Get the [ca_idtrafico] column value.
	 * 
	 * @return     string
	 */
	public function getCaIdtrafico()
	{
		return $this->ca_idtrafico;
	}

	/**
	 * Get the [ca_puerto] column value.
	 * 
	 * @return     string
	 */
	public function getCaPuerto()
	{
		return $this->ca_puerto;
	}

	/**
	 * Set the value of [ca_idciudad] column.
	 * 
	 * @param      string $v new value
	 * @return     Ciudad The current object (for fluent API support)
	 */
	public function setCaIdciudad($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idciudad !== $v) {
			$this->ca_idciudad = $v;
			$this->modifiedColumns[] = CiudadPeer::CA_IDCIUDAD;
		}

		return $this;
	} // setCaIdciudad()

	/**
	 * Set the value of [ca_ciudad] column.
	 * 
	 * @param      string $v new value
	 * @return     Ciudad The current object (for fluent API support)
	 */
	public function setCaCiudad($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_ciudad !== $v) {
			$this->ca_ciudad = $v;
			$this->modifiedColumns[] = CiudadPeer::CA_CIUDAD;
		}

		return $this;
	} // setCaCiudad()

	/**
	 * Set the value of [ca_idtrafico] column.
	 * 
	 * @param      string $v new value
	 * @return     Ciudad The current object (for fluent API support)
	 */
	public function setCaIdtrafico($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idtrafico !== $v) {
			$this->ca_idtrafico = $v;
			$this->modifiedColumns[] = CiudadPeer::CA_IDTRAFICO;
		}

		if ($this->aTrafico !== null && $this->aTrafico->getCaIdtrafico() !== $v) {
			$this->aTrafico = null;
		}

		return $this;
	} // setCaIdtrafico()

	/**
	 * Set the value of [ca_puerto] column.
	 * 
	 * @param      string $v new value
	 * @return     Ciudad The current object (for fluent API support)
	 */
	public function setCaPuerto($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_puerto !== $v) {
			$this->ca_puerto = $v;
			$this->modifiedColumns[] = CiudadPeer::CA_PUERTO;
		}

		return $this;
	} // setCaPuerto()

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

			$this->ca_idciudad = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ca_ciudad = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_idtrafico = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_puerto = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 4; // 4 = CiudadPeer::NUM_COLUMNS - CiudadPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Ciudad object", $e);
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

		if ($this->aTrafico !== null && $this->ca_idtrafico !== $this->aTrafico->getCaIdtrafico()) {
			$this->aTrafico = null;
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
			$con = Propel::getConnection(CiudadPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = CiudadPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aTrafico = null;
			$this->collPricRecargosxCiudads = null;
			$this->lastPricRecargosxCiudadCriteria = null;

			$this->collPricRecargosxCiudadLogs = null;
			$this->lastPricRecargosxCiudadLogCriteria = null;

			$this->collPricPatios = null;
			$this->lastPricPatioCriteria = null;

			$this->collClientes = null;
			$this->lastClienteCriteria = null;

			$this->collAgentes = null;
			$this->lastAgenteCriteria = null;

			$this->collContactoAgentes = null;
			$this->lastContactoAgenteCriteria = null;

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
			$con = Propel::getConnection(CiudadPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			CiudadPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(CiudadPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			CiudadPeer::addInstanceToPool($this);
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

			if ($this->aTrafico !== null) {
				if ($this->aTrafico->isModified() || $this->aTrafico->isNew()) {
					$affectedRows += $this->aTrafico->save($con);
				}
				$this->setTrafico($this->aTrafico);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = CiudadPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += CiudadPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collPricRecargosxCiudads !== null) {
				foreach ($this->collPricRecargosxCiudads as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPricRecargosxCiudadLogs !== null) {
				foreach ($this->collPricRecargosxCiudadLogs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPricPatios !== null) {
				foreach ($this->collPricPatios as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collClientes !== null) {
				foreach ($this->collClientes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collAgentes !== null) {
				foreach ($this->collAgentes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collContactoAgentes !== null) {
				foreach ($this->collContactoAgentes as $referrerFK) {
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

			if ($this->aTrafico !== null) {
				if (!$this->aTrafico->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTrafico->getValidationFailures());
				}
			}


			if (($retval = CiudadPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collPricRecargosxCiudads !== null) {
					foreach ($this->collPricRecargosxCiudads as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPricRecargosxCiudadLogs !== null) {
					foreach ($this->collPricRecargosxCiudadLogs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPricPatios !== null) {
					foreach ($this->collPricPatios as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collClientes !== null) {
					foreach ($this->collClientes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collAgentes !== null) {
					foreach ($this->collAgentes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collContactoAgentes !== null) {
					foreach ($this->collContactoAgentes as $referrerFK) {
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
		$pos = CiudadPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdciudad();
				break;
			case 1:
				return $this->getCaCiudad();
				break;
			case 2:
				return $this->getCaIdtrafico();
				break;
			case 3:
				return $this->getCaPuerto();
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
		$keys = CiudadPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdciudad(),
			$keys[1] => $this->getCaCiudad(),
			$keys[2] => $this->getCaIdtrafico(),
			$keys[3] => $this->getCaPuerto(),
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
		$pos = CiudadPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdciudad($value);
				break;
			case 1:
				$this->setCaCiudad($value);
				break;
			case 2:
				$this->setCaIdtrafico($value);
				break;
			case 3:
				$this->setCaPuerto($value);
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
		$keys = CiudadPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdciudad($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaCiudad($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaIdtrafico($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaPuerto($arr[$keys[3]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(CiudadPeer::DATABASE_NAME);

		if ($this->isColumnModified(CiudadPeer::CA_IDCIUDAD)) $criteria->add(CiudadPeer::CA_IDCIUDAD, $this->ca_idciudad);
		if ($this->isColumnModified(CiudadPeer::CA_CIUDAD)) $criteria->add(CiudadPeer::CA_CIUDAD, $this->ca_ciudad);
		if ($this->isColumnModified(CiudadPeer::CA_IDTRAFICO)) $criteria->add(CiudadPeer::CA_IDTRAFICO, $this->ca_idtrafico);
		if ($this->isColumnModified(CiudadPeer::CA_PUERTO)) $criteria->add(CiudadPeer::CA_PUERTO, $this->ca_puerto);

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
		$criteria = new Criteria(CiudadPeer::DATABASE_NAME);

		$criteria->add(CiudadPeer::CA_IDCIUDAD, $this->ca_idciudad);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     string
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdciudad();
	}

	/**
	 * Generic method to set the primary key (ca_idciudad column).
	 *
	 * @param      string $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdciudad($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Ciudad (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdciudad($this->ca_idciudad);

		$copyObj->setCaCiudad($this->ca_ciudad);

		$copyObj->setCaIdtrafico($this->ca_idtrafico);

		$copyObj->setCaPuerto($this->ca_puerto);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getPricRecargosxCiudads() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addPricRecargosxCiudad($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getPricRecargosxCiudadLogs() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addPricRecargosxCiudadLog($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getPricPatios() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addPricPatio($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getClientes() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addCliente($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getAgentes() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addAgente($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getContactoAgentes() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addContactoAgente($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

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
	 * @return     Ciudad Clone of current object.
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
	 * @return     CiudadPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new CiudadPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Trafico object.
	 *
	 * @param      Trafico $v
	 * @return     Ciudad The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setTrafico(Trafico $v = null)
	{
		if ($v === null) {
			$this->setCaIdtrafico(NULL);
		} else {
			$this->setCaIdtrafico($v->getCaIdtrafico());
		}

		$this->aTrafico = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Trafico object, it will not be re-added.
		if ($v !== null) {
			$v->addCiudad($this);
		}

		return $this;
	}


	/**
	 * Get the associated Trafico object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Trafico The associated Trafico object.
	 * @throws     PropelException
	 */
	public function getTrafico(PropelPDO $con = null)
	{
		if ($this->aTrafico === null && (($this->ca_idtrafico !== "" && $this->ca_idtrafico !== null))) {
			$c = new Criteria(TraficoPeer::DATABASE_NAME);
			$c->add(TraficoPeer::CA_IDTRAFICO, $this->ca_idtrafico);
			$this->aTrafico = TraficoPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aTrafico->addCiudads($this);
			 */
		}
		return $this->aTrafico;
	}

	/**
	 * Clears out the collPricRecargosxCiudads collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addPricRecargosxCiudads()
	 */
	public function clearPricRecargosxCiudads()
	{
		$this->collPricRecargosxCiudads = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collPricRecargosxCiudads collection (array).
	 *
	 * By default this just sets the collPricRecargosxCiudads collection to an empty array (like clearcollPricRecargosxCiudads());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initPricRecargosxCiudads()
	{
		$this->collPricRecargosxCiudads = array();
	}

	/**
	 * Gets an array of PricRecargosxCiudad objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Ciudad has previously been saved, it will retrieve
	 * related PricRecargosxCiudads from storage. If this Ciudad is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array PricRecargosxCiudad[]
	 * @throws     PropelException
	 */
	public function getPricRecargosxCiudads($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CiudadPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxCiudads === null) {
			if ($this->isNew()) {
			   $this->collPricRecargosxCiudads = array();
			} else {

				$criteria->add(PricRecargosxCiudadPeer::CA_IDCIUDAD, $this->ca_idciudad);

				PricRecargosxCiudadPeer::addSelectColumns($criteria);
				$this->collPricRecargosxCiudads = PricRecargosxCiudadPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PricRecargosxCiudadPeer::CA_IDCIUDAD, $this->ca_idciudad);

				PricRecargosxCiudadPeer::addSelectColumns($criteria);
				if (!isset($this->lastPricRecargosxCiudadCriteria) || !$this->lastPricRecargosxCiudadCriteria->equals($criteria)) {
					$this->collPricRecargosxCiudads = PricRecargosxCiudadPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPricRecargosxCiudadCriteria = $criteria;
		return $this->collPricRecargosxCiudads;
	}

	/**
	 * Returns the number of related PricRecargosxCiudad objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related PricRecargosxCiudad objects.
	 * @throws     PropelException
	 */
	public function countPricRecargosxCiudads(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CiudadPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collPricRecargosxCiudads === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PricRecargosxCiudadPeer::CA_IDCIUDAD, $this->ca_idciudad);

				$count = PricRecargosxCiudadPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(PricRecargosxCiudadPeer::CA_IDCIUDAD, $this->ca_idciudad);

				if (!isset($this->lastPricRecargosxCiudadCriteria) || !$this->lastPricRecargosxCiudadCriteria->equals($criteria)) {
					$count = PricRecargosxCiudadPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPricRecargosxCiudads);
				}
			} else {
				$count = count($this->collPricRecargosxCiudads);
			}
		}
		$this->lastPricRecargosxCiudadCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a PricRecargosxCiudad object to this object
	 * through the PricRecargosxCiudad foreign key attribute.
	 *
	 * @param      PricRecargosxCiudad $l PricRecargosxCiudad
	 * @return     void
	 * @throws     PropelException
	 */
	public function addPricRecargosxCiudad(PricRecargosxCiudad $l)
	{
		if ($this->collPricRecargosxCiudads === null) {
			$this->initPricRecargosxCiudads();
		}
		if (!in_array($l, $this->collPricRecargosxCiudads, true)) { // only add it if the **same** object is not already associated
			array_push($this->collPricRecargosxCiudads, $l);
			$l->setCiudad($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Ciudad is new, it will return
	 * an empty collection; or if this Ciudad has previously
	 * been saved, it will retrieve related PricRecargosxCiudads from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Ciudad.
	 */
	public function getPricRecargosxCiudadsJoinTipoRecargo($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CiudadPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxCiudads === null) {
			if ($this->isNew()) {
				$this->collPricRecargosxCiudads = array();
			} else {

				$criteria->add(PricRecargosxCiudadPeer::CA_IDCIUDAD, $this->ca_idciudad);

				$this->collPricRecargosxCiudads = PricRecargosxCiudadPeer::doSelectJoinTipoRecargo($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PricRecargosxCiudadPeer::CA_IDCIUDAD, $this->ca_idciudad);

			if (!isset($this->lastPricRecargosxCiudadCriteria) || !$this->lastPricRecargosxCiudadCriteria->equals($criteria)) {
				$this->collPricRecargosxCiudads = PricRecargosxCiudadPeer::doSelectJoinTipoRecargo($criteria, $con, $join_behavior);
			}
		}
		$this->lastPricRecargosxCiudadCriteria = $criteria;

		return $this->collPricRecargosxCiudads;
	}

	/**
	 * Clears out the collPricRecargosxCiudadLogs collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addPricRecargosxCiudadLogs()
	 */
	public function clearPricRecargosxCiudadLogs()
	{
		$this->collPricRecargosxCiudadLogs = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collPricRecargosxCiudadLogs collection (array).
	 *
	 * By default this just sets the collPricRecargosxCiudadLogs collection to an empty array (like clearcollPricRecargosxCiudadLogs());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initPricRecargosxCiudadLogs()
	{
		$this->collPricRecargosxCiudadLogs = array();
	}

	/**
	 * Gets an array of PricRecargosxCiudadLog objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Ciudad has previously been saved, it will retrieve
	 * related PricRecargosxCiudadLogs from storage. If this Ciudad is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array PricRecargosxCiudadLog[]
	 * @throws     PropelException
	 */
	public function getPricRecargosxCiudadLogs($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CiudadPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxCiudadLogs === null) {
			if ($this->isNew()) {
			   $this->collPricRecargosxCiudadLogs = array();
			} else {

				$criteria->add(PricRecargosxCiudadLogPeer::CA_IDCIUDAD, $this->ca_idciudad);

				PricRecargosxCiudadLogPeer::addSelectColumns($criteria);
				$this->collPricRecargosxCiudadLogs = PricRecargosxCiudadLogPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PricRecargosxCiudadLogPeer::CA_IDCIUDAD, $this->ca_idciudad);

				PricRecargosxCiudadLogPeer::addSelectColumns($criteria);
				if (!isset($this->lastPricRecargosxCiudadLogCriteria) || !$this->lastPricRecargosxCiudadLogCriteria->equals($criteria)) {
					$this->collPricRecargosxCiudadLogs = PricRecargosxCiudadLogPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPricRecargosxCiudadLogCriteria = $criteria;
		return $this->collPricRecargosxCiudadLogs;
	}

	/**
	 * Returns the number of related PricRecargosxCiudadLog objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related PricRecargosxCiudadLog objects.
	 * @throws     PropelException
	 */
	public function countPricRecargosxCiudadLogs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CiudadPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collPricRecargosxCiudadLogs === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PricRecargosxCiudadLogPeer::CA_IDCIUDAD, $this->ca_idciudad);

				$count = PricRecargosxCiudadLogPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(PricRecargosxCiudadLogPeer::CA_IDCIUDAD, $this->ca_idciudad);

				if (!isset($this->lastPricRecargosxCiudadLogCriteria) || !$this->lastPricRecargosxCiudadLogCriteria->equals($criteria)) {
					$count = PricRecargosxCiudadLogPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPricRecargosxCiudadLogs);
				}
			} else {
				$count = count($this->collPricRecargosxCiudadLogs);
			}
		}
		$this->lastPricRecargosxCiudadLogCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a PricRecargosxCiudadLog object to this object
	 * through the PricRecargosxCiudadLog foreign key attribute.
	 *
	 * @param      PricRecargosxCiudadLog $l PricRecargosxCiudadLog
	 * @return     void
	 * @throws     PropelException
	 */
	public function addPricRecargosxCiudadLog(PricRecargosxCiudadLog $l)
	{
		if ($this->collPricRecargosxCiudadLogs === null) {
			$this->initPricRecargosxCiudadLogs();
		}
		if (!in_array($l, $this->collPricRecargosxCiudadLogs, true)) { // only add it if the **same** object is not already associated
			array_push($this->collPricRecargosxCiudadLogs, $l);
			$l->setCiudad($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Ciudad is new, it will return
	 * an empty collection; or if this Ciudad has previously
	 * been saved, it will retrieve related PricRecargosxCiudadLogs from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Ciudad.
	 */
	public function getPricRecargosxCiudadLogsJoinTipoRecargo($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CiudadPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxCiudadLogs === null) {
			if ($this->isNew()) {
				$this->collPricRecargosxCiudadLogs = array();
			} else {

				$criteria->add(PricRecargosxCiudadLogPeer::CA_IDCIUDAD, $this->ca_idciudad);

				$this->collPricRecargosxCiudadLogs = PricRecargosxCiudadLogPeer::doSelectJoinTipoRecargo($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PricRecargosxCiudadLogPeer::CA_IDCIUDAD, $this->ca_idciudad);

			if (!isset($this->lastPricRecargosxCiudadLogCriteria) || !$this->lastPricRecargosxCiudadLogCriteria->equals($criteria)) {
				$this->collPricRecargosxCiudadLogs = PricRecargosxCiudadLogPeer::doSelectJoinTipoRecargo($criteria, $con, $join_behavior);
			}
		}
		$this->lastPricRecargosxCiudadLogCriteria = $criteria;

		return $this->collPricRecargosxCiudadLogs;
	}

	/**
	 * Clears out the collPricPatios collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addPricPatios()
	 */
	public function clearPricPatios()
	{
		$this->collPricPatios = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collPricPatios collection (array).
	 *
	 * By default this just sets the collPricPatios collection to an empty array (like clearcollPricPatios());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initPricPatios()
	{
		$this->collPricPatios = array();
	}

	/**
	 * Gets an array of PricPatio objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Ciudad has previously been saved, it will retrieve
	 * related PricPatios from storage. If this Ciudad is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array PricPatio[]
	 * @throws     PropelException
	 */
	public function getPricPatios($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CiudadPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricPatios === null) {
			if ($this->isNew()) {
			   $this->collPricPatios = array();
			} else {

				$criteria->add(PricPatioPeer::CA_IDCIUDAD, $this->ca_idciudad);

				PricPatioPeer::addSelectColumns($criteria);
				$this->collPricPatios = PricPatioPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PricPatioPeer::CA_IDCIUDAD, $this->ca_idciudad);

				PricPatioPeer::addSelectColumns($criteria);
				if (!isset($this->lastPricPatioCriteria) || !$this->lastPricPatioCriteria->equals($criteria)) {
					$this->collPricPatios = PricPatioPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPricPatioCriteria = $criteria;
		return $this->collPricPatios;
	}

	/**
	 * Returns the number of related PricPatio objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related PricPatio objects.
	 * @throws     PropelException
	 */
	public function countPricPatios(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CiudadPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collPricPatios === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PricPatioPeer::CA_IDCIUDAD, $this->ca_idciudad);

				$count = PricPatioPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(PricPatioPeer::CA_IDCIUDAD, $this->ca_idciudad);

				if (!isset($this->lastPricPatioCriteria) || !$this->lastPricPatioCriteria->equals($criteria)) {
					$count = PricPatioPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPricPatios);
				}
			} else {
				$count = count($this->collPricPatios);
			}
		}
		$this->lastPricPatioCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a PricPatio object to this object
	 * through the PricPatio foreign key attribute.
	 *
	 * @param      PricPatio $l PricPatio
	 * @return     void
	 * @throws     PropelException
	 */
	public function addPricPatio(PricPatio $l)
	{
		if ($this->collPricPatios === null) {
			$this->initPricPatios();
		}
		if (!in_array($l, $this->collPricPatios, true)) { // only add it if the **same** object is not already associated
			array_push($this->collPricPatios, $l);
			$l->setCiudad($this);
		}
	}

	/**
	 * Clears out the collClientes collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addClientes()
	 */
	public function clearClientes()
	{
		$this->collClientes = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collClientes collection (array).
	 *
	 * By default this just sets the collClientes collection to an empty array (like clearcollClientes());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initClientes()
	{
		$this->collClientes = array();
	}

	/**
	 * Gets an array of Cliente objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Ciudad has previously been saved, it will retrieve
	 * related Clientes from storage. If this Ciudad is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array Cliente[]
	 * @throws     PropelException
	 */
	public function getClientes($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CiudadPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collClientes === null) {
			if ($this->isNew()) {
			   $this->collClientes = array();
			} else {

				$criteria->add(ClientePeer::CA_IDCIUDAD, $this->ca_idciudad);

				ClientePeer::addSelectColumns($criteria);
				$this->collClientes = ClientePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ClientePeer::CA_IDCIUDAD, $this->ca_idciudad);

				ClientePeer::addSelectColumns($criteria);
				if (!isset($this->lastClienteCriteria) || !$this->lastClienteCriteria->equals($criteria)) {
					$this->collClientes = ClientePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastClienteCriteria = $criteria;
		return $this->collClientes;
	}

	/**
	 * Returns the number of related Cliente objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Cliente objects.
	 * @throws     PropelException
	 */
	public function countClientes(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CiudadPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collClientes === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(ClientePeer::CA_IDCIUDAD, $this->ca_idciudad);

				$count = ClientePeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(ClientePeer::CA_IDCIUDAD, $this->ca_idciudad);

				if (!isset($this->lastClienteCriteria) || !$this->lastClienteCriteria->equals($criteria)) {
					$count = ClientePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collClientes);
				}
			} else {
				$count = count($this->collClientes);
			}
		}
		$this->lastClienteCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a Cliente object to this object
	 * through the Cliente foreign key attribute.
	 *
	 * @param      Cliente $l Cliente
	 * @return     void
	 * @throws     PropelException
	 */
	public function addCliente(Cliente $l)
	{
		if ($this->collClientes === null) {
			$this->initClientes();
		}
		if (!in_array($l, $this->collClientes, true)) { // only add it if the **same** object is not already associated
			array_push($this->collClientes, $l);
			$l->setCiudad($this);
		}
	}

	/**
	 * Clears out the collAgentes collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addAgentes()
	 */
	public function clearAgentes()
	{
		$this->collAgentes = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collAgentes collection (array).
	 *
	 * By default this just sets the collAgentes collection to an empty array (like clearcollAgentes());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initAgentes()
	{
		$this->collAgentes = array();
	}

	/**
	 * Gets an array of Agente objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Ciudad has previously been saved, it will retrieve
	 * related Agentes from storage. If this Ciudad is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array Agente[]
	 * @throws     PropelException
	 */
	public function getAgentes($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CiudadPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAgentes === null) {
			if ($this->isNew()) {
			   $this->collAgentes = array();
			} else {

				$criteria->add(AgentePeer::CA_IDCIUDAD, $this->ca_idciudad);

				AgentePeer::addSelectColumns($criteria);
				$this->collAgentes = AgentePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(AgentePeer::CA_IDCIUDAD, $this->ca_idciudad);

				AgentePeer::addSelectColumns($criteria);
				if (!isset($this->lastAgenteCriteria) || !$this->lastAgenteCriteria->equals($criteria)) {
					$this->collAgentes = AgentePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAgenteCriteria = $criteria;
		return $this->collAgentes;
	}

	/**
	 * Returns the number of related Agente objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Agente objects.
	 * @throws     PropelException
	 */
	public function countAgentes(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CiudadPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collAgentes === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(AgentePeer::CA_IDCIUDAD, $this->ca_idciudad);

				$count = AgentePeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(AgentePeer::CA_IDCIUDAD, $this->ca_idciudad);

				if (!isset($this->lastAgenteCriteria) || !$this->lastAgenteCriteria->equals($criteria)) {
					$count = AgentePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collAgentes);
				}
			} else {
				$count = count($this->collAgentes);
			}
		}
		$this->lastAgenteCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a Agente object to this object
	 * through the Agente foreign key attribute.
	 *
	 * @param      Agente $l Agente
	 * @return     void
	 * @throws     PropelException
	 */
	public function addAgente(Agente $l)
	{
		if ($this->collAgentes === null) {
			$this->initAgentes();
		}
		if (!in_array($l, $this->collAgentes, true)) { // only add it if the **same** object is not already associated
			array_push($this->collAgentes, $l);
			$l->setCiudad($this);
		}
	}

	/**
	 * Clears out the collContactoAgentes collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addContactoAgentes()
	 */
	public function clearContactoAgentes()
	{
		$this->collContactoAgentes = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collContactoAgentes collection (array).
	 *
	 * By default this just sets the collContactoAgentes collection to an empty array (like clearcollContactoAgentes());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initContactoAgentes()
	{
		$this->collContactoAgentes = array();
	}

	/**
	 * Gets an array of ContactoAgente objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Ciudad has previously been saved, it will retrieve
	 * related ContactoAgentes from storage. If this Ciudad is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array ContactoAgente[]
	 * @throws     PropelException
	 */
	public function getContactoAgentes($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CiudadPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collContactoAgentes === null) {
			if ($this->isNew()) {
			   $this->collContactoAgentes = array();
			} else {

				$criteria->add(ContactoAgentePeer::CA_IDCIUDAD, $this->ca_idciudad);

				ContactoAgentePeer::addSelectColumns($criteria);
				$this->collContactoAgentes = ContactoAgentePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ContactoAgentePeer::CA_IDCIUDAD, $this->ca_idciudad);

				ContactoAgentePeer::addSelectColumns($criteria);
				if (!isset($this->lastContactoAgenteCriteria) || !$this->lastContactoAgenteCriteria->equals($criteria)) {
					$this->collContactoAgentes = ContactoAgentePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastContactoAgenteCriteria = $criteria;
		return $this->collContactoAgentes;
	}

	/**
	 * Returns the number of related ContactoAgente objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related ContactoAgente objects.
	 * @throws     PropelException
	 */
	public function countContactoAgentes(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CiudadPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collContactoAgentes === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(ContactoAgentePeer::CA_IDCIUDAD, $this->ca_idciudad);

				$count = ContactoAgentePeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(ContactoAgentePeer::CA_IDCIUDAD, $this->ca_idciudad);

				if (!isset($this->lastContactoAgenteCriteria) || !$this->lastContactoAgenteCriteria->equals($criteria)) {
					$count = ContactoAgentePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collContactoAgentes);
				}
			} else {
				$count = count($this->collContactoAgentes);
			}
		}
		$this->lastContactoAgenteCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a ContactoAgente object to this object
	 * through the ContactoAgente foreign key attribute.
	 *
	 * @param      ContactoAgente $l ContactoAgente
	 * @return     void
	 * @throws     PropelException
	 */
	public function addContactoAgente(ContactoAgente $l)
	{
		if ($this->collContactoAgentes === null) {
			$this->initContactoAgentes();
		}
		if (!in_array($l, $this->collContactoAgentes, true)) { // only add it if the **same** object is not already associated
			array_push($this->collContactoAgentes, $l);
			$l->setCiudad($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Ciudad is new, it will return
	 * an empty collection; or if this Ciudad has previously
	 * been saved, it will retrieve related ContactoAgentes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Ciudad.
	 */
	public function getContactoAgentesJoinAgente($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CiudadPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collContactoAgentes === null) {
			if ($this->isNew()) {
				$this->collContactoAgentes = array();
			} else {

				$criteria->add(ContactoAgentePeer::CA_IDCIUDAD, $this->ca_idciudad);

				$this->collContactoAgentes = ContactoAgentePeer::doSelectJoinAgente($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ContactoAgentePeer::CA_IDCIUDAD, $this->ca_idciudad);

			if (!isset($this->lastContactoAgenteCriteria) || !$this->lastContactoAgenteCriteria->equals($criteria)) {
				$this->collContactoAgentes = ContactoAgentePeer::doSelectJoinAgente($criteria, $con, $join_behavior);
			}
		}
		$this->lastContactoAgenteCriteria = $criteria;

		return $this->collContactoAgentes;
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
			if ($this->collPricRecargosxCiudads) {
				foreach ((array) $this->collPricRecargosxCiudads as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collPricRecargosxCiudadLogs) {
				foreach ((array) $this->collPricRecargosxCiudadLogs as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collPricPatios) {
				foreach ((array) $this->collPricPatios as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collClientes) {
				foreach ((array) $this->collClientes as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collAgentes) {
				foreach ((array) $this->collAgentes as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collContactoAgentes) {
				foreach ((array) $this->collContactoAgentes as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collPricRecargosxCiudads = null;
		$this->collPricRecargosxCiudadLogs = null;
		$this->collPricPatios = null;
		$this->collClientes = null;
		$this->collAgentes = null;
		$this->collContactoAgentes = null;
			$this->aTrafico = null;
	}

} // BaseCiudad
