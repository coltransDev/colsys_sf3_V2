<?php

/**
 * Base class that represents a row from the 'tb_priccabotajes' table.
 *
 * 
 *
 * @package    lib.model.pricing.om
 */
abstract class BasePricCabotaje extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        PricCabotajePeer
	 */
	protected static $peer;


	/**
	 * The value for the oid field.
	 * @var        int
	 */
	protected $oid;


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
	 * @var        string
	 */
	protected $ca_idlinea;


	/**
	 * The value for the ca_vlrkilo field.
	 * @var        double
	 */
	protected $ca_vlrkilo;


	/**
	 * The value for the ca_vlrminimo field.
	 * @var        double
	 */
	protected $ca_vlrminimo;


	/**
	 * The value for the ca_maxpeso field.
	 * @var        double
	 */
	protected $ca_maxpeso;


	/**
	 * The value for the ca_dimensiones field.
	 * @var        string
	 */
	protected $ca_dimensiones;

	/**
	 * @var        Transportador
	 */
	protected $aTransportador;

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
	 * @return     string
	 */
	public function getCaIdlinea()
	{

		return $this->ca_idlinea;
	}

	/**
	 * Get the [ca_vlrkilo] column value.
	 * 
	 * @return     double
	 */
	public function getCaVlrkilo()
	{

		return $this->ca_vlrkilo;
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
	 * Get the [ca_maxpeso] column value.
	 * 
	 * @return     double
	 */
	public function getCaMaxpeso()
	{

		return $this->ca_maxpeso;
	}

	/**
	 * Get the [ca_dimensiones] column value.
	 * 
	 * @return     string
	 */
	public function getCaDimensiones()
	{

		return $this->ca_dimensiones;
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
			$this->modifiedColumns[] = PricCabotajePeer::OID;
		}

	} // setOid()

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
			$this->modifiedColumns[] = PricCabotajePeer::CA_ORIGEN;
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
			$this->modifiedColumns[] = PricCabotajePeer::CA_DESTINO;
		}

	} // setCaDestino()

	/**
	 * Set the value of [ca_idlinea] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaIdlinea($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_idlinea !== $v) {
			$this->ca_idlinea = $v;
			$this->modifiedColumns[] = PricCabotajePeer::CA_IDLINEA;
		}

		if ($this->aTransportador !== null && $this->aTransportador->getCaIdlinea() !== $v) {
			$this->aTransportador = null;
		}

	} // setCaIdlinea()

	/**
	 * Set the value of [ca_vlrkilo] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaVlrkilo($v)
	{

		if ($this->ca_vlrkilo !== $v) {
			$this->ca_vlrkilo = $v;
			$this->modifiedColumns[] = PricCabotajePeer::CA_VLRKILO;
		}

	} // setCaVlrkilo()

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
			$this->modifiedColumns[] = PricCabotajePeer::CA_VLRMINIMO;
		}

	} // setCaVlrminimo()

	/**
	 * Set the value of [ca_maxpeso] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaMaxpeso($v)
	{

		if ($this->ca_maxpeso !== $v) {
			$this->ca_maxpeso = $v;
			$this->modifiedColumns[] = PricCabotajePeer::CA_MAXPESO;
		}

	} // setCaMaxpeso()

	/**
	 * Set the value of [ca_dimensiones] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaDimensiones($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_dimensiones !== $v) {
			$this->ca_dimensiones = $v;
			$this->modifiedColumns[] = PricCabotajePeer::CA_DIMENSIONES;
		}

	} // setCaDimensiones()

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

			$this->ca_origen = $rs->getString($startcol + 1);

			$this->ca_destino = $rs->getString($startcol + 2);

			$this->ca_idlinea = $rs->getString($startcol + 3);

			$this->ca_vlrkilo = $rs->getFloat($startcol + 4);

			$this->ca_vlrminimo = $rs->getFloat($startcol + 5);

			$this->ca_maxpeso = $rs->getFloat($startcol + 6);

			$this->ca_dimensiones = $rs->getString($startcol + 7);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 8; // 8 = PricCabotajePeer::NUM_COLUMNS - PricCabotajePeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating PricCabotaje object", $e);
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
			$con = Propel::getConnection(PricCabotajePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PricCabotajePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(PricCabotajePeer::DATABASE_NAME);
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


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = PricCabotajePeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += PricCabotajePeer::doUpdate($this, $con);
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

			if ($this->aTransportador !== null) {
				if (!$this->aTransportador->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTransportador->getValidationFailures());
				}
			}


			if (($retval = PricCabotajePeer::doValidate($this, $columns)) !== true) {
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
		$pos = PricCabotajePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaOrigen();
				break;
			case 2:
				return $this->getCaDestino();
				break;
			case 3:
				return $this->getCaIdlinea();
				break;
			case 4:
				return $this->getCaVlrkilo();
				break;
			case 5:
				return $this->getCaVlrminimo();
				break;
			case 6:
				return $this->getCaMaxpeso();
				break;
			case 7:
				return $this->getCaDimensiones();
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
		$keys = PricCabotajePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getOid(),
			$keys[1] => $this->getCaOrigen(),
			$keys[2] => $this->getCaDestino(),
			$keys[3] => $this->getCaIdlinea(),
			$keys[4] => $this->getCaVlrkilo(),
			$keys[5] => $this->getCaVlrminimo(),
			$keys[6] => $this->getCaMaxpeso(),
			$keys[7] => $this->getCaDimensiones(),
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
		$pos = PricCabotajePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaOrigen($value);
				break;
			case 2:
				$this->setCaDestino($value);
				break;
			case 3:
				$this->setCaIdlinea($value);
				break;
			case 4:
				$this->setCaVlrkilo($value);
				break;
			case 5:
				$this->setCaVlrminimo($value);
				break;
			case 6:
				$this->setCaMaxpeso($value);
				break;
			case 7:
				$this->setCaDimensiones($value);
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
		$keys = PricCabotajePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setOid($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaOrigen($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaDestino($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaIdlinea($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaVlrkilo($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaVlrminimo($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaMaxpeso($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaDimensiones($arr[$keys[7]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(PricCabotajePeer::DATABASE_NAME);

		if ($this->isColumnModified(PricCabotajePeer::OID)) $criteria->add(PricCabotajePeer::OID, $this->oid);
		if ($this->isColumnModified(PricCabotajePeer::CA_ORIGEN)) $criteria->add(PricCabotajePeer::CA_ORIGEN, $this->ca_origen);
		if ($this->isColumnModified(PricCabotajePeer::CA_DESTINO)) $criteria->add(PricCabotajePeer::CA_DESTINO, $this->ca_destino);
		if ($this->isColumnModified(PricCabotajePeer::CA_IDLINEA)) $criteria->add(PricCabotajePeer::CA_IDLINEA, $this->ca_idlinea);
		if ($this->isColumnModified(PricCabotajePeer::CA_VLRKILO)) $criteria->add(PricCabotajePeer::CA_VLRKILO, $this->ca_vlrkilo);
		if ($this->isColumnModified(PricCabotajePeer::CA_VLRMINIMO)) $criteria->add(PricCabotajePeer::CA_VLRMINIMO, $this->ca_vlrminimo);
		if ($this->isColumnModified(PricCabotajePeer::CA_MAXPESO)) $criteria->add(PricCabotajePeer::CA_MAXPESO, $this->ca_maxpeso);
		if ($this->isColumnModified(PricCabotajePeer::CA_DIMENSIONES)) $criteria->add(PricCabotajePeer::CA_DIMENSIONES, $this->ca_dimensiones);

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
		$criteria = new Criteria(PricCabotajePeer::DATABASE_NAME);

		$criteria->add(PricCabotajePeer::CA_ORIGEN, $this->ca_origen);
		$criteria->add(PricCabotajePeer::CA_DESTINO, $this->ca_destino);
		$criteria->add(PricCabotajePeer::CA_IDLINEA, $this->ca_idlinea);

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

		$pks[0] = $this->getCaOrigen();

		$pks[1] = $this->getCaDestino();

		$pks[2] = $this->getCaIdlinea();

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

		$this->setCaOrigen($keys[0]);

		$this->setCaDestino($keys[1]);

		$this->setCaIdlinea($keys[2]);

	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of PricCabotaje (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setOid($this->oid);

		$copyObj->setCaVlrkilo($this->ca_vlrkilo);

		$copyObj->setCaVlrminimo($this->ca_vlrminimo);

		$copyObj->setCaMaxpeso($this->ca_maxpeso);

		$copyObj->setCaDimensiones($this->ca_dimensiones);


		$copyObj->setNew(true);

		$copyObj->setCaOrigen(NULL); // this is a pkey column, so set to default value

		$copyObj->setCaDestino(NULL); // this is a pkey column, so set to default value

		$copyObj->setCaIdlinea(NULL); // this is a pkey column, so set to default value

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
	 * @return     PricCabotaje Clone of current object.
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
	 * @return     PricCabotajePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new PricCabotajePeer();
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
		if ($this->aTransportador === null && (($this->ca_idlinea !== "" && $this->ca_idlinea !== null))) {
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

} // BasePricCabotaje
