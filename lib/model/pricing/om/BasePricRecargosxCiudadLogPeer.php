<?php

/**
 * Base static class for performing query and update operations on the 'bs_pricrecargosxciudad' table.
 *
 * 
 *
 * @package    lib.model.pricing.om
 */
abstract class BasePricRecargosxCiudadLogPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'bs_pricrecargosxciudad';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.pricing.PricRecargosxCiudadLog';

	/** The total number of columns. */
	const NUM_COLUMNS = 16;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** the column name for the CA_IDTRAFICO field */
	const CA_IDTRAFICO = 'bs_pricrecargosxciudad.CA_IDTRAFICO';

	/** the column name for the CA_IDCIUDAD field */
	const CA_IDCIUDAD = 'bs_pricrecargosxciudad.CA_IDCIUDAD';

	/** the column name for the CA_IDRECARGO field */
	const CA_IDRECARGO = 'bs_pricrecargosxciudad.CA_IDRECARGO';

	/** the column name for the CA_MODALIDAD field */
	const CA_MODALIDAD = 'bs_pricrecargosxciudad.CA_MODALIDAD';

	/** the column name for the CA_IMPOEXPO field */
	const CA_IMPOEXPO = 'bs_pricrecargosxciudad.CA_IMPOEXPO';

	/** the column name for the CA_VLRRECARGO field */
	const CA_VLRRECARGO = 'bs_pricrecargosxciudad.CA_VLRRECARGO';

	/** the column name for the CA_APLICACION field */
	const CA_APLICACION = 'bs_pricrecargosxciudad.CA_APLICACION';

	/** the column name for the CA_VLRMINIMO field */
	const CA_VLRMINIMO = 'bs_pricrecargosxciudad.CA_VLRMINIMO';

	/** the column name for the CA_APLICACION_MIN field */
	const CA_APLICACION_MIN = 'bs_pricrecargosxciudad.CA_APLICACION_MIN';

	/** the column name for the CA_OBSERVACIONES field */
	const CA_OBSERVACIONES = 'bs_pricrecargosxciudad.CA_OBSERVACIONES';

	/** the column name for the CA_FCHINICIO field */
	const CA_FCHINICIO = 'bs_pricrecargosxciudad.CA_FCHINICIO';

	/** the column name for the CA_FCHVENCIMIENTO field */
	const CA_FCHVENCIMIENTO = 'bs_pricrecargosxciudad.CA_FCHVENCIMIENTO';

	/** the column name for the CA_FCHCREADO field */
	const CA_FCHCREADO = 'bs_pricrecargosxciudad.CA_FCHCREADO';

	/** the column name for the CA_USUCREADO field */
	const CA_USUCREADO = 'bs_pricrecargosxciudad.CA_USUCREADO';

	/** the column name for the CA_IDMONEDA field */
	const CA_IDMONEDA = 'bs_pricrecargosxciudad.CA_IDMONEDA';

	/** the column name for the CA_CONSECUTIVO field */
	const CA_CONSECUTIVO = 'bs_pricrecargosxciudad.CA_CONSECUTIVO';

	/**
	 * An identiy map to hold any loaded instances of PricRecargosxCiudadLog objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array PricRecargosxCiudadLog[]
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
		BasePeer::TYPE_PHPNAME => array ('CaIdtrafico', 'CaIdciudad', 'CaIdrecargo', 'CaModalidad', 'CaImpoexpo', 'CaVlrrecargo', 'CaAplicacion', 'CaVlrminimo', 'CaAplicacionMin', 'CaObservaciones', 'CaFchinicio', 'CaFchvencimiento', 'CaFchcreado', 'CaUsucreado', 'CaIdmoneda', 'CaConsecutivo', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdtrafico', 'caIdciudad', 'caIdrecargo', 'caModalidad', 'caImpoexpo', 'caVlrrecargo', 'caAplicacion', 'caVlrminimo', 'caAplicacionMin', 'caObservaciones', 'caFchinicio', 'caFchvencimiento', 'caFchcreado', 'caUsucreado', 'caIdmoneda', 'caConsecutivo', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDTRAFICO, self::CA_IDCIUDAD, self::CA_IDRECARGO, self::CA_MODALIDAD, self::CA_IMPOEXPO, self::CA_VLRRECARGO, self::CA_APLICACION, self::CA_VLRMINIMO, self::CA_APLICACION_MIN, self::CA_OBSERVACIONES, self::CA_FCHINICIO, self::CA_FCHVENCIMIENTO, self::CA_FCHCREADO, self::CA_USUCREADO, self::CA_IDMONEDA, self::CA_CONSECUTIVO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idtrafico', 'ca_idciudad', 'ca_idrecargo', 'ca_modalidad', 'ca_impoexpo', 'ca_vlrrecargo', 'ca_aplicacion', 'ca_vlrminimo', 'ca_aplicacion_min', 'ca_observaciones', 'ca_fchinicio', 'ca_fchvencimiento', 'ca_fchcreado', 'ca_usucreado', 'ca_idmoneda', 'ca_consecutivo', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdtrafico' => 0, 'CaIdciudad' => 1, 'CaIdrecargo' => 2, 'CaModalidad' => 3, 'CaImpoexpo' => 4, 'CaVlrrecargo' => 5, 'CaAplicacion' => 6, 'CaVlrminimo' => 7, 'CaAplicacionMin' => 8, 'CaObservaciones' => 9, 'CaFchinicio' => 10, 'CaFchvencimiento' => 11, 'CaFchcreado' => 12, 'CaUsucreado' => 13, 'CaIdmoneda' => 14, 'CaConsecutivo' => 15, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdtrafico' => 0, 'caIdciudad' => 1, 'caIdrecargo' => 2, 'caModalidad' => 3, 'caImpoexpo' => 4, 'caVlrrecargo' => 5, 'caAplicacion' => 6, 'caVlrminimo' => 7, 'caAplicacionMin' => 8, 'caObservaciones' => 9, 'caFchinicio' => 10, 'caFchvencimiento' => 11, 'caFchcreado' => 12, 'caUsucreado' => 13, 'caIdmoneda' => 14, 'caConsecutivo' => 15, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDTRAFICO => 0, self::CA_IDCIUDAD => 1, self::CA_IDRECARGO => 2, self::CA_MODALIDAD => 3, self::CA_IMPOEXPO => 4, self::CA_VLRRECARGO => 5, self::CA_APLICACION => 6, self::CA_VLRMINIMO => 7, self::CA_APLICACION_MIN => 8, self::CA_OBSERVACIONES => 9, self::CA_FCHINICIO => 10, self::CA_FCHVENCIMIENTO => 11, self::CA_FCHCREADO => 12, self::CA_USUCREADO => 13, self::CA_IDMONEDA => 14, self::CA_CONSECUTIVO => 15, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idtrafico' => 0, 'ca_idciudad' => 1, 'ca_idrecargo' => 2, 'ca_modalidad' => 3, 'ca_impoexpo' => 4, 'ca_vlrrecargo' => 5, 'ca_aplicacion' => 6, 'ca_vlrminimo' => 7, 'ca_aplicacion_min' => 8, 'ca_observaciones' => 9, 'ca_fchinicio' => 10, 'ca_fchvencimiento' => 11, 'ca_fchcreado' => 12, 'ca_usucreado' => 13, 'ca_idmoneda' => 14, 'ca_consecutivo' => 15, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	/**
	 * Get a (singleton) instance of the MapBuilder for this peer class.
	 * @return     MapBuilder The map builder for this peer
	 */
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new PricRecargosxCiudadLogMapBuilder();
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
	 * @param      string $column The column name for current table. (i.e. PricRecargosxCiudadLogPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(PricRecargosxCiudadLogPeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::CA_IDTRAFICO);

		$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::CA_IDCIUDAD);

		$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::CA_IDRECARGO);

		$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::CA_MODALIDAD);

		$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::CA_IMPOEXPO);

		$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::CA_VLRRECARGO);

		$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::CA_APLICACION);

		$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::CA_VLRMINIMO);

		$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::CA_APLICACION_MIN);

		$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::CA_OBSERVACIONES);

		$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::CA_FCHINICIO);

		$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::CA_FCHVENCIMIENTO);

		$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::CA_USUCREADO);

		$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::CA_IDMONEDA);

		$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::CA_CONSECUTIVO);

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
		$criteria->setPrimaryTableName(PricRecargosxCiudadLogPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricRecargosxCiudadLogPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxCiudadLogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return     PricRecargosxCiudadLog
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = PricRecargosxCiudadLogPeer::doSelect($critcopy, $con);
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
		return PricRecargosxCiudadLogPeer::populateObjects(PricRecargosxCiudadLogPeer::doSelectStmt($criteria, $con));
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
			$con = Propel::getConnection(PricRecargosxCiudadLogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			PricRecargosxCiudadLogPeer::addSelectColumns($criteria);
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
	 * @param      PricRecargosxCiudadLog $value A PricRecargosxCiudadLog object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool(PricRecargosxCiudadLog $obj, $key = null)
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
	 * @param      mixed $value A PricRecargosxCiudadLog object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof PricRecargosxCiudadLog) {
				$key = (string) $value->getCaConsecutivo();
			} elseif (is_scalar($value)) {
				// assume we've been passed a primary key
				$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or PricRecargosxCiudadLog object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	 * @return     PricRecargosxCiudadLog Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
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
		if ($row[$startcol + 15] === null) {
			return null;
		}
		return (string) $row[$startcol + 15];
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
		$cls = PricRecargosxCiudadLogPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = PricRecargosxCiudadLogPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = PricRecargosxCiudadLogPeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				PricRecargosxCiudadLogPeer::addInstanceToPool($obj, $key);
			} // if key exists
		}
		$stmt->closeCursor();
		return $results;
	}

	/**
	 * Returns the number of rows matching criteria, joining the related Ciudad table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinCiudad(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(PricRecargosxCiudadLogPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricRecargosxCiudadLogPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxCiudadLogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(PricRecargosxCiudadLogPeer::CA_IDCIUDAD,), array(CiudadPeer::CA_IDCIUDAD,), $join_behavior);

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
		$criteria->setPrimaryTableName(PricRecargosxCiudadLogPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricRecargosxCiudadLogPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxCiudadLogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(PricRecargosxCiudadLogPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);

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
	 * Selects a collection of PricRecargosxCiudadLog objects pre-filled with their Ciudad objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of PricRecargosxCiudadLog objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinCiudad(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PricRecargosxCiudadLogPeer::addSelectColumns($c);
		$startcol = (PricRecargosxCiudadLogPeer::NUM_COLUMNS - PricRecargosxCiudadLogPeer::NUM_LAZY_LOAD_COLUMNS);
		CiudadPeer::addSelectColumns($c);

		$c->addJoin(array(PricRecargosxCiudadLogPeer::CA_IDCIUDAD,), array(CiudadPeer::CA_IDCIUDAD,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricRecargosxCiudadLogPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricRecargosxCiudadLogPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = PricRecargosxCiudadLogPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricRecargosxCiudadLogPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = CiudadPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = CiudadPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = CiudadPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					CiudadPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (PricRecargosxCiudadLog) to $obj2 (Ciudad)
				$obj2->addPricRecargosxCiudadLog($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of PricRecargosxCiudadLog objects pre-filled with their TipoRecargo objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of PricRecargosxCiudadLog objects.
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

		PricRecargosxCiudadLogPeer::addSelectColumns($c);
		$startcol = (PricRecargosxCiudadLogPeer::NUM_COLUMNS - PricRecargosxCiudadLogPeer::NUM_LAZY_LOAD_COLUMNS);
		TipoRecargoPeer::addSelectColumns($c);

		$c->addJoin(array(PricRecargosxCiudadLogPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricRecargosxCiudadLogPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricRecargosxCiudadLogPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = PricRecargosxCiudadLogPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricRecargosxCiudadLogPeer::addInstanceToPool($obj1, $key1);
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

				// Add the $obj1 (PricRecargosxCiudadLog) to $obj2 (TipoRecargo)
				$obj2->addPricRecargosxCiudadLog($obj1);

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
		$criteria->setPrimaryTableName(PricRecargosxCiudadLogPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricRecargosxCiudadLogPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxCiudadLogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(PricRecargosxCiudadLogPeer::CA_IDCIUDAD,), array(CiudadPeer::CA_IDCIUDAD,), $join_behavior);
		$criteria->addJoin(array(PricRecargosxCiudadLogPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);
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
	 * Selects a collection of PricRecargosxCiudadLog objects pre-filled with all related objects.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of PricRecargosxCiudadLog objects.
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

		PricRecargosxCiudadLogPeer::addSelectColumns($c);
		$startcol2 = (PricRecargosxCiudadLogPeer::NUM_COLUMNS - PricRecargosxCiudadLogPeer::NUM_LAZY_LOAD_COLUMNS);

		CiudadPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (CiudadPeer::NUM_COLUMNS - CiudadPeer::NUM_LAZY_LOAD_COLUMNS);

		TipoRecargoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (TipoRecargoPeer::NUM_COLUMNS - TipoRecargoPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(PricRecargosxCiudadLogPeer::CA_IDCIUDAD,), array(CiudadPeer::CA_IDCIUDAD,), $join_behavior);
		$c->addJoin(array(PricRecargosxCiudadLogPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricRecargosxCiudadLogPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricRecargosxCiudadLogPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = PricRecargosxCiudadLogPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricRecargosxCiudadLogPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

			// Add objects for joined Ciudad rows

			$key2 = CiudadPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = CiudadPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = CiudadPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					CiudadPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 loaded

				// Add the $obj1 (PricRecargosxCiudadLog) to the collection in $obj2 (Ciudad)
				$obj2->addPricRecargosxCiudadLog($obj1);
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

				// Add the $obj1 (PricRecargosxCiudadLog) to the collection in $obj3 (TipoRecargo)
				$obj3->addPricRecargosxCiudadLog($obj1);
			} // if joined row not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Ciudad table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptCiudad(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricRecargosxCiudadLogPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxCiudadLogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(PricRecargosxCiudadLogPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);
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
			PricRecargosxCiudadLogPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxCiudadLogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(PricRecargosxCiudadLogPeer::CA_IDCIUDAD,), array(CiudadPeer::CA_IDCIUDAD,), $join_behavior);
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
	 * Selects a collection of PricRecargosxCiudadLog objects pre-filled with all related objects except Ciudad.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of PricRecargosxCiudadLog objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptCiudad(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PricRecargosxCiudadLogPeer::addSelectColumns($c);
		$startcol2 = (PricRecargosxCiudadLogPeer::NUM_COLUMNS - PricRecargosxCiudadLogPeer::NUM_LAZY_LOAD_COLUMNS);

		TipoRecargoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (TipoRecargoPeer::NUM_COLUMNS - TipoRecargoPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(PricRecargosxCiudadLogPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricRecargosxCiudadLogPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricRecargosxCiudadLogPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = PricRecargosxCiudadLogPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricRecargosxCiudadLogPeer::addInstanceToPool($obj1, $key1);
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

				// Add the $obj1 (PricRecargosxCiudadLog) to the collection in $obj2 (TipoRecargo)
				$obj2->addPricRecargosxCiudadLog($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of PricRecargosxCiudadLog objects pre-filled with all related objects except TipoRecargo.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of PricRecargosxCiudadLog objects.
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

		PricRecargosxCiudadLogPeer::addSelectColumns($c);
		$startcol2 = (PricRecargosxCiudadLogPeer::NUM_COLUMNS - PricRecargosxCiudadLogPeer::NUM_LAZY_LOAD_COLUMNS);

		CiudadPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (CiudadPeer::NUM_COLUMNS - CiudadPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(PricRecargosxCiudadLogPeer::CA_IDCIUDAD,), array(CiudadPeer::CA_IDCIUDAD,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricRecargosxCiudadLogPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricRecargosxCiudadLogPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = PricRecargosxCiudadLogPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricRecargosxCiudadLogPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined Ciudad rows

				$key2 = CiudadPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = CiudadPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = CiudadPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					CiudadPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (PricRecargosxCiudadLog) to the collection in $obj2 (Ciudad)
				$obj2->addPricRecargosxCiudadLog($obj1);

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
		return PricRecargosxCiudadLogPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a PricRecargosxCiudadLog or Criteria object.
	 *
	 * @param      mixed $values Criteria or PricRecargosxCiudadLog object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxCiudadLogPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from PricRecargosxCiudadLog object
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
	 * Method perform an UPDATE on the database, given a PricRecargosxCiudadLog or Criteria object.
	 *
	 * @param      mixed $values Criteria or PricRecargosxCiudadLog object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxCiudadLogPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(PricRecargosxCiudadLogPeer::CA_CONSECUTIVO);
			$selectCriteria->add(PricRecargosxCiudadLogPeer::CA_CONSECUTIVO, $criteria->remove(PricRecargosxCiudadLogPeer::CA_CONSECUTIVO), $comparison);

		} else { // $values is PricRecargosxCiudadLog object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the bs_pricrecargosxciudad table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxCiudadLogPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(PricRecargosxCiudadLogPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a PricRecargosxCiudadLog or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or PricRecargosxCiudadLog object or primary key or array of primary keys
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
			$con = Propel::getConnection(PricRecargosxCiudadLogPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			PricRecargosxCiudadLogPeer::clearInstancePool();

			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof PricRecargosxCiudadLog) {
			// invalidate the cache for this single object
			PricRecargosxCiudadLogPeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key



			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(PricRecargosxCiudadLogPeer::CA_CONSECUTIVO, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
				// we can invalidate the cache for this single object
				PricRecargosxCiudadLogPeer::removeInstanceFromPool($singleval);
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
	 * Validates all modified columns of given PricRecargosxCiudadLog object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      PricRecargosxCiudadLog $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(PricRecargosxCiudadLog $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(PricRecargosxCiudadLogPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PricRecargosxCiudadLogPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(PricRecargosxCiudadLogPeer::DATABASE_NAME, PricRecargosxCiudadLogPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = PricRecargosxCiudadLogPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      int $pk the primary key.
	 * @param      PropelPDO $con the connection to use
	 * @return     PricRecargosxCiudadLog
	 */
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = PricRecargosxCiudadLogPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxCiudadLogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(PricRecargosxCiudadLogPeer::DATABASE_NAME);
		$criteria->add(PricRecargosxCiudadLogPeer::CA_CONSECUTIVO, $pk);

		$v = PricRecargosxCiudadLogPeer::doSelect($criteria, $con);

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
			$con = Propel::getConnection(PricRecargosxCiudadLogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(PricRecargosxCiudadLogPeer::DATABASE_NAME);
			$criteria->add(PricRecargosxCiudadLogPeer::CA_CONSECUTIVO, $pks, Criteria::IN);
			$objs = PricRecargosxCiudadLogPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BasePricRecargosxCiudadLogPeer

// This is the static code needed to register the MapBuilder for this table with the main Propel class.
//
// NOTE: This static code cannot call methods on the PricRecargosxCiudadLogPeer class, because it is not defined yet.
// If you need to use overridden methods, you can add this code to the bottom of the PricRecargosxCiudadLogPeer class:
//
// Propel::getDatabaseMap(PricRecargosxCiudadLogPeer::DATABASE_NAME)->addTableBuilder(PricRecargosxCiudadLogPeer::TABLE_NAME, PricRecargosxCiudadLogPeer::getMapBuilder());
//
// Doing so will effectively overwrite the registration below.

Propel::getDatabaseMap(BasePricRecargosxCiudadLogPeer::DATABASE_NAME)->addTableBuilder(BasePricRecargosxCiudadLogPeer::TABLE_NAME, BasePricRecargosxCiudadLogPeer::getMapBuilder());

