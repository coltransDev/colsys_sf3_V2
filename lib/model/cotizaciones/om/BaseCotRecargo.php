<?php

/**
 * Base class that represents a row from the 'tb_cotrecargos' table.
 *
 * 
 *
 * @package    lib.model.cotizaciones.om
 */
abstract class BaseCotRecargo extends BaseObject  implements Persistent {


  const PEER = 'CotRecargoPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        CotRecargoPeer
	 */
	protected static $peer;

	/**
	 * The value for the ca_idcotizacion field.
	 * @var        int
	 */
	protected $ca_idcotizacion;

	/**
	 * The value for the ca_idproducto field.
	 * @var        int
	 */
	protected $ca_idproducto;

	/**
	 * The value for the ca_idopcion field.
	 * @var        int
	 */
	protected $ca_idopcion;

	/**
	 * The value for the ca_idconcepto field.
	 * @var        int
	 */
	protected $ca_idconcepto;

	/**
	 * The value for the ca_idrecargo field.
	 * @var        int
	 */
	protected $ca_idrecargo;

	/**
	 * The value for the ca_tipo field.
	 * @var        string
	 */
	protected $ca_tipo;

	/**
	 * The value for the ca_valor_tar field.
	 * @var        string
	 */
	protected $ca_valor_tar;

	/**
	 * The value for the ca_aplica_tar field.
	 * @var        string
	 */
	protected $ca_aplica_tar;

	/**
	 * The value for the ca_valor_min field.
	 * @var        string
	 */
	protected $ca_valor_min;

	/**
	 * The value for the ca_aplica_min field.
	 * @var        string
	 */
	protected $ca_aplica_min;

	/**
	 * The value for the ca_idmoneda field.
	 * @var        string
	 */
	protected $ca_idmoneda;

	/**
	 * The value for the ca_modalidad field.
	 * @var        string
	 */
	protected $ca_modalidad;

	/**
	 * The value for the ca_observaciones field.
	 * @var        string
	 */
	protected $ca_observaciones;

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
	 * @var        CotOpcion
	 */
	protected $aCotOpcion;

	/**
	 * @var        TipoRecargo
	 */
	protected $aTipoRecargo;

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
	 * Initializes internal state of BaseCotRecargo object.
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
	 * Get the [ca_idproducto] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdproducto()
	{
		return $this->ca_idproducto;
	}

	/**
	 * Get the [ca_idopcion] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdopcion()
	{
		return $this->ca_idopcion;
	}

	/**
	 * Get the [ca_idconcepto] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdconcepto()
	{
		return $this->ca_idconcepto;
	}

	/**
	 * Get the [ca_idrecargo] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdrecargo()
	{
		return $this->ca_idrecargo;
	}

	/**
	 * Get the [ca_tipo] column value.
	 * 
	 * @return     string
	 */
	public function getCaTipo()
	{
		return $this->ca_tipo;
	}

	/**
	 * Get the [ca_valor_tar] column value.
	 * 
	 * @return     string
	 */
	public function getCaValorTar()
	{
		return $this->ca_valor_tar;
	}

	/**
	 * Get the [ca_aplica_tar] column value.
	 * 
	 * @return     string
	 */
	public function getCaAplicaTar()
	{
		return $this->ca_aplica_tar;
	}

	/**
	 * Get the [ca_valor_min] column value.
	 * 
	 * @return     string
	 */
	public function getCaValorMin()
	{
		return $this->ca_valor_min;
	}

	/**
	 * Get the [ca_aplica_min] column value.
	 * 
	 * @return     string
	 */
	public function getCaAplicaMin()
	{
		return $this->ca_aplica_min;
	}

	/**
	 * Get the [ca_idmoneda] column value.
	 * 
	 * @return     string
	 */
	public function getCaIdmoneda()
	{
		return $this->ca_idmoneda;
	}

