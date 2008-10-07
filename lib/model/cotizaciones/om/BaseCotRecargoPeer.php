<?php

/**
 * Base static class for performing query and update operations on the 'tb_cotrecargos' table.
 *
 * 
 *
 * @package    lib.model.cotizaciones.om
 */
abstract class BaseCotRecargoPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'tb_cotrecargos';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.cotizaciones.CotRecargo';

	/** The total number of columns. */
	const NUM_COLUMNS = 17;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the CA_IDCOTIZACION field */
	const CA_IDCOTIZACION = 'tb_cotrecargos.CA_IDCOTIZACION';

	/** the column name for the CA_IDPRODUCTO field */
	const CA_IDPRODUCTO = 'tb_cotrecargos.CA_IDPRODUCTO';

	/** the column name for the CA_IDOPCION field */
	const CA_IDOPCION = 'tb_cotrecargos.CA_IDOPCION';

	/** the column name for the CA_IDCONCEPTO field */
	const CA_IDCONCEPTO = 'tb_cotrecargos.CA_IDCONCEPTO';

	/** the column name for the CA_IDRECARGO field */
	const CA_IDRECARGO = 'tb_cotrecargos.CA_IDRECARGO';

	/** the column name for the CA_TIPO field */
	const CA_TIPO = 'tb_cotrecargos.CA_TIPO';

	/** the column name for the CA_VALOR_TAR field */
	const CA_VALOR_TAR = 'tb_cotrecargos.CA_VALOR_TAR';

	/** the column name for the CA_APLICA_TAR field */
	const CA_APLICA_TAR = 'tb_cotrecargos.CA_APLICA_TAR';

	/** the column name for the CA_VALOR_MIN field */
	const CA_VALOR_MIN = 'tb_cotrecargos.CA_VALOR_MIN';

	/** the column name for the CA_APLICA_MIN field */
	const CA_APLICA_MIN = 'tb_cotrecargos.CA_APLICA_MIN';

	/** the column name for the CA_IDMONEDA field */
	const CA_IDMONEDA = 'tb_cotrecargos.CA_IDMONEDA';

	/** the column name for the CA_MODALIDAD field */
	const CA_MODALIDAD = 'tb_cotrecargos.CA_MODALIDAD';

	/** the column name for the CA_OBSERVACIONES field */
	const CA_OBSERVACIONES = 'tb_cotrecargos.CA_OBSERVACIONES';

	/** the column name for the CA_FCHCREADO field */
	const CA_FCHCREADO = 'tb_cotrecargos.CA_FCHCREADO';

	/** the column name for the CA_USUCREADO field */
	const CA_USUCREADO = 'tb_cotrecargos.CA_USUCREADO';

	/** the column name for the CA_FCHACTUALIZADO field */
	const CA_FCHACTUALIZADO = 'tb_cotrecargos.CA_FCHACTUALIZADO';

	/** the column name for the CA_USUACTUALIZADO field */
	const CA_USUACTUALIZADO = 'tb_cotrecargos.CA_USUACTUALIZADO';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdcotizacion', 'CaIdproducto', 'CaIdopcion', 'CaIdconcepto', 'CaIdrecargo', 'CaTipo', 'CaValorTar', 'CaAplicaTar', 'CaValorMin', 'CaAplicaMin', 'CaIdmoneda', 'CaModalidad', 'CaObservaciones', 'CaFchcreado', 'CaUsucreado', 'CaFchactualizado', 'CaUsuactualizado', ),
		BasePeer::TYPE_COLNAME => array (CotRecargoPeer::CA_IDCOTIZACION, CotRecargoPeer::CA_IDPRODUCTO, CotRecargoPeer::CA_IDOPCION, CotRecargoPeer::CA_IDCONCEPTO, CotRecargoPeer::CA_IDRECARGO, CotRecargoPeer::CA_TIPO, CotRecargoPeer::CA_VALOR_TAR, CotRecargoPeer::CA_APLICA_TAR, CotRecargoPeer::CA_VALOR_MIN, CotRecargoPeer::CA_APLICA_MIN, CotRecargoPeer::CA_IDMONEDA, CotRecargoPeer::CA_MODALIDAD, CotRecargoPeer::CA_OBSERVACIONES, CotRecargoPeer::CA_FCHCREADO, CotRecargoPeer::CA_USUCREADO, CotRecargoPeer::CA_FCHACTUALIZADO, CotRecargoPeer::CA_USUACTUALIZADO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcotizacion', 'ca_idproducto', 'ca_idopcion', 'ca_idconcepto', 'ca_idrecargo', 'ca_tipo', 'ca_valor_tar', 'ca_aplica_tar', 'ca_valor_min', 'ca_aplica_min', 'ca_idmoneda', 'ca_modalidad', 'ca_observaciones', 'ca_fchcreado', 'ca_usucreado', 'ca_fchactualizado', 'ca_usuactualizado', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdcotizacion' => 0, 'CaIdproducto' => 1, 'CaIdopcion' => 2, 'CaIdconcepto' => 3, 'CaIdrecargo' => 4, 'CaTipo' => 5, 'CaValorTar' => 6, 'CaAplicaTar' => 7, 'CaValorMin' => 8, 'CaAplicaMin' => 9, 'CaIdmoneda' => 10, 'CaModalidad' => 11, 'CaObservaciones' => 12, 'CaFchcreado' => 13, 'CaUsucreado' => 14, 'CaFchactualizado' => 15, 'CaUsuactualizado' => 16, ),
		BasePeer::TYPE_COLNAME => array (CotRecargoPeer::CA_IDCOTIZACION => 0, CotRecargoPeer::CA_IDPRODUCTO => 1, CotRecargoPeer::CA_IDOPCION => 2, CotRecargoPeer::CA_IDCONCEPTO => 3, CotRecargoPeer::CA_IDRECARGO => 4, CotRecargoPeer::CA_TIPO => 5, CotRecargoPeer::CA_VALOR_TAR => 6, CotRecargoPeer::CA_APLICA_TAR => 7, CotRecargoPeer::CA_VALOR_MIN => 8, CotRecargoPeer::CA_APLICA_MIN => 9, CotRecargoPeer::CA_IDMONEDA => 10, CotRecargoPeer::CA_MODALIDAD => 11, CotRecargoPeer::CA_OBSERVACIONES => 12, CotRecargoPeer::CA_FCHCREADO => 13, CotRecargoPeer::CA_USUCREADO => 14, CotRecargoPeer::CA_FCHACTUALIZADO => 15, CotRecargoPeer::CA_USUACTUALIZADO => 16, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcotizacion' => 0, 'ca_idproducto' => 1, 'ca_idopcion' => 2, 'ca_idconcepto' => 3, 'ca_idrecargo' => 4, 'ca_tipo' => 5, 'ca_valor_tar' => 6, 'ca_aplica_tar' => 7, 'ca_valor_min' => 8, 'ca_aplica_min' => 9, 'ca_idmoneda' => 10, 'ca_modalidad' => 11, 'ca_observaciones' => 12, 'ca_fchcreado' => 13, 'ca_usucreado' => 14, 'ca_fchactualizado' => 15, 'ca_usuactualizado' => 16, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('lib.model.cotizaciones.map.CotRecargoMapBuilder');
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
			$map = CotRecargoPeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. CotRecargoPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(CotRecargoPeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(CotRecargoPeer::CA_IDCOTIZACION);

		$criteria->addSelectColumn(CotRecargoPeer::CA_IDPRODUCTO);

		$criteria->addSelectColumn(CotRecargoPeer::CA_IDOPCION);

		$criteria->addSelectColumn(CotRecargoPeer::CA_IDCONCEPTO);

		$criteria->addSelectColumn(CotRecargoPeer::CA_IDRECARGO);

		$criteria->addSelectColumn(CotRecargoPeer::CA_TIPO);

		$criteria->addSelectColumn(CotRecargoPeer::CA_VALOR_TAR);

		$criteria->addSelectColumn(CotRecargoPeer::CA_APLICA_TAR);

		$criteria->addSelectColumn(CotRecargoPeer::CA_VALOR_MIN);

		$criteria->addSelectColumn(CotRecargoPeer::CA_APLICA_MIN);

		$criteria->addSelectColumn(CotRecargoPeer::CA_IDMONEDA);

		$criteria->addSelectColumn(CotRecargoPeer::CA_MODALIDAD);

		$criteria->addSelectColumn(CotRecargoPeer::CA_OBSERVACIONES);

		$criteria->addSelectColumn(CotRecargoPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(CotRecargoPeer::CA_USUCREADO);

		$criteria->addSelectColumn(CotRecargoPeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(CotRecargoPeer::CA_USUACTUALIZADO);

	}

	const COUNT = 'COUNT(tb_cotrecargos.CA_IDCOTIZACION)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT tb_cotrecargos.CA_IDCOTIZACION)';

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
			$criteria->addSelectColumn(CotRecargoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CotRecargoPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = CotRecargoPeer::doSelectRS($criteria, $con);
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
	 * @return     CotRecargo
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = CotRecargoPeer::doSelect($critcopy, $con);
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
		return CotRecargoPeer::populateObjects(CotRecargoPeer::doSelectRS($criteria, $con));
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
			CotRecargoPeer::addSelectColumns($criteria);
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
		$cls = CotRecargoPeer::getOMClass();
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
	 * Returns the number of rows matching criteria, joining the related CotOpcion table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinCotOpcion(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CotRecargoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CotRecargoPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CotRecargoPeer::CA_IDOPCION, CotOpcionPeer::CA_IDOPCION);

		$rs = CotRecargoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related TipoRecargo table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinTipoRecargo(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CotRecargoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CotRecargoPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CotRecargoPeer::CA_IDRECARGO, TipoRecargoPeer::CA_IDRECARGO);

		$rs = CotRecargoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of CotRecargo objects pre-filled with their CotOpcion objects.
	 *
	 * @return     array Array of CotRecargo objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinCotOpcion(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotRecargoPeer::addSelectColumns($c);
		$startcol = (CotRecargoPeer::NUM_COLUMNS - CotRecargoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		CotOpcionPeer::addSelectColumns($c);

		$c->addJoin(CotRecargoPeer::CA_IDOPCION, CotOpcionPeer::CA_IDOPCION);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CotRecargoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = CotOpcionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getCotOpcion(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addCotRecargo($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initCotRecargos();
				$obj2->addCotRecargo($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of CotRecargo objects pre-filled with their TipoRecargo objects.
	 *
	 * @return     array Array of CotRecargo objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinTipoRecargo(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotRecargoPeer::addSelectColumns($c);
		$startcol = (CotRecargoPeer::NUM_COLUMNS - CotRecargoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TipoRecargoPeer::addSelectColumns($c);

		$c->addJoin(CotRecargoPeer::CA_IDRECARGO, TipoRecargoPeer::CA_IDRECARGO);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CotRecargoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TipoRecargoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getTipoRecargo(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addCotRecargo($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initCotRecargos();
				$obj2->addCotRecargo($obj1); //CHECKME
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
			$criteria->addSelectColumn(CotRecargoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CotRecargoPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CotRecargoPeer::CA_IDOPCION, CotOpcionPeer::CA_IDOPCION);

		$criteria->addJoin(CotRecargoPeer::CA_IDRECARGO, TipoRecargoPeer::CA_IDRECARGO);

		$rs = CotRecargoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of CotRecargo objects pre-filled with all related objects.
	 *
	 * @return     array Array of CotRecargo objects.
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

		CotRecargoPeer::addSelectColumns($c);
		$startcol2 = (CotRecargoPeer::NUM_COLUMNS - CotRecargoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CotOpcionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CotOpcionPeer::NUM_COLUMNS;

		TipoRecargoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + TipoRecargoPeer::NUM_COLUMNS;

		$c->addJoin(CotRecargoPeer::CA_IDOPCION, CotOpcionPeer::CA_IDOPCION);

		$c->addJoin(CotRecargoPeer::CA_IDRECARGO, TipoRecargoPeer::CA_IDRECARGO);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CotRecargoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


				// Add objects for joined CotOpcion rows
	
			$omClass = CotOpcionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getCotOpcion(); // CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addCotRecargo($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initCotRecargos();
				$obj2->addCotRecargo($obj1);
			}


				// Add objects for joined TipoRecargo rows
	
			$omClass = TipoRecargoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getTipoRecargo(); // CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addCotRecargo($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj3->initCotRecargos();
				$obj3->addCotRecargo($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related CotOpcion table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptCotOpcion(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CotRecargoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CotRecargoPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CotRecargoPeer::CA_IDRECARGO, TipoRecargoPeer::CA_IDRECARGO);

		$rs = CotRecargoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related TipoRecargo table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptTipoRecargo(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CotRecargoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CotRecargoPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CotRecargoPeer::CA_IDOPCION, CotOpcionPeer::CA_IDOPCION);

		$rs = CotRecargoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of CotRecargo objects pre-filled with all related objects except CotOpcion.
	 *
	 * @return     array Array of CotRecargo objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptCotOpcion(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotRecargoPeer::addSelectColumns($c);
		$startcol2 = (CotRecargoPeer::NUM_COLUMNS - CotRecargoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TipoRecargoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TipoRecargoPeer::NUM_COLUMNS;

		$c->addJoin(CotRecargoPeer::CA_IDRECARGO, TipoRecargoPeer::CA_IDRECARGO);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CotRecargoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TipoRecargoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getTipoRecargo(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addCotRecargo($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initCotRecargos();
				$obj2->addCotRecargo($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of CotRecargo objects pre-filled with all related objects except TipoRecargo.
	 *
	 * @return     array Array of CotRecargo objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptTipoRecargo(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotRecargoPeer::addSelectColumns($c);
		$startcol2 = (CotRecargoPeer::NUM_COLUMNS - CotRecargoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CotOpcionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CotOpcionPeer::NUM_COLUMNS;

		$c->addJoin(CotRecargoPeer::CA_IDOPCION, CotOpcionPeer::CA_IDOPCION);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CotRecargoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = CotOpcionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getCotOpcion(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addCotRecargo($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initCotRecargos();
				$obj2->addCotRecargo($obj1);
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
		return CotRecargoPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a CotRecargo or Criteria object.
	 *
	 * @param      mixed $values Criteria or CotRecargo object containing data that is used to create the INSERT statement.
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
			$criteria = $values->buildCriteria(); // build Criteria from CotRecargo object
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
	 * Method perform an UPDATE on the database, given a CotRecargo or Criteria object.
	 *
	 * @param      mixed $values Criteria or CotRecargo object containing data that is used to create the UPDATE statement.
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

			$comparison = $criteria->getComparison(CotRecargoPeer::CA_IDCOTIZACION);
			$selectCriteria->add(CotRecargoPeer::CA_IDCOTIZACION, $criteria->remove(CotRecargoPeer::CA_IDCOTIZACION), $comparison);

			$comparison = $criteria->getComparison(CotRecargoPeer::CA_IDPRODUCTO);
			$selectCriteria->add(CotRecargoPeer::CA_IDPRODUCTO, $criteria->remove(CotRecargoPeer::CA_IDPRODUCTO), $comparison);

			$comparison = $criteria->getComparison(CotRecargoPeer::CA_IDOPCION);
			$selectCriteria->add(CotRecargoPeer::CA_IDOPCION, $criteria->remove(CotRecargoPeer::CA_IDOPCION), $comparison);

			$comparison = $criteria->getComparison(CotRecargoPeer::CA_IDCONCEPTO);
			$selectCriteria->add(CotRecargoPeer::CA_IDCONCEPTO, $criteria->remove(CotRecargoPeer::CA_IDCONCEPTO), $comparison);

			$comparison = $criteria->getComparison(CotRecargoPeer::CA_IDRECARGO);
			$selectCriteria->add(CotRecargoPeer::CA_IDRECARGO, $criteria->remove(CotRecargoPeer::CA_IDRECARGO), $comparison);

			$comparison = $criteria->getComparison(CotRecargoPeer::CA_MODALIDAD);
			$selectCriteria->add(CotRecargoPeer::CA_MODALIDAD, $criteria->remove(CotRecargoPeer::CA_MODALIDAD), $comparison);

		} else { // $values is CotRecargo object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the tb_cotrecargos table.
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
			$affectedRows += BasePeer::doDeleteAll(CotRecargoPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a CotRecargo or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or CotRecargo object or primary key or array of primary keys
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
			$con = Propel::getConnection(CotRecargoPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof CotRecargo) {

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
				$vals[5][] = $value[5];
			}

			$criteria->add(CotRecargoPeer::CA_IDCOTIZACION, $vals[0], Criteria::IN);
			$criteria->add(CotRecargoPeer::CA_IDPRODUCTO, $vals[1], Criteria::IN);
			$criteria->add(CotRecargoPeer::CA_IDOPCION, $vals[2], Criteria::IN);
			$criteria->add(CotRecargoPeer::CA_IDCONCEPTO, $vals[3], Criteria::IN);
			$criteria->add(CotRecargoPeer::CA_IDRECARGO, $vals[4], Criteria::IN);
			$criteria->add(CotRecargoPeer::CA_MODALIDAD, $vals[5], Criteria::IN);
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
	 * Validates all modified columns of given CotRecargo object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      CotRecargo $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(CotRecargo $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(CotRecargoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(CotRecargoPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(CotRecargoPeer::DATABASE_NAME, CotRecargoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = CotRecargoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	/**
	 * Retrieve object using using composite pkey values.
	 * @param int $ca_idcotizacion
	   @param int $ca_idproducto
	   @param int $ca_idopcion
	   @param int $ca_idconcepto
	   @param int $ca_idrecargo
	   @param string $ca_modalidad
	   
	 * @param      Connection $con
	 * @return     CotRecargo
	 */
	public static function retrieveByPK( $ca_idcotizacion, $ca_idproducto, $ca_idopcion, $ca_idconcepto, $ca_idrecargo, $ca_modalidad, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(CotRecargoPeer::CA_IDCOTIZACION, $ca_idcotizacion);
		$criteria->add(CotRecargoPeer::CA_IDPRODUCTO, $ca_idproducto);
		$criteria->add(CotRecargoPeer::CA_IDOPCION, $ca_idopcion);
		$criteria->add(CotRecargoPeer::CA_IDCONCEPTO, $ca_idconcepto);
		$criteria->add(CotRecargoPeer::CA_IDRECARGO, $ca_idrecargo);
		$criteria->add(CotRecargoPeer::CA_MODALIDAD, $ca_modalidad);
		$v = CotRecargoPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} // BaseCotRecargoPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseCotRecargoPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	Propel::registerMapBuilder('lib.model.cotizaciones.map.CotRecargoMapBuilder');
}
