<?php

/**
 * Base class that represents a row from the 'tb_faladetails' table.
 *
 * 
 *
 * @package    lib.model.falabella.om
 */
abstract class BaseFalaDetail extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        FalaDetailPeer
	 */
	protected static $peer;


	/**
	 * The value for the ca_iddoc field.
	 * @var        string
	 */
	protected $ca_iddoc;


	/**
	 * The value for the ca_sku field.
	 * @var        string
	 */
	protected $ca_sku;


	/**
	 * The value for the ca_vpn field.
	 * @var        string
	 */
	protected $ca_vpn;


	/**
	 * The value for the ca_num_cont_part1 field.
	 * @var        string
	 */
	protected $ca_num_cont_part1;


	/**
	 * The value for the ca_num_cont_part2 field.
	 * @var        string
	 */
	protected $ca_num_cont_part2;


	/**
	 * The value for the ca_num_cont_sell field.
	 * @var        string
	 */
	protected $ca_num_cont_sell;


	/**
	 * The value for the ca_container_iso field.
	 * @var        string
	 */
	protected $ca_container_iso;


	/**
	 * The value for the ca_cantidad_pedido field.
	 * @var        int
	 */
	protected $ca_cantidad_pedido;


	/**
	 * The value for the ca_cantidad_miles field.
	 * @var        int
	 */
	protected $ca_cantidad_miles;


	/**
	 * The value for the ca_unidad_medidad_cantidad field.
	 * @var        string
	 */
	protected $ca_unidad_medidad_cantidad;


	/**
	 * The value for the ca_descripcion_item field.
	 * @var        string
	 */
	protected $ca_descripcion_item;


	/**
	 * The value for the ca_cantidad_paquetes_miles field.
	 * @var        double
	 */
	protected $ca_cantidad_paquetes_miles;


	/**
	 * The value for the ca_unidad_medida_paquetes field.
	 * @var        string
	 */
	protected $ca_unidad_medida_paquetes;


	/**
	 * The value for the ca_cantidad_volumen_miles field.
	 * @var        double
	 */
	protected $ca_cantidad_volumen_miles;


	/**
	 * The value for the ca_unidad_medida_volumen field.
	 * @var        string
	 */
	protected $ca_unidad_medida_volumen;


	/**
	 * The value for the ca_cantidad_peso_miles field.
	 * @var        double
	 */
	protected $ca_cantidad_peso_miles;


	/**
	 * The value for the ca_unidad_medida_peso field.
	 * @var        string
	 */
	protected $ca_unidad_medida_peso;

	/**
	 * @var        FalaHeader
	 */
	protected $aFalaHeader;

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
	 * Get the [ca_iddoc] column value.
	 * 
	 * @return     string
	 */
	public function getCaIddoc()
	{

		return $this->ca_iddoc;
	}

	/**
	 * Get the [ca_sku] column value.
	 * 
	 * @return     string
	 */
	public function getCaSku()
	{

		return $this->ca_sku;
	}

	/**
	 * Get the [ca_vpn] column value.
	 * 
	 * @return     string
	 */
	public function getCaVpn()
	{

		return $this->ca_vpn;
	}

	/**
	 * Get the [ca_num_cont_part1] column value.
	 * 
	 * @return     string
	 */
	public function getCaNumContPart1()
	{

		return $this->ca_num_cont_part1;
	}

	/**
	 * Get the [ca_num_cont_part2] column value.
	 * 
	 * @return     string
	 */
	public function getCaNumContPart2()
	{

		return $this->ca_num_cont_part2;
	}

	/**
	 * Get the [ca_num_cont_sell] column value.
	 * 
	 * @return     string
	 */
	public function getCaNumContSell()
	{

		return $this->ca_num_cont_sell;
	}

	/**
	 * Get the [ca_container_iso] column value.
	 * 
	 * @return     string
	 */
	public function getCaContainerIso()
	{

		return $this->ca_container_iso;
	}

	/**
	 * Get the [ca_cantidad_pedido] column value.
	 * 
	 * @return     int
	 */
	public function getCaCantidadPedido()
	{

		return $this->ca_cantidad_pedido;
	}

	/**
	 * Get the [ca_cantidad_miles] column value.
	 * 
	 * @return     int
	 */
	public function getCaCantidadMiles()
	{

		return $this->ca_cantidad_miles;
	}

	/**
	 * Get the [ca_unidad_medidad_cantidad] column value.
	 * 
	 * @return     string
	 */
	public function getCaUnidadMedidadCantidad()
	{

		return $this->ca_unidad_medidad_cantidad;
	}

	/**
	 * Get the [ca_descripcion_item] column value.
	 * 
	 * @return     string
	 */
	public function getCaDescripcionItem()
	{

		return $this->ca_descripcion_item;
	}

	/**
	 * Get the [ca_cantidad_paquetes_miles] column value.
	 * 
	 * @return     double
	 */
	public function getCaCantidadPaquetesMiles()
	{

		return $this->ca_cantidad_paquetes_miles;
	}

	/**
	 * Get the [ca_unidad_medida_paquetes] column value.
	 * 
	 * @return     string
	 */
	public function getCaUnidadMedidaPaquetes()
	{

		return $this->ca_unidad_medida_paquetes;
	}

	/**
	 * Get the [ca_cantidad_volumen_miles] column value.
	 * 
	 * @return     double
	 */
	public function getCaCantidadVolumenMiles()
	{

		return $this->ca_cantidad_volumen_miles;
	}

	/**
	 * Get the [ca_unidad_medida_volumen] column value.
	 * 
	 * @return     string
	 */
	public function getCaUnidadMedidaVolumen()
	{

		return $this->ca_unidad_medida_volumen;
	}

	/**
	 * Get the [ca_cantidad_peso_miles] column value.
	 * 
	 * @return     double
	 */
	public function getCaCantidadPesoMiles()
	{

		return $this->ca_cantidad_peso_miles;
	}

	/**
	 * Get the [ca_unidad_medida_peso] column value.
	 * 
	 * @return     string
	 */
	public function getCaUnidadMedidaPeso()
	{

		return $this->ca_unidad_medida_peso;
	}

	/**
	 * Set the value of [ca_iddoc] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaIddoc($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_iddoc !== $v) {
			$this->ca_iddoc = $v;
			$this->modifiedColumns[] = FalaDetailPeer::CA_IDDOC;
		}

		if ($this->aFalaHeader !== null && $this->aFalaHeader->getCaIddoc() !== $v) {
			$this->aFalaHeader = null;
		}

	} // setCaIddoc()

	/**
	 * Set the value of [ca_sku] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaSku($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_sku !== $v) {
			$this->ca_sku = $v;
			$this->modifiedColumns[] = FalaDetailPeer::CA_SKU;
		}

	} // setCaSku()

	/**
	 * Set the value of [ca_vpn] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaVpn($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_vpn !== $v) {
			$this->ca_vpn = $v;
			$this->modifiedColumns[] = FalaDetailPeer::CA_VPN;
		}

	} // setCaVpn()

	/**
	 * Set the value of [ca_num_cont_part1] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaNumContPart1($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_num_cont_part1 !== $v) {
			$this->ca_num_cont_part1 = $v;
			$this->modifiedColumns[] = FalaDetailPeer::CA_NUM_CONT_PART1;
		}

	} // setCaNumContPart1()

	/**
	 * Set the value of [ca_num_cont_part2] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaNumContPart2($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_num_cont_part2 !== $v) {
			$this->ca_num_cont_part2 = $v;
			$this->modifiedColumns[] = FalaDetailPeer::CA_NUM_CONT_PART2;
		}

	} // setCaNumContPart2()

	/**
	 * Set the value of [ca_num_cont_sell] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaNumContSell($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_num_cont_sell !== $v) {
			$this->ca_num_cont_sell = $v;
			$this->modifiedColumns[] = FalaDetailPeer::CA_NUM_CONT_SELL;
		}

	} // setCaNumContSell()

	/**
	 * Set the value of [ca_container_iso] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaContainerIso($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_container_iso !== $v) {
			$this->ca_container_iso = $v;
			$this->modifiedColumns[] = FalaDetailPeer::CA_CONTAINER_ISO;
		}

	} // setCaContainerIso()

	/**
	 * Set the value of [ca_cantidad_pedido] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaCantidadPedido($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_cantidad_pedido !== $v) {
			$this->ca_cantidad_pedido = $v;
			$this->modifiedColumns[] = FalaDetailPeer::CA_CANTIDAD_PEDIDO;
		}

	} // setCaCantidadPedido()

	/**
	 * Set the value of [ca_cantidad_miles] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaCantidadMiles($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_cantidad_miles !== $v) {
			$this->ca_cantidad_miles = $v;
			$this->modifiedColumns[] = FalaDetailPeer::CA_CANTIDAD_MILES;
		}

	} // setCaCantidadMiles()

	/**
	 * Set the value of [ca_unidad_medidad_cantidad] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaUnidadMedidadCantidad($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_unidad_medidad_cantidad !== $v) {
			$this->ca_unidad_medidad_cantidad = $v;
			$this->modifiedColumns[] = FalaDetailPeer::CA_UNIDAD_MEDIDAD_CANTIDAD;
		}

	} // setCaUnidadMedidadCantidad()

	/**
	 * Set the value of [ca_descripcion_item] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaDescripcionItem($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_descripcion_item !== $v) {
			$this->ca_descripcion_item = $v;
			$this->modifiedColumns[] = FalaDetailPeer::CA_DESCRIPCION_ITEM;
		}

	} // setCaDescripcionItem()

	/**
	 * Set the value of [ca_cantidad_paquetes_miles] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaCantidadPaquetesMiles($v)
	{

		if ($this->ca_cantidad_paquetes_miles !== $v) {
			$this->ca_cantidad_paquetes_miles = $v;
			$this->modifiedColumns[] = FalaDetailPeer::CA_CANTIDAD_PAQUETES_MILES;
		}

	} // setCaCantidadPaquetesMiles()

	/**
	 * Set the value of [ca_unidad_medida_paquetes] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaUnidadMedidaPaquetes($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_unidad_medida_paquetes !== $v) {
			$this->ca_unidad_medida_paquetes = $v;
			$this->modifiedColumns[] = FalaDetailPeer::CA_UNIDAD_MEDIDA_PAQUETES;
		}

	} // setCaUnidadMedidaPaquetes()

	/**
	 * Set the value of [ca_cantidad_volumen_miles] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaCantidadVolumenMiles($v)
	{

		if ($this->ca_cantidad_volumen_miles !== $v) {
			$this->ca_cantidad_volumen_miles = $v;
			$this->modifiedColumns[] = FalaDetailPeer::CA_CANTIDAD_VOLUMEN_MILES;
		}

	} // setCaCantidadVolumenMiles()

	/**
	 * Set the value of [ca_unidad_medida_volumen] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaUnidadMedidaVolumen($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_unidad_medida_volumen !== $v) {
			$this->ca_unidad_medida_volumen = $v;
			$this->modifiedColumns[] = FalaDetailPeer::CA_UNIDAD_MEDIDA_VOLUMEN;
		}

	} // setCaUnidadMedidaVolumen()

	/**
	 * Set the value of [ca_cantidad_peso_miles] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaCantidadPesoMiles($v)
	{

		if ($this->ca_cantidad_peso_miles !== $v) {
			$this->ca_cantidad_peso_miles = $v;
			$this->modifiedColumns[] = FalaDetailPeer::CA_CANTIDAD_PESO_MILES;
		}

	} // setCaCantidadPesoMiles()

	/**
	 * Set the value of [ca_unidad_medida_peso] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaUnidadMedidaPeso($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_unidad_medida_peso !== $v) {
			$this->ca_unidad_medida_peso = $v;
			$this->modifiedColumns[] = FalaDetailPeer::CA_UNIDAD_MEDIDA_PESO;
		}

	} // setCaUnidadMedidaPeso()

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

			$this->ca_iddoc = $rs->getString($startcol + 0);

			$this->ca_sku = $rs->getString($startcol + 1);

			$this->ca_vpn = $rs->getString($startcol + 2);

			$this->ca_num_cont_part1 = $rs->getString($startcol + 3);

			$this->ca_num_cont_part2 = $rs->getString($startcol + 4);

			$this->ca_num_cont_sell = $rs->getString($startcol + 5);

			$this->ca_container_iso = $rs->getString($startcol + 6);

			$this->ca_cantidad_pedido = $rs->getInt($startcol + 7);

			$this->ca_cantidad_miles = $rs->getInt($startcol + 8);

			$this->ca_unidad_medidad_cantidad = $rs->getString($startcol + 9);

			$this->ca_descripcion_item = $rs->getString($startcol + 10);

			$this->ca_cantidad_paquetes_miles = $rs->getFloat($startcol + 11);

			$this->ca_unidad_medida_paquetes = $rs->getString($startcol + 12);

			$this->ca_cantidad_volumen_miles = $rs->getFloat($startcol + 13);

			$this->ca_unidad_medida_volumen = $rs->getString($startcol + 14);

			$this->ca_cantidad_peso_miles = $rs->getFloat($startcol + 15);

			$this->ca_unidad_medida_peso = $rs->getString($startcol + 16);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 17; // 17 = FalaDetailPeer::NUM_COLUMNS - FalaDetailPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating FalaDetail object", $e);
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
			$con = Propel::getConnection(FalaDetailPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			FalaDetailPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(FalaDetailPeer::DATABASE_NAME);
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

			if ($this->aFalaHeader !== null) {
				if ($this->aFalaHeader->isModified()) {
					$affectedRows += $this->aFalaHeader->save($con);
				}
				$this->setFalaHeader($this->aFalaHeader);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = FalaDetailPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += FalaDetailPeer::doUpdate($this, $con);
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

			if ($this->aFalaHeader !== null) {
				if (!$this->aFalaHeader->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aFalaHeader->getValidationFailures());
				}
			}


			if (($retval = FalaDetailPeer::doValidate($this, $columns)) !== true) {
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
		$pos = FalaDetailPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIddoc();
				break;
			case 1:
				return $this->getCaSku();
				break;
			case 2:
				return $this->getCaVpn();
				break;
			case 3:
				return $this->getCaNumContPart1();
				break;
			case 4:
				return $this->getCaNumContPart2();
				break;
			case 5:
				return $this->getCaNumContSell();
				break;
			case 6:
				return $this->getCaContainerIso();
				break;
			case 7:
				return $this->getCaCantidadPedido();
				break;
			case 8:
				return $this->getCaCantidadMiles();
				break;
			case 9:
				return $this->getCaUnidadMedidadCantidad();
				break;
			case 10:
				return $this->getCaDescripcionItem();
				break;
			case 11:
				return $this->getCaCantidadPaquetesMiles();
				break;
			case 12:
				return $this->getCaUnidadMedidaPaquetes();
				break;
			case 13:
				return $this->getCaCantidadVolumenMiles();
				break;
			case 14:
				return $this->getCaUnidadMedidaVolumen();
				break;
			case 15:
				return $this->getCaCantidadPesoMiles();
				break;
			case 16:
				return $this->getCaUnidadMedidaPeso();
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
		$keys = FalaDetailPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIddoc(),
			$keys[1] => $this->getCaSku(),
			$keys[2] => $this->getCaVpn(),
			$keys[3] => $this->getCaNumContPart1(),
			$keys[4] => $this->getCaNumContPart2(),
			$keys[5] => $this->getCaNumContSell(),
			$keys[6] => $this->getCaContainerIso(),
			$keys[7] => $this->getCaCantidadPedido(),
			$keys[8] => $this->getCaCantidadMiles(),
			$keys[9] => $this->getCaUnidadMedidadCantidad(),
			$keys[10] => $this->getCaDescripcionItem(),
			$keys[11] => $this->getCaCantidadPaquetesMiles(),
			$keys[12] => $this->getCaUnidadMedidaPaquetes(),
			$keys[13] => $this->getCaCantidadVolumenMiles(),
			$keys[14] => $this->getCaUnidadMedidaVolumen(),
			$keys[15] => $this->getCaCantidadPesoMiles(),
			$keys[16] => $this->getCaUnidadMedidaPeso(),
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
		$pos = FalaDetailPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIddoc($value);
				break;
			case 1:
				$this->setCaSku($value);
				break;
			case 2:
				$this->setCaVpn($value);
				break;
			case 3:
				$this->setCaNumContPart1($value);
				break;
			case 4:
				$this->setCaNumContPart2($value);
				break;
			case 5:
				$this->setCaNumContSell($value);
				break;
			case 6:
				$this->setCaContainerIso($value);
				break;
			case 7:
				$this->setCaCantidadPedido($value);
				break;
			case 8:
				$this->setCaCantidadMiles($value);
				break;
			case 9:
				$this->setCaUnidadMedidadCantidad($value);
				break;
			case 10:
				$this->setCaDescripcionItem($value);
				break;
			case 11:
				$this->setCaCantidadPaquetesMiles($value);
				break;
			case 12:
				$this->setCaUnidadMedidaPaquetes($value);
				break;
			case 13:
				$this->setCaCantidadVolumenMiles($value);
				break;
			case 14:
				$this->setCaUnidadMedidaVolumen($value);
				break;
			case 15:
				$this->setCaCantidadPesoMiles($value);
				break;
			case 16:
				$this->setCaUnidadMedidaPeso($value);
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
		$keys = FalaDetailPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIddoc($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaSku($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaVpn($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaNumContPart1($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaNumContPart2($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaNumContSell($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaContainerIso($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaCantidadPedido($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaCantidadMiles($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaUnidadMedidadCantidad($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaDescripcionItem($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaCantidadPaquetesMiles($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaUnidadMedidaPaquetes($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaCantidadVolumenMiles($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaUnidadMedidaVolumen($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaCantidadPesoMiles($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCaUnidadMedidaPeso($arr[$keys[16]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(FalaDetailPeer::DATABASE_NAME);

		if ($this->isColumnModified(FalaDetailPeer::CA_IDDOC)) $criteria->add(FalaDetailPeer::CA_IDDOC, $this->ca_iddoc);
		if ($this->isColumnModified(FalaDetailPeer::CA_SKU)) $criteria->add(FalaDetailPeer::CA_SKU, $this->ca_sku);
		if ($this->isColumnModified(FalaDetailPeer::CA_VPN)) $criteria->add(FalaDetailPeer::CA_VPN, $this->ca_vpn);
		if ($this->isColumnModified(FalaDetailPeer::CA_NUM_CONT_PART1)) $criteria->add(FalaDetailPeer::CA_NUM_CONT_PART1, $this->ca_num_cont_part1);
		if ($this->isColumnModified(FalaDetailPeer::CA_NUM_CONT_PART2)) $criteria->add(FalaDetailPeer::CA_NUM_CONT_PART2, $this->ca_num_cont_part2);
		if ($this->isColumnModified(FalaDetailPeer::CA_NUM_CONT_SELL)) $criteria->add(FalaDetailPeer::CA_NUM_CONT_SELL, $this->ca_num_cont_sell);
		if ($this->isColumnModified(FalaDetailPeer::CA_CONTAINER_ISO)) $criteria->add(FalaDetailPeer::CA_CONTAINER_ISO, $this->ca_container_iso);
		if ($this->isColumnModified(FalaDetailPeer::CA_CANTIDAD_PEDIDO)) $criteria->add(FalaDetailPeer::CA_CANTIDAD_PEDIDO, $this->ca_cantidad_pedido);
		if ($this->isColumnModified(FalaDetailPeer::CA_CANTIDAD_MILES)) $criteria->add(FalaDetailPeer::CA_CANTIDAD_MILES, $this->ca_cantidad_miles);
		if ($this->isColumnModified(FalaDetailPeer::CA_UNIDAD_MEDIDAD_CANTIDAD)) $criteria->add(FalaDetailPeer::CA_UNIDAD_MEDIDAD_CANTIDAD, $this->ca_unidad_medidad_cantidad);
		if ($this->isColumnModified(FalaDetailPeer::CA_DESCRIPCION_ITEM)) $criteria->add(FalaDetailPeer::CA_DESCRIPCION_ITEM, $this->ca_descripcion_item);
		if ($this->isColumnModified(FalaDetailPeer::CA_CANTIDAD_PAQUETES_MILES)) $criteria->add(FalaDetailPeer::CA_CANTIDAD_PAQUETES_MILES, $this->ca_cantidad_paquetes_miles);
		if ($this->isColumnModified(FalaDetailPeer::CA_UNIDAD_MEDIDA_PAQUETES)) $criteria->add(FalaDetailPeer::CA_UNIDAD_MEDIDA_PAQUETES, $this->ca_unidad_medida_paquetes);
		if ($this->isColumnModified(FalaDetailPeer::CA_CANTIDAD_VOLUMEN_MILES)) $criteria->add(FalaDetailPeer::CA_CANTIDAD_VOLUMEN_MILES, $this->ca_cantidad_volumen_miles);
		if ($this->isColumnModified(FalaDetailPeer::CA_UNIDAD_MEDIDA_VOLUMEN)) $criteria->add(FalaDetailPeer::CA_UNIDAD_MEDIDA_VOLUMEN, $this->ca_unidad_medida_volumen);
		if ($this->isColumnModified(FalaDetailPeer::CA_CANTIDAD_PESO_MILES)) $criteria->add(FalaDetailPeer::CA_CANTIDAD_PESO_MILES, $this->ca_cantidad_peso_miles);
		if ($this->isColumnModified(FalaDetailPeer::CA_UNIDAD_MEDIDA_PESO)) $criteria->add(FalaDetailPeer::CA_UNIDAD_MEDIDA_PESO, $this->ca_unidad_medida_peso);

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
		$criteria = new Criteria(FalaDetailPeer::DATABASE_NAME);

		$criteria->add(FalaDetailPeer::CA_IDDOC, $this->ca_iddoc);
		$criteria->add(FalaDetailPeer::CA_SKU, $this->ca_sku);

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

		$pks[0] = $this->getCaIddoc();

		$pks[1] = $this->getCaSku();

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

		$this->setCaIddoc($keys[0]);

		$this->setCaSku($keys[1]);

	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of FalaDetail (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaVpn($this->ca_vpn);

		$copyObj->setCaNumContPart1($this->ca_num_cont_part1);

		$copyObj->setCaNumContPart2($this->ca_num_cont_part2);

		$copyObj->setCaNumContSell($this->ca_num_cont_sell);

		$copyObj->setCaContainerIso($this->ca_container_iso);

		$copyObj->setCaCantidadPedido($this->ca_cantidad_pedido);

		$copyObj->setCaCantidadMiles($this->ca_cantidad_miles);

		$copyObj->setCaUnidadMedidadCantidad($this->ca_unidad_medidad_cantidad);

		$copyObj->setCaDescripcionItem($this->ca_descripcion_item);

		$copyObj->setCaCantidadPaquetesMiles($this->ca_cantidad_paquetes_miles);

		$copyObj->setCaUnidadMedidaPaquetes($this->ca_unidad_medida_paquetes);

		$copyObj->setCaCantidadVolumenMiles($this->ca_cantidad_volumen_miles);

		$copyObj->setCaUnidadMedidaVolumen($this->ca_unidad_medida_volumen);

		$copyObj->setCaCantidadPesoMiles($this->ca_cantidad_peso_miles);

		$copyObj->setCaUnidadMedidaPeso($this->ca_unidad_medida_peso);


		$copyObj->setNew(true);

		$copyObj->setCaIddoc(NULL); // this is a pkey column, so set to default value

		$copyObj->setCaSku(NULL); // this is a pkey column, so set to default value

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
	 * @return     FalaDetail Clone of current object.
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
	 * @return     FalaDetailPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new FalaDetailPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a FalaHeader object.
	 *
	 * @param      FalaHeader $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setFalaHeader($v)
	{


		if ($v === null) {
			$this->setCaIddoc(NULL);
		} else {
			$this->setCaIddoc($v->getCaIddoc());
		}


		$this->aFalaHeader = $v;
	}


	/**
	 * Get the associated FalaHeader object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     FalaHeader The associated FalaHeader object.
	 * @throws     PropelException
	 */
	public function getFalaHeader($con = null)
	{
		if ($this->aFalaHeader === null && (($this->ca_iddoc !== "" && $this->ca_iddoc !== null))) {
			// include the related Peer class
			$this->aFalaHeader = FalaHeaderPeer::retrieveByPK($this->ca_iddoc, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = FalaHeaderPeer::retrieveByPK($this->ca_iddoc, $con);
			   $obj->addFalaHeaders($this);
			 */
		}
		return $this->aFalaHeader;
	}

} // BaseFalaDetail
