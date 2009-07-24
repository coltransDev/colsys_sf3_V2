<?php

/**
 * Base class that represents a row from the 'ids.tb_contactos' table.
 *
 * 
 *
 * @package    lib.model.ids.om
 */
abstract class BaseIdsContacto extends BaseObject  implements Persistent {


  const PEER = 'IdsContactoPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        IdsContactoPeer
	 */
	protected static $peer;

	/**
	 * The value for the ca_idcontacto field.
	 * @var        int
	 */
	protected $ca_idcontacto;

	/**
	 * The value for the ca_idsucursal field.
	 * @var        int
	 */
	protected $ca_idsucursal;

	/**
	 * The value for the ca_nombres field.
	 * @var        string
	 */
	protected $ca_nombres;

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
	 * The value for the ca_departamento field.
	 * @var        string
	 */
	protected $ca_departamento;

	/**
	 * The value for the ca_observaciones field.
	 * @var        string
	 */
	protected $ca_observaciones;

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
	 * The value for the ca_fcheliminado field.
	 * @var        string
	 */
	protected $ca_fcheliminado;

	/**
	 * The value for the ca_usueliminado field.
	 * @var        string
	 */
	protected $ca_usueliminado;

	/**
	 * @var        Ciudad
	 */
	protected $aCiudad;

	/**
	 * @var        IdsSucursal
	 */
	protected $aIdsSucursal;

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
	 * Initializes internal state of BaseIdsContacto object.
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
	 * @return     int
	 */
	public function getCaIdcontacto()
	{
		return $this->ca_idcontacto;
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
	 * Get the [ca_nombres] column value.
	 * 
	 * @return     string
	 */
	public function getCaNombres()
	{
		return $this->ca_nombres;
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
	 * Get the [ca_departamento] column value.
	 * 
	 * @return     string
	 */
	public function getCaDepartamento()
	{
		return $this->ca_departamento;
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
	 * Get the [optionally formatted] temporal [ca_fcheliminado] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaFcheliminado($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fcheliminado === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fcheliminado);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fcheliminado, true), $x);
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
	 * Get the [ca_usueliminado] column value.
	 * 
	 * @return     string
	 */
	public function getCaUsueliminado()
	{
		return $this->ca_usueliminado;
	}

	/**
	 * Set the value of [ca_idcontacto] column.
	 * 
	 * @param      int $v new value
	 * @return     IdsContacto The current object (for fluent API support)
	 */
	public function setCaIdcontacto($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idcontacto !== $v) {
			$this->ca_idcontacto = $v;
			$this->modifiedColumns[] = IdsContactoPeer::CA_IDCONTACTO;
		}

		return $this;
	} // setCaIdcontacto()

	/**
	 * Set the value of [ca_idsucursal] column.
	 * 
	 * @param      int $v new value
	 * @return     IdsContacto The current object (for fluent API support)
	 */
	public function setCaIdsucursal($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idsucursal !== $v) {
			$this->ca_idsucursal = $v;
			$this->modifiedColumns[] = IdsContactoPeer::CA_IDSUCURSAL;
		}

		if ($this->aIdsSucursal !== null && $this->aIdsSucursal->getCaIdsucursal() !== $v) {
			$this->aIdsSucursal = null;
		}

