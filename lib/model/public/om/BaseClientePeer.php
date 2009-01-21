<?php

/**
 * Base static class for performing query and update operations on the 'tb_clientes' table.
 *
 * 
 *
 * @package    lib.model.public.om
 */
abstract class BaseClientePeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'tb_clientes';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.public.Cliente';

	/** The total number of columns. */
	const NUM_COLUMNS = 24;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** the column name for the CA_IDCLIENTE field */
	const CA_IDCLIENTE = 'tb_clientes.CA_IDCLIENTE';

	/** the column name for the CA_DIGITO field */
	const CA_DIGITO = 'tb_clientes.CA_DIGITO';

	/** the column name for the CA_COMPANIA field */
	const CA_COMPANIA = 'tb_clientes.CA_COMPANIA';

	/** the column name for the CA_PAPELLIDO field */
	const CA_PAPELLIDO = 'tb_clientes.CA_PAPELLIDO';

	/** the column name for the CA_SAPELLIDO field */
	const CA_SAPELLIDO = 'tb_clientes.CA_SAPELLIDO';

	/** the column name for the CA_NOMBRES field */
	const CA_NOMBRES = 'tb_clientes.CA_NOMBRES';

	/** the column name for the CA_SALUDO field */
	const CA_SALUDO = 'tb_clientes.CA_SALUDO';

	/** the column name for the CA_SEXO field */
	const CA_SEXO = 'tb_clientes.CA_SEXO';

	/** the column name for the CA_CUMPLEANOS field */
	const CA_CUMPLEANOS = 'tb_clientes.CA_CUMPLEANOS';

	/** the column name for the CA_OFICINA field */
	const CA_OFICINA = 'tb_clientes.CA_OFICINA';

	/** the column name for the CA_VENDEDOR field */
	const CA_VENDEDOR = 'tb_clientes.CA_VENDEDOR';

	/** the column name for the CA_EMAIL field */
	const CA_EMAIL = 'tb_clientes.CA_EMAIL';

	/** the column name for the CA_COORDINADOR field */
	const CA_COORDINADOR = 'tb_clientes.CA_COORDINADOR';

	/** the column name for the CA_DIRECCION field */
	const CA_DIRECCION = 'tb_clientes.CA_DIRECCION';

	/** the column name for the CA_LOCALIDAD field */
	const CA_LOCALIDAD = 'tb_clientes.CA_LOCALIDAD';

	/** the column name for the CA_COMPLEMENTO field */
	const CA_COMPLEMENTO = 'tb_clientes.CA_COMPLEMENTO';

	/** the column name for the CA_TELEFONOS field */
	const CA_TELEFONOS = 'tb_clientes.CA_TELEFONOS';

	/** the column name for the CA_FAX field */
	const CA_FAX = 'tb_clientes.CA_FAX';

	/** the column name for the CA_PREFERENCIAS field */
	const CA_PREFERENCIAS = 'tb_clientes.CA_PREFERENCIAS';

	/** the column name for the CA_CONFIRMAR field */
	const CA_CONFIRMAR = 'tb_clientes.CA_CONFIRMAR';

	/** the column name for the CA_IDCIUDAD field */
	const CA_IDCIUDAD = 'tb_clientes.CA_IDCIUDAD';

	/** the column name for the CA_IDGRUPO field */
	const CA_IDGRUPO = 'tb_clientes.CA_IDGRUPO';

	/** the column name for the CA_LISTACLINTON field */
	const CA_LISTACLINTON = 'tb_clientes.CA_LISTACLINTON';

	/** the column name for the CA_FCHCIRCULAR field */
	const CA_FCHCIRCULAR = 'tb_clientes.CA_FCHCIRCULAR';

	/**
	 * An identiy map to hold any loaded instances of Cliente objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array Cliente[]
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
		BasePeer::TYPE_PHPNAME => array ('CaIdcliente', 'CaDigito', 'CaCompania', 'CaPapellido', 'CaSapellido', 'CaNombres', 'CaSaludo', 'CaSexo', 'CaCumpleanos', 'CaOficina', 'CaVendedor', 'CaEmail', 'CaCoordinador', 'CaDireccion', 'CaLocalidad', 'CaComplemento', 'CaTelefonos', 'CaFax', 'CaPreferencias', 'CaConfirmar', 'CaIdciudad', 'CaIdgrupo', 'CaListaclinton', 'CaFchcircular', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdcliente', 'caDigito', 'caCompania', 'caPapellido', 'caSapellido', 'caNombres', 'caSaludo', 'caSexo', 'caCumpleanos', 'caOficina', 'caVendedor', 'caEmail', 'caCoordinador', 'caDireccion', 'caLocalidad', 'caComplemento', 'caTelefonos', 'caFax', 'caPreferencias', 'caConfirmar', 'caIdciudad', 'caIdgrupo', 'caListaclinton', 'caFchcircular', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDCLIENTE, self::CA_DIGITO, self::CA_COMPANIA, self::CA_PAPELLIDO, self::CA_SAPELLIDO, self::CA_NOMBRES, self::CA_SALUDO, self::CA_SEXO, self::CA_CUMPLEANOS, self::CA_OFICINA, self::CA_VENDEDOR, self::CA_EMAIL, self::CA_COORDINADOR, self::CA_DIRECCION, self::CA_LOCALIDAD, self::CA_COMPLEMENTO, self::CA_TELEFONOS, self::CA_FAX, self::CA_PREFERENCIAS, self::CA_CONFIRMAR, self::CA_IDCIUDAD, self::CA_IDGRUPO, self::CA_LISTACLINTON, self::CA_FCHCIRCULAR, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcliente', 'ca_digito', 'ca_compania', 'ca_papellido', 'ca_sapellido', 'ca_nombres', 'ca_saludo', 'ca_sexo', 'ca_cumpleanos', 'ca_oficina', 'ca_vendedor', 'ca_email', 'ca_coordinador', 'ca_direccion', 'ca_localidad', 'ca_complemento', 'ca_telefonos', 'ca_fax', 'ca_preferencias', 'ca_confirmar', 'ca_idciudad', 'ca_idgrupo', 'ca_listaclinton', 'ca_fchcircular', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdcliente' => 0, 'CaDigito' => 1, 'CaCompania' => 2, 'CaPapellido' => 3, 'CaSapellido' => 4, 'CaNombres' => 5, 'CaSaludo' => 6, 'CaSexo' => 7, 'CaCumpleanos' => 8, 'CaOficina' => 9, 'CaVendedor' => 10, 'CaEmail' => 11, 'CaCoordinador' => 12, 'CaDireccion' => 13, 'CaLocalidad' => 14, 'CaComplemento' => 15, 'CaTelefonos' => 16, 'CaFax' => 17, 'CaPreferencias' => 18, 'CaConfirmar' => 19, 'CaIdciudad' => 20, 'CaIdgrupo' => 21, 'CaListaclinton' => 22, 'CaFchcircular' => 23, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdcliente' => 0, 'caDigito' => 1, 'caCompania' => 2, 'caPapellido' => 3, 'caSapellido' => 4, 'caNombres' => 5, 'caSaludo' => 6, 'caSexo' => 7, 'caCumpleanos' => 8, 'caOficina' => 9, 'caVendedor' => 10, 'caEmail' => 11, 'caCoordinador' => 12, 'caDireccion' => 13, 'caLocalidad' => 14, 'caComplemento' => 15, 'caTelefonos' => 16, 'caFax' => 17, 'caPreferencias' => 18, 'caConfirmar' => 19, 'caIdciudad' => 20, 'caIdgrupo' => 21, 'caListaclinton' => 22, 'caFchcircular' => 23, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDCLIENTE => 0, self::CA_DIGITO => 1, self::CA_COMPANIA => 2, self::CA_PAPELLIDO => 3, self::CA_SAPELLIDO => 4, self::CA_NOMBRES => 5, self::CA_SALUDO => 6, self::CA_SEXO => 7, self::CA_CUMPLEANOS => 8, self::CA_OFICINA => 9, self::CA_VENDEDOR => 10, self::CA_EMAIL => 11, self::CA_COORDINADOR => 12, self::CA_DIRECCION => 13, self::CA_LOCALIDAD => 14, self::CA_COMPLEMENTO => 15, self::CA_TELEFONOS => 16, self::CA_FAX => 17, self::CA_PREFERENCIAS => 18, self::CA_CONFIRMAR => 19, self::CA_IDCIUDAD => 20, self::CA_IDGRUPO => 21, self::CA_LISTACLINTON => 22, self::CA_FCHCIRCULAR => 23, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcliente' => 0, 'ca_digito' => 1, 'ca_compania' => 2, 'ca_papellido' => 3, 'ca_sapellido' => 4, 'ca_nombres' => 5, 'ca_saludo' => 6, 'ca_sexo' => 7, 'ca_cumpleanos' => 8, 'ca_oficina' => 9, 'ca_vendedor' => 10, 'ca_email' => 11, 'ca_coordinador' => 12, 'ca_direccion' => 13, 'ca_localidad' => 14, 'ca_complemento' => 15, 'ca_telefonos' => 16, 'ca_fax' => 17, 'ca_preferencias' => 18, 'ca_confirmar' => 19, 'ca_idciudad' => 20, 'ca_idgrupo' => 21, 'ca_listaclinton' => 22, 'ca_fchcircular' => 23, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, )
	);

	/**
	 * Get a (singleton) instance of the MapBuilder for this peer class.
	 * @return     MapBuilder The map builder for this peer
	 */
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new ClienteMapBuilder();
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
	 * @param      string $column The column name for current table. (i.e. ClientePeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(ClientePeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(ClientePeer::CA_IDCLIENTE);

		$criteria->addSelectColumn(ClientePeer::CA_DIGITO);

		$criteria->addSelectColumn(ClientePeer::CA_COMPANIA);

		$criteria->addSelectColumn(ClientePeer::CA_PAPELLIDO);

		$criteria->addSelectColumn(ClientePeer::CA_SAPELLIDO);

		$criteria->addSelectColumn(ClientePeer::CA_NOMBRES);

		$criteria->addSelectColumn(ClientePeer::CA_SALUDO);

		$criteria->addSelectColumn(ClientePeer::CA_SEXO);

		$criteria->addSelectColumn(ClientePeer::CA_CUMPLEANOS);

		$criteria->addSelectColumn(ClientePeer::CA_OFICINA);

		$criteria->addSelectColumn(ClientePeer::CA_VENDEDOR);

		$criteria->addSelectColumn(ClientePeer::CA_EMAIL);

		$criteria->addSelectColumn(ClientePeer::CA_COORDINADOR);

		$criteria->addSelectColumn(ClientePeer::CA_DIRECCION);

		$criteria->addSelectColumn(ClientePeer::CA_LOCALIDAD);

		$criteria->addSelectColumn(ClientePeer::CA_COMPLEMENTO);

		$criteria->addSelectColumn(ClientePeer::CA_TELEFONOS);

		$criteria->addSelectColumn(ClientePeer::CA_FAX);

		$criteria->addSelectColumn(ClientePeer::CA_PREFERENCIAS);

		$criteria->addSelectColumn(ClientePeer::CA_CONFIRMAR);

		$criteria->addSelectColumn(ClientePeer::CA_IDCIUDAD);

		$criteria->addSelectColumn(ClientePeer::CA_IDGRUPO);

		$criteria->addSelectColumn(ClientePeer::CA_LISTACLINTON);

		$criteria->addSelectColumn(ClientePeer::CA_FCHCIRCULAR);

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
		$criteria->setPrimaryTableName(ClientePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ClientePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(ClientePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return     Cliente
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = ClientePeer::doSelect($critcopy, $con);
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
		return ClientePeer::populateObjects(ClientePeer::doSelectStmt($criteria, $con));
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
			$con = Propel::getConnection(ClientePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			ClientePeer::addSelectColumns($criteria);
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
	 * @param      Cliente $value A Cliente object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool(Cliente $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdcliente();
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
	 * @param      mixed $value A Cliente object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof Cliente) {
				$key = (string) $value->getCaIdcliente();
			} elseif (is_scalar($value)) {
				// assume we've been passed a primary key
				$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Cliente object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	 * @return     Cliente Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
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
		if ($row[$startcol + 0] === null) {
			return null;
		}
		return (string) $row[$startcol + 0];
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
		$cls = ClientePeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = ClientePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = ClientePeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				ClientePeer::addInstanceToPool($obj, $key);
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
		$criteria->setPrimaryTableName(ClientePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ClientePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ClientePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(ClientePeer::CA_IDCIUDAD,), array(CiudadPeer::CA_IDCIUDAD,), $join_behavior);

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
	 * Selects a collection of Cliente objects pre-filled with their Ciudad objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Cliente objects.
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

		ClientePeer::addSelectColumns($c);
		$startcol = (ClientePeer::NUM_COLUMNS - ClientePeer::NUM_LAZY_LOAD_COLUMNS);
		CiudadPeer::addSelectColumns($c);

		$c->addJoin(array(ClientePeer::CA_IDCIUDAD,), array(CiudadPeer::CA_IDCIUDAD,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ClientePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ClientePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = ClientePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ClientePeer::addInstanceToPool($obj1, $key1);
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

				// Add the $obj1 (Cliente) to $obj2 (Ciudad)
				$obj2->addCliente($obj1);

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
		$criteria->setPrimaryTableName(ClientePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ClientePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ClientePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(ClientePeer::CA_IDCIUDAD,), array(CiudadPeer::CA_IDCIUDAD,), $join_behavior);
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
	 * Selects a collection of Cliente objects pre-filled with all related objects.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Cliente objects.
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

		ClientePeer::addSelectColumns($c);
		$startcol2 = (ClientePeer::NUM_COLUMNS - ClientePeer::NUM_LAZY_LOAD_COLUMNS);

		CiudadPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (CiudadPeer::NUM_COLUMNS - CiudadPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(ClientePeer::CA_IDCIUDAD,), array(CiudadPeer::CA_IDCIUDAD,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ClientePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ClientePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = ClientePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ClientePeer::addInstanceToPool($obj1, $key1);
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

				// Add the $obj1 (Cliente) to the collection in $obj2 (Ciudad)
				$obj2->addCliente($obj1);
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
		return ClientePeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a Cliente or Criteria object.
	 *
	 * @param      mixed $values Criteria or Cliente object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(ClientePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from Cliente object
		}

		if ($criteria->containsKey(ClientePeer::CA_IDCLIENTE) && $criteria->keyContainsValue(ClientePeer::CA_IDCLIENTE) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.ClientePeer::CA_IDCLIENTE.')');
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
	 * Method perform an UPDATE on the database, given a Cliente or Criteria object.
	 *
	 * @param      mixed $values Criteria or Cliente object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(ClientePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(ClientePeer::CA_IDCLIENTE);
			$selectCriteria->add(ClientePeer::CA_IDCLIENTE, $criteria->remove(ClientePeer::CA_IDCLIENTE), $comparison);

		} else { // $values is Cliente object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the tb_clientes table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(ClientePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(ClientePeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a Cliente or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or Cliente object or primary key or array of primary keys
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
			$con = Propel::getConnection(ClientePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			ClientePeer::clearInstancePool();

			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof Cliente) {
			// invalidate the cache for this single object
			ClientePeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key



			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ClientePeer::CA_IDCLIENTE, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
				// we can invalidate the cache for this single object
				ClientePeer::removeInstanceFromPool($singleval);
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
	 * Validates all modified columns of given Cliente object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      Cliente $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(Cliente $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ClientePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ClientePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ClientePeer::DATABASE_NAME, ClientePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ClientePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      int $pk the primary key.
	 * @param      PropelPDO $con the connection to use
	 * @return     Cliente
	 */
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = ClientePeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(ClientePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		$criteria->add(ClientePeer::CA_IDCLIENTE, $pk);

		$v = ClientePeer::doSelect($criteria, $con);

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
			$con = Propel::getConnection(ClientePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
			$criteria->add(ClientePeer::CA_IDCLIENTE, $pks, Criteria::IN);
			$objs = ClientePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseClientePeer

// This is the static code needed to register the MapBuilder for this table with the main Propel class.
//
// NOTE: This static code cannot call methods on the ClientePeer class, because it is not defined yet.
// If you need to use overridden methods, you can add this code to the bottom of the ClientePeer class:
//
// Propel::getDatabaseMap(ClientePeer::DATABASE_NAME)->addTableBuilder(ClientePeer::TABLE_NAME, ClientePeer::getMapBuilder());
//
// Doing so will effectively overwrite the registration below.

Propel::getDatabaseMap(BaseClientePeer::DATABASE_NAME)->addTableBuilder(BaseClientePeer::TABLE_NAME, BaseClientePeer::getMapBuilder());

