<?php

/**
 * Base class that represents a row from the 'tb_tiporecargo' table.
 *
 * 
 *
 * @package    lib.model.public.om
 */
abstract class BaseTipoRecargo extends BaseObject  implements Persistent {


  const PEER = 'TipoRecargoPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        TipoRecargoPeer
	 */
	protected static $peer;

	/**
	 * The value for the ca_idrecargo field.
	 * @var        int
	 */
	protected $ca_idrecargo;

	/**
	 * The value for the ca_recargo field.
	 * @var        string
	 */
	protected $ca_recargo;

	/**
	 * The value for the ca_tipo field.
	 * @var        string
	 */
	protected $ca_tipo;

	/**
	 * The value for the ca_transporte field.
	 * @var        string
	 */
	protected $ca_transporte;

	/**
	 * The value for the ca_incoterms field.
	 * @var        string
	 */
	protected $ca_incoterms;

	/**
	 * The value for the ca_reporte field.
	 * @var        string
	 */
	protected $ca_reporte;

	/**
	 * The value for the ca_impoexpo field.
	 * @var        string
	 */
	protected $ca_impoexpo;

	/**
	 * The value for the ca_aplicacion field.
	 * @var        string
	 */
	protected $ca_aplicacion;

	/**
	 * @var        array CotRecargo[] Collection to store aggregation of CotRecargo objects.
	 */
	protected $collCotRecargos;

	/**
	 * @var        Criteria The criteria used to select the current contents of collCotRecargos.
	 */
	private $lastCotRecargoCriteria = null;

	/**
	 * @var        array PricRecargoxConcepto[] Collection to store aggregation of PricRecargoxConcepto objects.
	 */
	protected $collPricRecargoxConceptos;

	/**
	 * @var        Criteria The criteria used to select the current contents of collPricRecargoxConceptos.
	 */
	private $lastPricRecargoxConceptoCriteria = null;

	/**
	 * @var        array PricRecargoxConceptoLog[] Collection to store aggregation of PricRecargoxConceptoLog objects.
	 */
	protected $collPricRecargoxConceptoLogs;

	/**
	 * @var        Criteria The criteria used to select the current contents of collPricRecargoxConceptoLogs.
	 */
	private $lastPricRecargoxConceptoLogCriteria = null;

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
	 * @var        array PricRecargosxLinea[] Collection to store aggregation of PricRecargosxLinea objects.
	 */
	protected $collPricRecargosxLineas;

	/**
	 * @var        Criteria The criteria used to select the current contents of collPricRecargosxLineas.
	 */
	private $lastPricRecargosxLineaCriteria = null;

	/**
	 * @var        array PricRecargosxLineaLog[] Collection to store aggregation of PricRecargosxLineaLog objects.
	 */
	protected $collPricRecargosxLineaLogs;

	/**
	 * @var        Criteria The criteria used to select the current contents of collPricRecargosxLineaLogs.
	 */
	private $lastPricRecargosxLineaLogCriteria = null;

	/**
	 * @var        array RepGasto[] Collection to store aggregation of RepGasto objects.
	 */
	protected $collRepGastos;

	/**
	 * @var        Criteria The criteria used to select the current contents of collRepGastos.
	 */
	private $lastRepGastoCriteria = null;

	/**
	 * @var        array RecargoFlete[] Collection to store aggregation of RecargoFlete objects.
	 */
	protected $collRecargoFletes;

	/**
	 * @var        Criteria The criteria used to select the current contents of collRecargoFletes.
	 */
	private $lastRecargoFleteCriteria = null;

	/**
	 * @var        array RecargoFleteTraf[] Collection to store aggregation of RecargoFleteTraf objects.
	 */
	protected $collRecargoFleteTrafs;

	/**
	 * @var        Criteria The criteria used to select the current contents of collRecargoFleteTrafs.
	 */
	private $lastRecargoFleteTrafCriteria = null;

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
	 * Initializes internal state of BaseTipoRecargo object.
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
	 * Get the [ca_idrecargo] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdrecargo()
	{
		return $this->ca_idrecargo;
	}

	/**
	 * Get the [ca_recargo] column value.
	 * 
	 * @return     string
	 */
	public function getCaRecargo()
	{
		return $this->ca_recargo;
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
	 * Get the [ca_transporte] column value.
	 * 
	 * @return     string
	 */
	public function getCaTransporte()
	{
		return $this->ca_transporte;
	}

	/**
	 * Get the [ca_incoterms] column value.
	 * 
	 * @return     string
	 */
	public function getCaIncoterms()
	{
		return $this->ca_incoterms;
	}

	/**
	 * Get the [ca_reporte] column value.
	 * 
	 * @return     string
	 */
	public function getCaReporte()
	{
		return $this->ca_reporte;
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
	 * Get the [ca_aplicacion] column value.
	 * 
	 * @return     string
	 */
	public function getCaAplicacion()
	{
		return $this->ca_aplicacion;
	}

	/**
	 * Set the value of [ca_idrecargo] column.
	 * 
	 * @param      int $v new value
	 * @return     TipoRecargo The current object (for fluent API support)
	 */
	public function setCaIdrecargo($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idrecargo !== $v) {
			$this->ca_idrecargo = $v;
			$this->modifiedColumns[] = TipoRecargoPeer::CA_IDRECARGO;
		}

		return $this;
	} // setCaIdrecargo()

	/**
	 * Set the value of [ca_recargo] column.
	 * 
	 * @param      string $v new value
	 * @return     TipoRecargo The current object (for fluent API support)
	 */
	public function setCaRecargo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_recargo !== $v) {
			$this->ca_recargo = $v;
			$this->modifiedColumns[] = TipoRecargoPeer::CA_RECARGO;
		}

