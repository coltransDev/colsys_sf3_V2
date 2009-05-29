<?php

/**
 * Base class that represents a row from the 'tb_cotizaciones' table.
 *
 * 
 *
 * @package    lib.model.cotizaciones.om
 */
abstract class BaseCotizacion extends BaseObject  implements Persistent {


  const PEER = 'CotizacionPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        CotizacionPeer
	 */
	protected static $peer;

	/**
	 * The value for the ca_idcotizacion field.
	 * @var        int
	 */
	protected $ca_idcotizacion;

	/**
	 * The value for the ca_idcontacto field.
	 * @var        int
	 */
	protected $ca_idcontacto;

	/**
	 * The value for the ca_consecutivo field.
	 * @var        string
	 */
	protected $ca_consecutivo;

	/**
	 * The value for the ca_asunto field.
	 * @var        string
	 */
	protected $ca_asunto;

	/**
	 * The value for the ca_saludo field.
	 * @var        string
	 */
	protected $ca_saludo;

	/**
	 * The value for the ca_entrada field.
	 * @var        string
	 */
	protected $ca_entrada;

	/**
	 * The value for the ca_despedida field.
	 * @var        string
	 */
	protected $ca_despedida;

	/**
	 * The value for the ca_usuario field.
	 * @var        string
	 */
	protected $ca_usuario;

	/**
	 * The value for the ca_anexos field.
	 * @var        string
	 */
	protected $ca_anexos;

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
	 * The value for the ca_fchsolicitud field.
	 * @var        string
	 */
	protected $ca_fchsolicitud;

	/**
	 * The value for the ca_horasolicitud field.
	 * @var        string
	 */
	protected $ca_horasolicitud;

	/**
	 * The value for the ca_fchpresentacion field.
	 * @var        string
	 */
	protected $ca_fchpresentacion;

	/**
	 * The value for the ca_fchanulado field.
	 * @var        string
	 */
	protected $ca_fchanulado;

	/**
	 * The value for the ca_usuanulado field.
	 * @var        string
	 */
	protected $ca_usuanulado;

	/**
	 * The value for the ca_empresa field.
	 * @var        string
	 */
	protected $ca_empresa;

	/**
	 * The value for the ca_datosag field.
	 * @var        string
	 */
	protected $ca_datosag;

	/**
	 * The value for the ca_fuente field.
	 * @var        string
	 */
	protected $ca_fuente;

	/**
	 * The value for the ca_idg_envio_oportuno field.
	 * @var        int
	 */
	protected $ca_idg_envio_oportuno;

	/**
	 * @var        Contacto
	 */
	protected $aContacto;

	/**
	 * @var        NotTarea
	 */
	protected $aNotTarea;

	/**
	 * @var        Usuario
	 */
	protected $aUsuario;

	/**
	 * @var        array CotProducto[] Collection to store aggregation of CotProducto objects.
	 */
	protected $collCotProductos;

	/**
	 * @var        Criteria The criteria used to select the current contents of collCotProductos.
	 */
	private $lastCotProductoCriteria = null;

	/**
	 * @var        array CotContinuacion[] Collection to store aggregation of CotContinuacion objects.
	 */
	protected $collCotContinuacions;

	/**
	 * @var        Criteria The criteria used to select the current contents of collCotContinuacions.
	 */
	private $lastCotContinuacionCriteria = null;

	/**
	 * @var        array CotSeguro[] Collection to store aggregation of CotSeguro objects.
	 */
	protected $collCotSeguros;

	/**
	 * @var        Criteria The criteria used to select the current contents of collCotSeguros.
	 */
	private $lastCotSeguroCriteria = null;

	/**
	 * @var        array CotArchivo[] Collection to store aggregation of CotArchivo objects.
	 */
	protected $collCotArchivos;

