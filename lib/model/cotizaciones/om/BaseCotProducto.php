<?php

/**
 * Base class that represents a row from the 'tb_cotproductos' table.
 *
 * 
 *
 * @package    lib.model.cotizaciones.om
 */
abstract class BaseCotProducto extends BaseObject  implements Persistent {


  const PEER = 'CotProductoPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        CotProductoPeer
	 */
	protected static $peer;

	/**
	 * The value for the ca_idproducto field.
	 * @var        int
	 */
	protected $ca_idproducto;

	/**
	 * The value for the ca_idcotizacion field.
	 * @var        int
	 */
	protected $ca_idcotizacion;

	/**
	 * The value for the ca_transporte field.
	 * @var        string
	 */
	protected $ca_transporte;

	/**
	 * The value for the ca_modalidad field.
	 * @var        string
	 */
	protected $ca_modalidad;

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
	 * The value for the ca_escala field.
	 * @var        string
	 */
	protected $ca_escala;

	/**
	 * The value for the ca_impoexpo field.
	 * @var        string
	 */
	protected $ca_impoexpo;

	/**
	 * The value for the ca_imprimir field.
	 * @var        string
	 */
	protected $ca_imprimir;

	/**
	 * The value for the ca_producto field.
	 * @var        string
	 */
	protected $ca_producto;

	/**
	 * The value for the ca_incoterms field.
	 * @var        string
	 */
	protected $ca_incoterms;

	/**
	 * The value for the ca_frecuencia field.
	 * @var        string
	 */
	protected $ca_frecuencia;

	/**
	 * The value for the ca_tiempotransito field.
	 * @var        string
	 */
	protected $ca_tiempotransito;

	/**
	 * The value for the ca_locrecargos field.
	 * @var        string
	 */
	protected $ca_locrecargos;

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
	 * The value for the ca_datosag field.
	 * @var        string
	 */
	protected $ca_datosag;

	/**
	 * The value for the ca_idlinea field.
	 * @var        int
	 */
	protected $ca_idlinea;

	/**
	 * The value for the ca_postularlinea field.
	 * @var        boolean
	 */
	protected $ca_postularlinea;

	/**
	 * The value for the ca_etapa field.
	 * @var        string
	 */
	protected $ca_etapa;

	/**
	 * The value for the ca_idtarea field.
	 * @var        int
	 */
	protected $ca_idtarea;

	/**
	 * @var        Cotizacion
	 */
	protected $aCotizacion;

	/**
	 * @var        Transportador
	 */
	protected $aTransportador;

	/**
	 * @var        NotTarea
	 */
	protected $aNotTarea;

	/**
	 * @var        array CotOpcion[] Collection to store aggregation of CotOpcion objects.
	 */
	protected $collCotOpcions;

	/**
	 * @var        Criteria The criteria used to select the current contents of collCotOpcions.
	 */
	private $lastCotOpcionCriteria = null;

	/**
	 * @var        array CotSeguimiento[] Collection to store aggregation of CotSeguimiento objects.
	 */
	protected $collCotSeguimientos;

