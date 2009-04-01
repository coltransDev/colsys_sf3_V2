<?php

/**
 * Base class that represents a row from the 'tb_trayectos' table.
 *
 * 
 *
 * @package    lib.model.pricing.om
 */
abstract class BaseTrayecto extends BaseObject  implements Persistent {


  const PEER = 'TrayectoPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        TrayectoPeer
	 */
	protected static $peer;

	/**
	 * The value for the oid field.
	 * @var        int
	 */
	protected $oid;

	/**
	 * The value for the ca_idtrayecto field.
	 * @var        int
	 */
	protected $ca_idtrayecto;

	/**
	 * The value for the ca_origen field.
	 * @var        string
	 */
	protected $ca_origen;

	/**
	 * The value for the ca_destino field.
	 * @var        string
	 */
	protected $ca_destino;

	/**
	 * The value for the ca_idlinea field.
	 * @var        int
	 */
	protected $ca_idlinea;

	/**
	 * The value for the ca_transporte field.
	 * @var        string
	 */
	protected $ca_transporte;

	/**
	 * The value for the ca_terminal field.
	 * @var        string
	 */
	protected $ca_terminal;

	/**
	 * The value for the ca_impoexpo field.
	 * @var        string
	 */
	protected $ca_impoexpo;

	/**
	 * The value for the ca_frecuencia field.
	 * @var        string
	 */
	protected $ca_frecuencia;

	/**
	 * The value for the ca_tiempotransito field.
	 * @var        string
	 */
	protected $ca_tiempotransito;

	/**
	 * The value for the ca_modalidad field.
	 * @var        string
	 */
	protected $ca_modalidad;

	/**
	 * The value for the ca_fchcreado field.
	 * @var        string
	 */
	protected $ca_fchcreado;

	/**
	 * The value for the ca_idtarifas field.
	 * @var        int
	 */
	protected $ca_idtarifas;

	/**
	 * The value for the ca_observaciones field.
	 * @var        string
	 */
	protected $ca_observaciones;

	/**
	 * The value for the ca_idagente field.
	 * @var        int
	 */
	protected $ca_idagente;

	/**
	 * The value for the ca_activo field.
	 * @var        boolean
	 */
	protected $ca_activo;

	/**
	 * @var        Transportador
	 */
	protected $aTransportador;

	/**
	 * @var        Agente
	 */
	protected $aAgente;

	/**
	 * @var        array PricFlete[] Collection to store aggregation of PricFlete objects.
	 */
	protected $collPricFletes;

	/**
	 * @var        Criteria The criteria used to select the current contents of collPricFletes.
	 */
	private $lastPricFleteCriteria = null;

	/**
	 * @var        array PricFleteLog[] Collection to store aggregation of PricFleteLog objects.
	 */
	protected $collPricFleteLogs;

	/**
	 * @var        Criteria The criteria used to select the current contents of collPricFleteLogs.
	 */
	private $lastPricFleteLogCriteria = null;

	/**
	 * @var        array Flete[] Collection to store aggregation of Flete objects.
	 */
	protected $collFletes;

	/**
	 * @var        Criteria The criteria used to select the current contents of collFletes.
	 */
	private $lastFleteCriteria = null;

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
	 * Initializes internal state of BaseTrayecto object.
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
	 * Get the [oid] column value.
	 * 
	 * @return     int
	 */
	public function getOid()
	{
		return $this->oid;
	}

	/**
	 * Get the [ca_idtrayecto] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdtrayecto()
	{
		return $this->ca_idtrayecto;
	}

	/**
	 * Get the [ca_origen] column value.
	 * 
	 * @return     string
	 */
	public function getCaOrigen()
	{
		return $this->ca_origen;
	}

	/**
	 * Get the [ca_destino] column value.
	 * 
	 * @return     string
	 */
	public function getCaDestino()
	{
		return $this->ca_destino;
	}

