<?php

/**
 * Base class that represents a row from the 'tb_brk_maestra' table.
 *
 * 
 *
 * @package    lib.model.aduana.om
 */
abstract class BaseAduanaMaestra extends BaseObject  implements Persistent {


  const PEER = 'AduanaMaestraPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        AduanaMaestraPeer
	 */
	protected static $peer;

	/**
	 * The value for the ca_fchreferencia field.
	 * @var        string
	 */
	protected $ca_fchreferencia;

	/**
	 * The value for the ca_referencia field.
	 * @var        string
	 */
	protected $ca_referencia;

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
	 * The value for the ca_idcliente field.
	 * @var        int
	 */
	protected $ca_idcliente;

	/**
	 * The value for the ca_vendedor field.
	 * @var        string
	 */
	protected $ca_vendedor;

	/**
	 * The value for the ca_coordinador field.
	 * @var        string
	 */
	protected $ca_coordinador;

	/**
	 * The value for the ca_proveedor field.
	 * @var        string
	 */
	protected $ca_proveedor;

	/**
	 * The value for the ca_pedido field.
	 * @var        string
	 */
	protected $ca_pedido;

	/**
	 * The value for the ca_piezas field.
	 * @var        int
	 */
	protected $ca_piezas;

	/**
	 * The value for the ca_peso field.
	 * @var        string
	 */
	protected $ca_peso;

	/**
	 * The value for the ca_mercancia field.
	 * @var        string
	 */
	protected $ca_mercancia;

	/**
	 * The value for the ca_deposito field.
	 * @var        string
	 */
	protected $ca_deposito;

	/**
	 * The value for the ca_fcharribo field.
	 * @var        string
	 */
	protected $ca_fcharribo;

	/**
	 * The value for the ca_modalidad field.
	 * @var        int
	 */
	protected $ca_modalidad;

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
	 * The value for the ca_fchliquidado field.
	 * @var        string
	 */
	protected $ca_fchliquidado;

	/**
	 * The value for the ca_usuliquidado field.
	 * @var        string
	 */
	protected $ca_usuliquidado;

	/**
	 * The value for the ca_fchcerrado field.
	 * @var        string
	 */
	protected $ca_fchcerrado;

	/**
	 * The value for the ca_usucerrado field.
	 * @var        string
	 */
	protected $ca_usucerrado;

	/**
	 * The value for the ca_nombrecontacto field.
	 * @var        string
	 */
	protected $ca_nombrecontacto;

	/**
	 * The value for the ca_email field.
	 * @var        string
	 */
	protected $ca_email;

	/**
	 * The value for the ca_analista field.
	 * @var        string
	 */
	protected $ca_analista;

	/**
	 * The value for the ca_trackingcode field.
	 * @var        string
	 */
	protected $ca_trackingcode;

	/**
	 * @var        Cliente
	 */
	protected $aCliente;

	/**
	 * @var        array AduanaEvento[] Collection to store aggregation of AduanaEvento objects.
	 */
	protected $collAduanaEventos;

	/**
	 * @var        Criteria The criteria used to select the current contents of collAduanaEventos.
	 */
	private $lastAduanaEventoCriteria = null;

	/**
	 * @var        array AduanaEventoExtra[] Collection to store aggregation of AduanaEventoExtra objects.
	 */
	protected $collAduanaEventoExtras;

