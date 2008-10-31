<?php

/**
 * Base class that represents a row from the 'control.tb_rutinas' table.
 *
 * 
 *
 * @package    lib.model.control.om
 */
abstract class BaseRutina extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        RutinaPeer
	 */
	protected static $peer;


	/**
	 * The value for the ca_rutina field.
	 * @var        int
	 */
	protected $ca_rutina;


	/**
	 * The value for the ca_opcion field.
	 * @var        string
	 */
	protected $ca_opcion;


	/**
	 * The value for the ca_descripcion field.
	 * @var        string
	 */
	protected $ca_descripcion;


	/**
	 * The value for the ca_programa field.
	 * @var        string
	 */
	protected $ca_programa;


	/**
	 * The value for the ca_grupo field.
	 * @var        string
	 */
	protected $ca_grupo;

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
	 * Get the [ca_rutina] column value.
	 * 
	 * @return     int
	 */
	public function getCaRutina()
	{

		return $this->ca_rutina;
	}

	/**
	 * Get the [ca_opcion] column value.
	 * 
	 * @return     string
	 */
	public function getCaOpcion()
	{

		return $this->ca_opcion;
	}

	/**
	 * Get the [ca_descripcion] column value.
	 * 
	 * @return     string
	 */
	public function getCaDescripcion()
	{

		return $this->ca_descripcion;
	}

	/**
	 * Get the [ca_programa] column value.
	 * 
	 * @return     string
	 */
	public function getCaPrograma()
	{

		return $this->ca_programa;
	}

	/**
	 * Get the [ca_grupo] column value.
	 * 
	 * @return     string
	 */
	public function getCaGrupo()
	{

		return $this->ca_grupo;
	}

	/**
	 * Set the value of [ca_rutina] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaRutina($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_rutina !== $v) {
			$this->ca_rutina = $v;
			$this->modifiedColumns[] = RutinaPeer::CA_RUTINA;
		}

	} // setCaRutina()

	/**
	 * Set the value of [ca_opcion] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaOpcion($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_opcion !== $v) {
			$this->ca_opcion = $v;
			$this->modifiedColumns[] = RutinaPeer::CA_OPCION;
		}

	} // setCaOpcion()

	/**
	 * Set the value of [ca_descripcion] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaDescripcion($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_descripcion !== $v) {
			$this->ca_descripcion = $v;
			$this->modifiedColumns[] = RutinaPeer::CA_DESCRIPCION;
		}

	} // setCaDescripcion()

	/**
	 * Set the value of [ca_programa] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaPrograma($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_programa !== $v) {
			$this->ca_programa = $v;
			$this->modifiedColumns[] = RutinaPeer::CA_PROGRAMA;
		}

	} // setCaPrograma()

	/**
	 * Set the value of [ca_grupo] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaGrupo($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_grupo !== $v) {
			$this->ca_grupo = $v;
			$this->modifiedColumns[] = RutinaPeer::CA_GRUPO;
		}

	} // setCaGrupo()

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

			$this->ca_rutina = $rs->getInt($startcol + 0);

			$this->ca_opcion = $rs->getString($startcol + 1);

			$this->ca_descripcion = $rs->getString($startcol + 2);

			$this->ca_programa = $rs->getString($startcol + 3);

			$this->ca_grupo = $rs->getString($startcol + 4);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 5; // 5 = RutinaPeer::NUM_COLUMNS - RutinaPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Rutina object", $e);
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
			$con = Propel::getConnection(RutinaPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			RutinaPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(RutinaPeer::DATABASE_NAME);
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
					$pk = RutinaPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += RutinaPeer::doUpdate($this, $con);
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


			if (($retval = RutinaPeer::doValidate($this, $columns)) !== true) {
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
		$pos = RutinaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaRutina();
				break;
			case 1:
				return $this->getCaOpcion();
				break;
			case 2:
				return $this->getCaDescripcion();
				break;
			case 3:
				return $this->getCaPrograma();
				break;
			case 4:
				return $this->getCaGrupo();
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
		$keys = RutinaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaRutina(),
			$keys[1] => $this->getCaOpcion(),
			$keys[2] => $this->getCaDescripcion(),
			$keys[3] => $this->getCaPrograma(),
			$keys[4] => $this->getCaGrupo(),
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
		$pos = RutinaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaRutina($value);
				break;
			case 1:
				$this->setCaOpcion($value);
				break;
			case 2:
				$this->setCaDescripcion($value);
				break;
			case 3:
				$this->setCaPrograma($value);
				break;
			case 4:
				$this->setCaGrupo($value);
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
		$keys = RutinaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaRutina($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaOpcion($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaDescripcion($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaPrograma($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaGrupo($arr[$keys[4]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(RutinaPeer::DATABASE_NAME);

		if ($this->isColumnModified(RutinaPeer::CA_RUTINA)) $criteria->add(RutinaPeer::CA_RUTINA, $this->ca_rutina);
		if ($this->isColumnModified(RutinaPeer::CA_OPCION)) $criteria->add(RutinaPeer::CA_OPCION, $this->ca_opcion);
		if ($this->isColumnModified(RutinaPeer::CA_DESCRIPCION)) $criteria->add(RutinaPeer::CA_DESCRIPCION, $this->ca_descripcion);
		if ($this->isColumnModified(RutinaPeer::CA_PROGRAMA)) $criteria->add(RutinaPeer::CA_PROGRAMA, $this->ca_programa);
		if ($this->isColumnModified(RutinaPeer::CA_GRUPO)) $criteria->add(RutinaPeer::CA_GRUPO, $this->ca_grupo);

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
		$criteria = new Criteria(RutinaPeer::DATABASE_NAME);

		$criteria->add(RutinaPeer::CA_RUTINA, $this->ca_rutina);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCaRutina();
	}

	/**
	 * Generic method to set the primary key (ca_rutina column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaRutina($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Rutina (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaOpcion($this->ca_opcion);

		$copyObj->setCaDescripcion($this->ca_descripcion);

		$copyObj->setCaPrograma($this->ca_programa);

		$copyObj->setCaGrupo($this->ca_grupo);


		$copyObj->setNew(true);

		$copyObj->setCaRutina(NULL); // this is a pkey column, so set to default value

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
	 * @return     Rutina Clone of current object.
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
	 * @return     RutinaPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new RutinaPeer();
		}
		return self::$peer;
	}

} // BaseRutina
