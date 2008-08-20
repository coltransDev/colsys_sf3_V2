<?php

/**
 * Base class that represents a row from the 'tb_filecolumns' table.
 *
 * 
 *
 * @package    lib.model.dataimport.om
 */
abstract class BaseFileColumn extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        FileColumnPeer
	 */
	protected static $peer;


	/**
	 * The value for the ca_idfileheader field.
	 * @var        int
	 */
	protected $ca_idfileheader;


	/**
	 * The value for the ca_idcolumna field.
	 * @var        int
	 */
	protected $ca_idcolumna;


	/**
	 * The value for the ca_columna field.
	 * @var        string
	 */
	protected $ca_columna;


	/**
	 * The value for the ca_label field.
	 * @var        string
	 */
	protected $ca_label;


	/**
	 * The value for the ca_mascara field.
	 * @var        string
	 */
	protected $ca_mascara;


	/**
	 * The value for the ca_tipo field.
	 * @var        string
	 */
	protected $ca_tipo;


	/**
	 * The value for the ca_longitud field.
	 * @var        int
	 */
	protected $ca_longitud;


	/**
	 * The value for the ca_precision field.
	 * @var        int
	 */
	protected $ca_precision;


	/**
	 * The value for the ca_idregistro field.
	 * @var        int
	 */
	protected $ca_idregistro;


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
	 * @var        FileHeader
	 */
	protected $aFileHeader;

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
	 * Get the [ca_idcolumna] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdcolumna()
	{

		return $this->ca_idcolumna;
	}

	/**
	 * Get the [ca_columna] column value.
	 * 
	 * @return     string
	 */
	public function getCaColumna()
	{

		return $this->ca_columna;
	}

	/**
	 * Get the [ca_label] column value.
	 * 
	 * @return     string
	 */
	public function getCaLabel()
	{

		return $this->ca_label;
	}

	/**
	 * Get the [ca_mascara] column value.
	 * 
	 * @return     string
	 */
	public function getCaMascara()
	{

		return $this->ca_mascara;
	}

	/**
	 * Get the [ca_tipo] column value.
	 * 
	 * @return     string
	 */
	public function getCaTipo()
	{

		return $this->ca_tipo;
	}

	/**
	 * Get the [ca_longitud] column value.
	 * 
	 * @return     int
	 */
	public function getCaLongitud()
	{

		return $this->ca_longitud;
	}

	/**
	 * Get the [ca_precision] column value.
	 * 
	 * @return     int
	 */
	public function getCaPrecision()
	{

		return $this->ca_precision;
	}

	/**
	 * Get the [ca_idregistro] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdregistro()
	{

		return $this->ca_idregistro;
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
			$this->modifiedColumns[] = FileColumnPeer::CA_IDFILEHEADER;
		}

		if ($this->aFileHeader !== null && $this->aFileHeader->getCaIdfileheader() !== $v) {
			$this->aFileHeader = null;
		}

	} // setCaIdfileheader()

	/**
	 * Set the value of [ca_idcolumna] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdcolumna($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idcolumna !== $v) {
			$this->ca_idcolumna = $v;
			$this->modifiedColumns[] = FileColumnPeer::CA_IDCOLUMNA;
		}

	} // setCaIdcolumna()

	/**
	 * Set the value of [ca_columna] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaColumna($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_columna !== $v) {
			$this->ca_columna = $v;
			$this->modifiedColumns[] = FileColumnPeer::CA_COLUMNA;
		}

	} // setCaColumna()

	/**
	 * Set the value of [ca_label] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaLabel($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_label !== $v) {
			$this->ca_label = $v;
			$this->modifiedColumns[] = FileColumnPeer::CA_LABEL;
		}

	} // setCaLabel()

	/**
	 * Set the value of [ca_mascara] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaMascara($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_mascara !== $v) {
			$this->ca_mascara = $v;
			$this->modifiedColumns[] = FileColumnPeer::CA_MASCARA;
		}

	} // setCaMascara()

	/**
	 * Set the value of [ca_tipo] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaTipo($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_tipo !== $v) {
			$this->ca_tipo = $v;
			$this->modifiedColumns[] = FileColumnPeer::CA_TIPO;
		}

	} // setCaTipo()

	/**
	 * Set the value of [ca_longitud] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaLongitud($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_longitud !== $v) {
			$this->ca_longitud = $v;
			$this->modifiedColumns[] = FileColumnPeer::CA_LONGITUD;
		}

	} // setCaLongitud()

	/**
	 * Set the value of [ca_precision] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaPrecision($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_precision !== $v) {
			$this->ca_precision = $v;
			$this->modifiedColumns[] = FileColumnPeer::CA_PRECISION;
		}

	} // setCaPrecision()

	/**
	 * Set the value of [ca_idregistro] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdregistro($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idregistro !== $v) {
			$this->ca_idregistro = $v;
			$this->modifiedColumns[] = FileColumnPeer::CA_IDREGISTRO;
		}

	} // setCaIdregistro()

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
			$this->modifiedColumns[] = FileColumnPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = FileColumnPeer::CA_USUCREADO;
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
			$this->modifiedColumns[] = FileColumnPeer::CA_FCHACTUALIZADO;
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
			$this->modifiedColumns[] = FileColumnPeer::CA_USUACTUALIZADO;
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

			$this->ca_idcolumna = $rs->getInt($startcol + 1);

			$this->ca_columna = $rs->getString($startcol + 2);

			$this->ca_label = $rs->getString($startcol + 3);

			$this->ca_mascara = $rs->getString($startcol + 4);

			$this->ca_tipo = $rs->getString($startcol + 5);

			$this->ca_longitud = $rs->getInt($startcol + 6);

			$this->ca_precision = $rs->getInt($startcol + 7);

			$this->ca_idregistro = $rs->getInt($startcol + 8);

			$this->ca_fchcreado = $rs->getTimestamp($startcol + 9, null);

			$this->ca_usucreado = $rs->getString($startcol + 10);

			$this->ca_fchactualizado = $rs->getTimestamp($startcol + 11, null);

			$this->ca_usuactualizado = $rs->getString($startcol + 12);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 13; // 13 = FileColumnPeer::NUM_COLUMNS - FileColumnPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating FileColumn object", $e);
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
			$con = Propel::getConnection(FileColumnPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			FileColumnPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(FileColumnPeer::DATABASE_NAME);
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

			if ($this->aFileHeader !== null) {
				if ($this->aFileHeader->isModified()) {
					$affectedRows += $this->aFileHeader->save($con);
				}
				$this->setFileHeader($this->aFileHeader);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = FileColumnPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setCaIdcolumna($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += FileColumnPeer::doUpdate($this, $con);
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

			if ($this->aFileHeader !== null) {
				if (!$this->aFileHeader->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aFileHeader->getValidationFailures());
				}
			}


			if (($retval = FileColumnPeer::doValidate($this, $columns)) !== true) {
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
		$pos = FileColumnPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdcolumna();
				break;
			case 2:
				return $this->getCaColumna();
				break;
			case 3:
				return $this->getCaLabel();
				break;
			case 4:
				return $this->getCaMascara();
				break;
			case 5:
				return $this->getCaTipo();
				break;
			case 6:
				return $this->getCaLongitud();
				break;
			case 7:
				return $this->getCaPrecision();
				break;
			case 8:
				return $this->getCaIdregistro();
				break;
			case 9:
				return $this->getCaFchcreado();
				break;
			case 10:
				return $this->getCaUsucreado();
				break;
			case 11:
				return $this->getCaFchactualizado();
				break;
			case 12:
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
		$keys = FileColumnPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdfileheader(),
			$keys[1] => $this->getCaIdcolumna(),
			$keys[2] => $this->getCaColumna(),
			$keys[3] => $this->getCaLabel(),
			$keys[4] => $this->getCaMascara(),
			$keys[5] => $this->getCaTipo(),
			$keys[6] => $this->getCaLongitud(),
			$keys[7] => $this->getCaPrecision(),
			$keys[8] => $this->getCaIdregistro(),
			$keys[9] => $this->getCaFchcreado(),
			$keys[10] => $this->getCaUsucreado(),
			$keys[11] => $this->getCaFchactualizado(),
			$keys[12] => $this->getCaUsuactualizado(),
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
		$pos = FileColumnPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdcolumna($value);
				break;
			case 2:
				$this->setCaColumna($value);
				break;
			case 3:
				$this->setCaLabel($value);
				break;
			case 4:
				$this->setCaMascara($value);
				break;
			case 5:
				$this->setCaTipo($value);
				break;
			case 6:
				$this->setCaLongitud($value);
				break;
			case 7:
				$this->setCaPrecision($value);
				break;
			case 8:
				$this->setCaIdregistro($value);
				break;
			case 9:
				$this->setCaFchcreado($value);
				break;
			case 10:
				$this->setCaUsucreado($value);
				break;
			case 11:
				$this->setCaFchactualizado($value);
				break;
			case 12:
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
		$keys = FileColumnPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdfileheader($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdcolumna($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaColumna($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaLabel($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaMascara($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaTipo($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaLongitud($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaPrecision($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaIdregistro($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaFchcreado($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaUsucreado($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaFchactualizado($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaUsuactualizado($arr[$keys[12]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(FileColumnPeer::DATABASE_NAME);

		if ($this->isColumnModified(FileColumnPeer::CA_IDFILEHEADER)) $criteria->add(FileColumnPeer::CA_IDFILEHEADER, $this->ca_idfileheader);
		if ($this->isColumnModified(FileColumnPeer::CA_IDCOLUMNA)) $criteria->add(FileColumnPeer::CA_IDCOLUMNA, $this->ca_idcolumna);
		if ($this->isColumnModified(FileColumnPeer::CA_COLUMNA)) $criteria->add(FileColumnPeer::CA_COLUMNA, $this->ca_columna);
		if ($this->isColumnModified(FileColumnPeer::CA_LABEL)) $criteria->add(FileColumnPeer::CA_LABEL, $this->ca_label);
		if ($this->isColumnModified(FileColumnPeer::CA_MASCARA)) $criteria->add(FileColumnPeer::CA_MASCARA, $this->ca_mascara);
		if ($this->isColumnModified(FileColumnPeer::CA_TIPO)) $criteria->add(FileColumnPeer::CA_TIPO, $this->ca_tipo);
		if ($this->isColumnModified(FileColumnPeer::CA_LONGITUD)) $criteria->add(FileColumnPeer::CA_LONGITUD, $this->ca_longitud);
		if ($this->isColumnModified(FileColumnPeer::CA_PRECISION)) $criteria->add(FileColumnPeer::CA_PRECISION, $this->ca_precision);
		if ($this->isColumnModified(FileColumnPeer::CA_IDREGISTRO)) $criteria->add(FileColumnPeer::CA_IDREGISTRO, $this->ca_idregistro);
		if ($this->isColumnModified(FileColumnPeer::CA_FCHCREADO)) $criteria->add(FileColumnPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(FileColumnPeer::CA_USUCREADO)) $criteria->add(FileColumnPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(FileColumnPeer::CA_FCHACTUALIZADO)) $criteria->add(FileColumnPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(FileColumnPeer::CA_USUACTUALIZADO)) $criteria->add(FileColumnPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);

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
		$criteria = new Criteria(FileColumnPeer::DATABASE_NAME);

		$criteria->add(FileColumnPeer::CA_IDCOLUMNA, $this->ca_idcolumna);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdcolumna();
	}

	/**
	 * Generic method to set the primary key (ca_idcolumna column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdcolumna($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of FileColumn (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdfileheader($this->ca_idfileheader);

		$copyObj->setCaColumna($this->ca_columna);

		$copyObj->setCaLabel($this->ca_label);

		$copyObj->setCaMascara($this->ca_mascara);

		$copyObj->setCaTipo($this->ca_tipo);

		$copyObj->setCaLongitud($this->ca_longitud);

		$copyObj->setCaPrecision($this->ca_precision);

		$copyObj->setCaIdregistro($this->ca_idregistro);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);


		$copyObj->setNew(true);

		$copyObj->setCaIdcolumna(NULL); // this is a pkey column, so set to default value

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
	 * @return     FileColumn Clone of current object.
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
	 * @return     FileColumnPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new FileColumnPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a FileHeader object.
	 *
	 * @param      FileHeader $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setFileHeader($v)
	{


		if ($v === null) {
			$this->setCaIdfileheader(NULL);
		} else {
			$this->setCaIdfileheader($v->getCaIdfileheader());
		}


		$this->aFileHeader = $v;
	}


	/**
	 * Get the associated FileHeader object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     FileHeader The associated FileHeader object.
	 * @throws     PropelException
	 */
	public function getFileHeader($con = null)
	{
		if ($this->aFileHeader === null && ($this->ca_idfileheader !== null)) {
			// include the related Peer class
			$this->aFileHeader = FileHeaderPeer::retrieveByPK($this->ca_idfileheader, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = FileHeaderPeer::retrieveByPK($this->ca_idfileheader, $con);
			   $obj->addFileHeaders($this);
			 */
		}
		return $this->aFileHeader;
	}

} // BaseFileColumn
