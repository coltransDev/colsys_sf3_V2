<?php

/**
 * Base class that represents a row from the 'tb_traficos' table.
 *
 * 
 *
 * @package    lib.model.public.om
 */
abstract class BaseTrafico extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        TraficoPeer
	 */
	protected static $peer;


	/**
	 * The value for the ca_idtrafico field.
	 * @var        string
	 */
	protected $ca_idtrafico;


	/**
	 * The value for the ca_nombre field.
	 * @var        string
	 */
	protected $ca_nombre;


	/**
	 * The value for the ca_bandera field.
	 * @var        string
	 */
	protected $ca_bandera;


	/**
	 * The value for the ca_idmoneda field.
	 * @var        string
	 */
	protected $ca_idmoneda;


	/**
	 * The value for the ca_idgrupo field.
	 * @var        int
	 */
	protected $ca_idgrupo;


	/**
	 * The value for the ca_link field.
	 * @var        string
	 */
	protected $ca_link;


	/**
	 * The value for the ca_conceptos field.
	 * @var        string
	 */
	protected $ca_conceptos;


	/**
	 * The value for the ca_recargos field.
	 * @var        string
	 */
	protected $ca_recargos;

	/**
	 * Collection to store aggregation of collCiudads.
	 * @var        array
	 */
	protected $collCiudads;

	/**
	 * The criteria used to select the current contents of collCiudads.
	 * @var        Criteria
	 */
	protected $lastCiudadCriteria = null;

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
	 * Get the [ca_idtrafico] column value.
	 * 
	 * @return     string
	 */
	public function getCaIdtrafico()
	{

		return $this->ca_idtrafico;
	}

	/**
	 * Get the [ca_nombre] column value.
	 * 
	 * @return     string
	 */
	public function getCaNombre()
	{

		return $this->ca_nombre;
	}

	/**
	 * Get the [ca_bandera] column value.
	 * 
	 * @return     string
	 */
	public function getCaBandera()
	{

		return $this->ca_bandera;
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
	 * Get the [ca_idgrupo] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdgrupo()
	{

		return $this->ca_idgrupo;
	}

	/**
	 * Get the [ca_link] column value.
	 * 
	 * @return     string
	 */
	public function getCaLink()
	{

		return $this->ca_link;
	}

	/**
	 * Get the [ca_conceptos] column value.
	 * 
	 * @return     string
	 */
	public function getCaConceptos()
	{

		return $this->ca_conceptos;
	}

	/**
	 * Get the [ca_recargos] column value.
	 * 
	 * @return     string
	 */
	public function getCaRecargos()
	{

		return $this->ca_recargos;
	}

	/**
	 * Set the value of [ca_idtrafico] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaIdtrafico($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_idtrafico !== $v) {
			$this->ca_idtrafico = $v;
			$this->modifiedColumns[] = TraficoPeer::CA_IDTRAFICO;
		}

	} // setCaIdtrafico()

	/**
	 * Set the value of [ca_nombre] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaNombre($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_nombre !== $v) {
			$this->ca_nombre = $v;
			$this->modifiedColumns[] = TraficoPeer::CA_NOMBRE;
		}

	} // setCaNombre()

	/**
	 * Set the value of [ca_bandera] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaBandera($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_bandera !== $v) {
			$this->ca_bandera = $v;
			$this->modifiedColumns[] = TraficoPeer::CA_BANDERA;
		}

	} // setCaBandera()

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
			$this->modifiedColumns[] = TraficoPeer::CA_IDMONEDA;
		}

	} // setCaIdmoneda()

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
			$this->modifiedColumns[] = TraficoPeer::CA_IDGRUPO;
		}

	} // setCaIdgrupo()

	/**
	 * Set the value of [ca_link] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaLink($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_link !== $v) {
			$this->ca_link = $v;
			$this->modifiedColumns[] = TraficoPeer::CA_LINK;
		}

	} // setCaLink()

	/**
	 * Set the value of [ca_conceptos] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaConceptos($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_conceptos !== $v) {
			$this->ca_conceptos = $v;
			$this->modifiedColumns[] = TraficoPeer::CA_CONCEPTOS;
		}

	} // setCaConceptos()

	/**
	 * Set the value of [ca_recargos] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaRecargos($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_recargos !== $v) {
			$this->ca_recargos = $v;
			$this->modifiedColumns[] = TraficoPeer::CA_RECARGOS;
		}

	} // setCaRecargos()

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

			$this->ca_idtrafico = $rs->getString($startcol + 0);

			$this->ca_nombre = $rs->getString($startcol + 1);

			$this->ca_bandera = $rs->getString($startcol + 2);

			$this->ca_idmoneda = $rs->getString($startcol + 3);

			$this->ca_idgrupo = $rs->getInt($startcol + 4);

			$this->ca_link = $rs->getString($startcol + 5);

			$this->ca_conceptos = $rs->getString($startcol + 6);

			$this->ca_recargos = $rs->getString($startcol + 7);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 8; // 8 = TraficoPeer::NUM_COLUMNS - TraficoPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Trafico object", $e);
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
			$con = Propel::getConnection(TraficoPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			TraficoPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(TraficoPeer::DATABASE_NAME);
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
					$pk = TraficoPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setCaIdtrafico($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += TraficoPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collCiudads !== null) {
				foreach($this->collCiudads as $referrerFK) {
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


			if (($retval = TraficoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collCiudads !== null) {
					foreach($this->collCiudads as $referrerFK) {
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
		$pos = TraficoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdtrafico();
				break;
			case 1:
				return $this->getCaNombre();
				break;
			case 2:
				return $this->getCaBandera();
				break;
			case 3:
				return $this->getCaIdmoneda();
				break;
			case 4:
				return $this->getCaIdgrupo();
				break;
			case 5:
				return $this->getCaLink();
				break;
			case 6:
				return $this->getCaConceptos();
				break;
			case 7:
				return $this->getCaRecargos();
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
		$keys = TraficoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdtrafico(),
			$keys[1] => $this->getCaNombre(),
			$keys[2] => $this->getCaBandera(),
			$keys[3] => $this->getCaIdmoneda(),
			$keys[4] => $this->getCaIdgrupo(),
			$keys[5] => $this->getCaLink(),
			$keys[6] => $this->getCaConceptos(),
			$keys[7] => $this->getCaRecargos(),
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
		$pos = TraficoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdtrafico($value);
				break;
			case 1:
				$this->setCaNombre($value);
				break;
			case 2:
				$this->setCaBandera($value);
				break;
			case 3:
				$this->setCaIdmoneda($value);
				break;
			case 4:
				$this->setCaIdgrupo($value);
				break;
			case 5:
				$this->setCaLink($value);
				break;
			case 6:
				$this->setCaConceptos($value);
				break;
			case 7:
				$this->setCaRecargos($value);
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
		$keys = TraficoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdtrafico($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaNombre($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaBandera($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaIdmoneda($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaIdgrupo($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaLink($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaConceptos($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaRecargos($arr[$keys[7]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(TraficoPeer::DATABASE_NAME);

		if ($this->isColumnModified(TraficoPeer::CA_IDTRAFICO)) $criteria->add(TraficoPeer::CA_IDTRAFICO, $this->ca_idtrafico);
		if ($this->isColumnModified(TraficoPeer::CA_NOMBRE)) $criteria->add(TraficoPeer::CA_NOMBRE, $this->ca_nombre);
		if ($this->isColumnModified(TraficoPeer::CA_BANDERA)) $criteria->add(TraficoPeer::CA_BANDERA, $this->ca_bandera);
		if ($this->isColumnModified(TraficoPeer::CA_IDMONEDA)) $criteria->add(TraficoPeer::CA_IDMONEDA, $this->ca_idmoneda);
		if ($this->isColumnModified(TraficoPeer::CA_IDGRUPO)) $criteria->add(TraficoPeer::CA_IDGRUPO, $this->ca_idgrupo);
		if ($this->isColumnModified(TraficoPeer::CA_LINK)) $criteria->add(TraficoPeer::CA_LINK, $this->ca_link);
		if ($this->isColumnModified(TraficoPeer::CA_CONCEPTOS)) $criteria->add(TraficoPeer::CA_CONCEPTOS, $this->ca_conceptos);
		if ($this->isColumnModified(TraficoPeer::CA_RECARGOS)) $criteria->add(TraficoPeer::CA_RECARGOS, $this->ca_recargos);

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
		$criteria = new Criteria(TraficoPeer::DATABASE_NAME);

		$criteria->add(TraficoPeer::CA_IDTRAFICO, $this->ca_idtrafico);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     string
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdtrafico();
	}

	/**
	 * Generic method to set the primary key (ca_idtrafico column).
	 *
	 * @param      string $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdtrafico($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Trafico (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaNombre($this->ca_nombre);

		$copyObj->setCaBandera($this->ca_bandera);

		$copyObj->setCaIdmoneda($this->ca_idmoneda);

		$copyObj->setCaIdgrupo($this->ca_idgrupo);

		$copyObj->setCaLink($this->ca_link);

		$copyObj->setCaConceptos($this->ca_conceptos);

		$copyObj->setCaRecargos($this->ca_recargos);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getCiudads() as $relObj) {
				$copyObj->addCiudad($relObj->copy($deepCopy));
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setCaIdtrafico(NULL); // this is a pkey column, so set to default value

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
	 * @return     Trafico Clone of current object.
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
	 * @return     TraficoPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new TraficoPeer();
		}
		return self::$peer;
	}

	/**
	 * Temporary storage of collCiudads to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initCiudads()
	{
		if ($this->collCiudads === null) {
			$this->collCiudads = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Trafico has previously
	 * been saved, it will retrieve related Ciudads from storage.
	 * If this Trafico is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getCiudads($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCiudads === null) {
			if ($this->isNew()) {
			   $this->collCiudads = array();
			} else {

				$criteria->add(CiudadPeer::CA_IDTRAFICO, $this->getCaIdtrafico());

				CiudadPeer::addSelectColumns($criteria);
				$this->collCiudads = CiudadPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CiudadPeer::CA_IDTRAFICO, $this->getCaIdtrafico());

				CiudadPeer::addSelectColumns($criteria);
				if (!isset($this->lastCiudadCriteria) || !$this->lastCiudadCriteria->equals($criteria)) {
					$this->collCiudads = CiudadPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCiudadCriteria = $criteria;
		return $this->collCiudads;
	}

	/**
	 * Returns the number of related Ciudads.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countCiudads($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CiudadPeer::CA_IDTRAFICO, $this->getCaIdtrafico());

		return CiudadPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Ciudad object to this object
	 * through the Ciudad foreign key attribute
	 *
	 * @param      Ciudad $l Ciudad
	 * @return     void
	 * @throws     PropelException
	 */
	public function addCiudad(Ciudad $l)
	{
		$this->collCiudads[] = $l;
		$l->setTrafico($this);
	}

} // BaseTrafico
