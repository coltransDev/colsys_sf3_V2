<?php

/**
 * Base static class for performing query and update operations on the 'tb_inomaestra_air' table.
 *
 * 
 *
 * @package    lib.model.air.om
 */
abstract class BaseInoMaestraAirPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'tb_inomaestra_air';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.air.InoMaestraAir';

	/** The total number of columns. */
	const NUM_COLUMNS = 22;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** the column name for the CA_FCHREFERENCIA field */
	const CA_FCHREFERENCIA = 'tb_inomaestra_air.CA_FCHREFERENCIA';

	/** the column name for the CA_REFERENCIA field */
	const CA_REFERENCIA = 'tb_inomaestra_air.CA_REFERENCIA';

	/** the column name for the CA_IMPOEXPO field */
	const CA_IMPOEXPO = 'tb_inomaestra_air.CA_IMPOEXPO';

	/** the column name for the CA_ORIGEN field */
	const CA_ORIGEN = 'tb_inomaestra_air.CA_ORIGEN';

	/** the column name for the CA_DESTINO field */
	const CA_DESTINO = 'tb_inomaestra_air.CA_DESTINO';

	/** the column name for the CA_MODALIDAD field */
	const CA_MODALIDAD = 'tb_inomaestra_air.CA_MODALIDAD';

	/** the column name for the CA_IDLINEA field */
	const CA_IDLINEA = 'tb_inomaestra_air.CA_IDLINEA';

	/** the column name for the CA_MAWB field */
	const CA_MAWB = 'tb_inomaestra_air.CA_MAWB';

	/** the column name for the CA_PIEZAS field */
	const CA_PIEZAS = 'tb_inomaestra_air.CA_PIEZAS';

	/** the column name for the CA_PESO field */
	const CA_PESO = 'tb_inomaestra_air.CA_PESO';

	/** the column name for the CA_PESOVOLUMEN field */
	const CA_PESOVOLUMEN = 'tb_inomaestra_air.CA_PESOVOLUMEN';

	/** the column name for the CA_OBSERVACIONES field */
	const CA_OBSERVACIONES = 'tb_inomaestra_air.CA_OBSERVACIONES';

	/** the column name for the CA_FCHCREADO field */
	const CA_FCHCREADO = 'tb_inomaestra_air.CA_FCHCREADO';

	/** the column name for the CA_USUCREADO field */
	const CA_USUCREADO = 'tb_inomaestra_air.CA_USUCREADO';

	/** the column name for the CA_FCHPREAVISO field */
	const CA_FCHPREAVISO = 'tb_inomaestra_air.CA_FCHPREAVISO';

	/** the column name for the CA_FCHLLEGADA field */
	const CA_FCHLLEGADA = 'tb_inomaestra_air.CA_FCHLLEGADA';

	/** the column name for the CA_FCHACTUALIZADO field */
	const CA_FCHACTUALIZADO = 'tb_inomaestra_air.CA_FCHACTUALIZADO';

	/** the column name for the CA_USUACTUALIZADO field */
	const CA_USUACTUALIZADO = 'tb_inomaestra_air.CA_USUACTUALIZADO';

	/** the column name for the CA_FCHLIQUIDADO field */
	const CA_FCHLIQUIDADO = 'tb_inomaestra_air.CA_FCHLIQUIDADO';

	/** the column name for the CA_USULIQUIDADO field */
	const CA_USULIQUIDADO = 'tb_inomaestra_air.CA_USULIQUIDADO';

	/** the column name for the CA_FCHCERRADO field */
	const CA_FCHCERRADO = 'tb_inomaestra_air.CA_FCHCERRADO';

	/** the column name for the CA_USUCERRADO field */
	const CA_USUCERRADO = 'tb_inomaestra_air.CA_USUCERRADO';

	/**
	 * An identiy map to hold any loaded instances of InoMaestraAir objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array InoMaestraAir[]
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
		BasePeer::TYPE_PHPNAME => array ('CaFchreferencia', 'CaReferencia', 'CaImpoexpo', 'CaOrigen', 'CaDestino', 'CaModalidad', 'CaIdlinea', 'CaMawb', 'CaPiezas', 'CaPeso', 'CaPesovolumen', 'CaObservaciones', 'CaFchcreado', 'CaUsucreado', 'CaFchpreaviso', 'CaFchllegada', 'CaFchactualizado', 'CaUsuactualizado', 'CaFchliquidado', 'CaUsuliquidado', 'CaFchcerrado', 'CaUsucerrado', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caFchreferencia', 'caReferencia', 'caImpoexpo', 'caOrigen', 'caDestino', 'caModalidad', 'caIdlinea', 'caMawb', 'caPiezas', 'caPeso', 'caPesovolumen', 'caObservaciones', 'caFchcreado', 'caUsucreado', 'caFchpreaviso', 'caFchllegada', 'caFchactualizado', 'caUsuactualizado', 'caFchliquidado', 'caUsuliquidado', 'caFchcerrado', 'caUsucerrado', ),
		BasePeer::TYPE_COLNAME => array (self::CA_FCHREFERENCIA, self::CA_REFERENCIA, self::CA_IMPOEXPO, self::CA_ORIGEN, self::CA_DESTINO, self::CA_MODALIDAD, self::CA_IDLINEA, self::CA_MAWB, self::CA_PIEZAS, self::CA_PESO, self::CA_PESOVOLUMEN, self::CA_OBSERVACIONES, self::CA_FCHCREADO, self::CA_USUCREADO, self::CA_FCHPREAVISO, self::CA_FCHLLEGADA, self::CA_FCHACTUALIZADO, self::CA_USUACTUALIZADO, self::CA_FCHLIQUIDADO, self::CA_USULIQUIDADO, self::CA_FCHCERRADO, self::CA_USUCERRADO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_fchreferencia', 'ca_referencia', 'ca_impoexpo', 'ca_origen', 'ca_destino', 'ca_modalidad', 'ca_idlinea', 'ca_mawb', 'ca_piezas', 'ca_peso', 'ca_pesovolumen', 'ca_observaciones', 'ca_fchcreado', 'ca_usucreado', 'ca_fchpreaviso', 'ca_fchllegada', 'ca_fchactualizado', 'ca_usuactualizado', 'ca_fchliquidado', 'ca_usuliquidado', 'ca_fchcerrado', 'ca_usucerrado', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaFchreferencia' => 0, 'CaReferencia' => 1, 'CaImpoexpo' => 2, 'CaOrigen' => 3, 'CaDestino' => 4, 'CaModalidad' => 5, 'CaIdlinea' => 6, 'CaMawb' => 7, 'CaPiezas' => 8, 'CaPeso' => 9, 'CaPesovolumen' => 10, 'CaObservaciones' => 11, 'CaFchcreado' => 12, 'CaUsucreado' => 13, 'CaFchpreaviso' => 14, 'CaFchllegada' => 15, 'CaFchactualizado' => 16, 'CaUsuactualizado' => 17, 'CaFchliquidado' => 18, 'CaUsuliquidado' => 19, 'CaFchcerrado' => 20, 'CaUsucerrado' => 21, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caFchreferencia' => 0, 'caReferencia' => 1, 'caImpoexpo' => 2, 'caOrigen' => 3, 'caDestino' => 4, 'caModalidad' => 5, 'caIdlinea' => 6, 'caMawb' => 7, 'caPiezas' => 8, 'caPeso' => 9, 'caPesovolumen' => 10, 'caObservaciones' => 11, 'caFchcreado' => 12, 'caUsucreado' => 13, 'caFchpreaviso' => 14, 'caFchllegada' => 15, 'caFchactualizado' => 16, 'caUsuactualizado' => 17, 'caFchliquidado' => 18, 'caUsuliquidado' => 19, 'caFchcerrado' => 20, 'caUsucerrado' => 21, ),
		BasePeer::TYPE_COLNAME => array (self::CA_FCHREFERENCIA => 0, self::CA_REFERENCIA => 1, self::CA_IMPOEXPO => 2, self::CA_ORIGEN => 3, self::CA_DESTINO => 4, self::CA_MODALIDAD => 5, self::CA_IDLINEA => 6, self::CA_MAWB => 7, self::CA_PIEZAS => 8, self::CA_PESO => 9, self::CA_PESOVOLUMEN => 10, self::CA_OBSERVACIONES => 11, self::CA_FCHCREADO => 12, self::CA_USUCREADO => 13, self::CA_FCHPREAVISO => 14, self::CA_FCHLLEGADA => 15, self::CA_FCHACTUALIZADO => 16, self::CA_USUACTUALIZADO => 17, self::CA_FCHLIQUIDADO => 18, self::CA_USULIQUIDADO => 19, self::CA_FCHCERRADO => 20, self::CA_USUCERRADO => 21, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_fchreferencia' => 0, 'ca_referencia' => 1, 'ca_impoexpo' => 2, 'ca_origen' => 3, 'ca_destino' => 4, 'ca_modalidad' => 5, 'ca_idlinea' => 6, 'ca_mawb' => 7, 'ca_piezas' => 8, 'ca_peso' => 9, 'ca_pesovolumen' => 10, 'ca_observaciones' => 11, 'ca_fchcreado' => 12, 'ca_usucreado' => 13, 'ca_fchpreaviso' => 14, 'ca_fchllegada' => 15, 'ca_fchactualizado' => 16, 'ca_usuactualizado' => 17, 'ca_fchliquidado' => 18, 'ca_usuliquidado' => 19, 'ca_fchcerrado' => 20, 'ca_usucerrado' => 21, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, )
	);

	/**
	 * Get a (singleton) instance of the MapBuilder for this peer class.
	 * @return     MapBuilder The map builder for this peer
	 */
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new InoMaestraAirMapBuilder();
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
	 * @param      string $column The column name for current table. (i.e. InoMaestraAirPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(InoMaestraAirPeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_FCHREFERENCIA);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_REFERENCIA);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_IMPOEXPO);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_ORIGEN);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_DESTINO);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_MODALIDAD);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_IDLINEA);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_MAWB);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_PIEZAS);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_PESO);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_PESOVOLUMEN);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_OBSERVACIONES);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_USUCREADO);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_FCHPREAVISO);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_FCHLLEGADA);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_USUACTUALIZADO);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_FCHLIQUIDADO);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_USULIQUIDADO);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_FCHCERRADO);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_USUCERRADO);

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
		$criteria->setPrimaryTableName(InoMaestraAirPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoMaestraAirPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(InoMaestraAirPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return     InoMaestraAir
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = InoMaestraAirPeer::doSelect($critcopy, $con);
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
		return InoMaestraAirPeer::populateObjects(InoMaestraAirPeer::doSelectStmt($criteria, $con));
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
			$con = Propel::getConnection(InoMaestraAirPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			InoMaestraAirPeer::addSelectColumns($criteria);
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
	 * @param      InoMaestraAir $value A InoMaestraAir object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool(InoMaestraAir $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaReferencia();
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
	 * @param      mixed $value A InoMaestraAir object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof InoMaestraAir) {
				$key = (string) $value->getCaReferencia();
			} elseif (is_scalar($value)) {
				// assume we've been passed a primary key
				$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or InoMaestraAir object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	 * @return     InoMaestraAir Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
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
		if ($row[$startcol + 1] === null) {
			return null;
		}
		return (string) $row[$startcol + 1];
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
		$cls = InoMaestraAirPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = InoMaestraAirPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = InoMaestraAirPeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				InoMaestraAirPeer::addInstanceToPool($obj, $key);
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
		$criteria->setPrimaryTableName(InoMaestraAirPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoMaestraAirPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoMaestraAirPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(InoMaestraAirPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);

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
	 * Selects a collection of InoMaestraAir objects pre-filled with their Transportador objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of InoMaestraAir objects.
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

		InoMaestraAirPeer::addSelectColumns($c);
		$startcol = (InoMaestraAirPeer::NUM_COLUMNS - InoMaestraAirPeer::NUM_LAZY_LOAD_COLUMNS);
		TransportadorPeer::addSelectColumns($c);

		$c->addJoin(array(InoMaestraAirPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoMaestraAirPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoMaestraAirPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = InoMaestraAirPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoMaestraAirPeer::addInstanceToPool($obj1, $key1);
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

				// Add the $obj1 (InoMaestraAir) to $obj2 (Transportador)
				$obj2->addInoMaestraAir($obj1);

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
		$criteria->setPrimaryTableName(InoMaestraAirPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoMaestraAirPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoMaestraAirPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(InoMaestraAirPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
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
	 * Selects a collection of InoMaestraAir objects pre-filled with all related objects.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of InoMaestraAir objects.
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

		InoMaestraAirPeer::addSelectColumns($c);
		$startcol2 = (InoMaestraAirPeer::NUM_COLUMNS - InoMaestraAirPeer::NUM_LAZY_LOAD_COLUMNS);

		TransportadorPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (TransportadorPeer::NUM_COLUMNS - TransportadorPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(InoMaestraAirPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoMaestraAirPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoMaestraAirPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = InoMaestraAirPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoMaestraAirPeer::addInstanceToPool($obj1, $key1);
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

				// Add the $obj1 (InoMaestraAir) to the collection in $obj2 (Transportador)
				$obj2->addInoMaestraAir($obj1);
			} // if joined row not null

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
		return InoMaestraAirPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a InoMaestraAir or Criteria object.
	 *
	 * @param      mixed $values Criteria or InoMaestraAir object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(InoMaestraAirPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from InoMaestraAir object
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
	 * Method perform an UPDATE on the database, given a InoMaestraAir or Criteria object.
	 *
	 * @param      mixed $values Criteria or InoMaestraAir object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(InoMaestraAirPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(InoMaestraAirPeer::CA_REFERENCIA);
			$selectCriteria->add(InoMaestraAirPeer::CA_REFERENCIA, $criteria->remove(InoMaestraAirPeer::CA_REFERENCIA), $comparison);

		} else { // $values is InoMaestraAir object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the tb_inomaestra_air table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(InoMaestraAirPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(InoMaestraAirPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a InoMaestraAir or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or InoMaestraAir object or primary key or array of primary keys
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
			$con = Propel::getConnection(InoMaestraAirPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			InoMaestraAirPeer::clearInstancePool();

			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof InoMaestraAir) {
			// invalidate the cache for this single object
			InoMaestraAirPeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key



			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(InoMaestraAirPeer::CA_REFERENCIA, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
				// we can invalidate the cache for this single object
				InoMaestraAirPeer::removeInstanceFromPool($singleval);
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
	 * Validates all modified columns of given InoMaestraAir object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      InoMaestraAir $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(InoMaestraAir $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(InoMaestraAirPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(InoMaestraAirPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(InoMaestraAirPeer::DATABASE_NAME, InoMaestraAirPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = InoMaestraAirPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      string $pk the primary key.
	 * @param      PropelPDO $con the connection to use
	 * @return     InoMaestraAir
	 */
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = InoMaestraAirPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(InoMaestraAirPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(InoMaestraAirPeer::DATABASE_NAME);
		$criteria->add(InoMaestraAirPeer::CA_REFERENCIA, $pk);

		$v = InoMaestraAirPeer::doSelect($criteria, $con);

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
			$con = Propel::getConnection(InoMaestraAirPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(InoMaestraAirPeer::DATABASE_NAME);
			$criteria->add(InoMaestraAirPeer::CA_REFERENCIA, $pks, Criteria::IN);
			$objs = InoMaestraAirPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseInoMaestraAirPeer

// This is the static code needed to register the MapBuilder for this table with the main Propel class.
//
// NOTE: This static code cannot call methods on the InoMaestraAirPeer class, because it is not defined yet.
// If you need to use overridden methods, you can add this code to the bottom of the InoMaestraAirPeer class:
//
// Propel::getDatabaseMap(InoMaestraAirPeer::DATABASE_NAME)->addTableBuilder(InoMaestraAirPeer::TABLE_NAME, InoMaestraAirPeer::getMapBuilder());
//
// Doing so will effectively overwrite the registration below.

Propel::getDatabaseMap(BaseInoMaestraAirPeer::DATABASE_NAME)->addTableBuilder(BaseInoMaestraAirPeer::TABLE_NAME, BaseInoMaestraAirPeer::getMapBuilder());

