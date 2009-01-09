<?php

/**
 * Base class that represents a row from the 'tb_transporlineas' table.
 *
 * 
 *
 * @package    lib.model.public.om
 */
abstract class BaseTransportador extends BaseObject  implements Persistent {


  const PEER = 'TransportadorPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        TransportadorPeer
	 */
	protected static $peer;

	/**
	 * The value for the ca_idlinea field.
	 * @var        int
	 */
	protected $ca_idlinea;

	/**
	 * The value for the ca_idtransportista field.
	 * @var        string
	 */
	protected $ca_idtransportista;

	/**
	 * The value for the ca_nombre field.
	 * @var        string
	 */
	protected $ca_nombre;

	/**
	 * The value for the ca_sigla field.
	 * @var        string
	 */
	protected $ca_sigla;

	/**
	 * The value for the ca_transporte field.
	 * @var        string
	 */
	protected $ca_transporte;

	/**
	 * @var        array InoMaestraAir[] Collection to store aggregation of InoMaestraAir objects.
	 */
	protected $collInoMaestraAirs;

	/**
	 * @var        Criteria The criteria used to select the current contents of collInoMaestraAirs.
	 */
	private $lastInoMaestraAirCriteria = null;

	/**
	 * @var        array CotProducto[] Collection to store aggregation of CotProducto objects.
	 */
	protected $collCotProductos;

	/**
	 * @var        Criteria The criteria used to select the current contents of collCotProductos.
	 */
	private $lastCotProductoCriteria = null;

	/**
	 * @var        array Trayecto[] Collection to store aggregation of Trayecto objects.
	 */
	protected $collTrayectos;

	/**
	 * @var        Criteria The criteria used to select the current contents of collTrayectos.
	 */
	private $lastTrayectoCriteria = null;

	/**
	 * @var        array Reporte[] Collection to store aggregation of Reporte objects.
	 */
	protected $collReportes;

	/**
	 * @var        Criteria The criteria used to select the current contents of collReportes.
	 */
	private $lastReporteCriteria = null;

	/**
	 * @var        array InoMaestraSea[] Collection to store aggregation of InoMaestraSea objects.
	 */
	protected $collInoMaestraSeas;

	/**
	 * @var        Criteria The criteria used to select the current contents of collInoMaestraSeas.
	 */
	private $lastInoMaestraSeaCriteria = null;

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
	 * Initializes internal state of BaseTransportador object.
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
	 * Get the [ca_idlinea] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdlinea()
	{
		return $this->ca_idlinea;
	}

	/**
	 * Get the [ca_idtransportista] column value.
	 * 
	 * @return     string
	 */
	public function getCaIdtransportista()
	{
		return $this->ca_idtransportista;
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
	 * Get the [ca_sigla] column value.
	 * 
	 * @return     string
	 */
	public function getCaSigla()
	{
		return $this->ca_sigla;
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
	 * Set the value of [ca_idlinea] column.
	 * 
	 * @param      int $v new value
	 * @return     Transportador The current object (for fluent API support)
	 */
	public function setCaIdlinea($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idlinea !== $v) {
			$this->ca_idlinea = $v;
			$this->modifiedColumns[] = TransportadorPeer::CA_IDLINEA;
		}

		return $this;
	} // setCaIdlinea()

	/**
	 * Set the value of [ca_idtransportista] column.
	 * 
	 * @param      string $v new value
	 * @return     Transportador The current object (for fluent API support)
	 */
	public function setCaIdtransportista($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idtransportista !== $v) {
			$this->ca_idtransportista = $v;
			$this->modifiedColumns[] = TransportadorPeer::CA_IDTRANSPORTISTA;
		}

		return $this;
	} // setCaIdtransportista()

	/**
	 * Set the value of [ca_nombre] column.
	 * 
	 * @param      string $v new value
	 * @return     Transportador The current object (for fluent API support)
	 */
	public function setCaNombre($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_nombre !== $v) {
			$this->ca_nombre = $v;
			$this->modifiedColumns[] = TransportadorPeer::CA_NOMBRE;
		}

