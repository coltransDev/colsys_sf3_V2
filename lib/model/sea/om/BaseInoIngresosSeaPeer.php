<?php

/**
 * Base static class for performing query and update operations on the 'tb_inoingresos_sea' table.
 *
 * 
 *
 * @package    lib.model.sea.om
 */
abstract class BaseInoIngresosSeaPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'tb_inoingresos_sea';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.sea.InoIngresosSea';

	/** The total number of columns. */
	const NUM_COLUMNS = 16;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** the column name for the CA_REFERENCIA field */
	const CA_REFERENCIA = 'tb_inoingresos_sea.CA_REFERENCIA';

	/** the column name for the CA_IDCLIENTE field */
	const CA_IDCLIENTE = 'tb_inoingresos_sea.CA_IDCLIENTE';

	/** the column name for the CA_HBLS field */
	const CA_HBLS = 'tb_inoingresos_sea.CA_HBLS';

	/** the column name for the CA_FACTURA field */
	const CA_FACTURA = 'tb_inoingresos_sea.CA_FACTURA';

	/** the column name for the CA_FCHFACTURA field */
	const CA_FCHFACTURA = 'tb_inoingresos_sea.CA_FCHFACTURA';

	/** the column name for the CA_IDMONEDA field */
	const CA_IDMONEDA = 'tb_inoingresos_sea.CA_IDMONEDA';

	/** the column name for the CA_NETO field */
	const CA_NETO = 'tb_inoingresos_sea.CA_NETO';

	/** the column name for the CA_VALOR field */
	const CA_VALOR = 'tb_inoingresos_sea.CA_VALOR';

	/** the column name for the CA_RECCAJA field */
	const CA_RECCAJA = 'tb_inoingresos_sea.CA_RECCAJA';

	/** the column name for the CA_FCHPAGO field */
	const CA_FCHPAGO = 'tb_inoingresos_sea.CA_FCHPAGO';

	/** the column name for the CA_TCAMBIO field */
	const CA_TCAMBIO = 'tb_inoingresos_sea.CA_TCAMBIO';

	/** the column name for the CA_FCHCREADO field */
	const CA_FCHCREADO = 'tb_inoingresos_sea.CA_FCHCREADO';

	/** the column name for the CA_USUCREADO field */
	const CA_USUCREADO = 'tb_inoingresos_sea.CA_USUCREADO';

	/** the column name for the CA_FCHACTUALIZADO field */
	const CA_FCHACTUALIZADO = 'tb_inoingresos_sea.CA_FCHACTUALIZADO';

	/** the column name for the CA_USUACTUALIZADO field */
	const CA_USUACTUALIZADO = 'tb_inoingresos_sea.CA_USUACTUALIZADO';

	/** the column name for the CA_OBSERVACIONES field */
	const CA_OBSERVACIONES = 'tb_inoingresos_sea.CA_OBSERVACIONES';

	/**
	 * An identiy map to hold any loaded instances of InoIngresosSea objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array InoIngresosSea[]
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
		BasePeer::TYPE_PHPNAME => array ('CaReferencia', 'CaIdcliente', 'CaHbls', 'CaFactura', 'CaFchfactura', 'CaIdmoneda', 'CaNeto', 'CaValor', 'CaReccaja', 'CaFchpago', 'CaTcambio', 'CaFchcreado', 'CaUsucreado', 'CaFchactualizado', 'CaUsuactualizado', 'CaObservaciones', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caReferencia', 'caIdcliente', 'caHbls', 'caFactura', 'caFchfactura', 'caIdmoneda', 'caNeto', 'caValor', 'caReccaja', 'caFchpago', 'caTcambio', 'caFchcreado', 'caUsucreado', 'caFchactualizado', 'caUsuactualizado', 'caObservaciones', ),
		BasePeer::TYPE_COLNAME => array (self::CA_REFERENCIA, self::CA_IDCLIENTE, self::CA_HBLS, self::CA_FACTURA, self::CA_FCHFACTURA, self::CA_IDMONEDA, self::CA_NETO, self::CA_VALOR, self::CA_RECCAJA, self::CA_FCHPAGO, self::CA_TCAMBIO, self::CA_FCHCREADO, self::CA_USUCREADO, self::CA_FCHACTUALIZADO, self::CA_USUACTUALIZADO, self::CA_OBSERVACIONES, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_referencia', 'ca_idcliente', 'ca_hbls', 'ca_factura', 'ca_fchfactura', 'ca_idmoneda', 'ca_neto', 'ca_valor', 'ca_reccaja', 'ca_fchpago', 'ca_tcambio', 'ca_fchcreado', 'ca_usucreado', 'ca_fchactualizado', 'ca_usuactualizado', 'ca_observaciones', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaReferencia' => 0, 'CaIdcliente' => 1, 'CaHbls' => 2, 'CaFactura' => 3, 'CaFchfactura' => 4, 'CaIdmoneda' => 5, 'CaNeto' => 6, 'CaValor' => 7, 'CaReccaja' => 8, 'CaFchpago' => 9, 'CaTcambio' => 10, 'CaFchcreado' => 11, 'CaUsucreado' => 12, 'CaFchactualizado' => 13, 'CaUsuactualizado' => 14, 'CaObservaciones' => 15, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caReferencia' => 0, 'caIdcliente' => 1, 'caHbls' => 2, 'caFactura' => 3, 'caFchfactura' => 4, 'caIdmoneda' => 5, 'caNeto' => 6, 'caValor' => 7, 'caReccaja' => 8, 'caFchpago' => 9, 'caTcambio' => 10, 'caFchcreado' => 11, 'caUsucreado' => 12, 'caFchactualizado' => 13, 'caUsuactualizado' => 14, 'caObservaciones' => 15, ),
		BasePeer::TYPE_COLNAME => array (self::CA_REFERENCIA => 0, self::CA_IDCLIENTE => 1, self::CA_HBLS => 2, self::CA_FACTURA => 3, self::CA_FCHFACTURA => 4, self::CA_IDMONEDA => 5, self::CA_NETO => 6, self::CA_VALOR => 7, self::CA_RECCAJA => 8, self::CA_FCHPAGO => 9, self::CA_TCAMBIO => 10, self::CA_FCHCREADO => 11, self::CA_USUCREADO => 12, self::CA_FCHACTUALIZADO => 13, self::CA_USUACTUALIZADO => 14, self::CA_OBSERVACIONES => 15, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_referencia' => 0, 'ca_idcliente' => 1, 'ca_hbls' => 2, 'ca_factura' => 3, 'ca_fchfactura' => 4, 'ca_idmoneda' => 5, 'ca_neto' => 6, 'ca_valor' => 7, 'ca_reccaja' => 8, 'ca_fchpago' => 9, 'ca_tcambio' => 10, 'ca_fchcreado' => 11, 'ca_usucreado' => 12, 'ca_fchactualizado' => 13, 'ca_usuactualizado' => 14, 'ca_observaciones' => 15, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	/**
	 * Get a (singleton) instance of the MapBuilder for this peer class.
	 * @return     MapBuilder The map builder for this peer
	 */
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new InoIngresosSeaMapBuilder();
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
	 * @param      string $column The column name for current table. (i.e. InoIngresosSeaPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(InoIngresosSeaPeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(InoIngresosSeaPeer::CA_REFERENCIA);

		$criteria->addSelectColumn(InoIngresosSeaPeer::CA_IDCLIENTE);

		$criteria->addSelectColumn(InoIngresosSeaPeer::CA_HBLS);

		$criteria->addSelectColumn(InoIngresosSeaPeer::CA_FACTURA);

		$criteria->addSelectColumn(InoIngresosSeaPeer::CA_FCHFACTURA);

		$criteria->addSelectColumn(InoIngresosSeaPeer::CA_IDMONEDA);

		$criteria->addSelectColumn(InoIngresosSeaPeer::CA_NETO);

		$criteria->addSelectColumn(InoIngresosSeaPeer::CA_VALOR);

		$criteria->addSelectColumn(InoIngresosSeaPeer::CA_RECCAJA);

		$criteria->addSelectColumn(InoIngresosSeaPeer::CA_FCHPAGO);

		$criteria->addSelectColumn(InoIngresosSeaPeer::CA_TCAMBIO);

		$criteria->addSelectColumn(InoIngresosSeaPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(InoIngresosSeaPeer::CA_USUCREADO);

		$criteria->addSelectColumn(InoIngresosSeaPeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(InoIngresosSeaPeer::CA_USUACTUALIZADO);

		$criteria->addSelectColumn(InoIngresosSeaPeer::CA_OBSERVACIONES);

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
		$criteria->setPrimaryTableName(InoIngresosSeaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoIngresosSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(InoIngresosSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return     InoIngresosSea
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = InoIngresosSeaPeer::doSelect($critcopy, $con);
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
		return InoIngresosSeaPeer::populateObjects(InoIngresosSeaPeer::doSelectStmt($criteria, $con));
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
			$con = Propel::getConnection(InoIngresosSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			InoIngresosSeaPeer::addSelectColumns($criteria);
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
	 * @param      InoIngresosSea $value A InoIngresosSea object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool(InoIngresosSea $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getCaReferencia(), (string) $obj->getCaIdcliente(), (string) $obj->getCaHbls(), (string) $obj->getCaFactura()));
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
	 * @param      mixed $value A InoIngresosSea object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof InoIngresosSea) {
				$key = serialize(array((string) $value->getCaReferencia(), (string) $value->getCaIdcliente(), (string) $value->getCaHbls(), (string) $value->getCaFactura()));
			} elseif (is_array($value) && count($value) === 4) {
				// assume we've been passed a primary key
				$key = serialize(array((string) $value[0], (string) $value[1], (string) $value[2], (string) $value[3]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or InoIngresosSea object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	 * @return     InoIngresosSea Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
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
		if ($row[$startcol + 0] === null && $row[$startcol + 1] === null && $row[$startcol + 2] === null && $row[$startcol + 3] === null) {
			return null;
		}
		return serialize(array((string) $row[$startcol + 0], (string) $row[$startcol + 1], (string) $row[$startcol + 2], (string) $row[$startcol + 3]));
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
		$cls = InoIngresosSeaPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = InoIngresosSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = InoIngresosSeaPeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				InoIngresosSeaPeer::addInstanceToPool($obj, $key);
			} // if key exists
		}
		$stmt->closeCursor();
		return $results;
	}

	/**
	 * Returns the number of rows matching criteria, joining the related InoMaestraSea table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinInoMaestraSea(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(InoIngresosSeaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoIngresosSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoIngresosSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(InoIngresosSeaPeer::CA_REFERENCIA,), array(InoMaestraSeaPeer::CA_REFERENCIA,), $join_behavior);

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
	 * Returns the number of rows matching criteria, joining the related Cliente table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinCliente(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(InoIngresosSeaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoIngresosSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoIngresosSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(InoIngresosSeaPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);

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
	 * Selects a collection of InoIngresosSea objects pre-filled with their InoMaestraSea objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of InoIngresosSea objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinInoMaestraSea(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoIngresosSeaPeer::addSelectColumns($c);
		$startcol = (InoIngresosSeaPeer::NUM_COLUMNS - InoIngresosSeaPeer::NUM_LAZY_LOAD_COLUMNS);
		InoMaestraSeaPeer::addSelectColumns($c);

		$c->addJoin(array(InoIngresosSeaPeer::CA_REFERENCIA,), array(InoMaestraSeaPeer::CA_REFERENCIA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoIngresosSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoIngresosSeaPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = InoIngresosSeaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoIngresosSeaPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = InoMaestraSeaPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = InoMaestraSeaPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = InoMaestraSeaPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					InoMaestraSeaPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (InoIngresosSea) to $obj2 (InoMaestraSea)
				$obj2->addInoIngresosSea($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of InoIngresosSea objects pre-filled with their Cliente objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of InoIngresosSea objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinCliente(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoIngresosSeaPeer::addSelectColumns($c);
		$startcol = (InoIngresosSeaPeer::NUM_COLUMNS - InoIngresosSeaPeer::NUM_LAZY_LOAD_COLUMNS);
		ClientePeer::addSelectColumns($c);

		$c->addJoin(array(InoIngresosSeaPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoIngresosSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoIngresosSeaPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = InoIngresosSeaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoIngresosSeaPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = ClientePeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = ClientePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = ClientePeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					ClientePeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (InoIngresosSea) to $obj2 (Cliente)
				$obj2->addInoIngresosSea($obj1);

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
		$criteria->setPrimaryTableName(InoIngresosSeaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoIngresosSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoIngresosSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(InoIngresosSeaPeer::CA_REFERENCIA,), array(InoMaestraSeaPeer::CA_REFERENCIA,), $join_behavior);
		$criteria->addJoin(array(InoIngresosSeaPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);
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
	 * Selects a collection of InoIngresosSea objects pre-filled with all related objects.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of InoIngresosSea objects.
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

		InoIngresosSeaPeer::addSelectColumns($c);
		$startcol2 = (InoIngresosSeaPeer::NUM_COLUMNS - InoIngresosSeaPeer::NUM_LAZY_LOAD_COLUMNS);

		InoMaestraSeaPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (InoMaestraSeaPeer::NUM_COLUMNS - InoMaestraSeaPeer::NUM_LAZY_LOAD_COLUMNS);

		ClientePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (ClientePeer::NUM_COLUMNS - ClientePeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(InoIngresosSeaPeer::CA_REFERENCIA,), array(InoMaestraSeaPeer::CA_REFERENCIA,), $join_behavior);
		$c->addJoin(array(InoIngresosSeaPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoIngresosSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoIngresosSeaPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = InoIngresosSeaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoIngresosSeaPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

			// Add objects for joined InoMaestraSea rows

			$key2 = InoMaestraSeaPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = InoMaestraSeaPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = InoMaestraSeaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					InoMaestraSeaPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 loaded

				// Add the $obj1 (InoIngresosSea) to the collection in $obj2 (InoMaestraSea)
				$obj2->addInoIngresosSea($obj1);
			} // if joined row not null

			// Add objects for joined Cliente rows

			$key3 = ClientePeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = ClientePeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = ClientePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					ClientePeer::addInstanceToPool($obj3, $key3);
				} // if obj3 loaded

				// Add the $obj1 (InoIngresosSea) to the collection in $obj3 (Cliente)
				$obj3->addInoIngresosSea($obj1);
			} // if joined row not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related InoMaestraSea table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptInoMaestraSea(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoIngresosSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoIngresosSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(InoIngresosSeaPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);
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
	 * Returns the number of rows matching criteria, joining the related Cliente table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptCliente(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoIngresosSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoIngresosSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(InoIngresosSeaPeer::CA_REFERENCIA,), array(InoMaestraSeaPeer::CA_REFERENCIA,), $join_behavior);
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
	 * Selects a collection of InoIngresosSea objects pre-filled with all related objects except InoMaestraSea.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of InoIngresosSea objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptInoMaestraSea(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoIngresosSeaPeer::addSelectColumns($c);
		$startcol2 = (InoIngresosSeaPeer::NUM_COLUMNS - InoIngresosSeaPeer::NUM_LAZY_LOAD_COLUMNS);

		ClientePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ClientePeer::NUM_COLUMNS - ClientePeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(InoIngresosSeaPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoIngresosSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoIngresosSeaPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = InoIngresosSeaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoIngresosSeaPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined Cliente rows

				$key2 = ClientePeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = ClientePeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = ClientePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					ClientePeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (InoIngresosSea) to the collection in $obj2 (Cliente)
				$obj2->addInoIngresosSea($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of InoIngresosSea objects pre-filled with all related objects except Cliente.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of InoIngresosSea objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptCliente(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoIngresosSeaPeer::addSelectColumns($c);
		$startcol2 = (InoIngresosSeaPeer::NUM_COLUMNS - InoIngresosSeaPeer::NUM_LAZY_LOAD_COLUMNS);

		InoMaestraSeaPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (InoMaestraSeaPeer::NUM_COLUMNS - InoMaestraSeaPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(InoIngresosSeaPeer::CA_REFERENCIA,), array(InoMaestraSeaPeer::CA_REFERENCIA,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoIngresosSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoIngresosSeaPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = InoIngresosSeaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoIngresosSeaPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined InoMaestraSea rows

				$key2 = InoMaestraSeaPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = InoMaestraSeaPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = InoMaestraSeaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					InoMaestraSeaPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (InoIngresosSea) to the collection in $obj2 (InoMaestraSea)
				$obj2->addInoIngresosSea($obj1);

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
		return InoIngresosSeaPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a InoIngresosSea or Criteria object.
	 *
	 * @param      mixed $values Criteria or InoIngresosSea object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(InoIngresosSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from InoIngresosSea object
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
	 * Method perform an UPDATE on the database, given a InoIngresosSea or Criteria object.
	 *
	 * @param      mixed $values Criteria or InoIngresosSea object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(InoIngresosSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(InoIngresosSeaPeer::CA_REFERENCIA);
			$selectCriteria->add(InoIngresosSeaPeer::CA_REFERENCIA, $criteria->remove(InoIngresosSeaPeer::CA_REFERENCIA), $comparison);

			$comparison = $criteria->getComparison(InoIngresosSeaPeer::CA_IDCLIENTE);
			$selectCriteria->add(InoIngresosSeaPeer::CA_IDCLIENTE, $criteria->remove(InoIngresosSeaPeer::CA_IDCLIENTE), $comparison);

			$comparison = $criteria->getComparison(InoIngresosSeaPeer::CA_HBLS);
			$selectCriteria->add(InoIngresosSeaPeer::CA_HBLS, $criteria->remove(InoIngresosSeaPeer::CA_HBLS), $comparison);

			$comparison = $criteria->getComparison(InoIngresosSeaPeer::CA_FACTURA);
			$selectCriteria->add(InoIngresosSeaPeer::CA_FACTURA, $criteria->remove(InoIngresosSeaPeer::CA_FACTURA), $comparison);

		} else { // $values is InoIngresosSea object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the tb_inoingresos_sea table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(InoIngresosSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(InoIngresosSeaPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a InoIngresosSea or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or InoIngresosSea object or primary key or array of primary keys
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
			$con = Propel::getConnection(InoIngresosSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			InoIngresosSeaPeer::clearInstancePool();

			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof InoIngresosSea) {
			// invalidate the cache for this single object
			InoIngresosSeaPeer::removeInstanceFromPool($values);
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

				$criterion = $criteria->getNewCriterion(InoIngresosSeaPeer::CA_REFERENCIA, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(InoIngresosSeaPeer::CA_IDCLIENTE, $value[1]));
				$criterion->addAnd($criteria->getNewCriterion(InoIngresosSeaPeer::CA_HBLS, $value[2]));
				$criterion->addAnd($criteria->getNewCriterion(InoIngresosSeaPeer::CA_FACTURA, $value[3]));
				$criteria->addOr($criterion);

				// we can invalidate the cache for this single PK
				InoIngresosSeaPeer::removeInstanceFromPool($value);
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
	 * Validates all modified columns of given InoIngresosSea object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      InoIngresosSea $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(InoIngresosSea $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(InoIngresosSeaPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(InoIngresosSeaPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(InoIngresosSeaPeer::DATABASE_NAME, InoIngresosSeaPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = InoIngresosSeaPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	/**
	 * Retrieve object using using composite pkey values.
	 * @param      string $ca_referencia
	   @param      int $ca_idcliente
	   @param      string $ca_hbls
	   @param      string $ca_factura
	   
	 * @param      PropelPDO $con
	 * @return     InoIngresosSea
	 */
	public static function retrieveByPK($ca_referencia, $ca_idcliente, $ca_hbls, $ca_factura, PropelPDO $con = null) {
		$key = serialize(array((string) $ca_referencia, (string) $ca_idcliente, (string) $ca_hbls, (string) $ca_factura));
 		if (null !== ($obj = InoIngresosSeaPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(InoIngresosSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(InoIngresosSeaPeer::DATABASE_NAME);
		$criteria->add(InoIngresosSeaPeer::CA_REFERENCIA, $ca_referencia);
		$criteria->add(InoIngresosSeaPeer::CA_IDCLIENTE, $ca_idcliente);
		$criteria->add(InoIngresosSeaPeer::CA_HBLS, $ca_hbls);
		$criteria->add(InoIngresosSeaPeer::CA_FACTURA, $ca_factura);
		$v = InoIngresosSeaPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} // BaseInoIngresosSeaPeer

// This is the static code needed to register the MapBuilder for this table with the main Propel class.
//
// NOTE: This static code cannot call methods on the InoIngresosSeaPeer class, because it is not defined yet.
// If you need to use overridden methods, you can add this code to the bottom of the InoIngresosSeaPeer class:
//
// Propel::getDatabaseMap(InoIngresosSeaPeer::DATABASE_NAME)->addTableBuilder(InoIngresosSeaPeer::TABLE_NAME, InoIngresosSeaPeer::getMapBuilder());
//
// Doing so will effectively overwrite the registration below.

Propel::getDatabaseMap(BaseInoIngresosSeaPeer::DATABASE_NAME)->addTableBuilder(BaseInoIngresosSeaPeer::TABLE_NAME, BaseInoIngresosSeaPeer::getMapBuilder());

