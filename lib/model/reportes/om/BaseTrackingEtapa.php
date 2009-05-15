<?php

/**
 * Base class that represents a row from the 'tb_tracking_etapas' table.
 *
 * 
 *
 * @package    lib.model.reportes.om
 */
abstract class BaseTrackingEtapa extends BaseObject  implements Persistent {


  const PEER = 'TrackingEtapaPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        TrackingEtapaPeer
	 */
	protected static $peer;

	/**
	 * The value for the ca_idetapa field.
	 * @var        string
	 */
	protected $ca_idetapa;

	/**
	 * The value for the ca_impoexpo field.
	 * @var        string
	 */
	protected $ca_impoexpo;

	/**
	 * The value for the ca_transporte field.
	 * @var        string
	 */
	protected $ca_transporte;

	/**
	 * The value for the ca_departamento field.
	 * @var        string
	 */
	protected $ca_departamento;

	/**
	 * The value for the ca_etapa field.
	 * @var        string
	 */
	protected $ca_etapa;

	/**
	 * The value for the ca_orden field.
	 * @var        string
	 */
	protected $ca_orden;

	/**
	 * The value for the ca_ttl field.
	 * @var        string
	 */
	protected $ca_ttl;

	/**
	 * The value for the ca_class field.
	 * @var        string
	 */
	protected $ca_class;

	/**
	 * The value for the ca_template field.
	 * @var        string
	 */
	protected $ca_template;

	/**
	 * The value for the ca_message field.
	 * @var        string
	 */
	protected $ca_message;

	/**
	 * The value for the ca_message_default field.
	 * @var        string
	 */
	protected $ca_message_default;

	/**
	 * @var        array Reporte[] Collection to store aggregation of Reporte objects.
	 */
	protected $collReportes;

	/**
	 * @var        Criteria The criteria used to select the current contents of collReportes.
	 */
	private $lastReporteCriteria = null;

	/**
	 * @var        array RepStatus[] Collection to store aggregation of RepStatus objects.
	 */
	protected $collRepStatuss;

	/**
	 * @var        Criteria The criteria used to select the current contents of collRepStatuss.
	 */
	private $lastRepStatusCriteria = null;

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
	 * Initializes internal state of BaseTrackingEtapa object.
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
	 * Get the [ca_idetapa] column value.
	 * 
	 * @return     string
	 */
	public function getCaIdetapa()
	{
		return $this->ca_idetapa;
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
	 * Get the [ca_transporte] column value.
	 * 
	 * @return     string
	 */
	public function getCaTransporte()
	{
		return $this->ca_transporte;
	}

	/**
	 * Get the [ca_departamento] column value.
	 * 
	 * @return     string
	 */
	public function getCaDepartamento()
	{
		return $this->ca_departamento;
	}

	/**
	 * Get the [ca_etapa] column value.
	 * 
	 * @return     string
	 */
	public function getCaEtapa()
	{
		return $this->ca_etapa;
	}

	/**
	 * Get the [ca_orden] column value.
	 * 
	 * @return     string
	 */
	public function getCaOrden()
	{
		return $this->ca_orden;
	}

	/**
	 * Get the [ca_ttl] column value.
	 * 
	 * @return     string
	 */
	public function getCaTtl()
	{
		return $this->ca_ttl;
	}

	/**
	 * Get the [ca_class] column value.
	 * 
	 * @return     string
	 */
	public function getCaClass()
	{
		return $this->ca_class;
	}

	/**
	 * Get the [ca_template] column value.
	 * 
	 * @return     string
	 */
	public function getCaTemplate()
	{
		return $this->ca_template;
	}

	/**
	 * Get the [ca_message] column value.
	 * 
	 * @return     string
	 */
	public function getCaMessage()
	{
		return $this->ca_message;
	}

	/**
	 * Get the [ca_message_default] column value.
	 * 
	 * @return     string
	 */
	public function getCaMessageDefault()
	{
		return $this->ca_message_default;
	}

	/**
	 * Set the value of [ca_idetapa] column.
	 * 
	 * @param      string $v new value
	 * @return     TrackingEtapa The current object (for fluent API support)
	 */
	public function setCaIdetapa($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idetapa !== $v) {
			$this->ca_idetapa = $v;
			$this->modifiedColumns[] = TrackingEtapaPeer::CA_IDETAPA;
		}

		return $this;
	} // setCaIdetapa()

