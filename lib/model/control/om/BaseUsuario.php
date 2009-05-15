<?php

/**
 * Base class that represents a row from the 'control.tb_usuarios' table.
 *
 * 
 *
 * @package    lib.model.control.om
 */
abstract class BaseUsuario extends BaseObject  implements Persistent {


  const PEER = 'UsuarioPeer';

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
	 * The value for the ca_idsucursal field.
	 * @var        string
	 */
	protected $ca_idsucursal;

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
	 * The value for the ca_authmethod field.
	 * @var        string
	 */
	protected $ca_authmethod;

	/**
	 * The value for the ca_passwd field.
	 * @var        string
	 */
	protected $ca_passwd;

	/**
	 * The value for the ca_salt field.
	 * @var        string
	 */
	protected $ca_salt;

	/**
	 * The value for the ca_activo field.
	 * @var        boolean
	 */
	protected $ca_activo;

	/**
	 * The value for the ca_forcechange field.
	 * @var        boolean
	 */
	protected $ca_forcechange;

	/**
	 * @var        Sucursal
	 */
	protected $aSucursal;

	/**
	 * @var        array NivelesAcceso[] Collection to store aggregation of NivelesAcceso objects.
	 */
	protected $collNivelesAccesos;

	/**
	 * @var        Criteria The criteria used to select the current contents of collNivelesAccesos.
	 */
	private $lastNivelesAccesoCriteria = null;

	/**
	 * @var        array AccesoUsuario[] Collection to store aggregation of AccesoUsuario objects.
	 */
	protected $collAccesoUsuarios;

	/**
	 * @var        Criteria The criteria used to select the current contents of collAccesoUsuarios.
	 */
	private $lastAccesoUsuarioCriteria = null;

	/**
	 * @var        array Cotizacion[] Collection to store aggregation of Cotizacion objects.
	 */
	protected $collCotizacions;

	/**
	 * @var        Criteria The criteria used to select the current contents of collCotizacions.
	 */
	private $lastCotizacionCriteria = null;

	/**
	 * @var        array HdeskTicket[] Collection to store aggregation of HdeskTicket objects.
	 */
	protected $collHdeskTickets;

	/**
	 * @var        Criteria The criteria used to select the current contents of collHdeskTickets.
	 */
	private $lastHdeskTicketCriteria = null;

	/**
	 * @var        array HdeskResponse[] Collection to store aggregation of HdeskResponse objects.
	 */
	protected $collHdeskResponses;

	/**
	 * @var        Criteria The criteria used to select the current contents of collHdeskResponses.
	 */
	private $lastHdeskResponseCriteria = null;

	/**
	 * @var        array HdeskUserGroup[] Collection to store aggregation of HdeskUserGroup objects.
	 */
	protected $collHdeskUserGroups;

	/**
	 * @var        Criteria The criteria used to select the current contents of collHdeskUserGroups.
	 */
	private $lastHdeskUserGroupCriteria = null;

	/**
	 * @var        array HdeskKBase[] Collection to store aggregation of HdeskKBase objects.
	 */
	protected $collHdeskKBases;

	/**
	 * @var        Criteria The criteria used to select the current contents of collHdeskKBases.
	 */
	private $lastHdeskKBaseCriteria = null;

	/**
	 * @var        array Notificacion[] Collection to store aggregation of Notificacion objects.
	 */
	protected $collNotificacions;

	/**
	 * @var        Criteria The criteria used to select the current contents of collNotificacions.
	 */
	private $lastNotificacionCriteria = null;

	/**
	 * @var        array NotTareaAsignacion[] Collection to store aggregation of NotTareaAsignacion objects.
	 */
	protected $collNotTareaAsignacions;

	/**
	 * @var        Criteria The criteria used to select the current contents of collNotTareaAsignacions.
	 */
	private $lastNotTareaAsignacionCriteria = null;

	/**
	 * @var        array Reporte[] Collection to store aggregation of Reporte objects.
	 */
	protected $collReportes;

	/**
	 * @var        Criteria The criteria used to select the current contents of collReportes.
	 */
	private $lastReporteCriteria = null;

	/**
	 * @var        array RepStatusRespuesta[] Collection to store aggregation of RepStatusRespuesta objects.
	 */
	protected $collRepStatusRespuestas;

