<?php

/**
 * Base class that represents a row from the 'tb_cotseguro' table.
 *
 * 
 *
 * @package    lib.model.cotizaciones.om
 */
abstract class BaseCotSeguro extends BaseObject  implements Persistent {


  const PEER = 'CotSeguroPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        CotSeguroPeer
	 */
	protected static $peer;

	/**
	 * The value for the ca_idseguro field.
	 * @var        string
	 */
	protected $ca_idseguro;

	/**
	 * The value for the ca_idcotizacion field.
	 * @var        int
	 */
	protected $ca_idcotizacion;

	/**
	 * The value for the ca_idmoneda field.
	 * @var        string
	 */
	protected $ca_idmoneda;

	/**
	 * The value for the ca_prima_tip field.
	 * @var        string
	 */
	protected $ca_prima_tip;

	/**
	 * The value for the ca_prima_vlr field.
	 * @var        string
	 */
	protected $ca_prima_vlr;

	/**
	 * The value for the ca_prima_min field.
	 * @var        string
	 */
	protected $ca_prima_min;

	/**
	 * The value for the ca_obtencion field.
	 * @var        string
	 */
	protected $ca_obtencion;

	/**
	 * The value for the ca_observaciones field.
	 * @var        string
	 */
	protected $ca_observaciones;

	/**
	 * The value for the ca_fchcreado field.
	 * @var        string
	 */
	protected $ca_fchcreado;

	/**
	 * The value for the ca_usucreado field.
	 * @var        string
	 */
	protected $ca_usucreado;

	/**
	 * The value for the ca_fchactualizado field.
	 * @var        string
	 */
	protected $ca_fchactualizado;

	/**
	 * The value for the ca_usuactualizado field.
	 * @var        string
	 */
	protected $ca_usuactualizado;

	/**
	 * The value for the ca_transporte field.
	 * @var        string
	 */
	protected $ca_transporte;

	/**
	 * @var        Cotizacion
	 */
	protected $aCotizacion;

	/**
	 * @var        Moneda
	 */
	protected $aMoneda;

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
	 * Initializes internal state of BaseCotSeguro object.
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
	 * Get the [ca_idseguro] column value.
	 * 
	 * @return     string
	 */
	public function getCaIdseguro()
	{
		return $this->ca_idseguro;
	}

	/**
	 * Get the [ca_idcotizacion] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdcotizacion()
	{
		return $this->ca_idcotizacion;
	}

	/**
	 * Get the [ca_idmoneda] column value.
	 * 
	 * @return     string
	 */
	public function getCaIdmoneda()
	{
		return $this->ca_idmoneda;
	}

	/**
	 * Get the [ca_prima_tip] column value.
	 * 
	 * @return     string
	 */
	public function getCaPrimaTip()
	{
		return $this->ca_prima_tip;
	}

	/**
	 * Get the [ca_prima_vlr] column value.
	 * 
	 * @return     string
	 */
	public function getCaPrimaVlr()
	{
		return $this->ca_prima_vlr;
	}

	/**
	 * Get the [ca_prima_min] column value.
	 * 
	 * @return     string
	 */
	public function getCaPrimaMin()
	{
		return $this->ca_prima_min;
	}