	/**
	 * Set the value of [ca_impoexpo] column.
	 * 
	 * @param      string $v new value
	 * @return     TrackingEtapa The current object (for fluent API support)
	 */
	public function setCaImpoexpo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_impoexpo !== $v) {
			$this->ca_impoexpo = $v;
			$this->modifiedColumns[] = TrackingEtapaPeer::CA_IMPOEXPO;
		}

		return $this;
	} // setCaImpoexpo()

	/**
	 * Set the value of [ca_transporte] column.
	 * 
	 * @param      string $v new value
	 * @return     TrackingEtapa The current object (for fluent API support)
	 */
	public function setCaTransporte($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_transporte !== $v) {
			$this->ca_transporte = $v;
			$this->modifiedColumns[] = TrackingEtapaPeer::CA_TRANSPORTE;
		}

		return $this;
	} // setCaTransporte()

	/**
	 * Set the value of [ca_departamento] column.
	 * 
	 * @param      string $v new value
	 * @return     TrackingEtapa The current object (for fluent API support)
	 */
	public function setCaDepartamento($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_departamento !== $v) {
			$this->ca_departamento = $v;
			$this->modifiedColumns[] = TrackingEtapaPeer::CA_DEPARTAMENTO;
		}

		return $this;
	} // setCaDepartamento()

	/**
	 * Set the value of [ca_etapa] column.
	 * 
	 * @param      string $v new value
	 * @return     TrackingEtapa The current object (for fluent API support)
	 */
	public function setCaEtapa($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_etapa !== $v) {
			$this->ca_etapa = $v;
			$this->modifiedColumns[] = TrackingEtapaPeer::CA_ETAPA;
		}

		return $this;
	} // setCaEtapa()

	/**
	 * Set the value of [ca_orden] column.
	 * 
	 * @param      string $v new value
	 * @return     TrackingEtapa The current object (for fluent API support)
	 */
	public function setCaOrden($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_orden !== $v) {
			$this->ca_orden = $v;
			$this->modifiedColumns[] = TrackingEtapaPeer::CA_ORDEN;
		}

		return $this;
	} // setCaOrden()

	/**
	 * Set the value of [ca_ttl] column.
	 * 
	 * @param      string $v new value
	 * @return     TrackingEtapa The current object (for fluent API support)
	 */
	public function setCaTtl($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_ttl !== $v) {
			$this->ca_ttl = $v;
			$this->modifiedColumns[] = TrackingEtapaPeer::CA_TTL;
		}

		return $this;
	} // setCaTtl()

	/**
	 * Set the value of [ca_class] column.
	 * 
	 * @param      string $v new value
	 * @return     TrackingEtapa The current object (for fluent API support)
	 */
	public function setCaClass($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_class !== $v) {
			$this->ca_class = $v;
			$this->modifiedColumns[] = TrackingEtapaPeer::CA_CLASS;
		}

		return $this;
	} // setCaClass()

	/**
	 * Set the value of [ca_template] column.
	 * 
	 * @param      string $v new value
	 * @return     TrackingEtapa The current object (for fluent API support)
	 */
	public function setCaTemplate($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_template !== $v) {
			$this->ca_template = $v;
			$this->modifiedColumns[] = TrackingEtapaPeer::CA_TEMPLATE;
		}

		return $this;
	} // setCaTemplate()

	/**
	 * Set the value of [ca_message] column.
	 * 
	 * @param      string $v new value
	 * @return     TrackingEtapa The current object (for fluent API support)
	 */
	public function setCaMessage($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_message !== $v) {
			$this->ca_message = $v;
			$this->modifiedColumns[] = TrackingEtapaPeer::CA_MESSAGE;
		}

		return $this;
	} // setCaMessage()

	/**
	 * Set the value of [ca_message_default] column.
	 * 
	 * @param      string $v new value
	 * @return     TrackingEtapa The current object (for fluent API support)
	 */
	public function setCaMessageDefault($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_message_default !== $v) {
			$this->ca_message_default = $v;
			$this->modifiedColumns[] = TrackingEtapaPeer::CA_MESSAGE_DEFAULT;
		}

		return $this;
	} // setCaMessageDefault()

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

			$this->ca_idetapa = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ca_impoexpo = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_transporte = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_departamento = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_etapa = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_orden = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_ttl = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_class = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_template = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_message = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_message_default = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 11; // 11 = TrackingEtapaPeer::NUM_COLUMNS - TrackingEtapaPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating TrackingEtapa object", $e);
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
			$con = Propel::getConnection(TrackingEtapaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = TrackingEtapaPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->collReportes = null;
			$this->lastReporteCriteria = null;

			$this->collRepStatuss = null;
			$this->lastRepStatusCriteria = null;

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
			$con = Propel::getConnection(TrackingEtapaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			TrackingEtapaPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(TrackingEtapaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			TrackingEtapaPeer::addInstanceToPool($this);
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
					$pk = TrackingEtapaPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += TrackingEtapaPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collReportes !== null) {
				foreach ($this->collReportes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRepStatuss !== null) {
				foreach ($this->collRepStatuss as $referrerFK) {
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


			if (($retval = TrackingEtapaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collReportes !== null) {
					foreach ($this->collReportes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRepStatuss !== null) {
					foreach ($this->collRepStatuss as $referrerFK) {
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
		$pos = TrackingEtapaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdetapa();
				break;
			case 1:
				return $this->getCaImpoexpo();
				break;
			case 2:
				return $this->getCaTransporte();
				break;
			case 3:
				return $this->getCaDepartamento();
				break;
			case 4:
				return $this->getCaEtapa();
				break;
			case 5:
				return $this->getCaOrden();
				break;
			case 6:
				return $this->getCaTtl();
				break;
			case 7:
				return $this->getCaClass();
				break;
			case 8:
				return $this->getCaTemplate();
				break;
			case 9:
				return $this->getCaMessage();
				break;
			case 10:
				return $this->getCaMessageDefault();
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
		$keys = TrackingEtapaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdetapa(),
			$keys[1] => $this->getCaImpoexpo(),
			$keys[2] => $this->getCaTransporte(),
			$keys[3] => $this->getCaDepartamento(),
			$keys[4] => $this->getCaEtapa(),
			$keys[5] => $this->getCaOrden(),
			$keys[6] => $this->getCaTtl(),
			$keys[7] => $this->getCaClass(),
			$keys[8] => $this->getCaTemplate(),
			$keys[9] => $this->getCaMessage(),
			$keys[10] => $this->getCaMessageDefault(),
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
		$pos = TrackingEtapaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdetapa($value);
				break;
			case 1:
				$this->setCaImpoexpo($value);
				break;
			case 2:
				$this->setCaTransporte($value);
				break;
			case 3:
				$this->setCaDepartamento($value);
				break;
			case 4:
				$this->setCaEtapa($value);
				break;
			case 5:
				$this->setCaOrden($value);
				break;
			case 6:
				$this->setCaTtl($value);
				break;
			case 7:
				$this->setCaClass($value);
				break;
			case 8:
				$this->setCaTemplate($value);
				break;
			case 9:
				$this->setCaMessage($value);
				break;
			case 10:
				$this->setCaMessageDefault($value);
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
		$keys = TrackingEtapaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdetapa($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaImpoexpo($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaTransporte($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaDepartamento($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaEtapa($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaOrden($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaTtl($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaClass($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaTemplate($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaMessage($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaMessageDefault($arr[$keys[10]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(TrackingEtapaPeer::DATABASE_NAME);

		if ($this->isColumnModified(TrackingEtapaPeer::CA_IDETAPA)) $criteria->add(TrackingEtapaPeer::CA_IDETAPA, $this->ca_idetapa);
		if ($this->isColumnModified(TrackingEtapaPeer::CA_IMPOEXPO)) $criteria->add(TrackingEtapaPeer::CA_IMPOEXPO, $this->ca_impoexpo);
		if ($this->isColumnModified(TrackingEtapaPeer::CA_TRANSPORTE)) $criteria->add(TrackingEtapaPeer::CA_TRANSPORTE, $this->ca_transporte);
		if ($this->isColumnModified(TrackingEtapaPeer::CA_DEPARTAMENTO)) $criteria->add(TrackingEtapaPeer::CA_DEPARTAMENTO, $this->ca_departamento);
		if ($this->isColumnModified(TrackingEtapaPeer::CA_ETAPA)) $criteria->add(TrackingEtapaPeer::CA_ETAPA, $this->ca_etapa);
		if ($this->isColumnModified(TrackingEtapaPeer::CA_ORDEN)) $criteria->add(TrackingEtapaPeer::CA_ORDEN, $this->ca_orden);
		if ($this->isColumnModified(TrackingEtapaPeer::CA_TTL)) $criteria->add(TrackingEtapaPeer::CA_TTL, $this->ca_ttl);
		if ($this->isColumnModified(TrackingEtapaPeer::CA_CLASS)) $criteria->add(TrackingEtapaPeer::CA_CLASS, $this->ca_class);
		if ($this->isColumnModified(TrackingEtapaPeer::CA_TEMPLATE)) $criteria->add(TrackingEtapaPeer::CA_TEMPLATE, $this->ca_template);
		if ($this->isColumnModified(TrackingEtapaPeer::CA_MESSAGE)) $criteria->add(TrackingEtapaPeer::CA_MESSAGE, $this->ca_message);
		if ($this->isColumnModified(TrackingEtapaPeer::CA_MESSAGE_DEFAULT)) $criteria->add(TrackingEtapaPeer::CA_MESSAGE_DEFAULT, $this->ca_message_default);

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
		$criteria = new Criteria(TrackingEtapaPeer::DATABASE_NAME);

		$criteria->add(TrackingEtapaPeer::CA_IDETAPA, $this->ca_idetapa);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     string
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdetapa();
	}

	/**
	 * Generic method to set the primary key (ca_idetapa column).
	 *
	 * @param      string $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdetapa($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of TrackingEtapa (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdetapa($this->ca_idetapa);

		$copyObj->setCaImpoexpo($this->ca_impoexpo);

		$copyObj->setCaTransporte($this->ca_transporte);

		$copyObj->setCaDepartamento($this->ca_departamento);

		$copyObj->setCaEtapa($this->ca_etapa);

		$copyObj->setCaOrden($this->ca_orden);

		$copyObj->setCaTtl($this->ca_ttl);

		$copyObj->setCaClass($this->ca_class);

		$copyObj->setCaTemplate($this->ca_template);

		$copyObj->setCaMessage($this->ca_message);

		$copyObj->setCaMessageDefault($this->ca_message_default);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getReportes() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addReporte($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getRepStatuss() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addRepStatus($relObj->copy($deepCopy));
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
	 * @return     TrackingEtapa Clone of current object.
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
	 * @return     TrackingEtapaPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new TrackingEtapaPeer();
		}
		return self::$peer;
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
	 * Otherwise if this TrackingEtapa has previously been saved, it will retrieve
	 * related Reportes from storage. If this TrackingEtapa is new, it will return
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
			$criteria = new Criteria(TrackingEtapaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
			   $this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDETAPA, $this->ca_idetapa);

				ReportePeer::addSelectColumns($criteria);
				$this->collReportes = ReportePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ReportePeer::CA_IDETAPA, $this->ca_idetapa);

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
			$criteria = new Criteria(TrackingEtapaPeer::DATABASE_NAME);
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

				$criteria->add(ReportePeer::CA_IDETAPA, $this->ca_idetapa);

				$count = ReportePeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(ReportePeer::CA_IDETAPA, $this->ca_idetapa);

				if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
					$count = ReportePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collReportes);
				}
			} else {
				$count = count($this->collReportes);
			}
		}
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
			$l->setTrackingEtapa($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TrackingEtapa is new, it will return
	 * an empty collection; or if this TrackingEtapa has previously
	 * been saved, it will retrieve related Reportes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TrackingEtapa.
	 */
	public function getReportesJoinUsuario($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TrackingEtapaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDETAPA, $this->ca_idetapa);

				$this->collReportes = ReportePeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ReportePeer::CA_IDETAPA, $this->ca_idetapa);

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
	 * Otherwise if this TrackingEtapa is new, it will return
	 * an empty collection; or if this TrackingEtapa has previously
	 * been saved, it will retrieve related Reportes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TrackingEtapa.
	 */
	public function getReportesJoinTransportador($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TrackingEtapaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDETAPA, $this->ca_idetapa);

				$this->collReportes = ReportePeer::doSelectJoinTransportador($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ReportePeer::CA_IDETAPA, $this->ca_idetapa);

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinTransportador($criteria, $con, $join_behavior);
			}
		}
		$this->lastReporteCriteria = $criteria;

		return $this->collReportes;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TrackingEtapa is new, it will return
	 * an empty collection; or if this TrackingEtapa has previously
	 * been saved, it will retrieve related Reportes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TrackingEtapa.
	 */
	public function getReportesJoinTercero($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TrackingEtapaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDETAPA, $this->ca_idetapa);

				$this->collReportes = ReportePeer::doSelectJoinTercero($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ReportePeer::CA_IDETAPA, $this->ca_idetapa);

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
	 * Otherwise if this TrackingEtapa is new, it will return
	 * an empty collection; or if this TrackingEtapa has previously
	 * been saved, it will retrieve related Reportes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TrackingEtapa.
	 */
	public function getReportesJoinAgente($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TrackingEtapaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDETAPA, $this->ca_idetapa);

				$this->collReportes = ReportePeer::doSelectJoinAgente($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ReportePeer::CA_IDETAPA, $this->ca_idetapa);

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
	 * Otherwise if this TrackingEtapa is new, it will return
	 * an empty collection; or if this TrackingEtapa has previously
	 * been saved, it will retrieve related Reportes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TrackingEtapa.
	 */
	public function getReportesJoinBodega($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TrackingEtapaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDETAPA, $this->ca_idetapa);

				$this->collReportes = ReportePeer::doSelectJoinBodega($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ReportePeer::CA_IDETAPA, $this->ca_idetapa);

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinBodega($criteria, $con, $join_behavior);
			}
		}
		$this->lastReporteCriteria = $criteria;

		return $this->collReportes;
	}

	/**
	 * Clears out the collRepStatuss collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addRepStatuss()
	 */
	public function clearRepStatuss()
	{
		$this->collRepStatuss = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collRepStatuss collection (array).
	 *
	 * By default this just sets the collRepStatuss collection to an empty array (like clearcollRepStatuss());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initRepStatuss()
	{
		$this->collRepStatuss = array();
	}

	/**
	 * Gets an array of RepStatus objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this TrackingEtapa has previously been saved, it will retrieve
	 * related RepStatuss from storage. If this TrackingEtapa is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array RepStatus[]
	 * @throws     PropelException
	 */
	public function getRepStatuss($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TrackingEtapaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepStatuss === null) {
			if ($this->isNew()) {
			   $this->collRepStatuss = array();
			} else {

				$criteria->add(RepStatusPeer::CA_IDETAPA, $this->ca_idetapa);

				RepStatusPeer::addSelectColumns($criteria);
				$this->collRepStatuss = RepStatusPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RepStatusPeer::CA_IDETAPA, $this->ca_idetapa);

				RepStatusPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepStatusCriteria) || !$this->lastRepStatusCriteria->equals($criteria)) {
					$this->collRepStatuss = RepStatusPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepStatusCriteria = $criteria;
		return $this->collRepStatuss;
	}

	/**
	 * Returns the number of related RepStatus objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related RepStatus objects.
	 * @throws     PropelException
	 */
	public function countRepStatuss(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TrackingEtapaPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collRepStatuss === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(RepStatusPeer::CA_IDETAPA, $this->ca_idetapa);

				$count = RepStatusPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(RepStatusPeer::CA_IDETAPA, $this->ca_idetapa);

				if (!isset($this->lastRepStatusCriteria) || !$this->lastRepStatusCriteria->equals($criteria)) {
					$count = RepStatusPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collRepStatuss);
				}
			} else {
				$count = count($this->collRepStatuss);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a RepStatus object to this object
	 * through the RepStatus foreign key attribute.
	 *
	 * @param      RepStatus $l RepStatus
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRepStatus(RepStatus $l)
	{
		if ($this->collRepStatuss === null) {
			$this->initRepStatuss();
		}
		if (!in_array($l, $this->collRepStatuss, true)) { // only add it if the **same** object is not already associated
			array_push($this->collRepStatuss, $l);
			$l->setTrackingEtapa($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TrackingEtapa is new, it will return
	 * an empty collection; or if this TrackingEtapa has previously
	 * been saved, it will retrieve related RepStatuss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TrackingEtapa.
	 */
	public function getRepStatussJoinReporte($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TrackingEtapaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepStatuss === null) {
			if ($this->isNew()) {
				$this->collRepStatuss = array();
			} else {

				$criteria->add(RepStatusPeer::CA_IDETAPA, $this->ca_idetapa);

				$this->collRepStatuss = RepStatusPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RepStatusPeer::CA_IDETAPA, $this->ca_idetapa);

			if (!isset($this->lastRepStatusCriteria) || !$this->lastRepStatusCriteria->equals($criteria)) {
				$this->collRepStatuss = RepStatusPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		}
		$this->lastRepStatusCriteria = $criteria;

		return $this->collRepStatuss;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TrackingEtapa is new, it will return
	 * an empty collection; or if this TrackingEtapa has previously
	 * been saved, it will retrieve related RepStatuss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TrackingEtapa.
	 */
	public function getRepStatussJoinEmail($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TrackingEtapaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepStatuss === null) {
			if ($this->isNew()) {
				$this->collRepStatuss = array();
			} else {

				$criteria->add(RepStatusPeer::CA_IDETAPA, $this->ca_idetapa);

				$this->collRepStatuss = RepStatusPeer::doSelectJoinEmail($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RepStatusPeer::CA_IDETAPA, $this->ca_idetapa);

			if (!isset($this->lastRepStatusCriteria) || !$this->lastRepStatusCriteria->equals($criteria)) {
				$this->collRepStatuss = RepStatusPeer::doSelectJoinEmail($criteria, $con, $join_behavior);
			}
		}
		$this->lastRepStatusCriteria = $criteria;

		return $this->collRepStatuss;
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
			if ($this->collReportes) {
				foreach ((array) $this->collReportes as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collRepStatuss) {
				foreach ((array) $this->collRepStatuss as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collReportes = null;
		$this->collRepStatuss = null;
	}

} // BaseTrackingEtapa
