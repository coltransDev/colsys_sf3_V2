<?php

/**
 * Base class that represents a row from the 'tb_repgastos' table.
 *
 * 
 *
 * @package    lib.model.reportes.om
 */
abstract class BaseRepGasto extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        RepGastoPeer
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
	 * The value for the ca_idrecargo field.
	 * @var        int
	 */
	protected $ca_idrecargo;


	/**
	 * The value for the ca_aplicacion field.
	 * @var        string
	 */
	protected $ca_aplicacion;


	/**
	 * The value for the ca_tipo field.
	 * @var        string
	 */
	protected $ca_tipo;


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
	 * The value for the ca_idmoneda field.
	 * @var        string
	 */
	protected $ca_idmoneda;


	/**
	 * The value for the ca_detalles field.
	 * @var        string
	 */
	protected $ca_detalles;


	/**
	 * The value for the ca_idconcepto field.
	 * @var        int
	 */
	protected $ca_idconcepto;

	/**
	 * @var        Reporte
	 */
	protected $aReporte;

	/**
	 * @var        Concepto
	 */
	protected $aConcepto;

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
	 * Get the [ca_idrecargo] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdrecargo()
	{

		return $this->ca_idrecargo;
	}

	/**
	 * Get the [ca_aplicacion] column value.
	 * 
	 * @return     string
	 */
	public function getCaAplicacion()
	{

		return $this->ca_aplicacion;
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
	 * Get the [ca_idmoneda] column value.
	 * 
	 * @return     string
	 */
	public function getCaIdmoneda()
	{

		return $this->ca_idmoneda;
	}

	/**
	 * Get the [ca_detalles] column value.
	 * 
	 * @return     string
	 */
	public function getCaDetalles()
	{

		return $this->ca_detalles;
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
			$this->modifiedColumns[] = RepGastoPeer::OID;
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
			$this->modifiedColumns[] = RepGastoPeer::CA_IDREPORTE;
		}

		if ($this->aReporte !== null && $this->aReporte->getCaIdreporte() !== $v) {
			$this->aReporte = null;
		}

	} // setCaIdreporte()

	/**
	 * Set the value of [ca_idrecargo] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdrecargo($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idrecargo !== $v) {
			$this->ca_idrecargo = $v;
			$this->modifiedColumns[] = RepGastoPeer::CA_IDRECARGO;
		}

		if ($this->aTipoRecargo !== null && $this->aTipoRecargo->getCaIdrecargo() !== $v) {
			$this->aTipoRecargo = null;
		}

	} // setCaIdrecargo()

	/**
	 * Set the value of [ca_aplicacion] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaAplicacion($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_aplicacion !== $v) {
			$this->ca_aplicacion = $v;
			$this->modifiedColumns[] = RepGastoPeer::CA_APLICACION;
		}

	} // setCaAplicacion()

	/**
	 * Set the value of [ca_tipo] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaTipo($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_tipo !== $v) {
			$this->ca_tipo = $v;
			$this->modifiedColumns[] = RepGastoPeer::CA_TIPO;
		}

	} // setCaTipo()

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
			$this->modifiedColumns[] = RepGastoPeer::CA_NETA_TAR;
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
			$this->modifiedColumns[] = RepGastoPeer::CA_NETA_MIN;
		}

	} // setCaNetaMin()

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
			$this->modifiedColumns[] = RepGastoPeer::CA_REPORTAR_TAR;
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
			$this->modifiedColumns[] = RepGastoPeer::CA_REPORTAR_MIN;
		}

	} // setCaReportarMin()

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
			$this->modifiedColumns[] = RepGastoPeer::CA_COBRAR_TAR;
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
			$this->modifiedColumns[] = RepGastoPeer::CA_COBRAR_MIN;
		}

	} // setCaCobrarMin()

	/**
	 * Set the value of [ca_idmoneda] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaIdmoneda($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_idmoneda !== $v) {
			$this->ca_idmoneda = $v;
			$this->modifiedColumns[] = RepGastoPeer::CA_IDMONEDA;
		}

	} // setCaIdmoneda()

	/**
	 * Set the value of [ca_detalles] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaDetalles($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_detalles !== $v) {
			$this->ca_detalles = $v;
			$this->modifiedColumns[] = RepGastoPeer::CA_DETALLES;
		}

	} // setCaDetalles()

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
			$this->modifiedColumns[] = RepGastoPeer::CA_IDCONCEPTO;
		}

		if ($this->aConcepto !== null && $this->aConcepto->getCaIdconcepto() !== $v) {
			$this->aConcepto = null;
		}

	} // setCaIdconcepto()

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

			$this->ca_idrecargo = $rs->getInt($startcol + 2);

			$this->ca_aplicacion = $rs->getString($startcol + 3);

			$this->ca_tipo = $rs->getString($startcol + 4);

			$this->ca_neta_tar = $rs->getFloat($startcol + 5);

			$this->ca_neta_min = $rs->getFloat($startcol + 6);

			$this->ca_reportar_tar = $rs->getFloat($startcol + 7);

			$this->ca_reportar_min = $rs->getFloat($startcol + 8);

			$this->ca_cobrar_tar = $rs->getFloat($startcol + 9);

			$this->ca_cobrar_min = $rs->getFloat($startcol + 10);

			$this->ca_idmoneda = $rs->getString($startcol + 11);

			$this->ca_detalles = $rs->getString($startcol + 12);

			$this->ca_idconcepto = $rs->getInt($startcol + 13);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 14; // 14 = RepGastoPeer::NUM_COLUMNS - RepGastoPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating RepGasto object", $e);
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
			$con = Propel::getConnection(RepGastoPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			RepGastoPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(RepGastoPeer::DATABASE_NAME);
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

			if ($this->aTipoRecargo !== null) {
				if ($this->aTipoRecargo->isModified()) {
					$affectedRows += $this->aTipoRecargo->save($con);
				}
				$this->setTipoRecargo($this->aTipoRecargo);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = RepGastoPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += RepGastoPeer::doUpdate($this, $con);
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

			if ($this->aTipoRecargo !== null) {
				if (!$this->aTipoRecargo->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTipoRecargo->getValidationFailures());
				}
			}


			if (($retval = RepGastoPeer::doValidate($this, $columns)) !== true) {
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
		$pos = RepGastoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdrecargo();
				break;
			case 3:
				return $this->getCaAplicacion();
				break;
			case 4:
				return $this->getCaTipo();
				break;
			case 5:
				return $this->getCaNetaTar();
				break;
			case 6:
				return $this->getCaNetaMin();
				break;
			case 7:
				return $this->getCaReportarTar();
				break;
			case 8:
				return $this->getCaReportarMin();
				break;
			case 9:
				return $this->getCaCobrarTar();
				break;
			case 10:
				return $this->getCaCobrarMin();
				break;
			case 11:
				return $this->getCaIdmoneda();
				break;
			case 12:
				return $this->getCaDetalles();
				break;
			case 13:
				return $this->getCaIdconcepto();
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
		$keys = RepGastoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getOid(),
			$keys[1] => $this->getCaIdreporte(),
			$keys[2] => $this->getCaIdrecargo(),
			$keys[3] => $this->getCaAplicacion(),
			$keys[4] => $this->getCaTipo(),
			$keys[5] => $this->getCaNetaTar(),
			$keys[6] => $this->getCaNetaMin(),
			$keys[7] => $this->getCaReportarTar(),
			$keys[8] => $this->getCaReportarMin(),
			$keys[9] => $this->getCaCobrarTar(),
			$keys[10] => $this->getCaCobrarMin(),
			$keys[11] => $this->getCaIdmoneda(),
			$keys[12] => $this->getCaDetalles(),
			$keys[13] => $this->getCaIdconcepto(),
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
		$pos = RepGastoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdrecargo($value);
				break;
			case 3:
				$this->setCaAplicacion($value);
				break;
			case 4:
				$this->setCaTipo($value);
				break;
			case 5:
				$this->setCaNetaTar($value);
				break;
			case 6:
				$this->setCaNetaMin($value);
				break;
			case 7:
				$this->setCaReportarTar($value);
				break;
			case 8:
				$this->setCaReportarMin($value);
				break;
			case 9:
				$this->setCaCobrarTar($value);
				break;
			case 10:
				$this->setCaCobrarMin($value);
				break;
			case 11:
				$this->setCaIdmoneda($value);
				break;
			case 12:
				$this->setCaDetalles($value);
				break;
			case 13:
				$this->setCaIdconcepto($value);
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
		$keys = RepGastoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setOid($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdreporte($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaIdrecargo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaAplicacion($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaTipo($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaNetaTar($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaNetaMin($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaReportarTar($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaReportarMin($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaCobrarTar($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaCobrarMin($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaIdmoneda($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaDetalles($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaIdconcepto($arr[$keys[13]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(RepGastoPeer::DATABASE_NAME);

		if ($this->isColumnModified(RepGastoPeer::OID)) $criteria->add(RepGastoPeer::OID, $this->oid);
		if ($this->isColumnModified(RepGastoPeer::CA_IDREPORTE)) $criteria->add(RepGastoPeer::CA_IDREPORTE, $this->ca_idreporte);
		if ($this->isColumnModified(RepGastoPeer::CA_IDRECARGO)) $criteria->add(RepGastoPeer::CA_IDRECARGO, $this->ca_idrecargo);
		if ($this->isColumnModified(RepGastoPeer::CA_APLICACION)) $criteria->add(RepGastoPeer::CA_APLICACION, $this->ca_aplicacion);
		if ($this->isColumnModified(RepGastoPeer::CA_TIPO)) $criteria->add(RepGastoPeer::CA_TIPO, $this->ca_tipo);
		if ($this->isColumnModified(RepGastoPeer::CA_NETA_TAR)) $criteria->add(RepGastoPeer::CA_NETA_TAR, $this->ca_neta_tar);
		if ($this->isColumnModified(RepGastoPeer::CA_NETA_MIN)) $criteria->add(RepGastoPeer::CA_NETA_MIN, $this->ca_neta_min);
		if ($this->isColumnModified(RepGastoPeer::CA_REPORTAR_TAR)) $criteria->add(RepGastoPeer::CA_REPORTAR_TAR, $this->ca_reportar_tar);
		if ($this->isColumnModified(RepGastoPeer::CA_REPORTAR_MIN)) $criteria->add(RepGastoPeer::CA_REPORTAR_MIN, $this->ca_reportar_min);
		if ($this->isColumnModified(RepGastoPeer::CA_COBRAR_TAR)) $criteria->add(RepGastoPeer::CA_COBRAR_TAR, $this->ca_cobrar_tar);
		if ($this->isColumnModified(RepGastoPeer::CA_COBRAR_MIN)) $criteria->add(RepGastoPeer::CA_COBRAR_MIN, $this->ca_cobrar_min);
		if ($this->isColumnModified(RepGastoPeer::CA_IDMONEDA)) $criteria->add(RepGastoPeer::CA_IDMONEDA, $this->ca_idmoneda);
		if ($this->isColumnModified(RepGastoPeer::CA_DETALLES)) $criteria->add(RepGastoPeer::CA_DETALLES, $this->ca_detalles);
		if ($this->isColumnModified(RepGastoPeer::CA_IDCONCEPTO)) $criteria->add(RepGastoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

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
		$criteria = new Criteria(RepGastoPeer::DATABASE_NAME);

		$criteria->add(RepGastoPeer::OID, $this->oid);

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
	 * @param      object $copyObj An object of RepGasto (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdreporte($this->ca_idreporte);

		$copyObj->setCaIdrecargo($this->ca_idrecargo);

		$copyObj->setCaAplicacion($this->ca_aplicacion);

		$copyObj->setCaTipo($this->ca_tipo);

		$copyObj->setCaNetaTar($this->ca_neta_tar);

		$copyObj->setCaNetaMin($this->ca_neta_min);

		$copyObj->setCaReportarTar($this->ca_reportar_tar);

		$copyObj->setCaReportarMin($this->ca_reportar_min);

		$copyObj->setCaCobrarTar($this->ca_cobrar_tar);

		$copyObj->setCaCobrarMin($this->ca_cobrar_min);

		$copyObj->setCaIdmoneda($this->ca_idmoneda);

		$copyObj->setCaDetalles($this->ca_detalles);

		$copyObj->setCaIdconcepto($this->ca_idconcepto);


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
	 * @return     RepGasto Clone of current object.
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
	 * @return     RepGastoPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new RepGastoPeer();
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

	/**
	 * Declares an association between this object and a TipoRecargo object.
	 *
	 * @param      TipoRecargo $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setTipoRecargo($v)
	{


		if ($v === null) {
			$this->setCaIdrecargo(NULL);
		} else {
			$this->setCaIdrecargo($v->getCaIdrecargo());
		}


		$this->aTipoRecargo = $v;
	}


	/**
	 * Get the associated TipoRecargo object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     TipoRecargo The associated TipoRecargo object.
	 * @throws     PropelException
	 */
	public function getTipoRecargo($con = null)
	{
		if ($this->aTipoRecargo === null && ($this->ca_idrecargo !== null)) {
			// include the related Peer class
			$this->aTipoRecargo = TipoRecargoPeer::retrieveByPK($this->ca_idrecargo, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = TipoRecargoPeer::retrieveByPK($this->ca_idrecargo, $con);
			   $obj->addTipoRecargos($this);
			 */
		}
		return $this->aTipoRecargo;
	}

} // BaseRepGasto
