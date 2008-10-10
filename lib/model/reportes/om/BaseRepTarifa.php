<?php

/**
 * Base class that represents a row from the 'tb_reptarifas' table.
 *
 * 
 *
 * @package    lib.model.reportes.om
 */
abstract class BaseRepTarifa extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        RepTarifaPeer
	 */
	protected static $peer;


	/**
	 * The value for the oid field.
	 * @var        int
	 */
	protected $oid;


	/**
	 * The value for the ca_idreporte field.
	 * @var        int
	 */
	protected $ca_idreporte;


	/**
	 * The value for the ca_idconcepto field.
	 * @var        int
	 */
	protected $ca_idconcepto;


	/**
	 * The value for the ca_cantidad field.
	 * @var        double
	 */
	protected $ca_cantidad;


	/**
	 * The value for the ca_neta_tar field.
	 * @var        double
	 */
	protected $ca_neta_tar;


	/**
	 * The value for the ca_neta_min field.
	 * @var        double
	 */
	protected $ca_neta_min;


	/**
	 * The value for the ca_neta_idm field.
	 * @var        string
	 */
	protected $ca_neta_idm;


	/**
	 * The value for the ca_reportar_tar field.
	 * @var        double
	 */
	protected $ca_reportar_tar;


	/**
	 * The value for the ca_reportar_min field.
	 * @var        double
	 */
	protected $ca_reportar_min;


	/**
	 * The value for the ca_reportar_idm field.
	 * @var        string
	 */
	protected $ca_reportar_idm;


	/**
	 * The value for the ca_cobrar_tar field.
	 * @var        double
	 */
	protected $ca_cobrar_tar;


	/**
	 * The value for the ca_cobrar_min field.
	 * @var        double
	 */
	protected $ca_cobrar_min;


	/**
	 * The value for the ca_cobrar_idm field.
	 * @var        string
	 */
	protected $ca_cobrar_idm;


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
	 * @var        Reporte
	 */
	protected $aReporte;

	/**
	 * @var        Concepto
	 */
	protected $aConcepto;

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
	 * Get the [ca_idreporte] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdreporte()
	{

		return $this->ca_idreporte;
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
	 * Get the [ca_cantidad] column value.
	 * 
	 * @return     double
	 */
	public function getCaCantidad()
	{

		return $this->ca_cantidad;
	}

	/**
	 * Get the [ca_neta_tar] column value.
	 * 
	 * @return     double
	 */
	public function getCaNetaTar()
	{

		return $this->ca_neta_tar;
	}

	/**
	 * Get the [ca_neta_min] column value.
	 * 
	 * @return     double
	 */
	public function getCaNetaMin()
	{

		return $this->ca_neta_min;
	}

	/**
	 * Get the [ca_neta_idm] column value.
	 * 
	 * @return     string
	 */
	public function getCaNetaIdm()
	{

		return $this->ca_neta_idm;
	}

	/**
	 * Get the [ca_reportar_tar] column value.
	 * 
	 * @return     double
	 */
	public function getCaReportarTar()
	{

		return $this->ca_reportar_tar;
	}

	/**
	 * Get the [ca_reportar_min] column value.
	 * 
	 * @return     double
	 */
	public function getCaReportarMin()
	{

		return $this->ca_reportar_min;
	}

	/**
	 * Get the [ca_reportar_idm] column value.
	 * 
	 * @return     string
	 */
	public function getCaReportarIdm()
	{

		return $this->ca_reportar_idm;
	}

	/**
	 * Get the [ca_cobrar_tar] column value.
	 * 
	 * @return     double
	 */
	public function getCaCobrarTar()
	{

		return $this->ca_cobrar_tar;
	}

	/**
	 * Get the [ca_cobrar_min] column value.
	 * 
	 * @return     double
	 */
	public function getCaCobrarMin()
	{

		return $this->ca_cobrar_min;
	}

	/**
	 * Get the [ca_cobrar_idm] column value.
	 * 
	 * @return     string
	 */
	public function getCaCobrarIdm()
	{

		return $this->ca_cobrar_idm;
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
	public function getCaFchcreado($format = 'Y-m-d')
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
	public function getCaFchactualizado($format = 'Y-m-d')
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
			$this->modifiedColumns[] = RepTarifaPeer::OID;
		}

	} // setOid()

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
			$this->modifiedColumns[] = RepTarifaPeer::CA_IDREPORTE;
		}

		if ($this->aReporte !== null && $this->aReporte->getCaIdreporte() !== $v) {
			$this->aReporte = null;
		}

	} // setCaIdreporte()

	/**
	 * Set the value of [ca_idconcepto] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdconcepto($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idconcepto !== $v) {
			$this->ca_idconcepto = $v;
			$this->modifiedColumns[] = RepTarifaPeer::CA_IDCONCEPTO;
		}

		if ($this->aConcepto !== null && $this->aConcepto->getCaIdconcepto() !== $v) {
			$this->aConcepto = null;
		}

	} // setCaIdconcepto()

	/**
	 * Set the value of [ca_cantidad] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaCantidad($v)
	{

		if ($this->ca_cantidad !== $v) {
			$this->ca_cantidad = $v;
			$this->modifiedColumns[] = RepTarifaPeer::CA_CANTIDAD;
		}

	} // setCaCantidad()

	/**
	 * Set the value of [ca_neta_tar] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaNetaTar($v)
	{

		if ($this->ca_neta_tar !== $v) {
			$this->ca_neta_tar = $v;
			$this->modifiedColumns[] = RepTarifaPeer::CA_NETA_TAR;
		}

	} // setCaNetaTar()

	/**
	 * Set the value of [ca_neta_min] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaNetaMin($v)
	{

		if ($this->ca_neta_min !== $v) {
			$this->ca_neta_min = $v;
			$this->modifiedColumns[] = RepTarifaPeer::CA_NETA_MIN;
		}

	} // setCaNetaMin()

	/**
	 * Set the value of [ca_neta_idm] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaNetaIdm($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_neta_idm !== $v) {
			$this->ca_neta_idm = $v;
			$this->modifiedColumns[] = RepTarifaPeer::CA_NETA_IDM;
		}

	} // setCaNetaIdm()

	/**
	 * Set the value of [ca_reportar_tar] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaReportarTar($v)
	{

		if ($this->ca_reportar_tar !== $v) {
			$this->ca_reportar_tar = $v;
			$this->modifiedColumns[] = RepTarifaPeer::CA_REPORTAR_TAR;
		}

	} // setCaReportarTar()

	/**
	 * Set the value of [ca_reportar_min] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaReportarMin($v)
	{

		if ($this->ca_reportar_min !== $v) {
			$this->ca_reportar_min = $v;
			$this->modifiedColumns[] = RepTarifaPeer::CA_REPORTAR_MIN;
		}

	} // setCaReportarMin()

	/**
	 * Set the value of [ca_reportar_idm] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaReportarIdm($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_reportar_idm !== $v) {
			$this->ca_reportar_idm = $v;
			$this->modifiedColumns[] = RepTarifaPeer::CA_REPORTAR_IDM;
		}

	} // setCaReportarIdm()

	/**
	 * Set the value of [ca_cobrar_tar] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaCobrarTar($v)
	{

		if ($this->ca_cobrar_tar !== $v) {
			$this->ca_cobrar_tar = $v;
			$this->modifiedColumns[] = RepTarifaPeer::CA_COBRAR_TAR;
		}

	} // setCaCobrarTar()

	/**
	 * Set the value of [ca_cobrar_min] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaCobrarMin($v)
	{

		if ($this->ca_cobrar_min !== $v) {
			$this->ca_cobrar_min = $v;
			$this->modifiedColumns[] = RepTarifaPeer::CA_COBRAR_MIN;
		}

	} // setCaCobrarMin()

	/**
	 * Set the value of [ca_cobrar_idm] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaCobrarIdm($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_cobrar_idm !== $v) {
			$this->ca_cobrar_idm = $v;
			$this->modifiedColumns[] = RepTarifaPeer::CA_COBRAR_IDM;
		}

	} // setCaCobrarIdm()

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
			$this->modifiedColumns[] = RepTarifaPeer::CA_OBSERVACIONES;
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
			$this->modifiedColumns[] = RepTarifaPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = RepTarifaPeer::CA_USUCREADO;
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
			$this->modifiedColumns[] = RepTarifaPeer::CA_FCHACTUALIZADO;
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
			$this->modifiedColumns[] = RepTarifaPeer::CA_USUACTUALIZADO;
		}

	} // setCaUsuactualizado()

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

			$this->ca_idreporte = $rs->getInt($startcol + 1);

			$this->ca_idconcepto = $rs->getInt($startcol + 2);

			$this->ca_cantidad = $rs->getFloat($startcol + 3);

			$this->ca_neta_tar = $rs->getFloat($startcol + 4);

			$this->ca_neta_min = $rs->getFloat($startcol + 5);

			$this->ca_neta_idm = $rs->getString($startcol + 6);

			$this->ca_reportar_tar = $rs->getFloat($startcol + 7);

			$this->ca_reportar_min = $rs->getFloat($startcol + 8);

			$this->ca_reportar_idm = $rs->getString($startcol + 9);

			$this->ca_cobrar_tar = $rs->getFloat($startcol + 10);

			$this->ca_cobrar_min = $rs->getFloat($startcol + 11);

			$this->ca_cobrar_idm = $rs->getString($startcol + 12);

			$this->ca_observaciones = $rs->getString($startcol + 13);

			$this->ca_fchcreado = $rs->getDate($startcol + 14, null);

			$this->ca_usucreado = $rs->getString($startcol + 15);

			$this->ca_fchactualizado = $rs->getDate($startcol + 16, null);

			$this->ca_usuactualizado = $rs->getString($startcol + 17);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 18; // 18 = RepTarifaPeer::NUM_COLUMNS - RepTarifaPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating RepTarifa object", $e);
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
			$con = Propel::getConnection(RepTarifaPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			RepTarifaPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(RepTarifaPeer::DATABASE_NAME);
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

			if ($this->aConcepto !== null) {
				if ($this->aConcepto->isModified()) {
					$affectedRows += $this->aConcepto->save($con);
				}
				$this->setConcepto($this->aConcepto);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = RepTarifaPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += RepTarifaPeer::doUpdate($this, $con);
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

			if ($this->aConcepto !== null) {
				if (!$this->aConcepto->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aConcepto->getValidationFailures());
				}
			}


			if (($retval = RepTarifaPeer::doValidate($this, $columns)) !== true) {
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
		$pos = RepTarifaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdreporte();
				break;
			case 2:
				return $this->getCaIdconcepto();
				break;
			case 3:
				return $this->getCaCantidad();
				break;
			case 4:
				return $this->getCaNetaTar();
				break;
			case 5:
				return $this->getCaNetaMin();
				break;
			case 6:
				return $this->getCaNetaIdm();
				break;
			case 7:
				return $this->getCaReportarTar();
				break;
			case 8:
				return $this->getCaReportarMin();
				break;
			case 9:
				return $this->getCaReportarIdm();
				break;
			case 10:
				return $this->getCaCobrarTar();
				break;
			case 11:
				return $this->getCaCobrarMin();
				break;
			case 12:
				return $this->getCaCobrarIdm();
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
		$keys = RepTarifaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getOid(),
			$keys[1] => $this->getCaIdreporte(),
			$keys[2] => $this->getCaIdconcepto(),
			$keys[3] => $this->getCaCantidad(),
			$keys[4] => $this->getCaNetaTar(),
			$keys[5] => $this->getCaNetaMin(),
			$keys[6] => $this->getCaNetaIdm(),
			$keys[7] => $this->getCaReportarTar(),
			$keys[8] => $this->getCaReportarMin(),
			$keys[9] => $this->getCaReportarIdm(),
			$keys[10] => $this->getCaCobrarTar(),
			$keys[11] => $this->getCaCobrarMin(),
			$keys[12] => $this->getCaCobrarIdm(),
			$keys[13] => $this->getCaObservaciones(),
			$keys[14] => $this->getCaFchcreado(),
			$keys[15] => $this->getCaUsucreado(),
			$keys[16] => $this->getCaFchactualizado(),
			$keys[17] => $this->getCaUsuactualizado(),
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
		$pos = RepTarifaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdreporte($value);
				break;
			case 2:
				$this->setCaIdconcepto($value);
				break;
			case 3:
				$this->setCaCantidad($value);
				break;
			case 4:
				$this->setCaNetaTar($value);
				break;
			case 5:
				$this->setCaNetaMin($value);
				break;
			case 6:
				$this->setCaNetaIdm($value);
				break;
			case 7:
				$this->setCaReportarTar($value);
				break;
			case 8:
				$this->setCaReportarMin($value);
				break;
			case 9:
				$this->setCaReportarIdm($value);
				break;
			case 10:
				$this->setCaCobrarTar($value);
				break;
			case 11:
				$this->setCaCobrarMin($value);
				break;
			case 12:
				$this->setCaCobrarIdm($value);
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
		$keys = RepTarifaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setOid($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdreporte($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaIdconcepto($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaCantidad($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaNetaTar($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaNetaMin($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaNetaIdm($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaReportarTar($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaReportarMin($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaReportarIdm($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaCobrarTar($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaCobrarMin($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaCobrarIdm($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaObservaciones($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaFchcreado($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaUsucreado($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCaFchactualizado($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setCaUsuactualizado($arr[$keys[17]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(RepTarifaPeer::DATABASE_NAME);

		if ($this->isColumnModified(RepTarifaPeer::OID)) $criteria->add(RepTarifaPeer::OID, $this->oid);
		if ($this->isColumnModified(RepTarifaPeer::CA_IDREPORTE)) $criteria->add(RepTarifaPeer::CA_IDREPORTE, $this->ca_idreporte);
		if ($this->isColumnModified(RepTarifaPeer::CA_IDCONCEPTO)) $criteria->add(RepTarifaPeer::CA_IDCONCEPTO, $this->ca_idconcepto);
		if ($this->isColumnModified(RepTarifaPeer::CA_CANTIDAD)) $criteria->add(RepTarifaPeer::CA_CANTIDAD, $this->ca_cantidad);
		if ($this->isColumnModified(RepTarifaPeer::CA_NETA_TAR)) $criteria->add(RepTarifaPeer::CA_NETA_TAR, $this->ca_neta_tar);
		if ($this->isColumnModified(RepTarifaPeer::CA_NETA_MIN)) $criteria->add(RepTarifaPeer::CA_NETA_MIN, $this->ca_neta_min);
		if ($this->isColumnModified(RepTarifaPeer::CA_NETA_IDM)) $criteria->add(RepTarifaPeer::CA_NETA_IDM, $this->ca_neta_idm);
		if ($this->isColumnModified(RepTarifaPeer::CA_REPORTAR_TAR)) $criteria->add(RepTarifaPeer::CA_REPORTAR_TAR, $this->ca_reportar_tar);
		if ($this->isColumnModified(RepTarifaPeer::CA_REPORTAR_MIN)) $criteria->add(RepTarifaPeer::CA_REPORTAR_MIN, $this->ca_reportar_min);
		if ($this->isColumnModified(RepTarifaPeer::CA_REPORTAR_IDM)) $criteria->add(RepTarifaPeer::CA_REPORTAR_IDM, $this->ca_reportar_idm);
		if ($this->isColumnModified(RepTarifaPeer::CA_COBRAR_TAR)) $criteria->add(RepTarifaPeer::CA_COBRAR_TAR, $this->ca_cobrar_tar);
		if ($this->isColumnModified(RepTarifaPeer::CA_COBRAR_MIN)) $criteria->add(RepTarifaPeer::CA_COBRAR_MIN, $this->ca_cobrar_min);
		if ($this->isColumnModified(RepTarifaPeer::CA_COBRAR_IDM)) $criteria->add(RepTarifaPeer::CA_COBRAR_IDM, $this->ca_cobrar_idm);
		if ($this->isColumnModified(RepTarifaPeer::CA_OBSERVACIONES)) $criteria->add(RepTarifaPeer::CA_OBSERVACIONES, $this->ca_observaciones);
		if ($this->isColumnModified(RepTarifaPeer::CA_FCHCREADO)) $criteria->add(RepTarifaPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(RepTarifaPeer::CA_USUCREADO)) $criteria->add(RepTarifaPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(RepTarifaPeer::CA_FCHACTUALIZADO)) $criteria->add(RepTarifaPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(RepTarifaPeer::CA_USUACTUALIZADO)) $criteria->add(RepTarifaPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);

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
		$criteria = new Criteria(RepTarifaPeer::DATABASE_NAME);

		$criteria->add(RepTarifaPeer::OID, $this->oid);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getOid();
	}

	/**
	 * Generic method to set the primary key (oid column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setOid($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of RepTarifa (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdreporte($this->ca_idreporte);

		$copyObj->setCaIdconcepto($this->ca_idconcepto);

		$copyObj->setCaCantidad($this->ca_cantidad);

		$copyObj->setCaNetaTar($this->ca_neta_tar);

		$copyObj->setCaNetaMin($this->ca_neta_min);

		$copyObj->setCaNetaIdm($this->ca_neta_idm);

		$copyObj->setCaReportarTar($this->ca_reportar_tar);

		$copyObj->setCaReportarMin($this->ca_reportar_min);

		$copyObj->setCaReportarIdm($this->ca_reportar_idm);

		$copyObj->setCaCobrarTar($this->ca_cobrar_tar);

		$copyObj->setCaCobrarMin($this->ca_cobrar_min);

		$copyObj->setCaCobrarIdm($this->ca_cobrar_idm);

		$copyObj->setCaObservaciones($this->ca_observaciones);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);


		$copyObj->setNew(true);

		$copyObj->setOid(NULL); // this is a pkey column, so set to default value

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
	 * @return     RepTarifa Clone of current object.
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
	 * @return     RepTarifaPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new RepTarifaPeer();
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
	 * Declares an association between this object and a Concepto object.
	 *
	 * @param      Concepto $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setConcepto($v)
	{


		if ($v === null) {
			$this->setCaIdconcepto(NULL);
		} else {
			$this->setCaIdconcepto($v->getCaIdconcepto());
		}


		$this->aConcepto = $v;
	}


	/**
	 * Get the associated Concepto object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Concepto The associated Concepto object.
	 * @throws     PropelException
	 */
	public function getConcepto($con = null)
	{
		if ($this->aConcepto === null && ($this->ca_idconcepto !== null)) {
			// include the related Peer class
			$this->aConcepto = ConceptoPeer::retrieveByPK($this->ca_idconcepto, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = ConceptoPeer::retrieveByPK($this->ca_idconcepto, $con);
			   $obj->addConceptos($this);
			 */
		}
		return $this->aConcepto;
	}

} // BaseRepTarifa
