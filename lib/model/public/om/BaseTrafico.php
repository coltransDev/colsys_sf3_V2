<?php

/**
 * Base class that represents a row from the 'tb_traficos' table.
 *
 * 
 *
 * @package    lib.model.public.om
 */
abstract class BaseTrafico extends BaseObject  implements Persistent {


  const PEER = 'TraficoPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        TraficoPeer
	 */
	protected static $peer;

	/**
	 * The value for the ca_idtrafico field.
	 * @var        string
	 */
	protected $ca_idtrafico;

	/**
	 * The value for the ca_nombre field.
	 * @var        string
	 */
	protected $ca_nombre;

	/**
	 * The value for the ca_bandera field.
	 * @var        string
	 */
	protected $ca_bandera;

	/**
	 * The value for the ca_idmoneda field.
	 * @var        string
	 */
	protected $ca_idmoneda;

	/**
	 * The value for the ca_idgrupo field.
	 * @var        int
	 */
	protected $ca_idgrupo;

	/**
	 * The value for the ca_link field.
	 * @var        string
	 */
	protected $ca_link;

	/**
	 * The value for the ca_conceptos field.
	 * @var        string
	 */
	protected $ca_conceptos;

	/**
	 * @var        TraficoGrupo
	 */
	protected $aTraficoGrupo;

	/**
	 * @var        array PricArchivo[] Collection to store aggregation of PricArchivo objects.
	 */
	protected $collPricArchivos;

	/**
	 * @var        Criteria The criteria used to select the current contents of collPricArchivos.
	 */
	private $lastPricArchivoCriteria = null;

	/**
	 * @var        array Ciudad[] Collection to store aggregation of Ciudad objects.
	 */
	protected $collCiudads;

	/**
	 * @var        Criteria The criteria used to select the current contents of collCiudads.
	 */
	private $lastCiudadCriteria = null;

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
	 * Initializes internal state of BaseTrafico object.
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
	 * Get the [ca_idtrafico] column value.
	 * 
	 * @return     string
	 */
	public function getCaIdtrafico()
	{
		return $this->ca_idtrafico;
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
	 * Get the [ca_bandera] column value.
	 * 
	 * @return     string
	 */
	public function getCaBandera()
	{
		return $this->ca_bandera;
	}

	/**
	 * Get the [ca_idmoneda] column value.
	 * 
	 * @return     string
	 */
	public function getCaIdmoneda()
	{
		return $this->ca_idmoneda;
	}

	/**
	 * Get the [ca_idgrupo] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdgrupo()
	{
		return $this->ca_idgrupo;
	}

	/**
	 * Get the [ca_link] column value.
	 * 
	 * @return     string
	 */
	public function getCaLink()
	{
		return $this->ca_link;
	}

	/**
	 * Get the [ca_conceptos] column value.
	 * 
	 * @return     string
	 */
	public function getCaConceptos()
	{
		return $this->ca_conceptos;
	}

	/**
	 * Set the value of [ca_idtrafico] column.
	 * 
	 * @param      string $v new value
	 * @return     Trafico The current object (for fluent API support)
	 */
	public function setCaIdtrafico($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idtrafico !== $v) {
			$this->ca_idtrafico = $v;
			$this->modifiedColumns[] = TraficoPeer::CA_IDTRAFICO;
		}

		return $this;
	} // setCaIdtrafico()

	/**
	 * Set the value of [ca_nombre] column.
	 * 
	 * @param      string $v new value
	 * @return     Trafico The current object (for fluent API support)
	 */
	public function setCaNombre($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_nombre !== $v) {
			$this->ca_nombre = $v;
			$this->modifiedColumns[] = TraficoPeer::CA_NOMBRE;
		}