		return $this;
	} // setCaRecargo()

	/**
	 * Set the value of [ca_tipo] column.
	 * 
	 * @param      string $v new value
	 * @return     TipoRecargo The current object (for fluent API support)
	 */
	public function setCaTipo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_tipo !== $v) {
			$this->ca_tipo = $v;
			$this->modifiedColumns[] = TipoRecargoPeer::CA_TIPO;
		}

		return $this;
	} // setCaTipo()

	/**
	 * Set the value of [ca_transporte] column.
	 * 
	 * @param      string $v new value
	 * @return     TipoRecargo The current object (for fluent API support)
	 */
	public function setCaTransporte($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_transporte !== $v) {
			$this->ca_transporte = $v;
			$this->modifiedColumns[] = TipoRecargoPeer::CA_TRANSPORTE;
		}

		return $this;
	} // setCaTransporte()

	/**
	 * Set the value of [ca_incoterms] column.
	 * 
	 * @param      string $v new value
	 * @return     TipoRecargo The current object (for fluent API support)
	 */
	public function setCaIncoterms($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_incoterms !== $v) {
			$this->ca_incoterms = $v;
			$this->modifiedColumns[] = TipoRecargoPeer::CA_INCOTERMS;
		}

		return $this;
	} // setCaIncoterms()

	/**
	 * Set the value of [ca_reporte] column.
	 * 
	 * @param      string $v new value
	 * @return     TipoRecargo The current object (for fluent API support)
	 */
	public function setCaReporte($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_reporte !== $v) {
			$this->ca_reporte = $v;
			$this->modifiedColumns[] = TipoRecargoPeer::CA_REPORTE;
		}

		return $this;
	} // setCaReporte()

	/**
	 * Set the value of [ca_impoexpo] column.
	 * 
	 * @param      string $v new value
	 * @return     TipoRecargo The current object (for fluent API support)
	 */
	public function setCaImpoexpo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_impoexpo !== $v) {
			$this->ca_impoexpo = $v;
			$this->modifiedColumns[] = TipoRecargoPeer::CA_IMPOEXPO;
		}

		return $this;
	} // setCaImpoexpo()

	/**
	 * Set the value of [ca_aplicacion] column.
	 * 
	 * @param      string $v new value
	 * @return     TipoRecargo The current object (for fluent API support)
	 */
	public function setCaAplicacion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_aplicacion !== $v) {
			$this->ca_aplicacion = $v;
			$this->modifiedColumns[] = TipoRecargoPeer::CA_APLICACION;
		}

		return $this;
	} // setCaAplicacion()

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

			$this->ca_idrecargo = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_recargo = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_tipo = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_transporte = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_incoterms = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_reporte = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_impoexpo = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_aplicacion = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 8; // 8 = TipoRecargoPeer::NUM_COLUMNS - TipoRecargoPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating TipoRecargo object", $e);
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
			$con = Propel::getConnection(TipoRecargoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = TipoRecargoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->collCotRecargos = null;
			$this->lastCotRecargoCriteria = null;

			$this->collPricRecargoxConceptos = null;
			$this->lastPricRecargoxConceptoCriteria = null;

			$this->collPricRecargoxConceptoLogs = null;
			$this->lastPricRecargoxConceptoLogCriteria = null;

			$this->collPricRecargosxCiudads = null;
			$this->lastPricRecargosxCiudadCriteria = null;

			$this->collPricRecargosxCiudadLogs = null;
			$this->lastPricRecargosxCiudadLogCriteria = null;

			$this->collPricRecargosxLineas = null;
			$this->lastPricRecargosxLineaCriteria = null;

			$this->collPricRecargosxLineaLogs = null;
			$this->lastPricRecargosxLineaLogCriteria = null;

			$this->collRepGastos = null;
			$this->lastRepGastoCriteria = null;

			$this->collRecargoFletes = null;
			$this->lastRecargoFleteCriteria = null;

			$this->collRecargoFleteTrafs = null;
			$this->lastRecargoFleteTrafCriteria = null;

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
			$con = Propel::getConnection(TipoRecargoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			TipoRecargoPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(TipoRecargoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			TipoRecargoPeer::addInstanceToPool($this);
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
				$this->modifiedColumns[] = TipoRecargoPeer::CA_IDRECARGO;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TipoRecargoPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setCaIdrecargo($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += TipoRecargoPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collCotRecargos !== null) {
				foreach ($this->collCotRecargos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPricRecargoxConceptos !== null) {
				foreach ($this->collPricRecargoxConceptos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPricRecargoxConceptoLogs !== null) {
				foreach ($this->collPricRecargoxConceptoLogs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
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

			if ($this->collPricRecargosxLineas !== null) {
				foreach ($this->collPricRecargosxLineas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPricRecargosxLineaLogs !== null) {
				foreach ($this->collPricRecargosxLineaLogs as $referrerFK) {
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

			if ($this->collRecargoFletes !== null) {
				foreach ($this->collRecargoFletes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRecargoFleteTrafs !== null) {
				foreach ($this->collRecargoFleteTrafs as $referrerFK) {
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


			if (($retval = TipoRecargoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collCotRecargos !== null) {
					foreach ($this->collCotRecargos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPricRecargoxConceptos !== null) {
					foreach ($this->collPricRecargoxConceptos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPricRecargoxConceptoLogs !== null) {
					foreach ($this->collPricRecargoxConceptoLogs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
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

				if ($this->collPricRecargosxLineas !== null) {
					foreach ($this->collPricRecargosxLineas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPricRecargosxLineaLogs !== null) {
					foreach ($this->collPricRecargosxLineaLogs as $referrerFK) {
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

				if ($this->collRecargoFletes !== null) {
					foreach ($this->collRecargoFletes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRecargoFleteTrafs !== null) {
					foreach ($this->collRecargoFleteTrafs as $referrerFK) {
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
		$pos = TipoRecargoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdrecargo();
				break;
			case 1:
				return $this->getCaRecargo();
				break;
			case 2:
				return $this->getCaTipo();
				break;
			case 3:
				return $this->getCaTransporte();
				break;
			case 4:
				return $this->getCaIncoterms();
				break;
			case 5:
				return $this->getCaReporte();
				break;
			case 6:
				return $this->getCaImpoexpo();
				break;
			case 7:
				return $this->getCaAplicacion();
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
		$keys = TipoRecargoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdrecargo(),
			$keys[1] => $this->getCaRecargo(),
			$keys[2] => $this->getCaTipo(),
			$keys[3] => $this->getCaTransporte(),
			$keys[4] => $this->getCaIncoterms(),
			$keys[5] => $this->getCaReporte(),
			$keys[6] => $this->getCaImpoexpo(),
			$keys[7] => $this->getCaAplicacion(),
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
		$pos = TipoRecargoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdrecargo($value);
				break;
			case 1:
				$this->setCaRecargo($value);
				break;
			case 2:
				$this->setCaTipo($value);
				break;
			case 3:
				$this->setCaTransporte($value);
				break;
			case 4:
				$this->setCaIncoterms($value);
				break;
			case 5:
				$this->setCaReporte($value);
				break;
			case 6:
				$this->setCaImpoexpo($value);
				break;
			case 7:
				$this->setCaAplicacion($value);
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
		$keys = TipoRecargoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdrecargo($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaRecargo($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaTipo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaTransporte($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaIncoterms($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaReporte($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaImpoexpo($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaAplicacion($arr[$keys[7]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);

		if ($this->isColumnModified(TipoRecargoPeer::CA_IDRECARGO)) $criteria->add(TipoRecargoPeer::CA_IDRECARGO, $this->ca_idrecargo);
		if ($this->isColumnModified(TipoRecargoPeer::CA_RECARGO)) $criteria->add(TipoRecargoPeer::CA_RECARGO, $this->ca_recargo);
		if ($this->isColumnModified(TipoRecargoPeer::CA_TIPO)) $criteria->add(TipoRecargoPeer::CA_TIPO, $this->ca_tipo);
		if ($this->isColumnModified(TipoRecargoPeer::CA_TRANSPORTE)) $criteria->add(TipoRecargoPeer::CA_TRANSPORTE, $this->ca_transporte);
		if ($this->isColumnModified(TipoRecargoPeer::CA_INCOTERMS)) $criteria->add(TipoRecargoPeer::CA_INCOTERMS, $this->ca_incoterms);
		if ($this->isColumnModified(TipoRecargoPeer::CA_REPORTE)) $criteria->add(TipoRecargoPeer::CA_REPORTE, $this->ca_reporte);
		if ($this->isColumnModified(TipoRecargoPeer::CA_IMPOEXPO)) $criteria->add(TipoRecargoPeer::CA_IMPOEXPO, $this->ca_impoexpo);
		if ($this->isColumnModified(TipoRecargoPeer::CA_APLICACION)) $criteria->add(TipoRecargoPeer::CA_APLICACION, $this->ca_aplicacion);

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
		$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);

		$criteria->add(TipoRecargoPeer::CA_IDRECARGO, $this->ca_idrecargo);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdrecargo();
	}

	/**
	 * Generic method to set the primary key (ca_idrecargo column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdrecargo($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of TipoRecargo (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaRecargo($this->ca_recargo);

		$copyObj->setCaTipo($this->ca_tipo);

		$copyObj->setCaTransporte($this->ca_transporte);

		$copyObj->setCaIncoterms($this->ca_incoterms);

		$copyObj->setCaReporte($this->ca_reporte);

		$copyObj->setCaImpoexpo($this->ca_impoexpo);

		$copyObj->setCaAplicacion($this->ca_aplicacion);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getCotRecargos() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addCotRecargo($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getPricRecargoxConceptos() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addPricRecargoxConcepto($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getPricRecargoxConceptoLogs() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addPricRecargoxConceptoLog($relObj->copy($deepCopy));
				}
			}

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

			foreach ($this->getPricRecargosxLineas() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addPricRecargosxLinea($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getPricRecargosxLineaLogs() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addPricRecargosxLineaLog($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getRepGastos() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addRepGasto($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getRecargoFletes() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addRecargoFlete($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getRecargoFleteTrafs() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addRecargoFleteTraf($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setCaIdrecargo(NULL); // this is a auto-increment column, so set to default value

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
	 * @return     TipoRecargo Clone of current object.
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
	 * @return     TipoRecargoPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new TipoRecargoPeer();
		}
		return self::$peer;
	}

	/**
	 * Clears out the collCotRecargos collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addCotRecargos()
	 */
	public function clearCotRecargos()
	{
		$this->collCotRecargos = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collCotRecargos collection (array).
	 *
	 * By default this just sets the collCotRecargos collection to an empty array (like clearcollCotRecargos());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initCotRecargos()
	{
		$this->collCotRecargos = array();
	}

	/**
	 * Gets an array of CotRecargo objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this TipoRecargo has previously been saved, it will retrieve
	 * related CotRecargos from storage. If this TipoRecargo is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array CotRecargo[]
	 * @throws     PropelException
	 */
	public function getCotRecargos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotRecargos === null) {
			if ($this->isNew()) {
			   $this->collCotRecargos = array();
			} else {

				$criteria->add(CotRecargoPeer::CA_IDRECARGO, $this->ca_idrecargo);

				CotRecargoPeer::addSelectColumns($criteria);
				$this->collCotRecargos = CotRecargoPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CotRecargoPeer::CA_IDRECARGO, $this->ca_idrecargo);

				CotRecargoPeer::addSelectColumns($criteria);
				if (!isset($this->lastCotRecargoCriteria) || !$this->lastCotRecargoCriteria->equals($criteria)) {
					$this->collCotRecargos = CotRecargoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCotRecargoCriteria = $criteria;
		return $this->collCotRecargos;
	}

	/**
	 * Returns the number of related CotRecargo objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related CotRecargo objects.
	 * @throws     PropelException
	 */
	public function countCotRecargos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collCotRecargos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(CotRecargoPeer::CA_IDRECARGO, $this->ca_idrecargo);

				$count = CotRecargoPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(CotRecargoPeer::CA_IDRECARGO, $this->ca_idrecargo);

				if (!isset($this->lastCotRecargoCriteria) || !$this->lastCotRecargoCriteria->equals($criteria)) {
					$count = CotRecargoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collCotRecargos);
				}
			} else {
				$count = count($this->collCotRecargos);
			}
		}
		$this->lastCotRecargoCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a CotRecargo object to this object
	 * through the CotRecargo foreign key attribute.
	 *
	 * @param      CotRecargo $l CotRecargo
	 * @return     void
	 * @throws     PropelException
	 */
	public function addCotRecargo(CotRecargo $l)
	{
		if ($this->collCotRecargos === null) {
			$this->initCotRecargos();
		}
		if (!in_array($l, $this->collCotRecargos, true)) { // only add it if the **same** object is not already associated
			array_push($this->collCotRecargos, $l);
			$l->setTipoRecargo($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TipoRecargo is new, it will return
	 * an empty collection; or if this TipoRecargo has previously
	 * been saved, it will retrieve related CotRecargos from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TipoRecargo.
	 */
	public function getCotRecargosJoinCotOpcion($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotRecargos === null) {
			if ($this->isNew()) {
				$this->collCotRecargos = array();
			} else {

				$criteria->add(CotRecargoPeer::CA_IDRECARGO, $this->ca_idrecargo);

				$this->collCotRecargos = CotRecargoPeer::doSelectJoinCotOpcion($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CotRecargoPeer::CA_IDRECARGO, $this->ca_idrecargo);

			if (!isset($this->lastCotRecargoCriteria) || !$this->lastCotRecargoCriteria->equals($criteria)) {
				$this->collCotRecargos = CotRecargoPeer::doSelectJoinCotOpcion($criteria, $con, $join_behavior);
			}
		}
		$this->lastCotRecargoCriteria = $criteria;

		return $this->collCotRecargos;
	}

	/**
	 * Clears out the collPricRecargoxConceptos collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addPricRecargoxConceptos()
	 */
	public function clearPricRecargoxConceptos()
	{
		$this->collPricRecargoxConceptos = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collPricRecargoxConceptos collection (array).
	 *
	 * By default this just sets the collPricRecargoxConceptos collection to an empty array (like clearcollPricRecargoxConceptos());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initPricRecargoxConceptos()
	{
		$this->collPricRecargoxConceptos = array();
	}

	/**
	 * Gets an array of PricRecargoxConcepto objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this TipoRecargo has previously been saved, it will retrieve
	 * related PricRecargoxConceptos from storage. If this TipoRecargo is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array PricRecargoxConcepto[]
	 * @throws     PropelException
	 */
	public function getPricRecargoxConceptos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargoxConceptos === null) {
			if ($this->isNew()) {
			   $this->collPricRecargoxConceptos = array();
			} else {

				$criteria->add(PricRecargoxConceptoPeer::CA_IDRECARGO, $this->ca_idrecargo);

				PricRecargoxConceptoPeer::addSelectColumns($criteria);
				$this->collPricRecargoxConceptos = PricRecargoxConceptoPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PricRecargoxConceptoPeer::CA_IDRECARGO, $this->ca_idrecargo);

				PricRecargoxConceptoPeer::addSelectColumns($criteria);
				if (!isset($this->lastPricRecargoxConceptoCriteria) || !$this->lastPricRecargoxConceptoCriteria->equals($criteria)) {
					$this->collPricRecargoxConceptos = PricRecargoxConceptoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPricRecargoxConceptoCriteria = $criteria;
		return $this->collPricRecargoxConceptos;
	}

	/**
	 * Returns the number of related PricRecargoxConcepto objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related PricRecargoxConcepto objects.
	 * @throws     PropelException
	 */
	public function countPricRecargoxConceptos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collPricRecargoxConceptos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PricRecargoxConceptoPeer::CA_IDRECARGO, $this->ca_idrecargo);

				$count = PricRecargoxConceptoPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(PricRecargoxConceptoPeer::CA_IDRECARGO, $this->ca_idrecargo);

				if (!isset($this->lastPricRecargoxConceptoCriteria) || !$this->lastPricRecargoxConceptoCriteria->equals($criteria)) {
					$count = PricRecargoxConceptoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPricRecargoxConceptos);
				}
			} else {
				$count = count($this->collPricRecargoxConceptos);
			}
		}
		$this->lastPricRecargoxConceptoCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a PricRecargoxConcepto object to this object
	 * through the PricRecargoxConcepto foreign key attribute.
	 *
	 * @param      PricRecargoxConcepto $l PricRecargoxConcepto
	 * @return     void
	 * @throws     PropelException
	 */
	public function addPricRecargoxConcepto(PricRecargoxConcepto $l)
	{
		if ($this->collPricRecargoxConceptos === null) {
			$this->initPricRecargoxConceptos();
		}
		if (!in_array($l, $this->collPricRecargoxConceptos, true)) { // only add it if the **same** object is not already associated
			array_push($this->collPricRecargoxConceptos, $l);
			$l->setTipoRecargo($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TipoRecargo is new, it will return
	 * an empty collection; or if this TipoRecargo has previously
	 * been saved, it will retrieve related PricRecargoxConceptos from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TipoRecargo.
	 */
	public function getPricRecargoxConceptosJoinPricFlete($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargoxConceptos === null) {
			if ($this->isNew()) {
				$this->collPricRecargoxConceptos = array();
			} else {

				$criteria->add(PricRecargoxConceptoPeer::CA_IDRECARGO, $this->ca_idrecargo);

				$this->collPricRecargoxConceptos = PricRecargoxConceptoPeer::doSelectJoinPricFlete($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PricRecargoxConceptoPeer::CA_IDRECARGO, $this->ca_idrecargo);

			if (!isset($this->lastPricRecargoxConceptoCriteria) || !$this->lastPricRecargoxConceptoCriteria->equals($criteria)) {
				$this->collPricRecargoxConceptos = PricRecargoxConceptoPeer::doSelectJoinPricFlete($criteria, $con, $join_behavior);
			}
		}
		$this->lastPricRecargoxConceptoCriteria = $criteria;

		return $this->collPricRecargoxConceptos;
	}

	/**
	 * Clears out the collPricRecargoxConceptoLogs collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addPricRecargoxConceptoLogs()
	 */
	public function clearPricRecargoxConceptoLogs()
	{
		$this->collPricRecargoxConceptoLogs = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collPricRecargoxConceptoLogs collection (array).
	 *
	 * By default this just sets the collPricRecargoxConceptoLogs collection to an empty array (like clearcollPricRecargoxConceptoLogs());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initPricRecargoxConceptoLogs()
	{
		$this->collPricRecargoxConceptoLogs = array();
	}

	/**
	 * Gets an array of PricRecargoxConceptoLog objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this TipoRecargo has previously been saved, it will retrieve
	 * related PricRecargoxConceptoLogs from storage. If this TipoRecargo is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array PricRecargoxConceptoLog[]
	 * @throws     PropelException
	 */
	public function getPricRecargoxConceptoLogs($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargoxConceptoLogs === null) {
			if ($this->isNew()) {
			   $this->collPricRecargoxConceptoLogs = array();
			} else {

				$criteria->add(PricRecargoxConceptoLogPeer::CA_IDRECARGO, $this->ca_idrecargo);

				PricRecargoxConceptoLogPeer::addSelectColumns($criteria);
				$this->collPricRecargoxConceptoLogs = PricRecargoxConceptoLogPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PricRecargoxConceptoLogPeer::CA_IDRECARGO, $this->ca_idrecargo);

				PricRecargoxConceptoLogPeer::addSelectColumns($criteria);
				if (!isset($this->lastPricRecargoxConceptoLogCriteria) || !$this->lastPricRecargoxConceptoLogCriteria->equals($criteria)) {
					$this->collPricRecargoxConceptoLogs = PricRecargoxConceptoLogPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPricRecargoxConceptoLogCriteria = $criteria;
		return $this->collPricRecargoxConceptoLogs;
	}

	/**
	 * Returns the number of related PricRecargoxConceptoLog objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related PricRecargoxConceptoLog objects.
	 * @throws     PropelException
	 */
	public function countPricRecargoxConceptoLogs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collPricRecargoxConceptoLogs === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PricRecargoxConceptoLogPeer::CA_IDRECARGO, $this->ca_idrecargo);

				$count = PricRecargoxConceptoLogPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(PricRecargoxConceptoLogPeer::CA_IDRECARGO, $this->ca_idrecargo);

				if (!isset($this->lastPricRecargoxConceptoLogCriteria) || !$this->lastPricRecargoxConceptoLogCriteria->equals($criteria)) {
					$count = PricRecargoxConceptoLogPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPricRecargoxConceptoLogs);
				}
			} else {
				$count = count($this->collPricRecargoxConceptoLogs);
			}
		}
		$this->lastPricRecargoxConceptoLogCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a PricRecargoxConceptoLog object to this object
	 * through the PricRecargoxConceptoLog foreign key attribute.
	 *
	 * @param      PricRecargoxConceptoLog $l PricRecargoxConceptoLog
	 * @return     void
	 * @throws     PropelException
	 */
	public function addPricRecargoxConceptoLog(PricRecargoxConceptoLog $l)
	{
		if ($this->collPricRecargoxConceptoLogs === null) {
			$this->initPricRecargoxConceptoLogs();
		}
		if (!in_array($l, $this->collPricRecargoxConceptoLogs, true)) { // only add it if the **same** object is not already associated
			array_push($this->collPricRecargoxConceptoLogs, $l);
			$l->setTipoRecargo($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TipoRecargo is new, it will return
	 * an empty collection; or if this TipoRecargo has previously
	 * been saved, it will retrieve related PricRecargoxConceptoLogs from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TipoRecargo.
	 */
	public function getPricRecargoxConceptoLogsJoinPricFlete($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargoxConceptoLogs === null) {
			if ($this->isNew()) {
				$this->collPricRecargoxConceptoLogs = array();
			} else {

				$criteria->add(PricRecargoxConceptoLogPeer::CA_IDRECARGO, $this->ca_idrecargo);

				$this->collPricRecargoxConceptoLogs = PricRecargoxConceptoLogPeer::doSelectJoinPricFlete($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PricRecargoxConceptoLogPeer::CA_IDRECARGO, $this->ca_idrecargo);

			if (!isset($this->lastPricRecargoxConceptoLogCriteria) || !$this->lastPricRecargoxConceptoLogCriteria->equals($criteria)) {
				$this->collPricRecargoxConceptoLogs = PricRecargoxConceptoLogPeer::doSelectJoinPricFlete($criteria, $con, $join_behavior);
			}
		}
		$this->lastPricRecargoxConceptoLogCriteria = $criteria;

		return $this->collPricRecargoxConceptoLogs;
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
	 * Otherwise if this TipoRecargo has previously been saved, it will retrieve
	 * related PricRecargosxCiudads from storage. If this TipoRecargo is new, it will return
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
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxCiudads === null) {
			if ($this->isNew()) {
			   $this->collPricRecargosxCiudads = array();
			} else {

				$criteria->add(PricRecargosxCiudadPeer::CA_IDRECARGO, $this->ca_idrecargo);

				PricRecargosxCiudadPeer::addSelectColumns($criteria);
				$this->collPricRecargosxCiudads = PricRecargosxCiudadPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PricRecargosxCiudadPeer::CA_IDRECARGO, $this->ca_idrecargo);

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
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
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

				$criteria->add(PricRecargosxCiudadPeer::CA_IDRECARGO, $this->ca_idrecargo);

				$count = PricRecargosxCiudadPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(PricRecargosxCiudadPeer::CA_IDRECARGO, $this->ca_idrecargo);

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
			$l->setTipoRecargo($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TipoRecargo is new, it will return
	 * an empty collection; or if this TipoRecargo has previously
	 * been saved, it will retrieve related PricRecargosxCiudads from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TipoRecargo.
	 */
	public function getPricRecargosxCiudadsJoinCiudad($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxCiudads === null) {
			if ($this->isNew()) {
				$this->collPricRecargosxCiudads = array();
			} else {

				$criteria->add(PricRecargosxCiudadPeer::CA_IDRECARGO, $this->ca_idrecargo);

				$this->collPricRecargosxCiudads = PricRecargosxCiudadPeer::doSelectJoinCiudad($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PricRecargosxCiudadPeer::CA_IDRECARGO, $this->ca_idrecargo);

			if (!isset($this->lastPricRecargosxCiudadCriteria) || !$this->lastPricRecargosxCiudadCriteria->equals($criteria)) {
				$this->collPricRecargosxCiudads = PricRecargosxCiudadPeer::doSelectJoinCiudad($criteria, $con, $join_behavior);
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
	 * Otherwise if this TipoRecargo has previously been saved, it will retrieve
	 * related PricRecargosxCiudadLogs from storage. If this TipoRecargo is new, it will return
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
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxCiudadLogs === null) {
			if ($this->isNew()) {
			   $this->collPricRecargosxCiudadLogs = array();
			} else {

				$criteria->add(PricRecargosxCiudadLogPeer::CA_IDRECARGO, $this->ca_idrecargo);

				PricRecargosxCiudadLogPeer::addSelectColumns($criteria);
				$this->collPricRecargosxCiudadLogs = PricRecargosxCiudadLogPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PricRecargosxCiudadLogPeer::CA_IDRECARGO, $this->ca_idrecargo);

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
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
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

				$criteria->add(PricRecargosxCiudadLogPeer::CA_IDRECARGO, $this->ca_idrecargo);

				$count = PricRecargosxCiudadLogPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(PricRecargosxCiudadLogPeer::CA_IDRECARGO, $this->ca_idrecargo);

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
			$l->setTipoRecargo($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TipoRecargo is new, it will return
	 * an empty collection; or if this TipoRecargo has previously
	 * been saved, it will retrieve related PricRecargosxCiudadLogs from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TipoRecargo.
	 */
	public function getPricRecargosxCiudadLogsJoinCiudad($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxCiudadLogs === null) {
			if ($this->isNew()) {
				$this->collPricRecargosxCiudadLogs = array();
			} else {

				$criteria->add(PricRecargosxCiudadLogPeer::CA_IDRECARGO, $this->ca_idrecargo);

				$this->collPricRecargosxCiudadLogs = PricRecargosxCiudadLogPeer::doSelectJoinCiudad($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PricRecargosxCiudadLogPeer::CA_IDRECARGO, $this->ca_idrecargo);

			if (!isset($this->lastPricRecargosxCiudadLogCriteria) || !$this->lastPricRecargosxCiudadLogCriteria->equals($criteria)) {
				$this->collPricRecargosxCiudadLogs = PricRecargosxCiudadLogPeer::doSelectJoinCiudad($criteria, $con, $join_behavior);
			}
		}
		$this->lastPricRecargosxCiudadLogCriteria = $criteria;

		return $this->collPricRecargosxCiudadLogs;
	}

	/**
	 * Clears out the collPricRecargosxLineas collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addPricRecargosxLineas()
	 */
	public function clearPricRecargosxLineas()
	{
		$this->collPricRecargosxLineas = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collPricRecargosxLineas collection (array).
	 *
	 * By default this just sets the collPricRecargosxLineas collection to an empty array (like clearcollPricRecargosxLineas());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initPricRecargosxLineas()
	{
		$this->collPricRecargosxLineas = array();
	}

	/**
	 * Gets an array of PricRecargosxLinea objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this TipoRecargo has previously been saved, it will retrieve
	 * related PricRecargosxLineas from storage. If this TipoRecargo is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array PricRecargosxLinea[]
	 * @throws     PropelException
	 */
	public function getPricRecargosxLineas($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxLineas === null) {
			if ($this->isNew()) {
			   $this->collPricRecargosxLineas = array();
			} else {

				$criteria->add(PricRecargosxLineaPeer::CA_IDRECARGO, $this->ca_idrecargo);

				PricRecargosxLineaPeer::addSelectColumns($criteria);
				$this->collPricRecargosxLineas = PricRecargosxLineaPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PricRecargosxLineaPeer::CA_IDRECARGO, $this->ca_idrecargo);

				PricRecargosxLineaPeer::addSelectColumns($criteria);
				if (!isset($this->lastPricRecargosxLineaCriteria) || !$this->lastPricRecargosxLineaCriteria->equals($criteria)) {
					$this->collPricRecargosxLineas = PricRecargosxLineaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPricRecargosxLineaCriteria = $criteria;
		return $this->collPricRecargosxLineas;
	}

	/**
	 * Returns the number of related PricRecargosxLinea objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related PricRecargosxLinea objects.
	 * @throws     PropelException
	 */
	public function countPricRecargosxLineas(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collPricRecargosxLineas === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PricRecargosxLineaPeer::CA_IDRECARGO, $this->ca_idrecargo);

				$count = PricRecargosxLineaPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(PricRecargosxLineaPeer::CA_IDRECARGO, $this->ca_idrecargo);

				if (!isset($this->lastPricRecargosxLineaCriteria) || !$this->lastPricRecargosxLineaCriteria->equals($criteria)) {
					$count = PricRecargosxLineaPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPricRecargosxLineas);
				}
			} else {
				$count = count($this->collPricRecargosxLineas);
			}
		}
		$this->lastPricRecargosxLineaCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a PricRecargosxLinea object to this object
	 * through the PricRecargosxLinea foreign key attribute.
	 *
	 * @param      PricRecargosxLinea $l PricRecargosxLinea
	 * @return     void
	 * @throws     PropelException
	 */
	public function addPricRecargosxLinea(PricRecargosxLinea $l)
	{
		if ($this->collPricRecargosxLineas === null) {
			$this->initPricRecargosxLineas();
		}
		if (!in_array($l, $this->collPricRecargosxLineas, true)) { // only add it if the **same** object is not already associated
			array_push($this->collPricRecargosxLineas, $l);
			$l->setTipoRecargo($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TipoRecargo is new, it will return
	 * an empty collection; or if this TipoRecargo has previously
	 * been saved, it will retrieve related PricRecargosxLineas from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TipoRecargo.
	 */
	public function getPricRecargosxLineasJoinTransportador($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxLineas === null) {
			if ($this->isNew()) {
				$this->collPricRecargosxLineas = array();
			} else {

				$criteria->add(PricRecargosxLineaPeer::CA_IDRECARGO, $this->ca_idrecargo);

				$this->collPricRecargosxLineas = PricRecargosxLineaPeer::doSelectJoinTransportador($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PricRecargosxLineaPeer::CA_IDRECARGO, $this->ca_idrecargo);

			if (!isset($this->lastPricRecargosxLineaCriteria) || !$this->lastPricRecargosxLineaCriteria->equals($criteria)) {
				$this->collPricRecargosxLineas = PricRecargosxLineaPeer::doSelectJoinTransportador($criteria, $con, $join_behavior);
			}
		}
		$this->lastPricRecargosxLineaCriteria = $criteria;

		return $this->collPricRecargosxLineas;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TipoRecargo is new, it will return
	 * an empty collection; or if this TipoRecargo has previously
	 * been saved, it will retrieve related PricRecargosxLineas from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TipoRecargo.
	 */
	public function getPricRecargosxLineasJoinConcepto($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxLineas === null) {
			if ($this->isNew()) {
				$this->collPricRecargosxLineas = array();
			} else {

				$criteria->add(PricRecargosxLineaPeer::CA_IDRECARGO, $this->ca_idrecargo);

				$this->collPricRecargosxLineas = PricRecargosxLineaPeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PricRecargosxLineaPeer::CA_IDRECARGO, $this->ca_idrecargo);

			if (!isset($this->lastPricRecargosxLineaCriteria) || !$this->lastPricRecargosxLineaCriteria->equals($criteria)) {
				$this->collPricRecargosxLineas = PricRecargosxLineaPeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		}
		$this->lastPricRecargosxLineaCriteria = $criteria;

		return $this->collPricRecargosxLineas;
	}

	/**
	 * Clears out the collPricRecargosxLineaLogs collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addPricRecargosxLineaLogs()
	 */
	public function clearPricRecargosxLineaLogs()
	{
		$this->collPricRecargosxLineaLogs = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collPricRecargosxLineaLogs collection (array).
	 *
	 * By default this just sets the collPricRecargosxLineaLogs collection to an empty array (like clearcollPricRecargosxLineaLogs());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initPricRecargosxLineaLogs()
	{
		$this->collPricRecargosxLineaLogs = array();
	}

	/**
	 * Gets an array of PricRecargosxLineaLog objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this TipoRecargo has previously been saved, it will retrieve
	 * related PricRecargosxLineaLogs from storage. If this TipoRecargo is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array PricRecargosxLineaLog[]
	 * @throws     PropelException
	 */
	public function getPricRecargosxLineaLogs($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxLineaLogs === null) {
			if ($this->isNew()) {
			   $this->collPricRecargosxLineaLogs = array();
			} else {

				$criteria->add(PricRecargosxLineaLogPeer::CA_IDRECARGO, $this->ca_idrecargo);

				PricRecargosxLineaLogPeer::addSelectColumns($criteria);
				$this->collPricRecargosxLineaLogs = PricRecargosxLineaLogPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PricRecargosxLineaLogPeer::CA_IDRECARGO, $this->ca_idrecargo);

				PricRecargosxLineaLogPeer::addSelectColumns($criteria);
				if (!isset($this->lastPricRecargosxLineaLogCriteria) || !$this->lastPricRecargosxLineaLogCriteria->equals($criteria)) {
					$this->collPricRecargosxLineaLogs = PricRecargosxLineaLogPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPricRecargosxLineaLogCriteria = $criteria;
		return $this->collPricRecargosxLineaLogs;
	}

	/**
	 * Returns the number of related PricRecargosxLineaLog objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related PricRecargosxLineaLog objects.
	 * @throws     PropelException
	 */
	public function countPricRecargosxLineaLogs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collPricRecargosxLineaLogs === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PricRecargosxLineaLogPeer::CA_IDRECARGO, $this->ca_idrecargo);

				$count = PricRecargosxLineaLogPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(PricRecargosxLineaLogPeer::CA_IDRECARGO, $this->ca_idrecargo);

				if (!isset($this->lastPricRecargosxLineaLogCriteria) || !$this->lastPricRecargosxLineaLogCriteria->equals($criteria)) {
					$count = PricRecargosxLineaLogPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPricRecargosxLineaLogs);
				}
			} else {
				$count = count($this->collPricRecargosxLineaLogs);
			}
		}
		$this->lastPricRecargosxLineaLogCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a PricRecargosxLineaLog object to this object
	 * through the PricRecargosxLineaLog foreign key attribute.
	 *
	 * @param      PricRecargosxLineaLog $l PricRecargosxLineaLog
	 * @return     void
	 * @throws     PropelException
	 */
	public function addPricRecargosxLineaLog(PricRecargosxLineaLog $l)
	{
		if ($this->collPricRecargosxLineaLogs === null) {
			$this->initPricRecargosxLineaLogs();
		}
		if (!in_array($l, $this->collPricRecargosxLineaLogs, true)) { // only add it if the **same** object is not already associated
			array_push($this->collPricRecargosxLineaLogs, $l);
			$l->setTipoRecargo($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TipoRecargo is new, it will return
	 * an empty collection; or if this TipoRecargo has previously
	 * been saved, it will retrieve related PricRecargosxLineaLogs from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TipoRecargo.
	 */
	public function getPricRecargosxLineaLogsJoinTransportador($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxLineaLogs === null) {
			if ($this->isNew()) {
				$this->collPricRecargosxLineaLogs = array();
			} else {

				$criteria->add(PricRecargosxLineaLogPeer::CA_IDRECARGO, $this->ca_idrecargo);

				$this->collPricRecargosxLineaLogs = PricRecargosxLineaLogPeer::doSelectJoinTransportador($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PricRecargosxLineaLogPeer::CA_IDRECARGO, $this->ca_idrecargo);

			if (!isset($this->lastPricRecargosxLineaLogCriteria) || !$this->lastPricRecargosxLineaLogCriteria->equals($criteria)) {
				$this->collPricRecargosxLineaLogs = PricRecargosxLineaLogPeer::doSelectJoinTransportador($criteria, $con, $join_behavior);
			}
		}
		$this->lastPricRecargosxLineaLogCriteria = $criteria;

		return $this->collPricRecargosxLineaLogs;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TipoRecargo is new, it will return
	 * an empty collection; or if this TipoRecargo has previously
	 * been saved, it will retrieve related PricRecargosxLineaLogs from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TipoRecargo.
	 */
	public function getPricRecargosxLineaLogsJoinConcepto($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxLineaLogs === null) {
			if ($this->isNew()) {
				$this->collPricRecargosxLineaLogs = array();
			} else {

				$criteria->add(PricRecargosxLineaLogPeer::CA_IDRECARGO, $this->ca_idrecargo);

				$this->collPricRecargosxLineaLogs = PricRecargosxLineaLogPeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PricRecargosxLineaLogPeer::CA_IDRECARGO, $this->ca_idrecargo);

			if (!isset($this->lastPricRecargosxLineaLogCriteria) || !$this->lastPricRecargosxLineaLogCriteria->equals($criteria)) {
				$this->collPricRecargosxLineaLogs = PricRecargosxLineaLogPeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		}
		$this->lastPricRecargosxLineaLogCriteria = $criteria;

		return $this->collPricRecargosxLineaLogs;
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
	 * Otherwise if this TipoRecargo has previously been saved, it will retrieve
	 * related RepGastos from storage. If this TipoRecargo is new, it will return
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
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepGastos === null) {
			if ($this->isNew()) {
			   $this->collRepGastos = array();
			} else {

				$criteria->add(RepGastoPeer::CA_IDRECARGO, $this->ca_idrecargo);

				RepGastoPeer::addSelectColumns($criteria);
				$this->collRepGastos = RepGastoPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RepGastoPeer::CA_IDRECARGO, $this->ca_idrecargo);

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
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
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

				$criteria->add(RepGastoPeer::CA_IDRECARGO, $this->ca_idrecargo);

				$count = RepGastoPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(RepGastoPeer::CA_IDRECARGO, $this->ca_idrecargo);

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
			$l->setTipoRecargo($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TipoRecargo is new, it will return
	 * an empty collection; or if this TipoRecargo has previously
	 * been saved, it will retrieve related RepGastos from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TipoRecargo.
	 */
	public function getRepGastosJoinReporte($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepGastos === null) {
			if ($this->isNew()) {
				$this->collRepGastos = array();
			} else {

				$criteria->add(RepGastoPeer::CA_IDRECARGO, $this->ca_idrecargo);

				$this->collRepGastos = RepGastoPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RepGastoPeer::CA_IDRECARGO, $this->ca_idrecargo);

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
	 * Otherwise if this TipoRecargo is new, it will return
	 * an empty collection; or if this TipoRecargo has previously
	 * been saved, it will retrieve related RepGastos from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TipoRecargo.
	 */
	public function getRepGastosJoinConcepto($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepGastos === null) {
			if ($this->isNew()) {
				$this->collRepGastos = array();
			} else {

				$criteria->add(RepGastoPeer::CA_IDRECARGO, $this->ca_idrecargo);

				$this->collRepGastos = RepGastoPeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RepGastoPeer::CA_IDRECARGO, $this->ca_idrecargo);

			if (!isset($this->lastRepGastoCriteria) || !$this->lastRepGastoCriteria->equals($criteria)) {
				$this->collRepGastos = RepGastoPeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		}
		$this->lastRepGastoCriteria = $criteria;

		return $this->collRepGastos;
	}

	/**
	 * Clears out the collRecargoFletes collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addRecargoFletes()
	 */
	public function clearRecargoFletes()
	{
		$this->collRecargoFletes = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collRecargoFletes collection (array).
	 *
	 * By default this just sets the collRecargoFletes collection to an empty array (like clearcollRecargoFletes());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initRecargoFletes()
	{
		$this->collRecargoFletes = array();
	}

	/**
	 * Gets an array of RecargoFlete objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this TipoRecargo has previously been saved, it will retrieve
	 * related RecargoFletes from storage. If this TipoRecargo is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array RecargoFlete[]
	 * @throws     PropelException
	 */
	public function getRecargoFletes($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRecargoFletes === null) {
			if ($this->isNew()) {
			   $this->collRecargoFletes = array();
			} else {

				$criteria->add(RecargoFletePeer::CA_IDRECARGO, $this->ca_idrecargo);

				RecargoFletePeer::addSelectColumns($criteria);
				$this->collRecargoFletes = RecargoFletePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RecargoFletePeer::CA_IDRECARGO, $this->ca_idrecargo);

				RecargoFletePeer::addSelectColumns($criteria);
				if (!isset($this->lastRecargoFleteCriteria) || !$this->lastRecargoFleteCriteria->equals($criteria)) {
					$this->collRecargoFletes = RecargoFletePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRecargoFleteCriteria = $criteria;
		return $this->collRecargoFletes;
	}

	/**
	 * Returns the number of related RecargoFlete objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related RecargoFlete objects.
	 * @throws     PropelException
	 */
	public function countRecargoFletes(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collRecargoFletes === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(RecargoFletePeer::CA_IDRECARGO, $this->ca_idrecargo);

				$count = RecargoFletePeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(RecargoFletePeer::CA_IDRECARGO, $this->ca_idrecargo);

				if (!isset($this->lastRecargoFleteCriteria) || !$this->lastRecargoFleteCriteria->equals($criteria)) {
					$count = RecargoFletePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collRecargoFletes);
				}
			} else {
				$count = count($this->collRecargoFletes);
			}
		}
		$this->lastRecargoFleteCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a RecargoFlete object to this object
	 * through the RecargoFlete foreign key attribute.
	 *
	 * @param      RecargoFlete $l RecargoFlete
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRecargoFlete(RecargoFlete $l)
	{
		if ($this->collRecargoFletes === null) {
			$this->initRecargoFletes();
		}
		if (!in_array($l, $this->collRecargoFletes, true)) { // only add it if the **same** object is not already associated
			array_push($this->collRecargoFletes, $l);
			$l->setTipoRecargo($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TipoRecargo is new, it will return
	 * an empty collection; or if this TipoRecargo has previously
	 * been saved, it will retrieve related RecargoFletes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TipoRecargo.
	 */
	public function getRecargoFletesJoinFlete($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRecargoFletes === null) {
			if ($this->isNew()) {
				$this->collRecargoFletes = array();
			} else {

				$criteria->add(RecargoFletePeer::CA_IDRECARGO, $this->ca_idrecargo);

				$this->collRecargoFletes = RecargoFletePeer::doSelectJoinFlete($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RecargoFletePeer::CA_IDRECARGO, $this->ca_idrecargo);

			if (!isset($this->lastRecargoFleteCriteria) || !$this->lastRecargoFleteCriteria->equals($criteria)) {
				$this->collRecargoFletes = RecargoFletePeer::doSelectJoinFlete($criteria, $con, $join_behavior);
			}
		}
		$this->lastRecargoFleteCriteria = $criteria;

		return $this->collRecargoFletes;
	}

	/**
	 * Clears out the collRecargoFleteTrafs collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addRecargoFleteTrafs()
	 */
	public function clearRecargoFleteTrafs()
	{
		$this->collRecargoFleteTrafs = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collRecargoFleteTrafs collection (array).
	 *
	 * By default this just sets the collRecargoFleteTrafs collection to an empty array (like clearcollRecargoFleteTrafs());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initRecargoFleteTrafs()
	{
		$this->collRecargoFleteTrafs = array();
	}

	/**
	 * Gets an array of RecargoFleteTraf objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this TipoRecargo has previously been saved, it will retrieve
	 * related RecargoFleteTrafs from storage. If this TipoRecargo is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array RecargoFleteTraf[]
	 * @throws     PropelException
	 */
	public function getRecargoFleteTrafs($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRecargoFleteTrafs === null) {
			if ($this->isNew()) {
			   $this->collRecargoFleteTrafs = array();
			} else {

				$criteria->add(RecargoFleteTrafPeer::CA_IDRECARGO, $this->ca_idrecargo);

				RecargoFleteTrafPeer::addSelectColumns($criteria);
				$this->collRecargoFleteTrafs = RecargoFleteTrafPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RecargoFleteTrafPeer::CA_IDRECARGO, $this->ca_idrecargo);

				RecargoFleteTrafPeer::addSelectColumns($criteria);
				if (!isset($this->lastRecargoFleteTrafCriteria) || !$this->lastRecargoFleteTrafCriteria->equals($criteria)) {
					$this->collRecargoFleteTrafs = RecargoFleteTrafPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRecargoFleteTrafCriteria = $criteria;
		return $this->collRecargoFleteTrafs;
	}

	/**
	 * Returns the number of related RecargoFleteTraf objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related RecargoFleteTraf objects.
	 * @throws     PropelException
	 */
	public function countRecargoFleteTrafs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collRecargoFleteTrafs === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(RecargoFleteTrafPeer::CA_IDRECARGO, $this->ca_idrecargo);

				$count = RecargoFleteTrafPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(RecargoFleteTrafPeer::CA_IDRECARGO, $this->ca_idrecargo);

				if (!isset($this->lastRecargoFleteTrafCriteria) || !$this->lastRecargoFleteTrafCriteria->equals($criteria)) {
					$count = RecargoFleteTrafPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collRecargoFleteTrafs);
				}
			} else {
				$count = count($this->collRecargoFleteTrafs);
			}
		}
		$this->lastRecargoFleteTrafCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a RecargoFleteTraf object to this object
	 * through the RecargoFleteTraf foreign key attribute.
	 *
	 * @param      RecargoFleteTraf $l RecargoFleteTraf
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRecargoFleteTraf(RecargoFleteTraf $l)
	{
		if ($this->collRecargoFleteTrafs === null) {
			$this->initRecargoFleteTrafs();
		}
		if (!in_array($l, $this->collRecargoFleteTrafs, true)) { // only add it if the **same** object is not already associated
			array_push($this->collRecargoFleteTrafs, $l);
			$l->setTipoRecargo($this);
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
			if ($this->collCotRecargos) {
				foreach ((array) $this->collCotRecargos as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collPricRecargoxConceptos) {
				foreach ((array) $this->collPricRecargoxConceptos as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collPricRecargoxConceptoLogs) {
				foreach ((array) $this->collPricRecargoxConceptoLogs as $o) {
					$o->clearAllReferences($deep);
				}
			}
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
			if ($this->collPricRecargosxLineas) {
				foreach ((array) $this->collPricRecargosxLineas as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collPricRecargosxLineaLogs) {
				foreach ((array) $this->collPricRecargosxLineaLogs as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collRepGastos) {
				foreach ((array) $this->collRepGastos as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collRecargoFletes) {
				foreach ((array) $this->collRecargoFletes as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collRecargoFleteTrafs) {
				foreach ((array) $this->collRecargoFleteTrafs as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collCotRecargos = null;
		$this->collPricRecargoxConceptos = null;
		$this->collPricRecargoxConceptoLogs = null;
		$this->collPricRecargosxCiudads = null;
		$this->collPricRecargosxCiudadLogs = null;
		$this->collPricRecargosxLineas = null;
		$this->collPricRecargosxLineaLogs = null;
		$this->collRepGastos = null;
		$this->collRecargoFletes = null;
		$this->collRecargoFleteTrafs = null;
	}

} // BaseTipoRecargo