	/**
	 * @var        Criteria The criteria used to select the current contents of collRepStatusRespuestas.
	 */
	private $lastRepStatusRespuestaCriteria = null;

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
	 * Initializes internal state of BaseUsuario object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
	}

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
	 * Get the [ca_idsucursal] column value.
	 * 
	 * @return     string
	 */
	public function getCaIdsucursal()
	{
		return $this->ca_idsucursal;
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
	 * Get the [ca_authmethod] column value.
	 * 
	 * @return     string
	 */
	public function getCaAuthmethod()
	{
		return $this->ca_authmethod;
	}

	/**
	 * Get the [ca_passwd] column value.
	 * 
	 * @return     string
	 */
	public function getCaPasswd()
	{
		return $this->ca_passwd;
	}

	/**
	 * Get the [ca_salt] column value.
	 * 
	 * @return     string
	 */
	public function getCaSalt()
	{
		return $this->ca_salt;
	}

	/**
	 * Get the [ca_activo] column value.
	 * 
	 * @return     boolean
	 */
	public function getCaActivo()
	{
		return $this->ca_activo;
	}

	/**
	 * Get the [ca_forcechange] column value.
	 * 
	 * @return     boolean
	 */
	public function getCaForcechange()
	{
		return $this->ca_forcechange;
	}

	/**
	 * Set the value of [ca_login] column.
	 * 
	 * @param      string $v new value
	 * @return     Usuario The current object (for fluent API support)
	 */
	public function setCaLogin($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_login !== $v) {
			$this->ca_login = $v;
			$this->modifiedColumns[] = UsuarioPeer::CA_LOGIN;
		}

		return $this;
	} // setCaLogin()

	/**
	 * Set the value of [ca_nombre] column.
	 * 
	 * @param      string $v new value
	 * @return     Usuario The current object (for fluent API support)
	 */
	public function setCaNombre($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_nombre !== $v) {
			$this->ca_nombre = $v;
			$this->modifiedColumns[] = UsuarioPeer::CA_NOMBRE;
		}

		return $this;
	} // setCaNombre()

	/**
	 * Set the value of [ca_cargo] column.
	 * 
	 * @param      string $v new value
	 * @return     Usuario The current object (for fluent API support)
	 */
	public function setCaCargo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_cargo !== $v) {
			$this->ca_cargo = $v;
			$this->modifiedColumns[] = UsuarioPeer::CA_CARGO;
		}

		return $this;
	} // setCaCargo()

	/**
	 * Set the value of [ca_departamento] column.
	 * 
	 * @param      string $v new value
	 * @return     Usuario The current object (for fluent API support)
	 */
	public function setCaDepartamento($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_departamento !== $v) {
			$this->ca_departamento = $v;
			$this->modifiedColumns[] = UsuarioPeer::CA_DEPARTAMENTO;
		}

		return $this;
	} // setCaDepartamento()

	/**
	 * Set the value of [ca_idsucursal] column.
	 * 
	 * @param      string $v new value
	 * @return     Usuario The current object (for fluent API support)
	 */
	public function setCaIdsucursal($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idsucursal !== $v) {
			$this->ca_idsucursal = $v;
			$this->modifiedColumns[] = UsuarioPeer::CA_IDSUCURSAL;
		}

		if ($this->aSucursal !== null && $this->aSucursal->getCaIdsucursal() !== $v) {
			$this->aSucursal = null;
		}

		return $this;
	} // setCaIdsucursal()

	/**
	 * Set the value of [ca_email] column.
	 * 
	 * @param      string $v new value
	 * @return     Usuario The current object (for fluent API support)
	 */
	public function setCaEmail($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_email !== $v) {
			$this->ca_email = $v;
			$this->modifiedColumns[] = UsuarioPeer::CA_EMAIL;
		}

		return $this;
	} // setCaEmail()

	/**
	 * Set the value of [ca_rutinas] column.
	 * 
	 * @param      string $v new value
	 * @return     Usuario The current object (for fluent API support)
	 */
	public function setCaRutinas($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_rutinas !== $v) {
			$this->ca_rutinas = $v;
			$this->modifiedColumns[] = UsuarioPeer::CA_RUTINAS;
		}

		return $this;
	} // setCaRutinas()

	/**
	 * Set the value of [ca_extension] column.
	 * 
	 * @param      string $v new value
	 * @return     Usuario The current object (for fluent API support)
	 */
	public function setCaExtension($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_extension !== $v) {
			$this->ca_extension = $v;
			$this->modifiedColumns[] = UsuarioPeer::CA_EXTENSION;
		}

		return $this;
	} // setCaExtension()

	/**
	 * Set the value of [ca_authmethod] column.
	 * 
	 * @param      string $v new value
	 * @return     Usuario The current object (for fluent API support)
	 */
	public function setCaAuthmethod($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_authmethod !== $v) {
			$this->ca_authmethod = $v;
			$this->modifiedColumns[] = UsuarioPeer::CA_AUTHMETHOD;
		}

		return $this;
	} // setCaAuthmethod()

	/**
	 * Set the value of [ca_passwd] column.
	 * 
	 * @param      string $v new value
	 * @return     Usuario The current object (for fluent API support)
	 */
	public function setCaPasswd($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_passwd !== $v) {
			$this->ca_passwd = $v;
			$this->modifiedColumns[] = UsuarioPeer::CA_PASSWD;
		}

		return $this;
	} // setCaPasswd()

	/**
	 * Set the value of [ca_salt] column.
	 * 
	 * @param      string $v new value
	 * @return     Usuario The current object (for fluent API support)
	 */
	public function setCaSalt($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_salt !== $v) {
			$this->ca_salt = $v;
			$this->modifiedColumns[] = UsuarioPeer::CA_SALT;
		}

		return $this;
	} // setCaSalt()

	/**
	 * Set the value of [ca_activo] column.
	 * 
	 * @param      boolean $v new value
	 * @return     Usuario The current object (for fluent API support)
	 */
	public function setCaActivo($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->ca_activo !== $v) {
			$this->ca_activo = $v;
			$this->modifiedColumns[] = UsuarioPeer::CA_ACTIVO;
		}

		return $this;
	} // setCaActivo()

	/**
	 * Set the value of [ca_forcechange] column.
	 * 
	 * @param      boolean $v new value
	 * @return     Usuario The current object (for fluent API support)
	 */
	public function setCaForcechange($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->ca_forcechange !== $v) {
			$this->ca_forcechange = $v;
			$this->modifiedColumns[] = UsuarioPeer::CA_FORCECHANGE;
		}

		return $this;
	} // setCaForcechange()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
			// First, ensure that we don't have any columns that have been modified which aren't default columns.
			if (array_diff($this->modifiedColumns, array())) {
				return false;
			}

		// otherwise, everything was equal, so return TRUE
		return true;
	} // hasOnlyDefaultValues()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (0-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->ca_login = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ca_nombre = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_cargo = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_departamento = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_idsucursal = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_email = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_rutinas = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_extension = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_authmethod = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_passwd = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_salt = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_activo = ($row[$startcol + 11] !== null) ? (boolean) $row[$startcol + 11] : null;
			$this->ca_forcechange = ($row[$startcol + 12] !== null) ? (boolean) $row[$startcol + 12] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 13; // 13 = UsuarioPeer::NUM_COLUMNS - UsuarioPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Usuario object", $e);
		}
	}

	/**
	 * Checks and repairs the internal consistency of the object.
	 *
	 * This method is executed after an already-instantiated object is re-hydrated
	 * from the database.  It exists to check any foreign keys to make sure that
	 * the objects related to the current object are correct based on foreign key.
	 *
	 * You can override this method in the stub class, but you should always invoke
	 * the base method from the overridden method (i.e. parent::ensureConsistency()),
	 * in case your model changes.
	 *
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

		if ($this->aSucursal !== null && $this->ca_idsucursal !== $this->aSucursal->getCaIdsucursal()) {
			$this->aSucursal = null;
		}
	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
	 */
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(UsuarioPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = UsuarioPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aSucursal = null;
			$this->collNivelesAccesos = null;
			$this->lastNivelesAccesoCriteria = null;

			$this->collAccesoUsuarios = null;
			$this->lastAccesoUsuarioCriteria = null;

			$this->collCotizacions = null;
			$this->lastCotizacionCriteria = null;

			$this->collHdeskTickets = null;
			$this->lastHdeskTicketCriteria = null;

			$this->collHdeskResponses = null;
			$this->lastHdeskResponseCriteria = null;

			$this->collHdeskUserGroups = null;
			$this->lastHdeskUserGroupCriteria = null;

			$this->collHdeskKBases = null;
			$this->lastHdeskKBaseCriteria = null;

			$this->collNotificacions = null;
			$this->lastNotificacionCriteria = null;

			$this->collNotTareaAsignacions = null;
			$this->lastNotTareaAsignacionCriteria = null;

			$this->collReportes = null;
			$this->lastReporteCriteria = null;

			$this->collRepStatusRespuestas = null;
			$this->lastRepStatusRespuestaCriteria = null;

		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(UsuarioPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			UsuarioPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Persists this object to the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All modified related objects will also be persisted in the doSave()
	 * method.  This method wraps all precipitate database operations in a
	 * single transaction.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(UsuarioPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			UsuarioPeer::addInstanceToPool($this);
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs the work of inserting or updating the row in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aSucursal !== null) {
				if ($this->aSucursal->isModified() || $this->aSucursal->isNew()) {
					$affectedRows += $this->aSucursal->save($con);
				}
				$this->setSucursal($this->aSucursal);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = UsuarioPeer::CA_LOGIN;
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
				foreach ($this->collNivelesAccesos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collAccesoUsuarios !== null) {
				foreach ($this->collAccesoUsuarios as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCotizacions !== null) {
				foreach ($this->collCotizacions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collHdeskTickets !== null) {
				foreach ($this->collHdeskTickets as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collHdeskResponses !== null) {
				foreach ($this->collHdeskResponses as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collHdeskUserGroups !== null) {
				foreach ($this->collHdeskUserGroups as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collHdeskKBases !== null) {
				foreach ($this->collHdeskKBases as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collNotificacions !== null) {
				foreach ($this->collNotificacions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collNotTareaAsignacions !== null) {
				foreach ($this->collNotTareaAsignacions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collReportes !== null) {
				foreach ($this->collReportes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRepStatusRespuestas !== null) {
				foreach ($this->collRepStatusRespuestas as $referrerFK) {
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
					foreach ($this->collNivelesAccesos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collAccesoUsuarios !== null) {
					foreach ($this->collAccesoUsuarios as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCotizacions !== null) {
					foreach ($this->collCotizacions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collHdeskTickets !== null) {
					foreach ($this->collHdeskTickets as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collHdeskResponses !== null) {
					foreach ($this->collHdeskResponses as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collHdeskUserGroups !== null) {
					foreach ($this->collHdeskUserGroups as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collHdeskKBases !== null) {
					foreach ($this->collHdeskKBases as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collNotificacions !== null) {
					foreach ($this->collNotificacions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collNotTareaAsignacions !== null) {
					foreach ($this->collNotTareaAsignacions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collReportes !== null) {
					foreach ($this->collReportes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRepStatusRespuestas !== null) {
					foreach ($this->collRepStatusRespuestas as $referrerFK) {
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
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = UsuarioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
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
				return $this->getCaIdsucursal();
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
			case 8:
				return $this->getCaAuthmethod();
				break;
			case 9:
				return $this->getCaPasswd();
				break;
			case 10:
				return $this->getCaSalt();
				break;
			case 11:
				return $this->getCaActivo();
				break;
			case 12:
				return $this->getCaForcechange();
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
	 * @param      string $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                        BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. Defaults to BasePeer::TYPE_PHPNAME.
	 * @param      boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns.  Defaults to TRUE.
	 * @return     an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = UsuarioPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaLogin(),
			$keys[1] => $this->getCaNombre(),
			$keys[2] => $this->getCaCargo(),
			$keys[3] => $this->getCaDepartamento(),
			$keys[4] => $this->getCaIdsucursal(),
			$keys[5] => $this->getCaEmail(),
			$keys[6] => $this->getCaRutinas(),
			$keys[7] => $this->getCaExtension(),
			$keys[8] => $this->getCaAuthmethod(),
			$keys[9] => $this->getCaPasswd(),
			$keys[10] => $this->getCaSalt(),
			$keys[11] => $this->getCaActivo(),
			$keys[12] => $this->getCaForcechange(),
		);
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
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
				$this->setCaIdsucursal($value);
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
			case 8:
				$this->setCaAuthmethod($value);
				break;
			case 9:
				$this->setCaPasswd($value);
				break;
			case 10:
				$this->setCaSalt($value);
				break;
			case 11:
				$this->setCaActivo($value);
				break;
			case 12:
				$this->setCaForcechange($value);
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
	 * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 * The default key type is the column's phpname (e.g. 'AuthorId')
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
		if (array_key_exists($keys[4], $arr)) $this->setCaIdsucursal($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaEmail($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaRutinas($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaExtension($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaAuthmethod($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaPasswd($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaSalt($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaActivo($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaForcechange($arr[$keys[12]]);
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
		if ($this->isColumnModified(UsuarioPeer::CA_IDSUCURSAL)) $criteria->add(UsuarioPeer::CA_IDSUCURSAL, $this->ca_idsucursal);
		if ($this->isColumnModified(UsuarioPeer::CA_EMAIL)) $criteria->add(UsuarioPeer::CA_EMAIL, $this->ca_email);
		if ($this->isColumnModified(UsuarioPeer::CA_RUTINAS)) $criteria->add(UsuarioPeer::CA_RUTINAS, $this->ca_rutinas);
		if ($this->isColumnModified(UsuarioPeer::CA_EXTENSION)) $criteria->add(UsuarioPeer::CA_EXTENSION, $this->ca_extension);
		if ($this->isColumnModified(UsuarioPeer::CA_AUTHMETHOD)) $criteria->add(UsuarioPeer::CA_AUTHMETHOD, $this->ca_authmethod);
		if ($this->isColumnModified(UsuarioPeer::CA_PASSWD)) $criteria->add(UsuarioPeer::CA_PASSWD, $this->ca_passwd);
		if ($this->isColumnModified(UsuarioPeer::CA_SALT)) $criteria->add(UsuarioPeer::CA_SALT, $this->ca_salt);
		if ($this->isColumnModified(UsuarioPeer::CA_ACTIVO)) $criteria->add(UsuarioPeer::CA_ACTIVO, $this->ca_activo);
		if ($this->isColumnModified(UsuarioPeer::CA_FORCECHANGE)) $criteria->add(UsuarioPeer::CA_FORCECHANGE, $this->ca_forcechange);

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

		$copyObj->setCaIdsucursal($this->ca_idsucursal);

		$copyObj->setCaEmail($this->ca_email);

		$copyObj->setCaRutinas($this->ca_rutinas);

		$copyObj->setCaExtension($this->ca_extension);

		$copyObj->setCaAuthmethod($this->ca_authmethod);

		$copyObj->setCaPasswd($this->ca_passwd);

		$copyObj->setCaSalt($this->ca_salt);

		$copyObj->setCaActivo($this->ca_activo);

		$copyObj->setCaForcechange($this->ca_forcechange);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getNivelesAccesos() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addNivelesAcceso($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getAccesoUsuarios() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addAccesoUsuario($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getCotizacions() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addCotizacion($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getHdeskTickets() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addHdeskTicket($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getHdeskResponses() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addHdeskResponse($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getHdeskUserGroups() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addHdeskUserGroup($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getHdeskKBases() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addHdeskKBase($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getNotificacions() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addNotificacion($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getNotTareaAsignacions() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addNotTareaAsignacion($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getReportes() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addReporte($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getRepStatusRespuestas() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addRepStatusRespuesta($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setCaLogin(NULL); // this is a auto-increment column, so set to default value

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
	 * @return     Usuario The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setSucursal(Sucursal $v = null)
	{
		if ($v === null) {
			$this->setCaIdsucursal(NULL);
		} else {
			$this->setCaIdsucursal($v->getCaIdsucursal());
		}

		$this->aSucursal = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Sucursal object, it will not be re-added.
		if ($v !== null) {
			$v->addUsuario($this);
		}

		return $this;
	}


	/**
	 * Get the associated Sucursal object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Sucursal The associated Sucursal object.
	 * @throws     PropelException
	 */
	public function getSucursal(PropelPDO $con = null)
	{
		if ($this->aSucursal === null && (($this->ca_idsucursal !== "" && $this->ca_idsucursal !== null))) {
			$c = new Criteria(SucursalPeer::DATABASE_NAME);
			$c->add(SucursalPeer::CA_IDSUCURSAL, $this->ca_idsucursal);
			$this->aSucursal = SucursalPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aSucursal->addUsuarios($this);
			 */
		}
		return $this->aSucursal;
	}

	/**
	 * Clears out the collNivelesAccesos collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addNivelesAccesos()
	 */
	public function clearNivelesAccesos()
	{
		$this->collNivelesAccesos = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collNivelesAccesos collection (array).
	 *
	 * By default this just sets the collNivelesAccesos collection to an empty array (like clearcollNivelesAccesos());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initNivelesAccesos()
	{
		$this->collNivelesAccesos = array();
	}

	/**
	 * Gets an array of NivelesAcceso objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Usuario has previously been saved, it will retrieve
	 * related NivelesAccesos from storage. If this Usuario is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array NivelesAcceso[]
	 * @throws     PropelException
	 */
	public function getNivelesAccesos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNivelesAccesos === null) {
			if ($this->isNew()) {
			   $this->collNivelesAccesos = array();
			} else {

				$criteria->add(NivelesAccesoPeer::CA_LOGIN, $this->ca_login);

				NivelesAccesoPeer::addSelectColumns($criteria);
				$this->collNivelesAccesos = NivelesAccesoPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(NivelesAccesoPeer::CA_LOGIN, $this->ca_login);

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
	 * Returns the number of related NivelesAcceso objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related NivelesAcceso objects.
	 * @throws     PropelException
	 */
	public function countNivelesAccesos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collNivelesAccesos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(NivelesAccesoPeer::CA_LOGIN, $this->ca_login);

				$count = NivelesAccesoPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(NivelesAccesoPeer::CA_LOGIN, $this->ca_login);

				if (!isset($this->lastNivelesAccesoCriteria) || !$this->lastNivelesAccesoCriteria->equals($criteria)) {
					$count = NivelesAccesoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collNivelesAccesos);
				}
			} else {
				$count = count($this->collNivelesAccesos);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a NivelesAcceso object to this object
	 * through the NivelesAcceso foreign key attribute.
	 *
	 * @param      NivelesAcceso $l NivelesAcceso
	 * @return     void
	 * @throws     PropelException
	 */
	public function addNivelesAcceso(NivelesAcceso $l)
	{
		if ($this->collNivelesAccesos === null) {
			$this->initNivelesAccesos();
		}
		if (!in_array($l, $this->collNivelesAccesos, true)) { // only add it if the **same** object is not already associated
			array_push($this->collNivelesAccesos, $l);
			$l->setUsuario($this);
		}
	}

	/**
	 * Clears out the collAccesoUsuarios collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addAccesoUsuarios()
	 */
	public function clearAccesoUsuarios()
	{
		$this->collAccesoUsuarios = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collAccesoUsuarios collection (array).
	 *
	 * By default this just sets the collAccesoUsuarios collection to an empty array (like clearcollAccesoUsuarios());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initAccesoUsuarios()
	{
		$this->collAccesoUsuarios = array();
	}

	/**
	 * Gets an array of AccesoUsuario objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Usuario has previously been saved, it will retrieve
	 * related AccesoUsuarios from storage. If this Usuario is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array AccesoUsuario[]
	 * @throws     PropelException
	 */
	public function getAccesoUsuarios($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAccesoUsuarios === null) {
			if ($this->isNew()) {
			   $this->collAccesoUsuarios = array();
			} else {

				$criteria->add(AccesoUsuarioPeer::CA_LOGIN, $this->ca_login);

				AccesoUsuarioPeer::addSelectColumns($criteria);
				$this->collAccesoUsuarios = AccesoUsuarioPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(AccesoUsuarioPeer::CA_LOGIN, $this->ca_login);

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
	 * Returns the number of related AccesoUsuario objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related AccesoUsuario objects.
	 * @throws     PropelException
	 */
	public function countAccesoUsuarios(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collAccesoUsuarios === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(AccesoUsuarioPeer::CA_LOGIN, $this->ca_login);

				$count = AccesoUsuarioPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(AccesoUsuarioPeer::CA_LOGIN, $this->ca_login);

				if (!isset($this->lastAccesoUsuarioCriteria) || !$this->lastAccesoUsuarioCriteria->equals($criteria)) {
					$count = AccesoUsuarioPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collAccesoUsuarios);
				}
			} else {
				$count = count($this->collAccesoUsuarios);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a AccesoUsuario object to this object
	 * through the AccesoUsuario foreign key attribute.
	 *
	 * @param      AccesoUsuario $l AccesoUsuario
	 * @return     void
	 * @throws     PropelException
	 */
	public function addAccesoUsuario(AccesoUsuario $l)
	{
		if ($this->collAccesoUsuarios === null) {
			$this->initAccesoUsuarios();
		}
		if (!in_array($l, $this->collAccesoUsuarios, true)) { // only add it if the **same** object is not already associated
			array_push($this->collAccesoUsuarios, $l);
			$l->setUsuario($this);
		}
	}

	/**
	 * Clears out the collCotizacions collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addCotizacions()
	 */
	public function clearCotizacions()
	{
		$this->collCotizacions = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collCotizacions collection (array).
	 *
	 * By default this just sets the collCotizacions collection to an empty array (like clearcollCotizacions());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initCotizacions()
	{
		$this->collCotizacions = array();
	}

	/**
	 * Gets an array of Cotizacion objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Usuario has previously been saved, it will retrieve
	 * related Cotizacions from storage. If this Usuario is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array Cotizacion[]
	 * @throws     PropelException
	 */
	public function getCotizacions($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotizacions === null) {
			if ($this->isNew()) {
			   $this->collCotizacions = array();
			} else {

				$criteria->add(CotizacionPeer::CA_USUARIO, $this->ca_login);

				CotizacionPeer::addSelectColumns($criteria);
				$this->collCotizacions = CotizacionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CotizacionPeer::CA_USUARIO, $this->ca_login);

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
	 * Returns the number of related Cotizacion objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Cotizacion objects.
	 * @throws     PropelException
	 */
	public function countCotizacions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collCotizacions === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(CotizacionPeer::CA_USUARIO, $this->ca_login);

				$count = CotizacionPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(CotizacionPeer::CA_USUARIO, $this->ca_login);

				if (!isset($this->lastCotizacionCriteria) || !$this->lastCotizacionCriteria->equals($criteria)) {
					$count = CotizacionPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collCotizacions);
				}
			} else {
				$count = count($this->collCotizacions);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a Cotizacion object to this object
	 * through the Cotizacion foreign key attribute.
	 *
	 * @param      Cotizacion $l Cotizacion
	 * @return     void
	 * @throws     PropelException
	 */
	public function addCotizacion(Cotizacion $l)
	{
		if ($this->collCotizacions === null) {
			$this->initCotizacions();
		}
		if (!in_array($l, $this->collCotizacions, true)) { // only add it if the **same** object is not already associated
			array_push($this->collCotizacions, $l);
			$l->setUsuario($this);
		}
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
	public function getCotizacionsJoinContacto($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotizacions === null) {
			if ($this->isNew()) {
				$this->collCotizacions = array();
			} else {

				$criteria->add(CotizacionPeer::CA_USUARIO, $this->ca_login);

				$this->collCotizacions = CotizacionPeer::doSelectJoinContacto($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CotizacionPeer::CA_USUARIO, $this->ca_login);

			if (!isset($this->lastCotizacionCriteria) || !$this->lastCotizacionCriteria->equals($criteria)) {
				$this->collCotizacions = CotizacionPeer::doSelectJoinContacto($criteria, $con, $join_behavior);
			}
		}
		$this->lastCotizacionCriteria = $criteria;

		return $this->collCotizacions;
	}

	/**
	 * Clears out the collHdeskTickets collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addHdeskTickets()
	 */
	public function clearHdeskTickets()
	{
		$this->collHdeskTickets = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collHdeskTickets collection (array).
	 *
	 * By default this just sets the collHdeskTickets collection to an empty array (like clearcollHdeskTickets());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initHdeskTickets()
	{
		$this->collHdeskTickets = array();
	}

	/**
	 * Gets an array of HdeskTicket objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Usuario has previously been saved, it will retrieve
	 * related HdeskTickets from storage. If this Usuario is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array HdeskTicket[]
	 * @throws     PropelException
	 */
	public function getHdeskTickets($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskTickets === null) {
			if ($this->isNew()) {
			   $this->collHdeskTickets = array();
			} else {

				$criteria->add(HdeskTicketPeer::CA_LOGIN, $this->ca_login);

				HdeskTicketPeer::addSelectColumns($criteria);
				$this->collHdeskTickets = HdeskTicketPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(HdeskTicketPeer::CA_LOGIN, $this->ca_login);

				HdeskTicketPeer::addSelectColumns($criteria);
				if (!isset($this->lastHdeskTicketCriteria) || !$this->lastHdeskTicketCriteria->equals($criteria)) {
					$this->collHdeskTickets = HdeskTicketPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastHdeskTicketCriteria = $criteria;
		return $this->collHdeskTickets;
	}

	/**
	 * Returns the number of related HdeskTicket objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related HdeskTicket objects.
	 * @throws     PropelException
	 */
	public function countHdeskTickets(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collHdeskTickets === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(HdeskTicketPeer::CA_LOGIN, $this->ca_login);

				$count = HdeskTicketPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(HdeskTicketPeer::CA_LOGIN, $this->ca_login);

				if (!isset($this->lastHdeskTicketCriteria) || !$this->lastHdeskTicketCriteria->equals($criteria)) {
					$count = HdeskTicketPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collHdeskTickets);
				}
			} else {
				$count = count($this->collHdeskTickets);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a HdeskTicket object to this object
	 * through the HdeskTicket foreign key attribute.
	 *
	 * @param      HdeskTicket $l HdeskTicket
	 * @return     void
	 * @throws     PropelException
	 */
	public function addHdeskTicket(HdeskTicket $l)
	{
		if ($this->collHdeskTickets === null) {
			$this->initHdeskTickets();
		}
		if (!in_array($l, $this->collHdeskTickets, true)) { // only add it if the **same** object is not already associated
			array_push($this->collHdeskTickets, $l);
			$l->setUsuario($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Usuario is new, it will return
	 * an empty collection; or if this Usuario has previously
	 * been saved, it will retrieve related HdeskTickets from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Usuario.
	 */
	public function getHdeskTicketsJoinHdeskGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskTickets === null) {
			if ($this->isNew()) {
				$this->collHdeskTickets = array();
			} else {

				$criteria->add(HdeskTicketPeer::CA_LOGIN, $this->ca_login);

				$this->collHdeskTickets = HdeskTicketPeer::doSelectJoinHdeskGroup($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(HdeskTicketPeer::CA_LOGIN, $this->ca_login);

			if (!isset($this->lastHdeskTicketCriteria) || !$this->lastHdeskTicketCriteria->equals($criteria)) {
				$this->collHdeskTickets = HdeskTicketPeer::doSelectJoinHdeskGroup($criteria, $con, $join_behavior);
			}
		}
		$this->lastHdeskTicketCriteria = $criteria;

		return $this->collHdeskTickets;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Usuario is new, it will return
	 * an empty collection; or if this Usuario has previously
	 * been saved, it will retrieve related HdeskTickets from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Usuario.
	 */
	public function getHdeskTicketsJoinHdeskProject($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskTickets === null) {
			if ($this->isNew()) {
				$this->collHdeskTickets = array();
			} else {

				$criteria->add(HdeskTicketPeer::CA_LOGIN, $this->ca_login);

				$this->collHdeskTickets = HdeskTicketPeer::doSelectJoinHdeskProject($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(HdeskTicketPeer::CA_LOGIN, $this->ca_login);

			if (!isset($this->lastHdeskTicketCriteria) || !$this->lastHdeskTicketCriteria->equals($criteria)) {
				$this->collHdeskTickets = HdeskTicketPeer::doSelectJoinHdeskProject($criteria, $con, $join_behavior);
			}
		}
		$this->lastHdeskTicketCriteria = $criteria;

		return $this->collHdeskTickets;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Usuario is new, it will return
	 * an empty collection; or if this Usuario has previously
	 * been saved, it will retrieve related HdeskTickets from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Usuario.
	 */
	public function getHdeskTicketsJoinNotTarea($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskTickets === null) {
			if ($this->isNew()) {
				$this->collHdeskTickets = array();
			} else {

				$criteria->add(HdeskTicketPeer::CA_LOGIN, $this->ca_login);

				$this->collHdeskTickets = HdeskTicketPeer::doSelectJoinNotTarea($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(HdeskTicketPeer::CA_LOGIN, $this->ca_login);

			if (!isset($this->lastHdeskTicketCriteria) || !$this->lastHdeskTicketCriteria->equals($criteria)) {
				$this->collHdeskTickets = HdeskTicketPeer::doSelectJoinNotTarea($criteria, $con, $join_behavior);
			}
		}
		$this->lastHdeskTicketCriteria = $criteria;

		return $this->collHdeskTickets;
	}

	/**
	 * Clears out the collHdeskResponses collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addHdeskResponses()
	 */
	public function clearHdeskResponses()
	{
		$this->collHdeskResponses = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collHdeskResponses collection (array).
	 *
	 * By default this just sets the collHdeskResponses collection to an empty array (like clearcollHdeskResponses());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initHdeskResponses()
	{
		$this->collHdeskResponses = array();
	}

	/**
	 * Gets an array of HdeskResponse objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Usuario has previously been saved, it will retrieve
	 * related HdeskResponses from storage. If this Usuario is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array HdeskResponse[]
	 * @throws     PropelException
	 */
	public function getHdeskResponses($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskResponses === null) {
			if ($this->isNew()) {
			   $this->collHdeskResponses = array();
			} else {

				$criteria->add(HdeskResponsePeer::CA_LOGIN, $this->ca_login);

				HdeskResponsePeer::addSelectColumns($criteria);
				$this->collHdeskResponses = HdeskResponsePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(HdeskResponsePeer::CA_LOGIN, $this->ca_login);

				HdeskResponsePeer::addSelectColumns($criteria);
				if (!isset($this->lastHdeskResponseCriteria) || !$this->lastHdeskResponseCriteria->equals($criteria)) {
					$this->collHdeskResponses = HdeskResponsePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastHdeskResponseCriteria = $criteria;
		return $this->collHdeskResponses;
	}

	/**
	 * Returns the number of related HdeskResponse objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related HdeskResponse objects.
	 * @throws     PropelException
	 */
	public function countHdeskResponses(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collHdeskResponses === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(HdeskResponsePeer::CA_LOGIN, $this->ca_login);

				$count = HdeskResponsePeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(HdeskResponsePeer::CA_LOGIN, $this->ca_login);

				if (!isset($this->lastHdeskResponseCriteria) || !$this->lastHdeskResponseCriteria->equals($criteria)) {
					$count = HdeskResponsePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collHdeskResponses);
				}
			} else {
				$count = count($this->collHdeskResponses);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a HdeskResponse object to this object
	 * through the HdeskResponse foreign key attribute.
	 *
	 * @param      HdeskResponse $l HdeskResponse
	 * @return     void
	 * @throws     PropelException
	 */
	public function addHdeskResponse(HdeskResponse $l)
	{
		if ($this->collHdeskResponses === null) {
			$this->initHdeskResponses();
		}
		if (!in_array($l, $this->collHdeskResponses, true)) { // only add it if the **same** object is not already associated
			array_push($this->collHdeskResponses, $l);
			$l->setUsuario($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Usuario is new, it will return
	 * an empty collection; or if this Usuario has previously
	 * been saved, it will retrieve related HdeskResponses from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Usuario.
	 */
	public function getHdeskResponsesJoinHdeskTicket($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskResponses === null) {
			if ($this->isNew()) {
				$this->collHdeskResponses = array();
			} else {

				$criteria->add(HdeskResponsePeer::CA_LOGIN, $this->ca_login);

				$this->collHdeskResponses = HdeskResponsePeer::doSelectJoinHdeskTicket($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(HdeskResponsePeer::CA_LOGIN, $this->ca_login);

			if (!isset($this->lastHdeskResponseCriteria) || !$this->lastHdeskResponseCriteria->equals($criteria)) {
				$this->collHdeskResponses = HdeskResponsePeer::doSelectJoinHdeskTicket($criteria, $con, $join_behavior);
			}
		}
		$this->lastHdeskResponseCriteria = $criteria;

		return $this->collHdeskResponses;
	}

	/**
	 * Clears out the collHdeskUserGroups collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addHdeskUserGroups()
	 */
	public function clearHdeskUserGroups()
	{
		$this->collHdeskUserGroups = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collHdeskUserGroups collection (array).
	 *
	 * By default this just sets the collHdeskUserGroups collection to an empty array (like clearcollHdeskUserGroups());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initHdeskUserGroups()
	{
		$this->collHdeskUserGroups = array();
	}

	/**
	 * Gets an array of HdeskUserGroup objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Usuario has previously been saved, it will retrieve
	 * related HdeskUserGroups from storage. If this Usuario is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array HdeskUserGroup[]
	 * @throws     PropelException
	 */
	public function getHdeskUserGroups($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskUserGroups === null) {
			if ($this->isNew()) {
			   $this->collHdeskUserGroups = array();
			} else {

				$criteria->add(HdeskUserGroupPeer::CA_LOGIN, $this->ca_login);

				HdeskUserGroupPeer::addSelectColumns($criteria);
				$this->collHdeskUserGroups = HdeskUserGroupPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(HdeskUserGroupPeer::CA_LOGIN, $this->ca_login);

				HdeskUserGroupPeer::addSelectColumns($criteria);
				if (!isset($this->lastHdeskUserGroupCriteria) || !$this->lastHdeskUserGroupCriteria->equals($criteria)) {
					$this->collHdeskUserGroups = HdeskUserGroupPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastHdeskUserGroupCriteria = $criteria;
		return $this->collHdeskUserGroups;
	}

	/**
	 * Returns the number of related HdeskUserGroup objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related HdeskUserGroup objects.
	 * @throws     PropelException
	 */
	public function countHdeskUserGroups(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collHdeskUserGroups === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(HdeskUserGroupPeer::CA_LOGIN, $this->ca_login);

				$count = HdeskUserGroupPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(HdeskUserGroupPeer::CA_LOGIN, $this->ca_login);

				if (!isset($this->lastHdeskUserGroupCriteria) || !$this->lastHdeskUserGroupCriteria->equals($criteria)) {
					$count = HdeskUserGroupPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collHdeskUserGroups);
				}
			} else {
				$count = count($this->collHdeskUserGroups);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a HdeskUserGroup object to this object
	 * through the HdeskUserGroup foreign key attribute.
	 *
	 * @param      HdeskUserGroup $l HdeskUserGroup
	 * @return     void
	 * @throws     PropelException
	 */
	public function addHdeskUserGroup(HdeskUserGroup $l)
	{
		if ($this->collHdeskUserGroups === null) {
			$this->initHdeskUserGroups();
		}
		if (!in_array($l, $this->collHdeskUserGroups, true)) { // only add it if the **same** object is not already associated
			array_push($this->collHdeskUserGroups, $l);
			$l->setUsuario($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Usuario is new, it will return
	 * an empty collection; or if this Usuario has previously
	 * been saved, it will retrieve related HdeskUserGroups from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Usuario.
	 */
	public function getHdeskUserGroupsJoinHdeskGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskUserGroups === null) {
			if ($this->isNew()) {
				$this->collHdeskUserGroups = array();
			} else {

				$criteria->add(HdeskUserGroupPeer::CA_LOGIN, $this->ca_login);

				$this->collHdeskUserGroups = HdeskUserGroupPeer::doSelectJoinHdeskGroup($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(HdeskUserGroupPeer::CA_LOGIN, $this->ca_login);

			if (!isset($this->lastHdeskUserGroupCriteria) || !$this->lastHdeskUserGroupCriteria->equals($criteria)) {
				$this->collHdeskUserGroups = HdeskUserGroupPeer::doSelectJoinHdeskGroup($criteria, $con, $join_behavior);
			}
		}
		$this->lastHdeskUserGroupCriteria = $criteria;

		return $this->collHdeskUserGroups;
	}

	/**
	 * Clears out the collHdeskKBases collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addHdeskKBases()
	 */
	public function clearHdeskKBases()
	{
		$this->collHdeskKBases = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collHdeskKBases collection (array).
	 *
	 * By default this just sets the collHdeskKBases collection to an empty array (like clearcollHdeskKBases());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initHdeskKBases()
	{
		$this->collHdeskKBases = array();
	}

	/**
	 * Gets an array of HdeskKBase objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Usuario has previously been saved, it will retrieve
	 * related HdeskKBases from storage. If this Usuario is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array HdeskKBase[]
	 * @throws     PropelException
	 */
	public function getHdeskKBases($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskKBases === null) {
			if ($this->isNew()) {
			   $this->collHdeskKBases = array();
			} else {

				$criteria->add(HdeskKBasePeer::CA_LOGIN, $this->ca_login);

				HdeskKBasePeer::addSelectColumns($criteria);
				$this->collHdeskKBases = HdeskKBasePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(HdeskKBasePeer::CA_LOGIN, $this->ca_login);

				HdeskKBasePeer::addSelectColumns($criteria);
				if (!isset($this->lastHdeskKBaseCriteria) || !$this->lastHdeskKBaseCriteria->equals($criteria)) {
					$this->collHdeskKBases = HdeskKBasePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastHdeskKBaseCriteria = $criteria;
		return $this->collHdeskKBases;
	}

	/**
	 * Returns the number of related HdeskKBase objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related HdeskKBase objects.
	 * @throws     PropelException
	 */
	public function countHdeskKBases(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collHdeskKBases === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(HdeskKBasePeer::CA_LOGIN, $this->ca_login);

				$count = HdeskKBasePeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(HdeskKBasePeer::CA_LOGIN, $this->ca_login);

				if (!isset($this->lastHdeskKBaseCriteria) || !$this->lastHdeskKBaseCriteria->equals($criteria)) {
					$count = HdeskKBasePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collHdeskKBases);
				}
			} else {
				$count = count($this->collHdeskKBases);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a HdeskKBase object to this object
	 * through the HdeskKBase foreign key attribute.
	 *
	 * @param      HdeskKBase $l HdeskKBase
	 * @return     void
	 * @throws     PropelException
	 */
	public function addHdeskKBase(HdeskKBase $l)
	{
		if ($this->collHdeskKBases === null) {
			$this->initHdeskKBases();
		}
		if (!in_array($l, $this->collHdeskKBases, true)) { // only add it if the **same** object is not already associated
			array_push($this->collHdeskKBases, $l);
			$l->setUsuario($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Usuario is new, it will return
	 * an empty collection; or if this Usuario has previously
	 * been saved, it will retrieve related HdeskKBases from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Usuario.
	 */
	public function getHdeskKBasesJoinHdeskKBaseCategory($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskKBases === null) {
			if ($this->isNew()) {
				$this->collHdeskKBases = array();
			} else {

				$criteria->add(HdeskKBasePeer::CA_LOGIN, $this->ca_login);

				$this->collHdeskKBases = HdeskKBasePeer::doSelectJoinHdeskKBaseCategory($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(HdeskKBasePeer::CA_LOGIN, $this->ca_login);

			if (!isset($this->lastHdeskKBaseCriteria) || !$this->lastHdeskKBaseCriteria->equals($criteria)) {
				$this->collHdeskKBases = HdeskKBasePeer::doSelectJoinHdeskKBaseCategory($criteria, $con, $join_behavior);
			}
		}
		$this->lastHdeskKBaseCriteria = $criteria;

		return $this->collHdeskKBases;
	}

	/**
	 * Clears out the collNotificacions collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addNotificacions()
	 */
	public function clearNotificacions()
	{
		$this->collNotificacions = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collNotificacions collection (array).
	 *
	 * By default this just sets the collNotificacions collection to an empty array (like clearcollNotificacions());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initNotificacions()
	{
		$this->collNotificacions = array();
	}

	/**
	 * Gets an array of Notificacion objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Usuario has previously been saved, it will retrieve
	 * related Notificacions from storage. If this Usuario is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array Notificacion[]
	 * @throws     PropelException
	 */
	public function getNotificacions($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNotificacions === null) {
			if ($this->isNew()) {
			   $this->collNotificacions = array();
			} else {

				$criteria->add(NotificacionPeer::CA_LOGIN, $this->ca_login);

				NotificacionPeer::addSelectColumns($criteria);
				$this->collNotificacions = NotificacionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(NotificacionPeer::CA_LOGIN, $this->ca_login);

				NotificacionPeer::addSelectColumns($criteria);
				if (!isset($this->lastNotificacionCriteria) || !$this->lastNotificacionCriteria->equals($criteria)) {
					$this->collNotificacions = NotificacionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastNotificacionCriteria = $criteria;
		return $this->collNotificacions;
	}

	/**
	 * Returns the number of related Notificacion objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Notificacion objects.
	 * @throws     PropelException
	 */
	public function countNotificacions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collNotificacions === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(NotificacionPeer::CA_LOGIN, $this->ca_login);

				$count = NotificacionPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(NotificacionPeer::CA_LOGIN, $this->ca_login);

				if (!isset($this->lastNotificacionCriteria) || !$this->lastNotificacionCriteria->equals($criteria)) {
					$count = NotificacionPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collNotificacions);
				}
			} else {
				$count = count($this->collNotificacions);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a Notificacion object to this object
	 * through the Notificacion foreign key attribute.
	 *
	 * @param      Notificacion $l Notificacion
	 * @return     void
	 * @throws     PropelException
	 */
	public function addNotificacion(Notificacion $l)
	{
		if ($this->collNotificacions === null) {
			$this->initNotificacions();
		}
		if (!in_array($l, $this->collNotificacions, true)) { // only add it if the **same** object is not already associated
			array_push($this->collNotificacions, $l);
			$l->setUsuario($this);
		}
	}

	/**
	 * Clears out the collNotTareaAsignacions collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addNotTareaAsignacions()
	 */
	public function clearNotTareaAsignacions()
	{
		$this->collNotTareaAsignacions = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collNotTareaAsignacions collection (array).
	 *
	 * By default this just sets the collNotTareaAsignacions collection to an empty array (like clearcollNotTareaAsignacions());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initNotTareaAsignacions()
	{
		$this->collNotTareaAsignacions = array();
	}

	/**
	 * Gets an array of NotTareaAsignacion objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Usuario has previously been saved, it will retrieve
	 * related NotTareaAsignacions from storage. If this Usuario is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array NotTareaAsignacion[]
	 * @throws     PropelException
	 */
	public function getNotTareaAsignacions($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNotTareaAsignacions === null) {
			if ($this->isNew()) {
			   $this->collNotTareaAsignacions = array();
			} else {

				$criteria->add(NotTareaAsignacionPeer::CA_LOGIN, $this->ca_login);

				NotTareaAsignacionPeer::addSelectColumns($criteria);
				$this->collNotTareaAsignacions = NotTareaAsignacionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(NotTareaAsignacionPeer::CA_LOGIN, $this->ca_login);

				NotTareaAsignacionPeer::addSelectColumns($criteria);
				if (!isset($this->lastNotTareaAsignacionCriteria) || !$this->lastNotTareaAsignacionCriteria->equals($criteria)) {
					$this->collNotTareaAsignacions = NotTareaAsignacionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastNotTareaAsignacionCriteria = $criteria;
		return $this->collNotTareaAsignacions;
	}

	/**
	 * Returns the number of related NotTareaAsignacion objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related NotTareaAsignacion objects.
	 * @throws     PropelException
	 */
	public function countNotTareaAsignacions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collNotTareaAsignacions === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(NotTareaAsignacionPeer::CA_LOGIN, $this->ca_login);

				$count = NotTareaAsignacionPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(NotTareaAsignacionPeer::CA_LOGIN, $this->ca_login);

				if (!isset($this->lastNotTareaAsignacionCriteria) || !$this->lastNotTareaAsignacionCriteria->equals($criteria)) {
					$count = NotTareaAsignacionPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collNotTareaAsignacions);
				}
			} else {
				$count = count($this->collNotTareaAsignacions);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a NotTareaAsignacion object to this object
	 * through the NotTareaAsignacion foreign key attribute.
	 *
	 * @param      NotTareaAsignacion $l NotTareaAsignacion
	 * @return     void
	 * @throws     PropelException
	 */
	public function addNotTareaAsignacion(NotTareaAsignacion $l)
	{
		if ($this->collNotTareaAsignacions === null) {
			$this->initNotTareaAsignacions();
		}
		if (!in_array($l, $this->collNotTareaAsignacions, true)) { // only add it if the **same** object is not already associated
			array_push($this->collNotTareaAsignacions, $l);
			$l->setUsuario($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Usuario is new, it will return
	 * an empty collection; or if this Usuario has previously
	 * been saved, it will retrieve related NotTareaAsignacions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Usuario.
	 */
	public function getNotTareaAsignacionsJoinNotTarea($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNotTareaAsignacions === null) {
			if ($this->isNew()) {
				$this->collNotTareaAsignacions = array();
			} else {

				$criteria->add(NotTareaAsignacionPeer::CA_LOGIN, $this->ca_login);

				$this->collNotTareaAsignacions = NotTareaAsignacionPeer::doSelectJoinNotTarea($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(NotTareaAsignacionPeer::CA_LOGIN, $this->ca_login);

			if (!isset($this->lastNotTareaAsignacionCriteria) || !$this->lastNotTareaAsignacionCriteria->equals($criteria)) {
				$this->collNotTareaAsignacions = NotTareaAsignacionPeer::doSelectJoinNotTarea($criteria, $con, $join_behavior);
			}
		}
		$this->lastNotTareaAsignacionCriteria = $criteria;

		return $this->collNotTareaAsignacions;
	}

	/**
	 * Clears out the collReportes collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addReportes()
	 */
	public function clearReportes()
	{
		$this->collReportes = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collReportes collection (array).
	 *
	 * By default this just sets the collReportes collection to an empty array (like clearcollReportes());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initReportes()
	{
		$this->collReportes = array();
	}

	/**
	 * Gets an array of Reporte objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Usuario has previously been saved, it will retrieve
	 * related Reportes from storage. If this Usuario is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array Reporte[]
	 * @throws     PropelException
	 */
	public function getReportes($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
			   $this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_LOGIN, $this->ca_login);

				ReportePeer::addSelectColumns($criteria);
				$this->collReportes = ReportePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ReportePeer::CA_LOGIN, $this->ca_login);

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
	 * Returns the number of related Reporte objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Reporte objects.
	 * @throws     PropelException
	 */
	public function countReportes(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(ReportePeer::CA_LOGIN, $this->ca_login);

				$count = ReportePeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(ReportePeer::CA_LOGIN, $this->ca_login);

				if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
					$count = ReportePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collReportes);
				}
			} else {
				$count = count($this->collReportes);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a Reporte object to this object
	 * through the Reporte foreign key attribute.
	 *
	 * @param      Reporte $l Reporte
	 * @return     void
	 * @throws     PropelException
	 */
	public function addReporte(Reporte $l)
	{
		if ($this->collReportes === null) {
			$this->initReportes();
		}
		if (!in_array($l, $this->collReportes, true)) { // only add it if the **same** object is not already associated
			array_push($this->collReportes, $l);
			$l->setUsuario($this);
		}
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
	public function getReportesJoinTransportador($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_LOGIN, $this->ca_login);

				$this->collReportes = ReportePeer::doSelectJoinTransportador($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ReportePeer::CA_LOGIN, $this->ca_login);

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinTransportador($criteria, $con, $join_behavior);
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
	public function getReportesJoinTercero($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_LOGIN, $this->ca_login);

				$this->collReportes = ReportePeer::doSelectJoinTercero($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ReportePeer::CA_LOGIN, $this->ca_login);

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinTercero($criteria, $con, $join_behavior);
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
	public function getReportesJoinAgente($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_LOGIN, $this->ca_login);

				$this->collReportes = ReportePeer::doSelectJoinAgente($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ReportePeer::CA_LOGIN, $this->ca_login);

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinAgente($criteria, $con, $join_behavior);
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
	public function getReportesJoinBodega($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_LOGIN, $this->ca_login);

				$this->collReportes = ReportePeer::doSelectJoinBodega($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ReportePeer::CA_LOGIN, $this->ca_login);

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinBodega($criteria, $con, $join_behavior);
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
	public function getReportesJoinTrackingEtapa($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_LOGIN, $this->ca_login);

				$this->collReportes = ReportePeer::doSelectJoinTrackingEtapa($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ReportePeer::CA_LOGIN, $this->ca_login);

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinTrackingEtapa($criteria, $con, $join_behavior);
			}
		}
		$this->lastReporteCriteria = $criteria;

		return $this->collReportes;
	}

	/**
	 * Clears out the collRepStatusRespuestas collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addRepStatusRespuestas()
	 */
	public function clearRepStatusRespuestas()
	{
		$this->collRepStatusRespuestas = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collRepStatusRespuestas collection (array).
	 *
	 * By default this just sets the collRepStatusRespuestas collection to an empty array (like clearcollRepStatusRespuestas());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initRepStatusRespuestas()
	{
		$this->collRepStatusRespuestas = array();
	}

	/**
	 * Gets an array of RepStatusRespuesta objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Usuario has previously been saved, it will retrieve
	 * related RepStatusRespuestas from storage. If this Usuario is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array RepStatusRespuesta[]
	 * @throws     PropelException
	 */
	public function getRepStatusRespuestas($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepStatusRespuestas === null) {
			if ($this->isNew()) {
			   $this->collRepStatusRespuestas = array();
			} else {

				$criteria->add(RepStatusRespuestaPeer::CA_LOGIN, $this->ca_login);

				RepStatusRespuestaPeer::addSelectColumns($criteria);
				$this->collRepStatusRespuestas = RepStatusRespuestaPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RepStatusRespuestaPeer::CA_LOGIN, $this->ca_login);

				RepStatusRespuestaPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepStatusRespuestaCriteria) || !$this->lastRepStatusRespuestaCriteria->equals($criteria)) {
					$this->collRepStatusRespuestas = RepStatusRespuestaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepStatusRespuestaCriteria = $criteria;
		return $this->collRepStatusRespuestas;
	}

	/**
	 * Returns the number of related RepStatusRespuesta objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related RepStatusRespuesta objects.
	 * @throws     PropelException
	 */
	public function countRepStatusRespuestas(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collRepStatusRespuestas === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(RepStatusRespuestaPeer::CA_LOGIN, $this->ca_login);

				$count = RepStatusRespuestaPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(RepStatusRespuestaPeer::CA_LOGIN, $this->ca_login);

				if (!isset($this->lastRepStatusRespuestaCriteria) || !$this->lastRepStatusRespuestaCriteria->equals($criteria)) {
					$count = RepStatusRespuestaPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collRepStatusRespuestas);
				}
			} else {
				$count = count($this->collRepStatusRespuestas);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a RepStatusRespuesta object to this object
	 * through the RepStatusRespuesta foreign key attribute.
	 *
	 * @param      RepStatusRespuesta $l RepStatusRespuesta
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRepStatusRespuesta(RepStatusRespuesta $l)
	{
		if ($this->collRepStatusRespuestas === null) {
			$this->initRepStatusRespuestas();
		}
		if (!in_array($l, $this->collRepStatusRespuestas, true)) { // only add it if the **same** object is not already associated
			array_push($this->collRepStatusRespuestas, $l);
			$l->setUsuario($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Usuario is new, it will return
	 * an empty collection; or if this Usuario has previously
	 * been saved, it will retrieve related RepStatusRespuestas from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Usuario.
	 */
	public function getRepStatusRespuestasJoinRepStatus($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepStatusRespuestas === null) {
			if ($this->isNew()) {
				$this->collRepStatusRespuestas = array();
			} else {

				$criteria->add(RepStatusRespuestaPeer::CA_LOGIN, $this->ca_login);

				$this->collRepStatusRespuestas = RepStatusRespuestaPeer::doSelectJoinRepStatus($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RepStatusRespuestaPeer::CA_LOGIN, $this->ca_login);

			if (!isset($this->lastRepStatusRespuestaCriteria) || !$this->lastRepStatusRespuestaCriteria->equals($criteria)) {
				$this->collRepStatusRespuestas = RepStatusRespuestaPeer::doSelectJoinRepStatus($criteria, $con, $join_behavior);
			}
		}
		$this->lastRepStatusRespuestaCriteria = $criteria;

		return $this->collRepStatusRespuestas;
	}

	/**
	 * Resets all collections of referencing foreign keys.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect objects
	 * with circular references.  This is currently necessary when using Propel in certain
	 * daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all associated objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collNivelesAccesos) {
				foreach ((array) $this->collNivelesAccesos as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collAccesoUsuarios) {
				foreach ((array) $this->collAccesoUsuarios as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collCotizacions) {
				foreach ((array) $this->collCotizacions as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collHdeskTickets) {
				foreach ((array) $this->collHdeskTickets as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collHdeskResponses) {
				foreach ((array) $this->collHdeskResponses as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collHdeskUserGroups) {
				foreach ((array) $this->collHdeskUserGroups as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collHdeskKBases) {
				foreach ((array) $this->collHdeskKBases as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collNotificacions) {
				foreach ((array) $this->collNotificacions as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collNotTareaAsignacions) {
				foreach ((array) $this->collNotTareaAsignacions as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collReportes) {
				foreach ((array) $this->collReportes as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collRepStatusRespuestas) {
				foreach ((array) $this->collRepStatusRespuestas as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collNivelesAccesos = null;
		$this->collAccesoUsuarios = null;
		$this->collCotizacions = null;
		$this->collHdeskTickets = null;
		$this->collHdeskResponses = null;
		$this->collHdeskUserGroups = null;
		$this->collHdeskKBases = null;
		$this->collNotificacions = null;
		$this->collNotTareaAsignacions = null;
		$this->collReportes = null;
		$this->collRepStatusRespuestas = null;
			$this->aSucursal = null;
	}

} // BaseUsuario
