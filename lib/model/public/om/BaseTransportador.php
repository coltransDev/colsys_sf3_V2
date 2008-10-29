<?php

/**
 * Base class that represents a row from the 'tb_transporlineas' table.
 *
 * 
 *
 * @package    lib.model.public.om
 */
abstract class BaseTransportador extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        TransportadorPeer
	 */
	protected static $peer;


	/**
	 * The value for the ca_idlinea field.
	 * @var        int
	 */
	protected $ca_idlinea;


	/**
	 * The value for the ca_idtransportista field.
	 * @var        double
	 */
	protected $ca_idtransportista;


	/**
	 * The value for the ca_nombre field.
	 * @var        string
	 */
	protected $ca_nombre;


	/**
	 * The value for the ca_sigla field.
	 * @var        string
	 */
	protected $ca_sigla;


	/**
	 * The value for the ca_transporte field.
	 * @var        string
	 */
	protected $ca_transporte;

	/**
	 * Collection to store aggregation of collInoMaestraAirs.
	 * @var        array
	 */
	protected $collInoMaestraAirs;

	/**
	 * The criteria used to select the current contents of collInoMaestraAirs.
	 * @var        Criteria
	 */
	protected $lastInoMaestraAirCriteria = null;

	/**
	 * Collection to store aggregation of collTrayectos.
	 * @var        array
	 */
	protected $collTrayectos;

	/**
	 * The criteria used to select the current contents of collTrayectos.
	 * @var        Criteria
	 */
	protected $lastTrayectoCriteria = null;

	/**
	 * Collection to store aggregation of collPricCabotajes.
	 * @var        array
	 */
	protected $collPricCabotajes;

	/**
	 * The criteria used to select the current contents of collPricCabotajes.
	 * @var        Criteria
	 */
	protected $lastPricCabotajeCriteria = null;

	/**
	 * Collection to store aggregation of collReportes.
	 * @var        array
	 */
	protected $collReportes;

	/**
	 * The criteria used to select the current contents of collReportes.
	 * @var        Criteria
	 */
	protected $lastReporteCriteria = null;

	/**
	 * Collection to store aggregation of collInoMaestraSeas.
	 * @var        array
	 */
	protected $collInoMaestraSeas;

	/**
	 * The criteria used to select the current contents of collInoMaestraSeas.
	 * @var        Criteria
	 */
	protected $lastInoMaestraSeaCriteria = null;

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
	 * Get the [ca_idlinea] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdlinea()
	{

		return $this->ca_idlinea;
	}

	/**
	 * Get the [ca_idtransportista] column value.
	 * 
	 * @return     double
	 */
	public function getCaIdtransportista()
	{

		return $this->ca_idtransportista;
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
	 * Get the [ca_sigla] column value.
	 * 
	 * @return     string
	 */
	public function getCaSigla()
	{

		return $this->ca_sigla;
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
			$this->modifiedColumns[] = TransportadorPeer::CA_IDLINEA;
		}

	} // setCaIdlinea()

	/**
	 * Set the value of [ca_idtransportista] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaIdtransportista($v)
	{

		if ($this->ca_idtransportista !== $v) {
			$this->ca_idtransportista = $v;
			$this->modifiedColumns[] = TransportadorPeer::CA_IDTRANSPORTISTA;
		}

	} // setCaIdtransportista()

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
			$this->modifiedColumns[] = TransportadorPeer::CA_NOMBRE;
		}

	} // setCaNombre()

	/**
	 * Set the value of [ca_sigla] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaSigla($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_sigla !== $v) {
			$this->ca_sigla = $v;
			$this->modifiedColumns[] = TransportadorPeer::CA_SIGLA;
		}

	} // setCaSigla()

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
			$this->modifiedColumns[] = TransportadorPeer::CA_TRANSPORTE;
		}

	} // setCaTransporte()

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

			$this->ca_idlinea = $rs->getInt($startcol + 0);

			$this->ca_idtransportista = $rs->getFloat($startcol + 1);

			$this->ca_nombre = $rs->getString($startcol + 2);

			$this->ca_sigla = $rs->getString($startcol + 3);

			$this->ca_transporte = $rs->getString($startcol + 4);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 5; // 5 = TransportadorPeer::NUM_COLUMNS - TransportadorPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Transportador object", $e);
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
			$con = Propel::getConnection(TransportadorPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			TransportadorPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(TransportadorPeer::DATABASE_NAME);
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
					$pk = TransportadorPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setCaIdlinea($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += TransportadorPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collInoMaestraAirs !== null) {
				foreach($this->collInoMaestraAirs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collTrayectos !== null) {
				foreach($this->collTrayectos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPricCabotajes !== null) {
				foreach($this->collPricCabotajes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collReportes !== null) {
				foreach($this->collReportes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collInoMaestraSeas !== null) {
				foreach($this->collInoMaestraSeas as $referrerFK) {
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


			if (($retval = TransportadorPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collInoMaestraAirs !== null) {
					foreach($this->collInoMaestraAirs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collTrayectos !== null) {
					foreach($this->collTrayectos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPricCabotajes !== null) {
					foreach($this->collPricCabotajes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collReportes !== null) {
					foreach($this->collReportes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collInoMaestraSeas !== null) {
					foreach($this->collInoMaestraSeas as $referrerFK) {
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
		$pos = TransportadorPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdlinea();
				break;
			case 1:
				return $this->getCaIdtransportista();
				break;
			case 2:
				return $this->getCaNombre();
				break;
			case 3:
				return $this->getCaSigla();
				break;
			case 4:
				return $this->getCaTransporte();
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
		$keys = TransportadorPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdlinea(),
			$keys[1] => $this->getCaIdtransportista(),
			$keys[2] => $this->getCaNombre(),
			$keys[3] => $this->getCaSigla(),
			$keys[4] => $this->getCaTransporte(),
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
		$pos = TransportadorPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdlinea($value);
				break;
			case 1:
				$this->setCaIdtransportista($value);
				break;
			case 2:
				$this->setCaNombre($value);
				break;
			case 3:
				$this->setCaSigla($value);
				break;
			case 4:
				$this->setCaTransporte($value);
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
		$keys = TransportadorPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdlinea($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdtransportista($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaNombre($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaSigla($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaTransporte($arr[$keys[4]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);

		if ($this->isColumnModified(TransportadorPeer::CA_IDLINEA)) $criteria->add(TransportadorPeer::CA_IDLINEA, $this->ca_idlinea);
		if ($this->isColumnModified(TransportadorPeer::CA_IDTRANSPORTISTA)) $criteria->add(TransportadorPeer::CA_IDTRANSPORTISTA, $this->ca_idtransportista);
		if ($this->isColumnModified(TransportadorPeer::CA_NOMBRE)) $criteria->add(TransportadorPeer::CA_NOMBRE, $this->ca_nombre);
		if ($this->isColumnModified(TransportadorPeer::CA_SIGLA)) $criteria->add(TransportadorPeer::CA_SIGLA, $this->ca_sigla);
		if ($this->isColumnModified(TransportadorPeer::CA_TRANSPORTE)) $criteria->add(TransportadorPeer::CA_TRANSPORTE, $this->ca_transporte);

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
		$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);

		$criteria->add(TransportadorPeer::CA_IDLINEA, $this->ca_idlinea);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdlinea();
	}

	/**
	 * Generic method to set the primary key (ca_idlinea column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdlinea($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Transportador (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdtransportista($this->ca_idtransportista);

		$copyObj->setCaNombre($this->ca_nombre);

		$copyObj->setCaSigla($this->ca_sigla);

		$copyObj->setCaTransporte($this->ca_transporte);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getInoMaestraAirs() as $relObj) {
				$copyObj->addInoMaestraAir($relObj->copy($deepCopy));
			}

			foreach($this->getTrayectos() as $relObj) {
				$copyObj->addTrayecto($relObj->copy($deepCopy));
			}

			foreach($this->getPricCabotajes() as $relObj) {
				$copyObj->addPricCabotaje($relObj->copy($deepCopy));
			}

			foreach($this->getReportes() as $relObj) {
				$copyObj->addReporte($relObj->copy($deepCopy));
			}

			foreach($this->getInoMaestraSeas() as $relObj) {
				$copyObj->addInoMaestraSea($relObj->copy($deepCopy));
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

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
	 * @return     Transportador Clone of current object.
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
	 * @return     TransportadorPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new TransportadorPeer();
		}
		return self::$peer;
	}

	/**
	 * Temporary storage of collInoMaestraAirs to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initInoMaestraAirs()
	{
		if ($this->collInoMaestraAirs === null) {
			$this->collInoMaestraAirs = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Transportador has previously
	 * been saved, it will retrieve related InoMaestraAirs from storage.
	 * If this Transportador is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getInoMaestraAirs($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoMaestraAirs === null) {
			if ($this->isNew()) {
			   $this->collInoMaestraAirs = array();
			} else {

				$criteria->add(InoMaestraAirPeer::CA_IDLINEA, $this->getCaIdlinea());

				InoMaestraAirPeer::addSelectColumns($criteria);
				$this->collInoMaestraAirs = InoMaestraAirPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(InoMaestraAirPeer::CA_IDLINEA, $this->getCaIdlinea());

				InoMaestraAirPeer::addSelectColumns($criteria);
				if (!isset($this->lastInoMaestraAirCriteria) || !$this->lastInoMaestraAirCriteria->equals($criteria)) {
					$this->collInoMaestraAirs = InoMaestraAirPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInoMaestraAirCriteria = $criteria;
		return $this->collInoMaestraAirs;
	}

	/**
	 * Returns the number of related InoMaestraAirs.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countInoMaestraAirs($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(InoMaestraAirPeer::CA_IDLINEA, $this->getCaIdlinea());

		return InoMaestraAirPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a InoMaestraAir object to this object
	 * through the InoMaestraAir foreign key attribute
	 *
	 * @param      InoMaestraAir $l InoMaestraAir
	 * @return     void
	 * @throws     PropelException
	 */
	public function addInoMaestraAir(InoMaestraAir $l)
	{
		$this->collInoMaestraAirs[] = $l;
		$l->setTransportador($this);
	}

	/**
	 * Temporary storage of collTrayectos to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initTrayectos()
	{
		if ($this->collTrayectos === null) {
			$this->collTrayectos = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Transportador has previously
	 * been saved, it will retrieve related Trayectos from storage.
	 * If this Transportador is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getTrayectos($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTrayectos === null) {
			if ($this->isNew()) {
			   $this->collTrayectos = array();
			} else {

				$criteria->add(TrayectoPeer::CA_IDLINEA, $this->getCaIdlinea());

				TrayectoPeer::addSelectColumns($criteria);
				$this->collTrayectos = TrayectoPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(TrayectoPeer::CA_IDLINEA, $this->getCaIdlinea());

				TrayectoPeer::addSelectColumns($criteria);
				if (!isset($this->lastTrayectoCriteria) || !$this->lastTrayectoCriteria->equals($criteria)) {
					$this->collTrayectos = TrayectoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastTrayectoCriteria = $criteria;
		return $this->collTrayectos;
	}

	/**
	 * Returns the number of related Trayectos.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countTrayectos($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(TrayectoPeer::CA_IDLINEA, $this->getCaIdlinea());

		return TrayectoPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Trayecto object to this object
	 * through the Trayecto foreign key attribute
	 *
	 * @param      Trayecto $l Trayecto
	 * @return     void
	 * @throws     PropelException
	 */
	public function addTrayecto(Trayecto $l)
	{
		$this->collTrayectos[] = $l;
		$l->setTransportador($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Transportador is new, it will return
	 * an empty collection; or if this Transportador has previously
	 * been saved, it will retrieve related Trayectos from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Transportador.
	 */
	public function getTrayectosJoinAgente($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTrayectos === null) {
			if ($this->isNew()) {
				$this->collTrayectos = array();
			} else {

				$criteria->add(TrayectoPeer::CA_IDLINEA, $this->getCaIdlinea());

				$this->collTrayectos = TrayectoPeer::doSelectJoinAgente($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(TrayectoPeer::CA_IDLINEA, $this->getCaIdlinea());

			if (!isset($this->lastTrayectoCriteria) || !$this->lastTrayectoCriteria->equals($criteria)) {
				$this->collTrayectos = TrayectoPeer::doSelectJoinAgente($criteria, $con);
			}
		}
		$this->lastTrayectoCriteria = $criteria;

		return $this->collTrayectos;
	}

	/**
	 * Temporary storage of collPricCabotajes to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initPricCabotajes()
	{
		if ($this->collPricCabotajes === null) {
			$this->collPricCabotajes = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Transportador has previously
	 * been saved, it will retrieve related PricCabotajes from storage.
	 * If this Transportador is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getPricCabotajes($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricCabotajes === null) {
			if ($this->isNew()) {
			   $this->collPricCabotajes = array();
			} else {

				$criteria->add(PricCabotajePeer::CA_IDLINEA, $this->getCaIdlinea());

				PricCabotajePeer::addSelectColumns($criteria);
				$this->collPricCabotajes = PricCabotajePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PricCabotajePeer::CA_IDLINEA, $this->getCaIdlinea());

				PricCabotajePeer::addSelectColumns($criteria);
				if (!isset($this->lastPricCabotajeCriteria) || !$this->lastPricCabotajeCriteria->equals($criteria)) {
					$this->collPricCabotajes = PricCabotajePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPricCabotajeCriteria = $criteria;
		return $this->collPricCabotajes;
	}

	/**
	 * Returns the number of related PricCabotajes.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countPricCabotajes($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PricCabotajePeer::CA_IDLINEA, $this->getCaIdlinea());

		return PricCabotajePeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a PricCabotaje object to this object
	 * through the PricCabotaje foreign key attribute
	 *
	 * @param      PricCabotaje $l PricCabotaje
	 * @return     void
	 * @throws     PropelException
	 */
	public function addPricCabotaje(PricCabotaje $l)
	{
		$this->collPricCabotajes[] = $l;
		$l->setTransportador($this);
	}

	/**
	 * Temporary storage of collReportes to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initReportes()
	{
		if ($this->collReportes === null) {
			$this->collReportes = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Transportador has previously
	 * been saved, it will retrieve related Reportes from storage.
	 * If this Transportador is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getReportes($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
			   $this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDLINEA, $this->getCaIdlinea());

				ReportePeer::addSelectColumns($criteria);
				$this->collReportes = ReportePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ReportePeer::CA_IDLINEA, $this->getCaIdlinea());

				ReportePeer::addSelectColumns($criteria);
				if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
					$this->collReportes = ReportePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastReporteCriteria = $criteria;
		return $this->collReportes;
	}

	/**
	 * Returns the number of related Reportes.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countReportes($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ReportePeer::CA_IDLINEA, $this->getCaIdlinea());

		return ReportePeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Reporte object to this object
	 * through the Reporte foreign key attribute
	 *
	 * @param      Reporte $l Reporte
	 * @return     void
	 * @throws     PropelException
	 */
	public function addReporte(Reporte $l)
	{
		$this->collReportes[] = $l;
		$l->setTransportador($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Transportador is new, it will return
	 * an empty collection; or if this Transportador has previously
	 * been saved, it will retrieve related Reportes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Transportador.
	 */
	public function getReportesJoinUsuario($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDLINEA, $this->getCaIdlinea());

				$this->collReportes = ReportePeer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ReportePeer::CA_IDLINEA, $this->getCaIdlinea());

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinUsuario($criteria, $con);
			}
		}
		$this->lastReporteCriteria = $criteria;

		return $this->collReportes;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Transportador is new, it will return
	 * an empty collection; or if this Transportador has previously
	 * been saved, it will retrieve related Reportes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Transportador.
	 */
	public function getReportesJoinTercero($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDLINEA, $this->getCaIdlinea());

				$this->collReportes = ReportePeer::doSelectJoinTercero($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ReportePeer::CA_IDLINEA, $this->getCaIdlinea());

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinTercero($criteria, $con);
			}
		}
		$this->lastReporteCriteria = $criteria;

		return $this->collReportes;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Transportador is new, it will return
	 * an empty collection; or if this Transportador has previously
	 * been saved, it will retrieve related Reportes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Transportador.
	 */
	public function getReportesJoinAgente($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDLINEA, $this->getCaIdlinea());

				$this->collReportes = ReportePeer::doSelectJoinAgente($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ReportePeer::CA_IDLINEA, $this->getCaIdlinea());

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinAgente($criteria, $con);
			}
		}
		$this->lastReporteCriteria = $criteria;

		return $this->collReportes;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Transportador is new, it will return
	 * an empty collection; or if this Transportador has previously
	 * been saved, it will retrieve related Reportes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Transportador.
	 */
	public function getReportesJoinBodega($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDLINEA, $this->getCaIdlinea());

				$this->collReportes = ReportePeer::doSelectJoinBodega($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ReportePeer::CA_IDLINEA, $this->getCaIdlinea());

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinBodega($criteria, $con);
			}
		}
		$this->lastReporteCriteria = $criteria;

		return $this->collReportes;
	}

	/**
	 * Temporary storage of collInoMaestraSeas to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initInoMaestraSeas()
	{
		if ($this->collInoMaestraSeas === null) {
			$this->collInoMaestraSeas = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Transportador has previously
	 * been saved, it will retrieve related InoMaestraSeas from storage.
	 * If this Transportador is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getInoMaestraSeas($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoMaestraSeas === null) {
			if ($this->isNew()) {
			   $this->collInoMaestraSeas = array();
			} else {

				$criteria->add(InoMaestraSeaPeer::CA_IDLINEA, $this->getCaIdlinea());

				InoMaestraSeaPeer::addSelectColumns($criteria);
				$this->collInoMaestraSeas = InoMaestraSeaPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(InoMaestraSeaPeer::CA_IDLINEA, $this->getCaIdlinea());

				InoMaestraSeaPeer::addSelectColumns($criteria);
				if (!isset($this->lastInoMaestraSeaCriteria) || !$this->lastInoMaestraSeaCriteria->equals($criteria)) {
					$this->collInoMaestraSeas = InoMaestraSeaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInoMaestraSeaCriteria = $criteria;
		return $this->collInoMaestraSeas;
	}

	/**
	 * Returns the number of related InoMaestraSeas.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countInoMaestraSeas($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(InoMaestraSeaPeer::CA_IDLINEA, $this->getCaIdlinea());

		return InoMaestraSeaPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a InoMaestraSea object to this object
	 * through the InoMaestraSea foreign key attribute
	 *
	 * @param      InoMaestraSea $l InoMaestraSea
	 * @return     void
	 * @throws     PropelException
	 */
	public function addInoMaestraSea(InoMaestraSea $l)
	{
		$this->collInoMaestraSeas[] = $l;
		$l->setTransportador($this);
	}

} // BaseTransportador
