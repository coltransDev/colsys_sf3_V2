<?php

/**
 * Base static class for performing query and update operations on the 'helpdesk.tb_tickets' table.
 *
 * 
 *
 * @package    lib.model.helpdesk.om
 */
abstract class BaseHdeskTicketPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'helpdesk.tb_tickets';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.helpdesk.HdeskTicket';

	/** The total number of columns. */
	const NUM_COLUMNS = 13;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** the column name for the CA_IDTICKET field */
	const CA_IDTICKET = 'helpdesk.tb_tickets.CA_IDTICKET';

	/** the column name for the CA_IDGROUP field */
	const CA_IDGROUP = 'helpdesk.tb_tickets.CA_IDGROUP';

	/** the column name for the CA_IDPROJECT field */
	const CA_IDPROJECT = 'helpdesk.tb_tickets.CA_IDPROJECT';

	/** the column name for the CA_LOGIN field */
	const CA_LOGIN = 'helpdesk.tb_tickets.CA_LOGIN';

	/** the column name for the CA_TITLE field */
	const CA_TITLE = 'helpdesk.tb_tickets.CA_TITLE';

	/** the column name for the CA_TEXT field */
	const CA_TEXT = 'helpdesk.tb_tickets.CA_TEXT';

	/** the column name for the CA_PRIORITY field */
	const CA_PRIORITY = 'helpdesk.tb_tickets.CA_PRIORITY';

	/** the column name for the CA_OPENED field */
	const CA_OPENED = 'helpdesk.tb_tickets.CA_OPENED';

	/** the column name for the CA_TYPE field */
	const CA_TYPE = 'helpdesk.tb_tickets.CA_TYPE';

	/** the column name for the CA_ASSIGNEDTO field */
	const CA_ASSIGNEDTO = 'helpdesk.tb_tickets.CA_ASSIGNEDTO';

	/** the column name for the CA_ACTION field */
	const CA_ACTION = 'helpdesk.tb_tickets.CA_ACTION';

	/** the column name for the CA_IDTAREA field */
	const CA_IDTAREA = 'helpdesk.tb_tickets.CA_IDTAREA';

	/** the column name for the CA_IDSEGUIMIENTO field */
	const CA_IDSEGUIMIENTO = 'helpdesk.tb_tickets.CA_IDSEGUIMIENTO';

	/**
	 * An identiy map to hold any loaded instances of HdeskTicket objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array HdeskTicket[]
	 */
	public static $instances = array();

	/**
	 * The MapBuilder instance for this peer.
	 * @var        MapBuilder
	 */
	private static $mapBuilder = null;

	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdticket', 'CaIdgroup', 'CaIdproject', 'CaLogin', 'CaTitle', 'CaText', 'CaPriority', 'CaOpened', 'CaType', 'CaAssignedto', 'CaAction', 'CaIdtarea', 'CaIdseguimiento', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdticket', 'caIdgroup', 'caIdproject', 'caLogin', 'caTitle', 'caText', 'caPriority', 'caOpened', 'caType', 'caAssignedto', 'caAction', 'caIdtarea', 'caIdseguimiento', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDTICKET, self::CA_IDGROUP, self::CA_IDPROJECT, self::CA_LOGIN, self::CA_TITLE, self::CA_TEXT, self::CA_PRIORITY, self::CA_OPENED, self::CA_TYPE, self::CA_ASSIGNEDTO, self::CA_ACTION, self::CA_IDTAREA, self::CA_IDSEGUIMIENTO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idticket', 'ca_idgroup', 'ca_idproject', 'ca_login', 'ca_title', 'ca_text', 'ca_priority', 'ca_opened', 'ca_type', 'ca_assignedto', 'ca_action', 'ca_idtarea', 'ca_idseguimiento', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdticket' => 0, 'CaIdgroup' => 1, 'CaIdproject' => 2, 'CaLogin' => 3, 'CaTitle' => 4, 'CaText' => 5, 'CaPriority' => 6, 'CaOpened' => 7, 'CaType' => 8, 'CaAssignedto' => 9, 'CaAction' => 10, 'CaIdtarea' => 11, 'CaIdseguimiento' => 12, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdticket' => 0, 'caIdgroup' => 1, 'caIdproject' => 2, 'caLogin' => 3, 'caTitle' => 4, 'caText' => 5, 'caPriority' => 6, 'caOpened' => 7, 'caType' => 8, 'caAssignedto' => 9, 'caAction' => 10, 'caIdtarea' => 11, 'caIdseguimiento' => 12, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDTICKET => 0, self::CA_IDGROUP => 1, self::CA_IDPROJECT => 2, self::CA_LOGIN => 3, self::CA_TITLE => 4, self::CA_TEXT => 5, self::CA_PRIORITY => 6, self::CA_OPENED => 7, self::CA_TYPE => 8, self::CA_ASSIGNEDTO => 9, self::CA_ACTION => 10, self::CA_IDTAREA => 11, self::CA_IDSEGUIMIENTO => 12, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idticket' => 0, 'ca_idgroup' => 1, 'ca_idproject' => 2, 'ca_login' => 3, 'ca_title' => 4, 'ca_text' => 5, 'ca_priority' => 6, 'ca_opened' => 7, 'ca_type' => 8, 'ca_assignedto' => 9, 'ca_action' => 10, 'ca_idtarea' => 11, 'ca_idseguimiento' => 12, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	/**
	 * Get a (singleton) instance of the MapBuilder for this peer class.
	 * @return     MapBuilder The map builder for this peer
	 */
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new HdeskTicketMapBuilder();
		}
		return self::$mapBuilder;
	}
	/**
	 * Translates a fieldname to another type
	 *
	 * @param      string $name field name
	 * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @param      string $toType   One of the class type constants
	 * @return     string translated name of the field.
	 * @throws     PropelException - if the specified name could not be found in the fieldname mappings.
	 */
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	/**
	 * Returns an array of field names.
	 *
	 * @param      string $type The type of fieldnames to return:
	 *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     array A list of field names
	 */

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	/**
	 * Convenience method which changes table.column to alias.column.
	 *
	 * Using this method you can maintain SQL abstraction while using column aliases.
	 * <code>
	 *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
	 *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
	 * </code>
	 * @param      string $alias The alias for the current table.
	 * @param      string $column The column name for current table. (i.e. HdeskTicketPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(HdeskTicketPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	/**
	 * Add all the columns needed to create a new object.
	 *
	 * Note: any columns that were marked with lazyLoad="true" in the
	 * XML schema will not be added to the select list and only loaded
	 * on demand.
	 *
	 * @param      criteria object containing the columns to add.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(HdeskTicketPeer::CA_IDTICKET);

		$criteria->addSelectColumn(HdeskTicketPeer::CA_IDGROUP);

		$criteria->addSelectColumn(HdeskTicketPeer::CA_IDPROJECT);

		$criteria->addSelectColumn(HdeskTicketPeer::CA_LOGIN);

		$criteria->addSelectColumn(HdeskTicketPeer::CA_TITLE);

		$criteria->addSelectColumn(HdeskTicketPeer::CA_TEXT);

		$criteria->addSelectColumn(HdeskTicketPeer::CA_PRIORITY);

		$criteria->addSelectColumn(HdeskTicketPeer::CA_OPENED);

		$criteria->addSelectColumn(HdeskTicketPeer::CA_TYPE);

		$criteria->addSelectColumn(HdeskTicketPeer::CA_ASSIGNEDTO);

		$criteria->addSelectColumn(HdeskTicketPeer::CA_ACTION);

		$criteria->addSelectColumn(HdeskTicketPeer::CA_IDTAREA);

		$criteria->addSelectColumn(HdeskTicketPeer::CA_IDSEGUIMIENTO);

	}

	/**
	 * Returns the number of rows matching criteria.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @return     int Number of matching rows.
	 */
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
		// we may modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(HdeskTicketPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HdeskTicketPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(HdeskTicketPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// BasePeer returns a PDOStatement
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}
	/**
	 * Method to select one object from the DB.
	 *
	 * @param      Criteria $criteria object used to create the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     HdeskTicket
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = HdeskTicketPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	/**
	 * Method to do selects.
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     array Array of selected Objects
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return HdeskTicketPeer::populateObjects(HdeskTicketPeer::doSelectStmt($criteria, $con));
	}
	/**
	 * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
	 *
	 * Use this method directly if you want to work with an executed statement durirectly (for example
	 * to perform your own object hydration).
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con The connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return     PDOStatement The executed PDOStatement object.
	 * @see        BasePeer::doSelect()
	 */
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(HdeskTicketPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			HdeskTicketPeer::addSelectColumns($criteria);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		// BasePeer returns a PDOStatement
		return BasePeer::doSelect($criteria, $con);
	}
	/**
	 * Adds an object to the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doSelect*()
	 * methods in your stub classes -- you may need to explicitly add objects
	 * to the cache in order to ensure that the same objects are always returned by doSelect*()
	 * and retrieveByPK*() calls.
	 *
	 * @param      HdeskTicket $value A HdeskTicket object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool(HdeskTicket $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdticket();
			} // if key === null
			self::$instances[$key] = $obj;
		}
	}

	/**
	 * Removes an object from the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doDelete
	 * methods in your stub classes -- you may need to explicitly remove objects
	 * from the cache in order to prevent returning objects that no longer exist.
	 *
	 * @param      mixed $value A HdeskTicket object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof HdeskTicket) {
				$key = (string) $value->getCaIdticket();
			} elseif (is_scalar($value)) {
				// assume we've been passed a primary key
				$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or HdeskTicket object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
				throw $e;
			}

			unset(self::$instances[$key]);
		}
	} // removeInstanceFromPool()

	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
	 * @return     HdeskTicket Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
	 * @see        getPrimaryKeyHash()
	 */
	public static function getInstanceFromPool($key)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if (isset(self::$instances[$key])) {
				return self::$instances[$key];
			}
		}
		return null; // just to be explicit
	}
	
	/**
	 * Clear the instance pool.
	 *
	 * @return     void
	 */
	public static function clearInstancePool()
	{
		self::$instances = array();
	}
	
	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      array $row PropelPDO resultset row.
	 * @param      int $startcol The 0-based offset for reading from the resultset row.
	 * @return     string A string version of PK or NULL if the components of primary key in result array are all null.
	 */
	public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
	{
		// If the PK cannot be derived from the row, return NULL.
		if ($row[$startcol + 0] === null) {
			return null;
		}
		return (string) $row[$startcol + 0];
	}

	/**
	 * The returned array will contain objects of the default type or
	 * objects that inherit from the default.
	 *
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
		// set the class once to avoid overhead in the loop
		$cls = HdeskTicketPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = HdeskTicketPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = HdeskTicketPeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				HdeskTicketPeer::addInstanceToPool($obj, $key);
			} // if key exists
		}
		$stmt->closeCursor();
		return $results;
	}

	/**
	 * Returns the number of rows matching criteria, joining the related HdeskGroup table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinHdeskGroup(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(HdeskTicketPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HdeskTicketPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HdeskTicketPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(HdeskTicketPeer::CA_IDGROUP,), array(HdeskGroupPeer::CA_IDGROUP,), $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Usuario table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinUsuario(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(HdeskTicketPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HdeskTicketPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HdeskTicketPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(HdeskTicketPeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related HdeskProject table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinHdeskProject(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(HdeskTicketPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HdeskTicketPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HdeskTicketPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(HdeskTicketPeer::CA_IDPROJECT,), array(HdeskProjectPeer::CA_IDPROJECT,), $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related NotTarea table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinNotTarea(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(HdeskTicketPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HdeskTicketPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HdeskTicketPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(HdeskTicketPeer::CA_IDTAREA,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Selects a collection of HdeskTicket objects pre-filled with their HdeskGroup objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of HdeskTicket objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinHdeskGroup(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HdeskTicketPeer::addSelectColumns($c);
		$startcol = (HdeskTicketPeer::NUM_COLUMNS - HdeskTicketPeer::NUM_LAZY_LOAD_COLUMNS);
		HdeskGroupPeer::addSelectColumns($c);

		$c->addJoin(array(HdeskTicketPeer::CA_IDGROUP,), array(HdeskGroupPeer::CA_IDGROUP,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HdeskTicketPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HdeskTicketPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = HdeskTicketPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HdeskTicketPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = HdeskGroupPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = HdeskGroupPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = HdeskGroupPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					HdeskGroupPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (HdeskTicket) to $obj2 (HdeskGroup)
				$obj2->addHdeskTicket($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of HdeskTicket objects pre-filled with their Usuario objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of HdeskTicket objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinUsuario(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HdeskTicketPeer::addSelectColumns($c);
		$startcol = (HdeskTicketPeer::NUM_COLUMNS - HdeskTicketPeer::NUM_LAZY_LOAD_COLUMNS);
		UsuarioPeer::addSelectColumns($c);

		$c->addJoin(array(HdeskTicketPeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HdeskTicketPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HdeskTicketPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = HdeskTicketPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HdeskTicketPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = UsuarioPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = UsuarioPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = UsuarioPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					UsuarioPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (HdeskTicket) to $obj2 (Usuario)
				$obj2->addHdeskTicket($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of HdeskTicket objects pre-filled with their HdeskProject objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of HdeskTicket objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinHdeskProject(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HdeskTicketPeer::addSelectColumns($c);
		$startcol = (HdeskTicketPeer::NUM_COLUMNS - HdeskTicketPeer::NUM_LAZY_LOAD_COLUMNS);
		HdeskProjectPeer::addSelectColumns($c);

		$c->addJoin(array(HdeskTicketPeer::CA_IDPROJECT,), array(HdeskProjectPeer::CA_IDPROJECT,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HdeskTicketPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HdeskTicketPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = HdeskTicketPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HdeskTicketPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = HdeskProjectPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = HdeskProjectPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = HdeskProjectPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					HdeskProjectPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (HdeskTicket) to $obj2 (HdeskProject)
				$obj2->addHdeskTicket($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of HdeskTicket objects pre-filled with their NotTarea objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of HdeskTicket objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinNotTarea(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HdeskTicketPeer::addSelectColumns($c);
		$startcol = (HdeskTicketPeer::NUM_COLUMNS - HdeskTicketPeer::NUM_LAZY_LOAD_COLUMNS);
		NotTareaPeer::addSelectColumns($c);

		$c->addJoin(array(HdeskTicketPeer::CA_IDTAREA,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HdeskTicketPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HdeskTicketPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = HdeskTicketPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HdeskTicketPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = NotTareaPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = NotTareaPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = NotTareaPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					NotTareaPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (HdeskTicket) to $obj2 (NotTarea)
				$obj2->addHdeskTicket($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining all related tables
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(HdeskTicketPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HdeskTicketPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HdeskTicketPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(HdeskTicketPeer::CA_IDGROUP,), array(HdeskGroupPeer::CA_IDGROUP,), $join_behavior);
		$criteria->addJoin(array(HdeskTicketPeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
		$criteria->addJoin(array(HdeskTicketPeer::CA_IDPROJECT,), array(HdeskProjectPeer::CA_IDPROJECT,), $join_behavior);
		$criteria->addJoin(array(HdeskTicketPeer::CA_IDTAREA,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}

	/**
	 * Selects a collection of HdeskTicket objects pre-filled with all related objects.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of HdeskTicket objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAll(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HdeskTicketPeer::addSelectColumns($c);
		$startcol2 = (HdeskTicketPeer::NUM_COLUMNS - HdeskTicketPeer::NUM_LAZY_LOAD_COLUMNS);

		HdeskGroupPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (HdeskGroupPeer::NUM_COLUMNS - HdeskGroupPeer::NUM_LAZY_LOAD_COLUMNS);

		UsuarioPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (UsuarioPeer::NUM_COLUMNS - UsuarioPeer::NUM_LAZY_LOAD_COLUMNS);

		HdeskProjectPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (HdeskProjectPeer::NUM_COLUMNS - HdeskProjectPeer::NUM_LAZY_LOAD_COLUMNS);

		NotTareaPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + (NotTareaPeer::NUM_COLUMNS - NotTareaPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(HdeskTicketPeer::CA_IDGROUP,), array(HdeskGroupPeer::CA_IDGROUP,), $join_behavior);
		$c->addJoin(array(HdeskTicketPeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
		$c->addJoin(array(HdeskTicketPeer::CA_IDPROJECT,), array(HdeskProjectPeer::CA_IDPROJECT,), $join_behavior);
		$c->addJoin(array(HdeskTicketPeer::CA_IDTAREA,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HdeskTicketPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HdeskTicketPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = HdeskTicketPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HdeskTicketPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

			// Add objects for joined HdeskGroup rows

			$key2 = HdeskGroupPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = HdeskGroupPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = HdeskGroupPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					HdeskGroupPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 loaded

				// Add the $obj1 (HdeskTicket) to the collection in $obj2 (HdeskGroup)
				$obj2->addHdeskTicket($obj1);
			} // if joined row not null

			// Add objects for joined Usuario rows

			$key3 = UsuarioPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = UsuarioPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = UsuarioPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					UsuarioPeer::addInstanceToPool($obj3, $key3);
				} // if obj3 loaded

				// Add the $obj1 (HdeskTicket) to the collection in $obj3 (Usuario)
				$obj3->addHdeskTicket($obj1);
			} // if joined row not null

			// Add objects for joined HdeskProject rows

			$key4 = HdeskProjectPeer::getPrimaryKeyHashFromRow($row, $startcol4);
			if ($key4 !== null) {
				$obj4 = HdeskProjectPeer::getInstanceFromPool($key4);
				if (!$obj4) {

					$omClass = HdeskProjectPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					HdeskProjectPeer::addInstanceToPool($obj4, $key4);
				} // if obj4 loaded

				// Add the $obj1 (HdeskTicket) to the collection in $obj4 (HdeskProject)
				$obj4->addHdeskTicket($obj1);
			} // if joined row not null

			// Add objects for joined NotTarea rows

			$key5 = NotTareaPeer::getPrimaryKeyHashFromRow($row, $startcol5);
			if ($key5 !== null) {
				$obj5 = NotTareaPeer::getInstanceFromPool($key5);
				if (!$obj5) {

					$omClass = NotTareaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					NotTareaPeer::addInstanceToPool($obj5, $key5);
				} // if obj5 loaded

				// Add the $obj1 (HdeskTicket) to the collection in $obj5 (NotTarea)
				$obj5->addHdeskTicket($obj1);
			} // if joined row not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related HdeskGroup table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptHdeskGroup(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HdeskTicketPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HdeskTicketPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(HdeskTicketPeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
				$criteria->addJoin(array(HdeskTicketPeer::CA_IDPROJECT,), array(HdeskProjectPeer::CA_IDPROJECT,), $join_behavior);
				$criteria->addJoin(array(HdeskTicketPeer::CA_IDTAREA,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Usuario table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptUsuario(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HdeskTicketPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HdeskTicketPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(HdeskTicketPeer::CA_IDGROUP,), array(HdeskGroupPeer::CA_IDGROUP,), $join_behavior);
				$criteria->addJoin(array(HdeskTicketPeer::CA_IDPROJECT,), array(HdeskProjectPeer::CA_IDPROJECT,), $join_behavior);
				$criteria->addJoin(array(HdeskTicketPeer::CA_IDTAREA,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related HdeskProject table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptHdeskProject(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HdeskTicketPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HdeskTicketPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(HdeskTicketPeer::CA_IDGROUP,), array(HdeskGroupPeer::CA_IDGROUP,), $join_behavior);
				$criteria->addJoin(array(HdeskTicketPeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
				$criteria->addJoin(array(HdeskTicketPeer::CA_IDTAREA,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related NotTarea table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptNotTarea(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HdeskTicketPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HdeskTicketPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(HdeskTicketPeer::CA_IDGROUP,), array(HdeskGroupPeer::CA_IDGROUP,), $join_behavior);
				$criteria->addJoin(array(HdeskTicketPeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
				$criteria->addJoin(array(HdeskTicketPeer::CA_IDPROJECT,), array(HdeskProjectPeer::CA_IDPROJECT,), $join_behavior);
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Selects a collection of HdeskTicket objects pre-filled with all related objects except HdeskGroup.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of HdeskTicket objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptHdeskGroup(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HdeskTicketPeer::addSelectColumns($c);
		$startcol2 = (HdeskTicketPeer::NUM_COLUMNS - HdeskTicketPeer::NUM_LAZY_LOAD_COLUMNS);

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (UsuarioPeer::NUM_COLUMNS - UsuarioPeer::NUM_LAZY_LOAD_COLUMNS);

		HdeskProjectPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (HdeskProjectPeer::NUM_COLUMNS - HdeskProjectPeer::NUM_LAZY_LOAD_COLUMNS);

		NotTareaPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (NotTareaPeer::NUM_COLUMNS - NotTareaPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(HdeskTicketPeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
				$c->addJoin(array(HdeskTicketPeer::CA_IDPROJECT,), array(HdeskProjectPeer::CA_IDPROJECT,), $join_behavior);
				$c->addJoin(array(HdeskTicketPeer::CA_IDTAREA,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HdeskTicketPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HdeskTicketPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = HdeskTicketPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HdeskTicketPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined Usuario rows

				$key2 = UsuarioPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = UsuarioPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = UsuarioPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					UsuarioPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (HdeskTicket) to the collection in $obj2 (Usuario)
				$obj2->addHdeskTicket($obj1);

			} // if joined row is not null

				// Add objects for joined HdeskProject rows

				$key3 = HdeskProjectPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = HdeskProjectPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = HdeskProjectPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					HdeskProjectPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (HdeskTicket) to the collection in $obj3 (HdeskProject)
				$obj3->addHdeskTicket($obj1);

			} // if joined row is not null

				// Add objects for joined NotTarea rows

				$key4 = NotTareaPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = NotTareaPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = NotTareaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					NotTareaPeer::addInstanceToPool($obj4, $key4);
				} // if $obj4 already loaded

				// Add the $obj1 (HdeskTicket) to the collection in $obj4 (NotTarea)
				$obj4->addHdeskTicket($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of HdeskTicket objects pre-filled with all related objects except Usuario.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of HdeskTicket objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptUsuario(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HdeskTicketPeer::addSelectColumns($c);
		$startcol2 = (HdeskTicketPeer::NUM_COLUMNS - HdeskTicketPeer::NUM_LAZY_LOAD_COLUMNS);

		HdeskGroupPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (HdeskGroupPeer::NUM_COLUMNS - HdeskGroupPeer::NUM_LAZY_LOAD_COLUMNS);

		HdeskProjectPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (HdeskProjectPeer::NUM_COLUMNS - HdeskProjectPeer::NUM_LAZY_LOAD_COLUMNS);

		NotTareaPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (NotTareaPeer::NUM_COLUMNS - NotTareaPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(HdeskTicketPeer::CA_IDGROUP,), array(HdeskGroupPeer::CA_IDGROUP,), $join_behavior);
				$c->addJoin(array(HdeskTicketPeer::CA_IDPROJECT,), array(HdeskProjectPeer::CA_IDPROJECT,), $join_behavior);
				$c->addJoin(array(HdeskTicketPeer::CA_IDTAREA,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HdeskTicketPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HdeskTicketPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = HdeskTicketPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HdeskTicketPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined HdeskGroup rows

				$key2 = HdeskGroupPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = HdeskGroupPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = HdeskGroupPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					HdeskGroupPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (HdeskTicket) to the collection in $obj2 (HdeskGroup)
				$obj2->addHdeskTicket($obj1);

			} // if joined row is not null

				// Add objects for joined HdeskProject rows

				$key3 = HdeskProjectPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = HdeskProjectPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = HdeskProjectPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					HdeskProjectPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (HdeskTicket) to the collection in $obj3 (HdeskProject)
				$obj3->addHdeskTicket($obj1);

			} // if joined row is not null

				// Add objects for joined NotTarea rows

				$key4 = NotTareaPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = NotTareaPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = NotTareaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					NotTareaPeer::addInstanceToPool($obj4, $key4);
				} // if $obj4 already loaded

				// Add the $obj1 (HdeskTicket) to the collection in $obj4 (NotTarea)
				$obj4->addHdeskTicket($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of HdeskTicket objects pre-filled with all related objects except HdeskProject.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of HdeskTicket objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptHdeskProject(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HdeskTicketPeer::addSelectColumns($c);
		$startcol2 = (HdeskTicketPeer::NUM_COLUMNS - HdeskTicketPeer::NUM_LAZY_LOAD_COLUMNS);

		HdeskGroupPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (HdeskGroupPeer::NUM_COLUMNS - HdeskGroupPeer::NUM_LAZY_LOAD_COLUMNS);

		UsuarioPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (UsuarioPeer::NUM_COLUMNS - UsuarioPeer::NUM_LAZY_LOAD_COLUMNS);

		NotTareaPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (NotTareaPeer::NUM_COLUMNS - NotTareaPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(HdeskTicketPeer::CA_IDGROUP,), array(HdeskGroupPeer::CA_IDGROUP,), $join_behavior);
				$c->addJoin(array(HdeskTicketPeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
				$c->addJoin(array(HdeskTicketPeer::CA_IDTAREA,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HdeskTicketPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HdeskTicketPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = HdeskTicketPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HdeskTicketPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined HdeskGroup rows

				$key2 = HdeskGroupPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = HdeskGroupPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = HdeskGroupPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					HdeskGroupPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (HdeskTicket) to the collection in $obj2 (HdeskGroup)
				$obj2->addHdeskTicket($obj1);

			} // if joined row is not null

				// Add objects for joined Usuario rows

				$key3 = UsuarioPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = UsuarioPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = UsuarioPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					UsuarioPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (HdeskTicket) to the collection in $obj3 (Usuario)
				$obj3->addHdeskTicket($obj1);

			} // if joined row is not null

				// Add objects for joined NotTarea rows

				$key4 = NotTareaPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = NotTareaPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = NotTareaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					NotTareaPeer::addInstanceToPool($obj4, $key4);
				} // if $obj4 already loaded

				// Add the $obj1 (HdeskTicket) to the collection in $obj4 (NotTarea)
				$obj4->addHdeskTicket($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of HdeskTicket objects pre-filled with all related objects except NotTarea.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of HdeskTicket objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptNotTarea(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HdeskTicketPeer::addSelectColumns($c);
		$startcol2 = (HdeskTicketPeer::NUM_COLUMNS - HdeskTicketPeer::NUM_LAZY_LOAD_COLUMNS);

		HdeskGroupPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (HdeskGroupPeer::NUM_COLUMNS - HdeskGroupPeer::NUM_LAZY_LOAD_COLUMNS);

		UsuarioPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (UsuarioPeer::NUM_COLUMNS - UsuarioPeer::NUM_LAZY_LOAD_COLUMNS);

		HdeskProjectPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (HdeskProjectPeer::NUM_COLUMNS - HdeskProjectPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(HdeskTicketPeer::CA_IDGROUP,), array(HdeskGroupPeer::CA_IDGROUP,), $join_behavior);
				$c->addJoin(array(HdeskTicketPeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
				$c->addJoin(array(HdeskTicketPeer::CA_IDPROJECT,), array(HdeskProjectPeer::CA_IDPROJECT,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HdeskTicketPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HdeskTicketPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = HdeskTicketPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HdeskTicketPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined HdeskGroup rows

				$key2 = HdeskGroupPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = HdeskGroupPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = HdeskGroupPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					HdeskGroupPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (HdeskTicket) to the collection in $obj2 (HdeskGroup)
				$obj2->addHdeskTicket($obj1);

			} // if joined row is not null

				// Add objects for joined Usuario rows

				$key3 = UsuarioPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = UsuarioPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = UsuarioPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					UsuarioPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (HdeskTicket) to the collection in $obj3 (Usuario)
				$obj3->addHdeskTicket($obj1);

			} // if joined row is not null

				// Add objects for joined HdeskProject rows

				$key4 = HdeskProjectPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = HdeskProjectPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = HdeskProjectPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					HdeskProjectPeer::addInstanceToPool($obj4, $key4);
				} // if $obj4 already loaded

				// Add the $obj1 (HdeskTicket) to the collection in $obj4 (HdeskProject)
				$obj4->addHdeskTicket($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


  static public function getUniqueColumnNames()
  {
    return array();
  }
	/**
	 * Returns the TableMap related to this peer.
	 * This method is not needed for general use but a specific application could have a need.
	 * @return     TableMap
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	/**
	 * The class that the Peer will make instances of.
	 *
	 * This uses a dot-path notation which is tranalted into a path
	 * relative to a location on the PHP include_path.
	 * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
	 *
	 * @return     string path.to.ClassName
	 */
	public static function getOMClass()
	{
		return HdeskTicketPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a HdeskTicket or Criteria object.
	 *
	 * @param      mixed $values Criteria or HdeskTicket object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(HdeskTicketPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from HdeskTicket object
		}

		if ($criteria->containsKey(HdeskTicketPeer::CA_IDTICKET) && $criteria->keyContainsValue(HdeskTicketPeer::CA_IDTICKET) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.HdeskTicketPeer::CA_IDTICKET.')');
		}


		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		try {
			// use transaction because $criteria could contain info
			// for more than one table (I guess, conceivably)
			$con->beginTransaction();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollBack();
			throw $e;
		}

		return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a HdeskTicket or Criteria object.
	 *
	 * @param      mixed $values Criteria or HdeskTicket object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(HdeskTicketPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(HdeskTicketPeer::CA_IDTICKET);
			$selectCriteria->add(HdeskTicketPeer::CA_IDTICKET, $criteria->remove(HdeskTicketPeer::CA_IDTICKET), $comparison);

		} else { // $values is HdeskTicket object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the helpdesk.tb_tickets table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(HdeskTicketPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(HdeskTicketPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a HdeskTicket or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or HdeskTicket object or primary key or array of primary keys
	 *              which is used to create the DELETE statement
	 * @param      PropelPDO $con the connection to use
	 * @return     int 	The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
	 *				if supported by native driver or if emulated using Propel.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	 public static function doDelete($values, PropelPDO $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(HdeskTicketPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			HdeskTicketPeer::clearInstancePool();

			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof HdeskTicket) {
			// invalidate the cache for this single object
			HdeskTicketPeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key



			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(HdeskTicketPeer::CA_IDTICKET, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
				// we can invalidate the cache for this single object
				HdeskTicketPeer::removeInstanceFromPool($singleval);
			}
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; // initialize var to track total num of affected rows

		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);

			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Validates all modified columns of given HdeskTicket object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      HdeskTicket $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(HdeskTicket $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(HdeskTicketPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(HdeskTicketPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach ($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(HdeskTicketPeer::DATABASE_NAME, HdeskTicketPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = HdeskTicketPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      int $pk the primary key.
	 * @param      PropelPDO $con the connection to use
	 * @return     HdeskTicket
	 */
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = HdeskTicketPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(HdeskTicketPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(HdeskTicketPeer::DATABASE_NAME);
		$criteria->add(HdeskTicketPeer::CA_IDTICKET, $pk);

		$v = HdeskTicketPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	/**
	 * Retrieve multiple objects by pkey.
	 *
	 * @param      array $pks List of primary keys
	 * @param      PropelPDO $con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(HdeskTicketPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(HdeskTicketPeer::DATABASE_NAME);
			$criteria->add(HdeskTicketPeer::CA_IDTICKET, $pks, Criteria::IN);
			$objs = HdeskTicketPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseHdeskTicketPeer

// This is the static code needed to register the MapBuilder for this table with the main Propel class.
//
// NOTE: This static code cannot call methods on the HdeskTicketPeer class, because it is not defined yet.
// If you need to use overridden methods, you can add this code to the bottom of the HdeskTicketPeer class:
//
// Propel::getDatabaseMap(HdeskTicketPeer::DATABASE_NAME)->addTableBuilder(HdeskTicketPeer::TABLE_NAME, HdeskTicketPeer::getMapBuilder());
//
// Doing so will effectively overwrite the registration below.

Propel::getDatabaseMap(BaseHdeskTicketPeer::DATABASE_NAME)->addTableBuilder(BaseHdeskTicketPeer::TABLE_NAME, BaseHdeskTicketPeer::getMapBuilder());

