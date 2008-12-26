<?php

/**
 * Base class that represents a row from the 'tb_conceptos' table.
 *
 * 
 *
 * @package    lib.model.public.om
 */
abstract class BaseConcepto extends BaseObject  implements Persistent {


  const PEER = 'ConceptoPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        ConceptoPeer
	 */
	protected static $peer;

	/**
	 * The value for the ca_idconcepto field.
	 * @var        int
	 */
	protected $ca_idconcepto;

	/**
	 * The value for the ca_concepto field.
	 * @var        string
	 */
	protected $ca_concepto;

	/**
	 * The value for the ca_unidad field.
	 * @var        string
	 */
	protected $ca_unidad;

	/**
	 * The value for the ca_transporte field.
	 * @var        string
	 */
	protected $ca_transporte;

	/**
	 * The value for the ca_modalidad field.
	 * @var        string
	 */
	protected $ca_modalidad;

	/**
	 * The value for the ca_pregunta field.
	 * @var        string
	 */
	protected $ca_pregunta;

	/**
	 * The value for the ca_liminferior field.
	 * @var        int
	 */
	protected $ca_liminferior;

	/**
	 * @var        array CotOpcion[] Collection to store aggregation of CotOpcion objects.
	 */
	protected $collCotOpcions;

	/**
	 * @var        Criteria The criteria used to select the current contents of collCotOpcions.
	 */
	private $lastCotOpcionCriteria = null;

	/**
	 * @var        array CotContinuacion[] Collection to store aggregation of CotContinuacion objects.
	 */
	protected $collCotContinuacions;

	/**
	 * @var        Criteria The criteria used to select the current contents of collCotContinuacions.
	 */
	private $lastCotContinuacionCriteria = null;

	/**
	 * @var        array PricFlete[] Collection to store aggregation of PricFlete objects.
	 */
	protected $collPricFletes;

	/**
	 * @var        Criteria The criteria used to select the current contents of collPricFletes.
	 */
	private $lastPricFleteCriteria = null;

	/**
	 * @var        array PricFleteLog[] Collection to store aggregation of PricFleteLog objects.
	 */
	protected $collPricFleteLogs;

	/**
	 * @var        Criteria The criteria used to select the current contents of collPricFleteLogs.
	 */
	private $lastPricFleteLogCriteria = null;

	/**
	 * @var        array RepEquipo[] Collection to store aggregation of RepEquipo objects.
	 */
	protected $collRepEquipos;

	/**
	 * @var        Criteria The criteria used to select the current contents of collRepEquipos.
	 */
	private $lastRepEquipoCriteria = null;

	/**
	 * @var        array RepGasto[] Collection to store aggregation of RepGasto objects.
	 */
	protected $collRepGastos;

	/**
	 * @var        Criteria The criteria used to select the current contents of collRepGastos.
	 */
	private $lastRepGastoCriteria = null;

	/**
	 * @var        array RepTarifa[] Collection to store aggregation of RepTarifa objects.
	 */
	protected $collRepTarifas;

	/**
	 * @var        Criteria The criteria used to select the current contents of collRepTarifas.
	 */
	private $lastRepTarifaCriteria = null;

	/**
	 * @var        array Flete[] Collection to store aggregation of Flete objects.
	 */
	protected $collFletes;

	/**
	 * @var        Criteria The criteria used to select the current contents of collFletes.
	 */
	private $lastFleteCriteria = null;

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
	 * Initializes internal state of BaseConcepto object.
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
	 * Get the [ca_idconcepto] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdconcepto()
	{
		return $this->ca_idconcepto;
	}

	/**
	 * Get the [ca_concepto] column value.
	 * 
	 * @return     string
	 */
	public function getCaConcepto()
	{
		return $this->ca_concepto;
	}

	/**
	 * Get the [ca_unidad] column value.
	 * 
	 * @return     string
	 */
	public function getCaUnidad()
	{
		return $this->ca_unidad;
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
	 * Get the [ca_modalidad] column value.
	 * 
	 * @return     string
	 */
	public function getCaModalidad()
	{
		return $this->ca_modalidad;
	}

	/**
	 * Get the [ca_pregunta] column value.
	 * 
	 * @return     string
	 */
	public function getCaPregunta()
	{
		return $this->ca_pregunta;
	}

	/**
	 * Get the [ca_liminferior] column value.
	 * 
	 * @return     int
	 */
	public function getCaLiminferior()
	{
		return $this->ca_liminferior;
	}

	/**
	 * Set the value of [ca_idconcepto] column.
	 * 
	 * @param      int $v new value
	 * @return     Concepto The current object (for fluent API support)
	 */
	public function setCaIdconcepto($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idconcepto !== $v) {
			$this->ca_idconcepto = $v;
			$this->modifiedColumns[] = ConceptoPeer::CA_IDCONCEPTO;
		}

		return $this;
	} // setCaIdconcepto()

