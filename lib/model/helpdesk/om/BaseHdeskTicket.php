<?php

/**
 * Base class that represents a row from the 'helpdesk.tb_tickets' table.
 *
 * 
 *
 * @package    lib.model.helpdesk.om
 */
abstract class BaseHdeskTicket extends BaseObject  implements Persistent {


  const PEER = 'HdeskTicketPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        HdeskTicketPeer
	 */
	protected static $peer;

	/**
	 * The value for the ca_idticket field.
	 * @var        int
	 */
	protected $ca_idticket;

	/**
	 * The value for the ca_idgroup field.
	 * @var        int
	 */
	protected $ca_idgroup;

	/**
	 * The value for the ca_idproject field.
	 * @var        int
	 */
	protected $ca_idproject;

	/**
	 * The value for the ca_login field.
	 * @var        string
	 */
	protected $ca_login;

	/**
	 * The value for the ca_title field.
	 * @var        string
	 */
	protected $ca_title;

	/**
	 * The value for the ca_text field.
	 * @var        string
	 */
	protected $ca_text;

	/**
	 * The value for the ca_priority field.
	 * @var        string
	 */
	protected $ca_priority;

	/**
	 * The value for the ca_opened field.
	 * @var        string
	 */
	protected $ca_opened;

	/**
	 * The value for the ca_type field.
	 * @var        string
	 */
	protected $ca_type;

	/**
	 * The value for the ca_assignedto field.
	 * @var        string
	 */
	protected $ca_assignedto;

	/**
	 * The value for the ca_action field.
	 * @var        string
	 */
	protected $ca_action;

	/**
	 * The value for the ca_responsetime field.
	 * @var        string
	 */
	protected $ca_responsetime;

	/**
	 * The value for the ca_idtarea field.
	 * @var        int
	 */
	protected $ca_idtarea;

	/**
	 * @var        HdeskGroup
	 */
	protected $aHdeskGroup;

	/**
	 * @var        Usuario
	 */
	protected $aUsuario;

	/**
	 * @var        HdeskProject
	 */
	protected $aHdeskProject;

	/**
	 * @var        NotTarea
	 */
	protected $aNotTarea;

	/**
	 * @var        array HdeskResponse[] Collection to store aggregation of HdeskResponse objects.
	 */
	protected $collHdeskResponses;

	/**
	 * @var        Criteria The criteria used to select the current contents of collHdeskResponses.
	 */
	private $lastHdeskResponseCriteria = null;

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
	 * Initializes internal state of BaseHdeskTicket object.
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
	 * Get the [ca_idticket] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdticket()
	{
		return $this->ca_idticket;
	}

	/**
	 * Get the [ca_idgroup] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdgroup()
	{
		return $this->ca_idgroup;
	}

	/**
	 * Get the [ca_idproject] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdproject()
	{
		return $this->ca_idproject;
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
	 * Get the [ca_title] column value.
	 * 
	 * @return     string
	 */
	public function getCaTitle()
	{
		return $this->ca_title;
	}

	/**
	 * Get the [ca_text] column value.
	 * 
	 * @return     string
	 */
	public function getCaText()
	{
		return $this->ca_text;
	}

	/**
	 * Get the [ca_priority] column value.
	 * 
	 * @return     string
	 */
	public function getCaPriority()
	{
		return $this->ca_priority;
	}

	/**
	 * Get the [optionally formatted] temporal [ca_opened] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaOpened($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_opened === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_opened);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_opened, true), $x);
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
	 * Get the [ca_type] column value.
	 * 
	 * @return     string
	 */
	public function getCaType()
	{
		return $this->ca_type;
	}

	/**
	 * Get the [ca_assignedto] column value.
	 * 
	 * @return     string
	 */
	public function getCaAssignedto()
	{
		return $this->ca_assignedto;
	}

	/**
	 * Get the [ca_action] column value.
	 * 
	 * @return     string
	 */
	public function getCaAction()
	{
		return $this->ca_action;
	}

