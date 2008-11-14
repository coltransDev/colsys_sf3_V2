<?php

/**
 * Base class that represents a row from the 'tb_cotizaciones' table.
 *
 * 
 *
 * @package    lib.model.cotizaciones.om
 */
abstract class BaseCotizacion extends BaseObject  implements Persistent {


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
	 * @var        int
	 */
	protected $ca_fchcreado;


	/**
	 * The value for the ca_usucreado field.
	 * @var        string
	 */
	protected $ca_usucreado;


	/**
	 * The value for the ca_fchactualizado field.
	 * @var        int
	 */
	protected $ca_fchactualizado;


	/**
	 * The value for the ca_usuactualizado field.
	 * @var        string
	 */
	protected $ca_usuactualizado;


	/**
	 * The value for the ca_fchsolicitud field.
	 * @var        int
	 */
	protected $ca_fchsolicitud;


	/**
	 * The value for the ca_horasolicitud field.
	 * @var        int
	 */
	protected $ca_horasolicitud;


	/**
	 * The value for the ca_fchanulado field.
	 * @var        int
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
	 * @var        Contacto
	 */
	protected $aContacto;

	/**
	 * @var        Usuario
	 */
	protected $aUsuario;

	/**
	 * Collection to store aggregation of collCotProductos.
	 * @var        array
	 */
	protected $collCotProductos;

	/**
	 * The criteria used to select the current contents of collCotProductos.
	 * @var        Criteria
	 */
	protected $lastCotProductoCriteria = null;

	/**
	 * Collection to store aggregation of collCotContinuacions.
	 * @var        array
	 */
	protected $collCotContinuacions;

	/**
	 * The criteria used to select the current contents of collCotContinuacions.
	 * @var        Criteria
	 */
	protected $lastCotContinuacionCriteria = null;

	/**
	 * Collection to store aggregation of collCotSeguros.
	 * @var        array
	 */
	protected $collCotSeguros;