	/**
	 * Set the value of [ca_concepto] column.
	 * 
	 * @param      string $v new value
	 * @return     Concepto The current object (for fluent API support)
	 */
	public function setCaConcepto($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_concepto !== $v) {
			$this->ca_concepto = $v;
			$this->modifiedColumns[] = ConceptoPeer::CA_CONCEPTO;
		}

		return $this;
	} // setCaConcepto()

	/**
	 * Set the value of [ca_unidad] column.
	 * 
	 * @param      string $v new value
	 * @return     Concepto The current object (for fluent API support)
	 */
	public function setCaUnidad($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_unidad !== $v) {
			$this->ca_unidad = $v;
			$this->modifiedColumns[] = ConceptoPeer::CA_UNIDAD;
		}

		return $this;
	} // setCaUnidad()

	/**
	 * Set the value of [ca_transporte] column.
	 * 
	 * @param      string $v new value
	 * @return     Concepto The current object (for fluent API support)
	 */
	public function setCaTransporte($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_transporte !== $v) {
			$this->ca_transporte = $v;
			$this->modifiedColumns[] = ConceptoPeer::CA_TRANSPORTE;
		}

		return $this;
	} // setCaTransporte()

	/**
	 * Set the value of [ca_modalidad] column.
	 * 
	 * @param      string $v new value
	 * @return     Concepto The current object (for fluent API support)
	 */
	public function setCaModalidad($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_modalidad !== $v) {
			$this->ca_modalidad = $v;
			$this->modifiedColumns[] = ConceptoPeer::CA_MODALIDAD;
		}

		return $this;
	} // setCaModalidad()

	/**
	 * Set the value of [ca_pregunta] column.
	 * 
	 * @param      string $v new value
	 * @return     Concepto The current object (for fluent API support)
	 */
	public function setCaPregunta($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_pregunta !== $v) {
			$this->ca_pregunta = $v;
			$this->modifiedColumns[] = ConceptoPeer::CA_PREGUNTA;
		}

		return $this;
	} // setCaPregunta()

	/**
	 * Set the value of [ca_liminferior] column.
	 * 
	 * @param      int $v new value
	 * @return     Concepto The current object (for fluent API support)
	 */
	public function setCaLiminferior($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_liminferior !== $v) {
			$this->ca_liminferior = $v;
			$this->modifiedColumns[] = ConceptoPeer::CA_LIMINFERIOR;
		}

		return $this;
	} // setCaLiminferior()

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

			$this->ca_idconcepto = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_concepto = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_unidad = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_transporte = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_modalidad = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_pregunta = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_liminferior = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 7; // 7 = ConceptoPeer::NUM_COLUMNS - ConceptoPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Concepto object", $e);
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
			$con = Propel::getConnection(ConceptoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = ConceptoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->collCotOpcions = null;
			$this->lastCotOpcionCriteria = null;

			$this->collCotContinuacions = null;
			$this->lastCotContinuacionCriteria = null;

			$this->collPricFletes = null;
			$this->lastPricFleteCriteria = null;

			$this->collPricFleteLogs = null;
			$this->lastPricFleteLogCriteria = null;

			$this->collRepEquipos = null;
			$this->lastRepEquipoCriteria = null;

			$this->collRepGastos = null;
			$this->lastRepGastoCriteria = null;

			$this->collRepTarifas = null;
			$this->lastRepTarifaCriteria = null;

			$this->collFletes = null;
			$this->lastFleteCriteria = null;

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
			$con = Propel::getConnection(ConceptoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			ConceptoPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(ConceptoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			ConceptoPeer::addInstanceToPool($this);
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
				$this->modifiedColumns[] = ConceptoPeer::CA_IDCONCEPTO;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ConceptoPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setCaIdconcepto($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += ConceptoPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collCotOpcions !== null) {
				foreach ($this->collCotOpcions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCotContinuacions !== null) {
				foreach ($this->collCotContinuacions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPricFletes !== null) {
				foreach ($this->collPricFletes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPricFleteLogs !== null) {
				foreach ($this->collPricFleteLogs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRepEquipos !== null) {
				foreach ($this->collRepEquipos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRepGastos !== null) {
				foreach ($this->collRepGastos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRepTarifas !== null) {
				foreach ($this->collRepTarifas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collFletes !== null) {
				foreach ($this->collFletes as $referrerFK) {
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


			if (($retval = ConceptoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collCotOpcions !== null) {
					foreach ($this->collCotOpcions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCotContinuacions !== null) {
					foreach ($this->collCotContinuacions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPricFletes !== null) {
					foreach ($this->collPricFletes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPricFleteLogs !== null) {
					foreach ($this->collPricFleteLogs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRepEquipos !== null) {
					foreach ($this->collRepEquipos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRepGastos !== null) {
					foreach ($this->collRepGastos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRepTarifas !== null) {
					foreach ($this->collRepTarifas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collFletes !== null) {
					foreach ($this->collFletes as $referrerFK) {
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
		$pos = ConceptoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdconcepto();
				break;
			case 1:
				return $this->getCaConcepto();
				break;
			case 2:
				return $this->getCaUnidad();
				break;
			case 3:
				return $this->getCaTransporte();
				break;
			case 4:
				return $this->getCaModalidad();
				break;
			case 5:
				return $this->getCaPregunta();
				break;
			case 6:
				return $this->getCaLiminferior();
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
		$keys = ConceptoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdconcepto(),
			$keys[1] => $this->getCaConcepto(),
			$keys[2] => $this->getCaUnidad(),
			$keys[3] => $this->getCaTransporte(),
			$keys[4] => $this->getCaModalidad(),
			$keys[5] => $this->getCaPregunta(),
			$keys[6] => $this->getCaLiminferior(),
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
		$pos = ConceptoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdconcepto($value);
				break;
			case 1:
				$this->setCaConcepto($value);
				break;
			case 2:
				$this->setCaUnidad($value);
				break;
			case 3:
				$this->setCaTransporte($value);
				break;
			case 4:
				$this->setCaModalidad($value);
				break;
			case 5:
				$this->setCaPregunta($value);
				break;
			case 6:
				$this->setCaLiminferior($value);
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
		$keys = ConceptoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdconcepto($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaConcepto($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaUnidad($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaTransporte($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaModalidad($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaPregunta($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaLiminferior($arr[$keys[6]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);

		if ($this->isColumnModified(ConceptoPeer::CA_IDCONCEPTO)) $criteria->add(ConceptoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);
		if ($this->isColumnModified(ConceptoPeer::CA_CONCEPTO)) $criteria->add(ConceptoPeer::CA_CONCEPTO, $this->ca_concepto);
		if ($this->isColumnModified(ConceptoPeer::CA_UNIDAD)) $criteria->add(ConceptoPeer::CA_UNIDAD, $this->ca_unidad);
		if ($this->isColumnModified(ConceptoPeer::CA_TRANSPORTE)) $criteria->add(ConceptoPeer::CA_TRANSPORTE, $this->ca_transporte);
		if ($this->isColumnModified(ConceptoPeer::CA_MODALIDAD)) $criteria->add(ConceptoPeer::CA_MODALIDAD, $this->ca_modalidad);
		if ($this->isColumnModified(ConceptoPeer::CA_PREGUNTA)) $criteria->add(ConceptoPeer::CA_PREGUNTA, $this->ca_pregunta);
		if ($this->isColumnModified(ConceptoPeer::CA_LIMINFERIOR)) $criteria->add(ConceptoPeer::CA_LIMINFERIOR, $this->ca_liminferior);

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
		$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);

		$criteria->add(ConceptoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdconcepto();
	}

	/**
	 * Generic method to set the primary key (ca_idconcepto column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdconcepto($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Concepto (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaConcepto($this->ca_concepto);

		$copyObj->setCaUnidad($this->ca_unidad);

		$copyObj->setCaTransporte($this->ca_transporte);

		$copyObj->setCaModalidad($this->ca_modalidad);

		$copyObj->setCaPregunta($this->ca_pregunta);

		$copyObj->setCaLiminferior($this->ca_liminferior);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getCotOpcions() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addCotOpcion($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getCotContinuacions() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addCotContinuacion($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getPricFletes() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addPricFlete($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getPricFleteLogs() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addPricFleteLog($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getRepEquipos() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addRepEquipo($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getRepGastos() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addRepGasto($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getRepTarifas() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addRepTarifa($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getFletes() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addFlete($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setCaIdconcepto(NULL); // this is a auto-increment column, so set to default value

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
	 * @return     Concepto Clone of current object.
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
	 * @return     ConceptoPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ConceptoPeer();
		}
		return self::$peer;
	}

	/**
	 * Clears out the collCotOpcions collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addCotOpcions()
	 */
	public function clearCotOpcions()
	{
		$this->collCotOpcions = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collCotOpcions collection (array).
	 *
	 * By default this just sets the collCotOpcions collection to an empty array (like clearcollCotOpcions());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initCotOpcions()
	{
		$this->collCotOpcions = array();
	}

	/**
	 * Gets an array of CotOpcion objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Concepto has previously been saved, it will retrieve
	 * related CotOpcions from storage. If this Concepto is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array CotOpcion[]
	 * @throws     PropelException
	 */
	public function getCotOpcions($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotOpcions === null) {
			if ($this->isNew()) {
			   $this->collCotOpcions = array();
			} else {

				$criteria->add(CotOpcionPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				CotOpcionPeer::addSelectColumns($criteria);
				$this->collCotOpcions = CotOpcionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CotOpcionPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				CotOpcionPeer::addSelectColumns($criteria);
				if (!isset($this->lastCotOpcionCriteria) || !$this->lastCotOpcionCriteria->equals($criteria)) {
					$this->collCotOpcions = CotOpcionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCotOpcionCriteria = $criteria;
		return $this->collCotOpcions;
	}

	/**
	 * Returns the number of related CotOpcion objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related CotOpcion objects.
	 * @throws     PropelException
	 */
	public function countCotOpcions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collCotOpcions === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(CotOpcionPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$count = CotOpcionPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(CotOpcionPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				if (!isset($this->lastCotOpcionCriteria) || !$this->lastCotOpcionCriteria->equals($criteria)) {
					$count = CotOpcionPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collCotOpcions);
				}
			} else {
				$count = count($this->collCotOpcions);
			}
		}
		$this->lastCotOpcionCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a CotOpcion object to this object
	 * through the CotOpcion foreign key attribute.
	 *
	 * @param      CotOpcion $l CotOpcion
	 * @return     void
	 * @throws     PropelException
	 */
	public function addCotOpcion(CotOpcion $l)
	{
		if ($this->collCotOpcions === null) {
			$this->initCotOpcions();
		}
		if (!in_array($l, $this->collCotOpcions, true)) { // only add it if the **same** object is not already associated
			array_push($this->collCotOpcions, $l);
			$l->setConcepto($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Concepto is new, it will return
	 * an empty collection; or if this Concepto has previously
	 * been saved, it will retrieve related CotOpcions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Concepto.
	 */
	public function getCotOpcionsJoinCotProducto($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotOpcions === null) {
			if ($this->isNew()) {
				$this->collCotOpcions = array();
			} else {

				$criteria->add(CotOpcionPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$this->collCotOpcions = CotOpcionPeer::doSelectJoinCotProducto($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CotOpcionPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

			if (!isset($this->lastCotOpcionCriteria) || !$this->lastCotOpcionCriteria->equals($criteria)) {
				$this->collCotOpcions = CotOpcionPeer::doSelectJoinCotProducto($criteria, $con, $join_behavior);
			}
		}
		$this->lastCotOpcionCriteria = $criteria;

		return $this->collCotOpcions;
	}

	/**
	 * Clears out the collCotContinuacions collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addCotContinuacions()
	 */
	public function clearCotContinuacions()
	{
		$this->collCotContinuacions = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collCotContinuacions collection (array).
	 *
	 * By default this just sets the collCotContinuacions collection to an empty array (like clearcollCotContinuacions());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initCotContinuacions()
	{
		$this->collCotContinuacions = array();
	}

	/**
	 * Gets an array of CotContinuacion objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Concepto has previously been saved, it will retrieve
	 * related CotContinuacions from storage. If this Concepto is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array CotContinuacion[]
	 * @throws     PropelException
	 */
	public function getCotContinuacions($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotContinuacions === null) {
			if ($this->isNew()) {
			   $this->collCotContinuacions = array();
			} else {

				$criteria->add(CotContinuacionPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				CotContinuacionPeer::addSelectColumns($criteria);
				$this->collCotContinuacions = CotContinuacionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CotContinuacionPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				CotContinuacionPeer::addSelectColumns($criteria);
				if (!isset($this->lastCotContinuacionCriteria) || !$this->lastCotContinuacionCriteria->equals($criteria)) {
					$this->collCotContinuacions = CotContinuacionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCotContinuacionCriteria = $criteria;
		return $this->collCotContinuacions;
	}

	/**
	 * Returns the number of related CotContinuacion objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related CotContinuacion objects.
	 * @throws     PropelException
	 */
	public function countCotContinuacions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collCotContinuacions === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(CotContinuacionPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$count = CotContinuacionPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(CotContinuacionPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				if (!isset($this->lastCotContinuacionCriteria) || !$this->lastCotContinuacionCriteria->equals($criteria)) {
					$count = CotContinuacionPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collCotContinuacions);
				}
			} else {
				$count = count($this->collCotContinuacions);
			}
		}
		$this->lastCotContinuacionCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a CotContinuacion object to this object
	 * through the CotContinuacion foreign key attribute.
	 *
	 * @param      CotContinuacion $l CotContinuacion
	 * @return     void
	 * @throws     PropelException
	 */
	public function addCotContinuacion(CotContinuacion $l)
	{
		if ($this->collCotContinuacions === null) {
			$this->initCotContinuacions();
		}
		if (!in_array($l, $this->collCotContinuacions, true)) { // only add it if the **same** object is not already associated
			array_push($this->collCotContinuacions, $l);
			$l->setConcepto($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Concepto is new, it will return
	 * an empty collection; or if this Concepto has previously
	 * been saved, it will retrieve related CotContinuacions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Concepto.
	 */
	public function getCotContinuacionsJoinCotizacion($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotContinuacions === null) {
			if ($this->isNew()) {
				$this->collCotContinuacions = array();
			} else {

				$criteria->add(CotContinuacionPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$this->collCotContinuacions = CotContinuacionPeer::doSelectJoinCotizacion($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CotContinuacionPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

			if (!isset($this->lastCotContinuacionCriteria) || !$this->lastCotContinuacionCriteria->equals($criteria)) {
				$this->collCotContinuacions = CotContinuacionPeer::doSelectJoinCotizacion($criteria, $con, $join_behavior);
			}
		}
		$this->lastCotContinuacionCriteria = $criteria;

		return $this->collCotContinuacions;
	}

	/**
	 * Clears out the collPricFletes collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addPricFletes()
	 */
	public function clearPricFletes()
	{
		$this->collPricFletes = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collPricFletes collection (array).
	 *
	 * By default this just sets the collPricFletes collection to an empty array (like clearcollPricFletes());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initPricFletes()
	{
		$this->collPricFletes = array();
	}

	/**
	 * Gets an array of PricFlete objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Concepto has previously been saved, it will retrieve
	 * related PricFletes from storage. If this Concepto is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array PricFlete[]
	 * @throws     PropelException
	 */
	public function getPricFletes($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricFletes === null) {
			if ($this->isNew()) {
			   $this->collPricFletes = array();
			} else {

				$criteria->add(PricFletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				PricFletePeer::addSelectColumns($criteria);
				$this->collPricFletes = PricFletePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PricFletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				PricFletePeer::addSelectColumns($criteria);
				if (!isset($this->lastPricFleteCriteria) || !$this->lastPricFleteCriteria->equals($criteria)) {
					$this->collPricFletes = PricFletePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPricFleteCriteria = $criteria;
		return $this->collPricFletes;
	}

	/**
	 * Returns the number of related PricFlete objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related PricFlete objects.
	 * @throws     PropelException
	 */
	public function countPricFletes(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collPricFletes === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PricFletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$count = PricFletePeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(PricFletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				if (!isset($this->lastPricFleteCriteria) || !$this->lastPricFleteCriteria->equals($criteria)) {
					$count = PricFletePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPricFletes);
				}
			} else {
				$count = count($this->collPricFletes);
			}
		}
		$this->lastPricFleteCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a PricFlete object to this object
	 * through the PricFlete foreign key attribute.
	 *
	 * @param      PricFlete $l PricFlete
	 * @return     void
	 * @throws     PropelException
	 */
	public function addPricFlete(PricFlete $l)
	{
		if ($this->collPricFletes === null) {
			$this->initPricFletes();
		}
		if (!in_array($l, $this->collPricFletes, true)) { // only add it if the **same** object is not already associated
			array_push($this->collPricFletes, $l);
			$l->setConcepto($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Concepto is new, it will return
	 * an empty collection; or if this Concepto has previously
	 * been saved, it will retrieve related PricFletes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Concepto.
	 */
	public function getPricFletesJoinTrayecto($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricFletes === null) {
			if ($this->isNew()) {
				$this->collPricFletes = array();
			} else {

				$criteria->add(PricFletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$this->collPricFletes = PricFletePeer::doSelectJoinTrayecto($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PricFletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);

			if (!isset($this->lastPricFleteCriteria) || !$this->lastPricFleteCriteria->equals($criteria)) {
				$this->collPricFletes = PricFletePeer::doSelectJoinTrayecto($criteria, $con, $join_behavior);
			}
		}
		$this->lastPricFleteCriteria = $criteria;

		return $this->collPricFletes;
	}

	/**
	 * Clears out the collPricFleteLogs collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addPricFleteLogs()
	 */
	public function clearPricFleteLogs()
	{
		$this->collPricFleteLogs = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collPricFleteLogs collection (array).
	 *
	 * By default this just sets the collPricFleteLogs collection to an empty array (like clearcollPricFleteLogs());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initPricFleteLogs()
	{
		$this->collPricFleteLogs = array();
	}

	/**
	 * Gets an array of PricFleteLog objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Concepto has previously been saved, it will retrieve
	 * related PricFleteLogs from storage. If this Concepto is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array PricFleteLog[]
	 * @throws     PropelException
	 */
	public function getPricFleteLogs($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricFleteLogs === null) {
			if ($this->isNew()) {
			   $this->collPricFleteLogs = array();
			} else {

				$criteria->add(PricFleteLogPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				PricFleteLogPeer::addSelectColumns($criteria);
				$this->collPricFleteLogs = PricFleteLogPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PricFleteLogPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				PricFleteLogPeer::addSelectColumns($criteria);
				if (!isset($this->lastPricFleteLogCriteria) || !$this->lastPricFleteLogCriteria->equals($criteria)) {
					$this->collPricFleteLogs = PricFleteLogPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPricFleteLogCriteria = $criteria;
		return $this->collPricFleteLogs;
	}

	/**
	 * Returns the number of related PricFleteLog objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related PricFleteLog objects.
	 * @throws     PropelException
	 */
	public function countPricFleteLogs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collPricFleteLogs === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PricFleteLogPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$count = PricFleteLogPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(PricFleteLogPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				if (!isset($this->lastPricFleteLogCriteria) || !$this->lastPricFleteLogCriteria->equals($criteria)) {
					$count = PricFleteLogPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPricFleteLogs);
				}
			} else {
				$count = count($this->collPricFleteLogs);
			}
		}
		$this->lastPricFleteLogCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a PricFleteLog object to this object
	 * through the PricFleteLog foreign key attribute.
	 *
	 * @param      PricFleteLog $l PricFleteLog
	 * @return     void
	 * @throws     PropelException
	 */
	public function addPricFleteLog(PricFleteLog $l)
	{
		if ($this->collPricFleteLogs === null) {
			$this->initPricFleteLogs();
		}
		if (!in_array($l, $this->collPricFleteLogs, true)) { // only add it if the **same** object is not already associated
			array_push($this->collPricFleteLogs, $l);
			$l->setConcepto($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Concepto is new, it will return
	 * an empty collection; or if this Concepto has previously
	 * been saved, it will retrieve related PricFleteLogs from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Concepto.
	 */
	public function getPricFleteLogsJoinTrayecto($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricFleteLogs === null) {
			if ($this->isNew()) {
				$this->collPricFleteLogs = array();
			} else {

				$criteria->add(PricFleteLogPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$this->collPricFleteLogs = PricFleteLogPeer::doSelectJoinTrayecto($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PricFleteLogPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

			if (!isset($this->lastPricFleteLogCriteria) || !$this->lastPricFleteLogCriteria->equals($criteria)) {
				$this->collPricFleteLogs = PricFleteLogPeer::doSelectJoinTrayecto($criteria, $con, $join_behavior);
			}
		}
		$this->lastPricFleteLogCriteria = $criteria;

		return $this->collPricFleteLogs;
	}

	/**
	 * Clears out the collRepEquipos collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addRepEquipos()
	 */
	public function clearRepEquipos()
	{
		$this->collRepEquipos = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collRepEquipos collection (array).
	 *
	 * By default this just sets the collRepEquipos collection to an empty array (like clearcollRepEquipos());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initRepEquipos()
	{
		$this->collRepEquipos = array();
	}

	/**
	 * Gets an array of RepEquipo objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Concepto has previously been saved, it will retrieve
	 * related RepEquipos from storage. If this Concepto is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array RepEquipo[]
	 * @throws     PropelException
	 */
	public function getRepEquipos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepEquipos === null) {
			if ($this->isNew()) {
			   $this->collRepEquipos = array();
			} else {

				$criteria->add(RepEquipoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				RepEquipoPeer::addSelectColumns($criteria);
				$this->collRepEquipos = RepEquipoPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RepEquipoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				RepEquipoPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepEquipoCriteria) || !$this->lastRepEquipoCriteria->equals($criteria)) {
					$this->collRepEquipos = RepEquipoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepEquipoCriteria = $criteria;
		return $this->collRepEquipos;
	}

	/**
	 * Returns the number of related RepEquipo objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related RepEquipo objects.
	 * @throws     PropelException
	 */
	public function countRepEquipos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collRepEquipos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(RepEquipoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$count = RepEquipoPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(RepEquipoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				if (!isset($this->lastRepEquipoCriteria) || !$this->lastRepEquipoCriteria->equals($criteria)) {
					$count = RepEquipoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collRepEquipos);
				}
			} else {
				$count = count($this->collRepEquipos);
			}
		}
		$this->lastRepEquipoCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a RepEquipo object to this object
	 * through the RepEquipo foreign key attribute.
	 *
	 * @param      RepEquipo $l RepEquipo
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRepEquipo(RepEquipo $l)
	{
		if ($this->collRepEquipos === null) {
			$this->initRepEquipos();
		}
		if (!in_array($l, $this->collRepEquipos, true)) { // only add it if the **same** object is not already associated
			array_push($this->collRepEquipos, $l);
			$l->setConcepto($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Concepto is new, it will return
	 * an empty collection; or if this Concepto has previously
	 * been saved, it will retrieve related RepEquipos from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Concepto.
	 */
	public function getRepEquiposJoinReporte($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepEquipos === null) {
			if ($this->isNew()) {
				$this->collRepEquipos = array();
			} else {

				$criteria->add(RepEquipoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$this->collRepEquipos = RepEquipoPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RepEquipoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

			if (!isset($this->lastRepEquipoCriteria) || !$this->lastRepEquipoCriteria->equals($criteria)) {
				$this->collRepEquipos = RepEquipoPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		}
		$this->lastRepEquipoCriteria = $criteria;

		return $this->collRepEquipos;
	}

	/**
	 * Clears out the collRepGastos collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addRepGastos()
	 */
	public function clearRepGastos()
	{
		$this->collRepGastos = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collRepGastos collection (array).
	 *
	 * By default this just sets the collRepGastos collection to an empty array (like clearcollRepGastos());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initRepGastos()
	{
		$this->collRepGastos = array();
	}

	/**
	 * Gets an array of RepGasto objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Concepto has previously been saved, it will retrieve
	 * related RepGastos from storage. If this Concepto is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array RepGasto[]
	 * @throws     PropelException
	 */
	public function getRepGastos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepGastos === null) {
			if ($this->isNew()) {
			   $this->collRepGastos = array();
			} else {

				$criteria->add(RepGastoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				RepGastoPeer::addSelectColumns($criteria);
				$this->collRepGastos = RepGastoPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RepGastoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				RepGastoPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepGastoCriteria) || !$this->lastRepGastoCriteria->equals($criteria)) {
					$this->collRepGastos = RepGastoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepGastoCriteria = $criteria;
		return $this->collRepGastos;
	}

	/**
	 * Returns the number of related RepGasto objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related RepGasto objects.
	 * @throws     PropelException
	 */
	public function countRepGastos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collRepGastos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(RepGastoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$count = RepGastoPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(RepGastoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				if (!isset($this->lastRepGastoCriteria) || !$this->lastRepGastoCriteria->equals($criteria)) {
					$count = RepGastoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collRepGastos);
				}
			} else {
				$count = count($this->collRepGastos);
			}
		}
		$this->lastRepGastoCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a RepGasto object to this object
	 * through the RepGasto foreign key attribute.
	 *
	 * @param      RepGasto $l RepGasto
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRepGasto(RepGasto $l)
	{
		if ($this->collRepGastos === null) {
			$this->initRepGastos();
		}
		if (!in_array($l, $this->collRepGastos, true)) { // only add it if the **same** object is not already associated
			array_push($this->collRepGastos, $l);
			$l->setConcepto($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Concepto is new, it will return
	 * an empty collection; or if this Concepto has previously
	 * been saved, it will retrieve related RepGastos from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Concepto.
	 */
	public function getRepGastosJoinReporte($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepGastos === null) {
			if ($this->isNew()) {
				$this->collRepGastos = array();
			} else {

				$criteria->add(RepGastoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$this->collRepGastos = RepGastoPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RepGastoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

			if (!isset($this->lastRepGastoCriteria) || !$this->lastRepGastoCriteria->equals($criteria)) {
				$this->collRepGastos = RepGastoPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		}
		$this->lastRepGastoCriteria = $criteria;

		return $this->collRepGastos;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Concepto is new, it will return
	 * an empty collection; or if this Concepto has previously
	 * been saved, it will retrieve related RepGastos from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Concepto.
	 */
	public function getRepGastosJoinTipoRecargo($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepGastos === null) {
			if ($this->isNew()) {
				$this->collRepGastos = array();
			} else {

				$criteria->add(RepGastoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$this->collRepGastos = RepGastoPeer::doSelectJoinTipoRecargo($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RepGastoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

			if (!isset($this->lastRepGastoCriteria) || !$this->lastRepGastoCriteria->equals($criteria)) {
				$this->collRepGastos = RepGastoPeer::doSelectJoinTipoRecargo($criteria, $con, $join_behavior);
			}
		}
		$this->lastRepGastoCriteria = $criteria;

		return $this->collRepGastos;
	}

	/**
	 * Clears out the collRepTarifas collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addRepTarifas()
	 */
	public function clearRepTarifas()
	{
		$this->collRepTarifas = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collRepTarifas collection (array).
	 *
	 * By default this just sets the collRepTarifas collection to an empty array (like clearcollRepTarifas());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initRepTarifas()
	{
		$this->collRepTarifas = array();
	}

	/**
	 * Gets an array of RepTarifa objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Concepto has previously been saved, it will retrieve
	 * related RepTarifas from storage. If this Concepto is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array RepTarifa[]
	 * @throws     PropelException
	 */
	public function getRepTarifas($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepTarifas === null) {
			if ($this->isNew()) {
			   $this->collRepTarifas = array();
			} else {

				$criteria->add(RepTarifaPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				RepTarifaPeer::addSelectColumns($criteria);
				$this->collRepTarifas = RepTarifaPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RepTarifaPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				RepTarifaPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepTarifaCriteria) || !$this->lastRepTarifaCriteria->equals($criteria)) {
					$this->collRepTarifas = RepTarifaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepTarifaCriteria = $criteria;
		return $this->collRepTarifas;
	}

	/**
	 * Returns the number of related RepTarifa objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related RepTarifa objects.
	 * @throws     PropelException
	 */
	public function countRepTarifas(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collRepTarifas === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(RepTarifaPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$count = RepTarifaPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(RepTarifaPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				if (!isset($this->lastRepTarifaCriteria) || !$this->lastRepTarifaCriteria->equals($criteria)) {
					$count = RepTarifaPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collRepTarifas);
				}
			} else {
				$count = count($this->collRepTarifas);
			}
		}
		$this->lastRepTarifaCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a RepTarifa object to this object
	 * through the RepTarifa foreign key attribute.
	 *
	 * @param      RepTarifa $l RepTarifa
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRepTarifa(RepTarifa $l)
	{
		if ($this->collRepTarifas === null) {
			$this->initRepTarifas();
		}
		if (!in_array($l, $this->collRepTarifas, true)) { // only add it if the **same** object is not already associated
			array_push($this->collRepTarifas, $l);
			$l->setConcepto($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Concepto is new, it will return
	 * an empty collection; or if this Concepto has previously
	 * been saved, it will retrieve related RepTarifas from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Concepto.
	 */
	public function getRepTarifasJoinReporte($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepTarifas === null) {
			if ($this->isNew()) {
				$this->collRepTarifas = array();
			} else {

				$criteria->add(RepTarifaPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$this->collRepTarifas = RepTarifaPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RepTarifaPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

			if (!isset($this->lastRepTarifaCriteria) || !$this->lastRepTarifaCriteria->equals($criteria)) {
				$this->collRepTarifas = RepTarifaPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		}
		$this->lastRepTarifaCriteria = $criteria;

		return $this->collRepTarifas;
	}

	/**
	 * Clears out the collFletes collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addFletes()
	 */
	public function clearFletes()
	{
		$this->collFletes = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collFletes collection (array).
	 *
	 * By default this just sets the collFletes collection to an empty array (like clearcollFletes());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initFletes()
	{
		$this->collFletes = array();
	}

	/**
	 * Gets an array of Flete objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Concepto has previously been saved, it will retrieve
	 * related Fletes from storage. If this Concepto is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array Flete[]
	 * @throws     PropelException
	 */
	public function getFletes($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFletes === null) {
			if ($this->isNew()) {
			   $this->collFletes = array();
			} else {

				$criteria->add(FletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				FletePeer::addSelectColumns($criteria);
				$this->collFletes = FletePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(FletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				FletePeer::addSelectColumns($criteria);
				if (!isset($this->lastFleteCriteria) || !$this->lastFleteCriteria->equals($criteria)) {
					$this->collFletes = FletePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFleteCriteria = $criteria;
		return $this->collFletes;
	}

	/**
	 * Returns the number of related Flete objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Flete objects.
	 * @throws     PropelException
	 */
	public function countFletes(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collFletes === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(FletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$count = FletePeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(FletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				if (!isset($this->lastFleteCriteria) || !$this->lastFleteCriteria->equals($criteria)) {
					$count = FletePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collFletes);
				}
			} else {
				$count = count($this->collFletes);
			}
		}
		$this->lastFleteCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a Flete object to this object
	 * through the Flete foreign key attribute.
	 *
	 * @param      Flete $l Flete
	 * @return     void
	 * @throws     PropelException
	 */
	public function addFlete(Flete $l)
	{
		if ($this->collFletes === null) {
			$this->initFletes();
		}
		if (!in_array($l, $this->collFletes, true)) { // only add it if the **same** object is not already associated
			array_push($this->collFletes, $l);
			$l->setConcepto($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Concepto is new, it will return
	 * an empty collection; or if this Concepto has previously
	 * been saved, it will retrieve related Fletes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Concepto.
	 */
	public function getFletesJoinTrayecto($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFletes === null) {
			if ($this->isNew()) {
				$this->collFletes = array();
			} else {

				$criteria->add(FletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$this->collFletes = FletePeer::doSelectJoinTrayecto($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(FletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);

			if (!isset($this->lastFleteCriteria) || !$this->lastFleteCriteria->equals($criteria)) {
				$this->collFletes = FletePeer::doSelectJoinTrayecto($criteria, $con, $join_behavior);
			}
		}
		$this->lastFleteCriteria = $criteria;

		return $this->collFletes;
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
			if ($this->collCotOpcions) {
				foreach ((array) $this->collCotOpcions as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collCotContinuacions) {
				foreach ((array) $this->collCotContinuacions as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collPricFletes) {
				foreach ((array) $this->collPricFletes as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collPricFleteLogs) {
				foreach ((array) $this->collPricFleteLogs as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collRepEquipos) {
				foreach ((array) $this->collRepEquipos as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collRepGastos) {
				foreach ((array) $this->collRepGastos as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collRepTarifas) {
				foreach ((array) $this->collRepTarifas as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collFletes) {
				foreach ((array) $this->collFletes as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collCotOpcions = null;
		$this->collCotContinuacions = null;
		$this->collPricFletes = null;
		$this->collPricFleteLogs = null;
		$this->collRepEquipos = null;
		$this->collRepGastos = null;
		$this->collRepTarifas = null;
		$this->collFletes = null;
	}

} // BaseConcepto
