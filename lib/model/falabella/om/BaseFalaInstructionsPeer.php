<?php


abstract class BaseFalaInstructionsPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_falainstructions';

	
	const CLASS_DEFAULT = 'lib.model.falabella.FalaInstructions';

	
	const NUM_COLUMNS = 3;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const CA_IDDOC = 'tb_falainstructions.CA_IDDOC';

	
	const CA_INSTRUCTIONS = 'tb_falainstructions.CA_INSTRUCTIONS';

	
	const CA_IDFALAINSTRUCTIONS = 'tb_falainstructions.CA_IDFALAINSTRUCTIONS';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIddoc', 'CaInstructions', 'CaIdfalainstructions', ),
		BasePeer::TYPE_COLNAME => array (FalaInstructionsPeer::CA_IDDOC, FalaInstructionsPeer::CA_INSTRUCTIONS, FalaInstructionsPeer::CA_IDFALAINSTRUCTIONS, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_iddoc', 'ca_instructions', 'ca_idfalainstructions', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIddoc' => 0, 'CaInstructions' => 1, 'CaIdfalainstructions' => 2, ),
		BasePeer::TYPE_COLNAME => array (FalaInstructionsPeer::CA_IDDOC => 0, FalaInstructionsPeer::CA_INSTRUCTIONS => 1, FalaInstructionsPeer::CA_IDFALAINSTRUCTIONS => 2, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_iddoc' => 0, 'ca_instructions' => 1, 'ca_idfalainstructions' => 2, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/falabella/map/FalaInstructionsMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.falabella.map.FalaInstructionsMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = FalaInstructionsPeer::getTableMap();
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
		return str_replace(FalaInstructionsPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(FalaInstructionsPeer::CA_IDDOC);

		$criteria->addSelectColumn(FalaInstructionsPeer::CA_INSTRUCTIONS);

		$criteria->addSelectColumn(FalaInstructionsPeer::CA_IDFALAINSTRUCTIONS);

	}

	const COUNT = 'COUNT(tb_falainstructions.CA_IDFALAINSTRUCTIONS)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT tb_falainstructions.CA_IDFALAINSTRUCTIONS)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FalaInstructionsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FalaInstructionsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = FalaInstructionsPeer::doSelectRS($criteria, $con);
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
		$objects = FalaInstructionsPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return FalaInstructionsPeer::populateObjects(FalaInstructionsPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			FalaInstructionsPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = FalaInstructionsPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinFalaHeader(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;
		
				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FalaInstructionsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FalaInstructionsPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FalaInstructionsPeer::CA_IDDOC, FalaHeaderPeer::CA_IDDOC);

		$rs = FalaInstructionsPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinFalaHeader(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FalaInstructionsPeer::addSelectColumns($c);
		$startcol = (FalaInstructionsPeer::NUM_COLUMNS - FalaInstructionsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		FalaHeaderPeer::addSelectColumns($c);

		$c->addJoin(FalaInstructionsPeer::CA_IDDOC, FalaHeaderPeer::CA_IDDOC);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FalaInstructionsPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = FalaHeaderPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getFalaHeader(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addFalaInstructions($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initFalaInstructionss();
				$obj2->addFalaInstructions($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FalaInstructionsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FalaInstructionsPeer::COUNT);
		}
		
				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FalaInstructionsPeer::CA_IDDOC, FalaHeaderPeer::CA_IDDOC);

		$rs = FalaInstructionsPeer::doSelectRS($criteria, $con);
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

		FalaInstructionsPeer::addSelectColumns($c);
		$startcol2 = (FalaInstructionsPeer::NUM_COLUMNS - FalaInstructionsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		FalaHeaderPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + FalaHeaderPeer::NUM_COLUMNS;

		$c->addJoin(FalaInstructionsPeer::CA_IDDOC, FalaHeaderPeer::CA_IDDOC);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();
		
		while($rs->next()) {

			$omClass = FalaInstructionsPeer::getOMClass();

			
			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

				
					
			$omClass = FalaHeaderPeer::getOMClass();

	
			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);
			
			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getFalaHeader(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addFalaInstructions($obj1); 					break;
				}
			}
			
			if ($newObject) {
				$obj2->initFalaInstructionss();
				$obj2->addFalaInstructions($obj1);
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
		return FalaInstructionsPeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(FalaInstructionsPeer::CA_IDFALAINSTRUCTIONS);
			$selectCriteria->add(FalaInstructionsPeer::CA_IDFALAINSTRUCTIONS, $criteria->remove(FalaInstructionsPeer::CA_IDFALAINSTRUCTIONS), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(FalaInstructionsPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(FalaInstructionsPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof FalaInstructions) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(FalaInstructionsPeer::CA_IDFALAINSTRUCTIONS, (array) $values, Criteria::IN);
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

	
	public static function doValidate(FalaInstructions $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(FalaInstructionsPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(FalaInstructionsPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(FalaInstructionsPeer::DATABASE_NAME, FalaInstructionsPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = FalaInstructionsPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(FalaInstructionsPeer::DATABASE_NAME);

		$criteria->add(FalaInstructionsPeer::CA_IDFALAINSTRUCTIONS, $pk);


		$v = FalaInstructionsPeer::doSelect($criteria, $con);

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
			$criteria->add(FalaInstructionsPeer::CA_IDFALAINSTRUCTIONS, $pks, Criteria::IN);
			$objs = FalaInstructionsPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseFalaInstructionsPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/falabella/map/FalaInstructionsMapBuilder.php';
	Propel::registerMapBuilder('lib.model.falabella.map.FalaInstructionsMapBuilder');
}
