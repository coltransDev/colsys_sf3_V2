<?php

/**
 * Base class that represents a row from the 'notificaciones.tb_tareas' table.
 *
 * 
 *
 * @package    lib.model.notificaciones.om
 */
abstract class BaseNotTarea extends BaseObject  implements Persistent {


  const PEER = 'NotTareaPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        NotTareaPeer
	 */
	protected static $peer;

	/**
	 * The value for the ca_idtarea field.
	 * @var        int
	 */
	protected $ca_idtarea;

	/**
	 * The value for the ca_idlistatarea field.
	 * @var        int
	 */
	protected $ca_idlistatarea;

	/**
	 * The value for the ca_url field.
	 * @var        string
	 */
	protected $ca_url;

	/**
	 * The value for the ca_titulo field.
	 * @var        string
	 */
	protected $ca_titulo;

	/**
	 * The value for the ca_texto field.
	 * @var        string
	 */
	protected $ca_texto;

	/**
	 * The value for the ca_fchvisible field.
	 * @var        string
	 */
	protected $ca_fchvisible;

	/**
	 * The value for the ca_fchvencimiento field.
	 * @var        string
	 */
	protected $ca_fchvencimiento;

	/**
	 * The value for the ca_fchterminada field.
	 * @var        string
	 */
	protected $ca_fchterminada;

	/**
	 * The value for the ca_usuterminada field.
	 * @var        string
	 */
	protected $ca_usuterminada;

	/**
	 * The value for the ca_prioridad field.
	 * @var        int
	 */
	protected $ca_prioridad;

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
	 * The value for the ca_observaciones field.
	 * @var        string
	 */
	protected $ca_observaciones;

	/**
	 * @var        NotListaTareas
	 */
	protected $aNotListaTareas;

	/**
	 * @var        array Cotizacion[] Collection to store aggregation of Cotizacion objects.
	 */
	protected $collCotizacions;

	/**
	 * @var        Criteria The criteria used to select the current contents of collCotizacions.
	 */
	private $lastCotizacionCriteria = null;

	/**
	 * @var        array CotProducto[] Collection to store aggregation of CotProducto objects.
	 */
	protected $collCotProductos;

	/**
	 * @var        Criteria The criteria used to select the current contents of collCotProductos.
	 */
	private $lastCotProductoCriteria = null;

	/**
	 * @var        array HdeskTicket[] Collection to store aggregation of HdeskTicket objects.
	 */
	protected $collHdeskTickets;

	/**
	 * @var        Criteria The criteria used to select the current contents of collHdeskTickets.
	 */
	private $lastHdeskTicketCriteria = null;

	/**
	 * @var        array Notificacion[] Collection to store aggregation of Notificacion objects.
	 */
	protected $collNotificacions;

	/**
	 * @var        Criteria The criteria used to select the current contents of collNotificacions.
	 */
	private $lastNotificacionCriteria = null;

	/**
	 * @var        array NotTareaAsignacion[] Collection to store aggregation of NotTareaAsignacion objects.
	 */
	protected $collNotTareaAsignacions;

	/**
	 * @var        Criteria The criteria used to select the current contents of collNotTareaAsignacions.
	 */
	private $lastNotTareaAsignacionCriteria = null;

	/**
	 * @var        array Reporte[] Collection to store aggregation of Reporte objects.
	 */
	protected $collReportes;

	/**
	 * @var        Criteria The criteria used to select the current contents of collReportes.
	 */
	private $lastReporteCriteria = null;

	/**
	 * @var        array RepAsignacion[] Collection to store aggregation of RepAsignacion objects.
	 */
	protected $collRepAsignacions;

	/**
	 * @var        Criteria The criteria used to select the current contents of collRepAsignacions.
	 */
	private $lastRepAsignacionCriteria = null;

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
	 * Initializes internal state of BaseNotTarea object.
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
	 * Get the [ca_idtarea] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdtarea()
	{
		return $this->ca_idtarea;
	}

	/**
	 * Get the [ca_idlistatarea] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdlistatarea()
	{
		return $this->ca_idlistatarea;
	}

	/**
	 * Get the [ca_url] column value.
	 * 
	 * @return     string
	 */
	public function getCaUrl()
	{
		return $this->ca_url;
	}

	/**
	 * Get the [ca_titulo] column value.
	 * 
	 * @return     string
	 */
	public function getCaTitulo()
	{
		return $this->ca_titulo;
	}

	/**
	 * Get the [ca_texto] column value.
	 * 
	 * @return     string
	 */
	public function getCaTexto()
	{
		return $this->ca_texto;
	}

	/**
	 * Get the [optionally formatted] temporal [ca_fchvisible] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaFchvisible($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fchvisible === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchvisible);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchvisible, true), $x);
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
	 * Get the [optionally formatted] temporal [ca_fchvencimiento] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaFchvencimiento($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fchvencimiento === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchvencimiento);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchvencimiento, true), $x);
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
	 * Get the [optionally formatted] temporal [ca_fchterminada] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaFchterminada($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fchterminada === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchterminada);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchterminada, true), $x);
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
	 * Get the [ca_usuterminada] column value.
	 * 
	 * @return     string
	 */
	public function getCaUsuterminada()
	{
		return $this->ca_usuterminada;
	}

	/**
	 * Get the [ca_prioridad] column value.
	 * 
	 * @return     int
	 */
	public function getCaPrioridad()
	{
		return $this->ca_prioridad;
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
	 * Get the [ca_observaciones] column value.
	 * 
	 * @return     string
	 */
	public function getCaObservaciones()
	{
		return $this->ca_observaciones;
	}

	/**
	 * Set the value of [ca_idtarea] column.
	 * 
	 * @param      int $v new value
	 * @return     NotTarea The current object (for fluent API support)
	 */
	public function setCaIdtarea($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idtarea !== $v) {
			$this->ca_idtarea = $v;
			$this->modifiedColumns[] = NotTareaPeer::CA_IDTAREA;
		}

		return $this;
	} // setCaIdtarea()

	/**
	 * Set the value of [ca_idlistatarea] column.
	 * 
	 * @param      int $v new value
	 * @return     NotTarea The current object (for fluent API support)
	 */
	public function setCaIdlistatarea($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idlistatarea !== $v) {
			$this->ca_idlistatarea = $v;
			$this->modifiedColumns[] = NotTareaPeer::CA_IDLISTATAREA;
		}

