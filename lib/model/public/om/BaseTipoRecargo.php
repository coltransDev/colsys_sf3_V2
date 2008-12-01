<?php

/**
 * Base class that represents a row from the 'tb_tiporecargo' table.
 *
 * 
 *
 * @package    lib.model.public.om
 */
abstract class BaseTipoRecargo extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        TipoRecargoPeer
	 */
	protected static $peer;


	/**
	 * The value for the ca_idrecargo field.
	 * @var        int
	 */
	protected $ca_idrecargo;


	/**
	 * The value for the ca_recargo field.
	 * @var        string
	 */
	protected $ca_recargo;


	/**
	 * The value for the ca_tipo field.
	 * @var        string
	 */
	protected $ca_tipo;


	/**
	 * The value for the ca_transporte field.
	 * @var        string
	 */
	protected $ca_transporte;


	/**
	 * The value for the ca_incoterms field.
	 * @var        string
	 */
	protected $ca_incoterms;


	/**
	 * The value for the ca_reporte field.
	 * @var        string
	 */
	protected $ca_reporte;


	/**
	 * The value for the ca_impoexpo field.
	 * @var        string
	 */
	protected $ca_impoexpo;


	/**
	 * The value for the ca_aplicacion field.
	 * @var        string
	 */
	protected $ca_aplicacion;

	/**
	 * Collection to store aggregation of collCotRecargos.
	 * @var        array
	 */
	protected $collCotRecargos;

	/**
	 * The criteria used to select the current contents of collCotRecargos.
	 * @var        Criteria
	 */
	protected $lastCotRecargoCriteria = null;

	/**
	 * Collection to store aggregation of collPricRecargoxConceptos.
	 * @var        array
	 */
	protected $collPricRecargoxConceptos;

	/**
	 * The criteria used to select the current contents of collPricRecargoxConceptos.
	 * @var        Criteria
	 */
	protected $lastPricRecargoxConceptoCriteria = null;

	/**
	 * Collection to store aggregation of collPricRecargoxConceptoLogs.
	 * @var        array
	 */
	protected $collPricRecargoxConceptoLogs;

	/**
	 * The criteria used to select the current contents of collPricRecargoxConceptoLogs.
	 * @var        Criteria
	 */
	protected $lastPricRecargoxConceptoLogCriteria = null;

	/**
	 * Collection to store aggregation of collPricRecargosxCiudads.
	 * @var        array
	 */
	protected $collPricRecargosxCiudads;

	/**
	 * The criteria used to select the current contents of collPricRecargosxCiudads.
	 * @var        Criteria
	 */
	protected $lastPricRecargosxCiudadCriteria = null;

	/**
	 * Collection to store aggregation of collPricRecargosxCiudadLogs.
	 * @var        array
	 */
	protected $collPricRecargosxCiudadLogs;

	/**
	 * The criteria used to select the current contents of collPricRecargosxCiudadLogs.
	 * @var        Criteria
	 */
	protected $lastPricRecargosxCiudadLogCriteria = null;

	/**
	 * Collection to store aggregation of collRepGastos.
	 * @var        array
	 */
	protected $collRepGastos;

	/**
	 * The criteria used to select the current contents of collRepGastos.
	 * @var        Criteria
	 */
	protected $lastRepGastoCriteria = null;

	/**
	 * Collection to store aggregation of collRecargoFletes.
	 * @var        array
	 */
	protected $collRecargoFletes;

	/**
	 * The criteria used to select the current contents of collRecargoFletes.
	 * @var        Criteria
	 */
	protected $lastRecargoFleteCriteria = null;

	/**
	 * Collection to store aggregation of collRecargoFleteTrafs.
	 * @var        array
	 */
	protected $collRecargoFleteTrafs;

	/**
	 * The criteria used to select the current contents of collRecargoFleteTrafs.
	 * @var        Criteria
	 */
	protected $lastRecargoFleteTrafCriteria = null;

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
	 * Get the [ca_idrecargo] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdrecargo()
	{

		return $this->ca_idrecargo;
	}

	/**
	 * Get the [ca_recargo] column value.
	 * 
	 * @return     string
	 */
	public function getCaRecargo()
	{

		return $this->ca_recargo;
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
	 * Get the [ca_transporte] column value.
	 * 
	 * @return     string
	 */
	public function getCaTransporte()
	{

		return $this->ca_transporte;
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
	 * Get the [ca_reporte] column value.
	 * 
	 * @return     string
	 */
	public function getCaReporte()
	{

		return $this->ca_reporte;
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
	 * Get the [ca_aplicacion] column value.
	 * 
	 * @return     string
	 */
	public function getCaAplicacion()
	{

		return $this->ca_aplicacion;
	}

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
			$this->modifiedColumns[] = TipoRecargoPeer::CA_IDRECARGO;
		}

	} // setCaIdrecargo()

	/**
	 * Set the value of [ca_recargo] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaRecargo($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_recargo !== $v) {
			$this->ca_recargo = $v;
			$this->modifiedColumns[] = TipoRecargoPeer::CA_RECARGO;
		}

	} // setCaRecargo()

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
			$this->modifiedColumns[] = TipoRecargoPeer::CA_TIPO;
		}

	} // setCaTipo()

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
			$this->modifiedColumns[] = TipoRecargoPeer::CA_TRANSPORTE;
		}

	} // setCaTransporte()

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
			$this->modifiedColumns[] = TipoRecargoPeer::CA_INCOTERMS;
		}

	} // setCaIncoterms()

	/**
	 * Set the value of [ca_reporte] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaReporte($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_reporte !== $v) {
			$this->ca_reporte = $v;
			$this->modifiedColumns[] = TipoRecargoPeer::CA_REPORTE;
		}

	} // setCaReporte()

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
			$this->modifiedColumns[] = TipoRecargoPeer::CA_IMPOEXPO;
		}

	} // setCaImpoexpo()

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
			$this->modifiedColumns[] = TipoRecargoPeer::CA_APLICACION;
		}

	} // setCaAplicacion()

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

			$this->ca_idrecargo = $rs->getInt($startcol + 0);

			$this->ca_recargo = $rs->getString($startcol + 1);

			$this->ca_tipo = $rs->getString($startcol + 2);

			$this->ca_transporte = $rs->getString($startcol + 3);

			$this->ca_incoterms = $rs->getString($startcol + 4);

			$this->ca_reporte = $rs->getString($startcol + 5);

			$this->ca_impoexpo = $rs->getString($startcol + 6);

			$this->ca_aplicacion = $rs->getString($startcol + 7);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 8; // 8 = TipoRecargoPeer::NUM_COLUMNS - TipoRecargoPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating TipoRecargo object", $e);
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
			$con = Propel::getConnection(TipoRecargoPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			TipoRecargoPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(TipoRecargoPeer::DATABASE_NAME);
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


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TipoRecargoPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += TipoRecargoPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collCotRecargos !== null) {
				foreach($this->collCotRecargos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPricRecargoxConceptos !== null) {
				foreach($this->collPricRecargoxConceptos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPricRecargoxConceptoLogs !== null) {
				foreach($this->collPricRecargoxConceptoLogs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPricRecargosxCiudads !== null) {
				foreach($this->collPricRecargosxCiudads as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPricRecargosxCiudadLogs !== null) {
				foreach($this->collPricRecargosxCiudadLogs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRepGastos !== null) {
				foreach($this->collRepGastos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRecargoFletes !== null) {
				foreach($this->collRecargoFletes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRecargoFleteTrafs !== null) {
				foreach($this->collRecargoFleteTrafs as $referrerFK) {
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


			if (($retval = TipoRecargoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collCotRecargos !== null) {
					foreach($this->collCotRecargos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPricRecargoxConceptos !== null) {
					foreach($this->collPricRecargoxConceptos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPricRecargoxConceptoLogs !== null) {
					foreach($this->collPricRecargoxConceptoLogs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPricRecargosxCiudads !== null) {
					foreach($this->collPricRecargosxCiudads as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPricRecargosxCiudadLogs !== null) {
					foreach($this->collPricRecargosxCiudadLogs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRepGastos !== null) {
					foreach($this->collRepGastos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRecargoFletes !== null) {
					foreach($this->collRecargoFletes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRecargoFleteTrafs !== null) {
					foreach($this->collRecargoFleteTrafs as $referrerFK) {
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
		$pos = TipoRecargoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdrecargo();
				break;
			case 1:
				return $this->getCaRecargo();
				break;
			case 2:
				return $this->getCaTipo();
				break;
			case 3:
				return $this->getCaTransporte();
				break;
			case 4:
				return $this->getCaIncoterms();
				break;
			case 5:
				return $this->getCaReporte();
				break;
			case 6:
				return $this->getCaImpoexpo();
				break;
			case 7:
				return $this->getCaAplicacion();
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
		$keys = TipoRecargoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdrecargo(),
			$keys[1] => $this->getCaRecargo(),
			$keys[2] => $this->getCaTipo(),
			$keys[3] => $this->getCaTransporte(),
			$keys[4] => $this->getCaIncoterms(),
			$keys[5] => $this->getCaReporte(),
			$keys[6] => $this->getCaImpoexpo(),
			$keys[7] => $this->getCaAplicacion(),
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
		$pos = TipoRecargoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdrecargo($value);
				break;
			case 1:
				$this->setCaRecargo($value);
				break;
			case 2:
				$this->setCaTipo($value);
				break;
			case 3:
				$this->setCaTransporte($value);
				break;
			case 4:
				$this->setCaIncoterms($value);
				break;
			case 5:
				$this->setCaReporte($value);
				break;
			case 6:
				$this->setCaImpoexpo($value);
				break;
			case 7:
				$this->setCaAplicacion($value);
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
		$keys = TipoRecargoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdrecargo($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaRecargo($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaTipo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaTransporte($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaIncoterms($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaReporte($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaImpoexpo($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaAplicacion($arr[$keys[7]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);

		if ($this->isColumnModified(TipoRecargoPeer::CA_IDRECARGO)) $criteria->add(TipoRecargoPeer::CA_IDRECARGO, $this->ca_idrecargo);
		if ($this->isColumnModified(TipoRecargoPeer::CA_RECARGO)) $criteria->add(TipoRecargoPeer::CA_RECARGO, $this->ca_recargo);
		if ($this->isColumnModified(TipoRecargoPeer::CA_TIPO)) $criteria->add(TipoRecargoPeer::CA_TIPO, $this->ca_tipo);
		if ($this->isColumnModified(TipoRecargoPeer::CA_TRANSPORTE)) $criteria->add(TipoRecargoPeer::CA_TRANSPORTE, $this->ca_transporte);
		if ($this->isColumnModified(TipoRecargoPeer::CA_INCOTERMS)) $criteria->add(TipoRecargoPeer::CA_INCOTERMS, $this->ca_incoterms);
		if ($this->isColumnModified(TipoRecargoPeer::CA_REPORTE)) $criteria->add(TipoRecargoPeer::CA_REPORTE, $this->ca_reporte);
		if ($this->isColumnModified(TipoRecargoPeer::CA_IMPOEXPO)) $criteria->add(TipoRecargoPeer::CA_IMPOEXPO, $this->ca_impoexpo);
		if ($this->isColumnModified(TipoRecargoPeer::CA_APLICACION)) $criteria->add(TipoRecargoPeer::CA_APLICACION, $this->ca_aplicacion);

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
		$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);

		$criteria->add(TipoRecargoPeer::CA_IDRECARGO, $this->ca_idrecargo);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdrecargo();
	}

	/**
	 * Generic method to set the primary key (ca_idrecargo column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdrecargo($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of TipoRecargo (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaRecargo($this->ca_recargo);

		$copyObj->setCaTipo($this->ca_tipo);

		$copyObj->setCaTransporte($this->ca_transporte);

		$copyObj->setCaIncoterms($this->ca_incoterms);

		$copyObj->setCaReporte($this->ca_reporte);

		$copyObj->setCaImpoexpo($this->ca_impoexpo);

		$copyObj->setCaAplicacion($this->ca_aplicacion);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getCotRecargos() as $relObj) {
				$copyObj->addCotRecargo($relObj->copy($deepCopy));
			}

			foreach($this->getPricRecargoxConceptos() as $relObj) {
				$copyObj->addPricRecargoxConcepto($relObj->copy($deepCopy));
			}

			foreach($this->getPricRecargoxConceptoLogs() as $relObj) {
				$copyObj->addPricRecargoxConceptoLog($relObj->copy($deepCopy));
			}

			foreach($this->getPricRecargosxCiudads() as $relObj) {
				$copyObj->addPricRecargosxCiudad($relObj->copy($deepCopy));
			}

			foreach($this->getPricRecargosxCiudadLogs() as $relObj) {
				$copyObj->addPricRecargosxCiudadLog($relObj->copy($deepCopy));
			}

			foreach($this->getRepGastos() as $relObj) {
				$copyObj->addRepGasto($relObj->copy($deepCopy));
			}

			foreach($this->getRecargoFletes() as $relObj) {
				$copyObj->addRecargoFlete($relObj->copy($deepCopy));
			}

			foreach($this->getRecargoFleteTrafs() as $relObj) {
				$copyObj->addRecargoFleteTraf($relObj->copy($deepCopy));
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

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
	 * @return     TipoRecargo Clone of current object.
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
	 * @return     TipoRecargoPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new TipoRecargoPeer();
		}
		return self::$peer;
	}

	/**
	 * Temporary storage of collCotRecargos to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initCotRecargos()
	{
		if ($this->collCotRecargos === null) {
			$this->collCotRecargos = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TipoRecargo has previously
	 * been saved, it will retrieve related CotRecargos from storage.
	 * If this TipoRecargo is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getCotRecargos($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotRecargos === null) {
			if ($this->isNew()) {
			   $this->collCotRecargos = array();
			} else {

				$criteria->add(CotRecargoPeer::CA_IDRECARGO, $this->getCaIdrecargo());

				CotRecargoPeer::addSelectColumns($criteria);
				$this->collCotRecargos = CotRecargoPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CotRecargoPeer::CA_IDRECARGO, $this->getCaIdrecargo());

				CotRecargoPeer::addSelectColumns($criteria);
				if (!isset($this->lastCotRecargoCriteria) || !$this->lastCotRecargoCriteria->equals($criteria)) {
					$this->collCotRecargos = CotRecargoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCotRecargoCriteria = $criteria;
		return $this->collCotRecargos;
	}

	/**
	 * Returns the number of related CotRecargos.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countCotRecargos($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CotRecargoPeer::CA_IDRECARGO, $this->getCaIdrecargo());

		return CotRecargoPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a CotRecargo object to this object
	 * through the CotRecargo foreign key attribute
	 *
	 * @param      CotRecargo $l CotRecargo
	 * @return     void
	 * @throws     PropelException
	 */
	public function addCotRecargo(CotRecargo $l)
	{
		$this->collCotRecargos[] = $l;
		$l->setTipoRecargo($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TipoRecargo is new, it will return
	 * an empty collection; or if this TipoRecargo has previously
	 * been saved, it will retrieve related CotRecargos from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TipoRecargo.
	 */
	public function getCotRecargosJoinCotOpcion($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotRecargos === null) {
			if ($this->isNew()) {
				$this->collCotRecargos = array();
			} else {

				$criteria->add(CotRecargoPeer::CA_IDRECARGO, $this->getCaIdrecargo());

				$this->collCotRecargos = CotRecargoPeer::doSelectJoinCotOpcion($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CotRecargoPeer::CA_IDRECARGO, $this->getCaIdrecargo());

			if (!isset($this->lastCotRecargoCriteria) || !$this->lastCotRecargoCriteria->equals($criteria)) {
				$this->collCotRecargos = CotRecargoPeer::doSelectJoinCotOpcion($criteria, $con);
			}
		}
		$this->lastCotRecargoCriteria = $criteria;

		return $this->collCotRecargos;
	}

	/**
	 * Temporary storage of collPricRecargoxConceptos to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initPricRecargoxConceptos()
	{
		if ($this->collPricRecargoxConceptos === null) {
			$this->collPricRecargoxConceptos = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TipoRecargo has previously
	 * been saved, it will retrieve related PricRecargoxConceptos from storage.
	 * If this TipoRecargo is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getPricRecargoxConceptos($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargoxConceptos === null) {
			if ($this->isNew()) {
			   $this->collPricRecargoxConceptos = array();
			} else {

				$criteria->add(PricRecargoxConceptoPeer::CA_IDRECARGO, $this->getCaIdrecargo());

				PricRecargoxConceptoPeer::addSelectColumns($criteria);
				$this->collPricRecargoxConceptos = PricRecargoxConceptoPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PricRecargoxConceptoPeer::CA_IDRECARGO, $this->getCaIdrecargo());

				PricRecargoxConceptoPeer::addSelectColumns($criteria);
				if (!isset($this->lastPricRecargoxConceptoCriteria) || !$this->lastPricRecargoxConceptoCriteria->equals($criteria)) {
					$this->collPricRecargoxConceptos = PricRecargoxConceptoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPricRecargoxConceptoCriteria = $criteria;
		return $this->collPricRecargoxConceptos;
	}

	/**
	 * Returns the number of related PricRecargoxConceptos.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countPricRecargoxConceptos($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PricRecargoxConceptoPeer::CA_IDRECARGO, $this->getCaIdrecargo());

		return PricRecargoxConceptoPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a PricRecargoxConcepto object to this object
	 * through the PricRecargoxConcepto foreign key attribute
	 *
	 * @param      PricRecargoxConcepto $l PricRecargoxConcepto
	 * @return     void
	 * @throws     PropelException
	 */
	public function addPricRecargoxConcepto(PricRecargoxConcepto $l)
	{
		$this->collPricRecargoxConceptos[] = $l;
		$l->setTipoRecargo($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TipoRecargo is new, it will return
	 * an empty collection; or if this TipoRecargo has previously
	 * been saved, it will retrieve related PricRecargoxConceptos from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TipoRecargo.
	 */
	public function getPricRecargoxConceptosJoinPricFlete($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargoxConceptos === null) {
			if ($this->isNew()) {
				$this->collPricRecargoxConceptos = array();
			} else {

				$criteria->add(PricRecargoxConceptoPeer::CA_IDRECARGO, $this->getCaIdrecargo());

				$this->collPricRecargoxConceptos = PricRecargoxConceptoPeer::doSelectJoinPricFlete($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PricRecargoxConceptoPeer::CA_IDRECARGO, $this->getCaIdrecargo());

			if (!isset($this->lastPricRecargoxConceptoCriteria) || !$this->lastPricRecargoxConceptoCriteria->equals($criteria)) {
				$this->collPricRecargoxConceptos = PricRecargoxConceptoPeer::doSelectJoinPricFlete($criteria, $con);
			}
		}
		$this->lastPricRecargoxConceptoCriteria = $criteria;

		return $this->collPricRecargoxConceptos;
	}

	/**
	 * Temporary storage of collPricRecargoxConceptoLogs to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initPricRecargoxConceptoLogs()
	{
		if ($this->collPricRecargoxConceptoLogs === null) {
			$this->collPricRecargoxConceptoLogs = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TipoRecargo has previously
	 * been saved, it will retrieve related PricRecargoxConceptoLogs from storage.
	 * If this TipoRecargo is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getPricRecargoxConceptoLogs($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargoxConceptoLogs === null) {
			if ($this->isNew()) {
			   $this->collPricRecargoxConceptoLogs = array();
			} else {

				$criteria->add(PricRecargoxConceptoLogPeer::CA_IDRECARGO, $this->getCaIdrecargo());

				PricRecargoxConceptoLogPeer::addSelectColumns($criteria);
				$this->collPricRecargoxConceptoLogs = PricRecargoxConceptoLogPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PricRecargoxConceptoLogPeer::CA_IDRECARGO, $this->getCaIdrecargo());

				PricRecargoxConceptoLogPeer::addSelectColumns($criteria);
				if (!isset($this->lastPricRecargoxConceptoLogCriteria) || !$this->lastPricRecargoxConceptoLogCriteria->equals($criteria)) {
					$this->collPricRecargoxConceptoLogs = PricRecargoxConceptoLogPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPricRecargoxConceptoLogCriteria = $criteria;
		return $this->collPricRecargoxConceptoLogs;
	}

	/**
	 * Returns the number of related PricRecargoxConceptoLogs.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countPricRecargoxConceptoLogs($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PricRecargoxConceptoLogPeer::CA_IDRECARGO, $this->getCaIdrecargo());

		return PricRecargoxConceptoLogPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a PricRecargoxConceptoLog object to this object
	 * through the PricRecargoxConceptoLog foreign key attribute
	 *
	 * @param      PricRecargoxConceptoLog $l PricRecargoxConceptoLog
	 * @return     void
	 * @throws     PropelException
	 */
	public function addPricRecargoxConceptoLog(PricRecargoxConceptoLog $l)
	{
		$this->collPricRecargoxConceptoLogs[] = $l;
		$l->setTipoRecargo($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TipoRecargo is new, it will return
	 * an empty collection; or if this TipoRecargo has previously
	 * been saved, it will retrieve related PricRecargoxConceptoLogs from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TipoRecargo.
	 */
	public function getPricRecargoxConceptoLogsJoinPricFlete($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargoxConceptoLogs === null) {
			if ($this->isNew()) {
				$this->collPricRecargoxConceptoLogs = array();
			} else {

				$criteria->add(PricRecargoxConceptoLogPeer::CA_IDRECARGO, $this->getCaIdrecargo());

				$this->collPricRecargoxConceptoLogs = PricRecargoxConceptoLogPeer::doSelectJoinPricFlete($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PricRecargoxConceptoLogPeer::CA_IDRECARGO, $this->getCaIdrecargo());

			if (!isset($this->lastPricRecargoxConceptoLogCriteria) || !$this->lastPricRecargoxConceptoLogCriteria->equals($criteria)) {
				$this->collPricRecargoxConceptoLogs = PricRecargoxConceptoLogPeer::doSelectJoinPricFlete($criteria, $con);
			}
		}
		$this->lastPricRecargoxConceptoLogCriteria = $criteria;

		return $this->collPricRecargoxConceptoLogs;
	}

	/**
	 * Temporary storage of collPricRecargosxCiudads to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initPricRecargosxCiudads()
	{
		if ($this->collPricRecargosxCiudads === null) {
			$this->collPricRecargosxCiudads = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TipoRecargo has previously
	 * been saved, it will retrieve related PricRecargosxCiudads from storage.
	 * If this TipoRecargo is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getPricRecargosxCiudads($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxCiudads === null) {
			if ($this->isNew()) {
			   $this->collPricRecargosxCiudads = array();
			} else {

				$criteria->add(PricRecargosxCiudadPeer::CA_IDRECARGO, $this->getCaIdrecargo());

				PricRecargosxCiudadPeer::addSelectColumns($criteria);
				$this->collPricRecargosxCiudads = PricRecargosxCiudadPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PricRecargosxCiudadPeer::CA_IDRECARGO, $this->getCaIdrecargo());

				PricRecargosxCiudadPeer::addSelectColumns($criteria);
				if (!isset($this->lastPricRecargosxCiudadCriteria) || !$this->lastPricRecargosxCiudadCriteria->equals($criteria)) {
					$this->collPricRecargosxCiudads = PricRecargosxCiudadPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPricRecargosxCiudadCriteria = $criteria;
		return $this->collPricRecargosxCiudads;
	}

	/**
	 * Returns the number of related PricRecargosxCiudads.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countPricRecargosxCiudads($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PricRecargosxCiudadPeer::CA_IDRECARGO, $this->getCaIdrecargo());

		return PricRecargosxCiudadPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a PricRecargosxCiudad object to this object
	 * through the PricRecargosxCiudad foreign key attribute
	 *
	 * @param      PricRecargosxCiudad $l PricRecargosxCiudad
	 * @return     void
	 * @throws     PropelException
	 */
	public function addPricRecargosxCiudad(PricRecargosxCiudad $l)
	{
		$this->collPricRecargosxCiudads[] = $l;
		$l->setTipoRecargo($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TipoRecargo is new, it will return
	 * an empty collection; or if this TipoRecargo has previously
	 * been saved, it will retrieve related PricRecargosxCiudads from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TipoRecargo.
	 */
	public function getPricRecargosxCiudadsJoinCiudad($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxCiudads === null) {
			if ($this->isNew()) {
				$this->collPricRecargosxCiudads = array();
			} else {

				$criteria->add(PricRecargosxCiudadPeer::CA_IDRECARGO, $this->getCaIdrecargo());

				$this->collPricRecargosxCiudads = PricRecargosxCiudadPeer::doSelectJoinCiudad($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PricRecargosxCiudadPeer::CA_IDRECARGO, $this->getCaIdrecargo());

			if (!isset($this->lastPricRecargosxCiudadCriteria) || !$this->lastPricRecargosxCiudadCriteria->equals($criteria)) {
				$this->collPricRecargosxCiudads = PricRecargosxCiudadPeer::doSelectJoinCiudad($criteria, $con);
			}
		}
		$this->lastPricRecargosxCiudadCriteria = $criteria;

		return $this->collPricRecargosxCiudads;
	}

	/**
	 * Temporary storage of collPricRecargosxCiudadLogs to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initPricRecargosxCiudadLogs()
	{
		if ($this->collPricRecargosxCiudadLogs === null) {
			$this->collPricRecargosxCiudadLogs = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TipoRecargo has previously
	 * been saved, it will retrieve related PricRecargosxCiudadLogs from storage.
	 * If this TipoRecargo is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getPricRecargosxCiudadLogs($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxCiudadLogs === null) {
			if ($this->isNew()) {
			   $this->collPricRecargosxCiudadLogs = array();
			} else {

				$criteria->add(PricRecargosxCiudadLogPeer::CA_IDRECARGO, $this->getCaIdrecargo());

				PricRecargosxCiudadLogPeer::addSelectColumns($criteria);
				$this->collPricRecargosxCiudadLogs = PricRecargosxCiudadLogPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PricRecargosxCiudadLogPeer::CA_IDRECARGO, $this->getCaIdrecargo());

				PricRecargosxCiudadLogPeer::addSelectColumns($criteria);
				if (!isset($this->lastPricRecargosxCiudadLogCriteria) || !$this->lastPricRecargosxCiudadLogCriteria->equals($criteria)) {
					$this->collPricRecargosxCiudadLogs = PricRecargosxCiudadLogPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPricRecargosxCiudadLogCriteria = $criteria;
		return $this->collPricRecargosxCiudadLogs;
	}

	/**
	 * Returns the number of related PricRecargosxCiudadLogs.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countPricRecargosxCiudadLogs($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PricRecargosxCiudadLogPeer::CA_IDRECARGO, $this->getCaIdrecargo());

		return PricRecargosxCiudadLogPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a PricRecargosxCiudadLog object to this object
	 * through the PricRecargosxCiudadLog foreign key attribute
	 *
	 * @param      PricRecargosxCiudadLog $l PricRecargosxCiudadLog
	 * @return     void
	 * @throws     PropelException
	 */
	public function addPricRecargosxCiudadLog(PricRecargosxCiudadLog $l)
	{
		$this->collPricRecargosxCiudadLogs[] = $l;
		$l->setTipoRecargo($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TipoRecargo is new, it will return
	 * an empty collection; or if this TipoRecargo has previously
	 * been saved, it will retrieve related PricRecargosxCiudadLogs from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TipoRecargo.
	 */
	public function getPricRecargosxCiudadLogsJoinCiudad($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxCiudadLogs === null) {
			if ($this->isNew()) {
				$this->collPricRecargosxCiudadLogs = array();
			} else {

				$criteria->add(PricRecargosxCiudadLogPeer::CA_IDRECARGO, $this->getCaIdrecargo());

				$this->collPricRecargosxCiudadLogs = PricRecargosxCiudadLogPeer::doSelectJoinCiudad($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PricRecargosxCiudadLogPeer::CA_IDRECARGO, $this->getCaIdrecargo());

			if (!isset($this->lastPricRecargosxCiudadLogCriteria) || !$this->lastPricRecargosxCiudadLogCriteria->equals($criteria)) {
				$this->collPricRecargosxCiudadLogs = PricRecargosxCiudadLogPeer::doSelectJoinCiudad($criteria, $con);
			}
		}
		$this->lastPricRecargosxCiudadLogCriteria = $criteria;

		return $this->collPricRecargosxCiudadLogs;
	}

	/**
	 * Temporary storage of collRepGastos to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initRepGastos()
	{
		if ($this->collRepGastos === null) {
			$this->collRepGastos = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TipoRecargo has previously
	 * been saved, it will retrieve related RepGastos from storage.
	 * If this TipoRecargo is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getRepGastos($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepGastos === null) {
			if ($this->isNew()) {
			   $this->collRepGastos = array();
			} else {

				$criteria->add(RepGastoPeer::CA_IDRECARGO, $this->getCaIdrecargo());

				RepGastoPeer::addSelectColumns($criteria);
				$this->collRepGastos = RepGastoPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RepGastoPeer::CA_IDRECARGO, $this->getCaIdrecargo());

				RepGastoPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepGastoCriteria) || !$this->lastRepGastoCriteria->equals($criteria)) {
					$this->collRepGastos = RepGastoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepGastoCriteria = $criteria;
		return $this->collRepGastos;
	}

	/**
	 * Returns the number of related RepGastos.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countRepGastos($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RepGastoPeer::CA_IDRECARGO, $this->getCaIdrecargo());

		return RepGastoPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a RepGasto object to this object
	 * through the RepGasto foreign key attribute
	 *
	 * @param      RepGasto $l RepGasto
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRepGasto(RepGasto $l)
	{
		$this->collRepGastos[] = $l;
		$l->setTipoRecargo($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TipoRecargo is new, it will return
	 * an empty collection; or if this TipoRecargo has previously
	 * been saved, it will retrieve related RepGastos from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TipoRecargo.
	 */
	public function getRepGastosJoinReporte($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepGastos === null) {
			if ($this->isNew()) {
				$this->collRepGastos = array();
			} else {

				$criteria->add(RepGastoPeer::CA_IDRECARGO, $this->getCaIdrecargo());

				$this->collRepGastos = RepGastoPeer::doSelectJoinReporte($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RepGastoPeer::CA_IDRECARGO, $this->getCaIdrecargo());

			if (!isset($this->lastRepGastoCriteria) || !$this->lastRepGastoCriteria->equals($criteria)) {
				$this->collRepGastos = RepGastoPeer::doSelectJoinReporte($criteria, $con);
			}
		}
		$this->lastRepGastoCriteria = $criteria;

		return $this->collRepGastos;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TipoRecargo is new, it will return
	 * an empty collection; or if this TipoRecargo has previously
	 * been saved, it will retrieve related RepGastos from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TipoRecargo.
	 */
	public function getRepGastosJoinConcepto($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepGastos === null) {
			if ($this->isNew()) {
				$this->collRepGastos = array();
			} else {

				$criteria->add(RepGastoPeer::CA_IDRECARGO, $this->getCaIdrecargo());

				$this->collRepGastos = RepGastoPeer::doSelectJoinConcepto($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RepGastoPeer::CA_IDRECARGO, $this->getCaIdrecargo());

			if (!isset($this->lastRepGastoCriteria) || !$this->lastRepGastoCriteria->equals($criteria)) {
				$this->collRepGastos = RepGastoPeer::doSelectJoinConcepto($criteria, $con);
			}
		}
		$this->lastRepGastoCriteria = $criteria;

		return $this->collRepGastos;
	}

	/**
	 * Temporary storage of collRecargoFletes to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initRecargoFletes()
	{
		if ($this->collRecargoFletes === null) {
			$this->collRecargoFletes = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TipoRecargo has previously
	 * been saved, it will retrieve related RecargoFletes from storage.
	 * If this TipoRecargo is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getRecargoFletes($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRecargoFletes === null) {
			if ($this->isNew()) {
			   $this->collRecargoFletes = array();
			} else {

				$criteria->add(RecargoFletePeer::CA_IDRECARGO, $this->getCaIdrecargo());

				RecargoFletePeer::addSelectColumns($criteria);
				$this->collRecargoFletes = RecargoFletePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RecargoFletePeer::CA_IDRECARGO, $this->getCaIdrecargo());

				RecargoFletePeer::addSelectColumns($criteria);
				if (!isset($this->lastRecargoFleteCriteria) || !$this->lastRecargoFleteCriteria->equals($criteria)) {
					$this->collRecargoFletes = RecargoFletePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRecargoFleteCriteria = $criteria;
		return $this->collRecargoFletes;
	}

	/**
	 * Returns the number of related RecargoFletes.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countRecargoFletes($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RecargoFletePeer::CA_IDRECARGO, $this->getCaIdrecargo());

		return RecargoFletePeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a RecargoFlete object to this object
	 * through the RecargoFlete foreign key attribute
	 *
	 * @param      RecargoFlete $l RecargoFlete
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRecargoFlete(RecargoFlete $l)
	{
		$this->collRecargoFletes[] = $l;
		$l->setTipoRecargo($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TipoRecargo is new, it will return
	 * an empty collection; or if this TipoRecargo has previously
	 * been saved, it will retrieve related RecargoFletes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TipoRecargo.
	 */
	public function getRecargoFletesJoinFlete($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRecargoFletes === null) {
			if ($this->isNew()) {
				$this->collRecargoFletes = array();
			} else {

				$criteria->add(RecargoFletePeer::CA_IDRECARGO, $this->getCaIdrecargo());

				$this->collRecargoFletes = RecargoFletePeer::doSelectJoinFlete($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RecargoFletePeer::CA_IDRECARGO, $this->getCaIdrecargo());

			if (!isset($this->lastRecargoFleteCriteria) || !$this->lastRecargoFleteCriteria->equals($criteria)) {
				$this->collRecargoFletes = RecargoFletePeer::doSelectJoinFlete($criteria, $con);
			}
		}
		$this->lastRecargoFleteCriteria = $criteria;

		return $this->collRecargoFletes;
	}

	/**
	 * Temporary storage of collRecargoFleteTrafs to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initRecargoFleteTrafs()
	{
		if ($this->collRecargoFleteTrafs === null) {
			$this->collRecargoFleteTrafs = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TipoRecargo has previously
	 * been saved, it will retrieve related RecargoFleteTrafs from storage.
	 * If this TipoRecargo is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getRecargoFleteTrafs($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRecargoFleteTrafs === null) {
			if ($this->isNew()) {
			   $this->collRecargoFleteTrafs = array();
			} else {

				$criteria->add(RecargoFleteTrafPeer::CA_IDRECARGO, $this->getCaIdrecargo());

				RecargoFleteTrafPeer::addSelectColumns($criteria);
				$this->collRecargoFleteTrafs = RecargoFleteTrafPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RecargoFleteTrafPeer::CA_IDRECARGO, $this->getCaIdrecargo());

				RecargoFleteTrafPeer::addSelectColumns($criteria);
				if (!isset($this->lastRecargoFleteTrafCriteria) || !$this->lastRecargoFleteTrafCriteria->equals($criteria)) {
					$this->collRecargoFleteTrafs = RecargoFleteTrafPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRecargoFleteTrafCriteria = $criteria;
		return $this->collRecargoFleteTrafs;
	}

	/**
	 * Returns the number of related RecargoFleteTrafs.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countRecargoFleteTrafs($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RecargoFleteTrafPeer::CA_IDRECARGO, $this->getCaIdrecargo());

		return RecargoFleteTrafPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a RecargoFleteTraf object to this object
	 * through the RecargoFleteTraf foreign key attribute
	 *
	 * @param      RecargoFleteTraf $l RecargoFleteTraf
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRecargoFleteTraf(RecargoFleteTraf $l)
	{
		$this->collRecargoFleteTrafs[] = $l;
		$l->setTipoRecargo($this);
	}

} // BaseTipoRecargo
