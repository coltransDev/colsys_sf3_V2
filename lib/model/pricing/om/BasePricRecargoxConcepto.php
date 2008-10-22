<?php

/**
 * Base class that represents a row from the 'tb_pricrecargosxconcepto' table.
 *
 * 
 *
 * @package    lib.model.pricing.om
 */
abstract class BasePricRecargoxConcepto extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        PricRecargoxConceptoPeer
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
	 * The value for the ca_idrecargo field.
	 * @var        int
	 */
	protected $ca_idrecargo;


	/**
	 * The value for the ca_vlrrecargo field.
	 * @var        double
	 */
	protected $ca_vlrrecargo;


	/**
	 * The value for the ca_vlrminimo field.
	 * @var        double
	 */
	protected $ca_vlrminimo;


	/**
	 * The value for the ca_aplicacion field.
	 * @var        string
	 */
	protected $ca_aplicacion;


	/**
	 * The value for the ca_observaciones field.
	 * @var        string
	 */
	protected $ca_observaciones;


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
	 * @var        PricFlete
	 */
	protected $aPricFlete;

	/**
	 * @var        TipoRecargo
	 */
	protected $aTipoRecargo;

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
	 * Get the [ca_idrecargo] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdrecargo()
	{

		return $this->ca_idrecargo;
	}

	/**
	 * Get the [ca_vlrrecargo] column value.
	 * 
	 * @return     double
	 */
	public function getCaVlrrecargo()
	{

		return $this->ca_vlrrecargo;
	}

	/**
	 * Get the [ca_vlrminimo] column value.
	 * 
	 * @return     double
	 */
	public function getCaVlrminimo()
	{

		return $this->ca_vlrminimo;
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
	 * Get the [ca_observaciones] column value.
	 * 
	 * @return     string
	 */
	public function getCaObservaciones()
	{

		return $this->ca_observaciones;
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
			$this->modifiedColumns[] = PricRecargoxConceptoPeer::CA_IDTRAYECTO;
		}

		if ($this->aPricFlete !== null && $this->aPricFlete->getCaIdtrayecto() !== $v) {
			$this->aPricFlete = null;
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
			$this->modifiedColumns[] = PricRecargoxConceptoPeer::CA_IDCONCEPTO;
		}

		if ($this->aPricFlete !== null && $this->aPricFlete->getCaIdconcepto() !== $v) {
			$this->aPricFlete = null;
		}

	} // setCaIdconcepto()

	/**
	 * Set the value of [ca_idrecargo] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdrecargo($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idrecargo !== $v) {
			$this->ca_idrecargo = $v;
			$this->modifiedColumns[] = PricRecargoxConceptoPeer::CA_IDRECARGO;
		}

		if ($this->aTipoRecargo !== null && $this->aTipoRecargo->getCaIdrecargo() !== $v) {
			$this->aTipoRecargo = null;
		}

	} // setCaIdrecargo()

	/**
	 * Set the value of [ca_vlrrecargo] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaVlrrecargo($v)
	{

		if ($this->ca_vlrrecargo !== $v) {
			$this->ca_vlrrecargo = $v;
			$this->modifiedColumns[] = PricRecargoxConceptoPeer::CA_VLRRECARGO;
		}

	} // setCaVlrrecargo()

	/**
	 * Set the value of [ca_vlrminimo] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaVlrminimo($v)
	{

		if ($this->ca_vlrminimo !== $v) {
			$this->ca_vlrminimo = $v;
			$this->modifiedColumns[] = PricRecargoxConceptoPeer::CA_VLRMINIMO;
		}

	} // setCaVlrminimo()

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
			$this->modifiedColumns[] = PricRecargoxConceptoPeer::CA_APLICACION;
		}

	} // setCaAplicacion()

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
			$this->modifiedColumns[] = PricRecargoxConceptoPeer::CA_OBSERVACIONES;
		}

	} // setCaObservaciones()

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
			$this->modifiedColumns[] = PricRecargoxConceptoPeer::CA_IDMONEDA;
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
			$this->modifiedColumns[] = PricRecargoxConceptoPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = PricRecargoxConceptoPeer::CA_USUCREADO;
		}

	} // setCaUsucreado()

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

			$this->ca_idrecargo = $rs->getInt($startcol + 2);

			$this->ca_vlrrecargo = $rs->getFloat($startcol + 3);

			$this->ca_vlrminimo = $rs->getFloat($startcol + 4);

			$this->ca_aplicacion = $rs->getString($startcol + 5);

			$this->ca_observaciones = $rs->getString($startcol + 6);

			$this->ca_idmoneda = $rs->getString($startcol + 7);

			$this->ca_fchcreado = $rs->getTimestamp($startcol + 8, null);

			$this->ca_usucreado = $rs->getString($startcol + 9);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 10; // 10 = PricRecargoxConceptoPeer::NUM_COLUMNS - PricRecargoxConceptoPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating PricRecargoxConcepto object", $e);
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
			$con = Propel::getConnection(PricRecargoxConceptoPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PricRecargoxConceptoPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(PricRecargoxConceptoPeer::DATABASE_NAME);
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

			if ($this->aPricFlete !== null) {
				if ($this->aPricFlete->isModified()) {
					$affectedRows += $this->aPricFlete->save($con);
				}
				$this->setPricFlete($this->aPricFlete);
			}

			if ($this->aTipoRecargo !== null) {
				if ($this->aTipoRecargo->isModified()) {
					$affectedRows += $this->aTipoRecargo->save($con);
				}
				$this->setTipoRecargo($this->aTipoRecargo);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = PricRecargoxConceptoPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += PricRecargoxConceptoPeer::doUpdate($this, $con);
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

			if ($this->aPricFlete !== null) {
				if (!$this->aPricFlete->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPricFlete->getValidationFailures());
				}
			}

			if ($this->aTipoRecargo !== null) {
				if (!$this->aTipoRecargo->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTipoRecargo->getValidationFailures());
				}
			}


			if (($retval = PricRecargoxConceptoPeer::doValidate($this, $columns)) !== true) {
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
		$pos = PricRecargoxConceptoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdrecargo();
				break;
			case 3:
				return $this->getCaVlrrecargo();
				break;
			case 4:
				return $this->getCaVlrminimo();
				break;
			case 5:
				return $this->getCaAplicacion();
				break;
			case 6:
				return $this->getCaObservaciones();
				break;
			case 7:
				return $this->getCaIdmoneda();
				break;
			case 8:
				return $this->getCaFchcreado();
				break;
			case 9:
				return $this->getCaUsucreado();
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
		$keys = PricRecargoxConceptoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdtrayecto(),
			$keys[1] => $this->getCaIdconcepto(),
			$keys[2] => $this->getCaIdrecargo(),
			$keys[3] => $this->getCaVlrrecargo(),
			$keys[4] => $this->getCaVlrminimo(),
			$keys[5] => $this->getCaAplicacion(),
			$keys[6] => $this->getCaObservaciones(),
			$keys[7] => $this->getCaIdmoneda(),
			$keys[8] => $this->getCaFchcreado(),
			$keys[9] => $this->getCaUsucreado(),
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
		$pos = PricRecargoxConceptoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdrecargo($value);
				break;
			case 3:
				$this->setCaVlrrecargo($value);
				break;
			case 4:
				$this->setCaVlrminimo($value);
				break;
			case 5:
				$this->setCaAplicacion($value);
				break;
			case 6:
				$this->setCaObservaciones($value);
				break;
			case 7:
				$this->setCaIdmoneda($value);
				break;
			case 8:
				$this->setCaFchcreado($value);
				break;
			case 9:
				$this->setCaUsucreado($value);
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
		$keys = PricRecargoxConceptoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdtrayecto($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdconcepto($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaIdrecargo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaVlrrecargo($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaVlrminimo($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaAplicacion($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaObservaciones($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaIdmoneda($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaFchcreado($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaUsucreado($arr[$keys[9]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(PricRecargoxConceptoPeer::DATABASE_NAME);

		if ($this->isColumnModified(PricRecargoxConceptoPeer::CA_IDTRAYECTO)) $criteria->add(PricRecargoxConceptoPeer::CA_IDTRAYECTO, $this->ca_idtrayecto);
		if ($this->isColumnModified(PricRecargoxConceptoPeer::CA_IDCONCEPTO)) $criteria->add(PricRecargoxConceptoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);
		if ($this->isColumnModified(PricRecargoxConceptoPeer::CA_IDRECARGO)) $criteria->add(PricRecargoxConceptoPeer::CA_IDRECARGO, $this->ca_idrecargo);
		if ($this->isColumnModified(PricRecargoxConceptoPeer::CA_VLRRECARGO)) $criteria->add(PricRecargoxConceptoPeer::CA_VLRRECARGO, $this->ca_vlrrecargo);
		if ($this->isColumnModified(PricRecargoxConceptoPeer::CA_VLRMINIMO)) $criteria->add(PricRecargoxConceptoPeer::CA_VLRMINIMO, $this->ca_vlrminimo);
		if ($this->isColumnModified(PricRecargoxConceptoPeer::CA_APLICACION)) $criteria->add(PricRecargoxConceptoPeer::CA_APLICACION, $this->ca_aplicacion);
		if ($this->isColumnModified(PricRecargoxConceptoPeer::CA_OBSERVACIONES)) $criteria->add(PricRecargoxConceptoPeer::CA_OBSERVACIONES, $this->ca_observaciones);
		if ($this->isColumnModified(PricRecargoxConceptoPeer::CA_IDMONEDA)) $criteria->add(PricRecargoxConceptoPeer::CA_IDMONEDA, $this->ca_idmoneda);
		if ($this->isColumnModified(PricRecargoxConceptoPeer::CA_FCHCREADO)) $criteria->add(PricRecargoxConceptoPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(PricRecargoxConceptoPeer::CA_USUCREADO)) $criteria->add(PricRecargoxConceptoPeer::CA_USUCREADO, $this->ca_usucreado);

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
		$criteria = new Criteria(PricRecargoxConceptoPeer::DATABASE_NAME);

		$criteria->add(PricRecargoxConceptoPeer::CA_IDTRAYECTO, $this->ca_idtrayecto);
		$criteria->add(PricRecargoxConceptoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);
		$criteria->add(PricRecargoxConceptoPeer::CA_IDRECARGO, $this->ca_idrecargo);

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

		$pks[0] = $this->getCaIdtrayecto();

		$pks[1] = $this->getCaIdconcepto();

		$pks[2] = $this->getCaIdrecargo();

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

		$this->setCaIdtrayecto($keys[0]);

		$this->setCaIdconcepto($keys[1]);

		$this->setCaIdrecargo($keys[2]);

	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of PricRecargoxConcepto (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaVlrrecargo($this->ca_vlrrecargo);

		$copyObj->setCaVlrminimo($this->ca_vlrminimo);

		$copyObj->setCaAplicacion($this->ca_aplicacion);

		$copyObj->setCaObservaciones($this->ca_observaciones);

		$copyObj->setCaIdmoneda($this->ca_idmoneda);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);


		$copyObj->setNew(true);

		$copyObj->setCaIdtrayecto(NULL); // this is a pkey column, so set to default value

		$copyObj->setCaIdconcepto(NULL); // this is a pkey column, so set to default value

		$copyObj->setCaIdrecargo(NULL); // this is a pkey column, so set to default value

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
	 * @return     PricRecargoxConcepto Clone of current object.
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
	 * @return     PricRecargoxConceptoPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new PricRecargoxConceptoPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a PricFlete object.
	 *
	 * @param      PricFlete $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setPricFlete($v)
	{


		if ($v === null) {
			$this->setCaIdtrayecto(NULL);
		} else {
			$this->setCaIdtrayecto($v->getCaIdtrayecto());
		}


		if ($v === null) {
			$this->setCaIdconcepto(NULL);
		} else {
			$this->setCaIdconcepto($v->getCaIdconcepto());
		}


		$this->aPricFlete = $v;
	}


	/**
	 * Get the associated PricFlete object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     PricFlete The associated PricFlete object.
	 * @throws     PropelException
	 */
	public function getPricFlete($con = null)
	{
		if ($this->aPricFlete === null && ($this->ca_idtrayecto !== null && $this->ca_idconcepto !== null)) {
			// include the related Peer class
			$this->aPricFlete = PricFletePeer::retrieveByPK($this->ca_idtrayecto, $this->ca_idconcepto, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = PricFletePeer::retrieveByPK($this->ca_idtrayecto, $this->ca_idconcepto, $con);
			   $obj->addPricFletes($this);
			 */
		}
		return $this->aPricFlete;
	}

	/**
	 * Declares an association between this object and a TipoRecargo object.
	 *
	 * @param      TipoRecargo $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setTipoRecargo($v)
	{


		if ($v === null) {
			$this->setCaIdrecargo(NULL);
		} else {
			$this->setCaIdrecargo($v->getCaIdrecargo());
		}


		$this->aTipoRecargo = $v;
	}


	/**
	 * Get the associated TipoRecargo object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     TipoRecargo The associated TipoRecargo object.
	 * @throws     PropelException
	 */
	public function getTipoRecargo($con = null)
	{
		if ($this->aTipoRecargo === null && ($this->ca_idrecargo !== null)) {
			// include the related Peer class
			$this->aTipoRecargo = TipoRecargoPeer::retrieveByPK($this->ca_idrecargo, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = TipoRecargoPeer::retrieveByPK($this->ca_idrecargo, $con);
			   $obj->addTipoRecargos($this);
			 */
		}
		return $this->aTipoRecargo;
	}

} // BasePricRecargoxConcepto
