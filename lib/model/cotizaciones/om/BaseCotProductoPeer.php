<?php

/**
 * Base static class for performing query and update operations on the 'tb_cotproductos' table.
 *
 * 
 *
 * @package    lib.model.cotizaciones.om
 */
abstract class BaseCotProductoPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'tb_cotproductos';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.cotizaciones.CotProducto';

	/** The total number of columns. */
	const NUM_COLUMNS = 19;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the CA_IDCOTIZACION field */
	const CA_IDCOTIZACION = 'tb_cotproductos.CA_IDCOTIZACION';

	/** the column name for the CA_IDPRODUCTO field */
	const CA_IDPRODUCTO = 'tb_cotproductos.CA_IDPRODUCTO';

	/** the column name for the CA_TRANSPORTE field */
	const CA_TRANSPORTE = 'tb_cotproductos.CA_TRANSPORTE';

	/** the column name for the CA_MODALIDAD field */
	const CA_MODALIDAD = 'tb_cotproductos.CA_MODALIDAD';

	/** the column name for the CA_ORIGEN field */
	const CA_ORIGEN = 'tb_cotproductos.CA_ORIGEN';

	/** the column name for the CA_DESTINO field */
	const CA_DESTINO = 'tb_cotproductos.CA_DESTINO';

	/** the column name for the CA_IMPOEXPO field */
	const CA_IMPOEXPO = 'tb_cotproductos.CA_IMPOEXPO';

	/** the column name for the CA_IMPRIMIR field */
	const CA_IMPRIMIR = 'tb_cotproductos.CA_IMPRIMIR';

	/** the column name for the CA_PRODUCTO field */
	const CA_PRODUCTO = 'tb_cotproductos.CA_PRODUCTO';

	/** the column name for the CA_INCOTERMS field */
	const CA_INCOTERMS = 'tb_cotproductos.CA_INCOTERMS';

	/** the column name for the CA_FRECUENCIA field */
	const CA_FRECUENCIA = 'tb_cotproductos.CA_FRECUENCIA';

	/** the column name for the CA_TIEMPOTRANSITO field */
	const CA_TIEMPOTRANSITO = 'tb_cotproductos.CA_TIEMPOTRANSITO';

	/** the column name for the CA_LOCRECARGOS field */
	const CA_LOCRECARGOS = 'tb_cotproductos.CA_LOCRECARGOS';

	/** the column name for the CA_OBSERVACIONES field */
	const CA_OBSERVACIONES = 'tb_cotproductos.CA_OBSERVACIONES';

	/** the column name for the CA_FCHCREADO field */
	const CA_FCHCREADO = 'tb_cotproductos.CA_FCHCREADO';

	/** the column name for the CA_USUCREADO field */
	const CA_USUCREADO = 'tb_cotproductos.CA_USUCREADO';

	/** the column name for the CA_FCHACTUALIZADO field */
	const CA_FCHACTUALIZADO = 'tb_cotproductos.CA_FCHACTUALIZADO';

	/** the column name for the CA_USUACTUALIZADO field */
	const CA_USUACTUALIZADO = 'tb_cotproductos.CA_USUACTUALIZADO';

	/** the column name for the CA_DATOSAG field */
	const CA_DATOSAG = 'tb_cotproductos.CA_DATOSAG';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdcotizacion', 'CaIdproducto', 'CaTransporte', 'CaModalidad', 'CaOrigen', 'CaDestino', 'CaImpoexpo', 'CaImprimir', 'CaProducto', 'CaIncoterms', 'CaFrecuencia', 'CaTiempotransito', 'CaLocrecargos', 'CaObservaciones', 'CaFchcreado', 'CaUsucreado', 'CaFchactualizado', 'CaUsuactualizado', 'CaDatosag', ),
		BasePeer::TYPE_COLNAME => array (CotProductoPeer::CA_IDCOTIZACION, CotProductoPeer::CA_IDPRODUCTO, CotProductoPeer::CA_TRANSPORTE, CotProductoPeer::CA_MODALIDAD, CotProductoPeer::CA_ORIGEN, CotProductoPeer::CA_DESTINO, CotProductoPeer::CA_IMPOEXPO, CotProductoPeer::CA_IMPRIMIR, CotProductoPeer::CA_PRODUCTO, CotProductoPeer::CA_INCOTERMS, CotProductoPeer::CA_FRECUENCIA, CotProductoPeer::CA_TIEMPOTRANSITO, CotProductoPeer::CA_LOCRECARGOS, CotProductoPeer::CA_OBSERVACIONES, CotProductoPeer::CA_FCHCREADO, CotProductoPeer::CA_USUCREADO, CotProductoPeer::CA_FCHACTUALIZADO, CotProductoPeer::CA_USUACTUALIZADO, CotProductoPeer::CA_DATOSAG, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcotizacion', 'ca_idproducto', 'ca_transporte', 'ca_modalidad', 'ca_origen', 'ca_destino', 'ca_impoexpo', 'ca_imprimir', 'ca_producto', 'ca_incoterms', 'ca_frecuencia', 'ca_tiempotransito', 'ca_locrecargos', 'ca_observaciones', 'ca_fchcreado', 'ca_usucreado', 'ca_fchactualizado', 'ca_usuactualizado', 'ca_datosag', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdcotizacion' => 0, 'CaIdproducto' => 1, 'CaTransporte' => 2, 'CaModalidad' => 3, 'CaOrigen' => 4, 'CaDestino' => 5, 'CaImpoexpo' => 6, 'CaImprimir' => 7, 'CaProducto' => 8, 'CaIncoterms' => 9, 'CaFrecuencia' => 10, 'CaTiempotransito' => 11, 'CaLocrecargos' => 12, 'CaObservaciones' => 13, 'CaFchcreado' => 14, 'CaUsucreado' => 15, 'CaFchactualizado' => 16, 'CaUsuactualizado' => 17, 'CaDatosag' => 18, ),
		BasePeer::TYPE_COLNAME => array (CotProductoPeer::CA_IDCOTIZACION => 0, CotProductoPeer::CA_IDPRODUCTO => 1, CotProductoPeer::CA_TRANSPORTE => 2, CotProductoPeer::CA_MODALIDAD => 3, CotProductoPeer::CA_ORIGEN => 4, CotProductoPeer::CA_DESTINO => 5, CotProductoPeer::CA_IMPOEXPO => 6, CotProductoPeer::CA_IMPRIMIR => 7, CotProductoPeer::CA_PRODUCTO => 8, CotProductoPeer::CA_INCOTERMS => 9, CotProductoPeer::CA_FRECUENCIA => 10, CotProductoPeer::CA_TIEMPOTRANSITO => 11, CotProductoPeer::CA_LOCRECARGOS => 12, CotProductoPeer::CA_OBSERVACIONES => 13, CotProductoPeer::CA_FCHCREADO => 14, CotProductoPeer::CA_USUCREADO => 15, CotProductoPeer::CA_FCHACTUALIZADO => 16, CotProductoPeer::CA_USUACTUALIZADO => 17, CotProductoPeer::CA_DATOSAG => 18, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcotizacion' => 0, 'ca_idproducto' => 1, 'ca_transporte' => 2, 'ca_modalidad' => 3, 'ca_origen' => 4, 'ca_destino' => 5, 'ca_impoexpo' => 6, 'ca_imprimir' => 7, 'ca_producto' => 8, 'ca_incoterms' => 9, 'ca_frecuencia' => 10, 'ca_tiempotransito' => 11, 'ca_locrecargos' => 12, 'ca_observaciones' => 13, 'ca_fchcreado' => 14, 'ca_usucreado' => 15, 'ca_fchactualizado' => 16, 'ca_usuactualizado' => 17, 'ca_datosag' => 18, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('lib.model.cotizaciones.map.CotProductoMapBuilder');
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
			$map = CotProductoPeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. CotProductoPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(CotProductoPeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(CotProductoPeer::CA_IDCOTIZACION);

		$criteria->addSelectColumn(CotProductoPeer::CA_IDPRODUCTO);

		$criteria->addSelectColumn(CotProductoPeer::CA_TRANSPORTE);

		$criteria->addSelectColumn(CotProductoPeer::CA_MODALIDAD);

		$criteria->addSelectColumn(CotProductoPeer::CA_ORIGEN);

		$criteria->addSelectColumn(CotProductoPeer::CA_DESTINO);

		$criteria->addSelectColumn(CotProductoPeer::CA_IMPOEXPO);

		$criteria->addSelectColumn(CotProductoPeer::CA_IMPRIMIR);

		$criteria->addSelectColumn(CotProductoPeer::CA_PRODUCTO);

		$criteria->addSelectColumn(CotProductoPeer::CA_INCOTERMS);

		$criteria->addSelectColumn(CotProductoPeer::CA_FRECUENCIA);

		$criteria->addSelectColumn(CotProductoPeer::CA_TIEMPOTRANSITO);

		$criteria->addSelectColumn(CotProductoPeer::CA_LOCRECARGOS);

		$criteria->addSelectColumn(CotProductoPeer::CA_OBSERVACIONES);

		$criteria->addSelectColumn(CotProductoPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(CotProductoPeer::CA_USUCREADO);

		$criteria->addSelectColumn(CotProductoPeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(CotProductoPeer::CA_USUACTUALIZADO);

		$criteria->addSelectColumn(CotProductoPeer::CA_DATOSAG);

	}

	const COUNT = 'COUNT(tb_cotproductos.CA_IDCOTIZACION)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT tb_cotproductos.CA_IDCOTIZACION)';

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
			$criteria->addSelectColumn(CotProductoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CotProductoPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = CotProductoPeer::doSelectRS($criteria, $con);
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
	 * @return     CotProducto
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = CotProductoPeer::doSelect($critcopy, $con);
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
		return CotProductoPeer::populateObjects(CotProductoPeer::doSelectRS($criteria, $con));
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
			CotProductoPeer::addSelectColumns($criteria);
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
		$cls = CotProductoPeer::getOMClass();
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
	 * Returns the number of rows matching criteria, joining the related Cotizacion table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinCotizacion(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CotProductoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CotProductoPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CotProductoPeer::CA_IDCOTIZACION, CotizacionPeer::CA_IDCOTIZACION);

		$rs = CotProductoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of CotProducto objects pre-filled with their Cotizacion objects.
	 *
	 * @return     array Array of CotProducto objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinCotizacion(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotProductoPeer::addSelectColumns($c);
		$startcol = (CotProductoPeer::NUM_COLUMNS - CotProductoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		CotizacionPeer::addSelectColumns($c);

		$c->addJoin(CotProductoPeer::CA_IDCOTIZACION, CotizacionPeer::CA_IDCOTIZACION);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CotProductoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = CotizacionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getCotizacion(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addCotProducto($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initCotProductos();
				$obj2->addCotProducto($obj1); //CHECKME
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
			$criteria->addSelectColumn(CotProductoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CotProductoPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CotProductoPeer::CA_IDCOTIZACION, CotizacionPeer::CA_IDCOTIZACION);

		$rs = CotProductoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of CotProducto objects pre-filled with all related objects.
	 *
	 * @return     array Array of CotProducto objects.
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

		CotProductoPeer::addSelectColumns($c);
		$startcol2 = (CotProductoPeer::NUM_COLUMNS - CotProductoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CotizacionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CotizacionPeer::NUM_COLUMNS;

		$c->addJoin(CotProductoPeer::CA_IDCOTIZACION, CotizacionPeer::CA_IDCOTIZACION);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CotProductoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


				// Add objects for joined Cotizacion rows
	
			$omClass = CotizacionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getCotizacion(); // CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addCotProducto($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initCotProductos();
				$obj2->addCotProducto($obj1);
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
		return CotProductoPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a CotProducto or Criteria object.
	 *
	 * @param      mixed $values Criteria or CotProducto object containing data that is used to create the INSERT statement.
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
			$criteria = $values->buildCriteria(); // build Criteria from CotProducto object
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
	 * Method perform an UPDATE on the database, given a CotProducto or Criteria object.
	 *
	 * @param      mixed $values Criteria or CotProducto object containing data that is used to create the UPDATE statement.
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

			$comparison = $criteria->getComparison(CotProductoPeer::CA_IDCOTIZACION);
			$selectCriteria->add(CotProductoPeer::CA_IDCOTIZACION, $criteria->remove(CotProductoPeer::CA_IDCOTIZACION), $comparison);

			$comparison = $criteria->getComparison(CotProductoPeer::CA_IDPRODUCTO);
			$selectCriteria->add(CotProductoPeer::CA_IDPRODUCTO, $criteria->remove(CotProductoPeer::CA_IDPRODUCTO), $comparison);

		} else { // $values is CotProducto object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the tb_cotproductos table.
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
			$affectedRows += BasePeer::doDeleteAll(CotProductoPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a CotProducto or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or CotProducto object or primary key or array of primary keys
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
			$con = Propel::getConnection(CotProductoPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof CotProducto) {

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

			$criteria->add(CotProductoPeer::CA_IDCOTIZACION, $vals[0], Criteria::IN);
			$criteria->add(CotProductoPeer::CA_IDPRODUCTO, $vals[1], Criteria::IN);
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
	 * Validates all modified columns of given CotProducto object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      CotProducto $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(CotProducto $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(CotProductoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(CotProductoPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(CotProductoPeer::DATABASE_NAME, CotProductoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = CotProductoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	/**
	 * Retrieve object using using composite pkey values.
	 * @param int $ca_idcotizacion
	   @param int $ca_idproducto
	   
	 * @param      Connection $con
	 * @return     CotProducto
	 */
	public static function retrieveByPK( $ca_idcotizacion, $ca_idproducto, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(CotProductoPeer::CA_IDCOTIZACION, $ca_idcotizacion);
		$criteria->add(CotProductoPeer::CA_IDPRODUCTO, $ca_idproducto);
		$v = CotProductoPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} // BaseCotProductoPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseCotProductoPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	Propel::registerMapBuilder('lib.model.cotizaciones.map.CotProductoMapBuilder');
}
