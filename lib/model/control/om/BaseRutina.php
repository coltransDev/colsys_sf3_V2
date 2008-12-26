<?php

/**
 * Base class that represents a row from the 'control.tb_rutinas' table.
 *
 * 
 *
 * @package    lib.model.control.om
 */
abstract class BaseRutina extends BaseObject  implements Persistent {


  const PEER = 'RutinaPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        RutinaPeer
	 */
	protected static $peer;

	/**
	 * The value for the ca_rutina field.
	 * @var        string
	 */
	protected $ca_rutina;

	/**
	 * The value for the ca_opcion field.
	 * @var        string
	 */
	protected $ca_opcion;

	/**
	 * The value for the ca_descripcion field.
	 * @var        string
	 */
	protected $ca_descripcion;

	/**
	 * The value for the ca_programa field.
	 * @var        string
	 */
	protected $ca_programa;

	/**
	 * The value for the ca_grupo field.
	 * @var        string
	 */
	protected $ca_grupo;

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
	 * Initializes internal state of BaseRutina object.
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
	 * Get the [ca_rutina] column value.
	 * 
	 * @return     string
	 */
	public function getCaRutina()
	{
		return $this->ca_rutina;
	}

	/**
	 * Get the [ca_opcion] column value.
	 * 
	 * @return     string
	 */
	public function getCaOpcion()
	{
		return $this->ca_opcion;
	}

	/**
	 * Get the [ca_descripcion] column value.
	 * 
	 * @return     string
	 */
	public function getCaDescripcion()
	{
		return $this->ca_descripcion;
	}

	/**
	 * Get the [ca_programa] column value.
	 * 
	 * @return     string
	 */
	public function getCaPrograma()
	{
		return $this->ca_programa;
	}

	/**
	 * Get the [ca_grupo] column value.
	 * 
	 * @return     string
	 */
	public function getCaGrupo()
	{
		return $this->ca_grupo;
	}

	/**
	 * Set the value of [ca_rutina] column.
	 * 
	 * @param      string $v new value
	 * @return     Rutina The current object (for fluent API support)
	 */
	public function setCaRutina($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_rutina !== $v) {
			$this->ca_rutina = $v;
			$this->modifiedColumns[] = RutinaPeer::CA_RUTINA;
		}

		return $this;
	} // setCaRutina()

	/**
	 * Set the value of [ca_opcion] column.
	 * 
	 * @param      string $v new value
	 * @return     Rutina The current object (for fluent API support)
	 */
	public function setCaOpcion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_opcion !== $v) {
			$this->ca_opcion = $v;
			$this->modifiedColumns[] = RutinaPeer::CA_OPCION;
		}

		return $this;
	} // setCaOpcion()

	/**
	 * Set the value of [ca_descripcion] column.
	 * 
	 * @param      string $v new value
	 * @return     Rutina The current object (for fluent API support)
	 */
	public function setCaDescripcion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_descripcion !== $v) {
			$this->ca_descripcion = $v;
			$this->modifiedColumns[] = RutinaPeer::CA_DESCRIPCION;
		}

		return $this;
	} // setCaDescripcion()

	/**
	 * Set the value of [ca_programa] column.
	 * 
	 * @param      string $v new value
	 * @return     Rutina The current object (for fluent API support)
	 */
	public function setCaPrograma($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_programa !== $v) {
			$this->ca_programa = $v;
			$this->modifiedColumns[] = RutinaPeer::CA_PROGRAMA;
		}

		return $this;
	} // setCaPrograma()

	/**
	 * Set the value of [ca_grupo] column.
	 * 
	 * @param      string $v new value
	 * @return     Rutina The current object (for fluent API support)
	 */
	public function setCaGrupo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_grupo !== $v) {
			$this->ca_grupo = $v;
			$this->modifiedColumns[] = RutinaPeer::CA_GRUPO;
		}

		return $this;
	} // setCaGrupo()

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

			$this->ca_rutina = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ca_opcion = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_descripcion = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_programa = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_grupo = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 5; // 5 = RutinaPeer::NUM_COLUMNS - RutinaPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Rutina object", $e);
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
			$con = Propel::getConnection(RutinaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = RutinaPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

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
			$con = Propel::getConnection(RutinaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			RutinaPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(RutinaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			RutinaPeer::addInstanceToPool($this);
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


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = RutinaPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += RutinaPeer::doUpdate($this, $con);
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


			if (($retval = RutinaPeer::doValidate($this, $columns)) !== true) {
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
		$pos = RutinaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaRutina();
				break;
			case 1:
				return $this->getCaOpcion();
				break;
			case 2:
				return $this->getCaDescripcion();
				break;
			case 3:
				return $this->getCaPrograma();
				break;
			case 4:
				return $this->getCaGrupo();
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
		$keys = RutinaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaRutina(),
			$keys[1] => $this->getCaOpcion(),
			$keys[2] => $this->getCaDescripcion(),
			$keys[3] => $this->getCaPrograma(),
			$keys[4] => $this->getCaGrupo(),
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
		$pos = RutinaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaRutina($value);
				break;
			case 1:
				$this->setCaOpcion($value);
				break;
			case 2:
				$this->setCaDescripcion($value);
				break;
			case 3:
				$this->setCaPrograma($value);
				break;
			case 4:
				$this->setCaGrupo($value);
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
		$keys = RutinaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaRutina($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaOpcion($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaDescripcion($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaPrograma($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaGrupo($arr[$keys[4]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(RutinaPeer::DATABASE_NAME);

		if ($this->isColumnModified(RutinaPeer::CA_RUTINA)) $criteria->add(RutinaPeer::CA_RUTINA, $this->ca_rutina);
		if ($this->isColumnModified(RutinaPeer::CA_OPCION)) $criteria->add(RutinaPeer::CA_OPCION, $this->ca_opcion);
		if ($this->isColumnModified(RutinaPeer::CA_DESCRIPCION)) $criteria->add(RutinaPeer::CA_DESCRIPCION, $this->ca_descripcion);
		if ($this->isColumnModified(RutinaPeer::CA_PROGRAMA)) $criteria->add(RutinaPeer::CA_PROGRAMA, $this->ca_programa);
		if ($this->isColumnModified(RutinaPeer::CA_GRUPO)) $criteria->add(RutinaPeer::CA_GRUPO, $this->ca_grupo);

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
		$criteria = new Criteria(RutinaPeer::DATABASE_NAME);

		$criteria->add(RutinaPeer::CA_RUTINA, $this->ca_rutina);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     string
	 */
	public function getPrimaryKey()
	{
		return $this->getCaRutina();
	}

	/**
	 * Generic method to set the primary key (ca_rutina column).
	 *
	 * @param      string $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaRutina($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Rutina (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaRutina($this->ca_rutina);

		$copyObj->setCaOpcion($this->ca_opcion);

		$copyObj->setCaDescripcion($this->ca_descripcion);

		$copyObj->setCaPrograma($this->ca_programa);

		$copyObj->setCaGrupo($this->ca_grupo);


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
	 * @return     Rutina Clone of current object.
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
	 * @return     RutinaPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new RutinaPeer();
		}
		return self::$peer;
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

	}

} // BaseRutina
