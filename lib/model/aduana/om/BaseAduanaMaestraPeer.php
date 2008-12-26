<?php

/**
 * Base static class for performing query and update operations on the 'tb_brk_maestra' table.
 *
 * 
 *
 * @package    lib.model.aduana.om
 */
abstract class BaseAduanaMaestraPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'tb_brk_maestra';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.aduana.AduanaMaestra';

	/** The total number of columns. */
	const NUM_COLUMNS = 27;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** the column name for the CA_FCHREFERENCIA field */
	const CA_FCHREFERENCIA = 'tb_brk_maestra.CA_FCHREFERENCIA';

	/** the column name for the CA_REFERENCIA field */
	const CA_REFERENCIA = 'tb_brk_maestra.CA_REFERENCIA';

	/** the column name for the CA_ORIGEN field */
	const CA_ORIGEN = 'tb_brk_maestra.CA_ORIGEN';

	/** the column name for the CA_DESTINO field */
	const CA_DESTINO = 'tb_brk_maestra.CA_DESTINO';

	/** the column name for the CA_IDCLIENTE field */
	const CA_IDCLIENTE = 'tb_brk_maestra.CA_IDCLIENTE';

	/** the column name for the CA_VENDEDOR field */
	const CA_VENDEDOR = 'tb_brk_maestra.CA_VENDEDOR';

	/** the column name for the CA_COORDINADOR field */
	const CA_COORDINADOR = 'tb_brk_maestra.CA_COORDINADOR';

	/** the column name for the CA_PROVEEDOR field */
	const CA_PROVEEDOR = 'tb_brk_maestra.CA_PROVEEDOR';

	/** the column name for the CA_PEDIDO field */
	const CA_PEDIDO = 'tb_brk_maestra.CA_PEDIDO';

	/** the column name for the CA_PIEZAS field */
	const CA_PIEZAS = 'tb_brk_maestra.CA_PIEZAS';

	/** the column name for the CA_PESO field */
	const CA_PESO = 'tb_brk_maestra.CA_PESO';

	/** the column name for the CA_MERCANCIA field */
	const CA_MERCANCIA = 'tb_brk_maestra.CA_MERCANCIA';

	/** the column name for the CA_DEPOSITO field */
	const CA_DEPOSITO = 'tb_brk_maestra.CA_DEPOSITO';

	/** the column name for the CA_FCHARRIBO field */
	const CA_FCHARRIBO = 'tb_brk_maestra.CA_FCHARRIBO';

	/** the column name for the CA_MODALIDAD field */
	const CA_MODALIDAD = 'tb_brk_maestra.CA_MODALIDAD';

	/** the column name for the CA_FCHCREADO field */
	const CA_FCHCREADO = 'tb_brk_maestra.CA_FCHCREADO';

	/** the column name for the CA_USUCREADO field */
	const CA_USUCREADO = 'tb_brk_maestra.CA_USUCREADO';

	/** the column name for the CA_FCHACTUALIZADO field */
	const CA_FCHACTUALIZADO = 'tb_brk_maestra.CA_FCHACTUALIZADO';

	/** the column name for the CA_USUACTUALIZADO field */
	const CA_USUACTUALIZADO = 'tb_brk_maestra.CA_USUACTUALIZADO';

	/** the column name for the CA_FCHLIQUIDADO field */
	const CA_FCHLIQUIDADO = 'tb_brk_maestra.CA_FCHLIQUIDADO';

	/** the column name for the CA_USULIQUIDADO field */
	const CA_USULIQUIDADO = 'tb_brk_maestra.CA_USULIQUIDADO';

	/** the column name for the CA_FCHCERRADO field */
	const CA_FCHCERRADO = 'tb_brk_maestra.CA_FCHCERRADO';

	/** the column name for the CA_USUCERRADO field */
	const CA_USUCERRADO = 'tb_brk_maestra.CA_USUCERRADO';

	/** the column name for the CA_NOMBRECONTACTO field */
	const CA_NOMBRECONTACTO = 'tb_brk_maestra.CA_NOMBRECONTACTO';

	/** the column name for the CA_EMAIL field */
	const CA_EMAIL = 'tb_brk_maestra.CA_EMAIL';

	/** the column name for the CA_ANALISTA field */
	const CA_ANALISTA = 'tb_brk_maestra.CA_ANALISTA';

	/** the column name for the CA_TRACKINGCODE field */
	const CA_TRACKINGCODE = 'tb_brk_maestra.CA_TRACKINGCODE';

	/**
	 * An identiy map to hold any loaded instances of AduanaMaestra objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array AduanaMaestra[]
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
		BasePeer::TYPE_PHPNAME => array ('CaFchreferencia', 'CaReferencia', 'CaOrigen', 'CaDestino', 'CaIdcliente', 'CaVendedor', 'CaCoordinador', 'CaProveedor', 'CaPedido', 'CaPiezas', 'CaPeso', 'CaMercancia', 'CaDeposito', 'CaFcharribo', 'CaModalidad', 'CaFchcreado', 'CaUsucreado', 'CaFchactualizado', 'CaUsuactualizado', 'CaFchliquidado', 'CaUsuliquidado', 'CaFchcerrado', 'CaUsucerrado', 'CaNombrecontacto', 'CaEmail', 'CaAnalista', 'CaTrackingcode', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caFchreferencia', 'caReferencia', 'caOrigen', 'caDestino', 'caIdcliente', 'caVendedor', 'caCoordinador', 'caProveedor', 'caPedido', 'caPiezas', 'caPeso', 'caMercancia', 'caDeposito', 'caFcharribo', 'caModalidad', 'caFchcreado', 'caUsucreado', 'caFchactualizado', 'caUsuactualizado', 'caFchliquidado', 'caUsuliquidado', 'caFchcerrado', 'caUsucerrado', 'caNombrecontacto', 'caEmail', 'caAnalista', 'caTrackingcode', ),
		BasePeer::TYPE_COLNAME => array (self::CA_FCHREFERENCIA, self::CA_REFERENCIA, self::CA_ORIGEN, self::CA_DESTINO, self::CA_IDCLIENTE, self::CA_VENDEDOR, self::CA_COORDINADOR, self::CA_PROVEEDOR, self::CA_PEDIDO, self::CA_PIEZAS, self::CA_PESO, self::CA_MERCANCIA, self::CA_DEPOSITO, self::CA_FCHARRIBO, self::CA_MODALIDAD, self::CA_FCHCREADO, self::CA_USUCREADO, self::CA_FCHACTUALIZADO, self::CA_USUACTUALIZADO, self::CA_FCHLIQUIDADO, self::CA_USULIQUIDADO, self::CA_FCHCERRADO, self::CA_USUCERRADO, self::CA_NOMBRECONTACTO, self::CA_EMAIL, self::CA_ANALISTA, self::CA_TRACKINGCODE, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_fchreferencia', 'ca_referencia', 'ca_origen', 'ca_destino', 'ca_idcliente', 'ca_vendedor', 'ca_coordinador', 'ca_proveedor', 'ca_pedido', 'ca_piezas', 'ca_peso', 'ca_mercancia', 'ca_deposito', 'ca_fcharribo', 'ca_modalidad', 'ca_fchcreado', 'ca_usucreado', 'ca_fchactualizado', 'ca_usuactualizado', 'ca_fchliquidado', 'ca_usuliquidado', 'ca_fchcerrado', 'ca_usucerrado', 'ca_nombrecontacto', 'ca_email', 'ca_analista', 'ca_trackingcode', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaFchreferencia' => 0, 'CaReferencia' => 1, 'CaOrigen' => 2, 'CaDestino' => 3, 'CaIdcliente' => 4, 'CaVendedor' => 5, 'CaCoordinador' => 6, 'CaProveedor' => 7, 'CaPedido' => 8, 'CaPiezas' => 9, 'CaPeso' => 10, 'CaMercancia' => 11, 'CaDeposito' => 12, 'CaFcharribo' => 13, 'CaModalidad' => 14, 'CaFchcreado' => 15, 'CaUsucreado' => 16, 'CaFchactualizado' => 17, 'CaUsuactualizado' => 18, 'CaFchliquidado' => 19, 'CaUsuliquidado' => 20, 'CaFchcerrado' => 21, 'CaUsucerrado' => 22, 'CaNombrecontacto' => 23, 'CaEmail' => 24, 'CaAnalista' => 25, 'CaTrackingcode' => 26, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caFchreferencia' => 0, 'caReferencia' => 1, 'caOrigen' => 2, 'caDestino' => 3, 'caIdcliente' => 4, 'caVendedor' => 5, 'caCoordinador' => 6, 'caProveedor' => 7, 'caPedido' => 8, 'caPiezas' => 9, 'caPeso' => 10, 'caMercancia' => 11, 'caDeposito' => 12, 'caFcharribo' => 13, 'caModalidad' => 14, 'caFchcreado' => 15, 'caUsucreado' => 16, 'caFchactualizado' => 17, 'caUsuactualizado' => 18, 'caFchliquidado' => 19, 'caUsuliquidado' => 20, 'caFchcerrado' => 21, 'caUsucerrado' => 22, 'caNombrecontacto' => 23, 'caEmail' => 24, 'caAnalista' => 25, 'caTrackingcode' => 26, ),
		BasePeer::TYPE_COLNAME => array (self::CA_FCHREFERENCIA => 0, self::CA_REFERENCIA => 1, self::CA_ORIGEN => 2, self::CA_DESTINO => 3, self::CA_IDCLIENTE => 4, self::CA_VENDEDOR => 5, self::CA_COORDINADOR => 6, self::CA_PROVEEDOR => 7, self::CA_PEDIDO => 8, self::CA_PIEZAS => 9, self::CA_PESO => 10, self::CA_MERCANCIA => 11, self::CA_DEPOSITO => 12, self::CA_FCHARRIBO => 13, self::CA_MODALIDAD => 14, self::CA_FCHCREADO => 15, self::CA_USUCREADO => 16, self::CA_FCHACTUALIZADO => 17, self::CA_USUACTUALIZADO => 18, self::CA_FCHLIQUIDADO => 19, self::CA_USULIQUIDADO => 20, self::CA_FCHCERRADO => 21, self::CA_USUCERRADO => 22, self::CA_NOMBRECONTACTO => 23, self::CA_EMAIL => 24, self::CA_ANALISTA => 25, self::CA_TRACKINGCODE => 26, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_fchreferencia' => 0, 'ca_referencia' => 1, 'ca_origen' => 2, 'ca_destino' => 3, 'ca_idcliente' => 4, 'ca_vendedor' => 5, 'ca_coordinador' => 6, 'ca_proveedor' => 7, 'ca_pedido' => 8, 'ca_piezas' => 9, 'ca_peso' => 10, 'ca_mercancia' => 11, 'ca_deposito' => 12, 'ca_fcharribo' => 13, 'ca_modalidad' => 14, 'ca_fchcreado' => 15, 'ca_usucreado' => 16, 'ca_fchactualizado' => 17, 'ca_usuactualizado' => 18, 'ca_fchliquidado' => 19, 'ca_usuliquidado' => 20, 'ca_fchcerrado' => 21, 'ca_usucerrado' => 22, 'ca_nombrecontacto' => 23, 'ca_email' => 24, 'ca_analista' => 25, 'ca_trackingcode' => 26, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, )
	);

	/**
	 * Get a (singleton) instance of the MapBuilder for this peer class.
	 * @return     MapBuilder The map builder for this peer
	 */
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new AduanaMaestraMapBuilder();
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
	 * @param      string $column The column name for current table. (i.e. AduanaMaestraPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(AduanaMaestraPeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_FCHREFERENCIA);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_REFERENCIA);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_ORIGEN);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_DESTINO);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_IDCLIENTE);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_VENDEDOR);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_COORDINADOR);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_PROVEEDOR);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_PEDIDO);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_PIEZAS);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_PESO);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_MERCANCIA);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_DEPOSITO);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_FCHARRIBO);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_MODALIDAD);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_USUCREADO);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_USUACTUALIZADO);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_FCHLIQUIDADO);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_USULIQUIDADO);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_FCHCERRADO);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_USUCERRADO);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_NOMBRECONTACTO);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_EMAIL);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_ANALISTA);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_TRACKINGCODE);

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
		$criteria->setPrimaryTableName(AduanaMaestraPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AduanaMaestraPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(AduanaMaestraPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return     AduanaMaestra
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = AduanaMaestraPeer::doSelect($critcopy, $con);
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
		return AduanaMaestraPeer::populateObjects(AduanaMaestraPeer::doSelectStmt($criteria, $con));
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
			$con = Propel::getConnection(AduanaMaestraPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			AduanaMaestraPeer::addSelectColumns($criteria);
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
	 * @param      AduanaMaestra $value A AduanaMaestra object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool(AduanaMaestra $obj, $key = null)
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
	 * @param      mixed $value A AduanaMaestra object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof AduanaMaestra) {
				$key = (string) $value->getCaReferencia();
			} elseif (is_scalar($value)) {
				// assume we've been passed a primary key
				$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or AduanaMaestra object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	 * @return     AduanaMaestra Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
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
		$cls = AduanaMaestraPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = AduanaMaestraPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = AduanaMaestraPeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				AduanaMaestraPeer::addInstanceToPool($obj, $key);
			} // if key exists
		}
		$stmt->closeCursor();
		return $results;
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
		$criteria->setPrimaryTableName(AduanaMaestraPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AduanaMaestraPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(AduanaMaestraPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(AduanaMaestraPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);

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
	 * Selects a collection of AduanaMaestra objects pre-filled with their Cliente objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of AduanaMaestra objects.
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

		AduanaMaestraPeer::addSelectColumns($c);
		$startcol = (AduanaMaestraPeer::NUM_COLUMNS - AduanaMaestraPeer::NUM_LAZY_LOAD_COLUMNS);
		ClientePeer::addSelectColumns($c);

		$c->addJoin(array(AduanaMaestraPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = AduanaMaestraPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = AduanaMaestraPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = AduanaMaestraPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				AduanaMaestraPeer::addInstanceToPool($obj1, $key1);
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

				// Add the $obj1 (AduanaMaestra) to $obj2 (Cliente)
				$obj2->addAduanaMaestra($obj1);

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
		$criteria->setPrimaryTableName(AduanaMaestraPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AduanaMaestraPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(AduanaMaestraPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(AduanaMaestraPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);
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
	 * Selects a collection of AduanaMaestra objects pre-filled with all related objects.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of AduanaMaestra objects.
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

		AduanaMaestraPeer::addSelectColumns($c);
		$startcol2 = (AduanaMaestraPeer::NUM_COLUMNS - AduanaMaestraPeer::NUM_LAZY_LOAD_COLUMNS);

		ClientePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ClientePeer::NUM_COLUMNS - ClientePeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(AduanaMaestraPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = AduanaMaestraPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = AduanaMaestraPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = AduanaMaestraPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				AduanaMaestraPeer::addInstanceToPool($obj1, $key1);
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
				} // if obj2 loaded

				// Add the $obj1 (AduanaMaestra) to the collection in $obj2 (Cliente)
				$obj2->addAduanaMaestra($obj1);
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
		return AduanaMaestraPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a AduanaMaestra or Criteria object.
	 *
	 * @param      mixed $values Criteria or AduanaMaestra object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(AduanaMaestraPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from AduanaMaestra object
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
	 * Method perform an UPDATE on the database, given a AduanaMaestra or Criteria object.
	 *
	 * @param      mixed $values Criteria or AduanaMaestra object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(AduanaMaestraPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(AduanaMaestraPeer::CA_REFERENCIA);
			$selectCriteria->add(AduanaMaestraPeer::CA_REFERENCIA, $criteria->remove(AduanaMaestraPeer::CA_REFERENCIA), $comparison);

		} else { // $values is AduanaMaestra object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the tb_brk_maestra table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(AduanaMaestraPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(AduanaMaestraPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a AduanaMaestra or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or AduanaMaestra object or primary key or array of primary keys
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
			$con = Propel::getConnection(AduanaMaestraPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			AduanaMaestraPeer::clearInstancePool();

			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof AduanaMaestra) {
			// invalidate the cache for this single object
			AduanaMaestraPeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key



			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(AduanaMaestraPeer::CA_REFERENCIA, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
				// we can invalidate the cache for this single object
				AduanaMaestraPeer::removeInstanceFromPool($singleval);
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
	 * Validates all modified columns of given AduanaMaestra object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      AduanaMaestra $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(AduanaMaestra $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(AduanaMaestraPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(AduanaMaestraPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(AduanaMaestraPeer::DATABASE_NAME, AduanaMaestraPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = AduanaMaestraPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      string $pk the primary key.
	 * @param      PropelPDO $con the connection to use
	 * @return     AduanaMaestra
	 */
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = AduanaMaestraPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(AduanaMaestraPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(AduanaMaestraPeer::DATABASE_NAME);
		$criteria->add(AduanaMaestraPeer::CA_REFERENCIA, $pk);

		$v = AduanaMaestraPeer::doSelect($criteria, $con);

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
			$con = Propel::getConnection(AduanaMaestraPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(AduanaMaestraPeer::DATABASE_NAME);
			$criteria->add(AduanaMaestraPeer::CA_REFERENCIA, $pks, Criteria::IN);
			$objs = AduanaMaestraPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseAduanaMaestraPeer

// This is the static code needed to register the MapBuilder for this table with the main Propel class.
//
// NOTE: This static code cannot call methods on the AduanaMaestraPeer class, because it is not defined yet.
// If you need to use overridden methods, you can add this code to the bottom of the AduanaMaestraPeer class:
//
// Propel::getDatabaseMap(AduanaMaestraPeer::DATABASE_NAME)->addTableBuilder(AduanaMaestraPeer::TABLE_NAME, AduanaMaestraPeer::getMapBuilder());
//
// Doing so will effectively overwrite the registration below.

Propel::getDatabaseMap(BaseAduanaMaestraPeer::DATABASE_NAME)->addTableBuilder(BaseAduanaMaestraPeer::TABLE_NAME, BaseAduanaMaestraPeer::getMapBuilder());

