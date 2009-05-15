<?php

/**
 * Base class that represents a row from the 'notificaciones.tb_notificaciones' table.
 *
 * 
 *
 * @package    lib.model.notificaciones.om
 */
abstract class BaseNotificacion extends BaseObject  implements Persistent {


  const PEER = 'NotificacionPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        NotificacionPeer
	 */
	protected static $peer;

	/**
	 * The value for the ca_idnotificacion field.
	 * @var        int
	 */
	protected $ca_idnotificacion;

	/**
	 * The value for the ca_url field.
	 * @var        string
	 */
	protected $ca_url;

	/**
	 * The value for the ca_titulo field.
	 * @var        string
	 */
	protected $ca_titulo;

	/**
	 * The value for the ca_texto field.
	 * @var        string
	 */
	protected $ca_texto;

	/**
	 * The value for the ca_login field.
	 * @var        string
	 */
	protected $ca_login;

	/**
	 * The value for the ca_leido field.
	 * @var        boolean
	 */
	protected $ca_leido;

	/**
	 * The value for the ca_fchcreado field.
	 * @var        string
	 */
	protected $ca_fchcreado;

	/**
	 * The value for the ca_usucreado field.
	 * @var        string
	 */
	protected $ca_usucreado;

	/**
	 * The value for the ca_idemail field.
	 * @var        int
	 */
	protected $ca_idemail;

