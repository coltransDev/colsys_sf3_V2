<?php

/**
 * Base class that represents a row from the 'tb_clientes' table.
 *
 * 
 *
 * @package    lib.model.public.om
 */
abstract class BaseCliente extends BaseObject  implements Persistent {


  const PEER = 'ClientePeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        ClientePeer
	 */
	protected static $peer;

	/**
	 * The value for the ca_idcliente field.
	 * @var        int
	 */
	protected $ca_idcliente;

	/**
	 * The value for the ca_digito field.
	 * @var        int
	 */
	protected $ca_digito;

	/**
	 * The value for the ca_compania field.
	 * @var        string
	 */
	protected $ca_compania;

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
	 * The value for the ca_sexo field.
	 * @var        string
	 */
	protected $ca_sexo;

	/**
	 * The value for the ca_cumpleanos field.
	 * @var        string
	 */
	protected $ca_cumpleanos;

	/**
	 * The value for the ca_oficina field.
	 * @var        string
	 */
	protected $ca_oficina;

	/**
	 * The value for the ca_vendedor field.
	 * @var        string
	 */
	protected $ca_vendedor;

	/**
	 * The value for the ca_email field.
	 * @var        string
	 */
	protected $ca_email;

	/**
	 * The value for the ca_coordinador field.
	 * @var        string
	 */
	protected $ca_coordinador;

	/**
	 * The value for the ca_direccion field.
	 * @var        string
	 */
	protected $ca_direccion;

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
	 * The value for the ca_preferencias field.
	 * @var        string
	 */
	protected $ca_preferencias;

	/**
	 * The value for the ca_confirmar field.
	 * @var        string
	 */
	protected $ca_confirmar;

	/**
	 * The value for the ca_idciudad field.
	 * @var        string
	 */
	protected $ca_idciudad;

	/**
	 * The value for the ca_idgrupo field.
	 * @var        int
	 */
	protected $ca_idgrupo;

	/**
	 * The value for the ca_listaclinton field.
	 * @var        string
	 */
	protected $ca_listaclinton;

	/**
	 * The value for the ca_fchcircular field.
	 * @var        string
	 */
	protected $ca_fchcircular;

	/**
	 * The value for the ca_status field.
	 * @var        string
	 */
	protected $ca_status;

	/**
	 * @var        Ciudad
	 */
	protected $aCiudad;

	/**
	 * @var        array AduanaMaestra[] Collection to store aggregation of AduanaMaestra objects.
	 */
	protected $collAduanaMaestras;

	/**
	 * @var        Criteria The criteria used to select the current contents of collAduanaMaestras.
	 */
	private $lastAduanaMaestraCriteria = null;

	/**
	 * @var        array InoIngresosAir[] Collection to store aggregation of InoIngresosAir objects.
	 */
	protected $collInoIngresosAirs;

	/**
	 * @var        Criteria The criteria used to select the current contents of collInoIngresosAirs.
	 */
	private $lastInoIngresosAirCriteria = null;

	/**
	 * @var        array Contacto[] Collection to store aggregation of Contacto objects.
	 */
	protected $collContactos;

	/**
	 * @var        Criteria The criteria used to select the current contents of collContactos.
	 */
	private $lastContactoCriteria = null;

	/**
	 * @var        array ClienteStd[] Collection to store aggregation of ClienteStd objects.
	 */
	protected $collClienteStds;

	/**
	 * @var        Criteria The criteria used to select the current contents of collClienteStds.
	 */
	private $lastClienteStdCriteria = null;

	/**
	 * @var        array InoClientesSea[] Collection to store aggregation of InoClientesSea objects.
	 */
	protected $collInoClientesSeas;

	/**
	 * @var        Criteria The criteria used to select the current contents of collInoClientesSeas.
	 */
	private $lastInoClientesSeaCriteria = null;

	/**
	 * @var        array InoIngresosSea[] Collection to store aggregation of InoIngresosSea objects.
	 */
	protected $collInoIngresosSeas;

	/**
	 * @var        Criteria The criteria used to select the current contents of collInoIngresosSeas.
	 */
	private $lastInoIngresosSeaCriteria = null;

	/**
	 * @var        array InoAvisosSea[] Collection to store aggregation of InoAvisosSea objects.
	 */
	protected $collInoAvisosSeas;

	/**
	 * @var        Criteria The criteria used to select the current contents of collInoAvisosSeas.
	 */
	private $lastInoAvisosSeaCriteria = null;

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
	 * Initializes internal state of BaseCliente object.
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
	 * Get the [ca_idcliente] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdcliente()
	{
		return $this->ca_idcliente;
	}

	/**
	 * Get the [ca_digito] column value.
	 * 
	 * @return     int
	 */
	public function getCaDigito()
	{
		return $this->ca_digito;
	}

	/**
	 * Get the [ca_compania] column value.
	 * 
	 * @return     string
	 */
	public function getCaCompania()
	{
		return $this->ca_compania;
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
	 * Get the [ca_sexo] column value.
	 * 
	 * @return     string
	 */
	public function getCaSexo()
	{
		return $this->ca_sexo;
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
	 * Get the [ca_oficina] column value.
	 * 
	 * @return     string
	 */
	public function getCaOficina()
	{
		return $this->ca_oficina;
	}

	/**
	 * Get the [ca_vendedor] column value.
	 * 
	 * @return     string
	 */
	public function getCaVendedor()
	{
		return $this->ca_vendedor;
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
	 * Get the [ca_coordinador] column value.
	 * 
	 * @return     string
	 */
	public function getCaCoordinador()
	{
		return $this->ca_coordinador;
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
	 * Get the [ca_preferencias] column value.
	 * 
	 * @return     string
	 */
	public function getCaPreferencias()
	{
		return $this->ca_preferencias;
	}

	/**
	 * Get the [ca_confirmar] column value.
	 * 
	 * @return     string
	 */
	public function getCaConfirmar()
	{
		return $this->ca_confirmar;
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
	 * Get the [ca_idgrupo] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdgrupo()
	{
		return $this->ca_idgrupo;
	}

	/**
	 * Get the [ca_listaclinton] column value.
	 * 
	 * @return     string
	 */
	public function getCaListaclinton()
	{
		return $this->ca_listaclinton;
	}

	/**
	 * Get the [optionally formatted] temporal [ca_fchcircular] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaFchcircular($format = 'Y-m-d')
	{
		if ($this->ca_fchcircular === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchcircular);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchcircular, true), $x);
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
	 * Get the [ca_status] column value.
	 * 
	 * @return     string
	 */
	public function getCaStatus()
	{
		return $this->ca_status;
	}

	/**
	 * Set the value of [ca_idcliente] column.
	 * 
	 * @param      int $v new value
	 * @return     Cliente The current object (for fluent API support)
	 */
	public function setCaIdcliente($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idcliente !== $v) {
			$this->ca_idcliente = $v;
			$this->modifiedColumns[] = ClientePeer::CA_IDCLIENTE;
		}

		return $this;
	} // setCaIdcliente()

	/**
	 * Set the value of [ca_digito] column.
	 * 
	 * @param      int $v new value
	 * @return     Cliente The current object (for fluent API support)
	 */
	public function setCaDigito($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_digito !== $v) {
			$this->ca_digito = $v;
			$this->modifiedColumns[] = ClientePeer::CA_DIGITO;
		}

		return $this;
	} // setCaDigito()

	/**
	 * Set the value of [ca_compania] column.
	 * 
	 * @param      string $v new value
	 * @return     Cliente The current object (for fluent API support)
	 */
	public function setCaCompania($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_compania !== $v) {
			$this->ca_compania = $v;
			$this->modifiedColumns[] = ClientePeer::CA_COMPANIA;
		}

		return $this;
	} // setCaCompania()

	/**
	 * Set the value of [ca_papellido] column.
	 * 
	 * @param      string $v new value
	 * @return     Cliente The current object (for fluent API support)
	 */
	public function setCaPapellido($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_papellido !== $v) {
			$this->ca_papellido = $v;
			$this->modifiedColumns[] = ClientePeer::CA_PAPELLIDO;
		}

		return $this;
	} // setCaPapellido()

	/**
	 * Set the value of [ca_sapellido] column.
	 * 
	 * @param      string $v new value
	 * @return     Cliente The current object (for fluent API support)
	 */
	public function setCaSapellido($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_sapellido !== $v) {
			$this->ca_sapellido = $v;
			$this->modifiedColumns[] = ClientePeer::CA_SAPELLIDO;
		}

		return $this;
	} // setCaSapellido()