		return $this;
	} // setCaIdsucursal()

	/**
	 * Set the value of [ca_nombres] column.
	 * 
	 * @param      string $v new value
	 * @return     IdsContacto The current object (for fluent API support)
	 */
	public function setCaNombres($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_nombres !== $v) {
			$this->ca_nombres = $v;
			$this->modifiedColumns[] = IdsContactoPeer::CA_NOMBRES;
		}

		return $this;
	} // setCaNombres()

	/**
	 * Set the value of [ca_papellido] column.
	 * 
	 * @param      string $v new value
	 * @return     IdsContacto The current object (for fluent API support)
	 */
	public function setCaPapellido($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_papellido !== $v) {
			$this->ca_papellido = $v;
			$this->modifiedColumns[] = IdsContactoPeer::CA_PAPELLIDO;
		}

		return $this;
	} // setCaPapellido()

	/**
	 * Set the value of [ca_sapellido] column.
	 * 
	 * @param      string $v new value
	 * @return     IdsContacto The current object (for fluent API support)
	 */
	public function setCaSapellido($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_sapellido !== $v) {
			$this->ca_sapellido = $v;
			$this->modifiedColumns[] = IdsContactoPeer::CA_SAPELLIDO;
		}

		return $this;
	} // setCaSapellido()

	/**
	 * Set the value of [ca_nombres] column.
	 * 
	 * @param      string $v new value
	 * @return     IdsContacto The current object (for fluent API support)
	 */
	public function setCaNombres($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_nombres !== $v) {
			$this->ca_nombres = $v;
			$this->modifiedColumns[] = IdsContactoPeer::CA_NOMBRES;
		}

		return $this;
	} // setCaNombres()

	/**
	 * Set the value of [ca_saludo] column.
	 * 
	 * @param      string $v new value
	 * @return     IdsContacto The current object (for fluent API support)
	 */
	public function setCaSaludo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_saludo !== $v) {
			$this->ca_saludo = $v;
			$this->modifiedColumns[] = IdsContactoPeer::CA_SALUDO;
		}

		return $this;
	} // setCaSaludo()

	/**
	 * Set the value of [ca_direccion] column.
	 * 
	 * @param      string $v new value
	 * @return     IdsContacto The current object (for fluent API support)
	 */
	public function setCaDireccion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_direccion !== $v) {
			$this->ca_direccion = $v;
			$this->modifiedColumns[] = IdsContactoPeer::CA_DIRECCION;
		}

		return $this;
	} // setCaDireccion()

	/**
	 * Set the value of [ca_telefonos] column.
	 * 
	 * @param      string $v new value
	 * @return     IdsContacto The current object (for fluent API support)
	 */
	public function setCaTelefonos($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_telefonos !== $v) {
			$this->ca_telefonos = $v;
			$this->modifiedColumns[] = IdsContactoPeer::CA_TELEFONOS;
		}

		return $this;
	} // setCaTelefonos()

	/**
	 * Set the value of [ca_fax] column.
	 * 
	 * @param      string $v new value
	 * @return     IdsContacto The current object (for fluent API support)
	 */
	public function setCaFax($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_fax !== $v) {
			$this->ca_fax = $v;
			$this->modifiedColumns[] = IdsContactoPeer::CA_FAX;
		}

		return $this;
	} // setCaFax()

	/**
	 * Set the value of [ca_idciudad] column.
	 * 
	 * @param      string $v new value
	 * @return     IdsContacto The current object (for fluent API support)
	 */
	public function setCaIdciudad($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idciudad !== $v) {
			$this->ca_idciudad = $v;
			$this->modifiedColumns[] = IdsContactoPeer::CA_IDCIUDAD;
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
	 * @return     IdsContacto The current object (for fluent API support)
	 */
	public function setCaEmail($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_email !== $v) {
			$this->ca_email = $v;
			$this->modifiedColumns[] = IdsContactoPeer::CA_EMAIL;
		}

		return $this;
	} // setCaEmail()

	/**
	 * Set the value of [ca_impoexpo] column.
	 * 
	 * @param      string $v new value
	 * @return     IdsContacto The current object (for fluent API support)
	 */
	public function setCaImpoexpo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_impoexpo !== $v) {
			$this->ca_impoexpo = $v;
			$this->modifiedColumns[] = IdsContactoPeer::CA_IMPOEXPO;
		}

		return $this;
	} // setCaImpoexpo()

	/**
	 * Set the value of [ca_transporte] column.
	 * 
	 * @param      string $v new value
	 * @return     IdsContacto The current object (for fluent API support)
	 */
	public function setCaTransporte($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_transporte !== $v) {
			$this->ca_transporte = $v;
			$this->modifiedColumns[] = IdsContactoPeer::CA_TRANSPORTE;
		}

		return $this;
	} // setCaTransporte()

	/**
	 * Set the value of [ca_cargo] column.
	 * 
	 * @param      string $v new value
	 * @return     IdsContacto The current object (for fluent API support)
	 */
	public function setCaCargo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_cargo !== $v) {
			$this->ca_cargo = $v;
			$this->modifiedColumns[] = IdsContactoPeer::CA_CARGO;
		}

		return $this;
	} // setCaCargo()

	/**
	 * Set the value of [ca_departamento] column.
	 * 
	 * @param      string $v new value
	 * @return     IdsContacto The current object (for fluent API support)
	 */
	public function setCaDepartamento($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_departamento !== $v) {
			$this->ca_departamento = $v;
			$this->modifiedColumns[] = IdsContactoPeer::CA_DEPARTAMENTO;
		}

		return $this;
	} // setCaDepartamento()

	/**
	 * Set the value of [ca_observaciones] column.
	 * 
	 * @param      string $v new value
	 * @return     IdsContacto The current object (for fluent API support)
	 */
	public function setCaObservaciones($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_observaciones !== $v) {
			$this->ca_observaciones = $v;
			$this->modifiedColumns[] = IdsContactoPeer::CA_OBSERVACIONES;
		}

		return $this;
	} // setCaObservaciones()

	/**
	 * Set the value of [ca_sugerido] column.
	 * 
	 * @param      boolean $v new value
	 * @return     IdsContacto The current object (for fluent API support)
	 */
	public function setCaSugerido($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->ca_sugerido !== $v) {
			$this->ca_sugerido = $v;
			$this->modifiedColumns[] = IdsContactoPeer::CA_SUGERIDO;
		}

		return $this;
	} // setCaSugerido()

	/**
	 * Set the value of [ca_activo] column.
	 * 
	 * @param      boolean $v new value
	 * @return     IdsContacto The current object (for fluent API support)
	 */
	public function setCaActivo($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->ca_activo !== $v) {
			$this->ca_activo = $v;
			$this->modifiedColumns[] = IdsContactoPeer::CA_ACTIVO;
		}

		return $this;
	} // setCaActivo()

	/**
	 * Sets the value of [ca_fchcreado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     IdsContacto The current object (for fluent API support)
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
				$this->modifiedColumns[] = IdsContactoPeer::CA_FCHCREADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchcreado()

	/**
	 * Set the value of [ca_usucreado] column.
	 * 
	 * @param      string $v new value
	 * @return     IdsContacto The current object (for fluent API support)
	 */
	public function setCaUsucreado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usucreado !== $v) {
			$this->ca_usucreado = $v;
			$this->modifiedColumns[] = IdsContactoPeer::CA_USUCREADO;
		}

		return $this;
	} // setCaUsucreado()

	/**
	 * Sets the value of [ca_fchactualizado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     IdsContacto The current object (for fluent API support)
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
				$this->modifiedColumns[] = IdsContactoPeer::CA_FCHACTUALIZADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchactualizado()

	/**
	 * Set the value of [ca_usuactualizado] column.
	 * 
	 * @param      string $v new value
	 * @return     IdsContacto The current object (for fluent API support)
	 */
	public function setCaUsuactualizado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usuactualizado !== $v) {
			$this->ca_usuactualizado = $v;
			$this->modifiedColumns[] = IdsContactoPeer::CA_USUACTUALIZADO;
		}

		return $this;
	} // setCaUsuactualizado()

	/**
	 * Sets the value of [ca_fcheliminado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     IdsContacto The current object (for fluent API support)
	 */
	public function setCaFcheliminado($v)
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

		if ( $this->ca_fcheliminado !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fcheliminado !== null && $tmpDt = new DateTime($this->ca_fcheliminado)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fcheliminado = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = IdsContactoPeer::CA_FCHELIMINADO;
			}
		} // if either are not null

		return $this;
	} // setCaFcheliminado()

	/**
	 * Set the value of [ca_usueliminado] column.
	 * 
	 * @param      string $v new value
	 * @return     IdsContacto The current object (for fluent API support)
	 */
	public function setCaUsueliminado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usueliminado !== $v) {
			$this->ca_usueliminado = $v;
			$this->modifiedColumns[] = IdsContactoPeer::CA_USUELIMINADO;
		}

		return $this;
	} // setCaUsueliminado()

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

			$this->ca_idcontacto = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_idsucursal = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_nombres = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_papellido = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_sapellido = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_nombres = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_saludo = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_direccion = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_telefonos = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_fax = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_idciudad = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_email = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_impoexpo = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_transporte = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->ca_cargo = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->ca_departamento = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->ca_observaciones = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
			$this->ca_sugerido = ($row[$startcol + 17] !== null) ? (boolean) $row[$startcol + 17] : null;
			$this->ca_activo = ($row[$startcol + 18] !== null) ? (boolean) $row[$startcol + 18] : null;
			$this->ca_fchcreado = ($row[$startcol + 19] !== null) ? (string) $row[$startcol + 19] : null;
			$this->ca_usucreado = ($row[$startcol + 20] !== null) ? (string) $row[$startcol + 20] : null;
			$this->ca_fchactualizado = ($row[$startcol + 21] !== null) ? (string) $row[$startcol + 21] : null;
			$this->ca_usuactualizado = ($row[$startcol + 22] !== null) ? (string) $row[$startcol + 22] : null;
			$this->ca_fcheliminado = ($row[$startcol + 23] !== null) ? (string) $row[$startcol + 23] : null;
			$this->ca_usueliminado = ($row[$startcol + 24] !== null) ? (string) $row[$startcol + 24] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 25; // 25 = IdsContactoPeer::NUM_COLUMNS - IdsContactoPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating IdsContacto object", $e);
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

		if ($this->aIdsSucursal !== null && $this->ca_idsucursal !== $this->aIdsSucursal->getCaIdsucursal()) {
			$this->aIdsSucursal = null;
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
			$con = Propel::getConnection(IdsContactoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = IdsContactoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aCiudad = null;
			$this->aIdsSucursal = null;
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
			$con = Propel::getConnection(IdsContactoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			IdsContactoPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(IdsContactoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			IdsContactoPeer::addInstanceToPool($this);
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

			if ($this->aIdsSucursal !== null) {
				if ($this->aIdsSucursal->isModified() || $this->aIdsSucursal->isNew()) {
					$affectedRows += $this->aIdsSucursal->save($con);
				}
				$this->setIdsSucursal($this->aIdsSucursal);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = IdsContactoPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += IdsContactoPeer::doUpdate($this, $con);
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

			if ($this->aCiudad !== null) {
				if (!$this->aCiudad->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCiudad->getValidationFailures());
				}
			}

			if ($this->aIdsSucursal !== null) {
				if (!$this->aIdsSucursal->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aIdsSucursal->getValidationFailures());
				}
			}


			if (($retval = IdsContactoPeer::doValidate($this, $columns)) !== true) {
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
		$pos = IdsContactoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdsucursal();
				break;
			case 2:
				return $this->getCaNombres();
				break;
			case 3:
				return $this->getCaPapellido();
				break;
			case 4:
				return $this->getCaSapellido();
				break;
			case 5:
				return $this->getCaNombres();
				break;
			case 6:
				return $this->getCaSaludo();
				break;
			case 7:
				return $this->getCaDireccion();
				break;
			case 8:
				return $this->getCaTelefonos();
				break;
			case 9:
				return $this->getCaFax();
				break;
			case 10:
				return $this->getCaIdciudad();
				break;
			case 11:
				return $this->getCaEmail();
				break;
			case 12:
				return $this->getCaImpoexpo();
				break;
			case 13:
				return $this->getCaTransporte();
				break;
			case 14:
				return $this->getCaCargo();
				break;
			case 15:
				return $this->getCaDepartamento();
				break;
			case 16:
				return $this->getCaObservaciones();
				break;
			case 17:
				return $this->getCaSugerido();
				break;
			case 18:
				return $this->getCaActivo();
				break;
			case 19:
				return $this->getCaFchcreado();
				break;
			case 20:
				return $this->getCaUsucreado();
				break;
			case 21:
				return $this->getCaFchactualizado();
				break;
			case 22:
				return $this->getCaUsuactualizado();
				break;
			case 23:
				return $this->getCaFcheliminado();
				break;
			case 24:
				return $this->getCaUsueliminado();
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
		$keys = IdsContactoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdcontacto(),
			$keys[1] => $this->getCaIdsucursal(),
			$keys[2] => $this->getCaNombres(),
			$keys[3] => $this->getCaPapellido(),
			$keys[4] => $this->getCaSapellido(),
			$keys[5] => $this->getCaNombres(),
			$keys[6] => $this->getCaSaludo(),
			$keys[7] => $this->getCaDireccion(),
			$keys[8] => $this->getCaTelefonos(),
			$keys[9] => $this->getCaFax(),
			$keys[10] => $this->getCaIdciudad(),
			$keys[11] => $this->getCaEmail(),
			$keys[12] => $this->getCaImpoexpo(),
			$keys[13] => $this->getCaTransporte(),
			$keys[14] => $this->getCaCargo(),
			$keys[15] => $this->getCaDepartamento(),
			$keys[16] => $this->getCaObservaciones(),
			$keys[17] => $this->getCaSugerido(),
			$keys[18] => $this->getCaActivo(),
			$keys[19] => $this->getCaFchcreado(),
			$keys[20] => $this->getCaUsucreado(),
			$keys[21] => $this->getCaFchactualizado(),
			$keys[22] => $this->getCaUsuactualizado(),
			$keys[23] => $this->getCaFcheliminado(),
			$keys[24] => $this->getCaUsueliminado(),
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
		$pos = IdsContactoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdsucursal($value);
				break;
			case 2:
				$this->setCaNombres($value);
				break;
			case 3:
				$this->setCaPapellido($value);
				break;
			case 4:
				$this->setCaSapellido($value);
				break;
			case 5:
				$this->setCaNombres($value);
				break;
			case 6:
				$this->setCaSaludo($value);
				break;
			case 7:
				$this->setCaDireccion($value);
				break;
			case 8:
				$this->setCaTelefonos($value);
				break;
			case 9:
				$this->setCaFax($value);
				break;
			case 10:
				$this->setCaIdciudad($value);
				break;
			case 11:
				$this->setCaEmail($value);
				break;
			case 12:
				$this->setCaImpoexpo($value);
				break;
			case 13:
				$this->setCaTransporte($value);
				break;
			case 14:
				$this->setCaCargo($value);
				break;
			case 15:
				$this->setCaDepartamento($value);
				break;
			case 16:
				$this->setCaObservaciones($value);
				break;
			case 17:
				$this->setCaSugerido($value);
				break;
			case 18:
				$this->setCaActivo($value);
				break;
			case 19:
				$this->setCaFchcreado($value);
				break;
			case 20:
				$this->setCaUsucreado($value);
				break;
			case 21:
				$this->setCaFchactualizado($value);
				break;
			case 22:
				$this->setCaUsuactualizado($value);
				break;
			case 23:
				$this->setCaFcheliminado($value);
				break;
			case 24:
				$this->setCaUsueliminado($value);
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
		$keys = IdsContactoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdcontacto($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdsucursal($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaNombres($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaPapellido($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaSapellido($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaNombres($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaSaludo($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaDireccion($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaTelefonos($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaFax($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaIdciudad($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaEmail($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaImpoexpo($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaTransporte($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaCargo($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaDepartamento($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCaObservaciones($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setCaSugerido($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setCaActivo($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setCaFchcreado($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setCaUsucreado($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setCaFchactualizado($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setCaUsuactualizado($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setCaFcheliminado($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setCaUsueliminado($arr[$keys[24]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(IdsContactoPeer::DATABASE_NAME);

		if ($this->isColumnModified(IdsContactoPeer::CA_IDCONTACTO)) $criteria->add(IdsContactoPeer::CA_IDCONTACTO, $this->ca_idcontacto);
		if ($this->isColumnModified(IdsContactoPeer::CA_IDSUCURSAL)) $criteria->add(IdsContactoPeer::CA_IDSUCURSAL, $this->ca_idsucursal);
		if ($this->isColumnModified(IdsContactoPeer::CA_NOMBRES)) $criteria->add(IdsContactoPeer::CA_NOMBRES, $this->ca_nombres);
		if ($this->isColumnModified(IdsContactoPeer::CA_PAPELLIDO)) $criteria->add(IdsContactoPeer::CA_PAPELLIDO, $this->ca_papellido);
		if ($this->isColumnModified(IdsContactoPeer::CA_SAPELLIDO)) $criteria->add(IdsContactoPeer::CA_SAPELLIDO, $this->ca_sapellido);
		if ($this->isColumnModified(IdsContactoPeer::CA_NOMBRES)) $criteria->add(IdsContactoPeer::CA_NOMBRES, $this->ca_nombres);
		if ($this->isColumnModified(IdsContactoPeer::CA_SALUDO)) $criteria->add(IdsContactoPeer::CA_SALUDO, $this->ca_saludo);
		if ($this->isColumnModified(IdsContactoPeer::CA_DIRECCION)) $criteria->add(IdsContactoPeer::CA_DIRECCION, $this->ca_direccion);
		if ($this->isColumnModified(IdsContactoPeer::CA_TELEFONOS)) $criteria->add(IdsContactoPeer::CA_TELEFONOS, $this->ca_telefonos);
		if ($this->isColumnModified(IdsContactoPeer::CA_FAX)) $criteria->add(IdsContactoPeer::CA_FAX, $this->ca_fax);
		if ($this->isColumnModified(IdsContactoPeer::CA_IDCIUDAD)) $criteria->add(IdsContactoPeer::CA_IDCIUDAD, $this->ca_idciudad);
		if ($this->isColumnModified(IdsContactoPeer::CA_EMAIL)) $criteria->add(IdsContactoPeer::CA_EMAIL, $this->ca_email);
		if ($this->isColumnModified(IdsContactoPeer::CA_IMPOEXPO)) $criteria->add(IdsContactoPeer::CA_IMPOEXPO, $this->ca_impoexpo);
		if ($this->isColumnModified(IdsContactoPeer::CA_TRANSPORTE)) $criteria->add(IdsContactoPeer::CA_TRANSPORTE, $this->ca_transporte);
		if ($this->isColumnModified(IdsContactoPeer::CA_CARGO)) $criteria->add(IdsContactoPeer::CA_CARGO, $this->ca_cargo);
		if ($this->isColumnModified(IdsContactoPeer::CA_DEPARTAMENTO)) $criteria->add(IdsContactoPeer::CA_DEPARTAMENTO, $this->ca_departamento);
		if ($this->isColumnModified(IdsContactoPeer::CA_OBSERVACIONES)) $criteria->add(IdsContactoPeer::CA_OBSERVACIONES, $this->ca_observaciones);
		if ($this->isColumnModified(IdsContactoPeer::CA_SUGERIDO)) $criteria->add(IdsContactoPeer::CA_SUGERIDO, $this->ca_sugerido);
		if ($this->isColumnModified(IdsContactoPeer::CA_ACTIVO)) $criteria->add(IdsContactoPeer::CA_ACTIVO, $this->ca_activo);
		if ($this->isColumnModified(IdsContactoPeer::CA_FCHCREADO)) $criteria->add(IdsContactoPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(IdsContactoPeer::CA_USUCREADO)) $criteria->add(IdsContactoPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(IdsContactoPeer::CA_FCHACTUALIZADO)) $criteria->add(IdsContactoPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(IdsContactoPeer::CA_USUACTUALIZADO)) $criteria->add(IdsContactoPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);
		if ($this->isColumnModified(IdsContactoPeer::CA_FCHELIMINADO)) $criteria->add(IdsContactoPeer::CA_FCHELIMINADO, $this->ca_fcheliminado);
		if ($this->isColumnModified(IdsContactoPeer::CA_USUELIMINADO)) $criteria->add(IdsContactoPeer::CA_USUELIMINADO, $this->ca_usueliminado);

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
		$criteria = new Criteria(IdsContactoPeer::DATABASE_NAME);

		$criteria->add(IdsContactoPeer::CA_IDCONTACTO, $this->ca_idcontacto);

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
	 * @param      object $copyObj An object of IdsContacto (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdcontacto($this->ca_idcontacto);

		$copyObj->setCaIdsucursal($this->ca_idsucursal);

		$copyObj->setCaNombres($this->ca_nombres);

		$copyObj->setCaPapellido($this->ca_papellido);

		$copyObj->setCaSapellido($this->ca_sapellido);

		$copyObj->setCaNombres($this->ca_nombres);

		$copyObj->setCaSaludo($this->ca_saludo);

		$copyObj->setCaDireccion($this->ca_direccion);

		$copyObj->setCaTelefonos($this->ca_telefonos);

		$copyObj->setCaFax($this->ca_fax);

		$copyObj->setCaIdciudad($this->ca_idciudad);

		$copyObj->setCaEmail($this->ca_email);

		$copyObj->setCaImpoexpo($this->ca_impoexpo);

		$copyObj->setCaTransporte($this->ca_transporte);

		$copyObj->setCaCargo($this->ca_cargo);

		$copyObj->setCaDepartamento($this->ca_departamento);

		$copyObj->setCaObservaciones($this->ca_observaciones);

		$copyObj->setCaSugerido($this->ca_sugerido);

		$copyObj->setCaActivo($this->ca_activo);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);

		$copyObj->setCaFcheliminado($this->ca_fcheliminado);

		$copyObj->setCaUsueliminado($this->ca_usueliminado);


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
	 * @return     IdsContacto Clone of current object.
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
	 * @return     IdsContactoPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new IdsContactoPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Ciudad object.
	 *
	 * @param      Ciudad $v
	 * @return     IdsContacto The current object (for fluent API support)
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
			$v->addIdsContacto($this);
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
			   $this->aCiudad->addIdsContactos($this);
			 */
		}
		return $this->aCiudad;
	}

	/**
	 * Declares an association between this object and a IdsSucursal object.
	 *
	 * @param      IdsSucursal $v
	 * @return     IdsContacto The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setIdsSucursal(IdsSucursal $v = null)
	{
		if ($v === null) {
			$this->setCaIdsucursal(NULL);
		} else {
			$this->setCaIdsucursal($v->getCaIdsucursal());
		}

		$this->aIdsSucursal = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the IdsSucursal object, it will not be re-added.
		if ($v !== null) {
			$v->addIdsContacto($this);
		}

		return $this;
	}


	/**
	 * Get the associated IdsSucursal object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     IdsSucursal The associated IdsSucursal object.
	 * @throws     PropelException
	 */
	public function getIdsSucursal(PropelPDO $con = null)
	{
		if ($this->aIdsSucursal === null && ($this->ca_idsucursal !== null)) {
			$c = new Criteria(IdsSucursalPeer::DATABASE_NAME);
			$c->add(IdsSucursalPeer::CA_IDSUCURSAL, $this->ca_idsucursal);
			$this->aIdsSucursal = IdsSucursalPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aIdsSucursal->addIdsContactos($this);
			 */
		}
		return $this->aIdsSucursal;
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

			$this->aCiudad = null;
			$this->aIdsSucursal = null;
	}

} // BaseIdsContacto
