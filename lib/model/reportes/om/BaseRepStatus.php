<?php

/**
 * Base class that represents a row from the 'tb_repstatus' table.
 *
 * 
 *
 * @package    lib.model.reportes.om
 */
abstract class BaseRepStatus extends BaseObject  implements Persistent {


  const PEER = 'RepStatusPeer';

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
	 * @var        string
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
	 * @var        string
	 */
	protected $ca_fchrecibo;

	/**
	 * The value for the ca_fchenvio field.
	 * @var        string
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
	 * @var        string
	 */
	protected $ca_fchsalida;

	/**
	 * The value for the ca_fchllegada field.
	 * @var        string
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
	 * @var        string
	 */
	protected $ca_fchreserva;

	/**
	 * The value for the ca_fchcierrereserva field.
	 * @var        string
	 */
	protected $ca_fchcierrereserva;

	/**
	 * The value for the ca_equipos field.
	 * @var        string
	 */
	protected $ca_equipos;

	/**
	 * The value for the ca_horasalida field.
	 * @var        string
	 */
	protected $ca_horasalida;

	/**
	 * The value for the ca_horallegada field.
	 * @var        string
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
	 * @var        array RepStatusRespuesta[] Collection to store aggregation of RepStatusRespuesta objects.
	 */
	protected $collRepStatusRespuestas;