		return $this;
	} // setCaNombre()

	/**
	 * Set the value of [ca_sigla] column.
	 * 
	 * @param      string $v new value
	 * @return     Transportador The current object (for fluent API support)
	 */
	public function setCaSigla($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_sigla !== $v) {
			$this->ca_sigla = $v;
			$this->modifiedColumns[] = TransportadorPeer::CA_SIGLA;
		}

		return $this;
	} // setCaSigla()

	/**
	 * Set the value of [ca_transporte] column.
	 * 
	 * @param      string $v new value
	 * @return     Transportador The current object (for fluent API support)
	 */
	public function setCaTransporte($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_transporte !== $v) {
			$this->ca_transporte = $v;
			$this->modifiedColumns[] = TransportadorPeer::CA_TRANSPORTE;
		}

		return $this;
	} // setCaTransporte()

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

			$this->ca_idlinea = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_idtransportista = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_nombre = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_sigla = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_transporte = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 5; // 5 = TransportadorPeer::NUM_COLUMNS - TransportadorPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Transportador object", $e);
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
			$con = Propel::getConnection(TransportadorPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = TransportadorPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->collInoMaestraAirs = null;
			$this->lastInoMaestraAirCriteria = null;

			$this->collCotProductos = null;
			$this->lastCotProductoCriteria = null;

			$this->collTrayectos = null;
			$this->lastTrayectoCriteria = null;

			$this->collReportes = null;
			$this->lastReporteCriteria = null;

			$this->collInoMaestraSeas = null;
			$this->lastInoMaestraSeaCriteria = null;

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
			$con = Propel::getConnection(TransportadorPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			TransportadorPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(TransportadorPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			TransportadorPeer::addInstanceToPool($this);
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
				$this->modifiedColumns[] = TransportadorPeer::CA_IDLINEA;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TransportadorPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setCaIdlinea($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += TransportadorPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collInoMaestraAirs !== null) {
				foreach ($this->collInoMaestraAirs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCotProductos !== null) {
				foreach ($this->collCotProductos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collTrayectos !== null) {
				foreach ($this->collTrayectos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collReportes !== null) {
				foreach ($this->collReportes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collInoMaestraSeas !== null) {
				foreach ($this->collInoMaestraSeas as $referrerFK) {
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


			if (($retval = TransportadorPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collInoMaestraAirs !== null) {
					foreach ($this->collInoMaestraAirs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCotProductos !== null) {
					foreach ($this->collCotProductos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collTrayectos !== null) {
					foreach ($this->collTrayectos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collReportes !== null) {
					foreach ($this->collReportes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collInoMaestraSeas !== null) {
					foreach ($this->collInoMaestraSeas as $referrerFK) {
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
		$pos = TransportadorPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdlinea();
				break;
			case 1:
				return $this->getCaIdtransportista();
				break;
			case 2:
				return $this->getCaNombre();
				break;
			case 3:
				return $this->getCaSigla();
				break;
			case 4:
				return $this->getCaTransporte();
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
		$keys = TransportadorPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdlinea(),
			$keys[1] => $this->getCaIdtransportista(),
			$keys[2] => $this->getCaNombre(),
			$keys[3] => $this->getCaSigla(),
			$keys[4] => $this->getCaTransporte(),
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
		$pos = TransportadorPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdlinea($value);
				break;
			case 1:
				$this->setCaIdtransportista($value);
				break;
			case 2:
				$this->setCaNombre($value);
				break;
			case 3:
				$this->setCaSigla($value);
				break;
			case 4:
				$this->setCaTransporte($value);
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
		$keys = TransportadorPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdlinea($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdtransportista($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaNombre($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaSigla($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaTransporte($arr[$keys[4]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);

		if ($this->isColumnModified(TransportadorPeer::CA_IDLINEA)) $criteria->add(TransportadorPeer::CA_IDLINEA, $this->ca_idlinea);
		if ($this->isColumnModified(TransportadorPeer::CA_IDTRANSPORTISTA)) $criteria->add(TransportadorPeer::CA_IDTRANSPORTISTA, $this->ca_idtransportista);
		if ($this->isColumnModified(TransportadorPeer::CA_NOMBRE)) $criteria->add(TransportadorPeer::CA_NOMBRE, $this->ca_nombre);
		if ($this->isColumnModified(TransportadorPeer::CA_SIGLA)) $criteria->add(TransportadorPeer::CA_SIGLA, $this->ca_sigla);
		if ($this->isColumnModified(TransportadorPeer::CA_TRANSPORTE)) $criteria->add(TransportadorPeer::CA_TRANSPORTE, $this->ca_transporte);

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
		$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);

		$criteria->add(TransportadorPeer::CA_IDLINEA, $this->ca_idlinea);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdlinea();
	}

	/**
	 * Generic method to set the primary key (ca_idlinea column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdlinea($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Transportador (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdtransportista($this->ca_idtransportista);

		$copyObj->setCaNombre($this->ca_nombre);

		$copyObj->setCaSigla($this->ca_sigla);

		$copyObj->setCaTransporte($this->ca_transporte);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getInoMaestraAirs() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addInoMaestraAir($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getCotProductos() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addCotProducto($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getTrayectos() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addTrayecto($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getReportes() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addReporte($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getInoMaestraSeas() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addInoMaestraSea($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setCaIdlinea(NULL); // this is a auto-increment column, so set to default value

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
	 * @return     Transportador Clone of current object.
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
	 * @return     TransportadorPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new TransportadorPeer();
		}
		return self::$peer;
	}

	/**
	 * Clears out the collInoMaestraAirs collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addInoMaestraAirs()
	 */
	public function clearInoMaestraAirs()
	{
		$this->collInoMaestraAirs = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collInoMaestraAirs collection (array).
	 *
	 * By default this just sets the collInoMaestraAirs collection to an empty array (like clearcollInoMaestraAirs());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initInoMaestraAirs()
	{
		$this->collInoMaestraAirs = array();
	}

	/**
	 * Gets an array of InoMaestraAir objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Transportador has previously been saved, it will retrieve
	 * related InoMaestraAirs from storage. If this Transportador is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array InoMaestraAir[]
	 * @throws     PropelException
	 */
	public function getInoMaestraAirs($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoMaestraAirs === null) {
			if ($this->isNew()) {
			   $this->collInoMaestraAirs = array();
			} else {

				$criteria->add(InoMaestraAirPeer::CA_IDLINEA, $this->ca_idlinea);

				InoMaestraAirPeer::addSelectColumns($criteria);
				$this->collInoMaestraAirs = InoMaestraAirPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(InoMaestraAirPeer::CA_IDLINEA, $this->ca_idlinea);

				InoMaestraAirPeer::addSelectColumns($criteria);
				if (!isset($this->lastInoMaestraAirCriteria) || !$this->lastInoMaestraAirCriteria->equals($criteria)) {
					$this->collInoMaestraAirs = InoMaestraAirPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInoMaestraAirCriteria = $criteria;
		return $this->collInoMaestraAirs;
	}

	/**
	 * Returns the number of related InoMaestraAir objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related InoMaestraAir objects.
	 * @throws     PropelException
	 */
	public function countInoMaestraAirs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collInoMaestraAirs === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(InoMaestraAirPeer::CA_IDLINEA, $this->ca_idlinea);

				$count = InoMaestraAirPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(InoMaestraAirPeer::CA_IDLINEA, $this->ca_idlinea);

				if (!isset($this->lastInoMaestraAirCriteria) || !$this->lastInoMaestraAirCriteria->equals($criteria)) {
					$count = InoMaestraAirPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collInoMaestraAirs);
				}
			} else {
				$count = count($this->collInoMaestraAirs);
			}
		}
		$this->lastInoMaestraAirCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a InoMaestraAir object to this object
	 * through the InoMaestraAir foreign key attribute.
	 *
	 * @param      InoMaestraAir $l InoMaestraAir
	 * @return     void
	 * @throws     PropelException
	 */
	public function addInoMaestraAir(InoMaestraAir $l)
	{
		if ($this->collInoMaestraAirs === null) {
			$this->initInoMaestraAirs();
		}
		if (!in_array($l, $this->collInoMaestraAirs, true)) { // only add it if the **same** object is not already associated
			array_push($this->collInoMaestraAirs, $l);
			$l->setTransportador($this);
		}
	}

	/**
	 * Clears out the collCotProductos collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addCotProductos()
	 */
	public function clearCotProductos()
	{
		$this->collCotProductos = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collCotProductos collection (array).
	 *
	 * By default this just sets the collCotProductos collection to an empty array (like clearcollCotProductos());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initCotProductos()
	{
		$this->collCotProductos = array();
	}

	/**
	 * Gets an array of CotProducto objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Transportador has previously been saved, it will retrieve
	 * related CotProductos from storage. If this Transportador is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array CotProducto[]
	 * @throws     PropelException
	 */
	public function getCotProductos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotProductos === null) {
			if ($this->isNew()) {
			   $this->collCotProductos = array();
			} else {

				$criteria->add(CotProductoPeer::CA_IDLINEA, $this->ca_idlinea);

				CotProductoPeer::addSelectColumns($criteria);
				$this->collCotProductos = CotProductoPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CotProductoPeer::CA_IDLINEA, $this->ca_idlinea);

				CotProductoPeer::addSelectColumns($criteria);
				if (!isset($this->lastCotProductoCriteria) || !$this->lastCotProductoCriteria->equals($criteria)) {
					$this->collCotProductos = CotProductoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCotProductoCriteria = $criteria;
		return $this->collCotProductos;
	}

	/**
	 * Returns the number of related CotProducto objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related CotProducto objects.
	 * @throws     PropelException
	 */
	public function countCotProductos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collCotProductos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(CotProductoPeer::CA_IDLINEA, $this->ca_idlinea);

				$count = CotProductoPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(CotProductoPeer::CA_IDLINEA, $this->ca_idlinea);

				if (!isset($this->lastCotProductoCriteria) || !$this->lastCotProductoCriteria->equals($criteria)) {
					$count = CotProductoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collCotProductos);
				}
			} else {
				$count = count($this->collCotProductos);
			}
		}
		$this->lastCotProductoCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a CotProducto object to this object
	 * through the CotProducto foreign key attribute.
	 *
	 * @param      CotProducto $l CotProducto
	 * @return     void
	 * @throws     PropelException
	 */
	public function addCotProducto(CotProducto $l)
	{
		if ($this->collCotProductos === null) {
			$this->initCotProductos();
		}
		if (!in_array($l, $this->collCotProductos, true)) { // only add it if the **same** object is not already associated
			array_push($this->collCotProductos, $l);
			$l->setTransportador($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Transportador is new, it will return
	 * an empty collection; or if this Transportador has previously
	 * been saved, it will retrieve related CotProductos from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Transportador.
	 */
	public function getCotProductosJoinCotizacion($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotProductos === null) {
			if ($this->isNew()) {
				$this->collCotProductos = array();
			} else {

				$criteria->add(CotProductoPeer::CA_IDLINEA, $this->ca_idlinea);

				$this->collCotProductos = CotProductoPeer::doSelectJoinCotizacion($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CotProductoPeer::CA_IDLINEA, $this->ca_idlinea);

			if (!isset($this->lastCotProductoCriteria) || !$this->lastCotProductoCriteria->equals($criteria)) {
				$this->collCotProductos = CotProductoPeer::doSelectJoinCotizacion($criteria, $con, $join_behavior);
			}
		}
		$this->lastCotProductoCriteria = $criteria;

		return $this->collCotProductos;
	}

	/**
	 * Clears out the collTrayectos collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addTrayectos()
	 */
	public function clearTrayectos()
	{
		$this->collTrayectos = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collTrayectos collection (array).
	 *
	 * By default this just sets the collTrayectos collection to an empty array (like clearcollTrayectos());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initTrayectos()
	{
		$this->collTrayectos = array();
	}

	/**
	 * Gets an array of Trayecto objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Transportador has previously been saved, it will retrieve
	 * related Trayectos from storage. If this Transportador is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array Trayecto[]
	 * @throws     PropelException
	 */
	public function getTrayectos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTrayectos === null) {
			if ($this->isNew()) {
			   $this->collTrayectos = array();
			} else {

				$criteria->add(TrayectoPeer::CA_IDLINEA, $this->ca_idlinea);

				TrayectoPeer::addSelectColumns($criteria);
				$this->collTrayectos = TrayectoPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(TrayectoPeer::CA_IDLINEA, $this->ca_idlinea);

				TrayectoPeer::addSelectColumns($criteria);
				if (!isset($this->lastTrayectoCriteria) || !$this->lastTrayectoCriteria->equals($criteria)) {
					$this->collTrayectos = TrayectoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastTrayectoCriteria = $criteria;
		return $this->collTrayectos;
	}

	/**
	 * Returns the number of related Trayecto objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Trayecto objects.
	 * @throws     PropelException
	 */
	public function countTrayectos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collTrayectos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(TrayectoPeer::CA_IDLINEA, $this->ca_idlinea);

				$count = TrayectoPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(TrayectoPeer::CA_IDLINEA, $this->ca_idlinea);

				if (!isset($this->lastTrayectoCriteria) || !$this->lastTrayectoCriteria->equals($criteria)) {
					$count = TrayectoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collTrayectos);
				}
			} else {
				$count = count($this->collTrayectos);
			}
		}
		$this->lastTrayectoCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a Trayecto object to this object
	 * through the Trayecto foreign key attribute.
	 *
	 * @param      Trayecto $l Trayecto
	 * @return     void
	 * @throws     PropelException
	 */
	public function addTrayecto(Trayecto $l)
	{
		if ($this->collTrayectos === null) {
			$this->initTrayectos();
		}
		if (!in_array($l, $this->collTrayectos, true)) { // only add it if the **same** object is not already associated
			array_push($this->collTrayectos, $l);
			$l->setTransportador($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Transportador is new, it will return
	 * an empty collection; or if this Transportador has previously
	 * been saved, it will retrieve related Trayectos from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Transportador.
	 */
	public function getTrayectosJoinAgente($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTrayectos === null) {
			if ($this->isNew()) {
				$this->collTrayectos = array();
			} else {

				$criteria->add(TrayectoPeer::CA_IDLINEA, $this->ca_idlinea);

				$this->collTrayectos = TrayectoPeer::doSelectJoinAgente($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(TrayectoPeer::CA_IDLINEA, $this->ca_idlinea);

			if (!isset($this->lastTrayectoCriteria) || !$this->lastTrayectoCriteria->equals($criteria)) {
				$this->collTrayectos = TrayectoPeer::doSelectJoinAgente($criteria, $con, $join_behavior);
			}
		}
		$this->lastTrayectoCriteria = $criteria;

		return $this->collTrayectos;
	}

	/**
	 * Clears out the collReportes collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addReportes()
	 */
	public function clearReportes()
	{
		$this->collReportes = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collReportes collection (array).
	 *
	 * By default this just sets the collReportes collection to an empty array (like clearcollReportes());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initReportes()
	{
		$this->collReportes = array();
	}

	/**
	 * Gets an array of Reporte objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Transportador has previously been saved, it will retrieve
	 * related Reportes from storage. If this Transportador is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array Reporte[]
	 * @throws     PropelException
	 */
	public function getReportes($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
			   $this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDLINEA, $this->ca_idlinea);

				ReportePeer::addSelectColumns($criteria);
				$this->collReportes = ReportePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ReportePeer::CA_IDLINEA, $this->ca_idlinea);

				ReportePeer::addSelectColumns($criteria);
				if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
					$this->collReportes = ReportePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastReporteCriteria = $criteria;
		return $this->collReportes;
	}

	/**
	 * Returns the number of related Reporte objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Reporte objects.
	 * @throws     PropelException
	 */
	public function countReportes(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(ReportePeer::CA_IDLINEA, $this->ca_idlinea);

				$count = ReportePeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(ReportePeer::CA_IDLINEA, $this->ca_idlinea);

				if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
					$count = ReportePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collReportes);
				}
			} else {
				$count = count($this->collReportes);
			}
		}
		$this->lastReporteCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a Reporte object to this object
	 * through the Reporte foreign key attribute.
	 *
	 * @param      Reporte $l Reporte
	 * @return     void
	 * @throws     PropelException
	 */
	public function addReporte(Reporte $l)
	{
		if ($this->collReportes === null) {
			$this->initReportes();
		}
		if (!in_array($l, $this->collReportes, true)) { // only add it if the **same** object is not already associated
			array_push($this->collReportes, $l);
			$l->setTransportador($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Transportador is new, it will return
	 * an empty collection; or if this Transportador has previously
	 * been saved, it will retrieve related Reportes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Transportador.
	 */
	public function getReportesJoinUsuario($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDLINEA, $this->ca_idlinea);

				$this->collReportes = ReportePeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ReportePeer::CA_IDLINEA, $this->ca_idlinea);

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		}
		$this->lastReporteCriteria = $criteria;

		return $this->collReportes;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Transportador is new, it will return
	 * an empty collection; or if this Transportador has previously
	 * been saved, it will retrieve related Reportes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Transportador.
	 */
	public function getReportesJoinTercero($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDLINEA, $this->ca_idlinea);

				$this->collReportes = ReportePeer::doSelectJoinTercero($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ReportePeer::CA_IDLINEA, $this->ca_idlinea);

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinTercero($criteria, $con, $join_behavior);
			}
		}
		$this->lastReporteCriteria = $criteria;

		return $this->collReportes;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Transportador is new, it will return
	 * an empty collection; or if this Transportador has previously
	 * been saved, it will retrieve related Reportes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Transportador.
	 */
	public function getReportesJoinAgente($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDLINEA, $this->ca_idlinea);

				$this->collReportes = ReportePeer::doSelectJoinAgente($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ReportePeer::CA_IDLINEA, $this->ca_idlinea);

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinAgente($criteria, $con, $join_behavior);
			}
		}
		$this->lastReporteCriteria = $criteria;

		return $this->collReportes;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Transportador is new, it will return
	 * an empty collection; or if this Transportador has previously
	 * been saved, it will retrieve related Reportes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Transportador.
	 */
	public function getReportesJoinBodega($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDLINEA, $this->ca_idlinea);

				$this->collReportes = ReportePeer::doSelectJoinBodega($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ReportePeer::CA_IDLINEA, $this->ca_idlinea);

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinBodega($criteria, $con, $join_behavior);
			}
		}
		$this->lastReporteCriteria = $criteria;

		return $this->collReportes;
	}

	/**
	 * Clears out the collInoMaestraSeas collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addInoMaestraSeas()
	 */
	public function clearInoMaestraSeas()
	{
		$this->collInoMaestraSeas = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collInoMaestraSeas collection (array).
	 *
	 * By default this just sets the collInoMaestraSeas collection to an empty array (like clearcollInoMaestraSeas());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initInoMaestraSeas()
	{
		$this->collInoMaestraSeas = array();
	}

	/**
	 * Gets an array of InoMaestraSea objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Transportador has previously been saved, it will retrieve
	 * related InoMaestraSeas from storage. If this Transportador is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array InoMaestraSea[]
	 * @throws     PropelException
	 */
	public function getInoMaestraSeas($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoMaestraSeas === null) {
			if ($this->isNew()) {
			   $this->collInoMaestraSeas = array();
			} else {

				$criteria->add(InoMaestraSeaPeer::CA_IDLINEA, $this->ca_idlinea);

				InoMaestraSeaPeer::addSelectColumns($criteria);
				$this->collInoMaestraSeas = InoMaestraSeaPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(InoMaestraSeaPeer::CA_IDLINEA, $this->ca_idlinea);

				InoMaestraSeaPeer::addSelectColumns($criteria);
				if (!isset($this->lastInoMaestraSeaCriteria) || !$this->lastInoMaestraSeaCriteria->equals($criteria)) {
					$this->collInoMaestraSeas = InoMaestraSeaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInoMaestraSeaCriteria = $criteria;
		return $this->collInoMaestraSeas;
	}

	/**
	 * Returns the number of related InoMaestraSea objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related InoMaestraSea objects.
	 * @throws     PropelException
	 */
	public function countInoMaestraSeas(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collInoMaestraSeas === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(InoMaestraSeaPeer::CA_IDLINEA, $this->ca_idlinea);

				$count = InoMaestraSeaPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(InoMaestraSeaPeer::CA_IDLINEA, $this->ca_idlinea);

				if (!isset($this->lastInoMaestraSeaCriteria) || !$this->lastInoMaestraSeaCriteria->equals($criteria)) {
					$count = InoMaestraSeaPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collInoMaestraSeas);
				}
			} else {
				$count = count($this->collInoMaestraSeas);
			}
		}
		$this->lastInoMaestraSeaCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a InoMaestraSea object to this object
	 * through the InoMaestraSea foreign key attribute.
	 *
	 * @param      InoMaestraSea $l InoMaestraSea
	 * @return     void
	 * @throws     PropelException
	 */
	public function addInoMaestraSea(InoMaestraSea $l)
	{
		if ($this->collInoMaestraSeas === null) {
			$this->initInoMaestraSeas();
		}
		if (!in_array($l, $this->collInoMaestraSeas, true)) { // only add it if the **same** object is not already associated
			array_push($this->collInoMaestraSeas, $l);
			$l->setTransportador($this);
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
			if ($this->collInoMaestraAirs) {
				foreach ((array) $this->collInoMaestraAirs as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collCotProductos) {
				foreach ((array) $this->collCotProductos as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collTrayectos) {
				foreach ((array) $this->collTrayectos as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collReportes) {
				foreach ((array) $this->collReportes as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collInoMaestraSeas) {
				foreach ((array) $this->collInoMaestraSeas as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collInoMaestraAirs = null;
		$this->collCotProductos = null;
		$this->collTrayectos = null;
		$this->collReportes = null;
		$this->collInoMaestraSeas = null;
	}

} // BaseTransportador
