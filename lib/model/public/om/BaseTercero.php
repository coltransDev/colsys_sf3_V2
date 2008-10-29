<?php

/**
 * Base class that represents a row from the 'tb_terceros' table.
 *
 * 
 *
 * @package    lib.model.public.om
 */
abstract class BaseTercero extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        TerceroPeer
	 */
	protected static $peer;


	/**
	 * The value for the ca_idtercero field.
	 * @var        int
	 */
	protected $ca_idtercero;


	/**
	 * The value for the ca_nombre field.
	 * @var        string
	 */
	protected $ca_nombre;


	/**
	 * The value for the ca_contacto field.
	 * @var        string
	 */
	protected $ca_contacto;


	/**
	 * The value for the ca_direccion field.
	 * @var        string
	 */
	protected $ca_direccion;


	/**
	 * The value for the ca_telefonos field.
	 * @var        string
	 */
	protected $ca_telefonos;


	/**
	 * The value for the ca_fax field.
	 * @var        string
	 */
	protected $ca_fax;


	/**
	 * The value for the ca_idciudad field.
	 * @var        string
	 */
	protected $ca_idciudad;


	/**
	 * The value for the ca_email field.
	 * @var        string
	 */
	protected $ca_email;


	/**
	 * The value for the ca_vendedor field.
	 * @var        string
	 */
	protected $ca_vendedor;


	/**
	 * The value for the ca_tipo field.
	 * @var        string
	 */
	protected $ca_tipo;


	/**
	 * The value for the ca_identificacion field.
	 * @var        string
	 */
	protected $ca_identificacion;

	/**
	 * Collection to store aggregation of collInoClientesAirs.
	 * @var        array
	 */
	protected $collInoClientesAirs;

	/**
	 * The criteria used to select the current contents of collInoClientesAirs.
	 * @var        Criteria
	 */
	protected $lastInoClientesAirCriteria = null;

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
	 * Collection to store aggregation of collInoClientesSeas.
	 * @var        array
	 */
	protected $collInoClientesSeas;

	/**
	 * The criteria used to select the current contents of collInoClientesSeas.
	 * @var        Criteria
	 */
	protected $lastInoClientesSeaCriteria = null;

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
	 * Get the [ca_idtercero] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdtercero()
	{

		return $this->ca_idtercero;
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
	 * Get the [ca_contacto] column value.
	 * 
	 * @return     string
	 */
	public function getCaContacto()
	{

		return $this->ca_contacto;
	}

	/**
	 * Get the [ca_direccion] column value.
	 * 
	 * @return     string
	 */
	public function getCaDireccion()
	{

		return $this->ca_direccion;
	}

	/**
	 * Get the [ca_telefonos] column value.
	 * 
	 * @return     string
	 */
	public function getCaTelefonos()
	{

		return $this->ca_telefonos;
	}

	/**
	 * Get the [ca_fax] column value.
	 * 
	 * @return     string
	 */
	public function getCaFax()
	{

		return $this->ca_fax;
	}

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
	 * Get the [ca_email] column value.
	 * 
	 * @return     string
	 */
	public function getCaEmail()
	{

		return $this->ca_email;
	}

	/**
	 * Get the [ca_vendedor] column value.
	 * 
	 * @return     string
	 */
	public function getCaVendedor()
	{

		return $this->ca_vendedor;
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
	 * Get the [ca_identificacion] column value.
	 * 
	 * @return     string
	 */
	public function getCaIdentificacion()
	{

		return $this->ca_identificacion;
	}

	/**
	 * Set the value of [ca_idtercero] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdtercero($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idtercero !== $v) {
			$this->ca_idtercero = $v;
			$this->modifiedColumns[] = TerceroPeer::CA_IDTERCERO;
		}

	} // setCaIdtercero()

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
			$this->modifiedColumns[] = TerceroPeer::CA_NOMBRE;
		}

	} // setCaNombre()

	/**
	 * Set the value of [ca_contacto] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaContacto($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_contacto !== $v) {
			$this->ca_contacto = $v;
			$this->modifiedColumns[] = TerceroPeer::CA_CONTACTO;
		}

	} // setCaContacto()

	/**
	 * Set the value of [ca_direccion] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaDireccion($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_direccion !== $v) {
			$this->ca_direccion = $v;
			$this->modifiedColumns[] = TerceroPeer::CA_DIRECCION;
		}

	} // setCaDireccion()

	/**
	 * Set the value of [ca_telefonos] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaTelefonos($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_telefonos !== $v) {
			$this->ca_telefonos = $v;
			$this->modifiedColumns[] = TerceroPeer::CA_TELEFONOS;
		}

	} // setCaTelefonos()

	/**
	 * Set the value of [ca_fax] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaFax($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_fax !== $v) {
			$this->ca_fax = $v;
			$this->modifiedColumns[] = TerceroPeer::CA_FAX;
		}

	} // setCaFax()

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
			$this->modifiedColumns[] = TerceroPeer::CA_IDCIUDAD;
		}

	} // setCaIdciudad()

	/**
	 * Set the value of [ca_email] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaEmail($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_email !== $v) {
			$this->ca_email = $v;
			$this->modifiedColumns[] = TerceroPeer::CA_EMAIL;
		}

	} // setCaEmail()

	/**
	 * Set the value of [ca_vendedor] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaVendedor($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_vendedor !== $v) {
			$this->ca_vendedor = $v;
			$this->modifiedColumns[] = TerceroPeer::CA_VENDEDOR;
		}

	} // setCaVendedor()

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
			$this->modifiedColumns[] = TerceroPeer::CA_TIPO;
		}

	} // setCaTipo()

	/**
	 * Set the value of [ca_identificacion] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaIdentificacion($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_identificacion !== $v) {
			$this->ca_identificacion = $v;
			$this->modifiedColumns[] = TerceroPeer::CA_IDENTIFICACION;
		}

	} // setCaIdentificacion()

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

			$this->ca_idtercero = $rs->getInt($startcol + 0);

			$this->ca_nombre = $rs->getString($startcol + 1);

			$this->ca_contacto = $rs->getString($startcol + 2);

			$this->ca_direccion = $rs->getString($startcol + 3);

			$this->ca_telefonos = $rs->getString($startcol + 4);

			$this->ca_fax = $rs->getString($startcol + 5);

			$this->ca_idciudad = $rs->getString($startcol + 6);

			$this->ca_email = $rs->getString($startcol + 7);

			$this->ca_vendedor = $rs->getString($startcol + 8);

			$this->ca_tipo = $rs->getString($startcol + 9);

			$this->ca_identificacion = $rs->getString($startcol + 10);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 11; // 11 = TerceroPeer::NUM_COLUMNS - TerceroPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Tercero object", $e);
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
			$con = Propel::getConnection(TerceroPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			TerceroPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(TerceroPeer::DATABASE_NAME);
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
					$pk = TerceroPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setCaIdtercero($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += TerceroPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collInoClientesAirs !== null) {
				foreach($this->collInoClientesAirs as $referrerFK) {
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

			if ($this->collInoClientesSeas !== null) {
				foreach($this->collInoClientesSeas as $referrerFK) {
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


			if (($retval = TerceroPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collInoClientesAirs !== null) {
					foreach($this->collInoClientesAirs as $referrerFK) {
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

				if ($this->collInoClientesSeas !== null) {
					foreach($this->collInoClientesSeas as $referrerFK) {
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
		$pos = TerceroPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdtercero();
				break;
			case 1:
				return $this->getCaNombre();
				break;
			case 2:
				return $this->getCaContacto();
				break;
			case 3:
				return $this->getCaDireccion();
				break;
			case 4:
				return $this->getCaTelefonos();
				break;
			case 5:
				return $this->getCaFax();
				break;
			case 6:
				return $this->getCaIdciudad();
				break;
			case 7:
				return $this->getCaEmail();
				break;
			case 8:
				return $this->getCaVendedor();
				break;
			case 9:
				return $this->getCaTipo();
				break;
			case 10:
				return $this->getCaIdentificacion();
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
		$keys = TerceroPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdtercero(),
			$keys[1] => $this->getCaNombre(),
			$keys[2] => $this->getCaContacto(),
			$keys[3] => $this->getCaDireccion(),
			$keys[4] => $this->getCaTelefonos(),
			$keys[5] => $this->getCaFax(),
			$keys[6] => $this->getCaIdciudad(),
			$keys[7] => $this->getCaEmail(),
			$keys[8] => $this->getCaVendedor(),
			$keys[9] => $this->getCaTipo(),
			$keys[10] => $this->getCaIdentificacion(),
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
		$pos = TerceroPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdtercero($value);
				break;
			case 1:
				$this->setCaNombre($value);
				break;
			case 2:
				$this->setCaContacto($value);
				break;
			case 3:
				$this->setCaDireccion($value);
				break;
			case 4:
				$this->setCaTelefonos($value);
				break;
			case 5:
				$this->setCaFax($value);
				break;
			case 6:
				$this->setCaIdciudad($value);
				break;
			case 7:
				$this->setCaEmail($value);
				break;
			case 8:
				$this->setCaVendedor($value);
				break;
			case 9:
				$this->setCaTipo($value);
				break;
			case 10:
				$this->setCaIdentificacion($value);
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
		$keys = TerceroPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdtercero($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaNombre($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaContacto($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaDireccion($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaTelefonos($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaFax($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaIdciudad($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaEmail($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaVendedor($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaTipo($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaIdentificacion($arr[$keys[10]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(TerceroPeer::DATABASE_NAME);

		if ($this->isColumnModified(TerceroPeer::CA_IDTERCERO)) $criteria->add(TerceroPeer::CA_IDTERCERO, $this->ca_idtercero);
		if ($this->isColumnModified(TerceroPeer::CA_NOMBRE)) $criteria->add(TerceroPeer::CA_NOMBRE, $this->ca_nombre);
		if ($this->isColumnModified(TerceroPeer::CA_CONTACTO)) $criteria->add(TerceroPeer::CA_CONTACTO, $this->ca_contacto);
		if ($this->isColumnModified(TerceroPeer::CA_DIRECCION)) $criteria->add(TerceroPeer::CA_DIRECCION, $this->ca_direccion);
		if ($this->isColumnModified(TerceroPeer::CA_TELEFONOS)) $criteria->add(TerceroPeer::CA_TELEFONOS, $this->ca_telefonos);
		if ($this->isColumnModified(TerceroPeer::CA_FAX)) $criteria->add(TerceroPeer::CA_FAX, $this->ca_fax);
		if ($this->isColumnModified(TerceroPeer::CA_IDCIUDAD)) $criteria->add(TerceroPeer::CA_IDCIUDAD, $this->ca_idciudad);
		if ($this->isColumnModified(TerceroPeer::CA_EMAIL)) $criteria->add(TerceroPeer::CA_EMAIL, $this->ca_email);
		if ($this->isColumnModified(TerceroPeer::CA_VENDEDOR)) $criteria->add(TerceroPeer::CA_VENDEDOR, $this->ca_vendedor);
		if ($this->isColumnModified(TerceroPeer::CA_TIPO)) $criteria->add(TerceroPeer::CA_TIPO, $this->ca_tipo);
		if ($this->isColumnModified(TerceroPeer::CA_IDENTIFICACION)) $criteria->add(TerceroPeer::CA_IDENTIFICACION, $this->ca_identificacion);

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
		$criteria = new Criteria(TerceroPeer::DATABASE_NAME);

		$criteria->add(TerceroPeer::CA_IDTERCERO, $this->ca_idtercero);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdtercero();
	}

	/**
	 * Generic method to set the primary key (ca_idtercero column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdtercero($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Tercero (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaNombre($this->ca_nombre);

		$copyObj->setCaContacto($this->ca_contacto);

		$copyObj->setCaDireccion($this->ca_direccion);

		$copyObj->setCaTelefonos($this->ca_telefonos);

		$copyObj->setCaFax($this->ca_fax);

		$copyObj->setCaIdciudad($this->ca_idciudad);

		$copyObj->setCaEmail($this->ca_email);

		$copyObj->setCaVendedor($this->ca_vendedor);

		$copyObj->setCaTipo($this->ca_tipo);

		$copyObj->setCaIdentificacion($this->ca_identificacion);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getInoClientesAirs() as $relObj) {
				$copyObj->addInoClientesAir($relObj->copy($deepCopy));
			}

			foreach($this->getReportes() as $relObj) {
				$copyObj->addReporte($relObj->copy($deepCopy));
			}

			foreach($this->getInoClientesSeas() as $relObj) {
				$copyObj->addInoClientesSea($relObj->copy($deepCopy));
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setCaIdtercero(NULL); // this is a pkey column, so set to default value

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
	 * @return     Tercero Clone of current object.
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
	 * @return     TerceroPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new TerceroPeer();
		}
		return self::$peer;
	}

	/**
	 * Temporary storage of collInoClientesAirs to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initInoClientesAirs()
	{
		if ($this->collInoClientesAirs === null) {
			$this->collInoClientesAirs = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Tercero has previously
	 * been saved, it will retrieve related InoClientesAirs from storage.
	 * If this Tercero is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getInoClientesAirs($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesAirs === null) {
			if ($this->isNew()) {
			   $this->collInoClientesAirs = array();
			} else {

				$criteria->add(InoClientesAirPeer::CA_IDPROVEEDOR, $this->getCaIdtercero());

				InoClientesAirPeer::addSelectColumns($criteria);
				$this->collInoClientesAirs = InoClientesAirPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(InoClientesAirPeer::CA_IDPROVEEDOR, $this->getCaIdtercero());

				InoClientesAirPeer::addSelectColumns($criteria);
				if (!isset($this->lastInoClientesAirCriteria) || !$this->lastInoClientesAirCriteria->equals($criteria)) {
					$this->collInoClientesAirs = InoClientesAirPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInoClientesAirCriteria = $criteria;
		return $this->collInoClientesAirs;
	}

	/**
	 * Returns the number of related InoClientesAirs.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countInoClientesAirs($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(InoClientesAirPeer::CA_IDPROVEEDOR, $this->getCaIdtercero());

		return InoClientesAirPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a InoClientesAir object to this object
	 * through the InoClientesAir foreign key attribute
	 *
	 * @param      InoClientesAir $l InoClientesAir
	 * @return     void
	 * @throws     PropelException
	 */
	public function addInoClientesAir(InoClientesAir $l)
	{
		$this->collInoClientesAirs[] = $l;
		$l->setTercero($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Tercero is new, it will return
	 * an empty collection; or if this Tercero has previously
	 * been saved, it will retrieve related InoClientesAirs from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Tercero.
	 */
	public function getInoClientesAirsJoinReporte($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesAirs === null) {
			if ($this->isNew()) {
				$this->collInoClientesAirs = array();
			} else {

				$criteria->add(InoClientesAirPeer::CA_IDPROVEEDOR, $this->getCaIdtercero());

				$this->collInoClientesAirs = InoClientesAirPeer::doSelectJoinReporte($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(InoClientesAirPeer::CA_IDPROVEEDOR, $this->getCaIdtercero());

			if (!isset($this->lastInoClientesAirCriteria) || !$this->lastInoClientesAirCriteria->equals($criteria)) {
				$this->collInoClientesAirs = InoClientesAirPeer::doSelectJoinReporte($criteria, $con);
			}
		}
		$this->lastInoClientesAirCriteria = $criteria;

		return $this->collInoClientesAirs;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Tercero is new, it will return
	 * an empty collection; or if this Tercero has previously
	 * been saved, it will retrieve related InoClientesAirs from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Tercero.
	 */
	public function getInoClientesAirsJoinInoMaestraAir($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesAirs === null) {
			if ($this->isNew()) {
				$this->collInoClientesAirs = array();
			} else {

				$criteria->add(InoClientesAirPeer::CA_IDPROVEEDOR, $this->getCaIdtercero());

				$this->collInoClientesAirs = InoClientesAirPeer::doSelectJoinInoMaestraAir($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(InoClientesAirPeer::CA_IDPROVEEDOR, $this->getCaIdtercero());

			if (!isset($this->lastInoClientesAirCriteria) || !$this->lastInoClientesAirCriteria->equals($criteria)) {
				$this->collInoClientesAirs = InoClientesAirPeer::doSelectJoinInoMaestraAir($criteria, $con);
			}
		}
		$this->lastInoClientesAirCriteria = $criteria;

		return $this->collInoClientesAirs;
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
	 * Otherwise if this Tercero has previously
	 * been saved, it will retrieve related Reportes from storage.
	 * If this Tercero is new, it will return
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

				$criteria->add(ReportePeer::CA_IDPROVEEDOR, $this->getCaIdtercero());

				ReportePeer::addSelectColumns($criteria);
				$this->collReportes = ReportePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ReportePeer::CA_IDPROVEEDOR, $this->getCaIdtercero());

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

		$criteria->add(ReportePeer::CA_IDPROVEEDOR, $this->getCaIdtercero());

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
		$l->setTercero($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Tercero is new, it will return
	 * an empty collection; or if this Tercero has previously
	 * been saved, it will retrieve related Reportes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Tercero.
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

				$criteria->add(ReportePeer::CA_IDPROVEEDOR, $this->getCaIdtercero());

				$this->collReportes = ReportePeer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ReportePeer::CA_IDPROVEEDOR, $this->getCaIdtercero());

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
	 * Otherwise if this Tercero is new, it will return
	 * an empty collection; or if this Tercero has previously
	 * been saved, it will retrieve related Reportes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Tercero.
	 */
	public function getReportesJoinTransportador($criteria = null, $con = null)
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

				$criteria->add(ReportePeer::CA_IDPROVEEDOR, $this->getCaIdtercero());

				$this->collReportes = ReportePeer::doSelectJoinTransportador($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ReportePeer::CA_IDPROVEEDOR, $this->getCaIdtercero());

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinTransportador($criteria, $con);
			}
		}
		$this->lastReporteCriteria = $criteria;

		return $this->collReportes;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Tercero is new, it will return
	 * an empty collection; or if this Tercero has previously
	 * been saved, it will retrieve related Reportes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Tercero.
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

				$criteria->add(ReportePeer::CA_IDPROVEEDOR, $this->getCaIdtercero());

				$this->collReportes = ReportePeer::doSelectJoinAgente($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ReportePeer::CA_IDPROVEEDOR, $this->getCaIdtercero());

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
	 * Otherwise if this Tercero is new, it will return
	 * an empty collection; or if this Tercero has previously
	 * been saved, it will retrieve related Reportes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Tercero.
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

				$criteria->add(ReportePeer::CA_IDPROVEEDOR, $this->getCaIdtercero());

				$this->collReportes = ReportePeer::doSelectJoinBodega($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ReportePeer::CA_IDPROVEEDOR, $this->getCaIdtercero());

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinBodega($criteria, $con);
			}
		}
		$this->lastReporteCriteria = $criteria;

		return $this->collReportes;
	}

	/**
	 * Temporary storage of collInoClientesSeas to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initInoClientesSeas()
	{
		if ($this->collInoClientesSeas === null) {
			$this->collInoClientesSeas = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Tercero has previously
	 * been saved, it will retrieve related InoClientesSeas from storage.
	 * If this Tercero is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getInoClientesSeas($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesSeas === null) {
			if ($this->isNew()) {
			   $this->collInoClientesSeas = array();
			} else {

				$criteria->add(InoClientesSeaPeer::CA_IDPROVEEDOR, $this->getCaIdtercero());

				InoClientesSeaPeer::addSelectColumns($criteria);
				$this->collInoClientesSeas = InoClientesSeaPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(InoClientesSeaPeer::CA_IDPROVEEDOR, $this->getCaIdtercero());

				InoClientesSeaPeer::addSelectColumns($criteria);
				if (!isset($this->lastInoClientesSeaCriteria) || !$this->lastInoClientesSeaCriteria->equals($criteria)) {
					$this->collInoClientesSeas = InoClientesSeaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInoClientesSeaCriteria = $criteria;
		return $this->collInoClientesSeas;
	}

	/**
	 * Returns the number of related InoClientesSeas.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countInoClientesSeas($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(InoClientesSeaPeer::CA_IDPROVEEDOR, $this->getCaIdtercero());

		return InoClientesSeaPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a InoClientesSea object to this object
	 * through the InoClientesSea foreign key attribute
	 *
	 * @param      InoClientesSea $l InoClientesSea
	 * @return     void
	 * @throws     PropelException
	 */
	public function addInoClientesSea(InoClientesSea $l)
	{
		$this->collInoClientesSeas[] = $l;
		$l->setTercero($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Tercero is new, it will return
	 * an empty collection; or if this Tercero has previously
	 * been saved, it will retrieve related InoClientesSeas from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Tercero.
	 */
	public function getInoClientesSeasJoinReporte($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesSeas === null) {
			if ($this->isNew()) {
				$this->collInoClientesSeas = array();
			} else {

				$criteria->add(InoClientesSeaPeer::CA_IDPROVEEDOR, $this->getCaIdtercero());

				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinReporte($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(InoClientesSeaPeer::CA_IDPROVEEDOR, $this->getCaIdtercero());

			if (!isset($this->lastInoClientesSeaCriteria) || !$this->lastInoClientesSeaCriteria->equals($criteria)) {
				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinReporte($criteria, $con);
			}
		}
		$this->lastInoClientesSeaCriteria = $criteria;

		return $this->collInoClientesSeas;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Tercero is new, it will return
	 * an empty collection; or if this Tercero has previously
	 * been saved, it will retrieve related InoClientesSeas from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Tercero.
	 */
	public function getInoClientesSeasJoinInoMaestraSea($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesSeas === null) {
			if ($this->isNew()) {
				$this->collInoClientesSeas = array();
			} else {

				$criteria->add(InoClientesSeaPeer::CA_IDPROVEEDOR, $this->getCaIdtercero());

				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinInoMaestraSea($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(InoClientesSeaPeer::CA_IDPROVEEDOR, $this->getCaIdtercero());

			if (!isset($this->lastInoClientesSeaCriteria) || !$this->lastInoClientesSeaCriteria->equals($criteria)) {
				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinInoMaestraSea($criteria, $con);
			}
		}
		$this->lastInoClientesSeaCriteria = $criteria;

		return $this->collInoClientesSeas;
	}

} // BaseTercero
