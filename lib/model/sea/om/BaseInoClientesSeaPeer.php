<?php

/**
 * Base static class for performing query and update operations on the 'tb_inoclientes_sea' table.
 *
 * 
 *
 * @package    lib.model.sea.om
 */
abstract class BaseInoClientesSeaPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'tb_inoclientes_sea';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.sea.InoClientesSea';

	/** The total number of columns. */
	const NUM_COLUMNS = 26;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the OID field */
	const OID = 'tb_inoclientes_sea.OID';

	/** the column name for the CA_REFERENCIA field */
	const CA_REFERENCIA = 'tb_inoclientes_sea.CA_REFERENCIA';

	/** the column name for the CA_IDCLIENTE field */
	const CA_IDCLIENTE = 'tb_inoclientes_sea.CA_IDCLIENTE';

	/** the column name for the CA_HBLS field */
	const CA_HBLS = 'tb_inoclientes_sea.CA_HBLS';

	/** the column name for the CA_IDREPORTE field */
	const CA_IDREPORTE = 'tb_inoclientes_sea.CA_IDREPORTE';

	/** the column name for the CA_IDPROVEEDOR field */
	const CA_IDPROVEEDOR = 'tb_inoclientes_sea.CA_IDPROVEEDOR';

	/** the column name for the CA_PROVEEDOR field */
	const CA_PROVEEDOR = 'tb_inoclientes_sea.CA_PROVEEDOR';

	/** the column name for the CA_NUMPIEZAS field */
	const CA_NUMPIEZAS = 'tb_inoclientes_sea.CA_NUMPIEZAS';

	/** the column name for the CA_PESO field */
	const CA_PESO = 'tb_inoclientes_sea.CA_PESO';

	/** the column name for the CA_VOLUMEN field */
	const CA_VOLUMEN = 'tb_inoclientes_sea.CA_VOLUMEN';

	/** the column name for the CA_NUMORDEN field */
	const CA_NUMORDEN = 'tb_inoclientes_sea.CA_NUMORDEN';

	/** the column name for the CA_CONFIRMAR field */
	const CA_CONFIRMAR = 'tb_inoclientes_sea.CA_CONFIRMAR';

	/** the column name for the CA_LOGIN field */
	const CA_LOGIN = 'tb_inoclientes_sea.CA_LOGIN';

	/** the column name for the CA_OBSERVACIONES field */
	const CA_OBSERVACIONES = 'tb_inoclientes_sea.CA_OBSERVACIONES';

	/** the column name for the CA_FCHLIBERACION field */
	const CA_FCHLIBERACION = 'tb_inoclientes_sea.CA_FCHLIBERACION';

	/** the column name for the CA_NOTALIBERACION field */
	const CA_NOTALIBERACION = 'tb_inoclientes_sea.CA_NOTALIBERACION';

	/** the column name for the CA_FCHCREADO field */
	const CA_FCHCREADO = 'tb_inoclientes_sea.CA_FCHCREADO';

	/** the column name for the CA_USUCREADO field */
	const CA_USUCREADO = 'tb_inoclientes_sea.CA_USUCREADO';

	/** the column name for the CA_FCHACTUALIZADO field */
	const CA_FCHACTUALIZADO = 'tb_inoclientes_sea.CA_FCHACTUALIZADO';

	/** the column name for the CA_USUACTUALIZADO field */
	const CA_USUACTUALIZADO = 'tb_inoclientes_sea.CA_USUACTUALIZADO';

	/** the column name for the CA_FCHLIBERADO field */
	const CA_FCHLIBERADO = 'tb_inoclientes_sea.CA_FCHLIBERADO';

	/** the column name for the CA_USULIBERADO field */
	const CA_USULIBERADO = 'tb_inoclientes_sea.CA_USULIBERADO';

	/** the column name for the CA_MENSAJE field */
	const CA_MENSAJE = 'tb_inoclientes_sea.CA_MENSAJE';

	/** the column name for the CA_CONTINUACION field */
	const CA_CONTINUACION = 'tb_inoclientes_sea.CA_CONTINUACION';

	/** the column name for the CA_CONTINUACION_DEST field */
	const CA_CONTINUACION_DEST = 'tb_inoclientes_sea.CA_CONTINUACION_DEST';

	/** the column name for the CA_IDBODEGA field */
	const CA_IDBODEGA = 'tb_inoclientes_sea.CA_IDBODEGA';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Oid', 'CaReferencia', 'CaIdcliente', 'CaHbls', 'CaIdreporte', 'CaIdproveedor', 'CaProveedor', 'CaNumpiezas', 'CaPeso', 'CaVolumen', 'CaNumorden', 'CaConfirmar', 'CaLogin', 'CaObservaciones', 'CaFchliberacion', 'CaNotaliberacion', 'CaFchcreado', 'CaUsucreado', 'CaFchactualizado', 'CaUsuactualizado', 'CaFchliberado', 'CaUsuliberado', 'CaMensaje', 'CaContinuacion', 'CaContinuacionDest', 'CaIdbodega', ),
		BasePeer::TYPE_COLNAME => array (InoClientesSeaPeer::OID, InoClientesSeaPeer::CA_REFERENCIA, InoClientesSeaPeer::CA_IDCLIENTE, InoClientesSeaPeer::CA_HBLS, InoClientesSeaPeer::CA_IDREPORTE, InoClientesSeaPeer::CA_IDPROVEEDOR, InoClientesSeaPeer::CA_PROVEEDOR, InoClientesSeaPeer::CA_NUMPIEZAS, InoClientesSeaPeer::CA_PESO, InoClientesSeaPeer::CA_VOLUMEN, InoClientesSeaPeer::CA_NUMORDEN, InoClientesSeaPeer::CA_CONFIRMAR, InoClientesSeaPeer::CA_LOGIN, InoClientesSeaPeer::CA_OBSERVACIONES, InoClientesSeaPeer::CA_FCHLIBERACION, InoClientesSeaPeer::CA_NOTALIBERACION, InoClientesSeaPeer::CA_FCHCREADO, InoClientesSeaPeer::CA_USUCREADO, InoClientesSeaPeer::CA_FCHACTUALIZADO, InoClientesSeaPeer::CA_USUACTUALIZADO, InoClientesSeaPeer::CA_FCHLIBERADO, InoClientesSeaPeer::CA_USULIBERADO, InoClientesSeaPeer::CA_MENSAJE, InoClientesSeaPeer::CA_CONTINUACION, InoClientesSeaPeer::CA_CONTINUACION_DEST, InoClientesSeaPeer::CA_IDBODEGA, ),
		BasePeer::TYPE_FIELDNAME => array ('oid', 'ca_referencia', 'ca_idcliente', 'ca_hbls', 'ca_idreporte', 'ca_idproveedor', 'ca_proveedor', 'ca_numpiezas', 'ca_peso', 'ca_volumen', 'ca_numorden', 'ca_confirmar', 'ca_login', 'ca_observaciones', 'ca_fchliberacion', 'ca_notaliberacion', 'ca_fchcreado', 'ca_usucreado', 'ca_fchactualizado', 'ca_usuactualizado', 'ca_fchliberado', 'ca_usuliberado', 'ca_mensaje', 'ca_continuacion', 'ca_continuacion_dest', 'ca_idbodega', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Oid' => 0, 'CaReferencia' => 1, 'CaIdcliente' => 2, 'CaHbls' => 3, 'CaIdreporte' => 4, 'CaIdproveedor' => 5, 'CaProveedor' => 6, 'CaNumpiezas' => 7, 'CaPeso' => 8, 'CaVolumen' => 9, 'CaNumorden' => 10, 'CaConfirmar' => 11, 'CaLogin' => 12, 'CaObservaciones' => 13, 'CaFchliberacion' => 14, 'CaNotaliberacion' => 15, 'CaFchcreado' => 16, 'CaUsucreado' => 17, 'CaFchactualizado' => 18, 'CaUsuactualizado' => 19, 'CaFchliberado' => 20, 'CaUsuliberado' => 21, 'CaMensaje' => 22, 'CaContinuacion' => 23, 'CaContinuacionDest' => 24, 'CaIdbodega' => 25, ),
		BasePeer::TYPE_COLNAME => array (InoClientesSeaPeer::OID => 0, InoClientesSeaPeer::CA_REFERENCIA => 1, InoClientesSeaPeer::CA_IDCLIENTE => 2, InoClientesSeaPeer::CA_HBLS => 3, InoClientesSeaPeer::CA_IDREPORTE => 4, InoClientesSeaPeer::CA_IDPROVEEDOR => 5, InoClientesSeaPeer::CA_PROVEEDOR => 6, InoClientesSeaPeer::CA_NUMPIEZAS => 7, InoClientesSeaPeer::CA_PESO => 8, InoClientesSeaPeer::CA_VOLUMEN => 9, InoClientesSeaPeer::CA_NUMORDEN => 10, InoClientesSeaPeer::CA_CONFIRMAR => 11, InoClientesSeaPeer::CA_LOGIN => 12, InoClientesSeaPeer::CA_OBSERVACIONES => 13, InoClientesSeaPeer::CA_FCHLIBERACION => 14, InoClientesSeaPeer::CA_NOTALIBERACION => 15, InoClientesSeaPeer::CA_FCHCREADO => 16, InoClientesSeaPeer::CA_USUCREADO => 17, InoClientesSeaPeer::CA_FCHACTUALIZADO => 18, InoClientesSeaPeer::CA_USUACTUALIZADO => 19, InoClientesSeaPeer::CA_FCHLIBERADO => 20, InoClientesSeaPeer::CA_USULIBERADO => 21, InoClientesSeaPeer::CA_MENSAJE => 22, InoClientesSeaPeer::CA_CONTINUACION => 23, InoClientesSeaPeer::CA_CONTINUACION_DEST => 24, InoClientesSeaPeer::CA_IDBODEGA => 25, ),
		BasePeer::TYPE_FIELDNAME => array ('oid' => 0, 'ca_referencia' => 1, 'ca_idcliente' => 2, 'ca_hbls' => 3, 'ca_idreporte' => 4, 'ca_idproveedor' => 5, 'ca_proveedor' => 6, 'ca_numpiezas' => 7, 'ca_peso' => 8, 'ca_volumen' => 9, 'ca_numorden' => 10, 'ca_confirmar' => 11, 'ca_login' => 12, 'ca_observaciones' => 13, 'ca_fchliberacion' => 14, 'ca_notaliberacion' => 15, 'ca_fchcreado' => 16, 'ca_usucreado' => 17, 'ca_fchactualizado' => 18, 'ca_usuactualizado' => 19, 'ca_fchliberado' => 20, 'ca_usuliberado' => 21, 'ca_mensaje' => 22, 'ca_continuacion' => 23, 'ca_continuacion_dest' => 24, 'ca_idbodega' => 25, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('lib.model.sea.map.InoClientesSeaMapBuilder');
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
			$map = InoClientesSeaPeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. InoClientesSeaPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(InoClientesSeaPeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(InoClientesSeaPeer::OID);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_REFERENCIA);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_IDCLIENTE);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_HBLS);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_IDREPORTE);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_IDPROVEEDOR);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_PROVEEDOR);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_NUMPIEZAS);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_PESO);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_VOLUMEN);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_NUMORDEN);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_CONFIRMAR);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_LOGIN);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_OBSERVACIONES);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_FCHLIBERACION);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_NOTALIBERACION);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_USUCREADO);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_USUACTUALIZADO);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_FCHLIBERADO);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_USULIBERADO);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_MENSAJE);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_CONTINUACION);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_CONTINUACION_DEST);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_IDBODEGA);

	}

	const COUNT = 'COUNT(tb_inoclientes_sea.CA_REFERENCIA)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT tb_inoclientes_sea.CA_REFERENCIA)';

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
			$criteria->addSelectColumn(InoClientesSeaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InoClientesSeaPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = InoClientesSeaPeer::doSelectRS($criteria, $con);
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
	 * @return     InoClientesSea
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = InoClientesSeaPeer::doSelect($critcopy, $con);
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
		return InoClientesSeaPeer::populateObjects(InoClientesSeaPeer::doSelectRS($criteria, $con));
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
			InoClientesSeaPeer::addSelectColumns($criteria);
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
		$cls = InoClientesSeaPeer::getOMClass();
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
			$criteria->addSelectColumn(InoClientesSeaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InoClientesSeaPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InoClientesSeaPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE);

		$rs = InoClientesSeaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Tercero table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinTercero(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InoClientesSeaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InoClientesSeaPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InoClientesSeaPeer::CA_IDPROVEEDOR, TerceroPeer::CA_IDTERCERO);

		$rs = InoClientesSeaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
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
			$criteria->addSelectColumn(InoClientesSeaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InoClientesSeaPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InoClientesSeaPeer::CA_REFERENCIA, InoMaestraSeaPeer::CA_REFERENCIA);

		$rs = InoClientesSeaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of InoClientesSea objects pre-filled with their Reporte objects.
	 *
	 * @return     array Array of InoClientesSea objects.
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

		InoClientesSeaPeer::addSelectColumns($c);
		$startcol = (InoClientesSeaPeer::NUM_COLUMNS - InoClientesSeaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ReportePeer::addSelectColumns($c);

		$c->addJoin(InoClientesSeaPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InoClientesSeaPeer::getOMClass();

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
					$temp_obj2->addInoClientesSea($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initInoClientesSeas();
				$obj2->addInoClientesSea($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of InoClientesSea objects pre-filled with their Tercero objects.
	 *
	 * @return     array Array of InoClientesSea objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinTercero(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoClientesSeaPeer::addSelectColumns($c);
		$startcol = (InoClientesSeaPeer::NUM_COLUMNS - InoClientesSeaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TerceroPeer::addSelectColumns($c);

		$c->addJoin(InoClientesSeaPeer::CA_IDPROVEEDOR, TerceroPeer::CA_IDTERCERO);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InoClientesSeaPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TerceroPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getTercero(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addInoClientesSea($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initInoClientesSeas();
				$obj2->addInoClientesSea($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of InoClientesSea objects pre-filled with their InoMaestraSea objects.
	 *
	 * @return     array Array of InoClientesSea objects.
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

		InoClientesSeaPeer::addSelectColumns($c);
		$startcol = (InoClientesSeaPeer::NUM_COLUMNS - InoClientesSeaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		InoMaestraSeaPeer::addSelectColumns($c);

		$c->addJoin(InoClientesSeaPeer::CA_REFERENCIA, InoMaestraSeaPeer::CA_REFERENCIA);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InoClientesSeaPeer::getOMClass();

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
					$temp_obj2->addInoClientesSea($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initInoClientesSeas();
				$obj2->addInoClientesSea($obj1); //CHECKME
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
			$criteria->addSelectColumn(InoClientesSeaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InoClientesSeaPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InoClientesSeaPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE);

		$criteria->addJoin(InoClientesSeaPeer::CA_IDPROVEEDOR, TerceroPeer::CA_IDTERCERO);

		$criteria->addJoin(InoClientesSeaPeer::CA_REFERENCIA, InoMaestraSeaPeer::CA_REFERENCIA);

		$rs = InoClientesSeaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of InoClientesSea objects pre-filled with all related objects.
	 *
	 * @return     array Array of InoClientesSea objects.
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

		InoClientesSeaPeer::addSelectColumns($c);
		$startcol2 = (InoClientesSeaPeer::NUM_COLUMNS - InoClientesSeaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ReportePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ReportePeer::NUM_COLUMNS;

		TerceroPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + TerceroPeer::NUM_COLUMNS;

		InoMaestraSeaPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + InoMaestraSeaPeer::NUM_COLUMNS;

		$c->addJoin(InoClientesSeaPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE);

		$c->addJoin(InoClientesSeaPeer::CA_IDPROVEEDOR, TerceroPeer::CA_IDTERCERO);

		$c->addJoin(InoClientesSeaPeer::CA_REFERENCIA, InoMaestraSeaPeer::CA_REFERENCIA);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InoClientesSeaPeer::getOMClass();


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
					$temp_obj2->addInoClientesSea($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initInoClientesSeas();
				$obj2->addInoClientesSea($obj1);
			}


				// Add objects for joined Tercero rows
	
			$omClass = TerceroPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getTercero(); // CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addInoClientesSea($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj3->initInoClientesSeas();
				$obj3->addInoClientesSea($obj1);
			}


				// Add objects for joined InoMaestraSea rows
	
			$omClass = InoMaestraSeaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getInoMaestraSea(); // CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addInoClientesSea($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj4->initInoClientesSeas();
				$obj4->addInoClientesSea($obj1);
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
			$criteria->addSelectColumn(InoClientesSeaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InoClientesSeaPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InoClientesSeaPeer::CA_IDPROVEEDOR, TerceroPeer::CA_IDTERCERO);

		$criteria->addJoin(InoClientesSeaPeer::CA_REFERENCIA, InoMaestraSeaPeer::CA_REFERENCIA);

		$rs = InoClientesSeaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Tercero table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptTercero(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InoClientesSeaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InoClientesSeaPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InoClientesSeaPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE);

		$criteria->addJoin(InoClientesSeaPeer::CA_REFERENCIA, InoMaestraSeaPeer::CA_REFERENCIA);

		$rs = InoClientesSeaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
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
			$criteria->addSelectColumn(InoClientesSeaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InoClientesSeaPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InoClientesSeaPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE);

		$criteria->addJoin(InoClientesSeaPeer::CA_IDPROVEEDOR, TerceroPeer::CA_IDTERCERO);

		$rs = InoClientesSeaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of InoClientesSea objects pre-filled with all related objects except Reporte.
	 *
	 * @return     array Array of InoClientesSea objects.
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

		InoClientesSeaPeer::addSelectColumns($c);
		$startcol2 = (InoClientesSeaPeer::NUM_COLUMNS - InoClientesSeaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TerceroPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TerceroPeer::NUM_COLUMNS;

		InoMaestraSeaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + InoMaestraSeaPeer::NUM_COLUMNS;

		$c->addJoin(InoClientesSeaPeer::CA_IDPROVEEDOR, TerceroPeer::CA_IDTERCERO);

		$c->addJoin(InoClientesSeaPeer::CA_REFERENCIA, InoMaestraSeaPeer::CA_REFERENCIA);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InoClientesSeaPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TerceroPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getTercero(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addInoClientesSea($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initInoClientesSeas();
				$obj2->addInoClientesSea($obj1);
			}

			$omClass = InoMaestraSeaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getInoMaestraSea(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addInoClientesSea($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initInoClientesSeas();
				$obj3->addInoClientesSea($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of InoClientesSea objects pre-filled with all related objects except Tercero.
	 *
	 * @return     array Array of InoClientesSea objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptTercero(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoClientesSeaPeer::addSelectColumns($c);
		$startcol2 = (InoClientesSeaPeer::NUM_COLUMNS - InoClientesSeaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ReportePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ReportePeer::NUM_COLUMNS;

		InoMaestraSeaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + InoMaestraSeaPeer::NUM_COLUMNS;

		$c->addJoin(InoClientesSeaPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE);

		$c->addJoin(InoClientesSeaPeer::CA_REFERENCIA, InoMaestraSeaPeer::CA_REFERENCIA);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InoClientesSeaPeer::getOMClass();

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
					$temp_obj2->addInoClientesSea($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initInoClientesSeas();
				$obj2->addInoClientesSea($obj1);
			}

			$omClass = InoMaestraSeaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getInoMaestraSea(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addInoClientesSea($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initInoClientesSeas();
				$obj3->addInoClientesSea($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of InoClientesSea objects pre-filled with all related objects except InoMaestraSea.
	 *
	 * @return     array Array of InoClientesSea objects.
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

		InoClientesSeaPeer::addSelectColumns($c);
		$startcol2 = (InoClientesSeaPeer::NUM_COLUMNS - InoClientesSeaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ReportePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ReportePeer::NUM_COLUMNS;

		TerceroPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + TerceroPeer::NUM_COLUMNS;

		$c->addJoin(InoClientesSeaPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE);

		$c->addJoin(InoClientesSeaPeer::CA_IDPROVEEDOR, TerceroPeer::CA_IDTERCERO);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InoClientesSeaPeer::getOMClass();

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
					$temp_obj2->addInoClientesSea($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initInoClientesSeas();
				$obj2->addInoClientesSea($obj1);
			}

			$omClass = TerceroPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getTercero(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addInoClientesSea($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initInoClientesSeas();
				$obj3->addInoClientesSea($obj1);
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
		return InoClientesSeaPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a InoClientesSea or Criteria object.
	 *
	 * @param      mixed $values Criteria or InoClientesSea object containing data that is used to create the INSERT statement.
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
			$criteria = $values->buildCriteria(); // build Criteria from InoClientesSea object
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
	 * Method perform an UPDATE on the database, given a InoClientesSea or Criteria object.
	 *
	 * @param      mixed $values Criteria or InoClientesSea object containing data that is used to create the UPDATE statement.
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

			$comparison = $criteria->getComparison(InoClientesSeaPeer::CA_REFERENCIA);
			$selectCriteria->add(InoClientesSeaPeer::CA_REFERENCIA, $criteria->remove(InoClientesSeaPeer::CA_REFERENCIA), $comparison);

			$comparison = $criteria->getComparison(InoClientesSeaPeer::CA_IDCLIENTE);
			$selectCriteria->add(InoClientesSeaPeer::CA_IDCLIENTE, $criteria->remove(InoClientesSeaPeer::CA_IDCLIENTE), $comparison);

			$comparison = $criteria->getComparison(InoClientesSeaPeer::CA_HBLS);
			$selectCriteria->add(InoClientesSeaPeer::CA_HBLS, $criteria->remove(InoClientesSeaPeer::CA_HBLS), $comparison);

		} else { // $values is InoClientesSea object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the tb_inoclientes_sea table.
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
			$affectedRows += BasePeer::doDeleteAll(InoClientesSeaPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a InoClientesSea or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or InoClientesSea object or primary key or array of primary keys
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
			$con = Propel::getConnection(InoClientesSeaPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof InoClientesSea) {

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

			$criteria->add(InoClientesSeaPeer::CA_REFERENCIA, $vals[0], Criteria::IN);
			$criteria->add(InoClientesSeaPeer::CA_IDCLIENTE, $vals[1], Criteria::IN);
			$criteria->add(InoClientesSeaPeer::CA_HBLS, $vals[2], Criteria::IN);
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
	 * Validates all modified columns of given InoClientesSea object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      InoClientesSea $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(InoClientesSea $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(InoClientesSeaPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(InoClientesSeaPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(InoClientesSeaPeer::DATABASE_NAME, InoClientesSeaPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = InoClientesSeaPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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
	   
	 * @param      Connection $con
	 * @return     InoClientesSea
	 */
	public static function retrieveByPK( $ca_referencia, $ca_idcliente, $ca_hbls, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(InoClientesSeaPeer::CA_REFERENCIA, $ca_referencia);
		$criteria->add(InoClientesSeaPeer::CA_IDCLIENTE, $ca_idcliente);
		$criteria->add(InoClientesSeaPeer::CA_HBLS, $ca_hbls);
		$v = InoClientesSeaPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} // BaseInoClientesSeaPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseInoClientesSeaPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	Propel::registerMapBuilder('lib.model.sea.map.InoClientesSeaMapBuilder');
}
