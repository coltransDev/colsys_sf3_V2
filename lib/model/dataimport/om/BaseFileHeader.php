<?php

/**
 * Base class that represents a row from the 'tb_fileheader' table.
 *
 * 
 *
 * @package    lib.model.dataimport.om
 */
abstract class BaseFileHeader extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        FileHeaderPeer
	 */
	protected static $peer;


	/**
	 * The value for the ca_idfileheader field.
	 * @var        int
	 */
	protected $ca_idfileheader;


	/**
	 * The value for the ca_descripcion field.
	 * @var        string
	 */
	protected $ca_descripcion;


	/**
	 * The value for the ca_tipoarchivo field.
	 * @var        string
	 */
	protected $ca_tipoarchivo;


	/**
	 * The value for the ca_separador field.
	 * @var        string
	 */
	protected $ca_separador;


	/**
	 * The value for the ca_separadordec field.
	 * @var        string
	 */
	protected $ca_separadordec;


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
	 * The value for the ca_fchactualizado field.
	 * @var        int
	 */
	protected $ca_fchactualizado;


	/**
	 * The value for the ca_usuactualizado field.
	 * @var        string
	 */
	protected $ca_usuactualizado;

	/**
	 * Collection to store aggregation of collFileImporteds.
	 * @var        array
	 */
	protected $collFileImporteds;

	/**
	 * The criteria used to select the current contents of collFileImporteds.
	 * @var        Criteria
	 */
	protected $lastFileImportedCriteria = null;

	/**
	 * Collection to store aggregation of collFileColumns.
	 * @var        array
	 */
	protected $collFileColumns;

	/**
	 * The criteria used to select the current contents of collFileColumns.
	 * @var        Criteria
	 */
	protected $lastFileColumnCriteria = null;

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
	 * Get the [ca_idfileheader] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdfileheader()
	{

		return $this->ca_idfileheader;
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
	 * Get the [ca_tipoarchivo] column value.
	 * 
	 * @return     string
	 */
	public function getCaTipoarchivo()
	{

		return $this->ca_tipoarchivo;
	}

	/**
	 * Get the [ca_separador] column value.
	 * 
	 * @return     string
	 */
	public function getCaSeparador()
	{

		return $this->ca_separador;
	}

	/**
	 * Get the [ca_separadordec] column value.
	 * 
	 * @return     string
	 */
	public function getCaSeparadordec()
	{

		return $this->ca_separadordec;
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
	 * Get the [optionally formatted] [ca_fchactualizado] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchactualizado($format = 'Y-m-d H:i:s')
	{

		if ($this->ca_fchactualizado === null || $this->ca_fchactualizado === '') {
			return null;
		} elseif (!is_int($this->ca_fchactualizado)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_fchactualizado);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_fchactualizado] as date/time value: " . var_export($this->ca_fchactualizado, true));
			}
		} else {
			$ts = $this->ca_fchactualizado;
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
	 * Get the [ca_usuactualizado] column value.
	 * 
	 * @return     string
	 */
	public function getCaUsuactualizado()
	{

		return $this->ca_usuactualizado;
	}

	/**
	 * Set the value of [ca_idfileheader] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdfileheader($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idfileheader !== $v) {
			$this->ca_idfileheader = $v;
			$this->modifiedColumns[] = FileHeaderPeer::CA_IDFILEHEADER;
		}

	} // setCaIdfileheader()

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
			$this->modifiedColumns[] = FileHeaderPeer::CA_DESCRIPCION;
		}

	} // setCaDescripcion()

	/**
	 * Set the value of [ca_tipoarchivo] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaTipoarchivo($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_tipoarchivo !== $v) {
			$this->ca_tipoarchivo = $v;
			$this->modifiedColumns[] = FileHeaderPeer::CA_TIPOARCHIVO;
		}

	} // setCaTipoarchivo()

	/**
	 * Set the value of [ca_separador] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaSeparador($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_separador !== $v) {
			$this->ca_separador = $v;
			$this->modifiedColumns[] = FileHeaderPeer::CA_SEPARADOR;
		}

	} // setCaSeparador()

	/**
	 * Set the value of [ca_separadordec] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaSeparadordec($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_separadordec !== $v) {
			$this->ca_separadordec = $v;
			$this->modifiedColumns[] = FileHeaderPeer::CA_SEPARADORDEC;
		}

	} // setCaSeparadordec()

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
			$this->modifiedColumns[] = FileHeaderPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = FileHeaderPeer::CA_USUCREADO;
		}

	} // setCaUsucreado()

	/**
	 * Set the value of [ca_fchactualizado] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaFchactualizado($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_fchactualizado] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_fchactualizado !== $ts) {
			$this->ca_fchactualizado = $ts;
			$this->modifiedColumns[] = FileHeaderPeer::CA_FCHACTUALIZADO;
		}

	} // setCaFchactualizado()

	/**
	 * Set the value of [ca_usuactualizado] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaUsuactualizado($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_usuactualizado !== $v) {
			$this->ca_usuactualizado = $v;
			$this->modifiedColumns[] = FileHeaderPeer::CA_USUACTUALIZADO;
		}

	} // setCaUsuactualizado()

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

			$this->ca_idfileheader = $rs->getInt($startcol + 0);

			$this->ca_descripcion = $rs->getString($startcol + 1);

			$this->ca_tipoarchivo = $rs->getString($startcol + 2);

			$this->ca_separador = $rs->getString($startcol + 3);

			$this->ca_separadordec = $rs->getString($startcol + 4);

			$this->ca_fchcreado = $rs->getTimestamp($startcol + 5, null);

			$this->ca_usucreado = $rs->getString($startcol + 6);

			$this->ca_fchactualizado = $rs->getTimestamp($startcol + 7, null);

			$this->ca_usuactualizado = $rs->getString($startcol + 8);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 9; // 9 = FileHeaderPeer::NUM_COLUMNS - FileHeaderPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating FileHeader object", $e);
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
			$con = Propel::getConnection(FileHeaderPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			FileHeaderPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(FileHeaderPeer::DATABASE_NAME);
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
					$pk = FileHeaderPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setCaIdfileheader($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += FileHeaderPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collFileImporteds !== null) {
				foreach($this->collFileImporteds as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collFileColumns !== null) {
				foreach($this->collFileColumns as $referrerFK) {
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


			if (($retval = FileHeaderPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collFileImporteds !== null) {
					foreach($this->collFileImporteds as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collFileColumns !== null) {
					foreach($this->collFileColumns as $referrerFK) {
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
		$pos = FileHeaderPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdfileheader();
				break;
			case 1:
				return $this->getCaDescripcion();
				break;
			case 2:
				return $this->getCaTipoarchivo();
				break;
			case 3:
				return $this->getCaSeparador();
				break;
			case 4:
				return $this->getCaSeparadordec();
				break;
			case 5:
				return $this->getCaFchcreado();
				break;
			case 6:
				return $this->getCaUsucreado();
				break;
			case 7:
				return $this->getCaFchactualizado();
				break;
			case 8:
				return $this->getCaUsuactualizado();
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
		$keys = FileHeaderPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdfileheader(),
			$keys[1] => $this->getCaDescripcion(),
			$keys[2] => $this->getCaTipoarchivo(),
			$keys[3] => $this->getCaSeparador(),
			$keys[4] => $this->getCaSeparadordec(),
			$keys[5] => $this->getCaFchcreado(),
			$keys[6] => $this->getCaUsucreado(),
			$keys[7] => $this->getCaFchactualizado(),
			$keys[8] => $this->getCaUsuactualizado(),
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
		$pos = FileHeaderPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdfileheader($value);
				break;
			case 1:
				$this->setCaDescripcion($value);
				break;
			case 2:
				$this->setCaTipoarchivo($value);
				break;
			case 3:
				$this->setCaSeparador($value);
				break;
			case 4:
				$this->setCaSeparadordec($value);
				break;
			case 5:
				$this->setCaFchcreado($value);
				break;
			case 6:
				$this->setCaUsucreado($value);
				break;
			case 7:
				$this->setCaFchactualizado($value);
				break;
			case 8:
				$this->setCaUsuactualizado($value);
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
		$keys = FileHeaderPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdfileheader($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaDescripcion($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaTipoarchivo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaSeparador($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaSeparadordec($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaFchcreado($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaUsucreado($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaFchactualizado($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaUsuactualizado($arr[$keys[8]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(FileHeaderPeer::DATABASE_NAME);

		if ($this->isColumnModified(FileHeaderPeer::CA_IDFILEHEADER)) $criteria->add(FileHeaderPeer::CA_IDFILEHEADER, $this->ca_idfileheader);
		if ($this->isColumnModified(FileHeaderPeer::CA_DESCRIPCION)) $criteria->add(FileHeaderPeer::CA_DESCRIPCION, $this->ca_descripcion);
		if ($this->isColumnModified(FileHeaderPeer::CA_TIPOARCHIVO)) $criteria->add(FileHeaderPeer::CA_TIPOARCHIVO, $this->ca_tipoarchivo);
		if ($this->isColumnModified(FileHeaderPeer::CA_SEPARADOR)) $criteria->add(FileHeaderPeer::CA_SEPARADOR, $this->ca_separador);
		if ($this->isColumnModified(FileHeaderPeer::CA_SEPARADORDEC)) $criteria->add(FileHeaderPeer::CA_SEPARADORDEC, $this->ca_separadordec);
		if ($this->isColumnModified(FileHeaderPeer::CA_FCHCREADO)) $criteria->add(FileHeaderPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(FileHeaderPeer::CA_USUCREADO)) $criteria->add(FileHeaderPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(FileHeaderPeer::CA_FCHACTUALIZADO)) $criteria->add(FileHeaderPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(FileHeaderPeer::CA_USUACTUALIZADO)) $criteria->add(FileHeaderPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);

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
		$criteria = new Criteria(FileHeaderPeer::DATABASE_NAME);

		$criteria->add(FileHeaderPeer::CA_IDFILEHEADER, $this->ca_idfileheader);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdfileheader();
	}

	/**
	 * Generic method to set the primary key (ca_idfileheader column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdfileheader($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of FileHeader (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaDescripcion($this->ca_descripcion);

		$copyObj->setCaTipoarchivo($this->ca_tipoarchivo);

		$copyObj->setCaSeparador($this->ca_separador);

		$copyObj->setCaSeparadordec($this->ca_separadordec);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getFileImporteds() as $relObj) {
				$copyObj->addFileImported($relObj->copy($deepCopy));
			}

			foreach($this->getFileColumns() as $relObj) {
				$copyObj->addFileColumn($relObj->copy($deepCopy));
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setCaIdfileheader(NULL); // this is a pkey column, so set to default value

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
	 * @return     FileHeader Clone of current object.
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
	 * @return     FileHeaderPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new FileHeaderPeer();
		}
		return self::$peer;
	}

	/**
	 * Temporary storage of collFileImporteds to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initFileImporteds()
	{
		if ($this->collFileImporteds === null) {
			$this->collFileImporteds = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this FileHeader has previously
	 * been saved, it will retrieve related FileImporteds from storage.
	 * If this FileHeader is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getFileImporteds($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFileImporteds === null) {
			if ($this->isNew()) {
			   $this->collFileImporteds = array();
			} else {

				$criteria->add(FileImportedPeer::CA_IDFILEHEADER, $this->getCaIdfileheader());

				FileImportedPeer::addSelectColumns($criteria);
				$this->collFileImporteds = FileImportedPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(FileImportedPeer::CA_IDFILEHEADER, $this->getCaIdfileheader());

				FileImportedPeer::addSelectColumns($criteria);
				if (!isset($this->lastFileImportedCriteria) || !$this->lastFileImportedCriteria->equals($criteria)) {
					$this->collFileImporteds = FileImportedPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFileImportedCriteria = $criteria;
		return $this->collFileImporteds;
	}

	/**
	 * Returns the number of related FileImporteds.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countFileImporteds($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(FileImportedPeer::CA_IDFILEHEADER, $this->getCaIdfileheader());

		return FileImportedPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a FileImported object to this object
	 * through the FileImported foreign key attribute
	 *
	 * @param      FileImported $l FileImported
	 * @return     void
	 * @throws     PropelException
	 */
	public function addFileImported(FileImported $l)
	{
		$this->collFileImporteds[] = $l;
		$l->setFileHeader($this);
	}

	/**
	 * Temporary storage of collFileColumns to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initFileColumns()
	{
		if ($this->collFileColumns === null) {
			$this->collFileColumns = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this FileHeader has previously
	 * been saved, it will retrieve related FileColumns from storage.
	 * If this FileHeader is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getFileColumns($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFileColumns === null) {
			if ($this->isNew()) {
			   $this->collFileColumns = array();
			} else {

				$criteria->add(FileColumnPeer::CA_IDFILEHEADER, $this->getCaIdfileheader());

				FileColumnPeer::addSelectColumns($criteria);
				$this->collFileColumns = FileColumnPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(FileColumnPeer::CA_IDFILEHEADER, $this->getCaIdfileheader());

				FileColumnPeer::addSelectColumns($criteria);
				if (!isset($this->lastFileColumnCriteria) || !$this->lastFileColumnCriteria->equals($criteria)) {
					$this->collFileColumns = FileColumnPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFileColumnCriteria = $criteria;
		return $this->collFileColumns;
	}

	/**
	 * Returns the number of related FileColumns.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countFileColumns($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(FileColumnPeer::CA_IDFILEHEADER, $this->getCaIdfileheader());

		return FileColumnPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a FileColumn object to this object
	 * through the FileColumn foreign key attribute
	 *
	 * @param      FileColumn $l FileColumn
	 * @return     void
	 * @throws     PropelException
	 */
	public function addFileColumn(FileColumn $l)
	{
		$this->collFileColumns[] = $l;
		$l->setFileHeader($this);
	}

} // BaseFileHeader