	/**
	 * Set the value of [ca_nombres] column.
	 * 
	 * @param      string $v new value
	 * @return     Cliente The current object (for fluent API support)
	 */
	public function setCaNombres($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_nombres !== $v) {
			$this->ca_nombres = $v;
			$this->modifiedColumns[] = ClientePeer::CA_NOMBRES;
		}

		return $this;
	} // setCaNombres()

	/**
	 * Set the value of [ca_saludo] column.
	 * 
	 * @param      string $v new value
	 * @return     Cliente The current object (for fluent API support)
	 */
	public function setCaSaludo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_saludo !== $v) {
			$this->ca_saludo = $v;
			$this->modifiedColumns[] = ClientePeer::CA_SALUDO;
		}

		return $this;
	} // setCaSaludo()

	/**
	 * Set the value of [ca_sexo] column.
	 * 
	 * @param      string $v new value
	 * @return     Cliente The current object (for fluent API support)
	 */
	public function setCaSexo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_sexo !== $v) {
			$this->ca_sexo = $v;
			$this->modifiedColumns[] = ClientePeer::CA_SEXO;
		}

		return $this;
	} // setCaSexo()

	/**
	 * Set the value of [ca_cumpleanos] column.
	 * 
	 * @param      string $v new value
	 * @return     Cliente The current object (for fluent API support)
	 */
	public function setCaCumpleanos($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_cumpleanos !== $v) {
			$this->ca_cumpleanos = $v;
			$this->modifiedColumns[] = ClientePeer::CA_CUMPLEANOS;
		}

		return $this;
	} // setCaCumpleanos()

	/**
	 * Set the value of [ca_oficina] column.
	 * 
	 * @param      string $v new value
	 * @return     Cliente The current object (for fluent API support)
	 */
	public function setCaOficina($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_oficina !== $v) {
			$this->ca_oficina = $v;
			$this->modifiedColumns[] = ClientePeer::CA_OFICINA;
		}

		return $this;
	} // setCaOficina()

	/**
	 * Set the value of [ca_vendedor] column.
	 * 
	 * @param      string $v new value
	 * @return     Cliente The current object (for fluent API support)
	 */
	public function setCaVendedor($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_vendedor !== $v) {
			$this->ca_vendedor = $v;
			$this->modifiedColumns[] = ClientePeer::CA_VENDEDOR;
		}

		return $this;
	} // setCaVendedor()

	/**
	 * Set the value of [ca_email] column.
	 * 
	 * @param      string $v new value
	 * @return     Cliente The current object (for fluent API support)
	 */
	public function setCaEmail($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_email !== $v) {
			$this->ca_email = $v;
			$this->modifiedColumns[] = ClientePeer::CA_EMAIL;
		}

		return $this;
	} // setCaEmail()

	/**
	 * Set the value of [ca_coordinador] column.
	 * 
	 * @param      string $v new value
	 * @return     Cliente The current object (for fluent API support)
	 */
	public function setCaCoordinador($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_coordinador !== $v) {
			$this->ca_coordinador = $v;
			$this->modifiedColumns[] = ClientePeer::CA_COORDINADOR;
		}

		return $this;
	} // setCaCoordinador()

	/**
	 * Set the value of [ca_direccion] column.
	 * 
	 * @param      string $v new value
	 * @return     Cliente The current object (for fluent API support)
	 */
	public function setCaDireccion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_direccion !== $v) {
			$this->ca_direccion = $v;
			$this->modifiedColumns[] = ClientePeer::CA_DIRECCION;
		}

		return $this;
	} // setCaDireccion()

	/**
	 * Set the value of [ca_localidad] column.
	 * 
	 * @param      string $v new value
	 * @return     Cliente The current object (for fluent API support)
	 */
	public function setCaLocalidad($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_localidad !== $v) {
			$this->ca_localidad = $v;
			$this->modifiedColumns[] = ClientePeer::CA_LOCALIDAD;
		}

		return $this;
	} // setCaLocalidad()

	/**
	 * Set the value of [ca_complemento] column.
	 * 
	 * @param      string $v new value
	 * @return     Cliente The current object (for fluent API support)
	 */
	public function setCaComplemento($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_complemento !== $v) {
			$this->ca_complemento = $v;
			$this->modifiedColumns[] = ClientePeer::CA_COMPLEMENTO;
		}

		return $this;
	} // setCaComplemento()

	/**
	 * Set the value of [ca_telefonos] column.
	 * 
	 * @param      string $v new value
	 * @return     Cliente The current object (for fluent API support)
	 */
	public function setCaTelefonos($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_telefonos !== $v) {
			$this->ca_telefonos = $v;
			$this->modifiedColumns[] = ClientePeer::CA_TELEFONOS;
		}

		return $this;
	} // setCaTelefonos()

	/**
	 * Set the value of [ca_fax] column.
	 * 
	 * @param      string $v new value
	 * @return     Cliente The current object (for fluent API support)
	 */
	public function setCaFax($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_fax !== $v) {
			$this->ca_fax = $v;
			$this->modifiedColumns[] = ClientePeer::CA_FAX;
		}

		return $this;
	} // setCaFax()

	/**
	 * Set the value of [ca_preferencias] column.
	 * 
	 * @param      string $v new value
	 * @return     Cliente The current object (for fluent API support)
	 */
	public function setCaPreferencias($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_preferencias !== $v) {
			$this->ca_preferencias = $v;
			$this->modifiedColumns[] = ClientePeer::CA_PREFERENCIAS;
		}

		return $this;
	} // setCaPreferencias()

	/**
	 * Set the value of [ca_confirmar] column.
	 * 
	 * @param      string $v new value
	 * @return     Cliente The current object (for fluent API support)
	 */
	public function setCaConfirmar($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_confirmar !== $v) {
			$this->ca_confirmar = $v;
			$this->modifiedColumns[] = ClientePeer::CA_CONFIRMAR;
		}

		return $this;
	} // setCaConfirmar()

	/**
	 * Set the value of [ca_idciudad] column.
	 * 
	 * @param      string $v new value
	 * @return     Cliente The current object (for fluent API support)
	 */
	public function setCaIdciudad($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idciudad !== $v) {
			$this->ca_idciudad = $v;
			$this->modifiedColumns[] = ClientePeer::CA_IDCIUDAD;
		}

		if ($this->aCiudad !== null && $this->aCiudad->getCaIdciudad() !== $v) {
			$this->aCiudad = null;
		}

		return $this;
	} // setCaIdciudad()

	/**
	 * Set the value of [ca_idgrupo] column.
	 * 
	 * @param      int $v new value
	 * @return     Cliente The current object (for fluent API support)
	 */
	public function setCaIdgrupo($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idgrupo !== $v) {
			$this->ca_idgrupo = $v;
			$this->modifiedColumns[] = ClientePeer::CA_IDGRUPO;
		}

		return $this;
	} // setCaIdgrupo()

	/**
	 * Set the value of [ca_listaclinton] column.
	 * 
	 * @param      string $v new value
	 * @return     Cliente The current object (for fluent API support)
	 */
	public function setCaListaclinton($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_listaclinton !== $v) {
			$this->ca_listaclinton = $v;
			$this->modifiedColumns[] = ClientePeer::CA_LISTACLINTON;
		}

		return $this;
	} // setCaListaclinton()

	/**
	 * Sets the value of [ca_fchcircular] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     Cliente The current object (for fluent API support)
	 */
	public function setCaFchcircular($v)
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

		if ( $this->ca_fchcircular !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fchcircular !== null && $tmpDt = new DateTime($this->ca_fchcircular)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchcircular = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = ClientePeer::CA_FCHCIRCULAR;
			}
		} // if either are not null

		return $this;
	} // setCaFchcircular()

	/**
	 * Set the value of [ca_status] column.
	 * 
	 * @param      string $v new value
	 * @return     Cliente The current object (for fluent API support)
	 */
	public function setCaStatus($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_status !== $v) {
			$this->ca_status = $v;
			$this->modifiedColumns[] = ClientePeer::CA_STATUS;
		}

		return $this;
	} // setCaStatus()

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

			$this->ca_idcliente = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_digito = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_compania = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_papellido = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_sapellido = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_nombres = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_saludo = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_sexo = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_cumpleanos = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_oficina = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_vendedor = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_email = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_coordinador = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_direccion = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->ca_localidad = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->ca_complemento = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->ca_telefonos = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
			$this->ca_fax = ($row[$startcol + 17] !== null) ? (string) $row[$startcol + 17] : null;
			$this->ca_preferencias = ($row[$startcol + 18] !== null) ? (string) $row[$startcol + 18] : null;
			$this->ca_confirmar = ($row[$startcol + 19] !== null) ? (string) $row[$startcol + 19] : null;
			$this->ca_idciudad = ($row[$startcol + 20] !== null) ? (string) $row[$startcol + 20] : null;
			$this->ca_idgrupo = ($row[$startcol + 21] !== null) ? (int) $row[$startcol + 21] : null;
			$this->ca_listaclinton = ($row[$startcol + 22] !== null) ? (string) $row[$startcol + 22] : null;
			$this->ca_fchcircular = ($row[$startcol + 23] !== null) ? (string) $row[$startcol + 23] : null;
			$this->ca_status = ($row[$startcol + 24] !== null) ? (string) $row[$startcol + 24] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 25; // 25 = ClientePeer::NUM_COLUMNS - ClientePeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Cliente object", $e);
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
			$con = Propel::getConnection(ClientePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = ClientePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aCiudad = null;
			$this->collAduanaMaestras = null;
			$this->lastAduanaMaestraCriteria = null;

			$this->collInoIngresosAirs = null;
			$this->lastInoIngresosAirCriteria = null;

			$this->collContactos = null;
			$this->lastContactoCriteria = null;

			$this->collClienteStds = null;
			$this->lastClienteStdCriteria = null;

			$this->collInoClientesSeas = null;
			$this->lastInoClientesSeaCriteria = null;

			$this->collInoIngresosSeas = null;
			$this->lastInoIngresosSeaCriteria = null;

			$this->collInoAvisosSeas = null;
			$this->lastInoAvisosSeaCriteria = null;

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
			$con = Propel::getConnection(ClientePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			ClientePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(ClientePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			ClientePeer::addInstanceToPool($this);
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

			if ($this->isNew() ) {
				$this->modifiedColumns[] = ClientePeer::CA_IDCLIENTE;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ClientePeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setCaIdcliente($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += ClientePeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collAduanaMaestras !== null) {
				foreach ($this->collAduanaMaestras as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collInoIngresosAirs !== null) {
				foreach ($this->collInoIngresosAirs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collContactos !== null) {
				foreach ($this->collContactos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collClienteStds !== null) {
				foreach ($this->collClienteStds as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collInoClientesSeas !== null) {
				foreach ($this->collInoClientesSeas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collInoIngresosSeas !== null) {
				foreach ($this->collInoIngresosSeas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collInoAvisosSeas !== null) {
				foreach ($this->collInoAvisosSeas as $referrerFK) {
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


			if (($retval = ClientePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collAduanaMaestras !== null) {
					foreach ($this->collAduanaMaestras as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collInoIngresosAirs !== null) {
					foreach ($this->collInoIngresosAirs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collContactos !== null) {
					foreach ($this->collContactos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collClienteStds !== null) {
					foreach ($this->collClienteStds as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collInoClientesSeas !== null) {
					foreach ($this->collInoClientesSeas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collInoIngresosSeas !== null) {
					foreach ($this->collInoIngresosSeas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collInoAvisosSeas !== null) {
					foreach ($this->collInoAvisosSeas as $referrerFK) {
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
		$pos = ClientePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdcliente();
				break;
			case 1:
				return $this->getCaDigito();
				break;
			case 2:
				return $this->getCaCompania();
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
				return $this->getCaSexo();
				break;
			case 8:
				return $this->getCaCumpleanos();
				break;
			case 9:
				return $this->getCaOficina();
				break;
			case 10:
				return $this->getCaVendedor();
				break;
			case 11:
				return $this->getCaEmail();
				break;
			case 12:
				return $this->getCaCoordinador();
				break;
			case 13:
				return $this->getCaDireccion();
				break;
			case 14:
				return $this->getCaLocalidad();
				break;
			case 15:
				return $this->getCaComplemento();
				break;
			case 16:
				return $this->getCaTelefonos();
				break;
			case 17:
				return $this->getCaFax();
				break;
			case 18:
				return $this->getCaPreferencias();
				break;
			case 19:
				return $this->getCaConfirmar();
				break;
			case 20:
				return $this->getCaIdciudad();
				break;
			case 21:
				return $this->getCaIdgrupo();
				break;
			case 22:
				return $this->getCaListaclinton();
				break;
			case 23:
				return $this->getCaFchcircular();
				break;
			case 24:
				return $this->getCaStatus();
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
		$keys = ClientePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdcliente(),
			$keys[1] => $this->getCaDigito(),
			$keys[2] => $this->getCaCompania(),
			$keys[3] => $this->getCaPapellido(),
			$keys[4] => $this->getCaSapellido(),
			$keys[5] => $this->getCaNombres(),
			$keys[6] => $this->getCaSaludo(),
			$keys[7] => $this->getCaSexo(),
			$keys[8] => $this->getCaCumpleanos(),
			$keys[9] => $this->getCaOficina(),
			$keys[10] => $this->getCaVendedor(),
			$keys[11] => $this->getCaEmail(),
			$keys[12] => $this->getCaCoordinador(),
			$keys[13] => $this->getCaDireccion(),
			$keys[14] => $this->getCaLocalidad(),
			$keys[15] => $this->getCaComplemento(),
			$keys[16] => $this->getCaTelefonos(),
			$keys[17] => $this->getCaFax(),
			$keys[18] => $this->getCaPreferencias(),
			$keys[19] => $this->getCaConfirmar(),
			$keys[20] => $this->getCaIdciudad(),
			$keys[21] => $this->getCaIdgrupo(),
			$keys[22] => $this->getCaListaclinton(),
			$keys[23] => $this->getCaFchcircular(),
			$keys[24] => $this->getCaStatus(),
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
		$pos = ClientePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdcliente($value);
				break;
			case 1:
				$this->setCaDigito($value);
				break;
			case 2:
				$this->setCaCompania($value);
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
				$this->setCaSexo($value);
				break;
			case 8:
				$this->setCaCumpleanos($value);
				break;
			case 9:
				$this->setCaOficina($value);
				break;
			case 10:
				$this->setCaVendedor($value);
				break;
			case 11:
				$this->setCaEmail($value);
				break;
			case 12:
				$this->setCaCoordinador($value);
				break;
			case 13:
				$this->setCaDireccion($value);
				break;
			case 14:
				$this->setCaLocalidad($value);
				break;
			case 15:
				$this->setCaComplemento($value);
				break;
			case 16:
				$this->setCaTelefonos($value);
				break;
			case 17:
				$this->setCaFax($value);
				break;
			case 18:
				$this->setCaPreferencias($value);
				break;
			case 19:
				$this->setCaConfirmar($value);
				break;
			case 20:
				$this->setCaIdciudad($value);
				break;
			case 21:
				$this->setCaIdgrupo($value);
				break;
			case 22:
				$this->setCaListaclinton($value);
				break;
			case 23:
				$this->setCaFchcircular($value);
				break;
			case 24:
				$this->setCaStatus($value);
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
		$keys = ClientePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdcliente($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaDigito($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaCompania($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaPapellido($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaSapellido($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaNombres($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaSaludo($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaSexo($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaCumpleanos($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaOficina($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaVendedor($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaEmail($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaCoordinador($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaDireccion($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaLocalidad($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaComplemento($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCaTelefonos($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setCaFax($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setCaPreferencias($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setCaConfirmar($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setCaIdciudad($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setCaIdgrupo($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setCaListaclinton($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setCaFchcircular($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setCaStatus($arr[$keys[24]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(ClientePeer::DATABASE_NAME);

		if ($this->isColumnModified(ClientePeer::CA_IDCLIENTE)) $criteria->add(ClientePeer::CA_IDCLIENTE, $this->ca_idcliente);
		if ($this->isColumnModified(ClientePeer::CA_DIGITO)) $criteria->add(ClientePeer::CA_DIGITO, $this->ca_digito);
		if ($this->isColumnModified(ClientePeer::CA_COMPANIA)) $criteria->add(ClientePeer::CA_COMPANIA, $this->ca_compania);
		if ($this->isColumnModified(ClientePeer::CA_PAPELLIDO)) $criteria->add(ClientePeer::CA_PAPELLIDO, $this->ca_papellido);
		if ($this->isColumnModified(ClientePeer::CA_SAPELLIDO)) $criteria->add(ClientePeer::CA_SAPELLIDO, $this->ca_sapellido);
		if ($this->isColumnModified(ClientePeer::CA_NOMBRES)) $criteria->add(ClientePeer::CA_NOMBRES, $this->ca_nombres);
		if ($this->isColumnModified(ClientePeer::CA_SALUDO)) $criteria->add(ClientePeer::CA_SALUDO, $this->ca_saludo);
		if ($this->isColumnModified(ClientePeer::CA_SEXO)) $criteria->add(ClientePeer::CA_SEXO, $this->ca_sexo);
		if ($this->isColumnModified(ClientePeer::CA_CUMPLEANOS)) $criteria->add(ClientePeer::CA_CUMPLEANOS, $this->ca_cumpleanos);
		if ($this->isColumnModified(ClientePeer::CA_OFICINA)) $criteria->add(ClientePeer::CA_OFICINA, $this->ca_oficina);
		if ($this->isColumnModified(ClientePeer::CA_VENDEDOR)) $criteria->add(ClientePeer::CA_VENDEDOR, $this->ca_vendedor);
		if ($this->isColumnModified(ClientePeer::CA_EMAIL)) $criteria->add(ClientePeer::CA_EMAIL, $this->ca_email);
		if ($this->isColumnModified(ClientePeer::CA_COORDINADOR)) $criteria->add(ClientePeer::CA_COORDINADOR, $this->ca_coordinador);
		if ($this->isColumnModified(ClientePeer::CA_DIRECCION)) $criteria->add(ClientePeer::CA_DIRECCION, $this->ca_direccion);
		if ($this->isColumnModified(ClientePeer::CA_LOCALIDAD)) $criteria->add(ClientePeer::CA_LOCALIDAD, $this->ca_localidad);
		if ($this->isColumnModified(ClientePeer::CA_COMPLEMENTO)) $criteria->add(ClientePeer::CA_COMPLEMENTO, $this->ca_complemento);
		if ($this->isColumnModified(ClientePeer::CA_TELEFONOS)) $criteria->add(ClientePeer::CA_TELEFONOS, $this->ca_telefonos);
		if ($this->isColumnModified(ClientePeer::CA_FAX)) $criteria->add(ClientePeer::CA_FAX, $this->ca_fax);
		if ($this->isColumnModified(ClientePeer::CA_PREFERENCIAS)) $criteria->add(ClientePeer::CA_PREFERENCIAS, $this->ca_preferencias);
		if ($this->isColumnModified(ClientePeer::CA_CONFIRMAR)) $criteria->add(ClientePeer::CA_CONFIRMAR, $this->ca_confirmar);
		if ($this->isColumnModified(ClientePeer::CA_IDCIUDAD)) $criteria->add(ClientePeer::CA_IDCIUDAD, $this->ca_idciudad);
		if ($this->isColumnModified(ClientePeer::CA_IDGRUPO)) $criteria->add(ClientePeer::CA_IDGRUPO, $this->ca_idgrupo);
		if ($this->isColumnModified(ClientePeer::CA_LISTACLINTON)) $criteria->add(ClientePeer::CA_LISTACLINTON, $this->ca_listaclinton);
		if ($this->isColumnModified(ClientePeer::CA_FCHCIRCULAR)) $criteria->add(ClientePeer::CA_FCHCIRCULAR, $this->ca_fchcircular);
		if ($this->isColumnModified(ClientePeer::CA_STATUS)) $criteria->add(ClientePeer::CA_STATUS, $this->ca_status);

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
		$criteria = new Criteria(ClientePeer::DATABASE_NAME);

		$criteria->add(ClientePeer::CA_IDCLIENTE, $this->ca_idcliente);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdcliente();
	}

	/**
	 * Generic method to set the primary key (ca_idcliente column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdcliente($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Cliente (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaDigito($this->ca_digito);

		$copyObj->setCaCompania($this->ca_compania);

		$copyObj->setCaPapellido($this->ca_papellido);

		$copyObj->setCaSapellido($this->ca_sapellido);

		$copyObj->setCaNombres($this->ca_nombres);

		$copyObj->setCaSaludo($this->ca_saludo);

		$copyObj->setCaSexo($this->ca_sexo);

		$copyObj->setCaCumpleanos($this->ca_cumpleanos);

		$copyObj->setCaOficina($this->ca_oficina);

		$copyObj->setCaVendedor($this->ca_vendedor);

		$copyObj->setCaEmail($this->ca_email);

		$copyObj->setCaCoordinador($this->ca_coordinador);

		$copyObj->setCaDireccion($this->ca_direccion);

		$copyObj->setCaLocalidad($this->ca_localidad);

		$copyObj->setCaComplemento($this->ca_complemento);

		$copyObj->setCaTelefonos($this->ca_telefonos);

		$copyObj->setCaFax($this->ca_fax);

		$copyObj->setCaPreferencias($this->ca_preferencias);

		$copyObj->setCaConfirmar($this->ca_confirmar);

		$copyObj->setCaIdciudad($this->ca_idciudad);

		$copyObj->setCaIdgrupo($this->ca_idgrupo);

		$copyObj->setCaListaclinton($this->ca_listaclinton);

		$copyObj->setCaFchcircular($this->ca_fchcircular);

		$copyObj->setCaStatus($this->ca_status);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getAduanaMaestras() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addAduanaMaestra($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getInoIngresosAirs() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addInoIngresosAir($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getContactos() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addContacto($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getClienteStds() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addClienteStd($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getInoClientesSeas() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addInoClientesSea($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getInoIngresosSeas() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addInoIngresosSea($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getInoAvisosSeas() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addInoAvisosSea($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setCaIdcliente(NULL); // this is a auto-increment column, so set to default value

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
	 * @return     Cliente Clone of current object.
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
	 * @return     ClientePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ClientePeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Ciudad object.
	 *
	 * @param      Ciudad $v
	 * @return     Cliente The current object (for fluent API support)
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
			$v->addCliente($this);
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
			   $this->aCiudad->addClientes($this);
			 */
		}
		return $this->aCiudad;
	}

	/**
	 * Clears out the collAduanaMaestras collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addAduanaMaestras()
	 */
	public function clearAduanaMaestras()
	{
		$this->collAduanaMaestras = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collAduanaMaestras collection (array).
	 *
	 * By default this just sets the collAduanaMaestras collection to an empty array (like clearcollAduanaMaestras());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initAduanaMaestras()
	{
		$this->collAduanaMaestras = array();
	}

	/**
	 * Gets an array of AduanaMaestra objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Cliente has previously been saved, it will retrieve
	 * related AduanaMaestras from storage. If this Cliente is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array AduanaMaestra[]
	 * @throws     PropelException
	 */
	public function getAduanaMaestras($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAduanaMaestras === null) {
			if ($this->isNew()) {
			   $this->collAduanaMaestras = array();
			} else {

				$criteria->add(AduanaMaestraPeer::CA_IDCLIENTE, $this->ca_idcliente);

				AduanaMaestraPeer::addSelectColumns($criteria);
				$this->collAduanaMaestras = AduanaMaestraPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(AduanaMaestraPeer::CA_IDCLIENTE, $this->ca_idcliente);

				AduanaMaestraPeer::addSelectColumns($criteria);
				if (!isset($this->lastAduanaMaestraCriteria) || !$this->lastAduanaMaestraCriteria->equals($criteria)) {
					$this->collAduanaMaestras = AduanaMaestraPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAduanaMaestraCriteria = $criteria;
		return $this->collAduanaMaestras;
	}

	/**
	 * Returns the number of related AduanaMaestra objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related AduanaMaestra objects.
	 * @throws     PropelException
	 */
	public function countAduanaMaestras(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collAduanaMaestras === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(AduanaMaestraPeer::CA_IDCLIENTE, $this->ca_idcliente);

				$count = AduanaMaestraPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(AduanaMaestraPeer::CA_IDCLIENTE, $this->ca_idcliente);

				if (!isset($this->lastAduanaMaestraCriteria) || !$this->lastAduanaMaestraCriteria->equals($criteria)) {
					$count = AduanaMaestraPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collAduanaMaestras);
				}
			} else {
				$count = count($this->collAduanaMaestras);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a AduanaMaestra object to this object
	 * through the AduanaMaestra foreign key attribute.
	 *
	 * @param      AduanaMaestra $l AduanaMaestra
	 * @return     void
	 * @throws     PropelException
	 */
	public function addAduanaMaestra(AduanaMaestra $l)
	{
		if ($this->collAduanaMaestras === null) {
			$this->initAduanaMaestras();
		}
		if (!in_array($l, $this->collAduanaMaestras, true)) { // only add it if the **same** object is not already associated
			array_push($this->collAduanaMaestras, $l);
			$l->setCliente($this);
		}
	}

	/**
	 * Clears out the collInoIngresosAirs collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addInoIngresosAirs()
	 */
	public function clearInoIngresosAirs()
	{
		$this->collInoIngresosAirs = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collInoIngresosAirs collection (array).
	 *
	 * By default this just sets the collInoIngresosAirs collection to an empty array (like clearcollInoIngresosAirs());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initInoIngresosAirs()
	{
		$this->collInoIngresosAirs = array();
	}

	/**
	 * Gets an array of InoIngresosAir objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Cliente has previously been saved, it will retrieve
	 * related InoIngresosAirs from storage. If this Cliente is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array InoIngresosAir[]
	 * @throws     PropelException
	 */
	public function getInoIngresosAirs($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoIngresosAirs === null) {
			if ($this->isNew()) {
			   $this->collInoIngresosAirs = array();
			} else {

				$criteria->add(InoIngresosAirPeer::CA_IDCLIENTE, $this->ca_idcliente);

				InoIngresosAirPeer::addSelectColumns($criteria);
				$this->collInoIngresosAirs = InoIngresosAirPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(InoIngresosAirPeer::CA_IDCLIENTE, $this->ca_idcliente);

				InoIngresosAirPeer::addSelectColumns($criteria);
				if (!isset($this->lastInoIngresosAirCriteria) || !$this->lastInoIngresosAirCriteria->equals($criteria)) {
					$this->collInoIngresosAirs = InoIngresosAirPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInoIngresosAirCriteria = $criteria;
		return $this->collInoIngresosAirs;
	}

	/**
	 * Returns the number of related InoIngresosAir objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related InoIngresosAir objects.
	 * @throws     PropelException
	 */
	public function countInoIngresosAirs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collInoIngresosAirs === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(InoIngresosAirPeer::CA_IDCLIENTE, $this->ca_idcliente);

				$count = InoIngresosAirPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(InoIngresosAirPeer::CA_IDCLIENTE, $this->ca_idcliente);

				if (!isset($this->lastInoIngresosAirCriteria) || !$this->lastInoIngresosAirCriteria->equals($criteria)) {
					$count = InoIngresosAirPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collInoIngresosAirs);
				}
			} else {
				$count = count($this->collInoIngresosAirs);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a InoIngresosAir object to this object
	 * through the InoIngresosAir foreign key attribute.
	 *
	 * @param      InoIngresosAir $l InoIngresosAir
	 * @return     void
	 * @throws     PropelException
	 */
	public function addInoIngresosAir(InoIngresosAir $l)
	{
		if ($this->collInoIngresosAirs === null) {
			$this->initInoIngresosAirs();
		}
		if (!in_array($l, $this->collInoIngresosAirs, true)) { // only add it if the **same** object is not already associated
			array_push($this->collInoIngresosAirs, $l);
			$l->setCliente($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Cliente is new, it will return
	 * an empty collection; or if this Cliente has previously
	 * been saved, it will retrieve related InoIngresosAirs from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Cliente.
	 */
	public function getInoIngresosAirsJoinInoMaestraAir($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoIngresosAirs === null) {
			if ($this->isNew()) {
				$this->collInoIngresosAirs = array();
			} else {

				$criteria->add(InoIngresosAirPeer::CA_IDCLIENTE, $this->ca_idcliente);

				$this->collInoIngresosAirs = InoIngresosAirPeer::doSelectJoinInoMaestraAir($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(InoIngresosAirPeer::CA_IDCLIENTE, $this->ca_idcliente);

			if (!isset($this->lastInoIngresosAirCriteria) || !$this->lastInoIngresosAirCriteria->equals($criteria)) {
				$this->collInoIngresosAirs = InoIngresosAirPeer::doSelectJoinInoMaestraAir($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoIngresosAirCriteria = $criteria;

		return $this->collInoIngresosAirs;
	}

	/**
	 * Clears out the collContactos collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addContactos()
	 */
	public function clearContactos()
	{
		$this->collContactos = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collContactos collection (array).
	 *
	 * By default this just sets the collContactos collection to an empty array (like clearcollContactos());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initContactos()
	{
		$this->collContactos = array();
	}

	/**
	 * Gets an array of Contacto objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Cliente has previously been saved, it will retrieve
	 * related Contactos from storage. If this Cliente is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array Contacto[]
	 * @throws     PropelException
	 */
	public function getContactos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collContactos === null) {
			if ($this->isNew()) {
			   $this->collContactos = array();
			} else {

				$criteria->add(ContactoPeer::CA_IDCLIENTE, $this->ca_idcliente);

				ContactoPeer::addSelectColumns($criteria);
				$this->collContactos = ContactoPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ContactoPeer::CA_IDCLIENTE, $this->ca_idcliente);

				ContactoPeer::addSelectColumns($criteria);
				if (!isset($this->lastContactoCriteria) || !$this->lastContactoCriteria->equals($criteria)) {
					$this->collContactos = ContactoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastContactoCriteria = $criteria;
		return $this->collContactos;
	}

	/**
	 * Returns the number of related Contacto objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Contacto objects.
	 * @throws     PropelException
	 */
	public function countContactos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collContactos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(ContactoPeer::CA_IDCLIENTE, $this->ca_idcliente);

				$count = ContactoPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(ContactoPeer::CA_IDCLIENTE, $this->ca_idcliente);

				if (!isset($this->lastContactoCriteria) || !$this->lastContactoCriteria->equals($criteria)) {
					$count = ContactoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collContactos);
				}
			} else {
				$count = count($this->collContactos);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a Contacto object to this object
	 * through the Contacto foreign key attribute.
	 *
	 * @param      Contacto $l Contacto
	 * @return     void
	 * @throws     PropelException
	 */
	public function addContacto(Contacto $l)
	{
		if ($this->collContactos === null) {
			$this->initContactos();
		}
		if (!in_array($l, $this->collContactos, true)) { // only add it if the **same** object is not already associated
			array_push($this->collContactos, $l);
			$l->setCliente($this);
		}
	}

	/**
	 * Clears out the collClienteStds collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addClienteStds()
	 */
	public function clearClienteStds()
	{
		$this->collClienteStds = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collClienteStds collection (array).
	 *
	 * By default this just sets the collClienteStds collection to an empty array (like clearcollClienteStds());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initClienteStds()
	{
		$this->collClienteStds = array();
	}

	/**
	 * Gets an array of ClienteStd objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Cliente has previously been saved, it will retrieve
	 * related ClienteStds from storage. If this Cliente is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array ClienteStd[]
	 * @throws     PropelException
	 */
	public function getClienteStds($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collClienteStds === null) {
			if ($this->isNew()) {
			   $this->collClienteStds = array();
			} else {

				$criteria->add(ClienteStdPeer::CA_IDCLIENTE, $this->ca_idcliente);

				ClienteStdPeer::addSelectColumns($criteria);
				$this->collClienteStds = ClienteStdPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ClienteStdPeer::CA_IDCLIENTE, $this->ca_idcliente);

				ClienteStdPeer::addSelectColumns($criteria);
				if (!isset($this->lastClienteStdCriteria) || !$this->lastClienteStdCriteria->equals($criteria)) {
					$this->collClienteStds = ClienteStdPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastClienteStdCriteria = $criteria;
		return $this->collClienteStds;
	}

	/**
	 * Returns the number of related ClienteStd objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related ClienteStd objects.
	 * @throws     PropelException
	 */
	public function countClienteStds(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collClienteStds === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(ClienteStdPeer::CA_IDCLIENTE, $this->ca_idcliente);

				$count = ClienteStdPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(ClienteStdPeer::CA_IDCLIENTE, $this->ca_idcliente);

				if (!isset($this->lastClienteStdCriteria) || !$this->lastClienteStdCriteria->equals($criteria)) {
					$count = ClienteStdPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collClienteStds);
				}
			} else {
				$count = count($this->collClienteStds);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a ClienteStd object to this object
	 * through the ClienteStd foreign key attribute.
	 *
	 * @param      ClienteStd $l ClienteStd
	 * @return     void
	 * @throws     PropelException
	 */
	public function addClienteStd(ClienteStd $l)
	{
		if ($this->collClienteStds === null) {
			$this->initClienteStds();
		}
		if (!in_array($l, $this->collClienteStds, true)) { // only add it if the **same** object is not already associated
			array_push($this->collClienteStds, $l);
			$l->setCliente($this);
		}
	}

	/**
	 * Clears out the collInoClientesSeas collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addInoClientesSeas()
	 */
	public function clearInoClientesSeas()
	{
		$this->collInoClientesSeas = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collInoClientesSeas collection (array).
	 *
	 * By default this just sets the collInoClientesSeas collection to an empty array (like clearcollInoClientesSeas());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initInoClientesSeas()
	{
		$this->collInoClientesSeas = array();
	}

	/**
	 * Gets an array of InoClientesSea objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Cliente has previously been saved, it will retrieve
	 * related InoClientesSeas from storage. If this Cliente is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array InoClientesSea[]
	 * @throws     PropelException
	 */
	public function getInoClientesSeas($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesSeas === null) {
			if ($this->isNew()) {
			   $this->collInoClientesSeas = array();
			} else {

				$criteria->add(InoClientesSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

				InoClientesSeaPeer::addSelectColumns($criteria);
				$this->collInoClientesSeas = InoClientesSeaPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(InoClientesSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

				InoClientesSeaPeer::addSelectColumns($criteria);
				if (!isset($this->lastInoClientesSeaCriteria) || !$this->lastInoClientesSeaCriteria->equals($criteria)) {
					$this->collInoClientesSeas = InoClientesSeaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInoClientesSeaCriteria = $criteria;
		return $this->collInoClientesSeas;
	}

	/**
	 * Returns the number of related InoClientesSea objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related InoClientesSea objects.
	 * @throws     PropelException
	 */
	public function countInoClientesSeas(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collInoClientesSeas === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(InoClientesSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

				$count = InoClientesSeaPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(InoClientesSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

				if (!isset($this->lastInoClientesSeaCriteria) || !$this->lastInoClientesSeaCriteria->equals($criteria)) {
					$count = InoClientesSeaPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collInoClientesSeas);
				}
			} else {
				$count = count($this->collInoClientesSeas);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a InoClientesSea object to this object
	 * through the InoClientesSea foreign key attribute.
	 *
	 * @param      InoClientesSea $l InoClientesSea
	 * @return     void
	 * @throws     PropelException
	 */
	public function addInoClientesSea(InoClientesSea $l)
	{
		if ($this->collInoClientesSeas === null) {
			$this->initInoClientesSeas();
		}
		if (!in_array($l, $this->collInoClientesSeas, true)) { // only add it if the **same** object is not already associated
			array_push($this->collInoClientesSeas, $l);
			$l->setCliente($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Cliente is new, it will return
	 * an empty collection; or if this Cliente has previously
	 * been saved, it will retrieve related InoClientesSeas from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Cliente.
	 */
	public function getInoClientesSeasJoinReporte($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesSeas === null) {
			if ($this->isNew()) {
				$this->collInoClientesSeas = array();
			} else {

				$criteria->add(InoClientesSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(InoClientesSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

			if (!isset($this->lastInoClientesSeaCriteria) || !$this->lastInoClientesSeaCriteria->equals($criteria)) {
				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoClientesSeaCriteria = $criteria;

		return $this->collInoClientesSeas;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Cliente is new, it will return
	 * an empty collection; or if this Cliente has previously
	 * been saved, it will retrieve related InoClientesSeas from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Cliente.
	 */
	public function getInoClientesSeasJoinTercero($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesSeas === null) {
			if ($this->isNew()) {
				$this->collInoClientesSeas = array();
			} else {

				$criteria->add(InoClientesSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinTercero($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(InoClientesSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

			if (!isset($this->lastInoClientesSeaCriteria) || !$this->lastInoClientesSeaCriteria->equals($criteria)) {
				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinTercero($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoClientesSeaCriteria = $criteria;

		return $this->collInoClientesSeas;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Cliente is new, it will return
	 * an empty collection; or if this Cliente has previously
	 * been saved, it will retrieve related InoClientesSeas from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Cliente.
	 */
	public function getInoClientesSeasJoinInoMaestraSea($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesSeas === null) {
			if ($this->isNew()) {
				$this->collInoClientesSeas = array();
			} else {

				$criteria->add(InoClientesSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinInoMaestraSea($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(InoClientesSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

			if (!isset($this->lastInoClientesSeaCriteria) || !$this->lastInoClientesSeaCriteria->equals($criteria)) {
				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinInoMaestraSea($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoClientesSeaCriteria = $criteria;

		return $this->collInoClientesSeas;
	}

	/**
	 * Clears out the collInoIngresosSeas collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addInoIngresosSeas()
	 */
	public function clearInoIngresosSeas()
	{
		$this->collInoIngresosSeas = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collInoIngresosSeas collection (array).
	 *
	 * By default this just sets the collInoIngresosSeas collection to an empty array (like clearcollInoIngresosSeas());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initInoIngresosSeas()
	{
		$this->collInoIngresosSeas = array();
	}

	/**
	 * Gets an array of InoIngresosSea objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Cliente has previously been saved, it will retrieve
	 * related InoIngresosSeas from storage. If this Cliente is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array InoIngresosSea[]
	 * @throws     PropelException
	 */
	public function getInoIngresosSeas($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoIngresosSeas === null) {
			if ($this->isNew()) {
			   $this->collInoIngresosSeas = array();
			} else {

				$criteria->add(InoIngresosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

				InoIngresosSeaPeer::addSelectColumns($criteria);
				$this->collInoIngresosSeas = InoIngresosSeaPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(InoIngresosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

				InoIngresosSeaPeer::addSelectColumns($criteria);
				if (!isset($this->lastInoIngresosSeaCriteria) || !$this->lastInoIngresosSeaCriteria->equals($criteria)) {
					$this->collInoIngresosSeas = InoIngresosSeaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInoIngresosSeaCriteria = $criteria;
		return $this->collInoIngresosSeas;
	}

	/**
	 * Returns the number of related InoIngresosSea objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related InoIngresosSea objects.
	 * @throws     PropelException
	 */
	public function countInoIngresosSeas(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collInoIngresosSeas === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(InoIngresosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

				$count = InoIngresosSeaPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(InoIngresosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

				if (!isset($this->lastInoIngresosSeaCriteria) || !$this->lastInoIngresosSeaCriteria->equals($criteria)) {
					$count = InoIngresosSeaPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collInoIngresosSeas);
				}
			} else {
				$count = count($this->collInoIngresosSeas);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a InoIngresosSea object to this object
	 * through the InoIngresosSea foreign key attribute.
	 *
	 * @param      InoIngresosSea $l InoIngresosSea
	 * @return     void
	 * @throws     PropelException
	 */
	public function addInoIngresosSea(InoIngresosSea $l)
	{
		if ($this->collInoIngresosSeas === null) {
			$this->initInoIngresosSeas();
		}
		if (!in_array($l, $this->collInoIngresosSeas, true)) { // only add it if the **same** object is not already associated
			array_push($this->collInoIngresosSeas, $l);
			$l->setCliente($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Cliente is new, it will return
	 * an empty collection; or if this Cliente has previously
	 * been saved, it will retrieve related InoIngresosSeas from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Cliente.
	 */
	public function getInoIngresosSeasJoinInoMaestraSea($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoIngresosSeas === null) {
			if ($this->isNew()) {
				$this->collInoIngresosSeas = array();
			} else {

				$criteria->add(InoIngresosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

				$this->collInoIngresosSeas = InoIngresosSeaPeer::doSelectJoinInoMaestraSea($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(InoIngresosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

			if (!isset($this->lastInoIngresosSeaCriteria) || !$this->lastInoIngresosSeaCriteria->equals($criteria)) {
				$this->collInoIngresosSeas = InoIngresosSeaPeer::doSelectJoinInoMaestraSea($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoIngresosSeaCriteria = $criteria;

		return $this->collInoIngresosSeas;
	}

	/**
	 * Clears out the collInoAvisosSeas collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addInoAvisosSeas()
	 */
	public function clearInoAvisosSeas()
	{
		$this->collInoAvisosSeas = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collInoAvisosSeas collection (array).
	 *
	 * By default this just sets the collInoAvisosSeas collection to an empty array (like clearcollInoAvisosSeas());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initInoAvisosSeas()
	{
		$this->collInoAvisosSeas = array();
	}

	/**
	 * Gets an array of InoAvisosSea objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Cliente has previously been saved, it will retrieve
	 * related InoAvisosSeas from storage. If this Cliente is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array InoAvisosSea[]
	 * @throws     PropelException
	 */
	public function getInoAvisosSeas($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoAvisosSeas === null) {
			if ($this->isNew()) {
			   $this->collInoAvisosSeas = array();
			} else {

				$criteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

				InoAvisosSeaPeer::addSelectColumns($criteria);
				$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

				InoAvisosSeaPeer::addSelectColumns($criteria);
				if (!isset($this->lastInoAvisosSeaCriteria) || !$this->lastInoAvisosSeaCriteria->equals($criteria)) {
					$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInoAvisosSeaCriteria = $criteria;
		return $this->collInoAvisosSeas;
	}

	/**
	 * Returns the number of related InoAvisosSea objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related InoAvisosSea objects.
	 * @throws     PropelException
	 */
	public function countInoAvisosSeas(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collInoAvisosSeas === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

				$count = InoAvisosSeaPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

				if (!isset($this->lastInoAvisosSeaCriteria) || !$this->lastInoAvisosSeaCriteria->equals($criteria)) {
					$count = InoAvisosSeaPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collInoAvisosSeas);
				}
			} else {
				$count = count($this->collInoAvisosSeas);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a InoAvisosSea object to this object
	 * through the InoAvisosSea foreign key attribute.
	 *
	 * @param      InoAvisosSea $l InoAvisosSea
	 * @return     void
	 * @throws     PropelException
	 */
	public function addInoAvisosSea(InoAvisosSea $l)
	{
		if ($this->collInoAvisosSeas === null) {
			$this->initInoAvisosSeas();
		}
		if (!in_array($l, $this->collInoAvisosSeas, true)) { // only add it if the **same** object is not already associated
			array_push($this->collInoAvisosSeas, $l);
			$l->setCliente($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Cliente is new, it will return
	 * an empty collection; or if this Cliente has previously
	 * been saved, it will retrieve related InoAvisosSeas from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Cliente.
	 */
	public function getInoAvisosSeasJoinInoClientesSea($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoAvisosSeas === null) {
			if ($this->isNew()) {
				$this->collInoAvisosSeas = array();
			} else {

				$criteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

				$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelectJoinInoClientesSea($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

			if (!isset($this->lastInoAvisosSeaCriteria) || !$this->lastInoAvisosSeaCriteria->equals($criteria)) {
				$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelectJoinInoClientesSea($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoAvisosSeaCriteria = $criteria;

		return $this->collInoAvisosSeas;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Cliente is new, it will return
	 * an empty collection; or if this Cliente has previously
	 * been saved, it will retrieve related InoAvisosSeas from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Cliente.
	 */
	public function getInoAvisosSeasJoinInoMaestraSea($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoAvisosSeas === null) {
			if ($this->isNew()) {
				$this->collInoAvisosSeas = array();
			} else {

				$criteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

				$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelectJoinInoMaestraSea($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

			if (!isset($this->lastInoAvisosSeaCriteria) || !$this->lastInoAvisosSeaCriteria->equals($criteria)) {
				$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelectJoinInoMaestraSea($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoAvisosSeaCriteria = $criteria;

		return $this->collInoAvisosSeas;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Cliente is new, it will return
	 * an empty collection; or if this Cliente has previously
	 * been saved, it will retrieve related InoAvisosSeas from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Cliente.
	 */
	public function getInoAvisosSeasJoinEmail($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoAvisosSeas === null) {
			if ($this->isNew()) {
				$this->collInoAvisosSeas = array();
			} else {

				$criteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

				$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelectJoinEmail($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

			if (!isset($this->lastInoAvisosSeaCriteria) || !$this->lastInoAvisosSeaCriteria->equals($criteria)) {
				$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelectJoinEmail($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoAvisosSeaCriteria = $criteria;

		return $this->collInoAvisosSeas;
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
			if ($this->collAduanaMaestras) {
				foreach ((array) $this->collAduanaMaestras as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collInoIngresosAirs) {
				foreach ((array) $this->collInoIngresosAirs as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collContactos) {
				foreach ((array) $this->collContactos as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collClienteStds) {
				foreach ((array) $this->collClienteStds as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collInoClientesSeas) {
				foreach ((array) $this->collInoClientesSeas as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collInoIngresosSeas) {
				foreach ((array) $this->collInoIngresosSeas as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collInoAvisosSeas) {
				foreach ((array) $this->collInoAvisosSeas as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collAduanaMaestras = null;
		$this->collInoIngresosAirs = null;
		$this->collContactos = null;
		$this->collClienteStds = null;
		$this->collInoClientesSeas = null;
		$this->collInoIngresosSeas = null;
		$this->collInoAvisosSeas = null;
			$this->aCiudad = null;
	}

} // BaseCliente
