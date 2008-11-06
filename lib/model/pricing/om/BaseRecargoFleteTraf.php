<?php

/**
 * Base class that represents a row from the 'tb_recargosxtraf' table.
 *
 * 
 *
 * @package    lib.model.pricing.om
 */
abstract class BaseRecargoFleteTraf extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        RecargoFleteTrafPeer
	 */
	protected static $peer;


	/**
	 * The value for the ca_idtrafico field.
	 * @var        string
	 */
	protected $ca_idtrafico;


	/**
	 * The value for the ca_idciudad field.
	 * @var        string
	 */
	protected $ca_idciudad;


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
	 * The value for the ca_vlrfijo field.
	 * @var        double
	 */
	protected $ca_vlrfijo;


	/**
	 * The value for the ca_porcentaje field.
	 * @var        double
	 */
	protected $ca_porcentaje;


	/**
	 * The value for the ca_baseporcentaje field.
	 * @var        string
	 */
	protected $ca_baseporcentaje;


	/**
	 * The value for the ca_vlrunitario field.
	 * @var        double
	 */
	protected $ca_vlrunitario;


	/**
	 * The value for the ca_baseunitario field.
	 * @var        string
	 */
	protected $ca_baseunitario;


	/**
	 * The value for the ca_recargominimo field.
	 * @var        double
	 */
	protected $ca_recargominimo;


	/**
	 * The value for the ca_idmoneda field.
	 * @var        string
	 */
	protected $ca_idmoneda;


	/**
	 * The value for the ca_observaciones field.
	 * @var        string
	 */
	protected $ca_observaciones;


	/**
	 * The value for the ca_fchinicio field.
	 * @var        int
	 */
	protected $ca_fchinicio;


	/**
	 * The value for the ca_fchvencimiento field.
	 * @var        int
	 */
	protected $ca_fchvencimiento;


	/**
	 * The value for the ca_modalidad field.
	 * @var        string
	 */
	protected $ca_modalidad;


	/**
	 * The value for the ca_impoexpo field.
	 * @var        string
	 */
	protected $ca_impoexpo;

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
	 * Get the [ca_idtrafico] column value.
	 * 
	 * @return     string
	 */
	public function getCaIdtrafico()
	{

		return $this->ca_idtrafico;
	}

	/**
	 * Get the [ca_idciudad] column value.
	 * 
	 * @return     string
	 */
	public function getCaIdciudad()
	{

		return $this->ca_idciudad;
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
	 * Get the [ca_vlrfijo] column value.
	 * 
	 * @return     double
	 */
	public function getCaVlrfijo()
	{

		return $this->ca_vlrfijo;
	}

	/**
	 * Get the [ca_porcentaje] column value.
	 * 
	 * @return     double
	 */
	public function getCaPorcentaje()
	{

		return $this->ca_porcentaje;
	}

	/**
	 * Get the [ca_baseporcentaje] column value.
	 * 
	 * @return     string
	 */
	public function getCaBaseporcentaje()
	{

		return $this->ca_baseporcentaje;
	}

	/**
	 * Get the [ca_vlrunitario] column value.
	 * 
	 * @return     double
	 */
	public function getCaVlrunitario()
	{

		return $this->ca_vlrunitario;
	}

	/**
	 * Get the [ca_baseunitario] column value.
	 * 
	 * @return     string
	 */
	public function getCaBaseunitario()
	{

		return $this->ca_baseunitario;
	}

	/**
	 * Get the [ca_recargominimo] column value.
	 * 
	 * @return     double
	 */
	public function getCaRecargominimo()
	{

		return $this->ca_recargominimo;
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
	 * Get the [ca_observaciones] column value.
	 * 
	 * @return     string
	 */
	public function getCaObservaciones()
	{

		return $this->ca_observaciones;
	}

	/**
	 * Get the [optionally formatted] [ca_fchinicio] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchinicio($format = 'Y-m-d')
	{

		if ($this->ca_fchinicio === null || $this->ca_fchinicio === '') {
			return null;
		} elseif (!is_int($this->ca_fchinicio)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_fchinicio);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_fchinicio] as date/time value: " . var_export($this->ca_fchinicio, true));
			}
		} else {
			$ts = $this->ca_fchinicio;
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
	 * Get the [optionally formatted] [ca_fchvencimiento] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchvencimiento($format = 'Y-m-d')
	{

		if ($this->ca_fchvencimiento === null || $this->ca_fchvencimiento === '') {
			return null;
		} elseif (!is_int($this->ca_fchvencimiento)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_fchvencimiento);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_fchvencimiento] as date/time value: " . var_export($this->ca_fchvencimiento, true));
			}
		} else {
			$ts = $this->ca_fchvencimiento;
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
	 * Get the [ca_modalidad] column value.
	 * 
	 * @return     string
	 */
	public function getCaModalidad()
	{

		return $this->ca_modalidad;
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
	 * Set the value of [ca_idtrafico] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaIdtrafico($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_idtrafico !== $v) {
			$this->ca_idtrafico = $v;
			$this->modifiedColumns[] = RecargoFleteTrafPeer::CA_IDTRAFICO;
		}

	} // setCaIdtrafico()

	/**
	 * Set the value of [ca_idciudad] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaIdciudad($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_idciudad !== $v) {
			$this->ca_idciudad = $v;
			$this->modifiedColumns[] = RecargoFleteTrafPeer::CA_IDCIUDAD;
		}

	} // setCaIdciudad()

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
			$this->modifiedColumns[] = RecargoFleteTrafPeer::CA_IDRECARGO;
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
			$this->modifiedColumns[] = RecargoFleteTrafPeer::CA_APLICACION;
		}

	} // setCaAplicacion()

	/**
	 * Set the value of [ca_vlrfijo] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaVlrfijo($v)
	{

		if ($this->ca_vlrfijo !== $v) {
			$this->ca_vlrfijo = $v;
			$this->modifiedColumns[] = RecargoFleteTrafPeer::CA_VLRFIJO;
		}

	} // setCaVlrfijo()

	/**
	 * Set the value of [ca_porcentaje] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaPorcentaje($v)
	{

		if ($this->ca_porcentaje !== $v) {
			$this->ca_porcentaje = $v;
			$this->modifiedColumns[] = RecargoFleteTrafPeer::CA_PORCENTAJE;
		}

	} // setCaPorcentaje()

	/**
	 * Set the value of [ca_baseporcentaje] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaBaseporcentaje($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_baseporcentaje !== $v) {
			$this->ca_baseporcentaje = $v;
			$this->modifiedColumns[] = RecargoFleteTrafPeer::CA_BASEPORCENTAJE;
		}

	} // setCaBaseporcentaje()

	/**
	 * Set the value of [ca_vlrunitario] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaVlrunitario($v)
	{

		if ($this->ca_vlrunitario !== $v) {
			$this->ca_vlrunitario = $v;
			$this->modifiedColumns[] = RecargoFleteTrafPeer::CA_VLRUNITARIO;
		}

	} // setCaVlrunitario()

	/**
	 * Set the value of [ca_baseunitario] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaBaseunitario($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_baseunitario !== $v) {
			$this->ca_baseunitario = $v;
			$this->modifiedColumns[] = RecargoFleteTrafPeer::CA_BASEUNITARIO;
		}

	} // setCaBaseunitario()

	/**
	 * Set the value of [ca_recargominimo] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaRecargominimo($v)
	{

		if ($this->ca_recargominimo !== $v) {
			$this->ca_recargominimo = $v;
			$this->modifiedColumns[] = RecargoFleteTrafPeer::CA_RECARGOMINIMO;
		}

	} // setCaRecargominimo()

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
			$this->modifiedColumns[] = RecargoFleteTrafPeer::CA_IDMONEDA;
		}

	} // setCaIdmoneda()

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
			$this->modifiedColumns[] = RecargoFleteTrafPeer::CA_OBSERVACIONES;
		}

	} // setCaObservaciones()

	/**
	 * Set the value of [ca_fchinicio] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaFchinicio($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_fchinicio] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_fchinicio !== $ts) {
			$this->ca_fchinicio = $ts;
			$this->modifiedColumns[] = RecargoFleteTrafPeer::CA_FCHINICIO;
		}

	} // setCaFchinicio()

	/**
	 * Set the value of [ca_fchvencimiento] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaFchvencimiento($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_fchvencimiento] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_fchvencimiento !== $ts) {
			$this->ca_fchvencimiento = $ts;
			$this->modifiedColumns[] = RecargoFleteTrafPeer::CA_FCHVENCIMIENTO;
		}

	} // setCaFchvencimiento()

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
			$this->modifiedColumns[] = RecargoFleteTrafPeer::CA_MODALIDAD;
		}

	} // setCaModalidad()

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
			$this->modifiedColumns[] = RecargoFleteTrafPeer::CA_IMPOEXPO;
		}

	} // setCaImpoexpo()

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

			$this->ca_idtrafico = $rs->getString($startcol + 0);

			$this->ca_idciudad = $rs->getString($startcol + 1);

			$this->ca_idrecargo = $rs->getInt($startcol + 2);

			$this->ca_aplicacion = $rs->getString($startcol + 3);

			$this->ca_vlrfijo = $rs->getFloat($startcol + 4);

			$this->ca_porcentaje = $rs->getFloat($startcol + 5);

			$this->ca_baseporcentaje = $rs->getString($startcol + 6);

			$this->ca_vlrunitario = $rs->getFloat($startcol + 7);

			$this->ca_baseunitario = $rs->getString($startcol + 8);

			$this->ca_recargominimo = $rs->getFloat($startcol + 9);

			$this->ca_idmoneda = $rs->getString($startcol + 10);

			$this->ca_observaciones = $rs->getString($startcol + 11);

			$this->ca_fchinicio = $rs->getDate($startcol + 12, null);

			$this->ca_fchvencimiento = $rs->getDate($startcol + 13, null);

			$this->ca_modalidad = $rs->getString($startcol + 14);

			$this->ca_impoexpo = $rs->getString($startcol + 15);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 16; // 16 = RecargoFleteTrafPeer::NUM_COLUMNS - RecargoFleteTrafPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating RecargoFleteTraf object", $e);
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
			$con = Propel::getConnection(RecargoFleteTrafPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			RecargoFleteTrafPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(RecargoFleteTrafPeer::DATABASE_NAME);
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

			if ($this->aTipoRecargo !== null) {
				if ($this->aTipoRecargo->isModified()) {
					$affectedRows += $this->aTipoRecargo->save($con);
				}
				$this->setTipoRecargo($this->aTipoRecargo);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = RecargoFleteTrafPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += RecargoFleteTrafPeer::doUpdate($this, $con);
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

			if ($this->aTipoRecargo !== null) {
				if (!$this->aTipoRecargo->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTipoRecargo->getValidationFailures());
				}
			}


			if (($retval = RecargoFleteTrafPeer::doValidate($this, $columns)) !== true) {
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
		$pos = RecargoFleteTrafPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdtrafico();
				break;
			case 1:
				return $this->getCaIdciudad();
				break;
			case 2:
				return $this->getCaIdrecargo();
				break;
			case 3:
				return $this->getCaAplicacion();
				break;
			case 4:
				return $this->getCaVlrfijo();
				break;
			case 5:
				return $this->getCaPorcentaje();
				break;
			case 6:
				return $this->getCaBaseporcentaje();
				break;
			case 7:
				return $this->getCaVlrunitario();
				break;
			case 8:
				return $this->getCaBaseunitario();
				break;
			case 9:
				return $this->getCaRecargominimo();
				break;
			case 10:
				return $this->getCaIdmoneda();
				break;
			case 11:
				return $this->getCaObservaciones();
				break;
			case 12:
				return $this->getCaFchinicio();
				break;
			case 13:
				return $this->getCaFchvencimiento();
				break;
			case 14:
				return $this->getCaModalidad();
				break;
			case 15:
				return $this->getCaImpoexpo();
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
		$keys = RecargoFleteTrafPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdtrafico(),
			$keys[1] => $this->getCaIdciudad(),
			$keys[2] => $this->getCaIdrecargo(),
			$keys[3] => $this->getCaAplicacion(),
			$keys[4] => $this->getCaVlrfijo(),
			$keys[5] => $this->getCaPorcentaje(),
			$keys[6] => $this->getCaBaseporcentaje(),
			$keys[7] => $this->getCaVlrunitario(),
			$keys[8] => $this->getCaBaseunitario(),
			$keys[9] => $this->getCaRecargominimo(),
			$keys[10] => $this->getCaIdmoneda(),
			$keys[11] => $this->getCaObservaciones(),
			$keys[12] => $this->getCaFchinicio(),
			$keys[13] => $this->getCaFchvencimiento(),
			$keys[14] => $this->getCaModalidad(),
			$keys[15] => $this->getCaImpoexpo(),
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
		$pos = RecargoFleteTrafPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdtrafico($value);
				break;
			case 1:
				$this->setCaIdciudad($value);
				break;
			case 2:
				$this->setCaIdrecargo($value);
				break;
			case 3:
				$this->setCaAplicacion($value);
				break;
			case 4:
				$this->setCaVlrfijo($value);
				break;
			case 5:
				$this->setCaPorcentaje($value);
				break;
			case 6:
				$this->setCaBaseporcentaje($value);
				break;
			case 7:
				$this->setCaVlrunitario($value);
				break;
			case 8:
				$this->setCaBaseunitario($value);
				break;
			case 9:
				$this->setCaRecargominimo($value);
				break;
			case 10:
				$this->setCaIdmoneda($value);
				break;
			case 11:
				$this->setCaObservaciones($value);
				break;
			case 12:
				$this->setCaFchinicio($value);
				break;
			case 13:
				$this->setCaFchvencimiento($value);
				break;
			case 14:
				$this->setCaModalidad($value);
				break;
			case 15:
				$this->setCaImpoexpo($value);
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
		$keys = RecargoFleteTrafPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdtrafico($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdciudad($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaIdrecargo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaAplicacion($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaVlrfijo($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaPorcentaje($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaBaseporcentaje($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaVlrunitario($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaBaseunitario($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaRecargominimo($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaIdmoneda($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaObservaciones($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaFchinicio($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaFchvencimiento($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaModalidad($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaImpoexpo($arr[$keys[15]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(RecargoFleteTrafPeer::DATABASE_NAME);

		if ($this->isColumnModified(RecargoFleteTrafPeer::CA_IDTRAFICO)) $criteria->add(RecargoFleteTrafPeer::CA_IDTRAFICO, $this->ca_idtrafico);
		if ($this->isColumnModified(RecargoFleteTrafPeer::CA_IDCIUDAD)) $criteria->add(RecargoFleteTrafPeer::CA_IDCIUDAD, $this->ca_idciudad);
		if ($this->isColumnModified(RecargoFleteTrafPeer::CA_IDRECARGO)) $criteria->add(RecargoFleteTrafPeer::CA_IDRECARGO, $this->ca_idrecargo);
		if ($this->isColumnModified(RecargoFleteTrafPeer::CA_APLICACION)) $criteria->add(RecargoFleteTrafPeer::CA_APLICACION, $this->ca_aplicacion);
		if ($this->isColumnModified(RecargoFleteTrafPeer::CA_VLRFIJO)) $criteria->add(RecargoFleteTrafPeer::CA_VLRFIJO, $this->ca_vlrfijo);
		if ($this->isColumnModified(RecargoFleteTrafPeer::CA_PORCENTAJE)) $criteria->add(RecargoFleteTrafPeer::CA_PORCENTAJE, $this->ca_porcentaje);
		if ($this->isColumnModified(RecargoFleteTrafPeer::CA_BASEPORCENTAJE)) $criteria->add(RecargoFleteTrafPeer::CA_BASEPORCENTAJE, $this->ca_baseporcentaje);
		if ($this->isColumnModified(RecargoFleteTrafPeer::CA_VLRUNITARIO)) $criteria->add(RecargoFleteTrafPeer::CA_VLRUNITARIO, $this->ca_vlrunitario);
		if ($this->isColumnModified(RecargoFleteTrafPeer::CA_BASEUNITARIO)) $criteria->add(RecargoFleteTrafPeer::CA_BASEUNITARIO, $this->ca_baseunitario);
		if ($this->isColumnModified(RecargoFleteTrafPeer::CA_RECARGOMINIMO)) $criteria->add(RecargoFleteTrafPeer::CA_RECARGOMINIMO, $this->ca_recargominimo);
		if ($this->isColumnModified(RecargoFleteTrafPeer::CA_IDMONEDA)) $criteria->add(RecargoFleteTrafPeer::CA_IDMONEDA, $this->ca_idmoneda);
		if ($this->isColumnModified(RecargoFleteTrafPeer::CA_OBSERVACIONES)) $criteria->add(RecargoFleteTrafPeer::CA_OBSERVACIONES, $this->ca_observaciones);
		if ($this->isColumnModified(RecargoFleteTrafPeer::CA_FCHINICIO)) $criteria->add(RecargoFleteTrafPeer::CA_FCHINICIO, $this->ca_fchinicio);
		if ($this->isColumnModified(RecargoFleteTrafPeer::CA_FCHVENCIMIENTO)) $criteria->add(RecargoFleteTrafPeer::CA_FCHVENCIMIENTO, $this->ca_fchvencimiento);
		if ($this->isColumnModified(RecargoFleteTrafPeer::CA_MODALIDAD)) $criteria->add(RecargoFleteTrafPeer::CA_MODALIDAD, $this->ca_modalidad);
		if ($this->isColumnModified(RecargoFleteTrafPeer::CA_IMPOEXPO)) $criteria->add(RecargoFleteTrafPeer::CA_IMPOEXPO, $this->ca_impoexpo);

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
		$criteria = new Criteria(RecargoFleteTrafPeer::DATABASE_NAME);

		$criteria->add(RecargoFleteTrafPeer::CA_IDTRAFICO, $this->ca_idtrafico);
		$criteria->add(RecargoFleteTrafPeer::CA_IDCIUDAD, $this->ca_idciudad);
		$criteria->add(RecargoFleteTrafPeer::CA_IDRECARGO, $this->ca_idrecargo);

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

		$pks[0] = $this->getCaIdtrafico();

		$pks[1] = $this->getCaIdciudad();

		$pks[2] = $this->getCaIdrecargo();

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

		$this->setCaIdtrafico($keys[0]);

		$this->setCaIdciudad($keys[1]);

		$this->setCaIdrecargo($keys[2]);

	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of RecargoFleteTraf (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaAplicacion($this->ca_aplicacion);

		$copyObj->setCaVlrfijo($this->ca_vlrfijo);

		$copyObj->setCaPorcentaje($this->ca_porcentaje);

		$copyObj->setCaBaseporcentaje($this->ca_baseporcentaje);

		$copyObj->setCaVlrunitario($this->ca_vlrunitario);

		$copyObj->setCaBaseunitario($this->ca_baseunitario);

		$copyObj->setCaRecargominimo($this->ca_recargominimo);

		$copyObj->setCaIdmoneda($this->ca_idmoneda);

		$copyObj->setCaObservaciones($this->ca_observaciones);

		$copyObj->setCaFchinicio($this->ca_fchinicio);

		$copyObj->setCaFchvencimiento($this->ca_fchvencimiento);

		$copyObj->setCaModalidad($this->ca_modalidad);

		$copyObj->setCaImpoexpo($this->ca_impoexpo);


		$copyObj->setNew(true);

		$copyObj->setCaIdtrafico(NULL); // this is a pkey column, so set to default value

		$copyObj->setCaIdciudad(NULL); // this is a pkey column, so set to default value

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
	 * @return     RecargoFleteTraf Clone of current object.
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
	 * @return     RecargoFleteTrafPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new RecargoFleteTrafPeer();
		}
		return self::$peer;
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

} // BaseRecargoFleteTraf
