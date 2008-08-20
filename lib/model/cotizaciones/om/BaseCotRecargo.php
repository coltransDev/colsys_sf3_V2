<?php

/**
 * Base class that represents a row from the 'tb_cotrecargos' table.
 *
 * 
 *
 * @package    lib.model.cotizaciones.om
 */
abstract class BaseCotRecargo extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        CotRecargoPeer
	 */
	protected static $peer;


	/**
	 * The value for the ca_idopcion field.
	 * @var        int
	 */
	protected $ca_idopcion;


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
	 * @var        double
	 */
	protected $ca_valor_tar;


	/**
	 * The value for the ca_aplica_tar field.
	 * @var        string
	 */
	protected $ca_aplica_tar;


	/**
	 * The value for the ca_valor_min field.
	 * @var        double
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
	 * Get the [ca_idopcion] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdopcion()
	{

		return $this->ca_idopcion;
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
	 * @return     double
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
	 * @return     double
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
	 * Set the value of [ca_idopcion] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdopcion($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idopcion !== $v) {
			$this->ca_idopcion = $v;
			$this->modifiedColumns[] = CotRecargoPeer::CA_IDOPCION;
		}

		if ($this->aCotOpcion !== null && $this->aCotOpcion->getCaIdopcion() !== $v) {
			$this->aCotOpcion = null;
		}

	} // setCaIdopcion()

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
			$this->modifiedColumns[] = CotRecargoPeer::CA_IDRECARGO;
		}

		if ($this->aTipoRecargo !== null && $this->aTipoRecargo->getCaIdrecargo() !== $v) {
			$this->aTipoRecargo = null;
		}

	} // setCaIdrecargo()

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
			$this->modifiedColumns[] = CotRecargoPeer::CA_TIPO;
		}

	} // setCaTipo()

	/**
	 * Set the value of [ca_valor_tar] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaValorTar($v)
	{

		if ($this->ca_valor_tar !== $v) {
			$this->ca_valor_tar = $v;
			$this->modifiedColumns[] = CotRecargoPeer::CA_VALOR_TAR;
		}

	} // setCaValorTar()

	/**
	 * Set the value of [ca_aplica_tar] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaAplicaTar($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_aplica_tar !== $v) {
			$this->ca_aplica_tar = $v;
			$this->modifiedColumns[] = CotRecargoPeer::CA_APLICA_TAR;
		}

	} // setCaAplicaTar()

	/**
	 * Set the value of [ca_valor_min] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaValorMin($v)
	{

		if ($this->ca_valor_min !== $v) {
			$this->ca_valor_min = $v;
			$this->modifiedColumns[] = CotRecargoPeer::CA_VALOR_MIN;
		}

	} // setCaValorMin()

	/**
	 * Set the value of [ca_aplica_min] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaAplicaMin($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_aplica_min !== $v) {
			$this->ca_aplica_min = $v;
			$this->modifiedColumns[] = CotRecargoPeer::CA_APLICA_MIN;
		}

	} // setCaAplicaMin()

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
			$this->modifiedColumns[] = CotRecargoPeer::CA_IDMONEDA;
		}

	} // setCaIdmoneda()

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
			$this->modifiedColumns[] = CotRecargoPeer::CA_MODALIDAD;
		}

	} // setCaModalidad()

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
			$this->modifiedColumns[] = CotRecargoPeer::CA_OBSERVACIONES;
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
			$this->modifiedColumns[] = CotRecargoPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = CotRecargoPeer::CA_USUCREADO;
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
			$this->modifiedColumns[] = CotRecargoPeer::CA_FCHACTUALIZADO;
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
			$this->modifiedColumns[] = CotRecargoPeer::CA_USUACTUALIZADO;
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

			$this->ca_idopcion = $rs->getInt($startcol + 0);

			$this->ca_idrecargo = $rs->getInt($startcol + 1);

			$this->ca_tipo = $rs->getString($startcol + 2);

			$this->ca_valor_tar = $rs->getFloat($startcol + 3);

			$this->ca_aplica_tar = $rs->getString($startcol + 4);

			$this->ca_valor_min = $rs->getFloat($startcol + 5);

			$this->ca_aplica_min = $rs->getString($startcol + 6);

			$this->ca_idmoneda = $rs->getString($startcol + 7);

			$this->ca_modalidad = $rs->getString($startcol + 8);

			$this->ca_observaciones = $rs->getString($startcol + 9);

			$this->ca_fchcreado = $rs->getTimestamp($startcol + 10, null);

			$this->ca_usucreado = $rs->getString($startcol + 11);

			$this->ca_fchactualizado = $rs->getTimestamp($startcol + 12, null);

			$this->ca_usuactualizado = $rs->getString($startcol + 13);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 14; // 14 = CotRecargoPeer::NUM_COLUMNS - CotRecargoPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating CotRecargo object", $e);
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
			$con = Propel::getConnection(CotRecargoPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			CotRecargoPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(CotRecargoPeer::DATABASE_NAME);
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

			if ($this->aCotOpcion !== null) {
				if ($this->aCotOpcion->isModified()) {
					$affectedRows += $this->aCotOpcion->save($con);
				}
				$this->setCotOpcion($this->aCotOpcion);
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
	 *                     one of the class type constants TYPE_PHPNAME,
	 *                     TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CotRecargoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdopcion();
				break;
			case 1:
				return $this->getCaIdrecargo();
				break;
			case 2:
				return $this->getCaTipo();
				break;
			case 3:
				return $this->getCaValorTar();
				break;
			case 4:
				return $this->getCaAplicaTar();
				break;
			case 5:
				return $this->getCaValorMin();
				break;
			case 6:
				return $this->getCaAplicaMin();
				break;
			case 7:
				return $this->getCaIdmoneda();
				break;
			case 8:
				return $this->getCaModalidad();
				break;
			case 9:
				return $this->getCaObservaciones();
				break;
			case 10:
				return $this->getCaFchcreado();
				break;
			case 11:
				return $this->getCaUsucreado();
				break;
			case 12:
				return $this->getCaFchactualizado();
				break;
			case 13:
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
		$keys = CotRecargoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdopcion(),
			$keys[1] => $this->getCaIdrecargo(),
			$keys[2] => $this->getCaTipo(),
			$keys[3] => $this->getCaValorTar(),
			$keys[4] => $this->getCaAplicaTar(),
			$keys[5] => $this->getCaValorMin(),
			$keys[6] => $this->getCaAplicaMin(),
			$keys[7] => $this->getCaIdmoneda(),
			$keys[8] => $this->getCaModalidad(),
			$keys[9] => $this->getCaObservaciones(),
			$keys[10] => $this->getCaFchcreado(),
			$keys[11] => $this->getCaUsucreado(),
			$keys[12] => $this->getCaFchactualizado(),
			$keys[13] => $this->getCaUsuactualizado(),
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
				$this->setCaIdopcion($value);
				break;
			case 1:
				$this->setCaIdrecargo($value);
				break;
			case 2:
				$this->setCaTipo($value);
				break;
			case 3:
				$this->setCaValorTar($value);
				break;
			case 4:
				$this->setCaAplicaTar($value);
				break;
			case 5:
				$this->setCaValorMin($value);
				break;
			case 6:
				$this->setCaAplicaMin($value);
				break;
			case 7:
				$this->setCaIdmoneda($value);
				break;
			case 8:
				$this->setCaModalidad($value);
				break;
			case 9:
				$this->setCaObservaciones($value);
				break;
			case 10:
				$this->setCaFchcreado($value);
				break;
			case 11:
				$this->setCaUsucreado($value);
				break;
			case 12:
				$this->setCaFchactualizado($value);
				break;
			case 13:
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
		$keys = CotRecargoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdopcion($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdrecargo($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaTipo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaValorTar($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaAplicaTar($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaValorMin($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaAplicaMin($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaIdmoneda($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaModalidad($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaObservaciones($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaFchcreado($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaUsucreado($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaFchactualizado($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaUsuactualizado($arr[$keys[13]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(CotRecargoPeer::DATABASE_NAME);

		if ($this->isColumnModified(CotRecargoPeer::CA_IDOPCION)) $criteria->add(CotRecargoPeer::CA_IDOPCION, $this->ca_idopcion);
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

		$criteria->add(CotRecargoPeer::CA_IDOPCION, $this->ca_idopcion);
		$criteria->add(CotRecargoPeer::CA_IDRECARGO, $this->ca_idrecargo);

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

		$pks[0] = $this->getCaIdopcion();

		$pks[1] = $this->getCaIdrecargo();

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

		$this->setCaIdopcion($keys[0]);

		$this->setCaIdrecargo($keys[1]);

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

		$copyObj->setCaIdopcion(NULL); // this is a pkey column, so set to default value

		$copyObj->setCaIdrecargo(NULL); // this is a pkey column, so set to default value

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
	 * @return     void
	 * @throws     PropelException
	 */
	public function setCotOpcion($v)
	{


		if ($v === null) {
			$this->setCaIdopcion(NULL);
		} else {
			$this->setCaIdopcion($v->getCaIdopcion());
		}


		$this->aCotOpcion = $v;
	}


	/**
	 * Get the associated CotOpcion object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     CotOpcion The associated CotOpcion object.
	 * @throws     PropelException
	 */
	public function getCotOpcion($con = null)
	{
		if ($this->aCotOpcion === null && ($this->ca_idopcion !== null)) {
			// include the related Peer class
			$this->aCotOpcion = CotOpcionPeer::retrieveByPK($this->ca_idopcion, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = CotOpcionPeer::retrieveByPK($this->ca_idopcion, $con);
			   $obj->addCotOpcions($this);
			 */
		}
		return $this->aCotOpcion;
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

} // BaseCotRecargo