	/**
	 * @var        Criteria The criteria used to select the current contents of collRepStatusRespuestas.
	 */
	private $lastRepStatusRespuestaCriteria = null;

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
	 * Initializes internal state of BaseRepStatus object.
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
	 * Get the [optionally formatted] temporal [ca_fchstatus] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaFchstatus($format = 'Y-m-d')
	{
		if ($this->ca_fchstatus === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchstatus);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchstatus, true), $x);
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
	 * Get the [ca_comentarios] column value.
	 * 
	 * @return     string
	 */
	public function getCaComentarios()
	{
		return $this->ca_comentarios;
	}

	/**
	 * Get the [optionally formatted] temporal [ca_fchrecibo] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaFchrecibo($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fchrecibo === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchrecibo);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchrecibo, true), $x);
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
	 * Get the [optionally formatted] temporal [ca_fchenvio] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaFchenvio($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fchenvio === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchenvio);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchenvio, true), $x);
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
	 * Get the [optionally formatted] temporal [ca_fchsalida] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaFchsalida($format = 'Y-m-d')
	{
		if ($this->ca_fchsalida === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchsalida);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchsalida, true), $x);
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
	 * Get the [optionally formatted] temporal [ca_fchllegada] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaFchllegada($format = 'Y-m-d')
	{
		if ($this->ca_fchllegada === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchllegada);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchllegada, true), $x);
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
	 * Get the [optionally formatted] temporal [ca_fchreserva] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaFchreserva($format = 'Y-m-d')
	{
		if ($this->ca_fchreserva === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchreserva);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchreserva, true), $x);
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
	 * Get the [optionally formatted] temporal [ca_fchcierrereserva] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaFchcierrereserva($format = 'Y-m-d')
	{
		if ($this->ca_fchcierrereserva === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchcierrereserva);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchcierrereserva, true), $x);
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
	 * Get the [ca_equipos] column value.
	 * 
	 * @return     string
	 */
	public function getCaEquipos()
	{
		return $this->ca_equipos;
	}

	/**
	 * Get the [optionally formatted] temporal [ca_horasalida] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaHorasalida($format = 'H:i:s')
	{
		if ($this->ca_horasalida === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_horasalida);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_horasalida, true), $x);
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
	 * Get the [optionally formatted] temporal [ca_horallegada] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaHorallegada($format = 'H:i:s')
	{
		if ($this->ca_horallegada === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_horallegada);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_horallegada, true), $x);
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
	 * Set the value of [ca_idreporte] column.
	 * 
	 * @param      int $v new value
	 * @return     RepStatus The current object (for fluent API support)
	 */
	public function setCaIdreporte($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idreporte !== $v) {
			$this->ca_idreporte = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_IDREPORTE;
		}

		if ($this->aReporte !== null && $this->aReporte->getCaIdreporte() !== $v) {
			$this->aReporte = null;
		}

		return $this;
	} // setCaIdreporte()

	/**
	 * Set the value of [ca_idemail] column.
	 * 
	 * @param      int $v new value
	 * @return     RepStatus The current object (for fluent API support)
	 */
	public function setCaIdemail($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idemail !== $v) {
			$this->ca_idemail = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_IDEMAIL;
		}

		if ($this->aEmail !== null && $this->aEmail->getCaIdemail() !== $v) {
			$this->aEmail = null;
		}

		return $this;
	} // setCaIdemail()

	/**
	 * Sets the value of [ca_fchstatus] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     RepStatus The current object (for fluent API support)
	 */
	public function setCaFchstatus($v)
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

		if ( $this->ca_fchstatus !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fchstatus !== null && $tmpDt = new DateTime($this->ca_fchstatus)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchstatus = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = RepStatusPeer::CA_FCHSTATUS;
			}
		} // if either are not null

		return $this;
	} // setCaFchstatus()

	/**
	 * Set the value of [ca_status] column.
	 * 
	 * @param      string $v new value
	 * @return     RepStatus The current object (for fluent API support)
	 */
	public function setCaStatus($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_status !== $v) {
			$this->ca_status = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_STATUS;
		}

		return $this;
	} // setCaStatus()

	/**
	 * Set the value of [ca_comentarios] column.
	 * 
	 * @param      string $v new value
	 * @return     RepStatus The current object (for fluent API support)
	 */
	public function setCaComentarios($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_comentarios !== $v) {
			$this->ca_comentarios = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_COMENTARIOS;
		}

		return $this;
	} // setCaComentarios()

	/**
	 * Sets the value of [ca_fchrecibo] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     RepStatus The current object (for fluent API support)
	 */
	public function setCaFchrecibo($v)
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

		if ( $this->ca_fchrecibo !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fchrecibo !== null && $tmpDt = new DateTime($this->ca_fchrecibo)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchrecibo = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = RepStatusPeer::CA_FCHRECIBO;
			}
		} // if either are not null

		return $this;
	} // setCaFchrecibo()

	/**
	 * Sets the value of [ca_fchenvio] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     RepStatus The current object (for fluent API support)
	 */
	public function setCaFchenvio($v)
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

		if ( $this->ca_fchenvio !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fchenvio !== null && $tmpDt = new DateTime($this->ca_fchenvio)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchenvio = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = RepStatusPeer::CA_FCHENVIO;
			}
		} // if either are not null

		return $this;
	} // setCaFchenvio()

	/**
	 * Set the value of [ca_usuenvio] column.
	 * 
	 * @param      string $v new value
	 * @return     RepStatus The current object (for fluent API support)
	 */
	public function setCaUsuenvio($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usuenvio !== $v) {
			$this->ca_usuenvio = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_USUENVIO;
		}

		return $this;
	} // setCaUsuenvio()

	/**
	 * Set the value of [ca_etapa] column.
	 * 
	 * @param      string $v new value
	 * @return     RepStatus The current object (for fluent API support)
	 */
	public function setCaEtapa($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_etapa !== $v) {
			$this->ca_etapa = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_ETAPA;
		}

		return $this;
	} // setCaEtapa()

	/**
	 * Set the value of [ca_introduccion] column.
	 * 
	 * @param      string $v new value
	 * @return     RepStatus The current object (for fluent API support)
	 */
	public function setCaIntroduccion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_introduccion !== $v) {
			$this->ca_introduccion = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_INTRODUCCION;
		}

		return $this;
	} // setCaIntroduccion()

	/**
	 * Sets the value of [ca_fchsalida] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     RepStatus The current object (for fluent API support)
	 */
	public function setCaFchsalida($v)
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

		if ( $this->ca_fchsalida !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fchsalida !== null && $tmpDt = new DateTime($this->ca_fchsalida)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchsalida = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = RepStatusPeer::CA_FCHSALIDA;
			}
		} // if either are not null

		return $this;
	} // setCaFchsalida()

	/**
	 * Sets the value of [ca_fchllegada] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     RepStatus The current object (for fluent API support)
	 */
	public function setCaFchllegada($v)
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

		if ( $this->ca_fchllegada !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fchllegada !== null && $tmpDt = new DateTime($this->ca_fchllegada)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchllegada = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = RepStatusPeer::CA_FCHLLEGADA;
			}
		} // if either are not null

		return $this;
	} // setCaFchllegada()

	/**
	 * Set the value of [ca_fchcontinuacion] column.
	 * 
	 * @param      string $v new value
	 * @return     RepStatus The current object (for fluent API support)
	 */
	public function setCaFchcontinuacion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_fchcontinuacion !== $v) {
			$this->ca_fchcontinuacion = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_FCHCONTINUACION;
		}

		return $this;
	} // setCaFchcontinuacion()

	/**
	 * Set the value of [ca_piezas] column.
	 * 
	 * @param      string $v new value
	 * @return     RepStatus The current object (for fluent API support)
	 */
	public function setCaPiezas($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_piezas !== $v) {
			$this->ca_piezas = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_PIEZAS;
		}

		return $this;
	} // setCaPiezas()

	/**
	 * Set the value of [ca_peso] column.
	 * 
	 * @param      string $v new value
	 * @return     RepStatus The current object (for fluent API support)
	 */
	public function setCaPeso($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_peso !== $v) {
			$this->ca_peso = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_PESO;
		}

		return $this;
	} // setCaPeso()

	/**
	 * Set the value of [ca_volumen] column.
	 * 
	 * @param      string $v new value
	 * @return     RepStatus The current object (for fluent API support)
	 */
	public function setCaVolumen($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_volumen !== $v) {
			$this->ca_volumen = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_VOLUMEN;
		}

		return $this;
	} // setCaVolumen()

	/**
	 * Set the value of [ca_doctransporte] column.
	 * 
	 * @param      string $v new value
	 * @return     RepStatus The current object (for fluent API support)
	 */
	public function setCaDoctransporte($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_doctransporte !== $v) {
			$this->ca_doctransporte = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_DOCTRANSPORTE;
		}

		return $this;
	} // setCaDoctransporte()

	/**
	 * Set the value of [ca_idnave] column.
	 * 
	 * @param      string $v new value
	 * @return     RepStatus The current object (for fluent API support)
	 */
	public function setCaIdnave($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idnave !== $v) {
			$this->ca_idnave = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_IDNAVE;
		}

		return $this;
	} // setCaIdnave()

	/**
	 * Set the value of [ca_docmaster] column.
	 * 
	 * @param      string $v new value
	 * @return     RepStatus The current object (for fluent API support)
	 */
	public function setCaDocmaster($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_docmaster !== $v) {
			$this->ca_docmaster = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_DOCMASTER;
		}

		return $this;
	} // setCaDocmaster()

	/**
	 * Sets the value of [ca_fchreserva] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     RepStatus The current object (for fluent API support)
	 */
	public function setCaFchreserva($v)
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

		if ( $this->ca_fchreserva !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fchreserva !== null && $tmpDt = new DateTime($this->ca_fchreserva)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchreserva = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = RepStatusPeer::CA_FCHRESERVA;
			}
		} // if either are not null

		return $this;
	} // setCaFchreserva()

	/**
	 * Sets the value of [ca_fchcierrereserva] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     RepStatus The current object (for fluent API support)
	 */
	public function setCaFchcierrereserva($v)
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

		if ( $this->ca_fchcierrereserva !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fchcierrereserva !== null && $tmpDt = new DateTime($this->ca_fchcierrereserva)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchcierrereserva = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = RepStatusPeer::CA_FCHCIERRERESERVA;
			}
		} // if either are not null

		return $this;
	} // setCaFchcierrereserva()

	/**
	 * Set the value of [ca_equipos] column.
	 * 
	 * @param      string $v new value
	 * @return     RepStatus The current object (for fluent API support)
	 */
	public function setCaEquipos($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_equipos !== $v) {
			$this->ca_equipos = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_EQUIPOS;
		}

		return $this;
	} // setCaEquipos()

	/**
	 * Sets the value of [ca_horasalida] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     RepStatus The current object (for fluent API support)
	 */
	public function setCaHorasalida($v)
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

		if ( $this->ca_horasalida !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_horasalida !== null && $tmpDt = new DateTime($this->ca_horasalida)) ? $tmpDt->format('H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('H:i:s') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_horasalida = ($dt ? $dt->format('H:i:s') : null);
				$this->modifiedColumns[] = RepStatusPeer::CA_HORASALIDA;
			}
		} // if either are not null

		return $this;
	} // setCaHorasalida()

	/**
	 * Sets the value of [ca_horallegada] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     RepStatus The current object (for fluent API support)
	 */
	public function setCaHorallegada($v)
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

		if ( $this->ca_horallegada !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_horallegada !== null && $tmpDt = new DateTime($this->ca_horallegada)) ? $tmpDt->format('H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('H:i:s') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_horallegada = ($dt ? $dt->format('H:i:s') : null);
				$this->modifiedColumns[] = RepStatusPeer::CA_HORALLEGADA;
			}
		} // if either are not null

		return $this;
	} // setCaHorallegada()

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

			$this->ca_idreporte = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_idemail = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_fchstatus = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_status = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_comentarios = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_fchrecibo = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_fchenvio = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_usuenvio = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_etapa = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_introduccion = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_fchsalida = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_fchllegada = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_fchcontinuacion = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_piezas = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->ca_peso = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->ca_volumen = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->ca_doctransporte = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
			$this->ca_idnave = ($row[$startcol + 17] !== null) ? (string) $row[$startcol + 17] : null;
			$this->ca_docmaster = ($row[$startcol + 18] !== null) ? (string) $row[$startcol + 18] : null;
			$this->ca_fchreserva = ($row[$startcol + 19] !== null) ? (string) $row[$startcol + 19] : null;
			$this->ca_fchcierrereserva = ($row[$startcol + 20] !== null) ? (string) $row[$startcol + 20] : null;
			$this->ca_equipos = ($row[$startcol + 21] !== null) ? (string) $row[$startcol + 21] : null;
			$this->ca_horasalida = ($row[$startcol + 22] !== null) ? (string) $row[$startcol + 22] : null;
			$this->ca_horallegada = ($row[$startcol + 23] !== null) ? (string) $row[$startcol + 23] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 24; // 24 = RepStatusPeer::NUM_COLUMNS - RepStatusPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating RepStatus object", $e);
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

		if ($this->aReporte !== null && $this->ca_idreporte !== $this->aReporte->getCaIdreporte()) {
			$this->aReporte = null;
		}
		if ($this->aEmail !== null && $this->ca_idemail !== $this->aEmail->getCaIdemail()) {
			$this->aEmail = null;
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
			$con = Propel::getConnection(RepStatusPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = RepStatusPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aReporte = null;
			$this->aEmail = null;
			$this->collRepStatusRespuestas = null;
			$this->lastRepStatusRespuestaCriteria = null;

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
			$con = Propel::getConnection(RepStatusPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			RepStatusPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(RepStatusPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			RepStatusPeer::addInstanceToPool($this);
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

			if ($this->aEmail !== null) {
				if ($this->aEmail->isModified() || $this->aEmail->isNew()) {
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

			if ($this->collRepStatusRespuestas !== null) {
				foreach ($this->collRepStatusRespuestas as $referrerFK) {
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


				if ($this->collRepStatusRespuestas !== null) {
					foreach ($this->collRepStatusRespuestas as $referrerFK) {
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
		$pos = RepStatusPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
	 * @param      string $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                        BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. Defaults to BasePeer::TYPE_PHPNAME.
	 * @param      boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns.  Defaults to TRUE.
	 * @return     an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
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
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
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

		$copyObj->setCaIdreporte($this->ca_idreporte);

		$copyObj->setCaIdemail($this->ca_idemail);

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


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getRepStatusRespuestas() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addRepStatusRespuesta($relObj->copy($deepCopy));
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
	 * @return     RepStatus The current object (for fluent API support)
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
			$v->addRepStatus($this);
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
		if ($this->aReporte === null && ($this->ca_idreporte !== null)) {
			$c = new Criteria(ReportePeer::DATABASE_NAME);
			$c->add(ReportePeer::CA_IDREPORTE, $this->ca_idreporte);
			$this->aReporte = ReportePeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aReporte->addRepStatuss($this);
			 */
		}
		return $this->aReporte;
	}

	/**
	 * Declares an association between this object and a Email object.
	 *
	 * @param      Email $v
	 * @return     RepStatus The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setEmail(Email $v = null)
	{
		if ($v === null) {
			$this->setCaIdemail(NULL);
		} else {
			$this->setCaIdemail($v->getCaIdemail());
		}

		$this->aEmail = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Email object, it will not be re-added.
		if ($v !== null) {
			$v->addRepStatus($this);
		}

		return $this;
	}


	/**
	 * Get the associated Email object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Email The associated Email object.
	 * @throws     PropelException
	 */
	public function getEmail(PropelPDO $con = null)
	{
		if ($this->aEmail === null && ($this->ca_idemail !== null)) {
			$c = new Criteria(EmailPeer::DATABASE_NAME);
			$c->add(EmailPeer::CA_IDEMAIL, $this->ca_idemail);
			$this->aEmail = EmailPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aEmail->addRepStatuss($this);
			 */
		}
		return $this->aEmail;
	}

	/**
	 * Clears out the collRepStatusRespuestas collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addRepStatusRespuestas()
	 */
	public function clearRepStatusRespuestas()
	{
		$this->collRepStatusRespuestas = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collRepStatusRespuestas collection (array).
	 *
	 * By default this just sets the collRepStatusRespuestas collection to an empty array (like clearcollRepStatusRespuestas());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initRepStatusRespuestas()
	{
		$this->collRepStatusRespuestas = array();
	}

	/**
	 * Gets an array of RepStatusRespuesta objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this RepStatus has previously been saved, it will retrieve
	 * related RepStatusRespuestas from storage. If this RepStatus is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array RepStatusRespuesta[]
	 * @throws     PropelException
	 */
	public function getRepStatusRespuestas($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(RepStatusPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepStatusRespuestas === null) {
			if ($this->isNew()) {
			   $this->collRepStatusRespuestas = array();
			} else {

				$criteria->add(RepStatusRespuestaPeer::CA_IDREPORTE, $this->ca_idreporte);

				$criteria->add(RepStatusRespuestaPeer::CA_IDEMAIL, $this->ca_idemail);

				RepStatusRespuestaPeer::addSelectColumns($criteria);
				$this->collRepStatusRespuestas = RepStatusRespuestaPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RepStatusRespuestaPeer::CA_IDREPORTE, $this->ca_idreporte);


				$criteria->add(RepStatusRespuestaPeer::CA_IDEMAIL, $this->ca_idemail);

				RepStatusRespuestaPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepStatusRespuestaCriteria) || !$this->lastRepStatusRespuestaCriteria->equals($criteria)) {
					$this->collRepStatusRespuestas = RepStatusRespuestaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepStatusRespuestaCriteria = $criteria;
		return $this->collRepStatusRespuestas;
	}

	/**
	 * Returns the number of related RepStatusRespuesta objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related RepStatusRespuesta objects.
	 * @throws     PropelException
	 */
	public function countRepStatusRespuestas(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(RepStatusPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collRepStatusRespuestas === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(RepStatusRespuestaPeer::CA_IDREPORTE, $this->ca_idreporte);

				$criteria->add(RepStatusRespuestaPeer::CA_IDEMAIL, $this->ca_idemail);

				$count = RepStatusRespuestaPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(RepStatusRespuestaPeer::CA_IDREPORTE, $this->ca_idreporte);


				$criteria->add(RepStatusRespuestaPeer::CA_IDEMAIL, $this->ca_idemail);

				if (!isset($this->lastRepStatusRespuestaCriteria) || !$this->lastRepStatusRespuestaCriteria->equals($criteria)) {
					$count = RepStatusRespuestaPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collRepStatusRespuestas);
				}
			} else {
				$count = count($this->collRepStatusRespuestas);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a RepStatusRespuesta object to this object
	 * through the RepStatusRespuesta foreign key attribute.
	 *
	 * @param      RepStatusRespuesta $l RepStatusRespuesta
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRepStatusRespuesta(RepStatusRespuesta $l)
	{
		if ($this->collRepStatusRespuestas === null) {
			$this->initRepStatusRespuestas();
		}
		if (!in_array($l, $this->collRepStatusRespuestas, true)) { // only add it if the **same** object is not already associated
			array_push($this->collRepStatusRespuestas, $l);
			$l->setRepStatus($this);
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
			if ($this->collRepStatusRespuestas) {
				foreach ((array) $this->collRepStatusRespuestas as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collRepStatusRespuestas = null;
			$this->aReporte = null;
			$this->aEmail = null;
	}

} // BaseRepStatus
