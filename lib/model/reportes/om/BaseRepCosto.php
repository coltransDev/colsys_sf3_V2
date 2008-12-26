<?php

/**
 * Base class that represents a row from the 'tb_repaduanadet' table.
 *
 * 
 *
 * @package    lib.model.reportes.om
 */
abstract class BaseRepCosto extends BaseObject  implements Persistent {


  const PEER = 'RepCostoPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        RepCostoPeer
	 */
	protected static $peer;

	/**
	 * The value for the oid field.
	 * @var        int
	 */
	protected $oid;

	/**
	 * The value for the ca_idreporte field.
	 * @var        int
	 */
	protected $ca_idreporte;

	/**
	 * The value for the ca_idcosto field.
	 * @var        int
	 */
	protected $ca_idcosto;

	/**
	 * The value for the ca_tipo field.
	 * @var        string
	 */
	protected $ca_tipo;

	/**
	 * The value for the ca_vlrcosto field.
	 * @var        string
	 */
	protected $ca_vlrcosto;

	/**
	 * The value for the ca_mincosto field.
	 * @var        string
	 */
	protected $ca_mincosto;

	/**
	 * The value for the ca_netcosto field.
	 * @var        string
	 */
	protected $ca_netcosto;

	/**
	 * The value for the ca_idmoneda field.
	 * @var        string
	 */
	protected $ca_idmoneda;

	/**
	 * The value for the ca_detalles field.
	 * @var        string
	 */
	protected $ca_detalles;

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
	 * @var        Reporte
	 */
	protected $aReporte;

	/**
	 * @var        Costo
	 */
	protected $aCosto;

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
	 * Initializes internal state of BaseRepCosto object.
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
	 * Get the [ca_idreporte] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdreporte()
	{
		return $this->ca_idreporte;
	}

	/**
	 * Get the [ca_idcosto] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdcosto()
	{
		return $this->ca_idcosto;
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
	 * Get the [ca_vlrcosto] column value.
	 * 
	 * @return     string
	 */
	public function getCaVlrcosto()
	{
		return $this->ca_vlrcosto;
	}

	/**
	 * Get the [ca_mincosto] column value.
	 * 
	 * @return     string
	 */
	public function getCaMincosto()
	{
		return $this->ca_mincosto;
	}

	/**
	 * Get the [ca_netcosto] column value.
	 * 
	 * @return     string
	 */
	public function getCaNetcosto()
	{
		return $this->ca_netcosto;
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
	 * Get the [ca_detalles] column value.
	 * 
	 * @return     string
	 */
	public function getCaDetalles()
	{
		return $this->ca_detalles;
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
	public function getCaFchactualizado($format = 'Y-m-d')
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
	 * Set the value of [oid] column.
	 * 
	 * @param      int $v new value
	 * @return     RepCosto The current object (for fluent API support)
	 */
	public function setOid($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->oid !== $v) {
			$this->oid = $v;
			$this->modifiedColumns[] = RepCostoPeer::OID;
		}

		return $this;
	} // setOid()

	/**
	 * Set the value of [ca_idreporte] column.
	 * 
	 * @param      int $v new value
	 * @return     RepCosto The current object (for fluent API support)
	 */
	public function setCaIdreporte($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idreporte !== $v) {
			$this->ca_idreporte = $v;
			$this->modifiedColumns[] = RepCostoPeer::CA_IDREPORTE;
		}

		if ($this->aReporte !== null && $this->aReporte->getCaIdreporte() !== $v) {
			$this->aReporte = null;
		}

		return $this;
	} // setCaIdreporte()

	/**
	 * Set the value of [ca_idcosto] column.
	 * 
	 * @param      int $v new value
	 * @return     RepCosto The current object (for fluent API support)
	 */
	public function setCaIdcosto($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idcosto !== $v) {
			$this->ca_idcosto = $v;
			$this->modifiedColumns[] = RepCostoPeer::CA_IDCOSTO;
		}

		if ($this->aCosto !== null && $this->aCosto->getCaIdcosto() !== $v) {
			$this->aCosto = null;
		}

