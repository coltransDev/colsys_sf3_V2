<?php

/**
 * Base static class for performing query and update operations on the 'tb_cotopciones' table.
 *
 * 
 *
 * @package    lib.model.cotizaciones.om
 */
abstract class BaseCotOpcionPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'tb_cotopciones';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.cotizaciones.CotOpcion';

	/** The total number of columns. */
	const NUM_COLUMNS = 15;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** the column name for the CA_IDOPCION field */
	const CA_IDOPCION = 'tb_cotopciones.CA_IDOPCION';

	/** the column name for the CA_IDCOTIZACION field */
	const CA_IDCOTIZACION = 'tb_cotopciones.CA_IDCOTIZACION';

	/** the column name for the CA_IDPRODUCTO field */
	const CA_IDPRODUCTO = 'tb_cotopciones.CA_IDPRODUCTO';

	/** the column name for the CA_IDCONCEPTO field */
	const CA_IDCONCEPTO = 'tb_cotopciones.CA_IDCONCEPTO';

	/** the column name for the CA_VALOR_TAR field */
	const CA_VALOR_TAR = 'tb_cotopciones.CA_VALOR_TAR';

	/** the column name for the CA_APLICA_TAR field */
	const CA_APLICA_TAR = 'tb_cotopciones.CA_APLICA_TAR';

	/** the column name for the CA_VALOR_MIN field */
	const CA_VALOR_MIN = 'tb_cotopciones.CA_VALOR_MIN';

	/** the column name for the CA_APLICA_MIN field */
	const CA_APLICA_MIN = 'tb_cotopciones.CA_APLICA_MIN';

	/** the column name for the CA_IDMONEDA field */
	const CA_IDMONEDA = 'tb_cotopciones.CA_IDMONEDA';

	/** the column name for the CA_RECARGOS field */
	const CA_RECARGOS = 'tb_cotopciones.CA_RECARGOS';

	/** the column name for the CA_OBSERVACIONES field */
	const CA_OBSERVACIONES = 'tb_cotopciones.CA_OBSERVACIONES';

	/** the column name for the CA_FCHCREADO field */
	const CA_FCHCREADO = 'tb_cotopciones.CA_FCHCREADO';

	/** the column name for the CA_USUCREADO field */
	const CA_USUCREADO = 'tb_cotopciones.CA_USUCREADO';

	/** the column name for the CA_FCHACTUALIZADO field */
	const CA_FCHACTUALIZADO = 'tb_cotopciones.CA_FCHACTUALIZADO';

	/** the column name for the CA_USUACTUALIZADO field */
	const CA_USUACTUALIZADO = 'tb_cotopciones.CA_USUACTUALIZADO';

	/**
	 * An identiy map to hold any loaded instances of CotOpcion objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array CotOpcion[]
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
		BasePeer::TYPE_PHPNAME => array ('CaIdopcion', 'CaIdcotizacion', 'CaIdproducto', 'CaIdconcepto', 'CaValorTar', 'CaAplicaTar', 'CaValorMin', 'CaAplicaMin', 'CaIdmoneda', 'CaRecargos', 'CaObservaciones', 'CaFchcreado', 'CaUsucreado', 'CaFchactualizado', 'CaUsuactualizado', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdopcion', 'caIdcotizacion', 'caIdproducto', 'caIdconcepto', 'caValorTar', 'caAplicaTar', 'caValorMin', 'caAplicaMin', 'caIdmoneda', 'caRecargos', 'caObservaciones', 'caFchcreado', 'caUsucreado', 'caFchactualizado', 'caUsuactualizado', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDOPCION, self::CA_IDCOTIZACION, self::CA_IDPRODUCTO, self::CA_IDCONCEPTO, self::CA_VALOR_TAR, self::CA_APLICA_TAR, self::CA_VALOR_MIN, self::CA_APLICA_MIN, self::CA_IDMONEDA, self::CA_RECARGOS, self::CA_OBSERVACIONES, self::CA_FCHCREADO, self::CA_USUCREADO, self::CA_FCHACTUALIZADO, self::CA_USUACTUALIZADO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idopcion', 'ca_idcotizacion', 'ca_idproducto', 'ca_idconcepto', 'ca_valor_tar', 'ca_aplica_tar', 'ca_valor_min', 'ca_aplica_min', 'ca_idmoneda', 'ca_recargos', 'ca_observaciones', 'ca_fchcreado', 'ca_usucreado', 'ca_fchactualizado', 'ca_usuactualizado', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdopcion' => 0, 'CaIdcotizacion' => 1, 'CaIdproducto' => 2, 'CaIdconcepto' => 3, 'CaValorTar' => 4, 'CaAplicaTar' => 5, 'CaValorMin' => 6, 'CaAplicaMin' => 7, 'CaIdmoneda' => 8, 'CaRecargos' => 9, 'CaObservaciones' => 10, 'CaFchcreado' => 11, 'CaUsucreado' => 12, 'CaFchactualizado' => 13, 'CaUsuactualizado' => 14, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdopcion' => 0, 'caIdcotizacion' => 1, 'caIdproducto' => 2, 'caIdconcepto' => 3, 'caValorTar' => 4, 'caAplicaTar' => 5, 'caValorMin' => 6, 'caAplicaMin' => 7, 'caIdmoneda' => 8, 'caRecargos' => 9, 'caObservaciones' => 10, 'caFchcreado' => 11, 'caUsucreado' => 12, 'caFchactualizado' => 13, 'caUsuactualizado' => 14, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDOPCION => 0, self::CA_IDCOTIZACION => 1, self::CA_IDPRODUCTO => 2, self::CA_IDCONCEPTO => 3, self::CA_VALOR_TAR => 4, self::CA_APLICA_TAR => 5, self::CA_VALOR_MIN => 6, self::CA_APLICA_MIN => 7, self::CA_IDMONEDA => 8, self::CA_RECARGOS => 9, self::CA_OBSERVACIONES => 10, self::CA_FCHCREADO => 11, self::CA_USUCREADO => 12, self::CA_FCHACTUALIZADO => 13, self::CA_USUACTUALIZADO => 14, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idopcion' => 0, 'ca_idcotizacion' => 1, 'ca_idproducto' => 2, 'ca_idconcepto' => 3, 'ca_valor_tar' => 4, 'ca_aplica_tar' => 5, 'ca_valor_min' => 6, 'ca_aplica_min' => 7, 'ca_idmoneda' => 8, 'ca_recargos' => 9, 'ca_observaciones' => 10, 'ca_fchcreado' => 11, 'ca_usucreado' => 12, 'ca_fchactualizado' => 13, 'ca_usuactualizado' => 14, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
	);

	/**
	 * Get a (singleton) instance of the MapBuilder for this peer class.
	 * @return     MapBuilder The map builder for this peer
	 */
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new CotOpcionMapBuilder();
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
	 * @param      string $column The column name for current table. (i.e. CotOpcionPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(CotOpcionPeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(CotOpcionPeer::CA_IDOPCION);

		$criteria->addSelectColumn(CotOpcionPeer::CA_IDCOTIZACION);

		$criteria->addSelectColumn(CotOpcionPeer::CA_IDPRODUCTO);

		$criteria->addSelectColumn(CotOpcionPeer::CA_IDCONCEPTO);

		$criteria->addSelectColumn(CotOpcionPeer::CA_VALOR_TAR);

		$criteria->addSelectColumn(CotOpcionPeer::CA_APLICA_TAR);

		$criteria->addSelectColumn(CotOpcionPeer::CA_VALOR_MIN);

		$criteria->addSelectColumn(CotOpcionPeer::CA_APLICA_MIN);

		$criteria->addSelectColumn(CotOpcionPeer::CA_IDMONEDA);

		$criteria->addSelectColumn(CotOpcionPeer::CA_RECARGOS);

		$criteria->addSelectColumn(CotOpcionPeer::CA_OBSERVACIONES);

		$criteria->addSelectColumn(CotOpcionPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(CotOpcionPeer::CA_USUCREADO);

		$criteria->addSelectColumn(CotOpcionPeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(CotOpcionPeer::CA_USUACTUALIZADO);

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
		$criteria->setPrimaryTableName(CotOpcionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotOpcionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(CotOpcionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return     CotOpcion
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = CotOpcionPeer::doSelect($critcopy, $con);
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
		return CotOpcionPeer::populateObjects(CotOpcionPeer::doSelectStmt($criteria, $con));
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
			$con = Propel::getConnection(CotOpcionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			CotOpcionPeer::addSelectColumns($criteria);
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
	 * @param      CotOpcion $value A CotOpcion object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool(CotOpcion $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getCaIdopcion(), (string) $obj->getCaIdcotizacion(), (string) $obj->getCaIdproducto()));
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
	 * @param      mixed $value A CotOpcion object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof CotOpcion) {
				$key = serialize(array((string) $value->getCaIdopcion(), (string) $value->getCaIdcotizacion(), (string) $value->getCaIdproducto()));
			} elseif (is_array($value) && count($value) === 3) {
				// assume we've been passed a primary key
				$key = serialize(array((string) $value[0], (string) $value[1], (string) $value[2]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or CotOpcion object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	 * @return     CotOpcion Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
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
		if ($row[$startcol + 0] === null && $row[$startcol + 1] === null && $row[$startcol + 2] === null) {
			return null;
		}
		return serialize(array((string) $row[$startcol + 0], (string) $row[$startcol + 1], (string) $row[$startcol + 2]));
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
		$cls = CotOpcionPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = CotOpcionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = CotOpcionPeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				CotOpcionPeer::addInstanceToPool($obj, $key);
			} // if key exists
		}
		$stmt->closeCursor();
		return $results;
	}

	/**
	 * Returns the number of rows matching criteria, joining the related CotProducto table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinCotProducto(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(CotOpcionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotOpcionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotOpcionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(CotOpcionPeer::CA_IDPRODUCTO,CotOpcionPeer::CA_IDCOTIZACION,), array(CotProductoPeer::CA_IDPRODUCTO,CotProductoPeer::CA_IDCOTIZACION,), $join_behavior);

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
		$criteria->setPrimaryTableName(CotOpcionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotOpcionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotOpcionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(CotOpcionPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);

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
	 * Selects a collection of CotOpcion objects pre-filled with their CotProducto objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of CotOpcion objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinCotProducto(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotOpcionPeer::addSelectColumns($c);
		$startcol = (CotOpcionPeer::NUM_COLUMNS - CotOpcionPeer::NUM_LAZY_LOAD_COLUMNS);
		CotProductoPeer::addSelectColumns($c);

		$c->addJoin(array(CotOpcionPeer::CA_IDPRODUCTO,CotOpcionPeer::CA_IDCOTIZACION,), array(CotProductoPeer::CA_IDPRODUCTO,CotProductoPeer::CA_IDCOTIZACION,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotOpcionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotOpcionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = CotOpcionPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotOpcionPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = CotProductoPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = CotProductoPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = CotProductoPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					CotProductoPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (CotOpcion) to $obj2 (CotProducto)
				$obj2->addCotOpcion($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of CotOpcion objects pre-filled with their Concepto objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of CotOpcion objects.
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

		CotOpcionPeer::addSelectColumns($c);
		$startcol = (CotOpcionPeer::NUM_COLUMNS - CotOpcionPeer::NUM_LAZY_LOAD_COLUMNS);
		ConceptoPeer::addSelectColumns($c);

		$c->addJoin(array(CotOpcionPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotOpcionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotOpcionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = CotOpcionPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotOpcionPeer::addInstanceToPool($obj1, $key1);
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

				// Add the $obj1 (CotOpcion) to $obj2 (Concepto)
				$obj2->addCotOpcion($obj1);

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
		$criteria->setPrimaryTableName(CotOpcionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotOpcionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotOpcionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(CotOpcionPeer::CA_IDPRODUCTO,CotOpcionPeer::CA_IDCOTIZACION,), array(CotProductoPeer::CA_IDPRODUCTO,CotProductoPeer::CA_IDCOTIZACION,), $join_behavior);
		$criteria->addJoin(array(CotOpcionPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);
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
	 * Selects a collection of CotOpcion objects pre-filled with all related objects.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of CotOpcion objects.
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

		CotOpcionPeer::addSelectColumns($c);
		$startcol2 = (CotOpcionPeer::NUM_COLUMNS - CotOpcionPeer::NUM_LAZY_LOAD_COLUMNS);

		CotProductoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (CotProductoPeer::NUM_COLUMNS - CotProductoPeer::NUM_LAZY_LOAD_COLUMNS);

		ConceptoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (ConceptoPeer::NUM_COLUMNS - ConceptoPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(CotOpcionPeer::CA_IDPRODUCTO,CotOpcionPeer::CA_IDCOTIZACION,), array(CotProductoPeer::CA_IDPRODUCTO,CotProductoPeer::CA_IDCOTIZACION,), $join_behavior);
		$c->addJoin(array(CotOpcionPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotOpcionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotOpcionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = CotOpcionPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotOpcionPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

			// Add objects for joined CotProducto rows

			$key2 = CotProductoPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = CotProductoPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = CotProductoPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					CotProductoPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 loaded

				// Add the $obj1 (CotOpcion) to the collection in $obj2 (CotProducto)
				$obj2->addCotOpcion($obj1);
			} // if joined row not null

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
				} // if obj3 loaded

				// Add the $obj1 (CotOpcion) to the collection in $obj3 (Concepto)
				$obj3->addCotOpcion($obj1);
			} // if joined row not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related CotProducto table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptCotProducto(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotOpcionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotOpcionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(CotOpcionPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);
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
			CotOpcionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotOpcionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(CotOpcionPeer::CA_IDPRODUCTO,CotOpcionPeer::CA_IDCOTIZACION,), array(CotProductoPeer::CA_IDPRODUCTO,CotProductoPeer::CA_IDCOTIZACION,), $join_behavior);
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
	 * Selects a collection of CotOpcion objects pre-filled with all related objects except CotProducto.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of CotOpcion objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptCotProducto(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotOpcionPeer::addSelectColumns($c);
		$startcol2 = (CotOpcionPeer::NUM_COLUMNS - CotOpcionPeer::NUM_LAZY_LOAD_COLUMNS);

		ConceptoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ConceptoPeer::NUM_COLUMNS - ConceptoPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(CotOpcionPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotOpcionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotOpcionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = CotOpcionPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotOpcionPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined Concepto rows

				$key2 = ConceptoPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = ConceptoPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = ConceptoPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					ConceptoPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (CotOpcion) to the collection in $obj2 (Concepto)
				$obj2->addCotOpcion($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of CotOpcion objects pre-filled with all related objects except Concepto.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of CotOpcion objects.
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

		CotOpcionPeer::addSelectColumns($c);
		$startcol2 = (CotOpcionPeer::NUM_COLUMNS - CotOpcionPeer::NUM_LAZY_LOAD_COLUMNS);

		CotProductoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (CotProductoPeer::NUM_COLUMNS - CotProductoPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(CotOpcionPeer::CA_IDPRODUCTO,CotOpcionPeer::CA_IDCOTIZACION,), array(CotProductoPeer::CA_IDPRODUCTO,CotProductoPeer::CA_IDCOTIZACION,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotOpcionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotOpcionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = CotOpcionPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotOpcionPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined CotProducto rows

				$key2 = CotProductoPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = CotProductoPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = CotProductoPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					CotProductoPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (CotOpcion) to the collection in $obj2 (CotProducto)
				$obj2->addCotOpcion($obj1);

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
		return CotOpcionPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a CotOpcion or Criteria object.
	 *
	 * @param      mixed $values Criteria or CotOpcion object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(CotOpcionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from CotOpcion object
		}

		if ($criteria->containsKey(CotOpcionPeer::CA_IDOPCION) && $criteria->keyContainsValue(CotOpcionPeer::CA_IDOPCION) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.CotOpcionPeer::CA_IDOPCION.')');
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
	 * Method perform an UPDATE on the database, given a CotOpcion or Criteria object.
	 *
	 * @param      mixed $values Criteria or CotOpcion object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(CotOpcionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(CotOpcionPeer::CA_IDOPCION);
			$selectCriteria->add(CotOpcionPeer::CA_IDOPCION, $criteria->remove(CotOpcionPeer::CA_IDOPCION), $comparison);

			$comparison = $criteria->getComparison(CotOpcionPeer::CA_IDCOTIZACION);
			$selectCriteria->add(CotOpcionPeer::CA_IDCOTIZACION, $criteria->remove(CotOpcionPeer::CA_IDCOTIZACION), $comparison);

			$comparison = $criteria->getComparison(CotOpcionPeer::CA_IDPRODUCTO);
			$selectCriteria->add(CotOpcionPeer::CA_IDPRODUCTO, $criteria->remove(CotOpcionPeer::CA_IDPRODUCTO), $comparison);

		} else { // $values is CotOpcion object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the tb_cotopciones table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(CotOpcionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(CotOpcionPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a CotOpcion or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or CotOpcion object or primary key or array of primary keys
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
			$con = Propel::getConnection(CotOpcionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			CotOpcionPeer::clearInstancePool();

			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof CotOpcion) {
			// invalidate the cache for this single object
			CotOpcionPeer::removeInstanceFromPool($values);
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

				$criterion = $criteria->getNewCriterion(CotOpcionPeer::CA_IDOPCION, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(CotOpcionPeer::CA_IDCOTIZACION, $value[1]));
				$criterion->addAnd($criteria->getNewCriterion(CotOpcionPeer::CA_IDPRODUCTO, $value[2]));
				$criteria->addOr($criterion);

				// we can invalidate the cache for this single PK
				CotOpcionPeer::removeInstanceFromPool($value);
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
	 * Validates all modified columns of given CotOpcion object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      CotOpcion $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(CotOpcion $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(CotOpcionPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(CotOpcionPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(CotOpcionPeer::DATABASE_NAME, CotOpcionPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = CotOpcionPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	/**
	 * Retrieve object using using composite pkey values.
	 * @param      string $ca_idopcion
	   @param      int $ca_idcotizacion
	   @param      int $ca_idproducto
	   
	 * @param      PropelPDO $con
	 * @return     CotOpcion
	 */
	public static function retrieveByPK($ca_idopcion, $ca_idcotizacion, $ca_idproducto, PropelPDO $con = null) {
		$key = serialize(array((string) $ca_idopcion, (string) $ca_idcotizacion, (string) $ca_idproducto));
 		if (null !== ($obj = CotOpcionPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(CotOpcionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(CotOpcionPeer::DATABASE_NAME);
		$criteria->add(CotOpcionPeer::CA_IDOPCION, $ca_idopcion);
		$criteria->add(CotOpcionPeer::CA_IDCOTIZACION, $ca_idcotizacion);
		$criteria->add(CotOpcionPeer::CA_IDPRODUCTO, $ca_idproducto);
		$v = CotOpcionPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} // BaseCotOpcionPeer

// This is the static code needed to register the MapBuilder for this table with the main Propel class.
//
// NOTE: This static code cannot call methods on the CotOpcionPeer class, because it is not defined yet.
// If you need to use overridden methods, you can add this code to the bottom of the CotOpcionPeer class:
//
// Propel::getDatabaseMap(CotOpcionPeer::DATABASE_NAME)->addTableBuilder(CotOpcionPeer::TABLE_NAME, CotOpcionPeer::getMapBuilder());
//
// Doing so will effectively overwrite the registration below.

Propel::getDatabaseMap(BaseCotOpcionPeer::DATABASE_NAME)->addTableBuilder(BaseCotOpcionPeer::TABLE_NAME, BaseCotOpcionPeer::getMapBuilder());

