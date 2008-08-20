<?php

/**
 * Base class that represents a row from the 'tb_repexpo' table.
 *
 * 
 *
 * @package    lib.model.reportes.om
 */
abstract class BaseRepExpo extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        RepExpoPeer
	 */
	protected static $peer;


	/**
	 * The value for the ca_idreporte field.
	 * @var        int
	 */
	protected $ca_idreporte;


	/**
	 * The value for the ca_peso field.
	 * @var        double
	 */
	protected $ca_peso;


	/**
	 * The value for the ca_volumen field.
	 * @var        double
	 */
	protected $ca_volumen;


	/**
	 * The value for the ca_piezas field.
	 * @var        string
	 */
	protected $ca_piezas;


	/**
	 * The value for the ca_dimensiones field.
	 * @var        string
	 */
	protected $ca_dimensiones;


	/**
	 * The value for the ca_valorcarga field.
	 * @var        double
	 */
	protected $ca_valorcarga;


	/**
	 * The value for the ca_anticipo field.
	 * @var        string
	 */
	protected $ca_anticipo;


	/**
	 * The value for the ca_idsia field.
	 * @var        int
	 */
	protected $ca_idsia;


	/**
	 * The value for the ca_tipoexpo field.
	 * @var        int
	 */
	protected $ca_tipoexpo;


	/**
	 * The value for the ca_idlineaterrestre field.
	 * @var        int
	 */
	protected $ca_idlineaterrestre;


	/**
	 * The value for the ca_motonave field.
	 * @var        string
	 */
	protected $ca_motonave;


	/**
	 * The value for the ca_emisionbl field.
	 * @var        string
	 */
	protected $ca_emisionbl;


	/**
	 * The value for the ca_datosbl field.
	 * @var        string
	 */
	protected $ca_datosbl;


	/**
	 * The value for the ca_numbl field.
	 * @var        int
	 */
	protected $ca_numbl;

	/**
	 * @var        Reporte
	 */
	protected $aReporte;

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
	 * Get the [ca_idreporte] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdreporte()
	{

		return $this->ca_idreporte;
	}

	/**
	 * Get the [ca_peso] column value.
	 * 
	 * @return     double
	 */
	public function getCaPeso()
	{

		return $this->ca_peso;
	}

	/**
	 * Get the [ca_volumen] column value.
	 * 
	 * @return     double
	 */
	public function getCaVolumen()
	{

		return $this->ca_volumen;
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
	 * Get the [ca_dimensiones] column value.
	 * 
	 * @return     string
	 */
	public function getCaDimensiones()
	{

		return $this->ca_dimensiones;
	}

	/**
	 * Get the [ca_valorcarga] column value.
	 * 
	 * @return     double
	 */
	public function getCaValorcarga()
	{

		return $this->ca_valorcarga;
	}

	/**
	 * Get the [ca_anticipo] column value.
	 * 
	 * @return     string
	 */
	public function getCaAnticipo()
	{

		return $this->ca_anticipo;
	}

	/**
	 * Get the [ca_idsia] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdsia()
	{

		return $this->ca_idsia;
	}

	/**
	 * Get the [ca_tipoexpo] column value.
	 * 
	 * @return     int
	 */
	public function getCaTipoexpo()
	{

		return $this->ca_tipoexpo;
	}

	/**
	 * Get the [ca_idlineaterrestre] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdlineaterrestre()
	{

		return $this->ca_idlineaterrestre;
	}

	/**
	 * Get the [ca_motonave] column value.
	 * 
	 * @return     string
	 */
	public function getCaMotonave()
	{

		return $this->ca_motonave;
	}

	/**
	 * Get the [ca_emisionbl] column value.
	 * 
	 * @return     string
	 */
	public function getCaEmisionbl()
	{

		return $this->ca_emisionbl;
	}

	/**
	 * Get the [ca_datosbl] column value.
	 * 
	 * @return     string
	 */
	public function getCaDatosbl()
	{

		return $this->ca_datosbl;
	}

	/**
	 * Get the [ca_numbl] column value.
	 * 
	 * @return     int
	 */
	public function getCaNumbl()
	{

		return $this->ca_numbl;
	}

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
			$this->modifiedColumns[] = RepExpoPeer::CA_IDREPORTE;
		}

		if ($this->aReporte !== null && $this->aReporte->getCaIdreporte() !== $v) {
			$this->aReporte = null;
		}

	} // setCaIdreporte()

	/**
	 * Set the value of [ca_peso] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaPeso($v)
	{

		if ($this->ca_peso !== $v) {
			$this->ca_peso = $v;
			$this->modifiedColumns[] = RepExpoPeer::CA_PESO;
		}

	} // setCaPeso()

	/**
	 * Set the value of [ca_volumen] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaVolumen($v)
	{

		if ($this->ca_volumen !== $v) {
			$this->ca_volumen = $v;
			$this->modifiedColumns[] = RepExpoPeer::CA_VOLUMEN;
		}

	} // setCaVolumen()

	/**
	 * Set the value of [ca_piezas] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaPiezas($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_piezas !== $v) {
			$this->ca_piezas = $v;
			$this->modifiedColumns[] = RepExpoPeer::CA_PIEZAS;
		}

	} // setCaPiezas()

	/**
	 * Set the value of [ca_dimensiones] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaDimensiones($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_dimensiones !== $v) {
			$this->ca_dimensiones = $v;
			$this->modifiedColumns[] = RepExpoPeer::CA_DIMENSIONES;
		}

	} // setCaDimensiones()

	/**
	 * Set the value of [ca_valorcarga] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaValorcarga($v)
	{

		if ($this->ca_valorcarga !== $v) {
			$this->ca_valorcarga = $v;
			$this->modifiedColumns[] = RepExpoPeer::CA_VALORCARGA;
		}

	} // setCaValorcarga()

	/**
	 * Set the value of [ca_anticipo] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaAnticipo($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_anticipo !== $v) {
			$this->ca_anticipo = $v;
			$this->modifiedColumns[] = RepExpoPeer::CA_ANTICIPO;
		}

	} // setCaAnticipo()

	/**
	 * Set the value of [ca_idsia] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdsia($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idsia !== $v) {
			$this->ca_idsia = $v;
			$this->modifiedColumns[] = RepExpoPeer::CA_IDSIA;
		}

	} // setCaIdsia()

	/**
	 * Set the value of [ca_tipoexpo] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaTipoexpo($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_tipoexpo !== $v) {
			$this->ca_tipoexpo = $v;
			$this->modifiedColumns[] = RepExpoPeer::CA_TIPOEXPO;
		}

	} // setCaTipoexpo()

	/**
	 * Set the value of [ca_idlineaterrestre] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdlineaterrestre($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idlineaterrestre !== $v) {
			$this->ca_idlineaterrestre = $v;
			$this->modifiedColumns[] = RepExpoPeer::CA_IDLINEATERRESTRE;
		}

	} // setCaIdlineaterrestre()

	/**
	 * Set the value of [ca_motonave] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaMotonave($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_motonave !== $v) {
			$this->ca_motonave = $v;
			$this->modifiedColumns[] = RepExpoPeer::CA_MOTONAVE;
		}

	} // setCaMotonave()

	/**
	 * Set the value of [ca_emisionbl] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaEmisionbl($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_emisionbl !== $v) {
			$this->ca_emisionbl = $v;
			$this->modifiedColumns[] = RepExpoPeer::CA_EMISIONBL;
		}

	} // setCaEmisionbl()

	/**
	 * Set the value of [ca_datosbl] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaDatosbl($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_datosbl !== $v) {
			$this->ca_datosbl = $v;
			$this->modifiedColumns[] = RepExpoPeer::CA_DATOSBL;
		}

	} // setCaDatosbl()

	/**
	 * Set the value of [ca_numbl] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaNumbl($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_numbl !== $v) {
			$this->ca_numbl = $v;
			$this->modifiedColumns[] = RepExpoPeer::CA_NUMBL;
		}

	} // setCaNumbl()

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

			$this->ca_idreporte = $rs->getInt($startcol + 0);

			$this->ca_peso = $rs->getFloat($startcol + 1);

			$this->ca_volumen = $rs->getFloat($startcol + 2);

			$this->ca_piezas = $rs->getString($startcol + 3);

			$this->ca_dimensiones = $rs->getString($startcol + 4);

			$this->ca_valorcarga = $rs->getFloat($startcol + 5);

			$this->ca_anticipo = $rs->getString($startcol + 6);

			$this->ca_idsia = $rs->getInt($startcol + 7);

			$this->ca_tipoexpo = $rs->getInt($startcol + 8);

			$this->ca_idlineaterrestre = $rs->getInt($startcol + 9);

			$this->ca_motonave = $rs->getString($startcol + 10);

			$this->ca_emisionbl = $rs->getString($startcol + 11);

			$this->ca_datosbl = $rs->getString($startcol + 12);

			$this->ca_numbl = $rs->getInt($startcol + 13);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 14; // 14 = RepExpoPeer::NUM_COLUMNS - RepExpoPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating RepExpo object", $e);
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
			$con = Propel::getConnection(RepExpoPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			RepExpoPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(RepExpoPeer::DATABASE_NAME);
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


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = RepExpoPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += RepExpoPeer::doUpdate($this, $con);
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


			if (($retval = RepExpoPeer::doValidate($this, $columns)) !== true) {
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
		$pos = RepExpoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdreporte();
				break;
			case 1:
				return $this->getCaPeso();
				break;
			case 2:
				return $this->getCaVolumen();
				break;
			case 3:
				return $this->getCaPiezas();
				break;
			case 4:
				return $this->getCaDimensiones();
				break;
			case 5:
				return $this->getCaValorcarga();
				break;
			case 6:
				return $this->getCaAnticipo();
				break;
			case 7:
				return $this->getCaIdsia();
				break;
			case 8:
				return $this->getCaTipoexpo();
				break;
			case 9:
				return $this->getCaIdlineaterrestre();
				break;
			case 10:
				return $this->getCaMotonave();
				break;
			case 11:
				return $this->getCaEmisionbl();
				break;
			case 12:
				return $this->getCaDatosbl();
				break;
			case 13:
				return $this->getCaNumbl();
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
		$keys = RepExpoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdreporte(),
			$keys[1] => $this->getCaPeso(),
			$keys[2] => $this->getCaVolumen(),
			$keys[3] => $this->getCaPiezas(),
			$keys[4] => $this->getCaDimensiones(),
			$keys[5] => $this->getCaValorcarga(),
			$keys[6] => $this->getCaAnticipo(),
			$keys[7] => $this->getCaIdsia(),
			$keys[8] => $this->getCaTipoexpo(),
			$keys[9] => $this->getCaIdlineaterrestre(),
			$keys[10] => $this->getCaMotonave(),
			$keys[11] => $this->getCaEmisionbl(),
			$keys[12] => $this->getCaDatosbl(),
			$keys[13] => $this->getCaNumbl(),
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
		$pos = RepExpoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaPeso($value);
				break;
			case 2:
				$this->setCaVolumen($value);
				break;
			case 3:
				$this->setCaPiezas($value);
				break;
			case 4:
				$this->setCaDimensiones($value);
				break;
			case 5:
				$this->setCaValorcarga($value);
				break;
			case 6:
				$this->setCaAnticipo($value);
				break;
			case 7:
				$this->setCaIdsia($value);
				break;
			case 8:
				$this->setCaTipoexpo($value);
				break;
			case 9:
				$this->setCaIdlineaterrestre($value);
				break;
			case 10:
				$this->setCaMotonave($value);
				break;
			case 11:
				$this->setCaEmisionbl($value);
				break;
			case 12:
				$this->setCaDatosbl($value);
				break;
			case 13:
				$this->setCaNumbl($value);
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
		$keys = RepExpoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdreporte($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaPeso($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaVolumen($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaPiezas($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaDimensiones($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaValorcarga($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaAnticipo($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaIdsia($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaTipoexpo($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaIdlineaterrestre($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaMotonave($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaEmisionbl($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaDatosbl($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaNumbl($arr[$keys[13]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(RepExpoPeer::DATABASE_NAME);

		if ($this->isColumnModified(RepExpoPeer::CA_IDREPORTE)) $criteria->add(RepExpoPeer::CA_IDREPORTE, $this->ca_idreporte);
		if ($this->isColumnModified(RepExpoPeer::CA_PESO)) $criteria->add(RepExpoPeer::CA_PESO, $this->ca_peso);
		if ($this->isColumnModified(RepExpoPeer::CA_VOLUMEN)) $criteria->add(RepExpoPeer::CA_VOLUMEN, $this->ca_volumen);
		if ($this->isColumnModified(RepExpoPeer::CA_PIEZAS)) $criteria->add(RepExpoPeer::CA_PIEZAS, $this->ca_piezas);
		if ($this->isColumnModified(RepExpoPeer::CA_DIMENSIONES)) $criteria->add(RepExpoPeer::CA_DIMENSIONES, $this->ca_dimensiones);
		if ($this->isColumnModified(RepExpoPeer::CA_VALORCARGA)) $criteria->add(RepExpoPeer::CA_VALORCARGA, $this->ca_valorcarga);
		if ($this->isColumnModified(RepExpoPeer::CA_ANTICIPO)) $criteria->add(RepExpoPeer::CA_ANTICIPO, $this->ca_anticipo);
		if ($this->isColumnModified(RepExpoPeer::CA_IDSIA)) $criteria->add(RepExpoPeer::CA_IDSIA, $this->ca_idsia);
		if ($this->isColumnModified(RepExpoPeer::CA_TIPOEXPO)) $criteria->add(RepExpoPeer::CA_TIPOEXPO, $this->ca_tipoexpo);
		if ($this->isColumnModified(RepExpoPeer::CA_IDLINEATERRESTRE)) $criteria->add(RepExpoPeer::CA_IDLINEATERRESTRE, $this->ca_idlineaterrestre);
		if ($this->isColumnModified(RepExpoPeer::CA_MOTONAVE)) $criteria->add(RepExpoPeer::CA_MOTONAVE, $this->ca_motonave);
		if ($this->isColumnModified(RepExpoPeer::CA_EMISIONBL)) $criteria->add(RepExpoPeer::CA_EMISIONBL, $this->ca_emisionbl);
		if ($this->isColumnModified(RepExpoPeer::CA_DATOSBL)) $criteria->add(RepExpoPeer::CA_DATOSBL, $this->ca_datosbl);
		if ($this->isColumnModified(RepExpoPeer::CA_NUMBL)) $criteria->add(RepExpoPeer::CA_NUMBL, $this->ca_numbl);

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
		$criteria = new Criteria(RepExpoPeer::DATABASE_NAME);

		$criteria->add(RepExpoPeer::CA_IDREPORTE, $this->ca_idreporte);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdreporte();
	}

	/**
	 * Generic method to set the primary key (ca_idreporte column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdreporte($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of RepExpo (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaPeso($this->ca_peso);

		$copyObj->setCaVolumen($this->ca_volumen);

		$copyObj->setCaPiezas($this->ca_piezas);

		$copyObj->setCaDimensiones($this->ca_dimensiones);

		$copyObj->setCaValorcarga($this->ca_valorcarga);

		$copyObj->setCaAnticipo($this->ca_anticipo);

		$copyObj->setCaIdsia($this->ca_idsia);

		$copyObj->setCaTipoexpo($this->ca_tipoexpo);

		$copyObj->setCaIdlineaterrestre($this->ca_idlineaterrestre);

		$copyObj->setCaMotonave($this->ca_motonave);

		$copyObj->setCaEmisionbl($this->ca_emisionbl);

		$copyObj->setCaDatosbl($this->ca_datosbl);

		$copyObj->setCaNumbl($this->ca_numbl);


		$copyObj->setNew(true);

		$copyObj->setCaIdreporte(NULL); // this is a pkey column, so set to default value

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
	 * @return     RepExpo Clone of current object.
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
	 * @return     RepExpoPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new RepExpoPeer();
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

} // BaseRepExpo
