<?php

/**
 * Base class that represents a row from the 'tb_ciudades' table.
 *
 * 
 *
 * @package    lib.model.public.om
 */
abstract class BaseCiudad extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        CiudadPeer
	 */
	protected static $peer;


	/**
	 * The value for the ca_idciudad field.
	 * @var        string
	 */
	protected $ca_idciudad;


	/**
	 * The value for the ca_ciudad field.
	 * @var        string
	 */
	protected $ca_ciudad;


	/**
	 * The value for the ca_idtrafico field.
	 * @var        string
	 */
	protected $ca_idtrafico;


	/**
	 * The value for the ca_puerto field.
	 * @var        string
	 */
	protected $ca_puerto;

	/**
	 * @var        Trafico
	 */
	protected $aTrafico;

	/**
	 * Collection to store aggregation of collClientes.
	 * @var        array
	 */
	protected $collClientes;

	/**
	 * The criteria used to select the current contents of collClientes.
	 * @var        Criteria
	 */
	protected $lastClienteCriteria = null;

	/**
	 * Collection to store aggregation of collAgentes.
	 * @var        array
	 */
	protected $collAgentes;

	/**
	 * The criteria used to select the current contents of collAgentes.
	 * @var        Criteria
	 */
	protected $lastAgenteCriteria = null;

	/**
	 * Collection to store aggregation of collContactoAgentes.
	 * @var        array
	 */
	protected $collContactoAgentes;

	/**
	 * The criteria used to select the current contents of collContactoAgentes.
	 * @var        Criteria
	 */
	protected $lastContactoAgenteCriteria = null;

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
	 * Get the [ca_ciudad] column value.
	 * 
	 * @return     string
	 */
	public function getCaCiudad()
	{

		return $this->ca_ciudad;
	}

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
	 * Get the [ca_puerto] column value.
	 * 
	 * @return     string
	 */
	public function getCaPuerto()
	{

		return $this->ca_puerto;
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
			$this->modifiedColumns[] = CiudadPeer::CA_IDCIUDAD;
		}

	} // setCaIdciudad()

	/**
	 * Set the value of [ca_ciudad] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaCiudad($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_ciudad !== $v) {
			$this->ca_ciudad = $v;
			$this->modifiedColumns[] = CiudadPeer::CA_CIUDAD;
		}

	} // setCaCiudad()

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
			$this->modifiedColumns[] = CiudadPeer::CA_IDTRAFICO;
		}

		if ($this->aTrafico !== null && $this->aTrafico->getCaIdtrafico() !== $v) {
			$this->aTrafico = null;
		}

	} // setCaIdtrafico()

	/**
	 * Set the value of [ca_puerto] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaPuerto($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_puerto !== $v) {
			$this->ca_puerto = $v;
			$this->modifiedColumns[] = CiudadPeer::CA_PUERTO;
		}

	} // setCaPuerto()

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

			$this->ca_ciudad = $rs->getString($startcol + 1);

			$this->ca_idtrafico = $rs->getString($startcol + 2);

			$this->ca_puerto = $rs->getString($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 4; // 4 = CiudadPeer::NUM_COLUMNS - CiudadPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Ciudad object", $e);
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
			$con = Propel::getConnection(CiudadPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			CiudadPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(CiudadPeer::DATABASE_NAME);
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

			if ($this->aTrafico !== null) {
				if ($this->aTrafico->isModified()) {
					$affectedRows += $this->aTrafico->save($con);
				}
				$this->setTrafico($this->aTrafico);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = CiudadPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += CiudadPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collClientes !== null) {
				foreach($this->collClientes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collAgentes !== null) {
				foreach($this->collAgentes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collContactoAgentes !== null) {
				foreach($this->collContactoAgentes as $referrerFK) {
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

			if ($this->aTrafico !== null) {
				if (!$this->aTrafico->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTrafico->getValidationFailures());
				}
			}


			if (($retval = CiudadPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collClientes !== null) {
					foreach($this->collClientes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collAgentes !== null) {
					foreach($this->collAgentes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collContactoAgentes !== null) {
					foreach($this->collContactoAgentes as $referrerFK) {
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
		$pos = CiudadPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaCiudad();
				break;
			case 2:
				return $this->getCaIdtrafico();
				break;
			case 3:
				return $this->getCaPuerto();
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
		$keys = CiudadPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdciudad(),
			$keys[1] => $this->getCaCiudad(),
			$keys[2] => $this->getCaIdtrafico(),
			$keys[3] => $this->getCaPuerto(),
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
		$pos = CiudadPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaCiudad($value);
				break;
			case 2:
				$this->setCaIdtrafico($value);
				break;
			case 3:
				$this->setCaPuerto($value);
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
		$keys = CiudadPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdciudad($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaCiudad($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaIdtrafico($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaPuerto($arr[$keys[3]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(CiudadPeer::DATABASE_NAME);

		if ($this->isColumnModified(CiudadPeer::CA_IDCIUDAD)) $criteria->add(CiudadPeer::CA_IDCIUDAD, $this->ca_idciudad);
		if ($this->isColumnModified(CiudadPeer::CA_CIUDAD)) $criteria->add(CiudadPeer::CA_CIUDAD, $this->ca_ciudad);
		if ($this->isColumnModified(CiudadPeer::CA_IDTRAFICO)) $criteria->add(CiudadPeer::CA_IDTRAFICO, $this->ca_idtrafico);
		if ($this->isColumnModified(CiudadPeer::CA_PUERTO)) $criteria->add(CiudadPeer::CA_PUERTO, $this->ca_puerto);

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
		$criteria = new Criteria(CiudadPeer::DATABASE_NAME);

		$criteria->add(CiudadPeer::CA_IDCIUDAD, $this->ca_idciudad);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     string
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdciudad();
	}

	/**
	 * Generic method to set the primary key (ca_idciudad column).
	 *
	 * @param      string $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdciudad($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Ciudad (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaCiudad($this->ca_ciudad);

		$copyObj->setCaIdtrafico($this->ca_idtrafico);

		$copyObj->setCaPuerto($this->ca_puerto);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getClientes() as $relObj) {
				$copyObj->addCliente($relObj->copy($deepCopy));
			}

			foreach($this->getAgentes() as $relObj) {
				$copyObj->addAgente($relObj->copy($deepCopy));
			}

			foreach($this->getContactoAgentes() as $relObj) {
				$copyObj->addContactoAgente($relObj->copy($deepCopy));
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setCaIdciudad(NULL); // this is a pkey column, so set to default value

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
	 * @return     Ciudad Clone of current object.
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
	 * @return     CiudadPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new CiudadPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Trafico object.
	 *
	 * @param      Trafico $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setTrafico($v)
	{


		if ($v === null) {
			$this->setCaIdtrafico(NULL);
		} else {
			$this->setCaIdtrafico($v->getCaIdtrafico());
		}


		$this->aTrafico = $v;
	}


	/**
	 * Get the associated Trafico object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Trafico The associated Trafico object.
	 * @throws     PropelException
	 */
	public function getTrafico($con = null)
	{
		if ($this->aTrafico === null && (($this->ca_idtrafico !== "" && $this->ca_idtrafico !== null))) {
			// include the related Peer class
			$this->aTrafico = TraficoPeer::retrieveByPK($this->ca_idtrafico, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = TraficoPeer::retrieveByPK($this->ca_idtrafico, $con);
			   $obj->addTraficos($this);
			 */
		}
		return $this->aTrafico;
	}

	/**
	 * Temporary storage of collClientes to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initClientes()
	{
		if ($this->collClientes === null) {
			$this->collClientes = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Ciudad has previously
	 * been saved, it will retrieve related Clientes from storage.
	 * If this Ciudad is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getClientes($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collClientes === null) {
			if ($this->isNew()) {
			   $this->collClientes = array();
			} else {

				$criteria->add(ClientePeer::CA_IDCIUDAD, $this->getCaIdciudad());

				ClientePeer::addSelectColumns($criteria);
				$this->collClientes = ClientePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ClientePeer::CA_IDCIUDAD, $this->getCaIdciudad());

				ClientePeer::addSelectColumns($criteria);
				if (!isset($this->lastClienteCriteria) || !$this->lastClienteCriteria->equals($criteria)) {
					$this->collClientes = ClientePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastClienteCriteria = $criteria;
		return $this->collClientes;
	}

	/**
	 * Returns the number of related Clientes.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countClientes($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ClientePeer::CA_IDCIUDAD, $this->getCaIdciudad());

		return ClientePeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Cliente object to this object
	 * through the Cliente foreign key attribute
	 *
	 * @param      Cliente $l Cliente
	 * @return     void
	 * @throws     PropelException
	 */
	public function addCliente(Cliente $l)
	{
		$this->collClientes[] = $l;
		$l->setCiudad($this);
	}

	/**
	 * Temporary storage of collAgentes to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initAgentes()
	{
		if ($this->collAgentes === null) {
			$this->collAgentes = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Ciudad has previously
	 * been saved, it will retrieve related Agentes from storage.
	 * If this Ciudad is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getAgentes($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAgentes === null) {
			if ($this->isNew()) {
			   $this->collAgentes = array();
			} else {

				$criteria->add(AgentePeer::CA_IDCIUDAD, $this->getCaIdciudad());

				AgentePeer::addSelectColumns($criteria);
				$this->collAgentes = AgentePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(AgentePeer::CA_IDCIUDAD, $this->getCaIdciudad());

				AgentePeer::addSelectColumns($criteria);
				if (!isset($this->lastAgenteCriteria) || !$this->lastAgenteCriteria->equals($criteria)) {
					$this->collAgentes = AgentePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAgenteCriteria = $criteria;
		return $this->collAgentes;
	}

	/**
	 * Returns the number of related Agentes.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countAgentes($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(AgentePeer::CA_IDCIUDAD, $this->getCaIdciudad());

		return AgentePeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Agente object to this object
	 * through the Agente foreign key attribute
	 *
	 * @param      Agente $l Agente
	 * @return     void
	 * @throws     PropelException
	 */
	public function addAgente(Agente $l)
	{
		$this->collAgentes[] = $l;
		$l->setCiudad($this);
	}

	/**
	 * Temporary storage of collContactoAgentes to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initContactoAgentes()
	{
		if ($this->collContactoAgentes === null) {
			$this->collContactoAgentes = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Ciudad has previously
	 * been saved, it will retrieve related ContactoAgentes from storage.
	 * If this Ciudad is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getContactoAgentes($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collContactoAgentes === null) {
			if ($this->isNew()) {
			   $this->collContactoAgentes = array();
			} else {

				$criteria->add(ContactoAgentePeer::CA_IDCIUDAD, $this->getCaIdciudad());

				ContactoAgentePeer::addSelectColumns($criteria);
				$this->collContactoAgentes = ContactoAgentePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ContactoAgentePeer::CA_IDCIUDAD, $this->getCaIdciudad());

				ContactoAgentePeer::addSelectColumns($criteria);
				if (!isset($this->lastContactoAgenteCriteria) || !$this->lastContactoAgenteCriteria->equals($criteria)) {
					$this->collContactoAgentes = ContactoAgentePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastContactoAgenteCriteria = $criteria;
		return $this->collContactoAgentes;
	}

	/**
	 * Returns the number of related ContactoAgentes.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countContactoAgentes($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ContactoAgentePeer::CA_IDCIUDAD, $this->getCaIdciudad());

		return ContactoAgentePeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a ContactoAgente object to this object
	 * through the ContactoAgente foreign key attribute
	 *
	 * @param      ContactoAgente $l ContactoAgente
	 * @return     void
	 * @throws     PropelException
	 */
	public function addContactoAgente(ContactoAgente $l)
	{
		$this->collContactoAgentes[] = $l;
		$l->setCiudad($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Ciudad is new, it will return
	 * an empty collection; or if this Ciudad has previously
	 * been saved, it will retrieve related ContactoAgentes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Ciudad.
	 */
	public function getContactoAgentesJoinAgente($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collContactoAgentes === null) {
			if ($this->isNew()) {
				$this->collContactoAgentes = array();
			} else {

				$criteria->add(ContactoAgentePeer::CA_IDCIUDAD, $this->getCaIdciudad());

				$this->collContactoAgentes = ContactoAgentePeer::doSelectJoinAgente($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ContactoAgentePeer::CA_IDCIUDAD, $this->getCaIdciudad());

			if (!isset($this->lastContactoAgenteCriteria) || !$this->lastContactoAgenteCriteria->equals($criteria)) {
				$this->collContactoAgentes = ContactoAgentePeer::doSelectJoinAgente($criteria, $con);
			}
		}
		$this->lastContactoAgenteCriteria = $criteria;

		return $this->collContactoAgentes;
	}

} // BaseCiudad
