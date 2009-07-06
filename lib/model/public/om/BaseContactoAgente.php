<?php

/**
 * Base class that represents a row from the 'tb_contactos' table.
 *
 * 
 *
 * @package    lib.model.public.om
 */
abstract class BaseContactoAgente extends BaseObject  implements Persistent {


  const PEER = 'ContactoAgentePeer';

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
	 * The value for the ca_apellido field.
	 * @var        string
	 */
	protected $ca_apellido;

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
	 * The value for the ca_activo field.
	 * @var        boolean
	 */
	protected $ca_activo;

	/**
	 * The value for the ca_fchcreado field.
	 * @var        string
	 */
	protected $ca_fchcreado;

	/**
	 * The value for the ca_fchactualizado field.
	 * @var        string
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
	 * Initializes internal state of BaseContactoAgente object.
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
	 * Get the [ca_apellido] column value.
	 * 
	 * @return     string
	 */
	public function getCaApellido()
	{
		return $this->ca_apellido;
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
	 * Get the [ca_activo] column value.
	 * 
	 * @return     boolean
	 */
	public function getCaActivo()
	{
		return $this->ca_activo;
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
	 * Set the value of [ca_idcontacto] column.
	 * 
	 * @param      string $v new value
	 * @return     ContactoAgente The current object (for fluent API support)
	 */
	public function setCaIdcontacto($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idcontacto !== $v) {
			$this->ca_idcontacto = $v;
			$this->modifiedColumns[] = ContactoAgentePeer::CA_IDCONTACTO;
		}

		return $this;
	} // setCaIdcontacto()

	/**
	 * Set the value of [ca_idagente] column.
	 * 
	 * @param      int $v new value
	 * @return     ContactoAgente The current object (for fluent API support)
	 */
	public function setCaIdagente($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idagente !== $v) {
			$this->ca_idagente = $v;
			$this->modifiedColumns[] = ContactoAgentePeer::CA_IDAGENTE;
		}

		if ($this->aAgente !== null && $this->aAgente->getCaIdagente() !== $v) {
			$this->aAgente = null;
		}

		return $this;
	} // setCaIdagente()

	/**
	 * Set the value of [ca_nombre] column.
	 * 
	 * @param      string $v new value
	 * @return     ContactoAgente The current object (for fluent API support)
	 */
	public function setCaNombre($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_nombre !== $v) {
			$this->ca_nombre = $v;
			$this->modifiedColumns[] = ContactoAgentePeer::CA_NOMBRE;
		}

