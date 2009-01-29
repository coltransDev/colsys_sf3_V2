<?php

/**
 * Base class that represents a row from the 'tb_costos' table.
 *
 * 
 *
 * @package    lib.model.public.om
 */
abstract class BaseCosto extends BaseObject  implements Persistent {


  const PEER = 'CostoPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        CostoPeer
	 */
	protected static $peer;

	/**
	 * The value for the ca_idcosto field.
	 * @var        int
	 */
	protected $ca_idcosto;

	/**
	 * The value for the ca_costo field.
	 * @var        string
	 */
	protected $ca_costo;

	/**
	 * The value for the ca_transporte field.
	 * @var        string
	 */
	protected $ca_transporte;

	/**
	 * The value for the ca_impoexpo field.
	 * @var        string
	 */
	protected $ca_impoexpo;

	/**
	 * The value for the ca_modalidad field.
	 * @var        string
	 */
	protected $ca_modalidad;

	/**
	 * The value for the ca_comisionable field.
	 * @var        string
	 */
	protected $ca_comisionable;

	/**
	 * @var        array RepCosto[] Collection to store aggregation of RepCosto objects.
	 */
	protected $collRepCostos;

	/**
	 * @var        Criteria The criteria used to select the current contents of collRepCostos.
	 */
	private $lastRepCostoCriteria = null;

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
	 * Initializes internal state of BaseCosto object.
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
	 * Get the [ca_idcosto] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdcosto()
	{
		return $this->ca_idcosto;
	}

	/**
	 * Get the [ca_costo] column value.
	 * 
	 * @return     string
	 */
	public function getCaCosto()
	{
		return $this->ca_costo;
	}

	/**
	 * Get the [ca_transporte] column value.
	 * 
	 * @return     string
	 */
	public function getCaTransporte()
	{
		return $this->ca_transporte;
	}

	/**
	 * Get the [ca_impoexpo] column value.
	 * 
	 * @return     string
	 */
	public function getCaImpoexpo()
	{
		return $this->ca_impoexpo;
	}

	/**
	 * Get the [ca_modalidad] column value.
	 * 
	 * @return     string
	 */
	public function getCaModalidad()
	{
		return $this->ca_modalidad;
	}

	/**
	 * Get the [ca_comisionable] column value.
	 * 
	 * @return     string
	 */
	public function getCaComisionable()
	{
		return $this->ca_comisionable;
	}

	/**
	 * Set the value of [ca_idcosto] column.
	 * 
	 * @param      int $v new value
	 * @return     Costo The current object (for fluent API support)
	 */
	public function setCaIdcosto($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idcosto !== $v) {
			$this->ca_idcosto = $v;
			$this->modifiedColumns[] = CostoPeer::CA_IDCOSTO;
		}