	/**
	 * @var        Criteria The criteria used to select the current contents of collAduanaEventoExtras.
	 */
	private $lastAduanaEventoExtraCriteria = null;

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
	 * Initializes internal state of BaseAduanaMaestra object.
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
	 * Get the [optionally formatted] temporal [ca_fchreferencia] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaFchreferencia($format = 'Y-m-d')
	{
		if ($this->ca_fchreferencia === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchreferencia);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchreferencia, true), $x);
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
	 * Get the [ca_referencia] column value.
	 * 
	 * @return     string
	 */
	public function getCaReferencia()
	{
		return $this->ca_referencia;
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
	 * Get the [ca_idcliente] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdcliente()
	{
		return $this->ca_idcliente;
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
	 * Get the [ca_coordinador] column value.
	 * 
	 * @return     string
	 */
	public function getCaCoordinador()
	{
		return $this->ca_coordinador;
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
	 * Get the [ca_pedido] column value.
	 * 
	 * @return     string
	 */
	public function getCaPedido()
	{
		return $this->ca_pedido;
	}

	/**
	 * Get the [ca_piezas] column value.
	 * 
	 * @return     int
	 */
	public function getCaPiezas()
	{
		return $this->ca_piezas;
	}

	/**
	 * Get the [ca_peso] column value.
	 * 
	 * @return     string
	 */
	public function getCaPeso()
	{
		return $this->ca_peso;
	}

	/**
	 * Get the [ca_mercancia] column value.
	 * 
	 * @return     string
	 */
	public function getCaMercancia()
	{
		return $this->ca_mercancia;
	}

	/**
	 * Get the [ca_deposito] column value.
	 * 
	 * @return     string
	 */
	public function getCaDeposito()
	{
		return $this->ca_deposito;
	}

	/**
	 * Get the [optionally formatted] temporal [ca_fcharribo] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaFcharribo($format = 'Y-m-d')
	{
		if ($this->ca_fcharribo === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fcharribo);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fcharribo, true), $x);
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
	 * Get the [ca_modalidad] column value.
	 * 
	 * @return     int
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
	 * Get the [optionally formatted] temporal [ca_fchliquidado] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaFchliquidado($format = 'Y-m-d')
	{
		if ($this->ca_fchliquidado === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchliquidado);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchliquidado, true), $x);
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
	 * Get the [ca_usuliquidado] column value.
	 * 
	 * @return     string
	 */
	public function getCaUsuliquidado()
	{
		return $this->ca_usuliquidado;
	}

	/**
	 * Get the [optionally formatted] temporal [ca_fchcerrado] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaFchcerrado($format = 'Y-m-d')
	{
		if ($this->ca_fchcerrado === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchcerrado);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchcerrado, true), $x);
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
	 * Get the [ca_usucerrado] column value.
	 * 
	 * @return     string
	 */
	public function getCaUsucerrado()
	{
		return $this->ca_usucerrado;
	}

	/**
	 * Get the [ca_nombrecontacto] column value.
	 * 
	 * @return     string
	 */
	public function getCaNombrecontacto()
	{
		return $this->ca_nombrecontacto;
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
	 * Get the [ca_analista] column value.
	 * 
	 * @return     string
	 */
	public function getCaAnalista()
	{
		return $this->ca_analista;
	}

	/**
	 * Get the [ca_trackingcode] column value.
	 * 
	 * @return     string
	 */
	public function getCaTrackingcode()
	{
		return $this->ca_trackingcode;
	}

	/**
	 * Sets the value of [ca_fchreferencia] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     AduanaMaestra The current object (for fluent API support)
	 */
	public function setCaFchreferencia($v)
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

		if ( $this->ca_fchreferencia !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fchreferencia !== null && $tmpDt = new DateTime($this->ca_fchreferencia)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchreferencia = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = AduanaMaestraPeer::CA_FCHREFERENCIA;
			}
		} // if either are not null

		return $this;
	} // setCaFchreferencia()

	/**
	 * Set the value of [ca_referencia] column.
	 * 
	 * @param      string $v new value
	 * @return     AduanaMaestra The current object (for fluent API support)
	 */
	public function setCaReferencia($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_referencia !== $v) {
			$this->ca_referencia = $v;
			$this->modifiedColumns[] = AduanaMaestraPeer::CA_REFERENCIA;
		}

		return $this;
	} // setCaReferencia()

	/**
	 * Set the value of [ca_origen] column.
	 * 
	 * @param      string $v new value
	 * @return     AduanaMaestra The current object (for fluent API support)
	 */
	public function setCaOrigen($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_origen !== $v) {
			$this->ca_origen = $v;
			$this->modifiedColumns[] = AduanaMaestraPeer::CA_ORIGEN;
		}

		return $this;
	} // setCaOrigen()

	/**
	 * Set the value of [ca_destino] column.
	 * 
	 * @param      string $v new value
	 * @return     AduanaMaestra The current object (for fluent API support)
	 */
	public function setCaDestino($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_destino !== $v) {
			$this->ca_destino = $v;
			$this->modifiedColumns[] = AduanaMaestraPeer::CA_DESTINO;
		}

		return $this;
	} // setCaDestino()

	/**
	 * Set the value of [ca_idcliente] column.
	 * 
	 * @param      int $v new value
	 * @return     AduanaMaestra The current object (for fluent API support)
	 */
	public function setCaIdcliente($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idcliente !== $v) {
			$this->ca_idcliente = $v;
			$this->modifiedColumns[] = AduanaMaestraPeer::CA_IDCLIENTE;
		}

		if ($this->aCliente !== null && $this->aCliente->getCaIdcliente() !== $v) {
			$this->aCliente = null;
		}

		return $this;
	} // setCaIdcliente()

	/**
	 * Set the value of [ca_vendedor] column.
	 * 
	 * @param      string $v new value
	 * @return     AduanaMaestra The current object (for fluent API support)
	 */
	public function setCaVendedor($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_vendedor !== $v) {
			$this->ca_vendedor = $v;
			$this->modifiedColumns[] = AduanaMaestraPeer::CA_VENDEDOR;
		}

		return $this;
	} // setCaVendedor()

	/**
	 * Set the value of [ca_coordinador] column.
	 * 
	 * @param      string $v new value
	 * @return     AduanaMaestra The current object (for fluent API support)
	 */
	public function setCaCoordinador($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_coordinador !== $v) {
			$this->ca_coordinador = $v;
			$this->modifiedColumns[] = AduanaMaestraPeer::CA_COORDINADOR;
		}

		return $this;
	} // setCaCoordinador()

	/**
	 * Set the value of [ca_proveedor] column.
	 * 
	 * @param      string $v new value
	 * @return     AduanaMaestra The current object (for fluent API support)
	 */
	public function setCaProveedor($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_proveedor !== $v) {
			$this->ca_proveedor = $v;
			$this->modifiedColumns[] = AduanaMaestraPeer::CA_PROVEEDOR;
		}

		return $this;
	} // setCaProveedor()

	/**
	 * Set the value of [ca_pedido] column.
	 * 
	 * @param      string $v new value
	 * @return     AduanaMaestra The current object (for fluent API support)
	 */
	public function setCaPedido($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_pedido !== $v) {
			$this->ca_pedido = $v;
			$this->modifiedColumns[] = AduanaMaestraPeer::CA_PEDIDO;
		}

		return $this;
	} // setCaPedido()

	/**
	 * Set the value of [ca_piezas] column.
	 * 
	 * @param      int $v new value
	 * @return     AduanaMaestra The current object (for fluent API support)
	 */
	public function setCaPiezas($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_piezas !== $v) {
			$this->ca_piezas = $v;
			$this->modifiedColumns[] = AduanaMaestraPeer::CA_PIEZAS;
		}

		return $this;
	} // setCaPiezas()

	/**
	 * Set the value of [ca_peso] column.
	 * 
	 * @param      string $v new value
	 * @return     AduanaMaestra The current object (for fluent API support)
	 */
	public function setCaPeso($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_peso !== $v) {
			$this->ca_peso = $v;
			$this->modifiedColumns[] = AduanaMaestraPeer::CA_PESO;
		}

		return $this;
	} // setCaPeso()

	/**
	 * Set the value of [ca_mercancia] column.
	 * 
	 * @param      string $v new value
	 * @return     AduanaMaestra The current object (for fluent API support)
	 */
	public function setCaMercancia($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_mercancia !== $v) {
			$this->ca_mercancia = $v;
			$this->modifiedColumns[] = AduanaMaestraPeer::CA_MERCANCIA;
		}

		return $this;
	} // setCaMercancia()

	/**
	 * Set the value of [ca_deposito] column.
	 * 
	 * @param      string $v new value
	 * @return     AduanaMaestra The current object (for fluent API support)
	 */
	public function setCaDeposito($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_deposito !== $v) {
			$this->ca_deposito = $v;
			$this->modifiedColumns[] = AduanaMaestraPeer::CA_DEPOSITO;
		}

		return $this;
	} // setCaDeposito()

	/**
	 * Sets the value of [ca_fcharribo] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     AduanaMaestra The current object (for fluent API support)
	 */
	public function setCaFcharribo($v)
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

		if ( $this->ca_fcharribo !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fcharribo !== null && $tmpDt = new DateTime($this->ca_fcharribo)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fcharribo = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = AduanaMaestraPeer::CA_FCHARRIBO;
			}
		} // if either are not null

		return $this;
	} // setCaFcharribo()

	/**
	 * Set the value of [ca_modalidad] column.
	 * 
	 * @param      int $v new value
	 * @return     AduanaMaestra The current object (for fluent API support)
	 */
	public function setCaModalidad($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_modalidad !== $v) {
			$this->ca_modalidad = $v;
			$this->modifiedColumns[] = AduanaMaestraPeer::CA_MODALIDAD;
		}

		return $this;
	} // setCaModalidad()

	/**
	 * Sets the value of [ca_fchcreado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     AduanaMaestra The current object (for fluent API support)
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
				$this->modifiedColumns[] = AduanaMaestraPeer::CA_FCHCREADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchcreado()

	/**
	 * Set the value of [ca_usucreado] column.
	 * 
	 * @param      string $v new value
	 * @return     AduanaMaestra The current object (for fluent API support)
	 */
	public function setCaUsucreado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usucreado !== $v) {
			$this->ca_usucreado = $v;
			$this->modifiedColumns[] = AduanaMaestraPeer::CA_USUCREADO;
		}

		return $this;
	} // setCaUsucreado()

	/**
	 * Sets the value of [ca_fchactualizado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     AduanaMaestra The current object (for fluent API support)
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
				$this->modifiedColumns[] = AduanaMaestraPeer::CA_FCHACTUALIZADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchactualizado()

	/**
	 * Set the value of [ca_usuactualizado] column.
	 * 
	 * @param      string $v new value
	 * @return     AduanaMaestra The current object (for fluent API support)
	 */
	public function setCaUsuactualizado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usuactualizado !== $v) {
			$this->ca_usuactualizado = $v;
			$this->modifiedColumns[] = AduanaMaestraPeer::CA_USUACTUALIZADO;
		}

		return $this;
	} // setCaUsuactualizado()

	/**
	 * Sets the value of [ca_fchliquidado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     AduanaMaestra The current object (for fluent API support)
	 */
	public function setCaFchliquidado($v)
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

		if ( $this->ca_fchliquidado !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fchliquidado !== null && $tmpDt = new DateTime($this->ca_fchliquidado)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchliquidado = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = AduanaMaestraPeer::CA_FCHLIQUIDADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchliquidado()

	/**
	 * Set the value of [ca_usuliquidado] column.
	 * 
	 * @param      string $v new value
	 * @return     AduanaMaestra The current object (for fluent API support)
	 */
	public function setCaUsuliquidado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usuliquidado !== $v) {
			$this->ca_usuliquidado = $v;
			$this->modifiedColumns[] = AduanaMaestraPeer::CA_USULIQUIDADO;
		}

		return $this;
	} // setCaUsuliquidado()

	/**
	 * Sets the value of [ca_fchcerrado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     AduanaMaestra The current object (for fluent API support)
	 */
	public function setCaFchcerrado($v)
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

		if ( $this->ca_fchcerrado !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fchcerrado !== null && $tmpDt = new DateTime($this->ca_fchcerrado)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchcerrado = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = AduanaMaestraPeer::CA_FCHCERRADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchcerrado()

	/**
	 * Set the value of [ca_usucerrado] column.
	 * 
	 * @param      string $v new value
	 * @return     AduanaMaestra The current object (for fluent API support)
	 */
	public function setCaUsucerrado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usucerrado !== $v) {
			$this->ca_usucerrado = $v;
			$this->modifiedColumns[] = AduanaMaestraPeer::CA_USUCERRADO;
		}

		return $this;
	} // setCaUsucerrado()

	/**
	 * Set the value of [ca_nombrecontacto] column.
	 * 
	 * @param      string $v new value
	 * @return     AduanaMaestra The current object (for fluent API support)
	 */
	public function setCaNombrecontacto($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_nombrecontacto !== $v) {
			$this->ca_nombrecontacto = $v;
			$this->modifiedColumns[] = AduanaMaestraPeer::CA_NOMBRECONTACTO;
		}

		return $this;
	} // setCaNombrecontacto()

	/**
	 * Set the value of [ca_email] column.
	 * 
	 * @param      string $v new value
	 * @return     AduanaMaestra The current object (for fluent API support)
	 */
	public function setCaEmail($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_email !== $v) {
			$this->ca_email = $v;
			$this->modifiedColumns[] = AduanaMaestraPeer::CA_EMAIL;
		}

		return $this;
	} // setCaEmail()

	/**
	 * Set the value of [ca_analista] column.
	 * 
	 * @param      string $v new value
	 * @return     AduanaMaestra The current object (for fluent API support)
	 */
	public function setCaAnalista($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_analista !== $v) {
			$this->ca_analista = $v;
			$this->modifiedColumns[] = AduanaMaestraPeer::CA_ANALISTA;
		}

		return $this;
	} // setCaAnalista()

	/**
	 * Set the value of [ca_trackingcode] column.
	 * 
	 * @param      string $v new value
	 * @return     AduanaMaestra The current object (for fluent API support)
	 */
	public function setCaTrackingcode($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_trackingcode !== $v) {
			$this->ca_trackingcode = $v;
			$this->modifiedColumns[] = AduanaMaestraPeer::CA_TRACKINGCODE;
		}

		return $this;
	} // setCaTrackingcode()

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

			$this->ca_fchreferencia = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ca_referencia = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_origen = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_destino = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_idcliente = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->ca_vendedor = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_coordinador = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_proveedor = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_pedido = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_piezas = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
			$this->ca_peso = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_mercancia = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_deposito = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_fcharribo = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->ca_modalidad = ($row[$startcol + 14] !== null) ? (int) $row[$startcol + 14] : null;
			$this->ca_fchcreado = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->ca_usucreado = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
			$this->ca_fchactualizado = ($row[$startcol + 17] !== null) ? (string) $row[$startcol + 17] : null;
			$this->ca_usuactualizado = ($row[$startcol + 18] !== null) ? (string) $row[$startcol + 18] : null;
			$this->ca_fchliquidado = ($row[$startcol + 19] !== null) ? (string) $row[$startcol + 19] : null;
			$this->ca_usuliquidado = ($row[$startcol + 20] !== null) ? (string) $row[$startcol + 20] : null;
			$this->ca_fchcerrado = ($row[$startcol + 21] !== null) ? (string) $row[$startcol + 21] : null;
			$this->ca_usucerrado = ($row[$startcol + 22] !== null) ? (string) $row[$startcol + 22] : null;
			$this->ca_nombrecontacto = ($row[$startcol + 23] !== null) ? (string) $row[$startcol + 23] : null;
			$this->ca_email = ($row[$startcol + 24] !== null) ? (string) $row[$startcol + 24] : null;
			$this->ca_analista = ($row[$startcol + 25] !== null) ? (string) $row[$startcol + 25] : null;
			$this->ca_trackingcode = ($row[$startcol + 26] !== null) ? (string) $row[$startcol + 26] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 27; // 27 = AduanaMaestraPeer::NUM_COLUMNS - AduanaMaestraPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating AduanaMaestra object", $e);
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

		if ($this->aCliente !== null && $this->ca_idcliente !== $this->aCliente->getCaIdcliente()) {
			$this->aCliente = null;
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
			$con = Propel::getConnection(AduanaMaestraPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = AduanaMaestraPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aCliente = null;
			$this->collAduanaEventos = null;
			$this->lastAduanaEventoCriteria = null;

			$this->collAduanaEventoExtras = null;
			$this->lastAduanaEventoExtraCriteria = null;

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
			$con = Propel::getConnection(AduanaMaestraPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			AduanaMaestraPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(AduanaMaestraPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			AduanaMaestraPeer::addInstanceToPool($this);
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

			if ($this->aCliente !== null) {
				if ($this->aCliente->isModified() || $this->aCliente->isNew()) {
					$affectedRows += $this->aCliente->save($con);
				}
				$this->setCliente($this->aCliente);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = AduanaMaestraPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += AduanaMaestraPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collAduanaEventos !== null) {
				foreach ($this->collAduanaEventos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collAduanaEventoExtras !== null) {
				foreach ($this->collAduanaEventoExtras as $referrerFK) {
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


			if (($retval = AduanaMaestraPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collAduanaEventos !== null) {
					foreach ($this->collAduanaEventos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collAduanaEventoExtras !== null) {
					foreach ($this->collAduanaEventoExtras as $referrerFK) {
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
		$pos = AduanaMaestraPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaFchreferencia();
				break;
			case 1:
				return $this->getCaReferencia();
				break;
			case 2:
				return $this->getCaOrigen();
				break;
			case 3:
				return $this->getCaDestino();
				break;
			case 4:
				return $this->getCaIdcliente();
				break;
			case 5:
				return $this->getCaVendedor();
				break;
			case 6:
				return $this->getCaCoordinador();
				break;
			case 7:
				return $this->getCaProveedor();
				break;
			case 8:
				return $this->getCaPedido();
				break;
			case 9:
				return $this->getCaPiezas();
				break;
			case 10:
				return $this->getCaPeso();
				break;
			case 11:
				return $this->getCaMercancia();
				break;
			case 12:
				return $this->getCaDeposito();
				break;
			case 13:
				return $this->getCaFcharribo();
				break;
			case 14:
				return $this->getCaModalidad();
				break;
			case 15:
				return $this->getCaFchcreado();
				break;
			case 16:
				return $this->getCaUsucreado();
				break;
			case 17:
				return $this->getCaFchactualizado();
				break;
			case 18:
				return $this->getCaUsuactualizado();
				break;
			case 19:
				return $this->getCaFchliquidado();
				break;
			case 20:
				return $this->getCaUsuliquidado();
				break;
			case 21:
				return $this->getCaFchcerrado();
				break;
			case 22:
				return $this->getCaUsucerrado();
				break;
			case 23:
				return $this->getCaNombrecontacto();
				break;
			case 24:
				return $this->getCaEmail();
				break;
			case 25:
				return $this->getCaAnalista();
				break;
			case 26:
				return $this->getCaTrackingcode();
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
		$keys = AduanaMaestraPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaFchreferencia(),
			$keys[1] => $this->getCaReferencia(),
			$keys[2] => $this->getCaOrigen(),
			$keys[3] => $this->getCaDestino(),
			$keys[4] => $this->getCaIdcliente(),
			$keys[5] => $this->getCaVendedor(),
			$keys[6] => $this->getCaCoordinador(),
			$keys[7] => $this->getCaProveedor(),
			$keys[8] => $this->getCaPedido(),
			$keys[9] => $this->getCaPiezas(),
			$keys[10] => $this->getCaPeso(),
			$keys[11] => $this->getCaMercancia(),
			$keys[12] => $this->getCaDeposito(),
			$keys[13] => $this->getCaFcharribo(),
			$keys[14] => $this->getCaModalidad(),
			$keys[15] => $this->getCaFchcreado(),
			$keys[16] => $this->getCaUsucreado(),
			$keys[17] => $this->getCaFchactualizado(),
			$keys[18] => $this->getCaUsuactualizado(),
			$keys[19] => $this->getCaFchliquidado(),
			$keys[20] => $this->getCaUsuliquidado(),
			$keys[21] => $this->getCaFchcerrado(),
			$keys[22] => $this->getCaUsucerrado(),
			$keys[23] => $this->getCaNombrecontacto(),
			$keys[24] => $this->getCaEmail(),
			$keys[25] => $this->getCaAnalista(),
			$keys[26] => $this->getCaTrackingcode(),
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
		$pos = AduanaMaestraPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaFchreferencia($value);
				break;
			case 1:
				$this->setCaReferencia($value);
				break;
			case 2:
				$this->setCaOrigen($value);
				break;
			case 3:
				$this->setCaDestino($value);
				break;
			case 4:
				$this->setCaIdcliente($value);
				break;
			case 5:
				$this->setCaVendedor($value);
				break;
			case 6:
				$this->setCaCoordinador($value);
				break;
			case 7:
				$this->setCaProveedor($value);
				break;
			case 8:
				$this->setCaPedido($value);
				break;
			case 9:
				$this->setCaPiezas($value);
				break;
			case 10:
				$this->setCaPeso($value);
				break;
			case 11:
				$this->setCaMercancia($value);
				break;
			case 12:
				$this->setCaDeposito($value);
				break;
			case 13:
				$this->setCaFcharribo($value);
				break;
			case 14:
				$this->setCaModalidad($value);
				break;
			case 15:
				$this->setCaFchcreado($value);
				break;
			case 16:
				$this->setCaUsucreado($value);
				break;
			case 17:
				$this->setCaFchactualizado($value);
				break;
			case 18:
				$this->setCaUsuactualizado($value);
				break;
			case 19:
				$this->setCaFchliquidado($value);
				break;
			case 20:
				$this->setCaUsuliquidado($value);
				break;
			case 21:
				$this->setCaFchcerrado($value);
				break;
			case 22:
				$this->setCaUsucerrado($value);
				break;
			case 23:
				$this->setCaNombrecontacto($value);
				break;
			case 24:
				$this->setCaEmail($value);
				break;
			case 25:
				$this->setCaAnalista($value);
				break;
			case 26:
				$this->setCaTrackingcode($value);
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
		$keys = AduanaMaestraPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaFchreferencia($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaReferencia($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaOrigen($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaDestino($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaIdcliente($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaVendedor($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaCoordinador($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaProveedor($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaPedido($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaPiezas($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaPeso($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaMercancia($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaDeposito($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaFcharribo($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaModalidad($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaFchcreado($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCaUsucreado($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setCaFchactualizado($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setCaUsuactualizado($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setCaFchliquidado($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setCaUsuliquidado($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setCaFchcerrado($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setCaUsucerrado($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setCaNombrecontacto($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setCaEmail($arr[$keys[24]]);
		if (array_key_exists($keys[25], $arr)) $this->setCaAnalista($arr[$keys[25]]);
		if (array_key_exists($keys[26], $arr)) $this->setCaTrackingcode($arr[$keys[26]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(AduanaMaestraPeer::DATABASE_NAME);

		if ($this->isColumnModified(AduanaMaestraPeer::CA_FCHREFERENCIA)) $criteria->add(AduanaMaestraPeer::CA_FCHREFERENCIA, $this->ca_fchreferencia);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_REFERENCIA)) $criteria->add(AduanaMaestraPeer::CA_REFERENCIA, $this->ca_referencia);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_ORIGEN)) $criteria->add(AduanaMaestraPeer::CA_ORIGEN, $this->ca_origen);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_DESTINO)) $criteria->add(AduanaMaestraPeer::CA_DESTINO, $this->ca_destino);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_IDCLIENTE)) $criteria->add(AduanaMaestraPeer::CA_IDCLIENTE, $this->ca_idcliente);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_VENDEDOR)) $criteria->add(AduanaMaestraPeer::CA_VENDEDOR, $this->ca_vendedor);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_COORDINADOR)) $criteria->add(AduanaMaestraPeer::CA_COORDINADOR, $this->ca_coordinador);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_PROVEEDOR)) $criteria->add(AduanaMaestraPeer::CA_PROVEEDOR, $this->ca_proveedor);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_PEDIDO)) $criteria->add(AduanaMaestraPeer::CA_PEDIDO, $this->ca_pedido);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_PIEZAS)) $criteria->add(AduanaMaestraPeer::CA_PIEZAS, $this->ca_piezas);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_PESO)) $criteria->add(AduanaMaestraPeer::CA_PESO, $this->ca_peso);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_MERCANCIA)) $criteria->add(AduanaMaestraPeer::CA_MERCANCIA, $this->ca_mercancia);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_DEPOSITO)) $criteria->add(AduanaMaestraPeer::CA_DEPOSITO, $this->ca_deposito);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_FCHARRIBO)) $criteria->add(AduanaMaestraPeer::CA_FCHARRIBO, $this->ca_fcharribo);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_MODALIDAD)) $criteria->add(AduanaMaestraPeer::CA_MODALIDAD, $this->ca_modalidad);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_FCHCREADO)) $criteria->add(AduanaMaestraPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_USUCREADO)) $criteria->add(AduanaMaestraPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_FCHACTUALIZADO)) $criteria->add(AduanaMaestraPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_USUACTUALIZADO)) $criteria->add(AduanaMaestraPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_FCHLIQUIDADO)) $criteria->add(AduanaMaestraPeer::CA_FCHLIQUIDADO, $this->ca_fchliquidado);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_USULIQUIDADO)) $criteria->add(AduanaMaestraPeer::CA_USULIQUIDADO, $this->ca_usuliquidado);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_FCHCERRADO)) $criteria->add(AduanaMaestraPeer::CA_FCHCERRADO, $this->ca_fchcerrado);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_USUCERRADO)) $criteria->add(AduanaMaestraPeer::CA_USUCERRADO, $this->ca_usucerrado);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_NOMBRECONTACTO)) $criteria->add(AduanaMaestraPeer::CA_NOMBRECONTACTO, $this->ca_nombrecontacto);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_EMAIL)) $criteria->add(AduanaMaestraPeer::CA_EMAIL, $this->ca_email);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_ANALISTA)) $criteria->add(AduanaMaestraPeer::CA_ANALISTA, $this->ca_analista);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_TRACKINGCODE)) $criteria->add(AduanaMaestraPeer::CA_TRACKINGCODE, $this->ca_trackingcode);

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
		$criteria = new Criteria(AduanaMaestraPeer::DATABASE_NAME);

		$criteria->add(AduanaMaestraPeer::CA_REFERENCIA, $this->ca_referencia);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     string
	 */
	public function getPrimaryKey()
	{
		return $this->getCaReferencia();
	}

	/**
	 * Generic method to set the primary key (ca_referencia column).
	 *
	 * @param      string $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaReferencia($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of AduanaMaestra (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaFchreferencia($this->ca_fchreferencia);

		$copyObj->setCaReferencia($this->ca_referencia);

		$copyObj->setCaOrigen($this->ca_origen);

		$copyObj->setCaDestino($this->ca_destino);

		$copyObj->setCaIdcliente($this->ca_idcliente);

		$copyObj->setCaVendedor($this->ca_vendedor);

		$copyObj->setCaCoordinador($this->ca_coordinador);

		$copyObj->setCaProveedor($this->ca_proveedor);

		$copyObj->setCaPedido($this->ca_pedido);

		$copyObj->setCaPiezas($this->ca_piezas);

		$copyObj->setCaPeso($this->ca_peso);

		$copyObj->setCaMercancia($this->ca_mercancia);

		$copyObj->setCaDeposito($this->ca_deposito);

		$copyObj->setCaFcharribo($this->ca_fcharribo);

		$copyObj->setCaModalidad($this->ca_modalidad);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);

		$copyObj->setCaFchliquidado($this->ca_fchliquidado);

		$copyObj->setCaUsuliquidado($this->ca_usuliquidado);

		$copyObj->setCaFchcerrado($this->ca_fchcerrado);

		$copyObj->setCaUsucerrado($this->ca_usucerrado);

		$copyObj->setCaNombrecontacto($this->ca_nombrecontacto);

		$copyObj->setCaEmail($this->ca_email);

		$copyObj->setCaAnalista($this->ca_analista);

		$copyObj->setCaTrackingcode($this->ca_trackingcode);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getAduanaEventos() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addAduanaEvento($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getAduanaEventoExtras() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addAduanaEventoExtra($relObj->copy($deepCopy));
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
	 * @return     AduanaMaestra Clone of current object.
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
	 * @return     AduanaMaestraPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new AduanaMaestraPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Cliente object.
	 *
	 * @param      Cliente $v
	 * @return     AduanaMaestra The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setCliente(Cliente $v = null)
	{
		if ($v === null) {
			$this->setCaIdcliente(NULL);
		} else {
			$this->setCaIdcliente($v->getCaIdcliente());
		}

		$this->aCliente = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Cliente object, it will not be re-added.
		if ($v !== null) {
			$v->addAduanaMaestra($this);
		}

		return $this;
	}


	/**
	 * Get the associated Cliente object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Cliente The associated Cliente object.
	 * @throws     PropelException
	 */
	public function getCliente(PropelPDO $con = null)
	{
		if ($this->aCliente === null && ($this->ca_idcliente !== null)) {
			$c = new Criteria(ClientePeer::DATABASE_NAME);
			$c->add(ClientePeer::CA_IDCLIENTE, $this->ca_idcliente);
			$this->aCliente = ClientePeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aCliente->addAduanaMaestras($this);
			 */
		}
		return $this->aCliente;
	}

	/**
	 * Clears out the collAduanaEventos collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addAduanaEventos()
	 */
	public function clearAduanaEventos()
	{
		$this->collAduanaEventos = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collAduanaEventos collection (array).
	 *
	 * By default this just sets the collAduanaEventos collection to an empty array (like clearcollAduanaEventos());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initAduanaEventos()
	{
		$this->collAduanaEventos = array();
	}

	/**
	 * Gets an array of AduanaEvento objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this AduanaMaestra has previously been saved, it will retrieve
	 * related AduanaEventos from storage. If this AduanaMaestra is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array AduanaEvento[]
	 * @throws     PropelException
	 */
	public function getAduanaEventos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AduanaMaestraPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAduanaEventos === null) {
			if ($this->isNew()) {
			   $this->collAduanaEventos = array();
			} else {

				$criteria->add(AduanaEventoPeer::CA_REFERENCIA, $this->ca_referencia);

				AduanaEventoPeer::addSelectColumns($criteria);
				$this->collAduanaEventos = AduanaEventoPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(AduanaEventoPeer::CA_REFERENCIA, $this->ca_referencia);

				AduanaEventoPeer::addSelectColumns($criteria);
				if (!isset($this->lastAduanaEventoCriteria) || !$this->lastAduanaEventoCriteria->equals($criteria)) {
					$this->collAduanaEventos = AduanaEventoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAduanaEventoCriteria = $criteria;
		return $this->collAduanaEventos;
	}

	/**
	 * Returns the number of related AduanaEvento objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related AduanaEvento objects.
	 * @throws     PropelException
	 */
	public function countAduanaEventos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AduanaMaestraPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collAduanaEventos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(AduanaEventoPeer::CA_REFERENCIA, $this->ca_referencia);

				$count = AduanaEventoPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(AduanaEventoPeer::CA_REFERENCIA, $this->ca_referencia);

				if (!isset($this->lastAduanaEventoCriteria) || !$this->lastAduanaEventoCriteria->equals($criteria)) {
					$count = AduanaEventoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collAduanaEventos);
				}
			} else {
				$count = count($this->collAduanaEventos);
			}
		}
		$this->lastAduanaEventoCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a AduanaEvento object to this object
	 * through the AduanaEvento foreign key attribute.
	 *
	 * @param      AduanaEvento $l AduanaEvento
	 * @return     void
	 * @throws     PropelException
	 */
	public function addAduanaEvento(AduanaEvento $l)
	{
		if ($this->collAduanaEventos === null) {
			$this->initAduanaEventos();
		}
		if (!in_array($l, $this->collAduanaEventos, true)) { // only add it if the **same** object is not already associated
			array_push($this->collAduanaEventos, $l);
			$l->setAduanaMaestra($this);
		}
	}

	/**
	 * Clears out the collAduanaEventoExtras collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addAduanaEventoExtras()
	 */
	public function clearAduanaEventoExtras()
	{
		$this->collAduanaEventoExtras = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collAduanaEventoExtras collection (array).
	 *
	 * By default this just sets the collAduanaEventoExtras collection to an empty array (like clearcollAduanaEventoExtras());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initAduanaEventoExtras()
	{
		$this->collAduanaEventoExtras = array();
	}

	/**
	 * Gets an array of AduanaEventoExtra objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this AduanaMaestra has previously been saved, it will retrieve
	 * related AduanaEventoExtras from storage. If this AduanaMaestra is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array AduanaEventoExtra[]
	 * @throws     PropelException
	 */
	public function getAduanaEventoExtras($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AduanaMaestraPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAduanaEventoExtras === null) {
			if ($this->isNew()) {
			   $this->collAduanaEventoExtras = array();
			} else {

				$criteria->add(AduanaEventoExtraPeer::CA_REFERENCIA, $this->ca_referencia);

				AduanaEventoExtraPeer::addSelectColumns($criteria);
				$this->collAduanaEventoExtras = AduanaEventoExtraPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(AduanaEventoExtraPeer::CA_REFERENCIA, $this->ca_referencia);

				AduanaEventoExtraPeer::addSelectColumns($criteria);
				if (!isset($this->lastAduanaEventoExtraCriteria) || !$this->lastAduanaEventoExtraCriteria->equals($criteria)) {
					$this->collAduanaEventoExtras = AduanaEventoExtraPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAduanaEventoExtraCriteria = $criteria;
		return $this->collAduanaEventoExtras;
	}

	/**
	 * Returns the number of related AduanaEventoExtra objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related AduanaEventoExtra objects.
	 * @throws     PropelException
	 */
	public function countAduanaEventoExtras(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AduanaMaestraPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collAduanaEventoExtras === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(AduanaEventoExtraPeer::CA_REFERENCIA, $this->ca_referencia);

				$count = AduanaEventoExtraPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(AduanaEventoExtraPeer::CA_REFERENCIA, $this->ca_referencia);

				if (!isset($this->lastAduanaEventoExtraCriteria) || !$this->lastAduanaEventoExtraCriteria->equals($criteria)) {
					$count = AduanaEventoExtraPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collAduanaEventoExtras);
				}
			} else {
				$count = count($this->collAduanaEventoExtras);
			}
		}
		$this->lastAduanaEventoExtraCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a AduanaEventoExtra object to this object
	 * through the AduanaEventoExtra foreign key attribute.
	 *
	 * @param      AduanaEventoExtra $l AduanaEventoExtra
	 * @return     void
	 * @throws     PropelException
	 */
	public function addAduanaEventoExtra(AduanaEventoExtra $l)
	{
		if ($this->collAduanaEventoExtras === null) {
			$this->initAduanaEventoExtras();
		}
		if (!in_array($l, $this->collAduanaEventoExtras, true)) { // only add it if the **same** object is not already associated
			array_push($this->collAduanaEventoExtras, $l);
			$l->setAduanaMaestra($this);
		}
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
			if ($this->collAduanaEventos) {
				foreach ((array) $this->collAduanaEventos as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collAduanaEventoExtras) {
				foreach ((array) $this->collAduanaEventoExtras as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collAduanaEventos = null;
		$this->collAduanaEventoExtras = null;
			$this->aCliente = null;
	}

} // BaseAduanaMaestra
