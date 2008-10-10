<?php

/**
 * Base class that represents a row from the 'tb_pricrecargosxciudad' table.
 *
 * 
 *
 * @package    lib.model.pricing.om
 */
abstract class BasePricRecargosxCiudad extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        PricRecargosxCiudadPeer
	 */
	protected static $peer;


	/**
	 * The value for the ca_idciudad field.
	 * @var        string
	 */
	protected $ca_idciudad;


	/**
	 * The value for the ca_idrecargo field.
	 * @var        int
	 */
	protected $ca_idrecargo;


	/**
	 * The value for the ca_modalidad field.
	 * @var        string
	 */
	protected $ca_modalidad;


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
	 * The value for the ca_idmoneda field.
	 * @var        string
	 */
	protected $ca_idmoneda;

	/**
	 * @var        Ciudad
	 */
	protected $aCiudad;

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
	 * Get the [ca_idciudad] column value.
	 * 
	 * @return     string
	 */
	public function getCaIdciudad()
	{

		return $this->ca_idciudad;
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
	 * Get the [ca_modalidad] column value.
	 * 
	 * @return     string
	 */
	public function getCaModalidad()
	{

		return $this->ca_modalidad;
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
	 * Get the [ca_idmoneda] column value.
	 * 
	 * @return     string
	 */
	public function getCaIdmoneda()
	{

		return $this->ca_idmoneda;
	}

	/**
	 * Set the value of [ca_idciudad] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaIdciudad($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_idciudad !== $v) {
			$this->ca_idciudad = $v;
			$this->modifiedColumns[] = PricRecargosxCiudadPeer::CA_IDCIUDAD;
		}

		if ($this->aCiudad !== null && $this->aCiudad->getCaIdciudad() !== $v) {
			$this->aCiudad = null;
		}

	} // setCaIdciudad()

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
			$this->modifiedColumns[] = PricRecargosxCiudadPeer::CA_IDRECARGO;
		}

		if ($this->aTipoRecargo !== null && $this->aTipoRecargo->getCaIdrecargo() !== $v) {
			$this->aTipoRecargo = null;
		}

	} // setCaIdrecargo()

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
			$this->modifiedColumns[] = PricRecargosxCiudadPeer::CA_MODALIDAD;
		}

	} // setCaModalidad()

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
			$this->modifiedColumns[] = PricRecargosxCiudadPeer::CA_VLRRECARGO;
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
			$this->modifiedColumns[] = PricRecargosxCiudadPeer::CA_VLRMINIMO;
		}

	} // setCaVlrminimo()

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
			$this->modifiedColumns[] = PricRecargosxCiudadPeer::CA_IDMONEDA;
		}

	} // setCaIdmoneda()

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

			$this->ca_idciudad = $rs->getString($startcol + 0);

			$this->ca_idrecargo = $rs->getInt($startcol + 1);

			$this->ca_modalidad = $rs->getString($startcol + 2);

			$this->ca_vlrrecargo = $rs->getFloat($startcol + 3);

			$this->ca_vlrminimo = $rs->getFloat($startcol + 4);

			$this->ca_idmoneda = $rs->getString($startcol + 5);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 6; // 6 = PricRecargosxCiudadPeer::NUM_COLUMNS - PricRecargosxCiudadPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating PricRecargosxCiudad object", $e);
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
			$con = Propel::getConnection(PricRecargosxCiudadPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PricRecargosxCiudadPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(PricRecargosxCiudadPeer::DATABASE_NAME);
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

			if ($this->aCiudad !== null) {
				if ($this->aCiudad->isModified()) {
					$affectedRows += $this->aCiudad->save($con);
				}
				$this->setCiudad($this->aCiudad);
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
					$pk = PricRecargosxCiudadPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += PricRecargosxCiudadPeer::doUpdate($this, $con);
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

			if ($this->aCiudad !== null) {
				if (!$this->aCiudad->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCiudad->getValidationFailures());
				}
			}

			if ($this->aTipoRecargo !== null) {
				if (!$this->aTipoRecargo->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTipoRecargo->getValidationFailures());
				}
			}


			if (($retval = PricRecargosxCiudadPeer::doValidate($this, $columns)) !== true) {
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
		$pos = PricRecargosxCiudadPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdciudad();
				break;
			case 1:
				return $this->getCaIdrecargo();
				break;
			case 2:
				return $this->getCaModalidad();
				break;
			case 3:
				return $this->getCaVlrrecargo();
				break;
			case 4:
				return $this->getCaVlrminimo();
				break;
			case 5:
				return $this->getCaIdmoneda();
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
		$keys = PricRecargosxCiudadPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdciudad(),
			$keys[1] => $this->getCaIdrecargo(),
			$keys[2] => $this->getCaModalidad(),
			$keys[3] => $this->getCaVlrrecargo(),
			$keys[4] => $this->getCaVlrminimo(),
			$keys[5] => $this->getCaIdmoneda(),
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
		$pos = PricRecargosxCiudadPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdciudad($value);
				break;
			case 1:
				$this->setCaIdrecargo($value);
				break;
			case 2:
				$this->setCaModalidad($value);
				break;
			case 3:
				$this->setCaVlrrecargo($value);
				break;
			case 4:
				$this->setCaVlrminimo($value);
				break;
			case 5:
				$this->setCaIdmoneda($value);
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
		$keys = PricRecargosxCiudadPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdciudad($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdrecargo($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaModalidad($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaVlrrecargo($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaVlrminimo($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaIdmoneda($arr[$keys[5]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(PricRecargosxCiudadPeer::DATABASE_NAME);

		if ($this->isColumnModified(PricRecargosxCiudadPeer::CA_IDCIUDAD)) $criteria->add(PricRecargosxCiudadPeer::CA_IDCIUDAD, $this->ca_idciudad);
		if ($this->isColumnModified(PricRecargosxCiudadPeer::CA_IDRECARGO)) $criteria->add(PricRecargosxCiudadPeer::CA_IDRECARGO, $this->ca_idrecargo);
		if ($this->isColumnModified(PricRecargosxCiudadPeer::CA_MODALIDAD)) $criteria->add(PricRecargosxCiudadPeer::CA_MODALIDAD, $this->ca_modalidad);
		if ($this->isColumnModified(PricRecargosxCiudadPeer::CA_VLRRECARGO)) $criteria->add(PricRecargosxCiudadPeer::CA_VLRRECARGO, $this->ca_vlrrecargo);
		if ($this->isColumnModified(PricRecargosxCiudadPeer::CA_VLRMINIMO)) $criteria->add(PricRecargosxCiudadPeer::CA_VLRMINIMO, $this->ca_vlrminimo);
		if ($this->isColumnModified(PricRecargosxCiudadPeer::CA_IDMONEDA)) $criteria->add(PricRecargosxCiudadPeer::CA_IDMONEDA, $this->ca_idmoneda);

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
		$criteria = new Criteria(PricRecargosxCiudadPeer::DATABASE_NAME);

		$criteria->add(PricRecargosxCiudadPeer::CA_IDCIUDAD, $this->ca_idciudad);
		$criteria->add(PricRecargosxCiudadPeer::CA_IDRECARGO, $this->ca_idrecargo);

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

		$pks[0] = $this->getCaIdciudad();

		$pks[1] = $this->getCaIdrecargo();

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

		$this->setCaIdciudad($keys[0]);

		$this->setCaIdrecargo($keys[1]);

	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of PricRecargosxCiudad (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaModalidad($this->ca_modalidad);

		$copyObj->setCaVlrrecargo($this->ca_vlrrecargo);

		$copyObj->setCaVlrminimo($this->ca_vlrminimo);

		$copyObj->setCaIdmoneda($this->ca_idmoneda);


		$copyObj->setNew(true);

		$copyObj->setCaIdciudad(NULL); // this is a pkey column, so set to default value

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
	 * @return     PricRecargosxCiudad Clone of current object.
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
	 * @return     PricRecargosxCiudadPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new PricRecargosxCiudadPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Ciudad object.
	 *
	 * @param      Ciudad $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setCiudad($v)
	{


		if ($v === null) {
			$this->setCaIdciudad(NULL);
		} else {
			$this->setCaIdciudad($v->getCaIdciudad());
		}


		$this->aCiudad = $v;
	}


	/**
	 * Get the associated Ciudad object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Ciudad The associated Ciudad object.
	 * @throws     PropelException
	 */
	public function getCiudad($con = null)
	{
		if ($this->aCiudad === null && (($this->ca_idciudad !== "" && $this->ca_idciudad !== null))) {
			// include the related Peer class
			$this->aCiudad = CiudadPeer::retrieveByPK($this->ca_idciudad, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = CiudadPeer::retrieveByPK($this->ca_idciudad, $con);
			   $obj->addCiudads($this);
			 */
		}
		return $this->aCiudad;
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

} // BasePricRecargosxCiudad
