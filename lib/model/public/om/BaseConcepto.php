<?php

/**
 * Base class that represents a row from the 'tb_conceptos' table.
 *
 * 
 *
 * @package    lib.model.public.om
 */
abstract class BaseConcepto extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        ConceptoPeer
	 */
	protected static $peer;


	/**
	 * The value for the ca_idconcepto field.
	 * @var        int
	 */
	protected $ca_idconcepto;


	/**
	 * The value for the ca_concepto field.
	 * @var        string
	 */
	protected $ca_concepto;


	/**
	 * The value for the ca_unidad field.
	 * @var        string
	 */
	protected $ca_unidad;


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
	 * The value for the ca_pregunta field.
	 * @var        string
	 */
	protected $ca_pregunta;


	/**
	 * The value for the ca_liminferior field.
	 * @var        int
	 */
	protected $ca_liminferior;

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
	 * Collection to store aggregation of collCotContinuacions.
	 * @var        array
	 */
	protected $collCotContinuacions;

	/**
	 * The criteria used to select the current contents of collCotContinuacions.
	 * @var        Criteria
	 */
	protected $lastCotContinuacionCriteria = null;

	/**
	 * Collection to store aggregation of collPricFletes.
	 * @var        array
	 */
	protected $collPricFletes;

	/**
	 * The criteria used to select the current contents of collPricFletes.
	 * @var        Criteria
	 */
	protected $lastPricFleteCriteria = null;

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
	 * Collection to store aggregation of collRepEquipos.
	 * @var        array
	 */
	protected $collRepEquipos;

	/**
	 * The criteria used to select the current contents of collRepEquipos.
	 * @var        Criteria
	 */
	protected $lastRepEquipoCriteria = null;

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
	 * Collection to store aggregation of collRepTarifas.
	 * @var        array
	 */
	protected $collRepTarifas;

	/**
	 * The criteria used to select the current contents of collRepTarifas.
	 * @var        Criteria
	 */
	protected $lastRepTarifaCriteria = null;

	/**
	 * Collection to store aggregation of collFletes.
	 * @var        array
	 */
	protected $collFletes;

	/**
	 * The criteria used to select the current contents of collFletes.
	 * @var        Criteria
	 */
	protected $lastFleteCriteria = null;

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
	 * Get the [ca_idconcepto] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdconcepto()
	{

		return $this->ca_idconcepto;
	}

	/**
	 * Get the [ca_concepto] column value.
	 * 
	 * @return     string
	 */
	public function getCaConcepto()
	{

		return $this->ca_concepto;
	}

	/**
	 * Get the [ca_unidad] column value.
	 * 
	 * @return     string
	 */
	public function getCaUnidad()
	{

		return $this->ca_unidad;
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
	 * Get the [ca_pregunta] column value.
	 * 
	 * @return     string
	 */
	public function getCaPregunta()
	{

		return $this->ca_pregunta;
	}

	/**
	 * Get the [ca_liminferior] column value.
	 * 
	 * @return     int
	 */
	public function getCaLiminferior()
	{

		return $this->ca_liminferior;
	}

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
			$this->modifiedColumns[] = ConceptoPeer::CA_IDCONCEPTO;
		}

	} // setCaIdconcepto()

	/**
	 * Set the value of [ca_concepto] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaConcepto($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_concepto !== $v) {
			$this->ca_concepto = $v;
			$this->modifiedColumns[] = ConceptoPeer::CA_CONCEPTO;
		}

	} // setCaConcepto()

	/**
	 * Set the value of [ca_unidad] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaUnidad($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_unidad !== $v) {
			$this->ca_unidad = $v;
			$this->modifiedColumns[] = ConceptoPeer::CA_UNIDAD;
		}

	} // setCaUnidad()

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
			$this->modifiedColumns[] = ConceptoPeer::CA_TRANSPORTE;
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
			$this->modifiedColumns[] = ConceptoPeer::CA_MODALIDAD;
		}

	} // setCaModalidad()

	/**
	 * Set the value of [ca_pregunta] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaPregunta($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_pregunta !== $v) {
			$this->ca_pregunta = $v;
			$this->modifiedColumns[] = ConceptoPeer::CA_PREGUNTA;
		}

	} // setCaPregunta()

	/**
	 * Set the value of [ca_liminferior] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaLiminferior($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_liminferior !== $v) {
			$this->ca_liminferior = $v;
			$this->modifiedColumns[] = ConceptoPeer::CA_LIMINFERIOR;
		}

	} // setCaLiminferior()

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

			$this->ca_idconcepto = $rs->getInt($startcol + 0);

			$this->ca_concepto = $rs->getString($startcol + 1);

			$this->ca_unidad = $rs->getString($startcol + 2);

			$this->ca_transporte = $rs->getString($startcol + 3);

			$this->ca_modalidad = $rs->getString($startcol + 4);

			$this->ca_pregunta = $rs->getString($startcol + 5);

			$this->ca_liminferior = $rs->getInt($startcol + 6);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 7; // 7 = ConceptoPeer::NUM_COLUMNS - ConceptoPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Concepto object", $e);
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
			$con = Propel::getConnection(ConceptoPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ConceptoPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(ConceptoPeer::DATABASE_NAME);
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
					$pk = ConceptoPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setCaIdconcepto($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += ConceptoPeer::doUpdate($this, $con);
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

			if ($this->collCotContinuacions !== null) {
				foreach($this->collCotContinuacions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPricFletes !== null) {
				foreach($this->collPricFletes as $referrerFK) {
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

			if ($this->collRepEquipos !== null) {
				foreach($this->collRepEquipos as $referrerFK) {
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

			if ($this->collRepTarifas !== null) {
				foreach($this->collRepTarifas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collFletes !== null) {
				foreach($this->collFletes as $referrerFK) {
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


			if (($retval = ConceptoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collCotOpcions !== null) {
					foreach($this->collCotOpcions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCotContinuacions !== null) {
					foreach($this->collCotContinuacions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPricFletes !== null) {
					foreach($this->collPricFletes as $referrerFK) {
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

				if ($this->collRepEquipos !== null) {
					foreach($this->collRepEquipos as $referrerFK) {
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

				if ($this->collRepTarifas !== null) {
					foreach($this->collRepTarifas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collFletes !== null) {
					foreach($this->collFletes as $referrerFK) {
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
		$pos = ConceptoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdconcepto();
				break;
			case 1:
				return $this->getCaConcepto();
				break;
			case 2:
				return $this->getCaUnidad();
				break;
			case 3:
				return $this->getCaTransporte();
				break;
			case 4:
				return $this->getCaModalidad();
				break;
			case 5:
				return $this->getCaPregunta();
				break;
			case 6:
				return $this->getCaLiminferior();
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
		$keys = ConceptoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdconcepto(),
			$keys[1] => $this->getCaConcepto(),
			$keys[2] => $this->getCaUnidad(),
			$keys[3] => $this->getCaTransporte(),
			$keys[4] => $this->getCaModalidad(),
			$keys[5] => $this->getCaPregunta(),
			$keys[6] => $this->getCaLiminferior(),
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
		$pos = ConceptoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdconcepto($value);
				break;
			case 1:
				$this->setCaConcepto($value);
				break;
			case 2:
				$this->setCaUnidad($value);
				break;
			case 3:
				$this->setCaTransporte($value);
				break;
			case 4:
				$this->setCaModalidad($value);
				break;
			case 5:
				$this->setCaPregunta($value);
				break;
			case 6:
				$this->setCaLiminferior($value);
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
		$keys = ConceptoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdconcepto($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaConcepto($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaUnidad($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaTransporte($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaModalidad($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaPregunta($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaLiminferior($arr[$keys[6]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);

		if ($this->isColumnModified(ConceptoPeer::CA_IDCONCEPTO)) $criteria->add(ConceptoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);
		if ($this->isColumnModified(ConceptoPeer::CA_CONCEPTO)) $criteria->add(ConceptoPeer::CA_CONCEPTO, $this->ca_concepto);
		if ($this->isColumnModified(ConceptoPeer::CA_UNIDAD)) $criteria->add(ConceptoPeer::CA_UNIDAD, $this->ca_unidad);
		if ($this->isColumnModified(ConceptoPeer::CA_TRANSPORTE)) $criteria->add(ConceptoPeer::CA_TRANSPORTE, $this->ca_transporte);
		if ($this->isColumnModified(ConceptoPeer::CA_MODALIDAD)) $criteria->add(ConceptoPeer::CA_MODALIDAD, $this->ca_modalidad);
		if ($this->isColumnModified(ConceptoPeer::CA_PREGUNTA)) $criteria->add(ConceptoPeer::CA_PREGUNTA, $this->ca_pregunta);
		if ($this->isColumnModified(ConceptoPeer::CA_LIMINFERIOR)) $criteria->add(ConceptoPeer::CA_LIMINFERIOR, $this->ca_liminferior);

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
		$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);

		$criteria->add(ConceptoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdconcepto();
	}

	/**
	 * Generic method to set the primary key (ca_idconcepto column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdconcepto($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Concepto (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaConcepto($this->ca_concepto);

		$copyObj->setCaUnidad($this->ca_unidad);

		$copyObj->setCaTransporte($this->ca_transporte);

		$copyObj->setCaModalidad($this->ca_modalidad);

		$copyObj->setCaPregunta($this->ca_pregunta);

		$copyObj->setCaLiminferior($this->ca_liminferior);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getCotOpcions() as $relObj) {
				$copyObj->addCotOpcion($relObj->copy($deepCopy));
			}

			foreach($this->getCotContinuacions() as $relObj) {
				$copyObj->addCotContinuacion($relObj->copy($deepCopy));
			}

			foreach($this->getPricFletes() as $relObj) {
				$copyObj->addPricFlete($relObj->copy($deepCopy));
			}

			foreach($this->getPricRecargoxConceptos() as $relObj) {
				$copyObj->addPricRecargoxConcepto($relObj->copy($deepCopy));
			}

			foreach($this->getRepEquipos() as $relObj) {
				$copyObj->addRepEquipo($relObj->copy($deepCopy));
			}

			foreach($this->getRepGastos() as $relObj) {
				$copyObj->addRepGasto($relObj->copy($deepCopy));
			}

			foreach($this->getRepTarifas() as $relObj) {
				$copyObj->addRepTarifa($relObj->copy($deepCopy));
			}

			foreach($this->getFletes() as $relObj) {
				$copyObj->addFlete($relObj->copy($deepCopy));
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setCaIdconcepto(NULL); // this is a pkey column, so set to default value

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
	 * @return     Concepto Clone of current object.
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
	 * @return     ConceptoPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ConceptoPeer();
		}
		return self::$peer;
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
	 * Otherwise if this Concepto has previously
	 * been saved, it will retrieve related CotOpcions from storage.
	 * If this Concepto is new, it will return
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

				$criteria->add(CotOpcionPeer::CA_IDCONCEPTO, $this->getCaIdconcepto());

				CotOpcionPeer::addSelectColumns($criteria);
				$this->collCotOpcions = CotOpcionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CotOpcionPeer::CA_IDCONCEPTO, $this->getCaIdconcepto());

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

		$criteria->add(CotOpcionPeer::CA_IDCONCEPTO, $this->getCaIdconcepto());

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
		$l->setConcepto($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Concepto is new, it will return
	 * an empty collection; or if this Concepto has previously
	 * been saved, it will retrieve related CotOpcions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Concepto.
	 */
	public function getCotOpcionsJoinCotProducto($criteria = null, $con = null)
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

				$criteria->add(CotOpcionPeer::CA_IDCONCEPTO, $this->getCaIdconcepto());

				$this->collCotOpcions = CotOpcionPeer::doSelectJoinCotProducto($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CotOpcionPeer::CA_IDCONCEPTO, $this->getCaIdconcepto());

			if (!isset($this->lastCotOpcionCriteria) || !$this->lastCotOpcionCriteria->equals($criteria)) {
				$this->collCotOpcions = CotOpcionPeer::doSelectJoinCotProducto($criteria, $con);
			}
		}
		$this->lastCotOpcionCriteria = $criteria;

		return $this->collCotOpcions;
	}

	/**
	 * Temporary storage of collCotContinuacions to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initCotContinuacions()
	{
		if ($this->collCotContinuacions === null) {
			$this->collCotContinuacions = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Concepto has previously
	 * been saved, it will retrieve related CotContinuacions from storage.
	 * If this Concepto is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getCotContinuacions($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotContinuacions === null) {
			if ($this->isNew()) {
			   $this->collCotContinuacions = array();
			} else {

				$criteria->add(CotContinuacionPeer::CA_IDCONCEPTO, $this->getCaIdconcepto());

				CotContinuacionPeer::addSelectColumns($criteria);
				$this->collCotContinuacions = CotContinuacionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CotContinuacionPeer::CA_IDCONCEPTO, $this->getCaIdconcepto());

				CotContinuacionPeer::addSelectColumns($criteria);
				if (!isset($this->lastCotContinuacionCriteria) || !$this->lastCotContinuacionCriteria->equals($criteria)) {
					$this->collCotContinuacions = CotContinuacionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCotContinuacionCriteria = $criteria;
		return $this->collCotContinuacions;
	}

	/**
	 * Returns the number of related CotContinuacions.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countCotContinuacions($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CotContinuacionPeer::CA_IDCONCEPTO, $this->getCaIdconcepto());

		return CotContinuacionPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a CotContinuacion object to this object
	 * through the CotContinuacion foreign key attribute
	 *
	 * @param      CotContinuacion $l CotContinuacion
	 * @return     void
	 * @throws     PropelException
	 */
	public function addCotContinuacion(CotContinuacion $l)
	{
		$this->collCotContinuacions[] = $l;
		$l->setConcepto($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Concepto is new, it will return
	 * an empty collection; or if this Concepto has previously
	 * been saved, it will retrieve related CotContinuacions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Concepto.
	 */
	public function getCotContinuacionsJoinCotizacion($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotContinuacions === null) {
			if ($this->isNew()) {
				$this->collCotContinuacions = array();
			} else {

				$criteria->add(CotContinuacionPeer::CA_IDCONCEPTO, $this->getCaIdconcepto());

				$this->collCotContinuacions = CotContinuacionPeer::doSelectJoinCotizacion($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CotContinuacionPeer::CA_IDCONCEPTO, $this->getCaIdconcepto());

			if (!isset($this->lastCotContinuacionCriteria) || !$this->lastCotContinuacionCriteria->equals($criteria)) {
				$this->collCotContinuacions = CotContinuacionPeer::doSelectJoinCotizacion($criteria, $con);
			}
		}
		$this->lastCotContinuacionCriteria = $criteria;

		return $this->collCotContinuacions;
	}

	/**
	 * Temporary storage of collPricFletes to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initPricFletes()
	{
		if ($this->collPricFletes === null) {
			$this->collPricFletes = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Concepto has previously
	 * been saved, it will retrieve related PricFletes from storage.
	 * If this Concepto is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getPricFletes($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricFletes === null) {
			if ($this->isNew()) {
			   $this->collPricFletes = array();
			} else {

				$criteria->add(PricFletePeer::CA_IDCONCEPTO, $this->getCaIdconcepto());

				PricFletePeer::addSelectColumns($criteria);
				$this->collPricFletes = PricFletePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PricFletePeer::CA_IDCONCEPTO, $this->getCaIdconcepto());

				PricFletePeer::addSelectColumns($criteria);
				if (!isset($this->lastPricFleteCriteria) || !$this->lastPricFleteCriteria->equals($criteria)) {
					$this->collPricFletes = PricFletePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPricFleteCriteria = $criteria;
		return $this->collPricFletes;
	}

	/**
	 * Returns the number of related PricFletes.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countPricFletes($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PricFletePeer::CA_IDCONCEPTO, $this->getCaIdconcepto());

		return PricFletePeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a PricFlete object to this object
	 * through the PricFlete foreign key attribute
	 *
	 * @param      PricFlete $l PricFlete
	 * @return     void
	 * @throws     PropelException
	 */
	public function addPricFlete(PricFlete $l)
	{
		$this->collPricFletes[] = $l;
		$l->setConcepto($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Concepto is new, it will return
	 * an empty collection; or if this Concepto has previously
	 * been saved, it will retrieve related PricFletes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Concepto.
	 */
	public function getPricFletesJoinTrayecto($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricFletes === null) {
			if ($this->isNew()) {
				$this->collPricFletes = array();
			} else {

				$criteria->add(PricFletePeer::CA_IDCONCEPTO, $this->getCaIdconcepto());

				$this->collPricFletes = PricFletePeer::doSelectJoinTrayecto($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PricFletePeer::CA_IDCONCEPTO, $this->getCaIdconcepto());

			if (!isset($this->lastPricFleteCriteria) || !$this->lastPricFleteCriteria->equals($criteria)) {
				$this->collPricFletes = PricFletePeer::doSelectJoinTrayecto($criteria, $con);
			}
		}
		$this->lastPricFleteCriteria = $criteria;

		return $this->collPricFletes;
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
	 * Otherwise if this Concepto has previously
	 * been saved, it will retrieve related PricRecargoxConceptos from storage.
	 * If this Concepto is new, it will return
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

				$criteria->add(PricRecargoxConceptoPeer::CA_IDCONCEPTO, $this->getCaIdconcepto());

				PricRecargoxConceptoPeer::addSelectColumns($criteria);
				$this->collPricRecargoxConceptos = PricRecargoxConceptoPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PricRecargoxConceptoPeer::CA_IDCONCEPTO, $this->getCaIdconcepto());

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

		$criteria->add(PricRecargoxConceptoPeer::CA_IDCONCEPTO, $this->getCaIdconcepto());

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
		$l->setConcepto($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Concepto is new, it will return
	 * an empty collection; or if this Concepto has previously
	 * been saved, it will retrieve related PricRecargoxConceptos from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Concepto.
	 */
	public function getPricRecargoxConceptosJoinTrayecto($criteria = null, $con = null)
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

				$criteria->add(PricRecargoxConceptoPeer::CA_IDCONCEPTO, $this->getCaIdconcepto());

				$this->collPricRecargoxConceptos = PricRecargoxConceptoPeer::doSelectJoinTrayecto($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PricRecargoxConceptoPeer::CA_IDCONCEPTO, $this->getCaIdconcepto());

			if (!isset($this->lastPricRecargoxConceptoCriteria) || !$this->lastPricRecargoxConceptoCriteria->equals($criteria)) {
				$this->collPricRecargoxConceptos = PricRecargoxConceptoPeer::doSelectJoinTrayecto($criteria, $con);
			}
		}
		$this->lastPricRecargoxConceptoCriteria = $criteria;

		return $this->collPricRecargoxConceptos;
	}

	/**
	 * Temporary storage of collRepEquipos to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initRepEquipos()
	{
		if ($this->collRepEquipos === null) {
			$this->collRepEquipos = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Concepto has previously
	 * been saved, it will retrieve related RepEquipos from storage.
	 * If this Concepto is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getRepEquipos($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepEquipos === null) {
			if ($this->isNew()) {
			   $this->collRepEquipos = array();
			} else {

				$criteria->add(RepEquipoPeer::CA_IDCONCEPTO, $this->getCaIdconcepto());

				RepEquipoPeer::addSelectColumns($criteria);
				$this->collRepEquipos = RepEquipoPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RepEquipoPeer::CA_IDCONCEPTO, $this->getCaIdconcepto());

				RepEquipoPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepEquipoCriteria) || !$this->lastRepEquipoCriteria->equals($criteria)) {
					$this->collRepEquipos = RepEquipoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepEquipoCriteria = $criteria;
		return $this->collRepEquipos;
	}

	/**
	 * Returns the number of related RepEquipos.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countRepEquipos($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RepEquipoPeer::CA_IDCONCEPTO, $this->getCaIdconcepto());

		return RepEquipoPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a RepEquipo object to this object
	 * through the RepEquipo foreign key attribute
	 *
	 * @param      RepEquipo $l RepEquipo
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRepEquipo(RepEquipo $l)
	{
		$this->collRepEquipos[] = $l;
		$l->setConcepto($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Concepto is new, it will return
	 * an empty collection; or if this Concepto has previously
	 * been saved, it will retrieve related RepEquipos from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Concepto.
	 */
	public function getRepEquiposJoinReporte($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepEquipos === null) {
			if ($this->isNew()) {
				$this->collRepEquipos = array();
			} else {

				$criteria->add(RepEquipoPeer::CA_IDCONCEPTO, $this->getCaIdconcepto());

				$this->collRepEquipos = RepEquipoPeer::doSelectJoinReporte($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RepEquipoPeer::CA_IDCONCEPTO, $this->getCaIdconcepto());

			if (!isset($this->lastRepEquipoCriteria) || !$this->lastRepEquipoCriteria->equals($criteria)) {
				$this->collRepEquipos = RepEquipoPeer::doSelectJoinReporte($criteria, $con);
			}
		}
		$this->lastRepEquipoCriteria = $criteria;

		return $this->collRepEquipos;
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
	 * Otherwise if this Concepto has previously
	 * been saved, it will retrieve related RepGastos from storage.
	 * If this Concepto is new, it will return
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

				$criteria->add(RepGastoPeer::CA_IDCONCEPTO, $this->getCaIdconcepto());

				RepGastoPeer::addSelectColumns($criteria);
				$this->collRepGastos = RepGastoPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RepGastoPeer::CA_IDCONCEPTO, $this->getCaIdconcepto());

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

		$criteria->add(RepGastoPeer::CA_IDCONCEPTO, $this->getCaIdconcepto());

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
		$l->setConcepto($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Concepto is new, it will return
	 * an empty collection; or if this Concepto has previously
	 * been saved, it will retrieve related RepGastos from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Concepto.
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

				$criteria->add(RepGastoPeer::CA_IDCONCEPTO, $this->getCaIdconcepto());

				$this->collRepGastos = RepGastoPeer::doSelectJoinReporte($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RepGastoPeer::CA_IDCONCEPTO, $this->getCaIdconcepto());

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
	 * Otherwise if this Concepto is new, it will return
	 * an empty collection; or if this Concepto has previously
	 * been saved, it will retrieve related RepGastos from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Concepto.
	 */
	public function getRepGastosJoinTipoRecargo($criteria = null, $con = null)
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

				$criteria->add(RepGastoPeer::CA_IDCONCEPTO, $this->getCaIdconcepto());

				$this->collRepGastos = RepGastoPeer::doSelectJoinTipoRecargo($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RepGastoPeer::CA_IDCONCEPTO, $this->getCaIdconcepto());

			if (!isset($this->lastRepGastoCriteria) || !$this->lastRepGastoCriteria->equals($criteria)) {
				$this->collRepGastos = RepGastoPeer::doSelectJoinTipoRecargo($criteria, $con);
			}
		}
		$this->lastRepGastoCriteria = $criteria;

		return $this->collRepGastos;
	}

	/**
	 * Temporary storage of collRepTarifas to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initRepTarifas()
	{
		if ($this->collRepTarifas === null) {
			$this->collRepTarifas = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Concepto has previously
	 * been saved, it will retrieve related RepTarifas from storage.
	 * If this Concepto is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getRepTarifas($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepTarifas === null) {
			if ($this->isNew()) {
			   $this->collRepTarifas = array();
			} else {

				$criteria->add(RepTarifaPeer::CA_IDCONCEPTO, $this->getCaIdconcepto());

				RepTarifaPeer::addSelectColumns($criteria);
				$this->collRepTarifas = RepTarifaPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RepTarifaPeer::CA_IDCONCEPTO, $this->getCaIdconcepto());

				RepTarifaPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepTarifaCriteria) || !$this->lastRepTarifaCriteria->equals($criteria)) {
					$this->collRepTarifas = RepTarifaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepTarifaCriteria = $criteria;
		return $this->collRepTarifas;
	}

	/**
	 * Returns the number of related RepTarifas.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countRepTarifas($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RepTarifaPeer::CA_IDCONCEPTO, $this->getCaIdconcepto());

		return RepTarifaPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a RepTarifa object to this object
	 * through the RepTarifa foreign key attribute
	 *
	 * @param      RepTarifa $l RepTarifa
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRepTarifa(RepTarifa $l)
	{
		$this->collRepTarifas[] = $l;
		$l->setConcepto($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Concepto is new, it will return
	 * an empty collection; or if this Concepto has previously
	 * been saved, it will retrieve related RepTarifas from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Concepto.
	 */
	public function getRepTarifasJoinReporte($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepTarifas === null) {
			if ($this->isNew()) {
				$this->collRepTarifas = array();
			} else {

				$criteria->add(RepTarifaPeer::CA_IDCONCEPTO, $this->getCaIdconcepto());

				$this->collRepTarifas = RepTarifaPeer::doSelectJoinReporte($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RepTarifaPeer::CA_IDCONCEPTO, $this->getCaIdconcepto());

			if (!isset($this->lastRepTarifaCriteria) || !$this->lastRepTarifaCriteria->equals($criteria)) {
				$this->collRepTarifas = RepTarifaPeer::doSelectJoinReporte($criteria, $con);
			}
		}
		$this->lastRepTarifaCriteria = $criteria;

		return $this->collRepTarifas;
	}

	/**
	 * Temporary storage of collFletes to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initFletes()
	{
		if ($this->collFletes === null) {
			$this->collFletes = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Concepto has previously
	 * been saved, it will retrieve related Fletes from storage.
	 * If this Concepto is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getFletes($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFletes === null) {
			if ($this->isNew()) {
			   $this->collFletes = array();
			} else {

				$criteria->add(FletePeer::CA_IDCONCEPTO, $this->getCaIdconcepto());

				FletePeer::addSelectColumns($criteria);
				$this->collFletes = FletePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(FletePeer::CA_IDCONCEPTO, $this->getCaIdconcepto());

				FletePeer::addSelectColumns($criteria);
				if (!isset($this->lastFleteCriteria) || !$this->lastFleteCriteria->equals($criteria)) {
					$this->collFletes = FletePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFleteCriteria = $criteria;
		return $this->collFletes;
	}

	/**
	 * Returns the number of related Fletes.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countFletes($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(FletePeer::CA_IDCONCEPTO, $this->getCaIdconcepto());

		return FletePeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Flete object to this object
	 * through the Flete foreign key attribute
	 *
	 * @param      Flete $l Flete
	 * @return     void
	 * @throws     PropelException
	 */
	public function addFlete(Flete $l)
	{
		$this->collFletes[] = $l;
		$l->setConcepto($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Concepto is new, it will return
	 * an empty collection; or if this Concepto has previously
	 * been saved, it will retrieve related Fletes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Concepto.
	 */
	public function getFletesJoinTrayecto($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFletes === null) {
			if ($this->isNew()) {
				$this->collFletes = array();
			} else {

				$criteria->add(FletePeer::CA_IDCONCEPTO, $this->getCaIdconcepto());

				$this->collFletes = FletePeer::doSelectJoinTrayecto($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(FletePeer::CA_IDCONCEPTO, $this->getCaIdconcepto());

			if (!isset($this->lastFleteCriteria) || !$this->lastFleteCriteria->equals($criteria)) {
				$this->collFletes = FletePeer::doSelectJoinTrayecto($criteria, $con);
			}
		}
		$this->lastFleteCriteria = $criteria;

		return $this->collFletes;
	}

} // BaseConcepto
