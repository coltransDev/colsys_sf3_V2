<?php

/**
 * Base class that represents a row from the 'tb_inoclientes_air' table.
 *
 * 
 *
 * @package    lib.model.air.om
 */
abstract class BaseInoClientesAir extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        InoClientesAirPeer
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
	 * The value for the ca_hawb field.
	 * @var        string
	 */
	protected $ca_hawb;


	/**
	 * The value for the ca_idreporte field.
	 * @var        string
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
	 * @var        int
	 */
	protected $ca_numpiezas;


	/**
	 * The value for the ca_peso field.
	 * @var        int
	 */
	protected $ca_peso;


	/**
	 * The value for the ca_volumen field.
	 * @var        int
	 */
	protected $ca_volumen;


	/**
	 * The value for the ca_numorden field.
	 * @var        string
	 */
	protected $ca_numorden;


	/**
	 * The value for the ca_loginvendedor field.
	 * @var        string
	 */
	protected $ca_loginvendedor;


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
	 * @var        InoMaestraAir
	 */
	protected $aInoMaestraAir;

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
	 * Get the [ca_hawb] column value.
	 * 
	 * @return     string
	 */
	public function getCaHawb()
	{

		return $this->ca_hawb;
	}

	/**
	 * Get the [ca_idreporte] column value.
	 * 
	 * @return     string
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
	 * @return     int
	 */
	public function getCaNumpiezas()
	{

		return $this->ca_numpiezas;
	}

	/**
	 * Get the [ca_peso] column value.
	 * 
	 * @return     int
	 */
	public function getCaPeso()
	{

		return $this->ca_peso;
	}

	/**
	 * Get the [ca_volumen] column value.
	 * 
	 * @return     int
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
	 * Get the [ca_loginvendedor] column value.
	 * 
	 * @return     string
	 */
	public function getCaLoginvendedor()
	{

		return $this->ca_loginvendedor;
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
	 * Get the [ca_idbodega] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdbodega()
	{

		return $this->ca_idbodega;
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
			$this->modifiedColumns[] = InoClientesAirPeer::CA_REFERENCIA;
		}

		if ($this->aInoMaestraAir !== null && $this->aInoMaestraAir->getCaReferencia() !== $v) {
			$this->aInoMaestraAir = null;
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
			$this->modifiedColumns[] = InoClientesAirPeer::CA_IDCLIENTE;
		}

	} // setCaIdcliente()

	/**
	 * Set the value of [ca_hawb] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaHawb($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_hawb !== $v) {
			$this->ca_hawb = $v;
			$this->modifiedColumns[] = InoClientesAirPeer::CA_HAWB;
		}

	} // setCaHawb()

	/**
	 * Set the value of [ca_idreporte] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaIdreporte($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_idreporte !== $v) {
			$this->ca_idreporte = $v;
			$this->modifiedColumns[] = InoClientesAirPeer::CA_IDREPORTE;
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
			$this->modifiedColumns[] = InoClientesAirPeer::CA_IDPROVEEDOR;
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
			$this->modifiedColumns[] = InoClientesAirPeer::CA_PROVEEDOR;
		}

	} // setCaProveedor()

	/**
	 * Set the value of [ca_numpiezas] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaNumpiezas($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_numpiezas !== $v) {
			$this->ca_numpiezas = $v;
			$this->modifiedColumns[] = InoClientesAirPeer::CA_NUMPIEZAS;
		}

	} // setCaNumpiezas()

	/**
	 * Set the value of [ca_peso] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaPeso($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_peso !== $v) {
			$this->ca_peso = $v;
			$this->modifiedColumns[] = InoClientesAirPeer::CA_PESO;
		}

	} // setCaPeso()

	/**
	 * Set the value of [ca_volumen] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaVolumen($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_volumen !== $v) {
			$this->ca_volumen = $v;
			$this->modifiedColumns[] = InoClientesAirPeer::CA_VOLUMEN;
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
			$this->modifiedColumns[] = InoClientesAirPeer::CA_NUMORDEN;
		}

	} // setCaNumorden()

	/**
	 * Set the value of [ca_loginvendedor] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaLoginvendedor($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_loginvendedor !== $v) {
			$this->ca_loginvendedor = $v;
			$this->modifiedColumns[] = InoClientesAirPeer::CA_LOGINVENDEDOR;
		}

	} // setCaLoginvendedor()

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
			$this->modifiedColumns[] = InoClientesAirPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = InoClientesAirPeer::CA_USUCREADO;
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
			$this->modifiedColumns[] = InoClientesAirPeer::CA_FCHACTUALIZADO;
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
			$this->modifiedColumns[] = InoClientesAirPeer::CA_USUACTUALIZADO;
		}

	} // setCaUsuactualizado()

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
			$this->modifiedColumns[] = InoClientesAirPeer::CA_IDBODEGA;
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

			$this->ca_referencia = $rs->getString($startcol + 0);

			$this->ca_idcliente = $rs->getInt($startcol + 1);

			$this->ca_hawb = $rs->getString($startcol + 2);

			$this->ca_idreporte = $rs->getString($startcol + 3);

			$this->ca_idproveedor = $rs->getInt($startcol + 4);

			$this->ca_proveedor = $rs->getString($startcol + 5);

			$this->ca_numpiezas = $rs->getInt($startcol + 6);

			$this->ca_peso = $rs->getInt($startcol + 7);

			$this->ca_volumen = $rs->getInt($startcol + 8);

			$this->ca_numorden = $rs->getString($startcol + 9);

			$this->ca_loginvendedor = $rs->getString($startcol + 10);

			$this->ca_fchcreado = $rs->getTimestamp($startcol + 11, null);

			$this->ca_usucreado = $rs->getString($startcol + 12);

			$this->ca_fchactualizado = $rs->getTimestamp($startcol + 13, null);

			$this->ca_usuactualizado = $rs->getString($startcol + 14);

			$this->ca_idbodega = $rs->getInt($startcol + 15);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 16; // 16 = InoClientesAirPeer::NUM_COLUMNS - InoClientesAirPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating InoClientesAir object", $e);
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
			$con = Propel::getConnection(InoClientesAirPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			InoClientesAirPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(InoClientesAirPeer::DATABASE_NAME);
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

			if ($this->aInoMaestraAir !== null) {
				if ($this->aInoMaestraAir->isModified()) {
					$affectedRows += $this->aInoMaestraAir->save($con);
				}
				$this->setInoMaestraAir($this->aInoMaestraAir);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = InoClientesAirPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += InoClientesAirPeer::doUpdate($this, $con);
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

			if ($this->aInoMaestraAir !== null) {
				if (!$this->aInoMaestraAir->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aInoMaestraAir->getValidationFailures());
				}
			}


			if (($retval = InoClientesAirPeer::doValidate($this, $columns)) !== true) {
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
		$pos = InoClientesAirPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaHawb();
				break;
			case 3:
				return $this->getCaIdreporte();
				break;
			case 4:
				return $this->getCaIdproveedor();
				break;
			case 5:
				return $this->getCaProveedor();
				break;
			case 6:
				return $this->getCaNumpiezas();
				break;
			case 7:
				return $this->getCaPeso();
				break;
			case 8:
				return $this->getCaVolumen();
				break;
			case 9:
				return $this->getCaNumorden();
				break;
			case 10:
				return $this->getCaLoginvendedor();
				break;
			case 11:
				return $this->getCaFchcreado();
				break;
			case 12:
				return $this->getCaUsucreado();
				break;
			case 13:
				return $this->getCaFchactualizado();
				break;
			case 14:
				return $this->getCaUsuactualizado();
				break;
			case 15:
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
		$keys = InoClientesAirPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaReferencia(),
			$keys[1] => $this->getCaIdcliente(),
			$keys[2] => $this->getCaHawb(),
			$keys[3] => $this->getCaIdreporte(),
			$keys[4] => $this->getCaIdproveedor(),
			$keys[5] => $this->getCaProveedor(),
			$keys[6] => $this->getCaNumpiezas(),
			$keys[7] => $this->getCaPeso(),
			$keys[8] => $this->getCaVolumen(),
			$keys[9] => $this->getCaNumorden(),
			$keys[10] => $this->getCaLoginvendedor(),
			$keys[11] => $this->getCaFchcreado(),
			$keys[12] => $this->getCaUsucreado(),
			$keys[13] => $this->getCaFchactualizado(),
			$keys[14] => $this->getCaUsuactualizado(),
			$keys[15] => $this->getCaIdbodega(),
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
		$pos = InoClientesAirPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaHawb($value);
				break;
			case 3:
				$this->setCaIdreporte($value);
				break;
			case 4:
				$this->setCaIdproveedor($value);
				break;
			case 5:
				$this->setCaProveedor($value);
				break;
			case 6:
				$this->setCaNumpiezas($value);
				break;
			case 7:
				$this->setCaPeso($value);
				break;
			case 8:
				$this->setCaVolumen($value);
				break;
			case 9:
				$this->setCaNumorden($value);
				break;
			case 10:
				$this->setCaLoginvendedor($value);
				break;
			case 11:
				$this->setCaFchcreado($value);
				break;
			case 12:
				$this->setCaUsucreado($value);
				break;
			case 13:
				$this->setCaFchactualizado($value);
				break;
			case 14:
				$this->setCaUsuactualizado($value);
				break;
			case 15:
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
		$keys = InoClientesAirPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaReferencia($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdcliente($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaHawb($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaIdreporte($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaIdproveedor($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaProveedor($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaNumpiezas($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaPeso($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaVolumen($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaNumorden($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaLoginvendedor($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaFchcreado($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaUsucreado($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaFchactualizado($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaUsuactualizado($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaIdbodega($arr[$keys[15]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(InoClientesAirPeer::DATABASE_NAME);

		if ($this->isColumnModified(InoClientesAirPeer::CA_REFERENCIA)) $criteria->add(InoClientesAirPeer::CA_REFERENCIA, $this->ca_referencia);
		if ($this->isColumnModified(InoClientesAirPeer::CA_IDCLIENTE)) $criteria->add(InoClientesAirPeer::CA_IDCLIENTE, $this->ca_idcliente);
		if ($this->isColumnModified(InoClientesAirPeer::CA_HAWB)) $criteria->add(InoClientesAirPeer::CA_HAWB, $this->ca_hawb);
		if ($this->isColumnModified(InoClientesAirPeer::CA_IDREPORTE)) $criteria->add(InoClientesAirPeer::CA_IDREPORTE, $this->ca_idreporte);
		if ($this->isColumnModified(InoClientesAirPeer::CA_IDPROVEEDOR)) $criteria->add(InoClientesAirPeer::CA_IDPROVEEDOR, $this->ca_idproveedor);
		if ($this->isColumnModified(InoClientesAirPeer::CA_PROVEEDOR)) $criteria->add(InoClientesAirPeer::CA_PROVEEDOR, $this->ca_proveedor);
		if ($this->isColumnModified(InoClientesAirPeer::CA_NUMPIEZAS)) $criteria->add(InoClientesAirPeer::CA_NUMPIEZAS, $this->ca_numpiezas);
		if ($this->isColumnModified(InoClientesAirPeer::CA_PESO)) $criteria->add(InoClientesAirPeer::CA_PESO, $this->ca_peso);
		if ($this->isColumnModified(InoClientesAirPeer::CA_VOLUMEN)) $criteria->add(InoClientesAirPeer::CA_VOLUMEN, $this->ca_volumen);
		if ($this->isColumnModified(InoClientesAirPeer::CA_NUMORDEN)) $criteria->add(InoClientesAirPeer::CA_NUMORDEN, $this->ca_numorden);
		if ($this->isColumnModified(InoClientesAirPeer::CA_LOGINVENDEDOR)) $criteria->add(InoClientesAirPeer::CA_LOGINVENDEDOR, $this->ca_loginvendedor);
		if ($this->isColumnModified(InoClientesAirPeer::CA_FCHCREADO)) $criteria->add(InoClientesAirPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(InoClientesAirPeer::CA_USUCREADO)) $criteria->add(InoClientesAirPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(InoClientesAirPeer::CA_FCHACTUALIZADO)) $criteria->add(InoClientesAirPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(InoClientesAirPeer::CA_USUACTUALIZADO)) $criteria->add(InoClientesAirPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);
		if ($this->isColumnModified(InoClientesAirPeer::CA_IDBODEGA)) $criteria->add(InoClientesAirPeer::CA_IDBODEGA, $this->ca_idbodega);

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
		$criteria = new Criteria(InoClientesAirPeer::DATABASE_NAME);

		$criteria->add(InoClientesAirPeer::CA_REFERENCIA, $this->ca_referencia);
		$criteria->add(InoClientesAirPeer::CA_IDCLIENTE, $this->ca_idcliente);
		$criteria->add(InoClientesAirPeer::CA_HAWB, $this->ca_hawb);

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

		$pks[2] = $this->getCaHawb();

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

		$this->setCaHawb($keys[2]);

	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of InoClientesAir (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdreporte($this->ca_idreporte);

		$copyObj->setCaIdproveedor($this->ca_idproveedor);

		$copyObj->setCaProveedor($this->ca_proveedor);

		$copyObj->setCaNumpiezas($this->ca_numpiezas);

		$copyObj->setCaPeso($this->ca_peso);

		$copyObj->setCaVolumen($this->ca_volumen);

		$copyObj->setCaNumorden($this->ca_numorden);

		$copyObj->setCaLoginvendedor($this->ca_loginvendedor);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);

		$copyObj->setCaIdbodega($this->ca_idbodega);


		$copyObj->setNew(true);

		$copyObj->setCaReferencia(NULL); // this is a pkey column, so set to default value

		$copyObj->setCaIdcliente(NULL); // this is a pkey column, so set to default value

		$copyObj->setCaHawb(NULL); // this is a pkey column, so set to default value

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
	 * @return     InoClientesAir Clone of current object.
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
	 * @return     InoClientesAirPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new InoClientesAirPeer();
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
		if ($this->aReporte === null && (($this->ca_idreporte !== "" && $this->ca_idreporte !== null))) {
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
	 * Declares an association between this object and a InoMaestraAir object.
	 *
	 * @param      InoMaestraAir $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setInoMaestraAir($v)
	{


		if ($v === null) {
			$this->setCaReferencia(NULL);
		} else {
			$this->setCaReferencia($v->getCaReferencia());
		}


		$this->aInoMaestraAir = $v;
	}


	/**
	 * Get the associated InoMaestraAir object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     InoMaestraAir The associated InoMaestraAir object.
	 * @throws     PropelException
	 */
	public function getInoMaestraAir($con = null)
	{
		if ($this->aInoMaestraAir === null && (($this->ca_referencia !== "" && $this->ca_referencia !== null))) {
			// include the related Peer class
			$this->aInoMaestraAir = InoMaestraAirPeer::retrieveByPK($this->ca_referencia, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = InoMaestraAirPeer::retrieveByPK($this->ca_referencia, $con);
			   $obj->addInoMaestraAirs($this);
			 */
		}
		return $this->aInoMaestraAir;
	}

} // BaseInoClientesAir
