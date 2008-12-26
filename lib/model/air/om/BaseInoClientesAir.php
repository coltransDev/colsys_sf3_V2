<?php

/**
 * Base class that represents a row from the 'tb_inoclientes_air' table.
 *
 * 
 *
 * @package    lib.model.air.om
 */
abstract class BaseInoClientesAir extends BaseObject  implements Persistent {


  const PEER = 'InoClientesAirPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        InoClientesAirPeer
	 */
	protected static $peer;

	/**
	 * The value for the ca_referencia field.
	 * @var        string
	 */
	protected $ca_referencia;

	/**
	 * The value for the ca_idcliente field.
	 * @var        int
	 */
	protected $ca_idcliente;

	/**
	 * The value for the ca_hawb field.
	 * @var        string
	 */
	protected $ca_hawb;

	/**
	 * The value for the ca_idreporte field.
	 * @var        string
	 */
	protected $ca_idreporte;

	/**
	 * The value for the ca_idproveedor field.
	 * @var        int
	 */
	protected $ca_idproveedor;

	/**
	 * The value for the ca_proveedor field.
	 * @var        string
	 */
	protected $ca_proveedor;

	/**
	 * The value for the ca_numpiezas field.
	 * @var        int
	 */
	protected $ca_numpiezas;

	/**
	 * The value for the ca_peso field.
	 * @var        int
	 */
	protected $ca_peso;

	/**
	 * The value for the ca_volumen field.
	 * @var        int
	 */
	protected $ca_volumen;

	/**
	 * The value for the ca_numorden field.
	 * @var        string
	 */
	protected $ca_numorden;

	/**
	 * The value for the ca_loginvendedor field.
	 * @var        string
	 */
	protected $ca_loginvendedor;

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
	 * The value for the ca_idbodega field.
	 * @var        int
	 */
	protected $ca_idbodega;

	/**
	 * @var        Reporte
	 */
	protected $aReporte;

	/**
	 * @var        Tercero
	 */
	protected $aTercero;

	/**
	 * @var        InoMaestraAir
	 */
	protected $aInoMaestraAir;

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
	 * Initializes internal state of BaseInoClientesAir object.
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
	 * Get the [ca_referencia] column value.
	 * 
	 * @return     string
	 */
	public function getCaReferencia()
	{
		return $this->ca_referencia;
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
	 * Get the [ca_hawb] column value.
	 * 
	 * @return     string
	 */
	public function getCaHawb()
	{
		return $this->ca_hawb;
	}

	/**
	 * Get the [ca_idreporte] column value.
	 * 
	 * @return     string
	 */
	public function getCaIdreporte()
	{
		return $this->ca_idreporte;
	}

	/**
	 * Get the [ca_idproveedor] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdproveedor()
	{
		return $this->ca_idproveedor;
	}

	/**
	 * Get the [ca_proveedor] column value.
	 * 
	 * @return     string
	 */
	public function getCaProveedor()
	{
		return $this->ca_proveedor;
	}

	/**
	 * Get the [ca_numpiezas] column value.
	 * 
	 * @return     int
	 */
	public function getCaNumpiezas()
	{
		return $this->ca_numpiezas;
	}

	/**
	 * Get the [ca_peso] column value.
	 * 
	 * @return     int
	 */
	public function getCaPeso()
	{
		return $this->ca_peso;
	}

	/**
	 * Get the [ca_volumen] column value.
	 * 
	 * @return     int
	 */
	public function getCaVolumen()
	{
		return $this->ca_volumen;
	}

	/**
	 * Get the [ca_numorden] column value.
	 * 
	 * @return     string
	 */
	public function getCaNumorden()
	{
		return $this->ca_numorden;
	}

	/**
	 * Get the [ca_loginvendedor] column value.
	 * 
	 * @return     string
	 */
	public function getCaLoginvendedor()
	{
		return $this->ca_loginvendedor;
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
	 * Get the [ca_idbodega] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdbodega()
	{
		return $this->ca_idbodega;
	}

	/**
	 * Set the value of [ca_referencia] column.
	 * 
	 * @param      string $v new value
	 * @return     InoClientesAir The current object (for fluent API support)
	 */
	public function setCaReferencia($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_referencia !== $v) {
			$this->ca_referencia = $v;
			$this->modifiedColumns[] = InoClientesAirPeer::CA_REFERENCIA;
		}

		if ($this->aInoMaestraAir !== null && $this->aInoMaestraAir->getCaReferencia() !== $v) {
			$this->aInoMaestraAir = null;
		}

		return $this;
	} // setCaReferencia()

	/**
	 * Set the value of [ca_idcliente] column.
	 * 
	 * @param      int $v new value
	 * @return     InoClientesAir The current object (for fluent API support)
	 */
	public function setCaIdcliente($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idcliente !== $v) {
			$this->ca_idcliente = $v;
			$this->modifiedColumns[] = InoClientesAirPeer::CA_IDCLIENTE;
		}

		return $this;
	} // setCaIdcliente()

