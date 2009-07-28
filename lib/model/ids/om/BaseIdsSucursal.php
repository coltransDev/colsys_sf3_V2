<?php

/**
 * Base class that represents a row from the 'ids.tb_sucursales' table.
 *
 * 
 *
 * @package    lib.model.ids.om
 */
abstract class BaseIdsSucursal extends BaseObject  implements Persistent {


  const PEER = 'IdsSucursalPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        IdsSucursalPeer
	 */
	protected static $peer;

	/**
	 * The value for the ca_idsucursal field.
	 * @var        int
	 */
	protected $ca_idsucursal;

	/**
	 * The value for the ca_id field.
	 * @var        int
	 */
	protected $ca_id;

	/**
	 * The value for the ca_principal field.
	 * @var        boolean
	 */
	protected $ca_principal;

	/**
	 * The value for the ca_direccion field.
	 * @var        string
	 */
	protected $ca_direccion;

	/**
	 * The value for the ca_oficina field.
	 * @var        string
	 */
	protected $ca_oficina;

	/**
	 * The value for the ca_torre field.
	 * @var        int
	 */
	protected $ca_torre;

	/**
	 * The value for the ca_bloque field.
	 * @var        string
	 */
	protected $ca_bloque;

	/**
	 * The value for the ca_interior field.
	 * @var        string
	 */
	protected $ca_interior;

	/**
	 * The value for the ca_localidad field.
	 * @var        string
	 */
	protected $ca_localidad;

	/**
	 * The value for the ca_complemento field.
	 * @var        string
	 */
	protected $ca_complemento;

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
	 * @var        Ciudad
	 */
	protected $aCiudad;

	/**
	 * @var        Ids
	 */
	protected $aIds;

	/**
	 * @var        array IdsContacto[] Collection to store aggregation of IdsContacto objects.
	 */
	protected $collIdsContactos;

	/**
	 * @var        Criteria The criteria used to select the current contents of collIdsContactos.
	 */
	private $lastIdsContactoCriteria = null;

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
	 * Initializes internal state of BaseIdsSucursal object.
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
	 * Get the [ca_idsucursal] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdsucursal()
	{
		return $this->ca_idsucursal;
	}

	/**
	 * Get the [ca_id] column value.
	 * 
	 * @return     int
	 */
	public function getCaId()
	{
		return $this->ca_id;
	}

	/**
	 * Get the [ca_principal] column value.
	 * 
	 * @return     boolean
	 */
	public function getCaPrincipal()
	{
		return $this->ca_principal;
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
	 * Get the [ca_oficina] column value.
	 * 
	 * @return     string
	 */
	public function getCaOficina()
	{
		return $this->ca_oficina;
	}

	/**
	 * Get the [ca_torre] column value.
	 * 
	 * @return     int
	 */
	public function getCaTorre()
	{
		return $this->ca_torre;
	}

	/**
	 * Get the [ca_bloque] column value.
	 * 
	 * @return     string
	 */
	public function getCaBloque()
	{
		return $this->ca_bloque;
	}

	/**
	 * Get the [ca_interior] column value.
	 * 
	 * @return     string
	 */
	public function getCaInterior()
	{
		return $this->ca_interior;
	}

	/**
	 * Get the [ca_localidad] column value.
	 * 
	 * @return     string
	 */
	public function getCaLocalidad()
	{
		return $this->ca_localidad;
	}

	/**
	 * Get the [ca_complemento] column value.
	 * 
	 * @return     string
	 */
	public function getCaComplemento()
	{
		return $this->ca_complemento;
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
	 * Set the value of [ca_idsucursal] column.
	 * 
	 * @param      int $v new value
	 * @return     IdsSucursal The current object (for fluent API support)
	 */
	public function setCaIdsucursal($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idsucursal !== $v) {
			$this->ca_idsucursal = $v;
			$this->modifiedColumns[] = IdsSucursalPeer::CA_IDSUCURSAL;
		}

		return $this;
	} // setCaIdsucursal()

	/**
	 * Set the value of [ca_id] column.
	 * 
	 * @param      int $v new value
	 * @return     IdsSucursal The current object (for fluent API support)
	 */
	public function setCaId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_id !== $v) {
			$this->ca_id = $v;
			$this->modifiedColumns[] = IdsSucursalPeer::CA_ID;
		}

