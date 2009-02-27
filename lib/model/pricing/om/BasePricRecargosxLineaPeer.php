<?php

/**
 * Base static class for performing query and update operations on the 'tb_pricrecargosxlinea' table.
 *
 * 
 *
 * @package    lib.model.pricing.om
 */
abstract class BasePricRecargosxLineaPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'tb_pricrecargosxlinea';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.pricing.PricRecargosxLinea';

	/** The total number of columns. */
	const NUM_COLUMNS = 17;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** the column name for the CA_IDTRAFICO field */
	const CA_IDTRAFICO = 'tb_pricrecargosxlinea.CA_IDTRAFICO';

	/** the column name for the CA_IDLINEA field */
	const CA_IDLINEA = 'tb_pricrecargosxlinea.CA_IDLINEA';

	/** the column name for the CA_IDRECARGO field */
	const CA_IDRECARGO = 'tb_pricrecargosxlinea.CA_IDRECARGO';

	/** the column name for the CA_IDCONCEPTO field */
	const CA_IDCONCEPTO = 'tb_pricrecargosxlinea.CA_IDCONCEPTO';

	/** the column name for the CA_MODALIDAD field */
	const CA_MODALIDAD = 'tb_pricrecargosxlinea.CA_MODALIDAD';

	/** the column name for the CA_IMPOEXPO field */
	const CA_IMPOEXPO = 'tb_pricrecargosxlinea.CA_IMPOEXPO';

	/** the column name for the CA_VLRRECARGO field */
	const CA_VLRRECARGO = 'tb_pricrecargosxlinea.CA_VLRRECARGO';

	/** the column name for the CA_APLICACION field */
	const CA_APLICACION = 'tb_pricrecargosxlinea.CA_APLICACION';

	/** the column name for the CA_VLRMINIMO field */
	const CA_VLRMINIMO = 'tb_pricrecargosxlinea.CA_VLRMINIMO';

	/** the column name for the CA_APLICACION_MIN field */
	const CA_APLICACION_MIN = 'tb_pricrecargosxlinea.CA_APLICACION_MIN';

	/** the column name for the CA_OBSERVACIONES field */
	const CA_OBSERVACIONES = 'tb_pricrecargosxlinea.CA_OBSERVACIONES';

	/** the column name for the CA_FCHINICIO field */
	const CA_FCHINICIO = 'tb_pricrecargosxlinea.CA_FCHINICIO';

	/** the column name for the CA_FCHVENCIMIENTO field */
	const CA_FCHVENCIMIENTO = 'tb_pricrecargosxlinea.CA_FCHVENCIMIENTO';

	/** the column name for the CA_FCHCREADO field */
	const CA_FCHCREADO = 'tb_pricrecargosxlinea.CA_FCHCREADO';

	/** the column name for the CA_USUCREADO field */
	const CA_USUCREADO = 'tb_pricrecargosxlinea.CA_USUCREADO';

	/** the column name for the CA_IDMONEDA field */
	const CA_IDMONEDA = 'tb_pricrecargosxlinea.CA_IDMONEDA';

	/** the column name for the CA_CONSECUTIVO field */
	const CA_CONSECUTIVO = 'tb_pricrecargosxlinea.CA_CONSECUTIVO';

	/**
	 * An identiy map to hold any loaded instances of PricRecargosxLinea objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array PricRecargosxLinea[]
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
		BasePeer::TYPE_PHPNAME => array ('CaIdtrafico', 'CaIdlinea', 'CaIdrecargo', 'CaIdconcepto', 'CaModalidad', 'CaImpoexpo', 'CaVlrrecargo', 'CaAplicacion', 'CaVlrminimo', 'CaAplicacionMin', 'CaObservaciones', 'CaFchinicio', 'CaFchvencimiento', 'CaFchcreado', 'CaUsucreado', 'CaIdmoneda', 'CaConsecutivo', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdtrafico', 'caIdlinea', 'caIdrecargo', 'caIdconcepto', 'caModalidad', 'caImpoexpo', 'caVlrrecargo', 'caAplicacion', 'caVlrminimo', 'caAplicacionMin', 'caObservaciones', 'caFchinicio', 'caFchvencimiento', 'caFchcreado', 'caUsucreado', 'caIdmoneda', 'caConsecutivo', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDTRAFICO, self::CA_IDLINEA, self::CA_IDRECARGO, self::CA_IDCONCEPTO, self::CA_MODALIDAD, self::CA_IMPOEXPO, self::CA_VLRRECARGO, self::CA_APLICACION, self::CA_VLRMINIMO, self::CA_APLICACION_MIN, self::CA_OBSERVACIONES, self::CA_FCHINICIO, self::CA_FCHVENCIMIENTO, self::CA_FCHCREADO, self::CA_USUCREADO, self::CA_IDMONEDA, self::CA_CONSECUTIVO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idtrafico', 'ca_idlinea', 'ca_idrecargo', 'ca_idconcepto', 'ca_modalidad', 'ca_impoexpo', 'ca_vlrrecargo', 'ca_aplicacion', 'ca_vlrminimo', 'ca_aplicacion_min', 'ca_observaciones', 'ca_fchinicio', 'ca_fchvencimiento', 'ca_fchcreado', 'ca_usucreado', 'ca_idmoneda', 'ca_consecutivo', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdtrafico' => 0, 'CaIdlinea' => 1, 'CaIdrecargo' => 2, 'CaIdconcepto' => 3, 'CaModalidad' => 4, 'CaImpoexpo' => 5, 'CaVlrrecargo' => 6, 'CaAplicacion' => 7, 'CaVlrminimo' => 8, 'CaAplicacionMin' => 9, 'CaObservaciones' => 10, 'CaFchinicio' => 11, 'CaFchvencimiento' => 12, 'CaFchcreado' => 13, 'CaUsucreado' => 14, 'CaIdmoneda' => 15, 'CaConsecutivo' => 16, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdtrafico' => 0, 'caIdlinea' => 1, 'caIdrecargo' => 2, 'caIdconcepto' => 3, 'caModalidad' => 4, 'caImpoexpo' => 5, 'caVlrrecargo' => 6, 'caAplicacion' => 7, 'caVlrminimo' => 8, 'caAplicacionMin' => 9, 'caObservaciones' => 10, 'caFchinicio' => 11, 'caFchvencimiento' => 12, 'caFchcreado' => 13, 'caUsucreado' => 14, 'caIdmoneda' => 15, 'caConsecutivo' => 16, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDTRAFICO => 0, self::CA_IDLINEA => 1, self::CA_IDRECARGO => 2, self::CA_IDCONCEPTO => 3, self::CA_MODALIDAD => 4, self::CA_IMPOEXPO => 5, self::CA_VLRRECARGO => 6, self::CA_APLICACION => 7, self::CA_VLRMINIMO => 8, self::CA_APLICACION_MIN => 9, self::CA_OBSERVACIONES => 10, self::CA_FCHINICIO => 11, self::CA_FCHVENCIMIENTO => 12, self::CA_FCHCREADO => 13, self::CA_USUCREADO => 14, self::CA_IDMONEDA => 15, self::CA_CONSECUTIVO => 16, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idtrafico' => 0, 'ca_idlinea' => 1, 'ca_idrecargo' => 2, 'ca_idconcepto' => 3, 'ca_modalidad' => 4, 'ca_impoexpo' => 5, 'ca_vlrrecargo' => 6, 'ca_aplicacion' => 7, 'ca_vlrminimo' => 8, 'ca_aplicacion_min' => 9, 'ca_observaciones' => 10, 'ca_fchinicio' => 11, 'ca_fchvencimiento' => 12, 'ca_fchcreado' => 13, 'ca_usucreado' => 14, 'ca_idmoneda' => 15, 'ca_consecutivo' => 16, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
	);

	/**
	 * Get a (singleton) instance of the MapBuilder for this peer class.
	 * @return     MapBuilder The map builder for this peer
	 */
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new PricRecargosxLineaMapBuilder();
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
	 * @param      string $column The column name for current table. (i.e. PricRecargosxLineaPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(PricRecargosxLineaPeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(PricRecargosxLineaPeer::CA_IDTRAFICO);

		$criteria->addSelectColumn(PricRecargosxLineaPeer::CA_IDLINEA);

		$criteria->addSelectColumn(PricRecargosxLineaPeer::CA_IDRECARGO);

		$criteria->addSelectColumn(PricRecargosxLineaPeer::CA_IDCONCEPTO);

		$criteria->addSelectColumn(PricRecargosxLineaPeer::CA_MODALIDAD);

		$criteria->addSelectColumn(PricRecargosxLineaPeer::CA_IMPOEXPO);

		$criteria->addSelectColumn(PricRecargosxLineaPeer::CA_VLRRECARGO);

		$criteria->addSelectColumn(PricRecargosxLineaPeer::CA_APLICACION);

		$criteria->addSelectColumn(PricRecargosxLineaPeer::CA_VLRMINIMO);

		$criteria->addSelectColumn(PricRecargosxLineaPeer::CA_APLICACION_MIN);

		$criteria->addSelectColumn(PricRecargosxLineaPeer::CA_OBSERVACIONES);

		$criteria->addSelectColumn(PricRecargosxLineaPeer::CA_FCHINICIO);

		$criteria->addSelectColumn(PricRecargosxLineaPeer::CA_FCHVENCIMIENTO);

		$criteria->addSelectColumn(PricRecargosxLineaPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(PricRecargosxLineaPeer::CA_USUCREADO);

		$criteria->addSelectColumn(PricRecargosxLineaPeer::CA_IDMONEDA);

		$criteria->addSelectColumn(PricRecargosxLineaPeer::CA_CONSECUTIVO);

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
		$criteria->setPrimaryTableName(PricRecargosxLineaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricRecargosxLineaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxLineaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return     PricRecargosxLinea
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = PricRecargosxLineaPeer::doSelect($critcopy, $con);
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
		return PricRecargosxLineaPeer::populateObjects(PricRecargosxLineaPeer::doSelectStmt($criteria, $con));
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
			$con = Propel::getConnection(PricRecargosxLineaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			PricRecargosxLineaPeer::addSelectColumns($criteria);
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
	 * @param      PricRecargosxLinea $value A PricRecargosxLinea object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool(PricRecargosxLinea $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getCaIdtrafico(), (string) $obj->getCaIdlinea(), (string) $obj->getCaIdrecargo(), (string) $obj->getCaIdconcepto(), (string) $obj->getCaModalidad(), (string) $obj->getCaImpoexpo()));
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
	 * @param      mixed $value A PricRecargosxLinea object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof PricRecargosxLinea) {
				$key = serialize(array((string) $value->getCaIdtrafico(), (string) $value->getCaIdlinea(), (string) $value->getCaIdrecargo(), (string) $value->getCaIdconcepto(), (string) $value->getCaModalidad(), (string) $value->getCaImpoexpo()));
			} elseif (is_array($value) && count($value) === 6) {
				// assume we've been passed a primary key
				$key = serialize(array((string) $value[0], (string) $value[1], (string) $value[2], (string) $value[3], (string) $value[4], (string) $value[5]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or PricRecargosxLinea object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	 * @return     PricRecargosxLinea Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
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
		if ($row[$startcol + 0] === null && $row[$startcol + 1] === null && $row[$startcol + 2] === null && $row[$startcol + 3] === null && $row[$startcol + 4] === null && $row[$startcol + 5] === null) {
			return null;
		}
		return serialize(array((string) $row[$startcol + 0], (string) $row[$startcol + 1], (string) $row[$startcol + 2], (string) $row[$startcol + 3], (string) $row[$startcol + 4], (string) $row[$startcol + 5]));
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
		$cls = PricRecargosxLineaPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = PricRecargosxLineaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = PricRecargosxLineaPeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				PricRecargosxLineaPeer::addInstanceToPool($obj, $key);
			} // if key exists
		}
		$stmt->closeCursor();
		return $results;
	}

	/**
	 * Returns the number of rows matching criteria, joining the related Transportador table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinTransportador(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(PricRecargosxLineaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricRecargosxLineaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxLineaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(PricRecargosxLineaPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);

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
		$criteria->setPrimaryTableName(PricRecargosxLineaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricRecargosxLineaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxLineaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(PricRecargosxLineaPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);

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
	 * Returns the number of rows matching criteria, joining the related Concepto table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinConcepto(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(PricRecargosxLineaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricRecargosxLineaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxLineaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(PricRecargosxLineaPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);

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
	 * Selects a collection of PricRecargosxLinea objects pre-filled with their Transportador objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of PricRecargosxLinea objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinTransportador(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PricRecargosxLineaPeer::addSelectColumns($c);
		$startcol = (PricRecargosxLineaPeer::NUM_COLUMNS - PricRecargosxLineaPeer::NUM_LAZY_LOAD_COLUMNS);
		TransportadorPeer::addSelectColumns($c);

		$c->addJoin(array(PricRecargosxLineaPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricRecargosxLineaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricRecargosxLineaPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = PricRecargosxLineaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricRecargosxLineaPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = TransportadorPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = TransportadorPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = TransportadorPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					TransportadorPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (PricRecargosxLinea) to $obj2 (Transportador)
				$obj2->addPricRecargosxLinea($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of PricRecargosxLinea objects pre-filled with their TipoRecargo objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of PricRecargosxLinea objects.
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

		PricRecargosxLineaPeer::addSelectColumns($c);
		$startcol = (PricRecargosxLineaPeer::NUM_COLUMNS - PricRecargosxLineaPeer::NUM_LAZY_LOAD_COLUMNS);
		TipoRecargoPeer::addSelectColumns($c);

		$c->addJoin(array(PricRecargosxLineaPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricRecargosxLineaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricRecargosxLineaPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = PricRecargosxLineaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricRecargosxLineaPeer::addInstanceToPool($obj1, $key1);
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

				// Add the $obj1 (PricRecargosxLinea) to $obj2 (TipoRecargo)
				$obj2->addPricRecargosxLinea($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of PricRecargosxLinea objects pre-filled with their Concepto objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of PricRecargosxLinea objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinConcepto(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PricRecargosxLineaPeer::addSelectColumns($c);
		$startcol = (PricRecargosxLineaPeer::NUM_COLUMNS - PricRecargosxLineaPeer::NUM_LAZY_LOAD_COLUMNS);
		ConceptoPeer::addSelectColumns($c);

		$c->addJoin(array(PricRecargosxLineaPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricRecargosxLineaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricRecargosxLineaPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = PricRecargosxLineaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricRecargosxLineaPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = ConceptoPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = ConceptoPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = ConceptoPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					ConceptoPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (PricRecargosxLinea) to $obj2 (Concepto)
				$obj2->addPricRecargosxLinea($obj1);

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
		$criteria->setPrimaryTableName(PricRecargosxLineaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricRecargosxLineaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxLineaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(PricRecargosxLineaPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
		$criteria->addJoin(array(PricRecargosxLineaPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);
		$criteria->addJoin(array(PricRecargosxLineaPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);
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
	 * Selects a collection of PricRecargosxLinea objects pre-filled with all related objects.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of PricRecargosxLinea objects.
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

		PricRecargosxLineaPeer::addSelectColumns($c);
		$startcol2 = (PricRecargosxLineaPeer::NUM_COLUMNS - PricRecargosxLineaPeer::NUM_LAZY_LOAD_COLUMNS);

		TransportadorPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (TransportadorPeer::NUM_COLUMNS - TransportadorPeer::NUM_LAZY_LOAD_COLUMNS);

		TipoRecargoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (TipoRecargoPeer::NUM_COLUMNS - TipoRecargoPeer::NUM_LAZY_LOAD_COLUMNS);

		ConceptoPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (ConceptoPeer::NUM_COLUMNS - ConceptoPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(PricRecargosxLineaPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
		$c->addJoin(array(PricRecargosxLineaPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);
		$c->addJoin(array(PricRecargosxLineaPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricRecargosxLineaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricRecargosxLineaPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = PricRecargosxLineaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricRecargosxLineaPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

			// Add objects for joined Transportador rows

			$key2 = TransportadorPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = TransportadorPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = TransportadorPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					TransportadorPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 loaded

				// Add the $obj1 (PricRecargosxLinea) to the collection in $obj2 (Transportador)
				$obj2->addPricRecargosxLinea($obj1);
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

				// Add the $obj1 (PricRecargosxLinea) to the collection in $obj3 (TipoRecargo)
				$obj3->addPricRecargosxLinea($obj1);
			} // if joined row not null

			// Add objects for joined Concepto rows

			$key4 = ConceptoPeer::getPrimaryKeyHashFromRow($row, $startcol4);
			if ($key4 !== null) {
				$obj4 = ConceptoPeer::getInstanceFromPool($key4);
				if (!$obj4) {

					$omClass = ConceptoPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					ConceptoPeer::addInstanceToPool($obj4, $key4);
				} // if obj4 loaded

				// Add the $obj1 (PricRecargosxLinea) to the collection in $obj4 (Concepto)
				$obj4->addPricRecargosxLinea($obj1);
			} // if joined row not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Transportador table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptTransportador(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricRecargosxLineaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxLineaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(PricRecargosxLineaPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);
				$criteria->addJoin(array(PricRecargosxLineaPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);
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
			PricRecargosxLineaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxLineaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(PricRecargosxLineaPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
				$criteria->addJoin(array(PricRecargosxLineaPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);
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
	 * Returns the number of rows matching criteria, joining the related Concepto table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptConcepto(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricRecargosxLineaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxLineaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(PricRecargosxLineaPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
				$criteria->addJoin(array(PricRecargosxLineaPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);
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
	 * Selects a collection of PricRecargosxLinea objects pre-filled with all related objects except Transportador.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of PricRecargosxLinea objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptTransportador(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PricRecargosxLineaPeer::addSelectColumns($c);
		$startcol2 = (PricRecargosxLineaPeer::NUM_COLUMNS - PricRecargosxLineaPeer::NUM_LAZY_LOAD_COLUMNS);

		TipoRecargoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (TipoRecargoPeer::NUM_COLUMNS - TipoRecargoPeer::NUM_LAZY_LOAD_COLUMNS);

		ConceptoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (ConceptoPeer::NUM_COLUMNS - ConceptoPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(PricRecargosxLineaPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);
				$c->addJoin(array(PricRecargosxLineaPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricRecargosxLineaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricRecargosxLineaPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = PricRecargosxLineaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricRecargosxLineaPeer::addInstanceToPool($obj1, $key1);
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

				// Add the $obj1 (PricRecargosxLinea) to the collection in $obj2 (TipoRecargo)
				$obj2->addPricRecargosxLinea($obj1);

			} // if joined row is not null

				// Add objects for joined Concepto rows

				$key3 = ConceptoPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = ConceptoPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = ConceptoPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					ConceptoPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (PricRecargosxLinea) to the collection in $obj3 (Concepto)
				$obj3->addPricRecargosxLinea($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of PricRecargosxLinea objects pre-filled with all related objects except TipoRecargo.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of PricRecargosxLinea objects.
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

		PricRecargosxLineaPeer::addSelectColumns($c);
		$startcol2 = (PricRecargosxLineaPeer::NUM_COLUMNS - PricRecargosxLineaPeer::NUM_LAZY_LOAD_COLUMNS);

		TransportadorPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (TransportadorPeer::NUM_COLUMNS - TransportadorPeer::NUM_LAZY_LOAD_COLUMNS);

		ConceptoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (ConceptoPeer::NUM_COLUMNS - ConceptoPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(PricRecargosxLineaPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
				$c->addJoin(array(PricRecargosxLineaPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricRecargosxLineaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricRecargosxLineaPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = PricRecargosxLineaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricRecargosxLineaPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined Transportador rows

				$key2 = TransportadorPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = TransportadorPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = TransportadorPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					TransportadorPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (PricRecargosxLinea) to the collection in $obj2 (Transportador)
				$obj2->addPricRecargosxLinea($obj1);

			} // if joined row is not null

				// Add objects for joined Concepto rows

				$key3 = ConceptoPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = ConceptoPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = ConceptoPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					ConceptoPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (PricRecargosxLinea) to the collection in $obj3 (Concepto)
				$obj3->addPricRecargosxLinea($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of PricRecargosxLinea objects pre-filled with all related objects except Concepto.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of PricRecargosxLinea objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptConcepto(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PricRecargosxLineaPeer::addSelectColumns($c);
		$startcol2 = (PricRecargosxLineaPeer::NUM_COLUMNS - PricRecargosxLineaPeer::NUM_LAZY_LOAD_COLUMNS);

		TransportadorPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (TransportadorPeer::NUM_COLUMNS - TransportadorPeer::NUM_LAZY_LOAD_COLUMNS);

		TipoRecargoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (TipoRecargoPeer::NUM_COLUMNS - TipoRecargoPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(PricRecargosxLineaPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
				$c->addJoin(array(PricRecargosxLineaPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricRecargosxLineaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricRecargosxLineaPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = PricRecargosxLineaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricRecargosxLineaPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined Transportador rows

				$key2 = TransportadorPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = TransportadorPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = TransportadorPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					TransportadorPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (PricRecargosxLinea) to the collection in $obj2 (Transportador)
				$obj2->addPricRecargosxLinea($obj1);

			} // if joined row is not null

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
				} // if $obj3 already loaded

				// Add the $obj1 (PricRecargosxLinea) to the collection in $obj3 (TipoRecargo)
				$obj3->addPricRecargosxLinea($obj1);

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
		return PricRecargosxLineaPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a PricRecargosxLinea or Criteria object.
	 *
	 * @param      mixed $values Criteria or PricRecargosxLinea object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxLineaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from PricRecargosxLinea object
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
	 * Method perform an UPDATE on the database, given a PricRecargosxLinea or Criteria object.
	 *
	 * @param      mixed $values Criteria or PricRecargosxLinea object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxLineaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(PricRecargosxLineaPeer::CA_IDTRAFICO);
			$selectCriteria->add(PricRecargosxLineaPeer::CA_IDTRAFICO, $criteria->remove(PricRecargosxLineaPeer::CA_IDTRAFICO), $comparison);

			$comparison = $criteria->getComparison(PricRecargosxLineaPeer::CA_IDLINEA);
			$selectCriteria->add(PricRecargosxLineaPeer::CA_IDLINEA, $criteria->remove(PricRecargosxLineaPeer::CA_IDLINEA), $comparison);

			$comparison = $criteria->getComparison(PricRecargosxLineaPeer::CA_IDRECARGO);
			$selectCriteria->add(PricRecargosxLineaPeer::CA_IDRECARGO, $criteria->remove(PricRecargosxLineaPeer::CA_IDRECARGO), $comparison);

			$comparison = $criteria->getComparison(PricRecargosxLineaPeer::CA_IDCONCEPTO);
			$selectCriteria->add(PricRecargosxLineaPeer::CA_IDCONCEPTO, $criteria->remove(PricRecargosxLineaPeer::CA_IDCONCEPTO), $comparison);

			$comparison = $criteria->getComparison(PricRecargosxLineaPeer::CA_MODALIDAD);
			$selectCriteria->add(PricRecargosxLineaPeer::CA_MODALIDAD, $criteria->remove(PricRecargosxLineaPeer::CA_MODALIDAD), $comparison);

			$comparison = $criteria->getComparison(PricRecargosxLineaPeer::CA_IMPOEXPO);
			$selectCriteria->add(PricRecargosxLineaPeer::CA_IMPOEXPO, $criteria->remove(PricRecargosxLineaPeer::CA_IMPOEXPO), $comparison);

		} else { // $values is PricRecargosxLinea object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the tb_pricrecargosxlinea table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxLineaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(PricRecargosxLineaPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a PricRecargosxLinea or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or PricRecargosxLinea object or primary key or array of primary keys
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
			$con = Propel::getConnection(PricRecargosxLineaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			PricRecargosxLineaPeer::clearInstancePool();

			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof PricRecargosxLinea) {
			// invalidate the cache for this single object
			PricRecargosxLineaPeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key



			$criteria = new Criteria(self::DATABASE_NAME);
			// primary key is composite; we therefore, expect
			// the primary key passed to be an array of pkey
			// values
			if (count($values) == count($values, COUNT_RECURSIVE)) {
				// array is not multi-dimensional
				$values = array($values);
			}

			foreach ($values as $value) {

				$criterion = $criteria->getNewCriterion(PricRecargosxLineaPeer::CA_IDTRAFICO, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(PricRecargosxLineaPeer::CA_IDLINEA, $value[1]));
				$criterion->addAnd($criteria->getNewCriterion(PricRecargosxLineaPeer::CA_IDRECARGO, $value[2]));
				$criterion->addAnd($criteria->getNewCriterion(PricRecargosxLineaPeer::CA_IDCONCEPTO, $value[3]));
				$criterion->addAnd($criteria->getNewCriterion(PricRecargosxLineaPeer::CA_MODALIDAD, $value[4]));
				$criterion->addAnd($criteria->getNewCriterion(PricRecargosxLineaPeer::CA_IMPOEXPO, $value[5]));
				$criteria->addOr($criterion);

				// we can invalidate the cache for this single PK
				PricRecargosxLineaPeer::removeInstanceFromPool($value);
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
	 * Validates all modified columns of given PricRecargosxLinea object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      PricRecargosxLinea $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(PricRecargosxLinea $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(PricRecargosxLineaPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PricRecargosxLineaPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(PricRecargosxLineaPeer::DATABASE_NAME, PricRecargosxLineaPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = PricRecargosxLineaPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	/**
	 * Retrieve object using using composite pkey values.
	 * @param      string $ca_idtrafico
	   @param      string $ca_idlinea
	   @param      int $ca_idrecargo
	   @param      int $ca_idconcepto
	   @param      string $ca_modalidad
	   @param      string $ca_impoexpo
	   
	 * @param      PropelPDO $con
	 * @return     PricRecargosxLinea
	 */
	public static function retrieveByPK($ca_idtrafico, $ca_idlinea, $ca_idrecargo, $ca_idconcepto, $ca_modalidad, $ca_impoexpo, PropelPDO $con = null) {
		$key = serialize(array((string) $ca_idtrafico, (string) $ca_idlinea, (string) $ca_idrecargo, (string) $ca_idconcepto, (string) $ca_modalidad, (string) $ca_impoexpo));
 		if (null !== ($obj = PricRecargosxLineaPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxLineaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(PricRecargosxLineaPeer::DATABASE_NAME);
		$criteria->add(PricRecargosxLineaPeer::CA_IDTRAFICO, $ca_idtrafico);
		$criteria->add(PricRecargosxLineaPeer::CA_IDLINEA, $ca_idlinea);
		$criteria->add(PricRecargosxLineaPeer::CA_IDRECARGO, $ca_idrecargo);
		$criteria->add(PricRecargosxLineaPeer::CA_IDCONCEPTO, $ca_idconcepto);
		$criteria->add(PricRecargosxLineaPeer::CA_MODALIDAD, $ca_modalidad);
		$criteria->add(PricRecargosxLineaPeer::CA_IMPOEXPO, $ca_impoexpo);
		$v = PricRecargosxLineaPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} // BasePricRecargosxLineaPeer

// This is the static code needed to register the MapBuilder for this table with the main Propel class.
//
// NOTE: This static code cannot call methods on the PricRecargosxLineaPeer class, because it is not defined yet.
// If you need to use overridden methods, you can add this code to the bottom of the PricRecargosxLineaPeer class:
//
// Propel::getDatabaseMap(PricRecargosxLineaPeer::DATABASE_NAME)->addTableBuilder(PricRecargosxLineaPeer::TABLE_NAME, PricRecargosxLineaPeer::getMapBuilder());
//
// Doing so will effectively overwrite the registration below.

Propel::getDatabaseMap(BasePricRecargosxLineaPeer::DATABASE_NAME)->addTableBuilder(BasePricRecargosxLineaPeer::TABLE_NAME, BasePricRecargosxLineaPeer::getMapBuilder());

