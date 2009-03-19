<?php

/**
 * Base class that represents a row from the 'tb_emails' table.
 *
 * 
 *
 * @package    lib.model.public.om
 */
abstract class BaseEmail extends BaseObject  implements Persistent {


  const PEER = 'EmailPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        EmailPeer
	 */
	protected static $peer;

	/**
	 * The value for the ca_idemail field.
	 * @var        int
	 */
	protected $ca_idemail;

	/**
	 * The value for the ca_fchenvio field.
	 * @var        string
	 */
	protected $ca_fchenvio;

	/**
	 * The value for the ca_usuenvio field.
	 * @var        string
	 */
	protected $ca_usuenvio;

	/**
	 * The value for the ca_tipo field.
	 * @var        string
	 */
	protected $ca_tipo;

	/**
	 * The value for the ca_idcaso field.
	 * @var        string
	 */
	protected $ca_idcaso;

	/**
	 * The value for the ca_from field.
	 * @var        string
	 */
	protected $ca_from;

	/**
	 * The value for the ca_fromname field.
	 * @var        string
	 */
	protected $ca_fromname;

	/**
	 * The value for the ca_cc field.
	 * @var        string
	 */
	protected $ca_cc;

	/**
	 * The value for the ca_replyto field.
	 * @var        string
	 */
	protected $ca_replyto;

	/**
	 * The value for the ca_address field.
	 * @var        string
	 */
	protected $ca_address;

	/**
	 * The value for the ca_attachment field.
	 * @var        string
	 */
	protected $ca_attachment;

	/**
	 * The value for the ca_subject field.
	 * @var        string
	 */
	protected $ca_subject;

	/**
	 * The value for the ca_body field.
	 * @var        string
	 */
	protected $ca_body;

	/**
	 * The value for the ca_bodyhtml field.
	 * @var        string
	 */
	protected $ca_bodyhtml;

	/**
	 * The value for the ca_readreceipt field.
	 * @var        boolean
	 */
	protected $ca_readreceipt;

	/**
	 * @var        array EmailAttachment[] Collection to store aggregation of EmailAttachment objects.
	 */
	protected $collEmailAttachments;

	/**
	 * @var        Criteria The criteria used to select the current contents of collEmailAttachments.
	 */
	private $lastEmailAttachmentCriteria = null;

	/**
	 * @var        array RepAviso[] Collection to store aggregation of RepAviso objects.
	 */
	protected $collRepAvisos;

	/**
	 * @var        Criteria The criteria used to select the current contents of collRepAvisos.
	 */
	private $lastRepAvisoCriteria = null;

	/**
	 * @var        array RepStatus[] Collection to store aggregation of RepStatus objects.
	 */
	protected $collRepStatuss;

	/**
	 * @var        Criteria The criteria used to select the current contents of collRepStatuss.
	 */
	private $lastRepStatusCriteria = null;

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
	 * Initializes internal state of BaseEmail object.
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
	 * Get the [ca_idemail] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdemail()
	{
		return $this->ca_idemail;
	}