	/**
	 * Get the [ca_modalidad] column value.
	 * 
	 * @return     string
	 */
	public function getCaModalidad()
	{
		return $this->ca_modalidad;
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
	 * Set the value of [ca_idcotizacion] column.
	 * 
	 * @param      int $v new value
	 * @return     CotRecargo The current object (for fluent API support)
	 */
	public function setCaIdcotizacion($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idcotizacion !== $v) {
			$this->ca_idcotizacion = $v;
			$this->modifiedColumns[] = CotRecargoPeer::CA_IDCOTIZACION;
		}

		return $this;
	} // setCaIdcotizacion()

	/**
	 * Set the value of [ca_idproducto] column.
	 * 
	 * @param      int $v new value
	 * @return     CotRecargo The current object (for fluent API support)
	 */
	public function setCaIdproducto($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idproducto !== $v) {
			$this->ca_idproducto = $v;
			$this->modifiedColumns[] = CotRecargoPeer::CA_IDPRODUCTO;
		}

		return $this;
	} // setCaIdproducto()

	/**
	 * Set the value of [ca_idopcion] column.
	 * 
	 * @param      int $v new value
	 * @return     CotRecargo The current object (for fluent API support)
	 */
	public function setCaIdopcion($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idopcion !== $v) {
			$this->ca_idopcion = $v;
			$this->modifiedColumns[] = CotRecargoPeer::CA_IDOPCION;
		}

		if ($this->aCotOpcion !== null && $this->aCotOpcion->getCaIdopcion() !== $v) {
			$this->aCotOpcion = null;
		}

		return $this;
	} // setCaIdopcion()

	/**
	 * Set the value of [ca_idconcepto] column.
	 * 
	 * @param      int $v new value
	 * @return     CotRecargo The current object (for fluent API support)
	 */
	public function setCaIdconcepto($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idconcepto !== $v) {
			$this->ca_idconcepto = $v;
			$this->modifiedColumns[] = CotRecargoPeer::CA_IDCONCEPTO;
		}

		return $this;
	} // setCaIdconcepto()

	/**
	 * Set the value of [ca_idrecargo] column.
	 * 
	 * @param      int $v new value
	 * @return     CotRecargo The current object (for fluent API support)
	 */
	public function setCaIdrecargo($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idrecargo !== $v) {
			$this->ca_idrecargo = $v;
			$this->modifiedColumns[] = CotRecargoPeer::CA_IDRECARGO;
		}

		if ($this->aTipoRecargo !== null && $this->aTipoRecargo->getCaIdrecargo() !== $v) {
			$this->aTipoRecargo = null;
		}

		return $this;
	} // setCaIdrecargo()

	/**
	 * Set the value of [ca_tipo] column.
	 * 
	 * @param      string $v new value
	 * @return     CotRecargo The current object (for fluent API support)
	 */
	public function setCaTipo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_tipo !== $v) {
			$this->ca_tipo = $v;
			$this->modifiedColumns[] = CotRecargoPeer::CA_TIPO;
		}

		return $this;
	} // setCaTipo()

	/**
	 * Set the value of [ca_valor_tar] column.
	 * 
	 * @param      string $v new value
	 * @return     CotRecargo The current object (for fluent API support)
	 */
	public function setCaValorTar($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_valor_tar !== $v) {
			$this->ca_valor_tar = $v;
			$this->modifiedColumns[] = CotRecargoPeer::CA_VALOR_TAR;
		}

		return $this;
	} // setCaValorTar()

	/**
	 * Set the value of [ca_aplica_tar] column.
	 * 
	 * @param      string $v new value
	 * @return     CotRecargo The current object (for fluent API support)
	 */
	public function setCaAplicaTar($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_aplica_tar !== $v) {
			$this->ca_aplica_tar = $v;
			$this->modifiedColumns[] = CotRecargoPeer::CA_APLICA_TAR;
		}

		return $this;
	} // setCaAplicaTar()

	/**
	 * Set the value of [ca_valor_min] column.
	 * 
	 * @param      string $v new value
	 * @return     CotRecargo The current object (for fluent API support)
	 */
	public function setCaValorMin($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_valor_min !== $v) {
			$this->ca_valor_min = $v;
			$this->modifiedColumns[] = CotRecargoPeer::CA_VALOR_MIN;
		}

		return $this;
	} // setCaValorMin()

	/**
	 * Set the value of [ca_aplica_min] column.
	 * 
	 * @param      string $v new value
	 * @return     CotRecargo The current object (for fluent API support)
	 */
	public function setCaAplicaMin($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_aplica_min !== $v) {
			$this->ca_aplica_min = $v;
			$this->modifiedColumns[] = CotRecargoPeer::CA_APLICA_MIN;
		}

		return $this;
	} // setCaAplicaMin()

	/**
	 * Set the value of [ca_idmoneda] column.
	 * 
	 * @param      string $v new value
	 * @return     CotRecargo The current object (for fluent API support)
	 */
	public function setCaIdmoneda($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idmoneda !== $v) {
			$this->ca_idmoneda = $v;
			$this->modifiedColumns[] = CotRecargoPeer::CA_IDMONEDA;
		}

		return $this;
	} // setCaIdmoneda()

	/**
	 * Set the value of [ca_modalidad] column.
	 * 
	 * @param      string $v new value
	 * @return     CotRecargo The current object (for fluent API support)
	 */
	public function setCaModalidad($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_modalidad !== $v) {
			$this->ca_modalidad = $v;
			$this->modifiedColumns[] = CotRecargoPeer::CA_MODALIDAD;
		}

		return $this;
	} // setCaModalidad()

	/**
	 * Set the value of [ca_observaciones] column.
	 * 
	 * @param      string $v new value
	 * @return     CotRecargo The current object (for fluent API support)
	 */
	public function setCaObservaciones($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_observaciones !== $v) {
			$this->ca_observaciones = $v;
			$this->modifiedColumns[] = CotRecargoPeer::CA_OBSERVACIONES;
		}

		return $this;
	} // setCaObservaciones()

	/**
	 * Sets the value of [ca_fchcreado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     CotRecargo The current object (for fluent API support)
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
				$this->modifiedColumns[] = CotRecargoPeer::CA_FCHCREADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchcreado()

	/**
	 * Set the value of [ca_usucreado] column.
	 * 
	 * @param      string $v new value
	 * @return     CotRecargo The current object (for fluent API support)
	 */
	public function setCaUsucreado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usucreado !== $v) {
			$this->ca_usucreado = $v;
			$this->modifiedColumns[] = CotRecargoPeer::CA_USUCREADO;
		}

		return $this;
	} // setCaUsucreado()

	/**
	 * Sets the value of [ca_fchactualizado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     CotRecargo The current object (for fluent API support)
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
				$this->modifiedColumns[] = CotRecargoPeer::CA_FCHACTUALIZADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchactualizado()

	/**
	 * Set the value of [ca_usuactualizado] column.
	 * 
	 * @param      string $v new value
	 * @return     CotRecargo The current object (for fluent API support)
	 */
	public function setCaUsuactualizado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usuactualizado !== $v) {
			$this->ca_usuactualizado = $v;
			$this->modifiedColumns[] = CotRecargoPeer::CA_USUACTUALIZADO;
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

			$this->ca_idcotizacion = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_idproducto = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_idopcion = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->ca_idconcepto = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->ca_idrecargo = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->ca_tipo = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_valor_tar = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_aplica_tar = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_valor_min = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_aplica_min = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_idmoneda = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_modalidad = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_observaciones = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_fchcreado = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->ca_usucreado = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->ca_fchactualizado = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->ca_usuactualizado = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 17; // 17 = CotRecargoPeer::NUM_COLUMNS - CotRecargoPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating CotRecargo object", $e);
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

		if ($this->aCotOpcion !== null && $this->ca_idopcion !== $this->aCotOpcion->getCaIdopcion()) {
			$this->aCotOpcion = null;
		}
		if ($this->aTipoRecargo !== null && $this->ca_idrecargo !== $this->aTipoRecargo->getCaIdrecargo()) {
			$this->aTipoRecargo = null;
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
			$con = Propel::getConnection(CotRecargoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = CotRecargoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aCotOpcion = null;
			$this->aTipoRecargo = null;
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
			$con = Propel::getConnection(CotRecargoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			CotRecargoPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(CotRecargoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			CotRecargoPeer::addInstanceToPool($this);
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

			if ($this->aCotOpcion !== null) {
				if ($this->aCotOpcion->isModified() || $this->aCotOpcion->isNew()) {
					$affectedRows += $this->aCotOpcion->save($con);
				}
				$this->setCotOpcion($this->aCotOpcion);
			}

			if ($this->aTipoRecargo !== null) {
				if ($this->aTipoRecargo->isModified() || $this->aTipoRecargo->isNew()) {
					$affectedRows += $this->aTipoRecargo->save($con);
				}
				$this->setTipoRecargo($this->aTipoRecargo);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = CotRecargoPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += CotRecargoPeer::doUpdate($this, $con);
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

			if ($this->aCotOpcion !== null) {
				if (!$this->aCotOpcion->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCotOpcion->getValidationFailures());
				}
			}

			if ($this->aTipoRecargo !== null) {
				if (!$this->aTipoRecargo->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTipoRecargo->getValidationFailures());
				}
			}


			if (($retval = CotRecargoPeer::doValidate($this, $columns)) !== true) {
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
		$pos = CotRecargoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdproducto();
				break;
			case 2:
				return $this->getCaIdopcion();
				break;
			case 3:
				return $this->getCaIdconcepto();
				break;
			case 4:
				return $this->getCaIdrecargo();
				break;
			case 5:
				return $this->getCaTipo();
				break;
			case 6:
				return $this->getCaValorTar();
				break;
			case 7:
				return $this->getCaAplicaTar();
				break;
			case 8:
				return $this->getCaValorMin();
				break;
			case 9:
				return $this->getCaAplicaMin();
				break;
			case 10:
				return $this->getCaIdmoneda();
				break;
			case 11:
				return $this->getCaModalidad();
				break;
			case 12:
				return $this->getCaObservaciones();
				break;
			case 13:
				return $this->getCaFchcreado();
				break;
			case 14:
				return $this->getCaUsucreado();
				break;
			case 15:
				return $this->getCaFchactualizado();
				break;
			case 16:
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
		$keys = CotRecargoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdcotizacion(),
			$keys[1] => $this->getCaIdproducto(),
			$keys[2] => $this->getCaIdopcion(),
			$keys[3] => $this->getCaIdconcepto(),
			$keys[4] => $this->getCaIdrecargo(),
			$keys[5] => $this->getCaTipo(),
			$keys[6] => $this->getCaValorTar(),
			$keys[7] => $this->getCaAplicaTar(),
			$keys[8] => $this->getCaValorMin(),
			$keys[9] => $this->getCaAplicaMin(),
			$keys[10] => $this->getCaIdmoneda(),
			$keys[11] => $this->getCaModalidad(),
			$keys[12] => $this->getCaObservaciones(),
			$keys[13] => $this->getCaFchcreado(),
			$keys[14] => $this->getCaUsucreado(),
			$keys[15] => $this->getCaFchactualizado(),
			$keys[16] => $this->getCaUsuactualizado(),
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
		$pos = CotRecargoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdproducto($value);
				break;
			case 2:
				$this->setCaIdopcion($value);
				break;
			case 3:
				$this->setCaIdconcepto($value);
				break;
			case 4:
				$this->setCaIdrecargo($value);
				break;
			case 5:
				$this->setCaTipo($value);
				break;
			case 6:
				$this->setCaValorTar($value);
				break;
			case 7:
				$this->setCaAplicaTar($value);
				break;
			case 8:
				$this->setCaValorMin($value);
				break;
			case 9:
				$this->setCaAplicaMin($value);
				break;
			case 10:
				$this->setCaIdmoneda($value);
				break;
			case 11:
				$this->setCaModalidad($value);
				break;
			case 12:
				$this->setCaObservaciones($value);
				break;
			case 13:
				$this->setCaFchcreado($value);
				break;
			case 14:
				$this->setCaUsucreado($value);
				break;
			case 15:
				$this->setCaFchactualizado($value);
				break;
			case 16:
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
		$keys = CotRecargoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdcotizacion($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdproducto($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaIdopcion($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaIdconcepto($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaIdrecargo($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaTipo($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaValorTar($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaAplicaTar($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaValorMin($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaAplicaMin($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaIdmoneda($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaModalidad($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaObservaciones($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaFchcreado($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaUsucreado($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaFchactualizado($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCaUsuactualizado($arr[$keys[16]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(CotRecargoPeer::DATABASE_NAME);

		if ($this->isColumnModified(CotRecargoPeer::CA_IDCOTIZACION)) $criteria->add(CotRecargoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);
		if ($this->isColumnModified(CotRecargoPeer::CA_IDPRODUCTO)) $criteria->add(CotRecargoPeer::CA_IDPRODUCTO, $this->ca_idproducto);
		if ($this->isColumnModified(CotRecargoPeer::CA_IDOPCION)) $criteria->add(CotRecargoPeer::CA_IDOPCION, $this->ca_idopcion);
		if ($this->isColumnModified(CotRecargoPeer::CA_IDCONCEPTO)) $criteria->add(CotRecargoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);
		if ($this->isColumnModified(CotRecargoPeer::CA_IDRECARGO)) $criteria->add(CotRecargoPeer::CA_IDRECARGO, $this->ca_idrecargo);
		if ($this->isColumnModified(CotRecargoPeer::CA_TIPO)) $criteria->add(CotRecargoPeer::CA_TIPO, $this->ca_tipo);
		if ($this->isColumnModified(CotRecargoPeer::CA_VALOR_TAR)) $criteria->add(CotRecargoPeer::CA_VALOR_TAR, $this->ca_valor_tar);
		if ($this->isColumnModified(CotRecargoPeer::CA_APLICA_TAR)) $criteria->add(CotRecargoPeer::CA_APLICA_TAR, $this->ca_aplica_tar);
		if ($this->isColumnModified(CotRecargoPeer::CA_VALOR_MIN)) $criteria->add(CotRecargoPeer::CA_VALOR_MIN, $this->ca_valor_min);
		if ($this->isColumnModified(CotRecargoPeer::CA_APLICA_MIN)) $criteria->add(CotRecargoPeer::CA_APLICA_MIN, $this->ca_aplica_min);
		if ($this->isColumnModified(CotRecargoPeer::CA_IDMONEDA)) $criteria->add(CotRecargoPeer::CA_IDMONEDA, $this->ca_idmoneda);
		if ($this->isColumnModified(CotRecargoPeer::CA_MODALIDAD)) $criteria->add(CotRecargoPeer::CA_MODALIDAD, $this->ca_modalidad);
		if ($this->isColumnModified(CotRecargoPeer::CA_OBSERVACIONES)) $criteria->add(CotRecargoPeer::CA_OBSERVACIONES, $this->ca_observaciones);
		if ($this->isColumnModified(CotRecargoPeer::CA_FCHCREADO)) $criteria->add(CotRecargoPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(CotRecargoPeer::CA_USUCREADO)) $criteria->add(CotRecargoPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(CotRecargoPeer::CA_FCHACTUALIZADO)) $criteria->add(CotRecargoPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(CotRecargoPeer::CA_USUACTUALIZADO)) $criteria->add(CotRecargoPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);

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
		$criteria = new Criteria(CotRecargoPeer::DATABASE_NAME);

		$criteria->add(CotRecargoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);
		$criteria->add(CotRecargoPeer::CA_IDPRODUCTO, $this->ca_idproducto);
		$criteria->add(CotRecargoPeer::CA_IDOPCION, $this->ca_idopcion);
		$criteria->add(CotRecargoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);
		$criteria->add(CotRecargoPeer::CA_IDRECARGO, $this->ca_idrecargo);
		$criteria->add(CotRecargoPeer::CA_MODALIDAD, $this->ca_modalidad);

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

		$pks[0] = $this->getCaIdcotizacion();

		$pks[1] = $this->getCaIdproducto();

		$pks[2] = $this->getCaIdopcion();

		$pks[3] = $this->getCaIdconcepto();

		$pks[4] = $this->getCaIdrecargo();

		$pks[5] = $this->getCaModalidad();

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

		$this->setCaIdcotizacion($keys[0]);

		$this->setCaIdproducto($keys[1]);

		$this->setCaIdopcion($keys[2]);

		$this->setCaIdconcepto($keys[3]);

		$this->setCaIdrecargo($keys[4]);

		$this->setCaModalidad($keys[5]);

	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of CotRecargo (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdcotizacion($this->ca_idcotizacion);

		$copyObj->setCaIdproducto($this->ca_idproducto);

		$copyObj->setCaIdopcion($this->ca_idopcion);

		$copyObj->setCaIdconcepto($this->ca_idconcepto);

		$copyObj->setCaIdrecargo($this->ca_idrecargo);

		$copyObj->setCaTipo($this->ca_tipo);

		$copyObj->setCaValorTar($this->ca_valor_tar);

		$copyObj->setCaAplicaTar($this->ca_aplica_tar);

		$copyObj->setCaValorMin($this->ca_valor_min);

		$copyObj->setCaAplicaMin($this->ca_aplica_min);

		$copyObj->setCaIdmoneda($this->ca_idmoneda);

		$copyObj->setCaModalidad($this->ca_modalidad);

		$copyObj->setCaObservaciones($this->ca_observaciones);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

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
	 * @return     CotRecargo Clone of current object.
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
	 * @return     CotRecargoPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new CotRecargoPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a CotOpcion object.
	 *
	 * @param      CotOpcion $v
	 * @return     CotRecargo The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setCotOpcion(CotOpcion $v = null)
	{
		if ($v === null) {
			$this->setCaIdopcion(NULL);
		} else {
			$this->setCaIdopcion($v->getCaIdopcion());
		}

		$this->aCotOpcion = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the CotOpcion object, it will not be re-added.
		if ($v !== null) {
			$v->addCotRecargo($this);
		}

		return $this;
	}


	/**
	 * Get the associated CotOpcion object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     CotOpcion The associated CotOpcion object.
	 * @throws     PropelException
	 */
	public function getCotOpcion(PropelPDO $con = null)
	{
		if ($this->aCotOpcion === null && ($this->ca_idopcion !== null)) {
			$c = new Criteria(CotOpcionPeer::DATABASE_NAME);
			$c->add(CotOpcionPeer::CA_IDOPCION, $this->ca_idopcion);
			$this->aCotOpcion = CotOpcionPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aCotOpcion->addCotRecargos($this);
			 */
		}
		return $this->aCotOpcion;
	}

	/**
	 * Declares an association between this object and a TipoRecargo object.
	 *
	 * @param      TipoRecargo $v
	 * @return     CotRecargo The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setTipoRecargo(TipoRecargo $v = null)
	{
		if ($v === null) {
			$this->setCaIdrecargo(NULL);
		} else {
			$this->setCaIdrecargo($v->getCaIdrecargo());
		}

		$this->aTipoRecargo = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the TipoRecargo object, it will not be re-added.
		if ($v !== null) {
			$v->addCotRecargo($this);
		}

		return $this;
	}


	/**
	 * Get the associated TipoRecargo object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     TipoRecargo The associated TipoRecargo object.
	 * @throws     PropelException
	 */
	public function getTipoRecargo(PropelPDO $con = null)
	{
		if ($this->aTipoRecargo === null && ($this->ca_idrecargo !== null)) {
			$c = new Criteria(TipoRecargoPeer::DATABASE_NAME);
			$c->add(TipoRecargoPeer::CA_IDRECARGO, $this->ca_idrecargo);
			$this->aTipoRecargo = TipoRecargoPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aTipoRecargo->addCotRecargos($this);
			 */
		}
		return $this->aTipoRecargo;
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

			$this->aCotOpcion = null;
			$this->aTipoRecargo = null;
	}

} // BaseCotRecargo