	/**
	 * @var        Usuario
	 */
	protected $aUsuario;

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
	 * Initializes internal state of BaseNotificacion object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
	}

	/**
	 * Get the [ca_idnotificacion] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdnotificacion()
	{
		return $this->ca_idnotificacion;
	}

	/**
	 * Get the [ca_url] column value.
	 * 
	 * @return     string
	 */
	public function getCaUrl()
	{
		return $this->ca_url;
	}

	/**
	 * Get the [ca_titulo] column value.
	 * 
	 * @return     string
	 */
	public function getCaTitulo()
	{
		return $this->ca_titulo;
	}

	/**
	 * Get the [ca_texto] column value.
	 * 
	 * @return     string
	 */
	public function getCaTexto()
	{
		return $this->ca_texto;
	}

	/**
	 * Get the [ca_login] column value.
	 * 
	 * @return     string
	 */
	public function getCaLogin()
	{
		return $this->ca_login;
	}

	/**
	 * Get the [ca_leido] column value.
	 * 
	 * @return     boolean
	 */
	public function getCaLeido()
	{
		return $this->ca_leido;
	}

	/**
	 * Get the [optionally formatted] temporal [ca_fchcreado] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaFchcreado($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fchcreado === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchcreado);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchcreado, true), $x);
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
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
	 * Get the [ca_idemail] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdemail()
	{
		return $this->ca_idemail;
	}

	/**
	 * Set the value of [ca_idnotificacion] column.
	 * 
	 * @param      int $v new value
	 * @return     Notificacion The current object (for fluent API support)
	 */
	public function setCaIdnotificacion($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idnotificacion !== $v) {
			$this->ca_idnotificacion = $v;
			$this->modifiedColumns[] = NotificacionPeer::CA_IDNOTIFICACION;
		}

		return $this;
	} // setCaIdnotificacion()

	/**
	 * Set the value of [ca_url] column.
	 * 
	 * @param      string $v new value
	 * @return     Notificacion The current object (for fluent API support)
	 */
	public function setCaUrl($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_url !== $v) {
			$this->ca_url = $v;
			$this->modifiedColumns[] = NotificacionPeer::CA_URL;
		}

		return $this;
	} // setCaUrl()

	/**
	 * Set the value of [ca_titulo] column.
	 * 
	 * @param      string $v new value
	 * @return     Notificacion The current object (for fluent API support)
	 */
	public function setCaTitulo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_titulo !== $v) {
			$this->ca_titulo = $v;
			$this->modifiedColumns[] = NotificacionPeer::CA_TITULO;
		}

		return $this;
	} // setCaTitulo()

	/**
	 * Set the value of [ca_texto] column.
	 * 
	 * @param      string $v new value
	 * @return     Notificacion The current object (for fluent API support)
	 */
	public function setCaTexto($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_texto !== $v) {
			$this->ca_texto = $v;
			$this->modifiedColumns[] = NotificacionPeer::CA_TEXTO;
		}

		return $this;
	} // setCaTexto()

	/**
	 * Set the value of [ca_login] column.
	 * 
	 * @param      string $v new value
	 * @return     Notificacion The current object (for fluent API support)
	 */
	public function setCaLogin($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_login !== $v) {
			$this->ca_login = $v;
			$this->modifiedColumns[] = NotificacionPeer::CA_LOGIN;
		}

		if ($this->aUsuario !== null && $this->aUsuario->getCaLogin() !== $v) {
			$this->aUsuario = null;
		}

		return $this;
	} // setCaLogin()

	/**
	 * Set the value of [ca_leido] column.
	 * 
	 * @param      boolean $v new value
	 * @return     Notificacion The current object (for fluent API support)
	 */
	public function setCaLeido($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->ca_leido !== $v) {
			$this->ca_leido = $v;
			$this->modifiedColumns[] = NotificacionPeer::CA_LEIDO;
		}

		return $this;
	} // setCaLeido()

	/**
	 * Sets the value of [ca_fchcreado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     Notificacion The current object (for fluent API support)
	 */
	public function setCaFchcreado($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->ca_fchcreado !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fchcreado !== null && $tmpDt = new DateTime($this->ca_fchcreado)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchcreado = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = NotificacionPeer::CA_FCHCREADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchcreado()

	/**
	 * Set the value of [ca_usucreado] column.
	 * 
	 * @param      string $v new value
	 * @return     Notificacion The current object (for fluent API support)
	 */
	public function setCaUsucreado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usucreado !== $v) {
			$this->ca_usucreado = $v;
			$this->modifiedColumns[] = NotificacionPeer::CA_USUCREADO;
		}

		return $this;
	} // setCaUsucreado()

	/**
	 * Set the value of [ca_idemail] column.
	 * 
	 * @param      int $v new value
	 * @return     Notificacion The current object (for fluent API support)
	 */
	public function setCaIdemail($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idemail !== $v) {
			$this->ca_idemail = $v;
			$this->modifiedColumns[] = NotificacionPeer::CA_IDEMAIL;
		}

		return $this;
	} // setCaIdemail()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
			// First, ensure that we don't have any columns that have been modified which aren't default columns.
			if (array_diff($this->modifiedColumns, array())) {
				return false;
			}

		// otherwise, everything was equal, so return TRUE
		return true;
	} // hasOnlyDefaultValues()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (0-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->ca_idnotificacion = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_url = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_titulo = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_texto = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_login = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_leido = ($row[$startcol + 5] !== null) ? (boolean) $row[$startcol + 5] : null;
			$this->ca_fchcreado = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_usucreado = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_idemail = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 9; // 9 = NotificacionPeer::NUM_COLUMNS - NotificacionPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Notificacion object", $e);
		}
	}

	/**
	 * Checks and repairs the internal consistency of the object.
	 *
	 * This method is executed after an already-instantiated object is re-hydrated
	 * from the database.  It exists to check any foreign keys to make sure that
	 * the objects related to the current object are correct based on foreign key.
	 *
	 * You can override this method in the stub class, but you should always invoke
	 * the base method from the overridden method (i.e. parent::ensureConsistency()),
	 * in case your model changes.
	 *
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

		if ($this->aUsuario !== null && $this->ca_login !== $this->aUsuario->getCaLogin()) {
			$this->aUsuario = null;
		}
	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
	 */
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(NotificacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = NotificacionPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aUsuario = null;
		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(NotificacionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			NotificacionPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Persists this object to the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All modified related objects will also be persisted in the doSave()
	 * method.  This method wraps all precipitate database operations in a
	 * single transaction.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(NotificacionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			NotificacionPeer::addInstanceToPool($this);
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs the work of inserting or updating the row in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aUsuario !== null) {
				if ($this->aUsuario->isModified() || $this->aUsuario->isNew()) {
					$affectedRows += $this->aUsuario->save($con);
				}
				$this->setUsuario($this->aUsuario);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = NotificacionPeer::CA_IDNOTIFICACION;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = NotificacionPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setCaIdnotificacion($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += NotificacionPeer::doUpdate($this, $con);
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

			if ($this->aUsuario !== null) {
				if (!$this->aUsuario->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsuario->getValidationFailures());
				}
			}


			if (($retval = NotificacionPeer::doValidate($this, $columns)) !== true) {
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
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = NotificacionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
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
				return $this->getCaIdnotificacion();
				break;
			case 1:
				return $this->getCaUrl();
				break;
			case 2:
				return $this->getCaTitulo();
				break;
			case 3:
				return $this->getCaTexto();
				break;
			case 4:
				return $this->getCaLogin();
				break;
			case 5:
				return $this->getCaLeido();
				break;
			case 6:
				return $this->getCaFchcreado();
				break;
			case 7:
				return $this->getCaUsucreado();
				break;
			case 8:
				return $this->getCaIdemail();
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
	 * @param      string $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                        BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. Defaults to BasePeer::TYPE_PHPNAME.
	 * @param      boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns.  Defaults to TRUE.
	 * @return     an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = NotificacionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdnotificacion(),
			$keys[1] => $this->getCaUrl(),
			$keys[2] => $this->getCaTitulo(),
			$keys[3] => $this->getCaTexto(),
			$keys[4] => $this->getCaLogin(),
			$keys[5] => $this->getCaLeido(),
			$keys[6] => $this->getCaFchcreado(),
			$keys[7] => $this->getCaUsucreado(),
			$keys[8] => $this->getCaIdemail(),
		);
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = NotificacionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdnotificacion($value);
				break;
			case 1:
				$this->setCaUrl($value);
				break;
			case 2:
				$this->setCaTitulo($value);
				break;
			case 3:
				$this->setCaTexto($value);
				break;
			case 4:
				$this->setCaLogin($value);
				break;
			case 5:
				$this->setCaLeido($value);
				break;
			case 6:
				$this->setCaFchcreado($value);
				break;
			case 7:
				$this->setCaUsucreado($value);
				break;
			case 8:
				$this->setCaIdemail($value);
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
	 * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 * The default key type is the column's phpname (e.g. 'AuthorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = NotificacionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdnotificacion($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaUrl($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaTitulo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaTexto($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaLogin($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaLeido($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaFchcreado($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaUsucreado($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaIdemail($arr[$keys[8]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(NotificacionPeer::DATABASE_NAME);

		if ($this->isColumnModified(NotificacionPeer::CA_IDNOTIFICACION)) $criteria->add(NotificacionPeer::CA_IDNOTIFICACION, $this->ca_idnotificacion);
		if ($this->isColumnModified(NotificacionPeer::CA_URL)) $criteria->add(NotificacionPeer::CA_URL, $this->ca_url);
		if ($this->isColumnModified(NotificacionPeer::CA_TITULO)) $criteria->add(NotificacionPeer::CA_TITULO, $this->ca_titulo);
		if ($this->isColumnModified(NotificacionPeer::CA_TEXTO)) $criteria->add(NotificacionPeer::CA_TEXTO, $this->ca_texto);
		if ($this->isColumnModified(NotificacionPeer::CA_LOGIN)) $criteria->add(NotificacionPeer::CA_LOGIN, $this->ca_login);
		if ($this->isColumnModified(NotificacionPeer::CA_LEIDO)) $criteria->add(NotificacionPeer::CA_LEIDO, $this->ca_leido);
		if ($this->isColumnModified(NotificacionPeer::CA_FCHCREADO)) $criteria->add(NotificacionPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(NotificacionPeer::CA_USUCREADO)) $criteria->add(NotificacionPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(NotificacionPeer::CA_IDEMAIL)) $criteria->add(NotificacionPeer::CA_IDEMAIL, $this->ca_idemail);

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
		$criteria = new Criteria(NotificacionPeer::DATABASE_NAME);

		$criteria->add(NotificacionPeer::CA_IDNOTIFICACION, $this->ca_idnotificacion);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdnotificacion();
	}

	/**
	 * Generic method to set the primary key (ca_idnotificacion column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdnotificacion($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Notificacion (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaUrl($this->ca_url);

		$copyObj->setCaTitulo($this->ca_titulo);

		$copyObj->setCaTexto($this->ca_texto);

		$copyObj->setCaLogin($this->ca_login);

		$copyObj->setCaLeido($this->ca_leido);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaIdemail($this->ca_idemail);


		$copyObj->setNew(true);

		$copyObj->setCaIdnotificacion(NULL); // this is a auto-increment column, so set to default value

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
	 * @return     Notificacion Clone of current object.
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
	 * @return     NotificacionPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new NotificacionPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Usuario object.
	 *
	 * @param      Usuario $v
	 * @return     Notificacion The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setUsuario(Usuario $v = null)
	{
		if ($v === null) {
			$this->setCaLogin(NULL);
		} else {
			$this->setCaLogin($v->getCaLogin());
		}

		$this->aUsuario = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Usuario object, it will not be re-added.
		if ($v !== null) {
			$v->addNotificacion($this);
		}

		return $this;
	}


	/**
	 * Get the associated Usuario object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Usuario The associated Usuario object.
	 * @throws     PropelException
	 */
	public function getUsuario(PropelPDO $con = null)
	{
		if ($this->aUsuario === null && (($this->ca_login !== "" && $this->ca_login !== null))) {
			$c = new Criteria(UsuarioPeer::DATABASE_NAME);
			$c->add(UsuarioPeer::CA_LOGIN, $this->ca_login);
			$this->aUsuario = UsuarioPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aUsuario->addNotificacions($this);
			 */
		}
		return $this->aUsuario;
	}

	/**
	 * Resets all collections of referencing foreign keys.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect objects
	 * with circular references.  This is currently necessary when using Propel in certain
	 * daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all associated objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} // if ($deep)

			$this->aUsuario = null;
	}

} // BaseNotificacion
