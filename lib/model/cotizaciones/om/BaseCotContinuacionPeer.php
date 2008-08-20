<?php

/**
 * Base static class for performing query and update operations on the 'tb_cotcontinuacion' table.
 *
 * 
 *
 * @package    lib.model.cotizaciones.om
 */
abstract class BaseCotContinuacionPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'tb_cotcontinuacion';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.cotizaciones.CotContinuacion';

	/** The total number of columns. */
	const NUM_COLUMNS = 16;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the CA_IDCOTIZACION field */
	const CA_IDCOTIZACION = 'tb_cotcontinuacion.CA_IDCOTIZACION';

	/** the column name for the CA_TIPO field */
	const CA_TIPO = 'tb_cotcontinuacion.CA_TIPO';

	/** the column name for the CA_MODALIDAD field */
	const CA_MODALIDAD = 'tb_cotcontinuacion.CA_MODALIDAD';

	/** the column name for the CA_ORIGEN field */
	const CA_ORIGEN = 'tb_cotcontinuacion.CA_ORIGEN';

	/** the column name for the CA_DESTINO field */
	const CA_DESTINO = 'tb_cotcontinuacion.CA_DESTINO';

	/** the column name for the CA_IDCONCEPTO field */
	const CA_IDCONCEPTO = 'tb_cotcontinuacion.CA_IDCONCEPTO';

	/** the column name for the CA_IDMONEDA field */
	const CA_IDMONEDA = 'tb_cotcontinuacion.CA_IDMONEDA';

	/** the column name for the CA_IDEQUIPO field */
	const CA_IDEQUIPO = 'tb_cotcontinuacion.CA_IDEQUIPO';

	/** the column name for the CA_TARIFA field */
	const CA_TARIFA = 'tb_cotcontinuacion.CA_TARIFA';

	/** the column name for the CA_FRECUENCIA field */
	const CA_FRECUENCIA = 'tb_cotcontinuacion.CA_FRECUENCIA';

	/** the column name for the CA_TIEMPOTRANSITO field */
	const CA_TIEMPOTRANSITO = 'tb_cotcontinuacion.CA_TIEMPOTRANSITO';

	/** the column name for the CA_OBSERVACIONES field */
	const CA_OBSERVACIONES = 'tb_cotcontinuacion.CA_OBSERVACIONES';

	/** the column name for the CA_FCHCREADO field */
	const CA_FCHCREADO = 'tb_cotcontinuacion.CA_FCHCREADO';

	/** the column name for the CA_USUCREADO field */
	const CA_USUCREADO = 'tb_cotcontinuacion.CA_USUCREADO';

	/** the column name for the CA_FCHACTUALIZADO field */
	const CA_FCHACTUALIZADO = 'tb_cotcontinuacion.CA_FCHACTUALIZADO';

	/** the column name for the CA_USUACTUALIZADO field */
	const CA_USUACTUALIZADO = 'tb_cotcontinuacion.CA_USUACTUALIZADO';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdcotizacion', 'CaTipo', 'CaModalidad', 'CaOrigen', 'CaDestino', 'CaIdconcepto', 'CaIdmoneda', 'CaIdequipo', 'CaTarifa', 'CaFrecuencia', 'CaTiempotransito', 'CaObservaciones', 'CaFchcreado', 'CaUsucreado', 'CaFchactualizado', 'CaUsuactualizado', ),
		BasePeer::TYPE_COLNAME => array (CotContinuacionPeer::CA_IDCOTIZACION, CotContinuacionPeer::CA_TIPO, CotContinuacionPeer::CA_MODALIDAD, CotContinuacionPeer::CA_ORIGEN, CotContinuacionPeer::CA_DESTINO, CotContinuacionPeer::CA_IDCONCEPTO, CotContinuacionPeer::CA_IDMONEDA, CotContinuacionPeer::CA_IDEQUIPO, CotContinuacionPeer::CA_TARIFA, CotContinuacionPeer::CA_FRECUENCIA, CotContinuacionPeer::CA_TIEMPOTRANSITO, CotContinuacionPeer::CA_OBSERVACIONES, CotContinuacionPeer::CA_FCHCREADO, CotContinuacionPeer::CA_USUCREADO, CotContinuacionPeer::CA_FCHACTUALIZADO, CotContinuacionPeer::CA_USUACTUALIZADO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcotizacion', 'ca_tipo', 'ca_modalidad', 'ca_origen', 'ca_destino', 'ca_idconcepto', 'ca_idmoneda', 'ca_idequipo', 'ca_tarifa', 'ca_frecuencia', 'ca_tiempotransito', 'ca_observaciones', 'ca_fchcreado', 'ca_usucreado', 'ca_fchactualizado', 'ca_usuactualizado', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdcotizacion' => 0, 'CaTipo' => 1, 'CaModalidad' => 2, 'CaOrigen' => 3, 'CaDestino' => 4, 'CaIdconcepto' => 5, 'CaIdmoneda' => 6, 'CaIdequipo' => 7, 'CaTarifa' => 8, 'CaFrecuencia' => 9, 'CaTiempotransito' => 10, 'CaObservaciones' => 11, 'CaFchcreado' => 12, 'CaUsucreado' => 13, 'CaFchactualizado' => 14, 'CaUsuactualizado' => 15, ),
		BasePeer::TYPE_COLNAME => array (CotContinuacionPeer::CA_IDCOTIZACION => 0, CotContinuacionPeer::CA_TIPO => 1, CotContinuacionPeer::CA_MODALIDAD => 2, CotContinuacionPeer::CA_ORIGEN => 3, CotContinuacionPeer::CA_DESTINO => 4, CotContinuacionPeer::CA_IDCONCEPTO => 5, CotContinuacionPeer::CA_IDMONEDA => 6, CotContinuacionPeer::CA_IDEQUIPO => 7, CotContinuacionPeer::CA_TARIFA => 8, CotContinuacionPeer::CA_FRECUENCIA => 9, CotContinuacionPeer::CA_TIEMPOTRANSITO => 10, CotContinuacionPeer::CA_OBSERVACIONES => 11, CotContinuacionPeer::CA_FCHCREADO => 12, CotContinuacionPeer::CA_USUCREADO => 13, CotContinuacionPeer::CA_FCHACTUALIZADO => 14, CotContinuacionPeer::CA_USUACTUALIZADO => 15, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcotizacion' => 0, 'ca_tipo' => 1, 'ca_modalidad' => 2, 'ca_origen' => 3, 'ca_destino' => 4, 'ca_idconcepto' => 5, 'ca_idmoneda' => 6, 'ca_idequipo' => 7, 'ca_tarifa' => 8, 'ca_frecuencia' => 9, 'ca_tiempotransito' => 10, 'ca_observaciones' => 11, 'ca_fchcreado' => 12, 'ca_usucreado' => 13, 'ca_fchactualizado' => 14, 'ca_usuactualizado' => 15, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('lib.model.cotizaciones.map.CotContinuacionMapBuilder');
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
			$map = CotContinuacionPeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. CotContinuacionPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(CotContinuacionPeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(CotContinuacionPeer::CA_IDCOTIZACION);

		$criteria->addSelectColumn(CotContinuacionPeer::CA_TIPO);

		$criteria->addSelectColumn(CotContinuacionPeer::CA_MODALIDAD);

		$criteria->addSelectColumn(CotContinuacionPeer::CA_ORIGEN);

		$criteria->addSelectColumn(CotContinuacionPeer::CA_DESTINO);

		$criteria->addSelectColumn(CotContinuacionPeer::CA_IDCONCEPTO);

		$criteria->addSelectColumn(CotContinuacionPeer::CA_IDMONEDA);

		$criteria->addSelectColumn(CotContinuacionPeer::CA_IDEQUIPO);

		$criteria->addSelectColumn(CotContinuacionPeer::CA_TARIFA);

		$criteria->addSelectColumn(CotContinuacionPeer::CA_FRECUENCIA);

		$criteria->addSelectColumn(CotContinuacionPeer::CA_TIEMPOTRANSITO);

		$criteria->addSelectColumn(CotContinuacionPeer::CA_OBSERVACIONES);

		$criteria->addSelectColumn(CotContinuacionPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(CotContinuacionPeer::CA_USUCREADO);

		$criteria->addSelectColumn(CotContinuacionPeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(CotContinuacionPeer::CA_USUACTUALIZADO);

	}

	const COUNT = 'COUNT(tb_cotcontinuacion.CA_IDCOTIZACION)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT tb_cotcontinuacion.CA_IDCOTIZACION)';

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
			$criteria->addSelectColumn(CotContinuacionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CotContinuacionPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = CotContinuacionPeer::doSelectRS($criteria, $con);
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
	 * @return     CotContinuacion
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = CotContinuacionPeer::doSelect($critcopy, $con);
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
		return CotContinuacionPeer::populateObjects(CotContinuacionPeer::doSelectRS($criteria, $con));
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
			CotContinuacionPeer::addSelectColumns($criteria);
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
		$cls = CotContinuacionPeer::getOMClass();
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
			$criteria->addSelectColumn(CotContinuacionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CotContinuacionPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CotContinuacionPeer::CA_IDCOTIZACION, CotizacionPeer::CA_IDCOTIZACION);

		$rs = CotContinuacionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Concepto table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinConcepto(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CotContinuacionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CotContinuacionPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CotContinuacionPeer::CA_IDCONCEPTO, ConceptoPeer::CA_IDCONCEPTO);

		$rs = CotContinuacionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of CotContinuacion objects pre-filled with their Cotizacion objects.
	 *
	 * @return     array Array of CotContinuacion objects.
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

		CotContinuacionPeer::addSelectColumns($c);
		$startcol = (CotContinuacionPeer::NUM_COLUMNS - CotContinuacionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		CotizacionPeer::addSelectColumns($c);

		$c->addJoin(CotContinuacionPeer::CA_IDCOTIZACION, CotizacionPeer::CA_IDCOTIZACION);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CotContinuacionPeer::getOMClass();

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
					$temp_obj2->addCotContinuacion($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initCotContinuacions();
				$obj2->addCotContinuacion($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of CotContinuacion objects pre-filled with their Concepto objects.
	 *
	 * @return     array Array of CotContinuacion objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinConcepto(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotContinuacionPeer::addSelectColumns($c);
		$startcol = (CotContinuacionPeer::NUM_COLUMNS - CotContinuacionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ConceptoPeer::addSelectColumns($c);

		$c->addJoin(CotContinuacionPeer::CA_IDCONCEPTO, ConceptoPeer::CA_IDCONCEPTO);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CotContinuacionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ConceptoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getConcepto(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addCotContinuacion($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initCotContinuacions();
				$obj2->addCotContinuacion($obj1); //CHECKME
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
			$criteria->addSelectColumn(CotContinuacionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CotContinuacionPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CotContinuacionPeer::CA_IDCOTIZACION, CotizacionPeer::CA_IDCOTIZACION);

		$criteria->addJoin(CotContinuacionPeer::CA_IDCONCEPTO, ConceptoPeer::CA_IDCONCEPTO);

		$rs = CotContinuacionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of CotContinuacion objects pre-filled with all related objects.
	 *
	 * @return     array Array of CotContinuacion objects.
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

		CotContinuacionPeer::addSelectColumns($c);
		$startcol2 = (CotContinuacionPeer::NUM_COLUMNS - CotContinuacionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CotizacionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CotizacionPeer::NUM_COLUMNS;

		ConceptoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ConceptoPeer::NUM_COLUMNS;

		$c->addJoin(CotContinuacionPeer::CA_IDCOTIZACION, CotizacionPeer::CA_IDCOTIZACION);

		$c->addJoin(CotContinuacionPeer::CA_IDCONCEPTO, ConceptoPeer::CA_IDCONCEPTO);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CotContinuacionPeer::getOMClass();


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
					$temp_obj2->addCotContinuacion($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initCotContinuacions();
				$obj2->addCotContinuacion($obj1);
			}


				// Add objects for joined Concepto rows
	
			$omClass = ConceptoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getConcepto(); // CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addCotContinuacion($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj3->initCotContinuacions();
				$obj3->addCotContinuacion($obj1);
			}

			$results[] = $obj1;
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
	public static function doCountJoinAllExceptCotizacion(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CotContinuacionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CotContinuacionPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CotContinuacionPeer::CA_IDCONCEPTO, ConceptoPeer::CA_IDCONCEPTO);

		$rs = CotContinuacionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Concepto table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptConcepto(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CotContinuacionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CotContinuacionPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CotContinuacionPeer::CA_IDCOTIZACION, CotizacionPeer::CA_IDCOTIZACION);

		$rs = CotContinuacionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of CotContinuacion objects pre-filled with all related objects except Cotizacion.
	 *
	 * @return     array Array of CotContinuacion objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptCotizacion(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotContinuacionPeer::addSelectColumns($c);
		$startcol2 = (CotContinuacionPeer::NUM_COLUMNS - CotContinuacionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ConceptoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ConceptoPeer::NUM_COLUMNS;

		$c->addJoin(CotContinuacionPeer::CA_IDCONCEPTO, ConceptoPeer::CA_IDCONCEPTO);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CotContinuacionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ConceptoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getConcepto(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addCotContinuacion($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initCotContinuacions();
				$obj2->addCotContinuacion($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of CotContinuacion objects pre-filled with all related objects except Concepto.
	 *
	 * @return     array Array of CotContinuacion objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptConcepto(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotContinuacionPeer::addSelectColumns($c);
		$startcol2 = (CotContinuacionPeer::NUM_COLUMNS - CotContinuacionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CotizacionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CotizacionPeer::NUM_COLUMNS;

		$c->addJoin(CotContinuacionPeer::CA_IDCOTIZACION, CotizacionPeer::CA_IDCOTIZACION);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CotContinuacionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = CotizacionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getCotizacion(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addCotContinuacion($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initCotContinuacions();
				$obj2->addCotContinuacion($obj1);
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
		return CotContinuacionPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a CotContinuacion or Criteria object.
	 *
	 * @param      mixed $values Criteria or CotContinuacion object containing data that is used to create the INSERT statement.
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
			$criteria = $values->buildCriteria(); // build Criteria from CotContinuacion object
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
	 * Method perform an UPDATE on the database, given a CotContinuacion or Criteria object.
	 *
	 * @param      mixed $values Criteria or CotContinuacion object containing data that is used to create the UPDATE statement.
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

			$comparison = $criteria->getComparison(CotContinuacionPeer::CA_IDCOTIZACION);
			$selectCriteria->add(CotContinuacionPeer::CA_IDCOTIZACION, $criteria->remove(CotContinuacionPeer::CA_IDCOTIZACION), $comparison);

			$comparison = $criteria->getComparison(CotContinuacionPeer::CA_TIPO);
			$selectCriteria->add(CotContinuacionPeer::CA_TIPO, $criteria->remove(CotContinuacionPeer::CA_TIPO), $comparison);

			$comparison = $criteria->getComparison(CotContinuacionPeer::CA_ORIGEN);
			$selectCriteria->add(CotContinuacionPeer::CA_ORIGEN, $criteria->remove(CotContinuacionPeer::CA_ORIGEN), $comparison);

			$comparison = $criteria->getComparison(CotContinuacionPeer::CA_DESTINO);
			$selectCriteria->add(CotContinuacionPeer::CA_DESTINO, $criteria->remove(CotContinuacionPeer::CA_DESTINO), $comparison);

			$comparison = $criteria->getComparison(CotContinuacionPeer::CA_IDCONCEPTO);
			$selectCriteria->add(CotContinuacionPeer::CA_IDCONCEPTO, $criteria->remove(CotContinuacionPeer::CA_IDCONCEPTO), $comparison);

		} else { // $values is CotContinuacion object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the tb_cotcontinuacion table.
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
			$affectedRows += BasePeer::doDeleteAll(CotContinuacionPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a CotContinuacion or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or CotContinuacion object or primary key or array of primary keys
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
			$con = Propel::getConnection(CotContinuacionPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof CotContinuacion) {

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
				$vals[4][] = $value[4];
			}

			$criteria->add(CotContinuacionPeer::CA_IDCOTIZACION, $vals[0], Criteria::IN);
			$criteria->add(CotContinuacionPeer::CA_TIPO, $vals[1], Criteria::IN);
			$criteria->add(CotContinuacionPeer::CA_ORIGEN, $vals[2], Criteria::IN);
			$criteria->add(CotContinuacionPeer::CA_DESTINO, $vals[3], Criteria::IN);
			$criteria->add(CotContinuacionPeer::CA_IDCONCEPTO, $vals[4], Criteria::IN);
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
	 * Validates all modified columns of given CotContinuacion object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      CotContinuacion $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(CotContinuacion $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(CotContinuacionPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(CotContinuacionPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(CotContinuacionPeer::DATABASE_NAME, CotContinuacionPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = CotContinuacionPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	/**
	 * Retrieve object using using composite pkey values.
	 * @param int $ca_idcotizacion
	   @param string $ca_tipo
	   @param string $ca_origen
	   @param string $ca_destino
	   @param int $ca_idconcepto
	   
	 * @param      Connection $con
	 * @return     CotContinuacion
	 */
	public static function retrieveByPK( $ca_idcotizacion, $ca_tipo, $ca_origen, $ca_destino, $ca_idconcepto, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(CotContinuacionPeer::CA_IDCOTIZACION, $ca_idcotizacion);
		$criteria->add(CotContinuacionPeer::CA_TIPO, $ca_tipo);
		$criteria->add(CotContinuacionPeer::CA_ORIGEN, $ca_origen);
		$criteria->add(CotContinuacionPeer::CA_DESTINO, $ca_destino);
		$criteria->add(CotContinuacionPeer::CA_IDCONCEPTO, $ca_idconcepto);
		$v = CotContinuacionPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} // BaseCotContinuacionPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseCotContinuacionPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	Propel::registerMapBuilder('lib.model.cotizaciones.map.CotContinuacionMapBuilder');
}
