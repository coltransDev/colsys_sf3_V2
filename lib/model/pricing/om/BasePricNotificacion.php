<?php

/**
 * Base class that represents a row from the 'tb_pricnotificaciones' table.
 *
 * 
 *
 * @package    lib.model.pricing.om
 */
abstract class BasePricNotificacion extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        PricNotificacionPeer
	 */
	protected static $peer;


	/**
	 * The value for the ca_idnotificacion field.
	 * @var        int
	 */
	protected $ca_idnotificacion;


	/**
	 * The value for the ca_titulo field.
	 * @var        string
	 */
	protected $ca_titulo;


	/**
	 * The value for the ca_mensaje field.
	 * @var        string
	 */
	protected $ca_mensaje;


	/**
	 * The value for the ca_caducidad field.
	 * @var        int
	 */
	protected $ca_caducidad;


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
	 * Get the [ca_idnotificacion] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdnotificacion()
	{

		return $this->ca_idnotificacion;
	}

	/**
	 * Get the [ca_titulo] column value.
	 * 
	 * @return     string
	 */
	public function getCaTitulo()
	{

		return $this->ca_titulo;
	}

	/**
	 * Get the [ca_mensaje] column value.
	 * 
	 * @return     string
	 */
	public function getCaMensaje()
	{

		return $this->ca_mensaje;
	}

	/**
	 * Get the [optionally formatted] [ca_caducidad] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaCaducidad($format = 'Y-m-d')
	{

		if ($this->ca_caducidad === null || $this->ca_caducidad === '') {
			return null;
		} elseif (!is_int($this->ca_caducidad)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_caducidad);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_caducidad] as date/time value: " . var_export($this->ca_caducidad, true));
			}
		} else {
			$ts = $this->ca_caducidad;
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
	 * Set the value of [ca_idnotificacion] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdnotificacion($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idnotificacion !== $v) {
			$this->ca_idnotificacion = $v;
			$this->modifiedColumns[] = PricNotificacionPeer::CA_IDNOTIFICACION;
		}

	} // setCaIdnotificacion()

	/**
	 * Set the value of [ca_titulo] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaTitulo($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_titulo !== $v) {
			$this->ca_titulo = $v;
			$this->modifiedColumns[] = PricNotificacionPeer::CA_TITULO;
		}

	} // setCaTitulo()

	/**
	 * Set the value of [ca_mensaje] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaMensaje($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_mensaje !== $v) {
			$this->ca_mensaje = $v;
			$this->modifiedColumns[] = PricNotificacionPeer::CA_MENSAJE;
		}

	} // setCaMensaje()

	/**
	 * Set the value of [ca_caducidad] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaCaducidad($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_caducidad] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_caducidad !== $ts) {
			$this->ca_caducidad = $ts;
			$this->modifiedColumns[] = PricNotificacionPeer::CA_CADUCIDAD;
		}

	} // setCaCaducidad()

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
			$this->modifiedColumns[] = PricNotificacionPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = PricNotificacionPeer::CA_USUCREADO;
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

			$this->ca_idnotificacion = $rs->getInt($startcol + 0);

			$this->ca_titulo = $rs->getString($startcol + 1);

			$this->ca_mensaje = $rs->getString($startcol + 2);

			$this->ca_caducidad = $rs->getDate($startcol + 3, null);

			$this->ca_fchcreado = $rs->getTimestamp($startcol + 4, null);

			$this->ca_usucreado = $rs->getString($startcol + 5);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 6; // 6 = PricNotificacionPeer::NUM_COLUMNS - PricNotificacionPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating PricNotificacion object", $e);
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
			$con = Propel::getConnection(PricNotificacionPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PricNotificacionPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(PricNotificacionPeer::DATABASE_NAME);
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
					$pk = PricNotificacionPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setCaIdnotificacion($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += PricNotificacionPeer::doUpdate($this, $con);
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


			if (($retval = PricNotificacionPeer::doValidate($this, $columns)) !== true) {
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
		$pos = PricNotificacionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdnotificacion();
				break;
			case 1:
				return $this->getCaTitulo();
				break;
			case 2:
				return $this->getCaMensaje();
				break;
			case 3:
				return $this->getCaCaducidad();
				break;
			case 4:
				return $this->getCaFchcreado();
				break;
			case 5:
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
		$keys = PricNotificacionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdnotificacion(),
			$keys[1] => $this->getCaTitulo(),
			$keys[2] => $this->getCaMensaje(),
			$keys[3] => $this->getCaCaducidad(),
			$keys[4] => $this->getCaFchcreado(),
			$keys[5] => $this->getCaUsucreado(),
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
		$pos = PricNotificacionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdnotificacion($value);
				break;
			case 1:
				$this->setCaTitulo($value);
				break;
			case 2:
				$this->setCaMensaje($value);
				break;
			case 3:
				$this->setCaCaducidad($value);
				break;
			case 4:
				$this->setCaFchcreado($value);
				break;
			case 5:
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
		$keys = PricNotificacionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdnotificacion($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaTitulo($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaMensaje($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaCaducidad($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaFchcreado($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaUsucreado($arr[$keys[5]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(PricNotificacionPeer::DATABASE_NAME);

		if ($this->isColumnModified(PricNotificacionPeer::CA_IDNOTIFICACION)) $criteria->add(PricNotificacionPeer::CA_IDNOTIFICACION, $this->ca_idnotificacion);
		if ($this->isColumnModified(PricNotificacionPeer::CA_TITULO)) $criteria->add(PricNotificacionPeer::CA_TITULO, $this->ca_titulo);
		if ($this->isColumnModified(PricNotificacionPeer::CA_MENSAJE)) $criteria->add(PricNotificacionPeer::CA_MENSAJE, $this->ca_mensaje);
		if ($this->isColumnModified(PricNotificacionPeer::CA_CADUCIDAD)) $criteria->add(PricNotificacionPeer::CA_CADUCIDAD, $this->ca_caducidad);
		if ($this->isColumnModified(PricNotificacionPeer::CA_FCHCREADO)) $criteria->add(PricNotificacionPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(PricNotificacionPeer::CA_USUCREADO)) $criteria->add(PricNotificacionPeer::CA_USUCREADO, $this->ca_usucreado);

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
		$criteria = new Criteria(PricNotificacionPeer::DATABASE_NAME);

		$criteria->add(PricNotificacionPeer::CA_IDNOTIFICACION, $this->ca_idnotificacion);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdnotificacion();
	}

	/**
	 * Generic method to set the primary key (ca_idnotificacion column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdnotificacion($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of PricNotificacion (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaTitulo($this->ca_titulo);

		$copyObj->setCaMensaje($this->ca_mensaje);

		$copyObj->setCaCaducidad($this->ca_caducidad);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);


		$copyObj->setNew(true);

		$copyObj->setCaIdnotificacion(NULL); // this is a pkey column, so set to default value

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
	 * @return     PricNotificacion Clone of current object.
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
	 * @return     PricNotificacionPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new PricNotificacionPeer();
		}
		return self::$peer;
	}

} // BasePricNotificacion
