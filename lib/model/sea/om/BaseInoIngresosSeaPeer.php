<?php

/**
 * Base static class for performing query and update operations on the 'tb_inoingresos_sea' table.
 *
 * 
 *
 * @package    lib.model.sea.om
 */
abstract class BaseInoIngresosSeaPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'tb_inoingresos_sea';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.sea.InoIngresosSea';

	/** The total number of columns. */
	const NUM_COLUMNS = 14;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the CA_REFERENCIA field */
	const CA_REFERENCIA = 'tb_inoingresos_sea.CA_REFERENCIA';

	/** the column name for the CA_IDCLIENTE field */
	const CA_IDCLIENTE = 'tb_inoingresos_sea.CA_IDCLIENTE';

	/** the column name for the CA_HBLS field */
	const CA_HBLS = 'tb_inoingresos_sea.CA_HBLS';

	/** the column name for the CA_FACTURA field */
	const CA_FACTURA = 'tb_inoingresos_sea.CA_FACTURA';

	/** the column name for the CA_FCHFACTURA field */
	const CA_FCHFACTURA = 'tb_inoingresos_sea.CA_FCHFACTURA';

	/** the column name for the CA_VALOR field */
	const CA_VALOR = 'tb_inoingresos_sea.CA_VALOR';

	/** the column name for the CA_RECCAJA field */
	const CA_RECCAJA = 'tb_inoingresos_sea.CA_RECCAJA';

	/** the column name for the CA_FCHPAGO field */
	const CA_FCHPAGO = 'tb_inoingresos_sea.CA_FCHPAGO';

	/** the column name for the CA_TCAMBIO field */
	const CA_TCAMBIO = 'tb_inoingresos_sea.CA_TCAMBIO';

	/** the column name for the CA_FCHCREADO field */
	const CA_FCHCREADO = 'tb_inoingresos_sea.CA_FCHCREADO';

	/** the column name for the CA_USUCREADO field */
	const CA_USUCREADO = 'tb_inoingresos_sea.CA_USUCREADO';

	/** the column name for the CA_FCHACTUALIZADO field */
	const CA_FCHACTUALIZADO = 'tb_inoingresos_sea.CA_FCHACTUALIZADO';

	/** the column name for the CA_USUACTUALIZADO field */
	const CA_USUACTUALIZADO = 'tb_inoingresos_sea.CA_USUACTUALIZADO';

	/** the column name for the CA_OBSERVACIONES field */
	const CA_OBSERVACIONES = 'tb_inoingresos_sea.CA_OBSERVACIONES';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaReferencia', 'CaIdcliente', 'CaHbls', 'CaFactura', 'CaFchfactura', 'CaValor', 'CaReccaja', 'CaFchpago', 'CaTcambio', 'CaFchcreado', 'CaUsucreado', 'CaFchactualizado', 'CaUsuactualizado', 'CaObservaciones', ),
		BasePeer::TYPE_COLNAME => array (InoIngresosSeaPeer::CA_REFERENCIA, InoIngresosSeaPeer::CA_IDCLIENTE, InoIngresosSeaPeer::CA_HBLS, InoIngresosSeaPeer::CA_FACTURA, InoIngresosSeaPeer::CA_FCHFACTURA, InoIngresosSeaPeer::CA_VALOR, InoIngresosSeaPeer::CA_RECCAJA, InoIngresosSeaPeer::CA_FCHPAGO, InoIngresosSeaPeer::CA_TCAMBIO, InoIngresosSeaPeer::CA_FCHCREADO, InoIngresosSeaPeer::CA_USUCREADO, InoIngresosSeaPeer::CA_FCHACTUALIZADO, InoIngresosSeaPeer::CA_USUACTUALIZADO, InoIngresosSeaPeer::CA_OBSERVACIONES, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_referencia', 'ca_idcliente', 'ca_hbls', 'ca_factura', 'ca_fchfactura', 'ca_valor', 'ca_reccaja', 'ca_fchpago', 'ca_tcambio', 'ca_fchcreado', 'ca_usucreado', 'ca_fchactualizado', 'ca_usuactualizado', 'ca_observaciones', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaReferencia' => 0, 'CaIdcliente' => 1, 'CaHbls' => 2, 'CaFactura' => 3, 'CaFchfactura' => 4, 'CaValor' => 5, 'CaReccaja' => 6, 'CaFchpago' => 7, 'CaTcambio' => 8, 'CaFchcreado' => 9, 'CaUsucreado' => 10, 'CaFchactualizado' => 11, 'CaUsuactualizado' => 12, 'CaObservaciones' => 13, ),
		BasePeer::TYPE_COLNAME => array (InoIngresosSeaPeer::CA_REFERENCIA => 0, InoIngresosSeaPeer::CA_IDCLIENTE => 1, InoIngresosSeaPeer::CA_HBLS => 2, InoIngresosSeaPeer::CA_FACTURA => 3, InoIngresosSeaPeer::CA_FCHFACTURA => 4, InoIngresosSeaPeer::CA_VALOR => 5, InoIngresosSeaPeer::CA_RECCAJA => 6, InoIngresosSeaPeer::CA_FCHPAGO => 7, InoIngresosSeaPeer::CA_TCAMBIO => 8, InoIngresosSeaPeer::CA_FCHCREADO => 9, InoIngresosSeaPeer::CA_USUCREADO => 10, InoIngresosSeaPeer::CA_FCHACTUALIZADO => 11, InoIngresosSeaPeer::CA_USUACTUALIZADO => 12, InoIngresosSeaPeer::CA_OBSERVACIONES => 13, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_referencia' => 0, 'ca_idcliente' => 1, 'ca_hbls' => 2, 'ca_factura' => 3, 'ca_fchfactura' => 4, 'ca_valor' => 5, 'ca_reccaja' => 6, 'ca_fchpago' => 7, 'ca_tcambio' => 8, 'ca_fchcreado' => 9, 'ca_usucreado' => 10, 'ca_fchactualizado' => 11, 'ca_usuactualizado' => 12, 'ca_observaciones' => 13, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('lib.model.sea.map.InoIngresosSeaMapBuilder');
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
			$map = InoIngresosSeaPeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. InoIngresosSeaPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(InoIngresosSeaPeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(InoIngresosSeaPeer::CA_REFERENCIA);

		$criteria->addSelectColumn(InoIngresosSeaPeer::CA_IDCLIENTE);

		$criteria->addSelectColumn(InoIngresosSeaPeer::CA_HBLS);

		$criteria->addSelectColumn(InoIngresosSeaPeer::CA_FACTURA);

		$criteria->addSelectColumn(InoIngresosSeaPeer::CA_FCHFACTURA);

		$criteria->addSelectColumn(InoIngresosSeaPeer::CA_VALOR);

		$criteria->addSelectColumn(InoIngresosSeaPeer::CA_RECCAJA);

		$criteria->addSelectColumn(InoIngresosSeaPeer::CA_FCHPAGO);

		$criteria->addSelectColumn(InoIngresosSeaPeer::CA_TCAMBIO);

		$criteria->addSelectColumn(InoIngresosSeaPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(InoIngresosSeaPeer::CA_USUCREADO);

		$criteria->addSelectColumn(InoIngresosSeaPeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(InoIngresosSeaPeer::CA_USUACTUALIZADO);

		$criteria->addSelectColumn(InoIngresosSeaPeer::CA_OBSERVACIONES);

	}

	const COUNT = 'COUNT(tb_inoingresos_sea.CA_REFERENCIA)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT tb_inoingresos_sea.CA_REFERENCIA)';

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
			$criteria->addSelectColumn(InoIngresosSeaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InoIngresosSeaPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = InoIngresosSeaPeer::doSelectRS($criteria, $con);
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
	 * @return     InoIngresosSea
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = InoIngresosSeaPeer::doSelect($critcopy, $con);
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
		return InoIngresosSeaPeer::populateObjects(InoIngresosSeaPeer::doSelectRS($criteria, $con));
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
			InoIngresosSeaPeer::addSelectColumns($criteria);
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
		$cls = InoIngresosSeaPeer::getOMClass();
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
	 * Returns the number of rows matching criteria, joining the related InoMaestraSea table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinInoMaestraSea(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InoIngresosSeaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InoIngresosSeaPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InoIngresosSeaPeer::CA_REFERENCIA, InoMaestraSeaPeer::CA_REFERENCIA);

		$rs = InoIngresosSeaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Cliente table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinCliente(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InoIngresosSeaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InoIngresosSeaPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InoIngresosSeaPeer::CA_IDCLIENTE, ClientePeer::CA_IDCLIENTE);

		$rs = InoIngresosSeaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of InoIngresosSea objects pre-filled with their InoMaestraSea objects.
	 *
	 * @return     array Array of InoIngresosSea objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinInoMaestraSea(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoIngresosSeaPeer::addSelectColumns($c);
		$startcol = (InoIngresosSeaPeer::NUM_COLUMNS - InoIngresosSeaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		InoMaestraSeaPeer::addSelectColumns($c);

		$c->addJoin(InoIngresosSeaPeer::CA_REFERENCIA, InoMaestraSeaPeer::CA_REFERENCIA);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InoIngresosSeaPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = InoMaestraSeaPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getInoMaestraSea(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addInoIngresosSea($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initInoIngresosSeas();
				$obj2->addInoIngresosSea($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of InoIngresosSea objects pre-filled with their Cliente objects.
	 *
	 * @return     array Array of InoIngresosSea objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinCliente(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoIngresosSeaPeer::addSelectColumns($c);
		$startcol = (InoIngresosSeaPeer::NUM_COLUMNS - InoIngresosSeaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ClientePeer::addSelectColumns($c);

		$c->addJoin(InoIngresosSeaPeer::CA_IDCLIENTE, ClientePeer::CA_IDCLIENTE);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InoIngresosSeaPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ClientePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getCliente(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addInoIngresosSea($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initInoIngresosSeas();
				$obj2->addInoIngresosSea($obj1); //CHECKME
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
			$criteria->addSelectColumn(InoIngresosSeaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InoIngresosSeaPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InoIngresosSeaPeer::CA_REFERENCIA, InoMaestraSeaPeer::CA_REFERENCIA);

		$criteria->addJoin(InoIngresosSeaPeer::CA_IDCLIENTE, ClientePeer::CA_IDCLIENTE);

		$rs = InoIngresosSeaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of InoIngresosSea objects pre-filled with all related objects.
	 *
	 * @return     array Array of InoIngresosSea objects.
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

		InoIngresosSeaPeer::addSelectColumns($c);
		$startcol2 = (InoIngresosSeaPeer::NUM_COLUMNS - InoIngresosSeaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		InoMaestraSeaPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + InoMaestraSeaPeer::NUM_COLUMNS;

		ClientePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ClientePeer::NUM_COLUMNS;

		$c->addJoin(InoIngresosSeaPeer::CA_REFERENCIA, InoMaestraSeaPeer::CA_REFERENCIA);

		$c->addJoin(InoIngresosSeaPeer::CA_IDCLIENTE, ClientePeer::CA_IDCLIENTE);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InoIngresosSeaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


				// Add objects for joined InoMaestraSea rows
	
			$omClass = InoMaestraSeaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getInoMaestraSea(); // CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addInoIngresosSea($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initInoIngresosSeas();
				$obj2->addInoIngresosSea($obj1);
			}


				// Add objects for joined Cliente rows
	
			$omClass = ClientePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getCliente(); // CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addInoIngresosSea($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj3->initInoIngresosSeas();
				$obj3->addInoIngresosSea($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related InoMaestraSea table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptInoMaestraSea(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InoIngresosSeaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InoIngresosSeaPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InoIngresosSeaPeer::CA_IDCLIENTE, ClientePeer::CA_IDCLIENTE);

		$rs = InoIngresosSeaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Cliente table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptCliente(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InoIngresosSeaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InoIngresosSeaPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InoIngresosSeaPeer::CA_REFERENCIA, InoMaestraSeaPeer::CA_REFERENCIA);

		$rs = InoIngresosSeaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of InoIngresosSea objects pre-filled with all related objects except InoMaestraSea.
	 *
	 * @return     array Array of InoIngresosSea objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptInoMaestraSea(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoIngresosSeaPeer::addSelectColumns($c);
		$startcol2 = (InoIngresosSeaPeer::NUM_COLUMNS - InoIngresosSeaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ClientePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ClientePeer::NUM_COLUMNS;

		$c->addJoin(InoIngresosSeaPeer::CA_IDCLIENTE, ClientePeer::CA_IDCLIENTE);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InoIngresosSeaPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ClientePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getCliente(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addInoIngresosSea($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initInoIngresosSeas();
				$obj2->addInoIngresosSea($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of InoIngresosSea objects pre-filled with all related objects except Cliente.
	 *
	 * @return     array Array of InoIngresosSea objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptCliente(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoIngresosSeaPeer::addSelectColumns($c);
		$startcol2 = (InoIngresosSeaPeer::NUM_COLUMNS - InoIngresosSeaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		InoMaestraSeaPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + InoMaestraSeaPeer::NUM_COLUMNS;

		$c->addJoin(InoIngresosSeaPeer::CA_REFERENCIA, InoMaestraSeaPeer::CA_REFERENCIA);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InoIngresosSeaPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = InoMaestraSeaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getInoMaestraSea(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addInoIngresosSea($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initInoIngresosSeas();
				$obj2->addInoIngresosSea($obj1);
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
		return InoIngresosSeaPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a InoIngresosSea or Criteria object.
	 *
	 * @param      mixed $values Criteria or InoIngresosSea object containing data that is used to create the INSERT statement.
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
			$criteria = $values->buildCriteria(); // build Criteria from InoIngresosSea object
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
	 * Method perform an UPDATE on the database, given a InoIngresosSea or Criteria object.
	 *
	 * @param      mixed $values Criteria or InoIngresosSea object containing data that is used to create the UPDATE statement.
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

			$comparison = $criteria->getComparison(InoIngresosSeaPeer::CA_REFERENCIA);
			$selectCriteria->add(InoIngresosSeaPeer::CA_REFERENCIA, $criteria->remove(InoIngresosSeaPeer::CA_REFERENCIA), $comparison);

			$comparison = $criteria->getComparison(InoIngresosSeaPeer::CA_IDCLIENTE);
			$selectCriteria->add(InoIngresosSeaPeer::CA_IDCLIENTE, $criteria->remove(InoIngresosSeaPeer::CA_IDCLIENTE), $comparison);

			$comparison = $criteria->getComparison(InoIngresosSeaPeer::CA_HBLS);
			$selectCriteria->add(InoIngresosSeaPeer::CA_HBLS, $criteria->remove(InoIngresosSeaPeer::CA_HBLS), $comparison);

			$comparison = $criteria->getComparison(InoIngresosSeaPeer::CA_FACTURA);
			$selectCriteria->add(InoIngresosSeaPeer::CA_FACTURA, $criteria->remove(InoIngresosSeaPeer::CA_FACTURA), $comparison);

		} else { // $values is InoIngresosSea object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the tb_inoingresos_sea table.
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
			$affectedRows += BasePeer::doDeleteAll(InoIngresosSeaPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a InoIngresosSea or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or InoIngresosSea object or primary key or array of primary keys
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
			$con = Propel::getConnection(InoIngresosSeaPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof InoIngresosSea) {

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
				$vals[2][] = $value[2];
				$vals[3][] = $value[3];
			}

			$criteria->add(InoIngresosSeaPeer::CA_REFERENCIA, $vals[0], Criteria::IN);
			$criteria->add(InoIngresosSeaPeer::CA_IDCLIENTE, $vals[1], Criteria::IN);
			$criteria->add(InoIngresosSeaPeer::CA_HBLS, $vals[2], Criteria::IN);
			$criteria->add(InoIngresosSeaPeer::CA_FACTURA, $vals[3], Criteria::IN);
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
	 * Validates all modified columns of given InoIngresosSea object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      InoIngresosSea $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(InoIngresosSea $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(InoIngresosSeaPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(InoIngresosSeaPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(InoIngresosSeaPeer::DATABASE_NAME, InoIngresosSeaPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = InoIngresosSeaPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	/**
	 * Retrieve object using using composite pkey values.
	 * @param string $ca_referencia
	   @param int $ca_idcliente
	   @param string $ca_hbls
	   @param string $ca_factura
	   
	 * @param      Connection $con
	 * @return     InoIngresosSea
	 */
	public static function retrieveByPK( $ca_referencia, $ca_idcliente, $ca_hbls, $ca_factura, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(InoIngresosSeaPeer::CA_REFERENCIA, $ca_referencia);
		$criteria->add(InoIngresosSeaPeer::CA_IDCLIENTE, $ca_idcliente);
		$criteria->add(InoIngresosSeaPeer::CA_HBLS, $ca_hbls);
		$criteria->add(InoIngresosSeaPeer::CA_FACTURA, $ca_factura);
		$v = InoIngresosSeaPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} // BaseInoIngresosSeaPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseInoIngresosSeaPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	Propel::registerMapBuilder('lib.model.sea.map.InoIngresosSeaMapBuilder');
}
