<?php

/**
 * Base class that represents a row from the 'tb_inoingresos_sea' table.
 *
 * 
 *
 * @package    lib.model.sea.om
 */
abstract class BaseInoIngresosSea extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        InoIngresosSeaPeer
	 */
	protected static $peer;


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
	 * The value for the ca_factura field.
	 * @var        string
	 */
	protected $ca_factura;


	/**
	 * The value for the ca_fchfactura field.
	 * @var        int
	 */
	protected $ca_fchfactura;


	/**
	 * The value for the ca_valor field.
	 * @var        double
	 */
	protected $ca_valor;


	/**
	 * The value for the ca_reccaja field.
	 * @var        string
	 */
	protected $ca_reccaja;


	/**
	 * The value for the ca_fchpago field.
	 * @var        int
	 */
	protected $ca_fchpago;


	/**
	 * The value for the ca_tcambio field.
	 * @var        double
	 */
	protected $ca_tcambio;


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
	 * The value for the ca_observaciones field.
	 * @var        string
	 */
	protected $ca_observaciones;

	/**
	 * @var        InoMaestraSea
	 */
	protected $aInoMaestraSea;

	/**
	 * @var        Cliente
	 */
	protected $aCliente;

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
	 * Get the [ca_factura] column value.
	 * 
	 * @return     string
	 */
	public function getCaFactura()
	{

		return $this->ca_factura;
	}

	/**
	 * Get the [optionally formatted] [ca_fchfactura] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchfactura($format = 'Y-m-d')
	{

		if ($this->ca_fchfactura === null || $this->ca_fchfactura === '') {
			return null;
		} elseif (!is_int($this->ca_fchfactura)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_fchfactura);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_fchfactura] as date/time value: " . var_export($this->ca_fchfactura, true));
			}
		} else {
			$ts = $this->ca_fchfactura;
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
	 * Get the [ca_valor] column value.
	 * 
	 * @return     double
	 */
	public function getCaValor()
	{

		return $this->ca_valor;
	}

	/**
	 * Get the [ca_reccaja] column value.
	 * 
	 * @return     string
	 */
	public function getCaReccaja()
	{

		return $this->ca_reccaja;
	}

	/**
	 * Get the [optionally formatted] [ca_fchpago] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchpago($format = 'Y-m-d')
	{

		if ($this->ca_fchpago === null || $this->ca_fchpago === '') {
			return null;
		} elseif (!is_int($this->ca_fchpago)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_fchpago);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_fchpago] as date/time value: " . var_export($this->ca_fchpago, true));
			}
		} else {
			$ts = $this->ca_fchpago;
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
	 * Get the [ca_tcambio] column value.
	 * 
	 * @return     double
	 */
	public function getCaTcambio()
	{

		return $this->ca_tcambio;
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
	 * Get the [ca_observaciones] column value.
	 * 
	 * @return     string
	 */
	public function getCaObservaciones()
	{

		return $this->ca_observaciones;
	}

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
			$this->modifiedColumns[] = InoIngresosSeaPeer::CA_REFERENCIA;
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
			$this->modifiedColumns[] = InoIngresosSeaPeer::CA_IDCLIENTE;
		}

		if ($this->aCliente !== null && $this->aCliente->getCaIdcliente() !== $v) {
			$this->aCliente = null;
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
			$this->modifiedColumns[] = InoIngresosSeaPeer::CA_HBLS;
		}

	} // setCaHbls()

	/**
	 * Set the value of [ca_factura] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaFactura($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_factura !== $v) {
			$this->ca_factura = $v;
			$this->modifiedColumns[] = InoIngresosSeaPeer::CA_FACTURA;
		}

	} // setCaFactura()

	/**
	 * Set the value of [ca_fchfactura] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaFchfactura($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_fchfactura] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_fchfactura !== $ts) {
			$this->ca_fchfactura = $ts;
			$this->modifiedColumns[] = InoIngresosSeaPeer::CA_FCHFACTURA;
		}

	} // setCaFchfactura()

	/**
	 * Set the value of [ca_valor] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaValor($v)
	{

		if ($this->ca_valor !== $v) {
			$this->ca_valor = $v;
			$this->modifiedColumns[] = InoIngresosSeaPeer::CA_VALOR;
		}

	} // setCaValor()

	/**
	 * Set the value of [ca_reccaja] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaReccaja($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_reccaja !== $v) {
			$this->ca_reccaja = $v;
			$this->modifiedColumns[] = InoIngresosSeaPeer::CA_RECCAJA;
		}

	} // setCaReccaja()

	/**
	 * Set the value of [ca_fchpago] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaFchpago($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_fchpago] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_fchpago !== $ts) {
			$this->ca_fchpago = $ts;
			$this->modifiedColumns[] = InoIngresosSeaPeer::CA_FCHPAGO;
		}

	} // setCaFchpago()

	/**
	 * Set the value of [ca_tcambio] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaTcambio($v)
	{

		if ($this->ca_tcambio !== $v) {
			$this->ca_tcambio = $v;
			$this->modifiedColumns[] = InoIngresosSeaPeer::CA_TCAMBIO;
		}

	} // setCaTcambio()

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
			$this->modifiedColumns[] = InoIngresosSeaPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = InoIngresosSeaPeer::CA_USUCREADO;
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
			$this->modifiedColumns[] = InoIngresosSeaPeer::CA_FCHACTUALIZADO;
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
			$this->modifiedColumns[] = InoIngresosSeaPeer::CA_USUACTUALIZADO;
		}

	} // setCaUsuactualizado()

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
			$this->modifiedColumns[] = InoIngresosSeaPeer::CA_OBSERVACIONES;
		}

	} // setCaObservaciones()

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

			$this->ca_referencia = $rs->getString($startcol + 0);

			$this->ca_idcliente = $rs->getInt($startcol + 1);

			$this->ca_hbls = $rs->getString($startcol + 2);

			$this->ca_factura = $rs->getString($startcol + 3);

			$this->ca_fchfactura = $rs->getDate($startcol + 4, null);

			$this->ca_valor = $rs->getFloat($startcol + 5);

			$this->ca_reccaja = $rs->getString($startcol + 6);

			$this->ca_fchpago = $rs->getDate($startcol + 7, null);

			$this->ca_tcambio = $rs->getFloat($startcol + 8);

			$this->ca_fchcreado = $rs->getTimestamp($startcol + 9, null);

			$this->ca_usucreado = $rs->getString($startcol + 10);

			$this->ca_fchactualizado = $rs->getTimestamp($startcol + 11, null);

			$this->ca_usuactualizado = $rs->getString($startcol + 12);

			$this->ca_observaciones = $rs->getString($startcol + 13);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 14; // 14 = InoIngresosSeaPeer::NUM_COLUMNS - InoIngresosSeaPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating InoIngresosSea object", $e);
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
			$con = Propel::getConnection(InoIngresosSeaPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			InoIngresosSeaPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(InoIngresosSeaPeer::DATABASE_NAME);
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

			if ($this->aInoMaestraSea !== null) {
				if ($this->aInoMaestraSea->isModified()) {
					$affectedRows += $this->aInoMaestraSea->save($con);
				}
				$this->setInoMaestraSea($this->aInoMaestraSea);
			}

			if ($this->aCliente !== null) {
				if ($this->aCliente->isModified()) {
					$affectedRows += $this->aCliente->save($con);
				}
				$this->setCliente($this->aCliente);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = InoIngresosSeaPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += InoIngresosSeaPeer::doUpdate($this, $con);
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

			if ($this->aInoMaestraSea !== null) {
				if (!$this->aInoMaestraSea->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aInoMaestraSea->getValidationFailures());
				}
			}

			if ($this->aCliente !== null) {
				if (!$this->aCliente->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCliente->getValidationFailures());
				}
			}


			if (($retval = InoIngresosSeaPeer::doValidate($this, $columns)) !== true) {
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
		$pos = InoIngresosSeaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaReferencia();
				break;
			case 1:
				return $this->getCaIdcliente();
				break;
			case 2:
				return $this->getCaHbls();
				break;
			case 3:
				return $this->getCaFactura();
				break;
			case 4:
				return $this->getCaFchfactura();
				break;
			case 5:
				return $this->getCaValor();
				break;
			case 6:
				return $this->getCaReccaja();
				break;
			case 7:
				return $this->getCaFchpago();
				break;
			case 8:
				return $this->getCaTcambio();
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
	 * @param      string $keyType One of the class type constants TYPE_PHPNAME,
	 *                        TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = InoIngresosSeaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaReferencia(),
			$keys[1] => $this->getCaIdcliente(),
			$keys[2] => $this->getCaHbls(),
			$keys[3] => $this->getCaFactura(),
			$keys[4] => $this->getCaFchfactura(),
			$keys[5] => $this->getCaValor(),
			$keys[6] => $this->getCaReccaja(),
			$keys[7] => $this->getCaFchpago(),
			$keys[8] => $this->getCaTcambio(),
			$keys[9] => $this->getCaFchcreado(),
			$keys[10] => $this->getCaUsucreado(),
			$keys[11] => $this->getCaFchactualizado(),
			$keys[12] => $this->getCaUsuactualizado(),
			$keys[13] => $this->getCaObservaciones(),
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
		$pos = InoIngresosSeaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaReferencia($value);
				break;
			case 1:
				$this->setCaIdcliente($value);
				break;
			case 2:
				$this->setCaHbls($value);
				break;
			case 3:
				$this->setCaFactura($value);
				break;
			case 4:
				$this->setCaFchfactura($value);
				break;
			case 5:
				$this->setCaValor($value);
				break;
			case 6:
				$this->setCaReccaja($value);
				break;
			case 7:
				$this->setCaFchpago($value);
				break;
			case 8:
				$this->setCaTcambio($value);
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
	 * of the class type constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME,
	 * TYPE_NUM. The default key type is the column's phpname (e.g. 'authorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = InoIngresosSeaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaReferencia($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdcliente($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaHbls($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaFactura($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaFchfactura($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaValor($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaReccaja($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaFchpago($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaTcambio($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaFchcreado($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaUsucreado($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaFchactualizado($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaUsuactualizado($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaObservaciones($arr[$keys[13]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(InoIngresosSeaPeer::DATABASE_NAME);

		if ($this->isColumnModified(InoIngresosSeaPeer::CA_REFERENCIA)) $criteria->add(InoIngresosSeaPeer::CA_REFERENCIA, $this->ca_referencia);
		if ($this->isColumnModified(InoIngresosSeaPeer::CA_IDCLIENTE)) $criteria->add(InoIngresosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);
		if ($this->isColumnModified(InoIngresosSeaPeer::CA_HBLS)) $criteria->add(InoIngresosSeaPeer::CA_HBLS, $this->ca_hbls);
		if ($this->isColumnModified(InoIngresosSeaPeer::CA_FACTURA)) $criteria->add(InoIngresosSeaPeer::CA_FACTURA, $this->ca_factura);
		if ($this->isColumnModified(InoIngresosSeaPeer::CA_FCHFACTURA)) $criteria->add(InoIngresosSeaPeer::CA_FCHFACTURA, $this->ca_fchfactura);
		if ($this->isColumnModified(InoIngresosSeaPeer::CA_VALOR)) $criteria->add(InoIngresosSeaPeer::CA_VALOR, $this->ca_valor);
		if ($this->isColumnModified(InoIngresosSeaPeer::CA_RECCAJA)) $criteria->add(InoIngresosSeaPeer::CA_RECCAJA, $this->ca_reccaja);
		if ($this->isColumnModified(InoIngresosSeaPeer::CA_FCHPAGO)) $criteria->add(InoIngresosSeaPeer::CA_FCHPAGO, $this->ca_fchpago);
		if ($this->isColumnModified(InoIngresosSeaPeer::CA_TCAMBIO)) $criteria->add(InoIngresosSeaPeer::CA_TCAMBIO, $this->ca_tcambio);
		if ($this->isColumnModified(InoIngresosSeaPeer::CA_FCHCREADO)) $criteria->add(InoIngresosSeaPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(InoIngresosSeaPeer::CA_USUCREADO)) $criteria->add(InoIngresosSeaPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(InoIngresosSeaPeer::CA_FCHACTUALIZADO)) $criteria->add(InoIngresosSeaPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(InoIngresosSeaPeer::CA_USUACTUALIZADO)) $criteria->add(InoIngresosSeaPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);
		if ($this->isColumnModified(InoIngresosSeaPeer::CA_OBSERVACIONES)) $criteria->add(InoIngresosSeaPeer::CA_OBSERVACIONES, $this->ca_observaciones);

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
		$criteria = new Criteria(InoIngresosSeaPeer::DATABASE_NAME);

		$criteria->add(InoIngresosSeaPeer::CA_REFERENCIA, $this->ca_referencia);
		$criteria->add(InoIngresosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);
		$criteria->add(InoIngresosSeaPeer::CA_HBLS, $this->ca_hbls);
		$criteria->add(InoIngresosSeaPeer::CA_FACTURA, $this->ca_factura);

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

		$pks[3] = $this->getCaFactura();

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

		$this->setCaFactura($keys[3]);

	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of InoIngresosSea (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaFchfactura($this->ca_fchfactura);

		$copyObj->setCaValor($this->ca_valor);

		$copyObj->setCaReccaja($this->ca_reccaja);

		$copyObj->setCaFchpago($this->ca_fchpago);

		$copyObj->setCaTcambio($this->ca_tcambio);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);

		$copyObj->setCaObservaciones($this->ca_observaciones);


		$copyObj->setNew(true);

		$copyObj->setCaReferencia(NULL); // this is a pkey column, so set to default value

		$copyObj->setCaIdcliente(NULL); // this is a pkey column, so set to default value

		$copyObj->setCaHbls(NULL); // this is a pkey column, so set to default value

		$copyObj->setCaFactura(NULL); // this is a pkey column, so set to default value

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
	 * @return     InoIngresosSea Clone of current object.
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
	 * @return     InoIngresosSeaPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new InoIngresosSeaPeer();
		}
		return self::$peer;
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

	/**
	 * Declares an association between this object and a Cliente object.
	 *
	 * @param      Cliente $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setCliente($v)
	{


		if ($v === null) {
			$this->setCaIdcliente(NULL);
		} else {
			$this->setCaIdcliente($v->getCaIdcliente());
		}


		$this->aCliente = $v;
	}


	/**
	 * Get the associated Cliente object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Cliente The associated Cliente object.
	 * @throws     PropelException
	 */
	public function getCliente($con = null)
	{
		if ($this->aCliente === null && ($this->ca_idcliente !== null)) {
			// include the related Peer class
			$this->aCliente = ClientePeer::retrieveByPK($this->ca_idcliente, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = ClientePeer::retrieveByPK($this->ca_idcliente, $con);
			   $obj->addClientes($this);
			 */
		}
		return $this->aCliente;
	}

} // BaseInoIngresosSea
