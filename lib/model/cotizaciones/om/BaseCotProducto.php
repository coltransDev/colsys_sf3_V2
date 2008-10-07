<?php

/**
 * Base class that represents a row from the 'tb_cotproductos' table.
 *
 * 
 *
 * @package    lib.model.cotizaciones.om
 */
abstract class BaseCotProducto extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        CotProductoPeer
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
	 * The value for the ca_datosag field.
	 * @var        string
	 */
	protected $ca_datosag;

	/**
	 * @var        Cotizacion
	 */
	protected $aCotizacion;

	/**
	 * Collection to store aggregation of collCotOpcions.
	 * @var        array
	 */
	protected $collCotOpcions;

	/**
	 * The criteria used to select the current contents of collCotOpcions.
	 * @var        Criteria
	 */
	protected $lastCotOpcionCriteria = null;

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
	 * Get the [ca_idproducto] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdproducto()
	{

		return $this->ca_idproducto;
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
	 * Get the [ca_datosag] column value.
	 * 
	 * @return     string
	 */
	public function getCaDatosag()
	{

		return $this->ca_datosag;
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
			$this->modifiedColumns[] = CotProductoPeer::CA_IDCOTIZACION;
		}

		if ($this->aCotizacion !== null && $this->aCotizacion->getCaIdcotizacion() !== $v) {
			$this->aCotizacion = null;
		}

	} // setCaIdcotizacion()

	/**
	 * Set the value of [ca_idproducto] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdproducto($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idproducto !== $v) {
			$this->ca_idproducto = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_IDPRODUCTO;
		}

	} // setCaIdproducto()

	/**
	 * Set the value of [ca_transporte] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaTransporte($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_transporte !== $v) {
			$this->ca_transporte = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_TRANSPORTE;
		}

	} // setCaTransporte()

	/**
	 * Set the value of [ca_modalidad] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaModalidad($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_modalidad !== $v) {
			$this->ca_modalidad = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_MODALIDAD;
		}

	} // setCaModalidad()

	/**
	 * Set the value of [ca_origen] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaOrigen($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_origen !== $v) {
			$this->ca_origen = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_ORIGEN;
		}

	} // setCaOrigen()

	/**
	 * Set the value of [ca_destino] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaDestino($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_destino !== $v) {
			$this->ca_destino = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_DESTINO;
		}

	} // setCaDestino()

	/**
	 * Set the value of [ca_impoexpo] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaImpoexpo($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_impoexpo !== $v) {
			$this->ca_impoexpo = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_IMPOEXPO;
		}

	} // setCaImpoexpo()

	/**
	 * Set the value of [ca_imprimir] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaImprimir($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_imprimir !== $v) {
			$this->ca_imprimir = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_IMPRIMIR;
		}

	} // setCaImprimir()

	/**
	 * Set the value of [ca_producto] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaProducto($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_producto !== $v) {
			$this->ca_producto = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_PRODUCTO;
		}

	} // setCaProducto()

	/**
	 * Set the value of [ca_incoterms] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaIncoterms($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_incoterms !== $v) {
			$this->ca_incoterms = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_INCOTERMS;
		}

	} // setCaIncoterms()

	/**
	 * Set the value of [ca_frecuencia] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaFrecuencia($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_frecuencia !== $v) {
			$this->ca_frecuencia = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_FRECUENCIA;
		}

	} // setCaFrecuencia()

	/**
	 * Set the value of [ca_tiempotransito] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaTiempotransito($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_tiempotransito !== $v) {
			$this->ca_tiempotransito = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_TIEMPOTRANSITO;
		}

	} // setCaTiempotransito()

	/**
	 * Set the value of [ca_locrecargos] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaLocrecargos($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_locrecargos !== $v) {
			$this->ca_locrecargos = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_LOCRECARGOS;
		}

	} // setCaLocrecargos()

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
			$this->modifiedColumns[] = CotProductoPeer::CA_OBSERVACIONES;
		}

	} // setCaObservaciones()

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
			$this->modifiedColumns[] = CotProductoPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = CotProductoPeer::CA_USUCREADO;
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
			$this->modifiedColumns[] = CotProductoPeer::CA_FCHACTUALIZADO;
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
			$this->modifiedColumns[] = CotProductoPeer::CA_USUACTUALIZADO;
		}

	} // setCaUsuactualizado()

	/**
	 * Set the value of [ca_datosag] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaDatosag($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_datosag !== $v) {
			$this->ca_datosag = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_DATOSAG;
		}

	} // setCaDatosag()

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

			$this->ca_idproducto = $rs->getInt($startcol + 1);

			$this->ca_transporte = $rs->getString($startcol + 2);

			$this->ca_modalidad = $rs->getString($startcol + 3);

			$this->ca_origen = $rs->getString($startcol + 4);

			$this->ca_destino = $rs->getString($startcol + 5);

			$this->ca_impoexpo = $rs->getString($startcol + 6);

			$this->ca_imprimir = $rs->getString($startcol + 7);

			$this->ca_producto = $rs->getString($startcol + 8);

			$this->ca_incoterms = $rs->getString($startcol + 9);

			$this->ca_frecuencia = $rs->getString($startcol + 10);

			$this->ca_tiempotransito = $rs->getString($startcol + 11);

			$this->ca_locrecargos = $rs->getString($startcol + 12);

			$this->ca_observaciones = $rs->getString($startcol + 13);

			$this->ca_fchcreado = $rs->getTimestamp($startcol + 14, null);

			$this->ca_usucreado = $rs->getString($startcol + 15);

			$this->ca_fchactualizado = $rs->getTimestamp($startcol + 16, null);

			$this->ca_usuactualizado = $rs->getString($startcol + 17);

			$this->ca_datosag = $rs->getString($startcol + 18);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 19; // 19 = CotProductoPeer::NUM_COLUMNS - CotProductoPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating CotProducto object", $e);
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
			$con = Propel::getConnection(CotProductoPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			CotProductoPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(CotProductoPeer::DATABASE_NAME);
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

			if ($this->aCotizacion !== null) {
				if ($this->aCotizacion->isModified()) {
					$affectedRows += $this->aCotizacion->save($con);
				}
				$this->setCotizacion($this->aCotizacion);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = CotProductoPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += CotProductoPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collCotOpcions !== null) {
				foreach($this->collCotOpcions as $referrerFK) {
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


			if (($retval = CotProductoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collCotOpcions !== null) {
					foreach($this->collCotOpcions as $referrerFK) {
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
		$pos = CotProductoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdproducto();
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
				return $this->getCaImpoexpo();
				break;
			case 7:
				return $this->getCaImprimir();
				break;
			case 8:
				return $this->getCaProducto();
				break;
			case 9:
				return $this->getCaIncoterms();
				break;
			case 10:
				return $this->getCaFrecuencia();
				break;
			case 11:
				return $this->getCaTiempotransito();
				break;
			case 12:
				return $this->getCaLocrecargos();
				break;
			case 13:
				return $this->getCaObservaciones();
				break;
			case 14:
				return $this->getCaFchcreado();
				break;
			case 15:
				return $this->getCaUsucreado();
				break;
			case 16:
				return $this->getCaFchactualizado();
				break;
			case 17:
				return $this->getCaUsuactualizado();
				break;
			case 18:
				return $this->getCaDatosag();
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
		$keys = CotProductoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdcotizacion(),
			$keys[1] => $this->getCaIdproducto(),
			$keys[2] => $this->getCaTransporte(),
			$keys[3] => $this->getCaModalidad(),
			$keys[4] => $this->getCaOrigen(),
			$keys[5] => $this->getCaDestino(),
			$keys[6] => $this->getCaImpoexpo(),
			$keys[7] => $this->getCaImprimir(),
			$keys[8] => $this->getCaProducto(),
			$keys[9] => $this->getCaIncoterms(),
			$keys[10] => $this->getCaFrecuencia(),
			$keys[11] => $this->getCaTiempotransito(),
			$keys[12] => $this->getCaLocrecargos(),
			$keys[13] => $this->getCaObservaciones(),
			$keys[14] => $this->getCaFchcreado(),
			$keys[15] => $this->getCaUsucreado(),
			$keys[16] => $this->getCaFchactualizado(),
			$keys[17] => $this->getCaUsuactualizado(),
			$keys[18] => $this->getCaDatosag(),
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
				$this->setCaIdcotizacion($value);
				break;
			case 1:
				$this->setCaIdproducto($value);
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
				$this->setCaImpoexpo($value);
				break;
			case 7:
				$this->setCaImprimir($value);
				break;
			case 8:
				$this->setCaProducto($value);
				break;
			case 9:
				$this->setCaIncoterms($value);
				break;
			case 10:
				$this->setCaFrecuencia($value);
				break;
			case 11:
				$this->setCaTiempotransito($value);
				break;
			case 12:
				$this->setCaLocrecargos($value);
				break;
			case 13:
				$this->setCaObservaciones($value);
				break;
			case 14:
				$this->setCaFchcreado($value);
				break;
			case 15:
				$this->setCaUsucreado($value);
				break;
			case 16:
				$this->setCaFchactualizado($value);
				break;
			case 17:
				$this->setCaUsuactualizado($value);
				break;
			case 18:
				$this->setCaDatosag($value);
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
		$keys = CotProductoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdcotizacion($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdproducto($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaTransporte($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaModalidad($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaOrigen($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaDestino($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaImpoexpo($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaImprimir($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaProducto($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaIncoterms($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaFrecuencia($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaTiempotransito($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaLocrecargos($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaObservaciones($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaFchcreado($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaUsucreado($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCaFchactualizado($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setCaUsuactualizado($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setCaDatosag($arr[$keys[18]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(CotProductoPeer::DATABASE_NAME);

		if ($this->isColumnModified(CotProductoPeer::CA_IDCOTIZACION)) $criteria->add(CotProductoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);
		if ($this->isColumnModified(CotProductoPeer::CA_IDPRODUCTO)) $criteria->add(CotProductoPeer::CA_IDPRODUCTO, $this->ca_idproducto);
		if ($this->isColumnModified(CotProductoPeer::CA_TRANSPORTE)) $criteria->add(CotProductoPeer::CA_TRANSPORTE, $this->ca_transporte);
		if ($this->isColumnModified(CotProductoPeer::CA_MODALIDAD)) $criteria->add(CotProductoPeer::CA_MODALIDAD, $this->ca_modalidad);
		if ($this->isColumnModified(CotProductoPeer::CA_ORIGEN)) $criteria->add(CotProductoPeer::CA_ORIGEN, $this->ca_origen);
		if ($this->isColumnModified(CotProductoPeer::CA_DESTINO)) $criteria->add(CotProductoPeer::CA_DESTINO, $this->ca_destino);
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

		$criteria->add(CotProductoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);
		$criteria->add(CotProductoPeer::CA_IDPRODUCTO, $this->ca_idproducto);

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

		$copyObj->setCaTransporte($this->ca_transporte);

		$copyObj->setCaModalidad($this->ca_modalidad);

		$copyObj->setCaOrigen($this->ca_origen);

		$copyObj->setCaDestino($this->ca_destino);

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


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getCotOpcions() as $relObj) {
				$copyObj->addCotOpcion($relObj->copy($deepCopy));
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setCaIdcotizacion(NULL); // this is a pkey column, so set to default value

		$copyObj->setCaIdproducto(NULL); // this is a pkey column, so set to default value

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
	 * @return     void
	 * @throws     PropelException
	 */
	public function setCotizacion($v)
	{


		if ($v === null) {
			$this->setCaIdcotizacion(NULL);
		} else {
			$this->setCaIdcotizacion($v->getCaIdcotizacion());
		}


		$this->aCotizacion = $v;
	}


	/**
	 * Get the associated Cotizacion object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Cotizacion The associated Cotizacion object.
	 * @throws     PropelException
	 */
	public function getCotizacion($con = null)
	{
		if ($this->aCotizacion === null && ($this->ca_idcotizacion !== null)) {
			// include the related Peer class
			$this->aCotizacion = CotizacionPeer::retrieveByPK($this->ca_idcotizacion, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = CotizacionPeer::retrieveByPK($this->ca_idcotizacion, $con);
			   $obj->addCotizacions($this);
			 */
		}
		return $this->aCotizacion;
	}

	/**
	 * Temporary storage of collCotOpcions to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initCotOpcions()
	{
		if ($this->collCotOpcions === null) {
			$this->collCotOpcions = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this CotProducto has previously
	 * been saved, it will retrieve related CotOpcions from storage.
	 * If this CotProducto is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getCotOpcions($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotOpcions === null) {
			if ($this->isNew()) {
			   $this->collCotOpcions = array();
			} else {

				$criteria->add(CotOpcionPeer::CA_IDCOTIZACION, $this->getCaIdcotizacion());

				$criteria->add(CotOpcionPeer::CA_IDPRODUCTO, $this->getCaIdproducto());

				CotOpcionPeer::addSelectColumns($criteria);
				$this->collCotOpcions = CotOpcionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CotOpcionPeer::CA_IDCOTIZACION, $this->getCaIdcotizacion());


				$criteria->add(CotOpcionPeer::CA_IDPRODUCTO, $this->getCaIdproducto());

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
	 * Returns the number of related CotOpcions.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countCotOpcions($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CotOpcionPeer::CA_IDCOTIZACION, $this->getCaIdcotizacion());

		$criteria->add(CotOpcionPeer::CA_IDPRODUCTO, $this->getCaIdproducto());

		return CotOpcionPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a CotOpcion object to this object
	 * through the CotOpcion foreign key attribute
	 *
	 * @param      CotOpcion $l CotOpcion
	 * @return     void
	 * @throws     PropelException
	 */
	public function addCotOpcion(CotOpcion $l)
	{
		$this->collCotOpcions[] = $l;
		$l->setCotProducto($this);
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
	public function getCotOpcionsJoinConcepto($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotOpcions === null) {
			if ($this->isNew()) {
				$this->collCotOpcions = array();
			} else {

				$criteria->add(CotOpcionPeer::CA_IDCOTIZACION, $this->getCaIdcotizacion());

				$criteria->add(CotOpcionPeer::CA_IDPRODUCTO, $this->getCaIdproducto());

				$this->collCotOpcions = CotOpcionPeer::doSelectJoinConcepto($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CotOpcionPeer::CA_IDCOTIZACION, $this->getCaIdcotizacion());

			$criteria->add(CotOpcionPeer::CA_IDPRODUCTO, $this->getCaIdproducto());

			if (!isset($this->lastCotOpcionCriteria) || !$this->lastCotOpcionCriteria->equals($criteria)) {
				$this->collCotOpcions = CotOpcionPeer::doSelectJoinConcepto($criteria, $con);
			}
		}
		$this->lastCotOpcionCriteria = $criteria;

		return $this->collCotOpcions;
	}

} // BaseCotProducto