	/**
	 * @var        Criteria The criteria used to select the current contents of collCotSeguimientos.
	 */
	private $lastCotSeguimientoCriteria = null;

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
	 * Initializes internal state of BaseCotProducto object.
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
	 * Get the [ca_idproducto] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdproducto()
	{
		return $this->ca_idproducto;
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
	 * Get the [ca_transporte] column value.
	 * 
	 * @return     string
	 */
	public function getCaTransporte()
	{
		return $this->ca_transporte;
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
	 * Get the [ca_escala] column value.
	 * 
	 * @return     string
	 */
	public function getCaEscala()
	{
		return $this->ca_escala;
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
	 * Get the [ca_imprimir] column value.
	 * 
	 * @return     string
	 */
	public function getCaImprimir()
	{
		return $this->ca_imprimir;
	}

	/**
	 * Get the [ca_producto] column value.
	 * 
	 * @return     string
	 */
	public function getCaProducto()
	{
		return $this->ca_producto;
	}

	/**
	 * Get the [ca_incoterms] column value.
	 * 
	 * @return     string
	 */
	public function getCaIncoterms()
	{
		return $this->ca_incoterms;
	}

	/**
	 * Get the [ca_frecuencia] column value.
	 * 
	 * @return     string
	 */
	public function getCaFrecuencia()
	{
		return $this->ca_frecuencia;
	}

	/**
	 * Get the [ca_tiempotransito] column value.
	 * 
	 * @return     string
	 */
	public function getCaTiempotransito()
	{
		return $this->ca_tiempotransito;
	}

	/**
	 * Get the [ca_locrecargos] column value.
	 * 
	 * @return     string
	 */
	public function getCaLocrecargos()
	{
		return $this->ca_locrecargos;
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
	 * Get the [ca_datosag] column value.
	 * 
	 * @return     string
	 */
	public function getCaDatosag()
	{
		return $this->ca_datosag;
	}

	/**
	 * Get the [ca_idlinea] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdlinea()
	{
		return $this->ca_idlinea;
	}

	/**
	 * Get the [ca_postularlinea] column value.
	 * 
	 * @return     boolean
	 */
	public function getCaPostularlinea()
	{
		return $this->ca_postularlinea;
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
	 * Get the [ca_idtarea] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdtarea()
	{
		return $this->ca_idtarea;
	}

	/**
	 * Set the value of [ca_idproducto] column.
	 * 
	 * @param      int $v new value
	 * @return     CotProducto The current object (for fluent API support)
	 */
	public function setCaIdproducto($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idproducto !== $v) {
			$this->ca_idproducto = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_IDPRODUCTO;
		}

		return $this;
	} // setCaIdproducto()

	/**
	 * Set the value of [ca_idcotizacion] column.
	 * 
	 * @param      int $v new value
	 * @return     CotProducto The current object (for fluent API support)
	 */
	public function setCaIdcotizacion($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idcotizacion !== $v) {
			$this->ca_idcotizacion = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_IDCOTIZACION;
		}

		if ($this->aCotizacion !== null && $this->aCotizacion->getCaIdcotizacion() !== $v) {
			$this->aCotizacion = null;
		}

		return $this;
	} // setCaIdcotizacion()

	/**
	 * Set the value of [ca_transporte] column.
	 * 
	 * @param      string $v new value
	 * @return     CotProducto The current object (for fluent API support)
	 */
	public function setCaTransporte($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_transporte !== $v) {
			$this->ca_transporte = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_TRANSPORTE;
		}

		return $this;
	} // setCaTransporte()

	/**
	 * Set the value of [ca_modalidad] column.
	 * 
	 * @param      string $v new value
	 * @return     CotProducto The current object (for fluent API support)
	 */
	public function setCaModalidad($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_modalidad !== $v) {
			$this->ca_modalidad = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_MODALIDAD;
		}

		return $this;
	} // setCaModalidad()

	/**
	 * Set the value of [ca_origen] column.
	 * 
	 * @param      string $v new value
	 * @return     CotProducto The current object (for fluent API support)
	 */
	public function setCaOrigen($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_origen !== $v) {
			$this->ca_origen = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_ORIGEN;
		}

		return $this;
	} // setCaOrigen()

	/**
	 * Set the value of [ca_destino] column.
	 * 
	 * @param      string $v new value
	 * @return     CotProducto The current object (for fluent API support)
	 */
	public function setCaDestino($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_destino !== $v) {
			$this->ca_destino = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_DESTINO;
		}