		return $this;
	} // setCaIdcosto()

	/**
	 * Set the value of [ca_costo] column.
	 * 
	 * @param      string $v new value
	 * @return     Costo The current object (for fluent API support)
	 */
	public function setCaCosto($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_costo !== $v) {
			$this->ca_costo = $v;
			$this->modifiedColumns[] = CostoPeer::CA_COSTO;
		}

		return $this;
	} // setCaCosto()

	/**
	 * Set the value of [ca_transporte] column.
	 * 
	 * @param      string $v new value
	 * @return     Costo The current object (for fluent API support)
	 */
	public function setCaTransporte($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_transporte !== $v) {
			$this->ca_transporte = $v;
			$this->modifiedColumns[] = CostoPeer::CA_TRANSPORTE;
		}

		return $this;
	} // setCaTransporte()

	/**
	 * Set the value of [ca_impoexpo] column.
	 * 
	 * @param      string $v new value
	 * @return     Costo The current object (for fluent API support)
	 */
	public function setCaImpoexpo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_impoexpo !== $v) {
			$this->ca_impoexpo = $v;
			$this->modifiedColumns[] = CostoPeer::CA_IMPOEXPO;
		}

		return $this;
	} // setCaImpoexpo()

	/**
	 * Set the value of [ca_modalidad] column.
	 * 
	 * @param      string $v new value
	 * @return     Costo The current object (for fluent API support)
	 */
	public function setCaModalidad($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_modalidad !== $v) {
			$this->ca_modalidad = $v;
			$this->modifiedColumns[] = CostoPeer::CA_MODALIDAD;
		}

		return $this;
	} // setCaModalidad()

	/**
	 * Set the value of [ca_comisionable] column.
	 * 
	 * @param      string $v new value
	 * @return     Costo The current object (for fluent API support)
	 */
	public function setCaComisionable($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_comisionable !== $v) {
			$this->ca_comisionable = $v;
			$this->modifiedColumns[] = CostoPeer::CA_COMISIONABLE;
		}

		return $this;
	} // setCaComisionable()

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

			$this->ca_idcosto = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_costo = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_transporte = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_impoexpo = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_modalidad = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_comisionable = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 6; // 6 = CostoPeer::NUM_COLUMNS - CostoPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Costo object", $e);
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
			$con = Propel::getConnection(CostoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = CostoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->collRepCostos = null;
			$this->lastRepCostoCriteria = null;

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
			$con = Propel::getConnection(CostoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			CostoPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(CostoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			CostoPeer::addInstanceToPool($this);
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
				$this->modifiedColumns[] = CostoPeer::CA_IDCOSTO;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = CostoPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setCaIdcosto($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += CostoPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collRepCostos !== null) {
				foreach ($this->collRepCostos as $referrerFK) {
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


			if (($retval = CostoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collRepCostos !== null) {
					foreach ($this->collRepCostos as $referrerFK) {
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
		$pos = CostoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdcosto();
				break;
			case 1:
				return $this->getCaCosto();
				break;
			case 2:
				return $this->getCaTransporte();
				break;
			case 3:
				return $this->getCaImpoexpo();
				break;
			case 4:
				return $this->getCaModalidad();
				break;
			case 5:
				return $this->getCaComisionable();
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
		$keys = CostoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdcosto(),
			$keys[1] => $this->getCaCosto(),
			$keys[2] => $this->getCaTransporte(),
			$keys[3] => $this->getCaImpoexpo(),
			$keys[4] => $this->getCaModalidad(),
			$keys[5] => $this->getCaComisionable(),
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
		$pos = CostoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdcosto($value);
				break;
			case 1:
				$this->setCaCosto($value);
				break;
			case 2:
				$this->setCaTransporte($value);
				break;
			case 3:
				$this->setCaImpoexpo($value);
				break;
			case 4:
				$this->setCaModalidad($value);
				break;
			case 5:
				$this->setCaComisionable($value);
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
		$keys = CostoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdcosto($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaCosto($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaTransporte($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaImpoexpo($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaModalidad($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaComisionable($arr[$keys[5]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(CostoPeer::DATABASE_NAME);

		if ($this->isColumnModified(CostoPeer::CA_IDCOSTO)) $criteria->add(CostoPeer::CA_IDCOSTO, $this->ca_idcosto);
		if ($this->isColumnModified(CostoPeer::CA_COSTO)) $criteria->add(CostoPeer::CA_COSTO, $this->ca_costo);
		if ($this->isColumnModified(CostoPeer::CA_TRANSPORTE)) $criteria->add(CostoPeer::CA_TRANSPORTE, $this->ca_transporte);
		if ($this->isColumnModified(CostoPeer::CA_IMPOEXPO)) $criteria->add(CostoPeer::CA_IMPOEXPO, $this->ca_impoexpo);
		if ($this->isColumnModified(CostoPeer::CA_MODALIDAD)) $criteria->add(CostoPeer::CA_MODALIDAD, $this->ca_modalidad);
		if ($this->isColumnModified(CostoPeer::CA_COMISIONABLE)) $criteria->add(CostoPeer::CA_COMISIONABLE, $this->ca_comisionable);

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
		$criteria = new Criteria(CostoPeer::DATABASE_NAME);

		$criteria->add(CostoPeer::CA_IDCOSTO, $this->ca_idcosto);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdcosto();
	}

	/**
	 * Generic method to set the primary key (ca_idcosto column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdcosto($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Costo (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaCosto($this->ca_costo);

		$copyObj->setCaTransporte($this->ca_transporte);

		$copyObj->setCaImpoexpo($this->ca_impoexpo);

		$copyObj->setCaModalidad($this->ca_modalidad);

		$copyObj->setCaComisionable($this->ca_comisionable);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getRepCostos() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addRepCosto($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setCaIdcosto(NULL); // this is a auto-increment column, so set to default value

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
	 * @return     Costo Clone of current object.
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
	 * @return     CostoPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new CostoPeer();
		}
		return self::$peer;
	}

	/**
	 * Clears out the collRepCostos collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addRepCostos()
	 */
	public function clearRepCostos()
	{
		$this->collRepCostos = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collRepCostos collection (array).
	 *
	 * By default this just sets the collRepCostos collection to an empty array (like clearcollRepCostos());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initRepCostos()
	{
		$this->collRepCostos = array();
	}

	/**
	 * Gets an array of RepCosto objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Costo has previously been saved, it will retrieve
	 * related RepCostos from storage. If this Costo is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array RepCosto[]
	 * @throws     PropelException
	 */
	public function getRepCostos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CostoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepCostos === null) {
			if ($this->isNew()) {
			   $this->collRepCostos = array();
			} else {

				$criteria->add(RepCostoPeer::CA_IDCOSTO, $this->ca_idcosto);

				RepCostoPeer::addSelectColumns($criteria);
				$this->collRepCostos = RepCostoPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RepCostoPeer::CA_IDCOSTO, $this->ca_idcosto);

				RepCostoPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepCostoCriteria) || !$this->lastRepCostoCriteria->equals($criteria)) {
					$this->collRepCostos = RepCostoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepCostoCriteria = $criteria;
		return $this->collRepCostos;
	}

	/**
	 * Returns the number of related RepCosto objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related RepCosto objects.
	 * @throws     PropelException
	 */
	public function countRepCostos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CostoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collRepCostos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(RepCostoPeer::CA_IDCOSTO, $this->ca_idcosto);

				$count = RepCostoPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(RepCostoPeer::CA_IDCOSTO, $this->ca_idcosto);

				if (!isset($this->lastRepCostoCriteria) || !$this->lastRepCostoCriteria->equals($criteria)) {
					$count = RepCostoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collRepCostos);
				}
			} else {
				$count = count($this->collRepCostos);
			}
		}
		$this->lastRepCostoCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a RepCosto object to this object
	 * through the RepCosto foreign key attribute.
	 *
	 * @param      RepCosto $l RepCosto
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRepCosto(RepCosto $l)
	{
		if ($this->collRepCostos === null) {
			$this->initRepCostos();
		}
		if (!in_array($l, $this->collRepCostos, true)) { // only add it if the **same** object is not already associated
			array_push($this->collRepCostos, $l);
			$l->setCosto($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Costo is new, it will return
	 * an empty collection; or if this Costo has previously
	 * been saved, it will retrieve related RepCostos from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Costo.
	 */
	public function getRepCostosJoinReporte($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CostoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepCostos === null) {
			if ($this->isNew()) {
				$this->collRepCostos = array();
			} else {

				$criteria->add(RepCostoPeer::CA_IDCOSTO, $this->ca_idcosto);

				$this->collRepCostos = RepCostoPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RepCostoPeer::CA_IDCOSTO, $this->ca_idcosto);

			if (!isset($this->lastRepCostoCriteria) || !$this->lastRepCostoCriteria->equals($criteria)) {
				$this->collRepCostos = RepCostoPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		}
		$this->lastRepCostoCriteria = $criteria;

		return $this->collRepCostos;
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
			if ($this->collRepCostos) {
				foreach ((array) $this->collRepCostos as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collRepCostos = null;
	}

} // BaseCosto
