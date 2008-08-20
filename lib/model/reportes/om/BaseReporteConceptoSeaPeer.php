<?php


abstract class BaseReporteConceptoSeaPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_repmaritimo';

	
	const CLASS_DEFAULT = 'lib.model.reportes.ReporteConceptoSea';

	
	const NUM_COLUMNS = 13;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const OID = 'tb_repmaritimo.OID';

	
	const CA_IDREPORTE = 'tb_repmaritimo.CA_IDREPORTE';

	
	const CA_IDCONCEPTO = 'tb_repmaritimo.CA_IDCONCEPTO';

	
	const CA_CANTIDAD = 'tb_repmaritimo.CA_CANTIDAD';

	
	const CA_NETA_TAR = 'tb_repmaritimo.CA_NETA_TAR';

	
	const CA_NETA_MIN = 'tb_repmaritimo.CA_NETA_MIN';

	
	const CA_NETA_IDM = 'tb_repmaritimo.CA_NETA_IDM';

	
	const CA_REPORTAR_TAR = 'tb_repmaritimo.CA_REPORTAR_TAR';

	
	const CA_REPORTAR_MIN = 'tb_repmaritimo.CA_REPORTAR_MIN';

	
	const CA_REPORTAR_IDM = 'tb_repmaritimo.CA_REPORTAR_IDM';

	
	const CA_COBRAR_TAR = 'tb_repmaritimo.CA_COBRAR_TAR';

	
	const CA_COBRAR_MIN = 'tb_repmaritimo.CA_COBRAR_MIN';

	
	const CA_COBRAR_IDM = 'tb_repmaritimo.CA_COBRAR_IDM';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Oid', 'CaIdreporte', 'CaIdconcepto', 'CaCantidad', 'CaNetaTar', 'CaNetaMin', 'CaNetaIdm', 'CaReportarTar', 'CaReportarMin', 'CaReportarIdm', 'CaCobrarTar', 'CaCobrarMin', 'CaCobrarIdm', ),
		BasePeer::TYPE_COLNAME => array (ReporteConceptoSeaPeer::OID, ReporteConceptoSeaPeer::CA_IDREPORTE, ReporteConceptoSeaPeer::CA_IDCONCEPTO, ReporteConceptoSeaPeer::CA_CANTIDAD, ReporteConceptoSeaPeer::CA_NETA_TAR, ReporteConceptoSeaPeer::CA_NETA_MIN, ReporteConceptoSeaPeer::CA_NETA_IDM, ReporteConceptoSeaPeer::CA_REPORTAR_TAR, ReporteConceptoSeaPeer::CA_REPORTAR_MIN, ReporteConceptoSeaPeer::CA_REPORTAR_IDM, ReporteConceptoSeaPeer::CA_COBRAR_TAR, ReporteConceptoSeaPeer::CA_COBRAR_MIN, ReporteConceptoSeaPeer::CA_COBRAR_IDM, ),
		BasePeer::TYPE_FIELDNAME => array ('oid', 'ca_idreporte', 'ca_idconcepto', 'ca_cantidad', 'ca_neta_tar', 'ca_neta_min', 'ca_neta_idm', 'ca_reportar_tar', 'ca_reportar_min', 'ca_reportar_idm', 'ca_cobrar_tar', 'ca_cobrar_min', 'ca_cobrar_idm', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Oid' => 0, 'CaIdreporte' => 1, 'CaIdconcepto' => 2, 'CaCantidad' => 3, 'CaNetaTar' => 4, 'CaNetaMin' => 5, 'CaNetaIdm' => 6, 'CaReportarTar' => 7, 'CaReportarMin' => 8, 'CaReportarIdm' => 9, 'CaCobrarTar' => 10, 'CaCobrarMin' => 11, 'CaCobrarIdm' => 12, ),
		BasePeer::TYPE_COLNAME => array (ReporteConceptoSeaPeer::OID => 0, ReporteConceptoSeaPeer::CA_IDREPORTE => 1, ReporteConceptoSeaPeer::CA_IDCONCEPTO => 2, ReporteConceptoSeaPeer::CA_CANTIDAD => 3, ReporteConceptoSeaPeer::CA_NETA_TAR => 4, ReporteConceptoSeaPeer::CA_NETA_MIN => 5, ReporteConceptoSeaPeer::CA_NETA_IDM => 6, ReporteConceptoSeaPeer::CA_REPORTAR_TAR => 7, ReporteConceptoSeaPeer::CA_REPORTAR_MIN => 8, ReporteConceptoSeaPeer::CA_REPORTAR_IDM => 9, ReporteConceptoSeaPeer::CA_COBRAR_TAR => 10, ReporteConceptoSeaPeer::CA_COBRAR_MIN => 11, ReporteConceptoSeaPeer::CA_COBRAR_IDM => 12, ),
		BasePeer::TYPE_FIELDNAME => array ('oid' => 0, 'ca_idreporte' => 1, 'ca_idconcepto' => 2, 'ca_cantidad' => 3, 'ca_neta_tar' => 4, 'ca_neta_min' => 5, 'ca_neta_idm' => 6, 'ca_reportar_tar' => 7, 'ca_reportar_min' => 8, 'ca_reportar_idm' => 9, 'ca_cobrar_tar' => 10, 'ca_cobrar_min' => 11, 'ca_cobrar_idm' => 12, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/reportes/map/ReporteConceptoSeaMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.reportes.map.ReporteConceptoSeaMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ReporteConceptoSeaPeer::getTableMap();
			$columns = $map->getColumns();
			$nameMap = array();
			foreach ($columns as $column) {
				$nameMap[$column->getPhpName()] = $column->getColumnName();
			}
			self::$phpNameMap = $nameMap;
		}
		return self::$phpNameMap;
	}
	
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	
	public static function alias($alias, $column)
	{
		return str_replace(ReporteConceptoSeaPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ReporteConceptoSeaPeer::OID);

		$criteria->addSelectColumn(ReporteConceptoSeaPeer::CA_IDREPORTE);

		$criteria->addSelectColumn(ReporteConceptoSeaPeer::CA_IDCONCEPTO);

		$criteria->addSelectColumn(ReporteConceptoSeaPeer::CA_CANTIDAD);

		$criteria->addSelectColumn(ReporteConceptoSeaPeer::CA_NETA_TAR);

		$criteria->addSelectColumn(ReporteConceptoSeaPeer::CA_NETA_MIN);

		$criteria->addSelectColumn(ReporteConceptoSeaPeer::CA_NETA_IDM);

		$criteria->addSelectColumn(ReporteConceptoSeaPeer::CA_REPORTAR_TAR);

		$criteria->addSelectColumn(ReporteConceptoSeaPeer::CA_REPORTAR_MIN);

		$criteria->addSelectColumn(ReporteConceptoSeaPeer::CA_REPORTAR_IDM);

		$criteria->addSelectColumn(ReporteConceptoSeaPeer::CA_COBRAR_TAR);

		$criteria->addSelectColumn(ReporteConceptoSeaPeer::CA_COBRAR_MIN);

		$criteria->addSelectColumn(ReporteConceptoSeaPeer::CA_COBRAR_IDM);

	}

	const COUNT = 'COUNT(tb_repmaritimo.OID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT tb_repmaritimo.OID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ReporteConceptoSeaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ReporteConceptoSeaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ReporteConceptoSeaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}
	
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = ReporteConceptoSeaPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ReporteConceptoSeaPeer::populateObjects(ReporteConceptoSeaPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ReporteConceptoSeaPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = ReporteConceptoSeaPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinReporte(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;
		
				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ReporteConceptoSeaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ReporteConceptoSeaPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ReporteConceptoSeaPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE);

		$rs = ReporteConceptoSeaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinConcepto(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;
		
				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ReporteConceptoSeaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ReporteConceptoSeaPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ReporteConceptoSeaPeer::CA_IDCONCEPTO, ConceptoPeer::CA_IDCONCEPTO);

		$rs = ReporteConceptoSeaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinReporte(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ReporteConceptoSeaPeer::addSelectColumns($c);
		$startcol = (ReporteConceptoSeaPeer::NUM_COLUMNS - ReporteConceptoSeaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ReportePeer::addSelectColumns($c);

		$c->addJoin(ReporteConceptoSeaPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ReporteConceptoSeaPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ReportePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getReporte(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addReporteConceptoSea($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initReporteConceptoSeas();
				$obj2->addReporteConceptoSea($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinConcepto(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ReporteConceptoSeaPeer::addSelectColumns($c);
		$startcol = (ReporteConceptoSeaPeer::NUM_COLUMNS - ReporteConceptoSeaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ConceptoPeer::addSelectColumns($c);

		$c->addJoin(ReporteConceptoSeaPeer::CA_IDCONCEPTO, ConceptoPeer::CA_IDCONCEPTO);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ReporteConceptoSeaPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ConceptoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getConcepto(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addReporteConceptoSea($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initReporteConceptoSeas();
				$obj2->addReporteConceptoSea($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ReporteConceptoSeaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ReporteConceptoSeaPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ReporteConceptoSeaPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE);

		$criteria->addJoin(ReporteConceptoSeaPeer::CA_IDCONCEPTO, ConceptoPeer::CA_IDCONCEPTO);

		$rs = ReporteConceptoSeaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ReporteConceptoSeaPeer::addSelectColumns($c);
		$startcol2 = (ReporteConceptoSeaPeer::NUM_COLUMNS - ReporteConceptoSeaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ReportePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ReportePeer::NUM_COLUMNS;

		ConceptoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ConceptoPeer::NUM_COLUMNS;

		$c->addJoin(ReporteConceptoSeaPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE);

		$c->addJoin(ReporteConceptoSeaPeer::CA_IDCONCEPTO, ConceptoPeer::CA_IDCONCEPTO);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();
		
		while($rs->next()) {

			$omClass = ReporteConceptoSeaPeer::getOMClass();

			
			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

				
					
			$omClass = ReportePeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getReporte(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addReporteConceptoSea($obj1); 					break;
				}
			}
			
			if ($newObject) {
				$obj2->initReporteConceptoSeas();
				$obj2->addReporteConceptoSea($obj1);
			}

				
					
			$omClass = ConceptoPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getConcepto(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addReporteConceptoSea($obj1); 					break;
				}
			}
			
			if ($newObject) {
				$obj3->initReporteConceptoSeas();
				$obj3->addReporteConceptoSea($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptReporte(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;
		
				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ReporteConceptoSeaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ReporteConceptoSeaPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ReporteConceptoSeaPeer::CA_IDCONCEPTO, ConceptoPeer::CA_IDCONCEPTO);

		$rs = ReporteConceptoSeaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptConcepto(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;
		
				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ReporteConceptoSeaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ReporteConceptoSeaPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ReporteConceptoSeaPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE);

		$rs = ReporteConceptoSeaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptReporte(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ReporteConceptoSeaPeer::addSelectColumns($c);
		$startcol2 = (ReporteConceptoSeaPeer::NUM_COLUMNS - ReporteConceptoSeaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ConceptoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ConceptoPeer::NUM_COLUMNS;

		$c->addJoin(ReporteConceptoSeaPeer::CA_IDCONCEPTO, ConceptoPeer::CA_IDCONCEPTO);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();
		
		while($rs->next()) {

			$omClass = ReporteConceptoSeaPeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getConcepto(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addReporteConceptoSea($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj2->initReporteConceptoSeas();
				$obj2->addReporteConceptoSea($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptConcepto(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ReporteConceptoSeaPeer::addSelectColumns($c);
		$startcol2 = (ReporteConceptoSeaPeer::NUM_COLUMNS - ReporteConceptoSeaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ReportePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ReportePeer::NUM_COLUMNS;

		$c->addJoin(ReporteConceptoSeaPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();
		
		while($rs->next()) {

			$omClass = ReporteConceptoSeaPeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getReporte(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addReporteConceptoSea($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj2->initReporteConceptoSeas();
				$obj2->addReporteConceptoSea($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}

	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return ReporteConceptoSeaPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}


				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(ReporteConceptoSeaPeer::OID);
			$selectCriteria->add(ReporteConceptoSeaPeer::OID, $criteria->remove(ReporteConceptoSeaPeer::OID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; 		try {
									$con->begin();
			$affectedRows += BasePeer::doDeleteAll(ReporteConceptoSeaPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(ReporteConceptoSeaPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof ReporteConceptoSea) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ReporteConceptoSeaPeer::OID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public static function doValidate(ReporteConceptoSea $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ReporteConceptoSeaPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ReporteConceptoSeaPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ReporteConceptoSeaPeer::DATABASE_NAME, ReporteConceptoSeaPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ReporteConceptoSeaPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(ReporteConceptoSeaPeer::DATABASE_NAME);

		$criteria->add(ReporteConceptoSeaPeer::OID, $pk);


		$v = ReporteConceptoSeaPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
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
			$criteria->add(ReporteConceptoSeaPeer::OID, $pks, Criteria::IN);
			$objs = ReporteConceptoSeaPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseReporteConceptoSeaPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/reportes/map/ReporteConceptoSeaMapBuilder.php';
	Propel::registerMapBuilder('lib.model.reportes.map.ReporteConceptoSeaMapBuilder');
}
