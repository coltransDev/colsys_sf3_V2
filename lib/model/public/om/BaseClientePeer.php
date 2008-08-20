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
	const NUM_COLUMNS = 21;

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

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdcliente', 'CaDigito', 'CaCompania', 'CaPapellido', 'CaSapellido', 'CaNombres', 'CaSaludo', 'CaSexo', 'CaCumpleanos', 'CaOficina', 'CaVendedor', 'CaEmail', 'CaCoordinador', 'CaDireccion', 'CaLocalidad', 'CaComplemento', 'CaTelefonos', 'CaFax', 'CaPreferencias', 'CaConfirmar', 'CaIdciudad', ),
		BasePeer::TYPE_COLNAME => array (ClientePeer::CA_IDCLIENTE, ClientePeer::CA_DIGITO, ClientePeer::CA_COMPANIA, ClientePeer::CA_PAPELLIDO, ClientePeer::CA_SAPELLIDO, ClientePeer::CA_NOMBRES, ClientePeer::CA_SALUDO, ClientePeer::CA_SEXO, ClientePeer::CA_CUMPLEANOS, ClientePeer::CA_OFICINA, ClientePeer::CA_VENDEDOR, ClientePeer::CA_EMAIL, ClientePeer::CA_COORDINADOR, ClientePeer::CA_DIRECCION, ClientePeer::CA_LOCALIDAD, ClientePeer::CA_COMPLEMENTO, ClientePeer::CA_TELEFONOS, ClientePeer::CA_FAX, ClientePeer::CA_PREFERENCIAS, ClientePeer::CA_CONFIRMAR, ClientePeer::CA_IDCIUDAD, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcliente', 'ca_digito', 'ca_compania', 'ca_papellido', 'ca_sapellido', 'ca_nombres', 'ca_saludo', 'ca_sexo', 'ca_cumpleanos', 'ca_oficina', 'ca_vendedor', 'ca_email', 'ca_coordinador', 'ca_direccion', 'ca_localidad', 'ca_complemento', 'ca_telefonos', 'ca_fax', 'ca_preferencias', 'ca_confirmar', 'ca_idciudad', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdcliente' => 0, 'CaDigito' => 1, 'CaCompania' => 2, 'CaPapellido' => 3, 'CaSapellido' => 4, 'CaNombres' => 5, 'CaSaludo' => 6, 'CaSexo' => 7, 'CaCumpleanos' => 8, 'CaOficina' => 9, 'CaVendedor' => 10, 'CaEmail' => 11, 'CaCoordinador' => 12, 'CaDireccion' => 13, 'CaLocalidad' => 14, 'CaComplemento' => 15, 'CaTelefonos' => 16, 'CaFax' => 17, 'CaPreferencias' => 18, 'CaConfirmar' => 19, 'CaIdciudad' => 20, ),
		BasePeer::TYPE_COLNAME => array (ClientePeer::CA_IDCLIENTE => 0, ClientePeer::CA_DIGITO => 1, ClientePeer::CA_COMPANIA => 2, ClientePeer::CA_PAPELLIDO => 3, ClientePeer::CA_SAPELLIDO => 4, ClientePeer::CA_NOMBRES => 5, ClientePeer::CA_SALUDO => 6, ClientePeer::CA_SEXO => 7, ClientePeer::CA_CUMPLEANOS => 8, ClientePeer::CA_OFICINA => 9, ClientePeer::CA_VENDEDOR => 10, ClientePeer::CA_EMAIL => 11, ClientePeer::CA_COORDINADOR => 12, ClientePeer::CA_DIRECCION => 13, ClientePeer::CA_LOCALIDAD => 14, ClientePeer::CA_COMPLEMENTO => 15, ClientePeer::CA_TELEFONOS => 16, ClientePeer::CA_FAX => 17, ClientePeer::CA_PREFERENCIAS => 18, ClientePeer::CA_CONFIRMAR => 19, ClientePeer::CA_IDCIUDAD => 20, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcliente' => 0, 'ca_digito' => 1, 'ca_compania' => 2, 'ca_papellido' => 3, 'ca_sapellido' => 4, 'ca_nombres' => 5, 'ca_saludo' => 6, 'ca_sexo' => 7, 'ca_cumpleanos' => 8, 'ca_oficina' => 9, 'ca_vendedor' => 10, 'ca_email' => 11, 'ca_coordinador' => 12, 'ca_direccion' => 13, 'ca_localidad' => 14, 'ca_complemento' => 15, 'ca_telefonos' => 16, 'ca_fax' => 17, 'ca_preferencias' => 18, 'ca_confirmar' => 19, 'ca_idciudad' => 20, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('lib.model.public.map.ClienteMapBuilder');
	}
	/**
	 * Gets a map (hash) of PHP names to DB column names.
	 *
	 * @return     array The PHP to DB name map for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @deprecated Use the getFieldNames() and translateFieldName() methods instead of this.
	 */
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ClientePeer::getTableMap();
			$columns = $map->getColumns();
			$nameMap = array();
			foreach ($columns as $column) {
				$nameMap[$column->getPhpName()] = $column->getColumnName();
			}
			self::$phpNameMap = $nameMap;
		}
		return self::$phpNameMap;
	}
	/**
	 * Translates a fieldname to another type
	 *
	 * @param      string $name field name
	 * @param      string $fromType One of the class type constants TYPE_PHPNAME,
	 *                         TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @param      string $toType   One of the class type constants
	 * @return     string translated name of the field.
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
	 * Returns an array of of field names.
	 *
	 * @param      string $type The type of fieldnames to return:
	 *                      One of the class type constants TYPE_PHPNAME,
	 *                      TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     array A list of field names
	 */

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
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

	}

	const COUNT = 'COUNT(tb_clientes.CA_IDCLIENTE)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT tb_clientes.CA_IDCLIENTE)';

	/**
	 * Returns the number of rows matching criteria.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ClientePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ClientePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ClientePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}
	/**
	 * Method to select one object from the DB.
	 *
	 * @param      Criteria $criteria object used to create the SELECT statement.
	 * @param      Connection $con
	 * @return     Cliente
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
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
	 * @param      Connection $con
	 * @return     array Array of selected Objects
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ClientePeer::populateObjects(ClientePeer::doSelectRS($criteria, $con));
	}
	/**
	 * Prepares the Criteria object and uses the parent doSelect()
	 * method to get a ResultSet.
	 *
	 * Use this method directly if you want to just get the resultset
	 * (instead of an array of objects).
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      Connection $con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return     ResultSet The resultset object with numerically-indexed fields.
	 * @see        BasePeer::doSelect()
	 */
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ClientePeer::addSelectColumns($criteria);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		// BasePeer returns a Creole ResultSet, set to return
		// rows indexed numerically.
		return BasePeer::doSelect($criteria, $con);
	}
	/**
	 * The returned array will contain objects of the default type or
	 * objects that inherit from the default.
	 *
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
		// set the class once to avoid overhead in the loop
		$cls = ClientePeer::getOMClass();
		$cls = Propel::import($cls);
		// populate the object(s)
		while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	/**
	 * Returns the number of rows matching criteria, joining the related Ciudad table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinCiudad(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ClientePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ClientePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ClientePeer::CA_IDCIUDAD, CiudadPeer::CA_IDCIUDAD);

		$rs = ClientePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of Cliente objects pre-filled with their Ciudad objects.
	 *
	 * @return     array Array of Cliente objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinCiudad(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ClientePeer::addSelectColumns($c);
		$startcol = (ClientePeer::NUM_COLUMNS - ClientePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		CiudadPeer::addSelectColumns($c);

		$c->addJoin(ClientePeer::CA_IDCIUDAD, CiudadPeer::CA_IDCIUDAD);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ClientePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = CiudadPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getCiudad(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addCliente($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initClientes();
				$obj2->addCliente($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining all related tables
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ClientePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ClientePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ClientePeer::CA_IDCIUDAD, CiudadPeer::CA_IDCIUDAD);

		$rs = ClientePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of Cliente objects pre-filled with all related objects.
	 *
	 * @return     array Array of Cliente objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ClientePeer::addSelectColumns($c);
		$startcol2 = (ClientePeer::NUM_COLUMNS - ClientePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CiudadPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CiudadPeer::NUM_COLUMNS;

		$c->addJoin(ClientePeer::CA_IDCIUDAD, CiudadPeer::CA_IDCIUDAD);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ClientePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


				// Add objects for joined Ciudad rows
	
			$omClass = CiudadPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getCiudad(); // CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addCliente($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initClientes();
				$obj2->addCliente($obj1);
			}

			$results[] = $obj1;
		}
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
	 * @param      Connection $con the connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from Cliente object
		}

		$criteria->remove(ClientePeer::CA_IDCLIENTE); // remove pkey col since this table uses auto-increment


		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		try {
			// use transaction because $criteria could contain info
			// for more than one table (I guess, conceivably)
			$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a Cliente or Criteria object.
	 *
	 * @param      mixed $values Criteria or Cliente object containing data that is used to create the UPDATE statement.
	 * @param      Connection $con The connection to use (specify Connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
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
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->begin();
			$affectedRows += BasePeer::doDeleteAll(ClientePeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a Cliente or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or Cliente object or primary key or array of primary keys
	 *              which is used to create the DELETE statement
	 * @param      Connection $con the connection to use
	 * @return     int 	The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
	 *				if supported by native driver or if emulated using Propel.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(ClientePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof Cliente) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ClientePeer::CA_IDCLIENTE, (array) $values, Criteria::IN);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; // initialize var to track total num of affected rows

		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->begin();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
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

			foreach($cols as $colName) {
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
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      mixed $pk the primary key.
	 * @param      Connection $con the connection to use
	 * @return     Cliente
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
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
	 * @param      Connection $con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function retrieveByPKs($pks, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria();
			$criteria->add(ClientePeer::CA_IDCLIENTE, $pks, Criteria::IN);
			$objs = ClientePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseClientePeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseClientePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	Propel::registerMapBuilder('lib.model.public.map.ClienteMapBuilder');
}