	/**
	 * Get the [ca_idlinea] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdlinea()
	{
		return $this->ca_idlinea;
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
	 * Get the [ca_terminal] column value.
	 * 
	 * @return     string
	 */
	public function getCaTerminal()
	{
		return $this->ca_terminal;
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
	 * Get the [ca_frecuencia] column value.
	 * 
	 * @return     string
	 */
	public function getCaFrecuencia()
	{
		return $this->ca_frecuencia;
	}

	/**
	 * Get the [ca_tiempotransito] column value.
	 * 
	 * @return     string
	 */
	public function getCaTiempotransito()
	{
		return $this->ca_tiempotransito;
	}

	/**
	 * Get the [ca_modalidad] column value.
	 * 
	 * @return     string
	 */
	public function getCaModalidad()
	{
		return $this->ca_modalidad;
	}

	/**
	 * Get the [optionally formatted] temporal [ca_fchcreado] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaFchcreado($format = 'Y-m-d')
	{
		if ($this->ca_fchcreado === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchcreado);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchcreado, true), $x);
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [ca_idtarifas] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdtarifas()
	{
		return $this->ca_idtarifas;
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
	 * Get the [ca_idagente] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdagente()
	{
		return $this->ca_idagente;
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
	 * Set the value of [oid] column.
	 * 
	 * @param      int $v new value
	 * @return     Trayecto The current object (for fluent API support)
	 */
	public function setOid($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->oid !== $v) {
			$this->oid = $v;
			$this->modifiedColumns[] = TrayectoPeer::OID;
		}

		return $this;
	} // setOid()

	/**
	 * Set the value of [ca_idtrayecto] column.
	 * 
	 * @param      int $v new value
	 * @return     Trayecto The current object (for fluent API support)
	 */
	public function setCaIdtrayecto($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idtrayecto !== $v) {
			$this->ca_idtrayecto = $v;
			$this->modifiedColumns[] = TrayectoPeer::CA_IDTRAYECTO;
		}

