<?php

/**
 * Base class that represents a row from the 'tb_concliente' table.
 *
 * 
 *
 * @package    lib.model.public.om
 */
abstract class BaseContacto extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        ContactoPeer
	 */
	protected static $peer;


	/**
	 * The value for the ca_idcontacto field.
	 * @var        int
	 */
	protected $ca_idcontacto;


	/**
	 * The value for the ca_idcliente field.
	 * @var        int
	 */
	protected $ca_idcliente;


	/**
	 * The value for the ca_papellido field.
	 * @var        string
	 */
	protected $ca_papellido;


	/**
	 * The value for the ca_sapellido field.
	 * @var        string
	 */
	protected $ca_sapellido;


	/**
	 * The value for the ca_nombres field.
	 * @var        string
	 */
	protected $ca_nombres;


	/**
	 * The value for the ca_saludo field.
	 * @var        string
	 */
	protected $ca_saludo;


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
	 * The value for the ca_email field.
	 * @var        string
	 */
	protected $ca_email;


	/**
	 * The value for the ca_observaciones field.
	 * @var        string
	 */
	protected $ca_observaciones;


	/**
	 * The value for the ca_fchcreado field.
	 * @var        int
	 */
	protected $ca_fchcreado;


	/**
	 * The value for the ca_fchactualizado field.
	 * @var        int
	 */
	protected $ca_fchactualizado;


	/**
	 * The value for the ca_usucreado field.
	 * @var        string
	 */
	protected $ca_usucreado;


	/**
	 * The value for the ca_usuactualizado field.
	 * @var        string
	 */
	protected $ca_usuactualizado;


	/**
	 * The value for the ca_cumpleanos field.
	 * @var        string
	 */
	protected $ca_cumpleanos;

	/**
	 * @var        Cliente
	 */
	protected $aCliente;

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
	 * Collection to store aggregation of collTrackingUsers.
	 * @var        array
	 */
	protected $collTrackingUsers;

	/**
	 * The criteria used to select the current contents of collTrackingUsers.
	 * @var        Criteria
	 */
	protected $lastTrackingUserCriteria = null;

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
	 * @return     int
	 */
	public function getCaIdcontacto()
	{

		return $this->ca_idcontacto;
	}

	/**
	 * Get the [ca_idcliente] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdcliente()
	{

		return $this->ca_idcliente;
	}

	/**
	 * Get the [ca_papellido] column value.
	 * 
	 * @return     string
	 */
	public function getCaPapellido()
	{

		return $this->ca_papellido;
	}

	/**
	 * Get the [ca_sapellido] column value.
	 * 
	 * @return     string
	 */
	public function getCaSapellido()
	{

		return $this->ca_sapellido;
	}

	/**
	 * Get the [ca_nombres] column value.
	 * 
	 * @return     string
	 */
	public function getCaNombres()
	{

		return $this->ca_nombres;
	}

	/**
	 * Get the [ca_saludo] column value.
	 * 
	 * @return     string
	 */
	public function getCaSaludo()
	{

		return $this->ca_saludo;
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
	 * Get the [ca_email] column value.
	 * 
	 * @return     string
	 */
	public function getCaEmail()
	{

		return $this->ca_email;
	}

	/**
	 * Get the [ca_observaciones] column value.
	 * 
	 * @return     string
	 */
	public function getCaObservaciones()
	{

		return $this->ca_observaciones;
	}

	/**
	 * Get the [optionally formatted] [ca_fchcreado] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchcreado($format = 'Y-m-d')
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
	 * Get the [optionally formatted] [ca_fchactualizado] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchactualizado($format = 'Y-m-d')
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
	 * Get the [ca_usucreado] column value.
	 * 
	 * @return     string
	 */
	public function getCaUsucreado()
	{

		return $this->ca_usucreado;
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
	 * Get the [ca_cumpleanos] column value.
	 * 
	 * @return     string
	 */
	public function getCaCumpleanos()
	{

		return $this->ca_cumpleanos;
	}

	/**
	 * Set the value of [ca_idcontacto] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdcontacto($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idcontacto !== $v) {
			$this->ca_idcontacto = $v;
			$this->modifiedColumns[] = ContactoPeer::CA_IDCONTACTO;
		}

	} // setCaIdcontacto()

	/**
	 * Set the value of [ca_idcliente] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdcliente($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idcliente !== $v) {
			$this->ca_idcliente = $v;
			$this->modifiedColumns[] = ContactoPeer::CA_IDCLIENTE;
		}

		if ($this->aCliente !== null && $this->aCliente->getCaIdcliente() !== $v) {
			$this->aCliente = null;
		}

	} // setCaIdcliente()

	/**
	 * Set the value of [ca_papellido] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaPapellido($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_papellido !== $v) {
			$this->ca_papellido = $v;
			$this->modifiedColumns[] = ContactoPeer::CA_PAPELLIDO;
		}

	} // setCaPapellido()

	/**
	 * Set the value of [ca_sapellido] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaSapellido($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_sapellido !== $v) {
			$this->ca_sapellido = $v;
			$this->modifiedColumns[] = ContactoPeer::CA_SAPELLIDO;
		}

	} // setCaSapellido()

	/**
	 * Set the value of [ca_nombres] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaNombres($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_nombres !== $v) {
			$this->ca_nombres = $v;
			$this->modifiedColumns[] = ContactoPeer::CA_NOMBRES;
		}

	} // setCaNombres()

	/**
	 * Set the value of [ca_saludo] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaSaludo($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_saludo !== $v) {
			$this->ca_saludo = $v;
			$this->modifiedColumns[] = ContactoPeer::CA_SALUDO;
		}

	} // setCaSaludo()

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
			$this->modifiedColumns[] = ContactoPeer::CA_CARGO;
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
			$this->modifiedColumns[] = ContactoPeer::CA_DEPARTAMENTO;
		}

	} // setCaDepartamento()

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
			$this->modifiedColumns[] = ContactoPeer::CA_TELEFONOS;
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
			$this->modifiedColumns[] = ContactoPeer::CA_FAX;
		}

	} // setCaFax()

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
			$this->modifiedColumns[] = ContactoPeer::CA_EMAIL;
		}

	} // setCaEmail()

	/**
	 * Set the value of [ca_observaciones] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaObservaciones($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_observaciones !== $v) {
			$this->ca_observaciones = $v;
			$this->modifiedColumns[] = ContactoPeer::CA_OBSERVACIONES;
		}

	} // setCaObservaciones()

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
			$this->modifiedColumns[] = ContactoPeer::CA_FCHCREADO;
		}

	} // setCaFchcreado()

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
			$this->modifiedColumns[] = ContactoPeer::CA_FCHACTUALIZADO;
		}

	} // setCaFchactualizado()

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
			$this->modifiedColumns[] = ContactoPeer::CA_USUCREADO;
		}

	} // setCaUsucreado()

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
			$this->modifiedColumns[] = ContactoPeer::CA_USUACTUALIZADO;
		}

	} // setCaUsuactualizado()

	/**
	 * Set the value of [ca_cumpleanos] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaCumpleanos($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_cumpleanos !== $v) {
			$this->ca_cumpleanos = $v;
			$this->modifiedColumns[] = ContactoPeer::CA_CUMPLEANOS;
		}

	} // setCaCumpleanos()

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

			$this->ca_idcontacto = $rs->getInt($startcol + 0);

			$this->ca_idcliente = $rs->getInt($startcol + 1);

			$this->ca_papellido = $rs->getString($startcol + 2);

			$this->ca_sapellido = $rs->getString($startcol + 3);

			$this->ca_nombres = $rs->getString($startcol + 4);

			$this->ca_saludo = $rs->getString($startcol + 5);

			$this->ca_cargo = $rs->getString($startcol + 6);

			$this->ca_departamento = $rs->getString($startcol + 7);

			$this->ca_telefonos = $rs->getString($startcol + 8);

			$this->ca_fax = $rs->getString($startcol + 9);

			$this->ca_email = $rs->getString($startcol + 10);

			$this->ca_observaciones = $rs->getString($startcol + 11);

			$this->ca_fchcreado = $rs->getDate($startcol + 12, null);

			$this->ca_fchactualizado = $rs->getDate($startcol + 13, null);

			$this->ca_usucreado = $rs->getString($startcol + 14);

			$this->ca_usuactualizado = $rs->getString($startcol + 15);

			$this->ca_cumpleanos = $rs->getString($startcol + 16);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 17; // 17 = ContactoPeer::NUM_COLUMNS - ContactoPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Contacto object", $e);
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
			$con = Propel::getConnection(ContactoPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ContactoPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(ContactoPeer::DATABASE_NAME);
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

			if ($this->aCliente !== null) {
				if ($this->aCliente->isModified()) {
					$affectedRows += $this->aCliente->save($con);
				}
				$this->setCliente($this->aCliente);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ContactoPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += ContactoPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collCotizacions !== null) {
				foreach($this->collCotizacions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collTrackingUsers !== null) {
				foreach($this->collTrackingUsers as $referrerFK) {
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

			if ($this->aCliente !== null) {
				if (!$this->aCliente->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCliente->getValidationFailures());
				}
			}


			if (($retval = ContactoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collCotizacions !== null) {
					foreach($this->collCotizacions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collTrackingUsers !== null) {
					foreach($this->collTrackingUsers as $referrerFK) {
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
		$pos = ContactoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdcliente();
				break;
			case 2:
				return $this->getCaPapellido();
				break;
			case 3:
				return $this->getCaSapellido();
				break;
			case 4:
				return $this->getCaNombres();
				break;
			case 5:
				return $this->getCaSaludo();
				break;
			case 6:
				return $this->getCaCargo();
				break;
			case 7:
				return $this->getCaDepartamento();
				break;
			case 8:
				return $this->getCaTelefonos();
				break;
			case 9:
				return $this->getCaFax();
				break;
			case 10:
				return $this->getCaEmail();
				break;
			case 11:
				return $this->getCaObservaciones();
				break;
			case 12:
				return $this->getCaFchcreado();
				break;
			case 13:
				return $this->getCaFchactualizado();
				break;
			case 14:
				return $this->getCaUsucreado();
				break;
			case 15:
				return $this->getCaUsuactualizado();
				break;
			case 16:
				return $this->getCaCumpleanos();
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
		$keys = ContactoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdcontacto(),
			$keys[1] => $this->getCaIdcliente(),
			$keys[2] => $this->getCaPapellido(),
			$keys[3] => $this->getCaSapellido(),
			$keys[4] => $this->getCaNombres(),
			$keys[5] => $this->getCaSaludo(),
			$keys[6] => $this->getCaCargo(),
			$keys[7] => $this->getCaDepartamento(),
			$keys[8] => $this->getCaTelefonos(),
			$keys[9] => $this->getCaFax(),
			$keys[10] => $this->getCaEmail(),
			$keys[11] => $this->getCaObservaciones(),
			$keys[12] => $this->getCaFchcreado(),
			$keys[13] => $this->getCaFchactualizado(),
			$keys[14] => $this->getCaUsucreado(),
			$keys[15] => $this->getCaUsuactualizado(),
			$keys[16] => $this->getCaCumpleanos(),
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
		$pos = ContactoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdcliente($value);
				break;
			case 2:
				$this->setCaPapellido($value);
				break;
			case 3:
				$this->setCaSapellido($value);
				break;
			case 4:
				$this->setCaNombres($value);
				break;
			case 5:
				$this->setCaSaludo($value);
				break;
			case 6:
				$this->setCaCargo($value);
				break;
			case 7:
				$this->setCaDepartamento($value);
				break;
			case 8:
				$this->setCaTelefonos($value);
				break;
			case 9:
				$this->setCaFax($value);
				break;
			case 10:
				$this->setCaEmail($value);
				break;
			case 11:
				$this->setCaObservaciones($value);
				break;
			case 12:
				$this->setCaFchcreado($value);
				break;
			case 13:
				$this->setCaFchactualizado($value);
				break;
			case 14:
				$this->setCaUsucreado($value);
				break;
			case 15:
				$this->setCaUsuactualizado($value);
				break;
			case 16:
				$this->setCaCumpleanos($value);
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
		$keys = ContactoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdcontacto($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdcliente($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaPapellido($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaSapellido($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaNombres($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaSaludo($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaCargo($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaDepartamento($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaTelefonos($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaFax($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaEmail($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaObservaciones($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaFchcreado($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaFchactualizado($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaUsucreado($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaUsuactualizado($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCaCumpleanos($arr[$keys[16]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(ContactoPeer::DATABASE_NAME);

		if ($this->isColumnModified(ContactoPeer::CA_IDCONTACTO)) $criteria->add(ContactoPeer::CA_IDCONTACTO, $this->ca_idcontacto);
		if ($this->isColumnModified(ContactoPeer::CA_IDCLIENTE)) $criteria->add(ContactoPeer::CA_IDCLIENTE, $this->ca_idcliente);
		if ($this->isColumnModified(ContactoPeer::CA_PAPELLIDO)) $criteria->add(ContactoPeer::CA_PAPELLIDO, $this->ca_papellido);
		if ($this->isColumnModified(ContactoPeer::CA_SAPELLIDO)) $criteria->add(ContactoPeer::CA_SAPELLIDO, $this->ca_sapellido);
		if ($this->isColumnModified(ContactoPeer::CA_NOMBRES)) $criteria->add(ContactoPeer::CA_NOMBRES, $this->ca_nombres);
		if ($this->isColumnModified(ContactoPeer::CA_SALUDO)) $criteria->add(ContactoPeer::CA_SALUDO, $this->ca_saludo);
		if ($this->isColumnModified(ContactoPeer::CA_CARGO)) $criteria->add(ContactoPeer::CA_CARGO, $this->ca_cargo);
		if ($this->isColumnModified(ContactoPeer::CA_DEPARTAMENTO)) $criteria->add(ContactoPeer::CA_DEPARTAMENTO, $this->ca_departamento);
		if ($this->isColumnModified(ContactoPeer::CA_TELEFONOS)) $criteria->add(ContactoPeer::CA_TELEFONOS, $this->ca_telefonos);
		if ($this->isColumnModified(ContactoPeer::CA_FAX)) $criteria->add(ContactoPeer::CA_FAX, $this->ca_fax);
		if ($this->isColumnModified(ContactoPeer::CA_EMAIL)) $criteria->add(ContactoPeer::CA_EMAIL, $this->ca_email);
		if ($this->isColumnModified(ContactoPeer::CA_OBSERVACIONES)) $criteria->add(ContactoPeer::CA_OBSERVACIONES, $this->ca_observaciones);
		if ($this->isColumnModified(ContactoPeer::CA_FCHCREADO)) $criteria->add(ContactoPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(ContactoPeer::CA_FCHACTUALIZADO)) $criteria->add(ContactoPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(ContactoPeer::CA_USUCREADO)) $criteria->add(ContactoPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(ContactoPeer::CA_USUACTUALIZADO)) $criteria->add(ContactoPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);
		if ($this->isColumnModified(ContactoPeer::CA_CUMPLEANOS)) $criteria->add(ContactoPeer::CA_CUMPLEANOS, $this->ca_cumpleanos);

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
		$criteria = new Criteria(ContactoPeer::DATABASE_NAME);

		$criteria->add(ContactoPeer::CA_IDCONTACTO, $this->ca_idcontacto);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdcontacto();
	}

	/**
	 * Generic method to set the primary key (ca_idcontacto column).
	 *
	 * @param      int $key Primary key.
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
	 * @param      object $copyObj An object of Contacto (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdcliente($this->ca_idcliente);

		$copyObj->setCaPapellido($this->ca_papellido);

		$copyObj->setCaSapellido($this->ca_sapellido);

		$copyObj->setCaNombres($this->ca_nombres);

		$copyObj->setCaSaludo($this->ca_saludo);

		$copyObj->setCaCargo($this->ca_cargo);

		$copyObj->setCaDepartamento($this->ca_departamento);

		$copyObj->setCaTelefonos($this->ca_telefonos);

		$copyObj->setCaFax($this->ca_fax);

		$copyObj->setCaEmail($this->ca_email);

		$copyObj->setCaObservaciones($this->ca_observaciones);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);

		$copyObj->setCaCumpleanos($this->ca_cumpleanos);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getCotizacions() as $relObj) {
				$copyObj->addCotizacion($relObj->copy($deepCopy));
			}

			foreach($this->getTrackingUsers() as $relObj) {
				$copyObj->addTrackingUser($relObj->copy($deepCopy));
			}

		} // if ($deepCopy)


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
	 * @return     Contacto Clone of current object.
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
	 * @return     ContactoPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ContactoPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Cliente object.
	 *
	 * @param      Cliente $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setCliente($v)
	{


		if ($v === null) {
			$this->setCaIdcliente(NULL);
		} else {
			$this->setCaIdcliente($v->getCaIdcliente());
		}


		$this->aCliente = $v;
	}


	/**
	 * Get the associated Cliente object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Cliente The associated Cliente object.
	 * @throws     PropelException
	 */
	public function getCliente($con = null)
	{
		if ($this->aCliente === null && ($this->ca_idcliente !== null)) {
			// include the related Peer class
			$this->aCliente = ClientePeer::retrieveByPK($this->ca_idcliente, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = ClientePeer::retrieveByPK($this->ca_idcliente, $con);
			   $obj->addClientes($this);
			 */
		}
		return $this->aCliente;
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
	 * Otherwise if this Contacto has previously
	 * been saved, it will retrieve related Cotizacions from storage.
	 * If this Contacto is new, it will return
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

				$criteria->add(CotizacionPeer::CA_IDCONTACTO, $this->getCaIdcontacto());

				CotizacionPeer::addSelectColumns($criteria);
				$this->collCotizacions = CotizacionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CotizacionPeer::CA_IDCONTACTO, $this->getCaIdcontacto());

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

		$criteria->add(CotizacionPeer::CA_IDCONTACTO, $this->getCaIdcontacto());

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
		$l->setContacto($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Contacto is new, it will return
	 * an empty collection; or if this Contacto has previously
	 * been saved, it will retrieve related Cotizacions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Contacto.
	 */
	public function getCotizacionsJoinUsuario($criteria = null, $con = null)
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

				$criteria->add(CotizacionPeer::CA_IDCONTACTO, $this->getCaIdcontacto());

				$this->collCotizacions = CotizacionPeer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CotizacionPeer::CA_IDCONTACTO, $this->getCaIdcontacto());

			if (!isset($this->lastCotizacionCriteria) || !$this->lastCotizacionCriteria->equals($criteria)) {
				$this->collCotizacions = CotizacionPeer::doSelectJoinUsuario($criteria, $con);
			}
		}
		$this->lastCotizacionCriteria = $criteria;

		return $this->collCotizacions;
	}

	/**
	 * Temporary storage of collTrackingUsers to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initTrackingUsers()
	{
		if ($this->collTrackingUsers === null) {
			$this->collTrackingUsers = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Contacto has previously
	 * been saved, it will retrieve related TrackingUsers from storage.
	 * If this Contacto is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getTrackingUsers($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTrackingUsers === null) {
			if ($this->isNew()) {
			   $this->collTrackingUsers = array();
			} else {

				$criteria->add(TrackingUserPeer::CA_IDCONTACTO, $this->getCaIdcontacto());

				TrackingUserPeer::addSelectColumns($criteria);
				$this->collTrackingUsers = TrackingUserPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(TrackingUserPeer::CA_IDCONTACTO, $this->getCaIdcontacto());

				TrackingUserPeer::addSelectColumns($criteria);
				if (!isset($this->lastTrackingUserCriteria) || !$this->lastTrackingUserCriteria->equals($criteria)) {
					$this->collTrackingUsers = TrackingUserPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastTrackingUserCriteria = $criteria;
		return $this->collTrackingUsers;
	}

	/**
	 * Returns the number of related TrackingUsers.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countTrackingUsers($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(TrackingUserPeer::CA_IDCONTACTO, $this->getCaIdcontacto());

		return TrackingUserPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a TrackingUser object to this object
	 * through the TrackingUser foreign key attribute
	 *
	 * @param      TrackingUser $l TrackingUser
	 * @return     void
	 * @throws     PropelException
	 */
	public function addTrackingUser(TrackingUser $l)
	{
		$this->collTrackingUsers[] = $l;
		$l->setContacto($this);
	}

} // BaseContacto
