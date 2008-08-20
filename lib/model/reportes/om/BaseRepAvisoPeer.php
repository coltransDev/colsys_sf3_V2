<?php

/**
 * Base static class for performing query and update operations on the 'tb_repavisos' table.
 *
 * 
 *
 * @package    lib.model.reportes.om
 */
abstract class BaseRepAvisoPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'tb_repavisos';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.reportes.RepAviso';

	/** The total number of columns. */
	const NUM_COLUMNS = 19;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the CA_IDREPORTE field */
	const CA_IDREPORTE = 'tb_repavisos.CA_IDREPORTE';

	/** the column name for the CA_IDEMAIL field */
	const CA_IDEMAIL = 'tb_repavisos.CA_IDEMAIL';

	/** the column name for the CA_INTRODUCCION field */
	const CA_INTRODUCCION = 'tb_repavisos.CA_INTRODUCCION';

	/** the column name for the CA_FCHSALIDA field */
	const CA_FCHSALIDA = 'tb_repavisos.CA_FCHSALIDA';

	/** the column name for the CA_FCHLLEGADA field */
	const CA_FCHLLEGADA = 'tb_repavisos.CA_FCHLLEGADA';

	/** the column name for the CA_FCHCONTINUACION field */
	const CA_FCHCONTINUACION = 'tb_repavisos.CA_FCHCONTINUACION';

	/** the column name for the CA_PIEZAS field */
	const CA_PIEZAS = 'tb_repavisos.CA_PIEZAS';

	/** the column name for the CA_PESO field */
	const CA_PESO = 'tb_repavisos.CA_PESO';

	/** the column name for the CA_VOLUMEN field */
	const CA_VOLUMEN = 'tb_repavisos.CA_VOLUMEN';

	/** the column name for the CA_FCHENVIO field */
	const CA_FCHENVIO = 'tb_repavisos.CA_FCHENVIO';

	/** the column name for the CA_USUENVIO field */
	const CA_USUENVIO = 'tb_repavisos.CA_USUENVIO';

	/** the column name for the CA_DOCTRANSPORTE field */
	const CA_DOCTRANSPORTE = 'tb_repavisos.CA_DOCTRANSPORTE';

	/** the column name for the CA_IDNAVE field */
	const CA_IDNAVE = 'tb_repavisos.CA_IDNAVE';

	/** the column name for the CA_NOTAS field */
	const CA_NOTAS = 'tb_repavisos.CA_NOTAS';

	/** the column name for the CA_ETAPA field */
	const CA_ETAPA = 'tb_repavisos.CA_ETAPA';

	/** the column name for the CA_DOCMASTER field */
	const CA_DOCMASTER = 'tb_repavisos.CA_DOCMASTER';

	/** the column name for the CA_EQUIPOS field */
	const CA_EQUIPOS = 'tb_repavisos.CA_EQUIPOS';

	/** the column name for the CA_HORASALIDA field */
	const CA_HORASALIDA = 'tb_repavisos.CA_HORASALIDA';

	/** the column name for the CA_TIPO field */
	const CA_TIPO = 'tb_repavisos.CA_TIPO';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdreporte', 'CaIdemail', 'CaIntroduccion', 'CaFchsalida', 'CaFchllegada', 'CaFchcontinuacion', 'CaPiezas', 'CaPeso', 'CaVolumen', 'CaFchenvio', 'CaUsuenvio', 'CaDoctransporte', 'CaIdnave', 'CaNotas', 'CaEtapa', 'CaDocmaster', 'CaEquipos', 'CaHorasalida', 'CaTipo', ),
		BasePeer::TYPE_COLNAME => array (RepAvisoPeer::CA_IDREPORTE, RepAvisoPeer::CA_IDEMAIL, RepAvisoPeer::CA_INTRODUCCION, RepAvisoPeer::CA_FCHSALIDA, RepAvisoPeer::CA_FCHLLEGADA, RepAvisoPeer::CA_FCHCONTINUACION, RepAvisoPeer::CA_PIEZAS, RepAvisoPeer::CA_PESO, RepAvisoPeer::CA_VOLUMEN, RepAvisoPeer::CA_FCHENVIO, RepAvisoPeer::CA_USUENVIO, RepAvisoPeer::CA_DOCTRANSPORTE, RepAvisoPeer::CA_IDNAVE, RepAvisoPeer::CA_NOTAS, RepAvisoPeer::CA_ETAPA, RepAvisoPeer::CA_DOCMASTER, RepAvisoPeer::CA_EQUIPOS, RepAvisoPeer::CA_HORASALIDA, RepAvisoPeer::CA_TIPO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idreporte', 'ca_idemail', 'ca_introduccion', 'ca_fchsalida', 'ca_fchllegada', 'ca_fchcontinuacion', 'ca_piezas', 'ca_peso', 'ca_volumen', 'ca_fchenvio', 'ca_usuenvio', 'ca_doctransporte', 'ca_idnave', 'ca_notas', 'ca_etapa', 'ca_docmaster', 'ca_equipos', 'ca_horasalida', 'ca_tipo', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdreporte' => 0, 'CaIdemail' => 1, 'CaIntroduccion' => 2, 'CaFchsalida' => 3, 'CaFchllegada' => 4, 'CaFchcontinuacion' => 5, 'CaPiezas' => 6, 'CaPeso' => 7, 'CaVolumen' => 8, 'CaFchenvio' => 9, 'CaUsuenvio' => 10, 'CaDoctransporte' => 11, 'CaIdnave' => 12, 'CaNotas' => 13, 'CaEtapa' => 14, 'CaDocmaster' => 15, 'CaEquipos' => 16, 'CaHorasalida' => 17, 'CaTipo' => 18, ),
		BasePeer::TYPE_COLNAME => array (RepAvisoPeer::CA_IDREPORTE => 0, RepAvisoPeer::CA_IDEMAIL => 1, RepAvisoPeer::CA_INTRODUCCION => 2, RepAvisoPeer::CA_FCHSALIDA => 3, RepAvisoPeer::CA_FCHLLEGADA => 4, RepAvisoPeer::CA_FCHCONTINUACION => 5, RepAvisoPeer::CA_PIEZAS => 6, RepAvisoPeer::CA_PESO => 7, RepAvisoPeer::CA_VOLUMEN => 8, RepAvisoPeer::CA_FCHENVIO => 9, RepAvisoPeer::CA_USUENVIO => 10, RepAvisoPeer::CA_DOCTRANSPORTE => 11, RepAvisoPeer::CA_IDNAVE => 12, RepAvisoPeer::CA_NOTAS => 13, RepAvisoPeer::CA_ETAPA => 14, RepAvisoPeer::CA_DOCMASTER => 15, RepAvisoPeer::CA_EQUIPOS => 16, RepAvisoPeer::CA_HORASALIDA => 17, RepAvisoPeer::CA_TIPO => 18, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idreporte' => 0, 'ca_idemail' => 1, 'ca_introduccion' => 2, 'ca_fchsalida' => 3, 'ca_fchllegada' => 4, 'ca_fchcontinuacion' => 5, 'ca_piezas' => 6, 'ca_peso' => 7, 'ca_volumen' => 8, 'ca_fchenvio' => 9, 'ca_usuenvio' => 10, 'ca_doctransporte' => 11, 'ca_idnave' => 12, 'ca_notas' => 13, 'ca_etapa' => 14, 'ca_docmaster' => 15, 'ca_equipos' => 16, 'ca_horasalida' => 17, 'ca_tipo' => 18, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('lib.model.reportes.map.RepAvisoMapBuilder');
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
			$map = RepAvisoPeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. RepAvisoPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(RepAvisoPeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(RepAvisoPeer::CA_IDREPORTE);

		$criteria->addSelectColumn(RepAvisoPeer::CA_IDEMAIL);

		$criteria->addSelectColumn(RepAvisoPeer::CA_INTRODUCCION);

		$criteria->addSelectColumn(RepAvisoPeer::CA_FCHSALIDA);

		$criteria->addSelectColumn(RepAvisoPeer::CA_FCHLLEGADA);

		$criteria->addSelectColumn(RepAvisoPeer::CA_FCHCONTINUACION);

		$criteria->addSelectColumn(RepAvisoPeer::CA_PIEZAS);

		$criteria->addSelectColumn(RepAvisoPeer::CA_PESO);

		$criteria->addSelectColumn(RepAvisoPeer::CA_VOLUMEN);

		$criteria->addSelectColumn(RepAvisoPeer::CA_FCHENVIO);

		$criteria->addSelectColumn(RepAvisoPeer::CA_USUENVIO);

		$criteria->addSelectColumn(RepAvisoPeer::CA_DOCTRANSPORTE);

		$criteria->addSelectColumn(RepAvisoPeer::CA_IDNAVE);

		$criteria->addSelectColumn(RepAvisoPeer::CA_NOTAS);

		$criteria->addSelectColumn(RepAvisoPeer::CA_ETAPA);

		$criteria->addSelectColumn(RepAvisoPeer::CA_DOCMASTER);

		$criteria->addSelectColumn(RepAvisoPeer::CA_EQUIPOS);

		$criteria->addSelectColumn(RepAvisoPeer::CA_HORASALIDA);

		$criteria->addSelectColumn(RepAvisoPeer::CA_TIPO);

	}

	const COUNT = 'COUNT(tb_repavisos.CA_IDREPORTE)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT tb_repavisos.CA_IDREPORTE)';

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
			$criteria->addSelectColumn(RepAvisoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RepAvisoPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = RepAvisoPeer::doSelectRS($criteria, $con);
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
	 * @return     RepAviso
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = RepAvisoPeer::doSelect($critcopy, $con);
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
		return RepAvisoPeer::populateObjects(RepAvisoPeer::doSelectRS($criteria, $con));
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
			RepAvisoPeer::addSelectColumns($criteria);
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
		$cls = RepAvisoPeer::getOMClass();
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
	 * Returns the number of rows matching criteria, joining the related Reporte table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinReporte(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RepAvisoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RepAvisoPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RepAvisoPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE);

		$rs = RepAvisoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Email table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinEmail(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RepAvisoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RepAvisoPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RepAvisoPeer::CA_IDEMAIL, EmailPeer::CA_IDEMAIL);

		$rs = RepAvisoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of RepAviso objects pre-filled with their Reporte objects.
	 *
	 * @return     array Array of RepAviso objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinReporte(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepAvisoPeer::addSelectColumns($c);
		$startcol = (RepAvisoPeer::NUM_COLUMNS - RepAvisoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ReportePeer::addSelectColumns($c);

		$c->addJoin(RepAvisoPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RepAvisoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ReportePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getReporte(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addRepAviso($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initRepAvisos();
				$obj2->addRepAviso($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of RepAviso objects pre-filled with their Email objects.
	 *
	 * @return     array Array of RepAviso objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinEmail(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepAvisoPeer::addSelectColumns($c);
		$startcol = (RepAvisoPeer::NUM_COLUMNS - RepAvisoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		EmailPeer::addSelectColumns($c);

		$c->addJoin(RepAvisoPeer::CA_IDEMAIL, EmailPeer::CA_IDEMAIL);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RepAvisoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = EmailPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getEmail(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addRepAviso($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initRepAvisos();
				$obj2->addRepAviso($obj1); //CHECKME
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
			$criteria->addSelectColumn(RepAvisoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RepAvisoPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RepAvisoPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE);

		$criteria->addJoin(RepAvisoPeer::CA_IDEMAIL, EmailPeer::CA_IDEMAIL);

		$rs = RepAvisoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of RepAviso objects pre-filled with all related objects.
	 *
	 * @return     array Array of RepAviso objects.
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

		RepAvisoPeer::addSelectColumns($c);
		$startcol2 = (RepAvisoPeer::NUM_COLUMNS - RepAvisoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ReportePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ReportePeer::NUM_COLUMNS;

		EmailPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + EmailPeer::NUM_COLUMNS;

		$c->addJoin(RepAvisoPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE);

		$c->addJoin(RepAvisoPeer::CA_IDEMAIL, EmailPeer::CA_IDEMAIL);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RepAvisoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


				// Add objects for joined Reporte rows
	
			$omClass = ReportePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getReporte(); // CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRepAviso($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initRepAvisos();
				$obj2->addRepAviso($obj1);
			}


				// Add objects for joined Email rows
	
			$omClass = EmailPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getEmail(); // CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addRepAviso($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj3->initRepAvisos();
				$obj3->addRepAviso($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Reporte table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptReporte(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RepAvisoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RepAvisoPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RepAvisoPeer::CA_IDEMAIL, EmailPeer::CA_IDEMAIL);

		$rs = RepAvisoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Email table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptEmail(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RepAvisoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RepAvisoPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RepAvisoPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE);

		$rs = RepAvisoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of RepAviso objects pre-filled with all related objects except Reporte.
	 *
	 * @return     array Array of RepAviso objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptReporte(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepAvisoPeer::addSelectColumns($c);
		$startcol2 = (RepAvisoPeer::NUM_COLUMNS - RepAvisoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		EmailPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + EmailPeer::NUM_COLUMNS;

		$c->addJoin(RepAvisoPeer::CA_IDEMAIL, EmailPeer::CA_IDEMAIL);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RepAvisoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = EmailPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getEmail(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRepAviso($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRepAvisos();
				$obj2->addRepAviso($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of RepAviso objects pre-filled with all related objects except Email.
	 *
	 * @return     array Array of RepAviso objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptEmail(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepAvisoPeer::addSelectColumns($c);
		$startcol2 = (RepAvisoPeer::NUM_COLUMNS - RepAvisoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ReportePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ReportePeer::NUM_COLUMNS;

		$c->addJoin(RepAvisoPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RepAvisoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ReportePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getReporte(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRepAviso($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRepAvisos();
				$obj2->addRepAviso($obj1);
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
		return RepAvisoPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a RepAviso or Criteria object.
	 *
	 * @param      mixed $values Criteria or RepAviso object containing data that is used to create the INSERT statement.
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
			$criteria = $values->buildCriteria(); // build Criteria from RepAviso object
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
	 * Method perform an UPDATE on the database, given a RepAviso or Criteria object.
	 *
	 * @param      mixed $values Criteria or RepAviso object containing data that is used to create the UPDATE statement.
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

			$comparison = $criteria->getComparison(RepAvisoPeer::CA_IDREPORTE);
			$selectCriteria->add(RepAvisoPeer::CA_IDREPORTE, $criteria->remove(RepAvisoPeer::CA_IDREPORTE), $comparison);

			$comparison = $criteria->getComparison(RepAvisoPeer::CA_IDEMAIL);
			$selectCriteria->add(RepAvisoPeer::CA_IDEMAIL, $criteria->remove(RepAvisoPeer::CA_IDEMAIL), $comparison);

		} else { // $values is RepAviso object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the tb_repavisos table.
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
			$affectedRows += BasePeer::doDeleteAll(RepAvisoPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a RepAviso or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or RepAviso object or primary key or array of primary keys
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
			$con = Propel::getConnection(RepAvisoPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof RepAviso) {

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

			$criteria->add(RepAvisoPeer::CA_IDREPORTE, $vals[0], Criteria::IN);
			$criteria->add(RepAvisoPeer::CA_IDEMAIL, $vals[1], Criteria::IN);
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
	 * Validates all modified columns of given RepAviso object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      RepAviso $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(RepAviso $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(RepAvisoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(RepAvisoPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(RepAvisoPeer::DATABASE_NAME, RepAvisoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = RepAvisoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	/**
	 * Retrieve object using using composite pkey values.
	 * @param int $ca_idreporte
	   @param int $ca_idemail
	   
	 * @param      Connection $con
	 * @return     RepAviso
	 */
	public static function retrieveByPK( $ca_idreporte, $ca_idemail, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(RepAvisoPeer::CA_IDREPORTE, $ca_idreporte);
		$criteria->add(RepAvisoPeer::CA_IDEMAIL, $ca_idemail);
		$v = RepAvisoPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} // BaseRepAvisoPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseRepAvisoPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	Propel::registerMapBuilder('lib.model.reportes.map.RepAvisoMapBuilder');
}
