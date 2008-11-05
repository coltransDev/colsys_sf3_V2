<?php

/**
 * Base class that represents a row from the 'control.tb_usuarios' table.
 *
 * 
 *
 * @package    lib.model.control.om
 */
abstract class BaseUsuario extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        UsuarioPeer
	 */
	protected static $peer;


	/**
	 * The value for the ca_login field.
	 * @var        string
	 */
	protected $ca_login;


	/**
	 * The value for the ca_nombre field.
	 * @var        string
	 */
	protected $ca_nombre;


	/**
	 * The value for the ca_cargo field.
	 * @var        string
	 */
	protected $ca_cargo;


	/**
	 * The value for the ca_departamento field.
	 * @var        string
	 */
	protected $ca_departamento;


	/**
	 * The value for the ca_sucursal field.
	 * @var        string
	 */
	protected $ca_sucursal;


	/**
	 * The value for the ca_email field.
	 * @var        string
	 */
	protected $ca_email;


	/**
	 * The value for the ca_rutinas field.
	 * @var        string
	 */
	protected $ca_rutinas;


	/**
	 * The value for the ca_extension field.
	 * @var        string
	 */
	protected $ca_extension;

	/**
	 * @var        Sucursal
	 */
	protected $aSucursal;

	/**
	 * Collection to store aggregation of collNivelesAccesos.
	 * @var        array
	 */
	protected $collNivelesAccesos;

	/**
	 * The criteria used to select the current contents of collNivelesAccesos.
	 * @var        Criteria
	 */
	protected $lastNivelesAccesoCriteria = null;

	/**
	 * Collection to store aggregation of collAccesoUsuarios.
	 * @var        array
	 */
	protected $collAccesoUsuarios;

	/**
	 * The criteria used to select the current contents of collAccesoUsuarios.
	 * @var        Criteria
	 */
	protected $lastAccesoUsuarioCriteria = null;

	/**
	 * Collection to store aggregation of collCotizacions.
	 * @var        array
	 */
	protected $collCotizacions;

	/**
	 * The criteria used to select the current contents of collCotizacions.
	 * @var        Criteria
	 */
	protected $lastCotizacionCriteria = null;

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
	 * Get the [ca_login] column value.
	 * 
	 * @return     string
	 */
	public function getCaLogin()
	{

		return $this->ca_login;
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
	 * Get the [ca_cargo] column value.
	 * 
	 * @return     string
	 */
	public function getCaCargo()
	{

		return $this->ca_cargo;
	}

	/**
	 * Get the [ca_departamento] column value.
	 * 
	 * @return     string
	 */
	public function getCaDepartamento()
	{

		return $this->ca_departamento;
	}

	/**
	 * Get the [ca_sucursal] column value.
	 * 
	 * @return     string
	 */
	public function getCaSucursal()
	{

		return $this->ca_sucursal;
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
	 * Get the [ca_rutinas] column value.
	 * 
	 * @return     string
	 */
	public function getCaRutinas()
	{

		return $this->ca_rutinas;
	}

	/**
	 * Get the [ca_extension] column value.
	 * 
	 * @return     string
	 */
	public function getCaExtension()
	{

		return $this->ca_extension;
	}

	/**
	 * Set the value of [ca_login] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaLogin($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_login !== $v) {
			$this->ca_login = $v;
			$this->modifiedColumns[] = UsuarioPeer::CA_LOGIN;
		}

	} // setCaLogin()

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
			$this->modifiedColumns[] = UsuarioPeer::CA_NOMBRE;
		}

	} // setCaNombre()

	/**
	 * Set the value of [ca_cargo] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaCargo($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_cargo !== $v) {
			$this->ca_cargo = $v;
			$this->modifiedColumns[] = UsuarioPeer::CA_CARGO;
		}

	} // setCaCargo()

	/**
	 * Set the value of [ca_departamento] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaDepartamento($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_departamento !== $v) {
			$this->ca_departamento = $v;
			$this->modifiedColumns[] = UsuarioPeer::CA_DEPARTAMENTO;
		}

	} // setCaDepartamento()

	/**
	 * Set the value of [ca_sucursal] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaSucursal($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_sucursal !== $v) {
			$this->ca_sucursal = $v;
			$this->modifiedColumns[] = UsuarioPeer::CA_SUCURSAL;
		}

		if ($this->aSucursal !== null && $this->aSucursal->getCaNombre() !== $v) {
			$this->aSucursal = null;
		}

	} // setCaSucursal()

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
			$this->modifiedColumns[] = UsuarioPeer::CA_EMAIL;
		}

	} // setCaEmail()

	/**
	 * Set the value of [ca_rutinas] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaRutinas($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_rutinas !== $v) {
			$this->ca_rutinas = $v;
			$this->modifiedColumns[] = UsuarioPeer::CA_RUTINAS;
		}

	} // setCaRutinas()

	/**
	 * Set the value of [ca_extension] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaExtension($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_extension !== $v) {
			$this->ca_extension = $v;
			$this->modifiedColumns[] = UsuarioPeer::CA_EXTENSION;
		}

	} // setCaExtension()

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

			$this->ca_login = $rs->getString($startcol + 0);

			$this->ca_nombre = $rs->getString($startcol + 1);

			$this->ca_cargo = $rs->getString($startcol + 2);

			$this->ca_departamento = $rs->getString($startcol + 3);

			$this->ca_sucursal = $rs->getString($startcol + 4);

			$this->ca_email = $rs->getString($startcol + 5);

			$this->ca_rutinas = $rs->getString($startcol + 6);

			$this->ca_extension = $rs->getString($startcol + 7);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 8; // 8 = UsuarioPeer::NUM_COLUMNS - UsuarioPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Usuario object", $e);
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
			$con = Propel::getConnection(UsuarioPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			UsuarioPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(UsuarioPeer::DATABASE_NAME);
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

			if ($this->aSucursal !== null) {
				if ($this->aSucursal->isModified()) {
					$affectedRows += $this->aSucursal->save($con);
				}
				$this->setSucursal($this->aSucursal);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = UsuarioPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setCaLogin($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += UsuarioPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collNivelesAccesos !== null) {
				foreach($this->collNivelesAccesos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collAccesoUsuarios !== null) {
				foreach($this->collAccesoUsuarios as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCotizacions !== null) {
				foreach($this->collCotizacions as $referrerFK) {
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

			if ($this->aSucursal !== null) {
				if (!$this->aSucursal->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSucursal->getValidationFailures());
				}
			}


			if (($retval = UsuarioPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collNivelesAccesos !== null) {
					foreach($this->collNivelesAccesos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collAccesoUsuarios !== null) {
					foreach($this->collAccesoUsuarios as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCotizacions !== null) {
					foreach($this->collCotizacions as $referrerFK) {
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
		$pos = UsuarioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaLogin();
				break;
			case 1:
				return $this->getCaNombre();
				break;
			case 2:
				return $this->getCaCargo();
				break;
			case 3:
				return $this->getCaDepartamento();
				break;
			case 4:
				return $this->getCaSucursal();
				break;
			case 5:
				return $this->getCaEmail();
				break;
			case 6:
				return $this->getCaRutinas();
				break;
			case 7:
				return $this->getCaExtension();
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
		$keys = UsuarioPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaLogin(),
			$keys[1] => $this->getCaNombre(),
			$keys[2] => $this->getCaCargo(),
			$keys[3] => $this->getCaDepartamento(),
			$keys[4] => $this->getCaSucursal(),
			$keys[5] => $this->getCaEmail(),
			$keys[6] => $this->getCaRutinas(),
			$keys[7] => $this->getCaExtension(),
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
		$pos = UsuarioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaLogin($value);
				break;
			case 1:
				$this->setCaNombre($value);
				break;
			case 2:
				$this->setCaCargo($value);
				break;
			case 3:
				$this->setCaDepartamento($value);
				break;
			case 4:
				$this->setCaSucursal($value);
				break;
			case 5:
				$this->setCaEmail($value);
				break;
			case 6:
				$this->setCaRutinas($value);
				break;
			case 7:
				$this->setCaExtension($value);
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
		$keys = UsuarioPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaLogin($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaNombre($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaCargo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaDepartamento($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaSucursal($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaEmail($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaRutinas($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaExtension($arr[$keys[7]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);

		if ($this->isColumnModified(UsuarioPeer::CA_LOGIN)) $criteria->add(UsuarioPeer::CA_LOGIN, $this->ca_login);
		if ($this->isColumnModified(UsuarioPeer::CA_NOMBRE)) $criteria->add(UsuarioPeer::CA_NOMBRE, $this->ca_nombre);
		if ($this->isColumnModified(UsuarioPeer::CA_CARGO)) $criteria->add(UsuarioPeer::CA_CARGO, $this->ca_cargo);
		if ($this->isColumnModified(UsuarioPeer::CA_DEPARTAMENTO)) $criteria->add(UsuarioPeer::CA_DEPARTAMENTO, $this->ca_departamento);
		if ($this->isColumnModified(UsuarioPeer::CA_SUCURSAL)) $criteria->add(UsuarioPeer::CA_SUCURSAL, $this->ca_sucursal);
		if ($this->isColumnModified(UsuarioPeer::CA_EMAIL)) $criteria->add(UsuarioPeer::CA_EMAIL, $this->ca_email);
		if ($this->isColumnModified(UsuarioPeer::CA_RUTINAS)) $criteria->add(UsuarioPeer::CA_RUTINAS, $this->ca_rutinas);
		if ($this->isColumnModified(UsuarioPeer::CA_EXTENSION)) $criteria->add(UsuarioPeer::CA_EXTENSION, $this->ca_extension);

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
		$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);

		$criteria->add(UsuarioPeer::CA_LOGIN, $this->ca_login);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     string
	 */
	public function getPrimaryKey()
	{
		return $this->getCaLogin();
	}

	/**
	 * Generic method to set the primary key (ca_login column).
	 *
	 * @param      string $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaLogin($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Usuario (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaNombre($this->ca_nombre);

		$copyObj->setCaCargo($this->ca_cargo);

		$copyObj->setCaDepartamento($this->ca_departamento);

		$copyObj->setCaSucursal($this->ca_sucursal);

		$copyObj->setCaEmail($this->ca_email);

		$copyObj->setCaRutinas($this->ca_rutinas);

		$copyObj->setCaExtension($this->ca_extension);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getNivelesAccesos() as $relObj) {
				$copyObj->addNivelesAcceso($relObj->copy($deepCopy));
			}

			foreach($this->getAccesoUsuarios() as $relObj) {
				$copyObj->addAccesoUsuario($relObj->copy($deepCopy));
			}

			foreach($this->getCotizacions() as $relObj) {
				$copyObj->addCotizacion($relObj->copy($deepCopy));
			}

			foreach($this->getReportes() as $relObj) {
				$copyObj->addReporte($relObj->copy($deepCopy));
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setCaLogin(NULL); // this is a pkey column, so set to default value

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
	 * @return     Usuario Clone of current object.
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
	 * @return     UsuarioPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new UsuarioPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Sucursal object.
	 *
	 * @param      Sucursal $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setSucursal($v)
	{


		if ($v === null) {
			$this->setCaSucursal(NULL);
		} else {
			$this->setCaSucursal($v->getCaNombre());
		}


		$this->aSucursal = $v;
	}


	/**
	 * Get the associated Sucursal object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Sucursal The associated Sucursal object.
	 * @throws     PropelException
	 */
	public function getSucursal($con = null)
	{
		if ($this->aSucursal === null && (($this->ca_sucursal !== "" && $this->ca_sucursal !== null))) {
			// include the related Peer class
			$this->aSucursal = SucursalPeer::retrieveByPK($this->ca_sucursal, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = SucursalPeer::retrieveByPK($this->ca_sucursal, $con);
			   $obj->addSucursals($this);
			 */
		}
		return $this->aSucursal;
	}

	/**
	 * Temporary storage of collNivelesAccesos to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initNivelesAccesos()
	{
		if ($this->collNivelesAccesos === null) {
			$this->collNivelesAccesos = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Usuario has previously
	 * been saved, it will retrieve related NivelesAccesos from storage.
	 * If this Usuario is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getNivelesAccesos($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNivelesAccesos === null) {
			if ($this->isNew()) {
			   $this->collNivelesAccesos = array();
			} else {

				$criteria->add(NivelesAccesoPeer::CA_LOGIN, $this->getCaLogin());

				NivelesAccesoPeer::addSelectColumns($criteria);
				$this->collNivelesAccesos = NivelesAccesoPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(NivelesAccesoPeer::CA_LOGIN, $this->getCaLogin());

				NivelesAccesoPeer::addSelectColumns($criteria);
				if (!isset($this->lastNivelesAccesoCriteria) || !$this->lastNivelesAccesoCriteria->equals($criteria)) {
					$this->collNivelesAccesos = NivelesAccesoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastNivelesAccesoCriteria = $criteria;
		return $this->collNivelesAccesos;
	}

	/**
	 * Returns the number of related NivelesAccesos.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countNivelesAccesos($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(NivelesAccesoPeer::CA_LOGIN, $this->getCaLogin());

		return NivelesAccesoPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a NivelesAcceso object to this object
	 * through the NivelesAcceso foreign key attribute
	 *
	 * @param      NivelesAcceso $l NivelesAcceso
	 * @return     void
	 * @throws     PropelException
	 */
	public function addNivelesAcceso(NivelesAcceso $l)
	{
		$this->collNivelesAccesos[] = $l;
		$l->setUsuario($this);
	}

	/**
	 * Temporary storage of collAccesoUsuarios to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initAccesoUsuarios()
	{
		if ($this->collAccesoUsuarios === null) {
			$this->collAccesoUsuarios = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Usuario has previously
	 * been saved, it will retrieve related AccesoUsuarios from storage.
	 * If this Usuario is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getAccesoUsuarios($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAccesoUsuarios === null) {
			if ($this->isNew()) {
			   $this->collAccesoUsuarios = array();
			} else {

				$criteria->add(AccesoUsuarioPeer::CA_LOGIN, $this->getCaLogin());

				AccesoUsuarioPeer::addSelectColumns($criteria);
				$this->collAccesoUsuarios = AccesoUsuarioPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(AccesoUsuarioPeer::CA_LOGIN, $this->getCaLogin());

				AccesoUsuarioPeer::addSelectColumns($criteria);
				if (!isset($this->lastAccesoUsuarioCriteria) || !$this->lastAccesoUsuarioCriteria->equals($criteria)) {
					$this->collAccesoUsuarios = AccesoUsuarioPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAccesoUsuarioCriteria = $criteria;
		return $this->collAccesoUsuarios;
	}

	/**
	 * Returns the number of related AccesoUsuarios.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countAccesoUsuarios($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(AccesoUsuarioPeer::CA_LOGIN, $this->getCaLogin());

		return AccesoUsuarioPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a AccesoUsuario object to this object
	 * through the AccesoUsuario foreign key attribute
	 *
	 * @param      AccesoUsuario $l AccesoUsuario
	 * @return     void
	 * @throws     PropelException
	 */
	public function addAccesoUsuario(AccesoUsuario $l)
	{
		$this->collAccesoUsuarios[] = $l;
		$l->setUsuario($this);
	}

	/**
	 * Temporary storage of collCotizacions to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initCotizacions()
	{
		if ($this->collCotizacions === null) {
			$this->collCotizacions = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Usuario has previously
	 * been saved, it will retrieve related Cotizacions from storage.
	 * If this Usuario is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getCotizacions($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotizacions === null) {
			if ($this->isNew()) {
			   $this->collCotizacions = array();
			} else {

				$criteria->add(CotizacionPeer::CA_USUARIO, $this->getCaLogin());

				CotizacionPeer::addSelectColumns($criteria);
				$this->collCotizacions = CotizacionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CotizacionPeer::CA_USUARIO, $this->getCaLogin());

				CotizacionPeer::addSelectColumns($criteria);
				if (!isset($this->lastCotizacionCriteria) || !$this->lastCotizacionCriteria->equals($criteria)) {
					$this->collCotizacions = CotizacionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCotizacionCriteria = $criteria;
		return $this->collCotizacions;
	}

	/**
	 * Returns the number of related Cotizacions.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countCotizacions($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CotizacionPeer::CA_USUARIO, $this->getCaLogin());

		return CotizacionPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Cotizacion object to this object
	 * through the Cotizacion foreign key attribute
	 *
	 * @param      Cotizacion $l Cotizacion
	 * @return     void
	 * @throws     PropelException
	 */
	public function addCotizacion(Cotizacion $l)
	{
		$this->collCotizacions[] = $l;
		$l->setUsuario($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Usuario is new, it will return
	 * an empty collection; or if this Usuario has previously
	 * been saved, it will retrieve related Cotizacions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Usuario.
	 */
	public function getCotizacionsJoinContacto($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotizacions === null) {
			if ($this->isNew()) {
				$this->collCotizacions = array();
			} else {

				$criteria->add(CotizacionPeer::CA_USUARIO, $this->getCaLogin());

				$this->collCotizacions = CotizacionPeer::doSelectJoinContacto($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CotizacionPeer::CA_USUARIO, $this->getCaLogin());

			if (!isset($this->lastCotizacionCriteria) || !$this->lastCotizacionCriteria->equals($criteria)) {
				$this->collCotizacions = CotizacionPeer::doSelectJoinContacto($criteria, $con);
			}
		}
		$this->lastCotizacionCriteria = $criteria;

		return $this->collCotizacions;
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
	 * Otherwise if this Usuario has previously
	 * been saved, it will retrieve related Reportes from storage.
	 * If this Usuario is new, it will return
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

				$criteria->add(ReportePeer::CA_LOGIN, $this->getCaLogin());

				ReportePeer::addSelectColumns($criteria);
				$this->collReportes = ReportePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ReportePeer::CA_LOGIN, $this->getCaLogin());

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

		$criteria->add(ReportePeer::CA_LOGIN, $this->getCaLogin());

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
		$l->setUsuario($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Usuario is new, it will return
	 * an empty collection; or if this Usuario has previously
	 * been saved, it will retrieve related Reportes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Usuario.
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

				$criteria->add(ReportePeer::CA_LOGIN, $this->getCaLogin());

				$this->collReportes = ReportePeer::doSelectJoinTransportador($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ReportePeer::CA_LOGIN, $this->getCaLogin());

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
	 * Otherwise if this Usuario is new, it will return
	 * an empty collection; or if this Usuario has previously
	 * been saved, it will retrieve related Reportes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Usuario.
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

				$criteria->add(ReportePeer::CA_LOGIN, $this->getCaLogin());

				$this->collReportes = ReportePeer::doSelectJoinTercero($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ReportePeer::CA_LOGIN, $this->getCaLogin());

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
	 * Otherwise if this Usuario is new, it will return
	 * an empty collection; or if this Usuario has previously
	 * been saved, it will retrieve related Reportes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Usuario.
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

				$criteria->add(ReportePeer::CA_LOGIN, $this->getCaLogin());

				$this->collReportes = ReportePeer::doSelectJoinAgente($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ReportePeer::CA_LOGIN, $this->getCaLogin());

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
	 * Otherwise if this Usuario is new, it will return
	 * an empty collection; or if this Usuario has previously
	 * been saved, it will retrieve related Reportes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Usuario.
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

				$criteria->add(ReportePeer::CA_LOGIN, $this->getCaLogin());

				$this->collReportes = ReportePeer::doSelectJoinBodega($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ReportePeer::CA_LOGIN, $this->getCaLogin());

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinBodega($criteria, $con);
			}
		}
		$this->lastReporteCriteria = $criteria;

		return $this->collReportes;
	}

} // BaseUsuario