	/**
	 * Get the [optionally formatted] temporal [ca_responsetime] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaResponsetime($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_responsetime === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_responsetime);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_responsetime, true), $x);
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
	 * Get the [ca_idtarea] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdtarea()
	{
		return $this->ca_idtarea;
	}

	/**
	 * Set the value of [ca_idticket] column.
	 * 
	 * @param      int $v new value
	 * @return     HdeskTicket The current object (for fluent API support)
	 */
	public function setCaIdticket($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idticket !== $v) {
			$this->ca_idticket = $v;
			$this->modifiedColumns[] = HdeskTicketPeer::CA_IDTICKET;
		}

		return $this;
	} // setCaIdticket()

	/**
	 * Set the value of [ca_idgroup] column.
	 * 
	 * @param      int $v new value
	 * @return     HdeskTicket The current object (for fluent API support)
	 */
	public function setCaIdgroup($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idgroup !== $v) {
			$this->ca_idgroup = $v;
			$this->modifiedColumns[] = HdeskTicketPeer::CA_IDGROUP;
		}

		if ($this->aHdeskGroup !== null && $this->aHdeskGroup->getCaIdgroup() !== $v) {
			$this->aHdeskGroup = null;
		}

		return $this;
	} // setCaIdgroup()

	/**
	 * Set the value of [ca_idproject] column.
	 * 
	 * @param      int $v new value
	 * @return     HdeskTicket The current object (for fluent API support)
	 */
	public function setCaIdproject($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idproject !== $v) {
			$this->ca_idproject = $v;
			$this->modifiedColumns[] = HdeskTicketPeer::CA_IDPROJECT;
		}

		if ($this->aHdeskProject !== null && $this->aHdeskProject->getCaIdproject() !== $v) {
			$this->aHdeskProject = null;
		}

		return $this;
	} // setCaIdproject()

	/**
	 * Set the value of [ca_login] column.
	 * 
	 * @param      string $v new value
	 * @return     HdeskTicket The current object (for fluent API support)
	 */
	public function setCaLogin($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_login !== $v) {
			$this->ca_login = $v;
			$this->modifiedColumns[] = HdeskTicketPeer::CA_LOGIN;
		}

		if ($this->aUsuario !== null && $this->aUsuario->getCaLogin() !== $v) {
			$this->aUsuario = null;
		}

		return $this;
	} // setCaLogin()

	/**
	 * Set the value of [ca_title] column.
	 * 
	 * @param      string $v new value
	 * @return     HdeskTicket The current object (for fluent API support)
	 */
	public function setCaTitle($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_title !== $v) {
			$this->ca_title = $v;
			$this->modifiedColumns[] = HdeskTicketPeer::CA_TITLE;
		}

		return $this;
	} // setCaTitle()

	/**
	 * Set the value of [ca_text] column.
	 * 
	 * @param      string $v new value
	 * @return     HdeskTicket The current object (for fluent API support)
	 */
	public function setCaText($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_text !== $v) {
			$this->ca_text = $v;
			$this->modifiedColumns[] = HdeskTicketPeer::CA_TEXT;
		}

		return $this;
	} // setCaText()

	/**
	 * Set the value of [ca_priority] column.
	 * 
	 * @param      string $v new value
	 * @return     HdeskTicket The current object (for fluent API support)
	 */
	public function setCaPriority($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_priority !== $v) {
			$this->ca_priority = $v;
			$this->modifiedColumns[] = HdeskTicketPeer::CA_PRIORITY;
		}

		return $this;
	} // setCaPriority()

	/**
	 * Sets the value of [ca_opened] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     HdeskTicket The current object (for fluent API support)
	 */
	public function setCaOpened($v)
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

		if ( $this->ca_opened !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_opened !== null && $tmpDt = new DateTime($this->ca_opened)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_opened = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = HdeskTicketPeer::CA_OPENED;
			}
		} // if either are not null

		return $this;
	} // setCaOpened()

	/**
	 * Set the value of [ca_type] column.
	 * 
	 * @param      string $v new value
	 * @return     HdeskTicket The current object (for fluent API support)
	 */
	public function setCaType($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_type !== $v) {
			$this->ca_type = $v;
			$this->modifiedColumns[] = HdeskTicketPeer::CA_TYPE;
		}

		return $this;
	} // setCaType()

	/**
	 * Set the value of [ca_assignedto] column.
	 * 
	 * @param      string $v new value
	 * @return     HdeskTicket The current object (for fluent API support)
	 */
	public function setCaAssignedto($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_assignedto !== $v) {
			$this->ca_assignedto = $v;
			$this->modifiedColumns[] = HdeskTicketPeer::CA_ASSIGNEDTO;
		}

		return $this;
	} // setCaAssignedto()

	/**
	 * Set the value of [ca_action] column.
	 * 
	 * @param      string $v new value
	 * @return     HdeskTicket The current object (for fluent API support)
	 */
	public function setCaAction($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_action !== $v) {
			$this->ca_action = $v;
			$this->modifiedColumns[] = HdeskTicketPeer::CA_ACTION;
		}

		return $this;
	} // setCaAction()

	/**
	 * Sets the value of [ca_responsetime] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     HdeskTicket The current object (for fluent API support)
	 */
	public function setCaResponsetime($v)
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

		if ( $this->ca_responsetime !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_responsetime !== null && $tmpDt = new DateTime($this->ca_responsetime)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_responsetime = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = HdeskTicketPeer::CA_RESPONSETIME;
			}
		} // if either are not null

		return $this;
	} // setCaResponsetime()

	/**
	 * Set the value of [ca_idtarea] column.
	 * 
	 * @param      int $v new value
	 * @return     HdeskTicket The current object (for fluent API support)
	 */
	public function setCaIdtarea($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idtarea !== $v) {
			$this->ca_idtarea = $v;
			$this->modifiedColumns[] = HdeskTicketPeer::CA_IDTAREA;
		}

		if ($this->aNotTarea !== null && $this->aNotTarea->getCaIdtarea() !== $v) {
			$this->aNotTarea = null;
		}

		return $this;
	} // setCaIdtarea()

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

			$this->ca_idticket = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_idgroup = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_idproject = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->ca_login = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_title = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_text = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_priority = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_opened = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_type = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_assignedto = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_action = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_responsetime = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_idtarea = ($row[$startcol + 12] !== null) ? (int) $row[$startcol + 12] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 13; // 13 = HdeskTicketPeer::NUM_COLUMNS - HdeskTicketPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating HdeskTicket object", $e);
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

		if ($this->aHdeskGroup !== null && $this->ca_idgroup !== $this->aHdeskGroup->getCaIdgroup()) {
			$this->aHdeskGroup = null;
		}
		if ($this->aHdeskProject !== null && $this->ca_idproject !== $this->aHdeskProject->getCaIdproject()) {
			$this->aHdeskProject = null;
		}
		if ($this->aUsuario !== null && $this->ca_login !== $this->aUsuario->getCaLogin()) {
			$this->aUsuario = null;
		}
		if ($this->aNotTarea !== null && $this->ca_idtarea !== $this->aNotTarea->getCaIdtarea()) {
			$this->aNotTarea = null;
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
			$con = Propel::getConnection(HdeskTicketPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = HdeskTicketPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aHdeskGroup = null;
			$this->aUsuario = null;
			$this->aHdeskProject = null;
			$this->aNotTarea = null;
			$this->collHdeskResponses = null;
			$this->lastHdeskResponseCriteria = null;

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
			$con = Propel::getConnection(HdeskTicketPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			HdeskTicketPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(HdeskTicketPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			HdeskTicketPeer::addInstanceToPool($this);
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

			if ($this->aHdeskGroup !== null) {
				if ($this->aHdeskGroup->isModified() || $this->aHdeskGroup->isNew()) {
					$affectedRows += $this->aHdeskGroup->save($con);
				}
				$this->setHdeskGroup($this->aHdeskGroup);
			}

			if ($this->aUsuario !== null) {
				if ($this->aUsuario->isModified() || $this->aUsuario->isNew()) {
					$affectedRows += $this->aUsuario->save($con);
				}
				$this->setUsuario($this->aUsuario);
			}

			if ($this->aHdeskProject !== null) {
				if ($this->aHdeskProject->isModified() || $this->aHdeskProject->isNew()) {
					$affectedRows += $this->aHdeskProject->save($con);
				}
				$this->setHdeskProject($this->aHdeskProject);
			}

			if ($this->aNotTarea !== null) {
				if ($this->aNotTarea->isModified() || $this->aNotTarea->isNew()) {
					$affectedRows += $this->aNotTarea->save($con);
				}
				$this->setNotTarea($this->aNotTarea);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = HdeskTicketPeer::CA_IDTICKET;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = HdeskTicketPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setCaIdticket($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += HdeskTicketPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collHdeskResponses !== null) {
				foreach ($this->collHdeskResponses as $referrerFK) {
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


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aHdeskGroup !== null) {
				if (!$this->aHdeskGroup->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aHdeskGroup->getValidationFailures());
				}
			}

			if ($this->aUsuario !== null) {
				if (!$this->aUsuario->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsuario->getValidationFailures());
				}
			}

			if ($this->aHdeskProject !== null) {
				if (!$this->aHdeskProject->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aHdeskProject->getValidationFailures());
				}
			}

			if ($this->aNotTarea !== null) {
				if (!$this->aNotTarea->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aNotTarea->getValidationFailures());
				}
			}


			if (($retval = HdeskTicketPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collHdeskResponses !== null) {
					foreach ($this->collHdeskResponses as $referrerFK) {
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
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = HdeskTicketPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdticket();
				break;
			case 1:
				return $this->getCaIdgroup();
				break;
			case 2:
				return $this->getCaIdproject();
				break;
			case 3:
				return $this->getCaLogin();
				break;
			case 4:
				return $this->getCaTitle();
				break;
			case 5:
				return $this->getCaText();
				break;
			case 6:
				return $this->getCaPriority();
				break;
			case 7:
				return $this->getCaOpened();
				break;
			case 8:
				return $this->getCaType();
				break;
			case 9:
				return $this->getCaAssignedto();
				break;
			case 10:
				return $this->getCaAction();
				break;
			case 11:
				return $this->getCaResponsetime();
				break;
			case 12:
				return $this->getCaIdtarea();
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
		$keys = HdeskTicketPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdticket(),
			$keys[1] => $this->getCaIdgroup(),
			$keys[2] => $this->getCaIdproject(),
			$keys[3] => $this->getCaLogin(),
			$keys[4] => $this->getCaTitle(),
			$keys[5] => $this->getCaText(),
			$keys[6] => $this->getCaPriority(),
			$keys[7] => $this->getCaOpened(),
			$keys[8] => $this->getCaType(),
			$keys[9] => $this->getCaAssignedto(),
			$keys[10] => $this->getCaAction(),
			$keys[11] => $this->getCaResponsetime(),
			$keys[12] => $this->getCaIdtarea(),
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
		$pos = HdeskTicketPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdticket($value);
				break;
			case 1:
				$this->setCaIdgroup($value);
				break;
			case 2:
				$this->setCaIdproject($value);
				break;
			case 3:
				$this->setCaLogin($value);
				break;
			case 4:
				$this->setCaTitle($value);
				break;
			case 5:
				$this->setCaText($value);
				break;
			case 6:
				$this->setCaPriority($value);
				break;
			case 7:
				$this->setCaOpened($value);
				break;
			case 8:
				$this->setCaType($value);
				break;
			case 9:
				$this->setCaAssignedto($value);
				break;
			case 10:
				$this->setCaAction($value);
				break;
			case 11:
				$this->setCaResponsetime($value);
				break;
			case 12:
				$this->setCaIdtarea($value);
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
		$keys = HdeskTicketPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdticket($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdgroup($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaIdproject($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaLogin($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaTitle($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaText($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaPriority($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaOpened($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaType($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaAssignedto($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaAction($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaResponsetime($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaIdtarea($arr[$keys[12]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(HdeskTicketPeer::DATABASE_NAME);

		if ($this->isColumnModified(HdeskTicketPeer::CA_IDTICKET)) $criteria->add(HdeskTicketPeer::CA_IDTICKET, $this->ca_idticket);
		if ($this->isColumnModified(HdeskTicketPeer::CA_IDGROUP)) $criteria->add(HdeskTicketPeer::CA_IDGROUP, $this->ca_idgroup);
		if ($this->isColumnModified(HdeskTicketPeer::CA_IDPROJECT)) $criteria->add(HdeskTicketPeer::CA_IDPROJECT, $this->ca_idproject);
		if ($this->isColumnModified(HdeskTicketPeer::CA_LOGIN)) $criteria->add(HdeskTicketPeer::CA_LOGIN, $this->ca_login);
		if ($this->isColumnModified(HdeskTicketPeer::CA_TITLE)) $criteria->add(HdeskTicketPeer::CA_TITLE, $this->ca_title);
		if ($this->isColumnModified(HdeskTicketPeer::CA_TEXT)) $criteria->add(HdeskTicketPeer::CA_TEXT, $this->ca_text);
		if ($this->isColumnModified(HdeskTicketPeer::CA_PRIORITY)) $criteria->add(HdeskTicketPeer::CA_PRIORITY, $this->ca_priority);
		if ($this->isColumnModified(HdeskTicketPeer::CA_OPENED)) $criteria->add(HdeskTicketPeer::CA_OPENED, $this->ca_opened);
		if ($this->isColumnModified(HdeskTicketPeer::CA_TYPE)) $criteria->add(HdeskTicketPeer::CA_TYPE, $this->ca_type);
		if ($this->isColumnModified(HdeskTicketPeer::CA_ASSIGNEDTO)) $criteria->add(HdeskTicketPeer::CA_ASSIGNEDTO, $this->ca_assignedto);
		if ($this->isColumnModified(HdeskTicketPeer::CA_ACTION)) $criteria->add(HdeskTicketPeer::CA_ACTION, $this->ca_action);
		if ($this->isColumnModified(HdeskTicketPeer::CA_RESPONSETIME)) $criteria->add(HdeskTicketPeer::CA_RESPONSETIME, $this->ca_responsetime);
		if ($this->isColumnModified(HdeskTicketPeer::CA_IDTAREA)) $criteria->add(HdeskTicketPeer::CA_IDTAREA, $this->ca_idtarea);

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
		$criteria = new Criteria(HdeskTicketPeer::DATABASE_NAME);

		$criteria->add(HdeskTicketPeer::CA_IDTICKET, $this->ca_idticket);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdticket();
	}

	/**
	 * Generic method to set the primary key (ca_idticket column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdticket($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of HdeskTicket (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdgroup($this->ca_idgroup);

		$copyObj->setCaIdproject($this->ca_idproject);

		$copyObj->setCaLogin($this->ca_login);

		$copyObj->setCaTitle($this->ca_title);

		$copyObj->setCaText($this->ca_text);

		$copyObj->setCaPriority($this->ca_priority);

		$copyObj->setCaOpened($this->ca_opened);

		$copyObj->setCaType($this->ca_type);

		$copyObj->setCaAssignedto($this->ca_assignedto);

		$copyObj->setCaAction($this->ca_action);

		$copyObj->setCaResponsetime($this->ca_responsetime);

		$copyObj->setCaIdtarea($this->ca_idtarea);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getHdeskResponses() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addHdeskResponse($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setCaIdticket(NULL); // this is a auto-increment column, so set to default value

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
	 * @return     HdeskTicket Clone of current object.
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
	 * @return     HdeskTicketPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new HdeskTicketPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a HdeskGroup object.
	 *
	 * @param      HdeskGroup $v
	 * @return     HdeskTicket The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setHdeskGroup(HdeskGroup $v = null)
	{
		if ($v === null) {
			$this->setCaIdgroup(NULL);
		} else {
			$this->setCaIdgroup($v->getCaIdgroup());
		}

		$this->aHdeskGroup = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the HdeskGroup object, it will not be re-added.
		if ($v !== null) {
			$v->addHdeskTicket($this);
		}

		return $this;
	}


	/**
	 * Get the associated HdeskGroup object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     HdeskGroup The associated HdeskGroup object.
	 * @throws     PropelException
	 */
	public function getHdeskGroup(PropelPDO $con = null)
	{
		if ($this->aHdeskGroup === null && ($this->ca_idgroup !== null)) {
			$c = new Criteria(HdeskGroupPeer::DATABASE_NAME);
			$c->add(HdeskGroupPeer::CA_IDGROUP, $this->ca_idgroup);
			$this->aHdeskGroup = HdeskGroupPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aHdeskGroup->addHdeskTickets($this);
			 */
		}
		return $this->aHdeskGroup;
	}

	/**
	 * Declares an association between this object and a Usuario object.
	 *
	 * @param      Usuario $v
	 * @return     HdeskTicket The current object (for fluent API support)
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
			$v->addHdeskTicket($this);
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
			   $this->aUsuario->addHdeskTickets($this);
			 */
		}
		return $this->aUsuario;
	}

	/**
	 * Declares an association between this object and a HdeskProject object.
	 *
	 * @param      HdeskProject $v
	 * @return     HdeskTicket The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setHdeskProject(HdeskProject $v = null)
	{
		if ($v === null) {
			$this->setCaIdproject(NULL);
		} else {
			$this->setCaIdproject($v->getCaIdproject());
		}

		$this->aHdeskProject = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the HdeskProject object, it will not be re-added.
		if ($v !== null) {
			$v->addHdeskTicket($this);
		}

		return $this;
	}


	/**
	 * Get the associated HdeskProject object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     HdeskProject The associated HdeskProject object.
	 * @throws     PropelException
	 */
	public function getHdeskProject(PropelPDO $con = null)
	{
		if ($this->aHdeskProject === null && ($this->ca_idproject !== null)) {
			$c = new Criteria(HdeskProjectPeer::DATABASE_NAME);
			$c->add(HdeskProjectPeer::CA_IDPROJECT, $this->ca_idproject);
			$this->aHdeskProject = HdeskProjectPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aHdeskProject->addHdeskTickets($this);
			 */
		}
		return $this->aHdeskProject;
	}

	/**
	 * Declares an association between this object and a NotTarea object.
	 *
	 * @param      NotTarea $v
	 * @return     HdeskTicket The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setNotTarea(NotTarea $v = null)
	{
		if ($v === null) {
			$this->setCaIdtarea(NULL);
		} else {
			$this->setCaIdtarea($v->getCaIdtarea());
		}

		$this->aNotTarea = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the NotTarea object, it will not be re-added.
		if ($v !== null) {
			$v->addHdeskTicket($this);
		}

		return $this;
	}


	/**
	 * Get the associated NotTarea object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     NotTarea The associated NotTarea object.
	 * @throws     PropelException
	 */
	public function getNotTarea(PropelPDO $con = null)
	{
		if ($this->aNotTarea === null && ($this->ca_idtarea !== null)) {
			$c = new Criteria(NotTareaPeer::DATABASE_NAME);
			$c->add(NotTareaPeer::CA_IDTAREA, $this->ca_idtarea);
			$this->aNotTarea = NotTareaPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aNotTarea->addHdeskTickets($this);
			 */
		}
		return $this->aNotTarea;
	}

	/**
	 * Clears out the collHdeskResponses collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addHdeskResponses()
	 */
	public function clearHdeskResponses()
	{
		$this->collHdeskResponses = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collHdeskResponses collection (array).
	 *
	 * By default this just sets the collHdeskResponses collection to an empty array (like clearcollHdeskResponses());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initHdeskResponses()
	{
		$this->collHdeskResponses = array();
	}

	/**
	 * Gets an array of HdeskResponse objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this HdeskTicket has previously been saved, it will retrieve
	 * related HdeskResponses from storage. If this HdeskTicket is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array HdeskResponse[]
	 * @throws     PropelException
	 */
	public function getHdeskResponses($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(HdeskTicketPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskResponses === null) {
			if ($this->isNew()) {
			   $this->collHdeskResponses = array();
			} else {

				$criteria->add(HdeskResponsePeer::CA_IDTICKET, $this->ca_idticket);

				HdeskResponsePeer::addSelectColumns($criteria);
				$this->collHdeskResponses = HdeskResponsePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(HdeskResponsePeer::CA_IDTICKET, $this->ca_idticket);

				HdeskResponsePeer::addSelectColumns($criteria);
				if (!isset($this->lastHdeskResponseCriteria) || !$this->lastHdeskResponseCriteria->equals($criteria)) {
					$this->collHdeskResponses = HdeskResponsePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastHdeskResponseCriteria = $criteria;
		return $this->collHdeskResponses;
	}

	/**
	 * Returns the number of related HdeskResponse objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related HdeskResponse objects.
	 * @throws     PropelException
	 */
	public function countHdeskResponses(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(HdeskTicketPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collHdeskResponses === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(HdeskResponsePeer::CA_IDTICKET, $this->ca_idticket);

				$count = HdeskResponsePeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(HdeskResponsePeer::CA_IDTICKET, $this->ca_idticket);

				if (!isset($this->lastHdeskResponseCriteria) || !$this->lastHdeskResponseCriteria->equals($criteria)) {
					$count = HdeskResponsePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collHdeskResponses);
				}
			} else {
				$count = count($this->collHdeskResponses);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a HdeskResponse object to this object
	 * through the HdeskResponse foreign key attribute.
	 *
	 * @param      HdeskResponse $l HdeskResponse
	 * @return     void
	 * @throws     PropelException
	 */
	public function addHdeskResponse(HdeskResponse $l)
	{
		if ($this->collHdeskResponses === null) {
			$this->initHdeskResponses();
		}
		if (!in_array($l, $this->collHdeskResponses, true)) { // only add it if the **same** object is not already associated
			array_push($this->collHdeskResponses, $l);
			$l->setHdeskTicket($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this HdeskTicket is new, it will return
	 * an empty collection; or if this HdeskTicket has previously
	 * been saved, it will retrieve related HdeskResponses from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in HdeskTicket.
	 */
	public function getHdeskResponsesJoinUsuario($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(HdeskTicketPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskResponses === null) {
			if ($this->isNew()) {
				$this->collHdeskResponses = array();
			} else {

				$criteria->add(HdeskResponsePeer::CA_IDTICKET, $this->ca_idticket);

				$this->collHdeskResponses = HdeskResponsePeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(HdeskResponsePeer::CA_IDTICKET, $this->ca_idticket);

			if (!isset($this->lastHdeskResponseCriteria) || !$this->lastHdeskResponseCriteria->equals($criteria)) {
				$this->collHdeskResponses = HdeskResponsePeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		}
		$this->lastHdeskResponseCriteria = $criteria;

		return $this->collHdeskResponses;
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
			if ($this->collHdeskResponses) {
				foreach ((array) $this->collHdeskResponses as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collHdeskResponses = null;
			$this->aHdeskGroup = null;
			$this->aUsuario = null;
			$this->aHdeskProject = null;
			$this->aNotTarea = null;
	}

} // BaseHdeskTicket