	/**
	 * The criteria used to select the current contents of collCotSeguros.
	 * @var        Criteria
	 */
	protected $lastCotSeguroCriteria = null;

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
	 * Get the [optionally formatted] [ca_fchcreado] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchcreado($format = 'Y-m-d')
	{

		if ($this->ca_fchcreado === null || $this->ca_fchcreado === '') {
			return null;
		} elseif (!is_int($this->ca_fchcreado)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_fchcreado);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_fchcreado] as date/time value: " . var_export($this->ca_fchcreado, true));
			}
		} else {
			$ts = $this->ca_fchcreado;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
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
	 * Get the [optionally formatted] [ca_fchactualizado] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchactualizado($format = 'Y-m-d')
	{

		if ($this->ca_fchactualizado === null || $this->ca_fchactualizado === '') {
			return null;
		} elseif (!is_int($this->ca_fchactualizado)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_fchactualizado);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_fchactualizado] as date/time value: " . var_export($this->ca_fchactualizado, true));
			}
		} else {
			$ts = $this->ca_fchactualizado;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
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
	 * Get the [optionally formatted] [ca_fchsolicitud] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchsolicitud($format = 'Y-m-d')
	{

		if ($this->ca_fchsolicitud === null || $this->ca_fchsolicitud === '') {
			return null;
		} elseif (!is_int($this->ca_fchsolicitud)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_fchsolicitud);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_fchsolicitud] as date/time value: " . var_export($this->ca_fchsolicitud, true));
			}
		} else {
			$ts = $this->ca_fchsolicitud;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	/**
	 * Get the [optionally formatted] [ca_horasolicitud] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaHorasolicitud($format = 'H:i:s')
	{

		if ($this->ca_horasolicitud === null || $this->ca_horasolicitud === '') {
			return null;
		} elseif (!is_int($this->ca_horasolicitud)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_horasolicitud);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_horasolicitud] as date/time value: " . var_export($this->ca_horasolicitud, true));
			}
		} else {
			$ts = $this->ca_horasolicitud;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	/**
	 * Get the [optionally formatted] [ca_fchanulado] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchanulado($format = 'Y-m-d')
	{

		if ($this->ca_fchanulado === null || $this->ca_fchanulado === '') {
			return null;
		} elseif (!is_int($this->ca_fchanulado)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_fchanulado);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_fchanulado] as date/time value: " . var_export($this->ca_fchanulado, true));
			}
		} else {
			$ts = $this->ca_fchanulado;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
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
	 * Set the value of [ca_idcotizacion] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdcotizacion($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idcotizacion !== $v) {
			$this->ca_idcotizacion = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_IDCOTIZACION;
		}

	} // setCaIdcotizacion()

	/**
	 * Set the value of [ca_idcontacto] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdcontacto($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idcontacto !== $v) {
			$this->ca_idcontacto = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_IDCONTACTO;
		}

		if ($this->aContacto !== null && $this->aContacto->getCaIdcontacto() !== $v) {
			$this->aContacto = null;
		}

	} // setCaIdcontacto()

	/**
	 * Set the value of [ca_consecutivo] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaConsecutivo($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_consecutivo !== $v) {
			$this->ca_consecutivo = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_CONSECUTIVO;
		}

	} // setCaConsecutivo()

	/**
	 * Set the value of [ca_asunto] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaAsunto($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_asunto !== $v) {
			$this->ca_asunto = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_ASUNTO;
		}

	} // setCaAsunto()

	/**
	 * Set the value of [ca_saludo] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaSaludo($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_saludo !== $v) {
			$this->ca_saludo = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_SALUDO;
		}

	} // setCaSaludo()

	/**
	 * Set the value of [ca_entrada] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaEntrada($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_entrada !== $v) {
			$this->ca_entrada = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_ENTRADA;
		}

	} // setCaEntrada()

	/**
	 * Set the value of [ca_despedida] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaDespedida($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_despedida !== $v) {
			$this->ca_despedida = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_DESPEDIDA;
		}

	} // setCaDespedida()

	/**
	 * Set the value of [ca_usuario] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaUsuario($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_usuario !== $v) {
			$this->ca_usuario = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_USUARIO;
		}

		if ($this->aUsuario !== null && $this->aUsuario->getCaLogin() !== $v) {
			$this->aUsuario = null;
		}

	} // setCaUsuario()

	/**
	 * Set the value of [ca_anexos] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaAnexos($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_anexos !== $v) {
			$this->ca_anexos = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_ANEXOS;
		}

	} // setCaAnexos()

	/**
	 * Set the value of [ca_fchcreado] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaFchcreado($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_fchcreado] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_fchcreado !== $ts) {
			$this->ca_fchcreado = $ts;
			$this->modifiedColumns[] = CotizacionPeer::CA_FCHCREADO;
		}

	} // setCaFchcreado()

	/**
	 * Set the value of [ca_usucreado] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaUsucreado($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_usucreado !== $v) {
			$this->ca_usucreado = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_USUCREADO;
		}

	} // setCaUsucreado()

	/**
	 * Set the value of [ca_fchactualizado] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaFchactualizado($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_fchactualizado] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_fchactualizado !== $ts) {
			$this->ca_fchactualizado = $ts;
			$this->modifiedColumns[] = CotizacionPeer::CA_FCHACTUALIZADO;
		}

	} // setCaFchactualizado()

	/**
	 * Set the value of [ca_usuactualizado] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaUsuactualizado($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_usuactualizado !== $v) {
			$this->ca_usuactualizado = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_USUACTUALIZADO;
		}

	} // setCaUsuactualizado()

	/**
	 * Set the value of [ca_fchsolicitud] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaFchsolicitud($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_fchsolicitud] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_fchsolicitud !== $ts) {
			$this->ca_fchsolicitud = $ts;
			$this->modifiedColumns[] = CotizacionPeer::CA_FCHSOLICITUD;
		}

	} // setCaFchsolicitud()

	/**
	 * Set the value of [ca_horasolicitud] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaHorasolicitud($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_horasolicitud] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_horasolicitud !== $ts) {
			$this->ca_horasolicitud = $ts;
			$this->modifiedColumns[] = CotizacionPeer::CA_HORASOLICITUD;
		}

	} // setCaHorasolicitud()

	/**
	 * Set the value of [ca_fchanulado] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaFchanulado($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_fchanulado] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_fchanulado !== $ts) {
			$this->ca_fchanulado = $ts;
			$this->modifiedColumns[] = CotizacionPeer::CA_FCHANULADO;
		}

	} // setCaFchanulado()

	/**
	 * Set the value of [ca_usuanulado] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaUsuanulado($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_usuanulado !== $v) {
			$this->ca_usuanulado = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_USUANULADO;
		}

	} // setCaUsuanulado()

	/**
	 * Set the value of [ca_empresa] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaEmpresa($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_empresa !== $v) {
			$this->ca_empresa = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_EMPRESA;
		}

	} // setCaEmpresa()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (1-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      ResultSet $rs The ResultSet class with cursor advanced to desired record pos.
	 * @param      int $startcol 1-based offset column which indicates which restultset column to start with.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->ca_idcotizacion = $rs->getInt($startcol + 0);

			$this->ca_idcontacto = $rs->getInt($startcol + 1);

			$this->ca_consecutivo = $rs->getString($startcol + 2);

			$this->ca_asunto = $rs->getString($startcol + 3);

			$this->ca_saludo = $rs->getString($startcol + 4);

			$this->ca_entrada = $rs->getString($startcol + 5);

			$this->ca_despedida = $rs->getString($startcol + 6);

			$this->ca_usuario = $rs->getString($startcol + 7);

			$this->ca_anexos = $rs->getString($startcol + 8);

			$this->ca_fchcreado = $rs->getDate($startcol + 9, null);

			$this->ca_usucreado = $rs->getString($startcol + 10);

			$this->ca_fchactualizado = $rs->getDate($startcol + 11, null);

			$this->ca_usuactualizado = $rs->getString($startcol + 12);

			$this->ca_fchsolicitud = $rs->getDate($startcol + 13, null);

			$this->ca_horasolicitud = $rs->getTime($startcol + 14, null);

			$this->ca_fchanulado = $rs->getDate($startcol + 15, null);

			$this->ca_usuanulado = $rs->getString($startcol + 16);

			$this->ca_empresa = $rs->getString($startcol + 17);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 18; // 18 = CotizacionPeer::NUM_COLUMNS - CotizacionPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Cotizacion object", $e);
		}
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      Connection $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(CotizacionPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			CotizacionPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Stores the object in the database.  If the object is new,
	 * it inserts it; otherwise an update is performed.  This method
	 * wraps the doSave() worker method in a transaction.
	 *
	 * @param      Connection $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(CotizacionPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Stores the object in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      Connection $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave($con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aContacto !== null) {
				if ($this->aContacto->isModified()) {
					$affectedRows += $this->aContacto->save($con);
				}
				$this->setContacto($this->aContacto);
			}

			if ($this->aUsuario !== null) {
				if ($this->aUsuario->isModified()) {
					$affectedRows += $this->aUsuario->save($con);
				}
				$this->setUsuario($this->aUsuario);
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
				foreach($this->collCotProductos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCotContinuacions !== null) {
				foreach($this->collCotContinuacions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCotSeguros !== null) {
				foreach($this->collCotSeguros as $referrerFK) {
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

			if ($this->aUsuario !== null) {
				if (!$this->aUsuario->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsuario->getValidationFailures());
				}
			}


			if (($retval = CotizacionPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collCotProductos !== null) {
					foreach($this->collCotProductos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCotContinuacions !== null) {
					foreach($this->collCotContinuacions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCotSeguros !== null) {
					foreach($this->collCotSeguros as $referrerFK) {
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
	 *                     one of the class type constants TYPE_PHPNAME,
	 *                     TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CotizacionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
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
				return $this->getCaFchanulado();
				break;
			case 16:
				return $this->getCaUsuanulado();
				break;
			case 17:
				return $this->getCaEmpresa();
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
	 * @param      string $keyType One of the class type constants TYPE_PHPNAME,
	 *                        TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
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
			$keys[15] => $this->getCaFchanulado(),
			$keys[16] => $this->getCaUsuanulado(),
			$keys[17] => $this->getCaEmpresa(),
		);
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants TYPE_PHPNAME,
	 *                     TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
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
				$this->setCaFchanulado($value);
				break;
			case 16:
				$this->setCaUsuanulado($value);
				break;
			case 17:
				$this->setCaEmpresa($value);
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
	 * of the class type constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME,
	 * TYPE_NUM. The default key type is the column's phpname (e.g. 'authorId')
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
		if (array_key_exists($keys[15], $arr)) $this->setCaFchanulado($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCaUsuanulado($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setCaEmpresa($arr[$keys[17]]);
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
		if ($this->isColumnModified(CotizacionPeer::CA_FCHANULADO)) $criteria->add(CotizacionPeer::CA_FCHANULADO, $this->ca_fchanulado);
		if ($this->isColumnModified(CotizacionPeer::CA_USUANULADO)) $criteria->add(CotizacionPeer::CA_USUANULADO, $this->ca_usuanulado);
		if ($this->isColumnModified(CotizacionPeer::CA_EMPRESA)) $criteria->add(CotizacionPeer::CA_EMPRESA, $this->ca_empresa);

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

		$copyObj->setCaFchanulado($this->ca_fchanulado);

		$copyObj->setCaUsuanulado($this->ca_usuanulado);

		$copyObj->setCaEmpresa($this->ca_empresa);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getCotProductos() as $relObj) {
				$copyObj->addCotProducto($relObj->copy($deepCopy));
			}

			foreach($this->getCotContinuacions() as $relObj) {
				$copyObj->addCotContinuacion($relObj->copy($deepCopy));
			}

			foreach($this->getCotSeguros() as $relObj) {
				$copyObj->addCotSeguro($relObj->copy($deepCopy));
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setCaIdcotizacion(NULL); // this is a pkey column, so set to default value

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
	 * @return     void
	 * @throws     PropelException
	 */
	public function setContacto($v)
	{


		if ($v === null) {
			$this->setCaIdcontacto(NULL);
		} else {
			$this->setCaIdcontacto($v->getCaIdcontacto());
		}


		$this->aContacto = $v;
	}


	/**
	 * Get the associated Contacto object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Contacto The associated Contacto object.
	 * @throws     PropelException
	 */
	public function getContacto($con = null)
	{
		if ($this->aContacto === null && ($this->ca_idcontacto !== null)) {
			// include the related Peer class
			$this->aContacto = ContactoPeer::retrieveByPK($this->ca_idcontacto, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = ContactoPeer::retrieveByPK($this->ca_idcontacto, $con);
			   $obj->addContactos($this);
			 */
		}
		return $this->aContacto;
	}

	/**
	 * Declares an association between this object and a Usuario object.
	 *
	 * @param      Usuario $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setUsuario($v)
	{


		if ($v === null) {
			$this->setCaUsuario(NULL);
		} else {
			$this->setCaUsuario($v->getCaLogin());
		}


		$this->aUsuario = $v;
	}


	/**
	 * Get the associated Usuario object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Usuario The associated Usuario object.
	 * @throws     PropelException
	 */
	public function getUsuario($con = null)
	{
		if ($this->aUsuario === null && (($this->ca_usuario !== "" && $this->ca_usuario !== null))) {
			// include the related Peer class
			$this->aUsuario = UsuarioPeer::retrieveByPK($this->ca_usuario, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = UsuarioPeer::retrieveByPK($this->ca_usuario, $con);
			   $obj->addUsuarios($this);
			 */
		}
		return $this->aUsuario;
	}

	/**
	 * Temporary storage of collCotProductos to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initCotProductos()
	{
		if ($this->collCotProductos === null) {
			$this->collCotProductos = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Cotizacion has previously
	 * been saved, it will retrieve related CotProductos from storage.
	 * If this Cotizacion is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getCotProductos($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotProductos === null) {
			if ($this->isNew()) {
			   $this->collCotProductos = array();
			} else {

				$criteria->add(CotProductoPeer::CA_IDCOTIZACION, $this->getCaIdcotizacion());

				CotProductoPeer::addSelectColumns($criteria);
				$this->collCotProductos = CotProductoPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CotProductoPeer::CA_IDCOTIZACION, $this->getCaIdcotizacion());

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
	 * Returns the number of related CotProductos.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countCotProductos($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CotProductoPeer::CA_IDCOTIZACION, $this->getCaIdcotizacion());

		return CotProductoPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a CotProducto object to this object
	 * through the CotProducto foreign key attribute
	 *
	 * @param      CotProducto $l CotProducto
	 * @return     void
	 * @throws     PropelException
	 */
	public function addCotProducto(CotProducto $l)
	{
		$this->collCotProductos[] = $l;
		$l->setCotizacion($this);
	}

	/**
	 * Temporary storage of collCotContinuacions to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initCotContinuacions()
	{
		if ($this->collCotContinuacions === null) {
			$this->collCotContinuacions = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Cotizacion has previously
	 * been saved, it will retrieve related CotContinuacions from storage.
	 * If this Cotizacion is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getCotContinuacions($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotContinuacions === null) {
			if ($this->isNew()) {
			   $this->collCotContinuacions = array();
			} else {

				$criteria->add(CotContinuacionPeer::CA_IDCOTIZACION, $this->getCaIdcotizacion());

				CotContinuacionPeer::addSelectColumns($criteria);
				$this->collCotContinuacions = CotContinuacionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CotContinuacionPeer::CA_IDCOTIZACION, $this->getCaIdcotizacion());

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
	 * Returns the number of related CotContinuacions.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countCotContinuacions($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CotContinuacionPeer::CA_IDCOTIZACION, $this->getCaIdcotizacion());

		return CotContinuacionPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a CotContinuacion object to this object
	 * through the CotContinuacion foreign key attribute
	 *
	 * @param      CotContinuacion $l CotContinuacion
	 * @return     void
	 * @throws     PropelException
	 */
	public function addCotContinuacion(CotContinuacion $l)
	{
		$this->collCotContinuacions[] = $l;
		$l->setCotizacion($this);
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
	public function getCotContinuacionsJoinConcepto($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotContinuacions === null) {
			if ($this->isNew()) {
				$this->collCotContinuacions = array();
			} else {

				$criteria->add(CotContinuacionPeer::CA_IDCOTIZACION, $this->getCaIdcotizacion());

				$this->collCotContinuacions = CotContinuacionPeer::doSelectJoinConcepto($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CotContinuacionPeer::CA_IDCOTIZACION, $this->getCaIdcotizacion());

			if (!isset($this->lastCotContinuacionCriteria) || !$this->lastCotContinuacionCriteria->equals($criteria)) {
				$this->collCotContinuacions = CotContinuacionPeer::doSelectJoinConcepto($criteria, $con);
			}
		}
		$this->lastCotContinuacionCriteria = $criteria;

		return $this->collCotContinuacions;
	}

	/**
	 * Temporary storage of collCotSeguros to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initCotSeguros()
	{
		if ($this->collCotSeguros === null) {
			$this->collCotSeguros = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Cotizacion has previously
	 * been saved, it will retrieve related CotSeguros from storage.
	 * If this Cotizacion is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getCotSeguros($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotSeguros === null) {
			if ($this->isNew()) {
			   $this->collCotSeguros = array();
			} else {

				$criteria->add(CotSeguroPeer::CA_IDCOTIZACION, $this->getCaIdcotizacion());

				CotSeguroPeer::addSelectColumns($criteria);
				$this->collCotSeguros = CotSeguroPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CotSeguroPeer::CA_IDCOTIZACION, $this->getCaIdcotizacion());

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
	 * Returns the number of related CotSeguros.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countCotSeguros($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CotSeguroPeer::CA_IDCOTIZACION, $this->getCaIdcotizacion());

		return CotSeguroPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a CotSeguro object to this object
	 * through the CotSeguro foreign key attribute
	 *
	 * @param      CotSeguro $l CotSeguro
	 * @return     void
	 * @throws     PropelException
	 */
	public function addCotSeguro(CotSeguro $l)
	{
		$this->collCotSeguros[] = $l;
		$l->setCotizacion($this);
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
	public function getCotSegurosJoinMoneda($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotSeguros === null) {
			if ($this->isNew()) {
				$this->collCotSeguros = array();
			} else {

				$criteria->add(CotSeguroPeer::CA_IDCOTIZACION, $this->getCaIdcotizacion());

				$this->collCotSeguros = CotSeguroPeer::doSelectJoinMoneda($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CotSeguroPeer::CA_IDCOTIZACION, $this->getCaIdcotizacion());

			if (!isset($this->lastCotSeguroCriteria) || !$this->lastCotSeguroCriteria->equals($criteria)) {
				$this->collCotSeguros = CotSeguroPeer::doSelectJoinMoneda($criteria, $con);
			}
		}
		$this->lastCotSeguroCriteria = $criteria;

		return $this->collCotSeguros;
	}

} // BaseCotizacion
