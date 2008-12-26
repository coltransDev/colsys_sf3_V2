<?php

/**
 * Base class that represents a row from the 'tb_repseguro' table.
 *
 * 
 *
 * @package    lib.model.reportes.om
 */
abstract class BaseRepSeguro extends BaseObject  implements Persistent {


  const PEER = 'RepSeguroPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        RepSeguroPeer
	 */
	protected static $peer;

	/**
	 * The value for the ca_idreporte field.
	 * @var        int
	 */
	protected $ca_idreporte;

	/**
	 * The value for the ca_vlrasegurado field.
	 * @var        string
	 */
	protected $ca_vlrasegurado;

	/**
	 * The value for the ca_idmoneda_vlr field.
	 * @var        string
	 */
	protected $ca_idmoneda_vlr;

	/**
	 * The value for the ca_primaventa field.
	 * @var        string
	 */
	protected $ca_primaventa;

	/**
	 * The value for the ca_minimaventa field.
	 * @var        string
	 */
	protected $ca_minimaventa;

	/**
	 * The value for the ca_idmoneda_vta field.
	 * @var        string
	 */
	protected $ca_idmoneda_vta;

	/**
	 * The value for the ca_obtencionpoliza field.
	 * @var        string
	 */
	protected $ca_obtencionpoliza;

	/**
	 * The value for the ca_idmoneda_pol field.
	 * @var        string
	 */
	protected $ca_idmoneda_pol;

	/**
	 * The value for the ca_seguro_conf field.
	 * @var        string
	 */
	protected $ca_seguro_conf;

	/**
	 * @var        Reporte
	 */
	protected $aReporte;

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
	 * Initializes internal state of BaseRepSeguro object.
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
	 * Get the [ca_idreporte] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdreporte()
	{
		return $this->ca_idreporte;
	}

	/**
	 * Get the [ca_vlrasegurado] column value.
	 * 
	 * @return     string
	 */
	public function getCaVlrasegurado()
	{
		return $this->ca_vlrasegurado;
	}

	/**
	 * Get the [ca_idmoneda_vlr] column value.
	 * 
	 * @return     string
	 */
	public function getCaIdmonedaVlr()
	{
		return $this->ca_idmoneda_vlr;
	}

	/**
	 * Get the [ca_primaventa] column value.
	 * 
	 * @return     string
	 */
	public function getCaPrimaventa()
	{
		return $this->ca_primaventa;
	}

	/**
	 * Get the [ca_minimaventa] column value.
	 * 
	 * @return     string
	 */
	public function getCaMinimaventa()
	{
		return $this->ca_minimaventa;
	}

	/**
	 * Get the [ca_idmoneda_vta] column value.
	 * 
	 * @return     string
	 */
	public function getCaIdmonedaVta()
	{
		return $this->ca_idmoneda_vta;
	}

	/**
	 * Get the [ca_obtencionpoliza] column value.
	 * 
	 * @return     string
	 */
	public function getCaObtencionpoliza()
	{
		return $this->ca_obtencionpoliza;
	}

	/**
	 * Get the [ca_idmoneda_pol] column value.
	 * 
	 * @return     string
	 */
	public function getCaIdmonedaPol()
	{
		return $this->ca_idmoneda_pol;
	}

	/**
	 * Get the [ca_seguro_conf] column value.
	 * 
	 * @return     string
	 */
	public function getCaSeguroConf()
	{
		return $this->ca_seguro_conf;
	}

	/**
	 * Set the value of [ca_idreporte] column.
	 * 
	 * @param      int $v new value
	 * @return     RepSeguro The current object (for fluent API support)
	 */
	public function setCaIdreporte($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idreporte !== $v) {
			$this->ca_idreporte = $v;
			$this->modifiedColumns[] = RepSeguroPeer::CA_IDREPORTE;
		}

		if ($this->aReporte !== null && $this->aReporte->getCaIdreporte() !== $v) {
			$this->aReporte = null;
		}