	/**
	 * Get the [ca_obtencion] column value.
	 * 
	 * @return     string
	 */
	public function getCaObtencion()
	{
		return $this->ca_obtencion;
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
	 * Get the [optionally formatted] temporal [ca_fchcreado] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaFchcreado($format = 'Y-m-d H:i:s')
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
	 * Get the [ca_usucreado] column value.
	 * 
	 * @return     string
	 */
	public function getCaUsucreado()
	{
		return $this->ca_usucreado;
	}

	/**
	 * Get the [optionally formatted] temporal [ca_fchactualizado] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaFchactualizado($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fchactualizado === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchactualizado);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchactualizado, true), $x);
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
	 * Get the [ca_usuactualizado] column value.
	 * 
	 * @return     string
	 */
	public function getCaUsuactualizado()
	{
		return $this->ca_usuactualizado;
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
	 * Set the value of [ca_idseguro] column.
	 * 
	 * @param      string $v new value
	 * @return     CotSeguro The current object (for fluent API support)
	 */
	public function setCaIdseguro($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idseguro !== $v) {
			$this->ca_idseguro = $v;
			$this->modifiedColumns[] = CotSeguroPeer::CA_IDSEGURO;
		}

		return $this;
	} // setCaIdseguro()

	/**
	 * Set the value of [ca_idcotizacion] column.
	 * 
	 * @param      int $v new value
	 * @return     CotSeguro The current object (for fluent API support)
	 */
	public function setCaIdcotizacion($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idcotizacion !== $v) {
			$this->ca_idcotizacion = $v;
			$this->modifiedColumns[] = CotSeguroPeer::CA_IDCOTIZACION;
		}

		if ($this->aCotizacion !== null && $this->aCotizacion->getCaIdcotizacion() !== $v) {
			$this->aCotizacion = null;
		}

		return $this;
	} // setCaIdcotizacion()

	/**
	 * Set the value of [ca_idmoneda] column.
	 * 
	 * @param      string $v new value
	 * @return     CotSeguro The current object (for fluent API support)
	 */
	public function setCaIdmoneda($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idmoneda !== $v) {
			$this->ca_idmoneda = $v;
			$this->modifiedColumns[] = CotSeguroPeer::CA_IDMONEDA;
		}

		if ($this->aMoneda !== null && $this->aMoneda->getCaIdmoneda() !== $v) {
			$this->aMoneda = null;
		}

