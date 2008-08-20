<?php

/**
 * Base class that represents a row from the 'tb_inoavisos_sea' table.
 *
 * 
 *
 * @package    lib.model.sea.om
 */
abstract class BaseInoAvisosSea extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        InoAvisosSeaPeer
	 */
	protected static $peer;


	/**
	 * The value for the ca_referencia field.
	 * @var        string
	 */
	protected $ca_referencia;


	/**
	 * The value for the ca_idcliente field.
	 * @var        int
	 */
	protected $ca_idcliente;


	/**
	 * The value for the ca_hbls field.
	 * @var        string
	 */
	protected $ca_hbls;


	/**
	 * The value for the ca_idemail field.
	 * @var        int
	 */
	protected $ca_idemail;


	/**
	 * The value for the ca_fchaviso field.
	 * @var        int
	 */
	protected $ca_fchaviso;


	/**
	 * The value for the ca_aviso field.
	 * @var        string
	 */
	protected $ca_aviso;


	/**
	 * The value for the ca_idbodega field.
	 * @var        int
	 */
	protected $ca_idbodega;


	/**
	 * The value for the ca_fchllegada field.
	 * @var        int
	 */
	protected $ca_fchllegada;


	/**
	 * The value for the ca_fchenvio field.
	 * @var        int
	 */
	protected $ca_fchenvio;


	/**
	 * The value for the ca_usuenvio field.
	 * @var        string
	 */
	protected $ca_usuenvio;

	/**
	 * @var        InoMaestraSea
	 */
	protected $aInoMaestraSea;

	/**
	 * @var        Cliente
	 */
	protected $aCliente;

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
	 * Get the [ca_referencia] column value.
	 * 
	 * @return     string
	 */
	public function getCaReferencia()
	{

		return $this->ca_referencia;
	}

	/**
	 * Get the [ca_idcliente] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdcliente()
	{

		return $this->ca_idcliente;
	}

	/**
	 * Get the [ca_hbls] column value.
	 * 
	 * @return     string
	 */
	public function getCaHbls()
	{

		return $this->ca_hbls;
	}

	/**
	 * Get the [ca_idemail] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdemail()
	{

		return $this->ca_idemail;
	}

	/**
	 * Get the [optionally formatted] [ca_fchaviso] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchaviso($format = 'Y-m-d')
	{

		if ($this->ca_fchaviso === null || $this->ca_fchaviso === '') {
			return null;
		} elseif (!is_int($this->ca_fchaviso)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_fchaviso);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_fchaviso] as date/time value: " . var_export($this->ca_fchaviso, true));
			}
		} else {
			$ts = $this->ca_fchaviso;
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
	 * Get the [ca_aviso] column value.
	 * 
	 * @return     string
	 */
	public function getCaAviso()
	{

		return $this->ca_aviso;
	}

	/**
	 * Get the [ca_idbodega] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdbodega()
	{

		return $this->ca_idbodega;
	}

	/**
	 * Get the [optionally formatted] [ca_fchllegada] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchllegada($format = 'Y-m-d')
	{

		if ($this->ca_fchllegada === null || $this->ca_fchllegada === '') {
			return null;
		} elseif (!is_int($this->ca_fchllegada)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_fchllegada);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_fchllegada] as date/time value: " . var_export($this->ca_fchllegada, true));
			}
		} else {
			$ts = $this->ca_fchllegada;
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
	 * Get the [optionally formatted] [ca_fchenvio] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchenvio($format = 'Y-m-d H:i:s')
	{

		if ($this->ca_fchenvio === null || $this->ca_fchenvio === '') {
			return null;
		} elseif (!is_int($this->ca_fchenvio)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_fchenvio);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_fchenvio] as date/time value: " . var_export($this->ca_fchenvio, true));
			}
		} else {
			$ts = $this->ca_fchenvio;
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
	 * Get the [ca_usuenvio] column value.
	 * 
	 * @return     string
	 */
	public function getCaUsuenvio()
	{

		return $this->ca_usuenvio;
	}

	/**
	 * Set the value of [ca_referencia] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaReferencia($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_referencia !== $v) {
			$this->ca_referencia = $v;
			$this->modifiedColumns[] = InoAvisosSeaPeer::CA_REFERENCIA;
		}

		if ($this->aInoMaestraSea !== null && $this->aInoMaestraSea->getCaReferencia() !== $v) {
			$this->aInoMaestraSea = null;
		}

	} // setCaReferencia()

	/**
	 * Set the value of [ca_idcliente] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdcliente($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idcliente !== $v) {
			$this->ca_idcliente = $v;
			$this->modifiedColumns[] = InoAvisosSeaPeer::CA_IDCLIENTE;
		}

		if ($this->aCliente !== null && $this->aCliente->getCaIdcliente() !== $v) {
			$this->aCliente = null;
		}

	} // setCaIdcliente()

	/**
	 * Set the value of [ca_hbls] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaHbls($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_hbls !== $v) {
			$this->ca_hbls = $v;
			$this->modifiedColumns[] = InoAvisosSeaPeer::CA_HBLS;
		}

	} // setCaHbls()

	/**
	 * Set the value of [ca_idemail] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdemail($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idemail !== $v) {
			$this->ca_idemail = $v;
			$this->modifiedColumns[] = InoAvisosSeaPeer::CA_IDEMAIL;
		}

	} // setCaIdemail()

	/**
	 * Set the value of [ca_fchaviso] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaFchaviso($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_fchaviso] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_fchaviso !== $ts) {
			$this->ca_fchaviso = $ts;
			$this->modifiedColumns[] = InoAvisosSeaPeer::CA_FCHAVISO;
		}

	} // setCaFchaviso()

	/**
	 * Set the value of [ca_aviso] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaAviso($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_aviso !== $v) {
			$this->ca_aviso = $v;
			$this->modifiedColumns[] = InoAvisosSeaPeer::CA_AVISO;
		}

	} // setCaAviso()

	/**
	 * Set the value of [ca_idbodega] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdbodega($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idbodega !== $v) {
			$this->ca_idbodega = $v;
			$this->modifiedColumns[] = InoAvisosSeaPeer::CA_IDBODEGA;
		}

	} // setCaIdbodega()

	/**
	 * Set the value of [ca_fchllegada] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaFchllegada($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_fchllegada] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_fchllegada !== $ts) {
			$this->ca_fchllegada = $ts;
			$this->modifiedColumns[] = InoAvisosSeaPeer::CA_FCHLLEGADA;
		}

	} // setCaFchllegada()

	/**
	 * Set the value of [ca_fchenvio] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaFchenvio($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_fchenvio] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_fchenvio !== $ts) {
			$this->ca_fchenvio = $ts;
			$this->modifiedColumns[] = InoAvisosSeaPeer::CA_FCHENVIO;
		}

	} // setCaFchenvio()

	/**
	 * Set the value of [ca_usuenvio] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaUsuenvio($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_usuenvio !== $v) {
			$this->ca_usuenvio = $v;
			$this->modifiedColumns[] = InoAvisosSeaPeer::CA_USUENVIO;
		}

	} // setCaUsuenvio()

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

			$this->ca_referencia = $rs->getString($startcol + 0);

			$this->ca_idcliente = $rs->getInt($startcol + 1);

			$this->ca_hbls = $rs->getString($startcol + 2);

			$this->ca_idemail = $rs->getInt($startcol + 3);

			$this->ca_fchaviso = $rs->getDate($startcol + 4, null);

			$this->ca_aviso = $rs->getString($startcol + 5);

			$this->ca_idbodega = $rs->getInt($startcol + 6);

			$this->ca_fchllegada = $rs->getDate($startcol + 7, null);

			$this->ca_fchenvio = $rs->getTimestamp($startcol + 8, null);

			$this->ca_usuenvio = $rs->getString($startcol + 9);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 10; // 10 = InoAvisosSeaPeer::NUM_COLUMNS - InoAvisosSeaPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating InoAvisosSea object", $e);
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
			$con = Propel::getConnection(InoAvisosSeaPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			InoAvisosSeaPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(InoAvisosSeaPeer::DATABASE_NAME);
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

			if ($this->aInoMaestraSea !== null) {
				if ($this->aInoMaestraSea->isModified()) {
					$affectedRows += $this->aInoMaestraSea->save($con);
				}
				$this->setInoMaestraSea($this->aInoMaestraSea);
			}

			if ($this->aCliente !== null) {
				if ($this->aCliente->isModified()) {
					$affectedRows += $this->aCliente->save($con);
				}
				$this->setCliente($this->aCliente);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = InoAvisosSeaPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += InoAvisosSeaPeer::doUpdate($this, $con);
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

			if ($this->aInoMaestraSea !== null) {
				if (!$this->aInoMaestraSea->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aInoMaestraSea->getValidationFailures());
				}
			}

			if ($this->aCliente !== null) {
				if (!$this->aCliente->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCliente->getValidationFailures());
				}
			}


			if (($retval = InoAvisosSeaPeer::doValidate($this, $columns)) !== true) {
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
		$pos = InoAvisosSeaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaReferencia();
				break;
			case 1:
				return $this->getCaIdcliente();
				break;
			case 2:
				return $this->getCaHbls();
				break;
			case 3:
				return $this->getCaIdemail();
				break;
			case 4:
				return $this->getCaFchaviso();
				break;
			case 5:
				return $this->getCaAviso();
				break;
			case 6:
				return $this->getCaIdbodega();
				break;
			case 7:
				return $this->getCaFchllegada();
				break;
			case 8:
				return $this->getCaFchenvio();
				break;
			case 9:
				return $this->getCaUsuenvio();
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
		$keys = InoAvisosSeaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaReferencia(),
			$keys[1] => $this->getCaIdcliente(),
			$keys[2] => $this->getCaHbls(),
			$keys[3] => $this->getCaIdemail(),
			$keys[4] => $this->getCaFchaviso(),
			$keys[5] => $this->getCaAviso(),
			$keys[6] => $this->getCaIdbodega(),
			$keys[7] => $this->getCaFchllegada(),
			$keys[8] => $this->getCaFchenvio(),
			$keys[9] => $this->getCaUsuenvio(),
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
		$pos = InoAvisosSeaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaReferencia($value);
				break;
			case 1:
				$this->setCaIdcliente($value);
				break;
			case 2:
				$this->setCaHbls($value);
				break;
			case 3:
				$this->setCaIdemail($value);
				break;
			case 4:
				$this->setCaFchaviso($value);
				break;
			case 5:
				$this->setCaAviso($value);
				break;
			case 6:
				$this->setCaIdbodega($value);
				break;
			case 7:
				$this->setCaFchllegada($value);
				break;
			case 8:
				$this->setCaFchenvio($value);
				break;
			case 9:
				$this->setCaUsuenvio($value);
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
		$keys = InoAvisosSeaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaReferencia($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdcliente($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaHbls($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaIdemail($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaFchaviso($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaAviso($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaIdbodega($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaFchllegada($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaFchenvio($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaUsuenvio($arr[$keys[9]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(InoAvisosSeaPeer::DATABASE_NAME);

		if ($this->isColumnModified(InoAvisosSeaPeer::CA_REFERENCIA)) $criteria->add(InoAvisosSeaPeer::CA_REFERENCIA, $this->ca_referencia);
		if ($this->isColumnModified(InoAvisosSeaPeer::CA_IDCLIENTE)) $criteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);
		if ($this->isColumnModified(InoAvisosSeaPeer::CA_HBLS)) $criteria->add(InoAvisosSeaPeer::CA_HBLS, $this->ca_hbls);
		if ($this->isColumnModified(InoAvisosSeaPeer::CA_IDEMAIL)) $criteria->add(InoAvisosSeaPeer::CA_IDEMAIL, $this->ca_idemail);
		if ($this->isColumnModified(InoAvisosSeaPeer::CA_FCHAVISO)) $criteria->add(InoAvisosSeaPeer::CA_FCHAVISO, $this->ca_fchaviso);
		if ($this->isColumnModified(InoAvisosSeaPeer::CA_AVISO)) $criteria->add(InoAvisosSeaPeer::CA_AVISO, $this->ca_aviso);
		if ($this->isColumnModified(InoAvisosSeaPeer::CA_IDBODEGA)) $criteria->add(InoAvisosSeaPeer::CA_IDBODEGA, $this->ca_idbodega);
		if ($this->isColumnModified(InoAvisosSeaPeer::CA_FCHLLEGADA)) $criteria->add(InoAvisosSeaPeer::CA_FCHLLEGADA, $this->ca_fchllegada);
		if ($this->isColumnModified(InoAvisosSeaPeer::CA_FCHENVIO)) $criteria->add(InoAvisosSeaPeer::CA_FCHENVIO, $this->ca_fchenvio);
		if ($this->isColumnModified(InoAvisosSeaPeer::CA_USUENVIO)) $criteria->add(InoAvisosSeaPeer::CA_USUENVIO, $this->ca_usuenvio);

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
		$criteria = new Criteria(InoAvisosSeaPeer::DATABASE_NAME);

		$criteria->add(InoAvisosSeaPeer::CA_REFERENCIA, $this->ca_referencia);
		$criteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);
		$criteria->add(InoAvisosSeaPeer::CA_HBLS, $this->ca_hbls);
		$criteria->add(InoAvisosSeaPeer::CA_IDEMAIL, $this->ca_idemail);

		return $criteria;
	}

	/**
	 * Returns the composite primary key for this object.
	 * The array elements will be in same order as specified in XML.
	 * @return     array
	 */
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getCaReferencia();

		$pks[1] = $this->getCaIdcliente();

		$pks[2] = $this->getCaHbls();

		$pks[3] = $this->getCaIdemail();

		return $pks;
	}

	/**
	 * Set the [composite] primary key.
	 *
	 * @param      array $keys The elements of the composite key (order must match the order in XML file).
	 * @return     void
	 */
	public function setPrimaryKey($keys)
	{

		$this->setCaReferencia($keys[0]);

		$this->setCaIdcliente($keys[1]);

		$this->setCaHbls($keys[2]);

		$this->setCaIdemail($keys[3]);

	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of InoAvisosSea (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaFchaviso($this->ca_fchaviso);

		$copyObj->setCaAviso($this->ca_aviso);

		$copyObj->setCaIdbodega($this->ca_idbodega);

		$copyObj->setCaFchllegada($this->ca_fchllegada);

		$copyObj->setCaFchenvio($this->ca_fchenvio);

		$copyObj->setCaUsuenvio($this->ca_usuenvio);


		$copyObj->setNew(true);

		$copyObj->setCaReferencia(NULL); // this is a pkey column, so set to default value

		$copyObj->setCaIdcliente(NULL); // this is a pkey column, so set to default value

		$copyObj->setCaHbls(NULL); // this is a pkey column, so set to default value

		$copyObj->setCaIdemail(NULL); // this is a pkey column, so set to default value

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
	 * @return     InoAvisosSea Clone of current object.
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
	 * @return     InoAvisosSeaPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new InoAvisosSeaPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a InoMaestraSea object.
	 *
	 * @param      InoMaestraSea $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setInoMaestraSea($v)
	{


		if ($v === null) {
			$this->setCaReferencia(NULL);
		} else {
			$this->setCaReferencia($v->getCaReferencia());
		}


		$this->aInoMaestraSea = $v;
	}


	/**
	 * Get the associated InoMaestraSea object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     InoMaestraSea The associated InoMaestraSea object.
	 * @throws     PropelException
	 */
	public function getInoMaestraSea($con = null)
	{
		if ($this->aInoMaestraSea === null && (($this->ca_referencia !== "" && $this->ca_referencia !== null))) {
			// include the related Peer class
			$this->aInoMaestraSea = InoMaestraSeaPeer::retrieveByPK($this->ca_referencia, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = InoMaestraSeaPeer::retrieveByPK($this->ca_referencia, $con);
			   $obj->addInoMaestraSeas($this);
			 */
		}
		return $this->aInoMaestraSea;
	}

	/**
	 * Declares an association between this object and a Cliente object.
	 *
	 * @param      Cliente $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setCliente($v)
	{


		if ($v === null) {
			$this->setCaIdcliente(NULL);
		} else {
			$this->setCaIdcliente($v->getCaIdcliente());
		}


		$this->aCliente = $v;
	}


	/**
	 * Get the associated Cliente object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Cliente The associated Cliente object.
	 * @throws     PropelException
	 */
	public function getCliente($con = null)
	{
		if ($this->aCliente === null && ($this->ca_idcliente !== null)) {
			// include the related Peer class
			$this->aCliente = ClientePeer::retrieveByPK($this->ca_idcliente, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = ClientePeer::retrieveByPK($this->ca_idcliente, $con);
			   $obj->addClientes($this);
			 */
		}
		return $this->aCliente;
	}

} // BaseInoAvisosSea
