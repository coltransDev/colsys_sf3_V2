<?php

/**
 * Base class that represents a row from the 'tb_repseguro' table.
 *
 * 
 *
 * @package    lib.model.reportes.om
 */
abstract class BaseRepSeguro extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        RepSeguroPeer
	 */
	protected static $peer;


	/**
	 * The value for the ca_idreporte field.
	 * @var        int
	 */
	protected $ca_idreporte;


	/**
	 * The value for the ca_vlrasegurado field.
	 * @var        double
	 */
	protected $ca_vlrasegurado;


	/**
	 * The value for the ca_idmoneda_vlr field.
	 * @var        string
	 */
	protected $ca_idmoneda_vlr;


	/**
	 * The value for the ca_primaventa field.
	 * @var        double
	 */
	protected $ca_primaventa;


	/**
	 * The value for the ca_minimaventa field.
	 * @var        double
	 */
	protected $ca_minimaventa;


	/**
	 * The value for the ca_idmoneda_vta field.
	 * @var        string
	 */
	protected $ca_idmoneda_vta;


	/**
	 * The value for the ca_obtencionpoliza field.
	 * @var        double
	 */
	protected $ca_obtencionpoliza;


	/**
	 * The value for the ca_idmoneda_pol field.
	 * @var        string
	 */
	protected $ca_idmoneda_pol;


	/**
	 * The value for the ca_seguro_conf field.
	 * @var        string
	 */
	protected $ca_seguro_conf;

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
	 * Get the [ca_vlrasegurado] column value.
	 * 
	 * @return     double
	 */
	public function getCaVlrasegurado()
	{

		return $this->ca_vlrasegurado;
	}

	/**
	 * Get the [ca_idmoneda_vlr] column value.
	 * 
	 * @return     string
	 */
	public function getCaIdmonedaVlr()
	{

		return $this->ca_idmoneda_vlr;
	}

	/**
	 * Get the [ca_primaventa] column value.
	 * 
	 * @return     double
	 */
	public function getCaPrimaventa()
	{

		return $this->ca_primaventa;
	}

	/**
	 * Get the [ca_minimaventa] column value.
	 * 
	 * @return     double
	 */
	public function getCaMinimaventa()
	{

		return $this->ca_minimaventa;
	}

	/**
	 * Get the [ca_idmoneda_vta] column value.
	 * 
	 * @return     string
	 */
	public function getCaIdmonedaVta()
	{

		return $this->ca_idmoneda_vta;
	}

	/**
	 * Get the [ca_obtencionpoliza] column value.
	 * 
	 * @return     double
	 */
	public function getCaObtencionpoliza()
	{

		return $this->ca_obtencionpoliza;
	}

	/**
	 * Get the [ca_idmoneda_pol] column value.
	 * 
	 * @return     string
	 */
	public function getCaIdmonedaPol()
	{

		return $this->ca_idmoneda_pol;
	}

	/**
	 * Get the [ca_seguro_conf] column value.
	 * 
	 * @return     string
	 */
	public function getCaSeguroConf()
	{

		return $this->ca_seguro_conf;
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
			$this->modifiedColumns[] = RepSeguroPeer::CA_IDREPORTE;
		}

		if ($this->aReporte !== null && $this->aReporte->getCaIdreporte() !== $v) {
			$this->aReporte = null;
		}

	} // setCaIdreporte()

	/**
	 * Set the value of [ca_vlrasegurado] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaVlrasegurado($v)
	{

		if ($this->ca_vlrasegurado !== $v) {
			$this->ca_vlrasegurado = $v;
			$this->modifiedColumns[] = RepSeguroPeer::CA_VLRASEGURADO;
		}

	} // setCaVlrasegurado()

	/**
	 * Set the value of [ca_idmoneda_vlr] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaIdmonedaVlr($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_idmoneda_vlr !== $v) {
			$this->ca_idmoneda_vlr = $v;
			$this->modifiedColumns[] = RepSeguroPeer::CA_IDMONEDA_VLR;
		}

	} // setCaIdmonedaVlr()

	/**
	 * Set the value of [ca_primaventa] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaPrimaventa($v)
	{

		if ($this->ca_primaventa !== $v) {
			$this->ca_primaventa = $v;
			$this->modifiedColumns[] = RepSeguroPeer::CA_PRIMAVENTA;
		}

	} // setCaPrimaventa()

	/**
	 * Set the value of [ca_minimaventa] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaMinimaventa($v)
	{

		if ($this->ca_minimaventa !== $v) {
			$this->ca_minimaventa = $v;
			$this->modifiedColumns[] = RepSeguroPeer::CA_MINIMAVENTA;
		}

	} // setCaMinimaventa()

	/**
	 * Set the value of [ca_idmoneda_vta] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaIdmonedaVta($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_idmoneda_vta !== $v) {
			$this->ca_idmoneda_vta = $v;
			$this->modifiedColumns[] = RepSeguroPeer::CA_IDMONEDA_VTA;
		}

	} // setCaIdmonedaVta()

	/**
	 * Set the value of [ca_obtencionpoliza] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaObtencionpoliza($v)
	{

		if ($this->ca_obtencionpoliza !== $v) {
			$this->ca_obtencionpoliza = $v;
			$this->modifiedColumns[] = RepSeguroPeer::CA_OBTENCIONPOLIZA;
		}

	} // setCaObtencionpoliza()

	/**
	 * Set the value of [ca_idmoneda_pol] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaIdmonedaPol($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_idmoneda_pol !== $v) {
			$this->ca_idmoneda_pol = $v;
			$this->modifiedColumns[] = RepSeguroPeer::CA_IDMONEDA_POL;
		}

	} // setCaIdmonedaPol()

	/**
	 * Set the value of [ca_seguro_conf] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaSeguroConf($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_seguro_conf !== $v) {
			$this->ca_seguro_conf = $v;
			$this->modifiedColumns[] = RepSeguroPeer::CA_SEGURO_CONF;
		}

	} // setCaSeguroConf()

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

			$this->ca_vlrasegurado = $rs->getFloat($startcol + 1);

			$this->ca_idmoneda_vlr = $rs->getString($startcol + 2);

			$this->ca_primaventa = $rs->getFloat($startcol + 3);

			$this->ca_minimaventa = $rs->getFloat($startcol + 4);

			$this->ca_idmoneda_vta = $rs->getString($startcol + 5);

			$this->ca_obtencionpoliza = $rs->getFloat($startcol + 6);

			$this->ca_idmoneda_pol = $rs->getString($startcol + 7);

			$this->ca_seguro_conf = $rs->getString($startcol + 8);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 9; // 9 = RepSeguroPeer::NUM_COLUMNS - RepSeguroPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating RepSeguro object", $e);
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
			$con = Propel::getConnection(RepSeguroPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			RepSeguroPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(RepSeguroPeer::DATABASE_NAME);
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
					$pk = RepSeguroPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += RepSeguroPeer::doUpdate($this, $con);
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


			if (($retval = RepSeguroPeer::doValidate($this, $columns)) !== true) {
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
		$pos = RepSeguroPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaVlrasegurado();
				break;
			case 2:
				return $this->getCaIdmonedaVlr();
				break;
			case 3:
				return $this->getCaPrimaventa();
				break;
			case 4:
				return $this->getCaMinimaventa();
				break;
			case 5:
				return $this->getCaIdmonedaVta();
				break;
			case 6:
				return $this->getCaObtencionpoliza();
				break;
			case 7:
				return $this->getCaIdmonedaPol();
				break;
			case 8:
				return $this->getCaSeguroConf();
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
		$keys = RepSeguroPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdreporte(),
			$keys[1] => $this->getCaVlrasegurado(),
			$keys[2] => $this->getCaIdmonedaVlr(),
			$keys[3] => $this->getCaPrimaventa(),
			$keys[4] => $this->getCaMinimaventa(),
			$keys[5] => $this->getCaIdmonedaVta(),
			$keys[6] => $this->getCaObtencionpoliza(),
			$keys[7] => $this->getCaIdmonedaPol(),
			$keys[8] => $this->getCaSeguroConf(),
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
		$pos = RepSeguroPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaVlrasegurado($value);
				break;
			case 2:
				$this->setCaIdmonedaVlr($value);
				break;
			case 3:
				$this->setCaPrimaventa($value);
				break;
			case 4:
				$this->setCaMinimaventa($value);
				break;
			case 5:
				$this->setCaIdmonedaVta($value);
				break;
			case 6:
				$this->setCaObtencionpoliza($value);
				break;
			case 7:
				$this->setCaIdmonedaPol($value);
				break;
			case 8:
				$this->setCaSeguroConf($value);
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
		$keys = RepSeguroPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdreporte($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaVlrasegurado($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaIdmonedaVlr($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaPrimaventa($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaMinimaventa($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaIdmonedaVta($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaObtencionpoliza($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaIdmonedaPol($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaSeguroConf($arr[$keys[8]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(RepSeguroPeer::DATABASE_NAME);

		if ($this->isColumnModified(RepSeguroPeer::CA_IDREPORTE)) $criteria->add(RepSeguroPeer::CA_IDREPORTE, $this->ca_idreporte);
		if ($this->isColumnModified(RepSeguroPeer::CA_VLRASEGURADO)) $criteria->add(RepSeguroPeer::CA_VLRASEGURADO, $this->ca_vlrasegurado);
		if ($this->isColumnModified(RepSeguroPeer::CA_IDMONEDA_VLR)) $criteria->add(RepSeguroPeer::CA_IDMONEDA_VLR, $this->ca_idmoneda_vlr);
		if ($this->isColumnModified(RepSeguroPeer::CA_PRIMAVENTA)) $criteria->add(RepSeguroPeer::CA_PRIMAVENTA, $this->ca_primaventa);
		if ($this->isColumnModified(RepSeguroPeer::CA_MINIMAVENTA)) $criteria->add(RepSeguroPeer::CA_MINIMAVENTA, $this->ca_minimaventa);
		if ($this->isColumnModified(RepSeguroPeer::CA_IDMONEDA_VTA)) $criteria->add(RepSeguroPeer::CA_IDMONEDA_VTA, $this->ca_idmoneda_vta);
		if ($this->isColumnModified(RepSeguroPeer::CA_OBTENCIONPOLIZA)) $criteria->add(RepSeguroPeer::CA_OBTENCIONPOLIZA, $this->ca_obtencionpoliza);
		if ($this->isColumnModified(RepSeguroPeer::CA_IDMONEDA_POL)) $criteria->add(RepSeguroPeer::CA_IDMONEDA_POL, $this->ca_idmoneda_pol);
		if ($this->isColumnModified(RepSeguroPeer::CA_SEGURO_CONF)) $criteria->add(RepSeguroPeer::CA_SEGURO_CONF, $this->ca_seguro_conf);

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
		$criteria = new Criteria(RepSeguroPeer::DATABASE_NAME);

		$criteria->add(RepSeguroPeer::CA_IDREPORTE, $this->ca_idreporte);

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
	 * @param      object $copyObj An object of RepSeguro (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaVlrasegurado($this->ca_vlrasegurado);

		$copyObj->setCaIdmonedaVlr($this->ca_idmoneda_vlr);

		$copyObj->setCaPrimaventa($this->ca_primaventa);

		$copyObj->setCaMinimaventa($this->ca_minimaventa);

		$copyObj->setCaIdmonedaVta($this->ca_idmoneda_vta);

		$copyObj->setCaObtencionpoliza($this->ca_obtencionpoliza);

		$copyObj->setCaIdmonedaPol($this->ca_idmoneda_pol);

		$copyObj->setCaSeguroConf($this->ca_seguro_conf);


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
	 * @return     RepSeguro Clone of current object.
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
	 * @return     RepSeguroPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new RepSeguroPeer();
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

} // BaseRepSeguro
