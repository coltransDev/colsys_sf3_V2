<?php

/**
 * Base static class for performing query and update operations on the 'tb_cotopciones' table.
 *
 * 
 *
 * @package    lib.model.cotizaciones.om
 */
abstract class BaseCotOpcionPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'tb_cotopciones';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.cotizaciones.CotOpcion';

	/** The total number of columns. */
	const NUM_COLUMNS = 17;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the CA_IDOPCION field */
	const CA_IDOPCION = 'tb_cotopciones.CA_IDOPCION';

	/** the column name for the CA_IDCOTIZACION field */
	const CA_IDCOTIZACION = 'tb_cotopciones.CA_IDCOTIZACION';

	/** the column name for the CA_IDPRODUCTO field */
	const CA_IDPRODUCTO = 'tb_cotopciones.CA_IDPRODUCTO';

	/** the column name for the CA_IDCONCEPTO field */
	const CA_IDCONCEPTO = 'tb_cotopciones.CA_IDCONCEPTO';

	/** the column name for the CA_VALOR_TAR field */
	const CA_VALOR_TAR = 'tb_cotopciones.CA_VALOR_TAR';

	/** the column name for the CA_APLICA_TAR field */
	const CA_APLICA_TAR = 'tb_cotopciones.CA_APLICA_TAR';

	/** the column name for the CA_VALOR_MIN field */
	const CA_VALOR_MIN = 'tb_cotopciones.CA_VALOR_MIN';

	/** the column name for the CA_APLICA_MIN field */
	const CA_APLICA_MIN = 'tb_cotopciones.CA_APLICA_MIN';

	/** the column name for the CA_IDMONEDA field */
	const CA_IDMONEDA = 'tb_cotopciones.CA_IDMONEDA';

	/** the column name for the CA_TARIFA field */
	const CA_TARIFA = 'tb_cotopciones.CA_TARIFA';

	/** the column name for the CA_OFERTA field */
	const CA_OFERTA = 'tb_cotopciones.CA_OFERTA';

	/** the column name for the CA_RECARGOS field */
	const CA_RECARGOS = 'tb_cotopciones.CA_RECARGOS';

	/** the column name for the CA_OBSERVACIONES field */
	const CA_OBSERVACIONES = 'tb_cotopciones.CA_OBSERVACIONES';

	/** the column name for the CA_FCHCREADO field */
	const CA_FCHCREADO = 'tb_cotopciones.CA_FCHCREADO';

	/** the column name for the CA_USUCREADO field */
	const CA_USUCREADO = 'tb_cotopciones.CA_USUCREADO';

	/** the column name for the CA_FCHACTUALIZADO field */
	const CA_FCHACTUALIZADO = 'tb_cotopciones.CA_FCHACTUALIZADO';

	/** the column name for the CA_USUACTUALIZADO field */
	const CA_USUACTUALIZADO = 'tb_cotopciones.CA_USUACTUALIZADO';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdopcion', 'CaIdcotizacion', 'CaIdproducto', 'CaIdconcepto', 'CaValorTar', 'CaAplicaTar', 'CaValorMin', 'CaAplicaMin', 'CaIdmoneda', 'CaTarifa', 'CaOferta', 'CaRecargos', 'CaObservaciones', 'CaFchcreado', 'CaUsucreado', 'CaFchactualizado', 'CaUsuactualizado', ),
		BasePeer::TYPE_COLNAME => array (CotOpcionPeer::CA_IDOPCION, CotOpcionPeer::CA_IDCOTIZACION, CotOpcionPeer::CA_IDPRODUCTO, CotOpcionPeer::CA_IDCONCEPTO, CotOpcionPeer::CA_VALOR_TAR, CotOpcionPeer::CA_APLICA_TAR, CotOpcionPeer::CA_VALOR_MIN, CotOpcionPeer::CA_APLICA_MIN, CotOpcionPeer::CA_IDMONEDA, CotOpcionPeer::CA_TARIFA, CotOpcionPeer::CA_OFERTA, CotOpcionPeer::CA_RECARGOS, CotOpcionPeer::CA_OBSERVACIONES, CotOpcionPeer::CA_FCHCREADO, CotOpcionPeer::CA_USUCREADO, CotOpcionPeer::CA_FCHACTUALIZADO, CotOpcionPeer::CA_USUACTUALIZADO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idopcion', 'ca_idcotizacion', 'ca_idproducto', 'ca_idconcepto', 'ca_valor_tar', 'ca_aplica_tar', 'ca_valor_min', 'ca_aplica_min', 'ca_idmoneda', 'ca_tarifa', 'ca_oferta', 'ca_recargos', 'ca_observaciones', 'ca_fchcreado', 'ca_usucreado', 'ca_fchactualizado', 'ca_usuactualizado', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdopcion' => 0, 'CaIdcotizacion' => 1, 'CaIdproducto' => 2, 'CaIdconcepto' => 3, 'CaValorTar' => 4, 'CaAplicaTar' => 5, 'CaValorMin' => 6, 'CaAplicaMin' => 7, 'CaIdmoneda' => 8, 'CaTarifa' => 9, 'CaOferta' => 10, 'CaRecargos' => 11, 'CaObservaciones' => 12, 'CaFchcreado' => 13, 'CaUsucreado' => 14, 'CaFchactualizado' => 15, 'CaUsuactualizado' => 16, ),
		BasePeer::TYPE_COLNAME => array (CotOpcionPeer::CA_IDOPCION => 0, CotOpcionPeer::CA_IDCOTIZACION => 1, CotOpcionPeer::CA_IDPRODUCTO => 2, CotOpcionPeer::CA_IDCONCEPTO => 3, CotOpcionPeer::CA_VALOR_TAR => 4, CotOpcionPeer::CA_APLICA_TAR => 5, CotOpcionPeer::CA_VALOR_MIN => 6, CotOpcionPeer::CA_APLICA_MIN => 7, CotOpcionPeer::CA_IDMONEDA => 8, CotOpcionPeer::CA_TARIFA => 9, CotOpcionPeer::CA_OFERTA => 10, CotOpcionPeer::CA_RECARGOS => 11, CotOpcionPeer::CA_OBSERVACIONES => 12, CotOpcionPeer::CA_FCHCREADO => 13, CotOpcionPeer::CA_USUCREADO => 14, CotOpcionPeer::CA_FCHACTUALIZADO => 15, CotOpcionPeer::CA_USUACTUALIZADO => 16, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idopcion' => 0, 'ca_idcotizacion' => 1, 'ca_idproducto' => 2, 'ca_idconcepto' => 3, 'ca_valor_tar' => 4, 'ca_aplica_tar' => 5, 'ca_valor_min' => 6, 'ca_aplica_min' => 7, 'ca_idmoneda' => 8, 'ca_tarifa' => 9, 'ca_oferta' => 10, 'ca_recargos' => 11, 'ca_observaciones' => 12, 'ca_fchcreado' => 13, 'ca_usucreado' => 14, 'ca_fchactualizado' => 15, 'ca_usuactualizado' => 16, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('lib.model.cotizaciones.map.CotOpcionMapBuilder');
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
			$map = CotOpcionPeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. CotOpcionPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(CotOpcionPeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(CotOpcionPeer::CA_IDOPCION);

		$criteria->addSelectColumn(CotOpcionPeer::CA_IDCOTIZACION);

		$criteria->addSelectColumn(CotOpcionPeer::CA_IDPRODUCTO);

		$criteria->addSelectColumn(CotOpcionPeer::CA_IDCONCEPTO);

		$criteria->addSelectColumn(CotOpcionPeer::CA_VALOR_TAR);

		$criteria->addSelectColumn(CotOpcionPeer::CA_APLICA_TAR);

		$criteria->addSelectColumn(CotOpcionPeer::CA_VALOR_MIN);

		$criteria->addSelectColumn(CotOpcionPeer::CA_APLICA_MIN);

		$criteria->addSelectColumn(CotOpcionPeer::CA_IDMONEDA);

		$criteria->addSelectColumn(CotOpcionPeer::CA_TARIFA);

		$criteria->addSelectColumn(CotOpcionPeer::CA_OFERTA);

		$criteria->addSelectColumn(CotOpcionPeer::CA_RECARGOS);

		$criteria->addSelectColumn(CotOpcionPeer::CA_OBSERVACIONES);

		$criteria->addSelectColumn(CotOpcionPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(CotOpcionPeer::CA_USUCREADO);

		$criteria->addSelectColumn(CotOpcionPeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(CotOpcionPeer::CA_USUACTUALIZADO);

	}

	const COUNT = 'COUNT(tb_cotopciones.CA_IDOPCION)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT tb_cotopciones.CA_IDOPCION)';

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
			$criteria->addSelectColumn(CotOpcionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CotOpcionPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = CotOpcionPeer::doSelectRS($criteria, $con);
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
	 * @return     CotOpcion
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = CotOpcionPeer::doSelect($critcopy, $con);
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
		return CotOpcionPeer::populateObjects(CotOpcionPeer::doSelectRS($criteria, $con));
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
			CotOpcionPeer::addSelectColumns($criteria);
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
		$cls = CotOpcionPeer::getOMClass();
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
	 * Returns the number of rows matching criteria, joining the related CotProducto table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinCotProducto(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CotOpcionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CotOpcionPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CotOpcionPeer::CA_IDPRODUCTO, CotProductoPeer::CA_IDPRODUCTO);

		$criteria->addJoin(CotOpcionPeer::CA_IDCOTIZACION, CotProductoPeer::CA_IDCOTIZACION);

		$rs = CotOpcionPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(CotOpcionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CotOpcionPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CotOpcionPeer::CA_IDCONCEPTO, ConceptoPeer::CA_IDCONCEPTO);

		$rs = CotOpcionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of CotOpcion objects pre-filled with their CotProducto objects.
	 *
	 * @return     array Array of CotOpcion objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinCotProducto(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotOpcionPeer::addSelectColumns($c);
		$startcol = (CotOpcionPeer::NUM_COLUMNS - CotOpcionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		CotProductoPeer::addSelectColumns($c);

		$c->addJoin(CotOpcionPeer::CA_IDPRODUCTO, CotProductoPeer::CA_IDPRODUCTO);
		$c->addJoin(CotOpcionPeer::CA_IDCOTIZACION, CotProductoPeer::CA_IDCOTIZACION);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CotOpcionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = CotProductoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getCotProducto(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addCotOpcion($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initCotOpcions();
				$obj2->addCotOpcion($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of CotOpcion objects pre-filled with their Concepto objects.
	 *
	 * @return     array Array of CotOpcion objects.
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

		CotOpcionPeer::addSelectColumns($c);
		$startcol = (CotOpcionPeer::NUM_COLUMNS - CotOpcionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ConceptoPeer::addSelectColumns($c);

		$c->addJoin(CotOpcionPeer::CA_IDCONCEPTO, ConceptoPeer::CA_IDCONCEPTO);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CotOpcionPeer::getOMClass();

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
					$temp_obj2->addCotOpcion($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initCotOpcions();
				$obj2->addCotOpcion($obj1); //CHECKME
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
			$criteria->addSelectColumn(CotOpcionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CotOpcionPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CotOpcionPeer::CA_IDPRODUCTO, CotProductoPeer::CA_IDPRODUCTO);

		$criteria->addJoin(CotOpcionPeer::CA_IDCOTIZACION, CotProductoPeer::CA_IDCOTIZACION);

		$criteria->addJoin(CotOpcionPeer::CA_IDCONCEPTO, ConceptoPeer::CA_IDCONCEPTO);

		$rs = CotOpcionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of CotOpcion objects pre-filled with all related objects.
	 *
	 * @return     array Array of CotOpcion objects.
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

		CotOpcionPeer::addSelectColumns($c);
		$startcol2 = (CotOpcionPeer::NUM_COLUMNS - CotOpcionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CotProductoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CotProductoPeer::NUM_COLUMNS;

		ConceptoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ConceptoPeer::NUM_COLUMNS;

		$c->addJoin(CotOpcionPeer::CA_IDPRODUCTO, CotProductoPeer::CA_IDPRODUCTO);

		$c->addJoin(CotOpcionPeer::CA_IDCOTIZACION, CotProductoPeer::CA_IDCOTIZACION);

		$c->addJoin(CotOpcionPeer::CA_IDCONCEPTO, ConceptoPeer::CA_IDCONCEPTO);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CotOpcionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


				// Add objects for joined CotProducto rows
	
			$omClass = CotProductoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getCotProducto(); // CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addCotOpcion($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initCotOpcions();
				$obj2->addCotOpcion($obj1);
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
					$temp_obj3->addCotOpcion($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj3->initCotOpcions();
				$obj3->addCotOpcion($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related CotProducto table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptCotProducto(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CotOpcionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CotOpcionPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CotOpcionPeer::CA_IDCONCEPTO, ConceptoPeer::CA_IDCONCEPTO);

		$rs = CotOpcionPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(CotOpcionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CotOpcionPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CotOpcionPeer::CA_IDPRODUCTO, CotProductoPeer::CA_IDPRODUCTO);

		$criteria->addJoin(CotOpcionPeer::CA_IDCOTIZACION, CotProductoPeer::CA_IDCOTIZACION);

		$rs = CotOpcionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of CotOpcion objects pre-filled with all related objects except CotProducto.
	 *
	 * @return     array Array of CotOpcion objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptCotProducto(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotOpcionPeer::addSelectColumns($c);
		$startcol2 = (CotOpcionPeer::NUM_COLUMNS - CotOpcionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ConceptoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ConceptoPeer::NUM_COLUMNS;

		$c->addJoin(CotOpcionPeer::CA_IDCONCEPTO, ConceptoPeer::CA_IDCONCEPTO);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CotOpcionPeer::getOMClass();

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
					$temp_obj2->addCotOpcion($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initCotOpcions();
				$obj2->addCotOpcion($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of CotOpcion objects pre-filled with all related objects except Concepto.
	 *
	 * @return     array Array of CotOpcion objects.
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

		CotOpcionPeer::addSelectColumns($c);
		$startcol2 = (CotOpcionPeer::NUM_COLUMNS - CotOpcionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CotProductoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CotProductoPeer::NUM_COLUMNS;

		$c->addJoin(CotOpcionPeer::CA_IDPRODUCTO, CotProductoPeer::CA_IDPRODUCTO);

		$c->addJoin(CotOpcionPeer::CA_IDCOTIZACION, CotProductoPeer::CA_IDCOTIZACION);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CotOpcionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = CotProductoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getCotProducto(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addCotOpcion($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initCotOpcions();
				$obj2->addCotOpcion($obj1);
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
		return CotOpcionPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a CotOpcion or Criteria object.
	 *
	 * @param      mixed $values Criteria or CotOpcion object containing data that is used to create the INSERT statement.
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
			$criteria = $values->buildCriteria(); // build Criteria from CotOpcion object
		}

		$criteria->remove(CotOpcionPeer::CA_IDOPCION); // remove pkey col since this table uses auto-increment


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
	 * Method perform an UPDATE on the database, given a CotOpcion or Criteria object.
	 *
	 * @param      mixed $values Criteria or CotOpcion object containing data that is used to create the UPDATE statement.
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

			$comparison = $criteria->getComparison(CotOpcionPeer::CA_IDOPCION);
			$selectCriteria->add(CotOpcionPeer::CA_IDOPCION, $criteria->remove(CotOpcionPeer::CA_IDOPCION), $comparison);

			$comparison = $criteria->getComparison(CotOpcionPeer::CA_IDCOTIZACION);
			$selectCriteria->add(CotOpcionPeer::CA_IDCOTIZACION, $criteria->remove(CotOpcionPeer::CA_IDCOTIZACION), $comparison);

			$comparison = $criteria->getComparison(CotOpcionPeer::CA_IDPRODUCTO);
			$selectCriteria->add(CotOpcionPeer::CA_IDPRODUCTO, $criteria->remove(CotOpcionPeer::CA_IDPRODUCTO), $comparison);

		} else { // $values is CotOpcion object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the tb_cotopciones table.
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
			$affectedRows += BasePeer::doDeleteAll(CotOpcionPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a CotOpcion or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or CotOpcion object or primary key or array of primary keys
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
			$con = Propel::getConnection(CotOpcionPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof CotOpcion) {

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
			}

			$criteria->add(CotOpcionPeer::CA_IDOPCION, $vals[0], Criteria::IN);
			$criteria->add(CotOpcionPeer::CA_IDCOTIZACION, $vals[1], Criteria::IN);
			$criteria->add(CotOpcionPeer::CA_IDPRODUCTO, $vals[2], Criteria::IN);
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
	 * Validates all modified columns of given CotOpcion object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      CotOpcion $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(CotOpcion $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(CotOpcionPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(CotOpcionPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(CotOpcionPeer::DATABASE_NAME, CotOpcionPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = CotOpcionPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	/**
	 * Retrieve object using using composite pkey values.
	 * @param string $ca_idopcion
	   @param int $ca_idcotizacion
	   @param int $ca_idproducto
	   
	 * @param      Connection $con
	 * @return     CotOpcion
	 */
	public static function retrieveByPK( $ca_idopcion, $ca_idcotizacion, $ca_idproducto, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(CotOpcionPeer::CA_IDOPCION, $ca_idopcion);
		$criteria->add(CotOpcionPeer::CA_IDCOTIZACION, $ca_idcotizacion);
		$criteria->add(CotOpcionPeer::CA_IDPRODUCTO, $ca_idproducto);
		$v = CotOpcionPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} // BaseCotOpcionPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseCotOpcionPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	Propel::registerMapBuilder('lib.model.cotizaciones.map.CotOpcionMapBuilder');
}