		return $this;
	} // setCaNombre()

	/**
	 * Set the value of [ca_apellido] column.
	 * 
	 * @param      string $v new value
	 * @return     ContactoAgente The current object (for fluent API support)
	 */
	public function setCaApellido($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_apellido !== $v) {
			$this->ca_apellido = $v;
			$this->modifiedColumns[] = ContactoAgentePeer::CA_APELLIDO;
		}

		return $this;
	} // setCaApellido()

	/**
	 * Set the value of [ca_direccion] column.
	 * 
	 * @param      string $v new value
	 * @return     ContactoAgente The current object (for fluent API support)
	 */
	public function setCaDireccion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_direccion !== $v) {
			$this->ca_direccion = $v;
			$this->modifiedColumns[] = ContactoAgentePeer::CA_DIRECCION;
		}

		return $this;
	} // setCaDireccion()

	/**
	 * Set the value of [ca_telefonos] column.
	 * 
	 * @param      string $v new value
	 * @return     ContactoAgente The current object (for fluent API support)
	 */
	public function setCaTelefonos($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_telefonos !== $v) {
			$this->ca_telefonos = $v;
			$this->modifiedColumns[] = ContactoAgentePeer::CA_TELEFONOS;
		}

		return $this;
	} // setCaTelefonos()

	/**
	 * Set the value of [ca_fax] column.
	 * 
	 * @param      string $v new value
	 * @return     ContactoAgente The current object (for fluent API support)
	 */
	public function setCaFax($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_fax !== $v) {
			$this->ca_fax = $v;
			$this->modifiedColumns[] = ContactoAgentePeer::CA_FAX;
		}

		return $this;
	} // setCaFax()

	/**
	 * Set the value of [ca_idciudad] column.
	 * 
	 * @param      string $v new value
	 * @return     ContactoAgente The current object (for fluent API support)
	 */
	public function setCaIdciudad($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idciudad !== $v) {
			$this->ca_idciudad = $v;
			$this->modifiedColumns[] = ContactoAgentePeer::CA_IDCIUDAD;
		}

		if ($this->aCiudad !== null && $this->aCiudad->getCaIdciudad() !== $v) {
			$this->aCiudad = null;
		}

		return $this;
	} // setCaIdciudad()

	/**
	 * Set the value of [ca_email] column.
	 * 
	 * @param      string $v new value
	 * @return     ContactoAgente The current object (for fluent API support)
	 */
	public function setCaEmail($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_email !== $v) {
			$this->ca_email = $v;
			$this->modifiedColumns[] = ContactoAgentePeer::CA_EMAIL;
		}

		return $this;
	} // setCaEmail()

	/**
	 * Set the value of [ca_impoexpo] column.
	 * 
	 * @param      string $v new value
	 * @return     ContactoAgente The current object (for fluent API support)
	 */
	public function setCaImpoexpo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_impoexpo !== $v) {
			$this->ca_impoexpo = $v;
			$this->modifiedColumns[] = ContactoAgentePeer::CA_IMPOEXPO;
		}

		return $this;
	} // setCaImpoexpo()

	/**
	 * Set the value of [ca_transporte] column.
	 * 
	 * @param      string $v new value
	 * @return     ContactoAgente The current object (for fluent API support)
	 */
	public function setCaTransporte($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_transporte !== $v) {
			$this->ca_transporte = $v;
			$this->modifiedColumns[] = ContactoAgentePeer::CA_TRANSPORTE;
		}

		return $this;
	} // setCaTransporte()

	/**
	 * Set the value of [ca_cargo] column.
	 * 
	 * @param      string $v new value
	 * @return     ContactoAgente The current object (for fluent API support)
	 */
	public function setCaCargo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_cargo !== $v) {
			$this->ca_cargo = $v;
			$this->modifiedColumns[] = ContactoAgentePeer::CA_CARGO;
		}

		return $this;
	} // setCaCargo()

	/**
	 * Set the value of [ca_detalle] column.
	 * 
	 * @param      string $v new value
	 * @return     ContactoAgente The current object (for fluent API support)
	 */
	public function setCaDetalle($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_detalle !== $v) {
			$this->ca_detalle = $v;
			$this->modifiedColumns[] = ContactoAgentePeer::CA_DETALLE;
		}

		return $this;
	} // setCaDetalle()

	/**
	 * Set the value of [ca_sugerido] column.
	 * 
	 * @param      boolean $v new value
	 * @return     ContactoAgente The current object (for fluent API support)
	 */
	public function setCaSugerido($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->ca_sugerido !== $v) {
			$this->ca_sugerido = $v;
			$this->modifiedColumns[] = ContactoAgentePeer::CA_SUGERIDO;
		}

		return $this;
	} // setCaSugerido()

	/**
	 * Set the value of [ca_activo] column.
	 * 
	 * @param      boolean $v new value
	 * @return     ContactoAgente The current object (for fluent API support)
	 */
	public function setCaActivo($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->ca_activo !== $v) {
			$this->ca_activo = $v;
			$this->modifiedColumns[] = ContactoAgentePeer::CA_ACTIVO;
		}

		return $this;
	} // setCaActivo()

	/**
	 * Sets the value of [ca_fchcreado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     ContactoAgente The current object (for fluent API support)
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
				$this->modifiedColumns[] = ContactoAgentePeer::CA_FCHCREADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchcreado()

	/**
	 * Sets the value of [ca_fchactualizado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     ContactoAgente The current object (for fluent API support)
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
				$this->modifiedColumns[] = ContactoAgentePeer::CA_FCHACTUALIZADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchactualizado()

	/**
	 * Set the value of [ca_usucreado] column.
	 * 
	 * @param      string $v new value
	 * @return     ContactoAgente The current object (for fluent API support)
	 */
	public function setCaUsucreado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usucreado !== $v) {
			$this->ca_usucreado = $v;
			$this->modifiedColumns[] = ContactoAgentePeer::CA_USUCREADO;
		}

		return $this;
	} // setCaUsucreado()

	/**
	 * Set the value of [ca_usuactualizado] column.
	 * 
	 * @param      string $v new value
	 * @return     ContactoAgente The current object (for fluent API support)
	 */
	public function setCaUsuactualizado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usuactualizado !== $v) {
			$this->ca_usuactualizado = $v;
			$this->modifiedColumns[] = ContactoAgentePeer::CA_USUACTUALIZADO;
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

			$this->ca_idcontacto = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ca_idagente = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_nombre = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_apellido = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_direccion = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_telefonos = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_fax = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_idciudad = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_email = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_impoexpo = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_transporte = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_cargo = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_detalle = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_sugerido = ($row[$startcol + 13] !== null) ? (boolean) $row[$startcol + 13] : null;
			$this->ca_activo = ($row[$startcol + 14] !== null) ? (boolean) $row[$startcol + 14] : null;
			$this->ca_fchcreado = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->ca_fchactualizado = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
			$this->ca_usucreado = ($row[$startcol + 17] !== null) ? (string) $row[$startcol + 17] : null;
			$this->ca_usuactualizado = ($row[$startcol + 18] !== null) ? (string) $row[$startcol + 18] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 19; // 19 = ContactoAgentePeer::NUM_COLUMNS - ContactoAgentePeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating ContactoAgente object", $e);
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

		if ($this->aAgente !== null && $this->ca_idagente !== $this->aAgente->getCaIdagente()) {
			$this->aAgente = null;
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
			$con = Propel::getConnection(ContactoAgentePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = ContactoAgentePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aAgente = null;
			$this->aCiudad = null;
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
			$con = Propel::getConnection(ContactoAgentePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			ContactoAgentePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(ContactoAgentePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			ContactoAgentePeer::addInstanceToPool($this);
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

			if ($this->aAgente !== null) {
				if ($this->aAgente->isModified() || $this->aAgente->isNew()) {
					$affectedRows += $this->aAgente->save($con);
				}
				$this->setAgente($this->aAgente);
			}

			if ($this->aCiudad !== null) {
				if ($this->aCiudad->isModified() || $this->aCiudad->isNew()) {
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
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ContactoAgentePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdcontacto();
				break;
			case 1:
				return $this->getCaIdagente();
				break;
			case 2:
				return $this->getCaNombre();
				break;
			case 3:
				return $this->getCaApellido();
				break;
			case 4:
				return $this->getCaDireccion();
				break;
			case 5:
				return $this->getCaTelefonos();
				break;
			case 6:
				return $this->getCaFax();
				break;
			case 7:
				return $this->getCaIdciudad();
				break;
			case 8:
				return $this->getCaEmail();
				break;
			case 9:
				return $this->getCaImpoexpo();
				break;
			case 10:
				return $this->getCaTransporte();
				break;
			case 11:
				return $this->getCaCargo();
				break;
			case 12:
				return $this->getCaDetalle();
				break;
			case 13:
				return $this->getCaSugerido();
				break;
			case 14:
				return $this->getCaActivo();
				break;
			case 15:
				return $this->getCaFchcreado();
				break;
			case 16:
				return $this->getCaFchactualizado();
				break;
			case 17:
				return $this->getCaUsucreado();
				break;
			case 18:
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
		$keys = ContactoAgentePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdcontacto(),
			$keys[1] => $this->getCaIdagente(),
			$keys[2] => $this->getCaNombre(),
			$keys[3] => $this->getCaApellido(),
			$keys[4] => $this->getCaDireccion(),
			$keys[5] => $this->getCaTelefonos(),
			$keys[6] => $this->getCaFax(),
			$keys[7] => $this->getCaIdciudad(),
			$keys[8] => $this->getCaEmail(),
			$keys[9] => $this->getCaImpoexpo(),
			$keys[10] => $this->getCaTransporte(),
			$keys[11] => $this->getCaCargo(),
			$keys[12] => $this->getCaDetalle(),
			$keys[13] => $this->getCaSugerido(),
			$keys[14] => $this->getCaActivo(),
			$keys[15] => $this->getCaFchcreado(),
			$keys[16] => $this->getCaFchactualizado(),
			$keys[17] => $this->getCaUsucreado(),
			$keys[18] => $this->getCaUsuactualizado(),
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
				$this->setCaApellido($value);
				break;
			case 4:
				$this->setCaDireccion($value);
				break;
			case 5:
				$this->setCaTelefonos($value);
				break;
			case 6:
				$this->setCaFax($value);
				break;
			case 7:
				$this->setCaIdciudad($value);
				break;
			case 8:
				$this->setCaEmail($value);
				break;
			case 9:
				$this->setCaImpoexpo($value);
				break;
			case 10:
				$this->setCaTransporte($value);
				break;
			case 11:
				$this->setCaCargo($value);
				break;
			case 12:
				$this->setCaDetalle($value);
				break;
			case 13:
				$this->setCaSugerido($value);
				break;
			case 14:
				$this->setCaActivo($value);
				break;
			case 15:
				$this->setCaFchcreado($value);
				break;
			case 16:
				$this->setCaFchactualizado($value);
				break;
			case 17:
				$this->setCaUsucreado($value);
				break;
			case 18:
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
		$keys = ContactoAgentePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdcontacto($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdagente($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaNombre($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaApellido($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaDireccion($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaTelefonos($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaFax($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaIdciudad($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaEmail($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaImpoexpo($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaTransporte($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaCargo($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaDetalle($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaSugerido($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaActivo($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaFchcreado($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCaFchactualizado($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setCaUsucreado($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setCaUsuactualizado($arr[$keys[18]]);
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
		if ($this->isColumnModified(ContactoAgentePeer::CA_APELLIDO)) $criteria->add(ContactoAgentePeer::CA_APELLIDO, $this->ca_apellido);
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
		if ($this->isColumnModified(ContactoAgentePeer::CA_ACTIVO)) $criteria->add(ContactoAgentePeer::CA_ACTIVO, $this->ca_activo);
		if ($this->isColumnModified(ContactoAgentePeer::CA_FCHCREADO)) $criteria->add(ContactoAgentePeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(ContactoAgentePeer::CA_FCHACTUALIZADO)) $criteria->add(ContactoAgentePeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(ContactoAgentePeer::CA_USUCREADO)) $criteria->add(ContactoAgentePeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(ContactoAgentePeer::CA_USUACTUALIZADO)) $criteria->add(ContactoAgentePeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);

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

		$copyObj->setCaIdcontacto($this->ca_idcontacto);

		$copyObj->setCaIdagente($this->ca_idagente);

		$copyObj->setCaNombre($this->ca_nombre);

		$copyObj->setCaApellido($this->ca_apellido);

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

		$copyObj->setCaActivo($this->ca_activo);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

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
	 * @return     ContactoAgente The current object (for fluent API support)
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
			$v->addContactoAgente($this);
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
			   $this->aAgente->addContactoAgentes($this);
			 */
		}
		return $this->aAgente;
	}

	/**
	 * Declares an association between this object and a Ciudad object.
	 *
	 * @param      Ciudad $v
	 * @return     ContactoAgente The current object (for fluent API support)
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
			$v->addContactoAgente($this);
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
			   $this->aCiudad->addContactoAgentes($this);
			 */
		}
		return $this->aCiudad;
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

			$this->aAgente = null;
			$this->aCiudad = null;
	}

} // BaseContactoAgente