		return $this;
	} // setCaIdreporte()

	/**
	 * Set the value of [ca_vlrasegurado] column.
	 * 
	 * @param      string $v new value
	 * @return     RepSeguro The current object (for fluent API support)
	 */
	public function setCaVlrasegurado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_vlrasegurado !== $v) {
			$this->ca_vlrasegurado = $v;
			$this->modifiedColumns[] = RepSeguroPeer::CA_VLRASEGURADO;
		}

		return $this;
	} // setCaVlrasegurado()

	/**
	 * Set the value of [ca_idmoneda_vlr] column.
	 * 
	 * @param      string $v new value
	 * @return     RepSeguro The current object (for fluent API support)
	 */
	public function setCaIdmonedaVlr($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idmoneda_vlr !== $v) {
			$this->ca_idmoneda_vlr = $v;
			$this->modifiedColumns[] = RepSeguroPeer::CA_IDMONEDA_VLR;
		}

		return $this;
	} // setCaIdmonedaVlr()

	/**
	 * Set the value of [ca_primaventa] column.
	 * 
	 * @param      string $v new value
	 * @return     RepSeguro The current object (for fluent API support)
	 */
	public function setCaPrimaventa($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_primaventa !== $v) {
			$this->ca_primaventa = $v;
			$this->modifiedColumns[] = RepSeguroPeer::CA_PRIMAVENTA;
		}

		return $this;
	} // setCaPrimaventa()

	/**
	 * Set the value of [ca_minimaventa] column.
	 * 
	 * @param      string $v new value
	 * @return     RepSeguro The current object (for fluent API support)
	 */
	public function setCaMinimaventa($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_minimaventa !== $v) {
			$this->ca_minimaventa = $v;
			$this->modifiedColumns[] = RepSeguroPeer::CA_MINIMAVENTA;
		}

		return $this;
	} // setCaMinimaventa()

	/**
	 * Set the value of [ca_idmoneda_vta] column.
	 * 
	 * @param      string $v new value
	 * @return     RepSeguro The current object (for fluent API support)
	 */
	public function setCaIdmonedaVta($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idmoneda_vta !== $v) {
			$this->ca_idmoneda_vta = $v;
			$this->modifiedColumns[] = RepSeguroPeer::CA_IDMONEDA_VTA;
		}

		return $this;
	} // setCaIdmonedaVta()

	/**
	 * Set the value of [ca_obtencionpoliza] column.
	 * 
	 * @param      string $v new value
	 * @return     RepSeguro The current object (for fluent API support)
	 */
	public function setCaObtencionpoliza($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_obtencionpoliza !== $v) {
			$this->ca_obtencionpoliza = $v;
			$this->modifiedColumns[] = RepSeguroPeer::CA_OBTENCIONPOLIZA;
		}

		return $this;
	} // setCaObtencionpoliza()

	/**
	 * Set the value of [ca_idmoneda_pol] column.
	 * 
	 * @param      string $v new value
	 * @return     RepSeguro The current object (for fluent API support)
	 */
	public function setCaIdmonedaPol($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idmoneda_pol !== $v) {
			$this->ca_idmoneda_pol = $v;
			$this->modifiedColumns[] = RepSeguroPeer::CA_IDMONEDA_POL;
		}

		return $this;
	} // setCaIdmonedaPol()

	/**
	 * Set the value of [ca_seguro_conf] column.
	 * 
	 * @param      string $v new value
	 * @return     RepSeguro The current object (for fluent API support)
	 */
	public function setCaSeguroConf($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_seguro_conf !== $v) {
			$this->ca_seguro_conf = $v;
			$this->modifiedColumns[] = RepSeguroPeer::CA_SEGURO_CONF;
		}

		return $this;
	} // setCaSeguroConf()

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

			$this->ca_idreporte = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_vlrasegurado = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_idmoneda_vlr = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_primaventa = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_minimaventa = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_idmoneda_vta = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_obtencionpoliza = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_idmoneda_pol = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_seguro_conf = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 9; // 9 = RepSeguroPeer::NUM_COLUMNS - RepSeguroPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating RepSeguro object", $e);
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

		if ($this->aReporte !== null && $this->ca_idreporte !== $this->aReporte->getCaIdreporte()) {
			$this->aReporte = null;
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
			$con = Propel::getConnection(RepSeguroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = RepSeguroPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aReporte = null;
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
			$con = Propel::getConnection(RepSeguroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			RepSeguroPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(RepSeguroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			RepSeguroPeer::addInstanceToPool($this);
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

			if ($this->aReporte !== null) {
				if ($this->aReporte->isModified() || $this->aReporte->isNew()) {
					$affectedRows += $this->aReporte->save($con);
				}
				$this->setReporte($this->aReporte);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = RepSeguroPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += RepSeguroPeer::doUpdate($this, $con);
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


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aReporte !== null) {
				if (!$this->aReporte->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aReporte->getValidationFailures());
				}
			}


			if (($retval = RepSeguroPeer::doValidate($this, $columns)) !== true) {
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
		$pos = RepSeguroPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdreporte();
				break;
			case 1:
				return $this->getCaVlrasegurado();
				break;
			case 2:
				return $this->getCaIdmonedaVlr();
				break;
			case 3:
				return $this->getCaPrimaventa();
				break;
			case 4:
				return $this->getCaMinimaventa();
				break;
			case 5:
				return $this->getCaIdmonedaVta();
				break;
			case 6:
				return $this->getCaObtencionpoliza();
				break;
			case 7:
				return $this->getCaIdmonedaPol();
				break;
			case 8:
				return $this->getCaSeguroConf();
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
		$keys = RepSeguroPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdreporte(),
			$keys[1] => $this->getCaVlrasegurado(),
			$keys[2] => $this->getCaIdmonedaVlr(),
			$keys[3] => $this->getCaPrimaventa(),
			$keys[4] => $this->getCaMinimaventa(),
			$keys[5] => $this->getCaIdmonedaVta(),
			$keys[6] => $this->getCaObtencionpoliza(),
			$keys[7] => $this->getCaIdmonedaPol(),
			$keys[8] => $this->getCaSeguroConf(),
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
		$pos = RepSeguroPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdreporte($value);
				break;
			case 1:
				$this->setCaVlrasegurado($value);
				break;
			case 2:
				$this->setCaIdmonedaVlr($value);
				break;
			case 3:
				$this->setCaPrimaventa($value);
				break;
			case 4:
				$this->setCaMinimaventa($value);
				break;
			case 5:
				$this->setCaIdmonedaVta($value);
				break;
			case 6:
				$this->setCaObtencionpoliza($value);
				break;
			case 7:
				$this->setCaIdmonedaPol($value);
				break;
			case 8:
				$this->setCaSeguroConf($value);
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
		$keys = RepSeguroPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdreporte($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaVlrasegurado($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaIdmonedaVlr($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaPrimaventa($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaMinimaventa($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaIdmonedaVta($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaObtencionpoliza($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaIdmonedaPol($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaSeguroConf($arr[$keys[8]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(RepSeguroPeer::DATABASE_NAME);

		if ($this->isColumnModified(RepSeguroPeer::CA_IDREPORTE)) $criteria->add(RepSeguroPeer::CA_IDREPORTE, $this->ca_idreporte);
		if ($this->isColumnModified(RepSeguroPeer::CA_VLRASEGURADO)) $criteria->add(RepSeguroPeer::CA_VLRASEGURADO, $this->ca_vlrasegurado);
		if ($this->isColumnModified(RepSeguroPeer::CA_IDMONEDA_VLR)) $criteria->add(RepSeguroPeer::CA_IDMONEDA_VLR, $this->ca_idmoneda_vlr);
		if ($this->isColumnModified(RepSeguroPeer::CA_PRIMAVENTA)) $criteria->add(RepSeguroPeer::CA_PRIMAVENTA, $this->ca_primaventa);
		if ($this->isColumnModified(RepSeguroPeer::CA_MINIMAVENTA)) $criteria->add(RepSeguroPeer::CA_MINIMAVENTA, $this->ca_minimaventa);
		if ($this->isColumnModified(RepSeguroPeer::CA_IDMONEDA_VTA)) $criteria->add(RepSeguroPeer::CA_IDMONEDA_VTA, $this->ca_idmoneda_vta);
		if ($this->isColumnModified(RepSeguroPeer::CA_OBTENCIONPOLIZA)) $criteria->add(RepSeguroPeer::CA_OBTENCIONPOLIZA, $this->ca_obtencionpoliza);
		if ($this->isColumnModified(RepSeguroPeer::CA_IDMONEDA_POL)) $criteria->add(RepSeguroPeer::CA_IDMONEDA_POL, $this->ca_idmoneda_pol);
		if ($this->isColumnModified(RepSeguroPeer::CA_SEGURO_CONF)) $criteria->add(RepSeguroPeer::CA_SEGURO_CONF, $this->ca_seguro_conf);

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
		$criteria = new Criteria(RepSeguroPeer::DATABASE_NAME);

		$criteria->add(RepSeguroPeer::CA_IDREPORTE, $this->ca_idreporte);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdreporte();
	}

	/**
	 * Generic method to set the primary key (ca_idreporte column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdreporte($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of RepSeguro (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdreporte($this->ca_idreporte);

		$copyObj->setCaVlrasegurado($this->ca_vlrasegurado);

		$copyObj->setCaIdmonedaVlr($this->ca_idmoneda_vlr);

		$copyObj->setCaPrimaventa($this->ca_primaventa);

		$copyObj->setCaMinimaventa($this->ca_minimaventa);

		$copyObj->setCaIdmonedaVta($this->ca_idmoneda_vta);

		$copyObj->setCaObtencionpoliza($this->ca_obtencionpoliza);

		$copyObj->setCaIdmonedaPol($this->ca_idmoneda_pol);

		$copyObj->setCaSeguroConf($this->ca_seguro_conf);


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
	 * @return     RepSeguro Clone of current object.
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
	 * @return     RepSeguroPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new RepSeguroPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Reporte object.
	 *
	 * @param      Reporte $v
	 * @return     RepSeguro The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setReporte(Reporte $v = null)
	{
		if ($v === null) {
			$this->setCaIdreporte(NULL);
		} else {
			$this->setCaIdreporte($v->getCaIdreporte());
		}

		$this->aReporte = $v;

		// Add binding for other direction of this 1:1 relationship.
		if ($v !== null) {
			$v->setRepSeguro($this);
		}

		return $this;
	}


	/**
	 * Get the associated Reporte object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Reporte The associated Reporte object.
	 * @throws     PropelException
	 */
	public function getReporte(PropelPDO $con = null)
	{
		if ($this->aReporte === null && ($this->ca_idreporte !== null)) {
			$c = new Criteria(ReportePeer::DATABASE_NAME);
			$c->add(ReportePeer::CA_IDREPORTE, $this->ca_idreporte);
			$this->aReporte = ReportePeer::doSelectOne($c, $con);
			// Because this foreign key represents a one-to-one relationship, we will create a bi-directional association.
			$this->aReporte->setRepSeguro($this);
		}
		return $this->aReporte;
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

			$this->aReporte = null;
	}

} // BaseRepSeguro