		if ($this->aNotListaTareas !== null && $this->aNotListaTareas->getCaIdlistatarea() !== $v) {
			$this->aNotListaTareas = null;
		}

		return $this;
	} // setCaIdlistatarea()

	/**
	 * Set the value of [ca_url] column.
	 * 
	 * @param      string $v new value
	 * @return     NotTarea The current object (for fluent API support)
	 */
	public function setCaUrl($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_url !== $v) {
			$this->ca_url = $v;
			$this->modifiedColumns[] = NotTareaPeer::CA_URL;
		}

		return $this;
	} // setCaUrl()

	/**
	 * Set the value of [ca_titulo] column.
	 * 
	 * @param      string $v new value
	 * @return     NotTarea The current object (for fluent API support)
	 */
	public function setCaTitulo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_titulo !== $v) {
			$this->ca_titulo = $v;
			$this->modifiedColumns[] = NotTareaPeer::CA_TITULO;
		}

		return $this;
	} // setCaTitulo()

	/**
	 * Set the value of [ca_texto] column.
	 * 
	 * @param      string $v new value
	 * @return     NotTarea The current object (for fluent API support)
	 */
	public function setCaTexto($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_texto !== $v) {
			$this->ca_texto = $v;
			$this->modifiedColumns[] = NotTareaPeer::CA_TEXTO;
		}

		return $this;
	} // setCaTexto()

	/**
	 * Sets the value of [ca_fchvisible] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     NotTarea The current object (for fluent API support)
	 */
	public function setCaFchvisible($v)
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

		if ( $this->ca_fchvisible !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fchvisible !== null && $tmpDt = new DateTime($this->ca_fchvisible)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchvisible = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = NotTareaPeer::CA_FCHVISIBLE;
			}
		} // if either are not null

		return $this;
	} // setCaFchvisible()

	/**
	 * Sets the value of [ca_fchvencimiento] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     NotTarea The current object (for fluent API support)
	 */
	public function setCaFchvencimiento($v)
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

		if ( $this->ca_fchvencimiento !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fchvencimiento !== null && $tmpDt = new DateTime($this->ca_fchvencimiento)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchvencimiento = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = NotTareaPeer::CA_FCHVENCIMIENTO;
			}
		} // if either are not null

		return $this;
	} // setCaFchvencimiento()

	/**
	 * Sets the value of [ca_fchterminada] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     NotTarea The current object (for fluent API support)
	 */
	public function setCaFchterminada($v)
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

		if ( $this->ca_fchterminada !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fchterminada !== null && $tmpDt = new DateTime($this->ca_fchterminada)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchterminada = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = NotTareaPeer::CA_FCHTERMINADA;
			}
		} // if either are not null

		return $this;
	} // setCaFchterminada()

	/**
	 * Set the value of [ca_usuterminada] column.
	 * 
	 * @param      string $v new value
	 * @return     NotTarea The current object (for fluent API support)
	 */
	public function setCaUsuterminada($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usuterminada !== $v) {
			$this->ca_usuterminada = $v;
			$this->modifiedColumns[] = NotTareaPeer::CA_USUTERMINADA;
		}

		return $this;
	} // setCaUsuterminada()

	/**
	 * Set the value of [ca_prioridad] column.
	 * 
	 * @param      int $v new value
	 * @return     NotTarea The current object (for fluent API support)
	 */
	public function setCaPrioridad($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_prioridad !== $v) {
			$this->ca_prioridad = $v;
			$this->modifiedColumns[] = NotTareaPeer::CA_PRIORIDAD;
		}

		return $this;
	} // setCaPrioridad()

	/**
	 * Sets the value of [ca_fchcreado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     NotTarea The current object (for fluent API support)
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
				$this->modifiedColumns[] = NotTareaPeer::CA_FCHCREADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchcreado()

	/**
	 * Set the value of [ca_usucreado] column.
	 * 
	 * @param      string $v new value
	 * @return     NotTarea The current object (for fluent API support)
	 */
	public function setCaUsucreado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usucreado !== $v) {
			$this->ca_usucreado = $v;
			$this->modifiedColumns[] = NotTareaPeer::CA_USUCREADO;
		}

		return $this;
	} // setCaUsucreado()

	/**
	 * Set the value of [ca_observaciones] column.
	 * 
	 * @param      string $v new value
	 * @return     NotTarea The current object (for fluent API support)
	 */
	public function setCaObservaciones($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_observaciones !== $v) {
			$this->ca_observaciones = $v;
			$this->modifiedColumns[] = NotTareaPeer::CA_OBSERVACIONES;
		}

		return $this;
	} // setCaObservaciones()

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

			$this->ca_idtarea = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_idlistatarea = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_url = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_titulo = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_texto = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_fchvisible = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_fchvencimiento = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_fchterminada = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_usuterminada = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_prioridad = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
			$this->ca_fchcreado = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_usucreado = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_observaciones = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 13; // 13 = NotTareaPeer::NUM_COLUMNS - NotTareaPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating NotTarea object", $e);
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

		if ($this->aNotListaTareas !== null && $this->ca_idlistatarea !== $this->aNotListaTareas->getCaIdlistatarea()) {
			$this->aNotListaTareas = null;
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
			$con = Propel::getConnection(NotTareaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = NotTareaPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aNotListaTareas = null;
			$this->collCotizacions = null;
			$this->lastCotizacionCriteria = null;

			$this->collCotProductos = null;
			$this->lastCotProductoCriteria = null;

			$this->collHdeskTickets = null;
			$this->lastHdeskTicketCriteria = null;

			$this->collNotificacions = null;
			$this->lastNotificacionCriteria = null;

			$this->collNotTareaAsignacions = null;
			$this->lastNotTareaAsignacionCriteria = null;

			$this->collReportes = null;
			$this->lastReporteCriteria = null;

			$this->collRepAsignacions = null;
			$this->lastRepAsignacionCriteria = null;

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
			$con = Propel::getConnection(NotTareaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			NotTareaPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(NotTareaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			NotTareaPeer::addInstanceToPool($this);
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

			if ($this->aNotListaTareas !== null) {
				if ($this->aNotListaTareas->isModified() || $this->aNotListaTareas->isNew()) {
					$affectedRows += $this->aNotListaTareas->save($con);
				}
				$this->setNotListaTareas($this->aNotListaTareas);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = NotTareaPeer::CA_IDTAREA;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = NotTareaPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setCaIdtarea($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += NotTareaPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collCotizacions !== null) {
				foreach ($this->collCotizacions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCotProductos !== null) {
				foreach ($this->collCotProductos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collHdeskTickets !== null) {
				foreach ($this->collHdeskTickets as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collNotificacions !== null) {
				foreach ($this->collNotificacions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collNotTareaAsignacions !== null) {
				foreach ($this->collNotTareaAsignacions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collReportes !== null) {
				foreach ($this->collReportes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRepAsignacions !== null) {
				foreach ($this->collRepAsignacions as $referrerFK) {
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

			if ($this->aNotListaTareas !== null) {
				if (!$this->aNotListaTareas->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aNotListaTareas->getValidationFailures());
				}
			}


			if (($retval = NotTareaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collCotizacions !== null) {
					foreach ($this->collCotizacions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCotProductos !== null) {
					foreach ($this->collCotProductos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collHdeskTickets !== null) {
					foreach ($this->collHdeskTickets as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collNotificacions !== null) {
					foreach ($this->collNotificacions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collNotTareaAsignacions !== null) {
					foreach ($this->collNotTareaAsignacions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collReportes !== null) {
					foreach ($this->collReportes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRepAsignacions !== null) {
					foreach ($this->collRepAsignacions as $referrerFK) {
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
		$pos = NotTareaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdtarea();
				break;
			case 1:
				return $this->getCaIdlistatarea();
				break;
			case 2:
				return $this->getCaUrl();
				break;
			case 3:
				return $this->getCaTitulo();
				break;
			case 4:
				return $this->getCaTexto();
				break;
			case 5:
				return $this->getCaFchvisible();
				break;
			case 6:
				return $this->getCaFchvencimiento();
				break;
			case 7:
				return $this->getCaFchterminada();
				break;
			case 8:
				return $this->getCaUsuterminada();
				break;
			case 9:
				return $this->getCaPrioridad();
				break;
			case 10:
				return $this->getCaFchcreado();
				break;
			case 11:
				return $this->getCaUsucreado();
				break;
			case 12:
				return $this->getCaObservaciones();
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
		$keys = NotTareaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdtarea(),
			$keys[1] => $this->getCaIdlistatarea(),
			$keys[2] => $this->getCaUrl(),
			$keys[3] => $this->getCaTitulo(),
			$keys[4] => $this->getCaTexto(),
			$keys[5] => $this->getCaFchvisible(),
			$keys[6] => $this->getCaFchvencimiento(),
			$keys[7] => $this->getCaFchterminada(),
			$keys[8] => $this->getCaUsuterminada(),
			$keys[9] => $this->getCaPrioridad(),
			$keys[10] => $this->getCaFchcreado(),
			$keys[11] => $this->getCaUsucreado(),
			$keys[12] => $this->getCaObservaciones(),
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
		$pos = NotTareaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdtarea($value);
				break;
			case 1:
				$this->setCaIdlistatarea($value);
				break;
			case 2:
				$this->setCaUrl($value);
				break;
			case 3:
				$this->setCaTitulo($value);
				break;
			case 4:
				$this->setCaTexto($value);
				break;
			case 5:
				$this->setCaFchvisible($value);
				break;
			case 6:
				$this->setCaFchvencimiento($value);
				break;
			case 7:
				$this->setCaFchterminada($value);
				break;
			case 8:
				$this->setCaUsuterminada($value);
				break;
			case 9:
				$this->setCaPrioridad($value);
				break;
			case 10:
				$this->setCaFchcreado($value);
				break;
			case 11:
				$this->setCaUsucreado($value);
				break;
			case 12:
				$this->setCaObservaciones($value);
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
		$keys = NotTareaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdtarea($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdlistatarea($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaUrl($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaTitulo($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaTexto($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaFchvisible($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaFchvencimiento($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaFchterminada($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaUsuterminada($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaPrioridad($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaFchcreado($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaUsucreado($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaObservaciones($arr[$keys[12]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);

		if ($this->isColumnModified(NotTareaPeer::CA_IDTAREA)) $criteria->add(NotTareaPeer::CA_IDTAREA, $this->ca_idtarea);
		if ($this->isColumnModified(NotTareaPeer::CA_IDLISTATAREA)) $criteria->add(NotTareaPeer::CA_IDLISTATAREA, $this->ca_idlistatarea);
		if ($this->isColumnModified(NotTareaPeer::CA_URL)) $criteria->add(NotTareaPeer::CA_URL, $this->ca_url);
		if ($this->isColumnModified(NotTareaPeer::CA_TITULO)) $criteria->add(NotTareaPeer::CA_TITULO, $this->ca_titulo);
		if ($this->isColumnModified(NotTareaPeer::CA_TEXTO)) $criteria->add(NotTareaPeer::CA_TEXTO, $this->ca_texto);
		if ($this->isColumnModified(NotTareaPeer::CA_FCHVISIBLE)) $criteria->add(NotTareaPeer::CA_FCHVISIBLE, $this->ca_fchvisible);
		if ($this->isColumnModified(NotTareaPeer::CA_FCHVENCIMIENTO)) $criteria->add(NotTareaPeer::CA_FCHVENCIMIENTO, $this->ca_fchvencimiento);
		if ($this->isColumnModified(NotTareaPeer::CA_FCHTERMINADA)) $criteria->add(NotTareaPeer::CA_FCHTERMINADA, $this->ca_fchterminada);
		if ($this->isColumnModified(NotTareaPeer::CA_USUTERMINADA)) $criteria->add(NotTareaPeer::CA_USUTERMINADA, $this->ca_usuterminada);
		if ($this->isColumnModified(NotTareaPeer::CA_PRIORIDAD)) $criteria->add(NotTareaPeer::CA_PRIORIDAD, $this->ca_prioridad);
		if ($this->isColumnModified(NotTareaPeer::CA_FCHCREADO)) $criteria->add(NotTareaPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(NotTareaPeer::CA_USUCREADO)) $criteria->add(NotTareaPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(NotTareaPeer::CA_OBSERVACIONES)) $criteria->add(NotTareaPeer::CA_OBSERVACIONES, $this->ca_observaciones);

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
		$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);

		$criteria->add(NotTareaPeer::CA_IDTAREA, $this->ca_idtarea);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdtarea();
	}

	/**
	 * Generic method to set the primary key (ca_idtarea column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdtarea($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of NotTarea (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdlistatarea($this->ca_idlistatarea);

		$copyObj->setCaUrl($this->ca_url);

		$copyObj->setCaTitulo($this->ca_titulo);

		$copyObj->setCaTexto($this->ca_texto);

		$copyObj->setCaFchvisible($this->ca_fchvisible);

		$copyObj->setCaFchvencimiento($this->ca_fchvencimiento);

		$copyObj->setCaFchterminada($this->ca_fchterminada);

		$copyObj->setCaUsuterminada($this->ca_usuterminada);

		$copyObj->setCaPrioridad($this->ca_prioridad);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaObservaciones($this->ca_observaciones);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getCotizacions() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addCotizacion($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getCotProductos() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addCotProducto($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getHdeskTickets() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addHdeskTicket($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getNotificacions() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addNotificacion($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getNotTareaAsignacions() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addNotTareaAsignacion($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getReportes() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addReporte($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getRepAsignacions() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addRepAsignacion($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setCaIdtarea(NULL); // this is a auto-increment column, so set to default value

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
	 * @return     NotTarea Clone of current object.
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
	 * @return     NotTareaPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new NotTareaPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a NotListaTareas object.
	 *
	 * @param      NotListaTareas $v
	 * @return     NotTarea The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setNotListaTareas(NotListaTareas $v = null)
	{
		if ($v === null) {
			$this->setCaIdlistatarea(NULL);
		} else {
			$this->setCaIdlistatarea($v->getCaIdlistatarea());
		}

		$this->aNotListaTareas = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the NotListaTareas object, it will not be re-added.
		if ($v !== null) {
			$v->addNotTarea($this);
		}

		return $this;
	}


	/**
	 * Get the associated NotListaTareas object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     NotListaTareas The associated NotListaTareas object.
	 * @throws     PropelException
	 */
	public function getNotListaTareas(PropelPDO $con = null)
	{
		if ($this->aNotListaTareas === null && ($this->ca_idlistatarea !== null)) {
			$c = new Criteria(NotListaTareasPeer::DATABASE_NAME);
			$c->add(NotListaTareasPeer::CA_IDLISTATAREA, $this->ca_idlistatarea);
			$this->aNotListaTareas = NotListaTareasPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aNotListaTareas->addNotTareas($this);
			 */
		}
		return $this->aNotListaTareas;
	}

	/**
	 * Clears out the collCotizacions collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addCotizacions()
	 */
	public function clearCotizacions()
	{
		$this->collCotizacions = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collCotizacions collection (array).
	 *
	 * By default this just sets the collCotizacions collection to an empty array (like clearcollCotizacions());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initCotizacions()
	{
		$this->collCotizacions = array();
	}

	/**
	 * Gets an array of Cotizacion objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this NotTarea has previously been saved, it will retrieve
	 * related Cotizacions from storage. If this NotTarea is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array Cotizacion[]
	 * @throws     PropelException
	 */
	public function getCotizacions($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotizacions === null) {
			if ($this->isNew()) {
			   $this->collCotizacions = array();
			} else {

				$criteria->add(CotizacionPeer::CA_IDG_ENVIO_OPORTUNO, $this->ca_idtarea);

				CotizacionPeer::addSelectColumns($criteria);
				$this->collCotizacions = CotizacionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CotizacionPeer::CA_IDG_ENVIO_OPORTUNO, $this->ca_idtarea);

				CotizacionPeer::addSelectColumns($criteria);
				if (!isset($this->lastCotizacionCriteria) || !$this->lastCotizacionCriteria->equals($criteria)) {
					$this->collCotizacions = CotizacionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCotizacionCriteria = $criteria;
		return $this->collCotizacions;
	}

	/**
	 * Returns the number of related Cotizacion objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Cotizacion objects.
	 * @throws     PropelException
	 */
	public function countCotizacions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collCotizacions === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(CotizacionPeer::CA_IDG_ENVIO_OPORTUNO, $this->ca_idtarea);

				$count = CotizacionPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(CotizacionPeer::CA_IDG_ENVIO_OPORTUNO, $this->ca_idtarea);

				if (!isset($this->lastCotizacionCriteria) || !$this->lastCotizacionCriteria->equals($criteria)) {
					$count = CotizacionPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collCotizacions);
				}
			} else {
				$count = count($this->collCotizacions);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a Cotizacion object to this object
	 * through the Cotizacion foreign key attribute.
	 *
	 * @param      Cotizacion $l Cotizacion
	 * @return     void
	 * @throws     PropelException
	 */
	public function addCotizacion(Cotizacion $l)
	{
		if ($this->collCotizacions === null) {
			$this->initCotizacions();
		}
		if (!in_array($l, $this->collCotizacions, true)) { // only add it if the **same** object is not already associated
			array_push($this->collCotizacions, $l);
			$l->setNotTarea($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this NotTarea is new, it will return
	 * an empty collection; or if this NotTarea has previously
	 * been saved, it will retrieve related Cotizacions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in NotTarea.
	 */
	public function getCotizacionsJoinContacto($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotizacions === null) {
			if ($this->isNew()) {
				$this->collCotizacions = array();
			} else {

				$criteria->add(CotizacionPeer::CA_IDG_ENVIO_OPORTUNO, $this->ca_idtarea);

				$this->collCotizacions = CotizacionPeer::doSelectJoinContacto($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CotizacionPeer::CA_IDG_ENVIO_OPORTUNO, $this->ca_idtarea);

			if (!isset($this->lastCotizacionCriteria) || !$this->lastCotizacionCriteria->equals($criteria)) {
				$this->collCotizacions = CotizacionPeer::doSelectJoinContacto($criteria, $con, $join_behavior);
			}
		}
		$this->lastCotizacionCriteria = $criteria;

		return $this->collCotizacions;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this NotTarea is new, it will return
	 * an empty collection; or if this NotTarea has previously
	 * been saved, it will retrieve related Cotizacions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in NotTarea.
	 */
	public function getCotizacionsJoinUsuario($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotizacions === null) {
			if ($this->isNew()) {
				$this->collCotizacions = array();
			} else {

				$criteria->add(CotizacionPeer::CA_IDG_ENVIO_OPORTUNO, $this->ca_idtarea);

				$this->collCotizacions = CotizacionPeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CotizacionPeer::CA_IDG_ENVIO_OPORTUNO, $this->ca_idtarea);

			if (!isset($this->lastCotizacionCriteria) || !$this->lastCotizacionCriteria->equals($criteria)) {
				$this->collCotizacions = CotizacionPeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		}
		$this->lastCotizacionCriteria = $criteria;

		return $this->collCotizacions;
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
	 * Otherwise if this NotTarea has previously been saved, it will retrieve
	 * related CotProductos from storage. If this NotTarea is new, it will return
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
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotProductos === null) {
			if ($this->isNew()) {
			   $this->collCotProductos = array();
			} else {

				$criteria->add(CotProductoPeer::CA_IDTAREA, $this->ca_idtarea);

				CotProductoPeer::addSelectColumns($criteria);
				$this->collCotProductos = CotProductoPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CotProductoPeer::CA_IDTAREA, $this->ca_idtarea);

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
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
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

				$criteria->add(CotProductoPeer::CA_IDTAREA, $this->ca_idtarea);

				$count = CotProductoPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(CotProductoPeer::CA_IDTAREA, $this->ca_idtarea);

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
			$l->setNotTarea($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this NotTarea is new, it will return
	 * an empty collection; or if this NotTarea has previously
	 * been saved, it will retrieve related CotProductos from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in NotTarea.
	 */
	public function getCotProductosJoinCotizacion($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotProductos === null) {
			if ($this->isNew()) {
				$this->collCotProductos = array();
			} else {

				$criteria->add(CotProductoPeer::CA_IDTAREA, $this->ca_idtarea);

				$this->collCotProductos = CotProductoPeer::doSelectJoinCotizacion($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CotProductoPeer::CA_IDTAREA, $this->ca_idtarea);

			if (!isset($this->lastCotProductoCriteria) || !$this->lastCotProductoCriteria->equals($criteria)) {
				$this->collCotProductos = CotProductoPeer::doSelectJoinCotizacion($criteria, $con, $join_behavior);
			}
		}
		$this->lastCotProductoCriteria = $criteria;

		return $this->collCotProductos;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this NotTarea is new, it will return
	 * an empty collection; or if this NotTarea has previously
	 * been saved, it will retrieve related CotProductos from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in NotTarea.
	 */
	public function getCotProductosJoinTransportador($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotProductos === null) {
			if ($this->isNew()) {
				$this->collCotProductos = array();
			} else {

				$criteria->add(CotProductoPeer::CA_IDTAREA, $this->ca_idtarea);

				$this->collCotProductos = CotProductoPeer::doSelectJoinTransportador($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CotProductoPeer::CA_IDTAREA, $this->ca_idtarea);

			if (!isset($this->lastCotProductoCriteria) || !$this->lastCotProductoCriteria->equals($criteria)) {
				$this->collCotProductos = CotProductoPeer::doSelectJoinTransportador($criteria, $con, $join_behavior);
			}
		}
		$this->lastCotProductoCriteria = $criteria;

		return $this->collCotProductos;
	}

	/**
	 * Clears out the collHdeskTickets collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addHdeskTickets()
	 */
	public function clearHdeskTickets()
	{
		$this->collHdeskTickets = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collHdeskTickets collection (array).
	 *
	 * By default this just sets the collHdeskTickets collection to an empty array (like clearcollHdeskTickets());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initHdeskTickets()
	{
		$this->collHdeskTickets = array();
	}

	/**
	 * Gets an array of HdeskTicket objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this NotTarea has previously been saved, it will retrieve
	 * related HdeskTickets from storage. If this NotTarea is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array HdeskTicket[]
	 * @throws     PropelException
	 */
	public function getHdeskTickets($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskTickets === null) {
			if ($this->isNew()) {
			   $this->collHdeskTickets = array();
			} else {

				$criteria->add(HdeskTicketPeer::CA_IDTAREA, $this->ca_idtarea);

				HdeskTicketPeer::addSelectColumns($criteria);
				$this->collHdeskTickets = HdeskTicketPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(HdeskTicketPeer::CA_IDTAREA, $this->ca_idtarea);

				HdeskTicketPeer::addSelectColumns($criteria);
				if (!isset($this->lastHdeskTicketCriteria) || !$this->lastHdeskTicketCriteria->equals($criteria)) {
					$this->collHdeskTickets = HdeskTicketPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastHdeskTicketCriteria = $criteria;
		return $this->collHdeskTickets;
	}

	/**
	 * Returns the number of related HdeskTicket objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related HdeskTicket objects.
	 * @throws     PropelException
	 */
	public function countHdeskTickets(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collHdeskTickets === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(HdeskTicketPeer::CA_IDTAREA, $this->ca_idtarea);

				$count = HdeskTicketPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(HdeskTicketPeer::CA_IDTAREA, $this->ca_idtarea);

				if (!isset($this->lastHdeskTicketCriteria) || !$this->lastHdeskTicketCriteria->equals($criteria)) {
					$count = HdeskTicketPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collHdeskTickets);
				}
			} else {
				$count = count($this->collHdeskTickets);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a HdeskTicket object to this object
	 * through the HdeskTicket foreign key attribute.
	 *
	 * @param      HdeskTicket $l HdeskTicket
	 * @return     void
	 * @throws     PropelException
	 */
	public function addHdeskTicket(HdeskTicket $l)
	{
		if ($this->collHdeskTickets === null) {
			$this->initHdeskTickets();
		}
		if (!in_array($l, $this->collHdeskTickets, true)) { // only add it if the **same** object is not already associated
			array_push($this->collHdeskTickets, $l);
			$l->setNotTarea($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this NotTarea is new, it will return
	 * an empty collection; or if this NotTarea has previously
	 * been saved, it will retrieve related HdeskTickets from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in NotTarea.
	 */
	public function getHdeskTicketsJoinHdeskGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskTickets === null) {
			if ($this->isNew()) {
				$this->collHdeskTickets = array();
			} else {

				$criteria->add(HdeskTicketPeer::CA_IDTAREA, $this->ca_idtarea);

				$this->collHdeskTickets = HdeskTicketPeer::doSelectJoinHdeskGroup($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(HdeskTicketPeer::CA_IDTAREA, $this->ca_idtarea);

			if (!isset($this->lastHdeskTicketCriteria) || !$this->lastHdeskTicketCriteria->equals($criteria)) {
				$this->collHdeskTickets = HdeskTicketPeer::doSelectJoinHdeskGroup($criteria, $con, $join_behavior);
			}
		}
		$this->lastHdeskTicketCriteria = $criteria;

		return $this->collHdeskTickets;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this NotTarea is new, it will return
	 * an empty collection; or if this NotTarea has previously
	 * been saved, it will retrieve related HdeskTickets from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in NotTarea.
	 */
	public function getHdeskTicketsJoinUsuario($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskTickets === null) {
			if ($this->isNew()) {
				$this->collHdeskTickets = array();
			} else {

				$criteria->add(HdeskTicketPeer::CA_IDTAREA, $this->ca_idtarea);

				$this->collHdeskTickets = HdeskTicketPeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(HdeskTicketPeer::CA_IDTAREA, $this->ca_idtarea);

			if (!isset($this->lastHdeskTicketCriteria) || !$this->lastHdeskTicketCriteria->equals($criteria)) {
				$this->collHdeskTickets = HdeskTicketPeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		}
		$this->lastHdeskTicketCriteria = $criteria;

		return $this->collHdeskTickets;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this NotTarea is new, it will return
	 * an empty collection; or if this NotTarea has previously
	 * been saved, it will retrieve related HdeskTickets from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in NotTarea.
	 */
	public function getHdeskTicketsJoinHdeskProject($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskTickets === null) {
			if ($this->isNew()) {
				$this->collHdeskTickets = array();
			} else {

				$criteria->add(HdeskTicketPeer::CA_IDTAREA, $this->ca_idtarea);

				$this->collHdeskTickets = HdeskTicketPeer::doSelectJoinHdeskProject($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(HdeskTicketPeer::CA_IDTAREA, $this->ca_idtarea);

			if (!isset($this->lastHdeskTicketCriteria) || !$this->lastHdeskTicketCriteria->equals($criteria)) {
				$this->collHdeskTickets = HdeskTicketPeer::doSelectJoinHdeskProject($criteria, $con, $join_behavior);
			}
		}
		$this->lastHdeskTicketCriteria = $criteria;

		return $this->collHdeskTickets;
	}

	/**
	 * Clears out the collNotificacions collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addNotificacions()
	 */
	public function clearNotificacions()
	{
		$this->collNotificacions = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collNotificacions collection (array).
	 *
	 * By default this just sets the collNotificacions collection to an empty array (like clearcollNotificacions());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initNotificacions()
	{
		$this->collNotificacions = array();
	}

	/**
	 * Gets an array of Notificacion objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this NotTarea has previously been saved, it will retrieve
	 * related Notificacions from storage. If this NotTarea is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array Notificacion[]
	 * @throws     PropelException
	 */
	public function getNotificacions($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNotificacions === null) {
			if ($this->isNew()) {
			   $this->collNotificacions = array();
			} else {

				$criteria->add(NotificacionPeer::CA_IDTAREA, $this->ca_idtarea);

				NotificacionPeer::addSelectColumns($criteria);
				$this->collNotificacions = NotificacionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(NotificacionPeer::CA_IDTAREA, $this->ca_idtarea);

				NotificacionPeer::addSelectColumns($criteria);
				if (!isset($this->lastNotificacionCriteria) || !$this->lastNotificacionCriteria->equals($criteria)) {
					$this->collNotificacions = NotificacionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastNotificacionCriteria = $criteria;
		return $this->collNotificacions;
	}

	/**
	 * Returns the number of related Notificacion objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Notificacion objects.
	 * @throws     PropelException
	 */
	public function countNotificacions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collNotificacions === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(NotificacionPeer::CA_IDTAREA, $this->ca_idtarea);

				$count = NotificacionPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(NotificacionPeer::CA_IDTAREA, $this->ca_idtarea);

				if (!isset($this->lastNotificacionCriteria) || !$this->lastNotificacionCriteria->equals($criteria)) {
					$count = NotificacionPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collNotificacions);
				}
			} else {
				$count = count($this->collNotificacions);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a Notificacion object to this object
	 * through the Notificacion foreign key attribute.
	 *
	 * @param      Notificacion $l Notificacion
	 * @return     void
	 * @throws     PropelException
	 */
	public function addNotificacion(Notificacion $l)
	{
		if ($this->collNotificacions === null) {
			$this->initNotificacions();
		}
		if (!in_array($l, $this->collNotificacions, true)) { // only add it if the **same** object is not already associated
			array_push($this->collNotificacions, $l);
			$l->setNotTarea($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this NotTarea is new, it will return
	 * an empty collection; or if this NotTarea has previously
	 * been saved, it will retrieve related Notificacions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in NotTarea.
	 */
	public function getNotificacionsJoinEmail($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNotificacions === null) {
			if ($this->isNew()) {
				$this->collNotificacions = array();
			} else {

				$criteria->add(NotificacionPeer::CA_IDTAREA, $this->ca_idtarea);

				$this->collNotificacions = NotificacionPeer::doSelectJoinEmail($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(NotificacionPeer::CA_IDTAREA, $this->ca_idtarea);

			if (!isset($this->lastNotificacionCriteria) || !$this->lastNotificacionCriteria->equals($criteria)) {
				$this->collNotificacions = NotificacionPeer::doSelectJoinEmail($criteria, $con, $join_behavior);
			}
		}
		$this->lastNotificacionCriteria = $criteria;

		return $this->collNotificacions;
	}

	/**
	 * Clears out the collNotTareaAsignacions collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addNotTareaAsignacions()
	 */
	public function clearNotTareaAsignacions()
	{
		$this->collNotTareaAsignacions = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collNotTareaAsignacions collection (array).
	 *
	 * By default this just sets the collNotTareaAsignacions collection to an empty array (like clearcollNotTareaAsignacions());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initNotTareaAsignacions()
	{
		$this->collNotTareaAsignacions = array();
	}

	/**
	 * Gets an array of NotTareaAsignacion objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this NotTarea has previously been saved, it will retrieve
	 * related NotTareaAsignacions from storage. If this NotTarea is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array NotTareaAsignacion[]
	 * @throws     PropelException
	 */
	public function getNotTareaAsignacions($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNotTareaAsignacions === null) {
			if ($this->isNew()) {
			   $this->collNotTareaAsignacions = array();
			} else {

				$criteria->add(NotTareaAsignacionPeer::CA_IDTAREA, $this->ca_idtarea);

				NotTareaAsignacionPeer::addSelectColumns($criteria);
				$this->collNotTareaAsignacions = NotTareaAsignacionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(NotTareaAsignacionPeer::CA_IDTAREA, $this->ca_idtarea);

				NotTareaAsignacionPeer::addSelectColumns($criteria);
				if (!isset($this->lastNotTareaAsignacionCriteria) || !$this->lastNotTareaAsignacionCriteria->equals($criteria)) {
					$this->collNotTareaAsignacions = NotTareaAsignacionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastNotTareaAsignacionCriteria = $criteria;
		return $this->collNotTareaAsignacions;
	}

	/**
	 * Returns the number of related NotTareaAsignacion objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related NotTareaAsignacion objects.
	 * @throws     PropelException
	 */
	public function countNotTareaAsignacions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collNotTareaAsignacions === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(NotTareaAsignacionPeer::CA_IDTAREA, $this->ca_idtarea);

				$count = NotTareaAsignacionPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(NotTareaAsignacionPeer::CA_IDTAREA, $this->ca_idtarea);

				if (!isset($this->lastNotTareaAsignacionCriteria) || !$this->lastNotTareaAsignacionCriteria->equals($criteria)) {
					$count = NotTareaAsignacionPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collNotTareaAsignacions);
				}
			} else {
				$count = count($this->collNotTareaAsignacions);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a NotTareaAsignacion object to this object
	 * through the NotTareaAsignacion foreign key attribute.
	 *
	 * @param      NotTareaAsignacion $l NotTareaAsignacion
	 * @return     void
	 * @throws     PropelException
	 */
	public function addNotTareaAsignacion(NotTareaAsignacion $l)
	{
		if ($this->collNotTareaAsignacions === null) {
			$this->initNotTareaAsignacions();
		}
		if (!in_array($l, $this->collNotTareaAsignacions, true)) { // only add it if the **same** object is not already associated
			array_push($this->collNotTareaAsignacions, $l);
			$l->setNotTarea($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this NotTarea is new, it will return
	 * an empty collection; or if this NotTarea has previously
	 * been saved, it will retrieve related NotTareaAsignacions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in NotTarea.
	 */
	public function getNotTareaAsignacionsJoinUsuario($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNotTareaAsignacions === null) {
			if ($this->isNew()) {
				$this->collNotTareaAsignacions = array();
			} else {

				$criteria->add(NotTareaAsignacionPeer::CA_IDTAREA, $this->ca_idtarea);

				$this->collNotTareaAsignacions = NotTareaAsignacionPeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(NotTareaAsignacionPeer::CA_IDTAREA, $this->ca_idtarea);

			if (!isset($this->lastNotTareaAsignacionCriteria) || !$this->lastNotTareaAsignacionCriteria->equals($criteria)) {
				$this->collNotTareaAsignacions = NotTareaAsignacionPeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		}
		$this->lastNotTareaAsignacionCriteria = $criteria;

		return $this->collNotTareaAsignacions;
	}

	/**
	 * Clears out the collReportes collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addReportes()
	 */
	public function clearReportes()
	{
		$this->collReportes = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collReportes collection (array).
	 *
	 * By default this just sets the collReportes collection to an empty array (like clearcollReportes());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initReportes()
	{
		$this->collReportes = array();
	}

	/**
	 * Gets an array of Reporte objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this NotTarea has previously been saved, it will retrieve
	 * related Reportes from storage. If this NotTarea is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array Reporte[]
	 * @throws     PropelException
	 */
	public function getReportes($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
			   $this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDSEGUIMIENTO, $this->ca_idtarea);

				ReportePeer::addSelectColumns($criteria);
				$this->collReportes = ReportePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ReportePeer::CA_IDSEGUIMIENTO, $this->ca_idtarea);

				ReportePeer::addSelectColumns($criteria);
				if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
					$this->collReportes = ReportePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastReporteCriteria = $criteria;
		return $this->collReportes;
	}

	/**
	 * Returns the number of related Reporte objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Reporte objects.
	 * @throws     PropelException
	 */
	public function countReportes(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(ReportePeer::CA_IDSEGUIMIENTO, $this->ca_idtarea);

				$count = ReportePeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(ReportePeer::CA_IDSEGUIMIENTO, $this->ca_idtarea);

				if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
					$count = ReportePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collReportes);
				}
			} else {
				$count = count($this->collReportes);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a Reporte object to this object
	 * through the Reporte foreign key attribute.
	 *
	 * @param      Reporte $l Reporte
	 * @return     void
	 * @throws     PropelException
	 */
	public function addReporte(Reporte $l)
	{
		if ($this->collReportes === null) {
			$this->initReportes();
		}
		if (!in_array($l, $this->collReportes, true)) { // only add it if the **same** object is not already associated
			array_push($this->collReportes, $l);
			$l->setNotTarea($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this NotTarea is new, it will return
	 * an empty collection; or if this NotTarea has previously
	 * been saved, it will retrieve related Reportes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in NotTarea.
	 */
	public function getReportesJoinUsuario($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDSEGUIMIENTO, $this->ca_idtarea);

				$this->collReportes = ReportePeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ReportePeer::CA_IDSEGUIMIENTO, $this->ca_idtarea);

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		}
		$this->lastReporteCriteria = $criteria;

		return $this->collReportes;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this NotTarea is new, it will return
	 * an empty collection; or if this NotTarea has previously
	 * been saved, it will retrieve related Reportes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in NotTarea.
	 */
	public function getReportesJoinTransportador($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDSEGUIMIENTO, $this->ca_idtarea);

				$this->collReportes = ReportePeer::doSelectJoinTransportador($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ReportePeer::CA_IDSEGUIMIENTO, $this->ca_idtarea);

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinTransportador($criteria, $con, $join_behavior);
			}
		}
		$this->lastReporteCriteria = $criteria;

		return $this->collReportes;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this NotTarea is new, it will return
	 * an empty collection; or if this NotTarea has previously
	 * been saved, it will retrieve related Reportes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in NotTarea.
	 */
	public function getReportesJoinTercero($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDSEGUIMIENTO, $this->ca_idtarea);

				$this->collReportes = ReportePeer::doSelectJoinTercero($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ReportePeer::CA_IDSEGUIMIENTO, $this->ca_idtarea);

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinTercero($criteria, $con, $join_behavior);
			}
		}
		$this->lastReporteCriteria = $criteria;

		return $this->collReportes;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this NotTarea is new, it will return
	 * an empty collection; or if this NotTarea has previously
	 * been saved, it will retrieve related Reportes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in NotTarea.
	 */
	public function getReportesJoinAgente($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDSEGUIMIENTO, $this->ca_idtarea);

				$this->collReportes = ReportePeer::doSelectJoinAgente($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ReportePeer::CA_IDSEGUIMIENTO, $this->ca_idtarea);

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinAgente($criteria, $con, $join_behavior);
			}
		}
		$this->lastReporteCriteria = $criteria;

		return $this->collReportes;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this NotTarea is new, it will return
	 * an empty collection; or if this NotTarea has previously
	 * been saved, it will retrieve related Reportes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in NotTarea.
	 */
	public function getReportesJoinBodega($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDSEGUIMIENTO, $this->ca_idtarea);

				$this->collReportes = ReportePeer::doSelectJoinBodega($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ReportePeer::CA_IDSEGUIMIENTO, $this->ca_idtarea);

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinBodega($criteria, $con, $join_behavior);
			}
		}
		$this->lastReporteCriteria = $criteria;

		return $this->collReportes;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this NotTarea is new, it will return
	 * an empty collection; or if this NotTarea has previously
	 * been saved, it will retrieve related Reportes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in NotTarea.
	 */
	public function getReportesJoinTrackingEtapa($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDSEGUIMIENTO, $this->ca_idtarea);

				$this->collReportes = ReportePeer::doSelectJoinTrackingEtapa($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ReportePeer::CA_IDSEGUIMIENTO, $this->ca_idtarea);

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinTrackingEtapa($criteria, $con, $join_behavior);
			}
		}
		$this->lastReporteCriteria = $criteria;

		return $this->collReportes;
	}

	/**
	 * Clears out the collRepAsignacions collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addRepAsignacions()
	 */
	public function clearRepAsignacions()
	{
		$this->collRepAsignacions = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collRepAsignacions collection (array).
	 *
	 * By default this just sets the collRepAsignacions collection to an empty array (like clearcollRepAsignacions());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initRepAsignacions()
	{
		$this->collRepAsignacions = array();
	}

	/**
	 * Gets an array of RepAsignacion objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this NotTarea has previously been saved, it will retrieve
	 * related RepAsignacions from storage. If this NotTarea is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array RepAsignacion[]
	 * @throws     PropelException
	 */
	public function getRepAsignacions($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepAsignacions === null) {
			if ($this->isNew()) {
			   $this->collRepAsignacions = array();
			} else {

				$criteria->add(RepAsignacionPeer::CA_IDTAREA, $this->ca_idtarea);

				RepAsignacionPeer::addSelectColumns($criteria);
				$this->collRepAsignacions = RepAsignacionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RepAsignacionPeer::CA_IDTAREA, $this->ca_idtarea);

				RepAsignacionPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepAsignacionCriteria) || !$this->lastRepAsignacionCriteria->equals($criteria)) {
					$this->collRepAsignacions = RepAsignacionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepAsignacionCriteria = $criteria;
		return $this->collRepAsignacions;
	}

	/**
	 * Returns the number of related RepAsignacion objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related RepAsignacion objects.
	 * @throws     PropelException
	 */
	public function countRepAsignacions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collRepAsignacions === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(RepAsignacionPeer::CA_IDTAREA, $this->ca_idtarea);

				$count = RepAsignacionPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(RepAsignacionPeer::CA_IDTAREA, $this->ca_idtarea);

				if (!isset($this->lastRepAsignacionCriteria) || !$this->lastRepAsignacionCriteria->equals($criteria)) {
					$count = RepAsignacionPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collRepAsignacions);
				}
			} else {
				$count = count($this->collRepAsignacions);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a RepAsignacion object to this object
	 * through the RepAsignacion foreign key attribute.
	 *
	 * @param      RepAsignacion $l RepAsignacion
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRepAsignacion(RepAsignacion $l)
	{
		if ($this->collRepAsignacions === null) {
			$this->initRepAsignacions();
		}
		if (!in_array($l, $this->collRepAsignacions, true)) { // only add it if the **same** object is not already associated
			array_push($this->collRepAsignacions, $l);
			$l->setNotTarea($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this NotTarea is new, it will return
	 * an empty collection; or if this NotTarea has previously
	 * been saved, it will retrieve related RepAsignacions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in NotTarea.
	 */
	public function getRepAsignacionsJoinReporte($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepAsignacions === null) {
			if ($this->isNew()) {
				$this->collRepAsignacions = array();
			} else {

				$criteria->add(RepAsignacionPeer::CA_IDTAREA, $this->ca_idtarea);

				$this->collRepAsignacions = RepAsignacionPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RepAsignacionPeer::CA_IDTAREA, $this->ca_idtarea);

			if (!isset($this->lastRepAsignacionCriteria) || !$this->lastRepAsignacionCriteria->equals($criteria)) {
				$this->collRepAsignacions = RepAsignacionPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		}
		$this->lastRepAsignacionCriteria = $criteria;

		return $this->collRepAsignacions;
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
			if ($this->collCotizacions) {
				foreach ((array) $this->collCotizacions as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collCotProductos) {
				foreach ((array) $this->collCotProductos as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collHdeskTickets) {
				foreach ((array) $this->collHdeskTickets as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collNotificacions) {
				foreach ((array) $this->collNotificacions as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collNotTareaAsignacions) {
				foreach ((array) $this->collNotTareaAsignacions as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collReportes) {
				foreach ((array) $this->collReportes as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collRepAsignacions) {
				foreach ((array) $this->collRepAsignacions as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collCotizacions = null;
		$this->collCotProductos = null;
		$this->collHdeskTickets = null;
		$this->collNotificacions = null;
		$this->collNotTareaAsignacions = null;
		$this->collReportes = null;
		$this->collRepAsignacions = null;
			$this->aNotListaTareas = null;
	}

} // BaseNotTarea