		if ($this->aIds !== null && $this->aIds->getCaId() !== $v) {
			$this->aIds = null;
		}

		return $this;
	} // setCaId()

	/**
	 * Set the value of [ca_principal] column.
	 * 
	 * @param      boolean $v new value
	 * @return     IdsSucursal The current object (for fluent API support)
	 */
	public function setCaPrincipal($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->ca_principal !== $v) {
			$this->ca_principal = $v;
			$this->modifiedColumns[] = IdsSucursalPeer::CA_PRINCIPAL;
		}

		return $this;
	} // setCaPrincipal()

	/**
	 * Set the value of [ca_direccion] column.
	 * 
	 * @param      string $v new value
	 * @return     IdsSucursal The current object (for fluent API support)
	 */
	public function setCaDireccion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_direccion !== $v) {
			$this->ca_direccion = $v;
			$this->modifiedColumns[] = IdsSucursalPeer::CA_DIRECCION;
		}

		return $this;
	} // setCaDireccion()

	/**
	 * Set the value of [ca_oficina] column.
	 * 
	 * @param      string $v new value
	 * @return     IdsSucursal The current object (for fluent API support)
	 */
	public function setCaOficina($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_oficina !== $v) {
			$this->ca_oficina = $v;
			$this->modifiedColumns[] = IdsSucursalPeer::CA_OFICINA;
		}

		return $this;
	} // setCaOficina()

	/**
	 * Set the value of [ca_torre] column.
	 * 
	 * @param      int $v new value
	 * @return     IdsSucursal The current object (for fluent API support)
	 */
	public function setCaTorre($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_torre !== $v) {
			$this->ca_torre = $v;
			$this->modifiedColumns[] = IdsSucursalPeer::CA_TORRE;
		}

		return $this;
	} // setCaTorre()

	/**
	 * Set the value of [ca_bloque] column.
	 * 
	 * @param      string $v new value
	 * @return     IdsSucursal The current object (for fluent API support)
	 */
	public function setCaBloque($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_bloque !== $v) {
			$this->ca_bloque = $v;
			$this->modifiedColumns[] = IdsSucursalPeer::CA_BLOQUE;
		}

		return $this;
	} // setCaBloque()

	/**
	 * Set the value of [ca_interior] column.
	 * 
	 * @param      string $v new value
	 * @return     IdsSucursal The current object (for fluent API support)
	 */
	public function setCaInterior($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_interior !== $v) {
			$this->ca_interior = $v;
			$this->modifiedColumns[] = IdsSucursalPeer::CA_INTERIOR;
		}

		return $this;
	} // setCaInterior()

	/**
	 * Set the value of [ca_localidad] column.
	 * 
	 * @param      string $v new value
	 * @return     IdsSucursal The current object (for fluent API support)
	 */
	public function setCaLocalidad($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_localidad !== $v) {
			$this->ca_localidad = $v;
			$this->modifiedColumns[] = IdsSucursalPeer::CA_LOCALIDAD;
		}

		return $this;
	} // setCaLocalidad()

	/**
	 * Set the value of [ca_complemento] column.
	 * 
	 * @param      string $v new value
	 * @return     IdsSucursal The current object (for fluent API support)
	 */
	public function setCaComplemento($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_complemento !== $v) {
			$this->ca_complemento = $v;
			$this->modifiedColumns[] = IdsSucursalPeer::CA_COMPLEMENTO;
		}

		return $this;
	} // setCaComplemento()

	/**
	 * Set the value of [ca_telefonos] column.
	 * 
	 * @param      string $v new value
	 * @return     IdsSucursal The current object (for fluent API support)
	 */
	public function setCaTelefonos($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_telefonos !== $v) {
			$this->ca_telefonos = $v;
			$this->modifiedColumns[] = IdsSucursalPeer::CA_TELEFONOS;
		}

		return $this;
	} // setCaTelefonos()

	/**
	 * Set the value of [ca_fax] column.
	 * 
	 * @param      string $v new value
	 * @return     IdsSucursal The current object (for fluent API support)
	 */
	public function setCaFax($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_fax !== $v) {
			$this->ca_fax = $v;
			$this->modifiedColumns[] = IdsSucursalPeer::CA_FAX;
		}

		return $this;
	} // setCaFax()

	/**
	 * Set the value of [ca_idciudad] column.
	 * 
	 * @param      string $v new value
	 * @return     IdsSucursal The current object (for fluent API support)
	 */
	public function setCaIdciudad($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idciudad !== $v) {
			$this->ca_idciudad = $v;
			$this->modifiedColumns[] = IdsSucursalPeer::CA_IDCIUDAD;
		}

		if ($this->aCiudad !== null && $this->aCiudad->getCaIdciudad() !== $v) {
			$this->aCiudad = null;
		}

		return $this;
	} // setCaIdciudad()

	/**
	 * Sets the value of [ca_fchcreado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     IdsSucursal The current object (for fluent API support)
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
				$this->modifiedColumns[] = IdsSucursalPeer::CA_FCHCREADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchcreado()

	/**
	 * Set the value of [ca_usucreado] column.
	 * 
	 * @param      string $v new value
	 * @return     IdsSucursal The current object (for fluent API support)
	 */
	public function setCaUsucreado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usucreado !== $v) {
			$this->ca_usucreado = $v;
			$this->modifiedColumns[] = IdsSucursalPeer::CA_USUCREADO;
		}

		return $this;
	} // setCaUsucreado()

	/**
	 * Sets the value of [ca_fchactualizado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     IdsSucursal The current object (for fluent API support)
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
				$this->modifiedColumns[] = IdsSucursalPeer::CA_FCHACTUALIZADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchactualizado()

	/**
	 * Set the value of [ca_usuactualizado] column.
	 * 
	 * @param      string $v new value
	 * @return     IdsSucursal The current object (for fluent API support)
	 */
	public function setCaUsuactualizado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usuactualizado !== $v) {
			$this->ca_usuactualizado = $v;
			$this->modifiedColumns[] = IdsSucursalPeer::CA_USUACTUALIZADO;
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

			$this->ca_idsucursal = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_principal = ($row[$startcol + 2] !== null) ? (boolean) $row[$startcol + 2] : null;
			$this->ca_direccion = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_oficina = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_torre = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
			$this->ca_bloque = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_interior = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_localidad = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_complemento = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_telefonos = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_fax = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_idciudad = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_fchcreado = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->ca_usucreado = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->ca_fchactualizado = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->ca_usuactualizado = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 17; // 17 = IdsSucursalPeer::NUM_COLUMNS - IdsSucursalPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating IdsSucursal object", $e);
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

		if ($this->aIds !== null && $this->ca_id !== $this->aIds->getCaId()) {
			$this->aIds = null;
		}
		if ($this->aCiudad !== null && $this->ca_idciudad !== $this->aCiudad->getCaIdciudad()) {
			$this->aCiudad = null;
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
			$con = Propel::getConnection(IdsSucursalPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = IdsSucursalPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aCiudad = null;
			$this->aIds = null;
			$this->collIdsContactos = null;
			$this->lastIdsContactoCriteria = null;

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
			$con = Propel::getConnection(IdsSucursalPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			IdsSucursalPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(IdsSucursalPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			IdsSucursalPeer::addInstanceToPool($this);
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

			if ($this->aCiudad !== null) {
				if ($this->aCiudad->isModified() || $this->aCiudad->isNew()) {
					$affectedRows += $this->aCiudad->save($con);
				}
				$this->setCiudad($this->aCiudad);
			}

			if ($this->aIds !== null) {
				if ($this->aIds->isModified() || $this->aIds->isNew()) {
					$affectedRows += $this->aIds->save($con);
				}
				$this->setIds($this->aIds);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = IdsSucursalPeer::CA_IDSUCURSAL;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = IdsSucursalPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setCaIdsucursal($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += IdsSucursalPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collIdsContactos !== null) {
				foreach ($this->collIdsContactos as $referrerFK) {
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

			if ($this->aIds !== null) {
				if (!$this->aIds->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aIds->getValidationFailures());
				}
			}


			if (($retval = IdsSucursalPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collIdsContactos !== null) {
					foreach ($this->collIdsContactos as $referrerFK) {
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
		$pos = IdsSucursalPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdsucursal();
				break;
			case 1:
				return $this->getCaId();
				break;
			case 2:
				return $this->getCaPrincipal();
				break;
			case 3:
				return $this->getCaDireccion();
				break;
			case 4:
				return $this->getCaOficina();
				break;
			case 5:
				return $this->getCaTorre();
				break;
			case 6:
				return $this->getCaBloque();
				break;
			case 7:
				return $this->getCaInterior();
				break;
			case 8:
				return $this->getCaLocalidad();
				break;
			case 9:
				return $this->getCaComplemento();
				break;
			case 10:
				return $this->getCaTelefonos();
				break;
			case 11:
				return $this->getCaFax();
				break;
			case 12:
				return $this->getCaIdciudad();
				break;
			case 13:
				return $this->getCaFchcreado();
				break;
			case 14:
				return $this->getCaUsucreado();
				break;
			case 15:
				return $this->getCaFchactualizado();
				break;
			case 16:
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
		$keys = IdsSucursalPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdsucursal(),
			$keys[1] => $this->getCaId(),
			$keys[2] => $this->getCaPrincipal(),
			$keys[3] => $this->getCaDireccion(),
			$keys[4] => $this->getCaOficina(),
			$keys[5] => $this->getCaTorre(),
			$keys[6] => $this->getCaBloque(),
			$keys[7] => $this->getCaInterior(),
			$keys[8] => $this->getCaLocalidad(),
			$keys[9] => $this->getCaComplemento(),
			$keys[10] => $this->getCaTelefonos(),
			$keys[11] => $this->getCaFax(),
			$keys[12] => $this->getCaIdciudad(),
			$keys[13] => $this->getCaFchcreado(),
			$keys[14] => $this->getCaUsucreado(),
			$keys[15] => $this->getCaFchactualizado(),
			$keys[16] => $this->getCaUsuactualizado(),
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
		$pos = IdsSucursalPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdsucursal($value);
				break;
			case 1:
				$this->setCaId($value);
				break;
			case 2:
				$this->setCaPrincipal($value);
				break;
			case 3:
				$this->setCaDireccion($value);
				break;
			case 4:
				$this->setCaOficina($value);
				break;
			case 5:
				$this->setCaTorre($value);
				break;
			case 6:
				$this->setCaBloque($value);
				break;
			case 7:
				$this->setCaInterior($value);
				break;
			case 8:
				$this->setCaLocalidad($value);
				break;
			case 9:
				$this->setCaComplemento($value);
				break;
			case 10:
				$this->setCaTelefonos($value);
				break;
			case 11:
				$this->setCaFax($value);
				break;
			case 12:
				$this->setCaIdciudad($value);
				break;
			case 13:
				$this->setCaFchcreado($value);
				break;
			case 14:
				$this->setCaUsucreado($value);
				break;
			case 15:
				$this->setCaFchactualizado($value);
				break;
			case 16:
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
		$keys = IdsSucursalPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdsucursal($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaPrincipal($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaDireccion($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaOficina($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaTorre($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaBloque($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaInterior($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaLocalidad($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaComplemento($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaTelefonos($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaFax($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaIdciudad($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaFchcreado($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaUsucreado($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaFchactualizado($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCaUsuactualizado($arr[$keys[16]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(IdsSucursalPeer::DATABASE_NAME);

		if ($this->isColumnModified(IdsSucursalPeer::CA_IDSUCURSAL)) $criteria->add(IdsSucursalPeer::CA_IDSUCURSAL, $this->ca_idsucursal);
		if ($this->isColumnModified(IdsSucursalPeer::CA_ID)) $criteria->add(IdsSucursalPeer::CA_ID, $this->ca_id);
		if ($this->isColumnModified(IdsSucursalPeer::CA_PRINCIPAL)) $criteria->add(IdsSucursalPeer::CA_PRINCIPAL, $this->ca_principal);
		if ($this->isColumnModified(IdsSucursalPeer::CA_DIRECCION)) $criteria->add(IdsSucursalPeer::CA_DIRECCION, $this->ca_direccion);
		if ($this->isColumnModified(IdsSucursalPeer::CA_OFICINA)) $criteria->add(IdsSucursalPeer::CA_OFICINA, $this->ca_oficina);
		if ($this->isColumnModified(IdsSucursalPeer::CA_TORRE)) $criteria->add(IdsSucursalPeer::CA_TORRE, $this->ca_torre);
		if ($this->isColumnModified(IdsSucursalPeer::CA_BLOQUE)) $criteria->add(IdsSucursalPeer::CA_BLOQUE, $this->ca_bloque);
		if ($this->isColumnModified(IdsSucursalPeer::CA_INTERIOR)) $criteria->add(IdsSucursalPeer::CA_INTERIOR, $this->ca_interior);
		if ($this->isColumnModified(IdsSucursalPeer::CA_LOCALIDAD)) $criteria->add(IdsSucursalPeer::CA_LOCALIDAD, $this->ca_localidad);
		if ($this->isColumnModified(IdsSucursalPeer::CA_COMPLEMENTO)) $criteria->add(IdsSucursalPeer::CA_COMPLEMENTO, $this->ca_complemento);
		if ($this->isColumnModified(IdsSucursalPeer::CA_TELEFONOS)) $criteria->add(IdsSucursalPeer::CA_TELEFONOS, $this->ca_telefonos);
		if ($this->isColumnModified(IdsSucursalPeer::CA_FAX)) $criteria->add(IdsSucursalPeer::CA_FAX, $this->ca_fax);
		if ($this->isColumnModified(IdsSucursalPeer::CA_IDCIUDAD)) $criteria->add(IdsSucursalPeer::CA_IDCIUDAD, $this->ca_idciudad);
		if ($this->isColumnModified(IdsSucursalPeer::CA_FCHCREADO)) $criteria->add(IdsSucursalPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(IdsSucursalPeer::CA_USUCREADO)) $criteria->add(IdsSucursalPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(IdsSucursalPeer::CA_FCHACTUALIZADO)) $criteria->add(IdsSucursalPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(IdsSucursalPeer::CA_USUACTUALIZADO)) $criteria->add(IdsSucursalPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);

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
		$criteria = new Criteria(IdsSucursalPeer::DATABASE_NAME);

		$criteria->add(IdsSucursalPeer::CA_IDSUCURSAL, $this->ca_idsucursal);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdsucursal();
	}

	/**
	 * Generic method to set the primary key (ca_idsucursal column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdsucursal($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of IdsSucursal (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaId($this->ca_id);

		$copyObj->setCaPrincipal($this->ca_principal);

		$copyObj->setCaDireccion($this->ca_direccion);

		$copyObj->setCaOficina($this->ca_oficina);

		$copyObj->setCaTorre($this->ca_torre);

		$copyObj->setCaBloque($this->ca_bloque);

		$copyObj->setCaInterior($this->ca_interior);

		$copyObj->setCaLocalidad($this->ca_localidad);

		$copyObj->setCaComplemento($this->ca_complemento);

		$copyObj->setCaTelefonos($this->ca_telefonos);

		$copyObj->setCaFax($this->ca_fax);

		$copyObj->setCaIdciudad($this->ca_idciudad);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getIdsContactos() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addIdsContacto($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setCaIdsucursal(NULL); // this is a auto-increment column, so set to default value

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
	 * @return     IdsSucursal Clone of current object.
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
	 * @return     IdsSucursalPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new IdsSucursalPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Ciudad object.
	 *
	 * @param      Ciudad $v
	 * @return     IdsSucursal The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setCiudad(Ciudad $v = null)
	{
		if ($v === null) {
			$this->setCaIdciudad(NULL);
		} else {
			$this->setCaIdciudad($v->getCaIdciudad());
		}

		$this->aCiudad = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Ciudad object, it will not be re-added.
		if ($v !== null) {
			$v->addIdsSucursal($this);
		}

		return $this;
	}


	/**
	 * Get the associated Ciudad object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Ciudad The associated Ciudad object.
	 * @throws     PropelException
	 */
	public function getCiudad(PropelPDO $con = null)
	{
		if ($this->aCiudad === null && (($this->ca_idciudad !== "" && $this->ca_idciudad !== null))) {
			$c = new Criteria(CiudadPeer::DATABASE_NAME);
			$c->add(CiudadPeer::CA_IDCIUDAD, $this->ca_idciudad);
			$this->aCiudad = CiudadPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aCiudad->addIdsSucursals($this);
			 */
		}
		return $this->aCiudad;
	}

	/**
	 * Declares an association between this object and a Ids object.
	 *
	 * @param      Ids $v
	 * @return     IdsSucursal The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setIds(Ids $v = null)
	{
		if ($v === null) {
			$this->setCaId(NULL);
		} else {
			$this->setCaId($v->getCaId());
		}

		$this->aIds = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Ids object, it will not be re-added.
		if ($v !== null) {
			$v->addIdsSucursal($this);
		}

		return $this;
	}


	/**
	 * Get the associated Ids object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Ids The associated Ids object.
	 * @throws     PropelException
	 */
	public function getIds(PropelPDO $con = null)
	{
		if ($this->aIds === null && ($this->ca_id !== null)) {
			$c = new Criteria(IdsPeer::DATABASE_NAME);
			$c->add(IdsPeer::CA_ID, $this->ca_id);
			$this->aIds = IdsPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aIds->addIdsSucursals($this);
			 */
		}
		return $this->aIds;
	}

	/**
	 * Clears out the collIdsContactos collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addIdsContactos()
	 */
	public function clearIdsContactos()
	{
		$this->collIdsContactos = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collIdsContactos collection (array).
	 *
	 * By default this just sets the collIdsContactos collection to an empty array (like clearcollIdsContactos());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initIdsContactos()
	{
		$this->collIdsContactos = array();
	}

	/**
	 * Gets an array of IdsContacto objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this IdsSucursal has previously been saved, it will retrieve
	 * related IdsContactos from storage. If this IdsSucursal is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array IdsContacto[]
	 * @throws     PropelException
	 */
	public function getIdsContactos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(IdsSucursalPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collIdsContactos === null) {
			if ($this->isNew()) {
			   $this->collIdsContactos = array();
			} else {

				$criteria->add(IdsContactoPeer::CA_IDSUCURSAL, $this->ca_idsucursal);

				IdsContactoPeer::addSelectColumns($criteria);
				$this->collIdsContactos = IdsContactoPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(IdsContactoPeer::CA_IDSUCURSAL, $this->ca_idsucursal);

				IdsContactoPeer::addSelectColumns($criteria);
				if (!isset($this->lastIdsContactoCriteria) || !$this->lastIdsContactoCriteria->equals($criteria)) {
					$this->collIdsContactos = IdsContactoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastIdsContactoCriteria = $criteria;
		return $this->collIdsContactos;
	}

	/**
	 * Returns the number of related IdsContacto objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related IdsContacto objects.
	 * @throws     PropelException
	 */
	public function countIdsContactos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(IdsSucursalPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collIdsContactos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(IdsContactoPeer::CA_IDSUCURSAL, $this->ca_idsucursal);

				$count = IdsContactoPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(IdsContactoPeer::CA_IDSUCURSAL, $this->ca_idsucursal);

				if (!isset($this->lastIdsContactoCriteria) || !$this->lastIdsContactoCriteria->equals($criteria)) {
					$count = IdsContactoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collIdsContactos);
				}
			} else {
				$count = count($this->collIdsContactos);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a IdsContacto object to this object
	 * through the IdsContacto foreign key attribute.
	 *
	 * @param      IdsContacto $l IdsContacto
	 * @return     void
	 * @throws     PropelException
	 */
	public function addIdsContacto(IdsContacto $l)
	{
		if ($this->collIdsContactos === null) {
			$this->initIdsContactos();
		}
		if (!in_array($l, $this->collIdsContactos, true)) { // only add it if the **same** object is not already associated
			array_push($this->collIdsContactos, $l);
			$l->setIdsSucursal($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this IdsSucursal is new, it will return
	 * an empty collection; or if this IdsSucursal has previously
	 * been saved, it will retrieve related IdsContactos from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in IdsSucursal.
	 */
	public function getIdsContactosJoinCiudad($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(IdsSucursalPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collIdsContactos === null) {
			if ($this->isNew()) {
				$this->collIdsContactos = array();
			} else {

				$criteria->add(IdsContactoPeer::CA_IDSUCURSAL, $this->ca_idsucursal);

				$this->collIdsContactos = IdsContactoPeer::doSelectJoinCiudad($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(IdsContactoPeer::CA_IDSUCURSAL, $this->ca_idsucursal);

			if (!isset($this->lastIdsContactoCriteria) || !$this->lastIdsContactoCriteria->equals($criteria)) {
				$this->collIdsContactos = IdsContactoPeer::doSelectJoinCiudad($criteria, $con, $join_behavior);
			}
		}
		$this->lastIdsContactoCriteria = $criteria;

		return $this->collIdsContactos;
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
			if ($this->collIdsContactos) {
				foreach ((array) $this->collIdsContactos as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collIdsContactos = null;
			$this->aCiudad = null;
			$this->aIds = null;
	}

} // BaseIdsSucursal