	/**
	 * @var        Criteria The criteria used to select the current contents of collCotArchivos.
	 */
	private $lastCotArchivoCriteria = null;

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
	 * Initializes internal state of BaseCotizacion object.
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
	 * Get the [ca_idcotizacion] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdcotizacion()
	{
		return $this->ca_idcotizacion;
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
	 * Get the [ca_consecutivo] column value.
	 * 
	 * @return     string
	 */
	public function getCaConsecutivo()
	{
		return $this->ca_consecutivo;
	}

	/**
	 * Get the [ca_asunto] column value.
	 * 
	 * @return     string
	 */
	public function getCaAsunto()
	{
		return $this->ca_asunto;
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
	 * Get the [ca_entrada] column value.
	 * 
	 * @return     string
	 */
	public function getCaEntrada()
	{
		return $this->ca_entrada;
	}

	/**
	 * Get the [ca_despedida] column value.
	 * 
	 * @return     string
	 */
	public function getCaDespedida()
	{
		return $this->ca_despedida;
	}

	/**
	 * Get the [ca_usuario] column value.
	 * 
	 * @return     string
	 */
	public function getCaUsuario()
	{
		return $this->ca_usuario;
	}

	/**
	 * Get the [ca_anexos] column value.
	 * 
	 * @return     string
	 */
	public function getCaAnexos()
	{
		return $this->ca_anexos;
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
	 * Get the [optionally formatted] temporal [ca_fchsolicitud] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaFchsolicitud($format = 'Y-m-d')
	{
		if ($this->ca_fchsolicitud === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchsolicitud);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchsolicitud, true), $x);
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
	 * Get the [optionally formatted] temporal [ca_horasolicitud] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaHorasolicitud($format = 'H:i:s')
	{
		if ($this->ca_horasolicitud === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_horasolicitud);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_horasolicitud, true), $x);
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
	 * Get the [optionally formatted] temporal [ca_fchpresentacion] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaFchpresentacion($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fchpresentacion === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchpresentacion);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchpresentacion, true), $x);
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
	 * Get the [optionally formatted] temporal [ca_fchanulado] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaFchanulado($format = 'Y-m-d')
	{
		if ($this->ca_fchanulado === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchanulado);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchanulado, true), $x);
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
	 * Get the [ca_usuanulado] column value.
	 * 
	 * @return     string
	 */
	public function getCaUsuanulado()
	{
		return $this->ca_usuanulado;
	}

	/**
	 * Get the [ca_empresa] column value.
	 * 
	 * @return     string
	 */
	public function getCaEmpresa()
	{
		return $this->ca_empresa;
	}

	/**
	 * Get the [ca_datosag] column value.
	 * 
	 * @return     string
	 */
	public function getCaDatosag()
	{
		return $this->ca_datosag;
	}

	/**
	 * Get the [ca_fuente] column value.
	 * 
	 * @return     string
	 */
	public function getCaFuente()
	{
		return $this->ca_fuente;
	}

	/**
	 * Get the [ca_idg_envio_oportuno] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdgEnvioOportuno()
	{
		return $this->ca_idg_envio_oportuno;
	}

	/**
	 * Set the value of [ca_idcotizacion] column.
	 * 
	 * @param      int $v new value
	 * @return     Cotizacion The current object (for fluent API support)
	 */
	public function setCaIdcotizacion($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idcotizacion !== $v) {
			$this->ca_idcotizacion = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_IDCOTIZACION;
		}

		return $this;
	} // setCaIdcotizacion()

	/**
	 * Set the value of [ca_idcontacto] column.
	 * 
	 * @param      int $v new value
	 * @return     Cotizacion The current object (for fluent API support)
	 */
	public function setCaIdcontacto($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idcontacto !== $v) {
			$this->ca_idcontacto = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_IDCONTACTO;
		}

		if ($this->aContacto !== null && $this->aContacto->getCaIdcontacto() !== $v) {
			$this->aContacto = null;
		}

		return $this;
	} // setCaIdcontacto()

	/**
	 * Set the value of [ca_consecutivo] column.
	 * 
	 * @param      string $v new value
	 * @return     Cotizacion The current object (for fluent API support)
	 */
	public function setCaConsecutivo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_consecutivo !== $v) {
			$this->ca_consecutivo = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_CONSECUTIVO;
		}

		return $this;
	} // setCaConsecutivo()

	/**
	 * Set the value of [ca_asunto] column.
	 * 
	 * @param      string $v new value
	 * @return     Cotizacion The current object (for fluent API support)
	 */
	public function setCaAsunto($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_asunto !== $v) {
			$this->ca_asunto = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_ASUNTO;
		}

		return $this;
	} // setCaAsunto()

	/**
	 * Set the value of [ca_saludo] column.
	 * 
	 * @param      string $v new value
	 * @return     Cotizacion The current object (for fluent API support)
	 */
	public function setCaSaludo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_saludo !== $v) {
			$this->ca_saludo = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_SALUDO;
		}

		return $this;
	} // setCaSaludo()

	/**
	 * Set the value of [ca_entrada] column.
	 * 
	 * @param      string $v new value
	 * @return     Cotizacion The current object (for fluent API support)
	 */
	public function setCaEntrada($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_entrada !== $v) {
			$this->ca_entrada = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_ENTRADA;
		}

		return $this;
	} // setCaEntrada()

	/**
	 * Set the value of [ca_despedida] column.
	 * 
	 * @param      string $v new value
	 * @return     Cotizacion The current object (for fluent API support)
	 */
	public function setCaDespedida($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_despedida !== $v) {
			$this->ca_despedida = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_DESPEDIDA;
		}

		return $this;
	} // setCaDespedida()

	/**
	 * Set the value of [ca_usuario] column.
	 * 
	 * @param      string $v new value
	 * @return     Cotizacion The current object (for fluent API support)
	 */
	public function setCaUsuario($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usuario !== $v) {
			$this->ca_usuario = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_USUARIO;
		}

		if ($this->aUsuario !== null && $this->aUsuario->getCaLogin() !== $v) {
			$this->aUsuario = null;
		}

		return $this;
	} // setCaUsuario()

	/**
	 * Set the value of [ca_anexos] column.
	 * 
	 * @param      string $v new value
	 * @return     Cotizacion The current object (for fluent API support)
	 */
	public function setCaAnexos($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_anexos !== $v) {
			$this->ca_anexos = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_ANEXOS;
		}

		return $this;
	} // setCaAnexos()

	/**
	 * Sets the value of [ca_fchcreado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     Cotizacion The current object (for fluent API support)
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
				$this->modifiedColumns[] = CotizacionPeer::CA_FCHCREADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchcreado()

	/**
	 * Set the value of [ca_usucreado] column.
	 * 
	 * @param      string $v new value
	 * @return     Cotizacion The current object (for fluent API support)
	 */
	public function setCaUsucreado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usucreado !== $v) {
			$this->ca_usucreado = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_USUCREADO;
		}

		return $this;
	} // setCaUsucreado()

	/**
	 * Sets the value of [ca_fchactualizado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     Cotizacion The current object (for fluent API support)
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
				$this->modifiedColumns[] = CotizacionPeer::CA_FCHACTUALIZADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchactualizado()

	/**
	 * Set the value of [ca_usuactualizado] column.
	 * 
	 * @param      string $v new value
	 * @return     Cotizacion The current object (for fluent API support)
	 */
	public function setCaUsuactualizado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usuactualizado !== $v) {
			$this->ca_usuactualizado = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_USUACTUALIZADO;
		}

		return $this;
	} // setCaUsuactualizado()

	/**
	 * Sets the value of [ca_fchsolicitud] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     Cotizacion The current object (for fluent API support)
	 */
	public function setCaFchsolicitud($v)
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

		if ( $this->ca_fchsolicitud !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fchsolicitud !== null && $tmpDt = new DateTime($this->ca_fchsolicitud)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchsolicitud = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = CotizacionPeer::CA_FCHSOLICITUD;
			}
		} // if either are not null

		return $this;
	} // setCaFchsolicitud()

	/**
	 * Sets the value of [ca_horasolicitud] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     Cotizacion The current object (for fluent API support)
	 */
	public function setCaHorasolicitud($v)
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

		if ( $this->ca_horasolicitud !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_horasolicitud !== null && $tmpDt = new DateTime($this->ca_horasolicitud)) ? $tmpDt->format('H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('H:i:s') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_horasolicitud = ($dt ? $dt->format('H:i:s') : null);
				$this->modifiedColumns[] = CotizacionPeer::CA_HORASOLICITUD;
			}
		} // if either are not null

		return $this;
	} // setCaHorasolicitud()

	/**
	 * Sets the value of [ca_fchpresentacion] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     Cotizacion The current object (for fluent API support)
	 */
	public function setCaFchpresentacion($v)
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

		if ( $this->ca_fchpresentacion !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fchpresentacion !== null && $tmpDt = new DateTime($this->ca_fchpresentacion)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchpresentacion = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = CotizacionPeer::CA_FCHPRESENTACION;
			}
		} // if either are not null

		return $this;
	} // setCaFchpresentacion()

	/**
	 * Sets the value of [ca_fchanulado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     Cotizacion The current object (for fluent API support)
	 */
	public function setCaFchanulado($v)
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

		if ( $this->ca_fchanulado !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fchanulado !== null && $tmpDt = new DateTime($this->ca_fchanulado)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchanulado = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = CotizacionPeer::CA_FCHANULADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchanulado()

	/**
	 * Set the value of [ca_usuanulado] column.
	 * 
	 * @param      string $v new value
	 * @return     Cotizacion The current object (for fluent API support)
	 */
	public function setCaUsuanulado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usuanulado !== $v) {
			$this->ca_usuanulado = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_USUANULADO;
		}

		return $this;
	} // setCaUsuanulado()

	/**
	 * Set the value of [ca_empresa] column.
	 * 
	 * @param      string $v new value
	 * @return     Cotizacion The current object (for fluent API support)
	 */
	public function setCaEmpresa($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_empresa !== $v) {
			$this->ca_empresa = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_EMPRESA;
		}

		return $this;
	} // setCaEmpresa()

	/**
	 * Set the value of [ca_datosag] column.
	 * 
	 * @param      string $v new value
	 * @return     Cotizacion The current object (for fluent API support)
	 */
	public function setCaDatosag($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_datosag !== $v) {
			$this->ca_datosag = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_DATOSAG;
		}

		return $this;
	} // setCaDatosag()

	/**
	 * Set the value of [ca_fuente] column.
	 * 
	 * @param      string $v new value
	 * @return     Cotizacion The current object (for fluent API support)
	 */
	public function setCaFuente($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_fuente !== $v) {
			$this->ca_fuente = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_FUENTE;
		}

		return $this;
	} // setCaFuente()

	/**
	 * Set the value of [ca_idg_envio_oportuno] column.
	 * 
	 * @param      int $v new value
	 * @return     Cotizacion The current object (for fluent API support)
	 */
	public function setCaIdgEnvioOportuno($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idg_envio_oportuno !== $v) {
			$this->ca_idg_envio_oportuno = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_IDG_ENVIO_OPORTUNO;
		}

		if ($this->aNotTarea !== null && $this->aNotTarea->getCaIdtarea() !== $v) {
			$this->aNotTarea = null;
		}

		return $this;
	} // setCaIdgEnvioOportuno()

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

			$this->ca_idcotizacion = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_idcontacto = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_consecutivo = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_asunto = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_saludo = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_entrada = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_despedida = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_usuario = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_anexos = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_fchcreado = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_usucreado = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_fchactualizado = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_usuactualizado = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_fchsolicitud = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->ca_horasolicitud = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->ca_fchpresentacion = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->ca_fchanulado = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
			$this->ca_usuanulado = ($row[$startcol + 17] !== null) ? (string) $row[$startcol + 17] : null;
			$this->ca_empresa = ($row[$startcol + 18] !== null) ? (string) $row[$startcol + 18] : null;
			$this->ca_datosag = ($row[$startcol + 19] !== null) ? (string) $row[$startcol + 19] : null;
			$this->ca_fuente = ($row[$startcol + 20] !== null) ? (string) $row[$startcol + 20] : null;
			$this->ca_idg_envio_oportuno = ($row[$startcol + 21] !== null) ? (int) $row[$startcol + 21] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 22; // 22 = CotizacionPeer::NUM_COLUMNS - CotizacionPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Cotizacion object", $e);
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

		if ($this->aContacto !== null && $this->ca_idcontacto !== $this->aContacto->getCaIdcontacto()) {
			$this->aContacto = null;
		}
		if ($this->aUsuario !== null && $this->ca_usuario !== $this->aUsuario->getCaLogin()) {
			$this->aUsuario = null;
		}
		if ($this->aNotTarea !== null && $this->ca_idg_envio_oportuno !== $this->aNotTarea->getCaIdtarea()) {
			$this->aNotTarea = null;
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
			$con = Propel::getConnection(CotizacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = CotizacionPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aContacto = null;
			$this->aNotTarea = null;
			$this->aUsuario = null;
			$this->collCotProductos = null;
			$this->lastCotProductoCriteria = null;

			$this->collCotContinuacions = null;
			$this->lastCotContinuacionCriteria = null;

			$this->collCotSeguros = null;
			$this->lastCotSeguroCriteria = null;

			$this->collCotArchivos = null;
			$this->lastCotArchivoCriteria = null;

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
			$con = Propel::getConnection(CotizacionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			CotizacionPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(CotizacionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			CotizacionPeer::addInstanceToPool($this);
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

			if ($this->aContacto !== null) {
				if ($this->aContacto->isModified() || $this->aContacto->isNew()) {
					$affectedRows += $this->aContacto->save($con);
				}
				$this->setContacto($this->aContacto);
			}

			if ($this->aNotTarea !== null) {
				if ($this->aNotTarea->isModified() || $this->aNotTarea->isNew()) {
					$affectedRows += $this->aNotTarea->save($con);
				}
				$this->setNotTarea($this->aNotTarea);
			}

			if ($this->aUsuario !== null) {
				if ($this->aUsuario->isModified() || $this->aUsuario->isNew()) {
					$affectedRows += $this->aUsuario->save($con);
				}
				$this->setUsuario($this->aUsuario);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = CotizacionPeer::CA_IDCOTIZACION;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = CotizacionPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setCaIdcotizacion($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += CotizacionPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collCotProductos !== null) {
				foreach ($this->collCotProductos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCotContinuacions !== null) {
				foreach ($this->collCotContinuacions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCotSeguros !== null) {
				foreach ($this->collCotSeguros as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCotArchivos !== null) {
				foreach ($this->collCotArchivos as $referrerFK) {
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

			if ($this->aContacto !== null) {
				if (!$this->aContacto->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aContacto->getValidationFailures());
				}
			}

			if ($this->aNotTarea !== null) {
				if (!$this->aNotTarea->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aNotTarea->getValidationFailures());
				}
			}

			if ($this->aUsuario !== null) {
				if (!$this->aUsuario->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsuario->getValidationFailures());
				}
			}


			if (($retval = CotizacionPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collCotProductos !== null) {
					foreach ($this->collCotProductos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCotContinuacions !== null) {
					foreach ($this->collCotContinuacions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCotSeguros !== null) {
					foreach ($this->collCotSeguros as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCotArchivos !== null) {
					foreach ($this->collCotArchivos as $referrerFK) {
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
		$pos = CotizacionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdcotizacion();
				break;
			case 1:
				return $this->getCaIdcontacto();
				break;
			case 2:
				return $this->getCaConsecutivo();
				break;
			case 3:
				return $this->getCaAsunto();
				break;
			case 4:
				return $this->getCaSaludo();
				break;
			case 5:
				return $this->getCaEntrada();
				break;
			case 6:
				return $this->getCaDespedida();
				break;
			case 7:
				return $this->getCaUsuario();
				break;
			case 8:
				return $this->getCaAnexos();
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
			case 13:
				return $this->getCaFchsolicitud();
				break;
			case 14:
				return $this->getCaHorasolicitud();
				break;
			case 15:
				return $this->getCaFchpresentacion();
				break;
			case 16:
				return $this->getCaFchanulado();
				break;
			case 17:
				return $this->getCaUsuanulado();
				break;
			case 18:
				return $this->getCaEmpresa();
				break;
			case 19:
				return $this->getCaDatosag();
				break;
			case 20:
				return $this->getCaFuente();
				break;
			case 21:
				return $this->getCaIdgEnvioOportuno();
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
		$keys = CotizacionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdcotizacion(),
			$keys[1] => $this->getCaIdcontacto(),
			$keys[2] => $this->getCaConsecutivo(),
			$keys[3] => $this->getCaAsunto(),
			$keys[4] => $this->getCaSaludo(),
			$keys[5] => $this->getCaEntrada(),
			$keys[6] => $this->getCaDespedida(),
			$keys[7] => $this->getCaUsuario(),
			$keys[8] => $this->getCaAnexos(),
			$keys[9] => $this->getCaFchcreado(),
			$keys[10] => $this->getCaUsucreado(),
			$keys[11] => $this->getCaFchactualizado(),
			$keys[12] => $this->getCaUsuactualizado(),
			$keys[13] => $this->getCaFchsolicitud(),
			$keys[14] => $this->getCaHorasolicitud(),
			$keys[15] => $this->getCaFchpresentacion(),
			$keys[16] => $this->getCaFchanulado(),
			$keys[17] => $this->getCaUsuanulado(),
			$keys[18] => $this->getCaEmpresa(),
			$keys[19] => $this->getCaDatosag(),
			$keys[20] => $this->getCaFuente(),
			$keys[21] => $this->getCaIdgEnvioOportuno(),
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
		$pos = CotizacionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdcotizacion($value);
				break;
			case 1:
				$this->setCaIdcontacto($value);
				break;
			case 2:
				$this->setCaConsecutivo($value);
				break;
			case 3:
				$this->setCaAsunto($value);
				break;
			case 4:
				$this->setCaSaludo($value);
				break;
			case 5:
				$this->setCaEntrada($value);
				break;
			case 6:
				$this->setCaDespedida($value);
				break;
			case 7:
				$this->setCaUsuario($value);
				break;
			case 8:
				$this->setCaAnexos($value);
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
			case 13:
				$this->setCaFchsolicitud($value);
				break;
			case 14:
				$this->setCaHorasolicitud($value);
				break;
			case 15:
				$this->setCaFchpresentacion($value);
				break;
			case 16:
				$this->setCaFchanulado($value);
				break;
			case 17:
				$this->setCaUsuanulado($value);
				break;
			case 18:
				$this->setCaEmpresa($value);
				break;
			case 19:
				$this->setCaDatosag($value);
				break;
			case 20:
				$this->setCaFuente($value);
				break;
			case 21:
				$this->setCaIdgEnvioOportuno($value);
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
		$keys = CotizacionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdcotizacion($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdcontacto($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaConsecutivo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaAsunto($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaSaludo($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaEntrada($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaDespedida($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaUsuario($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaAnexos($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaFchcreado($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaUsucreado($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaFchactualizado($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaUsuactualizado($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaFchsolicitud($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaHorasolicitud($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaFchpresentacion($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCaFchanulado($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setCaUsuanulado($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setCaEmpresa($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setCaDatosag($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setCaFuente($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setCaIdgEnvioOportuno($arr[$keys[21]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(CotizacionPeer::DATABASE_NAME);

		if ($this->isColumnModified(CotizacionPeer::CA_IDCOTIZACION)) $criteria->add(CotizacionPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);
		if ($this->isColumnModified(CotizacionPeer::CA_IDCONTACTO)) $criteria->add(CotizacionPeer::CA_IDCONTACTO, $this->ca_idcontacto);
		if ($this->isColumnModified(CotizacionPeer::CA_CONSECUTIVO)) $criteria->add(CotizacionPeer::CA_CONSECUTIVO, $this->ca_consecutivo);
		if ($this->isColumnModified(CotizacionPeer::CA_ASUNTO)) $criteria->add(CotizacionPeer::CA_ASUNTO, $this->ca_asunto);
		if ($this->isColumnModified(CotizacionPeer::CA_SALUDO)) $criteria->add(CotizacionPeer::CA_SALUDO, $this->ca_saludo);
		if ($this->isColumnModified(CotizacionPeer::CA_ENTRADA)) $criteria->add(CotizacionPeer::CA_ENTRADA, $this->ca_entrada);
		if ($this->isColumnModified(CotizacionPeer::CA_DESPEDIDA)) $criteria->add(CotizacionPeer::CA_DESPEDIDA, $this->ca_despedida);
		if ($this->isColumnModified(CotizacionPeer::CA_USUARIO)) $criteria->add(CotizacionPeer::CA_USUARIO, $this->ca_usuario);
		if ($this->isColumnModified(CotizacionPeer::CA_ANEXOS)) $criteria->add(CotizacionPeer::CA_ANEXOS, $this->ca_anexos);
		if ($this->isColumnModified(CotizacionPeer::CA_FCHCREADO)) $criteria->add(CotizacionPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(CotizacionPeer::CA_USUCREADO)) $criteria->add(CotizacionPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(CotizacionPeer::CA_FCHACTUALIZADO)) $criteria->add(CotizacionPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(CotizacionPeer::CA_USUACTUALIZADO)) $criteria->add(CotizacionPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);
		if ($this->isColumnModified(CotizacionPeer::CA_FCHSOLICITUD)) $criteria->add(CotizacionPeer::CA_FCHSOLICITUD, $this->ca_fchsolicitud);
		if ($this->isColumnModified(CotizacionPeer::CA_HORASOLICITUD)) $criteria->add(CotizacionPeer::CA_HORASOLICITUD, $this->ca_horasolicitud);
		if ($this->isColumnModified(CotizacionPeer::CA_FCHPRESENTACION)) $criteria->add(CotizacionPeer::CA_FCHPRESENTACION, $this->ca_fchpresentacion);
		if ($this->isColumnModified(CotizacionPeer::CA_FCHANULADO)) $criteria->add(CotizacionPeer::CA_FCHANULADO, $this->ca_fchanulado);
		if ($this->isColumnModified(CotizacionPeer::CA_USUANULADO)) $criteria->add(CotizacionPeer::CA_USUANULADO, $this->ca_usuanulado);
		if ($this->isColumnModified(CotizacionPeer::CA_EMPRESA)) $criteria->add(CotizacionPeer::CA_EMPRESA, $this->ca_empresa);
		if ($this->isColumnModified(CotizacionPeer::CA_DATOSAG)) $criteria->add(CotizacionPeer::CA_DATOSAG, $this->ca_datosag);
		if ($this->isColumnModified(CotizacionPeer::CA_FUENTE)) $criteria->add(CotizacionPeer::CA_FUENTE, $this->ca_fuente);
		if ($this->isColumnModified(CotizacionPeer::CA_IDG_ENVIO_OPORTUNO)) $criteria->add(CotizacionPeer::CA_IDG_ENVIO_OPORTUNO, $this->ca_idg_envio_oportuno);

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
		$criteria = new Criteria(CotizacionPeer::DATABASE_NAME);

		$criteria->add(CotizacionPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdcotizacion();
	}

	/**
	 * Generic method to set the primary key (ca_idcotizacion column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdcotizacion($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Cotizacion (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdcontacto($this->ca_idcontacto);

		$copyObj->setCaConsecutivo($this->ca_consecutivo);

		$copyObj->setCaAsunto($this->ca_asunto);

		$copyObj->setCaSaludo($this->ca_saludo);

		$copyObj->setCaEntrada($this->ca_entrada);

		$copyObj->setCaDespedida($this->ca_despedida);

		$copyObj->setCaUsuario($this->ca_usuario);

		$copyObj->setCaAnexos($this->ca_anexos);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);

		$copyObj->setCaFchsolicitud($this->ca_fchsolicitud);

		$copyObj->setCaHorasolicitud($this->ca_horasolicitud);

		$copyObj->setCaFchpresentacion($this->ca_fchpresentacion);

		$copyObj->setCaFchanulado($this->ca_fchanulado);

		$copyObj->setCaUsuanulado($this->ca_usuanulado);

		$copyObj->setCaEmpresa($this->ca_empresa);

		$copyObj->setCaDatosag($this->ca_datosag);

		$copyObj->setCaFuente($this->ca_fuente);

		$copyObj->setCaIdgEnvioOportuno($this->ca_idg_envio_oportuno);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getCotProductos() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addCotProducto($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getCotContinuacions() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addCotContinuacion($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getCotSeguros() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addCotSeguro($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getCotArchivos() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addCotArchivo($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setCaIdcotizacion(NULL); // this is a auto-increment column, so set to default value

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
	 * @return     Cotizacion Clone of current object.
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
	 * @return     CotizacionPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new CotizacionPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Contacto object.
	 *
	 * @param      Contacto $v
	 * @return     Cotizacion The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setContacto(Contacto $v = null)
	{
		if ($v === null) {
			$this->setCaIdcontacto(NULL);
		} else {
			$this->setCaIdcontacto($v->getCaIdcontacto());
		}

		$this->aContacto = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Contacto object, it will not be re-added.
		if ($v !== null) {
			$v->addCotizacion($this);
		}

		return $this;
	}


	/**
	 * Get the associated Contacto object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Contacto The associated Contacto object.
	 * @throws     PropelException
	 */
	public function getContacto(PropelPDO $con = null)
	{
		if ($this->aContacto === null && ($this->ca_idcontacto !== null)) {
			$c = new Criteria(ContactoPeer::DATABASE_NAME);
			$c->add(ContactoPeer::CA_IDCONTACTO, $this->ca_idcontacto);
			$this->aContacto = ContactoPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aContacto->addCotizacions($this);
			 */
		}
		return $this->aContacto;
	}

	/**
	 * Declares an association between this object and a NotTarea object.
	 *
	 * @param      NotTarea $v
	 * @return     Cotizacion The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setNotTarea(NotTarea $v = null)
	{
		if ($v === null) {
			$this->setCaIdgEnvioOportuno(NULL);
		} else {
			$this->setCaIdgEnvioOportuno($v->getCaIdtarea());
		}

		$this->aNotTarea = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the NotTarea object, it will not be re-added.
		if ($v !== null) {
			$v->addCotizacion($this);
		}

		return $this;
	}


	/**
	 * Get the associated NotTarea object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     NotTarea The associated NotTarea object.
	 * @throws     PropelException
	 */
	public function getNotTarea(PropelPDO $con = null)
	{
		if ($this->aNotTarea === null && ($this->ca_idg_envio_oportuno !== null)) {
			$c = new Criteria(NotTareaPeer::DATABASE_NAME);
			$c->add(NotTareaPeer::CA_IDTAREA, $this->ca_idg_envio_oportuno);
			$this->aNotTarea = NotTareaPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aNotTarea->addCotizacions($this);
			 */
		}
		return $this->aNotTarea;
	}

	/**
	 * Declares an association between this object and a Usuario object.
	 *
	 * @param      Usuario $v
	 * @return     Cotizacion The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setUsuario(Usuario $v = null)
	{
		if ($v === null) {
			$this->setCaUsuario(NULL);
		} else {
			$this->setCaUsuario($v->getCaLogin());
		}

		$this->aUsuario = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Usuario object, it will not be re-added.
		if ($v !== null) {
			$v->addCotizacion($this);
		}

		return $this;
	}


	/**
	 * Get the associated Usuario object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Usuario The associated Usuario object.
	 * @throws     PropelException
	 */
	public function getUsuario(PropelPDO $con = null)
	{
		if ($this->aUsuario === null && (($this->ca_usuario !== "" && $this->ca_usuario !== null))) {
			$c = new Criteria(UsuarioPeer::DATABASE_NAME);
			$c->add(UsuarioPeer::CA_LOGIN, $this->ca_usuario);
			$this->aUsuario = UsuarioPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aUsuario->addCotizacions($this);
			 */
		}
		return $this->aUsuario;
	}

	/**
	 * Clears out the collCotProductos collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addCotProductos()
	 */
	public function clearCotProductos()
	{
		$this->collCotProductos = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collCotProductos collection (array).
	 *
	 * By default this just sets the collCotProductos collection to an empty array (like clearcollCotProductos());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initCotProductos()
	{
		$this->collCotProductos = array();
	}

	/**
	 * Gets an array of CotProducto objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Cotizacion has previously been saved, it will retrieve
	 * related CotProductos from storage. If this Cotizacion is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array CotProducto[]
	 * @throws     PropelException
	 */
	public function getCotProductos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotizacionPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotProductos === null) {
			if ($this->isNew()) {
			   $this->collCotProductos = array();
			} else {

				$criteria->add(CotProductoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				CotProductoPeer::addSelectColumns($criteria);
				$this->collCotProductos = CotProductoPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CotProductoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				CotProductoPeer::addSelectColumns($criteria);
				if (!isset($this->lastCotProductoCriteria) || !$this->lastCotProductoCriteria->equals($criteria)) {
					$this->collCotProductos = CotProductoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCotProductoCriteria = $criteria;
		return $this->collCotProductos;
	}

	/**
	 * Returns the number of related CotProducto objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related CotProducto objects.
	 * @throws     PropelException
	 */
	public function countCotProductos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotizacionPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collCotProductos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(CotProductoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				$count = CotProductoPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(CotProductoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				if (!isset($this->lastCotProductoCriteria) || !$this->lastCotProductoCriteria->equals($criteria)) {
					$count = CotProductoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collCotProductos);
				}
			} else {
				$count = count($this->collCotProductos);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a CotProducto object to this object
	 * through the CotProducto foreign key attribute.
	 *
	 * @param      CotProducto $l CotProducto
	 * @return     void
	 * @throws     PropelException
	 */
	public function addCotProducto(CotProducto $l)
	{
		if ($this->collCotProductos === null) {
			$this->initCotProductos();
		}
		if (!in_array($l, $this->collCotProductos, true)) { // only add it if the **same** object is not already associated
			array_push($this->collCotProductos, $l);
			$l->setCotizacion($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Cotizacion is new, it will return
	 * an empty collection; or if this Cotizacion has previously
	 * been saved, it will retrieve related CotProductos from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Cotizacion.
	 */
	public function getCotProductosJoinTransportador($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotizacionPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotProductos === null) {
			if ($this->isNew()) {
				$this->collCotProductos = array();
			} else {

				$criteria->add(CotProductoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				$this->collCotProductos = CotProductoPeer::doSelectJoinTransportador($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CotProductoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

			if (!isset($this->lastCotProductoCriteria) || !$this->lastCotProductoCriteria->equals($criteria)) {
				$this->collCotProductos = CotProductoPeer::doSelectJoinTransportador($criteria, $con, $join_behavior);
			}
		}
		$this->lastCotProductoCriteria = $criteria;

		return $this->collCotProductos;
	}

	/**
	 * Clears out the collCotContinuacions collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addCotContinuacions()
	 */
	public function clearCotContinuacions()
	{
		$this->collCotContinuacions = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collCotContinuacions collection (array).
	 *
	 * By default this just sets the collCotContinuacions collection to an empty array (like clearcollCotContinuacions());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initCotContinuacions()
	{
		$this->collCotContinuacions = array();
	}

	/**
	 * Gets an array of CotContinuacion objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Cotizacion has previously been saved, it will retrieve
	 * related CotContinuacions from storage. If this Cotizacion is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array CotContinuacion[]
	 * @throws     PropelException
	 */
	public function getCotContinuacions($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotizacionPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotContinuacions === null) {
			if ($this->isNew()) {
			   $this->collCotContinuacions = array();
			} else {

				$criteria->add(CotContinuacionPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				CotContinuacionPeer::addSelectColumns($criteria);
				$this->collCotContinuacions = CotContinuacionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CotContinuacionPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				CotContinuacionPeer::addSelectColumns($criteria);
				if (!isset($this->lastCotContinuacionCriteria) || !$this->lastCotContinuacionCriteria->equals($criteria)) {
					$this->collCotContinuacions = CotContinuacionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCotContinuacionCriteria = $criteria;
		return $this->collCotContinuacions;
	}

	/**
	 * Returns the number of related CotContinuacion objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related CotContinuacion objects.
	 * @throws     PropelException
	 */
	public function countCotContinuacions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotizacionPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collCotContinuacions === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(CotContinuacionPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				$count = CotContinuacionPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(CotContinuacionPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				if (!isset($this->lastCotContinuacionCriteria) || !$this->lastCotContinuacionCriteria->equals($criteria)) {
					$count = CotContinuacionPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collCotContinuacions);
				}
			} else {
				$count = count($this->collCotContinuacions);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a CotContinuacion object to this object
	 * through the CotContinuacion foreign key attribute.
	 *
	 * @param      CotContinuacion $l CotContinuacion
	 * @return     void
	 * @throws     PropelException
	 */
	public function addCotContinuacion(CotContinuacion $l)
	{
		if ($this->collCotContinuacions === null) {
			$this->initCotContinuacions();
		}
		if (!in_array($l, $this->collCotContinuacions, true)) { // only add it if the **same** object is not already associated
			array_push($this->collCotContinuacions, $l);
			$l->setCotizacion($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Cotizacion is new, it will return
	 * an empty collection; or if this Cotizacion has previously
	 * been saved, it will retrieve related CotContinuacions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Cotizacion.
	 */
	public function getCotContinuacionsJoinConcepto($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotizacionPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotContinuacions === null) {
			if ($this->isNew()) {
				$this->collCotContinuacions = array();
			} else {

				$criteria->add(CotContinuacionPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				$this->collCotContinuacions = CotContinuacionPeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CotContinuacionPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

			if (!isset($this->lastCotContinuacionCriteria) || !$this->lastCotContinuacionCriteria->equals($criteria)) {
				$this->collCotContinuacions = CotContinuacionPeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		}
		$this->lastCotContinuacionCriteria = $criteria;

		return $this->collCotContinuacions;
	}

	/**
	 * Clears out the collCotSeguros collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addCotSeguros()
	 */
	public function clearCotSeguros()
	{
		$this->collCotSeguros = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collCotSeguros collection (array).
	 *
	 * By default this just sets the collCotSeguros collection to an empty array (like clearcollCotSeguros());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initCotSeguros()
	{
		$this->collCotSeguros = array();
	}

	/**
	 * Gets an array of CotSeguro objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Cotizacion has previously been saved, it will retrieve
	 * related CotSeguros from storage. If this Cotizacion is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array CotSeguro[]
	 * @throws     PropelException
	 */
	public function getCotSeguros($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotizacionPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotSeguros === null) {
			if ($this->isNew()) {
			   $this->collCotSeguros = array();
			} else {

				$criteria->add(CotSeguroPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				CotSeguroPeer::addSelectColumns($criteria);
				$this->collCotSeguros = CotSeguroPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CotSeguroPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				CotSeguroPeer::addSelectColumns($criteria);
				if (!isset($this->lastCotSeguroCriteria) || !$this->lastCotSeguroCriteria->equals($criteria)) {
					$this->collCotSeguros = CotSeguroPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCotSeguroCriteria = $criteria;
		return $this->collCotSeguros;
	}

	/**
	 * Returns the number of related CotSeguro objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related CotSeguro objects.
	 * @throws     PropelException
	 */
	public function countCotSeguros(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotizacionPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collCotSeguros === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(CotSeguroPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				$count = CotSeguroPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(CotSeguroPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				if (!isset($this->lastCotSeguroCriteria) || !$this->lastCotSeguroCriteria->equals($criteria)) {
					$count = CotSeguroPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collCotSeguros);
				}
			} else {
				$count = count($this->collCotSeguros);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a CotSeguro object to this object
	 * through the CotSeguro foreign key attribute.
	 *
	 * @param      CotSeguro $l CotSeguro
	 * @return     void
	 * @throws     PropelException
	 */
	public function addCotSeguro(CotSeguro $l)
	{
		if ($this->collCotSeguros === null) {
			$this->initCotSeguros();
		}
		if (!in_array($l, $this->collCotSeguros, true)) { // only add it if the **same** object is not already associated
			array_push($this->collCotSeguros, $l);
			$l->setCotizacion($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Cotizacion is new, it will return
	 * an empty collection; or if this Cotizacion has previously
	 * been saved, it will retrieve related CotSeguros from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Cotizacion.
	 */
	public function getCotSegurosJoinMoneda($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotizacionPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotSeguros === null) {
			if ($this->isNew()) {
				$this->collCotSeguros = array();
			} else {

				$criteria->add(CotSeguroPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				$this->collCotSeguros = CotSeguroPeer::doSelectJoinMoneda($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CotSeguroPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

			if (!isset($this->lastCotSeguroCriteria) || !$this->lastCotSeguroCriteria->equals($criteria)) {
				$this->collCotSeguros = CotSeguroPeer::doSelectJoinMoneda($criteria, $con, $join_behavior);
			}
		}
		$this->lastCotSeguroCriteria = $criteria;

		return $this->collCotSeguros;
	}

	/**
	 * Clears out the collCotArchivos collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addCotArchivos()
	 */
	public function clearCotArchivos()
	{
		$this->collCotArchivos = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collCotArchivos collection (array).
	 *
	 * By default this just sets the collCotArchivos collection to an empty array (like clearcollCotArchivos());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initCotArchivos()
	{
		$this->collCotArchivos = array();
	}

	/**
	 * Gets an array of CotArchivo objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Cotizacion has previously been saved, it will retrieve
	 * related CotArchivos from storage. If this Cotizacion is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array CotArchivo[]
	 * @throws     PropelException
	 */
	public function getCotArchivos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotizacionPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotArchivos === null) {
			if ($this->isNew()) {
			   $this->collCotArchivos = array();
			} else {

				$criteria->add(CotArchivoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				CotArchivoPeer::addSelectColumns($criteria);
				$this->collCotArchivos = CotArchivoPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CotArchivoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				CotArchivoPeer::addSelectColumns($criteria);
				if (!isset($this->lastCotArchivoCriteria) || !$this->lastCotArchivoCriteria->equals($criteria)) {
					$this->collCotArchivos = CotArchivoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCotArchivoCriteria = $criteria;
		return $this->collCotArchivos;
	}

	/**
	 * Returns the number of related CotArchivo objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related CotArchivo objects.
	 * @throws     PropelException
	 */
	public function countCotArchivos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotizacionPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collCotArchivos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(CotArchivoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				$count = CotArchivoPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(CotArchivoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				if (!isset($this->lastCotArchivoCriteria) || !$this->lastCotArchivoCriteria->equals($criteria)) {
					$count = CotArchivoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collCotArchivos);
				}
			} else {
				$count = count($this->collCotArchivos);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a CotArchivo object to this object
	 * through the CotArchivo foreign key attribute.
	 *
	 * @param      CotArchivo $l CotArchivo
	 * @return     void
	 * @throws     PropelException
	 */
	public function addCotArchivo(CotArchivo $l)
	{
		if ($this->collCotArchivos === null) {
			$this->initCotArchivos();
		}
		if (!in_array($l, $this->collCotArchivos, true)) { // only add it if the **same** object is not already associated
			array_push($this->collCotArchivos, $l);
			$l->setCotizacion($this);
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
			if ($this->collCotProductos) {
				foreach ((array) $this->collCotProductos as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collCotContinuacions) {
				foreach ((array) $this->collCotContinuacions as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collCotSeguros) {
				foreach ((array) $this->collCotSeguros as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collCotArchivos) {
				foreach ((array) $this->collCotArchivos as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collCotProductos = null;
		$this->collCotContinuacions = null;
		$this->collCotSeguros = null;
		$this->collCotArchivos = null;
			$this->aContacto = null;
			$this->aNotTarea = null;
			$this->aUsuario = null;
	}

} // BaseCotizacion