		return $this;
	} // setCaIdtrayecto()

	/**
	 * Set the value of [ca_origen] column.
	 * 
	 * @param      string $v new value
	 * @return     Trayecto The current object (for fluent API support)
	 */
	public function setCaOrigen($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_origen !== $v) {
			$this->ca_origen = $v;
			$this->modifiedColumns[] = TrayectoPeer::CA_ORIGEN;
		}

		return $this;
	} // setCaOrigen()

	/**
	 * Set the value of [ca_destino] column.
	 * 
	 * @param      string $v new value
	 * @return     Trayecto The current object (for fluent API support)
	 */
	public function setCaDestino($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_destino !== $v) {
			$this->ca_destino = $v;
			$this->modifiedColumns[] = TrayectoPeer::CA_DESTINO;
		}

		return $this;
	} // setCaDestino()

	/**
	 * Set the value of [ca_idlinea] column.
	 * 
	 * @param      int $v new value
	 * @return     Trayecto The current object (for fluent API support)
	 */
	public function setCaIdlinea($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idlinea !== $v) {
			$this->ca_idlinea = $v;
			$this->modifiedColumns[] = TrayectoPeer::CA_IDLINEA;
		}

		if ($this->aTransportador !== null && $this->aTransportador->getCaIdlinea() !== $v) {
			$this->aTransportador = null;
		}

		return $this;
	} // setCaIdlinea()

	/**
	 * Set the value of [ca_transporte] column.
	 * 
	 * @param      string $v new value
	 * @return     Trayecto The current object (for fluent API support)
	 */
	public function setCaTransporte($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_transporte !== $v) {
			$this->ca_transporte = $v;
			$this->modifiedColumns[] = TrayectoPeer::CA_TRANSPORTE;
		}

		return $this;
	} // setCaTransporte()

	/**
	 * Set the value of [ca_terminal] column.
	 * 
	 * @param      string $v new value
	 * @return     Trayecto The current object (for fluent API support)
	 */
	public function setCaTerminal($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_terminal !== $v) {
			$this->ca_terminal = $v;
			$this->modifiedColumns[] = TrayectoPeer::CA_TERMINAL;
		}

		return $this;
	} // setCaTerminal()

	/**
	 * Set the value of [ca_impoexpo] column.
	 * 
	 * @param      string $v new value
	 * @return     Trayecto The current object (for fluent API support)
	 */
	public function setCaImpoexpo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_impoexpo !== $v) {
			$this->ca_impoexpo = $v;
			$this->modifiedColumns[] = TrayectoPeer::CA_IMPOEXPO;
		}

		return $this;
	} // setCaImpoexpo()

	/**
	 * Set the value of [ca_frecuencia] column.
	 * 
	 * @param      string $v new value
	 * @return     Trayecto The current object (for fluent API support)
	 */
	public function setCaFrecuencia($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_frecuencia !== $v) {
			$this->ca_frecuencia = $v;
			$this->modifiedColumns[] = TrayectoPeer::CA_FRECUENCIA;
		}

		return $this;
	} // setCaFrecuencia()

	/**
	 * Set the value of [ca_tiempotransito] column.
	 * 
	 * @param      string $v new value
	 * @return     Trayecto The current object (for fluent API support)
	 */
	public function setCaTiempotransito($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_tiempotransito !== $v) {
			$this->ca_tiempotransito = $v;
			$this->modifiedColumns[] = TrayectoPeer::CA_TIEMPOTRANSITO;
		}

		return $this;
	} // setCaTiempotransito()

	/**
	 * Set the value of [ca_modalidad] column.
	 * 
	 * @param      string $v new value
	 * @return     Trayecto The current object (for fluent API support)
	 */
	public function setCaModalidad($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_modalidad !== $v) {
			$this->ca_modalidad = $v;
			$this->modifiedColumns[] = TrayectoPeer::CA_MODALIDAD;
		}

		return $this;
	} // setCaModalidad()

	/**
	 * Sets the value of [ca_fchcreado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     Trayecto The current object (for fluent API support)
	 */
	public function setCaFchcreado($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->ca_fchcreado !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fchcreado !== null && $tmpDt = new DateTime($this->ca_fchcreado)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchcreado = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = TrayectoPeer::CA_FCHCREADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchcreado()

	/**
	 * Set the value of [ca_idtarifas] column.
	 * 
	 * @param      int $v new value
	 * @return     Trayecto The current object (for fluent API support)
	 */
	public function setCaIdtarifas($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idtarifas !== $v) {
			$this->ca_idtarifas = $v;
			$this->modifiedColumns[] = TrayectoPeer::CA_IDTARIFAS;
		}

		return $this;
	} // setCaIdtarifas()

	/**
	 * Set the value of [ca_observaciones] column.
	 * 
	 * @param      string $v new value
	 * @return     Trayecto The current object (for fluent API support)
	 */
	public function setCaObservaciones($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_observaciones !== $v) {
			$this->ca_observaciones = $v;
			$this->modifiedColumns[] = TrayectoPeer::CA_OBSERVACIONES;
		}

		return $this;
	} // setCaObservaciones()

	/**
	 * Set the value of [ca_idagente] column.
	 * 
	 * @param      int $v new value
	 * @return     Trayecto The current object (for fluent API support)
	 */
	public function setCaIdagente($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idagente !== $v) {
			$this->ca_idagente = $v;
			$this->modifiedColumns[] = TrayectoPeer::CA_IDAGENTE;
		}

		if ($this->aAgente !== null && $this->aAgente->getCaIdagente() !== $v) {
			$this->aAgente = null;
		}

		return $this;
	} // setCaIdagente()

	/**
	 * Set the value of [ca_activo] column.
	 * 
	 * @param      boolean $v new value
	 * @return     Trayecto The current object (for fluent API support)
	 */
	public function setCaActivo($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->ca_activo !== $v) {
			$this->ca_activo = $v;
			$this->modifiedColumns[] = TrayectoPeer::CA_ACTIVO;
		}

		return $this;
	} // setCaActivo()

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

			$this->oid = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_idtrayecto = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_origen = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_destino = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_idlinea = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->ca_transporte = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_terminal = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_impoexpo = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_frecuencia = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_tiempotransito = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_modalidad = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_fchcreado = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_idtarifas = ($row[$startcol + 12] !== null) ? (int) $row[$startcol + 12] : null;
			$this->ca_observaciones = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->ca_idagente = ($row[$startcol + 14] !== null) ? (int) $row[$startcol + 14] : null;
			$this->ca_activo = ($row[$startcol + 15] !== null) ? (boolean) $row[$startcol + 15] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 16; // 16 = TrayectoPeer::NUM_COLUMNS - TrayectoPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Trayecto object", $e);
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

		if ($this->aTransportador !== null && $this->ca_idlinea !== $this->aTransportador->getCaIdlinea()) {
			$this->aTransportador = null;
		}
		if ($this->aAgente !== null && $this->ca_idagente !== $this->aAgente->getCaIdagente()) {
			$this->aAgente = null;
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
			$con = Propel::getConnection(TrayectoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = TrayectoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aTransportador = null;
			$this->aAgente = null;
			$this->collPricFletes = null;
			$this->lastPricFleteCriteria = null;

			$this->collPricFleteLogs = null;
			$this->lastPricFleteLogCriteria = null;

			$this->collFletes = null;
			$this->lastFleteCriteria = null;

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
			$con = Propel::getConnection(TrayectoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			TrayectoPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(TrayectoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			TrayectoPeer::addInstanceToPool($this);
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

			if ($this->aTransportador !== null) {
				if ($this->aTransportador->isModified() || $this->aTransportador->isNew()) {
					$affectedRows += $this->aTransportador->save($con);
				}
				$this->setTransportador($this->aTransportador);
			}

			if ($this->aAgente !== null) {
				if ($this->aAgente->isModified() || $this->aAgente->isNew()) {
					$affectedRows += $this->aAgente->save($con);
				}
				$this->setAgente($this->aAgente);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TrayectoPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += TrayectoPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collPricFletes !== null) {
				foreach ($this->collPricFletes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPricFleteLogs !== null) {
				foreach ($this->collPricFleteLogs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collFletes !== null) {
				foreach ($this->collFletes as $referrerFK) {
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

			if ($this->aTransportador !== null) {
				if (!$this->aTransportador->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTransportador->getValidationFailures());
				}
			}

			if ($this->aAgente !== null) {
				if (!$this->aAgente->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAgente->getValidationFailures());
				}
			}


			if (($retval = TrayectoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collPricFletes !== null) {
					foreach ($this->collPricFletes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPricFleteLogs !== null) {
					foreach ($this->collPricFleteLogs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collFletes !== null) {
					foreach ($this->collFletes as $referrerFK) {
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
		$pos = TrayectoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getOid();
				break;
			case 1:
				return $this->getCaIdtrayecto();
				break;
			case 2:
				return $this->getCaOrigen();
				break;
			case 3:
				return $this->getCaDestino();
				break;
			case 4:
				return $this->getCaIdlinea();
				break;
			case 5:
				return $this->getCaTransporte();
				break;
			case 6:
				return $this->getCaTerminal();
				break;
			case 7:
				return $this->getCaImpoexpo();
				break;
			case 8:
				return $this->getCaFrecuencia();
				break;
			case 9:
				return $this->getCaTiempotransito();
				break;
			case 10:
				return $this->getCaModalidad();
				break;
			case 11:
				return $this->getCaFchcreado();
				break;
			case 12:
				return $this->getCaIdtarifas();
				break;
			case 13:
				return $this->getCaObservaciones();
				break;
			case 14:
				return $this->getCaIdagente();
				break;
			case 15:
				return $this->getCaActivo();
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
		$keys = TrayectoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getOid(),
			$keys[1] => $this->getCaIdtrayecto(),
			$keys[2] => $this->getCaOrigen(),
			$keys[3] => $this->getCaDestino(),
			$keys[4] => $this->getCaIdlinea(),
			$keys[5] => $this->getCaTransporte(),
			$keys[6] => $this->getCaTerminal(),
			$keys[7] => $this->getCaImpoexpo(),
			$keys[8] => $this->getCaFrecuencia(),
			$keys[9] => $this->getCaTiempotransito(),
			$keys[10] => $this->getCaModalidad(),
			$keys[11] => $this->getCaFchcreado(),
			$keys[12] => $this->getCaIdtarifas(),
			$keys[13] => $this->getCaObservaciones(),
			$keys[14] => $this->getCaIdagente(),
			$keys[15] => $this->getCaActivo(),
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
		$pos = TrayectoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setOid($value);
				break;
			case 1:
				$this->setCaIdtrayecto($value);
				break;
			case 2:
				$this->setCaOrigen($value);
				break;
			case 3:
				$this->setCaDestino($value);
				break;
			case 4:
				$this->setCaIdlinea($value);
				break;
			case 5:
				$this->setCaTransporte($value);
				break;
			case 6:
				$this->setCaTerminal($value);
				break;
			case 7:
				$this->setCaImpoexpo($value);
				break;
			case 8:
				$this->setCaFrecuencia($value);
				break;
			case 9:
				$this->setCaTiempotransito($value);
				break;
			case 10:
				$this->setCaModalidad($value);
				break;
			case 11:
				$this->setCaFchcreado($value);
				break;
			case 12:
				$this->setCaIdtarifas($value);
				break;
			case 13:
				$this->setCaObservaciones($value);
				break;
			case 14:
				$this->setCaIdagente($value);
				break;
			case 15:
				$this->setCaActivo($value);
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
		$keys = TrayectoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setOid($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdtrayecto($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaOrigen($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaDestino($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaIdlinea($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaTransporte($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaTerminal($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaImpoexpo($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaFrecuencia($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaTiempotransito($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaModalidad($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaFchcreado($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaIdtarifas($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaObservaciones($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaIdagente($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaActivo($arr[$keys[15]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(TrayectoPeer::DATABASE_NAME);

		if ($this->isColumnModified(TrayectoPeer::OID)) $criteria->add(TrayectoPeer::OID, $this->oid);
		if ($this->isColumnModified(TrayectoPeer::CA_IDTRAYECTO)) $criteria->add(TrayectoPeer::CA_IDTRAYECTO, $this->ca_idtrayecto);
		if ($this->isColumnModified(TrayectoPeer::CA_ORIGEN)) $criteria->add(TrayectoPeer::CA_ORIGEN, $this->ca_origen);
		if ($this->isColumnModified(TrayectoPeer::CA_DESTINO)) $criteria->add(TrayectoPeer::CA_DESTINO, $this->ca_destino);
		if ($this->isColumnModified(TrayectoPeer::CA_IDLINEA)) $criteria->add(TrayectoPeer::CA_IDLINEA, $this->ca_idlinea);
		if ($this->isColumnModified(TrayectoPeer::CA_TRANSPORTE)) $criteria->add(TrayectoPeer::CA_TRANSPORTE, $this->ca_transporte);
		if ($this->isColumnModified(TrayectoPeer::CA_TERMINAL)) $criteria->add(TrayectoPeer::CA_TERMINAL, $this->ca_terminal);
		if ($this->isColumnModified(TrayectoPeer::CA_IMPOEXPO)) $criteria->add(TrayectoPeer::CA_IMPOEXPO, $this->ca_impoexpo);
		if ($this->isColumnModified(TrayectoPeer::CA_FRECUENCIA)) $criteria->add(TrayectoPeer::CA_FRECUENCIA, $this->ca_frecuencia);
		if ($this->isColumnModified(TrayectoPeer::CA_TIEMPOTRANSITO)) $criteria->add(TrayectoPeer::CA_TIEMPOTRANSITO, $this->ca_tiempotransito);
		if ($this->isColumnModified(TrayectoPeer::CA_MODALIDAD)) $criteria->add(TrayectoPeer::CA_MODALIDAD, $this->ca_modalidad);
		if ($this->isColumnModified(TrayectoPeer::CA_FCHCREADO)) $criteria->add(TrayectoPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(TrayectoPeer::CA_IDTARIFAS)) $criteria->add(TrayectoPeer::CA_IDTARIFAS, $this->ca_idtarifas);
		if ($this->isColumnModified(TrayectoPeer::CA_OBSERVACIONES)) $criteria->add(TrayectoPeer::CA_OBSERVACIONES, $this->ca_observaciones);
		if ($this->isColumnModified(TrayectoPeer::CA_IDAGENTE)) $criteria->add(TrayectoPeer::CA_IDAGENTE, $this->ca_idagente);
		if ($this->isColumnModified(TrayectoPeer::CA_ACTIVO)) $criteria->add(TrayectoPeer::CA_ACTIVO, $this->ca_activo);

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
		$criteria = new Criteria(TrayectoPeer::DATABASE_NAME);

		$criteria->add(TrayectoPeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdtrayecto();
	}

	/**
	 * Generic method to set the primary key (ca_idtrayecto column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdtrayecto($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Trayecto (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setOid($this->oid);

		$copyObj->setCaIdtrayecto($this->ca_idtrayecto);

		$copyObj->setCaOrigen($this->ca_origen);

		$copyObj->setCaDestino($this->ca_destino);

		$copyObj->setCaIdlinea($this->ca_idlinea);

		$copyObj->setCaTransporte($this->ca_transporte);

		$copyObj->setCaTerminal($this->ca_terminal);

		$copyObj->setCaImpoexpo($this->ca_impoexpo);

		$copyObj->setCaFrecuencia($this->ca_frecuencia);

		$copyObj->setCaTiempotransito($this->ca_tiempotransito);

		$copyObj->setCaModalidad($this->ca_modalidad);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaIdtarifas($this->ca_idtarifas);

		$copyObj->setCaObservaciones($this->ca_observaciones);

		$copyObj->setCaIdagente($this->ca_idagente);

		$copyObj->setCaActivo($this->ca_activo);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getPricFletes() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addPricFlete($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getPricFleteLogs() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addPricFleteLog($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getFletes() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addFlete($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

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
	 * @return     Trayecto Clone of current object.
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
	 * @return     TrayectoPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new TrayectoPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Transportador object.
	 *
	 * @param      Transportador $v
	 * @return     Trayecto The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setTransportador(Transportador $v = null)
	{
		if ($v === null) {
			$this->setCaIdlinea(NULL);
		} else {
			$this->setCaIdlinea($v->getCaIdlinea());
		}

		$this->aTransportador = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Transportador object, it will not be re-added.
		if ($v !== null) {
			$v->addTrayecto($this);
		}

		return $this;
	}


	/**
	 * Get the associated Transportador object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Transportador The associated Transportador object.
	 * @throws     PropelException
	 */
	public function getTransportador(PropelPDO $con = null)
	{
		if ($this->aTransportador === null && ($this->ca_idlinea !== null)) {
			$c = new Criteria(TransportadorPeer::DATABASE_NAME);
			$c->add(TransportadorPeer::CA_IDLINEA, $this->ca_idlinea);
			$this->aTransportador = TransportadorPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aTransportador->addTrayectos($this);
			 */
		}
		return $this->aTransportador;
	}

	/**
	 * Declares an association between this object and a Agente object.
	 *
	 * @param      Agente $v
	 * @return     Trayecto The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setAgente(Agente $v = null)
	{
		if ($v === null) {
			$this->setCaIdagente(NULL);
		} else {
			$this->setCaIdagente($v->getCaIdagente());
		}

		$this->aAgente = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Agente object, it will not be re-added.
		if ($v !== null) {
			$v->addTrayecto($this);
		}

		return $this;
	}


	/**
	 * Get the associated Agente object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Agente The associated Agente object.
	 * @throws     PropelException
	 */
	public function getAgente(PropelPDO $con = null)
	{
		if ($this->aAgente === null && ($this->ca_idagente !== null)) {
			$c = new Criteria(AgentePeer::DATABASE_NAME);
			$c->add(AgentePeer::CA_IDAGENTE, $this->ca_idagente);
			$this->aAgente = AgentePeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aAgente->addTrayectos($this);
			 */
		}
		return $this->aAgente;
	}

	/**
	 * Clears out the collPricFletes collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addPricFletes()
	 */
	public function clearPricFletes()
	{
		$this->collPricFletes = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collPricFletes collection (array).
	 *
	 * By default this just sets the collPricFletes collection to an empty array (like clearcollPricFletes());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initPricFletes()
	{
		$this->collPricFletes = array();
	}

	/**
	 * Gets an array of PricFlete objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Trayecto has previously been saved, it will retrieve
	 * related PricFletes from storage. If this Trayecto is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array PricFlete[]
	 * @throws     PropelException
	 */
	public function getPricFletes($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TrayectoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricFletes === null) {
			if ($this->isNew()) {
			   $this->collPricFletes = array();
			} else {

				$criteria->add(PricFletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

				PricFletePeer::addSelectColumns($criteria);
				$this->collPricFletes = PricFletePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PricFletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

				PricFletePeer::addSelectColumns($criteria);
				if (!isset($this->lastPricFleteCriteria) || !$this->lastPricFleteCriteria->equals($criteria)) {
					$this->collPricFletes = PricFletePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPricFleteCriteria = $criteria;
		return $this->collPricFletes;
	}

	/**
	 * Returns the number of related PricFlete objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related PricFlete objects.
	 * @throws     PropelException
	 */
	public function countPricFletes(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TrayectoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collPricFletes === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PricFletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

				$count = PricFletePeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(PricFletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

				if (!isset($this->lastPricFleteCriteria) || !$this->lastPricFleteCriteria->equals($criteria)) {
					$count = PricFletePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPricFletes);
				}
			} else {
				$count = count($this->collPricFletes);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a PricFlete object to this object
	 * through the PricFlete foreign key attribute.
	 *
	 * @param      PricFlete $l PricFlete
	 * @return     void
	 * @throws     PropelException
	 */
	public function addPricFlete(PricFlete $l)
	{
		if ($this->collPricFletes === null) {
			$this->initPricFletes();
		}
		if (!in_array($l, $this->collPricFletes, true)) { // only add it if the **same** object is not already associated
			array_push($this->collPricFletes, $l);
			$l->setTrayecto($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Trayecto is new, it will return
	 * an empty collection; or if this Trayecto has previously
	 * been saved, it will retrieve related PricFletes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Trayecto.
	 */
	public function getPricFletesJoinConcepto($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TrayectoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricFletes === null) {
			if ($this->isNew()) {
				$this->collPricFletes = array();
			} else {

				$criteria->add(PricFletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

				$this->collPricFletes = PricFletePeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PricFletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

			if (!isset($this->lastPricFleteCriteria) || !$this->lastPricFleteCriteria->equals($criteria)) {
				$this->collPricFletes = PricFletePeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		}
		$this->lastPricFleteCriteria = $criteria;

		return $this->collPricFletes;
	}

	/**
	 * Clears out the collPricFleteLogs collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addPricFleteLogs()
	 */
	public function clearPricFleteLogs()
	{
		$this->collPricFleteLogs = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collPricFleteLogs collection (array).
	 *
	 * By default this just sets the collPricFleteLogs collection to an empty array (like clearcollPricFleteLogs());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initPricFleteLogs()
	{
		$this->collPricFleteLogs = array();
	}

	/**
	 * Gets an array of PricFleteLog objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Trayecto has previously been saved, it will retrieve
	 * related PricFleteLogs from storage. If this Trayecto is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array PricFleteLog[]
	 * @throws     PropelException
	 */
	public function getPricFleteLogs($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TrayectoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricFleteLogs === null) {
			if ($this->isNew()) {
			   $this->collPricFleteLogs = array();
			} else {

				$criteria->add(PricFleteLogPeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

				PricFleteLogPeer::addSelectColumns($criteria);
				$this->collPricFleteLogs = PricFleteLogPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PricFleteLogPeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

				PricFleteLogPeer::addSelectColumns($criteria);
				if (!isset($this->lastPricFleteLogCriteria) || !$this->lastPricFleteLogCriteria->equals($criteria)) {
					$this->collPricFleteLogs = PricFleteLogPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPricFleteLogCriteria = $criteria;
		return $this->collPricFleteLogs;
	}

	/**
	 * Returns the number of related PricFleteLog objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related PricFleteLog objects.
	 * @throws     PropelException
	 */
	public function countPricFleteLogs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TrayectoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collPricFleteLogs === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PricFleteLogPeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

				$count = PricFleteLogPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(PricFleteLogPeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

				if (!isset($this->lastPricFleteLogCriteria) || !$this->lastPricFleteLogCriteria->equals($criteria)) {
					$count = PricFleteLogPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPricFleteLogs);
				}
			} else {
				$count = count($this->collPricFleteLogs);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a PricFleteLog object to this object
	 * through the PricFleteLog foreign key attribute.
	 *
	 * @param      PricFleteLog $l PricFleteLog
	 * @return     void
	 * @throws     PropelException
	 */
	public function addPricFleteLog(PricFleteLog $l)
	{
		if ($this->collPricFleteLogs === null) {
			$this->initPricFleteLogs();
		}
		if (!in_array($l, $this->collPricFleteLogs, true)) { // only add it if the **same** object is not already associated
			array_push($this->collPricFleteLogs, $l);
			$l->setTrayecto($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Trayecto is new, it will return
	 * an empty collection; or if this Trayecto has previously
	 * been saved, it will retrieve related PricFleteLogs from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Trayecto.
	 */
	public function getPricFleteLogsJoinConcepto($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TrayectoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricFleteLogs === null) {
			if ($this->isNew()) {
				$this->collPricFleteLogs = array();
			} else {

				$criteria->add(PricFleteLogPeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

				$this->collPricFleteLogs = PricFleteLogPeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PricFleteLogPeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

			if (!isset($this->lastPricFleteLogCriteria) || !$this->lastPricFleteLogCriteria->equals($criteria)) {
				$this->collPricFleteLogs = PricFleteLogPeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		}
		$this->lastPricFleteLogCriteria = $criteria;

		return $this->collPricFleteLogs;
	}

	/**
	 * Clears out the collFletes collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addFletes()
	 */
	public function clearFletes()
	{
		$this->collFletes = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collFletes collection (array).
	 *
	 * By default this just sets the collFletes collection to an empty array (like clearcollFletes());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initFletes()
	{
		$this->collFletes = array();
	}

	/**
	 * Gets an array of Flete objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Trayecto has previously been saved, it will retrieve
	 * related Fletes from storage. If this Trayecto is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array Flete[]
	 * @throws     PropelException
	 */
	public function getFletes($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TrayectoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFletes === null) {
			if ($this->isNew()) {
			   $this->collFletes = array();
			} else {

				$criteria->add(FletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

				FletePeer::addSelectColumns($criteria);
				$this->collFletes = FletePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(FletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

				FletePeer::addSelectColumns($criteria);
				if (!isset($this->lastFleteCriteria) || !$this->lastFleteCriteria->equals($criteria)) {
					$this->collFletes = FletePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFleteCriteria = $criteria;
		return $this->collFletes;
	}

	/**
	 * Returns the number of related Flete objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Flete objects.
	 * @throws     PropelException
	 */
	public function countFletes(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TrayectoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collFletes === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(FletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

				$count = FletePeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(FletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

				if (!isset($this->lastFleteCriteria) || !$this->lastFleteCriteria->equals($criteria)) {
					$count = FletePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collFletes);
				}
			} else {
				$count = count($this->collFletes);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a Flete object to this object
	 * through the Flete foreign key attribute.
	 *
	 * @param      Flete $l Flete
	 * @return     void
	 * @throws     PropelException
	 */
	public function addFlete(Flete $l)
	{
		if ($this->collFletes === null) {
			$this->initFletes();
		}
		if (!in_array($l, $this->collFletes, true)) { // only add it if the **same** object is not already associated
			array_push($this->collFletes, $l);
			$l->setTrayecto($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Trayecto is new, it will return
	 * an empty collection; or if this Trayecto has previously
	 * been saved, it will retrieve related Fletes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Trayecto.
	 */
	public function getFletesJoinConcepto($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TrayectoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFletes === null) {
			if ($this->isNew()) {
				$this->collFletes = array();
			} else {

				$criteria->add(FletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

				$this->collFletes = FletePeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(FletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

			if (!isset($this->lastFleteCriteria) || !$this->lastFleteCriteria->equals($criteria)) {
				$this->collFletes = FletePeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		}
		$this->lastFleteCriteria = $criteria;

		return $this->collFletes;
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
			if ($this->collPricFletes) {
				foreach ((array) $this->collPricFletes as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collPricFleteLogs) {
				foreach ((array) $this->collPricFleteLogs as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collFletes) {
				foreach ((array) $this->collFletes as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collPricFletes = null;
		$this->collPricFleteLogs = null;
		$this->collFletes = null;
			$this->aTransportador = null;
			$this->aAgente = null;
	}

} // BaseTrayecto
