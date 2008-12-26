<?php

/**
 * Base static class for performing query and update operations on the 'tb_cotrecargos' table.
 *
 * 
 *
 * @package    lib.model.cotizaciones.om
 */
abstract class BaseCotRecargoPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'tb_cotrecargos';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.cotizaciones.CotRecargo';

	/** The total number of columns. */
	const NUM_COLUMNS = 17;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** the column name for the CA_IDCOTIZACION field */
	const CA_IDCOTIZACION = 'tb_cotrecargos.CA_IDCOTIZACION';

	/** the column name for the CA_IDPRODUCTO field */
	const CA_IDPRODUCTO = 'tb_cotrecargos.CA_IDPRODUCTO';

	/** the column name for the CA_IDOPCION field */
	const CA_IDOPCION = 'tb_cotrecargos.CA_IDOPCION';

	/** the column name for the CA_IDCONCEPTO field */
	const CA_IDCONCEPTO = 'tb_cotrecargos.CA_IDCONCEPTO';

	/** the column name for the CA_IDRECARGO field */
	const CA_IDRECARGO = 'tb_cotrecargos.CA_IDRECARGO';

	/** the column name for the CA_TIPO field */
	const CA_TIPO = 'tb_cotrecargos.CA_TIPO';

	/** the column name for the CA_VALOR_TAR field */
	const CA_VALOR_TAR = 'tb_cotrecargos.CA_VALOR_TAR';

	/** the column name for the CA_APLICA_TAR field */
	const CA_APLICA_TAR = 'tb_cotrecargos.CA_APLICA_TAR';

	/** the column name for the CA_VALOR_MIN field */
	const CA_VALOR_MIN = 'tb_cotrecargos.CA_VALOR_MIN';

	/** the column name for the CA_APLICA_MIN field */
	const CA_APLICA_MIN = 'tb_cotrecargos.CA_APLICA_MIN';

	/** the column name for the CA_IDMONEDA field */
	const CA_IDMONEDA = 'tb_cotrecargos.CA_IDMONEDA';

	/** the column name for the CA_MODALIDAD field */
	const CA_MODALIDAD = 'tb_cotrecargos.CA_MODALIDAD';

	/** the column name for the CA_OBSERVACIONES field */
	const CA_OBSERVACIONES = 'tb_cotrecargos.CA_OBSERVACIONES';

	/** the column name for the CA_FCHCREADO field */
	const CA_FCHCREADO = 'tb_cotrecargos.CA_FCHCREADO';

	/** the column name for the CA_USUCREADO field */
	const CA_USUCREADO = 'tb_cotrecargos.CA_USUCREADO';

	/** the column name for the CA_FCHACTUALIZADO field */
	const CA_FCHACTUALIZADO = 'tb_cotrecargos.CA_FCHACTUALIZADO';

	/** the column name for the CA_USUACTUALIZADO field */
	const CA_USUACTUALIZADO = 'tb_cotrecargos.CA_USUACTUALIZADO';

	/**
	 * An identiy map to hold any loaded instances of CotRecargo objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array CotRecargo[]
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
		BasePeer::TYPE_PHPNAME => array ('CaIdcotizacion', 'CaIdproducto', 'CaIdopcion', 'CaIdconcepto', 'CaIdrecargo', 'CaTipo', 'CaValorTar', 'CaAplicaTar', 'CaValorMin', 'CaAplicaMin', 'CaIdmoneda', 'CaModalidad', 'CaObservaciones', 'CaFchcreado', 'CaUsucreado', 'CaFchactualizado', 'CaUsuactualizado', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdcotizacion', 'caIdproducto', 'caIdopcion', 'caIdconcepto', 'caIdrecargo', 'caTipo', 'caValorTar', 'caAplicaTar', 'caValorMin', 'caAplicaMin', 'caIdmoneda', 'caModalidad', 'caObservaciones', 'caFchcreado', 'caUsucreado', 'caFchactualizado', 'caUsuactualizado', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDCOTIZACION, self::CA_IDPRODUCTO, self::CA_IDOPCION, self::CA_IDCONCEPTO, self::CA_IDRECARGO, self::CA_TIPO, self::CA_VALOR_TAR, self::CA_APLICA_TAR, self::CA_VALOR_MIN, self::CA_APLICA_MIN, self::CA_IDMONEDA, self::CA_MODALIDAD, self::CA_OBSERVACIONES, self::CA_FCHCREADO, self::CA_USUCREADO, self::CA_FCHACTUALIZADO, self::CA_USUACTUALIZADO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcotizacion', 'ca_idproducto', 'ca_idopcion', 'ca_idconcepto', 'ca_idrecargo', 'ca_tipo', 'ca_valor_tar', 'ca_aplica_tar', 'ca_valor_min', 'ca_aplica_min', 'ca_idmoneda', 'ca_modalidad', 'ca_observaciones', 'ca_fchcreado', 'ca_usucreado', 'ca_fchactualizado', 'ca_usuactualizado', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdcotizacion' => 0, 'CaIdproducto' => 1, 'CaIdopcion' => 2, 'CaIdconcepto' => 3, 'CaIdrecargo' => 4, 'CaTipo' => 5, 'CaValorTar' => 6, 'CaAplicaTar' => 7, 'CaValorMin' => 8, 'CaAplicaMin' => 9, 'CaIdmoneda' => 10, 'CaModalidad' => 11, 'CaObservaciones' => 12, 'CaFchcreado' => 13, 'CaUsucreado' => 14, 'CaFchactualizado' => 15, 'CaUsuactualizado' => 16, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdcotizacion' => 0, 'caIdproducto' => 1, 'caIdopcion' => 2, 'caIdconcepto' => 3, 'caIdrecargo' => 4, 'caTipo' => 5, 'caValorTar' => 6, 'caAplicaTar' => 7, 'caValorMin' => 8, 'caAplicaMin' => 9, 'caIdmoneda' => 10, 'caModalidad' => 11, 'caObservaciones' => 12, 'caFchcreado' => 13, 'caUsucreado' => 14, 'caFchactualizado' => 15, 'caUsuactualizado' => 16, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDCOTIZACION => 0, self::CA_IDPRODUCTO => 1, self::CA_IDOPCION => 2, self::CA_IDCONCEPTO => 3, self::CA_IDRECARGO => 4, self::CA_TIPO => 5, self::CA_VALOR_TAR => 6, self::CA_APLICA_TAR => 7, self::CA_VALOR_MIN => 8, self::CA_APLICA_MIN => 9, self::CA_IDMONEDA => 10, self::CA_MODALIDAD => 11, self::CA_OBSERVACIONES => 12, self::CA_FCHCREADO => 13, self::CA_USUCREADO => 14, self::CA_FCHACTUALIZADO => 15, self::CA_USUACTUALIZADO => 16, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcotizacion' => 0, 'ca_idproducto' => 1, 'ca_idopcion' => 2, 'ca_idconcepto' => 3, 'ca_idrecargo' => 4, 'ca_tipo' => 5, 'ca_valor_tar' => 6, 'ca_aplica_tar' => 7, 'ca_valor_min' => 8, 'ca_aplica_min' => 9, 'ca_idmoneda' => 10, 'ca_modalidad' => 11, 'ca_observaciones' => 12, 'ca_fchcreado' => 13, 'ca_usucreado' => 14, 'ca_fchactualizado' => 15, 'ca_usuactualizado' => 16, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
	);

	/**
	 * Get a (singleton) instance of the MapBuilder for this peer class.
	 * @return     MapBuilder The map builder for this peer
	 */
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new CotRecargoMapBuilder();
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
	 * @param      string $column The column name for current table. (i.e. CotRecargoPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(CotRecargoPeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(CotRecargoPeer::CA_IDCOTIZACION);

		$criteria->addSelectColumn(CotRecargoPeer::CA_IDPRODUCTO);

		$criteria->addSelectColumn(CotRecargoPeer::CA_IDOPCION);

		$criteria->addSelectColumn(CotRecargoPeer::CA_IDCONCEPTO);

		$criteria->addSelectColumn(CotRecargoPeer::CA_IDRECARGO);

		$criteria->addSelectColumn(CotRecargoPeer::CA_TIPO);

		$criteria->addSelectColumn(CotRecargoPeer::CA_VALOR_TAR);

		$criteria->addSelectColumn(CotRecargoPeer::CA_APLICA_TAR);

		$criteria->addSelectColumn(CotRecargoPeer::CA_VALOR_MIN);

		$criteria->addSelectColumn(CotRecargoPeer::CA_APLICA_MIN);

		$criteria->addSelectColumn(CotRecargoPeer::CA_IDMONEDA);

		$criteria->addSelectColumn(CotRecargoPeer::CA_MODALIDAD);

		$criteria->addSelectColumn(CotRecargoPeer::CA_OBSERVACIONES);

		$criteria->addSelectColumn(CotRecargoPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(CotRecargoPeer::CA_USUCREADO);

		$criteria->addSelectColumn(CotRecargoPeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(CotRecargoPeer::CA_USUACTUALIZADO);

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
		$criteria->setPrimaryTableName(CotRecargoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotRecargoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(CotRecargoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return     CotRecargo
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = CotRecargoPeer::doSelect($critcopy, $con);
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
		return CotRecargoPeer::populateObjects(CotRecargoPeer::doSelectStmt($criteria, $con));
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
			$con = Propel::getConnection(CotRecargoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			CotRecargoPeer::addSelectColumns($criteria);
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
	 * @param      CotRecargo $value A CotRecargo object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool(CotRecargo $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getCaIdcotizacion(), (string) $obj->getCaIdproducto(), (string) $obj->getCaIdopcion(), (string) $obj->getCaIdconcepto(), (string) $obj->getCaIdrecargo(), (string) $obj->getCaModalidad()));
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
	 * @param      mixed $value A CotRecargo object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof CotRecargo) {
				$key = serialize(array((string) $value->getCaIdcotizacion(), (string) $value->getCaIdproducto(), (string) $value->getCaIdopcion(), (string) $value->getCaIdconcepto(), (string) $value->getCaIdrecargo(), (string) $value->getCaModalidad()));
			} elseif (is_array($value) && count($value) === 6) {
				// assume we've been passed a primary key
				$key = serialize(array((string) $value[0], (string) $value[1], (string) $value[2], (string) $value[3], (string) $value[4], (string) $value[5]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or CotRecargo object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	 * @return     CotRecargo Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
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
		if ($row[$startcol + 0] === null && $row[$startcol + 1] === null && $row[$startcol + 2] === null && $row[$startcol + 3] === null && $row[$startcol + 4] === null && $row[$startcol + 11] === null) {
			return null;
		}
		return serialize(array((string) $row[$startcol + 0], (string) $row[$startcol + 1], (string) $row[$startcol + 2], (string) $row[$startcol + 3], (string) $row[$startcol + 4], (string) $row[$startcol + 11]));
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
		$cls = CotRecargoPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = CotRecargoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = CotRecargoPeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				CotRecargoPeer::addInstanceToPool($obj, $key);
			} // if key exists
		}
		$stmt->closeCursor();
		return $results;
	}

	/**
	 * Returns the number of rows matching criteria, joining the related CotOpcion table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinCotOpcion(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(CotRecargoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotRecargoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotRecargoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(CotRecargoPeer::CA_IDOPCION,), array(CotOpcionPeer::CA_IDOPCION,), $join_behavior);

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
		$criteria->setPrimaryTableName(CotRecargoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotRecargoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotRecargoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(CotRecargoPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);

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
	 * Selects a collection of CotRecargo objects pre-filled with their CotOpcion objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of CotRecargo objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinCotOpcion(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotRecargoPeer::addSelectColumns($c);
		$startcol = (CotRecargoPeer::NUM_COLUMNS - CotRecargoPeer::NUM_LAZY_LOAD_COLUMNS);
		CotOpcionPeer::addSelectColumns($c);

		$c->addJoin(array(CotRecargoPeer::CA_IDOPCION,), array(CotOpcionPeer::CA_IDOPCION,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotRecargoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotRecargoPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = CotRecargoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotRecargoPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = CotOpcionPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = CotOpcionPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = CotOpcionPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					CotOpcionPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (CotRecargo) to $obj2 (CotOpcion)
				$obj2->addCotRecargo($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of CotRecargo objects pre-filled with their TipoRecargo objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of CotRecargo objects.
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

		CotRecargoPeer::addSelectColumns($c);
		$startcol = (CotRecargoPeer::NUM_COLUMNS - CotRecargoPeer::NUM_LAZY_LOAD_COLUMNS);
		TipoRecargoPeer::addSelectColumns($c);

		$c->addJoin(array(CotRecargoPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotRecargoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotRecargoPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = CotRecargoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotRecargoPeer::addInstanceToPool($obj1, $key1);
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

				// Add the $obj1 (CotRecargo) to $obj2 (TipoRecargo)
				$obj2->addCotRecargo($obj1);

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
		$criteria->setPrimaryTableName(CotRecargoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotRecargoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotRecargoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(CotRecargoPeer::CA_IDOPCION,), array(CotOpcionPeer::CA_IDOPCION,), $join_behavior);
		$criteria->addJoin(array(CotRecargoPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);
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
	 * Selects a collection of CotRecargo objects pre-filled with all related objects.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of CotRecargo objects.
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

		CotRecargoPeer::addSelectColumns($c);
		$startcol2 = (CotRecargoPeer::NUM_COLUMNS - CotRecargoPeer::NUM_LAZY_LOAD_COLUMNS);

		CotOpcionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (CotOpcionPeer::NUM_COLUMNS - CotOpcionPeer::NUM_LAZY_LOAD_COLUMNS);

		TipoRecargoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (TipoRecargoPeer::NUM_COLUMNS - TipoRecargoPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(CotRecargoPeer::CA_IDOPCION,), array(CotOpcionPeer::CA_IDOPCION,), $join_behavior);
		$c->addJoin(array(CotRecargoPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotRecargoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotRecargoPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = CotRecargoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotRecargoPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

			// Add objects for joined CotOpcion rows

			$key2 = CotOpcionPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = CotOpcionPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = CotOpcionPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					CotOpcionPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 loaded

				// Add the $obj1 (CotRecargo) to the collection in $obj2 (CotOpcion)
				$obj2->addCotRecargo($obj1);
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

				// Add the $obj1 (CotRecargo) to the collection in $obj3 (TipoRecargo)
				$obj3->addCotRecargo($obj1);
			} // if joined row not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related CotOpcion table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptCotOpcion(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotRecargoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotRecargoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(CotRecargoPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);
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
			CotRecargoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotRecargoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(CotRecargoPeer::CA_IDOPCION,), array(CotOpcionPeer::CA_IDOPCION,), $join_behavior);
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
	 * Selects a collection of CotRecargo objects pre-filled with all related objects except CotOpcion.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of CotRecargo objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptCotOpcion(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotRecargoPeer::addSelectColumns($c);
		$startcol2 = (CotRecargoPeer::NUM_COLUMNS - CotRecargoPeer::NUM_LAZY_LOAD_COLUMNS);

		TipoRecargoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (TipoRecargoPeer::NUM_COLUMNS - TipoRecargoPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(CotRecargoPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotRecargoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotRecargoPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = CotRecargoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotRecargoPeer::addInstanceToPool($obj1, $key1);
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

				// Add the $obj1 (CotRecargo) to the collection in $obj2 (TipoRecargo)
				$obj2->addCotRecargo($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of CotRecargo objects pre-filled with all related objects except TipoRecargo.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of CotRecargo objects.
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

		CotRecargoPeer::addSelectColumns($c);
		$startcol2 = (CotRecargoPeer::NUM_COLUMNS - CotRecargoPeer::NUM_LAZY_LOAD_COLUMNS);

		CotOpcionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (CotOpcionPeer::NUM_COLUMNS - CotOpcionPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(CotRecargoPeer::CA_IDOPCION,), array(CotOpcionPeer::CA_IDOPCION,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotRecargoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotRecargoPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = CotRecargoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotRecargoPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined CotOpcion rows

				$key2 = CotOpcionPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = CotOpcionPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = CotOpcionPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					CotOpcionPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (CotRecargo) to the collection in $obj2 (CotOpcion)
				$obj2->addCotRecargo($obj1);

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
		return CotRecargoPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a CotRecargo or Criteria object.
	 *
	 * @param      mixed $values Criteria or CotRecargo object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(CotRecargoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from CotRecargo object
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
	 * Method perform an UPDATE on the database, given a CotRecargo or Criteria object.
	 *
	 * @param      mixed $values Criteria or CotRecargo object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(CotRecargoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(CotRecargoPeer::CA_IDCOTIZACION);
			$selectCriteria->add(CotRecargoPeer::CA_IDCOTIZACION, $criteria->remove(CotRecargoPeer::CA_IDCOTIZACION), $comparison);

			$comparison = $criteria->getComparison(CotRecargoPeer::CA_IDPRODUCTO);
			$selectCriteria->add(CotRecargoPeer::CA_IDPRODUCTO, $criteria->remove(CotRecargoPeer::CA_IDPRODUCTO), $comparison);

			$comparison = $criteria->getComparison(CotRecargoPeer::CA_IDOPCION);
			$selectCriteria->add(CotRecargoPeer::CA_IDOPCION, $criteria->remove(CotRecargoPeer::CA_IDOPCION), $comparison);

			$comparison = $criteria->getComparison(CotRecargoPeer::CA_IDCONCEPTO);
			$selectCriteria->add(CotRecargoPeer::CA_IDCONCEPTO, $criteria->remove(CotRecargoPeer::CA_IDCONCEPTO), $comparison);

			$comparison = $criteria->getComparison(CotRecargoPeer::CA_IDRECARGO);
			$selectCriteria->add(CotRecargoPeer::CA_IDRECARGO, $criteria->remove(CotRecargoPeer::CA_IDRECARGO), $comparison);

			$comparison = $criteria->getComparison(CotRecargoPeer::CA_MODALIDAD);
			$selectCriteria->add(CotRecargoPeer::CA_MODALIDAD, $criteria->remove(CotRecargoPeer::CA_MODALIDAD), $comparison);

		} else { // $values is CotRecargo object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the tb_cotrecargos table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(CotRecargoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(CotRecargoPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a CotRecargo or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or CotRecargo object or primary key or array of primary keys
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
			$con = Propel::getConnection(CotRecargoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			CotRecargoPeer::clearInstancePool();

			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof CotRecargo) {
			// invalidate the cache for this single object
			CotRecargoPeer::removeInstanceFromPool($values);
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

				$criterion = $criteria->getNewCriterion(CotRecargoPeer::CA_IDCOTIZACION, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(CotRecargoPeer::CA_IDPRODUCTO, $value[1]));
				$criterion->addAnd($criteria->getNewCriterion(CotRecargoPeer::CA_IDOPCION, $value[2]));
				$criterion->addAnd($criteria->getNewCriterion(CotRecargoPeer::CA_IDCONCEPTO, $value[3]));
				$criterion->addAnd($criteria->getNewCriterion(CotRecargoPeer::CA_IDRECARGO, $value[4]));
				$criterion->addAnd($criteria->getNewCriterion(CotRecargoPeer::CA_MODALIDAD, $value[5]));
				$criteria->addOr($criterion);

				// we can invalidate the cache for this single PK
				CotRecargoPeer::removeInstanceFromPool($value);
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
	 * Validates all modified columns of given CotRecargo object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      CotRecargo $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(CotRecargo $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(CotRecargoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(CotRecargoPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(CotRecargoPeer::DATABASE_NAME, CotRecargoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = CotRecargoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	/**
	 * Retrieve object using using composite pkey values.
	 * @param      int $ca_idcotizacion
	   @param      int $ca_idproducto
	   @param      int $ca_idopcion
	   @param      int $ca_idconcepto
	   @param      int $ca_idrecargo
	   @param      string $ca_modalidad
	   
	 * @param      PropelPDO $con
	 * @return     CotRecargo
	 */
	public static function retrieveByPK($ca_idcotizacion, $ca_idproducto, $ca_idopcion, $ca_idconcepto, $ca_idrecargo, $ca_modalidad, PropelPDO $con = null) {
		$key = serialize(array((string) $ca_idcotizacion, (string) $ca_idproducto, (string) $ca_idopcion, (string) $ca_idconcepto, (string) $ca_idrecargo, (string) $ca_modalidad));
 		if (null !== ($obj = CotRecargoPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(CotRecargoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(CotRecargoPeer::DATABASE_NAME);
		$criteria->add(CotRecargoPeer::CA_IDCOTIZACION, $ca_idcotizacion);
		$criteria->add(CotRecargoPeer::CA_IDPRODUCTO, $ca_idproducto);
		$criteria->add(CotRecargoPeer::CA_IDOPCION, $ca_idopcion);
		$criteria->add(CotRecargoPeer::CA_IDCONCEPTO, $ca_idconcepto);
		$criteria->add(CotRecargoPeer::CA_IDRECARGO, $ca_idrecargo);
		$criteria->add(CotRecargoPeer::CA_MODALIDAD, $ca_modalidad);
		$v = CotRecargoPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} // BaseCotRecargoPeer

// This is the static code needed to register the MapBuilder for this table with the main Propel class.
//
// NOTE: This static code cannot call methods on the CotRecargoPeer class, because it is not defined yet.
// If you need to use overridden methods, you can add this code to the bottom of the CotRecargoPeer class:
//
// Propel::getDatabaseMap(CotRecargoPeer::DATABASE_NAME)->addTableBuilder(CotRecargoPeer::TABLE_NAME, CotRecargoPeer::getMapBuilder());
//
// Doing so will effectively overwrite the registration below.

Propel::getDatabaseMap(BaseCotRecargoPeer::DATABASE_NAME)->addTableBuilder(BaseCotRecargoPeer::TABLE_NAME, BaseCotRecargoPeer::getMapBuilder());