	/**
	 * Set the value of [ca_hawb] column.
	 * 
	 * @param      string $v new value
	 * @return     InoClientesAir The current object (for fluent API support)
	 */
	public function setCaHawb($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_hawb !== $v) {
			$this->ca_hawb = $v;
			$this->modifiedColumns[] = InoClientesAirPeer::CA_HAWB;
		}

		return $this;
	} // setCaHawb()

	/**
	 * Set the value of [ca_idreporte] column.
	 * 
	 * @param      string $v new value
	 * @return     InoClientesAir The current object (for fluent API support)
	 */
	public function setCaIdreporte($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idreporte !== $v) {
			$this->ca_idreporte = $v;
			$this->modifiedColumns[] = InoClientesAirPeer::CA_IDREPORTE;
		}

		if ($this->aReporte !== null && $this->aReporte->getCaIdreporte() !== $v) {
			$this->aReporte = null;
		}

		return $this;
	} // setCaIdreporte()

	/**
	 * Set the value of [ca_idproveedor] column.
	 * 
	 * @param      int $v new value
	 * @return     InoClientesAir The current object (for fluent API support)
	 */
	public function setCaIdproveedor($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idproveedor !== $v) {
			$this->ca_idproveedor = $v;
			$this->modifiedColumns[] = InoClientesAirPeer::CA_IDPROVEEDOR;
		}

		if ($this->aTercero !== null && $this->aTercero->getCaIdtercero() !== $v) {
			$this->aTercero = null;
		}

		return $this;
	} // setCaIdproveedor()

	/**
	 * Set the value of [ca_proveedor] column.
	 * 
	 * @param      string $v new value
	 * @return     InoClientesAir The current object (for fluent API support)
	 */
	public function setCaProveedor($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_proveedor !== $v) {
			$this->ca_proveedor = $v;
			$this->modifiedColumns[] = InoClientesAirPeer::CA_PROVEEDOR;
		}

		return $this;
	} // setCaProveedor()

	/**
	 * Set the value of [ca_numpiezas] column.
	 * 
	 * @param      int $v new value
	 * @return     InoClientesAir The current object (for fluent API support)
	 */
	public function setCaNumpiezas($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_numpiezas !== $v) {
			$this->ca_numpiezas = $v;
			$this->modifiedColumns[] = InoClientesAirPeer::CA_NUMPIEZAS;
		}

		return $this;
	} // setCaNumpiezas()

	/**
	 * Set the value of [ca_peso] column.
	 * 
	 * @param      int $v new value
	 * @return     InoClientesAir The current object (for fluent API support)
	 */
	public function setCaPeso($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_peso !== $v) {
			$this->ca_peso = $v;
			$this->modifiedColumns[] = InoClientesAirPeer::CA_PESO;
		}

		return $this;
	} // setCaPeso()

	/**
	 * Set the value of [ca_volumen] column.
	 * 
	 * @param      int $v new value
	 * @return     InoClientesAir The current object (for fluent API support)
	 */
	public function setCaVolumen($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_volumen !== $v) {
			$this->ca_volumen = $v;
			$this->modifiedColumns[] = InoClientesAirPeer::CA_VOLUMEN;
		}

		return $this;
	} // setCaVolumen()

	/**
	 * Set the value of [ca_numorden] column.
	 * 
	 * @param      string $v new value
	 * @return     InoClientesAir The current object (for fluent API support)
	 */
	public function setCaNumorden($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_numorden !== $v) {
			$this->ca_numorden = $v;
			$this->modifiedColumns[] = InoClientesAirPeer::CA_NUMORDEN;
		}

		return $this;
	} // setCaNumorden()

	/**
	 * Set the value of [ca_loginvendedor] column.
	 * 
	 * @param      string $v new value
	 * @return     InoClientesAir The current object (for fluent API support)
	 */
	public function setCaLoginvendedor($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_loginvendedor !== $v) {
			$this->ca_loginvendedor = $v;
			$this->modifiedColumns[] = InoClientesAirPeer::CA_LOGINVENDEDOR;
		}

		return $this;
	} // setCaLoginvendedor()

	/**
	 * Sets the value of [ca_fchcreado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     InoClientesAir The current object (for fluent API support)
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
				$this->modifiedColumns[] = InoClientesAirPeer::CA_FCHCREADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchcreado()

	/**
	 * Set the value of [ca_usucreado] column.
	 * 
	 * @param      string $v new value
	 * @return     InoClientesAir The current object (for fluent API support)
	 */
	public function setCaUsucreado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usucreado !== $v) {
			$this->ca_usucreado = $v;
			$this->modifiedColumns[] = InoClientesAirPeer::CA_USUCREADO;
		}

		return $this;
	} // setCaUsucreado()

	/**
	 * Sets the value of [ca_fchactualizado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     InoClientesAir The current object (for fluent API support)
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
				$this->modifiedColumns[] = InoClientesAirPeer::CA_FCHACTUALIZADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchactualizado()

	/**
	 * Set the value of [ca_usuactualizado] column.
	 * 
	 * @param      string $v new value
	 * @return     InoClientesAir The current object (for fluent API support)
	 */
	public function setCaUsuactualizado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usuactualizado !== $v) {
			$this->ca_usuactualizado = $v;
			$this->modifiedColumns[] = InoClientesAirPeer::CA_USUACTUALIZADO;
		}

		return $this;
	} // setCaUsuactualizado()

	/**
	 * Set the value of [ca_idbodega] column.
	 * 
	 * @param      int $v new value
	 * @return     InoClientesAir The current object (for fluent API support)
	 */
	public function setCaIdbodega($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idbodega !== $v) {
			$this->ca_idbodega = $v;
			$this->modifiedColumns[] = InoClientesAirPeer::CA_IDBODEGA;
		}

		return $this;
	} // setCaIdbodega()

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

			$this->ca_referencia = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ca_idcliente = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_hawb = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_idreporte = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_idproveedor = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->ca_proveedor = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_numpiezas = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
			$this->ca_peso = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
			$this->ca_volumen = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
			$this->ca_numorden = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_loginvendedor = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_fchcreado = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_usucreado = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_fchactualizado = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->ca_usuactualizado = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->ca_idbodega = ($row[$startcol + 15] !== null) ? (int) $row[$startcol + 15] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 16; // 16 = InoClientesAirPeer::NUM_COLUMNS - InoClientesAirPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating InoClientesAir object", $e);
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

		if ($this->aInoMaestraAir !== null && $this->ca_referencia !== $this->aInoMaestraAir->getCaReferencia()) {
			$this->aInoMaestraAir = null;
		}
		if ($this->aReporte !== null && $this->ca_idreporte !== $this->aReporte->getCaIdreporte()) {
			$this->aReporte = null;
		}
		if ($this->aTercero !== null && $this->ca_idproveedor !== $this->aTercero->getCaIdtercero()) {
			$this->aTercero = null;
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
			$con = Propel::getConnection(InoClientesAirPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = InoClientesAirPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aReporte = null;
			$this->aTercero = null;
			$this->aInoMaestraAir = null;
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
			$con = Propel::getConnection(InoClientesAirPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			InoClientesAirPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(InoClientesAirPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			InoClientesAirPeer::addInstanceToPool($this);
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

			if ($this->aTercero !== null) {
				if ($this->aTercero->isModified() || $this->aTercero->isNew()) {
					$affectedRows += $this->aTercero->save($con);
				}
				$this->setTercero($this->aTercero);
			}

			if ($this->aInoMaestraAir !== null) {
				if ($this->aInoMaestraAir->isModified() || $this->aInoMaestraAir->isNew()) {
					$affectedRows += $this->aInoMaestraAir->save($con);
				}
				$this->setInoMaestraAir($this->aInoMaestraAir);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = InoClientesAirPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += InoClientesAirPeer::doUpdate($this, $con);
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

			if ($this->aTercero !== null) {
				if (!$this->aTercero->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTercero->getValidationFailures());
				}
			}

			if ($this->aInoMaestraAir !== null) {
				if (!$this->aInoMaestraAir->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aInoMaestraAir->getValidationFailures());
				}
			}


			if (($retval = InoClientesAirPeer::doValidate($this, $columns)) !== true) {
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
		$pos = InoClientesAirPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaReferencia();
				break;
			case 1:
				return $this->getCaIdcliente();
				break;
			case 2:
				return $this->getCaHawb();
				break;
			case 3:
				return $this->getCaIdreporte();
				break;
			case 4:
				return $this->getCaIdproveedor();
				break;
			case 5:
				return $this->getCaProveedor();
				break;
			case 6:
				return $this->getCaNumpiezas();
				break;
			case 7:
				return $this->getCaPeso();
				break;
			case 8:
				return $this->getCaVolumen();
				break;
			case 9:
				return $this->getCaNumorden();
				break;
			case 10:
				return $this->getCaLoginvendedor();
				break;
			case 11:
				return $this->getCaFchcreado();
				break;
			case 12:
				return $this->getCaUsucreado();
				break;
			case 13:
				return $this->getCaFchactualizado();
				break;
			case 14:
				return $this->getCaUsuactualizado();
				break;
			case 15:
				return $this->getCaIdbodega();
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
		$keys = InoClientesAirPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaReferencia(),
			$keys[1] => $this->getCaIdcliente(),
			$keys[2] => $this->getCaHawb(),
			$keys[3] => $this->getCaIdreporte(),
			$keys[4] => $this->getCaIdproveedor(),
			$keys[5] => $this->getCaProveedor(),
			$keys[6] => $this->getCaNumpiezas(),
			$keys[7] => $this->getCaPeso(),
			$keys[8] => $this->getCaVolumen(),
			$keys[9] => $this->getCaNumorden(),
			$keys[10] => $this->getCaLoginvendedor(),
			$keys[11] => $this->getCaFchcreado(),
			$keys[12] => $this->getCaUsucreado(),
			$keys[13] => $this->getCaFchactualizado(),
			$keys[14] => $this->getCaUsuactualizado(),
			$keys[15] => $this->getCaIdbodega(),
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
		$pos = InoClientesAirPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaReferencia($value);
				break;
			case 1:
				$this->setCaIdcliente($value);
				break;
			case 2:
				$this->setCaHawb($value);
				break;
			case 3:
				$this->setCaIdreporte($value);
				break;
			case 4:
				$this->setCaIdproveedor($value);
				break;
			case 5:
				$this->setCaProveedor($value);
				break;
			case 6:
				$this->setCaNumpiezas($value);
				break;
			case 7:
				$this->setCaPeso($value);
				break;
			case 8:
				$this->setCaVolumen($value);
				break;
			case 9:
				$this->setCaNumorden($value);
				break;
			case 10:
				$this->setCaLoginvendedor($value);
				break;
			case 11:
				$this->setCaFchcreado($value);
				break;
			case 12:
				$this->setCaUsucreado($value);
				break;
			case 13:
				$this->setCaFchactualizado($value);
				break;
			case 14:
				$this->setCaUsuactualizado($value);
				break;
			case 15:
				$this->setCaIdbodega($value);
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
		$keys = InoClientesAirPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaReferencia($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdcliente($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaHawb($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaIdreporte($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaIdproveedor($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaProveedor($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaNumpiezas($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaPeso($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaVolumen($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaNumorden($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaLoginvendedor($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaFchcreado($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaUsucreado($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaFchactualizado($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaUsuactualizado($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaIdbodega($arr[$keys[15]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(InoClientesAirPeer::DATABASE_NAME);

		if ($this->isColumnModified(InoClientesAirPeer::CA_REFERENCIA)) $criteria->add(InoClientesAirPeer::CA_REFERENCIA, $this->ca_referencia);
		if ($this->isColumnModified(InoClientesAirPeer::CA_IDCLIENTE)) $criteria->add(InoClientesAirPeer::CA_IDCLIENTE, $this->ca_idcliente);
		if ($this->isColumnModified(InoClientesAirPeer::CA_HAWB)) $criteria->add(InoClientesAirPeer::CA_HAWB, $this->ca_hawb);
		if ($this->isColumnModified(InoClientesAirPeer::CA_IDREPORTE)) $criteria->add(InoClientesAirPeer::CA_IDREPORTE, $this->ca_idreporte);
		if ($this->isColumnModified(InoClientesAirPeer::CA_IDPROVEEDOR)) $criteria->add(InoClientesAirPeer::CA_IDPROVEEDOR, $this->ca_idproveedor);
		if ($this->isColumnModified(InoClientesAirPeer::CA_PROVEEDOR)) $criteria->add(InoClientesAirPeer::CA_PROVEEDOR, $this->ca_proveedor);
		if ($this->isColumnModified(InoClientesAirPeer::CA_NUMPIEZAS)) $criteria->add(InoClientesAirPeer::CA_NUMPIEZAS, $this->ca_numpiezas);
		if ($this->isColumnModified(InoClientesAirPeer::CA_PESO)) $criteria->add(InoClientesAirPeer::CA_PESO, $this->ca_peso);
		if ($this->isColumnModified(InoClientesAirPeer::CA_VOLUMEN)) $criteria->add(InoClientesAirPeer::CA_VOLUMEN, $this->ca_volumen);
		if ($this->isColumnModified(InoClientesAirPeer::CA_NUMORDEN)) $criteria->add(InoClientesAirPeer::CA_NUMORDEN, $this->ca_numorden);
		if ($this->isColumnModified(InoClientesAirPeer::CA_LOGINVENDEDOR)) $criteria->add(InoClientesAirPeer::CA_LOGINVENDEDOR, $this->ca_loginvendedor);
		if ($this->isColumnModified(InoClientesAirPeer::CA_FCHCREADO)) $criteria->add(InoClientesAirPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(InoClientesAirPeer::CA_USUCREADO)) $criteria->add(InoClientesAirPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(InoClientesAirPeer::CA_FCHACTUALIZADO)) $criteria->add(InoClientesAirPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(InoClientesAirPeer::CA_USUACTUALIZADO)) $criteria->add(InoClientesAirPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);
		if ($this->isColumnModified(InoClientesAirPeer::CA_IDBODEGA)) $criteria->add(InoClientesAirPeer::CA_IDBODEGA, $this->ca_idbodega);

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
		$criteria = new Criteria(InoClientesAirPeer::DATABASE_NAME);

		$criteria->add(InoClientesAirPeer::CA_REFERENCIA, $this->ca_referencia);
		$criteria->add(InoClientesAirPeer::CA_IDCLIENTE, $this->ca_idcliente);
		$criteria->add(InoClientesAirPeer::CA_HAWB, $this->ca_hawb);

		return $criteria;
	}

	/**
	 * Returns the composite primary key for this object.
	 * The array elements will be in same order as specified in XML.
	 * @return     array
	 */
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getCaReferencia();

		$pks[1] = $this->getCaIdcliente();

		$pks[2] = $this->getCaHawb();

		return $pks;
	}

	/**
	 * Set the [composite] primary key.
	 *
	 * @param      array $keys The elements of the composite key (order must match the order in XML file).
	 * @return     void
	 */
	public function setPrimaryKey($keys)
	{

		$this->setCaReferencia($keys[0]);

		$this->setCaIdcliente($keys[1]);

		$this->setCaHawb($keys[2]);

	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of InoClientesAir (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaReferencia($this->ca_referencia);

		$copyObj->setCaIdcliente($this->ca_idcliente);

		$copyObj->setCaHawb($this->ca_hawb);

		$copyObj->setCaIdreporte($this->ca_idreporte);

		$copyObj->setCaIdproveedor($this->ca_idproveedor);

		$copyObj->setCaProveedor($this->ca_proveedor);

		$copyObj->setCaNumpiezas($this->ca_numpiezas);

		$copyObj->setCaPeso($this->ca_peso);

		$copyObj->setCaVolumen($this->ca_volumen);

		$copyObj->setCaNumorden($this->ca_numorden);

		$copyObj->setCaLoginvendedor($this->ca_loginvendedor);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);

		$copyObj->setCaIdbodega($this->ca_idbodega);


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
	 * @return     InoClientesAir Clone of current object.
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
	 * @return     InoClientesAirPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new InoClientesAirPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Reporte object.
	 *
	 * @param      Reporte $v
	 * @return     InoClientesAir The current object (for fluent API support)
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
			$v->addInoClientesAir($this);
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
		if ($this->aReporte === null && (($this->ca_idreporte !== "" && $this->ca_idreporte !== null))) {
			$c = new Criteria(ReportePeer::DATABASE_NAME);
			$c->add(ReportePeer::CA_IDREPORTE, $this->ca_idreporte);
			$this->aReporte = ReportePeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aReporte->addInoClientesAirs($this);
			 */
		}
		return $this->aReporte;
	}

	/**
	 * Declares an association between this object and a Tercero object.
	 *
	 * @param      Tercero $v
	 * @return     InoClientesAir The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setTercero(Tercero $v = null)
	{
		if ($v === null) {
			$this->setCaIdproveedor(NULL);
		} else {
			$this->setCaIdproveedor($v->getCaIdtercero());
		}

		$this->aTercero = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Tercero object, it will not be re-added.
		if ($v !== null) {
			$v->addInoClientesAir($this);
		}

		return $this;
	}


	/**
	 * Get the associated Tercero object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Tercero The associated Tercero object.
	 * @throws     PropelException
	 */
	public function getTercero(PropelPDO $con = null)
	{
		if ($this->aTercero === null && ($this->ca_idproveedor !== null)) {
			$c = new Criteria(TerceroPeer::DATABASE_NAME);
			$c->add(TerceroPeer::CA_IDTERCERO, $this->ca_idproveedor);
			$this->aTercero = TerceroPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aTercero->addInoClientesAirs($this);
			 */
		}
		return $this->aTercero;
	}

	/**
	 * Declares an association between this object and a InoMaestraAir object.
	 *
	 * @param      InoMaestraAir $v
	 * @return     InoClientesAir The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setInoMaestraAir(InoMaestraAir $v = null)
	{
		if ($v === null) {
			$this->setCaReferencia(NULL);
		} else {
			$this->setCaReferencia($v->getCaReferencia());
		}

		$this->aInoMaestraAir = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the InoMaestraAir object, it will not be re-added.
		if ($v !== null) {
			$v->addInoClientesAir($this);
		}

		return $this;
	}


	/**
	 * Get the associated InoMaestraAir object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     InoMaestraAir The associated InoMaestraAir object.
	 * @throws     PropelException
	 */
	public function getInoMaestraAir(PropelPDO $con = null)
	{
		if ($this->aInoMaestraAir === null && (($this->ca_referencia !== "" && $this->ca_referencia !== null))) {
			$c = new Criteria(InoMaestraAirPeer::DATABASE_NAME);
			$c->add(InoMaestraAirPeer::CA_REFERENCIA, $this->ca_referencia);
			$this->aInoMaestraAir = InoMaestraAirPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aInoMaestraAir->addInoClientesAirs($this);
			 */
		}
		return $this->aInoMaestraAir;
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
			$this->aTercero = null;
			$this->aInoMaestraAir = null;
	}

} // BaseInoClientesAir
