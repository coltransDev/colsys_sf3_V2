<?php

/**
 * Base static class for performing query and update operations on the 'tb_inoclientes_sea' table.
 *
 * 
 *
 * @package    lib.model.sea.om
 */
abstract class BaseInoClientesSeaPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'tb_inoclientes_sea';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.sea.InoClientesSea';

	/** The total number of columns. */
	const NUM_COLUMNS = 26;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** the column name for the OID field */
	const OID = 'tb_inoclientes_sea.OID';

	/** the column name for the CA_REFERENCIA field */
	const CA_REFERENCIA = 'tb_inoclientes_sea.CA_REFERENCIA';

	/** the column name for the CA_IDCLIENTE field */
	const CA_IDCLIENTE = 'tb_inoclientes_sea.CA_IDCLIENTE';

	/** the column name for the CA_HBLS field */
	const CA_HBLS = 'tb_inoclientes_sea.CA_HBLS';

	/** the column name for the CA_IDREPORTE field */
	const CA_IDREPORTE = 'tb_inoclientes_sea.CA_IDREPORTE';

	/** the column name for the CA_IDPROVEEDOR field */
	const CA_IDPROVEEDOR = 'tb_inoclientes_sea.CA_IDPROVEEDOR';

	/** the column name for the CA_PROVEEDOR field */
	const CA_PROVEEDOR = 'tb_inoclientes_sea.CA_PROVEEDOR';

	/** the column name for the CA_NUMPIEZAS field */
	const CA_NUMPIEZAS = 'tb_inoclientes_sea.CA_NUMPIEZAS';

	/** the column name for the CA_PESO field */
	const CA_PESO = 'tb_inoclientes_sea.CA_PESO';

	/** the column name for the CA_VOLUMEN field */
	const CA_VOLUMEN = 'tb_inoclientes_sea.CA_VOLUMEN';

	/** the column name for the CA_NUMORDEN field */
	const CA_NUMORDEN = 'tb_inoclientes_sea.CA_NUMORDEN';

	/** the column name for the CA_CONFIRMAR field */
	const CA_CONFIRMAR = 'tb_inoclientes_sea.CA_CONFIRMAR';

	/** the column name for the CA_LOGIN field */
	const CA_LOGIN = 'tb_inoclientes_sea.CA_LOGIN';

	/** the column name for the CA_OBSERVACIONES field */
	const CA_OBSERVACIONES = 'tb_inoclientes_sea.CA_OBSERVACIONES';

	/** the column name for the CA_FCHLIBERACION field */
	const CA_FCHLIBERACION = 'tb_inoclientes_sea.CA_FCHLIBERACION';

	/** the column name for the CA_NOTALIBERACION field */
	const CA_NOTALIBERACION = 'tb_inoclientes_sea.CA_NOTALIBERACION';

	/** the column name for the CA_FCHCREADO field */
	const CA_FCHCREADO = 'tb_inoclientes_sea.CA_FCHCREADO';

	/** the column name for the CA_USUCREADO field */
	const CA_USUCREADO = 'tb_inoclientes_sea.CA_USUCREADO';

	/** the column name for the CA_FCHACTUALIZADO field */
	const CA_FCHACTUALIZADO = 'tb_inoclientes_sea.CA_FCHACTUALIZADO';

	/** the column name for the CA_USUACTUALIZADO field */
	const CA_USUACTUALIZADO = 'tb_inoclientes_sea.CA_USUACTUALIZADO';

	/** the column name for the CA_FCHLIBERADO field */
	const CA_FCHLIBERADO = 'tb_inoclientes_sea.CA_FCHLIBERADO';

	/** the column name for the CA_USULIBERADO field */
	const CA_USULIBERADO = 'tb_inoclientes_sea.CA_USULIBERADO';

	/** the column name for the CA_MENSAJE field */
	const CA_MENSAJE = 'tb_inoclientes_sea.CA_MENSAJE';

	/** the column name for the CA_CONTINUACION field */
	const CA_CONTINUACION = 'tb_inoclientes_sea.CA_CONTINUACION';

	/** the column name for the CA_CONTINUACION_DEST field */
	const CA_CONTINUACION_DEST = 'tb_inoclientes_sea.CA_CONTINUACION_DEST';

	/** the column name for the CA_IDBODEGA field */
	const CA_IDBODEGA = 'tb_inoclientes_sea.CA_IDBODEGA';

	/**
	 * An identiy map to hold any loaded instances of InoClientesSea objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array InoClientesSea[]
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
		BasePeer::TYPE_PHPNAME => array ('Oid', 'CaReferencia', 'CaIdcliente', 'CaHbls', 'CaIdreporte', 'CaIdproveedor', 'CaProveedor', 'CaNumpiezas', 'CaPeso', 'CaVolumen', 'CaNumorden', 'CaConfirmar', 'CaLogin', 'CaObservaciones', 'CaFchliberacion', 'CaNotaliberacion', 'CaFchcreado', 'CaUsucreado', 'CaFchactualizado', 'CaUsuactualizado', 'CaFchliberado', 'CaUsuliberado', 'CaMensaje', 'CaContinuacion', 'CaContinuacionDest', 'CaIdbodega', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('oid', 'caReferencia', 'caIdcliente', 'caHbls', 'caIdreporte', 'caIdproveedor', 'caProveedor', 'caNumpiezas', 'caPeso', 'caVolumen', 'caNumorden', 'caConfirmar', 'caLogin', 'caObservaciones', 'caFchliberacion', 'caNotaliberacion', 'caFchcreado', 'caUsucreado', 'caFchactualizado', 'caUsuactualizado', 'caFchliberado', 'caUsuliberado', 'caMensaje', 'caContinuacion', 'caContinuacionDest', 'caIdbodega', ),
		BasePeer::TYPE_COLNAME => array (self::OID, self::CA_REFERENCIA, self::CA_IDCLIENTE, self::CA_HBLS, self::CA_IDREPORTE, self::CA_IDPROVEEDOR, self::CA_PROVEEDOR, self::CA_NUMPIEZAS, self::CA_PESO, self::CA_VOLUMEN, self::CA_NUMORDEN, self::CA_CONFIRMAR, self::CA_LOGIN, self::CA_OBSERVACIONES, self::CA_FCHLIBERACION, self::CA_NOTALIBERACION, self::CA_FCHCREADO, self::CA_USUCREADO, self::CA_FCHACTUALIZADO, self::CA_USUACTUALIZADO, self::CA_FCHLIBERADO, self::CA_USULIBERADO, self::CA_MENSAJE, self::CA_CONTINUACION, self::CA_CONTINUACION_DEST, self::CA_IDBODEGA, ),
		BasePeer::TYPE_FIELDNAME => array ('oid', 'ca_referencia', 'ca_idcliente', 'ca_hbls', 'ca_idreporte', 'ca_idproveedor', 'ca_proveedor', 'ca_numpiezas', 'ca_peso', 'ca_volumen', 'ca_numorden', 'ca_confirmar', 'ca_login', 'ca_observaciones', 'ca_fchliberacion', 'ca_notaliberacion', 'ca_fchcreado', 'ca_usucreado', 'ca_fchactualizado', 'ca_usuactualizado', 'ca_fchliberado', 'ca_usuliberado', 'ca_mensaje', 'ca_continuacion', 'ca_continuacion_dest', 'ca_idbodega', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Oid' => 0, 'CaReferencia' => 1, 'CaIdcliente' => 2, 'CaHbls' => 3, 'CaIdreporte' => 4, 'CaIdproveedor' => 5, 'CaProveedor' => 6, 'CaNumpiezas' => 7, 'CaPeso' => 8, 'CaVolumen' => 9, 'CaNumorden' => 10, 'CaConfirmar' => 11, 'CaLogin' => 12, 'CaObservaciones' => 13, 'CaFchliberacion' => 14, 'CaNotaliberacion' => 15, 'CaFchcreado' => 16, 'CaUsucreado' => 17, 'CaFchactualizado' => 18, 'CaUsuactualizado' => 19, 'CaFchliberado' => 20, 'CaUsuliberado' => 21, 'CaMensaje' => 22, 'CaContinuacion' => 23, 'CaContinuacionDest' => 24, 'CaIdbodega' => 25, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('oid' => 0, 'caReferencia' => 1, 'caIdcliente' => 2, 'caHbls' => 3, 'caIdreporte' => 4, 'caIdproveedor' => 5, 'caProveedor' => 6, 'caNumpiezas' => 7, 'caPeso' => 8, 'caVolumen' => 9, 'caNumorden' => 10, 'caConfirmar' => 11, 'caLogin' => 12, 'caObservaciones' => 13, 'caFchliberacion' => 14, 'caNotaliberacion' => 15, 'caFchcreado' => 16, 'caUsucreado' => 17, 'caFchactualizado' => 18, 'caUsuactualizado' => 19, 'caFchliberado' => 20, 'caUsuliberado' => 21, 'caMensaje' => 22, 'caContinuacion' => 23, 'caContinuacionDest' => 24, 'caIdbodega' => 25, ),
		BasePeer::TYPE_COLNAME => array (self::OID => 0, self::CA_REFERENCIA => 1, self::CA_IDCLIENTE => 2, self::CA_HBLS => 3, self::CA_IDREPORTE => 4, self::CA_IDPROVEEDOR => 5, self::CA_PROVEEDOR => 6, self::CA_NUMPIEZAS => 7, self::CA_PESO => 8, self::CA_VOLUMEN => 9, self::CA_NUMORDEN => 10, self::CA_CONFIRMAR => 11, self::CA_LOGIN => 12, self::CA_OBSERVACIONES => 13, self::CA_FCHLIBERACION => 14, self::CA_NOTALIBERACION => 15, self::CA_FCHCREADO => 16, self::CA_USUCREADO => 17, self::CA_FCHACTUALIZADO => 18, self::CA_USUACTUALIZADO => 19, self::CA_FCHLIBERADO => 20, self::CA_USULIBERADO => 21, self::CA_MENSAJE => 22, self::CA_CONTINUACION => 23, self::CA_CONTINUACION_DEST => 24, self::CA_IDBODEGA => 25, ),
		BasePeer::TYPE_FIELDNAME => array ('oid' => 0, 'ca_referencia' => 1, 'ca_idcliente' => 2, 'ca_hbls' => 3, 'ca_idreporte' => 4, 'ca_idproveedor' => 5, 'ca_proveedor' => 6, 'ca_numpiezas' => 7, 'ca_peso' => 8, 'ca_volumen' => 9, 'ca_numorden' => 10, 'ca_confirmar' => 11, 'ca_login' => 12, 'ca_observaciones' => 13, 'ca_fchliberacion' => 14, 'ca_notaliberacion' => 15, 'ca_fchcreado' => 16, 'ca_usucreado' => 17, 'ca_fchactualizado' => 18, 'ca_usuactualizado' => 19, 'ca_fchliberado' => 20, 'ca_usuliberado' => 21, 'ca_mensaje' => 22, 'ca_continuacion' => 23, 'ca_continuacion_dest' => 24, 'ca_idbodega' => 25, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, )
	);

	/**
	 * Get a (singleton) instance of the MapBuilder for this peer class.
	 * @return     MapBuilder The map builder for this peer
	 */
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new InoClientesSeaMapBuilder();
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
	 * @param      string $column The column name for current table. (i.e. InoClientesSeaPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(InoClientesSeaPeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(InoClientesSeaPeer::OID);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_REFERENCIA);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_IDCLIENTE);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_HBLS);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_IDREPORTE);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_IDPROVEEDOR);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_PROVEEDOR);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_NUMPIEZAS);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_PESO);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_VOLUMEN);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_NUMORDEN);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_CONFIRMAR);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_LOGIN);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_OBSERVACIONES);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_FCHLIBERACION);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_NOTALIBERACION);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_USUCREADO);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_USUACTUALIZADO);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_FCHLIBERADO);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_USULIBERADO);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_MENSAJE);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_CONTINUACION);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_CONTINUACION_DEST);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_IDBODEGA);

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
		$criteria->setPrimaryTableName(InoClientesSeaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoClientesSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(InoClientesSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return     InoClientesSea
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = InoClientesSeaPeer::doSelect($critcopy, $con);
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
		return InoClientesSeaPeer::populateObjects(InoClientesSeaPeer::doSelectStmt($criteria, $con));
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
			$con = Propel::getConnection(InoClientesSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			InoClientesSeaPeer::addSelectColumns($criteria);
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
	 * @param      InoClientesSea $value A InoClientesSea object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool(InoClientesSea $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getCaReferencia(), (string) $obj->getCaIdcliente(), (string) $obj->getCaHbls()));
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
	 * @param      mixed $value A InoClientesSea object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof InoClientesSea) {
				$key = serialize(array((string) $value->getCaReferencia(), (string) $value->getCaIdcliente(), (string) $value->getCaHbls()));
			} elseif (is_array($value) && count($value) === 3) {
				// assume we've been passed a primary key
				$key = serialize(array((string) $value[0], (string) $value[1], (string) $value[2]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or InoClientesSea object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	 * @return     InoClientesSea Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
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
		if ($row[$startcol + 1] === null && $row[$startcol + 2] === null && $row[$startcol + 3] === null) {
			return null;
		}
		return serialize(array((string) $row[$startcol + 1], (string) $row[$startcol + 2], (string) $row[$startcol + 3]));
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
		$cls = InoClientesSeaPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = InoClientesSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = InoClientesSeaPeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				InoClientesSeaPeer::addInstanceToPool($obj, $key);
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
		$criteria->setPrimaryTableName(InoClientesSeaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoClientesSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoClientesSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(InoClientesSeaPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);

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
	 * Returns the number of rows matching criteria, joining the related Tercero table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinTercero(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(InoClientesSeaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoClientesSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoClientesSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(InoClientesSeaPeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);

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
		$criteria->setPrimaryTableName(InoClientesSeaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoClientesSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoClientesSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(InoClientesSeaPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);

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
		$criteria->setPrimaryTableName(InoClientesSeaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoClientesSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoClientesSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(InoClientesSeaPeer::CA_REFERENCIA,), array(InoMaestraSeaPeer::CA_REFERENCIA,), $join_behavior);

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
	 * Selects a collection of InoClientesSea objects pre-filled with their Reporte objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of InoClientesSea objects.
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

		InoClientesSeaPeer::addSelectColumns($c);
		$startcol = (InoClientesSeaPeer::NUM_COLUMNS - InoClientesSeaPeer::NUM_LAZY_LOAD_COLUMNS);
		ReportePeer::addSelectColumns($c);

		$c->addJoin(array(InoClientesSeaPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoClientesSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoClientesSeaPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = InoClientesSeaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoClientesSeaPeer::addInstanceToPool($obj1, $key1);
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

				// Add the $obj1 (InoClientesSea) to $obj2 (Reporte)
				$obj2->addInoClientesSea($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of InoClientesSea objects pre-filled with their Tercero objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of InoClientesSea objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinTercero(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoClientesSeaPeer::addSelectColumns($c);
		$startcol = (InoClientesSeaPeer::NUM_COLUMNS - InoClientesSeaPeer::NUM_LAZY_LOAD_COLUMNS);
		TerceroPeer::addSelectColumns($c);

		$c->addJoin(array(InoClientesSeaPeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoClientesSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoClientesSeaPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = InoClientesSeaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoClientesSeaPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = TerceroPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = TerceroPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = TerceroPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					TerceroPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (InoClientesSea) to $obj2 (Tercero)
				$obj2->addInoClientesSea($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of InoClientesSea objects pre-filled with their Cliente objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of InoClientesSea objects.
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

		InoClientesSeaPeer::addSelectColumns($c);
		$startcol = (InoClientesSeaPeer::NUM_COLUMNS - InoClientesSeaPeer::NUM_LAZY_LOAD_COLUMNS);
		ClientePeer::addSelectColumns($c);

		$c->addJoin(array(InoClientesSeaPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoClientesSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoClientesSeaPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = InoClientesSeaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoClientesSeaPeer::addInstanceToPool($obj1, $key1);
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

				// Add the $obj1 (InoClientesSea) to $obj2 (Cliente)
				$obj2->addInoClientesSea($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of InoClientesSea objects pre-filled with their InoMaestraSea objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of InoClientesSea objects.
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

		InoClientesSeaPeer::addSelectColumns($c);
		$startcol = (InoClientesSeaPeer::NUM_COLUMNS - InoClientesSeaPeer::NUM_LAZY_LOAD_COLUMNS);
		InoMaestraSeaPeer::addSelectColumns($c);

		$c->addJoin(array(InoClientesSeaPeer::CA_REFERENCIA,), array(InoMaestraSeaPeer::CA_REFERENCIA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoClientesSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoClientesSeaPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = InoClientesSeaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoClientesSeaPeer::addInstanceToPool($obj1, $key1);
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

				// Add the $obj1 (InoClientesSea) to $obj2 (InoMaestraSea)
				$obj2->addInoClientesSea($obj1);

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
		$criteria->setPrimaryTableName(InoClientesSeaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoClientesSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoClientesSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(InoClientesSeaPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
		$criteria->addJoin(array(InoClientesSeaPeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
		$criteria->addJoin(array(InoClientesSeaPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);
		$criteria->addJoin(array(InoClientesSeaPeer::CA_REFERENCIA,), array(InoMaestraSeaPeer::CA_REFERENCIA,), $join_behavior);
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
	 * Selects a collection of InoClientesSea objects pre-filled with all related objects.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of InoClientesSea objects.
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

		InoClientesSeaPeer::addSelectColumns($c);
		$startcol2 = (InoClientesSeaPeer::NUM_COLUMNS - InoClientesSeaPeer::NUM_LAZY_LOAD_COLUMNS);

		ReportePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS);

		TerceroPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (TerceroPeer::NUM_COLUMNS - TerceroPeer::NUM_LAZY_LOAD_COLUMNS);

		ClientePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (ClientePeer::NUM_COLUMNS - ClientePeer::NUM_LAZY_LOAD_COLUMNS);

		InoMaestraSeaPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + (InoMaestraSeaPeer::NUM_COLUMNS - InoMaestraSeaPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(InoClientesSeaPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
		$c->addJoin(array(InoClientesSeaPeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
		$c->addJoin(array(InoClientesSeaPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);
		$c->addJoin(array(InoClientesSeaPeer::CA_REFERENCIA,), array(InoMaestraSeaPeer::CA_REFERENCIA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoClientesSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoClientesSeaPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = InoClientesSeaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoClientesSeaPeer::addInstanceToPool($obj1, $key1);
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

				// Add the $obj1 (InoClientesSea) to the collection in $obj2 (Reporte)
				$obj2->addInoClientesSea($obj1);
			} // if joined row not null

			// Add objects for joined Tercero rows

			$key3 = TerceroPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = TerceroPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = TerceroPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					TerceroPeer::addInstanceToPool($obj3, $key3);
				} // if obj3 loaded

				// Add the $obj1 (InoClientesSea) to the collection in $obj3 (Tercero)
				$obj3->addInoClientesSea($obj1);
			} // if joined row not null

			// Add objects for joined Cliente rows

			$key4 = ClientePeer::getPrimaryKeyHashFromRow($row, $startcol4);
			if ($key4 !== null) {
				$obj4 = ClientePeer::getInstanceFromPool($key4);
				if (!$obj4) {

					$omClass = ClientePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					ClientePeer::addInstanceToPool($obj4, $key4);
				} // if obj4 loaded

				// Add the $obj1 (InoClientesSea) to the collection in $obj4 (Cliente)
				$obj4->addInoClientesSea($obj1);
			} // if joined row not null

			// Add objects for joined InoMaestraSea rows

			$key5 = InoMaestraSeaPeer::getPrimaryKeyHashFromRow($row, $startcol5);
			if ($key5 !== null) {
				$obj5 = InoMaestraSeaPeer::getInstanceFromPool($key5);
				if (!$obj5) {

					$omClass = InoMaestraSeaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					InoMaestraSeaPeer::addInstanceToPool($obj5, $key5);
				} // if obj5 loaded

				// Add the $obj1 (InoClientesSea) to the collection in $obj5 (InoMaestraSea)
				$obj5->addInoClientesSea($obj1);
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
			InoClientesSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoClientesSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(InoClientesSeaPeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
				$criteria->addJoin(array(InoClientesSeaPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);
				$criteria->addJoin(array(InoClientesSeaPeer::CA_REFERENCIA,), array(InoMaestraSeaPeer::CA_REFERENCIA,), $join_behavior);
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
	 * Returns the number of rows matching criteria, joining the related Tercero table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptTercero(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoClientesSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoClientesSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(InoClientesSeaPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
				$criteria->addJoin(array(InoClientesSeaPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);
				$criteria->addJoin(array(InoClientesSeaPeer::CA_REFERENCIA,), array(InoMaestraSeaPeer::CA_REFERENCIA,), $join_behavior);
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
			InoClientesSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoClientesSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(InoClientesSeaPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
				$criteria->addJoin(array(InoClientesSeaPeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
				$criteria->addJoin(array(InoClientesSeaPeer::CA_REFERENCIA,), array(InoMaestraSeaPeer::CA_REFERENCIA,), $join_behavior);
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
			InoClientesSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoClientesSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(InoClientesSeaPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
				$criteria->addJoin(array(InoClientesSeaPeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
				$criteria->addJoin(array(InoClientesSeaPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);
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
	 * Selects a collection of InoClientesSea objects pre-filled with all related objects except Reporte.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of InoClientesSea objects.
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

		InoClientesSeaPeer::addSelectColumns($c);
		$startcol2 = (InoClientesSeaPeer::NUM_COLUMNS - InoClientesSeaPeer::NUM_LAZY_LOAD_COLUMNS);

		TerceroPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (TerceroPeer::NUM_COLUMNS - TerceroPeer::NUM_LAZY_LOAD_COLUMNS);

		ClientePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (ClientePeer::NUM_COLUMNS - ClientePeer::NUM_LAZY_LOAD_COLUMNS);

		InoMaestraSeaPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (InoMaestraSeaPeer::NUM_COLUMNS - InoMaestraSeaPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(InoClientesSeaPeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
				$c->addJoin(array(InoClientesSeaPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);
				$c->addJoin(array(InoClientesSeaPeer::CA_REFERENCIA,), array(InoMaestraSeaPeer::CA_REFERENCIA,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoClientesSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoClientesSeaPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = InoClientesSeaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoClientesSeaPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined Tercero rows

				$key2 = TerceroPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = TerceroPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = TerceroPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					TerceroPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (InoClientesSea) to the collection in $obj2 (Tercero)
				$obj2->addInoClientesSea($obj1);

			} // if joined row is not null

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
				} // if $obj3 already loaded

				// Add the $obj1 (InoClientesSea) to the collection in $obj3 (Cliente)
				$obj3->addInoClientesSea($obj1);

			} // if joined row is not null

				// Add objects for joined InoMaestraSea rows

				$key4 = InoMaestraSeaPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = InoMaestraSeaPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = InoMaestraSeaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					InoMaestraSeaPeer::addInstanceToPool($obj4, $key4);
				} // if $obj4 already loaded

				// Add the $obj1 (InoClientesSea) to the collection in $obj4 (InoMaestraSea)
				$obj4->addInoClientesSea($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of InoClientesSea objects pre-filled with all related objects except Tercero.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of InoClientesSea objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptTercero(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoClientesSeaPeer::addSelectColumns($c);
		$startcol2 = (InoClientesSeaPeer::NUM_COLUMNS - InoClientesSeaPeer::NUM_LAZY_LOAD_COLUMNS);

		ReportePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS);

		ClientePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (ClientePeer::NUM_COLUMNS - ClientePeer::NUM_LAZY_LOAD_COLUMNS);

		InoMaestraSeaPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (InoMaestraSeaPeer::NUM_COLUMNS - InoMaestraSeaPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(InoClientesSeaPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
				$c->addJoin(array(InoClientesSeaPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);
				$c->addJoin(array(InoClientesSeaPeer::CA_REFERENCIA,), array(InoMaestraSeaPeer::CA_REFERENCIA,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoClientesSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoClientesSeaPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = InoClientesSeaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoClientesSeaPeer::addInstanceToPool($obj1, $key1);
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

				// Add the $obj1 (InoClientesSea) to the collection in $obj2 (Reporte)
				$obj2->addInoClientesSea($obj1);

			} // if joined row is not null

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
				} // if $obj3 already loaded

				// Add the $obj1 (InoClientesSea) to the collection in $obj3 (Cliente)
				$obj3->addInoClientesSea($obj1);

			} // if joined row is not null

				// Add objects for joined InoMaestraSea rows

				$key4 = InoMaestraSeaPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = InoMaestraSeaPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = InoMaestraSeaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					InoMaestraSeaPeer::addInstanceToPool($obj4, $key4);
				} // if $obj4 already loaded

				// Add the $obj1 (InoClientesSea) to the collection in $obj4 (InoMaestraSea)
				$obj4->addInoClientesSea($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of InoClientesSea objects pre-filled with all related objects except Cliente.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of InoClientesSea objects.
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

		InoClientesSeaPeer::addSelectColumns($c);
		$startcol2 = (InoClientesSeaPeer::NUM_COLUMNS - InoClientesSeaPeer::NUM_LAZY_LOAD_COLUMNS);

		ReportePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS);

		TerceroPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (TerceroPeer::NUM_COLUMNS - TerceroPeer::NUM_LAZY_LOAD_COLUMNS);

		InoMaestraSeaPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (InoMaestraSeaPeer::NUM_COLUMNS - InoMaestraSeaPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(InoClientesSeaPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
				$c->addJoin(array(InoClientesSeaPeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
				$c->addJoin(array(InoClientesSeaPeer::CA_REFERENCIA,), array(InoMaestraSeaPeer::CA_REFERENCIA,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoClientesSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoClientesSeaPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = InoClientesSeaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoClientesSeaPeer::addInstanceToPool($obj1, $key1);
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

				// Add the $obj1 (InoClientesSea) to the collection in $obj2 (Reporte)
				$obj2->addInoClientesSea($obj1);

			} // if joined row is not null

				// Add objects for joined Tercero rows

				$key3 = TerceroPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = TerceroPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = TerceroPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					TerceroPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (InoClientesSea) to the collection in $obj3 (Tercero)
				$obj3->addInoClientesSea($obj1);

			} // if joined row is not null

				// Add objects for joined InoMaestraSea rows

				$key4 = InoMaestraSeaPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = InoMaestraSeaPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = InoMaestraSeaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					InoMaestraSeaPeer::addInstanceToPool($obj4, $key4);
				} // if $obj4 already loaded

				// Add the $obj1 (InoClientesSea) to the collection in $obj4 (InoMaestraSea)
				$obj4->addInoClientesSea($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of InoClientesSea objects pre-filled with all related objects except InoMaestraSea.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of InoClientesSea objects.
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

		InoClientesSeaPeer::addSelectColumns($c);
		$startcol2 = (InoClientesSeaPeer::NUM_COLUMNS - InoClientesSeaPeer::NUM_LAZY_LOAD_COLUMNS);

		ReportePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS);

		TerceroPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (TerceroPeer::NUM_COLUMNS - TerceroPeer::NUM_LAZY_LOAD_COLUMNS);

		ClientePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (ClientePeer::NUM_COLUMNS - ClientePeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(InoClientesSeaPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
				$c->addJoin(array(InoClientesSeaPeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
				$c->addJoin(array(InoClientesSeaPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoClientesSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoClientesSeaPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = InoClientesSeaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoClientesSeaPeer::addInstanceToPool($obj1, $key1);
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

				// Add the $obj1 (InoClientesSea) to the collection in $obj2 (Reporte)
				$obj2->addInoClientesSea($obj1);

			} // if joined row is not null

				// Add objects for joined Tercero rows

				$key3 = TerceroPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = TerceroPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = TerceroPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					TerceroPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (InoClientesSea) to the collection in $obj3 (Tercero)
				$obj3->addInoClientesSea($obj1);

			} // if joined row is not null

				// Add objects for joined Cliente rows

				$key4 = ClientePeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = ClientePeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = ClientePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					ClientePeer::addInstanceToPool($obj4, $key4);
				} // if $obj4 already loaded

				// Add the $obj1 (InoClientesSea) to the collection in $obj4 (Cliente)
				$obj4->addInoClientesSea($obj1);

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
		return InoClientesSeaPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a InoClientesSea or Criteria object.
	 *
	 * @param      mixed $values Criteria or InoClientesSea object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(InoClientesSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from InoClientesSea object
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
	 * Method perform an UPDATE on the database, given a InoClientesSea or Criteria object.
	 *
	 * @param      mixed $values Criteria or InoClientesSea object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(InoClientesSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(InoClientesSeaPeer::CA_REFERENCIA);
			$selectCriteria->add(InoClientesSeaPeer::CA_REFERENCIA, $criteria->remove(InoClientesSeaPeer::CA_REFERENCIA), $comparison);

			$comparison = $criteria->getComparison(InoClientesSeaPeer::CA_IDCLIENTE);
			$selectCriteria->add(InoClientesSeaPeer::CA_IDCLIENTE, $criteria->remove(InoClientesSeaPeer::CA_IDCLIENTE), $comparison);

			$comparison = $criteria->getComparison(InoClientesSeaPeer::CA_HBLS);
			$selectCriteria->add(InoClientesSeaPeer::CA_HBLS, $criteria->remove(InoClientesSeaPeer::CA_HBLS), $comparison);

		} else { // $values is InoClientesSea object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the tb_inoclientes_sea table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(InoClientesSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(InoClientesSeaPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a InoClientesSea or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or InoClientesSea object or primary key or array of primary keys
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
			$con = Propel::getConnection(InoClientesSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			InoClientesSeaPeer::clearInstancePool();

			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof InoClientesSea) {
			// invalidate the cache for this single object
			InoClientesSeaPeer::removeInstanceFromPool($values);
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

				$criterion = $criteria->getNewCriterion(InoClientesSeaPeer::CA_REFERENCIA, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(InoClientesSeaPeer::CA_IDCLIENTE, $value[1]));
				$criterion->addAnd($criteria->getNewCriterion(InoClientesSeaPeer::CA_HBLS, $value[2]));
				$criteria->addOr($criterion);

				// we can invalidate the cache for this single PK
				InoClientesSeaPeer::removeInstanceFromPool($value);
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
	 * Validates all modified columns of given InoClientesSea object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      InoClientesSea $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(InoClientesSea $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(InoClientesSeaPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(InoClientesSeaPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(InoClientesSeaPeer::DATABASE_NAME, InoClientesSeaPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = InoClientesSeaPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	/**
	 * Retrieve object using using composite pkey values.
	 * @param      string $ca_referencia
	   @param      int $ca_idcliente
	   @param      string $ca_hbls
	   
	 * @param      PropelPDO $con
	 * @return     InoClientesSea
	 */
	public static function retrieveByPK($ca_referencia, $ca_idcliente, $ca_hbls, PropelPDO $con = null) {
		$key = serialize(array((string) $ca_referencia, (string) $ca_idcliente, (string) $ca_hbls));
 		if (null !== ($obj = InoClientesSeaPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(InoClientesSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(InoClientesSeaPeer::DATABASE_NAME);
		$criteria->add(InoClientesSeaPeer::CA_REFERENCIA, $ca_referencia);
		$criteria->add(InoClientesSeaPeer::CA_IDCLIENTE, $ca_idcliente);
		$criteria->add(InoClientesSeaPeer::CA_HBLS, $ca_hbls);
		$v = InoClientesSeaPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} // BaseInoClientesSeaPeer

// This is the static code needed to register the MapBuilder for this table with the main Propel class.
//
// NOTE: This static code cannot call methods on the InoClientesSeaPeer class, because it is not defined yet.
// If you need to use overridden methods, you can add this code to the bottom of the InoClientesSeaPeer class:
//
// Propel::getDatabaseMap(InoClientesSeaPeer::DATABASE_NAME)->addTableBuilder(InoClientesSeaPeer::TABLE_NAME, InoClientesSeaPeer::getMapBuilder());
//
// Doing so will effectively overwrite the registration below.

Propel::getDatabaseMap(BaseInoClientesSeaPeer::DATABASE_NAME)->addTableBuilder(BaseInoClientesSeaPeer::TABLE_NAME, BaseInoClientesSeaPeer::getMapBuilder());