		return $this;
	} // setCaIdmoneda()

	/**
	 * Set the value of [ca_prima_tip] column.
	 * 
	 * @param      string $v new value
	 * @return     CotSeguro The current object (for fluent API support)
	 */
	public function setCaPrimaTip($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_prima_tip !== $v) {
			$this->ca_prima_tip = $v;
			$this->modifiedColumns[] = CotSeguroPeer::CA_PRIMA_TIP;
		}

		return $this;
	} // setCaPrimaTip()

	/**
	 * Set the value of [ca_prima_vlr] column.
	 * 
	 * @param      string $v new value
	 * @return     CotSeguro The current object (for fluent API support)
	 */
	public function setCaPrimaVlr($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_prima_vlr !== $v) {
			$this->ca_prima_vlr = $v;
			$this->modifiedColumns[] = CotSeguroPeer::CA_PRIMA_VLR;
		}

		return $this;
	} // setCaPrimaVlr()

	/**
	 * Set the value of [ca_prima_min] column.
	 * 
	 * @param      string $v new value
	 * @return     CotSeguro The current object (for fluent API support)
	 */
	public function setCaPrimaMin($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_prima_min !== $v) {
			$this->ca_prima_min = $v;
			$this->modifiedColumns[] = CotSeguroPeer::CA_PRIMA_MIN;
		}

		return $this;
	} // setCaPrimaMin()

	/**
	 * Set the value of [ca_obtencion] column.
	 * 
	 * @param      string $v new value
	 * @return     CotSeguro The current object (for fluent API support)
	 */
	public function setCaObtencion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_obtencion !== $v) {
			$this->ca_obtencion = $v;
			$this->modifiedColumns[] = CotSeguroPeer::CA_OBTENCION;
		}

		return $this;
	} // setCaObtencion()

	/**
	 * Set the value of [ca_observaciones] column.
	 * 
	 * @param      string $v new value
	 * @return     CotSeguro The current object (for fluent API support)
	 */
	public function setCaObservaciones($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_observaciones !== $v) {
			$this->ca_observaciones = $v;
			$this->modifiedColumns[] = CotSeguroPeer::CA_OBSERVACIONES;
		}

		return $this;
	} // setCaObservaciones()

	/**
	 * Sets the value of [ca_fchcreado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     CotSeguro The current object (for fluent API support)
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

			$currNorm = ($this->ca_fchcreado !== null && $tmpDt = new DateTime($this->ca_fchcreado)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchcreado = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = CotSeguroPeer::CA_FCHCREADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchcreado()

	/**
	 * Set the value of [ca_usucreado] column.
	 * 
	 * @param      string $v new value
	 * @return     CotSeguro The current object (for fluent API support)
	 */
	public function setCaUsucreado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usucreado !== $v) {
			$this->ca_usucreado = $v;
			$this->modifiedColumns[] = CotSeguroPeer::CA_USUCREADO;
		}

		return $this;
	} // setCaUsucreado()

	/**
	 * Sets the value of [ca_fchactualizado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     CotSeguro The current object (for fluent API support)
	 */
	public function setCaFchactualizado($v)
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

		if ( $this->ca_fchactualizado !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fchactualizado !== null && $tmpDt = new DateTime($this->ca_fchactualizado)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchactualizado = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = CotSeguroPeer::CA_FCHACTUALIZADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchactualizado()

	/**
	 * Set the value of [ca_usuactualizado] column.
	 * 
	 * @param      string $v new value
	 * @return     CotSeguro The current object (for fluent API support)
	 */
	public function setCaUsuactualizado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usuactualizado !== $v) {
			$this->ca_usuactualizado = $v;
			$this->modifiedColumns[] = CotSeguroPeer::CA_USUACTUALIZADO;
		}

		return $this;
	} // setCaUsuactualizado()

	/**
	 * Set the value of [ca_transporte] column.
	 * 
	 * @param      string $v new value
	 * @return     CotSeguro The current object (for fluent API support)
	 */
	public function setCaTransporte($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_transporte !== $v) {
			$this->ca_transporte = $v;
			$this->modifiedColumns[] = CotSeguroPeer::CA_TRANSPORTE;
		}

		return $this;
	} // setCaTransporte()

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

			$this->ca_idseguro = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ca_idcotizacion = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_idmoneda = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_prima_tip = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_prima_vlr = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_prima_min = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_obtencion = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_observaciones = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_fchcreado = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_usucreado = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_fchactualizado = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_usuactualizado = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_transporte = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 13; // 13 = CotSeguroPeer::NUM_COLUMNS - CotSeguroPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating CotSeguro object", $e);
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

		if ($this->aCotizacion !== null && $this->ca_idcotizacion !== $this->aCotizacion->getCaIdcotizacion()) {
			$this->aCotizacion = null;
		}
		if ($this->aMoneda !== null && $this->ca_idmoneda !== $this->aMoneda->getCaIdmoneda()) {
			$this->aMoneda = null;
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
			$con = Propel::getConnection(CotSeguroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = CotSeguroPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aCotizacion = null;
			$this->aMoneda = null;
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
			$con = Propel::getConnection(CotSeguroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			CotSeguroPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(CotSeguroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			CotSeguroPeer::addInstanceToPool($this);
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

			if ($this->aCotizacion !== null) {
				if ($this->aCotizacion->isModified() || $this->aCotizacion->isNew()) {
					$affectedRows += $this->aCotizacion->save($con);
				}
				$this->setCotizacion($this->aCotizacion);
			}

			if ($this->aMoneda !== null) {
				if ($this->aMoneda->isModified() || $this->aMoneda->isNew()) {
					$affectedRows += $this->aMoneda->save($con);
				}
				$this->setMoneda($this->aMoneda);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = CotSeguroPeer::CA_IDSEGURO;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = CotSeguroPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setCaIdseguro($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += CotSeguroPeer::doUpdate($this, $con);
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

			if ($this->aCotizacion !== null) {
				if (!$this->aCotizacion->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCotizacion->getValidationFailures());
				}
			}

			if ($this->aMoneda !== null) {
				if (!$this->aMoneda->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aMoneda->getValidationFailures());
				}
			}


			if (($retval = CotSeguroPeer::doValidate($this, $columns)) !== true) {
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
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CotSeguroPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdseguro();
				break;
			case 1:
				return $this->getCaIdcotizacion();
				break;
			case 2:
				return $this->getCaIdmoneda();
				break;
			case 3:
				return $this->getCaPrimaTip();
				break;
			case 4:
				return $this->getCaPrimaVlr();
				break;
			case 5:
				return $this->getCaPrimaMin();
				break;
			case 6:
				return $this->getCaObtencion();
				break;
			case 7:
				return $this->getCaObservaciones();
				break;
			case 8:
				return $this->getCaFchcreado();
				break;
			case 9:
				return $this->getCaUsucreado();
				break;
			case 10:
				return $this->getCaFchactualizado();
				break;
			case 11:
				return $this->getCaUsuactualizado();
				break;
			case 12:
				return $this->getCaTransporte();
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
		$keys = CotSeguroPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdseguro(),
			$keys[1] => $this->getCaIdcotizacion(),
			$keys[2] => $this->getCaIdmoneda(),
			$keys[3] => $this->getCaPrimaTip(),
			$keys[4] => $this->getCaPrimaVlr(),
			$keys[5] => $this->getCaPrimaMin(),
			$keys[6] => $this->getCaObtencion(),
			$keys[7] => $this->getCaObservaciones(),
			$keys[8] => $this->getCaFchcreado(),
			$keys[9] => $this->getCaUsucreado(),
			$keys[10] => $this->getCaFchactualizado(),
			$keys[11] => $this->getCaUsuactualizado(),
			$keys[12] => $this->getCaTransporte(),
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
		$pos = CotSeguroPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdseguro($value);
				break;
			case 1:
				$this->setCaIdcotizacion($value);
				break;
			case 2:
				$this->setCaIdmoneda($value);
				break;
			case 3:
				$this->setCaPrimaTip($value);
				break;
			case 4:
				$this->setCaPrimaVlr($value);
				break;
			case 5:
				$this->setCaPrimaMin($value);
				break;
			case 6:
				$this->setCaObtencion($value);
				break;
			case 7:
				$this->setCaObservaciones($value);
				break;
			case 8:
				$this->setCaFchcreado($value);
				break;
			case 9:
				$this->setCaUsucreado($value);
				break;
			case 10:
				$this->setCaFchactualizado($value);
				break;
			case 11:
				$this->setCaUsuactualizado($value);
				break;
			case 12:
				$this->setCaTransporte($value);
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
		$keys = CotSeguroPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdseguro($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdcotizacion($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaIdmoneda($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaPrimaTip($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaPrimaVlr($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaPrimaMin($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaObtencion($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaObservaciones($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaFchcreado($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaUsucreado($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaFchactualizado($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaUsuactualizado($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaTransporte($arr[$keys[12]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(CotSeguroPeer::DATABASE_NAME);

		if ($this->isColumnModified(CotSeguroPeer::CA_IDSEGURO)) $criteria->add(CotSeguroPeer::CA_IDSEGURO, $this->ca_idseguro);
		if ($this->isColumnModified(CotSeguroPeer::CA_IDCOTIZACION)) $criteria->add(CotSeguroPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);
		if ($this->isColumnModified(CotSeguroPeer::CA_IDMONEDA)) $criteria->add(CotSeguroPeer::CA_IDMONEDA, $this->ca_idmoneda);
		if ($this->isColumnModified(CotSeguroPeer::CA_PRIMA_TIP)) $criteria->add(CotSeguroPeer::CA_PRIMA_TIP, $this->ca_prima_tip);
		if ($this->isColumnModified(CotSeguroPeer::CA_PRIMA_VLR)) $criteria->add(CotSeguroPeer::CA_PRIMA_VLR, $this->ca_prima_vlr);
		if ($this->isColumnModified(CotSeguroPeer::CA_PRIMA_MIN)) $criteria->add(CotSeguroPeer::CA_PRIMA_MIN, $this->ca_prima_min);
		if ($this->isColumnModified(CotSeguroPeer::CA_OBTENCION)) $criteria->add(CotSeguroPeer::CA_OBTENCION, $this->ca_obtencion);
		if ($this->isColumnModified(CotSeguroPeer::CA_OBSERVACIONES)) $criteria->add(CotSeguroPeer::CA_OBSERVACIONES, $this->ca_observaciones);
		if ($this->isColumnModified(CotSeguroPeer::CA_FCHCREADO)) $criteria->add(CotSeguroPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(CotSeguroPeer::CA_USUCREADO)) $criteria->add(CotSeguroPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(CotSeguroPeer::CA_FCHACTUALIZADO)) $criteria->add(CotSeguroPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(CotSeguroPeer::CA_USUACTUALIZADO)) $criteria->add(CotSeguroPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);
		if ($this->isColumnModified(CotSeguroPeer::CA_TRANSPORTE)) $criteria->add(CotSeguroPeer::CA_TRANSPORTE, $this->ca_transporte);

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
		$criteria = new Criteria(CotSeguroPeer::DATABASE_NAME);

		$criteria->add(CotSeguroPeer::CA_IDSEGURO, $this->ca_idseguro);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     string
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdseguro();
	}

	/**
	 * Generic method to set the primary key (ca_idseguro column).
	 *
	 * @param      string $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdseguro($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of CotSeguro (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdcotizacion($this->ca_idcotizacion);

		$copyObj->setCaIdmoneda($this->ca_idmoneda);

		$copyObj->setCaPrimaTip($this->ca_prima_tip);

		$copyObj->setCaPrimaVlr($this->ca_prima_vlr);

		$copyObj->setCaPrimaMin($this->ca_prima_min);

		$copyObj->setCaObtencion($this->ca_obtencion);

		$copyObj->setCaObservaciones($this->ca_observaciones);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);

		$copyObj->setCaTransporte($this->ca_transporte);


		$copyObj->setNew(true);

		$copyObj->setCaIdseguro(NULL); // this is a auto-increment column, so set to default value

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
	 * @return     CotSeguro Clone of current object.
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
	 * @return     CotSeguroPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new CotSeguroPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Cotizacion object.
	 *
	 * @param      Cotizacion $v
	 * @return     CotSeguro The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setCotizacion(Cotizacion $v = null)
	{
		if ($v === null) {
			$this->setCaIdcotizacion(NULL);
		} else {
			$this->setCaIdcotizacion($v->getCaIdcotizacion());
		}

		$this->aCotizacion = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Cotizacion object, it will not be re-added.
		if ($v !== null) {
			$v->addCotSeguro($this);
		}

		return $this;
	}


	/**
	 * Get the associated Cotizacion object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Cotizacion The associated Cotizacion object.
	 * @throws     PropelException
	 */
	public function getCotizacion(PropelPDO $con = null)
	{
		if ($this->aCotizacion === null && ($this->ca_idcotizacion !== null)) {
			$c = new Criteria(CotizacionPeer::DATABASE_NAME);
			$c->add(CotizacionPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);
			$this->aCotizacion = CotizacionPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aCotizacion->addCotSeguros($this);
			 */
		}
		return $this->aCotizacion;
	}

	/**
	 * Declares an association between this object and a Moneda object.
	 *
	 * @param      Moneda $v
	 * @return     CotSeguro The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setMoneda(Moneda $v = null)
	{
		if ($v === null) {
			$this->setCaIdmoneda(NULL);
		} else {
			$this->setCaIdmoneda($v->getCaIdmoneda());
		}

		$this->aMoneda = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Moneda object, it will not be re-added.
		if ($v !== null) {
			$v->addCotSeguro($this);
		}

		return $this;
	}


	/**
	 * Get the associated Moneda object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Moneda The associated Moneda object.
	 * @throws     PropelException
	 */
	public function getMoneda(PropelPDO $con = null)
	{
		if ($this->aMoneda === null && (($this->ca_idmoneda !== "" && $this->ca_idmoneda !== null))) {
			$c = new Criteria(MonedaPeer::DATABASE_NAME);
			$c->add(MonedaPeer::CA_IDMONEDA, $this->ca_idmoneda);
			$this->aMoneda = MonedaPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aMoneda->addCotSeguros($this);
			 */
		}
		return $this->aMoneda;
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
		} // if ($deep)

			$this->aCotizacion = null;
			$this->aMoneda = null;
	}

} // BaseCotSeguro
