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
	const NUM_COLUMNS = 20;

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

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaFchreferencia', 'CaReferencia', 'CaImpoexpo', 'CaOrigen', 'CaDestino', 'CaModalidad', 'CaIdlinea', 'CaMawb', 'CaPiezas', 'CaPeso', 'CaPesovolumen', 'CaObservaciones', 'CaFchcreado', 'CaUsucreado', 'CaFchactualizado', 'CaUsuactualizado', 'CaFchliquidado', 'CaUsuliquidado', 'CaFchcerrado', 'CaUsucerrado', ),
		BasePeer::TYPE_COLNAME => array (InoMaestraAirPeer::CA_FCHREFERENCIA, InoMaestraAirPeer::CA_REFERENCIA, InoMaestraAirPeer::CA_IMPOEXPO, InoMaestraAirPeer::CA_ORIGEN, InoMaestraAirPeer::CA_DESTINO, InoMaestraAirPeer::CA_MODALIDAD, InoMaestraAirPeer::CA_IDLINEA, InoMaestraAirPeer::CA_MAWB, InoMaestraAirPeer::CA_PIEZAS, InoMaestraAirPeer::CA_PESO, InoMaestraAirPeer::CA_PESOVOLUMEN, InoMaestraAirPeer::CA_OBSERVACIONES, InoMaestraAirPeer::CA_FCHCREADO, InoMaestraAirPeer::CA_USUCREADO, InoMaestraAirPeer::CA_FCHACTUALIZADO, InoMaestraAirPeer::CA_USUACTUALIZADO, InoMaestraAirPeer::CA_FCHLIQUIDADO, InoMaestraAirPeer::CA_USULIQUIDADO, InoMaestraAirPeer::CA_FCHCERRADO, InoMaestraAirPeer::CA_USUCERRADO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_fchreferencia', 'ca_referencia', 'ca_impoexpo', 'ca_origen', 'ca_destino', 'ca_modalidad', 'ca_idlinea', 'ca_mawb', 'ca_piezas', 'ca_peso', 'ca_pesovolumen', 'ca_observaciones', 'ca_fchcreado', 'ca_usucreado', 'ca_fchactualizado', 'ca_usuactualizado', 'ca_fchliquidado', 'ca_usuliquidado', 'ca_fchcerrado', 'ca_usucerrado', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaFchreferencia' => 0, 'CaReferencia' => 1, 'CaImpoexpo' => 2, 'CaOrigen' => 3, 'CaDestino' => 4, 'CaModalidad' => 5, 'CaIdlinea' => 6, 'CaMawb' => 7, 'CaPiezas' => 8, 'CaPeso' => 9, 'CaPesovolumen' => 10, 'CaObservaciones' => 11, 'CaFchcreado' => 12, 'CaUsucreado' => 13, 'CaFchactualizado' => 14, 'CaUsuactualizado' => 15, 'CaFchliquidado' => 16, 'CaUsuliquidado' => 17, 'CaFchcerrado' => 18, 'CaUsucerrado' => 19, ),
		BasePeer::TYPE_COLNAME => array (InoMaestraAirPeer::CA_FCHREFERENCIA => 0, InoMaestraAirPeer::CA_REFERENCIA => 1, InoMaestraAirPeer::CA_IMPOEXPO => 2, InoMaestraAirPeer::CA_ORIGEN => 3, InoMaestraAirPeer::CA_DESTINO => 4, InoMaestraAirPeer::CA_MODALIDAD => 5, InoMaestraAirPeer::CA_IDLINEA => 6, InoMaestraAirPeer::CA_MAWB => 7, InoMaestraAirPeer::CA_PIEZAS => 8, InoMaestraAirPeer::CA_PESO => 9, InoMaestraAirPeer::CA_PESOVOLUMEN => 10, InoMaestraAirPeer::CA_OBSERVACIONES => 11, InoMaestraAirPeer::CA_FCHCREADO => 12, InoMaestraAirPeer::CA_USUCREADO => 13, InoMaestraAirPeer::CA_FCHACTUALIZADO => 14, InoMaestraAirPeer::CA_USUACTUALIZADO => 15, InoMaestraAirPeer::CA_FCHLIQUIDADO => 16, InoMaestraAirPeer::CA_USULIQUIDADO => 17, InoMaestraAirPeer::CA_FCHCERRADO => 18, InoMaestraAirPeer::CA_USUCERRADO => 19, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_fchreferencia' => 0, 'ca_referencia' => 1, 'ca_impoexpo' => 2, 'ca_origen' => 3, 'ca_destino' => 4, 'ca_modalidad' => 5, 'ca_idlinea' => 6, 'ca_mawb' => 7, 'ca_piezas' => 8, 'ca_peso' => 9, 'ca_pesovolumen' => 10, 'ca_observaciones' => 11, 'ca_fchcreado' => 12, 'ca_usucreado' => 13, 'ca_fchactualizado' => 14, 'ca_usuactualizado' => 15, 'ca_fchliquidado' => 16, 'ca_usuliquidado' => 17, 'ca_fchcerrado' => 18, 'ca_usucerrado' => 19, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('lib.model.air.map.InoMaestraAirMapBuilder');
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
			$map = InoMaestraAirPeer::getTableMap();
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

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_USUACTUALIZADO);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_FCHLIQUIDADO);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_USULIQUIDADO);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_FCHCERRADO);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_USUCERRADO);

	}

	const COUNT = 'COUNT(tb_inomaestra_air.CA_REFERENCIA)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT tb_inomaestra_air.CA_REFERENCIA)';

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
			$criteria->addSelectColumn(InoMaestraAirPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InoMaestraAirPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = InoMaestraAirPeer::doSelectRS($criteria, $con);
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
	 * @return     InoMaestraAir
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
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
	 * @param      Connection $con
	 * @return     array Array of selected Objects
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return InoMaestraAirPeer::populateObjects(InoMaestraAirPeer::doSelectRS($criteria, $con));
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
			InoMaestraAirPeer::addSelectColumns($criteria);
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
		$cls = InoMaestraAirPeer::getOMClass();
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
	 * Returns the number of rows matching criteria, joining the related Transportador table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinTransportador(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InoMaestraAirPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InoMaestraAirPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InoMaestraAirPeer::CA_IDLINEA, TransportadorPeer::CA_IDLINEA);

		$rs = InoMaestraAirPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of InoMaestraAir objects pre-filled with their Transportador objects.
	 *
	 * @return     array Array of InoMaestraAir objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinTransportador(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoMaestraAirPeer::addSelectColumns($c);
		$startcol = (InoMaestraAirPeer::NUM_COLUMNS - InoMaestraAirPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TransportadorPeer::addSelectColumns($c);

		$c->addJoin(InoMaestraAirPeer::CA_IDLINEA, TransportadorPeer::CA_IDLINEA);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InoMaestraAirPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TransportadorPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getTransportador(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addInoMaestraAir($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initInoMaestraAirs();
				$obj2->addInoMaestraAir($obj1); //CHECKME
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
			$criteria->addSelectColumn(InoMaestraAirPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InoMaestraAirPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InoMaestraAirPeer::CA_IDLINEA, TransportadorPeer::CA_IDLINEA);

		$rs = InoMaestraAirPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of InoMaestraAir objects pre-filled with all related objects.
	 *
	 * @return     array Array of InoMaestraAir objects.
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

		InoMaestraAirPeer::addSelectColumns($c);
		$startcol2 = (InoMaestraAirPeer::NUM_COLUMNS - InoMaestraAirPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TransportadorPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TransportadorPeer::NUM_COLUMNS;

		$c->addJoin(InoMaestraAirPeer::CA_IDLINEA, TransportadorPeer::CA_IDLINEA);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InoMaestraAirPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


				// Add objects for joined Transportador rows
	
			$omClass = TransportadorPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getTransportador(); // CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addInoMaestraAir($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initInoMaestraAirs();
				$obj2->addInoMaestraAir($obj1);
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
		return InoMaestraAirPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a InoMaestraAir or Criteria object.
	 *
	 * @param      mixed $values Criteria or InoMaestraAir object containing data that is used to create the INSERT statement.
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
			$criteria = $values->buildCriteria(); // build Criteria from InoMaestraAir object
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
	 * Method perform an UPDATE on the database, given a InoMaestraAir or Criteria object.
	 *
	 * @param      mixed $values Criteria or InoMaestraAir object containing data that is used to create the UPDATE statement.
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
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->begin();
			$affectedRows += BasePeer::doDeleteAll(InoMaestraAirPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a InoMaestraAir or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or InoMaestraAir object or primary key or array of primary keys
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
			$con = Propel::getConnection(InoMaestraAirPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof InoMaestraAir) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(InoMaestraAirPeer::CA_REFERENCIA, (array) $values, Criteria::IN);
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

			foreach($cols as $colName) {
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
	 * @return     InoMaestraAir
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
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
			$criteria->add(InoMaestraAirPeer::CA_REFERENCIA, $pks, Criteria::IN);
			$objs = InoMaestraAirPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseInoMaestraAirPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseInoMaestraAirPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	Propel::registerMapBuilder('lib.model.air.map.InoMaestraAirMapBuilder');
}
