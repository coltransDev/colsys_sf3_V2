<?php

/**
 * Base class that represents a row from the 'tb_trms' table.
 *
 * 
 *
 * @package    lib.model.public.om
 */
abstract class BaseTRM extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        TRMPeer
	 */
	protected static $peer;


	/**
	 * The value for the ca_fecha field.
	 * @var        int
	 */
	protected $ca_fecha;


	/**
	 * The value for the ca_euro field.
	 * @var        double
	 */
	protected $ca_euro;


	/**
	 * The value for the ca_pesos field.
	 * @var        double
	 */
	protected $ca_pesos;


	/**
	 * The value for the ca_libra field.
	 * @var        double
	 */
	protected $ca_libra;


	/**
	 * The value for the ca_fsuizo field.
	 * @var        double
	 */
	protected $ca_fsuizo;


	/**
	 * The value for the ca_marco field.
	 * @var        double
	 */
	protected $ca_marco;


	/**
	 * The value for the ca_yen field.
	 * @var        double
	 */
	protected $ca_yen;


	/**
	 * The value for the ca_rupee field.
	 * @var        double
	 */
	protected $ca_rupee;


	/**
	 * The value for the ca_ausdolar field.
	 * @var        double
	 */
	protected $ca_ausdolar;


	/**
	 * The value for the ca_candolar field.
	 * @var        double
	 */
	protected $ca_candolar;


	/**
	 * The value for the ca_cornoruega field.
	 * @var        double
	 */
	protected $ca_cornoruega;


	/**
	 * The value for the ca_singdolar field.
	 * @var        double
	 */
	protected $ca_singdolar;


	/**
	 * The value for the ca_rand field.
	 * @var        double
	 */
	protected $ca_rand;

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
	 * Get the [optionally formatted] [ca_fecha] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFecha($format = 'Y-m-d')
	{

		if ($this->ca_fecha === null || $this->ca_fecha === '') {
			return null;
		} elseif (!is_int($this->ca_fecha)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_fecha);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_fecha] as date/time value: " . var_export($this->ca_fecha, true));
			}
		} else {
			$ts = $this->ca_fecha;
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
	 * Get the [ca_euro] column value.
	 * 
	 * @return     double
	 */
	public function getCaEuro()
	{

		return $this->ca_euro;
	}

	/**
	 * Get the [ca_pesos] column value.
	 * 
	 * @return     double
	 */
	public function getCaPesos()
	{

		return $this->ca_pesos;
	}

	/**
	 * Get the [ca_libra] column value.
	 * 
	 * @return     double
	 */
	public function getCaLibra()
	{

		return $this->ca_libra;
	}

	/**
	 * Get the [ca_fsuizo] column value.
	 * 
	 * @return     double
	 */
	public function getCaFsuizo()
	{

		return $this->ca_fsuizo;
	}

	/**
	 * Get the [ca_marco] column value.
	 * 
	 * @return     double
	 */
	public function getCaMarco()
	{

		return $this->ca_marco;
	}

	/**
	 * Get the [ca_yen] column value.
	 * 
	 * @return     double
	 */
	public function getCaYen()
	{

		return $this->ca_yen;
	}

	/**
	 * Get the [ca_rupee] column value.
	 * 
	 * @return     double
	 */
	public function getCaRupee()
	{

		return $this->ca_rupee;
	}

	/**
	 * Get the [ca_ausdolar] column value.
	 * 
	 * @return     double
	 */
	public function getCaAusdolar()
	{

		return $this->ca_ausdolar;
	}

	/**
	 * Get the [ca_candolar] column value.
	 * 
	 * @return     double
	 */
	public function getCaCandolar()
	{

		return $this->ca_candolar;
	}

	/**
	 * Get the [ca_cornoruega] column value.
	 * 
	 * @return     double
	 */
	public function getCaCornoruega()
	{

		return $this->ca_cornoruega;
	}

	/**
	 * Get the [ca_singdolar] column value.
	 * 
	 * @return     double
	 */
	public function getCaSingdolar()
	{

		return $this->ca_singdolar;
	}

	/**
	 * Get the [ca_rand] column value.
	 * 
	 * @return     double
	 */
	public function getCaRand()
	{

		return $this->ca_rand;
	}

	/**
	 * Set the value of [ca_fecha] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaFecha($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_fecha] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_fecha !== $ts) {
			$this->ca_fecha = $ts;
			$this->modifiedColumns[] = TRMPeer::CA_FECHA;
		}

	} // setCaFecha()

	/**
	 * Set the value of [ca_euro] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaEuro($v)
	{

		if ($this->ca_euro !== $v) {
			$this->ca_euro = $v;
			$this->modifiedColumns[] = TRMPeer::CA_EURO;
		}

	} // setCaEuro()

	/**
	 * Set the value of [ca_pesos] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaPesos($v)
	{

		if ($this->ca_pesos !== $v) {
			$this->ca_pesos = $v;
			$this->modifiedColumns[] = TRMPeer::CA_PESOS;
		}

	} // setCaPesos()

	/**
	 * Set the value of [ca_libra] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaLibra($v)
	{

		if ($this->ca_libra !== $v) {
			$this->ca_libra = $v;
			$this->modifiedColumns[] = TRMPeer::CA_LIBRA;
		}

	} // setCaLibra()

	/**
	 * Set the value of [ca_fsuizo] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaFsuizo($v)
	{

		if ($this->ca_fsuizo !== $v) {
			$this->ca_fsuizo = $v;
			$this->modifiedColumns[] = TRMPeer::CA_FSUIZO;
		}

	} // setCaFsuizo()

	/**
	 * Set the value of [ca_marco] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaMarco($v)
	{

		if ($this->ca_marco !== $v) {
			$this->ca_marco = $v;
			$this->modifiedColumns[] = TRMPeer::CA_MARCO;
		}

	} // setCaMarco()

	/**
	 * Set the value of [ca_yen] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaYen($v)
	{

		if ($this->ca_yen !== $v) {
			$this->ca_yen = $v;
			$this->modifiedColumns[] = TRMPeer::CA_YEN;
		}

	} // setCaYen()

	/**
	 * Set the value of [ca_rupee] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaRupee($v)
	{

		if ($this->ca_rupee !== $v) {
			$this->ca_rupee = $v;
			$this->modifiedColumns[] = TRMPeer::CA_RUPEE;
		}

	} // setCaRupee()

	/**
	 * Set the value of [ca_ausdolar] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaAusdolar($v)
	{

		if ($this->ca_ausdolar !== $v) {
			$this->ca_ausdolar = $v;
			$this->modifiedColumns[] = TRMPeer::CA_AUSDOLAR;
		}

	} // setCaAusdolar()

	/**
	 * Set the value of [ca_candolar] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaCandolar($v)
	{

		if ($this->ca_candolar !== $v) {
			$this->ca_candolar = $v;
			$this->modifiedColumns[] = TRMPeer::CA_CANDOLAR;
		}

	} // setCaCandolar()

	/**
	 * Set the value of [ca_cornoruega] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaCornoruega($v)
	{

		if ($this->ca_cornoruega !== $v) {
			$this->ca_cornoruega = $v;
			$this->modifiedColumns[] = TRMPeer::CA_CORNORUEGA;
		}

	} // setCaCornoruega()

	/**
	 * Set the value of [ca_singdolar] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaSingdolar($v)
	{

		if ($this->ca_singdolar !== $v) {
			$this->ca_singdolar = $v;
			$this->modifiedColumns[] = TRMPeer::CA_SINGDOLAR;
		}

	} // setCaSingdolar()

	/**
	 * Set the value of [ca_rand] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaRand($v)
	{

		if ($this->ca_rand !== $v) {
			$this->ca_rand = $v;
			$this->modifiedColumns[] = TRMPeer::CA_RAND;
		}

	} // setCaRand()

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

			$this->ca_fecha = $rs->getDate($startcol + 0, null);

			$this->ca_euro = $rs->getFloat($startcol + 1);

			$this->ca_pesos = $rs->getFloat($startcol + 2);

			$this->ca_libra = $rs->getFloat($startcol + 3);

			$this->ca_fsuizo = $rs->getFloat($startcol + 4);

			$this->ca_marco = $rs->getFloat($startcol + 5);

			$this->ca_yen = $rs->getFloat($startcol + 6);

			$this->ca_rupee = $rs->getFloat($startcol + 7);

			$this->ca_ausdolar = $rs->getFloat($startcol + 8);

			$this->ca_candolar = $rs->getFloat($startcol + 9);

			$this->ca_cornoruega = $rs->getFloat($startcol + 10);

			$this->ca_singdolar = $rs->getFloat($startcol + 11);

			$this->ca_rand = $rs->getFloat($startcol + 12);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 13; // 13 = TRMPeer::NUM_COLUMNS - TRMPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating TRM object", $e);
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
			$con = Propel::getConnection(TRMPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			TRMPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(TRMPeer::DATABASE_NAME);
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


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TRMPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += TRMPeer::doUpdate($this, $con);
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


			if (($retval = TRMPeer::doValidate($this, $columns)) !== true) {
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
		$pos = TRMPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaFecha();
				break;
			case 1:
				return $this->getCaEuro();
				break;
			case 2:
				return $this->getCaPesos();
				break;
			case 3:
				return $this->getCaLibra();
				break;
			case 4:
				return $this->getCaFsuizo();
				break;
			case 5:
				return $this->getCaMarco();
				break;
			case 6:
				return $this->getCaYen();
				break;
			case 7:
				return $this->getCaRupee();
				break;
			case 8:
				return $this->getCaAusdolar();
				break;
			case 9:
				return $this->getCaCandolar();
				break;
			case 10:
				return $this->getCaCornoruega();
				break;
			case 11:
				return $this->getCaSingdolar();
				break;
			case 12:
				return $this->getCaRand();
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
		$keys = TRMPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaFecha(),
			$keys[1] => $this->getCaEuro(),
			$keys[2] => $this->getCaPesos(),
			$keys[3] => $this->getCaLibra(),
			$keys[4] => $this->getCaFsuizo(),
			$keys[5] => $this->getCaMarco(),
			$keys[6] => $this->getCaYen(),
			$keys[7] => $this->getCaRupee(),
			$keys[8] => $this->getCaAusdolar(),
			$keys[9] => $this->getCaCandolar(),
			$keys[10] => $this->getCaCornoruega(),
			$keys[11] => $this->getCaSingdolar(),
			$keys[12] => $this->getCaRand(),
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
		$pos = TRMPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaFecha($value);
				break;
			case 1:
				$this->setCaEuro($value);
				break;
			case 2:
				$this->setCaPesos($value);
				break;
			case 3:
				$this->setCaLibra($value);
				break;
			case 4:
				$this->setCaFsuizo($value);
				break;
			case 5:
				$this->setCaMarco($value);
				break;
			case 6:
				$this->setCaYen($value);
				break;
			case 7:
				$this->setCaRupee($value);
				break;
			case 8:
				$this->setCaAusdolar($value);
				break;
			case 9:
				$this->setCaCandolar($value);
				break;
			case 10:
				$this->setCaCornoruega($value);
				break;
			case 11:
				$this->setCaSingdolar($value);
				break;
			case 12:
				$this->setCaRand($value);
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
		$keys = TRMPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaFecha($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaEuro($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaPesos($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaLibra($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaFsuizo($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaMarco($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaYen($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaRupee($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaAusdolar($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaCandolar($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaCornoruega($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaSingdolar($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaRand($arr[$keys[12]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(TRMPeer::DATABASE_NAME);

		if ($this->isColumnModified(TRMPeer::CA_FECHA)) $criteria->add(TRMPeer::CA_FECHA, $this->ca_fecha);
		if ($this->isColumnModified(TRMPeer::CA_EURO)) $criteria->add(TRMPeer::CA_EURO, $this->ca_euro);
		if ($this->isColumnModified(TRMPeer::CA_PESOS)) $criteria->add(TRMPeer::CA_PESOS, $this->ca_pesos);
		if ($this->isColumnModified(TRMPeer::CA_LIBRA)) $criteria->add(TRMPeer::CA_LIBRA, $this->ca_libra);
		if ($this->isColumnModified(TRMPeer::CA_FSUIZO)) $criteria->add(TRMPeer::CA_FSUIZO, $this->ca_fsuizo);
		if ($this->isColumnModified(TRMPeer::CA_MARCO)) $criteria->add(TRMPeer::CA_MARCO, $this->ca_marco);
		if ($this->isColumnModified(TRMPeer::CA_YEN)) $criteria->add(TRMPeer::CA_YEN, $this->ca_yen);
		if ($this->isColumnModified(TRMPeer::CA_RUPEE)) $criteria->add(TRMPeer::CA_RUPEE, $this->ca_rupee);
		if ($this->isColumnModified(TRMPeer::CA_AUSDOLAR)) $criteria->add(TRMPeer::CA_AUSDOLAR, $this->ca_ausdolar);
		if ($this->isColumnModified(TRMPeer::CA_CANDOLAR)) $criteria->add(TRMPeer::CA_CANDOLAR, $this->ca_candolar);
		if ($this->isColumnModified(TRMPeer::CA_CORNORUEGA)) $criteria->add(TRMPeer::CA_CORNORUEGA, $this->ca_cornoruega);
		if ($this->isColumnModified(TRMPeer::CA_SINGDOLAR)) $criteria->add(TRMPeer::CA_SINGDOLAR, $this->ca_singdolar);
		if ($this->isColumnModified(TRMPeer::CA_RAND)) $criteria->add(TRMPeer::CA_RAND, $this->ca_rand);

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
		$criteria = new Criteria(TRMPeer::DATABASE_NAME);

		$criteria->add(TRMPeer::CA_FECHA, $this->ca_fecha);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCaFecha();
	}

	/**
	 * Generic method to set the primary key (ca_fecha column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaFecha($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of TRM (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaEuro($this->ca_euro);

		$copyObj->setCaPesos($this->ca_pesos);

		$copyObj->setCaLibra($this->ca_libra);

		$copyObj->setCaFsuizo($this->ca_fsuizo);

		$copyObj->setCaMarco($this->ca_marco);

		$copyObj->setCaYen($this->ca_yen);

		$copyObj->setCaRupee($this->ca_rupee);

		$copyObj->setCaAusdolar($this->ca_ausdolar);

		$copyObj->setCaCandolar($this->ca_candolar);

		$copyObj->setCaCornoruega($this->ca_cornoruega);

		$copyObj->setCaSingdolar($this->ca_singdolar);

		$copyObj->setCaRand($this->ca_rand);


		$copyObj->setNew(true);

		$copyObj->setCaFecha(NULL); // this is a pkey column, so set to default value

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
	 * @return     TRM Clone of current object.
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
	 * @return     TRMPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new TRMPeer();
		}
		return self::$peer;
	}

} // BaseTRM
