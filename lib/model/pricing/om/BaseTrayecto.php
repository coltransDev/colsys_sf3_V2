<?php

/**
 * Base class that represents a row from the 'tb_trayectos' table.
 *
 * 
 *
 * @package    lib.model.pricing.om
 */
abstract class BaseTrayecto extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        TrayectoPeer
	 */
	protected static $peer;


	/**
	 * The value for the oid field.
	 * @var        int
	 */
	protected $oid;


	/**
	 * The value for the ca_idtrayecto field.
	 * @var        int
	 */
	protected $ca_idtrayecto;


	/**
	 * The value for the ca_origen field.
	 * @var        string
	 */
	protected $ca_origen;


	/**
	 * The value for the ca_destino field.
	 * @var        string
	 */
	protected $ca_destino;


	/**
	 * The value for the ca_idlinea field.
	 * @var        int
	 */
	protected $ca_idlinea;


	/**
	 * The value for the ca_transporte field.
	 * @var        string
	 */
	protected $ca_transporte;


	/**
	 * The value for the ca_terminal field.
	 * @var        string
	 */
	protected $ca_terminal;


	/**
	 * The value for the ca_impoexpo field.
	 * @var        string
	 */
	protected $ca_impoexpo;


	/**
	 * The value for the ca_frecuencia field.
	 * @var        string
	 */
	protected $ca_frecuencia;


	/**
	 * The value for the ca_tiempotransito field.
	 * @var        string
	 */
	protected $ca_tiempotransito;


	/**
	 * The value for the ca_modalidad field.
	 * @var        string
	 */
	protected $ca_modalidad;


	/**
	 * The value for the ca_fchcreado field.
	 * @var        int
	 */
	protected $ca_fchcreado;


	/**
	 * The value for the ca_idtarifas field.
	 * @var        int
	 */
	protected $ca_idtarifas;


	/**
	 * The value for the ca_observaciones field.
	 * @var        string
	 */
	protected $ca_observaciones;


	/**
	 * The value for the ca_idagente field.
	 * @var        int
	 */
	protected $ca_idagente;

	/**
	 * @var        Transportador
	 */
	protected $aTransportador;

	/**
	 * @var        Agente
	 */
	protected $aAgente;

	/**
	 * Collection to store aggregation of collPricFletes.
	 * @var        array
	 */
	protected $collPricFletes;

	/**
	 * The criteria used to select the current contents of collPricFletes.
	 * @var        Criteria
	 */
	protected $lastPricFleteCriteria = null;

	/**
	 * Collection to store aggregation of collPricFleteLogs.
	 * @var        array
	 */
	protected $collPricFleteLogs;

	/**
	 * The criteria used to select the current contents of collPricFleteLogs.
	 * @var        Criteria
	 */
	protected $lastPricFleteLogCriteria = null;

	/**
	 * Collection to store aggregation of collFletes.
	 * @var        array
	 */
	protected $collFletes;

	/**
	 * The criteria used to select the current contents of collFletes.
	 * @var        Criteria
	 */
	protected $lastFleteCriteria = null;

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
	 * Get the [oid] column value.
	 * 
	 * @return     int
	 */
	public function getOid()
	{

		return $this->oid;
	}

	/**
	 * Get the [ca_idtrayecto] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdtrayecto()
	{

		return $this->ca_idtrayecto;
	}

	/**
	 * Get the [ca_origen] column value.
	 * 
	 * @return     string
	 */
	public function getCaOrigen()
	{

		return $this->ca_origen;
	}

	/**
	 * Get the [ca_destino] column value.
	 * 
	 * @return     string
	 */
	public function getCaDestino()
	{

		return $this->ca_destino;
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
	 * Get the [ca_transporte] column value.
	 * 
	 * @return     string
	 */
	public function getCaTransporte()
	{

		return $this->ca_transporte;
	}

	/**
	 * Get the [ca_terminal] column value.
	 * 
	 * @return     string
	 */
	public function getCaTerminal()
	{

		return $this->ca_terminal;
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
	 * Get the [ca_frecuencia] column value.
	 * 
	 * @return     string
	 */
	public function getCaFrecuencia()
	{

		return $this->ca_frecuencia;
	}

	/**
	 * Get the [ca_tiempotransito] column value.
	 * 
	 * @return     string
	 */
	public function getCaTiempotransito()
	{

		return $this->ca_tiempotransito;
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
	 * Get the [optionally formatted] [ca_fchcreado] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchcreado($format = 'Y-m-d')
	{

		if ($this->ca_fchcreado === null || $this->ca_fchcreado === '') {
			return null;
		} elseif (!is_int($this->ca_fchcreado)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_fchcreado);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_fchcreado] as date/time value: " . var_export($this->ca_fchcreado, true));
			}
		} else {
			$ts = $this->ca_fchcreado;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	/**
	 * Get the [ca_idtarifas] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdtarifas()
	{

		return $this->ca_idtarifas;
	}

	/**
	 * Get the [ca_observaciones] column value.
	 * 
	 * @return     string
	 */
	public function getCaObservaciones()
	{

		return $this->ca_observaciones;
	}

	/**
	 * Get the [ca_idagente] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdagente()
	{

		return $this->ca_idagente;
	}

	/**
	 * Set the value of [oid] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setOid($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->oid !== $v) {
			$this->oid = $v;
			$this->modifiedColumns[] = TrayectoPeer::OID;
		}

	} // setOid()

	/**
	 * Set the value of [ca_idtrayecto] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdtrayecto($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idtrayecto !== $v) {
			$this->ca_idtrayecto = $v;
			$this->modifiedColumns[] = TrayectoPeer::CA_IDTRAYECTO;
		}

	} // setCaIdtrayecto()

	/**
	 * Set the value of [ca_origen] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaOrigen($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_origen !== $v) {
			$this->ca_origen = $v;
			$this->modifiedColumns[] = TrayectoPeer::CA_ORIGEN;
		}

	} // setCaOrigen()

	/**
	 * Set the value of [ca_destino] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaDestino($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_destino !== $v) {
			$this->ca_destino = $v;
			$this->modifiedColumns[] = TrayectoPeer::CA_DESTINO;
		}

	} // setCaDestino()

	/**
	 * Set the value of [ca_idlinea] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdlinea($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idlinea !== $v) {
			$this->ca_idlinea = $v;
			$this->modifiedColumns[] = TrayectoPeer::CA_IDLINEA;
		}

		if ($this->aTransportador !== null && $this->aTransportador->getCaIdlinea() !== $v) {
			$this->aTransportador = null;
		}

	} // setCaIdlinea()

	/**
	 * Set the value of [ca_transporte] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaTransporte($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_transporte !== $v) {
			$this->ca_transporte = $v;
			$this->modifiedColumns[] = TrayectoPeer::CA_TRANSPORTE;
		}

	} // setCaTransporte()

	/**
	 * Set the value of [ca_terminal] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaTerminal($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_terminal !== $v) {
			$this->ca_terminal = $v;
			$this->modifiedColumns[] = TrayectoPeer::CA_TERMINAL;
		}

	} // setCaTerminal()

	/**
	 * Set the value of [ca_impoexpo] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaImpoexpo($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_impoexpo !== $v) {
			$this->ca_impoexpo = $v;
			$this->modifiedColumns[] = TrayectoPeer::CA_IMPOEXPO;
		}

	} // setCaImpoexpo()

	/**
	 * Set the value of [ca_frecuencia] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaFrecuencia($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_frecuencia !== $v) {
			$this->ca_frecuencia = $v;
			$this->modifiedColumns[] = TrayectoPeer::CA_FRECUENCIA;
		}

	} // setCaFrecuencia()

	/**
	 * Set the value of [ca_tiempotransito] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaTiempotransito($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_tiempotransito !== $v) {
			$this->ca_tiempotransito = $v;
			$this->modifiedColumns[] = TrayectoPeer::CA_TIEMPOTRANSITO;
		}

	} // setCaTiempotransito()

	/**
	 * Set the value of [ca_modalidad] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaModalidad($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_modalidad !== $v) {
			$this->ca_modalidad = $v;
			$this->modifiedColumns[] = TrayectoPeer::CA_MODALIDAD;
		}

	} // setCaModalidad()

	/**
	 * Set the value of [ca_fchcreado] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaFchcreado($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_fchcreado] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_fchcreado !== $ts) {
			$this->ca_fchcreado = $ts;
			$this->modifiedColumns[] = TrayectoPeer::CA_FCHCREADO;
		}

	} // setCaFchcreado()

	/**
	 * Set the value of [ca_idtarifas] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdtarifas($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idtarifas !== $v) {
			$this->ca_idtarifas = $v;
			$this->modifiedColumns[] = TrayectoPeer::CA_IDTARIFAS;
		}

	} // setCaIdtarifas()

	/**
	 * Set the value of [ca_observaciones] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaObservaciones($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_observaciones !== $v) {
			$this->ca_observaciones = $v;
			$this->modifiedColumns[] = TrayectoPeer::CA_OBSERVACIONES;
		}

	} // setCaObservaciones()

	/**
	 * Set the value of [ca_idagente] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdagente($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idagente !== $v) {
			$this->ca_idagente = $v;
			$this->modifiedColumns[] = TrayectoPeer::CA_IDAGENTE;
		}

		if ($this->aAgente !== null && $this->aAgente->getCaIdagente() !== $v) {
			$this->aAgente = null;
		}

	} // setCaIdagente()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (1-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      ResultSet $rs The ResultSet class with cursor advanced to desired record pos.
	 * @param      int $startcol 1-based offset column which indicates which restultset column to start with.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->oid = $rs->getInt($startcol + 0);

			$this->ca_idtrayecto = $rs->getInt($startcol + 1);

			$this->ca_origen = $rs->getString($startcol + 2);

			$this->ca_destino = $rs->getString($startcol + 3);

			$this->ca_idlinea = $rs->getInt($startcol + 4);

			$this->ca_transporte = $rs->getString($startcol + 5);

			$this->ca_terminal = $rs->getString($startcol + 6);

			$this->ca_impoexpo = $rs->getString($startcol + 7);

			$this->ca_frecuencia = $rs->getString($startcol + 8);

			$this->ca_tiempotransito = $rs->getString($startcol + 9);

			$this->ca_modalidad = $rs->getString($startcol + 10);

			$this->ca_fchcreado = $rs->getDate($startcol + 11, null);

			$this->ca_idtarifas = $rs->getInt($startcol + 12);

			$this->ca_observaciones = $rs->getString($startcol + 13);

			$this->ca_idagente = $rs->getInt($startcol + 14);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 15; // 15 = TrayectoPeer::NUM_COLUMNS - TrayectoPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Trayecto object", $e);
		}
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      Connection $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TrayectoPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			TrayectoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Stores the object in the database.  If the object is new,
	 * it inserts it; otherwise an update is performed.  This method
	 * wraps the doSave() worker method in a transaction.
	 *
	 * @param      Connection $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TrayectoPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Stores the object in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      Connection $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave($con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aTransportador !== null) {
				if ($this->aTransportador->isModified()) {
					$affectedRows += $this->aTransportador->save($con);
				}
				$this->setTransportador($this->aTransportador);
			}

			if ($this->aAgente !== null) {
				if ($this->aAgente->isModified()) {
					$affectedRows += $this->aAgente->save($con);
				}
				$this->setAgente($this->aAgente);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TrayectoPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += TrayectoPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collPricFletes !== null) {
				foreach($this->collPricFletes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPricFleteLogs !== null) {
				foreach($this->collPricFleteLogs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collFletes !== null) {
				foreach($this->collFletes as $referrerFK) {
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

			if ($this->aTransportador !== null) {
				if (!$this->aTransportador->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTransportador->getValidationFailures());
				}
			}

			if ($this->aAgente !== null) {
				if (!$this->aAgente->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAgente->getValidationFailures());
				}
			}


			if (($retval = TrayectoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collPricFletes !== null) {
					foreach($this->collPricFletes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPricFleteLogs !== null) {
					foreach($this->collPricFleteLogs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collFletes !== null) {
					foreach($this->collFletes as $referrerFK) {
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
	 *                     one of the class type constants TYPE_PHPNAME,
	 *                     TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TrayectoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
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
				return $this->getOid();
				break;
			case 1:
				return $this->getCaIdtrayecto();
				break;
			case 2:
				return $this->getCaOrigen();
				break;
			case 3:
				return $this->getCaDestino();
				break;
			case 4:
				return $this->getCaIdlinea();
				break;
			case 5:
				return $this->getCaTransporte();
				break;
			case 6:
				return $this->getCaTerminal();
				break;
			case 7:
				return $this->getCaImpoexpo();
				break;
			case 8:
				return $this->getCaFrecuencia();
				break;
			case 9:
				return $this->getCaTiempotransito();
				break;
			case 10:
				return $this->getCaModalidad();
				break;
			case 11:
				return $this->getCaFchcreado();
				break;
			case 12:
				return $this->getCaIdtarifas();
				break;
			case 13:
				return $this->getCaObservaciones();
				break;
			case 14:
				return $this->getCaIdagente();
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
	 * @param      string $keyType One of the class type constants TYPE_PHPNAME,
	 *                        TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TrayectoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getOid(),
			$keys[1] => $this->getCaIdtrayecto(),
			$keys[2] => $this->getCaOrigen(),
			$keys[3] => $this->getCaDestino(),
			$keys[4] => $this->getCaIdlinea(),
			$keys[5] => $this->getCaTransporte(),
			$keys[6] => $this->getCaTerminal(),
			$keys[7] => $this->getCaImpoexpo(),
			$keys[8] => $this->getCaFrecuencia(),
			$keys[9] => $this->getCaTiempotransito(),
			$keys[10] => $this->getCaModalidad(),
			$keys[11] => $this->getCaFchcreado(),
			$keys[12] => $this->getCaIdtarifas(),
			$keys[13] => $this->getCaObservaciones(),
			$keys[14] => $this->getCaIdagente(),
		);
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants TYPE_PHPNAME,
	 *                     TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TrayectoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setOid($value);
				break;
			case 1:
				$this->setCaIdtrayecto($value);
				break;
			case 2:
				$this->setCaOrigen($value);
				break;
			case 3:
				$this->setCaDestino($value);
				break;
			case 4:
				$this->setCaIdlinea($value);
				break;
			case 5:
				$this->setCaTransporte($value);
				break;
			case 6:
				$this->setCaTerminal($value);
				break;
			case 7:
				$this->setCaImpoexpo($value);
				break;
			case 8:
				$this->setCaFrecuencia($value);
				break;
			case 9:
				$this->setCaTiempotransito($value);
				break;
			case 10:
				$this->setCaModalidad($value);
				break;
			case 11:
				$this->setCaFchcreado($value);
				break;
			case 12:
				$this->setCaIdtarifas($value);
				break;
			case 13:
				$this->setCaObservaciones($value);
				break;
			case 14:
				$this->setCaIdagente($value);
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
	 * of the class type constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME,
	 * TYPE_NUM. The default key type is the column's phpname (e.g. 'authorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TrayectoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setOid($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdtrayecto($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaOrigen($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaDestino($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaIdlinea($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaTransporte($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaTerminal($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaImpoexpo($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaFrecuencia($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaTiempotransito($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaModalidad($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaFchcreado($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaIdtarifas($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaObservaciones($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaIdagente($arr[$keys[14]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(TrayectoPeer::DATABASE_NAME);

		if ($this->isColumnModified(TrayectoPeer::OID)) $criteria->add(TrayectoPeer::OID, $this->oid);
		if ($this->isColumnModified(TrayectoPeer::CA_IDTRAYECTO)) $criteria->add(TrayectoPeer::CA_IDTRAYECTO, $this->ca_idtrayecto);
		if ($this->isColumnModified(TrayectoPeer::CA_ORIGEN)) $criteria->add(TrayectoPeer::CA_ORIGEN, $this->ca_origen);
		if ($this->isColumnModified(TrayectoPeer::CA_DESTINO)) $criteria->add(TrayectoPeer::CA_DESTINO, $this->ca_destino);
		if ($this->isColumnModified(TrayectoPeer::CA_IDLINEA)) $criteria->add(TrayectoPeer::CA_IDLINEA, $this->ca_idlinea);
		if ($this->isColumnModified(TrayectoPeer::CA_TRANSPORTE)) $criteria->add(TrayectoPeer::CA_TRANSPORTE, $this->ca_transporte);
		if ($this->isColumnModified(TrayectoPeer::CA_TERMINAL)) $criteria->add(TrayectoPeer::CA_TERMINAL, $this->ca_terminal);
		if ($this->isColumnModified(TrayectoPeer::CA_IMPOEXPO)) $criteria->add(TrayectoPeer::CA_IMPOEXPO, $this->ca_impoexpo);
		if ($this->isColumnModified(TrayectoPeer::CA_FRECUENCIA)) $criteria->add(TrayectoPeer::CA_FRECUENCIA, $this->ca_frecuencia);
		if ($this->isColumnModified(TrayectoPeer::CA_TIEMPOTRANSITO)) $criteria->add(TrayectoPeer::CA_TIEMPOTRANSITO, $this->ca_tiempotransito);
		if ($this->isColumnModified(TrayectoPeer::CA_MODALIDAD)) $criteria->add(TrayectoPeer::CA_MODALIDAD, $this->ca_modalidad);
		if ($this->isColumnModified(TrayectoPeer::CA_FCHCREADO)) $criteria->add(TrayectoPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(TrayectoPeer::CA_IDTARIFAS)) $criteria->add(TrayectoPeer::CA_IDTARIFAS, $this->ca_idtarifas);
		if ($this->isColumnModified(TrayectoPeer::CA_OBSERVACIONES)) $criteria->add(TrayectoPeer::CA_OBSERVACIONES, $this->ca_observaciones);
		if ($this->isColumnModified(TrayectoPeer::CA_IDAGENTE)) $criteria->add(TrayectoPeer::CA_IDAGENTE, $this->ca_idagente);

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
		$criteria = new Criteria(TrayectoPeer::DATABASE_NAME);

		$criteria->add(TrayectoPeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdtrayecto();
	}

	/**
	 * Generic method to set the primary key (ca_idtrayecto column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdtrayecto($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Trayecto (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setOid($this->oid);

		$copyObj->setCaOrigen($this->ca_origen);

		$copyObj->setCaDestino($this->ca_destino);

		$copyObj->setCaIdlinea($this->ca_idlinea);

		$copyObj->setCaTransporte($this->ca_transporte);

		$copyObj->setCaTerminal($this->ca_terminal);

		$copyObj->setCaImpoexpo($this->ca_impoexpo);

		$copyObj->setCaFrecuencia($this->ca_frecuencia);

		$copyObj->setCaTiempotransito($this->ca_tiempotransito);

		$copyObj->setCaModalidad($this->ca_modalidad);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaIdtarifas($this->ca_idtarifas);

		$copyObj->setCaObservaciones($this->ca_observaciones);

		$copyObj->setCaIdagente($this->ca_idagente);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getPricFletes() as $relObj) {
				$copyObj->addPricFlete($relObj->copy($deepCopy));
			}

			foreach($this->getPricFleteLogs() as $relObj) {
				$copyObj->addPricFleteLog($relObj->copy($deepCopy));
			}

			foreach($this->getFletes() as $relObj) {
				$copyObj->addFlete($relObj->copy($deepCopy));
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setCaIdtrayecto(NULL); // this is a pkey column, so set to default value

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
	 * @return     Trayecto Clone of current object.
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
	 * @return     TrayectoPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new TrayectoPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Transportador object.
	 *
	 * @param      Transportador $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setTransportador($v)
	{


		if ($v === null) {
			$this->setCaIdlinea(NULL);
		} else {
			$this->setCaIdlinea($v->getCaIdlinea());
		}


		$this->aTransportador = $v;
	}


	/**
	 * Get the associated Transportador object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Transportador The associated Transportador object.
	 * @throws     PropelException
	 */
	public function getTransportador($con = null)
	{
		if ($this->aTransportador === null && ($this->ca_idlinea !== null)) {
			// include the related Peer class
			$this->aTransportador = TransportadorPeer::retrieveByPK($this->ca_idlinea, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = TransportadorPeer::retrieveByPK($this->ca_idlinea, $con);
			   $obj->addTransportadors($this);
			 */
		}
		return $this->aTransportador;
	}

	/**
	 * Declares an association between this object and a Agente object.
	 *
	 * @param      Agente $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setAgente($v)
	{


		if ($v === null) {
			$this->setCaIdagente(NULL);
		} else {
			$this->setCaIdagente($v->getCaIdagente());
		}


		$this->aAgente = $v;
	}


	/**
	 * Get the associated Agente object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Agente The associated Agente object.
	 * @throws     PropelException
	 */
	public function getAgente($con = null)
	{
		if ($this->aAgente === null && ($this->ca_idagente !== null)) {
			// include the related Peer class
			$this->aAgente = AgentePeer::retrieveByPK($this->ca_idagente, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = AgentePeer::retrieveByPK($this->ca_idagente, $con);
			   $obj->addAgentes($this);
			 */
		}
		return $this->aAgente;
	}

	/**
	 * Temporary storage of collPricFletes to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initPricFletes()
	{
		if ($this->collPricFletes === null) {
			$this->collPricFletes = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Trayecto has previously
	 * been saved, it will retrieve related PricFletes from storage.
	 * If this Trayecto is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getPricFletes($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricFletes === null) {
			if ($this->isNew()) {
			   $this->collPricFletes = array();
			} else {

				$criteria->add(PricFletePeer::CA_IDTRAYECTO, $this->getCaIdtrayecto());

				PricFletePeer::addSelectColumns($criteria);
				$this->collPricFletes = PricFletePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PricFletePeer::CA_IDTRAYECTO, $this->getCaIdtrayecto());

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
	 * Returns the number of related PricFletes.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countPricFletes($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PricFletePeer::CA_IDTRAYECTO, $this->getCaIdtrayecto());

		return PricFletePeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a PricFlete object to this object
	 * through the PricFlete foreign key attribute
	 *
	 * @param      PricFlete $l PricFlete
	 * @return     void
	 * @throws     PropelException
	 */
	public function addPricFlete(PricFlete $l)
	{
		$this->collPricFletes[] = $l;
		$l->setTrayecto($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Trayecto is new, it will return
	 * an empty collection; or if this Trayecto has previously
	 * been saved, it will retrieve related PricFletes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Trayecto.
	 */
	public function getPricFletesJoinConcepto($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricFletes === null) {
			if ($this->isNew()) {
				$this->collPricFletes = array();
			} else {

				$criteria->add(PricFletePeer::CA_IDTRAYECTO, $this->getCaIdtrayecto());

				$this->collPricFletes = PricFletePeer::doSelectJoinConcepto($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PricFletePeer::CA_IDTRAYECTO, $this->getCaIdtrayecto());

			if (!isset($this->lastPricFleteCriteria) || !$this->lastPricFleteCriteria->equals($criteria)) {
				$this->collPricFletes = PricFletePeer::doSelectJoinConcepto($criteria, $con);
			}
		}
		$this->lastPricFleteCriteria = $criteria;

		return $this->collPricFletes;
	}

	/**
	 * Temporary storage of collPricFleteLogs to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initPricFleteLogs()
	{
		if ($this->collPricFleteLogs === null) {
			$this->collPricFleteLogs = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Trayecto has previously
	 * been saved, it will retrieve related PricFleteLogs from storage.
	 * If this Trayecto is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getPricFleteLogs($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricFleteLogs === null) {
			if ($this->isNew()) {
			   $this->collPricFleteLogs = array();
			} else {

				$criteria->add(PricFleteLogPeer::CA_IDTRAYECTO, $this->getCaIdtrayecto());

				PricFleteLogPeer::addSelectColumns($criteria);
				$this->collPricFleteLogs = PricFleteLogPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PricFleteLogPeer::CA_IDTRAYECTO, $this->getCaIdtrayecto());

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
	 * Returns the number of related PricFleteLogs.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countPricFleteLogs($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PricFleteLogPeer::CA_IDTRAYECTO, $this->getCaIdtrayecto());

		return PricFleteLogPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a PricFleteLog object to this object
	 * through the PricFleteLog foreign key attribute
	 *
	 * @param      PricFleteLog $l PricFleteLog
	 * @return     void
	 * @throws     PropelException
	 */
	public function addPricFleteLog(PricFleteLog $l)
	{
		$this->collPricFleteLogs[] = $l;
		$l->setTrayecto($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Trayecto is new, it will return
	 * an empty collection; or if this Trayecto has previously
	 * been saved, it will retrieve related PricFleteLogs from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Trayecto.
	 */
	public function getPricFleteLogsJoinConcepto($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricFleteLogs === null) {
			if ($this->isNew()) {
				$this->collPricFleteLogs = array();
			} else {

				$criteria->add(PricFleteLogPeer::CA_IDTRAYECTO, $this->getCaIdtrayecto());

				$this->collPricFleteLogs = PricFleteLogPeer::doSelectJoinConcepto($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PricFleteLogPeer::CA_IDTRAYECTO, $this->getCaIdtrayecto());

			if (!isset($this->lastPricFleteLogCriteria) || !$this->lastPricFleteLogCriteria->equals($criteria)) {
				$this->collPricFleteLogs = PricFleteLogPeer::doSelectJoinConcepto($criteria, $con);
			}
		}
		$this->lastPricFleteLogCriteria = $criteria;

		return $this->collPricFleteLogs;
	}

	/**
	 * Temporary storage of collFletes to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initFletes()
	{
		if ($this->collFletes === null) {
			$this->collFletes = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Trayecto has previously
	 * been saved, it will retrieve related Fletes from storage.
	 * If this Trayecto is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getFletes($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFletes === null) {
			if ($this->isNew()) {
			   $this->collFletes = array();
			} else {

				$criteria->add(FletePeer::CA_IDTRAYECTO, $this->getCaIdtrayecto());

				FletePeer::addSelectColumns($criteria);
				$this->collFletes = FletePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(FletePeer::CA_IDTRAYECTO, $this->getCaIdtrayecto());

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
	 * Returns the number of related Fletes.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countFletes($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(FletePeer::CA_IDTRAYECTO, $this->getCaIdtrayecto());

		return FletePeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Flete object to this object
	 * through the Flete foreign key attribute
	 *
	 * @param      Flete $l Flete
	 * @return     void
	 * @throws     PropelException
	 */
	public function addFlete(Flete $l)
	{
		$this->collFletes[] = $l;
		$l->setTrayecto($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Trayecto is new, it will return
	 * an empty collection; or if this Trayecto has previously
	 * been saved, it will retrieve related Fletes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Trayecto.
	 */
	public function getFletesJoinConcepto($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFletes === null) {
			if ($this->isNew()) {
				$this->collFletes = array();
			} else {

				$criteria->add(FletePeer::CA_IDTRAYECTO, $this->getCaIdtrayecto());

				$this->collFletes = FletePeer::doSelectJoinConcepto($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(FletePeer::CA_IDTRAYECTO, $this->getCaIdtrayecto());

			if (!isset($this->lastFleteCriteria) || !$this->lastFleteCriteria->equals($criteria)) {
				$this->collFletes = FletePeer::doSelectJoinConcepto($criteria, $con);
			}
		}
		$this->lastFleteCriteria = $criteria;

		return $this->collFletes;
	}

} // BaseTrayecto
