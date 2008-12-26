<?php

/**
 * Base static class for performing query and update operations on the 'bs_pricrecargosxconcepto' table.
 *
 * 
 *
 * @package    lib.model.pricing.om
 */
abstract class BasePricRecargoxConceptoLogPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'bs_pricrecargosxconcepto';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.pricing.PricRecargoxConceptoLog';

	/** The total number of columns. */
	const NUM_COLUMNS = 14;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** the column name for the CA_IDTRAYECTO field */
	const CA_IDTRAYECTO = 'bs_pricrecargosxconcepto.CA_IDTRAYECTO';

	/** the column name for the CA_IDCONCEPTO field */
	const CA_IDCONCEPTO = 'bs_pricrecargosxconcepto.CA_IDCONCEPTO';

	/** the column name for the CA_IDRECARGO field */
	const CA_IDRECARGO = 'bs_pricrecargosxconcepto.CA_IDRECARGO';

	/** the column name for the CA_VLRRECARGO field */
	const CA_VLRRECARGO = 'bs_pricrecargosxconcepto.CA_VLRRECARGO';

	/** the column name for the CA_APLICACION field */
	const CA_APLICACION = 'bs_pricrecargosxconcepto.CA_APLICACION';

	/** the column name for the CA_VLRMINIMO field */
	const CA_VLRMINIMO = 'bs_pricrecargosxconcepto.CA_VLRMINIMO';

	/** the column name for the CA_APLICACION_MIN field */
	const CA_APLICACION_MIN = 'bs_pricrecargosxconcepto.CA_APLICACION_MIN';

	/** the column name for the CA_OBSERVACIONES field */
	const CA_OBSERVACIONES = 'bs_pricrecargosxconcepto.CA_OBSERVACIONES';

	/** the column name for the CA_IDMONEDA field */
	const CA_IDMONEDA = 'bs_pricrecargosxconcepto.CA_IDMONEDA';

	/** the column name for the CA_FCHINICIO field */
	const CA_FCHINICIO = 'bs_pricrecargosxconcepto.CA_FCHINICIO';

	/** the column name for the CA_FCHVENCIMIENTO field */
	const CA_FCHVENCIMIENTO = 'bs_pricrecargosxconcepto.CA_FCHVENCIMIENTO';

	/** the column name for the CA_FCHCREADO field */
	const CA_FCHCREADO = 'bs_pricrecargosxconcepto.CA_FCHCREADO';

	/** the column name for the CA_USUCREADO field */
	const CA_USUCREADO = 'bs_pricrecargosxconcepto.CA_USUCREADO';

	/** the column name for the CA_CONSECUTIVO field */
	const CA_CONSECUTIVO = 'bs_pricrecargosxconcepto.CA_CONSECUTIVO';

	/**
	 * An identiy map to hold any loaded instances of PricRecargoxConceptoLog objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array PricRecargoxConceptoLog[]
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
		BasePeer::TYPE_PHPNAME => array ('CaIdtrayecto', 'CaIdconcepto', 'CaIdrecargo', 'CaVlrrecargo', 'CaAplicacion', 'CaVlrminimo', 'CaAplicacionMin', 'CaObservaciones', 'CaIdmoneda', 'CaFchinicio', 'CaFchvencimiento', 'CaFchcreado', 'CaUsucreado', 'CaConsecutivo', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdtrayecto', 'caIdconcepto', 'caIdrecargo', 'caVlrrecargo', 'caAplicacion', 'caVlrminimo', 'caAplicacionMin', 'caObservaciones', 'caIdmoneda', 'caFchinicio', 'caFchvencimiento', 'caFchcreado', 'caUsucreado', 'caConsecutivo', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDTRAYECTO, self::CA_IDCONCEPTO, self::CA_IDRECARGO, self::CA_VLRRECARGO, self::CA_APLICACION, self::CA_VLRMINIMO, self::CA_APLICACION_MIN, self::CA_OBSERVACIONES, self::CA_IDMONEDA, self::CA_FCHINICIO, self::CA_FCHVENCIMIENTO, self::CA_FCHCREADO, self::CA_USUCREADO, self::CA_CONSECUTIVO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idtrayecto', 'ca_idconcepto', 'ca_idrecargo', 'ca_vlrrecargo', 'ca_aplicacion', 'ca_vlrminimo', 'ca_aplicacion_min', 'ca_observaciones', 'ca_idmoneda', 'ca_fchinicio', 'ca_fchvencimiento', 'ca_fchcreado', 'ca_usucreado', 'ca_consecutivo', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdtrayecto' => 0, 'CaIdconcepto' => 1, 'CaIdrecargo' => 2, 'CaVlrrecargo' => 3, 'CaAplicacion' => 4, 'CaVlrminimo' => 5, 'CaAplicacionMin' => 6, 'CaObservaciones' => 7, 'CaIdmoneda' => 8, 'CaFchinicio' => 9, 'CaFchvencimiento' => 10, 'CaFchcreado' => 11, 'CaUsucreado' => 12, 'CaConsecutivo' => 13, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdtrayecto' => 0, 'caIdconcepto' => 1, 'caIdrecargo' => 2, 'caVlrrecargo' => 3, 'caAplicacion' => 4, 'caVlrminimo' => 5, 'caAplicacionMin' => 6, 'caObservaciones' => 7, 'caIdmoneda' => 8, 'caFchinicio' => 9, 'caFchvencimiento' => 10, 'caFchcreado' => 11, 'caUsucreado' => 12, 'caConsecutivo' => 13, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDTRAYECTO => 0, self::CA_IDCONCEPTO => 1, self::CA_IDRECARGO => 2, self::CA_VLRRECARGO => 3, self::CA_APLICACION => 4, self::CA_VLRMINIMO => 5, self::CA_APLICACION_MIN => 6, self::CA_OBSERVACIONES => 7, self::CA_IDMONEDA => 8, self::CA_FCHINICIO => 9, self::CA_FCHVENCIMIENTO => 10, self::CA_FCHCREADO => 11, self::CA_USUCREADO => 12, self::CA_CONSECUTIVO => 13, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idtrayecto' => 0, 'ca_idconcepto' => 1, 'ca_idrecargo' => 2, 'ca_vlrrecargo' => 3, 'ca_aplicacion' => 4, 'ca_vlrminimo' => 5, 'ca_aplicacion_min' => 6, 'ca_observaciones' => 7, 'ca_idmoneda' => 8, 'ca_fchinicio' => 9, 'ca_fchvencimiento' => 10, 'ca_fchcreado' => 11, 'ca_usucreado' => 12, 'ca_consecutivo' => 13, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	/**
	 * Get a (singleton) instance of the MapBuilder for this peer class.
	 * @return     MapBuilder The map builder for this peer
	 */
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new PricRecargoxConceptoLogMapBuilder();
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
	 * @param      string $column The column name for current table. (i.e. PricRecargoxConceptoLogPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(PricRecargoxConceptoLogPeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(PricRecargoxConceptoLogPeer::CA_IDTRAYECTO);

		$criteria->addSelectColumn(PricRecargoxConceptoLogPeer::CA_IDCONCEPTO);

		$criteria->addSelectColumn(PricRecargoxConceptoLogPeer::CA_IDRECARGO);

		$criteria->addSelectColumn(PricRecargoxConceptoLogPeer::CA_VLRRECARGO);

		$criteria->addSelectColumn(PricRecargoxConceptoLogPeer::CA_APLICACION);

		$criteria->addSelectColumn(PricRecargoxConceptoLogPeer::CA_VLRMINIMO);

		$criteria->addSelectColumn(PricRecargoxConceptoLogPeer::CA_APLICACION_MIN);

		$criteria->addSelectColumn(PricRecargoxConceptoLogPeer::CA_OBSERVACIONES);

		$criteria->addSelectColumn(PricRecargoxConceptoLogPeer::CA_IDMONEDA);

		$criteria->addSelectColumn(PricRecargoxConceptoLogPeer::CA_FCHINICIO);

		$criteria->addSelectColumn(PricRecargoxConceptoLogPeer::CA_FCHVENCIMIENTO);

		$criteria->addSelectColumn(PricRecargoxConceptoLogPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(PricRecargoxConceptoLogPeer::CA_USUCREADO);

		$criteria->addSelectColumn(PricRecargoxConceptoLogPeer::CA_CONSECUTIVO);

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
		$criteria->setPrimaryTableName(PricRecargoxConceptoLogPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricRecargoxConceptoLogPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(PricRecargoxConceptoLogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return     PricRecargoxConceptoLog
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = PricRecargoxConceptoLogPeer::doSelect($critcopy, $con);
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
		return PricRecargoxConceptoLogPeer::populateObjects(PricRecargoxConceptoLogPeer::doSelectStmt($criteria, $con));
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
			$con = Propel::getConnection(PricRecargoxConceptoLogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			PricRecargoxConceptoLogPeer::addSelectColumns($criteria);
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
	 * @param      PricRecargoxConceptoLog $value A PricRecargoxConceptoLog object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool(PricRecargoxConceptoLog $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaConsecutivo();
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
	 * @param      mixed $value A PricRecargoxConceptoLog object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof PricRecargoxConceptoLog) {
				$key = (string) $value->getCaConsecutivo();
			} elseif (is_scalar($value)) {
				// assume we've been passed a primary key
				$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or PricRecargoxConceptoLog object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	 * @return     PricRecargoxConceptoLog Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
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
		if ($row[$startcol + 13] === null) {
			return null;
		}
		return (string) $row[$startcol + 13];
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
		$cls = PricRecargoxConceptoLogPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = PricRecargoxConceptoLogPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = PricRecargoxConceptoLogPeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				PricRecargoxConceptoLogPeer::addInstanceToPool($obj, $key);
			} // if key exists
		}
		$stmt->closeCursor();
		return $results;
	}

	/**
	 * Returns the number of rows matching criteria, joining the related PricFlete table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinPricFlete(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(PricRecargoxConceptoLogPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricRecargoxConceptoLogPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricRecargoxConceptoLogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(PricRecargoxConceptoLogPeer::CA_IDTRAYECTO,PricRecargoxConceptoLogPeer::CA_IDCONCEPTO,), array(PricFletePeer::CA_IDTRAYECTO,PricFletePeer::CA_IDCONCEPTO,), $join_behavior);

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
	 * Returns the number of rows matching criteria, joining the related TipoRecargo table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinTipoRecargo(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(PricRecargoxConceptoLogPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricRecargoxConceptoLogPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricRecargoxConceptoLogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(PricRecargoxConceptoLogPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);

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
	 * Selects a collection of PricRecargoxConceptoLog objects pre-filled with their PricFlete objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of PricRecargoxConceptoLog objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinPricFlete(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PricRecargoxConceptoLogPeer::addSelectColumns($c);
		$startcol = (PricRecargoxConceptoLogPeer::NUM_COLUMNS - PricRecargoxConceptoLogPeer::NUM_LAZY_LOAD_COLUMNS);
		PricFletePeer::addSelectColumns($c);

		$c->addJoin(array(PricRecargoxConceptoLogPeer::CA_IDTRAYECTO,PricRecargoxConceptoLogPeer::CA_IDCONCEPTO,), array(PricFletePeer::CA_IDTRAYECTO,PricFletePeer::CA_IDCONCEPTO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricRecargoxConceptoLogPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricRecargoxConceptoLogPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = PricRecargoxConceptoLogPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricRecargoxConceptoLogPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = PricFletePeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = PricFletePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = PricFletePeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					PricFletePeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (PricRecargoxConceptoLog) to $obj2 (PricFlete)
				$obj2->addPricRecargoxConceptoLog($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of PricRecargoxConceptoLog objects pre-filled with their TipoRecargo objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of PricRecargoxConceptoLog objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinTipoRecargo(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PricRecargoxConceptoLogPeer::addSelectColumns($c);
		$startcol = (PricRecargoxConceptoLogPeer::NUM_COLUMNS - PricRecargoxConceptoLogPeer::NUM_LAZY_LOAD_COLUMNS);
		TipoRecargoPeer::addSelectColumns($c);

		$c->addJoin(array(PricRecargoxConceptoLogPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricRecargoxConceptoLogPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricRecargoxConceptoLogPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = PricRecargoxConceptoLogPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricRecargoxConceptoLogPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = TipoRecargoPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = TipoRecargoPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = TipoRecargoPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					TipoRecargoPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (PricRecargoxConceptoLog) to $obj2 (TipoRecargo)
				$obj2->addPricRecargoxConceptoLog($obj1);

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
		$criteria->setPrimaryTableName(PricRecargoxConceptoLogPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricRecargoxConceptoLogPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricRecargoxConceptoLogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(PricRecargoxConceptoLogPeer::CA_IDTRAYECTO,PricRecargoxConceptoLogPeer::CA_IDCONCEPTO,), array(PricFletePeer::CA_IDTRAYECTO,PricFletePeer::CA_IDCONCEPTO,), $join_behavior);
		$criteria->addJoin(array(PricRecargoxConceptoLogPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);
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
	 * Selects a collection of PricRecargoxConceptoLog objects pre-filled with all related objects.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of PricRecargoxConceptoLog objects.
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

		PricRecargoxConceptoLogPeer::addSelectColumns($c);
		$startcol2 = (PricRecargoxConceptoLogPeer::NUM_COLUMNS - PricRecargoxConceptoLogPeer::NUM_LAZY_LOAD_COLUMNS);

		PricFletePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (PricFletePeer::NUM_COLUMNS - PricFletePeer::NUM_LAZY_LOAD_COLUMNS);

		TipoRecargoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (TipoRecargoPeer::NUM_COLUMNS - TipoRecargoPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(PricRecargoxConceptoLogPeer::CA_IDTRAYECTO,PricRecargoxConceptoLogPeer::CA_IDCONCEPTO,), array(PricFletePeer::CA_IDTRAYECTO,PricFletePeer::CA_IDCONCEPTO,), $join_behavior);
		$c->addJoin(array(PricRecargoxConceptoLogPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricRecargoxConceptoLogPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricRecargoxConceptoLogPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = PricRecargoxConceptoLogPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricRecargoxConceptoLogPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

			// Add objects for joined PricFlete rows

			$key2 = PricFletePeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = PricFletePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = PricFletePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					PricFletePeer::addInstanceToPool($obj2, $key2);
				} // if obj2 loaded

				// Add the $obj1 (PricRecargoxConceptoLog) to the collection in $obj2 (PricFlete)
				$obj2->addPricRecargoxConceptoLog($obj1);
			} // if joined row not null

			// Add objects for joined TipoRecargo rows

			$key3 = TipoRecargoPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = TipoRecargoPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = TipoRecargoPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					TipoRecargoPeer::addInstanceToPool($obj3, $key3);
				} // if obj3 loaded

				// Add the $obj1 (PricRecargoxConceptoLog) to the collection in $obj3 (TipoRecargo)
				$obj3->addPricRecargoxConceptoLog($obj1);
			} // if joined row not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related PricFlete table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptPricFlete(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricRecargoxConceptoLogPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricRecargoxConceptoLogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(PricRecargoxConceptoLogPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);
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
	 * Returns the number of rows matching criteria, joining the related TipoRecargo table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptTipoRecargo(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricRecargoxConceptoLogPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricRecargoxConceptoLogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(PricRecargoxConceptoLogPeer::CA_IDTRAYECTO,PricRecargoxConceptoLogPeer::CA_IDCONCEPTO,), array(PricFletePeer::CA_IDTRAYECTO,PricFletePeer::CA_IDCONCEPTO,), $join_behavior);
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
	 * Selects a collection of PricRecargoxConceptoLog objects pre-filled with all related objects except PricFlete.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of PricRecargoxConceptoLog objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptPricFlete(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PricRecargoxConceptoLogPeer::addSelectColumns($c);
		$startcol2 = (PricRecargoxConceptoLogPeer::NUM_COLUMNS - PricRecargoxConceptoLogPeer::NUM_LAZY_LOAD_COLUMNS);

		TipoRecargoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (TipoRecargoPeer::NUM_COLUMNS - TipoRecargoPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(PricRecargoxConceptoLogPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricRecargoxConceptoLogPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricRecargoxConceptoLogPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = PricRecargoxConceptoLogPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricRecargoxConceptoLogPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined TipoRecargo rows

				$key2 = TipoRecargoPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = TipoRecargoPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = TipoRecargoPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					TipoRecargoPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (PricRecargoxConceptoLog) to the collection in $obj2 (TipoRecargo)
				$obj2->addPricRecargoxConceptoLog($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of PricRecargoxConceptoLog objects pre-filled with all related objects except TipoRecargo.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of PricRecargoxConceptoLog objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptTipoRecargo(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PricRecargoxConceptoLogPeer::addSelectColumns($c);
		$startcol2 = (PricRecargoxConceptoLogPeer::NUM_COLUMNS - PricRecargoxConceptoLogPeer::NUM_LAZY_LOAD_COLUMNS);

		PricFletePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (PricFletePeer::NUM_COLUMNS - PricFletePeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(PricRecargoxConceptoLogPeer::CA_IDTRAYECTO,PricRecargoxConceptoLogPeer::CA_IDCONCEPTO,), array(PricFletePeer::CA_IDTRAYECTO,PricFletePeer::CA_IDCONCEPTO,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricRecargoxConceptoLogPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricRecargoxConceptoLogPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = PricRecargoxConceptoLogPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricRecargoxConceptoLogPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined PricFlete rows

				$key2 = PricFletePeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = PricFletePeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = PricFletePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					PricFletePeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (PricRecargoxConceptoLog) to the collection in $obj2 (PricFlete)
				$obj2->addPricRecargoxConceptoLog($obj1);

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
		return PricRecargoxConceptoLogPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a PricRecargoxConceptoLog or Criteria object.
	 *
	 * @param      mixed $values Criteria or PricRecargoxConceptoLog object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(PricRecargoxConceptoLogPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from PricRecargoxConceptoLog object
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
	 * Method perform an UPDATE on the database, given a PricRecargoxConceptoLog or Criteria object.
	 *
	 * @param      mixed $values Criteria or PricRecargoxConceptoLog object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(PricRecargoxConceptoLogPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(PricRecargoxConceptoLogPeer::CA_CONSECUTIVO);
			$selectCriteria->add(PricRecargoxConceptoLogPeer::CA_CONSECUTIVO, $criteria->remove(PricRecargoxConceptoLogPeer::CA_CONSECUTIVO), $comparison);

		} else { // $values is PricRecargoxConceptoLog object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the bs_pricrecargosxconcepto table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(PricRecargoxConceptoLogPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(PricRecargoxConceptoLogPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a PricRecargoxConceptoLog or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or PricRecargoxConceptoLog object or primary key or array of primary keys
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
			$con = Propel::getConnection(PricRecargoxConceptoLogPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			PricRecargoxConceptoLogPeer::clearInstancePool();

			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof PricRecargoxConceptoLog) {
			// invalidate the cache for this single object
			PricRecargoxConceptoLogPeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key



			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(PricRecargoxConceptoLogPeer::CA_CONSECUTIVO, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
				// we can invalidate the cache for this single object
				PricRecargoxConceptoLogPeer::removeInstanceFromPool($singleval);
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
	 * Validates all modified columns of given PricRecargoxConceptoLog object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      PricRecargoxConceptoLog $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(PricRecargoxConceptoLog $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(PricRecargoxConceptoLogPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PricRecargoxConceptoLogPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(PricRecargoxConceptoLogPeer::DATABASE_NAME, PricRecargoxConceptoLogPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = PricRecargoxConceptoLogPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      int $pk the primary key.
	 * @param      PropelPDO $con the connection to use
	 * @return     PricRecargoxConceptoLog
	 */
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = PricRecargoxConceptoLogPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(PricRecargoxConceptoLogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(PricRecargoxConceptoLogPeer::DATABASE_NAME);
		$criteria->add(PricRecargoxConceptoLogPeer::CA_CONSECUTIVO, $pk);

		$v = PricRecargoxConceptoLogPeer::doSelect($criteria, $con);

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
			$con = Propel::getConnection(PricRecargoxConceptoLogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(PricRecargoxConceptoLogPeer::DATABASE_NAME);
			$criteria->add(PricRecargoxConceptoLogPeer::CA_CONSECUTIVO, $pks, Criteria::IN);
			$objs = PricRecargoxConceptoLogPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BasePricRecargoxConceptoLogPeer

// This is the static code needed to register the MapBuilder for this table with the main Propel class.
//
// NOTE: This static code cannot call methods on the PricRecargoxConceptoLogPeer class, because it is not defined yet.
// If you need to use overridden methods, you can add this code to the bottom of the PricRecargoxConceptoLogPeer class:
//
// Propel::getDatabaseMap(PricRecargoxConceptoLogPeer::DATABASE_NAME)->addTableBuilder(PricRecargoxConceptoLogPeer::TABLE_NAME, PricRecargoxConceptoLogPeer::getMapBuilder());
//
// Doing so will effectively overwrite the registration below.

Propel::getDatabaseMap(BasePricRecargoxConceptoLogPeer::DATABASE_NAME)->addTableBuilder(BasePricRecargoxConceptoLogPeer::TABLE_NAME, BasePricRecargoxConceptoLogPeer::getMapBuilder());

