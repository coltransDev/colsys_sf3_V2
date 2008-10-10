<?php

/**
 * Base class that represents a row from the 'tb_pricarchivos' table.
 *
 * 
 *
 * @package    lib.model.pricing.om
 */
abstract class BasePricArchivos extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        PricArchivosPeer
	 */
	protected static $peer;


	/**
	 * The value for the ca_idarchivo field.
	 * @var        string
	 */
	protected $ca_idarchivo;


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
	 * The value for the ca_descripcion field.
	 * @var        string
	 */
	protected $ca_descripcion;


	/**
	 * The value for the ca_tamano field.
	 * @var        double
	 */
	protected $ca_tamano;


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
	 * The value for the ca_datos field.
	 * @var        string
	 */
	protected $ca_datos;

	/**
	 * @var        Trafico
	 */
	protected $aTrafico;

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
	 * Get the [ca_idarchivo] column value.
	 * 
	 * @return     string
	 */
	public function getCaIdarchivo()
	{

		return $this->ca_idarchivo;
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
	 * Get the [ca_nombre] column value.
	 * 
	 * @return     string
	 */
	public function getCaNombre()
	{

		return $this->ca_nombre;
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
	 * Get the [ca_tamano] column value.
	 * 
	 * @return     double
	 */
	public function getCaTamano()
	{

		return $this->ca_tamano;
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
	 * Get the [ca_datos] column value.
	 * 
	 * @return     string
	 */
	public function getCaDatos()
	{

		return $this->ca_datos;
	}

	/**
	 * Set the value of [ca_idarchivo] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaIdarchivo($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_idarchivo !== $v) {
			$this->ca_idarchivo = $v;
			$this->modifiedColumns[] = PricArchivosPeer::CA_IDARCHIVO;
		}

	} // setCaIdarchivo()

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
			$this->modifiedColumns[] = PricArchivosPeer::CA_IDTRAFICO;
		}

		if ($this->aTrafico !== null && $this->aTrafico->getCaIdtrafico() !== $v) {
			$this->aTrafico = null;
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
			$this->modifiedColumns[] = PricArchivosPeer::CA_NOMBRE;
		}

	} // setCaNombre()

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
			$this->modifiedColumns[] = PricArchivosPeer::CA_DESCRIPCION;
		}

	} // setCaDescripcion()

	/**
	 * Set the value of [ca_tamano] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaTamano($v)
	{

		if ($this->ca_tamano !== $v) {
			$this->ca_tamano = $v;
			$this->modifiedColumns[] = PricArchivosPeer::CA_TAMANO;
		}

	} // setCaTamano()

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
			$this->modifiedColumns[] = PricArchivosPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = PricArchivosPeer::CA_USUCREADO;
		}

	} // setCaUsucreado()

	/**
	 * Set the value of [ca_datos] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaDatos($v)
	{

		// if the passed in parameter is the *same* object that
		// is stored internally then we use the Lob->isModified()
		// method to know whether contents changed.
		if ($v instanceof Lob && $v === $this->ca_datos) {
			$changed = $v->isModified();
		} else {
			$changed = ($this->ca_datos !== $v);
		}
		if ($changed) {
			if ( !($v instanceof Lob) ) {
				$obj = new Blob();
				$obj->setContents($v);
			} else {
				$obj = $v;
			}
			$this->ca_datos = $obj;
			$this->modifiedColumns[] = PricArchivosPeer::CA_DATOS;
		}

	} // setCaDatos()

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

			$this->ca_idarchivo = $rs->getString($startcol + 0);

			$this->ca_idtrafico = $rs->getString($startcol + 1);

			$this->ca_nombre = $rs->getString($startcol + 2);

			$this->ca_descripcion = $rs->getString($startcol + 3);

			$this->ca_tamano = $rs->getFloat($startcol + 4);

			$this->ca_fchcreado = $rs->getTimestamp($startcol + 5, null);

			$this->ca_usucreado = $rs->getString($startcol + 6);

			$this->ca_datos = $rs->getBlob($startcol + 7);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 8; // 8 = PricArchivosPeer::NUM_COLUMNS - PricArchivosPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating PricArchivos object", $e);
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
			$con = Propel::getConnection(PricArchivosPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PricArchivosPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(PricArchivosPeer::DATABASE_NAME);
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
					$pk = PricArchivosPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setCaIdarchivo($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += PricArchivosPeer::doUpdate($this, $con);
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

			if ($this->aTrafico !== null) {
				if (!$this->aTrafico->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTrafico->getValidationFailures());
				}
			}


			if (($retval = PricArchivosPeer::doValidate($this, $columns)) !== true) {
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
		$pos = PricArchivosPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdarchivo();
				break;
			case 1:
				return $this->getCaIdtrafico();
				break;
			case 2:
				return $this->getCaNombre();
				break;
			case 3:
				return $this->getCaDescripcion();
				break;
			case 4:
				return $this->getCaTamano();
				break;
			case 5:
				return $this->getCaFchcreado();
				break;
			case 6:
				return $this->getCaUsucreado();
				break;
			case 7:
				return $this->getCaDatos();
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
		$keys = PricArchivosPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdarchivo(),
			$keys[1] => $this->getCaIdtrafico(),
			$keys[2] => $this->getCaNombre(),
			$keys[3] => $this->getCaDescripcion(),
			$keys[4] => $this->getCaTamano(),
			$keys[5] => $this->getCaFchcreado(),
			$keys[6] => $this->getCaUsucreado(),
			$keys[7] => $this->getCaDatos(),
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
		$pos = PricArchivosPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdarchivo($value);
				break;
			case 1:
				$this->setCaIdtrafico($value);
				break;
			case 2:
				$this->setCaNombre($value);
				break;
			case 3:
				$this->setCaDescripcion($value);
				break;
			case 4:
				$this->setCaTamano($value);
				break;
			case 5:
				$this->setCaFchcreado($value);
				break;
			case 6:
				$this->setCaUsucreado($value);
				break;
			case 7:
				$this->setCaDatos($value);
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
		$keys = PricArchivosPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdarchivo($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdtrafico($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaNombre($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaDescripcion($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaTamano($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaFchcreado($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaUsucreado($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaDatos($arr[$keys[7]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(PricArchivosPeer::DATABASE_NAME);

		if ($this->isColumnModified(PricArchivosPeer::CA_IDARCHIVO)) $criteria->add(PricArchivosPeer::CA_IDARCHIVO, $this->ca_idarchivo);
		if ($this->isColumnModified(PricArchivosPeer::CA_IDTRAFICO)) $criteria->add(PricArchivosPeer::CA_IDTRAFICO, $this->ca_idtrafico);
		if ($this->isColumnModified(PricArchivosPeer::CA_NOMBRE)) $criteria->add(PricArchivosPeer::CA_NOMBRE, $this->ca_nombre);
		if ($this->isColumnModified(PricArchivosPeer::CA_DESCRIPCION)) $criteria->add(PricArchivosPeer::CA_DESCRIPCION, $this->ca_descripcion);
		if ($this->isColumnModified(PricArchivosPeer::CA_TAMANO)) $criteria->add(PricArchivosPeer::CA_TAMANO, $this->ca_tamano);
		if ($this->isColumnModified(PricArchivosPeer::CA_FCHCREADO)) $criteria->add(PricArchivosPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(PricArchivosPeer::CA_USUCREADO)) $criteria->add(PricArchivosPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(PricArchivosPeer::CA_DATOS)) $criteria->add(PricArchivosPeer::CA_DATOS, $this->ca_datos);

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
		$criteria = new Criteria(PricArchivosPeer::DATABASE_NAME);

		$criteria->add(PricArchivosPeer::CA_IDARCHIVO, $this->ca_idarchivo);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     string
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdarchivo();
	}

	/**
	 * Generic method to set the primary key (ca_idarchivo column).
	 *
	 * @param      string $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdarchivo($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of PricArchivos (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdtrafico($this->ca_idtrafico);

		$copyObj->setCaNombre($this->ca_nombre);

		$copyObj->setCaDescripcion($this->ca_descripcion);

		$copyObj->setCaTamano($this->ca_tamano);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaDatos($this->ca_datos);


		$copyObj->setNew(true);

		$copyObj->setCaIdarchivo(NULL); // this is a pkey column, so set to default value

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
	 * @return     PricArchivos Clone of current object.
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
	 * @return     PricArchivosPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new PricArchivosPeer();
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

} // BasePricArchivos
