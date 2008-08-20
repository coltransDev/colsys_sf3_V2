<?php

/**
 * Base static class for performing query and update operations on the 'tb_faladetails' table.
 *
 * 
 *
 * @package    lib.model.falabella.om
 */
abstract class BaseFalaDetailPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'tb_faladetails';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.falabella.FalaDetail';

	/** The total number of columns. */
	const NUM_COLUMNS = 17;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the CA_IDDOC field */
	const CA_IDDOC = 'tb_faladetails.CA_IDDOC';

	/** the column name for the CA_SKU field */
	const CA_SKU = 'tb_faladetails.CA_SKU';

	/** the column name for the CA_VPN field */
	const CA_VPN = 'tb_faladetails.CA_VPN';

	/** the column name for the CA_NUM_CONT_PART1 field */
	const CA_NUM_CONT_PART1 = 'tb_faladetails.CA_NUM_CONT_PART1';

	/** the column name for the CA_NUM_CONT_PART2 field */
	const CA_NUM_CONT_PART2 = 'tb_faladetails.CA_NUM_CONT_PART2';

	/** the column name for the CA_NUM_CONT_SELL field */
	const CA_NUM_CONT_SELL = 'tb_faladetails.CA_NUM_CONT_SELL';

	/** the column name for the CA_CONTAINER_ISO field */
	const CA_CONTAINER_ISO = 'tb_faladetails.CA_CONTAINER_ISO';

	/** the column name for the CA_CANTIDAD_PEDIDO field */
	const CA_CANTIDAD_PEDIDO = 'tb_faladetails.CA_CANTIDAD_PEDIDO';

	/** the column name for the CA_CANTIDAD_MILES field */
	const CA_CANTIDAD_MILES = 'tb_faladetails.CA_CANTIDAD_MILES';

	/** the column name for the CA_UNIDAD_MEDIDAD_CANTIDAD field */
	const CA_UNIDAD_MEDIDAD_CANTIDAD = 'tb_faladetails.CA_UNIDAD_MEDIDAD_CANTIDAD';

	/** the column name for the CA_DESCRIPCION_ITEM field */
	const CA_DESCRIPCION_ITEM = 'tb_faladetails.CA_DESCRIPCION_ITEM';

	/** the column name for the CA_CANTIDAD_PAQUETES_MILES field */
	const CA_CANTIDAD_PAQUETES_MILES = 'tb_faladetails.CA_CANTIDAD_PAQUETES_MILES';

	/** the column name for the CA_UNIDAD_MEDIDA_PAQUETES field */
	const CA_UNIDAD_MEDIDA_PAQUETES = 'tb_faladetails.CA_UNIDAD_MEDIDA_PAQUETES';

	/** the column name for the CA_CANTIDAD_VOLUMEN_MILES field */
	const CA_CANTIDAD_VOLUMEN_MILES = 'tb_faladetails.CA_CANTIDAD_VOLUMEN_MILES';

	/** the column name for the CA_UNIDAD_MEDIDA_VOLUMEN field */
	const CA_UNIDAD_MEDIDA_VOLUMEN = 'tb_faladetails.CA_UNIDAD_MEDIDA_VOLUMEN';

	/** the column name for the CA_CANTIDAD_PESO_MILES field */
	const CA_CANTIDAD_PESO_MILES = 'tb_faladetails.CA_CANTIDAD_PESO_MILES';

	/** the column name for the CA_UNIDAD_MEDIDA_PESO field */
	const CA_UNIDAD_MEDIDA_PESO = 'tb_faladetails.CA_UNIDAD_MEDIDA_PESO';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIddoc', 'CaSku', 'CaVpn', 'CaNumContPart1', 'CaNumContPart2', 'CaNumContSell', 'CaContainerIso', 'CaCantidadPedido', 'CaCantidadMiles', 'CaUnidadMedidadCantidad', 'CaDescripcionItem', 'CaCantidadPaquetesMiles', 'CaUnidadMedidaPaquetes', 'CaCantidadVolumenMiles', 'CaUnidadMedidaVolumen', 'CaCantidadPesoMiles', 'CaUnidadMedidaPeso', ),
		BasePeer::TYPE_COLNAME => array (FalaDetailPeer::CA_IDDOC, FalaDetailPeer::CA_SKU, FalaDetailPeer::CA_VPN, FalaDetailPeer::CA_NUM_CONT_PART1, FalaDetailPeer::CA_NUM_CONT_PART2, FalaDetailPeer::CA_NUM_CONT_SELL, FalaDetailPeer::CA_CONTAINER_ISO, FalaDetailPeer::CA_CANTIDAD_PEDIDO, FalaDetailPeer::CA_CANTIDAD_MILES, FalaDetailPeer::CA_UNIDAD_MEDIDAD_CANTIDAD, FalaDetailPeer::CA_DESCRIPCION_ITEM, FalaDetailPeer::CA_CANTIDAD_PAQUETES_MILES, FalaDetailPeer::CA_UNIDAD_MEDIDA_PAQUETES, FalaDetailPeer::CA_CANTIDAD_VOLUMEN_MILES, FalaDetailPeer::CA_UNIDAD_MEDIDA_VOLUMEN, FalaDetailPeer::CA_CANTIDAD_PESO_MILES, FalaDetailPeer::CA_UNIDAD_MEDIDA_PESO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_iddoc', 'ca_sku', 'ca_vpn', 'ca_num_cont_part1', 'ca_num_cont_part2', 'ca_num_cont_sell', 'ca_container_iso', 'ca_cantidad_pedido', 'ca_cantidad_miles', 'ca_unidad_medidad_cantidad', 'ca_descripcion_item', 'ca_cantidad_paquetes_miles', 'ca_unidad_medida_paquetes', 'ca_cantidad_volumen_miles', 'ca_unidad_medida_volumen', 'ca_cantidad_peso_miles', 'ca_unidad_medida_peso', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIddoc' => 0, 'CaSku' => 1, 'CaVpn' => 2, 'CaNumContPart1' => 3, 'CaNumContPart2' => 4, 'CaNumContSell' => 5, 'CaContainerIso' => 6, 'CaCantidadPedido' => 7, 'CaCantidadMiles' => 8, 'CaUnidadMedidadCantidad' => 9, 'CaDescripcionItem' => 10, 'CaCantidadPaquetesMiles' => 11, 'CaUnidadMedidaPaquetes' => 12, 'CaCantidadVolumenMiles' => 13, 'CaUnidadMedidaVolumen' => 14, 'CaCantidadPesoMiles' => 15, 'CaUnidadMedidaPeso' => 16, ),
		BasePeer::TYPE_COLNAME => array (FalaDetailPeer::CA_IDDOC => 0, FalaDetailPeer::CA_SKU => 1, FalaDetailPeer::CA_VPN => 2, FalaDetailPeer::CA_NUM_CONT_PART1 => 3, FalaDetailPeer::CA_NUM_CONT_PART2 => 4, FalaDetailPeer::CA_NUM_CONT_SELL => 5, FalaDetailPeer::CA_CONTAINER_ISO => 6, FalaDetailPeer::CA_CANTIDAD_PEDIDO => 7, FalaDetailPeer::CA_CANTIDAD_MILES => 8, FalaDetailPeer::CA_UNIDAD_MEDIDAD_CANTIDAD => 9, FalaDetailPeer::CA_DESCRIPCION_ITEM => 10, FalaDetailPeer::CA_CANTIDAD_PAQUETES_MILES => 11, FalaDetailPeer::CA_UNIDAD_MEDIDA_PAQUETES => 12, FalaDetailPeer::CA_CANTIDAD_VOLUMEN_MILES => 13, FalaDetailPeer::CA_UNIDAD_MEDIDA_VOLUMEN => 14, FalaDetailPeer::CA_CANTIDAD_PESO_MILES => 15, FalaDetailPeer::CA_UNIDAD_MEDIDA_PESO => 16, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_iddoc' => 0, 'ca_sku' => 1, 'ca_vpn' => 2, 'ca_num_cont_part1' => 3, 'ca_num_cont_part2' => 4, 'ca_num_cont_sell' => 5, 'ca_container_iso' => 6, 'ca_cantidad_pedido' => 7, 'ca_cantidad_miles' => 8, 'ca_unidad_medidad_cantidad' => 9, 'ca_descripcion_item' => 10, 'ca_cantidad_paquetes_miles' => 11, 'ca_unidad_medida_paquetes' => 12, 'ca_cantidad_volumen_miles' => 13, 'ca_unidad_medida_volumen' => 14, 'ca_cantidad_peso_miles' => 15, 'ca_unidad_medida_peso' => 16, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('lib.model.falabella.map.FalaDetailMapBuilder');
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
			$map = FalaDetailPeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. FalaDetailPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(FalaDetailPeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(FalaDetailPeer::CA_IDDOC);

		$criteria->addSelectColumn(FalaDetailPeer::CA_SKU);

		$criteria->addSelectColumn(FalaDetailPeer::CA_VPN);

		$criteria->addSelectColumn(FalaDetailPeer::CA_NUM_CONT_PART1);

		$criteria->addSelectColumn(FalaDetailPeer::CA_NUM_CONT_PART2);

		$criteria->addSelectColumn(FalaDetailPeer::CA_NUM_CONT_SELL);

		$criteria->addSelectColumn(FalaDetailPeer::CA_CONTAINER_ISO);

		$criteria->addSelectColumn(FalaDetailPeer::CA_CANTIDAD_PEDIDO);

		$criteria->addSelectColumn(FalaDetailPeer::CA_CANTIDAD_MILES);

		$criteria->addSelectColumn(FalaDetailPeer::CA_UNIDAD_MEDIDAD_CANTIDAD);

		$criteria->addSelectColumn(FalaDetailPeer::CA_DESCRIPCION_ITEM);

		$criteria->addSelectColumn(FalaDetailPeer::CA_CANTIDAD_PAQUETES_MILES);

		$criteria->addSelectColumn(FalaDetailPeer::CA_UNIDAD_MEDIDA_PAQUETES);

		$criteria->addSelectColumn(FalaDetailPeer::CA_CANTIDAD_VOLUMEN_MILES);

		$criteria->addSelectColumn(FalaDetailPeer::CA_UNIDAD_MEDIDA_VOLUMEN);

		$criteria->addSelectColumn(FalaDetailPeer::CA_CANTIDAD_PESO_MILES);

		$criteria->addSelectColumn(FalaDetailPeer::CA_UNIDAD_MEDIDA_PESO);

	}

	const COUNT = 'COUNT(tb_faladetails.CA_IDDOC)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT tb_faladetails.CA_IDDOC)';

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
			$criteria->addSelectColumn(FalaDetailPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FalaDetailPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = FalaDetailPeer::doSelectRS($criteria, $con);
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
	 * @return     FalaDetail
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = FalaDetailPeer::doSelect($critcopy, $con);
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
		return FalaDetailPeer::populateObjects(FalaDetailPeer::doSelectRS($criteria, $con));
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
			FalaDetailPeer::addSelectColumns($criteria);
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
		$cls = FalaDetailPeer::getOMClass();
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
	 * Returns the number of rows matching criteria, joining the related FalaHeader table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinFalaHeader(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FalaDetailPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FalaDetailPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FalaDetailPeer::CA_IDDOC, FalaHeaderPeer::CA_IDDOC);

		$rs = FalaDetailPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of FalaDetail objects pre-filled with their FalaHeader objects.
	 *
	 * @return     array Array of FalaDetail objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinFalaHeader(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FalaDetailPeer::addSelectColumns($c);
		$startcol = (FalaDetailPeer::NUM_COLUMNS - FalaDetailPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		FalaHeaderPeer::addSelectColumns($c);

		$c->addJoin(FalaDetailPeer::CA_IDDOC, FalaHeaderPeer::CA_IDDOC);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FalaDetailPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = FalaHeaderPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getFalaHeader(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addFalaDetail($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initFalaDetails();
				$obj2->addFalaDetail($obj1); //CHECKME
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
			$criteria->addSelectColumn(FalaDetailPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FalaDetailPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FalaDetailPeer::CA_IDDOC, FalaHeaderPeer::CA_IDDOC);

		$rs = FalaDetailPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of FalaDetail objects pre-filled with all related objects.
	 *
	 * @return     array Array of FalaDetail objects.
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

		FalaDetailPeer::addSelectColumns($c);
		$startcol2 = (FalaDetailPeer::NUM_COLUMNS - FalaDetailPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		FalaHeaderPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + FalaHeaderPeer::NUM_COLUMNS;

		$c->addJoin(FalaDetailPeer::CA_IDDOC, FalaHeaderPeer::CA_IDDOC);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FalaDetailPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


				// Add objects for joined FalaHeader rows
	
			$omClass = FalaHeaderPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getFalaHeader(); // CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addFalaDetail($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initFalaDetails();
				$obj2->addFalaDetail($obj1);
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
		return FalaDetailPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a FalaDetail or Criteria object.
	 *
	 * @param      mixed $values Criteria or FalaDetail object containing data that is used to create the INSERT statement.
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
			$criteria = $values->buildCriteria(); // build Criteria from FalaDetail object
		}


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
	 * Method perform an UPDATE on the database, given a FalaDetail or Criteria object.
	 *
	 * @param      mixed $values Criteria or FalaDetail object containing data that is used to create the UPDATE statement.
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

			$comparison = $criteria->getComparison(FalaDetailPeer::CA_IDDOC);
			$selectCriteria->add(FalaDetailPeer::CA_IDDOC, $criteria->remove(FalaDetailPeer::CA_IDDOC), $comparison);

			$comparison = $criteria->getComparison(FalaDetailPeer::CA_SKU);
			$selectCriteria->add(FalaDetailPeer::CA_SKU, $criteria->remove(FalaDetailPeer::CA_SKU), $comparison);

		} else { // $values is FalaDetail object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the tb_faladetails table.
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
			$affectedRows += BasePeer::doDeleteAll(FalaDetailPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a FalaDetail or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or FalaDetail object or primary key or array of primary keys
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
			$con = Propel::getConnection(FalaDetailPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof FalaDetail) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			// primary key is composite; we therefore, expect
			// the primary key passed to be an array of pkey
			// values
			if(count($values) == count($values, COUNT_RECURSIVE))
			{
				// array is not multi-dimensional
				$values = array($values);
			}
			$vals = array();
			foreach($values as $value)
			{

				$vals[0][] = $value[0];
				$vals[1][] = $value[1];
			}

			$criteria->add(FalaDetailPeer::CA_IDDOC, $vals[0], Criteria::IN);
			$criteria->add(FalaDetailPeer::CA_SKU, $vals[1], Criteria::IN);
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
	 * Validates all modified columns of given FalaDetail object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      FalaDetail $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(FalaDetail $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(FalaDetailPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(FalaDetailPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(FalaDetailPeer::DATABASE_NAME, FalaDetailPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = FalaDetailPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	/**
	 * Retrieve object using using composite pkey values.
	 * @param string $ca_iddoc
	   @param string $ca_sku
	   
	 * @param      Connection $con
	 * @return     FalaDetail
	 */
	public static function retrieveByPK( $ca_iddoc, $ca_sku, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(FalaDetailPeer::CA_IDDOC, $ca_iddoc);
		$criteria->add(FalaDetailPeer::CA_SKU, $ca_sku);
		$v = FalaDetailPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} // BaseFalaDetailPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseFalaDetailPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	Propel::registerMapBuilder('lib.model.falabella.map.FalaDetailMapBuilder');
}