	/**
	 * Get the [optionally formatted] temporal [ca_fchenvio] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCaFchenvio($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fchenvio === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchenvio);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchenvio, true), $x);
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
	 * Get the [ca_usuenvio] column value.
	 * 
	 * @return     string
	 */
	public function getCaUsuenvio()
	{
		return $this->ca_usuenvio;
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
	 * Get the [ca_idcaso] column value.
	 * 
	 * @return     string
	 */
	public function getCaIdcaso()
	{
		return $this->ca_idcaso;
	}

	/**
	 * Get the [ca_from] column value.
	 * 
	 * @return     string
	 */
	public function getCaFrom()
	{
		return $this->ca_from;
	}

	/**
	 * Get the [ca_fromname] column value.
	 * 
	 * @return     string
	 */
	public function getCaFromname()
	{
		return $this->ca_fromname;
	}

	/**
	 * Get the [ca_cc] column value.
	 * 
	 * @return     string
	 */
	public function getCaCc()
	{
		return $this->ca_cc;
	}

	/**
	 * Get the [ca_replyto] column value.
	 * 
	 * @return     string
	 */
	public function getCaReplyto()
	{
		return $this->ca_replyto;
	}

	/**
	 * Get the [ca_address] column value.
	 * 
	 * @return     string
	 */
	public function getCaAddress()
	{
		return $this->ca_address;
	}

	/**
	 * Get the [ca_attachment] column value.
	 * 
	 * @return     string
	 */
	public function getCaAttachment()
	{
		return $this->ca_attachment;
	}

	/**
	 * Get the [ca_subject] column value.
	 * 
	 * @return     string
	 */
	public function getCaSubject()
	{
		return $this->ca_subject;
	}

	/**
	 * Get the [ca_body] column value.
	 * 
	 * @return     string
	 */
	public function getCaBody()
	{
		return $this->ca_body;
	}

	/**
	 * Get the [ca_bodyhtml] column value.
	 * 
	 * @return     string
	 */
	public function getCaBodyhtml()
	{
		return $this->ca_bodyhtml;
	}

	/**
	 * Get the [ca_readreceipt] column value.
	 * 
	 * @return     boolean
	 */
	public function getCaReadreceipt()
	{
		return $this->ca_readreceipt;
	}

	/**
	 * Set the value of [ca_idemail] column.
	 * 
	 * @param      int $v new value
	 * @return     Email The current object (for fluent API support)
	 */
	public function setCaIdemail($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idemail !== $v) {
			$this->ca_idemail = $v;
			$this->modifiedColumns[] = EmailPeer::CA_IDEMAIL;
		}

		return $this;
	} // setCaIdemail()

	/**
	 * Sets the value of [ca_fchenvio] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     Email The current object (for fluent API support)
	 */
	public function setCaFchenvio($v)
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