		return $this;
	} // setCaDestino()

	/**
	 * Set the value of [ca_escala] column.
	 * 
	 * @param      string $v new value
	 * @return     CotProducto The current object (for fluent API support)
	 */
	public function setCaEscala($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_escala !== $v) {
			$this->ca_escala = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_ESCALA;
		}

		return $this;
	} // setCaEscala()

	/**
	 * Set the value of [ca_impoexpo] column.
	 * 
	 * @param      string $v new value
	 * @return     CotProducto The current object (for fluent API support)
	 */
	public function setCaImpoexpo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_impoexpo !== $v) {
			$this->ca_impoexpo = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_IMPOEXPO;
		}

		return $this;
	} // setCaImpoexpo()

	/**
	 * Set the value of [ca_imprimir] column.
	 * 
	 * @param      string $v new value
	 * @return     CotProducto The current object (for fluent API support)
	 */
	public function setCaImprimir($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_imprimir !== $v) {
			$this->ca_imprimir = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_IMPRIMIR;
		}

		return $this;
	} // setCaImprimir()

	/**
	 * Set the value of [ca_producto] column.
	 * 
	 * @param      string $v new value
	 * @return     CotProducto The current object (for fluent API support)
	 */
	public function setCaProducto($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_producto !== $v) {
			$this->ca_producto = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_PRODUCTO;
		}

		return $this;
	} // setCaProducto()

	/**
	 * Set the value of [ca_incoterms] column.
	 * 
	 * @param      string $v new value
	 * @return     CotProducto The current object (for fluent API support)
	 */
	public function setCaIncoterms($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_incoterms !== $v) {
			$this->ca_incoterms = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_INCOTERMS;
		}

		return $this;
	} // setCaIncoterms()

	/**
	 * Set the value of [ca_frecuencia] column.
	 * 
	 * @param      string $v new value
	 * @return     CotProducto The current object (for fluent API support)
	 */
	public function setCaFrecuencia($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_frecuencia !== $v) {
			$this->ca_frecuencia = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_FRECUENCIA;
		}

		return $this;
	} // setCaFrecuencia()

	/**
	 * Set the value of [ca_tiempotransito] column.
	 * 
	 * @param      string $v new value
	 * @return     CotProducto The current object (for fluent API support)
	 */
	public function setCaTiempotransito($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_tiempotransito !== $v) {
			$this->ca_tiempotransito = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_TIEMPOTRANSITO;
		}

		return $this;
	} // setCaTiempotransito()

	/**
	 * Set the value of [ca_locrecargos] column.
	 * 
	 * @param      string $v new value
	 * @return     CotProducto The current object (for fluent API support)
	 */
	public function setCaLocrecargos($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_locrecargos !== $v) {
			$this->ca_locrecargos = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_LOCRECARGOS;
		}

		return $this;
	} // setCaLocrecargos()

	/**
	 * Set the value of [ca_observaciones] column.
	 * 
	 * @param      string $v new value
	 * @return     CotProducto The current object (for fluent API support)
	 */
	public function setCaObservaciones($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_observaciones !== $v) {
			$this->ca_observaciones = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_OBSERVACIONES;
		}

		return $this;
	} // setCaObservaciones()

	/**
	 * Sets the value of [ca_fchcreado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     CotProducto The current object (for fluent API support)
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
				$this->modifiedColumns[] = CotProductoPeer::CA_FCHCREADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchcreado()

	/**
	 * Set the value of [ca_usucreado] column.
	 * 
	 * @param      string $v new value
	 * @return     CotProducto The current object (for fluent API support)
	 */
	public function setCaUsucreado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usucreado !== $v) {
			$this->ca_usucreado = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_USUCREADO;
		}

		return $this;
	} // setCaUsucreado()

	/**
	 * Sets the value of [ca_fchactualizado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     CotProducto The current object (for fluent API support)
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
				$this->modifiedColumns[] = CotProductoPeer::CA_FCHACTUALIZADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchactualizado()

	/**
	 * Set the value of [ca_usuactualizado] column.
	 * 
	 * @param      string $v new value
	 * @return     CotProducto The current object (for fluent API support)
	 */
	public function setCaUsuactualizado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usuactualizado !== $v) {
			$this->ca_usuactualizado = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_USUACTUALIZADO;
		}

		return $this;
	} // setCaUsuactualizado()

	/**
	 * Set the value of [ca_datosag] column.
	 * 
	 * @param      string $v new value
	 * @return     CotProducto The current object (for fluent API support)
	 */
	public function setCaDatosag($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_datosag !== $v) {
			$this->ca_datosag = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_DATOSAG;
		}

		return $this;
	} // setCaDatosag()

	/**
	 * Set the value of [ca_idlinea] column.
	 * 
	 * @param      int $v new value
	 * @return     CotProducto The current object (for fluent API support)
	 */
	public function setCaIdlinea($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idlinea !== $v) {
			$this->ca_idlinea = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_IDLINEA;
		}

		if ($this->aTransportador !== null && $this->aTransportador->getCaIdlinea() !== $v) {
			$this->aTransportador = null;
		}

		return $this;
	} // setCaIdlinea()

	/**
	 * Set the value of [ca_postularlinea] column.
	 * 
	 * @param      boolean $v new value
	 * @return     CotProducto The current object (for fluent API support)
	 */
	public function setCaPostularlinea($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->ca_postularlinea !== $v) {
			$this->ca_postularlinea = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_POSTULARLINEA;
		}

		return $this;
	} // setCaPostularlinea()

	/**
	 * Set the value of [ca_etapa] column.
	 * 
	 * @param      string $v new value
	 * @return     CotProducto The current object (for fluent API support)
	 */
	public function setCaEtapa($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_etapa !== $v) {
			$this->ca_etapa = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_ETAPA;
		}

		return $this;
	} // setCaEtapa()

	/**
	 * Set the value of [ca_idtarea] column.
	 * 
	 * @param      int $v new value
	 * @return     CotProducto The current object (for fluent API support)
	 */
	public function setCaIdtarea($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idtarea !== $v) {
			$this->ca_idtarea = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_IDTAREA;
		}

		if ($this->aNotTarea !== null && $this->aNotTarea->getCaIdtarea() !== $v) {
			$this->aNotTarea = null;
		}

		return $this;
	} // setCaIdtarea()

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

			$this->ca_idproducto = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_idcotizacion = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_transporte = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_modalidad = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_origen = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_destino = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_escala = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_impoexpo = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_imprimir = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_producto = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_incoterms = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_frecuencia = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_tiempotransito = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_locrecargos = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->ca_observaciones = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->ca_fchcreado = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->ca_usucreado = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
			$this->ca_fchactualizado = ($row[$startcol + 17] !== null) ? (string) $row[$startcol + 17] : null;
			$this->ca_usuactualizado = ($row[$startcol + 18] !== null) ? (string) $row[$startcol + 18] : null;
			$this->ca_datosag = ($row[$startcol + 19] !== null) ? (string) $row[$startcol + 19] : null;
			$this->ca_idlinea = ($row[$startcol + 20] !== null) ? (int) $row[$startcol + 20] : null;
			$this->ca_postularlinea = ($row[$startcol + 21] !== null) ? (boolean) $row[$startcol + 21] : null;
			$this->ca_etapa = ($row[$startcol + 22] !== null) ? (string) $row[$startcol + 22] : null;
			$this->ca_idtarea = ($row[$startcol + 23] !== null) ? (int) $row[$startcol + 23] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 24; // 24 = CotProductoPeer::NUM_COLUMNS - CotProductoPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating CotProducto object", $e);
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

		if ($this->aCotizacion !== null && $this->ca_idcotizacion !== $this->aCotizacion->getCaIdcotizacion()) {
			$this->aCotizacion = null;
		}
		if ($this->aTransportador !== null && $this->ca_idlinea !== $this->aTransportador->getCaIdlinea()) {
			$this->aTransportador = null;
		}
		if ($this->aNotTarea !== null && $this->ca_idtarea !== $this->aNotTarea->getCaIdtarea()) {
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
			$con = Propel::getConnection(CotProductoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = CotProductoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aCotizacion = null;
			$this->aTransportador = null;
			$this->aNotTarea = null;
			$this->collCotOpcions = null;
			$this->lastCotOpcionCriteria = null;

			$this->collCotSeguimientos = null;
			$this->lastCotSeguimientoCriteria = null;

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
			$con = Propel::getConnection(CotProductoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			CotProductoPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(CotProductoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			CotProductoPeer::addInstanceToPool($this);
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

			if ($this->aCotizacion !== null) {
				if ($this->aCotizacion->isModified() || $this->aCotizacion->isNew()) {
					$affectedRows += $this->aCotizacion->save($con);
				}
				$this->setCotizacion($this->aCotizacion);
			}

			if ($this->aTransportador !== null) {
				if ($this->aTransportador->isModified() || $this->aTransportador->isNew()) {
					$affectedRows += $this->aTransportador->save($con);
				}
				$this->setTransportador($this->aTransportador);
			}

			if ($this->aNotTarea !== null) {
				if ($this->aNotTarea->isModified() || $this->aNotTarea->isNew()) {
					$affectedRows += $this->aNotTarea->save($con);
				}
				$this->setNotTarea($this->aNotTarea);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = CotProductoPeer::CA_IDPRODUCTO;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = CotProductoPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setCaIdproducto($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += CotProductoPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collCotOpcions !== null) {
				foreach ($this->collCotOpcions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCotSeguimientos !== null) {
				foreach ($this->collCotSeguimientos as $referrerFK) {
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

			if ($this->aCotizacion !== null) {
				if (!$this->aCotizacion->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCotizacion->getValidationFailures());
				}
			}

			if ($this->aTransportador !== null) {
				if (!$this->aTransportador->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTransportador->getValidationFailures());
				}
			}

			if ($this->aNotTarea !== null) {
				if (!$this->aNotTarea->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aNotTarea->getValidationFailures());
				}
			}


			if (($retval = CotProductoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collCotOpcions !== null) {
					foreach ($this->collCotOpcions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCotSeguimientos !== null) {
					foreach ($this->collCotSeguimientos as $referrerFK) {
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
		$pos = CotProductoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdproducto();
				break;
			case 1:
				return $this->getCaIdcotizacion();
				break;
			case 2:
				return $this->getCaTransporte();
				break;
			case 3:
				return $this->getCaModalidad();
				break;
			case 4:
				return $this->getCaOrigen();
				break;
			case 5:
				return $this->getCaDestino();
				break;
			case 6:
				return $this->getCaEscala();
				break;
			case 7:
				return $this->getCaImpoexpo();
				break;
			case 8:
				return $this->getCaImprimir();
				break;
			case 9:
				return $this->getCaProducto();
				break;
			case 10:
				return $this->getCaIncoterms();
				break;
			case 11:
				return $this->getCaFrecuencia();
				break;
			case 12:
				return $this->getCaTiempotransito();
				break;
			case 13:
				return $this->getCaLocrecargos();
				break;
			case 14:
				return $this->getCaObservaciones();
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
				return $this->getCaDatosag();
				break;
			case 20:
				return $this->getCaIdlinea();
				break;
			case 21:
				return $this->getCaPostularlinea();
				break;
			case 22:
				return $this->getCaEtapa();
				break;
			case 23:
				return $this->getCaIdtarea();
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
		$keys = CotProductoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdproducto(),
			$keys[1] => $this->getCaIdcotizacion(),
			$keys[2] => $this->getCaTransporte(),
			$keys[3] => $this->getCaModalidad(),
			$keys[4] => $this->getCaOrigen(),
			$keys[5] => $this->getCaDestino(),
			$keys[6] => $this->getCaEscala(),
			$keys[7] => $this->getCaImpoexpo(),
			$keys[8] => $this->getCaImprimir(),
			$keys[9] => $this->getCaProducto(),
			$keys[10] => $this->getCaIncoterms(),
			$keys[11] => $this->getCaFrecuencia(),
			$keys[12] => $this->getCaTiempotransito(),
			$keys[13] => $this->getCaLocrecargos(),
			$keys[14] => $this->getCaObservaciones(),
			$keys[15] => $this->getCaFchcreado(),
			$keys[16] => $this->getCaUsucreado(),
			$keys[17] => $this->getCaFchactualizado(),
			$keys[18] => $this->getCaUsuactualizado(),
			$keys[19] => $this->getCaDatosag(),
			$keys[20] => $this->getCaIdlinea(),
			$keys[21] => $this->getCaPostularlinea(),
			$keys[22] => $this->getCaEtapa(),
			$keys[23] => $this->getCaIdtarea(),
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
		$pos = CotProductoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdproducto($value);
				break;
			case 1:
				$this->setCaIdcotizacion($value);
				break;
			case 2:
				$this->setCaTransporte($value);
				break;
			case 3:
				$this->setCaModalidad($value);
				break;
			case 4:
				$this->setCaOrigen($value);
				break;
			case 5:
				$this->setCaDestino($value);
				break;
			case 6:
				$this->setCaEscala($value);
				break;
			case 7:
				$this->setCaImpoexpo($value);
				break;
			case 8:
				$this->setCaImprimir($value);
				break;
			case 9:
				$this->setCaProducto($value);
				break;
			case 10:
				$this->setCaIncoterms($value);
				break;
			case 11:
				$this->setCaFrecuencia($value);
				break;
			case 12:
				$this->setCaTiempotransito($value);
				break;
			case 13:
				$this->setCaLocrecargos($value);
				break;
			case 14:
				$this->setCaObservaciones($value);
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
				$this->setCaDatosag($value);
				break;
			case 20:
				$this->setCaIdlinea($value);
				break;
			case 21:
				$this->setCaPostularlinea($value);
				break;
			case 22:
				$this->setCaEtapa($value);
				break;
			case 23:
				$this->setCaIdtarea($value);
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
		$keys = CotProductoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdproducto($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdcotizacion($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaTransporte($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaModalidad($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaOrigen($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaDestino($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaEscala($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaImpoexpo($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaImprimir($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaProducto($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaIncoterms($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaFrecuencia($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaTiempotransito($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaLocrecargos($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaObservaciones($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaFchcreado($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCaUsucreado($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setCaFchactualizado($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setCaUsuactualizado($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setCaDatosag($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setCaIdlinea($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setCaPostularlinea($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setCaEtapa($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setCaIdtarea($arr[$keys[23]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(CotProductoPeer::DATABASE_NAME);

		if ($this->isColumnModified(CotProductoPeer::CA_IDPRODUCTO)) $criteria->add(CotProductoPeer::CA_IDPRODUCTO, $this->ca_idproducto);
		if ($this->isColumnModified(CotProductoPeer::CA_IDCOTIZACION)) $criteria->add(CotProductoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);
		if ($this->isColumnModified(CotProductoPeer::CA_TRANSPORTE)) $criteria->add(CotProductoPeer::CA_TRANSPORTE, $this->ca_transporte);
		if ($this->isColumnModified(CotProductoPeer::CA_MODALIDAD)) $criteria->add(CotProductoPeer::CA_MODALIDAD, $this->ca_modalidad);
		if ($this->isColumnModified(CotProductoPeer::CA_ORIGEN)) $criteria->add(CotProductoPeer::CA_ORIGEN, $this->ca_origen);
		if ($this->isColumnModified(CotProductoPeer::CA_DESTINO)) $criteria->add(CotProductoPeer::CA_DESTINO, $this->ca_destino);
		if ($this->isColumnModified(CotProductoPeer::CA_ESCALA)) $criteria->add(CotProductoPeer::CA_ESCALA, $this->ca_escala);
		if ($this->isColumnModified(CotProductoPeer::CA_IMPOEXPO)) $criteria->add(CotProductoPeer::CA_IMPOEXPO, $this->ca_impoexpo);
		if ($this->isColumnModified(CotProductoPeer::CA_IMPRIMIR)) $criteria->add(CotProductoPeer::CA_IMPRIMIR, $this->ca_imprimir);
		if ($this->isColumnModified(CotProductoPeer::CA_PRODUCTO)) $criteria->add(CotProductoPeer::CA_PRODUCTO, $this->ca_producto);
		if ($this->isColumnModified(CotProductoPeer::CA_INCOTERMS)) $criteria->add(CotProductoPeer::CA_INCOTERMS, $this->ca_incoterms);
		if ($this->isColumnModified(CotProductoPeer::CA_FRECUENCIA)) $criteria->add(CotProductoPeer::CA_FRECUENCIA, $this->ca_frecuencia);
		if ($this->isColumnModified(CotProductoPeer::CA_TIEMPOTRANSITO)) $criteria->add(CotProductoPeer::CA_TIEMPOTRANSITO, $this->ca_tiempotransito);
		if ($this->isColumnModified(CotProductoPeer::CA_LOCRECARGOS)) $criteria->add(CotProductoPeer::CA_LOCRECARGOS, $this->ca_locrecargos);
		if ($this->isColumnModified(CotProductoPeer::CA_OBSERVACIONES)) $criteria->add(CotProductoPeer::CA_OBSERVACIONES, $this->ca_observaciones);
		if ($this->isColumnModified(CotProductoPeer::CA_FCHCREADO)) $criteria->add(CotProductoPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(CotProductoPeer::CA_USUCREADO)) $criteria->add(CotProductoPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(CotProductoPeer::CA_FCHACTUALIZADO)) $criteria->add(CotProductoPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(CotProductoPeer::CA_USUACTUALIZADO)) $criteria->add(CotProductoPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);
		if ($this->isColumnModified(CotProductoPeer::CA_DATOSAG)) $criteria->add(CotProductoPeer::CA_DATOSAG, $this->ca_datosag);
		if ($this->isColumnModified(CotProductoPeer::CA_IDLINEA)) $criteria->add(CotProductoPeer::CA_IDLINEA, $this->ca_idlinea);
		if ($this->isColumnModified(CotProductoPeer::CA_POSTULARLINEA)) $criteria->add(CotProductoPeer::CA_POSTULARLINEA, $this->ca_postularlinea);
		if ($this->isColumnModified(CotProductoPeer::CA_ETAPA)) $criteria->add(CotProductoPeer::CA_ETAPA, $this->ca_etapa);
		if ($this->isColumnModified(CotProductoPeer::CA_IDTAREA)) $criteria->add(CotProductoPeer::CA_IDTAREA, $this->ca_idtarea);

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
		$criteria = new Criteria(CotProductoPeer::DATABASE_NAME);

		$criteria->add(CotProductoPeer::CA_IDPRODUCTO, $this->ca_idproducto);
		$criteria->add(CotProductoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

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

		$pks[0] = $this->getCaIdproducto();

		$pks[1] = $this->getCaIdcotizacion();

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

		$this->setCaIdproducto($keys[0]);

		$this->setCaIdcotizacion($keys[1]);

	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of CotProducto (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdcotizacion($this->ca_idcotizacion);

		$copyObj->setCaTransporte($this->ca_transporte);

		$copyObj->setCaModalidad($this->ca_modalidad);

		$copyObj->setCaOrigen($this->ca_origen);

		$copyObj->setCaDestino($this->ca_destino);

		$copyObj->setCaEscala($this->ca_escala);

		$copyObj->setCaImpoexpo($this->ca_impoexpo);

		$copyObj->setCaImprimir($this->ca_imprimir);

		$copyObj->setCaProducto($this->ca_producto);

		$copyObj->setCaIncoterms($this->ca_incoterms);

		$copyObj->setCaFrecuencia($this->ca_frecuencia);

		$copyObj->setCaTiempotransito($this->ca_tiempotransito);

		$copyObj->setCaLocrecargos($this->ca_locrecargos);

		$copyObj->setCaObservaciones($this->ca_observaciones);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);

		$copyObj->setCaDatosag($this->ca_datosag);

		$copyObj->setCaIdlinea($this->ca_idlinea);

		$copyObj->setCaPostularlinea($this->ca_postularlinea);

		$copyObj->setCaEtapa($this->ca_etapa);

		$copyObj->setCaIdtarea($this->ca_idtarea);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getCotOpcions() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addCotOpcion($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getCotSeguimientos() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addCotSeguimiento($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setCaIdproducto(NULL); // this is a auto-increment column, so set to default value

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
	 * @return     CotProducto Clone of current object.
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
	 * @return     CotProductoPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new CotProductoPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Cotizacion object.
	 *
	 * @param      Cotizacion $v
	 * @return     CotProducto The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setCotizacion(Cotizacion $v = null)
	{
		if ($v === null) {
			$this->setCaIdcotizacion(NULL);
		} else {
			$this->setCaIdcotizacion($v->getCaIdcotizacion());
		}

		$this->aCotizacion = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Cotizacion object, it will not be re-added.
		if ($v !== null) {
			$v->addCotProducto($this);
		}

		return $this;
	}


	/**
	 * Get the associated Cotizacion object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Cotizacion The associated Cotizacion object.
	 * @throws     PropelException
	 */
	public function getCotizacion(PropelPDO $con = null)
	{
		if ($this->aCotizacion === null && ($this->ca_idcotizacion !== null)) {
			$c = new Criteria(CotizacionPeer::DATABASE_NAME);
			$c->add(CotizacionPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);
			$this->aCotizacion = CotizacionPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aCotizacion->addCotProductos($this);
			 */
		}
		return $this->aCotizacion;
	}

	/**
	 * Declares an association between this object and a Transportador object.
	 *
	 * @param      Transportador $v
	 * @return     CotProducto The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setTransportador(Transportador $v = null)
	{
		if ($v === null) {
			$this->setCaIdlinea(NULL);
		} else {
			$this->setCaIdlinea($v->getCaIdlinea());
		}

		$this->aTransportador = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Transportador object, it will not be re-added.
		if ($v !== null) {
			$v->addCotProducto($this);
		}

		return $this;
	}


	/**
	 * Get the associated Transportador object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Transportador The associated Transportador object.
	 * @throws     PropelException
	 */
	public function getTransportador(PropelPDO $con = null)
	{
		if ($this->aTransportador === null && ($this->ca_idlinea !== null)) {
			$c = new Criteria(TransportadorPeer::DATABASE_NAME);
			$c->add(TransportadorPeer::CA_IDLINEA, $this->ca_idlinea);
			$this->aTransportador = TransportadorPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aTransportador->addCotProductos($this);
			 */
		}
		return $this->aTransportador;
	}

	/**
	 * Declares an association between this object and a NotTarea object.
	 *
	 * @param      NotTarea $v
	 * @return     CotProducto The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setNotTarea(NotTarea $v = null)
	{
		if ($v === null) {
			$this->setCaIdtarea(NULL);
		} else {
			$this->setCaIdtarea($v->getCaIdtarea());
		}

		$this->aNotTarea = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the NotTarea object, it will not be re-added.
		if ($v !== null) {
			$v->addCotProducto($this);
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
		if ($this->aNotTarea === null && ($this->ca_idtarea !== null)) {
			$c = new Criteria(NotTareaPeer::DATABASE_NAME);
			$c->add(NotTareaPeer::CA_IDTAREA, $this->ca_idtarea);
			$this->aNotTarea = NotTareaPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aNotTarea->addCotProductos($this);
			 */
		}
		return $this->aNotTarea;
	}

	/**
	 * Clears out the collCotOpcions collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addCotOpcions()
	 */
	public function clearCotOpcions()
	{
		$this->collCotOpcions = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collCotOpcions collection (array).
	 *
	 * By default this just sets the collCotOpcions collection to an empty array (like clearcollCotOpcions());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initCotOpcions()
	{
		$this->collCotOpcions = array();
	}

	/**
	 * Gets an array of CotOpcion objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this CotProducto has previously been saved, it will retrieve
	 * related CotOpcions from storage. If this CotProducto is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array CotOpcion[]
	 * @throws     PropelException
	 */
	public function getCotOpcions($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotProductoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotOpcions === null) {
			if ($this->isNew()) {
			   $this->collCotOpcions = array();
			} else {

				$criteria->add(CotOpcionPeer::CA_IDPRODUCTO, $this->ca_idproducto);

				$criteria->add(CotOpcionPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				CotOpcionPeer::addSelectColumns($criteria);
				$this->collCotOpcions = CotOpcionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CotOpcionPeer::CA_IDPRODUCTO, $this->ca_idproducto);


				$criteria->add(CotOpcionPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				CotOpcionPeer::addSelectColumns($criteria);
				if (!isset($this->lastCotOpcionCriteria) || !$this->lastCotOpcionCriteria->equals($criteria)) {
					$this->collCotOpcions = CotOpcionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCotOpcionCriteria = $criteria;
		return $this->collCotOpcions;
	}

	/**
	 * Returns the number of related CotOpcion objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related CotOpcion objects.
	 * @throws     PropelException
	 */
	public function countCotOpcions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotProductoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collCotOpcions === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(CotOpcionPeer::CA_IDPRODUCTO, $this->ca_idproducto);

				$criteria->add(CotOpcionPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				$count = CotOpcionPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(CotOpcionPeer::CA_IDPRODUCTO, $this->ca_idproducto);


				$criteria->add(CotOpcionPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				if (!isset($this->lastCotOpcionCriteria) || !$this->lastCotOpcionCriteria->equals($criteria)) {
					$count = CotOpcionPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collCotOpcions);
				}
			} else {
				$count = count($this->collCotOpcions);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a CotOpcion object to this object
	 * through the CotOpcion foreign key attribute.
	 *
	 * @param      CotOpcion $l CotOpcion
	 * @return     void
	 * @throws     PropelException
	 */
	public function addCotOpcion(CotOpcion $l)
	{
		if ($this->collCotOpcions === null) {
			$this->initCotOpcions();
		}
		if (!in_array($l, $this->collCotOpcions, true)) { // only add it if the **same** object is not already associated
			array_push($this->collCotOpcions, $l);
			$l->setCotProducto($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this CotProducto is new, it will return
	 * an empty collection; or if this CotProducto has previously
	 * been saved, it will retrieve related CotOpcions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in CotProducto.
	 */
	public function getCotOpcionsJoinConcepto($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotProductoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotOpcions === null) {
			if ($this->isNew()) {
				$this->collCotOpcions = array();
			} else {

				$criteria->add(CotOpcionPeer::CA_IDPRODUCTO, $this->ca_idproducto);

				$criteria->add(CotOpcionPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				$this->collCotOpcions = CotOpcionPeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CotOpcionPeer::CA_IDPRODUCTO, $this->ca_idproducto);

			$criteria->add(CotOpcionPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

			if (!isset($this->lastCotOpcionCriteria) || !$this->lastCotOpcionCriteria->equals($criteria)) {
				$this->collCotOpcions = CotOpcionPeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		}
		$this->lastCotOpcionCriteria = $criteria;

		return $this->collCotOpcions;
	}

	/**
	 * Clears out the collCotSeguimientos collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addCotSeguimientos()
	 */
	public function clearCotSeguimientos()
	{
		$this->collCotSeguimientos = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collCotSeguimientos collection (array).
	 *
	 * By default this just sets the collCotSeguimientos collection to an empty array (like clearcollCotSeguimientos());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initCotSeguimientos()
	{
		$this->collCotSeguimientos = array();
	}

	/**
	 * Gets an array of CotSeguimiento objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this CotProducto has previously been saved, it will retrieve
	 * related CotSeguimientos from storage. If this CotProducto is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array CotSeguimiento[]
	 * @throws     PropelException
	 */
	public function getCotSeguimientos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotProductoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotSeguimientos === null) {
			if ($this->isNew()) {
			   $this->collCotSeguimientos = array();
			} else {

				$criteria->add(CotSeguimientoPeer::CA_IDPRODUCTO, $this->ca_idproducto);

				$criteria->add(CotSeguimientoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				CotSeguimientoPeer::addSelectColumns($criteria);
				$this->collCotSeguimientos = CotSeguimientoPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CotSeguimientoPeer::CA_IDPRODUCTO, $this->ca_idproducto);


				$criteria->add(CotSeguimientoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				CotSeguimientoPeer::addSelectColumns($criteria);
				if (!isset($this->lastCotSeguimientoCriteria) || !$this->lastCotSeguimientoCriteria->equals($criteria)) {
					$this->collCotSeguimientos = CotSeguimientoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCotSeguimientoCriteria = $criteria;
		return $this->collCotSeguimientos;
	}

	/**
	 * Returns the number of related CotSeguimiento objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related CotSeguimiento objects.
	 * @throws     PropelException
	 */
	public function countCotSeguimientos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotProductoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collCotSeguimientos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(CotSeguimientoPeer::CA_IDPRODUCTO, $this->ca_idproducto);

				$criteria->add(CotSeguimientoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				$count = CotSeguimientoPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(CotSeguimientoPeer::CA_IDPRODUCTO, $this->ca_idproducto);


				$criteria->add(CotSeguimientoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				if (!isset($this->lastCotSeguimientoCriteria) || !$this->lastCotSeguimientoCriteria->equals($criteria)) {
					$count = CotSeguimientoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collCotSeguimientos);
				}
			} else {
				$count = count($this->collCotSeguimientos);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a CotSeguimiento object to this object
	 * through the CotSeguimiento foreign key attribute.
	 *
	 * @param      CotSeguimiento $l CotSeguimiento
	 * @return     void
	 * @throws     PropelException
	 */
	public function addCotSeguimiento(CotSeguimiento $l)
	{
		if ($this->collCotSeguimientos === null) {
			$this->initCotSeguimientos();
		}
		if (!in_array($l, $this->collCotSeguimientos, true)) { // only add it if the **same** object is not already associated
			array_push($this->collCotSeguimientos, $l);
			$l->setCotProducto($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this CotProducto is new, it will return
	 * an empty collection; or if this CotProducto has previously
	 * been saved, it will retrieve related CotSeguimientos from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in CotProducto.
	 */
	public function getCotSeguimientosJoinCotizacion($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotProductoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotSeguimientos === null) {
			if ($this->isNew()) {
				$this->collCotSeguimientos = array();
			} else {

				$criteria->add(CotSeguimientoPeer::CA_IDPRODUCTO, $this->ca_idproducto);

				$criteria->add(CotSeguimientoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				$this->collCotSeguimientos = CotSeguimientoPeer::doSelectJoinCotizacion($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CotSeguimientoPeer::CA_IDPRODUCTO, $this->ca_idproducto);

			$criteria->add(CotSeguimientoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

			if (!isset($this->lastCotSeguimientoCriteria) || !$this->lastCotSeguimientoCriteria->equals($criteria)) {
				$this->collCotSeguimientos = CotSeguimientoPeer::doSelectJoinCotizacion($criteria, $con, $join_behavior);
			}
		}
		$this->lastCotSeguimientoCriteria = $criteria;

		return $this->collCotSeguimientos;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this CotProducto is new, it will return
	 * an empty collection; or if this CotProducto has previously
	 * been saved, it will retrieve related CotSeguimientos from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in CotProducto.
	 */
	public function getCotSeguimientosJoinUsuario($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotProductoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotSeguimientos === null) {
			if ($this->isNew()) {
				$this->collCotSeguimientos = array();
			} else {

				$criteria->add(CotSeguimientoPeer::CA_IDPRODUCTO, $this->ca_idproducto);

				$criteria->add(CotSeguimientoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				$this->collCotSeguimientos = CotSeguimientoPeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CotSeguimientoPeer::CA_IDPRODUCTO, $this->ca_idproducto);

			$criteria->add(CotSeguimientoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

			if (!isset($this->lastCotSeguimientoCriteria) || !$this->lastCotSeguimientoCriteria->equals($criteria)) {
				$this->collCotSeguimientos = CotSeguimientoPeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		}
		$this->lastCotSeguimientoCriteria = $criteria;

		return $this->collCotSeguimientos;
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
			if ($this->collCotOpcions) {
				foreach ((array) $this->collCotOpcions as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collCotSeguimientos) {
				foreach ((array) $this->collCotSeguimientos as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collCotOpcions = null;
		$this->collCotSeguimientos = null;
			$this->aCotizacion = null;
			$this->aTransportador = null;
			$this->aNotTarea = null;
	}

} // BaseCotProducto
