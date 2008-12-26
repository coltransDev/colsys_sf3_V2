<?php

/**
 * Base static class for performing query and update operations on the 'tb_repavisos' table.
 *
 * 
 *
 * @package    lib.model.reportes.om
 */
abstract class BaseRepAvisoPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'tb_repavisos';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.reportes.RepAviso';

	/** The total number of columns. */
	const NUM_COLUMNS = 19;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** the column name for the CA_IDREPORTE field */
	const CA_IDREPORTE = 'tb_repavisos.CA_IDREPORTE';

	/** the column name for the CA_IDEMAIL field */
	const CA_IDEMAIL = 'tb_repavisos.CA_IDEMAIL';

	/** the column name for the CA_INTRODUCCION field */
	const CA_INTRODUCCION = 'tb_repavisos.CA_INTRODUCCION';

	/** the column name for the CA_FCHSALIDA field */
	const CA_FCHSALIDA = 'tb_repavisos.CA_FCHSALIDA';

	/** the column name for the CA_FCHLLEGADA field */
	const CA_FCHLLEGADA = 'tb_repavisos.CA_FCHLLEGADA';

	/** the column name for the CA_FCHCONTINUACION field */
	const CA_FCHCONTINUACION = 'tb_repavisos.CA_FCHCONTINUACION';

	/** the column name for the CA_PIEZAS field */
	const CA_PIEZAS = 'tb_repavisos.CA_PIEZAS';

	/** the column name for the CA_PESO field */
	const CA_PESO = 'tb_repavisos.CA_PESO';

	/** the column name for the CA_VOLUMEN field */
	const CA_VOLUMEN = 'tb_repavisos.CA_VOLUMEN';

	/** the column name for the CA_FCHENVIO field */
	const CA_FCHENVIO = 'tb_repavisos.CA_FCHENVIO';

	/** the column name for the CA_USUENVIO field */
	const CA_USUENVIO = 'tb_repavisos.CA_USUENVIO';

	/** the column name for the CA_DOCTRANSPORTE field */
	const CA_DOCTRANSPORTE = 'tb_repavisos.CA_DOCTRANSPORTE';

	/** the column name for the CA_IDNAVE field */
	const CA_IDNAVE = 'tb_repavisos.CA_IDNAVE';

	/** the column name for the CA_NOTAS field */
	const CA_NOTAS = 'tb_repavisos.CA_NOTAS';

	/** the column name for the CA_ETAPA field */
	const CA_ETAPA = 'tb_repavisos.CA_ETAPA';

	/** the column name for the CA_DOCMASTER field */
	const CA_DOCMASTER = 'tb_repavisos.CA_DOCMASTER';

	/** the column name for the CA_EQUIPOS field */
	const CA_EQUIPOS = 'tb_repavisos.CA_EQUIPOS';

	/** the column name for the CA_HORASALIDA field */
	const CA_HORASALIDA = 'tb_repavisos.CA_HORASALIDA';

	/** the column name for the CA_TIPO field */
	const CA_TIPO = 'tb_repavisos.CA_TIPO';

	/**
	 * An identiy map to hold any loaded instances of RepAviso objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array RepAviso[]
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
		BasePeer::TYPE_PHPNAME => array ('CaIdreporte', 'CaIdemail', 'CaIntroduccion', 'CaFchsalida', 'CaFchllegada', 'CaFchcontinuacion', 'CaPiezas', 'CaPeso', 'CaVolumen', 'CaFchenvio', 'CaUsuenvio', 'CaDoctransporte', 'CaIdnave', 'CaNotas', 'CaEtapa', 'CaDocmaster', 'CaEquipos', 'CaHorasalida', 'CaTipo', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdreporte', 'caIdemail', 'caIntroduccion', 'caFchsalida', 'caFchllegada', 'caFchcontinuacion', 'caPiezas', 'caPeso', 'caVolumen', 'caFchenvio', 'caUsuenvio', 'caDoctransporte', 'caIdnave', 'caNotas', 'caEtapa', 'caDocmaster', 'caEquipos', 'caHorasalida', 'caTipo', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDREPORTE, self::CA_IDEMAIL, self::CA_INTRODUCCION, self::CA_FCHSALIDA, self::CA_FCHLLEGADA, self::CA_FCHCONTINUACION, self::CA_PIEZAS, self::CA_PESO, self::CA_VOLUMEN, self::CA_FCHENVIO, self::CA_USUENVIO, self::CA_DOCTRANSPORTE, self::CA_IDNAVE, self::CA_NOTAS, self::CA_ETAPA, self::CA_DOCMASTER, self::CA_EQUIPOS, self::CA_HORASALIDA, self::CA_TIPO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idreporte', 'ca_idemail', 'ca_introduccion', 'ca_fchsalida', 'ca_fchllegada', 'ca_fchcontinuacion', 'ca_piezas', 'ca_peso', 'ca_volumen', 'ca_fchenvio', 'ca_usuenvio', 'ca_doctransporte', 'ca_idnave', 'ca_notas', 'ca_etapa', 'ca_docmaster', 'ca_equipos', 'ca_horasalida', 'ca_tipo', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdreporte' => 0, 'CaIdemail' => 1, 'CaIntroduccion' => 2, 'CaFchsalida' => 3, 'CaFchllegada' => 4, 'CaFchcontinuacion' => 5, 'CaPiezas' => 6, 'CaPeso' => 7, 'CaVolumen' => 8, 'CaFchenvio' => 9, 'CaUsuenvio' => 10, 'CaDoctransporte' => 11, 'CaIdnave' => 12, 'CaNotas' => 13, 'CaEtapa' => 14, 'CaDocmaster' => 15, 'CaEquipos' => 16, 'CaHorasalida' => 17, 'CaTipo' => 18, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdreporte' => 0, 'caIdemail' => 1, 'caIntroduccion' => 2, 'caFchsalida' => 3, 'caFchllegada' => 4, 'caFchcontinuacion' => 5, 'caPiezas' => 6, 'caPeso' => 7, 'caVolumen' => 8, 'caFchenvio' => 9, 'caUsuenvio' => 10, 'caDoctransporte' => 11, 'caIdnave' => 12, 'caNotas' => 13, 'caEtapa' => 14, 'caDocmaster' => 15, 'caEquipos' => 16, 'caHorasalida' => 17, 'caTipo' => 18, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDREPORTE => 0, self::CA_IDEMAIL => 1, self::CA_INTRODUCCION => 2, self::CA_FCHSALIDA => 3, self::CA_FCHLLEGADA => 4, self::CA_FCHCONTINUACION => 5, self::CA_PIEZAS => 6, self::CA_PESO => 7, self::CA_VOLUMEN => 8, self::CA_FCHENVIO => 9, self::CA_USUENVIO => 10, self::CA_DOCTRANSPORTE => 11, self::CA_IDNAVE => 12, self::CA_NOTAS => 13, self::CA_ETAPA => 14, self::CA_DOCMASTER => 15, self::CA_EQUIPOS => 16, self::CA_HORASALIDA => 17, self::CA_TIPO => 18, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idreporte' => 0, 'ca_idemail' => 1, 'ca_introduccion' => 2, 'ca_fchsalida' => 3, 'ca_fchllegada' => 4, 'ca_fchcontinuacion' => 5, 'ca_piezas' => 6, 'ca_peso' => 7, 'ca_volumen' => 8, 'ca_fchenvio' => 9, 'ca_usuenvio' => 10, 'ca_doctransporte' => 11, 'ca_idnave' => 12, 'ca_notas' => 13, 'ca_etapa' => 14, 'ca_docmaster' => 15, 'ca_equipos' => 16, 'ca_horasalida' => 17, 'ca_tipo' => 18, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
	);

	/**
	 * Get a (singleton) instance of the MapBuilder for this peer class.
	 * @return     MapBuilder The map builder for this peer
	 */
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new RepAvisoMapBuilder();
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
	 * @param      string $column The column name for current table. (i.e. RepAvisoPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(RepAvisoPeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(RepAvisoPeer::CA_IDREPORTE);

		$criteria->addSelectColumn(RepAvisoPeer::CA_IDEMAIL);

		$criteria->addSelectColumn(RepAvisoPeer::CA_INTRODUCCION);

		$criteria->addSelectColumn(RepAvisoPeer::CA_FCHSALIDA);

		$criteria->addSelectColumn(RepAvisoPeer::CA_FCHLLEGADA);

		$criteria->addSelectColumn(RepAvisoPeer::CA_FCHCONTINUACION);

		$criteria->addSelectColumn(RepAvisoPeer::CA_PIEZAS);

		$criteria->addSelectColumn(RepAvisoPeer::CA_PESO);

		$criteria->addSelectColumn(RepAvisoPeer::CA_VOLUMEN);

		$criteria->addSelectColumn(RepAvisoPeer::CA_FCHENVIO);

		$criteria->addSelectColumn(RepAvisoPeer::CA_USUENVIO);

		$criteria->addSelectColumn(RepAvisoPeer::CA_DOCTRANSPORTE);

		$criteria->addSelectColumn(RepAvisoPeer::CA_IDNAVE);

		$criteria->addSelectColumn(RepAvisoPeer::CA_NOTAS);

		$criteria->addSelectColumn(RepAvisoPeer::CA_ETAPA);

		$criteria->addSelectColumn(RepAvisoPeer::CA_DOCMASTER);

		$criteria->addSelectColumn(RepAvisoPeer::CA_EQUIPOS);

		$criteria->addSelectColumn(RepAvisoPeer::CA_HORASALIDA);

		$criteria->addSelectColumn(RepAvisoPeer::CA_TIPO);

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
		$criteria->setPrimaryTableName(RepAvisoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RepAvisoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(RepAvisoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return     RepAviso
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = RepAvisoPeer::doSelect($critcopy, $con);
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
		return RepAvisoPeer::populateObjects(RepAvisoPeer::doSelectStmt($criteria, $con));
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
			$con = Propel::getConnection(RepAvisoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			RepAvisoPeer::addSelectColumns($criteria);
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
	 * @param      RepAviso $value A RepAviso object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool(RepAviso $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getCaIdreporte(), (string) $obj->getCaIdemail()));
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
	 * @param      mixed $value A RepAviso object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof RepAviso) {
				$key = serialize(array((string) $value->getCaIdreporte(), (string) $value->getCaIdemail()));
			} elseif (is_array($value) && count($value) === 2) {
				// assume we've been passed a primary key
				$key = serialize(array((string) $value[0], (string) $value[1]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or RepAviso object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	 * @return     RepAviso Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
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
		if ($row[$startcol + 0] === null && $row[$startcol + 1] === null) {
			return null;
		}
		return serialize(array((string) $row[$startcol + 0], (string) $row[$startcol + 1]));
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
		$cls = RepAvisoPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = RepAvisoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = RepAvisoPeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				RepAvisoPeer::addInstanceToPool($obj, $key);
			} // if key exists
		}
		$stmt->closeCursor();
		return $results;
	}

	/**
	 * Returns the number of rows matching criteria, joining the related Reporte table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinReporte(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(RepAvisoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RepAvisoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RepAvisoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(RepAvisoPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);

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
	 * Returns the number of rows matching criteria, joining the related Email table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinEmail(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(RepAvisoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RepAvisoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RepAvisoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(RepAvisoPeer::CA_IDEMAIL,), array(EmailPeer::CA_IDEMAIL,), $join_behavior);

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
	 * Selects a collection of RepAviso objects pre-filled with their Reporte objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of RepAviso objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinReporte(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepAvisoPeer::addSelectColumns($c);
		$startcol = (RepAvisoPeer::NUM_COLUMNS - RepAvisoPeer::NUM_LAZY_LOAD_COLUMNS);
		ReportePeer::addSelectColumns($c);

		$c->addJoin(array(RepAvisoPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RepAvisoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RepAvisoPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = RepAvisoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				RepAvisoPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = ReportePeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = ReportePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = ReportePeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					ReportePeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (RepAviso) to $obj2 (Reporte)
				$obj2->addRepAviso($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of RepAviso objects pre-filled with their Email objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of RepAviso objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinEmail(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepAvisoPeer::addSelectColumns($c);
		$startcol = (RepAvisoPeer::NUM_COLUMNS - RepAvisoPeer::NUM_LAZY_LOAD_COLUMNS);
		EmailPeer::addSelectColumns($c);

		$c->addJoin(array(RepAvisoPeer::CA_IDEMAIL,), array(EmailPeer::CA_IDEMAIL,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RepAvisoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RepAvisoPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = RepAvisoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				RepAvisoPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = EmailPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = EmailPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = EmailPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					EmailPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (RepAviso) to $obj2 (Email)
				$obj2->addRepAviso($obj1);

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
		$criteria->setPrimaryTableName(RepAvisoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RepAvisoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RepAvisoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(RepAvisoPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
		$criteria->addJoin(array(RepAvisoPeer::CA_IDEMAIL,), array(EmailPeer::CA_IDEMAIL,), $join_behavior);
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
	 * Selects a collection of RepAviso objects pre-filled with all related objects.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of RepAviso objects.
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

		RepAvisoPeer::addSelectColumns($c);
		$startcol2 = (RepAvisoPeer::NUM_COLUMNS - RepAvisoPeer::NUM_LAZY_LOAD_COLUMNS);

		ReportePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS);

		EmailPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (EmailPeer::NUM_COLUMNS - EmailPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(RepAvisoPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
		$c->addJoin(array(RepAvisoPeer::CA_IDEMAIL,), array(EmailPeer::CA_IDEMAIL,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RepAvisoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RepAvisoPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = RepAvisoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				RepAvisoPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

			// Add objects for joined Reporte rows

			$key2 = ReportePeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = ReportePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = ReportePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					ReportePeer::addInstanceToPool($obj2, $key2);
				} // if obj2 loaded

				// Add the $obj1 (RepAviso) to the collection in $obj2 (Reporte)
				$obj2->addRepAviso($obj1);
			} // if joined row not null

			// Add objects for joined Email rows

			$key3 = EmailPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = EmailPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = EmailPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					EmailPeer::addInstanceToPool($obj3, $key3);
				} // if obj3 loaded

				// Add the $obj1 (RepAviso) to the collection in $obj3 (Email)
				$obj3->addRepAviso($obj1);
			} // if joined row not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Reporte table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptReporte(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RepAvisoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RepAvisoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(RepAvisoPeer::CA_IDEMAIL,), array(EmailPeer::CA_IDEMAIL,), $join_behavior);
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
	 * Returns the number of rows matching criteria, joining the related Email table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptEmail(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RepAvisoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RepAvisoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(RepAvisoPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
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
	 * Selects a collection of RepAviso objects pre-filled with all related objects except Reporte.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of RepAviso objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptReporte(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepAvisoPeer::addSelectColumns($c);
		$startcol2 = (RepAvisoPeer::NUM_COLUMNS - RepAvisoPeer::NUM_LAZY_LOAD_COLUMNS);

		EmailPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (EmailPeer::NUM_COLUMNS - EmailPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(RepAvisoPeer::CA_IDEMAIL,), array(EmailPeer::CA_IDEMAIL,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RepAvisoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RepAvisoPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = RepAvisoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				RepAvisoPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined Email rows

				$key2 = EmailPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = EmailPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = EmailPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					EmailPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (RepAviso) to the collection in $obj2 (Email)
				$obj2->addRepAviso($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of RepAviso objects pre-filled with all related objects except Email.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of RepAviso objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptEmail(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepAvisoPeer::addSelectColumns($c);
		$startcol2 = (RepAvisoPeer::NUM_COLUMNS - RepAvisoPeer::NUM_LAZY_LOAD_COLUMNS);

		ReportePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(RepAvisoPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RepAvisoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RepAvisoPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = RepAvisoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				RepAvisoPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined Reporte rows

				$key2 = ReportePeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = ReportePeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = ReportePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					ReportePeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (RepAviso) to the collection in $obj2 (Reporte)
				$obj2->addRepAviso($obj1);

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
		return RepAvisoPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a RepAviso or Criteria object.
	 *
	 * @param      mixed $values Criteria or RepAviso object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(RepAvisoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from RepAviso object
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
	 * Method perform an UPDATE on the database, given a RepAviso or Criteria object.
	 *
	 * @param      mixed $values Criteria or RepAviso object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(RepAvisoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(RepAvisoPeer::CA_IDREPORTE);
			$selectCriteria->add(RepAvisoPeer::CA_IDREPORTE, $criteria->remove(RepAvisoPeer::CA_IDREPORTE), $comparison);

			$comparison = $criteria->getComparison(RepAvisoPeer::CA_IDEMAIL);
			$selectCriteria->add(RepAvisoPeer::CA_IDEMAIL, $criteria->remove(RepAvisoPeer::CA_IDEMAIL), $comparison);

		} else { // $values is RepAviso object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the tb_repavisos table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(RepAvisoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(RepAvisoPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a RepAviso or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or RepAviso object or primary key or array of primary keys
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
			$con = Propel::getConnection(RepAvisoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			RepAvisoPeer::clearInstancePool();

			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof RepAviso) {
			// invalidate the cache for this single object
			RepAvisoPeer::removeInstanceFromPool($values);
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

				$criterion = $criteria->getNewCriterion(RepAvisoPeer::CA_IDREPORTE, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(RepAvisoPeer::CA_IDEMAIL, $value[1]));
				$criteria->addOr($criterion);

				// we can invalidate the cache for this single PK
				RepAvisoPeer::removeInstanceFromPool($value);
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
	 * Validates all modified columns of given RepAviso object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      RepAviso $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(RepAviso $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(RepAvisoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(RepAvisoPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(RepAvisoPeer::DATABASE_NAME, RepAvisoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = RepAvisoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	/**
	 * Retrieve object using using composite pkey values.
	 * @param      int $ca_idreporte
	   @param      int $ca_idemail
	   
	 * @param      PropelPDO $con
	 * @return     RepAviso
	 */
	public static function retrieveByPK($ca_idreporte, $ca_idemail, PropelPDO $con = null) {
		$key = serialize(array((string) $ca_idreporte, (string) $ca_idemail));
 		if (null !== ($obj = RepAvisoPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(RepAvisoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(RepAvisoPeer::DATABASE_NAME);
		$criteria->add(RepAvisoPeer::CA_IDREPORTE, $ca_idreporte);
		$criteria->add(RepAvisoPeer::CA_IDEMAIL, $ca_idemail);
		$v = RepAvisoPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} // BaseRepAvisoPeer

// This is the static code needed to register the MapBuilder for this table with the main Propel class.
//
// NOTE: This static code cannot call methods on the RepAvisoPeer class, because it is not defined yet.
// If you need to use overridden methods, you can add this code to the bottom of the RepAvisoPeer class:
//
// Propel::getDatabaseMap(RepAvisoPeer::DATABASE_NAME)->addTableBuilder(RepAvisoPeer::TABLE_NAME, RepAvisoPeer::getMapBuilder());
//
// Doing so will effectively overwrite the registration below.

Propel::getDatabaseMap(BaseRepAvisoPeer::DATABASE_NAME)->addTableBuilder(BaseRepAvisoPeer::TABLE_NAME, BaseRepAvisoPeer::getMapBuilder());