		if ( $this->ca_fchenvio !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fchenvio !== null && $tmpDt = new DateTime($this->ca_fchenvio)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchenvio = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = EmailPeer::CA_FCHENVIO;
			}
		} // if either are not null

		return $this;
	} // setCaFchenvio()

	/**
	 * Set the value of [ca_usuenvio] column.
	 * 
	 * @param      string $v new value
	 * @return     Email The current object (for fluent API support)
	 */
	public function setCaUsuenvio($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usuenvio !== $v) {
			$this->ca_usuenvio = $v;
			$this->modifiedColumns[] = EmailPeer::CA_USUENVIO;
		}

		return $this;
	} // setCaUsuenvio()

	/**
	 * Set the value of [ca_tipo] column.
	 * 
	 * @param      string $v new value
	 * @return     Email The current object (for fluent API support)
	 */
	public function setCaTipo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_tipo !== $v) {
			$this->ca_tipo = $v;
			$this->modifiedColumns[] = EmailPeer::CA_TIPO;
		}

		return $this;
	} // setCaTipo()

	/**
	 * Set the value of [ca_idcaso] column.
	 * 
	 * @param      string $v new value
	 * @return     Email The current object (for fluent API support)
	 */
	public function setCaIdcaso($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idcaso !== $v) {
			$this->ca_idcaso = $v;
			$this->modifiedColumns[] = EmailPeer::CA_IDCASO;
		}

		return $this;
	} // setCaIdcaso()

	/**
	 * Set the value of [ca_from] column.
	 * 
	 * @param      string $v new value
	 * @return     Email The current object (for fluent API support)
	 */
	public function setCaFrom($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_from !== $v) {
			$this->ca_from = $v;
			$this->modifiedColumns[] = EmailPeer::CA_FROM;
		}

		return $this;
	} // setCaFrom()

	/**
	 * Set the value of [ca_fromname] column.
	 * 
	 * @param      string $v new value
	 * @return     Email The current object (for fluent API support)
	 */
	public function setCaFromname($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_fromname !== $v) {
			$this->ca_fromname = $v;
			$this->modifiedColumns[] = EmailPeer::CA_FROMNAME;
		}

		return $this;
	} // setCaFromname()

	/**
	 * Set the value of [ca_cc] column.
	 * 
	 * @param      string $v new value
	 * @return     Email The current object (for fluent API support)
	 */
	public function setCaCc($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_cc !== $v) {
			$this->ca_cc = $v;
			$this->modifiedColumns[] = EmailPeer::CA_CC;
		}

		return $this;
	} // setCaCc()

	/**
	 * Set the value of [ca_replyto] column.
	 * 
	 * @param      string $v new value
	 * @return     Email The current object (for fluent API support)
	 */
	public function setCaReplyto($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_replyto !== $v) {
			$this->ca_replyto = $v;
			$this->modifiedColumns[] = EmailPeer::CA_REPLYTO;
		}

		return $this;
	} // setCaReplyto()

	/**
	 * Set the value of [ca_address] column.
	 * 
	 * @param      string $v new value
	 * @return     Email The current object (for fluent API support)
	 */
	public function setCaAddress($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_address !== $v) {
			$this->ca_address = $v;
			$this->modifiedColumns[] = EmailPeer::CA_ADDRESS;
		}

		return $this;
	} // setCaAddress()

	/**
	 * Set the value of [ca_attachment] column.
	 * 
	 * @param      string $v new value
	 * @return     Email The current object (for fluent API support)
	 */
	public function setCaAttachment($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_attachment !== $v) {
			$this->ca_attachment = $v;
			$this->modifiedColumns[] = EmailPeer::CA_ATTACHMENT;
		}

		return $this;
	} // setCaAttachment()

	/**
	 * Set the value of [ca_subject] column.
	 * 
	 * @param      string $v new value
	 * @return     Email The current object (for fluent API support)
	 */
	public function setCaSubject($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_subject !== $v) {
			$this->ca_subject = $v;
			$this->modifiedColumns[] = EmailPeer::CA_SUBJECT;
		}

		return $this;
	} // setCaSubject()

	/**
	 * Set the value of [ca_body] column.
	 * 
	 * @param      string $v new value
	 * @return     Email The current object (for fluent API support)
	 */
	public function setCaBody($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_body !== $v) {
			$this->ca_body = $v;
			$this->modifiedColumns[] = EmailPeer::CA_BODY;
		}

		return $this;
	} // setCaBody()

	/**
	 * Set the value of [ca_bodyhtml] column.
	 * 
	 * @param      string $v new value
	 * @return     Email The current object (for fluent API support)
	 */
	public function setCaBodyhtml($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_bodyhtml !== $v) {
			$this->ca_bodyhtml = $v;
			$this->modifiedColumns[] = EmailPeer::CA_BODYHTML;
		}

		return $this;
	} // setCaBodyhtml()

	/**
	 * Set the value of [ca_readreceipt] column.
	 * 
	 * @param      boolean $v new value
	 * @return     Email The current object (for fluent API support)
	 */
	public function setCaReadreceipt($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->ca_readreceipt !== $v) {
			$this->ca_readreceipt = $v;
			$this->modifiedColumns[] = EmailPeer::CA_READRECEIPT;
		}

		return $this;
	} // setCaReadreceipt()

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

			$this->ca_idemail = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_fchenvio = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_usuenvio = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_tipo = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_idcaso = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_from = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_fromname = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_cc = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_replyto = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_address = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_attachment = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_subject = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_body = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_bodyhtml = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->ca_readreceipt = ($row[$startcol + 14] !== null) ? (boolean) $row[$startcol + 14] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 15; // 15 = EmailPeer::NUM_COLUMNS - EmailPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Email object", $e);
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
			$con = Propel::getConnection(EmailPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = EmailPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->collEmailAttachments = null;
			$this->lastEmailAttachmentCriteria = null;

			$this->collRepAvisos = null;
			$this->lastRepAvisoCriteria = null;

			$this->collRepStatuss = null;
			$this->lastRepStatusCriteria = null;

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
			$con = Propel::getConnection(EmailPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			EmailPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(EmailPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			EmailPeer::addInstanceToPool($this);
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

			if ($this->isNew() ) {
				$this->modifiedColumns[] = EmailPeer::CA_IDEMAIL;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = EmailPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setCaIdemail($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += EmailPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collEmailAttachments !== null) {
				foreach ($this->collEmailAttachments as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRepAvisos !== null) {
				foreach ($this->collRepAvisos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRepStatuss !== null) {
				foreach ($this->collRepStatuss as $referrerFK) {
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


			if (($retval = EmailPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collEmailAttachments !== null) {
					foreach ($this->collEmailAttachments as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRepAvisos !== null) {
					foreach ($this->collRepAvisos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRepStatuss !== null) {
					foreach ($this->collRepStatuss as $referrerFK) {
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
		$pos = EmailPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdemail();
				break;
			case 1:
				return $this->getCaFchenvio();
				break;
			case 2:
				return $this->getCaUsuenvio();
				break;
			case 3:
				return $this->getCaTipo();
				break;
			case 4:
				return $this->getCaIdcaso();
				break;
			case 5:
				return $this->getCaFrom();
				break;
			case 6:
				return $this->getCaFromname();
				break;
			case 7:
				return $this->getCaCc();
				break;
			case 8:
				return $this->getCaReplyto();
				break;
			case 9:
				return $this->getCaAddress();
				break;
			case 10:
				return $this->getCaAttachment();
				break;
			case 11:
				return $this->getCaSubject();
				break;
			case 12:
				return $this->getCaBody();
				break;
			case 13:
				return $this->getCaBodyhtml();
				break;
			case 14:
				return $this->getCaReadreceipt();
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
		$keys = EmailPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdemail(),
			$keys[1] => $this->getCaFchenvio(),
			$keys[2] => $this->getCaUsuenvio(),
			$keys[3] => $this->getCaTipo(),
			$keys[4] => $this->getCaIdcaso(),
			$keys[5] => $this->getCaFrom(),
			$keys[6] => $this->getCaFromname(),
			$keys[7] => $this->getCaCc(),
			$keys[8] => $this->getCaReplyto(),
			$keys[9] => $this->getCaAddress(),
			$keys[10] => $this->getCaAttachment(),
			$keys[11] => $this->getCaSubject(),
			$keys[12] => $this->getCaBody(),
			$keys[13] => $this->getCaBodyhtml(),
			$keys[14] => $this->getCaReadreceipt(),
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
		$pos = EmailPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdemail($value);
				break;
			case 1:
				$this->setCaFchenvio($value);
				break;
			case 2:
				$this->setCaUsuenvio($value);
				break;
			case 3:
				$this->setCaTipo($value);
				break;
			case 4:
				$this->setCaIdcaso($value);
				break;
			case 5:
				$this->setCaFrom($value);
				break;
			case 6:
				$this->setCaFromname($value);
				break;
			case 7:
				$this->setCaCc($value);
				break;
			case 8:
				$this->setCaReplyto($value);
				break;
			case 9:
				$this->setCaAddress($value);
				break;
			case 10:
				$this->setCaAttachment($value);
				break;
			case 11:
				$this->setCaSubject($value);
				break;
			case 12:
				$this->setCaBody($value);
				break;
			case 13:
				$this->setCaBodyhtml($value);
				break;
			case 14:
				$this->setCaReadreceipt($value);
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
		$keys = EmailPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdemail($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaFchenvio($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaUsuenvio($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaTipo($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaIdcaso($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaFrom($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaFromname($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaCc($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaReplyto($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaAddress($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaAttachment($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaSubject($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaBody($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaBodyhtml($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaReadreceipt($arr[$keys[14]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(EmailPeer::DATABASE_NAME);

		if ($this->isColumnModified(EmailPeer::CA_IDEMAIL)) $criteria->add(EmailPeer::CA_IDEMAIL, $this->ca_idemail);
		if ($this->isColumnModified(EmailPeer::CA_FCHENVIO)) $criteria->add(EmailPeer::CA_FCHENVIO, $this->ca_fchenvio);
		if ($this->isColumnModified(EmailPeer::CA_USUENVIO)) $criteria->add(EmailPeer::CA_USUENVIO, $this->ca_usuenvio);
		if ($this->isColumnModified(EmailPeer::CA_TIPO)) $criteria->add(EmailPeer::CA_TIPO, $this->ca_tipo);
		if ($this->isColumnModified(EmailPeer::CA_IDCASO)) $criteria->add(EmailPeer::CA_IDCASO, $this->ca_idcaso);
		if ($this->isColumnModified(EmailPeer::CA_FROM)) $criteria->add(EmailPeer::CA_FROM, $this->ca_from);
		if ($this->isColumnModified(EmailPeer::CA_FROMNAME)) $criteria->add(EmailPeer::CA_FROMNAME, $this->ca_fromname);
		if ($this->isColumnModified(EmailPeer::CA_CC)) $criteria->add(EmailPeer::CA_CC, $this->ca_cc);
		if ($this->isColumnModified(EmailPeer::CA_REPLYTO)) $criteria->add(EmailPeer::CA_REPLYTO, $this->ca_replyto);
		if ($this->isColumnModified(EmailPeer::CA_ADDRESS)) $criteria->add(EmailPeer::CA_ADDRESS, $this->ca_address);
		if ($this->isColumnModified(EmailPeer::CA_ATTACHMENT)) $criteria->add(EmailPeer::CA_ATTACHMENT, $this->ca_attachment);
		if ($this->isColumnModified(EmailPeer::CA_SUBJECT)) $criteria->add(EmailPeer::CA_SUBJECT, $this->ca_subject);
		if ($this->isColumnModified(EmailPeer::CA_BODY)) $criteria->add(EmailPeer::CA_BODY, $this->ca_body);
		if ($this->isColumnModified(EmailPeer::CA_BODYHTML)) $criteria->add(EmailPeer::CA_BODYHTML, $this->ca_bodyhtml);
		if ($this->isColumnModified(EmailPeer::CA_READRECEIPT)) $criteria->add(EmailPeer::CA_READRECEIPT, $this->ca_readreceipt);

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
		$criteria = new Criteria(EmailPeer::DATABASE_NAME);

		$criteria->add(EmailPeer::CA_IDEMAIL, $this->ca_idemail);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdemail();
	}

	/**
	 * Generic method to set the primary key (ca_idemail column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdemail($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Email (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaFchenvio($this->ca_fchenvio);

		$copyObj->setCaUsuenvio($this->ca_usuenvio);

		$copyObj->setCaTipo($this->ca_tipo);

		$copyObj->setCaIdcaso($this->ca_idcaso);

		$copyObj->setCaFrom($this->ca_from);

		$copyObj->setCaFromname($this->ca_fromname);

		$copyObj->setCaCc($this->ca_cc);

		$copyObj->setCaReplyto($this->ca_replyto);

		$copyObj->setCaAddress($this->ca_address);

		$copyObj->setCaAttachment($this->ca_attachment);

		$copyObj->setCaSubject($this->ca_subject);

		$copyObj->setCaBody($this->ca_body);

		$copyObj->setCaBodyhtml($this->ca_bodyhtml);

		$copyObj->setCaReadreceipt($this->ca_readreceipt);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getEmailAttachments() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addEmailAttachment($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getRepAvisos() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addRepAviso($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getRepStatuss() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addRepStatus($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setCaIdemail(NULL); // this is a auto-increment column, so set to default value

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
	 * @return     Email Clone of current object.
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
	 * @return     EmailPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new EmailPeer();
		}
		return self::$peer;
	}

	/**
	 * Clears out the collEmailAttachments collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addEmailAttachments()
	 */
	public function clearEmailAttachments()
	{
		$this->collEmailAttachments = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collEmailAttachments collection (array).
	 *
	 * By default this just sets the collEmailAttachments collection to an empty array (like clearcollEmailAttachments());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initEmailAttachments()
	{
		$this->collEmailAttachments = array();
	}

	/**
	 * Gets an array of EmailAttachment objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Email has previously been saved, it will retrieve
	 * related EmailAttachments from storage. If this Email is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array EmailAttachment[]
	 * @throws     PropelException
	 */
	public function getEmailAttachments($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(EmailPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEmailAttachments === null) {
			if ($this->isNew()) {
			   $this->collEmailAttachments = array();
			} else {

				$criteria->add(EmailAttachmentPeer::CA_IDEMAIL, $this->ca_idemail);

				EmailAttachmentPeer::addSelectColumns($criteria);
				$this->collEmailAttachments = EmailAttachmentPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(EmailAttachmentPeer::CA_IDEMAIL, $this->ca_idemail);

				EmailAttachmentPeer::addSelectColumns($criteria);
				if (!isset($this->lastEmailAttachmentCriteria) || !$this->lastEmailAttachmentCriteria->equals($criteria)) {
					$this->collEmailAttachments = EmailAttachmentPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEmailAttachmentCriteria = $criteria;
		return $this->collEmailAttachments;
	}

	/**
	 * Returns the number of related EmailAttachment objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related EmailAttachment objects.
	 * @throws     PropelException
	 */
	public function countEmailAttachments(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(EmailPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collEmailAttachments === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(EmailAttachmentPeer::CA_IDEMAIL, $this->ca_idemail);

				$count = EmailAttachmentPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(EmailAttachmentPeer::CA_IDEMAIL, $this->ca_idemail);

				if (!isset($this->lastEmailAttachmentCriteria) || !$this->lastEmailAttachmentCriteria->equals($criteria)) {
					$count = EmailAttachmentPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collEmailAttachments);
				}
			} else {
				$count = count($this->collEmailAttachments);
			}
		}
		$this->lastEmailAttachmentCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a EmailAttachment object to this object
	 * through the EmailAttachment foreign key attribute.
	 *
	 * @param      EmailAttachment $l EmailAttachment
	 * @return     void
	 * @throws     PropelException
	 */
	public function addEmailAttachment(EmailAttachment $l)
	{
		if ($this->collEmailAttachments === null) {
			$this->initEmailAttachments();
		}
		if (!in_array($l, $this->collEmailAttachments, true)) { // only add it if the **same** object is not already associated
			array_push($this->collEmailAttachments, $l);
			$l->setEmail($this);
		}
	}

	/**
	 * Clears out the collRepAvisos collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addRepAvisos()
	 */
	public function clearRepAvisos()
	{
		$this->collRepAvisos = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collRepAvisos collection (array).
	 *
	 * By default this just sets the collRepAvisos collection to an empty array (like clearcollRepAvisos());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initRepAvisos()
	{
		$this->collRepAvisos = array();
	}

	/**
	 * Gets an array of RepAviso objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Email has previously been saved, it will retrieve
	 * related RepAvisos from storage. If this Email is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array RepAviso[]
	 * @throws     PropelException
	 */
	public function getRepAvisos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(EmailPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepAvisos === null) {
			if ($this->isNew()) {
			   $this->collRepAvisos = array();
			} else {

				$criteria->add(RepAvisoPeer::CA_IDEMAIL, $this->ca_idemail);

				RepAvisoPeer::addSelectColumns($criteria);
				$this->collRepAvisos = RepAvisoPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RepAvisoPeer::CA_IDEMAIL, $this->ca_idemail);

				RepAvisoPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepAvisoCriteria) || !$this->lastRepAvisoCriteria->equals($criteria)) {
					$this->collRepAvisos = RepAvisoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepAvisoCriteria = $criteria;
		return $this->collRepAvisos;
	}

	/**
	 * Returns the number of related RepAviso objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related RepAviso objects.
	 * @throws     PropelException
	 */
	public function countRepAvisos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(EmailPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collRepAvisos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(RepAvisoPeer::CA_IDEMAIL, $this->ca_idemail);

				$count = RepAvisoPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(RepAvisoPeer::CA_IDEMAIL, $this->ca_idemail);

				if (!isset($this->lastRepAvisoCriteria) || !$this->lastRepAvisoCriteria->equals($criteria)) {
					$count = RepAvisoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collRepAvisos);
				}
			} else {
				$count = count($this->collRepAvisos);
			}
		}
		$this->lastRepAvisoCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a RepAviso object to this object
	 * through the RepAviso foreign key attribute.
	 *
	 * @param      RepAviso $l RepAviso
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRepAviso(RepAviso $l)
	{
		if ($this->collRepAvisos === null) {
			$this->initRepAvisos();
		}
		if (!in_array($l, $this->collRepAvisos, true)) { // only add it if the **same** object is not already associated
			array_push($this->collRepAvisos, $l);
			$l->setEmail($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Email is new, it will return
	 * an empty collection; or if this Email has previously
	 * been saved, it will retrieve related RepAvisos from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Email.
	 */
	public function getRepAvisosJoinReporte($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(EmailPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepAvisos === null) {
			if ($this->isNew()) {
				$this->collRepAvisos = array();
			} else {

				$criteria->add(RepAvisoPeer::CA_IDEMAIL, $this->ca_idemail);

				$this->collRepAvisos = RepAvisoPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RepAvisoPeer::CA_IDEMAIL, $this->ca_idemail);

			if (!isset($this->lastRepAvisoCriteria) || !$this->lastRepAvisoCriteria->equals($criteria)) {
				$this->collRepAvisos = RepAvisoPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		}
		$this->lastRepAvisoCriteria = $criteria;

		return $this->collRepAvisos;
	}

	/**
	 * Clears out the collRepStatuss collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addRepStatuss()
	 */
	public function clearRepStatuss()
	{
		$this->collRepStatuss = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collRepStatuss collection (array).
	 *
	 * By default this just sets the collRepStatuss collection to an empty array (like clearcollRepStatuss());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initRepStatuss()
	{
		$this->collRepStatuss = array();
	}

	/**
	 * Gets an array of RepStatus objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Email has previously been saved, it will retrieve
	 * related RepStatuss from storage. If this Email is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array RepStatus[]
	 * @throws     PropelException
	 */
	public function getRepStatuss($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(EmailPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepStatuss === null) {
			if ($this->isNew()) {
			   $this->collRepStatuss = array();
			} else {

				$criteria->add(RepStatusPeer::CA_IDEMAIL, $this->ca_idemail);

				RepStatusPeer::addSelectColumns($criteria);
				$this->collRepStatuss = RepStatusPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RepStatusPeer::CA_IDEMAIL, $this->ca_idemail);

				RepStatusPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepStatusCriteria) || !$this->lastRepStatusCriteria->equals($criteria)) {
					$this->collRepStatuss = RepStatusPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepStatusCriteria = $criteria;
		return $this->collRepStatuss;
	}

	/**
	 * Returns the number of related RepStatus objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related RepStatus objects.
	 * @throws     PropelException
	 */
	public function countRepStatuss(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(EmailPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collRepStatuss === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(RepStatusPeer::CA_IDEMAIL, $this->ca_idemail);

				$count = RepStatusPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(RepStatusPeer::CA_IDEMAIL, $this->ca_idemail);

				if (!isset($this->lastRepStatusCriteria) || !$this->lastRepStatusCriteria->equals($criteria)) {
					$count = RepStatusPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collRepStatuss);
				}
			} else {
				$count = count($this->collRepStatuss);
			}
		}
		$this->lastRepStatusCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a RepStatus object to this object
	 * through the RepStatus foreign key attribute.
	 *
	 * @param      RepStatus $l RepStatus
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRepStatus(RepStatus $l)
	{
		if ($this->collRepStatuss === null) {
			$this->initRepStatuss();
		}
		if (!in_array($l, $this->collRepStatuss, true)) { // only add it if the **same** object is not already associated
			array_push($this->collRepStatuss, $l);
			$l->setEmail($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Email is new, it will return
	 * an empty collection; or if this Email has previously
	 * been saved, it will retrieve related RepStatuss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Email.
	 */
	public function getRepStatussJoinReporte($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(EmailPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepStatuss === null) {
			if ($this->isNew()) {
				$this->collRepStatuss = array();
			} else {

				$criteria->add(RepStatusPeer::CA_IDEMAIL, $this->ca_idemail);

				$this->collRepStatuss = RepStatusPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(RepStatusPeer::CA_IDEMAIL, $this->ca_idemail);

			if (!isset($this->lastRepStatusCriteria) || !$this->lastRepStatusCriteria->equals($criteria)) {
				$this->collRepStatuss = RepStatusPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		}
		$this->lastRepStatusCriteria = $criteria;

		return $this->collRepStatuss;
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
			if ($this->collEmailAttachments) {
				foreach ((array) $this->collEmailAttachments as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collRepAvisos) {
				foreach ((array) $this->collRepAvisos as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collRepStatuss) {
				foreach ((array) $this->collRepStatuss as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collEmailAttachments = null;
		$this->collRepAvisos = null;
		$this->collRepStatuss = null;
	}

} // BaseEmail
