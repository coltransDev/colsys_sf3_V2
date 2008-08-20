<?php

/**
 * Base static class for performing query and update operations on the 'tb_repstatus' table.
 *
 * 
 *
 * @package    lib.model.reportes.om
 */
abstract class BaseRepStatusPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'tb_repstatus';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.reportes.RepStatus';

	/** The total number of columns. */
	const NUM_COLUMNS = 24;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the CA_IDREPORTE field */
	const CA_IDREPORTE = 'tb_repstatus.CA_IDREPORTE';

	/** the column name for the CA_IDEMAIL field */
	const CA_IDEMAIL = 'tb_repstatus.CA_IDEMAIL';

	/** the column name for the CA_FCHSTATUS field */
	const CA_FCHSTATUS = 'tb_repstatus.CA_FCHSTATUS';

	/** the column name for the CA_STATUS field */
	const CA_STATUS = 'tb_repstatus.CA_STATUS';

	/** the column name for the CA_COMENTARIOS field */
	const CA_COMENTARIOS = 'tb_repstatus.CA_COMENTARIOS';

	/** the column name for the CA_FCHRECIBO field */
	const CA_FCHRECIBO = 'tb_repstatus.CA_FCHRECIBO';

	/** the column name for the CA_FCHENVIO field */
	const CA_FCHENVIO = 'tb_repstatus.CA_FCHENVIO';

	/** the column name for the CA_USUENVIO field */
	const CA_USUENVIO = 'tb_repstatus.CA_USUENVIO';

	/** the column name for the CA_ETAPA field */
	const CA_ETAPA = 'tb_repstatus.CA_ETAPA';

	/** the column name for the CA_INTRODUCCION field */
	const CA_INTRODUCCION = 'tb_repstatus.CA_INTRODUCCION';

	/** the column name for the CA_FCHSALIDA field */
	const CA_FCHSALIDA = 'tb_repstatus.CA_FCHSALIDA';

	/** the column name for the CA_FCHLLEGADA field */
	const CA_FCHLLEGADA = 'tb_repstatus.CA_FCHLLEGADA';

	/** the column name for the CA_FCHCONTINUACION field */
	const CA_FCHCONTINUACION = 'tb_repstatus.CA_FCHCONTINUACION';

	/** the column name for the CA_PIEZAS field */
	const CA_PIEZAS = 'tb_repstatus.CA_PIEZAS';

	/** the column name for the CA_PESO field */
	const CA_PESO = 'tb_repstatus.CA_PESO';

	/** the column name for the CA_VOLUMEN field */
	const CA_VOLUMEN = 'tb_repstatus.CA_VOLUMEN';

	/** the column name for the CA_DOCTRANSPORTE field */
	const CA_DOCTRANSPORTE = 'tb_repstatus.CA_DOCTRANSPORTE';

	/** the column name for the CA_IDNAVE field */
	const CA_IDNAVE = 'tb_repstatus.CA_IDNAVE';

	/** the column name for the CA_DOCMASTER field */
	const CA_DOCMASTER = 'tb_repstatus.CA_DOCMASTER';

	/** the column name for the CA_FCHRESERVA field */
	const CA_FCHRESERVA = 'tb_repstatus.CA_FCHRESERVA';

	/** the column name for the CA_FCHCIERRERESERVA field */
	const CA_FCHCIERRERESERVA = 'tb_repstatus.CA_FCHCIERRERESERVA';

	/** the column name for the CA_EQUIPOS field */
	const CA_EQUIPOS = 'tb_repstatus.CA_EQUIPOS';

	/** the column name for the CA_HORASALIDA field */
	const CA_HORASALIDA = 'tb_repstatus.CA_HORASALIDA';

	/** the column name for the CA_HORALLEGADA field */
	const CA_HORALLEGADA = 'tb_repstatus.CA_HORALLEGADA';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdreporte', 'CaIdemail', 'CaFchstatus', 'CaStatus', 'CaComentarios', 'CaFchrecibo', 'CaFchenvio', 'CaUsuenvio', 'CaEtapa', 'CaIntroduccion', 'CaFchsalida', 'CaFchllegada', 'CaFchcontinuacion', 'CaPiezas', 'CaPeso', 'CaVolumen', 'CaDoctransporte', 'CaIdnave', 'CaDocmaster', 'CaFchreserva', 'CaFchcierrereserva', 'CaEquipos', 'CaHorasalida', 'CaHorallegada', ),
		BasePeer::TYPE_COLNAME => array (RepStatusPeer::CA_IDREPORTE, RepStatusPeer::CA_IDEMAIL, RepStatusPeer::CA_FCHSTATUS, RepStatusPeer::CA_STATUS, RepStatusPeer::CA_COMENTARIOS, RepStatusPeer::CA_FCHRECIBO, RepStatusPeer::CA_FCHENVIO, RepStatusPeer::CA_USUENVIO, RepStatusPeer::CA_ETAPA, RepStatusPeer::CA_INTRODUCCION, RepStatusPeer::CA_FCHSALIDA, RepStatusPeer::CA_FCHLLEGADA, RepStatusPeer::CA_FCHCONTINUACION, RepStatusPeer::CA_PIEZAS, RepStatusPeer::CA_PESO, RepStatusPeer::CA_VOLUMEN, RepStatusPeer::CA_DOCTRANSPORTE, RepStatusPeer::CA_IDNAVE, RepStatusPeer::CA_DOCMASTER, RepStatusPeer::CA_FCHRESERVA, RepStatusPeer::CA_FCHCIERRERESERVA, RepStatusPeer::CA_EQUIPOS, RepStatusPeer::CA_HORASALIDA, RepStatusPeer::CA_HORALLEGADA, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idreporte', 'ca_idemail', 'ca_fchstatus', 'ca_status', 'ca_comentarios', 'ca_fchrecibo', 'ca_fchenvio', 'ca_usuenvio', 'ca_etapa', 'ca_introduccion', 'ca_fchsalida', 'ca_fchllegada', 'ca_fchcontinuacion', 'ca_piezas', 'ca_peso', 'ca_volumen', 'ca_doctransporte', 'ca_idnave', 'ca_docmaster', 'ca_fchreserva', 'ca_fchcierrereserva', 'ca_equipos', 'ca_horasalida', 'ca_horallegada', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdreporte' => 0, 'CaIdemail' => 1, 'CaFchstatus' => 2, 'CaStatus' => 3, 'CaComentarios' => 4, 'CaFchrecibo' => 5, 'CaFchenvio' => 6, 'CaUsuenvio' => 7, 'CaEtapa' => 8, 'CaIntroduccion' => 9, 'CaFchsalida' => 10, 'CaFchllegada' => 11, 'CaFchcontinuacion' => 12, 'CaPiezas' => 13, 'CaPeso' => 14, 'CaVolumen' => 15, 'CaDoctransporte' => 16, 'CaIdnave' => 17, 'CaDocmaster' => 18, 'CaFchreserva' => 19, 'CaFchcierrereserva' => 20, 'CaEquipos' => 21, 'CaHorasalida' => 22, 'CaHorallegada' => 23, ),
		BasePeer::TYPE_COLNAME => array (RepStatusPeer::CA_IDREPORTE => 0, RepStatusPeer::CA_IDEMAIL => 1, RepStatusPeer::CA_FCHSTATUS => 2, RepStatusPeer::CA_STATUS => 3, RepStatusPeer::CA_COMENTARIOS => 4, RepStatusPeer::CA_FCHRECIBO => 5, RepStatusPeer::CA_FCHENVIO => 6, RepStatusPeer::CA_USUENVIO => 7, RepStatusPeer::CA_ETAPA => 8, RepStatusPeer::CA_INTRODUCCION => 9, RepStatusPeer::CA_FCHSALIDA => 10, RepStatusPeer::CA_FCHLLEGADA => 11, RepStatusPeer::CA_FCHCONTINUACION => 12, RepStatusPeer::CA_PIEZAS => 13, RepStatusPeer::CA_PESO => 14, RepStatusPeer::CA_VOLUMEN => 15, RepStatusPeer::CA_DOCTRANSPORTE => 16, RepStatusPeer::CA_IDNAVE => 17, RepStatusPeer::CA_DOCMASTER => 18, RepStatusPeer::CA_FCHRESERVA => 19, RepStatusPeer::CA_FCHCIERRERESERVA => 20, RepStatusPeer::CA_EQUIPOS => 21, RepStatusPeer::CA_HORASALIDA => 22, RepStatusPeer::CA_HORALLEGADA => 23, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idreporte' => 0, 'ca_idemail' => 1, 'ca_fchstatus' => 2, 'ca_status' => 3, 'ca_comentarios' => 4, 'ca_fchrecibo' => 5, 'ca_fchenvio' => 6, 'ca_usuenvio' => 7, 'ca_etapa' => 8, 'ca_introduccion' => 9, 'ca_fchsalida' => 10, 'ca_fchllegada' => 11, 'ca_fchcontinuacion' => 12, 'ca_piezas' => 13, 'ca_peso' => 14, 'ca_volumen' => 15, 'ca_doctransporte' => 16, 'ca_idnave' => 17, 'ca_docmaster' => 18, 'ca_fchreserva' => 19, 'ca_fchcierrereserva' => 20, 'ca_equipos' => 21, 'ca_horasalida' => 22, 'ca_horallegada' => 23, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('lib.model.reportes.map.RepStatusMapBuilder');
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
			$map = RepStatusPeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. RepStatusPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(RepStatusPeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(RepStatusPeer::CA_IDREPORTE);

		$criteria->addSelectColumn(RepStatusPeer::CA_IDEMAIL);

		$criteria->addSelectColumn(RepStatusPeer::CA_FCHSTATUS);

		$criteria->addSelectColumn(RepStatusPeer::CA_STATUS);

		$criteria->addSelectColumn(RepStatusPeer::CA_COMENTARIOS);

		$criteria->addSelectColumn(RepStatusPeer::CA_FCHRECIBO);

		$criteria->addSelectColumn(RepStatusPeer::CA_FCHENVIO);

		$criteria->addSelectColumn(RepStatusPeer::CA_USUENVIO);

		$criteria->addSelectColumn(RepStatusPeer::CA_ETAPA);

		$criteria->addSelectColumn(RepStatusPeer::CA_INTRODUCCION);

		$criteria->addSelectColumn(RepStatusPeer::CA_FCHSALIDA);

		$criteria->addSelectColumn(RepStatusPeer::CA_FCHLLEGADA);

		$criteria->addSelectColumn(RepStatusPeer::CA_FCHCONTINUACION);

		$criteria->addSelectColumn(RepStatusPeer::CA_PIEZAS);

		$criteria->addSelectColumn(RepStatusPeer::CA_PESO);

		$criteria->addSelectColumn(RepStatusPeer::CA_VOLUMEN);

		$criteria->addSelectColumn(RepStatusPeer::CA_DOCTRANSPORTE);

		$criteria->addSelectColumn(RepStatusPeer::CA_IDNAVE);

		$criteria->addSelectColumn(RepStatusPeer::CA_DOCMASTER);

		$criteria->addSelectColumn(RepStatusPeer::CA_FCHRESERVA);

		$criteria->addSelectColumn(RepStatusPeer::CA_FCHCIERRERESERVA);

		$criteria->addSelectColumn(RepStatusPeer::CA_EQUIPOS);

		$criteria->addSelectColumn(RepStatusPeer::CA_HORASALIDA);

		$criteria->addSelectColumn(RepStatusPeer::CA_HORALLEGADA);

	}

	const COUNT = 'COUNT(tb_repstatus.CA_IDREPORTE)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT tb_repstatus.CA_IDREPORTE)';

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
			$criteria->addSelectColumn(RepStatusPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RepStatusPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = RepStatusPeer::doSelectRS($criteria, $con);
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
	 * @return     RepStatus
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = RepStatusPeer::doSelect($critcopy, $con);
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
		return RepStatusPeer::populateObjects(RepStatusPeer::doSelectRS($criteria, $con));
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
			RepStatusPeer::addSelectColumns($criteria);
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
		$cls = RepStatusPeer::getOMClass();
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
			$criteria->addSelectColumn(RepStatusPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RepStatusPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RepStatusPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE);

		$rs = RepStatusPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(RepStatusPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RepStatusPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RepStatusPeer::CA_IDEMAIL, EmailPeer::CA_IDEMAIL);

		$rs = RepStatusPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of RepStatus objects pre-filled with their Reporte objects.
	 *
	 * @return     array Array of RepStatus objects.
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

		RepStatusPeer::addSelectColumns($c);
		$startcol = (RepStatusPeer::NUM_COLUMNS - RepStatusPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ReportePeer::addSelectColumns($c);

		$c->addJoin(RepStatusPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RepStatusPeer::getOMClass();

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
					$temp_obj2->addRepStatus($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initRepStatuss();
				$obj2->addRepStatus($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of RepStatus objects pre-filled with their Email objects.
	 *
	 * @return     array Array of RepStatus objects.
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

		RepStatusPeer::addSelectColumns($c);
		$startcol = (RepStatusPeer::NUM_COLUMNS - RepStatusPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		EmailPeer::addSelectColumns($c);

		$c->addJoin(RepStatusPeer::CA_IDEMAIL, EmailPeer::CA_IDEMAIL);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RepStatusPeer::getOMClass();

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
					$temp_obj2->addRepStatus($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initRepStatuss();
				$obj2->addRepStatus($obj1); //CHECKME
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
			$criteria->addSelectColumn(RepStatusPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RepStatusPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RepStatusPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE);

		$criteria->addJoin(RepStatusPeer::CA_IDEMAIL, EmailPeer::CA_IDEMAIL);

		$rs = RepStatusPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of RepStatus objects pre-filled with all related objects.
	 *
	 * @return     array Array of RepStatus objects.
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

		RepStatusPeer::addSelectColumns($c);
		$startcol2 = (RepStatusPeer::NUM_COLUMNS - RepStatusPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ReportePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ReportePeer::NUM_COLUMNS;

		EmailPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + EmailPeer::NUM_COLUMNS;

		$c->addJoin(RepStatusPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE);

		$c->addJoin(RepStatusPeer::CA_IDEMAIL, EmailPeer::CA_IDEMAIL);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RepStatusPeer::getOMClass();


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
					$temp_obj2->addRepStatus($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initRepStatuss();
				$obj2->addRepStatus($obj1);
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
					$temp_obj3->addRepStatus($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj3->initRepStatuss();
				$obj3->addRepStatus($obj1);
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
			$criteria->addSelectColumn(RepStatusPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RepStatusPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RepStatusPeer::CA_IDEMAIL, EmailPeer::CA_IDEMAIL);

		$rs = RepStatusPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(RepStatusPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RepStatusPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RepStatusPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE);

		$rs = RepStatusPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of RepStatus objects pre-filled with all related objects except Reporte.
	 *
	 * @return     array Array of RepStatus objects.
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

		RepStatusPeer::addSelectColumns($c);
		$startcol2 = (RepStatusPeer::NUM_COLUMNS - RepStatusPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		EmailPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + EmailPeer::NUM_COLUMNS;

		$c->addJoin(RepStatusPeer::CA_IDEMAIL, EmailPeer::CA_IDEMAIL);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RepStatusPeer::getOMClass();

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
					$temp_obj2->addRepStatus($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRepStatuss();
				$obj2->addRepStatus($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of RepStatus objects pre-filled with all related objects except Email.
	 *
	 * @return     array Array of RepStatus objects.
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

		RepStatusPeer::addSelectColumns($c);
		$startcol2 = (RepStatusPeer::NUM_COLUMNS - RepStatusPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ReportePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ReportePeer::NUM_COLUMNS;

		$c->addJoin(RepStatusPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RepStatusPeer::getOMClass();

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
					$temp_obj2->addRepStatus($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRepStatuss();
				$obj2->addRepStatus($obj1);
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
		return RepStatusPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a RepStatus or Criteria object.
	 *
	 * @param      mixed $values Criteria or RepStatus object containing data that is used to create the INSERT statement.
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
			$criteria = $values->buildCriteria(); // build Criteria from RepStatus object
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
	 * Method perform an UPDATE on the database, given a RepStatus or Criteria object.
	 *
	 * @param      mixed $values Criteria or RepStatus object containing data that is used to create the UPDATE statement.
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

			$comparison = $criteria->getComparison(RepStatusPeer::CA_IDREPORTE);
			$selectCriteria->add(RepStatusPeer::CA_IDREPORTE, $criteria->remove(RepStatusPeer::CA_IDREPORTE), $comparison);

			$comparison = $criteria->getComparison(RepStatusPeer::CA_IDEMAIL);
			$selectCriteria->add(RepStatusPeer::CA_IDEMAIL, $criteria->remove(RepStatusPeer::CA_IDEMAIL), $comparison);

		} else { // $values is RepStatus object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the tb_repstatus table.
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
			$affectedRows += BasePeer::doDeleteAll(RepStatusPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a RepStatus or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or RepStatus object or primary key or array of primary keys
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
			$con = Propel::getConnection(RepStatusPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof RepStatus) {

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

			$criteria->add(RepStatusPeer::CA_IDREPORTE, $vals[0], Criteria::IN);
			$criteria->add(RepStatusPeer::CA_IDEMAIL, $vals[1], Criteria::IN);
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
	 * Validates all modified columns of given RepStatus object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      RepStatus $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(RepStatus $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(RepStatusPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(RepStatusPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(RepStatusPeer::DATABASE_NAME, RepStatusPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = RepStatusPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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
	 * @return     RepStatus
	 */
	public static function retrieveByPK( $ca_idreporte, $ca_idemail, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(RepStatusPeer::CA_IDREPORTE, $ca_idreporte);
		$criteria->add(RepStatusPeer::CA_IDEMAIL, $ca_idemail);
		$v = RepStatusPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} // BaseRepStatusPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseRepStatusPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	Propel::registerMapBuilder('lib.model.reportes.map.RepStatusMapBuilder');
}
