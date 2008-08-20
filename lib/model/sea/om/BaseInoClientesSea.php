<?php

/**
 * Base class that represents a row from the 'tb_inoclientes_sea' table.
 *
 * 
 *
 * @package    lib.model.sea.om
 */
abstract class BaseInoClientesSea extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        InoClientesSeaPeer
	 */
	protected static $peer;


	/**
	 * The value for the oid field.
	 * @var        int
	 */
	protected $oid;


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
	 * The value for the ca_hbls field.
	 * @var        string
	 */
	protected $ca_hbls;


	/**
	 * The value for the ca_idreporte field.
	 * @var        int
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
	 * @var        double
	 */
	protected $ca_numpiezas;


	/**
	 * The value for the ca_peso field.
	 * @var        double
	 */
	protected $ca_peso;


	/**
	 * The value for the ca_volumen field.
	 * @var        double
	 */
	protected $ca_volumen;


	/**
	 * The value for the ca_numorden field.
	 * @var        string
	 */
	protected $ca_numorden;


	/**
	 * The value for the ca_confirmar field.
	 * @var        string
	 */
	protected $ca_confirmar;


	/**
	 * The value for the ca_login field.
	 * @var        string
	 */
	protected $ca_login;


	/**
	 * The value for the ca_observaciones field.
	 * @var        string
	 */
	protected $ca_observaciones;


	/**
	 * The value for the ca_fchliberacion field.
	 * @var        int
	 */
	protected $ca_fchliberacion;


	/**
	 * The value for the ca_notaliberacion field.
	 * @var        string
	 */
	protected $ca_notaliberacion;


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
	 * The value for the ca_fchliberado field.
	 * @var        int
	 */
	protected $ca_fchliberado;


	/**
	 * The value for the ca_usuliberado field.
	 * @var        string
	 */
	protected $ca_usuliberado;


	/**
	 * The value for the ca_mensaje field.
	 * @var        string
	 */
	protected $ca_mensaje;


	/**
	 * The value for the ca_continuacion field.
	 * @var        string
	 */
	protected $ca_continuacion;


	/**
	 * The value for the ca_continuacion_dest field.
	 * @var        string
	 */
	protected $ca_continuacion_dest;


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
	 * @var        InoMaestraSea
	 */
	protected $aInoMaestraSea;

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
	 * Get the [oid] column value.
	 * 
	 * @return     int
	 */
	public function getOid()
	{

		return $this->oid;
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
	 * Get the [ca_hbls] column value.
	 * 
	 * @return     string
	 */
	public function getCaHbls()
	{

		return $this->ca_hbls;
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
	 * @return     double
	 */
	public function getCaNumpiezas()
	{

		return $this->ca_numpiezas;
	}

	/**
	 * Get the [ca_peso] column value.
	 * 
	 * @return     double
	 */
	public function getCaPeso()
	{

		return $this->ca_peso;
	}

	/**
	 * Get the [ca_volumen] column value.
	 * 
	 * @return     double
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
	 * Get the [ca_confirmar] column value.
	 * 
	 * @return     string
	 */
	public function getCaConfirmar()
	{

		return $this->ca_confirmar;
	}

	/**
	 * Get the [ca_login] column value.
	 * 
	 * @return     string
	 */
	public function getCaLogin()
	{

		return $this->ca_login;
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
	 * Get the [optionally formatted] [ca_fchliberacion] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchliberacion($format = 'Y-m-d')
	{

		if ($this->ca_fchliberacion === null || $this->ca_fchliberacion === '') {
			return null;
		} elseif (!is_int($this->ca_fchliberacion)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_fchliberacion);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_fchliberacion] as date/time value: " . var_export($this->ca_fchliberacion, true));
			}
		} else {
			$ts = $this->ca_fchliberacion;
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
	 * Get the [ca_notaliberacion] column value.
	 * 
	 * @return     string
	 */
	public function getCaNotaliberacion()
	{

		return $this->ca_notaliberacion;
	}

	/**
	 * Get the [optionally formatted] [ca_fchcreado] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchcreado($format = 'Y-m-d H:i:s')
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
	public function getCaFchactualizado($format = 'Y-m-d H:i:s')
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
	 * Get the [optionally formatted] [ca_fchliberado] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchliberado($format = 'Y-m-d H:i:s')
	{

		if ($this->ca_fchliberado === null || $this->ca_fchliberado === '') {
			return null;
		} elseif (!is_int($this->ca_fchliberado)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_fchliberado);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_fchliberado] as date/time value: " . var_export($this->ca_fchliberado, true));
			}
		} else {
			$ts = $this->ca_fchliberado;
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
	 * Get the [ca_usuliberado] column value.
	 * 
	 * @return     string
	 */
	public function getCaUsuliberado()
	{

		return $this->ca_usuliberado;
	}

	/**
	 * Get the [ca_mensaje] column value.
	 * 
	 * @return     string
	 */
	public function getCaMensaje()
	{

		return $this->ca_mensaje;
	}

	/**
	 * Get the [ca_continuacion] column value.
	 * 
	 * @return     string
	 */
	public function getCaContinuacion()
	{

		return $this->ca_continuacion;
	}

	/**
	 * Get the [ca_continuacion_dest] column value.
	 * 
	 * @return     string
	 */
	public function getCaContinuacionDest()
	{

		return $this->ca_continuacion_dest;
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
	 * Set the value of [oid] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setOid($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->oid !== $v) {
			$this->oid = $v;
			$this->modifiedColumns[] = InoClientesSeaPeer::OID;
		}

	} // setOid()

	/**
	 * Set the value of [ca_referencia] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaReferencia($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_referencia !== $v) {
			$this->ca_referencia = $v;
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_REFERENCIA;
		}

		if ($this->aInoMaestraSea !== null && $this->aInoMaestraSea->getCaReferencia() !== $v) {
			$this->aInoMaestraSea = null;
		}

	} // setCaReferencia()

	/**
	 * Set the value of [ca_idcliente] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdcliente($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idcliente !== $v) {
			$this->ca_idcliente = $v;
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_IDCLIENTE;
		}

	} // setCaIdcliente()

	/**
	 * Set the value of [ca_hbls] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaHbls($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_hbls !== $v) {
			$this->ca_hbls = $v;
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_HBLS;
		}

	} // setCaHbls()

	/**
	 * Set the value of [ca_idreporte] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdreporte($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idreporte !== $v) {
			$this->ca_idreporte = $v;
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_IDREPORTE;
		}

		if ($this->aReporte !== null && $this->aReporte->getCaIdreporte() !== $v) {
			$this->aReporte = null;
		}

	} // setCaIdreporte()

	/**
	 * Set the value of [ca_idproveedor] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdproveedor($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idproveedor !== $v) {
			$this->ca_idproveedor = $v;
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_IDPROVEEDOR;
		}

		if ($this->aTercero !== null && $this->aTercero->getCaIdtercero() !== $v) {
			$this->aTercero = null;
		}

	} // setCaIdproveedor()

	/**
	 * Set the value of [ca_proveedor] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaProveedor($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_proveedor !== $v) {
			$this->ca_proveedor = $v;
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_PROVEEDOR;
		}

	} // setCaProveedor()

	/**
	 * Set the value of [ca_numpiezas] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaNumpiezas($v)
	{

		if ($this->ca_numpiezas !== $v) {
			$this->ca_numpiezas = $v;
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_NUMPIEZAS;
		}

	} // setCaNumpiezas()

	/**
	 * Set the value of [ca_peso] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaPeso($v)
	{

		if ($this->ca_peso !== $v) {
			$this->ca_peso = $v;
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_PESO;
		}

	} // setCaPeso()

	/**
	 * Set the value of [ca_volumen] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaVolumen($v)
	{

		if ($this->ca_volumen !== $v) {
			$this->ca_volumen = $v;
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_VOLUMEN;
		}

	} // setCaVolumen()

	/**
	 * Set the value of [ca_numorden] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaNumorden($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_numorden !== $v) {
			$this->ca_numorden = $v;
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_NUMORDEN;
		}

	} // setCaNumorden()

	/**
	 * Set the value of [ca_confirmar] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaConfirmar($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_confirmar !== $v) {
			$this->ca_confirmar = $v;
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_CONFIRMAR;
		}

	} // setCaConfirmar()

	/**
	 * Set the value of [ca_login] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaLogin($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_login !== $v) {
			$this->ca_login = $v;
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_LOGIN;
		}

	} // setCaLogin()

	/**
	 * Set the value of [ca_observaciones] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaObservaciones($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_observaciones !== $v) {
			$this->ca_observaciones = $v;
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_OBSERVACIONES;
		}

	} // setCaObservaciones()

	/**
	 * Set the value of [ca_fchliberacion] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaFchliberacion($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_fchliberacion] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_fchliberacion !== $ts) {
			$this->ca_fchliberacion = $ts;
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_FCHLIBERACION;
		}

	} // setCaFchliberacion()

	/**
	 * Set the value of [ca_notaliberacion] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaNotaliberacion($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_notaliberacion !== $v) {
			$this->ca_notaliberacion = $v;
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_NOTALIBERACION;
		}

	} // setCaNotaliberacion()

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
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_USUCREADO;
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
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_FCHACTUALIZADO;
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
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_USUACTUALIZADO;
		}

	} // setCaUsuactualizado()

	/**
	 * Set the value of [ca_fchliberado] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaFchliberado($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_fchliberado] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_fchliberado !== $ts) {
			$this->ca_fchliberado = $ts;
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_FCHLIBERADO;
		}

	} // setCaFchliberado()

	/**
	 * Set the value of [ca_usuliberado] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaUsuliberado($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_usuliberado !== $v) {
			$this->ca_usuliberado = $v;
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_USULIBERADO;
		}

	} // setCaUsuliberado()

	/**
	 * Set the value of [ca_mensaje] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaMensaje($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_mensaje !== $v) {
			$this->ca_mensaje = $v;
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_MENSAJE;
		}

	} // setCaMensaje()

	/**
	 * Set the value of [ca_continuacion] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaContinuacion($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_continuacion !== $v) {
			$this->ca_continuacion = $v;
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_CONTINUACION;
		}

	} // setCaContinuacion()

	/**
	 * Set the value of [ca_continuacion_dest] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaContinuacionDest($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_continuacion_dest !== $v) {
			$this->ca_continuacion_dest = $v;
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_CONTINUACION_DEST;
		}

	} // setCaContinuacionDest()

	/**
	 * Set the value of [ca_idbodega] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdbodega($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idbodega !== $v) {
			$this->ca_idbodega = $v;
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_IDBODEGA;
		}

	} // setCaIdbodega()

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

			$this->oid = $rs->getInt($startcol + 0);

			$this->ca_referencia = $rs->getString($startcol + 1);

			$this->ca_idcliente = $rs->getInt($startcol + 2);

			$this->ca_hbls = $rs->getString($startcol + 3);

			$this->ca_idreporte = $rs->getInt($startcol + 4);

			$this->ca_idproveedor = $rs->getInt($startcol + 5);

			$this->ca_proveedor = $rs->getString($startcol + 6);

			$this->ca_numpiezas = $rs->getFloat($startcol + 7);

			$this->ca_peso = $rs->getFloat($startcol + 8);

			$this->ca_volumen = $rs->getFloat($startcol + 9);

			$this->ca_numorden = $rs->getString($startcol + 10);

			$this->ca_confirmar = $rs->getString($startcol + 11);

			$this->ca_login = $rs->getString($startcol + 12);

			$this->ca_observaciones = $rs->getString($startcol + 13);

			$this->ca_fchliberacion = $rs->getDate($startcol + 14, null);

			$this->ca_notaliberacion = $rs->getString($startcol + 15);

			$this->ca_fchcreado = $rs->getTimestamp($startcol + 16, null);

			$this->ca_usucreado = $rs->getString($startcol + 17);

			$this->ca_fchactualizado = $rs->getTimestamp($startcol + 18, null);

			$this->ca_usuactualizado = $rs->getString($startcol + 19);

			$this->ca_fchliberado = $rs->getTimestamp($startcol + 20, null);

			$this->ca_usuliberado = $rs->getString($startcol + 21);

			$this->ca_mensaje = $rs->getString($startcol + 22);

			$this->ca_continuacion = $rs->getString($startcol + 23);

			$this->ca_continuacion_dest = $rs->getString($startcol + 24);

			$this->ca_idbodega = $rs->getInt($startcol + 25);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 26; // 26 = InoClientesSeaPeer::NUM_COLUMNS - InoClientesSeaPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating InoClientesSea object", $e);
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
			$con = Propel::getConnection(InoClientesSeaPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			InoClientesSeaPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(InoClientesSeaPeer::DATABASE_NAME);
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

			if ($this->aReporte !== null) {
				if ($this->aReporte->isModified()) {
					$affectedRows += $this->aReporte->save($con);
				}
				$this->setReporte($this->aReporte);
			}

			if ($this->aTercero !== null) {
				if ($this->aTercero->isModified()) {
					$affectedRows += $this->aTercero->save($con);
				}
				$this->setTercero($this->aTercero);
			}

			if ($this->aInoMaestraSea !== null) {
				if ($this->aInoMaestraSea->isModified()) {
					$affectedRows += $this->aInoMaestraSea->save($con);
				}
				$this->setInoMaestraSea($this->aInoMaestraSea);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = InoClientesSeaPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += InoClientesSeaPeer::doUpdate($this, $con);
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

			if ($this->aInoMaestraSea !== null) {
				if (!$this->aInoMaestraSea->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aInoMaestraSea->getValidationFailures());
				}
			}


			if (($retval = InoClientesSeaPeer::doValidate($this, $columns)) !== true) {
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
	 *                     one of the class type constants TYPE_PHPNAME,
	 *                     TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = InoClientesSeaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getOid();
				break;
			case 1:
				return $this->getCaReferencia();
				break;
			case 2:
				return $this->getCaIdcliente();
				break;
			case 3:
				return $this->getCaHbls();
				break;
			case 4:
				return $this->getCaIdreporte();
				break;
			case 5:
				return $this->getCaIdproveedor();
				break;
			case 6:
				return $this->getCaProveedor();
				break;
			case 7:
				return $this->getCaNumpiezas();
				break;
			case 8:
				return $this->getCaPeso();
				break;
			case 9:
				return $this->getCaVolumen();
				break;
			case 10:
				return $this->getCaNumorden();
				break;
			case 11:
				return $this->getCaConfirmar();
				break;
			case 12:
				return $this->getCaLogin();
				break;
			case 13:
				return $this->getCaObservaciones();
				break;
			case 14:
				return $this->getCaFchliberacion();
				break;
			case 15:
				return $this->getCaNotaliberacion();
				break;
			case 16:
				return $this->getCaFchcreado();
				break;
			case 17:
				return $this->getCaUsucreado();
				break;
			case 18:
				return $this->getCaFchactualizado();
				break;
			case 19:
				return $this->getCaUsuactualizado();
				break;
			case 20:
				return $this->getCaFchliberado();
				break;
			case 21:
				return $this->getCaUsuliberado();
				break;
			case 22:
				return $this->getCaMensaje();
				break;
			case 23:
				return $this->getCaContinuacion();
				break;
			case 24:
				return $this->getCaContinuacionDest();
				break;
			case 25:
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
	 * @param      string $keyType One of the class type constants TYPE_PHPNAME,
	 *                        TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = InoClientesSeaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getOid(),
			$keys[1] => $this->getCaReferencia(),
			$keys[2] => $this->getCaIdcliente(),
			$keys[3] => $this->getCaHbls(),
			$keys[4] => $this->getCaIdreporte(),
			$keys[5] => $this->getCaIdproveedor(),
			$keys[6] => $this->getCaProveedor(),
			$keys[7] => $this->getCaNumpiezas(),
			$keys[8] => $this->getCaPeso(),
			$keys[9] => $this->getCaVolumen(),
			$keys[10] => $this->getCaNumorden(),
			$keys[11] => $this->getCaConfirmar(),
			$keys[12] => $this->getCaLogin(),
			$keys[13] => $this->getCaObservaciones(),
			$keys[14] => $this->getCaFchliberacion(),
			$keys[15] => $this->getCaNotaliberacion(),
			$keys[16] => $this->getCaFchcreado(),
			$keys[17] => $this->getCaUsucreado(),
			$keys[18] => $this->getCaFchactualizado(),
			$keys[19] => $this->getCaUsuactualizado(),
			$keys[20] => $this->getCaFchliberado(),
			$keys[21] => $this->getCaUsuliberado(),
			$keys[22] => $this->getCaMensaje(),
			$keys[23] => $this->getCaContinuacion(),
			$keys[24] => $this->getCaContinuacionDest(),
			$keys[25] => $this->getCaIdbodega(),
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
		$pos = InoClientesSeaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaReferencia($value);
				break;
			case 2:
				$this->setCaIdcliente($value);
				break;
			case 3:
				$this->setCaHbls($value);
				break;
			case 4:
				$this->setCaIdreporte($value);
				break;
			case 5:
				$this->setCaIdproveedor($value);
				break;
			case 6:
				$this->setCaProveedor($value);
				break;
			case 7:
				$this->setCaNumpiezas($value);
				break;
			case 8:
				$this->setCaPeso($value);
				break;
			case 9:
				$this->setCaVolumen($value);
				break;
			case 10:
				$this->setCaNumorden($value);
				break;
			case 11:
				$this->setCaConfirmar($value);
				break;
			case 12:
				$this->setCaLogin($value);
				break;
			case 13:
				$this->setCaObservaciones($value);
				break;
			case 14:
				$this->setCaFchliberacion($value);
				break;
			case 15:
				$this->setCaNotaliberacion($value);
				break;
			case 16:
				$this->setCaFchcreado($value);
				break;
			case 17:
				$this->setCaUsucreado($value);
				break;
			case 18:
				$this->setCaFchactualizado($value);
				break;
			case 19:
				$this->setCaUsuactualizado($value);
				break;
			case 20:
				$this->setCaFchliberado($value);
				break;
			case 21:
				$this->setCaUsuliberado($value);
				break;
			case 22:
				$this->setCaMensaje($value);
				break;
			case 23:
				$this->setCaContinuacion($value);
				break;
			case 24:
				$this->setCaContinuacionDest($value);
				break;
			case 25:
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
	 * of the class type constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME,
	 * TYPE_NUM. The default key type is the column's phpname (e.g. 'authorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = InoClientesSeaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setOid($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaReferencia($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaIdcliente($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaHbls($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaIdreporte($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaIdproveedor($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaProveedor($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaNumpiezas($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaPeso($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaVolumen($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaNumorden($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaConfirmar($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaLogin($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaObservaciones($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaFchliberacion($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaNotaliberacion($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCaFchcreado($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setCaUsucreado($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setCaFchactualizado($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setCaUsuactualizado($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setCaFchliberado($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setCaUsuliberado($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setCaMensaje($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setCaContinuacion($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setCaContinuacionDest($arr[$keys[24]]);
		if (array_key_exists($keys[25], $arr)) $this->setCaIdbodega($arr[$keys[25]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(InoClientesSeaPeer::DATABASE_NAME);

		if ($this->isColumnModified(InoClientesSeaPeer::OID)) $criteria->add(InoClientesSeaPeer::OID, $this->oid);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_REFERENCIA)) $criteria->add(InoClientesSeaPeer::CA_REFERENCIA, $this->ca_referencia);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_IDCLIENTE)) $criteria->add(InoClientesSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_HBLS)) $criteria->add(InoClientesSeaPeer::CA_HBLS, $this->ca_hbls);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_IDREPORTE)) $criteria->add(InoClientesSeaPeer::CA_IDREPORTE, $this->ca_idreporte);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_IDPROVEEDOR)) $criteria->add(InoClientesSeaPeer::CA_IDPROVEEDOR, $this->ca_idproveedor);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_PROVEEDOR)) $criteria->add(InoClientesSeaPeer::CA_PROVEEDOR, $this->ca_proveedor);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_NUMPIEZAS)) $criteria->add(InoClientesSeaPeer::CA_NUMPIEZAS, $this->ca_numpiezas);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_PESO)) $criteria->add(InoClientesSeaPeer::CA_PESO, $this->ca_peso);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_VOLUMEN)) $criteria->add(InoClientesSeaPeer::CA_VOLUMEN, $this->ca_volumen);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_NUMORDEN)) $criteria->add(InoClientesSeaPeer::CA_NUMORDEN, $this->ca_numorden);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_CONFIRMAR)) $criteria->add(InoClientesSeaPeer::CA_CONFIRMAR, $this->ca_confirmar);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_LOGIN)) $criteria->add(InoClientesSeaPeer::CA_LOGIN, $this->ca_login);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_OBSERVACIONES)) $criteria->add(InoClientesSeaPeer::CA_OBSERVACIONES, $this->ca_observaciones);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_FCHLIBERACION)) $criteria->add(InoClientesSeaPeer::CA_FCHLIBERACION, $this->ca_fchliberacion);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_NOTALIBERACION)) $criteria->add(InoClientesSeaPeer::CA_NOTALIBERACION, $this->ca_notaliberacion);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_FCHCREADO)) $criteria->add(InoClientesSeaPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_USUCREADO)) $criteria->add(InoClientesSeaPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_FCHACTUALIZADO)) $criteria->add(InoClientesSeaPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_USUACTUALIZADO)) $criteria->add(InoClientesSeaPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_FCHLIBERADO)) $criteria->add(InoClientesSeaPeer::CA_FCHLIBERADO, $this->ca_fchliberado);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_USULIBERADO)) $criteria->add(InoClientesSeaPeer::CA_USULIBERADO, $this->ca_usuliberado);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_MENSAJE)) $criteria->add(InoClientesSeaPeer::CA_MENSAJE, $this->ca_mensaje);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_CONTINUACION)) $criteria->add(InoClientesSeaPeer::CA_CONTINUACION, $this->ca_continuacion);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_CONTINUACION_DEST)) $criteria->add(InoClientesSeaPeer::CA_CONTINUACION_DEST, $this->ca_continuacion_dest);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_IDBODEGA)) $criteria->add(InoClientesSeaPeer::CA_IDBODEGA, $this->ca_idbodega);

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
		$criteria = new Criteria(InoClientesSeaPeer::DATABASE_NAME);

		$criteria->add(InoClientesSeaPeer::CA_REFERENCIA, $this->ca_referencia);
		$criteria->add(InoClientesSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);
		$criteria->add(InoClientesSeaPeer::CA_HBLS, $this->ca_hbls);

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

		$pks[2] = $this->getCaHbls();

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

		$this->setCaHbls($keys[2]);

	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of InoClientesSea (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setOid($this->oid);

		$copyObj->setCaIdreporte($this->ca_idreporte);

		$copyObj->setCaIdproveedor($this->ca_idproveedor);

		$copyObj->setCaProveedor($this->ca_proveedor);

		$copyObj->setCaNumpiezas($this->ca_numpiezas);

		$copyObj->setCaPeso($this->ca_peso);

		$copyObj->setCaVolumen($this->ca_volumen);

		$copyObj->setCaNumorden($this->ca_numorden);

		$copyObj->setCaConfirmar($this->ca_confirmar);

		$copyObj->setCaLogin($this->ca_login);

		$copyObj->setCaObservaciones($this->ca_observaciones);

		$copyObj->setCaFchliberacion($this->ca_fchliberacion);

		$copyObj->setCaNotaliberacion($this->ca_notaliberacion);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);

		$copyObj->setCaFchliberado($this->ca_fchliberado);

		$copyObj->setCaUsuliberado($this->ca_usuliberado);

		$copyObj->setCaMensaje($this->ca_mensaje);

		$copyObj->setCaContinuacion($this->ca_continuacion);

		$copyObj->setCaContinuacionDest($this->ca_continuacion_dest);

		$copyObj->setCaIdbodega($this->ca_idbodega);


		$copyObj->setNew(true);

		$copyObj->setCaReferencia(NULL); // this is a pkey column, so set to default value

		$copyObj->setCaIdcliente(NULL); // this is a pkey column, so set to default value

		$copyObj->setCaHbls(NULL); // this is a pkey column, so set to default value

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
	 * @return     InoClientesSea Clone of current object.
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
	 * @return     InoClientesSeaPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new InoClientesSeaPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Reporte object.
	 *
	 * @param      Reporte $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setReporte($v)
	{


		if ($v === null) {
			$this->setCaIdreporte(NULL);
		} else {
			$this->setCaIdreporte($v->getCaIdreporte());
		}


		$this->aReporte = $v;
	}


	/**
	 * Get the associated Reporte object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Reporte The associated Reporte object.
	 * @throws     PropelException
	 */
	public function getReporte($con = null)
	{
		if ($this->aReporte === null && ($this->ca_idreporte !== null)) {
			// include the related Peer class
			$this->aReporte = ReportePeer::retrieveByPK($this->ca_idreporte, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = ReportePeer::retrieveByPK($this->ca_idreporte, $con);
			   $obj->addReportes($this);
			 */
		}
		return $this->aReporte;
	}

	/**
	 * Declares an association between this object and a Tercero object.
	 *
	 * @param      Tercero $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setTercero($v)
	{


		if ($v === null) {
			$this->setCaIdproveedor(NULL);
		} else {
			$this->setCaIdproveedor($v->getCaIdtercero());
		}


		$this->aTercero = $v;
	}


	/**
	 * Get the associated Tercero object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Tercero The associated Tercero object.
	 * @throws     PropelException
	 */
	public function getTercero($con = null)
	{
		if ($this->aTercero === null && ($this->ca_idproveedor !== null)) {
			// include the related Peer class
			$this->aTercero = TerceroPeer::retrieveByPK($this->ca_idproveedor, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = TerceroPeer::retrieveByPK($this->ca_idproveedor, $con);
			   $obj->addTerceros($this);
			 */
		}
		return $this->aTercero;
	}

	/**
	 * Declares an association between this object and a InoMaestraSea object.
	 *
	 * @param      InoMaestraSea $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setInoMaestraSea($v)
	{


		if ($v === null) {
			$this->setCaReferencia(NULL);
		} else {
			$this->setCaReferencia($v->getCaReferencia());
		}


		$this->aInoMaestraSea = $v;
	}


	/**
	 * Get the associated InoMaestraSea object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     InoMaestraSea The associated InoMaestraSea object.
	 * @throws     PropelException
	 */
	public function getInoMaestraSea($con = null)
	{
		if ($this->aInoMaestraSea === null && (($this->ca_referencia !== "" && $this->ca_referencia !== null))) {
			// include the related Peer class
			$this->aInoMaestraSea = InoMaestraSeaPeer::retrieveByPK($this->ca_referencia, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = InoMaestraSeaPeer::retrieveByPK($this->ca_referencia, $con);
			   $obj->addInoMaestraSeas($this);
			 */
		}
		return $this->aInoMaestraSea;
	}

} // BaseInoClientesSea
