<?php

/**
 * Base class that represents a row from the 'tb_repstatus' table.
 *
 * 
 *
 * @package    lib.model.reportes.om
 */
abstract class BaseRepStatus extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        RepStatusPeer
	 */
	protected static $peer;


	/**
	 * The value for the ca_idreporte field.
	 * @var        int
	 */
	protected $ca_idreporte;


	/**
	 * The value for the ca_idemail field.
	 * @var        int
	 */
	protected $ca_idemail;


	/**
	 * The value for the ca_fchstatus field.
	 * @var        int
	 */
	protected $ca_fchstatus;


	/**
	 * The value for the ca_status field.
	 * @var        string
	 */
	protected $ca_status;


	/**
	 * The value for the ca_comentarios field.
	 * @var        string
	 */
	protected $ca_comentarios;


	/**
	 * The value for the ca_fchrecibo field.
	 * @var        int
	 */
	protected $ca_fchrecibo;


	/**
	 * The value for the ca_fchenvio field.
	 * @var        int
	 */
	protected $ca_fchenvio;


	/**
	 * The value for the ca_usuenvio field.
	 * @var        string
	 */
	protected $ca_usuenvio;


	/**
	 * The value for the ca_etapa field.
	 * @var        string
	 */
	protected $ca_etapa;


	/**
	 * The value for the ca_introduccion field.
	 * @var        string
	 */
	protected $ca_introduccion;


	/**
	 * The value for the ca_fchsalida field.
	 * @var        int
	 */
	protected $ca_fchsalida;


	/**
	 * The value for the ca_fchllegada field.
	 * @var        int
	 */
	protected $ca_fchllegada;


	/**
	 * The value for the ca_fchcontinuacion field.
	 * @var        string
	 */
	protected $ca_fchcontinuacion;


	/**
	 * The value for the ca_piezas field.
	 * @var        string
	 */
	protected $ca_piezas;


	/**
	 * The value for the ca_peso field.
	 * @var        string
	 */
	protected $ca_peso;


	/**
	 * The value for the ca_volumen field.
	 * @var        string
	 */
	protected $ca_volumen;


	/**
	 * The value for the ca_doctransporte field.
	 * @var        string
	 */
	protected $ca_doctransporte;


	/**
	 * The value for the ca_idnave field.
	 * @var        string
	 */
	protected $ca_idnave;


	/**
	 * The value for the ca_docmaster field.
	 * @var        string
	 */
	protected $ca_docmaster;


	/**
	 * The value for the ca_fchreserva field.
	 * @var        int
	 */
	protected $ca_fchreserva;


	/**
	 * The value for the ca_fchcierrereserva field.
	 * @var        int
	 */
	protected $ca_fchcierrereserva;


	/**
	 * The value for the ca_equipos field.
	 * @var        string
	 */
	protected $ca_equipos;


	/**
	 * The value for the ca_horasalida field.
	 * @var        int
	 */
	protected $ca_horasalida;


	/**
	 * The value for the ca_horallegada field.
	 * @var        int
	 */
	protected $ca_horallegada;

	/**
	 * @var        Reporte
	 */
	protected $aReporte;

	/**
	 * @var        Email
	 */
	protected $aEmail;

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
	 * Get the [ca_idreporte] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdreporte()
	{

		return $this->ca_idreporte;
	}

	/**
	 * Get the [ca_idemail] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdemail()
	{

		return $this->ca_idemail;
	}

	/**
	 * Get the [optionally formatted] [ca_fchstatus] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchstatus($format = 'Y-m-d')
	{

		if ($this->ca_fchstatus === null || $this->ca_fchstatus === '') {
			return null;
		} elseif (!is_int($this->ca_fchstatus)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_fchstatus);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_fchstatus] as date/time value: " . var_export($this->ca_fchstatus, true));
			}
		} else {
			$ts = $this->ca_fchstatus;
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
	 * Get the [ca_status] column value.
	 * 
	 * @return     string
	 */
	public function getCaStatus()
	{

		return $this->ca_status;
	}

	/**
	 * Get the [ca_comentarios] column value.
	 * 
	 * @return     string
	 */
	public function getCaComentarios()
	{

		return $this->ca_comentarios;
	}

	/**
	 * Get the [optionally formatted] [ca_fchrecibo] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchrecibo($format = 'Y-m-d H:i:s')
	{

		if ($this->ca_fchrecibo === null || $this->ca_fchrecibo === '') {
			return null;
		} elseif (!is_int($this->ca_fchrecibo)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_fchrecibo);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_fchrecibo] as date/time value: " . var_export($this->ca_fchrecibo, true));
			}
		} else {
			$ts = $this->ca_fchrecibo;
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
	 * Get the [optionally formatted] [ca_fchenvio] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchenvio($format = 'Y-m-d H:i:s')
	{

		if ($this->ca_fchenvio === null || $this->ca_fchenvio === '') {
			return null;
		} elseif (!is_int($this->ca_fchenvio)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_fchenvio);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_fchenvio] as date/time value: " . var_export($this->ca_fchenvio, true));
			}
		} else {
			$ts = $this->ca_fchenvio;
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
	 * Get the [ca_usuenvio] column value.
	 * 
	 * @return     string
	 */
	public function getCaUsuenvio()
	{

		return $this->ca_usuenvio;
	}

	/**
	 * Get the [ca_etapa] column value.
	 * 
	 * @return     string
	 */
	public function getCaEtapa()
	{

		return $this->ca_etapa;
	}

	/**
	 * Get the [ca_introduccion] column value.
	 * 
	 * @return     string
	 */
	public function getCaIntroduccion()
	{

		return $this->ca_introduccion;
	}

	/**
	 * Get the [optionally formatted] [ca_fchsalida] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchsalida($format = 'Y-m-d')
	{

		if ($this->ca_fchsalida === null || $this->ca_fchsalida === '') {
			return null;
		} elseif (!is_int($this->ca_fchsalida)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_fchsalida);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_fchsalida] as date/time value: " . var_export($this->ca_fchsalida, true));
			}
		} else {
			$ts = $this->ca_fchsalida;
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
	 * Get the [optionally formatted] [ca_fchllegada] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchllegada($format = 'Y-m-d')
	{

		if ($this->ca_fchllegada === null || $this->ca_fchllegada === '') {
			return null;
		} elseif (!is_int($this->ca_fchllegada)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_fchllegada);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_fchllegada] as date/time value: " . var_export($this->ca_fchllegada, true));
			}
		} else {
			$ts = $this->ca_fchllegada;
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
	 * Get the [ca_fchcontinuacion] column value.
	 * 
	 * @return     string
	 */
	public function getCaFchcontinuacion()
	{

		return $this->ca_fchcontinuacion;
	}

	/**
	 * Get the [ca_piezas] column value.
	 * 
	 * @return     string
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
	 * Get the [ca_volumen] column value.
	 * 
	 * @return     string
	 */
	public function getCaVolumen()
	{

		return $this->ca_volumen;
	}

	/**
	 * Get the [ca_doctransporte] column value.
	 * 
	 * @return     string
	 */
	public function getCaDoctransporte()
	{

		return $this->ca_doctransporte;
	}

	/**
	 * Get the [ca_idnave] column value.
	 * 
	 * @return     string
	 */
	public function getCaIdnave()
	{

		return $this->ca_idnave;
	}

	/**
	 * Get the [ca_docmaster] column value.
	 * 
	 * @return     string
	 */
	public function getCaDocmaster()
	{

		return $this->ca_docmaster;
	}

	/**
	 * Get the [optionally formatted] [ca_fchreserva] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchreserva($format = 'Y-m-d')
	{

		if ($this->ca_fchreserva === null || $this->ca_fchreserva === '') {
			return null;
		} elseif (!is_int($this->ca_fchreserva)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_fchreserva);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_fchreserva] as date/time value: " . var_export($this->ca_fchreserva, true));
			}
		} else {
			$ts = $this->ca_fchreserva;
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
	 * Get the [optionally formatted] [ca_fchcierrereserva] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchcierrereserva($format = 'Y-m-d')
	{

		if ($this->ca_fchcierrereserva === null || $this->ca_fchcierrereserva === '') {
			return null;
		} elseif (!is_int($this->ca_fchcierrereserva)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_fchcierrereserva);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_fchcierrereserva] as date/time value: " . var_export($this->ca_fchcierrereserva, true));
			}
		} else {
			$ts = $this->ca_fchcierrereserva;
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
	 * Get the [ca_equipos] column value.
	 * 
	 * @return     string
	 */
	public function getCaEquipos()
	{

		return $this->ca_equipos;
	}

	/**
	 * Get the [optionally formatted] [ca_horasalida] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaHorasalida($format = 'H:i:s')
	{

		if ($this->ca_horasalida === null || $this->ca_horasalida === '') {
			return null;
		} elseif (!is_int($this->ca_horasalida)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_horasalida);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_horasalida] as date/time value: " . var_export($this->ca_horasalida, true));
			}
		} else {
			$ts = $this->ca_horasalida;
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
	 * Get the [optionally formatted] [ca_horallegada] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaHorallegada($format = 'H:i:s')
	{

		if ($this->ca_horallegada === null || $this->ca_horallegada === '') {
			return null;
		} elseif (!is_int($this->ca_horallegada)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_horallegada);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_horallegada] as date/time value: " . var_export($this->ca_horallegada, true));
			}
		} else {
			$ts = $this->ca_horallegada;
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
			$this->modifiedColumns[] = RepStatusPeer::CA_IDREPORTE;
		}

		if ($this->aReporte !== null && $this->aReporte->getCaIdreporte() !== $v) {
			$this->aReporte = null;
		}

	} // setCaIdreporte()

	/**
	 * Set the value of [ca_idemail] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdemail($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idemail !== $v) {
			$this->ca_idemail = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_IDEMAIL;
		}

		if ($this->aEmail !== null && $this->aEmail->getCaIdemail() !== $v) {
			$this->aEmail = null;
		}

	} // setCaIdemail()

	/**
	 * Set the value of [ca_fchstatus] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaFchstatus($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_fchstatus] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_fchstatus !== $ts) {
			$this->ca_fchstatus = $ts;
			$this->modifiedColumns[] = RepStatusPeer::CA_FCHSTATUS;
		}

	} // setCaFchstatus()

	/**
	 * Set the value of [ca_status] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaStatus($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_status !== $v) {
			$this->ca_status = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_STATUS;
		}

	} // setCaStatus()

	/**
	 * Set the value of [ca_comentarios] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaComentarios($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_comentarios !== $v) {
			$this->ca_comentarios = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_COMENTARIOS;
		}

	} // setCaComentarios()

	/**
	 * Set the value of [ca_fchrecibo] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaFchrecibo($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_fchrecibo] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_fchrecibo !== $ts) {
			$this->ca_fchrecibo = $ts;
			$this->modifiedColumns[] = RepStatusPeer::CA_FCHRECIBO;
		}

	} // setCaFchrecibo()

	/**
	 * Set the value of [ca_fchenvio] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaFchenvio($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_fchenvio] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_fchenvio !== $ts) {
			$this->ca_fchenvio = $ts;
			$this->modifiedColumns[] = RepStatusPeer::CA_FCHENVIO;
		}

	} // setCaFchenvio()

	/**
	 * Set the value of [ca_usuenvio] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaUsuenvio($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_usuenvio !== $v) {
			$this->ca_usuenvio = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_USUENVIO;
		}

	} // setCaUsuenvio()

	/**
	 * Set the value of [ca_etapa] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaEtapa($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_etapa !== $v) {
			$this->ca_etapa = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_ETAPA;
		}

	} // setCaEtapa()

	/**
	 * Set the value of [ca_introduccion] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaIntroduccion($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_introduccion !== $v) {
			$this->ca_introduccion = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_INTRODUCCION;
		}

	} // setCaIntroduccion()

	/**
	 * Set the value of [ca_fchsalida] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaFchsalida($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_fchsalida] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_fchsalida !== $ts) {
			$this->ca_fchsalida = $ts;
			$this->modifiedColumns[] = RepStatusPeer::CA_FCHSALIDA;
		}

	} // setCaFchsalida()

	/**
	 * Set the value of [ca_fchllegada] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaFchllegada($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_fchllegada] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_fchllegada !== $ts) {
			$this->ca_fchllegada = $ts;
			$this->modifiedColumns[] = RepStatusPeer::CA_FCHLLEGADA;
		}

	} // setCaFchllegada()

	/**
	 * Set the value of [ca_fchcontinuacion] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaFchcontinuacion($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_fchcontinuacion !== $v) {
			$this->ca_fchcontinuacion = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_FCHCONTINUACION;
		}

	} // setCaFchcontinuacion()

	/**
	 * Set the value of [ca_piezas] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaPiezas($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_piezas !== $v) {
			$this->ca_piezas = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_PIEZAS;
		}

	} // setCaPiezas()

	/**
	 * Set the value of [ca_peso] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaPeso($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_peso !== $v) {
			$this->ca_peso = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_PESO;
		}

	} // setCaPeso()

	/**
	 * Set the value of [ca_volumen] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaVolumen($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_volumen !== $v) {
			$this->ca_volumen = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_VOLUMEN;
		}

	} // setCaVolumen()

	/**
	 * Set the value of [ca_doctransporte] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaDoctransporte($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_doctransporte !== $v) {
			$this->ca_doctransporte = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_DOCTRANSPORTE;
		}

	} // setCaDoctransporte()

	/**
	 * Set the value of [ca_idnave] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaIdnave($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_idnave !== $v) {
			$this->ca_idnave = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_IDNAVE;
		}

	} // setCaIdnave()

	/**
	 * Set the value of [ca_docmaster] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaDocmaster($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_docmaster !== $v) {
			$this->ca_docmaster = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_DOCMASTER;
		}

	} // setCaDocmaster()

	/**
	 * Set the value of [ca_fchreserva] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaFchreserva($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_fchreserva] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_fchreserva !== $ts) {
			$this->ca_fchreserva = $ts;
			$this->modifiedColumns[] = RepStatusPeer::CA_FCHRESERVA;
		}

	} // setCaFchreserva()

	/**
	 * Set the value of [ca_fchcierrereserva] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaFchcierrereserva($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_fchcierrereserva] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_fchcierrereserva !== $ts) {
			$this->ca_fchcierrereserva = $ts;
			$this->modifiedColumns[] = RepStatusPeer::CA_FCHCIERRERESERVA;
		}

	} // setCaFchcierrereserva()

	/**
	 * Set the value of [ca_equipos] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaEquipos($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_equipos !== $v) {
			$this->ca_equipos = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_EQUIPOS;
		}

	} // setCaEquipos()

	/**
	 * Set the value of [ca_horasalida] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaHorasalida($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_horasalida] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_horasalida !== $ts) {
			$this->ca_horasalida = $ts;
			$this->modifiedColumns[] = RepStatusPeer::CA_HORASALIDA;
		}

	} // setCaHorasalida()

	/**
	 * Set the value of [ca_horallegada] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaHorallegada($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_horallegada] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_horallegada !== $ts) {
			$this->ca_horallegada = $ts;
			$this->modifiedColumns[] = RepStatusPeer::CA_HORALLEGADA;
		}

	} // setCaHorallegada()

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

			$this->ca_idreporte = $rs->getInt($startcol + 0);

			$this->ca_idemail = $rs->getInt($startcol + 1);

			$this->ca_fchstatus = $rs->getDate($startcol + 2, null);

			$this->ca_status = $rs->getString($startcol + 3);

			$this->ca_comentarios = $rs->getString($startcol + 4);

			$this->ca_fchrecibo = $rs->getTimestamp($startcol + 5, null);

			$this->ca_fchenvio = $rs->getTimestamp($startcol + 6, null);

			$this->ca_usuenvio = $rs->getString($startcol + 7);

			$this->ca_etapa = $rs->getString($startcol + 8);

			$this->ca_introduccion = $rs->getString($startcol + 9);

			$this->ca_fchsalida = $rs->getDate($startcol + 10, null);

			$this->ca_fchllegada = $rs->getDate($startcol + 11, null);

			$this->ca_fchcontinuacion = $rs->getString($startcol + 12);

			$this->ca_piezas = $rs->getString($startcol + 13);

			$this->ca_peso = $rs->getString($startcol + 14);

			$this->ca_volumen = $rs->getString($startcol + 15);

			$this->ca_doctransporte = $rs->getString($startcol + 16);

			$this->ca_idnave = $rs->getString($startcol + 17);

			$this->ca_docmaster = $rs->getString($startcol + 18);

			$this->ca_fchreserva = $rs->getDate($startcol + 19, null);

			$this->ca_fchcierrereserva = $rs->getDate($startcol + 20, null);

			$this->ca_equipos = $rs->getString($startcol + 21);

			$this->ca_horasalida = $rs->getTime($startcol + 22, null);

			$this->ca_horallegada = $rs->getTime($startcol + 23, null);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 24; // 24 = RepStatusPeer::NUM_COLUMNS - RepStatusPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating RepStatus object", $e);
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
			$con = Propel::getConnection(RepStatusPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			RepStatusPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(RepStatusPeer::DATABASE_NAME);
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

			if ($this->aEmail !== null) {
				if ($this->aEmail->isModified()) {
					$affectedRows += $this->aEmail->save($con);
				}
				$this->setEmail($this->aEmail);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = RepStatusPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += RepStatusPeer::doUpdate($this, $con);
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

			if ($this->aEmail !== null) {
				if (!$this->aEmail->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aEmail->getValidationFailures());
				}
			}


			if (($retval = RepStatusPeer::doValidate($this, $columns)) !== true) {
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
		$pos = RepStatusPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdreporte();
				break;
			case 1:
				return $this->getCaIdemail();
				break;
			case 2:
				return $this->getCaFchstatus();
				break;
			case 3:
				return $this->getCaStatus();
				break;
			case 4:
				return $this->getCaComentarios();
				break;
			case 5:
				return $this->getCaFchrecibo();
				break;
			case 6:
				return $this->getCaFchenvio();
				break;
			case 7:
				return $this->getCaUsuenvio();
				break;
			case 8:
				return $this->getCaEtapa();
				break;
			case 9:
				return $this->getCaIntroduccion();
				break;
			case 10:
				return $this->getCaFchsalida();
				break;
			case 11:
				return $this->getCaFchllegada();
				break;
			case 12:
				return $this->getCaFchcontinuacion();
				break;
			case 13:
				return $this->getCaPiezas();
				break;
			case 14:
				return $this->getCaPeso();
				break;
			case 15:
				return $this->getCaVolumen();
				break;
			case 16:
				return $this->getCaDoctransporte();
				break;
			case 17:
				return $this->getCaIdnave();
				break;
			case 18:
				return $this->getCaDocmaster();
				break;
			case 19:
				return $this->getCaFchreserva();
				break;
			case 20:
				return $this->getCaFchcierrereserva();
				break;
			case 21:
				return $this->getCaEquipos();
				break;
			case 22:
				return $this->getCaHorasalida();
				break;
			case 23:
				return $this->getCaHorallegada();
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
		$keys = RepStatusPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdreporte(),
			$keys[1] => $this->getCaIdemail(),
			$keys[2] => $this->getCaFchstatus(),
			$keys[3] => $this->getCaStatus(),
			$keys[4] => $this->getCaComentarios(),
			$keys[5] => $this->getCaFchrecibo(),
			$keys[6] => $this->getCaFchenvio(),
			$keys[7] => $this->getCaUsuenvio(),
			$keys[8] => $this->getCaEtapa(),
			$keys[9] => $this->getCaIntroduccion(),
			$keys[10] => $this->getCaFchsalida(),
			$keys[11] => $this->getCaFchllegada(),
			$keys[12] => $this->getCaFchcontinuacion(),
			$keys[13] => $this->getCaPiezas(),
			$keys[14] => $this->getCaPeso(),
			$keys[15] => $this->getCaVolumen(),
			$keys[16] => $this->getCaDoctransporte(),
			$keys[17] => $this->getCaIdnave(),
			$keys[18] => $this->getCaDocmaster(),
			$keys[19] => $this->getCaFchreserva(),
			$keys[20] => $this->getCaFchcierrereserva(),
			$keys[21] => $this->getCaEquipos(),
			$keys[22] => $this->getCaHorasalida(),
			$keys[23] => $this->getCaHorallegada(),
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
		$pos = RepStatusPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdreporte($value);
				break;
			case 1:
				$this->setCaIdemail($value);
				break;
			case 2:
				$this->setCaFchstatus($value);
				break;
			case 3:
				$this->setCaStatus($value);
				break;
			case 4:
				$this->setCaComentarios($value);
				break;
			case 5:
				$this->setCaFchrecibo($value);
				break;
			case 6:
				$this->setCaFchenvio($value);
				break;
			case 7:
				$this->setCaUsuenvio($value);
				break;
			case 8:
				$this->setCaEtapa($value);
				break;
			case 9:
				$this->setCaIntroduccion($value);
				break;
			case 10:
				$this->setCaFchsalida($value);
				break;
			case 11:
				$this->setCaFchllegada($value);
				break;
			case 12:
				$this->setCaFchcontinuacion($value);
				break;
			case 13:
				$this->setCaPiezas($value);
				break;
			case 14:
				$this->setCaPeso($value);
				break;
			case 15:
				$this->setCaVolumen($value);
				break;
			case 16:
				$this->setCaDoctransporte($value);
				break;
			case 17:
				$this->setCaIdnave($value);
				break;
			case 18:
				$this->setCaDocmaster($value);
				break;
			case 19:
				$this->setCaFchreserva($value);
				break;
			case 20:
				$this->setCaFchcierrereserva($value);
				break;
			case 21:
				$this->setCaEquipos($value);
				break;
			case 22:
				$this->setCaHorasalida($value);
				break;
			case 23:
				$this->setCaHorallegada($value);
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
		$keys = RepStatusPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdreporte($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdemail($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaFchstatus($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaStatus($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaComentarios($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaFchrecibo($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaFchenvio($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaUsuenvio($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaEtapa($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaIntroduccion($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaFchsalida($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaFchllegada($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaFchcontinuacion($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaPiezas($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaPeso($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaVolumen($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCaDoctransporte($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setCaIdnave($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setCaDocmaster($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setCaFchreserva($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setCaFchcierrereserva($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setCaEquipos($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setCaHorasalida($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setCaHorallegada($arr[$keys[23]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(RepStatusPeer::DATABASE_NAME);

		if ($this->isColumnModified(RepStatusPeer::CA_IDREPORTE)) $criteria->add(RepStatusPeer::CA_IDREPORTE, $this->ca_idreporte);
		if ($this->isColumnModified(RepStatusPeer::CA_IDEMAIL)) $criteria->add(RepStatusPeer::CA_IDEMAIL, $this->ca_idemail);
		if ($this->isColumnModified(RepStatusPeer::CA_FCHSTATUS)) $criteria->add(RepStatusPeer::CA_FCHSTATUS, $this->ca_fchstatus);
		if ($this->isColumnModified(RepStatusPeer::CA_STATUS)) $criteria->add(RepStatusPeer::CA_STATUS, $this->ca_status);
		if ($this->isColumnModified(RepStatusPeer::CA_COMENTARIOS)) $criteria->add(RepStatusPeer::CA_COMENTARIOS, $this->ca_comentarios);
		if ($this->isColumnModified(RepStatusPeer::CA_FCHRECIBO)) $criteria->add(RepStatusPeer::CA_FCHRECIBO, $this->ca_fchrecibo);
		if ($this->isColumnModified(RepStatusPeer::CA_FCHENVIO)) $criteria->add(RepStatusPeer::CA_FCHENVIO, $this->ca_fchenvio);
		if ($this->isColumnModified(RepStatusPeer::CA_USUENVIO)) $criteria->add(RepStatusPeer::CA_USUENVIO, $this->ca_usuenvio);
		if ($this->isColumnModified(RepStatusPeer::CA_ETAPA)) $criteria->add(RepStatusPeer::CA_ETAPA, $this->ca_etapa);
		if ($this->isColumnModified(RepStatusPeer::CA_INTRODUCCION)) $criteria->add(RepStatusPeer::CA_INTRODUCCION, $this->ca_introduccion);
		if ($this->isColumnModified(RepStatusPeer::CA_FCHSALIDA)) $criteria->add(RepStatusPeer::CA_FCHSALIDA, $this->ca_fchsalida);
		if ($this->isColumnModified(RepStatusPeer::CA_FCHLLEGADA)) $criteria->add(RepStatusPeer::CA_FCHLLEGADA, $this->ca_fchllegada);
		if ($this->isColumnModified(RepStatusPeer::CA_FCHCONTINUACION)) $criteria->add(RepStatusPeer::CA_FCHCONTINUACION, $this->ca_fchcontinuacion);
		if ($this->isColumnModified(RepStatusPeer::CA_PIEZAS)) $criteria->add(RepStatusPeer::CA_PIEZAS, $this->ca_piezas);
		if ($this->isColumnModified(RepStatusPeer::CA_PESO)) $criteria->add(RepStatusPeer::CA_PESO, $this->ca_peso);
		if ($this->isColumnModified(RepStatusPeer::CA_VOLUMEN)) $criteria->add(RepStatusPeer::CA_VOLUMEN, $this->ca_volumen);
		if ($this->isColumnModified(RepStatusPeer::CA_DOCTRANSPORTE)) $criteria->add(RepStatusPeer::CA_DOCTRANSPORTE, $this->ca_doctransporte);
		if ($this->isColumnModified(RepStatusPeer::CA_IDNAVE)) $criteria->add(RepStatusPeer::CA_IDNAVE, $this->ca_idnave);
		if ($this->isColumnModified(RepStatusPeer::CA_DOCMASTER)) $criteria->add(RepStatusPeer::CA_DOCMASTER, $this->ca_docmaster);
		if ($this->isColumnModified(RepStatusPeer::CA_FCHRESERVA)) $criteria->add(RepStatusPeer::CA_FCHRESERVA, $this->ca_fchreserva);
		if ($this->isColumnModified(RepStatusPeer::CA_FCHCIERRERESERVA)) $criteria->add(RepStatusPeer::CA_FCHCIERRERESERVA, $this->ca_fchcierrereserva);
		if ($this->isColumnModified(RepStatusPeer::CA_EQUIPOS)) $criteria->add(RepStatusPeer::CA_EQUIPOS, $this->ca_equipos);
		if ($this->isColumnModified(RepStatusPeer::CA_HORASALIDA)) $criteria->add(RepStatusPeer::CA_HORASALIDA, $this->ca_horasalida);
		if ($this->isColumnModified(RepStatusPeer::CA_HORALLEGADA)) $criteria->add(RepStatusPeer::CA_HORALLEGADA, $this->ca_horallegada);

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
		$criteria = new Criteria(RepStatusPeer::DATABASE_NAME);

		$criteria->add(RepStatusPeer::CA_IDREPORTE, $this->ca_idreporte);
		$criteria->add(RepStatusPeer::CA_IDEMAIL, $this->ca_idemail);

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

		$pks[0] = $this->getCaIdreporte();

		$pks[1] = $this->getCaIdemail();

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

		$this->setCaIdreporte($keys[0]);

		$this->setCaIdemail($keys[1]);

	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of RepStatus (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaFchstatus($this->ca_fchstatus);

		$copyObj->setCaStatus($this->ca_status);

		$copyObj->setCaComentarios($this->ca_comentarios);

		$copyObj->setCaFchrecibo($this->ca_fchrecibo);

		$copyObj->setCaFchenvio($this->ca_fchenvio);

		$copyObj->setCaUsuenvio($this->ca_usuenvio);

		$copyObj->setCaEtapa($this->ca_etapa);

		$copyObj->setCaIntroduccion($this->ca_introduccion);

		$copyObj->setCaFchsalida($this->ca_fchsalida);

		$copyObj->setCaFchllegada($this->ca_fchllegada);

		$copyObj->setCaFchcontinuacion($this->ca_fchcontinuacion);

		$copyObj->setCaPiezas($this->ca_piezas);

		$copyObj->setCaPeso($this->ca_peso);

		$copyObj->setCaVolumen($this->ca_volumen);

		$copyObj->setCaDoctransporte($this->ca_doctransporte);

		$copyObj->setCaIdnave($this->ca_idnave);

		$copyObj->setCaDocmaster($this->ca_docmaster);

		$copyObj->setCaFchreserva($this->ca_fchreserva);

		$copyObj->setCaFchcierrereserva($this->ca_fchcierrereserva);

		$copyObj->setCaEquipos($this->ca_equipos);

		$copyObj->setCaHorasalida($this->ca_horasalida);

		$copyObj->setCaHorallegada($this->ca_horallegada);


		$copyObj->setNew(true);

		$copyObj->setCaIdreporte(NULL); // this is a pkey column, so set to default value

		$copyObj->setCaIdemail(NULL); // this is a pkey column, so set to default value

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
	 * @return     RepStatus Clone of current object.
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
	 * @return     RepStatusPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new RepStatusPeer();
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
	 * Declares an association between this object and a Email object.
	 *
	 * @param      Email $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setEmail($v)
	{


		if ($v === null) {
			$this->setCaIdemail(NULL);
		} else {
			$this->setCaIdemail($v->getCaIdemail());
		}


		$this->aEmail = $v;
	}


	/**
	 * Get the associated Email object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Email The associated Email object.
	 * @throws     PropelException
	 */
	public function getEmail($con = null)
	{
		if ($this->aEmail === null && ($this->ca_idemail !== null)) {
			// include the related Peer class
			$this->aEmail = EmailPeer::retrieveByPK($this->ca_idemail, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = EmailPeer::retrieveByPK($this->ca_idemail, $con);
			   $obj->addEmails($this);
			 */
		}
		return $this->aEmail;
	}

} // BaseRepStatus
