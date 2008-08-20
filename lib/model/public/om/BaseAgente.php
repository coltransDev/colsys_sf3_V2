<?php

/**
 * Base class that represents a row from the 'tb_agentes' table.
 *
 * 
 *
 * @package    lib.model.public.om
 */
abstract class BaseAgente extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        AgentePeer
	 */
	protected static $peer;


	/**
	 * The value for the ca_idagente field.
	 * @var        int
	 */
	protected $ca_idagente;


	/**
	 * The value for the ca_nombre field.
	 * @var        string
	 */
	protected $ca_nombre;


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
	 * The value for the ca_zipcode field.
	 * @var        string
	 */
	protected $ca_zipcode;


	/**
	 * The value for the ca_website field.
	 * @var        string
	 */
	protected $ca_website;


	/**
	 * The value for the ca_email field.
	 * @var        string
	 */
	protected $ca_email;


	/**
	 * The value for the ca_divulgacion field.
	 * @var        string
	 */
	protected $ca_divulgacion;

	/**
	 * @var        Ciudad
	 */
	protected $aCiudad;

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
	 * Get the [ca_idagente] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdagente()
	{

		return $this->ca_idagente;
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
	 * Get the [ca_zipcode] column value.
	 * 
	 * @return     string
	 */
	public function getCaZipcode()
	{

		return $this->ca_zipcode;
	}

	/**
	 * Get the [ca_website] column value.
	 * 
	 * @return     string
	 */
	public function getCaWebsite()
	{

		return $this->ca_website;
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
	 * Get the [ca_divulgacion] column value.
	 * 
	 * @return     string
	 */
	public function getCaDivulgacion()
	{

		return $this->ca_divulgacion;
	}

	/**
	 * Set the value of [ca_idagente] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdagente($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idagente !== $v) {
			$this->ca_idagente = $v;
			$this->modifiedColumns[] = AgentePeer::CA_IDAGENTE;
		}

	} // setCaIdagente()

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
			$this->modifiedColumns[] = AgentePeer::CA_NOMBRE;
		}

	} // setCaNombre()

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
			$this->modifiedColumns[] = AgentePeer::CA_DIRECCION;
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
			$this->modifiedColumns[] = AgentePeer::CA_TELEFONOS;
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
			$this->modifiedColumns[] = AgentePeer::CA_FAX;
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
			$this->modifiedColumns[] = AgentePeer::CA_IDCIUDAD;
		}

		if ($this->aCiudad !== null && $this->aCiudad->getCaIdciudad() !== $v) {
			$this->aCiudad = null;
		}

	} // setCaIdciudad()

	/**
	 * Set the value of [ca_zipcode] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaZipcode($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_zipcode !== $v) {
			$this->ca_zipcode = $v;
			$this->modifiedColumns[] = AgentePeer::CA_ZIPCODE;
		}

	} // setCaZipcode()

	/**
	 * Set the value of [ca_website] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaWebsite($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_website !== $v) {
			$this->ca_website = $v;
			$this->modifiedColumns[] = AgentePeer::CA_WEBSITE;
		}

	} // setCaWebsite()

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
			$this->modifiedColumns[] = AgentePeer::CA_EMAIL;
		}

	} // setCaEmail()

	/**
	 * Set the value of [ca_divulgacion] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaDivulgacion($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_divulgacion !== $v) {
			$this->ca_divulgacion = $v;
			$this->modifiedColumns[] = AgentePeer::CA_DIVULGACION;
		}

	} // setCaDivulgacion()

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

			$this->ca_idagente = $rs->getInt($startcol + 0);

			$this->ca_nombre = $rs->getString($startcol + 1);

			$this->ca_direccion = $rs->getString($startcol + 2);

			$this->ca_telefonos = $rs->getString($startcol + 3);

			$this->ca_fax = $rs->getString($startcol + 4);

			$this->ca_idciudad = $rs->getString($startcol + 5);

			$this->ca_zipcode = $rs->getString($startcol + 6);

			$this->ca_website = $rs->getString($startcol + 7);

			$this->ca_email = $rs->getString($startcol + 8);

			$this->ca_divulgacion = $rs->getString($startcol + 9);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 10; // 10 = AgentePeer::NUM_COLUMNS - AgentePeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Agente object", $e);
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
			$con = Propel::getConnection(AgentePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			AgentePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(AgentePeer::DATABASE_NAME);
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


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = AgentePeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setCaIdagente($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += AgentePeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collTrayectos !== null) {
				foreach($this->collTrayectos as $referrerFK) {
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

			if ($this->aCiudad !== null) {
				if (!$this->aCiudad->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCiudad->getValidationFailures());
				}
			}


			if (($retval = AgentePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collTrayectos !== null) {
					foreach($this->collTrayectos as $referrerFK) {
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
		$pos = AgentePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdagente();
				break;
			case 1:
				return $this->getCaNombre();
				break;
			case 2:
				return $this->getCaDireccion();
				break;
			case 3:
				return $this->getCaTelefonos();
				break;
			case 4:
				return $this->getCaFax();
				break;
			case 5:
				return $this->getCaIdciudad();
				break;
			case 6:
				return $this->getCaZipcode();
				break;
			case 7:
				return $this->getCaWebsite();
				break;
			case 8:
				return $this->getCaEmail();
				break;
			case 9:
				return $this->getCaDivulgacion();
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
		$keys = AgentePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdagente(),
			$keys[1] => $this->getCaNombre(),
			$keys[2] => $this->getCaDireccion(),
			$keys[3] => $this->getCaTelefonos(),
			$keys[4] => $this->getCaFax(),
			$keys[5] => $this->getCaIdciudad(),
			$keys[6] => $this->getCaZipcode(),
			$keys[7] => $this->getCaWebsite(),
			$keys[8] => $this->getCaEmail(),
			$keys[9] => $this->getCaDivulgacion(),
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
		$pos = AgentePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdagente($value);
				break;
			case 1:
				$this->setCaNombre($value);
				break;
			case 2:
				$this->setCaDireccion($value);
				break;
			case 3:
				$this->setCaTelefonos($value);
				break;
			case 4:
				$this->setCaFax($value);
				break;
			case 5:
				$this->setCaIdciudad($value);
				break;
			case 6:
				$this->setCaZipcode($value);
				break;
			case 7:
				$this->setCaWebsite($value);
				break;
			case 8:
				$this->setCaEmail($value);
				break;
			case 9:
				$this->setCaDivulgacion($value);
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
		$keys = AgentePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdagente($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaNombre($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaDireccion($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaTelefonos($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaFax($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaIdciudad($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaZipcode($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaWebsite($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaEmail($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaDivulgacion($arr[$keys[9]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(AgentePeer::DATABASE_NAME);

		if ($this->isColumnModified(AgentePeer::CA_IDAGENTE)) $criteria->add(AgentePeer::CA_IDAGENTE, $this->ca_idagente);
		if ($this->isColumnModified(AgentePeer::CA_NOMBRE)) $criteria->add(AgentePeer::CA_NOMBRE, $this->ca_nombre);
		if ($this->isColumnModified(AgentePeer::CA_DIRECCION)) $criteria->add(AgentePeer::CA_DIRECCION, $this->ca_direccion);
		if ($this->isColumnModified(AgentePeer::CA_TELEFONOS)) $criteria->add(AgentePeer::CA_TELEFONOS, $this->ca_telefonos);
		if ($this->isColumnModified(AgentePeer::CA_FAX)) $criteria->add(AgentePeer::CA_FAX, $this->ca_fax);
		if ($this->isColumnModified(AgentePeer::CA_IDCIUDAD)) $criteria->add(AgentePeer::CA_IDCIUDAD, $this->ca_idciudad);
		if ($this->isColumnModified(AgentePeer::CA_ZIPCODE)) $criteria->add(AgentePeer::CA_ZIPCODE, $this->ca_zipcode);
		if ($this->isColumnModified(AgentePeer::CA_WEBSITE)) $criteria->add(AgentePeer::CA_WEBSITE, $this->ca_website);
		if ($this->isColumnModified(AgentePeer::CA_EMAIL)) $criteria->add(AgentePeer::CA_EMAIL, $this->ca_email);
		if ($this->isColumnModified(AgentePeer::CA_DIVULGACION)) $criteria->add(AgentePeer::CA_DIVULGACION, $this->ca_divulgacion);

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
		$criteria = new Criteria(AgentePeer::DATABASE_NAME);

		$criteria->add(AgentePeer::CA_IDAGENTE, $this->ca_idagente);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdagente();
	}

	/**
	 * Generic method to set the primary key (ca_idagente column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdagente($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Agente (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaNombre($this->ca_nombre);

		$copyObj->setCaDireccion($this->ca_direccion);

		$copyObj->setCaTelefonos($this->ca_telefonos);

		$copyObj->setCaFax($this->ca_fax);

		$copyObj->setCaIdciudad($this->ca_idciudad);

		$copyObj->setCaZipcode($this->ca_zipcode);

		$copyObj->setCaWebsite($this->ca_website);

		$copyObj->setCaEmail($this->ca_email);

		$copyObj->setCaDivulgacion($this->ca_divulgacion);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getTrayectos() as $relObj) {
				$copyObj->addTrayecto($relObj->copy($deepCopy));
			}

			foreach($this->getReportes() as $relObj) {
				$copyObj->addReporte($relObj->copy($deepCopy));
			}

			foreach($this->getContactoAgentes() as $relObj) {
				$copyObj->addContactoAgente($relObj->copy($deepCopy));
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setCaIdagente(NULL); // this is a pkey column, so set to default value

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
	 * @return     Agente Clone of current object.
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
	 * @return     AgentePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new AgentePeer();
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
	 * Otherwise if this Agente has previously
	 * been saved, it will retrieve related Trayectos from storage.
	 * If this Agente is new, it will return
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

				$criteria->add(TrayectoPeer::CA_IDAGENTE, $this->getCaIdagente());

				TrayectoPeer::addSelectColumns($criteria);
				$this->collTrayectos = TrayectoPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(TrayectoPeer::CA_IDAGENTE, $this->getCaIdagente());

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

		$criteria->add(TrayectoPeer::CA_IDAGENTE, $this->getCaIdagente());

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
		$l->setAgente($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Agente is new, it will return
	 * an empty collection; or if this Agente has previously
	 * been saved, it will retrieve related Trayectos from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Agente.
	 */
	public function getTrayectosJoinTransportador($criteria = null, $con = null)
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

				$criteria->add(TrayectoPeer::CA_IDAGENTE, $this->getCaIdagente());

				$this->collTrayectos = TrayectoPeer::doSelectJoinTransportador($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(TrayectoPeer::CA_IDAGENTE, $this->getCaIdagente());

			if (!isset($this->lastTrayectoCriteria) || !$this->lastTrayectoCriteria->equals($criteria)) {
				$this->collTrayectos = TrayectoPeer::doSelectJoinTransportador($criteria, $con);
			}
		}
		$this->lastTrayectoCriteria = $criteria;

		return $this->collTrayectos;
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
	 * Otherwise if this Agente has previously
	 * been saved, it will retrieve related Reportes from storage.
	 * If this Agente is new, it will return
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

				$criteria->add(ReportePeer::CA_IDAGENTE, $this->getCaIdagente());

				ReportePeer::addSelectColumns($criteria);
				$this->collReportes = ReportePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ReportePeer::CA_IDAGENTE, $this->getCaIdagente());

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

		$criteria->add(ReportePeer::CA_IDAGENTE, $this->getCaIdagente());

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
		$l->setAgente($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Agente is new, it will return
	 * an empty collection; or if this Agente has previously
	 * been saved, it will retrieve related Reportes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Agente.
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

				$criteria->add(ReportePeer::CA_IDAGENTE, $this->getCaIdagente());

				$this->collReportes = ReportePeer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ReportePeer::CA_IDAGENTE, $this->getCaIdagente());

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
	 * Otherwise if this Agente is new, it will return
	 * an empty collection; or if this Agente has previously
	 * been saved, it will retrieve related Reportes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Agente.
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

				$criteria->add(ReportePeer::CA_IDAGENTE, $this->getCaIdagente());

				$this->collReportes = ReportePeer::doSelectJoinTransportador($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ReportePeer::CA_IDAGENTE, $this->getCaIdagente());

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
	 * Otherwise if this Agente is new, it will return
	 * an empty collection; or if this Agente has previously
	 * been saved, it will retrieve related Reportes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Agente.
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

				$criteria->add(ReportePeer::CA_IDAGENTE, $this->getCaIdagente());

				$this->collReportes = ReportePeer::doSelectJoinTercero($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ReportePeer::CA_IDAGENTE, $this->getCaIdagente());

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinTercero($criteria, $con);
			}
		}
		$this->lastReporteCriteria = $criteria;

		return $this->collReportes;
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
	 * Otherwise if this Agente has previously
	 * been saved, it will retrieve related ContactoAgentes from storage.
	 * If this Agente is new, it will return
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

				$criteria->add(ContactoAgentePeer::CA_IDAGENTE, $this->getCaIdagente());

				ContactoAgentePeer::addSelectColumns($criteria);
				$this->collContactoAgentes = ContactoAgentePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ContactoAgentePeer::CA_IDAGENTE, $this->getCaIdagente());

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

		$criteria->add(ContactoAgentePeer::CA_IDAGENTE, $this->getCaIdagente());

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
		$l->setAgente($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Agente is new, it will return
	 * an empty collection; or if this Agente has previously
	 * been saved, it will retrieve related ContactoAgentes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Agente.
	 */
	public function getContactoAgentesJoinCiudad($criteria = null, $con = null)
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

				$criteria->add(ContactoAgentePeer::CA_IDAGENTE, $this->getCaIdagente());

				$this->collContactoAgentes = ContactoAgentePeer::doSelectJoinCiudad($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ContactoAgentePeer::CA_IDAGENTE, $this->getCaIdagente());

			if (!isset($this->lastContactoAgenteCriteria) || !$this->lastContactoAgenteCriteria->equals($criteria)) {
				$this->collContactoAgentes = ContactoAgentePeer::doSelectJoinCiudad($criteria, $con);
			}
		}
		$this->lastContactoAgenteCriteria = $criteria;

		return $this->collContactoAgentes;
	}

} // BaseAgente