		return $this;
	} // setCaNombre()

	/**
	 * Set the value of [ca_bandera] column.
	 * 
	 * @param      string $v new value
	 * @return     Trafico The current object (for fluent API support)
	 */
	public function setCaBandera($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_bandera !== $v) {
			$this->ca_bandera = $v;
			$this->modifiedColumns[] = TraficoPeer::CA_BANDERA;
		}

		return $this;
	} // setCaBandera()

	/**
	 * Set the value of [ca_idmoneda] column.
	 * 
	 * @param      string $v new value
	 * @return     Trafico The current object (for fluent API support)
	 */
	public function setCaIdmoneda($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idmoneda !== $v) {
			$this->ca_idmoneda = $v;
			$this->modifiedColumns[] = TraficoPeer::CA_IDMONEDA;
		}

		return $this;
	} // setCaIdmoneda()

	/**
	 * Set the value of [ca_idgrupo] column.
	 * 
	 * @param      int $v new value
	 * @return     Trafico The current object (for fluent API support)
	 */
	public function setCaIdgrupo($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idgrupo !== $v) {
			$this->ca_idgrupo = $v;
			$this->modifiedColumns[] = TraficoPeer::CA_IDGRUPO;
		}

		if ($this->aTraficoGrupo !== null && $this->aTraficoGrupo->getCaIdgrupo() !== $v) {
			$this->aTraficoGrupo = null;
		}

		return $this;
	} // setCaIdgrupo()

	/**
	 * Set the value of [ca_link] column.
	 * 
	 * @param      string $v new value
	 * @return     Trafico The current object (for fluent API support)
	 */
	public function setCaLink($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_link !== $v) {
			$this->ca_link = $v;
			$this->modifiedColumns[] = TraficoPeer::CA_LINK;
		}

		return $this;
	} // setCaLink()

	/**
	 * Set the value of [ca_conceptos] column.
	 * 
	 * @param      string $v new value
	 * @return     Trafico The current object (for fluent API support)
	 */
	public function setCaConceptos($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_conceptos !== $v) {
			$this->ca_conceptos = $v;
			$this->modifiedColumns[] = TraficoPeer::CA_CONCEPTOS;
		}

		return $this;
	} // setCaConceptos()

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

			$this->ca_idtrafico = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ca_nombre = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_bandera = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_idmoneda = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_idgrupo = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->ca_link = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_conceptos = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 7; // 7 = TraficoPeer::NUM_COLUMNS - TraficoPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Trafico object", $e);
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

		if ($this->aTraficoGrupo !== null && $this->ca_idgrupo !== $this->aTraficoGrupo->getCaIdgrupo()) {
			$this->aTraficoGrupo = null;
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
			$con = Propel::getConnection(TraficoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = TraficoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aTraficoGrupo = null;
			$this->collPricArchivos = null;
			$this->lastPricArchivoCriteria = null;

			$this->collCiudads = null;
			$this->lastCiudadCriteria = null;

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
			$con = Propel::getConnection(TraficoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			TraficoPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(TraficoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			TraficoPeer::addInstanceToPool($this);
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

			if ($this->aTraficoGrupo !== null) {
				if ($this->aTraficoGrupo->isModified() || $this->aTraficoGrupo->isNew()) {
					$affectedRows += $this->aTraficoGrupo->save($con);
				}
				$this->setTraficoGrupo($this->aTraficoGrupo);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = TraficoPeer::CA_IDTRAFICO;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TraficoPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setCaIdtrafico($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += TraficoPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collPricArchivos !== null) {
				foreach ($this->collPricArchivos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCiudads !== null) {
				foreach ($this->collCiudads as $referrerFK) {
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

			if ($this->aTraficoGrupo !== null) {
				if (!$this->aTraficoGrupo->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTraficoGrupo->getValidationFailures());
				}
			}


			if (($retval = TraficoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collPricArchivos !== null) {
					foreach ($this->collPricArchivos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCiudads !== null) {
					foreach ($this->collCiudads as $referrerFK) {
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
		$pos = TraficoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdtrafico();
				break;
			case 1:
				return $this->getCaNombre();
				break;
			case 2:
				return $this->getCaBandera();
				break;
			case 3:
				return $this->getCaIdmoneda();
				break;
			case 4:
				return $this->getCaIdgrupo();
				break;
			case 5:
				return $this->getCaLink();
				break;
			case 6:
				return $this->getCaConceptos();
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
		$keys = TraficoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdtrafico(),
			$keys[1] => $this->getCaNombre(),
			$keys[2] => $this->getCaBandera(),
			$keys[3] => $this->getCaIdmoneda(),
			$keys[4] => $this->getCaIdgrupo(),
			$keys[5] => $this->getCaLink(),
			$keys[6] => $this->getCaConceptos(),
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
		$pos = TraficoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdtrafico($value);
				break;
			case 1:
				$this->setCaNombre($value);
				break;
			case 2:
				$this->setCaBandera($value);
				break;
			case 3:
				$this->setCaIdmoneda($value);
				break;
			case 4:
				$this->setCaIdgrupo($value);
				break;
			case 5:
				$this->setCaLink($value);
				break;
			case 6:
				$this->setCaConceptos($value);
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
		$keys = TraficoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdtrafico($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaNombre($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaBandera($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaIdmoneda($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaIdgrupo($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaLink($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaConceptos($arr[$keys[6]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(TraficoPeer::DATABASE_NAME);

		if ($this->isColumnModified(TraficoPeer::CA_IDTRAFICO)) $criteria->add(TraficoPeer::CA_IDTRAFICO, $this->ca_idtrafico);
		if ($this->isColumnModified(TraficoPeer::CA_NOMBRE)) $criteria->add(TraficoPeer::CA_NOMBRE, $this->ca_nombre);
		if ($this->isColumnModified(TraficoPeer::CA_BANDERA)) $criteria->add(TraficoPeer::CA_BANDERA, $this->ca_bandera);
		if ($this->isColumnModified(TraficoPeer::CA_IDMONEDA)) $criteria->add(TraficoPeer::CA_IDMONEDA, $this->ca_idmoneda);
		if ($this->isColumnModified(TraficoPeer::CA_IDGRUPO)) $criteria->add(TraficoPeer::CA_IDGRUPO, $this->ca_idgrupo);
		if ($this->isColumnModified(TraficoPeer::CA_LINK)) $criteria->add(TraficoPeer::CA_LINK, $this->ca_link);
		if ($this->isColumnModified(TraficoPeer::CA_CONCEPTOS)) $criteria->add(TraficoPeer::CA_CONCEPTOS, $this->ca_conceptos);

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
		$criteria = new Criteria(TraficoPeer::DATABASE_NAME);

		$criteria->add(TraficoPeer::CA_IDTRAFICO, $this->ca_idtrafico);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     string
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdtrafico();
	}

	/**
	 * Generic method to set the primary key (ca_idtrafico column).
	 *
	 * @param      string $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdtrafico($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Trafico (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaNombre($this->ca_nombre);

		$copyObj->setCaBandera($this->ca_bandera);

		$copyObj->setCaIdmoneda($this->ca_idmoneda);

		$copyObj->setCaIdgrupo($this->ca_idgrupo);

		$copyObj->setCaLink($this->ca_link);

		$copyObj->setCaConceptos($this->ca_conceptos);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getPricArchivos() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addPricArchivo($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getCiudads() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addCiudad($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setCaIdtrafico(NULL); // this is a auto-increment column, so set to default value

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
	 * @return     Trafico Clone of current object.
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
	 * @return     TraficoPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new TraficoPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a TraficoGrupo object.
	 *
	 * @param      TraficoGrupo $v
	 * @return     Trafico The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setTraficoGrupo(TraficoGrupo $v = null)
	{
		if ($v === null) {
			$this->setCaIdgrupo(NULL);
		} else {
			$this->setCaIdgrupo($v->getCaIdgrupo());
		}

		$this->aTraficoGrupo = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the TraficoGrupo object, it will not be re-added.
		if ($v !== null) {
			$v->addTrafico($this);
		}

		return $this;
	}


	/**
	 * Get the associated TraficoGrupo object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     TraficoGrupo The associated TraficoGrupo object.
	 * @throws     PropelException
	 */
	public function getTraficoGrupo(PropelPDO $con = null)
	{
		if ($this->aTraficoGrupo === null && ($this->ca_idgrupo !== null)) {
			$c = new Criteria(TraficoGrupoPeer::DATABASE_NAME);
			$c->add(TraficoGrupoPeer::CA_IDGRUPO, $this->ca_idgrupo);
			$this->aTraficoGrupo = TraficoGrupoPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aTraficoGrupo->addTraficos($this);
			 */
		}
		return $this->aTraficoGrupo;
	}

	/**
	 * Clears out the collPricArchivos collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addPricArchivos()
	 */
	public function clearPricArchivos()
	{
		$this->collPricArchivos = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collPricArchivos collection (array).
	 *
	 * By default this just sets the collPricArchivos collection to an empty array (like clearcollPricArchivos());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initPricArchivos()
	{
		$this->collPricArchivos = array();
	}

	/**
	 * Gets an array of PricArchivo objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Trafico has previously been saved, it will retrieve
	 * related PricArchivos from storage. If this Trafico is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array PricArchivo[]
	 * @throws     PropelException
	 */
	public function getPricArchivos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TraficoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricArchivos === null) {
			if ($this->isNew()) {
			   $this->collPricArchivos = array();
			} else {

				$criteria->add(PricArchivoPeer::CA_IDTRAFICO, $this->ca_idtrafico);

				PricArchivoPeer::addSelectColumns($criteria);
				$this->collPricArchivos = PricArchivoPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PricArchivoPeer::CA_IDTRAFICO, $this->ca_idtrafico);

				PricArchivoPeer::addSelectColumns($criteria);
				if (!isset($this->lastPricArchivoCriteria) || !$this->lastPricArchivoCriteria->equals($criteria)) {
					$this->collPricArchivos = PricArchivoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPricArchivoCriteria = $criteria;
		return $this->collPricArchivos;
	}

	/**
	 * Returns the number of related PricArchivo objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related PricArchivo objects.
	 * @throws     PropelException
	 */
	public function countPricArchivos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TraficoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collPricArchivos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PricArchivoPeer::CA_IDTRAFICO, $this->ca_idtrafico);

				$count = PricArchivoPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(PricArchivoPeer::CA_IDTRAFICO, $this->ca_idtrafico);

				if (!isset($this->lastPricArchivoCriteria) || !$this->lastPricArchivoCriteria->equals($criteria)) {
					$count = PricArchivoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPricArchivos);
				}
			} else {
				$count = count($this->collPricArchivos);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a PricArchivo object to this object
	 * through the PricArchivo foreign key attribute.
	 *
	 * @param      PricArchivo $l PricArchivo
	 * @return     void
	 * @throws     PropelException
	 */
	public function addPricArchivo(PricArchivo $l)
	{
		if ($this->collPricArchivos === null) {
			$this->initPricArchivos();
		}
		if (!in_array($l, $this->collPricArchivos, true)) { // only add it if the **same** object is not already associated
			array_push($this->collPricArchivos, $l);
			$l->setTrafico($this);
		}
	}

	/**
	 * Clears out the collCiudads collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addCiudads()
	 */
	public function clearCiudads()
	{
		$this->collCiudads = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collCiudads collection (array).
	 *
	 * By default this just sets the collCiudads collection to an empty array (like clearcollCiudads());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initCiudads()
	{
		$this->collCiudads = array();
	}

	/**
	 * Gets an array of Ciudad objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Trafico has previously been saved, it will retrieve
	 * related Ciudads from storage. If this Trafico is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array Ciudad[]
	 * @throws     PropelException
	 */
	public function getCiudads($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TraficoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCiudads === null) {
			if ($this->isNew()) {
			   $this->collCiudads = array();
			} else {

				$criteria->add(CiudadPeer::CA_IDTRAFICO, $this->ca_idtrafico);

				CiudadPeer::addSelectColumns($criteria);
				$this->collCiudads = CiudadPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CiudadPeer::CA_IDTRAFICO, $this->ca_idtrafico);

				CiudadPeer::addSelectColumns($criteria);
				if (!isset($this->lastCiudadCriteria) || !$this->lastCiudadCriteria->equals($criteria)) {
					$this->collCiudads = CiudadPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCiudadCriteria = $criteria;
		return $this->collCiudads;
	}

	/**
	 * Returns the number of related Ciudad objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Ciudad objects.
	 * @throws     PropelException
	 */
	public function countCiudads(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TraficoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collCiudads === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(CiudadPeer::CA_IDTRAFICO, $this->ca_idtrafico);

				$count = CiudadPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(CiudadPeer::CA_IDTRAFICO, $this->ca_idtrafico);

				if (!isset($this->lastCiudadCriteria) || !$this->lastCiudadCriteria->equals($criteria)) {
					$count = CiudadPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collCiudads);
				}
			} else {
				$count = count($this->collCiudads);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a Ciudad object to this object
	 * through the Ciudad foreign key attribute.
	 *
	 * @param      Ciudad $l Ciudad
	 * @return     void
	 * @throws     PropelException
	 */
	public function addCiudad(Ciudad $l)
	{
		if ($this->collCiudads === null) {
			$this->initCiudads();
		}
		if (!in_array($l, $this->collCiudads, true)) { // only add it if the **same** object is not already associated
			array_push($this->collCiudads, $l);
			$l->setTrafico($this);
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
			if ($this->collPricArchivos) {
				foreach ((array) $this->collPricArchivos as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collCiudads) {
				foreach ((array) $this->collCiudads as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collPricArchivos = null;
		$this->collCiudads = null;
			$this->aTraficoGrupo = null;
	}

} // BaseTrafico
