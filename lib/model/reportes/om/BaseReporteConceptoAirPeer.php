<?php


abstract class BaseReporteConceptoAirPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_repaereo';

	
	const CLASS_DEFAULT = 'lib.model.reportes.ReporteConceptoAir';

	
	const NUM_COLUMNS = 9;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const OID = 'tb_repaereo.OID';

	
	const CA_IDREPORTE = 'tb_repaereo.CA_IDREPORTE';

	
	const CA_IDCONCEPTO = 'tb_repaereo.CA_IDCONCEPTO';

	
	const CA_REPORTAR_TAR = 'tb_repaereo.CA_REPORTAR_TAR';

	
	const CA_REPORTAR_MIN = 'tb_repaereo.CA_REPORTAR_MIN';

	
	const CA_REPORTAR_IDM = 'tb_repaereo.CA_REPORTAR_IDM';

	
	const CA_COBRAR_TAR = 'tb_repaereo.CA_COBRAR_TAR';

	
	const CA_COBRAR_MIN = 'tb_repaereo.CA_COBRAR_MIN';

	
	const CA_COBRAR_IDM = 'tb_repaereo.CA_COBRAR_IDM';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Oid', 'CaIdreporte', 'CaIdconcepto', 'CaReportarTar', 'CaReportarMin', 'CaReportarIdm', 'CaCobrarTar', 'CaCobrarMin', 'CaCobrarIdm', ),
		BasePeer::TYPE_COLNAME => array (ReporteConceptoAirPeer::OID, ReporteConceptoAirPeer::CA_IDREPORTE, ReporteConceptoAirPeer::CA_IDCONCEPTO, ReporteConceptoAirPeer::CA_REPORTAR_TAR, ReporteConceptoAirPeer::CA_REPORTAR_MIN, ReporteConceptoAirPeer::CA_REPORTAR_IDM, ReporteConceptoAirPeer::CA_COBRAR_TAR, ReporteConceptoAirPeer::CA_COBRAR_MIN, ReporteConceptoAirPeer::CA_COBRAR_IDM, ),
		BasePeer::TYPE_FIELDNAME => array ('oid', 'ca_idreporte', 'ca_idconcepto', 'ca_reportar_tar', 'ca_reportar_min', 'ca_reportar_idm', 'ca_cobrar_tar', 'ca_cobrar_min', 'ca_cobrar_idm', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Oid' => 0, 'CaIdreporte' => 1, 'CaIdconcepto' => 2, 'CaReportarTar' => 3, 'CaReportarMin' => 4, 'CaReportarIdm' => 5, 'CaCobrarTar' => 6, 'CaCobrarMin' => 7, 'CaCobrarIdm' => 8, ),
		BasePeer::TYPE_COLNAME => array (ReporteConceptoAirPeer::OID => 0, ReporteConceptoAirPeer::CA_IDREPORTE => 1, ReporteConceptoAirPeer::CA_IDCONCEPTO => 2, ReporteConceptoAirPeer::CA_REPORTAR_TAR => 3, ReporteConceptoAirPeer::CA_REPORTAR_MIN => 4, ReporteConceptoAirPeer::CA_REPORTAR_IDM => 5, ReporteConceptoAirPeer::CA_COBRAR_TAR => 6, ReporteConceptoAirPeer::CA_COBRAR_MIN => 7, ReporteConceptoAirPeer::CA_COBRAR_IDM => 8, ),
		BasePeer::TYPE_FIELDNAME => array ('oid' => 0, 'ca_idreporte' => 1, 'ca_idconcepto' => 2, 'ca_reportar_tar' => 3, 'ca_reportar_min' => 4, 'ca_reportar_idm' => 5, 'ca_cobrar_tar' => 6, 'ca_cobrar_min' => 7, 'ca_cobrar_idm' => 8, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/reportes/map/ReporteConceptoAirMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.reportes.map.ReporteConceptoAirMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ReporteConceptoAirPeer::getTableMap();
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
		return str_replace(ReporteConceptoAirPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ReporteConceptoAirPeer::OID);

		$criteria->addSelectColumn(ReporteConceptoAirPeer::CA_IDREPORTE);

		$criteria->addSelectColumn(ReporteConceptoAirPeer::CA_IDCONCEPTO);

		$criteria->addSelectColumn(ReporteConceptoAirPeer::CA_REPORTAR_TAR);

		$criteria->addSelectColumn(ReporteConceptoAirPeer::CA_REPORTAR_MIN);

		$criteria->addSelectColumn(ReporteConceptoAirPeer::CA_REPORTAR_IDM);

		$criteria->addSelectColumn(ReporteConceptoAirPeer::CA_COBRAR_TAR);

		$criteria->addSelectColumn(ReporteConceptoAirPeer::CA_COBRAR_MIN);

		$criteria->addSelectColumn(ReporteConceptoAirPeer::CA_COBRAR_IDM);

	}

	const COUNT = 'COUNT(tb_repaereo.OID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT tb_repaereo.OID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ReporteConceptoAirPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ReporteConceptoAirPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ReporteConceptoAirPeer::doSelectRS($criteria, $con);
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
		$objects = ReporteConceptoAirPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ReporteConceptoAirPeer::populateObjects(ReporteConceptoAirPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ReporteConceptoAirPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = ReporteConceptoAirPeer::getOMClass();
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
			$criteria->addSelectColumn(ReporteConceptoAirPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ReporteConceptoAirPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ReporteConceptoAirPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE);

		$rs = ReporteConceptoAirPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ReporteConceptoAirPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ReporteConceptoAirPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ReporteConceptoAirPeer::CA_IDCONCEPTO, ConceptoPeer::CA_IDCONCEPTO);

		$rs = ReporteConceptoAirPeer::doSelectRS($criteria, $con);
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

		ReporteConceptoAirPeer::addSelectColumns($c);
		$startcol = (ReporteConceptoAirPeer::NUM_COLUMNS - ReporteConceptoAirPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ReportePeer::addSelectColumns($c);

		$c->addJoin(ReporteConceptoAirPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ReporteConceptoAirPeer::getOMClass();

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
										$temp_obj2->addReporteConceptoAir($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initReporteConceptoAirs();
				$obj2->addReporteConceptoAir($obj1); 			}
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

		ReporteConceptoAirPeer::addSelectColumns($c);
		$startcol = (ReporteConceptoAirPeer::NUM_COLUMNS - ReporteConceptoAirPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ConceptoPeer::addSelectColumns($c);

		$c->addJoin(ReporteConceptoAirPeer::CA_IDCONCEPTO, ConceptoPeer::CA_IDCONCEPTO);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ReporteConceptoAirPeer::getOMClass();

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
										$temp_obj2->addReporteConceptoAir($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initReporteConceptoAirs();
				$obj2->addReporteConceptoAir($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ReporteConceptoAirPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ReporteConceptoAirPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ReporteConceptoAirPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE);

		$criteria->addJoin(ReporteConceptoAirPeer::CA_IDCONCEPTO, ConceptoPeer::CA_IDCONCEPTO);

		$rs = ReporteConceptoAirPeer::doSelectRS($criteria, $con);
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

		ReporteConceptoAirPeer::addSelectColumns($c);
		$startcol2 = (ReporteConceptoAirPeer::NUM_COLUMNS - ReporteConceptoAirPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ReportePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ReportePeer::NUM_COLUMNS;

		ConceptoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ConceptoPeer::NUM_COLUMNS;

		$c->addJoin(ReporteConceptoAirPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE);

		$c->addJoin(ReporteConceptoAirPeer::CA_IDCONCEPTO, ConceptoPeer::CA_IDCONCEPTO);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();
		
		while($rs->next()) {

			$omClass = ReporteConceptoAirPeer::getOMClass();

			
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
					$temp_obj2->addReporteConceptoAir($obj1); 					break;
				}
			}
			
			if ($newObject) {
				$obj2->initReporteConceptoAirs();
				$obj2->addReporteConceptoAir($obj1);
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
					$temp_obj3->addReporteConceptoAir($obj1); 					break;
				}
			}
			
			if ($newObject) {
				$obj3->initReporteConceptoAirs();
				$obj3->addReporteConceptoAir($obj1);
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
			$criteria->addSelectColumn(ReporteConceptoAirPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ReporteConceptoAirPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ReporteConceptoAirPeer::CA_IDCONCEPTO, ConceptoPeer::CA_IDCONCEPTO);

		$rs = ReporteConceptoAirPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ReporteConceptoAirPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ReporteConceptoAirPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ReporteConceptoAirPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE);

		$rs = ReporteConceptoAirPeer::doSelectRS($criteria, $con);
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

		ReporteConceptoAirPeer::addSelectColumns($c);
		$startcol2 = (ReporteConceptoAirPeer::NUM_COLUMNS - ReporteConceptoAirPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ConceptoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ConceptoPeer::NUM_COLUMNS;

		$c->addJoin(ReporteConceptoAirPeer::CA_IDCONCEPTO, ConceptoPeer::CA_IDCONCEPTO);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();
		
		while($rs->next()) {

			$omClass = ReporteConceptoAirPeer::getOMClass();

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
					$temp_obj2->addReporteConceptoAir($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj2->initReporteConceptoAirs();
				$obj2->addReporteConceptoAir($obj1);
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

		ReporteConceptoAirPeer::addSelectColumns($c);
		$startcol2 = (ReporteConceptoAirPeer::NUM_COLUMNS - ReporteConceptoAirPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ReportePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ReportePeer::NUM_COLUMNS;

		$c->addJoin(ReporteConceptoAirPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();
		
		while($rs->next()) {

			$omClass = ReporteConceptoAirPeer::getOMClass();

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
					$temp_obj2->addReporteConceptoAir($obj1);
					break;
				}
			}
			
			if ($newObject) {
				$obj2->initReporteConceptoAirs();
				$obj2->addReporteConceptoAir($obj1);
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
		return ReporteConceptoAirPeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(ReporteConceptoAirPeer::OID);
			$selectCriteria->add(ReporteConceptoAirPeer::OID, $criteria->remove(ReporteConceptoAirPeer::OID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(ReporteConceptoAirPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ReporteConceptoAirPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof ReporteConceptoAir) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ReporteConceptoAirPeer::OID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(ReporteConceptoAir $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ReporteConceptoAirPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ReporteConceptoAirPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ReporteConceptoAirPeer::DATABASE_NAME, ReporteConceptoAirPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ReporteConceptoAirPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(ReporteConceptoAirPeer::DATABASE_NAME);

		$criteria->add(ReporteConceptoAirPeer::OID, $pk);


		$v = ReporteConceptoAirPeer::doSelect($criteria, $con);

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
			$criteria->add(ReporteConceptoAirPeer::OID, $pks, Criteria::IN);
			$objs = ReporteConceptoAirPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseReporteConceptoAirPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/reportes/map/ReporteConceptoAirMapBuilder.php';
	Propel::registerMapBuilder('lib.model.reportes.map.ReporteConceptoAirMapBuilder');
}
