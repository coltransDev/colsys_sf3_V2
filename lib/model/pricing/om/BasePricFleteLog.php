<?php

/**
 * Base class that represents a row from the 'bs_pricfletes' table.
 *
 * 
 *
 * @package    lib.model.pricing.om
 */
abstract class BasePricFleteLog extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        PricFleteLogPeer
	 */
	protected static $peer;


	/**
	 * The value for the ca_idtrayecto field.
	 * @var        int
	 */
	protected $ca_idtrayecto;


	/**
	 * The value for the ca_idconcepto field.
	 * @var        int
	 */
	protected $ca_idconcepto;


	/**
	 * The value for the ca_vlrneto field.
	 * @var        double
	 */
	protected $ca_vlrneto;


	/**
	 * The value for the ca_vlrsugerido field.
	 * @var        double
	 */
	protected $ca_vlrsugerido;


	/**
	 * The value for the ca_fchinicio field.
	 * @var        int
	 */
	protected $ca_fchinicio;


	/**
	 * The value for the ca_fchvencimiento field.
	 * @var        int
	 */
	protected $ca_fchvencimiento;


	/**
	 * The value for the ca_idmoneda field.
	 * @var        string
	 */
	protected $ca_idmoneda;


	/**
	 * The value for the ca_fchcreado field.
	 * @var        int
	 */
	protected $ca_fchcreado;


	/**
	 * The value for the ca_usucreado field.
	 * @var        string
	 */
	protected $ca_usucreado;


	/**
	 * The value for the ca_estado field.
	 * @var        int
	 */
	protected $ca_estado;


	/**
	 * The value for the ca_aplicacion field.
	 * @var        string
	 */
	protected $ca_aplicacion;


	/**
	 * The value for the ca_consecutivo field.
	 * @var        int
	 */
	protected $ca_consecutivo;

	/**
	 * @var        Trayecto
	 */
	protected $aTrayecto;

	/**
	 * @var        Concepto
	 */
	protected $aConcepto;

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
	 * Get the [ca_idtrayecto] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdtrayecto()
	{

		return $this->ca_idtrayecto;
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
	 * Get the [ca_vlrneto] column value.
	 * 
	 * @return     double
	 */
	public function getCaVlrneto()
	{

		return $this->ca_vlrneto;
	}

	/**
	 * Get the [ca_vlrsugerido] column value.
	 * 
	 * @return     double
	 */
	public function getCaVlrsugerido()
	{

		return $this->ca_vlrsugerido;
	}

	/**
	 * Get the [optionally formatted] [ca_fchinicio] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchinicio($format = 'Y-m-d')
	{

		if ($this->ca_fchinicio === null || $this->ca_fchinicio === '') {
			return null;
		} elseif (!is_int($this->ca_fchinicio)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_fchinicio);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_fchinicio] as date/time value: " . var_export($this->ca_fchinicio, true));
			}
		} else {
			$ts = $this->ca_fchinicio;
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
	 * Get the [optionally formatted] [ca_fchvencimiento] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchvencimiento($format = 'Y-m-d')
	{

		if ($this->ca_fchvencimiento === null || $this->ca_fchvencimiento === '') {
			return null;
		} elseif (!is_int($this->ca_fchvencimiento)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_fchvencimiento);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_fchvencimiento] as date/time value: " . var_export($this->ca_fchvencimiento, true));
			}
		} else {
			$ts = $this->ca_fchvencimiento;
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
	 * Get the [ca_idmoneda] column value.
	 * 
	 * @return     string
	 */
	public function getCaIdmoneda()
	{

		return $this->ca_idmoneda;
	}

	/**
	 * Get the [optionally formatted] [ca_fchcreado] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchcreado($format = 'Y-m-d H:i:s')
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
	 * Get the [ca_usucreado] column value.
	 * 
	 * @return     string
	 */
	public function getCaUsucreado()
	{

		return $this->ca_usucreado;
	}

	/**
	 * Get the [ca_estado] column value.
	 * 
	 * @return     int
	 */
	public function getCaEstado()
	{

		return $this->ca_estado;
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
	 * Get the [ca_consecutivo] column value.
	 * 
	 * @return     int
	 */
	public function getCaConsecutivo()
	{

		return $this->ca_consecutivo;
	}

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
			$this->modifiedColumns[] = PricFleteLogPeer::CA_IDTRAYECTO;
		}

		if ($this->aTrayecto !== null && $this->aTrayecto->getCaIdtrayecto() !== $v) {
			$this->aTrayecto = null;
		}

	} // setCaIdtrayecto()

	/**
	 * Set the value of [ca_idconcepto] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdconcepto($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idconcepto !== $v) {
			$this->ca_idconcepto = $v;
			$this->modifiedColumns[] = PricFleteLogPeer::CA_IDCONCEPTO;
		}

		if ($this->aConcepto !== null && $this->aConcepto->getCaIdconcepto() !== $v) {
			$this->aConcepto = null;
		}

	} // setCaIdconcepto()

	/**
	 * Set the value of [ca_vlrneto] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaVlrneto($v)
	{

		if ($this->ca_vlrneto !== $v) {
			$this->ca_vlrneto = $v;
			$this->modifiedColumns[] = PricFleteLogPeer::CA_VLRNETO;
		}

	} // setCaVlrneto()

	/**
	 * Set the value of [ca_vlrsugerido] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaVlrsugerido($v)
	{

		if ($this->ca_vlrsugerido !== $v) {
			$this->ca_vlrsugerido = $v;
			$this->modifiedColumns[] = PricFleteLogPeer::CA_VLRSUGERIDO;
		}

	} // setCaVlrsugerido()

	/**
	 * Set the value of [ca_fchinicio] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaFchinicio($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_fchinicio] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_fchinicio !== $ts) {
			$this->ca_fchinicio = $ts;
			$this->modifiedColumns[] = PricFleteLogPeer::CA_FCHINICIO;
		}

	} // setCaFchinicio()

	/**
	 * Set the value of [ca_fchvencimiento] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaFchvencimiento($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_fchvencimiento] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_fchvencimiento !== $ts) {
			$this->ca_fchvencimiento = $ts;
			$this->modifiedColumns[] = PricFleteLogPeer::CA_FCHVENCIMIENTO;
		}

	} // setCaFchvencimiento()

	/**
	 * Set the value of [ca_idmoneda] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaIdmoneda($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_idmoneda !== $v) {
			$this->ca_idmoneda = $v;
			$this->modifiedColumns[] = PricFleteLogPeer::CA_IDMONEDA;
		}

	} // setCaIdmoneda()

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
			$this->modifiedColumns[] = PricFleteLogPeer::CA_FCHCREADO;
		}

	} // setCaFchcreado()

	/**
	 * Set the value of [ca_usucreado] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaUsucreado($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_usucreado !== $v) {
			$this->ca_usucreado = $v;
			$this->modifiedColumns[] = PricFleteLogPeer::CA_USUCREADO;
		}

	} // setCaUsucreado()

	/**
	 * Set the value of [ca_estado] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaEstado($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_estado !== $v) {
			$this->ca_estado = $v;
			$this->modifiedColumns[] = PricFleteLogPeer::CA_ESTADO;
		}

	} // setCaEstado()

	/**
	 * Set the value of [ca_aplicacion] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaAplicacion($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_aplicacion !== $v) {
			$this->ca_aplicacion = $v;
			$this->modifiedColumns[] = PricFleteLogPeer::CA_APLICACION;
		}

	} // setCaAplicacion()

	/**
	 * Set the value of [ca_consecutivo] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaConsecutivo($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_consecutivo !== $v) {
			$this->ca_consecutivo = $v;
			$this->modifiedColumns[] = PricFleteLogPeer::CA_CONSECUTIVO;
		}

	} // setCaConsecutivo()

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

			$this->ca_idtrayecto = $rs->getInt($startcol + 0);

			$this->ca_idconcepto = $rs->getInt($startcol + 1);

			$this->ca_vlrneto = $rs->getFloat($startcol + 2);

			$this->ca_vlrsugerido = $rs->getFloat($startcol + 3);

			$this->ca_fchinicio = $rs->getDate($startcol + 4, null);

			$this->ca_fchvencimiento = $rs->getDate($startcol + 5, null);

			$this->ca_idmoneda = $rs->getString($startcol + 6);

			$this->ca_fchcreado = $rs->getTimestamp($startcol + 7, null);

			$this->ca_usucreado = $rs->getString($startcol + 8);

			$this->ca_estado = $rs->getInt($startcol + 9);

			$this->ca_aplicacion = $rs->getString($startcol + 10);

			$this->ca_consecutivo = $rs->getInt($startcol + 11);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 12; // 12 = PricFleteLogPeer::NUM_COLUMNS - PricFleteLogPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating PricFleteLog object", $e);
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
			$con = Propel::getConnection(PricFleteLogPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PricFleteLogPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(PricFleteLogPeer::DATABASE_NAME);
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

			if ($this->aTrayecto !== null) {
				if ($this->aTrayecto->isModified()) {
					$affectedRows += $this->aTrayecto->save($con);
				}
				$this->setTrayecto($this->aTrayecto);
			}

			if ($this->aConcepto !== null) {
				if ($this->aConcepto->isModified()) {
					$affectedRows += $this->aConcepto->save($con);
				}
				$this->setConcepto($this->aConcepto);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = PricFleteLogPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += PricFleteLogPeer::doUpdate($this, $con);
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

			if ($this->aTrayecto !== null) {
				if (!$this->aTrayecto->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTrayecto->getValidationFailures());
				}
			}

			if ($this->aConcepto !== null) {
				if (!$this->aConcepto->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aConcepto->getValidationFailures());
				}
			}


			if (($retval = PricFleteLogPeer::doValidate($this, $columns)) !== true) {
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
	 *                     one of the class type constants TYPE_PHPNAME,
	 *                     TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PricFleteLogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdtrayecto();
				break;
			case 1:
				return $this->getCaIdconcepto();
				break;
			case 2:
				return $this->getCaVlrneto();
				break;
			case 3:
				return $this->getCaVlrsugerido();
				break;
			case 4:
				return $this->getCaFchinicio();
				break;
			case 5:
				return $this->getCaFchvencimiento();
				break;
			case 6:
				return $this->getCaIdmoneda();
				break;
			case 7:
				return $this->getCaFchcreado();
				break;
			case 8:
				return $this->getCaUsucreado();
				break;
			case 9:
				return $this->getCaEstado();
				break;
			case 10:
				return $this->getCaAplicacion();
				break;
			case 11:
				return $this->getCaConsecutivo();
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
		$keys = PricFleteLogPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdtrayecto(),
			$keys[1] => $this->getCaIdconcepto(),
			$keys[2] => $this->getCaVlrneto(),
			$keys[3] => $this->getCaVlrsugerido(),
			$keys[4] => $this->getCaFchinicio(),
			$keys[5] => $this->getCaFchvencimiento(),
			$keys[6] => $this->getCaIdmoneda(),
			$keys[7] => $this->getCaFchcreado(),
			$keys[8] => $this->getCaUsucreado(),
			$keys[9] => $this->getCaEstado(),
			$keys[10] => $this->getCaAplicacion(),
			$keys[11] => $this->getCaConsecutivo(),
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
		$pos = PricFleteLogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdtrayecto($value);
				break;
			case 1:
				$this->setCaIdconcepto($value);
				break;
			case 2:
				$this->setCaVlrneto($value);
				break;
			case 3:
				$this->setCaVlrsugerido($value);
				break;
			case 4:
				$this->setCaFchinicio($value);
				break;
			case 5:
				$this->setCaFchvencimiento($value);
				break;
			case 6:
				$this->setCaIdmoneda($value);
				break;
			case 7:
				$this->setCaFchcreado($value);
				break;
			case 8:
				$this->setCaUsucreado($value);
				break;
			case 9:
				$this->setCaEstado($value);
				break;
			case 10:
				$this->setCaAplicacion($value);
				break;
			case 11:
				$this->setCaConsecutivo($value);
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
		$keys = PricFleteLogPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdtrayecto($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdconcepto($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaVlrneto($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaVlrsugerido($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaFchinicio($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaFchvencimiento($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaIdmoneda($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaFchcreado($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaUsucreado($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaEstado($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaAplicacion($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaConsecutivo($arr[$keys[11]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(PricFleteLogPeer::DATABASE_NAME);

		if ($this->isColumnModified(PricFleteLogPeer::CA_IDTRAYECTO)) $criteria->add(PricFleteLogPeer::CA_IDTRAYECTO, $this->ca_idtrayecto);
		if ($this->isColumnModified(PricFleteLogPeer::CA_IDCONCEPTO)) $criteria->add(PricFleteLogPeer::CA_IDCONCEPTO, $this->ca_idconcepto);
		if ($this->isColumnModified(PricFleteLogPeer::CA_VLRNETO)) $criteria->add(PricFleteLogPeer::CA_VLRNETO, $this->ca_vlrneto);
		if ($this->isColumnModified(PricFleteLogPeer::CA_VLRSUGERIDO)) $criteria->add(PricFleteLogPeer::CA_VLRSUGERIDO, $this->ca_vlrsugerido);
		if ($this->isColumnModified(PricFleteLogPeer::CA_FCHINICIO)) $criteria->add(PricFleteLogPeer::CA_FCHINICIO, $this->ca_fchinicio);
		if ($this->isColumnModified(PricFleteLogPeer::CA_FCHVENCIMIENTO)) $criteria->add(PricFleteLogPeer::CA_FCHVENCIMIENTO, $this->ca_fchvencimiento);
		if ($this->isColumnModified(PricFleteLogPeer::CA_IDMONEDA)) $criteria->add(PricFleteLogPeer::CA_IDMONEDA, $this->ca_idmoneda);
		if ($this->isColumnModified(PricFleteLogPeer::CA_FCHCREADO)) $criteria->add(PricFleteLogPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(PricFleteLogPeer::CA_USUCREADO)) $criteria->add(PricFleteLogPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(PricFleteLogPeer::CA_ESTADO)) $criteria->add(PricFleteLogPeer::CA_ESTADO, $this->ca_estado);
		if ($this->isColumnModified(PricFleteLogPeer::CA_APLICACION)) $criteria->add(PricFleteLogPeer::CA_APLICACION, $this->ca_aplicacion);
		if ($this->isColumnModified(PricFleteLogPeer::CA_CONSECUTIVO)) $criteria->add(PricFleteLogPeer::CA_CONSECUTIVO, $this->ca_consecutivo);

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
		$criteria = new Criteria(PricFleteLogPeer::DATABASE_NAME);

		$criteria->add(PricFleteLogPeer::CA_CONSECUTIVO, $this->ca_consecutivo);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCaConsecutivo();
	}

	/**
	 * Generic method to set the primary key (ca_consecutivo column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaConsecutivo($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of PricFleteLog (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdtrayecto($this->ca_idtrayecto);

		$copyObj->setCaIdconcepto($this->ca_idconcepto);

		$copyObj->setCaVlrneto($this->ca_vlrneto);

		$copyObj->setCaVlrsugerido($this->ca_vlrsugerido);

		$copyObj->setCaFchinicio($this->ca_fchinicio);

		$copyObj->setCaFchvencimiento($this->ca_fchvencimiento);

		$copyObj->setCaIdmoneda($this->ca_idmoneda);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaEstado($this->ca_estado);

		$copyObj->setCaAplicacion($this->ca_aplicacion);


		$copyObj->setNew(true);

		$copyObj->setCaConsecutivo(NULL); // this is a pkey column, so set to default value

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
	 * @return     PricFleteLog Clone of current object.
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
	 * @return     PricFleteLogPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new PricFleteLogPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Trayecto object.
	 *
	 * @param      Trayecto $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setTrayecto($v)
	{


		if ($v === null) {
			$this->setCaIdtrayecto(NULL);
		} else {
			$this->setCaIdtrayecto($v->getCaIdtrayecto());
		}


		$this->aTrayecto = $v;
	}


	/**
	 * Get the associated Trayecto object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Trayecto The associated Trayecto object.
	 * @throws     PropelException
	 */
	public function getTrayecto($con = null)
	{
		if ($this->aTrayecto === null && ($this->ca_idtrayecto !== null)) {
			// include the related Peer class
			$this->aTrayecto = TrayectoPeer::retrieveByPK($this->ca_idtrayecto, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = TrayectoPeer::retrieveByPK($this->ca_idtrayecto, $con);
			   $obj->addTrayectos($this);
			 */
		}
		return $this->aTrayecto;
	}

	/**
	 * Declares an association between this object and a Concepto object.
	 *
	 * @param      Concepto $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setConcepto($v)
	{


		if ($v === null) {
			$this->setCaIdconcepto(NULL);
		} else {
			$this->setCaIdconcepto($v->getCaIdconcepto());
		}


		$this->aConcepto = $v;
	}


	/**
	 * Get the associated Concepto object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Concepto The associated Concepto object.
	 * @throws     PropelException
	 */
	public function getConcepto($con = null)
	{
		if ($this->aConcepto === null && ($this->ca_idconcepto !== null)) {
			// include the related Peer class
			$this->aConcepto = ConceptoPeer::retrieveByPK($this->ca_idconcepto, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = ConceptoPeer::retrieveByPK($this->ca_idconcepto, $con);
			   $obj->addConceptos($this);
			 */
		}
		return $this->aConcepto;
	}

} // BasePricFleteLog