		return $this;
	} // setCaIdcosto()

	/**
	 * Set the value of [ca_tipo] column.
	 * 
	 * @param      string $v new value
	 * @return     RepCosto The current object (for fluent API support)
	 */
	public function setCaTipo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_tipo !== $v) {
			$this->ca_tipo = $v;
			$this->modifiedColumns[] = RepCostoPeer::CA_TIPO;
		}

		return $this;
	} // setCaTipo()

	/**
	 * Set the value of [ca_vlrcosto] column.
	 * 
	 * @param      string $v new value
	 * @return     RepCosto The current object (for fluent API support)
	 */
	public function setCaVlrcosto($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_vlrcosto !== $v) {
			$this->ca_vlrcosto = $v;
			$this->modifiedColumns[] = RepCostoPeer::CA_VLRCOSTO;
		}

		return $this;
	} // setCaVlrcosto()

	/**
	 * Set the value of [ca_mincosto] column.
	 * 
	 * @param      string $v new value
	 * @return     RepCosto The current object (for fluent API support)
	 */
	public function setCaMincosto($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_mincosto !== $v) {
			$this->ca_mincosto = $v;
			$this->modifiedColumns[] = RepCostoPeer::CA_MINCOSTO;
		}

		return $this;
	} // setCaMincosto()

	/**
	 * Set the value of [ca_netcosto] column.
	 * 
	 * @param      string $v new value
	 * @return     RepCosto The current object (for fluent API support)
	 */
	public function setCaNetcosto($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_netcosto !== $v) {
			$this->ca_netcosto = $v;
			$this->modifiedColumns[] = RepCostoPeer::CA_NETCOSTO;
		}

		return $this;
	} // setCaNetcosto()

	/**
	 * Set the value of [ca_idmoneda] column.
	 * 
	 * @param      string $v new value
	 * @return     RepCosto The current object (for fluent API support)
	 */
	public function setCaIdmoneda($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idmoneda !== $v) {
			$this->ca_idmoneda = $v;
			$this->modifiedColumns[] = RepCostoPeer::CA_IDMONEDA;
		}

		return $this;
	} // setCaIdmoneda()

	/**
	 * Set the value of [ca_detalles] column.
	 * 
	 * @param      string $v new value
	 * @return     RepCosto The current object (for fluent API support)
	 */
	public function setCaDetalles($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_detalles !== $v) {
			$this->ca_detalles = $v;
			$this->modifiedColumns[] = RepCostoPeer::CA_DETALLES;
		}

		return $this;
	} // setCaDetalles()

	/**
	 * Sets the value of [ca_fchcreado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     RepCosto The current object (for fluent API support)
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
				$this->modifiedColumns[] = RepCostoPeer::CA_FCHCREADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchcreado()

	/**
	 * Set the value of [ca_usucreado] column.
	 * 
	 * @param      string $v new value
	 * @return     RepCosto The current object (for fluent API support)
	 */
	public function setCaUsucreado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usucreado !== $v) {
			$this->ca_usucreado = $v;
			$this->modifiedColumns[] = RepCostoPeer::CA_USUCREADO;
		}

		return $this;
	} // setCaUsucreado()

	/**
	 * Sets the value of [ca_fchactualizado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     RepCosto The current object (for fluent API support)
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

			$currNorm = ($this->ca_fchactualizado !== null && $tmpDt = new DateTime($this->ca_fchactualizado)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchactualizado = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = RepCostoPeer::CA_FCHACTUALIZADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchactualizado()

	/**
	 * Set the value of [ca_usuactualizado] column.
	 * 
	 * @param      string $v new value
	 * @return     RepCosto The current object (for fluent API support)
	 */
	public function setCaUsuactualizado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usuactualizado !== $v) {
			$this->ca_usuactualizado = $v;
			$this->modifiedColumns[] = RepCostoPeer::CA_USUACTUALIZADO;
		}

		return $this;
	} // setCaUsuactualizado()

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
			$this->ca_idreporte = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_idcosto = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->ca_tipo = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_vlrcosto = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_mincosto = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_netcosto = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_idmoneda = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_detalles = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_fchcreado = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_usucreado = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_fchactualizado = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_usuactualizado = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 13; // 13 = RepCostoPeer::NUM_COLUMNS - RepCostoPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating RepCosto object", $e);
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

		if ($this->aReporte !== null && $this->ca_idreporte !== $this->aReporte->getCaIdreporte()) {
			$this->aReporte = null;
		}
		if ($this->aCosto !== null && $this->ca_idcosto !== $this->aCosto->getCaIdcosto()) {
			$this->aCosto = null;
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
			$con = Propel::getConnection(RepCostoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = RepCostoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aReporte = null;
			$this->aCosto = null;
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
			$con = Propel::getConnection(RepCostoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			RepCostoPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(RepCostoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			RepCostoPeer::addInstanceToPool($this);
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

			if ($this->aReporte !== null) {
				if ($this->aReporte->isModified() || $this->aReporte->isNew()) {
					$affectedRows += $this->aReporte->save($con);
				}
				$this->setReporte($this->aReporte);
			}

			if ($this->aCosto !== null) {
				if ($this->aCosto->isModified() || $this->aCosto->isNew()) {
					$affectedRows += $this->aCosto->save($con);
				}
				$this->setCosto($this->aCosto);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = RepCostoPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += RepCostoPeer::doUpdate($this, $con);
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

			if ($this->aReporte !== null) {
				if (!$this->aReporte->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aReporte->getValidationFailures());
				}
			}

			if ($this->aCosto !== null) {
				if (!$this->aCosto->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCosto->getValidationFailures());
				}
			}


			if (($retval = RepCostoPeer::doValidate($this, $columns)) !== true) {
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
		$pos = RepCostoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdreporte();
				break;
			case 2:
				return $this->getCaIdcosto();
				break;
			case 3:
				return $this->getCaTipo();
				break;
			case 4:
				return $this->getCaVlrcosto();
				break;
			case 5:
				return $this->getCaMincosto();
				break;
			case 6:
				return $this->getCaNetcosto();
				break;
			case 7:
				return $this->getCaIdmoneda();
				break;
			case 8:
				return $this->getCaDetalles();
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
	 * @param      string $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                        BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. Defaults to BasePeer::TYPE_PHPNAME.
	 * @param      boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns.  Defaults to TRUE.
	 * @return     an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = RepCostoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getOid(),
			$keys[1] => $this->getCaIdreporte(),
			$keys[2] => $this->getCaIdcosto(),
			$keys[3] => $this->getCaTipo(),
			$keys[4] => $this->getCaVlrcosto(),
			$keys[5] => $this->getCaMincosto(),
			$keys[6] => $this->getCaNetcosto(),
			$keys[7] => $this->getCaIdmoneda(),
			$keys[8] => $this->getCaDetalles(),
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
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RepCostoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdreporte($value);
				break;
			case 2:
				$this->setCaIdcosto($value);
				break;
			case 3:
				$this->setCaTipo($value);
				break;
			case 4:
				$this->setCaVlrcosto($value);
				break;
			case 5:
				$this->setCaMincosto($value);
				break;
			case 6:
				$this->setCaNetcosto($value);
				break;
			case 7:
				$this->setCaIdmoneda($value);
				break;
			case 8:
				$this->setCaDetalles($value);
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
		$keys = RepCostoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setOid($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdreporte($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaIdcosto($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaTipo($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaVlrcosto($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaMincosto($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaNetcosto($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaIdmoneda($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaDetalles($arr[$keys[8]]);
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
		$criteria = new Criteria(RepCostoPeer::DATABASE_NAME);

		if ($this->isColumnModified(RepCostoPeer::OID)) $criteria->add(RepCostoPeer::OID, $this->oid);
		if ($this->isColumnModified(RepCostoPeer::CA_IDREPORTE)) $criteria->add(RepCostoPeer::CA_IDREPORTE, $this->ca_idreporte);
		if ($this->isColumnModified(RepCostoPeer::CA_IDCOSTO)) $criteria->add(RepCostoPeer::CA_IDCOSTO, $this->ca_idcosto);
		if ($this->isColumnModified(RepCostoPeer::CA_TIPO)) $criteria->add(RepCostoPeer::CA_TIPO, $this->ca_tipo);
		if ($this->isColumnModified(RepCostoPeer::CA_VLRCOSTO)) $criteria->add(RepCostoPeer::CA_VLRCOSTO, $this->ca_vlrcosto);
		if ($this->isColumnModified(RepCostoPeer::CA_MINCOSTO)) $criteria->add(RepCostoPeer::CA_MINCOSTO, $this->ca_mincosto);
		if ($this->isColumnModified(RepCostoPeer::CA_NETCOSTO)) $criteria->add(RepCostoPeer::CA_NETCOSTO, $this->ca_netcosto);
		if ($this->isColumnModified(RepCostoPeer::CA_IDMONEDA)) $criteria->add(RepCostoPeer::CA_IDMONEDA, $this->ca_idmoneda);
		if ($this->isColumnModified(RepCostoPeer::CA_DETALLES)) $criteria->add(RepCostoPeer::CA_DETALLES, $this->ca_detalles);
		if ($this->isColumnModified(RepCostoPeer::CA_FCHCREADO)) $criteria->add(RepCostoPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(RepCostoPeer::CA_USUCREADO)) $criteria->add(RepCostoPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(RepCostoPeer::CA_FCHACTUALIZADO)) $criteria->add(RepCostoPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(RepCostoPeer::CA_USUACTUALIZADO)) $criteria->add(RepCostoPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);

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
		$criteria = new Criteria(RepCostoPeer::DATABASE_NAME);

		$criteria->add(RepCostoPeer::OID, $this->oid);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getOid();
	}

	/**
	 * Generic method to set the primary key (oid column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setOid($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of RepCosto (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setOid($this->oid);

		$copyObj->setCaIdreporte($this->ca_idreporte);

		$copyObj->setCaIdcosto($this->ca_idcosto);

		$copyObj->setCaTipo($this->ca_tipo);

		$copyObj->setCaVlrcosto($this->ca_vlrcosto);

		$copyObj->setCaMincosto($this->ca_mincosto);

		$copyObj->setCaNetcosto($this->ca_netcosto);

		$copyObj->setCaIdmoneda($this->ca_idmoneda);

		$copyObj->setCaDetalles($this->ca_detalles);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);


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
	 * @return     RepCosto Clone of current object.
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
	 * @return     RepCostoPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new RepCostoPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Reporte object.
	 *
	 * @param      Reporte $v
	 * @return     RepCosto The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setReporte(Reporte $v = null)
	{
		if ($v === null) {
			$this->setCaIdreporte(NULL);
		} else {
			$this->setCaIdreporte($v->getCaIdreporte());
		}

		$this->aReporte = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Reporte object, it will not be re-added.
		if ($v !== null) {
			$v->addRepCosto($this);
		}

		return $this;
	}


	/**
	 * Get the associated Reporte object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Reporte The associated Reporte object.
	 * @throws     PropelException
	 */
	public function getReporte(PropelPDO $con = null)
	{
		if ($this->aReporte === null && ($this->ca_idreporte !== null)) {
			$c = new Criteria(ReportePeer::DATABASE_NAME);
			$c->add(ReportePeer::CA_IDREPORTE, $this->ca_idreporte);
			$this->aReporte = ReportePeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aReporte->addRepCostos($this);
			 */
		}
		return $this->aReporte;
	}

	/**
	 * Declares an association between this object and a Costo object.
	 *
	 * @param      Costo $v
	 * @return     RepCosto The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setCosto(Costo $v = null)
	{
		if ($v === null) {
			$this->setCaIdcosto(NULL);
		} else {
			$this->setCaIdcosto($v->getCaIdcosto());
		}

		$this->aCosto = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Costo object, it will not be re-added.
		if ($v !== null) {
			$v->addRepCosto($this);
		}

		return $this;
	}


	/**
	 * Get the associated Costo object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Costo The associated Costo object.
	 * @throws     PropelException
	 */
	public function getCosto(PropelPDO $con = null)
	{
		if ($this->aCosto === null && ($this->ca_idcosto !== null)) {
			$c = new Criteria(CostoPeer::DATABASE_NAME);
			$c->add(CostoPeer::CA_IDCOSTO, $this->ca_idcosto);
			$this->aCosto = CostoPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aCosto->addRepCostos($this);
			 */
		}
		return $this->aCosto;
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

			$this->aReporte = null;
			$this->aCosto = null;
	}

} // BaseRepCosto
