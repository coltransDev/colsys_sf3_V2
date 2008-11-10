<?php

/**
 * Base class that represents a row from the 'tb_pricseguros' table.
 *
 * 
 *
 * @package    lib.model.pricing.om
 */
abstract class BasePricSeguro extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        PricSeguroPeer
	 */
	protected static $peer;


	/**
	 * The value for the ca_idgrupo field.
	 * @var        int
	 */
	protected $ca_idgrupo;


	/**
	 * The value for the ca_transporte field.
	 * @var        string
	 */
	protected $ca_transporte;


	/**
	 * The value for the ca_vlrprima field.
	 * @var        double
	 */
	protected $ca_vlrprima;


	/**
	 * The value for the ca_vlrminima field.
	 * @var        double
	 */
	protected $ca_vlrminima;


	/**
	 * The value for the ca_vlrobtencionpoliza field.
	 * @var        double
	 */
	protected $ca_vlrobtencionpoliza;


	/**
	 * The value for the ca_idmoneda field.
	 * @var        string
	 */
	protected $ca_idmoneda;


	/**
	 * The value for the ca_observaciones field.
	 * @var        string
	 */
	protected $ca_observaciones;


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
	 * @var        TraficoGrupo
	 */
	protected $aTraficoGrupo;

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
	 * Get the [ca_idgrupo] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdgrupo()
	{

		return $this->ca_idgrupo;
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
	 * Get the [ca_vlrprima] column value.
	 * 
	 * @return     double
	 */
	public function getCaVlrprima()
	{

		return $this->ca_vlrprima;
	}

	/**
	 * Get the [ca_vlrminima] column value.
	 * 
	 * @return     double
	 */
	public function getCaVlrminima()
	{

		return $this->ca_vlrminima;
	}

	/**
	 * Get the [ca_vlrobtencionpoliza] column value.
	 * 
	 * @return     double
	 */
	public function getCaVlrobtencionpoliza()
	{

		return $this->ca_vlrobtencionpoliza;
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
	 * Get the [ca_observaciones] column value.
	 * 
	 * @return     string
	 */
	public function getCaObservaciones()
	{

		return $this->ca_observaciones;
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
	 * Set the value of [ca_idgrupo] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdgrupo($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idgrupo !== $v) {
			$this->ca_idgrupo = $v;
			$this->modifiedColumns[] = PricSeguroPeer::CA_IDGRUPO;
		}

		if ($this->aTraficoGrupo !== null && $this->aTraficoGrupo->getCaIdgrupo() !== $v) {
			$this->aTraficoGrupo = null;
		}

	} // setCaIdgrupo()

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
			$this->modifiedColumns[] = PricSeguroPeer::CA_TRANSPORTE;
		}

	} // setCaTransporte()

	/**
	 * Set the value of [ca_vlrprima] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaVlrprima($v)
	{

		if ($this->ca_vlrprima !== $v) {
			$this->ca_vlrprima = $v;
			$this->modifiedColumns[] = PricSeguroPeer::CA_VLRPRIMA;
		}

	} // setCaVlrprima()

	/**
	 * Set the value of [ca_vlrminima] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaVlrminima($v)
	{

		if ($this->ca_vlrminima !== $v) {
			$this->ca_vlrminima = $v;
			$this->modifiedColumns[] = PricSeguroPeer::CA_VLRMINIMA;
		}

	} // setCaVlrminima()

	/**
	 * Set the value of [ca_vlrobtencionpoliza] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaVlrobtencionpoliza($v)
	{

		if ($this->ca_vlrobtencionpoliza !== $v) {
			$this->ca_vlrobtencionpoliza = $v;
			$this->modifiedColumns[] = PricSeguroPeer::CA_VLROBTENCIONPOLIZA;
		}

	} // setCaVlrobtencionpoliza()

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
			$this->modifiedColumns[] = PricSeguroPeer::CA_IDMONEDA;
		}

	} // setCaIdmoneda()

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
			$this->modifiedColumns[] = PricSeguroPeer::CA_OBSERVACIONES;
		}

	} // setCaObservaciones()

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
			$this->modifiedColumns[] = PricSeguroPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = PricSeguroPeer::CA_USUCREADO;
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

			$this->ca_idgrupo = $rs->getInt($startcol + 0);

			$this->ca_transporte = $rs->getString($startcol + 1);

			$this->ca_vlrprima = $rs->getFloat($startcol + 2);

			$this->ca_vlrminima = $rs->getFloat($startcol + 3);

			$this->ca_vlrobtencionpoliza = $rs->getFloat($startcol + 4);

			$this->ca_idmoneda = $rs->getString($startcol + 5);

			$this->ca_observaciones = $rs->getString($startcol + 6);

			$this->ca_fchcreado = $rs->getTimestamp($startcol + 7, null);

			$this->ca_usucreado = $rs->getString($startcol + 8);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 9; // 9 = PricSeguroPeer::NUM_COLUMNS - PricSeguroPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating PricSeguro object", $e);
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
			$con = Propel::getConnection(PricSeguroPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PricSeguroPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(PricSeguroPeer::DATABASE_NAME);
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

			if ($this->aTraficoGrupo !== null) {
				if ($this->aTraficoGrupo->isModified()) {
					$affectedRows += $this->aTraficoGrupo->save($con);
				}
				$this->setTraficoGrupo($this->aTraficoGrupo);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = PricSeguroPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += PricSeguroPeer::doUpdate($this, $con);
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

			if ($this->aTraficoGrupo !== null) {
				if (!$this->aTraficoGrupo->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTraficoGrupo->getValidationFailures());
				}
			}


			if (($retval = PricSeguroPeer::doValidate($this, $columns)) !== true) {
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
		$pos = PricSeguroPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdgrupo();
				break;
			case 1:
				return $this->getCaTransporte();
				break;
			case 2:
				return $this->getCaVlrprima();
				break;
			case 3:
				return $this->getCaVlrminima();
				break;
			case 4:
				return $this->getCaVlrobtencionpoliza();
				break;
			case 5:
				return $this->getCaIdmoneda();
				break;
			case 6:
				return $this->getCaObservaciones();
				break;
			case 7:
				return $this->getCaFchcreado();
				break;
			case 8:
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
		$keys = PricSeguroPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdgrupo(),
			$keys[1] => $this->getCaTransporte(),
			$keys[2] => $this->getCaVlrprima(),
			$keys[3] => $this->getCaVlrminima(),
			$keys[4] => $this->getCaVlrobtencionpoliza(),
			$keys[5] => $this->getCaIdmoneda(),
			$keys[6] => $this->getCaObservaciones(),
			$keys[7] => $this->getCaFchcreado(),
			$keys[8] => $this->getCaUsucreado(),
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
		$pos = PricSeguroPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdgrupo($value);
				break;
			case 1:
				$this->setCaTransporte($value);
				break;
			case 2:
				$this->setCaVlrprima($value);
				break;
			case 3:
				$this->setCaVlrminima($value);
				break;
			case 4:
				$this->setCaVlrobtencionpoliza($value);
				break;
			case 5:
				$this->setCaIdmoneda($value);
				break;
			case 6:
				$this->setCaObservaciones($value);
				break;
			case 7:
				$this->setCaFchcreado($value);
				break;
			case 8:
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
		$keys = PricSeguroPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdgrupo($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaTransporte($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaVlrprima($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaVlrminima($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaVlrobtencionpoliza($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaIdmoneda($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaObservaciones($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaFchcreado($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaUsucreado($arr[$keys[8]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(PricSeguroPeer::DATABASE_NAME);

		if ($this->isColumnModified(PricSeguroPeer::CA_IDGRUPO)) $criteria->add(PricSeguroPeer::CA_IDGRUPO, $this->ca_idgrupo);
		if ($this->isColumnModified(PricSeguroPeer::CA_TRANSPORTE)) $criteria->add(PricSeguroPeer::CA_TRANSPORTE, $this->ca_transporte);
		if ($this->isColumnModified(PricSeguroPeer::CA_VLRPRIMA)) $criteria->add(PricSeguroPeer::CA_VLRPRIMA, $this->ca_vlrprima);
		if ($this->isColumnModified(PricSeguroPeer::CA_VLRMINIMA)) $criteria->add(PricSeguroPeer::CA_VLRMINIMA, $this->ca_vlrminima);
		if ($this->isColumnModified(PricSeguroPeer::CA_VLROBTENCIONPOLIZA)) $criteria->add(PricSeguroPeer::CA_VLROBTENCIONPOLIZA, $this->ca_vlrobtencionpoliza);
		if ($this->isColumnModified(PricSeguroPeer::CA_IDMONEDA)) $criteria->add(PricSeguroPeer::CA_IDMONEDA, $this->ca_idmoneda);
		if ($this->isColumnModified(PricSeguroPeer::CA_OBSERVACIONES)) $criteria->add(PricSeguroPeer::CA_OBSERVACIONES, $this->ca_observaciones);
		if ($this->isColumnModified(PricSeguroPeer::CA_FCHCREADO)) $criteria->add(PricSeguroPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(PricSeguroPeer::CA_USUCREADO)) $criteria->add(PricSeguroPeer::CA_USUCREADO, $this->ca_usucreado);

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
		$criteria = new Criteria(PricSeguroPeer::DATABASE_NAME);

		$criteria->add(PricSeguroPeer::CA_IDGRUPO, $this->ca_idgrupo);
		$criteria->add(PricSeguroPeer::CA_TRANSPORTE, $this->ca_transporte);

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

		$pks[0] = $this->getCaIdgrupo();

		$pks[1] = $this->getCaTransporte();

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

		$this->setCaIdgrupo($keys[0]);

		$this->setCaTransporte($keys[1]);

	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of PricSeguro (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaVlrprima($this->ca_vlrprima);

		$copyObj->setCaVlrminima($this->ca_vlrminima);

		$copyObj->setCaVlrobtencionpoliza($this->ca_vlrobtencionpoliza);

		$copyObj->setCaIdmoneda($this->ca_idmoneda);

		$copyObj->setCaObservaciones($this->ca_observaciones);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);


		$copyObj->setNew(true);

		$copyObj->setCaIdgrupo(NULL); // this is a pkey column, so set to default value

		$copyObj->setCaTransporte(NULL); // this is a pkey column, so set to default value

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
	 * @return     PricSeguro Clone of current object.
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
	 * @return     PricSeguroPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new PricSeguroPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a TraficoGrupo object.
	 *
	 * @param      TraficoGrupo $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setTraficoGrupo($v)
	{


		if ($v === null) {
			$this->setCaIdgrupo(NULL);
		} else {
			$this->setCaIdgrupo($v->getCaIdgrupo());
		}


		$this->aTraficoGrupo = $v;
	}


	/**
	 * Get the associated TraficoGrupo object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     TraficoGrupo The associated TraficoGrupo object.
	 * @throws     PropelException
	 */
	public function getTraficoGrupo($con = null)
	{
		if ($this->aTraficoGrupo === null && ($this->ca_idgrupo !== null)) {
			// include the related Peer class
			$this->aTraficoGrupo = TraficoGrupoPeer::retrieveByPK($this->ca_idgrupo, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = TraficoGrupoPeer::retrieveByPK($this->ca_idgrupo, $con);
			   $obj->addTraficoGrupos($this);
			 */
		}
		return $this->aTraficoGrupo;
	}

} // BasePricSeguro
