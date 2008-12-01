<?php

/**
 * Base class that represents a row from the 'tb_contactos' table.
 *
 * 
 *
 * @package    lib.model.public.om
 */
abstract class BaseContactoAgente extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        ContactoAgentePeer
	 */
	protected static $peer;


	/**
	 * The value for the ca_idcontacto field.
	 * @var        string
	 */
	protected $ca_idcontacto;


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
	 * The value for the ca_email field.
	 * @var        string
	 */
	protected $ca_email;


	/**
	 * The value for the ca_impoexpo field.
	 * @var        string
	 */
	protected $ca_impoexpo;


	/**
	 * The value for the ca_transporte field.
	 * @var        string
	 */
	protected $ca_transporte;


	/**
	 * The value for the ca_cargo field.
	 * @var        string
	 */
	protected $ca_cargo;


	/**
	 * The value for the ca_detalle field.
	 * @var        string
	 */
	protected $ca_detalle;


	/**
	 * The value for the ca_sugerido field.
	 * @var        boolean
	 */
	protected $ca_sugerido;

	/**
	 * @var        Agente
	 */
	protected $aAgente;

	/**
	 * @var        Ciudad
	 */
	protected $aCiudad;

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
	 * Get the [ca_idcontacto] column value.
	 * 
	 * @return     string
	 */
	public function getCaIdcontacto()
	{

		return $this->ca_idcontacto;
	}

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
	 * Get the [ca_email] column value.
	 * 
	 * @return     string
	 */
	public function getCaEmail()
	{

		return $this->ca_email;
	}

	/**
	 * Get the [ca_impoexpo] column value.
	 * 
	 * @return     string
	 */
	public function getCaImpoexpo()
	{

		return $this->ca_impoexpo;
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
	 * Get the [ca_cargo] column value.
	 * 
	 * @return     string
	 */
	public function getCaCargo()
	{

		return $this->ca_cargo;
	}

	/**
	 * Get the [ca_detalle] column value.
	 * 
	 * @return     string
	 */
	public function getCaDetalle()
	{

		return $this->ca_detalle;
	}

	/**
	 * Get the [ca_sugerido] column value.
	 * 
	 * @return     boolean
	 */
	public function getCaSugerido()
	{

		return $this->ca_sugerido;
	}

	/**
	 * Set the value of [ca_idcontacto] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaIdcontacto($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_idcontacto !== $v) {
			$this->ca_idcontacto = $v;
			$this->modifiedColumns[] = ContactoAgentePeer::CA_IDCONTACTO;
		}

	} // setCaIdcontacto()

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
			$this->modifiedColumns[] = ContactoAgentePeer::CA_IDAGENTE;
		}

		if ($this->aAgente !== null && $this->aAgente->getCaIdagente() !== $v) {
			$this->aAgente = null;
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
			$this->modifiedColumns[] = ContactoAgentePeer::CA_NOMBRE;
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
			$this->modifiedColumns[] = ContactoAgentePeer::CA_DIRECCION;
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
			$this->modifiedColumns[] = ContactoAgentePeer::CA_TELEFONOS;
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
			$this->modifiedColumns[] = ContactoAgentePeer::CA_FAX;
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
			$this->modifiedColumns[] = ContactoAgentePeer::CA_IDCIUDAD;
		}

		if ($this->aCiudad !== null && $this->aCiudad->getCaIdciudad() !== $v) {
			$this->aCiudad = null;
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
			$this->modifiedColumns[] = ContactoAgentePeer::CA_EMAIL;
		}

	} // setCaEmail()

	/**
	 * Set the value of [ca_impoexpo] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaImpoexpo($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_impoexpo !== $v) {
			$this->ca_impoexpo = $v;
			$this->modifiedColumns[] = ContactoAgentePeer::CA_IMPOEXPO;
		}

	} // setCaImpoexpo()

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
			$this->modifiedColumns[] = ContactoAgentePeer::CA_TRANSPORTE;
		}

	} // setCaTransporte()

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
			$this->modifiedColumns[] = ContactoAgentePeer::CA_CARGO;
		}

	} // setCaCargo()

	/**
	 * Set the value of [ca_detalle] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaDetalle($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_detalle !== $v) {
			$this->ca_detalle = $v;
			$this->modifiedColumns[] = ContactoAgentePeer::CA_DETALLE;
		}

	} // setCaDetalle()

	/**
	 * Set the value of [ca_sugerido] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setCaSugerido($v)
	{

		if ($this->ca_sugerido !== $v) {
			$this->ca_sugerido = $v;
			$this->modifiedColumns[] = ContactoAgentePeer::CA_SUGERIDO;
		}

	} // setCaSugerido()

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

			$this->ca_idcontacto = $rs->getString($startcol + 0);

			$this->ca_idagente = $rs->getInt($startcol + 1);

			$this->ca_nombre = $rs->getString($startcol + 2);

			$this->ca_direccion = $rs->getString($startcol + 3);

			$this->ca_telefonos = $rs->getString($startcol + 4);

			$this->ca_fax = $rs->getString($startcol + 5);

			$this->ca_idciudad = $rs->getString($startcol + 6);

			$this->ca_email = $rs->getString($startcol + 7);

			$this->ca_impoexpo = $rs->getString($startcol + 8);

			$this->ca_transporte = $rs->getString($startcol + 9);

			$this->ca_cargo = $rs->getString($startcol + 10);

			$this->ca_detalle = $rs->getString($startcol + 11);

			$this->ca_sugerido = $rs->getBoolean($startcol + 12);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 13; // 13 = ContactoAgentePeer::NUM_COLUMNS - ContactoAgentePeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating ContactoAgente object", $e);
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
			$con = Propel::getConnection(ContactoAgentePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ContactoAgentePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(ContactoAgentePeer::DATABASE_NAME);
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

			if ($this->aAgente !== null) {
				if ($this->aAgente->isModified()) {
					$affectedRows += $this->aAgente->save($con);
				}
				$this->setAgente($this->aAgente);
			}

			if ($this->aCiudad !== null) {
				if ($this->aCiudad->isModified()) {
					$affectedRows += $this->aCiudad->save($con);
				}
				$this->setCiudad($this->aCiudad);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ContactoAgentePeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += ContactoAgentePeer::doUpdate($this, $con);
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

			if ($this->aAgente !== null) {
				if (!$this->aAgente->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAgente->getValidationFailures());
				}
			}

			if ($this->aCiudad !== null) {
				if (!$this->aCiudad->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCiudad->getValidationFailures());
				}
			}


			if (($retval = ContactoAgentePeer::doValidate($this, $columns)) !== true) {
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
		$pos = ContactoAgentePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdcontacto();
				break;
			case 1:
				return $this->getCaIdagente();
				break;
			case 2:
				return $this->getCaNombre();
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
				return $this->getCaImpoexpo();
				break;
			case 9:
				return $this->getCaTransporte();
				break;
			case 10:
				return $this->getCaCargo();
				break;
			case 11:
				return $this->getCaDetalle();
				break;
			case 12:
				return $this->getCaSugerido();
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
		$keys = ContactoAgentePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdcontacto(),
			$keys[1] => $this->getCaIdagente(),
			$keys[2] => $this->getCaNombre(),
			$keys[3] => $this->getCaDireccion(),
			$keys[4] => $this->getCaTelefonos(),
			$keys[5] => $this->getCaFax(),
			$keys[6] => $this->getCaIdciudad(),
			$keys[7] => $this->getCaEmail(),
			$keys[8] => $this->getCaImpoexpo(),
			$keys[9] => $this->getCaTransporte(),
			$keys[10] => $this->getCaCargo(),
			$keys[11] => $this->getCaDetalle(),
			$keys[12] => $this->getCaSugerido(),
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
		$pos = ContactoAgentePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdcontacto($value);
				break;
			case 1:
				$this->setCaIdagente($value);
				break;
			case 2:
				$this->setCaNombre($value);
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
				$this->setCaImpoexpo($value);
				break;
			case 9:
				$this->setCaTransporte($value);
				break;
			case 10:
				$this->setCaCargo($value);
				break;
			case 11:
				$this->setCaDetalle($value);
				break;
			case 12:
				$this->setCaSugerido($value);
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
		$keys = ContactoAgentePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdcontacto($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdagente($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaNombre($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaDireccion($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaTelefonos($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaFax($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaIdciudad($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaEmail($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaImpoexpo($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaTransporte($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaCargo($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaDetalle($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaSugerido($arr[$keys[12]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(ContactoAgentePeer::DATABASE_NAME);

		if ($this->isColumnModified(ContactoAgentePeer::CA_IDCONTACTO)) $criteria->add(ContactoAgentePeer::CA_IDCONTACTO, $this->ca_idcontacto);
		if ($this->isColumnModified(ContactoAgentePeer::CA_IDAGENTE)) $criteria->add(ContactoAgentePeer::CA_IDAGENTE, $this->ca_idagente);
		if ($this->isColumnModified(ContactoAgentePeer::CA_NOMBRE)) $criteria->add(ContactoAgentePeer::CA_NOMBRE, $this->ca_nombre);
		if ($this->isColumnModified(ContactoAgentePeer::CA_DIRECCION)) $criteria->add(ContactoAgentePeer::CA_DIRECCION, $this->ca_direccion);
		if ($this->isColumnModified(ContactoAgentePeer::CA_TELEFONOS)) $criteria->add(ContactoAgentePeer::CA_TELEFONOS, $this->ca_telefonos);
		if ($this->isColumnModified(ContactoAgentePeer::CA_FAX)) $criteria->add(ContactoAgentePeer::CA_FAX, $this->ca_fax);
		if ($this->isColumnModified(ContactoAgentePeer::CA_IDCIUDAD)) $criteria->add(ContactoAgentePeer::CA_IDCIUDAD, $this->ca_idciudad);
		if ($this->isColumnModified(ContactoAgentePeer::CA_EMAIL)) $criteria->add(ContactoAgentePeer::CA_EMAIL, $this->ca_email);
		if ($this->isColumnModified(ContactoAgentePeer::CA_IMPOEXPO)) $criteria->add(ContactoAgentePeer::CA_IMPOEXPO, $this->ca_impoexpo);
		if ($this->isColumnModified(ContactoAgentePeer::CA_TRANSPORTE)) $criteria->add(ContactoAgentePeer::CA_TRANSPORTE, $this->ca_transporte);
		if ($this->isColumnModified(ContactoAgentePeer::CA_CARGO)) $criteria->add(ContactoAgentePeer::CA_CARGO, $this->ca_cargo);
		if ($this->isColumnModified(ContactoAgentePeer::CA_DETALLE)) $criteria->add(ContactoAgentePeer::CA_DETALLE, $this->ca_detalle);
		if ($this->isColumnModified(ContactoAgentePeer::CA_SUGERIDO)) $criteria->add(ContactoAgentePeer::CA_SUGERIDO, $this->ca_sugerido);

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
		$criteria = new Criteria(ContactoAgentePeer::DATABASE_NAME);

		$criteria->add(ContactoAgentePeer::CA_IDCONTACTO, $this->ca_idcontacto);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     string
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdcontacto();
	}

	/**
	 * Generic method to set the primary key (ca_idcontacto column).
	 *
	 * @param      string $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdcontacto($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of ContactoAgente (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdagente($this->ca_idagente);

		$copyObj->setCaNombre($this->ca_nombre);

		$copyObj->setCaDireccion($this->ca_direccion);

		$copyObj->setCaTelefonos($this->ca_telefonos);

		$copyObj->setCaFax($this->ca_fax);

		$copyObj->setCaIdciudad($this->ca_idciudad);

		$copyObj->setCaEmail($this->ca_email);

		$copyObj->setCaImpoexpo($this->ca_impoexpo);

		$copyObj->setCaTransporte($this->ca_transporte);

		$copyObj->setCaCargo($this->ca_cargo);

		$copyObj->setCaDetalle($this->ca_detalle);

		$copyObj->setCaSugerido($this->ca_sugerido);


		$copyObj->setNew(true);

		$copyObj->setCaIdcontacto(NULL); // this is a pkey column, so set to default value

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
	 * @return     ContactoAgente Clone of current object.
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
	 * @return     ContactoAgentePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ContactoAgentePeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Agente object.
	 *
	 * @param      Agente $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setAgente($v)
	{


		if ($v === null) {
			$this->setCaIdagente(NULL);
		} else {
			$this->setCaIdagente($v->getCaIdagente());
		}


		$this->aAgente = $v;
	}


	/**
	 * Get the associated Agente object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Agente The associated Agente object.
	 * @throws     PropelException
	 */
	public function getAgente($con = null)
	{
		if ($this->aAgente === null && ($this->ca_idagente !== null)) {
			// include the related Peer class
			$this->aAgente = AgentePeer::retrieveByPK($this->ca_idagente, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = AgentePeer::retrieveByPK($this->ca_idagente, $con);
			   $obj->addAgentes($this);
			 */
		}
		return $this->aAgente;
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

} // BaseContactoAgente
